-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 10 apr 2020 kl 21:25
-- Serverversion: 10.4.6-MariaDB
-- PHP-version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `forumsida`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `kommentarer`
--

CREATE TABLE `kommentarer` (
  `KommentarID` int(100) NOT NULL,
  `PostID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `text` varchar(100) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `kommentarer`
--

INSERT INTO `kommentarer` (`KommentarID`, `PostID`, `UserID`, `text`) VALUES
(49, 8, 15, 'Top kommentar'),
(50, 9, 15, 'Lite lÃ¤ngre ned'),
(51, 31, 15, 'Mitten typ ish'),
(52, 32, 15, 'JÃ¤vligt lÃ¥ngt ner kommentar '),
(53, 33, 15, 'Och en sista kommentar pÃ¥ inlÃ¤gget lÃ¤ngst ned');

-- --------------------------------------------------------

--
-- Tabellstruktur `posts`
--

CREATE TABLE `posts` (
  `PostID` int(30) NOT NULL,
  `skapare` int(10) NOT NULL,
  `titel` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `text` varchar(200) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `posts`
--

INSERT INTO `posts` (`PostID`, `skapare`, `titel`, `text`) VALUES
(8, 15, 'Titel', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eleifend, nulla sit amet pharetra posuere, massa ex condimentum leo, a lobortis mi mi sit amet risus. Phasellus non libero in justo males'),
(9, 15, 'Titel 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eleifend, nulla sit amet pharetra posuere, massa ex condimentum leo, a lobortis mi mi sit amet risus. Phasellus non libero in justo males'),
(31, 15, 'En ny post', 'Hej hej hÃ¤r ska jag testa kommentarerna'),
(32, 15, 'En ny post', 'Hej hej hÃ¤r ska jag testa kommentarerna'),
(33, 15, 'Ett nytt fint inlÃ¤gg ', 'Fint snyggt inlÃ¤gg fÃ¶r att kolla om kommentarer fungerar');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `UserID` int(10) UNSIGNED NOT NULL,
  `username` varchar(20) COLLATE utf8_swedish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `bio` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `profilbild` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`UserID`, `username`, `password`, `bio`, `profilbild`, `status`) VALUES
(14, 'Andre2', '$2y$10$Hyf8t2HK1EFJrk.1/afSxOGFHoqt7vQSYYNDPvkM0ACLrGZipGZCK', 'abc123', '', 1),
(15, 'Andre', '$2y$10$5k3ADH0xrr36GmzDqpGckOUzNCnd8yPVJVBGMtn8qfVuwdyEMTu8K', 'Mitt lÃ¶sen Ã¤r abc123', 'kommer snart kanske ', 1),
(16, 'Test1', '$2y$10$iwpLZXDNUDxnELo/HetEpOCUvhKyrFdI/04lzNTQavETkqVLtiK3G', 'hejhejhej', 'bilder/squarecharacter.png', 1);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `kommentarer`
--
ALTER TABLE `kommentarer`
  ADD PRIMARY KEY (`KommentarID`),
  ADD KEY `PostID` (`PostID`),
  ADD KEY `UserID` (`UserID`);

--
-- Index för tabell `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`PostID`),
  ADD KEY `skapare` (`skapare`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `kommentarer`
--
ALTER TABLE `kommentarer`
  MODIFY `KommentarID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT för tabell `posts`
--
ALTER TABLE `posts`
  MODIFY `PostID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
