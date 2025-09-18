-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Set-2025 às 22:57
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistemacaixa`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `operadores`
--

CREATE TABLE `operadores` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL DEFAULT '0',
  `isadmin` tinyint(4) DEFAULT 0,
  `password` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `operadores`
--

INSERT INTO `operadores` (`id`, `nome`, `isadmin`, `password`) VALUES
(1, 'pedro', 1, '$2y$10$Ez2MSOB7MxBYuYt1Y7490OlYLExVZJMOf1QFaCvQE93KESD5svy7i'),
(2, 'katia', 0, '$2y$10$J2DRrtu3BXT8zwEmcUPFbeAcjuJhAlPsXSGYO9uY/j.SG2eQGFwbq');

-- --------------------------------------------------------

--
-- Estrutura da tabela `registros`
--

CREATE TABLE `registros` (
  `id` int(11) NOT NULL,
  `dinheiro` float DEFAULT 0,
  `cartao` float DEFAULT 0,
  `criado` date NOT NULL,
  `operador_id` int(11) NOT NULL DEFAULT 0,
  `pix` float DEFAULT NULL,
  `duplicata` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `registros`
--

INSERT INTO `registros` (`id`, `dinheiro`, `cartao`, `criado`, `operador_id`, `pix`, `duplicata`) VALUES
(51, 1288, 20, '2025-09-17', 2, NULL, NULL),
(52, 211, 55, '2025-09-16', 2, 100, 201),
(53, 2000, 189.56, '2025-09-18', 2, 125.78, 124.88);

-- --------------------------------------------------------

--
-- Estrutura da tabela `saidas`
--

CREATE TABLE `saidas` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL DEFAULT '',
  `valor` varchar(50) NOT NULL DEFAULT '',
  `registro_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `saidas`
--

INSERT INTO `saidas` (`id`, `descricao`, `valor`, `registro_id`) VALUES
(2, 'vale pedro', '200', 51),
(5, 'copos', '200', 52),
(7, 'vale pedro', '1289.36', 53);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `operadores`
--
ALTER TABLE `operadores`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_registros_operadores` (`operador_id`);

--
-- Índices para tabela `saidas`
--
ALTER TABLE `saidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_saidas_operadores` (`registro_id`) USING BTREE;

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `operadores`
--
ALTER TABLE `operadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `registros`
--
ALTER TABLE `registros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de tabela `saidas`
--
ALTER TABLE `saidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `saidas`
--
ALTER TABLE `saidas`
  ADD CONSTRAINT `FK_saidas_registros` FOREIGN KEY (`registro_id`) REFERENCES `registros` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
