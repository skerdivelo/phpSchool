-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Nov 02, 2023 alle 18:00
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
-- Database: `piatti_tipici`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `ingrediente`
--

CREATE TABLE `ingrediente` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `tipologia` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `ingrediente`
--
INSERT INTO `ingrediente` (`id`, `nome`, `tipologia`) VALUES
(1, 'Pomodoro', 'Verdura'),
(2, 'Melanzana', 'Verdura'),
(3, 'Peperone', 'Verdura'),
(4, 'Cipolla', 'Verdura'),
(5, 'Olio', 'Condimento');
-- --------------------------------------------------------

--
-- Struttura della tabella `pietanza`
--

CREATE TABLE `pietanza` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `descrizione` varchar(100) DEFAULT NULL,
  `fkRegione` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `pietanza`
--
INSERT INTO `pietanza` (`id`, `nome`, `descrizione`, `fkRegione`) VALUES
(1, 'Pizza', 'Piatto tipico napoletano', 1),
(2, 'Parmigiana', 'Piatto tipico siciliano', 2),
(3, 'Orecchiette', 'Piatto tipico pugliese', 3),
(4, 'Risotto', 'Piatto tipico lombardo', 1),
(5, 'Polenta', 'Piatto tipico veneto', 2);
-- --------------------------------------------------------

--
-- Struttura della tabella `regione`
--

CREATE TABLE `regione` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `regione`
--
INSERT INTO `regione` (`id`, `nome`) VALUES
(1, 'Lombardia'),
(2, 'Veneto'),
(3, 'Puglia');

-- --------------------------------------------------------

--
-- Struttura della tabella `utilizza`
--

CREATE TABLE `utilizza` (
  `fkIngrediente` int(11) NOT NULL,
  `fkPietanza` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dump dei dati per la tabella `utilizza`
--
INSERT INTO `utilizza` (`fkIngrediente`, `fkPietanza`) VALUES
(1, 1),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(1, 5),
(2, 5),
(3, 5),
(4, 5),
(5, 5);
--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `pietanza`
--
ALTER TABLE `pietanza`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkRegione` (`fkRegione`);

--
-- Indici per le tabelle `regione`
--
ALTER TABLE `regione`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `utilizza`
--
ALTER TABLE `utilizza`
  ADD PRIMARY KEY (`fkIngrediente`,`fkPietanza`),
  ADD KEY `fkPietanza` (`fkPietanza`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `ingrediente`
--
ALTER TABLE `ingrediente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `pietanza`
--
ALTER TABLE `pietanza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `regione`
--
ALTER TABLE `regione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `pietanza`
--
ALTER TABLE `pietanza`
  ADD CONSTRAINT `pietanza_ibfk_1` FOREIGN KEY (`fkRegione`) REFERENCES `regione` (`id`);

--
-- Limiti per la tabella `utilizza`
--
ALTER TABLE `utilizza`
  ADD CONSTRAINT `utilizza_ibfk_1` FOREIGN KEY (`fkIngrediente`) REFERENCES `ingrediente` (`id`),
  ADD CONSTRAINT `utilizza_ibfk_2` FOREIGN KEY (`fkPietanza`) REFERENCES `pietanza` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
