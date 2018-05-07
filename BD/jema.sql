-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 07 mai 2018 à 19:45
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `jema`
--

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'upload/default-news.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `date`, `image`) VALUES
(1, 'Salon Vinisud', 'Les membres de la JEMA n’ont pas manqué le salon VINISUD !\r\nSitué au parc des expositions de Montpellier, cet événement s’adresse aux professionnels mais aussi à tous les étudiants. C’était une belle opportunité pour nous de rencontrer des professionnels, de faire connaître la JEMA et de déguster des vins de Bordeaux, de Provence, du Languedoc ou encore de Corse. C’est aussi l’occasion de découvrir les innovations appliquées au domaine vinicole et les expositions de posters d’étudiants de l’option Viticulture et Œnologie de Montpellier SupAgro.\r\nLes membres de la JEMA n’ont pas manqué le salon VINISUD !\r\nSitué au parc des expositions de Montpellier, cet événement s’adresse aux professionnels mais aussi à tous les étudiants. C’était une belle opportunité pour nous de rencontrer des professionnels, de faire connaître la JEMA et de déguster des vins de Bordeaux, de Provence, du Languedoc ou encore de Corse. C’est aussi l’occasion de découvrir les innovations appliquées au domaine vinicole et les expositions de posters d’étudiants de l’option Viticulture et Œnologie de Montpellier SupAgro.', '2018-05-05', 'upload/vinisud-2.jpg'),
(2, 'Nouveau site pour la JEMA', 'La JEMA ouvre son nouveau site, pour remplacer l\'ancienne plate-forme Wordpress désuète et un peu abandonnée. Au rayon des nouveautés, vous pouvez d\'ores et déjà compter sur une interface et une structure remaniées, des formulaires de contact et de devis rénovés et un tout nouveau système de news. \r\nL\'objectif de cette refonte est de vous fournir une expérience digitale la plus agréable possible, tout en répondant à un maximum de vos interrogations concernant la JEMA.\r\nNous espérons vous revoir très vite sur le site ! ', '2018-05-06', 'upload/site-news.jpg'),
(4, 'Salon Vinisud', 'Les membres de la JEMA n’ont pas manqué le salon VINISUD !\r\nSitué au parc des expositions de Montpellier, cet événement s’adresse aux professionnels mais aussi à tous les étudiants. C’était une belle opportunité pour nous de rencontrer des professionnels, de faire connaître la JEMA et de déguster des vins de Bordeaux, de Provence, du Languedoc ou encore de Corse. C’est aussi l’occasion de découvrir les innovations appliquées au domaine vinicole et les expositions de posters d’étudiants de l’option Viticulture et Œnologie de Montpellier SupAgro.\r\nLes membres de la JEMA n’ont pas manqué le salon VINISUD !\r\nSitué au parc des expositions de Montpellier, cet événement s’adresse aux professionnels mais aussi à tous les étudiants. C’était une belle opportunité pour nous de rencontrer des professionnels, de faire connaître la JEMA et de déguster des vins de Bordeaux, de Provence, du Languedoc ou encore de Corse. C’est aussi l’occasion de découvrir les innovations appliquées au domaine vinicole et les expositions de posters d’étudiants de l’option Viticulture et Œnologie de Montpellier SupAgro.', '2018-05-05', 'upload/vinisud-2.jpg'),
(5, 'Nouveau site pour la JEMA', 'La JEMA ouvre son nouveau site, pour remplacer l\'ancienne plate-forme Wordpress désuète et un peu abandonnée. Au rayon des nouveautés, vous pouvez d\'ores et déjà compter sur une interface et une structure remaniées, des formulaires de contact et de devis rénovés et un tout nouveau système de news. \r\nL\'objectif de cette refonte est de vous fournir une expérience digitale la plus agréable possible, tout en répondant à un maximum de vos interrogations concernant la JEMA.\r\nNous espérons vous revoir très vite sur le site ! ', '2018-05-06', 'upload/site-news.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
