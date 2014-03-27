-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2014 at 03:55 PM
-- Server version: 5.5.35
-- PHP Version: 5.3.10-1ubuntu3.9

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

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
(7, 2, 'fdfdsf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

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
(8, 'wdknsdkw');

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
