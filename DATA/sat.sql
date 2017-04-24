-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 24, 2017 at 01:24 AM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sat`
--
CREATE DATABASE IF NOT EXISTS `sat` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sat`;

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `activityID` int(10) UNSIGNED NOT NULL,
  `userId` int(255) NOT NULL,
  `groupID` int(10) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `startDate` date NOT NULL,
  `endDate` datetime NOT NULL,
  `difficulty` int(11) NOT NULL,
  `satisfaction` int(11) NOT NULL,
  `notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`activityID`, `userId`, `groupID`, `activity`, `type`, `startDate`, `endDate`, `difficulty`, `satisfaction`, `notes`) VALUES
(1, 49, 1, 'SAT1', 'type', '0000-00-00', '0000-00-00 00:00:00', 9, 9, 'student1klas1'),
(2, 49, 1, 'SAT1', 'type2', '0000-00-00', '0000-00-00 00:00:00', 9, 9, 'student1klas1'),
(3, 49, 1, 'SAT1', 'type3', '0000-00-00', '0000-00-00 00:00:00', 9, 9, 'student1klas1'),
(4, 49, 2, 'SAT1', 'type1', '0000-00-00', '0000-00-00 00:00:00', 9, 9, 'student1klas2'),
(5, 49, 2, 'SAT1', 'type2', '0000-00-00', '0000-00-00 00:00:00', 9, 9, 'student1klas2'),
(6, 49, 2, 'SAT1', 'type3', '0000-00-00', '0000-00-00 00:00:00', 9, 9, 'student1klas2'),
(7, 1002, 1, 'SAT1', 'type1', '0000-00-00', '0000-00-00 00:00:00', 9, 9, 'student2klas1'),
(8, 1002, 1, 'SAT1', 'type2', '0000-00-00', '0000-00-00 00:00:00', 9, 9, 'student2klas1'),
(9, 1002, 1, 'SAT1', 'type3', '0000-00-00', '0000-00-00 00:00:00', 9, 9, 'student2klas1'),
(10, 1002, 2, 'SAT2', 'type1', '0000-00-00', '0000-00-00 00:00:00', 9, 9, 'student2klas2'),
(11, 1002, 2, 'SAT2', 'type2', '0000-00-00', '0000-00-00 00:00:00', 9, 9, 'student2klas2'),
(12, 1002, 2, 'new edit', NULL, '0000-00-00', '2017-04-19 14:30:07', 1, 1, 'edit notes'),
(22, 0, 0, 'edit call', NULL, '2017-04-19', '2017-04-19 14:35:44', 7, 7, 'edit call');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `groupID` int(10) NOT NULL,
  `group` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupID`, `group`, `type`, `description`) VALUES
(1, 'PHP19', 'PHP', 'descriptonPHP19'),
(2, 'PHP14', 'PHP', 'descriptonPHP14'),
(3, 'CS18', 'CS', 'descriptonCS18');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role` varchar(10) NOT NULL,
  `roleID` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role`, `roleID`) VALUES
('admin', 'ADM'),
('monitor', 'MON'),
('registered', 'REG'),
('student', 'STU');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(10) UNSIGNED NOT NULL,
  `userName` varchar(255) NOT NULL,
  `passCode` char(60) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `groupID` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL,
  `state` varchar(40) DEFAULT NULL,
  `token` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `passCode`, `firstName`, `lastName`, `email`, `groupID`, `role`, `state`, `token`) VALUES
(49, 'username', '$2y$10$sP3VITJ8N.5j8hXrpHuLmuGg/KZSQ.xPO', 'Guido', 'Leijten', 'guido.leijten@itvitaelearning.nl', '1', 'STU', NULL, ''),
(51, 'testuser', '$2y$12$cHnnORZcY5N5pMDhSaPvSeb2pHN7OPZKiP9CKUvm7nOjlT4kE/Hs2', 'test', 'user', 'guido.leijten@gmail.com', '', 'REG', NULL, 'MmVwei4xmVHvxdMw64WL7whh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activityID`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groupID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `activityID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groupID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
