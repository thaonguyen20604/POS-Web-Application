<?php
header('Content-Type: application/json; charset=utf-8');

$barcode = $_GET['barcode'];
require_once('db.php');
$conn = open_database();
$sql = "SELECT * FROM `products` WHERE barcode = ?";
$stm = $conn->prepare($sql);

$barcode = strval($barcode);

$stm->bind_param("s", $barcode);
if(!$stm->execute()){
    die(json_encode(array('code'=>500,'error'=> 'Cannot execute command')));
}
$result = $stm->get_result();
if($result->num_rows == 0){
    die(json_encode(array('code'=>2,'error'=> 'Product with barcode '.$barcode.' does not exist')));
}
$data = $result->fetch_assoc();
$error_log = array('code' => 0, 'error' => '');
$stm->close();
die(json_encode($error_log + $data));
?>
