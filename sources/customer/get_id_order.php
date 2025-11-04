<?php
session_start();
ob_start();
require_once('../config/db.conn.php');

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];

    $sql = "SELECT * FROM order_details WHERE order_id = '$order_id'";
    $result = $conn->query($sql);

    if ($result === false) {
        // Xử lý lỗi
        error_log("Lỗi truy vấn cơ sở dữ liệu: " . $conn->error);
        echo json_encode([]); // hoặc trả về false/null để chỉ ra thất bại
    } else {
        // Fetch dữ liệu và trả về dưới dạng JSON
        $detail = $result->fetch_all(MYSQLI_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($detail);
    }
}
?>
