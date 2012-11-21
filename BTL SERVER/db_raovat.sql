-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 20, 2012 at 06:15 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_raovat`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(45) NOT NULL,
  `admin_password` varchar(45) NOT NULL,
  `usergroup_id` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(150) NOT NULL,
  `category_description` varchar(250) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE IF NOT EXISTS `tbl_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_content` varchar(350) NOT NULL,
  `comment_publicationDate` datetime NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_followpost`
--

CREATE TABLE IF NOT EXISTS `tbl_followpost` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_followuser`
--

CREATE TABLE IF NOT EXISTS `tbl_followuser` (
  `userfollow_id` int(11) NOT NULL,
  `userfollowed_id` int(11) NOT NULL,
  PRIMARY KEY (`userfollow_id`,`userfollowed_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE IF NOT EXISTS `tbl_notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_content` varchar(350) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_notification`
--

INSERT INTO `tbl_notification` (`notification_id`, `notification_content`, `user_id`, `post_id`) VALUES
(1, '', 31, 2),
(2, '', 30, 3),
(3, '', 30, 4),
(4, '', 30, 5),
(5, '', 30, 24),
(6, '', 30, 25),
(7, '', 30, 26),
(8, '', 44, 1),
(9, '', 44, 2),
(10, '', 44, 3),
(11, '', 44, 4),
(12, '', 44, 5),
(13, '', 45, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

CREATE TABLE IF NOT EXISTS `tbl_post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_publicationDate` datetime NOT NULL,
  `post_visitCount` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL,
  `post_uid` int(11) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(150) NOT NULL,
  `product_description` varchar(350) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_avatar` varchar(250) NOT NULL,
  `post_publicationDate` datetime NOT NULL,
  `post_visitCount` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_description`, `user_id`, `product_avatar`, `post_publicationDate`, `post_visitCount`) VALUES
(1, 'Giay Cao Cap', 'D&G dep sang trong, 500K', 44, 'public/uploads/RVStoreRaovat20124818114857.jpg', '2012-11-18 23:49:30', 0),
(2, 'Cap hoc sinh', 'Da xin 200k', 44, 'public/uploads/RVStoreRaovat20121319011359.jpg', '2012-11-19 01:14:08', 0),
(3, 'Ao khoac nam', 'Mua dong khong lanh chi voi 250000', 44, 'public/uploads/RVStoreRaovat20123419013447.jpg', '2012-11-19 01:35:23', 0),
(4, 'Macbook Pro2012', 'Man hinh retina khong xuoc , core i5, 50000000VND', 44, 'public/uploads/RVStoreRaovat20123919013940.jpg', '2012-11-19 01:40:29', 0),
(5, 'Ban chai danh rang', 'ORANGE DUOC CAC BAC SI KHUYEN DUNG 10000VND', 44, 'public/uploads/RVStoreRaovat20125519015556.jpg', '2012-11-19 01:56:28', 0),
(6, 'Dong ho', 'Dong ho thuy sy, hang xach tay nguyen tem', 45, 'public/uploads/RVStoreRaovat20122120112158.jpg', '2012-11-20 11:22:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productimage`
--

CREATE TABLE IF NOT EXISTS `tbl_productimage` (
  `productimage_id` int(11) NOT NULL AUTO_INCREMENT,
  `productimage_link` varchar(150) NOT NULL,
  `productimage_thumb` varchar(150) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`productimage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_email` varchar(70) DEFAULT NULL,
  `user_fullname` varchar(100) DEFAULT NULL,
  `user_address` varchar(150) DEFAULT NULL,
  `user_tel` varchar(15) DEFAULT NULL,
  `user_avatar` varchar(150) DEFAULT NULL,
  `user_taikhoan` varchar(50) DEFAULT NULL,
  `user_point` varchar(30) DEFAULT NULL,
  `user_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_username`, `user_password`, `user_email`, `user_fullname`, `user_address`, `user_tel`, `user_avatar`, `user_taikhoan`, `user_point`, `user_status`) VALUES
(44, 'Tungvu', '1', 'tungvu191@gmail.com', 'Vu Dinh Tung', '27 A Dang Dung Ba Dinh Ha Noi', '0989965567', NULL, '671 231 555', NULL, 1),
(45, 'bass', '1', 'aragon_1810@yahoo.com', 'Tung Luong', 'Ha Dong', '01656078712', NULL, '1', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usergroup`
--

CREATE TABLE IF NOT EXISTS `tbl_usergroup` (
  `usergroup_id` int(11) NOT NULL AUTO_INCREMENT,
  `usergroup_name` varchar(100) NOT NULL,
  `usergroup_description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`usergroup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
