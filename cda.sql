-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: cda
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `apartamento`
--

DROP TABLE IF EXISTS `apartamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `apartamento` (
  `Ap_id` int(10) NOT NULL AUTO_INCREMENT,
  `To_id` int(10) NOT NULL,
  `Ap_numero` int(20) NOT NULL,
  PRIMARY KEY (`Ap_id`),
  KEY `To_id` (`To_id`),
  CONSTRAINT `apartamento_ibfk_1` FOREIGN KEY (`To_id`) REFERENCES `torre` (`To_id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apartamento`
--

LOCK TABLES `apartamento` WRITE;
/*!40000 ALTER TABLE `apartamento` DISABLE KEYS */;
INSERT INTO `apartamento` VALUES (106,1,302),(107,2,212),(108,1,212),(109,1,302);
/*!40000 ALTER TABLE `apartamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paquete`
--

DROP TABLE IF EXISTS `paquete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paquete` (
  `Pa_id` int(10) NOT NULL AUTO_INCREMENT,
  `Pa_estado` varchar(250) NOT NULL,
  `Pa_descripcion` varchar(250) NOT NULL,
  `Pa_fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `Pa_responsable` varchar(50) NOT NULL,
  `Pe_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Pa_id`),
  KEY `Pe_id` (`Pe_id`),
  CONSTRAINT `paquete_ibfk_1` FOREIGN KEY (`Pe_id`) REFERENCES `persona` (`Pe_id`),
  CONSTRAINT `paquete_ibfk_2` FOREIGN KEY (`Pe_id`) REFERENCES `persona` (`Pe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paquete`
--

LOCK TABLES `paquete` WRITE;
/*!40000 ALTER TABLE `paquete` DISABLE KEYS */;
INSERT INTO `paquete` VALUES (1,'activo','Pc gamer','2024-11-07 05:00:00','Stiven',NULL),(2,'activo','PC gamer','2024-11-07 05:00:00','Juan',NULL),(3,'activo','PortÃ¡til','2024-11-08 05:00:00','Juan',NULL),(4,'Estado','asddfgdgf','2024-11-12 05:00:00','Guardia_2',123),(5,'Estado','asddfgdgf','2024-11-12 05:00:00','Guardia_2',123),(6,'Estado','asdddddddddddd','2024-11-12 05:00:00','Guardia_5',123),(7,'bueno','en caja','2024-11-07 05:00:00','portero',12345),(8,'bueno','en caja','2024-11-07 05:00:00','portero',12345),(9,'Fragil','esd','2024-11-20 05:00:00','Guardia_2',123),(10,'Fragil','asdfsd','2024-11-24 05:00:00','Guardia_2',123);
/*!40000 ALTER TABLE `paquete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (123,'JD','RP','30000000',NULL,106),(2006,'josimar','suñoga','12121312313',2006,NULL),(12345,'David','Rua','30000000',NULL,108),(123456,'Andres','Pereira','300000',NULL,NULL),(1234567,'Luis','Padilla','30000000',NULL,NULL);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registro`
--

DROP TABLE IF EXISTS `registro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registro` (
  `Re_id` int(10) NOT NULL AUTO_INCREMENT,
  `Re_fecha_entrada` date NOT NULL,
  `Re_hora_entrada` time NOT NULL,
  `Re_hora_salida` time NOT NULL,
  `Re_motivo` varchar(50) NOT NULL,
  `Vi_id` int(10) NOT NULL,
  PRIMARY KEY (`Re_id`),
  KEY `Vi_id` (`Vi_id`),
  CONSTRAINT `registro_ibfk_1` FOREIGN KEY (`Vi_id`) REFERENCES `visitantes` (`Vi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro`
--

LOCK TABLES `registro` WRITE;
/*!40000 ALTER TABLE `registro` DISABLE KEYS */;
INSERT INTO `registro` VALUES (2,'2024-11-18','14:27:42','22:42:06','',1042851729),(3,'2024-11-20','20:30:30','22:23:46','',123),(4,'2024-11-21','22:42:50','22:44:18','',1),(5,'2024-11-21','22:44:42','22:52:34','',2),(6,'2024-11-21','22:46:23','22:47:34','',3),(7,'2024-11-21','22:48:30','22:49:42','',4),(8,'2024-11-22','20:03:11','20:17:03','',345),(9,'2024-11-22','20:08:18','20:23:55','',321),(10,'2024-11-22','20:09:24','00:00:00','',21),(11,'2024-11-22','20:10:25','21:01:44','',11),(12,'2024-11-22','20:10:48','00:00:00','',22),(13,'2024-11-22','20:12:05','00:00:00','',44),(14,'2024-11-22','20:15:54','00:00:00','',222),(15,'2024-11-22','21:02:22','21:54:29','',4321),(16,'2024-11-24','12:53:01','00:00:00','',1111),(17,'2024-11-24','12:53:57','00:00:00','',1212121),(18,'2024-11-24','20:15:46','20:17:14','',777),(19,'2024-11-25','16:51:23','00:00:00','',1104413144),(20,'2024-11-25','17:10:24','00:00:00','',0);
/*!40000 ALTER TABLE `registro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rol` (
  `Ro_id` int(10) NOT NULL AUTO_INCREMENT,
  `Ro_tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`Ro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'Administrador'),(2,'Guardia'),(3,'Residente');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `torre`
--

DROP TABLE IF EXISTS `torre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `torre` (
  `To_id` int(10) NOT NULL,
  `To_letra` varchar(10) NOT NULL,
  PRIMARY KEY (`To_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `torre`
--

LOCK TABLES `torre` WRITE;
/*!40000 ALTER TABLE `torre` DISABLE KEYS */;
INSERT INTO `torre` VALUES (1,'A'),(2,'B'),(3,'C');
/*!40000 ALTER TABLE `torre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (123,'David','d12345','jrua1043@gmail.com',2),(2006,'Juan','12345','charry@gmail.com',1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitantes`
--

DROP TABLE IF EXISTS `visitantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `visitantes` (
  `Vi_id` int(10) NOT NULL,
  `Vi_nombres` varchar(50) NOT NULL,
  `Vi_apellidos` varchar(50) NOT NULL,
  `Vi_telefono` varchar(50) NOT NULL,
  `Vi_departamento` varchar(50) NOT NULL,
  `Pe_id` int(10) NOT NULL,
  PRIMARY KEY (`Vi_id`),
  KEY `Pe_id` (`Pe_id`),
  CONSTRAINT `visitantes_ibfk_1` FOREIGN KEY (`Pe_id`) REFERENCES `persona` (`Pe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitantes`
--

LOCK TABLES `visitantes` WRITE;
/*!40000 ALTER TABLE `visitantes` DISABLE KEYS */;
INSERT INTO `visitantes` VALUES (0,'','','','108',12345),(1,'Lucas','Perez','234','102',123),(2,'Juan','Charry','312','102',123),(3,'Juan','Charry','312','102',123),(4,'Juan','Charry','312','102',123),(11,'Pedro','Charry','312','102',123),(21,'Lucas','Perez','312','102',123),(22,'Lucas','Charry','312','102',123),(44,'Juan','Charry','312','102',123),(123,'Juan','Charry','312','102',123),(222,'Lucas','Charry','234','102',123),(321,'Pedro','Peres','312','102',123),(345,'Juan','Charry','312','102',123),(777,'Kendo','Kapony','312','106',123),(1111,'sd','asd','122','106',123),(4321,'Kendo','Kapony','32123213','102',123),(1212121,'sdasdgkf','jhj','24244','106',123),(1042851729,'andres','pereira','3003489600','100',2006),(1104413144,'KAPONY','Kapony','2323','106',123);
/*!40000 ALTER TABLE `visitantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'cda'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-25 17:47:48
