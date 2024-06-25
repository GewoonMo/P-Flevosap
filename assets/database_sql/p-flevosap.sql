-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 25 dec 2022 om 19:32
-- Serverversie: 10.4.21-MariaDB
-- PHP-versie: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `p-flevosap`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customer`
--

CREATE TABLE `customer` (
  `customerID` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `phoneNumber` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `houseNumber` int(50) NOT NULL,
  `postalCode` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `customer`
--

INSERT INTO `customer` (`customerID`, `userid`, `name`, `lastname`, `phoneNumber`, `street`, `houseNumber`, `postalCode`, `status`) VALUES
(1, 5, 'Mohammed', 'EL Malki', '06398234327', 'Willemjanstraat ', 67657, '1067CE', 1),
(2, 4, 'Dennis', 'c', '0644445768', 'jan everten straat', 173, '1067DE', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order`
--

CREATE TABLE `order` (
  `orderID` int(11) NOT NULL,
  `customerID` int(100) NOT NULL,
  `shipID` int(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `shippingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `order`
--

INSERT INTO `order` (`orderID`, `customerID`, `shipID`, `status`, `orderDate`, `shippingDate`) VALUES
(2, 1, 1, '1', '2022-12-25 18:22:31', '2022-12-25 18:22:31');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orderedproduct`
--

CREATE TABLE `orderedproduct` (
  `orderedProductID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `orderedproduct`
--

INSERT INTO `orderedproduct` (`orderedProductID`, `productID`, `quantity`) VALUES
(2, 2, 5);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `productCategoryID` int(11) NOT NULL,
  `productname` varchar(100) NOT NULL,
  `price` double(5,2) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`productID`, `productCategoryID`, `productname`, `price`, `image`) VALUES
(1, 1, 'Appel Cassis', 10.00, 'Assortimentslider-appel-cassis.png'),
(2, 1, 'Appel', 3.00, 'Assortimentslider-appel.png');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `productcategory`
--

CREATE TABLE `productcategory` (
  `categoryID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `productcategory`
--

INSERT INTO `productcategory` (`categoryID`, `name`) VALUES
(1, 'Vruchtensap'),
(2, 'Groentesap');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_uid` tinytext NOT NULL,
  `users_pwd` longtext NOT NULL,
  `users_email` tinytext NOT NULL,
  `emailVerified` tinyint(1) NOT NULL,
  `rol` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`users_id`, `users_uid`, `users_pwd`, `users_email`, `emailVerified`, `rol`) VALUES
(1, 'a7a', '$2y$10$OwLe9QG8i/vZjbwmQga/jedS57hFES4kuMa92S7OgFfrmBtjeKk6q', 'luca@gmail.com', 0, ''),
(2, 'luca', '$2y$10$/XKUX4BmF7tD.zPBoDAdCOiBIkMbUctUrLpE3FW9Gr8beFtMHRoXa', 'red@live.nl', 0, ''),
(4, 'dennis', '$2y$10$n1IJYme36JuoDUYOdfWPaeECz4e5NHl1480jlnv5cZBiWrHHA8r36', 'ss@ziggo.nl', 1, ''),
(5, 'Mohammed', '$2y$10$71SO/IohxNdDRseRuE9Ht.A9JlIO8dXVc.Ts.q6ZKqLAsK.ImbxuG', 'mohammedel111111@outlook.com', 1, '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `warehouse`
--

CREATE TABLE `warehouse` (
  `wareHouseID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `warehouse`
--

INSERT INTO `warehouse` (`wareHouseID`, `orderID`) VALUES
(1, 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`),
  ADD KEY `userid` (`userid`);

--
-- Indexen voor tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `shipID` (`shipID`),
  ADD KEY `customerID_2` (`customerID`),
  ADD KEY `shipID_2` (`shipID`);

--
-- Indexen voor tabel `orderedproduct`
--
ALTER TABLE `orderedproduct`
  ADD KEY `productID` (`productID`),
  ADD KEY `orderedProductID` (`orderedProductID`);

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `productCategoryID` (`productCategoryID`);

--
-- Indexen voor tabel `productcategory`
--
ALTER TABLE `productcategory`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- Indexen voor tabel `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`wareHouseID`),
  ADD KEY `orderID` (`orderID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `order`
--
ALTER TABLE `order`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `productcategory`
--
ALTER TABLE `productcategory`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `wareHouseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`shipID`) REFERENCES `warehouse` (`wareHouseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `orderedproduct`
--
ALTER TABLE `orderedproduct`
  ADD CONSTRAINT `orderedproduct_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderedproduct_ibfk_2` FOREIGN KEY (`orderedProductID`) REFERENCES `order` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`productCategoryID`) REFERENCES `productcategory` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
