-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 02, 2019 at 02:19 AM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `TRS`
--

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `GenderID` int(11) NOT NULL,
  `Description` varchar(20) NOT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`GenderID`, `Description`, `isActive`) VALUES
(1, 'Male', 1),
(2, 'Female', 1),
(3, 'Other', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `RoleID` int(11) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `isActive` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`RoleID`, `Description`, `isActive`) VALUES
(1, 'Administrator', 1),
(2, 'Authenticated User', 1),
(3, 'Premium Member', 1),
(4, 'Free', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `FK_RoleID` int(11) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `Email` varchar(200) NOT NULL,
  `FK_GenderID` int(11) NOT NULL,
  `ContactNo` varchar(50) DEFAULT NULL,
  `DOB` date NOT NULL,
  `Password` varchar(300) NOT NULL,
  `LastLoginDate` date DEFAULT NULL,
  `FailedLoginAttempt` int(11) NOT NULL DEFAULT '0',
  `FailedLoginDate` date DEFAULT NULL,
  `AccountVerified` tinyint(1) NOT NULL DEFAULT '0',
  `isLocked` tinyint(1) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FK_RoleID`, `FirstName`, `LastName`, `Email`, `FK_GenderID`, `ContactNo`, `DOB`, `Password`, `LastLoginDate`, `FailedLoginAttempt`, `FailedLoginDate`, `AccountVerified`, `isLocked`, `isActive`) VALUES
(1, 1, 'shalitha', 'senanayaka', 'shalithax@gmail.com', 1, '3123123123', '1997-04-21', 'zoOA5p5CcwxWd9TXGZXJPA==', '2019-05-02', 0, '2019-05-01', 1, 0, 1),
(2, 2, 'test', 'test', 'test@gmail.com', 1, '2312312312', '2019-04-20', 'zoasdasdasdasdasdasd', '2019-05-01', 0, '2019-05-01', 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`GenderID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`RoleID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `FK_RoleID` (`FK_RoleID`),
  ADD KEY `FK_GenderID` (`FK_GenderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `GenderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`FK_RoleID`) REFERENCES `role` (`RoleID`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`FK_GenderID`) REFERENCES `gender` (`GenderID`);
