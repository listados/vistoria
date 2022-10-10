-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 01-Out-2022 às 14:48
-- Versão do servidor: 5.7.33-0ubuntu0.16.04.1
-- PHP Version: 7.1.24-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `sites`
--

CREATE TABLE `sites` (
  `sites_id` int(11) NOT NULL,
  `sites_phoneFixed` varchar(25) NOT NULL,
  `sites_phoneMobile` varchar(25) NOT NULL,
  `sites_email` varchar(150) NOT NULL,
  `sites_addressMatrix` varchar(256) NOT NULL,
  `sites_numberMatrix` varchar(10) NOT NULL,
  `sites_compMatrix` varchar(25) NOT NULL,
  `sites_districtMatrix` varchar(50) NOT NULL,
  `sites_cityMatrix` varchar(50) NOT NULL,
  `sites_stateMatrix` varchar(10) NOT NULL,
  `sites_codePostalMatrix` varchar(10) NOT NULL,
  `sites_addressBranch` varchar(256) NOT NULL,
  `sites_numberBranch` varchar(10) NOT NULL,
  `sites_compBranch` varchar(25) NOT NULL,
  `sites_districtBranch` varchar(50) NOT NULL,
  `sites_cityBranch` varchar(50) NOT NULL,
  `sites_stateBranch` varchar(10) NOT NULL,
  `sites_codePostalBranch` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sites`
--

INSERT INTO `sites` (`sites_id`, `sites_phoneFixed`, `sites_phoneMobile`, `sites_email`, `sites_addressMatrix`, `sites_numberMatrix`, `sites_compMatrix`, `sites_districtMatrix`, `sites_cityMatrix`, `sites_stateMatrix`, `sites_codePostalMatrix`, `sites_addressBranch`, `sites_numberBranch`, `sites_compBranch`, `sites_districtBranch`, `sites_cityBranch`, `sites_stateBranch`, `sites_codePostalBranch`) VALUES
(1, '(85) 3461-1166', '(85) 98810-1166', 'meajuda@espindolaimobiliaria.com.br', 'Av. Santos Dumont', '2828', 'Loja 12', 'Aldeota', 'Fortaleza', 'Ceará', '60.150-161', 'Rua Monsenhor Otávio de Castro', '781', ' ', 'Fátima', 'Fortaleza', 'Ceará', '60050-150');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`sites_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `sites_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
