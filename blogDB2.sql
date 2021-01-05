-- MySQL dump 10.13  Distrib 8.0.22, for Linux (x86_64)
--
-- Host: localhost    Database: blogs
-- ------------------------------------------------------
-- Server version	8.0.22-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `blogs`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `blogs` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `blogs`;

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `blog` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `user_id` bigint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` VALUES (1,'Test Blog Title','This is a test blog description.','2020-12-29 17:42:14',NULL,1);
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `title` varchar(128) DEFAULT NULL,
  `summary` tinytext,
  `content` text,
  `published` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `id` bigint NOT NULL AUTO_INCREMENT,
  `blog_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_id` (`blog_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`),
  CONSTRAINT `post_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES ('Test Post title','Test Post summary','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed diam risus, blandit ac suscipit ut, maximus sit amet est. Quisque at lacus tellus. Vestibulum pharetra quam justo, in bibendum nulla condimentum at. Cras et consectetur felis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus sapien eros, dictum eget posuere nec, sagittis in sapien. Mauris egestas nulla metus, in condimentum neque dapibus elementum. Aenean sit amet ligula turpis. Donec porttitor consectetur sem et aliquet.\r\n\r\nProin consequat dignissim leo, eget faucibus mi facilisis ac. Sed ut rutrum orci. Proin pellentesque elit lectus, et placerat nisi ornare in. Fusce quis arcu gravida, condimentum metus eu, commodo lacus. Nunc at porttitor metus. Duis vel feugiat velit. Donec imperdiet sit amet mi non faucibus. Nam imperdiet orci eu hendrerit mattis.\r\n\r\nMauris bibendum nisl ut odio tincidunt eleifend. Vivamus vel est dui. Fusce nec risus dictum est feugiat tristique eget sed enim. Curabitur ut tincidunt mauris. Phasellus ornare neque metus, et facilisis odio imperdiet tincidunt. Aenean id enim et tortor facilisis imperdiet. Nullam scelerisque metus in commodo rhoncus. Nulla ullamcorper sit amet velit ac commodo. Sed nec elit vel metus efficitur convallis eget quis justo.\r\n\r\nCurabitur fermentum arcu vel massa porttitor elementum. Mauris augue tortor, rhoncus a metus non, molestie finibus dui. Mauris eu felis vitae nisi facilisis malesuada. Praesent rutrum, leo luctus consequat gravida, diam mi vehicula nisl, id dictum massa purus vulputate libero. Vestibulum vitae gravida metus. Nulla facilisi. Nam id libero id erat volutpat lobortis. Morbi scelerisque in nisi ut porttitor. In quis elit vulputate, faucibus nulla ac, consequat elit. Curabitur id leo mauris. Pellentesque pretium, diam sed convallis rutrum, leo nisl mollis purus, et suscipit ipsum dui ut risus. Aliquam vel risus ultricies, hendrerit velit sed, mollis turpis. Mauris commodo risus sit amet condimentum vestibulum. Mauris sit amet pretium magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.\r\n\r\nNulla vehicula nisl quis mollis dictum. Phasellus et gravida metus. Morbi lorem sapien, gravida vitae neque at, commodo maximus libero. Pellentesque non lorem cursus, gravida purus vel, consequat tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec leo justo, pellentesque sit amet dapibus quis, ornare ac arcu. Aenean finibus lacus euismod feugiat ullamcorper. In varius posuere dui, in ullamcorper urna. Proin varius, libero id dictum venenatis, nulla elit tempus nunc, sed sagittis elit justo sed arcu. Fusce a turpis quis leo ornare elementum. Duis aliquam aliquam nunc, a tempus nulla porttitor a. Sed nibh libero, convallis eu eros a, sodales venenatis magna. Mauris dignissim faucibus urna, sit amet malesuada odio tincidunt a. Nulla nisl libero, pretium at mi a, sagittis aliquam dui. Integer nibh odio, imperdiet vel lacus et, egestas ullamcorper leo.',NULL,'2020-12-30 18:22:41',NULL,NULL,50,1,1),('Test Title 2','Short summary for Test Post 2','Content for Test Post 2',NULL,'2021-01-04 10:22:03',NULL,NULL,51,1,1),('New post 3','Summary for New Post 3','Content for new post 3',NULL,'2021-01-04 14:08:29',NULL,NULL,52,1,1),('Test Post for Deleted Author field','Test Test Test','Test Test TestTest Test TestTest Test TestTest Test TestTest Test TestTest Test TestTest Test Test',NULL,'2021-01-04 15:20:32',NULL,NULL,53,1,1);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `login_status` int NOT NULL DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `bio` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Test','Test','test@test.com',1,'2021-01-04 14:07:48','$2y$10$ZFOEe03quW2sh7CpIxJrfulKcvYYiz3wPlAvbWLJ/ni4vOusMDrLC','2020-12-18 00:38:46',NULL),(2,'Test2','Test2','test2@test.com',0,NULL,'$2y$10$YS1muIVmlBlqKOd.GP9.oeM2sCD6ELQ2DJzhMUBgfYcgJjh5wllFO','2020-12-18 00:44:51',NULL);
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

-- Dump completed on 2021-01-04 15:26:30
