-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 29, 2022 at 03:34 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Quicksilver_Swimming`
--
CREATE DATABASE IF NOT EXISTS `Quicksilver_Swimming` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `Quicksilver_Swimming`;

-- --------------------------------------------------------

--
-- Table structure for table `OrderItems`
--

CREATE TABLE `OrderItems` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(1) NOT NULL,
  `cost` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `OrderItems`
--

INSERT INTO `OrderItems` (`id`, `orderId`, `productId`, `quantity`, `size`, `cost`) VALUES
(52, 39, 2, 1, 'L', 100),
(53, 39, 25, 1, 'M', 20),
(54, 40, 2, 1, 'L', 100),
(55, 41, 2, 4, 'L', 400),
(56, 41, 46, 3, 'L', 420),
(57, 41, 44, 1, 'M', 250),
(58, 41, 45, 1, 'S', 115),
(59, 42, 2, 1, 'M', 100),
(60, 42, 2, 1, 'L', 100),
(61, 43, 2, 1, 'L', 100),
(62, 43, 25, 1, 'L', 20),
(63, 43, 44, 1, 'S', 250),
(64, 44, 2, 2, 'L', 200),
(65, 44, 2, 1, 'M', 100),
(66, 44, 1, 1, 'M', 20);

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `deliveryLocation` varchar(255) NOT NULL,
  `totalCost` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `completed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`id`, `userId`, `deliveryLocation`, `totalCost`, `date`, `completed`) VALUES
(39, 2, 'Milnerton', 145, '2022-06-28 10:35:43', 1),
(40, 2, 'Durbanville', 125, '2022-06-29 13:50:07', 0),
(41, 2, 'Tygervalley', 1210, '2022-06-29 13:59:59', 0),
(42, 2, 'Milnerton', 225, '2022-06-29 14:00:31', 0),
(43, 2, 'Durbanville', 395, '2022-06-29 15:04:16', 0),
(44, 40, 'Milnerton', 345, '2022-06-29 15:30:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `description` varchar(255) NOT NULL,
  `imageUrl` varchar(1000) NOT NULL,
  `visible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`id`, `name`, `price`, `description`, `imageUrl`, `visible`) VALUES
(1, 'Fins', 20, 'Very cool fins! Brand new', '/ITECA3-Project/assets/fins.jpg', 1),
(2, 'Swimming Cap', 100, 'Best of the best swimming cap!', '/ITECA3-Project/assets/cap.jpg', 1),
(25, 'Shorts', 20, 'Greatest shorts on the market!', '/ITECA3-Project/assets/shorts.jpg', 1),
(44, 'Premium Swimming Cap', 250, 'Highest Quality Swimming Cap on the market!', '/ITECA3-Project/assets/th-4077895616.jpg', 1),
(45, 'Swimming Goggles', 115, 'Awesome Goggles', '/ITECA3-Project/assets/swimming-goggles.jpg', 1),
(46, 'Swimming Board', 140, 'Floating board', '/ITECA3-Project/assets/swimming-board.jpeg', 1),
(47, 'Swimming Shirt', 80, 'Unisex shirt', '/ITECA3-Project/assets/shirt.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phoneNumber` varchar(10) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `name`, `email`, `password`, `phoneNumber`, `isAdmin`) VALUES
(1, 'admin', 'admin@gmail.com', '1234', '0828576745', 1),
(2, 'dylan', 'dylan@gmail.com', '1234', '0826543984', 0),
(40, 'bobby', 'bob@gmail.com', '1234', '0826780984', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `OrderItems`
--
ALTER TABLE `OrderItems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `OrderItems`
--
ALTER TABLE `OrderItems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `OrderItems`
--
ALTER TABLE `OrderItems`
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `Orders` (`id`),
  ADD CONSTRAINT `orderitems_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `Products` (`id`);

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
