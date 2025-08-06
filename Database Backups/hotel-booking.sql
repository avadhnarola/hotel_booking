-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2025 at 08:27 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'Avadh Narola', 'avadh@gmail.com', '123'),
(2, 'Kayra', 'kayra@gmail.com', '1234');

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

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`) VALUES
(1, 'Avadh Narola', 'avadh@gmil.com', 'Best Service', 'hello1'),
(2, 'Avadh Narola', 'avadh@gmil.com', 'Best Service', 'hello1');

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

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(1) NOT NULL,
  `price` int(11) NOT NULL,
  `shopName` text NOT NULL,
  `location` text NOT NULL,
  `star` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `price`, `shopName`, `location`, `star`, `rate`, `image`) VALUES
(15, 10, 'Asador Etxebarri', 'Basque Country , Spain', 5, 100, 'Asador Etxebarri.jpeg'),
(16, 7, 'La Freskko', 'Motavaracha , Surat', 3, 70, 'cafe.jpg'),
(17, 9, 'Alchemist', 'Copenhagen, Denmark', 4, 89, 'Alchemist.jpg');

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

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `title`, `content`, `icon`) VALUES
(1, 'Activities', 'Discover exciting activities tailored to all interests adventure, culture, nature, and more for unforgettable experiences at every destination.\r\n', 'flaticon-gliding'),
(2, 'Travel Arrangement', 'Seamless travel arrangements including flights, accommodations, transport, and activities professionally planned for a stress free, enjoyable journey.\r\n', 'flaticon-world'),
(3, 'Private Guide', 'Enjoy a personalized experience with a private guideâ€”expert insights, flexible itineraries, and exclusive access tailored to you.\r\n', 'flaticon-tour-guide'),
(4, 'Location Manager', 'Oversees all location logistics, ensuring smooth operations, permits, and coordination for film, TV, or event production success.\r\n', 'flaticon-map-of-roads');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `destination`
--
ALTER TABLE `destination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
