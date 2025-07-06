-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 04 juil. 2025 à 16:05
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `worshopdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `admin_ID` int(11) NOT NULL,
  `admin_name` varchar(255) DEFAULT NULL,
  `admin_email` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `ad_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`admin_ID`, `admin_name`, `admin_email`, `phone_no`, `ad_password`) VALUES
(1, 'admin1', 'admin1@example.com', '0611111111', 'password1'),
(2, 'admin2\r\n', 'admin2@example.com', '0622222222', 'password2'),
(3, 'admin3', 'admin3@example.com', '0633333333', 'password3');

-- --------------------------------------------------------

--
-- Structure de la table `registration`
--

CREATE TABLE `registration` (
  `registration_ID` int(11) NOT NULL,
  `registration_date` date DEFAULT NULL,
  `user_ID` int(11) DEFAULT NULL,
  `workshop_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `registration`
--

INSERT INTO `registration` (`registration_ID`, `registration_date`, `user_ID`, `workshop_ID`) VALUES
(1111, '2025-07-04', 11, 111),
(2222, '2025-07-05', 22, 222),
(3333, '2025-07-06', 33, 333);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_ID`, `username`, `user_email`) VALUES
(11, 'username1', 'user1@example.com'),
(22, 'username2', 'user2@example.com\r\n'),
(33, 'username3', 'user3@example.com');

-- --------------------------------------------------------

--
-- Structure de la table `workshop`
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
  `admin_ID` int(11) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `workshop`
--

INSERT INTO `workshop` (`workshop_ID`, `title`, `workshop_date`, `start_time`, `end_time`, `description`, `location`, `capacity`, `admin_ID`, `category`) VALUES
(111, 'Workshop sample1', '2025-07-10', '09:00:00', '10:00:00', 'this is description for workhshop 1 ', 'room 1', 20, 1, 'theater'),
(222, 'workshop sample 2', '2025-07-10', '11:00:00', '12:00:00', 'this is description for workshop 2', 'amphi 2', 15, 2, 'arts'),
(333, 'workshop sample 3', '2025-07-11', '13:00:00', '14:00:00', 'This is description for workshop 3', 'room 3', 10, 3, 'music');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Index pour la table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`registration_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `workshop_ID` (`workshop_ID`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Index pour la table `workshop`
--
ALTER TABLE `workshop`
  ADD PRIMARY KEY (`workshop_ID`),
  ADD KEY `admin_ID` (`admin_ID`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`),
  ADD CONSTRAINT `registration_ibfk_2` FOREIGN KEY (`workshop_ID`) REFERENCES `workshop` (`workshop_ID`);

--
-- Contraintes pour la table `workshop`
--
ALTER TABLE `workshop`
  ADD CONSTRAINT `workshop_ibfk_1` FOREIGN KEY (`admin_ID`) REFERENCES `admin` (`admin_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
