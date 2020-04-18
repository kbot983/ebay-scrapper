-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;
CREATE DATABASE scraping;
USE scraping;
DROP TABLE IF EXISTS `prod_info`;
CREATE TABLE `prod_info` (
  `prod_id` int NOT NULL AUTO_INCREMENT,
  `prod_title` varchar(255) DEFAULT NULL,
  `prod_price` varchar(255) DEFAULT NULL,
  `prod_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`prod_id`),
  UNIQUE KEY `prod_id` (`prod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `prod_relation`;
CREATE TABLE `prod_relation` (
  `prod_owner` int NOT NULL,
  `prod` int NOT NULL,
  KEY `prod_owner` (`prod_owner`),
  KEY `prod` (`prod`),
  CONSTRAINT `prod_relation_ibfk_4` FOREIGN KEY (`prod_owner`) REFERENCES `user_info` (`id`),
  CONSTRAINT `prod_relation_ibfk_5` FOREIGN KEY (`prod`) REFERENCES `prod_info` (`prod_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gender` enum('m','f','o') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `user_info` (`id`, `email`, `name`, `password`, `gender`) VALUES
(100,	'kb529@njit.edu',	'Karan',	'',	'm');

-- 2020-04-12 22:55:17
ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'it635';
CREATE USER 'steve'@'%' IDENTIFIED BY 'it635';
GRANT SELECT ON scraping.prod_info TO 'steve'@'%';
GRANT INSERT ON scraping.prod_info TO 'steve'@'%';
FLUSH PRIVILEGES;