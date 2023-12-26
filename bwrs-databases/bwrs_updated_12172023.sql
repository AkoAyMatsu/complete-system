-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 17, 2023 at 12:15 PM
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
  `payment_id` bigint NOT NULL,
  PRIMARY KEY (`checkout_id`),
  KEY `test_user` (`user_id`),
  KEY `checkout_table` (`payment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10199911 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`checkout_id`, `checkout_date`, `total_items`, `overall_price`, `user_id`, `payment_id`) VALUES
(10168466, '12/17/2023', '1', '2600', 201638, 20595681),
(10109283, '12/17/2023', '2', '60', 201638, 20571335),
(10194318, '12/17/2023', '1', '2000', 201638, 20536525),
(10160937, '12/17/2023', '1', '5000', 201638, 20554040),
(10199070, '12/17/2023', '1', '2000', 201638, 20555433),
(10140662, '12/17/2023', '1', '3080', 201638, 20535262);

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
  `payment_id` bigint NOT NULL,
  PRIMARY KEY (`checkout_order_id`),
  KEY `test_user` (`user_id`),
  KEY `test_products` (`product_id`),
  KEY `test_checkout` (`checkout_id`),
  KEY `test_order` (`order_id`),
  KEY `checkout_order_table` (`payment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=464 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `checkout_order`
--

INSERT INTO `checkout_order` (`checkout_order_id`, `checkout_id`, `user_id`, `order_id`, `product_id`, `payment_id`) VALUES
(457, 10168466, 201638, 10026219, 133487, 20595681),
(455, 10194318, 201638, 10020300, 133486, 20536525),
(453, 10160937, 201638, 10003321, 133487, 20554040),
(451, 10199070, 201638, 10094847, 133486, 20555433),
(461, 10109283, 201638, 10061949, 133487, 20571335),
(460, 10109283, 201638, 10051576, 133486, 20571335),
(463, 10140662, 201638, 10009791, 133486, 20535262);

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
  `payment_id` bigint NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `test_user` (`user_id`),
  KEY `test_products` (`product_id`),
  KEY `customer_order_table` (`payment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10097147 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`order_id`, `order_status`, `total_price`, `order_quantity`, `product_id`, `user_id`, `order_type`, `order_date`, `payment_id`) VALUES
(10026219, 'Pending', '2600', '13', 133487, 201638, 'Borrow', '12/17/2023', 20595681),
(10020300, 'Pending', '2000', '10', 133486, 201638, 'Borrow', '12/17/2023', 20536525),
(10003321, 'Pending', '5000', '25', 133487, 201638, 'Borrow', '12/17/2023', 20554040),
(10094847, 'Pending', '2000', '10', 133486, 201638, 'Borrow', '12/17/2023', 20555433),
(10051576, 'Pending', '30', '1', 133486, 201638, 'Refill', '12/17/2023', 20571335),
(10061949, 'Pending', '30', '1', 133487, 201638, 'Refill', '12/17/2023', 20571335),
(10009791, 'Pending', '3080', '11', 133486, 201638, 'Buy', '12/17/2023', 20535262);

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
  `checkout_id` bigint NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `payment_table` (`checkout_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20599205 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_date`, `payment_type`, `payment_total`, `checkout_id`) VALUES
(20555433, '12/17/2023', 'Cash on Delivery', '2000', 10199070),
(20554040, '12/17/2023', 'Cash on Delivery', '5000', 10160937),
(20536525, '12/17/2023', 'Cash on Delivery', '2000', 10194318),
(20595681, '12/17/2023', 'Cash on Delivery', '2600', 10168466),
(20571335, '12/17/2023', 'Cash on Delivery', '60', 10109283),
(20535262, '12/17/2023', 'Cash on Delivery', '3080', 10140662);

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
