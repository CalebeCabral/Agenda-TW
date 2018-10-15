-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 09-Ago-2018 às 15:50
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
-- Database: `agendatw`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cli` int(10) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel1` varchar(11) NOT NULL,
  `tel2` varchar(11) DEFAULT NULL,
  `tel3` varchar(11) DEFAULT NULL,
  `tel4` varchar(11) DEFAULT NULL,
  `cargo` varchar(255) NOT NULL,
  `stats` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id_cli`, `nome`, `email`, `tel1`, `tel2`, `tel3`, `tel4`, `cargo`, `stats`) VALUES
(3, 'Cliente Qualquer', 'teste@teste.com', '1112345678', NULL, NULL, NULL, 'Adm', 1),
(4, 'Cliente Teste', 'cliente@teste.com', '11945612378', NULL, NULL, NULL, 'Financeiro', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecs`
--

CREATE TABLE `fornecs` (
  `id_fornec` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel1` varchar(11) NOT NULL,
  `tel2` varchar(11) DEFAULT NULL,
  `tel3` varchar(11) DEFAULT NULL,
  `tel4` varchar(11) DEFAULT NULL,
  `cargo` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `stats` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fornecs`
--

INSERT INTO `fornecs` (`id_fornec`, `nome`, `email`, `tel1`, `tel2`, `tel3`, `tel4`, `cargo`, `endereco`, `stats`) VALUES
(1, 'Teste', 'teste@teste.com.br', '11923154687', '1123456178', NULL, NULL, 'Teste', 'Rua Capitao Cavalcanti', 0),
(2, 'Fornecedor Disney', 'fornecedor@teste.com', '11945678912', NULL, NULL, NULL, 'Qualquer', 'Rua Fornecedor de Testes', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcs`
--

CREATE TABLE `funcs` (
  `id_func` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ramal` int(3) NOT NULL,
  `tel1` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `tel2` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `setor` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stats` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `funcs`
--

INSERT INTO `funcs` (`id_func`, `nome`, `ramal`, `tel1`, `tel2`, `setor`, `email`, `stats`) VALUES
(1, 'Calebe Cabral', 200, '11967265689', '1123390734', 'Criação', 'calebe@teamworker.com.br', 1),
(2, 'Teste', 200, '11945312678', NULL, 'Atendimento', 'teste@teste.com.br', 0),
(3, 'Teamworker', 300, '11915975378', NULL, 'Administrativo', 'teamworker@teamworker.com.br', 1),
(4, 'Teste', 999, '11912345678', NULL, 'Financeiro', 'teste@teste.com', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `nome` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `senha` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `nome`, `email`, `senha`) VALUES
(1, 'Administrador', 'adm@adm.com', 'senha123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cli`),
  ADD UNIQUE KEY `email_unique` (`email`);

--
-- Indexes for table `fornecs`
--
ALTER TABLE `fornecs`
  ADD PRIMARY KEY (`id_fornec`);

--
-- Indexes for table `funcs`
--
ALTER TABLE `funcs`
  ADD PRIMARY KEY (`id_func`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cli` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fornecs`
--
ALTER TABLE `fornecs`
  MODIFY `id_fornec` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `funcs`
--
ALTER TABLE `funcs`
  MODIFY `id_func` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
