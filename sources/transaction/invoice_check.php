<?php
header('Content-Type: application/json; charset=utf-8');

require_once('db.php');
//get total_amount column from db
$conn = open_database();
$sql = "SELECT total_amount FROM `orders` WHERE order_id = ?";
$stm = $conn->prepare($sql);
$stm->bind_param("i", $order_id);
if(!$stm->execute()){
    die(json_encode(array('code'=>500,'error'=> 'Cannot execute command')));
}
$result = $stm->get_result();
if($result->num_rows == 0){
    echo $result->num_rows;
    echo $order_id;
    echo $result->fetch_assoc();
    die(json_encode(array('code'=>1,'error'=> 'Order with id'.$order_id.' not found')));
}
$data = $result->fetch_assoc();
$total_amount = $data['total_amount'];

$sql = "SELECT SUM(selling_price*quantity) as sum FROM `order_details` WHERE order_id = ?";
$stm = $conn->prepare($sql);
$stm->bind_param("i", $order_id);
if(!$stm->execute()){
    die(json_encode(array('code'=>500,'error'=> 'Cannot execute command')));
}
$result = $stm->get_result();
if($result->num_rows == 0){
    die(json_encode(array('code'=>1,'error'=> 'Order not found, this order may be modified or corrupted')));
}
$data = $result->fetch_assoc();
$sum = $data['sum'];

//compare total_amount and sum
if($total_amount != $sum){
    die(json_encode(array('code'=>1,'error'=> 'Total amount is not correct, this order may be modified or corrupted')));
}

$stm->close();
die(json_encode(array('code'=>0,'error'=> '')));
?>
