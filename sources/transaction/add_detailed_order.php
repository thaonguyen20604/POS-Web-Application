<?php
header('Content-Type: application/json; charset=utf-8');

require_once('db.php');
$conn = open_database();
$input = json_decode(file_get_contents('php://input'));

$sql = "SELECT MAX(detail_id) as detail_id FROM `order_details`";
$stm = $conn->prepare($sql);
if(!$stm->execute()){
    die(json_encode(array('code'=>500,'error'=> 'Cannot execute command')));
}

$result = $stm->get_result();

$data = $result->fetch_assoc();

if ($data === null) {
    $detail_id = 0;
} else {
    $detail_id = $data['detail_id'] + 1;
}

$detail_id = intval($detail_id);
$order_id = intval($input->order_id);
$product_id = intval($input->product_id);
$quantity = intval($input->quantity);
$selling_price = floatval($input->selling_price);

//data validate
if($quantity < 0 || $selling_price < 0){
    die(json_encode(array('code'=>1,'error'=> 'Invalid data')));
}

$sql = "INSERT INTO `order_details` (detail_id, order_id, product_id, quantity, selling_price) VALUES (?, ?, ?, ?, ?)";
$stm = $conn->prepare($sql);
$stm->bind_param("iiiid", $detail_id, $order_id, $product_id, $quantity, $selling_price);
if(!$stm->execute()){
    die(json_encode(array('code'=>500,'error'=> 'Cannot execute command')));
}

$stm->close();
die(json_encode(array('code'=>0,'error'=> '', 'detail_id' => $detail_id)));
?>
