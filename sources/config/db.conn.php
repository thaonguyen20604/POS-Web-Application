<?php
$host = 'mysqldb';
$port = 3306;  // Ensure this is an integer
$user = 'hoaan';
$password = 'finalweb123';
$database = 'final';

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
