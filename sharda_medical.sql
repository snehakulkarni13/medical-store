-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2025 at 06:29 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sharda_medical`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(20) NOT NULL,
  `customer_name` varchar(30) NOT NULL,
  `product_name` text NOT NULL,
  `doctor_name` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `bill_no` int(20) NOT NULL,
  `price` varchar(30) NOT NULL,
  `entry_date` text NOT NULL,
  `quantity` varchar(30) NOT NULL,
  `mfg_date` text NOT NULL,
  `exp_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `product_name`, `doctor_name`, `address`, `bill_no`, `price`, `entry_date`, `quantity`, `mfg_date`, `exp_date`) VALUES
(1, 'Sneha Kulkarni', 'Sinarest', 'Zadke dr', 'Chakur', 123, '200', '12-03-25', '20', '07-12-24', '30-05-25'),
(2, 'Sukanya kulkarni', '8,6', 'hudge', 'Latur', 12345, '100', '12-03-25', '50', '03-01-25', '29-05-25'),
(3, 'Raghu', '8,7,6', 'Zadke dr', 'Chakur', 1234, '50,100,80', '12-03-25', '1', '', ''),
(4, 'Priya Thakur', '8,7', 'Hudge madam', 'Chakur', 12, '50,100', '13-03-25', '10,10', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sharda_admin`
--

CREATE TABLE `sharda_admin` (
  `id` int(5) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sharda_admin`
--

INSERT INTO `sharda_admin` (`id`, `user_name`, `password`) VALUES
(1, 'dhananjay_pande', 'Dhananjay@1234'),
(2, 'Raghavendr', 'Raghavendr');

-- --------------------------------------------------------

--
-- Table structure for table `stocklist`
--

CREATE TABLE `stocklist` (
  `id` int(20) NOT NULL,
  `product_name` text NOT NULL,
  `wholesaler` varchar(30) NOT NULL,
  `price` varchar(30) NOT NULL,
  `entry_date` text NOT NULL,
  `quantity` int(20) NOT NULL,
  `mfg_date` text NOT NULL,
  `exp_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stocklist`
--

INSERT INTO `stocklist` (`id`, `product_name`, `wholesaler`, `price`, `entry_date`, `quantity`, `mfg_date`, `exp_date`) VALUES
(1, 'Zendu bam', 'Latur medical', '40', '12-03-25', 50, '08-11-24', '29-05-25'),
(6, 'Sinarest', 'Mahesh Medical', '800', '12-03-25', 40, '01-11-24', '24-04-25'),
(7, 'calpol', 'Latur medical', '1000', '12-03-25', 20, '06-03-25', '26-03-25'),
(8, 'TusQ', 'Balaji Medical', '70000', '12-03-25', 60, '03-10-24', '12-10-26'),
(9, 'Cipla Eye Drop', 'Mahesh Medical', '1000', '12-03-25', 20, '01-03-25', '30-10-25'),
(10, 'testbySneha', 'Balaji Medical', '8000', '15-03-25', 41, '01-03-25', '20-03-25'),
(11, 'sddd', 'sdds', '88', '15-03-25', 70, '05-03-25', '31-03-25'),
(12, 'Sinarest b', 'bhbhb', '511', '15-03-25', 10, '11-03-25', '31-03-25'),
(13, 'cfdfxfx', 'testing', '74', '15-03-25', 41, '13-03-25', '31-03-25'),
(14, 'final', 'vgvg', '50', '15-03-25', 10, '14-03-25', '13-03-25'),
(15, 'final ', 'final ', '10', '15-03-25', 10, '11-03-25', '31-03-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sharda_admin`
--
ALTER TABLE `sharda_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocklist`
--
ALTER TABLE `stocklist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stocklist`
--
ALTER TABLE `stocklist`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
