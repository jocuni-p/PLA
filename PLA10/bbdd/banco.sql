-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-05-2023 a las 13:35:09
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `banco`
--
CREATE DATABASE IF NOT EXISTS `banco` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `banco`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

DROP TABLE IF EXISTS `cuentas`;
CREATE TABLE `cuentas` (
  `idcuenta` int(11) NOT NULL,
  `entidad` char(4) NOT NULL,
  `oficina` char(4) NOT NULL,
  `dc` char(2) NOT NULL,
  `cuenta` char(10) NOT NULL,
  `saldo` decimal(12,2) NOT NULL DEFAULT 0.00,
  `fechaalta` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idpersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`idcuenta`, `entidad`, `oficina`, `dc`, `cuenta`, `saldo`, `fechaalta`, `idpersona`) VALUES
(3, '0010', '0100', '01', '1234567890', '200.00', '2022-05-23 22:25:05', 36),
(5, '0001', '0200', '10', '0200123331', '30000.00', '2022-05-23 22:25:05', 80),
(6, '0019', '0200', '90', '4000000010', '1500000.00', '2023-05-02 18:14:27', 201),
(9, '0019', '0200', '99', '4000000011', '0.00', '2022-05-24 11:00:07', 204);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

DROP TABLE IF EXISTS `personas`;
CREATE TABLE `personas` (
  `idpersona` int(11) NOT NULL,
  `nif` char(9) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellidos` varchar(80) NOT NULL,
  `direccion` varchar(120) NOT NULL,
  `telefono` char(9) NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `fechaalta` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`idpersona`, `nif`, `nombre`, `apellidos`, `direccion`, `telefono`, `email`, `fechaalta`) VALUES
(36, '44608800L', 'Frank', 'Pentangelli', 'Malvavisco, 56', '994540033', 'frank@mail.com', '2023-05-03 08:57:48'),
(72, '12345678K', 'Virgil', 'Solozzo', 'Foscarelli avenue, 45', '121121121', 'virgil@mail.com', '2021-10-06 13:59:19'),
(75, '32555678P', 'Vernita', 'Green', 'Foscarelli avenue, 45', '600986432', 'vernita@mail.com', '2023-05-29 11:33:58'),
(80, '45334433T', 'Gogo', 'Yubari', 'Dulcinea, 34', '122112211', 'gogo@mail.com', '2023-05-03 08:48:54'),
(155, '10000333D', 'Beatrix', 'Kiddo', 'Kiddo', '933444444', 'beatrix@mail.com', '2023-05-29 11:33:50'),
(201, '10000050D', 'Sarah', 'Connor', 'Trattoria st, 56', '888998792', 'sarah@mail.com', '2022-05-24 11:51:41'),
(204, '10000070F', 'John', 'Rambo', 'Malvavisco, 67', '934333432', 'johnr@mail.com', '2023-05-29 11:33:41'),
(208, '10222201A', 'Freddo', 'Corleone', 'Trattoria street, 10', '121212121', 'freddo@mail.com', '2023-05-02 18:08:17'),
(218, '42000119U', 'Apolonia', 'Corleone', 'Corleone', '544444544', 'apolonia@mail.com', '2023-05-29 11:34:13'),
(225, '12123112K', 'Paul', 'Atreides', 'C/ Arrakis, 90', '934544444', 'paul@mail.com', '2023-05-29 11:33:01'),
(263, '43560023J', 'O-Ren', 'Ishii', 'Av katana, 45', '934335432', NULL, '2023-05-29 11:33:15'),
(296, '10000001B', 'David', 'Alcolea', 'El Quijote, 67', '660000000', NULL, '2023-05-29 11:32:44'),
(309, '10000000A', 'Arch', 'Stanton', 'Sad Hill, 1004', '923444432', 'arch@mail.com', '2023-05-29 11:34:32');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`idcuenta`),
  ADD UNIQUE KEY `entidad` (`entidad`,`oficina`,`dc`,`cuenta`),
  ADD KEY `idpersona` (`idpersona`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`idpersona`),
  ADD UNIQUE KEY `nif` (`nif`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `idcuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD CONSTRAINT `cuentas_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
