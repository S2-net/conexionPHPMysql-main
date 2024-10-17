-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2024 a las 22:25:47
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `repay`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `espacios_comunes`
--

CREATE TABLE `espacios_comunes` (
  `id_espaco` int(11) NOT NULL,
  `id_residencia` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id_habitacion` int(11) NOT NULL,
  `id_residencia` int(11) DEFAULT NULL,
  `disponibilidad` int(11) DEFAULT NULL,
  `banios` varchar(50) DEFAULT NULL,
  `detalles` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id_habitacion`, `id_residencia`, `disponibilidad`, `banios`, `detalles`) VALUES
(30, 30, 4, '2', 'asdasdad'),
(31, 31, 12, '2', 'asdasd'),
(32, 32, 2, '2', 'asdasd'),
(33, 33, 2, '2', 'asdasd'),
(34, 34, 3, '2', 'pamba'),
(35, 35, 2, '2', 'aaaaa'),
(36, 36, 2, '2', 'sasd'),
(37, 37, 2, '2', 'sasd'),
(38, 38, 2, '2', 'sasd'),
(39, 39, 2, '2', ''),
(40, 40, 2, '2', 'asdasdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hace`
--

CREATE TABLE `hace` (
  `id_resenia` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietario`
--

CREATE TABLE `propietario` (
  `id_propietario` int(11) NOT NULL,
  `id_residencia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resenia`
--

CREATE TABLE `resenia` (
  `id_resenia` int(11) NOT NULL,
  `puntuacion` int(11) DEFAULT NULL,
  `comentario` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reside`
--

CREATE TABLE `reside` (
  `id_residencia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `residencia`
--

CREATE TABLE `residencia` (
  `id_residencia` int(11) NOT NULL,
  `calle` varchar(80) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `normas` varchar(500) DEFAULT NULL,
  `nombreresi` varchar(50) DEFAULT NULL,
  `descripcion` varchar(255) NOT NULL,
  `id_habitacion` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `residencia`
--

INSERT INTO `residencia` (`id_residencia`, `calle`, `numero`, `precio`, `normas`, `nombreresi`, `descripcion`, `id_habitacion`, `id_usuario`) VALUES
(30, NULL, NULL, 12000, 'No pelearse', 'La tacoma', 'muy buena', 30, 3),
(32, NULL, NULL, 12333, 'adsasd', 'asdasd', 'asdasd', 0, 1),
(33, NULL, NULL, 12333, 'adsasd', 'asdasd', 'asdasd', 0, 5),
(39, NULL, NULL, 1222, 'asdasda', 'asdasd', 'asdad', NULL, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `descripcion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `descripcion`) VALUES
(0, 'Admin'),
(1, 'Estudiante'),
(2, 'Propietario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiene`
--

CREATE TABLE `tiene` (
  `id_resenia` int(11) DEFAULT NULL,
  `id_residencia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `contrasenia` varchar(255) DEFAULT NULL,
  `num_telefono` int(11) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `genero` enum('Hombre','Mujer','Otro') DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `id_rol` int(11) NOT NULL DEFAULT 1,
  `id_residencia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `contrasenia`, `num_telefono`, `correo`, `genero`, `fecha_nacimiento`, `id_rol`, `id_residencia`) VALUES
(1, 'Ismael', 'Vazquez', 'ismarepay123prueba@', 923347772, 'prueba1@gmail.com', 'Hombre', '2000-03-07', 1, 32),
(3, 'Augusto', 'de los Santos', '$2y$10$H12sOolmG0qOeuFsv038CO7Q9b4OzNAlznSLNC3IP/QPSgTw9Z63e', NULL, 'augustodlsr@gmail.com', 'Hombre', '2007-01-30', 2, 30),
(5, 'pepito', 'papa', '$2y$10$6SSsh.1tr20fgkIuf9/T/OO/JD8Ij07p.WTLxkWuZf0mTUOe1NLvW', NULL, '123@gmail.com', 'Hombre', '2024-10-04', 1, 33),
(8, 'pepito', 'de los santos', '$2y$10$ekBwUTEN7HXD/KIBhYDqh.lFpAopLI4X96k9fDK0j5Wn3f9xwg0Wq', NULL, '2@gmail.com', 'Hombre', '2024-10-23', 2, 39),
(9, 'a', 'a', '$2y$10$YuhIq2gVh9kdzZx77QBZLeQd4.1ObHbu0fOV14KCqZI6BVYNrfPY2', NULL, '3@gmail.com', 'Hombre', '2024-10-16', 2, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD KEY `id_admin` (`id_admin`);

--
-- Indices de la tabla `espacios_comunes`
--
ALTER TABLE `espacios_comunes`
  ADD PRIMARY KEY (`id_espaco`),
  ADD KEY `id_residencia` (`id_residencia`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id_habitacion`),
  ADD KEY `id_residencia` (`id_residencia`);

--
-- Indices de la tabla `hace`
--
ALTER TABLE `hace`
  ADD KEY `id_resenia` (`id_resenia`);

--
-- Indices de la tabla `propietario`
--
ALTER TABLE `propietario`
  ADD PRIMARY KEY (`id_propietario`),
  ADD UNIQUE KEY `id_residencia` (`id_residencia`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `resenia`
--
ALTER TABLE `resenia`
  ADD PRIMARY KEY (`id_resenia`);

--
-- Indices de la tabla `reside`
--
ALTER TABLE `reside`
  ADD KEY `id_residencia` (`id_residencia`);

--
-- Indices de la tabla `residencia`
--
ALTER TABLE `residencia`
  ADD PRIMARY KEY (`id_residencia`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_rol_2` (`id_rol`);

--
-- Indices de la tabla `tiene`
--
ALTER TABLE `tiene`
  ADD KEY `id_resenia` (`id_resenia`),
  ADD KEY `id_residencia` (`id_residencia`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`) USING BTREE,
  ADD KEY `id_residencia` (`id_residencia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `espacios_comunes`
--
ALTER TABLE `espacios_comunes`
  MODIFY `id_espaco` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id_habitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `resenia`
--
ALTER TABLE `resenia`
  MODIFY `id_resenia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `residencia`
--
ALTER TABLE `residencia`
  MODIFY `id_residencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `espacios_comunes`
--
ALTER TABLE `espacios_comunes`
  ADD CONSTRAINT `espacios_comunes_ibfk_1` FOREIGN KEY (`id_residencia`) REFERENCES `residencia` (`id_residencia`);

--
-- Filtros para la tabla `hace`
--
ALTER TABLE `hace`
  ADD CONSTRAINT `hace_ibfk_2` FOREIGN KEY (`id_resenia`) REFERENCES `resenia` (`id_resenia`);

--
-- Filtros para la tabla `propietario`
--
ALTER TABLE `propietario`
  ADD CONSTRAINT `propietario_ibfk_1` FOREIGN KEY (`id_propietario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `propietario_ibfk_2` FOREIGN KEY (`id_residencia`) REFERENCES `residencia` (`id_residencia`),
  ADD CONSTRAINT `propietario_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `reside`
--
ALTER TABLE `reside`
  ADD CONSTRAINT `reside_ibfk_2` FOREIGN KEY (`id_residencia`) REFERENCES `residencia` (`id_residencia`);

--
-- Filtros para la tabla `residencia`
--
ALTER TABLE `residencia`
  ADD CONSTRAINT `residencia_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tiene`
--
ALTER TABLE `tiene`
  ADD CONSTRAINT `tiene_ibfk_1` FOREIGN KEY (`id_resenia`) REFERENCES `resenia` (`id_resenia`),
  ADD CONSTRAINT `tiene_ibfk_2` FOREIGN KEY (`id_residencia`) REFERENCES `residencia` (`id_residencia`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_residencia`) REFERENCES `residencia` (`id_residencia`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
