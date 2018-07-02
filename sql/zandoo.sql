-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 01 Juillet 2018 à 21:12
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `zandoo`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE IF NOT EXISTS `annonce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `actif` tinyint(1) NOT NULL,
  `prix` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `afficher_tel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_creation` date NOT NULL,
  `num_ordre` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C9106DFFFB88E14F` (`utilisateur_id`),
  KEY `IDX_C9106DFFBCF5E72D` (`categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `famille` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actif` tinyint(1) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_ordre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Contenu de la table `famille`
--

INSERT INTO `famille` (`id`, `actif`, `libelle`, `num_ordre`) VALUES
(1, 1, 'EMPLOI ', 1),
(2, 1, 'VEHICULES ', 2),
(3, 1, 'IMMOBILIER ', 3),
(4, 1, 'VACANCES ', 4),
(5, 1, 'MULTIMEDIA ', 5),
(6, 1, 'MATERIEL PROFESSIONNEL ', 6),
(7, 1, 'SERVICES ', 7),
(8, 1, 'MAISON ', 8),
(9, 1, 'AUTRES ', 9);



--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `famille_id` int(11) NOT NULL,
  `actif` tinyint(1) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_ordre` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DBFC8DB97A77B84` (`famille_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=65 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `famille_id`, `actif`, `libelle`, `num_ordre`) VALUES
(1, 1, 1, 'Offres d''emploi ', 1),
(2, 1, 1, 'Offres d''emploi Cadresnouveau ', 2),
(3, 2, 1, 'Voitures ', 3),
(4, 2, 1, 'Motos ', 4),
(5, 2, 1, 'Caravaning ', 5),
(6, 2, 1, 'Utilitaires ', 6),
(7, 2, 1, 'Equipement Auto ', 7),
(8, 2, 1, 'Equipement Moto ', 8),
(9, 2, 1, 'Equipement Caravaning ', 9),
(10, 2, 1, 'Nautisme ', 10),
(11, 2, 1, 'Equipement Nautisme ', 11),
(12, 3, 1, 'Ventes immobilières ', 12),
(13, 3, 1, 'Immobilier Neufnouveau ', 13),
(14, 3, 1, 'Locations ', 14),
(15, 3, 1, 'Colocations ', 15),
(16, 3, 1, 'Bureaux & Commerces ', 16),
(17, 4, 1, 'Locations & Gîtes ', 17),
(18, 4, 1, 'Chambres d''hôtes ', 18),
(19, 4, 1, 'Campings ', 19),
(20, 4, 1, 'Hôtels ', 20),
(21, 4, 1, 'Hébergements insolites ', 21),
(22, 5, 1, 'Informatique ', 22),
(23, 5, 1, 'Consoles & Jeux vidéo ', 23),
(24, 5, 1, 'Image & Son ', 24),
(25, 5, 1, 'Téléphonie ', 25),
(26, 5, 1, 'LOISIRS ', 26),
(27, 5, 1, 'DVD / Films ', 27),
(28, 5, 1, 'CD / Musique ', 28),
(29, 5, 1, 'Livres ', 29),
(30, 5, 1, 'Animaux ', 30),
(31, 5, 1, 'Vélos ', 31),
(32, 5, 1, 'Sports & Hobbies ', 32),
(33, 5, 1, 'Instruments de musique ', 33),
(34, 5, 1, 'Collection ', 34),
(35, 5, 1, 'Jeux & Jouets ', 35),
(36, 5, 1, 'Vins & Gastronomie ', 36),
(37, 6, 1, 'Matériel Agricole ', 37),
(38, 6, 1, 'Transport - Manutention ', 38),
(39, 6, 1, 'BTP - Chantier Gros-oeuvre ', 39),
(40, 6, 1, 'Outillage - Matériaux 2nd-oeuvre ', 40),
(41, 6, 1, 'Équipements Industriels ', 41),
(42, 6, 1, 'Restauration - Hôtellerie ', 42),
(43, 6, 1, 'Fournitures de Bureau ', 43),
(44, 6, 1, 'Commerces & Marchés ', 44),
(45, 6, 1, 'Matériel Médical ', 45),
(46, 7, 1, 'Prestations de services ', 46),
(47, 7, 1, 'Billetterie ', 47),
(48, 7, 1, 'Evénements ', 48),
(49, 7, 1, 'Cours particuliers ', 49),
(50, 7, 1, 'Covoiturage ', 50),
(51, 8, 1, 'Ameublement ', 51),
(52, 8, 1, 'Electroménager ', 52),
(53, 8, 1, 'Arts de la table ', 53),
(54, 8, 1, 'Décoration ', 54),
(55, 8, 1, 'Linge de maison ', 55),
(56, 8, 1, 'Bricolage ', 56),
(57, 8, 1, 'Jardinage ', 57),
(58, 8, 1, 'Vêtements ', 58),
(59, 8, 1, 'Chaussures ', 59),
(60, 8, 1, 'Accessoires & Bagagerie ', 60),
(61, 8, 1, 'Montres & Bijoux ', 61),
(62, 8, 1, 'Equipement bébé ', 62),
(63, 8, 1, 'Vêtements bébé ', 63),
(64, 9, 1, 'Autres', 64);

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE IF NOT EXISTS `demande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `actif` tinyint(1) NOT NULL,
  `prix` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `afficher_tel` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` date NOT NULL,
  `num_ordre` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_19D129BFFB88E14F` (`utilisateur_id`),
  KEY `IDX_19D129BFBCF5E72D` (`categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `famille`
--



-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actif` tinyint(1) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_ordre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE IF NOT EXISTS `profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actif` tinyint(1) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_ordre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `actif` tinyint(1) NOT NULL,
  `numOrdre` int(11) NOT NULL,
  `date_création` date NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `is_professionnel` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `FK_C9106DFFBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `FK_C9106DFFFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `FK_DBFC8DB97A77B84` FOREIGN KEY (`famille_id`) REFERENCES `famille` (`id`);

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `FK_19D129BFBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `FK_19D129BFFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
