<?php
header('Content-Type: application/json; charset=utf-8');

$productID = $_GET['productID'];
$productID = $_GET['quantity'];

require_once('db.php');
$conn = open_database();
$sql = "UPDATE `products` SET quantity = quantity - ? WHERE product_id = ?";
$stm = $conn->prepare($sql);

$productID = intval($productID);
$quantity = intval($quantity);

$stm->bind_param("ii", $quantity, $productID);
if(!$stm->execute()){
    die(json_encode(array('code'=>500,'error'=> 'Cannot execute command')));
}
$stm->close();
die(json_encode(array('code'=>0,'error'=> '')));
?>