-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2019 at 10:00 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pt`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2014_10_12_000000_create_users_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2019_04_25_055520_add_admin_to_users_table', 1),
(7, '2019_04_26_060956_create_projects_table', 2),
(8, '2019_04_26_114302_create_projects_table', 3),
(9, '2019_04_30_091310_create_task_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_total_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_start_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_end_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_created_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_id`, `project_name`, `project_type`, `project_total_value`, `project_start_date`, `project_end_date`, `project_duration`, `project_created_by`, `project_status`, `created_at`, `updated_at`) VALUES
(2, 'Narsi_01', 'Narsi', 'BDMS', '1500000', '24th April 2019', '25th May 2019', '1 Month', 'Shashank Gokhe', 'On Process', '2019-04-26 06:21:43', '2019-04-26 06:21:43'),
(3, 'l &t_01', 'L & T Control Room', 'Experience Center', '2500000', '05/08/2019', '05/10/2019', '2 Months', 'Middle stage', 'Deepak', '2019-04-26 07:10:46', '2019-04-26 07:10:46');

-- --------------------------------------------------------

--
-- Table structure for table `task_list`
--

CREATE TABLE `task_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `task_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `task_comments` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_list`
--

INSERT INTO `task_list` (`id`, `project_id`, `task_name`, `task_description`, `task_comments`, `assigned_user_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '3', 'Timeline', 'Create CMS for narsi timeline', 'First work on module wise', '2', 'Ashish Gosavi', '2019-04-30 05:16:06', '2019-04-30 05:16:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `approved_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `admin`, `approved_at`) VALUES
(1, 'Admin', 'parth@xeniumdigital.com', 'admin', '2019-04-25 02:26:08', '$2y$10$ST75S2c.1yJrIH/jjv1zMe0vdXaI0vyNrNkjzs7leWCE9ZW2UKGwG', NULL, '2019-04-25 02:26:08', '2019-04-25 02:26:08', 1, '2019-04-25 02:26:08'),
(2, 'Parth Desai', 'parth1@xeniumdigital.com', 'Programmer', NULL, '$2y$10$DUSfTcYTdu8drmoLyH1h9O5KF7KPCEgb6Bh2QjkZqqq6VyifkISjm', NULL, '2019-04-25 02:26:44', '2019-04-25 02:28:54', 0, '2019-04-25 02:28:54'),
(3, 'Ashish Gosavi', 'ashish@xeniumdigital.com', 'Programmer', NULL, '$2y$10$sykY5dMOGtec0W09JJlyieYxuEb66nJErA3R1aeCaZ3TobMxHZroO', NULL, '2019-04-25 02:29:18', '2019-04-25 02:36:37', 0, '2019-04-25 02:36:37'),
(4, 'Madhavi Angre', 'madhavi@xeniumdigital.com', 'Programmer', NULL, '$2y$10$WTdr/0pMQsu5XLQIyeWc8.UlcZDMuneM0aKGTZLorNAMD5JSF5L2.', NULL, '2019-04-25 03:03:52', '2019-04-25 03:04:38', 0, '2019-04-25 03:04:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_list`
--
ALTER TABLE `task_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task_list`
--
ALTER TABLE `task_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
