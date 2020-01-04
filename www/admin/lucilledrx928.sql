-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : lucilledrx928.mysql.db
-- Généré le :  mar. 28 nov. 2017 à 18:52
-- Version du serveur :  5.6.34-log
-- Version de PHP :  7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lucilledrx928`
--

-- --------------------------------------------------------

--
-- Structure de la table `2017lucillede_models`
--

CREATE TABLE `2017lucillede_models` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` text NOT NULL,
  `height` varchar(255) NOT NULL,
  `bust` varchar(255) NOT NULL,
  `waist` varchar(255) NOT NULL,
  `hips` varchar(255) NOT NULL,
  `hair` varchar(255) NOT NULL,
  `eyes` varchar(255) NOT NULL,
  `shoes` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `image4` varchar(255) NOT NULL,
  `image5` varchar(255) NOT NULL,
  `image6` varchar(255) NOT NULL,
  `image7` varchar(255) NOT NULL,
  `image8` varchar(255) NOT NULL,
  `image9` varchar(255) NOT NULL,
  `image10` varchar(255) NOT NULL,
  `image11` varchar(255) NOT NULL,
  `image12` varchar(255) NOT NULL,
  `image13` varchar(255) NOT NULL,
  `image14` varchar(255) NOT NULL,
  `image15` varchar(255) NOT NULL,
  `image16` varchar(255) NOT NULL,
  `image17` varchar(255) NOT NULL,
  `image18` varchar(255) NOT NULL,
  `image19` varchar(255) NOT NULL,
  `image20` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `2017lucillede_users`
--

CREATE TABLE `2017lucillede_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `useradmin` varchar(11) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `2017lucillede_users`
--

INSERT INTO `2017lucillede_users` (`id`, `useradmin`, `password`, `admin`) VALUES
(1, 'admin', 'd6fcb0dcd3dc59e7fff5f976a3c98f36', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `2017lucillede_models`
--
ALTER TABLE `2017lucillede_models`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `2017lucillede_users`
--
ALTER TABLE `2017lucillede_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `2017lucillede_models`
--
ALTER TABLE `2017lucillede_models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
