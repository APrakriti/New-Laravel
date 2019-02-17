-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2019 at 04:26 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_lists`
--

CREATE TABLE `access_lists` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_type` int(10) UNSIGNED NOT NULL,
  `module_id` int(10) UNSIGNED NOT NULL,
  `access_view` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `access_publish` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `access_add` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `access_update` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `access_delete` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `access_trash` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `access_reterive` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `is_active` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `access_lists`
--

INSERT INTO `access_lists` (`id`, `user_type`, `module_id`, `access_view`, `access_publish`, `access_add`, `access_update`, `access_delete`, `access_trash`, `access_reterive`, `created_by`, `updated_by`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '1', '1', '1', '1', '1', '1', '1', 0, 0, '1', '2019-02-16 23:15:00', '2019-02-16 23:15:00', NULL),
(2, 1, 2, '1', '1', '1', '1', '1', '1', '1', 0, 0, '1', '2019-02-17 02:15:00', '2019-02-16 22:15:00', NULL),
(3, 1, 3, '1', '1', '1', '1', '1', '1', '1', 0, 0, '1', '2019-02-16 21:15:00', '2019-02-16 18:28:00', NULL),
(4, 1, 4, '1', '1', '1', '1', '1', '1', '1', 0, 0, '1', '2019-02-17 03:15:00', '2019-02-16 18:37:00', NULL),
(5, 2, 1, '1', '0', '0', '0', '0', '0', '0', 0, 0, '1', NULL, NULL, NULL),
(6, 2, 2, '1', '0', '0', '0', '0', '0', '0', 0, 0, '1', NULL, NULL, NULL),
(7, 2, 3, '1', '0', '0', '0', '0', '0', '0', 0, 0, '1', '2019-02-17 00:15:00', '2019-02-16 18:27:00', NULL),
(8, 2, 4, '1', '0', '0', '0', '0', '0', '0', 0, 0, '1', NULL, NULL, NULL),
(9, 3, 1, '1', '', '', '', '', '', '', 0, 0, '1', '2019-02-17 07:23:23', '2019-02-17 07:24:05', NULL),
(10, 3, 2, '', '', '', '', '', '', '', 0, 0, '1', '2019-02-17 07:23:23', '2019-02-17 07:23:23', NULL),
(11, 3, 3, '1', '', '', '', '', '', '', 0, 0, '1', '2019-02-17 07:23:23', '2019-02-17 07:31:23', NULL),
(12, 3, 4, '1', '', '', '', '', '', '', 0, 0, '1', '2019-02-17 07:23:23', '2019-02-17 07:31:24', NULL),
(13, 4, 1, '1', '', '1', '', '', '', '', 0, 0, '1', '2019-02-17 07:40:28', '2019-02-17 07:40:46', NULL),
(14, 4, 2, '', '', '', '', '', '', '', 0, 0, '1', '2019-02-17 07:40:28', '2019-02-17 07:40:28', NULL),
(15, 4, 3, '1', '', '1', '', '', '', '', 0, 0, '1', '2019-02-17 07:40:28', '2019-02-17 07:40:46', NULL),
(16, 4, 4, '1', '', '1', '', '', '', '', 0, 0, '1', '2019-02-17 07:40:28', '2019-02-17 07:40:47', NULL),
(17, 5, 1, '1', '', '', '', '', '', '', 0, 0, '1', '2019-02-17 08:42:52', '2019-02-17 08:43:05', NULL),
(18, 5, 2, '', '', '', '', '', '', '', 0, 0, '1', '2019-02-17 08:42:52', '2019-02-17 08:42:52', NULL),
(19, 5, 3, '1', '', '', '', '', '', '', 0, 0, '1', '2019-02-17 08:42:52', '2019-02-17 08:43:06', NULL),
(20, 5, 4, '', '', '', '', '', '', '', 0, 0, '1', '2019-02-17 08:42:52', '2019-02-17 08:42:52', NULL),
(21, 6, 1, '', '', '', '', '', '', '', 0, 0, '1', '2019-02-17 08:46:45', '2019-02-17 08:46:45', NULL),
(22, 6, 2, '', '', '', '', '', '', '', 0, 0, '1', '2019-02-17 08:46:45', '2019-02-17 08:46:45', NULL),
(23, 6, 3, '', '', '', '', '', '', '', 0, 0, '1', '2019-02-17 08:46:45', '2019-02-17 08:46:45', NULL),
(24, 6, 4, '', '', '', '', '', '', '', 0, 0, '1', '2019-02-17 08:46:45', '2019-02-17 08:46:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE `configs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_04_04_161544_create_users_table', 1),
('2016_04_04_161609_create_password_reset_table', 1),
('2016_04_04_165340_create_modules_table', 1),
('2016_04_04_165418_create_logs_table', 1),
('2016_04_04_165442_create_roles_modules_table', 1),
('2016_04_04_170423_create_configuration_table', 1),
('2018_12_27_051744_create_user_types_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `module` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module`, `slug`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'User Management', 'users', '1', '2019-02-17 00:15:00', '2019-02-16 23:15:00'),
(2, 'UserType', 'user-type', '1', '2019-02-17 00:15:00', '2019-02-16 22:15:00'),
(3, 'Configuration', 'configuration', '1', '2019-02-17 02:15:00', '2019-02-17 00:15:00'),
(4, 'Modules', 'modules', '1', '2019-02-16 22:15:00', '2019-02-16 20:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'normaluser', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_modules`
--

CREATE TABLE `role_modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `module_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_type` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `verify_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_reset_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_position` int(10) UNSIGNED DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `username`, `role_id`, `first_name`, `last_name`, `email`, `password`, `is_active`, `verify_token`, `password_reset_token`, `order_position`, `created_by`, `updated_by`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'superadmin', 1, 'superadmin', 'superadmin', 'superadmin@gmail.com', '$2y$10$2AsoKbpH9CeuR.3laenSuOFdanXHP2KoEubHZsCUMXyfPO3xpUogy', '1', NULL, NULL, NULL, NULL, NULL, 'PGuG7ybe4ttvoe3e9XETe6sAgBXAdpQETv12OECjDWI705sxVUrGLvZCk33i', '2019-02-16 21:15:00', '2019-02-16 22:15:00', NULL),
(2, 2, 'admin', 2, 'admin', 'admin', 'admin@gmail.com', '$2y$10$2AsoKbpH9CeuR.3laenSuOFdanXHP2KoEubHZsCUMXyfPO3xpUogy', '1', NULL, NULL, NULL, NULL, NULL, 'MSuIOqeYAguvUjfCmiy7DE1YmYeGFALyRBTWGKjqTDqNkQomKD7rOFBS3TpT', '2019-02-16 21:15:00', NULL, NULL),
(3, 2, 'Prakriti', NULL, 'Prakriti', 'Adhikari', 'prakriti@gmail.com', '$2y$10$2AsoKbpH9CeuR.3laenSuOFdanXHP2KoEubHZsCUMXyfPO3xpUogy', '1', NULL, NULL, NULL, NULL, NULL, 'BSnAD6fyYjvy76Kx38znqOtbc6dM6OkXuIOJbA6xjzCIbJNQXKRWAbw3dWRY', '2019-02-17 07:22:57', '2019-02-17 07:22:57', NULL),
(4, 3, 'test', NULL, 'Test', 'test', 'test@gmail.com', '$2y$10$2AsoKbpH9CeuR.3laenSuOFdanXHP2KoEubHZsCUMXyfPO3xpUogy', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2019-02-17 07:24:40', '2019-02-17 07:24:40', NULL),
(5, 3, 'www', NULL, 'www', 'www', 'www@www.www', '$2y$10$2AsoKbpH9CeuR.3laenSuOFdanXHP2KoEubHZsCUMXyfPO3xpUogy', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2019-02-17 07:36:43', '2019-02-17 07:36:43', NULL),
(6, 4, 'testttt', NULL, 'testttt', 'testttt', 'testttt@gmail.com', '$2y$10$2AsoKbpH9CeuR.3laenSuOFdanXHP2KoEubHZsCUMXyfPO3xpUogy', '1', NULL, NULL, NULL, NULL, NULL, 'VvZalkWDsSA3p3ThmXkZdfFyzeJKTCZIvvyInTGIxfd7MnIxEdKlnWDs0XbS', '2019-02-17 07:44:23', '2019-02-17 07:44:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_type_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `editable` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `user_type_name`, `is_active`, `editable`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'superadmin', '1', '0', '2019-02-17 02:15:00', '2019-02-17 00:15:00', NULL),
(2, 'admin', '1', '1', '2019-02-17 00:15:00', '2019-02-16 23:15:00', NULL),
(3, 'normal', '1', '1', '2019-02-17 07:23:23', '2019-02-17 07:23:23', NULL),
(4, 'super', '1', '1', '2019-02-17 07:40:27', '2019-02-17 07:40:27', NULL),
(5, 'dfgh', '1', '1', '2019-02-17 08:42:52', '2019-02-17 08:42:52', NULL),
(6, 'fghj', '1', '1', '2019-02-17 08:46:45', '2019-02-17 08:46:45', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_lists`
--
ALTER TABLE `access_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access_lists_user_type_foreign` (`user_type`),
  ADD KEY `access_lists_module_id_foreign` (`module_id`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `configs_name_unique` (`name`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_role_unique` (`role`);

--
-- Indexes for table `role_modules`
--
ALTER TABLE `role_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_modules_role_id_foreign` (`role_id`),
  ADD KEY `role_modules_module_id_foreign` (`module_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`user_type`) USING BTREE;

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_types_user_type_name_unique` (`user_type_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_lists`
--
ALTER TABLE `access_lists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `configs`
--
ALTER TABLE `configs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_modules`
--
ALTER TABLE `role_modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access_lists`
--
ALTER TABLE `access_lists`
  ADD CONSTRAINT `access_lists_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `access_lists_user_type_foreign` FOREIGN KEY (`user_type`) REFERENCES `user_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_modules`
--
ALTER TABLE `role_modules`
  ADD CONSTRAINT `role_modules_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`),
  ADD CONSTRAINT `role_modules_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users` FOREIGN KEY (`user_type`) REFERENCES `user_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
