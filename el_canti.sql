-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2019 a las 04:31:53
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
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_id_sales` int(11) NOT NULL,
  `fk_id_exp` int(11) NOT NULL,
  `total_cashout` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expenses`
--

CREATE TABLE `expenses` (
  `id_exp` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `food`
--

INSERT INTO `food` (`id_food`, `name_food`, `price`) VALUES
(1, 'KEKA', 27),
(2, 'TORTA', 45),
(3, 'BURRO MONTADO', 48),
(4, 'TACOS (4)', 40),
(5, 'TACOS (6)', 50),
(6, 'PLATILLO', 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredients`
--

CREATE TABLE `ingredients` (
  `id_ing` int(11) NOT NULL,
  `name_ing` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `ingredients`
--

INSERT INTO `ingredients` (`id_ing`, `name_ing`) VALUES
(1, 'JAMON CON QUESO'),
(2, 'DESHEBRADA'),
(3, 'LOMO'),
(4, 'CHILE RELLENO'),
(5, 'COLITA DE PAVO'),
(6, 'BISTEC'),
(7, 'ALPASTOR'),
(8, 'PIERNA AHUMADA'),
(9, 'ALAMBRE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id_sales` int(11) NOT NULL,
  `chek` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sell`
--

CREATE TABLE `sell` (
  `id_sell` int(11) NOT NULL,
  `chek` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_id_food` int(11) NOT NULL,
  `fk_id_ing` int(11) NOT NULL,
  `combined` enum('0','1') COLLATE utf8_bin NOT NULL DEFAULT '0',
  `deliver` enum('0','1') COLLATE utf8_bin NOT NULL DEFAULT '0',
  `charged` enum('0','1') COLLATE utf8_bin NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `sell`
--

INSERT INTO `sell` (`id_sell`, `chek`, `date`, `fk_id_food`, `fk_id_ing`, `combined`, `deliver`, `charged`) VALUES
(9, 1, '2019-10-30 20:28:30', 5, 6, '0', '0', '1');

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
  ADD KEY `fk_id_exp` (`fk_id_exp`),
  ADD KEY `fk_id_sales` (`fk_id_sales`);

--
-- Indices de la tabla `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id_exp`);

--
-- Indices de la tabla `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id_food`);

--
-- Indices de la tabla `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id_ing`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id_sales`);

--
-- Indices de la tabla `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`id_sell`),
  ADD KEY `fk_id_food` (`fk_id_food`),
  ADD KEY `fk_id_ing` (`fk_id_ing`);

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
-- AUTO_INCREMENT de la tabla `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id_exp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `food`
--
ALTER TABLE `food`
  MODIFY `id_food` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id_ing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id_sales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `sell`
--
ALTER TABLE `sell`
  MODIFY `id_sell` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  ADD CONSTRAINT `cashout_ibfk_2` FOREIGN KEY (`fk_id_exp`) REFERENCES `expenses` (`id_exp`) ON DELETE CASCADE,
  ADD CONSTRAINT `cashout_ibfk_3` FOREIGN KEY (`fk_id_sales`) REFERENCES `sales` (`id_sales`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sell`
--
ALTER TABLE `sell`
  ADD CONSTRAINT `sell_ibfk_2` FOREIGN KEY (`fk_id_food`) REFERENCES `food` (`id_food`) ON DELETE CASCADE,
  ADD CONSTRAINT `sell_ibfk_3` FOREIGN KEY (`fk_id_ing`) REFERENCES `ingredients` (`id_ing`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
