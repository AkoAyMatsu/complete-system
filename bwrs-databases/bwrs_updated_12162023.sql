-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 15, 2023 at 04:25 PM
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
  PRIMARY KEY (`checkout_id`),
  KEY `test_user` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10199018 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`checkout_id`, `checkout_date`, `total_items`, `overall_price`, `user_id`) VALUES
(10191614, '12/16/2023', '2', '15880', 201638),
(10159033, '12/16/2023', '2', '13000', 201638),
(10165797, '12/16/2023', '2', '13000', 201638),
(10196816, '12/16/2023', '2', '13000', 201638),
(10109870, '12/16/2023', '2', '12200', 201638),
(10121158, '12/16/2023', '2', '12200', 201638),
(10185801, '12/16/2023', '1', '5600', 201638),
(10134433, '12/16/2023', '2', '12200', 201638),
(10136718, '12/16/2023', '2', '12200', 201638),
(10119465, '12/16/2023', '2', '13600', 201638),
(10106258, '12/16/2023', '2', '13600', 201638),
(10176805, '12/16/2023', '1', '8000', 201638),
(10156328, '12/16/2023', '1', '8000', 201638),
(10188927, '12/15/2023', '2', '16600', 201638),
(10153392, '12/15/2023', '1', '5600', 201638),
(10176943, '12/15/2023', '1', '11000', 201638),
(10102118, '12/15/2023', '1', '11000', 201638),
(10157517, '12/15/2023', '2', '16600', 201638),
(10186872, '12/15/2023', '1', '11000', 201638),
(10196267, '12/15/2023', '2', '16600', 201638),
(10141573, '12/15/2023', '2', '16600', 201638),
(10108415, '12/15/2023', '2', '16600', 201638),
(10183216, '12/15/2023', '1', '11000', 201638),
(10196504, '12/15/2023', '1', '10600', 201638);

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
) ENGINE=MyISAM AUTO_INCREMENT=219 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `checkout_order`
--

INSERT INTO `checkout_order` (`checkout_order_id`, `checkout_id`, `user_id`, `order_id`, `product_id`) VALUES
(218, 10191614, 201638, 10021394, 133487),
(217, 10191614, 201638, 10054325, 133486),
(216, 10159033, 201638, 10021394, 133487),
(215, 10159033, 201638, 10054325, 133486),
(214, 10165797, 201638, 10021394, 133487),
(213, 10165797, 201638, 10054325, 133486),
(212, 10196816, 201638, 10021394, 133487),
(211, 10196816, 201638, 10054325, 133486),
(210, 10109870, 201638, 10021394, 133487),
(209, 10109870, 201638, 10054325, 133486),
(208, 10121158, 201638, 10021394, 133487),
(207, 10121158, 201638, 10054325, 133486),
(206, 10185801, 201638, 10021394, 133487),
(205, 10134433, 201638, 10021394, 133487),
(204, 10134433, 201638, 10054325, 133486),
(203, 10136718, 201638, 10021394, 133487),
(202, 10136718, 201638, 10054325, 133486),
(201, 10119465, 201638, 10021394, 133487),
(200, 10119465, 201638, 10054325, 133486),
(199, 10106258, 201638, 10021394, 133487),
(198, 10106258, 201638, 10054325, 133486),
(197, 10176805, 201638, 10054325, 133486),
(196, 10156328, 201638, 10054325, 133486),
(195, 10188927, 201638, 10021394, 133487),
(194, 10188927, 201638, 10054325, 133486),
(193, 10153392, 201638, 10021394, 133487),
(192, 10176943, 201638, 10054325, 133486),
(191, 10102118, 201638, 10054325, 133486),
(190, 10157517, 201638, 10021394, 133487),
(189, 10157517, 201638, 10054325, 133486),
(188, 10186872, 201638, 10054325, 133486),
(187, 10196267, 201638, 10021394, 133487),
(186, 10196267, 201638, 10054325, 133486),
(185, 10141573, 201638, 10021394, 133487),
(184, 10141573, 201638, 10054325, 133486),
(183, 10108415, 201638, 10021394, 133487),
(182, 10108415, 201638, 10054325, 133486),
(181, 10183216, 201638, 10054325, 133486),
(180, 10196504, 201638, 10054325, 133486);

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
) ENGINE=MyISAM AUTO_INCREMENT=10079648 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`order_id`, `order_status`, `total_price`, `order_quantity`, `product_id`, `user_id`, `order_type`, `order_date`) VALUES
(10021394, 'In Cart', '7280', '26', 133487, 201638, 'Buy', '12/12/2023'),
(10054325, 'In Cart', '8600', '43', 133486, 201638, 'Borrow', '12/12/2023');

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
