-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 11 Octobre 2018 à 19:48
-- Version du serveur :  5.6.37
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Airport`
--

-- --------------------------------------------------------

--
-- Structure de la table `aircrafts`
--

CREATE TABLE IF NOT EXISTS `aircrafts` (
  `id` int(11) NOT NULL,
  `airline_id` int(11) NOT NULL,
  `hangar_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `capacity` int(255) NOT NULL,
  `weight` int(255) NOT NULL,
  `other_detail` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'None',
  `slug` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Les avions';

--
-- Contenu de la table `aircrafts`
--

INSERT INTO `aircrafts` (`id`, `airline_id`, `hangar_id`, `user_id`, `model`, `capacity`, `weight`, `other_detail`, `slug`, `created`, `modified`) VALUES
(1, 1, 2, 2, 'Boeing 737', 100, 85000, 'Bleu', 'boeing-737', '2018-08-31 07:41:37', '2018-10-11 17:55:28'),
(2, 3, 20, 1, 'Airbus A380', 100, 300000, 'Nouvelle avion', 'airbus-a380', '2018-09-01 00:54:45', '2018-10-11 17:55:41'),
(14, 1, 2, 1, 'Nimbus 2000', 666, 666000, 'Tu est un sorcier Harry', 'nimbus-2000', '2018-09-10 00:00:00', '2018-10-11 17:55:57');

-- --------------------------------------------------------

--
-- Structure de la table `airlines`
--

CREATE TABLE IF NOT EXISTS `airlines` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `airline_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `other_detail` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'None',
  `slug` varchar(191) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Les compagnies aériennes';

--
-- Contenu de la table `airlines`
--

INSERT INTO `airlines` (`id`, `user_id`, `airline_name`, `country`, `other_detail`, `slug`, `created`, `modified`) VALUES
(1, 1, 'Japan Airlines', 'Japon', 'Alliance : Oneworld', 'japan-airlines', '2018-08-31 23:21:58', '2018-10-11 18:07:39'),
(2, 1, 'United Airlines', 'États-Unis', 'Alliance : Star Alliance', 'united-airlines', '2018-09-01 00:29:21', '2018-10-11 18:11:41'),
(3, 2, 'American Airlines', 'États-Unis', 'Alliance : Oneworld', 'american-airlines', '2018-09-07 23:29:36', '2018-10-11 18:15:03');

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `airline_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `files`
--

INSERT INTO `files` (`id`, `user_id`, `airline_id`, `name`, `path`, `created`, `modified`, `status`) VALUES
(17, 1, 2, 'e56498bae1.png', 'uploads/files/', '2018-10-10 16:31:24', '2018-10-10 16:31:24', 1),
(19, 4, 1, 'JapanAirlines.png', 'uploads/files/', '2018-10-11 19:09:58', '2018-10-11 19:09:58', 1),
(24, 4, 3, '2000px-American_Airlines_logo_2013.svg.png', 'uploads/files/', '2018-10-11 19:18:45', '2018-10-11 19:18:45', 1);

-- --------------------------------------------------------

--
-- Structure de la table `flight_schedules`
--

CREATE TABLE IF NOT EXISTS `flight_schedules` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `aircraft_id` int(11) NOT NULL,
  `pilot_id` int(11) NOT NULL,
  `flight_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `event_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `departure_time` datetime NOT NULL,
  `arrival_time` datetime NOT NULL,
  `other_detail` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'None',
  `slug` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Les horaires de vol';

--
-- Contenu de la table `flight_schedules`
--

INSERT INTO `flight_schedules` (`id`, `user_id`, `aircraft_id`, `pilot_id`, `flight_name`, `event_type`, `departure_time`, `arrival_time`, `other_detail`, `slug`, `created`, `modified`) VALUES
(3, 1, 1, 1, 'V384', 'Departure', '2018-08-31 04:05:00', '2018-05-05 06:08:00', 'None', 'v384', '2018-09-01 01:16:38', '2018-10-10 16:26:23'),
(4, 2, 1, 3, 'V157', 'Arrival', '2019-02-15 12:00:00', '2019-02-15 15:13:00', 'Pilot switch', 'v157', '2018-09-01 01:18:15', '2018-09-12 02:15:01'),
(5, 1, 14, 1, 'V294', 'Arrival', '2018-09-10 19:13:00', '2018-09-10 19:13:00', 'None', 'v294', '2018-09-10 19:14:07', '2018-10-10 16:39:15'),
(8, 2, 14, 3, 'V420', 'Departure', '2018-10-09 23:42:00', '2018-10-09 23:42:00', 'None', 'v420', '2018-10-09 23:43:01', '2018-10-10 16:39:49');

