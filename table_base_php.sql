-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.3.0 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour projet_base_php
DROP DATABASE IF EXISTS `projet_base_php`;
CREATE DATABASE IF NOT EXISTS `projet_base_php` /*!40100 DEFAULT CHARACTER SET armscii8 COLLATE armscii8_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `projet_base_php`;

-- Listage de la structure de table projet_base_php. idees
DROP TABLE IF EXISTS `idees`;
CREATE TABLE IF NOT EXISTS `idees` (
  `id_idees` bigint NOT NULL AUTO_INCREMENT,
  `titre_idees` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `text_idees` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_idees`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Listage des données de la table projet_base_php.idees : 3 rows
DELETE FROM `idees`;
/*!40000 ALTER TABLE `idees` DISABLE KEYS */;
INSERT INTO `idees` (`id_idees`, `titre_idees`, `text_idees`, `created_by`, `created_at`) VALUES
	(1, 'idee 1 titreidee 1 titreidee 1 titreidee 1 titreidee 1 titreidee 1 titreidee 1 titreidee 1 titre', 'acheter une voitureacheter une voitureacheter une voitureacheter une voitureacheter une voitureacheter une voitureacheter une voitureacheter une voitureacheter une voitureacheter une voitureacheter une voitureacheter une voiture', 1, '2024-11-15 11:40:36'),
	(2, 'titre idée 2', 'partir en voyage', 1, '2024-11-15 12:30:15'),
	(3, 'idée lenny', 'faire une soirée', 2, '2024-11-15 10:30:16');
/*!40000 ALTER TABLE `idees` ENABLE KEYS */;

-- Listage de la structure de table projet_base_php. user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` bigint NOT NULL AUTO_INCREMENT,
  `identifiant_user` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `password_user` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Listage des données de la table projet_base_php.user : 2 rows
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `identifiant_user`, `password_user`) VALUES
	(1, 'baptiste', 'zpdufhguqhsdfgqpfh'),
	(2, 'lenny', 'qsdfsdbvsdkfgjvhsdfjhgb');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Listage de la structure de table projet_base_php. vote_idees
DROP TABLE IF EXISTS `vote_idees`;
CREATE TABLE IF NOT EXISTS `vote_idees` (
  `id_user` bigint NOT NULL,
  `id_idees` bigint NOT NULL,
  `vote` int DEFAULT NULL,
  `date_vote` datetime DEFAULT (now()) ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`,`id_idees`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Listage des données de la table projet_base_php.vote_idees : 4 rows
DELETE FROM `vote_idees`;
/*!40000 ALTER TABLE `vote_idees` DISABLE KEYS */;
INSERT INTO `vote_idees` (`id_user`, `id_idees`, `vote`, `date_vote`) VALUES
	(1, 1, 1, '2024-11-15 14:54:03'),
	(1, 2, 1, '2024-11-15 14:54:11'),
	(1, 3, -1, '2024-11-15 14:10:08'),
	(2, 1, -1, '2024-11-15 14:58:36');
/*!40000 ALTER TABLE `vote_idees` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
