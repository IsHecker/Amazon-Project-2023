-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2023 at 10:41 AM
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
-- Database: `amazon_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `seller_name` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(10) NOT NULL,
  `category` varchar(50) NOT NULL,
  `seller_id` int(10) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`seller_name`, `name`, `price`, `category`, `seller_id`, `product_id`, `created_at`) VALUES
('Ali', 'iPhone 15', '12353$', 'Phones', 1, 1, '2023-12-20 06:42:45'),
('Ali', 'TV 32', '800$', 'TVs', 1, 2, '2023-12-20 06:54:10'),
('Ali', 'Monitor', '234$', 'Screens', 1, 3, '2023-12-20 06:42:45'),
('cvcvbcv', 'first prod', '123$', 'fprod', 3, 5, '2023-12-20 09:38:44'),
('Ali', 'iPhone 16', '3453$', 'Phones', 1, 7, '2023-12-20 06:46:04'),
('Ali', 'Oppo Reno', '937$', 'Phones', 1, 11, '2023-12-20 09:10:51'),
('Ali', 'TV 65', '5674$', 'TVs', 1, 13, '2023-12-20 09:29:32'),
('Ali', 'TV 32', '4$', 'TVs', 1, 16, '2023-12-20 09:29:42');

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `reset_auto_increment` BEFORE INSERT ON `products` FOR EACH ROW BEGIN
  IF NEW.product_id IS NULL OR NEW.product_id = '' THEN
    SET NEW.product_id = NULL;
    SET NEW.product_id = NULL; -- Reset auto-increment column
  END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
