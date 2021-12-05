-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2021 at 05:45 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slc`
--

-- --------------------------------------------------------

--
-- Table structure for table `groupnotes`
--

CREATE TABLE `groupnotes` (
  `noteId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `noteAuthor` int(11) NOT NULL,
  `noten` varchar(100) NOT NULL,
  `notec` text NOT NULL,
  `isTeacher` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groupnotes`
--

INSERT INTO `groupnotes` (`noteId`, `groupId`, `noteAuthor`, `noten`, `notec`, `isTeacher`) VALUES
(1, 1, 1, 'This is g1 note', 'random text 1', 0),
(2, 2, 1, 'This is g2 note', 'random text 2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `groupId` int(11) NOT NULL,
  `groupn` varchar(30) NOT NULL,
  `teachId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupId`, `groupn`, `teachId`) VALUES
(1, 'Group 1', 1),
(2, 'Group 2', 1),
(4, 'Group 3', 1),
(6, 'Group 4', 2),
(8, 'Group 5', 3),
(9, 'Group 6', 3),
(10, 'Group 7', 3),
(11, 'Group 8', 3),
(12, 'Group 9', 3),
(13, 'Group 10', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `noteId` int(11) NOT NULL,
  `noteAuthor` int(11) NOT NULL,
  `noten` varchar(100) NOT NULL,
  `notec` text NOT NULL,
  `isTeacher` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`noteId`, `noteAuthor`, `noten`, `notec`, `isTeacher`) VALUES
(1, 2, 'note1', 'This is note 1', 1),
(2, 2, 'note2', 'This is note 2', 1),
(3, 1, 'note3', 'This is note 3', 0),
(4, 2, 'note4', 'This is note 4', 0),
(5, 1, 'Random Note', 'This contains: programming', 0);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `userId` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `fromT` varchar(10) NOT NULL,
  `toT` varchar(10) NOT NULL,
  `eventDay` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `userId` int(11) NOT NULL,
  `usern` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `regNo` varchar(11) NOT NULL,
  `gender` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`userId`, `usern`, `pass`, `email`, `regNo`, `gender`) VALUES
(1, 'Student1', 'pass1', 'student1@gmail.com', '19BCI0001', 'Male'),
(2, 'Student2', 'pass2', 'student2@gmail.com', '19BCI0036', 'Male'),
(4, 'Student3', 'pass3', 'student3@gmail.com', '19BCB0075', 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teachId` int(11) NOT NULL,
  `usern` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teachId`, `usern`, `pass`, `email`, `gender`) VALUES
(1, 'Teacher1', 'pass1', 'teacher1@gmail.com', 'Female'),
(2, 'Teacher2', 'pass2', 'teacher2@gmail.com', 'Male'),
(3, 'Teacher3', 'pass3', 'teacher3@gmail.com', 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `tschedule`
--

CREATE TABLE `tschedule` (
  `teachId` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `fromT` varchar(10) NOT NULL,
  `toT` varchar(10) NOT NULL,
  `eventDay` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tschedule`
--

INSERT INTO `tschedule` (`teachId`, `title`, `fromT`, `toT`, `eventDay`) VALUES
(2, 'Event1', '09:40', '10:00', 'Tuesday');

-- --------------------------------------------------------

--
-- Table structure for table `usergroups`
--

CREATE TABLE `usergroups` (
  `userId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usergroups`
--

INSERT INTO `usergroups` (`userId`, `groupId`) VALUES
(1, 1),
(1, 2),
(2, 2),
(1, 3),
(4, 6),
(4, 8),
(1, 9),
(2, 9),
(4, 9),
(4, 10),
(2, 11),
(1, 11),
(2, 12),
(1, 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groupnotes`
--
ALTER TABLE `groupnotes`
  ADD PRIMARY KEY (`noteId`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`noteId`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teachId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groupnotes`
--
ALTER TABLE `groupnotes`
  MODIFY `noteId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `noteId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teachId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
