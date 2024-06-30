-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 30, 2024 at 12:16 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `punditfc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$4FgLivzZhL3BoQhK6kwUjugHtkY.wOvwd8waQFPGeskqllQfmdDJe', '2024-06-27 03:28:53', '2024-06-26 20:30:26');

-- PASSWORD admin123

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `home_team` varchar(255) NOT NULL,
  `away_team` varchar(255) NOT NULL,
  `match_time` datetime NOT NULL,
  `is_home_game` tinyint(1) NOT NULL,
  `tournament_name` varchar(255) NOT NULL,
  `purchase_duration` datetime NOT NULL,
  `stadium_name` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'scheduled',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `home_team`, `away_team`, `match_time`, `is_home_game`, `tournament_name`, `purchase_duration`, `stadium_name`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Pundit FC', 'Tes Soccer Team', '2024-06-30 11:00:00', 1, 'Liga Dagelan', '2024-06-29 11:00:00', 'Manahan', 'scheduled', '2024-06-26 21:01:36', '2024-06-26 21:01:36'),
(4, 'Jogja City FC', 'Pundit FC', '2024-06-29 19:30:00', 0, 'Persahabatan', '2024-06-29 19:30:00', 'Maguwo Std', 'scheduled', '2024-06-28 08:56:21', '2024-06-28 08:56:21'),
(5, 'Pundit FC', 'Persija Jakarta', '2024-06-30 10:00:00', 1, 'Liga Dagelan', '2024-06-30 08:45:00', 'Maguwo', 'scheduled', '2024-06-29 18:37:52', '2024-06-29 18:37:52'),
(6, 'Pundit FC', 'Inter Miami FC', '2024-07-03 19:30:00', 1, 'Indonesia Cup', '2024-07-02 12:00:00', 'Maguwo', 'scheduled', '2024-06-29 21:22:37', '2024-06-29 21:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `qr_code` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `quantity` int(11) DEFAULT NULL,
  `status` enum('paid','redeemed') NOT NULL DEFAULT 'paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `game_id`, `ticket_id`, `qr_code`, `created_at`, `payment_method`, `payment_status`, `updated_at`, `quantity`, `status`) VALUES
(4, 1, 3, 5, '4135', '2024-06-27 20:46:49', 'direct', 'completed', '2024-06-28 02:34:36', 2, 'redeemed'),
(5, 2, 3, 8, '5238', '2024-06-28 01:30:30', 'direct', 'completed', '2024-06-28 02:36:27', 1, 'redeemed'),
(8, 2, 3, 6, '8236', '2024-06-28 01:36:08', 'direct', 'completed', '2024-06-30 04:33:17', 1, 'redeemed'),
(9, 3, 3, 5, '9335', '2024-06-28 02:01:12', 'direct', 'completed', '2024-06-28 02:01:12', 1, 'paid'),
(10, 2, 6, 14, '102614', '2024-06-29 21:41:34', 'direct', 'completed', '2024-06-29 21:41:34', 1, 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `game_id`, `category`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(5, 3, 'VIP', 10, 100000, '2024-06-26 21:01:36', '2024-06-26 21:01:36'),
(6, 3, 'A', 50, 75000, '2024-06-26 21:01:36', '2024-06-26 21:01:36'),
(7, 3, 'B', 100, 50000, '2024-06-26 21:01:36', '2024-06-26 21:01:36'),
(8, 3, 'Guest Supporter', 1, 75000, '2024-06-26 21:01:36', '2024-06-28 15:52:06'),
(9, 5, 'VIP', 10, 500000, '2024-06-29 18:37:52', '2024-06-29 18:37:52'),
(10, 5, 'A', 50, 300000, '2024-06-29 18:37:52', '2024-06-29 18:37:52'),
(11, 5, 'B', 100, 200000, '2024-06-29 18:37:52', '2024-06-29 18:37:52'),
(12, 5, 'Guest Supporter', 50, 200000, '2024-06-29 18:37:52', '2024-06-29 18:37:52'),
(13, 6, 'VIP', 5, 500000, '2024-06-29 21:22:37', '2024-06-29 21:22:37'),
(14, 6, 'A', 50, 200000, '2024-06-29 21:22:37', '2024-06-29 21:22:37'),
(15, 6, 'B', 100, 150000, '2024-06-29 21:22:37', '2024-06-29 21:22:37'),
(16, 6, 'Guest Supporter', 100, 150000, '2024-06-29 21:22:37', '2024-06-29 21:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(20) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `phone_number`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Abdullah Fikri Handi Saputra', 'Wonogiri', '6289692703057', 'abdullahfikrihandi@icloud.com', '$2y$12$buPHMKW0WCCl1PtdA8TL5efrbyd7DcDaFmoqSDFWtQwMLhREfjjYC', '2024-06-27 07:31:53', '2024-06-27 19:16:07'),
(2, 'Sugeng', 'Surakarta', '6289692703057', 'fikrihandy@my.id', '$2y$12$JHGI766KzcpeZ4AKEXsRMO0I8NY1k7HPBJW1Tmr2YHFMANqgpcBfW', '2024-06-28 01:28:42', '2024-06-28 23:05:49'),
(3, 'Handi Saputra', NULL, NULL, 'handi@saputra.id', '$2y$12$eSjbrTi3zU490YL.06NQGOPBr8UI8dWuohkTJtzz8buACHxwNb/qa', '2024-06-28 02:00:41', '2024-06-28 02:00:41'),
(4, 'Error Tes', NULL, NULL, 'error@tes.id', '$2y$12$oULCUyc6PCXEO9LCfXyMjegqBtDH72cFI7LbbmhoKSmX1fZsmu9he', '2024-06-28 22:22:32', '2024-06-28 22:22:32'),
(5, 'Saputra Junior', 'Singapore', NULL, 'abdullahfikrihandi@gmail.com', '$2y$12$9PHCU1.zReEEt4ZbSnlnluyZLUW/6OZLiFpE.d0JWZdP5UIdDLjS6', '2024-06-30 04:40:49', '2024-06-30 05:12:21');

-- PASSWORD 123456

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `fk_orders_ticket` (`ticket_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_ticket` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`),
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
