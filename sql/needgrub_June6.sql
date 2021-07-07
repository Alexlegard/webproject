-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2019 at 08:23 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `needgrub`
--
CREATE DATABASE IF NOT EXISTS `needgrub` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `needgrub`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(10) NOT NULL,
  `restaurant_id` int(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `comment_time` datetime(6) NOT NULL,
  `comment_content` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `restaurant_id`, `username`, `comment_time`, `comment_content`) VALUES
(1, 8906757, 'Alex', '2019-06-10 10:00:00.000000', 'Good restaurant.'),
(2, 8904385, 'Alex', '2019-06-06 11:00:00.000000', 'Should not appear.'),
(3, 8906757, 'Alex', '2019-06-06 12:00:00.000000', 'Should also appear.'),
(4, 8906757, 'Alex', '2019-06-06 17:29:42.000000', 'Hello'),
(5, 8906757, 'Alex', '2019-06-06 17:43:02.000000', 'Hello'),
(6, 8906757, 'Alex', '2019-06-06 17:43:42.000000', 'I added a comment'),
(7, 8906757, 'Pawan', '2019-06-06 17:44:27.000000', 'This is really nice'),
(8, 8908995, 'Alex', '2019-06-06 17:58:28.000000', 'I added a comment!');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signdate` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `fname`, `lname`, `email`, `password`, `signdate`) VALUES
(1, 'chris', 'b', 'z@z.z', '81dc9bdb52d04dc20036dbd8313ed055', '2019-05-26'),
(2, 'allan', 'b', 'a@a.com', '202cb962ac59075b964b07152d234b70', '2019-05-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
