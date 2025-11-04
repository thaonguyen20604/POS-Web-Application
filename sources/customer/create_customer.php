<?php
session_start();
ob_start();
require_once('../Models/Customer.php');
require_once('../config/db.conn.php');

use Models\Customer;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tạo một đối tượng Customer với kết nối cơ sở dữ liệu
    $customer = new Customer($conn);

    // Lấy thông tin từ yêu cầu POST
    $phone = $_POST['phone'];
    $name = $_POST['name'];
    $address = $_POST['address'];

    // Kiểm tra xem khách hàng đã tồn tại hay chưa
    $existingCustomer = $customer->checkCustomer($phone);

    // Nếu khách hàng không tồn tại, tạo tài khoản mới
    if (!$existingCustomer) {
        // Thêm khách hàng mới vào cơ sở dữ liệu
        $result = $customer->createCustomer($name, $phone, $address);
        
        if ($result) {
            // Trả về dữ liệu thành công nếu tạo tài khoản thành công
            echo json_encode(['success' => true]);
            exit();
        } else {
            // Trả về thông báo lỗi nếu tạo tài khoản thất bại
            echo json_encode(['error' => 'Failed to create customer account. Please try again later.']);
            exit();
        }
    } else {
        // Trả về thông báo lỗi nếu khách hàng đã tồn tại
        echo json_encode(['error' => 'Customer already exists']);
        exit();
    }
} else {
    // Trả về thông báo lỗi nếu yêu cầu không phải là POST
    echo json_encode(['error' => 'Invalid request method']);
    exit();
}
?>
