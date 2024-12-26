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
INSERT INTO `cache` VALUES ('bmtck0000@gmail.com|127.0.0.1','i:2;',1735177981),('bmtck0000@gmail.com|127.0.0.1:timer','i:1735177981;',1735177981);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,NULL,'Bàn phím',0,NULL,NULL),(2,1,'Phím cơ',0,'2024-12-25 01:28:46','2024-12-25 01:28:46'),(3,NULL,'Ghế',0,'2024-12-25 01:33:04','2024-12-25 01:33:04'),(4,3,'Ghế Corsair',0,'2024-12-25 01:33:15','2024-12-25 01:41:02');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (1,'uploads/products/1735178708_ban-phim-co-man-hinh-piifox-walk.png','1735178708_ban-phim-co-man-hinh-piifox-walk.png',0,'2024-12-25 19:05:08','2024-12-25 19:05:08',1),(2,'uploads/products/1735178708_ban-phim-co-man-hinh-piifox-walk1.png','1735178708_ban-phim-co-man-hinh-piifox-walk1.png',1,'2024-12-25 19:05:08','2024-12-25 19:05:08',1),(3,'uploads/products/1735178708_ban-phim-co-man-hinh-piifox-walk2.png','1735178708_ban-phim-co-man-hinh-piifox-walk2.png',2,'2024-12-25 19:05:08','2024-12-25 19:05:08',1),(4,'uploads/products/1735200580_anh-1-600x600.jpg','1735200580_anh-1-600x600.jpg',0,'2024-12-26 01:09:40','2024-12-26 01:09:40',2),(5,'uploads/products/1735200580_Ban-phim-co-langtu-lt104-full-ph.jpg','1735200580_Ban-phim-co-langtu-lt104-full-ph.jpg',1,'2024-12-26 01:09:40','2024-12-26 01:09:40',2),(6,'uploads/products/1735200580_Ban-phim-co-langtu-lt104-full-ph1.jpg','1735200580_Ban-phim-co-langtu-lt104-full-ph1.jpg',2,'2024-12-26 01:09:40','2024-12-26 01:09:40',2);
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_12_19_113720_add_role_to_users_table',1),(5,'2024_12_19_114120_create_categories_table',1),(6,'2024_12_19_114217_create_products_table',1),(7,'2024_12_19_115037_create_media_table',1),(8,'2024_12_19_115647_create_orders_table',1),(9,'2024_12_19_115733_create_order_details_table',1),(10,'2024_12_19_115821_create_posts_table',1),(11,'2024_12_21_090941_update_value_for_unit',1),(12,'2024_12_25_034427_add_column_to_categories',1),(13,'2024_12_25_040009_create_variants_table',1),(14,'2024_12_25_040104_create_variant_values_table',1),(15,'2024_12_25_040153_create_product_variants_table',1),(16,'2024_12_25_041904_create_carts_table',1),(17,'2024_12_25_041921_create_cart_items_table',1),(18,'2024_12_25_042413_create_comments_table',1),(19,'2024_12_25_042519_create_ratings_table',1);
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
  `payment_method` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_users_id_foreign` (`users_id`),
  CONSTRAINT `order_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
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
  PRIMARY KEY (`id`),
  KEY `order_detail_order_id_foreign` (`order_id`),
  KEY `order_detail_product_id_foreign` (`product_id`),
  CONSTRAINT `order_detail_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_detail_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_detail`
--

