-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jun 10, 2019 at 10:39 PM
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
-- Dumping data for table `medewerker`
--

INSERT INTO `medewerker` (`id`, `searchname`, `userphoto`, `title`, `screenname`, `number`, `dateofbirth`, `socialsecuritynumber`, `emailprivate`, `bankaccount`, `bankcity`, `bankascription`, `notes`, `employeesince`, `username`, `password`, `active`, `role`, `email`, `phone`, `mobile`, `street`, `adresline2`, `streetnumber`, `zipcode`, `city`, `country`, `function`, `salutation`, `initials`, `firstname`, `infix`, `lastname`, `extendedproperties`, `tags`, `skills`, `createdAt`, `updatedAt`, `roles`) VALUES
(2, 'demo medewerker', NULL, '', 'demo', NULL, '2019-06-10', NULL, '', '', NULL, NULL, NULL, NULL, 'demo', '$2y$12$SJ8kQD5w/byRp7q9pyQk6u100cGWv/j0co1kiMjPI3zyElPca2qWa', 1, 1, '', NULL, '06 1234 5678', 'Demostraat', NULL, '7', '1234AB', 'Demostad', 'Nederland', NULL, 'SIRMADAM', 'A.B.', 'Demovoornaam', '', 'Demoachternaam', NULL, NULL, NULL, '2019-06-10 00:00:00', '2019-06-10 00:00:00', '[\"ROLE_USER\"]'),
(3, 'no demo medewerker', NULL, '', 'nodemo', NULL, '2019-06-10', NULL, '', '', NULL, NULL, NULL, NULL, 'nodemo', '$2y$12$ZWL0bEscB.Zn3JPTpR0Ei.Do5n3WrpmgzkyCy3Tm8xgT2rz8BClzq', 0, 1, '', NULL, '06 1234 5679', 'Demostraat', NULL, '8', '1234AB', 'Demostad', 'Nederland', NULL, 'SIRMADAM', 'C.D.', 'Nodemovoornaam', '', 'Nodemoachternaam', NULL, NULL, NULL, '2019-06-10 00:00:00', '2019-06-10 00:00:00', '[\"ROLE_USER\"]');

--
-- Dumping data for table `taaktype`
--

INSERT INTO `taaktype` (`id`, `searchname`, `name`, `color`, `extendedproperties`, `createdAt`, `updatedAt`) VALUES
(1, 'software development', 'software development', '#15ec40', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00'),
(2, 'design', 'design', '#fa0b04', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00');

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `searchname`, `name`, `extendedproperties`, `createdAt`, `updatedAt`) VALUES
(1, 'api', 'api', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00'),
(2, 'json-rpc', 'json-rpc', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00'),
(3, 'php', 'php', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00'),
(4, 'php56', 'php56', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00'),
(5, 'php7', 'PHP7', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00'),
(6, 'php71', 'php71', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00'),
(7, 'php72', 'php72', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00'),
(8, 'curlphp', 'curlphp', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00'),
(9, 'symfony', 'symfony', NULL, '2019-06-08 00:00:00', '2019-06-08 00:00:00'),
(10, 'javascript', 'javascript', NULL, '2019-06-10 00:00:00', '2019-06-10 00:00:00'),
(11, 'jquery', 'jquery', NULL, '2019-06-10 00:00:00', '2019-06-10 00:00:00'),
(12, 'bootstrap', 'bootstrap', NULL, '2019-06-10 00:00:00', '2019-06-10 00:00:00'),
(13, 'bootstrap4', 'bootstrap4', NULL, '2019-06-10 00:00:00', '2019-06-10 00:00:00'),
(14, 'css', 'css', NULL, '2019-06-10 00:00:00', '2019-06-10 00:00:00'),
(15, 'css3', 'css3', NULL, '2019-06-10 00:00:00', '2019-06-10 00:00:00'),
(16, 'composer', 'composer', NULL, '2019-06-10 00:00:00', '2019-06-10 00:00:00'),
(17, 'npm', 'npm', NULL, '2019-06-10 00:00:00', '2019-06-10 00:00:00'),
(18, 'bash', 'composer', NULL, '2019-06-10 00:00:00', '2019-06-10 00:00:00'),
(19, 'docker', '', NULL, '2019-06-10 00:00:00', '2019-06-10 00:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
