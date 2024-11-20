-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2024 a las 18:45:41
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

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
-- Estructura de tabla para la tabla `cambiar_contra`
--

CREATE TABLE `cambiar_contra` (
  `id` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiracion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cambiar_contra`
--

INSERT INTO `cambiar_contra` (`id`, `correo`, `token`, `expiracion`) VALUES
(1, 'alejo011106@gmail.com', '5d6e774d6b9ea1a6868443bc84e3ebcb', '2024-10-23 03:25:04'),
(2, 'alejo011106@gmail.com', '71fcf688228319216850b6246c7e9639', '2024-10-23 03:29:58'),
(3, 'alejo011106@gmail.com', '7f5be14d78ec1c7f7b246aee0a6b3f82', '2024-10-23 03:30:59'),
(4, 'alejo011106@gmail.com', '2de043d3635941f566eabc5676befde3', '2024-10-23 03:36:12'),
(5, 'alejo011106@gmail.com', 'ec0d48b192d625b9a02f736d6afaa49e', '2024-10-23 03:38:31'),
(6, 'augustodlsr@gmail.com', 'f14baf6f05b778edcf326e345fb214a4', '2024-10-23 23:05:06'),
(7, 'augustodlsr@gmail.com', '94efa64061e150ad6832d7a3af3a1c1f', '2024-10-25 23:08:39'),
(8, 'augustodlsr@gmail.com', '3495fcd725c0b71368c721166990c238', '2024-10-25 23:08:55'),
(9, 'alejo011106@gmail.com', '1af385bf7df6773eab70e8c09b7d5b7e', '2024-10-25 23:12:55'),
(10, 'alejo011106@gmail.com', '9fee67f6cd961c5d873b638d0644e0cd', '2024-10-28 23:41:22'),
(11, 'alejo011106@gmail.com', '2096b96a71a063628ba15be1ca66420b', '2024-10-28 23:42:38'),
(12, 'alejo011106@gmail.com', 'd45bcf75070ca891fa71ba38141240cf', '2024-10-28 23:44:03'),
(13, 'alejo011106@gmail.com', 'dd8d2102abf44d1c62a8fb41df82e58b', '2024-10-28 23:44:06'),
(14, 'alejo011106@gmail.com', 'ea87c1f5f2a15ca11c61cb35db02516d', '2024-10-28 23:44:23'),
(15, 'alejo011106@gmail.com', 'c4c11fcc1e477d0e4c89df539d9f260a', '2024-10-28 23:46:02'),
(16, 'alejo011106@gmail.com', '2332531d2a12971e89f191a6535563b3', '2024-10-28 23:46:05'),
(17, 'alejo011106@gmail.com', '61d56c8519b40452867e07858144801e', '2024-10-28 23:46:15'),
(18, 'alejo011106@gmail.com', 'f7c7aec10aeb5c280f25e1aee957787c', '2024-10-28 23:46:17'),
(19, 'alejo011106@gmail.com', '61d846800ca72b8d46712d2aed4c1ed4', '2024-10-28 23:46:20'),
(20, 'alejo011106@gmail.com', '50c004ab2de63fbc2bf24ad60104fca3', '2024-10-28 23:46:40'),
(21, 'alejo011106@gmail.com', 'cce44b00c70f99f75ee459ad0100305d', '2024-10-28 23:48:16'),
(22, 'alejo011106@gmail.com', 'a2207964c1a0a24483f2a3f110326e0b', '2024-10-28 23:49:54'),
(23, 'alejo011106@gmail.com', '8525b8462b158dea659062b082e6df82', '2024-10-28 23:49:57'),
(24, 'alejo011106@gmail.com', 'ba8e45a7011581d1094e40736c879308', '2024-10-28 23:50:00'),
(25, 'alejo011106@gmail.com', '7a90219997cb109031675e8de4757c66', '2024-10-28 23:50:05'),
(26, 'alejo011106@gmail.com', 'c575ca6fa348460d3a6835e8ee297a58', '2024-10-28 23:50:06'),
(27, 'alejo011106@gmail.com', '0d147c53bb1a23659d64d5455a7df387', '2024-10-28 23:50:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_residencia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_residencia` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id`, `id_usuario`, `id_residencia`, `nombre`, `email`, `mensaje`, `fecha`) VALUES
(6, 3, 74, 'Augusto', 'augustodlsr@gmail.com', 'asdasdasd', '2024-11-09 19:01:54'),
(8, 3, 75, 'pepe', 'pepe@gmail.com', 'asdasda', '2024-11-09 19:11:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_residencia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_residencia`
--

CREATE TABLE `fotos_residencia` (
  `id_foto` int(11) NOT NULL,
  `id_residencia` int(11) DEFAULT NULL,
  `ruta_foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fotos_residencia`
--

INSERT INTO `fotos_residencia` (`id_foto`, `id_residencia`, `ruta_foto`) VALUES
(68, 75, 'fotos/IMG_8676.jpg'),
(69, 81, 'fotos/WhatsApp Image 2024-11-20 at 2.43.07 PM.jpeg'),
(70, 81, 'fotos/WhatsApp Image 2024-11-20 at 2.43.06 PM.jpeg');

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
(77, 75, 6, '1', 'Un baño completo'),
(83, 81, 4, '2', 'Un baño maculino y otro femenino');

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
  `id_usuario` int(11) DEFAULT NULL,
  `tipo` enum('Masculina','Femenina','Mixta') DEFAULT NULL,
  `latitud` varchar(50) NOT NULL,
  `longitud` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `residencia`
--

INSERT INTO `residencia` (`id_residencia`, `calle`, `numero`, `precio`, `normas`, `nombreresi`, `descripcion`, `id_habitacion`, `id_usuario`, `tipo`, `latitud`, `longitud`) VALUES
(75, NULL, NULL, 12000, 'No deben llegar despues de las 12 de la noche ni hacer ruidos molestos en horarios inadecuados', 'La tacoma', 'Esta residencia se caracteriza por la limpieza de sus espacios comunes y la buena relacio y comunicacion entre los estuiantes', NULL, 23, 'Masculina', '-32.31380076270218', '-58.07871690273975'),
(81, NULL, NULL, 8000, 'No utilizar los utensillos de comida de los demas', 'Big House', 'Residencia acogedora que acompaña a sus residentes en sus estudios', NULL, 20, 'Mixta', '-32.318582172130874', '-58.082547096958436');

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
  `id_residencia` int(11) DEFAULT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `contrasenia`, `num_telefono`, `correo`, `genero`, `fecha_nacimiento`, `id_rol`, `id_residencia`, `foto`) VALUES
(20, 'a', 'a', '$2y$10$sS.oemhQQC2PVToYDNt2N.vwdodWMaBbsTmfgknbQSS3/lK5wFjxq', NULL, '1@gmail.com', 'Hombre', '2000-11-11', 2, 81, ''),
(21, 'a', 'a', '$2y$10$enhLafrUiMAweWrA9EaAcuOMiB3dvZZdPTVpemW3hSiUklAEK1mJG', NULL, '2@gmail.com', 'Hombre', '2000-11-11', 2, NULL, ''),
(22, 'a', 'a', '$2y$10$WrMFSkCQetXMkHsXyNEvdusq65Em5qAK.01gAQmQPpAqeAAzBakLe', NULL, '3@gmail.com', 'Hombre', '2000-11-11', 2, NULL, ''),
(23, 'Augusto ', 'de los Santos', '$2y$10$32p63jRU7RZ.zTxnj88fEOx4Xr.hdGwUEB4w3m5r1OgMn.7J.g73y', NULL, 'augustodlsr@gmail.com', 'Hombre', '2007-01-30', 2, 75, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoracion`
--

CREATE TABLE `valoracion` (
  `id_valoracion` int(11) NOT NULL,
  `id_residencia` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `puntuacion` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD KEY `id_admin` (`id_admin`);

--
-- Indices de la tabla `cambiar_contra`
--
ALTER TABLE `cambiar_contra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `fk_residencia` (`id_residencia`),
  ADD KEY `fk_usuario` (`id_usuario`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_residencia` (`id_residencia`);

--
-- Indices de la tabla `fotos_residencia`
--
ALTER TABLE `fotos_residencia`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `fotos_residencia_ibfk_1` (`id_residencia`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id_habitacion`),
  ADD KEY `id_residencia` (`id_residencia`);

--
-- Indices de la tabla `propietario`
--
ALTER TABLE `propietario`
  ADD PRIMARY KEY (`id_propietario`),
  ADD UNIQUE KEY `id_residencia` (`id_residencia`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

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
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`) USING BTREE,
  ADD KEY `id_residencia` (`id_residencia`);

--
-- Indices de la tabla `valoracion`
--
ALTER TABLE `valoracion`
  ADD PRIMARY KEY (`id_valoracion`),
  ADD KEY `id_residencia` (`id_residencia`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cambiar_contra`
--
ALTER TABLE `cambiar_contra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `fotos_residencia`
--
ALTER TABLE `fotos_residencia`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id_habitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `residencia`
--
ALTER TABLE `residencia`
  MODIFY `id_residencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `valoracion`
--
ALTER TABLE `valoracion`
  MODIFY `id_valoracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_residencia`) REFERENCES `residencia` (`id_residencia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_residencia` FOREIGN KEY (`id_residencia`) REFERENCES `residencia` (`id_residencia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`id_residencia`) REFERENCES `residencia` (`id_residencia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `fotos_residencia`
--
ALTER TABLE `fotos_residencia`
  ADD CONSTRAINT `fotos_residencia_ibfk_1` FOREIGN KEY (`id_residencia`) REFERENCES `residencia` (`id_residencia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `propietario`
--
ALTER TABLE `propietario`
  ADD CONSTRAINT `propietario_ibfk_1` FOREIGN KEY (`id_propietario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `propietario_ibfk_2` FOREIGN KEY (`id_residencia`) REFERENCES `residencia` (`id_residencia`),
  ADD CONSTRAINT `propietario_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `residencia`
--
ALTER TABLE `residencia`
  ADD CONSTRAINT `residencia_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_residencia`) REFERENCES `residencia` (`id_residencia`) ON DELETE SET NULL;

--
-- Filtros para la tabla `valoracion`
--
ALTER TABLE `valoracion`
  ADD CONSTRAINT `valoracion_ibfk_1` FOREIGN KEY (`id_residencia`) REFERENCES `residencia` (`id_residencia`) ON DELETE CASCADE,
  ADD CONSTRAINT `valoracion_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
