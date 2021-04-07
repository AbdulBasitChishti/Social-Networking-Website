-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 29, 2021 at 04:57 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koko`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_comments`
--

DROP TABLE IF EXISTS `all_comments`;
CREATE TABLE IF NOT EXISTS `all_comments` (
  `id` int(11) NOT NULL,
  `idc` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(500) NOT NULL,
  `comment_date` varchar(20) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  PRIMARY KEY (`idc`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `all_posts`
--

DROP TABLE IF EXISTS `all_posts`;
CREATE TABLE IF NOT EXISTS `all_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL,
  `post_time` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `likes` bigint(20) NOT NULL DEFAULT '0',
  `dislikes` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `all_posts`
--

INSERT INTO `all_posts` (`id`, `post`, `type`, `post_time`, `username`, `likes`, `dislikes`) VALUES
(1, 'post by user1', 'text', 'January 28-2021  11:03 PM', 'user1', 0, 0),
(2, 'download.jpg', 'pic', 'January 28-2021  11:03 PM', 'user1', 0, 0),
(3, '20 sec countdown.mp4', 'video', 'January 28-2021  11:03 PM', 'user1', 0, 0),
(4, 'post by user2', 'text', 'January 28-2021  11:04 PM', 'user2', 0, 0),
(5, 'FAVPNG_glasses-brand-product-yellow_hLyTckGH.png', 'pic', 'January 28-2021  11:04 PM', 'user2', 0, 0),
(6, 'post by user3', 'text', 'January 28-2021  11:05 PM', 'user3', 0, 0),
(7, 'images.jpg', 'pic', 'January 28-2021  11:05 PM', 'user3', 0, 0),
(8, 'post by user4', 'text', 'January 28-2021  11:06 PM', 'user4', 0, 0),
(9, 'FAVPNG_car-spare-tire-tire-manufacturing-rim_AbjGe4cw.png', 'pic', 'January 28-2021  11:06 PM', 'user4', 0, 0),
(10, 'post by user5', 'text', 'January 28-2021  11:07 PM', 'user5', 0, 0),
(11, 'images.png', 'pic', 'January 28-2021  11:07 PM', 'user5', 0, 0),
(12, 'post by user6', 'text', 'January 28-2021  11:08 PM', 'user6', 0, 0),
(13, 'â€”Pngtreeâ€”illustration of detective thinking with_4853354.png', 'pic', 'January 28-2021  11:08 PM', 'user6', 0, 0),
(14, 'post by user7', 'text', 'January 28-2021  11:09 PM', 'user7', 0, 0),
(15, 'â€”Pngtreeâ€”white cartoon ruler_4686222.png', 'pic', 'January 28-2021  11:09 PM', 'user7', 0, 0),
(16, 'post by user8', 'text', 'January 28-2021  11:10 PM', 'user8', 0, 0),
(17, 'pngtree-flat-cool-van-coupe-cartoon-png-image_894348.jpg', 'pic', 'January 28-2021  11:10 PM', 'user8', 0, 0),
(18, 'text post', 'text', 'January 29-2021  11:25 AM', 'user1', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
CREATE TABLE IF NOT EXISTS `friends` (
  `username` varchar(100) NOT NULL,
  `friend` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`username`, `friend`) VALUES
('user1', 'user3'),
('user3', 'user1'),
('user1', 'user4'),
('user4', 'user1'),
('user1', 'user5'),
('user5', 'user1');

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

DROP TABLE IF EXISTS `friend_requests`;
CREATE TABLE IF NOT EXISTS `friend_requests` (
  `username` varchar(100) NOT NULL,
  `sent_to` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`username`, `sent_to`) VALUES
('user8', 'user1'),
('user1', 'user7'),
('user6', 'user2'),
('user7', 'user2'),
('user8', 'user4');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `username` varchar(20) NOT NULL,
  `topic` varchar(50) NOT NULL,
  `report` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`username`, `topic`, `report`) VALUES
('user1', 'report', 'report');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `Username` varchar(100) NOT NULL,
  `Password` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Username`, `Password`) VALUES
('user1', 'User1user!'),
('user2', 'User2user!'),
('user3', 'User3user!'),
('user4', 'User4user!'),
('user5', 'User5user!'),
('user6', 'User6user!'),
('user7', 'User7user!'),
('user8', 'User8user!');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE IF NOT EXISTS `user_details` (
  `username` varchar(100) NOT NULL,
  `Full_Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` bigint(20) DEFAULT NULL,
  `ProfilePic` varchar(500) DEFAULT NULL,
  `CoverPic` varchar(500) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Gender` varchar(20) DEFAULT NULL,
  `City` text,
  `Country` varchar(20) DEFAULT NULL,
  `About_Me` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`username`, `Full_Name`, `Email`, `Phone`, `ProfilePic`, `CoverPic`, `DOB`, `Gender`, `City`, `Country`, `About_Me`) VALUES
('user1', 'Abdul Basit', 'ab4291699@gmail.com', 3156000000, 'download.png', '1.jpg', '2021-01-29', 'Male', 'Bhakkar', 'Afghanistan', 'student of nust'),
('user2', 'user2', 'user2@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('user3', 'user3', 'user3@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('user4', 'user4', 'user4@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('user5', 'user5', 'user5@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('user6', 'user6', 'user6@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('user7', 'user7', 'user7@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('user8', 'user8', 'user8@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
