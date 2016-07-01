-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.20 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for registration
CREATE DATABASE IF NOT EXISTS `registration` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `registration`;


-- Dumping structure for table registration.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(155) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `password_hint` varchar(100) DEFAULT NULL COMMENT 'It show the password hint',
  `user_type` enum('C','F','E') DEFAULT NULL COMMENT 'C => Company,\nF => freelancer,\nE => employers',
  `status` enum('P','A','D') DEFAULT NULL COMMENT 'P => Pending Confirmation,\nA => Active User,\nD => Deleted User',
  `created_at` datetime DEFAULT NULL COMMENT 'Date Of Registeration ',
  `created_ip` varchar(100) DEFAULT NULL COMMENT 'IP of Registered system',
  `activated_at` datetime DEFAULT NULL COMMENT 'Date Of User Activation',
  `login_at` datetime DEFAULT NULL COMMENT 'Date time of login',
  `login_session` varchar(500) DEFAULT NULL COMMENT 'Used to avoid multiple login when configured',
  `password_hash` varchar(255) DEFAULT NULL COMMENT 'Used for reset password',
  `password_hash_at` datetime DEFAULT NULL COMMENT 'Reset password required date',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
