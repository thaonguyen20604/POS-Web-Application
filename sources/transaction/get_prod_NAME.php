<?php
header('Content-Type: application/json; charset=utf-8');

$productName = $_GET['product_name'];
require_once('db.php');
$conn = open_database();
$sql = "SELECT * FROM `products` WHERE productName LIKE ?";
$stm = $conn->prepare($sql);

$productName = '%'.$productName.'%';

$stm->bind_param("s", $productName);
if(!$stm->execute()){
    die(json_encode(array('code'=>500,'error'=> 'Cannot execute command')));
}
$result = $stm->get_result();
if($result->num_rows == 0){
    die(json_encode(array('code'=>2,'error'=> 'Product with name '.$productName.' does not exist')));
}
$data = $result->fetch_all(MYSQLI_ASSOC);
$error_log = array('code' => 0, 'error' => '');
$stm->close();
die(json_encode($error_log + $data));
?>
