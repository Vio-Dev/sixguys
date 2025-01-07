CREATE DATABASE  IF NOT EXISTS `figureshop` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `figureshop`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: figureshop
-- ------------------------------------------------------
-- Server version	8.0.35

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('liem@gmail.com|127.0.0.1','i:1;',1735204978),('liem@gmail.com|127.0.0.1:timer','i:1735204978;',1735204978),('nguyentrongliem574@gmail.com|127.0.0.1','i:2;',1735204962),('nguyentrongliem574@gmail.com|127.0.0.1:timer','i:1735204962;',1735204962);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cart_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `product_variant_id` bigint unsigned DEFAULT NULL,
  `quantity` int NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_items_cart_id_foreign` (`cart_id`),
  KEY `cart_items_product_id_foreign` (`product_id`),
  KEY `cart_items_product_variant_id_foreign` (`product_variant_id`),
  CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_items`
--

LOCK TABLES `cart_items` WRITE;
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (1,1,'active','2024-12-26 05:18:45','2024-12-26 05:18:45');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,NULL,'Bàn phím',0,NULL,NULL),(2,1,'Phím cơ',0,'2024-12-25 01:28:46','2024-12-25 01:28:46'),(3,NULL,'Ghế',0,'2024-12-25 01:33:04','2024-12-25 01:33:04'),(4,3,'Ghế Corsair',0,'2024-12-25 01:33:15','2024-12-25 01:41:02'),(5,NULL,'Chuột',0,'2024-12-26 03:07:14','2024-12-26 03:07:14'),(6,NULL,'Lót Chuột',0,'2024-12-26 03:15:36','2024-12-26 03:15:36'),(7,NULL,'Phụ Kiện',0,'2024-12-26 03:31:34','2024-12-26 03:31:34'),(8,7,'Đèn Để Bàn',0,'2024-12-26 03:48:58','2024-12-26 03:48:58'),(9,7,'Loa Có Dây',0,'2024-12-26 03:51:30','2024-12-26 03:52:47'),(10,7,'Loa Bluetooth',0,'2024-12-26 03:52:23','2024-12-26 03:52:23'),(11,7,'Đồng Hồ',0,'2024-12-26 03:53:21','2024-12-26 03:53:21'),(12,7,'LED',0,'2024-12-26 03:55:11','2024-12-26 03:55:11'),(13,7,'Giá Đỡ Tai Nghe',0,'2024-12-26 03:55:33','2024-12-26 03:55:33'),(14,7,'KeyCap',0,'2024-12-26 03:57:24','2024-12-26 03:57:24');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` bigint unsigned DEFAULT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `isHidden` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_post_id_foreign` (`post_id`),
  KEY `comments_product_id_foreign` (`product_id`),
  KEY `comments_parent_id_foreign` (`parent_id`),
  CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `url_img` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_img` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_product_id_foreign` (`product_id`),
  CONSTRAINT `media_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (1,'uploads/products/1735178708_ban-phim-co-man-hinh-piifox-walk.png','1735178708_ban-phim-co-man-hinh-piifox-walk.png',0,'2024-12-25 19:05:08','2024-12-25 19:05:08',1),(2,'uploads/products/1735178708_ban-phim-co-man-hinh-piifox-walk1.png','1735178708_ban-phim-co-man-hinh-piifox-walk1.png',1,'2024-12-25 19:05:08','2024-12-25 19:05:08',1),(3,'uploads/products/1735178708_ban-phim-co-man-hinh-piifox-walk2.png','1735178708_ban-phim-co-man-hinh-piifox-walk2.png',2,'2024-12-25 19:05:08','2024-12-25 19:05:08',1),(4,'uploads/products/1735200580_anh-1-600x600.jpg','1735200580_anh-1-600x600.jpg',0,'2024-12-26 01:09:40','2024-12-26 01:09:40',2),(5,'uploads/products/1735200580_Ban-phim-co-langtu-lt104-full-ph.jpg','1735200580_Ban-phim-co-langtu-lt104-full-ph.jpg',1,'2024-12-26 01:09:40','2024-12-26 01:09:40',2),(6,'uploads/products/1735200580_Ban-phim-co-langtu-lt104-full-ph1.jpg','1735200580_Ban-phim-co-langtu-lt104-full-ph1.jpg',2,'2024-12-26 01:09:40','2024-12-26 01:09:40',2),(7,'uploads/products/1735205494_Gravastar-Mecury-1-768x768.png','1735205494_Gravastar-Mecury-1-768x768.png',0,'2024-12-26 02:31:34','2024-12-26 02:31:34',3),(8,'uploads/products/1735205494_Gravastar-Mecury-2-600x600.png','1735205494_Gravastar-Mecury-2-600x600.png',1,'2024-12-26 02:31:34','2024-12-26 02:31:34',3),(9,'uploads/products/1735205494_LIMITED-1.png','1735205494_LIMITED-1.png',2,'2024-12-26 02:31:34','2024-12-26 02:31:34',3),(10,'uploads/products/1735205500_Gravastar-Mecury-1-768x768.png','1735205500_Gravastar-Mecury-1-768x768.png',0,'2024-12-26 02:31:40','2024-12-26 02:31:40',4),(11,'uploads/products/1735205500_Gravastar-Mecury-2-600x600.png','1735205500_Gravastar-Mecury-2-600x600.png',1,'2024-12-26 02:31:40','2024-12-26 02:31:40',4),(12,'uploads/products/1735205500_LIMITED-1.png','1735205500_LIMITED-1.png',2,'2024-12-26 02:31:40','2024-12-26 02:31:40',4),(13,'uploads/products/1735206335_Ban-phim-co-k3-pro-freewolf-den.png','1735206335_Ban-phim-co-k3-pro-freewolf-den.png',0,'2024-12-26 02:45:35','2024-12-26 02:45:35',5),(14,'uploads/products/1735206335_Ban-phim-co-k3-pro-freewolf-switch.png','1735206335_Ban-phim-co-k3-pro-freewolf-switch.png',1,'2024-12-26 02:45:35','2024-12-26 02:45:35',5),(15,'uploads/products/1735206335_Ban-phim-co-k3-pro-freewolf-ziyo.png','1735206335_Ban-phim-co-k3-pro-freewolf-ziyo.png',2,'2024-12-26 02:45:35','2024-12-26 02:45:35',5),(16,'uploads/products/1735206534_Ban-phim-co-kesme-lunar-01-4 (1).png','1735206534_Ban-phim-co-kesme-lunar-01-4 (1).png',0,'2024-12-26 02:48:54','2024-12-26 02:48:54',6),(17,'uploads/products/1735206534_Ban-phim-co-kesme-lunar-01-6.png','1735206534_Ban-phim-co-kesme-lunar-01-6.png',1,'2024-12-26 02:48:54','2024-12-26 02:48:54',6),(18,'uploads/products/1735206534_ban-phim-co-man-hinh-piifox-anhdaidien.png','1735206534_ban-phim-co-man-hinh-piifox-anhdaidien.png',2,'2024-12-26 02:48:54','2024-12-26 02:48:54',6),(19,'uploads/products/1735206744_langtu-gk-85-ban-pro-768x768-1-6.png','1735206744_langtu-gk-85-ban-pro-768x768-1-6.png',0,'2024-12-26 02:52:24','2024-12-26 02:52:24',7),(20,'uploads/products/1735206744_ZG011-Ban-Phim-Co-Khong-Day-Hot.png','1735206744_ZG011-Ban-Phim-Co-Khong-Day-Hot.png',1,'2024-12-26 02:52:24','2024-12-26 02:52:24',7),(21,'uploads/products/1735206744_ZG011-Ban-Phim-Co-Khong-Day-Hot-2mau.png','1735206744_ZG011-Ban-Phim-Co-Khong-Day-Hot-2mau.png',2,'2024-12-26 02:52:24','2024-12-26 02:52:24',7),(22,'uploads/products/1735206744_ZG011-Ban-Phim-Co-Khong-Day-Hot-xanh.png','1735206744_ZG011-Ban-Phim-Co-Khong-Day-Hot-xanh.png',3,'2024-12-26 02:52:24','2024-12-26 02:52:24',7),(23,'uploads/products/1735206970_Ban-Phim-Langtu-L98-2-600x600.png','1735206970_Ban-Phim-Langtu-L98-2-600x600.png',0,'2024-12-26 02:56:10','2024-12-26 02:56:10',8),(24,'uploads/products/1735206970_Ban-Phim-Langtu-L98-3-600x600.png','1735206970_Ban-Phim-Langtu-L98-3-600x600.png',1,'2024-12-26 02:56:10','2024-12-26 02:56:10',8),(25,'uploads/products/1735206970_Ban-Phim-Langtu-L98-sea.png','1735206970_Ban-Phim-Langtu-L98-sea.png',2,'2024-12-26 02:56:10','2024-12-26 02:56:10',8),(26,'uploads/products/1735207139_Ban-Phim-Langtu-LT75-1-768x768.png','1735207139_Ban-Phim-Langtu-LT75-1-768x768.png',0,'2024-12-26 02:58:59','2024-12-26 02:58:59',9),(27,'uploads/products/1735207139_Ban-Phim-Langtu-LT75-2-600x600.png','1735207139_Ban-Phim-Langtu-LT75-2-600x600.png',1,'2024-12-26 02:58:59','2024-12-26 02:58:59',9),(28,'uploads/products/1735207139_Ban-Phim-Langtu-LT75-3.png','1735207139_Ban-Phim-Langtu-LT75-3.png',2,'2024-12-26 02:58:59','2024-12-26 02:58:59',9),(29,'uploads/products/1735207139_Ban-Phim-Langtu-LT75-4-600x600.png','1735207139_Ban-Phim-Langtu-LT75-4-600x600.png',3,'2024-12-26 02:58:59','2024-12-26 02:58:59',9),(30,'uploads/products/1735207295_Akko-LE-2.png','1735207295_Akko-LE-2.png',0,'2024-12-26 03:01:35','2024-12-26 03:01:35',10),(31,'uploads/products/1735207295_Akko-LE-10.png','1735207295_Akko-LE-10.png',1,'2024-12-26 03:01:35','2024-12-26 03:01:35',10),(32,'uploads/products/1735207295_Akko-LE-11.png','1735207295_Akko-LE-11.png',2,'2024-12-26 03:01:35','2024-12-26 03:01:35',10),(33,'uploads/products/1735207295_Akko-LE-12.png','1735207295_Akko-LE-12.png',3,'2024-12-26 03:01:35','2024-12-26 03:01:35',10),(34,'uploads/products/1735207443_ban-phim-co-full-nhom-m1w-0-600x.png','1735207443_ban-phim-co-full-nhom-m1w-0-600x.png',0,'2024-12-26 03:04:03','2024-12-26 03:04:03',11),(35,'uploads/products/1735207443_ban-phim-co-full-nhom-m1w-2-768x.png','1735207443_ban-phim-co-full-nhom-m1w-2-768x.png',1,'2024-12-26 03:04:03','2024-12-26 03:04:03',11),(36,'uploads/products/1735207443_ban-phim-co-full-nhom-m1w-3-768x.png','1735207443_ban-phim-co-full-nhom-m1w-3-768x.png',2,'2024-12-26 03:04:03','2024-12-26 03:04:03',11),(37,'uploads/products/1735207443_ban-phim-co-full-nhom-m1w-4.png','1735207443_ban-phim-co-full-nhom-m1w-4.png',3,'2024-12-26 03:04:03','2024-12-26 03:04:03',11),(38,'uploads/products/1735207443_ban-phim-co-full-nhom-m1w-5.png','1735207443_ban-phim-co-full-nhom-m1w-5.png',4,'2024-12-26 03:04:03','2024-12-26 03:04:03',11),(39,'uploads/products/1735207797_ZG042-Chuot-Led-Freewolf-M8-768x.png','1735207797_ZG042-Chuot-Led-Freewolf-M8-768x.png',0,'2024-12-26 03:09:57','2024-12-26 03:09:57',12),(40,'uploads/products/1735207797_ZG045-Chuot-Led-Zgaming-M1-3-600.png','1735207797_ZG045-Chuot-Led-Zgaming-M1-3-600.png',1,'2024-12-26 03:09:57','2024-12-26 03:09:57',12),(41,'uploads/products/1735207797_ZG045-Chuot-Led-Zgaming-M1-4-600.png','1735207797_ZG045-Chuot-Led-Zgaming-M1-4-600.png',2,'2024-12-26 03:09:57','2024-12-26 03:09:57',12),(42,'uploads/products/1735207797_ZG045-Chuot-Led-Zgaming-M1-7-600.png','1735207797_ZG045-Chuot-Led-Zgaming-M1-7-600.png',3,'2024-12-26 03:09:57','2024-12-26 03:09:57',12),(43,'uploads/products/1735207942_ZG034-Chuot-Gaming-Langtu-G3-1.png','1735207942_ZG034-Chuot-Gaming-Langtu-G3-1.png',0,'2024-12-26 03:12:22','2024-12-26 03:12:22',13),(44,'uploads/products/1735207942_ZG034-Chuot-Gaming-Langtu-G3-2-6.png','1735207942_ZG034-Chuot-Gaming-Langtu-G3-2-6.png',1,'2024-12-26 03:12:22','2024-12-26 03:12:22',13),(45,'uploads/products/1735207942_ZG034-Chuot-Gaming-Langtu-G3-3-6.png','1735207942_ZG034-Chuot-Gaming-Langtu-G3-3-6.png',2,'2024-12-26 03:12:22','2024-12-26 03:12:22',13),(46,'uploads/products/1735207942_ZG034-Chuot-Gaming-Langtu-G3-4-6.png','1735207942_ZG034-Chuot-Gaming-Langtu-G3-4-6.png',3,'2024-12-26 03:12:22','2024-12-26 03:12:22',13),(47,'uploads/products/1735207942_ZG034-Chuot-Gaming-Langtu-G3-7-6.png','1735207942_ZG034-Chuot-Gaming-Langtu-G3-7-6.png',4,'2024-12-26 03:12:22','2024-12-26 03:12:22',13),(48,'uploads/products/1735208089_ZG035-Chuot-SILENT-langtu-T4-1-6.png','1735208089_ZG035-Chuot-SILENT-langtu-T4-1-6.png',0,'2024-12-26 03:14:49','2024-12-26 03:14:49',14),(49,'uploads/products/1735208089_ZG035-Chuot-SILENT-langtu-T4-5-6.png','1735208089_ZG035-Chuot-SILENT-langtu-T4-5-6.png',1,'2024-12-26 03:14:49','2024-12-26 03:14:49',14),(50,'uploads/products/1735208089_ZG035-Chuot-SILENT-langtu-T4-8-6.png','1735208089_ZG035-Chuot-SILENT-langtu-T4-8-6.png',2,'2024-12-26 03:14:49','2024-12-26 03:14:49',14),(51,'uploads/products/1735208295_ZG050-Ke-tay-ban-phim-silicon-1.png','1735208295_ZG050-Ke-tay-ban-phim-silicon-1.png',0,'2024-12-26 03:18:15','2024-12-26 03:18:15',15),(52,'uploads/products/1735208295_ZG050-Ke-tay-ban-phim-silicon-Coo.png','1735208295_ZG050-Ke-tay-ban-phim-silicon-Coo.png',1,'2024-12-26 03:18:15','2024-12-26 03:18:15',15),(53,'uploads/products/1735208295_ZG050-Ke-tay-ban-phim-silicon-pa.png','1735208295_ZG050-Ke-tay-ban-phim-silicon-pa.png',2,'2024-12-26 03:18:15','2024-12-26 03:18:15',15),(54,'uploads/products/1735208461_anh-2-600x600.png','1735208461_anh-2-600x600.png',0,'2024-12-26 03:21:01','2024-12-26 03:21:01',16),(55,'uploads/products/1735208461_anh-3-600x600.png','1735208461_anh-3-600x600.png',1,'2024-12-26 03:21:01','2024-12-26 03:21:01',16),(56,'uploads/products/1735208461_anh-5-600x600.png','1735208461_anh-5-600x600.png',2,'2024-12-26 03:21:01','2024-12-26 03:21:01',16),(57,'uploads/products/1735208461_anh-6-600x600.png','1735208461_anh-6-600x600.png',3,'2024-12-26 03:21:01','2024-12-26 03:21:01',16),(58,'uploads/products/1735208461_avatar-600x600.png','1735208461_avatar-600x600.png',4,'2024-12-26 03:21:01','2024-12-26 03:21:01',16),(59,'uploads/products/1735208665_Lot-chuot-Led-RGB-2-600x600.png','1735208665_Lot-chuot-Led-RGB-2-600x600.png',0,'2024-12-26 03:24:25','2024-12-26 03:24:25',17),(60,'uploads/products/1735208665_Lot-chuot-Led-RGB-3-600x600.png','1735208665_Lot-chuot-Led-RGB-3-600x600.png',1,'2024-12-26 03:24:25','2024-12-26 03:24:25',17),(61,'uploads/products/1735208665_Lot-chuot-Led-RGB-4-600x600.png','1735208665_Lot-chuot-Led-RGB-4-600x600.png',2,'2024-12-26 03:24:25','2024-12-26 03:24:25',17),(62,'uploads/products/1735208665_Lot-chuot-Led-RGB-5-600x600.png','1735208665_Lot-chuot-Led-RGB-5-600x600.png',3,'2024-12-26 03:24:25','2024-12-26 03:24:25',17),(63,'uploads/products/1735208862_Lot-chuot-co-lon-Minimalism-1-60.png','1735208862_Lot-chuot-co-lon-Minimalism-1-60.png',0,'2024-12-26 03:27:42','2024-12-26 03:27:42',18),(64,'uploads/products/1735208862_Lot-chuot-co-lon-Minimalism-5-60.png','1735208862_Lot-chuot-co-lon-Minimalism-5-60.png',1,'2024-12-26 03:27:42','2024-12-26 03:27:42',18),(65,'uploads/products/1735208862_Lot-chuot-co-lon-Minimalism-6-60.png','1735208862_Lot-chuot-co-lon-Minimalism-6-60.png',2,'2024-12-26 03:27:42','2024-12-26 03:27:42',18),(66,'uploads/products/1735209043_ZG051-Lot-Chuot-1-600x600.png','1735209043_ZG051-Lot-Chuot-1-600x600.png',0,'2024-12-26 03:30:43','2024-12-26 03:30:43',19),(67,'uploads/products/1735209043_ZG051-Lot-Chuot-2-600x600.png','1735209043_ZG051-Lot-Chuot-2-600x600.png',1,'2024-12-26 03:30:43','2024-12-26 03:30:43',19),(68,'uploads/products/1735209043_ZG051-Lot-Chuot-3-600x600.png','1735209043_ZG051-Lot-Chuot-3-600x600.png',2,'2024-12-26 03:30:44','2024-12-26 03:30:44',19),(69,'uploads/products/1735209044_ZG051-Lot-Chuot-600x600.png','1735209044_ZG051-Lot-Chuot-600x600.png',3,'2024-12-26 03:30:44','2024-12-26 03:30:44',19),(70,'uploads/products/1735209044_ZG051-lot-Chuot-silicon-Corgi-3.png','1735209044_ZG051-lot-Chuot-silicon-Corgi-3.png',4,'2024-12-26 03:30:44','2024-12-26 03:30:44',19),(71,'uploads/products/1735209044_ZG051-lot-Chuot-silicon-Corgi-4.png','1735209044_ZG051-lot-Chuot-silicon-Corgi-4.png',5,'2024-12-26 03:30:44','2024-12-26 03:30:44',19),(72,'uploads/products/1735209044_ZG051-lot-Chuot-silicon-Corgi-6.png','1735209044_ZG051-lot-Chuot-silicon-Corgi-6.png',6,'2024-12-26 03:30:44','2024-12-26 03:30:44',19),(73,'uploads/products/1735209228_anh-1-2-600x600.png','1735209228_anh-1-2-600x600.png',0,'2024-12-26 03:33:48','2024-12-26 03:33:48',20),(74,'uploads/products/1735209228_anh-3-2.png','1735209228_anh-3-2.png',1,'2024-12-26 03:33:48','2024-12-26 03:33:48',20),(75,'uploads/products/1735209228_anh-6-1.png','1735209228_anh-6-1.png',2,'2024-12-26 03:33:48','2024-12-26 03:33:48',20),(76,'uploads/products/1735209228_avatar.jpg-600x600.png','1735209228_avatar.jpg-600x600.png',3,'2024-12-26 03:33:48','2024-12-26 03:33:48',20),(77,'uploads/products/1735209446_anh-2-13.png','1735209446_anh-2-13.png',0,'2024-12-26 03:37:26','2024-12-26 03:37:26',21),(78,'uploads/products/1735209446_anh-3-13-600x600.png','1735209446_anh-3-13-600x600.png',1,'2024-12-26 03:37:26','2024-12-26 03:37:26',21),(79,'uploads/products/1735209446_anh-4-9-600x600.png','1735209446_anh-4-9-600x600.png',2,'2024-12-26 03:37:26','2024-12-26 03:37:26',21),(80,'uploads/products/1735209446_anh-5-7-600x600.png','1735209446_anh-5-7-600x600.png',3,'2024-12-26 03:37:26','2024-12-26 03:37:26',21),(81,'uploads/products/1735209576_Gia-treo-tai-nghe-T20-2-1-600x60.png','1735209576_Gia-treo-tai-nghe-T20-2-1-600x60.png',0,'2024-12-26 03:39:36','2024-12-26 03:39:36',22),(82,'uploads/products/1735209577_Gia-treo-tai-nghe-T20-3-1-600x60.png','1735209577_Gia-treo-tai-nghe-T20-3-1-600x60.png',1,'2024-12-26 03:39:37','2024-12-26 03:39:37',22),(83,'uploads/products/1735209577_Gia-treo-tai-nghe-T20-5-1-600x60.png','1735209577_Gia-treo-tai-nghe-T20-5-1-600x60.png',2,'2024-12-26 03:39:37','2024-12-26 03:39:37',22),(84,'uploads/products/1735209751_ZG005-Thanh-Led-RGB-nhay-theo-nh.png','1735209751_ZG005-Thanh-Led-RGB-nhay-theo-nh.png',0,'2024-12-26 03:42:31','2024-12-26 03:42:31',23),(85,'uploads/products/1735209751_ZG005-Thanh-Led-RGB-nhay-theo-nh3.png','1735209751_ZG005-Thanh-Led-RGB-nhay-theo-nh3.png',1,'2024-12-26 03:42:31','2024-12-26 03:42:31',23),(86,'uploads/products/1735209751_ZG005-Thanh-Led-RGB-nhay-theo-nh9.png','1735209751_ZG005-Thanh-Led-RGB-nhay-theo-nh9.png',2,'2024-12-26 03:42:31','2024-12-26 03:42:31',23),(87,'uploads/products/1735209888_anh-1-12-600x600.png','1735209888_anh-1-12-600x600.png',0,'2024-12-26 03:44:48','2024-12-26 03:44:48',24),(88,'uploads/products/1735209888_anh-2-14.png','1735209888_anh-2-14.png',1,'2024-12-26 03:44:48','2024-12-26 03:44:48',24),(89,'uploads/products/1735209888_anh-5-8-600x600.png','1735209888_anh-5-8-600x600.png',2,'2024-12-26 03:44:48','2024-12-26 03:44:48',24),(90,'uploads/products/1735209888_anh-6-7-600x600.png','1735209888_anh-6-7-600x600.png',3,'2024-12-26 03:44:48','2024-12-26 03:44:48',24),(91,'uploads/products/1735210040_ZG004-Den-Led-Neon-de-ban-1-600x.png','1735210040_ZG004-Den-Led-Neon-de-ban-1-600x.png',0,'2024-12-26 03:47:20','2024-12-26 03:47:20',25),(92,'uploads/products/1735210040_ZG004-Den-Led-Neon-de-ban-2-600x.png','1735210040_ZG004-Den-Led-Neon-de-ban-2-600x.png',1,'2024-12-26 03:47:20','2024-12-26 03:47:20',25),(93,'uploads/products/1735210040_ZG004-Den-Led-Neon-de-ban-3-600x.png','1735210040_ZG004-Den-Led-Neon-de-ban-3-600x.png',2,'2024-12-26 03:47:20','2024-12-26 03:47:20',25),(94,'uploads/products/1735210779_KEYCAP-Black-Myth-Wukong-1-600x6.png','1735210779_KEYCAP-Black-Myth-Wukong-1-600x6.png',0,'2024-12-26 03:59:39','2024-12-26 03:59:39',26),(95,'uploads/products/1735210779_KEYCAP-Black-Myth-Wukong-2-600x6.png','1735210779_KEYCAP-Black-Myth-Wukong-2-600x6.png',1,'2024-12-26 03:59:39','2024-12-26 03:59:39',26),(96,'uploads/products/1735210779_KEYCAP-Black-Myth-Wukong-5-600x6.png','1735210779_KEYCAP-Black-Myth-Wukong-5-600x6.png',2,'2024-12-26 03:59:39','2024-12-26 03:59:39',26),(97,'uploads/products/1735210779_KEYCAP-Black-Myth-Wukong-6-600x6.png','1735210779_KEYCAP-Black-Myth-Wukong-6-600x6.png',3,'2024-12-26 03:59:39','2024-12-26 03:59:39',26),(98,'uploads/products/1735210779_KEYCAP-Black-Myth-Wukong-7-600x6.png','1735210779_KEYCAP-Black-Myth-Wukong-7-600x6.png',4,'2024-12-26 03:59:39','2024-12-26 03:59:39',26),(99,'uploads/products/1735210918_Keycap-Chemical-2-600x600.png','1735210918_Keycap-Chemical-2-600x600.png',0,'2024-12-26 04:01:58','2024-12-26 04:01:58',27),(100,'uploads/products/1735210918_Keycap-Chemical-3-600x600.png','1735210918_Keycap-Chemical-3-600x600.png',1,'2024-12-26 04:01:58','2024-12-26 04:01:58',27),(101,'uploads/products/1735210918_Keycap-Chemical-4-600x600.png','1735210918_Keycap-Chemical-4-600x600.png',2,'2024-12-26 04:01:58','2024-12-26 04:01:58',27),(102,'uploads/products/1735210918_Keycap-Chemical-5-600x600.png','1735210918_Keycap-Chemical-5-600x600.png',3,'2024-12-26 04:01:58','2024-12-26 04:01:58',27),(103,'uploads/products/1735210918_Keycap-Chemical-6-600x600.png','1735210918_Keycap-Chemical-6-600x600.png',4,'2024-12-26 04:01:58','2024-12-26 04:01:58',27),(104,'uploads/products/1735211149_ZG005-04-DEN-LED-NEON-XUONG-RONG.png','1735211149_ZG005-04-DEN-LED-NEON-XUONG-RONG.png',0,'2024-12-26 04:05:49','2024-12-26 04:05:49',28),(105,'uploads/products/1735211149_ZG005-06-DEN-LED-NEON-CO-DE-GUIT.png','1735211149_ZG005-06-DEN-LED-NEON-CO-DE-GUIT.png',1,'2024-12-26 04:05:49','2024-12-26 04:05:49',28),(106,'uploads/products/1735211149_ZG005-12-DEN-LED-NEON-CO-DE-MEO.png','1735211149_ZG005-12-DEN-LED-NEON-CO-DE-MEO.png',2,'2024-12-26 04:05:49','2024-12-26 04:05:49',28),(107,'uploads/products/1735211149_ZG005-14-DEN-LED-NEON-CO-DE-NOT.png','1735211149_ZG005-14-DEN-LED-NEON-CO-DE-NOT.png',3,'2024-12-26 04:05:49','2024-12-26 04:05:49',28),(108,'uploads/products/1735211149_ZG005-22-DEN-LED-NEON-CO-DE-CAU.png','1735211149_ZG005-22-DEN-LED-NEON-CO-DE-CAU.png',4,'2024-12-26 04:05:49','2024-12-26 04:05:49',28),(109,'uploads/products/1735211149_ZG005-25-DEN-LED-NEON-HANH-TINH.png','1735211149_ZG005-25-DEN-LED-NEON-HANH-TINH.png',5,'2024-12-26 04:05:49','2024-12-26 04:05:49',28),(110,'uploads/products/1735211149_ZG005-28-DEN-LED-NEON-SAO-CHOI-6.png','1735211149_ZG005-28-DEN-LED-NEON-SAO-CHOI-6.png',6,'2024-12-26 04:05:49','2024-12-26 04:05:49',28),(111,'uploads/products/1735211149_ZG005-35-DEN-LED-NEON-IMPOSTER-6.png','1735211149_ZG005-35-DEN-LED-NEON-IMPOSTER-6.png',7,'2024-12-26 04:05:49','2024-12-26 04:05:49',28),(112,'uploads/products/1735211149_ZG005-36-DEN-LED-NEON-GAMING-600.png','1735211149_ZG005-36-DEN-LED-NEON-GAMING-600.png',8,'2024-12-26 04:05:49','2024-12-26 04:05:49',28),(113,'uploads/products/1735211149_ZG005-52-DEN-LED-NEON-GAME-ROOM.png','1735211149_ZG005-52-DEN-LED-NEON-GAME-ROOM.png',9,'2024-12-26 04:05:49','2024-12-26 04:05:49',28),(114,'uploads/products/1735211292_anh-1-600x6005.png','1735211292_anh-1-600x6005.png',0,'2024-12-26 04:08:12','2024-12-26 04:08:12',29),(115,'uploads/products/1735211292_anh-2-600x6050.png','1735211292_anh-2-600x6050.png',1,'2024-12-26 04:08:12','2024-12-26 04:08:12',29),(116,'uploads/products/1735211292_anh-3.png','1735211292_anh-3.png',2,'2024-12-26 04:08:12','2024-12-26 04:08:12',29),(117,'uploads/products/1735211427_Den-Led-Decor-Game-Over-2-1-600x.png','1735211427_Den-Led-Decor-Game-Over-2-1-600x.png',0,'2024-12-26 04:10:27','2024-12-26 04:10:27',30),(118,'uploads/products/1735211427_Den-Led-Decor-Game-Over-3-1-600x.png','1735211427_Den-Led-Decor-Game-Over-3-1-600x.png',1,'2024-12-26 04:10:27','2024-12-26 04:10:27',30),(119,'uploads/products/1735211427_Den-Led-Decor-Game-Over-4-600x60.png','1735211427_Den-Led-Decor-Game-Over-4-600x60.png',2,'2024-12-26 04:10:27','2024-12-26 04:10:27',30);
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_12_19_113720_add_role_to_users_table',1),(5,'2024_12_19_114120_create_categories_table',1),(6,'2024_12_19_114217_create_products_table',1),(7,'2024_12_19_115037_create_media_table',1),(8,'2024_12_19_115647_create_orders_table',1),(9,'2024_12_19_115733_create_order_details_table',1),(10,'2024_12_19_115821_create_posts_table',1),(11,'2024_12_21_090941_update_value_for_unit',1),(12,'2024_12_25_034427_add_column_to_categories',1),(13,'2024_12_25_040009_create_variants_table',1),(14,'2024_12_25_040104_create_variant_values_table',1),(15,'2024_12_25_040153_create_product_variants_table',1),(16,'2024_12_25_041904_create_carts_table',1),(17,'2024_12_25_041921_create_cart_items_table',1),(18,'2024_12_25_042413_create_comments_table',1),(19,'2024_12_25_042519_create_ratings_table',1),(20,'2025_01_02_082438_add_note_column_to_order_table',2),(21,'2025_01_03_035802_add_timestamps_to_order_detail',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `users_id` bigint unsigned NOT NULL,
  `order_date` datetime NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `payment_method` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_users_id_foreign` (`users_id`),
  CONSTRAINT `order_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (20,1,'2025-01-04 13:48:27',5999000.00,'confirmed','Giao giờ hành chính 13h trở đi','cod',0,'2025-01-03 23:48:27','2025-01-03 23:48:51'),(21,1,'2025-01-04 13:50:14',559000.00,'completed',NULL,'cod',0,'2025-01-03 23:50:14','2025-01-03 23:50:14'),(22,1,'2025-01-04 14:46:03',1898000.00,'confirmed',NULL,'cod',0,'2025-01-04 00:46:03','2025-01-04 00:46:29');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_detail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `product_variant_id` bigint unsigned DEFAULT NULL,
  `quantity` int NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_detail_order_id_foreign` (`order_id`),
  KEY `order_detail_product_id_foreign` (`product_id`),
  CONSTRAINT `order_detail_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_detail_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_detail`
