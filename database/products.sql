-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 15. Jan 2021 um 14:08
-- Server-Version: 10.4.14-MariaDB
-- PHP-Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `veganerland`
--

-- --------------------------------------------------------


--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`prodId`, `descrip`, `cat`, `stdPrice`) VALUES
(1, 'karotten', 'V', '1.94'),
(2, 'kartoffeln', 'P', '2.94'),
(3, 'lauchzwiebel', 'V', '0.94'),
(4, 'trauben-hell', 'F', '1.64'),
(5, 'heidelbeeren', 'B', '1.95'),
(6, 'avocado', 'E', '0.94'),
(7, 'orangen', 'C', '2.00'),
(8, 'clementine', 'C', '1.64'),
(9, 'mango', 'E', '1.94'),
(10, 'apfel-grün', 'F', '1.34'),
(11, 'kaki', 'E', '0.94'),
(12, 'aprikosen', 'F', '0.89'),
(13, 'himbeere', 'B', '2.94'),
(14, 'ananas', 'E', '1.94'),
(15, 'wassermelone', 'F', '0.94'),
(16, 'apfel-rot', 'F', '1.54'),
(19, 'banana', 'E', '0.76'),
(20, 'birne', 'F', '1.45'),
(21, 'aubergine', 'V', '2.47'),
(22, 'blumenkohl', 'V', '1.36'),
(23, 'erdbeeren', 'B', '4.80'),
(24, 'granatapfel', 'E', '2.35'),
(25, 'broccoli', 'V', '1.36'),
(26, 'champignons', 'M', '4.37'),
(27, 'grapefruit', 'C', '6.75'),
(28, 'kirschen', 'F', '2.45'),
(29, 'kiwi', 'F', '1.43'),
(30, 'trauben-dunkel', 'F', '1.96'),
(31, 'fenchel', 'V', '1.47'),
(32, 'gurke', 'V', '0.76'),
(33, 'ingwer', 'V', '2.76'),
(34, 'knoblauch', 'V', '0.83'),
(35, 'kohlrabi', 'V', '2.13'),
(36, 'paprika', 'V', '2.43'),
(37, 'porree', 'V', '1.75'),
(38, 'radieschen', 'V', '1.25'),
(39, 'salat', 'V', '4.32'),
(40, 'süsskartoffeln', 'P', '3.76'),
(41, 'tomaten', 'V', '1.20'),
(42, 'zucchini', 'V', '0.56'),
(43, 'zwiebeln', 'V', '6.73'),
(44, 'brombeere', 'B', '2.12'),
(45, 'johannisbeere-rot', 'B', '2.00'),
(46, 'beeren-mix', 'B', '4.50'),
(47, 'zitrone', 'C', '4.32'),
(48, 'limette', 'C', '1.20'),
(49, 'mandarine', 'C', '1.79'),
(50, 'pfifferlinge', 'M', '3.50'),
(51, 'steinpilze', 'M', '2.70'),
(52, 'judasohr', 'M', '4.30'),
(53, 'violetter lacktrichterling', 'M', '4.30'),
(54, 'walnuss', 'N', '2.25'),
(55, 'haseknuss', 'N', '1.75'),
(56, 'erdnuss', 'N', '0.50'),
(57, 'macadamia', 'N', '3.75'),
(58, 'edelkastanie', 'N', '3.50'),
(59, 'pistazie', 'N', '0.25');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prodId`),
  ADD UNIQUE KEY `PRODID_UNIQUE` (`prodId`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `prodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
