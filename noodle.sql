-- MySQL dump 10.13  Distrib 5.7.16, for Linux (x86_64)
--
-- Host: 204.77.0.232    Database: noodle
-- ------------------------------------------------------
-- Server version	5.5.53-0ubuntu0.14.04.1

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
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orders_id` int(10) unsigned NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `suburb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fee` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_orders_id_foreign` (`orders_id`),
  CONSTRAINT `addresses_orders_id_foreign` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
INSERT INTO `addresses` VALUES (13,325,'2 sloane place Taradale','Napier','Napier',1.00,'2017-01-21 08:25:41','2017-01-21 08:25:41'),(14,326,'2 sloane place Taradale','Napier','Napier',1.00,'2017-01-21 10:04:54','2017-01-21 10:04:54'),(15,327,'2 sloane place Taradale','Napier','Napier',0.00,'2017-01-21 10:09:22','2017-01-21 10:09:22'),(16,328,'12 sloane place Taradale','Napier','Napier',0.00,'2017-01-21 10:12:09','2017-01-21 10:12:09'),(17,329,'2 sloane place Taradale','Napier','Napier',1.00,'2017-01-21 10:13:21','2017-01-21 10:13:21'),(18,330,'21 sloane place Taradale','Napier','Napier',0.00,'2017-01-23 04:21:47','2017-01-23 04:21:47'),(19,331,'25 sloane place Taradale','Napier','Napier',1.00,'2017-01-23 18:09:07','2017-01-23 18:09:07'),(20,332,'25 sloane place Taradale','Napier','Napier',6.00,'2017-01-23 19:31:35','2017-01-23 19:31:35'),(21,333,'25 sloane place Taradale','Napier','Napier',6.00,'2017-01-24 03:27:19','2017-01-24 03:27:19'),(22,335,'20 Chester st','Taradale ','Napier',6.00,'2017-02-06 00:26:01','2017-02-06 00:26:01');
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area`
--

LOCK TABLES `area` WRITE;
/*!40000 ALTER TABLE `area` DISABLE KEYS */;
/*!40000 ALTER TABLE `area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assumption_record`
--

DROP TABLE IF EXISTS `assumption_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assumption_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `point` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assumption_record_user_id_foreign` (`user_id`),
  CONSTRAINT `assumption_record_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assumption_record`
--

LOCK TABLES `assumption_record` WRITE;
/*!40000 ALTER TABLE `assumption_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `assumption_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blacklists`
--

DROP TABLE IF EXISTS `blacklists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blacklists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blacklists`
--

