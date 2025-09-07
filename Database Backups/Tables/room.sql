-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2025 at 04:05 PM
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
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `location` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `title`, `price`, `description`, `location`, `image`) VALUES
(2, 'The Classic Balcony', 59, 'The Classic Balcony Room offers a blend of comfort and elegance, featuring a cozy ambiance, tasteful dÃ©cor, and a private balcony with scenic views. Perfect for relaxation, it includes modern amenities like a plush bed, flat-screen TV, free Wi-Fi, and a stylish bathroom, ensuring a peaceful and enjoyable stay.', 'The Ritz-Carlton, Bali, Indonesia', 'deluxe.jpg'),
(3, 'Boutique Hotel', 99, 'Our Boutique Hotel in Paris blends modern design with charming French architecture. Located near iconic attractions, it offers personalized service, artistic interiors, and cozy luxury. Experience authentic Parisian life in a stylish, intimate setting with comfort, culture, and elegance all in one.', 'The Hoxton, Amsterdam, Netherlands', '745232618_P.jpg'),
(4, 'The Classic Resort', 149, 'Escape to paradise at The Classic Resort in the Maldives. Surrounded by crystal-clear waters and pristine beaches, this resort offers private villas, spa treatments, and gourmet dining. Ideal for honeymooners or those craving relaxation in a tranquil, tropical island setting.', 'Candolim Beach, North Goa', '579300_original.jpg'),
(5, 'Luxury Rooms', 299, 'Indulge in opulence with our Luxury Rooms located in the heart of Dubai. Featuring world-class amenities, breathtaking views, and unmatched comfort, these rooms promise a stay like no other. Perfect for elite travelers seeking elegance, privacy, and personalized five-star service.', 'Lake Pichola, Rajasthan', 'room.webp'),
(6, 'The Business Rooms', 249, 'Situated in Shinjuku, Hilton Tokyo caters to business travelers with modern meeting facilities, executive lounges, and high-speed internet. The hotel combines comfort and efficiency, offering sleek rooms, excellent dining options, and proximity to transport hubs and corporate districtsâ€”ideal for professionals on the go.', 'Hilton Tokyo, Japan', 'r2.jpg'),
(7, 'Best Rest Room', 129, 'A restroom is a clean, private space designed for personal hygiene needs. It typically includes toilets, sinks, mirrors, and hand dryers or paper towels. Found in homes, workplaces, and public areas, restrooms ensure comfort, sanitation, and convenience for individuals of all ages and abilities.', 'Beverly Hills, California', 'room-6'),
(8, 'Resort', 299, 'Nestled in Bali’s lush jungle, this eco resort blends sustainability with comfort. Guests enjoy open-air villas, organic food, and yoga retreats. Perfect for nature lovers and wellness travelers seeking peace, green living, and a genuine connection with the local environment and culture.', 'Eco Resort – Ubud, Bali, Indonesia', 'room-7.jpg'),
(9, 'Mountain View Room', 199, 'Surrounded by the Swiss Alps, this cozy mountain lodge offers ski-in/ski-out access, fireplaces, and hot tubs. It’s a perfect alpine retreat for winter sports enthusiasts or anyone wanting scenic solitude and crisp air. Enjoy hearty cuisine, snowy slopes, and breathtaking Matterhorn views.', 'Mountain Lodge – Zermatt, Switzerland', 'room-8.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