-- --------------------------------------------------------

--
-- Structure de la table `hangars`
--

CREATE TABLE IF NOT EXISTS `hangars` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hangar_size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `other_detail` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'None',
  `slug` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Les hangars';

--
-- Contenu de la table `hangars`
--

INSERT INTO `hangars` (`id`, `user_id`, `code`, `hangar_size`, `other_detail`, `slug`, `created`, `modified`) VALUES
(1, 2, 'A527G', '120', 'None', 'A527G', '2018-08-31 23:20:12', '2018-10-10 16:34:10'),
(2, 1, 'H5UI2', '100', 'Need repair', 'H5UI2', '2018-09-01 00:41:49', '2018-10-10 16:32:59'),
(20, 2, 'IF987D', '100', 'None', 'IF987D', '2018-09-12 00:58:18', '2018-10-10 16:34:38'),
(23, 1, 'GG666', '90', 'None', 'GG666', '2018-09-12 01:01:15', '2018-10-10 16:34:04');

-- --------------------------------------------------------

--
-- Structure de la table `i18n`
--

CREATE TABLE IF NOT EXISTS `i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `i18n`
--

INSERT INTO `i18n` (`id`, `locale`, `model`, `foreign_key`, `field`, `content`) VALUES
(2, 'en_US', 'Aircrafts', 1, 'other_detail', 'Red'),
(3, 'fr_CA', 'Aircrafts', 2, 'other_detail', 'Nouveau'),
(4, 'fr_CA', 'Aircrafts', 14, 'other_detail', 'Tu est un sorcier Harry'),
(5, 'fr_CA', 'Aircrafts', 1, 'other_detail', 'Rouge'),
(6, 'en_US', 'Aircrafts', 2, 'other_detail', 'New aircraft'),
(7, 'en_US', 'Aircrafts', 14, 'other_detail', 'You are a wizard Harry'),
(8, 'ja_JP', 'Aircrafts', 1, 'other_detail', 'ブルー'),
(9, 'ja_JP', 'Aircrafts', 2, 'other_detail', '新しい飛行機'),
(10, 'ja_JP', 'Aircrafts', 14, 'other_detail', 'あなたはウィザードのハリーです'),
(11, 'en_US', 'Airlines', 1, 'other_detail', 'Group : Oneworld'),
(12, 'en_US', 'Airlines', 2, 'other_detail', 'Group : Star Alliance'),
(13, 'en_US', 'Airlines', 3, 'other_detail', 'Group : Oneworld'),
(14, 'ja_JP', 'Airlines', 1, 'other_detail', '提携 : Oneworld'),
(15, 'ja_JP', 'Airlines', 2, 'other_detail', '提携 : Star Alliance'),
(16, 'ja_JP', 'Airlines', 3, 'other_detail', '提携 : Oneworld'),
(17, 'fr_CA', 'Airlines', 1, 'other_detail', 'Alliance : Oneworld'),
(18, 'fr_CA', 'Airlines', 2, 'other_detail', 'Alliance : Star Alliance'),
(19, 'fr_CA', 'Airlines', 3, 'other_detail', 'Alliance : Oneworld'),
(20, 'fr_CA', 'Airlines', 1, 'country', 'Japon'),
(21, 'ja_JP', 'Airlines', 1, 'country', '日本'),
(22, 'en_US', 'Airlines', 1, 'country', 'Japan'),
(23, 'fr_CA', 'Airlines', 2, 'country', 'États-Unis'),
(24, 'en_US', 'Airlines', 2, 'country', 'United-States'),
(25, 'ja_JP', 'Airlines', 2, 'country', '合衆国'),
(26, 'fr_CA', 'Airlines', 3, 'country', 'États-Unis'),
(29, 'en_US', 'Airlines', 3, 'country', 'United-States'),
(30, 'ja_JP', 'Airlines', 3, 'country', '合衆国');

-- --------------------------------------------------------

--
-- Structure de la table `pilots`
--

CREATE TABLE IF NOT EXISTS `pilots` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `licence_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `other_detail` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'None',
  `slug` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Les pilotes';

--
-- Contenu de la table `pilots`
--

