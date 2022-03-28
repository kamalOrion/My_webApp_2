-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 28 mars 2022 à 08:47
-- Version du serveur : 5.7.26
-- Version de PHP : 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `omel`
--

-- --------------------------------------------------------

--
-- Structure de la table `depenses`
--

DROP TABLE IF EXISTS `depenses`;
CREATE TABLE IF NOT EXISTS `depenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_depense` date NOT NULL,
  `code` varchar(50) NOT NULL,
  `designation` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `statut` int(11) NOT NULL,
  `date_enreg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modif` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `depenses`
--

INSERT INTO `depenses` (`id`, `date_depense`, `code`, `designation`, `quantite`, `prix_unitaire`, `montant`, `statut`, `date_enreg`, `date_modif`) VALUES
(1, '2022-03-24', 'D-1', 1, 2, 400, 800, 1, '2022-03-16 12:09:11', '2022-03-16 12:32:59'),
(2, '2022-03-09', 'D-5', 5, 32, 25, 800, 2, '2022-03-16 13:20:12', '2022-03-16 14:02:02'),
(3, '2022-03-17', 'D-1', 1, 12, 400, 5000, 1, '2022-03-16 13:23:43', '2022-03-28 00:09:46'),
(4, '2022-03-16', 'D-1', 1, 585, 400, 34532, 1, '2022-03-28 00:12:57', '2022-03-28 00:14:04'),
(5, '2022-03-09', 'D-6', 5, 78, 25, 78, 1, '2022-03-28 00:15:16', '2022-03-28 00:15:32');

-- --------------------------------------------------------

--
-- Structure de la table `designations`
--

DROP TABLE IF EXISTS `designations`;
CREATE TABLE IF NOT EXISTS `designations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `prix_unitaire` int(11) NOT NULL,
  `statut` int(11) NOT NULL,
  `date_enreg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modif` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `designations`
--

INSERT INTO `designations` (`id`, `code`, `libelle`, `prix_unitaire`, `statut`, `date_enreg`, `date_modif`) VALUES
(1, 'D-1', 'Pain Libanait', 400, 1, '2022-03-16 11:29:34', '2022-03-16 11:29:34'),
(2, 'D-2', 'Crevettes', 300, 1, '2022-03-16 11:29:59', '2022-03-16 11:29:59'),
(3, 'D-2', 'Huile de palme', 654, 1, '2022-03-16 11:32:37', '2022-03-28 10:45:11'),
(4, '1', 'Sel', 1200, 2, '2022-03-16 12:39:58', '2022-03-28 10:45:17'),
(5, 'D-6', 'Epices', 25, 1, '2022-03-16 12:51:56', '2022-03-28 10:45:29'),
(6, 'D-6', 'Amuses geule', 0, 1, '2022-03-28 00:16:34', '2022-03-28 10:46:35');

-- --------------------------------------------------------

--
-- Structure de la table `recettes`
--

DROP TABLE IF EXISTS `recettes`;
CREATE TABLE IF NOT EXISTS `recettes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_recette` date NOT NULL,
  `code` varchar(50) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `montant_ajuste` int(11) NOT NULL,
  `statut` int(11) NOT NULL,
  `date_enreg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modif` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recettes`
--

INSERT INTO `recettes` (`id`, `date_recette`, `code`, `designation`, `quantite`, `prix_unitaire`, `montant`, `montant_ajuste`, `statut`, `date_enreg`, `date_modif`) VALUES
(1, '2022-03-18', 'D-1', '1', 25, 400, 10000, 2500, 2, '2022-03-16 12:23:36', '2022-03-16 14:01:49'),
(2, '2022-03-17', 'D-5', '5', 45, 25, 1125, 654, 2, '2022-03-16 13:15:51', '2022-03-16 14:01:53');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenoms` varchar(150) NOT NULL,
  `email` text NOT NULL,
  `pass` varchar(150) NOT NULL,
  `privileges` varchar(20) NOT NULL,
  `statut` varchar(10) NOT NULL,
  `date_enreg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modif` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`(255))
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenoms`, `email`, `pass`, `privileges`, `statut`, `date_enreg`, `date_modif`) VALUES
(1, 'YAOITCHA', 'Kamal', 'admin@resto.com', 'fe703d258c7ef5f50b71e06565a65aa07194907f', '9876543210', 'Actif', '2022-02-25 09:11:55', '2022-03-28 10:40:16'),
(2, 'YAOITCHA', 'Karim', 'user2@resto.com', 'fe703d258c7ef5f50b71e06565a65aa07194907f', '87654321', 'Actif', '2022-03-01 09:50:03', '2022-03-28 10:44:00'),
(3, 'YAKPE', 'user3', 'user3@resto.com', '67a74306b06d0c01624fe0d0249a570f4d093747', '87654321', 'Actif', '2022-03-01 12:23:30', '2022-03-28 10:44:31');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
