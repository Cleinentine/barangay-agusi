-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2022 at 07:39 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
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
  `house_or_lot_number` varchar(255) NOT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `district` tinyint(4) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`id`, `user_id`, `registration_key`, `last_name`, `first_name`, `maiden_name`, `middle_name`, `sex`, `civil_status`, `birth_date`, `place_of_birth`, `educational_attainment`, `family_planning`, `occupation`, `house_or_lot_number`, `street_address`, `district`, `date_created`, `date_updated`) VALUES
(1, NULL, '5463893e83c89505cd4804f8e71dd6b2d7d5788d2b21733d4232d4870c885127', 'Bugan', 'Domingo', '', '', '', '', NULL, '', '', '', '', '', '', 1, '2022-11-04 13:16:36', '2022-11-04 14:28:03'),
(2, NULL, 'f1ad4e37d72fd7f18bfa9443f75d285baeec54d5aa639765b209e3dfd098eece', 'Bugan', 'Rosalinda', 'Cosl', '', '', '', NULL, '', '', '', '', '', '', 1, '2022-11-04 13:16:36', '2022-11-04 13:16:36'),
(3, NULL, '6bc599e10eb0785514e5880295791f1bf7b095fd21ebb84a9a068319091de2f7', 'Bugan', 'Kendra Pauline', '', '', '', '', NULL, '', '', '', '', '', '', 1, '2022-11-04 13:16:36', '2022-11-04 13:16:36'),
(4, NULL, 'bfd9e23bc2c70982c13984415b26f664303028a766f53f12810db70a4f980935', 'Dela Cruz', 'Jonathan', 'Roploc', 'Mercado', 'Male', 'Married', '1996-09-07', '', '', '', '', '', '', 1, '2022-11-04 13:16:36', '2022-11-04 13:16:36'),
(5, NULL, '1647a8e094d96ae3e488fbcdf4a158073c1705fae104b05fbb4bbcdd9d6653f0', 'Dumbrique', '', 'Tadili', 'Andres', 'Male', 'Married', '1967-11-26', 'Camalaniugan', '', '', '', '', '', 1, '2022-11-04 13:16:36', '2022-11-04 13:16:36'),
(6, NULL, 'f2e7dd40613c098c12b4af5ba11c0b46112c75e4bbf9dfcb25ddfaa5edea6c8e', 'Dumbrique', 'Josephine', 'Diego', 'Lopio', 'Female', 'Married', '1970-10-24', 'Camalaniugan', '', '', '', '', '', 1, '2022-11-04 13:16:36', '2022-11-04 13:16:36'),
(7, NULL, '33d8ac41a6271bd707e61321b1445983d7ba03566d2395d8019bf984d9f1960d', 'Dumbrique', 'Catherine', '', 'Lopio', 'Female', 'Single', '1984-07-17', 'Camalaniugan', '', '', '', '', '', 1, '2022-11-04 13:16:36', '2022-11-04 13:16:36'),
(8, NULL, '72a78be6aafba0c6e86bd91496611b256826f903dc73e5238e9d6fede2f55a17', 'Littaua', 'Jeffrey', '', 'Calagui', 'Male', 'Single', '1989-01-19', 'Camalaniugan', '', '', '', '', '', 1, '2022-11-04 13:16:36', '2022-11-04 13:16:36'),
(9, NULL, 'f99058ffca5398c48836669cb7bb2defe231ffeee65bbd73034c60ad88104bda', 'Littaua', 'Carl Jefferson', 'Lopio', 'Dumbrique', 'Male', '', '2011-04-09', 'Camalaniugan', '', '', '', '', '', 1, '2022-11-04 13:16:36', '2022-11-04 13:16:36'),
(10, NULL, '9d79fa094f05fc64c4f728c722db749daf4a8bd4784f71b661053ee30950da7b', 'Littaua', 'Celine Jane', 'Lopio', 'Dumbrique', 'Female', '', '2012-12-29', 'Camalaniugan', '', '', '', '', '', 1, '2022-11-04 13:16:36', '2022-11-04 13:16:36'),
(11, NULL, '82a9b92a26da59b59c2d3d62ec84733dbebc3ae4b62d8dcc53db53f9065a9ecf', 'Pascual', 'Leim', '', 'Duldulao', 'Male', 'Married', '1951-07-27', '', '', '', '', '', '', 1, '2022-11-04 13:16:36', '2022-11-04 13:16:36'),
(12, NULL, '5a232d2fccc97d911e886f0e0782c40a2a968e192106dec1725af7ea48dd3648', 'Siquerra', 'Rosario', '', '', '', '', NULL, '', '', '', '', '', '', 1, '2022-11-04 13:16:36', '2022-11-04 13:16:36'),
(13, NULL, 'd48da687cd25aa4eda3f76e7850506317e49b7099ba2d9b3fb3b7af15fd77ff6', 'Taguya', 'Ryan', '', 'Dalit', '', '', NULL, '', '', '', '', '', '', 1, '2022-11-04 13:16:36', '2022-11-04 13:16:36'),
(14, NULL, '494b4180d1572e2b268f9618992f3e205468fc1fb325a789eef63d8ece8acfb9', 'Tumaneng', 'Salvador Sr.', '', 'Lazaro', 'Male', 'Single', '1971-02-21', 'Piat Cagayan', 'Elementary', '', '', '', '', 1, '2022-11-04 13:16:36', '2022-11-04 13:16:36'),
(15, NULL, '24d4394dfda5dd5c40e8bafa8a488c637ceea881bbf98aea03f52640d827bd72', '', 'Lilia', 'Gacula', 'Mateo', 'Female', 'Married', '1955-03-04', '', '', '', '', '', '', 1, '2022-11-04 13:16:36', '2022-11-04 13:16:36'),
(16, NULL, '89290952a0d67c5ecabdc6814cf9a51fa9516bfa1fee78f9420385373121ecd3', '', 'Kristine', 'Roploc', 'Dumbrique', 'Female', 'Married', '1996-12-23', '', '', '', '', '', '', 1, '2022-11-04 13:16:36', '2022-11-04 13:16:36'),
(17, NULL, '16efcd7c42bae623e4d2a34f944c2e085a6565ee487bba95559b6b99cb1d882b', '', 'Lazuli Blue', 'Roploc', 'Dumbrique', 'Female', '', '2022-02-26', '', '', '', '', '', '', 1, '2022-11-04 13:16:36', '2022-11-04 13:16:36'),
(18, NULL, '2e8c071b6235092f8486720da286973c6f1abe68ffa18d94843a5b097053c592', '', 'Ismael', '', 'Gonzales', 'Male', 'Single', '1994-05-24', 'Camalaniugan', 'Highschool', '', '', '', '', 1, '2022-11-04 13:16:36', '2022-11-04 13:16:36'),
(19, NULL, '56972d30a6273ab371f512f754274cb2e6a1e05139f1232a5da3d6644068f6d3', '', 'Jeffrey', '', 'Gonzales', 'Male', 'Single', '2000-01-03', '', 'Elementary', '', '', '', '', 1, '2022-11-04 13:16:36', '2022-11-04 13:16:36'),
(20, NULL, '8fab041d6fb359396e12f2067d800dea96af7e30ab94aabede0f467d28ce2ec3', '', 'Czianah Jhaizyn', 'Lopio', 'Dumbrique', '', '', '2021-12-21', 'Aparri', '', '', '', '', '', 1, '2022-11-04 13:16:36', '2022-11-04 13:16:36');

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
(1, 'Barangay Agusi, shall be an economically stable community, peaceful and a center of tourism in Northern Cagayan.', 'To uplift the living condition of the people and maintain peace and order in the community.', 'sample@gmail.com', '09123456789', 'Agusi Camalaniugan Cagayan, Philippines, 3510', '2022-10-27 08:52:05', '2022-11-04 13:40:31');

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
(1, 'admin@gmail.com', '', '$2y$10$4r9QTI46LnCKviHUzjnCOO4OcoSGFCecrNank5tGIMSL4YCJLbds6', 2, '2022-10-23 10:03:16', '2022-11-04 13:12:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `resets`
--
ALTER TABLE `resets`
  ADD PRIMARY KEY (`email`) USING BTREE;

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
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
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
-- Constraints for table `residents`
--
ALTER TABLE `residents`
  ADD CONSTRAINT `residents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
