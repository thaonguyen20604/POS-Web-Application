<?php
    session_start();
    ob_start();
    require_once('../config/db.conn.php'); // Connect to the database
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }

    // Lấy dữ liệu từ form
    $productId = $_POST['productId'];
    echo $productId;
    $barcode = $_POST['upbarcode'];
    $name = $_POST['upname'];
    $import_price = $_POST['upimport_price'];
    $retail_price = $_POST['upretail_price'];
    $category = $_POST['upcategory'];
    $quantity = $_POST['upquantity'];
    $description = $_POST['updescription'];

    $query = "SELECT EXISTS (SELECT 1 FROM categories WHERE category_id = '$category') AS cat_exists;";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $cat_exists = $row['cat_exists'];
    
    if ($cat_exists == 1) {
        $sql = "UPDATE products SET 
                    barcode = '$barcode', 
                    productName = '$name', 
                    imprice = '$import_price', 
                    reprice = '$retail_price', 
                    category_id = '$category', 
                    quantity = '$quantity', 
                    description = '$description' 
                WHERE product_id = '$productId'";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: ../views/product_catalog.php");
        } else {
            $error = "Cannot update product.";
            header("Location: ../views/product_catalog.php?error=" . urlencode($error));
            exit();
        }
    } else {
        $error = "Category does not exist.";
        header("Location: ../views/product_catalog.php?error=" . urlencode($error));
        exit();
    }
?>
