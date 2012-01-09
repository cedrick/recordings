CREATE DATABASE  IF NOT EXISTS `i3_ic` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `i3_ic`;
-- MySQL dump 10.13  Distrib 5.5.9, for Win32 (x86)
--
-- Host: localhost    Database: i3_ic
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
-- Table structure for table `calldetail`
--

DROP TABLE IF EXISTS `calldetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calldetail` (
  `CallId` char(18) NOT NULL,
  `CallType` varchar(20) NOT NULL,
  `CallDirection` varchar(20) NOT NULL,
  `LineId` varchar(50) NOT NULL,
  `StationId` varchar(50) NOT NULL,
  `LocalUserId` varchar(50) NOT NULL,
  `LocalNumber` varchar(50) NOT NULL,
  `LocalName` varchar(50) NOT NULL,
  `RemoteNumber` varchar(50) NOT NULL,
  `RemoteNumberCountry` smallint(6) NOT NULL,
  `RemoteNumberLoComp1` varchar(10) NOT NULL,
  `RemoteNumberLoComp2` varchar(10) NOT NULL,
  `RemoteNumberFmt` varchar(50) NOT NULL,
  `RemoteNumberCallId` varchar(50) NOT NULL,
  `RemoteName` varchar(50) NOT NULL,
  `InitiatedDate` datetime NOT NULL,
  `InitiatedDateTimeGmt` datetime NOT NULL,
  `ConnectedDate` datetime NOT NULL,
  `ConnectedDateTimeGmt` datetime NOT NULL,
  `TerminatedDate` datetime NOT NULL,
  `TerminatedDateTimeGmt` datetime NOT NULL,
  `CallDurationSeconds` int(11) NOT NULL,
  `HoldDurationSeconds` int(11) NOT NULL,
  `LineDurationSeconds` int(11) NOT NULL,
  `DNIS` varchar(50) NOT NULL,
  `CallEventLog` longtext NOT NULL,
  `CustomNum1` int(11) NOT NULL,
  `CustomNum2` int(11) NOT NULL,
  `CustomNum3` int(11) NOT NULL,
  `CustomString1` varchar(50) NOT NULL,
  `CustomString2` varchar(50) NOT NULL,
  `CustomString3` varchar(50) NOT NULL,
  `CustomDateTime` datetime NOT NULL,
  `CustomDateTimeGmt` datetime NOT NULL,
  `InteractionType` int(11) NOT NULL,
  `AccountCode` varchar(50) default NULL,
  `PurposeCode` int(11) default NULL,
  `DispositionCode` int(11) default NULL,
  `CallNote` longtext,
  `SiteId` smallint(6) NOT NULL,
  `SubSiteId` smallint(6) NOT NULL,
  `I3TimeStampGMT` datetime NOT NULL,
  `WrapUpCode` varchar(50) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calldetail`
--

LOCK TABLES `calldetail` WRITE;
/*!40000 ALTER TABLE `calldetail` DISABLE KEYS */;
/*!40000 ALTER TABLE `calldetail` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-08-11 21:40:09
