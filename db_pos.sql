-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 06, 2024 at 08:22 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `total` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `customer_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `date`, `status`) VALUES
(1, 36, 1, '2024-09-28 23:42:04', ''),
(2, 36, 64, '2024-09-28 23:46:59', ''),
(3, 37, 17, '2024-09-29 01:14:32', ''),
(4, 37, 56, '2024-09-29 01:15:18', ''),
(5, 37, 14, '2024-09-29 01:16:09', ''),
(6, 37, 56, '2024-09-29 01:32:41', ''),
(21, 36, 10, '2024-09-29 02:56:58', ''),
(35, 46, 16, '2024-10-04 11:27:45', ''),
(36, 46, 13, '2024-10-04 11:28:41', ''),
(37, 46, 10, '2024-10-04 11:32:00', ''),
(38, 36, 3, '2024-10-04 11:39:47', ''),
(39, 36, 13, '2024-10-04 11:55:58', 'completed'),
(40, 36, 13, '2024-10-04 13:01:44', 'completed'),
(41, 36, 10, '2024-10-04 13:22:55', 'completed'),
(42, 36, 55, '2024-10-04 13:23:22', 'completed'),
(43, 36, 10, '2024-10-04 13:53:40', 'Pending'),
(44, 36, 20, '2024-10-04 14:09:28', 'completed'),
(45, 36, 5, '2024-10-04 14:09:33', 'Pending'),
(46, 47, 10, '2024-10-04 14:36:22', 'completed'),
(47, 36, 40, '2024-10-06 05:07:09', 'completed'),
(48, 36, 10, '2024-10-06 05:07:16', 'Pending'),
(49, 36, 10, '2024-10-06 05:31:23', 'Pending'),
(50, 47, 10, '2024-10-06 05:37:14', 'Pending'),
(51, 36, 5, '2024-10-06 05:47:50', 'Pending'),
(52, 36, 10, '2024-10-06 07:14:31', 'completed'),
(53, 36, 6, '2024-10-06 07:17:29', 'completed'),
(54, 36, 10, '2024-10-06 07:17:53', 'completed'),
(55, 36, 10, '2024-10-06 07:22:53', 'completed'),
(56, 36, 10, '2024-10-06 07:23:23', 'completed'),
(57, 36, 10, '2024-10-06 07:26:24', 'completed'),
(58, 36, 10, '2024-10-06 07:48:42', 'completed'),
(59, 36, 20, '2024-10-06 07:51:52', 'completed'),
(60, 36, 10, '2024-10-06 07:52:08', 'completed'),
(61, 36, 10, '2024-10-06 07:59:26', 'completed'),
(62, 36, 5, '2024-10-06 08:00:28', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `product_id` (`product_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 1, 21, 1),
(20, 2, 2, 2),
(21, 2, 22, 1),
(22, 2, 24, 3),
(100, 35, 18, 2),
(101, 35, 21, 1),
(102, 36, 18, 1),
(103, 36, 21, 1),
(104, 37, 21, 1),
(105, 38, 18, 1),
(108, 39, 18, 1),
(109, 39, 21, 1),
(110, 40, 17, 2),
(111, 40, 18, 1),
(114, 41, 21, 1),
(115, 42, 21, 4),
(116, 42, 24, 3),
(117, 43, 2, 1),
(121, 44, 2, 2),
(124, 45, 24, 1),
(125, 46, 2, 1),
(129, 47, 21, 4),
(130, 48, 21, 1),
(131, 49, 21, 1),
(132, 50, 21, 1),
(133, 51, 24, 1),
(134, 52, 21, 1),
(136, 53, 18, 2),
(137, 54, 21, 1),
(138, 55, 21, 1),
(139, 56, 21, 1),
(140, 57, 21, 1),
(141, 58, 21, 1),
(142, 59, 21, 2),
(143, 60, 21, 1),
(144, 61, 21, 1),
(145, 62, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` longblob NOT NULL,
  `description` varchar(1000) NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `image`, `description`, `quantity`) VALUES
(2, 'Mango Muffin', '10.00', 0x2e2e2f496d6167652f332e6a7067, ' <!-- Reduced rows -->\r\n                         rows                                                      ', 74),
(17, 'Butsi 1', '5.00', 0x2e2e2f496d6167652f312e4a5047, 'Indulge in our freshly baked bread, crafted with the finest ingredients to ensure delightful flavor in every bite. Place your order today and experience the warmth of homemade goodness delivered right to your doorstep!', 22),
(18, 'pandesal', '3.00', 0x2e2e2f496d6167652f612e6a7067, 'Mango muffins are a delicious blend of tropical sweetness and soft, moist texture, making them a perfect treat for breakfast or as a snack. Bursting with fresh mango flavor, these muffins are often enhanced with hints of coconut.', 38),
(21, 'Coconut Tarts', '10.00', 0x2e2e2f496d6167652f622e6a7067, 'a', 57),
(22, 'Spanish Bread', '5.00', 0x2e2e2f496d6167652f632e6a706567, 'ds', 37),
(23, 'Ensaymada', '5.00', 0x2e2e2f496d6167652f642e6a7067, 'asdad', 44),
(24, 'Pan de coco', '5.00', 0x2e2e2f496d6167652f652e6a706567, 'asd', 8),
(25, 'Hopia', '5.00', 0x2e2e2f496d6167652f662e6a706567, 'das', 0),
(27, 'd', '1.00', 0x2e2e2f496d6167652f312e504e47, 'd', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales_reports`
--

DROP TABLE IF EXISTS `sales_reports`;
CREATE TABLE IF NOT EXISTS `sales_reports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `total_sales` int NOT NULL,
  `total_items_sold` int NOT NULL,
  `report_date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `user_ids` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks_quantity`
--

DROP TABLE IF EXISTS `stocks_quantity`;
CREATE TABLE IF NOT EXISTS `stocks_quantity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `quantity_added` int NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stocks_quantity`
--

INSERT INTO `stocks_quantity` (`id`, `product_id`, `user_id`, `quantity_added`, `date`) VALUES
(2, 2, 36, 10, '2024-10-04 22:47:34'),
(3, 2, 36, 5, '2024-10-04 22:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `total_sales`
--

DROP TABLE IF EXISTS `total_sales`;
CREATE TABLE IF NOT EXISTS `total_sales` (
  `id` int NOT NULL AUTO_INCREMENT,
  `total_sales` int NOT NULL,
  `report_date` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ifadmin` int NOT NULL,
  `role` enum('admin','staff','','') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `ifadmin`, `role`) VALUES
(36, 'jessie james', 'parajes', 'admin', '$2y$10$BCDnqcn6Q.uPd8dWbJc6DugLH.rannVBY2tQfzDGiVNox9UVC4ORe', 1, 'admin'),
(37, 'Test', 'Admin', 'Test', 'staff4213', 0, 'admin'),
(46, 'Thomas ', 'Bishop ', 'jj', '$2y$10$f0n1b4IggvWLHurP8Rd4cuh01ScmbNouD9WrWjBD9C9MZMvu6K6tO', 0, 'staff'),
(47, 'Scarlett', 'Case', 'staff', '$2y$10$gL3/9YJCE1qa3cWJr0Uxy.ZJIRVVx.Yb6dRtsK6U7oVop04Fp1P7a', 0, 'staff'),
(48, 'Lila', 'Todd', 'staff1', '$2y$10$q/FkXDzUhBC9SZvbqkaSvucNRVgdxvc1dWZyIpJXT.t1uCZzrQM4e', 0, 'staff');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `sales_reports`
--
ALTER TABLE `sales_reports`
  ADD CONSTRAINT `user_ids` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `stocks_quantity`
--
ALTER TABLE `stocks_quantity`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
