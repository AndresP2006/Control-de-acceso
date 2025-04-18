/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - cda
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cda` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci */;

USE `cda`;

/*Table structure for table `apartamento` */

DROP TABLE IF EXISTS `apartamento`;

CREATE TABLE `apartamento` (
  `Ap_id` int(10) NOT NULL AUTO_INCREMENT,
  `To_id` int(10) NOT NULL,
  `Ap_numero` int(20) NOT NULL,
  PRIMARY KEY (`Ap_id`),
  KEY `To_id` (`To_id`),
  CONSTRAINT `apartamento_ibfk_1` FOREIGN KEY (`To_id`) REFERENCES `torre` (`To_id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `apartamento` */

insert  into `apartamento`(`Ap_id`,`To_id`,`Ap_numero`) values 
(106,1,302),
(107,2,212),
(108,1,212);

/*Table structure for table `paquete` */

DROP TABLE IF EXISTS `paquete`;

CREATE TABLE `paquete` (
  `Pa_id` int(10) NOT NULL AUTO_INCREMENT,
  `Pa_estado` varchar(250) NOT NULL,
  `Pa_descripcion` varchar(250) NOT NULL,
  `Pa_fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `Pa_responsable` varchar(50) NOT NULL,
  `Pe_id` int(11) DEFAULT NULL,
  `vista` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`Pa_id`),
  KEY `Pe_id` (`Pe_id`),
  CONSTRAINT `paquete_ibfk_1` FOREIGN KEY (`Pe_id`) REFERENCES `persona` (`Pe_id`),
  CONSTRAINT `paquete_ibfk_2` FOREIGN KEY (`Pe_id`) REFERENCES `persona` (`Pe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `paquete` */

insert  into `paquete`(`Pa_id`,`Pa_estado`,`Pa_descripcion`,`Pa_fecha`,`Pa_responsable`,`Pe_id`,`vista`) values 
(7,'bueno','en caja','2024-11-07 00:00:00','portero',12345,0),
(9,'Fragil','esd','2024-11-20 00:00:00','Guardia_2',123,0),
(22,'Bodega','Cama granade','2025-04-13 10:21:00','Luis',5432,1);

/*Table structure for table `persona` */

DROP TABLE IF EXISTS `persona`;

CREATE TABLE `persona` (
  `Pe_id` int(20) NOT NULL,
  `Pe_nombre` varchar(50) NOT NULL,
  `Pe_apellidos` varchar(50) NOT NULL,
  `Pe_telefono` varchar(50) NOT NULL,
  `Us_id` int(11) DEFAULT NULL,
  `Ap_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`Pe_id`),
  KEY `U_id` (`Us_id`),
  KEY `Ap_id` (`Ap_id`),
  CONSTRAINT `persona_ibfk_3` FOREIGN KEY (`Us_id`) REFERENCES `usuario` (`Us_id`),
  CONSTRAINT `persona_ibfk_4` FOREIGN KEY (`Ap_id`) REFERENCES `apartamento` (`Ap_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `persona` */

insert  into `persona`(`Pe_id`,`Pe_nombre`,`Pe_apellidos`,`Pe_telefono`,`Us_id`,`Ap_id`) values 
(123,'JD','RP','3000000',123,107),
(5432,'Andres','Pereira','353456576',5432,108),
(12345,'David','Rua','30000000',12345,107);

/*Table structure for table `registro` */

DROP TABLE IF EXISTS `registro`;

CREATE TABLE `registro` (
  `Re_id` int(10) NOT NULL AUTO_INCREMENT,
  `Re_fecha_entrada` date NOT NULL,
  `Re_hora_entrada` time NOT NULL,
  `Re_hora_salida` time NOT NULL,
  `Re_motivo` varchar(50) NOT NULL,
  `Vi_departamento` varchar(50) NOT NULL,
  `Pe_id` int(20) NOT NULL,
  `Vi_id` int(10) NOT NULL,
  `vista` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`Re_id`),
  KEY `Vi_id` (`Vi_id`),
  KEY `Pe_id` (`Pe_id`),
  CONSTRAINT `fk_registro_persona` FOREIGN KEY (`Pe_id`) REFERENCES `persona` (`Pe_id`),
  CONSTRAINT `registro_ibfk_1` FOREIGN KEY (`Vi_id`) REFERENCES `visitantes` (`Vi_id`),
  CONSTRAINT `registro_ibfk_2` FOREIGN KEY (`Pe_id`) REFERENCES `persona` (`Pe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `registro` */

insert  into `registro`(`Re_id`,`Re_fecha_entrada`,`Re_hora_entrada`,`Re_hora_salida`,`Re_motivo`,`Vi_departamento`,`Pe_id`,`Vi_id`,`vista`) values 
(21,'2024-11-25','21:33:17','21:36:02','Comer ramen','106',123,45678,0),
(22,'2024-11-25','21:36:54','00:00:00','dattebayo','108',12345,45678,0),
(24,'2024-11-26','10:10:12','00:00:00','Pelear','106',123,1267,0),
(38,'2025-04-13','10:23:19','00:00:00','Ver a sandra','107',5432,8756,1);

/*Table structure for table `rol` */

DROP TABLE IF EXISTS `rol`;

CREATE TABLE `rol` (
  `Ro_id` int(10) NOT NULL AUTO_INCREMENT,
  `Ro_tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`Ro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `rol` */

insert  into `rol`(`Ro_id`,`Ro_tipo`) values 
(1,'Administrador'),
(2,'Guardia'),
(3,'Residente');

/*Table structure for table `solicitudes_actualizacion` */

DROP TABLE IF EXISTS `solicitudes_actualizacion`;

CREATE TABLE `solicitudes_actualizacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_residente` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `correo_nuevo` varchar(255) NOT NULL,
  `correo_viejo` varchar(255) DEFAULT NULL,
  `telefono_nuevo` varchar(50) NOT NULL,
  `telefono_viejo` varchar(50) DEFAULT NULL,
  `estado` enum('pendiente','aprobada','rechazada') DEFAULT 'pendiente',
  `razon_rechazo` varchar(255) DEFAULT NULL,
  `fecha_solicitud` timestamp NOT NULL DEFAULT current_timestamp(),
  `vista` tinyint(1) NOT NULL DEFAULT 0,
  `vista_resident` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `solicitudes_actualizacion` */

/*Table structure for table `torre` */

DROP TABLE IF EXISTS `torre`;

CREATE TABLE `torre` (
  `To_id` int(10) NOT NULL,
  `To_letra` varchar(10) NOT NULL,
  PRIMARY KEY (`To_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `torre` */

insert  into `torre`(`To_id`,`To_letra`) values 
(1,'A'),
(2,'B'),
(3,'C');

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `Us_id` int(10) NOT NULL,
  `Us_usuario` varchar(50) NOT NULL,
  `Us_contrasena` varchar(255) DEFAULT NULL,
  `Us_correo` varchar(100) NOT NULL,
  `Ro_id` int(10) NOT NULL,
  PRIMARY KEY (`Us_id`),
  KEY `C_id` (`Ro_id`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`Ro_id`) REFERENCES `rol` (`Ro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `usuario` */

insert  into `usuario`(`Us_id`,`Us_usuario`,`Us_contrasena`,`Us_correo`,`Ro_id`) values 
(123,'JD','d12345','jrua10333@gmail.com',2),
(5432,'Andres','12345','andres@gmail.com',3),
(12345,'David','12345','David@gmail.com',1);

/*Table structure for table `visitantes` */

DROP TABLE IF EXISTS `visitantes`;

CREATE TABLE `visitantes` (
  `Vi_id` int(10) NOT NULL,
  `Vi_nombres` varchar(50) NOT NULL,
  `Vi_apellidos` varchar(50) NOT NULL,
  `Vi_telefono` varchar(50) NOT NULL,
  PRIMARY KEY (`Vi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `visitantes` */

insert  into `visitantes`(`Vi_id`,`Vi_nombres`,`Vi_apellidos`,`Vi_telefono`) values 
(0,'','',''),
(1243,'Andres','Pereira','3333332211'),
(1267,'Goku','Son','30000000'),
(6785,'Gadys','Donado','4567434tt4'),
(8756,'Yina','Pereira','344546'),
(9878,'Jose','Rua','34575577'),
(45678,'Naruto','Uzumaki','3454345');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
