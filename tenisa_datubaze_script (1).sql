-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2018 at 08:06 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tenisa_datubaze`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `personFiltrationByClub` (`clubID` INT)  BEGIN
SELECT persona.Personas_ID as ID, persona.Vards as 'Vƒrds', persona.Uzvards as 'Uzvƒrds',
        kluba_biedri.Pienemsanas_datums as 'Pieìemts', persona.Telefona_numurs as 'Telefona numurs', 
        persona.E_pasts as 'E-pasts'
        FROM persona
        JOIN kluba_biedri
        ON persona.Personas_ID = kluba_biedri.Personas_ID
        JOIN klubs
        ON persona.Kluba_ID = klubs.Kluba_ID
        WHERE klubs.Kluba_ID = clubID
        ORDER BY persona.Uzvards ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `personFiltrationByGroup` (`groupID` INT)  SELECT persona.Personas_ID as ID, persona.Vards as 'Vƒrds', 
        persona.Uzvards as 'Uzvƒrds', kluba_biedri.Pienemsanas_datums as 'Pieìemts', 
        persona.Telefona_numurs as 'Telefona numurs', persona.E_pasts as 'E-pasts' 
        FROM persona 
        JOIN kluba_biedri 
        ON persona.Personas_ID = kluba_biedri.Personas_ID 
        JOIN grupa 
        ON persona.Grupas_ID = grupa.Grupas_ID 
        WHERE grupa.Grupas_ID = groupID 
        ORDER BY persona.Uzvards ASC;$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `solveAge` (`birthdate` DATE) RETURNS INT(11) BEGIN
RETURN TIMESTAMPDIFF(YEAR,birthdate,CURDATE());
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `apbalvojums`
--

CREATE TABLE `apbalvojums` (
  `Apbalvojuma_ID` int(11) NOT NULL,
  `Tituls` varchar(50) DEFAULT NULL,
  `Apraksts` varchar(256) DEFAULT NULL,
  `Iegusanas_datums` date DEFAULT NULL,
  `Biedra_veselibas_stavoklis` varchar(50) DEFAULT NULL,
  `Kluba_biedra_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apbalvojums`
--

INSERT INTO `apbalvojums` (`Apbalvojuma_ID`, `Tituls`, `Apraksts`, `Iegusanas_datums`, `Biedra_veselibas_stavoklis`, `Kluba_biedra_ID`) VALUES
(1, 'Čempiona tituls', 'Ieguva uzvaru pret iepriekšējā gada spēlētāju ', '2018-06-25', 'Stabils', 15),
(2, 'Federācijas kauss', 'Prestižākais valstu komandu turnīrs un iegutais kauss', '2018-11-25', 'Izcils', 16),
(3, 'WTA \"International\" tituls', 'Iegūtais tituls pret iepriekšējā gada titula spēlētaju', '2018-08-10', 'Labs', 3),
(4, 'ATP \"Masters 1000\"', 'Iegūtais tituls Spānijā, pieveicot ranga līderi', '2018-05-09', 'Neslikts', 14),
(5, '\"Orange\" grupas 1.vieta', 'Iegūtā vieta Oranžas grupas spēlē', '2018-12-12', 'Neslikts', 18),
(6, '\"Green\" grupas 2.vieta', 'Iegutā vieta Zaļās grupas spēlē', '2018-12-12', 'Labs', 19);

-- --------------------------------------------------------

--
-- Table structure for table `grupa`
--

CREATE TABLE `grupa` (
  `Grupas_ID` int(11) NOT NULL,
  `Kategorija` varchar(10) DEFAULT NULL,
  `Apraksts` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grupa`
--

INSERT INTO `grupa` (`Grupas_ID`, `Kategorija`, `Apraksts`) VALUES
(1, 'J12-18', 'Tenisa jauniešu grupa'),
(2, 'B8-12', 'Tenisa bērnu grupa'),
(3, 'P18-56', 'Tenisa pieaugušo grupa'),
(4, 'Admin', 'Tenisa kluba administrators');

-- --------------------------------------------------------

--
-- Table structure for table `kluba_biedri`
--

