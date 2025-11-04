<?php
namespace Models;

require_once('../config/db.conn.php');
use PDO;
use Exception;

class Product
{
    private $conn;

    public function __construct($conn) {
        if (!$conn instanceof PDO) {
            throw new Exception("Connection is not a PDO instance.");
        }
        $this->conn = $conn;
    }

    // Get all products
    public function getAllProducts() {
        try {
            $query = "SELECT * FROM products";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Failed to get products: " . $e->getMessage());
        }
    }

    // Get product by ID
    public function getProductByBarcode($barcode) {
        try {
            $query = "SELECT * FROM products WHERE barcode = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$barcode]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Failed to get product by barcode: " . $e->getMessage());
        }
    }

    public function getProductById($product_id) {
        try {
            $query = "SELECT * FROM products WHERE product_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$product_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Failed to get product by ID: " . $e->getMessage());
        }
    }
    public function getIdProduct($barcode) {
        try {
            $query = "SELECT product_id FROM products WHERE barcode = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$barcode]);
            return $stmt->fetch(PDO::FETCH_ASSOC)['product_id'];
        } catch (Exception $e) {
            throw new Exception("Failed to get product ID by barcode: " . $e->getMessage());
        }
    }
    

    public function createProduct($barcode, $productName, $imprice, $reprice, $category_id, $description) {
        try {
            // Kiểm tra kết nối cơ sở dữ liệu
            if (!$this->conn) {
                throw new Exception("Database connection not established.");
            }
    
            // Kiểm tra các giá trị đầu vào
            if (empty($barcode) || empty($productName) || empty($imprice) || empty($reprice) || empty($category_id)) {
                throw new Exception("All fields are required.");
            }
    
            // Kiểm tra kết nối đã được thiết lập
            $query = "INSERT INTO products (barcode, productName, imprice, reprice, category_id, created_date, update_date, description) VALUES (?, ?, ?, ?, ?, NOW(), NOW(), ?)";
            $stmt = $this->conn->prepare($query);
            if (!$stmt) {
                throw new Exception("Failed to prepare statement.");
            }
    
            // Thực thi truy vấn
            $success = $stmt->execute([$barcode, $productName, $imprice, $reprice, $category_id, $description]);
            if (!$success) {
                throw new Exception("Failed to execute query.");
            }
    
            // Trả về true nếu thành công
            return true;
        } catch (Exception $e) {
            // Ném ngoại lệ lại để bắt ở nơi gọi
            throw new Exception("Failed to create product: " . $e->getMessage());
        }
    }
     

    public function deleteProduct($barcode) {
        try {
            $query = "DELETE FROM products WHERE barcode = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$barcode]);
            return true;
        } catch (Exception $e) {
            throw new Exception("Failed to delete product by barcode: " . $e->getMessage());
        }
    }

    public function updateProduct($product_id, $barcode, $productName, $imprice, $reprice, $category_id, $description) {
        // try {
            $query = "UPDATE products SET barcode = ?, productName = ?, imprice = ?, reprice = ?, category_id = ?, description = ? WHERE product_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$product_id, $barcode, $productName, $imprice, $reprice, $category_id, $description]);
            // return true;
        // } catch (Exception $e) {
            echo "Failed to update product by ID: ";
            // return false;
        // }
    }

    public function viewProduct() {
        try {
            $query = "SELECT * FROM products";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Failed to view products: " . $e->getMessage());
        }
    }    
}
?>