LOCK TABLES `order_detail` WRITE;
/*!40000 ALTER TABLE `order_detail` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Bàn Phím Cơ Piifox Walker75 – ER75 | 3 Mode | Mạch Xuôi | Hotswap | LED RGB',11190000,1000,'Cái',2,0,'<p>M&ocirc; tả sản phẩm</p>','<p>M&ocirc; tả ngắn</p>','uploads/products/1735178708_phim-co-thumnail.png','public',0,2,'2024-12-25 19:05:08','2024-12-25 19:05:08'),(2,'BÀN PHÍM CƠ KHÔNG DÂY HOT-SWAP LANGTU LT104',1200000,100,'Cái',0,0,'<ul>\r\n<li><strong>Thương hiệu:</strong>&nbsp;Langtu &ndash; Full box ch&iacute;nh h&atilde;ng &ndash; bảo h&agrave;nh 12 th&aacute;ng, 1 đổi 1 trong 03 ng&agrave;y test sp</li>\r\n<li>T&ecirc;n sản phẩm: B&Agrave;N PH&Iacute;M CƠ KH&Ocirc;NG D&Acirc;Y HOT-SWAP LANGTU LT014</li>\r\n<li><strong>Loại b&agrave;n ph&iacute;m:</strong>&nbsp;Ph&iacute;m Cơ | C&oacute; Hot-Swap (dễ d&agrave;ng thay đổi ph&iacute;m/ keycap theo sở th&iacute;ch)</li>\r\n<li>Switch: Linear (Blue Ocean &ndash; sản xuất ri&ecirc;ng cho d&ograve;ng n&agrave;y) đ&atilde; được lube trước khi xuất xưởng, cho cảm gi&aacute;c bấm kh&aacute; đầm, &ecirc;m.</li>\r\n<li>Loại kết nối: Bản C&oacute; d&acirc;y (1 mode) &amp; Bản Kh&ocirc;ng D&acirc;y (3 mode)</li>\r\n<li>Pin sạc 4000 mah, thời gian chờ ~ 100 ng&agrave;y, Thời gian sử dụng ~ 10 ng&agrave;y</li>\r\n<li>Đ&egrave;n Led: LED RGB &amp; Rainbow t&ugrave;y phi&ecirc;n bản</li>\r\n<li>Size ph&iacute;m: 104 Ph&iacute;m + N&uacute;m xoay v&agrave; m&agrave;n h&igrave;nh</li>\r\n<li>K&iacute;ch thước: 43 x 15 x 4 cm</li>\r\n<li>C&acirc;n nặng: 900 gram</li>\r\n<li>Độ bền ph&iacute;m: &gt; 70.000.000 lượt bấm</li>\r\n</ul>\r\n<h4>SO S&Aacute;NH ĐIỂM KH&Aacute;C NHAU GIỮA C&Aacute;C PHI&Ecirc;N BẢN B&Agrave;N PH&Iacute;M CƠ LANGTU LT104:</h4>\r\n<p>✔️ PHI&Ecirc;N BẢN LT84 Pro (KH&Ocirc;NG D&Acirc;Y):</p>\r\n<ul>\r\n<li>Kết nối kh&ocirc;ng d&acirc;y (03 mode: Bluetooth, Wireless 2.4G hoặc USB Type-C)</li>\r\n<li>Led RGB với rất nhiều chế độ m&agrave;u sắc.</li>\r\n<li>M&agrave;n h&igrave;nh hiển thị c&oacute; thể thay đổi nội dung/ ảnh Gif theo chủ đề m&igrave;nh y&ecirc;u th&iacute;ch với kho ảnh Gif 18.000.000 ảnh</li>\r\n</ul>\r\n<p>✔️ PHI&Ecirc;N BẢN LT84 thường (C&Oacute; D&Acirc;Y):</p>\r\n<ul>\r\n<li>Kết nối d&acirc;y USB Type C (01 mode)</li>\r\n<li>Led Rainbow</li>\r\n</ul>\r\n<p><img class=\"aligncenter wp-image-12615 size-full\" src=\"https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-2.jpg\" sizes=\"auto, (max-width: 750px) 100vw, 750px\" srcset=\"https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-2.jpg 750w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-2-300x300.jpg 300w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-2-150x150.jpg 150w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-2-600x600.jpg 600w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-2-148x148.jpg 148w\" alt=\"\" width=\"750\" height=\"750\" loading=\"lazy\">\\<img class=\"aligncenter wp-image-13773 size-full\" src=\"https://zgaming.vn/wp-content/uploads/2023/09/1-mode.jpg\" sizes=\"auto, (max-width: 750px) 100vw, 750px\" srcset=\"https://zgaming.vn/wp-content/uploads/2023/09/1-mode.jpg 750w, https://zgaming.vn/wp-content/uploads/2023/09/1-mode-300x300.jpg 300w, https://zgaming.vn/wp-content/uploads/2023/09/1-mode-150x150.jpg 150w, https://zgaming.vn/wp-content/uploads/2023/09/1-mode-600x600.jpg 600w, https://zgaming.vn/wp-content/uploads/2023/09/1-mode-148x148.jpg 148w\" alt=\"\" width=\"750\" height=\"750\" loading=\"lazy\"></p>\r\n<p><img class=\"aligncenter wp-image-13774\" src=\"https://zgaming.vn/wp-content/uploads/2023/09/Grey-Orange-1024x1024.jpg\" sizes=\"auto, (max-width: 750px) 100vw, 750px\" srcset=\"https://zgaming.vn/wp-content/uploads/2023/09/Grey-Orange-1024x1024.jpg 1024w, https://zgaming.vn/wp-content/uploads/2023/09/Grey-Orange-300x300.jpg 300w, https://zgaming.vn/wp-content/uploads/2023/09/Grey-Orange-150x150.jpg 150w, https://zgaming.vn/wp-content/uploads/2023/09/Grey-Orange-768x768.jpg 768w, https://zgaming.vn/wp-content/uploads/2023/09/Grey-Orange-1536x1536.jpg 1536w, https://zgaming.vn/wp-content/uploads/2023/09/Grey-Orange-1200x1200.jpg 1200w, https://zgaming.vn/wp-content/uploads/2023/09/Grey-Orange-600x600.jpg 600w, https://zgaming.vn/wp-content/uploads/2023/09/Grey-Orange-148x148.jpg 148w, https://zgaming.vn/wp-content/uploads/2023/09/Grey-Orange.jpg 1613w\" alt=\"\" width=\"750\" height=\"750\" loading=\"lazy\"></p>\r\n<p><img class=\"aligncenter wp-image-13775\" src=\"https://zgaming.vn/wp-content/uploads/2023/09/Screenshot-2024-04-11-145208-1.png\" sizes=\"auto, (max-width: 750px) 100vw, 750px\" srcset=\"https://zgaming.vn/wp-content/uploads/2023/09/Screenshot-2024-04-11-145208-1.png 800w, https://zgaming.vn/wp-content/uploads/2023/09/Screenshot-2024-04-11-145208-1-300x300.png 300w, https://zgaming.vn/wp-content/uploads/2023/09/Screenshot-2024-04-11-145208-1-150x150.png 150w, https://zgaming.vn/wp-content/uploads/2023/09/Screenshot-2024-04-11-145208-1-768x768.png 768w, https://zgaming.vn/wp-content/uploads/2023/09/Screenshot-2024-04-11-145208-1-600x600.png 600w, https://zgaming.vn/wp-content/uploads/2023/09/Screenshot-2024-04-11-145208-1-148x148.png 148w\" alt=\"\" width=\"750\" height=\"750\" loading=\"lazy\"></p>\r\n<p><img class=\"aligncenter wp-image-12619 size-full\" src=\"https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-6.jpg\" sizes=\"auto, (max-width: 765px) 100vw, 765px\" srcset=\"https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-6.jpg 765w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-6-300x300.jpg 300w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-6-150x150.jpg 150w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-6-600x600.jpg 600w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-6-148x148.jpg 148w\" alt=\"\" width=\"765\" height=\"765\" loading=\"lazy\"><img class=\"aligncenter wp-image-12620 size-full\" src=\"https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-7.jpg\" sizes=\"auto, (max-width: 744px) 100vw, 744px\" srcset=\"https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-7.jpg 744w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-7-300x300.jpg 300w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-7-150x150.jpg 150w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-7-600x600.jpg 600w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-7-148x148.jpg 148w\" alt=\"\" width=\"744\" height=\"744\" loading=\"lazy\"><img class=\"aligncenter wp-image-12621 size-full\" src=\"https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-8.jpg\" sizes=\"auto, (max-width: 761px) 100vw, 761px\" srcset=\"https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-8.jpg 761w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-8-300x300.jpg 300w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-8-150x150.jpg 150w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-8-600x600.jpg 600w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-8-148x148.jpg 148w\" alt=\"\" width=\"761\" height=\"761\" loading=\"lazy\"><img class=\"aligncenter wp-image-12622 size-full\" src=\"https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-9.jpg\" sizes=\"auto, (max-width: 750px) 100vw, 750px\" srcset=\"https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-9.jpg 750w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-9-300x300.jpg 300w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-9-150x150.jpg 150w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-9-600x600.jpg 600w, https://zgaming.vn/wp-content/uploads/2023/09/Ban-phim-co-langtu-lt104-full-phim-9-148x148.jpg 148w\" alt=\"\" width=\"750\" height=\"750\" loading=\"lazy\"></p>\r\n<h4>CHI TIẾT VỀ B&Agrave;N PH&Iacute;M CƠ KH&Ocirc;NG D&Acirc;Y HOT-SWAP LANGTU LT84:</h4>\r\n<ul>\r\n<li class=\"irIKAp\">B&agrave;n ph&iacute;m được thiết kế hiện đại với n&uacute;m xoay v&agrave; m&agrave;n h&igrave;nh led hiển thị tr&ecirc;n b&agrave;n ph&iacute;m</li>\r\n<li class=\"irIKAp\">Hỗ trợ 3 chế độ kết nối v&ocirc; c&ugrave;ng tiện lợi: C&aacute;p typeC/ bluetooth/ USB 2.4</li>\r\n<li class=\"irIKAp\">Thiết kế nhỏ gọn dễ d&agrave;ng mang theo khi cần thiết. Bố cục b&agrave;i tr&iacute; khoa học.</li>\r\n<li class=\"irIKAp\">Dung lượng pin l&ecirc;n tới 4000mAh cho thời gian sử dụng tương đối l&acirc;u c&oacute; thể l&ecirc;n tới 10 ng&agrave;y. Thời gian chờ khoảng 100 ng&agrave;y.</li>\r\n<li class=\"irIKAp\">Trang bị Ocean Blue switch đ&atilde; được lube trước khi xuất xưởng cho cảm gi&aacute;c bấm kh&aacute; l&agrave; chắc chắn, &ecirc;m, kh&ocirc;ng bị lọc xọc.</li>\r\n<li class=\"irIKAp\">T&iacute;nh năng HOTSWAP ưu việt dễ d&agrave;ng thay thế switch khi cần thiết</li>\r\n<li class=\"irIKAp\">C&oacute; c&aacute;c chế độ kết nối ri&ecirc;ng biệt cho c&aacute;c hệ điều h&agrave;nh windown, IOS.</li>\r\n<li class=\"irIKAp\">Tốc độ g&otilde; ph&iacute;m nhanh: Ch&iacute;nh v&igrave; c&oacute; tốc độ g&otilde; ph&iacute;m nhanh n&ecirc;n đ&acirc;y l&agrave; loại b&agrave;n ph&iacute;m được c&aacute;c game thủ thường sử dụng nhất, g&otilde; nhanh hơn đồng nghĩa khả năng &ldquo;ti&ecirc;u diệt&rdquo; địch cũng cao hơn.</li>\r\n<li>Độ nảy cao: Nhờ c&oacute; một l&ograve; xo b&ecirc;n trong mỗi ph&iacute;m mang lại độ nảy cao sau khi nhấn ph&iacute;m, nhờ độ nảy cao n&ecirc;n nếu như một ph&iacute;m cần phải g&otilde; nhiều lần th&igrave; chắc chắn rằng thời gian g&otilde; đối với b&agrave;n ph&iacute;m cơ sẽ ngắn hơn.</li>\r\n<li>G&otilde; ph&iacute;m &ecirc;m tay hơn: Chỉ cần sử dụng một lực nhẹ vừa phải để nhấn ph&iacute;m thay v&igrave; phải nhấn đủ một lực mạnh để miếng cao su chạm đến bảng mạch điện tử như b&agrave;n ph&iacute;m thường.</li>\r\n<li>Tuổi thọ cao hơn: B&agrave;n ph&iacute;m cơ thường c&oacute; tuổi thọ cao hơn rất nhiều so với b&agrave;n ph&iacute;m thường.</li>\r\n<li>Cảm gi&aacute;c g&otilde; ph&iacute;m tuyệt hơn</li>\r\n<li>Sử dụng đ&egrave;n b&agrave;n ph&iacute;m: LED Rainbown cho bản c&oacute; d&acirc;y v&agrave; RGB cho bản kh&ocirc;ng d&acirc;y</li>\r\n</ul>\r\n<h4>LƯU &Yacute; KHI MUA H&Agrave;NG:</h4>\r\n<ul>\r\n<li>Khi nhận h&agrave;ng c&aacute;c bạn h&atilde;y quay video mở h&agrave;ng để đảm bảo quyền lợi nếu c&oacute; sự cố kh&ocirc;ng may xảy ra.</li>\r\n<li>Shop sẽ cố gắng nhất c&oacute; thể để giảm thiểu rủi ro đ&egrave;n bị lỗi hoặc nh&acirc;n vi&ecirc;n g&oacute;i h&agrave;ng g&oacute;i sai/ thiếu sản phẩm. Nhưng nếu bạn gặp phải trường hợp n&agrave;y xin đừng vội đ&aacute;nh gi&aacute; xấu, h&atilde;y nhắn tin cho shop sẽ hỗ trợ bảo h&agrave;nh miễn ph&iacute; 100% cho bạn.</li>\r\n<li>H&atilde;y li&ecirc;n hệ với shop nếu như sản phẩm c&oacute; lỗi, bọn m&igrave;nh sẽ lu&ocirc;n chăm s&oacute;c kh&aacute;ch h&agrave;ng một c&aacute;ch nhiệt t&igrave;nh nhất.</li>\r\n<li>C&aacute;c bạn nhận được sản phẩm, vui l&ograve;ng đ&aacute;nh gi&aacute; gi&uacute;p Shop để hưởng th&ecirc;m nhiều ưu đ&atilde;i hơn nh&eacute;.</li>\r\n</ul>\r\n<p>&nbsp;</p>','<ul>\r\n<li><strong>Full box</strong>&nbsp;ch&iacute;nh h&atilde;ng &ndash; bảo h&agrave;nh 12 th&aacute;ng, 1 đổi 1</li>\r\n<li><strong>Hỗ trợ:&nbsp;</strong>Windows v&agrave; Mac OS</li>\r\n<li><strong>Loại kết nối:&nbsp;</strong>1 Mode (bản cắm d&acirc;y) &amp; 3 mode (Vừa c&oacute; d&acirc;y, vừa kh&ocirc;ng d&acirc;y: Bluetooth/ USB rời)</li>\r\n<li><strong>Loại Switch:</strong> Ocean Blue Switch | c&oacute; Hot Swap</li>\r\n</ul>','uploads/products/1735200580_anh-1-600x600.jpg','public',0,2,'2024-12-26 01:09:40','2024-12-26 01:09:40');
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
INSERT INTO `sessions` VALUES ('71KQ66tIQlCg69o6FH9uBstc47luQnvzP7xpXCMn',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoidkZ2VEpFZkdkRllrUHZ0Q1NuNDJNVFpwV3JJWVRlVFRwaEVLdzdzMyI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Nhbi1waGFtIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1735200637),('IvUrWe0uT9bB3NPQdXmAIxiegMKuwXIuYbg4oMoj',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiejVSTldETTVKS3B6VGVYTWxGSlRUVUVnTlB3cnhlQkpDbUZvRlRveiI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2dpby1oYW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1735186740);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Vio','admin@gmail.com','admin',NULL,NULL,NULL,NULL,0,NULL,NULL,'$2y$12$hSi670ytOK/pd1E9vOfc1umuYJisrHRub7pbQdw1vwvgH0uN2CGwW',NULL,'2024-12-25 00:56:25','2024-12-25 00:56:25');
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

-- Dump completed on 2024-12-26 15:14:25
