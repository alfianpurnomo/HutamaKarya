-- MySQL dump 10.13  Distrib 8.0.16, for macos10.14 (x86_64)
--
-- Host: localhost    Database: hutama_karya
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `auth_function_group`
--

DROP TABLE IF EXISTS `auth_function_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `auth_function_group` (
  `id_auth_function_group` int NOT NULL AUTO_INCREMENT,
  `id_auth_group` int DEFAULT NULL,
  `id_auth_menu_function` int DEFAULT NULL,
  PRIMARY KEY (`id_auth_function_group`)
) ENGINE=InnoDB AUTO_INCREMENT=156;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_function_group`
--

LOCK TABLES `auth_function_group` WRITE;
/*!40000 ALTER TABLE `auth_function_group` DISABLE KEYS */;
INSERT INTO `auth_function_group` VALUES (8,9,12),(9,9,13),(13,8,11),(14,8,12),(15,8,13),(16,8,14),(99,5,39),(100,5,40),(101,5,41),(102,5,42),(103,5,30),(104,5,31),(105,5,32),(106,5,33),(107,5,34),(108,5,35),(109,5,36),(110,5,37),(111,5,38),(112,5,11),(113,5,13),(114,5,19),(115,5,15),(116,5,16),(117,5,17),(118,5,18),(119,5,25),(120,5,20),(121,5,21),(122,5,22),(123,5,23),(124,5,24),(125,1,11),(126,1,12),(127,1,13),(128,1,43),(129,1,44),(130,1,45),(131,1,46),(132,1,47),(133,1,48),(134,1,49),(135,1,50),(149,3,54),(150,3,55),(151,3,56),(152,2,54),(153,2,55),(154,2,56),(155,2,57);
/*!40000 ALTER TABLE `auth_function_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_group`
--

DROP TABLE IF EXISTS `auth_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `auth_group` (
  `id_auth_group` int NOT NULL AUTO_INCREMENT,
  `auth_group` varchar(255) DEFAULT NULL,
  `is_superadmin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_auth_group`)
) ENGINE=InnoDB AUTO_INCREMENT=10;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_group`
--

LOCK TABLES `auth_group` WRITE;
/*!40000 ALTER TABLE `auth_group` DISABLE KEYS */;
INSERT INTO `auth_group` VALUES (1,'Superadmin',1),(2,'HC SPJ',0),(3,'Employee',0),(4,'Team Lead',0),(5,'Admin',0),(6,'Administrator1',0),(8,'Project Admin',0),(9,'Project Manager',0);
/*!40000 ALTER TABLE `auth_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_menu`
--

DROP TABLE IF EXISTS `auth_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `auth_menu` (
  `id_auth_menu` int NOT NULL AUTO_INCREMENT,
  `parent_auth_menu` int NOT NULL DEFAULT '0',
  `menu` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `position` tinyint DEFAULT '1',
  `class_icon` varchar(50) NOT NULL DEFAULT 'none',
  `is_superadmin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_auth_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=130;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_menu`
--

LOCK TABLES `auth_menu` WRITE;
/*!40000 ALTER TABLE `auth_menu` DISABLE KEYS */;
INSERT INTO `auth_menu` VALUES (1,0,'Settings','#',2,'fa fa-wrench',0),(2,1,'Admin User','admin',21,'none',0),(3,83,'Back End Menu (Module)','menu',12,'none',1),(4,1,'Admin User Group & Authorization','group',22,'none',0),(36,1,'Logs Record (Admin)','logs',24,'none',0),(83,0,'Menu','#',2,'fa fa-sitemap',1),(101,0,'Module','#',25,'none',0),(113,101,'Projects','project',26,'none',0),(114,101,'Tasks','tasks',27,'none',0),(115,0,'test','test',28,'none',0),(116,101,'Activity','activity',29,'none',0),(117,101,'View Tasks','tasks/view_tasks',30,'none',0),(118,1,'Site','site',31,'none',0),(119,101,'Jobs','jobs_title',32,'none',0),(120,101,'Report','#',33,'none',0),(121,120,'Projects','report_projects',34,'none',0),(124,126,'Division','division',3,'none',0),(125,126,'Department','department',36,'none',0),(126,0,'Modul HK','#',37,'none',0),(127,126,'SPJ Online','spj',38,'none',0),(128,126,'LPD','lpd',39,'none',0),(129,0,'Employee','employee',40,'none',0);
/*!40000 ALTER TABLE `auth_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_menu_function`
--

DROP TABLE IF EXISTS `auth_menu_function`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `auth_menu_function` (
  `id_auth_menu_function` int NOT NULL AUTO_INCREMENT,
  `menu_id` int DEFAULT NULL,
  `function_name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `function_path` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_auth_menu_function`)
) ENGINE=InnoDB AUTO_INCREMENT=58;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_menu_function`
--

LOCK TABLES `auth_menu_function` WRITE;
/*!40000 ALTER TABLE `auth_menu_function` DISABLE KEYS */;
INSERT INTO `auth_menu_function` VALUES (7,123,'Add','add'),(8,123,'Delete','delete'),(9,123,'List','index'),(10,123,'Edit','edit'),(11,113,'Add','add'),(12,113,'Edit','edit'),(13,113,'Delete','delete'),(14,113,'Detail','detail'),(15,116,'Add','add'),(16,116,'Edit','edit'),(17,116,'Delete','delete'),(18,116,'List Data','index'),(19,113,'List Data','index'),(20,119,'Add','add'),(21,119,'Edit','edit'),(22,119,'List Data','index'),(23,119,'Delete','delete'),(24,121,'View','index'),(25,117,'View','index'),(30,4,'Add','add'),(31,4,'Edit','edit'),(32,4,'Delete','delete'),(33,4,'List Data','index'),(34,4,'Authorization','authorization'),(35,3,'Add','add'),(36,3,'Edit','edit'),(37,3,'List Data','index'),(38,3,'Delete','delete'),(39,2,'Add','add'),(40,2,'Edit','edit'),(41,2,'Delete','delete'),(42,2,'List Data','index'),(43,124,'List Data','index'),(44,124,'Add','add'),(45,124,'Edit','edit'),(46,124,'Delete','delete'),(47,125,'List Data','index'),(48,125,'Add','add'),(49,125,'Edit','edit'),(50,125,'Delete','delete'),(54,127,'Validation SPJ','validation'),(55,127,'List SPJ','index'),(56,127,'Buat SPJ','create'),(57,127,'Print SPJ','print_document');
/*!40000 ALTER TABLE `auth_menu_function` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_menu_group`
--

DROP TABLE IF EXISTS `auth_menu_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `auth_menu_group` (
  `id_auth_menu_group` bigint NOT NULL AUTO_INCREMENT,
  `id_auth_group` int NOT NULL DEFAULT '0',
  `id_auth_menu` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_auth_menu_group`)
) ENGINE=InnoDB AUTO_INCREMENT=1274;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_menu_group`
--

LOCK TABLES `auth_menu_group` WRITE;
/*!40000 ALTER TABLE `auth_menu_group` DISABLE KEYS */;
INSERT INTO `auth_menu_group` VALUES (998,6,1),(999,6,2),(1000,6,4),(1001,6,36),(1002,6,101),(1003,6,113),(1004,6,114),(1029,7,1),(1030,7,2),(1031,7,4),(1032,7,101),(1033,7,113),(1034,7,114),(1045,4,101),(1046,4,114),(1047,4,117),(1108,9,1),(1109,9,2),(1110,9,4),(1111,9,36),(1112,9,101),(1113,9,113),(1114,9,114),(1115,9,116),(1116,9,117),(1134,8,1),(1135,8,2),(1136,8,4),(1137,8,36),(1138,8,101),(1139,8,113),(1140,8,114),(1141,8,116),(1142,8,117),(1191,5,1),(1192,5,2),(1193,5,4),(1194,5,36),(1195,5,118),(1196,5,83),(1197,5,3),(1198,5,101),(1199,5,113),(1200,5,114),(1201,5,116),(1202,5,117),(1203,5,119),(1204,5,120),(1205,5,121),(1206,5,115),(1211,1,1),(1212,1,2),(1213,1,4),(1214,1,36),(1215,1,118),(1216,1,83),(1217,1,3),(1218,1,101),(1219,1,113),(1220,1,114),(1221,1,116),(1222,1,117),(1223,1,119),(1224,1,120),(1225,1,121),(1226,1,115),(1227,1,126),(1228,1,124),(1229,1,125),(1230,1,127),(1231,1,128),(1232,1,129),(1263,3,1),(1264,3,2),(1265,3,36),(1266,3,3),(1267,3,101),(1268,3,126),(1269,3,127),(1270,3,128),(1271,2,126),(1272,2,127),(1273,2,128);
/*!40000 ALTER TABLE `auth_menu_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `detail_projects`
--

DROP TABLE IF EXISTS `detail_projects`;
/*!50001 DROP VIEW IF EXISTS `detail_projects`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `detail_projects` AS SELECT 
 1 AS `projectid`,
 1 AS `total_employee`,
 1 AS `total_hours`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `detail_travel_bill`
--

DROP TABLE IF EXISTS `detail_travel_bill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `detail_travel_bill` (
  `id_detail_travel_bill` int NOT NULL AUTO_INCREMENT,
  `id_travel_bill` int DEFAULT NULL,
  `detail_activity` text,
  `file_attachment` text,
  `check_number` varchar(100) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT NULL,
  `final_amount` double DEFAULT NULL,
  PRIMARY KEY (`id_detail_travel_bill`)
) ENGINE=InnoDB;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_travel_bill`
--

LOCK TABLES `detail_travel_bill` WRITE;
/*!40000 ALTER TABLE `detail_travel_bill` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_travel_bill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `frekuensi_perjalanan`
--

DROP TABLE IF EXISTS `frekuensi_perjalanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `frekuensi_perjalanan` (
  `id_frekuensi_perjalanan` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `id_group_golongan` varchar(45) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  PRIMARY KEY (`id_frekuensi_perjalanan`)
) ENGINE=InnoDB AUTO_INCREMENT=23;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frekuensi_perjalanan`
--

LOCK TABLES `frekuensi_perjalanan` WRITE;
/*!40000 ALTER TABLE `frekuensi_perjalanan` DISABLE KEYS */;
INSERT INTO `frekuensi_perjalanan` VALUES (2,'Kriteria 1','1',270000),(3,'Kriteria 2','1',220000),(4,'Kriteria 3','1',170000),(5,'Kriteria 1','2',240000),(6,'Kriteria 2','2',200000),(7,'Kriteria 3','2',160000),(8,'Kriteria 1','3',210000),(9,'Kriteria 2','3',170000),(10,'Kriteria 3','3',130000),(11,'Kriteria 1','4',130000),(12,'Kriteria 2','4',110000),(13,'Kriteria 3','4',80000),(14,'Kriteria 1','5',100000),(15,'Kriteria 2','5',80000),(16,'Kriteria 3','5',60000),(17,'Kriteria 1','6',110000),(18,'Kriteria 2','6',90000),(19,'Kriteria 3','6',70000),(20,'Kriteria 1','7',170000),(21,'Kriteria 2','7',140000),(22,'Kriteria 3','7',110000);
/*!40000 ALTER TABLE `frekuensi_perjalanan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs_title`
--

DROP TABLE IF EXISTS `jobs_title`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `jobs_title` (
  `id_jobs_title` int NOT NULL AUTO_INCREMENT,
  `jobs_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_jobs_title`)
) ENGINE=InnoDB AUTO_INCREMENT=96;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs_title`
--

LOCK TABLES `jobs_title` WRITE;
/*!40000 ALTER TABLE `jobs_title` DISABLE KEYS */;
INSERT INTO `jobs_title` VALUES (1,'Sekretaris',0),(2,'Receptionist ',0),(3,'Investasi ',0),(4,'QHSE ',0),(5,'Ahli Muda (Bidang Quality)',0),(6,'QHSE',0),(7,'Staff QHSE',0),(8,'Staf Adkon ',0),(9,'Legal',0),(10,'Administrasi Kontrak ',0),(11,'Manajer Senior',0),(12,'Staf Teknik (sipil)',0),(13,'Staf Teknik ',0),(14,'Staf Teknik (mechanical) ',0),(15,'Staf Teknik (electrical) ',0),(16,'Manajer Teknik ',0),(17,'Staf Procurement ',0),(18,'Manajer Procurement',0),(19,'Cost Control ',0),(20,'Manajer Bagian Construction ',0),(21,'Staf Construction',0),(22,'Staf PBK ',0),(23,'Staf PBK',0),(24,'Pj. Manajer Senior Keuangan ',0),(25,'Staf Akuntansi ',0),(26,'Staf Keuangan',0),(27,'Staf Pajak ',0),(28,'Pajak ',0),(29,'Pj. Asisten Manajer Human Capital ',0),(30,'HC&GA',0),(31,'Staf Teknik (Project Control)',0),(32,'Supervisor ',0),(33,'Staf Personalia ',0),(34,'Manajer Teknik Proyek Muda',0),(35,'Kapro Muda',0),(36,'Ahli Pratama bidang HSE ',0),(37,'Manajer Keuangan Proyek Madya',0),(38,'SOM ',0),(39,'Deputy Kapro',0),(40,'Staf Project Control',0),(41,'Leader Mechanical Electrical',0),(42,'Manajer QC',0),(43,'Pelaksana ',0),(44,'Manajer Teknik Proyek ',0),(45,'SAM',0),(46,'Manajer Teknik Proyek (Project Control Manajer) ',0),(47,'Quality Control',0),(48,'Manajer Proyek ',0),(49,'Manajer Quality Control ',0),(50,'Pelaksana (Supervisor) ',0),(51,'SAM ',0),(52,'Kapro Madya',0),(53,'Manajer Teknik Proyek Muda (Production and Procurement Manager)',0),(54,'Manajer Teknik Proyek Madya (Assistant Project Engineering Manager) ',0),(55,'Manajer Teknik Proyek Madya (Cost Control Manager)',0),(56,'Project Control Manager',0),(57,'Staf Bagian Logistik ',0),(58,'Staf Teknik ME',0),(59,'Staf Teknik Proyek',0),(60,'Schedule Control ',0),(61,'Pelaksana',0),(62,'Proyek ',0),(63,'Manajer Keuangan Proyek Muda',0),(64,'Staf Project Control ',0),(65,'Scheduler',0),(66,'Superintendent (Setara Pelaksana Senior)',0),(67,'Manajer Operasi Proyek Madya',0),(68,'Superintendent (Setara Pelaksana)',0),(69,'SEM Proyek PLTM Harjosari ',0),(70,'Staf Peralatan ',0),(71,'Staf Akuntansi Keuangan ',0),(72,'Project Control Manajer ',0),(73,'Manajer Procurement merangkap Kepala Proyek ',0),(74,'Kepala Divisi',0),(75,'Staf Construntion',0),(76,'Executive Vice President (EVP)',0),(77,'Pro Hire EPC',0),(78,'Manajer QHSE',0),(79,'Vice President enginnering',0),(80,'Pj. Asisten Manajer bagian Engineering',0),(81,'Vice President Procurement',0),(82,'Vice President Construction',0),(83,'Vice President PBK',0),(84,'Pj. Asisten Manajer bagian PBK',0),(85,'Vice President Keuangan',0),(86,'HC&Umum',0),(87,'Coct Control (tugas asli di Project control)',0),(88,'HC',0),(89,'Project Manager',0),(90,'Staf Keuangan Proyek',0),(91,'Manajer Keuangan Proyek',0),(92,'Pelaksana Proyek',0),(93,'SAM Proyek Muda',0),(94,'Manajer Operasi Proyek',0),(95,'Project Manager Muda',0);
/*!40000 ALTER TABLE `jobs_title` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `logs` (
  `id_logs` bigint NOT NULL AUTO_INCREMENT,
  `id_user` bigint NOT NULL DEFAULT '0',
  `id_group` bigint NOT NULL DEFAULT '0',
  `ip_address` varchar(100) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `desc` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_logs`)
) ENGINE=InnoDB;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mapping_project_employee`
--

DROP TABLE IF EXISTS `mapping_project_employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `mapping_project_employee` (
  `id_mapping_project_employee` int NOT NULL AUTO_INCREMENT,
  `projectid` int DEFAULT NULL,
  `employee_role` int DEFAULT NULL,
  `employeeid` varchar(45) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_mapping_project_employee`)
) ENGINE=InnoDB AUTO_INCREMENT=195;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mapping_project_employee`
--

LOCK TABLES `mapping_project_employee` WRITE;
/*!40000 ALTER TABLE `mapping_project_employee` DISABLE KEYS */;
INSERT INTO `mapping_project_employee` VALUES (6,1,2,'8e33e57b-9bd5-1229-9cb8-b4d5bd9e2608','2019-08-12','2019-08-21','2019-08-13 07:16:38'),(7,2,2,'ba33e57b-9bd5-11e9-9cb8-b4d5bd9e2609','2019-08-13','2019-08-16','2019-08-13 07:34:15'),(13,5,1,'a9bded50-c3c5-11e9-a7c0-0050568b6323','2019-08-21','2019-08-21','2019-08-21 04:03:11'),(20,7,2,'a9bded50-c3c5-11e9-a7c0-0050568b6323','2019-08-21','2019-08-21','2019-08-21 04:33:37'),(29,6,2,'a9bded50-c3c5-11e9-a7c0-0050568b6323','2019-08-21','2019-08-21','2019-08-21 06:36:00'),(30,6,1,'ba33e57b-9bd5-11e9-9cb8-b4d5bd9e2609','2019-08-21','2019-08-21','2019-08-21 06:36:00'),(34,9,1,'b8a6cd8e-bfda-11e9-bd25-8b9548a87243','2019-08-21','2019-08-21','2019-08-21 06:39:56'),(38,10,2,'8e33e57b-9bd5-1229-9cb8-b4d5bd9e2608','2019-08-20','2019-08-28','2019-08-21 08:48:56'),(39,10,2,'a9bded50-c3c5-11e9-a7c0-0050568b6323','2019-08-21','2019-08-23','2019-08-21 08:48:56'),(40,11,1,'a9bded50-c3c5-11e9-a7c0-0050568b6323','0000-00-00','0000-00-00','2019-08-21 09:37:52'),(41,12,2,'9c4a15ca-c3dd-11e9-a7c0-0050568b6323','2019-08-21','2019-08-21','2019-08-21 09:59:41'),(43,8,2,'1f4d0a80-c3e2-11e9-a7c0-0050568b6323','2019-08-21','2019-08-21','2019-08-21 10:03:06'),(53,13,1,'b8a6cd8e-bfda-11e9-bd25-8b9548a87243','2019-08-22','2019-08-22','2019-08-22 06:59:43'),(54,13,2,'9c4a15ca-c3dd-11e9-a7c0-0050568b6323','2019-08-22','2019-08-22','2019-08-22 06:59:43'),(55,13,2,'a9bded50-c3c5-11e9-a7c0-0050568b6323','2019-08-22','2019-08-22','2019-08-22 06:59:43'),(56,15,2,'9c4a15ca-c3dd-11e9-a7c0-0050568b6323','0000-00-00','0000-00-00','2019-08-22 07:06:41'),(60,14,1,'acb1fdf6-c4a9-11e9-a7c0-0050568b6323','2019-08-22','2019-08-29','2019-08-22 07:14:29'),(61,14,2,'bc744998-c4a9-11e9-a7c0-0050568b6323','2019-08-22','2019-08-29','2019-08-22 07:14:29'),(62,14,2,'cbe933ff-c4a9-11e9-a7c0-0050568b6323','2019-08-22','2019-08-29','2019-08-22 07:14:29'),(76,16,2,'a9bded50-c3c5-11e9-a7c0-0050568b6323','2019-08-27','2019-08-27','2019-08-28 06:23:28'),(77,16,2,'9c4a15ca-c3dd-11e9-a7c0-0050568b6323','2019-08-19','2019-08-30','2019-08-28 06:23:28'),(80,17,1,'a9bded50-c3c5-11e9-a7c0-0050568b6323','2019-08-10','2019-08-29','2019-08-30 07:05:04'),(101,20,1,'ba33e57b-9bd5-11e9-9cb8-b4d5bd9e2609','1970-01-01','9999-12-31','2019-09-09 02:44:53'),(102,20,1,'8e33e57b-9bd5-1229-9cb8-b4d5bd9e2608','1970-01-01','9999-12-31','2019-09-09 02:44:53'),(103,20,1,'b8a6cd8e-bfda-11e9-bd25-8b9548a87243','1970-01-01','9999-12-31','2019-09-09 02:44:53'),(104,20,1,'a9bded50-c3c5-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-09 02:44:53'),(105,20,1,'9c4a15ca-c3dd-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-09 02:44:53'),(106,20,1,'1f4d0a80-c3e2-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-09 02:44:53'),(107,20,1,'8fa18a2a-c4a9-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-09 02:44:53'),(108,20,1,'acb1fdf6-c4a9-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-09 02:44:53'),(109,20,1,'bc744998-c4a9-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-09 02:44:53'),(110,20,1,'cbe933ff-c4a9-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-09 02:44:53'),(111,NULL,NULL,NULL,NULL,NULL,'2019-09-13 03:16:11'),(112,NULL,NULL,NULL,NULL,NULL,'2019-09-13 03:16:11'),(113,NULL,NULL,NULL,NULL,NULL,'2019-09-13 03:16:11'),(114,NULL,NULL,NULL,NULL,NULL,'2019-09-13 03:16:11'),(115,NULL,NULL,NULL,NULL,NULL,'2019-09-13 03:16:11'),(116,21,2,'d25388c5-d2ce-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:08:04'),(117,21,2,'f0afe70e-d2ce-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:08:04'),(118,21,2,'cae8c281-d2b8-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:08:04'),(119,21,2,'20d9e2bb-c7ec-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:08:04'),(120,21,2,'8e33e57b-9bd5-1229-9cb8-b4d5bd9e2608','1970-01-01','9999-12-31','2019-09-20 07:08:04'),(121,21,2,'ba33e57b-9bd5-11e9-9cb8-b4d5bd9e2609','1970-01-01','9999-12-31','2019-09-20 07:08:04'),(122,21,2,'108f18f0-d2cf-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:08:04'),(123,21,2,'2bf30f13-d2cf-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:08:04'),(124,21,2,'4d81f58d-d2cf-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:08:04'),(125,21,2,'5a2af7ae-d46d-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:08:04'),(126,21,2,'996f0692-d46d-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:08:04'),(127,21,2,'4e4abba4-d46e-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:08:04'),(128,21,2,'93727943-d46e-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:08:04'),(129,21,2,'e9a69076-d46e-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:08:04'),(130,21,2,'1bfb23ad-d46f-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:08:04'),(131,21,2,'3cd5c765-d46f-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:08:04'),(132,21,2,'55a45579-d46f-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:08:04'),(133,21,2,'7af79f74-d46f-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:08:04'),(134,21,2,'9e36b566-d46f-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:08:04'),(135,21,2,'2e4d1173-d472-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:08:04'),(136,1,2,'d25388c5-d2ce-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:16:44'),(137,1,2,'f0afe70e-d2ce-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:16:44'),(138,1,2,'cae8c281-d2b8-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:16:44'),(139,1,2,'20d9e2bb-c7ec-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:16:44'),(140,1,2,'8e33e57b-9bd5-1229-9cb8-b4d5bd9e2608','1970-01-01','9999-12-31','2019-09-20 07:16:44'),(141,1,2,'ba33e57b-9bd5-11e9-9cb8-b4d5bd9e2609','1970-01-01','9999-12-31','2019-09-20 07:16:44'),(142,1,2,'108f18f0-d2cf-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:16:44'),(143,1,2,'2bf30f13-d2cf-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:16:44'),(144,1,2,'4d81f58d-d2cf-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:16:44'),(145,1,2,'5a2af7ae-d46d-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:16:44'),(146,1,2,'996f0692-d46d-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:16:44'),(147,1,2,'4e4abba4-d46e-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:16:44'),(148,1,2,'93727943-d46e-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:16:44'),(149,1,2,'e9a69076-d46e-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:16:44'),(150,1,2,'1bfb23ad-d46f-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:16:44'),(151,1,2,'3cd5c765-d46f-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:16:44'),(152,1,2,'55a45579-d46f-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:16:44'),(153,1,2,'7af79f74-d46f-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:16:44'),(154,1,2,'9e36b566-d46f-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:16:44'),(155,1,2,'2e4d1173-d472-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:16:44'),(159,3,2,'d25388c5-d2ce-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:24:07'),(160,3,2,'f0afe70e-d2ce-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:24:07'),(161,3,2,'cae8c281-d2b8-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:24:07'),(162,3,2,'20d9e2bb-c7ec-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:24:07'),(163,3,2,'8e33e57b-9bd5-1229-9cb8-b4d5bd9e2608','1970-01-01','9999-12-31','2019-09-20 07:24:07'),(164,3,2,'ba33e57b-9bd5-11e9-9cb8-b4d5bd9e2609','1970-01-01','9999-12-31','2019-09-20 07:24:07'),(165,3,2,'108f18f0-d2cf-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:24:07'),(166,3,2,'2bf30f13-d2cf-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:24:07'),(167,3,2,'4d81f58d-d2cf-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:24:07'),(168,3,2,'5a2af7ae-d46d-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:24:07'),(169,3,2,'996f0692-d46d-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:24:07'),(170,3,2,'4e4abba4-d46e-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:24:07'),(171,3,2,'93727943-d46e-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:24:07'),(172,3,2,'e9a69076-d46e-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:24:07'),(173,3,2,'1bfb23ad-d46f-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:24:07'),(174,3,2,'3cd5c765-d46f-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:24:07'),(175,3,2,'55a45579-d46f-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:24:07'),(176,3,2,'7af79f74-d46f-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:24:07'),(177,3,2,'9e36b566-d46f-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:24:07'),(178,3,2,'2e4d1173-d472-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-09-20 07:24:07'),(180,4,1,'f0afe70e-d2ce-11e9-a7c0-0050568b6323','2019-09-20','2019-09-30','2019-09-25 06:15:18'),(181,1,2,'2e4d1173-d472-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-10-07 07:31:22'),(182,3,2,'2e4d1173-d472-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-10-07 07:31:22'),(183,1,2,'2e4d1173-d472-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-10-07 07:31:29'),(184,3,2,'2e4d1173-d472-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-10-07 07:31:29'),(185,1,2,'2e4d1173-d472-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-10-07 07:37:09'),(186,3,2,'2e4d1173-d472-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-10-07 07:37:09'),(187,1,2,'2e4d1173-d472-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-10-07 07:37:17'),(188,3,2,'2e4d1173-d472-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-10-07 07:37:17'),(189,1,2,'9e36b566-d46f-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-10-10 13:05:03'),(190,3,2,'9e36b566-d46f-11e9-a7c0-0050568b6323','1970-01-01','9999-12-31','2019-10-10 13:05:03'),(191,1,2,'98690510-5e1c-11ea-a74f-929740789a9a','1970-01-01','9999-12-31','2020-03-30 02:59:25'),(192,3,2,'98690510-5e1c-11ea-a74f-929740789a9a','1970-01-01','9999-12-31','2020-03-30 02:59:25'),(193,1,2,'98690510-5e1c-11ea-a74f-929740789a9a','1970-01-01','9999-12-31','2020-03-30 02:59:41'),(194,3,2,'98690510-5e1c-11ea-a74f-929740789a9a','1970-01-01','9999-12-31','2020-03-30 02:59:41');
/*!40000 ALTER TABLE `mapping_project_employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_activity`
--

DROP TABLE IF EXISTS `master_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `master_activity` (
  `id_activity` int NOT NULL AUTO_INCREMENT,
  `activity_name` varchar(100) DEFAULT NULL,
  `activity_description` text,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_activity`)
) ENGINE=InnoDB AUTO_INCREMENT=13;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_activity`
--

LOCK TABLES `master_activity` WRITE;
/*!40000 ALTER TABLE `master_activity` DISABLE KEYS */;
INSERT INTO `master_activity` VALUES (1,'Survey Proyek Baru','Survey Proyek Baru',0),(2,'Audit Proyek','Audit Proyek',0),(3,'Cut Off Tahunan','Cut Off Tahunan',0),(4,'Site Visit','Site Visit',0),(5,'FAT Luar Negeri','FAT Luar Negeri',0),(6,'Rakor','Rakor',0),(7,'Meeting Luar Negeri','Meeting Luar Negeri',0),(8,'Hold Point','Hold Point',0),(9,'Menghadiri Pernikahan','Menghadiri Pernikahan',0),(10,'Melayat','Melayat',0),(11,'Anwizing','Anwizing',0),(12,'Lain - lain','Lain - lain',0);
/*!40000 ALTER TABLE `master_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_department`
--

DROP TABLE IF EXISTS `master_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `master_department` (
  `id_master_department` int NOT NULL AUTO_INCREMENT,
  `id_division` varchar(45) DEFAULT NULL,
  `department_name` varchar(45) DEFAULT NULL,
  `head_of_department` varchar(45) DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT '0',
  `id_auth_user` int DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_master_department`)
) ENGINE=InnoDB AUTO_INCREMENT=2;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_department`
--

LOCK TABLES `master_department` WRITE;
/*!40000 ALTER TABLE `master_department` DISABLE KEYS */;
INSERT INTO `master_department` VALUES (1,'1','Administrasi Keuangan','982ad9de-5e1c-11ea-a74f-929740789a9a',0,133,'2019-10-06 23:31:38',NULL);
/*!40000 ALTER TABLE `master_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_destination`
--

DROP TABLE IF EXISTS `master_destination`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `master_destination` (
  `id_master_destination` int NOT NULL AUTO_INCREMENT,
  `province` varchar(45) DEFAULT NULL,
  `sub_regional` varchar(45) DEFAULT NULL,
  `regional` varchar(45) DEFAULT NULL,
  `daily_money` float DEFAULT NULL,
  `diklat_money` float DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_master_destination`)
) ENGINE=InnoDB AUTO_INCREMENT=624;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_destination`
--

LOCK TABLES `master_destination` WRITE;
/*!40000 ALTER TABLE `master_destination` DISABLE KEYS */;
INSERT INTO `master_destination` VALUES (1,'ACEH','Kabupaten Aceh Selatan','Dalam Negri',220000,70000,0),(2,'ACEH','Kabupaten Aceh Tenggara','Dalam Negri',220000,70000,0),(3,'ACEH','Kabupaten Aceh Timur','Dalam Negri',220000,70000,0),(4,'ACEH','Kabupaten Aceh Tengah','Dalam Negri',220000,70000,0),(5,'ACEH','Kabupaten Aceh Barat','Dalam Negri',220000,70000,0),(6,'ACEH','Kabupaten Aceh Besar','Dalam Negri',220000,70000,0),(7,'ACEH','Kabupaten Pidie','Dalam Negri',220000,70000,0),(8,'ACEH','Kabupaten Aceh Utara','Dalam Negri',220000,70000,0),(9,'ACEH','Kabupaten Simeulue','Dalam Negri',220000,70000,0),(10,'ACEH','Kabupaten Aceh Singkil','Dalam Negri',220000,70000,0),(11,'ACEH','Kabupaten Bireuen','Dalam Negri',220000,70000,0),(12,'ACEH','Kabupaten Aceh Barat Daya','Dalam Negri',220000,70000,0),(13,'ACEH','Kabupaten Gayo Lues','Dalam Negri',220000,70000,0),(14,'ACEH','Kabupaten Aceh Jaya','Dalam Negri',220000,70000,0),(15,'ACEH','Kabupaten Nagan Raya','Dalam Negri',220000,70000,0),(16,'ACEH','Kabupaten Aceh Tamiang','Dalam Negri',220000,70000,0),(17,'ACEH','Kabupaten Bener Meriah','Dalam Negri',220000,70000,0),(18,'ACEH','Kabupaten Pidie Jaya','Dalam Negri',220000,70000,0),(19,'ACEH','Kota Banda Aceh','Dalam Negri',220000,70000,0),(20,'ACEH','Kota Sabang','Dalam Negri',220000,70000,0),(21,'ACEH','Kota Lhokseumawe','Dalam Negri',220000,70000,0),(22,'ACEH','Kota Langsa','Dalam Negri',220000,70000,0),(23,'ACEH','Kota Subulussalam','Dalam Negri',220000,70000,0),(24,'SUMATERA UTARA','Kabupaten Tapanuli Tengah','Dalam Negri',220000,70000,0),(25,'SUMATERA UTARA','Kabupaten Tapanuli Utara','Dalam Negri',220000,70000,0),(26,'SUMATERA UTARA','Kabupaten Tapanuli Selatan','Dalam Negri',220000,70000,0),(27,'SUMATERA UTARA','Kabupaten Nias','Dalam Negri',220000,70000,0),(28,'SUMATERA UTARA','Kabupaten Langkat','Dalam Negri',220000,70000,0),(29,'SUMATERA UTARA','Kabupaten Karo','Dalam Negri',220000,70000,0),(30,'SUMATERA UTARA','Kabupaten Deli Serdang','Dalam Negri',220000,70000,0),(31,'SUMATERA UTARA','Kabupaten Simalungun','Dalam Negri',220000,70000,0),(32,'SUMATERA UTARA','Kabupaten Asahan','Dalam Negri',220000,70000,0),(33,'SUMATERA UTARA','Kabupaten Labuhanbatu','Dalam Negri',220000,70000,0),(34,'SUMATERA UTARA','Kabupaten Dairi','Dalam Negri',220000,70000,0),(35,'SUMATERA UTARA','Kabupaten Toba Samosir','Dalam Negri',220000,70000,0),(36,'SUMATERA UTARA','Kabupaten Mandailing Natal','Dalam Negri',220000,70000,0),(37,'SUMATERA UTARA','Kabupaten Nias Selatan','Dalam Negri',220000,70000,0),(38,'SUMATERA UTARA','Kabupaten Pakpak Bharat','Dalam Negri',220000,70000,0),(39,'SUMATERA UTARA','Kabupaten Humbang Hasundutan','Dalam Negri',220000,70000,0),(40,'SUMATERA UTARA','Kabupaten Samosir','Dalam Negri',220000,70000,0),(41,'SUMATERA UTARA','Kabupaten Serdang Bedagai','Dalam Negri',220000,70000,0),(42,'SUMATERA UTARA','Kabupaten Batubara','Dalam Negri',220000,70000,0),(43,'SUMATERA UTARA','Kabupaten Padang Lawas Utara','Dalam Negri',220000,70000,0),(44,'SUMATERA UTARA','Kabupaten Padang Lawas','Dalam Negri',220000,70000,0),(45,'SUMATERA UTARA','Kabupaten Labuhanbatu Selatan','Dalam Negri',220000,70000,0),(46,'SUMATERA UTARA','Kabupaten Labuhanbatu Utara','Dalam Negri',220000,70000,0),(47,'SUMATERA UTARA','Kabupaten Nias Utara','Dalam Negri',220000,70000,0),(48,'SUMATERA UTARA','Kabupaten Nias Barat','Dalam Negri',220000,70000,0),(49,'SUMATERA UTARA','Kota Medan','Dalam Negri',220000,70000,0),(50,'SUMATERA UTARA','Kota Pematang Siantar','Dalam Negri',220000,70000,0),(51,'SUMATERA UTARA','Kota Sibolga','Dalam Negri',220000,70000,0),(52,'SUMATERA UTARA','Kota Tanjung Balai','Dalam Negri',220000,70000,0),(53,'SUMATERA UTARA','Kota Binjai','Dalam Negri',220000,70000,0),(54,'SUMATERA UTARA','Kota Tebing Tinggi','Dalam Negri',220000,70000,0),(55,'SUMATERA UTARA','Kota Padangsidempuan','Dalam Negri',220000,70000,0),(56,'SUMATERA UTARA','Kota Gunungsitoli','Dalam Negri',220000,70000,0),(57,'RIAU','Kabupaten Kampar','Dalam Negri',220000,70000,0),(58,'RIAU','Kabupaten Indragiri Hulu','Dalam Negri',220000,70000,0),(59,'RIAU','Kabupaten Bengkalis','Dalam Negri',220000,70000,0),(60,'RIAU','Kabupaten Indragiri Hilir','Dalam Negri',220000,70000,0),(61,'RIAU','Kabupaten Pelalawan','Dalam Negri',220000,70000,0),(62,'RIAU','Kabupaten Rokan Hulu','Dalam Negri',220000,70000,0),(63,'RIAU','Kabupaten Rokan Hilir','Dalam Negri',220000,70000,0),(64,'RIAU','Kabupaten Siak','Dalam Negri',220000,70000,0),(65,'RIAU','Kabupaten Kuantan Singingi','Dalam Negri',220000,70000,0),(66,'RIAU','Kabupaten Kepulauan Meranti','Dalam Negri',220000,70000,0),(67,'RIAU','Kota Pekanbaru','Dalam Negri',220000,70000,0),(68,'RIAU','Kota Dumai','Dalam Negri',220000,70000,0),(69,'KEPULAUAN RIAU','Kabupaten Bintan','Dalam Negri',220000,70000,0),(70,'KEPULAUAN RIAU','Kabupaten Karimun','Dalam Negri',220000,70000,0),(71,'KEPULAUAN RIAU','Kabupaten Natuna','Dalam Negri',220000,70000,0),(72,'KEPULAUAN RIAU','Kabupaten Lingga','Dalam Negri',220000,70000,0),(73,'KEPULAUAN RIAU','Kabupaten Kepulauan Anambas','Dalam Negri',220000,70000,0),(74,'KEPULAUAN RIAU','Kota Batam','Dalam Negri',220000,70000,0),(75,'KEPULAUAN RIAU','Kota Tanjung Pinang','Dalam Negri',220000,70000,0),(76,'JAMBI','Kabupaten Kerinci','Dalam Negri',220000,70000,0),(77,'JAMBI','Kabupaten Merangin','Dalam Negri',220000,70000,0),(78,'JAMBI','Kabupaten Sarolangun','Dalam Negri',220000,70000,0),(79,'JAMBI','Kabupaten Batanghari','Dalam Negri',220000,70000,0),(80,'JAMBI','Kabupaten Muaro Jambi','Dalam Negri',220000,70000,0),(81,'JAMBI','Kabupaten Tanjung Jabung Barat','Dalam Negri',220000,70000,0),(82,'JAMBI','Kabupaten Tanjung Jabung Timur','Dalam Negri',220000,70000,0),(83,'JAMBI','Kabupaten Bungo','Dalam Negri',220000,70000,0),(84,'JAMBI','Kabupaten Tebo','Dalam Negri',220000,70000,0),(85,'JAMBI','Kota Jambi','Dalam Negri',220000,70000,0),(86,'JAMBI','Kota Sungai Penuh','Dalam Negri',220000,70000,0),(87,'SUMATERA BARAT','Kabupaten Pesisir Selatan','Dalam Negri',230000,70000,0),(88,'SUMATERA BARAT','Kabupaten Solok','Dalam Negri',230000,70000,0),(89,'SUMATERA BARAT','Kabupaten Sijunjung','Dalam Negri',230000,70000,0),(90,'SUMATERA BARAT','Kabupaten Tanah Datar','Dalam Negri',230000,70000,0),(91,'SUMATERA BARAT','Kabupaten Padang Pariaman','Dalam Negri',230000,70000,0),(92,'SUMATERA BARAT','Kabupaten Agam','Dalam Negri',230000,70000,0),(93,'SUMATERA BARAT','Kabupaten Lima Puluh Kota','Dalam Negri',230000,70000,0),(94,'SUMATERA BARAT','Kabupaten Pasaman','Dalam Negri',230000,70000,0),(95,'SUMATERA BARAT','Kabupaten Kepulauan Mentawai','Dalam Negri',230000,70000,0),(96,'SUMATERA BARAT','Kabupaten Dharmasraya','Dalam Negri',230000,70000,0),(97,'SUMATERA BARAT','Kabupaten Solok Selatan','Dalam Negri',230000,70000,0),(98,'SUMATERA BARAT','Kabupaten Pasaman Barat','Dalam Negri',230000,70000,0),(99,'SUMATERA BARAT','Kota Padang','Dalam Negri',230000,70000,0),(100,'SUMATERA BARAT','Kota Solok','Dalam Negri',230000,70000,0),(101,'SUMATERA BARAT','Kota Sawahlunto','Dalam Negri',230000,70000,0),(102,'SUMATERA BARAT','Kota Padangpanjang','Dalam Negri',230000,70000,0),(103,'SUMATERA BARAT','Kota Bukittinggi','Dalam Negri',230000,70000,0),(104,'SUMATERA BARAT','Kota Payakumbuh','Dalam Negri',230000,70000,0),(105,'SUMATERA BARAT','Kota Pariaman','Dalam Negri',230000,70000,0),(106,'SUMATERA SELATAN','Kabupaten Ogan Komering Ulu','Dalam Negri',230000,70000,0),(107,'SUMATERA SELATAN','Kabupaten Ogan Komering Ilir','Dalam Negri',230000,70000,0),(108,'SUMATERA SELATAN','Kabupaten Muara Enim','Dalam Negri',230000,70000,0),(109,'SUMATERA SELATAN','Kabupaten Lahat','Dalam Negri',230000,70000,0),(110,'SUMATERA SELATAN','Kabupaten Musi Rawas','Dalam Negri',230000,70000,0),(111,'SUMATERA SELATAN','Kabupaten Musi Banyuasin','Dalam Negri',230000,70000,0),(112,'SUMATERA SELATAN','Kabupaten Banyuasin','Dalam Negri',230000,70000,0),(113,'SUMATERA SELATAN','Kabupaten Ogan Komering Ulu Timur','Dalam Negri',230000,70000,0),(114,'SUMATERA SELATAN','Kabupaten Ogan Komering Ulu Selatan','Dalam Negri',230000,70000,0),(115,'SUMATERA SELATAN','Kabupaten Ogan Ilir','Dalam Negri',230000,70000,0),(116,'SUMATERA SELATAN','Kabupaten Empat Lawang','Dalam Negri',230000,70000,0),(117,'SUMATERA SELATAN','Kabupaten Penukal Abab Lematang Ilir','Dalam Negri',230000,70000,0),(118,'SUMATERA SELATAN','Kabupaten Musi Rawas Utara','Dalam Negri',230000,70000,0),(119,'SUMATERA SELATAN','Kota Palembang','Dalam Negri',230000,70000,0),(120,'SUMATERA SELATAN','Kota Pagar Alam','Dalam Negri',230000,70000,0),(121,'SUMATERA SELATAN','Kota Lubuk Linggau','Dalam Negri',230000,70000,0),(122,'SUMATERA SELATAN','Kota Prabumulih','Dalam Negri',230000,70000,0),(123,'LAMPUNG','Kabupaten Lampung Selatan','Dalam Negri',250000,80000,0),(124,'LAMPUNG','Kabupaten Lampung Tengah','Dalam Negri',250000,80000,0),(125,'LAMPUNG','Kabupaten Lampung Utara','Dalam Negri',250000,80000,0),(126,'LAMPUNG','Kabupaten Lampung Barat','Dalam Negri',250000,80000,0),(127,'LAMPUNG','Kabupaten Tulang Bawang','Dalam Negri',250000,80000,0),(128,'LAMPUNG','Kabupaten Tanggamus','Dalam Negri',250000,80000,0),(129,'LAMPUNG','Kabupaten Lampung Timur','Dalam Negri',250000,80000,0),(130,'LAMPUNG','Kabupaten Way Kanan','Dalam Negri',250000,80000,0),(131,'LAMPUNG','Kabupaten Pesawaran','Dalam Negri',250000,80000,0),(132,'LAMPUNG','Kabupaten Pringsewu','Dalam Negri',250000,80000,0),(133,'LAMPUNG','Kabupaten Mesuji','Dalam Negri',250000,80000,0),(134,'LAMPUNG','Kabupaten Tulang Bawang Barat','Dalam Negri',250000,80000,0),(135,'LAMPUNG','Kabupaten Pesisir Barat','Dalam Negri',250000,80000,0),(136,'LAMPUNG','Kota Bandar Lampung','Dalam Negri',250000,80000,0),(137,'LAMPUNG','Kota Metro','Dalam Negri',250000,80000,0),(138,'BENGKULU','Kabupaten Bengkulu Selatan','Dalam Negri',250000,80000,0),(139,'BENGKULU','Kabupaten Rejang Lebong','Dalam Negri',250000,80000,0),(140,'BENGKULU','Kabupaten Bengkulu Utara','Dalam Negri',250000,80000,0),(141,'BENGKULU','Kabupaten Kaur','Dalam Negri',250000,80000,0),(142,'BENGKULU','Kabupaten Seluma','Dalam Negri',250000,80000,0),(143,'BENGKULU','Kabupaten Mukomuko','Dalam Negri',250000,80000,0),(144,'BENGKULU','Kabupaten Lebong','Dalam Negri',250000,80000,0),(145,'BENGKULU','Kabupaten Kepahiang','Dalam Negri',250000,80000,0),(146,'BENGKULU','Kabupaten Bengkulu Tengah','Dalam Negri',250000,80000,0),(147,'BENGKULU','Kota Bengkulu','Dalam Negri',250000,80000,0),(148,'BANGKA BELITUNG','Kabupaten Bangka','Dalam Negri',250000,70000,0),(149,'BANGKA BELITUNG','Kabupaten Belitung','Dalam Negri',250000,70000,0),(150,'BANGKA BELITUNG','Kabupaten Bangka Selatan','Dalam Negri',250000,70000,0),(151,'BANGKA BELITUNG','Kabupaten Bangka Tengah','Dalam Negri',250000,70000,0),(152,'BANGKA BELITUNG','Kabupaten Bangka Barat','Dalam Negri',250000,70000,0),(153,'BANGKA BELITUNG','Kabupaten Belitung Timur','Dalam Negri',250000,70000,0),(154,'BANGKA BELITUNG','Kota Pangkal Pinang','Dalam Negri',250000,70000,0),(155,'BANTEN','Kabupaten Pandegelang','Dalam Negri',250000,80000,0),(156,'BANTEN','Kabupaten Lebak','Dalam Negri',250000,80000,0),(157,'BANTEN','Kabupaten Tangerang','Dalam Negri',250000,80000,0),(158,'BANTEN','Kabupaten Serang','Dalam Negri',250000,80000,0),(159,'BANTEN','Kota Tangerang','Dalam Negri',250000,80000,0),(160,'BANTEN','Kota Cilegon','Dalam Negri',250000,80000,0),(161,'BANTEN','Kota Serang','Dalam Negri',250000,80000,0),(162,'BANTEN','Kota Tangerang Selatan','Dalam Negri',250000,80000,0),(163,'JAWA BARAT','Kabupaten Bogor','Dalam Negri',260000,80000,0),(164,'JAWA BARAT','Kabupaten Sukabumi','Dalam Negri',260000,80000,0),(165,'JAWA BARAT','Kabupaten Cianjur','Dalam Negri',260000,80000,0),(166,'JAWA BARAT','Kabupaten Bandung','Dalam Negri',260000,80000,0),(167,'JAWA BARAT','Kabupaten Garut','Dalam Negri',260000,80000,0),(168,'JAWA BARAT','Kabupaten Tasikmalaya','Dalam Negri',260000,80000,0),(169,'JAWA BARAT','Kabupaten Ciamis','Dalam Negri',260000,80000,0),(170,'JAWA BARAT','Kabupaten Kuningan','Dalam Negri',260000,80000,0),(171,'JAWA BARAT','Kabupaten Cirebon','Dalam Negri',260000,80000,0),(172,'JAWA BARAT','Kabupaten Majalengka','Dalam Negri',260000,80000,0),(173,'JAWA BARAT','Kabupaten Sumedang','Dalam Negri',260000,80000,0),(174,'JAWA BARAT','Kabupaten Indramayu','Dalam Negri',260000,80000,0),(175,'JAWA BARAT','Kabupaten Subang','Dalam Negri',260000,80000,0),(176,'JAWA BARAT','Kabupaten Purwakarta','Dalam Negri',260000,80000,0),(177,'JAWA BARAT','Kabupaten Karawang','Dalam Negri',260000,80000,0),(178,'JAWA BARAT','Kabupaten Bekasi','Dalam Negri',260000,80000,0),(179,'JAWA BARAT','Kabupaten Bandung Barat','Dalam Negri',260000,80000,0),(180,'JAWA BARAT','Kabupaten Pangandaran','Dalam Negri',260000,80000,0),(181,'JAWA BARAT','Kota Bogor','Dalam Negri',260000,80000,0),(182,'JAWA BARAT','Kota Sukabumi','Dalam Negri',260000,80000,0),(183,'JAWA BARAT','Kota Bandung','Dalam Negri',260000,80000,0),(184,'JAWA BARAT','Kota Cirebon','Dalam Negri',260000,80000,0),(185,'JAWA BARAT','Kota Bekasi','Dalam Negri',260000,80000,0),(186,'JAWA BARAT','Kota Depok','Dalam Negri',260000,80000,0),(187,'JAWA BARAT','Kota Cimahi','Dalam Negri',260000,80000,0),(188,'JAWA BARAT','Kota Tasikmalaya','Dalam Negri',260000,80000,0),(189,'JAWA BARAT','Kota Banjar','Dalam Negri',260000,80000,0),(190,'DKI JAKARTA','Kabupaten Administrasi Kepulauan Seribu','Dalam Negri',300000,100000,0),(191,'DKI JAKARTA','Kota Administrasi Jakarta Pusat','Dalam Negri',250000,100000,0),(192,'DKI JAKARTA','Kota Administrasi Jakarta Utara','Dalam Negri',250000,100000,0),(193,'DKI JAKARTA','Kota Administrasi Jakarta Barat','Dalam Negri',250000,100000,0),(194,'DKI JAKARTA','Kota Administrasi Jakarta Selatan','Dalam Negri',250000,100000,0),(195,'DKI JAKARTA','Kota Administrasi Jakarta Timur','Dalam Negri',250000,100000,0),(196,'Jawa Tengah','Cilacap','Dalam Negri',220000,70000,0),(197,'Jawa Tengah','Kabupaten Banyumas','Dalam Negri',220000,70000,0),(198,'Jawa Tengah','Purwokerto','Dalam Negri',220000,70000,0),(199,'Jawa Tengah','Purbalingga','Dalam Negri',220000,70000,0),(200,'Jawa Tengah','Banjarnegara','Dalam Negri',220000,70000,0),(201,'Jawa Tengah','Kebumen','Dalam Negri',220000,70000,0),(202,'Jawa Tengah','Purworejo','Dalam Negri',220000,70000,0),(203,'Jawa Tengah','Wonosobo','Dalam Negri',220000,70000,0),(204,'Jawa Tengah','Kabupaten Magelang','Dalam Negri',220000,70000,0),(205,'Jawa Tengah','Mungkid','Dalam Negri',220000,70000,0),(206,'Jawa Tengah','Boyolali','Dalam Negri',220000,70000,0),(207,'Jawa Tengah','Klaten','Dalam Negri',220000,70000,0),(208,'Jawa Tengah','Sukoharjo','Dalam Negri',220000,70000,0),(209,'Jawa Tengah','Wonogiri','Dalam Negri',220000,70000,0),(210,'Jawa Tengah','Karanganyar','Dalam Negri',220000,70000,0),(211,'Jawa Tengah','Sragen','Dalam Negri',220000,70000,0),(212,'Jawa Tengah','Kabupaten Grobogan','Dalam Negri',220000,70000,0),(213,'Jawa Tengah','Purwodadi','Dalam Negri',220000,70000,0),(214,'Jawa Tengah','Blora','Dalam Negri',220000,70000,0),(215,'Jawa Tengah','Rembang','Dalam Negri',220000,70000,0),(216,'Jawa Tengah','Pati','Dalam Negri',220000,70000,0),(217,'Jawa Tengah','Kudus','Dalam Negri',220000,70000,0),(218,'Jawa Tengah','Jepara','Dalam Negri',220000,70000,0),(219,'Jawa Tengah','Demak','Dalam Negri',220000,70000,0),(220,'Jawa Tengah','Ungaran','Dalam Negri',220000,70000,0),(221,'Jawa Tengah','Temanggung','Dalam Negri',220000,70000,0),(222,'Jawa Tengah','Kendal','Dalam Negri',220000,70000,0),(223,'Jawa Tengah','Batang','Dalam Negri',220000,70000,0),(224,'Jawa Tengah','Kabupaten Pekalongan','Dalam Negri',220000,70000,0),(225,'Jawa Tengah','Kajen','Dalam Negri',220000,70000,0),(226,'Jawa Tengah','Pemalang','Dalam Negri',220000,70000,0),(227,'Jawa Tengah','Kabupaten Tegal','Dalam Negri',220000,70000,0),(228,'Jawa Tengah','Slawi','Dalam Negri',220000,70000,0),(229,'Jawa Tengah','Brebes','Dalam Negri',220000,70000,0),(230,'Jawa Tengah','Kota Magelang','Dalam Negri',220000,70000,0),(231,'Jawa Tengah','Kota Surakarta','Dalam Negri',220000,70000,0),(232,'Jawa Tengah','Kota Salatiga','Dalam Negri',220000,70000,0),(233,'Jawa Tengah','Kota Semarang','Dalam Negri',220000,70000,0),(234,'Jawa Tengah','Kota Pekalongan','Dalam Negri',220000,70000,0),(235,'Jawa Tengah','Kota Tegal','Dalam Negri',220000,70000,0),(236,'DI Yogyakarta','Bantul','Dalam Negri',250000,80000,0),(237,'DI Yogyakarta','Gunungkidul','Dalam Negri',250000,80000,0),(238,'DI Yogyakarta','Kabupaten Kulon Progo','Dalam Negri',250000,80000,0),(239,'DI Yogyakarta','Kabupaten Sleman','Dalam Negri',250000,80000,0),(240,'DI Yogyakarta','Kota Yogyakarta','Dalam Negri',250000,80000,0),(241,'DI Yogyakarta','Wonosari','Dalam Negri',250000,80000,0),(242,'DI Yogyakarta','Wates','Dalam Negri',250000,80000,0),(243,'Jawa Timur','Pacitan','Dalam Negri',250000,70000,0),(244,'Jawa Timur','Ponorogo','Dalam Negri',250000,70000,0),(245,'Jawa Timur','Trenggalek','Dalam Negri',250000,70000,0),(246,'Jawa Timur','Tulungagung','Dalam Negri',250000,70000,0),(247,'Jawa Timur','Kabupaten Blitar','Dalam Negri',250000,70000,0),(248,'Jawa Timur','Kanigoro','Dalam Negri',250000,70000,0),(249,'Jawa Timur','Kabupaten Kediri','Dalam Negri',250000,70000,0),(250,'Jawa Timur','Ngasem','Dalam Negri',250000,70000,0),(251,'Jawa Timur','Kabupaten Malang','Dalam Negri',250000,70000,0),(252,'Jawa Timur','Kepanjen','Dalam Negri',250000,70000,0),(253,'Jawa Timur','Lumajang','Dalam Negri',250000,70000,0),(254,'Jawa Timur','Jember','Dalam Negri',250000,70000,0),(255,'Jawa Timur','Banyuwangi','Dalam Negri',250000,70000,0),(256,'Jawa Timur','Bondowoso','Dalam Negri',250000,70000,0),(257,'Jawa Timur','Situbondo','Dalam Negri',250000,70000,0),(258,'Jawa Timur','Kabupaten Probolinggo','Dalam Negri',250000,70000,0),(259,'Jawa Timur','Kraksaan','Dalam Negri',250000,70000,0),(260,'Jawa Timur','Kabupaten Pasuruan','Dalam Negri',250000,70000,0),(261,'Jawa Timur','Bangil','Dalam Negri',250000,70000,0),(262,'Jawa Timur','Sidoarjo','Dalam Negri',250000,70000,0),(263,'Jawa Timur','Kabupaten Mojokerto','Dalam Negri',250000,70000,0),(264,'Jawa Timur','Mojosari','Dalam Negri',250000,70000,0),(265,'Jawa Timur','Jombang','Dalam Negri',250000,70000,0),(266,'Jawa Timur','Nganjuk','Dalam Negri',250000,70000,0),(267,'Jawa Timur','Kabupaten Madiun','Dalam Negri',250000,70000,0),(268,'Jawa Timur','Caruban','Dalam Negri',250000,70000,0),(269,'Jawa Timur','Magetan','Dalam Negri',250000,70000,0),(270,'Jawa Timur','Ngawi','Dalam Negri',250000,70000,0),(271,'Jawa Timur','Bojonegoro','Dalam Negri',250000,70000,0),(272,'Jawa Timur','Tuban','Dalam Negri',250000,70000,0),(273,'Jawa Timur','Lamongan','Dalam Negri',250000,70000,0),(274,'Jawa Timur','Gresik','Dalam Negri',250000,70000,0),(275,'Jawa Timur','Bangkalan','Dalam Negri',250000,70000,0),(276,'Jawa Timur','Sampang','Dalam Negri',250000,70000,0),(277,'Jawa Timur','Pamekasan','Dalam Negri',250000,70000,0),(278,'Jawa Timur','Sumenep','Dalam Negri',250000,70000,0),(279,'Jawa Timur','Kota Blitar','Dalam Negri',250000,70000,0),(280,'Jawa Timur','Kota Malang','Dalam Negri',250000,70000,0),(281,'Jawa Timur','Kota Probolinggo','Dalam Negri',250000,70000,0),(282,'Jawa Timur','Kota Pasuruan','Dalam Negri',250000,70000,0),(283,'Jawa Timur','Kota Mojokerto','Dalam Negri',250000,70000,0),(284,'Jawa Timur','Kota Madiun','Dalam Negri',250000,70000,0),(285,'Jawa Timur','Kota Surabaya','Dalam Negri',250000,70000,0),(286,'Jawa Timur','Kota Batu','Dalam Negri',250000,70000,0),(287,'Bali','Bangli','Dalam Negri',290000,80000,0),(288,'Bali','Singaraja','Dalam Negri',290000,80000,0),(289,'Bali','Gianyar','Dalam Negri',290000,80000,0),(290,'Bali','Jembrana','Dalam Negri',290000,80000,0),(291,'Bali','Karangasem','Dalam Negri',290000,80000,0),(292,'Bali','Semarapura','Dalam Negri',290000,80000,0),(293,'Bali','Tabanan','Dalam Negri',290000,80000,0),(294,'Bali','Denpasar','Dalam Negri',290000,80000,0),(295,'Nusa Tenggara Barat','Kabupaten Lombok Barat','Dalam Negri',260000,80000,0),(296,'Nusa Tenggara Barat','Kabupaten Lombok Barat','Dalam Negri',260000,80000,0),(297,'Nusa Tenggara Barat','Kabupaten Lombok Tengah','Dalam Negri',260000,80000,0),(298,'Nusa Tenggara Barat','Kabupaten Lombok Timur','Dalam Negri',260000,80000,0),(299,'Nusa Tenggara Barat','Kabupaten Sumbawa','Dalam Negri',260000,80000,0),(300,'Nusa Tenggara Barat','Kabupaten Dompu','Dalam Negri',260000,80000,0),(301,'Nusa Tenggara Barat','Kabupaten Bima','Dalam Negri',260000,80000,0),(302,'Nusa Tenggara Barat','Kabupaten Sumbawa Barat','Dalam Negri',260000,80000,0),(303,'Nusa Tenggara Barat','Kabupaten Lombok Utara','Dalam Negri',260000,80000,0),(304,'Nusa Tenggara Barat','Kota Mataram','Dalam Negri',260000,80000,0),(305,'Nusa Tenggara Barat','Kota Bima','Dalam Negri',260000,80000,0),(306,'Nusa Tenggara Timur','Kabupaten Kupang','Dalam Negri',260000,80000,0),(307,'Nusa Tenggara Timur','Kabupaten Timor Tengah Selatan','Dalam Negri',260000,80000,0),(308,'Nusa Tenggara Timur','Kabupaten Timor Tengah Utara','Dalam Negri',260000,80000,0),(309,'Nusa Tenggara Timur','Kabupaten Belu','Dalam Negri',260000,80000,0),(310,'Nusa Tenggara Timur','Kabupaten Alor','Dalam Negri',260000,80000,0),(311,'Nusa Tenggara Timur','Kabupaten Flores Timur','Dalam Negri',260000,80000,0),(312,'Nusa Tenggara Timur','Kabupaten Sikka','Dalam Negri',260000,80000,0),(313,'Nusa Tenggara Timur','Kabupaten Ende','Dalam Negri',260000,80000,0),(314,'Nusa Tenggara Timur','Kabupaten Ngada','Dalam Negri',260000,80000,0),(315,'Nusa Tenggara Timur','Kabupaten Manggarai','Dalam Negri',260000,80000,0),(316,'Nusa Tenggara Timur','Kabupaten Sumba Timur','Dalam Negri',260000,80000,0),(317,'Nusa Tenggara Timur','Kabupaten Sumba Barat','Dalam Negri',260000,80000,0),(318,'Nusa Tenggara Timur','Kabupaten Lembata','Dalam Negri',260000,80000,0),(319,'Nusa Tenggara Timur','Kabupaten Rote Ndao','Dalam Negri',260000,80000,0),(320,'Nusa Tenggara Timur','Kabupaten Manggarai Barat','Dalam Negri',260000,80000,0),(321,'Nusa Tenggara Timur','Kabupaten Nagekeo','Dalam Negri',260000,80000,0),(322,'Nusa Tenggara Timur','Kabupaten Sumba Tengah','Dalam Negri',260000,80000,0),(323,'Nusa Tenggara Timur','Kabupaten Sumba Barat Daya','Dalam Negri',260000,80000,0),(324,'Nusa Tenggara Timur','Kabupaten Manggarai Timur','Dalam Negri',260000,80000,0),(325,'Nusa Tenggara Timur','Kabupaten Sabu Raijua','Dalam Negri',260000,80000,0),(326,'Nusa Tenggara Timur','Kabupaten Malaka','Dalam Negri',260000,80000,0),(327,'Nusa Tenggara Timur','Kota Kupang','Dalam Negri',260000,80000,0),(328,'Kalimantan Barat','Kabupaten Sambas','Dalam Negeri',230000,70000,0),(329,'Kalimantan Barat','Kabupaten Mempawah','Dalam Negeri',230000,70000,0),(330,'Kalimantan Barat','Kabupaten Sanggau','Dalam Negeri',230000,70000,0),(331,'Kalimantan Barat','Kabupaten Ketapang','Dalam Negeri',230000,70000,0),(332,'Kalimantan Barat','Kabupaten Sintang','Dalam Negeri',230000,70000,0),(333,'Kalimantan Barat','Kabupaten Kapuas Hulu','Dalam Negeri',230000,70000,0),(334,'Kalimantan Barat','Kabupaten Bengkayang','Dalam Negeri',230000,70000,0),(335,'Kalimantan Barat','Kabupaten Landak','Dalam Negeri',230000,70000,0),(336,'Kalimantan Barat','Kabupaten Sekadau','Dalam Negeri',230000,70000,0),(337,'Kalimantan Barat','Kabupaten Melawi','Dalam Negeri',230000,70000,0),(338,'Kalimantan Barat','Kabupaten Kayong Utara','Dalam Negeri',230000,70000,0),(339,'Kalimantan Barat','Kabupaten Kubu Raya','Dalam Negeri',230000,70000,0),(340,'Kalimantan Barat','Kota Pontianak','Dalam Negeri',230000,70000,0),(341,'Kalimantan Barat','Kota Singkawang','Dalam Negeri',230000,70000,0),(342,'Kalimantan Tengah','Kabupaten Kotawaringin Barat','Dalam Negeri',220000,70000,0),(343,'Kalimantan Tengah','Kabupaten Kotawaringin Timur','Dalam Negeri',220000,70000,0),(344,'Kalimantan Tengah','Kabupaten Kapuas','Dalam Negeri',220000,70000,0),(345,'Kalimantan Tengah','Kabupaten Barito Selatan','Dalam Negeri',220000,70000,0),(346,'Kalimantan Tengah','Kabupaten Barito Utara','Dalam Negeri',220000,70000,0),(347,'Kalimantan Tengah','Kabupaten Katingan','Dalam Negeri',220000,70000,0),(348,'Kalimantan Tengah','Kabupaten Seruyan','Dalam Negeri',220000,70000,0),(349,'Kalimantan Tengah','Kabupaten Sukamara','Dalam Negeri',220000,70000,0),(350,'Kalimantan Tengah','Kabupaten Lamandau','Dalam Negeri',220000,70000,0),(351,'Kalimantan Tengah','Kabupaten Gunung Mas','Dalam Negeri',220000,70000,0),(352,'Kalimantan Tengah','Kabupaten Pulang Pisau','Dalam Negeri',220000,70000,0),(353,'Kalimantan Tengah','Kabupaten Murung Raya','Dalam Negeri',220000,70000,0),(354,'Kalimantan Tengah','Kabupaten Barito Timur','Dalam Negeri',220000,70000,0),(355,'Kalimantan Tengah','Kota Palangkaraya','Dalam Negeri',220000,70000,0),(356,'Kalimantan Selatan','Kabupaten Tanah Laut','Dalam Negeri',230000,70000,0),(357,'Kalimantan Selatan','Kabupaten Kotabaru','Dalam Negeri',230000,70000,0),(358,'Kalimantan Selatan','Kabupaten Banjar','Dalam Negeri',230000,70000,0),(359,'Kalimantan Selatan','Kabupaten Barito Kuala','Dalam Negeri',230000,70000,0),(360,'Kalimantan Selatan','Kabupaten Tapin','Dalam Negeri',230000,70000,0),(361,'Kalimantan Selatan','Kabupaten Hulu Sungai Selatan','Dalam Negeri',230000,70000,0),(362,'Kalimantan Selatan','Kabupaten Hulu Sungai Tengah','Dalam Negeri',230000,70000,0),(363,'Kalimantan Selatan','Kabupaten Hulu Sungai Utara','Dalam Negeri',230000,70000,0),(364,'Kalimantan Selatan','Kabupaten Tabalong','Dalam Negeri',230000,70000,0),(365,'Kalimantan Selatan','Kabupaten Tanah Bumbu','Dalam Negeri',230000,70000,0),(366,'Kalimantan Selatan','Kabupaten Balangan','Dalam Negeri',230000,70000,0),(367,'Kalimantan Selatan','Kota Banjarmasin','Dalam Negeri',230000,70000,0),(368,'Kalimantan Selatan','Kota Banjarbaru','Dalam Negeri',230000,70000,0),(369,'Kalimantan  Timur','Kabupaten Paser','Dalam Negeri',260000,80000,0),(370,'Kalimantan  Timur','Kabupaten Kutai Kartanegara','Dalam Negeri',260000,80000,0),(371,'Kalimantan  Timur','Kabupaten Berau','Dalam Negeri',260000,80000,0),(372,'Kalimantan  Timur','Kabupaten Kutai Barat','Dalam Negeri',260000,80000,0),(373,'Kalimantan  Timur','Kabupaten Kutai Timur','Dalam Negeri',260000,80000,0),(374,'Kalimantan  Timur','Kabupaten Panajam Paser Utara','Dalam Negeri',260000,80000,0),(375,'Kalimantan  Timur','Kabupaten Mahakam Ulu','Dalam Negeri',260000,80000,0),(376,'Kalimantan  Timur','Kota Balikpapan','Dalam Negeri',260000,80000,0),(377,'Kalimantan  Timur','Kota Samarinda','Dalam Negeri',260000,80000,0),(378,'Kalimantan  Timur','Kota Bontang','Dalam Negeri',260000,80000,0),(379,'Kalimantan Utara','Kabupaten Bulungan','Dalam Negeri',260000,80000,0),(380,'Kalimantan Utara','Kabupaten Malinau','Dalam Negeri',260000,80000,0),(381,'Kalimantan Utara','Kabupaten Nunukan','Dalam Negeri',260000,80000,0),(382,'Kalimantan Utara','Kabupaten Tana Tidung','Dalam Negeri',260000,80000,0),(383,'Kalimantan Utara','Kota Tarakan','Dalam Negeri',260000,80000,0),(384,'Sulawesi Utara','Kabupaten Bolaang Mongondow','Dalam Negeri',220000,70000,0),(385,'Sulawesi Utara','Kabupaten Minahasa','Dalam Negeri',220000,70000,0),(386,'Sulawesi Utara','Kabupaten Kepulauan Sangihe','Dalam Negeri',220000,70000,0),(387,'Sulawesi Utara','Kabupaten Kepulauan Talaud','Dalam Negeri',220000,70000,0),(388,'Sulawesi Utara','Kabupaten Minahasa Selatan','Dalam Negeri',220000,70000,0),(389,'Sulawesi Utara','Kabupaten Minahasa Utara','Dalam Negeri',220000,70000,0),(390,'Sulawesi Utara','Kabupaten Minahasa Tenggara','Dalam Negeri',220000,70000,0),(391,'Sulawesi Utara','Kabupaten Bolaang Mondondow Utara','Dalam Negeri',220000,70000,0),(392,'Sulawesi Utara','Kabupaten Kepulauan Siau Tagulandang Biaro','Dalam Negeri',220000,70000,0),(393,'Sulawesi Utara','Kabupaten Bolaang Mondondow Timur','Dalam Negeri',220000,70000,0),(394,'Sulawesi Utara','Kabupaten Bolaang Mondondow Selatan','Dalam Negeri',220000,70000,0),(395,'Sulawesi Utara','Kota Manado','Dalam Negeri',220000,70000,0),(396,'Sulawesi Utara','Kota Bitung','Dalam Negeri',220000,70000,0),(397,'Sulawesi Utara','Kota Tomohon','Dalam Negeri',220000,70000,0),(398,'Sulawesi Utara','Kota Kotamobagu','Dalam Negeri',220000,70000,0),(399,'Gorontalo','Kabupaten Gorontalo','Dalam Negeri',220000,70000,0),(400,'Gorontalo','Kabupaten Boalemo','Dalam Negeri',220000,70000,0),(401,'Gorontalo','Kabupaten Bone Bolango','Dalam Negeri',220000,70000,0),(402,'Gorontalo','Kabupaten Pohuwato','Dalam Negeri',220000,70000,0),(403,'Gorontalo','Kabupaten Gorontalo Utara','Dalam Negeri',220000,70000,0),(404,'Gorontalo','Kota Gorontalo','Dalam Negeri',220000,70000,0),(405,'Sulawesi Barat','Kabupaten Mamuju Utara','Dalam Negeri',250000,70000,0),(406,'Sulawesi Barat','Kabupaten Mamuju','Dalam Negeri',250000,70000,0),(407,'Sulawesi Barat','Kabupaten Mamasa','Dalam Negeri',250000,70000,0),(408,'Sulawesi Barat','Kabupaten Polewali Mandar','Dalam Negeri',250000,70000,0),(409,'Sulawesi Barat','Kabupaten Majene','Dalam Negeri',250000,70000,0),(410,'Sulawesi Barat','Kabupaten Mamuju Tengah','Dalam Negeri',250000,70000,0),(411,'Sulawesi Selatan','Kabupaten Kepulauan Selayar','Dalam Negeri',260000,80000,0),(412,'Sulawesi Selatan','Kabupaten Bulukumba','Dalam Negeri',260000,80000,0),(413,'Sulawesi Selatan','Kabupaten Bantaeng','Dalam Negeri',260000,80000,0),(414,'Sulawesi Selatan','Kabupaten Jeneponto','Dalam Negeri',260000,80000,0),(415,'Sulawesi Selatan','Kabupaten Takalar','Dalam Negeri',260000,80000,0),(416,'Sulawesi Selatan','Kabupaten Gowa','Dalam Negeri',260000,80000,0),(417,'Sulawesi Selatan','Kabupaten Sinjai','Dalam Negeri',260000,80000,0),(418,'Sulawesi Selatan','Kabupaten Bone','Dalam Negeri',260000,80000,0),(419,'Sulawesi Selatan','Kabupaten Maros','Dalam Negeri',260000,80000,0),(420,'Sulawesi Selatan','Kabupaten Pangkajene dan Kepulauan','Dalam Negeri',260000,80000,0),(421,'Sulawesi Selatan','Kabupaten Barru','Dalam Negeri',260000,80000,0),(422,'Sulawesi Selatan','Kabupaten Soppeng','Dalam Negeri',260000,80000,0),(423,'Sulawesi Selatan','Kabupaten Wajo','Dalam Negeri',260000,80000,0),(424,'Sulawesi Selatan','Kabupaten Sidenreng Rappang','Dalam Negeri',260000,80000,0),(425,'Sulawesi Selatan','Kabupaten Pinrang','Dalam Negeri',260000,80000,0),(426,'Sulawesi Selatan','Kabupaten Enrekang','Dalam Negeri',260000,80000,0),(427,'Sulawesi Selatan','Kabupaten Luwu','Dalam Negeri',260000,80000,0),(428,'Sulawesi Selatan','Kabupaten Tana Toraja','Dalam Negeri',260000,80000,0),(429,'Sulawesi Selatan','Kabupaten Luwu Utara','Dalam Negeri',260000,80000,0),(430,'Sulawesi Selatan','Kabupaten Luwu Timur','Dalam Negeri',260000,80000,0),(431,'Sulawesi Selatan','Kabupaten Toraja Utara','Dalam Negeri',260000,80000,0),(432,'Sulawesi Selatan','Kota Makassar','Dalam Negeri',260000,80000,0),(433,'Sulawesi Selatan','Kota Parepare','Dalam Negeri',260000,80000,0),(434,'Sulawesi Selatan','Kota Palopo','Dalam Negeri',260000,80000,0),(435,'Sulawesi Tengah ','Kabupaten Banggai','Dalam Negeri',220000,70000,0),(436,'Sulawesi Tengah ','Kabupaten Poso','Dalam Negeri',220000,70000,0),(437,'Sulawesi Tengah ','Kabupaten Donggala','Dalam Negeri',220000,70000,0),(438,'Sulawesi Tengah ','Kabupaten Tolitoli','Dalam Negeri',220000,70000,0),(439,'Sulawesi Tengah ','Kabupaten Buol','Dalam Negeri',220000,70000,0),(440,'Sulawesi Tengah ','Kabupaten Morowali','Dalam Negeri',220000,70000,0),(441,'Sulawesi Tengah ','Kabupaten Banggai Kepulauan','Dalam Negeri',220000,70000,0),(442,'Sulawesi Tengah ','Kabupaten Parigi Moutong','Dalam Negeri',220000,70000,0),(443,'Sulawesi Tengah ','Kabupaten Tojo Una-Una','Dalam Negeri',220000,70000,0),(444,'Sulawesi Tengah ','Kabupaten Sigi','Dalam Negeri',220000,70000,0),(445,'Sulawesi Tengah ','Kabupaten Banggai Laut','Dalam Negeri',220000,70000,0),(446,'Sulawesi Tengah ','Kabupaten Morowali Utara','Dalam Negeri',220000,70000,0),(447,'Sulawesi Tengah ','Kota Palu','Dalam Negeri',220000,70000,0),(448,'Sulawesi Tenggara','Kabupaten Kolaka','Dalam Negeri',230000,70000,0),(449,'Sulawesi Tenggara','Kabupaten Konawe','Dalam Negeri',230000,70000,0),(450,'Sulawesi Tenggara','Kabupaten Muna','Dalam Negeri',230000,70000,0),(451,'Sulawesi Tenggara','Kabupaten Buton','Dalam Negeri',230000,70000,0),(452,'Sulawesi Tenggara','Kabupaten Konawe Selatan','Dalam Negeri',230000,70000,0),(453,'Sulawesi Tenggara','Kabupaten Bombana','Dalam Negeri',230000,70000,0),(454,'Sulawesi Tenggara','Kabupaten Wakatobi','Dalam Negeri',230000,70000,0),(455,'Sulawesi Tenggara','Kabupaten Kolaka Utara','Dalam Negeri',230000,70000,0),(456,'Sulawesi Tenggara','Kabupaten Konawe Utara','Dalam Negeri',230000,70000,0),(457,'Sulawesi Tenggara','Kabupaten Buton Utara','Dalam Negeri',230000,70000,0),(458,'Sulawesi Tenggara','Kabupaten Kolaka Timur','Dalam Negeri',230000,70000,0),(459,'Sulawesi Tenggara','Kabupaten Konawe Kepulauan','Dalam Negeri',230000,70000,0),(460,'Sulawesi Tenggara','Kabupaten Muna Barat','Dalam Negeri',230000,70000,0),(461,'Sulawesi Tenggara','Kabupaten Buton Tengah','Dalam Negeri',230000,70000,0),(462,'Sulawesi Tenggara','Kabupaten Buton Selatan','Dalam Negeri',230000,70000,0),(463,'Sulawesi Tenggara','Kota Kendari','Dalam Negeri',230000,70000,0),(464,'Sulawesi Tenggara','Kota Bau Bau','Dalam Negeri',230000,70000,0),(465,'Maluku','Kabupaten Maluku Tengah','Dalam Negeri',230000,70000,0),(466,'Maluku','Kabupaten Maluku Tenggara','Dalam Negeri',230000,70000,0),(467,'Maluku','Kabupaten Maluku Tenggara Barat','Dalam Negeri',230000,70000,0),(468,'Maluku','Kabupaten Buru','Dalam Negeri',230000,70000,0),(469,'Maluku','Kabupaten Seram Bagian Timur','Dalam Negeri',230000,70000,0),(470,'Maluku','Kabupaten Seram Bagian Barat','Dalam Negeri',230000,70000,0),(471,'Maluku','Kabupaten Kepulauan Aru','Dalam Negeri',230000,70000,0),(472,'Maluku','Kabupaten Maluku Barat Daya','Dalam Negeri',230000,70000,0),(473,'Maluku','Kabupaten Buru Selatan','Dalam Negeri',230000,70000,0),(474,'Maluku','Kota Ambon','Dalam Negeri',230000,70000,0),(475,'Maluku','Kota Tual','Dalam Negeri',230000,70000,0),(476,'Maluku Utara','Kabupaten Halmahera Barat','Dalam Negeri',260000,80000,0),(477,'Maluku Utara','Kabupaten Halmahera Tengah','Dalam Negeri',260000,80000,0),(478,'Maluku Utara','Kabupaten Halmahera Utara','Dalam Negeri',260000,80000,0),(479,'Maluku Utara','Kabupaten Halmahera Selatan','Dalam Negeri',260000,80000,0),(480,'Maluku Utara','Kabupaten Kepulauan Sula','Dalam Negeri',260000,80000,0),(481,'Maluku Utara','Kabupaten Halmahera Timur','Dalam Negeri',260000,80000,0),(482,'Maluku Utara','Kabupaten Pulau Morotai','Dalam Negeri',260000,80000,0),(483,'Maluku Utara','Kabupaten Pulau Taliabu','Dalam Negeri',260000,80000,0),(484,'Maluku Utara','Kota Ternate','Dalam Negeri',260000,80000,0),(485,'Maluku Utara','Kota Tidore Kepulauan','Dalam Negeri',260000,80000,0),(486,'Papua','Kabupaten Merauke','Dalam Negeri',350000,100000,0),(487,'Papua','Kabupaten Jayawijaya','Dalam Negeri',350000,100000,0),(488,'Papua','Kabupaten Jayapura','Dalam Negeri',350000,100000,0),(489,'Papua','Kabupaten Nabire','Dalam Negeri',350000,100000,0),(490,'Papua','Kabupaten Kepulauan Yapen','Dalam Negeri',350000,100000,0),(491,'Papua','Kabupaten Biak Numfor','Dalam Negeri',350000,100000,0),(492,'Papua','Kabupaten Puncak Jaya','Dalam Negeri',350000,100000,0),(493,'Papua','Kabupaten Paniai','Dalam Negeri',350000,100000,0),(494,'Papua','Kabupaten Mimika','Dalam Negeri',350000,100000,0),(495,'Papua','Kabupaten Sarmi','Dalam Negeri',350000,100000,0),(496,'Papua','Kabupaten Keerom','Dalam Negeri',350000,100000,0),(497,'Papua','Kabupaten Pegunungan Bintang','Dalam Negeri',350000,100000,0),(498,'Papua','Kabupaten Yahukimo','Dalam Negeri',350000,100000,0),(499,'Papua','Kabupaten Tolikara','Dalam Negeri',350000,100000,0),(500,'Papua','Kabupaten Waropen','Dalam Negeri',350000,100000,0),(501,'Papua','Kabupaten Boven Digoel','Dalam Negeri',350000,100000,0),(502,'Papua','Kabupaten Mappi','Dalam Negeri',350000,100000,0),(503,'Papua','Kabupaten Asmat','Dalam Negeri',350000,100000,0),(504,'Papua','Kabupaten Supiori','Dalam Negeri',350000,100000,0),(505,'Papua','Kabupaten Mamberamo Raya','Dalam Negeri',350000,100000,0),(506,'Papua','Kabupaten Mamberamo Tengah','Dalam Negeri',350000,100000,0),(507,'Papua','Kabupaten Yalimo','Dalam Negeri',350000,100000,0),(508,'Papua','Kabupaten Lanny Jaya','Dalam Negeri',350000,100000,0),(509,'Papua','Kabupaten Nduga','Dalam Negeri',350000,100000,0),(510,'Papua','Kabupaten Puncak','Dalam Negeri',350000,100000,0),(511,'Papua','Kabupaten Dogiyai','Dalam Negeri',350000,100000,0),(512,'Papua','Kabupaten Intan Jaya','Dalam Negeri',350000,100000,0),(513,'Papua','Kabupaten Deiyai','Dalam Negeri',350000,100000,0),(514,'Papua','Kota Jayapura','Dalam Negeri',350000,100000,0),(515,'Papua Barat','Kabupaten Sorong','Dalam Negeri',290000,80000,0),(516,'Papua Barat','Kabupaten Manokwari','Dalam Negeri',290000,80000,0),(517,'Papua Barat','Kabupaten Fakfak','Dalam Negeri',290000,80000,0),(518,'Papua Barat','Kabupaten Sorong Selatan','Dalam Negeri',290000,80000,0),(519,'Papua Barat','Kabupaten Raja Ampat','Dalam Negeri',290000,80000,0),(520,'Papua Barat','Kabupaten Teluk Bintuni','Dalam Negeri',290000,80000,0),(521,'Papua Barat','Kabupaten Teluk Wondama','Dalam Negeri',290000,80000,0),(522,'Papua Barat','Kabupaten Kaimana','Dalam Negeri',290000,80000,0),(523,'Papua Barat','Kabupaten Tambrauw','Dalam Negeri',290000,80000,0),(524,'Papua Barat','Kabupaten Maybrat','Dalam Negeri',290000,80000,0),(525,'Papua Barat','Kabupaten Manokwari Selatan','Dalam Negeri',290000,80000,0),(526,'Papua Barat','Kabupaten Pegunungan Arfak','Dalam Negeri',290000,80000,0),(527,'Papua Barat','Kota Sorong','Dalam Negeri',290000,80000,0),(528,'Amerika Serikat','Amerika Serikat','Luar Negeri',NULL,NULL,0),(529,'Kanada','Kanada','Luar Negeri',NULL,NULL,0),(530,'Argentina','Argentina','Luar Negeri',NULL,NULL,0),(531,'Venezuela','Venezuela','Luar Negeri',NULL,NULL,0),(532,'Brazil','Brazil','Luar Negeri',NULL,NULL,0),(533,'Chile','Chile','Luar Negeri',NULL,NULL,0),(534,'Columbia','Columbia','Luar Negeri',NULL,NULL,0),(535,'Peru','Peru','Luar Negeri',NULL,NULL,0),(536,'Suriname','Suriname','Luar Negeri',NULL,NULL,0),(537,'Ekuador','Ekuador','Luar Negeri',NULL,NULL,0),(538,'Mexico','Mexico','Luar Negeri',NULL,NULL,0),(539,'Kuba','Kuba','Luar Negeri',NULL,NULL,0),(540,'Panama','Panama','Luar Negeri',NULL,NULL,0),(541,'Austria','Austria','Luar Negeri',NULL,NULL,0),(542,'Belgia','Belgia','Luar Negeri',NULL,NULL,0),(543,'Perancis','Perancis','Luar Negeri',NULL,NULL,0),(544,'Rep.Federasi Jerman','Rep.Federasi Jerman','Luar Negeri',NULL,NULL,0),(545,'Belanda','Belanda','Luar Negeri',NULL,NULL,0),(546,'Swiss','Swiss','Luar Negeri',NULL,NULL,0),(547,'Denmark','Denmark','Luar Negeri',NULL,NULL,0),(548,'Finlandia','Finlandia','Luar Negeri',NULL,NULL,0),(549,'Norwegia','Norwegia','Luar Negeri',NULL,NULL,0),(550,'Swedia','Swedia','Luar Negeri',NULL,NULL,0),(551,'Kerjaan Inggris','Kerjaan Inggris','Luar Negeri',NULL,NULL,0),(552,'Bosnia Herzegovina','Bosnia Herzegovina','Luar Negeri',NULL,NULL,0),(553,'Kroasia','Kroasia','Luar Negeri',NULL,NULL,0),(554,'Spanyol','Spanyol','Luar Negeri',NULL,NULL,0),(555,'Yunani','Yunani','Luar Negeri',NULL,NULL,0),(556,'Italia','Italia','Luar Negeri',NULL,NULL,0),(557,'Portugal','Portugal','Luar Negeri',NULL,NULL,0),(558,'Serbia','Serbia','Luar Negeri',NULL,NULL,0),(559,'Bulgaria','Bulgaria','Luar Negeri',NULL,NULL,0),(560,'Ceko','Ceko','Luar Negeri',NULL,NULL,0),(561,'Hongaria','Hongaria','Luar Negeri',NULL,NULL,0),(562,'Polandia','Polandia','Luar Negeri',NULL,NULL,0),(563,'Rumania','Rumania','Luar Negeri',NULL,NULL,0),(564,'Rusia','Rusia','Luar Negeri',NULL,NULL,0),(565,'Slovakia','Slovakia','Luar Negeri',NULL,NULL,0),(566,'Ukraina','Ukraina','Luar Negeri',NULL,NULL,0),(567,'Nigeria','Nigeria','Luar Negeri',NULL,NULL,0),(568,'Senegal','Senegal','Luar Negeri',NULL,NULL,0),(569,'Ethiopia','Ethiopia','Luar Negeri',NULL,NULL,0),(570,'Kenya','Kenya','Luar Negeri',NULL,NULL,0),(571,'Madagaskar','Madagaskar','Luar Negeri',NULL,NULL,0),(572,'Tanzania','Tanzania','Luar Negeri',NULL,NULL,0),(573,'Zimbabwe','Zimbabwe','Luar Negeri',NULL,NULL,0),(574,'Mozambik','Mozambik','Luar Negeri',NULL,NULL,0),(575,'Namibia','Namibia','Luar Negeri',NULL,NULL,0),(576,'Afrika Selatan','Afrika Selatan','Luar Negeri',NULL,NULL,0),(577,'Aljazair','Aljazair','Luar Negeri',NULL,NULL,0),(578,'Mesir','Mesir','Luar Negeri',NULL,NULL,0),(579,'Maroko','Maroko','Luar Negeri',NULL,NULL,0),(580,'Tunisia','Tunisia','Luar Negeri',NULL,NULL,0),(581,'Sudan','Sudan','Luar Negeri',NULL,NULL,0),(582,'Lybia','Lybia','Luar Negeri',NULL,NULL,0),(583,'Azerbaijan','Azerbaijan','Luar Negeri',NULL,NULL,0),(584,'Bahrain','Bahrain','Luar Negeri',NULL,NULL,0),(585,'Irak','Irak','Luar Negeri',NULL,NULL,0),(586,'Yordania','Yordania','Luar Negeri',NULL,NULL,0),(587,'Kuwait','Kuwait','Luar Negeri',NULL,NULL,0),(588,'Libanon','Libanon','Luar Negeri',NULL,NULL,0),(589,'Qatar','Qatar','Luar Negeri',NULL,NULL,0),(590,'Arab Suriah','Arab Suriah','Luar Negeri',NULL,NULL,0),(591,'Turki','Turki','Luar Negeri',NULL,NULL,0),(592,'Pst.Arab Emirat','Pst.Arab Emirat','Luar Negeri',NULL,NULL,0),(593,'Yaman','Yaman','Luar Negeri',NULL,NULL,0),(594,'Saudi Arabia','Saudi Arabia','Luar Negeri',NULL,NULL,0),(595,'Kelsultanan Oman','Kelsultanan Oman','Luar Negeri',NULL,NULL,0),(596,'Replubik Rakyat Kelompok','Replubik Rakyat Kelompok','Luar Negeri',NULL,NULL,0),(597,'Hongkong','Hongkong','Luar Negeri',NULL,NULL,0),(598,'Jepang','Jepang','Luar Negeri',NULL,NULL,0),(599,'Korea Selatan','Korea Selatan','Luar Negeri',NULL,NULL,0),(600,'Korea Utara','Korea Utara','Luar Negeri',NULL,NULL,0),(601,'Afganistan','Afganistan','Luar Negeri',NULL,NULL,0),(602,'Bangladesh','Bangladesh','Luar Negeri',NULL,NULL,0),(603,'India','India','Luar Negeri',NULL,NULL,0),(604,'Pakistan','Pakistan','Luar Negeri',NULL,NULL,0),(605,'Srilanka','Srilanka','Luar Negeri',NULL,NULL,0),(606,'Iran','Iran','Luar Negeri',NULL,NULL,0),(607,'Uzbekistan','Uzbekistan','Luar Negeri',NULL,NULL,0),(608,'Kazakhstan','Kazakhstan','Luar Negeri',NULL,NULL,0),(609,'Filipina','Filipina','Luar Negeri',NULL,NULL,0),(610,'Singapura','Singapura','Luar Negeri',NULL,NULL,0),(611,'Malaysia','Malaysia','Luar Negeri',NULL,NULL,0),(612,'Thailand','Thailand','Luar Negeri',NULL,NULL,0),(613,'Myanmar','Myanmar','Luar Negeri',NULL,NULL,0),(614,'Laos','Laos','Luar Negeri',NULL,NULL,0),(615,'Vietnam','Vietnam','Luar Negeri',NULL,NULL,0),(616,'Brunei Darussalam','Brunei Darussalam','Luar Negeri',NULL,NULL,0),(617,'Kamboja','Kamboja','Luar Negeri',NULL,NULL,0),(618,'Timor Leste','Timor Leste','Luar Negeri',NULL,NULL,0),(619,'Australia','Australia','Luar Negeri',NULL,NULL,0),(620,'Selandia Baru','Selandia Baru','Luar Negeri',NULL,NULL,0),(621,'Kaledonia Baru','Kaledonia Baru','Luar Negeri',NULL,NULL,0),(622,'Papua Nugini','Papua Nugini','Luar Negeri',NULL,NULL,0),(623,'Fiji','Fiji','Luar Negeri',NULL,NULL,0);
/*!40000 ALTER TABLE `master_destination` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_destination_golongan`
--

DROP TABLE IF EXISTS `master_destination_golongan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `master_destination_golongan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_destination` int DEFAULT NULL,
  `id_group_golongan` int DEFAULT NULL,
  `amount` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=577;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_destination_golongan`
--

LOCK TABLES `master_destination_golongan` WRITE;
/*!40000 ALTER TABLE `master_destination_golongan` DISABLE KEYS */;
INSERT INTO `master_destination_golongan` VALUES (1,528,1,450),(2,529,1,374),(3,530,1,322),(4,531,1,310),(5,532,1,317),(6,533,1,296),(7,534,1,330),(8,535,1,282),(9,536,1,291),(10,537,1,284),(11,538,1,374),(12,539,1,308),(13,540,1,286),(14,541,1,362),(15,542,1,365),(16,543,1,371),(17,544,1,332),(18,545,1,333),(19,546,1,456),(20,547,1,393),(21,548,1,354),(22,549,1,447),(23,550,1,415),(24,551,1,619),(25,552,1,365),(26,553,1,444),(27,554,1,330),(28,555,1,303),(29,556,1,510),(30,557,1,306),(31,558,1,300),(32,559,1,294),(33,560,1,421),(34,561,1,350),(35,562,1,332),(36,563,1,305),(37,564,1,410),(38,565,1,315),(39,566,1,349),(40,567,1,338),(41,568,1,287),(42,569,1,256),(43,570,1,286),(44,571,1,245),(45,572,1,266),(46,573,1,255),(47,574,1,263),(48,575,1,267),(49,576,1,299),(50,577,1,262),(51,578,1,320),(52,579,1,258),(53,580,1,198),(54,581,1,262),(55,582,1,203),(56,583,1,367),(57,584,1,339),(58,585,1,314),(59,586,1,342),(60,587,1,393),(61,588,1,311),(62,589,1,358),(63,590,1,241),(64,591,1,291),(65,592,1,402),(66,593,1,199),(67,594,1,318),(68,595,1,350),(69,596,1,281),(70,597,1,406),(71,598,1,342),(72,599,1,374),(73,600,1,257),(74,601,1,210),(75,602,1,250),(76,603,1,263),(77,604,1,222),(78,605,1,266),(79,606,1,266),(80,607,1,282),(81,608,1,336),(82,609,1,294),(83,610,1,415),(84,611,1,243),(85,612,1,264),(86,613,1,200),(87,614,1,222),(88,615,1,234),(89,616,1,222),(90,617,1,178),(91,618,1,283),(92,619,1,468),(93,620,1,369),(94,621,1,310),(95,622,1,381),(96,623,1,292),(97,528,2,404),(98,529,2,333),(99,530,2,281),(100,531,2,275),(101,532,2,302),(102,533,2,266),(103,534,2,324),(104,535,2,256),(105,536,2,214),(106,537,2,255),(107,538,2,334),(108,539,2,276),(109,540,2,256),(110,541,2,278),(111,542,2,325),(112,543,2,330),(113,544,2,294),(114,545,2,294),(115,546,2,355),(116,547,2,342),(117,548,2,315),(118,549,2,311),(119,550,2,369),(120,551,2,466),(121,552,2,267),(122,553,2,325),(123,554,2,268),(124,555,2,262),(125,556,2,357),(126,557,2,246),(127,558,2,261),(128,559,2,256),(129,560,2,358),(130,561,2,312),(131,562,2,290),(132,563,2,250),(133,564,2,326),(134,565,2,273),(135,566,2,300),(136,567,2,322),(137,568,2,258),(138,569,2,230),(139,570,2,234),(140,571,2,221),(141,572,2,239),(142,573,2,230),(143,574,2,212),(144,575,2,214),(145,576,2,254),(146,577,2,236),(147,578,2,286),(148,579,2,233),(149,580,2,180),(150,581,2,236),(151,582,2,151),(152,583,2,292),(153,584,2,227),(154,585,2,281),(155,586,2,306),(156,587,2,350),(157,588,2,278),(158,589,2,279),(159,590,2,218),(160,591,2,249),(161,592,2,357),(162,593,2,181),(163,594,2,285),(164,595,2,312),(165,596,2,252),(166,597,2,361),(167,598,2,306),(168,599,2,340),(169,600,2,240),(170,601,2,190),(171,602,2,194),(172,603,2,262),(173,604,2,201),(174,605,2,239),(175,606,2,239),(176,607,2,230),(177,608,2,267),(178,609,2,213),(179,610,2,369),(180,611,2,219),(181,612,2,238),(182,613,2,168),(183,614,2,201),(184,615,2,195),(185,616,2,202),(186,617,2,161),(187,618,2,189),(188,619,2,339),(189,620,2,329),(190,621,2,239),(191,622,2,343),(192,623,2,262),(193,528,3,404),(194,529,3,333),(195,530,3,281),(196,531,3,275),(197,532,3,302),(198,533,3,266),(199,534,3,324),(200,535,3,256),(201,536,3,214),(202,537,3,255),(203,538,3,334),(204,539,3,276),(205,540,3,256),(206,541,3,278),(207,542,3,325),(208,543,3,330),(209,544,3,294),(210,545,3,294),(211,546,3,355),(212,547,3,342),(213,548,3,315),(214,549,3,311),(215,550,3,369),(216,551,3,466),(217,552,3,267),(218,553,3,325),(219,554,3,268),(220,555,3,262),(221,556,3,357),(222,557,3,246),(223,558,3,261),(224,559,3,256),(225,560,3,358),(226,561,3,312),(227,562,3,290),(228,563,3,250),(229,564,3,326),(230,565,3,273),(231,566,3,300),(232,567,3,322),(233,568,3,258),(234,569,3,230),(235,570,3,234),(236,571,3,221),(237,572,3,239),(238,573,3,230),(239,574,3,212),(240,575,3,214),(241,576,3,254),(242,577,3,236),(243,578,3,286),(244,579,3,233),(245,580,3,180),(246,581,3,236),(247,582,3,151),(248,583,3,292),(249,584,3,227),(250,585,3,281),(251,586,3,306),(252,587,3,350),(253,588,3,278),(254,589,3,279),(255,590,3,218),(256,591,3,249),(257,592,3,357),(258,593,3,181),(259,594,3,285),(260,595,3,312),(261,596,3,252),(262,597,3,361),(263,598,3,306),(264,599,3,340),(265,600,3,240),(266,601,3,190),(267,602,3,194),(268,603,3,262),(269,604,3,201),(270,605,3,239),(271,606,3,239),(272,607,3,230),(273,608,3,267),(274,609,3,213),(275,610,3,369),(276,611,3,219),(277,612,3,238),(278,613,3,168),(279,614,3,201),(280,615,3,195),(281,616,3,202),(282,617,3,161),(283,618,3,189),(284,619,3,339),(285,620,3,329),(286,621,3,239),(287,622,3,343),(288,623,3,262),(289,528,7,358),(290,529,7,292),(291,530,7,269),(292,531,7,264),(293,532,7,281),(294,533,7,235),(295,534,7,292),(296,535,7,224),(297,536,7,214),(298,537,7,216),(299,538,7,283),(300,539,7,244),(301,540,7,226),(302,541,7,244),(303,542,7,276),(304,543,7,295),(305,544,7,259),(306,545,7,249),(307,546,7,311),(308,547,7,300),(309,548,7,277),(310,549,7,299),(311,550,7,312),(312,551,7,456),(313,552,7,256),(314,553,7,314),(315,554,7,227),(316,555,7,221),(317,556,7,342),(318,557,7,208),(319,558,7,230),(320,559,7,227),(321,560,7,294),(322,561,7,276),(323,562,7,256),(324,563,7,222),(325,564,7,315),(326,565,7,242),(327,566,7,264),(328,567,7,262),(329,568,7,218),(330,569,7,205),(331,570,7,219),(332,571,7,187),(333,572,7,213),(334,573,7,194),(335,574,7,201),(336,575,7,201),(337,576,7,225),(338,577,7,219),(339,578,7,253),(340,579,7,197),(341,580,7,152),(342,581,7,210),(343,582,7,132),(344,583,7,281),(345,584,7,174),(346,585,7,248),(347,586,7,269),(348,587,7,296),(349,588,7,246),(350,589,7,232),(351,590,7,184),(352,591,7,221),(353,592,7,303),(354,593,7,153),(355,594,7,251),(356,595,7,264),(357,596,7,213),(358,597,7,306),(359,598,7,259),(360,599,7,327),(361,600,7,222),(362,601,7,161),(363,602,7,180),(364,603,7,250),(365,604,7,170),(366,605,7,208),(367,606,7,213),(368,607,7,203),(369,608,7,256),(370,609,7,171),(371,610,7,312),(372,611,7,185),(373,612,7,206),(374,613,7,147),(375,614,7,174),(376,615,7,169),(377,616,7,171),(378,617,7,147),(379,618,7,170),(380,619,7,304),(381,620,7,279),(382,621,7,213),(383,622,7,301),(384,623,7,231),(385,528,4,358),(386,529,4,292),(387,530,4,269),(388,531,4,264),(389,532,4,281),(390,533,4,235),(391,534,4,292),(392,535,4,224),(393,536,4,214),(394,537,4,216),(395,538,4,283),(396,539,4,244),(397,540,4,226),(398,541,4,244),(399,542,4,276),(400,543,4,295),(401,544,4,259),(402,545,4,249),(403,546,4,311),(404,547,4,300),(405,548,4,277),(406,549,4,299),(407,550,4,312),(408,551,4,456),(409,552,4,256),(410,553,4,314),(411,554,4,227),(412,555,4,221),(413,556,4,342),(414,557,4,208),(415,558,4,230),(416,559,4,227),(417,560,4,294),(418,561,4,276),(419,562,4,256),(420,563,4,222),(421,564,4,315),(422,565,4,242),(423,566,4,264),(424,567,4,262),(425,568,4,218),(426,569,4,205),(427,570,4,219),(428,571,4,187),(429,572,4,213),(430,573,4,194),(431,574,4,201),(432,575,4,201),(433,576,4,225),(434,577,4,219),(435,578,4,253),(436,579,4,197),(437,580,4,152),(438,581,4,210),(439,582,4,132),(440,583,4,281),(441,584,4,174),(442,585,4,248),(443,586,4,269),(444,587,4,296),(445,588,4,246),(446,589,4,232),(447,590,4,184),(448,591,4,221),(449,592,4,303),(450,593,4,153),(451,594,4,251),(452,595,4,264),(453,596,4,213),(454,597,4,306),(455,598,4,259),(456,599,4,327),(457,600,4,222),(458,601,4,161),(459,602,4,180),(460,603,4,250),(461,604,4,170),(462,605,4,208),(463,606,4,213),(464,607,4,203),(465,608,4,256),(466,609,4,171),(467,610,4,312),(468,611,4,185),(469,612,4,206),(470,613,4,147),(471,614,4,174),(472,615,4,169),(473,616,4,171),(474,617,4,147),(475,618,4,170),(476,619,4,304),(477,620,4,279),(478,621,4,213),(479,622,4,301),(480,623,4,231),(481,528,5,286),(482,529,5,234),(483,530,5,215),(484,531,5,212),(485,532,5,225),(486,533,5,188),(487,534,5,234),(488,535,5,179),(489,536,5,172),(490,537,5,173),(491,538,5,226),(492,539,5,195),(493,540,5,181),(494,541,5,195),(495,542,5,220),(496,543,5,236),(497,544,5,207),(498,545,5,199),(499,546,5,249),(500,547,5,240),(501,548,5,221),(502,549,5,239),(503,550,5,250),(504,551,5,364),(505,552,5,205),(506,553,5,251),(507,554,5,181),(508,555,5,177),(509,556,5,273),(510,557,5,167),(511,558,5,184),(512,559,5,182),(513,560,5,235),(514,561,5,221),(515,562,5,205),(516,563,5,177),(517,564,5,252),(518,565,5,194),(519,566,5,212),(520,567,5,210),(521,568,5,174),(522,569,5,164),(523,570,5,175),(524,571,5,149),(525,572,5,170),(526,573,5,155),(527,574,5,161),(528,575,5,161),(529,576,5,180),(530,577,5,175),(531,578,5,202),(532,579,5,158),(533,580,5,122),(534,581,5,168),(535,582,5,106),(536,583,5,225),(537,584,5,139),(538,585,5,198),(539,586,5,215),(540,587,5,237),(541,588,5,196),(542,589,5,186),(543,590,5,148),(544,591,5,177),(545,592,5,242),(546,593,5,123),(547,594,5,201),(548,595,5,212),(549,596,5,171),(550,597,5,245),(551,598,5,207),(552,599,5,261),(553,600,5,178),(554,601,5,129),(555,602,5,144),(556,603,5,200),(557,604,5,136),(558,605,5,166),(559,606,5,170),(560,607,5,163),(561,608,5,205),(562,609,5,137),(563,610,5,250),(564,611,5,148),(565,612,5,165),(566,613,5,117),(567,614,5,139),(568,615,5,135),(569,616,5,137),(570,617,5,117),(571,618,5,136),(572,619,5,244),(573,620,5,223),(574,621,5,170),(575,622,5,241),(576,623,5,185);
/*!40000 ALTER TABLE `master_destination_golongan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_division`
--

DROP TABLE IF EXISTS `master_division`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `master_division` (
  `id_master_division` int NOT NULL AUTO_INCREMENT,
  `division_name` varchar(45) DEFAULT NULL,
  `head_of_division` varchar(45) DEFAULT NULL,
  `id_auth_user` int DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` datetime DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_master_division`)
) ENGINE=InnoDB AUTO_INCREMENT=2;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_division`
--

LOCK TABLES `master_division` WRITE;
/*!40000 ALTER TABLE `master_division` DISABLE KEYS */;
INSERT INTO `master_division` VALUES (1,'EPC','982ad9de-5e1c-11ea-a74f-929740789a9a',NULL,'2019-10-06 23:13:51','2019-10-07 06:32:52',0);
/*!40000 ALTER TABLE `master_division` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_employee`
--

DROP TABLE IF EXISTS `master_employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `master_employee` (
  `employeeid` varchar(40) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `golongan` tinyint DEFAULT NULL,
  `sex` enum('L','P') DEFAULT NULL,
  `department` tinyint DEFAULT NULL,
  `jobsid` int DEFAULT NULL,
  `head_sub_division` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `handphone` varchar(100) DEFAULT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `unitid` varchar(40) NOT NULL,
  `createdby` varchar(20) NOT NULL,
  `createddate` varchar(16) NOT NULL,
  `modifiedby` varchar(20) NOT NULL,
  `modifieddate` varchar(16) NOT NULL,
  `deleted` char(1) NOT NULL,
  `userid` int DEFAULT NULL,
  PRIMARY KEY (`employeeid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_employee`
--

LOCK TABLES `master_employee` WRITE;
/*!40000 ALTER TABLE `master_employee` DISABLE KEYS */;
INSERT INTO `master_employee` VALUES ('982ad9de-5e1c-11ea-a74f-929740789a9a','Selo','Tjahjono ','93.692.827',21,'L',1,76,'982ad9de-5e1c-11ea-a74f-929740789a9a','selo.tjahjono@hutamakarya.com',NULL,NULL,'','','','','','',851),('982bea68-5e1c-11ea-a74f-929740789a9a','Rike','Alvianita ','HKEPC.1306',11,'P',1,1,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1306@mail.com',NULL,NULL,'','','','','','',852),('982c8720-5e1c-11ea-a74f-929740789a9a','Nurma','Fauziani ','HKEPC.1897',10,'P',1,2,'985b36c4-5e1c-11ea-a74f-929740789a9a','HKEPC1897@mail.com',NULL,NULL,'','','','','','',853),('9830fddc-5e1c-11ea-a74f-929740789a9a','Roestomo','Sosroprayitno ','52.122.141',13,'L',1,3,'982ad9de-5e1c-11ea-a74f-929740789a9a','52122141@mail.com',NULL,NULL,'','','','','','',854),('9831ee0e-5e1c-11ea-a74f-929740789a9a','Michael','Thomas Clarke ','HKEPC.1908',13,'L',1,77,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1908@mail.com',NULL,NULL,'','','','','','',855),('9832998a-5e1c-11ea-a74f-929740789a9a','Aris','Wahyudiono ','HKEPC.1904',0,'L',1,78,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1904@mail.com',NULL,NULL,'','','','','','',856),('98338bba-5e1c-11ea-a74f-929740789a9a','Kartika','Lestari ','9.803.376',14,'P',1,5,'98346b70-5e1c-11ea-a74f-929740789a9a','09803376@mail.com',NULL,NULL,'','','','','','',857),('98346b70-5e1c-11ea-a74f-929740789a9a','Reza','Faisal ','HKEPC.1631',13,'L',1,4,'98346b70-5e1c-11ea-a74f-929740789a9a','reza_faisal@hotmail.com',NULL,NULL,'','','','','','',858),('9834f054-5e1c-11ea-a74f-929740789a9a','Moch.','Alvian Fachrurrozi ','HKEPC.1756',11,'L',1,4,'98346b70-5e1c-11ea-a74f-929740789a9a','HKEPC1756@mail.com',NULL,NULL,'','','','','','',859),('98374f70-5e1c-11ea-a74f-929740789a9a','Muhammad','Ilham Abdurrahim ','KD19.9792',11,'L',1,7,'98346b70-5e1c-11ea-a74f-929740789a9a','KD199792@mail.com',NULL,NULL,'','','','','','',860),('9838ce4a-5e1c-11ea-a74f-929740789a9a','Novahana','Noor Pradita ','KD19.9796',11,'P',1,7,'98346b70-5e1c-11ea-a74f-929740789a9a','KD199796@mail.com',NULL,NULL,'','','','','','',861),('9839a1ee-5e1c-11ea-a74f-929740789a9a','Dwieky','Anugerah ','KD19.9749',11,'L',1,7,'98346b70-5e1c-11ea-a74f-929740789a9a','KD199749@mail.com',NULL,NULL,'','','','','','',862),('983a56de-5e1c-11ea-a74f-929740789a9a','Gabriella','Paramitha ','19.953.893',11,'P',1,8,'982ad9de-5e1c-11ea-a74f-929740789a9a','19953893@mail.com',NULL,NULL,'','','','','','',863),('983af620-5e1c-11ea-a74f-929740789a9a','Faisol','Afrado ','HKEPC.1743',11,'L',1,9,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1743@mail.com',NULL,NULL,'','','','','','',864),('983bba42-5e1c-11ea-a74f-929740789a9a','Davy','Bungaran Parlindungan N. ','HKEPC.1895',11,'L',1,10,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1895@mail.com',NULL,NULL,'','','','','','',865),('983c6aa0-5e1c-11ea-a74f-929740789a9a','Slamet','Supriyono ','2.703.253',18,'L',1,79,'982ad9de-5e1c-11ea-a74f-929740789a9a','slamet.supriyono@hutamakarya.com',NULL,NULL,'','','','','','',866),('983d56a4-5e1c-11ea-a74f-929740789a9a','Nindyonawi','Pradipto ','KD18.9659',11,'L',1,12,'983c6aa0-5e1c-11ea-a74f-929740789a9a','KD189659@mail.com',NULL,NULL,'','','','','','',867),('983defa6-5e1c-11ea-a74f-929740789a9a','Dewi','Setyo Utami ','HKEPC.1419',13,'P',1,13,'983c6aa0-5e1c-11ea-a74f-929740789a9a','HKEPC1419@mail.com',NULL,NULL,'','','','','','',868),('983e9ab4-5e1c-11ea-a74f-929740789a9a','Yudha','Prastawa Armando ','19.933.894',11,'L',1,12,'983c6aa0-5e1c-11ea-a74f-929740789a9a','19933894@mail.com',NULL,NULL,'','','','','','',869),('983f326c-5e1c-11ea-a74f-929740789a9a','F','Suyadi ','HKEPC.1752',11,'L',1,13,'983c6aa0-5e1c-11ea-a74f-929740789a9a','HKEPC1752@mail.com',NULL,NULL,'','','','','','',870),('98405f3e-5e1c-11ea-a74f-929740789a9a','Romaki','','HKEPC.1522',13,'L',1,14,'983c6aa0-5e1c-11ea-a74f-929740789a9a','HKEPC1522@mail.com',NULL,NULL,'','','','','','',871),('98413b2a-5e1c-11ea-a74f-929740789a9a','Boy','Alfredo Pangaribuan ','HKEPC.1894',11,'L',1,14,'983c6aa0-5e1c-11ea-a74f-929740789a9a','HKEPC1894@mail.com',NULL,NULL,'','','','','','',872),('98420b7c-5e1c-11ea-a74f-929740789a9a','Muhammad','Nur Ardian ','KD18.9635',11,'L',1,14,'983c6aa0-5e1c-11ea-a74f-929740789a9a','KD189635@mail.com',NULL,NULL,'','','','','','',873),('9842cc42-5e1c-11ea-a74f-929740789a9a','Pratama','Eka Putra Sijabat ','KD19.9802',11,'L',1,14,'983c6aa0-5e1c-11ea-a74f-929740789a9a','KD199802@mail.com',NULL,NULL,'','','','','','',874),('98448f64-5e1c-11ea-a74f-929740789a9a','Teja','Kusuma ','13.883.537',13,'L',1,15,'983c6aa0-5e1c-11ea-a74f-929740789a9a','13883537@mail.com',NULL,NULL,'','','','','','',875),('98457b04-5e1c-11ea-a74f-929740789a9a','Jefri','Piradipta Suharno ','14.893.601',13,'L',1,80,'983c6aa0-5e1c-11ea-a74f-929740789a9a','14893601@mail.com',NULL,NULL,'','','','','','',876),('984644c6-5e1c-11ea-a74f-929740789a9a','Cahya','Surya Hutama ','KD18.9588',11,'L',1,15,'983c6aa0-5e1c-11ea-a74f-929740789a9a','KD189588@mail.com',NULL,NULL,'','','','','','',877),('9846e066-5e1c-11ea-a74f-929740789a9a','Zuniar','Ahmad ','KD18.9643',11,'L',1,15,'983c6aa0-5e1c-11ea-a74f-929740789a9a','KD189643@mail.com',NULL,NULL,'','','','','','',878),('9847de8a-5e1c-11ea-a74f-929740789a9a','Velix','Setiawan Sirait ','KD18.9589',11,'L',1,15,'983c6aa0-5e1c-11ea-a74f-929740789a9a','KD189589@mail.com',NULL,NULL,'','','','','','',879),('9848a964-5e1c-11ea-a74f-929740789a9a','Susilo','Wardono ','93.722.989',15,'L',1,16,'983c6aa0-5e1c-11ea-a74f-929740789a9a','93722989@mail.com',NULL,NULL,'','','','','','',880),('98494626-5e1c-11ea-a74f-929740789a9a','Tulus','Triandang Sasmita ','HKEPC.1521',11,'L',1,13,'983c6aa0-5e1c-11ea-a74f-929740789a9a','HKEPC1521@mail.com',NULL,NULL,'','','','','','',881),('9849f9ea-5e1c-11ea-a74f-929740789a9a','M.','Yani ','HKEPC.1766',11,'L',1,13,'983c6aa0-5e1c-11ea-a74f-929740789a9a','HKEPC1766@mail.com',NULL,NULL,'','','','','','',882),('984aa32c-5e1c-11ea-a74f-929740789a9a','Ary','Zulianto ','HKEPC.1755',11,'L',1,13,'983c6aa0-5e1c-11ea-a74f-929740789a9a','HKEPC1755@mail.com',NULL,NULL,'','','','','','',883),('984b7720-5e1c-11ea-a74f-929740789a9a','Wira','Prakasa ','HKEPC.1765',11,'L',1,13,'983c6aa0-5e1c-11ea-a74f-929740789a9a','HKEPC1765@mail.com',NULL,NULL,'','','','','','',884),('984c1db0-5e1c-11ea-a74f-929740789a9a','Iedi','Fitriadi ','HKEPC.1904',11,'L',1,13,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1904@mail.com',NULL,NULL,'','','','','','',885),('984cf654-5e1c-11ea-a74f-929740789a9a','Rio','Arif Rahman ','HKEPC.1905',11,'L',1,13,'983c6aa0-5e1c-11ea-a74f-929740789a9a','HKEPC1905@mail.com',NULL,NULL,'','','','','','',886),('984db012-5e1c-11ea-a74f-929740789a9a','Handri','Puri Purwadi ','HKEPC.1907',11,'L',1,13,'983c6aa0-5e1c-11ea-a74f-929740789a9a','HKEPC1907@mail.com',NULL,NULL,'','','','','','',887),('984e9306-5e1c-11ea-a74f-929740789a9a','Dody','Dewanto ','95.703.095',18,'L',1,81,'982ad9de-5e1c-11ea-a74f-929740789a9a','dody.dewanto@hutamakarya.com',NULL,NULL,'','','','','','',888),('9850236a-5e1c-11ea-a74f-929740789a9a','Antonius','Satrio Budi Nugroho ','17.943.805',11,'L',1,17,'983c6aa0-5e1c-11ea-a74f-929740789a9a','17943805@mail.com',NULL,NULL,'','','','','','',889),('9850baf0-5e1c-11ea-a74f-929740789a9a','Muhammad','Ridwan Darmawan ','10.793.437',12,'L',1,17,'983c6aa0-5e1c-11ea-a74f-929740789a9a','10793437@mail.com',NULL,NULL,'','','','','','',890),('985130d4-5e1c-11ea-a74f-929740789a9a','Irwan','Prabowo ','HKEPC.1896',11,'L',1,18,'983c6aa0-5e1c-11ea-a74f-929740789a9a','HKEPC1896@mail.com',NULL,NULL,'','','','','','',891),('9851f352-5e1c-11ea-a74f-929740789a9a','Putri','Amalia Ramadhani ','HKEPC.1906',11,'P',1,17,'983c6aa0-5e1c-11ea-a74f-929740789a9a','HKEPC1906@mail.com',NULL,NULL,'','','','','','',892),('9852b1c0-5e1c-11ea-a74f-929740789a9a','Dadi','Suprapto ','95.713.099',19,'L',1,82,'982ad9de-5e1c-11ea-a74f-929740789a9a','dadi.suprapto@hutamakarya.com',NULL,NULL,'','','','','','',893),('98538b90-5e1c-11ea-a74f-929740789a9a','Hari','Wahyudi ','13.883.546',13,'L',1,19,'983c6aa0-5e1c-11ea-a74f-929740789a9a','13883546@mail.com',NULL,NULL,'','','','','','',894),('9854a782-5e1c-11ea-a74f-929740789a9a','Yanuar','Tri Wibowo, ST ','11.873.466',16,'L',1,20,'983c6aa0-5e1c-11ea-a74f-929740789a9a','11873466@mail.com',NULL,NULL,'','','','','','',895),('98556d20-5e1c-11ea-a74f-929740789a9a','Gema','Alfajri ','KD18.9609',11,'L',1,75,'983c6aa0-5e1c-11ea-a74f-929740789a9a','KD189609@mail.com',NULL,NULL,'','','','','','',896),('98560b90-5e1c-11ea-a74f-929740789a9a','Resi','Ayu Agettis ','KD19.9807',11,'P',1,21,'983c6aa0-5e1c-11ea-a74f-929740789a9a','KD199807@mail.com',NULL,NULL,'','','','','','',897),('9856ec40-5e1c-11ea-a74f-929740789a9a','Warjo','','5.753.284',18,'L',1,83,'982ad9de-5e1c-11ea-a74f-929740789a9a','warjo.fadillah@hutamakarya.com',NULL,NULL,'','','','','','',898),('9857bf8a-5e1c-11ea-a74f-929740789a9a','Astuti','','18.923.825',13,'P',1,84,'983c6aa0-5e1c-11ea-a74f-929740789a9a','18923825@mail.com',NULL,NULL,'','','','','','',899),('9858c664-5e1c-11ea-a74f-929740789a9a','Muhammad','Fikry Alfisyahrin ','KD19.9791',11,'L',1,22,'983c6aa0-5e1c-11ea-a74f-929740789a9a','KD199791@mail.com',NULL,NULL,'','','','','','',900),('9859a78c-5e1c-11ea-a74f-929740789a9a','Widya','Chandra Wiguna ','HKEPC.1905',11,'L',1,22,'983c6aa0-5e1c-11ea-a74f-929740789a9a','HKEPC1905@mail.com',NULL,NULL,'','','','','','',901),('985a628a-5e1c-11ea-a74f-929740789a9a','Ichsan','Chairudin ','HKEPC.1764',11,'L',1,13,'983c6aa0-5e1c-11ea-a74f-929740789a9a','HKEPC1764@mail.com',NULL,NULL,'','','','','','',902),('985b36c4-5e1c-11ea-a74f-929740789a9a','Tri','Handoko ','1182,3446',18,'L',1,85,'982ad9de-5e1c-11ea-a74f-929740789a9a','tri.handoko@hutamakarya.com',NULL,NULL,'','','','','','',903),('985c726e-5e1c-11ea-a74f-929740789a9a','Septiadi','Putranto ','HKEPC.1525',12,'L',1,25,'985b36c4-5e1c-11ea-a74f-929740789a9a','HKEPC1525@mail.com',NULL,NULL,'','','','','','',904),('985d7f56-5e1c-11ea-a74f-929740789a9a','Vega','Alberta ','KD18.9613',11,'L',1,25,'985b36c4-5e1c-11ea-a74f-929740789a9a','KD189613@mail.com',NULL,NULL,'','','','','','',905),('985e7596-5e1c-11ea-a74f-929740789a9a','Nabila','Hajar Aflaha ','KD19.9795',11,'P',1,26,'985b36c4-5e1c-11ea-a74f-929740789a9a','KD199795@mail.com',NULL,NULL,'','','','','','',906),('985f50e2-5e1c-11ea-a74f-929740789a9a','Anggara','Oka Primanda ','HKEPC.1754',11,'L',1,25,'985b36c4-5e1c-11ea-a74f-929740789a9a','HKEPC1754@mail.com',NULL,NULL,'','','','','','',907),('98604272-5e1c-11ea-a74f-929740789a9a','Heru','Haryadi ','18.933.849',11,'L',1,26,'985b36c4-5e1c-11ea-a74f-929740789a9a','18933849@mail.com',NULL,NULL,'','','','','','',908),('986248f6-5e1c-11ea-a74f-929740789a9a','Titik','Yuli Lestari ','93.653.206',12,'L',1,26,'985b36c4-5e1c-11ea-a74f-929740789a9a','93653206@mail.com',NULL,NULL,'','','','','','',909),('9865fce4-5e1c-11ea-a74f-929740789a9a','Kuncoro','Aji Kusrianto ','KD19.9781',11,'L',1,26,'985b36c4-5e1c-11ea-a74f-929740789a9a','KD199781@mail.com',NULL,NULL,'','','','','','',910),('9867074c-5e1c-11ea-a74f-929740789a9a','Mar','Atus Sholeha ','HKEPC.1746',11,'P',1,27,'985b36c4-5e1c-11ea-a74f-929740789a9a','HKEPC1746@mail.com',NULL,NULL,'','','','','','',911),('9867be8a-5e1c-11ea-a74f-929740789a9a','Abdul','Nasir ','HKEPC.1888',11,'L',1,28,'985b36c4-5e1c-11ea-a74f-929740789a9a','HKEPC1888@mail.com',NULL,NULL,'','','','','','',912),('98685700-5e1c-11ea-a74f-929740789a9a','Novalina','Hanawati ','13.893.578',13,'P',1,29,'985b36c4-5e1c-11ea-a74f-929740789a9a','13893578@mail.com',NULL,NULL,'','','','','','',913),('98690510-5e1c-11ea-a74f-929740789a9a','Khusain','Munawir ','KD19.9779',11,'L',1,86,'985b36c4-5e1c-11ea-a74f-929740789a9a','kd199779@mail.com','',NULL,'','','','','','',914),('9869ce6e-5e1c-11ea-a74f-929740789a9a','Abednego','Noelandri Silitonga ','13.893.495',13,'L',1,87,'982ad9de-5e1c-11ea-a74f-929740789a9a','13893495@mail.com',NULL,NULL,'','','','','','',915),('986a7b98-5e1c-11ea-a74f-929740789a9a','Delfi','Lumonang ','15.703.713',13,'L',1,32,'982ad9de-5e1c-11ea-a74f-929740789a9a','15703713@mail.com',NULL,NULL,'','','','','','',916),('986bcda4-5e1c-11ea-a74f-929740789a9a','Jumiyati','','95.722.877',10,'P',1,88,'982ad9de-5e1c-11ea-a74f-929740789a9a','95722877@mail.com',NULL,NULL,'','','','','','',917),('986c6ff2-5e1c-11ea-a74f-929740789a9a','Jwantoro','','19.953.896',11,'L',1,13,'982ad9de-5e1c-11ea-a74f-929740789a9a','19953896@mail.com',NULL,NULL,'','','','','','',918),('986d1858-5e1c-11ea-a74f-929740789a9a','Muhammad','Ekky Gigih Prakoso ','14.913.642',14,'L',1,34,'982ad9de-5e1c-11ea-a74f-929740789a9a','14913642@mail.com',NULL,NULL,'','','','','','',919),('986dd964-5e1c-11ea-a74f-929740789a9a','Noor','Said ','7.793.311',16,'L',1,89,'982ad9de-5e1c-11ea-a74f-929740789a9a','07793311@mail.com',NULL,NULL,'','','','','','',920),('986eac04-5e1c-11ea-a74f-929740789a9a','Saddam','Pradika ','14.913.609',13,'L',1,36,'982ad9de-5e1c-11ea-a74f-929740789a9a','14913609@mail.com',NULL,NULL,'','','','','','',921),('986f8926-5e1c-11ea-a74f-929740789a9a','Subari','','92.682.844',15,'L',1,45,'982ad9de-5e1c-11ea-a74f-929740789a9a','92682844@mail.com',NULL,NULL,'','','','','','',922),('987074a8-5e1c-11ea-a74f-929740789a9a','Yanwar','Eko Prasetyo ','16.923.739',12,'L',1,31,'982ad9de-5e1c-11ea-a74f-929740789a9a','16923739@mail.com',NULL,NULL,'','','','','','',923),('987110e8-5e1c-11ea-a74f-929740789a9a','Sakka','','15.723.714',14,'L',1,38,'982ad9de-5e1c-11ea-a74f-929740789a9a','15723714@mail.com',NULL,NULL,'','','','','','',924),('9871bf5c-5e1c-11ea-a74f-929740789a9a','Wisnu','Probowaskito ','15.713.707',15,'L',1,39,'982ad9de-5e1c-11ea-a74f-929740789a9a','15713707@mail.com',NULL,NULL,'','','','','','',925),('9872573c-5e1c-11ea-a74f-929740789a9a','Furqon','Adi Bastanta ','KD19.9765',11,'L',1,40,'982ad9de-5e1c-11ea-a74f-929740789a9a','KD199765@mail.com',NULL,NULL,'','','','','','',926),('98735af6-5e1c-11ea-a74f-929740789a9a','Weriansyah','Putra ','HKEPC.1634',11,'L',1,41,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1634@mail.com',NULL,NULL,'','','','','','',927),('9873fd6c-5e1c-11ea-a74f-929740789a9a','Hamzah','','HKEPC.1739',11,'L',1,19,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1739@mail.com',NULL,NULL,'','','','','','',928),('98749ccc-5e1c-11ea-a74f-929740789a9a','Hasanuddin','','HKEPC.1740',11,'L',1,19,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1740@mail.com',NULL,NULL,'','','','','','',929),('98755806-5e1c-11ea-a74f-929740789a9a','Dito','Narendra ','HKEPC.1741',11,'L',1,13,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1741@mail.com',NULL,NULL,'','','','','','',930),('9875faa4-5e1c-11ea-a74f-929740789a9a','Marshal','Tarlini ','HKEPC.1756',11,'L',1,42,'98346b70-5e1c-11ea-a74f-929740789a9a','HKEPC1756@mail.com',NULL,NULL,'','','','','','',931),('9876b214-5e1c-11ea-a74f-929740789a9a','Firman','Endarko ','HKEPC.1891',11,'L',1,43,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1891@mail.com',NULL,NULL,'','','','','','',932),('98776164-5e1c-11ea-a74f-929740789a9a','Gilang','Satrio ','16.923.749',13,'L',1,44,'982ad9de-5e1c-11ea-a74f-929740789a9a','16923749@mail.com',NULL,NULL,'','','','','','',933),('9878955c-5e1c-11ea-a74f-929740789a9a','Mohamad','Sodikin ','KD18.9624',11,'L',1,25,'982ad9de-5e1c-11ea-a74f-929740789a9a','KD189624@mail.com',NULL,NULL,'','','','','','',934),('98795e7e-5e1c-11ea-a74f-929740789a9a','Arnold','Sitanggang ','HKEPC.1887',13,'L',1,45,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1887@mail.com',NULL,NULL,'','','','','','',935),('987a1a94-5e1c-11ea-a74f-929740789a9a','Adhitya','Budi Nugraha ','18.923.857',12,'L',1,13,'982ad9de-5e1c-11ea-a74f-929740789a9a','18923857@mail.com',NULL,NULL,'','','','','','',936),('987ac41c-5e1c-11ea-a74f-929740789a9a','Aruna','Dwitya Putra ','15.893.664',13,'L',1,34,'982ad9de-5e1c-11ea-a74f-929740789a9a','15893664@mail.com',NULL,NULL,'','','','','','',937),('987b8cf8-5e1c-11ea-a74f-929740789a9a','Febri','Chrishardiyan ','13883552',14,'L',1,46,'982ad9de-5e1c-11ea-a74f-929740789a9a','13883552@mail.com',NULL,NULL,'','','','','','',938),('987c0c50-5e1c-11ea-a74f-929740789a9a','Hendry','Gunawan ','18.933.847',11,'L',1,47,'982ad9de-5e1c-11ea-a74f-929740789a9a','18933847@mail.com',NULL,NULL,'','','','','','',939),('987ce71a-5e1c-11ea-a74f-929740789a9a','Herri','Indrianto ','9.823.374',17,'L',1,89,'982ad9de-5e1c-11ea-a74f-929740789a9a','09823374@mail.com',NULL,NULL,'','','','','','',940),('987dbdde-5e1c-11ea-a74f-929740789a9a','Mario','Panuttra Santoso ','16.923.741',13,'L',1,49,'982ad9de-5e1c-11ea-a74f-929740789a9a','16923741@mail.com',NULL,NULL,'','','','','','',941),('987e5fd2-5e1c-11ea-a74f-929740789a9a','Rokhmad','Joni Catur Utomo ','13.913.568',13,'L',1,50,'982ad9de-5e1c-11ea-a74f-929740789a9a','13913568@mail.com',NULL,NULL,'','','','','','',942),('987eec86-5e1c-11ea-a74f-929740789a9a','Agus','Prabowo ','HKEPC.1889',11,'L',1,90,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1889@mail.com',NULL,NULL,'','','','','','',943),('987f9906-5e1c-11ea-a74f-929740789a9a','Ahmad','Abdullah Sibali ','5.743.276',18,'L',1,89,'982ad9de-5e1c-11ea-a74f-929740789a9a','05743276@mail.com',NULL,NULL,'','','','','','',944),('98804f18-5e1c-11ea-a74f-929740789a9a','Cahyo','Aji Nugroho ','14.913.617',14,'L',1,53,'982ad9de-5e1c-11ea-a74f-929740789a9a','14913617@mail.com',NULL,NULL,'','','','','','',945),('988145da-5e1c-11ea-a74f-929740789a9a','Sutrisno','','91.713.156',14,'L',1,91,'982ad9de-5e1c-11ea-a74f-929740789a9a','91713156@mail.com',NULL,NULL,'','','','','','',946),('9882b8ca-5e1c-11ea-a74f-929740789a9a','Dwi','Handoko ','96.723.009',15,'L',1,45,'982ad9de-5e1c-11ea-a74f-929740789a9a','96723009@mail.com',NULL,NULL,'','','','','','',947),('98835ac8-5e1c-11ea-a74f-929740789a9a','I','Made Japasunu ','92.662.635',16,'L',1,16,'982ad9de-5e1c-11ea-a74f-929740789a9a','92662635@mail.com',NULL,NULL,'','','','','','',948),('98841166-5e1c-11ea-a74f-929740789a9a','Iwan','Tjahya Nugroho ','10.823.407',15,'L',1,54,'982ad9de-5e1c-11ea-a74f-929740789a9a','10823407@mail.com',NULL,NULL,'','','','','','',949),('9884c25a-5e1c-11ea-a74f-929740789a9a','Jody','Askabul Mokoagow ','9.783.363',15,'L',1,55,'982ad9de-5e1c-11ea-a74f-929740789a9a','09783363@mail.com',NULL,NULL,'','','','','','',950),('9885685e-5e1c-11ea-a74f-929740789a9a','Muhammad','Faizal ','18.943.813',13,'L',1,92,'982ad9de-5e1c-11ea-a74f-929740789a9a','18943813@mail.com',NULL,NULL,'','','','','','',951),('9886636c-5e1c-11ea-a74f-929740789a9a','Sungkowo','Wahyu Santoso ','13.883.487',15,'L',1,56,'982ad9de-5e1c-11ea-a74f-929740789a9a','13883487@mail.com',NULL,NULL,'','','','','','',952),('98872428-5e1c-11ea-a74f-929740789a9a','I','Made Widana ','93.723.147',10,'L',1,57,'982ad9de-5e1c-11ea-a74f-929740789a9a','93723147@mail.com',NULL,NULL,'','','','','','',953),('9887cf36-5e1c-11ea-a74f-929740789a9a','Zulkarnaen','','7.773.319',12,'L',1,70,'982ad9de-5e1c-11ea-a74f-929740789a9a','07773319@mail.com',NULL,NULL,'','','','','','',954),('98887f62-5e1c-11ea-a74f-929740789a9a','Khasan','Mustofa ','KD18.9625',11,'L',1,12,'982ad9de-5e1c-11ea-a74f-929740789a9a','KD189625@mail.com',NULL,NULL,'','','','','','',955),('9889352e-5e1c-11ea-a74f-929740789a9a','Lydia','Tiara ','KD18.9593',11,'P',1,13,'982ad9de-5e1c-11ea-a74f-929740789a9a','KD189593@mail.com',NULL,NULL,'','','','','','',956),('988a0486-5e1c-11ea-a74f-929740789a9a','Widhi','Ahmad Wicaksono ','KD18.9600',11,'L',1,58,'982ad9de-5e1c-11ea-a74f-929740789a9a','KD189600@mail.com',NULL,NULL,'','','','','','',957),('988ab534-5e1c-11ea-a74f-929740789a9a','Harry','J. Pangaribuan ','KD18.9615',11,'L',1,13,'982ad9de-5e1c-11ea-a74f-929740789a9a','KD189615@mail.com',NULL,NULL,'','','','','','',958),('988b6970-5e1c-11ea-a74f-929740789a9a','Musthafa','Abdur Rosyied ','KD18.9632',11,'L',1,13,'982ad9de-5e1c-11ea-a74f-929740789a9a','KD189632@mail.com',NULL,NULL,'','','','','','',959),('988c30c6-5e1c-11ea-a74f-929740789a9a','Muhammad','Irfan Baharuddin ','16.913.755',13,'L',1,36,'982ad9de-5e1c-11ea-a74f-929740789a9a','16913755@mail.com',NULL,NULL,'','','','','','',960),('988cc838-5e1c-11ea-a74f-929740789a9a','Adeline','Larisa ','KD18.9611',11,'P',1,13,'982ad9de-5e1c-11ea-a74f-929740789a9a','KD189611@mail.com',NULL,NULL,'','','','','','',961),('988d533e-5e1c-11ea-a74f-929740789a9a','Muhammad','Fajri ','KD19.9790',11,'L',1,59,'982ad9de-5e1c-11ea-a74f-929740789a9a','KD199790@mail.com',NULL,NULL,'','','','','','',962),('988dfd3e-5e1c-11ea-a74f-929740789a9a','Muhaidir','','HKEPC.1876',11,'L',1,60,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1876@mail.com',NULL,NULL,'','','','','','',963),('988ebc6a-5e1c-11ea-a74f-929740789a9a','Rizalman','Syaid ','HKEPC.1890',11,'L',1,43,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1890@mail.com',NULL,NULL,'','','','','','',964),('988f9ad6-5e1c-11ea-a74f-929740789a9a','Alamsyah','','15.853.710',16,'L',1,89,'982ad9de-5e1c-11ea-a74f-929740789a9a','15853710@mail.com',NULL,NULL,'','','','','','',965),('989054e4-5e1c-11ea-a74f-929740789a9a','I','Gusti Ngurah Ananda ','88.682.449',13,'L',1,43,'982ad9de-5e1c-11ea-a74f-929740789a9a','88682449@mail.com',NULL,NULL,'','','','','','',966),('9890cc44-5e1c-11ea-a74f-929740789a9a','Indra','Nugraha ','18.933.829',12,'L',1,13,'982ad9de-5e1c-11ea-a74f-929740789a9a','18933829@mail.com',NULL,NULL,'','','','','','',967),('98915b1e-5e1c-11ea-a74f-929740789a9a','Rendy','Yoel Laguna ','12.843.474',15,'L',1,34,'982ad9de-5e1c-11ea-a74f-929740789a9a','12843474@mail.com',NULL,NULL,'','','','','','',968),('98924876-5e1c-11ea-a74f-929740789a9a','David','Akbar Pratama ','KD19.9740',11,'L',1,59,'982ad9de-5e1c-11ea-a74f-929740789a9a','KD199740@mail.com',NULL,NULL,'','','','','','',969),('989314f4-5e1c-11ea-a74f-929740789a9a','Sugeng','','HKEPC.',11,'L',1,45,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC@mail.com',NULL,NULL,'','','','','','',970),('9893c9ee-5e1c-11ea-a74f-929740789a9a','Djefry','Karepoan ','HKEPC.1893',11,'L',1,62,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1893@mail.com',NULL,NULL,'','','','','','',971),('989482a8-5e1c-11ea-a74f-929740789a9a','Arie','Garuda Satrio ','13.893.497',13,'L',1,44,'982ad9de-5e1c-11ea-a74f-929740789a9a','13893497@mail.com',NULL,NULL,'','','','','','',972),('98953edc-5e1c-11ea-a74f-929740789a9a','Pucheng','Purba ','9.803.355',16,'L',1,89,'982ad9de-5e1c-11ea-a74f-929740789a9a','09803355@mail.com',NULL,NULL,'','','','','','',973),('9895ddba-5e1c-11ea-a74f-929740789a9a','Brian','Primaharjan ','16.933.783',13,'L',1,45,'982ad9de-5e1c-11ea-a74f-929740789a9a','16933783@mail.com',NULL,NULL,'','','','','','',974),('9896d90e-5e1c-11ea-a74f-929740789a9a','Brasta','Diyu Wasesa ','KD18.9603',11,'L',1,13,'982ad9de-5e1c-11ea-a74f-929740789a9a','KD189603@mail.com',NULL,NULL,'','','','','','',975),('98979402-5e1c-11ea-a74f-929740789a9a','Danang','Ariswanto ','HKEPC.1758',11,'L',1,62,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1758@mail.com',NULL,NULL,'','','','','','',976),('98984c80-5e1c-11ea-a74f-929740789a9a','Endro','Suwasono ','HKEPC.1882',11,'L',1,62,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1882@mail.com',NULL,NULL,'','','','','','',977),('9898f6a8-5e1c-11ea-a74f-929740789a9a','Prakoso','Adhitya R.E.N. ','14.883.594',13,'L',1,93,'982ad9de-5e1c-11ea-a74f-929740789a9a','14883594@mail.com',NULL,NULL,'','','','','','',978),('9899a3dc-5e1c-11ea-a74f-929740789a9a','Septesen','Nababan ','14.883.631',15,'L',1,89,'982ad9de-5e1c-11ea-a74f-929740789a9a','14883631@mail.com',NULL,NULL,'','','','','','',979),('989a5e76-5e1c-11ea-a74f-929740789a9a','Nur','Rahman Alhamidi ','KD18.9616',11,'L',1,13,'982ad9de-5e1c-11ea-a74f-929740789a9a','KD189616@mail.com',NULL,NULL,'','','','','','',980),('989b3bd4-5e1c-11ea-a74f-929740789a9a','Timbul','Martua ','HKEPC.1877',11,'L',1,94,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1877@mail.com',NULL,NULL,'','','','','','',981),('989bd6d4-5e1c-11ea-a74f-929740789a9a','Muhammad','Nusri ','90.642.981',15,'L',1,45,'982ad9de-5e1c-11ea-a74f-929740789a9a','90642981@mail.com',NULL,NULL,'','','','','','',982),('989c8200-5e1c-11ea-a74f-929740789a9a','Sukandi','Samatan ','9.763.387',15,'L',1,89,'982ad9de-5e1c-11ea-a74f-929740789a9a','09763387@mail.com',NULL,NULL,'','','','','','',983),('989d770a-5e1c-11ea-a74f-929740789a9a','Agus','Surya Negara ','10.833.432',15,'L',1,45,'982ad9de-5e1c-11ea-a74f-929740789a9a','10833432@mail.com',NULL,NULL,'','','','','','',984),('989e888e-5e1c-11ea-a74f-929740789a9a','Bagus','Bayu Nugraha ','14.903.613',13,'L',1,40,'982ad9de-5e1c-11ea-a74f-929740789a9a','14903613@mail.com',NULL,NULL,'','','','','','',985),('989f3306-5e1c-11ea-a74f-929740789a9a','Bayu','Warianto ','6.783.285',15,'L',1,89,'982ad9de-5e1c-11ea-a74f-929740789a9a','06783285@mail.com',NULL,NULL,'','','','','','',986),('989fe5d0-5e1c-11ea-a74f-929740789a9a','Bisri','Subakir ','88.692.517',18,'L',1,52,'982ad9de-5e1c-11ea-a74f-929740789a9a','88692517@mail.com',NULL,NULL,'','','','','','',987),('98a0a6fa-5e1c-11ea-a74f-929740789a9a','Dony','Afi Hardono ','10833406',16,'L',1,39,'982ad9de-5e1c-11ea-a74f-929740789a9a','10833406@mail.com',NULL,NULL,'','','','','','',988),('98a14f56-5e1c-11ea-a74f-929740789a9a','Martin','Martunas Agung P.S ','15.913.675',13,'L',1,65,'982ad9de-5e1c-11ea-a74f-929740789a9a','15913675@mail.com',NULL,NULL,'','','','','','',989),('98a20dc4-5e1c-11ea-a74f-929740789a9a','Mirza','','13.873.543',14,'L',1,34,'982ad9de-5e1c-11ea-a74f-929740789a9a','13873543@mail.com',NULL,NULL,'','','','','','',990),('98a2cbb0-5e1c-11ea-a74f-929740789a9a','Muslimin','','8865,2448',15,'L',1,66,'982ad9de-5e1c-11ea-a74f-929740789a9a','8865,2448@mail.com',NULL,NULL,'','','','','','',991),('98a38a5a-5e1c-11ea-a74f-929740789a9a','Nanang','Hendro S ','90.702.632',15,'L',1,67,'982ad9de-5e1c-11ea-a74f-929740789a9a','90702632@mail.com',NULL,NULL,'','','','','','',992),('98a43cde-5e1c-11ea-a74f-929740789a9a','Priyandi','Murwandono ','16.923.744',13,'L',1,68,'982ad9de-5e1c-11ea-a74f-929740789a9a','16923744@mail.com',NULL,NULL,'','','','','','',993),('98a5aa38-5e1c-11ea-a74f-929740789a9a','Dica','Rasyid Maulidhani ','KD18.9592',11,'L',1,13,'982ad9de-5e1c-11ea-a74f-929740789a9a','KD189592@mail.com',NULL,NULL,'','','','','','',994),('98a6cea4-5e1c-11ea-a74f-929740789a9a','Rizky','Andhika ','KD19.9810',11,'L',1,59,'982ad9de-5e1c-11ea-a74f-929740789a9a','KD199810@mail.com',NULL,NULL,'','','','','','',995),('98a7ea6e-5e1c-11ea-a74f-929740789a9a','Hestu','Saptoadi ','HKEPC.1762',11,'L',1,62,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1762@mail.com',NULL,NULL,'','','','','','',996),('98a8b7fa-5e1c-11ea-a74f-929740789a9a','Ettim','Dwi Yoga ','15.803.711',13,'L',1,95,'982ad9de-5e1c-11ea-a74f-929740789a9a','15803711@mail.com',NULL,NULL,'','','','','','',997),('98a95b24-5e1c-11ea-a74f-929740789a9a','Tirda','Rizki Santoso ','13.903.565',14,'L',1,34,'982ad9de-5e1c-11ea-a74f-929740789a9a','13903565@mail.com',NULL,NULL,'','','','','','',998),('98a9e3dc-5e1c-11ea-a74f-929740789a9a','Hardi','Kristanto ','HKEPC.1745',11,'L',1,62,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1745@mail.com',NULL,NULL,'','','','','','',999),('98aab55a-5e1c-11ea-a74f-929740789a9a','Randy','Riza Kurniawan ','11.863.462',16,'L',1,89,'982ad9de-5e1c-11ea-a74f-929740789a9a','11863462@mail.com',NULL,NULL,'','','','','','',1000),('98abbc2a-5e1c-11ea-a74f-929740789a9a','Andi','Kurniawan ','HKEPC.1750',11,'L',1,62,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1750@mail.com',NULL,NULL,'','','','','','',1001),('98ac978a-5e1c-11ea-a74f-929740789a9a','Muhamad','Iqbal Muslim ','HKEPC.1753',11,'L',1,69,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1753@mail.com',NULL,NULL,'','','','','','',1002),('98ad2678-5e1c-11ea-a74f-929740789a9a','Yos','Sutanto ','HKEPC.1763',13,'L',1,62,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1763@mail.com',NULL,NULL,'','','','','','',1003),('98adcea2-5e1c-11ea-a74f-929740789a9a','Rudi','Iryanto ','12.873.475',15,'L',1,89,'982ad9de-5e1c-11ea-a74f-929740789a9a','12873475@mail.com',NULL,NULL,'','','','','','',1004),('98ae8dd8-5e1c-11ea-a74f-929740789a9a','Dwiyoga','Noris Indrawijaya ','13.883.511',13,'L',1,16,'982ad9de-5e1c-11ea-a74f-929740789a9a','13883511@mail.com',NULL,NULL,'','','','','','',1005),('98af4228-5e1c-11ea-a74f-929740789a9a','Arie','Setyo Nugroho ','10.843.422',14,'L',1,43,'982ad9de-5e1c-11ea-a74f-929740789a9a','10843422@mail.com',NULL,NULL,'','','','','','',1006),('98b00992-5e1c-11ea-a74f-929740789a9a','Bayu','Azwar Suryawan ','KD19.9789',11,'L',1,59,'982ad9de-5e1c-11ea-a74f-929740789a9a','KD199789@mail.com',NULL,NULL,'','','','','','',1007),('98b0bdb0-5e1c-11ea-a74f-929740789a9a','Deby','Sumarno ','HKEPC.1749',11,'L',1,45,'982ad9de-5e1c-11ea-a74f-929740789a9a','HKEPC1749@mail.com',NULL,NULL,'','','','','','',1008),('98b15ad6-5e1c-11ea-a74f-929740789a9a','Bambang','Prasetyo ','15.783.705',13,'L',1,93,'982ad9de-5e1c-11ea-a74f-929740789a9a','15783705@mail.com',NULL,NULL,'','','','','','',1009),('98b24806-5e1c-11ea-a74f-929740789a9a','Darmawan','Setyadi ','KD18.9599',11,'L',1,13,'982ad9de-5e1c-11ea-a74f-929740789a9a','KD189599@mail.com',NULL,NULL,'','','','','','',1010),('98b2db72-5e1c-11ea-a74f-929740789a9a','Andrivo','Ferliyan ','KD19.9695',11,'L',1,13,'982ad9de-5e1c-11ea-a74f-929740789a9a','KD199695@mail.com',NULL,NULL,'','','','','','',1011),('98b38644-5e1c-11ea-a74f-929740789a9a','Achmad','Fikri ','11.843.453',14,'L',1,93,'982ad9de-5e1c-11ea-a74f-929740789a9a','11843453@mail.com',NULL,NULL,'','','','','','',1012),('98b3fe9e-5e1c-11ea-a74f-929740789a9a','Daniel','Erlanda ','14.893.633',14,'L',1,34,'982ad9de-5e1c-11ea-a74f-929740789a9a','14893633@mail.com',NULL,NULL,'','','','','','',1013),('98b522e2-5e1c-11ea-a74f-929740789a9a','Dwiarto','Raharjo ','9.813.362',16,'L',1,89,'982ad9de-5e1c-11ea-a74f-929740789a9a','09813362@mail.com',NULL,NULL,'','','','','','',1014),('98b5dc46-5e1c-11ea-a74f-929740789a9a','Betta','Yudhi Setyawan ','13.873.509',13,'L',1,44,'982ad9de-5e1c-11ea-a74f-929740789a9a','13873509@mail.com',NULL,NULL,'','','','','','',1015),('98b69186-5e1c-11ea-a74f-929740789a9a','Ivone','Fabiola N. Depari ','KD19.9777',11,'P',1,13,'982ad9de-5e1c-11ea-a74f-929740789a9a','KD199777@mail.com',NULL,NULL,'','','','','','',1016),('98b73e38-5e1c-11ea-a74f-929740789a9a','Kevin','Andrea ','KD18.9681',11,'L',1,22,'982ad9de-5e1c-11ea-a74f-929740789a9a','KD189681@mail.com',NULL,NULL,'','','','','','',1017),('98b8273a-5e1c-11ea-a74f-929740789a9a','Ridwan','Setia Prihatna ','10.793.437',11,'L',1,13,'982ad9de-5e1c-11ea-a74f-929740789a9a','10793437@mail.com',NULL,NULL,'','','','','','',1018);
/*!40000 ALTER TABLE `master_employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_golongan`
--

DROP TABLE IF EXISTS `master_golongan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `master_golongan` (
  `id_master_golongan` int NOT NULL AUTO_INCREMENT,
  `golongan_name` varchar(45) DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT NULL,
  `id_group` smallint DEFAULT NULL,
  PRIMARY KEY (`id_master_golongan`)
) ENGINE=InnoDB AUTO_INCREMENT=22;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_golongan`
--

LOCK TABLES `master_golongan` WRITE;
/*!40000 ALTER TABLE `master_golongan` DISABLE KEYS */;
INSERT INTO `master_golongan` VALUES (1,'1',0,5),(2,'2',0,5),(3,'3',0,4),(4,'4',0,3),(5,'5',0,3),(6,'6',0,3),(7,'7',0,3),(8,'8',0,3),(9,'9',0,2),(10,'10',0,4),(11,'11',0,4),(12,'12',0,4),(13,'13',0,7),(14,'14',0,7),(15,'15',0,7),(16,'16',0,3),(17,'17',0,3),(18,'18',0,2),(19,'19',0,2),(20,'20',0,1),(21,'21',0,1);
/*!40000 ALTER TABLE `master_golongan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_group_golongan`
--

DROP TABLE IF EXISTS `master_group_golongan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `master_group_golongan` (
  `id_master_group_golongan` int NOT NULL AUTO_INCREMENT,
  `alias` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `group_gol_name` varchar(45) DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT '0',
  `rangkin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_master_group_golongan`)
) ENGINE=InnoDB AUTO_INCREMENT=8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_group_golongan`
--

LOCK TABLES `master_group_golongan` WRITE;
/*!40000 ALTER TABLE `master_group_golongan` DISABLE KEYS */;
INSERT INTO `master_group_golongan` VALUES (1,'PRO III',NULL,'Profesional 3',0,1),(2,'PRO II',NULL,'Profesional 2',0,2),(3,'PRO I',NULL,'Profesional 1',0,3),(4,'PRA II',NULL,'Pratama 2',0,5),(5,'PRA I',NULL,'Pratama 1',0,6),(6,'Karyawan Tidak Tetap',NULL,'Karyawan Tidak Tetap',0,7),(7,'PRA III',NULL,'Pratama 3',0,4);
/*!40000 ALTER TABLE `master_group_golongan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_holiday`
--

DROP TABLE IF EXISTS `master_holiday`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `master_holiday` (
  `national` blob,
  `office` blob,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_holiday`
--

LOCK TABLES `master_holiday` WRITE;
/*!40000 ALTER TABLE `master_holiday` DISABLE KEYS */;
INSERT INTO `master_holiday` VALUES (_binary '{\n    \"20180101\": {\n        \"deskripsi\": \"Hari Tahun Baru\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180216\": {\n        \"deskripsi\": \"Tahun Baru Imlek\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180317\": {\n        \"deskripsi\": \"Hari Raya Nyepi (Tahun Baru Saka)\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180330\": {\n        \"deskripsi\": \"Wafat Isa Almasih\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180401\": {\n        \"deskripsi\": \"Hari Paskah\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180414\": {\n        \"deskripsi\": \"Isra Mi\'raj Nabi Muhammad\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180501\": {\n        \"deskripsi\": \"Hari Buruh Internasional/Pekerja\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180510\": {\n        \"deskripsi\": \"Kenaikan Yesus Kristus\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180529\": {\n        \"deskripsi\": \"Hari Raya Waisak\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180601\": {\n        \"deskripsi\": \"Hari Lahir Pancasila\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180611\": {\n        \"deskripsi\": \"Cuti Bersama\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180612\": {\n        \"deskripsi\": \"Cuti Bersama\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180613\": {\n        \"deskripsi\": \"Cuti Bersama\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180614\": {\n        \"deskripsi\": \"Cuti Bersama\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180615\": {\n        \"deskripsi\": \"Idul Fitri (Lebaran Mudik)\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180616\": {\n        \"deskripsi\": \"Idul Fitri (Lebaran Mudik)\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180618\": {\n        \"deskripsi\": \"Cuti Bersama\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180619\": {\n        \"deskripsi\": \"Cuti Bersama\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180620\": {\n        \"deskripsi\": \"Cuti Bersama\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180627\": {\n        \"deskripsi\": \"Pilkada Serentak\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180817\": {\n        \"deskripsi\": \"Hari Proklamasi Kemerdekaan R.I.\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180822\": {\n        \"deskripsi\": \"Idul Adha (Lebaran Haji)\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20180911\": {\n        \"deskripsi\": \"Satu Muharam/Tahun Baru Hijriyah\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20181107\": {\n        \"deskripsi\": \"Diwali/Deepavali\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20181120\": {\n        \"deskripsi\": \"Maulid Nabi Muhammad\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20181224\": {\n        \"deskripsi\": \"Cuti Bersama (Malam Natal)\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20181225\": {\n        \"deskripsi\": \"Hari Natal\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20181231\": {\n        \"deskripsi\": \"Malam Tahun Baru\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20190101\": {\n        \"deskripsi\": \"Hari Tahun Baru\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20190205\": {\n        \"deskripsi\": \"Tahun Baru Imlek\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20190307\": {\n        \"deskripsi\": \"Hari Raya Nyepi (Tahun Baru Saka)\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20190403\": {\n        \"deskripsi\": \"Isra Mi\'raj Nabi Muhammad\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20190417\": {\n        \"deskripsi\": \"Election Day\",\n        \"dibuat\": \"20190415T232630Z\",\n        \"dimodifikasi\": \"20190415T232630Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20190419\": {\n        \"deskripsi\": \"Wafat Isa Almasih\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20190421\": {\n        \"deskripsi\": \"Hari Paskah\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20190501\": {\n        \"deskripsi\": \"Hari Buruh Internasional/Pekerja\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20190519\": {\n        \"deskripsi\": \"Hari Raya Waisak\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20190530\": {\n        \"deskripsi\": \"Kenaikan Yesus Kristus\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20190601\": {\n        \"deskripsi\": \"Hari Lahir Pancasila\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20190603\": {\n        \"deskripsi\": \"Cuti Bersama\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20190604\": {\n        \"deskripsi\": \"Cuti Bersama\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20190605\": {\n        \"deskripsi\": \"Idul Fitri (Lebaran Mudik)\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20190606\": {\n        \"deskripsi\": \"Idul Fitri (Lebaran Mudik)\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20190607\": {\n        \"deskripsi\": \"Cuti Bersama\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20190811\": {\n        \"deskripsi\": \"Idul Adha (Lebaran Haji)\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20190817\": {\n        \"deskripsi\": \"Hari Proklamasi Kemerdekaan R.I.\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20190901\": {\n        \"deskripsi\": \"Satu Muharam/Tahun Baru Hijriyah\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20191027\": {\n        \"deskripsi\": \"Diwali/Deepavali\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20191109\": {\n        \"deskripsi\": \"Maulid Nabi Muhammad\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20191224\": {\n        \"deskripsi\": \"Cuti Bersama (Malam Natal)\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20191225\": {\n        \"deskripsi\": \"Hari Natal\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20191231\": {\n        \"deskripsi\": \"Malam Tahun Baru\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20200101\": {\n        \"deskripsi\": \"Hari Tahun Baru\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20200125\": {\n        \"deskripsi\": \"Tahun Baru Imlek\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20200322\": {\n        \"deskripsi\": \"Isra Mi\'raj Nabi Muhammad\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20200325\": {\n        \"deskripsi\": \"Hari Raya Nyepi (Tahun Baru Saka)\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20200410\": {\n        \"deskripsi\": \"Wafat Isa Almasih\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20200412\": {\n        \"deskripsi\": \"Hari Paskah\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20200501\": {\n        \"deskripsi\": \"Hari Buruh Internasional/Pekerja\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20200507\": {\n        \"deskripsi\": \"Hari Raya Waisak\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20200521\": {\n        \"deskripsi\": \"Kenaikan Yesus Kristus\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20200524\": {\n        \"deskripsi\": \"Idul Fitri (Lebaran Mudik)\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20200525\": {\n        \"deskripsi\": \"Idul Fitri (Lebaran Mudik)\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20200601\": {\n        \"deskripsi\": \"Hari Lahir Pancasila\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20200731\": {\n        \"deskripsi\": \"Idul Adha (Lebaran Haji)\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20200817\": {\n        \"deskripsi\": \"Hari Proklamasi Kemerdekaan R.I.\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20200820\": {\n        \"deskripsi\": \"Satu Muharam/Tahun Baru Hijriyah\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20201029\": {\n        \"deskripsi\": \"Maulid Nabi Muhammad\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20201114\": {\n        \"deskripsi\": \"Diwali/Deepavali\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20201224\": {\n        \"deskripsi\": \"Malam Natal\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20201225\": {\n        \"deskripsi\": \"Hari Natal\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"20201231\": {\n        \"deskripsi\": \"Malam Tahun Baru\",\n        \"dibuat\": \"20190221T122231Z\",\n        \"dimodifikasi\": \"20190221T122231Z\",\n        \"status\": \"CONFIRMED\"\n    },\n    \"created-at\": \"2019-04-17 04:21\"\n}',NULL,1);
/*!40000 ALTER TABLE `master_holiday` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_hotel_cost`
--

DROP TABLE IF EXISTS `master_hotel_cost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `master_hotel_cost` (
  `id_master_hotel_cost` int NOT NULL AUTO_INCREMENT,
  `id_group_grade` smallint DEFAULT NULL,
  `province` varchar(45) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_master_hotel_cost`)
) ENGINE=InnoDB AUTO_INCREMENT=205;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_hotel_cost`
--

LOCK TABLES `master_hotel_cost` WRITE;
/*!40000 ALTER TABLE `master_hotel_cost` DISABLE KEYS */;
INSERT INTO `master_hotel_cost` VALUES (1,1,'ACEH',1620000,0),(2,1,'SUMATERA UTARA',1380000,0),(3,1,'RIAU',2060000,0),(4,1,'KEPULAUAN RIAU',1300000,0),(5,1,'JAMBI',1520000,0),(6,1,'SUMATERA BARAT',1690000,0),(7,1,'SUMATERA SELATAN',1960000,0),(8,1,'LAMPUNG',1430000,0),(9,1,'BENGKULU',1930000,0),(10,1,'BANGKA BELITUNG',2450000,0),(11,1,'BANTEN',1250000,0),(12,1,'JAWA BARAT',1260000,0),(13,1,'D.K.I JAKARTA',1240000,0),(14,1,'JAWA TENGAH',1190000,0),(15,1,'D.I. YOGYAKARTA',1730000,0),(16,1,'JAWA TIMUR',1350000,0),(17,1,'BALI',1490000,0),(18,1,'NUSA TENGGARA BARAT',1770000,0),(19,1,'NUSA TENGGARA TIMUR',1690000,0),(20,1,'KALIMANTAN BARAT',1410000,0),(21,1,'KALIMANTAN TENGAH',1450000,0),(22,1,'KALIMANTAN SELATAN',1880000,0),(23,1,'KALIMANTAN TIMUR',1880000,0),(24,1,'KALIMANTAN UTARA',1880000,0),(25,1,'SULAWESI UTARA',1160000,0),(26,1,'GORONTALO',2390000,0),(27,1,'SULAWESI BARAT',1340000,0),(28,1,'SULAWESI SELATAN',1280000,0),(29,1,'SULAWESI TENGAH',1960000,0),(30,1,'SULAWESI TENGGARA',1620000,0),(31,1,'MALUKU',1310000,0),(32,1,'MALUKU UTARA',1340000,0),(33,1,'PAPUA',3150000,0),(34,1,'PAPUA BARAT',2570000,0),(35,2,'ACEH',700000,0),(36,2,'SUMATERA UTARA',660000,0),(37,2,'RIAU',1070000,0),(38,2,'KEPULAUAN RIAU',990000,0),(39,2,'JAMBI',730000,0),(40,2,'SUMATERA BARAT',810000,0),(41,2,'SUMATERA SELATAN',1080000,0),(42,2,'LAMPUNG',730000,0),(43,2,'BENGKULU',790000,0),(44,2,'BANGKA BELITUNG',780000,0),(45,2,'BANTEN',900000,0),(46,2,'JAWA BARAT',710000,0),(47,2,'D.K.I JAKARTA',910000,0),(48,2,'JAWA TENGAH',750000,0),(49,2,'D.I. YOGYAKARTA',1060000,0),(50,2,'JAWA TIMUR',830000,0),(51,2,'BALI',1140000,0),(52,2,'NUSA TENGGARA BARAT',730000,0),(53,2,'NUSA TENGGARA TIMUR',690000,0),(54,2,'KALIMANTAN BARAT',670000,0),(55,2,'KALIMANTAN TENGAH',820000,0),(56,2,'KALIMANTAN SELATAN',680000,0),(57,2,'KALIMANTAN TIMUR',1010000,0),(58,2,'KALIMANTAN UTARA',1010000,0),(59,2,'SULAWESI UTARA',980000,0),(60,2,'GORONTALO',960000,0),(61,2,'SULAWESI BARAT',880000,0),(62,2,'SULAWESI SELATAN',920000,0),(63,2,'SULAWESI TENGAH',1190000,0),(64,2,'SULAWESI TENGGARA',980000,0),(65,2,'MALUKU',830000,0),(66,2,'MALUKU UTARA',750000,0),(67,2,'PAPUA',1040000,0),(68,2,'PAPUA BARAT',900000,0),(69,3,'ACEH',700000,0),(70,3,'SUMATERA UTARA',660000,0),(71,3,'RIAU',1070000,0),(72,3,'KEPULAUAN RIAU',990000,0),(73,3,'JAMBI',730000,0),(74,3,'SUMATERA BARAT',810000,0),(75,3,'SUMATERA SELATAN',1080000,0),(76,3,'LAMPUNG',730000,0),(77,3,'BENGKULU',790000,0),(78,3,'BANGKA BELITUNG',780000,0),(79,3,'BANTEN',900000,0),(80,3,'JAWA BARAT',710000,0),(81,3,'D.K.I JAKARTA',910000,0),(82,3,'JAWA TENGAH',750000,0),(83,3,'D.I. YOGYAKARTA',1060000,0),(84,3,'JAWA TIMUR',830000,0),(85,3,'BALI',1140000,0),(86,3,'NUSA TENGGARA BARAT',730000,0),(87,3,'NUSA TENGGARA TIMUR',690000,0),(88,3,'KALIMANTAN BARAT',670000,0),(89,3,'KALIMANTAN TENGAH',820000,0),(90,3,'KALIMANTAN SELATAN',680000,0),(91,3,'KALIMANTAN TIMUR',1010000,0),(92,3,'KALIMANTAN UTARA',1010000,0),(93,3,'SULAWESI UTARA',980000,0),(94,3,'GORONTALO',960000,0),(95,3,'SULAWESI BARAT',880000,0),(96,3,'SULAWESI SELATAN',920000,0),(97,3,'SULAWESI TENGAH',1190000,0),(98,3,'SULAWESI TENGGARA',980000,0),(99,3,'MALUKU',830000,0),(100,3,'MALUKU UTARA',750000,0),(101,3,'PAPUA',1040000,0),(102,3,'PAPUA BARAT',900000,0),(103,4,'ACEH',560000,0),(104,4,'SUMATERA UTARA',530000,0),(105,4,'RIAU',850000,0),(106,4,'KEPULAUAN RIAU',790000,0),(107,4,'JAMBI',580000,0),(108,4,'SUMATERA BARAT',650000,0),(109,4,'SUMATERA SELATAN',860000,0),(110,4,'LAMPUNG',580000,0),(111,4,'BENGKULU',630000,0),(112,4,'BANGKA BELITUNG',620000,0),(113,4,'BANTEN',720000,0),(114,4,'JAWA BARAT',570000,0),(115,4,'D.K.I JAKARTA',610000,0),(116,4,'JAWA TENGAH',600000,0),(117,4,'D.I. YOGYAKARTA',850000,0),(118,4,'JAWA TIMUR',660000,0),(119,4,'BALI',910000,0),(120,4,'NUSA TENGGARA BARAT',580000,0),(121,4,'NUSA TENGGARA TIMUR',550000,0),(122,4,'KALIMANTAN BARAT',540000,0),(123,4,'KALIMANTAN TENGAH',660000,0),(124,4,'KALIMANTAN SELATAN',540000,0),(125,4,'KALIMANTAN TIMUR',800000,0),(126,4,'KALIMANTAN UTARA',800000,0),(127,4,'SULAWESI UTARA',780000,0),(128,4,'GORONTALO',760000,0),(129,4,'SULAWESI BARAT',700000,0),(130,4,'SULAWESI SELATAN',730000,0),(131,4,'SULAWESI TENGAH',950000,0),(132,4,'SULAWESI TENGGARA',790000,0),(133,4,'MALUKU',670000,0),(134,4,'MALUKU UTARA',600000,0),(135,4,'PAPUA',830000,0),(136,4,'PAPUA BARAT',720000,0),(137,5,'ACEH',450000,0),(138,5,'SUMATERA UTARA',420000,0),(139,5,'RIAU',680000,0),(140,5,'KEPULAUAN RIAU',630000,0),(141,5,'JAMBI',460000,0),(142,5,'SUMATERA BARAT',520000,0),(143,5,'SUMATERA SELATAN',690000,0),(144,5,'LAMPUNG',460000,0),(145,5,'BENGKULU',500000,0),(146,5,'BANGKA BELITUNG',500000,0),(147,5,'BANTEN',580000,0),(148,5,'JAWA BARAT',460000,0),(149,5,'D.K.I JAKARTA',490000,0),(150,5,'JAWA TENGAH',480000,0),(151,5,'D.I. YOGYAKARTA',680000,0),(152,5,'JAWA TIMUR',530000,0),(153,5,'BALI',730000,0),(154,5,'NUSA TENGGARA BARAT',460000,0),(155,5,'NUSA TENGGARA TIMUR',440000,0),(156,5,'KALIMANTAN BARAT',430000,0),(157,5,'KALIMANTAN TENGAH',530000,0),(158,5,'KALIMANTAN SELATAN',430000,0),(159,5,'KALIMANTAN TIMUR',640000,0),(160,5,'KALIMANTAN UTARA',640000,0),(161,5,'SULAWESI UTARA',620000,0),(162,5,'GORONTALO',610000,0),(163,5,'SULAWESI BARAT',560000,0),(164,5,'SULAWESI SELATAN',580000,0),(165,5,'SULAWESI TENGAH',760000,0),(166,5,'SULAWESI TENGGARA',630000,0),(167,5,'MALUKU',540000,0),(168,5,'MALUKU UTARA',480000,0),(169,5,'PAPUA',660000,0),(170,5,'PAPUA BARAT',580000,0),(171,7,'ACEH',560000,0),(172,7,'SUMATERA UTARA',530000,0),(173,7,'RIAU',850000,0),(174,7,'KEPULAUAN RIAU',790000,0),(175,7,'JAMBI',580000,0),(176,7,'SUMATERA BARAT',650000,0),(177,7,'SUMATERA SELATAN',860000,0),(178,7,'LAMPUNG',580000,0),(179,7,'BENGKULU',630000,0),(180,7,'BANGKA BELITUNG',620000,0),(181,7,'BANTEN',720000,0),(182,7,'JAWA BARAT',570000,0),(183,7,'D.K.I JAKARTA',610000,0),(184,7,'JAWA TENGAH',600000,0),(185,7,'D.I. YOGYAKARTA',850000,0),(186,7,'JAWA TIMUR',660000,0),(187,7,'BALI',910000,0),(188,7,'NUSA TENGGARA BARAT',580000,0),(189,7,'NUSA TENGGARA TIMUR',550000,0),(190,7,'KALIMANTAN BARAT',540000,0),(191,7,'KALIMANTAN TENGAH',660000,0),(192,7,'KALIMANTAN SELATAN',540000,0),(193,7,'KALIMANTAN TIMUR',800000,0),(194,7,'KALIMANTAN UTARA',800000,0),(195,7,'SULAWESI UTARA',780000,0),(196,7,'GORONTALO',760000,0),(197,7,'SULAWESI BARAT',700000,0),(198,7,'SULAWESI SELATAN',730000,0),(199,7,'SULAWESI TENGAH',950000,0),(200,7,'SULAWESI TENGGARA',790000,0),(201,7,'MALUKU',670000,0),(202,7,'MALUKU UTARA',600000,0),(203,7,'PAPUA',830000,0),(204,7,'PAPUA BARAT',720000,0);
/*!40000 ALTER TABLE `master_hotel_cost` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_role_tasks`
--

DROP TABLE IF EXISTS `master_role_tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `master_role_tasks` (
  `id_master_role_tasks` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_master_role_tasks`)
) ENGINE=InnoDB AUTO_INCREMENT=3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_role_tasks`
--

LOCK TABLES `master_role_tasks` WRITE;
/*!40000 ALTER TABLE `master_role_tasks` DISABLE KEYS */;
INSERT INTO `master_role_tasks` VALUES (1,'Team Leader'),(2,'Employee');
/*!40000 ALTER TABLE `master_role_tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_vehicle`
--

DROP TABLE IF EXISTS `master_vehicle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `master_vehicle` (
  `id_master_vehicle` int NOT NULL AUTO_INCREMENT,
  `vehicle_name` varchar(45) DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_master_vehicle`)
) ENGINE=InnoDB AUTO_INCREMENT=5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_vehicle`
--

LOCK TABLES `master_vehicle` WRITE;
/*!40000 ALTER TABLE `master_vehicle` DISABLE KEYS */;
INSERT INTO `master_vehicle` VALUES (1,'Pesawat',0),(2,'Kereta',0),(3,'Mobil Pribadi',0),(4,'Mobil Dinas',0);
/*!40000 ALTER TABLE `master_vehicle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `project_employee_summery`
--

DROP TABLE IF EXISTS `project_employee_summery`;
/*!50001 DROP VIEW IF EXISTS `project_employee_summery`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `project_employee_summery` AS SELECT 
 1 AS `projectid`,
 1 AS `total_employee`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `project_hours_summary`
--

DROP TABLE IF EXISTS `project_hours_summary`;
/*!50001 DROP VIEW IF EXISTS `project_hours_summary`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `project_hours_summary` AS SELECT 
 1 AS `projectid`,
 1 AS `total_hours`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `projects` (
  `id_projects` int NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `invoice_number` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(45) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '1=>open\n2=>close\n',
  `is_default` tinyint(1) DEFAULT '0',
  `is_delete` tinyint(1) DEFAULT '0',
  `is_started` tinyint(1) DEFAULT '1' COMMENT '1:started',
  `started_date` date DEFAULT NULL,
  PRIMARY KEY (`id_projects`)
) ENGINE=InnoDB AUTO_INCREMENT=5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'dffsdf','sdfsdf','sdfsdf','sfsfsdf','1970-01-01','9999-12-31','2019-09-20 07:16:44',NULL,1,1,0,0,NULL),(2,'sdffsdf','sfsfsd','sfsf','sfsfsfdsfsdfsdfdsfdsfsdfsdf','2019-09-20','2019-09-20','2019-09-20 07:16:54',NULL,1,0,0,0,NULL),(3,'asdasdsadsad','sdasdasd','adadasd','adasdasd','1970-01-01','9999-12-31','2019-09-20 07:19:55',NULL,1,1,0,0,NULL),(4,'asdsadad121212','asdasdsad','asdadasdasdasd','adasdsadasdasd','2019-09-20','2019-09-30','2019-09-20 07:24:34',NULL,1,0,0,0,NULL);
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `setting` (
  `id_setting` int NOT NULL AUTO_INCREMENT,
  `id_site` int NOT NULL DEFAULT '0',
  `type` varchar(150) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id_setting`),
  KEY `is_site` (`id_site`)
) ENGINE=InnoDB AUTO_INCREMENT=527;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` VALUES (510,1,'app_footer','© Copyright Alfian Purnomo 2016'),(511,1,'app_title','OSS'),(512,1,'email_contact','alfian.pacul@gmail.com'),(513,1,'email_contact_name','alfian.purnomo@boltsuper4g.com'),(514,1,'facebook_url','#'),(515,1,'ip_approved','::1;127.0.0.1'),(516,1,'mail_host','mail.test.com'),(517,1,'mail_pass','mail27'),(518,1,'mail_port','25'),(519,1,'mail_protocol','smtp'),(520,1,'mail_user','smtp@test.com'),(521,1,'maintenance_message','<p>This site currently on maintenance, please check again later.</p>\r\n'),(522,1,'maintenance_mode','0'),(523,1,'twitter_url','#'),(524,1,'web_description','This is website description'),(525,1,'web_keywords',''),(526,1,'welcome_message','');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site`
--

DROP TABLE IF EXISTS `site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `site` (
  `id_site` int NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `site_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `site_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `site_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `site_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `site_longitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `site_latitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `site_urut` int NOT NULL,
  `is_default` tinyint(1) NOT NULL,
  `is_delete` tinyint NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id_site`)
) ENGINE=InnoDB AUTO_INCREMENT=2;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site`
--

LOCK TABLES `site` WRITE;
/*!40000 ALTER TABLE `site` DISABLE KEYS */;
INSERT INTO `site` VALUES (1,'EPM Edit','/','/','','','','',1,0,0,'2019-08-29 15:43:12','2012-07-11 00:00:00');
/*!40000 ALTER TABLE `site` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_setting`
--

DROP TABLE IF EXISTS `site_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `site_setting` (
  `id_site_setting` int NOT NULL AUTO_INCREMENT,
  `id_site` int NOT NULL DEFAULT '0',
  `type` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_site_setting`),
  KEY `id_site` (`id_site`)
) ENGINE=InnoDB AUTO_INCREMENT=833;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_setting`
--

LOCK TABLES `site_setting` WRITE;
/*!40000 ALTER TABLE `site_setting` DISABLE KEYS */;
INSERT INTO `site_setting` VALUES (816,1,'app_footer','© 2019 All rights reserved.'),(817,1,'app_title','EPM'),(818,1,'email_contact','alfian.pacul@gmail.com'),(819,1,'email_contact_name','Admin'),(820,1,'facebook_url','#'),(821,1,'ip_approved','::1;127.0.0.1'),(822,1,'mail_host','mail.test.com'),(823,1,'mail_pass','mail27'),(824,1,'mail_port','25'),(825,1,'mail_protocol','smtp'),(826,1,'mail_user','smtp@test.com'),(827,1,'maintenance_message','<p>This site currently on maintenance, please check again later.</p>\r\n'),(828,1,'maintenance_mode','0'),(829,1,'twitter_url','#'),(830,1,'web_description',''),(831,1,'web_keywords',''),(832,1,'welcome_message','You can contact administrator for detail info');
/*!40000 ALTER TABLE `site_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spj_follower`
--

DROP TABLE IF EXISTS `spj_follower`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `spj_follower` (
  `id_spj_follower` int NOT NULL AUTO_INCREMENT,
  `id_spj_online` int DEFAULT NULL,
  `employeeid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_spj_follower`)
) ENGINE=InnoDB;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spj_follower`
--

LOCK TABLES `spj_follower` WRITE;
/*!40000 ALTER TABLE `spj_follower` DISABLE KEYS */;
/*!40000 ALTER TABLE `spj_follower` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spj_online`
--

DROP TABLE IF EXISTS `spj_online`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `spj_online` (
  `id_spj_online` int NOT NULL AUTO_INCREMENT,
  `spj_doc_no` varchar(45) DEFAULT NULL,
  `employeeid` varchar(45) DEFAULT NULL,
  `grade` smallint DEFAULT NULL COMMENT 'Bolognan',
  `activityid` smallint DEFAULT NULL,
  `activity_detail` text,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `vehicle` text,
  `id_auth_user` int DEFAULT NULL,
  `status` enum('REQUESTED','APPROVED','REJECTED') DEFAULT 'REQUESTED',
  `is_delete` tinyint(1) DEFAULT '0',
  `created_date` timestamp NULL DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `destinationid` smallint DEFAULT NULL,
  `jenis_spj` enum('Dinas','Diklat') DEFAULT NULL,
  `jenis_pengurusan` enum('Sendiri','Kantor') DEFAULT NULL,
  `hotel_type` enum('Rumah','Hotel') DEFAULT NULL,
  PRIMARY KEY (`id_spj_online`)
) ENGINE=InnoDB;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spj_online`
--

LOCK TABLES `spj_online` WRITE;
/*!40000 ALTER TABLE `spj_online` DISABLE KEYS */;
/*!40000 ALTER TABLE `spj_online` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spj_status_history`
--

DROP TABLE IF EXISTS `spj_status_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `spj_status_history` (
  `id_spj_status_history` int NOT NULL AUTO_INCREMENT,
  `id_spj_online` int DEFAULT NULL,
  `status` enum('REQUESTED','APPROVED','REJECTED') DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_auth_user` int DEFAULT NULL,
  PRIMARY KEY (`id_spj_status_history`)
) ENGINE=InnoDB;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spj_status_history`
--

LOCK TABLES `spj_status_history` WRITE;
/*!40000 ALTER TABLE `spj_status_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `spj_status_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_data_user`
--

DROP TABLE IF EXISTS `t_data_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `t_data_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `f_firstname` varchar(50) DEFAULT NULL,
  `f_lastname` varchar(50) DEFAULT NULL,
  `f_username` varchar(50) NOT NULL,
  `f_password` varchar(255) DEFAULT NULL,
  `f_mail` varchar(100) DEFAULT NULL,
  `f_phone` varchar(30) DEFAULT NULL,
  `f_grouprole` int DEFAULT NULL,
  `f_userrole` varchar(1024) DEFAULT NULL,
  `f_auth` int DEFAULT NULL,
  `f_remarks` text,
  `f_last_login` datetime DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `is_superadmin` tinyint(1) NOT NULL DEFAULT '0',
  `themes` varchar(225) NOT NULL DEFAULT 'inspinia',
  PRIMARY KEY (`id`,`f_username`)
) ENGINE=InnoDB AUTO_INCREMENT=1019;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_data_user`
--

LOCK TABLES `t_data_user` WRITE;
/*!40000 ALTER TABLE `t_data_user` DISABLE KEYS */;
INSERT INTO `t_data_user` VALUES (133,'Alfianss','Purnomo','AlfianPurnomo','2a0c3a89414c89c05da14819508cf3d6','alfian.pacul@gmail.com','85939002625',1,'',1,'','2016-08-24 09:36:08',NULL,1,'bims'),(851,'Selo','Tjahjono ','93692827','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','93692827@mail.com',NULL,3,NULL,1,NULL,'2020-03-04 20:33:49',NULL,0,'inspinia'),(852,'Rike','Alvianita ','HKEPC1306','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1306@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(853,'Nurma','Fauziani ','HKEPC1897','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1897@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(854,'Roestomo','Sosroprayitno ','52122141','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','52122141@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(855,'Michael','Thomas Clarke ','HKEPC1908','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1908@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(856,'Aris','Wahyudiono ','HKEPC1904','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1904@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(857,'Kartika','Lestari ','09803376','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','09803376@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(858,'Reza','Faisal ','HKEPC1631','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1631@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(859,'Moch.','Alvian Fachrurrozi ','HKEPC1756','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1756@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(860,'Muhammad','Ilham Abdurrahim ','KD199792','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD199792@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(861,'Novahana','Noor Pradita ','KD199796','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD199796@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(862,'Dwieky','Anugerah ','KD199749','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD199749@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(863,'Gabriella','Paramitha ','19953893','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','19953893@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(864,'Faisol','Afrado ','HKEPC1743','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1743@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(865,'Davy','Bungaran Parlindungan N. ','HKEPC1895','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1895@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(866,'Slamet','Supriyono ','02703253','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','02703253@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(867,'Nindyonawi','Pradipto ','KD189659','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD189659@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(868,'Dewi','Setyo Utami ','HKEPC1419','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1419@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(869,'Yudha','Prastawa Armando ','19933894','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','19933894@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(870,'F','Suyadi ','HKEPC1752','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1752@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(871,'Romaki','','HKEPC1522','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1522@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(872,'Boy','Alfredo Pangaribuan ','HKEPC1894','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1894@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(873,'Muhammad','Nur Ardian ','KD189635','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD189635@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(874,'Pratama','Eka Putra Sijabat ','KD199802','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD199802@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(875,'Teja','Kusuma ','13883537','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','13883537@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(876,'Jefri','Piradipta Suharno ','14893601','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','14893601@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(877,'Cahya','Surya Hutama ','KD189588','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD189588@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(878,'Zuniar','Ahmad ','KD189643','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD189643@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(879,'Velix','Setiawan Sirait ','KD189589','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD189589@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(880,'Susilo','Wardono ','93722989','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','93722989@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(881,'Tulus','Triandang Sasmita ','HKEPC1521','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1521@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(882,'M.','Yani ','HKEPC1766','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1766@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(883,'Ary','Zulianto ','HKEPC1755','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1755@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(884,'Wira','Prakasa ','HKEPC1765','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1765@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(885,'Iedi','Fitriadi ','HKEPC1904','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1904@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(886,'Rio','Arif Rahman ','HKEPC1905','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1905@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(887,'Handri','Puri Purwadi ','HKEPC1907','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1907@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(888,'Dody','Dewanto ','95703095','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','95703095@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(889,'Antonius','Satrio Budi Nugroho ','17943805','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','17943805@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(890,'Muhammad','Ridwan Darmawan ','10793437','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','10793437@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(891,'Irwan','Prabowo ','HKEPC1896','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1896@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(892,'Putri','Amalia Ramadhani ','HKEPC1906','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1906@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(893,'Dadi','Suprapto ','95713099','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','95713099@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(894,'Hari','Wahyudi ','13883546','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','13883546@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(895,'Yanuar','Tri Wibowo, ST ','11873466','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','11873466@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(896,'Gema','Alfajri ','KD189609','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD189609@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(897,'Resi','Ayu Agettis ','KD199807','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD199807@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(898,'Warjo','','05753284','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','05753284@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(899,'Astuti','','18923825','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','18923825@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(900,'Muhammad','Fikry Alfisyahrin ','KD199791','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD199791@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(901,'Widya','Chandra Wiguna ','HKEPC1905','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1905@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(902,'Ichsan','Chairudin ','HKEPC1764','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1764@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(903,'Tri','Handoko ','1182,3446','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','1182,3446@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(904,'Septiadi','Putranto ','HKEPC1525','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1525@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(905,'Vega','Alberta ','KD189613','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD189613@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(906,'Nabila','Hajar Aflaha ','KD199795','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD199795@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(907,'Anggara','Oka Primanda ','HKEPC1754','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1754@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(908,'Heru','Haryadi ','18933849','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','18933849@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(909,'Titik','Yuli Lestari ','93653206','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','93653206@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(910,'Kuncoro','Aji Kusrianto ','KD199781','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD199781@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(911,'Mar','Atus Sholeha ','HKEPC1746','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1746@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(912,'Abdul','Nasir ','HKEPC1888','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1888@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(913,'Novalina','Hanawati ','13893578','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','13893578@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(914,'Khusain','Munawir ','KD199779','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','kd199779@mail.com','',2,NULL,1,NULL,'2020-03-30 10:00:04','2020-03-30 09:59:41',0,'inspinia'),(915,'Abednego','Noelandri Silitonga ','13893495','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','13893495@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(916,'Delfi','Lumonang ','15703713','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','15703713@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(917,'Jumiyati','','95722877','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','95722877@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(918,'Jwantoro','','19953896','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','19953896@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(919,'Muhammad','Ekky Gigih Prakoso ','14913642','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','14913642@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(920,'Noor','Said ','07793311','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','07793311@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(921,'Saddam','Pradika ','14913609','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','14913609@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(922,'Subari','','92682844','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','92682844@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(923,'Yanwar','Eko Prasetyo ','16923739','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','16923739@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(924,'Sakka','','15723714','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','15723714@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(925,'Wisnu','Probowaskito ','15713707','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','15713707@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(926,'Furqon','Adi Bastanta ','KD199765','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD199765@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(927,'Weriansyah','Putra ','HKEPC1634','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1634@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(928,'Hamzah','','HKEPC1739','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1739@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(929,'Hasanuddin','','HKEPC1740','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1740@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(930,'Dito','Narendra ','HKEPC1741','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1741@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(931,'Marshal','Tarlini ','HKEPC1756','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1756@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(932,'Firman','Endarko ','HKEPC1891','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1891@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(933,'Gilang','Satrio ','16923749','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','16923749@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(934,'Mohamad','Sodikin ','KD189624','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD189624@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(935,'Arnold','Sitanggang ','HKEPC1887','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1887@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(936,'Adhitya','Budi Nugraha ','18923857','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','18923857@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(937,'Aruna','Dwitya Putra ','15893664','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','15893664@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(938,'Febri','Chrishardiyan ','13883552','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','13883552@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(939,'Hendry','Gunawan ','18933847','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','18933847@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(940,'Herri','Indrianto ','09823374','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','09823374@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(941,'Mario','Panuttra Santoso ','16923741','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','16923741@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(942,'Rokhmad','Joni Catur Utomo ','13913568','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','13913568@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(943,'Agus','Prabowo ','HKEPC1889','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1889@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(944,'Ahmad','Abdullah Sibali ','05743276','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','05743276@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(945,'Cahyo','Aji Nugroho ','14913617','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','14913617@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(946,'Sutrisno','','91713156','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','91713156@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(947,'Dwi','Handoko ','96723009','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','96723009@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(948,'I','Made Japasunu ','92662635','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','92662635@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(949,'Iwan','Tjahya Nugroho ','10823407','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','10823407@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(950,'Jody','Askabul Mokoagow ','09783363','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','09783363@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(951,'Muhammad','Faizal ','18943813','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','18943813@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(952,'Sungkowo','Wahyu Santoso ','13883487','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','13883487@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(953,'I','Made Widana ','93723147','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','93723147@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(954,'Zulkarnaen','','07773319','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','07773319@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(955,'Khasan','Mustofa ','KD189625','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD189625@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(956,'Lydia','Tiara ','KD189593','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD189593@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(957,'Widhi','Ahmad Wicaksono ','KD189600','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD189600@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(958,'Harry','J. Pangaribuan ','KD189615','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD189615@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(959,'Musthafa','Abdur Rosyied ','KD189632','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD189632@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(960,'Muhammad','Irfan Baharuddin ','16913755','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','16913755@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(961,'Adeline','Larisa ','KD189611','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD189611@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(962,'Muhammad','Fajri ','KD199790','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD199790@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(963,'Muhaidir','','HKEPC1876','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1876@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(964,'Rizalman','Syaid ','HKEPC1890','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1890@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(965,'Alamsyah','','15853710','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','15853710@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(966,'I','Gusti Ngurah Ananda ','88682449','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','88682449@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(967,'Indra','Nugraha ','18933829','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','18933829@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(968,'Rendy','Yoel Laguna ','12843474','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','12843474@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(969,'David','Akbar Pratama ','KD199740','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD199740@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(970,'Sugeng','','HKEPC','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(971,'Djefry','Karepoan ','HKEPC1893','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1893@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(972,'Arie','Garuda Satrio ','13893497','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','13893497@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(973,'Pucheng','Purba ','09803355','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','09803355@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(974,'Brian','Primaharjan ','16933783','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','16933783@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(975,'Brasta','Diyu Wasesa ','KD189603','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD189603@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(976,'Danang','Ariswanto ','HKEPC1758','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1758@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(977,'Endro','Suwasono ','HKEPC1882','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1882@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(978,'Prakoso','Adhitya R.E.N. ','14883594','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','14883594@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(979,'Septesen','Nababan ','14883631','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','14883631@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(980,'Nur','Rahman Alhamidi ','KD189616','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD189616@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(981,'Timbul','Martua ','HKEPC1877','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1877@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(982,'Muhammad','Nusri ','90642981','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','90642981@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(983,'Sukandi','Samatan ','09763387','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','09763387@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(984,'Agus','Surya Negara ','10833432','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','10833432@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(985,'Bagus','Bayu Nugraha ','14903613','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','14903613@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(986,'Bayu','Warianto ','06783285','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','06783285@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(987,'Bisri','Subakir ','88692517','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','88692517@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(988,'Dony','Afi Hardono ','10833406','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','10833406@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(989,'Martin','Martunas Agung P.S ','15913675','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','15913675@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(990,'Mirza','','13873543','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','13873543@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(991,'Muslimin','','8865,2448','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','8865,2448@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(992,'Nanang','Hendro S ','90702632','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','90702632@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(993,'Priyandi','Murwandono ','16923744','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','16923744@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(994,'Dica','Rasyid Maulidhani ','KD189592','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD189592@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(995,'Rizky','Andhika ','KD199810','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD199810@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(996,'Hestu','Saptoadi ','HKEPC1762','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1762@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(997,'Ettim','Dwi Yoga ','15803711','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','15803711@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(998,'Tirda','Rizki Santoso ','13903565','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','13903565@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(999,'Hardi','Kristanto ','HKEPC1745','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1745@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(1000,'Randy','Riza Kurniawan ','11863462','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','11863462@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(1001,'Andi','Kurniawan ','HKEPC1750','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1750@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(1002,'Muhamad','Iqbal Muslim ','HKEPC1753','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1753@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(1003,'Yos','Sutanto ','HKEPC1763','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1763@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(1004,'Rudi','Iryanto ','12873475','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','12873475@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(1005,'Dwiyoga','Noris Indrawijaya ','13883511','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','13883511@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(1006,'Arie','Setyo Nugroho ','10843422','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','10843422@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(1007,'Bayu','Azwar Suryawan ','KD199789','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD199789@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(1008,'Deby','Sumarno ','HKEPC1749','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','HKEPC1749@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(1009,'Bambang','Prasetyo ','15783705','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','15783705@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(1010,'Darmawan','Setyadi ','KD189599','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD189599@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(1011,'Andrivo','Ferliyan ','KD199695','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD199695@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(1012,'Achmad','Fikri ','11843453','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','11843453@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(1013,'Daniel','Erlanda ','14893633','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','14893633@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(1014,'Dwiarto','Raharjo ','09813362','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','09813362@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(1015,'Betta','Yudhi Setyawan ','13873509','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','13873509@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(1016,'Ivone','Fabiola N. Depari ','KD199777','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD199777@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(1017,'Kevin','Andrea ','KD189681','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','KD189681@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia'),(1018,'Ridwan','Setia Prihatna ','10793437','$2y$10$bC9HDLQQzF7p3lENbq2S.ujv6d5M7LCHBIwxQf0UCY6YfXrv56hV2','10793437@mail.com',NULL,3,NULL,1,NULL,NULL,NULL,0,'inspinia');
/*!40000 ALTER TABLE `t_data_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_data_user_old`
--

DROP TABLE IF EXISTS `t_data_user_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `t_data_user_old` (
  `id` int NOT NULL AUTO_INCREMENT,
  `f_firstname` varchar(50) DEFAULT NULL,
  `f_lastname` varchar(50) DEFAULT NULL,
  `f_username` varchar(50) NOT NULL,
  `f_password` varchar(255) DEFAULT NULL,
  `f_mail` varchar(100) DEFAULT NULL,
  `f_phone` varchar(30) DEFAULT NULL,
  `f_grouprole` int DEFAULT NULL,
  `f_userrole` varchar(1024) DEFAULT NULL,
  `f_auth` int DEFAULT NULL,
  `f_remarks` text,
  `f_last_login` datetime DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `is_superadmin` tinyint(1) NOT NULL DEFAULT '0',
  `themes` varchar(225) NOT NULL DEFAULT 'inspinia',
  PRIMARY KEY (`id`,`f_username`)
) ENGINE=InnoDB AUTO_INCREMENT=148;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_data_user_old`
--

LOCK TABLES `t_data_user_old` WRITE;
/*!40000 ALTER TABLE `t_data_user_old` DISABLE KEYS */;
INSERT INTO `t_data_user_old` VALUES (133,'Alfianss','Purnomo','AlfianPurnomo','2a0c3a89414c89c05da14819508cf3d6','alfian.pacul@gmail.com','85939002625',1,'',1,'','2016-08-24 09:36:08',NULL,1,'bims'),(134,'Data','Entri','data_entri','$2y$10$kQ74cV9FB9408aoT1SSW2.gUnxR8eJTBtyA1nl4icdCAhoE8u3eJq','data.entri@lpi.co.id','085939002625',2,NULL,1,NULL,'2019-07-01 17:28:07','2019-05-24 15:59:22',0,'inspinia'),(135,'Alfian','Purnomo','alfianpurnomo2','$2y$10$7wRRfS/JbViT4MwOudBaxukE.BdK9ko9Maws8oYdXvbqMvcr6rjiC','alfian.purnomo@elevenia.co.id','85939002625',2,NULL,1,NULL,'2019-08-16 10:07:48',NULL,0,'inspinia'),(140,'Robert','Maramis','RobertMaramis','$2y$10$cTucFTYOSQJN2w34b911e.nv8JgSZzAfES742YEQziUFJLrUjCR4G','robert.maramis@elevenia.co.id','131231231',3,NULL,1,NULL,'2019-08-29 11:06:33','2019-08-16 11:14:21',0,'inspinia'),(141,'her','Ana','herli_aja','$2y$10$lwZsEfxI3HyRGAcww3lMA.D3D07P.FZcVNFsw06pkr6SmJ91VkkTe','herliana@gmail.com','12132332443',5,NULL,0,NULL,'2019-08-26 15:51:20','2019-08-22 10:22:48',0,'inspinia'),(142,'mutia12','ayu11','mutia_testing','$2y$10$X5Jv3eJLdDw6KMOdRZrmaOcZhl8qr7KH4/pDYNEiyNEV3h3jyGPBW','mutia@gmail.com','08990047282',5,NULL,0,NULL,'2019-09-06 14:44:45','2019-08-21 15:57:29',1,'inspinia'),(145,'test1','test1','test1','$2y$10$Dq0sr6C9lCb8mu91fAh3IO4B39hEFYWlgPiuS07lkEx3oErEXEQze','test1@test1.com','12345',4,NULL,1,NULL,'2019-08-26 16:13:11',NULL,0,'inspinia'),(146,'test2','test2','test2','$2y$10$Grs5i.c3ABIm/ASu7LCGnuIfeZJlI62USFthrvqJb6sLIgRzfgK6m','test2@test2.com','1234',3,NULL,0,NULL,'2019-08-26 15:48:43',NULL,0,'inspinia'),(147,'test3','test3','test33','$2y$10$OVIisWmmEHXuTfEGqtTNKe.6lXKbpMeU7i0VlK0DaLSWkysACBtk6','test3@test3.com','1234',3,NULL,1,NULL,'2019-08-22 14:14:52','2019-09-13 10:17:26',0,'inspinia');
/*!40000 ALTER TABLE `t_data_user_old` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tasks` (
  `id_tasks` int NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `employeeid` varchar(45) DEFAULT NULL,
  `projectid` int DEFAULT NULL,
  `activityid` int DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `hours` int DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`id_tasks`)
) ENGINE=InnoDB AUTO_INCREMENT=96;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (2,'2019-08-19','8e33e57b-9bd5-1229-9cb8-b4d5bd9e2608',1,1,'2019-08-20 03:36:40',3,NULL),(3,'2019-08-19','a9bded50-c3c5-11e9-a7c0-0050568b6323',0,0,'2019-08-21 04:08:00',0,NULL),(7,'2019-08-21','a9bded50-c3c5-11e9-a7c0-0050568b6323',1,3,'2019-08-21 05:17:02',0,NULL),(13,'2019-08-21','a9bded50-c3c5-11e9-a7c0-0050568b6323',8,0,'2019-08-21 05:23:07',0,NULL),(14,'2019-08-21','a9bded50-c3c5-11e9-a7c0-0050568b6323',8,0,'2019-08-21 05:23:15',0,NULL),(22,'2019-08-21','9c4a15ca-c3dd-11e9-a7c0-0050568b6323',12,2,'2019-08-21 10:00:15',12,NULL),(23,'2019-08-20','9c4a15ca-c3dd-11e9-a7c0-0050568b6323',12,2,'2019-08-21 10:00:24',12,NULL),(24,'2019-08-21','a9bded50-c3c5-11e9-a7c0-0050568b6323',8,2,'2019-08-22 05:14:52',1,NULL),(25,'2019-08-21','a9bded50-c3c5-11e9-a7c0-0050568b6323',5,1,'2019-08-22 05:14:56',1,NULL),(26,'2019-08-21','a9bded50-c3c5-11e9-a7c0-0050568b6323',5,2,'2019-08-22 05:15:00',3,NULL),(27,'2019-08-21','a9bded50-c3c5-11e9-a7c0-0050568b6323',7,2,'2019-08-22 05:15:07',1,NULL),(28,'2019-08-21','a9bded50-c3c5-11e9-a7c0-0050568b6323',10,5,'2019-08-22 05:15:13',5,NULL),(29,'2019-08-19','cbe933ff-c4a9-11e9-a7c0-0050568b6323',0,0,'2019-08-22 06:56:45',0,NULL),(30,'2019-08-22','cbe933ff-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-22 07:15:13',0,NULL),(31,'2019-08-22','cbe933ff-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-22 07:15:15',0,NULL),(32,'2019-08-22','cbe933ff-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-22 07:15:16',0,NULL),(33,'2019-08-22','cbe933ff-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-22 07:15:19',8,NULL),(34,'2019-08-23','cbe933ff-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-22 07:15:27',8,NULL),(35,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,3,'2019-08-22 07:15:59',3,NULL),(36,'2019-08-19','a9bded50-c3c5-11e9-a7c0-0050568b6323',8,2,'2019-08-23 08:46:15',0,NULL),(38,'2019-08-21','a9bded50-c3c5-11e9-a7c0-0050568b6323',5,1,'2019-08-23 08:58:30',1,NULL),(39,'2019-08-20','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,0,'2019-08-23 09:38:18',0,NULL),(40,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,0,'2019-08-23 09:38:29',0,NULL),(41,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,0,'2019-08-23 09:38:31',0,NULL),(42,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,0,'2019-08-23 09:38:31',0,NULL),(43,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-23 09:38:35',0,NULL),(44,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-23 09:38:35',0,NULL),(45,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-23 09:38:36',0,NULL),(46,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-23 09:38:41',1,NULL),(47,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-23 09:38:42',1,NULL),(48,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-23 09:38:42',1,NULL),(49,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-23 09:38:42',1,NULL),(50,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-23 09:38:43',1,NULL),(51,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-23 09:38:43',1,NULL),(52,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-23 09:38:43',1,NULL),(53,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-23 09:38:43',1,NULL),(54,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,0,'2019-08-23 09:39:05',1,NULL),(55,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,0,'2019-08-23 09:39:05',1,NULL),(56,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,0,'2019-08-23 09:39:06',1,NULL),(57,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,0,'2019-08-23 09:39:06',1,NULL),(58,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-23 09:40:10',1,NULL),(59,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-23 09:47:35',0,NULL),(60,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-23 09:47:36',0,NULL),(61,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-23 09:47:36',0,NULL),(62,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-23 09:47:36',0,NULL),(63,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-23 09:47:40',0,NULL),(64,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-23 09:47:40',0,NULL),(65,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-23 09:47:40',0,NULL),(66,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-23 09:47:41',0,NULL),(67,'2019-08-22','acb1fdf6-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-23 09:47:41',0,NULL),(68,'2019-08-26','a9bded50-c3c5-11e9-a7c0-0050568b6323',16,3,'2019-08-26 03:08:41',2,NULL),(69,'2019-08-26','a9bded50-c3c5-11e9-a7c0-0050568b6323',16,3,'2019-08-26 03:08:42',2,NULL),(70,'2019-08-26','a9bded50-c3c5-11e9-a7c0-0050568b6323',16,3,'2019-08-26 03:08:43',2,NULL),(71,'2019-08-26','a9bded50-c3c5-11e9-a7c0-0050568b6323',16,3,'2019-08-26 03:08:44',2,NULL),(72,'2019-08-26','a9bded50-c3c5-11e9-a7c0-0050568b6323',16,3,'2019-08-26 03:08:44',2,NULL),(73,'2019-08-26','a9bded50-c3c5-11e9-a7c0-0050568b6323',16,3,'2019-08-26 03:08:44',2,NULL),(74,'2019-08-26','9c4a15ca-c3dd-11e9-a7c0-0050568b6323',16,2,'2019-08-26 03:12:38',1,NULL),(75,'2019-08-26','9c4a15ca-c3dd-11e9-a7c0-0050568b6323',16,2,'2019-08-26 03:12:40',1,NULL),(76,'2019-08-26','9c4a15ca-c3dd-11e9-a7c0-0050568b6323',16,2,'2019-08-26 03:12:42',1,NULL),(77,'2019-08-26','9c4a15ca-c3dd-11e9-a7c0-0050568b6323',16,2,'2019-08-26 03:12:42',1,NULL),(78,'2019-08-26','9c4a15ca-c3dd-11e9-a7c0-0050568b6323',16,2,'2019-08-26 03:12:43',1,NULL),(79,'2019-08-26','9c4a15ca-c3dd-11e9-a7c0-0050568b6323',16,2,'2019-08-26 03:12:44',1,NULL),(80,'2019-08-26','9c4a15ca-c3dd-11e9-a7c0-0050568b6323',16,2,'2019-08-26 03:12:44',1,NULL),(81,'2019-08-26','9c4a15ca-c3dd-11e9-a7c0-0050568b6323',16,2,'2019-08-26 03:12:44',1,NULL),(82,'2019-08-26','9c4a15ca-c3dd-11e9-a7c0-0050568b6323',16,2,'2019-08-26 03:12:44',1,NULL),(83,'2019-08-26','9c4a15ca-c3dd-11e9-a7c0-0050568b6323',16,2,'2019-08-26 03:12:45',1,NULL),(84,'2019-08-26','9c4a15ca-c3dd-11e9-a7c0-0050568b6323',16,2,'2019-08-26 03:13:14',1,NULL),(85,'2019-08-26','9c4a15ca-c3dd-11e9-a7c0-0050568b6323',16,2,'2019-08-26 03:13:18',1,NULL),(86,'2019-08-26','bc744998-c4a9-11e9-a7c0-0050568b6323',14,1,'2019-08-26 08:48:54',8,NULL),(87,'2019-08-27','a9bded50-c3c5-11e9-a7c0-0050568b6323',16,3,'2019-08-26 08:52:10',1,NULL),(88,'2019-08-27','a9bded50-c3c5-11e9-a7c0-0050568b6323',16,6,'2019-08-26 08:52:28',3,NULL),(90,'2019-08-19','a9bded50-c3c5-11e9-a7c0-0050568b6323',1,2,'2019-08-30 07:37:33',12,NULL),(91,'2019-08-20','a9bded50-c3c5-11e9-a7c0-0050568b6323',8,2,'2019-08-30 07:37:40',7,NULL),(92,'2019-08-21','a9bded50-c3c5-11e9-a7c0-0050568b6323',10,2,'2019-08-30 07:37:46',4,NULL),(95,'2019-09-23','f0afe70e-d2ce-11e9-a7c0-0050568b6323',1,9,'2019-09-25 06:21:36',2,'123');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `travel_bill`
--

DROP TABLE IF EXISTS `travel_bill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `travel_bill` (
  `id_travel_bill` int NOT NULL AUTO_INCREMENT,
  `id_spj_online` int DEFAULT NULL,
  `employeeid` varchar(45) DEFAULT NULL,
  `employee_name` varchar(45) DEFAULT NULL,
  `head_of_division` varchar(45) DEFAULT NULL,
  `head_of_division_id` varchar(45) DEFAULT NULL,
  `days` int DEFAULT NULL,
  `status` enum('REQUESTED_LPD','APPROVE_LPD','REJECT_LPD') DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_auth_user` int DEFAULT NULL,
  PRIMARY KEY (`id_travel_bill`)
) ENGINE=InnoDB;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_bill`
--

LOCK TABLES `travel_bill` WRITE;
/*!40000 ALTER TABLE `travel_bill` DISABLE KEYS */;
/*!40000 ALTER TABLE `travel_bill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `view_employee`
--

DROP TABLE IF EXISTS `view_employee`;
/*!50001 DROP VIEW IF EXISTS `view_employee`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `view_employee` AS SELECT 
 1 AS `employeeid`,
 1 AS `f_password`,
 1 AS `firstname`,
 1 AS `lastname`,
 1 AS `nik`,
 1 AS `golongan`,
 1 AS `sex`,
 1 AS `department`,
 1 AS `head_sub_division`,
 1 AS `head_sub_division_name`,
 1 AS `head_sub_division_email`,
 1 AS `department_name`,
 1 AS `division`,
 1 AS `division_name`,
 1 AS `golongan_name`,
 1 AS `group_gol_name`,
 1 AS `id_master_group_golongan`,
 1 AS `jobsid`,
 1 AS `jobs_name`,
 1 AS `email`,
 1 AS `handphone`,
 1 AS `picture`,
 1 AS `unitid`,
 1 AS `createdby`,
 1 AS `createddate`,
 1 AS `modifiedby`,
 1 AS `modifieddate`,
 1 AS `deleted`,
 1 AS `userid`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `view_frekuensi_perjalanan`
--

DROP TABLE IF EXISTS `view_frekuensi_perjalanan`;
/*!50001 DROP VIEW IF EXISTS `view_frekuensi_perjalanan`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `view_frekuensi_perjalanan` AS SELECT 
 1 AS `id_frekuensi_perjalanan`,
 1 AS `name`,
 1 AS `id_group_golongan`,
 1 AS `amount`,
 1 AS `alias`,
 1 AS `group_gol_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `view_hotel_cost`
--

DROP TABLE IF EXISTS `view_hotel_cost`;
/*!50001 DROP VIEW IF EXISTS `view_hotel_cost`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `view_hotel_cost` AS SELECT 
 1 AS `id_master_hotel_cost`,
 1 AS `id_group_grade`,
 1 AS `province`,
 1 AS `alias`,
 1 AS `description`,
 1 AS `group_gol_name`,
 1 AS `amount`,
 1 AS `is_delete`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `view_master_department`
--

DROP TABLE IF EXISTS `view_master_department`;
/*!50001 DROP VIEW IF EXISTS `view_master_department`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `view_master_department` AS SELECT 
 1 AS `id_master_department`,
 1 AS `id_division`,
 1 AS `department_name`,
 1 AS `head_of_department`,
 1 AS `is_delete`,
 1 AS `id_auth_user`,
 1 AS `created_date`,
 1 AS `modify_date`,
 1 AS `division_name`,
 1 AS `head_of_department_name`,
 1 AS `id`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `view_master_destination_luar_negeri`
--

DROP TABLE IF EXISTS `view_master_destination_luar_negeri`;
/*!50001 DROP VIEW IF EXISTS `view_master_destination_luar_negeri`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `view_master_destination_luar_negeri` AS SELECT 
 1 AS `amount`,
 1 AS `id_master_destination`,
 1 AS `province`,
 1 AS `sub_regional`,
 1 AS `regional`,
 1 AS `id_master_group_golongan`,
 1 AS `alias`,
 1 AS `description`,
 1 AS `group_gol_name`,
 1 AS `is_delete`,
 1 AS `rangkin`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `view_master_division`
--

DROP TABLE IF EXISTS `view_master_division`;
/*!50001 DROP VIEW IF EXISTS `view_master_division`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `view_master_division` AS SELECT 
 1 AS `id_master_division`,
 1 AS `division_name`,
 1 AS `head_of_division`,
 1 AS `id_auth_user`,
 1 AS `created_date`,
 1 AS `modify_date`,
 1 AS `is_delete`,
 1 AS `head_of_division_name`,
 1 AS `id`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `view_project`
--

DROP TABLE IF EXISTS `view_project`;
/*!50001 DROP VIEW IF EXISTS `view_project`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `view_project` AS SELECT 
 1 AS `id_projects`,
 1 AS `code`,
 1 AS `invoice_number`,
 1 AS `title`,
 1 AS `description`,
 1 AS `start_date`,
 1 AS `end_date`,
 1 AS `created_date`,
 1 AS `created_by`,
 1 AS `status`,
 1 AS `is_delete`,
 1 AS `is_default`,
 1 AS `is_started`,
 1 AS `started_date`,
 1 AS `default_text`,
 1 AS `status_text`,
 1 AS `started`,
 1 AS `employee_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `view_spj_online`
--

DROP TABLE IF EXISTS `view_spj_online`;
/*!50001 DROP VIEW IF EXISTS `view_spj_online`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `view_spj_online` AS SELECT 
 1 AS `id_spj_online`,
 1 AS `spj_doc_no`,
 1 AS `employeeid`,
 1 AS `employee_requested`,
 1 AS `jobs_name`,
 1 AS `department_name`,
 1 AS `division_name`,
 1 AS `head_of_division_name`,
 1 AS `jobs_name_head`,
 1 AS `grade`,
 1 AS `grade_name`,
 1 AS `group_grade`,
 1 AS `sub_regional`,
 1 AS `province`,
 1 AS `regional`,
 1 AS `activityid`,
 1 AS `activity_name`,
 1 AS `activity_detail`,
 1 AS `start_date`,
 1 AS `end_date`,
 1 AS `status`,
 1 AS `is_delete`,
 1 AS `created_date`,
 1 AS `modify_date`,
 1 AS `id_auth_user`,
 1 AS `vehicle`,
 1 AS `employee_created`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `view_travel_bill`
--

DROP TABLE IF EXISTS `view_travel_bill`;
/*!50001 DROP VIEW IF EXISTS `view_travel_bill`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `view_travel_bill` AS SELECT 
 1 AS `id_travel_bill`,
 1 AS `id_spj_online`,
 1 AS `employeeid`,
 1 AS `employee_name`,
 1 AS `head_of_division`,
 1 AS `head_of_division_id`,
 1 AS `days`,
 1 AS `created_date`,
 1 AS `id_auth_user`,
 1 AS `spj_doc_no`,
 1 AS `status`,
 1 AS `status_spj`,
 1 AS `sub_regional`,
 1 AS `province`,
 1 AS `spj_date`,
 1 AS `jobs_name_head`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `xms_sessions`
--

DROP TABLE IF EXISTS `xms_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `xms_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xms_sessions`
--

LOCK TABLES `xms_sessions` WRITE;
/*!40000 ALTER TABLE `xms_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `xms_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `detail_projects`
--

/*!50001 DROP VIEW IF EXISTS `detail_projects`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;

/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `detail_projects` AS select `a`.`projectid` AS `projectid`,`a`.`total_employee` AS `total_employee`,ifnull(`b`.`total_hours`,0) AS `total_hours` from (`project_employee_summery` `a` left join `project_hours_summary` `b` on((`a`.`projectid` = `b`.`projectid`))) order by `a`.`projectid` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `project_employee_summery`
--

/*!50001 DROP VIEW IF EXISTS `project_employee_summery`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;

/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `project_employee_summery` AS select `a`.`projectid` AS `projectid`,count(`a`.`employeeid`) AS `total_employee` from (`mapping_project_employee` `a` join `projects` `b` on((`a`.`projectid` = `b`.`id_projects`))) where (`b`.`is_delete` = 0) group by `a`.`projectid` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `project_hours_summary`
--

/*!50001 DROP VIEW IF EXISTS `project_hours_summary`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;

/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `project_hours_summary` AS select `a`.`projectid` AS `projectid`,sum(`a`.`hours`) AS `total_hours` from (`tasks` `a` join `projects` `b` on((`a`.`projectid` = `b`.`id_projects`))) where (`b`.`is_delete` = 0) group by `a`.`projectid` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_employee`
--

/*!50001 DROP VIEW IF EXISTS `view_employee`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;


/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_employee` AS select `a`.`employeeid` AS `employeeid`,`b`.`f_password` AS `f_password`,`a`.`firstname` AS `firstname`,`a`.`lastname` AS `lastname`,`a`.`nik` AS `nik`,`a`.`golongan` AS `golongan`,`a`.`sex` AS `sex`,`a`.`department` AS `department`,`a`.`head_sub_division` AS `head_sub_division`,concat(`h`.`firstname`,' ',`h`.`lastname`) AS `head_sub_division_name`,`h`.`email` AS `head_sub_division_email`,`d`.`department_name` AS `department_name`,`e`.`id_master_division` AS `division`,`e`.`division_name` AS `division_name`,`f`.`golongan_name` AS `golongan_name`,`g`.`group_gol_name` AS `group_gol_name`,`g`.`id_master_group_golongan` AS `id_master_group_golongan`,`a`.`jobsid` AS `jobsid`,`c`.`jobs_name` AS `jobs_name`,`a`.`email` AS `email`,`a`.`handphone` AS `handphone`,`a`.`picture` AS `picture`,`a`.`unitid` AS `unitid`,`a`.`createdby` AS `createdby`,`a`.`createddate` AS `createddate`,`a`.`modifiedby` AS `modifiedby`,`a`.`modifieddate` AS `modifieddate`,`a`.`deleted` AS `deleted`,`a`.`userid` AS `userid` from (((((((`master_employee` `a` join `t_data_user` `b` on((`b`.`id` = `a`.`userid`))) join `jobs_title` `c` on((`c`.`id_jobs_title` = `a`.`jobsid`))) join `master_department` `d` on((`a`.`department` = `d`.`id_master_department`))) join `master_division` `e` on((`d`.`id_division` = `e`.`id_master_division`))) join `master_golongan` `f` on((`a`.`golongan` = `f`.`id_master_golongan`))) join `master_group_golongan` `g` on((`g`.`id_master_group_golongan` = `f`.`id_group`))) join `master_employee` `h` on((`h`.`employeeid` = `a`.`head_sub_division`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_frekuensi_perjalanan`
--

/*!50001 DROP VIEW IF EXISTS `view_frekuensi_perjalanan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;


/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_frekuensi_perjalanan` AS select `a`.`id_frekuensi_perjalanan` AS `id_frekuensi_perjalanan`,`a`.`name` AS `name`,`a`.`id_group_golongan` AS `id_group_golongan`,`a`.`amount` AS `amount`,`b`.`alias` AS `alias`,`b`.`group_gol_name` AS `group_gol_name` from (`frekuensi_perjalanan` `a` join `master_group_golongan` `b` on((`a`.`id_group_golongan` = `b`.`id_master_group_golongan`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_hotel_cost`
--

/*!50001 DROP VIEW IF EXISTS `view_hotel_cost`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;


/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_hotel_cost` AS select `a`.`id_master_hotel_cost` AS `id_master_hotel_cost`,`a`.`id_group_grade` AS `id_group_grade`,`a`.`province` AS `province`,`b`.`alias` AS `alias`,`b`.`description` AS `description`,`b`.`group_gol_name` AS `group_gol_name`,`a`.`amount` AS `amount`,`a`.`is_delete` AS `is_delete` from (`master_hotel_cost` `a` join `master_group_golongan` `b` on((`a`.`id_group_grade` = `b`.`id_master_group_golongan`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_master_department`
--

/*!50001 DROP VIEW IF EXISTS `view_master_department`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;


/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_master_department` AS select `a`.`id_master_department` AS `id_master_department`,`a`.`id_division` AS `id_division`,`a`.`department_name` AS `department_name`,`a`.`head_of_department` AS `head_of_department`,`a`.`is_delete` AS `is_delete`,`a`.`id_auth_user` AS `id_auth_user`,`a`.`created_date` AS `created_date`,`a`.`modify_date` AS `modify_date`,`b`.`division_name` AS `division_name`,concat(`c`.`firstname`,' ',`c`.`lastname`) AS `head_of_department_name`,`a`.`id_master_department` AS `id` from ((`master_department` `a` join `master_division` `b` on((`a`.`id_division` = `b`.`id_master_division`))) join `master_employee` `c` on((convert(`c`.`employeeid` using utf8mb4) = `a`.`head_of_department`))) where (`a`.`is_delete` = 0) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_master_destination_luar_negeri`
--

/*!50001 DROP VIEW IF EXISTS `view_master_destination_luar_negeri`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;


/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_master_destination_luar_negeri` AS select `a`.`amount` AS `amount`,`b`.`id_master_destination` AS `id_master_destination`,`b`.`province` AS `province`,`b`.`sub_regional` AS `sub_regional`,`b`.`regional` AS `regional`,`c`.`id_master_group_golongan` AS `id_master_group_golongan`,`c`.`alias` AS `alias`,`c`.`description` AS `description`,`c`.`group_gol_name` AS `group_gol_name`,`c`.`is_delete` AS `is_delete`,`c`.`rangkin` AS `rangkin` from ((`master_destination_golongan` `a` join `master_destination` `b` on((`a`.`id_destination` = `b`.`id_master_destination`))) join `master_group_golongan` `c` on((`a`.`id_group_golongan` = `c`.`id_master_group_golongan`))) where (`b`.`regional` = 'Luar Negeri') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_master_division`
--

/*!50001 DROP VIEW IF EXISTS `view_master_division`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;


/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_master_division` AS select `master_division`.`id_master_division` AS `id_master_division`,`master_division`.`division_name` AS `division_name`,`master_division`.`head_of_division` AS `head_of_division`,`master_division`.`id_auth_user` AS `id_auth_user`,`master_division`.`created_date` AS `created_date`,`master_division`.`modify_date` AS `modify_date`,`master_division`.`is_delete` AS `is_delete`,concat(`master_employee`.`firstname`,' ',`master_employee`.`lastname`) AS `head_of_division_name`,`master_division`.`id_master_division` AS `id` from (`master_division` join `master_employee` on((convert(`master_employee`.`employeeid` using utf8mb4) = `master_division`.`head_of_division`))) where (`master_division`.`is_delete` = 0) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_project`
--

/*!50001 DROP VIEW IF EXISTS `view_project`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;

/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_project` AS select `projects`.`id_projects` AS `id_projects`,`projects`.`code` AS `code`,`projects`.`invoice_number` AS `invoice_number`,`projects`.`title` AS `title`,`projects`.`description` AS `description`,`projects`.`start_date` AS `start_date`,`projects`.`end_date` AS `end_date`,`projects`.`created_date` AS `created_date`,`projects`.`created_by` AS `created_by`,`projects`.`status` AS `status`,`projects`.`is_delete` AS `is_delete`,`projects`.`is_default` AS `is_default`,`projects`.`is_started` AS `is_started`,`projects`.`started_date` AS `started_date`,(case when (`projects`.`is_default` = 0) then 'Common' when (`projects`.`is_default` = 1) then 'Default' else 'Not Define' end) AS `default_text`,(case when (`projects`.`status` = 1) then 'Open' when (`projects`.`status` = 2) then 'Close' else 'Cancel' end) AS `status_text`,(case when (`projects`.`is_started` = 1) then 'Active' else 'Not Yet' end) AS `started`,group_concat(concat(`master_employee`.`firstname`,' ',`master_employee`.`lastname`) order by `master_employee`.`firstname` ASC separator ',') AS `employee_name` from (((`projects` left join `mapping_project_employee` on((`projects`.`id_projects` = `mapping_project_employee`.`projectid`))) left join `master_employee` on((convert(`master_employee`.`employeeid` using utf8mb4) = `mapping_project_employee`.`employeeid`))) join `t_data_user` on((`t_data_user`.`id` = `master_employee`.`userid`))) where (`t_data_user`.`f_auth` = 1) group by `projects`.`id_projects` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_spj_online`
--

/*!50001 DROP VIEW IF EXISTS `view_spj_online`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;


/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_spj_online` AS select `a`.`id_spj_online` AS `id_spj_online`,`a`.`spj_doc_no` AS `spj_doc_no`,`a`.`employeeid` AS `employeeid`,concat(`b`.`firstname`,' ',`b`.`lastname`) AS `employee_requested`,`j`.`jobs_name` AS `jobs_name`,`g`.`department_name` AS `department_name`,`h`.`division_name` AS `division_name`,concat(`i`.`firstname`,' ',`i`.`lastname`) AS `head_of_division_name`,`l`.`jobs_name` AS `jobs_name_head`,`a`.`grade` AS `grade`,`d`.`golongan_name` AS `grade_name`,`e`.`group_gol_name` AS `group_grade`,`k`.`sub_regional` AS `sub_regional`,`k`.`province` AS `province`,`k`.`regional` AS `regional`,`a`.`activityid` AS `activityid`,`c`.`activity_name` AS `activity_name`,`a`.`activity_detail` AS `activity_detail`,`a`.`start_date` AS `start_date`,`a`.`end_date` AS `end_date`,`a`.`status` AS `status`,`a`.`is_delete` AS `is_delete`,`a`.`created_date` AS `created_date`,`a`.`modify_date` AS `modify_date`,`a`.`id_auth_user` AS `id_auth_user`,`a`.`vehicle` AS `vehicle`,concat(`f`.`f_firstname`,' ',`f`.`f_lastname`) AS `employee_created` from (((((((((((`spj_online` `a` join `master_employee` `b` on((`a`.`employeeid` = convert(`b`.`employeeid` using utf8mb4)))) join `master_activity` `c` on((`a`.`activityid` = `c`.`id_activity`))) join `master_golongan` `d` on((`a`.`grade` = `d`.`id_master_golongan`))) join `master_group_golongan` `e` on((`d`.`id_group` = `e`.`id_master_group_golongan`))) join `t_data_user` `f` on((`a`.`id_auth_user` = `f`.`id`))) join `master_department` `g` on((`b`.`department` = `g`.`id_master_department`))) join `master_division` `h` on((`g`.`id_division` = `h`.`id_master_division`))) join `master_employee` `i` on((`h`.`head_of_division` = convert(`i`.`employeeid` using utf8mb4)))) join `jobs_title` `j` on((`b`.`jobsid` = `j`.`id_jobs_title`))) join `master_destination` `k` on((`a`.`destinationid` = `k`.`id_master_destination`))) join `jobs_title` `l` on((`i`.`jobsid` = `l`.`id_jobs_title`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_travel_bill`
--

/*!50001 DROP VIEW IF EXISTS `view_travel_bill`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;


/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_travel_bill` AS select `a`.`id_travel_bill` AS `id_travel_bill`,`a`.`id_spj_online` AS `id_spj_online`,`a`.`employeeid` AS `employeeid`,`a`.`employee_name` AS `employee_name`,`a`.`head_of_division` AS `head_of_division`,`a`.`head_of_division_id` AS `head_of_division_id`,`a`.`days` AS `days`,`a`.`created_date` AS `created_date`,`a`.`id_auth_user` AS `id_auth_user`,`b`.`spj_doc_no` AS `spj_doc_no`,`a`.`status` AS `status`,`b`.`status` AS `status_spj`,`b`.`sub_regional` AS `sub_regional`,`b`.`province` AS `province`,`b`.`start_date` AS `spj_date`,`b`.`jobs_name_head` AS `jobs_name_head` from (`travel_bill` `a` join `view_spj_online` `b` on((`a`.`id_spj_online` = `b`.`id_spj_online`))) where (`b`.`is_delete` = 0) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-27 13:56:45
