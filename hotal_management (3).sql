-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2025 at 06:17 PM
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
-- Database: `hotal_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `guest_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `Number_of_rooms` varchar(50) NOT NULL,
  `guests` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `special_requests` text DEFAULT NULL,
  `status` varchar(30) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `guest_name`, `email`, `phone`, `room_type`, `Number_of_rooms`, `guests`, `check_in`, `check_out`, `special_requests`, `status`, `created_at`, `user_id`, `price`) VALUES
(1, 'Maryam', 'shermaryam558@gmail.com', '3164819446', 'Single', '1', 1, '0000-00-00', '2025-09-05', '', 'pending', '2025-09-26 11:50:39', 1, 8000),
(2, 'Irfan Sher', 'irfansher@gmail.com', '3164679445', 'Single', '4', 10, '0000-00-00', '2025-09-05', '', 'pending', '2025-09-26 11:52:31', 1, 8000),
(3, 'Irfan Sher', 'irfansher@gmail.com', '3164679445', 'Single', '4', 10, '0000-00-00', '2025-09-05', '', 'pending', '2025-09-26 11:55:02', 1, 8000);

-- --------------------------------------------------------

--
-- Table structure for table `contect`
--

CREATE TABLE `contect` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `contect` varchar(30) DEFAULT NULL,
  `message` varchar(1001) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `card_number` varchar(40) DEFAULT NULL,
  `expiry_date` varchar(50) DEFAULT NULL,
  `cvv` varchar(50) DEFAULT NULL,
  `card_holder_name` varchar(50) DEFAULT NULL,
  `billing_zip` varchar(50) DEFAULT NULL,
  `save_card` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `card_number`, `expiry_date`, `cvv`, `card_holder_name`, `billing_zip`, `save_card`) VALUES
(1, '5555 5555 5555', '00/00', '0000', 'irfan sher', '00000', 'yes'),
(2, '4444 4444 4444', '44/44', '4444', 'irfan sher', '44444', 'yes'),
(3, '4444 4444 4444', '44/44', '4444', 'irfan sher', '44444', 'no'),
(4, '5555 5555 5555', '55/55', '5555', 'irfan sher', '55555', 'yes'),
(5, '5555 5555 5555', '55/55', '5555', 'irfan sher', '55555', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `price` varchar(50) NOT NULL,
  `room_type` varchar(50) DEFAULT NULL,
  `guests` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `title`, `image_url`, `price`, `room_type`, `guests`, `description`, `created_at`) VALUES
