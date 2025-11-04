<?php
    session_start();
    ob_start();
    print_r($_POST);
    require_once('../config/db.conn.php');

    $userId = $_SESSION['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullname = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $username = strtok($email, '@');
        
        $sql = "UPDATE users SET username = '$username', fullname = '$fullname', email = '$email', phone = '$phone', gender = '$gender' WHERE id = '$userId'";
        
        if($conn->query($sql)) {
            // header("Location: ../views/profile.php?success");
        } else {
            $error = "Can not update";
            header("Location: ../views/profile.php?error=$error");
        }
    }
    exit();
?>