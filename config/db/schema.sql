-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jun 08, 2019 at 10:42 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `alerttrigger`
--

CREATE TABLE `alerttrigger` (
  `id` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bedrijf`
--

CREATE TABLE `bedrijf` (
  `id` int(11) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `identity` bigint(20) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `invoicesendto` enum('VISITINGADDRESS','POSTADDRESS','OTHER') DEFAULT NULL,
  `invoiceaddress_companyname` varchar(255) DEFAULT NULL,
  `invoiceaddress_attn` varchar(255) DEFAULT NULL,
  `invoiceaddress_street` varchar(255) DEFAULT NULL,
  `invoiceaddress_streetnumber` varchar(255) DEFAULT NULL,
  `invoiceaddress_addressline2` varchar(255) DEFAULT NULL,
  `invoiceaddress_zipcode` varchar(255) DEFAULT NULL,
  `invoiceaddress_city` varchar(255) DEFAULT NULL,
  `invoiceaddress_country` varchar(255) DEFAULT NULL,
  `customernumber` bigint(20) DEFAULT NULL,
  `bankaccount` varchar(255) DEFAULT NULL,
  `bankascription` varchar(255) DEFAULT NULL,
  `bankcity` varchar(255) DEFAULT NULL,
  `bic` varchar(255) DEFAULT NULL,
  `externalreference` varchar(255) DEFAULT NULL,
  `additionaltermofpayment` bigint(20) DEFAULT NULL,
  `termofpayment` bigint(20) DEFAULT NULL,
  `termofpayment_purchaseinvoice` bigint(20) DEFAULT NULL,
  `invoicesendby` enum('POST','EMAIL') DEFAULT NULL,
  `invoiceemail` varchar(255) DEFAULT NULL,
  `vatnumber` varchar(255) DEFAULT NULL,
  `vatshifted` tinyint(1) DEFAULT NULL,
  `vat` bigint(20) DEFAULT NULL,
  `cocnumber` varchar(255) DEFAULT NULL,
  `foundationdate` date DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `postaddress` enum('VISITINGADDRESS','OTHER') DEFAULT NULL,
  `postaddress_street` varchar(255) DEFAULT NULL,
  `postaddress_streetnumber` varchar(255) DEFAULT NULL,
  `postaddress_addressline2` varchar(255) DEFAULT NULL,
  `postaddress_zipcode` varchar(255) DEFAULT NULL,
  `postaddress_city` varchar(255) DEFAULT NULL,
  `postaddress_country` varchar(255) DEFAULT NULL,
  `visitingaddress_street` varchar(255) DEFAULT NULL,
  `visitingaddress_addressline2` varchar(255) DEFAULT NULL,
  `visitingaddress_streetnumber` varchar(255) DEFAULT NULL,
  `visitingaddress_zipcode` varchar(255) DEFAULT NULL,
  `visitingaddress_city` varchar(255) DEFAULT NULL,
  `visitingaddress_country` varchar(255) DEFAULT NULL,
  `visitingaddress_lng` varchar(255) DEFAULT NULL,
  `visitingaddress_lat` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `relationtype` enum('COMPANY','PRIVATEPERSON') NOT NULL,
  `accountmanager` bigint(20) DEFAULT NULL,
  `companyname` varchar(255) DEFAULT NULL,
  `salutation` enum('SIR','MADAM','SIRMADAM') DEFAULT NULL,
  `initials` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `infix` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `screenname` varchar(255) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `paymentmethod` enum('MANUALTRANSFER','AUTOMATICTRANSFER') DEFAULT NULL,
  `paymentmethod_purchaseinvoice` enum('MANUALTRANSFER','AUTOMATICTRANSFER') DEFAULT NULL,
  `tags` bigint(20) DEFAULT NULL,
  `companyroles` enum('LEAD','CUSTOMER','SUPPLIER','PROSPECT') DEFAULT NULL,
  `files` bigint(20) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `betaling`
--

CREATE TABLE `betaling` (
  `id` int(11) NOT NULL,
  `_ordering` bigint(20) DEFAULT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `invoice` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `amount` float NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contactpersoon`
--

CREATE TABLE `contactpersoon` (
  `id` int(11) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `showoncompanycard` tinyint(1) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `function` varchar(255) DEFAULT NULL,
  `company` bigint(20) NOT NULL,
  `salutation` enum('SIR','MADAM','SIRMADAM') DEFAULT NULL,
  `initials` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `infix` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `tags` bigint(20) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `id` int(11) NOT NULL,
  `templateset` bigint(20) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `date_original` date DEFAULT NULL,
  `expirydate` date DEFAULT NULL,
  `number` bigint(20) DEFAULT NULL,
  `status` enum('ACTIVE','ENDING','ENDED') DEFAULT NULL,
  `company` bigint(20) NOT NULL,
  `contact` bigint(20) DEFAULT NULL,
  `identity` bigint(20) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `frequency` enum('EVERYMONTH','EVERYQUARTER','EVERY6MONTHS','EVERYYEAR','EVERY18MONTHS','EVERYTWOYEARS','EVERYWEEK','EVERYTWOWEEKS','EVERYTHREEYEARS','EVERYFOURYEARS','EVERYFIVEYEARS') NOT NULL,
  `sendmaxtimescheckbox` tinyint(1) DEFAULT NULL,
  `sendmaxtimes` bigint(20) DEFAULT NULL,
  `extendautomatically` tinyint(1) DEFAULT NULL,
  `extendperiod` bigint(20) DEFAULT NULL,
  `paymentmethod` enum('MANUALTRANSFER','AUTOMATICTRANSFER') NOT NULL,
  `clientreference` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `isbasis` tinyint(1) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `tags` bigint(20) DEFAULT NULL,
  `employees` bigint(20) DEFAULT NULL,
  `employees_starred` bigint(20) DEFAULT NULL,
  `files` bigint(20) DEFAULT NULL,
  `contractlines` bigint(20) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contractregel`
--

CREATE TABLE `contractregel` (
  `id` int(11) NOT NULL,
  `_ordering` bigint(20) DEFAULT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `contract` bigint(20) NOT NULL,
  `product` bigint(20) NOT NULL,
  `convertto` enum('PROJECTORINVOICE','CONTRACTFORNEWINVOICE','CONTRACTFORNEWINVOICEONCE','CONTRACTFORNEWPROJECT','CONTRACTFORNEWPROJECTONCE','CONTRACTFORUPDATEPROJECT') DEFAULT NULL,
  `groupcategory` bigint(20) DEFAULT NULL,
  `amount` float NOT NULL,
  `unit` bigint(20) DEFAULT NULL,
  `sellingprice` float NOT NULL,
  `discount` float NOT NULL,
  `buyingprice` float NOT NULL,
  `additionalsubject` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `vat` bigint(20) NOT NULL,
  `rowtype` enum('NORMAL','GROUP') DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `factuur`
--

CREATE TABLE `factuur` (
  `id` int(11) NOT NULL,
  `templateset` bigint(20) NOT NULL,
  `validfor` bigint(20) DEFAULT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `status` enum('CONCEPT','SENT') NOT NULL,
  `number` bigint(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `reportdate` date DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `totalpayed` float DEFAULT NULL,
  `paymentmethod` enum('MANUALTRANSFER','AUTOMATICTRANSFER') NOT NULL,
  `company` bigint(20) NOT NULL,
  `contact` bigint(20) DEFAULT NULL,
  `identity` bigint(20) DEFAULT NULL,
  `clientreference` varchar(255) DEFAULT NULL,
  `addhoursspecification` tinyint(1) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `isbasis` tinyint(1) DEFAULT NULL,
  `expirydate` date DEFAULT NULL,
  `totalincldiscountexclvat` float DEFAULT NULL,
  `totalopeninclvat` float DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `tags` bigint(20) DEFAULT NULL,
  `files` bigint(20) DEFAULT NULL,
  `totalbuyingincldiscountexclvat` float DEFAULT NULL,
  `invoicelines` bigint(20) DEFAULT NULL,
  `payments` bigint(20) DEFAULT NULL,
  `totalinclvat` float DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `factuurregel`
--

CREATE TABLE `factuurregel` (
  `id` int(11) NOT NULL,
  `_ordering` bigint(20) DEFAULT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `groepscategorie` bigint(20) DEFAULT NULL,
  `invoice` bigint(20) NOT NULL,
  `ledger` bigint(20) DEFAULT NULL,
  `costheading` bigint(20) DEFAULT NULL,
  `product` bigint(20) NOT NULL,
  `amount` float NOT NULL,
  `unit` bigint(20) DEFAULT NULL,
  `sellingprice` float NOT NULL,
  `discount` float NOT NULL,
  `buyingprice` float NOT NULL,
  `additionalsubject` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `vat` bigint(20) NOT NULL,
  `project` bigint(20) DEFAULT NULL,
  `part` bigint(20) DEFAULT NULL,
  `rowtype` enum('NORMAL','GROUP') DEFAULT NULL,
  `hidedetails` tinyint(1) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `previewdatasmall` varchar(255) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grootboek`
--

CREATE TABLE `grootboek` (
  `id` int(11) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `type` bigint(20) DEFAULT NULL,
  `debitcredit` bigint(20) DEFAULT NULL,
  `categorie` bigint(20) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `inkoopbetaling`
--

CREATE TABLE `inkoopbetaling` (
  `id` int(11) NOT NULL,
  `_ordering` bigint(20) DEFAULT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `purchaseinvoice` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `amount` float NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `inkoopfactuur`
--

CREATE TABLE `inkoopfactuur` (
  `id` int(11) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `company` bigint(20) NOT NULL,
  `contact` bigint(20) DEFAULT NULL,
  `number` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `reportdate` date DEFAULT NULL,
  `expirydate` date DEFAULT NULL,
  `phase` enum('CONCEPT','CHECK','AGREED','PROCESSED','ONHOLD') NOT NULL,
  `paymentmethod` enum('MANUALTRANSFER','AUTOMATICTRANSFER') NOT NULL,
  `totalinclvat` float DEFAULT NULL,
  `totalpayed` float DEFAULT NULL,
  `bookingnumber` bigint(20) DEFAULT NULL,
  `identity` bigint(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `totalincldiscountinclvat` float DEFAULT NULL,
  `totalopeninclvat` float DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `tags` bigint(20) DEFAULT NULL,
  `employees` bigint(20) DEFAULT NULL,
  `employees_starred` bigint(20) DEFAULT NULL,
  `files` bigint(20) DEFAULT NULL,
  `totalbuyingincldiscountexclvat` float DEFAULT NULL,
  `purchaseinvoicelines` bigint(20) DEFAULT NULL,
  `payments` bigint(20) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `inkoopfactuurregel`
--

CREATE TABLE `inkoopfactuurregel` (
  `id` int(11) NOT NULL,
  `_ordering` bigint(20) DEFAULT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `purchaseinvoice` bigint(20) NOT NULL,
  `additionalsubject` varchar(255) DEFAULT NULL,
  `amount` float NOT NULL,
  `sellingprice` float NOT NULL,
  `discount` float NOT NULL,
  `vat` bigint(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `ledger` bigint(20) DEFAULT NULL,
  `costheading` bigint(20) DEFAULT NULL,
  `project` bigint(20) DEFAULT NULL,
  `part` bigint(20) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `inkoopopdracht`
--

CREATE TABLE `inkoopopdracht` (
  `id` int(11) NOT NULL,
  `templateset` bigint(20) DEFAULT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `number` bigint(20) DEFAULT NULL,
  `phase` bigint(20) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `company` bigint(20) DEFAULT NULL,
  `contact` bigint(20) DEFAULT NULL,
  `identity` bigint(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `workdeliveraddress` varchar(255) DEFAULT NULL,
  `clientreference` varchar(255) DEFAULT NULL,
  `archived` tinyint(1) DEFAULT NULL,
  `archivedon` date DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `tags` bigint(20) DEFAULT NULL,
  `employees` bigint(20) DEFAULT NULL,
  `employees_starred` bigint(20) DEFAULT NULL,
  `purchaseorderstatus` bigint(20) DEFAULT NULL,
  `totalincldiscountexclvat` float DEFAULT NULL,
  `supplier` bigint(20) DEFAULT NULL,
  `files` bigint(20) DEFAULT NULL,
  `purchaseorderlines` bigint(20) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `inkoopopdrachtregel`
--

CREATE TABLE `inkoopopdrachtregel` (
  `id` int(11) NOT NULL,
  `_ordering` bigint(20) DEFAULT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `sellingprice` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `additionalsubject` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `vat` bigint(20) NOT NULL,
  `ordercodesupplier` varchar(255) DEFAULT NULL,
  `ledger` bigint(20) DEFAULT NULL,
  `purchaseorder` bigint(20) NOT NULL,
  `projectline` bigint(20) DEFAULT NULL,
  `project` bigint(20) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kostenplaats`
--

CREATE TABLE `kostenplaats` (
  `id` int(11) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `medewerker`
--

CREATE TABLE `medewerker` (
  `id` int(11) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `userphoto` bigint(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `screenname` varchar(255) DEFAULT NULL,
  `number` bigint(20) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `socialsecuritynumber` varchar(255) DEFAULT NULL,
  `emailprivate` varchar(255) DEFAULT NULL,
  `bankaccount` varchar(255) DEFAULT NULL,
  `bankcity` varchar(255) DEFAULT NULL,
  `bankascription` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `employeesince` date DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `role` bigint(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `adresline2` varchar(255) DEFAULT NULL,
  `streetnumber` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `function` varchar(255) DEFAULT NULL,
  `salutation` enum('SIR','MADAM','SIRMADAM') DEFAULT NULL,
  `initials` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `infix` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `tags` bigint(20) DEFAULT NULL,
  `skills` bigint(20) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `medewerkerdatum`
--

CREATE TABLE `medewerkerdatum` (
  `id` int(11) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `employee` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mijnuren`
--

CREATE TABLE `mijnuren` (
  `id` int(11) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `task` bigint(20) DEFAULT NULL,
  `status` enum('CONCEPT','DEFINITIVE','AUTHORIZED') DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `employee` bigint(20) NOT NULL,
  `offerprojectbase` bigint(20) NOT NULL,
  `offerprojectline` bigint(20) DEFAULT NULL,
  `authorizedon` date DEFAULT NULL,
  `authorizedby` bigint(20) DEFAULT NULL,
  `definitiveby` bigint(20) DEFAULT NULL,
  `definitiveon` date DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `offerte`
--

CREATE TABLE `offerte` (
  `id` int(11) NOT NULL,
  `template` bigint(20) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `validfor` bigint(20) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `number` bigint(20) DEFAULT NULL,
  `phase` bigint(20) DEFAULT NULL,
  `acceptancestatus` enum('ACCEPTED','REJECTED') DEFAULT NULL,
  `acceptedon` date DEFAULT NULL,
  `isbasis` tinyint(1) DEFAULT NULL,
  `totalinclvat` float DEFAULT NULL,
  `signingenabled` tinyint(1) DEFAULT NULL,
  `validity` bigint(20) DEFAULT NULL,
  `company` bigint(20) NOT NULL,
  `contact` bigint(20) DEFAULT NULL,
  `identity` bigint(20) DEFAULT NULL,
  `chance` bigint(20) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `workdeliveraddress` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `accountmanager` bigint(20) DEFAULT NULL,
  `status` enum('PROJECT_RUNNING','PROJECT_COMPLETED','CONCEPT','REJECTED','SENT') DEFAULT NULL,
  `clientreference` varchar(255) DEFAULT NULL,
  `archived` tinyint(1) DEFAULT NULL,
  `archivedon` date DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `extrapdf1` bigint(20) DEFAULT NULL,
  `extrapdf2` bigint(20) DEFAULT NULL,
  `files` bigint(20) DEFAULT NULL,
  `frequency` enum('EVERYMONTH','EVERYQUARTER','EVERY6MONTHS','EVERYYEAR','EVERY18MONTHS','EVERYTWOYEARS','EVERYWEEK','EVERYTWOWEEKS','EVERYTHREEYEARS','EVERYFOURYEARS','EVERYFIVEYEARS') DEFAULT NULL,
  `expectedterms` bigint(20) DEFAULT NULL,
  `sendmaxtimescheckbox` tinyint(1) DEFAULT NULL,
  `sendmaxtimes` bigint(20) DEFAULT NULL,
  `renewautomatically` tinyint(1) DEFAULT NULL,
  `renewperiods` bigint(20) DEFAULT NULL,
  `paymentmethod` enum('MANUALTRANSFER','AUTOMATICTRANSFER') DEFAULT NULL,
  `tags` bigint(20) DEFAULT NULL,
  `employees` bigint(20) DEFAULT NULL,
  `employees_starred` bigint(20) DEFAULT NULL,
  `offerlines` bigint(20) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `offertefase`
--

CREATE TABLE `offertefase` (
  `id` int(11) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `onderdeel`
--

CREATE TABLE `onderdeel` (
  `id` int(11) NOT NULL,
  `_ordering` bigint(20) DEFAULT NULL,
  `hidedetails` tinyint(1) DEFAULT NULL,
  `groupcategory` bigint(20) DEFAULT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `hidefortimewriting` tinyint(1) DEFAULT NULL,
  `amount` float NOT NULL,
  `amountwritten` varchar(255) DEFAULT NULL,
  `convertto` enum('PROJECTORINVOICE','CONTRACTFORNEWINVOICE','CONTRACTFORNEWINVOICEONCE','CONTRACTFORNEWPROJECT','CONTRACTFORNEWPROJECTONCE','CONTRACTFORUPDATEPROJECT') DEFAULT NULL,
  `unit` bigint(20) DEFAULT NULL,
  `sellingprice` float NOT NULL,
  `discount` float NOT NULL,
  `invoicebasis` enum('FIXED','COSTING','BUDGETED','NONBILLABLE') NOT NULL,
  `additionalsubject` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `vat` bigint(20) NOT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `rowtype` enum('NORMAL','GROUP') DEFAULT NULL,
  `offerprojectbase` bigint(20) NOT NULL,
  `buyingprice` float NOT NULL,
  `product` bigint(20) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `opdracht`
--

CREATE TABLE `opdracht` (
  `id` int(11) NOT NULL,
  `templateset` bigint(20) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `validfor` bigint(20) DEFAULT NULL,
  `accountmanager` bigint(20) DEFAULT NULL,
  `number` bigint(20) DEFAULT NULL,
  `phase` bigint(20) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `company` bigint(20) NOT NULL,
  `contact` bigint(20) DEFAULT NULL,
  `identity` bigint(20) DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `deliverydate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `addhoursspecification` tinyint(1) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `workdeliveraddress` varchar(255) DEFAULT NULL,
  `clientreference` varchar(255) DEFAULT NULL,
  `isbasis` tinyint(1) DEFAULT NULL,
  `archived` tinyint(1) DEFAULT NULL,
  `archivedon` date DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `tags` bigint(20) DEFAULT NULL,
  `employees` bigint(20) DEFAULT NULL,
  `employees_starred` bigint(20) DEFAULT NULL,
  `files` bigint(20) DEFAULT NULL,
  `projectlines` bigint(20) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `opdrachtfase`
--

CREATE TABLE `opdrachtfase` (
  `id` int(11) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pakket`
--

CREATE TABLE `pakket` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `number` bigint(20) DEFAULT NULL,
  `groupcategory` bigint(20) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `unit` bigint(20) DEFAULT NULL,
  `internalnote` varchar(255) DEFAULT NULL,
  `hidedetails` tinyint(1) DEFAULT NULL,
  `usepriceexceptionscustomer` tinyint(1) DEFAULT NULL,
  `tags` bigint(20) DEFAULT NULL,
  `packetlines` bigint(20) DEFAULT NULL,
  `taken` varchar(255) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pakketregel`
--

CREATE TABLE `pakketregel` (
  `id` int(11) NOT NULL,
  `_ordering` bigint(20) DEFAULT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `packet` bigint(20) DEFAULT NULL,
  `product` bigint(20) DEFAULT NULL,
  `convertto` enum('PROJECTORINVOICE','CONTRACTFORNEWINVOICE','CONTRACTFORNEWINVOICEONCE','CONTRACTFORNEWPROJECT','CONTRACTFORNEWPROJECTONCE','CONTRACTFORUPDATEPROJECT') DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `unit` bigint(20) DEFAULT NULL,
  `sellingprice` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `vat` bigint(20) DEFAULT NULL,
  `invoicebasis` enum('FIXED','COSTING','BUDGETED','NONBILLABLE') DEFAULT NULL,
  `buyingprice` float DEFAULT NULL,
  `additionalsubject` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `producteenheid`
--

CREATE TABLE `producteenheid` (
  `id` int(11) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `hoursperunit` float DEFAULT NULL,
  `unittype` enum('HOURS','NUMBERS') DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `taak`
--

CREATE TABLE `taak` (
  `id` int(11) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `type` bigint(20) DEFAULT NULL,
  `deadlinedate` date DEFAULT NULL,
  `deadlinetime` time DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `number` bigint(20) DEFAULT NULL,
  `phase` bigint(20) DEFAULT NULL,
  `company` bigint(20) NOT NULL,
  `offerprojectbase` bigint(20) DEFAULT NULL,
  `offerprojectline` bigint(20) DEFAULT NULL,
  `estimatedhours` float DEFAULT NULL,
  `completedon` date DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `files` bigint(20) DEFAULT NULL,
  `calendaritems` bigint(20) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `taakfase`
--

CREATE TABLE `taakfase` (
  `id` int(11) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `taaktype`
--

CREATE TABLE `taaktype` (
  `id` int(11) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tariefuitzondering`
--

CREATE TABLE `tariefuitzondering` (
  `id` int(11) NOT NULL,
  `company` bigint(20) DEFAULT NULL,
  `product` bigint(20) DEFAULT NULL,
  `sellingprice` float DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `timelineentry`
--

CREATE TABLE `timelineentry` (
  `id` int(11) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `employee` bigint(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `timelinetype` enum('USERMESSAGE','SYSTEMMESSAGE') DEFAULT NULL,
  `company` bigint(20) NOT NULL,
  `contact` bigint(20) DEFAULT NULL,
  `offer` bigint(20) DEFAULT NULL,
  `project` bigint(20) DEFAULT NULL,
  `invoice` bigint(20) DEFAULT NULL,
  `purchaseinvoice` bigint(20) DEFAULT NULL,
  `purchaseorder` bigint(20) DEFAULT NULL,
  `contract` bigint(20) DEFAULT NULL,
  `task` bigint(20) DEFAULT NULL,
  `starred` tinyint(1) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `files` bigint(20) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `verkoopproduct`
--

CREATE TABLE `verkoopproduct` (
  `id` int(11) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `unit` bigint(20) NOT NULL,
  `sellingprice` float DEFAULT NULL,
  `convertto` enum('PROJECTORINVOICE','CONTRACTFORNEWINVOICE','CONTRACTFORNEWINVOICEONCE','CONTRACTFORNEWPROJECT','CONTRACTFORNEWPROJECTONCE','CONTRACTFORUPDATEPROJECT') DEFAULT NULL,
  `vat` bigint(20) NOT NULL,
  `buyingvat` bigint(20) DEFAULT NULL,
  `tasktype` bigint(20) DEFAULT NULL,
  `costheading` bigint(20) DEFAULT NULL,
  `ledger` bigint(20) DEFAULT NULL,
  `purchaseledger` bigint(20) DEFAULT NULL,
  `invoicebasis` enum('FIXED','COSTING','BUDGETED','NONBILLABLE') NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `number` bigint(20) DEFAULT NULL,
  `archived` tinyint(1) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `supplierordercode` varchar(255) DEFAULT NULL,
  `supplier` bigint(20) DEFAULT NULL,
  `tags` bigint(20) DEFAULT NULL,
  `buyingprice` float DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `verlofaanvraag`
--

CREATE TABLE `verlofaanvraag` (
  `id` int(11) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `employee` bigint(20) DEFAULT NULL,
  `absencetype` bigint(20) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `absencerequestline` bigint(20) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `verlofmutatie`
--

CREATE TABLE `verlofmutatie` (
  `id` int(11) NOT NULL,
  `searchname` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `startingtime` time DEFAULT NULL,
  `absencerequest` bigint(20) DEFAULT NULL,
  `absencerequeststatus` enum('PENDING','APPROVED','REJECTED') DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `webhook`
--

CREATE TABLE `webhook` (
  `id` int(11) NOT NULL,
  `webhook_trigger` enum('NEW_COMPANY_CREATED','NEW_CONTRACT_CREATED','NEW_EMPLOYEE_CREATED','NEW_INVOICE_CREATED','NEW_OFFER_CREATED','NEW_PROJECT_CREATED','NEW_TASK_CREATED','OFFER_ACCEPTED','OFFER_DECLINED','NEW_HOUR_CREATED','INVOICE_SENT','NEW_PAYMENT','NEW_PURCHASEPAYMENT','NEW_CONTACT_CREATED','NEW_TIMELINEENTRY','TASK_DONE','NEW_PURCHASEINVOICE_CREATED','NEW_PURCHASEORDER_CREATED') DEFAULT NULL,
  `webhook_url` varchar(255) DEFAULT NULL,
  `errorcount` bigint(20) DEFAULT NULL,
  `extendedproperties` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alerttrigger`
--
ALTER TABLE `alerttrigger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bedrijf`
--
ALTER TABLE `bedrijf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `betaling`
--
ALTER TABLE `betaling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactpersoon`
--
ALTER TABLE `contactpersoon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contractregel`
--
ALTER TABLE `contractregel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `factuur`
--
ALTER TABLE `factuur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `factuurregel`
--
ALTER TABLE `factuurregel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grootboek`
--
ALTER TABLE `grootboek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inkoopbetaling`
--
ALTER TABLE `inkoopbetaling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inkoopfactuur`
--
ALTER TABLE `inkoopfactuur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inkoopfactuurregel`
--
ALTER TABLE `inkoopfactuurregel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inkoopopdracht`
--
ALTER TABLE `inkoopopdracht`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inkoopopdrachtregel`
--
ALTER TABLE `inkoopopdrachtregel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kostenplaats`
--
ALTER TABLE `kostenplaats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medewerker`
--
ALTER TABLE `medewerker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medewerkerdatum`
--
ALTER TABLE `medewerkerdatum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mijnuren`
--
ALTER TABLE `mijnuren`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offerte`
--
ALTER TABLE `offerte`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offertefase`
--
ALTER TABLE `offertefase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onderdeel`
--
ALTER TABLE `onderdeel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opdracht`
--
ALTER TABLE `opdracht`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opdrachtfase`
--
ALTER TABLE `opdrachtfase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pakket`
--
ALTER TABLE `pakket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pakketregel`
--
ALTER TABLE `pakketregel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `producteenheid`
--
ALTER TABLE `producteenheid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taak`
--
ALTER TABLE `taak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taakfase`
--
ALTER TABLE `taakfase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taaktype`
--
ALTER TABLE `taaktype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tariefuitzondering`
--
ALTER TABLE `tariefuitzondering`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timelineentry`
--
ALTER TABLE `timelineentry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verkoopproduct`
--
ALTER TABLE `verkoopproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verlofaanvraag`
--
ALTER TABLE `verlofaanvraag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verlofmutatie`
--
ALTER TABLE `verlofmutatie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webhook`
--
ALTER TABLE `webhook`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alerttrigger`
--
ALTER TABLE `alerttrigger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bedrijf`
--
ALTER TABLE `bedrijf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `betaling`
--
ALTER TABLE `betaling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contactpersoon`
--
ALTER TABLE `contactpersoon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contractregel`
--
ALTER TABLE `contractregel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `factuur`
--
ALTER TABLE `factuur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `factuurregel`
--
ALTER TABLE `factuurregel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grootboek`
--
ALTER TABLE `grootboek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inkoopbetaling`
--
ALTER TABLE `inkoopbetaling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inkoopfactuur`
--
ALTER TABLE `inkoopfactuur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inkoopfactuurregel`
--
ALTER TABLE `inkoopfactuurregel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inkoopopdracht`
--
ALTER TABLE `inkoopopdracht`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inkoopopdrachtregel`
--
ALTER TABLE `inkoopopdrachtregel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kostenplaats`
--
ALTER TABLE `kostenplaats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medewerker`
--
ALTER TABLE `medewerker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medewerkerdatum`
--
ALTER TABLE `medewerkerdatum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mijnuren`
--
ALTER TABLE `mijnuren`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offerte`
--
ALTER TABLE `offerte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offertefase`
--
ALTER TABLE `offertefase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `onderdeel`
--
ALTER TABLE `onderdeel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `opdracht`
--
ALTER TABLE `opdracht`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `opdrachtfase`
--
ALTER TABLE `opdrachtfase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pakket`
--
ALTER TABLE `pakket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pakketregel`
--
ALTER TABLE `pakketregel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `producteenheid`
--
ALTER TABLE `producteenheid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taak`
--
ALTER TABLE `taak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taakfase`
--
ALTER TABLE `taakfase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taaktype`
--
ALTER TABLE `taaktype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tariefuitzondering`
--
ALTER TABLE `tariefuitzondering`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timelineentry`
--
ALTER TABLE `timelineentry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verkoopproduct`
--
ALTER TABLE `verkoopproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verlofaanvraag`
--
ALTER TABLE `verlofaanvraag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verlofmutatie`
--
ALTER TABLE `verlofmutatie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `webhook`
--
ALTER TABLE `webhook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
