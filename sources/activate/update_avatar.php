<?php
session_start();
ob_start();
require_once('../config/db.conn.php');

if(isset($_FILES['image'])) {
    $id = $_GET['id'];
    $role = $_GET['role'];
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (!empty($_FILES["image"]["tmp_name"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            $error_img = "File is not an image.";
            header("Location: ../views/profile.php?error_img=$error_img");
            exit();
        } 
    } else {
        $error_img = "No file uploaded or file upload error.";
        header("Location: ../views/profile.php?error_img=$error_img");
        exit();
    }

    $expensions= array("jpeg","jpg","png");
    // Allow certain file formats
    if(!in_array($imageFileType,$expensions)) {
        $error_img = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        header("Location: ../views/profile.php?error_img=$error_img");
        exit();
    }

    $filename = basename($_FILES["image"]["name"]);
    $file_tmp = $_FILES["image"]["tmp_name"];

    if (move_uploaded_file($file_tmp, $target_file)) {
        $sql_update = "UPDATE users SET avatar = '$filename' WHERE id = '$id'";
        $stmt_update = $conn->query($sql_update);

        if ($stmt_update) {
            $upload_status = "success";
        } else {
            $error_img = "Sorry, there was an error updating your avatar.";
            header("Location: ../views/profile.php?error_img=$error_img");
            exit();
        }
    } else {
        $error_img = "Sorry, there was an error uploading your file.";
        header("Location: ../views/profile.php?error_img=$error_img");
        exit();
    }
    header("Location: ../views/profile.php?id=$id&role=$role");
    exit();

} else {
    $error_img = "Fail";
    header("Location: ../views/profile.php?error_img=$error_img");
    exit();
}
?>
