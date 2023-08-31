-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2018 at 05:41 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `24t`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(100) NOT NULL,
  `stud_id` int(100) NOT NULL,
  `tutor_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chatmessage`
--

CREATE TABLE `chatmessage` (
  `message_id` int(11) NOT NULL,
  `sender_name` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `m_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chat_id` int(100) NOT NULL,
  `m_viewed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nonavailable`
--

CREATE TABLE `nonavailable` (
  `nonavailable_id` int(11) NOT NULL,
  `nonavailable_date` date NOT NULL,
  `booked` tinyint(1) NOT NULL,
  `tutor_id` int(100) NOT NULL,
  `start_time` time NOT NULL,
  `duration` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_info`
--

CREATE TABLE `payment_info` (
  `payment_id` int(100) NOT NULL,
  `paytime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payamount` int(30) NOT NULL,
  `stud_id` int(100) NOT NULL,
  `tutor_id` int(100) NOT NULL,
  `bookingdate` datetime NOT NULL,
  `appoint_hrs` int(11) NOT NULL,
  `status` enum('pending','cancel','success') NOT NULL,
  `cancel_reason` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(100) NOT NULL,
  `stud_id` int(100) NOT NULL,
  `r_stud_firstname` varchar(50) NOT NULL,
  `r_message` text NOT NULL,
  `r_stars` int(1) NOT NULL,
  `r_datetime` datetime NOT NULL,
  `tutor_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report_issues`
--

CREATE TABLE `report_issues` (
  `report_id` int(11) NOT NULL,
  `report_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `report_msg` varchar(100) NOT NULL,
  `studtutor_id` int(100) NOT NULL,
  `solvestatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stud_id` int(100) NOT NULL,
  `stud_fname` varchar(50) NOT NULL,
  `stud_lname` varchar(50) NOT NULL,
  `stud_email` varchar(100) NOT NULL,
  `stud_usrn` varchar(20) NOT NULL,
  `stud_pass` varchar(50) NOT NULL,
  `stud_hash` varchar(32) NOT NULL,
  `stud_active` tinyint(1) NOT NULL,
  `stud_travel` int(2) NOT NULL,
  `stud_zip` int(5) NOT NULL,
  `stud_addr` varchar(100) NOT NULL,
  `stud_profilepic` varchar(20) NOT NULL,
  `stud_gender` enum('M','F') NOT NULL,
  `stud_intro` text NOT NULL,
  `stud_birthdate` date NOT NULL,
  `stud_registerdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `stud_lastin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `categories` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject_offer`
--

CREATE TABLE `subject_offer` (
  `offer_id` int(100) NOT NULL,
  `subject_id` int(100) NOT NULL,
  `tutor_id` int(100) NOT NULL,
  `price_perhrs` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  `tutor_id` int(100) NOT NULL,
  `t_fname` varchar(50) NOT NULL,
  `t_lname` varchar(50) NOT NULL,
  `t_email` varchar(100) NOT NULL,
  `t_usrn` varchar(20) NOT NULL,
  `t_pass` varchar(50) NOT NULL,
  `t_hash` int(32) NOT NULL,
  `t_active` tinyint(1) NOT NULL,
  `t_travel` int(2) NOT NULL,
  `t_zip` int(5) NOT NULL,
  `t_addr` varchar(100) NOT NULL,
  `t_profilepic` varchar(20) NOT NULL,
  `t_gender` enum('M','F') NOT NULL,
  `t_intro` text NOT NULL,
  `t_job` varchar(50) NOT NULL,
  `t_birthdate` date NOT NULL,
  `t_qualifications` varchar(50) NOT NULL,
  `t_officialcheck` tinyint(1) NOT NULL,
  `t_registerdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `t_lastin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `stud_id` (`stud_id`),
  ADD KEY `tutor_id` (`tutor_id`);

--
-- Indexes for table `chatmessage`
--
ALTER TABLE `chatmessage`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `chat_id` (`chat_id`);

--
-- Indexes for table `nonavailable`
--
ALTER TABLE `nonavailable`
  ADD PRIMARY KEY (`nonavailable_id`),
  ADD UNIQUE KEY `tutor_id` (`tutor_id`);

--
-- Indexes for table `payment_info`
--
ALTER TABLE `payment_info`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `report_issues`
--
ALTER TABLE `report_issues`
  ADD PRIMARY KEY (`report_id`),
  ADD UNIQUE KEY `studtutor_id` (`studtutor_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stud_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `subject_offer`
--
ALTER TABLE `subject_offer`
  ADD PRIMARY KEY (`offer_id`),
  ADD UNIQUE KEY `tutor_id` (`tutor_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`tutor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chatmessage`
--
ALTER TABLE `chatmessage`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nonavailable`
--
ALTER TABLE `nonavailable`
  MODIFY `nonavailable_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_info`
--
ALTER TABLE `payment_info`
  MODIFY `payment_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_issues`
--
ALTER TABLE `report_issues`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stud_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject_offer`
--
ALTER TABLE `subject_offer`
  MODIFY `offer_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tutor`
--
ALTER TABLE `tutor`
  MODIFY `tutor_id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
