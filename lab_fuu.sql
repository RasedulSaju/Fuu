-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2021 at 06:55 PM
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
-- Database: `lab_fuu`
--

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE `home` (
  `homepage_no` int(11) NOT NULL,
  `file_name` varchar(99) NOT NULL,
  `manager_name` varchar(50) NOT NULL,
  `status` varchar(10) DEFAULT 'pending',
  `time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`homepage_no`, `file_name`, `manager_name`, `status`, `time`) VALUES
(4, 'Chicken 2, Burger 1 ', 'naim', 'complete', '2021-01-13 01:37:19'),
(5, 'Pizza 1  ', 'naim', 'pending', '2021-01-13 09:48:48'),
(7, 'Khichuri 1', 'rasedul', 'pending', '2021-01-19 12:58:54'),
(8, 'Burger', 'rasedul', 'complete', '2021-01-19 23:46:39'),
(9, 'French Fries', 'rasedul', 'pending', '2021-01-19 23:46:39'),
(10, 'Tea', 'rasedul', 'pending', '2021-01-19 23:46:39'),
(11, 'Fried Rice', 'naim', 'pending', '2021-01-19 23:48:18'),
(12, 'Duck Platter', 'naim', 'rejected', '2021-01-19 23:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `position` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_no`, `name`, `email`, `phone`, `password`, `position`) VALUES
(1, 'rasedul', 'a@a.co', '8801735', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(2, 'naim', 'n@n.com', '01525', 'e2fc714c4727ee9395f324cd2e7f331f', 'manager'),
(5, 'rs', 'r@s.co', '01712345', 'e2fc714c4727ee9395f324cd2e7f331f', 'chef'),
(7, 'sr', 'rasedulsaju@live.com', '017357', 'e2fc714c4727ee9395f324cd2e7f331f', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `raw_material`
--

CREATE TABLE `raw_material` (
  `raw_no` int(11) NOT NULL,
  `market_name` varchar(250) NOT NULL,
  `cost` int(10) NOT NULL,
  `market_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `raw_material`
--

INSERT INTO `raw_material` (`raw_no`, `market_name`, `cost`, `market_time`) VALUES
(1, 'Tomato', 150, '2021-01-19 23:47:38'),
(2, 'Cheese', 50, '2021-01-19 23:47:38'),
(3, 'Baan', 50, '2021-01-19 23:47:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`homepage_no`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_no`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `raw_material`
--
ALTER TABLE `raw_material`
  ADD PRIMARY KEY (`raw_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `home`
--
ALTER TABLE `home`
  MODIFY `homepage_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `raw_material`
--
ALTER TABLE `raw_material`
  MODIFY `raw_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
