-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2025 at 08:29 AM
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
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(1) NOT NULL,
  `price` int(11) NOT NULL,
  `nights` text NOT NULL,
  `location` text NOT NULL,
  `star` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `price`, `nights`, `location`, `star`, `rate`, `image`) VALUES
(1, 1599, '4', 'Burjâ€¯Alâ€¯Arab Jumeirah , UAE', 5, 100, 'dubai61-550x550.jpg'),
(2, 5000, '6', 'The Beverly Hills Hotel , Los Angeles', 4, 90, 'The Beverly Hills Hotel.jpg'),
(3, 899, '5', 'Cervo Mountain Resort , Switzerland', 3, 85, 'Cervo Mountain Resort.webp'),
(4, 599, '3', 'Buffalo Mountain Lodge , Canada', 2, 70, 'Buffalo Mountain Lodge.jpg'),
(5, 5999, '5', 'Lemon Tree , Rishikesh', 5, 100, 'Lemon Tree.jpg'),
(6, 5000, '4', 'Park Hyatt Tokyo , Japan', 4, 84, 'Park Hyatt Tokyo.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
