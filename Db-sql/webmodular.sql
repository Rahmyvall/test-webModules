-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 07, 2025 at 05:47 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webmodular`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Teknologi', 'teknologi', 'Artikel dan berita terbaru seputar perkembangan teknologi.', '0', '2025-11-06 00:45:04', '2025-11-05 19:16:21'),
(2, 'Bisnis', 'bisnis', 'Tips dan strategi dalam mengembangkan bisnis modern.', '1', '2025-11-06 00:45:04', '2025-11-06 00:45:04'),
(3, 'Pendidikan', 'pendidikan', 'Konten edukatif dan informasi dunia pendidikan.', '1', '2025-11-06 00:45:04', '2025-11-06 00:45:04'),
(4, 'Kesehatan', 'kesehatan', 'Artikel tentang gaya hidup sehat dan informasi medis.', '1', '2025-11-06 00:45:04', '2025-11-06 00:45:04'),
(5, 'Gaya Hidup', 'gaya-hidup', 'Inspirasi kehidupan sehari-hari dan tren gaya hidup.', '0', '2025-11-06 00:45:04', '2025-11-06 00:45:04'),
(6, 'Keuangan', 'keuangan', 'Tips keuangan pribadi, investasi, dan manajemen uang.', '1', '2025-11-06 00:45:04', '2025-11-06 00:45:04'),
(7, 'Olahraga', 'olahraga', 'Berita olahraga dan panduan kebugaran.', '1', '2025-11-06 00:45:04', '2025-11-06 00:45:04'),
(8, 'Kuliner', 'kuliner', 'Resep, ulasan restoran, dan tren makanan.', '1', '2025-11-06 00:45:04', '2025-11-06 00:45:04'),
(9, 'Travel', 'travel', 'Panduan perjalanan dan destinasi wisata menarik.', '1', '2025-11-06 00:45:04', '2025-11-06 00:45:04'),
(10, 'Otomotif', 'otomotif', 'Berita dan ulasan dunia otomotif terkini.', '1', '2025-11-06 00:45:04', '2025-11-06 00:45:04'),
(11, 'Politik', 'politik', 'Analisis dan opini seputar isu politik nasional dan global.', '1', '2025-11-06 00:45:04', '2025-11-06 00:45:04'),
(12, 'Seni dan Budaya', 'seni-dan-budaya', 'Eksplorasi dunia seni, musik, dan budaya lokal.', '1', '2025-11-06 00:45:04', '2025-11-06 00:45:04'),
(13, 'Karier', 'karier', 'Tips pengembangan diri dan karier profesional.', '1', '2025-11-06 00:45:04', '2025-11-06 00:45:04'),
(14, 'Teknologi Informasi', 'teknologi-informasi', 'Artikel tentang sistem informasi dan IT.', '1', '2025-11-06 00:45:04', '2025-11-06 00:45:04'),
(15, 'Startup', 'startup', 'Cerita dan wawasan dari dunia startup dan inovasi.', '1', '2025-11-06 00:45:04', '2025-11-06 00:45:04'),
(16, 'Lingkungan', 'lingkungan', 'Isu lingkungan dan cara menjaga bumi.', '1', '2025-11-06 00:45:04', '2025-11-06 00:45:04'),
(17, 'Parenting', 'parenting', 'Tips untuk orang tua dalam mendidik anak.', '1', '2025-11-06 00:45:04', '2025-11-06 00:45:04'),
(18, 'Fashion', 'fashion', 'Berita dan inspirasi tren fashion terkini.', '1', '2025-11-06 00:45:04', '2025-11-06 00:45:04'),
(19, 'Film dan Hiburan', 'film-dan-hiburan', 'Ulasan film, musik, dan dunia hiburan.', '1', '2025-11-06 00:45:04', '2025-11-06 00:45:04'),
(20, 'Inspirasi', 'inspirasi', 'Kumpulan kisah inspiratif dan motivasi hidup.', '1', '2025-11-06 00:45:04', '2025-11-06 00:45:04');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','published','archived') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `author_id` bigint UNSIGNED DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `slug`, `content`, `excerpt`, `featured_image`, `status`, `category_id`, `author_id`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Panduan Laravel 10', 'panduan-laravel-10', 'Konten lengkap mengenai Laravel 10...', 'Belajar Laravel 10 dari awal', 'blog_images/Mq0e5lNJGKDqfz6DphwbnhWI7hNxRQE2Bju71Zbv.webp', 'published', 1, 1, '2025-11-01 03:00:00', '2025-11-06 03:11:27', '2025-11-05 20:35:30', NULL),
(2, 'Tips JavaScript Modern', 'tips-javascript-modern', 'Tips dan trik JS terbaru...', 'Tips JS terbaru', 'blog_images/fHDpgycaIY97jlk1s54kTSTow36tkcrSN6GVAOzq.jpg', 'draft', 2, 2, NULL, '2025-11-06 03:11:27', '2025-11-05 20:40:25', NULL),
(3, 'Mengenal Vue 3', 'mengenal-vue-3', 'Vue 3 adalah framework frontend...', 'Framework frontend Vue 3', NULL, 'published', 3, 1, '2025-11-02 05:00:00', '2025-11-06 03:11:27', '2025-11-06 03:11:27', NULL),
(4, 'Belajar React Native', 'belajar-react-native', 'Membuat aplikasi mobile dengan React Native...', 'React Native untuk mobile', 'blog_images/XmN89C0aITt5a4aGknW6vnt7rNArjfGWhdzzkCD4.webp', 'published', 2, 1, '2025-10-15 02:00:00', '2025-11-06 03:11:27', '2025-11-05 20:52:15', NULL),
(5, 'Optimasi Database Msql', 'optimasi-database-', 'Cara optimasi query MySQL...', 'Optimasi MySQL', 'blog_images/FriltaLokN9A9fZKR2I66ZhaNMobuDBSqjaOqwMQ.webp', 'published', 1, 2, '2025-11-03 08:00:00', '2025-11-06 03:11:27', '2025-11-05 21:25:03', NULL),
(6, 'CSS Grid vs Flexbox', 'css-grid-vs-flexbox', 'Perbedaan CSS Grid dan Flexbox...', 'CSS Grid dan Flexbox', 'css.png', 'draft', 4, 1, NULL, '2025-11-06 03:11:27', '2025-11-06 03:11:27', NULL),
(7, 'Belajar Tailwind CSS', 'belajar-tailwind-css', 'Tailwind CSS mempermudah styling...', 'Framework Tailwind', NULL, 'published', 4, 3, '2025-11-04 01:30:00', '2025-11-06 03:11:27', '2025-11-06 03:11:27', NULL),
(8, 'Pengenalan PHP 8', 'pengenalan-php-8', 'Fitur baru PHP 8...', 'PHP 8 terbaru', 'php8.png', 'archived', 1, 2, '2025-09-30 04:00:00', '2025-11-06 03:11:27', '2025-11-06 03:11:27', NULL),
(9, 'Tutorial Node.js', 'tutorial-nodejs', 'Membuat backend dengan Node.js...', 'Backend dengan Node.js', NULL, 'draft', 3, 1, NULL, '2025-11-06 03:11:27', '2025-11-06 03:11:27', NULL),
(10, 'Belajar API Laravel', 'belajar-api-laravel', 'Membuat REST API di Laravel...', 'REST API Laravel', 'api.png', 'published', 1, 3, '2025-11-05 07:00:00', '2025-11-06 03:11:27', '2025-11-06 03:11:27', NULL),
(11, 'es', 'es', 'es', 'es', 'blog_images/iKtSqj52elq8P08DzZr5tehGrOSMw5YGHN3sXCP1.webp', 'draft', 1, 1, '2025-11-05 17:41:00', '2025-11-05 20:41:37', '2025-11-05 20:41:48', '2025-11-05 20:41:48');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('new','replied','archived') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `is_read` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `status`, `phone`, `ip_address`, `user_agent`, `is_read`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Alice', 'alice@example.com', 'Pertanyaan Produk', 'Saya ingin tahu detail produk X.', 'new', '081234567890', '192.168.1.1', 'Mozilla/5.0', '1', '2025-11-06 09:14:40', '2025-11-06 02:39:33', NULL),
(2, 'Bob', 'bob@example.com', 'Keluhan Layanan', 'Layanan terlalu lambat.', 'new', '081298765432', '192.168.1.2', 'Chrome/115.0', '0', '2025-11-06 09:14:40', '2025-11-06 09:14:40', NULL),
(3, 'Charlie', 'charlie@example.com', 'Saran', 'Tambahkan fitur dark mode.', 'replied', '081212345678', '192.168.1.3', 'Safari/16.0', '1', '2025-11-06 09:14:40', '2025-11-06 09:14:40', NULL),
(4, 'Diana', 'diana@example.com', 'Masalah Login', 'Saya tidak bisa login.', 'new', '081234567891', '192.168.1.4', 'Edge/115.0', '0', '2025-11-06 09:14:40', '2025-11-06 09:14:40', NULL),
(5, 'Evan', 'evan@example.com', 'Pertanyaan Harga', 'Berapa harga paket premium?', 'archived', '081298761234', '192.168.1.5', 'Firefox/115.0', '1', '2025-11-06 09:14:40', '2025-11-06 09:14:40', NULL),
(6, 'Fiona', 'fiona@example.com', 'Feedback', 'Situs web sangat responsif.', 'replied', '081234567899', '192.168.1.6', 'Opera/95.0', '1', '2025-11-06 09:14:40', '2025-11-06 09:14:40', NULL),
(7, 'George', 'george@example.com', 'Bantuan Teknis', 'Saya kesulitan mengakses laporan.', 'new', '081212398765', '192.168.1.7', 'Mozilla/5.0', '0', '2025-11-06 09:14:40', '2025-11-06 09:14:40', NULL),
(8, 'Hannah', 'hannah@example.com', 'Pertanyaan Umum', 'Apakah ada garansi produk?', 'archived', '081234567812', '192.168.1.8', 'Chrome/115.0', '1', '2025-11-06 09:14:40', '2025-11-06 09:14:40', NULL),
(9, 'Ian', 'ian@example.com', 'Saran Fitur', 'Tambahkan notifikasi email.', 'replied', '081234567813', '192.168.1.9', 'Safari/16.0', '1', '2025-11-06 09:14:40', '2025-11-06 09:14:40', NULL),
(10, 'Julia', 'julia@example.com', 'Keluhan Pengiriman', 'Barang belum sampai.', 'replied', '081234567814', '192.168.1.10', 'Edge/115.0', '1', '2025-11-06 09:14:41', '2025-11-06 02:31:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_settings`
--

