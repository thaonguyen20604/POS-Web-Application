<?php
ob_start();
session_start();
require_once('../config/db.conn.php'); // Connect to the database

if (isset($_GET["logout"])) {
    // Clear all session data and destroy the session
    $_SESSION = array();
    session_destroy();

    // Redirect the user to the home page
    header("Location: ../home.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];


// Sử dụng truy vấn tham số hoá để tránh lỗ hổng SQL Injection
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();


    if ($row) {
        $id = $row['id'];
        $hashed_password = $row['password'];  // The password is already hashed in the database
        // echo $hashed_password;
        // echo $password;
        // $r = password_verify($password, $hashed_password);
        if ($password === $hashed_password) {
            $query = "SELECT role FROM users WHERE username = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $_SESSION['role'] = $row['role'];
            $_SESSION['id'] = $id;

            header("Location: ../views/admin_home.php?id=$id&role=" . $_SESSION['role']);
            // header("Location: ../views/admin_home.php");
            exit();
        } else {
            $error = "Invalid password.";
            header("Location: ../views/admin_login.php?error=" . urlencode($error) . "&pass=" . $r);
            exit();
        }
    } else {
        // Account not found
        $error = "Invalid username or password.";
        header("Location: ../views/admin_login.php?error=" . urlencode($error));
        exit();
    }
}
?>
