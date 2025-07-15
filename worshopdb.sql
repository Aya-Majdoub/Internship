-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2025 at 01:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
(3336, '2025-07-15', 47, 4, 'other');

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
(39, 'admin1', 'admin1@example.com', 'admin', '$2y$10$chmYP67UyUQ4RUbjiJ6OS.LsE8du4oRmXYg4JdkG/CegI4YgjRhfa'),
(45, 'participant1', 'participant1@gmail.com', 'Participant', NULL),
(46, 'participant2', 'participant2@gmail.com', 'Participant', NULL),
(47, 'participant3', 'participant3@gmail.com', 'Participant', NULL);

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
(4, 'Art of transformation', '2025-07-14', '09:30:00', '12:00:00', 'Ronald Rand - Cultural Ambassador and Professor of Theater (USA)', 'Faculty of Letters and Human Sciences – Ben M’Sik, Hassan II University, Casablanca', 20, 'theater', NULL),
(5, 'Le masque et le corps du personnage', '2025-07-14', '09:30:00', '12:00:00', 'Claudio de Maglio - Professor of Theater (Italy)', 'Faculty of Letters and Human Sciences – Ben M’Sik, Hassan II University, Casablanca', 20, 'theater', NULL),
(6, 'Le voyage du personnage', '2025-07-14', '09:30:00', '12:00:00', 'Philippe Mertz - Theater writing coach (France)', 'Faculty of Letters and Human Sciences – Ben M’Sik, Hassan II University, Casablanca', 20, 'theater', NULL),
(7, 'Meinser Technique for Scene Development', '2025-07-14', '09:30:00', '12:00:00', 'Jhon Freeman - Professor of Theater (Australia)', 'Faculty of Letters and Human Sciences – Ben M’Sik, Hassan II University, Casablanca', 20, 'theater', NULL);

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
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `registration_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3337;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

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
