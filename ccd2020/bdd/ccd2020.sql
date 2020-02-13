-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 13 fév. 2020 à 12:37
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `coboard`
--

-- --------------------------------------------------------

--
-- Structure de la table `creneau`
--

DROP TABLE IF EXISTS `creneau`;
CREATE TABLE `creneau` (
  `id` int(11) NOT NULL,
  `jour` int(1) NOT NULL,
  `semaine` varchar(1) NOT NULL,
  `hDebut` int(2) NOT NULL,
  `hFin` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `creneau`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

ALTER TABLE `creneau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
-- --------------------------------------------------------

--
-- Structure de la table `besoin`
--

DROP TABLE IF EXISTS `besoin`;
CREATE TABLE IF NOT EXISTS `besoin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creneau` int(11) NOT NULL,
  `role` int(1) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `label`) VALUES
(1, 'Caissier titulaire'),
(2, 'Caissier assistant'),
(3, 'Gestionnaire de vrac titulaire'),
(4, 'Gestionnaire de vrac assistant'),
(5, 'Chargé d\'accueil titulaire'),
(6, 'Chargé d\'accueil assistant');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '-1',
  `prenom` varchar(256) NOT NULL,
  `mail` varchar(256) NOT NULL,
  `tel` varchar(256) NOT NULL,
  `photo` varchar(256) NOT NULL,
  `permanence` int(11) NOT NULL,
  `absence` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `mdp`, `role`) VALUES
(1, 'Cassandre', '', 0),
(2, 'Achille', '', 0),
(3, 'Calypso', '', 0),
(4, 'Bacchus', '', 0),
(5, 'Diane', '', 0),
(6, 'Clark', '', 0),
(7, 'Helene', '', 0),
(8, 'Jason', '', 0),
(9, 'Bruce', '', 0),
(10, 'Pénélope', '', 0),
(11, 'Ariane', '', 0),
(12, 'Lois', '', 0),
(15, 'test', '$2y$10$clYLmNxzv.NHPCToxd1wm.z.Uf5Myho5DQAR/z6GqUe5ahmRUF.AS', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
