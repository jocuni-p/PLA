-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 27-10-2025 a las 17:53:40
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `autos_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autos`
--

CREATE TABLE `autos` (
  `id` int(10) UNSIGNED NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `precio` int(10) UNSIGNED NOT NULL,
  `anio` year(4) NOT NULL,
  `kilometros` int(10) UNSIGNED DEFAULT NULL,
  `combustible` enum('gasolina','diesel','hibrido','electrico','hibrido enchufable','gas') NOT NULL,
  `img` varchar(60) NOT NULL,
  `fecha_alta` datetime NOT NULL DEFAULT current_timestamp(),
  `idcategoria` int(20) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `autos`
--

INSERT INTO `autos` (`id`, `marca`, `modelo`, `precio`, `anio`, `kilometros`, `combustible`, `img`, `fecha_alta`, `idcategoria`) VALUES
(23, 'Bmw', 'Serie3', 100200, '2000', 2400, 'electrico', '1761582698_img_8.jpg', '2025-10-18 23:22:56', 7),
(24, 'Audi', 'Q3', 10000, '2022', 39000, 'diesel', '1760825953_img_3.jpg', '2025-10-19 00:19:13', 2),
(25, 'Tesla', 'Electro', 110000, '2025', 20, 'electrico', '1760826648_img_4.jpg', '2025-10-19 00:30:48', 4),
(26, 'Range Rover', 'Ranger', 30000, '2020', 6300, 'gasolina', '1760827527_img_4.jpg', '2025-10-19 00:45:27', 7),
(27, 'Seat', 'Panda', 3000, '2015', 65000, 'gasolina', '1760827934_img_6.jpg', '2025-10-19 00:52:14', 4),
(28, 'Jepp', 'Country', 23456, '2010', 23000, 'hibrido enchufable', '1760905331_img_7.jpg', '2025-10-19 22:22:11', 5),
(29, 'Ford', 'Fiesta', 32000, '2025', 1200, 'gasolina', '1760905411_img_8.jpg', '2025-10-19 22:23:31', 3),
(30, 'Tesla', 'T3', 76000, '2024', 1000, 'electrico', '1760905483_img_9.jpg', '2025-10-19 22:24:43', 3),
(31, 'Seat', 'Cupra', 32000, '2025', 500, 'hibrido', '1760905686_img_5.jpg', '2025-10-19 22:26:29', 4),
(32, 'Seat', 'Cupra', 32000, '2025', 500, 'hibrido', '1760905603_img_10.jpg', '2025-10-19 22:26:43', 4),
(33, 'Dacia', 'Campero', 43000, '2023', 2450, 'gasolina', '1760905661_img_11.jpg', '2025-10-19 22:27:41', 7),
(35, 'Bmw', 'Serie7', 45000, '2004', 33333, 'diesel', '1761399027_img_7.jpg', '2025-10-20 21:44:00', 1),
(37, 'Seat', 'Toledo', 15300, '2015', 120000, 'gasolina', '1761406299_img_3.jpg', '2025-10-25 17:31:39', 6),
(38, 'Peugeot', 'X2', 12000, '2024', 333, 'gasolina', '1761582772_img_7.jpg', '2025-10-27 17:32:52', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Sin categoria'),
(2, 'coche pequeño'),
(3, 'sedan'),
(4, 'coupe'),
(5, 'suv'),
(6, 'familiar'),
(7, 'monovolumen'),
(8, 'cabrio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `fecha_alta` datetime NOT NULL DEFAULT current_timestamp(),
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `telefono`, `email`, `password`, `remember_token`, `fecha_alta`, `is_admin`) VALUES
(1, 'Joan', '659506271', 'joan@gmail.com', '$2y$12$KF/EcS38rtZPozib3.NwlOBMDSU1fBPUkjNGqxZ47cEjDcRn01YWK', 'JA7zy6ywxP2sMfzritS2PeFNLlXYpN7WOmgNda0mkLQa5G79Ie0lhCcBem6c', '2025-10-15 22:07:47', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autos`
--
ALTER TABLE `autos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcategoria` (`idcategoria`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `telefono` (`telefono`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autos`
--
ALTER TABLE `autos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `autos`
--
ALTER TABLE `autos`
  ADD CONSTRAINT `autos_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