CREATE TABLE `contact_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_settings`
--

INSERT INTO `contact_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'phone', '+6281234567890', '2025-11-06 09:40:51', '2025-11-06 03:11:54'),
(2, 'email', 'info@example.com', '2025-11-06 09:40:51', '2025-11-06 09:40:51'),
(3, 'address', 'Jl. Sudirman No.10, Jakarta', '2025-11-06 09:40:51', '2025-11-06 09:40:51'),
(4, 'facebook', 'https://facebook.com/example', '2025-11-06 09:40:51', '2025-11-06 09:40:51'),
(5, 'instagram', 'https://instagram.com/example', '2025-11-06 09:40:51', '2025-11-06 09:40:51'),
(6, 'twitter', 'https://twitter.com/example', '2025-11-06 09:40:51', '2025-11-06 09:40:51'),
(7, 'linkedin', 'https://linkedin.com/company/example', '2025-11-06 09:40:51', '2025-11-06 09:40:51'),
(8, 'whatsapp', '+6289876543210', '2025-11-06 09:40:51', '2025-11-06 09:40:51'),
(9, 'working_hours', 'Mon-Fri 09:00-17:00', '2025-11-06 09:40:51', '2025-11-06 09:40:51'),
(10, 'support_email', 'support@example.com', '2025-11-06 09:40:51', '2025-11-06 09:40:51'),
(11, 'd', '543', '2025-11-06 03:12:07', '2025-11-06 03:12:07'),
(12, 'r', 'r', '2025-11-06 03:14:18', '2025-11-06 03:14:18'),
(13, 'wier', '2', '2025-11-06 03:17:16', '2025-11-06 03:17:16');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_cards`
--

