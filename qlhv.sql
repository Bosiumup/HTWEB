-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 05:07 PM
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
-- Database: `qlhv`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_evaluation`
--

CREATE TABLE `detail_evaluation` (
  `detail_evaluation_id` int(11) NOT NULL,
  `evaluation_id` int(11) NOT NULL,
  `standard_id` int(11) NOT NULL,
  `user_rating` int(11) NOT NULL,
  `admin_rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

CREATE TABLE `evaluations` (
  `evaluation_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `standards`
--

CREATE TABLE `standards` (
  `standard_id` int(11) NOT NULL,
  `standard_name` varchar(255) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `standards`
--

INSERT INTO `standards` (`standard_id`, `standard_name`, `points`) VALUES
(1, 'Tiêu chuẩn 1', 10),
(2, 'Tiêu chuẩn 2', 10),
(3, 'Tiêu chuẩn 3', 10),
(4, 'Tiêu chuẩn 4', 10),
(5, 'Tiêu chuẩn 5', 10),
(6, 'Tiêu chuẩn 6', 10),
(7, 'Tiêu chuẩn 7', 10),
(8, 'Tiêu chuẩn 8', 10),
(9, 'Tiêu chuẩn 9', 10),
(10, 'Tiêu chuẩn 10', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `public_id` varchar(500) NOT NULL,
  `avatar_url` varchar(500) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birth_year` int(11) NOT NULL,
  `hometown` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`public_id`, `avatar_url`, `username`, `password`, `name`, `gender`, `birth_year`, `hometown`, `role`) VALUES
('QLHV/rd9kdzvdk8ndnup9ucct', 'https://res.cloudinary.com/dibdjlwrn/image/upload/v1716255176/QLHV/rd9kdzvdk8ndnup9ucct.jpg', 'MinhThien', '$2y$10$yxa5PZRKpo9UkLzV6KYOZ.R6WVA08ETjbrQvPD1LdYb2hcOG9yQiq', 'Minh Thiện', 'Male', 2003, 'Can Tho', 0),
('QLHV/fdfippuhaadl5fhd9qd0', 'https://res.cloudinary.com/dibdjlwrn/image/upload/v1716257129/QLHV/fdfippuhaadl5fhd9qd0.jpg', 'NgocCam', '$2y$10$MuaxL8hL0NwheJNTOXMo2Oc9LwBWPpuNUpZKa1pX0YzfkGHb0h7bS', 'Đinh Thị Ngọc Cầm', 'Female', 2003, 'Sóc trăng', 1),
('QLHV/uwn8ndwwudboqkmznmrj', 'https://res.cloudinary.com/dibdjlwrn/image/upload/v1716259232/QLHV/uwn8ndwwudboqkmznmrj.jpg', 'thien', '$2y$10$0lTOjUz2ow/8GWt9jSz61.TITTdMkvjNShD/YiXKek0tpgQIRyfH.', 'thien ne', 'Male', 2003, 'can tho', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_evaluation`
--
ALTER TABLE `detail_evaluation`
  ADD PRIMARY KEY (`detail_evaluation_id`),
  ADD KEY `fk_evaluation` (`evaluation_id`),
  ADD KEY `fk_standard` (`standard_id`);

--
-- Indexes for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`evaluation_id`),
  ADD KEY `fk_user` (`username`);

--
-- Indexes for table `standards`
--
ALTER TABLE `standards`
  ADD PRIMARY KEY (`standard_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_evaluation`
--
ALTER TABLE `detail_evaluation`
  MODIFY `detail_evaluation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `standards`
--
ALTER TABLE `standards`
  MODIFY `standard_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_evaluation`
--
ALTER TABLE `detail_evaluation`
  ADD CONSTRAINT `fk_evaluation` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluations` (`evaluation_id`),
  ADD CONSTRAINT `fk_standard` FOREIGN KEY (`standard_id`) REFERENCES `standards` (`standard_id`);

--
-- Constraints for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
