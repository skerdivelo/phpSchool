-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Ott 19, 2023 alle 16:30
-- Versione del server: 10.1.38-MariaDB
-- Versione PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `italia`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `citta`
--

CREATE TABLE `citta` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `abitanti` int(11) DEFAULT NULL,
  `fkRegione` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `citta`
--

INSERT INTO `citta` (`id`, `nome`, `abitanti`, `fkRegione`) VALUES
(1, 'Milano', 3241813, 1),
(2, 'Brescia', 1255079, 1),
(3, 'Bergamo', 1105452, 1),
(4, 'Verona', 923712, 2),
(5, 'Venezia', 853338, 2),
(6, 'Bari', 1594109, 3),
(7, 'Lecce', 770078, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `comuni`
--

CREATE TABLE `comuni` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `abitanti` int(11) DEFAULT NULL,
  `fkCitta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `comuni`
--

INSERT INTO `comuni` (`id`, `nome`, `abitanti`, `fkCitta`) VALUES
(1, 'Flero', 8810, 2),
(2, 'Lumezzane', 22510, 2),
(3, 'Rezzato', 13470, 2),
(4, 'Sesto San Giovanni', 78884, 1),
(5, 'Cinisello Balsamo', 74564, 1),
(6, 'Treviglio', 30683, 3),
(7, 'Dalmine', 23316, 3),
(8, 'Legnago', 25336, 4),
(9, 'San Bonifacio', 21418, 4),
(10, 'Jesolo', 26558, 5),
(11, 'Portogruaro', 24314, 5),
(12, 'Altamura', 69800, 6),
(13, 'Monopoli', 47998, 6),
(14, 'Gallipoli', 19493, 7),
(15, 'Porto Cesareo', 6334, 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `regioni`
--

CREATE TABLE `regioni` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `zona` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `regioni`
--

INSERT INTO `regioni` (`id`, `nome`, `zona`) VALUES
(1, 'Lombardia', 'Nord'),
(2, 'Veneto', 'Nord'),
(3, 'Puglia', 'Sud');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `citta`
--
ALTER TABLE `citta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkRegione` (`fkRegione`);

--
-- Indici per le tabelle `comuni`
--
ALTER TABLE `comuni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkCitta` (`fkCitta`);

--
-- Indici per le tabelle `regioni`
--
ALTER TABLE `regioni`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `citta`
--
ALTER TABLE `citta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `comuni`
--
ALTER TABLE `comuni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `regioni`
--
ALTER TABLE `regioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `citta`
--
ALTER TABLE `citta`
  ADD CONSTRAINT `citta_ibfk_1` FOREIGN KEY (`fkRegione`) REFERENCES `regioni` (`id`);

--
-- Limiti per la tabella `comuni`
--
ALTER TABLE `comuni`
  ADD CONSTRAINT `comuni_ibfk_1` FOREIGN KEY (`fkCitta`) REFERENCES `citta` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
