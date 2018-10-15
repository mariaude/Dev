-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 15 Octobre 2018 à 19:55
-- Version du serveur :  5.6.37
-- Version de PHP :  7.1.8

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
-- Structure de la table `client_type`
--

CREATE TABLE IF NOT EXISTS `client_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `client_type`
--

INSERT INTO `client_type` (`id`, `name`) VALUES
(1, 'UTRF'),
(2, 'Soins de clientèle hébergée et hôpital de jour'),
(3, 'Soins de clientèle hébergée et externe'),
(4, 'Soins de clientèle externe, hospitalisée et hébergée, rééducation et renforcement au travail'),
(5, 'Soins de clientèle externe'),
(6, 'Soins clientèle hospitalisée'),
(7, 'Soins clientèle hébergée, soins de clientèle en convalescence'),
(8, 'Soins clientèle hébergée et hospitalisée'),
(9, 'Soins clientèle hébergée et externe'),
(10, 'Soins clientèle hébergé et possibilité de Centre de jour'),
(11, 'Soins clientèle externe, rééducation au travail'),
(12, 'Soins clientèle externe et interne'),
(13, 'Soins clientèle externe et hospitalisée'),
(14, 'Soins clientèle externe et hébergée'),
(15, 'Soins clientèle externe et à domicile'),
(16, 'Soins clientèle externe'),
(17, 'Soins clientèle à domicile et en hébergement, Centre de jour'),
(18, 'Soins clientèle à domicile et clientèle externe'),
(19, 'Soins clientèle à domicile'),
(20, 'Recherche clinique'),
(21, "Principalement ortho/rhumato, un peu de perte d'autonomie"),
(22, "Perte d'autonomie, orthopédie/rhumatologie, neuro, cardiorespiratoire"),
(23, "Perte d'autonomie, orthopédie/rhumatologie, neuro"),
(24, "Perte d'autonomie, Orthopédie/rhumatologie"),
(25, "Perte d'autonomie, orthopédie/rhumato, neuro"),
(26, "Perte d'autonomie, ortho/rhumato, cardiorespiratoire"),
(27, "Perte d'autonomie, ortho/rhumato"),
(28, "Perte d'autonomie, ortho, cardio, neuro"),
(29, "Perte d'autonomie, neurologie (cas séquélaires et évolutifs)"),
(30, "Perte d'autonomie, neuro et quelques cas ortho"),
(31, "Perte d'autonomie, cardiorespiratoire, palliatif"),
(32, "Perte d'autonomie un peu de neuro et d'ortho"),
(33, "Perte d'autonomie et ortho/rhumato"),
(34, "Perte d'autonomie"),
(35, "Perte autonomie fonctionnelle"),
(36, "Orthopédie/rhumatologie, Perte d'Autonomie"),
(37, "Orthopédie/rhumatologie principalement"),
(38, 'Orthopédie/rhumatologie'),
(39, "Ortho/rhumato et perte d'autonomie"),
(40, "Ortho/rhumato"),
(41, "Neurologie, pédiatrie poss d'ortho/rhumato"),
(42, "Hôpital de jour"),
(43, "Centre de jour, soins de clientèle hébergée"),
(44, "Centre de jour et soins à domicile"),
(45, 'Centre de jour et hôpital de jour'),
(46, "Centre de jour"),
(47, "CDJ et soins clientèle hébergée");

-- --------------------------------------------------------

--
-- Structure de la table `client_type_enterprise`
--

CREATE TABLE IF NOT EXISTS `client_type_enterprise` (
  `id` int(11) NOT NULL,
  `enterprise_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `enterprises`
--

CREATE TABLE IF NOT EXISTS `enterprises` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal_code` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `additional_informations` text COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `enterprises`
--

INSERT INTO `enterprises` (`id`, `user_id`, `name`, `adress`, `city`, `province`, `postal_code`, `region`, `active`, `additional_informations`, `enterprise_type`) VALUES
(1, 1, '2020 Inc', '1700 Boulevard des laurentides', 'Laval', 'Québec', 'H7M 2Y', 'rive nord', 1, 'Type d''établissement: Autre', '');

-- --------------------------------------------------------

--
-- Structure de la table `enterprise_mission`
--

CREATE TABLE IF NOT EXISTS `enterprise_mission` (
  `id` int(11) NOT NULL,
  `enterprise_id` int(11) NOT NULL,
  `mission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `internships`
--

