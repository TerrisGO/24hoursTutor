-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2018 at 04:42 PM
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

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `stud_id`, `tutor_id`) VALUES
(5, 7, 34),
(6, 7, 35),
(7, 9, 34);

-- --------------------------------------------------------

--
-- Table structure for table `chatmessage`
--

CREATE TABLE `chatmessage` (
  `message_id` int(11) NOT NULL,
  `sender_name` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `message` mediumtext COLLATE utf8mb4_bin NOT NULL,
  `m_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chat_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `chatmessage`
--

INSERT INTO `chatmessage` (`message_id`, `sender_name`, `message`, `m_timestamp`, `chat_id`) VALUES
(1, 'Donkey Go', 'Hey I had book your appointment tomorrow', '2018-10-30 05:44:57', 5),
(2, 'Yik Yek Go', 'oh i see your confirm just now, where you wish to meet me tomorrow?', '2018-10-30 07:27:42', 5),
(3, 'Donkey Go', 'I think the workshop inside Komtar, do you agree going there?', '2018-10-30 07:38:44', 5),
(4, 'Donkey Go', 'dfgdfgdfg', '2018-11-01 16:32:14', 5),
(8, 'Yik Yek Go', 'Yes we just go there and eat', '2018-11-01 16:46:21', 5),
(9, 'Donkey Go', 'Okay see you then', '2018-11-02 05:47:51', 5),
(11, 'Donkey Go', 'yes success', '2018-11-02 09:11:34', 5),
(15, 'Yik Yek Go', 'sdsdsd', '2018-11-02 14:41:08', 5),
(16, 'Donkey Go', 'sdsd', '2018-11-02 14:54:20', 5),
(17, 'Donkey Go', 'sdsdsd', '2018-11-02 14:54:45', 5),
(18, 'Donkey Go', 'hello', '2018-11-04 13:49:54', 6),
(20, 'Doremon Abc', 'Hello from the other side', '2018-11-04 16:41:24', 6),
(21, 'Yik Yek Go', 'Testing', '2018-11-05 16:40:31', 5),
(22, 'Yik Yek Go', 'ðŸ˜€', '2018-12-01 16:27:43', 7),
(23, 'Yik Yek Go', 'ðŸ˜', '2018-12-01 17:09:03', 7),
(24, 'Yik Yek Go', 'ðŸ˜˜', '2018-12-01 17:11:03', 7),
(25, 'Yik Yek Go', 'ðŸœðŸ•·ðŸ•·ðŸ•·ðŸ•·asdsad', '2018-12-01 17:14:02', 7),
(26, 'Yik Yek Go', 'ðŸŽ', '2018-12-01 17:14:30', 7);

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE `favourite` (
  `fav_id` int(100) NOT NULL,
  `stud_id` int(100) NOT NULL,
  `tutor_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favourite`
--

INSERT INTO `favourite` (`fav_id`, `stud_id`, `tutor_id`) VALUES
(1, 7, 34),
(2, 9, 34),
(3, 7, 35);

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

--
-- Dumping data for table `nonavailable`
--

INSERT INTO `nonavailable` (`nonavailable_id`, `nonavailable_date`, `booked`, `tutor_id`, `start_time`, `duration`) VALUES
(5, '2018-10-30', 1, 34, '13:00:00', 1),
(6, '2018-10-31', 1, 34, '12:00:00', 1),
(7, '2018-10-31', 1, 34, '14:00:00', 1),
(8, '2018-10-31', 1, 34, '12:25:00', 4),
(9, '2018-11-01', 1, 34, '15:00:00', 3),
(10, '2018-10-31', 1, 34, '19:00:00', 2),
(11, '2018-11-15', 1, 34, '14:00:00', 5),
(12, '2018-11-06', 1, 35, '17:00:00', 1),
(13, '2018-11-07', 1, 35, '12:00:00', 1),
(14, '2018-11-06', 1, 34, '11:00:00', 1),
(15, '2018-11-14', 1, 34, '12:00:00', 1),
(16, '2018-11-16', 1, 34, '12:00:00', 1),
(17, '2018-11-16', 1, 34, '17:00:00', 1),
(20, '2018-12-14', 0, 34, '14:00:00', 5),
(21, '2018-12-15', 0, 34, '14:00:00', 5),
(28, '2018-11-10', 0, 34, '09:00:00', 1),
(29, '2018-11-20', 0, 34, '12:00:00', 3),
(30, '2018-11-14', 0, 37, '09:00:00', 12),
(31, '2018-11-24', 1, 35, '13:00:00', 1),
(32, '2018-11-29', 1, 34, '14:00:00', 1),
(33, '2018-12-21', 1, 34, '12:00:00', 1),
(34, '2018-12-29', 1, 35, '10:00:00', 1),
(36, '2018-12-22', 1, 34, '10:00:00', 5),
(37, '2018-12-27', 1, 34, '14:16:00', 5),
(38, '2018-12-28', 1, 34, '09:00:00', 5),
(39, '2018-12-28', 1, 34, '15:00:00', 2),
(40, '2019-01-01', 1, 34, '12:00:00', 1),
(41, '2018-12-28', 1, 34, '18:00:00', 1),
(42, '2019-01-17', 1, 34, '17:00:00', 5),
(43, '2018-12-28', 1, 34, '09:00:00', 2),
(44, '2018-12-06', 1, 35, '09:00:00', 1);

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
  `sub_name` varchar(100) NOT NULL,
  `bookingdate` datetime NOT NULL,
  `appoint_hrs` int(11) NOT NULL,
  `status` enum('pending','cancel','success') NOT NULL,
  `cancel_reason` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_info`
--

INSERT INTO `payment_info` (`payment_id`, `paytime`, `payamount`, `stud_id`, `tutor_id`, `sub_name`, `bookingdate`, `appoint_hrs`, `status`, `cancel_reason`) VALUES
(22, '2018-10-29 14:50:44', 5, 7, 34, 'Japanese', '2018-10-30 13:00:00', 1, 'cancel', NULL),
(23, '2018-10-29 16:56:15', 5, 7, 34, 'Chinese', '2018-10-31 12:00:00', 1, 'cancel', NULL),
(24, '2018-10-30 03:53:47', 5, 7, 34, 'Fridge and Air Con', '2018-10-31 14:00:00', 1, 'cancel', NULL),
(25, '2018-10-30 04:25:38', 5, 7, 34, 'Chinese', '2018-10-31 12:25:00', 4, 'cancel', NULL),
(26, '2018-10-30 04:27:16', 5, 7, 34, 'Chinese', '2018-11-14 19:15:00', 3, 'success', NULL),
(28, '2018-10-30 10:04:04', 21, 7, 34, 'Humanities', '2018-10-31 19:00:00', 2, 'cancel', NULL),
(29, '2018-10-31 04:29:20', 5, 7, 34, 'Chinese', '2018-11-13 00:00:00', 5, 'success', NULL),
(30, '2018-11-04 11:59:21', 200, 7, 35, 'Politics', '2018-11-06 17:00:00', 1, 'cancel', 'By tutor: sorry student can you book next time'),
(31, '2018-11-04 13:41:02', 200, 7, 35, 'Politics', '2018-11-07 12:00:00', 1, 'success', NULL),
(32, '2018-11-05 14:22:06', 5, 7, 34, 'Athletics', '2018-11-06 11:00:00', 1, 'success', NULL),
(33, '2018-11-05 17:01:04', 21, 7, 34, 'Humanities', '2018-11-12 12:00:00', 1, 'cancel', NULL),
(34, '2018-11-06 14:34:32', 36, 7, 34, 'Maths', '2018-11-17 22:00:00', 1, 'success', NULL),
(35, '2018-11-07 04:37:53', 5, 7, 34, 'Fridge and Air Con', '2018-11-16 17:00:00', 1, 'success', NULL),
(38, '2018-11-19 11:10:46', 200, 7, 35, 'Politics', '2018-11-24 13:00:00', 1, 'cancel', NULL),
(41, '2018-11-25 06:11:33', 200, 7, 35, 'Politics', '2018-12-29 10:00:00', 1, 'pending', NULL),
(42, '2018-11-25 06:12:42', 36, 7, 34, 'Maths', '2018-12-04 10:00:00', 2, 'cancel', 'By tutor: '),
(45, '2018-11-25 06:38:10', 25, 9, 34, 'Athletics', '2018-12-28 09:00:00', 5, 'pending', NULL),
(46, '2018-11-25 07:16:14', 94, 7, 34, 'Japanese', '2018-12-28 15:00:00', 2, 'pending', NULL),
(47, '2018-11-25 07:16:48', 47, 7, 34, 'Japanese', '2019-01-01 12:00:00', 1, 'pending', NULL),
(48, '2018-11-25 07:18:32', 47, 9, 34, 'Japanese', '2018-12-28 18:00:00', 1, 'pending', NULL),
(49, '2018-11-27 17:51:38', 25, 7, 34, 'Athletics', '2019-01-17 17:00:00', 5, 'pending', NULL),
(50, '2018-12-01 17:31:29', 50, 7, 34, 'C++ Programming', '2018-12-28 09:00:00', 2, 'pending', NULL),
(51, '2018-12-04 14:42:45', 36, 7, 34, 'Maths', '2018-12-13 09:00:00', 1, 'pending', NULL),
(52, '2018-12-06 15:39:16', 200, 7, 35, 'Politics', '2018-12-06 09:00:00', 1, 'success', NULL);

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

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_id`, `stud_id`, `r_stud_firstname`, `r_message`, `r_stars`, `r_datetime`, `tutor_id`) VALUES
(4, 7, 'Donkey', 'She is teaching very well ,extremely good tutor that makes concept so much easier to understand and apply. It is clear that she spends time to consider the best ways to get points across. I am very happy with her tuition and with her love of teaching (which clearly comes across).', 5, '2018-11-28 01:19:17', 34),
(5, 7, 'Donkey', 'Thank You, sir, you help me learn a lot about politics and social behavior.', 5, '2018-12-06 23:41:17', 35);

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
  `stud_pass` varchar(100) NOT NULL,
  `stud_hash` varchar(32) NOT NULL,
  `stud_active` tinyint(1) NOT NULL DEFAULT '0',
  `stud_travel` int(2) NOT NULL,
  `stud_zip` int(5) NOT NULL,
  `stud_district` varchar(40) DEFAULT NULL,
  `stud_addr` varchar(100) NOT NULL,
  `stud_phone` int(10) NOT NULL,
  `stud_profilepic` varchar(100) NOT NULL DEFAULT 'default.png',
  `stud_gender` enum('M','F','O') NOT NULL DEFAULT 'O',
  `stud_intro` text NOT NULL,
  `stud_birthdate` date NOT NULL,
  `stud_registerdate` datetime NOT NULL,
  `stud_lastin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stud_id`, `stud_fname`, `stud_lname`, `stud_email`, `stud_usrn`, `stud_pass`, `stud_hash`, `stud_active`, `stud_travel`, `stud_zip`, `stud_district`, `stud_addr`, `stud_phone`, `stud_profilepic`, `stud_gender`, `stud_intro`, `stud_birthdate`, `stud_registerdate`, `stud_lastin`) VALUES
(7, 'Donkey', 'Go', '123123@gmail.com', '123', '$2y$10$zweO6zaL4Vfw/C0Nz/0gLOc2QZr1F40CUkf0g0pAYNQkQIBb47pbe', '301ad0e3bd5cb1627a2044908a42fdc2', 1, 23, 31920, 'Kampar', 'jOHOR fAHRU1', 185773895, '1f49505b8f0be9a6662b671385482a20.jpg', '', '  sfdsdfsf asdasdasdasdasdasdsadsadasdsadsadsadsadsad                            ', '1996-12-07', '0000-00-00 00:00:00', '2018-12-06 15:40:08'),
(9, 'Cokeca', 'Dasani', 'dasani@gmail.com', 'dasani', '$2y$10$wV9WyOkogRhyh7qqLu14Jepkv6HnbIiEjnJZE7TDOg0p9ZSwsaiZ6', 'cdc0d6e63aa8e41c89689f54970bb35f', 1, 8, 10000, 'Penang', '', 0, '9b6ec50b0cea0f8a2c00cc64b7b4e682.jpg', 'F', ' ', '0000-00-00', '0000-00-00 00:00:00', '2018-11-25 07:17:44'),
(10, 'John', 'Doe', 'john@example.com', 'john123', 'password', '', 0, 0, 0, NULL, '', 0, 'default.png', 'M', '', '0000-00-00', '0000-00-00 00:00:00', '2018-10-17 05:12:33'),
(15, 'freak', 'funk', 'freak@gmail.com', 'freak', '$2y$10$5.xPB4p7d2SgAuUOwBFFoO2vE5V1KN3RNQyrut3w.RVtLG0uaSWku', '', 1, 0, 0, NULL, '', 0, 'default.png', 'O', '', '0000-00-00', '2018-11-29 00:17:42', '2018-11-28 16:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `categories` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_name`, `categories`) VALUES
(16, 'Chemistry', 'Chemistry'),
(18, 'Design And Craft', 'Art'),
(19, 'Photoshop', 'Art'),
(20, 'Acting', 'Drama'),
(22, 'Law', 'Law'),
(23, 'Maths', 'Maths'),
(24, 'Humanities', 'Art'),
(25, 'Philosophy', 'Art'),
(26, 'Politics', 'Politics'),
(27, 'Medicine', 'Medicine'),
(29, 'Phycology', 'Medicine'),
(31, 'Geography', 'Science'),
(34, 'Athletics', 'Sport'),
(36, 'Swimming', 'Sport'),
(39, 'PingPong Ball', 'Sport'),
(41, 'Physics', 'Science'),
(43, 'Microsoft Office', 'Computer'),
(44, 'Sociology', 'Academic'),
(46, 'Japanese', 'Language'),
(47, 'Chinese', 'Language'),
(49, 'Korean', 'Language'),
(50, 'Thai', 'Language'),
(59, 'Fridge and Air Con', 'Mechanic'),
(60, 'Electrical', 'Mechanic'),
(63, 'Leadership', 'Management'),
(64, 'Nursing', 'Medicine'),
(65, 'C++ Programming', 'Computing'),
(66, 'Media', 'Academic');

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

