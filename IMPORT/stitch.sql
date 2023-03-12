-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Mrz 2023 um 22:48
-- Server-Version: 10.4.27-MariaDB
-- PHP-Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `stitch`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `contactus`
--

CREATE TABLE `contactus` (
  `ID` int(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(480) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `contactus`
--

INSERT INTO `contactus` (`ID`, `fullname`, `email`, `subject`, `message`) VALUES
(14, 'Florent Shabani', 'fs57325@ubt-uni.net', 'Ankesa per produkte', 'A little bit sunshine in my head'),
(15, 'Rrahman Avdiaj', 'ra64669@ubt-uni.net', 'Nice products', 'liked them alot!'),
(21, 'Max Mustermann', 'maxihatkleinens@gmail.com', 'Verlaengerung', 'Wie viel kostet es?'),
(26, 'Florent Shabani', 'fs57325@ubt-uni.net', 'Hellou ', 'Testing some waters');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `prodid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` varchar(100) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `user_added` varchar(100) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`prodid`, `name`, `price`, `description`, `image`, `user_added`, `date_added`) VALUES
(1, 'Sky Blue Sakko', '109.99', 'Sakko In Cotton-Spandex Blend', 'style/images/Product1.png', 'fs57325', '2023-03-12'),
(2, 'Seafoam Sakko', '89.99', 'Sakko In Cotton-Spandex Blend', 'style/images/Product4.png', 'fs57325', '2023-03-08'),
(3, 'Sky Blue Shirt', '49.99', 'Custom tailored shirt', 'style/images/Product3.png', 'fs57325', '2023-03-08'),
(4, 'Khaki Stretch', '120.00', 'Pants In Cotton-Spandex Blend', 'style/images/Product2.png', 'fs57325', '2023-03-08'),
(5, 'Midnight Stretch', '125.99', 'Pants In Cotton-Spandex Blend', 'style/images/Product6.png', 'fs57325', '2023-03-08'),
(6, 'Moon Stretch', '132.99', 'Pants In Cotton-Spandex Blend', 'style/images/Product8.png', 'fs57325', '2023-03-08'),
(7, 'Brown Stretch', '120.99', 'Pants In Cotton-Spandex Blend', 'style/images/Product9.png', 'fs57325', '2023-03-08'),
(9, 'Oxford Shoes', '307.99', 'Leather Shoes by Jacob Oxford', 'style/images/Product5.png', 'fs57325', '2023-03-12');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `ID` int(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'user',
  `emp_picture` varchar(100) DEFAULT 'no picture'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`ID`, `fullname`, `username`, `email`, `birthdate`, `password`, `role`, `emp_picture`) VALUES
(28, 'Florent Shabani', 'fs57325', 'fs57325@ubt-uni.net', '2000-11-21', '$2y$10$cyxpIb7G/eeWl/7eyzvc7ufUWVQ34aOCLZmY4UGDo/..4Gbpds8YG', 'admin', 'style/images/emp/emp2.png'),
(30, 'Rrahman Avdiaj', 'ra64669', 'ra64669@ubt-uni.net', '2000-11-21', '$2y$10$YaX.UMBGYTnUe9sSoAx8COHlqXbC7KxgEEwKyt.71hjyViTlJipse', 'employee', 'style/images/emp/emp4.png'),
(31, 'Max Mustermann', 'mm31313', 'spamming@gmail.com', '2000-11-21', '$2y$10$R/yDDGJr97nouqVttU.wfed01oNkZvEm2aNWOR4sPktTu.VMLBbaS', 'employee', 'style/images/emp/emp1.png'),
(33, 'Rrahman Avdiaj', 'ra646691', 'test@ubt-uni.net', '2000-11-21', '$2y$10$1NxJ2dfyRT1DQNALdWBXfu3ohuRIvldlGoKW3xPFaVyUPdJWPRchO', 'user', 'style/images/emp/3f77099708b4389a1e3f5ecf762cab24.png'),
(41, 'Fisteku Filan', 'ff123131', 'spamming@gmail.com', '2000-11-21', '$2y$10$XZOvX93OBiPp0B73LxKhOuZhvHVXcdDIxKPwoJcncIxY0WS0rbYLK', 'user', 'style/images/emp/unknown (1).png'),
(43, 'Kim Possible', 'km25411', 'km@gmail.com', '2001-08-12', '$2y$10$ZmAefZKbjHvhYnY/yg13lO3dG..v6jnhrRgmrmAkIplGgIKIuJZk2', 'employee', 'style/images/emp/emp3.png'),
(44, 'Ron Stewey', 'rs13131', 'ra64669@ubt-uni.net', '2000-11-22', '$2y$10$WDal2fB77X/s9XEsB7YHIexTpKUqbns0R7guHOZcKiX4Jh/hUVOZG', 'user', 'no picture');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prodid`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `unique_username` (`username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `contactus`
--
ALTER TABLE `contactus`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `prodid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