CREATE TABLE `dashboard_cards` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2025_11_05_000001_create_roles_table', 1),
(3, '2025_11_05_000002_create_permissions_table', 1),
(4, '2025_11_05_000003_create_role_permissions_table', 1),
(5, '2025_11_05_000004_create_users_table', 1),
(6, '2025_11_05_000005_create_user_permissions_table', 1),
(7, '2025_11_05_000006_create_modules_table', 1),
(8, '2025_11_05_000007_create_module_settings_table', 1),
(9, '2025_11_05_000101_create_blog_categories_table', 1),
(10, '2025_11_05_000102_create_blog_posts_table', 1),
(11, '2025_11_05_000201_create_product_categories_table', 1),
(12, '2025_11_05_000202_create_products_table', 1),
(13, '2025_11_05_000203_create_product_images_table', 1),
(14, '2025_11_05_000301_create_contact_messages_table', 1),
(15, '2025_11_05_000302_create_contact_settings_table', 1),
(16, '2025_11_05_000401_create_activity_logs_table', 1),
(17, '2025_11_05_230938_add_status_to_roles_table', 2),
(18, '2025_11_06_013743_add_is_active_to_blog_categories_table', 3),
(19, '2025_11_06_000001_add_deleted_at_to_blog_posts', 4),
(20, '2025_11_06_063040_add_is_active_and_display_order_to_product_categories_table', 5),
(21, '2025_11_06_092211_add_deleted_at_to_contact_messages_table', 6),
(22, '2025_11_06_235816_create_dashboard_cards_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `version` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `installed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `display_name`, `description`, `version`, `status`, `installed_at`, `created_at`, `updated_at`) VALUES
(1, 'user_management', 'User Management', 'Module for managing users, roles, and permissions.', '1.0.0', 'active', '2025-11-05 23:34:53', '2025-11-05 23:34:53', '2025-11-05 23:34:53'),
(2, 'inventory', 'Inventory Management', 'Handles stock tracking and inventory operations.', '1.2.0', 'active', '2025-11-05 23:34:53', '2025-11-05 23:34:53', '2025-11-05 23:34:53'),
(3, 'sales', 'Sales Module', 'Manages sales transactions and reports.', '1.1.0', 'inactive', NULL, '2025-11-05 23:34:53', '2025-11-05 23:34:53'),
(4, 'finance', 'Finance', 'Module for accounting and financial reports.', '2.0.0', 'active', '2025-11-05 23:34:53', '2025-11-05 23:34:53', '2025-11-05 23:34:53'),
(5, 'hrd', 'Human Resources', 'Handles employee records, payroll, and attendance.', '1.3.0', 'active', '2025-11-05 23:34:00', '2025-11-05 23:34:53', '2025-11-05 16:50:04'),
(6, 'reporting', 'Reporting System', 'Generates analytical and operational reports.', '1.0.1', 'inactive', NULL, '2025-11-05 23:34:53', '2025-11-05 23:34:53'),
(7, 'notifications', 'Notification Center', 'Sends system alerts and user notifications.', '1.0.0', 'active', '2025-11-05 23:34:53', '2025-11-05 23:34:53', '2025-11-05 23:34:53'),
(8, 'settings', 'System Settings', 'Provides configuration options for administrators.', '1.1.2', 'active', '2025-11-05 23:34:53', '2025-11-05 23:34:53', '2025-11-05 23:34:53'),
(9, 'backup', 'Backup Manager', 'Handles database and file system backups.', '0.9.5', 'inactive', NULL, '2025-11-05 23:34:53', '2025-11-05 23:34:53'),
(10, 'analytics', 'Analytics Dashboard', 'Provides insights and key performance metrics.', '1.5.0', 'active', '2025-11-05 23:34:53', '2025-11-05 23:34:53', '2025-11-05 23:34:53');

-- --------------------------------------------------------

--
-- Table structure for table `module_settings`
--

CREATE TABLE `module_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `module_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_settings`
--

INSERT INTO `module_settings` (`id`, `module_name`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'budget', 'approval_limit', '5500000', '2025-11-05 23:59:29', '2025-11-05 17:29:46'),
(2, 'budget', 'max_request_per_month', '10', '2025-11-05 23:59:29', '2025-11-05 23:59:29'),
(3, 'user_management', 'default_role', 'editor', '2025-11-05 23:59:29', '2025-11-05 23:59:29'),
(4, 'user_management', 'max_login_attempts', '5', '2025-11-05 23:59:29', '2025-11-05 23:59:29'),
(5, 'notification', 'email_sender', 'noreply@simanggar.com', '2025-11-05 23:59:29', '2025-11-05 23:59:29'),
(6, 'notification', 'enable_push', 'true', '2025-11-05 23:59:29', '2025-11-05 23:59:29'),
(7, 'system', 'maintenance_mode', 'off', '2025-11-05 23:59:29', '2025-11-05 23:59:29'),
(8, 'system', 'timezone', 'Asia/Jakarta', '2025-11-05 23:59:29', '2025-11-05 23:59:29'),
(9, 'report', 'default_format', 'pdf', '2025-11-05 23:59:29', '2025-11-05 23:59:29'),
(10, 'report', 'records_per_page', '25', '2025-11-05 23:59:29', '2025-11-05 23:59:29');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `module_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(15,2) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `short_description`, `price`, `stock`, `status`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Smartphone XYZ 90', 'smartphone-xyz-90', 'Smartphone XYZ dengan layar 6.5 inch, RAM 8GB, penyimpanan 128GB, kamera 48MP.', 'Smartphone canggih dengan RAM 8GB', '4999000.00', 50, 'active', NULL, '2025-11-06 04:35:06', '2025-11-05 22:14:08'),
(2, 'Laptop ABC', 'laptop-abc', 'Laptop ABC prosesor Intel i7, RAM 16GB, SSD 512GB, cocok untuk pekerjaan dan gaming ringan.', 'Laptop performa tinggi', '12999000.00', 20, 'active', 2, '2025-11-06 04:35:06', '2025-11-06 04:35:06'),
(3, 'Headphone DEF', 'headphone-def', 'Headphone DEF dengan noise cancellation, baterai tahan 20 jam, nyaman untuk digunakan lama.', 'Headphone dengan noise cancellation', '899000.00', 100, 'active', 3, '2025-11-06 04:35:06', '2025-11-06 04:35:06'),
(4, 'Meja Kantor Modern', 'meja-kantor-modern', 'Meja kantor modern berbahan kayu berkualitas, cocok untuk ruang kerja minimalis.', 'Meja kantor kayu minimalis', '750000.00', 15, 'inactive', 4, '2025-11-06 04:35:06', '2025-11-06 04:35:06'),
(5, 'Kursi Gaming Pro', 'kursi-gaming-pro', 'Kursi gaming ergonomis dengan bantalan nyaman, tinggi bisa diatur, dan desain stylish.', 'Kursi gaming ergonomis', '1850000.00', 30, 'active', 4, '2025-11-06 04:35:06', '2025-11-06 04:35:06');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `display_order` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `slug`, `description`, `parent_id`, `is_active`, `display_order`, `created_at`, `updated_at`) VALUES
(2, 'Electronics', 'electronics', 'All kinds of electronic items', NULL, 1, NULL, '2025-11-06 05:21:26', '2025-11-06 05:21:26'),
(3, 'Smartphones', 'smartphones', 'Smartphones and mobile devices', 1, 1, NULL, '2025-11-06 05:21:26', '2025-11-06 05:21:26'),
(4, 'Laptops', 'laptops', 'All types of laptops', 1, 1, NULL, '2025-11-06 05:21:26', '2025-11-06 05:21:26'),
(5, 'Home Appliances', 'home-appliances', 'Appliances for home use', NULL, 1, NULL, '2025-11-06 05:21:26', '2025-11-06 05:21:26'),
(6, 'Refrigerators', 'refrigerators', 'All kinds of refrigerators', 4, 1, NULL, '2025-11-06 05:21:26', '2025-11-06 05:21:26'),
(7, 'Washing Machines', 'washing-machines', 'All types of washing machines', 4, 1, NULL, '2025-11-06 05:21:26', '2025-11-06 05:21:26'),
(8, 'Fashion', 'fashion', 'Clothing and accessories', NULL, 1, NULL, '2025-11-06 05:21:26', '2025-11-06 05:21:26'),
(9, 'Men Clothing', 'men-clothing', 'Clothes for men', 7, 1, NULL, '2025-11-06 05:21:26', '2025-11-06 05:21:26'),
(10, 'Women Clothing', 'women-clothing', 'Clothes for women', 7, 1, NULL, '2025-11-06 05:21:26', '2025-11-06 05:21:26'),
(11, 'Kids Clothing', 'kids-clothing', 'Clothes for kids', 7, 1, NULL, '2025-11-06 05:21:26', '2025-11-06 05:21:26'),
(12, 'tetst', 'tetst', 'test', 2, 0, 1, '2025-11-05 23:31:14', '2025-11-05 23:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `alt_text`, `is_primary`, `created_at`, `updated_at`) VALUES
(1, 1, 'images/products/product1_main.jpg', 'Gambar utama produk 1', 1, '2025-11-06 07:20:38', '2025-11-06 07:20:38'),
(2, 1, 'images/products/product1_side.jpg', 'Gambar samping produk 1', 0, '2025-11-06 07:20:38', '2025-11-06 07:20:38'),
(3, 2, 'images/products/product2_main.jpg', 'Gambar utama produk 2', 1, '2025-11-06 07:20:38', '2025-11-06 07:20:38'),
(4, 3, 'images/products/product3_main.jpg', 'Gambar utama produk 3', 1, '2025-11-06 07:20:38', '2025-11-06 07:20:38'),
(5, 3, 'images/products/product3_back.jpg', 'Gambar belakang produk 3', 0, '2025-11-06 07:20:38', '2025-11-06 07:20:38');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '', 'Administrator dengan akses penuh', 'active', '2025-11-05 16:07:16', '2025-11-05 16:07:16'),
(2, 'User', '-', 'Pengguna biasa', 'active', '2025-11-05 16:07:16', '2025-11-05 16:28:05'),
(3, 'Rahma', 'ram', 'Pengguna user', 'active', '2025-11-05 16:29:49', '2025-11-05 16:29:49');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive','suspended') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `last_login_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `status`, `last_login_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@gmail.com', '2025-11-05 16:07:16', '$2y$12$gXrlP1VttAswGwkr2c3ive1xfP3htw1ZYHematW0kuIWViZa6qGxy', 1, 'active', '2025-11-05 16:07:16', NULL, '2025-11-05 16:07:16', '2025-11-05 16:07:16'),
(2, 'User Biasa', 'user@gmail.com', NULL, '$2y$12$j8ey1kFJrtHjgCgk2Ktat.FXSfezRHMnFOfCIrbVn7WJS9UGqK7Di', 2, 'inactive', NULL, NULL, '2025-11-05 16:07:17', '2025-11-05 16:07:17');

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `user_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_categories_slug_unique` (`slug`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_posts_slug_unique` (`slug`),
  ADD KEY `blog_posts_category_id_foreign` (`category_id`),
  ADD KEY `blog_posts_author_id_foreign` (`author_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_settings`
--
ALTER TABLE `contact_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dashboard_cards`
--
ALTER TABLE `dashboard_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modules_name_unique` (`name`);

--
-- Indexes for table `module_settings`
--
ALTER TABLE `module_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `module_settings_module_name_key_unique` (`module_name`,`key`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_categories_slug_unique` (`slug`),
  ADD KEY `product_categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `role_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`user_id`,`permission_id`),
  ADD KEY `user_permissions_permission_id_foreign` (`permission_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_settings`
--
ALTER TABLE `contact_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `dashboard_cards`
--
ALTER TABLE `dashboard_cards`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `module_settings`
--
ALTER TABLE `module_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `blog_posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `blog_posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `blog_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `product_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD CONSTRAINT `user_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
