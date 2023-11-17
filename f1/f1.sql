-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Nov 16, 2023 alle 19:53
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
-- Database: `f1`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `gara`
--

CREATE TABLE `gara` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `circuito` varchar(30) DEFAULT NULL,
  `giorno` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `gara`
--

INSERT INTO `gara` (`id`, `nome`, `circuito`, `giorno`) VALUES
(1, 'Gran Premio dell\'Emilia', 'Imola', '2022-04-18'),
(2, 'Gran Premio di Monaco', 'Montecarlo', '2022-05-23'),
(3, 'Gran Premio del Belgio', 'Spa Francorchamps', '2022-08-29'),
(4, 'Gran premio d\'Italia', 'Monza', '2022-09-12');

-- --------------------------------------------------------

--
-- Struttura della tabella `partecipa`
--

CREATE TABLE `partecipa` (
  `fkPilota` int(11) NOT NULL,
  `fkGara` int(11) NOT NULL,
  `posizione` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `partecipa`
--

INSERT INTO `partecipa` (`fkPilota`, `fkGara`, `posizione`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 2),
(1, 4, 2),
(2, 1, 2),
(2, 2, 4),
(2, 3, 3),
(2, 4, 4),
(3, 1, 4),
(3, 2, 3),
(3, 3, 4),
(3, 4, 3),
(4, 1, 3),
(4, 2, 2),
(4, 3, 1),
(4, 4, 1),
(5, 1, 5),
(5, 2, 6),
(5, 3, 5),
(5, 4, 5),
(6, 1, 8),
(6, 2, 8),
(6, 3, 7),
(6, 4, 7),
(7, 1, 7),
(7, 2, 7),
(7, 3, 8),
(7, 4, 8),
(8, 1, 6),
(8, 2, 5),
(8, 3, 6),
(8, 4, 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `pilota`
--

CREATE TABLE `pilota` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `cognome` varchar(20) DEFAULT NULL,
  `nato` date DEFAULT NULL,
  `nazione` varchar(3) DEFAULT NULL,
  `fkScuderia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `pilota`
--

INSERT INTO `pilota` (`id`, `nome`, `cognome`, `nato`, `nazione`, `fkScuderia`) VALUES
(1, 'Lewis', 'Hamilton', '1985-01-07', 'ENG', 2),
(2, 'Valtteri', 'Bottas', '1989-08-28', 'FIN', 2),
(3, 'Carlos', 'Sainz', '1994-09-01', 'SPA', 1),
(4, 'Charles', 'Leclerc', '1997-10-16', 'MCO', 1),
(5, 'Kimi', 'Raikkonen', '1979-10-17', 'FIN', 4),
(6, 'Antonio', 'Giovinazzi', '1993-12-14', 'ITA', 4),
(7, 'Esteban', 'Ocon', '1996-09-17', 'FRA', 3),
(8, 'Fernando', 'Alonso', '1981-07-29', 'SPA', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `scuderia`
--

CREATE TABLE `scuderia` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `nazione` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `scuderia`
--

INSERT INTO `scuderia` (`id`, `nome`, `nazione`) VALUES
(1, 'Ferrari', 'ITA'),
(2, 'Mercedes', 'GER'),
(3, 'Alpine', 'FRA'),
(4, 'Alfa Romeo', 'ITA');

-- --------------------------------------------------------

--
-- Struttura della tabella `sponsor`
--

CREATE TABLE `sponsor` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `sponsor`
--

INSERT INTO `sponsor` (`id`, `nome`) VALUES
(1, 'Eni'),
(2, 'Total'),
(3, 'Sparco'),
(4, 'AMD'),
(5, 'Epson'),
(6, 'Monster Energy'),
(7, 'Petronas'),
(8, 'Santander');

-- --------------------------------------------------------

--
-- Struttura della tabella `sponsorizza`
--

CREATE TABLE `sponsorizza` (
  `fkSponsor` int(11) NOT NULL,
  `fkScuderia` int(11) NOT NULL,
  `importo` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `sponsorizza`
--

INSERT INTO `sponsorizza` (`fkSponsor`, `fkScuderia`, `importo`) VALUES
(1, 1, '10000000.00'),
(1, 4, '2000000.00'),
(2, 3, '8000000.00'),
(3, 4, '1000000.00'),
(4, 2, '5000000.00'),
(5, 1, '2000000.00'),
(5, 2, '2000000.00'),
(6, 3, '3000000.00'),
(7, 2, '12000000.00'),
(8, 1, '10000000.00');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `gara`
--
ALTER TABLE `gara`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `partecipa`
--
ALTER TABLE `partecipa`
  ADD PRIMARY KEY (`fkPilota`,`fkGara`),
  ADD KEY `fkGara` (`fkGara`);

--
-- Indici per le tabelle `pilota`
--
ALTER TABLE `pilota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkScuderia` (`fkScuderia`);

--
-- Indici per le tabelle `scuderia`
--
ALTER TABLE `scuderia`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `sponsorizza`
--
ALTER TABLE `sponsorizza`
  ADD PRIMARY KEY (`fkSponsor`,`fkScuderia`),
  ADD KEY `fkScuderia` (`fkScuderia`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `gara`
--
ALTER TABLE `gara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `pilota`
--
ALTER TABLE `pilota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `scuderia`
--
ALTER TABLE `scuderia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `partecipa`
--
ALTER TABLE `partecipa`
  ADD CONSTRAINT `partecipa_ibfk_1` FOREIGN KEY (`fkPilota`) REFERENCES `pilota` (`id`),
  ADD CONSTRAINT `partecipa_ibfk_2` FOREIGN KEY (`fkGara`) REFERENCES `gara` (`id`);

--
-- Limiti per la tabella `pilota`
--
ALTER TABLE `pilota`
  ADD CONSTRAINT `pilota_ibfk_1` FOREIGN KEY (`fkScuderia`) REFERENCES `scuderia` (`id`);

--
-- Limiti per la tabella `sponsorizza`
--
ALTER TABLE `sponsorizza`
  ADD CONSTRAINT `sponsorizza_ibfk_1` FOREIGN KEY (`fkSponsor`) REFERENCES `sponsor` (`id`),
  ADD CONSTRAINT `sponsorizza_ibfk_2` FOREIGN KEY (`fkScuderia`) REFERENCES `scuderia` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
