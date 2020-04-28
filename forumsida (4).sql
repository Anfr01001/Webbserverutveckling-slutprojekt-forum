-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 28 apr 2020 kl 10:33
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
(57, 37, 15, 'Ja!, jag tycker ocksÃ¥ det Ã¤r en toppenide och kÃ¶pa bil'),
(58, 37, 17, 'JA!!! Man kan inte gÃ¶ra ett bÃ¤ttre kÃ¶p');

-- --------------------------------------------------------

--
-- Tabellstruktur `posts`
--

CREATE TABLE `posts` (
  `PostID` int(30) NOT NULL,
  `skapare` int(10) NOT NULL,
  `titel` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `text` varchar(2000) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `posts`
--

INSERT INTO `posts` (`PostID`, `skapare`, `titel`, `text`) VALUES
(36, 18, 'Ã„r detta ett bra forum?', 'Ja nej det beror pÃ¥ en massa grejer. bla bla bla. men lite bra Ã¤r det vÃ¤ll ibland men jobbigt hej ho. jag vet inte vad jag ska skriva sÃ¥ jag skriver bara en massa skit'),
(37, 18, 'Ã„r det en bra ide och kÃ¶pa sin drÃ¶mbil', 'Ja sjÃ¤lvklart Ã¤r det de. Pengar Ã¤r inte vÃ¤rda nÃ¥got ;) bara gÃ¥ och kÃ¶p den. Mycket bra ide. bla bla bla bla bla. Nu mÃ¥ste jag komma pÃ¥ mer att skriva men kÃ¶pa bil Ã¤r en jÃ¤tte bra ide Ã¶ver'),
(38, 15, 'Jag Ã¤r en ny anvÃ¤ndare hÃ¤r !?!?!?', 'LÃ¶ksÃ¥s ipsum tid annat dunge hÃ¤st genom sÃ¶ka tiden, vemod tidigare frÃ¥n tre fÃ¶r denna strand, i bÃ¥de kunde dimma stora sÃ¶ka Ã¤nnu. SjÃ¤lv rÃ¤v trevnadens sÃ¥ icke i bland dÃ¤r stig annan, hela annat frÃ¥n denna annan gÃ¶ras sig strand denna om, dimma sax precis vi hela stora varit dock. Som sax hans enligt tre och hÃ¤st del, sin vid annat genom blev sitt faktor, vi verkligen nu tid precis enligt.');

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
(15, 'Andre', '$2y$10$5k3ADH0xrr36GmzDqpGckOUzNCnd8yPVJVBGMtn8qfVuwdyEMTu8K', 'Mitt lÃ¶sen Ã¤r abc123', '../html/bilder/squarecharacter.png', 1),
(16, 'Test1', '$2y$10$iwpLZXDNUDxnELo/HetEpOCUvhKyrFdI/04lzNTQavETkqVLtiK3G', 'hejhejhej', 'bilder/squarecharacter.png', 1),
(17, 'Bananen', '$2y$10$HPD0hFwmdycjTS.m8ZXw7eNF0loRhNPCHk1toqOdopz/t1q9H5yJq', 'hej hej hÃ¤r Ã¤r en ny bio mitt lÃ¶sen nu 123 tror jag', 'bilder/a.png', 1),
(18, 'Testuser', '$2y$10$7hVUnEQ74lX0CfaqTND3eudo7DMg1csrsLI1TEuyY6wf39w4V3baq', 'En mycket bra person fÃ¶r tester', 'bilder/Grass.png', 1);

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
  MODIFY `KommentarID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT för tabell `posts`
--
ALTER TABLE `posts`
  MODIFY `PostID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
