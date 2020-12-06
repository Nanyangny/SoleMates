-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 13, 2020 at 05:15 AM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `f36ee`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `question` varchar(150) NOT NULL,
  `answer` varchar(500) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `category` char(10) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(30) DEFAULT NULL,
  `display` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`question`, `answer`, `username`, `category`, `id`, `email`, `display`) VALUES
('What should I do if my order hasn''t been delivered yet?', 'SoleMates is a customer-centered web portal for online purchase of sports shoes for sports enthusiasts, especially the young. It allows them to browse through various types of sports shoes through search and categories filtering. Top sellers are featured to inform customers about shoes'' popularity. This online purchase portal allows the potential buyers to customize orders and add shoes of their choice to the shopping cart.', '0', 'Delivery', 3, NULL, 1),
('How can I find your international delivery information?', 'SoleMates is a customer-centered web portal for online purchase of sports shoes for sports enthusiasts, especially the young. It allows them to browse through various types of sports shoes through search and categories filtering. Top sellers are featured to inform customers about shoes'' popularity. This online purchase portal allows the potential buyers to customize orders and add shoes of their choice to the shopping cart.', '0', 'Delivery', 4, NULL, 1),
('Who takes care of shipping?', 'SoleMates is a customer-centered web portal for online purchase of sports shoes for sports enthusiasts, especially the young. It allows them to browse through various types of sports shoes through search and categories filtering. Top sellers are featured to inform customers about shoes'' popularity. This online purchase portal allows the potential buyers to customize orders and add shoes of their choice to the shopping cart.', '0', 'Delivery', 5, NULL, 1),
('How do returns or refunds work?', 'SoleMates is a customer-centered web portal for online purchase of sports shoes for sports enthusiasts, especially the young. It allows them to browse through various types of sports shoes through search and categories filtering. Top sellers are featured to inform customers about shoes'' popularity. This online purchase portal allows the potential buyers to customize orders and add shoes of their choice to the shopping cart.', '0', 'Delivery', 6, NULL, 1),
('When will my order arrive?', 'SoleMates is a customer-centered web portal for online purchase of sports shoes for sports enthusiasts, especially the young. It allows them to browse through various types of sports shoes through search and categories filtering. Top sellers are featured to inform customers about shoes'' popularity. This online purchase portal allows the potential buyers to customize orders and add shoes of their choice to the shopping cart.', '0', 'Delivery', 7, NULL, 1),
('Why did my credit card or PayPal payment fail?', 'SoleMates is a customer-centered web portal for online purchase of sports shoes for sports enthusiasts, especially the young. It allows them to browse through various types of sports shoes through search and categories filtering. Top sellers are featured to inform customers about shoes'' popularity. This online purchase portal allows the potential buyers to customize orders and add shoes of their choice to the shopping cart.', '0', 'Payments', 11, NULL, 1),
('Why does my bank statement show multiple charges for one upgrade?', 'SoleMates is a customer-centered web portal for online purchase of sports shoes for sports enthusiasts, especially the young. It allows them to browse through various types of sports shoes through search and categories filtering. Top sellers are featured to inform customers about shoes'' popularity. This online purchase portal allows the potential buyers to customize orders and add shoes of their choice to the shopping cart.', '0', 'Payments', 12, NULL, 1),
('How do I delete my account?', 'SoleMates is a customer-centered web portal for online purchase of sports shoes for sports enthusiasts, especially the young. It allows them to browse through various types of sports shoes through search and categories filtering. Top sellers are featured to inform customers about shoes'' popularity. This online purchase portal allows the potential buyers to customize orders and add shoes of their choice to the shopping cart.', '0', 'Account', 14, NULL, 1),
('I forgot my password. How do I reset it?', 'SoleMates is a customer-centered web portal for online purchase of sports shoes for sports enthusiasts, especially the young. It allows them to browse through various types of sports shoes through search and categories filtering. Top sellers are featured to inform customers about shoes'' popularity. This online purchase portal allows the potential buyers to customize orders and add shoes of their choice to the shopping cart.', '0', 'Account', 16, NULL, 1),
('How to purchase a pair of customized shoes?', 'You can check out our website for the instructions.Thank you!', 'Jane', 'Basic', 21, 'abcd@gmail.com', 1),
('Why did my credit card or PayPal payment fail?', 'SoleMates is a customer-centered web portal for online purchase of sports shoes for sports enthusiasts, especially the young. It allows them to browse through various types of sports shoes through search and categories filtering. Top sellers are featured to inform customers about shoesâ€™ popularity. This online purchase portal allows the potential buyers to customize orders and add shoes of their choice to the shopping cart.', 'admin', 'Basic', 24, NULL, 1),
('How do I change my password?', 'You can contact us via email for the update on your password.', 'admin', 'Basic', 25, NULL, 1),
('How to check the delivery status?', NULL, 'nanyang', 'Basic', 26, 'abcd@gmail.com', 0),
('How to check whether the payment is successful?', NULL, 'nanyang', 'Basic', 27, 'asd@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL,
  `user` int(10) NOT NULL,
  `product` int(10) NOT NULL,
  `size` float NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `order_time` datetime NOT NULL,
  KEY `user` (`user`),
  KEY `product` (`product`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user`, `product`, `size`, `qty`, `price`, `order_time`) VALUES
(1, 1, 1, 7, 1, 260, '2020-10-30 16:01:09'),
(2, 1, 1, 7, 1, 260, '2020-10-30 16:01:09'),
(3, 1, 1, 7, 1, 260, '2020-10-30 16:01:09'),
(4, 1, 1, 12, 1, 260, '2020-10-30 16:01:09'),
(5, 1, 1, 12, 1, 260, '2020-10-30 16:01:09'),
(6, 1, 1, 11.5, 1, 260, '2020-10-30 16:01:09'),
(7, 1, 1, 11.5, 1, 260, '2020-10-30 16:01:09'),
(8, 1, 1, 11.5, 1, 260, '2020-10-30 16:01:09'),
(9, 1, 1, 8, 2, 260, '2020-10-30 16:01:09'),
(10, 1, 1, 8, 2, 260, '2020-10-30 16:01:09'),
(11, 1, 2, 7.5, 1, 240, '2020-10-30 16:01:09'),
(12, 1, 2, 11.5, 1, 240, '2020-10-30 16:01:09'),
(12, 1, 2, 11.5, 1, 240, '2020-10-30 16:01:09'),
(12, 1, 6, 10.5, 1, 260, '2020-10-30 16:01:09'),
(13, 1, 1, 7, 1, 260, '2020-10-30 16:01:09'),
(14, 1, 2, 7, 1, 240, '2020-10-30 16:01:09'),
(15, 1, 1, 7, 1, 260, '2020-10-30 16:01:09'),
(16, 1, 2, 8, 1, 240, '2020-10-30 16:01:09'),
(17, 1, 5, 11.5, 1, 120, '2020-10-30 16:01:09'),
(18, 1, 2, 7, 8, 240, '2020-10-30 16:01:09'),
(20, 1, 2, 8, 1, 240, '2020-10-30 04:09:47'),
(20, 1, 1, 7, 1, 260, '2020-10-31 02:10:39'),
(20, 1, 1, 8, 1, 260, '2020-10-31 02:15:21'),
(20, 1, 1, 7, 1, 260, '2020-10-31 02:33:22'),
(21, 1, 1, 7, 1, 260, '2020-10-31 02:36:29'),
(22, 1, 1, 7, 1, 260, '2020-10-31 02:41:09'),
(23, 1, 1, 9, 1, 260, '2020-10-31 02:47:47'),
(24, 1, 1, 10, 1, 260, '2020-10-31 02:51:37'),
(25, 1, 1, 10, 1, 260, '2020-10-31 02:55:05'),
(26, 1, 1, 7, 1, 260, '2020-10-31 09:28:34'),
(27, 1, 1, 11, 1, 260, '2020-11-04 11:36:41'),
(28, 1, 2, 8.5, 1, 240, '2020-11-04 11:38:46'),
(29, 1, 3, 8, 1, 210, '2020-11-04 11:40:32'),
(30, 1, 3, 7, 1, 210, '2020-11-04 11:45:50'),
(31, 1, 2, 7, 1, 240, '2020-11-04 11:54:03'),
(32, 1, 2, 7, 1, 240, '2020-11-04 12:02:06'),
(33, 1, 2, 9, 1, 240, '2020-11-04 12:04:31'),
(34, 1, 2, 7, 1, 240, '2020-11-04 12:08:26'),
(35, 1, 7, 7.5, 1, 130, '2020-11-04 12:15:21'),
(36, 1, 8, 7, 1, 100, '2020-11-04 12:21:33'),
(37, 1, 7, 9.5, 1, 130, '2020-11-04 12:25:18'),
(38, 1, 7, 7.5, 1, 130, '2020-11-04 12:26:33'),
(39, 1, 4, 7, 1, 160, '2020-11-04 12:30:54'),
(40, 1, 8, 7, 2, 100, '2020-11-04 12:36:11'),
(41, 1, 7, 10.5, 1, 130, '2020-11-04 12:40:46'),
(42, 1, 8, 8, 1, 100, '2020-11-04 12:42:36'),
(43, 1, 8, 8, 1, 100, '2020-11-04 12:43:10'),
(44, 1, 8, 9, 1, 100, '2020-11-04 12:45:41'),
(45, 1, 7, 7.5, 1, 130, '2020-11-04 01:19:09'),
(46, 1, 4, 8, 1, 160, '2020-11-11 09:45:56'),
(47, 1, 1, 8, 1, 260, '2020-11-12 01:19:24');

-- --------------------------------------------------------

--
-- Table structure for table `shoes`
--

CREATE TABLE IF NOT EXISTS `shoes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `gender` char(1) NOT NULL,
  `brand` varchar(10) NOT NULL,
  `type` varchar(20) NOT NULL,
  `colour` varchar(10) NOT NULL,
  `price` float NOT NULL,
  `img_path` varchar(30) NOT NULL,
  `sale` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `shoes`
--

INSERT INTO `shoes` (`id`, `name`, `gender`, `brand`, `type`, `colour`, `price`, `img_path`, `sale`) VALUES
(1, 'ULTRABOOST SUMMER.RDY SHOES', 'M', 'Adidas', 'Running', 'Black', 260, '/Adidas/1.jpg', 1),
(2, 'ULTRABOOST DNA X DISNEY SHOES', 'M', 'Adidas', 'Running', 'White', 240, '/Adidas/2.jpg', 0),
(3, 'HARDEN VOL. 4 SHOES', 'M', 'Adidas', 'Basketball', 'Navy', 210, '/Adidas/3.jpg', 1),
(4, 'D.O.N. ISSUE #2 SHOES', 'M', 'Adidas', 'Basketball', 'Orange', 160, '/Adidas/4.jpg', 0),
(5, 'COURTJAM BOUNCE SHOES', 'M', 'Adidas', 'Tennis', 'Black', 120, '/Adidas/5.jpg', 1),
(6, 'ULTRABOOST 20 SHOES', 'F', 'Adidas', 'Running', 'Pink', 260, '/Adidas/6.jpg', 0),
(7, 'EDGE LUX 4 SHOES', 'F', 'Adidas', 'Running', 'White', 130, '/Adidas/7.jpg', 1),
(8, 'ADVANTAGE SHOES', 'F', 'Adidas', 'Tennis', 'White', 100, '/Adidas/8.jpg', 0),
(9, 'CODECHAOS GOLF SHOES', 'F', 'Adidas', 'Golf', 'Red', 199, '/Adidas/9.jpg', 0),
(10, 'NikeZoom Freak 2', 'M', 'Nike', 'Basketball', 'Black', 199, '/Nike/10.jpg', 1),
(11, 'NikeCourt Air Zoom Vapor X', 'M', 'Nike', 'Tennis', 'Navy', 219, '/Nike/11.jpg', 0),
(12, 'NikeCourt Air Zoom GP Turbo', 'M', 'Nike', 'Tennis', 'Orange', 219, '/Nike/12.jpg', 0),
(13, 'NikeKybrid S2 EP', 'M', 'Nike', 'Basketball', 'White', 209, '/Nike/13.jpg', 0),
(14, 'NikeZoomX Vaporfly NEXT', 'F', 'Nike', 'Running', 'Black', 349, '/Nike/14.jpg', 0),
(15, 'NikeZoom Gravity 2', 'F', 'Nike', 'Running', 'White', 139, '/Nike/15.jpg', 0),
(16, 'NikeCourt Air Zoom Vapor Cage 4', 'F', 'Nike', 'Tennis', 'Red', 229, '/Nike/16.jpg', 0),
(17, 'NikeCourt Lite 2', 'F', 'Nike', 'Tennis', 'White', 99, '/Nike/17.jpg', 0),
(18, 'NikeKyrie 6 by you', 'F', 'Nike', 'Basketball', 'White', 229, '/Nike/18.jpg', 0),
(19, 'Skechers Max Cushioning Elite', 'F', 'Skechers', 'Running', 'Black', 90, '/Skechers/19.jpg', 0),
(20, 'Skechers GOrun Forza 4 Hyper', 'F', 'Skechers', 'Running', 'Pink', 145, '/Skechers/20.jpg', 0),
(21, 'Skechers GO GOLF Elite V.3 - Deluxe', 'F', 'Skechers', 'Golf', 'Black', 105, '/Skechers/21.jpg', 0),
(22, 'Skechers GO GOLF Max - Fade', 'F', 'Skechers', 'Golf', 'White', 90, '/Skechers/22.jpg', 1),
(23, 'Skechers GOrun OG Hyper', 'M', 'Skechers', 'Running', 'Red', 100, '/Skechers/23.jpg', 0),
(24, 'Skechers GOrun Ride 8 Hyper', 'M', 'Skechers', 'Running', 'Black', 125, '/Skechers/24.jpg', 1),
(25, 'Skechers GO GOLF Mojo - Punch Shot', 'M', 'Skechers', 'Golf', 'White', 125, '/Skechers/25.jpg', 0),
(26, 'Skechers GO GOLF Elite V.4 - Prestige RF', 'M', 'Skechers', 'Golf', 'Navy', 115, '/Skechers/26.jpg', 0),
(27, 'Skechers GOrun Hyper Burst - Solar', 'M', 'Skechers', 'Running', 'Navy', 95, '/Skechers/27.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `product_id` int(11) NOT NULL,
  `size` float NOT NULL,
  `qty` int(11) NOT NULL,
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`product_id`, `size`, `qty`) VALUES
(1, 7, 1),
(1, 8, 2),
(1, 9, 1),
(1, 10, 0),
(1, 11, 0),
(1, 12, 0),
(2, 7, 2),
(2, 8.5, 3),
(2, 9, 2),
(2, 10.5, 2),
(2, 11, 1),
(2, 12, 1),
(3, 7, 4),
(3, 8, 3),
(3, 9, 3),
(3, 10, 2),
(3, 11, 1),
(3, 12, 1),
(4, 7, 4),
(4, 8, 3),
(4, 9, 3),
(4, 10, 2),
(4, 11, 1),
(4, 12, 1),
(5, 7, 5),
(5, 8, 4),
(5, 9, 3),
(5, 10, 2),
(5, 11, 1),
(5, 12, 1),
(6, 7, 5),
(6, 8, 4),
(6, 9, 3),
(6, 10, 2),
(6, 11, 1),
(6, 12, 1),
(7, 7.5, 2),
(7, 8.5, 4),
(7, 9.5, 2),
(7, 10.5, 1),
(7, 11.5, 1),
(7, 12, 1),
(8, 7, 3),
(8, 8, 2),
(8, 9, 2),
(8, 10, 2),
(8, 11, 1),
(8, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birthday` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `credit_card` char(16) DEFAULT '',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `gender`, `birthday`, `email`, `address`, `password`, `credit_card`) VALUES
(7, 'admin', 'female', '2020-11-02', 'ntu@solemate.com', 'Testing Addres 112323', '164d5fdfd02634293161afac4cf47299', ''),


--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product`) REFERENCES `shoes` (`id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `shoes` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
