-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2025 at 06:36 AM
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
-- Table structure for table `hotelbookings`
--

CREATE TABLE `hotelbookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `guests` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotelbookings`
--

INSERT INTO `hotelbookings` (`id`, `user_id`, `hotel_id`, `checkin_date`, `checkout_date`, `guests`, `created_at`) VALUES
(1, 1, 5, '2025-08-30', '2025-08-31', 10, '2025-08-31 06:13:05'),
(2, 1, 5, '2025-08-30', '2025-08-31', 10, '2025-08-31 06:13:24'),
(3, 1, 5, '2003-05-12', '2010-02-25', 38, '2025-09-04 11:23:55'),
(6, 4, 3, '2025-09-05', '2025-09-07', 35, '2025-09-05 09:24:59'),
(7, 1, 2, '2025-09-05', '2025-09-20', 10, '2025-09-05 10:51:16'),
(8, 5, 16, '2025-09-20', '2025-09-21', 5, '2025-09-06 03:37:54'),
(9, 5, 15, '2025-09-12', '2025-09-14', 3, '2025-09-06 04:01:43');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
