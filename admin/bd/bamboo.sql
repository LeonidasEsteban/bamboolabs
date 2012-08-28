-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 15-07-2012 a las 17:23:20
-- Versión del servidor: 5.0.45
-- Versión de PHP: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `bamboo`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `admin`
-- 

CREATE TABLE `admin` (
  `idadmin` int(11) NOT NULL auto_increment,
  `nombre` varchar(50) default NULL,
  `cargo` varchar(20) default NULL,
  `login` varchar(10) default NULL,
  `password` varchar(10) default NULL,
  `privilegios` int(11) default '0',
  PRIMARY KEY  (`idadmin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Volcar la base de datos para la tabla `admin`
-- 

INSERT INTO `admin` VALUES (5, 'Ricardo Coronado Perez', 'nn', 'root', '1234', 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `suscriptores`
-- 

CREATE TABLE `suscriptores` (
  `idsuscriptores` int(11) NOT NULL auto_increment,
  `nombre` varchar(50) collate utf8_spanish_ci NOT NULL,
  `email` varchar(50) collate utf8_spanish_ci NOT NULL,
  `detalle` varchar(100) collate utf8_spanish_ci NOT NULL,
  `fecha` varchar(10) collate utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY  (`idsuscriptores`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

-- 
-- Volcar la base de datos para la tabla `suscriptores`
-- 

INSERT INTO `suscriptores` VALUES (1, 'ricardo', 'rikardo.corp@gmail.com', 'asdasd', '', 1);
INSERT INTO `suscriptores` VALUES (2, 'adsdsd', 'asdads@sdfsd.dol', '', '', 2);
INSERT INTO `suscriptores` VALUES (3, 'asdasdsd', 'asdasjyyju@dwdw.ujy', '', '', 2);
INSERT INTO `suscriptores` VALUES (4, 'add', 'asdasjyu@dwdw.ujy', '', '', 1);
INSERT INTO `suscriptores` VALUES (5, 'sdfsdf', 'tyut@dwdw.ujy', '', '', 2);
INSERT INTO `suscriptores` VALUES (6, 'ioesfid', 'cscsd@sddsf.com', '', '', 2);
INSERT INTO `suscriptores` VALUES (7, 'kjljljkjl', 'rike_keru@hotmail.es', '', '07/15/2012', 0);