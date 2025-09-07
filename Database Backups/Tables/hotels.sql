-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2025 at 04:04 PM
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
  `name` text NOT NULL,
  `price` int(11) NOT NULL,
  `location` text NOT NULL,
  `star` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `image` text NOT NULL,
  `room_images` text NOT NULL,
  `description` text NOT NULL,
  `services` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `price`, `location`, `star`, `rate`, `image`, `room_images`, `description`, `services`) VALUES
(1, 'Burjâe Alâc¯Arab Jumeirah', 1599, 'UAE , Dubai', 5, 100, 'dubai61-550x550.jpg', '1757132983_img1.webp,1757132983_img2.avif,1757132983_img3.jpg,1757132983_img4.jpg', 'Burj Al Arab, Dubai’s iconic sail-shaped luxury hotel, offers world-class suites, dining, and unmatched Arabian hospitality with breathtaking Gulf views.\r\n', 'wifi,swimming pool,breakfast,parking,air conditioning'),
(2, 'The Beverly Hills Hotel ', 5000, 'Los Angeles', 4, 90, 'The Beverly Hills Hotel.jpg', '1757133200_img6.jpg,1757133200_img5.webp,1757133200_img7.jpg,1757133200_img8.jpg', 'The Beverly Hills Hotel, Los Angeles, is a legendary luxury retreat, famed for Hollywood glamour, iconic pink façade, and timeless elegance.\r\n', 'wifi,swimming pool,air conditioning'),
(3, 'Cervo Mountain Resort ', 899, 'Switzerland', 3, 85, '1757141271_img9.webp', '1757141271_img10.jpg,1757141271_img11.jpg,1757141271_img12.jpg', 'Cervo Mountain Resort blends Alpine luxury and modern design, offering cozy chalets, fine dining, wellness spa, and breathtaking Swiss mountain views.\r\n', 'wifi,breakfast,air conditioning'),
(4, 'Buffalo Mountain Lodge', 599, 'Canada', 2, 70, 'Buffalo Mountain Lodge.jpg', '1757221080_ig1.webp,1757221080_ig2.webp,1757221080_ig4.webp,1757221080_ig3.jpg', 'Buffalo Mountain Lodge, Canada offers rustic charm, cozy mountain-inspired rooms, fine dining, and breathtaking Rocky Mountain views for a serene escape.\r\n', 'breakfast,parking,air conditioning'),
(5, 'Lemon Tree ', 5999, 'Rishikesh', 5, 100, 'Lemon Tree.jpg', '1757221434_IG9.jpg,1757221434_ig6.jpg,1757221434_ig7.jpg,1757221434_ig8.webp', 'Lemon Tree, Rishikesh offers riverside views, modern comfort, serene ambiance, wellness facilities, and warm hospitality amidst the scenic Himalayan foothills.\r\n', 'wifi,swimming pool,breakfast,parking,air conditioning'),
(6, 'Park Hyatt Tokyo ', 5000, 'Japan', 4, 84, 'Park Hyatt Tokyo.jpg', '1757222762_i1.jpg,1757222762_i2.webp,1757222762_i3.jpg,1757222762_i4.jpg', 'Park Hyatt Tokyo offers luxury in Shinjuku with elegant rooms, skyline views, fine dining, spa, and exceptional Japanese hospitality.\r\n', 'wifi,swimming pool,breakfast,air conditioning'),
(15, 'Four Seasons Hotel George', 1299, 'Paris – France', 4, 99, '1757223139_i.jpg', '1757223139_i5.jpg,1757223139_i6.webp,1757223139_i7.jpeg,1757223139_i8.jpg,1757223139_i9.webp', 'Four Seasons George V Paris epitomizes elegance with lavish suites, Michelin-star dining, stunning floral artistry, spa indulgence, and exceptional service.', 'wifi,swimming pool,breakfast,parking,air conditioning'),
(16, 'Dana Grimes', 202, 'Dolore asperiores mi', 5, 66, '1757080863_slider-2.jpg', '1757080863_2.jpg,1757080863_slider-3.jpg,1757080863_room-7.avif', 'Velit amet dolore ', 'wifi,swimming pool,air conditioning');

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
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
