CREATE DATABASE  IF NOT EXISTS `db_recordings` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_recordings`;
-- MySQL dump 10.13  Distrib 5.5.9, for Win32 (x86)
--
-- Host: localhost    Database: db_recordings
-- ------------------------------------------------------
-- Server version	5.0.51b-community-nt

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
-- Not dumping tablespaces as no INFORMATION_SCHEMA.FILES table on this server
--

--
-- Table structure for table `rec_user`
--

DROP TABLE IF EXISTS `rec_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rec_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) default NULL,
  `password` varchar(50) default NULL,
  `name` varchar(50) default NULL,
  `rdate` datetime default NULL,
  `allowsave` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rec_user`
--

LOCK TABLES `rec_user` WRITE;
/*!40000 ALTER TABLE `rec_user` DISABLE KEYS */;
INSERT INTO `rec_user` VALUES (60,'havenit','521a350016e8af4bc4644df1db2b6db7','Havenlink IT','2011-04-15 22:14:59','1'),(63,'Winston','9852f6575c282db621d991fd9ced3cc1','Winston','2011-04-15 22:14:59','1'),(64,'nicole','a90d12de8400fb8cba824fa4447a6e44','Arthur Layos','2011-04-15 22:14:59','1'),(67,'anna_morales','4c09e4b4723e8bb47e52bc6ed5238ab1','Anna Morales','2011-04-15 22:14:59','1'),(68,'angelica','5903d9e9a8884c8c04ad16559446735a','angelica','2011-04-15 22:14:59','1'),(69,'ltuppil','f25a2fc72690b780b2a14e140ef6a9e0','liza tuppil','2011-04-15 22:14:59','1'),(71,'joy','b76b5e20adeb789c06f4293726a7fd63','joy arenas','2011-04-15 22:14:59','0'),(73,'carmela.g','nsi','carmela.g','2011-04-15 22:14:59','0'),(74,'carmela','d1133275ee2118be63a577af759fc052','carmela garcia','2011-04-15 22:14:59','0'),(75,'vmartinez01','797cb93f8b1159e6dc68b2b7fddd6c55','Van Martinez','2011-04-15 22:14:59','0'),(76,'msienes','16d212a3b6564359ec335d7947daa40b','Maja Sienes','2011-04-15 22:14:59','1'),(77,'jsarao','c090aa7e8e921f49ed49d972a417bb03','Janice Sarao','2011-04-15 22:14:59','1'),(78,'jumer','8eba4590e7d4477e130cd06b2d2b4f18','Jumer Delos Santos','2011-04-15 22:14:59','0'),(79,'eric.t','d144be29e286ec30b7fbb56535cfe132','Eric Toledo','2011-04-15 22:14:59','0'),(80,'Janice','b31ce18c44e84a9d07fb55dbde23c0b0','Janice Balberan','2011-04-15 22:14:59','1'),(84,'greyzie777','44cbb0087d97d92d6582f78ccd0e8516','Grace Rivera','2011-04-15 22:14:59','1'),(85,'raffy','f4d0aab34299e5da3d77332d16f1b540','raffy delacruz','2011-04-15 22:14:59','1'),(86,'jimsensui','f2fde4d192eefe3cb37c2b03e7cf1018','Jimmy Manait','2011-04-15 22:14:59','1'),(87,'kyle','7bdff76536f12a7c5ffde207e72cfe3a','abner Lugtu','2011-04-15 22:14:59','1'),(88,'bec','8a9e80d8633e2be20af2141bbdc4ba83','bec Delicana','2011-04-15 22:14:59','0'),(89,'poging.bagsik13','a235362a2e906d7a44340c99556afd7d','Vincent C. Tuppil','2011-04-15 22:14:59','1'),(90,'patrick','230d180aa3ef207478ebba5023fa8099','Patrick Tulabot','2011-04-15 22:14:59','1'),(91,'qa_02','d85c3920bd6b1a5b113e15fc92fc2041','Piedad G. De Robles','2011-04-15 22:14:59','0'),(93,'libay','d939bfb2a6d9640bede8988e31cf165e','Liberty Garcia','2011-04-15 22:14:59','1'),(94,'janettebuce','18eeb0b19ba7412e93ae3520ad171110','Janette Buce','2011-04-15 22:14:59','1'),(95,'cedrick','83ed6af23ac47887f582ffee02d29ca3','Cedrick Macatangay','2011-04-15 22:16:44','1'),(96,'ambet','a52b70b549f81729e0b9639aab99a6c7','Ambet Guevarra','2011-04-15 22:20:39','1'),(97,'pubuser','dac285f954ce212a9505eb657ca09e59','Publication Temporary Username','2011-04-18 22:15:58','0'),(98,'esarao','689cc19e05c430441a6506ae16e1767a','ed','2011-04-18 22:27:27','1'),(99,'sheena.t','68053c4f28633721c381b7dfbeb604bb','sheena tandih','2011-05-17 00:16:28','1'),(101,'khrysteen.c','f7cd87016ae25d963b2276cb1ac34a85','Khrysteen Mae Cabangon','2011-06-01 23:26:59','1');
/*!40000 ALTER TABLE `rec_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-08-11 21:40:08
