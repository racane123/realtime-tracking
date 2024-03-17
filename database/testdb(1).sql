-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Mar 17, 2024 at 02:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `driver_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`driver_id`, `user_id`, `name`) VALUES
(6, 3, 'test_name'),
(7, 1, 'truck1');

-- --------------------------------------------------------

--
-- Table structure for table `owner_info`
--

CREATE TABLE `owner_info` (
  `id` int(11) NOT NULL,
  `owner_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_data` longblob NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owner_info`
--

INSERT INTO `owner_info` (`id`, `owner_name`, `address`, `file_name`, `file_data`, `created_at`) VALUES
(1, 'test', 'address', 'ERD.docx', '', '2024-03-14 09:12:37'),
(2, 'test', 'address', 'ERD.docx', '', '2024-03-14 09:13:06'),
(3, 'test', 'sadsa', '1.png', '', '2024-03-14 09:13:21'),
(4, 'test', 'test', 'uploads/LGU (1).xlsx', '', '2024-03-14 10:27:47');

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE `points` (
  `id` int(11) NOT NULL,
  `longitude` decimal(10,6) DEFAULT NULL,
  `latitude` decimal(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`id`, `longitude`, `latitude`) VALUES
(1, 121.100567, 14.684612);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `route_id` int(11) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `end_location` geometry NOT NULL,
  `constraints` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Assigned','Completed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `driver_id`, `end_location`, `constraints`, `status`) VALUES
