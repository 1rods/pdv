-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.28-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para eco
CREATE DATABASE IF NOT EXISTS `eco` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `eco`;

-- Copiando estrutura para tabela eco.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Copiando dados para a tabela eco.clientes: ~0 rows (aproximadamente)
INSERT INTO `clientes` (`id`, `username`, `password`, `email`, `phone`) VALUES
	('1', 'admin1', 'admin1', NULL, NULL),
	(NULL, 'abc', 'abc', 'abc@abc.com', 'abc');

-- Copiando estrutura para tabela eco.imagens
CREATE TABLE IF NOT EXISTS `imagens` (
  `cod` varchar(255) DEFAULT NULL,
  `titulo` varchar(25) DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `preco` varchar(50) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Copiando dados para a tabela eco.imagens: ~12 rows (aproximadamente)
INSERT INTO `imagens` (`cod`, `titulo`, `descricao`, `categoria`, `tipo`, `preco`, `link`) VALUES
	('tm402', 'TM4035', '123', 'tmac', 'cabo', '1', 'https://i.imgur.com/jLAvW4S.jpg'),
	('11', 'AT101', '123', 'corami', 'roda', '4', ' https://i.imgur.com/RJIrEC4.jpg\r\n'),
	('10', 'AT101', '123', 'corami', 'roda', '4', ' https://i.imgur.com/RJIrEC4.jpg\r\n'),
	('9', '3048', '123', 'vedox', 'coxim', '3', 'https://i.imgur.com/NNiHBhb.png'),
	('4', '3048', '123', 'vedox', 'coxim', '3', 'https://i.imgur.com/NNiHBhb.png'),
	('7', '3048', '123', 'vedox', 'coxim', '3', 'https://i.imgur.com/NNiHBhb.png'),
	('6', 'TM402', '123', 'fabreck', 'carburador', '2', ' https://i.imgur.com/KGDGW0U.png\r\n'),
	('5', 'TM402', '123', 'fabreck', 'carburador', '2', ' https://i.imgur.com/KGDGW0U.png\r\n'),
	('8', 'TM402', '123', 'fabreck', 'carburador', '2', ' https://i.imgur.com/KGDGW0U.png\r\n'),
	('3', 'TM4035', '123', 'tmac', 'cabo', '1', 'https://i.imgur.com/jLAvW4S.jpg'),
	('2', 'TM4035', '123', 'tmac', 'cabo', '1', 'https://i.imgur.com/jLAvW4S.jpg'),
	('12', 'AT101', '123', 'corami', 'roda', '4', ' https://i.imgur.com/RJIrEC4.jpg\r\n');

-- Copiando estrutura para tabela eco.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Copiando dados para a tabela eco.users: ~0 rows (aproximadamente)
INSERT INTO `users` (`id`, `username`, `password`) VALUES
	('1', 'admin', 'admin');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
