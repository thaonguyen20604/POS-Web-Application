<?php
    session_start();
    ob_start();
    print_r($_POST);
    // Xác định các tham số kết nối cơ sở dữ liệu
    require_once('../config/db.conn.php');
    require_once('../Models/Account.php');
    use Models\Account;

    // Kiểm tra xem yêu cầu có phải là POST không
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $fullname = $_POST['fn'];
        $email = $_POST['email'];
        $username = strtok($email, '@');
        $password = $username;
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];

        $account = new Account($conn);
        // Thực hiện thêm dữ liệu vào cơ sở dữ liệu
        // Thêm sale bằng cách gọi phương thức createSale
        $result = $account->createAccount($fullname, $username, $email, $gender, $phone, $password);
        if ($result) {
            // Trả về kết quả thành công
            echo "success";
            echo json_encode($account->getSales($username));
            // echo json_encode(array("success" => true));
        } else {
            // Trả về kết quả thất bại
            echo json_encode(array("success" => false));
            exit;
        }
    }
?>

