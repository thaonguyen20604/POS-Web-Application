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

die(json_encode(array('code'=>0,'error'=> '', 'order_id' => $order_id)));
?>