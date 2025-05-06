-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 06, 2025 at 12:24 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mdm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_brand`
--

DROP TABLE IF EXISTS `master_brand`;
CREATE TABLE IF NOT EXISTS `master_brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_brand`
--

INSERT INTO `master_brand` (`id`, `code`, `name`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'BRD011', 'Apple', 'Active', 1, '2025-05-06 10:33:39', '2025-05-06 12:10:37'),
(2, 'BRD002', 'Samsung ', 'Active', 1, '2025-05-06 10:34:01', '2025-05-06 10:34:01'),
(3, 'BRD003', 'Sony', 'Active', 1, '2025-05-06 10:34:19', '2025-05-06 10:34:19'),
(4, 'BRD004', 'LG', 'Active', 1, '2025-05-06 10:34:34', '2025-05-06 10:34:34'),
(5, 'BRD005', 'OnePlus', 'Active', 1, '2025-05-06 10:34:49', '2025-05-06 10:34:49'),
(6, 'BRD006', 'Dell', 'Active', 1, '2025-05-06 10:35:03', '2025-05-06 10:35:03'),
(7, 'BRD007', 'HP', 'Active', 1, '2025-05-06 10:35:40', '2025-05-06 10:35:40'),
(8, 'BRD008', 'Asus', 'Active', 1, '2025-05-06 10:36:17', '2025-05-06 10:36:17'),
(15, 'brd002', 'Facebook', 'Active', 2, '2025-05-06 11:42:18', '2025-05-06 11:42:18'),
(14, 'brd001', 'Intellij', 'Active', 2, '2025-05-06 11:41:59', '2025-05-06 11:41:59'),
(16, 'brand001', 'JetBrains', 'Active', 3, '2025-05-06 12:00:51', '2025-05-06 12:00:51'),
(17, 'BRD0010', 'Lenovo', 'Active', 1, '2025-05-06 12:09:27', '2025-05-06 12:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `master_category`
--

DROP TABLE IF EXISTS `master_category`;
CREATE TABLE IF NOT EXISTS `master_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_category`
--

INSERT INTO `master_category` (`id`, `code`, `name`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'CAT001', 'Smartphones', 'Active', 1, '2025-05-06 11:29:16', '2025-05-06 11:29:16'),
(2, 'CAT002', 'Laptops', 'Active', 2, '2025-05-06 11:29:16', '2025-05-06 11:29:16'),
(3, 'CAT003', 'Tablets', 'Active', 3, '2025-05-06 11:29:16', '2025-05-06 11:29:16'),
(4, 'CAT004', 'Smart Watches', 'Inactive', 1, '2025-05-06 11:29:16', '2025-05-06 11:29:16'),
(5, 'CAT005', 'Monitors', 'Active', 2, '2025-05-06 11:29:16', '2025-05-06 11:29:16'),
(6, 'CAT006', 'Desktops', 'Inactive', 3, '2025-05-06 11:29:16', '2025-05-06 11:29:16'),
(7, 'CAT007', 'Accessories', 'Active', 1, '2025-05-06 11:29:16', '2025-05-06 11:29:16'),
(8, 'CAT008', 'Cameras', 'Active', 2, '2025-05-06 11:29:16', '2025-05-06 11:29:16'),
(9, 'CAT009', 'Printers', 'Inactive', 1, '2025-05-06 11:29:16', '2025-05-06 11:29:16'),
(11, 'cat002', 'Intellij', 'Active', 3, '2025-05-06 12:02:04', '2025-05-06 12:02:54');

-- --------------------------------------------------------

--
-- Table structure for table `master_item`
--

DROP TABLE IF EXISTS `master_item`;
CREATE TABLE IF NOT EXISTS `master_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `brand_id` int NOT NULL,
  `category_id` int NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `attachment` blob,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `brand_id` (`brand_id`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_item`
--

INSERT INTO `master_item` (`id`, `brand_id`, `category_id`, `code`, `name`, `attachment`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'ITM001', 'Iphone 11', NULL, 'Active', 1, '2025-05-06 10:51:32', '2025-05-06 10:51:32'),
(2, 1, 1, 'ITM002', 'Iphone 11 Pro', NULL, 'Active', 1, '2025-05-06 10:53:29', '2025-05-06 11:02:01'),
(3, 1, 1, 'ITM003', 'Iphone 11 Pro Max', NULL, 'Active', 1, '2025-05-06 10:53:47', '2025-05-06 11:02:07'),
(4, 1, 1, 'ITM004', 'Iphone 12 ', NULL, 'Active', 1, '2025-05-06 10:53:57', '2025-05-06 11:02:15'),
(5, 1, 1, 'ITM005', 'Iphone 12 Pro', NULL, 'Active', 1, '2025-05-06 10:54:06', '2025-05-06 11:02:21'),
(6, 1, 1, 'ITM006', 'Iphone 13 ', NULL, 'Active', 1, '2025-05-06 10:54:21', '2025-05-06 11:02:39'),
(7, 1, 1, 'ITM007', 'Iphone 13 Pro Max', NULL, 'Inactive', 1, '2025-05-06 10:54:43', '2025-05-06 11:02:46'),
(8, 1, 1, 'ITM008', 'Iphone 14', NULL, 'Active', 1, '2025-05-06 10:54:53', '2025-05-06 11:02:53'),
(9, 1, 1, 'ITM009', 'Iphone 14 Pro', NULL, 'Active', 1, '2025-05-06 10:55:21', '2025-05-06 11:02:57'),
(10, 1, 1, 'ITM010', 'Iphone 15', NULL, 'Active', 1, '2025-05-06 10:55:37', '2025-05-06 11:03:02'),
(11, 1, 1, 'ITM011', 'Iphone X', NULL, 'Inactive', 1, '2025-05-06 10:55:49', '2025-05-06 11:03:08'),
(12, 1, 1, 'ITM012', 'Iphone 7', NULL, 'Active', 1, '2025-05-06 10:55:58', '2025-05-06 11:03:14'),
(14, 1, 1, 'ITM013', 'Iphone 13 mini', NULL, 'Active', 1, '2025-05-06 11:01:12', '2025-05-06 11:01:12'),
(20, 10, 2, 'item1', 'Expertbook', NULL, 'Active', 2, '2025-05-06 11:31:59', '2025-05-06 11:31:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, 'Alice Johnson', 'alice@example.com', 'password1', 0, '2025-05-06 10:32:54', '2025-05-06 10:32:54'),
(2, 'Bob Smith', 'bob@example.com', 'password2', 0, '2025-05-06 11:04:50', '2025-05-06 11:04:50'),
(3, 'Charlie Brown', 'charlie@example.com', 'password3', 0, '2025-05-06 11:44:22', '2025-05-06 11:44:22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
