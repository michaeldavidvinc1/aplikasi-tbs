-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table aplikasi-tbs.cache
DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aplikasi-tbs.cache: ~0 rows (approximately)
DELETE FROM `cache`;

-- Dumping structure for table aplikasi-tbs.cache_locks
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aplikasi-tbs.cache_locks: ~0 rows (approximately)
DELETE FROM `cache_locks`;

-- Dumping structure for table aplikasi-tbs.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
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

-- Dumping data for table aplikasi-tbs.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table aplikasi-tbs.harga_tbs
DROP TABLE IF EXISTS `harga_tbs`;
CREATE TABLE IF NOT EXISTS `harga_tbs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `harga_per_kilo` int NOT NULL,
  `berlaku` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aplikasi-tbs.harga_tbs: ~0 rows (approximately)
DELETE FROM `harga_tbs`;
INSERT INTO `harga_tbs` (`id`, `harga_per_kilo`, `berlaku`, `created_at`, `updated_at`) VALUES
	(1, 1500, '2025-06-16', '2025-06-09 00:29:40', '2025-06-09 00:29:40');

-- Dumping structure for table aplikasi-tbs.invoices
DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaksi_id` bigint unsigned NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aplikasi-tbs.invoices: ~8 rows (approximately)
DELETE FROM `invoices`;
INSERT INTO `invoices` (`id`, `transaksi_id`, `file_path`, `created_at`, `updated_at`) VALUES
	(1, 1, 'invoices/invoice_T63BACWAhunuQxNcA6PI.pdf', '2025-06-09 00:43:12', '2025-06-09 00:43:12'),
	(2, 2, 'invoices/invoice_HKNbgmgkdIGhMacOgIuH.pdf', '2025-06-09 00:54:07', '2025-06-09 00:54:07'),
	(3, 3, 'invoices/invoice_axezzi1QZBQlwAtPumCQ.pdf', '2025-06-09 00:55:45', '2025-06-09 00:55:45'),
	(4, 4, 'invoices/invoice_ZDolR1V9mas4WPsl3N2H.pdf', '2025-06-09 00:57:23', '2025-06-09 00:57:23'),
	(5, 5, 'invoices/invoice_cXccRM0KNbZUhVlo2leN.pdf', '2025-06-09 01:11:46', '2025-06-09 01:11:46'),
	(6, 6, 'invoices/invoice_moiNIlE6gysHn6uHrqIy.pdf', '2025-06-09 01:15:58', '2025-06-09 01:15:58'),
	(7, 7, 'invoices/invoice_o0Bce7cpyfEHDZJ9odfp.pdf', '2025-06-09 01:17:46', '2025-06-09 01:17:46'),
	(8, 8, 'invoices/invoice_tEUrj6hFhmgzVqvTm9c0.pdf', '2025-06-09 01:18:27', '2025-06-09 01:18:27');

-- Dumping structure for table aplikasi-tbs.jobs
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
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

-- Dumping data for table aplikasi-tbs.jobs: ~0 rows (approximately)
DELETE FROM `jobs`;

-- Dumping structure for table aplikasi-tbs.job_batches
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
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

-- Dumping data for table aplikasi-tbs.job_batches: ~0 rows (approximately)
DELETE FROM `job_batches`;

-- Dumping structure for table aplikasi-tbs.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aplikasi-tbs.migrations: ~0 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_05_23_151822_create_harga_tbs_table', 1),
	(5, '2025_05_23_151928_create_tbs_offers_table', 1),
	(6, '2025_05_23_151935_create_transaksis_table', 1),
	(7, '2025_05_23_151940_create_invoices_table', 1);

-- Dumping structure for table aplikasi-tbs.password_reset_tokens
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aplikasi-tbs.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping structure for table aplikasi-tbs.sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
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

