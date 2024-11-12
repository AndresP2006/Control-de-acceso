-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2024 a las 21:17:23
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
-- Base de datos: `cda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apartamento`
--

CREATE TABLE `apartamento` (
  `Ap_id` int(10) NOT NULL,
  `To_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `apartamento`
--

INSERT INTO `apartamento` (`Ap_id`, `To_id`) VALUES
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

CREATE TABLE `paquete` (
  `Pa_id` int(10) NOT NULL,
  `Pa_estado` varchar(250) NOT NULL,
  `Pa_descripcion` varchar(250) NOT NULL,
  `Pa_Fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `Pa_Responsable` varchar(50) NOT NULL,
  `Pe_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paquete`
--

INSERT INTO `paquete` (`Pa_id`, `Pa_estado`, `Pa_descripcion`, `Pa_Fecha`, `Pa_Responsable`, `Pe_id`) VALUES
(1, 'activo', 'Pc gamer', '2024-11-07 05:00:00', 'Stiven', NULL),
(2, 'activo', 'PC gamer', '2024-11-07 05:00:00', 'Juan', NULL),
(3, 'activo', 'PortÃ¡til', '2024-11-08 05:00:00', 'Juan', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `Pe_id` int(20) NOT NULL,
  `Pe_nombre` varchar(50) NOT NULL,
  `Pe_apellidos` varchar(50) NOT NULL,
  `Pe_telefono` varchar(50) NOT NULL,
  `Ap_id` int(10) NOT NULL,
  `Us_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`Pe_id`, `Pe_nombre`, `Pe_apellidos`, `Pe_telefono`, `Ap_id`, `Us_id`) VALUES
(123, 'JD', 'RP', '30000000', 102, NULL),
(12345, 'David', 'Rua', '30000000', 101, NULL),
(123456, 'Andres', 'Pereira', '300000', 103, NULL),
(1234567, 'Luis', 'Padilla', '30000000', 104, NULL),
(12345678, 'Luis', 'Padilla', '30000000', 104, NULL),
(1043870680, 'Juan David', 'Rua Porta', '30000000', 100, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `Re_id` int(10) NOT NULL,
  `Re_fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `Re_fecha_salida` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(12345678, 'Luis', 'luis12345', 'andriano@gmail.com', 1),
(1043870680, 'Juan David', 'Juan12345', 'jrua1043@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitantes`
--

CREATE TABLE `visitantes` (
  `Vi_id` int(10) NOT NULL,
  `Vi_nombres` varchar(50) NOT NULL,
  `Vi_apellidos` varchar(50) NOT NULL,
  `Vi_telefono` varchar(50) NOT NULL,
  `Vi_departamento` varchar(50) NOT NULL,
  `Vi_motivo` varchar(250) NOT NULL,
  `Pe_id` int(10) NOT NULL,
  `Re_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `visitantes`
--

INSERT INTO `visitantes` (`Vi_id`, `Vi_nombres`, `Vi_apellidos`, `Vi_telefono`, `Vi_departamento`, `Vi_motivo`, `Pe_id`, `Re_id`) VALUES
(111, 'Juan', 'Charry', '312', '102', 'No se', 123, NULL),
(123, 'Juan', 'Charry', '312', '102', 'No se', 123, NULL),
(222, 'Juan', 'Charry', '312', '102', 'No se', 123, NULL),
(333, 'Juan', 'Charry', '312', '102', 'No se', 123, NULL),
(444, 'Juan', 'Charry', '312', '102', 'No se', 123, NULL),
(666, 'Juan', 'Charry', '312', '102', 'No se', 123, NULL),
(1234, 'Juan', 'Charry', '312', '102', 'No se', 123, NULL),
(12345, 'Andres', 'Pereira', '3000000', '101', 'Ver a stiven', 12345, NULL),
(123456, 'Juan', 'Charry', '312', '102', 'No se', 123, NULL),
(1234567, 'Stiven', 'Catalan', '30000000', '104', 'Ver a luis', 1234567, NULL),
(1043870680, 'Juan David', 'Rua Porta', '30000000', '100', 'Visitar a mi primo', 1043870680, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apartamento`
--
ALTER TABLE `apartamento`
  ADD PRIMARY KEY (`Ap_id`),
  ADD KEY `T_id` (`To_id`);

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
  ADD KEY `D_id` (`Ap_id`),
  ADD KEY `U_id` (`Us_id`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`Re_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`Ro_id`);

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
  ADD PRIMARY KEY (`Vi_id`),
  ADD KEY `R_id` (`Re_id`),
  ADD KEY `U_id` (`Pe_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `paquete`
--
ALTER TABLE `paquete`
  MODIFY `Pa_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `Re_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `Ro_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `paquete_ibfk_1` FOREIGN KEY (`pe_id`) REFERENCES `persona` (`Pe_id`),
  ADD CONSTRAINT `paquete_ibfk_2` FOREIGN KEY (`Pe_id`) REFERENCES `persona` (`Pe_id`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_2` FOREIGN KEY (`Ap_id`) REFERENCES `apartamento` (`Ap_id`),
  ADD CONSTRAINT `persona_ibfk_3` FOREIGN KEY (`Us_id`) REFERENCES `usuario` (`Us_id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`Ro_id`) REFERENCES `rol` (`Ro_id`);

--
-- Filtros para la tabla `visitantes`
--
ALTER TABLE `visitantes`
  ADD CONSTRAINT `visitantes_ibfk_1` FOREIGN KEY (`Re_id`) REFERENCES `registro` (`Re_id`),
  ADD CONSTRAINT `visitantes_ibfk_2` FOREIGN KEY (`Pe_id`) REFERENCES `persona` (`Pe_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
