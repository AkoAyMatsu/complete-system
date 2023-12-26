-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 11, 2023 at 04:56 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bwrs`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

DROP TABLE IF EXISTS `checkout`;
CREATE TABLE IF NOT EXISTS `checkout` (
  `checkout_id` bigint NOT NULL AUTO_INCREMENT,
  `checkout_date` varchar(255) NOT NULL,
  `total_items` varchar(255) NOT NULL,
  `overall_price` varchar(255) NOT NULL,
  `order_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  PRIMARY KEY (`checkout_id`),
  KEY `test_customer_order` (`order_id`),
  KEY `test_user` (`user_id`),
  KEY `product_table` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checkout_order`
--

DROP TABLE IF EXISTS `checkout_order`;
CREATE TABLE IF NOT EXISTS `checkout_order` (
  `checkout_order_id` bigint NOT NULL AUTO_INCREMENT,
  `checkout_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `order_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  PRIMARY KEY (`checkout_order_id`),
  KEY `test_user` (`user_id`),
  KEY `test_products` (`product_id`),
  KEY `test_checkout` (`checkout_id`),
  KEY `test_order` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `user_id` bigint NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `con_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_role` enum('Customer') NOT NULL,
  `user_image` text NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `con_number` (`con_number`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=201992 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='table for customer information';

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`user_id`, `firstname`, `lastname`, `address`, `con_number`, `username`, `password`, `user_role`, `user_image`) VALUES
(201638, 'Arthur', 'Nery', 'Manila City, Philippines', '09683513963', 'ArthurNery', 'arthur_nery', 'Customer', '../../bwrs/sample_images/CUSTOMER501_41324_arthur_nery_1.jpg'),
(201370, 'Ralph Matthew', 'Aquino', 'Patac Sto.Tomas, La Union', '09683513965', 'AkoAyMatsu', 'akoaymatsu_053101', 'Customer', 'sample_images/CUSTOMER201_89315_arthur_nery.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

DROP TABLE IF EXISTS `customer_order`;
CREATE TABLE IF NOT EXISTS `customer_order` (
  `order_id` bigint NOT NULL AUTO_INCREMENT,
  `order_status` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `order_quantity` varchar(255) NOT NULL,
  `product_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `order_type` varchar(255) NOT NULL,
  `order_date` varchar(255) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `test_user` (`user_id`),
  KEY `test_products` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10079648 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`order_id`, `order_status`, `total_price`, `order_quantity`, `product_id`, `user_id`, `order_type`, `order_date`) VALUES
(10022869, 'In Cart', '3640', '13', 133487, 201638, 'Buy', '12/11/2023'),
(10079647, 'In Cart', '3600', '18', 133486, 201638, 'Borrow', '12/11/2023');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `user_id` bigint NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `con_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` enum('Employee') NOT NULL,
  `user_image` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` bigint NOT NULL,
  `product_img` text NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `product_quantity` varchar(255) NOT NULL,
  `product_buy_price` varchar(255) NOT NULL,
  `product_refill_price` varchar(255) NOT NULL,
  `product_borrow_price` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_img`, `product_type`, `product_quantity`, `product_buy_price`, `product_refill_price`, `product_borrow_price`) VALUES
(133486, 'sample_images/rounded-gallon.jpeg', '18L Rounded Gallon Water', '1000', '280.00', '30.00', '200.00'),
(133487, 'sample_images/slim-gallon.jpg', '20L Slim Gallon Water', '1000', '280.00', '30.00', '200.00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
