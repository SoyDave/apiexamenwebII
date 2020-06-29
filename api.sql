-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 29-06-2020 a las 19:55:05
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `api`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propertys`
--

CREATE TABLE `propertys` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `type` varchar(20) NOT NULL,
  `address` varchar(128) NOT NULL,
  `rooms` int(10) NOT NULL,
  `price` int(128) NOT NULL,
  `area` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `propertys`
--

INSERT INTO `propertys` (`id`, `title`, `type`, `address`, `rooms`, `price`, `area`) VALUES
(38, 'Casa Universitaria', 'room', 'dir # 34-40', 1, 265000, 42),
(40, 'Hotel del Bosque', 'hotel', 'Calle 50', 29, 250000, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `type_id` varchar(10) NOT NULL,
  `identification` int(20) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `type_id`, `identification`, `password`) VALUES
(91, 'Juan', 'Ortiz', 'fredy@gmail.com', 'cc', 1216715746, '1234567890$%'),
(92, 'Santiago', 'Giraldo', 'santiago@gmail.com', 'cc', 1036673604, '1234567890$%'),
(93, 'Fredy', 'Sepulveda', 'fredy@gmail.com', 'cc', 1152214695, '1234567890$%');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `propertys`
--
ALTER TABLE `propertys`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `propertys`
--
ALTER TABLE `propertys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
