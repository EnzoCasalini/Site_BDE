-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 23, 2022 at 12:13 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdd_bde_enzo`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `post_title` varchar(100) NOT NULL,
  `post_content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_mel` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_modif` datetime DEFAULT NULL,
  PRIMARY KEY (`id_post`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id_post`, `id_user`, `post_title`, `post_content`, `post_mel`, `post_modif`) VALUES
(1, 44, 'Un article de test', 'test de modification d\'article', '2022-01-22 19:18:07', '2022-01-23 12:37:11'),
(2, 44, 'S\'il vous plait', 'aregnklùaei ^yohtrphi,z', '2022-01-22 20:03:41', NULL),
(3, 45, 'J\'aime le php', 'le php un language magnifique qui permet de faire des choses incroyable', '2022-01-23 12:38:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_mail` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_role` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_pp` varchar(255) NOT NULL,
  `user_pwd` text NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `user_name`, `user_mail`, `user_role`, `user_pp`, `user_pwd`, `admin`) VALUES
(44, 'Roro', 'romain@gmail.com', 'B1', 'NULL', 'DKOPFAI¨JZOGAEROP?NÖAVPER', 0),
(45, 'Marius', 'bianchi@ynov.com', 'M2', 'default_pp.jpg', '$2y$10$CkNsiHHb40.K4d7DCZlk2O/mTHVIIO75Sm7CbeZzRtGrBe2CZpAoq', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
