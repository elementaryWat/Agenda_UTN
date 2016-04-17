
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-04-2016 a las 12:23:02
-- Versión del servidor: 10.0.20-MariaDB
-- Versión de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `u376876484_agen2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE IF NOT EXISTS `archivos` (
  `idarchivo` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `Extension` text COLLATE utf8_unicode_ci NOT NULL,
  `Tipoarcocar` text COLLATE utf8_unicode_ci NOT NULL,
  `Tipoarchi` int(11) NOT NULL,
  `Tamanio` text COLLATE utf8_unicode_ci NOT NULL,
  `Usuario` int(11) NOT NULL,
  `Fechaagre` datetime NOT NULL,
  `Ruta` text COLLATE utf8_unicode_ci NOT NULL,
  `Ubicacionfic` int(11) NOT NULL,
  PRIMARY KEY (`idarchivo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=61 ;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`idarchivo`, `Nombre`, `Extension`, `Tipoarcocar`, `Tipoarchi`, `Tamanio`, `Usuario`, `Fechaagre`, `Ruta`, `Ubicacionfic`) VALUES
(54, 'ALU 2015 actualizada', '.rar', 'ARCHIVO', 23, '7647598', 1, '2016-04-12 00:11:39', 'archivosusuarios/archivo0.rar', 60),
(55, 'SistemasNumericos', '.pdf', 'ARCHIVO', 3, '200038', 1, '2016-04-12 00:13:57', 'archivosusuarios/archivo054.pdf', 60),
(56, 'PIC16F84A_Manual', '.pdf', 'ARCHIVO', 3, '1866726', 1, '2016-04-12 00:20:37', 'archivosusuarios/archivo055.pdf', 60),
(57, 'MEMORIA CACHE', '.ppt', 'ARCHIVO', 24, '1526784', 1, '2016-04-12 00:54:48', 'archivosusuarios/archivo056.ppt', 60),
(58, 'MICROCONTROLADORES 2015', '.ppt', 'ARCHIVO', 24, '3207680', 1, '2016-04-12 00:58:11', 'archivosusuarios/archivo057.ppt', 60),
(59, 'TemasdeFinal', '.docx', 'ARCHIVO', 5, '7605', 1, '2016-04-12 13:35:22', 'archivosusuarios/archivo058.docx', 60),
(60, 'Arquitectura', '', 'CARPETA', 0, '0', 1, '2016-04-12 21:49:08', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivoscom`
--

CREATE TABLE IF NOT EXISTS `archivoscom` (
  `idarcom` int(11) NOT NULL,
  `idarchivo` int(11) NOT NULL,
  `Notas` text COLLATE utf8_unicode_ci NOT NULL,
  `Tarea` int(11) NOT NULL,
  `Usuarioagre` int(11) NOT NULL,
  `Fechaagre` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `archivoscom`
--

INSERT INTO `archivoscom` (`idarcom`, `idarchivo`, `Notas`, `Tarea`, `Usuarioagre`, `Fechaagre`) VALUES
(0, 18, 'Esta es una nota', 15, 1, '2016-01-19 12:20:10'),
(0, 27, '', 15, 1, '2016-01-19 23:48:59'),
(0, 25, 'Estamos probando notas', 15, 1, '2016-01-20 00:05:22'),
(0, 59, 'Se incluyen los temas de las ultimas mesas de Fisica y Arquitectura', 63, 1, '2016-04-12 13:36:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE IF NOT EXISTS `carrera` (
  `idcarrera` int(4) NOT NULL AUTO_INCREMENT,
  `Nombrecarrera` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `Abrevcarrera` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `Cantidadanios` int(3) NOT NULL,
  PRIMARY KEY (`idcarrera`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`idcarrera`, `Nombrecarrera`, `Abrevcarrera`, `Cantidadanios`) VALUES
(1, 'Ing. en sistemas de inf.', 'ISI', 5),
(2, 'Ing. Electromecanica', 'IEM', 5),
(3, 'Ing. Quimica', 'IQ', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catutoriales`
--

CREATE TABLE IF NOT EXISTS `catutoriales` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `Nomcategoria` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `catutoriales`
--

INSERT INTO `catutoriales` (`idcategoria`, `Nomcategoria`) VALUES
(1, 'Configuracion de cuenta'),
(2, 'Tareas'),
(3, 'Links utiles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
  `idcomentario` int(11) NOT NULL AUTO_INCREMENT,
  `Comentario` text COLLATE utf8_unicode_ci NOT NULL,
  `Tarea` int(11) NOT NULL,
  `Usuarioagre` int(11) NOT NULL,
  `Fechaagre` datetime NOT NULL,
  PRIMARY KEY (`idcomentario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`idcomentario`, `Comentario`, `Tarea`, `Usuarioagre`, `Fechaagre`) VALUES
(18, 'Un comentario de prueba mas', 44, 1, '2016-01-20 23:21:00'),
(19, 'Otro comentario mas', 44, 1, '2016-01-22 10:48:32'),
(16, 'Comentando', 44, 1, '2016-01-21 18:20:17'),
(17, 'Comentarios de prueba', 44, 1, '2016-01-21 23:19:11'),
(15, 'Este es un comentario de prueba', 44, 1, '2016-01-21 18:08:55'),
(20, 'Un comentario mas y listo', 44, 1, '2016-01-22 10:48:51'),
(21, '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."', 44, 1, '2016-01-22 10:54:37'),
(26, 'Hola mundo', 44, 1, '2016-01-22 19:06:31'),
(27, 'Hola mundo', 44, 1, '2016-01-23 00:47:19'),
(28, 'Este es un comentario de pruebaa', 15, 1, '2016-01-23 23:03:32'),
(29, 'Este es otro comentario de prueba', 15, 1, '2016-01-24 00:14:15'),
(31, 'Hola a todos', 44, 1, '2016-01-25 12:25:32'),
(32, 'Comentando para la idiota', 15, 1, '2016-01-25 12:26:39'),
(33, 'Comentario de prueba', 44, 1, '2016-01-26 18:11:06'),
(34, '', 61, 37, '2016-04-08 20:37:10'),
(35, 'Y', 58, 37, '2016-04-08 20:38:56'),
(36, 'vicente vigilante', 63, 41, '2016-04-12 19:25:29'),
(24, '"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"', 44, 1, '2016-01-22 12:36:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comisiones`
--

CREATE TABLE IF NOT EXISTS `comisiones` (
  `idcomis` int(4) NOT NULL AUTO_INCREMENT,
  `Carrera` int(4) NOT NULL,
  `Anio` int(3) NOT NULL,
  `Cantidadcomis` int(3) NOT NULL,
  PRIMARY KEY (`idcomis`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `comisiones`
--

INSERT INTO `comisiones` (`idcomis`, `Carrera`, `Anio`, `Cantidadcomis`) VALUES
(1, 1, 1, 4),
(2, 1, 2, 2),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1),
(6, 2, 1, 2),
(7, 2, 2, 1),
(8, 2, 3, 1),
(9, 2, 4, 1),
(10, 2, 5, 1),
(11, 3, 1, 1),
(12, 3, 2, 1),
(13, 3, 3, 1),
(14, 3, 4, 1),
(15, 3, 5, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=40 ;

--
-- Volcado de datos para la tabla `entregados`
--

INSERT INTO `entregados` (`identrega`, `Usuario`, `Tarea`, `Fechaentrega`, `Verificado`) VALUES
(12, 1, 4, '2015-03-18', 'NO'),
(11, 6, 2, '2015-03-18', 'NO'),
(10, 6, 3, '2015-03-18', 'NO'),
(9, 7, 12, '2015-03-18', 'NO'),
(8, 19, 11, '2015-03-18', 'NO'),
(7, 12, 12, '2015-03-18', 'SI'),
(13, 1, 1, '2015-03-18', 'NO'),
(14, 13, 10, '2015-03-18', 'NO'),
(15, 9, 12, '2015-03-18', 'NO'),
(16, 1, 12, '2015-03-19', 'NO'),
(17, 11, 6, '2015-03-19', 'NO'),
(18, 23, 7, '2015-03-20', 'NO'),
(19, 23, 19, '2015-03-20', 'NO'),
(20, 21, 17, '2015-03-20', 'NO'),
(21, 1, 16, '2015-03-20', 'NO'),
(22, 23, 17, '2015-03-21', 'SI'),
(23, 19, 17, '2015-03-21', 'NO'),
(24, 1, 8, '2015-03-23', 'NO'),
(25, 23, 12, '2015-03-23', 'SI'),
(26, 28, 16, '2015-03-23', 'SI'),
(27, 28, 12, '2015-03-23', 'SI'),
(28, 1, 9, '2015-03-24', 'NO'),
(29, 11, 16, '2015-03-25', 'SI'),
(30, 4, 1, '2015-03-25', 'NO'),
(31, 1, 7, '2015-04-01', 'NO'),
(32, 30, 19, '2015-04-08', 'SI'),
(33, 30, 7, '2015-04-08', 'NO'),
(34, 1, 36, '2015-12-25', 'NO'),
(35, 1, 15, '2015-12-27', 'SI'),
(36, 1, 11, '2016-01-26', 'SI'),
(37, 1, 58, '2016-04-08', 'NO'),
(38, 1, 64, '2016-04-08', 'NO'),
(39, 37, 69, '2016-04-11', 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feriados`
--

CREATE TABLE IF NOT EXISTS `feriados` (
  `idferiado` int(5) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`idferiado`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `feriados`
--

INSERT INTO `feriados` (`idferiado`, `Nombre`, `Fecha`) VALUES
(1, 'Año  Nuevo', '2016-01-01'),
(2, 'Carnaval', '2016-02-08'),
(3, 'Carnaval', '2016-02-09'),
(4, 'Día Nacional de la Memoria por la Verdad y la Justicia', '2016-03-24'),
(5, 'Viernes Santo', '2016-03-25'),
(6, 'Día del Veterano y de los Caídos en la Guerra de Malvinas', '2016-04-02'),
(7, 'Día del trabajador', '2016-05-01'),
(8, 'Día de la Revolución de Mayo', '2016-05-25'),
(9, 'Día Paso a la Inmortalidad del General Manuel Belgrano', '2016-06-20'),
(10, 'Feriado puente turístico', '2016-07-08'),
(11, 'Día de la Independencia', '2016-07-09'),
(12, 'Paso a la Inmortalidad del General José de San Martín', '2016-08-15'),
(13, 'Día del Respeto a la Diversidad Cultural', '2016-10-10'),
(14, 'Día de la Soberanía Nacional', '2016-11-28'),
(15, 'Inmaculada Concepción de María', '2016-12-08'),
(16, 'Feriado puente turístico', '2016-12-09'),
(17, 'Navidad', '2016-12-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `filescomp`
--

CREATE TABLE IF NOT EXISTS `filescomp` (
  `idfcomp` int(11) NOT NULL AUTO_INCREMENT,
  `idarchivo` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idmateria` int(11) NOT NULL,
  `Comision` int(11) NOT NULL,
  `Fechacomp` datetime NOT NULL,
  PRIMARY KEY (`idfcomp`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `filescomp`
--

INSERT INTO `filescomp` (`idfcomp`, `idarchivo`, `idusuario`, `idmateria`, `Comision`, `Fechacomp`) VALUES
(1, 18, 1, 8, 1, '2015-05-06 00:29:30'),
(2, 47, 1, 5, 1, '2015-05-07 11:25:45'),
(3, 49, 1, 5, 1, '2015-05-07 22:49:51'),
(4, 50, 1, 1, 1, '2015-05-07 23:37:31'),
(5, 46, 1, 51, 1, '2015-05-07 23:40:06'),
(6, 13, 1, 51, 1, '2015-11-30 18:25:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `idlink` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `Notas` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `Tarea` int(11) NOT NULL,
  `Usuarioagre` int(11) NOT NULL,
  `Fechaagre` datetime NOT NULL,
  `Enlace` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idlink`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `links`
--

INSERT INTO `links` (`idlink`, `Nombre`, `Notas`, `Tarea`, `Usuarioagre`, `Fechaagre`, `Enlace`) VALUES
(1, 'Recursividad', 'Esto es una prueba de recursividad', 7, 1, '2015-05-07 21:14:56', 'http://www.utndiarybeta.890m.com/index.php'),
(3, 'Video party', 'Este es un video de prueba', 11, 1, '2016-01-16 23:06:58', 'https://www.youtube.com/watch?v=USVg_E7r20g'),
(9, 'Comparaciones Von Neumann y Harvard', 'Se muestra de forma breve caracteristicas principales de ambas arquitecturas', 63, 1, '2016-04-13 22:57:14', 'http://es.slideshare.net/mariagrau14/arquitecturas-del-harvard-y-von-neumann-maria'),
(5, 'Curso jquery', 'Este es un curso de una de las librerias mas utilizadas basada en Javascript', 44, 1, '2016-01-20 12:40:14', 'https://www.video2brain.com/mx/cursos/jquery'),
(6, 'Curso Jquery Diseñador', 'Jquery para diseñadores', 44, 1, '2016-01-20 12:40:53', 'https://www.video2brain.com/mx/cursos/jquery-para-disenadores'),
(7, 'Curso Javascript', 'Especial de Javacript para hacer mas interactiva tus paginas web', 44, 1, '2016-01-20 12:41:41', 'https://www.video2brain.com/mx/cursos/especial-javascript-animaciones'),
(8, 'Curso avanzado de PHP', 'Profundizando en uno de los lenguajes de backend mas utilizados', 44, 1, '2016-01-20 13:24:45', 'https://www.video2brain.com/mx/cursos/php-avanzado');

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
  `Homogenea` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idmateria`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=112 ;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`idmateria`, `Nombremateria`, `Abrevmateria`, `Carrera`, `Anio`, `Homogenea`) VALUES
(1, 'Algebra y Geometria Analitica', 'Alg. y Geom. Anali.', 1, 1, 'SI'),
(2, 'Analisis matematico I', 'Anali. Mat. I', 1, 1, 'SI'),
(3, 'Sistemas de Representacion', 'Sist. de Repr.', 1, 1, 'SI'),
(4, 'Matematica discreta', 'Mat. discr.', 1, 1, 'NO'),
(5, 'Algoritmos y estructura de datos', 'Alg. y estr. de dat.', 1, 1, 'NO'),
(6, 'Arquitectura de computadoras', 'Arquit. de comp.', 1, 1, 'NO'),
(7, 'Sistemas y organizaciones', 'Sist. y organ.', 1, 1, 'NO'),
(8, 'Fisica I', 'Fisica I', 1, 1, 'SI'),
(9, 'Química', 'Química', 1, 2, 'NO'),
(10, 'Analisis Matematico II', 'Anali. Matem. II', 1, 2, 'SI'),
(11, 'Fisica II', 'Fisica II', 1, 2, 'SI'),
(12, 'Análisis de Sistemas', 'An. de Sist.', 1, 2, 'NO'),
(13, 'Sintaxis y Semántica de los Lenguajes', 'Sint. y Sem. de Leng.', 1, 2, 'NO'),
(14, 'Paradigmas de Programación', 'Parad. de Progr.', 1, 2, 'NO'),
(15, 'Sistemas Operativos', 'Sist. Operativos', 1, 2, 'NO'),
(16, 'Ingles I', 'Ingles I', 1, 2, 'SI'),
(17, 'Probabilidad y Estadistica', 'Probab. y Estad.', 1, 3, 'SI'),
(18, 'Diseño de Sistemas', 'Dis. de Sist.', 1, 3, 'NO'),
(19, 'Comunicaciones', 'Comunicaciones', 1, 3, 'NO'),
(20, 'Matemática Superior', 'Mat. Sup.', 1, 3, 'NO'),
(21, 'Gestión de Datos', 'Gest. Datos', 1, 3, 'NO'),
(22, 'Ingenieria y Sociedad', 'Ing. y Socie.', 1, 3, 'SI'),
(23, 'Economia', 'Economia', 1, 3, 'SI'),
(24, 'Ingles II', 'Ingles II', 1, 3, 'SI'),
(25, 'Redes de Información', 'Red. de Inf.', 1, 4, 'NO'),
(26, 'Administración de Recursos', 'Adm. de Rec.', 1, 4, 'NO'),
(27, 'Investigación Operativa', 'Inv. Oper.', 1, 4, 'NO'),
(28, 'Simulación', 'Simulación', 1, 4, 'NO'),
(29, 'Ingeniería de Software', 'Ing. de Soft.', 1, 4, 'NO'),
(30, 'Teoría de Control', 'Teor. de Cont.', 1, 4, 'NO'),
(31, 'Legislacion', 'Legislacion', 1, 4, 'SI'),
(32, 'Proyecto Final', 'Proy. Final', 1, 5, 'NO'),
(33, 'Inteligencia Artificial', 'Intel. Artif.', 1, 5, 'NO'),
(34, 'Administración Gerencial', 'Admin.Gerencial', 1, 5, 'NO'),
(35, 'Sistemas de Gestión', 'Sist. de Gest.', 1, 5, 'NO'),
(40, 'Quimica General', 'Quím. Gen.', 2, 1, 'NO'),
(39, 'Analisis matematico I', 'Anali. Mat. I', 2, 1, 'SI'),
(41, 'Fisica I', 'Fisica I', 2, 1, 'SI'),
(42, 'Ing. Electromecanica I (Int)', 'Ing. Electrom. I', 2, 1, 'NO'),
(43, 'Algebra y Geometria Analitica', 'Alg. y Geom. Anali.', 2, 1, 'SI'),
(44, 'Ingenieria y Sociedad', 'Ing. y Socie.', 2, 1, 'SI'),
(45, 'Sistemas de Representacion', 'Sist. de Repr.', 2, 1, 'SI'),
(46, 'Representacion grafica', 'Repres. graf.', 2, 1, 'NO'),
(47, 'Fisica II', 'Fisica II', 2, 2, 'SI'),
(48, 'Estabilidad', 'Estabilidad', 2, 2, 'NO'),
(49, 'Ing. Electromecanica II (Int)', 'Ing. Electrom. II', 2, 2, 'NO'),
(50, 'Conocimientos de Materiales', 'Conoc. de Mater', 2, 2, 'NO'),
(51, 'Analisis Matematico II', 'Anali. Matem. II', 2, 2, 'SI'),
(52, 'Programacion en Computacion', 'Progr. en Comp.', 2, 2, 'NO'),
(53, 'Probabilidad y Estadistica', 'Probab. y Estad.', 2, 2, 'SI'),
(54, 'Ingles I', 'Ingles I', 2, 2, 'SI'),
(55, 'Tecnologia Mecanica', 'Tecn. Mecan.', 2, 3, 'NO'),
(56, 'Ing. Electromecanica III (Int)', 'Ing. Electrom III.', 2, 3, 'NO'),
(57, 'Mecanica y Mecanismos', 'Mecan. y Mecanis.', 2, 3, 'NO'),
(58, 'Electrotecnia', 'Electrotecnia', 2, 3, 'NO'),
(59, 'Termodinamica Tecnica', 'Termod. Tecn.', 2, 3, 'NO'),
(60, 'Matematica para Ing. Electromecanica', 'Mat. para Ing. Elect.', 2, 3, 'NO'),
(61, 'Higiene y Seguridad Industrial', 'Hig. y Seg. Ind.', 2, 3, 'NO'),
(62, 'Ingles II', 'Ingles II', 2, 3, 'SI'),
(63, 'Elementos de Maquinas (int)', 'Elem. de Maq.', 2, 4, 'NO'),
(64, 'Electronica Industrial', 'Electron. Ind.', 2, 4, 'NO'),
(65, 'Mecánica de los Fluidos y Maquinas fluidodinámicas', 'Mecánica .Flui. y Maq.', 2, 4, 'NO'),
(66, 'Maquinas Electricas', 'Maq Eléctr.', 2, 4, 'NO'),
(67, 'Mediciones Electricas', 'Medic.Electr.', 2, 4, 'NO'),
(68, 'Maquinas Termicas', 'Maq. Term.', 2, 4, 'NO'),
(69, 'Economia', 'Economia', 2, 4, 'SI'),
(70, 'Legislacion', 'Legislacion', 2, 4, 'SI'),
(71, 'Redes de Distribucion e Instalaciones Eléetricas', 'Red. Distr. e Inst. Electr.', 2, 5, 'NO'),
(72, 'Instalaciones Termicas, Mecanicas y Frigoríficas', 'Inst. Term, Mecan. y Frig.', 2, 5, 'NO'),
(73, 'Centrales y Sistemas de Transmision', 'Centr. y Sist. de Transm.', 2, 5, 'NO'),
(74, 'Organizacion Industrial', 'Organiz. Ind.', 2, 5, 'NO'),
(75, 'Automatizacion y Control Industrial', 'Automat. y Cont. Ind.', 2, 5, 'NO'),
(76, 'Proyecto Final (Int)', 'Proyecto Final', 2, 5, 'NO'),
(77, 'Integracion I  (Int)', 'Integracion I', 3, 1, 'NO'),
(78, 'Algebra y Geometria Analitica', 'Alg. y Geom. Anali.', 3, 1, 'SI'),
(79, 'Ingenieria y Sociedad', 'Ing. y Socie.', 3, 1, 'SI'),
(80, 'Analisis matematico I', 'Anali. Mat. I', 3, 1, 'SI'),
(81, 'Fisica I', 'Fisica I', 3, 1, 'SI'),
(82, 'Quimica General', 'Quim. Gen.', 3, 1, 'NO'),
(83, 'Sistemas de Representacion', 'Sist. de Repr.', 3, 1, 'SI'),
(84, 'Fundamentos de Informatica', 'Fund. de Inf.', 3, 1, 'NO'),
(85, 'Integracion II  (Int)', 'Integracion II', 3, 2, 'NO'),
(86, 'Probabilidad y Estadistica', 'Probab. y Estad.', 3, 2, 'SI'),
(87, 'Quimica Inorganica', 'Quím. Inorg.', 3, 2, 'NO'),
(88, 'Analisis Matematico II', 'Anali. Matem. II', 3, 2, 'SI'),
(89, 'Fisica II', 'Fisica II', 3, 2, 'SI'),
(90, 'Quimica Organica', 'Quim. Org.', 3, 2, 'NO'),
(91, 'Ingles I', 'Ingles I', 3, 2, 'SI'),
(92, 'Matematica Superior Aplicada', 'Matem. Sup. Aplic.', 3, 2, 'NO'),
(93, 'Integracion III (Int)', 'Integracion III', 3, 3, 'NO'),
(94, 'Termodinamica', 'Termod.', 3, 3, 'NO'),
(95, 'Economia', 'Economia', 3, 3, 'SI'),
(96, 'Legislacion', 'Legislacion', 3, 3, 'SI'),
(97, 'Mecanica Electrica Industrial', 'Mec. Electr. Ind.', 3, 3, 'NO'),
(98, 'Fisico Quimica', 'Fis. Quim.', 3, 3, 'NO'),
(99, 'Fenomenos de Transporte', 'Fenom. de Transp.', 3, 3, 'NO'),
(100, 'Quimica Analitica', 'Quim. Anali.', 3, 3, 'NO'),
(101, 'Ingles II', 'Ingles II', 3, 3, 'SI'),
(102, 'Integracion IV (Int)', 'Integracion IV', 3, 4, 'NO'),
(103, 'Operaciones Unitarias I', 'Operac. Unit. I', 3, 4, 'NO'),
(104, 'Tecnologia de la Energía Termica', 'Tecnol. Energ. Term.', 3, 4, 'NO'),
(105, 'Biotecnologia', 'Biotecnologia', 3, 4, 'NO'),
(106, 'Operaciones Unitarias II', 'Operac. Unit. II', 3, 4, 'NO'),
(107, 'Ingenieria de las Reacciones Quimicas', 'Ing. Reacc. Quim.', 3, 4, 'NO'),
(108, 'Control Estadisticos de Procesos', 'Cont. Estad. de Proc.', 3, 4, 'NO'),
(109, 'Organizacion Industrial', 'Organ. Indus.', 3, 4, 'NO'),
(110, 'Control Automatico de Procesos', 'Contr. Autom. Proc.', 3, 5, 'NO'),
(111, 'Proyecto Final -Integracion V- (Int)', 'Proyecto Final', 3, 5, 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notasinicio`
--

CREATE TABLE IF NOT EXISTS `notasinicio` (
  `idnota` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idnota`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=54 ;

--
-- Volcado de datos para la tabla `notasinicio`
--

INSERT INTO `notasinicio` (`idnota`, `idusuario`) VALUES
(40, 1),
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
(27, 26),
(28, 21),
(31, 27),
(41, 28),
(42, 29),
(45, 30),
(46, 31),
(47, 32),
(48, 34),
(49, 35),
(50, 37),
(51, 38),
(52, 39),
(53, 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE IF NOT EXISTS `notificaciones` (
  `idnotificacion` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `Recursosino` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idtarea` int(11) NOT NULL,
  `idmateria` int(11) NOT NULL,
  `Nomtarea` text COLLATE utf8_unicode_ci NOT NULL,
  `Tipota` text COLLATE utf8_unicode_ci NOT NULL,
  `Comision` int(3) NOT NULL,
  `Fechanot` datetime NOT NULL,
  PRIMARY KEY (`idnotificacion`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=200 ;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`idnotificacion`, `Tipo`, `Recursosino`, `idusuario`, `idtarea`, `idmateria`, `Nomtarea`, `Tipota`, `Comision`, `Fechanot`) VALUES
(199, 'MOD', 'NO', 1, 63, 6, '', '', 1, '2016-04-13 23:05:33'),
(198, 'INS', 'LINK', 1, 63, 6, '', '', 1, '2016-04-13 22:57:14'),
(197, 'MOD', 'NO', 1, 63, 6, '', '', 1, '2016-04-13 22:48:23'),
(196, 'MOD', 'NO', 1, 63, 6, '', '', 1, '2016-04-13 22:46:44'),
(195, 'MOD', 'NO', 1, 63, 6, '', '', 1, '2016-04-12 23:17:10'),
(194, 'MOD', 'NO', 1, 63, 6, '', '', 1, '2016-04-12 23:17:10'),
(193, 'MOD', 'NO', 1, 63, 6, '', '', 1, '2016-04-12 23:17:09'),
(192, 'MOD', 'NO', 1, 63, 6, '', '', 1, '2016-04-12 23:15:37'),
(191, 'MOD', 'NO', 1, 63, 6, '', '', 1, '2016-04-12 23:08:44'),
(190, 'MOD', 'NO', 1, 63, 6, '', '', 1, '2016-04-12 23:08:10'),
(189, 'MOD', 'NO', 1, 63, 6, '', '', 1, '2016-04-12 21:45:02'),
(188, 'MOD', 'NO', 1, 63, 6, '', '', 1, '2016-04-12 21:45:01'),
(187, 'MOD', 'NO', 1, 63, 6, '', '', 1, '2016-04-12 21:45:01'),
(186, 'INS', 'COMENTARIO', 41, 63, 6, '', '', 1, '2016-04-12 19:25:29'),
(185, 'MOD', 'NO', 1, 63, 6, '', '', 1, '2016-04-11 13:59:58'),
(184, 'MOD', 'NO', 1, 63, 6, '', '', 1, '2016-04-11 13:59:58'),
(183, 'MOD', 'NO', 1, 63, 6, '', '', 1, '2016-04-11 13:59:09'),
(182, 'MOD', 'NO', 1, 63, 6, '', '', 1, '2016-04-11 13:58:21'),
(181, 'MOD', 'NO', 1, 63, 6, '', '', 1, '2016-04-11 13:32:12'),
(180, 'INS', 'NO', 37, 69, 2, '', '', 1, '2016-04-08 21:43:55'),
(179, 'INS', 'COMENTARIO', 37, 58, 13, '', '', 1, '2016-04-08 20:38:56'),
(178, 'INS', 'COMENTARIO', 37, 61, 13, '', '', 1, '2016-04-08 20:37:10'),
(177, 'MOD', 'NO', 1, 68, 2, '', '', 1, '2016-04-08 01:57:11'),
(176, 'INS', 'NO', 1, 68, 2, '', '', 1, '2016-04-08 01:56:10'),
(175, 'MOD', 'NO', 1, 66, 2, '', '', 1, '2016-04-08 01:01:08'),
(174, 'INS', 'NO', 1, 67, 2, '', '', 1, '2016-04-08 00:59:55'),
(173, 'INS', 'NO', 1, 66, 2, '', '', 1, '2016-04-08 00:57:59'),
(172, 'INS', 'NO', 1, 65, 7, '', '', 1, '2016-04-08 00:41:32'),
(171, 'INS', 'NO', 1, 64, 4, '', '', 1, '2016-04-08 00:40:15'),
(170, 'INS', 'NO', 1, 63, 6, '', '', 1, '2016-04-08 00:39:03'),
(169, 'INS', 'NO', 1, 62, 13, '', '', 1, '2016-04-08 00:21:54'),
(168, 'INS', 'NO', 1, 61, 13, '', '', 1, '2016-04-07 23:58:02'),
(167, 'INS', 'NO', 1, 60, 13, '', '', 1, '2016-04-07 23:40:33'),
(166, 'INS', 'NO', 1, 59, 13, '', '', 1, '2016-04-07 23:39:30'),
(165, 'INS', 'NO', 1, 58, 13, '', '', 1, '2016-04-07 23:37:10'),
(164, 'INS', 'NO', 1, 57, 15, '', '', 1, '2016-04-07 23:33:51'),
(163, 'INS', 'NO', 1, 56, 15, '', '', 1, '2016-04-07 12:06:48'),
(162, 'INS', 'NO', 1, 55, 15, '', '', 1, '2016-04-07 11:10:56'),
(161, 'MOD', 'NO', 1, 53, 15, '', '', 1, '2016-04-07 11:01:02'),
(160, 'INS', 'NO', 1, 54, 15, '', '', 1, '2016-04-07 10:59:19'),
(159, 'INS', 'NO', 1, 53, 15, '', '', 1, '2016-04-07 10:54:45'),
(158, 'INS', 'NO', 1, 52, 15, '', '', 1, '2016-04-07 10:50:16'),
(157, 'INS', 'NO', 1, 51, 15, '', '', 1, '2016-04-07 01:44:38'),
(156, 'INS', 'NO', 1, 50, 12, '', '', 1, '2016-04-07 01:23:36'),
(155, 'INS', 'NO', 1, 49, 12, '', '', 1, '2016-04-07 01:21:56'),
(154, 'INS', 'NO', 1, 48, 12, '', '', 1, '2016-04-07 01:20:24'),
(153, 'MOD', 'NO', 1, 46, 12, '', '', 1, '2016-04-07 01:07:05'),
(152, 'MOD', 'NO', 1, 46, 12, '', '', 1, '2016-04-07 01:06:37'),
(151, 'MOD', 'NO', 1, 46, 12, '', '', 1, '2016-04-07 01:04:53'),
(150, 'MOD', 'NO', 1, 46, 12, '', '', 1, '2016-04-07 01:02:01'),
(149, 'INS', 'NO', 1, 47, 12, '', '', 1, '2016-04-07 00:10:12'),
(148, 'INS', 'NO', 1, 46, 12, '', '', 1, '2016-04-07 00:04:03'),
(147, 'INS', 'NO', 1, 45, 5, '', '', 1, '2016-03-06 00:59:30'),
(146, 'INS', 'COMENTARIO', 1, 44, 5, '', '', 1, '2016-01-26 18:11:06'),
(145, 'INS', 'COMENTARIO', 1, 15, 4, '', '', 1, '2016-01-25 12:26:39'),
(144, 'INS', 'COMENTARIO', 1, 44, 5, '', '', 1, '2016-01-25 12:25:32'),
(143, 'INS', 'COMENTARIO', 2, 15, 4, '', '', 1, '2016-01-24 00:29:47'),
(142, 'INS', 'COMENTARIO', 1, 15, 4, '', '', 1, '2016-01-24 00:14:15'),
(140, 'INS', 'COMENTARIO', 1, 44, 5, '', '', 1, '2016-01-23 00:47:19'),
(141, 'INS', 'COMENTARIO', 1, 15, 4, '', '', 1, '2016-01-23 23:03:32'),
(139, 'ELI', 'LINK', 1, 44, 5, '', '', 1, '2016-01-23 00:40:08'),
(138, 'MOD', 'NO', 1, 44, 5, '', '', 1, '2016-01-23 00:38:03'),
(137, 'INS', 'LINK', 1, 44, 5, '', '', 1, '2016-01-20 13:24:45'),
(136, 'INS', 'LINK', 1, 44, 5, '', '', 1, '2016-01-20 12:41:41'),
(135, 'INS', 'LINK', 1, 44, 5, '', '', 1, '2016-01-20 12:40:53'),
(134, 'INS', 'LINK', 1, 44, 5, '', '', 1, '2016-01-20 12:40:14'),
(133, 'INS', 'LINK', 1, 44, 5, '', '', 1, '2016-01-20 12:38:48'),
(132, 'INS', 'NO', 1, 44, 5, '', '', 1, '2016-01-20 12:24:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguidos`
--

CREATE TABLE IF NOT EXISTS `seguidos` (
  `idseguidos` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` int(11) NOT NULL,
  `Tarea` int(11) NOT NULL,
  `Fechaseguido` date NOT NULL,
  PRIMARY KEY (`idseguidos`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `seguidos`
--

INSERT INTO `seguidos` (`idseguidos`, `Usuario`, `Tarea`, `Fechaseguido`) VALUES
(3, 37, 59, '2016-04-11');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `sugerencias`
--

INSERT INTO `sugerencias` (`idsugerencia`, `Usuario`, `Sugerencia`, `Fecha`) VALUES
(1, 1, 'Me gustar', '2015-03-21 00:00:00'),
(2, 1, 'Me gustaría que se pueda elegir las materias de cursado', '2015-12-28 00:00:00'),
(3, 4, 'Estaría bueno poder agregar links que nos sirvieron para realizar la tarea', '2015-03-21 13:44:53'),
(4, 23, 'Se podría agregar la opción de mantener la sesión iniciada en mi dispositivo?', '2015-03-22 13:42:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscmaterias`
--

CREATE TABLE IF NOT EXISTS `suscmaterias` (
  `idsuscripcion` int(11) NOT NULL AUTO_INCREMENT,
  `idmateria` int(3) NOT NULL,
  `Nombremateria` text COLLATE utf8_unicode_ci NOT NULL,
  `idusuario` int(11) NOT NULL,
  `comisioncursado` int(4) NOT NULL,
  PRIMARY KEY (`idsuscripcion`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=367 ;

--
-- Volcado de datos para la tabla `suscmaterias`
--

INSERT INTO `suscmaterias` (`idsuscripcion`, `idmateria`, `Nombremateria`, `idusuario`, `comisioncursado`) VALUES
(326, 6, 'Arquit. de comp.', 1, 1),
(325, 15, 'Sist. Operativos', 1, 1),
(324, 13, 'Sint. y Sem. de Leng.', 1, 1),
(323, 12, 'An. de Sist.', 1, 1),
(321, 5, 'Alg. y estr. de dat.', 1, 1),
(272, 10, 'Anali. Matem. II', 2, 2),
(271, 6, 'Arquit. de comp.', 2, 1),
(270, 4, 'Mat. discr.', 2, 1),
(269, 3, 'Sist. de Repr.', 2, 1),
(268, 1, 'Alg. y Geom. Anali.', 2, 1),
(17, 17, 'Probab. y Estad.', 3, 1),
(18, 18, 'Dis. de Sist.', 3, 1),
(19, 19, 'Comunicaciones', 3, 1),
(20, 20, 'Mat. Sup.', 3, 1),
(21, 21, 'Gest. Datos', 3, 1),
(22, 22, 'Ing. y Socie.', 3, 1),
(23, 23, 'Economia', 3, 1),
(24, 24, 'Ingles II', 3, 1),
(25, 1, 'Alg. y Geom. Anali.', 4, 1),
(26, 2, 'Anali. Mat. I', 4, 1),
(27, 3, 'Sist. de Repr.', 4, 1),
(28, 4, 'Mat. discr.', 4, 1),
(29, 5, 'Alg. y estr. de dat.', 4, 1),
(30, 6, 'Arquit. de comp.', 4, 1),
(31, 7, 'Sist. y organ.', 4, 1),
(32, 8, 'Fisica I', 4, 1),
(33, 1, 'Alg. y Geom. Anali.', 5, 1),
(34, 2, 'Anali. Mat. I', 5, 1),
(35, 3, 'Sist. de Repr.', 5, 1),
(36, 4, 'Mat. discr.', 5, 1),
(37, 5, 'Alg. y estr. de dat.', 5, 1),
(38, 6, 'Arquit. de comp.', 5, 1),
(39, 7, 'Sist. y organ.', 5, 1),
(40, 8, 'Fisica I', 5, 1),
(41, 1, 'Alg. y Geom. Anali.', 6, 1),
(42, 2, 'Anali. Mat. I', 6, 1),
(43, 3, 'Sist. de Repr.', 6, 1),
(44, 4, 'Mat. discr.', 6, 1),
(45, 5, 'Alg. y estr. de dat.', 6, 1),
(46, 6, 'Arquit. de comp.', 6, 1),
(47, 7, 'Sist. y organ.', 6, 1),
(48, 8, 'Fisica I', 6, 1),
(49, 1, 'Alg. y Geom. Anali.', 7, 1),
(50, 2, 'Anali. Mat. I', 7, 1),
(51, 3, 'Sist. de Repr.', 7, 1),
(52, 4, 'Mat. discr.', 7, 1),
(53, 5, 'Alg. y estr. de dat.', 7, 1),
(54, 6, 'Arquit. de comp.', 7, 1),
(55, 7, 'Sist. y organ.', 7, 1),
(56, 8, 'Fisica I', 7, 1),
(356, 10, 'Anali. Matem. II', 39, 1),
(355, 13, 'Sint. y Sem. de Leng.', 8, 1),
(354, 12, 'An. de Sist.', 8, 1),
(353, 11, 'Fisica II', 8, 1),
(352, 10, 'Anali. Matem. II', 8, 1),
(351, 6, 'Arquit. de comp.', 8, 1),
(65, 1, 'Alg. y Geom. Anali.', 9, 1),
(66, 2, 'Anali. Mat. I', 9, 1),
(67, 3, 'Sist. de Repr.', 9, 1),
(68, 4, 'Mat. discr.', 9, 1),
(69, 5, 'Alg. y estr. de dat.', 9, 1),
(70, 6, 'Arquit. de comp.', 9, 1),
(71, 7, 'Sist. y organ.', 9, 1),
(72, 8, 'Fisica I', 9, 1),
(73, 1, 'Alg. y Geom. Anali.', 10, 1),
(74, 2, 'Anali. Mat. I', 10, 1),
(75, 3, 'Sist. de Repr.', 10, 1),
(76, 4, 'Mat. discr.', 10, 1),
(77, 5, 'Alg. y estr. de dat.', 10, 1),
(78, 6, 'Arquit. de comp.', 10, 1),
(79, 7, 'Sist. y organ.', 10, 1),
(80, 8, 'Fisica I', 10, 1),
(81, 1, 'Alg. y Geom. Anali.', 11, 1),
(82, 2, 'Anali. Mat. I', 11, 1),
(83, 3, 'Sist. de Repr.', 11, 1),
(84, 4, 'Mat. discr.', 11, 1),
(85, 5, 'Alg. y estr. de dat.', 11, 1),
(86, 6, 'Arquit. de comp.', 11, 1),
(87, 7, 'Sist. y organ.', 11, 1),
(88, 8, 'Fisica I', 11, 1),
(89, 1, 'Alg. y Geom. Anali.', 12, 1),
(90, 2, 'Anali. Mat. I', 12, 1),
(91, 3, 'Sist. de Repr.', 12, 1),
(92, 4, 'Mat. discr.', 12, 1),
(93, 5, 'Alg. y estr. de dat.', 12, 1),
(94, 6, 'Arquit. de comp.', 12, 1),
(95, 7, 'Sist. y organ.', 12, 1),
(96, 8, 'Fisica I', 12, 1),
(97, 1, 'Alg. y Geom. Anali.', 13, 1),
(98, 2, 'Anali. Mat. I', 13, 1),
(99, 3, 'Sist. de Repr.', 13, 1),
(100, 4, 'Mat. discr.', 13, 1),
(101, 5, 'Alg. y estr. de dat.', 13, 1),
(102, 6, 'Arquit. de comp.', 13, 1),
(103, 7, 'Sist. y organ.', 13, 1),
(104, 8, 'Fisica I', 13, 1),
(105, 1, 'Alg. y Geom. Anali.', 20, 1),
(106, 2, 'Anali. Mat. I', 20, 1),
(107, 3, 'Sist. de Repr.', 20, 1),
(108, 4, 'Mat. discr.', 20, 1),
(109, 5, 'Alg. y estr. de dat.', 20, 1),
(110, 6, 'Arquit. de comp.', 20, 1),
(111, 7, 'Sist. y organ.', 20, 1),
(112, 8, 'Fisica I', 20, 1),
(113, 1, 'Alg. y Geom. Anali.', 19, 1),
(114, 2, 'Anali. Mat. I', 19, 1),
(115, 3, 'Sist. de Repr.', 19, 1),
(116, 4, 'Mat. discr.', 19, 1),
(117, 5, 'Alg. y estr. de dat.', 19, 1),
(118, 6, 'Arquit. de comp.', 19, 1),
(119, 7, 'Sist. y organ.', 19, 1),
(120, 8, 'Fisica I', 19, 1),
(121, 1, 'Alg. y Geom. Anali.', 16, 1),
(122, 2, 'Anali. Mat. I', 16, 1),
(123, 3, 'Sist. de Repr.', 16, 1),
(124, 4, 'Mat. discr.', 16, 1),
(125, 5, 'Alg. y estr. de dat.', 16, 1),
(126, 6, 'Arquit. de comp.', 16, 1),
(127, 7, 'Sist. y organ.', 16, 1),
(128, 8, 'Fisica I', 16, 1),
(129, 1, 'Alg. y Geom. Anali.', 18, 1),
(130, 2, 'Anali. Mat. I', 18, 1),
(131, 3, 'Sist. de Repr.', 18, 1),
(132, 4, 'Mat. discr.', 18, 1),
(133, 5, 'Alg. y estr. de dat.', 18, 1),
(134, 6, 'Arquit. de comp.', 18, 1),
(135, 7, 'Sist. y organ.', 18, 1),
(136, 8, 'Fisica I', 18, 1),
(137, 1, 'Alg. y Geom. Anali.', 21, 1),
(138, 2, 'Anali. Mat. I', 21, 1),
(139, 3, 'Sist. de Repr.', 21, 1),
(140, 4, 'Mat. discr.', 21, 1),
(141, 5, 'Alg. y estr. de dat.', 21, 1),
(142, 6, 'Arquit. de comp.', 21, 1),
(143, 7, 'Sist. y organ.', 21, 1),
(144, 8, 'Fisica I', 21, 1),
(145, 1, 'Alg. y Geom. Anali.', 23, 1),
(146, 2, 'Anali. Mat. I', 23, 1),
(147, 3, 'Sist. de Repr.', 23, 1),
(148, 4, 'Mat. discr.', 23, 1),
(149, 5, 'Alg. y estr. de dat.', 23, 1),
(150, 6, 'Arquit. de comp.', 23, 1),
(151, 7, 'Sist. y organ.', 23, 1),
(152, 8, 'Fisica I', 23, 1),
(153, 1, 'Alg. y Geom. Anali.', 24, 1),
(154, 2, 'Anali. Mat. I', 24, 1),
(155, 3, 'Sist. de Repr.', 24, 1),
(156, 4, 'Mat. discr.', 24, 1),
(157, 5, 'Alg. y estr. de dat.', 24, 1),
(158, 6, 'Arquit. de comp.', 24, 1),
(159, 7, 'Sist. y organ.', 24, 1),
(160, 8, 'Fisica I', 24, 1),
(161, 1, 'Alg. y Geom. Anali.', 25, 1),
(162, 2, 'Anali. Mat. I', 25, 1),
(163, 3, 'Sist. de Repr.', 25, 1),
(164, 4, 'Mat. discr.', 25, 1),
(165, 5, 'Alg. y estr. de dat.', 25, 1),
(166, 6, 'Arquit. de comp.', 25, 1),
(167, 7, 'Sist. y organ.', 25, 1),
(168, 8, 'Fisica I', 25, 1),
(169, 1, 'Alg. y Geom. Anali.', 26, 1),
(170, 2, 'Anali. Mat. I', 26, 1),
(171, 3, 'Sist. de Repr.', 26, 1),
(172, 4, 'Mat. discr.', 26, 1),
(173, 5, 'Alg. y estr. de dat.', 26, 1),
(174, 6, 'Arquit. de comp.', 26, 1),
(175, 7, 'Sist. y organ.', 26, 1),
(176, 8, 'Fisica I', 26, 1),
(177, 1, 'Alg. y Geom. Anali.', 27, 1),
(178, 2, 'Anali. Mat. I', 27, 1),
(179, 3, 'Sist. de Repr.', 27, 1),
(180, 4, 'Mat. discr.', 27, 1),
(181, 5, 'Alg. y estr. de dat.', 27, 1),
(182, 6, 'Arquit. de comp.', 27, 1),
(183, 7, 'Sist. y organ.', 27, 1),
(184, 8, 'Fisica I', 27, 1),
(185, 1, 'Alg. y Geom. Anali.', 28, 1),
(186, 2, 'Anali. Mat. I', 28, 1),
(187, 3, 'Sist. de Repr.', 28, 1),
(188, 4, 'Mat. discr.', 28, 1),
(189, 5, 'Alg. y estr. de dat.', 28, 1),
(190, 6, 'Arquit. de comp.', 28, 1),
(191, 7, 'Sist. y organ.', 28, 1),
(192, 8, 'Fisica I', 28, 1),
(193, 1, 'Alg. y Geom. Anali.', 29, 1),
(194, 2, 'Anali. Mat. I', 29, 1),
(195, 3, 'Sist. de Repr.', 29, 1),
(196, 4, 'Mat. discr.', 29, 1),
(197, 5, 'Alg. y estr. de dat.', 29, 1),
(198, 6, 'Arquit. de comp.', 29, 1),
(199, 7, 'Sist. y organ.', 29, 1),
(200, 8, 'Fisica I', 29, 1),
(251, 5, 'Alg. y estr. de dat.', 30, 1),
(250, 4, 'Mat. discr.', 30, 1),
(249, 3, 'Sist. de Repr.', 30, 1),
(248, 2, 'Anali. Mat. I', 30, 1),
(247, 1, 'Alg. y Geom. Anali.', 30, 1),
(252, 7, 'Sist. y organ.', 30, 1),
(257, 2, 'Anali. Mat. I', 31, 1),
(256, 1, 'Alg. y Geom. Anali.', 31, 1),
(258, 4, 'Mat. discr.', 31, 1),
(259, 3, 'Sist. de Repr.', 31, 1),
(322, 7, 'Sist. y organ.', 1, 1),
(320, 4, 'Mat. discr.', 1, 1),
(273, 5, 'Alg. y estr. de dat.', 2, 1),
(274, 11, 'Fisica II', 2, 2),
(275, 7, 'Sist. y organ.', 2, 1),
(277, 2, 'Anali. Mat. I', 32, 1),
(278, 5, 'Alg. y estr. de dat.', 32, 1),
(279, 16, 'Ingles I', 32, 1),
(280, 1, 'Alg. y Geom. Anali.', 34, 1),
(281, 6, 'Arquit. de comp.', 34, 1),
(282, 8, 'Fisica I', 34, 1),
(283, 2, 'Anali. Mat. I', 34, 1),
(284, 4, 'Mat. discr.', 34, 1),
(285, 5, 'Alg. y estr. de dat.', 34, 1),
(286, 3, 'Sist. de Repr.', 34, 1),
(287, 1, 'Alg. y Geom. Anali.', 35, 1),
(288, 5, 'Alg. y estr. de dat.', 35, 1),
(289, 6, 'Arquit. de comp.', 35, 1),
(290, 7, 'Sist. y organ.', 35, 1),
(291, 8, 'Fisica I', 35, 1),
(292, 3, 'Sist. de Repr.', 35, 1),
(293, 2, 'Anali. Mat. I', 35, 1),
(294, 4, 'Mat. discr.', 35, 1),
(319, 2, 'Anali. Mat. I', 1, 1),
(318, 1, 'Alg. y Geom. Anali.', 1, 1),
(340, 7, 'Sist. y organ.', 37, 1),
(339, 5, 'Alg. y estr. de dat.', 37, 1),
(338, 4, 'Mat. discr.', 37, 1),
(337, 2, 'Anali. Mat. I', 37, 1),
(341, 10, 'Anali. Matem. II', 37, 1),
(342, 11, 'Fisica II', 37, 1),
(343, 12, 'An. de Sist.', 37, 1),
(344, 13, 'Sint. y Sem. de Leng.', 37, 1),
(345, 15, 'Sist. Operativos', 37, 1),
(346, 1, 'Alg. y Geom. Anali.', 37, 1),
(347, 6, 'Arquit. de comp.', 37, 1),
(348, 12, 'An. de Sist.', 38, 1),
(349, 13, 'Sint. y Sem. de Leng.', 38, 1),
(357, 12, 'An. de Sist.', 39, 1),
(358, 13, 'Sint. y Sem. de Leng.', 39, 1),
(359, 15, 'Sist. Operativos', 39, 1),
(365, 14, 'Parad. de Progr.', 41, 1),
(364, 13, 'Sint. y Sem. de Leng.', 41, 1),
(363, 6, 'Arquit. de comp.', 41, 1),
(366, 15, 'Sist. Operativos', 41, 1);

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
  `Detalles` longtext COLLATE utf8_unicode_ci NOT NULL,
  `Tipofecha` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `Fechaentrega` datetime NOT NULL,
  `Fechafin` datetime NOT NULL,
  `Tipo` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `Comision` int(2) NOT NULL,
  `Compartido` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idtarea`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=70 ;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`idtarea`, `Usuarioagre`, `Fechaagre`, `Modsino`, `Lastusmod`, `Lastdatmod`, `Materia`, `Nombre`, `Detalles`, `Tipofecha`, `Fechaentrega`, `Fechafin`, `Tipo`, `Comision`, `Compartido`) VALUES
(55, 1, '2016-04-07 11:10:56', 0, 1, '2016-04-07 11:10:56', 15, 'Primer recuperatorio', '<p>Se recuperan primer y segundo parcial practicos</p>', 'ESP', '2016-11-22 16:30:00', '2016-11-22 16:30:00', 'RE', 1, 'SI'),
(54, 1, '2016-04-07 10:59:19', 0, 1, '2016-04-07 10:59:19', 15, 'Segunda Evaluacion Globalizadora', '<p>Examen para promocion directa</p>\n<p>Temas a rendir</p>\n<ul>\n<li>Administracion de archivos</li>\n<li>Administracion de entrada-salida</li>\n<li>Proteccion y seguridad</li>\n<li>Sistemas de multiples procesadores</li>\n<li>Sistemas de proposito especial</li>\n</ul>', 'ESP', '2016-11-08 16:30:00', '2016-11-08 16:30:00', 'FL', 1, 'SI'),
(53, 1, '2016-04-07 10:54:45', 1, 1, '2016-04-07 11:01:02', 15, 'Primera Evaluación Globalizadora', '<p><em>Examen para promocion directa</em></p>\n<p>Temas a rendir</p>\n<ul>\n<li>Estructuras de sistemas operativos</li>\n<li>Administracion de procesos</li>\n<li>Administracion de memoria</li>\n<li>Administracion de memoria virtual</li>\n</ul>', 'ESP', '2016-09-10 16:30:00', '2016-09-10 16:30:00', 'FL', 1, 'SI'),
(52, 1, '2016-04-07 10:50:16', 0, 1, '2016-04-07 10:50:16', 15, 'Segundo parcial', '<p>Temas a rendir&nbsp;</p>\n<ul>\n<li>Administracion de memoria</li>\n<li>Administracion de memoria virtual</li>\n</ul>', 'ESP', '2016-08-16 16:30:00', '2016-08-16 16:30:00', 'PC', 1, 'SI'),
(11, 1, '2015-03-18 06:55:34', 0, 1, '2015-03-18 06:55:34', 4, '2do integrador(Rec para promocion de trab. prac)', 'Parte práctica de la materia', 'ESP', '2016-02-19 02:00:00', '2016-02-19 00:00:00', 'FL', 1, 'SI'),
(51, 1, '2016-04-07 01:44:38', 0, 1, '2016-04-07 01:44:38', 15, 'Primer Parcial', '<p>Temas a rendir:</p>\n<ul>\n<li>Estructuras de sistemas operativos</li>\n<li>Administracion de procesos</li>\n</ul>', 'ESP', '2016-06-09 14:00:00', '2016-06-09 14:00:00', 'PC', 1, 'SI'),
(50, 1, '2016-04-07 01:23:36', 0, 1, '2016-04-07 01:23:36', 12, 'Tercer recuperatorio', '<p>Para recuperar <strong>segundo parcial</strong> o un integrador para <strong>recuperar</strong> la materia</p>', 'ESP', '2017-02-22 16:25:00', '2017-02-22 16:25:00', 'RE', 1, 'SI'),
(15, 1, '2015-03-18 18:55:40', 0, 1, '2015-03-18 18:55:40', 4, 'Rec 3er parcial', 'Unidades 5 y 6', 'VAR', '2016-02-15 00:00:00', '2016-02-20 00:00:00', 'RE', 1, 'SI'),
(49, 1, '2016-04-07 01:21:56', 0, 1, '2016-04-07 01:21:56', 12, 'Segundo recuperatorio', '<p>Para recuperar primer o segundo parcial. Ultima oportunidad para promocionar</p>', 'ESP', '2016-12-14 16:25:00', '2016-12-14 16:25:00', 'RE', 1, 'SI'),
(48, 1, '2016-04-07 01:20:24', 0, 1, '2016-04-07 01:20:24', 12, 'Primer recuperatorio', '<p>Para recuperar el primer parcial. Pueden presentarse para promocionar</p>', 'ESP', '2016-08-17 16:25:00', '2016-08-17 16:25:00', 'RE', 1, 'SI'),
(47, 1, '2016-04-07 00:10:12', 0, 1, '2016-04-07 00:10:12', 12, 'Segundo Parcial', '<p>Temas a rendir:Unidades 6 a 11 (Analisis Orientado a objetos-Casos de uso-Proceso unificado)</p>', 'ESP', '2016-11-09 16:25:00', '2016-11-09 16:25:00', 'PC', 1, 'SI'),
(46, 1, '2016-04-07 00:04:03', 4, 1, '2016-04-07 01:07:05', 12, '1 er parcial', '<p><strong>Temas a rendir:</strong> Unidades 1 a 3 (Captura de requerimientos e Ingenieria de Requisitos)</p>', 'ESP', '2016-06-29 16:25:00', '2016-06-29 16:25:00', 'PC', 1, 'SI'),
(45, 1, '2016-03-06 00:59:30', 0, 1, '2016-03-06 00:59:30', 5, 'Tarea de prueba', '<p>Detalles de prueba</p>', 'ESP', '2016-03-17 12:30:00', '2016-03-17 12:30:00', 'TP', 1, 'SI'),
(24, 1, '2015-03-19 11:39:47', 0, 1, '2015-03-19 11:39:47', 7, 'Rec todos los parciales (Ultima instancia)', 'Todas las unidades y TPI', 'ESP', '2016-02-23 00:00:00', '2016-02-23 00:00:00', 'RE', 1, 'SI'),
(43, 1, '2015-12-27 12:40:01', 5, 1, '2015-12-27 15:29:55', 5, 'Prueba fecha', '<p>Esta es la prueba de la hora y el minuto</p>', 'ESP', '2015-12-30 07:45:00', '2015-12-30 07:45:00', 'TP', 1, 'SI'),
(44, 1, '2016-01-20 12:24:47', 1, 1, '2016-01-23 00:38:03', 5, 'Evento de prueba', '<p>Este es un evento de prueba</p>', 'ESP', '2016-01-30 12:30:00', '2016-01-30 12:30:00', 'PC', 1, 'SI'),
(42, 1, '2015-12-26 14:29:54', 4, 1, '2015-12-27 15:25:31', 7, 'Prueba del dia', '<p>Este es un evento de prueba</p>', 'ESP', '2015-12-27 08:00:00', '2015-12-27 08:00:00', 'TP', 1, 'SI'),
(40, 1, '2015-12-26 13:12:55', 0, 1, '2015-12-26 13:12:55', 3, 'Trabajos completos', '<p>Completar todos los trabajos del a&ntilde;o</p>', 'ESP', '2015-12-31 00:00:00', '2015-12-31 00:00:00', 'TP', 1, 'SI'),
(37, 1, '2015-12-26 00:59:47', 3, 1, '2015-12-26 12:52:55', 5, 'Prueba', '<p>Este es un evento de prueba&nbsp;</p>', 'ESP', '2015-12-30 00:00:00', '2015-12-30 00:00:00', 'FL', 1, 'SI'),
(36, 2, '2015-12-23 13:34:58', 8, 1, '2015-12-28 13:41:19', 3, 'Trabajos campus', '<p>Completar los trabajos del campus numero 3 al 5</p>', 'ESP', '2015-12-28 09:00:00', '2015-12-28 09:00:00', 'TP', 1, 'SI'),
(56, 1, '2016-04-07 12:06:48', 0, 1, '2016-04-07 12:06:48', 15, 'Primer Recuperatorio Globalizadoras', '<p>Se recuperan 1er y 2da evaluaciones globalizadoras</p>', 'ESP', '2016-12-13 16:30:00', '2016-12-13 16:30:00', 'RE', 1, 'SI'),
(57, 1, '2016-04-07 23:33:51', 0, 1, '2016-04-07 23:33:51', 15, 'Segundo recuperatorio', '<p>Se recuperan 1er y 2da evaluaciones parciales y globalizadoras</p>', 'ESP', '2017-02-23 14:30:00', '2017-02-23 14:30:00', 'RE', 1, 'SI'),
(58, 1, '2016-04-07 23:37:10', 0, 1, '2016-04-07 23:37:10', 13, 'Practica extraordinaria', '<p>Sin detalles</p>', 'ESP', '2016-04-13 14:00:00', '2016-04-13 14:00:00', 'PC', 1, 'SI'),
(59, 1, '2016-04-07 23:39:30', 0, 1, '2016-04-07 23:39:30', 13, 'Primera evaluación practica', '<p>Sin detalles</p>', 'ESP', '2016-05-19 16:30:00', '2016-05-19 16:30:00', 'PC', 1, 'SI'),
(60, 1, '2016-04-07 23:40:33', 0, 1, '2016-04-07 23:40:33', 13, 'Segunda evaluación practica', '<p>Sin detalles</p>', 'ESP', '2016-06-24 14:00:00', '2016-06-24 14:00:00', 'PC', 1, 'SI'),
(61, 1, '2016-04-07 23:58:02', 0, 1, '2016-04-07 23:58:02', 13, 'Primera evaluación teorica', '<p>Sin detalles</p>', 'ESP', '2016-05-23 14:30:00', '2016-05-23 14:30:00', 'PC', 1, 'SI'),
(62, 1, '2016-04-08 00:21:54', 0, 1, '2016-04-08 00:21:54', 13, 'Segunda evaluacion teorica', '<p>Sin detalles</p>', 'ESP', '2016-06-27 14:30:00', '2016-06-27 14:30:00', 'PC', 1, 'SI'),
(63, 1, '2016-04-08 00:39:03', 17, 1, '2016-04-13 23:05:33', 6, 'Final arquitectura', '<p>Temas muy probables que entraran:</p>\n<ul>\n<li>Codificacion <strong>alfanumerica</strong></li>\n<li>Aritmetica flotante</li>\n<li>ALU para operacion en <strong>coma flotante</strong></li>\n<li>Arquitecturas <strong>Von Neuman y Harvard</strong>. Enunciados&nbsp;que entraron en finales anteriores:\n<ul>\n<li>Comparaci&oacute;n <span class="highlightNode">Arq</span>, Von Neuman vs <span class="highlightNode">Arq</span>. Harvard. Ventajas y desventajas de cada una</li>\n</ul>\n</li>\n<li>Arquitecturas <strong>CISC yRISC&nbsp;<span style="text-decoration: underline;">(485-504</span></strong><span style="text-decoration: underline;"><strong>&nbsp;Stallings)</strong></span>. Enunciados&nbsp;que entraron en finales anteriores:\n<ul>\n<li>Relacion con respecto al dise&ntilde;o de la unidad de control</li>\n</ul>\n</li>\n<li>Pipeline <span style="text-decoration: underline;"><strong>(271-295 Meinadier)(449-460<span style="text-decoration: underline;"><strong>&nbsp;Stallings)</strong></span></strong></span></li>\n<li>Jerarquia de memoria<strong><span style="text-decoration: underline;">(107-111&nbsp;</span></strong><span style="text-decoration: underline;"><strong>Stallings)</strong></span></li>\n<li><strong>Microprogramacion <span style="text-decoration: underline;">(184-197 Meinadier)(623-662&nbsp;Stallings)</span></strong>. Enunciados&nbsp;que entraron en finales anteriores:<br />\n<ul>\n<li>Ecuacion y diagrama l&oacute;gico de una microinstruci&oacute;n de <strong>ABACUS</strong>., como por ejemplo:ecuaci&oacute;n Suma : SUM=sum.O y hacer el diagrama l&oacute;gico sacando O del Reg. de Estado de Operaci&oacute;n y la sum de la parte del CO del Reg de Instuci&oacute;n.</li>\n<li>Acompasamiento de las micro-instrucciones</li>\n<li>Modelo de Wilkes</li>\n</ul>\n</li>\n<li><strong>Perifericos</strong>. Enunciados&nbsp;que entraron en finales anteriores:<br />\n<ul>\n<li><strong>Impresora</strong> l&aacute;ser. Funcionamiento. Caracter&iacute;sticas. Diferencias con la de chorro de tinta</li>\n<li>Impresora chorro de tinta. Esquema y funcionamiento</li>\n</ul>\n</li>\n</ul>\n<p>www.mega.nz/#F!3kQl1JCD!05FmNkL34nMWYcdl98ITAQ</p>', 'ESP', '2016-05-03 12:30:00', '2016-05-03 12:30:00', 'FL', 1, 'SI'),
(64, 1, '2016-04-08 00:40:15', 0, 1, '2016-04-08 00:40:15', 4, 'Final Discreta', '<p>Sin detalles</p>', 'ESP', '2016-05-04 12:30:00', '2016-05-04 12:30:00', 'FL', 1, 'SI'),
(65, 1, '2016-04-08 00:41:32', 0, 1, '2016-04-08 00:41:32', 7, 'Final SyO', '<p>Sin detalles</p>', 'ESP', '2016-05-05 12:30:00', '2016-05-05 12:30:00', 'FL', 1, 'SI'),
(66, 1, '2016-04-08 00:57:59', 1, 1, '2016-04-08 01:01:08', 2, 'Entrega Cuestionario 2', '<p>Tema <strong>funciones</strong></p>', 'ESP', '2016-04-08 00:00:00', '2016-04-08 00:00:00', 'TP', 1, 'SI'),
(67, 1, '2016-04-08 00:59:55', 0, 1, '2016-04-08 00:59:55', 2, 'Trabajo Practico 3', '<p>Tema <strong>sucesiones</strong></p>', 'ESP', '2016-04-15 00:00:00', '2016-04-15 00:00:00', 'TP', 1, 'SI'),
(68, 1, '2016-04-08 01:56:10', 1, 1, '2016-04-08 01:57:11', 2, 'Primer Parcial', '<p>Temas a rendir</p>\n<ul>\n<li>Numeros reales</li>\n<li>Funciones</li>\n<li>Sucesiones</li>\n<li>Limites</li>\n<li>Continuidad</li>\n</ul>', 'ESP', '2016-05-06 08:30:00', '2016-05-06 08:30:00', 'PC', 1, 'SI'),
(69, 37, '2016-04-08 21:43:55', 0, 37, '2016-04-08 21:43:55', 2, 'Final de analsiis', '<p>sadsadsadsadsadsadasd</p>', 'VAR', '2016-04-12 00:00:00', '2016-04-22 00:00:00', 'FL', 1, 'SI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposaagregar`
--

CREATE TABLE IF NOT EXISTS `tiposaagregar` (
  `idtipo` int(11) NOT NULL AUTO_INCREMENT,
  `Desctipo` text COLLATE utf8_unicode_ci NOT NULL,
  `Fecha` datetime NOT NULL,
  `Usuario` int(11) NOT NULL,
  PRIMARY KEY (`idtipo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tiposarchivos`
--

CREATE TABLE IF NOT EXISTS `Tiposarchivos` (
  `idtipo` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `Descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `Extension` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Imagen` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idtipo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `Tiposarchivos`
--

INSERT INTO `Tiposarchivos` (`idtipo`, `Nombre`, `Descripcion`, `Extension`, `Imagen`) VALUES
(3, 'Documento PDF', 'application/pdf', '.pdf', 'imagenes/iconosprogramas/pdf.png'),
(2, 'Documento PDF', 'application/pdf', '.pdf', 'imagenes/iconosprogramas/pdf.png'),
(1, 'Indefinido', '', '', 'imagenes/iconosprogramas/pdf.png'),
(5, 'Documento Word', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '.docx', 'imagenes/iconosprogramas/wordlogo.png'),
(6, 'Documento Word', 'application/msword', '.doc', 'imagenes/iconosprogramas/wordlogo.png'),
(7, 'Documento Excel', 'application/vnd.ms-excel', '.xls', 'imagenes/iconosprogramas/Excellogo.png'),
(8, 'Documento Excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', '.xlsx', 'imagenes/iconosprogramas/Excellogo.png'),
(9, 'Imagen PNG', 'image/png', '.png', 'imagenes/iconosprogramas/image_png_100940.png'),
(10, 'Imagen JPG', 'image/jpeg', '.jpg', 'imagenes/iconosprogramas/imagenjpg.png'),
(11, 'Video 3GP', 'video/3gpp', '.3gp', 'imagenes/iconosprogramas/icono-video.png'),
(12, 'Archivo comprimido 7-Zip', 'application/x-7z-compressed', '.7z', 'imagenes/iconosprogramas/winzip.png'),
(13, 'Pelicula Adobe Flash', 'application/x-shockwave-flash', '.swf', 'imagenes/iconosprogramas/swf.png'),
(14, 'Archivo MS Onenote', 'application/msonenote', '.one', 'imagenes/iconosprogramas/onnete.png'),
(15, 'Presentación de PowerPoint', 'application/vnd.ms-powerpoint.presentation.macroenabled.12', '.pptm', 'imagenes/iconosprogramas/powerpoint.png'),
(16, 'Presentacion de Powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', '.pptx', 'imagenes/iconosprogramas/powerpoint.png'),
(17, 'Documento de Excel', 'application/vnd.ms-excel.sheet.macroenabled.12', '.xlsm', 'imagenes/iconosprogramas/Excellogo.png'),
(18, 'Presentacion de Powerpoint', 'application/vnd.ms-powerpoint.slideshow.macroenabled.12', '.ppsm', 'imagenes/iconosprogramas/powerpoint.png'),
(19, 'Presentacion de Powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.slideshow', '.ppsx', 'imagenes/iconosprogramas/powerpoint.png'),
(20, 'Archivo de intercalación de audio y vídeo (.avi)', 'video/x-msvideo', '.avi', 'imagenes/iconosprogramas/icono-video.png'),
(21, 'Microsoft Windows Media Video', 'video/x-ms-wmv', '.wmv', 'imagenes/iconosprogramas/icono-video.png'),
(22, 'Archivo Comprimido RAR', 'application/x-rar-compressed', '.rar', 'imagenes/iconosprogramas/comprimido.png'),
(23, 'Generico', 'application/octet-stream', '', 'imagenes/iconosprogramas/texto.png'),
(24, 'Presentación de PowerPoint', 'application/vnd.ms-powerpoint', '.pptm', 'imagenes/iconosprogramas/powerpoint.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutoriales`
--

CREATE TABLE IF NOT EXISTS `tutoriales` (
  `idtutorial` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `Texto` text COLLATE utf8_unicode_ci NOT NULL,
  `Categoria` int(11) NOT NULL,
  `Fechaagre` datetime NOT NULL,
  PRIMARY KEY (`idtutorial`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `tutoriales`
--

INSERT INTO `tutoriales` (`idtutorial`, `Nombre`, `Texto`, `Categoria`, `Fechaagre`) VALUES
(1, 'Ver todos los detalles de una tarea', '<p>Una vez en la pagina princip&agrave;l debemos realizar los siguientes pasos</p>\n<ul>\n<li>Ubicar la tarea en cuestion</li>\n<li style="text-align: justify;">Presionar sobre ella</li>\n</ul>\n<p><img src="imagenes/detallestarea.png" alt="tarea" width="100%" /></p>\n<ul>\n<li>Entonces se nos abrira un dialogo donde podremos apreciar tres secciones principales del mismo\n<p><strong>La seccion de visualizacion de detalles que sera la mostrada por defecto (al abrir la ventana)</strong></p>\n<p><img src="imagenes/verdetalles.png" alt="tarea" width="100%" /></p>\n<p><em>En esta seccion se nos mostraran todos los detalles correspondientes a la tarea seleccionada como los temas a estudiar, la fecha de entrega , la cantidad de modificaciones realizadas a la tarea, etc</em></p>\n<p><strong>La seccion de links utiles</strong></p>\n<p><img src="imagenes/linksutiles.png" alt="tarea" width="100%" /></p>\n<p><em>En esta seccion seran mostrados todos los enlaces considerados como utiles para poder completar la tarea o para poder estudiar un examen</em></p>\n<p><strong>La seccion de modificacion de los detalles de la tarea</strong></p>\n<p><img src="imagenes/editardetalles.png" alt="tarea" width="100%" /></p>\n<p><em>&nbsp;</em></p>\n</li>\n</ul>', 2, '2015-04-09 19:03:11'),
(2, 'Agregar una tarea', '<p>Presionar el siguiente boton ubicado en la parte superior de la pagina principal</p>\n<p><img src="imagenes/agregar.png" alt="tarea" width="100%" /></p>\n<p>Entonces nos aparecera un dialogo donde deberemos ingresar los siguientes detalles correspondientes a la tarea que deseamos&nbsp;agregar</p>\n<ul style="list-style-type: circle;">\n<li>Nombre de la tarea</li>\n<li>Materia a la que sera agregada la tarea</li>\n<li>Tipo de la tarea (<em>Parcial, TP, Recuperatorio, etc</em>)</li>\n<li>Detalles de la tarea</li>\n<li>Fecha de entrega o de mesa La fecha podra ser de dos tipos distintos\n<p><strong>Fecha especifica</strong></p>\n<p><img src="imagenes/fechaespecifica.png" alt="tarea" width="100%" /></p>\n<p>Deberemos seleccionar cual sera esa fecha</p>\n<p><strong>Rango de tiempo</strong></p>\n<p><img src="imagenes/rangodetiempo.png" alt="tarea" width="100%" /></p>\n<p>Deberemos seleccionar la fecha de inicio y la fecha en la que termina la mesa o entrega de la tarea</p>\n<p>En ambos casos deberemos seleccionar las fecha de un calendario que se desplegara al hacer foco en el campo de texto correspondiente</p>\n<p><img src="imagenes/calendario.png" alt="tarea" width="100%" /></p>\n</li>\n</ul>', 2, '2015-04-09 22:08:19'),
(3, 'Eliminar una tarea', '<p>Para poder eliminar una determinada tarea de la lista deberemos ser&nbsp;quien agrego a la tarea en cuestion. En el caso de que esto se cumpla podremos ver en el lateral derecho de la misma un boton el cual deberemos presionar</p>\n<p><img src="imagenes/eliminar.png" alt="tarea" width="100%" /></p>\n<p>Al presionar este boton nos aparecera un dialogo de confirmacion y luego de seleccionar la opcion SI la tarea sera eliminada</p>', 2, '2015-04-09 22:39:10'),
(4, '¿Que son los links utiles?', '<p>Son enlaces que pueden ser agregados por cada uno de nosotros a una determinada tarea y serviran como recurso que podremos compartir con nuestros compa&ntilde;eros para indicar que en la pagina en cuestion encontramos contenido util para la realizacion de la tarea o para el estudio de un examen.</p>', 3, '2015-04-09 22:54:38'),
(5, '¿Como acceder a estos links?', '<p>En primer lugar debemos verificar si a una tarea en particular han sido agregados los links&nbsp;</p>\r\n<p>Para eso accedemos a dicha tarea y nos dirigimos a la segunda seccion del dialogo&nbsp;</p>\r\n<p><img src="imagenes/linksutiles.png" alt="tarea" width="100%" /></p>\r\n<p>Una vez que hayamos presionado sobre el boton de la imagen superior esta seccion sera desplegada y en caso de que existan links relacionados a esta tarea nos aparecera una lista similar a la siguiente</p>\r\n<p><img src="imagenes/listadelinks.png" alt="tarea" width="100%" /></p>\r\n<p>En la imagen podremos observar las caracteristicas de esta lista</p>\r\n<ul style="list-style-type: circle;">\r\n<li>Cada elemento de lista consistira del enlace en si que sera un boton que al presionar nos abrira una nueva pesta&ntilde;a con la pagina de destino</li>\r\n<li>En el lateral de este boton observaremos el boton de info&nbsp;que al presionarlo se desplegara por debajo del elemento de lista una seccion que contendra notas del link asi como otros detalles adicionales&nbsp;</li>\r\n</ul>\r\n<p><img src="imagenes/notaslink.png" alt="tarea" width="100%" /></p>\r\n<ul style="list-style-type: circle;">\r\n<li>Ademas en caso de que nosotros seamos quienes agregamos el link nos apareceran las opciones para modificarlo o eliminarlo</li>\r\n</ul>', 3, '2015-04-10 00:37:04'),
(6, 'Eliminar un link', '<p>En primer lugar debemos tener en cuenta que las opciones de eliminacion y modificacion de un determinado link solo nos apareceran en caso de que hayamos sido nosotros quienes lo agregamos a dicho link</p>\r\n<p>En caso de que esto se cumpla debemos dirigirnos a la lista de links donde se encuentra el enlace a eliminar y presionar el boton de info del link en cuestion</p>\r\n<p>De esta forma se despliegara la seccion de detalles adicionales del link y al final de dicha seccion podremos encontrar el siguiente boton</p>\r\n<p><img src="imagenes/eliminarlink.png" alt="tarea" width="100%" /></p>\r\n<p>Al presionarlo nos aparecera un popup de confirmacion y luego de seleccionar la opcion afirmativa el link sera eliminado</p>', 3, '2015-04-10 01:07:00'),
(7, 'Modificar un link', '<p>En primer lugar debemos tener en cuenta que las opciones de eliminacion y modificacion de un determinado link solo nos apareceran en caso de que hayamos sido nosotros quienes lo agregamos a dicho link</p>\r\n<p>En caso de que esto se cumpla debemos dirigirnos a la lista de links donde se encuentra el enlace a modificar y presionar el boton de info del link en cuestion</p>\r\n<p>De esta forma se despliegara la seccion de detalles adicionales del link y al final de dicha seccion podremos encontrar el siguiente boton</p>\r\n<p><img src="imagenes/modificarlink.png" alt="tarea" width="100%" /></p>\r\n<p>Al presionarlo se ocultara la seccion de visualizacion de detalles del link y nos apareceran unos cuadros de texto con la informacion actual de link y en los que podremos ingresar nuevos datos</p>\r\n<p><img src="imagenes/modificardetlink.png" alt="tarea" width="100%" /></p>\r\n<p>Para guardar los cambios&nbsp;basta con presionar el boton</p>\r\n<p><img src="imagenes/modificaraldetails.png" alt="tarea" width="100%" /></p>', 3, '2015-04-10 01:35:15'),
(8, 'Modificar una tarea', '<ol>\r\n<li>Seleccionar la tarea a modificar presionando sobre ella</li>\r\n<li>Luego dirigirnos a la seccion de modificacion de los detalles&nbsp;\r\n<p><img src="imagenes/ediciondetalles.png" alt="tarea" width="100%" /></p>\r\n</li>\r\n<li>Una vez alli ingresamos los nuevos datos y presionamos el siguiente boton para guardar todos los cambios realizados\r\n<p><img src="imagenes/modificardetailsss.png" alt="tarea" width="100%" /></p>\r\n</li>\r\n</ol>', 2, '2015-04-10 11:44:11'),
(9, 'Modificar materias de cursado', '<p>Presionar el boton de configuracion <img src="imagenes/wp_ss_20150319_0001.png" alt="tarea" width="30" height="30" />&nbsp;ubicado en la esquina&nbsp;superior derecha y luego seleccionar la siguiente opcion</p>\r\n<p><img src="imagenes/changesub.png" alt="tarea" width="100%" /></p>\r\n<p>Entonces se mostrara una nueva pagina en donde podremos observar los siguientes detalles&nbsp;</p>\r\n<ul style="list-style-type: circle;">\r\n<li>Un menu de seleccion donde estaran marcadas las <strong>n</strong> comisiones en la que estamos cursando actualmente las materias</li>\r\n<li>Por debajo de este menu encontraremos una <strong>n&nbsp;</strong>cantidad de otros menus de seleccion en donde <strong>n</strong> es la cantidad de comisiones en la que estamos cursando En cada uno de estos estaran seleccionados las materias que estamos cursando en cada comision\r\n<p><img src="imagenes/modificarsubc.png" alt="tarea" width="100%" /></p>\r\n</li>\r\n<li>Las opciones seleccionadas en cada uno de estos menus podran ser cambiadas</li>\r\n<li>En caso de que estemos cursando en una comision perteneciente a una carrera distinta a la nuesta el menu de seleccion correspondiente contendra la lista de materias homogeneas que pueden ser&nbsp;cursadas en dicha comision</li>\r\n</ul>', 1, '2015-04-13 19:25:02');

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
  `Fotoperfil` text COLLATE utf8_unicode_ci NOT NULL,
  `Email` text COLLATE utf8_unicode_ci NOT NULL,
  `Carrera` int(4) NOT NULL,
  `Fecharegistro` datetime NOT NULL,
  `Idlastmod` int(11) NOT NULL,
  `Fechalvisit` datetime NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=42 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `Usuario`, `Pass`, `Nombre`, `Apellido`, `Fotoperfil`, `Email`, `Carrera`, `Fecharegistro`, `Idlastmod`, `Fechalvisit`) VALUES
(1, 'Aug1919', 'myutnpr18', 'Gerardo Augusto', 'Romero', 'fp.JPG', 'geragusto@hotmail.com', 1, '2015-03-13 01:14:16', 186, '2016-04-17 13:05:42'),
(2, 'Gera1919', 'Gera1919', 'Gerardo', 'Ibarra', '', 'geragusto@hotmail.com', 1, '2015-03-18 02:04:00', 146, '2016-01-26 19:15:49'),
(3, 'Bill87', 'myBil897', 'Bill', 'Gates', '', 'bill87@hotmail.com', 1, '2015-03-14 13:55:14', 0, '2015-12-23 13:37:29'),
(4, 'Mark1718', 'Zuckface18', 'Mark', 'Zuckenverg', '', 'mark54@hotmail.com', 1, '2015-03-15 21:05:05', 70, '2015-04-01 23:59:09'),
(5, 'Geraa1719', 'TomorBD18', 'Gerardo', 'Godoy', '', 'geraroner@hotmail.com', 1, '2015-03-17 14:47:04', 0, '2015-03-26 10:03:36'),
(6, 'juanluucas', 'pirata95', 'Juan Lucas', 'Biain', '', 'barce.juanlucas@gmail.com', 1, '2015-03-18 10:25:12', 12, '2015-03-26 10:03:36'),
(7, 'EduardoJadu', '39192927', 'Eduardo', 'Ferreyra', '', 'jadu_015@hotmail.com', 1, '2015-03-18 10:25:45', 12, '2015-03-26 10:03:36'),
(8, 'Facundo', '3913610123', 'Facundo', 'Quiróz', '', 'facu-quiroz@live.com.ar', 1, '2015-03-18 10:25:57', 179, '2016-04-10 22:47:10'),
(9, 'gonza120', 'kllk1118', 'gonzalo', 'vera', '', 'gonzalo.nicolas.vera@gmail.com', 1, '2015-03-18 10:25:59', 61, '2015-03-26 10:03:36'),
(10, 'nachox066', 'nacho1212', 'ignacio', 'benitez', '', 'benitezvucasignacio@gmail.com', 1, '2015-03-18 10:26:12', 12, '2015-03-26 10:03:36'),
(11, 'GonzaloZ', '15288317', 'Gonzalo', 'Zalazar', '', 'gonza_ale@live.com', 1, '2015-03-18 10:26:35', 61, '2015-03-26 10:03:36'),
(12, 'Leandroasano', 'asanit14', 'Leo', 'Asano', '', 'lean_200_9@hotmail.com', 1, '2015-03-18 10:26:41', 16, '2015-03-26 10:03:36'),
(13, 'nitneciv', '12470Miguel', 'Erick', 'Vicentin', '', 'erickvicentin14@hotmail.com', 1, '2015-03-18 10:30:43', 32, '2015-03-26 10:03:36'),
(20, 'e_erkia', '60daf4ff51996', 'Esperanza', 'Erkia', '', 'erkiav@gmail.com', 1, '2015-03-18 12:54:22', 12, '2015-03-26 10:03:36'),
(19, 'gabriel109', 'wiroos', 'gabriel', 'diez', '', 'gabrieldiez@hotmail.com', 1, '2015-03-18 12:39:36', 38, '2015-03-26 10:03:36'),
(16, 'Edgarcardozo1', '40049181', 'Edgar', 'Cardozo', '', 'edgar07cardozo@hotmail.com', 1, '2015-03-18 11:15:55', 12, '2015-03-26 10:03:36'),
(18, 'Nicolas_1128', 'd1osesf1el', 'Nicolas', 'Cuevas', '', 'nicolascuevasing@hotmail.com', 1, '2015-03-18 12:26:33', 12, '2015-03-26 10:03:36'),
(21, 'gaston256', 'palermo1998', 'Gaston', 'Gonzalez', '', 'gaston.gonzalez.256@gmail.com', 1, '2015-03-18 13:31:12', 33, '2015-03-26 10:03:36'),
(23, 'cristian_96', 'N8kiabelle', 'Cristian', 'Florentin', '', 'kristian.alex96@gmail.com', 1, '2015-03-18 14:21:12', 88, '2015-05-06 10:49:16'),
(24, 'edgardo', 'edgardo', 'edgardo', 'sotelo', '', 'edgardo_ss_lc@hotmail.com', 1, '2015-03-18 19:20:13', 16, '2015-03-26 10:03:36'),
(25, 'micaela', 'soledad04', 'micaela', 'quintana', '', 'micaela-quintana@hotmail.com', 1, '2015-03-18 19:20:23', 92, '2015-12-23 13:38:09'),
(26, 'GonzalezCM', '399382822', 'Carlos', 'González', '', 'dwsitiocarlos@gmail.com', 1, '2015-03-18 19:49:29', 16, '2015-03-26 10:03:36'),
(27, 'eve.escobar', '39776019Kirai', 'Araceli Evelyn', 'Escobar', '', 'evelyn_fan@hotmail.com', 1, '2015-03-20 11:08:38', 33, '2015-03-26 10:03:36'),
(28, 'AgustinMorales', '39634808', 'Agustin', 'Morales', '', 'viejoo_1396@hotmail.com', 1, '2015-03-23 22:30:47', 38, '2015-03-26 10:03:36'),
(29, 'JuanSanCristobal', 'Modernwarfare2', 'Juan', 'San Cristobal', '', 'juansan97@gmail.com', 1, '2015-03-25 18:37:24', 61, '2015-03-26 10:03:36'),
(30, 'Gera1918', 'Gera1918', 'Gera', 'Ibarra', '', 'geragus@hotmail.com', 1, '2015-04-03 13:29:26', 85, '2015-04-09 22:36:21'),
(31, 'Aug2020', 'Aug2020', 'Augusto', 'Romero', '', 'geraguso@hotmail.com', 1, '2015-04-20 19:47:34', 88, '2015-04-21 18:48:08'),
(32, 'heifer', '39125037a', 'yoel', 'ramirez', '', 'yo_el_11_@hotmail.com', 1, '2016-01-19 13:33:58', 131, '2016-01-19 13:50:08'),
(33, 'GuidoStangaferro', 'leonardo97', 'Guido', 'Stangaferro', '', 'guidogames97@gmail.com', 1, '2016-01-19 22:14:42', 131, '2016-01-19 22:15:02'),
(34, 'cualquiera', 'cualquiera', 'cualquiera', 'cualquiera', '', 'cualquiera@hotmail.com', 1, '2016-01-19 22:16:51', 131, '2016-01-19 22:45:36'),
(35, 'Flor18', 'Flor18', 'Florencia Lucia', 'Romero', 'fp1.jpg', 'Flor18@gmail.com', 1, '2016-01-22 12:44:37', 137, '2016-01-22 18:50:36'),
(36, 'Luciano16', '12345', 'Luciano ', 'Sponton', '', 'Lucho2798@gmail.com', 1, '2016-04-05 22:02:22', 147, '2016-04-05 22:04:28'),
(37, 'Pablo14697', '39752687LPDAa2012', 'Pablo', 'Medina', '', 'pablomed88@gmail.com', 1, '2016-04-08 18:11:46', 195, '2016-04-13 22:23:35'),
(38, 'maxi_quinonez', '18081996', 'Carlos Maximiliano', 'Quiñonez Silva', '', 'quinonezmaximiliano@gmail.com', 1, '2016-04-08 21:50:59', 180, '2016-04-08 21:59:32'),
(40, 'Lonjinus', 'temujin88', 'Lonjinus', 'Meridio', '', 'colussild88@hotmail.com', 1, '2016-04-12 11:18:19', 185, '2016-04-12 11:22:06'),
(41, 'decanopolizonte', '39615363', 'Decano', 'Gato', '', 'elpolizonte@gmail.com', 1, '2016-04-12 19:09:49', 185, '2016-04-12 20:08:54');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