INSERT INTO `pilots` (`id`, `user_id`, `licence_number`, `first_name`, `last_name`, `gender`, `other_detail`, `slug`, `created`, `modified`) VALUES
(1, 1, '1464811', 'Bob', 'Paquet', 'M', 'In holiday in 1 week', 'bob-paquet', '2018-08-31 23:18:44', '2018-10-10 16:40:50'),
(3, 2, '1234567', 'Julie', 'Pommier', 'F', 'None', 'julie-pommier', '2018-09-01 01:15:30', '2018-10-10 16:40:56');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin` tinyint(1) DEFAULT '0',
  `slug` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `uuid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirm` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Les users';

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `admin`, `slug`, `created`, `modified`, `uuid`, `confirm`) VALUES
(1, 'Nicolas', 'nicolas.meunier@hotmail.ca', '$2y$10$l226Tsrp3itE.zJqfmyW5ORxKOWU50NH0zPt.PMvUzAJ34tMeI6ie', 1, 'nicolas-meunier-hotmail-ca', '2018-08-31 23:15:40', '2018-10-10 14:37:20', '9a7b0264-17c3-4b61-bbb6-e5c70d118952', 1),
(2, 'Bob', 'bob@gmail.com', '$2y$10$7xQaCXo.q2kVrNJAEeHDg.8N6oOPKT1fRIlMTvJiRZnWfFe0Vs60.', 0, 'bob-gmail-com', '2018-09-01 00:18:28', '2018-10-10 16:24:27', '549be848-da24-4dc7-9015-1786634b3d1f', 1),
(3, 'Georges', 'Georges@gmail.com', '$2y$10$XtT56QYGccIWkqoHI3IQ4.Qy1edW2vH8KIlXR4ps1XYR1Hp8McR.a', 0, 'georges-gmail-com', '2018-09-04 18:36:01', '2018-10-10 16:25:29', '0363082d-dec2-4f64-97b0-a88fd3bae31a', 1),
(4, 'Admin', 'admin@gmail.com', '$2y$10$LURH0Jsy2dgt4gjMI8hWQ.LjNvWH8oTUSq7XdHbfbj2LZGC4/PpT6', 1, 'admin-gmail-com', '2018-10-10 18:48:29', '2018-10-10 18:48:29', '8151e652-96e7-4c87-8fc1-ef09e328d65b', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `aircrafts`
--
ALTER TABLE `aircrafts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `hangar_key` (`hangar_id`),
  ADD KEY `user_key` (`user_id`),
  ADD KEY `airline_key` (`airline_id`) USING BTREE;

--
-- Index pour la table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_key` (`user_id`);

--
-- Index pour la table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_key` (`user_id`),
  ADD KEY `airline_id_key` (`airline_id`);

--
-- Index pour la table `flight_schedules`
--
ALTER TABLE `flight_schedules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `pilot_key` (`pilot_id`),
  ADD KEY `aircraft_key` (`aircraft_id`),
  ADD KEY `user_key` (`user_id`);

--
-- Index pour la table `hangars`
--
ALTER TABLE `hangars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_key` (`user_id`);

--
-- Index pour la table `i18n`
--
ALTER TABLE `i18n`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `I18N_LOCALE_FIELD` (`locale`,`model`,`foreign_key`,`field`),
  ADD KEY `I18N_FIELD` (`model`,`foreign_key`,`field`);

--
-- Index pour la table `pilots`
--
ALTER TABLE `pilots`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_key` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `aircrafts`
--
ALTER TABLE `aircrafts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `airlines`
--
ALTER TABLE `airlines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `flight_schedules`
--
ALTER TABLE `flight_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `hangars`
--
ALTER TABLE `hangars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `i18n`
--
ALTER TABLE `i18n`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT pour la table `pilots`
--
ALTER TABLE `pilots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `aircrafts`
--
ALTER TABLE `aircrafts`
  ADD CONSTRAINT `airline_key` FOREIGN KEY (`airline_id`) REFERENCES `airlines` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `hangar_key` FOREIGN KEY (`hangar_id`) REFERENCES `hangars` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `airlines`
--
ALTER TABLE `airlines`
  ADD CONSTRAINT `user_key2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `user_id_key9` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `flight_schedules`
--
ALTER TABLE `flight_schedules`
  ADD CONSTRAINT `aircraft_key` FOREIGN KEY (`aircraft_id`) REFERENCES `aircrafts` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pilot_key` FOREIGN KEY (`pilot_id`) REFERENCES `pilots` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_key3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `hangars`
--
ALTER TABLE `hangars`
  ADD CONSTRAINT `user_key4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `pilots`
--
ALTER TABLE `pilots`
  ADD CONSTRAINT `user_key5` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
