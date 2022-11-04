-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2022 at 07:43 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barangay_agusi`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_udpated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `resets`
--

CREATE TABLE `resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `access_key` varchar(255) NOT NULL,
  `expiration` datetime NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `residences`
--

CREATE TABLE `residences` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `registration_key` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `maiden_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `sex` varchar(255) NOT NULL,
  `civil_status` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `educational_attainment` varchar(255) DEFAULT NULL,
  `family_planning` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `home_or_lot_number` varchar(255) NOT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `district` tinyint(4) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `residences`
--

INSERT INTO `residences` (`id`, `user_id`, `registration_key`, `last_name`, `first_name`, `maiden_name`, `middle_name`, `sex`, `civil_status`, `birth_date`, `place_of_birth`, `educational_attainment`, `family_planning`, `occupation`, `home_or_lot_number`, `street_address`, `district`, `date_created`, `date_updated`) VALUES
(2, NULL, NULL, 'Bugan', 'Rosalinda', 'Cosi', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, '2022-10-26 00:01:45', '2022-10-26 00:01:45'),
(3, NULL, NULL, 'Bugan', 'Kendra Pauline', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, '2022-10-26 00:01:45', '2022-10-26 00:01:45'),
(4, NULL, NULL, 'Taguya', 'Ryan', NULL, 'Dalit', 'Male', '', NULL, NULL, NULL, NULL, NULL, '', NULL, 1, '2022-10-26 01:05:36', '2022-10-26 01:05:36'),
(5, NULL, NULL, 'Tagupa', 'Jesus', NULL, 'Doronio', 'Male', '', NULL, NULL, NULL, NULL, NULL, '', NULL, 1, '2022-10-26 01:06:46', '2022-10-26 01:06:46'),
(6, NULL, NULL, 'Tagupa', 'Luzviminda', 'Irorita', 'Reguimin', 'Female', 'Married', '1957-11-30', NULL, NULL, NULL, NULL, '', NULL, 1, '2022-10-26 01:07:45', '2022-10-26 01:07:45');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `vision` text NOT NULL,
  `mission` text NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `contact_address` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `vision`, `mission`, `contact_email`, `contact_number`, `contact_address`, `date_created`, `date_updated`) VALUES
(1, 'Barangay Agusi, shall be an economically stable community, peaceful and a center of tourism in Northern Cagayan.', 'To uplift the living condition of the people and maintain peace and order in the community.', 'cleinentine@gmail.com', '(+63)969-485-6292', 'Agusi Camalaniugan Cagayan, Philippines, 3510', '2022-10-27 08:52:05', '2022-10-27 08:52:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `access_level` tinyint(4) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `mobile_number`, `password`, `access_level`, `date_created`, `date_updated`) VALUES
(1, 'admin@gmail.com', NULL, '$2y$10$tngXcEH/U4NyPGfeSR2mLeGNOr3oZ1mML./.bYi5eG/pVbICY03zS', 2, '2022-10-23 10:03:16', '2022-10-26 04:30:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resets`
--
ALTER TABLE `resets`
  ADD PRIMARY KEY (`email`) USING BTREE;

--
-- Indexes for table `residences`
--
ALTER TABLE `residences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile_number` (`mobile_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `residences`
--
ALTER TABLE `residences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `resets`
--
ALTER TABLE `resets`
  ADD CONSTRAINT `resets_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `residences`
--
ALTER TABLE `residences`
  ADD CONSTRAINT `residences_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
