-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2018 at 06:21 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notice_board`
--

-- --------------------------------------------------------

--
-- Table structure for table `massages`
--

CREATE TABLE `massages` (
  `message_id` int(11) NOT NULL,
  `user_id` varchar(25) NOT NULL,
  `message_body` varchar(5000) NOT NULL,
  `sent_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sender` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `massages`
--

INSERT INTO `massages` (`message_id`, `user_id`, `message_body`, `sent_time`, `sender`) VALUES
(548, 'fuadkhan3', 'fadf', '2017-07-14 19:51:33', 'fuadkhan3'),
(552, 'fuadkhan3', 'asdjkkjasd', '2017-07-14 20:20:49', 'fuadkhan3'),
(556, 'fuadkhan3', 'HELLO WORLD', '2017-07-16 05:22:06', 'fuadkhan3'),
(558, 'shatin', 'HELLO WORLD', '2017-07-16 05:22:06', 'fuadkhan3');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `notice_id` int(11) NOT NULL,
  `notice_title` varchar(200) NOT NULL,
  `notice_body` varchar(700) DEFAULT NULL,
  `notice_image_path` varchar(200) DEFAULT NULL,
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `notice_title`, `notice_body`, `notice_image_path`, `create_time`) VALUES
(1, 'This is a test Notice', 'Almost Done', NULL, '2017-07-15 17:37:14'),
(2, 'This is a test Notice', '69', NULL, '2017-07-15 17:43:06'),
(3, 'This is a test Notice', '69', NULL, '2017-07-15 17:43:51'),
(4, 'This is a test Notice', '69', NULL, '2017-07-15 17:44:11'),
(5, 'rifat3', 'bari jah', NULL, '2017-07-15 21:25:27'),
(6, 'test2', 'This is a test', NULL, '2017-07-16 11:26:59'),
(7, 'This is', 'Notice body', NULL, '2017-11-27 03:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(25) NOT NULL,
  `name` varchar(45) NOT NULL,
  `password` varchar(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `gender` varchar(6) NOT NULL DEFAULT 'Male',
  `user_image_path` varchar(200) NOT NULL DEFAULT 'uploads/person.jpg',
  `user_type` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `password`, `email`, `gender`, `user_image_path`, `user_type`, `create_time`) VALUES
('fuadkhan3', 'Fuad ', '12345', 'fuad.khan3@gmail.com', 'Male', 'uploads/php.png', 1, '2017-06-25 09:26:56'),
('RIFAT3', 'rifat ullah', '12345', 'fuad.khan3@gmail.com', 'Male', 'uploads/17800427_1570461956320578_3618035483558943627_n.jpg', 0, '2017-07-15 17:46:14'),
('shatin', 'shatin', 'shatin', 'shatin.hasan73@gmail.com', 'Male', 'uploads/person.jpg', 0, '2017-07-15 18:11:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `massages`
--
ALTER TABLE `massages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `user_id_fk` (`user_id`),
  ADD KEY `sender_user_id_fk` (`sender`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `massages`
--
ALTER TABLE `massages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=559;
--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `massages`
--
ALTER TABLE `massages`
  ADD CONSTRAINT `sender_user_id_fk` FOREIGN KEY (`sender`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
