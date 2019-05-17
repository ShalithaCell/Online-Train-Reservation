-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 10, 2019 at 01:20 PM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TRS`
--
DROP DATABASE IF EXISTS `TRS`;
CREATE DATABASE IF NOT EXISTS `TRS` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `TRS`;

-- --------------------------------------------------------

--
-- Table structure for table `ClassPrice`
--

DROP TABLE IF EXISTS `ClassPrice`;
CREATE TABLE IF NOT EXISTS `ClassPrice` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FK_TrainID` int(11) NOT NULL,
  `FK_ClassID` int(11) NOT NULL,
  `PricePerSeat` decimal(12,2) DEFAULT NULL,
  `PricePerCompartment` decimal(12,2) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_TrainID` (`FK_TrainID`),
  KEY `FK_ClassID` (`FK_ClassID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

DROP TABLE IF EXISTS `gender`;
CREATE TABLE IF NOT EXISTS `gender` (
  `GenderID` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(20) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  PRIMARY KEY (`GenderID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(100) NOT NULL,
  `isActive` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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
-- Table structure for table `tokenRecord`
--

DROP TABLE IF EXISTS `tokenRecord`;
CREATE TABLE IF NOT EXISTS `tokenRecord` (
  `RecordID` int(11) NOT NULL AUTO_INCREMENT,
  `FK_TypeID` int(11) NOT NULL,
  `Token` varchar(15) DEFAULT NULL,
  `FK_userID` int(11) NOT NULL,
  `sendDate` datetime DEFAULT NULL,
  `ExpireDate` datetime DEFAULT NULL,
  PRIMARY KEY (`RecordID`),
  KEY `FK_TypeID` (`FK_TypeID`),
  KEY `FK_userID` (`FK_userID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tokenRecord`
--

INSERT INTO `tokenRecord` (`RecordID`, `FK_TypeID`, `Token`, `FK_userID`, `sendDate`, `ExpireDate`) VALUES
(1, 1, '4OE54i8rHftezJR', 1, '2019-05-10 09:32:16', '2019-05-10 11:32:16'),
(2, 1, 'k', 1, '2019-05-10 09:41:17', '2019-05-10 11:41:17'),
(3, 1, 'p', 1, '2019-05-10 09:42:35', '2019-05-10 11:42:35'),
(4, 1, 'w', 1, '2019-05-10 09:42:35', '2019-05-10 11:42:35');

-- --------------------------------------------------------

--
-- Table structure for table `tokentype`
--

DROP TABLE IF EXISTS `tokentype`;
CREATE TABLE IF NOT EXISTS `tokentype` (
  `TokenID` int(11) NOT NULL AUTO_INCREMENT,
  `TokenDescription` varchar(20) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`TokenID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tokentype`
--

INSERT INTO `tokentype` (`TokenID`, `TokenDescription`, `isActive`) VALUES
(1, 'PasswordReset', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `train`
--

DROP TABLE IF EXISTS `train`;
CREATE TABLE IF NOT EXISTS `train` (
  `TrainID` int(11) NOT NULL AUTO_INCREMENT,
  `TrainCode` int(11) NOT NULL,
  `TrainName` varchar(100) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `IsRegularRun` tinyint(1) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`TrainID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `train`
--

INSERT INTO `train` (`TrainID`, `TrainCode`, `TrainName`, `Description`, `IsRegularRun`, `isActive`) VALUES
(1, 1121, 'Ruhunu Kumari', 'Test', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trainClassDetails`
--

DROP TABLE IF EXISTS `trainClassDetails`;
CREATE TABLE IF NOT EXISTS `trainClassDetails` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FK_TrainID` int(11) NOT NULL,
  `FK_ClassID` int(11) NOT NULL,
  `NoOfCompartments` int(11) NOT NULL,
  `NoOfSeats` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_TrainID` (`FK_TrainID`),
  KEY `FK_ClassID` (`FK_ClassID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trainClassDetails`
--

INSERT INTO `trainClassDetails` (`ID`, `FK_TrainID`, `FK_ClassID`, `NoOfCompartments`, `NoOfSeats`) VALUES
(1, 1, 1, 3, 20),
(2, 1, 2, 4, 50);

-- --------------------------------------------------------

--
-- Table structure for table `trainClasses`
--

DROP TABLE IF EXISTS `trainClasses`;
CREATE TABLE IF NOT EXISTS `trainClasses` (
  `ClassID` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(100) NOT NULL,
  `isActive` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ClassID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trainClasses`
--

INSERT INTO `trainClasses` (`ClassID`, `Description`, `isActive`) VALUES
(1, 'Class A', 1),
(2, 'Class B', 1),
(3, 'Class C', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
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
  `isActive` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`UserID`),
  KEY `FK_RoleID` (`FK_RoleID`),
  KEY `FK_GenderID` (`FK_GenderID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FK_RoleID`, `FirstName`, `LastName`, `Email`, `FK_GenderID`, `ContactNo`, `DOB`, `Password`, `LastLoginDate`, `FailedLoginAttempt`, `FailedLoginDate`, `AccountVerified`, `isLocked`, `isActive`) VALUES
(1, 1, 'shalitha', 'senanayaka', 'shalithax@gmail.com', 1, '1231231231', '2019-05-14', 'zoOA5p5CcwxWd9TXGZXJPA==', '2019-05-09', 0, NULL, 1, 0, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ClassPrice`
--
ALTER TABLE `ClassPrice`
  ADD CONSTRAINT `classprice_ibfk_1` FOREIGN KEY (`FK_TrainID`) REFERENCES `train` (`TrainID`),
  ADD CONSTRAINT `classprice_ibfk_2` FOREIGN KEY (`FK_ClassID`) REFERENCES `trainClasses` (`ClassID`);

--
-- Constraints for table `tokenRecord`
--
ALTER TABLE `tokenRecord`
  ADD CONSTRAINT `tokenrecord_ibfk_1` FOREIGN KEY (`FK_TypeID`) REFERENCES `tokentype` (`TokenID`),
  ADD CONSTRAINT `tokenrecord_ibfk_2` FOREIGN KEY (`FK_userID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `trainClassDetails`
--
ALTER TABLE `trainClassDetails`
  ADD CONSTRAINT `trainclassdetails_ibfk_1` FOREIGN KEY (`FK_TrainID`) REFERENCES `train` (`TrainID`),
  ADD CONSTRAINT `trainclassdetails_ibfk_2` FOREIGN KEY (`FK_ClassID`) REFERENCES `trainClasses` (`ClassID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`FK_RoleID`) REFERENCES `role` (`RoleID`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`FK_GenderID`) REFERENCES `gender` (`GenderID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
