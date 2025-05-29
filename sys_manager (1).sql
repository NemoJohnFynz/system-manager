-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 28, 2025 lúc 12:15 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `sys_manager`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_rule`
--

CREATE TABLE `category_rule` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category_rule`
--

INSERT INTO `category_rule` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'quy chế sử dụng', 'quy chế sử dụng des', NULL, NULL),
(2, 'quy chế vận hành csdl', 'quy chế vận hành csdl ds', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `domain`
--

CREATE TABLE `domain` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `software_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `link` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `domain`
--

INSERT INTO `domain` (`id`, `software_id`, `name`, `link`, `created_at`, `updated_at`) VALUES
(1, 1, 'fadomain', 'fadomain.ct.vn', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hardware`
--

CREATE TABLE `hardware` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip` varchar(25) NOT NULL,
  `domain_id` bigint(20) UNSIGNED NOT NULL,
  `dbname` varchar(100) NOT NULL,
  `dbversion` varchar(100) NOT NULL,
  `server` tinyint(1) NOT NULL,
  `hdd` varchar(50) NOT NULL,
  `ram` varchar(50) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `services` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hardware`
--

INSERT INTO `hardware` (`id`, `ip`, `domain_id`, `dbname`, `dbversion`, `server`, `hdd`, `ram`, `is_delete`, `services`, `created_at`, `updated_at`) VALUES
(1, '192.168.16.16', 1, 'mysql', '5.8', 1, '10TB', '5GB', 0, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hardware_permissions`
--

CREATE TABLE `hardware_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hardware_ip` varchar(25) NOT NULL,
  `permissions_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hardware_permissions`
--

INSERT INTO `hardware_permissions` (`id`, `hardware_ip`, `permissions_id`, `user_id`, `created_by`, `assigned_at`, `created_at`, `updated_at`) VALUES
(1, '192.168.16.16', 1, 2, 1, '2025-05-28 09:47:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hardware_rule`
--

CREATE TABLE `hardware_rule` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rule_id` bigint(20) UNSIGNED NOT NULL,
  `hardware_ip` varchar(25) NOT NULL,
  `assigned_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hardware_rule`
--

INSERT INTO `hardware_rule` (`id`, `rule_id`, `hardware_ip`, `assigned_at`, `created_at`, `updated_at`) VALUES
(1, 2, '192.168.16.16', '2025-05-28 17:11:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

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
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `log`
--

CREATE TABLE `log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `software_id` bigint(20) UNSIGNED NOT NULL,
  `hardware_ip` varchar(25) NOT NULL,
  `message` text NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(238, '0001_01_01_000001_create_cache_table', 2),
(239, '0001_01_01_000002_create_jobs_table', 2),
(240, '2025_05_27_065543_users', 2),
(241, '2025_05_27_07000_create_software_table', 2),
(242, '2025_05_27_070853_create_domain_table', 2),
(243, '2025_05_27_074128_create_hardware_table', 2),
(244, '2025_05_27_074218_create_category_rule', 2),
(245, '2025_05_27_074308_create_rules_table', 2),
(246, '2025_05_27_074437_create_roles_table', 2),
(247, '2025_05_27_074801_create_software_file_table', 2),
(248, '2025_05_27_074919_create_log_table', 2),
(249, '2025_05_27_075315_create_permissions_table', 2),
(250, '2025_05_27_075336_create_user_role_table', 2),
(251, '2025_05_27_075402_create_role_permissions_table', 2),
(252, '2025_05_27_075418_create_hardware_permissions_table', 2),
(253, '2025_05_27_075437_create_user_software_permissions_table', 2),
(254, '2025_05_27_085339_create_hardware_rule', 2),
(255, '2025_05_28_021131_create_personal_access_tokens_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_creately` bigint(20) UNSIGNED NOT NULL,
  `permissions_name` varchar(150) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `user_creately`, `permissions_name`, `type`, `created_at`, `updated_at`) VALUES
(1, 2, 'thêm phần mềm', 'Phần mềm', '2025-05-28 01:04:00', '2025-05-28 01:04:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(50) NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `role`, `assigned_at`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2025-05-28 09:32:48', NULL, NULL),
(2, 'quanlyphancung', '2025-05-28 09:32:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permissions_id` bigint(20) UNSIGNED NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permissions_id`, `assigned_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-05-28 09:33:29', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rules`
--

CREATE TABLE `rules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `original_rule` bigint(20) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `rules`
--

INSERT INTO `rules` (`id`, `original_rule`, `name`, `category_id`, `user_id`, `is_delete`, `created_at`, `updated_at`) VALUES
(2, NULL, 'quy che dung', 1, 2, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `software`
--

CREATE TABLE `software` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `softwareName` varchar(100) NOT NULL,
  `language` varchar(15) NOT NULL,
  `version` varchar(100) NOT NULL,
  `owner` varchar(7) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `software`
--

INSERT INTO `software` (`id`, `softwareName`, `language`, `version`, `owner`, `is_delete`, `description`, `created_at`, `updated_at`) VALUES
(1, 'face', 'php', '1.0', '10', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `software_file`
--

CREATE TABLE `software_file` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `software_id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `fullName` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(12) DEFAULT NULL,
  `hidden` tinyint(1) NOT NULL DEFAULT 0,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullName`, `email`, `phone_number`, `hidden`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'uchihanemo', '$2y$12$5q7VoMIv3iGTz5/Nsc/UkuTfOGczax4Iab91HnQuf42.yHrUJtkdq', NULL, NULL, NULL, 0, 0, '2025-05-28 01:02:53', '2025-05-28 01:02:53'),
(2, 'nemo', '$2y$12$aml27ui4kgeD8qRguUBR1eYnGJk4dmRorTTNvLbGalMu0C2UWV8Sy', NULL, NULL, NULL, 0, 0, '2025-05-28 01:03:05', '2025-05-28 01:03:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_role`
--

CREATE TABLE `user_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_role`
--

INSERT INTO `user_role` (`id`, `user_id`, `role_id`, `assigned_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2025-05-28 09:34:01', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_software_permissions`
--

CREATE TABLE `user_software_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `software_id` bigint(20) UNSIGNED NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_software_permissions`
--

INSERT INTO `user_software_permissions` (`id`, `user_id`, `software_id`, `assigned_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-05-28 09:40:07', NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `category_rule`
--
ALTER TABLE `category_rule`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `domain`
--
ALTER TABLE `domain`
  ADD PRIMARY KEY (`id`),
  ADD KEY `domain_software_id_foreign` (`software_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `hardware`
--
ALTER TABLE `hardware`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hardware_ip_unique` (`ip`),
  ADD KEY `hardware_domain_id_foreign` (`domain_id`);

--
-- Chỉ mục cho bảng `hardware_permissions`
--
ALTER TABLE `hardware_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hardware_permissions_hardware_ip_foreign` (`hardware_ip`),
  ADD KEY `hardware_permissions_permissions_id_foreign` (`permissions_id`),
  ADD KEY `hardware_permissions_user_id_foreign` (`user_id`),
  ADD KEY `hardware_permissions_created_by_foreign` (`created_by`);

--
-- Chỉ mục cho bảng `hardware_rule`
--
ALTER TABLE `hardware_rule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hardware_rule_hardware_ip_foreign` (`hardware_ip`),
  ADD KEY `rule_id` (`rule_id`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_software_id_foreign` (`software_id`),
  ADD KEY `log_hardware_ip_foreign` (`hardware_ip`),
  ADD KEY `log_username_foreign` (`username`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_user_creately_foreign` (`user_creately`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_permissions_role_id_foreign` (`role_id`),
  ADD KEY `role_permissions_permissions_id_foreign` (`permissions_id`);

--
-- Chỉ mục cho bảng `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rules_category_id_foreign` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `software_file`
--
ALTER TABLE `software_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `software_file_software_id_foreign` (`software_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role_user_id_foreign` (`user_id`),
  ADD KEY `user_role_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `user_software_permissions`
--
ALTER TABLE `user_software_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_software_permissions_user_id_foreign` (`user_id`),
  ADD KEY `user_software_permissions_software_id_foreign` (`software_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category_rule`
--
ALTER TABLE `category_rule`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `domain`
--
ALTER TABLE `domain`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hardware`
--
ALTER TABLE `hardware`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `hardware_permissions`
--
ALTER TABLE `hardware_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `hardware_rule`
--
ALTER TABLE `hardware_rule`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `log`
--
ALTER TABLE `log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `rules`
--
ALTER TABLE `rules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `software`
--
ALTER TABLE `software`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `software_file`
--
ALTER TABLE `software_file`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `user_software_permissions`
--
ALTER TABLE `user_software_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `domain`
--
ALTER TABLE `domain`
  ADD CONSTRAINT `domain_software_id_foreign` FOREIGN KEY (`software_id`) REFERENCES `software` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `hardware`
--
ALTER TABLE `hardware`
  ADD CONSTRAINT `hardware_domain_id_foreign` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `hardware_permissions`
--
ALTER TABLE `hardware_permissions`
  ADD CONSTRAINT `hardware_permissions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hardware_permissions_hardware_ip_foreign` FOREIGN KEY (`hardware_ip`) REFERENCES `hardware` (`ip`) ON DELETE CASCADE,
  ADD CONSTRAINT `hardware_permissions_permissions_id_foreign` FOREIGN KEY (`permissions_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hardware_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `hardware_rule`
--
ALTER TABLE `hardware_rule`
  ADD CONSTRAINT `hardware_rule_hardware_ip_foreign` FOREIGN KEY (`hardware_ip`) REFERENCES `hardware` (`ip`) ON DELETE CASCADE,
  ADD CONSTRAINT `hardware_rule_ibfk_1` FOREIGN KEY (`rule_id`) REFERENCES `rules` (`id`);

--
-- Các ràng buộc cho bảng `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_hardware_ip_foreign` FOREIGN KEY (`hardware_ip`) REFERENCES `hardware` (`ip`) ON DELETE CASCADE,
  ADD CONSTRAINT `log_software_id_foreign` FOREIGN KEY (`software_id`) REFERENCES `software` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `log_username_foreign` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_user_creately_foreign` FOREIGN KEY (`user_creately`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_permissions_id_foreign` FOREIGN KEY (`permissions_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `rules`
--
ALTER TABLE `rules`
  ADD CONSTRAINT `rules_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category_rule` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rules_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `software_file`
--
ALTER TABLE `software_file`
  ADD CONSTRAINT `software_file_software_id_foreign` FOREIGN KEY (`software_id`) REFERENCES `software` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_role_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `user_software_permissions`
--
ALTER TABLE `user_software_permissions`
  ADD CONSTRAINT `user_software_permissions_software_id_foreign` FOREIGN KEY (`software_id`) REFERENCES `software` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_software_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
