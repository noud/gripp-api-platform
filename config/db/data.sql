-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jun 08, 2019 at 10:47 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gripp`
--

--
-- Dumping data for table `taaktype`
--

INSERT INTO `taaktype` (`id`, `searchname`, `name`, `color`, `extendedproperties`, `createdAt`, `updatedAt`) VALUES
(1, 'software development', 'software development', '#15ec40', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00'),
(2, 'design', 'design', '#fa0b04', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00');
COMMIT;

--
-- Dumping data for table `taaktype`
--

INSERT INTO `tag` (`searchname`, `name`, `extendedproperties`, `createdAt`, `updatedAt`) VALUES
('api', 'api', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00'),
('json-rpc', 'json-rpc', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00'),
('php', 'php', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00'),
('php56', 'php56', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00'),
('php7', 'PHP7', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00'),
('php71', 'php71', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00'),
('php72', 'php72', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00'),
('curlphp', 'curlphp', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00'),
('symfony', 'symfony', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00');
COMMIT;
		
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
