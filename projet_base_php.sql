-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 17 nov. 2024 à 15:18
-- Version du serveur : 8.2.0
-- Version de PHP : 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_base_php`
--
CREATE DATABASE IF NOT EXISTS `projet_base_php` DEFAULT CHARACTER SET armscii8 COLLATE armscii8_bin;
USE `projet_base_php`;

-- --------------------------------------------------------

--
-- Structure de la table `idees`
--

DROP TABLE IF EXISTS `idees`;
CREATE TABLE IF NOT EXISTS `idees` (
  `id_idees` bigint NOT NULL AUTO_INCREMENT,
  `titre_idees` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `text_idees` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_idees`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Déchargement des données de la table `idees`
--

INSERT INTO `idees` (`id_idees`, `titre_idees`, `text_idees`, `created_by`, `created_at`, `updated_at`) VALUES
(22, 'Un tournois de Super smash bros', 'Faisons nous un petit tournois de super smash bros ultimate après les cours', 13, '2024-11-17 15:08:03', '2024-11-17 15:08:03'),
(21, 'Développement d&#39;une application', 'Faisons une petite application afin de facilité le comptage des cartes au tarot', 13, '2024-11-17 15:06:45', '2024-11-17 15:06:45'),
(20, 'Tournois de course de sac', 'On fait un tournois de tour de sac je sais pas quand', 12, '2024-11-17 15:05:30', '2024-11-17 15:05:30'),
(19, 'Petit tour au bar :)', 'Allons faire un petit tour au bar après le projet', 12, '2024-11-17 15:04:26', '2024-11-17 15:04:26');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` bigint NOT NULL AUTO_INCREMENT,
  `identifiant_user` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `password_user` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `identifiant_user`, `password_user`) VALUES
(13, 'Baptiste', '$2y$10$oBc8z8LGPmVgPH3zUHHQ4esIJQnM1k2f36mFmi060OQQGKQMTnpV6'),
(12, 'Lenny', '$2y$10$7u4.t.L55FG5VWvI8J/MM.irTCBOUj7CQrpwccRIXRvyhMBcAGv52');

-- --------------------------------------------------------

--
-- Structure de la table `vote_idees`
--

DROP TABLE IF EXISTS `vote_idees`;
CREATE TABLE IF NOT EXISTS `vote_idees` (
  `id_user` bigint NOT NULL,
  `id_idees` bigint NOT NULL,
  `vote` int DEFAULT NULL,
  `date_vote` datetime DEFAULT (now()) ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`,`id_idees`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Déchargement des données de la table `vote_idees`
--

INSERT INTO `vote_idees` (`id_user`, `id_idees`, `vote`, `date_vote`) VALUES
(12, 22, -1, '2024-11-17 15:09:08'),
(13, 20, 1, '2024-11-17 15:08:14'),
(13, 19, -1, '2024-11-17 15:08:12'),
(13, 22, 1, '2024-11-17 15:08:09'),
(13, 21, 1, '2024-11-17 15:08:09'),
(12, 19, 1, '2024-11-17 15:05:36'),
(12, 20, 1, '2024-11-17 15:05:35');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
