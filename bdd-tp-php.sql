-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 24 jan. 2022 à 22:05
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdd_bde_enzo`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
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
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `user_name`, `user_mail`, `user_role`, `user_pp`, `user_pwd`, `admin`) VALUES
(44, 'Roro', 'romain@gmail.com', 'B1', 'NULL', 'DKOPFAI¨JZOGAEROP?NÖAVPER', 0),
(45, 'Marius', 'bianchi@ynov.com', 'M2', 'default_pp.jpg', '$2y$10$CkNsiHHb40.K4d7DCZlk2O/mTHVIIO75Sm7CbeZzRtGrBe2CZpAoq', 1),
(46, 'EnzoCasalini', 'enzo.casalini@ynov.com', 'B1', '46.jpg', '$2y$10$bqkyihM26TMXSYGhU5BRcOESdAM1QBk3HfnMpq.wyYixYr2X6y2uG', 0),
(47, 'Spiderman', 'spiderman@ynov.com', 'B3', '47.jpg', '$2y$10$2eMF9QJim.7wczHQ3/Tao.ULgj2uu8cW/yDthrwWt7s./tdjTO7du', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
