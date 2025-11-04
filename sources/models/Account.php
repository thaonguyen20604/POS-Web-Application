<?php
namespace Models;

require_once('../config/db.conn.php');
require_once ('../vendor/autoload.php');

use PDO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Account {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createAccount($fullname, $username, $email, $gender, $phone, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $avatar = "../images/default_image.jpg";
        
        $sql = "INSERT INTO users (avatar, fullname, username, password, email, phone, gender) 
        VALUES ('$avatar', '$fullname', '$username','$hashed_password', '$email', '$phone', '$gender')";
        
        $result = $this->conn->query($sql);
        if($result) {
            $token = bin2hex(random_bytes(16));
            $expiry_time = date('Y-m-d H:i:s', time() + 60);

            $sql = "SELECT id FROM users WHERE username = '$username'";
            $stmt = $this->conn->query($sql);
            $row = $stmt->fetch_assoc();
            $id = $row['id'];

            $query = "INSERT INTO staffs (id, activation_token, expiry_time)
            VALUES ('$id', '$token', '$expiry_time')";

            

            if ($this->conn->query($query)) {
                return $this->sendActivationEmail($fullname, $email, $token, $id);
            } else {
                return false;
            }
        }
        
    }

    public function getSales($username) {
        try {
            $query = "SELECT * FROM users WHERE username = '$username'";
            $stmt = $this->conn->query($query);
            $salesData = $stmt->fetch_assoc();
            // $salesData = $row
            
            return $salesData;
        } catch (Exception $e) {
            throw new Exception("Failed to get sales by username: " . $e->getMessage());
        }
    }

    public function getAllSales() {
        try {
            $query = "SELECT * FROM users WHERE role == 0";
            $stmt = $this->conn->prepare($query);
            $salesdata = $stmt->get_result();
            // return json_encode($salesdata);
            return $salesdata;
        } catch (Exception $e) {
            throw new Exception("Failed to get staffs: " . $e->getMessage());
        }
    }
    

    private function sendActivationEmail($fullname, $email, $token, $id) {
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF; // Tắt debug
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'nguyenhoaan2212@gmail.com';
            $mail->Password = 'eahc bmqb dggr jxwh';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
    
            // Recipient
            $mail->setFrom('admin@example.com', 'Admin');
            $mail->addAddress($email, $fullname);
    
            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Account Activation';
            $mail->Body = 'Dear ' . $fullname . ',<br><br>';
            $mail->Body .= 'Your account has been created. Please click the following link to activate your account:<br>';
            $mail->Body .= '<a href="http://localhost/xay/activate/request_new_token.php?email=' . $email . '&token=' . $token . '">Activate</a>';
            $mail->Body .= '<br><br>Thank you.';
    
            $mail->send();
            $this->saveTokenAndExpiryTime($token, $id);
            return true; // Trả về true nếu email được gửi thành công
        } catch (Exception $e) {
            return false; // Trả về false nếu gặp lỗi khi gửi email
        }
    }
    

    public function resendRequestToAdmin($email) {
        // check trong users
        // $sql = "SELECT id, fullname FROM users WHERE email = ?";
        // $stmt = $this->conn->prepare($sql);
        // $stmt->bind_param("s", $email);
        // $stmt->execute();
        // $result = $stmt->get_result();
        // $row = $result->fetch_assoc();
        // $id = $row['id'];
        // $fullname = $row['fullname']; 

        // // Lấy token và expiry_time từ bảng staffs
        // $sql = "SELECT activation_token, expiry_time FROM staffs WHERE id = ?";
        // $stmt = $this->conn->prepare($sql);
        // $stmt->bind_param("i", $id);
        // $stmt->execute();
        // $result = $stmt->get_result();
        // $row = $result->fetch_assoc();

        $sql = "SELECT staffs.id, activation_token, expiry_time, users.fullname 
                FROM staffs JOIN users ON staffs.id = users.id
                WHERE users.email = '$email'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
    
        if ($row && isset($row['activation_token']) && isset($row['expiry_time'])) {
            $activation_token = $row['activation_token'];
            $expiry_time = strtotime($row['expiry_time']);
            $id = $row['id'];
            $fullname = $row['fullname'];
            
            // Kiểm tra xem token có hết hạn chưa
            if (time() > $expiry_time) {
                // Sinh mã token mới và cập nhật thời gian hết hạn
                $new_token = bin2hex(random_bytes(16));
                $activation_token = $new_token;
                $this->saveTokenAndExpiryTime($activation_token, $id);
    
                // Gửi lại email kích hoạt với mã token mới
                if ($this->sendActivationEmail($fullname, $email, $new_token, $id)) {
                    return true; // Email gửi lại thành công
                } else {
                    return false; // Không thể gửi lại email
                }
            }
        }
        // echo "Token fail";
        return false; // Token chưa hết hạn hoặc không tìm thấy email
    }
    
    
    private function saveTokenAndExpiryTime($token, $id) {
        $expiry_time = time() + 60; // Thời gian hết hạn là thời gian hiện tại cộng thêm 60 giây
        $formatted_expiry_time = date('Y-m-d H:i:s', $expiry_time); // Định dạng thời gian hết hạn
    
        $sql = "UPDATE staffs SET activation_token = '$token', expiry_time = '$formatted_expiry_time' WHERE id = '$id'";
        $result =  $this->conn->query($sql);
    }
    

    public function activateAccount($token) {
        $sql = "SELECT id, activation_token, expiry_time FROM staffs WHERE activation_token = ?";
        $stmt = $this->conn->prepare($sql);
        // dong trong class
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $activation_token = $row['activation_token'];
            $expiry_time = strtotime($row['expiry_time']);
    
            if ($activation_token === $token && time() <= $expiry_time) {
                return true;
            }
        }
        return false;
    }    


    public function authenticate($username, $password) {
        // Check if the username exists
        $query = "SELECT password FROM users WHERE username = '$username' and role = 0";
        $result = $this->conn->query($query);
        $row = $result->fetch_assoc();
            if ($row) {
                // Compare hashed password with the provided password
                if (password_verify($password, $row['password'])) {
                    // User authenticated successfully
                    return true;
                }
            }
            // print("Invalid username or password.");
        return false;
    }

    public function checkExistingUsername($username) {
        $sql = "SELECT COUNT(*) AS count FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($row['count'] > 0); // Trả về true nếu username đã tồn tại, ngược lại trả về false
    }
    
}
?>