--
-- Dumping data for table `subject_offer`
--

INSERT INTO `subject_offer` (`offer_id`, `subject_id`, `tutor_id`, `price_perhrs`) VALUES
(20, 34, 33, 20),
(21, 24, 34, 21),
(23, 26, 35, 200),
(24, 47, 33, 56),
(51, 59, 34, 5),
(54, 34, 34, 5),
(55, 23, 34, 36),
(58, 46, 34, 47),
(59, 34, 36, 28),
(60, 23, 37, 31),
(61, 41, 37, 30),
(62, 23, 38, 22),
(63, 23, 39, 31),
(64, 19, 40, 39),
(65, 43, 40, 23),
(74, 65, 34, 25),
(77, 47, 34, 21);

-- --------------------------------------------------------

--
-- Table structure for table `testing_card`
--

CREATE TABLE `testing_card` (
  `card_num` bigint(255) NOT NULL,
  `exp_d` int(4) NOT NULL,
  `cvc` int(3) NOT NULL,
  `amount` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testing_card`
--

INSERT INTO `testing_card` (`card_num`, `exp_d`, `cvc`, `amount`) VALUES
(1111111111111111, 1111, 111, 3820);

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
  `t_pass` varchar(100) NOT NULL,
  `t_hash` varchar(32) NOT NULL,
  `t_active` tinyint(1) NOT NULL DEFAULT '0',
  `t_travel` int(2) NOT NULL,
  `t_zip` int(5) NOT NULL,
  `t_district` varchar(40) DEFAULT NULL,
  `t_addr` varchar(100) NOT NULL,
  `t_phone` int(10) NOT NULL,
  `t_profilepic` varchar(100) NOT NULL DEFAULT 'default.png',
  `t_gender` enum('M','F','O') NOT NULL DEFAULT 'O',
  `t_intro` text NOT NULL,
  `t_job` varchar(50) NOT NULL DEFAULT 'None',
  `t_birthdate` date NOT NULL,
  `t_qualifications` varchar(400) NOT NULL,
  `t_officialcheck` tinyint(1) NOT NULL,
  `t_checked_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `t_registerdate` datetime NOT NULL,
  `t_lastin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`tutor_id`, `t_fname`, `t_lname`, `t_email`, `t_usrn`, `t_pass`, `t_hash`, `t_active`, `t_travel`, `t_zip`, `t_district`, `t_addr`, `t_phone`, `t_profilepic`, `t_gender`, `t_intro`, `t_job`, `t_birthdate`, `t_qualifications`, `t_officialcheck`, `t_checked_date`, `t_registerdate`, `t_lastin`) VALUES
(33, 'testing', 'Go', '123@gmail.com', '123abc', '$2y$10$zukYwRIjI0Zqa1HGedwkBeC7XZr1fKeoXMe7zU8yI05N7gHUO/7.q', '335f5352088d7d9bf74191e006d8e24c', 1, 6, 0, '', '123', 0, 'default.png', 'F', '   ', '', '0000-00-00', '', 1, '2018-12-01 17:41:40', '2018-10-04 00:00:00', '2018-12-01 17:41:40'),
(34, 'Yik Yek', 'Go', 'yikyekgo@gmail.com', 'yikyek', '$2y$10$U9d4VdRnz266D9oziCVZOOYGfXVq1A2JdE.x6v/ZX5awbhdByFWf6', '9cc138f8dc04cbf16240daa92d8d50e2', 1, 14, 31920, 'Kampar', '24B, Taman Air Kuning, 31920 Kampar Perak.sdfds', 185773895, '45662fd43c08e2d058b287fbda13d3b5.jpg', '', '  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, .\r\nwhen an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,\r\n Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, .\r\nwhen an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,\r\n but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of \r\n Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum                    ', 'Programmer and Penetration Tester', '1996-08-07', '2009 - 2014 \r\nPei Yuan High School\r\n2015 - Now\r\nKDU', 1, '2018-12-06 15:15:36', '2018-09-12 00:00:00', '2018-12-06 15:15:36'),
(35, 'Doremon', 'Abc', 'singsong@gmail.com', 'singsong', '$2y$10$9SdDnQyZYMm3fmQ.QKkaJ.M3j4soI3L6qi.AtplvR6bC6CBjD/U12', 'fe73f687e5bc5280214e0486b273a5f9', 1, 0, 31920, 'Penang', 'nonsense FYP , Suk Mai deek', 0, '72c8657bd7cd4f8afd18eb0b8df0a565.jpg', 'F', '  ', '', '0000-00-00', '', 1, '2018-12-06 15:39:48', '2018-09-16 00:00:00', '2018-12-06 15:39:48'),
(36, 'ching', 'chong', 'chingchong@gmail.com', 'testing1', '$2y$10$zukYwRIjI0Zqa1HGedwkBeC7XZr1fKeoXMe7zU8yI05N7gHUO/7.q', '', 1, 0, 31920, 'Kampar', '', 0, '25147199901972b8093edfa28c0fa58b.jpg', 'F', ' ', 'None', '0000-00-00', '', 1, '2018-11-13 03:27:18', '0000-00-00 00:00:00', '2018-11-03 13:32:19'),
(37, 'test', '1', 'test1@gmail.com', 'test1', '$2y$10$zukYwRIjI0Zqa1HGedwkBeC7XZr1fKeoXMe7zU8yI05N7gHUO/7.q', '', 1, 0, 10000, 'Penang', '', 0, '94d23103c01264c9e7f257b7c152355c.jpg', 'F', '  ', 'Math Teacher', '0000-00-00', '', 1, '2018-12-03 17:24:58', '2018-06-12 00:00:00', '2018-12-03 17:24:58'),
(38, 'test', '2', 'test2@gmail.com', 'test2', '$2y$10$zukYwRIjI0Zqa1HGedwkBeC7XZr1fKeoXMe7zU8yI05N7gHUO/7.q', '', 1, 15, 10000, 'Penang', '2JC,Jalan Anson, Penang.', 0, '3ea5d9126e4d3b1d88aefa64af0a90d9.jpg', 'M', '  ', 'Teacher', '1991-06-12', '', 1, '2018-12-03 15:46:29', '0000-00-00 00:00:00', '2018-12-03 15:46:29'),
(39, 'test', '3', 'test3@gmail.com', 'test3', '$2y$10$zukYwRIjI0Zqa1HGedwkBeC7XZr1fKeoXMe7zU8yI05N7gHUO/7.q', '', 1, 0, 0, NULL, '', 0, 'e51ee403fc77b83fa435006294c4c1d9.jpg', 'O', '', 'None', '0000-00-00', '', 0, '2018-12-03 17:30:40', '2018-08-20 00:00:00', '2018-12-03 17:30:40'),
(40, 'test', '4', 'test4@gmail.com', 'test4', '$2y$10$zukYwRIjI0Zqa1HGedwkBeC7XZr1fKeoXMe7zU8yI05N7gHUO/7.q', '', 1, 0, 10000, 'Penang', '', 0, '54d9bd365ba9d06eefb6e8d5a33e1ed3.jpg', 'M', '  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. ', 'professor in computer science', '0000-00-00', 'Been Teaching In KDU More than 10 years', 0, '2018-12-04 16:40:44', '2018-02-24 00:00:00', '2018-12-04 16:40:44'),
(41, 'test', '5', 'test5@gmail.com', 'test5', '$2y$10$zukYwRIjI0Zqa1HGedwkBeC7XZr1fKeoXMe7zU8yI05N7gHUO/7.q', '', 1, 0, 0, NULL, '', 0, 'default.png', 'M', '', 'None', '0000-00-00', '', 0, '0000-00-00 00:00:00', '2017-09-12 00:00:00', '0000-00-00 00:00:00'),
(42, 'test', '6', 'test6@gmail.com', 'test6', '$2y$10$zukYwRIjI0Zqa1HGedwkBeC7XZr1fKeoXMe7zU8yI05N7gHUO/7.q', '', 1, 0, 0, NULL, '', 0, 'default.png', 'M', '', 'None', '0000-00-00', '', 0, '0000-00-00 00:00:00', '2018-06-23 00:00:00', '0000-00-00 00:00:00'),
(43, 'test', '7', 'test7@gmail.com', 'test7', '$2y$10$zukYwRIjI0Zqa1HGedwkBeC7XZr1fKeoXMe7zU8yI05N7gHUO/7.q', '', 1, 0, 0, NULL, '', 0, 'default.png', 'M', '', 'None', '0000-00-00', '', 0, '0000-00-00 00:00:00', '2018-07-29 00:00:00', '0000-00-00 00:00:00'),
(44, 'test', '8', 'test8@gmail.com', 'test8', '$2y$10$zukYwRIjI0Zqa1HGedwkBeC7XZr1fKeoXMe7zU8yI05N7gHUO/7.q', '', 1, 0, 0, NULL, '', 0, 'default.png', 'M', '', 'None', '0000-00-00', '', 0, '0000-00-00 00:00:00', '2018-09-01 00:00:00', '0000-00-00 00:00:00'),
(45, 'test', '9', 'test9@gmail.com', 'test9', '$2y$10$zukYwRIjI0Zqa1HGedwkBeC7XZr1fKeoXMe7zU8yI05N7gHUO/7.q', '', 1, 0, 0, NULL, '', 0, 'default.png', 'F', '', 'None', '0000-00-00', '', 0, '0000-00-00 00:00:00', '2018-09-08 00:00:00', '0000-00-00 00:00:00'),
(46, 'test', '10', 'test10@gmail.com', 'test10', '$2y$10$zukYwRIjI0Zqa1HGedwkBeC7XZr1fKeoXMe7zU8yI05N7gHUO/7.q', '', 1, 0, 0, NULL, '', 0, 'default.png', 'O', '', 'None', '0000-00-00', '', 0, '0000-00-00 00:00:00', '2018-08-01 00:00:00', '0000-00-00 00:00:00');

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
-- Indexes for table `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`fav_id`),
  ADD KEY `stud_id` (`stud_id`),
  ADD KEY `tutor_id` (`tutor_id`);

