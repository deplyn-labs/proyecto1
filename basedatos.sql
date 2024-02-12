-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         10.1.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

-- Volcando estructura de base de datos para proyecto1
DROP DATABASE IF EXISTS `proyecto1`;
CREATE DATABASE IF NOT EXISTS `proyecto1` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `proyecto1`;

-- Volcando estructura para tabla proyecto1.usuario
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(150) DEFAULT NULL,
  `apellidos` varchar(150) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyecto1.usuario: ~0 rows (aproximadamente)
DELETE FROM `usuario`;
