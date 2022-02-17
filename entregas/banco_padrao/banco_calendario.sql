-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: calendario
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.33-MariaDB

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
-- Table structure for table `eventos`
--

DROP TABLE IF EXISTS `eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventos`
--

LOCK TABLES `eventos` WRITE;
/*!40000 ALTER TABLE `eventos` DISABLE KEYS */;
INSERT INTO `eventos` VALUES (0,'','0000-00-00'),(0,'','0000-00-00');
/*!40000 ALTER TABLE `eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(220) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `sala` varchar(45) DEFAULT NULL,
  `nome_usuario` varchar(50) DEFAULT NULL,
  `user_id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`,`user_id_user`),
  KEY `fk_events_user_idx` (`user_id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (68,'ReuniÃ£o Logistica','#A020F0','2020-11-26 12:00:00','2020-11-26 15:00:00','1','Marcos AntÃ´nio ',0),(67,'AvaliaÃ§Ã£o 360Â°','#228B22','2020-11-24 09:00:00','2020-11-24 13:00:00','2','Aline ',0),(64,'Entrevista ','#228B22','2020-11-20 09:00:00','2020-11-20 10:00:00','3','Aline',0),(66,'ReuniÃ£o','#0071c5','2020-11-27 10:00:00','2020-11-27 12:00:00','2','Pedro Paulo',0);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `nome` varchar(60) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'julia@gmail.com','123','Julia'),(7,'gustavo@dmantiqueira.com.br','diretoria','Gustavo'),(8,'aline.boroni@dmantiqueira.com.br','recursoshumanos','Aline'),(9,'yulli.monteiro@dmantiqueira.com.br','recursoshumanos','Yulli'),(10,'emilia.santos@dmantiqueira.com.br','recursoshumanos','Emilia'),(11,'naiara.sousa@dmantiqueira.com.br','recursoshumanos','Naiara'),(12,'matheus.gomes@dmantiqueira.com.br','tecnologiainformacao','Matheus'),(13,'julia.macedo@dmantiqueira.com.br','tecnologiainformacao','Julia'),(14,'fabricio@dmantiqueira.com.br','financeiro','Fabricio'),(15,'vania.bisi@dmantiqueira.com.br','financeiro','Vania'),(16,'danilo.rodrigues@dmantiqueira.com.br','compras','Danilo'),(17,'marcos.torrico@dmantiqueira.com.br','compras','Marcos'),(18,'nathalia.mancano@dmantiqueira.com.br','compras','Nathalia'),(19,'daniela.faci@dmantiqueira.com.br','compras','Daniela'),(20,'bruna.masteguin@dmantiqueira.com.br','marketing','Bruna'),(21,'vanessa.brunelli@dmantiqueira.com.br','marketing','Vanessa'),(22,'richard.santos@dmantiqueira.com.br','marketing','Richard'),(23,'valdeilson.monteiro@dmantiqueira.com.br','comercial','Valdeilson'),(24,'vanessa.fernandes@dmantiqueira.com.br','comercial','Vanessa'),(25,'mariana.morais@dmantiqueira.com.br','expedicao','Mariana'),(26,'expedicao@dmantiqueira.com.br','expedicao','Andre'),(27,'elizandra.pires@dmantiqueira.com.br','logistica','Elizandra'),(28,'valquiria.prado@dmantiqueira.com.br','fiscal','Valquiria');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-25 17:31:32
