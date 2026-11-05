-- ============================================================
-- Database: Nusantara Trip (Tour & Travel) - Laravel 12
-- Kompatibel: MySQL 5.7+ / 8.x, MariaDB 10.3+
-- Cara pakai: buat database kosong (utf8mb4_unicode_ci), lalu import file ini.
-- Akun CMS: admin@tourntravel.test / password  (Admin)
--           editor@tourntravel.test / password (Editor)
-- ============================================================
-- ------------------------------------------------------

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES
(1,'Tips Traveling','tips-traveling','2026-11-05 10:54:48','2026-11-05 10:54:48'),
(2,'Panduan Destinasi','panduan-destinasi','2026-11-05 10:54:48','2026-11-05 10:54:48'),
(3,'Kuliner','kuliner','2026-11-05 10:54:48','2026-11-05 10:54:48');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `destinations`
--

DROP TABLE IF EXISTS `destinations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `destinations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `destinations_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `destinations`
--

LOCK TABLES `destinations` WRITE;
/*!40000 ALTER TABLE `destinations` DISABLE KEYS */;
INSERT INTO `destinations` VALUES
(1,'Bali','bali','Bali','Pulau Dewata dengan pantai, pura, dan budaya yang memikat.','Bali merupakan salah satu destinasi favorit di Indonesia. Pulau Dewata dengan pantai, pura, dan budaya yang memikat. Nikmati pengalaman tak terlupakan bersama pemandu lokal kami yang ramah dan berpengalaman.','https://picsum.photos/seed/bali/1200/800',1,1,'2026-11-05 10:54:48','2026-11-05 10:54:48'),
(2,'Labuan Bajo','labuan-bajo','Nusa Tenggara Timur','Gerbang menuju Taman Nasional Komodo dan Pink Beach.','Labuan Bajo merupakan salah satu destinasi favorit di Indonesia. Gerbang menuju Taman Nasional Komodo dan Pink Beach. Nikmati pengalaman tak terlupakan bersama pemandu lokal kami yang ramah dan berpengalaman.','https://picsum.photos/seed/labuan-bajo/1200/800',1,1,'2026-11-05 10:54:48','2026-11-05 10:54:48'),
(3,'Raja Ampat','raja-ampat','Papua Barat Daya','Surga bawah laut dengan biodiversitas terkaya di dunia.','Raja Ampat merupakan salah satu destinasi favorit di Indonesia. Surga bawah laut dengan biodiversitas terkaya di dunia. Nikmati pengalaman tak terlupakan bersama pemandu lokal kami yang ramah dan berpengalaman.','https://picsum.photos/seed/raja-ampat/1200/800',1,1,'2026-11-05 10:54:48','2026-11-05 10:54:48'),
(4,'Yogyakarta','yogyakarta','DI Yogyakarta','Kota budaya dengan Candi Borobudur dan Prambanan.','Yogyakarta merupakan salah satu destinasi favorit di Indonesia. Kota budaya dengan Candi Borobudur dan Prambanan. Nikmati pengalaman tak terlupakan bersama pemandu lokal kami yang ramah dan berpengalaman.','https://picsum.photos/seed/yogyakarta/1200/800',1,1,'2026-11-05 10:54:48','2026-11-05 10:54:48'),
(5,'Lombok','lombok','Nusa Tenggara Barat','Pantai eksotis, Gili Trawangan, dan Gunung Rinjani.','Lombok merupakan salah satu destinasi favorit di Indonesia. Pantai eksotis, Gili Trawangan, dan Gunung Rinjani. Nikmati pengalaman tak terlupakan bersama pemandu lokal kami yang ramah dan berpengalaman.','https://picsum.photos/seed/lombok/1200/800',1,1,'2026-11-05 10:54:48','2026-11-05 10:54:48'),
(6,'Danau Toba','danau-toba','Sumatera Utara','Danau vulkanik terbesar di Asia Tenggara dengan Pulau Samosir.','Danau Toba merupakan salah satu destinasi favorit di Indonesia. Danau vulkanik terbesar di Asia Tenggara dengan Pulau Samosir. Nikmati pengalaman tak terlupakan bersama pemandu lokal kami yang ramah dan berpengalaman.','https://picsum.photos/seed/danau-toba/1200/800',1,1,'2026-11-05 10:54:48','2026-11-05 10:54:48'),
(7,'Bromo','bromo','Jawa Timur','Sunrise legendaris di kawah Gunung Bromo.','Bromo merupakan salah satu destinasi favorit di Indonesia. Sunrise legendaris di kawah Gunung Bromo. Nikmati pengalaman tak terlupakan bersama pemandu lokal kami yang ramah dan berpengalaman.','https://picsum.photos/seed/bromo/1200/800',0,1,'2026-11-05 10:54:48','2026-11-05 10:54:48'),
(8,'Wakatobi','wakatobi','Sulawesi Tenggara','Taman laut nasional dengan terumbu karang yang menawan.','Wakatobi merupakan salah satu destinasi favorit di Indonesia. Taman laut nasional dengan terumbu karang yang menawan. Nikmati pengalaman tak terlupakan bersama pemandu lokal kami yang ramah dan berpengalaman.','https://picsum.photos/seed/wakatobi/1200/800',0,1,'2026-11-05 10:54:48','2026-11-05 10:54:48');
/*!40000 ALTER TABLE `destinations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
-- Table structure for table `inquiries`
--

