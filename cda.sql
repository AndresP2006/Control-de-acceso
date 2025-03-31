-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-03-2025 a las 01:07:05
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
-- Base de datos: `cda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apartamento`
--

CREATE TABLE `apartamento` (
  `Ap_id` int(10) NOT NULL,
  `To_id` int(10) NOT NULL,
  `Ap_numero` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `apartamento`
--

INSERT INTO `apartamento` (`Ap_id`, `To_id`, `Ap_numero`) VALUES
(106, 1, 302),
(107, 2, 212),
(108, 1, 212),
(109, 1, 302);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

CREATE TABLE `paquete` (
  `Pa_id` int(10) NOT NULL,
  `Pa_estado` varchar(250) NOT NULL,
  `Pa_descripcion` varchar(250) NOT NULL,
  `Pa_fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `Pa_responsable` varchar(50) NOT NULL,
  `Pe_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paquete`
--

INSERT INTO `paquete` (`Pa_id`, `Pa_estado`, `Pa_descripcion`, `Pa_fecha`, `Pa_responsable`, `Pe_id`) VALUES
(1, 'activo', 'Pc gamer', '2024-11-07 05:00:00', 'Stiven', NULL),
(2, 'activo', 'PC gamer', '2024-11-07 05:00:00', 'Juan', NULL),
(3, 'activo', 'PortÃ¡til', '2024-11-08 05:00:00', 'Juan', NULL),
(4, 'Estado', 'asddfgdgf', '2024-11-12 05:00:00', 'Guardia_2', 123),
(5, 'Estado', 'asddfgdgf', '2024-11-12 05:00:00', 'Guardia_2', 123),
(6, 'Estado', 'asdddddddddddd', '2024-11-12 05:00:00', 'Guardia_5', 123),
(7, 'bueno', 'en caja', '2024-11-07 05:00:00', 'portero', 12345),
(8, 'bueno', 'en caja', '2024-11-07 05:00:00', 'portero', 12345),
(9, 'Fragil', 'esd', '2024-11-20 05:00:00', 'Guardia_2', 123),
(10, 'Fragil', 'asdfsd', '2024-11-24 05:00:00', 'Guardia_2', 123);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `Pe_id` int(20) NOT NULL,
  `Pe_nombre` varchar(50) NOT NULL,
  `Pe_apellidos` varchar(50) NOT NULL,
  `Pe_telefono` varchar(50) NOT NULL,
  `Us_id` int(11) DEFAULT NULL,
  `Ap_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`Pe_id`, `Pe_nombre`, `Pe_apellidos`, `Pe_telefono`, `Us_id`, `Ap_id`) VALUES
(0, 'Luis', 'Padilla', '30000000', NULL, NULL),
(123, 'JD', 'RP', '30000000', NULL, 106),
(1820, 'luis', 'Padilla', '23425342234', 1820, 107),
(2006, 'josimar', 'suñoga', '12121312313', 2006, NULL),
(2020, 'stiven', 'catalan', '32424242', 2020, 108),
(12345, 'David', 'Rua', '30000000', NULL, 108),
(123456, 'Andres', 'Pereira', '300000', NULL, NULL),
(1042851729, 'Andres', 'Pereira', '3202116434', 1042851729, 108);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `Re_id` int(10) NOT NULL,
  `Re_fecha_entrada` date NOT NULL,
  `Re_hora_entrada` time NOT NULL,
  `Re_hora_salida` time NOT NULL,
  `Re_motivo` varchar(50) NOT NULL,
  `Vi_departamento` varchar(50) NOT NULL,
  `Pe_id` int(20) NOT NULL,
  `Vi_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`Re_id`, `Re_fecha_entrada`, `Re_hora_entrada`, `Re_hora_salida`, `Re_motivo`, `Vi_departamento`, `Pe_id`, `Vi_id`) VALUES
(2, '2024-11-18', '14:27:42', '22:42:06', '', '', 0, 1042851729),
(3, '2024-11-20', '20:30:30', '22:23:46', '', '', 0, 123),
(4, '2024-11-21', '22:42:50', '22:44:18', '', '', 0, 1),
(5, '2024-11-21', '22:44:42', '22:52:34', '', '', 0, 2),
(6, '2024-11-21', '22:46:23', '22:47:34', '', '', 0, 3),
(7, '2024-11-21', '22:48:30', '22:49:42', '', '', 0, 4),
(8, '2024-11-22', '20:03:11', '20:17:03', '', '', 0, 345),
(9, '2024-11-22', '20:08:18', '20:23:55', '', '', 0, 321),
(10, '2024-11-22', '20:09:24', '00:00:00', '', '', 0, 21),
(11, '2024-11-22', '20:10:25', '21:01:44', '', '', 0, 11),
(12, '2024-11-22', '20:10:48', '00:00:00', '', '', 0, 22),
(13, '2024-11-22', '20:12:05', '00:00:00', '', '', 0, 44),
(14, '2024-11-22', '20:15:54', '00:00:00', '', '', 0, 222),
(15, '2024-11-22', '21:02:22', '21:54:29', '', '', 0, 4321),
(16, '2024-11-24', '12:53:01', '00:00:00', '', '', 0, 1111),
(17, '2024-11-24', '12:53:57', '00:00:00', '', '', 0, 1212121),
(18, '2024-11-24', '20:15:46', '20:17:14', '', '', 0, 777),
(19, '2024-11-25', '16:51:23', '00:00:00', '', '', 0, 1104413144),
(20, '2024-11-25', '17:10:24', '00:00:00', '', '', 0, 0),
(21, '2025-03-26', '14:08:04', '00:00:00', '1313', '108', 1042851729, 123123);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `Ro_id` int(10) NOT NULL,
  `Ro_tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`Ro_id`, `Ro_tipo`) VALUES
