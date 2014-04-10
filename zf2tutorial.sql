-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 10, 2014 at 12:43 PM
-- Server version: 5.5.35
-- PHP Version: 5.3.10-1ubuntu3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zf2tutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `addrequest`
--

CREATE TABLE IF NOT EXISTS `addrequest` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sender_id` int(10) NOT NULL,
  `receiver_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `artist`, `title`) VALUES
(2, 'Adele', '21'),
(3, 'Bruce  Springsteen', 'Wrecking Ball (Deluxe)'),
(4, 'Lana  Del  Rey', 'Born  To  Die'),
(5, 'Gotye', 'Making  Mirrors'),
(6, 'Amit Kushwaha', 'Destiny');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `quesid` int(10) NOT NULL,
  `answer` text NOT NULL,
  `likes` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id`, `quesid`, `answer`, `likes`) VALUES
(1, 3, 'efdf', 1),
(2, 3, 'dfdfdf', 1),
(3, 8, 'fdfdf', 1),
(4, 8, 'fdfd', 1),
(5, 2, 'dsfdf', 1),
(6, 2, 'sfdfdf', 1),
(7, 2, 'fdfdsf', 1),
(8, 2, 'hghn', 1),
(9, 9, 'xgfhgf', 1),
(10, 9, 'vgcbgvb', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE IF NOT EXISTS `auth` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id`, `username`, `email`, `password`) VALUES
(1, 'Amit', 'amitkushwaha@singsys.com', '5b722b307fce6c944905d132691d5e4a2214b7fe92b738920eb3fce3a90420a19511c3010a0e7712b054daef5b57bad59ecbd93b3280f210578f547f4aed4d25'),
(2, 'Arjun', 'arj.gpt@gmail.com', '5b722b307fce6c944905d132691d5e4a2214b7fe92b738920eb3fce3a90420a19511c3010a0e7712b054daef5b57bad59ecbd93b3280f210578f547f4aed4d25'),
(3, 'Amberish', 'amberish@singsys.com', '5b722b307fce6c944905d132691d5e4a2214b7fe92b738920eb3fce3a90420a19511c3010a0e7712b054daef5b57bad59ecbd93b3280f210578f547f4aed4d25'),
(4, 'Vineet', 'vineet@singsys.com', '5b722b307fce6c944905d132691d5e4a2214b7fe92b738920eb3fce3a90420a19511c3010a0e7712b054daef5b57bad59ecbd93b3280f210578f547f4aed4d25'),
(5, 'Pravin', 'pravin@mail.com', '5b722b307fce6c944905d132691d5e4a2214b7fe92b738920eb3fce3a90420a19511c3010a0e7712b054daef5b57bad59ecbd93b3280f210578f547f4aed4d25');

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `question`) VALUES
(1, 'What is Serialization??'),
(2, 'What is OOPs Concept??'),
(3, 'I want to know about urlencode() function??'),
(4, 'what to ask?'),
(5, 'what to not ask?'),
(6, 'Ask something?'),
(7, 'sfsf'),
(8, 'wdknsdkw'),
(9, 'hgfhgh');

-- --------------------------------------------------------

--
-- Table structure for table `friendlist`
--

CREATE TABLE IF NOT EXISTS `friendlist` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `friend_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `friendlist`
--

INSERT INTO `friendlist` (`id`, `user_id`, `friend_id`) VALUES
(1, 1, 3),
(2, 3, 1),
(3, 2, 3),
(4, 3, 2),
(5, 5, 1),
(6, 1, 5),
(7, 2, 1),
(8, 1, 2),
(9, 5, 2),
(10, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dob` varchar(12) NOT NULL,
  `reg_ip` varchar(20) NOT NULL,
  `reg_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `fullname`, `username`, `email`, `dob`, `reg_ip`, `reg_date`) VALUES
(1, 'Amit Kushwaha', 'Amit', 'amitkushwaha@singsys.com', '05/02/1991', '127.0.0.1', '2014-04-03 14:30:11'),
(2, 'Arjun Gupta', 'Arjun', 'arj.gpt@gmail.com', '20/10/1990', '127.0.0.1', '2014-04-03 15:23:39'),
(3, 'Amberish Raj', 'Amberish', 'amberish@singsys.com', '18/06/1990', '127.0.0.1', '2014-04-03 16:13:39'),
(4, 'Vineet Pal', 'Vineet', 'vineet@singsys.com', '05/02/1991', '127.0.0.1', '2014-04-03 16:14:24'),
(5, 'Pravin Mishra', 'Pravin', 'pravin@mail.com', '13/05/1991', '127.0.0.1', '2014-04-07 17:51:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `usr_id` int(10) NOT NULL AUTO_INCREMENT,
  `usr_name` varchar(32) NOT NULL,
  `usr_password` char(40) NOT NULL,
  `usr_password_salt` char(20) NOT NULL,
  `usr_email` varchar(80) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `last_access` datetime NOT NULL,
  `usrl_id` int(10) NOT NULL,
  `lng_id` int(10) NOT NULL,
  `usr_active` varchar(255) NOT NULL,
  `usr_question` varchar(255) DEFAULT NULL,
  `usr_answer` varchar(255) DEFAULT NULL,
  `usr_picture` varchar(255) DEFAULT NULL,
  `usr_registration_date` datetime NOT NULL,
  `usr_registration_token` varchar(255) NOT NULL,
  `usr_email_confirmed` varchar(255) NOT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usr_id`, `usr_name`, `usr_password`, `usr_password_salt`, `usr_email`, `active`, `last_access`, `usrl_id`, `lng_id`, `usr_active`, `usr_question`, `usr_answer`, `usr_picture`, `usr_registration_date`, `usr_registration_token`, `usr_email_confirmed`) VALUES
(1, 'amit', 'amit5291', 'mysalt', 'amit@singsys.com', 1, '0000-00-00 00:00:00', 3, 1, '1', 'my name', 'amit', '', '2013-07-19 12:00:00', '', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
