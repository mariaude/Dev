-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 28 Septembre 2018 à 18:18
-- Version du serveur :  5.6.37
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `GestionStage`
--

-- --------------------------------------------------------

--
-- Structure de la table `Enterprises`
--

CREATE TABLE IF NOT EXISTS `Enterprises` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal_code` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Enterprises`
--

INSERT INTO `Enterprises` (`id`, `user_id`, `name`, `adress`, `city`, `province`, `postal_code`, `region`, `active`) VALUES
(1, 43, 'brod', '2354 rue Silver', 'Laval', 'Québec', 'J6D6H5', 'voj', 0);

-- --------------------------------------------------------

--
-- Structure de la table `Internships`
--

CREATE TABLE IF NOT EXISTS `Internships` (
  `id` int(11) NOT NULL,
  `enterprise_id` int(11) NOT NULL,
  `semester` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `available_places` int(11) NOT NULL,
  `work_hours` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Internships`
--

INSERT INTO `Internships` (`id`, `enterprise_id`, `semester`, `start_date`, `end_date`, `available_places`, `work_hours`, `title`, `description`) VALUES
(4, 1, 'Été', '2014-05-02', '2018-09-28', 1, '30', 'concierge', 'laver des planchers');

-- --------------------------------------------------------

--
-- Structure de la table `Students`
--

CREATE TABLE IF NOT EXISTS `Students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admission_number` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` char(13) COLLATE utf8_unicode_ci NOT NULL,
  `informations` text COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Students`
--

INSERT INTO `Students` (`id`, `user_id`, `admission_number`, `first_name`, `last_name`, `phone_number`, `informations`, `notes`, `active`) VALUES
(18, 40, '111111111', '11111111', '11111111', '11111111', '1111111111111111', '1111111111111', 1),
(19, 42, '123456789', 'Cynthia', 'Boissonneault', '1234567890123', 'Je veux mourir', '', 0),
(20, 44, '987456321', 'Youcef', 'Bokari', '3216541236541', 'Bonjour', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Users`
--

INSERT INTO `Users` (`id`, `email`, `password`, `role`) VALUES
(1, 'cynt@bidon.com', '$2y$10$zQ0PIni8iLdkPjP.m8RB6.3w5gRufEMSCkZtszELjCATsiTKSxBJO', 'admin'),
(40, 'camarche@gmail.com', '$2y$10$.m3ZX2uUtm9jQnNeU6h.o.lhzOgmzYn5DqgcjH3fjlVX9z7izpl2m', 'student'),
(42, 'cynthia@bidon.com', '$2y$10$AiQFbyxjTfVAUDvLS7mYbOHT4Zd432w3xMsT.voe.lSrPgE6PPd9a', 'student'),
(43, 'brod@bidon.com', '$2y$10$XYW6CU/0G.05oQ.w6s0N5eHtkggFnwXXh/08qw8hwRR6k2Wa3RB0K', 'enterprise'),
(44, 'youcef@bidon.com', '$2y$10$Md0GSxnTIYTj9nzSBTmp9.xitApt0WNlio5LvbAQW5uw/5z86ie8u', 'student');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Enterprises`
--
ALTER TABLE `Enterprises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `Internships`
--
ALTER TABLE `Internships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enterprise_id` (`enterprise_id`);

--
-- Index pour la table `Students`
--
ALTER TABLE `Students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Enterprises`
--
ALTER TABLE `Enterprises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `Internships`
--
ALTER TABLE `Internships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `Students`
--
ALTER TABLE `Students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Enterprises`
--
ALTER TABLE `Enterprises`
  ADD CONSTRAINT `enterprises_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `Internships`
--
ALTER TABLE `Internships`
  ADD CONSTRAINT `internships_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprises` (`id`);

--
-- Contraintes pour la table `Students`
--
ALTER TABLE `Students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
