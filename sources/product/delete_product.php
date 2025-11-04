<?php
    session_start();
    ob_start();
    require_once('../config/db.conn.php');

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }

    // Kiểm tra xem có yêu cầu xóa sản phẩm không
    if(isset($_GET['delete_product_id'])) {
        $product_id = $_GET['delete_product_id'];

        // Kiểm tra sự tồn tại của product_id trong order_details
        $checkId = "SELECT EXISTS (SELECT 1 FROM order_details WHERE product_id = '$product_id') as exist;";
        $result = $conn->query($checkId);
        $row = $result->fetch_assoc();
        $exist = $row['exist']; 
    
        if($exist == 0) {
            // Xây dựng truy vấn xóa dữ liệu
            $delete_sql = "DELETE FROM products WHERE product_id = $product_id";
    
            // Thực thi truy vấn
            if ($conn->query($delete_sql) === TRUE) {
                // Chuyển hướng nếu xóa thành công
                header("Location: ../views/product_catalog.php");
            } else {
                // Xử lý lỗi nếu truy vấn xóa không thành công
                $error = "Error deleting product: " . $conn->error;
                header("Location: ../views/product_catalog.php?error=$error");
                exit();
            }
        } else {
            // Chuyển hướng nếu sản phẩm đã có trong order_details
            $error = "Product has been ordered.";
            header("Location: ../views/product_catalog.php?error=$error");
            exit();
        }
    }
?>
