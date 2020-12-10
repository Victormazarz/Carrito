-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2020 a las 09:40:38
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `virtualmarket`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `dniCliente` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `administrador` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`dniCliente`, `nombre`, `direccion`, `email`, `pwd`, `administrador`) VALUES
('1', 'Admin', 'Avda Correos 132', 'admin@midominio.es', '$2y$12$.2Z0M.84JVa96vfJyjIgHO8KAI3Y/JdHOdQTBFci8bLXoEKx//kYe', 'true'),
('10', 'Victor', 'Avda Correos 132', 'victor@midominio.es', '$2y$12$.2Z0M.84JVa96vfJyjIgHO8KAI3Y/JdHOdQTBFci8bLXoEKx//kYe', 'false'),
('15', 'Laura', 'C/ Admin', 'admin@gmail.com', '$2y$12$.2Z0M.84JVa96vfJyjIgHO8KAI3Y/JdHOdQTBFci8bLXoEKx//kYe', 'false'),
('2', 'Usuario', 'Avda Correos 132', 'usuario@midominio.es', '$2y$12$.2Z0M.84JVa96vfJyjIgHO8KAI3Y/JdHOdQTBFci8bLXoEKx//kYe', 'false'),
('2222', 'de', 'de', 'de', '$2y$12$.2Z0M.84JVa96vfJyjIgHO8KAI3Y/JdHOdQTBFci8bLXoEKx//kYe', 'false'),
('22872387', 'JKDFHJ', 'JDKHS', 'DJHSDK', '$2y$12$.2Z0M.84JVa96vfJyjIgHO8KAI3Y/JdHOdQTBFci8bLXoEKx//kYe', 'false'),
('33333333', 'manolo', 'hola', 'hola', '$2y$12$.2Z0M.84JVa96vfJyjIgHO8KAI3Y/JdHOdQTBFci8bLXoEKx//kYe', 'false'),
('44444444', 'marta', 'C/ Valeras 4', 'marta@midominio.es', '$2y$12$.2Z0M.84JVa96vfJyjIgHO8KAI3Y/JdHOdQTBFci8bLXoEKx//kYe', 'false'),
('7777777', 'Miguel', 'C/Santoña15', 'manuel@midominio.es', '$2y$12$.2Z0M.84JVa96vfJyjIgHO8KAI3Y/JdHOdQTBFci8bLXoEKx//kYe', 'false');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineaspedidos`
--

CREATE TABLE `lineaspedidos` (
  `idPedido` int(4) NOT NULL,
  `nlinea` int(2) NOT NULL,
  `idProducto` int(6) DEFAULT NULL,
  `cantidad` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `lineaspedidos`
--

INSERT INTO `lineaspedidos` (`idPedido`, `nlinea`, `idProducto`, `cantidad`) VALUES
(1, 1, 2, 5),
(1, 2, 1, 3),
(1, 3, 3, 3),
(1, 4, 4, 3),
(2, 1, 5, 10),
(2, 2, 7, 10),
(5, 1, 5, 3),
(5, 2, 5, 3),
(5, 3, 2, 4),
(5, 4, 9, 4),
(6, 1, 1, 3),
(6, 2, 7, 2),
(6, 3, 9, 2),
(6, 4, 6, 200),
(10, 1, 6, 2),
(10, 2, 1, 2),
(10, 3, 9, 4),
(10, 4, 4, 10),
(11, 1, 11, 200),
(12, 1, 2, 3),
(12, 2, 9, 2),
(12, 3, 5, 10),
(12, 4, 4, 1),
(13, 1, 8, 3),
(13, 2, 9, 3),
(13, 3, 1, 200),
(13, 4, 3, 4),
(13, 5, 4, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(4) NOT NULL,
  `fecha` date NOT NULL,
  `dirEntrega` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nTarjeta` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCaducidad` date DEFAULT NULL,
  `matriculaRepartidor` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dniCliente` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `fecha`, `dirEntrega`, `nTarjeta`, `fechaCaducidad`, `matriculaRepartidor`, `dniCliente`) VALUES
(1, '1111-01-01', 'C/ Valeras, 22', '111111', '2020-02-02', 'pbf-1144', '10'),
(2, '2021-11-16', 'C/ Princesa, 15', '333333', '2020-02-02', 'bbc-2589', '10'),
(3, '3030-03-30', '', '', '0000-00-00', '', '30'),
(5, '2020-11-09', '', NULL, NULL, NULL, '10'),
(6, '1010-11-16', '', NULL, NULL, NULL, '10'),
(7, '2020-11-16', '', NULL, NULL, NULL, '32'),
(8, '2020-11-16', '', NULL, NULL, NULL, '15'),
(9, '2020-11-16', '', NULL, NULL, NULL, '15'),
(10, '2020-11-17', '', NULL, NULL, NULL, '15'),
(11, '2020-11-17', '', NULL, NULL, NULL, '32'),
(12, '2020-11-18', '', NULL, NULL, NULL, '15'),
(13, '2020-11-19', '', NULL, NULL, NULL, '10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(6) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `origen` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `marca` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categoria` enum('frio','congelado','seco') COLLATE utf8_unicode_ci DEFAULT NULL,
  `peso` int(3) NOT NULL,
  `unidades` int(5) NOT NULL,
  `volumen` int(4) DEFAULT NULL,
  `precio` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre`, `origen`, `foto`, `marca`, `categoria`, `peso`, `unidades`, `volumen`, `precio`) VALUES
(1, 'Macarrones', 'italia', 'macarrones.jpg', 'gallo', 'seco', 250, 100, 10, 1),
(2, 'Tallarines', 'italia', 'tallarines.jpg', 'gallo', 'seco', 250, 100, 10, 1),
(3, 'Atun', 'espa&ntilde;a', 'atun.jpg', 'calvo', 'seco', 250, 100, 10, 1),
(4, 'Sardinillas', 'espa&ntilde;a', 'sardinas.jpg', 'dia', 'seco', 250, 100, 10, 1),
(5, 'Mejillones', 'espa&ntilde;a', 'mejillones.jpg', 'calvo', 'seco', 125, 100, 10, 1),
(6, 'Fideos', 'italia', 'fideos.jpg', 'gallo', 'seco', 250, 100, 10, 1),
(7, 'Galletas Cuadradas', 'francia', 'galletas.jpg', 'gullon', 'seco', 800, 100, 10, 1),
(8, 'Barquillos', 'espa&ntilde;a', 'barquillos.jpg', 'cuetara', 'seco', 150, 100, 10, 1),
(9, 'Leche entera', 'espa&ntilde;a', 'leche.jpg', 'pascual', 'frio', 1000, 100, 10, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`dniCliente`);

--
-- Indices de la tabla `lineaspedidos`
--
ALTER TABLE `lineaspedidos`
  ADD PRIMARY KEY (`idPedido`,`nlinea`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
