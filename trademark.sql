-- Adminer 4.8.1 MySQL 8.0.32 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `trademark`;
CREATE TABLE `trademark` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `trademark` (`id`, `name`) VALUES
(1,	'Carraa'),
(2,	'Keller'),
(3,	'Nike'),
(4,	'Harrows'),
(5,	'001Značka'),
(6,	'002Značka'),
(7,	'Značka008'),
(8,	'Značka14'),
(9,	'Sportisimo'),
(10,	'008Značka'),
(11,	'Značka19'),
(12,	'Sportisimo002'),
(13,	'004Sportisimo'),
(14,	'Sportisimo00777'),
(15,	'Nike002'),
(16,	'Nike14'),
(17,	'Nike15'),
(18,	'Značka444'),
(19,	'005Značka');

-- 2023-07-14 14:06:51
