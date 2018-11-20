-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2018 at 06:54 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recruit`
--

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `education_id` int(3) NOT NULL,
  `resume_id` int(3) NOT NULL,
  `institution` varchar(256) NOT NULL,
  `from_date` varchar(128) NOT NULL,
  `to_date` varchar(128) NOT NULL,
  `degree` varchar(256) NOT NULL,
  `additional` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `evaluation_id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `pending` int(1) NOT NULL,
  `attendance` int(1) NOT NULL,
  `punctuality` int(1) NOT NULL,
  `time_management` int(1) NOT NULL,
  `dependability` int(1) NOT NULL,
  `judgement` int(1) NOT NULL,
  `relationship` int(1) NOT NULL,
  `attitude` int(1) NOT NULL,
  `productivity` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `profile_id` int(6) NOT NULL,
  `user_id` int(6) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(256) NOT NULL,
  `lastname` varchar(256) NOT NULL,
  `title` varchar(6) NOT NULL,
  `dob` varchar(128) NOT NULL,
  `ubemail` varchar(256) NOT NULL,
  `personalemail` varchar(255) NOT NULL,
  `phone` int(9) NOT NULL,
  `district` int(1) NOT NULL,
  `city` varchar(256) NOT NULL,
  `street` varchar(256) NOT NULL,
  `faculty` int(1) NOT NULL,
  `department` int(1) NOT NULL,
  `area` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `user_id`, `username`, `firstname`, `lastname`, `title`, `dob`, `ubemail`, `personalemail`, `phone`, `district`, `city`, `street`, `faculty`, `department`, `area`) VALUES
(5, NULL, 'rlcal', 'raphael', 'cal', 'Dr', '', 'liam@ub.edu.bz', 'the@nf', 0, 0, '', '', 0, 0, ''),
(11, NULL, 'em22222', 'emailfirst', 'emaillast', 'Dr', '', '2014110928@ubstudents.edu.bz', 'the@yahoo.com', 0, 0, '', '', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `resume`
--

CREATE TABLE `resume` (
  `resume_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `additional` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(6) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `user_level` int(1) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  `hash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_level`, `active`, `hash`) VALUES
(3, 'liam', '$2y$10$utSdEQfw8bArckO0OfXrD.Wx1rCiYGplwmZg6lMvUKHAdA8BEiv4K', 1, 1, '58ae749f25eded36f486bc85feb3f0ab'),
(10, 'rlcal', '$2y$10$utSdEQfw8bArckO0OfXrD.Wx1rCiYGplwmZg6lMvUKHAdA8BEiv4K', 1, 0, '82aa4b0af34c2313a562076992e50aa3'),
(28, 'em22222', '$2y$10$utSdEQfw8bArckO0OfXrD.Wx1rCiYGplwmZg6lMvUKHAdA8BEiv4K', 2, 1, '3b8a614226a953a8cd9526fca6fe9ba5');

-- --------------------------------------------------------

--
-- Table structure for table `work_experience`
--

CREATE TABLE `work_experience` (
  `work_id` int(3) NOT NULL,
  `resume_id` int(3) NOT NULL,
  `location` varchar(256) NOT NULL,
  `job_title` varchar(256) NOT NULL,
  `from_date` varchar(128) NOT NULL,
  `to_date` varchar(128) NOT NULL,
  `experience` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`education_id`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`evaluation_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `profile_ibfk_1` (`username`);

--
-- Indexes for table `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`resume_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `work_experience`
--
ALTER TABLE `work_experience`
  ADD PRIMARY KEY (`work_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `education_id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `evaluation_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `resume`
--
ALTER TABLE `resume`
  MODIFY `resume_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `work_experience`
--
ALTER TABLE `work_experience`
  MODIFY `work_id` int(3) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
