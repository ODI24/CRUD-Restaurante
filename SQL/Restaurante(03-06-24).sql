-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: restaurante
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cargo`
--

DROP TABLE IF EXISTS `cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargo` (
  `pk_cargo` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nombre_cargo` varchar(25) NOT NULL,
  PRIMARY KEY (`pk_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo`
--

LOCK TABLES `cargo` WRITE;
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
INSERT INTO `cargo` VALUES (1,'mesero'),(2,'cocinero'),(3,'garrotero'),(4,'lava platos'),(5,'personal de limpieza'),(6,'encargado de cocina'),(7,'encargado de meseros'),(8,'recursos humanos'),(9,'barista'),(10,'encargado de barra');
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `n_cliente` smallint(6) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `apellido_p` varchar(20) NOT NULL,
  `apellido_m` varchar(20) NOT NULL,
  `telefono` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`n_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (0,'Cliente','Desconocido','No',0),(1,'Juan','Chavez','Rodrigo',3000000000),(2,'Maria','Rodriguez','Lopez',3357879546),(3,'Pedro','Gonzalez','Martinez',3357877410),(4,'Ana','D?az','Hernandez',3451789642),(5,'Carlos','Sanchez','Ramirez',3345879612),(6,'Laura','Gomez','Torres',3345879652),(7,'Jorge','Castro','Reyes',3654791210),(8,'Patricia','Flores','Nunez',3664789526),(9,'Miguel','Ruiz','Jimenez',3664789528),(10,'Alejandra','Mendez','Alvarez',366478954);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER check_delete_cliente BEFORE DELETE ON cliente FOR EACH ROW
BEGIN
DECLARE cont INT;
SELECT COUNT(*) INTO cont FROM ordenar WHERE cliente = OLD.n_cliente;
IF cont > 0 THEN
DELETE FROM ordenar WHERE cliente = OLD.n_cliente;
END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `ingredientes`
--

DROP TABLE IF EXISTS `ingredientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredientes` (
  `id_ing` smallint(6) NOT NULL AUTO_INCREMENT,
  `nombre_ing` varchar(20) NOT NULL,
  `cantidad_ing` smallint(6) NOT NULL,
  `ultimo_abastecimiento` datetime DEFAULT NULL,
  PRIMARY KEY (`id_ing`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredientes`
--

LOCK TABLES `ingredientes` WRITE;
/*!40000 ALTER TABLE `ingredientes` DISABLE KEYS */;
INSERT INTO `ingredientes` VALUES (1,'Papas',200,'2024-06-03 09:00:00'),(2,'cafe',30,'0000-00-00 00:00:00'),(3,'agua',20,'0000-00-00 00:00:00'),(4,'tocino',30,'0000-00-00 00:00:00'),(5,'bistec',30,'0000-00-00 00:00:00'),(6,'huevo',50,'0000-00-00 00:00:00'),(7,'sal',10,'0000-00-00 00:00:00'),(8,'aceite',20,'0000-00-00 00:00:00'),(9,'lechuga',5,'0000-00-00 00:00:00'),(10,'jitomate',10,'0000-00-00 00:00:00'),(11,'cebolla',10,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `ingredientes` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER check_delete_ing BEFORE DELETE ON ingredientes FOR EACH ROW
BEGIN
DECLARE cont INT;
SELECT COUNT(*) INTO cont FROM preparar_receta WHERE id_ing = OLD.id_ing;
IF cont > 0 THEN
DELETE FROM preparar_receta WHERE id_ing = OLD.id_ing;
END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `orden_cliente`
--

DROP TABLE IF EXISTS `orden_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orden_cliente` (
  `orden` mediumint(8) unsigned NOT NULL,
  `cliente` smallint(6) NOT NULL,
  PRIMARY KEY (`orden`,`cliente`),
  KEY `cliente` (`cliente`),
  CONSTRAINT `orden_cliente_ibfk_1` FOREIGN KEY (`orden`) REFERENCES `ordenar` (`id`),
  CONSTRAINT `orden_cliente_ibfk_2` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`n_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orden_cliente`
--

LOCK TABLES `orden_cliente` WRITE;
/*!40000 ALTER TABLE `orden_cliente` DISABLE KEYS */;
INSERT INTO `orden_cliente` VALUES (5,1);
/*!40000 ALTER TABLE `orden_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordenar`
--

DROP TABLE IF EXISTS `ordenar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordenar` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `personas` tinyint(3) unsigned DEFAULT NULL,
  `total` mediumint(8) unsigned DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `cliente` smallint(6) DEFAULT NULL,
  `personal` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`),
  KEY `personal` (`personal`),
  KEY `ordenar_ibfk_1` (`cliente`),
  CONSTRAINT `ordenar_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`n_cliente`) ON DELETE SET NULL,
  CONSTRAINT `ordenar_ibfk_2` FOREIGN KEY (`personal`) REFERENCES `personal` (`personal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordenar`
--

LOCK TABLES `ordenar` WRITE;
/*!40000 ALTER TABLE `ordenar` DISABLE KEYS */;
INSERT INTO `ordenar` VALUES (3,'Mesa 1',25,230,'2024-05-26','22:45:33',1,3),(4,'mesa 2',3,195,'2024-05-26','22:45:50',2,3),(5,'mesa 3',1,0,'2024-05-26','22:46:07',3,3),(6,'mesa 4',5,0,'2024-05-26','22:47:05',4,4),(7,'mesa 5',2,0,'2024-05-26','22:47:19',5,4),(8,'mesa 6',2,0,'2024-05-26','22:47:27',6,4),(9,'mesa 7',2,0,'2024-05-26','22:47:34',7,4),(10,'mesa 8',3,0,'2024-05-26','22:47:42',8,4),(11,'mesa 9',3,0,'2024-05-26','22:47:49',9,4),(12,'p/llevar 1',3,155,'2024-05-26','22:48:04',10,4),(18,'Mesa 15',1,75,'2024-06-03','12:36:32',0,1);
/*!40000 ALTER TABLE `ordenar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedir`
--

DROP TABLE IF EXISTS `pedir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedir` (
  `orden` mediumint(8) unsigned NOT NULL,
  `producto` smallint(6) NOT NULL,
  `id_pedir` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_pedir`),
  KEY `producto` (`producto`),
  KEY `orden` (`orden`),
  CONSTRAINT `pedir_ibfk_1` FOREIGN KEY (`orden`) REFERENCES `ordenar` (`id`),
  CONSTRAINT `pedir_ibfk_2` FOREIGN KEY (`producto`) REFERENCES `producto` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedir`
--

LOCK TABLES `pedir` WRITE;
/*!40000 ALTER TABLE `pedir` DISABLE KEYS */;
INSERT INTO `pedir` VALUES (3,1,1),(3,3,3),(4,1,4),(4,2,5),(4,4,6),(12,6,7),(12,8,8),(12,9,9),(12,10,10),(3,1,11),(4,10,12),(18,1,14);
/*!40000 ALTER TABLE `pedir` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER actualizar_total_orden_add AFTER INSERT ON pedir
FOR EACH ROW
BEGIN
DECLARE precio_p SMALLINT UNSIGNED; 
SELECT precio_producto INTO precio_p FROM producto WHERE id_producto = NEW.producto;
UPDATE ordenar SET total = total + precio_p WHERE id = NEW.orden;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER actualizar_total_orden_sub BEFORE DELETE ON pedir
FOR EACH ROW
BEGIN
DECLARE precio_p SMALLINT UNSIGNED;
SELECT precio_producto INTO precio_p FROM producto WHERE id_producto = OLD.producto;
UPDATE ordenar SET total = total - precio_p WHERE id = OLD.orden;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `personal`
--

DROP TABLE IF EXISTS `personal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal` (
  `personal_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `cargo` tinyint(4) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`personal_id`),
  KEY `cargo` (`cargo`),
  CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`cargo`) REFERENCES `cargo` (`pk_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal`
--

LOCK TABLES `personal` WRITE;
/*!40000 ALTER TABLE `personal` DISABLE KEYS */;
INSERT INTO `personal` VALUES (1,'Rodrigo','Rivera',7,'RR10','03ac674216f3e15c761e'),(2,'Alex','Torres',2,'AT2','03ac674216f3e15c761e'),(3,'Diego','Perez',1,'DP3','03ac674216f3e15c761e'),(4,'Shamuel','Liliel',7,'SL4','03ac674216f3e15c761e'),(5,'Noah','Lee',6,'NL5','03ac674216f3e15c761e'),(6,'Braulio','Vargas',3,'BV6','03ac674216f3e15c761e'),(7,'Odilon','Andrew',4,'OA7','03ac674216f3e15c761e'),(8,'Roberto','Batista',5,'RB8','03ac674216f3e15c761e'),(9,'Ramiro','Escalante',8,'RE9','03ac674216f3e15c761e'),(10,'Maria','Rivera',9,'MR10','03ac674216f3e15c761e'),(12,'Asta','Clover',1,'AC200','7daa1d1b763802511451');
/*!40000 ALTER TABLE `personal` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER check_delete_personal BEFORE DELETE ON personal FOR EACH ROW
BEGIN
DECLARE cont INT;
SELECT COUNT(*) INTO cont FROM ordenar WHERE personal = OLD.personal_id;
IF cont > 0 THEN
DELETE FROM ordenar WHERE personal = OLD.personal_id;
END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `preparar_receta`
--

DROP TABLE IF EXISTS `preparar_receta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preparar_receta` (
  `id_producto` smallint(6) NOT NULL,
  `id_ing` smallint(6) NOT NULL,
  PRIMARY KEY (`id_producto`,`id_ing`),
  KEY `id_ing` (`id_ing`),
  CONSTRAINT `preparar_receta_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  CONSTRAINT `preparar_receta_ibfk_2` FOREIGN KEY (`id_ing`) REFERENCES `ingredientes` (`id_ing`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preparar_receta`
--

LOCK TABLES `preparar_receta` WRITE;
/*!40000 ALTER TABLE `preparar_receta` DISABLE KEYS */;
INSERT INTO `preparar_receta` VALUES (1,1),(1,6),(2,4),(2,6),(2,7),(4,2),(4,3),(6,9),(6,10),(6,11),(7,11),(9,4);
/*!40000 ALTER TABLE `preparar_receta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `id_producto` smallint(6) NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(40) NOT NULL,
  `desc_producto` varchar(100) DEFAULT NULL,
  `precio_producto` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id_producto`),
  UNIQUE KEY `nombre_producto` (`nombre_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'Huevo con tortilla','Huevo con tortilla',75),(2,'huevo con tocino','huevo con tocino y sal (revuelto o estrellado)',80),(3,'huevo a la mexicana','huevo con jitomate y cebolla',80),(4,'cafe americano','el clasico cafe americano',20),(5,'cafe con leche','cafe americano con leche',25),(6,'ensalada basica','lechuga, jitomate y cebolla',50),(7,'huevo basico','simplemente 2 piezas de huevo al gusto',50),(8,'agua fresca','vaso de agua de sabor',15),(9,'huevo con papa','huevo al gusto con papas',70),(10,'quesadilla','quesadilla sencilla',20);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER check_delete_producto BEFORE DELETE ON producto
FOR EACH ROW
begin
DECLARE CONTADOR_RECETA INT;
DECLARE CONTADOR_PEDIR INT;
SELECT COUNT(*) INTO CONTADOR_RECETA FROM preparar_receta WHERE id_producto = OLD.id_producto;
SELECT COUNT(*) INTO CONTADOR_PEDIR FROM pedir WHERE producto = OLD.id_producto;
IF CONTADOR_RECETA > 0 THEN
DELETE FROM preparar_receta WHERE id_producto = OLD.id_producto;
END IF;
IF CONTADOR_PEDIR > 0 THEN
DELETE FROM pedir WHERE producto = OLD.id_producto;
END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-03 14:59:21