LOCK TABLES `blacklists` WRITE;
/*!40000 ALTER TABLE `blacklists` DISABLE KEYS */;
/*!40000 ALTER TABLE `blacklists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `catalogue_dishes`
--

DROP TABLE IF EXISTS `catalogue_dishes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `catalogue_dishes` (
  `catalogue_id` int(10) unsigned NOT NULL,
  `dishes_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`catalogue_id`,`dishes_id`),
  KEY `dishes_catalogues_dishes_id_foreign` (`dishes_id`),
  CONSTRAINT `dishes_catalogues_catalogue_id_foreign` FOREIGN KEY (`catalogue_id`) REFERENCES `catalogues` (`id`) ON DELETE CASCADE,
  CONSTRAINT `dishes_catalogues_dishes_id_foreign` FOREIGN KEY (`dishes_id`) REFERENCES `dishes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catalogue_dishes`
--

LOCK TABLES `catalogue_dishes` WRITE;
/*!40000 ALTER TABLE `catalogue_dishes` DISABLE KEYS */;
INSERT INTO `catalogue_dishes` VALUES (1,1),(2,1),(2,2),(2,3),(1,4),(2,4),(2,5),(2,6),(2,7),(1,8),(2,8),(2,9),(5,10),(5,11),(6,12),(7,15),(8,16),(1,17),(2,17),(2,20),(2,21),(2,22),(2,23),(2,24),(2,25),(2,26),(2,27),(2,28),(2,29),(2,30),(2,31),(2,32),(6,33),(6,34),(6,35),(5,36),(5,37),(1,38),(5,38),(2,39),(2,40),(5,41),(5,42),(5,43),(5,44),(5,45),(5,46),(2,47),(2,48),(5,49),(2,50),(5,51),(2,52),(5,53),(6,54),(7,55),(7,56),(7,58),(7,59),(7,60),(7,62),(7,63);
/*!40000 ALTER TABLE `catalogue_dishes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `catalogues`
--

DROP TABLE IF EXISTS `catalogues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `catalogues` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ranking` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `catalogues_user_id_foreign` (`users_id`),
  KEY `catalogues_type_id_foreign` (`type_id`),
  CONSTRAINT `catalogues_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `catalogues_user_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catalogues`
--

LOCK TABLES `catalogues` WRITE;
/*!40000 ALTER TABLE `catalogues` DISABLE KEYS */;
INSERT INTO `catalogues` VALUES (1,1,2,'Pop Dishes',1,'popular dish','2016-03-11 10:44:54','2016-03-14 12:10:33'),(2,1,2,'noodles',2,'noodles dishes','2016-03-11 10:46:50','2017-01-06 09:05:59'),(5,1,2,'rice',3,'rice dishes','2017-01-06 09:28:43','2017-01-06 09:28:43'),(6,1,2,'soups',4,'Soups  DIshes','2017-01-06 09:50:16','2017-01-06 09:50:16'),(7,1,3,'snack&drinks',6,'snack and drinks ','2017-01-06 09:56:49','2017-01-09 23:41:26'),(8,1,3,'chips',5,'chips snack','2017-01-06 09:58:21','2017-01-09 23:41:19');
/*!40000 ALTER TABLE `catalogues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dishes`
--

DROP TABLE IF EXISTS `dishes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dishes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mgroup_id` int(10) unsigned NOT NULL,
  `number` int(11) NOT NULL,
  `ranking` int(11) DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `consumptionpoint` double(8,2) NOT NULL,
  `photo_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo_thumbnail_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valid` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dishes_number_unique` (`number`),
  KEY `dishes_mgroup_id_foreign` (`mgroup_id`),
  CONSTRAINT `dishes_mgroup_id_foreign` FOREIGN KEY (`mgroup_id`) REFERENCES `mgroups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dishes`
--

LOCK TABLES `dishes` WRITE;
/*!40000 ALTER TABLE `dishes` DISABLE KEYS */;
INSERT INTO `dishes` VALUES (1,'Satay Chicken',1,1,2,12.50,'Egg noodles with chicken and fresh vegetables in a satay sauce.',12.50,'bac27cdd10653a072c0dc76d8cb01da60ef2acf4.jpg','images/dish_photos/bac27cdd10653a072c0dc76d8cb01da60ef2acf4.jpg','images/dish_photos/tn-bac27cdd10653a072c0dc76d8cb01da60ef2acf4.jpg',1,'2016-01-28 01:34:44','2017-01-23 19:42:29'),(2,'Hokkien Mee',1,2,3,12.50,'Egg noodles with roast pork, shrimp, bean sprouts, onion, bok choy & spring onions in a dark soy & mild chilli sauce.',12.50,'2b421c30acb67e32298f17f402cd61c1ea283478.jpg','images/dish_photos/2b421c30acb67e32298f17f402cd61c1ea283478.jpg','images/dish_photos/tn-2b421c30acb67e32298f17f402cd61c1ea283478.jpg',1,'2016-01-28 01:43:40','2017-01-23 19:42:40'),(3,'Fried Kuai Teow',1,3,3,12.50,'Thick rice noodles with roast pork, shrimp, bean sprouts, onions, carrots, spring onions in a dark soy and chili sauce. ',12.50,'2f66a09ec0f04081b78a2c0142f4a74fa56b90eb.jpg','images/dish_photos/2f66a09ec0f04081b78a2c0142f4a74fa56b90eb.jpg','images/dish_photos/tn-2f66a09ec0f04081b78a2c0142f4a74fa56b90eb.jpg',1,'2016-01-28 01:47:44','2017-01-23 19:42:55'),(4,'Combination Noodles',1,4,5,13.00,'Egg noodles with prawn, beef, pork and chicken served with fresh and crispy vegetables in an oyster sauce.',13.00,'1d2fc119691c31f269f2aee4a5246b52c312c48e.jpg','images/dish_photos/1d2fc119691c31f269f2aee4a5246b52c312c48e.jpg','images/dish_photos/tn-1d2fc119691c31f269f2aee4a5246b52c312c48e.jpg',1,'2016-01-28 01:49:00','2017-01-23 19:43:23'),(5,'Black Bean Beef',1,5,6,12.50,'Egg noodles with beef and fresh vegetables in a popular black bean sauce.',12.50,'d16d059c9451f6b92d46c388546bcac7f1c8aec7.jpg','images/dish_photos/d16d059c9451f6b92d46c388546bcac7f1c8aec7.jpg','images/dish_photos/tn-d16d059c9451f6b92d46c388546bcac7f1c8aec7.jpg',1,'2016-01-28 01:49:54','2017-01-23 19:43:36'),(6,'Singapore Fried Noodles',1,6,7,12.50,'Thin rice noodles with roast pork, shrimp, bean sprouts, onions, carrots and spring onions in a light curry sauce.',12.50,'8b51c0123a0c6037fcbb849005d1a6f24c22f4d2.jpg','images/dish_photos/8b51c0123a0c6037fcbb849005d1a6f24c22f4d2.jpg','images/dish_photos/tn-8b51c0123a0c6037fcbb849005d1a6f24c22f4d2.jpg',1,'2016-01-28 01:51:04','2017-01-23 19:43:59'),(7,'Sweet Box',1,7,8,12.50,'Egg noodles with roast pork, chicken, beef, pineapple, tomato and fresh vegetables in a special sweet sauce.',12.50,'e83a85b15e882e2c83cc0a8c54a8564a9a5e91bc.jpg','images/dish_photos/e83a85b15e882e2c83cc0a8c54a8564a9a5e91bc.jpg','images/dish_photos/tn-e83a85b15e882e2c83cc0a8c54a8564a9a5e91bc.jpg',1,'2016-01-28 01:52:17','2016-01-28 01:52:17'),(8,'Hot Box',1,8,9,12.50,'Egg noodles with roast pork, chicken, beef and fresh vegetables in a Thai chili sauce.',12.50,'2b7e64ce30f773caebda89a9837cc966fc4bf4fc.jpg','images/dish_photos/2b7e64ce30f773caebda89a9837cc966fc4bf4fc.jpg','images/dish_photos/tn-2b7e64ce30f773caebda89a9837cc966fc4bf4fc.jpg',1,'2016-01-28 01:55:32','2017-01-23 19:44:19'),(9,'Teriyaki',1,9,9,12.50,'Udon noodles with chicken, onion, bean sprouts, carrots, spring onion and bok choy in a Japanese Teriyaki sauce.',12.50,'660a6df79dc45d5a4bf75e03bd9b0e9cc0701373.jpg','images/dish_photos/660a6df79dc45d5a4bf75e03bd9b0e9cc0701373.jpg','images/dish_photos/tn-660a6df79dc45d5a4bf75e03bd9b0e9cc0701373.jpg',1,'2016-03-14 12:13:06','2017-01-23 19:44:36'),(10,'Special Fried Rice',2,28,28,12.50,'Traditional fried rice comprising of shrimp, roast pork, bean sprouts, onions, carrots, spring onions and peas.',12.50,'65e1c65ba34243b3e35a8da089c8c56b6dbf0409.jpg','images/dish_photos/65e1c65ba34243b3e35a8da089c8c56b6dbf0409.jpg','images/dish_photos/tn-65e1c65ba34243b3e35a8da089c8c56b6dbf0409.jpg',1,'2017-01-06 09:48:55','2017-01-06 09:48:55'),(11,'Sambal Fried Rice',1,29,29,12.50,'Malaysian style fried rice with chicken, bean sprouts, onions, carrots, spring onions and peas in a Sambal sauce.',12.50,'d51b779a68df720d544b3050eeb7e219ca89d986.jpg','images/dish_photos/d51b779a68df720d544b3050eeb7e219ca89d986.jpg','images/dish_photos/tn-d51b779a68df720d544b3050eeb7e219ca89d986.jpg',1,'2017-01-06 09:49:46','2017-01-07 11:11:08'),(12,'Vegetarian Soup',3,24,24,11.50,'Egg noodles with tofu, mushrooms and fresh vegetables served in a soup.',11.50,'f9b566982da5d1c64d61de103629505ba7907596.jpg','images/dish_photos/f9b566982da5d1c64d61de103629505ba7907596.jpg','images/dish_photos/tn-f9b566982da5d1c64d61de103629505ba7907596.jpg',1,'2017-01-06 09:51:19','2017-02-14 04:48:53'),(15,'Coco Cola Can',3,88,1,2.50,'Coca Cola Can',2.50,'ce89e2ef55b4fb07bcb68faeefec0ea1880d4c23.jpg','images/dish_photos/ce89e2ef55b4fb07bcb68faeefec0ea1880d4c23.jpg','images/dish_photos/tn-ce89e2ef55b4fb07bcb68faeefec0ea1880d4c23.jpg',1,'2017-01-06 10:00:21','2017-01-23 19:44:49'),(16,'chips',3,89,89,4.50,'They are salty and tangy at the same time. You can definitely season them with your favorite spices before serving. ',4.50,'72ffc036fc628fd15e9fa8148597e2ba5cf6c95a.jpg','images/dish_photos/72ffc036fc628fd15e9fa8148597e2ba5cf6c95a.jpg','images/dish_photos/tn-72ffc036fc628fd15e9fa8148597e2ba5cf6c95a.jpg',1,'2017-01-06 10:14:02','2017-01-19 08:48:28'),(17,'Seafood Mee Goreng',1,10,10,14.00,'Egg noodles with prawns, calamari, fish cakes, crab meat, tofu and fresh vegetables in an Indonesian style sauce.',14.00,'0f4b0aaf7dc980249acfec6b64da050d6e6713fb.jpg','images/dish_photos/0f4b0aaf7dc980249acfec6b64da050d6e6713fb.jpg','images/dish_photos/tn-0f4b0aaf7dc980249acfec6b64da050d6e6713fb.jpg',1,'2017-01-07 11:09:08','2017-01-07 11:09:08'),(20,'Thai Sweet Chilli Beef',1,11,11,12.50,'Egg noodles with beef and fresh vegetables in a sweet Thai chili sauce',12.50,'d1d69564fb2586cac84197c4ad3c2d8753295b8a.jpg','images/dish_photos/d1d69564fb2586cac84197c4ad3c2d8753295b8a.jpg','images/dish_photos/tn-d1d69564fb2586cac84197c4ad3c2d8753295b8a.jpg',1,'2017-01-07 11:11:12','2017-01-07 11:11:12'),(21,'Sambal Chicken',1,12,12,12.50,'Thin rice noodles with chicken and vegetables in a Malaysian Sambal sauce.',12.50,'15abef70f78cafbb234e355f21e19f7fb4ff49e9.jpg','images/dish_photos/15abef70f78cafbb234e355f21e19f7fb4ff49e9.jpg','images/dish_photos/tn-15abef70f78cafbb234e355f21e19f7fb4ff49e9.jpg',1,'2017-01-07 11:15:01','2017-01-07 11:15:01'),(22,'Mongolian Beef',1,13,13,12.50,'Mongolian Beef',12.50,'0eb547ad415cdf3c48e9887cad4223c389920080.jpg','images/dish_photos/0eb547ad415cdf3c48e9887cad4223c389920080.jpg','images/dish_photos/tn-0eb547ad415cdf3c48e9887cad4223c389920080.jpg',1,'2017-01-07 11:16:12','2017-01-07 11:16:12'),(23,'Thai Curry Chicken',1,14,14,12.50,'Thin rice noodles with chicken, tomato and fresh vegetables in a spicy Thai curry sauce.',12.50,'1f0ff4d73961d51809e1009f1e0386303056c854.jpg','images/dish_photos/1f0ff4d73961d51809e1009f1e0386303056c854.jpg','images/dish_photos/tn-1f0ff4d73961d51809e1009f1e0386303056c854.jpg',1,'2017-01-07 11:17:15','2017-01-07 11:17:15'),(24,'BBQ Pork',1,15,15,12.50,'Egg noodles with roast pork, tomato and fresh vegetables in a Chinese barbeque sauce.',12.50,'dbf7ef33acecf7da593a31d67fe578484e994fe6.jpg','images/dish_photos/dbf7ef33acecf7da593a31d67fe578484e994fe6.jpg','images/dish_photos/tn-dbf7ef33acecf7da593a31d67fe578484e994fe6.jpg',1,'2017-01-07 11:18:24','2017-01-07 11:18:24'),(25,'Garlic Prawns',1,16,16,15.00,'Egg noodles with king prawns and fresh vegetables in a delicious garlic sauce.',15.00,'403e9c17dfeabd74b74b82ae56a2d5c62e9ff1f9.jpg','images/dish_photos/403e9c17dfeabd74b74b82ae56a2d5c62e9ff1f9.jpg','images/dish_photos/tn-403e9c17dfeabd74b74b82ae56a2d5c62e9ff1f9.jpg',1,'2017-01-07 11:19:17','2017-01-07 11:19:17'),(26,'Honey Chicken Noodles',1,17,17,12.50,'Battered chicken in honey with wok tossed noodles and vegetables.',12.50,'d47e320ec151c7ce94dc476ace658dce7ef8fb2a.jpg','images/dish_photos/d47e320ec151c7ce94dc476ace658dce7ef8fb2a.jpg','images/dish_photos/tn-d47e320ec151c7ce94dc476ace658dce7ef8fb2a.jpg',1,'2017-01-07 11:19:59','2017-01-07 11:19:59'),(27,'Chilli Beef',1,18,18,12.50,'Egg noodles with beef, fresh vegetables in a chili sauce.',12.50,'aef82fba1cfae570df967149945445436fd30243.jpg','images/dish_photos/aef82fba1cfae570df967149945445436fd30243.jpg','images/dish_photos/tn-aef82fba1cfae570df967149945445436fd30243.jpg',1,'2017-01-07 11:20:39','2017-01-07 11:20:39'),(28,'Seafood Combination Noodles',1,19,19,14.00,'Egg noodle with prawns, calamari, fish cakes, crab meat and fresh vegetables in an oyster sauce.',14.00,'7a1f06a54ad168361960fce1b06f2115bc245320.jpg','images/dish_photos/7a1f06a54ad168361960fce1b06f2115bc245320.jpg','images/dish_photos/tn-7a1f06a54ad168361960fce1b06f2115bc245320.jpg',1,'2017-01-07 11:21:33','2017-01-07 11:21:33'),(29,'Chicken Chow Mee',1,20,20,12.50,'Egg noodles with chicken and fresh vegetables in a hot wok sizzling oyster sauce. ',12.50,'c263540109f3b00334ce84cb5b5e213040da2f11.jpg','images/dish_photos/c263540109f3b00334ce84cb5b5e213040da2f11.jpg','images/dish_photos/tn-c263540109f3b00334ce84cb5b5e213040da2f11.jpg',1,'2017-01-07 11:22:17','2017-01-07 11:22:17'),(30,'Vegetarian Soy Noodles',1,21,21,11.50,'Egg noodles mixed with tofu, mushrooms and fresh vegetables in a dark soy sauce.',11.50,'f43afc0041056900db6aaa1738989c7fb213afd7.jpg','images/dish_photos/f43afc0041056900db6aaa1738989c7fb213afd7.jpg','images/dish_photos/tn-f43afc0041056900db6aaa1738989c7fb213afd7.jpg',1,'2017-01-07 23:49:38','2017-01-07 23:49:38'),(31,'Vegetarian Mee Goreng',1,22,22,11.50,'Egg noodles with tofu, mushrooms, tomato and fresh vegetables in an Indonesian style sauce.',11.50,'1a7953920e4bab3e804bcd4d44288fc8c887f6cc.jpg','images/dish_photos/1a7953920e4bab3e804bcd4d44288fc8c887f6cc.jpg','images/dish_photos/tn-1a7953920e4bab3e804bcd4d44288fc8c887f6cc.jpg',1,'2017-01-07 23:50:24','2017-01-07 23:50:24'),(32,'Vegetarian Singapore Noodles',1,23,23,11.50,'Thin rice noodles mixed with tofu, mushrooms and fresh vegetables in a light curry sauce.',11.50,'841cf9b1ce1bd7ab53cbca1cedf009c00e09dade.jpg','images/dish_photos/841cf9b1ce1bd7ab53cbca1cedf009c00e09dade.jpg','images/dish_photos/tn-841cf9b1ce1bd7ab53cbca1cedf009c00e09dade.jpg',1,'2017-01-07 23:51:17','2017-01-07 23:51:17'),(33,'Combination Soup',3,25,25,13.00,'Egg noodles with prawns, beef, pork and chicken served with fresh vegetables in a chicken soup.',13.00,'d2d7ca7372ddc19a1032fc74a8e83a4e89a5b3a8.jpg','images/dish_photos/d2d7ca7372ddc19a1032fc74a8e83a4e89a5b3a8.jpg','images/dish_photos/tn-d2d7ca7372ddc19a1032fc74a8e83a4e89a5b3a8.jpg',1,'2017-01-07 23:52:40','2017-01-22 22:25:59'),(34,'Curry Laksa',3,26,26,12.50,'Egg noodles with prawns, crab meat, chicken, tofu and fresh vegetables in a coconut curry soup.',12.50,'15ddac0b93eb3c9dbe14a0d7d21c922dbdc8ad67.jpg','images/dish_photos/15ddac0b93eb3c9dbe14a0d7d21c922dbdc8ad67.jpg','images/dish_photos/tn-15ddac0b93eb3c9dbe14a0d7d21c922dbdc8ad67.jpg',1,'2017-01-07 23:53:30','2017-01-22 22:25:44'),(35,'Tom Yum',3,27,27,11.50,'Rice noodles with chicken, tomato, pineapple and fresh vegetables in a Thai hot and sour soup.',11.50,'e07e5e678230a37ea7fd652f2d5acf60552b938e.jpg','images/dish_photos/e07e5e678230a37ea7fd652f2d5acf60552b938e.jpg','images/dish_photos/tn-e07e5e678230a37ea7fd652f2d5acf60552b938e.jpg',1,'2017-01-07 23:54:07','2017-01-22 22:26:30'),(36,'Nasi Goreng',1,30,30,12.50,'Malaysian style fried rice with roast pork, bean sprouts, onions, carrots and peas.',12.50,'8a00ad18511d7a7593a7bf9b147abf778f64536e.jpg','images/dish_photos/8a00ad18511d7a7593a7bf9b147abf778f64536e.jpg','images/dish_photos/tn-8a00ad18511d7a7593a7bf9b147abf778f64536e.jpg',1,'2017-01-07 23:55:20','2017-01-07 23:55:20'),(37,'Seafood Nasi Goreng',1,31,31,14.00,'Malaysian style fried rice with a combination of seafood, beans sprouts, onions, carrots, spring onions and peas.',14.00,'0c3872fa3c315d1600e6316c9dc79d0e3601aaf3.jpg','images/dish_photos/0c3872fa3c315d1600e6316c9dc79d0e3601aaf3.jpg','images/dish_photos/tn-0c3872fa3c315d1600e6316c9dc79d0e3601aaf3.jpg',1,'2017-01-07 23:56:00','2017-01-07 23:56:00'),(38,'Honey Chicken Fried Rice',2,32,32,12.50,'Battered chicken in a honey sauce with wok tossed fried rice and vegetables.',12.50,'7bb5c354f2bdb2c2a4b66b11069bdc77e213bade.jpg','images/dish_photos/7bb5c354f2bdb2c2a4b66b11069bdc77e213bade.jpg','images/dish_photos/tn-7bb5c354f2bdb2c2a4b66b11069bdc77e213bade.jpg',1,'2017-01-07 23:56:45','2017-01-22 22:27:16'),(39,'Cachew Chicken Chow Mee',1,34,34,13.00,'Egg noodles with chicken and cashew and fresh vegetables in a hot wok sizzling oyster sauce. ',13.00,'bef562f9f9a7f2f0fe2a692d912d48c625682980.jpg','images/dish_photos/bef562f9f9a7f2f0fe2a692d912d48c625682980.jpg','images/dish_photos/tn-bef562f9f9a7f2f0fe2a692d912d48c625682980.jpg',1,'2017-02-11 15:59:10','2017-02-12 05:00:50'),(40,'Canteen Noodle',1,33,33,13.00,'Udon noodle with king prawns, chicken veges in hot sizzling canteen sauce.',13.00,'94e5087c25a6d9cf5ff3a57e623a3e7603f13901.jpg','images/dish_photos/94e5087c25a6d9cf5ff3a57e623a3e7603f13901.jpg','images/dish_photos/tn-94e5087c25a6d9cf5ff3a57e623a3e7603f13901.jpg',1,'2017-02-12 05:37:41','2017-02-12 05:37:41'),(41,'Combination Fired Rice',2,35,35,13.00,'Traditional rice dish with prawns, beef, pork and chicken served with fresh and crispy veges.',13.00,'2d72cedeb7b737835c5cdb2fa6f6a3f43150950a.jpg','images/dish_photos/2d72cedeb7b737835c5cdb2fa6f6a3f43150950a.jpg','images/dish_photos/tn-2d72cedeb7b737835c5cdb2fa6f6a3f43150950a.jpg',1,'2017-02-12 05:47:08','2017-02-12 05:47:08'),(42,'Malaysia Fired Rice',2,36,36,12.50,'Traditional rice dish comprising pork and shrimps, onion, carrots and peas.',12.50,'934e3850eeb473020fa3dcb75d4d4d86734db063.jpg','images/dish_photos/934e3850eeb473020fa3dcb75d4d4d86734db063.jpg','images/dish_photos/tn-934e3850eeb473020fa3dcb75d4d4d86734db063.jpg',1,'2017-02-12 05:50:28','2017-02-12 15:07:37'),(43,'Chicken Fried Rice',2,37,37,12.50,'Traditional rice dish with chicken, onion, carrots and peas.',12.50,'51024bb24eb23bc389bd2d9a07bb1eb168eca539.jpg','images/dish_photos/51024bb24eb23bc389bd2d9a07bb1eb168eca539.jpg','images/dish_photos/tn-51024bb24eb23bc389bd2d9a07bb1eb168eca539.jpg',1,'2017-02-12 14:43:58','2017-02-17 05:02:01'),(44,'Vegetable Fired Rice',2,39,39,11.50,'Tranditional rice with onion, broccoli, carrots, muchroom, baby corns and peas.',11.50,'015edc4026afa8cc07370a96bf0e257eee9eec72.jpg','images/dish_photos/015edc4026afa8cc07370a96bf0e257eee9eec72.jpg','images/dish_photos/tn-015edc4026afa8cc07370a96bf0e257eee9eec72.jpg',1,'2017-02-12 15:05:28','2017-02-17 04:59:58'),(45,'King Prawns Fried Rice',1,38,38,15.00,'Tranditional rice dish comprising king prawns, shrimps, onion, carrot and peas.',15.00,'8d51acae6bfede48ccc970bf83cd9fee159e36f0.jpg','images/dish_photos/8d51acae6bfede48ccc970bf83cd9fee159e36f0.jpg','images/dish_photos/tn-8d51acae6bfede48ccc970bf83cd9fee159e36f0.jpg',1,'2017-02-12 15:09:21','2017-02-12 15:09:21'),(46,'Shrimps Fried Rice',2,50,50,13.00,'Tranditional rice dish comprising king  shrimps, onion, carrot and peas.',13.00,'eba3557ff93f9ca23eb834c74676236815897a40.jpg','images/dish_photos/eba3557ff93f9ca23eb834c74676236815897a40.jpg','images/dish_photos/tn-eba3557ff93f9ca23eb834c74676236815897a40.jpg',1,'2017-02-12 15:19:20','2017-02-12 15:19:20'),(47,'XO udon',1,48,48,14.00,'Seafood in XO sauce with wok toss udon noodle and fresh vegs.',14.00,'18c8c164fcfd7b02d7fc7e9f729d856f7a213e05.jpg','images/dish_photos/18c8c164fcfd7b02d7fc7e9f729d856f7a213e05.jpg','images/dish_photos/tn-18c8c164fcfd7b02d7fc7e9f729d856f7a213e05.jpg',1,'2017-02-17 04:56:58','2017-02-17 04:56:58'),(48,'Sweet Chilli Chicken Noodles',1,47,47,12.50,'Batter chicken in original sweet chilli sauce with wok toss noodle and veges',12.50,'9405cb5044ff9effdd3c3c5eadda7454e0919ba2.jpg','images/dish_photos/9405cb5044ff9effdd3c3c5eadda7454e0919ba2.jpg','images/dish_photos/tn-9405cb5044ff9effdd3c3c5eadda7454e0919ba2.jpg',1,'2017-02-17 04:58:28','2017-02-17 04:58:28'),(49,'Sweet Chilli Chicken Fried Rice',2,49,49,12.50,'Batter chicken in original sweet chilli sauce with fried rice and fresh veg',12.50,'1a5ef69e9da3f780e12d7fe5d375fe42add284a4.jpg','images/dish_photos/1a5ef69e9da3f780e12d7fe5d375fe42add284a4.jpg','images/dish_photos/tn-1a5ef69e9da3f780e12d7fe5d375fe42add284a4.jpg',1,'2017-02-17 05:01:19','2017-02-17 05:01:47'),(50,'Honey King Prawns Noodles',1,40,40,15.00,'Batter prawns in honey sauce with wok toss noodle and veges',15.00,'61e2b0d68f5b400925f0129707201dc4bfe1e710.jpg','images/dish_photos/61e2b0d68f5b400925f0129707201dc4bfe1e710.jpg','images/dish_photos/tn-61e2b0d68f5b400925f0129707201dc4bfe1e710.jpg',1,'2017-02-17 05:30:37','2017-02-17 05:30:37'),(51,'Honey King prawns Fried Rice',2,41,41,15.00,'Batter prawns in honey sauce with wok toss fried rice and veges',15.00,'f255e4640f156430657e75e00dcbd52fae6a457b.jpg','images/dish_photos/f255e4640f156430657e75e00dcbd52fae6a457b.jpg','images/dish_photos/tn-f255e4640f156430657e75e00dcbd52fae6a457b.jpg',1,'2017-02-17 05:31:47','2017-02-17 05:31:47'),(52,'Seet Sour Pork Noodles',1,42,42,12.50,'Batter Pork in original sweet sour sauce with Noodles and fresh veges',12.50,'62569aecd82b108b62b1d7f363aa0f72707a082b.jpg','images/dish_photos/62569aecd82b108b62b1d7f363aa0f72707a082b.jpg','images/dish_photos/tn-62569aecd82b108b62b1d7f363aa0f72707a082b.jpg',1,'2017-02-20 19:35:18','2017-02-20 19:35:18'),(53,'Seet Sour Pork Fried Rice',2,43,43,12.50,'Batter Pork in original sweet sour sauce with Fried Rice and fresh veges',12.50,'970fb6de0bb568b497f7f551cd03605090a72c6e.jpg','images/dish_photos/970fb6de0bb568b497f7f551cd03605090a72c6e.jpg','images/dish_photos/tn-970fb6de0bb568b497f7f551cd03605090a72c6e.jpg',1,'2017-02-20 19:36:29','2017-02-20 19:36:29'),(54,'Wonton Soups',3,51,51,13.00,'Egg noodles with BBQ pork served with fresh vegetables in a wonton soup.',13.00,'3df6f373c535141e92bf0b77afec9830a0323e92.jpg','images/dish_photos/3df6f373c535141e92bf0b77afec9830a0323e92.jpg','images/dish_photos/tn-3df6f373c535141e92bf0b77afec9830a0323e92.jpg',1,'2017-02-20 21:10:26','2017-02-20 21:10:26'),(55,'Half Dozen Deep Wontons',3,52,52,4.50,'Made of prawns, pork, flour, egg, water, and salt with sweet sour sauce.',4.50,'09d0740736b50ca4f97b80c546c2e62cb1cdcbc7.jpg','images/dish_photos/09d0740736b50ca4f97b80c546c2e62cb1cdcbc7.jpg','images/dish_photos/tn-09d0740736b50ca4f97b80c546c2e62cb1cdcbc7.jpg',1,'2017-02-20 21:34:50','2017-02-20 21:37:54'),(56,'Dozen Deep Wontons',3,53,53,9.00,'Made of prawns, pork, flour, egg, water, and salt with sweet sour sauce.',9.00,'9b29d5b6494bc1c4a91b1d0ecabfba142e1f7b39.jpg','images/dish_photos/9b29d5b6494bc1c4a91b1d0ecabfba142e1f7b39.jpg','images/dish_photos/tn-9b29d5b6494bc1c4a91b1d0ecabfba142e1f7b39.jpg',1,'2017-02-20 21:35:52','2017-02-20 21:37:10'),(58,'Coco Cola 425ml',3,90,90,4.20,'Coco Cola 425ml',4.20,'dfe72851280c2172881e1807227411da92d95657.jpg','images/dish_photos/dfe72851280c2172881e1807227411da92d95657.jpg','images/dish_photos/tn-dfe72851280c2172881e1807227411da92d95657.jpg',1,'2017-02-21 00:07:01','2017-02-21 00:07:01'),(59,'Coco Cola 1.5L',3,91,91,4.20,'Coco Cola 1.5 liter',4.20,'c535af852722d94c2175d7342ec407ce96e8021a.jpg','images/dish_photos/c535af852722d94c2175d7342ec407ce96e8021a.jpg','images/dish_photos/tn-c535af852722d94c2175d7342ec407ce96e8021a.jpg',1,'2017-02-21 00:08:40','2017-02-21 00:08:40'),(60,'L&P 425ml',3,92,92,4.20,'L&P 425ml',4.20,'2108209bda04b269c2a3f18cf762924265f74b5e.jpg','images/dish_photos/2108209bda04b269c2a3f18cf762924265f74b5e.jpg','images/dish_photos/tn-2108209bda04b269c2a3f18cf762924265f74b5e.jpg',1,'2017-02-21 00:13:18','2017-02-21 00:13:18'),(61,'L&P 1.5L',3,93,93,4.20,'L&P 1.5L',4.20,'f900cf61224d42c39665b50f2ec16fb46c00388b.png','images/dish_photos/f900cf61224d42c39665b50f2ec16fb46c00388b.png','images/dish_photos/tn-f900cf61224d42c39665b50f2ec16fb46c00388b.png',1,'2017-02-21 00:13:49','2017-02-21 00:13:49'),(62,'Coco Cola Zero 425ml',3,94,94,4.20,'Coco Cola Zero 425ml',4.20,'f20de612236934cda437cac1f9e0accb3741b19b.jpg','images/dish_photos/f20de612236934cda437cac1f9e0accb3741b19b.jpg','images/dish_photos/tn-f20de612236934cda437cac1f9e0accb3741b19b.jpg',1,'2017-02-21 00:53:02','2017-02-21 00:53:02'),(63,'Coco Cola Zero 1.5L',3,95,95,4.20,'Coco Cola Zero 1.5L',4.20,'e849b26cdd74adb44694f709308fbd8be0a49301.jpg','images/dish_photos/e849b26cdd74adb44694f709308fbd8be0a49301.jpg','images/dish_photos/tn-e849b26cdd74adb44694f709308fbd8be0a49301.jpg',1,'2017-02-21 00:53:43','2017-02-21 00:53:43');
/*!40000 ALTER TABLE `dishes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dishes_material`
--

DROP TABLE IF EXISTS `dishes_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dishes_material` (
  `material_id` int(10) unsigned NOT NULL,
  `dishes_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`material_id`,`dishes_id`),
  KEY `dishes_material_dishes_id_foreign` (`dishes_id`),
  CONSTRAINT `dishes_material_dishes_id_foreign` FOREIGN KEY (`dishes_id`) REFERENCES `dishes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `dishes_material_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dishes_material`
--

LOCK TABLES `dishes_material` WRITE;
/*!40000 ALTER TABLE `dishes_material` DISABLE KEYS */;
INSERT INTO `dishes_material` VALUES (14,1),(22,1),(23,1),(5,2),(16,2),(22,2),(23,2),(5,3),(16,3),(22,3),(23,3),(5,4),(13,4),(14,4),(22,4),(23,4),(13,5),(22,5),(23,5),(5,6),(16,6),(22,6),(23,6),(5,7),(11,7),(13,7),(14,7),(22,7),(23,7),(5,8),(13,8),(14,8),(22,8),(23,8),(14,9),(22,9),(23,9),(5,10),(16,10),(14,11),(2,12),(3,12),(6,12),(7,12),(8,12),(9,12),(12,12),(22,12),(12,17),(15,17),(16,17),(17,17),(18,17),(22,17),(23,17),(13,20),(22,20),(23,20),(14,21),(22,21),(23,21),(13,22),(22,22),(23,22),(14,23),(22,23),(23,23),(5,24),(22,24),(23,24),(8,25),(9,25),(15,25),(16,25),(22,25),(23,25),(19,26),(22,26),(23,26),(13,27),(22,27),(23,27),(8,28),(9,28),(15,28),(16,28),(17,28),(18,28),(22,28),(23,28),(14,29),(22,29),(23,29),(8,30),(9,30),(12,30),(22,30),(8,31),(9,31),(12,31),(8,32),(9,32),(12,32),(22,32),(2,33),(3,33),(5,33),(6,33),(7,33),(8,33),(9,33),(13,33),(14,33),(15,33),(22,33),(2,34),(3,34),(6,34),(7,34),(12,34),(14,34),(15,34),(17,34),(22,34),(2,35),(3,35),(6,35),(7,35),(11,35),(14,35),(22,35),(5,36),(15,37),(16,37),(17,37),(18,37),(19,38),(9,39),(14,39),(14,40),(15,40),(22,40),(23,40),(5,41),(13,41),(14,41),(15,41),(5,42),(8,42),(16,42),(14,43),(6,44),(8,44),(9,44),(15,45),(16,45),(16,46),(15,47),(16,47),(17,47),(18,47),(25,48),(25,49),(21,50),(21,51),(20,52),(22,52),(20,53),(3,54),(5,54),(6,54),(26,54),(26,55),(26,56);
/*!40000 ALTER TABLE `dishes_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material_mgroup`
--

DROP TABLE IF EXISTS `material_mgroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `material_mgroup` (
  `mgroup_id` int(10) unsigned NOT NULL,
  `material_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`mgroup_id`,`material_id`),
  KEY `material_mgroup_material_id_foreign` (`material_id`),
  CONSTRAINT `material_mgroup_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE,
  CONSTRAINT `material_mgroup_mgroup_id_foreign` FOREIGN KEY (`mgroup_id`) REFERENCES `mgroups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material_mgroup`
--

LOCK TABLES `material_mgroup` WRITE;
/*!40000 ALTER TABLE `material_mgroup` DISABLE KEYS */;
INSERT INTO `material_mgroup` VALUES (1,1),(2,1),(1,2),(2,2),(1,3),(2,3),(1,6),(1,7),(2,7),(2,10);
/*!40000 ALTER TABLE `material_mgroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material_orderitems`
--

DROP TABLE IF EXISTS `material_orderitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `material_orderitems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderitems_id` int(10) unsigned NOT NULL,
  `material_id` int(10) unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `material_orderitems_orderitems_id_foreign` (`orderitems_id`),
  KEY `material_orderitems_material_id_foreign` (`material_id`),
  CONSTRAINT `material_orderitems_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE,
  CONSTRAINT `material_orderitems_orderitems_id_foreign` FOREIGN KEY (`orderitems_id`) REFERENCES `orderitems` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material_orderitems`
--

LOCK TABLES `material_orderitems` WRITE;
/*!40000 ALTER TABLE `material_orderitems` DISABLE KEYS */;
INSERT INTO `material_orderitems` VALUES (1,2,1,'takeout',0.00),(2,2,5,'extra',3.00),(3,3,2,'takeout',0.00),(4,4,1,'takeout',0.00),(5,13,7,'takeout',0.00),(6,13,5,'extra',3.00),(7,14,7,'takeout',0.00),(8,14,13,'extra',3.00),(9,29,2,'takeout',0.00);
/*!40000 ALTER TABLE `material_orderitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material_types`
--

DROP TABLE IF EXISTS `material_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `material_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material_types`
--

LOCK TABLES `material_types` WRITE;
/*!40000 ALTER TABLE `material_types` DISABLE KEYS */;
INSERT INTO `material_types` VALUES (2,'Veges','Veges for dish','2016-03-11 10:06:49','2016-03-11 10:06:49'),(3,'Meat','Meat  for Noodle or Fired Rice','2016-03-11 10:23:50','2016-03-11 10:23:50'),(4,'Noodle','many kind of noodles','2017-02-14 14:56:04','2017-02-14 14:56:04');
/*!40000 ALTER TABLE `material_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materials`
--

DROP TABLE IF EXISTS `materials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `material_type_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `photo_thumbnail_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valid` tinyint(1) NOT NULL,
  `photo_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `materials_material_type_id_foreign` (`material_type_id`),
  CONSTRAINT `materials_material_type_id_foreign` FOREIGN KEY (`material_type_id`) REFERENCES `material_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materials`
--

LOCK TABLES `materials` WRITE;
/*!40000 ALTER TABLE `materials` DISABLE KEYS */;
INSERT INTO `materials` VALUES (1,2,'Onion','Flash Onion veges ',1.00,NULL,1,'',NULL,'2016-03-11 10:20:52','2017-02-14 15:18:12'),(2,2,'Cabbage','Flash Cabbage',1.00,NULL,1,'',NULL,'2016-03-11 10:21:21','2017-02-14 15:18:26'),(3,2,'Bak Choy','Flash Bak Choy',1.00,NULL,1,'',NULL,'2016-03-11 10:22:01','2017-02-14 15:18:33'),(4,2,'Spring Onion','Flash Spring Onion',1.00,NULL,1,'',NULL,'2016-03-11 10:24:20','2017-02-14 15:18:53'),(5,3,'Pork','Nice tasted Roast Pork ',3.00,NULL,1,'',NULL,'2016-03-11 10:26:29','2016-03-11 10:26:29'),(6,2,'Broccoli','Flash broccoli',1.00,NULL,1,'',NULL,'2017-01-22 22:03:13','2017-01-22 22:03:13'),(7,2,'Carrot','Flash Carrot',1.00,NULL,1,'',NULL,'2017-01-22 22:03:38','2017-01-22 22:03:38'),(8,2,'Corn','Flash corn',1.00,NULL,1,'',NULL,'2017-01-22 22:04:35','2017-01-22 22:04:35'),(9,2,'Muchroom','Flash muchroom',1.00,NULL,1,'',NULL,'2017-01-22 22:04:56','2017-01-22 22:04:56'),(10,2,'Peas','Flash Peas',1.00,NULL,1,'',NULL,'2017-01-22 22:05:18','2017-01-22 22:05:18'),(11,2,'Pineapple','Flash pineapple',1.00,NULL,1,'',NULL,'2017-01-22 22:05:58','2017-01-22 22:05:58'),(12,2,'Tofu','Fired Tofu',1.00,NULL,1,'',NULL,'2017-01-22 22:06:32','2017-01-22 22:06:32'),(13,3,'Beef','Flash Beef ',3.00,NULL,1,'',NULL,'2017-01-22 22:07:03','2017-01-22 22:07:03'),(14,3,'Chicken','Flash chicken',3.00,NULL,1,'',NULL,'2017-01-22 22:07:22','2017-01-22 22:09:25'),(15,3,'Prawns','3.2 dollars for 4 prawns',3.20,NULL,1,'',NULL,'2017-01-22 22:08:25','2017-01-22 22:09:32'),(16,3,'Shrimps','Flash Shrimps ',3.00,NULL,1,'',NULL,'2017-01-22 22:08:55','2017-01-22 22:09:39'),(17,3,'Crab stick','Flash Crab stick',1.00,NULL,1,'',NULL,'2017-01-22 22:09:15','2017-01-22 22:10:18'),(18,3,'Fish ball','Flash fish ball',1.00,NULL,1,'',NULL,'2017-01-22 22:10:11','2017-01-22 22:10:26'),(19,3,'Honey Chicken','Batter Honey Chicken for 3 dollars',3.00,NULL,1,'',NULL,'2017-01-22 22:10:53','2017-01-22 22:12:21'),(20,3,'Sweet Sour Pork','Batter Sweet Sour Pork',3.00,NULL,1,'',NULL,'2017-01-22 22:11:36','2017-01-22 22:12:29'),(21,3,'Honey King Prawns','4 Batter Honey King Prawns for 5 dollars',5.00,NULL,1,'',NULL,'2017-01-22 22:13:17','2017-01-22 22:13:17'),(22,4,'Noodle','noodle for the meals',0.00,NULL,1,'',NULL,'2017-02-14 14:56:29','2017-02-14 14:58:53'),(23,4,'vegetable','Add no vegetables for customers',1.00,NULL,1,'',NULL,'2017-02-14 14:57:33','2017-02-14 15:19:10'),(24,2,'Extra Veges','extra veges',1.00,NULL,1,'',NULL,'2017-02-14 15:15:24','2017-02-14 15:15:24'),(25,3,'Sweet Chilli Chicken','Batter chicken with sweet chilli sauce',3.00,NULL,1,'',NULL,'2017-02-17 04:59:14','2017-02-17 04:59:14'),(26,3,'Wonton','6 Deep Fried  Wontons',4.50,NULL,1,'',NULL,'2017-02-20 21:11:27','2017-02-20 21:11:27');
/*!40000 ALTER TABLE `materials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgroups`
--

DROP TABLE IF EXISTS `mgroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mgroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgroups`
--

LOCK TABLES `mgroups` WRITE;
/*!40000 ALTER TABLE `mgroups` DISABLE KEYS */;
INSERT INTO `mgroups` VALUES (1,'Noodle Veges','Veges for Noodles','2016-03-11 10:22:50','2016-03-11 10:22:50'),(2,'FIred RIce ','Fired RIce Vegetable','2016-03-11 10:27:27','2016-03-11 10:27:27'),(3,'None','nothing else','2017-01-19 08:35:45','2017-01-19 08:35:45');
/*!40000 ALTER TABLE `mgroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2015_10_12_043003_create_roles_tables',1),('2015_10_16_215158_create_dishes_table',1),('2015_10_17_214136_add_extention_to_users_table',1),('2016_03_14_224756_create_orders_table',2),('2016_07_13_001322_add_cashier_columns',3),('2016_10_20_090911_add_orders_to_users',5),('2016_11_26_000244_create_shop_table',6),('2017_01_12_091631_create_orderitems_table',7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderitems`
--

DROP TABLE IF EXISTS `orderitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderitems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orders_id` int(10) unsigned NOT NULL,
  `dishes_id` int(10) unsigned NOT NULL,
  `flavour` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orderitems_orders_id_foreign` (`orders_id`),
  KEY `orderitems_dishes_id_foreign` (`dishes_id`),
  CONSTRAINT `orderitems_dishes_id_foreign` FOREIGN KEY (`dishes_id`) REFERENCES `dishes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orderitems_orders_id_foreign` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderitems`
--

LOCK TABLES `orderitems` WRITE;
/*!40000 ALTER TABLE `orderitems` DISABLE KEYS */;
INSERT INTO `orderitems` VALUES (1,323,5,'',1,12.00,12.00,'2017-01-21 08:09:10','2017-01-21 08:09:10'),(2,324,1,'',1,15.00,15.00,'2017-01-21 08:22:58','2017-01-21 08:22:58'),(3,324,4,'',1,12.80,12.80,'2017-01-21 08:22:58','2017-01-21 08:22:58'),(4,325,4,'',1,12.80,12.80,'2017-01-21 08:25:41','2017-01-21 08:25:41'),(5,325,5,'',1,12.00,12.00,'2017-01-21 08:25:41','2017-01-21 08:25:41'),(6,325,16,'',1,4.50,4.50,'2017-01-21 08:25:41','2017-01-21 08:25:41'),(7,325,35,'',1,11.50,11.50,'2017-01-21 08:25:41','2017-01-21 08:25:41'),(8,325,34,'',1,12.50,12.50,'2017-01-21 08:25:41','2017-01-21 08:25:41'),(9,326,5,'',3,12.00,36.00,'2017-01-21 10:04:54','2017-01-21 10:04:54'),(10,327,38,'',3,12.50,37.50,'2017-01-21 10:09:22','2017-01-21 10:09:22'),(11,328,5,'',3,12.00,36.00,'2017-01-21 10:12:09','2017-01-21 10:12:09'),(12,329,5,'',1,12.00,12.00,'2017-01-21 10:13:21','2017-01-21 10:13:21'),(13,330,5,'',3,15.00,45.00,'2017-01-23 04:21:47','2017-01-23 04:21:47'),(14,331,1,'',1,15.00,15.00,'2017-01-23 18:09:07','2017-01-23 18:09:07'),(15,332,4,'',2,12.80,25.60,'2017-01-23 19:31:35','2017-01-23 19:31:35'),(16,332,5,'',1,12.00,12.00,'2017-01-23 19:31:35','2017-01-23 19:31:35'),(17,333,38,'',1,12.50,12.50,'2017-01-24 03:27:19','2017-01-24 03:27:19'),(18,334,7,'',1,12.50,12.50,'2017-01-25 23:55:28','2017-01-25 23:55:28'),(19,334,26,'',1,12.50,12.50,'2017-01-25 23:55:28','2017-01-25 23:55:28'),(20,335,26,'',1,12.50,12.50,'2017-02-06 00:26:00','2017-02-06 00:26:00'),(21,335,1,'',1,12.50,12.50,'2017-02-06 00:26:00','2017-02-06 00:26:00'),(22,335,8,'',1,12.50,12.50,'2017-02-06 00:26:01','2017-02-06 00:26:01'),(23,336,1,'',1,12.50,12.50,'2017-02-07 22:19:15','2017-02-07 22:19:15'),(24,337,1,'',1,12.50,12.50,'2017-02-14 15:49:43','2017-02-14 15:49:43'),(25,338,39,'',1,13.00,13.00,'2017-02-14 15:55:03','2017-02-14 15:55:03'),(26,339,3,'',1,12.50,12.50,'2017-02-14 15:57:45','2017-02-14 15:57:45'),(27,340,6,'Mild',1,12.50,12.50,'2017-02-15 23:47:28','2017-02-15 23:47:28'),(28,340,8,'Hot',1,12.50,12.50,'2017-02-15 23:47:28','2017-02-15 23:47:28'),(29,341,1,'',1,12.50,12.50,'2017-02-18 22:24:01','2017-02-18 22:24:01'),(30,342,1,'Mild',1,12.50,12.50,'2017-02-18 22:51:24','2017-02-18 22:51:24');
/*!40000 ALTER TABLE `orderitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ordernumber` bigint(20) unsigned DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `totaldue` double(8,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `ordertype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phonenumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paymentflag` tinyint(1) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `paymentmethod_id` int(11) DEFAULT NULL,
  `paymenttime` datetime NOT NULL,
  `shiptime` datetime NOT NULL,
  `shipmethod` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userip` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `message` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=343 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (323,20170121662956,12.00,12.00,4,'pickup','Sam Cao','yeweicao@gmail.com','211751199','',1,1,1,'2017-01-21 08:09:10','2017-01-21 08:09:10','take away','192.168.10.1',NULL,'','2017-01-21 08:09:10','2017-01-21 08:24:10'),(324,20170121644935,27.80,27.80,4,'pickup','Sam Cao','yeweicao@gmail.com','211751199','',1,1,1,'2017-01-21 08:22:58','2017-01-21 08:22:58','take away','192.168.10.1',NULL,'testing ','2017-01-21 08:22:58','2017-01-21 08:24:10'),(325,20170121382379,53.30,54.30,4,'delivery','Sam Cao','yeweicao@gmail.com','211751199','',1,1,1,'2017-01-21 08:25:41','2017-01-21 09:00:00','take away','192.168.10.1',NULL,'second testing.','2017-01-21 08:25:41','2017-01-21 10:14:53'),(326,20170121893541,36.00,37.00,4,'delivery','Sam Cao','yeweicao@gmail.com','211751199','',1,1,1,'2017-01-21 10:04:54','2017-01-21 10:04:54','take away','192.168.10.1',NULL,'cash testing','2017-01-21 10:04:54','2017-01-21 10:14:53'),(327,20170121877434,37.50,37.50,4,'delivery','Sam Cao','yeweicao@gmail.com','211751199','',1,1,1,'2017-01-21 10:09:22','2017-01-21 10:09:22','take away','192.168.10.1',NULL,'','2017-01-21 10:09:22','2017-01-21 10:14:53'),(328,20170121974127,36.00,36.00,4,'delivery','Sam Cao','yeweicao@gmail.com','211751199','Gs4InwVhJoM4yyCzwpcNgBRfLaMnHu7I',2,1,2,'2017-01-21 10:12:53','2017-01-21 10:12:09','take away','192.168.10.1',NULL,NULL,'2017-01-21 10:12:09','2017-01-21 10:14:53'),(329,20170121668577,12.00,13.00,4,'delivery','Sam Cao','yeweicao@gmail.com','211751199','C98yHRTYwsedUvc2bYi0gJYxnHvdRWLv',2,1,2,'2017-01-21 10:13:46','2017-01-21 10:13:21','take away','192.168.10.1',NULL,NULL,'2017-01-21 10:13:21','2017-01-21 10:14:53'),(330,20170122408606,45.00,45.00,2,'delivery','Yewei Cao','yeweicao@gmail.com','211751199','',1,1,1,'2017-01-22 23:21:47','2017-01-23 09:15:00','take away','116.251.159.128',NULL,'testing from Sam','2017-01-23 04:21:47','2017-01-23 04:21:48'),(331,20170123671684,15.00,16.00,2,'delivery','Zhizhong','yeweicao@gmail.com','211751199','',1,1,1,'2017-01-23 13:09:06','2017-01-23 14:00:00','take away','116.251.159.128',NULL,'Zhingzhong huang order','2017-01-23 18:09:06','2017-01-23 18:09:08'),(332,20170123411643,37.60,43.60,2,'delivery','Sam Cao','yeweicao@gmail.com','211751199','',1,1,1,'2017-01-23 14:31:35','2017-01-23 14:31:35','take away','116.251.159.128',NULL,'other testing ','2017-01-23 19:31:35','2017-01-23 19:31:38'),(333,20170123916936,12.50,18.50,2,'delivery','Sam Cao','yeweicao@gmail.com','211751199','',1,1,1,'2017-01-23 22:27:19','2017-01-24 10:30:00','take away','116.251.159.128',NULL,'','2017-01-24 03:27:19','2017-01-24 03:27:20'),(334,20170125800495,25.00,25.00,4,'pickup','Nicole Barnes','nicolebarnes91@gmail.com','0220397123','',1,1,1,'2017-01-25 18:55:28','2017-01-25 18:55:28','take away','203.184.35.223',NULL,'','2017-01-25 23:55:28','2017-02-16 20:47:31'),(335,20170205538428,37.50,43.50,4,'delivery','Brett','brett.bower.9849@facebook.com','0278117564','A0ThKUp9eRTvBYZN4IwTF1L8X9r1nhP3',2,1,2,'2017-02-05 19:29:29','2017-02-05 19:26:00','take away','163.47.238.29',NULL,NULL,'2017-02-06 00:26:00','2017-02-16 20:47:31'),(336,20170207158109,12.50,12.50,2,'pickup','Brenna','bmae2468@gmail.com','0278670957','',1,1,1,'2017-02-07 17:19:15','2017-02-07 17:19:15','take away','121.72.1.152',NULL,'','2017-02-07 22:19:15','2017-02-07 22:19:16'),(337,20170214996979,12.50,12.50,2,'pickup','Nigel Cowan','nigel.cowan@merco.co.nz','021905088','yS5Kltz08woZLhJvFfL42p35qjXiMQ7M',2,1,2,'2017-02-14 10:52:15','2017-02-14 17:00:00','take away','49.226.156.254',NULL,NULL,'2017-02-14 15:49:42','2017-02-14 15:52:16'),(338,20170214723984,13.00,13.00,1,'pickup','Nigel Cowan','nigel.cowan@merco.co.nz','021905088','n719pJXu7VI0j134vORVwJIQE5GCyiFR',1,1,2,'2017-02-14 10:55:02','2017-02-14 12:15:00','take away','49.226.156.254',NULL,NULL,'2017-02-14 15:55:02','2017-02-14 15:55:02'),(339,20170214411252,12.50,12.50,1,'pickup','Nigel Cowan','nigel.cowan@merco.co.nz','021905088','XeuWF8onxkxUP1zl8th5MvmxGaszqqqX',1,1,2,'2017-02-14 10:57:45','2017-02-14 12:00:00','take away','49.226.156.254',NULL,NULL,'2017-02-14 15:57:45','2017-02-14 15:57:45'),(340,20170215730901,25.00,25.00,4,'pickup','Klaus Gerding','klaus@gerding.net','0226224780','',1,1,1,'2017-02-15 18:47:28','2017-02-15 18:47:28','take away','202.56.38.163',NULL,'','2017-02-15 23:47:28','2017-02-16 20:46:51'),(341,20170218806719,12.50,12.50,4,'pickup','Tarlei','michael.tarlei@hotmail.com','068440403','',1,1,1,'2017-02-18 17:24:01','2017-02-18 17:24:01','take away','121.75.197.251',NULL,'','2017-02-18 22:24:01','2017-02-20 18:46:18'),(342,20170218269756,12.50,12.50,4,'pickup','Lavinia Adshead','b.ladshead@hotmail.com','0275091116','',1,1,1,'2017-02-18 17:51:24','2017-02-18 18:15:00','take away','121.75.171.122',NULL,'To pay on pick up ','2017-02-18 22:51:24','2017-02-20 18:46:18');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_users`
--

DROP TABLE IF EXISTS `orders_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_users` (
  `orders_id` int(10) unsigned NOT NULL,
  `users_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`orders_id`,`users_id`),
  KEY `orders_users_users_id_foreign` (`users_id`),
  CONSTRAINT `orders_users_orders_id_foreign` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_users_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_users`
--

LOCK TABLES `orders_users` WRITE;
/*!40000 ALTER TABLE `orders_users` DISABLE KEYS */;
INSERT INTO `orders_users` VALUES (323,1),(324,1),(325,1),(326,1),(327,1),(328,1),(329,1),(332,1),(333,1),(337,23),(338,23),(339,23);
/*!40000 ALTER TABLE `orders_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('yeweicao@gmail.com','a874eba558693c7f28c757d592b0733b720d6aedfbfe4facadeb6f9fa4311932','2016-12-16 00:54:10');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'manage_backend','manage the system','2016-03-11 09:20:36','2016-03-11 09:20:36');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_users`
--

DROP TABLE IF EXISTS `role_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_users` (
  `users_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`users_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_users`
--

LOCK TABLES `role_users` WRITE;
/*!40000 ALTER TABLE `role_users` DISABLE KEYS */;
INSERT INTO `role_users` VALUES (1,1);
/*!40000 ALTER TABLE `role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'manager','manager role for the system','2016-03-11 09:17:37','2016-03-11 09:17:37');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shops`
--

DROP TABLE IF EXISTS `shops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shops` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `distancelevel1` double(8,2) NOT NULL,
  `distancelevel2` double(8,2) NOT NULL,
  `freedelivery` double(8,2) NOT NULL,
  `googleapi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta` varchar(510) COLLATE utf8_unicode_ci NOT NULL,
  `cash` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `poli` tinyint(1) NOT NULL,
  `poliapi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dayoff` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `starttime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `closetime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shops`
--

LOCK TABLES `shops` WRITE;
/*!40000 ALTER TABLE `shops` DISABLE KEYS */;
INSERT INTO `shops` VALUES (1,'Noodle Canteen @ Taradale','269 Gloucester St, Taradale','211751199',3.00,3.00,30.00,'AIzaSyAByX4V9imxh_CChO6XGZ40RdqnFCuhM90','<meta name=\"description\" content=\"Noodle Canteen Taradale offering customers online orders! Just a few clicks, we will  get your dishes made and delivered in a timely manner.\"><meta name=\"keywords\" content=\"Noodle Canteen Taradale,  taradale, delivery taradale, pickup taradale, pick up taradale, place order taradale, delivery, pickup, noodle, canteen, food, catering \">',1,0,1,'sdfdfadsfdfdf','0,2,3,4,5,6','11','21','2016-12-18 17:14:43','2017-02-14 04:51:16');
/*!40000 ALTER TABLE `shops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_dish`
--

DROP TABLE IF EXISTS `tag_dish`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag_dish` (
  `tag_id` int(10) unsigned NOT NULL,
  `dish_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`user_id`,`dish_id`,`tag_id`),
  KEY `tag_dish_dish_id_foreign` (`dish_id`),
  KEY `tag_dish_tag_id_foreign` (`tag_id`),
  CONSTRAINT `tag_dish_dish_id_foreign` FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tag_dish_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tag_dish_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_dish`
--

LOCK TABLES `tag_dish` WRITE;
/*!40000 ALTER TABLE `tag_dish` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag_dish` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ranking` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `types_user_id_foreign` (`users_id`),
  CONSTRAINT `types_user_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (2,1,'Dish',5,'all  dishes','2016-03-11 10:30:23','2016-11-27 00:22:43'),(3,1,'others',2,'snack and drinks','2017-01-05 08:28:57','2017-01-06 09:57:44');
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userAddress`
--

DROP TABLE IF EXISTS `userAddress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userAddress` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `area_id` int(10) unsigned NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `useraddress_area_id_foreign` (`area_id`),
  KEY `useraddress_user_id_foreign` (`user_id`),
  CONSTRAINT `useraddress_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`) ON DELETE CASCADE,
  CONSTRAINT `useraddress_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userAddress`
--

LOCK TABLES `userAddress` WRITE;
/*!40000 ALTER TABLE `userAddress` DISABLE KEYS */;
/*!40000 ALTER TABLE `userAddress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mobilephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comsumptionAmount` int(11) NOT NULL,
  `stripe_active` tinyint(4) NOT NULL DEFAULT '0',
  `stripe_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stripe_subscription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stripe_plan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_four` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `subscription_ends_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'yewei','yeweicao@gmail.com','$2y$10$vwed7BVZvKtdXIqiKTAGm.AbgMZ/Xjyz34eluU1nwxLRXYiyNCs1q','p8nca6weOlhQdstAuzACUSgh7bHt3WbVCAm0v70FdSazLhjYSIYDOa7drD2V','2016-03-08 10:08:26','2017-02-11 16:02:20','','',0,0,NULL,NULL,NULL,NULL,NULL,NULL),(2,'Administrator','sam.yeweicao@gmail.com','$2y$10$6sp8ypX8c.zVbu8vV36ideA/Hic9qISenzTm1aUI9nV3aKmPG.sJS',NULL,'2016-03-14 22:13:28','2016-03-14 22:13:28','','',0,0,NULL,NULL,NULL,NULL,NULL,NULL),(3,'Qiuchan Cao','ccsam@gmail.com','$2y$10$XHSJreK4uVylMkvTfSQUh.K3LKxkFUeX2kLmwWgrjvXRmRLqJFxRS',NULL,'2016-10-17 23:07:05','2016-10-17 23:07:05','','',0,0,NULL,NULL,NULL,NULL,NULL,NULL),(4,'myname','yecao@gmail.com','$2y$10$WVIEnYeCxi3xNHje4uD1/Op3ahI.Gyerb1b42V0TLe.Jtff/KIniW','CB4oDXp8nd5pH6sXuXESoHSnMPy2fmeEvfj01RH1u45BiCrW0O5g7ma2xLU1','2016-10-18 10:08:03','2016-11-02 10:19:22','','',0,0,NULL,NULL,NULL,NULL,NULL,NULL),(5,'second','second@gmail.com','$2y$10$FbkY8AkU3ADopu1hFt/o/u5jKFLtanVN2aOkd5lteavum4/CZp1uC','sWOMoz86xazL7gYBA0KWwuwQ6EqtDK4PgpXEZcoHhwqIDClGowrvr0Zr1vQm','2016-10-18 10:10:32','2016-10-18 10:10:57','','021136987',0,0,NULL,NULL,NULL,NULL,NULL,NULL),(6,'noodle','noodle@gmail.com','$2y$10$n0mQTwdrRTIDjwSlE7nc5uzp807eXFlJrrlvwDRlyg7YHuuSyKbyy','EtUl1LmLzCj2KC6H6FSJm08vy03oBtZ414v9WDqmuPQlhlivinwzg6GjsVYq','2016-10-21 09:26:39','2016-10-21 09:28:48','','022312548',0,0,NULL,NULL,NULL,NULL,NULL,NULL),(7,'nname','nname@gmail.com','$2y$10$v4iYW1VBvbgL/tthEJsSfOKbTCquaDHYeTBkpW2G5oSlCPHb4VdaS','KvjK5DIkE04xvl10wVVQL4ipTAQIFU1NODooyiSJb1BnkjWyNU2pVh6R1YCG','2016-10-21 09:29:22','2016-10-21 09:32:39','','011254698',0,0,NULL,NULL,NULL,NULL,NULL,NULL),(8,'othername','other@gmail.com','$2y$10$al0w6hdzQpddOMZOAYsGTuKdjiDDsmy3ecHKrg3ltvue8.0MtPwPK','NLoTnq0qWk2xv304X9MXdlufRmzt4XeHitHkqrZcka7oRlt1smYWyN44nOu0','2016-10-21 09:33:05','2016-10-21 09:54:22','','012336547',0,0,NULL,NULL,NULL,NULL,NULL,NULL),(9,'lastname','lastname@gmail.com','$2y$10$RGGpRTp73J0qJmNGkXQkO.YIrAk1NrPB54ao9zS/nQjXStIIVXeD6','9TG3WwDkx6bew0S2N2mn58zgflGKsN1q9xZV6wRggoFnoJ4o2X0mGcRr0mrN','2016-10-21 09:54:43','2016-10-24 08:29:29','','0211458899',0,0,NULL,NULL,NULL,NULL,NULL,NULL),(22,'yesan','greatwork.c@gmail.com','$2y$10$OoPOg.oQYY0sVjuQgZhPh.LNkd3b3A9/1Z0Kfx9nLMOgADxKM7ZFG',NULL,'2016-11-21 16:36:08','2016-11-21 16:36:08','','211751199',0,0,NULL,NULL,NULL,NULL,NULL,NULL),(23,'Nigel Cowan','nigel.cowan@merco.co.nz','$2y$10$wEBqQUKO0croWntqIYqKaujEnoTcptni6Q77dWFGgNCvHOOgYVfKW',NULL,'2017-01-25 15:33:38','2017-01-25 15:33:38','','021905088',0,0,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-02-21 11:01:25
