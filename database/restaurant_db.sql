-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2026 at 07:28 PM
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
-- Database: `restaurant_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu_tems`
--

CREATE TABLE `menu_tems` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `catagory` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_tems`
--

INSERT INTO `menu_tems` (`id`, `image`, `name`, `price`, `catagory`) VALUES
(1, 'chicken.jpg', 'Chicken bites ', 100, 'Thai'),
(2, 'DINDE-AUX-MARRONS-1-050.webp', 'djaj lmhamar', 22, 'thia'),
(3, 'DINDE-AUX-MARRONS-1-050.webp', 'djaj lmhamar', 22, 'thia'),
(4, 'OIP.webp', 'PIZZA', 4, 'thia'),
(5, 'download.webp', 'SANDWICHE', 2, 'thia'),
(6, 'TAKOS.webp', 'TAKOS ', 8, 'thia');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(250) NOT NULL,
  `item_name` varchar(250) NOT NULL,
  `Status` enum('delivered','pending') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `item_name`, `Status`) VALUES
(1, 'milon', 'chicken Bites', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `usere`
--

CREATE TABLE `usere` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('admin','user') NOT NULL,
  `adress` text NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usere`
--

INSERT INTO `usere` (`id`, `name`, `email`, `password`, `type`, `adress`, `phone`) VALUES
(105, 'ilyas', 'ilyasdaoui62@gmail.com', '2212', 'user', '', '0688412040'),
(108, 'DAOUI داوي', 'ilyas.daoui@edu.uiz.ac.ma', '1234', 'admin', 'HARATE EL MORABITINE', '0772999493'),
(109, '', '', '', 'user', '', '0772999493'),
(113, 'MOUSSAB', 'MOUSSAB@gmail.com', '1234', 'user', 'JLG JHGJKBUJ', '0000000000000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_tems`
--
ALTER TABLE `menu_tems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usere`
--
ALTER TABLE `usere`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_tems`
--
ALTER TABLE `menu_tems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usere`
--
ALTER TABLE `usere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