-- Dumping data for table aplikasi-tbs.sessions: ~2 rows (approximately)
DELETE FROM `sessions`;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('d8MyjJ348ziIv1w1FizSDCZvxu3PJM4FRukt15YF', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZnV2RHlhNDAyZVNMVzU1dEl5bFRONUtjOEVEYldRcjZTTkd6dDNWUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ0OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvcGV0YW5pL2tpcmltLXBlbmF3YXJhbiI7fX0=', 1749455734),
	('YEelj1GTMjuHXeMK5QELhuLkLSJLvN0WFELMlTxN', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVlJpVG9TUmVJbHRmWEhhbW52N29tUk9WUUhHRnp2SnJhQ1BFaE01OCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9rb3BlcmFzaS90cmFuc2Frc2ktYWt0aWYiO31zOjE4OiJmbGFzaGVyOjplbnZlbG9wZXMiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1749457107);

-- Dumping structure for table aplikasi-tbs.tbs_offers
DROP TABLE IF EXISTS `tbs_offers`;
CREATE TABLE IF NOT EXISTS `tbs_offers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `tonase` int NOT NULL,
  `kualitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('menunggu','terima','tolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aplikasi-tbs.tbs_offers: ~8 rows (approximately)
DELETE FROM `tbs_offers`;
INSERT INTO `tbs_offers` (`id`, `user_id`, `tonase`, `kualitas`, `supir`, `plat`, `lokasi`, `status`, `created_at`, `updated_at`) VALUES
	(1, 2, 71, 'Labore qui illum do', 'Agus', 'BM 1010 AS', 'Minim nobis facilis ', 'terima', '2025-06-09 00:32:50', '2025-06-09 00:54:04'),
	(2, 2, 11, 'Cum laborum rerum mo', 'Budi', 'BM 1111 SS', 'Neque ipsum molestia', 'terima', '2025-06-09 00:33:23', '2025-06-09 00:33:48'),
	(3, 2, 21, 'Iste excepturi quia ', 'Fad', 'BM 1013 AS', 'Qui temporibus culpa', 'terima', '2025-06-09 00:55:34', '2025-06-09 00:55:40'),
	(4, 2, 28, 'Id ut odit laborum q', 'Ea odit distinctio ', 'G 101 A', 'Similique qui sit n', 'terima', '2025-06-09 00:56:57', '2025-06-09 01:11:33'),
	(5, 2, 20, 'Enim ut ipsam dolori', 'Voluptatem Dolores ', 'P 2829 V', 'Cum sit ipsam tempo', 'terima', '2025-06-09 00:57:05', '2025-06-09 00:57:20'),
	(6, 2, 76, 'Sed tempor sed disti', 'Similique repudianda', 'K 1919', 'Itaque aliquid unde ', 'terima', '2025-06-09 01:15:15', '2025-06-09 01:18:25'),
	(7, 2, 64, 'Blanditiis impedit ', 'Recusandae Odio per', 'I 8373', 'Adipisci quia esse ', 'terima', '2025-06-09 01:15:23', '2025-06-09 01:17:43'),
	(8, 2, 4, 'Eum explicabo Quia ', 'Qui facilis tempor i', 'KM 0938', 'Quis sint totam recu', 'terima', '2025-06-09 01:15:30', '2025-06-09 01:15:54');

-- Dumping structure for table aplikasi-tbs.transaksis
DROP TABLE IF EXISTS `transaksis`;
CREATE TABLE IF NOT EXISTS `transaksis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `offer_id` bigint unsigned NOT NULL,
  `harga_beli` int NOT NULL,
  `total_bayar` int NOT NULL,
  `status` enum('belum bayar','sudah bayar') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum bayar',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aplikasi-tbs.transaksis: ~8 rows (approximately)
DELETE FROM `transaksis`;
INSERT INTO `transaksis` (`id`, `offer_id`, `harga_beli`, `total_bayar`, `status`, `created_at`, `updated_at`) VALUES
	(1, 2, 1500, 16500, 'sudah bayar', '2025-06-09 00:33:48', '2025-06-09 00:43:12'),
	(2, 1, 1500, 106500, 'sudah bayar', '2025-06-09 00:54:04', '2025-06-09 00:54:07'),
	(3, 3, 1500, 31500, 'sudah bayar', '2025-06-09 00:55:40', '2025-06-09 00:55:45'),
	(4, 5, 1500, 30000, 'sudah bayar', '2025-06-09 00:57:20', '2025-06-09 00:57:23'),
	(5, 4, 1500, 42000, 'sudah bayar', '2025-06-09 01:11:33', '2025-06-09 01:11:46'),
	(6, 8, 1500, 6000, 'sudah bayar', '2025-06-09 01:15:54', '2025-06-09 01:15:58'),
	(7, 7, 1500, 96000, 'sudah bayar', '2025-06-09 01:17:43', '2025-06-09 01:17:46'),
	(8, 6, 1500, 114000, 'sudah bayar', '2025-06-09 01:18:25', '2025-06-09 01:18:27');

-- Dumping structure for table aplikasi-tbs.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` enum('ADMIN','PETANI','KOPERASI') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PETANI',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aplikasi-tbs.users: ~2 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin@gmail.com', '2025-06-09 00:29:39', 'ADMIN', '$2y$12$GAAp8ahbFw8Zt1uozr1Ev.z2IQ7KbMBs9JsUzdnrLAziH9qb.2fsa', 'v9HVrG7b1H', '2025-06-09 00:29:39', '2025-06-09 00:29:39'),
	(2, 'Petani', 'petani@gmail.com', '2025-06-09 00:29:39', 'PETANI', '$2y$12$wVVy65rdrMS4oKzGY1xEvuUL3/4CRgjgZTVnlbfoheR/TiIqBrQ/y', 'lHAqf26XHITVVypFWmGE2dzqWKDnFHymhisNQxScToKCvNEi6hnRenifLv6s', '2025-06-09 00:29:39', '2025-06-09 00:29:39'),
	(3, 'Koperasi', 'koperasi@gmail.com', '2025-06-09 00:29:40', 'KOPERASI', '$2y$12$Xgs1Wc12.Y963SegZfYaC.sefZYlf1t/zf9Kcme6PHNdkhak4tJOK', 'TlHDGGOOYNbQqbiHpZnibufxUVuO9vxyruTdcQFM7irHfoTB2ncq3eKpcbNB', '2025-06-09 00:29:40', '2025-06-09 00:29:40');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
