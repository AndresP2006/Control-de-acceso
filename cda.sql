-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 01-07-2025 a las 23:27:54
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.3.14

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

DROP TABLE IF EXISTS `apartamento`;
CREATE TABLE IF NOT EXISTS `apartamento` (
  `Ap_id` int NOT NULL AUTO_INCREMENT,
  `To_id` int NOT NULL,
  `Ap_numero` int NOT NULL,
  PRIMARY KEY (`Ap_id`),
  KEY `To_id` (`To_id`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `apartamento`
--

INSERT INTO `apartamento` (`Ap_id`, `To_id`, `Ap_numero`) VALUES
(106, 1, 302),
(107, 2, 212),
(115, 3, 100),
(116, 3, 101),
(117, 4, 400),
(118, 5, 500),
(119, 5, 501),
(120, 5, 502),
(121, 4, 401),
(122, 4, 402);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

DROP TABLE IF EXISTS `paquete`;
CREATE TABLE IF NOT EXISTS `paquete` (
  `Pa_id` int NOT NULL AUTO_INCREMENT,
  `Pa_estado` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `Pa_descripcion` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `Pa_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Pa_responsable` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Pe_id` int DEFAULT NULL,
  `Pa_recibe` int DEFAULT NULL,
  `Pa_fecha_recibido` timestamp NULL DEFAULT NULL,
  `vista` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Pa_id`),
  KEY `Pe_id` (`Pe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paquete`
--

INSERT INTO `paquete` (`Pa_id`, `Pa_estado`, `Pa_descripcion`, `Pa_fecha`, `Pa_responsable`, `Pe_id`, `Pa_recibe`, `Pa_fecha_recibido`, `vista`) VALUES
(32, 'Entregado', 'Una cama grander', '2025-06-21 17:23:00', 'Luis', 123, 1042851730, '2025-07-01 23:15:18', 0),
(37, 'Bodega', 'cama doble', '2025-07-01 23:15:00', 'portero del conjunto', 1042851730, NULL, NULL, 0),
(38, 'Bodega', 'cocina portatil', '2025-07-01 23:15:00', 'portero del conjunto', 1042851732, NULL, NULL, 0),
(39, 'Bodega', 'mancuernas', '2025-07-01 23:15:00', 'portero del conjunto', 1042851733, NULL, NULL, 0),
(40, 'Bodega', 'ropa de casa', '2025-07-01 23:16:00', 'portero del conjunto', 1042851729, NULL, NULL, 1),
(41, 'Bodega', 'bicicleta', '2025-07-01 23:16:00', 'portero del conjunto', 1042851731, NULL, NULL, 0),
(42, 'Bodega', 'sillas de madera', '2025-07-01 23:16:00', 'portero del conjunto', 1042851730, NULL, NULL, 0),
(43, 'Bodega', 'baldes de agua', '2025-07-01 23:17:00', 'portero del conjunto', 1042851732, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE IF NOT EXISTS `persona` (
  `Pe_id` int NOT NULL,
  `Pe_nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Pe_apellidos` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Pe_telefono` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Us_id` int DEFAULT NULL,
  `Ap_id` int DEFAULT NULL,
  PRIMARY KEY (`Pe_id`),
  KEY `U_id` (`Us_id`),
  KEY `Ap_id` (`Ap_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`Pe_id`, `Pe_nombre`, `Pe_apellidos`, `Pe_telefono`, `Us_id`, `Ap_id`) VALUES
(123, 'Juan David', 'Rua', '30000000', 123, 106),
(999, 'Juan David', 'Celeste', '30000000', 999, 106),
(2006, 'admin', 'admin', '3202116439', 2006, 106),
(2020, 'porter', 'porter', '3202116434', 2020, 106),
(1042851729, 'Andres', 'Pereira', '3202116434', 1042851729, 106),
(1042851730, 'stiven', 'catalan', '3202116434', 1042851730, 107),
(1042851731, 'yasmith', 'zuñiga', '3003489600', 1042851731, 106),
(1042851732, 'luis', 'perez', '3082482938', 1042851732, 121),
(1042851733, 'Josue', 'sining', '3058295839', 1042851733, 120),
(1042851734, 'santiago', 'sining', '30582759374', 1042851734, 117),
(1042851740, 'Jose', 'fontalbo', '30582759374', 1042851740, NULL),
(1042851742, 'saray', 'flores', '3273849273', 1042851742, 115),
(1727462549, 'marlis', 'martines', '3625394760', 1727462549, 116);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

DROP TABLE IF EXISTS `registro`;
CREATE TABLE IF NOT EXISTS `registro` (
  `Re_id` int NOT NULL AUTO_INCREMENT,
  `Re_fecha_entrada` date NOT NULL,
  `Re_hora_entrada` time NOT NULL,
  `Re_hora_salida` time NOT NULL,
  `Re_motivo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Use_visit` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Vi_departamento` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Pe_id` int NOT NULL,
  `Vi_id` int NOT NULL,
  `vista` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Re_id`),
  KEY `Vi_id` (`Vi_id`),
  KEY `Pe_id` (`Pe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`Re_id`, `Re_fecha_entrada`, `Re_hora_entrada`, `Re_hora_salida`, `Re_motivo`, `Use_visit`, `Vi_departamento`, `Pe_id`, `Vi_id`, `vista`) VALUES
(104, '2025-07-01', '18:05:49', '00:00:00', 'ver a un amigo', NULL, '117', 1042851734, 1042851729, 0),
(105, '2025-07-01', '18:06:21', '00:00:00', 'ver a un amigo', NULL, '107', 1042851730, 1042851730, 0),
(106, '2025-07-01', '18:11:09', '00:00:00', 'ver a un amigo', NULL, '120', 1042851733, 1042841731, 0),
(107, '2025-07-01', '18:11:46', '00:00:00', 'ver a un amigo', NULL, '107', 1042851730, 1042851732, 0),
(108, '2025-07-01', '18:12:52', '00:00:00', 'arreglar un aire', NULL, '121', 1042851732, 1927493758, 0),
(109, '2025-07-01', '18:13:38', '00:00:00', 'dejar un recado', NULL, '106', 123, 1946283549, 0),
(110, '2025-07-01', '18:14:24', '00:00:00', 'pasar la noche con mi pareja', NULL, '107', 1042851730, 1027354937, 0),
(111, '2025-07-01', '18:21:33', '18:21:39', 'ver a un amigo', 'Permitido', '302', 1042851729, 1826492730, 0),
(112, '2025-07-01', '18:25:27', '00:00:00', 'arreglar un aire', 'Permitido', '302', 1042851729, 1826492730, 0),
(113, '2025-07-01', '18:25:28', '18:26:30', 'ver a un amigo', 'Permitido', '302', 1042851729, 1927384956, 0),
(114, '2025-07-01', '18:26:00', '18:26:30', 'ver a un amigo', 'Permitido', '302', 1042851729, 1927384956, 0),
(115, '2025-07-01', '18:26:26', '18:26:30', 'arreglar un aire', 'Permitido', '302', 1042851729, 1927384956, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `Ro_id` int NOT NULL AUTO_INCREMENT,
  `Ro_tipo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Ro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

DROP TABLE IF EXISTS `solicitudes_actualizacion`;
CREATE TABLE IF NOT EXISTS `solicitudes_actualizacion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_residente` int NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `correo_nuevo` varchar(255) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `correo_viejo` varchar(255) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `telefono_nuevo` varchar(50) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `telefono_viejo` varchar(50) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `estado` enum('pendiente','aprobada','rechazada') COLLATE utf8mb3_spanish2_ci DEFAULT 'pendiente',
  `razon_rechazo` varchar(255) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `fecha_solicitud` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vista` tinyint(1) NOT NULL DEFAULT '0',
  `vista_resident` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `solicitudes_actualizacion`
--

INSERT INTO `solicitudes_actualizacion` (`id`, `id_residente`, `nombre`, `correo_nuevo`, `correo_viejo`, `telefono_nuevo`, `telefono_viejo`, `estado`, `razon_rechazo`, `fecha_solicitud`, `vista`, `vista_resident`) VALUES
(27, 1042851729, 'Andres Pereira', 'Andres@gmail.com', 'pereirapuelloandresdavid@gmail.com', '3202116434', '3202116434', 'aprobada', NULL, '2025-06-13 01:01:01', 1, 1),
(28, 1042851729, 'Andres Pereira', 'pereirapuelloandresdavid@gmail.com', 'Andres@gmail.com', '3202116434', '3202116434', 'aprobada', NULL, '2025-06-13 01:23:09', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torre`
--

DROP TABLE IF EXISTS `torre`;
CREATE TABLE IF NOT EXISTS `torre` (
  `To_id` int NOT NULL,
  `To_letra` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`To_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `torre`
--

INSERT INTO `torre` (`To_id`, `To_letra`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D'),
(5, 'H');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `Us_id` int NOT NULL,
  `Us_usuario` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Us_contrasena` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Us_correo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Ro_id` int NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Us_id`),
  KEY `C_id` (`Ro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Us_id`, `Us_usuario`, `Us_contrasena`, `Us_correo`, `Ro_id`, `estado`) VALUES
(123, 'Juan David', 'Juan12345$', 'jrua1043@gmail.com', 3, 'activo'),
(999, 'Juan David', 'Juan12345$', 'Maria@gmail.com', 3, 'inactivo'),
(2006, 'admin', 'Admin_2025', 'jrua1043@gmail.com', 1, 'activo'),
(2020, 'porter', 'Porter_2025', 'jcharryme@gmail.com', 2, 'activo'),
(1042851729, 'Andres', 'Andres_2025', 'pereirapuelloandresdavid@gmail.com', 3, 'activo'),
(1042851730, 'stiven', 'Stiven_2025', 'Dariosilgado@gmail.com', 3, 'activo'),
(1042851731, 'yasmith', 'Yasmith_2020', 'yasmithpatricia@gmail.com', 3, 'activo'),
(1042851732, 'luis', 'Luis_2011', 'luisPerez@gmail.com', 3, 'activo'),
(1042851733, 'Josue', 'Josue$3030', 'JosueGomez@gmail.com', 3, 'activo'),
(1042851734, 'santiago', 'Santiago@sinig', 'santiagosining@gmail.com', 2, 'activo'),
(1042851740, 'Jose', 'Jose@fontalbo', 'Jose@gmail.com', 1, 'activo'),
(1042851742, 'saray', 'Saray$123', 'saray@gmail.com', 3, 'activo'),
(1727462549, 'marlis', 'Marlis@martines', 'marli@gmail.com', 3, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitantes`
--

DROP TABLE IF EXISTS `visitantes`;
CREATE TABLE IF NOT EXISTS `visitantes` (
  `Vi_id` int NOT NULL,
  `Vi_nombres` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Vi_apellidos` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Vi_telefono` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `Vi_permiso` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`Vi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `visitantes`
--

INSERT INTO `visitantes` (`Vi_id`, `Vi_nombres`, `Vi_apellidos`, `Vi_telefono`, `estado`, `Vi_permiso`) VALUES
(1027354937, 'kuranlli', 'puello', '3947264957', '', NULL),
(1042841731, 'luis', 'Padilla', '3927493720', '', NULL),
(1042851729, 'Andres', 'Pereira', '3202116434', '', NULL),
(1042851730, 'stiven', 'Pereira', '3048273849', '', NULL),
(1042851732, 'jhon', 'jinete', '3048372649', '', NULL),
(1826492730, '', '', '3828463945', '0', 'solicitado'),
(1927384956, 'joa', 'martines', '2823629323', '0', 'salida'),
(1927493758, 'jhonatan', 'gomez', '3957451943', '', NULL),
(1946283549, 'legolas', 'puello', '3846582649', '', NULL);

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
