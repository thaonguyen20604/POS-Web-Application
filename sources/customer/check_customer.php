<?php
session_start();
ob_start();
require_once('../Models/Customer.php');
require_once('../config/db.conn.php');

use Models\Customer;

// Kiểm tra xem yêu cầu là POST hay không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tạo một đối tượng Customer
    $customer = new Customer($conn);

    // Lấy thông tin số điện thoại từ yêu cầu
    $phone = $_POST['phone'];

    // Kiểm tra xem khách hàng đã tồn tại hay chưa
    $existingCustomer = $customer->checkCustomer($phone);

    // Nếu khách hàng không tồn tại, trả về thông báo lỗi dưới dạng JSON
    if (!$existingCustomer) {
        echo json_encode(['error' => 'Customer not found']);
        exit();
    } else {
        // Nếu khách hàng tồn tại, trả về thông tin của khách hàng dưới dạng JSON
        $customerInfo = [
            'name' => $existingCustomer['name'],
            'address' => $existingCustomer['address']
        ];
        echo json_encode($customerInfo);
        exit();
    }
}

?>
