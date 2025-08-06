-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2025 at 08:26 AM
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
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `location` text NOT NULL,
  `price` int(11) NOT NULL,
  `HotelType` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `name`, `email`, `check_in`, `check_out`, `location`, `price`, `HotelType`, `status`) VALUES
(10, 'Kayra Narola', 'kavu@gmail.com', '2025-10-15', '2025-08-30', 'Candolim Beach, North Goa', 149, 'The Classic Resort', 'Pending'),
(11, 'Jeel Jada', 'jeel@gmail.com', '2025-08-14', '2025-08-17', 'Candolim Beach, North Goa', 149, 'The Classic Resort', 'Pending'),
(12, 'Jali', 'j@gmail.com', '2025-08-23', '2025-08-28', 'Hilton Tokyo, Japan', 249, 'The Business Rooms', 'Approved'),
(13, 'Jali', 'j@gmail.com', '2025-08-23', '2025-08-28', 'Hilton Tokyo, Japan', 249, 'The Business Rooms', 'Pending'),
(14, 'Aditya Patel', 'adi001@gmail.com', '2025-08-16', '2025-08-20', 'Beverly Hills, California', 129, 'Best Rest Room', 'Approved'),
(15, 'Dishan Shankar', 'shankar@gmail.com', '2025-08-15', '2025-08-16', 'Eco Resort – Ubud, Bali, Indonesia', 299, 'Resort', 'Approved'),
(16, 'Virat Kohli', 'vk18@gmail.com', '2025-08-07', '2025-08-14', 'Mountain Lodge – Zermatt, Switzerland', 199, 'Mountain View Room', 'Approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
