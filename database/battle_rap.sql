-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 16, 2022 at 11:01 AM
-- Server version: 5.7.36-ndb-7.6.20-cluster-gpl
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `battle_rap`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(8, 'Admin', 'admin@mail.com', '$2y$10$Kwc4RFZo.tURyZW2ko8S9eSE27j4zpTmCaKnS2.0L.QMOjEgms5pu', 1, 'H5FXDlqCby22nMBpe4Y5NCXmUMBMuefWghP71cQ6C6z2ZTkNdocK50dn9DsK', '2022-03-22 01:32:14', '2022-03-24 03:11:32'),
(9, 'Test', 'test@mail.com', '$2y$10$rwoAKOXIH3EEugNUyECBauiUrNgueK9IIVa4X6ivGGQO/9VojPeGK', 0, 'I1cQgdfVCVx3HpDFMdAtmO14sthB6RqVHQRMYGHFPUGEFos8iD46PQo3wAx0', '2022-03-22 01:32:14', '2022-04-11 01:43:30');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Documentry', '2022-03-22 01:32:14', '2022-03-22 01:32:14');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `video_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_03_16_111218_create_categories_table', 1),
(6, '2022_03_16_111436_create_videos_table', 1),
(7, '2022_03_16_112506_create_likes_table', 1),
(8, '2022_03_21_062953_create_admins_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('user@mail.com', '3996', '2022-03-22 03:00:20'),
('admin@mail.com', '$2y$10$J4qTaMOvjLKhZMKp7o5u.OoMFzbT.Fw3yE23Ajj7t//WJZrGP6lJ.', '2022-04-04 05:49:31');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 4, 'UserAuth', 'f4793644b27f4644be3d9cfd418395cda0eea2ea30902f24f1064d6ca6357401', '[\"*\"]', NULL, '2022-03-22 02:39:03', '2022-03-22 02:39:03'),
(2, 'App\\Models\\User', 4, 'UserAuth', '924fe3055f2faff76bb4372a5af618a21f7adf7ff18e8fab4ba28d37ed86fa6d', '[\"*\"]', NULL, '2022-03-22 02:39:37', '2022-03-22 02:39:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_providers` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/uploads/images/users/Vector-5.png',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `social_token`, `social_providers`, `picture`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'User', 'user@mail.com', NULL, '$2y$10$KLMIAd5og.XniYr16eEwkuts9UagqvW34nqjBOg3b41.CCGe95fQ2', NULL, NULL, '/uploads/images/users/Vector-5.png', 1, NULL, '2022-03-22 01:32:14', '2022-03-22 01:32:14'),
(2, 'G_User', 'asdasdqweqwr@', NULL, '$2y$10$mjHrhyjlG3ijtuJTozP6kePIU7Ht9rf37jP3mF3VMDeSlmhtBnlly', 'asdasdqweqwr', 'Google', 'uploads/images/users/6245628f94634.gif', 1, NULL, '2022-03-22 01:32:14', '2022-03-22 01:32:14'),
(3, 'Admin', 'admin1@mail.com', NULL, '$2y$10$xUubddcTTs8ZhuAttiXe/uXUviR0.rRUui4wcKaYT6kOh/VoxcaKS', NULL, NULL, 'https://rapbattle.test/uploads/images/users/Vector-5.png', 1, NULL, '2022-03-22 02:35:48', '2022-03-22 02:35:48'),
(4, 'user2917', '12a23sda12a23s4eq5w@', NULL, '$2y$10$0i3hlZtPhRcTB9QUcoHHG.fs.63pN8ILbNGj1efXNB4kAuSgBxO5O', '12a23sda12a23s4eq5w', 'Google', 'https://rapbattle.test/uploads/images/users/Vector-5.png', 1, NULL, '2022-03-22 02:38:35', '2022-03-22 02:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `length` bigint(20) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `trending` tinyint(1) NOT NULL DEFAULT '0',
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `name`, `video`, `thumbnail`, `length`, `release_date`, `description`, `trending`, `category_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'uploads/videos/Documentry/Aye Musht-e-Khaak - Full OST - Shani Arshad - Yashal Shahid - Feroze Khan - Sana Javed - Har Pal Geo.mp4', 'uploads/images/videos/WhatsApp Image 2022-02-16 at 12.38.35 PM.jpeg', 5, '2021-12-15', 'Test1234', 0, 1, 0, '2022-03-24 00:31:01', '2022-03-24 03:45:48'),
(16, 'Test', 'uploads/videos/Documentry/Aye Musht-e-Khaak - Full OST - Shani Arshad - Yashal Shahid - Feroze Khan - Sana Javed - Har Pal Geo.mp4', 'uploads/images/videos/WhatsApp Image 2022-02-16 at 12.38.35 PM.jpeg', 5, '2021-12-15', 'Test1234', 0, 1, 0, '2022-03-24 00:31:01', '2022-03-24 03:45:48'),
(17, 'Test', 'uploads/videos/Documentry/Aye Musht-e-Khaak - Full OST - Shani Arshad - Yashal Shahid - Feroze Khan - Sana Javed - Har Pal Geo.mp4', 'uploads/images/videos/WhatsApp Image 2022-02-16 at 12.38.35 PM.jpeg', 5, '2021-12-15', 'Test1234', 0, 1, 0, '2022-03-24 00:31:01', '2022-03-24 03:45:48'),
(18, 'Test', 'uploads/videos/Documentry/Aye Musht-e-Khaak - Full OST - Shani Arshad - Yashal Shahid - Feroze Khan - Sana Javed - Har Pal Geo.mp4', 'uploads/images/videos/WhatsApp Image 2022-02-16 at 12.38.35 PM.jpeg', 5, '2021-12-15', 'Test1234', 0, 1, 0, '2022-03-24 00:31:01', '2022-03-24 03:45:48'),
(19, 'Test', 'uploads/videos/Documentry/Aye Musht-e-Khaak - Full OST - Shani Arshad - Yashal Shahid - Feroze Khan - Sana Javed - Har Pal Geo.mp4', 'uploads/images/videos/WhatsApp Image 2022-02-16 at 12.38.35 PM.jpeg', 5, '2021-12-15', 'Test1234', 0, 1, 0, '2022-03-24 00:31:01', '2022-03-24 03:45:48'),
(24, 'Test1', 'uploads/videos/Documentry/ExcusesXBewafa-(Mashup)APDhillon&ImranKhan-DJSumitRajwanshi-SRMusicOfficial.mp4', 'uploads/images/videos/MUGHALSOFT.png', 5, '2022-04-05', 'Test', 0, 1, 1, '2022-04-06 05:20:02', '2022-04-06 05:20:02'),
(25, 'Test123', 'uploads/videos/Documentry/ExcusesXBewafa-(Mashup)APDhillon&ImranKhan-DJSumitRajwanshi-SRMusicOfficial.mp4', 'uploads/images/videos/MUGHALSOFT.png', 5, '2022-04-05', 'test', 0, 1, 1, '2022-04-06 05:32:29', '2022-04-06 05:32:29'),
(26, 'Test', 'uploads/videos/Documentry/ExcusesXBewafa-(Mashup)APDhillon&ImranKhan-DJSumitRajwanshi-SRMusicOfficial.mp4', 'uploads/images/videos/MUGHALSOFT.png', 5, '2022-04-11', 'asdasd', 0, 1, 1, '2022-04-06 05:34:30', '2022-04-06 05:34:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `likes_user_id_unique` (`user_id`),
  ADD KEY `likes_video_id_foreign` (`video_id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videos_category_id_foreign` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
