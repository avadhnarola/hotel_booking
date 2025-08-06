-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2025 at 08:28 AM
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
-- Database: `hotel-booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE `destination` (
  `id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `days` text NOT NULL,
  `location` text NOT NULL,
  `star` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`id`, `price`, `days`, `location`, `star`, `rate`, `image`) VALUES
(2, 1999, '10', 'Santorini, Greece', 4, 100, 'greese.jpg'),
(3, 2999, '8', 'Bali, Indonesia', 5, 100, 'Bali, Indonesia.jpg'),
(4, 999, '6', 'Maldives', 4, 98, 'maldives.webp'),
(5, 1599, '13', 'Machu Picchu, Peru', 3, 80, 'Machu Picchu, Peru.jpg'),
(6, 699, '10', 'Rishikesh ,Uttarakhand', 5, 100, 'Rishikesh ,Uttarakhand.jpg'),
(7, 2500, '12', 'Switzerland', 4, 90, 'Switzerland.jpg'),
(8, 800, '8', 'Kedarnath', 5, 100, 'Kedarnath.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `destination`
--
ALTER TABLE `destination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
