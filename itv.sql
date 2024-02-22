-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-02-2024 a las 14:23:53
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
-- Base de datos: `itv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `matricula` varchar(7) NOT NULL,
  `id_itv` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `ficha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`matricula`, `id_itv`, `fecha`, `hora`, `ficha`) VALUES
('1111ABC', 1, '0000-00-00', '16:52:00', '1702640865-1111ABCficha.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itvs`
--

CREATE TABLE `itvs` (
  `id` int(50) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `localidad` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `itvs`
--

INSERT INTO `itvs` (`id`, `provincia`, `localidad`, `direccion`, `telefono`) VALUES
(1, 'Córdoba', 'Lucena', 'Ctra. N. 331. P.K. 69,5 junto al Polígono Industri', 111111111),
(2, 'Córdoba', 'Baena', 'Área de tptes. los llanos s/n', 222222222),
(3, 'Sevilla', 'Ecija', 'Autovía A4 Km. 445, A.C. 259', 333333333),
(4, 'Sevilla', 'Osuna', 'Avd. la Constitución s.n. Área de Servicio Autov. ', 444444444),
(5, 'Granada', 'Motril', 'Ctra. Almería, Km. 1,3', 555555555),
(6, 'Granada', 'Guadix', 'Centro de Transporte de Mercancias junto a la A-92', 666666666);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `provincia` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `telefono` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`provincia`, `nombre`, `telefono`, `user`, `pass`) VALUES
('Almería', 'ITVs Almería', 161616161, 'adminalmeria', '$2y$10$J9nylLtXVdB/btN4osOL6Okf6Vmq7G1aixC7f6ZXSJ7QJAfIq/M/.'),
('Cádiz', 'ITVs Cádiz', 181818181, 'admincadiz', '$2y$10$bsUtPjKOheYKKFKf5oWIL.YW81pe9p9OX3VfaCvJoCyH4YVWh9YSO'),
('Córdoba', 'ITVs Córdoba', 121212121, 'admincordoba', '$2y$10$xtJdtiBhgd9ECaq4MV96Z.CZfj8VpwAWTNHD3XMa6FNrr7UKp2Vju'),
('Granada', 'ITVs Granada', 1414141141, 'admingranada', '$2y$10$D0eA08qJM1WEiK/zHCf7lOb4YwlMgp..prn06FYomaUZ76FbBc4pG'),
('Huelva', 'ITVs Huelva', 171717171, 'adminhuelva', '$2y$10$LDapnnQwIwG.wr6s/PKntODyVuyhO/fyqjJmZr0rKZxxnlfZIduXO'),
('Jaén', 'ITVs Jaén', 191919191, 'adminjaen', '$2y$10$0KzWpZDouxkG2/gpTntvdeBtEu5mcXFsU688LB1ch7LjftHH1BWTa'),
('Málaga', 'ITVs Málaga', 151515151, 'adminmalaga', '$2y$10$GSIGIy/6c.Z5HmeC4fopo.cQ64sATQivwwPr8nDvc.PSrGAemEV/G'),
('Sevilla', 'ITVs Sevilla', 131313131, 'adminsevilla', '$2y$10$Bmm06Qo/PVXk0Y6LSTWIBO8/oXkAK8KRCrO085guqqAVFX.j5I.6u');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `matricula` varchar(7) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `color` varchar(20) NOT NULL,
  `plazas` int(11) NOT NULL,
  `fecha_ultima_revision` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`matricula`, `marca`, `modelo`, `color`, `plazas`, `fecha_ultima_revision`) VALUES
('1111ABC', 'Seat', 'Ibiza', 'Blanco', 5, '2023-12-26'),
('3333ABC', 'Toyota', 'Yaris', 'Negro', 5, '2022-03-05'),
('4444ABC', 'Ford', 'Kuga', 'Rojo', 7, '2022-06-08'),
('5555ABC', 'Nissan', 'Qashqai', 'Azul', 7, '2023-01-02');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`matricula`,`id_itv`,`fecha`,`hora`),
  ADD KEY `id_itv` (`id_itv`);

--
-- Indices de la tabla `itvs`
--
ALTER TABLE `itvs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provincia_fk` (`provincia`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`provincia`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`matricula`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`matricula`) REFERENCES `vehiculo` (`matricula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`id_itv`) REFERENCES `itvs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `itvs`
--
ALTER TABLE `itvs`
  ADD CONSTRAINT `provincia_fk` FOREIGN KEY (`provincia`) REFERENCES `usuario` (`provincia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
