-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 06, 2024 at 06:14 AM
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
-- Database: `db_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(46, 47, 10, '2024-10-04 14:36:22', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(125, 46, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` longblob NOT NULL,
  `description` varchar(1000) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `image`, `description`, `quantity`) VALUES
(2, 'Mango Muffin', 10.00, 0x2e2e2f496d6167652f332e6a7067, ' <!-- Reduced rows -->\r\n                         rows                                                      ', 74),
(17, 'Butsi 1', 5.00, 0x2e2e2f496d6167652f312e4a5047, 'Indulge in our freshly baked bread, crafted with the finest ingredients to ensure delightful flavor in every bite. Place your order today and experience the warmth of homemade goodness delivered right to your doorstep!', 22),
(18, 'pandesal', 3.00, 0x2e2e2f496d6167652f612e6a7067, 'Mango muffins are a delicious blend of tropical sweetness and soft, moist texture, making them a perfect treat for breakfast or as a snack. Bursting with fresh mango flavor, these muffins are often enhanced with hints of coconut.', 41),
(21, 'Coconut Tarts', 10.00, 0x2e2e2f496d6167652f622e6a7067, 'a', 88),
(22, 'Spanish Bread', 5.00, 0x2e2e2f496d6167652f632e6a706567, 'ds', 37),
(23, 'Ensaymada', 5.00, 0x2e2e2f496d6167652f642e6a7067, 'asdad', 44),
(24, 'Pan de coco', 5.00, 0x2e2e2f496d6167652f652e6a706567, 'asd', 9),
(25, 'Hopia', 5.00, 0x2e2e2f496d6167652f662e6a706567, 'das', 0),
(27, 'd', 1.00, 0x2e2e2f496d6167652f312e504e47, 'd', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales_reports`
--

CREATE TABLE `sales_reports` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_sales` int(11) NOT NULL,
  `total_items_sold` int(11) NOT NULL,
  `report_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks_quantity`
--

CREATE TABLE `stocks_quantity` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity_added` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `total_sales` (
  `id` int(11) NOT NULL,
  `total_sales` int(11) NOT NULL,
  `report_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ifadmin` int(11) NOT NULL,
  `role` enum('admin','staff','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `customer_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `sales_reports`
--
ALTER TABLE `sales_reports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_ids` (`user_id`);

--
-- Indexes for table `stocks_quantity`
--
ALTER TABLE `stocks_quantity`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `total_sales`
--
ALTER TABLE `total_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `sales_reports`
--
ALTER TABLE `sales_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks_quantity`
--
ALTER TABLE `stocks_quantity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `total_sales`
--
ALTER TABLE `total_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

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
