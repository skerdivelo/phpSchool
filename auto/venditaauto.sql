-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Ott 25, 2023 alle 15:30
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
-- Database: `venditaauto`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `auto`
--

CREATE TABLE `auto` (
  `id` int(11) NOT NULL,
  `marca` varchar(30) DEFAULT NULL,
  `modello` varchar(30) DEFAULT NULL,
  `allestimento` varchar(30) DEFAULT NULL,
  `anno` int(11) DEFAULT NULL,
  `chilometri` int(11) DEFAULT NULL,
  `alimentazione` varchar(10) DEFAULT NULL,
  `cambio` varchar(10) DEFAULT NULL,
  `kw` int(11) DEFAULT NULL,
  `prezzo` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `auto`
--

INSERT INTO `auto` (`id`, `marca`, `modello`, `allestimento`, `anno`, `chilometri`, `alimentazione`, `cambio`, `kw`, `prezzo`) VALUES
(1, 'Hyundai', 'i10', '1.0 MPI Prime', 2018, 67965, 'Benzina', 'Automatico', 49, '10000.00'),
(2, 'Hyundai', 'i10', '1.0 MPi PRIME', 2020, 65000, 'Benzina', 'Automatico', 49, '11900.00'),
(3, 'Audi', 'A6', '3.0 tdi quattro s-line', 2018, 63000, 'Diesel', 'Semiaut.', 160, '28900.00'),
(4, 'Land Rover', 'Discovery', 'IV3.0 tdV6 SE', 2016, 11000, 'Diesel', 'Semiaut.', 155, '27000.00'),
(5, 'Alfa Romeo', 'Giulia', '2.2 Turbodiesel', 2019, 67000, 'Diesel', 'Manuale', 100, '20000.00'),
(6, 'Alfa Romeo', 'Giulietta', '750 Quadrifoglio Verde', 2011, 130000, 'Benzina', 'Manuale', 173, '13900.00'),
(7, 'Volvo', 'XC40', 'D3 Momentum', 2019, 174338, 'Diesel', 'Automatico', 110, '21990.00'),
(8, 'Tesla', 'Model X', '100D Dual Motor', 2017, 131800, 'Elettrica', 'Automatico', 158, '54500.00'),
(9, 'Renault', 'ZOE', 'Zen R135 Flex', 2020, 23276, 'Elettrica', 'Automatico', 51, '13500.00'),
(10, 'Renault', 'Clio', 'Blue dCi 8V', 2022, 16420, 'Diesel', 'Manuale', 74, '15950.00');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `auto`
--
ALTER TABLE `auto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
