-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Mar 06 Septembre 2016 à 16:58
-- Version du serveur :  5.5.42
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `admin_st`
--

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `news` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) DEFAULT NULL,
  `titre` varchar(50) NOT NULL,
  `sous_titre` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `commentaire` text NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `2017lucillede_models` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN KEY (`image_id`) REFERENCES `image_news` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;


CREATE TABLE `image_news` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(250) NOT NULL,
  `news_id` int(11) DEFAULT NULL,
  FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL,
  `title` varchar(40) DEFAULT NULL,
  `description` varchar(235) DEFAULT NULL,
  `date_creation` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `date_creation`) VALUES
(1, 'Horaires', 'Contenu', '2016-01-10'),
(2, 'Lol', 'lol', NULL),
(3, 'Honoraires', '10€', '2016-10-10'),
(4, 'test test', 'test test', '0000-00-00'),
(5, 'test test', 'test test', '0000-00-00'),
(6, 'Date de la rentrÃ©es', 'A1 lundi, A2 mardi', '0000-00-00'),
(7, 'Vacances', 'Voila, c''est la fin', '0000-00-00'),
(8, 'test test', 'test test', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL,
  `useradmin` varchar(11) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `admin` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `useradmin`, `password`, `admin`) VALUES
(1, 'tim', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(2, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 2);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
