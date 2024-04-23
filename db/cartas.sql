-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-03-2024 a las 00:07:53
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cartas_virtuales`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartas`
--

CREATE TABLE `cartas` (
  `id` int(11) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `ingredientes` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `foto` text NOT NULL,
  `empresa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cartas`
--

INSERT INTO `cartas` (`id`, `producto`, `ingredientes`, `precio`, `foto`, `empresa`) VALUES
(1, 'Big Mac', 'lechuga, tomate, pepinillos, chedar', '1500.00', 'hamburguesa.png', 'BLACKFOX'),
(2, 'Angus Tasty', 'chedar, cebulla, bacon', '2500.00', 'hamburguesa2.png', 'BLACKFOX'),
(3, 'Triple de Bacon', 'lechuga, tomate, pepinillos, cebolla, chedar, bacon', '3500.00', 'hamburguesa3.png', 'BLACKFOX'),
(4, 'Cuarto de Libra', 'cebulla, chedar', '1000.00', 'hamburguesa4.png', 'BLACKFOX'),
(5, 'Muzzarela', 'salsa de tomate, mozzarella y aceitunas verdes', '1500.00', 'pizza.png', ''),
(6, 'Hongos', 'salsa de tomate, mozzarella, champiñones y aceitunas negras', '1500.00', 'pizza2.png', ''),
(7, 'Tomate', 'salsa de tomate, mozzarella y rodajas de tomate', '1500.00', 'pizza3.png', ''),
(8, 'Margarita', 'salsa de tomate, mozzarella y hojas de albahaca', '1500.00', 'pizza4.png', ''),
(9, 'Lasagna', 'pasta y salsa bolognesa', '1500.00', 'pasta.png', ''),
(10, 'Macarrones con salsa rosa', 'macarrones, pollo y salsa rosa', '1500.00', 'pasta2.png', ''),
(11, 'Pasta con salsa filetto', 'espagueti, salsa filetto, verduras y portobello', '1500.00', 'pasta3.png', ''),
(12, 'Pasta con salsa blanca', 'espagueti, salsa blanca, bacon y verduras', '1500.00', 'pasta4.png', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cartas`
--
ALTER TABLE `cartas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cartas`
--
ALTER TABLE `cartas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
