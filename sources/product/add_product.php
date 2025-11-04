<?php
    session_start();
    ob_start();
    require_once('../config/db.conn.php');
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }

    // Kiểm tra xem các trường trong $_POST có tồn tại hay không
    if(isset($_POST['barcode'], $_POST['name'], $_POST['import_price'], $_POST['retail_price'], $_POST['category'], $_POST['description'], $_POST['quantity'])) {
        // Lấy dữ liệu từ form
        $barcode = $_POST['barcode'];
        $name = $_POST['name'];
        $import_price = $_POST['import_price'];
        $retail_price = $_POST['retail_price'];
        $category = $_POST['category'];
        $quantity = $_POST['quantity'];
        $description = $_POST['description'];

        $query = "SELECT EXISTS (SELECT 1 FROM categories WHERE category_id = '$category') AS cat_exists;";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $cat_exists = $row['cat_exists'];
        
        if ($cat_exists == 1) {
            $sql = "INSERT INTO products (product_id, barcode, productName, imprice, reprice, category_id, quantity, description) VALUES ('?', '$barcode', '$name', '$import_price', '$retail_price', '$category', '$quantity', '$description')";
            if ($conn->query($sql) === TRUE) {
                // echo "Dữ liệu đã được thêm thành công.";
                header("Location: ../views/product_catalog.php");
            } else {
                $error = "Can not add product.";
                header("Location: ../views/product_catalog.php?error=$error");
                exit();
            }
        } else {
            $error = "Do not have category";
            header("Location: ../views/product_catalog.php?error=$error");
            exit();
        }  
    } else {
        $error = "Dữ liệu không hợp lệ.";
        header("Location: ../views/product_catalog.php?error=$error");
        exit();
    }
?>

