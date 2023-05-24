-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.6.12-MariaDB-0ubuntu0.22.04.1 - Ubuntu 22.04
-- Операционная система:         debian-linux-gnu
-- HeidiSQL Версия:              12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Дамп структуры базы данных Test
CREATE DATABASE IF NOT EXISTS `Test` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `Test`;

-- Дамп структуры для таблица Test.items
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` char(255) NOT NULL DEFAULT '',
  `phone` char(15) NOT NULL DEFAULT '',
  `key` char(25) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Дамп данных таблицы Test.items: ~4 rows (приблизительно)
INSERT INTO `items` (`id`, `name`, `phone`, `key`, `created_at`, `updated_at`) VALUES
	(7, 'neden ilya', '+375(29)3123485', '1782332', '2023-05-23 13:00:12', '2023-05-24 08:56:53'),
	(23, 'Ilya', '+375(29)4343434', '378910751', '2023-05-24 08:51:01', '2023-05-24 09:10:00'),
	(24, 'jtydhtyh', '+375(33)3255325', '947937504', '2023-05-24 09:09:27', NULL),
	(25, 'Ilya Neden', '+375(33)3255325', '1096285258', '2023-05-24 09:09:43', NULL);

-- Дамп структуры для таблица Test.token_list
CREATE TABLE IF NOT EXISTS `token_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `token` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Дамп данных таблицы Test.token_list: ~1 rows (приблизительно)
INSERT INTO `token_list` (`id`, `token`) VALUES
	(1, '7f03972abba0972f81a203321fa4a7ba');

-- Дамп структуры для таблица Test.update_history
CREATE TABLE IF NOT EXISTS `update_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Дамп данных таблицы Test.update_history: ~7 rows (приблизительно)
INSERT INTO `update_history` (`id`, `item_id`, `updated_at`) VALUES
	(1, 7, '2023-05-24 00:09:40'),
	(5, 7, '2023-05-24 08:56:53'),
	(6, 7, '2023-05-24 08:57:03'),
	(7, 23, '2023-05-24 09:10:00');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
