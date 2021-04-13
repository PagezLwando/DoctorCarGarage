-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2021 at 03:48 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctorcar_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `order_id` int(12) NOT NULL,
  `orderNumber` varchar(12) DEFAULT NULL,
  `productName` varchar(50) DEFAULT NULL,
  `priceEach` varchar(30) DEFAULT NULL,
  `qualityOrderEach` varchar(10) DEFAULT NULL,
  `orderContact` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(8) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `code`, `image`, `price`) VALUES
(0, 'Transmissions', '3945646564tran', 'product-images/transmission.jpg', 1200.98),
(1, 'Oil and Filters', '3DcAM019394', 'product-images/oil.jpg', 1500.00),
(2, 'Brakes', 'USB02378479', 'product-images/brake.jpg', 800.00),
(3, 'Batteries', 'bttr3397253', 'product-images/car-battery.jpg', 300.00),
(4, 'Engines', 'en932983823', 'product-images/engine.jpg', 800.00),
(5, 'Supsensions', '22343434ff322', 'product-images/suspension.jpg', 3200.98),
(6, 'Diagnoses', 'dia339734253', 'product-images/diagnose.jpg', 360.00),
(7, 'Tow Truck', 'truc24932983823', 'product-images/tow-truck.jpg', 800.45),
(8, 'Oil', 'oil308439374', 'product-images/oil-change.jpg', 400.35),
(9, 'Wheels and Tires', 'Weh33438248', 'product-images/wheel.jpg', 1600.00);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `emailAddress` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `cpassword` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `phoneNumber`, `emailAddress`, `password`, `cpassword`) VALUES
(1, 'Lwando', 'Nodume', '0717247607', 'lwando@gmail.com', '123456', '123456'),
(2, 'Mini', 'Nodume', '0717244307', 'mini@gmail.com', '123456', '123456'),
(3, 'Aphe', 'Nodume', '0717227627', 'aphe@gmail.com', '123456', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD UNIQUE KEY `emailAddress` (`emailAddress`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
