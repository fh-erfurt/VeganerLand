-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 27. Dez 2020 um 19:18
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

--
-- Daten für Tabelle `address`
--

INSERT INTO `address` (`addressId`, `street`, `number`, `zip`, `city`) VALUES
(1, 'Döllstädtstraße, 8, 8', '2', '99423', 'Weimar'),
(2, 'teststraße', '2', '99423', 'Weimar'),
(3, 'teststraße', '1', '99423', 'Weimar'),
(4, 'teststraße', '2', '99423', 'Weimar');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `customers`
--

CREATE TABLE `customers` (
  `custId` int(11) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `email` varchar(150) NOT NULL,
  `tocken` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `addressId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `customers`
--

INSERT INTO `customers` (`custId`, `firstName`, `lastName`, `email`, `tocken`, `phone`, `gender`, `password`, `addressId`) VALUES
(1, 'Molham', 'Alkhodari', 'molhamalkhodari@gmail.com', 'WeioOF6faWYweLdaJmYqEccHN', '015731164088', 'm', '98945bca8dca8c03c8a88347417f90a2', 1),
(2, 'test404', 'test404', 'test404@gmail.com', NULL, '013332264088', NULL, '256dfa07820d7d34acbe3a41744b8e09', 2),
(3, 'test1', 'test1', 'test1@gmail.com', NULL, '013332264088', NULL, '256dfa07820d7d34acbe3a41744b8e09', 3),
(4, 'Mhd', 'Alkhodari', 'humamkhodari@gmail.com', NULL, NULL, NULL, '5e91b8770a1fce710b1fa52718cbe625', NULL),
(5, 'test999', 'test999', 'test999@gmail.com', NULL, '013332264088', 'm', '39c14e5d7f8726f694132f1f3bd7f24e', 4);

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
(1, 'Speisemöhren', 'V', '1.94'),
(2, 'Speisekartoffeln', 'V', '2.94'),
(3, 'Weißer Spargel', 'V', '0.94'),
(4, 'Helle Tafeltrauben', 'F', '1.64'),
(5, 'Heidelbeeren', 'F', '1.95'),
(6, 'Vorgereifte Avocado', 'F', '0.94'),
(7, 'Orangen', 'F', '2.00'),
(8, 'Clementinen', 'F', '1.64'),
(9, 'Mango essreif', 'F', '1.94'),
(10, 'Apfel Braeburn rot', 'F', '1.34'),
(11, 'Kaki', 'F', '0.94'),
(12, 'Avocado', 'F', '1.94'),
(13, 'Himbeere', 'B', '2.94'),
(14, 'Mandarine Bio', 'F', '1.94'),
(15, 'Galiamelone', 'F', '0.94'),
(16, 'test', 'V', '2.00');

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
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `customers`
--
ALTER TABLE `customers`
  MODIFY `custId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `prodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
