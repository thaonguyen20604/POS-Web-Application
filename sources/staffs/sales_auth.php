<?php
session_start();
ob_start();
require_once('../config/db.conn.php');
require_once('../Models/Account.php');

use Models\Account;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // $query = "SELECT password FROM users WHERE username = '$username'";
    // $result = $conn->query($query);
    // if(!$result) {
    //     $error = "Invalid username or password.";
    //     header("Location: ../views/sales_login.php?error=" . urlencode($error));
    //     exit();
    // }

    // $row = $result->fetch_assoc();
    $account = new Account($conn);
    $check = $account->authenticate($username, $password);

    if ($check) {
        $sql = "SELECT staffs.*
                FROM users
                JOIN staffs ON users.id = staffs.id
                WHERE users.username = '$username' and status = 0";
        $row = $conn->query($sql);
        if ($row->num_rows > 0) { // Kiểm tra số lượng dòng dữ liệu trả về
            $result = $row->fetch_assoc();

            $id = $result['id'];
            $activated = $result['activated'];
            $first_login = $result['first_login'];
            
            $_SESSION['role'] = 0;
            
            if($activated == 1) {
                $_SESSION['id'] = $id;
                if($first_login == 0) {
                    header("Location: ../views/reset_password.php");
                    exit;
                } else {
                    header("Location: ../views/sales_home.php?id=$id&role=" . $_SESSION['role']);
                    exit();
                }
                
            } else {
                $error = "Please login by clicking on the link in your email";
            }
        } else {
            $error = "Account has been locked";
        }
    } else {
        $error = "Invalid username or password.";
    }
        // Redirect to login page with error message
    header("Location: ../views/sales_login.php?error=" . urlencode($error));
    exit();
}



?>
