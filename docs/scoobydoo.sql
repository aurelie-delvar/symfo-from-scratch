-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `amis`;
CREATE TABLE `amis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `amis` (`id`, `name`) VALUES
(7,	'Scooby'),
(8,	'Sammy'),
(9,	'Fred'),
(10,	'Daphne'),
(11,	'Vera'),
(12,	'Scrappy');

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230315160919',	'2023-03-15 17:09:32',	147),
('DoctrineMigrations\\Version20230316094443',	'2023-03-16 10:44:59',	132),
('DoctrineMigrations\\Version20230317125620',	'2023-03-17 13:56:28',	66),
('DoctrineMigrations\\Version20230319213210',	'2023-03-19 22:32:19',	134),
('DoctrineMigrations\\Version20230410154952',	'2023-04-10 17:51:02',	125);

DROP TABLE IF EXISTS `monstres`;
CREATE TABLE `monstres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `episode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `monstres` (`id`, `name`, `episode`, `image`) VALUES
(5,	'Le spectre du chevalier noir',	'Saison 1 épisode 1 de \"Scooby-Doo, où es-tu ?\"',	'chevalier.jpeg'),
(6,	'Le fantôme du capitaine Cutler',	'Saison 1 épisode 2 de \"Scooby-Doo, où es-tu ?\"',	'cutler.jpeg'),
(7,	'Le gorille de la montagne interdite',	'Saison 1 épisode 7 de \"Scooby-Doo, où es-tu ?\"',	'apeman.jpeg'),
(8,	'Le fantôme de Merlin',	'Saison 1 épisode 6 du \"Scooby-Doo show\"',	'merlin.jpeg');

DROP TABLE IF EXISTS `personnages`;
CREATE TABLE `personnages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surnom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id_id` int(11) NOT NULL,
  `amibff_id` int(11) DEFAULT NULL,
  `phrase` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_286738A6714819A0` (`type_id_id`),
  KEY `IDX_286738A62CD2A554` (`amibff_id`),
  FULLTEXT KEY `IDX_286738A66C6E55B5A625945B5F5F55C3` (`nom`,`prenom`,`surnom`),
  CONSTRAINT `FK_286738A62CD2A554` FOREIGN KEY (`amibff_id`) REFERENCES `amis` (`id`),
  CONSTRAINT `FK_286738A6714819A0` FOREIGN KEY (`type_id_id`) REFERENCES `type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `personnages` (`id`, `nom`, `prenom`, `surnom`, `image`, `type_id_id`, `amibff_id`, `phrase`) VALUES
(12,	'Doo',	'Scooby',	'Scoob',	'scooby.jpeg',	6,	8,	'\"Scooby Doo-bi-doo !!\"'),
(13,	'Rogers',	'Sammy',	'Sammy',	'sammy.jpeg',	7,	7,	'\"Mordicus !\"'),
(14,	'Jones',	'Fred',	'Freddy',	'fred.jpeg',	7,	10,	'\"J\'ai un plan !\"'),
(15,	'Blake',	'Daphne',	'Daph',	'daphne.jpeg',	7,	9,	'\"Jeepers !\"'),
(16,	'Dinkley',	'Vera',	'Vera',	'vera.jpeg',	7,	12,	'\"ça alors !\"'),
(17,	'Doo',	'Scrappy',	'Scrappy Doo-bi doo',	'scrappy.jpeg',	6,	11,	'\"La victoire aux bébés chiens !\"');

DROP TABLE IF EXISTS `personnages_qualidad`;
CREATE TABLE `personnages_qualidad` (
  `personnages_id` int(11) NOT NULL,
  `qualidad_id` int(11) NOT NULL,
  PRIMARY KEY (`personnages_id`,`qualidad_id`),
  KEY `IDX_5193D0747FFDACCA` (`personnages_id`),
  KEY `IDX_5193D0748C4A34E1` (`qualidad_id`),
  CONSTRAINT `FK_5193D0747FFDACCA` FOREIGN KEY (`personnages_id`) REFERENCES `personnages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_5193D0748C4A34E1` FOREIGN KEY (`qualidad_id`) REFERENCES `qualidad` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `qualidad`;
CREATE TABLE `qualidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adjectif` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `qualidad` (`id`, `adjectif`) VALUES
(11,	'courageux'),
(12,	'gourmand'),
(13,	'Froussard'),
(14,	'Gentil');

DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `type` (`id`, `name`) VALUES
(6,	'Chien'),
(7,	'Humain'),
(8,	'Vilain'),
(9,	'Fantome');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(3,	'user@user.com',	'[\"ROLE_USER\"]',	'$2y$13$R8eYWhIrpMWhlVIda/XfHuGrJnZa3PEnG7h207qKbrN1m5ye0nYqm'),
(4,	'admin@admin.com',	'[\"ROLE_ADMIN\"]',	'$2y$13$Yee0OXqWlhV.JQWbnR8qIuOpfEJuDWg3J7UeAKbaTnvYsFiBrfd5W'),
(5,	'manager@manager.com',	'[\"ROLE_MANAGER\"]',	'$2y$13$NG84G0SaExeONz9yXoMvGuKQJnCiE5g.4uHgcjmT6AOxP7EGl0BAW'),
(7,	'paul@p.p',	'[\"ROLE_MANAGER\"]',	'$2y$13$j1BLTJ347q5eLtGysqDazuAb3waCuVVqKuGADtBhn1dfrwoFDtk12');

-- 2023-05-10 18:29:28