--
-- Indexes for table `nonavailable`
--
ALTER TABLE `nonavailable`
  ADD PRIMARY KEY (`nonavailable_id`),
  ADD KEY `tutor_id` (`tutor_id`) USING BTREE;

--
-- Indexes for table `payment_info`
--
ALTER TABLE `payment_info`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `tutor_id` (`tutor_id`) USING BTREE,
  ADD KEY `stud_id` (`stud_id`) USING BTREE;

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `stud_id` (`stud_id`),
  ADD KEY `tutor_id` (`tutor_id`);

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
  ADD KEY `tutor_id` (`tutor_id`) USING BTREE,
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `testing_card`
--
ALTER TABLE `testing_card`
  ADD UNIQUE KEY `card_num` (`card_num`);

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
  MODIFY `chat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chatmessage`
--
ALTER TABLE `chatmessage`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `favourite`
--
ALTER TABLE `favourite`
  MODIFY `fav_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nonavailable`
--
ALTER TABLE `nonavailable`
  MODIFY `nonavailable_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `payment_info`
--
ALTER TABLE `payment_info`
  MODIFY `payment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stud_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `subject_offer`
--
ALTER TABLE `subject_offer`
  MODIFY `offer_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `tutor`
--
ALTER TABLE `tutor`
  MODIFY `tutor_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`tutor_id`) REFERENCES `tutor` (`tutor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_3` FOREIGN KEY (`stud_id`) REFERENCES `student` (`stud_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chatmessage`
--
ALTER TABLE `chatmessage`
  ADD CONSTRAINT `chatmessage_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`chat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favourite`
--
ALTER TABLE `favourite`
  ADD CONSTRAINT `favourite_ibfk_1` FOREIGN KEY (`tutor_id`) REFERENCES `tutor` (`tutor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favourite_ibfk_2` FOREIGN KEY (`stud_id`) REFERENCES `student` (`stud_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nonavailable`
--
ALTER TABLE `nonavailable`
  ADD CONSTRAINT `nonavailable_ibfk_1` FOREIGN KEY (`tutor_id`) REFERENCES `tutor` (`tutor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_info`
--
ALTER TABLE `payment_info`
  ADD CONSTRAINT `payment_info_ibfk_1` FOREIGN KEY (`tutor_id`) REFERENCES `tutor` (`tutor_id`),
  ADD CONSTRAINT `payment_info_ibfk_2` FOREIGN KEY (`stud_id`) REFERENCES `student` (`stud_id`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`tutor_id`) REFERENCES `tutor` (`tutor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_ibfk_3` FOREIGN KEY (`stud_id`) REFERENCES `student` (`stud_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject_offer`
--
ALTER TABLE `subject_offer`
  ADD CONSTRAINT `subject_offer_ibfk_1` FOREIGN KEY (`tutor_id`) REFERENCES `tutor` (`tutor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_offer_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `e_store_ts` ON SCHEDULE EVERY 1 DAY STARTS '2018-11-04 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE payment_info
    SET status = "cancel"
    WHERE bookingdate < now()
    AND status = "pending"$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
