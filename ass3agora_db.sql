-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2022 at 03:49 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ass3agora_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `phone`, `address`, `created_at`) VALUES
(9, 'anna', 'anna@gmail.com', '0222333445', 'Christchurch, NZ', '2022-11-23 15:03:58');

-- --------------------------------------------------------

--
-- Table structure for table `seller_db`
--

CREATE TABLE `seller_db` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller_db`
--

INSERT INTO `seller_db` (`id`, `name`, `price`, `image`) VALUES
(20, 'Bulk fruits', '50', 'fruits.jpg'),
(21, 'Bulk vege', '65', 'green vege.jpg'),
(22, 'Chicken Grain', '80', 'chicken grain.jpg'),
(23, 'Seeds and Seasoning', '63', 'glass-jars-food-storage.png'),
(24, 'Bulk pasta', '65', 'pasta.jpg'),
(25, 'Bulk Grainy', '45', 'grains.jpg'),
(26, 'Bulk Fruits and Nuts', '57', 'fruits and nuts.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `user_type` varchar(100) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_form`
--the password are HAshed

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `image`, `user_type`) VALUES
(1, 'christine', 'christine@gmail.com', 'b59c67bf196a4758191e42f76670ceba', 'Screenshot 2022-10-25 174934.png', 'user'),
(15, 'Adam', 'Adam@gmail.com', 'b59c67bf196a4758191e42f76670ceba', '74947505_704760740016092_1057135423525035916_n.jpg', 'buyer'),
(17, 'admin', 'admin@gmail.com', 'b59c67bf196a4758191e42f76670ceba', '73546089_263995724500573_5260857027026806835_n.jpg', 'admin'),
(18, 'anna', 'anna@gmail.com', 'b59c67bf196a4758191e42f76670ceba', '83087820_631421767623484_515470432413056414_n.jpg', 'seller'),
(42, 'mark', 'mark@gmail.com', 'b59c67bf196a4758191e42f76670ceba', 'businessman.jpg', 'admin'),
(43, 'myfarmbusiness', 'myfarmbusiness@gmail.com', 'b59c67bf196a4758191e42f76670ceba', 'logo.png', 'admin'),
(45, 'buyer', 'buyer@gmail.com', 'b59c67bf196a4758191e42f76670ceba', '', 'buyer'),
(46, 'seller', 'seller@gmail.com', 'b59c67bf196a4758191e42f76670ceba', '', 'seller'),
(47, 'christine', 'sellerprofile@gmail.com', 'b59c67bf196a4758191e42f76670ceba', '', 'seller'),
(49, 'buyer profile', 'buyerprofile@gmail.com', 'b59c67bf196a4758191e42f76670ceba', '', 'buyer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `seller_db`
--
ALTER TABLE `seller_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `seller_db`
--
ALTER TABLE `seller_db`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
