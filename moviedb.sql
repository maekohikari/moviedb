-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Vært: 127.0.0.1
-- Genereringstid: 06. 06 2017 kl. 15:42:03
-- Serverversion: 5.7.11
-- PHP-version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviedb`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `login`
--

CREATE TABLE `login` (
  `ID` int(11) NOT NULL,
  `User` varchar(255) NOT NULL,
  `Pass` varchar(255) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `login`
--

INSERT INTO `login` (`ID`, `User`, `Pass`) VALUES


-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `movie`
--

CREATE TABLE `movie` (
  `ID` int(11) NOT NULL,
  `MovieName` varchar(255) DEFAULT NULL,
  `Genre` varchar(255) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Year` int(4) DEFAULT NULL,
  `Image` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `user_inquiries`
--

CREATE TABLE `user_inquiries` (
  `inquiry_id` int(10) NOT NULL,
  `user_name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `inquiry_subject` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `inquiry_text` varchar(1500) COLLATE utf8_bin DEFAULT NULL,
  `user_email` varchar(50) COLLATE utf8_bin NOT NULL,
  `user_telephone` varchar(50) COLLATE utf8_bin NOT NULL,
  `reserv_date` varchar(50) COLLATE utf8_bin NOT NULL,
  `reserv_time` varchar(50) COLLATE utf8_bin NOT NULL,
  `persons_num` varchar(50) COLLATE utf8_bin NOT NULL,
  `placed_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','rejected','confirmed') COLLATE utf8_bin DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Data dump for tabellen `user_inquiries`
--

INSERT INTO `user_inquiries` (`inquiry_id`, `user_name`, `inquiry_subject`, `inquiry_text`, `user_email`, `user_telephone`, `reserv_date`, `reserv_time`, `persons_num`, `placed_on`, `status`) VALUES
(1, '', NULL, '', '', '', '/', ':', '', '2016-12-05 12:06:05', 'pending'),
(2, '', NULL, '', '', '', '/', ':', '', '2016-12-05 12:06:34', 'pending'),
(3, '', NULL, '', '', '', '/', ':', '', '2016-12-05 12:06:44', 'pending'),
(4, '', NULL, '', '', '', '/', ':', '', '2016-12-05 12:07:30', 'pending'),
(5, 'Jana Petersen', NULL, '', 'jana_p.93@hotmail.de', '', '11/June', '18::30', '4', '2016-12-05 12:08:09', 'pending'),
(6, '', NULL, '', '', '', '/', ':', '', '2016-12-05 18:56:13', 'pending'),
(7, 'Jana Petersen', NULL, '', 'jana_p.93@hotmail.de', '', '5/June', '19::30', '4', '2016-12-05 18:56:29', 'pending'),
(8, '', NULL, '', '', '', '/', ':', '', '2016-12-05 19:00:24', 'pending');

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks for tabel `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks for tabel `user_inquiries`
--
ALTER TABLE `user_inquiries`
  ADD PRIMARY KEY (`inquiry_id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tilføj AUTO_INCREMENT i tabel `movie`
--
ALTER TABLE `movie`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Tilføj AUTO_INCREMENT i tabel `user_inquiries`
--
ALTER TABLE `user_inquiries`
  MODIFY `inquiry_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
