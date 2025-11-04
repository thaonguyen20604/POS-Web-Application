-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 04:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `categoryName`, `created_date`, `update_date`) VALUES
(1, 'phone', '2024-05-20 12:39:02', '2024-05-20 12:39:02'),
(2, 'laptop', '2024-05-22 01:21:22', '2024-05-22 01:21:22'),
(3, 'airpod', '2024-05-22 01:21:50', '2024-05-22 01:21:50');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `phone`, `customer_name`, `customer_address`, `created_date`, `update_date`) VALUES
(1, '12345678910', 'customer1', 'customer1, Ho Chi Minh city', '2024-05-20 12:38:07', '2024-05-22 01:33:59'),
(2, '33333333333', 'customer', 'customer, Ho Chi Minh city', '2024-05-21 06:59:13', '2024-05-22 01:58:36'),
(3, '11111111111', 'customer3', 'customer3, Ho Chi Minh city', '2024-05-21 15:52:26', '2024-05-22 01:34:44');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `amount_given` decimal(10,2) DEFAULT NULL,
  `excess_amount` decimal(10,2) DEFAULT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `total_amount`, `amount_given`, `excess_amount`, `purchase_date`) VALUES
(1, 1, 1111.00, 111.00, 11111.00, '2024-05-21'),
(2, 2, 6000.00, 3.00, 3.00, '2024-05-21'),
(3, 1, 50000.00, 500000.00, 450000.00, '2024-05-21'),
(4, 1, 100000.00, 1000000.00, 900000.00, '2024-05-21'),
(5, 3, 50000.00, 5000000.00, 4950000.00, '2024-05-21'),
(6, 1, 150000.00, 150000.00, 0.00, '2024-05-21'),
(7, 1, 50000.00, 50000.00, 0.00, '2024-05-21'),
(8, 1, 30000000.00, 30000000.00, 0.00, '2024-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `selling_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`detail_id`, `order_id`, `product_id`, `quantity`, `selling_price`) VALUES
(1, 1, 1, 100, 10.00),
(2, 1, 3, 23, 1.00),
(3, 2, 1, 23, NULL),
(4, 3, 1, 1, 50000.00),
(5, 4, 1, 2, 50000.00),
(6, 5, 1, 1, 50000.00),
(7, 6, 1, 3, 50000.00),
(8, 7, 1, 1, 50000.00),
(9, 8, 1, 1, 30000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `imprice` decimal(10,2) NOT NULL,
  `reprice` decimal(10,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `description` text DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `barcode`, `productName`, `imprice`, `reprice`, `category_id`, `created_date`, `update_date`, `description`, `quantity`) VALUES
(1, 'SSS23', 'Samsung Galaxy S23 Ultra 256GB', 22000000.00, 30000000.00, 1, '2024-05-20 12:39:41', '2024-05-22 01:26:45', 'Mới, đầy đủ phụ kiện từ nhà sản xuất\r\nHộp, Sách hướng dẫn, Cây lấy sim, Cáp Type C\r\nBảo hành 12 tháng tại trung tâm bảo hành Chính hãng. 1 đổi 1 trong 30 ngày nếu có lỗi phần cứng từ nhà sản xuất.', 10000),
(3, 'macm1', 'Apple MacBook Air M1 256GB 2020', 18000000.00, 22000000.00, 2, '2024-05-20 17:13:43', '2024-05-22 01:26:29', 'Máy mới 100%, đầy đủ phụ kiện từ nhà sản xuất. Sản phẩm có mã SA/A (được Apple Việt Nam phân phối chính thức).\r\nMáy, Sách HDSD, Cáp sạc USB-C (2 m), Cốc sạc USB-C 30W', 3333),
(4, 'AA2', 'Tai nghe Bluetooth Apple AirPods 2', 3000000.00, 4000000.00, 3, '2024-05-22 01:28:27', '2024-05-22 01:28:27', 'Phản hồi nhanh hơn và tiết kiệm năng lượng nhờ vào con chip Apple H1\r\nThiết kế sang trọng, gọn nhẹ tạo cảm giác thoải mái khi đeo hàng giờ liền\r\nTích hợp 2 micro khử tiếng ồn cho chất lượng âm thanh tốt khi đàm thoại\r\nHỗ trợ công nghệ sạc nhanh, chỉ mất 15 phút là đã có ngay 3 giờ sử dụng', 100000),
(5, 'IP15', 'iPhone 15 Pro Max 256GB', 30000000.00, 35000000.00, 1, '2024-05-22 01:30:04', '2024-05-22 01:30:33', 'Thiết kế khung viền từ titan chuẩn hàng không vũ trụ - Cực nhẹ, bền cùng viền cạnh mỏng cầm nắm thoải mái\r\nHiệu năng Pro chiến game thả ga - Chip A17 Pro mang lại hiệu năng đồ họa vô cùng sống động và chân thực\r\nThoả sức sáng tạo và quay phim chuyên nghiệp - Cụm 3 camera sau đến 48MP và nhiều chế độ tiên tiến\r\nNút tác vụ mới giúp nhanh chóng kích hoạt tính năng yêu thích của bạn', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(11) NOT NULL,
  `first_login` int(11) DEFAULT 0,
  `activated` int(11) DEFAULT 0,
  `activation_token` varchar(255) DEFAULT NULL,
  `expiry_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `first_login`, `activated`, `activation_token`, `expiry_time`) VALUES
(2, 1, 1, NULL, '2024-05-21 16:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `avatar`, `fullname`, `username`, `password`, `email`, `phone`, `gender`, `role`, `status`) VALUES
(1, 'default_image.jpg', 'admin', 'admin', 'admin', 'admin@gmail.com', '111', '', 1, 0),
(2, 'z4471489775864_80a3bf6c83686820a48dc1a028ac4558.jpg', 'an', 'nguyenhoaan2021dt', '$2y$10$ZSQ.9WJXW/MwhFb0n0L.sup4fR.R7h7xY6WfWCn.nVXxI7sVGr8WK', 'nguyenhoaan2021dt@gmail.com', '567', 'female', 0, 0),
(3, 'default_image.jpg', 'staff1', 'staff1', 'staff1', 'staff1@gmail.com', '123456789', 'female', 0, 0),
(4, 'default_image.jpg', 'staff2', 'staff2', 'staff2', 'staff2@gmail.com', '123456789', 'male', 0, 0),
(5, 'default_image.jpg', 'staff3', 'staff3', 'staff3', 'staff3@gmail.com', '123456789', 'male', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `barcode` (`barcode`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
