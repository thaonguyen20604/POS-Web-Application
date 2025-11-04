<?php
header('Content-Type: application/json; charset=utf-8');

require_once('db.php');
//check customer exists
$conn = open_database();
$customer_phone = $_GET['customer_phone'];
$sql = "SELECT * FROM `customers` WHERE phone = ?";
$stm = $conn->prepare($sql);
$stm->bind_param("i", $customer_phone);
if(!$stm->execute()){
    die(json_encode(array('code'=>500,'error'=> 'Cannot execute command')));
}
$result = $stm->get_result();

if($result->num_rows == 0){
    die(json_encode(array('code'=>1,'error'=> 'Customer not found')));
}
$data = $result->fetch_assoc();
$stm->close();
die(json_encode(array('code'=>0,'error'=> '')+$data));
?>
