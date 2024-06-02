-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Fev-2024 às 00:41
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `super_car`
--
CREATE DATABASE IF NOT EXISTS `super_car` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `super_car`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.online`
--

CREATE TABLE `tb_admin.online` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `ultima_acao` datetime NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_admin.online`
--

INSERT INTO `tb_admin.online` (`id`, `ip`, `ultima_acao`, `token`) VALUES
(442, '::1', '2024-02-10 15:21:15', '65c7be0a56b64'),
(443, '::1', '2024-02-10 15:21:30', '65c7bea630e8c'),
(444, '::1', '2024-02-12 12:34:21', '65ca3a7a3de5d'),
(445, '::1', '2024-02-12 19:12:06', '65ca977816d92'),
(446, '::1', '2024-02-12 20:10:54', '65ca97b703dca');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.usuarios`
--

CREATE TABLE `tb_admin.usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_admin.usuarios`
--

INSERT INTO `tb_admin.usuarios` (`id`, `user`, `password`, `img`, `nome`, `cargo`) VALUES
(1, 'Allan', 'admin123', 'windowns wallpaper.jpg', 'Allan Sanches', 2),
(7, 'Fnc-001', 'func001', '', 'Funcionário - 01', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.visitas`
--

CREATE TABLE `tb_admin.visitas` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `dia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_admin.visitas`
--

