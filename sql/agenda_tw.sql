-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21-Jun-2018 às 20:55
-- Versão do servidor: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agenda_tw`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id_func` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ramal` int(3) NOT NULL,
  `tel1` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `tel2` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `setor` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `local` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stats` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id_func`, `nome`, `ramal`, `tel1`, `tel2`, `setor`, `local`, `email`, `stats`) VALUES
(6, 'Calebe', 202, '11967265689', NULL, 'Criação', 'Local 3', 'calebe@teamworker.com.br', 1),
(7, 'Alan', 200, '11948621793', NULL, 'Criação', 'Local 1', 'alan@teamworker.com.br', 1),
(8, 'Alvaro', 201, '11939714268', '11942689173', 'Criação', 'Local 3', 'alvaro@teamworker.com.br', 1),
(9, 'Jason', 205, '11962487931', NULL, 'Criação', 'Local 2', 'jason@teamworker.com.br', 1),
(10, 'Vitor', 206, '11911223344', NULL, 'Criação', 'Local 2', 'vitor@teamworker.com.br', 1),
(11, 'Barbara', 207, '11911223355', NULL, 'Atendimento', 'Local 1', 'barbara@teamworker.com.br', 1),
(12, 'Cae', 208, '11911223355', NULL, 'Atendimento', 'Local 1', 'cae@teamworker.com.br', 1),
(13, 'Daiane', 209, '11911223355', NULL, 'Atendimento', 'Local 1', 'daiane@teamworker.com.br', 1),
(14, 'Pedro', 210, '11911223355', NULL, 'Atendimento', 'Local 1', 'predro@teamworker.com.br', 1),
(15, 'Priscila', 211, '11911223355', NULL, 'Atendimento', 'Local 1', 'priscila@teamworker.com.br', 1),
(16, 'Sarah', 212, '11911223355', NULL, 'Atendimento', 'Local 1', 'sarah@teamworker.com.br', 1),
(17, 'Carol', 213, '11911223355', NULL, 'Criação', 'Local 1', 'carol@teamworker.com.br', 1),
(18, 'Edson', 214, '11911223355', NULL, 'Criação', 'Local 1', 'edson@teamworker.com.br', 1),
(19, 'Fabiana', 215, '11911223355', NULL, 'Criação', 'Local 1', 'fabiana@teamworker.com.br', 1),
(20, 'Marcelo', 216, '11911223355', NULL, 'Criação', 'Local 1', 'lello@teamworker.com.br', 1),
(21, 'Zanon', 217, '11911223355', NULL, 'Criação', 'Local 1', 'zanon@teamworker.com.br', 1),
(22, 'Sheila', 218, '11911223355', NULL, 'Criação', 'Local 1', 'sheila@teamworker.com.br', 1),
(23, 'Sidnei Junior', 219, '11911223355', NULL, 'Criação', 'Local 1', 'sidnei@teamworker.com.br', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id_func`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id_func` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
