-- Progettazione Web 
DROP DATABASE if exists supernova; 
CREATE DATABASE supernova; 
USE supernova; 
-- MySQL dump 10.13  Distrib 5.6.20, for Win32 (x86)
--
-- Host: localhost    Database: supernova
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
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `email` varchar(45) NOT NULL,
  `garmentId` int(11) NOT NULL,
  `size` char(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`email`,`garmentId`,`size`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES ('admin',1,'L',2,100),('admin',2,'L',1,500),('francescomarino96@yahoo.com',2,'L',1,500),('martina.marino1996@gmail.com',1,'L',2,100),('martina.marino1996@gmail.com',9,'M',2,192),('rosa.campana05@gmail.com',4,'S',1,0);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `garment`
--

DROP TABLE IF EXISTS `garment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `garment` (
  `garmentId` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(45) NOT NULL,
  `color` char(45) NOT NULL,
  `category` char(45) NOT NULL,
  `genre` varchar(45) NOT NULL DEFAULT 'female',
  `collection` char(45) NOT NULL,
  `released` date NOT NULL,
  `discountedPrice` int(11) DEFAULT NULL,
  `price` double NOT NULL,
  `img` varchar(45) NOT NULL,
  PRIMARY KEY (`garmentId`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `garment`
--

LOCK TABLES `garment` WRITE;
/*!40000 ALTER TABLE `garment` DISABLE KEYS */;
INSERT INTO `garment` VALUES (1,'Abito Jasmine','Ash Cheetah','clothing','female','S/S','0000-00-00',100,221,'immagini/garments/garment1.jpg'),(2,'Abito da sera Hanna','Multicolor','clothing','female','S/S','2019-10-10',500,993,'immagini/garments/garment2.jpg'),(3,'Abito Ray','Gold','clothing','female','A/W','2019-10-10',NULL,95,'immagini/garments/garment3.jpg'),(4,'Abito da sera','Black','clothing','female','S/S','2019-10-10',NULL,587,'immagini/garments/garment4.jpg'),(5,'Abito Darian','Blue','clothing','female','S/S','2019-06-15',NULL,271,'immagini/garments/garment5.jpg'),(6,'Top e gonna Mia','Pink','clothing','female','S/S','2019-06-15',NULL,234,'immagini/garments/garment6.jpg'),(7,'Abito Adella','Black','clothing','female','S/S','2019-06-15',NULL,150,'immagini/garments/garment7.jpg'),(8,'Abito mini Kimmie','Black','clothing','female','S/S','2019-06-15',NULL,243,'immagini/garments/garment8.jpg'),(9,'Aderente Delacey','Black Noir','clothing','female','S/S','2019-06-15',NULL,192,'immagini/garments/garment9.jpg'),(10,'Midi senza spalline Violet','Marigold','clothing','female','S/S','2019-06-15',NULL,169,'immagini/garments/garment10.jpg'),(11,'Abito midi Ryden','Casa Rose Mauve Tie Dye','clothing','female','S/S','2019-06-15',NULL,161,'immagini/garments/garment11.jpg'),(12,'Abito a incrocio Gabrielle','Unicorn Stripes','clothing','female','S/S','2019-06-15',NULL,743,'immagini/garments/garment12.jpg'),(13,'Abito mini Adora','Mixed Ditsy Floral','clothing','female','S/S','2019-06-15',NULL,351,'immagini/garments/garment13.jpg'),(14,'Abito Maribelle','French Blue Floral','clothing','female','S/S','2019-06-15',NULL,545,'immagini/garments/garment14.jpg'),(15,'Abito mini Tally','Electric Teal','clothing','female','S/S','2019-06-15',NULL,243,'immagini/garments/garment15.jpg'),(16,'Abito Tate','Blush','clothing','female','S/S','2019-06-15',NULL,260,'immagini/garments/garment16.jpg'),(17,'Abito Kate','Black; Lava','clothing','female','S/S','2019-06-15',NULL,126,'immagini/garments/garment17.jpg'),(18,'Abito Danielle','White','clothing','female','S/S','2019-06-15',NULL,836,'immagini/garments/garment18.jpg'),(19,'Abito St Lucia','Tan Multi','clothing','female','A/W','2019-09-01',NULL,346,'immagini/garments/garment19.jpg'),(20,'Abito mini Darla','Fuchsia Floral','clothing','female','S/S','2019-06-15',NULL,305,'immagini/garments/garment20.jpg'),(21,'Abito mini opposites attract','Black','clothing','female','A/W','2019-09-01',NULL,150,'immagini/garments/garment21.jpg'),(22,'Jeans anni \'90','Fall Out','clothing','female','A/W','2019-06-15',NULL,221,'immagini/garments/garment22.jpg'),(23,'Shorts Jaden','Surreal','clothing','female','S/S','2019-06-15',NULL,150,'immagini/garments/garment23.jpg'),(24,'Giacca Jeanie','Light Retro Ripped','clothing','female','A/W','2019-06-15',NULL,123,'immagini/garments/garment24.jpg'),(25,'Gonna Quinn','Cult','clothing','female','S/S','2019-06-15',NULL,150,'immagini/garments/garment25.jpg'),(26,'Gonna','Spartacus','clothing','female','S/S','2019-08-20',NULL,92,'immagini/garments/garment26.jpg'),(27,'Leggins-Jeans Plenty','Black Metal','clothing','female','A/W','2019-09-01',NULL,104,'immagini/garments/garment27.jpg'),(28,'Felpa con cappuccio','Black','clothing','male','A/W','2019-08-20',NULL,117,'immagini/garments/garment28.jpg'),(29,'Felpa con cappuccio Falpa','Optic White & Multi','clothing','male','A/W','2019-09-01',NULL,216,'immagini/garments/garment29.jpg'),(30,'Marcus Tie Dye Hoodie','Multi','clothing','male','A/W','2019-09-01',NULL,246,'immagini/garments/garment30.jpg'),(31,'Jogger Legacy','Tan','clothing','male','A/W','2019-08-20',NULL,106,'immagini/garments/garment31.jpg'),(32,'Berretto Stussy','Rust','accessories','male','A/W','2019-08-20',NULL,40,'immagini/garments/garment32.jpg'),(33,'Hook Belt','Black','accessories','male','A/W','2019-09-01',NULL,102,'immagini/garments/garment33.jpg'),(34,'Borsa a tracolla','Caramel','accessories','female','A/W','2019-08-20',NULL,516,'immagini/garments/garment34.jpg'),(35,'Borsa tote Alice Maison','Natural','accessories','female','S/S','2019-06-15',NULL,253,'immagini/garments/garment35.jpg'),(36,'Zaino Kanken','Lake blue','accessories','male','A/W','2019-08-20',NULL,90,'immagini/garments/garment36.jpg'),(37,'Emory Parka','Graphite','clothing','male','A/W','2019-09-01',NULL,1238,'immagini/garments/garment37.jpg');
/*!40000 ALTER TABLE `garment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `email` varchar(45) NOT NULL,
  `codice` int(11) NOT NULL AUTO_INCREMENT,
  `totale` double NOT NULL,
  `data` date NOT NULL,
  `stato` varchar(45) NOT NULL,
  `pagamento` varchar(45) NOT NULL,
  PRIMARY KEY (`codice`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES ('martina.marino1996@gmail.com',1,180,'2019-09-19','shipped','Paypal'),('martina.marino1996@gmail.com',2,150,'2019-09-19','delivered','Paypal');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_garment`
--

DROP TABLE IF EXISTS `order_garment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_garment` (
  `orderId` int(11) NOT NULL,
  `garmentId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `garmentSize` varchar(45) NOT NULL,
  `color` varchar(45) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`orderId`,`garmentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_garment`
--

LOCK TABLES `order_garment` WRITE;
/*!40000 ALTER TABLE `order_garment` DISABLE KEYS */;
INSERT INTO `order_garment` VALUES (1,1,2,'S','Black',100),(1,2,10,'M','Yellow',50),(1,3,2,'L','Red',30),(2,3,2,'S','Gold',50),(2,4,1,'M','Black',25),(2,5,1,'L','Blue',25);
/*!40000 ALTER TABLE `order_garment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock` (
  `garmentId` int(11) NOT NULL,
  `size` char(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`garmentId`,`size`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock`
--

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
INSERT INTO `stock` VALUES (0,'',0),(1,'L',7),(1,'M',10),(1,'S',10),(2,'L',10),(2,'M',10),(2,'S',10),(3,'M',10),(3,'S',0),(4,'M',10),(4,'S',10),(5,'M',0),(5,'S',0),(6,'M',10),(6,'S',10),(7,'M',10),(7,'S',10),(8,'M',10),(8,'S',10),(9,'M',10),(9,'S',10),(10,'M',10),(10,'S',10),(11,'M',10),(11,'S',10),(12,'M',10),(12,'S',10),(13,'M',10),(13,'S',10),(14,'M',10),(14,'S',10),(15,'M',10),(15,'S',10),(16,'M',10),(16,'S',10),(17,'M',10),(17,'S',10),(18,'M',10),(18,'S',10),(19,'M',10),(19,'S',10),(20,'M',10),(20,'S',10),(21,'M',10),(21,'S',10),(22,'M',10),(22,'S',10),(23,'M',10),(23,'S',10),(24,'M',10),(24,'S',10),(25,'M',10),(25,'S',10),(26,'M',10),(26,'S',10),(27,'M',10),(27,'S',10),(28,'M',10),(28,'S',10),(29,'M',10),(29,'S',10),(30,'M',10),(30,'S',10),(31,'M',10),(31,'S',10),(32,'M',10),(32,'S',10),(33,'M',10),(33,'S',10),(34,'M',10),(34,'S',10),(35,'M',10),(35,'S',10),(36,'M',10),(36,'S',10),(37,'M',10),(37,'S',10);
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `amministratore` tinyint(4) NOT NULL DEFAULT '0',
  `nome` varchar(45) NOT NULL,
  `cognome` varchar(45) NOT NULL,
  `genere` varchar(45) NOT NULL,
  `newsletter` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('admin','admin',1,'admin','admin','female',0),('francescomarino96@yahoo.com','ciao',0,'Francesco','Marino','male',0),('ilaria.marino2001@gmail.com','ciaoden',0,'Ilaria','Marino','female',0),('luciano.marino.sp@gmail.com','luciano',0,'luciano','marino','male',0),('martina.marino1996@gmail.com','ciao',0,'Martina','Marino','female',1),('rosa.campana05@gmail.com','stella',0,'rosa','campana','female',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_garment`
--

DROP TABLE IF EXISTS `user_garment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_garment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `garmentId` int(11) NOT NULL,
  `desired` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_garment`
--

LOCK TABLES `user_garment` WRITE;
/*!40000 ALTER TABLE `user_garment` DISABLE KEYS */;
INSERT INTO `user_garment` VALUES (1,'martina.marino1996@gmail.com',1,1),(2,'martina.marino1996@gmail.com',5,1),(4,'martina.marino1996@gmail.com',2,0),(7,'martina.marino1996@gmail.com',7,0),(10,'martina.marino1996@gmail.com',12,0),(11,'martina.marino1996@gmail.com',15,0),(16,'francescomarino96@yahoo.com',31,0),(17,'francescomarino96@yahoo.com',28,0),(18,'martina.marino1996@gmail.com',9,0),(21,'martina.marino1996@gmail.com',30,0),(24,'luciano.marino.sp@gmail.com',34,0),(27,'luciano.marino.sp@gmail.com',3,1),(29,'luciano.marino.sp@gmail.com',29,0),(30,'luciano.marino.sp@gmail.com',6,0),(31,'luciano.marino.sp@gmail.com',4,0),(33,'luciano.marino.sp@gmail.com',32,0),(34,'luciano.marino.sp@gmail.com',33,0),(35,'martina.marino1996@gmail.com',18,0),(36,'martina.marino1996@gmail.com',19,1),(37,'martina.marino1996@gmail.com',20,0),(123,'martina.marino1996@gmail.com',8,1),(124,'martina.marino1996@gmail.com',11,0),(125,'martina.marino1996@gmail.com',10,1),(126,'martina.marino1996@gmail.com',3,0),(127,'martina.marino1996@gmail.com',6,1),(128,'',1,1),(129,'admin',1,0),(130,'admin',2,0),(131,'admin',3,0),(132,'',3,1),(133,'',4,1),(134,'',2,1),(135,'rosa.campana05@gmail.com',2,0),(136,'rosa.campana05@gmail.com',1,0),(137,'rosa.campana05@gmail.com',4,0),(138,'rosa.campana05@gmail.com',3,0),(139,'martina.marino1996@gmail.com',32,1),(140,'martina.marino1996@gmail.com',24,1),(141,'admin',5,0),(142,'francescomarino96@yahoo.com',1,0),(143,'francescomarino96@yahoo.com',2,0),(144,'francescomarino96@yahoo.com',3,1),(145,'francescomarino96@yahoo.com',4,0),(146,'francescomarino96@yahoo.com',19,1);
/*!40000 ALTER TABLE `user_garment` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-12 11:03:53