INSERT INTO `tb_admin.visitas` (`id`, `ip`, `dia`) VALUES
(1, '::1', '2023-08-23'),
(2, '::1', '2023-08-23'),
(4, '::1', '2023-08-31'),
(5, '::1', '2023-09-07'),
(6, '::1', '2023-09-13'),
(7, '::1', '2023-09-14'),
(8, '::1', '2023-09-16'),
(9, '::1', '2023-09-18'),
(10, '::1', '2023-09-20'),
(11, '::1', '2023-09-26'),
(12, '::1', '2023-10-10'),
(13, '::1', '2023-10-17'),
(14, '::1', '2023-10-18'),
(15, '::1', '2023-10-19'),
(16, '::1', '2023-10-19'),
(17, '::1', '2023-10-20'),
(18, '::1', '2023-10-21'),
(19, '::1', '2023-10-21'),
(20, '::1', '2023-10-23'),
(21, '::1', '2023-10-24'),
(22, '::1', '2023-10-25'),
(23, '::1', '2023-10-26'),
(24, '::1', '2023-10-27'),
(25, '::1', '2023-10-29'),
(26, '::1', '2023-10-31'),
(27, '::1', '2023-11-01'),
(28, '::1', '2023-11-03'),
(29, '::1', '2023-11-04'),
(30, '::1', '2023-11-06'),
(31, '::1', '2023-11-07'),
(32, '::1', '2023-11-09'),
(33, '::1', '2023-11-10'),
(34, '::1', '2023-11-13'),
(35, '::1', '2023-11-16'),
(36, '::1', '2023-11-17'),
(37, '::1', '2023-11-18'),
(38, '::1', '2023-11-20'),
(39, '::1', '2023-11-21'),
(40, '::1', '2023-11-24'),
(41, '::1', '2023-11-27'),
(42, '::1', '2023-11-29'),
(43, '::1', '2023-11-30'),
(44, '::1', '2023-12-02'),
(45, '::1', '2023-12-04'),
(46, '::1', '2023-12-05'),
(47, '::1', '2023-12-06'),
(48, '::1', '2023-12-06'),
(49, '::1', '2023-12-07'),
(50, '::1', '2023-12-08'),
(51, '::1', '2023-12-10'),
(52, '::1', '2023-12-12'),
(53, '::1', '2023-12-13'),
(54, '::1', '2023-12-13'),
(55, '::1', '2023-12-15'),
(56, '::1', '2023-12-16'),
(57, '::1', '2023-12-17'),
(58, '::1', '2023-12-18'),
(59, '::1', '2023-12-20'),
(60, '::1', '2023-12-21'),
(61, '::1', '2023-12-22'),
(62, '::1', '2023-12-23'),
(63, '::1', '2023-12-25'),
(64, '::1', '2023-12-26'),
(65, '::1', '2023-12-28'),
(66, '::1', '2023-12-29'),
(67, '::1', '2024-01-01'),
(68, '::1', '2024-01-02'),
(69, '::1', '2024-01-03'),
(70, '::1', '2024-01-04'),
(71, '::1', '2024-01-05'),
(72, '::1', '2024-01-06'),
(73, '::1', '2024-01-08'),
(74, '::1', '2024-01-09'),
(75, '::1', '2024-01-10'),
(76, '::1', '2024-01-11'),
(77, '::1', '2024-01-12'),
(78, '::1', '2024-01-12'),
(79, '::1', '2024-01-13'),
(80, '::1', '2024-01-14'),
(81, '::1', '2024-01-15'),
(82, '::1', '2024-01-17'),
(83, '::1', '2024-01-18'),
(84, '::1', '2024-01-19'),
(85, '::1', '2024-01-20'),
(86, '::1', '2024-01-22'),
(87, '::1', '2024-01-23'),
(88, '::1', '2024-01-24'),
(89, '::1', '2024-01-26'),
(90, '::1', '2024-01-27'),
(91, '::1', '2024-01-30'),
(92, '::1', '2024-02-01'),
(93, '::1', '2024-02-01'),
(94, '::1', '2024-02-01'),
(95, '::1', '2024-02-01'),
(96, '::1', '2024-02-01'),
(97, '::1', '2024-02-05'),
(98, '::1', '2024-02-08'),
(99, '::1', '2024-02-09'),
(100, '::1', '2024-02-10'),
(101, '::1', '2024-02-12'),
(102, '::1', '2024-02-12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.automoveis`
--

CREATE TABLE `tb_site.automoveis` (
  `id` int(11) NOT NULL,
  `id_concessionaria` int(11) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `versao` varchar(255) NOT NULL,
  `ano_fab` varchar(4) NOT NULL,
  `ano_mod` varchar(4) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `quilometragem` int(11) NOT NULL,
  `cambio` varchar(10) NOT NULL,
  `combustivel` varchar(8) NOT NULL,
  `cor` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `vendido` int(11) NOT NULL DEFAULT 0,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.automoveis`
--

INSERT INTO `tb_site.automoveis` (`id`, `id_concessionaria`, `marca`, `modelo`, `versao`, `ano_fab`, `ano_mod`, `preco`, `quilometragem`, `cambio`, `combustivel`, `cor`, `slug`, `vendido`, `order_id`) VALUES
(49, 11, 'Fiat', 'TORO', ' 2.0 16V TURBO DIESEL RANCH 4WD AT9', '2021', '2022', '149500.00', 12300, '0', '1', 'Cinza', 'toro-2.0-16v-turbo-diesel-ranch-4wd-at9', 0, 49),
(51, 10, 'Peugeot', '3008', '1.6 16V THP GASOLINA GT PACK AUTOMÁTICO', '2022', '2023', '250300.00', 1098, '0', '0', 'Branco', '3008-1.6-16v-thp-gasolina-gt-pack-automatico', 0, 51),
(58, 11, 'Ford', 'RANGER', '2.2 XLS 4X4 CD 16V DIESEL 4P AUTOMÁTICO', '2020', '2021', '150000.00', 109420, '0', '1', 'Branco', 'territory-1.5-ecoboost-gtdi-gasolina-titanium-automatico', 0, 58),
(59, 10, 'Volkswagen', 'JETTA', '1.4 250 TSI TOTAL FLEX COMFORTLINE TIPTRONIC', '2019', '2020', '100900.00', 40125, '0', '2', 'Branco', 'civic-2.0-16v-flexone-sport-4p-cvt', 0, 59),
(60, 11, 'Renault', 'KWID', '1.0 12V SCE FLEX ZEN MANUAL', '2022', '2023', '60250.00', 15700, '1', '2', 'Prata', 'kwid-1.0-12v-sce-flex-intense-manual', 0, 60),
(61, 11, 'Bmw', 'X1', '2.0 16V TURBO ACTIVEFLEX XDRIVE25I SPORT 4P AUTOMÁTICO', '2018', '2018', '155500.00', 64386, '0', '2', 'Preto', 'x1-2.0-16v-turbo-activeflex-xdrive25i-sport-4p-automatico', 0, 61),
(62, 10, 'Chevrolet', 'ONIX', '1.0 FLEX LT MANUAL', '2022', '2022', '71500.00', 61230, '1', '2', 'Vermelho escuro', 'onix-1.0-flex-lt-manual', 0, 62),
(63, 11, 'Fiat', 'STRADA', '1.3 FIREFLY FLEX VOLCANO CD MANUAL', '2021', '2022', '101500.00', 22367, '1', '2', 'Vermelho', 'strada-1.3-firefly-flex-volcano-cd-manual', 0, 63),
(64, 10, 'Audi', 'Q3', '1.4 TFSI AMBITION FLEX 4P S TRONIC', '2018', '2018', '116900.00', 69543, '0', '2', 'Prata', 'q3-1.4-tfsi-ambition-flex-4p-s-tronic', 0, 64),
(65, 10, 'Citroën', 'C4 CACTUS', '1.6 VTI 120 FLEX FEEL EAT6', '2021', '2022', '85000.00', 45270, '0', '2', 'Vermelho', 'c4-cactus-1.6-vti-120-flex-feel-eat6', 0, 65),
(67, 11, 'Fiat', 'FASTBACK', '1.3 TURBO 270 FLEX LIMITED EDITION AT6', '2022', '2023', '136900.00', 13090, '0', '2', 'Vermelho', 'fastback-1.3-turbo-270-flex-limited-edition-at6', 0, 67),
(68, 10, 'Peugeot', '208', '1.0 FIREFLY FLEX STYLE MANUAL', '2023', '2024', '100000.00', 90, '1', '2', 'Azul', '208-1.0-firefly-flex-style-manual', 0, 68);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.clientes`
--

CREATE TABLE `tb_site.clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.clientes`
--

INSERT INTO `tb_site.clientes` (`id`, `nome`, `email`, `senha`, `img`) VALUES
(47, 'Allan Sanches', 'allanterzisanches@gmail.com', '1grupochonps', '65c7a56dc527c.jpg'),
(48, 'Recrutador', 'recrutador@gmail.com', 'recanoni321', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.concessionarias`
--

CREATE TABLE `tb_site.concessionarias` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `fone` varchar(14) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.concessionarias`
--

INSERT INTO `tb_site.concessionarias` (`id`, `nome`, `cnpj`, `fone`, `logo`, `slug`, `order_id`) VALUES
(10, 'Autoeste', '88.713.582/0001-02', '(41) 8998-8429', 'autoeste.png', 'athena', 1),
(11, 'AutoFoz', '42.957.393/0001-76', '(41) 2166-8926', 'autofoz.jpg', 'auto-alpha', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.config`
--

CREATE TABLE `tb_site.config` (
  `titulo` varchar(50) NOT NULL,
  `titulo_msg_banner` varchar(50) NOT NULL,
  `msg_banner` varchar(100) NOT NULL,
  `descricao1` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.config`
--

INSERT INTO `tb_site.config` (`titulo`, `titulo_msg_banner`, `msg_banner`, `descricao1`) VALUES
('SuperCar', 'A sua jornada começa conosco', 'Encontre o veículo <b>perfeito</b> para você', 'Automóveis de procedência você encontra aqui');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.imagens_automoveis`
--

CREATE TABLE `tb_site.imagens_automoveis` (
  `id` int(11) NOT NULL,
  `automovel_id` int(11) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.imagens_automoveis`
--

INSERT INTO `tb_site.imagens_automoveis` (`id`, `automovel_id`, `imagem`, `order_id`) VALUES
(57, 49, '656e0f5242fa6.jpg', 1),
(61, 51, '656e330de3793.jpg', 1),
(64, 49, '656e48ee92152.jpg', 2),
(71, 61, '657398c0aec62.jpg', 1),
(72, 49, '65789ce07dcbf.jpg', 3),
(73, 49, '65789cecb0a29.jpg', 4),
(74, 49, '65789cecb0bc6.jpg', 6),
(75, 49, '65789cecb0d16.jpg', 5),
(76, 51, '65b2678ade334.jpg', 3),
(77, 51, '65b2678ade480.jpg', 4),
(78, 51, '65b2678ade588.jpg', 5),
(79, 51, '65b2678ade6b1.jpg', 2),
(80, 51, '65b2678ade78a.jpg', 6),
(86, 62, '65b2722d5f43a.jpg', 5),
(87, 62, '65b2722d5f5de.jpg', 4),
(88, 62, '65b2722d5f6f1.jpg', 2),
(89, 62, '65b2722d5f83b.jpg', 3),
(90, 62, '65b2722d5f99f.jpg', 1),
(91, 63, '65b2774cdb6d5.jpg', 5),
(92, 63, '65b2774cdb8f8.jpg', 3),
(93, 63, '65b2774cdba5e.jpg', 2),
(94, 63, '65b2774cdbb6a.jpg', 4),
(95, 63, '65b2774cdbc9e.jpg', 1),
(96, 58, '65b2921c7a77d.jpg', 1),
(97, 58, '65b2921c7e730.jpg', 5),
(98, 58, '65b2921c7e86d.jpg', 4),
(99, 58, '65b2921c7e98d.jpg', 2),
(100, 58, '65b2921c7eaa4.jpg', 3),
(106, 61, '65b294b590bc4.jpg', 6),
(107, 61, '65b294b590d58.jpg', 5),
(108, 61, '65b294b590e44.jpg', 4),
(109, 61, '65b294b590f44.jpg', 2),
(110, 61, '65b294b59107c.jpg', 3),
(111, 59, '65b297c79b5bc.jpg', 5),
(112, 59, '65b297c79b72f.jpg', 2),
(113, 59, '65b297c79b832.jpg', 3),
(114, 59, '65b297c79b919.jpg', 4),
(116, 59, '65b2980328fc5.jpg', 1),
(117, 60, '65b29a4a62ac9.jpg', 5),
(118, 60, '65b29a4a62c6b.jpg', 2),
(119, 60, '65b29a4a62d8f.jpg', 3),
(120, 60, '65b29a4a62ee3.jpg', 4),
(121, 60, '65b29a4a65bda.jpg', 1),
(122, 64, '65b29d746ca7a.jpg', 1),
(123, 64, '65b29d746cc81.jpg', 5),
(124, 64, '65b29d746cde9.jpg', 3),
(125, 64, '65b29d746ced8.jpg', 2),
(126, 64, '65b29d746d032.jpg', 4),
(127, 65, '65b29f69d5831.jpg', 1),
(128, 65, '65b29f69d59a0.jpg', 5),
(129, 65, '65b29f69d5aa8.jpg', 6),
(130, 65, '65b29f69d5baa.jpg', 4),
(131, 65, '65b29f69df086.jpg', 2),
(132, 65, '65b29f69df1ce.jpg', 3),
(139, 67, '65b2a3cf3e35c.jpg', 5),
(140, 67, '65b2a3cf3e4d9.jpg', 6),
(141, 67, '65b2a3cf46ae8.jpg', 3),
(142, 67, '65b2a3cf46c30.jpg', 2),
(143, 67, '65b2a3cf46d48.jpg', 4),
(144, 67, '65b2a3cf46e3f.jpg', 1),
(145, 68, '65b2a84b2888e.jpg', 1),
(146, 68, '65b2a84b289fc.jpg', 6),
(147, 68, '65b2a84b28ac1.jpg', 5),
(148, 68, '65b2a84b28bf9.jpg', 3),
(149, 68, '65b2a84b28d1f.jpg', 2),
(150, 68, '65b2a84b28e45.jpg', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.slides`
--

CREATE TABLE `tb_site.slides` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slide` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_site.slides`
--

INSERT INTO `tb_site.slides` (`id`, `nome`, `slide`, `order_id`) VALUES
(1, 'Automóvel - 1', 'banner.jpg', 1),
(2, 'Automóvel - 2', 'banner2.jpg', 2),
(3, 'Automóvel - 3', 'banner3.jpeg', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.vendas`
--

CREATE TABLE `tb_site.vendas` (
  `id` int(11) NOT NULL,
  `id_automovel` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `data_pedido` date NOT NULL,
  `data_venda` date DEFAULT NULL,
  `status_venda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_admin.online`
--
ALTER TABLE `tb_admin.online`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_admin.usuarios`
--
ALTER TABLE `tb_admin.usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_admin.visitas`
--
ALTER TABLE `tb_admin.visitas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.automoveis`
--
ALTER TABLE `tb_site.automoveis`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.clientes`
--
ALTER TABLE `tb_site.clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.concessionarias`
--
ALTER TABLE `tb_site.concessionarias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.imagens_automoveis`
--
ALTER TABLE `tb_site.imagens_automoveis`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.slides`
--
ALTER TABLE `tb_site.slides`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.vendas`
--
ALTER TABLE `tb_site.vendas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_admin.online`
--
ALTER TABLE `tb_admin.online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=447;

--
-- AUTO_INCREMENT de tabela `tb_admin.usuarios`
--
ALTER TABLE `tb_admin.usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tb_admin.visitas`
--
ALTER TABLE `tb_admin.visitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de tabela `tb_site.automoveis`
--
ALTER TABLE `tb_site.automoveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de tabela `tb_site.clientes`
--
ALTER TABLE `tb_site.clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de tabela `tb_site.concessionarias`
--
ALTER TABLE `tb_site.concessionarias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `tb_site.imagens_automoveis`
--
ALTER TABLE `tb_site.imagens_automoveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT de tabela `tb_site.slides`
--
ALTER TABLE `tb_site.slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_site.vendas`
--
ALTER TABLE `tb_site.vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
