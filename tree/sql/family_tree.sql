-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2015 at 05:57 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `family_tree`
--

-- --------------------------------------------------------

--
-- Table structure for table `member_detail`
--

CREATE TABLE IF NOT EXISTS `member_detail` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `member_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `member_detail`
--

INSERT INTO `member_detail` (`member_id`, `parent_id`, `first_name`, `last_name`, `member_img`) VALUES
(1, NULL, 'AAA', 'AA', '159'),
(2, 1, 'BB', 'AAA', '123'),
(3, 1, 'CC', 'AAA', '1597'),
(4, 2, 'DD', 'BB', ''),
(5, 2, 'EE', 'BB', ''),
(6, 2, 'FF', 'BB', ''),
(7, 3, 'HH', 'CC', ''),
(8, 3, 'WW', 'CC', '1596'),
(9, 4, 'II', 'DD', 'dd'),
(10, 6, 'KK', 'FF', ''),
(11, 6, 'KB', 'FF', ''),
(12, 5, 'LL', 'EE', ''),
(13, 5, 'MM', 'EE', ''),
(14, 4, 'JJ', 'JJ', ''),
(15, 7, 'OO', 'HH', '456'),
(16, 8, 'JI', 'WW', '519'),
(17, 12, 'PP', 'LL', '789'),
(18, 10, 'RK', 'KK', NULL),
(19, 10, 'VK', 'KK', ''),
(20, 8, 'YY', 'BB', ''),
(21, 18, 'RJ', 'LL', ''),
(22, 2, 'GG', 'BB', ''),
(23, 21, 'RT', 'RJ', '159');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
