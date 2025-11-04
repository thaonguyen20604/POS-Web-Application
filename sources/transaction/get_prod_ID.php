<?php
header('Content-Type: application/json; charset=utf-8');

$productID = $_GET['product_id'];
require_once('db.php');
$conn = open_database();
$sql = "SELECT * FROM `products` WHERE product_id = ?";
$stm = $conn->prepare($sql);

$productID = intval($productID);

$stm->bind_param("i", $productID);
if(!$stm->execute()){
    die(json_encode(array('code'=>500,'error'=> 'Cannot execute command')));
}
$result = $stm->get_result();
if($result->num_rows == 0){
    die(json_encode(array('code'=>2,'error'=> 'Product with ID '.$productID.' does not exist')));
}
$data = $result->fetch_assoc();
$error_log = array('code' => 0, 'error' => '');
$stm->close();
die(json_encode($error_log + $data));
?>
