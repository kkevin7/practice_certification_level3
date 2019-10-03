-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-10-2019 a las 19:03:42
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vendanos`
--
CREATE DATABASE IF NOT EXISTS `vendanos` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `vendanos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `cantidad`, `precio_unitario`, `estado`) VALUES
(1, 'Sardina enlatada', 50, '1.50', 1),
(2, 'pan blanco binbo', 25, '1.75', 1),
(3, 'Jamon enlatado', 25, '3.25', 1),
(4, 'Juan', 223, '1.43', 1),
(5, 'Shapoo palmolive', 35, '2.25', 1),
(6, 'pan blanco binbo', 2, '1.43', 1),
(7, 'dsdsds2', 223, '4.43', 1),
(9, '', 2, '1.43', 1),
(10, '', 2, '1.43', 1),
(11, 'dsdsds', 2, '1.43', 1),
(12, 'dsdsds', 223, '1.43', 1),
(13, 'dsdsds', 223, '1.43', 1),
(14, 'dsdsds', 223, '1.43', 1),
(15, 'dsdsds', 223, '1.43', 1),
(16, 'Juan', 223, '1.43', 1),
(18, 'Sardina enlatada', 50, '1.50', 1),
(20, 'Sardina enlatada', 50, '1.50', 1),
(21, 'Sardina enlatada', 50, '1.50', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