--

LOCK TABLES `order_detail` WRITE;
/*!40000 ALTER TABLE `order_detail` DISABLE KEYS */;
INSERT INTO `order_detail` VALUES (13,20,6,NULL,1,5999000.00,0,'2025-01-03 23:48:27','2025-01-03 23:48:27'),(14,21,5,NULL,1,559000.00,0,'2025-01-03 23:50:14','2025-01-03 23:50:14'),(15,22,11,NULL,1,1898000.00,0,'2025-01-04 00:46:03','2025-01-04 00:46:03');
/*!40000 ALTER TABLE `order_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
INSERT INTO `password_reset_tokens` VALUES ('bmtck0000@gmail.com','$2y$12$1Aj/8Hz7KBsQLu/jLV2pTetEHTK6CNZJkN7TEiNIYQbrl2WuR75Ma','2025-01-02 22:22:51');
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shortDecription` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_name_unique` (`name`),
  KEY `posts_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_variants`
--

DROP TABLE IF EXISTS `product_variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_variants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `variant_value_id` bigint unsigned NOT NULL,
  `price` int NOT NULL,
  `inStock` int NOT NULL,
  `hasSold` int NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_variants_product_id_foreign` (`product_id`),
  KEY `product_variants_variant_value_id_foreign` (`variant_value_id`),
  CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_variants_variant_value_id_foreign` FOREIGN KEY (`variant_value_id`) REFERENCES `variant_values` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_variants`
--

LOCK TABLES `product_variants` WRITE;
/*!40000 ALTER TABLE `product_variants` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_variants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `inStock` int NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int NOT NULL DEFAULT '0',
  `hasSold` int NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `shortDescription` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `category_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Bàn Phím Cơ Piifox Walker75 – ER75 | 3 Mode | Mạch Xuôi | Hotswap | LED RGB',11190000,994,'Cái',2,0,'<p>M&ocirc; tả sản phẩm</p>','<p>M&ocirc; tả ngắn</p>','uploads/products/1735178708_phim-co-thumnail.png','public',0,2,'2024-12-25 19:05:08','2025-01-03 00:50:50'),(2,'BÀN PHÍM CƠ KHÔNG DÂY HOT-SWAP LANGTU LT104',1200000,97,'Cái',0,0,'<ul>\r\n<li><strong>Thương hiệu:</strong>&nbsp;Langtu &ndash; Full box ch&iacute;nh h&atilde;ng &ndash; bảo h&agrave;nh 12 th&aacute;ng, 1 đổi 1 trong 03 ng&agrave;y test sp</li>\r\n<li>T&ecirc;n sản phẩm: B&Agrave;N PH&Iacute;M CƠ KH&Ocirc;NG D&Acirc;Y HOT-SWAP LANGTU LT014</li>\r\n<li><strong>Loại b&agrave;n ph&iacute;m:</strong>&nbsp;Ph&iacute;m Cơ | C&oacute; Hot-Swap (dễ d&agrave;ng thay đổi ph&iacute;m/ keycap theo sở th&iacute;ch)</li>\r\n<li>Switch: Linear (Blue Ocean &ndash; sản xuất ri&ecirc;ng cho d&ograve;ng n&agrave;y) đ&atilde; được lube trước khi xuất xưởng, cho cảm gi&aacute;c bấm kh&aacute; đầm, &ecirc;m.</li>\r\n<li>Loại kết nối: Bản C&oacute; d&acirc;y (1 mode) &amp; Bản Kh&ocirc;ng D&acirc;y (3 mode)</li>\r\n<li>Pin sạc 4000 mah, thời gian chờ ~ 100 ng&agrave;y, Thời gian sử dụng ~ 10 ng&agrave;y</li>\r\n<li>Đ&egrave;n Led: LED RGB &amp; Rainbow t&ugrave;y phi&ecirc;n bản</li>\r\n<li>Size ph&iacute;m: 104 Ph&iacute;m + N&uacute;m xoay v&agrave; m&agrave;n h&igrave;nh</li>\r\n<li>K&iacute;ch thước: 43 x 15 x 4 cm</li>\r\n<li>C&acirc;n nặng: 900 gram</li>\r\n<li>Độ bền ph&iacute;m: &gt; 70.000.000 lượt bấm</li>\r\n</ul>\r\n<h4>SO S&Aacute;NH ĐIỂM KH&Aacute;C NHAU GIỮA C&Aacute;C PHI&Ecirc;N BẢN B&Agrave;N PH&Iacute;M CƠ LANGTU LT104:</h4>\r\n<p>✔️ PHI&Ecirc;N BẢN LT84 Pro (KH&Ocirc;NG D&Acirc;Y):</p>\r\n<ul>\r\n<li>Kết nối kh&ocirc;ng d&acirc;y (03 mode: Bluetooth, Wireless 2.4G hoặc USB Type-C)</li>\r\n<li>Led RGB với rất nhiều chế độ m&agrave;u sắc.</li>\r\n<li>M&agrave;n h&igrave;nh hiển thị c&oacute; thể thay đổi nội dung/ ảnh Gif theo chủ đề m&igrave;nh y&ecirc;u th&iacute;ch với kho ảnh Gif 18.000.000 ảnh</li>\r\n</ul>\r\n<p>✔️ PHI&Ecirc;N BẢN LT84 thường (C&Oacute; D&Acirc;Y):</p>\r\n<ul>\r\n<li>Kết nối d&acirc;y USB Type C (01 mode)</li>\r\n<li>Led Rainbow</li>\r\n</ul>\r\n<p><img class=\"aligncenter wp-image-12615 size-full\" src=\"https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-2.jpg\" sizes=\"auto, (max-width: 750px) 100vw, 750px\" srcset=\"https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-2.jpg 750w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-2-300x300.jpg 300w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-2-150x150.jpg 150w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-2-600x600.jpg 600w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-2-148x148.jpg 148w\" alt=\"\" width=\"750\" height=\"750\" loading=\"lazy\">\\<img class=\"aligncenter wp-image-13773 size-full\" src=\"https://zgaming.vn/wp-content/uploads/2023/09/1-mode.jpg\" sizes=\"auto, (max-width: 750px) 100vw, 750px\" srcset=\"https://zgaming.vn/wp-content/uploads/2023/09/1-mode.jpg 750w, https://zgaming.vn/wp-content/uploads/2023/09/1-mode-300x300.jpg 300w, https://zgaming.vn/wp-content/uploads/2023/09/1-mode-150x150.jpg 150w, https://zgaming.vn/wp-content/uploads/2023/09/1-mode-600x600.jpg 600w, https://zgaming.vn/wp-content/uploads/2023/09/1-mode-148x148.jpg 148w\" alt=\"\" width=\"750\" height=\"750\" loading=\"lazy\"></p>\r\n<p><img class=\"aligncenter wp-image-13774\" src=\"https://zgaming.vn/wp-content/uploads/2023/09/Grey-Orange-1024x1024.jpg\" sizes=\"auto, (max-width: 750px) 100vw, 750px\" srcset=\"https://zgaming.vn/wp-content/uploads/2023/09/Grey-Orange-1024x1024.jpg 1024w, https://zgaming.vn/wp-content/uploads/2023/09/Grey-Orange-300x300.jpg 300w, https://zgaming.vn/wp-content/uploads/2023/09/Grey-Orange-150x150.jpg 150w, https://zgaming.vn/wp-content/uploads/2023/09/Grey-Orange-768x768.jpg 768w, https://zgaming.vn/wp-content/uploads/2023/09/Grey-Orange-1536x1536.jpg 1536w, https://zgaming.vn/wp-content/uploads/2023/09/Grey-Orange-1200x1200.jpg 1200w, https://zgaming.vn/wp-content/uploads/2023/09/Grey-Orange-600x600.jpg 600w, https://zgaming.vn/wp-content/uploads/2023/09/Grey-Orange-148x148.jpg 148w, https://zgaming.vn/wp-content/uploads/2023/09/Grey-Orange.jpg 1613w\" alt=\"\" width=\"750\" height=\"750\" loading=\"lazy\"></p>\r\n<p><img class=\"aligncenter wp-image-13775\" src=\"https://zgaming.vn/wp-content/uploads/2023/09/Screenshot-2024-04-11-145208-1.png\" sizes=\"auto, (max-width: 750px) 100vw, 750px\" srcset=\"https://zgaming.vn/wp-content/uploads/2023/09/Screenshot-2024-04-11-145208-1.png 800w, https://zgaming.vn/wp-content/uploads/2023/09/Screenshot-2024-04-11-145208-1-300x300.png 300w, https://zgaming.vn/wp-content/uploads/2023/09/Screenshot-2024-04-11-145208-1-150x150.png 150w, https://zgaming.vn/wp-content/uploads/2023/09/Screenshot-2024-04-11-145208-1-768x768.png 768w, https://zgaming.vn/wp-content/uploads/2023/09/Screenshot-2024-04-11-145208-1-600x600.png 600w, https://zgaming.vn/wp-content/uploads/2023/09/Screenshot-2024-04-11-145208-1-148x148.png 148w\" alt=\"\" width=\"750\" height=\"750\" loading=\"lazy\"></p>\r\n<p><img class=\"aligncenter wp-image-12619 size-full\" src=\"https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-6.jpg\" sizes=\"auto, (max-width: 765px) 100vw, 765px\" srcset=\"https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-6.jpg 765w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-6-300x300.jpg 300w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-6-150x150.jpg 150w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-6-600x600.jpg 600w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-6-148x148.jpg 148w\" alt=\"\" width=\"765\" height=\"765\" loading=\"lazy\"><img class=\"aligncenter wp-image-12620 size-full\" src=\"https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-7.jpg\" sizes=\"auto, (max-width: 744px) 100vw, 744px\" srcset=\"https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-7.jpg 744w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-7-300x300.jpg 300w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-7-150x150.jpg 150w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-7-600x600.jpg 600w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-7-148x148.jpg 148w\" alt=\"\" width=\"744\" height=\"744\" loading=\"lazy\"><img class=\"aligncenter wp-image-12621 size-full\" src=\"https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-8.jpg\" sizes=\"auto, (max-width: 761px) 100vw, 761px\" srcset=\"https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-8.jpg 761w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-8-300x300.jpg 300w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-8-150x150.jpg 150w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-8-600x600.jpg 600w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-8-148x148.jpg 148w\" alt=\"\" width=\"761\" height=\"761\" loading=\"lazy\"><img class=\"aligncenter wp-image-12622 size-full\" src=\"https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-9.jpg\" sizes=\"auto, (max-width: 750px) 100vw, 750px\" srcset=\"https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-9.jpg 750w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-9-300x300.jpg 300w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-9-150x150.jpg 150w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-9-600x600.jpg 600w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-9-148x148.jpg 148w\" alt=\"\" width=\"750\" height=\"750\" loading=\"lazy\"></p>\r\n<h4>CHI TIẾT VỀ B&Agrave;N PH&Iacute;M CƠ KH&Ocirc;NG D&Acirc;Y HOT-SWAP LANGTU LT84:</h4>\r\n<ul>\r\n<li class=\"irIKAp\">B&agrave;n ph&iacute;m được thiết kế hiện đại với n&uacute;m xoay v&agrave; m&agrave;n h&igrave;nh led hiển thị tr&ecirc;n b&agrave;n ph&iacute;m</li>\r\n<li class=\"irIKAp\">Hỗ trợ 3 chế độ kết nối v&ocirc; c&ugrave;ng tiện lợi: C&aacute;p typeC/ bluetooth/ USB 2.4</li>\r\n<li class=\"irIKAp\">Thiết kế nhỏ gọn dễ d&agrave;ng mang theo khi cần thiết. Bố cục b&agrave;i tr&iacute; khoa học.</li>\r\n<li class=\"irIKAp\">Dung lượng pin l&ecirc;n tới 4000mAh cho thời gian sử dụng tương đối l&acirc;u c&oacute; thể l&ecirc;n tới 10 ng&agrave;y. Thời gian chờ khoảng 100 ng&agrave;y.</li>\r\n<li class=\"irIKAp\">Trang bị Ocean Blue switch đ&atilde; được lube trước khi xuất xưởng cho cảm gi&aacute;c bấm kh&aacute; l&agrave; chắc chắn, &ecirc;m, kh&ocirc;ng bị lọc xọc.</li>\r\n<li class=\"irIKAp\">T&iacute;nh năng HOTSWAP ưu việt dễ d&agrave;ng thay thế switch khi cần thiết</li>\r\n<li class=\"irIKAp\">C&oacute; c&aacute;c chế độ kết nối ri&ecirc;ng biệt cho c&aacute;c hệ điều h&agrave;nh windown, IOS.</li>\r\n<li class=\"irIKAp\">Tốc độ g&otilde; ph&iacute;m nhanh: Ch&iacute;nh v&igrave; c&oacute; tốc độ g&otilde; ph&iacute;m nhanh n&ecirc;n đ&acirc;y l&agrave; loại b&agrave;n ph&iacute;m được c&aacute;c game thủ thường sử dụng nhất, g&otilde; nhanh hơn đồng nghĩa khả năng &ldquo;ti&ecirc;u diệt&rdquo; địch cũng cao hơn.</li>\r\n<li>Độ nảy cao: Nhờ c&oacute; một l&ograve; xo b&ecirc;n trong mỗi ph&iacute;m mang lại độ nảy cao sau khi nhấn ph&iacute;m, nhờ độ nảy cao n&ecirc;n nếu như một ph&iacute;m cần phải g&otilde; nhiều lần th&igrave; chắc chắn rằng thời gian g&otilde; đối với b&agrave;n ph&iacute;m cơ sẽ ngắn hơn.</li>\r\n<li>G&otilde; ph&iacute;m &ecirc;m tay hơn: Chỉ cần sử dụng một lực nhẹ vừa phải để nhấn ph&iacute;m thay v&igrave; phải nhấn đủ một lực mạnh để miếng cao su chạm đến bảng mạch điện tử như b&agrave;n ph&iacute;m thường.</li>\r\n<li>Tuổi thọ cao hơn: B&agrave;n ph&iacute;m cơ thường c&oacute; tuổi thọ cao hơn rất nhiều so với b&agrave;n ph&iacute;m thường.</li>\r\n<li>Cảm gi&aacute;c g&otilde; ph&iacute;m tuyệt hơn</li>\r\n<li>Sử dụng đ&egrave;n b&agrave;n ph&iacute;m: LED Rainbown cho bản c&oacute; d&acirc;y v&agrave; RGB cho bản kh&ocirc;ng d&acirc;y</li>\r\n</ul>\r\n<h4>LƯU &Yacute; KHI MUA H&Agrave;NG:</h4>\r\n<ul>\r\n<li>Khi nhận h&agrave;ng c&aacute;c bạn h&atilde;y quay video mở h&agrave;ng để đảm bảo quyền lợi nếu c&oacute; sự cố kh&ocirc;ng may xảy ra.</li>\r\n<li>Shop sẽ cố gắng nhất c&oacute; thể để giảm thiểu rủi ro đ&egrave;n bị lỗi hoặc nh&acirc;n vi&ecirc;n g&oacute;i h&agrave;ng g&oacute;i sai/ thiếu sản phẩm. Nhưng nếu bạn gặp phải trường hợp n&agrave;y xin đừng vội đ&aacute;nh gi&aacute; xấu, h&atilde;y nhắn tin cho shop sẽ hỗ trợ bảo h&agrave;nh miễn ph&iacute; 100% cho bạn.</li>\r\n<li>H&atilde;y li&ecirc;n hệ với shop nếu như sản phẩm c&oacute; lỗi, bọn m&igrave;nh sẽ lu&ocirc;n chăm s&oacute;c kh&aacute;ch h&agrave;ng một c&aacute;ch nhiệt t&igrave;nh nhất.</li>\r\n<li>C&aacute;c bạn nhận được sản phẩm, vui l&ograve;ng đ&aacute;nh gi&aacute; gi&uacute;p Shop để hưởng th&ecirc;m nhiều ưu đ&atilde;i hơn nh&eacute;.</li>\r\n</ul>\r\n<p>&nbsp;</p>','<ul>\r\n<li><strong>Full box</strong>&nbsp;ch&iacute;nh h&atilde;ng &ndash; bảo h&agrave;nh 12 th&aacute;ng, 1 đổi 1</li>\r\n<li><strong>Hỗ trợ:&nbsp;</strong>Windows v&agrave; Mac OS</li>\r\n<li><strong>Loại kết nối:&nbsp;</strong>1 Mode (bản cắm d&acirc;y) &amp; 3 mode (Vừa c&oacute; d&acirc;y, vừa kh&ocirc;ng d&acirc;y: Bluetooth/ USB rời)</li>\r\n<li><strong>Loại Switch:</strong> Ocean Blue Switch | c&oacute; Hot Swap</li>\r\n</ul>','uploads/products/1735200580_anh-1-600x600.jpg','public',0,2,'2024-12-26 01:09:40','2025-01-03 00:39:28'),(3,'Bàn phím cơ GravaStar Mercury K1 Pro CyperPunk',1199000,100,'cái',0,0,'<h2 class=\"WjNdTR\">M&Ocirc; TẢ SẢN PHẨM: B&agrave;n ph&iacute;m cơ GravaStar Mercury K1 Pro Special Edition &ndash; Cyberpunk</h2>\r\n<div class=\"Gf4Ro0\">\r\n<div class=\"e8lZp3\">\r\n<h3><strong>TH&Ocirc;NG SỐ KỸ THUẬT CHUNG:</strong></h3>\r\n<ul>\r\n<li>Thương hiệu: Gravastar</li>\r\n<li>Kết nối b&agrave;n ph&iacute;m: 03 Mode kh&ocirc;ng d&acirc;y (Bluetooth, USB, D&acirc;y Type-C)</li>\r\n<li>Thời gian bảo h&agrave;nh: 12 th&aacute;ng</li>\r\n<li>Chất liệu: Khung nh&ocirc;m kim loại cao cấp</li>\r\n<li>Pin khủng: 8.000mah</li>\r\n<li>N&uacute;m xoay chỉnh &acirc;m: c&oacute;</li>\r\n<li>T&iacute;nh Năng Hot-Swap: C&oacute;</li>\r\n<li>LED: RGB 16 Triệu m&agrave;u</li>\r\n<li>Keycap: Loại cao cấp PBT</li>\r\n<li>Kỹ thuật in: Dyesub</li>\r\n</ul>\r\n<h3><strong>V&Igrave; SAO N&Ecirc;N MUA B&Agrave;N PH&Iacute;M CƠ&nbsp;</strong>GravaStar Mercury K1 Pro Special Edition &ndash; Cyberpunk</h3>\r\n<ul>\r\n<li><strong>Switch cơ học cao cấp</strong>: Trang bị switch cơ học với độ nhạy vượt trội, mang lại phản hồi nhanh, cảm gi&aacute;c g&otilde; chắc chắn, v&agrave; độ bền l&ecirc;n đến h&agrave;ng triệu lần nhấn, l&yacute; tưởng cho cả game thủ v&agrave; người d&ugrave;ng chuy&ecirc;n nghiệp.</li>\r\n<li><strong>Đ&egrave;n LED RGB đa m&agrave;u sắc t&ugrave;y chỉnh</strong>: Hệ thống đ&egrave;n nền RGB với nhiều hiệu ứng &aacute;nh s&aacute;ng c&oacute; thể t&ugrave;y chỉnh, tạo ra kh&ocirc;ng gian gaming sống động v&agrave; phong c&aacute;ch c&aacute; nh&acirc;n h&oacute;a.</li>\r\n<li><strong>Khung kim loại cao cấp</strong>: Thiết kế vỏ ngo&agrave;i bằng hợp kim nh&ocirc;m si&ecirc;u bền, chống chịu va đập tốt, gi&uacute;p bảo vệ b&agrave;n ph&iacute;m v&agrave; tăng độ ổn định trong qu&aacute; tr&igrave;nh sử dụng.</li>\r\n<li><strong>Kết nối đa dạng</strong>: Hỗ trợ kết nối c&oacute; d&acirc;y (USB-C) v&agrave; kh&ocirc;ng d&acirc;y (Bluetooth hoặc 2.4GHz), mang lại sự linh hoạt tối ưu khi chơi game hoặc l&agrave;m việc.</li>\r\n<li><strong>T&iacute;nh năng N-Key Rollover</strong>: Đảm bảo nhận diện ho&agrave;n hảo c&aacute;c tổ hợp ph&iacute;m phức tạp m&agrave; kh&ocirc;ng bị lỗi, cho ph&eacute;p thao t&aacute;c ch&iacute;nh x&aacute;c trong c&aacute;c game c&oacute; cường độ cao.</li>\r\n<li><strong>Pin dung lượng lớn, sạc nhanh</strong>: B&agrave;n ph&iacute;m t&iacute;ch hợp pin dung lượng cao, hỗ trợ thời gian sử dụng l&acirc;u d&agrave;i trong chế độ kh&ocirc;ng d&acirc;y, c&ugrave;ng t&iacute;nh năng sạc nhanh gi&uacute;p bạn kh&ocirc;ng phải lo lắng về thời gian sạc.</li>\r\n<li><strong>Thiết kế c&ocirc;ng th&aacute;i học</strong>: Thiết kế tối ưu h&oacute;a c&ocirc;ng th&aacute;i học với độ nghi&ecirc;ng thoải m&aacute;i, gi&uacute;p giảm căng thẳng cho cổ tay khi sử dụng trong thời gian d&agrave;i.</li>\r\n<li><strong>N&uacute;t điều chỉnh &acirc;m lượng tiện lợi</strong>: T&iacute;ch hợp n&uacute;m xoay điều chỉnh &acirc;m lượng ri&ecirc;ng biệt, cho ph&eacute;p kiểm so&aacute;t &acirc;m thanh một c&aacute;ch nhanh ch&oacute;ng v&agrave; thuận tiện m&agrave; kh&ocirc;ng l&agrave;m gi&aacute;n đoạn qu&aacute; tr&igrave;nh chơi game.</li>\r\n<li><strong>Thiết kế độc đ&aacute;o, đậm chất gaming</strong>: Với kiểu d&aacute;ng mạnh mẽ, c&aacute; t&iacute;nh c&ugrave;ng chi tiết kim loại tinh xảo, K1 Pro l&agrave; sự lựa chọn ho&agrave;n hảo cho những game thủ y&ecirc;u th&iacute;ch sự ph&aacute; c&aacute;ch v&agrave; chất lượng.</li>\r\n</ul>\r\n</div>\r\n</div>','<ul>\r\n<li>Thương hiệu: Gravastar</li>\r\n<li>Kết nối b&agrave;n ph&iacute;m: 03 Mode kh&ocirc;ng d&acirc;y (Bluetooth, USB, D&acirc;y Type-C)</li>\r\n<li>Thời gian bảo h&agrave;nh: 12 th&aacute;ng</li>\r\n<li>Chất liệu: Khung nh&ocirc;m kim loại cao cấp</li>\r\n<li>Pin khủng: 8.000mah</li>\r\n<li>N&uacute;m xoay chỉnh &acirc;m: c&oacute;</li>\r\n<li>T&iacute;nh Năng Hot-Swap: C&oacute;</li>\r\n<li>LED: RGB 16 Triệu m&agrave;u</li>\r\n<li class=\"QN2lPu\"><strong>Đủ phi&ecirc;n bản lụa chọn: Lite/ Basic/ Pro</strong></li>\r\n</ul>','uploads/products/1735205494_LIMITED-1.png','public',1,1,'2024-12-26 02:31:34','2024-12-26 02:36:26'),(4,'Bàn phím cơ GravaStar Mercury K1 Pro CyperPunk',1199000,98,'cái',0,0,'<h2 class=\"WjNdTR\">M&Ocirc; TẢ SẢN PHẨM: B&agrave;n ph&iacute;m cơ GravaStar Mercury K1 Pro Special Edition &ndash; Cyberpunk</h2>\r\n<div class=\"Gf4Ro0\">\r\n<div class=\"e8lZp3\">\r\n<h3><strong>TH&Ocirc;NG SỐ KỸ THUẬT CHUNG:</strong></h3>\r\n<ul>\r\n<li>Thương hiệu: Gravastar</li>\r\n<li>Kết nối b&agrave;n ph&iacute;m: 03 Mode kh&ocirc;ng d&acirc;y (Bluetooth, USB, D&acirc;y Type-C)</li>\r\n<li>Thời gian bảo h&agrave;nh: 12 th&aacute;ng</li>\r\n<li>Chất liệu: Khung nh&ocirc;m kim loại cao cấp</li>\r\n<li>Pin khủng: 8.000mah</li>\r\n<li>N&uacute;m xoay chỉnh &acirc;m: c&oacute;</li>\r\n<li>T&iacute;nh Năng Hot-Swap: C&oacute;</li>\r\n<li>LED: RGB 16 Triệu m&agrave;u</li>\r\n<li>Keycap: Loại cao cấp PBT</li>\r\n<li>Kỹ thuật in: Dyesub</li>\r\n</ul>\r\n<h3><strong>V&Igrave; SAO N&Ecirc;N MUA B&Agrave;N PH&Iacute;M CƠ&nbsp;</strong>GravaStar Mercury K1 Pro Special Edition &ndash; Cyberpunk</h3>\r\n<ul>\r\n<li><strong>Switch cơ học cao cấp</strong>: Trang bị switch cơ học với độ nhạy vượt trội, mang lại phản hồi nhanh, cảm gi&aacute;c g&otilde; chắc chắn, v&agrave; độ bền l&ecirc;n đến h&agrave;ng triệu lần nhấn, l&yacute; tưởng cho cả game thủ v&agrave; người d&ugrave;ng chuy&ecirc;n nghiệp.</li>\r\n<li><strong>Đ&egrave;n LED RGB đa m&agrave;u sắc t&ugrave;y chỉnh</strong>: Hệ thống đ&egrave;n nền RGB với nhiều hiệu ứng &aacute;nh s&aacute;ng c&oacute; thể t&ugrave;y chỉnh, tạo ra kh&ocirc;ng gian gaming sống động v&agrave; phong c&aacute;ch c&aacute; nh&acirc;n h&oacute;a.</li>\r\n<li><strong>Khung kim loại cao cấp</strong>: Thiết kế vỏ ngo&agrave;i bằng hợp kim nh&ocirc;m si&ecirc;u bền, chống chịu va đập tốt, gi&uacute;p bảo vệ b&agrave;n ph&iacute;m v&agrave; tăng độ ổn định trong qu&aacute; tr&igrave;nh sử dụng.</li>\r\n<li><strong>Kết nối đa dạng</strong>: Hỗ trợ kết nối c&oacute; d&acirc;y (USB-C) v&agrave; kh&ocirc;ng d&acirc;y (Bluetooth hoặc 2.4GHz), mang lại sự linh hoạt tối ưu khi chơi game hoặc l&agrave;m việc.</li>\r\n<li><strong>T&iacute;nh năng N-Key Rollover</strong>: Đảm bảo nhận diện ho&agrave;n hảo c&aacute;c tổ hợp ph&iacute;m phức tạp m&agrave; kh&ocirc;ng bị lỗi, cho ph&eacute;p thao t&aacute;c ch&iacute;nh x&aacute;c trong c&aacute;c game c&oacute; cường độ cao.</li>\r\n<li><strong>Pin dung lượng lớn, sạc nhanh</strong>: B&agrave;n ph&iacute;m t&iacute;ch hợp pin dung lượng cao, hỗ trợ thời gian sử dụng l&acirc;u d&agrave;i trong chế độ kh&ocirc;ng d&acirc;y, c&ugrave;ng t&iacute;nh năng sạc nhanh gi&uacute;p bạn kh&ocirc;ng phải lo lắng về thời gian sạc.</li>\r\n<li><strong>Thiết kế c&ocirc;ng th&aacute;i học</strong>: Thiết kế tối ưu h&oacute;a c&ocirc;ng th&aacute;i học với độ nghi&ecirc;ng thoải m&aacute;i, gi&uacute;p giảm căng thẳng cho cổ tay khi sử dụng trong thời gian d&agrave;i.</li>\r\n<li><strong>N&uacute;t điều chỉnh &acirc;m lượng tiện lợi</strong>: T&iacute;ch hợp n&uacute;m xoay điều chỉnh &acirc;m lượng ri&ecirc;ng biệt, cho ph&eacute;p kiểm so&aacute;t &acirc;m thanh một c&aacute;ch nhanh ch&oacute;ng v&agrave; thuận tiện m&agrave; kh&ocirc;ng l&agrave;m gi&aacute;n đoạn qu&aacute; tr&igrave;nh chơi game.</li>\r\n<li><strong>Thiết kế độc đ&aacute;o, đậm chất gaming</strong>: Với kiểu d&aacute;ng mạnh mẽ, c&aacute; t&iacute;nh c&ugrave;ng chi tiết kim loại tinh xảo, K1 Pro l&agrave; sự lựa chọn ho&agrave;n hảo cho những game thủ y&ecirc;u th&iacute;ch sự ph&aacute; c&aacute;ch v&agrave; chất lượng.</li>\r\n</ul>\r\n</div>\r\n</div>','<ul>\r\n<li>Thương hiệu: Gravastar</li>\r\n<li>Kết nối b&agrave;n ph&iacute;m: 03 Mode kh&ocirc;ng d&acirc;y (Bluetooth, USB, D&acirc;y Type-C)</li>\r\n<li>Thời gian bảo h&agrave;nh: 12 th&aacute;ng</li>\r\n<li>Chất liệu: Khung nh&ocirc;m kim loại cao cấp</li>\r\n<li>Pin khủng: 8.000mah</li>\r\n<li>N&uacute;m xoay chỉnh &acirc;m: c&oacute;</li>\r\n<li>T&iacute;nh Năng Hot-Swap: C&oacute;</li>\r\n<li>LED: RGB 16 Triệu m&agrave;u</li>\r\n<li class=\"QN2lPu\"><strong>Đủ phi&ecirc;n bản lụa chọn: Lite/ Basic/ Pro</strong></li>\r\n</ul>','uploads/products/1735205500_LIMITED-1.png','public',0,2,'2024-12-26 02:31:40','2025-01-02 02:09:50'),(5,'BÀN PHÍM CƠ FREEWOLF K3 | HOT-SWAP',559000,96,'cái',0,1,'<h4>CHI TIẾT VỀ B&Agrave;N PH&Iacute;M CƠ FREEWOLF K3 | HOT-SWAP:</h4>\r\n<ul>\r\n<li>Sản phẩm được trang bị Red Switch si&ecirc;u nhẹ v&agrave; &ecirc;m th&iacute;ch hợp cho đ&aacute;nh m&aacute;y hoặc c&aacute;c game cần bấm nhanh.</li>\r\n<li data-spm-anchor-id=\"a2o4n.pdp_revamp.product_detail.i8.64e040d72LXBpU\">Sản phẩm c&oacute; 3 m&agrave;u cho ph&acirc;n loại red switch l&agrave;<strong>&nbsp;Ghi (X&aacute;m)&nbsp; &amp;&nbsp; Xanh L&aacute;</strong></li>\r\n<li data-spm-anchor-id=\"a2o4n.pdp_revamp.product_detail.i0.64e040d72LXBpU\">Với đường n&eacute;t thiết kế g&oacute;c cạnh tạo n&ecirc;n sự kh&aacute;c biệt với nhiều sản phẩm kh&aacute;c.</li>\r\n<li data-spm-anchor-id=\"a2o4n.pdp_revamp.product_detail.i8.64e040d72LXBpU\">B&agrave;n Ph&iacute;m C&oacute; thể t&ugrave;y chọn thay thế Switch hoặc keycaps costom theo sở th&iacute;ch c&aacute; nh&acirc;n.</li>\r\n<li data-spm-anchor-id=\"a2o4n.pdp_revamp.product_detail.i8.64e040d72LXBpU\">B&agrave;n ph&iacute;m cơ sử dụng switch treo cho độ nảy, độ đ&agrave;n hồi v&agrave; độ nhạy cực tốt, Switch red tuổi thọ tốt l&ecirc;n đến 60 triệu lượt nhấn, đảm bảo b&agrave;n ph&iacute;m bền bỉ đồng h&agrave;nh c&ugrave;ng bạn trong suốt thời gian d&agrave;i.</li>\r\n<li data-spm-anchor-id=\"a2o4n.pdp_revamp.product_detail.i8.64e040d72LXBpU\">D&ugrave; l&agrave; b&agrave;n ph&iacute;m gaming nhưng K3 lại c&oacute; thiết kế kh&aacute; đơn giản, trang nh&atilde; để bạn dễ d&agrave;ng đặt n&oacute; tr&ecirc;n b&agrave;n l&agrave;m việc gia đ&igrave;nh hoặc cả ở văn ph&ograve;ng, hay mang theo sử dụng khi ra ngo&agrave;i.</li>\r\n<li data-spm-anchor-id=\"a2o4n.pdp_revamp.product_detail.i8.64e040d72LXBpU\">Ph&iacute;m cơ quen thuộc độ trũng bề mặt vừa phải, chất liệu nhựa nh&aacute;m thao t&aacute;c chắc tay, thiết kế che chắn hiệu quả cho c&aacute;c bo mạch b&ecirc;n trong để ngăn nhiễm ẩm trong c&aacute;c t&igrave;nh huống bị đổ tr&agrave;n nước.</li>\r\n<li data-spm-anchor-id=\"a2o4n.pdp_revamp.product_detail.i8.64e040d72LXBpU\">Tương th&iacute;ch với hệ điều h&agrave;nh Windows v&agrave; MacOS, chiều d&agrave;i d&acirc;y nối 1.8 m d&ugrave;ng linh hoạt. D&acirc;y c&aacute;p nối usb-typeC c&oacute; thể th&aacute;o rời tiện lợi.</li>\r\n</ul>\r\n<h4>LƯU &Yacute; KHI MUA H&Agrave;NG:</h4>\r\n<ul>\r\n<li>Khi nhận h&agrave;ng c&aacute;c bạn h&atilde;y quay video mở h&agrave;ng để đảm bảo quyền lợi nếu c&oacute; sự cố kh&ocirc;ng may xảy ra.</li>\r\n<li>Shop sẽ cố gắng nhất c&oacute; thể để giảm thiểu rủi ro đ&egrave;n bị lỗi hoặc nh&acirc;n vi&ecirc;n g&oacute;i h&agrave;ng g&oacute;i sai/ thiếu sản phẩm. Nhưng nếu bạn gặp phải trường hợp n&agrave;y xin đừng vội đ&aacute;nh gi&aacute; xấu, h&atilde;y nhắn tin cho shop sẽ hỗ trợ bảo h&agrave;nh miễn ph&iacute; 100% cho bạn.</li>\r\n<li>H&atilde;y li&ecirc;n hệ với shop nếu như sản phẩm c&oacute; lỗi, bọn m&igrave;nh sẽ lu&ocirc;n chăm s&oacute;c kh&aacute;ch h&agrave;ng một c&aacute;ch nhiệt t&igrave;nh nhất.</li>\r\n<li>C&aacute;c bạn nhận được sản phẩm, vui l&ograve;ng đ&aacute;nh gi&aacute; gi&uacute;p Shop để hưởng th&ecirc;m nhiều ưu đ&atilde;i hơn nh&eacute;.</li>\r\n</ul>','<ul>\r\n<li><strong>Thương hiệu:</strong>&nbsp;Free Wolf (ZIYOU LANG) nổi tiếng</li>\r\n<li><strong>Loại b&agrave;n ph&iacute;m:</strong>&nbsp;Ph&iacute;m cơ</li>\r\n<li><strong>Loại kết nối:</strong>&nbsp;Cổng Type-C</li>\r\n<li><strong>Loại Switch:</strong>&nbsp;Red Switch &ndash; C&oacute; t&iacute;nh năng Hot-Swap (dễ d&agrave;ng thay đổi ph&iacute;m/ keycap theo sở th&iacute;ch)</li>\r\n<li data-spm-anchor-id=\"a2o4n.pdp_revamp.product_detail.i7.64e040d72LXBpU\"><strong>Đ&egrave;n Led:</strong>&nbsp;LED RGB 16 triệu m&agrave;u</li>\r\n<li><strong>Size ph&iacute;m:</strong>&nbsp;Full 100 Ph&iacute;m</li>\r\n<li><strong>K&iacute;ch thước:</strong>&nbsp;38 x 13. x 3.5cm</li>\r\n<li><strong>C&acirc;n nặng:</strong>&nbsp;850 gram</li>\r\n<li><strong>M&agrave;u sắc:</strong>&nbsp;<strong>Ghi&nbsp; |&nbsp; Xanh L&aacute;</strong></li>\r\n</ul>','uploads/products/1735206335_Ban-phim-co-k3-pro-freewolf-anhdaidien.png','public',0,2,'2024-12-26 02:45:35','2025-01-03 23:50:14'),(6,'Bàn Phím Cơ Keysme Lunar 01',5999000,96,'cái',0,3,'<h4>M&Ocirc; TẢ SẢN PHẨM &ndash; B&agrave;n Ph&iacute;m Cơ Keysme Lunar 01 | T&iacute;ch Hợp Đ&egrave;n RGB Cảm Biến &Acirc;m Thanh | Phụ Kiện N&uacute;m Xoay &amp; T&ecirc;n Lửa 2 B&ecirc;n Ph&iacute;m</h4>\r\n<ul>\r\n<li>Thương hiệu: Keysme</li>\r\n<li>&nbsp;Kết nối: 03 Mode (Bluetooth, USB, d&acirc;y Type-C)</li>\r\n<li>T&iacute;ch Hợp Đ&egrave;n RGB Cảm Biến &Acirc;m Thanh</li>\r\n<li>C&oacute; N&uacute;m Xoay Điều Chỉnh &Acirc;m Lượng &amp; C&ugrave;ng 02 T&ecirc;n Lửa Decor</li>\r\n<li>Layout: TKL 87% (87 Ph&iacute;m)</li>\r\n<li>Pin si&ecirc;u tr&acirc;u: 4000mah</li>\r\n<li>&nbsp;K&iacute;ch thước: 368.5mm x 152mm x 47.5mm</li>\r\n<li>Trọng lượng: 1.32Kg</li>\r\n<li>&nbsp;LED: RGB</li>\r\n<li>Phụ kiện Full box gồm:\r\n<ul>\r\n<li>1 x Th&acirc;n M&aacute;y</li>\r\n<li>2 x Phụ kiện T&ecirc;n Lửa (QU&Agrave; TẶNG)</li>\r\n<li>1 x Bộ Laser stickers</li>\r\n<li>1 x Bộ PET dust cover</li>\r\n<li>1 x Bộ d&acirc;y c&aacute;p USB-C to USB-A</li>\r\n<li>1 x USB rời (2.4GHz)</li>\r\n<li>1 x Switch puller</li>\r\n<li>1 x Crowbar</li>\r\n<li>14 x Silicone bottom gasket</li>\r\n</ul>\r\n</li>\r\n</ul>','<ul>\r\n<li><strong>Full box</strong>&nbsp;ch&iacute;nh h&atilde;ng &ndash; bảo h&agrave;nh 3 th&aacute;ng, 1 đổi 1</li>\r\n<li><strong>Hỗ trợ:&nbsp;</strong>Windows v&agrave; Mac OS</li>\r\n<li><strong>Loại kết nối:&nbsp;</strong>3 mode</li>\r\n<li><strong>Loại Switch:</strong>&nbsp;Linear &ecirc;m mượt | C&oacute; Hot-swap</li>\r\n<li><strong>T&iacute;nh năng nội bật:&nbsp;</strong>C&oacute; Thanh LED nh&aacute;y theo nhạc | Led RGB</li>\r\n<li><strong>Qu&agrave; Tặng:&nbsp;</strong>2 x Phụ Kiện T&ecirc;n Lửa</li>\r\n</ul>','uploads/products/1735206534_ban-phim-co-man-hinh-piifox-anhdaidien.png','public',0,2,'2024-12-26 02:48:54','2025-01-03 23:48:27'),(7,'BÀN PHÍM CƠ KHÔNG DÂY HOT-SWAP LANGTU GK85',828000,99,'cái',0,0,'<h4>M&Ocirc; TẢ SẢN PHẨM &ndash; B&Agrave;N PH&Iacute;M CƠ KH&Ocirc;NG D&Acirc;Y HOT-SWAP LANGTU GK85:</h4>\r\n<ul>\r\n<li><strong>Thương hiệu:</strong>&nbsp;Langtu &ndash; Full box ch&iacute;nh h&atilde;ng &ndash; bảo h&agrave;nh 12 th&aacute;ng, 1 đổi 1</li>\r\n<li><strong>Loại b&agrave;n ph&iacute;m:</strong>&nbsp;Ph&iacute;m Cơ | C&oacute; Hot-Swap (dễ d&agrave;ng thay đổi ph&iacute;m/ keycap theo sở th&iacute;ch)</li>\r\n<li><strong>Hỗ trợ HỆ ĐIỀU H&Agrave;NH:</strong>&nbsp;Windows XP /Vista/7/8 Win7/Win8/Win1/android/linux/ v&agrave; OS của nh&agrave; T&aacute;o.</li>\r\n<li><strong>Loại kết nối:&nbsp;</strong>Kh&ocirc;ng D&acirc;y &ndash; 03 Chế độ kết nối<br>(1) C&aacute;p TYPE-C | Pin sạc 3200 mah, thời gian chờ ~ 100 ng&agrave;y, Thời gian sử dụng ~ 10 ng&agrave;y<br>(2) Bluetooth<br>(3) USB 2.4</li>\r\n<li><strong>Loại Switch:</strong>&nbsp;Golden (Orange) Switch | Chống Ồn</li>\r\n<li data-spm-anchor-id=\"a2o4n.pdp_revamp.product_detail.i7.64e040d72LXBpU\"><strong>Đ&egrave;n Led:</strong>&nbsp;Led Rainbow &amp; RGB nhiều chế độ t&ugrave;y chỉnh</li>\r\n<li><strong>Size ph&iacute;m:&nbsp;</strong>85 Ph&iacute;m</li>\r\n<li><strong>K&iacute;ch thước:</strong>&nbsp;36 x 13 x 3.4 cm</li>\r\n<li><strong>C&acirc;n nặng:</strong>&nbsp;750 gram</li>\r\n<li><strong>Độ bền ph&iacute;m:</strong>&nbsp;&gt; 70.000.000 lượt bấm</li>\r\n<li><strong>Bảo h&agrave;nh:</strong>&nbsp;12 Th&aacute;ng, bảo h&agrave;nh 1 đổi 1 trong v&ograve;ng 03 ng&agrave;y duy nhất tại Zgaming.vn</li>\r\n<li><strong>M&agrave;u Sắc:</strong><br>+ C&oacute; d&acirc;y c&oacute; m&agrave;u: Cream (Full m&agrave;u sữa) | Grey (Xam) | Matcha (Xanh L&aacute;)<br>+ Kh&ocirc;ng d&acirc;y c&oacute; m&agrave;u: Sea (Cam + Xanh Dương) | Bee (V&agrave;ng) | Pro (Xanh L&aacute; + Cam)</li>\r\n</ul>','<ul>\r\n<li>Full box ch&iacute;nh h&atilde;ng &ndash; bảo h&agrave;nh 12 th&aacute;ng, 1 đổi 1</li>\r\n<li><strong>Hỗ trợ:&nbsp;</strong>Windows v&agrave; Mac OS</li>\r\n<li><strong>Loại kết nối:&nbsp;</strong>1 Mode (bản kh&ocirc;ng d&acirc;y) &amp; 3 mode (bản c&oacute; d&acirc;y)</li>\r\n<li><strong>Loại Switch:</strong> Golden (Orange) Switch | c&oacute; Hot Swap</li>\r\n</ul>','uploads/products/1735206744_anh-12.png','public',0,2,'2024-12-26 02:52:24','2025-01-01 21:36:34'),(8,'Bàn Phím Không Dây LangTu L98',585000,99,'cái',0,0,'<h4>M&Ocirc; TẢ SẢN PHẨM &ndash; B&agrave;n Ph&iacute;m Kh&ocirc;ng D&acirc;y LangTu L98 | B&agrave;n Ph&iacute;m Văn Ph&ograve;ng Chuy&ecirc;n Dụng | &Acirc;m Thanh Trầm, Nhỏ. Si&ecirc;u &Ecirc;m Mượt | Kết Nối Bluetooth:</h4>\r\n<ul>\r\n<li>✔️ Thương hiệu: Langtu &ndash; Full box ch&iacute;nh h&atilde;ng &ndash; bảo h&agrave;nh 1 th&aacute;ng, 1 đổi 1<br>✔️ Loại kết nối: C&oacute; D&acirc;y &ndash; M&agrave;u SEA/ Grey<br>✔️ Loại kết nối: Kh&ocirc;ng D&acirc;y (Bluetooth, USB, D&acirc;y Type-C) &ndash; M&agrave;u Matcha v&agrave; Aurora<br>(1) C&aacute;p TYPE-C | Pin sạc 1600 mah, thời gian chờ ~ 100 ng&agrave;y, Thời gian sử dụng ~ 10 ng&agrave;y<br>(2) Bluetooth<br>(3) USB 2.4<br>✔️ Loại Switch: &Ecirc;m mượt | Chống Ồn<br>✔️ Đ&egrave;n Led: Led RGB 16 triệu m&agrave;u &ndash; nhiều chế độ t&ugrave;y chỉnh<br>✔️ Size ph&iacute;m: 102 Ph&iacute;m<br>✔️ K&iacute;ch thước: 415 x 143 x 23 mm<br>✔️ C&acirc;n nặng: 950 gram<br>✔️ Độ bền ph&iacute;m: &gt; 20.000.000 lượt bấm<br>✔️ Bảo h&agrave;nh: 1 Th&aacute;ng, bảo h&agrave;nh 1 đổi 1 trong v&ograve;ng 03 ng&agrave;y duy nhất tại Zgaming.vn<br>✔️ Thiết kế nhỏ gọn dễ d&agrave;ng mang theo khi cần thiết. Bố cục b&agrave;i tr&iacute; khoa học (Layout 98%)<br>✔️ Hỗ trợ c&aacute;c hệ điều h&agrave;nh windown, IOS.</li>\r\n</ul>','<ul>\r\n<li><strong>Thương hiệu:</strong>&nbsp;Langtu &ndash; Full box ch&iacute;nh h&atilde;ng &ndash; bảo h&agrave;nh 1 th&aacute;ng, 1 đổi 1</li>\r\n<li><strong>Loại kết nối:&nbsp;</strong>Kh&ocirc;ng D&acirc;y &ndash; 03 Chế độ kết nối<br>(1) C&aacute;p TYPE-C | Pin sạc 1600 mah, thời gian chờ ~ 100 ng&agrave;y, Thời gian sử dụng ~ 10 ng&agrave;y (d&agrave;nh cho phi&ecirc;n bản kh&ocirc;ng d&acirc;y)<br>(2) Bluetooth<br>(3) USB 2.4</li>\r\n<li><strong>Loại Switch:</strong>&nbsp;Linear | &ecirc;m mượt v&agrave; Chống Ồn</li>\r\n<li data-spm-anchor-id=\"a2o4n.pdp_revamp.product_detail.i7.64e040d72LXBpU\"><strong>Đ&egrave;n Led:</strong>&nbsp;Led Rainbow nhiều chế độ hiệu ứng</li>\r\n<li><strong>Size ph&iacute;m:</strong>&nbsp;98%</li>\r\n<li><strong>K&iacute;ch thước:</strong> 40 x 13 x 4 cm</li>\r\n</ul>','uploads/products/1735206970_Ban-Phim-Langtu-L98-1.png','public',0,2,'2024-12-26 02:56:10','2025-01-02 02:09:53'),(9,'BÀN PHÍM CƠ CÓ MÀN HÌNH KHÔNG DÂY HOT-SWAP LANGTU LT75',1098000,100,'cái',0,0,'<h4>M&Ocirc; TẢ SẢN PHẨM &ndash; B&Agrave;N PH&Iacute;M CƠ C&Oacute; M&Agrave;N H&Igrave;NH KH&Ocirc;NG D&Acirc;Y HOT-SWAP LANGTU LT75:</h4>\r\n<ul>\r\n<li><strong>Thương hiệu:</strong>&nbsp;Langtu &ndash; Full box ch&iacute;nh h&atilde;ng &ndash; bảo h&agrave;nh 12 th&aacute;ng, 1 đổi 1</li>\r\n<li><strong>Loại b&agrave;n ph&iacute;m:</strong>&nbsp;Ph&iacute;m Cơ | C&oacute; Hot-Swap (dễ d&agrave;ng thay đổi ph&iacute;m/ keycap theo sở th&iacute;ch)</li>\r\n<li>Switch: Linear đ&atilde; được lube trước khi xuất xưởng, cho cảm gi&aacute;c bấm kh&aacute; đầm, &ecirc;m.</li>\r\n<li>Loại kết nối: Bản C&oacute; d&acirc;y (1 mode) &amp; Bản Kh&ocirc;ng D&acirc;y (3 mode)</li>\r\n<li>Pin sạc 1600 mah, thời gian chờ ~ 60 ng&agrave;y, Thời gian sử dụng ~ 7 ng&agrave;y</li>\r\n<li>Đ&egrave;n Led: LED RGB</li>\r\n<li>Size ph&iacute;m: 75% + N&uacute;m xoay v&agrave; m&agrave;n h&igrave;nh</li>\r\n<li>K&iacute;ch thước: 33 x 15 x 5 cm</li>\r\n<li>C&acirc;n nặng: 850 gram</li>\r\n<li>Độ bền ph&iacute;m: &gt; 70.000.000 lượt bấm</li>\r\n</ul>','<ul>\r\n<li><strong>Full box</strong>&nbsp;ch&iacute;nh h&atilde;ng &ndash; bảo h&agrave;nh 12 th&aacute;ng, 1 đổi 1</li>\r\n<li><strong>Hỗ trợ:&nbsp;</strong>Windows v&agrave; Mac OS</li>\r\n<li><strong>Loại kết nối:&nbsp;</strong>3 mode (bản c&oacute; d&acirc;y)</li>\r\n<li><strong>Loại Switch:</strong>&nbsp;Linear &ecirc;m mượt | C&oacute; Hot-swap</li>\r\n<li><strong>T&iacute;nh năng nội bật:&nbsp;</strong>C&oacute; m&agrave;n h&igrave;nh &amp; N&uacute;m xoay | Chip Gaming | Gasket 7 lớp</li>\r\n</ul>','uploads/products/1735207139_Ban-Phim-Langtu-LT75-768x768.png','public',0,2,'2024-12-26 02:58:59','2024-12-26 02:58:59'),(10,'BÀN PHÍM CƠ AKKO YEAR OF THE DRAGON',4590000,100,'cái',0,0,'<h4>M&Ocirc; TẢ SẢN PHẨM &ndash; B&Agrave;N PH&Iacute;M CƠ *AKKO&nbsp;<strong>MOD007 V3 HE*</strong>&nbsp;PHI&Ecirc;N BẢN GIỚI HẠN [LIMITED]: YEAR OF THE DRAGON</h4>\r\n<p><strong>TH&Ocirc;NG TIN B&Agrave;N PH&Iacute;M</strong></p>\r\n<ul>\r\n<li>Thương hiệu: Akko</li>\r\n<li>D&ograve;ng ph&iacute;m:&nbsp;<strong>Mod007 V3 HE</strong>&nbsp;&ndash; Full box ch&iacute;nh h&atilde;ng &ndash; bảo h&agrave;nh 03 th&aacute;ng, 1 đổi 1</li>\r\n<li>\r\n<div dir=\"auto\">Layout: 75% Layout (82 keys)</div>\r\n</li>\r\n<li>\r\n<div dir=\"auto\">Chất liệu: Nh&ocirc;m nguy&ecirc;n khối CNC</div>\r\n</li>\r\n<li>\r\n<div dir=\"auto\">K&iacute;ch thước: 333*146*33mm</div>\r\n</li>\r\n<li>\r\n<div dir=\"auto\">Trọng lượng: 1.9 kg</div>\r\n</li>\r\n<li>\r\n<div dir=\"auto\">Kết nối: Wired Type-C</div>\r\n</li>\r\n<li>\r\n<div dir=\"auto\">Tốc độ phản hồi: 8000Hz (hầu như kh&ocirc;ng c&oacute; độ trễ)</div>\r\n</li>\r\n<li>\r\n<div dir=\"auto\">Keycap: OEM Profile</div>\r\n</li>\r\n<li>\r\n<div dir=\"auto\">LED: RGB</div>\r\n</li>\r\n<li>\r\n<div dir=\"auto\">Full box gồm: keyboard, instruction manual, power cord, key puller, Shaft puller, masking tape, dust cover, brass positioning plate, hex wrench, supplementary key</div>\r\n</li>\r\n<li>\r\n<div dir=\"auto\"><strong>Switch Quang Học: Akko Cream Yellow Magnetic</strong></div>\r\n<div dir=\"auto\">+ Hệ: Linear</div>\r\n<div dir=\"auto\">+ Lực nhấn: 50 &plusmn; 10gf</div>\r\n<div dir=\"auto\">+ Tổng h&agrave;nh tr&igrave;nh: 4.0mm<br>-&gt; Cho độ nhạy gấp nhiều lần v&agrave; &ecirc;m mượt gấp nhiều lần so với switch cơ</div>\r\n</li>\r\n</ul>','<ul>\r\n<li><strong>Full box</strong>&nbsp;&ndash; bảo h&agrave;nh 06 th&aacute;ng, 1 đổi 1</li>\r\n<li><strong>D&ograve;ng ph&iacute;m</strong>:&nbsp;<strong>Akko MOD007 V3 HE Phi&ecirc;n bản Đặc Biệt Limited</strong></li>\r\n<li><strong>Chất liệu:</strong>&nbsp;full nh&ocirc;m, c&oacute; n&uacute;m</li>\r\n<li><strong>Layout:</strong>&nbsp;75% (82 Ph&iacute;m)</li>\r\n<li><strong>T&iacute;nh năng:</strong>&nbsp;Hotswap v&agrave; mạch flex-cut từng ph&iacute;m</li>\r\n<li><strong>Loại Switch:&nbsp;</strong>Akko Cream Yellow Magnetic</li>\r\n</ul>','uploads/products/1735207295_Akko-LE-1.png','public',0,2,'2024-12-26 03:01:35','2024-12-26 03:01:35'),(11,'BÀN PHÍM CƠ MONSGEEK M1W [NEW] FULL NHÔM KIM LOẠI CNC',1898000,97,'cái',0,1,'<h4>M&Ocirc; TẢ SẢN PHẨM &ndash; B&Agrave;N PH&Iacute;M CƠ MONSGEEK M1W [NEW] Full Kim Loại | 03 Mode</h4>\r\n<ul>\r\n<li>Thương hiệu: Akko Monsgeek &ndash; Full box ch&iacute;nh h&atilde;ng &ndash; bảo h&agrave;nh 03 th&aacute;ng, 1 đổi 1</li>\r\n<li>Keycap: OEM profile, in Dye-sub</li>\r\n<li>Kết nối: Wired/Bluetooth/2.4Ghz Wireless</li>\r\n<li>N-Key Rollover: Support</li>\r\n<li>Battery Capacity: 6000mAh</li>\r\n<li>Response Time: 1ms</li>\r\n<li>Polling Rate: 1000Hz In wired and 2.4G modes, 125Hz in Bluetooth mode</li>\r\n<li>Cable Length: 150cm</li>\r\n<li>C&acirc;n nặng: 1.5Kg</li>\r\n<li>K&iacute;ch thước: 333*146*32.6mm</li>\r\n<li>Tương th&iacute;ch: Windows / macOS / iOS / Android</li>\r\n</ul>','<ul>\r\n<li><strong>Full box</strong>&nbsp;ch&iacute;nh h&atilde;ng &ndash; bảo h&agrave;nh 12 th&aacute;ng, 1 đổi 1</li>\r\n<li><strong>Hỗ trợ:&nbsp;</strong>Windows v&agrave; Mac OS</li>\r\n<li><strong>Loại kết nối: 03</strong>&nbsp;mode (Bluetooth, USB Receiver, D&acirc;y Type-C)</li>\r\n<li><strong>Loại Switch:&nbsp;</strong>Bản mặc định l&agrave; Akko Yellow Cream Pro Switch | c&oacute; Hot Swap</li>\r\n</ul>','uploads/products/1735207443_ban-phim-co-full-nhom-m1w-black.png','public',0,2,'2024-12-26 03:04:03','2025-01-04 00:46:03'),(12,'CHUỘT GAMING FREE WOLF M8',199000,99,'cái',0,0,'<h4>CHI TIẾT VỀ CHUỘT GAMING FREE WOLF M8:</h4>\r\n<ul>\r\n<li>Chuột game thủ CHUỘT LED FREE WOLF M8 &ndash; Si&ecirc;u Bền</li>\r\n<li>Rất nhiều mộc DPI cho anh em tha hồ lựa chọn, ph&ugrave; hợp từ tay to đến tay nhỏ</li>\r\n<li>Với Gần 16,8 triệu m&agrave;u c&ugrave;ng bảng điều khiển macro, anh em tha hồ điều chỉnh qua lại c&aacute;c chế độ Led RGB kh&aacute;c nhau: &aacute;nh s&aacute;ng đơn / &aacute;nh s&aacute;ng hỗn hợp / bộ truyền ph&aacute;t &hellip;. 1</li>\r\n<li>Ch&iacute;nh s&aacute;ch của Zgaming: 100 % b&aacute;n h&agrave;ng ch&iacute;nh h&agrave;ng 1 đổi 1 do lỗi ph&aacute;t sinh từ nh&agrave; sản xuất Kh&aacute;ch h&agrave;ng nhận h&agrave;ng, sản phẩm đ&uacute;ng h&igrave;nh ảnh thực tế mới phải thanh to&aacute;n.</li>\r\n</ul>\r\n<h4>LƯU &Yacute; KHI MUA H&Agrave;NG:</h4>\r\n<ul>\r\n<li>Khi nhận h&agrave;ng c&aacute;c bạn h&atilde;y quay video mở h&agrave;ng để đảm bảo quyền lợi nếu c&oacute; sự cố kh&ocirc;ng may xảy ra.</li>\r\n<li>Shop sẽ cố gắng nhất c&oacute; thể để giảm thiểu rủi ro đ&egrave;n bị lỗi hoặc nh&acirc;n vi&ecirc;n g&oacute;i h&agrave;ng g&oacute;i sai/ thiếu sản phẩm. Nhưng nếu bạn gặp phải trường hợp n&agrave;y xin đừng vội đ&aacute;nh gi&aacute; xấu, h&atilde;y nhắn tin cho shop sẽ hỗ trợ bảo h&agrave;nh miễn ph&iacute; 100% cho bạn.</li>\r\n<li>H&atilde;y li&ecirc;n hệ với shop nếu như sản phẩm c&oacute; lỗi, bọn m&igrave;nh sẽ lu&ocirc;n chăm s&oacute;c kh&aacute;ch h&agrave;ng một c&aacute;ch nhiệt t&igrave;nh nhất.</li>\r\n<li>C&aacute;c bạn nhận được sản phẩm, vui l&ograve;ng đ&aacute;nh gi&aacute; gi&uacute;p Shop để hưởng th&ecirc;m nhiều ưu đ&atilde;i hơn nh&eacute;.</li>\r\n</ul>','<ul>\r\n<li><strong>Thương hiệu:</strong>&nbsp;Free Wolf ch&iacute;nh h&atilde;ng full box</li>\r\n<li><strong>Loại chuột:</strong>&nbsp;Chuột Gaming, C&oacute; lỗ tho&aacute;ng kh&iacute; m&aacute;t tay</li>\r\n<li><strong>Số n&uacute;t:</strong>&nbsp;08</li>\r\n<li><strong>Tốc độ (DPI):</strong>&nbsp;4 nấc DPI L&ecirc;n đến 6.400 DPI</li>\r\n<li><strong>Loại kết nối:</strong>&nbsp;USB</li>\r\n<li><strong>Chất liệu:</strong>&nbsp;Nhựa ABS bền bỉ</li>\r\n<li data-spm-anchor-id=\"a2o4n.pdp_revamp.product_detail.i7.64e040d72LXBpU\"><strong>Đ&egrave;n Led:</strong>&nbsp;LED RGB 16 triệu m&agrave;u</li>\r\n<li><strong>K&iacute;ch thước:</strong>&nbsp;12 x 6.2 x 4cm</li>\r\n<li><strong>C&acirc;n nặng:</strong>&nbsp;172 gram</li>\r\n<li><strong>M&agrave;u sắc:</strong>&nbsp;<strong>Trắng | Xanh L&aacute; | Hồng | Xanh Dương</strong></li>\r\n</ul>','uploads/products/1735207797_anh-3-1.png','public',0,5,'2024-12-26 03:09:57','2025-01-02 02:09:55'),(13,'CHUỘT GAMING LANGTU G3',355000,100,'cái',0,0,'<h4>CHI TIẾT VỀ CHUỘT GAMING LANGTU G3:</h4>\r\n<ul>\r\n<li>Sản phẩm chuột m&aacute;y t&iacute;nh Gaming Langtu G3 l&agrave; d&ograve;ng phụ kiện pc đa năng c&oacute; thể sử dụng mượt m&agrave; trong hầu hết c&aacute;c t&aacute;c vụ cơ bản như: chơi game, l&agrave;m việc văn ph&ograve;ng, giải tr&iacute; lướt web,&hellip; với độ mượt tốt v&agrave; nhanh nhạy với c&aacute;c thao t&aacute;c sử dụng.</li>\r\n<li>Chuột m&aacute;y t&iacute;nh Langtu c&oacute; hỗ trợ lập tr&igrave;nh marco cho trải nghiệm game thể thao điện tử mượt m&agrave;, chuột được ưa th&iacute;ch sử dụng trong nhiều d&ograve;ng game v&agrave; cho phản ứng tốt như li&ecirc;n minh huyền thoại, pubg,&hellip; v&agrave; nhiều d&ograve;ng game online, offiline kh&aacute;c.</li>\r\n<li>Chuột Langtu ch&iacute;nh h&atilde;ng c&oacute; hệ thống đ&egrave;n led c&oacute; hiệu ứng v&ocirc; c&ugrave;ng bắt mắt n&ecirc;n ngo&agrave;i t&aacute;c dụng để dử dụng như 1 phụ kiện m&aacute;y t&iacute;nh, G3 l&agrave; lựa chọn tốt cho 1 vật dụng decor trang tr&iacute; ph&ograve;ng l&agrave;m việc, g&oacute;c l&agrave;m việc.</li>\r\n<li>Chuột m&aacute;y t&iacute;nh c&oacute; d&acirc;y l&agrave; d&ograve;ng chuột tiện lợi bởi kh&ocirc;ng cần lo sạc pin, mua pin, chỉ cần cắm v&agrave; sử dụng, độ bền v&agrave; khả năng kết nối c&ugrave;ng nhanh nhạy hơn.</li>\r\n<li>Chuột gaming G3 Langtu được thiết kế v&ocirc; c&ugrave;ng tỉ mỉ, c&aacute;c chi tiết nhỏ như n&uacute;t bấm, con lăn, n&uacute;t điều chỉnh DPI, đệm chống trượt, chống sốc đều được chau chuốt cẩn thận cho ra sản phẩm ho&agrave;n thiện từ thiết kế tới độ bền.</li>\r\n</ul>\r\n<h4>LƯU &Yacute; KHI MUA H&Agrave;NG:</h4>\r\n<ul>\r\n<li>Sản phẩm như ảnh v&agrave; m&ocirc; tả 100%</li>\r\n<li>Sản phẩm được kiểm tra kỹ c&agrave;ng v&agrave; đ&oacute;ng g&oacute;i cẩn thận trước khi gửi đi</li>\r\n<li>Khi c&oacute; vấn đề về đơn h&agrave;ng hay cần tư vấn về sản phẩm, đừng ngần ngại inbox ngay cho shop để được giải quyết nhanh ch&oacute;ng!</li>\r\n<li>Khi nhận h&agrave;ng c&aacute;c bạn h&atilde;y quay video mở h&agrave;ng để đảm bảo quyền lợi nếu c&oacute; sự cố kh&ocirc;ng may xảy ra.</li>\r\n<li>Shop sẽ cố gắng nhất c&oacute; thể để giảm thiểu rủi ro đ&egrave;n bị lỗi hoặc nh&acirc;n vi&ecirc;n g&oacute;i h&agrave;ng g&oacute;i sai/ thiếu sản phẩm. Nhưng nếu bạn gặp phải trường hợp n&agrave;y xin đừng vội đ&aacute;nh gi&aacute; xấu, h&atilde;y nhắn tin cho shop sẽ hỗ trợ bảo h&agrave;nh miễn ph&iacute; 100% cho bạn.</li>\r\n<li>H&atilde;y li&ecirc;n hệ với shop nếu như sản phẩm c&oacute; lỗi, bọn m&igrave;nh sẽ lu&ocirc;n chăm s&oacute;c kh&aacute;ch h&agrave;ng một c&aacute;ch nhiệt t&igrave;nh nhất.</li>\r\n<li>C&aacute;c bạn nhận được sản phẩm, vui l&ograve;ng đ&aacute;nh gi&aacute; gi&uacute;p Shop để hưởng th&ecirc;m nhiều ưu đ&atilde;i hơn nh&eacute;.</li>\r\n</ul>','<ul>\r\n<li><strong>Thương hiệu:</strong>&nbsp;Langtu &ndash; ch&iacute;nh h&atilde;ng full box</li>\r\n<li><strong>Loại chuột:</strong>&nbsp;Chuột Gaming, Phong c&aacute;ch Gundam</li>\r\n<li><strong>Số n&uacute;t:</strong>&nbsp;09</li>\r\n<li><strong>Tốc độ (DPI):</strong>&nbsp;6 nấc DPI L&ecirc;n đến 12.800 DPI</li>\r\n<li><strong>Loại kết nối:</strong>&nbsp;USB</li>\r\n<li><strong>Chất liệu:</strong>&nbsp;Nhựa ABS bền bỉ &ndash; C&oacute; viền kim loại</li>\r\n<li data-spm-anchor-id=\"a2o4n.pdp_revamp.product_detail.i7.64e040d72LXBpU\"><strong>Đ&egrave;n Led:</strong>&nbsp;LED RGB 16 triệu m&agrave;u</li>\r\n<li><strong>K&iacute;ch thước:</strong>&nbsp;127 x 83 x 44mm</li>\r\n<li><strong>C&acirc;n nặng:</strong>&nbsp;248 gram</li>\r\n<li><strong>M&agrave;u sắc:</strong>&nbsp;<strong>V&agrave;ng (C&oacute; D&acirc;y) | Xanh (Kh&ocirc;ng D&acirc;y)</strong></li>\r\n</ul>','uploads/products/1735207942_anh-2-1-600x600.png','public',0,5,'2024-12-26 03:12:22','2024-12-26 03:12:22'),(14,'CHUỘT SILENT LANGTU T4',199000,100,'cái',0,0,'<h4>CHI TIẾT VỀ CHUỘT SILENT LANGTU T4:</h4>\r\n<ul>\r\n<li>Sản phẩm chuột m&aacute;y t&iacute;nh Gaming Silent Langtu T4 l&agrave; d&ograve;ng phụ kiện pc đa năng c&oacute; thể sử dụng mượt m&agrave; trong hầu hết c&aacute;c t&aacute;c vụ cơ bản như: chơi game, l&agrave;m việc văn ph&ograve;ng, giải tr&iacute; lướt web,&hellip; với độ mượt tốt v&agrave; nhanh nhạy với c&aacute;c thao t&aacute;c sử dụng.</li>\r\n<li>Chuột m&aacute;y t&iacute;nh Langtu T4 gi&uacute;p cho trải nghiệm game thể thao điện tử mượt m&agrave;, chuột được ưa th&iacute;ch sử dụng trong nhiều d&ograve;ng game v&agrave; cho phản ứng tốt như li&ecirc;n minh huyền thoại, pubg,&hellip; v&agrave; nhiều d&ograve;ng game online, offiline kh&aacute;c.</li>\r\n<li>Chuột Langtu ch&iacute;nh h&atilde;ng c&oacute; t&iacute;nh năng Silent (kh&ocirc;ng tiếng click) rất ph&ugrave; hợp với anh em văn ph&ograve;ng v&agrave; những người thường sử dụng chuột nơi c&ocirc;ng cộng hoặc v&agrave;o ban đ&ecirc;m</li>\r\n<li>Chuột m&aacute;y t&iacute;nh c&oacute; d&acirc;y l&agrave; d&ograve;ng chuột tiện lợi bởi kh&ocirc;ng cần lo sạc pin, mua pin, chỉ cần cắm v&agrave; sử dụng, độ bền v&agrave; khả năng kết nối c&ugrave;ng nhanh nhạy hơn.</li>\r\n<li>Chuột gaming T4 Langtu được thiết kế v&ocirc; c&ugrave;ng tỉ mỉ, c&aacute;c chi tiết nhỏ như n&uacute;t bấm, con lăn, n&uacute;t điều chỉnh DPI, đệm chống trượt, chống sốc đều được chau chuốt cẩn thận cho ra sản phẩm ho&agrave;n thiện từ thiết kế tới độ bền.</li>\r\n</ul>\r\n<h4>LƯU &Yacute; KHI MUA H&Agrave;NG:</h4>\r\n<ul>\r\n<li>Sản phẩm như ảnh v&agrave; m&ocirc; tả 100%</li>\r\n<li>Sản phẩm được kiểm tra kỹ c&agrave;ng v&agrave; đ&oacute;ng g&oacute;i cẩn thận trước khi gửi đi</li>\r\n<li>Khi c&oacute; vấn đề về đơn h&agrave;ng hay cần tư vấn về sản phẩm, đừng ngần ngại inbox ngay cho shop để được giải quyết nhanh ch&oacute;ng!</li>\r\n<li>Khi nhận h&agrave;ng c&aacute;c bạn h&atilde;y quay video mở h&agrave;ng để đảm bảo quyền lợi nếu c&oacute; sự cố kh&ocirc;ng may xảy ra.</li>\r\n<li>Shop sẽ cố gắng nhất c&oacute; thể để giảm thiểu rủi ro đ&egrave;n bị lỗi hoặc nh&acirc;n vi&ecirc;n g&oacute;i h&agrave;ng g&oacute;i sai/ thiếu sản phẩm. Nhưng nếu bạn gặp phải trường hợp n&agrave;y xin đừng vội đ&aacute;nh gi&aacute; xấu, h&atilde;y nhắn tin cho shop sẽ hỗ trợ bảo h&agrave;nh miễn ph&iacute; 100% cho bạn.</li>\r\n<li>H&atilde;y li&ecirc;n hệ với shop nếu như sản phẩm c&oacute; lỗi, bọn m&igrave;nh sẽ lu&ocirc;n chăm s&oacute;c kh&aacute;ch h&agrave;ng một c&aacute;ch nhiệt t&igrave;nh nhất.</li>\r\n<li>C&aacute;c bạn nhận được sản phẩm, vui l&ograve;ng đ&aacute;nh gi&aacute; gi&uacute;p Shop để hưởng th&ecirc;m nhiều ưu đ&atilde;i hơn nh&eacute;.</li>\r\n</ul>','<ul>\r\n<li><strong>Thương hiệu:</strong>&nbsp;Langtu &ndash; ch&iacute;nh h&atilde;ng full box &ndash; BH 03 Th&aacute;ng, bảo h&agrave;nh 1 đổi 1 trong v&ograve;ng 03 ng&agrave;y duy nhất tại Zgaming.vn</li>\r\n<li><strong>Loại chuột:</strong>&nbsp;Chuột gaming, chuột văn ph&ograve;ng (silent &ndash; kh&ocirc;ng tiếng click)</li>\r\n<li><strong>Số n&uacute;t:</strong>&nbsp;02</li>\r\n<li><strong>Tốc độ (DPI):</strong>&nbsp;1.000 DPI</li>\r\n<li><strong>Loại kết nối:</strong>&nbsp;USB</li>\r\n<li><strong>Chất liệu:</strong>&nbsp;Nhựa ABS bền bỉ &ndash; Bề mặt nh&aacute;m</li>\r\n<li data-spm-anchor-id=\"a2o4n.pdp_revamp.product_detail.i7.64e040d72LXBpU\"><strong>Chuyển động:&nbsp;</strong>Quang học</li>\r\n<li><strong>K&iacute;ch thước:</strong>&nbsp;11.5 x 6.5 x 3 cm</li>\r\n<li><strong>C&acirc;n nặng:</strong>&nbsp;80 gram</li>\r\n<li><strong>M&agrave;u sắc:</strong>&nbsp;<strong>Đen | Trắng</strong></li>\r\n</ul>','uploads/products/1735208089_anh-8-600x600.png','public',0,5,'2024-12-26 03:14:49','2024-12-26 03:14:49'),(15,'KÊ TAY BÀN PHÍM SILICON – NHIỀU MẪU',148000,100,'cái',0,0,'<h4>V&Igrave; SAO N&Ecirc;N MUA SẢN PHẨM K&Ecirc; TAY B&Agrave;N PH&Iacute;M SILICON &ndash; NHIỀU MẪU TẠI ZGAMING?</h4>\r\n<ul>\r\n<li>CAM KẾT H&Agrave;NG CAO CẤP 100%</li>\r\n<li>BẢO H&Agrave;NH 24 Th&aacute;ng &ndash; 1 ĐỔI 1 TRONG 07 NG&Agrave;Y ĐẦU do lỗi NSX</li>\r\n<li>Quy tr&igrave;nh kiểm tra cẩn thận v&agrave; cam kết bảo h&agrave;nh 1 đổi 1 duy nhất tại Zgaming.vn</li>\r\n<li>C&aacute;c sản phẩm dễ vỡ sẽ được đ&oacute;ng g&oacute;i cẩn thận bằng t&uacute;i b&oacute;ng kh&iacute; chống sốc v&agrave; hộp carton 3 lớp nhằm hạn chế tối đa trường hợp lỗi do qu&aacute; tr&igrave;nh vận chuyển.</li>\r\n<li>Ch&uacute;ng t&ocirc;i biết qu&yacute; kh&aacute;ch c&oacute; nhiều lựa chọn nhưng vẫn lựa chọn Zgaming. Một lần nữa Zgaming xin ch&acirc;n th&agrave;nh cảm ơn qu&yacute; kh&aacute;ch đ&atilde; tin tưởng lựa chọn v&agrave; ủng hộ shop.</li>\r\n<li>Giao h&agrave;ng tốc h&agrave;nh 1-3 ng&agrave;y</li>\r\n<li>Giao h&agrave;ng Hoả Tốc nội th&agrave;nh TP HCM trong v&ograve;ng 1 giờ</li>\r\n</ul>\r\n<h4>LƯU &Yacute; KHI MUA H&Agrave;NG:</h4>\r\n<ul>\r\n<li>Khi nhận h&agrave;ng c&aacute;c bạn h&atilde;y quay video mở h&agrave;ng để đảm bảo quyền lợi nếu c&oacute; sự cố kh&ocirc;ng may xảy ra.</li>\r\n<li>H&atilde;y chắc chắn rằng đ&egrave;n hoạt động b&igrave;nh thường trước khi b&oacute;c lớp băng d&iacute;nh 2 mặt.</li>\r\n<li>Đ&egrave;n n&agrave;y c&oacute; thể cắt, tuy nhi&ecirc;n đoạn n&agrave;o nối điện mới s&aacute;ng được (v&agrave;i bạn ko hiểu về điện cắt th&agrave;nh nhiều mảnh nhỏ xong ko nối điện n&oacute; kh&ocirc;ng s&aacute;ng lại nhắn tin bảo shop l,ừa đả,o)</li>\r\n<li>Shop sẽ cố gắng nhất c&oacute; thể để giảm thiểu rủi ro đ&egrave;n bị lỗi hoặc nh&acirc;n vi&ecirc;n g&oacute;i h&agrave;ng g&oacute;i sai/ thiếu sản phẩm. Nhưng nếu bạn gặp phải trường hợp n&agrave;y xin đừng vội đ&aacute;nh gi&aacute; xấu, h&atilde;y nhắn tin cho shop sẽ hỗ trợ bảo h&agrave;nh miễn ph&iacute; 100% cho bạn.</li>\r\n<li>H&atilde;y li&ecirc;n hệ với shop nếu như sản phẩm c&oacute; lỗi, bọn m&igrave;nh sẽ lu&ocirc;n chăm s&oacute;c kh&aacute;ch h&agrave;ng một c&aacute;ch nhiệt t&igrave;nh nhất.</li>\r\n<li>C&aacute;c bạn nhận được sản phẩm, vui l&ograve;ng đ&aacute;nh gi&aacute; gi&uacute;p Shop để hưởng th&ecirc;m nhiều ưu đ&atilde;i hơn nh&eacute;.</li>\r\n</ul>','<ul>\r\n<li>T&ecirc;n sản phẩm: K&Ecirc; TAY B&Agrave;N PH&Iacute;M SILICON h&igrave;nh Corgi, Husky, Poodle, Bulldog cực cute v&agrave; dễ thương</li>\r\n<li>Bề mặt Vải lụa sữa (Milk Silk Fabric) kết hợp c&ugrave;ng đệm Silicon cực kỳ &ecirc;m &aacute;i, th&iacute;ch hợp cho c&aacute;c bạn hay d&ugrave;ng vi t&iacute;nh, chống đau cổ tay.</li>\r\n<li>Đế miếng k&ecirc; tay chống trượt cực tốt.</li>\r\n<li>K&iacute;ch thước:<br>+ 44x8cm (d&agrave;nh cho b&agrave;n ph&iacute;m full 104 n&uacute;t)<br>+ 36x8cm (d&agrave;nh cho b&agrave;n ph&iacute;m 87 n&uacute;t )<br>+ D&agrave;y 1.8cm</li>\r\n</ul>','uploads/products/1735208295_ZG050-Ke-tay-ban-phim-silicon-Co.png','public',0,6,'2024-12-26 03:18:15','2024-12-26 03:18:15'),(16,'LÓT CHUỘT GAMING CỠ LỚN',125000,100,'cái',0,0,'<h4>M&Ocirc; TẢ SẢN PHẨM L&Oacute;T CHUỘT GAMING CỠ LỚN 80X30 | 90X40 D&Agrave;Y 4MM</h4>\r\n<ul>\r\n<li>T&ecirc;n sản phẩm: L&Oacute;T CHUỘT GAMING CỠ LỚN</li>\r\n<li>Chất liệu: Cao su &ndash; mặt trơn &ndash; đế chống trượt</li>\r\n<li>Hoa văn: Tối giản (phong c&aacute;ch GAMING)</li>\r\n<li>Bề mặt l&oacute;t chuột cực kỳ &ecirc;m &aacute;i, th&iacute;ch hợp cho c&aacute;c bạn hay d&ugrave;ng vi t&iacute;nh, chống đau cổ tay.</li>\r\n<li>Mặt đ&aacute;y chống trượt cực tốt: được thiết kế bằng cao su tự nhi&ecirc;n với c&aacute;c đường chống trượt b&aacute;m rất tốt với mặt b&agrave;n</li>\r\n<li>K&iacute;ch thước:<br>+ 80x30x4mm (loại lớn ph&ugrave; hợp b&agrave;n 1m2-1m6)<br>+ 90x40x4mm (loại lớn ph&ugrave; hợp b&agrave;n 1m6+)</li>\r\n<li>\r\n<p><strong>T&Iacute;NH NĂNG SẢN PHẨM</strong></p>\r\n<p>&ndash; Th&iacute;ch hợp với hầu hết tất cả c&aacute;c loại chuột, b&agrave;n ph&iacute;m.<br>&ndash; Mặt đ&aacute;y được thiết kế bằng cao su tự nhi&ecirc;n với c&aacute;c đường chống trượt b&aacute;m rất tốt với mặt b&agrave;n<br>&ndash; Bo viền t&iacute;nh tế chống r&aacute;ch v&agrave; cong v&ecirc;nh, bọc viền d&agrave;y c&oacute; Led quanh viền<br>&ndash; Trang tr&iacute; cho g&oacute;c Gaming, b&agrave;n l&agrave;m việc<br>&ndash; Độ d&agrave;y 4mm cho cảm gi&aacute;c &ecirc;m &aacute;i khi sử dụng.<br>&ndash; C&oacute; thể sử dụng với chuột quang, chuột bi v&agrave; hầu hết c&aacute;c loại chuột laser th&ocirc;ng dụng. T&iacute;nh năng n&agrave;y gi&uacute;p bạn sử dụng sản phẩm hiệu quả hơn v&agrave; kh&ocirc;ng phải thay mới khi thay đổi loại chuột m&aacute;y t&iacute;nh.</p>\r\n</li>\r\n</ul>','<ul>\r\n<li>Chất liệu: Cao su &ndash; mặt trơn &ndash; đế chống trượt</li>\r\n<li>K&iacute;ch thước:<br>+ 80x30x4mm<br>+ 90x40x4mm</li>\r\n</ul>','uploads/products/1735208461_anh-1-600x600.png','public',0,6,'2024-12-26 03:21:01','2024-12-26 03:21:01'),(17,'LÓT CHUỘT LED RGB CỠ LỚN 80X30 | 90X40 DÀY 4MM',235000,100,'cái',0,0,'<h4>M&Ocirc; TẢ SẢN PHẨM L&Oacute;T CHUỘT LED RGB CỠ LỚN 80X30 | 90X40 D&Agrave;Y 4MM</h4>\r\n<ul>\r\n<li>T&ecirc;n sản phẩm: L&Oacute;T CHUỘT LED RGB CỠ LỚN</li>\r\n<li>Chất liệu: Cao su &ndash; mặt trơn &ndash; đế chống trượt</li>\r\n<li>M&agrave;u Sắc: Led RGB</li>\r\n<li>Bề mặt l&oacute;t chuột cực kỳ &ecirc;m &aacute;i, th&iacute;ch hợp cho c&aacute;c bạn hay d&ugrave;ng vi t&iacute;nh, chống đau cổ tay.</li>\r\n<li>Mặt đ&aacute;y chống trượt cực tốt: được thiết kế bằng cao su tự nhi&ecirc;n với c&aacute;c đường chống trượt b&aacute;m rất tốt với mặt b&agrave;n</li>\r\n<li>K&iacute;ch thước:<br>+ 80x30x4mm (loại lớn ph&ugrave; hợp b&agrave;n 1m2-1m6)<br>+ 90x40x4mm (loại lớn ph&ugrave; hợp b&agrave;n 1m6+)<br>+ 35x25x4mm (loại nhỏ d&ugrave;ng l&oacute;t chuột)</li>\r\n<li>LƯU &Yacute;: sản phẩm của Zgaming c&oacute; [ĐỘ DẦY 4MM] Dầy dặn, chắc chắn kh&aacute;c biệt hẳn so với c&aacute;c sản phẩm gi&aacute; rẻ tr&ecirc;n thị trường.<br>Shop cam kết ho&agrave;n trả tiền x2 nếu sản phẩm kh&ocirc;ng đ&uacute;ng như lời khẳng định v&agrave; khiến qu&yacute; kh&aacute;ch kh&ocirc;ng h&agrave;i l&ograve;ng.</li>\r\n</ul>\r\n<p><strong>T&Iacute;NH NĂNG SẢN PHẨM</strong></p>\r\n<p>&ndash; Th&iacute;ch hợp với hầu hết tất cả c&aacute;c loại chuột, b&agrave;n ph&iacute;m.<br>&ndash; Mặt đ&aacute;y được thiết kế bằng cao su tự nhi&ecirc;n với c&aacute;c đường chống trượt b&aacute;m rất tốt với mặt b&agrave;n<br>&ndash; Bo viền t&iacute;nh tế chống r&aacute;ch v&agrave; cong v&ecirc;nh, bọc viền d&agrave;y c&oacute; Led quanh viền<br>&ndash; Trang tr&iacute; cho g&oacute;c Gaming, b&agrave;n l&agrave;m việc<br>&ndash; Độ d&agrave;y 4mm cho cảm gi&aacute;c &ecirc;m &aacute;i khi sử dụng.<br>&ndash; C&oacute; thể sử dụng với chuột quang, chuột bi v&agrave; hầu hết c&aacute;c loại chuột laser th&ocirc;ng dụng. T&iacute;nh năng n&agrave;y gi&uacute;p bạn sử dụng sản phẩm hiệu quả hơn v&agrave; kh&ocirc;ng phải thay mới khi thay đổi loại chuột m&aacute;y t&iacute;nh.</p>','<ul>\r\n<li>T&ecirc;n sản phẩm: L&Oacute;T CHUỘT LED RGB CỠ LỚN</li>\r\n<li>Chất liệu: Cao su &ndash; mặt trơn &ndash; đế chống trượt</li>\r\n<li>M&agrave;u Sắc: Led RGB</li>\r\n<li>Bề mặt l&oacute;t chuột cực kỳ &ecirc;m &aacute;i, th&iacute;ch hợp cho c&aacute;c bạn hay d&ugrave;ng vi t&iacute;nh, chống đau cổ tay.</li>\r\n<li>Mặt đ&aacute;y chống trượt cực tốt: được thiết kế bằng cao su tự nhi&ecirc;n với c&aacute;c đường chống trượt b&aacute;m rất tốt với mặt b&agrave;n</li>\r\n<li>K&iacute;ch thước:<br>+ 80x30x4mm (loại lớn ph&ugrave; hợp b&agrave;n 1m2-1m6)<br>+ 90x40x4mm (loại lớn ph&ugrave; hợp b&agrave;n 1m6+)<br>+ 35x25x4mm (loại nhỏ d&ugrave;ng l&oacute;t chuột)</li>\r\n</ul>','uploads/products/1735208665_anh-5-0600x600.png','public',0,6,'2024-12-26 03:24:25','2024-12-26 03:24:25'),(18,'LÓT CHUỘT MINIMALISM CỠ LỚN',125000,100,'cái',0,0,'<h4>M&Ocirc; TẢ SẢN PHẨM L&Oacute;T CHUỘT MINIMALISM CỠ LỚN 80X30 | 90X40 D&Agrave;Y 4MM</h4>\r\n<ul>\r\n<li>T&ecirc;n sản phẩm: L&Oacute;T CHUỘT MINIMALISM CỠ LỚN</li>\r\n<li>Chất liệu: Cao su &ndash; mặt trơn &ndash; đế chống trượt</li>\r\n<li>Hoa văn: Tối giản (phong c&aacute;ch tối giản Nhật Bản &ndash; Minimalism)</li>\r\n<li>Bề mặt l&oacute;t chuột cực kỳ &ecirc;m &aacute;i, th&iacute;ch hợp cho c&aacute;c bạn hay d&ugrave;ng vi t&iacute;nh, chống đau cổ tay.</li>\r\n<li>Mặt đ&aacute;y chống trượt cực tốt: được thiết kế bằng cao su tự nhi&ecirc;n với c&aacute;c đường chống trượt b&aacute;m rất tốt với mặt b&agrave;n</li>\r\n<li>K&iacute;ch thước:<br>+ 80x30x4mm (loại lớn ph&ugrave; hợp b&agrave;n 1m2-1m6)<br>+ 90x40x4mm (loại lớn ph&ugrave; hợp b&agrave;n 1m6+)</li>\r\n</ul>','<ul>\r\n<li>Chất liệu: Cao su &ndash; mặt trơn &ndash; đế chống trượtM&agrave;u Sắc: Led RGB</li>\r\n<li>K&iacute;ch thước:<br>+ 80x30x4mm<br>+ 90x40x4mm</li>\r\n</ul>','uploads/products/1735208862_anh-4-1-600x600.png','public',0,6,'2024-12-26 03:27:42','2024-12-26 03:27:42'),(19,'LÓT CHUỘT SILICON 3D – NHIỀU MẪU',169000,100,'cái',0,0,'<h4>M&Ocirc; TẢ SẢN PHẨM L&Oacute;T CHUỘT SILICON 3D &ndash; NHIỀU MẪU:</h4>\r\n<ul>\r\n<li>T&ecirc;n sản phẩm: L&oacute;t chuột 3D h&igrave;nh Corgi, Husky, Poodle, Bulldog.</li>\r\n<li>Bề mặt l&oacute;t chuột cực kỳ &ecirc;m &aacute;i, th&iacute;ch hợp cho c&aacute;c bạn hay d&ugrave;ng vi t&iacute;nh, chống đau cổ tay.</li>\r\n<li>Đế l&oacute;t chuột chống trượt cực tốt.</li>\r\n<li>Chất liệu: Vải lụa sữa (Milk Silk Fabric), đệm Silicon mềm mại, chống mỏi tay khi l&agrave;m việc</li>\r\n<li>K&iacute;ch thước: 27*21*2.5CM (+-10%)</li>\r\n<li>\r\n<h4>V&Igrave; SAO N&Ecirc;N MUA L&Oacute;T CHUỘT SILICON 3D TẠI ZGAMING?</h4>\r\n<ul>\r\n<li>CAM KẾT H&Agrave;NG CAO CẤP 100%</li>\r\n<li>BẢO H&Agrave;NH 24 Th&aacute;ng &ndash; 1 ĐỔI 1 TRONG 07 NG&Agrave;Y ĐẦU do lỗi NSX</li>\r\n<li>Quy tr&igrave;nh kiểm tra cẩn thận v&agrave; cam kết bảo h&agrave;nh 1 đổi 1 duy nhất tại Zgaming.vn</li>\r\n<li>C&aacute;c sản phẩm dễ vỡ sẽ được đ&oacute;ng g&oacute;i cẩn thận bằng t&uacute;i b&oacute;ng kh&iacute; chống sốc v&agrave; hộp carton 3 lớp nhằm hạn chế tối đa trường hợp lỗi do qu&aacute; tr&igrave;nh vận chuyển.</li>\r\n<li>Ch&uacute;ng t&ocirc;i biết qu&yacute; kh&aacute;ch c&oacute; nhiều lựa chọn nhưng vẫn lựa chọn Zgaming. Một lần nữa Zgaming xin ch&acirc;n th&agrave;nh cảm ơn qu&yacute; kh&aacute;ch đ&atilde; tin tưởng lựa chọn v&agrave; ủng hộ shop.</li>\r\n<li>Giao h&agrave;ng tốc h&agrave;nh 1-3 ng&agrave;y</li>\r\n<li>Giao h&agrave;ng Hoả Tốc nội th&agrave;nh TP HCM trong v&ograve;ng 1 giờ</li>\r\n</ul>\r\n</li>\r\n</ul>','<ul>\r\n<li>T&ecirc;n sản phẩm: L&oacute;t chuột 3D h&igrave;nh Corgi, Husky, Poodle, Bulldog.</li>\r\n<li>Bề mặt l&oacute;t chuột cực kỳ &ecirc;m &aacute;i, th&iacute;ch hợp cho c&aacute;c bạn hay d&ugrave;ng vi t&iacute;nh, chống đau cổ tay.</li>\r\n<li>Chất liệu: Vải lụa sữa (Milk Silk Fabric), đệm Silicon mềm mại, chống mỏi tay khi l&agrave;m việc</li>\r\n<li>K&iacute;ch thước: 27 x 21 x 2.5CM</li>\r\n</ul>','uploads/products/1735209043_anh-2-6000x600.png','public',0,6,'2024-12-26 03:30:43','2024-12-26 03:30:43'),(20,'ĐỒNG HỒ LẬT SỐ DECOR FLIP CLOCK',599000,100,'cái',0,0,'<p><strong>M&Ocirc; TẢ SẢN PHẨM &ndash; ĐỒNG HỒ LẬT SỐ DECOR FLIP CLOCK</strong></p>\r\n<ul>\r\n<li>Đồng hồ trang tr&iacute; để b&agrave;n lật số phong c&aacute;ch cổ điển Retro</li>\r\n<li>Chất liệu: Đồng hồ lật để b&agrave;n retro được chế tạo ho&agrave;n to&agrave;n từ th&eacute;p kh&ocirc;ng gỉ, kết hợp c&aacute;c bảng số lật l&agrave;m từ chất liệu acrylic si&ecirc;u bền, chuyển động trực tiếp bằng cơ học</li>\r\n<li>K&iacute;ch thước: 195mm x 170 mm</li>\r\n<li>Trọng lượng: 0,8kg</li>\r\n<li>Thiết kế dạng lật theo từng ph&uacute;t v&agrave; từng giờ với định dạng AM (s&aacute;ng) v&agrave; PM (Chiều)</li>\r\n<li>Thiết kế th&acirc;n bằng kim loại th&eacute;p kh&ocirc;ng gỉ</li>\r\n<li>LƯU &Yacute;: Sản phẩm được tặng k&egrave;m 1 pin đại nh&eacute;</li>\r\n</ul>','<ul>\r\n<li>K&iacute;ch thước: 195mm x 170 mm</li>\r\n<li>Trọng lượng: 0,8kg</li>\r\n<li>Thiết kế dạng lật theo từng ph&uacute;t v&agrave; từng giờ với định dạng AM (s&aacute;ng) v&agrave; PM (Chiều)</li>\r\n</ul>','uploads/products/1735209228_avatar.jpg-600x600.png','public',0,11,'2024-12-26 03:33:48','2024-12-26 03:56:35'),(21,'ĐỒNG HỒ DECOR DIVOOM TIMES GATE',2348000,100,'cái',0,0,'<p><strong>#H&Agrave;NG&nbsp;ĐẶT&nbsp;TRƯỚC&nbsp;12&nbsp;NG&Agrave;Y</strong></p>\r\n<p><strong>M&Ocirc; TẢ SẢN PHẨM &ndash; ĐỒNG HỒ DECOR DIVOOM TIMES GATE</strong></p>\r\n<ul>\r\n<li>Thiết kế nghệ thuật pixel độc đ&aacute;o</li>\r\n<li>M&agrave;n h&igrave;nh chất lượng cao: Với m&agrave;n h&igrave;nh IPS 128*128,</li>\r\n<li>M&agrave;n h&igrave;nh với c&aacute;c điều khiển điều chỉnh độ s&aacute;ng v&agrave; &acirc;m lượng qua app dễ d&agrave;ng.</li>\r\n<li>Đồng hồ kỹ thuật số Divoom Times Gate-Cyberpunk</li>\r\n<li>S&aacute;ng tạo nghệ thuật Pixel</li>\r\n<li>Trợ l&yacute; cuộc sống th&ocirc;ng minh</li>\r\n<li>Đồng hồ pixel</li>\r\n<li>Trang tr&iacute; thiết lập tr&ograve; chơi</li>\r\n<li>M&oacute;n qu&agrave; th&acirc;n mật &amp; ho&agrave;n hảo</li>\r\n<li>Bảo h&agrave;nh: 12 Th&aacute;ng, bảo h&agrave;nh 1 đổi 1 trong v&ograve;ng 03 ng&agrave;y duy nhất tại Zgaming.vn</li>\r\n</ul>\r\n<p><strong>BỘ SẢN PHẨM GỒM C&Oacute;:</strong></p>\r\n<ul>\r\n<li>01 Cổng Thời Đại</li>\r\n<li>01 C&aacute;p USB-C</li>\r\n<li>01 Hộp bao b&igrave; tinh tế</li>\r\n<li>01 Hướng dẫn sử dụng</li>\r\n</ul>','<ul>\r\n<li>Thiết kế nghệ thuật pixel độc đ&aacute;o</li>\r\n<li>M&agrave;n h&igrave;nh chất lượng cao: Với m&agrave;n h&igrave;nh IPS 128*128,</li>\r\n<li>M&agrave;n h&igrave;nh với c&aacute;c điều khiển điều chỉnh độ s&aacute;ng v&agrave; &acirc;m lượng qua app dễ d&agrave;ng.</li>\r\n</ul>','uploads/products/1735209446_anh-6-6-600x6020.png','public',0,11,'2024-12-26 03:37:26','2024-12-26 03:56:25'),(22,'GIÁ TREO TAI NGHE FULL LED – NHÁY THEO NHẠC (LOẠI CAO CẤP)',148000,100,'cái',0,0,'<p><strong>M&Ocirc; TẢ SẢN PHẨM:</strong><br>&ndash; T&ecirc;n sản phẩm: Gi&aacute; Treo Tai Nghe Led RGB Cao Cấp Nh&aacute;y Theo Nhạc, cảm biến &acirc;m thanh si&ecirc;u nhạy, c&oacute; ch&acirc;n đế v&agrave; gi&aacute; treo tai nghe<br>C&ocirc;ng dụng: Trang tr&iacute; b&agrave;n gaming, g&oacute;c l&agrave;m việc v&agrave; tr&ecirc;n xe &ocirc; t&ocirc;&hellip;<br>&ndash; T&iacute;nh năng đặc biệt:<br>+ Nhiều chế độ nh&aacute;y đ&egrave;n: 08 chế độ hiển thị v&agrave; hơn 60 sự kết hợp m&agrave;u sắc<br>+ Đ&oacute;n micro &amp; lọc tiếng ồn<br>+ Ph&ugrave; hợp treo hầu hết c&aacute;c loại tai nghe tr&ecirc;n thị trường<br>+ Nguồn Cắm d&acirc;y sạc micro usb trực tiếp &ndash; Micro-USB ph&ugrave; hợp điện &aacute;p&nbsp;DC 5V (&ge;1A)<br>+ K&iacute;ch thước: 110 x 30 x 212mm<br>+ Trọng lượng: 100g</p>\r\n<p><strong>GI&Aacute; TREO TAI NGHE LED RGB CAO CẤP NH&Aacute;Y THEO NHẠC CỦA ZGAMING C&Oacute; G&Igrave; KH&Aacute;C BIỆT?</strong><br>Anh em lưu &yacute; thanh Led của Shop l&agrave; loại đế treo cao cấp kh&aacute;c với c&aacute;c loại đ&egrave;n led rẻ tiền tr&ecirc;n thị trường.<br>&ndash; H&igrave;nh ảnh h&oacute;a &acirc;m nhạc sống động.<br>&ndash; Chức năng đ&oacute;n micro v&agrave; lọc tiếng ồn c&oacute; độ nhạy cao<br>&ndash; Thanh &aacute;nh s&aacute;ng &acirc;m nhạc nhiều cấp độ cung cấp 8 chế độ hiển thị v&agrave; hơn 60 sự kết hợp m&agrave;u sắc, l&agrave;m cho &acirc;m nhạc trở n&ecirc;n sống động v&ocirc; song v&agrave; ho&agrave;n thiện.<br>&ndash; Chế độ hiển thị, m&agrave;u sắc, đỉnh, độ s&aacute;ng, tốc độ, độ nhạy đều c&oacute; thể được điều chỉnh t&ugrave;y &yacute; để đ&aacute;p ứng c&aacute;c nhu cầu kh&aacute;c nhau.<br>&ndash; Một m&oacute;n qu&agrave; cho bạn b&egrave;, đồng nghiệp, người y&ecirc;u &acirc;m nhạc, nh&agrave; thiết kế, v.v., c&oacute; thể sử dụng ở nhiều nơi như LED s&acirc;n khấu DJ, trang tr&iacute; nội thất &ocirc; t&ocirc;, tiệc, lễ hội &acirc;m nhạc, h&ograve;a nhạc, v.v.</p>\r\n<p><strong>HƯỚNG DẪN SỬ DỤNG:</strong><br>1. To&agrave;n bộ m&agrave;n h&igrave;nh hiển thị được bao phủ bởi một lớp phim bảo vệ, vui l&ograve;ng th&aacute;o phim ra trước khi sử dụng.<br>2. Đ&egrave;n sử dụng nguồn DC 5V (Micro-USB), vượt qu&aacute; 5V sẽ dẫn đến hư hỏng đ&egrave;n.<br>3. D&ograve;ng điện phải lớn hơn hoặc bằng 1A để đảm bảo hiệu suất tốt nhất. Th&ocirc;ng thường d&ograve;ng điện qua cổng USB của m&aacute;y t&iacute;nh chỉ 0.5A, tốc độ lấy mẫu micro sẽ giảm xuống khi d&ograve;ng điện kh&ocirc;ng đủ.<br>4. Nếu bạn mua 2 sản phẩm trở l&ecirc;n, vui l&ograve;ng đảm bảo rằng d&ograve;ng điện của nguồn điện đủ để điều khiển tất cả c&aacute;c mức nhạc của đ&egrave;n, mỗi đ&egrave;n cần 1A.</p>','<p>&ndash; T&ecirc;n sản phẩm: Gi&aacute; Treo Tai Nghe Led RGB Cao Cấp Nh&aacute;y Theo Nhạc, cảm biến &acirc;m thanh si&ecirc;u nhạy, c&oacute; ch&acirc;n đế v&agrave; gi&aacute; treo tai nghe<br>C&ocirc;ng dụng: Trang tr&iacute; b&agrave;n gaming, g&oacute;c l&agrave;m việc v&agrave; tr&ecirc;n xe &ocirc; t&ocirc;&hellip;<br>&ndash; T&iacute;nh năng đặc biệt:<br>+ Nhiều chế độ nh&aacute;y đ&egrave;n: 08 chế độ hiển thị v&agrave; hơn 60 sự kết hợp m&agrave;u sắc<br>+ Đ&oacute;n micro &amp; lọc tiếng ồn<br>+ Ph&ugrave; hợp treo hầu hết c&aacute;c loại tai nghe tr&ecirc;n thị trường<br>+ Nguồn Cắm d&acirc;y sạc micro usb trực tiếp &ndash; Micro-USB ph&ugrave; hợp điện &aacute;p&nbsp;DC 5V (&ge;1A)<br>+ K&iacute;ch thước: 110 x 30 x 212mm<br>+ Trọng lượng: 100g</p>','uploads/products/1735209576_anh-4-600x600.png','public',0,13,'2024-12-26 03:39:36','2024-12-26 03:56:15'),(23,'THANH LED RGB NHÁY THEO NHẠC',289000,100,'cái',0,0,'<h4>M&Ocirc; TẢ SẢN PHẨM:</h4>\r\n<ul>\r\n<li>T&ecirc;n sản phẩm: Thanh đ&egrave;n Led RGB nh&aacute;y theo nhạc, cảm biến &acirc;m thanh si&ecirc;u nhạy, c&oacute; ch&acirc;n đế trang tr&iacute; b&agrave;n l&agrave;m việc, &ocirc; t&ocirc;</li>\r\n<li>C&ocirc;ng dụng: Trang tr&iacute; b&agrave;n gaming, g&oacute;c l&agrave;m việc v&agrave; tr&ecirc;n xe &ocirc; t&ocirc;&hellip;</li>\r\n<li>T&iacute;nh năng đặc biệt:<br>+ Điều khiển bằng điện thoại (APP)<br>+ T&ugrave;y chỉnh độ s&aacute;ng (20%, 40%, 70%, 100%&hellip;)<br>+ Nhiều chế độ nh&aacute;y đ&egrave;n: 08 chế độ hiển thị v&agrave; hơn 60 sự kết hợp m&agrave;u sắc<br>+ Đ&oacute;n micro &amp; lọc tiếng ồn</li>\r\n<li>Nguồn điện: Micro-USB ph&ugrave; hợp điện &aacute;p&nbsp;DC 5V (&ge;1A)</li>\r\n<li>C&ocirc;ng suất ti&ecirc;u thụ: 5W</li>\r\n<li>Chất liệu: Nhựa đ&uacute;c, chắc chắn, bền đẹp</li>\r\n<li>Phần mềm: App điều khiển m&agrave;u tr&ecirc;n th&acirc;n sản phẩm (rất dễ d&agrave;ng c&agrave;i đặt v&agrave; điều khiển)</li>\r\n<li>K&iacute;ch thước:<br>&ndash; Loại 16 nốt đ&egrave;n: 182 * 19 * 16mm<br>&ndash; Loại 64 nốt đ&egrave;n: 250 * 25 * 22mm</li>\r\n</ul>\r\n<h4>THANH LED RGB CỦA ZGAMING C&Oacute; G&Igrave; KH&Aacute;C BIỆT?</h4>\r\n<p>Anh em lưu &yacute; thanh Led của Shop l&agrave; loại 3D TR&Agrave;N VIỀN kh&aacute;c với c&aacute;c loại đ&egrave;n led rẻ tiền tr&ecirc;n thị trường.</p>\r\n<ul>\r\n<li>Với hai phi&ecirc;n bản 16 v&agrave; 64 b&oacute;ng đ&egrave;n LED nhiều m&agrave;u sắc ph&ugrave; hợp cho mọi kh&ocirc;ng gian</li>\r\n<li>H&igrave;nh ảnh h&oacute;a &acirc;m nhạc sống động.</li>\r\n<li>Chức năng đ&oacute;n micro v&agrave; lọc tiếng ồn c&oacute; độ nhạy cao</li>\r\n<li>Thanh &aacute;nh s&aacute;ng &acirc;m nhạc nhiều cấp độ cung cấp 8 chế độ hiển thị v&agrave; hơn 60 sự kết hợp m&agrave;u sắc, l&agrave;m cho &acirc;m nhạc trở n&ecirc;n sống động v&ocirc; song v&agrave; ho&agrave;n thiện.</li>\r\n<li>Chế độ hiển thị, m&agrave;u sắc, đỉnh, độ s&aacute;ng, tốc độ, độ nhạy đều c&oacute; thể được điều chỉnh t&ugrave;y &yacute; để đ&aacute;p ứng c&aacute;c nhu cầu kh&aacute;c nhau.</li>\r\n<li>Một m&oacute;n qu&agrave; cho bạn b&egrave;, đồng nghiệp, người y&ecirc;u &acirc;m nhạc, nh&agrave; thiết kế, v.v., c&oacute; thể sử dụng ở nhiều nơi như LED s&acirc;n khấu DJ, trang tr&iacute; nội thất &ocirc; t&ocirc;, tiệc, lễ hội &acirc;m nhạc, h&ograve;a nhạc, v.v.</li>\r\n</ul>','<ul>\r\n<li>C&ocirc;ng dụng: Trang tr&iacute; b&agrave;n gaming, g&oacute;c l&agrave;m việc v&agrave; tr&ecirc;n xe &ocirc; t&ocirc;&hellip;</li>\r\n<li>Nguồn điện: Micro-USB ph&ugrave; hợp điện &aacute;p&nbsp;DC 5V (&ge;1A)</li>\r\n<li>K&iacute;ch thước:<br>&ndash; Loại 16 nốt đ&egrave;n: 182 * 19 * 16mm<br>&ndash; Loại 64 nốt đ&egrave;n: 250 * 25 * 22mm</li>\r\n</ul>','uploads/products/1735209751_anh-5-600x6060.png','public',0,12,'2024-12-26 03:42:31','2024-12-26 03:56:04'),(24,'LOA BLUETOOTH DIVOOM | MÀN HÌNH PIXEL SIÊU CUTE',1350000,100,'cái',0,0,'<p><strong>#H&Agrave;NG ĐẶT TRƯỚC 9 NG&Agrave;Y</strong></p>\r\n<p><strong>M&Ocirc; TẢ SẢN PHẨM &ndash; LOA BLUETOOTH DIVOOM</strong></p>\r\n<ul>\r\n<li>K&iacute;ch thước nhỏ gọn, thiết kế m&ocirc; phỏng h&igrave;nh d&aacute;ng ch&uacute; voi nhỏ đ&aacute;ng y&ecirc;u.</li>\r\n<li>M&agrave;n h&igrave;nh LED 256 Full RGB với k&iacute;ch thước 16&times;16 Pixel hiển thị sắc n&eacute;t v&agrave; sống động</li>\r\n<li>Với thiết kế n&acirc;ng cao &acirc;m pass, &acirc;m thanh đa hướng 360&deg;</li>\r\n<li>Bộ xử l&yacute; &acirc;m thanh DSP 6W&hellip;.</li>\r\n<li>C&ocirc;ng suất 6W</li>\r\n<li>Đặt bất cứ nơi n&agrave;o bạn th&iacute;ch: văn ph&ograve;ng, ph&ograve;ng ngủ, b&agrave;n l&agrave;m việc&hellip;</li>\r\n<li>Đồng hồ hiển thị giờ &amp; b&aacute;o thức, đồng hồ bấm giờ, bảng kế hoạch / lịch, m&agrave;n h&igrave;nh hỗ trợ giấc ngủ, th&ocirc;ng b&aacute;o thời tiết, Pixel chat, Retro Pixel games&hellip;</li>\r\n<li>Tương th&iacute;ch với điện thoại v&agrave; m&aacute;y t&iacute;nh bảng iOS / Android, đồng bộ tin nhắn, cuộc gọi, tin b&aacute;o của c&aacute;c ứng dụng được c&agrave;i đặt tr&ecirc;n m&aacute;y th&ocirc;ng qua bluetooth v5.0</li>\r\n<li>Phạm vi kết nối cực rộng v&agrave; ổn định l&ecirc;n đến 10m.</li>\r\n<li>Dung lượng pin 1400mAh</li>\r\n<li>Thời gian sử dụng li&ecirc;n tục l&ecirc;n đến 6h</li>\r\n</ul>','<ul>\r\n<li>M&agrave;n h&igrave;nh LED 256 Full RGB với k&iacute;ch thước 16&times;16 Pixel hiển thị sắc n&eacute;t v&agrave; sống động</li>\r\n<li>Với thiết kế n&acirc;ng cao &acirc;m pass, &acirc;m thanh đa hướng 360&deg;</li>\r\n<li>Bộ xử l&yacute; &acirc;m thanh DSP 6W&hellip;.</li>\r\n<li>C&ocirc;ng suất 6W</li>\r\n</ul>','uploads/products/1735209888_avatar-16-600x600.png','public',0,10,'2024-12-26 03:44:48','2024-12-26 03:53:56'),(25,'Đèn Led Neon Để Bàn',199000,100,'cái',0,0,'<h4>M&Ocirc; TẢ SẢN PHẨM:</h4>\r\n<ul>\r\n<li>T&ecirc;n gọi: Đ&egrave;n Led Neon Trang Tr&iacute; Để B&agrave;n &ndash; C&oacute; Ch&acirc;n Đế &ndash; Tiện lợi đặt ở bất k&igrave; mặt b&agrave;n n&agrave;o</li>\r\n<li>Xuất xứ: nh&agrave; m&aacute;y nội địa Trung.</li>\r\n<li>Nguồn điện: USB kết nối trực tiếp với ổ điện hoặc m&aacute;y t&iacute;nh</li>\r\n<li>Chất liệu cao cấp, nhựa PVC Model 005 chống thấm nước, kh&ocirc;ng toả nhiều nhiệt v&agrave; c&oacute; độ bền cao.</li>\r\n<li>Tuổi thọ led: 50.000h</li>\r\n<li>C&acirc;n nặng: ~ 200g</li>\r\n<li>K&iacute;ch thước: 30x15x5cm</li>\r\n<li>\r\n<h4>An To&agrave;n &ndash; Chất Lượng:</h4>\r\n<ul>\r\n<li>Đ&egrave;n led neon trang tr&iacute; được bọc lớp c&aacute;ch điện, chống chọi được với điều kiện khắc nghiệt ngo&agrave;i trời v&agrave; c&oacute; thể đặt ở bất kỳ vị tr&iacute; n&agrave;o</li>\r\n<li>Sản phẩm c&oacute; ch&acirc;n đế v&agrave; USB tiện dụng</li>\r\n<li>Th&iacute;ch hợp trang tr&iacute; ph&ograve;ng ngủ, ph&ograve;ng kh&aacute;ch, b&agrave;n l&agrave;m việc, trang tr&iacute; tiệc, lễ tết, decor g&oacute;c chụp h&igrave;nh quay video, &hellip;</li>\r\n</ul>\r\n<h4>LƯU &Yacute; KHI MUA H&Agrave;NG:</h4>\r\n<ul>\r\n<li>Khi nhận h&agrave;ng c&aacute;c bạn h&atilde;y quay video mở h&agrave;ng để đảm bảo quyền lợi nếu c&oacute; sự cố kh&ocirc;ng may xảy ra.</li>\r\n<li>H&atilde;y chắc chắn rằng đ&egrave;n hoạt động b&igrave;nh thường trước khi b&oacute;c lớp băng d&iacute;nh 2 mặt.</li>\r\n<li>Đ&egrave;n n&agrave;y c&oacute; thể cắt, tuy nhi&ecirc;n đoạn n&agrave;o nối điện mới s&aacute;ng được (v&agrave;i bạn ko hiểu về điện cắt th&agrave;nh nhiều mảnh nhỏ xong ko nối điện n&oacute; kh&ocirc;ng s&aacute;ng lại nhắn tin bảo shop l,ừa đả,o)</li>\r\n<li>Shop sẽ cố gắng nhất c&oacute; thể để giảm thiểu rủi ro đ&egrave;n bị lỗi hoặc nh&acirc;n vi&ecirc;n g&oacute;i h&agrave;ng g&oacute;i sai/ thiếu sản phẩm. Nhưng nếu bạn gặp phải trường hợp n&agrave;y xin đừng vội đ&aacute;nh gi&aacute; xấu, h&atilde;y nhắn tin cho shop sẽ hỗ trợ bảo h&agrave;nh miễn ph&iacute; 100% cho bạn.</li>\r\n<li>H&atilde;y li&ecirc;n hệ với shop nếu như sản phẩm c&oacute; lỗi, bọn m&igrave;nh sẽ lu&ocirc;n chăm s&oacute;c kh&aacute;ch h&agrave;ng một c&aacute;ch nhiệt t&igrave;nh nhất.</li>\r\n<li>C&aacute;c bạn nhận được sản phẩm, vui l&ograve;ng đ&aacute;nh gi&aacute; gi&uacute;p Shop để hưởng th&ecirc;m nhiều ưu đ&atilde;i hơn nh&eacute;.</li>\r\n</ul>\r\n</li>\r\n</ul>','<ul>\r\n<li>T&ecirc;n gọi: Đ&egrave;n Led Neon Trang Tr&iacute; Để B&agrave;n &ndash; C&oacute; Ch&acirc;n Đế &ndash; Tiện lợi đặt ở bất k&igrave; mặt b&agrave;n n&agrave;o</li>\r\n<li>Xuất xứ: nh&agrave; m&aacute;y nội địa Trung.</li>\r\n<li>Nguồn điện: USB kết nối trực tiếp với ổ điện hoặc m&aacute;y t&iacute;nh</li>\r\n<li>Chất liệu cao cấp, nhựa PVC Model 005 chống thấm nước, kh&ocirc;ng toả nhiều nhiệt v&agrave; c&oacute; độ bền cao.</li>\r\n<li>Tuổi thọ led: 50.000h</li>\r\n<li>C&acirc;n nặng: ~ 200g</li>\r\n<li>K&iacute;ch thước: 30x15x5cm</li>\r\n<li>Đ&egrave;n led neon trang tr&iacute; Zgaming được bảo h&agrave;nh 3 th&aacute;ng &ndash; 01 đổi 01 trong 3 ng&agrave;y</li>\r\n</ul>\r\n<h4>&nbsp;</h4>','uploads/products/1735210040_anh-6-600x6006.png','public',0,8,'2024-12-26 03:47:20','2024-12-26 03:49:50'),(26,'Keycap Black Myth Wukong',650000,100,'cái',0,0,'<h4>M&Ocirc; TẢ SẢN PHẨM &ndash; Keycap Black Myth Wukong | 130 Key | PBT | Cherry Profile</h4>\r\n<ul>\r\n<li>\r\n<div dir=\"auto\">Prolife: Cherry</div>\r\n</li>\r\n<li>\r\n<div dir=\"auto\">Số n&uacute;t: 130 N&uacute;t/ Bộ</div>\r\n</li>\r\n<li>\r\n<div dir=\"auto\">Chất liệu: Nhựa cao cấp PBT</div>\r\n</li>\r\n<li>\r\n<div dir=\"auto\">Kĩ thuật in: Xuy&ecirc;n LED Side Print (Ninja)</div>\r\n</li>\r\n<li>\r\n<div dir=\"auto\">Chuẩn ANSI phổ th&ocirc;ng như Filco, IKBC&hellip; ph&ugrave; hợp mọi Layout cơ bản như 60, 61, 68, 84, 87, 98, 104, 108, Kể cả đều chơi được.</div>\r\n<div dir=\"auto\">Chất liệu: nhựa PBT</div>\r\n</li>\r\n<li>\r\n<div dir=\"auto\">Box đựng đẹp lắm ạ, l&agrave;m qu&agrave; tặng si&ecirc;u hợp l&yacute;</div>\r\n</li>\r\n</ul>','<ul>\r\n<li>Prolife: Cherry</li>\r\n<li>\r\n<div dir=\"auto\">Số n&uacute;t: 130 N&uacute;t/ Bộ</div>\r\n</li>\r\n<li>\r\n<div dir=\"auto\">Chất liệu: Nhựa cao cấp PBT</div>\r\n</li>\r\n<li>\r\n<div dir=\"auto\">Kĩ thuật in: Xuy&ecirc;n LED Side Print (Ninja)</div>\r\n</li>\r\n<li>\r\n<div dir=\"auto\">Box đựng đẹp lắm ạ, l&agrave;m qu&agrave; tặng si&ecirc;u hợp l&yacute;</div>\r\n</li>\r\n</ul>','uploads/products/1735210779_KEYCAP-Black-Myth-Wukong.png','public',0,14,'2024-12-26 03:59:39','2024-12-26 03:59:39'),(27,'Keycap Border Chemistry 003',949000,100,'cái',0,0,'<h2>Description</h2>\r\n<div dir=\"auto\">*Lưu &yacute;:&nbsp;<strong>Đ&acirc;y l&agrave; Keycap KH&Ocirc;NG BAO GỒM B&Agrave;N PH&Iacute;M</strong><br>*Lưu &yacute;: Sản phẩm c&oacute; nhiều phi&ecirc;n bản<br>+ Bộ 173 ph&iacute;m c&oacute; c&aacute;c ph&iacute;m trong suốt<br>+ Bộ 129 ph&iacute;m kh&ocirc;ng c&oacute; ph&iacute;m trong suốt<br>+ Bộ keycap extra chỉ c&oacute; 23 ph&iacute;m\r\n<p>&nbsp;</p>\r\n<h4>M&Ocirc; TẢ SẢN PHẨM &ndash; Keycap Border Chemistry / Chemical 003 | 173 Ph&iacute;m/ Bộ | PBT &amp; Transparent | Giao Ngay Hỏa Tốc</h4>\r\n<p>?Prolife: Cherry<br>?Số n&uacute;t: 173 N&uacute;t/ Bộ (gồm 38 n&uacute;t trong suốt)<br>?Chất liệu: Nhựa cao cấp PBT kết hợp Nhựa Trong Suốt Transparent<br>?Kĩ thuật in: Dyesub, bề mặt mịn cho cảm gi&aacute;c g&otilde; ph&iacute;m rất dễ chịu, &acirc;m thanh &ecirc;m v&agrave; kh&ocirc;ng bị b&oacute;ng theo thời gian<br>?Thiết kế độc đ&aacute;o, mang hơi hướng tương lai<br>?Chuẩn ANSI phổ th&ocirc;ng như Filco, IKBC&hellip; ph&ugrave; hợp mọi Layout cơ bản như 60, 61, 68, 84, 87, 98, 104, 108, Kể cả đều chơi được.<br>?Đ&oacute;ng g&oacute;i: Keycap được đ&oacute;ng trong hộp caton c&oacute; khay nhựa xếp sẵn như video v&agrave; ảnh cuối của sản phẩm.</p>\r\n</div>','<ul>\r\n<li>Prolife: Cherry</li>\r\n<li>Số n&uacute;t:\r\n<ul>\r\n<li>Bộ 173 ph&iacute;m c&oacute; c&aacute;c ph&iacute;m trong suốt</li>\r\n<li>Bộ 129 ph&iacute;m kh&ocirc;ng c&oacute; ph&iacute;m trong suốt</li>\r\n<li>Bộ keycap extra chỉ c&oacute; 23 ph&iacute;m</li>\r\n</ul>\r\n</li>\r\n<li>Chất liệu: Nhựa cao cấp PBT kết hợp Nhựa Trong Suốt Transparent</li>\r\n</ul>','uploads/products/1735210918_Keycap-Chemical-0-600x600.png','public',0,14,'2024-12-26 04:01:58','2024-12-26 04:01:58'),(28,'ĐÈN LED NEON TRANG TRÍ – PLAYSTATION',315000,100,'cái',0,0,'<h4>M&Ocirc; TẢ SẢN PHẨM:</h4>\r\n<ul>\r\n<li>T&ecirc;n gọi:&nbsp;<a href=\"https://zgaming.vn/san-pham/den-led-neon-trang-tri-nhieu-mau/\">Đ&egrave;n Led Neon Trang Tr&iacute;</a>&nbsp;G&oacute;c Gaming, Decor G&oacute;c Giải Tr&iacute;, G&oacute;c L&agrave;m Việc</li>\r\n<li>Xuất xứ: nh&agrave; m&aacute;y nội địa Trung.</li>\r\n<li>Nguồn điện: USB hoặc 3 pin AA tiết kiệm năng lượng</li>\r\n<li>Chất liệu cao cấp, nhựa PVC Model 005 chống thấm nước, kh&ocirc;ng toả nhiều nhiệt v&agrave; c&oacute; độ bền cao.</li>\r\n<li>Tuổi thọ led: 60.000h</li>\r\n<li>C&acirc;n nặng: ~ 200g</li>\r\n<li>Đ&egrave;n led neon trang tr&iacute; Zgaming được bảo h&agrave;nh 3 th&aacute;ng &ndash; 01 đổi 01 trong 3 ng&agrave;y</li>\r\n</ul>','<p>&ndash; Nguồn điện: USB hoặc 3 pin AA (C&aacute;c mẫu led để b&agrave;n)<br>&ndash; Chất liệu cao cấp, nhựa PVC Model 005 chống thấm nước, kh&ocirc;ng toả nhiều nhiệt v&agrave; c&oacute; độ bền cao.<br>&ndash; Tuổi thọ led: 60.000h<br>&ndash; C&acirc;n nặng: ~ 200g<br>&ndash; Th&iacute;ch hợp trang tr&iacute; ph&ograve;ng ngủ, ph&ograve;ng kh&aacute;ch, b&agrave;n l&agrave;m việc, trang tr&iacute; tiệc, lễ tết, decor g&oacute;c chụp h&igrave;nh quay video.<br>&ndash; D&acirc;y nguồn USB cắm trực tiếp v&agrave;o ổ USB ở Laptop/ m&aacute;y t&iacute;nh, TV, &ocirc; t&ocirc;, củ sạc điện thoại.</p>','uploads/products/1735211149_ZG006-Den-Led-Neon-Trang-Tri-Goc.png','public',0,8,'2024-12-26 04:05:49','2024-12-26 04:05:49'),(29,'ĐÈN LED NEON PACMAN | TRANG TRÍ & DECOR GÓC LÀM VIỆC',448000,100,'cái',0,0,'<p><strong>M&Ocirc; TẢ SẢN PHẨM &ndash; Đ&Egrave;N LED NEON PACMAN</strong></p>\r\n<ul>\r\n<li>K&iacute;ch thước: 30*10*6cm</li>\r\n<li>Chất Liệu sp: Nhựa ABS</li>\r\n<li>Nguồn điện: USB hoặc PIN</li>\r\n<li>Hộp sản phẩm bao gồm: 01 Đ&egrave;n, 01 C&aacute;p Usb</li>\r\n<li>Bảo h&agrave;nh: 12 Th&aacute;ng, bảo h&agrave;nh 1 đổi 1 trong v&ograve;ng 03 ng&agrave;y duy nhất tại Zgaming.vn</li>\r\n</ul>\r\n<p><strong>C&Aacute;C CHẾ ĐỘ HOẠT ĐỘNG:</strong></p>\r\n<ul>\r\n<li>Chế độ 1: Bấm c&ocirc;ng tắc 1 lần &gt; Tất cả c&aacute;c đ&egrave;n c&ugrave;ng s&aacute;ng</li>\r\n<li>Chế độ 2: Bấm c&ocirc;ng tắc th&ecirc;m lần nữa &gt; C&aacute;c nh&acirc;n vật Pacman sẽ s&aacute;ng lần lượt</li>\r\n<li>Chế độ 3: Bấm c&ocirc;ng tắc th&ecirc;m lần nữa &gt; Đ&egrave;n sẽ s&aacute;ng theo nhịp điệu &acirc;m thanh ph&aacute;t ra</li>\r\n</ul>','<ul>\r\n<li>K&iacute;ch thước: 30*10*6cm</li>\r\n<li>Chất Liệu sp: Nhựa ABS</li>\r\n<li>Nguồn điện: USB hoặc PIN</li>\r\n<li>Hộp sản phẩm bao gồm: 01 Đ&egrave;n, 01 C&aacute;p Usb</li>\r\n</ul>','uploads/products/1735211292_avatar-600x6050.png','public',0,8,'2024-12-26 04:08:12','2024-12-26 04:08:12'),(30,'ĐÈN LED DECOR GAME OVER | TRANG TRÍ & DECOR GÓC LÀM VIỆC',399000,100,'cái',0,0,'<p><strong>M&Ocirc; TẢ SẢN PHẨM &ndash; Đ&Egrave;N LED DECOR GAME OVER</strong></p>\r\n<ul>\r\n<li>Chất liệu nhựa, th&acirc;n thiện với m&ocirc;i trường v&agrave; c&oacute; độ bền cao.</li>\r\n<li>Th&iacute;ch hợp cho: ph&ograve;ng kh&aacute;ch, ph&ograve;ng ngủ, ph&ograve;ng chơi game.</li>\r\n<li>G&oacute;i h&agrave;ng bao gồm: đ&egrave;n h&igrave;nh biểu tượng tr&ograve; chơi, d&acirc;y c&aacute;p USB v&agrave; s&aacute;ch hướng dẫn sử dụng</li>\r\n<li>Bảo h&agrave;nh: 3 Th&aacute;ng, bảo h&agrave;nh 1 đổi 1 trong v&ograve;ng 03 ng&agrave;y duy nhất tại Zgaming</li>\r\n</ul>\r\n<p><strong>TH&Ocirc;NG TIN CHI TIẾT:</strong></p>\r\n<ul>\r\n<li>Phong c&aacute;ch: Đ&egrave;n LED decor</li>\r\n<li>Điện &aacute;p: 5V</li>\r\n<li>K&iacute;ch thước: Xấp xỉ 31.5 x 17.5 x 8cm</li>\r\n<li>M&agrave;u sắc &aacute;nh s&aacute;ng: Nhiều m&agrave;u sắc</li>\r\n<li>Nguồn cung cấp: Sạc USB</li>\r\n</ul>','<ul>\r\n<li>Phong c&aacute;ch: Gaming</li>\r\n<li>Điện &aacute;p: 5V</li>\r\n<li>Chất liệu: Nhựa, th&acirc;n thiện với m&ocirc;i trường v&agrave; c&oacute; độ bền cao.</li>\r\n<li>Chuy&ecirc;n d&ugrave;ng: Decor g&oacute;c l&agrave;m việc, g&oacute;c gaming</li>\r\n</ul>','uploads/products/1735211427_Den-Led-Decor-Game-Over-1-600x60.png','public',0,8,'2024-12-26 04:10:27','2024-12-26 04:10:27');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ratings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `post_id` bigint unsigned DEFAULT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  `rating` int NOT NULL DEFAULT '1',
  `comment` text COLLATE utf8mb4_unicode_ci,
  `isHidden` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ratings_user_id_foreign` (`user_id`),
  KEY `ratings_post_id_foreign` (`post_id`),
  KEY `ratings_product_id_foreign` (`product_id`),
  CONSTRAINT `ratings_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('UIebjjLO4KSZagg4CrzWXfJbqNoNdMvsJHQBko7D',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQXBnWWxNUkQ2YTBiMVdWRjRWcUs3enR2N1VkY0NDc0NDc2NlSWpyMiI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2hvLXNvL2Rvbi1oYW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1735985611);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Vio','bmtck0000@gmail.com','admin',NULL,NULL,'Thôn 3 Cư Kuin','0773440062',0,NULL,NULL,'$2y$12$hSi670ytOK/pd1E9vOfc1umuYJisrHRub7pbQdw1vwvgH0uN2CGwW',NULL,'2024-12-25 00:56:25','2025-01-03 00:50:28'),(2,'liem','nguyentrongliem574@gmail.com','admin',NULL,NULL,NULL,NULL,0,NULL,NULL,'$2y$12$d4JhMGDwoFfNsBQqCtSPdeO52XoVhayKl4.ywhwE6ONrmVRttP3m6',NULL,'2024-12-26 02:22:41','2024-12-26 02:22:41');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variant_values`
--

DROP TABLE IF EXISTS `variant_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `variant_values` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `variant_id` bigint unsigned NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `variant_values_variant_id_foreign` (`variant_id`),
  CONSTRAINT `variant_values_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variant_values`
--

LOCK TABLES `variant_values` WRITE;
/*!40000 ALTER TABLE `variant_values` DISABLE KEYS */;
INSERT INTO `variant_values` VALUES (1,1,'Đỏ','2024-12-25 02:28:01','2024-12-25 02:28:01',0),(2,1,'Vàng','2024-12-25 02:28:01','2024-12-25 02:28:01',0);
/*!40000 ALTER TABLE `variant_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variants`
--

DROP TABLE IF EXISTS `variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `variants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variants`
--

LOCK TABLES `variants` WRITE;
/*!40000 ALTER TABLE `variants` DISABLE KEYS */;
INSERT INTO `variants` VALUES (1,'Màu sắc',0,'2024-12-25 02:28:01','2024-12-25 04:12:15');
/*!40000 ALTER TABLE `variants` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-04 17:15:30
