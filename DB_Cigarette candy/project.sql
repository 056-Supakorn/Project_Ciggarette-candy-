-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2025 at 04:48 PM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `created_at`, `status`) VALUES
(1, NULL, 60.00, '2025-03-18 04:42:03', 'กำลังดำเนินการ'),
(2, NULL, 20.00, '2025-03-18 04:47:12', 'dony'),
(3, NULL, 40.00, '2025-03-19 07:06:42', 'จัดสำเร็จ'),
(4, NULL, 200.00, '2025-03-19 15:06:38', 'จัดส่งสำเร็จ'),
(5, NULL, 200.00, '2025-03-19 15:13:01', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_name`, `quantity`, `price`) VALUES
(1, 1, 'ลูกอมรสสตรอเบอร์รี่', 3, 20.00),
(2, 2, 'ลูกอมรสสตรอเบอร์รี่', 1, 20.00),
(3, 3, 'ลูกอมรสสตรอเบอร์รี่', 2, 20.00),
(4, 4, 'ลูกอมรสสตรอเบอร์รี่', 4, 50.00),
(5, 5, 'ลูกอมรสสตรอเบอร์รี่', 4, 50.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image_path`) VALUES
(4, 'ลูกอมรสสตรอเบอร์รี่', 'adad', 2000.00, 'img/1.png'),
(5, 'ลูกอมรสช็อกโกแลต', 'ลูกอมรสช็อกโกแลตเข้มข้น', 25.00, 'img/2.png'),
(6, 'ลูกอมรสมินต์', 'ลูกอมรสมินต์สดชื่น', 50.00, 'img/3.png'),
(7, 'ลูกอมรสสตรอเบอร์รี่', 'ลูกอมรสสตรอเบอร์รี่อร่อย', 20.00, 'img/1.png'),
(8, 'ลูกอมรสช็อกโกแลต', 'ลูกอมรสช็อกโกแลตเข้มข้น', 25.00, 'img/2.png'),
(30, 'ลูกอมเลิกบุหรี่ (LIMITED EDT)', 'yummy', 60.00, 'img/gg.png'),
(31, 'ลูกอมเลิกบุหรี่ (LIMITED EDT gold)', 'very yummy', 120.00, 'img/2.png'),
(32, 'ลูกอมเลิกบุหรี่ (LIMITED)', 'yoummy', 30.00, 'img/2.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(6, 'testuser1', '$2y$10$m.h5m2h0bM8AIiUYJOc/9.CnRaVeNJIac0AtBaDBvNlW/V14GrNEK', 'saaa@gmail.com'),
(7, 'test1', '1234', 'swa@gmail.com'),
(14, 'te', '1234', 'te@gmail.com'),
(16, 'se', '1234', 'se@gmail.com'),
(17, 'fe', '4321', 'fe@gmail.com'),
(18, 'id', '1234', 'id@gmail.com'),
(19, 'admin', '1234', 'admin@gmail.com'),
(20, 're', '1234', 're@gmail.com'),
(21, 'tr', '1234', 'tr@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
