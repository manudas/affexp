-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: affexp
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.17.04.1

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
  `id_configuration` int(11) NOT NULL,
  `model_name` varchar(128) NOT NULL,
  `function_name` varchar(128) NOT NULL,
  `configuration_key` varchar(128) DEFAULT NULL,
  `configuration_value` varchar(512) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_configuration`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image` (
  `id_image` int(11) NOT NULL,
  `id_image_group` int(11) DEFAULT NULL,
  `imgsrc` varchar(512) DEFAULT NULL,
  `img_description` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT '0',
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_image`),
  KEY `id_image_group` (`id_image_group`),
  CONSTRAINT `image_ibfk_1` FOREIGN KEY (`id_image_group`) REFERENCES `imagegroup` (`id_image_group`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES (1,1,'assets/img/merchant/merchant_logo/ao.com-logo.jpg','logo',0,1),(2,2,'assets/img/merchant/merchant_logo/argos-logo.jpg','logo',0,1),(3,3,'assets/img/merchant/merchant_logo/boots-logo.png','logo',0,1),(4,4,'assets/img/merchant/merchant_logo/currys-logo.png','logo',0,1),(5,5,'assets/img/merchant/merchant_logo/debenhams-logo.jpg','logo',0,1),(6,6,'assets/img/merchant/merchant_logo/dunelm-logo.png','logo',0,1),(7,7,'assets/img/merchant/merchant_logo/expedia-logo.jpg','logo',0,1),(8,8,'assets/img/merchant/merchant_logo/first-choice-logo.png','logo',0,1),(9,9,'assets/img/merchant/merchant_logo/groupon-logo.jpg','logo',0,1),(10,10,'assets/img/merchant/merchant_logo/jet2holidays-logo.png','logo',0,1),(11,11,'assets/img/merchant/merchant_logo/john-lewis-logo.png','logo',0,1),(12,12,'assets/img/merchant/merchant_logo/lastminute.com-logo.png','logo',0,1),(13,13,'assets/img/merchant/merchant_logo/marks-and-spencer-logo.png','logo',0,1),(14,14,'assets/img/merchant/merchant_logo/myprotein-logo.gif','logo',0,1),(15,15,'assets/img/merchant/merchant_logo/phase-eight-logo.jpg','logo',0,1),(16,16,'assets/img/merchant/merchant_logo/thomas-cook-logo.png','logo',0,1),(17,17,'assets/img/merchant/merchant_logo/thomson-logo.png','logo',0,1),(18,18,'assets/img/merchant/merchant_logo/travelodge-logo.png','logo',0,1),(19,19,'assets/img/merchant/merchant_logo/vodafone-logo.jpg','logo',0,1),(20,20,'assets/img/merchant/merchant_logo/worldstores-logo.png','logo',0,1);
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagegroup`
--

DROP TABLE IF EXISTS `imagegroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagegroup` (
  `id_image_group` int(11) NOT NULL,
  `type` enum('merchant','publication','category','other') DEFAULT 'other',
  `img_group_description` varchar(256) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_image_group`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagegroup`
--

LOCK TABLES `imagegroup` WRITE;
/*!40000 ALTER TABLE `imagegroup` DISABLE KEYS */;
INSERT INTO `imagegroup` VALUES (1,'merchant','Ao.com',1),(2,'merchant','Argos',1),(3,'merchant','Boots',1),(4,'merchant','Currys',1),(5,'merchant','Debenhams',1),(6,'merchant','Dunelm',1),(7,'merchant','Expedia',1),(8,'merchant','First Choice',1),(9,'merchant','Groupon',1),(10,'merchant','Jet2holidays',1),(11,'merchant','John Lewis',1),(12,'merchant','Lastminute.com',1),(13,'merchant','Marks and Spencer',1),(14,'merchant','Myprotein',1),(15,'merchant','Phase Eight',1),(16,'merchant','Thomas Cook',1),(17,'merchant','Thomson',1),(18,'merchant','Travelodge',1),(19,'merchant','Vodafone',1),(20,'merchant','Worldstores',1);
/*!40000 ALTER TABLE `imagegroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libraries`
--

DROP TABLE IF EXISTS `libraries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libraries` (
  `id_library` int(11) NOT NULL AUTO_INCREMENT,
  `model_name` varchar(128) NOT NULL,
  `function_name` varchar(128) NOT NULL,
  `autoloaded_library_name` varchar(512) NOT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_library`),
  UNIQUE KEY `model_name` (`model_name`,`function_name`,`autoloaded_library_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libraries`
--

LOCK TABLES `libraries` WRITE;
/*!40000 ALTER TABLE `libraries` DISABLE KEYS */;
INSERT INTO `libraries` VALUES (1,'synchronization','syncNetwork','ExternalUrlLoader',1);
/*!40000 ALTER TABLE `libraries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links` (
  `id_link` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `url` varchar(1024) NOT NULL,
  `category_token` varchar(128) DEFAULT NULL,
  `order` int(11) DEFAULT '0',
  `model_name` varchar(128) NOT NULL,
  `function_name` varchar(128) NOT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_link`),
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
  `id_merchant` int(11) NOT NULL,
  `id_category` int(11) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `id_image_group` int(11) DEFAULT NULL,
  `url` varchar(512) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_merchant`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `merchant`
--

LOCK TABLES `merchant` WRITE;
/*!40000 ALTER TABLE `merchant` DISABLE KEYS */;
INSERT INTO `merchant` VALUES (1,NULL,'Ao.com',1,'//www.google.es',1),(2,NULL,'Argos',2,'//www.google.es',1),(3,NULL,'Boots',3,'//www.google.es',1),(4,NULL,'Currys',4,'//www.google.es',1),(5,NULL,'Debenhams',5,'//www.google.es',1),(6,NULL,'Dunelm',6,'//www.google.es',1),(7,NULL,'Expedia',7,'//www.google.es',1),(8,NULL,'First Choice',8,'//www.google.es',1),(9,NULL,'Groupon',9,'//www.google.es',1),(10,NULL,'Jet2holidays',10,'//www.google.es',1),(11,NULL,'John Lewis',11,'//www.google.es',1),(12,NULL,'Lastminute.com',12,'//www.google.es',1),(13,NULL,'Marks and Spencer',13,'//www.google.es',1),(14,NULL,'Myprotein',14,'//www.google.es',1),(15,NULL,'Phase Eight',15,'//www.google.es',1),(16,NULL,'Thomas Cook',16,'//www.google.es',1),(17,NULL,'Thomson',17,'//www.google.es',1),(18,NULL,'Travelodge',18,'//www.google.es',1),(19,NULL,'Vodafone',19,'//www.google.es',1),(20,NULL,'Worldstores',20,'//www.google.es',1);
/*!40000 ALTER TABLE `merchant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `models`
--

DROP TABLE IF EXISTS `models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `models` (
  `id_model` int(11) NOT NULL AUTO_INCREMENT,
  `model_name` varchar(128) NOT NULL,
  `function_name` varchar(128) NOT NULL,
  `autoloaded_model_name` varchar(512) NOT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_model`),
  UNIQUE KEY `model_name` (`model_name`,`function_name`,`autoloaded_model_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `models`
--

LOCK TABLES `models` WRITE;
/*!40000 ALTER TABLE `models` DISABLE KEYS */;
INSERT INTO `models` VALUES (1,'home','load_home','merchant',1),(2,'home','load_home','imageGroup',1),(3,'home','load_home','image',1),(4,'synchronization','syncNetwork','network',1);
/*!40000 ALTER TABLE `models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `network`
--

DROP TABLE IF EXISTS `network`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `network` (
  `id_network` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(128) NOT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_network`),
  UNIQUE KEY `tag` (`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `network`
--

LOCK TABLES `network` WRITE;
/*!40000 ALTER TABLE `network` DISABLE KEYS */;
/*!40000 ALTER TABLE `network` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `id_merchant` int(11) NOT NULL,
  `external_id_product` int(11) NOT NULL,
  `id_network` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_product`),
  UNIQUE KEY `id_network` (`id_network`,`external_id_product`),
  KEY `id_merchant` (`id_merchant`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_merchant`) REFERENCES `merchant` (`id_merchant`),
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`id_network`) REFERENCES `network` (`id_network`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `translations` (
  `id_translation` int(11) NOT NULL,
  `model_name` varchar(128) NOT NULL,
  `function_name` varchar(128) NOT NULL,
  `file_name` varchar(512) NOT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_translation`),
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
  `id_view` int(11) NOT NULL,
  `model_name` varchar(128) NOT NULL,
  `function_name` varchar(128) NOT NULL,
  `view_name` varchar(512) NOT NULL,
  `order` int(11) DEFAULT '0',
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_view`),
  UNIQUE KEY `model_name` (`model_name`,`function_name`,`view_name`,`order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `views`
--

LOCK TABLES `views` WRITE;
/*!40000 ALTER TABLE `views` DISABLE KEYS */;
INSERT INTO `views` VALUES (1,'home','load_home','merchant/merchant_logo_view/merchant_logo_view',0,1),(2,'default','previous','header_view/header_view',0,1),(3,'default','posterior','footer/footer_view/footer_view',0,1),(4,'home','load_home','top_categories_top_offers_exclusive/top_categories_top_offers_exclusive',1,1),(5,'home','load_home','top_list_featured/top_list_featured',2,1);
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

-- Dump completed on 2017-11-20  7:47:39
