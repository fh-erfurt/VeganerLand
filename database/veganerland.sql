-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 28. Dez 2020 um 15:20
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
-- Tabellenstruktur für Tabelle `address`
--

CREATE TABLE `address` (
  `addressId` int(11) NOT NULL,
  `street` varchar(45) NOT NULL,
  `number` varchar(45) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `city` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `customers`
--

CREATE TABLE `customers` (
  `custId` int(11) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `addressId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `favorits`
--

CREATE TABLE `favorits` (
  `prodId` int(11) NOT NULL,
  `custId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orderitems`
--

CREATE TABLE `orderitems` (
  `itemId` int(11) NOT NULL,
  `prodId` int(11) NOT NULL,
  `qyt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `custId` int(11) NOT NULL,
  `orderDate` datetime NOT NULL DEFAULT current_timestamp(),
  `shipDate` timestamp NULL DEFAULT NULL,
  `addressId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `prodId` int(11) NOT NULL,
  `descrip` varchar(50) NOT NULL,
  `cat` char(1) NOT NULL,
  `stdPrice` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`prodId`, `descrip`, `cat`, `stdPrice`) VALUES
(1, 'karotten', 'V', '1.94'),
(2, 'kartoffeln', 'V', '2.94'),
(3, 'lauchzwiebel', 'V', '0.94'),
(4, 'trauben-hell', 'F', '1.64'),
(5, 'heidelbeeren', 'F', '1.95'),
(6, 'avocado', 'F', '0.94'),
(7, 'orangen', 'F', '2.00'),
(8, 'clementine', 'F', '1.64'),
(9, 'mango', 'F', '1.94'),
(10, 'apfel-grün', 'F', '1.34'),
(11, 'kaki', 'F', '0.94'),
(12, 'aprikosen', 'F', '0.89'),
(13, 'himbeere', 'F', '2.94'),
(14, 'ananas', 'F', '1.94'),
(15, 'wassermelone', 'F', '0.94'),
(16, 'apfel-rot', 'F', '1.54'),
(19, 'banana', 'F', '0.76'),
(20, 'birne', 'F', '1.45'),
(21, 'aubergine', 'V', '2.47'),
(22, 'blumenkohl', 'V', '1.36'),
(23, 'erdbeeren', 'F', '4.80'),
(24, 'granatapfel', 'F', '2.35'),
(25, 'broccoli', 'V', '1.36'),
(26, 'champignons', 'V', '4.37'),
(27, 'grapefruit', 'F', '6.75'),
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
(40, 'süsskartoffeln', 'V', '3.76'),
(41, 'tomaten', 'V', '1.20'),
(42, 'zucchini', 'V', '0.56'),
(43, 'zwiebeln', 'V', '6.73');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressId`);

--
-- Indizes für die Tabelle `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`custId`),
  ADD UNIQUE KEY `CUSTID_UNIQUE` (`custId`),
  ADD UNIQUE KEY `EMAIL_UNIQUE` (`email`),
  ADD KEY `fk_CUSTOMER_address1_idx` (`addressId`);

--
-- Indizes für die Tabelle `favorits`
--
ALTER TABLE `favorits`
  ADD KEY `fk_favoriten_products1_idx` (`prodId`),
  ADD KEY `fk_favorits_customers1_idx` (`custId`);

--
-- Indizes für die Tabelle `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`itemId`),
  ADD UNIQUE KEY `ITEMID_UNIQUE` (`itemId`),
  ADD KEY `fk_ORDERITEMS_PRODUCTS_idx` (`prodId`);

--
-- Indizes für die Tabelle `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD UNIQUE KEY `ORDERID_UNIQUE` (`orderId`),
  ADD KEY `fk_ORDERS_ORDERITEMS1_idx` (`itemId`),
  ADD KEY `fk_ORDERS_CUSTOMER1_idx` (`custId`),
  ADD KEY `fk_ORDERS_address1_idx` (`addressId`);

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
-- AUTO_INCREMENT für Tabelle `address`
--
ALTER TABLE `address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `customers`
--
ALTER TABLE `customers`
  MODIFY `custId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `prodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `fk_CUSTOMER_address1` FOREIGN KEY (`addressId`) REFERENCES `address` (`addressId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `favorits`
--
ALTER TABLE `favorits`
  ADD CONSTRAINT `fk_favoriten_products1` FOREIGN KEY (`prodId`) REFERENCES `products` (`prodId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_favorits_customers1` FOREIGN KEY (`custId`) REFERENCES `customers` (`custId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `fk_ORDERITEMS_PRODUCTS` FOREIGN KEY (`prodId`) REFERENCES `products` (`prodId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_ORDERS_CUSTOMER1` FOREIGN KEY (`custId`) REFERENCES `customers` (`custId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ORDERS_ORDERITEMS1` FOREIGN KEY (`itemId`) REFERENCES `orderitems` (`itemId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ORDERS_address1` FOREIGN KEY (`addressId`) REFERENCES `address` (`addressId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
