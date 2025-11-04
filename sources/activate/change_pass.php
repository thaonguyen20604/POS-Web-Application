<?php
session_start();
ob_start();
require_once('../config/db.conn.php'); // Kết nối tới cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['pass']) || empty($_POST['new_pass']) || empty($_POST['confirm_pass'])) {
        $error = "Please fill in all the boxes.";
        header("Location: ../views/reset_password.php?error=" . urlencode($error));
        // mã hóa các ký tự trong một chuỗi thành các phần tử phù hợp với định dạng URL
        exit;
    }

    $current_password = $_POST['pass'];
    $new_password = $_POST['new_pass'];
    $confirm_password = $_POST['confirm_pass'];

    // Lấy id của nhân viên hiện tại từ phiên đăng nhập
    $id = $_SESSION['id'];
    $role = $_SESSION['role'];

    // Truy vấn để lấy mật khẩu của nhân viên từ cơ sở dữ liệu
    $sql = "SELECT password FROM users WHERE id = '$id'";
    $row = $conn->query($sql);

    if ($row) {
        $result = $row->fetch_assoc();
        
        $password = $result['password'];

        if($role==1) {
            if($current_password !== $password) {
                $error = "Wrong password.";
                header("Location: ../views/reset_password.php?error=" . urlencode($error));
                exit;
            }
        } else {
            if (!password_verify($current_password, $password)) {
                // so sanh pass da bam voi chua bam
                $error = "Wrong password.";
                header("Location: ../views/reset_password.php?error=" . urlencode($error));
                exit;
            }
        }

        if($current_password === $new_password) {
            $error = "Please do not use old password.";
            header("Location: ../views/reset_password.php?error=" . urlencode($error));
            exit;
        } 

        if ($new_password !== $confirm_password) {
            $error = "Password do not match.";
            header("Location: ../views/reset_password.php?error=" . urlencode($error));
            exit;
        }

        if($role==0) {
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
            
            $update_pass = "UPDATE users SET password = '$hashed_new_password' WHERE id = '$id'";
            $stmt = $conn->query($update_pass);
            
            $update_staff = "UPDATE staffs SET first_login = 1 WHERE id = '$id'";
            $result = $conn->query($update_staff);

            header("Location: ../views/sales_login.php");
            exit();
        } else {
            $update_pass = "UPDATE users SET password = '$new_password' WHERE id = '$id'";
            $stmt = $conn->query($update_pass);

            header("Location: ../views/admin_login.php");
            exit();
        }
    }
}
?>
