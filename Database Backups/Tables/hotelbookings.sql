-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2025 at 06:36 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `hotelbookings`
--

CREATE TABLE `hotelbookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `guests` int(11) NOT NULL,
  `payment_status` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotelbookings`
--

INSERT INTO `hotelbookings` (`id`, `user_id`, `hotel_id`, `checkin_date`, `checkout_date`, `guests`, `payment_status`, `created_at`) VALUES
(6, 4, 3, '2025-09-05', '2025-09-07', 35, 'Pending', '2025-09-05 09:24:59'),
(7, 1, 2, '2025-09-05', '2025-09-20', 10, 'Pending', '2025-09-05 10:51:16'),
(8, 5, 16, '2025-09-20', '2025-09-21', 5, 'Paid Successfully', '2025-09-06 03:37:54'),
(9, 5, 15, '2025-09-12', '2025-09-14', 3, 'Pending', '2025-09-06 04:01:43'),
(10, 1, 5, '2025-09-13', '2025-09-17', 5, 'Paid Successfully', '2025-09-07 05:32:52'),
(11, 5, 4, '2025-09-14', '2025-09-26', 5, 'Paid Successfully', '2025-09-07 11:31:33'),
(12, 6, 16, '2025-09-20', '2025-09-24', 5, 'Paid Successfully', '2025-09-07 13:54:02'),
(13, 7, 3, '2025-09-17', '2025-09-21', 5, 'Paid Successfully', '2025-09-08 03:19:25'),
(14, 4, 5, '2025-09-18', '2025-09-25', 10, 'Paid Successfully', '2025-09-08 03:34:52'),
(15, 1, 16, '2025-09-19', '2025-09-20', 2, 'Paid Successfully', '2025-09-11 03:29:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotelbookings`
--
ALTER TABLE `hotelbookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotelbookings`
--
ALTER TABLE `hotelbookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hotelbookings`
--
ALTER TABLE `hotelbookings`
  ADD CONSTRAINT `hotelbookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `hotelbookings_ibfk_2` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
