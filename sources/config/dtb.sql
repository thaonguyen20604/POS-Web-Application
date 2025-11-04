-- Tạo cơ sở dữ liệu
CREATE DATABASE IF NOT EXISTS final;
USE final;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    avatar VARCHAR(255) DEFAULT NULL,
    fullname VARCHAR(255) NOT NULL,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(15),
    gender ENUM('male', 'female', 'other') ,
    role TINYINT(1) NOT NULL DEFAULT 0,
    status TINYINT(1) NOT NULL DEFAULT 0
);

CREATE TABLE admins (
    id INT PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES users(id)
);

CREATE TABLE staffs (
    id INT PRIMARY KEY,
    first_login INT DEFAULT 0,
    activated INT DEFAULT 0,
    activation_token VARCHAR(255),
    expiry_time timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);


CREATE TABLE IF NOT EXISTS categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    categoryName VARCHAR(255) NOT NULL,
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- Tạo bảng sản phẩm
CREATE TABLE IF NOT EXISTS products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    barcode VARCHAR(255) UNIQUE NOT NULL,
    productName VARCHAR(255) NOT NULL,
    imprice DECIMAL(10,2) NOT NULL,
    reprice DECIMAL(10,2) NOT NULL,
    category_id INT NOT NULL,
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    description TEXT,
    FOREIGN KEY (category_id) REFERENCES categories(category_id),
    quantity int not null
);

CREATE TABLE IF NOT EXISTS customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    phone VARCHAR(255) NOT NULL,
    customer_name VARCHAR(255) NOT NULL,
    customer_address VARCHAR(255) NOT NULL,
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    customer_id INT,
    total_amount DECIMAL(10,2),
    amount_given DECIMAL(10,2),
    excess_amount DECIMAL(10,2),
    purchase_date DATE DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);

CREATE TABLE order_details (
    detail_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    product_id INT,
    quantity INT,
    selling_price DECIMAL(10,2),
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

