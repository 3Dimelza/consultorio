CREATE DATABASE consultorio_medico;
USE consultorio_medico;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cita_cabeza`
--

DROP TABLE IF EXISTS `cita_cabeza`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cita_cabeza` (
  `idCitaCabeza` int NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `idPaciente` int DEFAULT NULL,
  `idMedico` int DEFAULT NULL,
  `idCita` int DEFAULT NULL,
  `estado` tinyint NOT NULL DEFAULT '1',
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultimaActualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `idUsuario_auditoria` smallint NOT NULL,
  PRIMARY KEY (`idCitaCabeza`),
  KEY `idCita` (`idCita`),
  CONSTRAINT `cita_cabeza_ibfk_1` FOREIGN KEY (`idCita`) REFERENCES `citas` (`idCita`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cita_cabeza`
--

LOCK TABLES `cita_cabeza` WRITE;
/*!40000 ALTER TABLE `cita_cabeza` DISABLE KEYS */;
/*!40000 ALTER TABLE `cita_cabeza` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cita_detalle`
--

DROP TABLE IF EXISTS `cita_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cita_detalle` (
  `idCitaDetalle` int NOT NULL AUTO_INCREMENT,
  `idCitaCabeza` int DEFAULT NULL,
  `nombrePaciente` varchar(255) DEFAULT NULL,
  `nombreMedico` varchar(255) DEFAULT NULL,
  `nombreAtencion` varchar(255) DEFAULT NULL,
  `costoAtencion` int NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultimaActualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `idUsuario_auditoria` smallint NOT NULL,
  PRIMARY KEY (`idCitaDetalle`),
  KEY `idCitaCabeza` (`idCitaCabeza`),
  CONSTRAINT `cita_detalle_ibfk_1` FOREIGN KEY (`idCitaCabeza`) REFERENCES `cita_cabeza` (`idCitaCabeza`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cita_detalle`
--

LOCK TABLES `cita_detalle` WRITE;
/*!40000 ALTER TABLE `cita_detalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `cita_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citas` (
  `idCita` int NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `motivoConsulta` varchar(255) NOT NULL,
  `idPaciente` int DEFAULT NULL,
  `idMedico` int DEFAULT NULL,
  `idTipoDeAtencion` int DEFAULT NULL,
  `estado` tinyint NOT NULL DEFAULT '1',
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultimaActualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `idUsuario_auditoria` smallint NOT NULL,
  PRIMARY KEY (`idCita`),
  KEY `idPaciente` (`idPaciente`),
  KEY `idMedico` (`idMedico`),
  KEY `idTipoDeAtencion` (`idTipoDeAtencion`),
  CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`idPaciente`) REFERENCES `pacientes` (`idPaciente`),
  CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`idMedico`) REFERENCES `medicos` (`idMedico`),
  CONSTRAINT `citas_ibfk_3` FOREIGN KEY (`idTipoDeAtencion`) REFERENCES `tipodeatencion` (`idTipoDeAtencion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicos`
--

DROP TABLE IF EXISTS `medicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medicos` (
  `idMedico` int NOT NULL,
  `especialidad` varchar(100) DEFAULT 'neurología',
  `estado` tinyint NOT NULL DEFAULT '1',
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultimaActualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `idUsuario_auditoria` smallint NOT NULL,
  PRIMARY KEY (`idMedico`),
  CONSTRAINT `medicos_ibfk_1` FOREIGN KEY (`idMedico`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicos`
--

LOCK TABLES `medicos` WRITE;
/*!40000 ALTER TABLE `medicos` DISABLE KEYS */;
/*!40000 ALTER TABLE `medicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pacientes` (
  `idPaciente` int NOT NULL,
  `alergias` varchar(255) DEFAULT NULL,
  `tipoSangre` varchar(50) DEFAULT NULL,
  `historial_medico` text,
  `estado` tinyint NOT NULL DEFAULT '1',
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultimaActualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `idUsuario_auditoria` smallint NOT NULL,
  PRIMARY KEY (`idPaciente`),
  CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`idPaciente`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes`
--

LOCK TABLES `pacientes` WRITE;
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipodeatencion`
--

DROP TABLE IF EXISTS `tipodeatencion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipodeatencion` (
  `idTipoDeAtencion` int NOT NULL AUTO_INCREMENT,
  `nombreTipoAtencion` varchar(100) NOT NULL,
  `costoAtencion` int NOT NULL,
  `estado` tinyint NOT NULL DEFAULT '1',
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultimaActualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `idUsuario_auditoria` smallint NOT NULL,
  PRIMARY KEY (`idTipoDeAtencion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipodeatencion`
--

LOCK TABLES `tipodeatencion` WRITE;
/*!40000 ALTER TABLE `tipodeatencion` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipodeatencion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `idUsuario` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `rol` varchar(50) NOT NULL,
  `estado` tinyint NOT NULL DEFAULT '1',
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultimaActualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `idUsuario_auditoria` smallint NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Dimelza','Duran','1995-09-30','555-1234','Calle Falsa 123, Ciudad','duran.dimelza.647@gmail.com','1234','administrador',1,'2024-08-10 23:06:32',NULL,1),(3,'Carlos','Mendez','1980-03-15','555-5678','Avenida Central 456, Ciudad','coca.daniela.125@gmail.com','1234','medico',1,'2024-08-10 23:27:10',NULL,1),(4,'Ana','Mendez','1980-03-15','555-5678','Avenida Central 456, Ciudad','3dimelss501@gmail.com','1234','paciente',1,'2024-08-10 23:27:52',NULL,1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-10 20:12:38
