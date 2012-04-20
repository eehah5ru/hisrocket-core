-- MySQL dump 10.13  Distrib 5.5.10, for osx10.6 (i386)
--
-- Host: localhost    Database: hisrocket_dev
-- ------------------------------------------------------
-- Server version	5.5.10

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
-- Table structure for table `zp_admin_to_object`
--

DROP TABLE IF EXISTS `zp_admin_to_object`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zp_admin_to_object` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `adminid` int(11) unsigned NOT NULL,
  `objectid` int(11) unsigned NOT NULL,
  `type` varchar(32) COLLATE utf8_unicode_ci DEFAULT 'album',
  `edit` int(11) DEFAULT '32767',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zp_admin_to_object`
--

LOCK TABLES `zp_admin_to_object` WRITE;
/*!40000 ALTER TABLE `zp_admin_to_object` DISABLE KEYS */;
/*!40000 ALTER TABLE `zp_admin_to_object` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zp_administrators`
--

DROP TABLE IF EXISTS `zp_administrators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zp_administrators` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `pass` text COLLATE utf8_unicode_ci,
  `name` text COLLATE utf8_unicode_ci,
  `email` text COLLATE utf8_unicode_ci,
  `rights` int(11) DEFAULT NULL,
  `custom_data` text COLLATE utf8_unicode_ci,
  `valid` int(1) DEFAULT '1',
  `group` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `loggedin` datetime DEFAULT NULL,
  `quota` int(11) DEFAULT NULL,
  `language` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prime_album` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_credentials` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`,`valid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zp_administrators`
--

LOCK TABLES `zp_administrators` WRITE;
/*!40000 ALTER TABLE `zp_administrators` DISABLE KEYS */;
INSERT INTO `zp_administrators` VALUES (1,'administrators',NULL,'group',NULL,1961343989,'Users with full privileges',0,NULL,'2011-09-14 15:30:21',NULL,NULL,NULL,NULL,NULL),(2,'viewers',NULL,'group',NULL,2945,'Users allowed only to view zenphoto objects',0,NULL,'2011-09-14 15:30:21',NULL,NULL,NULL,NULL,NULL),(3,'bozos',NULL,'group',NULL,0,'Banned users',0,NULL,'2011-09-14 15:30:21',NULL,NULL,NULL,NULL,NULL),(4,'album managers',NULL,'template',NULL,67386245,'Managers of one or more albums',0,NULL,'2011-09-14 15:30:21',NULL,NULL,NULL,NULL,NULL),(5,'default',NULL,'template',NULL,945,'Default user settings',0,NULL,'2011-09-14 15:30:21',NULL,NULL,NULL,NULL,NULL),(6,'newuser',NULL,'template',NULL,1,'Newly registered and verified users',0,NULL,'2011-09-14 15:30:21',NULL,NULL,NULL,NULL,NULL),(7,'admin','3c79f97e7464d360006fab2c8d9a438f87282ab4','Nicolay Spesivtsev','nicola.spesivcev@gmail.com',1961343989,NULL,1,NULL,'2011-09-14 15:31:59','2012-04-18 14:57:23',NULL,'en_US',NULL,NULL);
/*!40000 ALTER TABLE `zp_administrators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zp_albums`
--

DROP TABLE IF EXISTS `zp_albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zp_albums` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` int(11) unsigned DEFAULT NULL,
  `folder` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` text COLLATE utf8_unicode_ci,
  `desc` text COLLATE utf8_unicode_ci,
  `date` datetime DEFAULT NULL,
  `updateddate` datetime DEFAULT NULL,
  `location` text COLLATE utf8_unicode_ci,
  `show` int(1) unsigned NOT NULL DEFAULT '1',
  `closecomments` int(1) unsigned NOT NULL DEFAULT '0',
  `commentson` int(1) unsigned NOT NULL DEFAULT '1',
  `thumb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mtime` int(32) DEFAULT NULL,
  `sort_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subalbum_sort_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` int(11) unsigned DEFAULT NULL,
  `image_sortdirection` int(1) unsigned DEFAULT '0',
  `album_sortdirection` int(1) unsigned DEFAULT '0',
  `hitcounter` int(11) unsigned DEFAULT '0',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password_hint` text COLLATE utf8_unicode_ci,
  `total_value` int(11) DEFAULT '0',
  `total_votes` int(11) DEFAULT '0',
  `used_ips` longtext COLLATE utf8_unicode_ci,
  `custom_data` text COLLATE utf8_unicode_ci,
  `dynamic` int(1) DEFAULT '0',
  `search_params` text COLLATE utf8_unicode_ci,
  `album_theme` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `rating_status` int(1) DEFAULT '3',
  `watermark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `watermark_thumb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `owner` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codeblock` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `folder` (`folder`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zp_albums`
--

LOCK TABLES `zp_albums` WRITE;
/*!40000 ALTER TABLE `zp_albums` DISABLE KEYS */;
INSERT INTO `zp_albums` VALUES (23,NULL,'proekt-nomer-odin','a:2:{s:5:\"en_US\";s:17:\"The first project\";s:5:\"ru_RU\";s:32:\"Проект номер один\";}','','2012-04-20 10:46:42',NULL,'',1,0,1,'',1334904402,'','',NULL,0,0,0,'','',0,0,NULL,'',0,NULL,NULL,NULL,NULL,3,'','','admin','a:3:{i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:0:\"\";}'),(24,NULL,'work','a:2:{s:5:\"en_US\";s:4:\"Work\";s:5:\"ru_RU\";s:4:\"Work\";}','','2012-04-20 13:10:51',NULL,'',1,0,1,'',1334913051,'','',NULL,0,0,0,'','',0,0,NULL,'',0,NULL,NULL,NULL,NULL,3,'','','admin','a:3:{i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:0:\"\";}'),(25,24,'work/space','a:2:{s:5:\"en_US\";s:5:\"Space\";s:5:\"ru_RU\";s:12:\"Космос\";}','','2012-04-20 13:11:39',NULL,'',1,0,1,'',1334913099,'','',NULL,0,0,0,'','',0,0,NULL,'',0,NULL,NULL,NULL,NULL,3,'','','admin','a:3:{i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:0:\"\";}');
/*!40000 ALTER TABLE `zp_albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zp_captcha`
--

DROP TABLE IF EXISTS `zp_captcha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zp_captcha` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ptime` int(32) unsigned NOT NULL,
  `hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zp_captcha`
--

LOCK TABLES `zp_captcha` WRITE;
/*!40000 ALTER TABLE `zp_captcha` DISABLE KEYS */;
INSERT INTO `zp_captcha` VALUES (14,1334868617,'23ec7f4a03aa60eb7def6041c11b0cb8d99d29c3');
/*!40000 ALTER TABLE `zp_captcha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zp_comments`
--

DROP TABLE IF EXISTS `zp_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zp_comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ownerid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `inmoderation` int(1) unsigned NOT NULL DEFAULT '0',
  `type` varchar(52) COLLATE utf8_unicode_ci DEFAULT 'images',
  `IP` text COLLATE utf8_unicode_ci,
  `private` int(1) DEFAULT '0',
  `anon` int(1) DEFAULT '0',
  `custom_data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `ownerid` (`ownerid`),
  KEY `ownerid_2` (`ownerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zp_comments`
--

LOCK TABLES `zp_comments` WRITE;
/*!40000 ALTER TABLE `zp_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `zp_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zp_images`
--

DROP TABLE IF EXISTS `zp_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zp_images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `albumid` int(11) unsigned DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` text COLLATE utf8_unicode_ci,
  `desc` text COLLATE utf8_unicode_ci,
  `location` text COLLATE utf8_unicode_ci,
  `city` tinytext COLLATE utf8_unicode_ci,
  `state` tinytext COLLATE utf8_unicode_ci,
  `country` tinytext COLLATE utf8_unicode_ci,
  `credit` text COLLATE utf8_unicode_ci,
  `copyright` text COLLATE utf8_unicode_ci,
  `commentson` int(1) unsigned NOT NULL DEFAULT '1',
  `show` int(1) NOT NULL DEFAULT '1',
  `date` datetime DEFAULT NULL,
  `sort_order` int(11) unsigned DEFAULT NULL,
  `height` int(10) unsigned DEFAULT NULL,
  `width` int(10) unsigned DEFAULT NULL,
  `thumbX` int(10) unsigned DEFAULT NULL,
  `thumbY` int(10) unsigned DEFAULT NULL,
  `thumbW` int(10) unsigned DEFAULT NULL,
  `thumbH` int(10) unsigned DEFAULT NULL,
  `mtime` int(32) DEFAULT NULL,
  `hitcounter` int(11) unsigned DEFAULT '0',
  `total_value` int(11) unsigned DEFAULT '0',
  `total_votes` int(11) unsigned DEFAULT '0',
  `used_ips` longtext COLLATE utf8_unicode_ci,
  `custom_data` text COLLATE utf8_unicode_ci,
  `rating` float DEFAULT NULL,
  `rating_status` int(1) DEFAULT '3',
  `hasMetadata` int(1) DEFAULT '0',
  `watermark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `watermark_use` int(1) DEFAULT '7',
  `owner` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `filesize` int(11) DEFAULT NULL,
  `codeblock` text COLLATE utf8_unicode_ci,
  `user` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_hint` text COLLATE utf8_unicode_ci,
  `EXIFMake` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFModel` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFDescription` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IPTCObjectName` mediumtext COLLATE utf8_unicode_ci,
  `IPTCImageHeadline` mediumtext COLLATE utf8_unicode_ci,
  `IPTCImageCaption` mediumtext COLLATE utf8_unicode_ci,
  `IPTCImageCaptionWriter` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFDateTime` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFDateTimeOriginal` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFDateTimeDigitized` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IPTCDateCreated` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IPTCTimeCreated` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IPTCDigitizeDate` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IPTCDigitizeTime` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFArtist` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IPTCImageCredit` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IPTCByLine` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IPTCByLineTitle` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IPTCSource` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IPTCContact` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFCopyright` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IPTCCopyright` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFExposureTime` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFFNumber` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFISOSpeedRatings` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFExposureBiasValue` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFMeteringMode` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFFlash` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFImageWidth` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFImageHeight` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFOrientation` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFContrast` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFSharpness` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFSaturation` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFWhiteBalance` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFSubjectDistance` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFFocalLength` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFLensType` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFLensInfo` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFFocalLengthIn35mmFilm` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IPTCCity` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IPTCSubLocation` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IPTCState` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IPTCLocationCode` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IPTCLocationName` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFGPSLatitude` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFGPSLatitudeRef` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFGPSLongitude` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFGPSLongitudeRef` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFGPSAltitude` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EXIFGPSAltitudeRef` varchar(52) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IPTCOriginatingProgram` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IPTCProgramVersion` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `filename` (`filename`,`albumid`)
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zp_images`
--

LOCK TABLES `zp_images` WRITE;
/*!40000 ALTER TABLE `zp_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `zp_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zp_menu`
--

DROP TABLE IF EXISTS `zp_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zp_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` int(11) unsigned DEFAULT NULL,
  `title` text COLLATE utf8_unicode_ci,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `include_li` int(1) unsigned DEFAULT '1',
  `type` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sort_order` varchar(48) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `show` int(1) unsigned NOT NULL DEFAULT '1',
  `menuset` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `span_class` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `span_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zp_menu`
--

LOCK TABLES `zp_menu` WRITE;
/*!40000 ALTER TABLE `zp_menu` DISABLE KEYS */;
INSERT INTO `zp_menu` VALUES (21,NULL,'a:2:{s:5:\"en_US\";s:4:\"Info\";s:5:\"ru_RU\";s:8:\"Инфо\";}','',1,'menulabel','002',1,'default','',''),(26,NULL,'proekt-nomer-odin','proekt-nomer-odin',1,'album','000',1,'default','',''),(27,NULL,'','cv_2012-04-20-00-48-59',1,'zenpagepage','001',1,'default','',''),(28,NULL,'work','work',1,'album','3',1,'default','','');
/*!40000 ALTER TABLE `zp_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zp_news`
--

DROP TABLE IF EXISTS `zp_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zp_news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci,
  `extracontent` text COLLATE utf8_unicode_ci,
  `show` int(1) unsigned NOT NULL DEFAULT '1',
  `date` datetime DEFAULT NULL,
  `titlelink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `commentson` int(1) unsigned DEFAULT '0',
  `codeblock` text COLLATE utf8_unicode_ci,
  `author` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lastchange` datetime DEFAULT NULL,
  `lastchangeauthor` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `hitcounter` int(11) unsigned DEFAULT '0',
  `permalink` int(1) unsigned NOT NULL DEFAULT '0',
  `locked` int(1) unsigned NOT NULL DEFAULT '0',
  `expiredate` datetime DEFAULT NULL,
  `total_value` int(11) unsigned DEFAULT '0',
  `total_votes` int(11) unsigned DEFAULT '0',
  `used_ips` longtext COLLATE utf8_unicode_ci,
  `rating` float DEFAULT NULL,
  `rating_status` int(1) DEFAULT '3',
  `sticky` int(1) DEFAULT '0',
  `custom_data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `titlelink` (`titlelink`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zp_news`
--

LOCK TABLES `zp_news` WRITE;
/*!40000 ALTER TABLE `zp_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `zp_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zp_news2cat`
--

DROP TABLE IF EXISTS `zp_news2cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zp_news2cat` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) unsigned NOT NULL,
  `news_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zp_news2cat`
--

LOCK TABLES `zp_news2cat` WRITE;
/*!40000 ALTER TABLE `zp_news2cat` DISABLE KEYS */;
/*!40000 ALTER TABLE `zp_news2cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zp_news_categories`
--

DROP TABLE IF EXISTS `zp_news_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zp_news_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_unicode_ci,
  `titlelink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permalink` int(1) unsigned NOT NULL DEFAULT '0',
  `hitcounter` int(11) unsigned DEFAULT '0',
  `user` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_hint` text COLLATE utf8_unicode_ci,
  `parentid` int(11) DEFAULT NULL,
  `sort_order` varchar(48) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8_unicode_ci,
  `custom_data` text COLLATE utf8_unicode_ci,
  `show` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `titlelink` (`titlelink`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zp_news_categories`
--

LOCK TABLES `zp_news_categories` WRITE;
/*!40000 ALTER TABLE `zp_news_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `zp_news_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zp_obj_to_tag`
--

DROP TABLE IF EXISTS `zp_obj_to_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zp_obj_to_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tagid` int(11) unsigned NOT NULL,
  `type` tinytext COLLATE utf8_unicode_ci,
  `objectid` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tagid` (`tagid`),
  KEY `objectid` (`objectid`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zp_obj_to_tag`
--

LOCK TABLES `zp_obj_to_tag` WRITE;
/*!40000 ALTER TABLE `zp_obj_to_tag` DISABLE KEYS */;
INSERT INTO `zp_obj_to_tag` VALUES (53,10,'images',115),(54,11,'images',115),(55,10,'images',117),(56,11,'images',117),(57,10,'images',118),(58,11,'images',118),(59,12,'images',119),(60,11,'images',119),(61,13,'images',119),(62,12,'images',120),(63,11,'images',120),(64,13,'images',120),(65,12,'images',121),(66,11,'images',121),(67,13,'images',121),(68,12,'images',122),(69,11,'images',122),(70,13,'images',122),(71,10,'images',123),(72,12,'images',123),(73,11,'images',123),(74,13,'images',123),(75,10,'images',124),(76,12,'images',124),(77,11,'images',124),(78,13,'images',124),(79,10,'images',125),(80,12,'images',125),(81,11,'images',125),(82,13,'images',125),(83,10,'images',128),(84,14,'images',128),(85,11,'images',128),(86,10,'images',129),(87,14,'images',129),(88,11,'images',129),(89,10,'images',130),(90,14,'images',130),(91,11,'images',130),(92,10,'images',131),(93,14,'images',131),(94,11,'images',131),(95,10,'images',132),(96,14,'images',132),(97,11,'images',132),(98,10,'images',133),(99,14,'images',133),(100,11,'images',133),(101,10,'images',134),(102,11,'images',134),(103,10,'images',135),(104,11,'images',135);
/*!40000 ALTER TABLE `zp_obj_to_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zp_options`
--

DROP TABLE IF EXISTS `zp_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zp_options` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ownerid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `theme` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creator` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_option` (`name`,`ownerid`,`theme`)
) ENGINE=InnoDB AUTO_INCREMENT=536 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zp_options`
--

LOCK TABLES `zp_options` WRITE;
/*!40000 ALTER TABLE `zp_options` DISABLE KEYS */;
INSERT INTO `zp_options` VALUES (1,0,'zenphoto_release','7990',NULL,NULL),(2,0,'zenphoto_install','{33f1f444-c72d-a3e2-2038-4154fc9ab356}',NULL,NULL),(4,0,'libauth_version','3',NULL,NULL),(5,0,'time_offset','0',NULL,'zp-core/setup/setup-option-defaults.php'),(6,0,'mod_rewrite_image_suffix','.php',NULL,'zp-core/setup/setup-option-defaults.php'),(7,0,'server_protocol','http',NULL,'zp-core/setup/setup-option-defaults.php'),(8,0,'charset','UTF-8',NULL,'zp-core/setup/setup-option-defaults.php'),(9,0,'image_quality','85',NULL,'zp-core/setup/setup-option-defaults.php'),(10,0,'thumb_quality','75',NULL,'zp-core/setup/setup-option-defaults.php'),(11,0,'image_size','595',NULL,'zp-core/setup/setup-option-defaults.php'),(12,0,'image_use_side','longest',NULL,'zp-core/setup/setup-option-defaults.php'),(13,0,'image_allow_upscale','0',NULL,'zp-core/setup/setup-option-defaults.php'),(14,0,'thumb_size','100',NULL,'zp-core/setup/setup-option-defaults.php'),(15,0,'thumb_crop','1',NULL,'zp-core/setup/setup-option-defaults.php'),(16,0,'thumb_crop_width','85',NULL,'zp-core/setup/setup-option-defaults.php'),(17,0,'thumb_crop_height','85',NULL,'zp-core/setup/setup-option-defaults.php'),(18,0,'thumb_sharpen','0',NULL,'zp-core/setup/setup-option-defaults.php'),(19,0,'image_sharpen','0',NULL,'zp-core/setup/setup-option-defaults.php'),(20,0,'albums_per_page','5',NULL,'zp-core/setup/setup-option-defaults.php'),(21,0,'images_per_page','15',NULL,'zp-core/setup/setup-option-defaults.php'),(22,0,'search_password','',NULL,'zp-core/setup/setup-option-defaults.php'),(23,0,'search_hint',NULL,NULL,'zp-core/setup/setup-option-defaults.php'),(24,0,'album_session','0',NULL,'zp-core/setup/setup-option-defaults.php'),(25,0,'watermark_h_offset','90',NULL,'zp-core/setup/setup-option-defaults.php'),(26,0,'watermark_w_offset','90',NULL,'zp-core/setup/setup-option-defaults.php'),(27,0,'watermark_scale','5',NULL,'zp-core/setup/setup-option-defaults.php'),(28,0,'watermark_allow_upscale','1',NULL,'zp-core/setup/setup-option-defaults.php'),(29,0,'perform_video_watermark','0',NULL,'zp-core/setup/setup-option-defaults.php'),(30,0,'spam_filter','none',NULL,'zp-core/setup/setup-option-defaults.php'),(31,0,'email_new_comments','1',NULL,'zp-core/setup/setup-option-defaults.php'),(32,0,'image_sorttype','filename',NULL,'zp-core/setup/setup-option-defaults.php'),(33,0,'image_sortdirection','0',NULL,'zp-core/setup/setup-option-defaults.php'),(34,0,'hotlink_protection','1',NULL,'zp-core/setup/setup-option-defaults.php'),(35,0,'feed_items','10',NULL,'zp-core/setup/setup-option-defaults.php'),(36,0,'feed_imagesize','240',NULL,'zp-core/setup/setup-option-defaults.php'),(37,0,'feed_sortorder','latest',NULL,'zp-core/setup/setup-option-defaults.php'),(38,0,'feed_items_albums','10',NULL,'zp-core/setup/setup-option-defaults.php'),(39,0,'feed_imagesize_albums','240',NULL,'zp-core/setup/setup-option-defaults.php'),(40,0,'feed_sortorder_albums','latest',NULL,'zp-core/setup/setup-option-defaults.php'),(41,0,'feed_enclosure','0',NULL,'zp-core/setup/setup-option-defaults.php'),(42,0,'feed_mediarss','0',NULL,'zp-core/setup/setup-option-defaults.php'),(43,0,'feed_cache','1',NULL,'zp-core/setup/setup-option-defaults.php'),(44,0,'feed_cache_expire','86400',NULL,'zp-core/setup/setup-option-defaults.php'),(45,0,'feed_hitcounter','1',NULL,'zp-core/setup/setup-option-defaults.php'),(46,0,'search_fields','title,desc,tags,file,location,city,state,country,content,author',NULL,'zp-core/setup/setup-option-defaults.php'),(47,0,'allowed_tags_default','a => (href =>() title =>() target=>() class=>() id=>())\nabbr =>(class=>() id=>() title =>())\nacronym =>(class=>() id=>() title =>())\nb => (class=>() id=>() )\nblockquote =>(class=>() id=>() cite =>())\nbr => (class=>() id=>() )\ncode => (class=>() id=>() )\nem => (class=>() id=>() )\ni => (class=>() id=>() ) \nstrike => (class=>() id=>() )\nstrong => (class=>() id=>() )\nul => (class=>() id=>())\nol => (class=>() id=>())\nli => (class=>() id=>())\np => (class=>() id=>() style=>())\nh1=>(class=>() id=>() style=>())\nh2=>(class=>() id=>() style=>())\nh3=>(class=>() id=>() style=>())\nh4=>(class=>() id=>() style=>())\nh5=>(class=>() id=>() style=>())\nh6=>(class=>() id=>() style=>())\npre=>(class=>() id=>() style=>())\naddress=>(class=>() id=>() style=>())\nspan=>(class=>() id=>() style=>())\ndiv=>(class=>() id=>() style=>())\nimg=>(class=>() id=>() style=>() src=>() title=>() alt=>() width=>() height=>())\n',NULL,NULL),(48,0,'allowed_tags','a => (href =>() title =>() target=>() class=>() id=>())',NULL,NULL),(49,0,'style_tags','abbr => (title => ())\nacronym => (title => ())\nb => ()\nem => ()\ni => () \nstrike => ()\nstrong => ()\n',NULL,'zp-core/setup/setup-option-defaults.php'),(50,0,'comment_name_required','1',NULL,'zp-core/setup/setup-option-defaults.php'),(51,0,'comment_email_required','1',NULL,'zp-core/setup/setup-option-defaults.php'),(52,0,'comment_web_required','show',NULL,'zp-core/setup/setup-option-defaults.php'),(53,0,'Use_Captcha','',NULL,'zp-core/setup/setup-option-defaults.php'),(54,0,'full_image_quality','75',NULL,'zp-core/setup/setup-option-defaults.php'),(55,0,'protect_full_image','Protected view',NULL,'zp-core/setup/setup-option-defaults.php'),(56,0,'locale','en_US',NULL,'zp-core/setup/setup-option-defaults.php'),(57,0,'date_format','%x',NULL,'zp-core/setup/setup-option-defaults.php'),(58,0,'zp_plugin_class-video','4105',NULL,'zp-core/setup/setup-option-defaults.php'),(59,0,'use_lock_image','1',NULL,'zp-core/setup/setup-option-defaults.php'),(60,0,'search_user','',NULL,'zp-core/setup/setup-option-defaults.php'),(61,0,'multi_lingual','1',NULL,'zp-core/setup/setup-option-defaults.php'),(62,0,'tagsort','0',NULL,'zp-core/setup/setup-option-defaults.php'),(63,0,'albumimagesort','id',NULL,'zp-core/setup/setup-option-defaults.php'),(64,0,'albumimagedirection','DESC',NULL,'zp-core/setup/setup-option-defaults.php'),(65,0,'cache_full_image','0',NULL,'zp-core/setup/setup-option-defaults.php'),(66,0,'custom_index_page','',NULL,'zp-core/setup/setup-option-defaults.php'),(67,0,'picture_of_the_day','a:3:{s:3:\"day\";N;s:6:\"folder\";N;s:8:\"filename\";N;}',NULL,'zp-core/setup/setup-option-defaults.php'),(68,0,'exact_tag_match','0',NULL,'zp-core/setup/setup-option-defaults.php'),(69,0,'EXIFMake','1',NULL,'zp-core/setup/setup-option-defaults.php'),(70,0,'EXIFModel','1',NULL,'zp-core/setup/setup-option-defaults.php'),(71,0,'EXIFExposureTime','1',NULL,'zp-core/setup/setup-option-defaults.php'),(72,0,'EXIFFNumber','1',NULL,'zp-core/setup/setup-option-defaults.php'),(73,0,'EXIFFocalLength','1',NULL,'zp-core/setup/setup-option-defaults.php'),(74,0,'EXIFISOSpeedRatings','1',NULL,'zp-core/setup/setup-option-defaults.php'),(75,0,'EXIFDateTimeOriginal','1',NULL,'zp-core/setup/setup-option-defaults.php'),(76,0,'EXIFExposureBiasValue','1',NULL,'zp-core/setup/setup-option-defaults.php'),(77,0,'EXIFMeteringMode','1',NULL,'zp-core/setup/setup-option-defaults.php'),(78,0,'EXIFFlash','1',NULL,'zp-core/setup/setup-option-defaults.php'),(79,0,'EXIFDescription','0',NULL,'zp-core/setup/setup-option-defaults.php'),(80,0,'IPTCObjectName','0',NULL,'zp-core/setup/setup-option-defaults.php'),(81,0,'IPTCImageHeadline','0',NULL,'zp-core/setup/setup-option-defaults.php'),(82,0,'IPTCImageCaption','0',NULL,'zp-core/setup/setup-option-defaults.php'),(83,0,'IPTCImageCaptionWriter','0',NULL,'zp-core/setup/setup-option-defaults.php'),(84,0,'EXIFDateTime','0',NULL,'zp-core/setup/setup-option-defaults.php'),(85,0,'EXIFDateTimeDigitized','0',NULL,'zp-core/setup/setup-option-defaults.php'),(86,0,'IPTCDateCreated','0',NULL,'zp-core/setup/setup-option-defaults.php'),(87,0,'IPTCTimeCreated','0',NULL,'zp-core/setup/setup-option-defaults.php'),(88,0,'IPTCDigitizeDate','0',NULL,'zp-core/setup/setup-option-defaults.php'),(89,0,'IPTCDigitizeTime','0',NULL,'zp-core/setup/setup-option-defaults.php'),(90,0,'EXIFArtist','0',NULL,'zp-core/setup/setup-option-defaults.php'),(91,0,'IPTCImageCredit','0',NULL,'zp-core/setup/setup-option-defaults.php'),(92,0,'IPTCByLine','0',NULL,'zp-core/setup/setup-option-defaults.php'),(93,0,'IPTCByLineTitle','0',NULL,'zp-core/setup/setup-option-defaults.php'),(94,0,'IPTCSource','0',NULL,'zp-core/setup/setup-option-defaults.php'),(95,0,'IPTCContact','0',NULL,'zp-core/setup/setup-option-defaults.php'),(96,0,'EXIFCopyright','0',NULL,'zp-core/setup/setup-option-defaults.php'),(97,0,'IPTCCopyright','0',NULL,'zp-core/setup/setup-option-defaults.php'),(98,0,'EXIFImageWidth','0',NULL,'zp-core/setup/setup-option-defaults.php'),(99,0,'EXIFImageHeight','0',NULL,'zp-core/setup/setup-option-defaults.php'),(100,0,'EXIFOrientation','0',NULL,'zp-core/setup/setup-option-defaults.php'),(101,0,'EXIFContrast','0',NULL,'zp-core/setup/setup-option-defaults.php'),(102,0,'EXIFSharpness','0',NULL,'zp-core/setup/setup-option-defaults.php'),(103,0,'EXIFSaturation','0',NULL,'zp-core/setup/setup-option-defaults.php'),(104,0,'EXIFWhiteBalance','0',NULL,'zp-core/setup/setup-option-defaults.php'),(105,0,'EXIFSubjectDistance','0',NULL,'zp-core/setup/setup-option-defaults.php'),(106,0,'EXIFLensType','0',NULL,'zp-core/setup/setup-option-defaults.php'),(107,0,'EXIFLensInfo','0',NULL,'zp-core/setup/setup-option-defaults.php'),(108,0,'EXIFFocalLengthIn35mmFilm','0',NULL,'zp-core/setup/setup-option-defaults.php'),(109,0,'IPTCCity','0',NULL,'zp-core/setup/setup-option-defaults.php'),(110,0,'IPTCSubLocation','0',NULL,'zp-core/setup/setup-option-defaults.php'),(111,0,'IPTCState','0',NULL,'zp-core/setup/setup-option-defaults.php'),(112,0,'IPTCLocationCode','0',NULL,'zp-core/setup/setup-option-defaults.php'),(113,0,'IPTCLocationName','0',NULL,'zp-core/setup/setup-option-defaults.php'),(114,0,'EXIFGPSLatitude','0',NULL,'zp-core/setup/setup-option-defaults.php'),(115,0,'EXIFGPSLatitudeRef','0',NULL,'zp-core/setup/setup-option-defaults.php'),(116,0,'EXIFGPSLongitude','0',NULL,'zp-core/setup/setup-option-defaults.php'),(117,0,'EXIFGPSLongitudeRef','0',NULL,'zp-core/setup/setup-option-defaults.php'),(118,0,'EXIFGPSAltitude','0',NULL,'zp-core/setup/setup-option-defaults.php'),(119,0,'EXIFGPSAltitudeRef','0',NULL,'zp-core/setup/setup-option-defaults.php'),(120,0,'IPTCOriginatingProgram','0',NULL,'zp-core/setup/setup-option-defaults.php'),(121,0,'IPTCProgramVersion','0',NULL,'zp-core/setup/setup-option-defaults.php'),(122,0,'auto_rotate','0',NULL,'zp-core/setup/setup-option-defaults.php'),(123,0,'IPTC_encoding','ISO-8859-1',NULL,'zp-core/setup/setup-option-defaults.php'),(124,0,'UTF8_image_URI','0',NULL,'zp-core/setup/setup-option-defaults.php'),(125,0,'captcha','zenphoto',NULL,'zp-core/setup/setup-option-defaults.php'),(126,0,'sharpen_amount','40',NULL,'zp-core/setup/setup-option-defaults.php'),(127,0,'sharpen_radius','0.5',NULL,'zp-core/setup/setup-option-defaults.php'),(128,0,'sharpen_threshold','3',NULL,'zp-core/setup/setup-option-defaults.php'),(129,0,'thumb_gray','0',NULL,'zp-core/setup/setup-option-defaults.php'),(130,0,'image_gray','0',NULL,'zp-core/setup/setup-option-defaults.php'),(132,0,'search_no_albums','0',NULL,'zp-core/setup/setup-option-defaults.php'),(133,0,'strong_hash','1',NULL,'zp-core/lib-auth.php'),(134,0,'defined_groups','a:6:{i:0;s:14:\"administrators\";i:1;s:7:\"viewers\";i:2;s:5:\"bozos\";i:3;s:14:\"album managers\";i:4;s:7:\"default\";i:5;s:7:\"newuser\";}',NULL,NULL),(135,0,'comment_body_requiired','1',NULL,'zp-core/setup/setup-option-defaults.php'),(136,0,'zp_plugin_zenphoto_sendmail','4101',NULL,'zp-core/setup/setup-option-defaults.php'),(137,0,'RSS_album_image','1',NULL,'zp-core/setup/setup-option-defaults.php'),(138,0,'RSS_comments','1',NULL,'zp-core/setup/setup-option-defaults.php'),(139,0,'RSS_articles','1',NULL,'zp-core/setup/setup-option-defaults.php'),(140,0,'RSS_article_comments','1',NULL,'zp-core/setup/setup-option-defaults.php'),(141,0,'tinyMCEPresent','0',NULL,'zp-core/setup/setup-option-defaults.php'),(142,0,'AlbumThumbSelectField','ID',NULL,'zp-core/setup/setup-option-defaults.php'),(143,0,'AlbumThumbSelectDirection','DESC',NULL,'zp-core/setup/setup-option-defaults.php'),(144,0,'AlbumThumbSelectorText','most recent',NULL,'zp-core/setup/setup-option-defaults.php'),(145,0,'site_email','nicola.spesivcev@gmail.com',NULL,'zp-core/setup/setup-option-defaults.php'),(146,0,'Zenphoto_theme_list','a:5:{i:0;s:7:\"default\";i:1;s:18:\"effervescence_plus\";i:2;s:7:\"garland\";i:3;s:10:\"stopdesign\";i:4;s:7:\"zenpage\";}',NULL,NULL),(147,0,'zp_plugin_deprecated-functions','4105',NULL,NULL),(148,0,'zp_plugin_zenphoto_news','2053',NULL,'zp-core/setup/setup-option-defaults.php'),(149,0,'zp_plugin_hitcounter','0',NULL,'zp-core/setup/setup-option-defaults.php'),(150,0,'zp_plugin_tiny_mce','2053',NULL,'zp-core/setup/setup-option-defaults.php'),(151,0,'zp_plugin_security-logger','4105',NULL,'zp-core/setup/setup-option-defaults.php'),(152,0,'album_publish','1',NULL,'zp-core/setup/setup-option-defaults.php'),(153,0,'image_publish','1',NULL,'zp-core/setup/setup-option-defaults.php'),(154,0,'deprecated_getZenpageHitcounter','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(155,0,'deprecated_printImageRating','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(156,0,'deprecated_printAlbumRating','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(157,0,'deprecated_printImageEXIFData','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(158,0,'deprecated_printCustomSizedImageMaxHeight','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(159,0,'deprecated_getCommentDate','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(160,0,'deprecated_getCommentTime','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(161,0,'deprecated_hitcounter','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(162,0,'deprecated_my_truncate_string','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(163,0,'deprecated_getImageEXIFData','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(164,0,'deprecated_getAlbumPlace','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(165,0,'deprecated_printAlbumPlace','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(166,0,'deprecated_zenpageHitcounter','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(167,0,'deprecated_rewrite_path_zenpage','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(168,0,'deprecated_getNewsImageTags','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(169,0,'deprecated_printNewsImageTags','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(170,0,'deprecated_getNumSubalbums','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(171,0,'deprecated_getAllSubalbums','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(172,0,'deprecated_addPluginScript','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(173,0,'deprecated_zenJavascript','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(174,0,'deprecated_normalizeColumns','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(175,0,'deprecated_printParentPagesBreadcrumb','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(176,0,'deprecated_isMyAlbum','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(177,0,'deprecated_getSubCategories','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(178,0,'deprecated_inProtectedNewsCategory','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(179,0,'deprecated_isProtectedNewsCategory','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(180,0,'deprecated_getParentNewsCategories','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(181,0,'deprecated_getCategoryTitle','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(182,0,'deprecated_getCategoryID','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(183,0,'deprecated_getCategoryParentID','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(184,0,'deprecated_getCategorySortOrder','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(185,0,'deprecated_getParentPages','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(186,0,'deprecated_isProtectedPage','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(187,0,'deprecated_isMyPage','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(188,0,'deprecated_checkPagePassword','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(189,0,'deprecated_isMyNews','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(190,0,'deprecated_checkNewsAccess','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(191,0,'deprecated_checkNewsCategoryPassword','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(192,0,'deprecated_getCurrentNewsCategory','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(193,0,'deprecated_getCurrentNewsCategoryID','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(194,0,'deprecated_getCurrentNewsCategoryParentID','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(195,0,'deprecated_inNewsCategory','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(196,0,'deprecated_inSubNewsCategoryOf','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(197,0,'deprecated_isSubNewsCategoryOf','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(198,0,'deprecated_printNewsReadMoreLink','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(199,0,'deprecated_getNewsContentShorten','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(200,0,'deprecated_checkForPassword','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(201,0,'deprecated_printAlbumMap','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(202,0,'deprecated_printImageMap','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(203,0,'deprecated_setupAllowedMaps','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(204,0,'deprecated_printPreloadScript','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(205,0,'deprecated_processExpired','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(206,0,'deprecated_getParentItems','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(207,0,'deprecated_getPages','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(208,0,'deprecated_getNewsArticles','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(209,0,'deprecated_countArticles','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(210,0,'deprecated_getLimitAndOffset','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(211,0,'deprecated_getTotalArticles','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(212,0,'deprecated_getAllArticleDates','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(213,0,'deprecated_getCurrentNewsPage','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(214,0,'deprecated_getCurrentAdminNewsPage','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(215,0,'deprecated_getCombiNews','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(216,0,'deprecated_countCombiNews','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(217,0,'deprecated_getCategoryLink','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(218,0,'deprecated_getCategory','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(219,0,'deprecated_getAllCategories','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(220,0,'deprecated_isProtectedAlbum','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(221,0,'deprecated_getSearchURL','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(222,0,'deprecated_printPasswordForm','1',NULL,'zp-core/zp-extensions/deprecated-functions.php'),(223,0,'zp_plugin_zenphoto_seo','2053',NULL,'zp-core/setup/setup-option-defaults.php'),(224,0,'default_copyright','Copyright: Nicolay Spesivtsev',NULL,'zp-core/setup/setup-option-defaults.php'),(225,0,'fullsizeimage_watermark','',NULL,'zp-core/setup/setup-option-defaults.php'),(226,0,'gallery_page_unprotected_register','1',NULL,'zp-core/setup/setup-option-defaults.php'),(227,0,'gallery_page_unprotected_contact','1',NULL,'zp-core/setup/setup-option-defaults.php'),(228,0,'gallery_data','a:15:{s:13:\"current_theme\";s:22:\"hisrocket-single-image\";s:18:\"persistent_archive\";i:0;s:13:\"album_session\";i:0;s:19:\"thumb_select_images\";i:0;s:13:\"gallery_title\";s:75:\"a:2:{s:5:\"en_US\";s:10:\"His Rocket\";s:5:\"ru_RU\";s:19:\"Его Ракета\";}\";s:19:\"Gallery_description\";s:0:\"\";s:13:\"website_title\";s:66:\"a:2:{s:5:\"en_US\";s:10:\"His Rocket\";s:5:\"ru_RU\";s:10:\"His Rocket\";}\";s:11:\"website_url\";s:20:\"http://hisrocket.org\";s:24:\"album_use_new_image_date\";i:0;s:16:\"gallery_sorttype\";s:0:\"\";s:14:\"sort_direction\";i:0;s:17:\"unprotected_pages\";s:6:\"a:0:{}\";s:16:\"gallery_security\";s:6:\"public\";s:16:\"login_user_field\";b:0;s:9:\"codeblock\";s:39:\"a:3:{i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:0:\"\";}\";}',NULL,'zp-core/setup/setup-option-defaults.php'),(229,0,'zenphoto_captcha_length','5',NULL,'zp-core/zp-extensions/captcha/zenphoto.php'),(230,0,'zenphoto_captcha_key','551036d5181bd08005eefaf3d80b6a12147e2046',NULL,'zp-core/zp-extensions/captcha/zenphoto.php'),(231,0,'zenphoto_captcha_string','abcdefghijkmnpqrstuvwxyz23456789ABCDEFGHJKLMNPQRSTUVWXYZ',NULL,'zp-core/zp-extensions/captcha/zenphoto.php'),(232,0,'extra_auth_hash_text','I_v?]Hyms[R45u#YaVPNl,uoA>{+*G',NULL,'zp-core/lib-auth.php'),(233,0,'min_password_lenght','6',NULL,'zp-core/lib-auth.php'),(234,0,'password_pattern','A-Za-z0-9   |   ~!@#$%&*_+`-(),.\\^\'\"/[]{}=:;?\\|',NULL,'zp-core/lib-auth.php'),(235,0,'Allow_search','1','stopdesign','themes/stopdesign'),(236,0,'Theme_logo','','effervescence_plus','themes/effervescence_plus'),(237,0,'Allow_search','1','default','themes/default'),(238,0,'Mini_slide_selector','Recent images','stopdesign','themes/stopdesign'),(239,0,'zenpage_zp_index_news','','zenpage','themes/zenpage'),(240,0,'Theme_colors','light','default','themes/default'),(241,0,'Allow_search','1','effervescence_plus','themes/effervescence_plus'),(242,0,'albums_per_row','3','stopdesign','themes/stopdesign'),(243,0,'albums_per_row','2','default','themes/default'),(244,0,'Allow_search','1','zenpage','themes/zenpage'),(245,0,'enable_album_zipfile','','effervescence_plus','themes/effervescence_plus'),(246,0,'images_per_row','6','stopdesign','themes/stopdesign'),(247,0,'images_per_row','5','default','themes/default'),(248,0,'Slideshow','1','effervescence_plus','themes/effervescence_plus'),(249,0,'Use_thickbox','1','zenpage','themes/zenpage'),(250,0,'thumb_transition','1','default','themes/default'),(251,0,'thumb_transition','1','stopdesign','themes/stopdesign'),(252,0,'Graphic_logo','*','effervescence_plus','themes/effervescence_plus'),(253,0,'zp_plugin_colorbox','0',NULL,'themes/default/themeoptions.php'),(254,0,'Allow_search','1','garland','themes/garland'),(255,0,'Watermark_head_image','1','effervescence_plus','themes/effervescence_plus'),(256,0,'colorbox_default_album','1',NULL,'themes/default/themeoptions.php'),(257,0,'Allow_cloud','1','garland','themes/garland'),(258,0,'colorbox_stopdesign_album','1',NULL,'themes/stopdesign/themeoptions.php'),(259,0,'Theme_personality','Image page','effervescence_plus','themes/effervescence_plus'),(260,0,'colorbox_default_image','1',NULL,'themes/default/themeoptions.php'),(261,0,'albums_per_row','2','garland','themes/garland'),(262,0,'colorbox_stopdesign_image','1',NULL,'themes/stopdesign/themeoptions.php'),(263,0,'Theme_colors','kish-my father','effervescence_plus','themes/effervescence_plus'),(264,0,'colorbox_default_search','1',NULL,'themes/default/themeoptions.php'),(265,0,'images_per_row','5','garland','themes/garland'),(266,0,'colorbox_stopdesign_search','1',NULL,'themes/stopdesign/themeoptions.php'),(267,0,'zenpage_homepage','none','zenpage','themes/zenpage'),(268,0,'effervescence_menu','','effervescence_plus','themes/effervescence_plus'),(269,0,'thumb_transition','1','garland','themes/garland'),(270,0,'zenpage_contactpage','1','zenpage','themes/zenpage'),(271,0,'albums_per_row','3','effervescence_plus','themes/effervescence_plus'),(272,0,'zenpage_custommenu','','zenpage','themes/zenpage'),(273,0,'thumb_size','85','garland','themes/garland'),(274,0,'images_per_row','4','effervescence_plus','themes/effervescence_plus'),(275,0,'albums_per_row','2','zenpage','themes/zenpage'),(276,0,'thumb_transition','1','effervescence_plus','themes/effervescence_plus'),(277,0,'colorbox_garland_image','1',NULL,'themes/garland/themeoptions.php'),(278,0,'effervescence_daily_album_image','1','effervescence_plus','themes/effervescence_plus'),(279,0,'effervescence_daily_album_image_effect','','effervescence_plus','themes/effervescence_plus'),(280,0,'images_per_row','5','zenpage','themes/zenpage'),(281,0,'colorbox_effervescence_plus_album','1',NULL,'themes/effervescence_plus/themeoptions.php'),(282,0,'thumb_transition','1','zenpage','themes/zenpage'),(283,0,'colorbox_garland_album','1',NULL,'themes/garland/themeoptions.php'),(284,0,'colorbox_effervescence_plus_image','1',NULL,'themes/effervescence_plus/themeoptions.php'),(285,0,'colorbox_effervescence_plus_search','1',NULL,'themes/effervescence_plus/themeoptions.php'),(286,0,'colorbox_zenpage_album','1',NULL,'themes/zenpage/themeoptions.php'),(287,0,'colorbox_garland_search','1',NULL,'themes/garland/themeoptions.php'),(288,0,'colorbox_zenpage_image','1',NULL,'themes/zenpage/themeoptions.php'),(289,0,'colorbox_zenpage_search','1',NULL,'themes/zenpage/themeoptions.php'),(290,0,'custom_index_page','','default','themes/default'),(291,0,'garland_menu','','garland','themes/garland'),(292,0,'last_garbage_collect','1334750802',NULL,NULL),(293,0,'gallery_sortdirection','0',NULL,NULL),(294,0,'gallery_sorttype','',NULL,NULL),(295,0,'gallery_title','a:2:{s:5:\"en_US\";s:10:\"His Rocket\";s:5:\"ru_RU\";s:19:\"Его Ракета\";}',NULL,NULL),(296,0,'Gallery_description','',NULL,NULL),(297,0,'gallery_password',NULL,NULL,NULL),(298,0,'gallery_user',NULL,NULL,NULL),(299,0,'gallery_hint',NULL,NULL,NULL),(300,0,'hitcounter',NULL,NULL,NULL),(301,0,'current_theme','hisrocket-single-image',NULL,NULL),(302,0,'website_title','a:2:{s:5:\"en_US\";s:10:\"His Rocket\";s:5:\"ru_RU\";s:10:\"His Rocket\";}',NULL,NULL),(303,0,'website_url','http://hisrocket.org',NULL,NULL),(304,0,'gallery_security','public',NULL,NULL),(305,0,'login_user_field','',NULL,NULL),(306,0,'album_use_new_image_date','0',NULL,NULL),(307,0,'thumb_select_images','0',NULL,NULL),(308,0,'persistent_archive','0',NULL,NULL),(309,0,'unprotected_pages','a:0:{}',NULL,NULL),(310,0,'hrsi_homeoption','random-daily',NULL,'themes/hisrocket-single-image/themeoptions.php'),(311,0,'hrsi_album_thumb_size','220',NULL,'themes/hisrocket-single-image/themeoptions.php'),(312,0,'hrsi_social','0',NULL,'themes/hisrocket-single-image/themeoptions.php'),(313,0,'hrsi_switch','0',NULL,'themes/hisrocket-single-image/themeoptions.php'),(314,0,'hrsi_menu','default',NULL,'themes/hisrocket-single-image/themeoptions.php'),(315,0,'hrsi_logo','',NULL,'themes/hisrocket-single-image/themeoptions.php'),(316,0,'hrsi_colorbox','0',NULL,'themes/hisrocket-single-image/themeoptions.php'),(317,0,'hrsi_cbstyle','style3',NULL,'themes/hisrocket-single-image/themeoptions.php'),(318,0,'hrsi_zpsearchcount','2',NULL,'themes/hisrocket-single-image/themeoptions.php'),(319,0,'hrsi_finallink','colorbox',NULL,'themes/hisrocket-single-image/themeoptions.php'),(320,0,'disallow_zh_CN','1',NULL,NULL),(321,0,'disallow_zh_TW','1',NULL,NULL),(322,0,'disallow_nl_NL','1',NULL,NULL),(323,0,'disallow_en_US','0',NULL,NULL),(324,0,'disallow_fr_FR','1',NULL,NULL),(325,0,'disallow_gl_ES','1',NULL,NULL),(326,0,'disallow_de_DE','1',NULL,NULL),(327,0,'disallow_he_IL','1',NULL,NULL),(328,0,'disallow_it_IT','1',NULL,NULL),(329,0,'disallow_ja_JP','1',NULL,NULL),(330,0,'disallow_pl_PL','1',NULL,NULL),(331,0,'disallow_sk_SK','1',NULL,NULL),(332,0,'disallow_es_ES','1',NULL,NULL),(333,0,'disallow_sv_SE','1',NULL,NULL),(334,0,'mod_rewrite','1',NULL,NULL),(335,0,'time_zone','Europe/Moscow',NULL,NULL),(336,0,'edit_in_place','0',NULL,NULL),(337,0,'sort_direction','0',NULL,NULL),(338,0,'codeblock','a:3:{i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:0:\"\";}',NULL,NULL),(339,0,'thumb_crop','0','hisrocket-single-image','themes/hisrocket-single-image'),(340,0,'thumb_size','220','hisrocket-single-image','themes/hisrocket-single-image'),(341,0,'thumb_crop_width','220','hisrocket-single-image','themes/hisrocket-single-image'),(342,0,'thumb_crop_height','220','hisrocket-single-image','themes/hisrocket-single-image'),(343,0,'albums_per_page','200','hisrocket-single-image','themes/hisrocket-single-image'),(344,0,'albums_per_row','2','hisrocket-single-image','themes/hisrocket-single-image'),(345,0,'images_per_page','201','hisrocket-single-image','themes/hisrocket-single-image'),(346,0,'images_per_row','3','hisrocket-single-image','themes/hisrocket-single-image'),(347,0,'thumb_transition','0','hisrocket-single-image','themes/hisrocket-single-image'),(348,0,'thumb_gray','0','hisrocket-single-image','themes/hisrocket-single-image'),(349,0,'image_gray','0','hisrocket-single-image','themes/hisrocket-single-image'),(350,0,'hrsi_disablemeta','1',NULL,NULL),(351,0,'zp_plugin_class-video_mov_w','520',NULL,'zp-core/zp-extensions/class-video.php'),(352,0,'zp_plugin_class-video_mov_h','390',NULL,'zp-core/zp-extensions/class-video.php'),(353,0,'zp_plugin_class-video_3gp_w','520',NULL,'zp-core/zp-extensions/class-video.php'),(354,0,'zp_plugin_class-video_3gp_h','390',NULL,'zp-core/zp-extensions/class-video.php'),(355,0,'hitcounter_ignoreIPList_enable','0',NULL,'zp-core/zp-extensions/hitcounter.php'),(356,0,'hitcounter_ignoreSearchCrawlers_enable','0',NULL,'zp-core/zp-extensions/hitcounter.php'),(357,0,'hitcounter_ignoreIPList','',NULL,'zp-core/zp-extensions/hitcounter.php'),(358,0,'hitcounter_searchCrawlerList','Teoma,alexa, froogle, Gigabot,inktomi, looksmart, URL_Spider_SQL,Firefly, NationalDirectory, Ask Jeeves,TECNOSEEK, InfoSeek, WebFindBot, girafabot, crawler,www.galaxy.com, Googlebot, Scooter, Slurp, msnbot, appie, FAST, WebBug, Spade, ZyBorg, rabaz ,Baiduspider, Feedfetcher-Google, TechnoratiSnoop, Rankivabot, Mediapartners-Google, Sogou web spider, WebAlta Crawler',NULL,'zp-core/zp-extensions/hitcounter.php'),(359,0,'logger_log_guests','1',NULL,'zp-core/zp-extensions/security-logger.php'),(360,0,'logger_log_admin','1',NULL,'zp-core/zp-extensions/security-logger.php'),(361,0,'logger_log_type','all',NULL,'zp-core/zp-extensions/security-logger.php'),(362,0,'tinymce_zenphoto','zenphoto-default.js.php',NULL,'zp-core/zp-extensions/tiny_mce.php'),(363,0,'tinymce_zenpage','zenpage-default-full.js.php',NULL,'zp-core/zp-extensions/tiny_mce.php'),(364,0,'tinymce_tinyzenpage_customimagesize','400',NULL,'zp-core/zp-extensions/tiny_mce.php'),(365,0,'tinymce_tinyzenpage_customthumb_size','120',NULL,'zp-core/zp-extensions/tiny_mce.php'),(366,0,'tinymce_tinyzenpage_customthumb_cropwidth','120',NULL,'zp-core/zp-extensions/tiny_mce.php'),(367,0,'tinymce_tinyzenpage_customthumb_cropheight','120',NULL,'zp-core/zp-extensions/tiny_mce.php'),(368,0,'tinymce_tinyzenpage_flowplayer_width','320',NULL,'zp-core/zp-extensions/tiny_mce.php'),(369,0,'tinymce_tinyzenpage_flowplayer_height','240',NULL,'zp-core/zp-extensions/tiny_mce.php'),(370,0,'zenphoto_seo_lowercase','1',NULL,'zp-core/zp-extensions/zenphoto_seo.php'),(371,0,'Action','pass',NULL,'zp-core/zp-extensions/spamfilters/none.php'),(372,0,'hrsi_album_thumb_size','220','hisrocket-single-image','themes/hisrocket-single-image'),(373,0,'hrsi_cbstyle','style3','hisrocket-single-image','themes/hisrocket-single-image'),(374,0,'hrsi_disablemeta','1','hisrocket-single-image','themes/hisrocket-single-image'),(375,0,'hrsi_finallink','colorbox','hisrocket-single-image','themes/hisrocket-single-image'),(376,0,'hrsi_homeoption','random-daily','hisrocket-single-image','themes/hisrocket-single-image'),(377,0,'hrsi_logo','','hisrocket-single-image','themes/hisrocket-single-image'),(378,0,'hrsi_menu','default','hisrocket-single-image','themes/hisrocket-single-image'),(379,0,'hrsi_switch','0','hisrocket-single-image','themes/hisrocket-single-image'),(380,0,'hrsi_social','0','hisrocket-single-image','themes/hisrocket-single-image'),(381,0,'hrsi_colorbox','0','hisrocket-single-image','themes/hisrocket-single-image'),(382,0,'hrsi_zpsearchcount','2','hisrocket-single-image','themes/hisrocket-single-image'),(383,0,'zp_plugin_federated_logon','0',NULL,NULL),(384,0,'zp_plugin_flowplayer3_playlist','0',NULL,NULL),(385,0,'zp_plugin_seo_locale','0',NULL,NULL),(386,0,'zp_plugin_GoogleMap','0',NULL,NULL),(387,0,'zp_plugin_PHPMailer','0',NULL,NULL),(388,0,'zp_plugin_admin-approval','0',NULL,NULL),(389,0,'zp_plugin_auto_backup','0',NULL,NULL),(390,0,'zp_plugin_class-AnyFile','0',NULL,NULL),(391,0,'zp_plugin_class-WEBdocs','4105',NULL,NULL),(392,0,'zp_plugin_class-textobject','4105',NULL,NULL),(393,0,'zp_plugin_comment_form','0',NULL,NULL),(394,0,'zp_plugin_contact_form','0',NULL,NULL),(395,0,'zp_plugin_crop_image','0',NULL,NULL),(396,0,'zp_plugin_downloadList','0',NULL,NULL),(397,0,'zp_plugin_dynamic-locale','129',NULL,NULL),(398,0,'zp_plugin_email-newuser','0',NULL,NULL),(399,0,'zp_plugin_failed_access_blocker','0',NULL,NULL),(400,0,'zp_plugin_flag_thumbnail','0',NULL,NULL),(401,0,'zp_plugin_flowplayer3','0',NULL,NULL),(402,0,'zp_plugin_html_meta_tags','0',NULL,NULL),(403,0,'zp_plugin_image_album_statistics','0',NULL,NULL),(404,0,'zp_plugin_image_effects','0',NULL,NULL),(405,0,'zp_plugin_image_upload_limiter','0',NULL,NULL),(406,0,'zp_plugin_jcarousel_thumb_nav','0',NULL,NULL),(407,0,'menu_truncate_string','0',NULL,'zp-core/zp-extensions/menu_manager.php'),(408,0,'menu_truncate_indicator','',NULL,'zp-core/zp-extensions/menu_manager.php'),(409,0,'zp_plugin_menu_manager','2181',NULL,NULL),(410,0,'zp_plugin_multiple_layouts','0',NULL,NULL),(411,0,'zp_plugin_paged_thumbs_nav','0',NULL,NULL),(412,0,'zp_plugin_print_album_menu','0',NULL,NULL),(413,0,'zp_plugin_quota_manager','0',NULL,NULL),(414,0,'zp_plugin_rating','0',NULL,NULL),(415,0,'zp_plugin_register_user','0',NULL,NULL),(416,0,'zp_plugin_search_statistics','0',NULL,NULL),(417,0,'zp_plugin_show_not_logged-in','0',NULL,NULL),(418,0,'zp_plugin_sitemap-extended','0',NULL,NULL),(419,0,'slideshow_width','595',NULL,'zp-core/zp-extensions/slideshow.php'),(420,0,'slideshow_height','595',NULL,'zp-core/zp-extensions/slideshow.php'),(421,0,'slideshow_watermark','0',NULL,'zp-core/zp-extensions/slideshow.php'),(422,0,'slideshow_mode','jQuery',NULL,'zp-core/zp-extensions/slideshow.php'),(423,0,'slideshow_effect','fade',NULL,'zp-core/zp-extensions/slideshow.php'),(424,0,'slideshow_speed','1000',NULL,'zp-core/zp-extensions/slideshow.php'),(425,0,'slideshow_timeout','3000',NULL,'zp-core/zp-extensions/slideshow.php'),(426,0,'slideshow_showdesc','0',NULL,'zp-core/zp-extensions/slideshow.php'),(427,0,'slideshow_colorbox_transition','fade',NULL,'zp-core/zp-extensions/slideshow.php'),(428,0,'slideshow_flow_player_width','640',NULL,'zp-core/zp-extensions/slideshow.php'),(429,0,'slideshow_flow_player_height','480',NULL,'zp-core/zp-extensions/slideshow.php'),(430,0,'slideshow_colorbox_imagetype','sizedimage',NULL,'zp-core/zp-extensions/slideshow.php'),(431,0,'zp_plugin_slideshow','0',NULL,NULL),(432,0,'zp_plugin_static_html_cache','0',NULL,NULL),(433,0,'zp_plugin_tag_extras','0',NULL,NULL),(434,0,'zp_plugin_tag_suggest','0',NULL,NULL),(435,0,'zp_plugin_tweet_news','0',NULL,NULL),(436,0,'zp_plugin_user-expiry','0',NULL,NULL),(437,0,'zp_plugin_user_groups','0',NULL,NULL),(438,0,'zp_plugin_user_login-out','0',NULL,NULL),(439,0,'zp_plugin_viewer_size_image','0',NULL,NULL),(440,0,'zp_plugin_xmpMetadata','0',NULL,NULL),(441,0,'zp_plugin_zenpage','129',NULL,NULL),(442,0,'WEBdocs_pdf_provider','zoho',NULL,'zp-core/zp-extensions/class-WEBdocs.php'),(443,0,'WEBdocs_pps_provider','google',NULL,'zp-core/zp-extensions/class-WEBdocs.php'),(444,0,'WEBdocs_tif_provider','zoho',NULL,'zp-core/zp-extensions/class-WEBdocs.php'),(445,0,'zpfocus_tagline','A ZenPhoto / ZenPage Powered Theme',NULL,'themes/zpfocus_v1.4.1/themeoptions.php'),(446,0,'zpfocus_allow_search','1',NULL,'themes/zpfocus_v1.4.1/themeoptions.php'),(447,0,'zpfocus_show_archive','1',NULL,'themes/zpfocus_v1.4.1/themeoptions.php'),(448,0,'zpfocus_show_stats_inmenu','',NULL,'themes/zpfocus_v1.4.1/themeoptions.php'),(449,0,'zpfocus_use_colorbox','1',NULL,'themes/zpfocus_v1.4.1/themeoptions.php'),(450,0,'zpfocus_use_colorbox_slideshow','1',NULL,'themes/zpfocus_v1.4.1/themeoptions.php'),(451,0,'zpfocus_homepage','none',NULL,'themes/zpfocus_v1.4.1/themeoptions.php'),(452,0,'zpfocus_spotlight','manual',NULL,'themes/zpfocus_v1.4.1/themeoptions.php'),(453,0,'zpfocus_spotlight_text','<p>This is the <span class=\"spotlight-span\">spotlight</span> area that can be set in the theme options.  You can either enter the text manually in the options or set it to display the latest news if ZenPage is being used. If you want nothing to appear here, set the spotlight to none.</p>',NULL,'themes/zpfocus_v1.4.1/themeoptions.php'),(454,0,'zpfocus_show_credit','',NULL,'themes/zpfocus_v1.4.1/themeoptions.php'),(455,0,'zpfocus_menutype','dropdown',NULL,'themes/zpfocus_v1.4.1/themeoptions.php'),(456,0,'zpfocus_logotype','1',NULL,'themes/zpfocus_v1.4.1/themeoptions.php'),(457,0,'zpfocus_logofile','logo.jpg',NULL,'themes/zpfocus_v1.4.1/themeoptions.php'),(458,0,'zpfocus_showrandom','rotator',NULL,'themes/zpfocus_v1.4.1/themeoptions.php'),(459,0,'zpfocus_rotatoreffect','fade',NULL,'themes/zpfocus_v1.4.1/themeoptions.php'),(460,0,'zpfocus_rotatorspeed','3000',NULL,'themes/zpfocus_v1.4.1/themeoptions.php'),(461,0,'zpfocus_cbtarget','1',NULL,'themes/zpfocus_v1.4.1/themeoptions.php'),(462,0,'zpfocus_cbstyle','style3',NULL,'themes/zpfocus_v1.4.1/themeoptions.php'),(463,0,'zpfocus_cbtransition','fade',NULL,'themes/zpfocus_v1.4.1/themeoptions.php'),(464,0,'zpfocus_cbssspeed','2500',NULL,'themes/zpfocus_v1.4.1/themeoptions.php'),(465,0,'zpfocus_final_link','nolink',NULL,'themes/zpfocus_v1.4.1/themeoptions.php'),(466,0,'textobject_watermark_default_images','0',NULL,NULL),(467,0,'video_watermark_default_images','0',NULL,NULL),(468,0,'WEBdocs_watermark_default_images','0',NULL,NULL),(469,0,'zenpage_articles_per_page','10',NULL,'zp-core/zp-extensions/zenpage.php'),(470,0,'zenpage_text_length','500',NULL,'zp-core/zp-extensions/zenpage.php'),(471,0,'zenpage_textshorten_indicator',' (...)',NULL,'zp-core/zp-extensions/zenpage.php'),(472,0,'zenpage_read_more','Read more',NULL,'zp-core/zp-extensions/zenpage.php'),(473,0,'zenpage_rss_items','10',NULL,'zp-core/zp-extensions/zenpage.php'),(474,0,'zenpage_rss_length','100',NULL,'zp-core/zp-extensions/zenpage.php'),(475,0,'zenpage_admin_articles','15',NULL,'zp-core/zp-extensions/zenpage.php'),(476,0,'zenpage_indexhitcounter','',NULL,'zp-core/zp-extensions/zenpage.php'),(477,0,'zenpage_combinews','0',NULL,'zp-core/zp-extensions/zenpage.php'),(478,0,'zenpage_combinews_readmore','Visit gallery page',NULL,'zp-core/zp-extensions/zenpage.php'),(479,0,'zenpage_combinews_mode','latestalbums-sizedimage',NULL,'zp-core/zp-extensions/zenpage.php'),(480,0,'zenpage_combinews_imagesize','300',NULL,'zp-core/zp-extensions/zenpage.php'),(481,0,'zenpage_combinews_sortorder','mtime',NULL,'zp-core/zp-extensions/zenpage.php'),(482,0,'zenpage_combinews_gallerylink','image',NULL,'zp-core/zp-extensions/zenpage.php'),(483,0,'combinews-thumbnail-cropwidth','',NULL,'zp-core/zp-extensions/zenpage.php'),(484,0,'combinews-thumbnail-cropheight','',NULL,'zp-core/zp-extensions/zenpage.php'),(485,0,'combinews-thumbnail-width','',NULL,'zp-core/zp-extensions/zenpage.php'),(486,0,'combinews-thumbnail-height','',NULL,'zp-core/zp-extensions/zenpage.php'),(487,0,'combinews-thumbnail-cropx','',NULL,'zp-core/zp-extensions/zenpage.php'),(488,0,'combinews-thumbnail-cropy','',NULL,'zp-core/zp-extensions/zenpage.php'),(489,0,'combinews-latestimagesbyalbum-imgdesc','0',NULL,'zp-core/zp-extensions/zenpage.php'),(490,0,'combinews-latestimagesbyalbum-imgtitle','0',NULL,'zp-core/zp-extensions/zenpage.php'),(491,0,'combinews-customtitle-singular','%1$u new item in <em>%2$s</em>: %3$s',NULL,'zp-core/zp-extensions/zenpage.php'),(492,0,'combinews-customtitle-plural','%1$u new items in <em>%2$s</em>: %3$s',NULL,'zp-core/zp-extensions/zenpage.php'),(493,0,'combinews-customtitle-imagetitles','6',NULL,'zp-core/zp-extensions/zenpage.php'),(494,0,'image_interlace','0',NULL,NULL),(495,0,'ImbedIPTC','0',NULL,NULL),(496,0,'fullimage_watermark','',NULL,NULL),(497,0,'WEBdocs_watermark','',NULL,NULL),(498,0,'Video_watermark','',NULL,NULL),(499,0,'TextObject_watermark','',NULL,NULL),(500,0,'Image_watermark','',NULL,NULL),(501,0,'picture_of_the_day','a:3:{s:3:\"day\";i:1334216660;s:6:\"folder\";s:4:\"uyut\";s:8:\"filename\";s:6:\"67.jpg\";}','hisrocket-single-image','themes/hisrocket-single-image'),(502,0,'dynamic_locale_visual','1',NULL,'zp-core/zp-extensions/dynamic-locale.php'),(503,0,'menu_manager_truncate_note','',NULL,NULL),(504,0,'disallow_ru_RU','0',NULL,NULL),(505,0,NULL,NULL,NULL,NULL),(506,0,NULL,NULL,NULL,NULL),(507,0,NULL,NULL,NULL,NULL),(508,0,NULL,NULL,NULL,NULL),(509,0,NULL,NULL,NULL,NULL),(510,0,NULL,NULL,NULL,NULL),(511,0,NULL,NULL,NULL,NULL),(512,0,NULL,NULL,NULL,NULL),(513,0,NULL,NULL,NULL,NULL),(514,0,NULL,NULL,NULL,NULL),(515,0,NULL,NULL,NULL,NULL),(516,0,NULL,NULL,NULL,NULL),(517,0,NULL,NULL,NULL,NULL),(518,0,NULL,NULL,NULL,NULL),(519,0,NULL,NULL,NULL,NULL),(520,0,NULL,NULL,NULL,NULL),(521,0,NULL,NULL,NULL,NULL),(522,0,NULL,NULL,NULL,NULL),(523,0,NULL,NULL,NULL,NULL),(524,0,NULL,NULL,NULL,NULL),(525,0,NULL,NULL,NULL,NULL),(526,0,NULL,NULL,NULL,NULL),(527,0,NULL,NULL,NULL,NULL),(528,0,NULL,NULL,NULL,NULL),(529,0,NULL,NULL,NULL,NULL),(530,0,'zp-core/setup/setup-option-defaults.php',NULL,NULL,NULL);
/*!40000 ALTER TABLE `zp_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zp_pages`
--

DROP TABLE IF EXISTS `zp_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zp_pages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` int(11) unsigned DEFAULT NULL,
  `title` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci,
  `extracontent` text COLLATE utf8_unicode_ci,
  `sort_order` varchar(48) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `show` int(1) unsigned NOT NULL DEFAULT '1',
  `titlelink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `commentson` int(1) unsigned DEFAULT '0',
  `codeblock` text COLLATE utf8_unicode_ci,
  `author` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime DEFAULT NULL,
  `lastchange` datetime DEFAULT NULL,
  `lastchangeauthor` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `hitcounter` int(11) unsigned DEFAULT '0',
  `permalink` int(1) unsigned NOT NULL DEFAULT '0',
  `locked` int(1) unsigned NOT NULL DEFAULT '0',
  `expiredate` datetime DEFAULT NULL,
  `total_value` int(11) unsigned DEFAULT '0',
  `total_votes` int(11) unsigned DEFAULT '0',
  `used_ips` longtext COLLATE utf8_unicode_ci,
  `rating` float DEFAULT NULL,
  `rating_status` int(1) DEFAULT '3',
  `user` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_hint` text COLLATE utf8_unicode_ci,
  `custom_data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `titlelink` (`titlelink`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zp_pages`
--

LOCK TABLES `zp_pages` WRITE;
/*!40000 ALTER TABLE `zp_pages` DISABLE KEYS */;
INSERT INTO `zp_pages` VALUES (3,NULL,'a:2:{s:5:\"en_US\";s:2:\"CV\";s:5:\"ru_RU\";s:8:\"СиВи\";}','a:2:{s:5:\"en_US\";s:15:\"<p>BlahBlah</p>\";s:5:\"ru_RU\";s:19:\"<p>БлаБла</p>\";}','','',1,'cv_2012-04-20-00-48-59',0,'a:3:{i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:0:\"\";}','admin','2012-04-20 00:48:59',NULL,'',0,1,0,NULL,0,0,NULL,NULL,3,NULL,NULL,NULL,'');
/*!40000 ALTER TABLE `zp_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zp_plugin_storage`
--

DROP TABLE IF EXISTS `zp_plugin_storage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zp_plugin_storage` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `aux` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `aux` (`aux`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zp_plugin_storage`
--

LOCK TABLES `zp_plugin_storage` WRITE;
/*!40000 ALTER TABLE `zp_plugin_storage` DISABLE KEYS */;
/*!40000 ALTER TABLE `zp_plugin_storage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zp_tags`
--

DROP TABLE IF EXISTS `zp_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zp_tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zp_tags`
--

LOCK TABLES `zp_tags` WRITE;
/*!40000 ALTER TABLE `zp_tags` DISABLE KEYS */;
INSERT INTO `zp_tags` VALUES (10,'2011'),(14,'colour'),(12,'coolscan4000'),(11,'film'),(13,'preview');
/*!40000 ALTER TABLE `zp_tags` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-04-20 13:38:51
