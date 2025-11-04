<?php
namespace models;

require_once('../config/db.conn.php');
use PDO;
use Exception;
use PDOException;

class Customer
{
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createCustomer($fullName, $phoneNumber, $address) {
        // Chuẩn bị câu lệnh SQL để chèn dữ liệu vào bảng customers
        $sql = "INSERT INTO customers (phone, customer_name, customer_address) 
                VALUES ('$phoneNumber', '$fullName', '$address')";
        $stmt = $this->conn->query($sql);
        
        // Kiểm tra số hàng ảnh hưởng bởi câu lệnh SQL
        if ($stmt) {
            return true; // Trả về true nếu việc chèn dữ liệu thành công
        } else {
            // Trả về thông báo lỗi nếu không có hàng nào bị ảnh hưởng
            // $errorInfo = $stmt->errorInfo();
            // return "Error creating customer: " . $errorInfo[2];
            return false;
        }
    }
    

    public function checkCustomer($phone) {
        // Chuẩn bị câu lệnh SQL để truy vấn thông tin khách hàng dựa trên số điện thoại
        $sql = "SELECT * FROM customers WHERE phone = '$phone'";
        $stmt = $this->conn->query($sql);
        // Lấy kết quả của truy vấn
        $customer = $stmt->fetch_assoc();
        
        // Kiểm tra xem có khách hàng nào được trả về từ cơ sở dữ liệu không
        if ($customer) {
            // Trả về thông tin tên và địa chỉ của khách hàng nếu tồn tại
            return $customer;
        } else {
            // Trả về null nếu không tìm thấy khách hàng
            return false;
        }
    }
    
    public function getAllCustomers() {
        $query = "SELECT * FROM customers";
        $result = $this->conn->query($query);
        
        if ($result === false) {
            // Xử lý lỗi
            error_log("Lỗi truy vấn cơ sở dữ liệu: " . $this->conn->error);
            return []; // hoặc trả về false/null để chỉ ra thất bại
        }
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getHistory($customer_id) {
        $sql = "SELECT * FROM orders WHERE customer_id = '$customer_id'";
        $result = $this->conn->query($sql);

        if ($result === false) {
            // Xử lý lỗi
            error_log("Lỗi truy vấn cơ sở dữ liệu: " . $this->conn->error);
            return []; // hoặc trả về false/null để chỉ ra thất bại
        }
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // public function getDetail($order_id) {
    //     $sql = "SELECT * FROM order_details WHERE order_id = '$order_id'";
    //     $result = $this->conn->query($sql);

    //     if ($result === false) {
    //         // Xử lý lỗi
    //         error_log("Lỗi truy vấn cơ sở dữ liệu: " . $this->conn->error);
    //         return []; // hoặc trả về false/null để chỉ ra thất bại
    //     }
        
    //     return $result->fetch_all(MYSQLI_ASSOC);
    // }
}
?>