CREATE TABLE IF NOT EXISTS `internships` (
  `id` int(11) NOT NULL,
  `enterprise_id` int(11) NOT NULL,
  `semester` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `available_places` int(11) NOT NULL,
  `work_hours` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `internships`
--

INSERT INTO `internships` (`id`, `enterprise_id`, `semester`, `start_date`, `end_date`, `available_places`, `work_hours`, `title`, `description`) VALUES
(1, 1, 'automne 2018', '2018-09-24', '2018-09-24', 200, '60', 'prog', 'programmer');

-- --------------------------------------------------------

--
-- Structure de la table `mission`
--

CREATE TABLE IF NOT EXISTS `mission` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `mission`
--

INSERT INTO `mission` (`id`, `name`) VALUES
(1, 'UTRF'),
(2, 'Soins de clientèle hébergée et hôpital de jour'),
(3, 'Soins de clientèle hébergée et externe'),
(4, 'Soins de clientèle externe, hospitalisée et hébergée, rééducation et renforcement au travail'),
(5, 'Soins de clientèle externe'),
(6, 'Soins clientèle hospitalisée'),
(7, 'Soins clientèle hébergée, soins de clientèle en convalescence'),
(8, 'Soins clientèle hébergée et hospitalisée'),
(9, 'Soins clientèle hébergée et externe'),
(10, 'Soins clientèle hébergée'),
(11, 'Soins clientèle hébergé et possibilité de Centre de jour'),
(12, 'Soins clientèle externe, rééducation au travail'),
(13, 'Soins clientèle externe et interne'),
(14, 'Soins clientèle externe et hospitalisée'),
(15, 'Soins clientèle externe et hébergée'),
(16, 'Soins clientèle externe et à domicile'),
(17, 'Soins clientèle externe'),
(18, 'Soins clientèle à domicile et en hébergement, Centre de jour'),
(19, 'Soins clientèle à domicile et clientèle externe'),
(20, 'Soins clientèle à domicile'),
(21, 'Recherche clinique'),
(22, "Hôpital de jour"),
(23, "Centre de jour, soins de clientèle hébergée"),
(24, "Centre de jour et soins à domicile"),
(25, 'Centre de jour et hôpital de jour'),
(26, "Centre de jour"),
(27, "CDJ et soins clientèle hébergée");

-- --------------------------------------------------------

--
-- Structure de la table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admission_number` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` char(13) COLLATE utf8_unicode_ci NOT NULL,
  `informations` text COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `students`
--

INSERT INTO `students` (`id`, `user_id`, `admission_number`, `first_name`, `last_name`, `phone_number`, `informations`, `notes`, `active`) VALUES
(18, 40, '123456789', 'Mathieu', 'Ca marche', '450.474.8282.', 'Étudiant qui marche!', '1111111111111', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`) VALUES
(1, 'cynt@bidon.com', '$2y$10$zQ0PIni8iLdkPjP.m8RB6.3w5gRufEMSCkZtszELjCATsiTKSxBJO', 'admin'),
(40, 'camarche@gmail.com', '$2y$10$.m3ZX2uUtm9jQnNeU6h.o.lhzOgmzYn5DqgcjH3fjlVX9z7izpl2m', 'student'),
(41, 'CHSLDMTL@hotmail.com', '$2y$10$e0YwrVYr/1FEUoLtkSWcJedCdKUoA9xGAvUg6OBfDvwZMBymhHALW', 'toBeEnterprise'),
(42, 'clsclaval@gmail.com', '$2y$10$6nrmvT7lB8WD/6Mgr0dLde3lGAayD9Kg2TOIjycA2fokP0BOsujFK', 'toBeEnterprise');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `client_type`
--
ALTER TABLE `client_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client_type_enterprise`
--
ALTER TABLE `client_type_enterprise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enterprise_id` (`enterprise_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Index pour la table `enterprises`
--
ALTER TABLE `enterprises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `enterprise_mission`
--
ALTER TABLE `enterprise_mission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enterprise_id` (`enterprise_id`),
  ADD KEY `mission_id` (`mission_id`);

--
-- Index pour la table `internships`
--
ALTER TABLE `internships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enterprise_id` (`enterprise_id`);

--
-- Index pour la table `mission`
--
ALTER TABLE `mission`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `client_type_enterprise`
--
ALTER TABLE `client_type_enterprise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `enterprises`
--
ALTER TABLE `enterprises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `enterprise_mission`
--
ALTER TABLE `enterprise_mission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `internships`
--
ALTER TABLE `internships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `mission`
--
ALTER TABLE `mission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `client_type_enterprise`
--
ALTER TABLE `client_type_enterprise`
  ADD CONSTRAINT `client_type_enterprise_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_type` (`id`),
  ADD CONSTRAINT `client_type_enterprise_ibfk_2` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprises` (`id`);

--
-- Contraintes pour la table `enterprises`
--
ALTER TABLE `enterprises`
  ADD CONSTRAINT `enterprises_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `enterprise_mission`
--
ALTER TABLE `enterprise_mission`
  ADD CONSTRAINT `enterprise_mission_ibfk_1` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`),
  ADD CONSTRAINT `enterprise_mission_ibfk_2` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprises` (`id`);

--
-- Contraintes pour la table `internships`
--
ALTER TABLE `internships`
  ADD CONSTRAINT `internships_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprises` (`id`);

--
-- Contraintes pour la table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
