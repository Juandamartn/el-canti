-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-09-2019 a las 02:02:19
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `el_canti`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cashout`
--

CREATE TABLE `cashout` (
  `id_cashout` int(11) NOT NULL,
  `fk_id_date` int(11) NOT NULL,
  `fk_id_sales` int(11) NOT NULL,
  `fk_id_exp` int(11) NOT NULL,
  `total_cashout` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `date`
--

CREATE TABLE `date` (
  `id_date` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expenses`
--

CREATE TABLE `expenses` (
  `id_exp` int(11) NOT NULL,
  `fk_id_date` int(11) NOT NULL,
  `name_exp` varchar(50) COLLATE utf8_bin NOT NULL,
  `amount_exp` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `food`
--

CREATE TABLE `food` (
  `id_food` int(11) NOT NULL,
  `name_food` varchar(50) COLLATE utf8_bin NOT NULL,
  `price` int(11) NOT NULL,
  `fk_id_ing` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredients`
--

CREATE TABLE `ingredients` (
  `id_ing` int(11) NOT NULL,
  `name_ing` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id_sales` int(11) NOT NULL,
  `fk_id_date` int(11) NOT NULL,
  `fk_id_food` int(11) NOT NULL,
  `total_sales` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(50) COLLATE utf8_bin NOT NULL,
  `su` enum('0','1') COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `su`) VALUES
(1, 'juan', '15410596', '0'),
(2, 'empleado', '123', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cashout`
--
ALTER TABLE `cashout`
  ADD PRIMARY KEY (`id_cashout`),
  ADD KEY `fk_id_date` (`fk_id_date`),
  ADD KEY `fk_id_exp` (`fk_id_exp`),
  ADD KEY `fk_id_sales` (`fk_id_sales`);

--
-- Indices de la tabla `date`
--
ALTER TABLE `date`
  ADD PRIMARY KEY (`id_date`);

--
-- Indices de la tabla `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id_exp`),
  ADD KEY `expenses_ibfk_1` (`fk_id_date`);

--
-- Indices de la tabla `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id_food`),
  ADD KEY `fk_id_ing` (`fk_id_ing`);

--
-- Indices de la tabla `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id_ing`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id_sales`),
  ADD KEY `FK DATE` (`fk_id_date`),
  ADD KEY `FK FOOD` (`fk_id_food`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cashout`
--
ALTER TABLE `cashout`
  MODIFY `id_cashout` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `date`
--
ALTER TABLE `date`
  MODIFY `id_date` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id_exp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `food`
--
ALTER TABLE `food`
  MODIFY `id_food` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id_ing` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id_sales` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cashout`
--
ALTER TABLE `cashout`
  ADD CONSTRAINT `cashout_ibfk_1` FOREIGN KEY (`fk_id_date`) REFERENCES `date` (`id_date`) ON DELETE CASCADE,
  ADD CONSTRAINT `cashout_ibfk_2` FOREIGN KEY (`fk_id_exp`) REFERENCES `expenses` (`id_exp`) ON DELETE CASCADE,
  ADD CONSTRAINT `cashout_ibfk_3` FOREIGN KEY (`fk_id_sales`) REFERENCES `sales` (`id_sales`) ON DELETE CASCADE;

--
-- Filtros para la tabla `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`fk_id_date`) REFERENCES `date` (`id_date`) ON DELETE CASCADE;

--
-- Filtros para la tabla `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`fk_id_ing`) REFERENCES `ingredients` (`id_ing`);

--
-- Filtros para la tabla `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `FK DATE` FOREIGN KEY (`fk_id_date`) REFERENCES `date` (`id_date`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK FOOD` FOREIGN KEY (`fk_id_food`) REFERENCES `food` (`id_food`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
