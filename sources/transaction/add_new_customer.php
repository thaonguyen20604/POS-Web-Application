<?php
header('Content-Type: application/json; charset=utf-8');

require_once('db.php');
$conn = open_database();

$customer_name = $_POST['customer_name'];
$customer_phone = $_POST['customer_phone'];
$customer_address = $_POST['customer_address'];

//test return

if($customer_name == '' || $customer_phone == ''){
    die(json_encode(array('code'=>1,'error'=> 'Invalid data')));
}
if($customer_address == ''){
    $customer_address = 'Not provided';
}

$sql = "INSERT INTO `customers` (customer_name, customer_address, phone, created_date, update_date) VALUES (?, ?, ?, NOW(), NOW())";
$stm = $conn->prepare($sql);
$stm->bind_param("sss", $customer_name, $customer_address, $customer_phone);
if ($stm->execute()) {
    //take id from newly created customer
    $sql = "SELECT * FROM `customers` WHERE phone = ?";
    $stm = $conn->prepare($sql);
    $stm->bind_param("s", $customer_phone);
    if(!$stm->execute()){
        die(json_encode(array('code'=>500,'error'=> 'Cannot execute command')));
    }
    $result = $stm->get_result();
    $data = $result->fetch_assoc();
    $stm->close();
    die(json_encode(array('code' => 0, 'error' => '') + $data));
} else {
    die(json_encode(array('code' => 500, 'error' => 'Cannot execute command')));
}