DROP TABLE IF EXISTS `inquiries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `inquiries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `package_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `travel_date` date DEFAULT NULL,
  `participants` smallint(5) unsigned DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inquiries_package_id_foreign` (`package_id`),
  CONSTRAINT `inquiries_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inquiries`
--

LOCK TABLES `inquiries` WRITE;
/*!40000 ALTER TABLE `inquiries` DISABLE KEYS */;
/*!40000 ALTER TABLE `inquiries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
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
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2026_01_01_000001_create_destinations_table',1),
(5,'2026_01_01_000002_create_packages_table',1),
(6,'2026_01_01_000003_create_categories_and_posts_table',1),
(7,'2026_01_01_000004_create_testimonials_table',1),
(8,'2026_01_01_000005_create_inquiries_table',1),
(9,'2026_01_01_000006_create_settings_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `packages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `destination_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `duration_days` smallint(5) unsigned NOT NULL DEFAULT 1,
  `duration_nights` smallint(5) unsigned NOT NULL DEFAULT 0,
  `price` bigint(20) unsigned NOT NULL,
  `discount_price` bigint(20) unsigned DEFAULT NULL,
  `max_people` smallint(5) unsigned NOT NULL DEFAULT 10,
  `short_description` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `itinerary` text DEFAULT NULL,
  `includes` text DEFAULT NULL,
  `excludes` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rating` decimal(2,1) NOT NULL DEFAULT 5.0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `packages_slug_unique` (`slug`),
  KEY `packages_destination_id_foreign` (`destination_id`),
  CONSTRAINT `packages_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packages`
--

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
INSERT INTO `packages` VALUES
(1,1,'Bali Explore Ubud & Kintamani','bali-explore-ubud-kintamani',4,3,3250000,2950000,15,'Highlight: Ubud Monkey Forest, Tegallalang Rice Terrace, Kintamani.','Paket Bali Explore Ubud & Kintamani dirancang untuk Anda yang ingin menikmati Bali secara maksimal. Highlight perjalanan: Ubud Monkey Forest, Tegallalang Rice Terrace, Kintamani.','Hari 1: Penjemputan & check-in hotel\nHari 2: Eksplorasi Ubud Monkey Forest, Tegallalang Rice Terrace, Kintamani\nHari 3: Eksplorasi Ubud Monkey Forest, Tegallalang Rice Terrace, Kintamani\nHari 4: Belanja oleh-oleh & kepulangan','Hotel bintang 3/4\nTransportasi AC selama tour\nMakan sesuai program\nTiket masuk objek wisata\nPemandu wisata lokal\nAir mineral','Tiket pesawat\nPengeluaran pribadi\nTips pemandu & driver','https://picsum.photos/seed/bali-pkg0/1200/800',4.7,1,1,'2026-11-05 10:54:48','2026-11-05 10:54:48'),
(2,1,'Bali Honeymoon Romantic Escape','bali-honeymoon-romantic-escape',5,4,6750000,NULL,15,'Highlight: Private villa, candle light dinner, Nusa Penida.','Paket Bali Honeymoon Romantic Escape dirancang untuk Anda yang ingin menikmati Bali secara maksimal. Highlight perjalanan: Private villa, candle light dinner, Nusa Penida.','Hari 1: Penjemputan & check-in hotel\nHari 2: Eksplorasi Private villa, candle light dinner, Nusa Penida\nHari 3: Eksplorasi Private villa, candle light dinner, Nusa Penida\nHari 4: Eksplorasi Private villa, candle light dinner, Nusa Penida\nHari 5: Belanja oleh-oleh & kepulangan','Hotel bintang 3/4\nTransportasi AC selama tour\nMakan sesuai program\nTiket masuk objek wisata\nPemandu wisata lokal\nAir mineral','Tiket pesawat\nPengeluaran pribadi\nTips pemandu & driver','https://picsum.photos/seed/bali-pkg1/1200/800',4.8,0,1,'2026-11-05 10:54:48','2026-11-05 10:54:48'),
(3,2,'Sailing Komodo 3D2N','sailing-komodo-3d2n',3,2,4500000,3990000,15,'Highlight: Pulau Padar, Pink Beach, Pulau Komodo, Manta Point.','Paket Sailing Komodo 3D2N dirancang untuk Anda yang ingin menikmati Labuan Bajo secara maksimal. Highlight perjalanan: Pulau Padar, Pink Beach, Pulau Komodo, Manta Point.','Hari 1: Penjemputan & check-in hotel\nHari 2: Eksplorasi Pulau Padar, Pink Beach, Pulau Komodo, Manta Point\nHari 3: Belanja oleh-oleh & kepulangan','Hotel bintang 3/4\nTransportasi AC selama tour\nMakan sesuai program\nTiket masuk objek wisata\nPemandu wisata lokal\nAir mineral','Tiket pesawat\nPengeluaran pribadi\nTips pemandu & driver','https://picsum.photos/seed/labuan-bajo-pkg0/1200/800',4.8,1,1,'2026-11-05 10:54:48','2026-11-05 10:54:48'),
(4,3,'Raja Ampat Diving Paradise','raja-ampat-diving-paradise',5,4,12500000,NULL,15,'Highlight: Piaynemo, Pasir Timbul, Arborek, Diving Cape Kri.','Paket Raja Ampat Diving Paradise dirancang untuk Anda yang ingin menikmati Raja Ampat secara maksimal. Highlight perjalanan: Piaynemo, Pasir Timbul, Arborek, Diving Cape Kri.','Hari 1: Penjemputan & check-in hotel\nHari 2: Eksplorasi Piaynemo, Pasir Timbul, Arborek, Diving Cape Kri\nHari 3: Eksplorasi Piaynemo, Pasir Timbul, Arborek, Diving Cape Kri\nHari 4: Eksplorasi Piaynemo, Pasir Timbul, Arborek, Diving Cape Kri\nHari 5: Belanja oleh-oleh & kepulangan','Hotel bintang 3/4\nTransportasi AC selama tour\nMakan sesuai program\nTiket masuk objek wisata\nPemandu wisata lokal\nAir mineral','Tiket pesawat\nPengeluaran pribadi\nTips pemandu & driver','https://picsum.photos/seed/raja-ampat-pkg0/1200/800',4.9,1,1,'2026-11-05 10:54:48','2026-11-05 10:54:48'),
(5,4,'Jogja Heritage Tour','jogja-heritage-tour',3,2,1850000,1650000,15,'Highlight: Borobudur Sunrise, Prambanan, Keraton, Malioboro.','Paket Jogja Heritage Tour dirancang untuk Anda yang ingin menikmati Yogyakarta secara maksimal. Highlight perjalanan: Borobudur Sunrise, Prambanan, Keraton, Malioboro.','Hari 1: Penjemputan & check-in hotel\nHari 2: Eksplorasi Borobudur Sunrise, Prambanan, Keraton, Malioboro\nHari 3: Belanja oleh-oleh & kepulangan','Hotel bintang 3/4\nTransportasi AC selama tour\nMakan sesuai program\nTiket masuk objek wisata\nPemandu wisata lokal\nAir mineral','Tiket pesawat\nPengeluaran pribadi\nTips pemandu & driver','https://picsum.photos/seed/yogyakarta-pkg0/1200/800',5.0,1,1,'2026-11-05 10:54:48','2026-11-05 10:54:48'),
(6,4,'Jogja Adventure Merapi & Pantai','jogja-adventure-merapi-pantai',2,1,1250000,NULL,15,'Highlight: Lava Tour Merapi, Goa Pindul, Pantai Timang.','Paket Jogja Adventure Merapi & Pantai dirancang untuk Anda yang ingin menikmati Yogyakarta secara maksimal. Highlight perjalanan: Lava Tour Merapi, Goa Pindul, Pantai Timang.','Hari 1: Penjemputan & check-in hotel\nHari 2: Belanja oleh-oleh & kepulangan','Hotel bintang 3/4\nTransportasi AC selama tour\nMakan sesuai program\nTiket masuk objek wisata\nPemandu wisata lokal\nAir mineral','Tiket pesawat\nPengeluaran pribadi\nTips pemandu & driver','https://picsum.photos/seed/yogyakarta-pkg1/1200/800',4.7,0,1,'2026-11-05 10:54:48','2026-11-05 10:54:48'),
(7,5,'Lombok & Gili Island Hopping','lombok-gili-island-hopping',4,3,3150000,NULL,15,'Highlight: Gili Trawangan, Gili Meno, Pantai Pink, Desa Sade.','Paket Lombok & Gili Island Hopping dirancang untuk Anda yang ingin menikmati Lombok secara maksimal. Highlight perjalanan: Gili Trawangan, Gili Meno, Pantai Pink, Desa Sade.','Hari 1: Penjemputan & check-in hotel\nHari 2: Eksplorasi Gili Trawangan, Gili Meno, Pantai Pink, Desa Sade\nHari 3: Eksplorasi Gili Trawangan, Gili Meno, Pantai Pink, Desa Sade\nHari 4: Belanja oleh-oleh & kepulangan','Hotel bintang 3/4\nTransportasi AC selama tour\nMakan sesuai program\nTiket masuk objek wisata\nPemandu wisata lokal\nAir mineral','Tiket pesawat\nPengeluaran pribadi\nTips pemandu & driver','https://picsum.photos/seed/lombok-pkg0/1200/800',4.7,1,1,'2026-11-05 10:54:48','2026-11-05 10:54:48'),
(8,6,'Pesona Danau Toba & Samosir','pesona-danau-toba-samosir',4,3,2750000,2490000,15,'Highlight: Pulau Samosir, Tomok, Air Terjun Sipiso-piso, Parapat.','Paket Pesona Danau Toba & Samosir dirancang untuk Anda yang ingin menikmati Danau Toba secara maksimal. Highlight perjalanan: Pulau Samosir, Tomok, Air Terjun Sipiso-piso, Parapat.','Hari 1: Penjemputan & check-in hotel\nHari 2: Eksplorasi Pulau Samosir, Tomok, Air Terjun Sipiso-piso, Parapat\nHari 3: Eksplorasi Pulau Samosir, Tomok, Air Terjun Sipiso-piso, Parapat\nHari 4: Belanja oleh-oleh & kepulangan','Hotel bintang 3/4\nTransportasi AC selama tour\nMakan sesuai program\nTiket masuk objek wisata\nPemandu wisata lokal\nAir mineral','Tiket pesawat\nPengeluaran pribadi\nTips pemandu & driver','https://picsum.photos/seed/danau-toba-pkg0/1200/800',4.8,1,1,'2026-11-05 10:54:48','2026-11-05 10:54:48'),
(9,7,'Bromo Midnight Sunrise Tour','bromo-midnight-sunrise-tour',2,1,950000,NULL,15,'Highlight: Penanjakan, Kawah Bromo, Pasir Berbisik, Bukit Teletubbies.','Paket Bromo Midnight Sunrise Tour dirancang untuk Anda yang ingin menikmati Bromo secara maksimal. Highlight perjalanan: Penanjakan, Kawah Bromo, Pasir Berbisik, Bukit Teletubbies.','Hari 1: Penjemputan & check-in hotel\nHari 2: Belanja oleh-oleh & kepulangan','Hotel bintang 3/4\nTransportasi AC selama tour\nMakan sesuai program\nTiket masuk objek wisata\nPemandu wisata lokal\nAir mineral','Tiket pesawat\nPengeluaran pribadi\nTips pemandu & driver','https://picsum.photos/seed/bromo-pkg0/1200/800',4.9,1,1,'2026-11-05 10:54:48','2026-11-05 10:54:48'),
(10,8,'Wakatobi Marine Escape','wakatobi-marine-escape',4,3,7850000,NULL,15,'Highlight: Snorkeling Hoga, Pulau Tomia, Desa Bajo Mola.','Paket Wakatobi Marine Escape dirancang untuk Anda yang ingin menikmati Wakatobi secara maksimal. Highlight perjalanan: Snorkeling Hoga, Pulau Tomia, Desa Bajo Mola.','Hari 1: Penjemputan & check-in hotel\nHari 2: Eksplorasi Snorkeling Hoga, Pulau Tomia, Desa Bajo Mola\nHari 3: Eksplorasi Snorkeling Hoga, Pulau Tomia, Desa Bajo Mola\nHari 4: Belanja oleh-oleh & kepulangan','Hotel bintang 3/4\nTransportasi AC selama tour\nMakan sesuai program\nTiket masuk objek wisata\nPemandu wisata lokal\nAir mineral','Tiket pesawat\nPengeluaran pribadi\nTips pemandu & driver','https://picsum.photos/seed/wakatobi-pkg0/1200/800',5.0,1,1,'2026-11-05 10:54:48','2026-11-05 10:54:48');
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
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
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` varchar(300) DEFAULT NULL,
  `body` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_category_id_foreign` (`category_id`),
  KEY `posts_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES
(1,1,1,'10 Tips Hemat Liburan ke Bali','10-tips-hemat-liburan-ke-bali','Liburan ke Bali tidak harus mahal. Simak tips berikut agar perjalanan tetap seru dengan budget terkendali.','<p>Liburan ke Bali tidak harus mahal. Simak tips berikut agar perjalanan tetap seru dengan budget terkendali.</p>\n<h2>Persiapan Sebelum Berangkat</h2>\n<p>Rencanakan perjalanan Anda jauh-jauh hari untuk mendapatkan harga tiket dan akomodasi terbaik. Pastikan juga Anda mengecek cuaca dan kondisi destinasi.</p>\n<h2>Selama Perjalanan</h2>\n<p>Hormati budaya dan adat setempat, jaga kebersihan lingkungan, dan dukung ekonomi lokal dengan membeli produk UMKM.</p>\n<p>Butuh bantuan merencanakan perjalanan? Tim Nusantara Trip siap membantu Anda!</p>','https://picsum.photos/seed/blog1/1200/800','published','2026-11-02 10:54:48','2026-11-05 10:54:48','2026-11-05 10:54:48'),
(2,2,1,'Panduan Lengkap Trip ke Labuan Bajo','panduan-lengkap-trip-ke-labuan-bajo','Mulai dari waktu terbaik berkunjung hingga itinerary sailing trip yang wajib Anda coba.','<p>Mulai dari waktu terbaik berkunjung hingga itinerary sailing trip yang wajib Anda coba.</p>\n<h2>Persiapan Sebelum Berangkat</h2>\n<p>Rencanakan perjalanan Anda jauh-jauh hari untuk mendapatkan harga tiket dan akomodasi terbaik. Pastikan juga Anda mengecek cuaca dan kondisi destinasi.</p>\n<h2>Selama Perjalanan</h2>\n<p>Hormati budaya dan adat setempat, jaga kebersihan lingkungan, dan dukung ekonomi lokal dengan membeli produk UMKM.</p>\n<p>Butuh bantuan merencanakan perjalanan? Tim Nusantara Trip siap membantu Anda!</p>','https://picsum.photos/seed/blog2/1200/800','published','2026-10-30 10:54:48','2026-11-05 10:54:48','2026-11-05 10:54:48'),
(3,3,1,'7 Kuliner Khas Yogyakarta yang Wajib Dicoba','7-kuliner-khas-yogyakarta-yang-wajib-dicoba','Gudeg, bakpia, sate klathak, dan kuliner legendaris lain yang membuat Anda ingin kembali ke Jogja.','<p>Gudeg, bakpia, sate klathak, dan kuliner legendaris lain yang membuat Anda ingin kembali ke Jogja.</p>\n<h2>Persiapan Sebelum Berangkat</h2>\n<p>Rencanakan perjalanan Anda jauh-jauh hari untuk mendapatkan harga tiket dan akomodasi terbaik. Pastikan juga Anda mengecek cuaca dan kondisi destinasi.</p>\n<h2>Selama Perjalanan</h2>\n<p>Hormati budaya dan adat setempat, jaga kebersihan lingkungan, dan dukung ekonomi lokal dengan membeli produk UMKM.</p>\n<p>Butuh bantuan merencanakan perjalanan? Tim Nusantara Trip siap membantu Anda!</p>','https://picsum.photos/seed/blog3/1200/800','published','2026-10-27 10:54:48','2026-11-05 10:54:48','2026-11-05 10:54:48'),
(4,1,1,'Barang Wajib Dibawa Saat Mendaki Bromo','barang-wajib-dibawa-saat-mendaki-bromo','Suhu di Bromo bisa mencapai 5°C saat dini hari. Persiapkan perlengkapan berikut agar tetap nyaman.','<p>Suhu di Bromo bisa mencapai 5°C saat dini hari. Persiapkan perlengkapan berikut agar tetap nyaman.</p>\n<h2>Persiapan Sebelum Berangkat</h2>\n<p>Rencanakan perjalanan Anda jauh-jauh hari untuk mendapatkan harga tiket dan akomodasi terbaik. Pastikan juga Anda mengecek cuaca dan kondisi destinasi.</p>\n<h2>Selama Perjalanan</h2>\n<p>Hormati budaya dan adat setempat, jaga kebersihan lingkungan, dan dukung ekonomi lokal dengan membeli produk UMKM.</p>\n<p>Butuh bantuan merencanakan perjalanan? Tim Nusantara Trip siap membantu Anda!</p>','https://picsum.photos/seed/blog4/1200/800','published','2026-10-24 10:54:48','2026-11-05 10:54:48','2026-11-05 10:54:48');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
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
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES
(1,'site_name','Nusantara Trip','2026-11-05 10:54:48','2026-11-05 10:54:48'),
(2,'site_tagline','Jelajahi Keindahan Indonesia','2026-11-05 10:54:48','2026-11-05 10:54:48'),
(3,'hero_title','Jelajahi Pesona Nusantara Bersama Kami','2026-11-05 10:54:48','2026-11-05 10:54:48'),
(4,'hero_subtitle','Paket tour terbaik ke Bali, Labuan Bajo, Raja Ampat, Yogyakarta, dan ratusan destinasi menakjubkan lainnya.','2026-11-05 10:54:48','2026-11-05 10:54:48'),
(5,'hero_image','https://picsum.photos/seed/nusantara-hero/1920/1080','2026-11-05 10:54:48','2026-11-05 10:54:48'),
(6,'about_text','Nusantara Trip adalah agen tour & travel yang berdiri sejak 2015 dan telah melayani lebih dari 25.000 wisatawan. Kami percaya setiap perjalanan adalah cerita, dan kami hadir untuk memastikan cerita Anda tak terlupakan.\n\nDengan pemandu lokal berpengalaman, armada yang nyaman, dan harga transparan, kami siap mengantar Anda menjelajahi keindahan Indonesia dari Sabang sampai Merauke.','2026-11-05 10:54:48','2026-11-05 10:54:48'),
(7,'contact_email','halo@nusantaratrip.id','2026-11-05 10:54:48','2026-11-05 10:54:48'),
(8,'contact_phone','(021) 555-0123','2026-11-05 10:54:48','2026-11-05 10:54:48'),
(9,'contact_whatsapp','6281234567890','2026-11-05 10:54:48','2026-11-05 10:54:48'),
(10,'contact_address','Jl. Sudirman No. 45, Jakarta Pusat, DKI Jakarta 10220','2026-11-05 10:54:48','2026-11-05 10:54:48'),
(11,'social_instagram','https://instagram.com/','2026-11-05 10:54:48','2026-11-05 10:54:48'),
(12,'social_facebook','https://facebook.com/','2026-11-05 10:54:48','2026-11-05 10:54:48'),
(13,'social_tiktok','https://tiktok.com/','2026-11-05 10:54:48','2026-11-05 10:54:48');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `rating` tinyint(3) unsigned NOT NULL DEFAULT 5,
  `photo` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES
(1,'Rina Kartika','Jakarta','Trip ke Labuan Bajo luar biasa! Kapalnya nyaman, guide-nya ramah dan sangat informatif. Pasti ikut lagi.',5,NULL,1,'2026-11-05 10:54:48','2026-11-05 10:54:48'),
(2,'Budi Santoso','Surabaya','Paket Jogja Heritage sangat worth it. Itinerary rapi dan hotelnya strategis dekat Malioboro.',5,NULL,1,'2026-11-05 10:54:48','2026-11-05 10:54:48'),
(3,'Dewi Lestari','Bandung','Honeymoon ke Bali jadi sangat berkesan. Semua diatur dengan detail, kami tinggal menikmati.',5,NULL,1,'2026-11-05 10:54:48','2026-11-05 10:54:48'),
(4,'Andi Pratama','Makassar','Pelayanan cepat dan responsif via WhatsApp. Harga transparan tanpa biaya tersembunyi.',5,NULL,1,'2026-11-05 10:54:48','2026-11-05 10:54:48');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'editor',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `avatar` varchar(255) DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Administrator','admin@tourntravel.test',NULL,'$2y$12$Xi92LuVH30qvlN3jkP0dlO3S/wo2rggtazcJoDYlkwHSB3uGvCG72','admin',1,NULL,NULL,NULL,'2026-11-05 10:54:48','2026-11-05 10:54:48'),
(2,'Editor Konten','editor@tourntravel.test',NULL,'$2y$12$jtbyTUbzWJKj7fr3DKUIO.g8qfAM7TaARkdTwGsNcJ96DovjHm..u','editor',1,NULL,NULL,NULL,'2026-11-05 10:54:48','2026-11-05 10:54:48');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'tourntravel'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed
