-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 03-Mar-2015 às 13:14
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bi_server`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `srs_category`
--

CREATE TABLE IF NOT EXISTS `srs_category` (
`id` int(10) unsigned NOT NULL,
  `nome` varchar(45) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `srs_category`
--

INSERT INTO `srs_category` (`id`, `nome`) VALUES
(1, 'Esmalte'),
(2, 'Lixamento'),
(3, 'Mesa Translado'),
(6, 'Conexões');

-- --------------------------------------------------------

--
-- Estrutura da tabela `srs_input`
--

CREATE TABLE IF NOT EXISTS `srs_input` (
`id` int(10) unsigned NOT NULL,
  `data` datetime NOT NULL,
  `categoria` varchar(45) CHARACTER SET utf8 NOT NULL,
  `produto` int(10) unsigned NOT NULL,
  `fornecedor` int(10) unsigned NOT NULL,
  `quantidade` int(10) unsigned NOT NULL,
  `obs` text CHARACTER SET utf8 NOT NULL,
  `num_nota` varchar(20) CHARACTER SET utf8 NOT NULL,
  `num_pedido` varchar(20) CHARACTER SET utf8 NOT NULL,
  `valor_nota` varchar(12) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `srs_input`
--

INSERT INTO `srs_input` (`id`, `data`, `categoria`, `produto`, `fornecedor`, `quantidade`, `obs`, `num_nota`, `num_pedido`, `valor_nota`) VALUES
(1, '2015-02-10 10:58:53', '1', 4, 1, 5, '', '00.0123', '45213', '12,20'),
(2, '2015-02-10 12:04:32', '2', 5, 1, 2, '', '00.8562', '41564', '500'),
(3, '2015-02-10 13:29:15', '1', 3, 1, 10, '', '00.2141', '12312', '111111111111'),
(4, '2015-02-10 13:33:00', '1', 3, 1, 0, '', '00.6594', '58453', 'DASDAS'),
(5, '2015-02-13 15:20:40', '4', 6, 1, 5, '', '234', '31213', '10,00'),
(6, '2015-03-02 15:19:30', '1', 4, 4, 2, '', '123456789', '1245123554312', '556,75');

-- --------------------------------------------------------

--
-- Estrutura da tabela `srs_output`
--

CREATE TABLE IF NOT EXISTS `srs_output` (
`id` int(10) unsigned NOT NULL,
  `data` datetime NOT NULL,
  `categoria` varchar(45) CHARACTER SET utf8 NOT NULL,
  `produto` int(10) unsigned NOT NULL,
  `retirante` int(10) unsigned NOT NULL,
  `quantidade` int(10) unsigned NOT NULL,
  `obs` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `srs_product`
--

CREATE TABLE IF NOT EXISTS `srs_product` (
`id` int(10) unsigned NOT NULL,
  `categoria` text CHARACTER SET utf8,
  `nome` text CHARACTER SET utf8 NOT NULL,
  `estoque_minimo` int(10) unsigned NOT NULL DEFAULT '0',
  `estoque_atual` int(10) unsigned NOT NULL DEFAULT '0',
  `alocacao` varchar(75) CHARACTER SET utf8 NOT NULL,
  `id_sap` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `srs_product`
--

INSERT INTO `srs_product` (`id`, `categoria`, `nome`, `estoque_minimo`, `estoque_atual`, `alocacao`, `id_sap`) VALUES
(3, '2', 'Lixa', 0, 1, 'Armário', 127),
(4, '1', 'Boina', 0, 5, 'Prateleira', 544),
(6, '4', 'Bico', 0, 5, 'Armário', 465132),
(9, '1', 'Lixa 320', 0, 0, 'Armario', 456123);

-- --------------------------------------------------------

--
-- Estrutura da tabela `srs_requester`
--

CREATE TABLE IF NOT EXISTS `srs_requester` (
`id` int(10) unsigned NOT NULL,
  `nome` text CHARACTER SET utf8 NOT NULL,
  `empresa` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `srs_requester`
--

INSERT INTO `srs_requester` (`id`, `nome`, `empresa`) VALUES
(1, 'Gabriel', 'Iveco'),
(2, 'Fernando', 'Comau');

-- --------------------------------------------------------

--
-- Estrutura da tabela `srs_supplier`
--

CREATE TABLE IF NOT EXISTS `srs_supplier` (
`id` int(10) unsigned NOT NULL,
  `nome` text CHARACTER SET utf8 NOT NULL,
  `telefone` text CHARACTER SET utf8,
  `estado` text CHARACTER SET utf8,
  `cidade` text CHARACTER SET utf8
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `srs_supplier`
--

INSERT INTO `srs_supplier` (`id`, `nome`, `telefone`, `estado`, `cidade`) VALUES
(1, 'Norton', '(31) 3124-5423', 'MG', 'Belo Horizonte'),
(2, 'Casa Progresso', '31 3773-4615', 'MG', 'Sete lagoas'),
(4, 'Conexao 3/4', '123456123', 'MG', ' Sete Lagoas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `srs_usuario`
--

CREATE TABLE IF NOT EXISTS `srs_usuario` (
`id` int(11) NOT NULL,
  `nome` varchar(15) CHARACTER SET utf8 NOT NULL,
  `senha` varchar(15) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `srs_usuario`
--

INSERT INTO `srs_usuario` (`id`, `nome`, `senha`) VALUES
(1, 'admin', 'Iveco@2015'),
(4, 'gabriel', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `srs_category`
--
ALTER TABLE `srs_category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `srs_input`
--
ALTER TABLE `srs_input`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `srs_output`
--
ALTER TABLE `srs_output`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `srs_product`
--
ALTER TABLE `srs_product`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `srs_requester`
--
ALTER TABLE `srs_requester`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `srs_supplier`
--
ALTER TABLE `srs_supplier`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `srs_usuario`
--
ALTER TABLE `srs_usuario`
 ADD PRIMARY KEY (`id`,`nome`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `srs_category`
--
ALTER TABLE `srs_category`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `srs_input`
--
ALTER TABLE `srs_input`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `srs_output`
--
ALTER TABLE `srs_output`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `srs_product`
--
ALTER TABLE `srs_product`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `srs_requester`
--
ALTER TABLE `srs_requester`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `srs_supplier`
--
ALTER TABLE `srs_supplier`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `srs_usuario`
--
ALTER TABLE `srs_usuario`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
