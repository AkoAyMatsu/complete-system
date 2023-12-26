-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 21, 2023 at 06:23 PM
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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `user_id` bigint NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `con_number` varchar(100) NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_image` text NOT NULL,
  `user_role` enum('Administrator') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `con_number` (`con_number`),
  UNIQUE KEY `admin_username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=15199272 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `firstname`, `lastname`, `address`, `con_number`, `username`, `password`, `user_image`, `user_role`) VALUES
(15199271, 'Admin', 'Admin', 'Bani, Rosario, La Union', '09999999991', 'bani_administrator_101', 'administrator_101', '../../bwrs/sample_images/admin.png', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `cancellation`
--

DROP TABLE IF EXISTS `cancellation`;
CREATE TABLE IF NOT EXISTS `cancellation` (
  `cancellation_id` bigint NOT NULL AUTO_INCREMENT,
  `cancellation_date` varchar(50) NOT NULL,
  `order_id` bigint NOT NULL,
  `checkout_id` bigint NOT NULL,
  `payment_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  PRIMARY KEY (`cancellation_id`),
  KEY `checkout_table` (`checkout_id`),
  KEY `order_table` (`order_id`),
  KEY `payment_table` (`payment_id`),
  KEY `customer_table` (`user_id`),
  KEY `product_table` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(10185615, '12/21/2023', '1', '3200.00', 201638, 20591421),
(10112209, '12/21/2023', '1', '2000.00', 201370, 20511386),
(10132377, '12/21/2023', '1', '4000.00', 201638, 20523066),
(10154411, '12/21/2023', '1', '2800.00', 201370, 20553129),
(10177185, '12/21/2023', '1', '750.00', 201638, 20593789),
(10132929, '12/21/2023', '1', '2000.00', 201707, 20535476);

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
) ENGINE=MyISAM AUTO_INCREMENT=544 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `checkout_order`
--

INSERT INTO `checkout_order` (`checkout_order_id`, `checkout_id`, `user_id`, `order_id`, `product_id`, `payment_id`) VALUES
(541, 10132377, 201638, 10018642, 133487, 20523066),
(538, 10177185, 201638, 10047772, 133487, 20593789),
(543, 10185615, 201638, 10054026, 133486, 20591421),
(542, 10112209, 201370, 10015181, 133486, 20511386),
(540, 10154411, 201370, 10088987, 133486, 20553129),
(539, 10132929, 201707, 10099107, 133486, 20535476);

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
(201638, 'Arthur', 'Nery', 'Manila City, Philippines', '09683513963', 'ArthurNery', 'arthur_nery', 'Customer', '../../bwrs/sample_images/CUSTOMER501_90654_arthur_nery.jpg'),
(201370, 'Ralph Matthew', 'Aquino', 'Patac Sto.Tomas, La Union', '09683513965', 'AkoAyMatsu', 'akoaymatsu_053101', 'Customer', '../../bwrs/sample_images/CUSTOMER501_64466_arthur_nery_1.jpg'),
(201707, 'Clarence', 'Aquino', 'Patac Sto.Tomas, La Union', '09567853423', 'CAquino_29', 'caquino_29', 'Customer', 'sample_images/CUSTOMER201_38144_admin.png');

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
) ENGINE=MyISAM AUTO_INCREMENT=10099245 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`order_id`, `order_status`, `total_price`, `order_quantity`, `product_id`, `user_id`, `order_type`, `order_date`, `payment_id`) VALUES
(10026328, 'Cancelled', '2400.00', '12', 133487, 201638, 'Borrow', '12/20/2023', 20541757),
(10033921, 'Cancelled', '280.00', '1', 133486, 201638, 'Buy', '12/20/2023', 20590851),
(10059246, 'Cancelled', '4200.00', '15', 133486, 201638, 'Buy', '12/20/2023', 20565899),
(10013670, 'Cancelled', '1680.00', '6', 133486, 201638, 'Buy', '12/20/2023', 20529569),
(10021711, 'Cancelled', '400.00', '2', 133487, 201638, 'Borrow', '12/20/2023', 20538578),
(10039537, 'Cancelled', '3000.00', '15', 133486, 201638, 'Borrow', '12/20/2023', 20569069),
(10018071, 'Cancelled', '1680.00', '6', 133486, 201638, 'Buy', '12/20/2023', 20554392),
(10054256, 'Cancelled', '4000', '20', 133487, 201638, 'Borrow', '12/20/2023', 20542237),
(10049004, 'Cancelled', '8000', '40', 133486, 201638, 'Borrow', '12/20/2023', 20503744),
(10029288, 'Cancelled', '560.00', '2', 133486, 201638, 'Buy', '12/20/2023', 20547211),
(10022952, 'Cancelled', '3400.00', '17', 133486, 201638, 'Borrow', '12/20/2023', 20504163),
(10026835, 'Cancelled', '2800.00', '10', 133486, 201638, 'Buy', '12/20/2023', 20588883),
(10008175, 'Cancelled', '330.00', '11', 133487, 201638, 'Refill', '12/20/2023', 20570544),
(10039711, 'Cancelled', '3920.00', '14', 133487, 201638, 'Buy', '12/20/2023', 20533090),
(10052813, 'Cancelled', '240.00', '8', 133486, 201638, 'Refill', '12/20/2023', 20507731),
(10060159, 'Cancelled', '5600.00', '20', 133486, 201638, 'Buy', '12/21/2023', 20522179),
(10001291, 'Cancelled', '1400.00', '5', 133486, 201638, 'Buy', '12/21/2023', 20567174),
(10061158, 'Cancelled', '2800.00', '10', 133486, 201638, 'Buy', '12/21/2023', 20578940),
(10093655, 'Cancelled', '3000.00', '15', 133486, 201638, 'Borrow', '12/21/2023', 20531629),
(10090605, 'Cancelled', '8400.00', '30', 133486, 201707, 'Buy', '12/21/2023', 20565724),
(10051698, 'Cancelled', '5880', '21', 133486, 201707, 'Buy', '12/21/2023', 20572692),
(10030076, 'Cancelled', '630', '21', 133487, 201707, 'Refill', '12/21/2023', 20572692),
(10047772, 'To receive', '750.00', '25', 133487, 201638, 'Refill', '12/22/2023', 20593789),
(10099107, 'In transit', '2000.00', '10', 133486, 201707, 'Borrow', '12/21/2023', 20535476),
(10088987, 'To receive', '2800.00', '10', 133486, 201370, 'Buy', '12/22/2023', 20553129),
(10018642, 'To receive', '4000.00', '20', 133487, 201638, 'Borrow', '12/22/2023', 20523066),
(10015181, 'In transit', '2000.00', '10', 133486, 201370, 'Borrow', '12/21/2023', 20511386),
(10054026, 'To receive', '3200.00', '16', 133486, 201638, 'Borrow', '12/22/2023', 20591421);

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
(20591421, '12/21/2023', 'Cash on Delivery', '3200.00', 10185615),
(20523066, '12/21/2023', 'Cash on Delivery', '4000.00', 10132377),
(20511386, '12/21/2023', 'Cash on Delivery', '2000.00', 10112209),
(20593789, '12/21/2023', 'Cash on Delivery', '750.00', 10177185),
(20535476, '12/21/2023', 'Cash on Delivery', '2000.00', 10132929),
(20553129, '12/21/2023', 'Cash on Delivery', '2800.00', 10154411);

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
