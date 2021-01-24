-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 24. Jan 2021 um 17:27
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
-- Tabellenstruktur für Tabelle `products`
--

--

INSERT INTO `products` (`prodId`, `descrip`, `stdPrice`, `catId`, `comment`) VALUES
(1, 'karotten', '1.95', 6, 'Bio,_Regional,_500g'),
(2, 'kartoffeln_(festkochend)', '3.15', 7, 'Bio,_Regional,_1kg'),
(3, 'shiitake', '2.95', 8, 'Bio,_100g'),
(4, 'zwiebeln', '1.95', 6, 'Bio,_Regional,_500g'),
(5, 'ingwer', '1.20', 6, 'Bio,_100g'),
(6, 'paprika_(rot)', '5.40', 6, '3_Stück'),
(7, 'knoblauch', '1.95', 6, 'Bio,_100g'),
(8, 'kräuterseitlinge', '6.95', 8, 'Bio,_Regional,_250g'),
(9, 'zwiebeln_(rot)', '2.40', 6, 'Bio,_500g'),
(10, 'kartoffeln_(mehlig)', '7.50', 7, 'Bio,_Regional,_2,5kg'),
(11, 'igelstachelbart-pilze', '6.95', 8, 'Bio,_250g'),
(12, 'spinat', '4.50', 6, 'Bio,_Regional,_500g'),
(13, 'landgurke', '1.95', 6, 'Bio,_Regional,_1_Stück'),
(14, 'landgurke', '1.55', 6, 'Regional,_1_Stück'),
(15, 'kohlrabi', '2.15', 6, 'Bio,_1_Stück'),
(16, 'blumenkohl', '4.50', 6, '1_Stück'),
(17, 'brokkoli', '3.95', 6, '500g'),
(18, 'radieschen', '1.50', 6, 'Bio,_100g'),
(19, 'kartoffeln_(vorwiegend_festkochend)', '3.25', 7, 'Bio,_Regional,_1kg'),
(20, 'süsskartoffeln', '2.50', 7, 'Bio,_500g'),
(26, 'kartoffeln_(rund)', '3.75', 7, '1kg'),
(27, 'kartoffeln_(blau)', '4.00', 7, 'Bio,_1kg'),
(28, 'judasohr', '6.95', 8, 'Bio,_250g'),
(29, 'pfifferlinge', '5.55', 8, 'Bio,_Regional,_250g'),
(30, 'steinpilze', '4.55', 8, 'Regional,_250g'),
(31, 'championg_(klasse_a)', '4.55', 8, 'Regional,_250g'),
(32, 'tomaten', '3.95', 6, 'Bio,_500g'),
(33, 'paprika_(gelb)', '5.40', 6, '3_Stück'),
(34, 'paprika_(grün)', '5.40', 6, '3_Stück'),
(35, 'paprika_(mix)', '5.40', 6, '3_Stück'),
(36, 'äpfel_(grün)', '6.50', 1, 'Bio,_Regional,__1kg'),
(37, 'äpfel_(grün)', '3.50', 1, 'Bio,_Regional,_500g'),
(38, 'äpfel_(grün)', '0.75', 1, 'Bio,_Regional,_1_Stück'),
(39, 'äpfel_(rot)', '6.50', 1, 'Bio,_Regional,_1kg'),
(40, 'äpfel_(rot)', '3.50', 1, 'Bio,_Regional,_500g'),
(41, 'äpfel_(rot)', '0.75', 1, 'Bio,_Regional,_1_Stück'),
(42, 'orangen', '1.75', 3, 'Bio,_500g'),
(43, 'bananen', '1.80', 4, 'Bio,_500g'),
(44, 'bananen', '1.40', 4, '500g'),
(45, 'birnen', '5.50', 1, 'Regional,_1kg'),
(46, 'ananas', '3.75', 4, 'Bio,_1_Stück'),
(47, 'mango', '2.25', 4, 'Bio,_1_Stück'),
(48, 'kiwi', '2.90', 4, 'Bio,_500g'),
(49, 'granatapfel', '2.35', 4, 'Bio,_1_Stück'),
(50, 'zitronen', '2.00', 3, 'Bio,_500g'),
(51, 'clementinen', '2.50', 3, '500g'),
(52, 'grapefruit', '1.75', 3, 'Bio,_1_Stück'),
(53, 'avocado', '2.45', 4, 'Bio,_1_Stück'),
(54, 'erdnüsse', '1.95', 5, 'Bio,_150g'),
(55, 'edelkastanie', '3.50', 5, '250g'),
(56, 'heidelbeeren', '1.95', 2, 'Bio,_Regional,_150g'),
(57, 'himbeere', '1.75', 2, 'Bio,_Regional,_150g'),
(58, 'brombeere', '1.75', 2, 'Bio,_Regional,_150g'),
(59, 'erdbeere', '1.25', 2, 'Bio,_Regional,_150g'),
(60, 'erdbeere', '1.95', 2, 'Bio,_Regional,_300g'),
(61, 'johannisbeeren_(rot)', '2.20', 2, 'Bio,_150g'),
(62, 'beeren-mix', '2.50', 2, '250g'),
(63, 'limetten', '1.20', 3, 'Bio,_250g'),
(64, 'mandarinen', '1.25', 3, 'Bio,_250g'),
(65, 'walnuss', '2.25', 5, 'Regional,_250g'),
(66, 'haselnuss', '3.50', 5, '250g'),
(67, 'macadamia', '3.75', 5, '250g'),
(68, 'pistazie', '2.50', 5, 'Bio,_250g'),
(69, 'weintraube_(hell)', '1.64', 1, 'Bio,_150g'),
(70, 'weintraube_(dunkel)', '1.64', 1, 'Bio,_150g'),
(71, 'kirschen', '2.45', 1, 'Bio,_Regional,_250g'),
(72, 'waasermelone', '0.94', 1, '1_Stück');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prodId`),
  ADD UNIQUE KEY `PRODID_UNIQUE` (`prodId`),
  ADD KEY `fk_products_category1_idx` (`catId`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `prodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_category1` FOREIGN KEY (`catId`) REFERENCES `category` (`catId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
