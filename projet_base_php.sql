-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 16 nov. 2024 à 14:30
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
-- Base de données : `projet_base_php_alt`
--

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Déchargement des données de la table `idees`
--

INSERT INTO `idees` (`id_idees`, `titre_idees`, `text_idees`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'idee 1 titreidee 1 titreidee 1 titreidee 1 titreidee 1 titreidee 1 titreidee 1 titreidee 1 titre', 'acheter une voitureacheter une voitureacheter une voitureacheter une voitureacheter une voitureacheter une voitureacheter une voitureacheter une voitureacheter une voitureacheter une voitureacheter une voitureacheter une voiture', 1, '2024-11-15 11:40:36', NULL),
(2, 'titre idée 2', 'partir en voyage', 1, '2024-11-15 12:30:15', NULL),
(3, 'idée lenny', 'faire une soirée', 2, '2024-11-15 10:30:16', NULL),
(4, 'Idée de test Lenny', 'Ce ci est une iodée de test pur tester le bug', 1, '2024-11-16 13:42:18', '2024-11-16 13:42:18'),
(5, 'Idée de test jfdjklhsdjkhdfkljsfdkjhlksfjdkjsdfqlkkfhksfjqkhjhjsfkhjsfhj', 'jkhfkjlfsjfqsjkflmsdjjmlkfsmjlkfsjlmksfdjkmfqsdjlqfjlkmmjfmjkfsdmjqsdfmjlfdsjlmkjsfmkjlsflkj', 3, '2024-11-16 13:52:13', '2024-11-16 13:52:13'),
(6, 'Idée de test jfdjklhsdjkhdfkljsfdkjhlksfjdkjsdfqlkkfhksfjqkhjhjsfkhjsfhj', 'jkhfkjlfsjfqsjkflmsdjjmlkfsmjlkfsjlmksfdjkmfqsdjlqfjlkmmjfmjkfsdmjqsdfmjlfdsjlmkjsfmkjlsflkj', 3, '2024-11-16 13:54:57', '2024-11-16 13:54:57'),
(7, 'Idée de test jfdjklhsdjkhdfkljsfdkjhlksfjdkjsdfqlkkfhksfjqkhjhjsfkhjsfhj', 'jkhfkjlfsjfqsjkflmsdjjmlkfsmjlkfsjlmksfdjkmfqsdjlqfjlkmmjfmjkfsdmjqsdfmjlfdsjlmkjsfmkjlsflkj', 3, '2024-11-16 13:57:15', '2024-11-16 13:57:15'),
(8, 'Idée de test de bug 123456789', 'J&#39;ai pas d&#39;inspi pour celle la deso :p', 3, '2024-11-16 14:11:32', '2024-11-16 14:11:32'),
(9, 'Idée de test de bug 123456789101112131415', 'J&#39;ai pas d&#39;inspi pour celle la deso :p jkfdjkmqdfsljk', 3, '2024-11-16 14:11:59', '2024-11-16 14:11:59'),
(10, 'Idée de test de bug 123456789101112131415', 'J&#39;ai pas d&#39;inspi pour celle la deso :p jkfdjkmqdfsljk', 3, '2024-11-16 14:13:42', '2024-11-16 14:13:42'),
(11, 'Idée de test de bug 123456789101112131415', 'J&#39;ai pas d&#39;inspi pour celle la deso :p jkfdjkmqdfsljk', 3, '2024-11-16 14:14:11', '2024-11-16 14:14:11'),
(12, 'Bonjourno', 'salem les roilla ca va bien ou bien', 3, '2024-11-16 14:18:21', NULL),
(13, 'Idée de test de malade', 'jhfdjhlkqsfljhjhsflhjklqsjkhljkhlsdfqjhhjkfqsjhksldjkhlsfqhjklsdjhklsdfhjklsdfjhkqsdfhjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj', 3, '2024-11-16 14:21:58', '2024-11-16 14:21:58');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `identifiant_user`, `password_user`) VALUES
(1, 'baptiste', 'zpdufhguqhsdfgqpfh'),
(2, 'lenny', 'qsdfsdbvsdkfgjvhsdfjhgb'),
(3, 'admin', '$2y$10$NZWLyy23V4oHK75kYeyrDec4YvImKUhZi5fo5EKZnguoev3R7ZD86');

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
(1, 1, 1, '2024-11-15 14:54:03'),
(1, 2, 1, '2024-11-15 14:54:11'),
(1, 3, -1, '2024-11-15 14:10:08'),
(2, 1, -1, '2024-11-15 14:58:36');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
