-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 22-Jun-2018 às 20:12
-- Versão do servidor: 10.2.15-MariaDB
-- PHP Version: 7.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u982331984_sisea`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `lease_guarantees`
--

CREATE TABLE `lease_guarantees` (
  `lease_guarantees_id` int(11) NOT NULL,
  `lease_guarantees_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `lease_guarantees`
--

INSERT INTO `lease_guarantees` (`lease_guarantees_id`, `lease_guarantees_name`, `created_at`, `updated_at`) VALUES
(1, 'Aluguel antecipado', '2017-10-04 12:26:45', '2017-10-04 12:26:48'),
(2, 'Capitalização', '2017-10-04 12:27:11', '2017-10-04 12:27:16'),
(3, 'Carta Fiança', '2017-10-04 12:27:11', '2017-10-04 12:27:33'),
(4, 'Caução', '2017-10-04 12:27:11', '2017-10-04 12:27:49'),
(5, 'Fiador', '2017-10-04 12:27:11', '2017-10-04 12:28:00'),
(6, 'Seguro Fiança', '2017-10-04 12:27:11', '2017-10-04 12:28:13'),
(7, 'Fiança empresarial', '2017-10-04 12:27:11', '2017-10-04 12:28:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lease_guarantees`
--
ALTER TABLE `lease_guarantees`
  ADD PRIMARY KEY (`lease_guarantees_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lease_guarantees`
--
ALTER TABLE `lease_guarantees`
  MODIFY `lease_guarantees_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