(1, 'Administrador'),
(2, 'Guardia'),
(3, 'Residente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_actualizacion`
--

CREATE TABLE `solicitudes_actualizacion` (
  `id` int(11) NOT NULL,
  `id_residente` int(11) NOT NULL,
  `correo_nuevo` varchar(255) NOT NULL,
  `telefono_nuevo` varchar(50) NOT NULL,
  `torre_nuevo` varchar(10) NOT NULL,
  `apartamento_nuevo` varchar(50) NOT NULL,
  `estado` enum('pendiente','aprobada','rechazada') DEFAULT 'pendiente',
  `razon_rechazo` varchar(255) DEFAULT NULL,
  `fecha_solicitud` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitudes_actualizacion`
--

INSERT INTO `solicitudes_actualizacion` (`id`, `id_residente`, `correo_nuevo`, `telefono_nuevo`, `torre_nuevo`, `apartamento_nuevo`, `estado`, `razon_rechazo`, `fecha_solicitud`) VALUES
(1, 1042851729, 'andresPereira@gmail.com', '3202116434', 'A', '212', 'pendiente', NULL, '2025-03-30 22:55:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torre`
--

CREATE TABLE `torre` (
  `To_id` int(10) NOT NULL,
  `To_letra` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `torre`
--

INSERT INTO `torre` (`To_id`, `To_letra`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Us_id` int(10) NOT NULL,
  `Us_usuario` varchar(50) NOT NULL,
  `Us_contrasena` varchar(255) DEFAULT NULL,
  `Us_correo` varchar(100) NOT NULL,
  `Ro_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Us_id`, `Us_usuario`, `Us_contrasena`, `Us_correo`, `Ro_id`) VALUES
(123, 'David', 'd12345', 'jrua1043@gmail.com', 2),
(1820, 'luis', '', 'Luis@gmail.com', 3),
(2006, 'Juan', '12345', 'charry@gmail.com', 1),
(2020, 'stiven', '05', 'andresPereira@gmail.com', 3),
(1042851729, 'Andres', '2006', 'andresPereira@gmail.com', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitantes`
--

CREATE TABLE `visitantes` (
  `Vi_id` int(10) NOT NULL,
  `Vi_nombres` varchar(50) NOT NULL,
  `Vi_apellidos` varchar(50) NOT NULL,
  `Vi_telefono` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `visitantes`
--

INSERT INTO `visitantes` (`Vi_id`, `Vi_nombres`, `Vi_apellidos`, `Vi_telefono`) VALUES
(0, '', '', ''),
(1, 'Lucas', 'Perez', '234'),
(2, 'Juan', 'Charry', '312'),
(3, 'Juan', 'Charry', '312'),
(4, 'Juan', 'Charry', '312'),
(11, 'Pedro', 'Charry', '312'),
(21, 'Lucas', 'Perez', '312'),
(22, 'Lucas', 'Charry', '312'),
(44, 'Juan', 'Charry', '312'),
(123, 'Juan', 'Charry', '312'),
(222, 'Lucas', 'Charry', '234'),
(321, 'Pedro', 'Peres', '312'),
(345, 'Juan', 'Charry', '312'),
(777, 'Kendo', 'Kapony', '312'),
(1111, 'sd', 'asd', '122'),
(4321, 'Kendo', 'Kapony', '32123213'),
(123123, 'stiven', 'Padilla', '3202116434'),
(1212121, 'sdasdgkf', 'jhj', '24244'),
(1042851729, 'andres', 'pereira', '3003489600'),
(1104413144, 'KAPONY', 'Kapony', '2323');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apartamento`
--
ALTER TABLE `apartamento`
  ADD PRIMARY KEY (`Ap_id`),
  ADD KEY `To_id` (`To_id`);

--
-- Indices de la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD PRIMARY KEY (`Pa_id`),
  ADD KEY `Pe_id` (`Pe_id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`Pe_id`),
  ADD KEY `U_id` (`Us_id`),
  ADD KEY `Ap_id` (`Ap_id`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`Re_id`),
  ADD KEY `Vi_id` (`Vi_id`),
  ADD KEY `Pe_id` (`Pe_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`Ro_id`);

--
-- Indices de la tabla `solicitudes_actualizacion`
--
ALTER TABLE `solicitudes_actualizacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `torre`
--
ALTER TABLE `torre`
  ADD PRIMARY KEY (`To_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Us_id`),
  ADD KEY `C_id` (`Ro_id`);

--
-- Indices de la tabla `visitantes`
--
ALTER TABLE `visitantes`
  ADD PRIMARY KEY (`Vi_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `apartamento`
--
ALTER TABLE `apartamento`
  MODIFY `Ap_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT de la tabla `paquete`
--
ALTER TABLE `paquete`
  MODIFY `Pa_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `Re_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `Ro_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitudes_actualizacion`
--
ALTER TABLE `solicitudes_actualizacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apartamento`
--
ALTER TABLE `apartamento`
  ADD CONSTRAINT `apartamento_ibfk_1` FOREIGN KEY (`To_id`) REFERENCES `torre` (`To_id`);

--
-- Filtros para la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD CONSTRAINT `paquete_ibfk_1` FOREIGN KEY (`Pe_id`) REFERENCES `persona` (`Pe_id`),
  ADD CONSTRAINT `paquete_ibfk_2` FOREIGN KEY (`Pe_id`) REFERENCES `persona` (`Pe_id`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_3` FOREIGN KEY (`Us_id`) REFERENCES `usuario` (`Us_id`),
  ADD CONSTRAINT `persona_ibfk_4` FOREIGN KEY (`Ap_id`) REFERENCES `apartamento` (`Ap_id`);

--
-- Filtros para la tabla `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `fk_registro_persona` FOREIGN KEY (`Pe_id`) REFERENCES `persona` (`Pe_id`),
  ADD CONSTRAINT `registro_ibfk_1` FOREIGN KEY (`Vi_id`) REFERENCES `visitantes` (`Vi_id`),
  ADD CONSTRAINT `registro_ibfk_2` FOREIGN KEY (`Pe_id`) REFERENCES `persona` (`Pe_id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`Ro_id`) REFERENCES `rol` (`Ro_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
