-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2021 at 09:30 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodyfood`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(200) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `preference` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `address`, `mobile`, `preference`, `created_at`) VALUES
(1, 'Abhishek Gupta', 'abhishek.guru420@gmail.com', '$2y$10$rPntwS1D4cPgix.VTuHJB.v3vC68YLMBFknwS3OgeK0xFmKKN1U1m', 'VILL. PANJRAT, TEH. KARSOG.', '9882007727', 'veg', '2021-05-17 00:46:13'),
(2, 'Abhishek Gupta', 'abhishek.guru4200@gmail.com', '$2y$10$aT46kd1qOIND1M8SwBrxB.6G1tX7v8sI4ZyM6j9KkS5bQ6AZohPZe', 'VILL. PANJRAT, TEH. KARSOG.', '9882007727', 'veg', '2021-05-17 00:48:20'),
(4, 'Abhishek Gupta', 'abu.baba918@gmail.com', '$2y$10$uIqlUZrI7VFg6bMMVBJpKOyDB9tH98mT8068sbqotSssh6Api7zDG', 'Vikasnagar Distt. Shimla', '7018633910', 'veg', '2021-05-17 00:57:24'),
(5, 'Ghost', 'ghost@gmail.com', '$2y$10$sL8swR12Z/tHE.y2foQStenvYeEPb2NE4oxvrzMTMNcrP8qRRaiUa', 'shimla distt. shimla himachal pradesh', '7018633910', 'nonveg', '2021-05-19 22:26:28'),
(6, 'Abhinav Kumar', 'abhinav@gmail.com', '$2y$10$BwMRWBL0wzXxWjnxjyONquNKJAaLmsBXw/xfCCEqJovvwptxXmZx2', 'Shimla', '8987676543', 'nonveg', '2021-05-20 12:14:22');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `category` varchar(10) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `res_id` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `category`, `price`, `image`, `res_id`, `created_at`) VALUES
(1, 'Paneer', 'veg', 99, 'chilli-paneer-dry_05192021110837.jpg', 1, '2021-05-18 15:13:54'),
(2, 'Paneer', 'veg', 399, 'Chilli-Paneer-Restaurant-Style_05192021110856.jpg', 1, '2021-05-18 15:14:51'),
(3, 'Tandoori Chicken', 'nonveg', 499, 'tcki_05192021111859.jpg', 1, '2021-05-18 15:16:15'),
(4, 'All In One', 'nonveg', 200, 'download_05192021111952.jpg', 1, '2021-05-18 15:20:03'),
(5, 'Matter Paneer', 'veg', 199, 'Matar-Paneer-2-500x500_05192021115928.jpg', 2, '2021-05-18 15:36:10'),
(6, 'Chilli Paneer Dry', 'veg', 399, 'chilli-paneer-dry_05192021054652.jpg', 2, '2021-05-19 09:16:52'),
(8, 'Dhosa', 'veg', 99, 'dosa_05202021082841.jpg', 2, '2021-05-20 11:58:41'),
(9, 'Cone Dosa', 'veg', 199, 'coneDosa_05202021083033.jpg', 2, '2021-05-20 12:00:33'),
(10, 'Matter Paneer Specia', 'veg', 199, 'mpaneer_05202021083638.jpg', 2, '2021-05-20 12:06:38'),
(12, 'dum aalloo', 'veg', 99, 'dum-Aloo_05202021083940.jpg', 3, '2021-05-20 12:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) NOT NULL,
  `item` varchar(30) NOT NULL,
  `c_name` varchar(30) NOT NULL,
  `price` int(12) NOT NULL,
  `c_address` varchar(100) NOT NULL,
  `c_mobile` int(10) NOT NULL,
  `c_id` int(10) NOT NULL,
  `res_id` int(10) NOT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `item`, `c_name`, `price`, `c_address`, `c_mobile`, `c_id`, `res_id`, `date`) VALUES
(1, 'Paneer', 'Abhishek Gupta', 99, 'VILL. PANJRAT, TEH. KARSOG.', 2147483647, 1, 1, '2021-05-20 00:21:37'),
(2, 'Paneer', 'Abhishek Gupta', 99, 'VILL. PANJRAT, TEH. KARSOG.', 2147483647, 1, 1, '2021-05-20 00:34:15'),
(3, 'Matter Paneer', 'Abhishek Gupta', 199, 'VILL. PANJRAT, TEH. KARSOG.', 2147483647, 1, 2, '2021-05-20 00:36:45'),
(4, 'Chilli Paneer Dry', 'Abhishek Gupta', 399, 'VILL. PANJRAT, TEH. KARSOG.', 2147483647, 1, 2, '2021-05-20 00:37:03'),
(5, 'Paneer', 'Abhishek Gupta', 399, 'VILL. PANJRAT, TEH. KARSOG.', 2147483647, 1, 1, '2021-05-20 00:40:46'),
(9, 'Tandoori Chicken', 'Ghost', 499, 'shimla distt. shimla himachal pradesh', 2147483647, 5, 1, '2021-05-20 10:24:29'),
(16, 'Paneer', 'Abhishek Gupta', 399, 'VILL. PANJRAT, TEH. KARSOG.', 2147483647, 1, 1, '2021-05-20 10:26:22'),
(17, 'Matter Paneer', 'Abhishek Gupta', 199, 'VILL. PANJRAT, TEH. KARSOG.', 2147483647, 1, 2, '2021-05-20 10:33:23'),
(18, 'Tandoori Chicken', 'Ghost', 499, 'shimla distt. shimla himachal pradesh', 2147483647, 5, 1, '2021-05-20 10:52:28'),
(19, 'dum aalloo', 'Abhishek Gupta', 99, 'VILL. PANJRAT, TEH. KARSOG.', 2147483647, 1, 3, '2021-05-20 12:10:23'),
(20, 'Tandoori Chicken', 'Abhinav Kumar', 499, 'Shimla', 2147483647, 6, 1, '2021-05-20 12:19:19'),
(21, 'Tandoori Chicken', 'Abhinav Kumar', 499, 'Shimla', 2147483647, 6, 1, '2021-05-20 12:27:27'),
(22, 'All In One', 'Abhinav Kumar', 200, 'Shimla', 2147483647, 6, 1, '2021-05-20 12:27:30'),
(23, 'dum aalloo', 'Abhishek Gupta', 99, 'VILL. PANJRAT, TEH. KARSOG.', 2147483647, 1, 3, '2021-05-20 12:28:17'),
(24, 'Chilli Paneer Dry', 'Abhishek Gupta', 399, 'VILL. PANJRAT, TEH. KARSOG.', 2147483647, 1, 2, '2021-05-20 12:29:47'),
(25, 'Dhosa', 'Abhishek Gupta', 99, 'VILL. PANJRAT, TEH. KARSOG.', 2147483647, 1, 2, '2021-05-20 12:30:29'),
(26, 'Cone Dosa', 'Abhishek Gupta', 199, 'VILL. PANJRAT, TEH. KARSOG.', 2147483647, 1, 2, '2021-05-20 12:31:16'),
(27, 'Dhosa', 'Abhishek Gupta', 99, 'VILL. PANJRAT, TEH. KARSOG.', 2147483647, 1, 2, '2021-05-20 12:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Abhi ka Dhaba', 'abhikadhaba@gmail.com', '$2y$10$9kW0zdGvbnToYaObWquqdOVK1UmH1OS5ZiOKfs9Xni0nnVw2yKaBq', '2021-05-16 22:56:51'),
(2, 'Mummy ka Dhaba', 'mkd@gmail.com', '$2y$10$VnPq.lyA6VZK2wGHZJvbWeydBXiyzaLWs766.SZBGH6kPzbQYoImq', '2021-05-18 15:35:09'),
(3, 'Apna Dhaba', 'ad@gmail.com', '$2y$10$qbjH1t0nRXaeGOWkLHUxOOe624WMy14p/XviUI3bHhRRiQZZFxiR2', '2021-05-20 12:07:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `res_id` (`res_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `res_id` (`res_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`res_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`res_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