(1, 'Deluxe Room', 'room1.png', '12,000', 'Single', 2, 'Enjoy comfort with modern amenities, free Wi-Fi, and breakfast.', '2025-09-23 11:18:15'),
(2, 'Executive Suite', 'room2.png', '18,000', 'Double', 4, 'Spacious suite with balcony, luxury bath, and room service.', '2025-09-23 11:19:07'),
(3, 'Family Room', 'room3.png', '11,000', 'Family', 6, 'Perfect for families, extra beds included, and pool access.', '2025-09-23 11:19:44'),
(4, 'Suite Room', 'suite.png', '8000', 'Suite', 4, 'Business', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT 'User',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `role`, `created_at`) VALUES
(1, 'Irfan', 'irfan@gmail.com', '$2y$10$vsbHecekD7XZoZuVaSjotu.cKecruzarRvRUy9u60mu59J99xompS', 'uploads/sir.png', 'admin', '2025-09-17 18:25:44'),
(2, 'Noman', 'noman558@gmail.com', '$2y$10$EzfLxRXm2bEXxf08k9xWR.4eGdVnIPWPhgxF3DFi9p4Q4rquMmByy', 'uploads/img_68cb031a288f14.41708657.jpeg', 'User', '2025-09-17 18:51:06'),
(3, 'Azam', 'azam@gmail.com', '$2y$10$dZC8uETohYl8UDfiDx5IZOQm0Y/p1HyiTEk/qzeRpxkki.7/FpRiW', 'uploads/img_68d2334ef367c7.46342252.jpg', 'User', '2025-09-23 05:42:39'),
(4, 'Janees', 'janees@gmail.com', '$2y$10$JDaPH02YEzlEirBdJ1gPgeRAgs2HDLcIgEL.FcEmE/jhAYx1OVek2', 'uploads/img_68d23c3c8d8aa6.90600622.png', 'User', '2025-09-23 06:20:44'),
(5, 'Aqib', 'aqib@gmail.com', '$2y$10$flGR026uW8Yd9XpWeIBsYOd7C41Lpqf0QPNzhaxU4oW9GlBrSdMAm', 'uploads/img_68d4df6bd93ed3.34370452.jpg', 'User', '2025-09-25 06:21:32'),
(6, 'rehan', 'rehan@gmail.com', '$2y$10$UyX536decH21Qq88KAWiMeTUHZW/F7SBMzrP8tX09IympoYpYLo52', 'uploads/img_68d529708b03c7.42454764.jpg', 'User', '2025-09-25 11:37:20');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `visited_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `ip_address`, `visited_at`) VALUES
(1, '::1', '2025-09-15 10:31:27'),
(2, '::1', '2025-09-15 10:32:08'),
(3, '::1', '2025-09-15 10:32:14'),
(4, '::1', '2025-09-15 10:32:15'),
(5, '::1', '2025-09-15 10:39:29'),
(6, '::1', '2025-09-15 10:40:11'),
(7, '::1', '2025-09-15 10:40:15'),
(8, '::1', '2025-09-15 10:40:41'),
(9, '::1', '2025-09-15 10:41:45'),
(10, '::1', '2025-09-15 10:43:17'),
(11, '::1', '2025-09-15 10:44:03'),
(12, '::1', '2025-09-15 10:45:20'),
(13, '::1', '2025-09-15 10:51:48'),
(14, '::1', '2025-09-15 10:52:38'),
(15, '::1', '2025-09-15 11:11:52'),
(16, '::1', '2025-09-15 11:11:56'),
(17, '::1', '2025-09-17 06:21:22'),
(18, '::1', '2025-09-17 06:23:47'),
(19, '::1', '2025-09-17 06:24:31'),
(20, '::1', '2025-09-17 06:24:39'),
(21, '::1', '2025-09-17 06:24:49'),
(22, '::1', '2025-09-17 06:25:21'),
(23, '::1', '2025-09-17 06:27:53'),
(24, '::1', '2025-09-17 06:35:40'),
(25, '::1', '2025-09-17 06:39:24'),
(26, '::1', '2025-09-17 16:29:52'),
(27, '::1', '2025-09-17 16:31:28'),
(28, '::1', '2025-09-17 16:31:44'),
(29, '::1', '2025-09-17 16:32:19'),
(30, '::1', '2025-09-17 16:32:48'),
(31, '::1', '2025-09-17 16:33:31'),
(32, '::1', '2025-09-17 16:33:50'),
(33, '::1', '2025-09-17 18:21:39'),
(34, '::1', '2025-09-17 18:40:36'),
(35, '::1', '2025-09-17 18:47:08'),
(36, '::1', '2025-09-17 18:48:03'),
(37, '::1', '2025-09-18 06:51:26'),
(38, '::1', '2025-09-18 06:57:24'),
(39, '::1', '2025-09-18 07:55:08'),
(40, '::1', '2025-09-18 13:27:18'),
(41, '::1', '2025-09-18 13:27:40'),
(42, '::1', '2025-09-18 13:27:59'),
(43, '::1', '2025-09-18 14:50:48'),
(44, '::1', '2025-09-18 14:50:59'),
(45, '::1', '2025-09-19 06:02:10'),
(46, '::1', '2025-09-19 06:02:55'),
(47, '::1', '2025-09-19 06:17:15'),
(48, '::1', '2025-09-19 06:17:16'),
(49, '::1', '2025-09-19 06:17:16'),
(50, '::1', '2025-09-19 16:02:03'),
(51, '::1', '2025-09-20 17:24:43'),
(52, '::1', '2025-09-20 17:25:44'),
(53, '::1', '2025-09-20 17:29:55'),
(54, '::1', '2025-09-21 06:45:25'),
(55, '::1', '2025-09-22 08:22:35'),
(56, '::1', '2025-09-22 08:22:45'),
(57, '::1', '2025-09-22 08:26:10'),
(58, '::1', '2025-09-22 08:31:11'),
(59, '::1', '2025-09-22 08:35:34'),
(60, '::1', '2025-09-22 08:35:36'),
(61, '::1', '2025-09-22 08:35:37'),
(62, '::1', '2025-09-22 08:35:38'),
(63, '::1', '2025-09-22 08:35:38'),
(64, '::1', '2025-09-22 09:08:21'),
(65, '::1', '2025-09-22 16:57:54'),
(66, '::1', '2025-09-22 16:59:13'),
(67, '::1', '2025-09-22 16:59:26'),
(68, '::1', '2025-09-22 16:59:39'),
(69, '::1', '2025-09-22 16:59:57'),
(70, '::1', '2025-09-22 17:00:06'),
(71, '::1', '2025-09-22 17:00:06'),
(72, '::1', '2025-09-22 17:00:07'),
(73, '::1', '2025-09-22 17:00:07'),
(74, '::1', '2025-09-22 17:26:15'),
(75, '::1', '2025-09-23 06:24:31'),
(76, '::1', '2025-09-23 06:25:26'),
(77, '::1', '2025-09-23 07:27:26'),
(78, '::1', '2025-09-23 07:27:35'),
(79, '::1', '2025-09-23 07:27:47'),
(80, '::1', '2025-09-23 10:04:09'),
(81, '::1', '2025-09-23 10:04:31'),
(82, '::1', '2025-09-23 10:18:36'),
(83, '::1', '2025-09-23 10:22:47'),
(84, '::1', '2025-09-23 11:06:01'),
(85, '::1', '2025-09-23 14:14:56'),
(86, '::1', '2025-09-23 14:16:49'),
(87, '::1', '2025-09-23 14:39:34'),
(88, '::1', '2025-09-23 14:41:23'),
(89, '::1', '2025-09-23 14:42:28'),
(90, '::1', '2025-09-23 14:42:35'),
(91, '::1', '2025-09-23 14:42:42'),
(92, '::1', '2025-09-23 14:43:40'),
(93, '::1', '2025-09-23 14:44:37'),
(94, '::1', '2025-09-23 14:45:07'),
(95, '::1', '2025-09-23 14:52:48'),
(96, '::1', '2025-09-23 15:24:27'),
(97, '::1', '2025-09-23 15:25:03'),
(98, '::1', '2025-09-23 15:27:23'),
(99, '::1', '2025-09-23 15:27:24'),
(100, '::1', '2025-09-25 05:38:53'),
(101, '::1', '2025-09-25 05:52:36'),
(102, '::1', '2025-09-25 05:53:18'),
(103, '::1', '2025-09-25 05:53:32'),
(104, '::1', '2025-09-25 05:53:46'),
(105, '::1', '2025-09-25 05:54:03'),
(106, '::1', '2025-09-25 05:56:45'),
(107, '::1', '2025-09-25 05:56:46'),
(108, '::1', '2025-09-25 05:56:47'),
(109, '::1', '2025-09-25 06:08:17'),
(110, '::1', '2025-09-25 06:11:59'),
(111, '::1', '2025-09-25 06:48:24'),
(112, '::1', '2025-09-25 07:00:28'),
(113, '::1', '2025-09-25 07:02:05'),
(114, '::1', '2025-09-25 07:02:05'),
(115, '::1', '2025-09-25 07:02:53'),
(116, '::1', '2025-09-25 11:30:37'),
(117, '::1', '2025-09-25 11:35:20'),
(118, '::1', '2025-09-25 14:06:08'),
(119, '::1', '2025-09-25 14:11:13'),
(120, '::1', '2025-09-25 15:30:44'),
(121, '::1', '2025-09-25 15:39:28'),
(122, '::1', '2025-09-25 15:41:33'),
(123, '::1', '2025-09-25 16:50:01'),
(124, '::1', '2025-09-26 06:19:35'),
(125, '::1', '2025-09-26 11:18:18'),
(126, '::1', '2025-09-26 16:02:01'),
(127, '::1', '2025-09-26 16:06:31'),
(128, '::1', '2025-09-26 16:07:34'),
(129, '::1', '2025-09-26 16:08:26'),
(130, '::1', '2025-09-26 16:08:51'),
(131, '::1', '2025-09-26 16:09:01'),
(132, '::1', '2025-09-26 16:09:02'),
(133, '::1', '2025-09-26 16:09:19'),
(134, '::1', '2025-09-26 16:11:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contect`
--
ALTER TABLE `contect`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contect`
--
ALTER TABLE `contect`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
