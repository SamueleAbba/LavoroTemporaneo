-- MariaDB dump 10.19  Distrib 10.4.21-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: lavoro_temporaneo
-- ------------------------------------------------------
-- Server version	10.4.21-MariaDB

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
-- Table structure for table `fattura`
--

DROP TABLE IF EXISTS `fattura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fattura` (
  `data` date NOT NULL,
  `datore_email` varchar(50) NOT NULL,
  `lavoratore_email` varchar(50) NOT NULL,
  `totale` int(11) DEFAULT NULL,
  KEY `datore_email` (`datore_email`),
  KEY `lavoratore_email` (`lavoratore_email`),
  CONSTRAINT `fattura_ibfk_1` FOREIGN KEY (`datore_email`) REFERENCES `utente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fattura_ibfk_2` FOREIGN KEY (`lavoratore_email`) REFERENCES `utente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fattura`
--

LOCK TABLES `fattura` WRITE;
/*!40000 ALTER TABLE `fattura` DISABLE KEYS */;
/*!40000 ALTER TABLE `fattura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lavoro`
--

DROP TABLE IF EXISTS `lavoro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lavoro` (
  `id` int(11) NOT NULL,
  `datore_email` varchar(50) NOT NULL,
  `lavoratore_email` varchar(50) DEFAULT NULL,
  `titolo` varchar(25) NOT NULL,
  `descrizione` varchar(100) NOT NULL,
  `tariffaOraria` int(11) NOT NULL,
  `occupato` tinyint(4) DEFAULT NULL,
  `scaduto` tinyint(4) DEFAULT NULL,
  `oreDiLavoro` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `datore_email` (`datore_email`),
  KEY `lavoratore_email` (`lavoratore_email`),
  CONSTRAINT `lavoro_ibfk_1` FOREIGN KEY (`datore_email`) REFERENCES `utente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lavoro_ibfk_2` FOREIGN KEY (`lavoratore_email`) REFERENCES `utente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lavoro`
--

LOCK TABLES `lavoro` WRITE;
/*!40000 ALTER TABLE `lavoro` DISABLE KEYS */;
INSERT INTO `lavoro` VALUES (1,'miro.joos@samtrevano.ch','gioele.cavallo@samtrevano.ch','Primo Lavoro','È il primo lavoro',10,1,0,1),(2,'miro.joos@samtrevano.ch','andrea.curti@samtrevano.ch','Secondo Lavoro','È il secondo lavoro',20,1,0,2),(3,'miro.joos@samtrevano.ch','samuele.abba@samtrevano.ch','Terzo Lavoro','È il terzo lavoro',30,0,0,3),(4,'gioele.zanetti@samtrevano.ch','gioele.cavallo@samtrevano.ch','Quarto Lavoro','È il quarto lavoro',20,1,0,2),(5,'gioele.zanetti@samtrevano.ch','andrea.curti@samtrevano.ch','Quinto Lavoro','È il quinto lavoro',10,1,0,1);
/*!40000 ALTER TABLE `lavoro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lavoro_proposta`
--

DROP TABLE IF EXISTS `lavoro_proposta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lavoro_proposta` (
  `data` date NOT NULL,
  `lavoro_id` int(11) NOT NULL,
  `lavoratore_email` varchar(50) NOT NULL,
  `titolo` varchar(25) NOT NULL,
  `descrizione` varchar(100) NOT NULL,
  `allegati` blob NOT NULL,
  PRIMARY KEY (`data`),
  KEY `lavoro_id` (`lavoro_id`),
  KEY `lavoratore_email` (`lavoratore_email`),
  CONSTRAINT `lavoro_proposta_ibfk_1` FOREIGN KEY (`lavoro_id`) REFERENCES `lavoro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lavoro_proposta_ibfk_2` FOREIGN KEY (`lavoratore_email`) REFERENCES `utente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lavoro_proposta`
--

LOCK TABLES `lavoro_proposta` WRITE;
/*!40000 ALTER TABLE `lavoro_proposta` DISABLE KEYS */;
/*!40000 ALTER TABLE `lavoro_proposta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utente`
--

DROP TABLE IF EXISTS `utente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utente` (
  `email` varchar(50) NOT NULL,
  `passwordHash` varchar(100) NOT NULL,
  `nomeRuolo` enum('amministratore','datore','lavoratore') NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utente`
--

LOCK TABLES `utente` WRITE;
/*!40000 ALTER TABLE `utente` DISABLE KEYS */;
INSERT INTO `utente` VALUES ('andrea.curti@samtrevano.ch','fdb87dfd199045af7165780b11640b83768a0d57','lavoratore'),('damian.campesi@samtrevano.ch','$2y$10$hvN0Cx.25PKjfN2qMa0x0OAlnhOPXG.HOD6IOHgXQXvRTD9D54l.y','datore'),('dennis.donofrio@samtrevano.ch','e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855','lavoratore'),('gioele.cavallo@samtrevano.ch','7ba6879f8ff82b7ad5d52600199a4cbe9af800ed','lavoratore'),('gioele.zanetti@samtrevano.ch','7ba6879f8ff82b7ad5d52600199a4cbe9af800ed','datore'),('luca.fumasoli@samtrevano.ch','e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855','datore'),('miro.joos@samtrevano.ch','fde400aa5aa198ae590a8b244df23fa5ef77aeb4','datore'),('samuele.abba@samtrevano.ch','4acebef29d98e2b58085d7481c92130b33d5df6b','amministratore');
/*!40000 ALTER TABLE `utente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-28 18:19:25
