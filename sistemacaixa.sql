-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Set-2025 às 21:31
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
  `operador_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `registros`
--

INSERT INTO `registros` (`id`, `dinheiro`, `cartao`, `criado`, `operador_id`) VALUES
(25, 100, 200.85, '2025-09-10', 1),
(30, 0, 0, '2025-09-11', 1),
(31, 0, 0, '2025-09-13', 1),
(32, 0, 0, '2025-09-24', 1),
(33, 0, 0, '2025-09-24', 1),
(34, 0, 0, '2025-09-26', 1),
(35, 0, 0, '2025-09-28', 1),
(36, 0, 0, '2025-09-29', 1),
(37, 1285, 100, '2025-09-30', 1),
(38, 100, 200, '2025-09-11', 2),
(39, 5850.75, 2885.1, '2025-09-12', 1),
(40, 125, 200, '2025-09-16', 1),
(41, 21, 2000, '2025-09-16', 2),
(42, 1589, 2000, '2025-09-17', 2);

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
(1, 'testando', '125.99', 35),
(2, 'teste', '200.66', 37),
(3, 'vale pedro', '100', 37),
(4, 'VALE mIGUEL', '150.88', 37),
(6, 'vale pedro', '1289.36', 25),
(7, 'vale pedro', '200', 38),
(8, 'copos', '20.88', 38),
(9, 'vale pedro', '150', 37),
(16, 'vale Kátia', '1000', 37),
(17, 'vale teste', '200.89', 39),
(18, 'copos para bag', '25.88', 39),
(19, 'conserto kia 2013', '5977.89', 39),
(20, 'conserto computadores', '189.9', 39),
(22, 'teste2', '2.88', 40),
(23, 'Água', '15', 38),
(24, 'conserto kia', '600.78', 38),
(25, 'copos descartáveis', '25.89', 41),
(26, 'material banheiro', '50', 41),
(27, 'conserto impressora', '100', 41),
(29, 'teste', '200.66', 41),
(31, 'vale pedro', '100', 41),
(32, 'vale pedro2', '150', 41),
(40, 'vale pedro', '200.66', 42);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `saidas`
--
ALTER TABLE `saidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
