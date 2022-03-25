-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 25, 2022 at 12:09 AM
-- Server version: 8.0.21
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taller_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `disciplinas`
--

DROP TABLE IF EXISTS `disciplinas`;
CREATE TABLE IF NOT EXISTS `disciplinas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `disciplinas`
--

INSERT INTO `disciplinas` (`id`, `descripcion`) VALUES
(2, 'Test 1'),
(3, 'Test 3'),
(4, 'Test edited'),
(5, 'Football');

-- --------------------------------------------------------

--
-- Table structure for table `eventos`
--

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `id_disciplinas` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Eventos_Disciplinas1_idx` (`id_disciplinas`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `eventos`
--

INSERT INTO `eventos` (`id`, `descripcion`, `id_disciplinas`) VALUES
(3, 'Test update', 2);

-- --------------------------------------------------------

--
-- Table structure for table `participantes`
--

DROP TABLE IF EXISTS `participantes`;
CREATE TABLE IF NOT EXISTS `participantes` (
  `id` int NOT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `apellido` varchar(45) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `edad` int NOT NULL,
  `peso` double NOT NULL,
  `estatura` double NOT NULL,
  `id_disciplinas` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Participantes_Disciplinas_idx` (`id_disciplinas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `participantes`
--

INSERT INTO `participantes` (`id`, `nombre`, `apellido`, `edad`, `peso`, `estatura`, `id_disciplinas`) VALUES
(13, 'Test Update', 'Test Update', 25, 22, 33, 2),
(90, 'Carlitos', 'Perez', 1231, 222, 333, 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `fk_Eventos_Disciplinas1` FOREIGN KEY (`id_disciplinas`) REFERENCES `disciplinas` (`id`);

--
-- Constraints for table `participantes`
--
ALTER TABLE `participantes`
  ADD CONSTRAINT `fk_Participantes_Disciplinas` FOREIGN KEY (`id_disciplinas`) REFERENCES `disciplinas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
