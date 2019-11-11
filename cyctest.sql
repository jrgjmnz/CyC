-- MySQL dump 10.17  Distrib 10.3.17-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: cyc
-- ------------------------------------------------------
-- Server version	10.3.17-MariaDB

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
-- Table structure for table `boletas`
--

DROP TABLE IF EXISTS `boletas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `boletas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_vencimiento` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alerta_vencimiento` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado_alerta` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boletas`
--

LOCK TABLES `boletas` WRITE;
/*!40000 ALTER TABLE `boletas` DISABLE KEYS */;
INSERT INTO `boletas` VALUES (1,'395','200000','2019-04-20','2019-03-20',NULL,NULL,NULL,NULL),(2,'962','350000','2019-04-01','2019-03-01',NULL,NULL,NULL,NULL),(3,'498','550000','2019-03-07','2019-02-19',NULL,NULL,NULL,NULL),(4,'315','150000','2019-03-10','2019-02-28',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `boletas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargos`
--

DROP TABLE IF EXISTS `cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cargos_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargos`
--

LOCK TABLES `cargos` WRITE;
/*!40000 ALTER TABLE `cargos` DISABLE KEYS */;
INSERT INTO `cargos` VALUES (1,'ENCARGADA SERV.HOTELERÍA CLÍNICA',NULL,NULL,NULL),(2,'JEFE  FARM.HOSPITALIZADOS',NULL,NULL,NULL),(3,'JEFE DE ABASTECIMIENTO Y FINANZAS',NULL,NULL,NULL),(4,'JEFE DE BIENESTAR',NULL,NULL,NULL),(5,'JEFE DE CUENTAS CORRIENTES',NULL,NULL,NULL),(6,'JEFE DE FARMACIA HOSPITALIZADOS',NULL,NULL,NULL),(7,'JEFE DE LABORATORIO',NULL,NULL,NULL),(8,'JEFE DE MEDICINA NUCLEAR',NULL,NULL,NULL),(9,'JEFE DE PREVENCIÓN DE RIESGO',NULL,NULL,NULL),(10,'JEFE DE SECCIÓN INSUMOS CLÍNICOS',NULL,NULL,NULL),(11,'JEFE DE SERVICIO DE HEMODINAMIA',NULL,NULL,NULL),(12,'JEFE DE SERVICIO MÁX FACIAL',NULL,NULL,NULL),(13,'JEFE DE SERVICIO NEUROLOGÍA',NULL,NULL,NULL),(14,'JEFE DEL SERVICIO DE PSIQUIATRIA',NULL,NULL,NULL),(15,'JEFE DEL SERVICIO DEL QUÍMICO FARMACÉUTICO DE ONCOLOGÍA',NULL,NULL,NULL),(16,'JEFE DEL SERVICIO HEMODINAMIA Y ANGIOGRAFIA',NULL,NULL,NULL),(17,'JEFE DEPTO AB Y FINANZAS',NULL,NULL,NULL),(18,'JEFE DEPTO ABASTECIMIENTO',NULL,NULL,NULL),(19,'JEFE DEPTO BIOMÉDICA',NULL,NULL,NULL),(20,'JEFE DEPTO IMAGENEOLOGÍA',NULL,NULL,NULL),(21,'JEFE DEPTO INFORMÁTICA',NULL,NULL,NULL),(22,'JEFE DEPTO INGENIERÍA',NULL,NULL,NULL),(23,'JEFE DEPTO SOME',NULL,NULL,NULL),(24,'JEFE DEPTO SUB DES HUMANO',NULL,NULL,NULL),(25,'JEFE DIV CONTROL EXISTENCIA',NULL,NULL,NULL),(26,'JEFE PREV DE RIESGOS',NULL,NULL,NULL),(27,'JEFE SECCIÓN CIRUGÍA CARDÍACA',NULL,NULL,NULL),(28,'JEFE SECCIÓN CIRUGÍA MÁXILO FACIAL',NULL,NULL,NULL),(29,'JEFE SERV HEMODINAMIA',NULL,NULL,NULL),(30,'JEFE SERV MED NUCLEAR',NULL,NULL,NULL),(31,'JEFE SERV URETERÓSCOPIA',NULL,NULL,NULL),(32,'JEFE SERV. ESTERILIZACIÓN',NULL,NULL,NULL),(33,'JEFE SERV. OFTALMOLOGÍA',NULL,NULL,NULL),(34,'MATRONA JEFE DEL CAPS DE VIÑA',NULL,NULL,NULL),(35,'SUB.DIRECTOR DE ADMINISTRACIÓN Y FINANZAS',NULL,NULL,NULL),(36,'SUB.DIRECTOR DE DESARROLLO HUMANO',NULL,NULL,NULL);
/*!40000 ALTER TABLE `cargos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacto_proveedores`
--

DROP TABLE IF EXISTS `contacto_proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacto_proveedores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion_postal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proveedor_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `contacto_proveedores_email_unique` (`email`),
  KEY `contacto_proveedores_proveedor_id_foreign` (`proveedor_id`),
  CONSTRAINT `contacto_proveedores_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacto_proveedores`
--

LOCK TABLES `contacto_proveedores` WRITE;
/*!40000 ALTER TABLE `contacto_proveedores` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacto_proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contratos`
--

DROP TABLE IF EXISTS `contratos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contratos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(10) unsigned NOT NULL,
  `licitacion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moneda_id` int(10) unsigned NOT NULL,
  `precio` double NOT NULL,
  `cargo_id` int(10) unsigned NOT NULL,
  `nombre_admin_tecnico` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_inicio` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_termino` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_aprobacion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alerta_vencimiento` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `objeto_contrato` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `boleta_id` int(10) unsigned NOT NULL,
  `estado_alerta` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contratos_proveedor_id_foreign` (`proveedor_id`),
  KEY `contratos_cargo_id_foreign` (`cargo_id`),
  KEY `contratos_boleta_id_foreign` (`boleta_id`),
  KEY `contratos_moneda_id_foreign` (`moneda_id`),
  CONSTRAINT `contratos_boleta_id_foreign` FOREIGN KEY (`boleta_id`) REFERENCES `boletas` (`id`),
  CONSTRAINT `contratos_cargo_id_foreign` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`),
  CONSTRAINT `contratos_moneda_id_foreign` FOREIGN KEY (`moneda_id`) REFERENCES `monedas` (`id`),
  CONSTRAINT `contratos_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contratos`
--

LOCK TABLES `contratos` WRITE;
/*!40000 ALTER TABLE `contratos` DISABLE KEYS */;
INSERT INTO `contratos` VALUES (1,1,'ID-00150654',3,500,8,'Claudio Guzmán','2019-01-12','2019-05-20','2017-02-13','2019-04-20','Renovación de equipos',1,NULL,NULL,NULL,NULL),(2,2,'ID-00946854',2,650,10,'Jorge Torres','2019-12-01','2019-04-01','2017-02-25','2019-02-01','Mantención de equipos',2,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `contratos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `convenio_prestacion`
--

DROP TABLE IF EXISTS `convenio_prestacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `convenio_prestacion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `convenio_id` int(10) unsigned NOT NULL,
  `prestacion_id` int(10) unsigned NOT NULL,
  `valor_seleccionado` double DEFAULT NULL,
  `factor` double NOT NULL,
  `valor_total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `convenio_prestacion_convenio_id_foreign` (`convenio_id`),
  KEY `convenio_prestacion_prestacion_id_foreign` (`prestacion_id`),
  CONSTRAINT `convenio_prestacion_convenio_id_foreign` FOREIGN KEY (`convenio_id`) REFERENCES `convenios` (`id`),
  CONSTRAINT `convenio_prestacion_prestacion_id_foreign` FOREIGN KEY (`prestacion_id`) REFERENCES `prestaciones` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `convenio_prestacion`
--

LOCK TABLES `convenio_prestacion` WRITE;
/*!40000 ALTER TABLE `convenio_prestacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `convenio_prestacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `convenios`
--

DROP TABLE IF EXISTS `convenios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `convenios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(10) unsigned NOT NULL,
  `licitacion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objeto_contrato` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_inicio` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_termino` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `boleta_id` int(10) unsigned NOT NULL,
  `alerta_vencimiento` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado_alerta` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `convenios_proveedor_id_foreign` (`proveedor_id`),
  KEY `convenios_boleta_id_foreign` (`boleta_id`),
  CONSTRAINT `convenios_boleta_id_foreign` FOREIGN KEY (`boleta_id`) REFERENCES `boletas` (`id`),
  CONSTRAINT `convenios_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `convenios`
--

LOCK TABLES `convenios` WRITE;
/*!40000 ALTER TABLE `convenios` DISABLE KEYS */;
INSERT INTO `convenios` VALUES (1,1,'ID-00251654','objeto contrato convenio 1','2017-12-12','2019-03-10',3,'2017-02-05',NULL,NULL,NULL,NULL),(2,2,'ID-01046954','objeto contrato convenio 2','2018-10-24','2019-03-14',4,'2017-02-02',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `convenios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evolucion_contratos`
--

DROP TABLE IF EXISTS `evolucion_contratos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evolucion_contratos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contrato_id` int(10) unsigned NOT NULL,
  `texto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evolucion_contratos_contrato_id_foreign` (`contrato_id`),
  KEY `evolucion_contratos_user_id_foreign` (`user_id`),
  CONSTRAINT `evolucion_contratos_contrato_id_foreign` FOREIGN KEY (`contrato_id`) REFERENCES `contratos` (`id`),
  CONSTRAINT `evolucion_contratos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evolucion_contratos`
--

LOCK TABLES `evolucion_contratos` WRITE;
/*!40000 ALTER TABLE `evolucion_contratos` DISABLE KEYS */;
/*!40000 ALTER TABLE `evolucion_contratos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evolucion_convenios`
--

DROP TABLE IF EXISTS `evolucion_convenios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evolucion_convenios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `convenio_id` int(10) unsigned NOT NULL,
  `texto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evolucion_convenios_convenio_id_foreign` (`convenio_id`),
  KEY `evolucion_convenios_user_id_foreign` (`user_id`),
  CONSTRAINT `evolucion_convenios_convenio_id_foreign` FOREIGN KEY (`convenio_id`) REFERENCES `convenios` (`id`),
  CONSTRAINT `evolucion_convenios_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evolucion_convenios`
--

LOCK TABLES `evolucion_convenios` WRITE;
/*!40000 ALTER TABLE `evolucion_convenios` DISABLE KEYS */;
/*!40000 ALTER TABLE `evolucion_convenios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hito_contratos`
--

DROP TABLE IF EXISTS `hito_contratos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hito_contratos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_alerta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_hito` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contrato_id` int(10) unsigned NOT NULL,
  `estado_alerta` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hito_contratos_contrato_id_foreign` (`contrato_id`),
  CONSTRAINT `hito_contratos_contrato_id_foreign` FOREIGN KEY (`contrato_id`) REFERENCES `contratos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hito_contratos`
--

LOCK TABLES `hito_contratos` WRITE;
/*!40000 ALTER TABLE `hito_contratos` DISABLE KEYS */;
/*!40000 ALTER TABLE `hito_contratos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hito_convenios`
--

DROP TABLE IF EXISTS `hito_convenios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hito_convenios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_alerta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_hito` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `convenio_id` int(10) unsigned NOT NULL,
  `estado_alerta` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hito_convenios_convenio_id_foreign` (`convenio_id`),
  CONSTRAINT `hito_convenios_convenio_id_foreign` FOREIGN KEY (`convenio_id`) REFERENCES `convenios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hito_convenios`
--

LOCK TABLES `hito_convenios` WRITE;
/*!40000 ALTER TABLE `hito_convenios` DISABLE KEYS */;
/*!40000 ALTER TABLE `hito_convenios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `memos`
--

DROP TABLE IF EXISTS `memos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `memos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contrato_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `memos_contrato_id_foreign` (`contrato_id`),
  CONSTRAINT `memos_contrato_id_foreign` FOREIGN KEY (`contrato_id`) REFERENCES `contratos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memos`
--

LOCK TABLES `memos` WRITE;
/*!40000 ALTER TABLE `memos` DISABLE KEYS */;
/*!40000 ALTER TABLE `memos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_100000_create_password_resets_table',1),(2,'2019_01_21_175034_create_moneda_table',1),(3,'2019_01_21_192440_create_cargo_table',1),(4,'2019_01_22_173706_create_proveedor_table',1),(5,'2019_01_22_175823_create_prestacion_table',1),(6,'2019_01_23_122605_create_contacto_proveedor_table',1),(7,'2019_01_23_130938_create_boleta_table',1),(8,'2019_01_24_000000_create_users_table',1),(9,'2019_01_25_125003_create_contrato_table',1),(10,'2019_01_25_125703_create_convenio_table',1),(11,'2019_01_25_131607_create_memo_table',1),(12,'2019_01_25_132109_create_hito_convenio_table',1),(13,'2019_01_25_174518_create_hito_contrato_table',1),(14,'2019_01_25_183420_create_permission_tables',1),(15,'2019_01_27_123607_create_evolucion_contrato_table',1),(16,'2019_01_27_123638_create_evolucion_convenio_table',1),(17,'2019_02_13_190935_create_convenio_prestacion_table',1),(18,'2019_10_10_180459_create_orden_compra_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\User',1),(1,'App\\User',4),(2,'App\\User',2),(2,'App\\User',5),(2,'App\\User',6);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monedas`
--

DROP TABLE IF EXISTS `monedas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monedas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `factor_conversion` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `monedas_codigo_unique` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monedas`
--

LOCK TABLES `monedas` WRITE;
/*!40000 ALTER TABLE `monedas` DISABLE KEYS */;
INSERT INTO `monedas` VALUES (1,'UTM','Unidad Tributaria Mensual',4853,NULL,NULL,NULL),(2,'UF','Unidad de Fomento',27551.56,NULL,NULL,NULL),(3,'USD','Dólar',672.14,NULL,NULL,NULL),(4,'EUR','Euro',759.91,NULL,NULL,NULL),(5,'CLP','Pesos Chilenos',1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `monedas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orden_compra`
--

DROP TABLE IF EXISTS `orden_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orden_compra` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contrato_id` int(10) unsigned NOT NULL,
  `numero_licitacion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_orden_compra` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_envio` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` double(10,2) NOT NULL,
  `estado` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orden_compra_contrato_id_foreign` (`contrato_id`),
  CONSTRAINT `orden_compra_contrato_id_foreign` FOREIGN KEY (`contrato_id`) REFERENCES `contratos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orden_compra`
--

LOCK TABLES `orden_compra` WRITE;
/*!40000 ALTER TABLE `orden_compra` DISABLE KEYS */;
INSERT INTO `orden_compra` VALUES (1,1,'1','123','2019-10-11',150.00,'Pendiente','2019-10-10 21:30:49','2019-10-10 21:30:49');
/*!40000 ALTER TABLE `orden_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'ver reportes','web',NULL,NULL),(2,'ver seguimiento','web',NULL,NULL),(3,'ver mantenedores','web',NULL,NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestaciones`
--

DROP TABLE IF EXISTS `prestaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prestaciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor_1` double DEFAULT NULL,
  `valor_2` double DEFAULT NULL,
  `valor_3` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `prestaciones_codigo_unique` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestaciones`
--

LOCK TABLES `prestaciones` WRITE;
/*!40000 ALTER TABLE `prestaciones` DISABLE KEYS */;
INSERT INTO `prestaciones` VALUES (1,'0101001','Consulta médica electiva',9330,9990,11690,NULL,NULL,NULL),(2,'0101201','Consulta Médica de Especialidad en Dermatología',12840,16690,20540,NULL,NULL,NULL),(3,'0101202','Consulta Médica de Especialidad en Geriatría',12840,16690,20540,NULL,NULL,NULL),(4,'0101203','Prestación sin Fonasa',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `prestaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rut` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razon_social` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ubicacion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `proveedores_rut_unique` (`rut`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (1,'29.532-7','Medi-Tech International Inc.','Miami, Estados Unidos',NULL,NULL,NULL),(2,'34.482.594-9','Schneider Electric de Colombia S.A.S','Bogotá, Colombia',NULL,NULL,NULL);
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(1,2),(2,1),(3,1);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','web',NULL,NULL),(2,'AdminTecnico','web',NULL,NULL),(3,'Adquisiciones','web',NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo_id` int(10) unsigned NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_cargo_id_foreign` (`cargo_id`),
  CONSTRAINT `users_cargo_id_foreign` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrador',' ','admin@gmail.com',1,'$2y$10$Ob5L0paQIaX46W95oIg7Xe74HWx4zX3isSSutXlrDUCmHI85lyVSm','0CxJWBnVJblJT7bBOy0ANtkZBOSzeelYgMG432r73kyGnBhnHXjbwG5RnSoW',NULL,NULL,NULL),(2,'Administrador técnico','','atecnico@gmail.com',1,'$2y$10$xmSRUadGWy43tJEX2oc7yOe0iZlr0fqMzjXsr2BfTssv7H7Hu5fBS',NULL,NULL,NULL,NULL),(3,'Adquisiciones','','adquisiciones@gmail.com',1,'$2y$10$J6PlNS9NvvlU4PPBA55IcuMcv8x6u0VptIAKUaqumLAMI1biALPWu',NULL,NULL,'2019-10-11 14:22:47',NULL),(4,'Jrg','Jmnz','jrg@gmail.com',4,'$2y$10$A5pjjrfTO5pBuH545rk.yuhlVmc3I.8LOpH8I.w4vBFXIqhq8WcPu','IaqOqBKJcfkJ7L3PKwhITtzAkI9nGj8VYJ66T6LcWpqD2mKxRcZLQzz7WABt','2019-10-10 22:08:10','2019-10-10 22:08:10',NULL),(5,'Jefe','uno','medicinanuclear@gmail.com',8,'$2y$10$WYwX/Dp4tJIlqvfsVy8Ep.m09U9bVNBMCzgpLCapMuYpTY7t259zi',NULL,'2019-10-11 14:32:58','2019-10-11 14:32:58',NULL),(6,'jefe2','med. nuc.','jefe2@jefe.cl',8,'$2y$10$pmbsgX6RFohVVnQZj2eicuhISxtZx10cOxDFQCKnD51eMMBtdQiUm','VEkqVkWauZr7FUp7BNX7GphDjraWtcZ0rsvotF4Bg6tYDSiDScZpDfRFe5G1','2019-10-11 15:19:24','2019-10-11 15:19:24',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-11 10:55:10
