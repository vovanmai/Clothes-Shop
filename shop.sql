-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 09, 2017 at 08:57 AM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cat_chirld`
--

CREATE TABLE `cat_chirld` (
  `id` int(255) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cat_parent_id` int(255) NOT NULL,
  `active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cat_chirld`
--

INSERT INTO `cat_chirld` (`id`, `name`, `cat_parent_id`, `active`) VALUES
(1, 'Áo khoác gió nam', 1, 1),
(2, 'Áo vét nam', 1, 1),
(5, 'Áo khoác jean nam', 1, 1),
(6, 'Áo len nam', 1, 1),
(7, 'Áo khoác nỉ', 1, 1),
(8, 'Áo khoác Kali nam', 1, 1),
(9, 'Áo khoác da nam', 1, 1),
(10, 'Áo khoác phao nam', 1, 1),
(11, 'Quần thời trang nam', 2, 1),
(12, 'Quần Short nam', 2, 1),
(13, 'Quần Jean nam', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cat_parent`
--

CREATE TABLE `cat_parent` (
  `ID` int(255) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` int(2) NOT NULL DEFAULT '1',
  `active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cat_parent`
--

INSERT INTO `cat_parent` (`ID`, `name`, `gender`, `active`) VALUES
(1, 'Áo Khoác Nam', 1, 1),
(2, 'Quần Nam', 0, 1),
(3, 'Áo Thun Nam', 1, 1),
(4, 'Áo Sơ Mi Nam', 1, 1),
(5, 'Đồ Bộ Nam', 1, 1),
(6, 'Đồ Bộ Nữ', 1, 0),
(7, 'Áo Sơ Mi Nữ', 1, 0),
(8, 'Áo Thun Nữ', 0, 0),
(9, 'Váy Đầm', 0, 0),
(10, 'Áo Khoác Nữ', 1, 0),
(11, 'Áo Len Nứ', 1, 0),
(12, 'Quần Nữ', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(255) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_id` int(255) NOT NULL,
  `ship_address` text COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(255) NOT NULL,
  `order_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ID` int(255) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `preview_text` text COLLATE utf8_unicode_ci NOT NULL,
  `detail_text` text COLLATE utf8_unicode_ci NOT NULL,
  `cat_chirld_id` int(255) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(10) NOT NULL,
  `brand_new` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(20) NOT NULL,
  `number_order` int(10) NOT NULL DEFAULT '0',
  `view` int(10) NOT NULL DEFAULT '0',
  `highlight` int(2) NOT NULL DEFAULT '0',
  `active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE `product_color` (
  `product_id` int(255) NOT NULL,
  `color_id` int(255) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `product_id` int(255) NOT NULL,
  `size_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `discount` int(3) NOT NULL,
  `started_date` datetime NOT NULL,
  `end_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(255) NOT NULL,
  `size` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `active` int(2) NOT NULL DEFAULT '1',
  `level` int(2) NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `email`, `phone`, `address`, `active`, `level`, `avatar`) VALUES
(52, '', '', '', '', '', '', 1, 2, ''),
(54, '', '', '', '', '', '', 1, 2, ''),
(55, '', '', '', '', '', '', 1, 2, ''),
(56, '', '', '', '', '', '', 1, 2, ''),
(57, '', '', '', '', '', '', 1, 2, ''),
(58, '', '', '', '', '', '', 1, 2, ''),
(59, '', '', '', '', '', '', 1, 2, ''),
(60, '', '', '', '', '', '', 1, 2, ''),
(61, '', '', '', '', '', '', 1, 2, ''),
(62, '', '', '', '', '', '', 1, 2, ''),
(63, '', '', '', '', '', '', 1, 2, ''),
(64, '', '', '', '', '', '', 1, 2, ''),
(65, 'trantrunghieu', '123456', 'tráº§n trung hiáº¿u', 'trantrunghieu@gmail.com', '256', 'Quáº¿ SÆ¡n', 1, 3, ''),
(66, 'trantrunghieu', '', 'tráº§n trung hiáº¿u', 'trantrunghieu@gmail.com', '256', 'Quáº¿ SÆ¡n', 1, 3, ''),
(67, 'trantrunghieu', '', 'tráº§n trung hiáº¿u', 'trantrunghieu@gmail.com', '256', 'Quáº¿ SÆ¡n', 1, 3, '123'),
(68, 'vovanmai', '', 'vo van mải', 'vovanmai.dt3@gmail.com', '123456789', 'Quang nam', 1, 3, ''),
(69, 'vovanmai', '', 'vo van máº£i', 'vovanmai.dt3@gmail.com', '123456789', 'Quang nam', 1, 3, ''),
(70, 'vovanmai', '', 'vo van máº£i', 'vovanmai.dt3@gmail.com', '123456789', 'Quang nam', 1, 3, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cat_chirld`
--
ALTER TABLE `cat_chirld`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_parent`
--
ALTER TABLE `cat_parent`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`product_id`,`color_id`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`product_id`,`size_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cat_chirld`
--
ALTER TABLE `cat_chirld`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `cat_parent`
--
ALTER TABLE `cat_parent`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
