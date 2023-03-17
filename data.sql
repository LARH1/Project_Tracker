-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
--
-- Table structure for table `descargas`
--

DROP TABLE IF EXISTS `descargas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `descargas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `proyecto_id` int NOT NULL,
  `tipo` int NOT NULL,
  `file` varchar(100) NOT NULL,
  `estado` int DEFAULT '0',
  `fecha_descarga` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `descargas`
--

LOCK TABLES `descargas` WRITE;
/*!40000 ALTER TABLE `descargas` DISABLE KEYS */;
INSERT INTO `descargas` VALUES (1,1,1,'public/projects/caratulas.zip',1,'2023-03-17 02:49:38'),(3,1,2,'public/projects/caratulas.zip',1,'2022-08-12 08:13:55');
/*!40000 ALTER TABLE `descargas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pagos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ruta` varchar(250) NOT NULL,
  `fecha` datetime NOT NULL,
  `project_id` int NOT NULL,
  `tipo` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
INSERT INTO `pagos` VALUES (1,'public/pagos/946ergBw6J6EBVJyiYWQuvF9feouIoBco1lB1Qb2.png','2022-05-24 21:04:30',1,2),(2,'public/pagos/vwdZUrE5H4cOzmyj1gsFjO4Lo9XgT1Z6HKF6Zddu.png','2022-05-25 14:44:17',1,1),(3,'public/pagos/Kd053JzuE9ooiv5gfj7Zs3zOpZsLXVCXWA0cuFyS.jpg','2022-05-25 14:56:06',1,2),(4,'public/pagos/2Zp4TJC0l99NaB7lf7lIVcGzH0H8sETBS0vSzAuH.jpg','2022-05-25 19:25:11',1,3),(5,'public/pagos/mnzrQvBZuGW9MbyFC3iGUvZXzkHCQLDwgqtFSjh0.png','2022-05-26 19:03:15',1,1),(6,'public/pagos/esHrRY03TUJqmCK9s7tzLL0srMKgRtg3jioZd3pU.jpg','2022-05-26 20:35:48',1,2),(7,'public/pagos/MQOfPRNGkmoGHLwewtkDMgpclqLFnJgB8O1smi7Z.jpg','2022-05-26 22:51:30',1,3),(8,'public/pagos/L8Sg9qZ3QeSRAcngQTSe1ryseXxbymyDxRJNdjBq.png','2022-05-26 10:53:31',1,3),(9,'public/pagos/ASc1RSBO2AyMlnoqMwYftslVV5ksfGc0YOWsdurZ.png','2022-08-11 02:52:48',1,1),(10,'public/pagos/y28Z0heBuQeDTM5sKqWHMImt0w1Ty6MhqxRwz0AL.png','2022-08-11 02:53:27',1,2),(11,'public/pagos/W1Bxxhyjcp1gtPNdX2HCR4VX3rh0TLFq2XeCv7rs.gif','2022-08-11 03:08:07',1,3),(12,'public/pagos/4WcMIa9PzsOZ6edTOi7OYkqXp4S9mHy1YkWbeDh6.png','2022-08-12 07:52:49',1,1),(13,'public/pagos/TA1oWamOYHgmZvdTi0g3M7WAYP9VpjrLUT6BKnbz.jpg','2022-08-12 07:53:02',1,2),(14,'public/pagos/UGgS9C4OSlx31zRjTXi71bN9vVOGREtPz8wNzSaa.gif','2022-08-12 07:53:33',1,3);
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `clave` varchar(15) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `cliente` varchar(75) NOT NULL,
  `inicio` datetime NOT NULL,
  `fecha_entrega` varchar(30) NOT NULL,
  `estado` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'DPS-0022-005','Dimensiones Socioemocionales','Pendiente','2022-05-23 18:25:38','10 Junio 2022',5);
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

-- Dump completed on 2023-03-17 16:50:04
