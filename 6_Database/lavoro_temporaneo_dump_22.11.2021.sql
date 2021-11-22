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
INSERT INTO `lavoro` VALUES (1,'miro.joos@samtrevano.ch','gioele.cavallo@samtrevano.ch','Primo Lavoro','È il primo lavoro',10,1,0,1),(2,'miro.joos@samtrevano.ch','gioele.cavallo@samtrevano.ch','Secondo Lavoro','È il secondo lavoro',20,1,0,2),(3,'miro.joos@samtrevano.ch','samuele.abba@samtrevano.ch','Terzo Lavoro','È il terzo lavoro',30,0,0,3),(4,'gioele.zanetti@samtrevano.ch','gioele.cavallo@samtrevano.ch','Quarto Lavoro','È il quarto lavoro',20,1,0,2),(5,'gioele.zanetti@samtrevano.ch','andrea.curti@samtrevano.ch','Quinto Lavoro','È il quinto lavoro',10,1,0,1);
/*!40000 ALTER TABLE `lavoro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lavoro_proposta`
--

DROP TABLE IF EXISTS `lavoro_proposta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lavoro_proposta` (
  `data` varchar(20) NOT NULL,
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
INSERT INTO `lavoro_proposta` VALUES ('2021-11-22 19:31:10',3,'andrea.curti@samtrevano.ch','Titolo di default','Descrizione di default',' ');
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
INSERT INTO `utente` VALUES ('andrea.curti@samtrevano.ch','033b54379f35a3a7864555e840dc4c54a59cdee842cf134f3a9e008d86265657','lavoratore'),('damian.campesi@samtrevano.ch','b605bb1fe6ac82bf21633d396c93fed480c2647eb1b6a86ce2fc45ae99327fc1','datore'),('dennis.donofrio@samtrevano.ch','033b54379f35a3a7864555e840dc4c54a59cdee842cf134f3a9e008d86265657','lavoratore'),('gioele.cavallo@samtrevano.ch','a5fd322d7b96dd875ed907d12c0883ace02938314dd6cd9c8eabbd0027794b8c','lavoratore'),('gioele.zanetti@samtrevano.ch','a5fd322d7b96dd875ed907d12c0883ace02938314dd6cd9c8eabbd0027794b8c','datore'),('luca.fumasoli@samtrevano.ch','65dba5ba3abd51f93865c31508f29129f1f9946acdf8a4293f23e55377bfde97','datore'),('miro.joos@samtrevano.ch','4d61fefcf6ea734eaa0de4e7c150f1d075ce9b6b6da2a3f189a51be8c240bc11','datore'),('samuele.abba@samtrevano.ch','6239b479b97a15a5a494351afcc22b5b85627f37250649713c0d6f4d1d10100a','amministratore');
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

-- Dump completed on 2021-11-22 19:34:11
