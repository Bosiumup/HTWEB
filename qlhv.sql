-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 01:43 PM
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
-- Table structure for table `criteria`
--

CREATE TABLE `criteria` (
  `criteria_id` int(11) NOT NULL,
  `standard_id` int(11) DEFAULT NULL,
  `criteria_name` varchar(255) DEFAULT NULL,
  `points` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`criteria_id`, `standard_id`, `criteria_name`, `points`) VALUES
(1, 1, 'Tiêu chí 1.1', 5),
(2, 1, 'Tiêu chí 1.2', 5),
(3, 2, 'Tiêu chí 2.1', 5),
(4, 2, 'Tiêu chí 2.2', 5),
(5, 3, 'Tiêu chí 3.1', 5),
(6, 3, 'Tiêu chí 3.2', 5),
(7, 4, 'Tiêu chí 4.1', 5),
(8, 4, 'Tiêu chí 4.2', 5),
(9, 5, 'Tiêu chí 5.1', 5),
(10, 5, 'Tiêu chí 5.2', 5),
(11, 6, 'Tiêu chí 6.1', 5),
(12, 6, 'Tiêu chí 6.2', 5),
(13, 7, 'Tiêu chí 7.1', 5),
(14, 7, 'Tiêu chí 7.2', 5),
(15, 8, 'Tiêu chí 8.1', 5),
(16, 8, 'Tiêu chí 8.2', 5),
(17, 9, 'Tiêu chí 9.1', 5),
(18, 9, 'Tiêu chí 9.2', 5),
(19, 10, 'Tiêu chí 10.1', 5),
(20, 10, 'Tiêu chí 10.2', 5);

-- --------------------------------------------------------

--
-- Table structure for table `detail_evaluation`
--

CREATE TABLE `detail_evaluation` (
  `detail_evaluation_id` int(11) NOT NULL,
  `evaluation_id` int(11) NOT NULL,
  `standard_id` int(11) NOT NULL,
  `criteria_id` int(11) NOT NULL,
  `user_rating` int(11) NOT NULL,
  `admin_rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `detail_evaluation`
--

INSERT INTO `detail_evaluation` (`detail_evaluation_id`, `evaluation_id`, `standard_id`, `criteria_id`, `user_rating`, `admin_rating`) VALUES
(193, 653224, 1, 1, 5, 5),
(194, 653224, 1, 2, 5, 5),
(195, 653224, 2, 3, 5, 5),
(196, 653224, 2, 4, 5, 5),
(197, 653224, 3, 5, 5, 5),
(198, 653224, 3, 6, 5, 5),
(199, 653224, 4, 7, 5, 5),
(200, 653224, 4, 8, 5, 5),
(201, 653224, 5, 9, 5, 5),
(202, 653224, 5, 10, 5, 5),
(203, 653224, 6, 11, 5, 5),
(204, 653224, 6, 12, 5, 5),
(205, 653224, 7, 13, 5, 5),
(206, 653224, 7, 14, 5, 5),
(207, 653224, 8, 15, 5, 5),
(208, 653224, 8, 16, 5, 5),
(209, 653224, 9, 17, 5, 5),
(210, 653224, 9, 18, 5, 5),
(211, 653224, 10, 19, 5, 5),
(212, 653224, 10, 20, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

CREATE TABLE `evaluations` (
  `evaluation_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `evaluations`
--

INSERT INTO `evaluations` (`evaluation_id`, `username`, `status`, `pass`) VALUES
(653224, 'NgocCam', 'Đã đánh giá', 'Đạt');

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
('QLHV/dll5ioodklf99bu2s0mt', 'https://res.cloudinary.com/dibdjlwrn/image/upload/v1716723079/QLHV/dll5ioodklf99bu2s0mt.jpg', 'MinhThien', '$2y$10$VA8.X5An.hMCQRoTf4n8/OXcoBpVItmWQkgs5rF3YRGw6K8oIpn8e', 'Lý Ngọc Minh Thiện', 'Male', 2003, 'Cần thơ', 0),
('QLHV/vab3jotte7txfvv2gzdz', 'https://res.cloudinary.com/dibdjlwrn/image/upload/v1716723172/QLHV/vab3jotte7txfvv2gzdz.jpg', 'NgocCam', '$2y$10$RIXsCY2Xt.WFrWqahtNyGezmidW6gE5HxgYx0/fLWthyJuO0mqwQO', 'Đinh Thị Ngọc Cầm', 'Female', 2003, 'Sóc trăng', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`criteria_id`),
  ADD KEY `standard_id` (`standard_id`);

--
-- Indexes for table `detail_evaluation`
--
ALTER TABLE `detail_evaluation`
  ADD PRIMARY KEY (`detail_evaluation_id`),
  ADD KEY `fk_evaluation` (`evaluation_id`),
  ADD KEY `fk_criteria` (`criteria_id`),
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
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
  MODIFY `criteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `detail_evaluation`
--
ALTER TABLE `detail_evaluation`
  MODIFY `detail_evaluation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `standards`
--
ALTER TABLE `standards`
  MODIFY `standard_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `criteria`
--
ALTER TABLE `criteria`
  ADD CONSTRAINT `criteria_ibfk_1` FOREIGN KEY (`standard_id`) REFERENCES `standards` (`standard_id`);

--
-- Constraints for table `detail_evaluation`
--
ALTER TABLE `detail_evaluation`
  ADD CONSTRAINT `fk_criteria` FOREIGN KEY (`criteria_id`) REFERENCES `criteria` (`criteria_id`),
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
