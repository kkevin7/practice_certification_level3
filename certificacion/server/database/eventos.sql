-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2019 a las 18:30:18
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
-- Base de datos: `eventos`
--
CREATE DATABASE IF NOT EXISTS `eventos` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `eventos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `categoria` enum('Publico','Privado','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `titulo`, `fecha_hora`, `descripcion`, `categoria`) VALUES
(1, 'Organizacion de docentes', '2019-10-28 00:00:00', 'Es una descripcion', 'Privado'),
(2, 'Organizacion de estudiantes', '2019-10-29 00:00:00', 'ES UNA DESCRIPCION', 'Privado'),
(3, 'Organizacion de docentes', '2019-10-09 04:00:00', 'Es una descripcion', 'Publico'),
(17, 'Congreso de estudiantes', '2020-04-22 03:32:00', 'es una descripcion', 'Publico'),
(19, 'Reunion de asesores', '2019-10-29 03:43:00', 'es una descripcion de prueba', 'Privado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
