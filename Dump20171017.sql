-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: affexp
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.1

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
-- Table structure for table `configurations`
--

DROP TABLE IF EXISTS `configurations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configurations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_name` varchar(128) NOT NULL,
  `function_name` varchar(128) NOT NULL,
  `configuration_key` varchar(128) DEFAULT NULL,
  `configuration_value` varchar(512) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configurations`
--

LOCK TABLES `configurations` WRITE;
/*!40000 ALTER TABLE `configurations` DISABLE KEYS */;
INSERT INTO `configurations` VALUES (1,'home','load_home','title','Titulo: el lugar de las ofertas',1),(2,'home','load_home','siteurl','manu.link',1),(3,'home','load_home','sitename','manu.link',1);
/*!40000 ALTER TABLE `configurations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `url` varchar(1024) NOT NULL,
  `category_token` varchar(128) DEFAULT NULL,
  `order` int(11) DEFAULT '0',
  `model_name` varchar(128) NOT NULL,
  `function_name` varchar(128) NOT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `model_name` (`model_name`,`function_name`,`order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links`
--

LOCK TABLES `links` WRITE;
/*!40000 ALTER TABLE `links` DISABLE KEYS */;
/*!40000 ALTER TABLE `links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `merchant`
--

DROP TABLE IF EXISTS `merchant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `merchant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `img` varchar(512) DEFAULT NULL,
  `url` varchar(512) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `merchant`
--

LOCK TABLES `merchant` WRITE;
/*!40000 ALTER TABLE `merchant` DISABLE KEYS */;
INSERT INTO `merchant` VALUES (1,NULL,'Ao.com','assets/img/merchant/merchant_logo/ao.com-logo.jpg','//www.google.es',1),(2,NULL,'Argos','assets/img/merchant/merchant_logo/argos-logo.jpg','//www.google.es',1),(3,NULL,'Boots','assets/img/merchant/merchant_logo/boots-logo.png','//www.google.es',1),(4,NULL,'Currys','assets/img/merchant/merchant_logo/currys-logo.png','//www.google.es',1),(5,NULL,'Debenhams','assets/img/merchant/merchant_logo/debenhams-logo.jpg','//www.google.es',1),(6,NULL,'Dunelm','assets/img/merchant/merchant_logo/dunelm-logo.png','//www.google.es',1),(7,NULL,'Expedia','assets/img/merchant/merchant_logo/expedia-logo.jpg','//www.google.es',1),(8,NULL,'First Choice','assets/img/merchant/merchant_logo/first-choice-logo.png','//www.google.es',1),(9,NULL,'Groupon','assets/img/merchant/merchant_logo/groupon-logo.jpg','//www.google.es',1),(10,NULL,'Jet2holidays','assets/img/merchant/merchant_logo/jet2holidays-logo.png','//www.google.es',1),(11,NULL,'John Lewis','assets/img/merchant/merchant_logo/john-lewis-logo.png','//www.google.es',1),(12,NULL,'Lastminute.com','assets/img/merchant/merchant_logo/lastminute.com-logo.png','//www.google.es',1),(13,NULL,'Marks and Spencer','assets/img/merchant/merchant_logo/marks-and-spencer-logo.png','//www.google.es',1),(14,NULL,'Myprotein','assets/img/merchant/merchant_logo/myprotein-logo.gif','//www.google.es',1),(15,NULL,'Phase Eight','assets/img/merchant/merchant_logo/phase-eight-logo.jpg','//www.google.es',1),(16,NULL,'Thomas Cook','assets/img/merchant/merchant_logo/thomas-cook-logo.png','//www.google.es',1),(17,NULL,'Thomson','assets/img/merchant/merchant_logo/thomson-logo.png','//www.google.es',1),(18,NULL,'Travelodge','assets/img/merchant/merchant_logo/travelodge-logo.png','//www.google.es',1),(19,NULL,'Vodafone','assets/img/merchant/merchant_logo/vodafone-logo.jpg','//www.google.es',1),(20,NULL,'Worldstores','assets/img/merchant/merchant_logo/worldstores-logo.png','//www.google.es',1);
/*!40000 ALTER TABLE `merchant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `models`
--

DROP TABLE IF EXISTS `models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `models` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_name` varchar(128) NOT NULL,
  `function_name` varchar(128) NOT NULL,
  `autoloaded_model_name` varchar(512) NOT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `model_name` (`model_name`,`function_name`,`autoloaded_model_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `models`
--

LOCK TABLES `models` WRITE;
/*!40000 ALTER TABLE `models` DISABLE KEYS */;
INSERT INTO `models` VALUES (1,'home','load_home','merchant',1);
/*!40000 ALTER TABLE `models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_name` varchar(128) NOT NULL,
  `function_name` varchar(128) NOT NULL,
  `file_name` varchar(512) NOT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `model_name` (`model_name`,`function_name`,`file_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translations`
--

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `views`
--

DROP TABLE IF EXISTS `views`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_name` varchar(128) NOT NULL,
  `function_name` varchar(128) NOT NULL,
  `view_name` varchar(512) NOT NULL,
  `order` int(11) DEFAULT '0',
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `model_name` (`model_name`,`function_name`,`view_name`,`order`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `views`
--

LOCK TABLES `views` WRITE;
/*!40000 ALTER TABLE `views` DISABLE KEYS */;
INSERT INTO `views` VALUES (1,'home','load_home','merchant/merchant_logo_view/merchant_logo_view',0,1),(2,'default','previous','login_bar/login_bar',0,1),(3,'default','previous','header_bar/header_bar',1,1);
/*!40000 ALTER TABLE `views` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-17 15:38:50
