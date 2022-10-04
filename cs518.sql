-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2022 at 03:23 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Database: `cs518`
--
CREATE DATABASE IF NOT EXISTS `cs518` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cs518`;
-- --------------------------------------------------------
--
-- Table structure for table `users`
--
CREATE TABLE IF NOT EXISTS `users` (
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `verified_email` smallint(6) NOT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `users`
--
INSERT INTO `users` (
    `first_name`,
    `last_name`,
    `email_id`,
    `password`,
    `verified_email`
  )
VALUES (
    'Amar',
    'Vootla',
    'amarnathvootla@gmail.com',
    '$2y$10$8Sdu.BNCpm2xSg5NwOlNHugURlemP8P81UXsgVTqz/rKM2B/.evsW',
    9101
  ),
  (
    'Mounika',
    'Surabi',
    'mounikasurabi@gmail.com',
    '$2y$10$w8F8ifrvfzBfSHTOAc5PT.q8TOrhpZoutBp28Hs2r86Q7/QAjpPJa',
    8671
  ),
  (
    'Shivani',
    'Bima',
    'shiivani93.sr@gmail.com',
    '$2y$10$EJiaboJxKaKG.P4x7mp6keG8ndfWDEpDnLwJlaNd6gXUn4OBoyHeK',
    4362
  ),
  (
    'Sruthi',
    'Ghanapuram',
    'sruthighanapuram@gmail.com',
    '$2y$10$ObvEZ66UWihaLqE3aNR4t.2CMKz0beYZPmaHG1.fG6t5Bikv3RXXu',
    5955
  ),
  (
    'Vinay',
    'Surabi',
    'surabisrivinayreddy@gmail.com',
    '$2y$10$gao0N2WsmssChaFtGV2I4Ox6/4MEx7875s8kZ.sznkpXURJiT9Fze',
    1
  ),
  (
    'Vinay',
    'Surabi',
    'vinaysurabitest@gmail.com',
    '$2y$10$zCg3YxnqxO3tVQQ7stH.oevBr6GF1kurcwk1UQQOOZDFzdyxdl2Ae',
    1
  );
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;