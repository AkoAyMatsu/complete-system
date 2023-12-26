-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 16, 2023 at 12:26 PM
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
  `checkout_date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `total_items` varchar(255) NOT NULL,
  `overall_price` varchar(255) NOT NULL,
  `user_id` bigint NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  PRIMARY KEY (`checkout_id`),
  KEY `test_user` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10199018 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`checkout_id`, `checkout_date`, `total_items`, `overall_price`, `user_id`, `payment_type`) VALUES
(10155307, '12/16/2023', '2', '4800', 201638, ''),
(10145510, '12/16/2023', '2', '5760', 201638, ''),
(10127897, '12/16/2023', '1', '5040', 201638, ''),
(10136959, '12/16/2023', '2', '7440', 201638, ''),
(10194156, '12/16/2023', '2', '7440', 201638, ''),
(10169238, '12/16/2023', '2', '7440', 201638, ''),
(10194438, '12/16/2023', '2', '7440', 201638, ''),
(10130363, '12/16/2023', '2', '8640', 201638, ''),
(10150139, '12/16/2023', '2', '8640', 201638, ''),
(10162012, '12/16/2023', '2', '9600', 201638, ''),
(10170888, '12/16/2023', '2', '9600', 201638, ''),
(10112653, '12/16/2023', '2', '9600', 201638, ''),
(10118085, '12/16/2023', '2', '9600', 201638, ''),
(10150995, '12/16/2023', '2', '9600', 201638, ''),
(10198192, '12/16/2023', '2', '9600', 201638, ''),
(10161261, '12/16/2023', '2', '9600', 201638, ''),
(10183584, '12/16/2023', '2', '9600', 201638, ''),
(10153806, '12/16/2023', '2', '9600', 201638, ''),
(10197477, '12/16/2023', '2', '9600', 201638, ''),
(10193160, '12/16/2023', '2', '9600', 201638, ''),
(10104844, '12/16/2023', '2', '9600', 201638, ''),
(10143716, '12/16/2023', '2', '9600', 201638, ''),
(10138787, '12/16/2023', '2', '9600', 201638, ''),
(10169755, '12/16/2023', '2', '9600', 201638, ''),
(10187823, '12/16/2023', '2', '9600', 201638, ''),
(10126390, '12/16/2023', '2', '13000', 201638, '');

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
  `payment_type` varchar(100) NOT NULL,
  PRIMARY KEY (`checkout_order_id`),
  KEY `test_user` (`user_id`),
  KEY `test_products` (`product_id`),
  KEY `test_checkout` (`checkout_id`),
  KEY `test_order` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=286 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `checkout_order`
--

INSERT INTO `checkout_order` (`checkout_order_id`, `checkout_id`, `user_id`, `order_id`, `product_id`, `payment_type`) VALUES
(235, 10155307, 201638, 10068199, 133486, ''),
(236, 10155307, 201638, 10059457, 133487, ''),
(237, 10145510, 201638, 10068199, 133486, ''),
(238, 10145510, 201638, 10059457, 133487, ''),
(239, 10127897, 201638, 10059457, 133487, ''),
(240, 10136959, 201638, 10068199, 133486, ''),
(241, 10136959, 201638, 10059457, 133487, ''),
(242, 10194156, 201638, 10068199, 133486, ''),
(243, 10194156, 201638, 10059457, 133487, ''),
(244, 10169238, 201638, 10068199, 133486, ''),
(245, 10169238, 201638, 10059457, 133487, ''),
(246, 10194438, 201638, 10068199, 133486, ''),
(247, 10194438, 201638, 10059457, 133487, ''),
(248, 10130363, 201638, 10068199, 133486, ''),
(249, 10130363, 201638, 10059457, 133487, ''),
(250, 10150139, 201638, 10068199, 133486, ''),
(251, 10150139, 201638, 10059457, 133487, ''),
(252, 10162012, 201638, 10068199, 133486, ''),
(253, 10162012, 201638, 10059457, 133487, ''),
(254, 10170888, 201638, 10068199, 133486, ''),
(255, 10170888, 201638, 10059457, 133487, ''),
(256, 10112653, 201638, 10068199, 133486, ''),
(257, 10112653, 201638, 10059457, 133487, ''),
(258, 10118085, 201638, 10068199, 133486, ''),
(259, 10118085, 201638, 10059457, 133487, ''),
(260, 10150995, 201638, 10068199, 133486, ''),
(261, 10150995, 201638, 10059457, 133487, ''),
(262, 10198192, 201638, 10068199, 133486, ''),
(263, 10198192, 201638, 10059457, 133487, ''),
(264, 10161261, 201638, 10068199, 133486, ''),
(265, 10161261, 201638, 10059457, 133487, ''),
(266, 10183584, 201638, 10068199, 133486, ''),
(267, 10183584, 201638, 10059457, 133487, ''),
(268, 10153806, 201638, 10068199, 133486, ''),
(269, 10153806, 201638, 10059457, 133487, ''),
(270, 10197477, 201638, 10068199, 133486, ''),
(271, 10197477, 201638, 10059457, 133487, ''),
(272, 10193160, 201638, 10068199, 133486, ''),
(273, 10193160, 201638, 10059457, 133487, ''),
(274, 10104844, 201638, 10068199, 133486, ''),
(275, 10104844, 201638, 10059457, 133487, ''),
(276, 10143716, 201638, 10068199, 133486, ''),
(277, 10143716, 201638, 10059457, 133487, ''),
(278, 10138787, 201638, 10068199, 133486, ''),
(279, 10138787, 201638, 10059457, 133487, ''),
(280, 10169755, 201638, 10068199, 133486, ''),
(281, 10169755, 201638, 10059457, 133487, ''),
(282, 10187823, 201638, 10068199, 133486, ''),
(283, 10187823, 201638, 10059457, 133487, ''),
(284, 10126390, 201638, 10068199, 133486, ''),
(285, 10126390, 201638, 10059457, 133487, '');

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
(201638, 'Arthur', 'Nery', 'Manila City, Philippines', '09683513963', 'ArthurNery', 'arthur_nery', 'Customer', '../../bwrs/sample_images/CUSTOMER501_04368_arthur_nery_1.jpg'),
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
) ENGINE=MyISAM AUTO_INCREMENT=10088631 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`order_id`, `order_status`, `total_price`, `order_quantity`, `product_id`, `user_id`, `order_type`, `order_date`) VALUES
(10068199, 'In Cart', '6000', '30', 133486, 201638, 'Borrow', '12/16/2023'),
(10059457, 'In Cart', '7000', '25', 133487, 201638, 'Buy', '12/16/2023');

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
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `payment_date` varchar(100) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `payment_total` varchar(100) NOT NULL,
  PRIMARY KEY (`payment_id`)
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
