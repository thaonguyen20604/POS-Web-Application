
<?php
ob_start();
session_start();

require_once('../config/db.conn.php'); // Connect to the database

if (isset($_GET["logout"])) {
    // Xoá tất cả dữ liệu phiên và hủy phiên
    $_SESSION = array();
    ob_clean();
    // Chuyển hướng người dùng đến trang chủ
    header("Location: ../home.php");
    exit();
}
ob_end_flush();
?>