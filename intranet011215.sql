-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2015 at 05:04 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `intranet`
--
CREATE DATABASE IF NOT EXISTS `intranet` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `intranet`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(111) CHARACTER SET utf8 NOT NULL,
  `email` varchar(111) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role_id` int(10) NOT NULL,
  `status` enum('active','blocked') CHARACTER SET utf8 NOT NULL DEFAULT 'blocked',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `role_id`, `status`, `created`) VALUES
(10, 'Sakib', 'sattar@gmail.com', '38b9062c287fad72d20e920e01c68bbc4a65eaf51aefc818ec011627441cfead', 1, 'active', '2015-09-08 18:20:01'),
(11, 'N Sakib', 'sakibdd@gmail.com', 'c6e29a6da7f0706e7e0f2bcc22d65c83dfc8a3b0d7b063b9c293f15cf6260384', 1, 'active', '2015-09-14 13:42:38');

-- --------------------------------------------------------

--
-- Table structure for table `attendences`
--

CREATE TABLE IF NOT EXISTS `attendences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(111) NOT NULL,
  `intime` varchar(111) DEFAULT NULL,
  `outtime` varchar(111) DEFAULT NULL,
  `ecomment` varchar(1111) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `attendences`
--

INSERT INTO `attendences` (`id`, `employee_id`, `intime`, `outtime`, `ecomment`, `date`) VALUES
(1, 1, '1:35 pm', '1:37 pm', '', '2015-09-15'),
(2, 1, '1:37 pm', '1:37 pm', '', '2015-09-15'),
(3, 1, '1:41 pm', NULL, '', '2015-09-15');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(111) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'Web Development'),
(2, 'New Departmet'),
(3, '123'),
(4, '987'),
(5, '12322'),
(6, 'sdfa'),
(7, 'New Dept.'),
(8, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `email` varchar(41) NOT NULL,
  `password` varchar(200) NOT NULL,
  `full_name` varchar(25) NOT NULL,
  `cell` varchar(13) NOT NULL,
  `nid` int(11) NOT NULL,
  `dob` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `designation` char(111) NOT NULL,
  `department_id` int(111) NOT NULL,
  `doc1` varchar(12) NOT NULL,
  `doc2` varchar(17) NOT NULL,
  `doc3` varchar(111) NOT NULL,
  `ch_signature` varchar(71) NOT NULL COMMENT 'card holder signature',
  `bank_name` varchar(31) NOT NULL,
  `status` enum('active','blocked') NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `email`, `password`, `full_name`, `cell`, `nid`, `dob`, `designation`, `department_id`, `doc1`, `doc2`, `doc3`, `ch_signature`, `bank_name`, `status`, `role_id`) VALUES
(1, 'sattar@gmail.com', '38b9062c287fad72d20e920e01c68bbc4a65eaf51aefc818ec011627441cfead', '', '', 0, '2015-07-29 15:45:52', '', 0, '', '', '0', '', '', 'active', 0),
(2, 'lemonpstu09@gmail.com', '38b9062c287fad72d20e920e01c68bbc4a65eaf51aefc818ec011627441cfead', 'lemon kazi', '01840478812', 15486622, '2015-08-12 21:10:50', 'W', 0, '', '', '', '', 'sdasde', 'active', 0),
(3, 'sattar15@gmail.com', '15781d07ef531d50f794c311df797b6d0b2b4695fba76515b2adea62c575b7ca', 'lemon kazi', '+880184047881', 41654654, '2015-08-13 19:12:55', 'dasd', 1, '', '', '', '', '1564', 'active', 0),
(4, 'abdullah88miah@gmail.com', '15781d07ef531d50f794c311df797b6d0b2b4695fba76515b2adea62c575b7ca', 'abdulah', '01721003717', 2147483647, '2015-08-13 19:22:54', 'junior developer', 1, '1439468574.j', '', '', '', 'Islamic Bank', 'active', 0),
(6, 'sakib@gmail.com', '48d887b7af60140b343f8a5c8e9da387023db09782b3b1034a2204c892a10ba1', 'Nazmus Sakib', '01917478191', 199200999, '2015-08-24 16:39:37', 'Jr. Web Developer', 1, 'sakibgmail.c', 'sakibgmail.com.pn', '', '', 'DBBL', 'active', 0),
(7, 'sakib@gmail.ocm', '48d887b7af60140b343f8a5c8e9da387023db09782b3b1034a2204c892a10ba1', 'Nazmus Sakib', '01724468809', 2147483647, '2015-08-24 16:45:59', 'Jr. Web Developer', 1, 'sakibgmail.o', 'sakibgmail.ocm.pn', '', '', 'DBBL', 'active', 0),
(8, 'sattar123@gmail.com', '48d887b7af60140b343f8a5c8e9da387023db09782b3b1034a2204c892a10ba1', 'Name name', '65464516', 684684, '2015-09-12 18:42:23', 'boss', 7, 'sattar123gma', 'sattar123gmail.co', '', '', 'fsdfsa', 'active', 0),
(9, 'satfdtar@gmail.com', 'de9091532cf6cf3a8bfc1e8c2925fdbbf81e32cafe6bd449efbaaeac3e3ae920', 'sgdfg', '2562', 63456, '2015-09-12 20:30:10', 'sdgf', 0, '', '', '', '', 'sgdf', 'active', 0),
(10, 'satfdta4444r@gmail.com', 'c08b5bd11661cbcc46f089472ead6ae847a62d623cd00b08080f57aa86f9f10c', 'sgdfg', '2562', 63456, '2015-09-12 20:30:51', 'sdgf', 0, '', '', '', '', 'sgdf', 'active', 0),
(11, 'fdsf@fds.com', '3388271a2d0360324e4a64c87574cb4ee3af289e104fd86cdece3cf2d4bc4951', 'dasfaf', 'afsdadfsa', 546456465, '2015-09-14 15:15:52', 'fsdf', 1, '', '', '', '', 'asdsad', 'active', 6);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(1111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `department_id` int(111) NOT NULL,
  `status` enum('active','blocked') NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(111) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'sadmin'),
(2, 'admin'),
(3, 'hrllo'),
(4, 'hrllogdsf'),
(5, 'aaaaaa'),
(6, 'employee');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
