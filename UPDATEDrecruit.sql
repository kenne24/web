-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2018 at 07:53 PM
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
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `departmentid` varchar(50) NOT NULL,
  `departmentname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`departmentid`, `departmentname`) VALUES
('AGR', 'Agriculture'),
('BCE', 'Building and Civil Engineering'),
('BIO', 'Biology'),
('BSCI', 'Business Science'),
('CHEM', 'Chemistry'),
('ENG', 'English'),
('IT', 'Information Technology'),
('MARBIO', 'Marine Biology'),
('MATH', 'Mathematics'),
('MEE', 'Mechanical and Electrical Engineering'),
('MID', 'Midwifery'),
('MLTECH', 'Medical Laboratory Technology'),
('MNGMT', 'Mangement'),
('NRM', 'Natural Resource Managment'),
('NUR', 'Nursing'),
('PEDU', 'Primary Education'),
('PHA', 'Pharmacy'),
('PHYS', 'Physics'),
('SWO', 'Social Work'),
('TSTUD', 'Tourism Studies');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `districtid` int(1) NOT NULL,
  `districtname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`districtid`, `districtname`) VALUES
(1, 'Corozal'),
(2, 'OrangeWalk'),
(3, 'Belize'),
(4, 'Cayo'),
(5, 'StannCreek'),
(6, 'Toledo');

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
  `gpa` varchar(5) DEFAULT NULL,
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
  `productivity` int(1) NOT NULL,
  `overall` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `facultyid` varchar(10) NOT NULL,
  `facultyname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`facultyid`, `facultyname`) VALUES
('FEA', 'Faculty of Education and Arts'),
('FMASS', 'Faculty of Management and Social Sciences'),
('FNAHSW', 'Faculty of Nursing, Allied Health and Social Work'),
('FST', 'Faculty of Science and Technology');

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
(24, NULL, 'liamcal23', 'Raphael', 'Cal', 'Mr', '', '2014110928@ubstudents.edu.bz', '04cal23@gmail.com', 0, 0, '', '', 0, 0, ''),
(25, NULL, 'dgarcia', 'David', 'Garcia', 'Dr', '', 'dgarcia@ub.edu.bz', 'dgarcia@gmail.com', 0, 0, '', '', 0, 0, ''),
(26, NULL, 'rabz', 'Farshad', 'Rabbani', 'Mr', '', 'frab@ub.edu.bz', 'frab@gmail.com', 0, 0, '', '', 0, 0, ''),
(27, NULL, 'adrian', 'Adiran', 'Cal', 'Mr', '', 'aca@ub.edu.bz', 'acal@gmail.com', 0, 0, '', '', 0, 0, '');

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
(41, 'liamcal23', '$2y$10$W4XPbT9pJ6ubeKKEhPUyuODyXsxrQJr2SBvgOKqRq9xH0oWbEnynm', 2, 1, '670e8a43b246801ca1eaca97b3e19189'),
(42, 'dgarcia', '$2y$10$jr1fE8ed6VPHWW4JNwiYUu2tWnLKIhmt3NL1OypLeZ0TuZLiaKL8W', 1, 1, '0efe32849d230d7f53049ddc4a4b0c60'),
(43, 'rabz', '$2y$10$dk4Zt9zaW2fXYQUDapbCJ.1hquohrNK93vtiMTQr/44ycS883BX02', 1, 1, '5f0f5e5f33945135b874349cfbed4fb9'),
(44, 'adrian', '$2y$10$4N1Ytg5G5CxC7CCw3y6jcezy4y8ElgIEptpFDa0olSZZ9JHlTPJ5.', 2, 1, '912d2b1c7b2826caf99687388d2e8f7c');

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
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`departmentid`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`districtid`);

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
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`facultyid`);

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
  MODIFY `profile_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `resume`
--
ALTER TABLE `resume`
  MODIFY `resume_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
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
