
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-03-2015 a las 02:20:00
-- Versión del servidor: 5.1.69
-- Versión de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `u631612768_agend`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE IF NOT EXISTS `carrera` (
  `idcarrera` int(4) NOT NULL AUTO_INCREMENT,
  `Nombrecarrera` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `Cantidadanios` int(3) NOT NULL,
  `Cantidadcom` int(3) NOT NULL,
  PRIMARY KEY (`idcarrera`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`idcarrera`, `Nombrecarrera`, `Cantidadanios`, `Cantidadcom`) VALUES
(1, 'Ing. en sistemas de inf.', 5, 4),
(2, 'Ing. Electromecanica', 5, 2),
(3, 'Ing. Quimica', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregados`
--

CREATE TABLE IF NOT EXISTS `entregados` (
  `identrega` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` int(11) NOT NULL,
  `Tarea` int(11) NOT NULL,
  `Fechaentrega` date NOT NULL,
  `Verificado` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`identrega`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `entregados`
--

INSERT INTO `entregados` (`identrega`, `Usuario`, `Tarea`, `Fechaentrega`, `Verificado`) VALUES
(12, 1, 4, '2015-03-18', 'SI'),
(11, 6, 2, '2015-03-18', 'NO'),
(10, 6, 3, '2015-03-18', 'NO'),
(9, 7, 12, '2015-03-18', 'NO'),
(8, 19, 11, '2015-03-18', 'NO'),
(7, 12, 12, '2015-03-18', 'SI'),
(13, 1, 1, '2015-03-18', 'NO'),
(14, 13, 10, '2015-03-18', 'NO'),
(15, 9, 12, '2015-03-18', 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE IF NOT EXISTS `materias` (
  `idmateria` int(8) NOT NULL AUTO_INCREMENT,
  `Nombremateria` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `Abrevmateria` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Carrera` int(4) NOT NULL,
  `Anio` int(2) NOT NULL,
  PRIMARY KEY (`idmateria`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`idmateria`, `Nombremateria`, `Abrevmateria`, `Carrera`, `Anio`) VALUES
(1, 'Algebra y geometria analitica', 'Algeb. y geom. anal.', 1, 1),
(2, 'Analisis matematico I', 'Anal. mat.I', 1, 1),
(3, 'Sistemas de representacion', 'Sist. de repr.', 1, 1),
(4, 'Matematica discreta', 'Mat. discr.', 1, 1),
(5, 'Algoritmos y estructura de datos', 'Alg. y estr. de dat.', 1, 1),
(6, 'Arquitectura de computadoras', 'Arquit. de comp.', 1, 1),
(7, 'Sistemas y organizaciones', 'Sist. y organ.', 1, 1),
(8, 'Fisica I', 'Fisica I', 1, 1),
(9, 'Química', 'Química', 1, 2),
(10, 'Análisis Matemático II', 'An. Mat. II', 1, 2),
(11, 'Física II', 'Física II', 1, 2),
(12, 'Análisis de Sistemas', 'An. de Sist.', 1, 2),
(13, 'Sintaxis y Semántica de los Lenguajes', 'Sint. y Sem. de Leng.', 1, 2),
(14, 'Paradigmas de Programación', 'Parad. de Progr.', 1, 2),
(15, 'Sistemas Operativos', 'Sist. Operativos', 1, 2),
(16, 'Sistemas de Representación', 'Sist. de Repr.', 1, 2),
(17, 'Probabilidades y Estadísticas', 'Prob. y Est.', 1, 3),
(18, 'Diseño de Sistemas', 'Dis. de Sist.', 1, 3),
(19, 'Comunicaciones', 'Comunicaciones', 1, 3),
(20, 'Matemática Superior', 'Mat. Sup.', 1, 3),
(21, 'Gestión de Datos', 'Gest. Datos', 1, 3),
(22, 'Ingeniería y Sociedad', 'Ing. y Soc.', 1, 3),
(23, 'Economía', 'Economía', 1, 3),
(24, 'Inglés II', 'Inglés II', 1, 3),
(25, 'Redes de Información', 'Red. de Inf.', 1, 4),
(26, 'Administración de Recursos', 'Adm. de Rec.', 1, 4),
(27, 'Investigación Operativa', 'Inv. Oper.', 1, 4),
(28, 'Simulación', 'Simulación', 1, 4),
(29, 'Ingeniería de Software', 'Ing. de Soft.', 1, 4),
(30, 'Teoría de Control', 'Teor. de Cont.', 1, 4),
(31, 'Legislación', 'Legislación', 1, 4),
(32, 'Proyecto Final', 'Proy. Final', 1, 5),
(33, 'Inteligencia Artificial', 'Intel. Artif.', 1, 5),
(34, 'Administración Gerencial', 'Admin.Gerencial', 1, 5),
(35, 'Sistemas de Gestión', 'Sist. de Gest.', 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notasinicio`
--

CREATE TABLE IF NOT EXISTS `notasinicio` (
  `idnota` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idnota`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `notasinicio`
--

INSERT INTO `notasinicio` (`idnota`, `idusuario`) VALUES
(4, 1),
(5, 4),
(6, 3),
(7, 5),
(8, 6),
(9, 7),
(10, 8),
(11, 9),
(12, 10),
(13, 11),
(14, 12),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20),
(21, 22),
(22, 23),
(23, 13),
(24, 2),
(25, 25),
(26, 24),
(27, 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE IF NOT EXISTS `notificaciones` (
  `idnotificacion` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idtarea` int(11) NOT NULL,
  `idmateria` int(11) NOT NULL,
  `Nomtarea` text COLLATE utf8_unicode_ci NOT NULL,
  `Tipota` text COLLATE utf8_unicode_ci NOT NULL,
  `Carrera` int(3) NOT NULL,
  `Anio` int(4) NOT NULL,
  `Comision` int(3) NOT NULL,
  `Fechanot` datetime NOT NULL,
  PRIMARY KEY (`idnotificacion`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`idnotificacion`, `Tipo`, `idusuario`, `idtarea`, `idmateria`, `Nomtarea`, `Tipota`, `Carrera`, `Anio`, `Comision`, `Fechanot`) VALUES
(1, 'INS', 1, 1, 1, '', '', 1, 1, 1, '2015-03-18 06:38:50'),
(2, 'INS', 1, 2, 1, '', '', 1, 1, 1, '2015-03-18 06:40:03'),
(3, 'INS', 1, 3, 1, '', '', 1, 1, 1, '2015-03-18 06:41:17'),
(4, 'INS', 1, 4, 1, '', '', 1, 1, 1, '2015-03-18 06:42:37'),
(5, 'INS', 1, 5, 1, '', '', 1, 1, 1, '2015-03-18 06:43:39'),
(6, 'INS', 1, 6, 1, '', '', 1, 1, 1, '2015-03-18 06:44:34'),
(7, 'INS', 1, 7, 4, '', '', 1, 1, 1, '2015-03-18 06:48:08'),
(8, 'INS', 1, 8, 4, '', '', 1, 1, 1, '2015-03-18 06:49:06'),
(9, 'INS', 1, 9, 4, '', '', 1, 1, 1, '2015-03-18 06:50:12'),
(10, 'INS', 1, 10, 4, '', '', 1, 1, 1, '2015-03-18 06:54:27'),
(11, 'INS', 1, 11, 4, '', '', 1, 1, 1, '2015-03-18 06:55:34'),
(12, 'INS', 1, 12, 7, '', '', 1, 1, 1, '2015-03-18 07:07:51'),
(13, 'INS', 1, 13, 4, '', '', 1, 1, 1, '2015-03-18 18:03:17'),
(14, 'INS', 1, 14, 4, '', '', 1, 1, 1, '2015-03-18 18:04:34'),
(15, 'INS', 1, 15, 4, '', '', 1, 1, 1, '2015-03-18 18:55:40'),
(16, 'INS', 9, 16, 5, '', '', 1, 1, 1, '2015-03-18 19:18:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sugerencias`
--

CREATE TABLE IF NOT EXISTS `sugerencias` (
  `idsugerencia` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` int(11) NOT NULL,
  `Sugerencia` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `Fecha` datetime NOT NULL,
  PRIMARY KEY (`idsugerencia`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `sugerencias`
--

INSERT INTO `sugerencias` (`idsugerencia`, `Usuario`, `Sugerencia`, `Fecha`) VALUES
(1, 1, 'Me gustar', '0000-00-00 00:00:00'),
(2, 1, 'Me gustaría que se pueda elegir las materias de cursado', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE IF NOT EXISTS `tareas` (
  `idtarea` int(11) NOT NULL AUTO_INCREMENT,
  `Usuarioagre` int(11) NOT NULL,
  `Fechaagre` datetime NOT NULL,
  `Modsino` int(3) NOT NULL,
  `Lastusmod` int(11) NOT NULL,
  `Lastdatmod` datetime NOT NULL,
  `Materia` int(8) NOT NULL,
  `Nombre` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `Detalles` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `Tipofecha` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `Fechaentrega` date NOT NULL,
  `Fechafin` date NOT NULL,
  `Tipo` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `Carrera` int(4) NOT NULL,
  `Anio` int(4) NOT NULL,
  `Comision` int(2) NOT NULL,
  PRIMARY KEY (`idtarea`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`idtarea`, `Usuarioagre`, `Fechaagre`, `Modsino`, `Lastusmod`, `Lastdatmod`, `Materia`, `Nombre`, `Detalles`, `Tipofecha`, `Fechaentrega`, `Fechafin`, `Tipo`, `Carrera`, `Anio`, `Comision`) VALUES
(1, 1, '2015-03-18 06:38:50', 0, 1, '2015-03-18 06:38:50', 1, '1 er parcial', 'Sin definir', 'VAR', '2015-06-22', '2015-06-26', 'PC', 1, 1, 1),
(2, 1, '2015-03-18 06:40:03', 0, 1, '2015-03-18 06:40:03', 1, '2 do parcial', 'Sin definir', 'VAR', '2015-09-29', '2015-10-02', 'PC', 1, 1, 1),
(3, 1, '2015-03-18 06:41:17', 0, 1, '2015-03-18 06:41:17', 1, '3 er parcial', 'Sin definir', 'VAR', '2015-11-23', '2015-11-27', 'PC', 1, 1, 1),
(4, 1, '2015-03-18 06:42:37', 0, 1, '2015-03-18 06:42:37', 1, 'Rec. 1er parcial', 'Sin definir', 'VAR', '2015-07-06', '2015-07-10', 'RE', 1, 1, 1),
(5, 1, '2015-03-18 06:43:39', 0, 1, '2015-03-18 06:43:39', 1, 'Rec 2 parcial', 'Sin definir', 'VAR', '2015-11-30', '2015-12-04', 'RE', 1, 1, 1),
(6, 1, '2015-03-18 06:44:34', 0, 1, '2015-03-18 06:44:34', 1, 'Rec 3 er parcial', 'Sin definir', 'VAR', '2015-12-14', '2015-12-16', 'RE', 1, 1, 1),
(7, 1, '2015-03-18 06:48:08', 0, 1, '2015-03-18 06:48:08', 4, '1 er parcial', 'Unidades 1,2y 3', 'VAR', '2015-05-18', '2015-05-22', 'PC', 1, 1, 1),
(8, 1, '2015-03-18 06:49:06', 0, 1, '2015-03-18 06:49:06', 4, '2do parcial', 'Unidad 4', 'VAR', '2015-06-29', '2015-07-03', 'PC', 1, 1, 1),
(9, 1, '2015-03-18 06:50:12', 0, 1, '2015-03-18 06:50:12', 4, '3 er parcial', 'Unidades 5 y 6', 'VAR', '2015-09-28', '2015-10-02', 'PC', 1, 1, 1),
(10, 1, '2015-03-18 06:54:27', 0, 1, '2015-03-18 06:54:27', 4, '1 er Integrador (Rec para promocion de trab. prac)', 'Parte práctica de la materia', 'ESP', '2015-12-11', '2015-12-11', 'FL', 1, 1, 1),
(11, 1, '2015-03-18 06:55:34', 0, 1, '2015-03-18 06:55:34', 4, '2do integrador(Rec para promocion de trab. prac)', 'Parte práctica de la materia', 'ESP', '2016-02-19', '2016-02-19', 'FL', 1, 1, 1),
(12, 1, '2015-03-18 07:07:51', 8, 1, '2015-03-18 21:32:53', 7, 'Escenarios 1 y 2 GTP', 'Completar los escenarios 1 y 2 de la GTP', 'ESP', '2015-03-24', '2015-03-24', 'OP', 1, 1, 1),
(13, 1, '2015-03-18 18:03:17', 0, 1, '2015-03-18 18:03:17', 4, 'Rec. Primer parcial', 'Unidades 1,2 y 3', 'VAR', '2015-07-06', '2015-07-10', 'RE', 1, 1, 1),
(14, 1, '2015-03-18 18:04:34', 0, 1, '2015-03-18 18:04:34', 4, 'Rec. 2 parcial', 'Unidad 4', 'VAR', '2015-12-14', '2015-12-16', 'RE', 1, 1, 1),
(15, 1, '2015-03-18 18:55:40', 0, 1, '2015-03-18 18:55:40', 4, 'Rec 3er parcial', 'Unidades 5 y 6', 'VAR', '2016-02-15', '2016-02-20', 'RE', 1, 1, 1),
(16, 9, '2015-03-18 19:18:42', 0, 9, '2015-03-18 19:18:42', 5, 'Coloquio del campus', 'Revicen el campus virtual hay un scorms para resolver ', 'ESP', '2015-03-29', '2015-03-29', 'OP', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Pass` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Apellido` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Email` text COLLATE utf8_unicode_ci NOT NULL,
  `Carrera` int(4) NOT NULL,
  `Anio` int(2) NOT NULL,
  `Comision` int(4) NOT NULL,
  `Fecharegistro` datetime NOT NULL,
  `Idlastmod` int(11) NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `Usuario`, `Pass`, `Nombre`, `Apellido`, `Email`, `Carrera`, `Anio`, `Comision`, `Fecharegistro`, `Idlastmod`) VALUES
(1, 'Aug1919', 'myutnpr18', 'Gerardo Augusto', 'Romero', 'geragusto@hotmail.com', 1, 1, 1, '2015-03-13 01:14:16', 16),
(2, 'Gera1919', 'Gera1919', 'Gerardo', 'Ibarra', 'geragusto@hotmail.com', 1, 1, 2, '2015-03-18 02:04:00', 0),
(3, 'Bill87', 'myBil897', 'Bill', 'Gates', 'bill87@hotmail.com', 1, 3, 1, '2015-03-14 13:55:14', 0),
(4, 'Mark1718', 'Zuckface18', 'Mark', 'Zuckenverg', 'mark54@hotmail.com', 1, 1, 1, '2015-03-15 21:05:05', 16),
(5, 'Geraa1719', 'TomorBD18', 'Gerardo', 'Godoy', 'geraroner@hotmail.com', 1, 1, 1, '2015-03-17 14:47:04', 0),
(6, 'juanluucas', 'pirata95', 'Juan Lucas', 'Biain', 'barce.juanlucas@gmail.com', 1, 1, 1, '2015-03-18 10:25:12', 12),
(7, 'EduardoJadu', '39192927', 'Eduardo', 'Ferreyra', 'jadu_015@hotmail.com', 1, 1, 1, '2015-03-18 10:25:45', 12),
(8, 'Facundo', '3913610123', 'Facundo', 'Quiróz', 'facu-quiroz@live.com.ar', 1, 1, 1, '2015-03-18 10:25:57', 12),
(9, 'gonza120', 'kllk1118', 'gonzalo', 'vera', 'gonzalo.nicolas.vera@gmail.com', 1, 1, 1, '2015-03-18 10:25:59', 16),
(10, 'nachox066', 'nacho1212', 'ignacio', 'benitez', 'benitezvucasignacio@gmail.com', 1, 1, 1, '2015-03-18 10:26:12', 12),
(11, 'GonzaloZ', '15288317', 'Gonzalo', 'Zalazar', 'gonza_ale@live.com', 1, 1, 1, '2015-03-18 10:26:35', 12),
(12, 'Leandroasano', 'asanit14', 'Leo', 'Asano', 'lean_200_9@hotmail.com', 1, 1, 1, '2015-03-18 10:26:41', 16),
(13, 'nitneciv', '12470Miguel', 'Erick', 'Vicentin', 'erickvicentin14@hotmail.com', 1, 1, 1, '2015-03-18 10:30:43', 12),
(20, 'e_erkia', '60daf4ff51996', 'Esperanza', 'Erkia', 'erkiav@gmail.com', 1, 1, 1, '2015-03-18 12:54:22', 12),
(19, 'gabriel109', 'wiroos', 'gabriel', 'diez', 'gabrieldiez@hotmail.com', 1, 1, 1, '2015-03-18 12:39:36', 14),
(16, 'Edgarcardozo1', '40049181', 'Edgar', 'Cardozo', 'edgar07cardozo@hotmail.com', 1, 1, 1, '2015-03-18 11:15:55', 12),
(18, 'Nicolas_1128', 'd1osesf1el', 'Nicolas', 'Cuevas', 'nicolascuevasing@hotmail.com', 1, 1, 1, '2015-03-18 12:26:33', 12),
(21, 'gaston256', 'palermo1998', 'Gaston', 'Gonzalez', 'gaston.gonzalez.256@gmail.com', 1, 1, 1, '2015-03-18 13:31:12', 12),
(23, 'cristian_96', 'N8kiabelle', 'Cristian', 'Florentin', 'kristian.alex96@gmail.com', 1, 1, 1, '2015-03-18 14:21:12', 16),
(24, 'edgardo', 'edgardo', 'edgardo', 'sotelo', 'edgardo_ss_lc@hotmail.com', 1, 1, 1, '2015-03-18 19:20:13', 16),
(25, 'micaela', 'soledad04', 'micaela', 'quintana', 'micaela-quintana@hotmail.com', 1, 1, 1, '2015-03-18 19:20:23', 16),
(26, 'GonzalezCM', '399382822', 'Carlos', 'González', 'dwsitiocarlos@gmail.com', 1, 1, 1, '2015-03-18 19:49:29', 16);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
