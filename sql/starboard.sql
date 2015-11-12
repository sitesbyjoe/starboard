# ************************************************************
# Sequel Pro SQL dump
# Version 4004
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: mysql.sitesbyjoe.com (MySQL 5.6.25-log)
# Database: clc_stars
# Generation Time: 2015-11-06 16:43:47 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table people
# ------------------------------------------------------------

DROP TABLE IF EXISTS `people`;

CREATE TABLE `people` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `stars` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `people` WRITE;
/*!40000 ALTER TABLE `people` DISABLE KEYS */;

INSERT INTO `people` (`id`, `name`, `email`, `stars`)
VALUES
	(5,'Chris C','',2),
	(6,'Dan','',1),
	(10,'James','',0),
	(11,'Jason','',6),
	(12,'Joe','',6),
	(13,'Jonathan','',3),
	(15,'Lori','',0),
	(16,'Sandra','',2),
	(18,'Jared','',0),
	(28,'Erik','',3),
	(23,'Jeff H','',6),
	(24,'Simon','',7),
	(25,'Victor','',5),
	(26,'Chris H','',0),
	(27,'Jeff Z','',0),
	(30,'Angie','',0),
	(22,'Gayane','',7),
	(31,'Jack','',0),
	(29,'Peter','',0);

/*!40000 ALTER TABLE `people` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table votes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `votes`;

CREATE TABLE `votes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vote_from` int(11) DEFAULT NULL,
  `vote_to` int(11) DEFAULT NULL,
  `reason` text,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `votes` WRITE;
/*!40000 ALTER TABLE `votes` DISABLE KEYS */;

INSERT INTO `votes` (`id`, `vote_from`, `vote_to`, `reason`, `timestamp`)
VALUES
	(98,12,22,'test','2015-11-04 14:38:04'),
	(99,12,16,'cuz its her birthday tomorrow','2015-11-04 14:56:17'),
	(100,12,24,'for being so gay and giving a cake and buying other birthday crap.','2015-11-05 11:35:28'),
	(101,25,12,'thank you for re-releasing this wonderful platform','2015-11-05 13:33:18'),
	(102,15,5,'','2015-11-06 08:13:02');

/*!40000 ALTER TABLE `votes` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