CREATE TABLE `kluba_biedri` (
  `Kluba_biedra_ID` int(11) NOT NULL,
  `Pienemsanas_datums` date DEFAULT NULL,
  `Personas_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kluba_biedri`
--

INSERT INTO `kluba_biedri` (`Kluba_biedra_ID`, `Pienemsanas_datums`, `Personas_ID`) VALUES
(1, '1995-04-21', 1),
(2, '1999-05-23', 2),
(3, '2000-08-21', 3),
(4, '1996-03-15', 4),
(5, '1998-03-25', 5),
(6, '1998-11-29', 6),
(7, '2001-12-14', 7),
(8, '1999-01-15', 8),
(9, '2001-05-12', 9),
(11, '2016-07-13', 11),
(12, '2018-01-08', 12),
(13, '2005-09-14', 13),
(14, '2005-10-11', 14),
(15, '2005-11-08', 15),
(16, '2005-12-09', 16),
(17, '2016-06-26', 17),
(18, '2016-08-16', 18),
(19, '2016-09-19', 19),
(20, '2017-02-21', 20);

-- --------------------------------------------------------

--
-- Table structure for table `klubs`
--

CREATE TABLE `klubs` (
  `Kluba_ID` int(11) NOT NULL,
  `Nosaukums` varchar(50) DEFAULT NULL,
  `Dibinasanas_datums` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `klubs`
--

INSERT INTO `klubs` (`Kluba_ID`, `Nosaukums`, `Dibinasanas_datums`) VALUES
(2, 'Rakete', '1998-03-25'),
(3, 'Bumbiņa', '2001-05-12'),
(4, 'Liepnieki', '2005-09-14'),
(5, 'Ozoli', '2016-06-26');

-- --------------------------------------------------------

--
-- Table structure for table `macs`
--

CREATE TABLE `macs` (
  `Maca_ID` int(11) NOT NULL,
  `Setu_skaits` int(11) DEFAULT NULL,
  `Uzvaretajs` varchar(50) DEFAULT NULL,
  `Sacensibas_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `macs`
--

INSERT INTO `macs` (`Maca_ID`, `Setu_skaits`, `Uzvaretajs`, `Sacensibas_ID`) VALUES
(1, 3, 'Zane Sosojeva', 1),
(2, 5, 'Juris Zariņš', 2),
(3, 2, 'Ainars Līpnieks', 3),
(4, 4, 'Ināra Bergmane', 4),
(5, 2, 'Māris Ziemeļnieks', 5),
(6, 3, 'Armands Lapnieks', 6);

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE `persona` (
  `Personas_ID` int(11) NOT NULL,
  `Vards` varchar(50) DEFAULT NULL,
  `Uzvards` varchar(50) DEFAULT NULL,
  `Dzimums` varchar(50) DEFAULT NULL,
  `Dzimsanas_gads` date DEFAULT NULL,
  `Adrese` varchar(150) DEFAULT NULL,
  `E_pasts` varchar(50) DEFAULT NULL,
  `Telefona_numurs` varchar(8) DEFAULT NULL,
  `Kluba_pozicija` enum('Biedrs','Administrators','Treneris','Kapteinis') DEFAULT NULL,
  `Kluba_ID` int(11) NOT NULL,
  `Grupas_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`Personas_ID`, `Vards`, `Uzvards`, `Dzimums`, `Dzimsanas_gads`, `Adrese`, `E_pasts`, `Telefona_numurs`, `Kluba_pozicija`, `Kluba_ID`, `Grupas_ID`) VALUES
(2, 'Zane', 'Sosejeva', 'Sieviete', '1986-06-27', 'Rīga, Brīvzemes iela 27', 'zane.sosejeva@gmail.com', '24578596', 'Biedrs', 1, 3),
(3, 'Juris', 'Zariņš', 'Vīrietis', '1987-03-24', 'Rīga, Liepajas iela 45', 'juris.sarins@inbox.lv', '21541475', 'Biedrs', 1, 3),
(4, 'Ainars', 'Līpnieks', 'Vīrietis', '1988-08-14', 'Rīga, Brīvības iela 12', 'ainars.lipnieks@inbox.lv', '25478684', 'Biedrs', 1, 3),
(5, 'Aivars', 'Lepnums', 'Vīrietis', '1975-02-01', 'Aizpute, Jelgavas iela 23', 'aivars.lepnums@gmail.com', '27548652', 'Administrators', 2, 4),
(7, 'Dace', 'Ziedone', 'Sieviete', '1997-06-06', 'Aizpute, Ziedoņa iela 34', 'dace.ziedone@inbox.lv', '26543457', 'Biedrs', 2, 3),
(8, 'Ivars', 'Liepa', 'Vīrietis', '1996-11-04', 'Aizpute, Ziedoņa iela 24', 'ivars.liepa@inbox.lv', '24569874', 'Biedrs', 2, 3),
(9, 'Dace', 'Vējone', 'Sieviete', '1976-12-09', 'Liepaja, Jura iela 45', 'dace.vejone@gmail.com', '21545847', 'Administrators', 3, 4),
(11, 'Spodris', 'Brīvnieks', 'Vīrietis', '2009-07-12', 'Liepaja, Ziedoņa iela 56', 'spodris.brivnieks@inbox.lv', '28635475', 'Biedrs', 3, 2),
(12, 'Ģirts', 'Zemgalis', 'Vīrietis', '2010-01-16', 'Grobiņa, Izvēles iela 12', 'girts.zemgalis@inbox.lv', '21658748', 'Biedrs', 3, 2),
(13, 'Igors', 'Zemnieks', 'Vīrietis', '1963-10-26', 'Ventspils, Brīvības iela 56', 'igors.zemnieks@inbox.lv', '23657748', 'Administrators', 4, 4),
(14, 'Sanda', 'Liepniece', 'Sieviete', '1965-05-21', 'Ventspils, Prospekta iela 20', 'sanda.liepniece@inbox.lv', '24698757', 'Biedrs', 4, 3),
(15, 'Aivars', 'Zigmanis', 'Vīrietis', '1962-03-14', 'Ventspils, Ziedoņa iela 34', 'aivars.zigmanis@inbox.lv', '21487596', 'Biedrs', 4, 3),
(16, 'Raimonds', 'Liepa', 'Vīrietis', '1969-01-12', 'Ventspils, Prospekta iela 37', 'raimonds.liepa@inbox.lv', '29687572', 'Biedrs', 4, 3),
(17, 'Ermīns', 'Pasaulnieks', 'Vīrietis', '1986-06-12', 'Kuldīga, Liepnieku iela 26', 'ermins.pasaulnieks@gmail.com', '21475868', 'Administrators', 5, 4),
(18, 'Armands', 'Lapnieks', 'Vīrietis', '2005-08-13', 'Kuldīga, Liepu iela 28', 'armands.lapnieks@gmail.com', '28965741', 'Biedrs', 5, 1),
(19, 'Māris', 'Ziemeļnieks', 'Vīrietis', '2002-03-21', 'Kuldīga, Aspazijas iela 34', 'maris.ziemelnieks@gmail.com', '23658741', 'Biedrs', 5, 1),
(20, 'Endijs', 'Ziemelis', 'Vīrietis', '2003-09-23', 'Kuldīga, Palnieka iela 26', 'endijs.ziemelis@gmail.com', '29856741', 'Biedrs', 5, 1);

--
-- Triggers `persona`
--
DELIMITER $$
CREATE TRIGGER `personAdd` AFTER INSERT ON `persona` FOR EACH ROW BEGIN
INSERT INTO kluba_biedri (Pienemsanas_datums, Personas_ID) VALUES (NOW(), NEW.Personas_ID);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `personDelete` AFTER DELETE ON `persona` FOR EACH ROW BEGIN
DELETE FROM kluba_biedri WHERE kluba_biedri.Personas_ID = OLD.Personas_ID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sacensibas`
--

CREATE TABLE `sacensibas` (
  `Sacensibas_ID` int(11) NOT NULL,
  `Nosaukums` varchar(50) DEFAULT NULL,
  `Norises_vieta` varchar(50) DEFAULT NULL,
  `Datums` date DEFAULT NULL,
  `Tenisa_korts` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sacensibas`
--

INSERT INTO `sacensibas` (`Sacensibas_ID`, `Nosaukums`, `Norises_vieta`, `Datums`, `Tenisa_korts`) VALUES
(1, 'Daugavpils atklātās spēles sacensības', 'Daugavpils, Jelgavas iela 68, Tenisa klubs \"Jelgav', '2019-06-12', 2),
(2, 'Rīgas čempiona titula \"WTA\" spēle', 'Rīga, Brīvzemnieka iela 34, Tenisa kluba \"Rīdzinie', '2019-05-13', 3),
(3, 'Cēsu TB pieaugušo sacensības', 'Cesis, Partizānu iela 23', '2019-07-21', 1),
(4, 'TC Ādaži \"MINHAUZENS SEN\"', 'Rīgas raj., Ādaži, Gaujas iela 26', '2019-03-22', 4),
(5, 'Rīgas meistarsacīkstes jauniešiem', 'Rīgas Satiksmes Tenisa klubs, Ezermalas iela 32', '2019-09-12', 8),
(6, 'TC Ādaži kauss', 'Rīgas raj., Ādaži, Gaujas iela 26', '2019-07-14', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sacensibas_dalibnieki`
--

CREATE TABLE `sacensibas_dalibnieki` (
  `Kluba_biedra_ID` int(11) NOT NULL,
  `Sacensibas_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sacensibas_dalibnieki`
--

INSERT INTO `sacensibas_dalibnieki` (`Kluba_biedra_ID`, `Sacensibas_ID`) VALUES
(2, 1),
(3, 2),
(4, 1),
(6, 3),
(7, 3),
(8, 3),
(10, 4),
(11, 4),
(12, 4),
(14, 1),
(15, 3),
(16, 1),
(18, 5),
(19, 5),
(20, 6);

-- --------------------------------------------------------

--
-- Table structure for table `sets`
--

CREATE TABLE `sets` (
  `Seta_ID` int(11) NOT NULL,
  `Iegutie_punkti` int(11) DEFAULT NULL,
  `Maca_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sets`
--

INSERT INTO `sets` (`Seta_ID`, `Iegutie_punkti`, `Maca_ID`) VALUES
(1, 12, 1),
(2, 8, 1),
(3, 10, 1),
(4, 7, 2),
(5, 8, 2),
(6, 10, 2),
(7, 12, 2),
(8, 15, 2),
(9, 10, 3),
(10, 8, 3),
(11, 8, 4),
(12, 8, 4),
(13, 10, 4),
(14, 12, 4),
(15, 12, 5),
(16, 14, 5),
(17, 14, 6),
(18, 15, 6),
(19, 15, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apbalvojums`
--
ALTER TABLE `apbalvojums`
  ADD PRIMARY KEY (`Apbalvojuma_ID`);

--
-- Indexes for table `grupa`
--
ALTER TABLE `grupa`
  ADD PRIMARY KEY (`Grupas_ID`);

--
-- Indexes for table `kluba_biedri`
--
ALTER TABLE `kluba_biedri`
  ADD PRIMARY KEY (`Kluba_biedra_ID`);

--
-- Indexes for table `klubs`
--
ALTER TABLE `klubs`
  ADD PRIMARY KEY (`Kluba_ID`);

--
-- Indexes for table `macs`
--
ALTER TABLE `macs`
  ADD PRIMARY KEY (`Maca_ID`);

--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`Personas_ID`);

--
-- Indexes for table `sacensibas`
--
ALTER TABLE `sacensibas`
  ADD PRIMARY KEY (`Sacensibas_ID`);

--
-- Indexes for table `sets`
--
ALTER TABLE `sets`
  ADD PRIMARY KEY (`Seta_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apbalvojums`
--
ALTER TABLE `apbalvojums`
  MODIFY `Apbalvojuma_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `grupa`
--
ALTER TABLE `grupa`
  MODIFY `Grupas_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kluba_biedri`
--
ALTER TABLE `kluba_biedri`
  MODIFY `Kluba_biedra_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `klubs`
--
ALTER TABLE `klubs`
  MODIFY `Kluba_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `macs`
--
ALTER TABLE `macs`
  MODIFY `Maca_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `persona`
--
ALTER TABLE `persona`
  MODIFY `Personas_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sacensibas`
--
ALTER TABLE `sacensibas`
  MODIFY `Sacensibas_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sets`
--
ALTER TABLE `sets`
  MODIFY `Seta_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
