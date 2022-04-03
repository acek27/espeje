-- MariaDB dump 10.19  Distrib 10.5.13-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: espeje
-- ------------------------------------------------------
-- Server version	10.5.13-MariaDB-1:10.5.13+maria~focal

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
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (61,'2014_10_12_000000_create_users_table',1),(62,'2014_10_12_100000_create_password_resets_table',1),(63,'2019_08_19_000000_create_failed_jobs_table',1),(64,'2019_12_14_000001_create_personal_access_tokens_table',1),(65,'2022_03_13_070229_create_subkegiatans_table',1),(66,'2022_03_13_070247_create_uraians_table',1),(67,'2022_03_25_100922_create_spjs_table',1),(68,'2022_03_28_082137_create_revisis_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` tinyint(3) unsigned NOT NULL,
  `role_id` tinyint(3) unsigned NOT NULL,
  KEY `permission_id` (`permission_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `permission_role_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (6,7),(2,7),(1,1),(1,3),(1,1),(3,4),(4,5),(5,6),(1,2);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'CRUD SPJ',1),(2,'CRUD Rekening',1),(3,'Validasi Pertama',1),(4,'Validasi Lanjutan',1),(5,'View SPJ',1),(6,'Superuser',1);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `revisis`
--

DROP TABLE IF EXISTS `revisis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `revisis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `spj_id` bigint(20) unsigned NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `tanggal_submit` date DEFAULT NULL,
  `tanggal_verifikasi` date DEFAULT NULL,
  `validator_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `validator_id` (`validator_id`),
  KEY `spj_id` (`spj_id`),
  CONSTRAINT `revisis_ibfk_1` FOREIGN KEY (`spj_id`) REFERENCES `spjs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `revisis_ibfk_2` FOREIGN KEY (`validator_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `revisis`
--

LOCK TABLES `revisis` WRITE;
/*!40000 ALTER TABLE `revisis` DISABLE KEYS */;
INSERT INTO `revisis` VALUES (1,1,'Perbaiki',2,'2022-04-03',NULL,4,'2022-04-03 14:11:44','2022-04-03 14:12:02',NULL),(2,1,'salah tandatangan',2,'2022-04-03',NULL,5,'2022-04-03 14:13:07','2022-04-03 14:13:44',NULL);
/*!40000 ALTER TABLE `revisis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `role_id` tinyint(3) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  KEY `role_id` (`role_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `role_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (7,6),(1,1),(2,2),(3,3),(4,4),(5,5),(6,7);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Tata Usaha',1),(2,'Rumah Tangga',1),(3,'Perlengkapan',1),(4,'Validator Penata Usaha',1),(5,'Validator LS/GU',1),(6,'KABAG',1),(7,'Admin Umum',1);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spjs`
--

DROP TABLE IF EXISTS `spjs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spjs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uraian_id` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pptk_id` bigint(20) unsigned DEFAULT NULL,
  `bidang_id` tinyint(4) DEFAULT NULL,
  `jumlah` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `spjs_uraian_id_foreign` (`uraian_id`),
  CONSTRAINT `spjs_uraian_id_foreign` FOREIGN KEY (`uraian_id`) REFERENCES `uraians` (`kode_rek`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spjs`
--

LOCK TABLES `spjs` WRITE;
/*!40000 ALTER TABLE `spjs` DISABLE KEYS */;
INSERT INTO `spjs` VALUES (1,'05.02.02.02.01.1',1,1,'350000',2,3,'2022-04-03 07:53:22','2022-04-03 14:32:11',NULL),(2,'05.02.02.02.04.1',1,1,'503000',NULL,0,'2022-04-03 07:17:12','2022-04-03 07:17:12',NULL);
/*!40000 ALTER TABLE `spjs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subkegiatans`
--

DROP TABLE IF EXISTS `subkegiatans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subkegiatans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_rek` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_sub` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subkegiatans_kode_rek_unique` (`kode_rek`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subkegiatans`
--

LOCK TABLES `subkegiatans` WRITE;
/*!40000 ALTER TABLE `subkegiatans` DISABLE KEYS */;
INSERT INTO `subkegiatans` VALUES (1,'05.02.02.02.1','Penyedia Jasa Transportasi',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(2,'05.02.02.02.2','Penyedia Makan dan Minum',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(3,'05.02.02.02.4','Penyedia Kebutuhan Tambahan ',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(4,'06.02.02.01.2','Penyedia Jasa Pegawai Kantor',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(5,'06.02.02.04.4','Penyedia Barang Kantor',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(6,'06.02.02.04.5','Penyedia Peralatan Rumah Tangga 22',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(7,'07.01.01.06.1','Penyedia Logistik',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(8,'07.01.01.06.2','Penyedia  Pakaian Pegawai',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(9,'07.01.01.06.3','Penyedia BBM',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(10,'07.01.01.06.4','Pemeliharaan Transportasi',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(11,'07.02.02.02.5','Pemeliharaan Barang Kantor',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(12,'07.02.02.02.6','Pemeliharaan Peralatan Kantor',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(13,'07.02.02.02.7','Pemeliharaan Gedung Kantor',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(14,'08.01.01.01.1','Pemeliharaan Kendaraan Kantor',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(15,'08.01.01.01.2','Pemeliharaan Barang tambahan kantor',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(16,'08.01.01.01.3','Penyedia Gaji',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(17,'08.01.01.01.4','Pemeliharaan Fasilitas',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(18,'08.01.01.01.5','Penyedia Tunjangan',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(19,'08.01.01.01.6','Pemeliharaan Barang Bersama',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(20,'08.01.01.02.1','Penyedia Kebutuhan Perlengkapan',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(21,'08.01.01.01.7','Pemeliharaan Barang Perlengkapan',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL);
/*!40000 ALTER TABLE `subkegiatans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uraians`
--

DROP TABLE IF EXISTS `uraians`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uraians` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_rek` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_id` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_uraian` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uraians_kode_rek_unique` (`kode_rek`),
  KEY `uraians_sub_id_foreign` (`sub_id`),
  CONSTRAINT `uraians_sub_id_foreign` FOREIGN KEY (`sub_id`) REFERENCES `subkegiatans` (`kode_rek`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uraians`
--

LOCK TABLES `uraians` WRITE;
/*!40000 ALTER TABLE `uraians` DISABLE KEYS */;
INSERT INTO `uraians` VALUES (1,'05.02.02.02.01.1','05.02.02.02.1','Penyedia Jasa Transportasi','1908000',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(2,'05.02.02.02.01.2','05.02.02.02.1','Penyedia Makan dan Minum','98499000',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(3,'05.02.02.02.01.3','05.02.02.02.1','Penyedia Kebutuhan Tambahan ','3243400000',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(4,'05.02.02.02.02.1','05.02.02.02.2','Penyedia Jasa Pegawai Kantor','245300000',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(5,'05.02.02.02.02.2','05.02.02.02.2','Penyedia Barang Kantor','43425655',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(6,'05.02.02.02.02.3','05.02.02.02.2','Penyedia Peralatan Rumah Tangga 22','4400000',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(7,'05.02.02.02.04.1','05.02.02.02.4','Penyedia Logistik','2233400000',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(8,'05.02.02.02.04.2','05.02.02.02.4','Penyedia  Pakaian Pegawai','564050000',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(9,'06.02.02.01.02.1','06.02.02.01.2','Penyedia BBM','256000000',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(10,'06.02.02.01.02.2','06.02.02.01.2','Pemeliharaan Transportasi','3659780000',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(11,'06.02.02.04.04.1','06.02.02.04.4','Pemeliharaan Barang Kantor','456400000',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(12,'06.02.02.04.04.2','06.02.02.04.4','Pemeliharaan Peralatan Kantor','5455500000',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(13,'06.02.02.04.05.1','06.02.02.04.5','Pemeliharaan Gedung Kantor','232200000',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(14,'07.01.01.06.01.1','07.01.01.06.1','Pemeliharaan Kendaraan Kantor','373350000',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL),(15,'07.01.01.06.02.1','07.01.01.06.2','Pemeliharaan Barang tambahan kantor','67800000',1,'2018-10-01 05:12:58','2018-10-01 05:12:59',NULL);
/*!40000 ALTER TABLE `uraians` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` tinyint(4) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Alice Stuicy','tatausaha','pegawaiTU@gmail.com','681234567890',1,NULL,'$2y$10$o3ge31WlcsZbMzFBTqW02O0KwDDPqEp76gN8iH2IbB67rCxcESHiu',NULL,'2022-04-02 04:39:17','2022-04-02 13:59:52',NULL),(2,'Grace Mercy','rumahtangga','pegawaiRT@gmail.com','687727711876',2,NULL,'$2y$10$aQBujALVxlhlnOTJIm9cDOkdvVDk.uf0bnFD3tl6Jb924yTAKeuSW',NULL,'2022-04-02 04:41:40','2022-04-02 04:41:40',NULL),(3,'Alexander Priano','perlengkapan','pegawaiPP@gmail.com','682988332544',3,NULL,'$2y$10$r9ieTOX9IKujIWQaJ3OeAumkBpGClrWsXQCmpmd1WfT5YTMciculK',NULL,'2022-04-02 04:42:13','2022-04-02 04:42:13',NULL),(4,'Hadwin Holahop','penatausaha','verifone@gmail.com','681176634122',4,NULL,'$2y$10$b7ostlO8UrKT61cy0unljuM2GM6bNrYXVZpPo3GPfKTCtkHOAkqv2',NULL,'2022-04-02 04:43:12','2022-04-02 04:43:12',NULL),(5,'Raisa Andriana','lsgu','veriftwo@gmail.com','683342365522',5,NULL,'$2y$10$KRhameslgBqu3wJ9p/v7I.tTPdi1UH.W1iUF5aOMRFQ.4XJXvv0fi',NULL,'2022-04-02 04:45:24','2022-04-02 04:45:24',NULL),(6,'Ini Punya Admin','admin','admin@gmail.com','689683163122',7,NULL,'$2y$10$KRhameslgBqu3wJ9p/v7I.tTPdi1UH.W1iUF5aOMRFQ.4XJXvv0fi',NULL,'2022-04-02 04:46:09','2022-04-02 14:52:05',NULL),(7,'Kepala Bagian','kabagumum','kabag@gmail.com','896844541555',6,NULL,'$2y$10$T3GDN7.TEwm8fxqxI22BJevizkBT/GcPXVdkSQ6rJXrRldpeIq2ai',NULL,'2022-04-02 04:47:08','2022-04-02 14:52:54',NULL);
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

-- Dump completed on 2022-04-03 21:35:21