(1, 6, 0x00000000010100000078895e37c0425e40c80dda24f8832d40, 'test_end_point', 'Pending'),
(2, 6, 0x000000000101000000e4c444c140435e404889fb7858862d40, 'Routing', 'Pending'),
(3, 7, 0x000000000101000000f87589ed143f5e40c830cfd3de7a2d40, 'Santa Lucia', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `testpost`
--

CREATE TABLE `testpost` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testpost`
--

INSERT INTO `testpost` (`id`, `title`, `message`) VALUES
(1, 'test_title', 'test_message');

-- --------------------------------------------------------

--
-- Table structure for table `truck_location`
--

CREATE TABLE `truck_location` (
  `id` int(11) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `truck_location`
--

INSERT INTO `truck_location` (`id`, `latitude`, `longitude`, `timestamp`) VALUES
(1, 14.68374031, 121.10186508, '2024-03-16 23:56:15'),
(2, 14.68353953, 121.10192729, '2024-03-16 23:56:23'),
(3, 14.68353953, 121.10192729, '2024-03-16 23:56:30'),
(4, 14.68347193, 121.10193138, '2024-03-16 23:56:48'),
(5, 14.68347193, 121.10193138, '2024-03-16 23:57:32'),
(6, 14.68347193, 121.10193138, '2024-03-16 23:57:37'),
(7, 14.68369697, 121.10185489, '2024-03-16 23:58:41'),
(8, 14.68348599, 121.10192560, '2024-03-16 23:59:54'),
(9, 14.68344944, 121.10193548, '2024-03-17 00:01:16'),
(10, 14.68344944, 121.10193548, '2024-03-17 00:01:30'),
(11, 14.68369705, 121.10184927, '2024-03-17 00:01:35'),
(12, 14.68374457, 121.10187350, '2024-03-17 00:01:54'),
(13, 14.68374457, 121.10187350, '2024-03-17 00:02:22'),
(14, 14.68374457, 121.10187350, '2024-03-17 00:02:35'),
(15, 14.68374457, 121.10187350, '2024-03-17 00:02:56'),
(16, 14.68374457, 121.10187350, '2024-03-17 00:03:03'),
(17, 14.68369263, 121.10182653, '2024-03-17 00:06:21'),
(18, 14.68371555, 121.10183052, '2024-03-17 00:06:58'),
(19, 14.68371555, 121.10183052, '2024-03-17 00:08:12'),
(20, 14.68372475, 121.10182772, '2024-03-17 00:08:23'),
(21, 14.68373553, 121.10182444, '2024-03-17 00:08:54'),
(22, 14.68371018, 121.10181913, '2024-03-17 00:09:00'),
(23, 14.68371018, 121.10181913, '2024-03-17 00:18:29'),
(24, 14.68371018, 121.10181913, '2024-03-17 00:18:36'),
(25, 14.68369263, 121.10182653, '2024-03-17 00:19:52'),
(26, 14.68369263, 121.10182653, '2024-03-17 00:20:09'),
(27, 14.68369263, 121.10182653, '2024-03-17 00:21:12'),
(28, 14.68371018, 121.10181913, '2024-03-17 00:22:24'),
(29, 14.68371018, 121.10181913, '2024-03-17 00:22:37'),
(30, 14.68372173, 121.10183095, '2024-03-17 00:22:51'),
(31, 14.68372173, 121.10183095, '2024-03-17 00:22:53'),
(32, 14.68345157, 121.10192876, '2024-03-17 00:23:59'),
(33, 14.68345157, 121.10192876, '2024-03-17 00:24:32'),
(34, 14.68345157, 121.10192876, '2024-03-17 00:25:09'),
(35, 14.68345157, 121.10192876, '2024-03-17 00:25:11'),
(36, 14.68372323, 121.10180979, '2024-03-17 00:26:58'),
(37, 14.68372729, 121.10179875, '2024-03-17 00:29:05'),
(38, 14.68372323, 121.10180979, '2024-03-17 00:29:17'),
(39, 14.68371018, 121.10181913, '2024-03-17 00:29:48'),
(40, 14.68372323, 121.10180979, '2024-03-17 00:33:37'),
(41, 14.68372323, 121.10180979, '2024-03-17 00:33:38'),
(42, 14.68372323, 121.10180979, '2024-03-17 00:41:00'),
(43, 14.68371018, 121.10181913, '2024-03-17 00:41:28'),
(44, 14.68371018, 121.10181913, '2024-03-17 00:41:29'),
(45, 14.68371018, 121.10181913, '2024-03-17 00:41:30'),
(46, 14.68371018, 121.10181913, '2024-03-17 00:41:31'),
(47, 14.68371018, 121.10181913, '2024-03-17 00:41:33'),
(48, 14.68371018, 121.10181913, '2024-03-17 00:41:34'),
(49, 14.68371018, 121.10181913, '2024-03-17 00:42:47'),
(50, 14.68371018, 121.10181913, '2024-03-17 00:42:50'),
(51, 14.68370065, 121.10182315, '2024-03-17 00:42:59'),
(52, 14.68371158, 121.10181506, '2024-03-17 00:44:14'),
(53, 14.68371247, 121.10181020, '2024-03-17 00:48:57'),
(54, 14.68341446, 121.10192846, '2024-03-17 00:53:37'),
(55, 14.68342968, 121.10192718, '2024-03-17 00:54:54'),
(56, 14.68342968, 121.10192718, '2024-03-17 00:55:03'),
(57, 14.68342968, 121.10192718, '2024-03-17 00:55:04'),
(58, 14.68370918, 121.10179281, '2024-03-17 01:02:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Driver') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`) VALUES
(1, 'admin@gmail.com', 'admin', 'Admin'),
(2, 'test', 'password', 'Driver'),
(3, 'test_username', 'password', 'Driver');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driver_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `owner_info`
--
ALTER TABLE `owner_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`route_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `testpost`
--
ALTER TABLE `testpost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `truck_location`
--
ALTER TABLE `truck_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `owner_info`
--
ALTER TABLE `owner_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `points`
--
ALTER TABLE `points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `testpost`
--
ALTER TABLE `testpost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `truck_location`
--
ALTER TABLE `truck_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `routes`
--
ALTER TABLE `routes`
  ADD CONSTRAINT `routes_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`driver_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
