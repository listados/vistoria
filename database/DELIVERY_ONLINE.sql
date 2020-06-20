-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 25-Set-2018 às 14:24
-- Versão do servidor: 10.2.16-MariaDB
-- PHP Version: 7.1.22

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
-- Estrutura da tabela `deliveries`
--

CREATE TABLE `deliveries` (
  `deliveries_id` int(10) UNSIGNED NOT NULL,
  `deliveries_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deliveries_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deliveries_mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deliveries_value` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deliveries_cpf` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `deliveries`
--

INSERT INTO `deliveries` (`deliveries_id`, `deliveries_name`, `deliveries_phone`, `deliveries_mobile`, `deliveries_value`, `created_at`, `updated_at`, `deliveries_cpf`) VALUES
(1, 'Não', '', '', 0, '2017-12-14 00:00:00', NULL, ''),
(2, 'ANTONIO EVALDO DE SOUSA', '(85) 55666-3655', '(85) 99665-5587', 0, '2017-12-14 00:00:00', '2017-12-14 00:00:00', '526.152.513-68'),
(3, 'HELTON GASPAR', '(85) 55544-4444', '(85) 69662-5454', 0, '2017-12-14 00:00:00', NULL, '023.098.493-24'),
(4, 'CLEBER - Cledomilson', '(85) 99634-0775', '(85) 98869-5801', 0, '2018-01-24 00:00:00', NULL, '821.679.663-34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`deliveries_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `deliveries_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
