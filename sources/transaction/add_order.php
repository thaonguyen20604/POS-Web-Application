<?php
header('Content-Type: application/json; charset=utf-8');

require_once('db.php');
$conn = open_database();
$sql = "SELECT MAX(order_id) as order_id FROM `orders`";
$stm = $conn->prepare($sql);
if(!$stm->execute()){
    die(json_encode(array('code'=>500,'error'=> 'Cannot execute command')));
}
$result = $stm->get_result();
if($result->num_rows == 0){
    $order_id = 0;
}else{
    $data = $result->fetch_assoc();
    $order_id = $data['order_id'] + 1;
}

$input = json_decode(file_get_contents('php://input'));

$customer_id = $input->customer_id;
$total_amount = $input->total_amount;
$amount_given = $input->amount_given;
$excess_amount = $input->excess_amount;
$purchase_date = $input->purchase_date;

//custommer validate
$sql = "SELECT * FROM `customers` WHERE customer_id = ?";
$stm = $conn->prepare($sql);
$stm->bind_param("i", $customer_id);
if(!$stm->execute()){
    die(json_encode(array('code'=>500,'error'=> 'Cannot execute command')));
}
$result = $stm->get_result();
if($result->num_rows == 0){
    die(json_encode(array('code'=>1,'error'=> 'Customer not found')));
}

//data validate
if($total_amount < 0 || $amount_given < 0 || $excess_amount < 0){
    die(json_encode(array('code'=>1,'error'=> 'Invalid data')));
}

$sql = "INSERT INTO `orders` (order_id, customer_id, total_amount, amount_given, excess_amount, purchase_date) VALUES (?, ?, ?, ?, ?, ?)";
$stm = $conn->prepare($sql);
$stm->bind_param("iiddds", $order_id, $customer_id, $total_amount, $amount_given, $excess_amount, $purchase_date);
if(!$stm->execute()){
    die(json_encode(array('code'=>500,'error'=> 'Cannot execute command')));
}

//existences check
$sql = "SELECT * FROM `orders` WHERE order_id = ?";
$stm = $conn->prepare($sql);

$stm->bind_param("i", $order_id);
if(!$stm->execute()){
    die(json_encode(array('code'=>500,'error'=> 'Cannot execute command')));
}
$result = $stm->get_result();
if($result->num_rows == 0){
    die(json_encode(array('code'=>1,'error'=> 'Order not found')));
}

$stm->close();
die(json_encode(array('code'=>0,'error'=> '', 'order_id' => $order_id)));
?>
