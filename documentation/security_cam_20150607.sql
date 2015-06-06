-- MySQL dump 10.13  Distrib 5.6.20, for Win32 (x86)
--
-- Host: localhost    Database: security_cam
-- ------------------------------------------------------
-- Server version	5.6.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `security_cam`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `security_cam` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `security_cam`;

--
-- Table structure for table `tbl_stream`
--

DROP TABLE IF EXISTS `tbl_stream`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_stream` (
  `ip` varchar(15) NOT NULL,
  `port` varchar(5) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ip`,`port`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_stream`
--

LOCK TABLES `tbl_stream` WRITE;
/*!40000 ALTER TABLE `tbl_stream` DISABLE KEYS */;
INSERT INTO `tbl_stream` VALUES ('1.1.1.1','8554','Go'),('123.123.123.123','8554','My Stream');
/*!40000 ALTER TABLE `tbl_stream` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_video`
--

DROP TABLE IF EXISTS `tbl_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `filename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_video`
--

LOCK TABLES `tbl_video` WRITE;
/*!40000 ALTER TABLE `tbl_video` DISABLE KEYS */;
INSERT INTO `tbl_video` VALUES (1,'2015-05-20','14:19:03','SummerJam.mp4'),(2,'2015-05-20','14:33:44','SummerJam.mp4'),(3,'2015-05-20','14:33:45','SummerJam.mp4'),(4,'2015-05-18','14:33:45','SummerJam.mp4');
/*!40000 ALTER TABLE `tbl_video` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-07  1:04:33
