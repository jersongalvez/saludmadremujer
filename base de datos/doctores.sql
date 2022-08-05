-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-08-2022 a las 09:09:32
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `saludmad_saludmadreymujer`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctores`
--

CREATE TABLE `doctores` (
  `codigo_doctor` int(11) NOT NULL,
  `url_imagen` varchar(250) DEFAULT NULL,
  `cpe` varchar(20) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `perfil` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `color` varchar(30) NOT NULL,
  `desde` varchar(20) DEFAULT '',
  `hasta` varchar(20) DEFAULT '',
  `lunes` int(11) NOT NULL,
  `martes` int(11) NOT NULL,
  `miercoles` int(11) NOT NULL,
  `jueves` int(11) NOT NULL,
  `viernes` int(11) NOT NULL,
  `sabado` int(11) NOT NULL,
  `domingo` int(11) NOT NULL,
  `Horas_lunes` varchar(50) DEFAULT '',
  `Horas_martes` varchar(50) DEFAULT '',
  `Horas_miercoles` varchar(50) DEFAULT '',
  `Horas_jueves` varchar(50) DEFAULT '',
  `Horas_viernes` varchar(50) DEFAULT '',
  `Horas_sabado` varchar(50) DEFAULT '',
  `Horas_domingo` varchar(50) DEFAULT '',
  `usuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `doctores`
--

INSERT INTO `doctores` (`codigo_doctor`, `url_imagen`, `cpe`, `nombre`, `email`, `direccion`, `telefono`, `perfil`, `estado`, `color`, `desde`, `hasta`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `sabado`, `domingo`, `Horas_lunes`, `Horas_martes`, `Horas_miercoles`, `Horas_jueves`, `Horas_viernes`, `Horas_sabado`, `Horas_domingo`, `usuario`) VALUES
(1, NULL, '39569', 'DIAZ VASQUEZ FELIX', 'felixsmm@saludmadremujer.com', 'Av. Salaverry 1402 – Urb. Bancarios – Chiclayo', '943685523', 'Ginecólogo – Obstetra', 'Inactivo', 'black', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', ''),
(2, NULL, '37241', 'ALVaaA MENESES CARLOS', 'carlossmm@saludmadremujer.com', 'Av. Salaverry 1402 – Urb. Bancarios – Chiclayo', '976484177', 'Ginecólogo – Obstetra', 'Activo', 'yellow', NULL, NULL, 0, 1, 0, 0, 1, 1, 1, '', '15;15:30-19:00;11-12:30', '', '', '15;15:30-19:00;11-12:30', '13;15:30-19:00;11-12:30', '25;12:30-19:00;11-13:30', ''),
(3, NULL, '28630', 'VIDAURRE PASTOR OSCAR MAURICIO', 'oscarsmm@saludmadremujer.com', 'Av. Salaverry 1402 – Urb. Bancarios – Chiclayo', '979710963', 'Ginecólogo – Obstetra', 'Inactivo', 'red', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', ''),
(4, NULL, '47654', 'LLATAS DELGADO SANTIAGO', 'santiagosmm@saludmadremujer.com', 'qqqqqqq Urb. Bancarios – Chiclayo', '999333289', 'Ginecólogo – Obstetra - Infertilidad', 'Activo', 'blue', NULL, NULL, 0, 0, 0, 0, 1, 1, 1, '', '', '', '', '15;15:30-19:00;11-12:30', '15;15:30-19:00;11-12:30', '15;11:30-19:00;11-12:30', ''),
(5, NULL, '67427', 'PAREDES HERNANDEZ JESSICA', 'jessicasmm@saludmadremujer.com', 'Av. Salaverry 1402 – Urb. Bancarios – Chiclayo', '945565896', 'Ginecologia – Obstetra', 'Activo', 'orange', '', '', 0, 0, 1, 1, 0, 1, 0, '', '', '15;15:30-19:00;11-12:30', '15;15:30-19:00;11-12:30', '', '15;15:30-19:00;11-12:30', '', ''),
(6, NULL, '00000', 'CUNEA PEREZ  MARLENI', 'marlenimm@saludmadremujer.com', 'Av. Salaverry 1402 – Urb. Bancarios – Chiclayo', '943937841', 'Ginecóloga – Oncologa - Mastologa', 'Activo', 'violet', '', '', 1, 1, 1, 1, 1, 1, 1, '15;9:30-13:00;14-19:30', '15;15:30-19:00;11-12:30', '15;8-12:25;14-19:30', '15;9:30-13:00;14-19:30', '15;15:30-19:00;11-12:30', '15;15:30-19:00;11-12:30', '15;8:30-13:00;14-19:30', ''),
(13, NULL, '48204', 'CABANILLAS BECERRA JACQUELINE', 'jacquelinesmm@saludmadremujer.com', 'Av. Salaverry 1402 – Urb. Bancarios – Chiclayo', '975186605', 'Dermatologa', 'Activo', 'green', '', '', 1, 1, 1, 1, 1, 1, 1, '15;10-12:00;13-15', '15;9-13;14-18', '15;10-14;15-19', '15;11-15;16-20', '15;15:30-19:00;11-12:30', '15;12-16;17-21', '15;12:30-19:00;11-13:30', ''),
(14, NULL, '22222222', 'qqqqqq', 'miguel23_08@hotmail.com', 'Pasaje Chiclayo', '976873049', 'aaaaaaaa', 'Activo', '', '', '', 0, 1, 0, 0, 0, 1, 1, '', '15;15:30-19:00;11-12:30', '', '', '', '15;15:30-19:00;11-12:30', '15;15:30-19:00;11-12:30', 'CESAR ANTHONY');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD PRIMARY KEY (`codigo_doctor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `doctores`
--
ALTER TABLE `doctores`
  MODIFY `codigo_doctor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
