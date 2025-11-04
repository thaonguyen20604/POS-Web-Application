<?php
session_start();
ob_start();
require_once('../config/db.conn.php');
require_once('../models/Customer.php');
use models\Customer;

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'];
    $customerModel = new Customer($conn);
    $history = $customerModel->getHistory($customer_id);
    
    // Trả về dữ liệu dưới dạng JSON
    header('Content-Type: application/json');
    echo json_encode($history);
}
?>
