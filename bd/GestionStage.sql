-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 22 Octobre 2018 à 14:43
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
-- Structure de la table `candidacies`
--

CREATE TABLE IF NOT EXISTS `candidacies` (
  `internship_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Structure de la table `client_types`
--

CREATE TABLE IF NOT EXISTS `client_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `client_types`
--

INSERT INTO `client_types` (`id`, `name`) VALUES
(17, 'CDJ et soins clientèle hébergée'),
(18, 'Centre de jour'),
(19, 'Centre de jour et hôpital de jour'),
(20, 'Centre de jour et soins à domicile'),
(21, 'Centre de jour, soins de clientèle hébergée'),
(22, 'Hôpital de jour'),
(23, 'Neurologie, pédiatrie poss d''ortho/rhumato'),
(24, 'Ortho/rhumato'),
(25, 'Ortho/rhumato et perte d''autonomie'),
(26, 'Orthopédie/rhumatologie'),
(27, 'Orthopédie/rhumatologie principalement'),
(28, 'Orthopédie/rhumatologie, Perte d''autonomie'),
(29, 'Perte autonomie fonctionnelle'),
(30, 'Perte d''autonomie'),
(31, 'Perte d''autonomie et ortho/rhumato'),
(32, 'Perte d''autonomie un peu de neuro et d''ortho'),
(33, 'Perte d''autonomie, cardiorespiratoire, palliatif'),
(34, 'Perte d''autonomie, neuro et quelques cas ortho'),
(35, 'Perte d''autonomie, neurologie (cas séquélaires et évolutifs)'),
(36, 'Perte d''autonomie, ortho, cardio, neuro'),
(37, 'Perte d''autonomie, ortho/rhumato'),
(38, 'Perte d''autonomie, ortho/rhumato, cardiorespiratoire'),
(39, 'Perte d''autonomie, ortopédie/rhumato, neuro'),
(40, 'Perte d''autonomie, Orthopédie/rhumatologie'),
(41, 'Perte d''autonomie, orthopédie/rhumatologie,neuro'),
(42, 'Perte d''autonomie, orthopédie/rhumatologie, neuro, cardiorespiratoire'),
(43, 'Principalement ortho/rhumato, un eu de perte d''autonomie'),
(44, 'Soins clientèle à domicile'),
(45, 'Soins clientèle à domicile et clientèle externe'),
(46, 'Soins clientèle à domicile et en hébergement, Centre de jour'),
(47, 'Soins clientèle externe'),
(48, 'Soins clientèle externe et à domicile'),
(49, 'Soins clientèle externe et hébergée'),
(50, 'Soins clientèle externe et hospitalisée'),
(51, 'Soins clientèle externe et interne'),
(52, 'Soins clientèle externe, rééducation au trvail'),
(53, 'Soins clientèle hébergé et possibilité de Centre de jour'),
(54, 'Soins clientèle hébergée et externe'),
(55, 'Soins clientèle hébergée et hospitalisée'),
(56, 'Soins clientèle hébergée, soins de clientèle en convalescence'),
(57, 'Soins clientèle hospitalisée'),
(58, 'Soins de clientèle externe'),
(59, 'Soins de clientèle externe, hospitalisée et hébergée, rééducation et renforcement au travail'),
(60, 'Soins de clientèle hébergée et externe'),
(61, 'Soins de clientèle hébergée et hôpital de jour'),
(62, 'UTRF');

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
-- Structure de la table `enterprises_client_types`
--

CREATE TABLE IF NOT EXISTS `enterprises_client_types` (
  `enterprise_id` int(11) NOT NULL,
  `client_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `enterprises_missions`
--

CREATE TABLE IF NOT EXISTS `enterprises_missions` (
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
-- Structure de la table `missions`
--

CREATE TABLE IF NOT EXISTS `missions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `missions`
--

INSERT INTO `missions` (`id`, `name`) VALUES
(1, 'CDJ et soins clientèle hébergée'),
(2, 'Centre de jour'),
(3, 'Centre de jour et hôpital de jour'),
(4, 'Centre de jour et soins à domicile'),
(5, 'Centre de jour, soins de clientèle hébergée'),
(6, 'Hôpital de jour'),
(7, 'Recherche clinique'),
(8, 'Soins clientèle à domicile'),
(9, 'Soins clientèle à domicile et clientèle externe'),
(10, 'Soins clientèle à domicile et en hébergement, Centre de jour'),
(11, 'Soins clientèle externe'),
(12, 'Soins clientèle externe et à domicile'),
(13, 'Soins clientèle externe et hébergée'),
(14, 'Soins clientèle externe et hospitalisée'),
(15, 'Soins clientèle externe et interne'),
(16, 'Soins clientèle externe, rééducation au travail'),
(21, 'Soins clientèle hébergé et possibilité de Centre de jour'),
(22, 'Soins clientèle hébergée'),
(23, 'Soins clientèle hébergée et externe'),
(24, 'Soins clientèle hébergée et hospitalisée'),
(25, 'Soins clientèle hébergée, soins de clientèle en convalescence'),
(26, 'Soins clientèle hospitalisée'),
(27, 'Soins de clientèle externe'),
(28, 'Soins de clientèle externe, hospitalisée et hébergée, rééducation et renforcement au travail'),
(29, 'Soins de clientèle hébergée et externe'),
(30, 'Soins de clientèle hébergée et hôpital de jour'),
(31, 'UTRF');

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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`) VALUES
(1, 'cynt@bidon.com', '$2y$10$zQ0PIni8iLdkPjP.m8RB6.3w5gRufEMSCkZtszELjCATsiTKSxBJO', 'admin'),
(40, 'camarche@gmail.com', '$2y$10$.m3ZX2uUtm9jQnNeU6h.o.lhzOgmzYn5DqgcjH3fjlVX9z7izpl2m', 'student'),
(41, 'CHSLDMTL@hotmail.com', '$2y$10$e0YwrVYr/1FEUoLtkSWcJedCdKUoA9xGAvUg6OBfDvwZMBymhHALW', 'toBeEnterprise'),
(42, 'clsclaval@gmail.com', '$2y$10$6nrmvT7lB8WD/6Mgr0dLde3lGAayD9Kg2TOIjycA2fokP0BOsujFK', 'toBeEnterprise'),
(43, '4040design@gmail.com', '$2y$10$8S8tpDf/xfqGuhxh.d7gDeE5vFLVsomZO/GYxcLaNHX.ZbjaThi7a', 'toBeEnterprise');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `candidacies`
--
ALTER TABLE `candidacies`
  ADD PRIMARY KEY (`internship_id`,`student_id`),
  ADD KEY `student_key` (`student_id`);

--
-- Index pour la table `client_types`
--
ALTER TABLE `client_types`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `enterprises`
--
ALTER TABLE `enterprises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `enterprises_client_types`
--
ALTER TABLE `enterprises_client_types`
  ADD PRIMARY KEY (`enterprise_id`,`client_type_id`),
  ADD KEY `client_type_key` (`client_type_id`);

--
-- Index pour la table `enterprises_missions`
--
ALTER TABLE `enterprises_missions`
  ADD PRIMARY KEY (`enterprise_id`,`mission_id`),
  ADD KEY `mission_key` (`mission_id`);

--
-- Index pour la table `internships`
--
ALTER TABLE `internships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enterprise_id` (`enterprise_id`);

--
-- Index pour la table `missions`
--
ALTER TABLE `missions`
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
-- AUTO_INCREMENT pour la table `enterprises`
--
ALTER TABLE `enterprises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `internships`
--
ALTER TABLE `internships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `missions`
--
ALTER TABLE `missions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `candidacies`
--
ALTER TABLE `candidacies`
  ADD CONSTRAINT `candidacies_ibfk_1` FOREIGN KEY (`internship_id`) REFERENCES `internships` (`id`),
  ADD CONSTRAINT `candidacies_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Contraintes pour la table `enterprises`
--
ALTER TABLE `enterprises`
  ADD CONSTRAINT `enterprises_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `enterprises_client_types`
--
ALTER TABLE `enterprises_client_types`
  ADD CONSTRAINT `enterprises_client_types_ibfk_1` FOREIGN KEY (`client_type_id`) REFERENCES `client_types` (`id`),
  ADD CONSTRAINT `enterprises_client_types_ibfk_2` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprises` (`id`);

--
-- Contraintes pour la table `enterprises_missions`
--
ALTER TABLE `enterprises_missions`
  ADD CONSTRAINT `enterprises_missions_ibfk_1` FOREIGN KEY (`mission_id`) REFERENCES `missions` (`id`),
  ADD CONSTRAINT `enterprises_missions_ibfk_2` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprises` (`id`);

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
