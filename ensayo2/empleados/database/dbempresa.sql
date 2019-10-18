-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2019 a las 19:55:32
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
-- Base de datos: `dbempresa`
--
CREATE DATABASE IF NOT EXISTS `dbempresa` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dbempresa`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `dui` varchar(9) NOT NULL,
  `nit` varchar(14) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `salario` decimal(10,2) NOT NULL,
  `profesion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`dui`, `nit`, `nombre`, `salario`, `profesion`) VALUES
('223223', '3232324343', 'Katherine', '350.00', 'Administrador'),
('2332', '323232332323', 'Maria', '54.00', 'Contador'),
('3224', '32323232', 'Andrea', '32.00', 'Contador'),
('323', '32545454', 'Marcos', '32.00', 'Idiomas'),
('3232', '33267676', 'Juan', '3232.00', 'Ingeniero'),
('3232111', '32329090', 'Pedro', '32.00', 'El del cafe'),
('4343', '43434343', '433444343', '4343.00', 'Psicologo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`dui`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
