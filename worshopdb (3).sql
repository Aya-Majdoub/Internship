-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2025 at 05:00 PM
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
-- Database: `worshopdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `registration_ID` int(11) NOT NULL,
  `registration_date` date DEFAULT NULL,
  `user_ID` int(11) DEFAULT NULL,
  `workshop_ID` int(11) DEFAULT NULL,
  `par_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`registration_ID`, `registration_date`, `user_ID`, `workshop_ID`, `par_status`) VALUES
(1111, '2025-07-04', 11, 111, 'student'),
(2222, '2025-07-05', 22, 222, 'student'),
(3333, '2025-07-06', 33, 333, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `username`, `user_email`, `status`, `password`) VALUES
(11, 'username1', 'user1@example.com', 'participant', NULL),
(22, 'username2', 'user2@example.com\r\n', 'participant', NULL),
(33, 'username3', 'user3@example.com', 'participant', NULL),
(34, 'username4', 'user4@example.com', 'participant', NULL),
(36, 'username5', 'user5@example.com', 'participant', NULL),
(37, 'username6', 'user6@example.com', 'participant', NULL),
(39, 'admin1', 'admin1@example.com', 'admin', '$2y$10$chmYP67UyUQ4RUbjiJ6OS.LsE8du4oRmXYg4JdkG/CegI4YgjRhfa'),
(43, 'TEST', 'TEST', NULL, NULL),
(44, 'hiiiiiiii', 'hjyfuszyutyuyuyuyuyuyuyu', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `workshop`
--

CREATE TABLE `workshop` (
  `workshop_ID` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `workshop_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `user_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workshop`
--

INSERT INTO `workshop` (`workshop_ID`, `title`, `workshop_date`, `start_time`, `end_time`, `description`, `location`, `capacity`, `category`, `user_ID`) VALUES
(111, 'Workshop sample1', '2025-07-10', '09:00:00', '10:00:00', 'this is description for workhshop 1 ', 'room 1', 20, 'theater', 39),
(222, 'workshop sample 2', '2025-07-10', '11:00:00', '12:00:00', 'this is description for workshop 2', 'amphi 2', 15, 'arts', NULL),
(333, 'workshop sample 3', '2025-07-11', '13:00:00', '14:00:00', 'This is description for workshop 3', 'room 3', 10, 'music', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`registration_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `workshop_ID` (`workshop_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `workshop`
--
ALTER TABLE `workshop`
  ADD PRIMARY KEY (`workshop_ID`),
  ADD UNIQUE KEY `user_ID` (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`),
  ADD CONSTRAINT `registration_ibfk_2` FOREIGN KEY (`workshop_ID`) REFERENCES `workshop` (`workshop_ID`);

--
-- Constraints for table `workshop`
--
ALTER TABLE `workshop`
  ADD CONSTRAINT `workshop_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
