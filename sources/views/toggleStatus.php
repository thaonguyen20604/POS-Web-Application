<?php
// Kết nối CSDL
session_start();
ob_start();
require_once('../config/db.conn.php');
print_r($_POST);
// Kiểm tra nếu yêu cầu là POST và tồn tại dữ liệu từ yêu cầu
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['status'])) {
    // Lấy thông tin từ yêu cầu
    $staffId = $_POST['id'];
    $status = $_POST['status'];

    // Chuyển đổi trạng thái từ chuỗi "active" hoặc "inactive" sang giá trị 1 hoặc 0 (hoặc bất kỳ giá trị nào phù hợp)

    // echo $statusValue;
    // Truy vấn cập nhật trạng thái tài khoản nhân viên
    $sql = "UPDATE users SET status = '$status' WHERE id = '$staffId'";
    $result = $conn->query($sql);

    // Kiểm tra xem truy vấn đã thành công hay không
    if ($result) {
        // Trả về mã thành công để xử lý trong JavaScript
        http_response_code(200);
        // header("Location: ../views/view_staffs.php");
        return true;
    } else {
        // Trả về mã lỗi nếu truy vấn không thành công
        http_response_code(500);
        return false;
    }
} else {
    // Trả về mã lỗi nếu yêu cầu không hợp lệ
    http_response_code(400);
    return false;
}
?>
