-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2018 at 10:17 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `internshala_lite`
--

-- --------------------------------------------------------

--
-- Table structure for table `apply`
--

CREATE TABLE `apply` (
  `apply_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `internship_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `apply_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(64) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0-inactive 1-active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `status`) VALUES
(1, 'Engineering', 1),
(2, 'MBA', 1),
(3, 'Science', 1),
(4, 'Humanities', 1),
(5, 'Media', 1),
(6, 'NGO', 1),
(7, 'Design', 1);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(64) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0-inactive 1-active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `status`) VALUES
(1, 'Bangalore', 1),
(2, 'Delhi', 1),
(3, 'Noida', 1),
(4, 'Hydrabad', 1),
(5, 'Chennai', 1),
(6, 'Mumbai', 1),
(7, 'Kolkata', 1);

-- --------------------------------------------------------

--
-- Table structure for table `internship`
--

CREATE TABLE `internship` (
  `internship_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `internship_name` varchar(512) NOT NULL,
  `skills` varchar(1000) NOT NULL,
  `internship_detail` text NOT NULL,
  `start_date` datetime NOT NULL,
  `duration` int(11) NOT NULL COMMENT 'in months',
  `stipend` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `internship_authorize` tinyint(4) NOT NULL COMMENT '0-unauthorize 1-authorize',
  `internship_status` tinyint(4) NOT NULL COMMENT '0-inactive 1-active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `internship`
--

INSERT INTO `internship` (`internship_id`, `user_id`, `category_id`, `city_id`, `internship_name`, `skills`, `internship_detail`, `start_date`, `duration`, `stipend`, `created_at`, `updated_at`, `internship_authorize`, `internship_status`) VALUES
(1, 18, 1, 1, 'Backend Developer', 'php,html,mysql,laravel,codeigniter', 'You will work alongside our Technical Lead in our Bangalore office as part of our engineering team. \r\n\r\nSelected intern\'s day-to-day responsibilities include:\r\n\r\n1. Produce, enhance and maintain Trodly mobile applications (Android/iOS)\r\n2. Work closely with CTO to discuss technical solutions and provide innovative ideas based on your extensive knowledge of industry trends and new technologies\r\n3. Work with a Designer Head whilst contributing creativity to assist design as well as turning designs into working mobile apps', '2018-01-15 00:00:00', 3, '5000 INR', '2018-01-14 00:00:00', '2018-01-14 00:00:00', 1, 1),
(2, 18, 2, 3, 'Html developer', 'html', 'khf kahkadkb kdj kdakj dkjskhs adkljdlahs dl ', '2018-01-29 00:00:00', 1, '2k INR', '2018-01-15 00:00:00', '2018-01-11 00:00:00', 1, 1),
(3, 18, 2, 3, 'kkljsljdl', 'ksdjkj', 'jljlkl', '2018-01-01 20:18:00', 4, 'ljlk', '2018-01-14 07:57:15', '2018-01-14 07:57:15', 1, 1),
(4, 18, 2, 3, 'Full Stack developer', 'php, html, jquery, mysql', 'The day of the month (from 01 to 31)\r\nD - A textual representation of a day (three letters)\r\nj - The day of the month without leading zeros (1 to 31)\r\nl (lowercase \'L\') - A full textual representation of a day\r\nN - The ISO-8601 numeric representation of a day (1 for Monday, 7 for Sunday)\r\nS - The English ordinal suffix for the day of the month (2 characters st, nd, rd or th. Works well with j)', '2018-01-01 20:18:00', 4, '15k inr / month', '2018-01-14 08:43:27', '2018-01-14 08:43:27', 1, 1),
(5, 18, 1, 3, 'Full Stack developer 2', 'php, html, jquery, mysql', 'The day of the month (from 01 to 31)\r\nD - A textual representation of a day (three letters)\r\nj - The day of the month without leading zeros (1 to 31)\r\nl (lowercase \'L\') - A full textual representation of a day\r\nN - The ISO-8601 numeric representation of a day (1 for Monday, 7 for Sunday)\r\nS - The English ordinal suffix for the day of the month (2 characters st, nd, rd or th. Works well with j)', '2018-01-01 20:18:00', 4, '15k inr / month', '2018-01-14 08:43:45', '2018-01-14 09:10:26', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_type` tinyint(4) NOT NULL COMMENT '0-student 1-employer',
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(512) NOT NULL,
  `token` varchar(512) DEFAULT NULL,
  `company_name` varchar(64) DEFAULT 'Not Available',
  `website` varchar(512) DEFAULT NULL,
  `company_detail` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `user_authorize` tinyint(4) NOT NULL COMMENT '0-unauthorize 1-authorize',
  `user_status` tinyint(4) NOT NULL COMMENT '0-inactive 1-active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_type`, `first_name`, `last_name`, `email`, `password`, `token`, `company_name`, `website`, `company_detail`, `created_at`, `updated_at`, `user_authorize`, `user_status`) VALUES
(18, 1, 'Nazish', 'Fraz', 'test@gmail.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'e6e2d286b9b877d6f64b7fcd126baf97f5aa1184', 'GD Group Pvt. Ltd.', 'http://www.nfraz.co.nf', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2018-01-13 17:23:48', '2018-01-13 17:23:48', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apply`
--
ALTER TABLE `apply`
  ADD PRIMARY KEY (`apply_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `internship`
--
ALTER TABLE `internship`
  ADD PRIMARY KEY (`internship_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apply`
--
ALTER TABLE `apply`
  MODIFY `apply_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `internship`
--
ALTER TABLE `internship`
  MODIFY `internship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
