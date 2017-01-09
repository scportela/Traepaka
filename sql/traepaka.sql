SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=`TRADITIONAL,ALLOW_INVALID_DATES`;

CREATE SCHEMA IF NOT EXISTS `traepaka` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;

USE `traepaka`;

DROP TABLE IF EXISTS `traepaka`.`usuario`;

CREATE TABLE `traepaka`.`usuario` (
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=INNODB;

DROP TABLE IF EXISTS `traepaka`.`articulo`;

CREATE TABLE `traepaka`.`articulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(20) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `precio` float NOT NULL,
  `foto` varchar(200) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email_usuario` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_email_usuario` FOREIGN KEY (`email_usuario`) REFERENCES `traepaka`.`usuario`(`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB;

DROP TABLE IF EXISTS `traepaka`.`chat`;

CREATE TABLE `traepaka`.`chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_articulo` int(11) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email_usuario_comprador` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_id_articulo` FOREIGN KEY (`id_articulo`) REFERENCES `traepaka`.`articulo`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_email_usuario_comprador` FOREIGN KEY (`email_usuario_comprador`) REFERENCES `traepaka`.`usuario`(`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB;

DROP TABLE IF EXISTS `traepaka`.`linea_chat`;

CREATE TABLE `traepaka`.`linea_chat` (
  `id_chat` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mensaje` varchar(1000) NOT NULL,
  `leido` tinyint(1) NOT NULL DEFAULT 0,
  `enviado_comprador` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_chat`,`id`),
  FOREIGN KEY (`id_chat`) REFERENCES chat(`id`)
) ENGINE=INNODB;

grant all privileges on traepaka.* to traepakauser@localhost identified by "traepakapass";
