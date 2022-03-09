-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: localhost    Database: Gs
-- ------------------------------------------------------
-- Server version	5.7.33-0ubuntu0.16.04.1

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
-- Table structure for table `Carts`
--

DROP TABLE IF EXISTS `Carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Carts` (
  `Cart_Id` int(255) NOT NULL AUTO_INCREMENT,
  `Customer_Id` int(255) NOT NULL,
  `Item_Id` int(255) NOT NULL,
  `Cart_Quantity` double NOT NULL DEFAULT '1',
  PRIMARY KEY (`Cart_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Carts`
--

LOCK TABLES `Carts` WRITE;
/*!40000 ALTER TABLE `Carts` DISABLE KEYS */;
INSERT INTO `Carts` VALUES (2,1,2,4),(7,1,4,2),(8,3,1,4),(9,3,3,4),(10,2,2,3),(11,2,6,2),(12,3,5,1),(13,17,4,3),(14,17,3,1),(15,17,5,2),(16,17,7,3),(17,19,4,2),(18,19,5,1),(19,19,3,1),(20,20,3,1),(21,20,7,1),(22,21,5,5),(23,21,7,2),(24,22,3,1),(25,22,2,2),(26,23,3,12),(32,27,5,2),(33,27,1,4),(34,27,3,1),(35,27,2,1),(37,25,2,5),(39,31,1,1),(40,33,7,1),(41,33,2,1),(42,33,1,1);
/*!40000 ALTER TABLE `Carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Customers`
--

DROP TABLE IF EXISTS `Customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Customers` (
  `Customer_Id` int(255) NOT NULL AUTO_INCREMENT,
  `Customer_Name` varchar(255) NOT NULL,
  `Customer_Date` datetime NOT NULL,
  PRIMARY KEY (`Customer_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Customers`
--

LOCK TABLES `Customers` WRITE;
/*!40000 ALTER TABLE `Customers` DISABLE KEYS */;
INSERT INTO `Customers` VALUES (1,'User1','2021-03-24 09:08:00'),(2,'Guest','2021-04-04 04:31:30'),(3,'Guest','2021-04-04 04:32:00'),(4,'Guest','2021-04-04 04:33:12'),(5,'Guest','2021-04-04 04:33:13'),(6,'Guest','2021-04-04 04:33:14'),(7,'Guest','2021-04-04 04:33:15'),(8,'Guest','2021-04-04 04:33:15'),(9,'Guest','2021-04-04 04:38:57'),(10,'Guest','2021-04-04 04:38:58'),(11,'Guest','2021-04-04 04:38:59'),(12,'Guest','2021-04-04 04:39:00'),(13,'Guest','2021-04-04 04:39:00'),(14,'Guest','2021-04-04 04:39:00'),(15,'Guest','2021-04-04 04:39:01'),(16,'Guest','2021-04-04 04:39:01'),(17,'Guest','2021-04-04 04:39:03'),(18,'Guest','2021-04-04 05:00:22'),(19,'Guest','2021-04-04 05:00:24'),(20,'Guest','2021-04-04 05:02:21'),(21,'Guest','2021-04-04 05:04:10'),(22,'Guest','2021-04-04 05:27:15'),(23,'Guest','2021-04-04 06:24:49'),(24,'Guest','2021-04-04 06:25:39'),(25,'Guest','2021-04-04 06:48:46'),(26,'Guest','2021-04-04 06:52:18'),(27,'Guest','2021-04-04 06:52:29'),(28,'Guest','2021-04-04 07:02:13'),(29,'Guest','2021-04-04 07:24:37'),(30,'Guest','2021-04-04 07:45:46'),(31,'Guest','2021-04-04 08:06:04'),(32,'Guest','2021-04-04 08:09:35'),(33,'Guest','2021-04-04 08:13:48'),(34,'Guest','2021-04-04 09:25:38'),(35,'Guest','2021-04-04 09:32:54');
/*!40000 ALTER TABLE `Customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Items`
--

DROP TABLE IF EXISTS `Items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Items` (
  `Item_Id` int(255) NOT NULL AUTO_INCREMENT,
  `Item_Name` varchar(250) NOT NULL,
  `Item_Image` longtext NOT NULL,
  `Item_Price` varchar(50) NOT NULL,
  `Type_Game_Id` int(255) NOT NULL,
  `Item_Status` int(2) NOT NULL,
  PRIMARY KEY (`Item_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Items`
--

LOCK TABLES `Items` WRITE;
/*!40000 ALTER TABLE `Items` DISABLE KEYS */;
INSERT INTO `Items` VALUES (1,'CALL OF DUTY','CALL OF DUTY.jpg','255',1,1),(2,'Uncharted','Uncharted.jpg','63',1,1),(3,'sims4','sims4.jpg','110',1,1),(4,'Crash','Crash.jpg','139',1,1),(5,'Forza','Forza.jpg','225',3,1),(6,'Fifa19','Fifa19.jpg','150',5,1),(7,'Mine craft','Mine craft.jpg','440',3,1);
/*!40000 ALTER TABLE `Items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Products`
--

DROP TABLE IF EXISTS `Products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Products` (
  `Product_Id` int(255) NOT NULL AUTO_INCREMENT,
  `Product_Name` varchar(250) NOT NULL,
  `Product_Status` int(2) NOT NULL,
  PRIMARY KEY (`Product_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Products`
--

LOCK TABLES `Products` WRITE;
/*!40000 ALTER TABLE `Products` DISABLE KEYS */;
INSERT INTO `Products` VALUES (1,'Video games',1),(2,'Party games',0),(3,'Tabletop games',0);
/*!40000 ALTER TABLE `Products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Types_Games`
--

DROP TABLE IF EXISTS `Types_Games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Types_Games` (
  `Type_Game_Id` int(255) NOT NULL AUTO_INCREMENT,
  `Type_Game_Name` varchar(200) NOT NULL,
  `Product_Id` int(255) NOT NULL,
  `Type_Game_Status` int(2) NOT NULL,
  PRIMARY KEY (`Type_Game_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Types_Games`
--

LOCK TABLES `Types_Games` WRITE;
/*!40000 ALTER TABLE `Types_Games` DISABLE KEYS */;
INSERT INTO `Types_Games` VALUES (1,'Playstation games',1,1),(2,'Xbox games',1,1),(3,'Action games',1,1),(4,'Puzzle games',1,1),(5,'Sports games',1,1);
/*!40000 ALTER TABLE `Types_Games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'Gs'
--

--
-- Dumping routines for database 'Gs'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-05 19:36:04
