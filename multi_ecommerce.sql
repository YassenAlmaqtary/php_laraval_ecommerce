-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 12, 2021 at 12:38 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multi_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(225) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `password` varchar(225) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `photo`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$CC3iObMe1swHtr5MnyGYj.xNbWI8Mjtsq6TnGlaQZ26iVonzn.bTS', '2021-07-09 17:27:02', '2021-07-09 17:27:02');

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

DROP TABLE IF EXISTS `cards`;
CREATE TABLE IF NOT EXISTS `cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quintity` int(11) NOT NULL,
  `created_at` timestamp(4) NULL DEFAULT NULL,
  `updated_at` timestamp(4) NULL DEFAULT NULL,
  `color` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `user_id`, `product_id`, `quintity`, `created_at`, `updated_at`, `color`) VALUES
(1, 1, 1, 1, '2021-10-05 07:19:49.0000', '2021-10-05 07:19:49.0000', NULL),
(2, 1, 3, 1, '2021-10-05 07:32:04.0000', '2021-10-05 07:32:04.0000', NULL),
(3, 1, 9, 1, '2021-10-05 10:00:40.0000', '2021-10-05 10:00:40.0000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
CREATE TABLE IF NOT EXISTS `colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(11) NOT NULL,
  `hex` varchar(11) NOT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `hex`, `created_at`, `updated_at`) VALUES
(1, 'احمر', 'FFF6625E', '2021-09-25 21:00:00.000000', '2021-09-25 21:00:00.000000'),
(2, 'بنفسجي', 'FF836DB8', '2021-09-24 21:00:00.000000', '2021-09-24 21:00:00.000000'),
(3, 'بني', 'FFDECB9C', '2021-09-24 21:00:00.000000', '2021-09-24 21:00:00.000000'),
(4, 'ابيض', 'FFFFFFFF', '2021-09-24 21:00:00.000000', '2021-09-24 21:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `languges`
--

DROP TABLE IF EXISTS `languges`;
CREATE TABLE IF NOT EXISTS `languges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(10) DEFAULT NULL,
  `abbr` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `direction` enum('rtl','ltr') NOT NULL DEFAULT 'rtl',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp(4) NULL DEFAULT NULL,
  `updated_at` timestamp(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `languges`
--

INSERT INTO `languges` (`id`, `locale`, `abbr`, `name`, `direction`, `active`, `created_at`, `updated_at`) VALUES
(1, NULL, 'en', 'الانجليزية', 'rtl', 1, '2021-07-04 15:59:44.0000', '2021-07-08 02:15:18.0000'),
(2, NULL, 'ar', 'العربية', 'rtl', 1, '2021-07-04 23:11:03.0000', '2021-07-31 06:55:22.0000'),
(3, NULL, 'fr', 'الفرنسية', 'rtl', 0, '2021-07-11 11:09:21.0000', '2021-07-25 12:22:04.0000');

-- --------------------------------------------------------

--
-- Table structure for table `main_categories`
--

DROP TABLE IF EXISTS `main_categories`;
CREATE TABLE IF NOT EXISTS `main_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `translation_lang` varchar(11) NOT NULL,
  `translation_of` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  `created_at` timestamp(4) NULL DEFAULT NULL,
  `updated_at` timestamp(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `main_categories`
--

INSERT INTO `main_categories` (`id`, `translation_lang`, `translation_of`, `name`, `slug`, `photo`, `active`, `created_at`, `updated_at`) VALUES
(1, 'ar', 0, 'ملابس', '/ملابس', '/assets/admin/images/maincategories/MyIUQcUOcyQTUksnHyVOpOM5T2m39wRZSWMked5z.svg', 1, NULL, NULL),
(2, 'en', 1, 'clothe', '/clothe', '/assets/admin/images/maincategories/MyIUQcUOcyQTUksnHyVOpOM5T2m39wRZSWMked5z.svg', 1, NULL, NULL),
(3, 'ar', 0, 'العاب', '/العاب', '/assets/admin/images/maincategories/tRbiq0hgEBqC2eFkMCd2C6t2WsW8cYTrFj5FMxpc.svg', 1, NULL, NULL),
(4, 'en', 3, 'games', '/games', '/assets/admin/images/maincategories/tRbiq0hgEBqC2eFkMCd2C6t2WsW8cYTrFj5FMxpc.svg', 1, NULL, '2021-09-11 07:36:21.0000'),
(5, 'ar', 0, 'هدية', '/هدية', '/assets/admin/images/maincategories/gOpwAVyxlV9mMsnl6buDlfJsHE3eDeRIHEZICtYG.svg', 1, NULL, NULL),
(6, 'en', 5, 'Presents', '/Presents', '/assets/admin/images/maincategories/gOpwAVyxlV9mMsnl6buDlfJsHE3eDeRIHEZICtYG.svg', 1, NULL, NULL),
(7, 'ar', 0, 'عطور', '/عطور', '/assets/admin/images/maincategories/PWJM9Q4wbgFiiGB0udqARLIzg86Wa1qgL2DGXtdC.svg', 1, NULL, NULL),
(8, 'en', 7, 'pifume', '/pifume', '/assets/admin/images/maincategories/PWJM9Q4wbgFiiGB0udqARLIzg86Wa1qgL2DGXtdC.svg', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('renad@gmail.com', '$2y$10$S4yu4sqBFdozKX6Vfb65tOMR1aYixWGAftRRxpprvlsbmKw/ZyivO', '2021-08-08 11:33:31'),
('yassen.770355274@gmail.com', '$2y$10$ipYVJlqzAKcludSZTdz7QOCgtgniqV8t4VXMqsH.oTmAQU0zLyQHq', '2021-09-21 12:26:19');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
  `main_categorie_id` int(11) NOT NULL,
  `sub_categorie_id` int(11) NOT NULL,
  `translation_of` int(11) NOT NULL,
  `translation_lang` varchar(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(150) NOT NULL,
  `description` text,
  `slug` varchar(150) NOT NULL,
  `price` double NOT NULL,
  `descount` double DEFAULT NULL,
  `quntity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `vendor_id`, `main_categorie_id`, `sub_categorie_id`, `translation_of`, `translation_lang`, `active`, `name`, `description`, `slug`, `price`, `descount`, `quntity`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 3, 0, 'ar', 1, 'فساتسن', 'فساتسن رائعة وجميلة', '/فساتين', 200.993, NULL, 100, '2021-08-09 21:00:00', '2021-08-09 21:00:00'),
(2, 2, 1, 3, 1, 'en', 1, 'drerss', 'kkddkkd;d;dfmelkd;slqkw', '/dress', 200.833, NULL, 100, '2021-08-09 21:00:00', '2021-08-09 21:00:00'),
(3, 1, 1, 1, 0, 'ar', 1, 'شمزان', 'شمزان رارعةتتصتةيويوويص', '/شمزان', 200.36, NULL, 1000, '2021-08-09 21:00:00', '2021-08-09 21:00:00'),
(4, 1, 1, 1, 3, 'en', 1, 't-shirt', 'slkd;lskd;wkd;wkd;wdw', '/t-shirt', 200.736, NULL, 1000, '2021-08-09 21:00:00', '2021-08-09 21:00:00'),
(5, 3, 1, 3, 0, 'ar', 1, 'بلايز', 'بلايز اعصايهصاهصهصهثتث', 'بلايز/', 200.55, NULL, 22, '2021-08-22 21:00:00', '2021-08-22 21:00:00'),
(6, 3, 1, 3, 5, 'en', 1, 'Tops', 'kdokdowkdpwkdsmd wmdwlkwlw lwmlwkwl', '/tobs', 200.55, NULL, 22, '2021-08-22 21:00:00', '2021-08-22 21:00:00'),
(7, 3, 1, 3, 0, 'ar', 1, 'فساتين', 'نتاتهاعغق', 'فساتين/', 33.3, NULL, 30, '2021-08-22 21:00:00', '2021-08-22 21:00:00'),
(8, 3, 1, 3, 7, 'en', 1, 'address', 'kkkdjduee', '/address', 33.3, NULL, 30, '2021-09-10 21:00:00', '2021-09-10 21:00:00'),
(9, 1, 1, 9, 0, 'ar', 1, 'بدلة', 'بنبنبنبمنثيكثث', '/بدلة', 33.3, 22.2, 44, '2021-09-15 09:54:40', '2021-09-15 09:54:40'),
(10, 1, 1, 9, 9, 'en', 1, 'badlha', 'jdfdkfkf', '/badlha', 33.3, 22.2, 44, '2021-09-15 09:54:40', '2021-09-15 09:54:40');

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

DROP TABLE IF EXISTS `product_colors`;
CREATE TABLE IF NOT EXISTS `product_colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hex` varchar(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `color_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_colors`
--

INSERT INTO `product_colors` (`id`, `hex`, `hash`, `color_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'FFF6625E', '1862081337', NULL, 5, '2021-10-03 13:06:42.000000', '2021-10-03 13:06:42.000000'),
(2, 'FF836DB8', '1862081337', NULL, 5, '2021-10-03 13:06:42.000000', '2021-10-03 13:06:42.000000'),
(3, 'FFDECB9C', '1862081337', NULL, 5, '2021-10-03 13:06:42.000000', '2021-10-03 13:06:42.000000'),
(4, 'FFF6625E', '1862081337', NULL, 6, '2021-10-03 13:06:42.000000', '2021-10-03 13:06:42.000000'),
(5, 'FF836DB8', '1862081337', NULL, 6, '2021-10-03 13:06:42.000000', '2021-10-03 13:06:42.000000'),
(6, 'FFDECB9C', '1862081337', NULL, 6, '2021-10-03 13:06:42.000000', '2021-10-03 13:06:42.000000');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

DROP TABLE IF EXISTS `product_sizes`;
CREATE TABLE IF NOT EXISTS `product_sizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `proudct_photos`
--

DROP TABLE IF EXISTS `proudct_photos`;
CREATE TABLE IF NOT EXISTS `proudct_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `path` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proudct_photos`
--

INSERT INTO `proudct_photos` (`id`, `product_id`, `path`, `created_at`, `updated_at`) VALUES
(1, 1, '/assets/admin/images/products/ps4_console_white_4.png', '2021-08-09 21:00:00', '2021-08-09 21:00:00'),
(2, 2, '/assets/admin/images/products/ps4_console_white_4.png', '2021-08-09 21:00:00', '2021-08-09 21:00:00'),
(3, 3, '/assets/admin/images/products/N6XgcwhbxRgY7bKyOo3kwwxgdLjSYu3euQnXsspw.png', '2021-08-09 21:00:00', '2021-09-15 10:32:18'),
(4, 4, '/assets/admin/images/products/N6XgcwhbxRgY7bKyOo3kwwxgdLjSYu3euQnXsspw.png', '2021-08-09 21:00:00', '2021-09-15 10:32:18'),
(5, 1, '/assets/admin/images/products/shoes2.png', '2021-08-10 21:00:00', '2021-08-10 21:00:00'),
(6, 2, '/assets/admin/images/products/shoes2.png', '2021-08-10 21:00:00', '2021-08-10 21:00:00'),
(7, 3, '/assets/admin/images/products/ZFsnlKumecElCk6rdGqaXsFCJAqydT7ZuK05Vax4.png', '2021-09-15 22:17:02', '2021-09-15 22:17:23'),
(8, 4, '/assets/admin/images/products/ZFsnlKumecElCk6rdGqaXsFCJAqydT7ZuK05Vax4.png', '2021-09-15 22:17:02', '2021-09-15 22:17:23'),
(9, 9, '/assets/admin/images/products/g0JHflApm0HbEiXlNGE8vNbzJ0BiOHNxfDMYW8WW.png', '2021-09-15 22:30:34', '2021-09-15 22:30:34'),
(10, 10, '/assets/admin/images/products/g0JHflApm0HbEiXlNGE8vNbzJ0BiOHNxfDMYW8WW.png', '2021-09-15 22:30:34', '2021-09-15 22:30:34'),
(11, 9, '/assets/admin/images/products/ILKDI5B2coQIC0f8unZfpjSyRM3unm5K79ugNCXO.png', '2021-09-15 22:32:58', '2021-09-15 22:32:58'),
(12, 10, '/assets/admin/images/products/ILKDI5B2coQIC0f8unZfpjSyRM3unm5K79ugNCXO.png', '2021-09-15 22:32:58', '2021-09-15 22:32:58'),
(13, 7, '/assets/admin/images/products/qWoz2JAq1nTQDgInWgVr5Q50gjQxegSzZNMGIv3X.png', '2021-09-21 12:48:58', '2021-09-21 12:48:58'),
(14, 8, '/assets/admin/images/products/qWoz2JAq1nTQDgInWgVr5Q50gjQxegSzZNMGIv3X.png', '2021-09-21 12:48:58', '2021-09-21 12:48:58'),
(15, 5, '/assets/admin/images/products/vC7tyaW6ichL31rx2ScS9BOW1pP3jgGvpUjTq8zZ.jpg', '2021-09-26 14:13:11', '2021-09-26 14:13:11'),
(16, 6, '/assets/admin/images/products/vC7tyaW6ichL31rx2ScS9BOW1pP3jgGvpUjTq8zZ.jpg', '2021-09-26 14:13:11', '2021-09-26 14:13:11'),
(17, 5, '/assets/admin/images/products/6IURNguETmpp0hhIFIojggkRzdbgeQDk9HEW8ceF.png', '2021-09-28 14:41:00', '2021-09-28 14:41:00'),
(18, 6, '/assets/admin/images/products/6IURNguETmpp0hhIFIojggkRzdbgeQDk9HEW8ceF.png', '2021-09-28 14:41:00', '2021-09-28 14:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
CREATE TABLE IF NOT EXISTS `sizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(11) NOT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'صغير', '2021-09-28 21:00:00.000000', '2021-09-28 21:00:00.000000'),
(2, 'متوسط', '2021-09-28 21:00:00.000000', '2021-09-28 21:00:00.000000'),
(3, 'كبير', '2021-09-28 21:00:00.000000', '2021-09-28 21:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main_categorie_id` int(11) NOT NULL,
  `translation_lang` varchar(11) NOT NULL,
  `translation_of` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp(4) NULL DEFAULT NULL,
  `updated_at` timestamp(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `main_categorie_id`, `translation_lang`, `translation_of`, `name`, `slug`, `photo`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'ar', 0, 'ملابس رجالية', '/ملابس رجالية', '/assets/admin/images/subcategories/rTfe5X119uP15FrmM17mOTgsTQ2ZbtfYKO6oVy1B.png', 1, NULL, '2021-08-02 10:19:50.0000'),
(2, 1, 'en', 1, 'Men clothes', '/Men clothes', '/assets/admin/images/subcategories/rTfe5X119uP15FrmM17mOTgsTQ2ZbtfYKO6oVy1B.png', 1, NULL, '2021-08-02 10:19:50.0000'),
(3, 1, 'ar', 0, 'ملابس نسائية', '/ملابس نسائية', '/assets/admin/images/subcategories/L8gMrEiT1WgcTiclvkNCqSo8JBKoV27R0aOr9z87.png', 1, NULL, '2021-08-02 10:45:08.0000'),
(4, 1, 'en', 3, 'Women\'s Clothing', '/Women\'s Clothing', '/assets/admin/images/subcategories/L8gMrEiT1WgcTiclvkNCqSo8JBKoV27R0aOr9z87.png', 1, NULL, '2021-08-02 10:45:08.0000'),
(7, 1, 'ar', 0, 'ملابس بناتية', '/ملابس بناتية', '/assets/admin/images/subcategories/yKisNVp3hD3SV9okO4iStpcGaYEUhT0lIcI5cWN1.png', 1, NULL, NULL),
(5, 5, 'ar', 0, 'هداية اعياد ميلاد', '/هداية اعياد ميلاد', '/assets/admin/images/subcategories/YDdzqZ8aXsPXjwud9gAqvAuzgoL89QNns1cpRe5z.png', 1, NULL, '2021-08-02 11:47:19.0000'),
(6, 5, 'en', 5, 'partent hab', '/partent hab', '/assets/admin/images/subcategories/YDdzqZ8aXsPXjwud9gAqvAuzgoL89QNns1cpRe5z.png', 1, NULL, '2021-08-02 11:47:19.0000'),
(8, 1, 'en', 7, 'clothes grile', '/clothes grile', '/assets/admin/images/subcategories/yKisNVp3hD3SV9okO4iStpcGaYEUhT0lIcI5cWN1.png', 1, NULL, NULL),
(9, 1, 'ar', 0, 'ملابس  اطفال', '/ملابس  اطفال', '/assets/admin/images/subcategories/jn6S7Nx7aarjqM0Yf0N6NZKkr0LeTPRxPGLD6qxS.png', 1, NULL, '2021-08-02 12:14:01.0000'),
(10, 1, 'en', 9, 'Clothes baybys', '/Clothes baybys', '/assets/admin/images/subcategories/jn6S7Nx7aarjqM0Yf0N6NZKkr0LeTPRxPGLD6qxS.png', 1, NULL, '2021-08-02 12:14:20.0000'),
(11, 5, 'ar', 0, 'هداية حب', '/هداية حب', '/assets/admin/images/subcategories/OM083FrClQLJD6Xnzkkvdn5itpsedfDQBDQ1T7mV.png', 1, NULL, '2021-08-02 15:16:17.0000'),
(12, 5, 'en', 11, 'love gift', '/love gift', '/assets/admin/images/subcategories/OM083FrClQLJD6Xnzkkvdn5itpsedfDQBDQ1T7mV.png', 1, NULL, '2021-08-02 15:16:39.0000'),
(13, 5, 'ar', 0, 'هداية خطوبة', '/هداية خطوبة', '/assets/admin/images/subcategories/FdEZ6GsN1d6iiol8JERPDBjBMCcEdNRoF0unjCp3.png', 1, NULL, '2021-08-02 15:17:21.0000'),
(14, 5, 'en', 13, 'engagement gift', '/engagement gift', '/assets/admin/images/subcategories/FdEZ6GsN1d6iiol8JERPDBjBMCcEdNRoF0unjCp3.png', 1, NULL, '2021-08-02 15:17:21.0000'),
(15, 5, 'ar', 0, 'هداية زواج', '/هداية زواج', '/assets/admin/images/subcategories/GAv3K0EK45Hfxdf2PAHzxqO9umvIXvneE7RJir90.png', 1, NULL, NULL),
(16, 5, 'en', 15, 'hidayat zawaj marriage gift', '/hidayat zawaj marriage gift', '/assets/admin/images/subcategories/GAv3K0EK45Hfxdf2PAHzxqO9umvIXvneE7RJir90.png', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `last_name`, `phone`, `photo`) VALUES
(1, 'yassen', 'yassen.770355274@gmail.com', NULL, '$2y$10$RWM6iA2eMNeaKYldDS6qtOePv.gptSTmFlB9CDo50b5RLZ1amRPWu', 'Kfs0GcBdfU5DyveyY1LsyWYbguCdzsmqi1nqy2xNisKGOKbvavXHxyGhOozd', '2021-07-17 13:53:41', '2021-08-13 11:57:29', 'abdallha', '770355274', NULL),
(2, 'amr', 'amr@gmail.com', NULL, '$2y$10$3BrdKsEufj.sh9G2liUtq.zZnqDgLS6wUDoXjr050YeOjffKn95Xy', NULL, '2021-07-18 12:32:52', '2021-07-18 12:32:52', NULL, NULL, NULL),
(3, 'renad', 'renad@gmail.com', NULL, '$2y$10$qrWKLn0PIp2CMbhGuVBzEuNJ6DoNShIDsEEesRNsacp7FxqxqWSEi', 'Ld5Iaqt5cmy6a5HyDDH9mE7NBKeaTzFv1VuMj7mmmcKjlDtWwwnMh8tUIMlU', '2021-08-06 14:15:30', '2021-08-08 11:29:05', NULL, NULL, NULL),
(4, 'arkan', 'arkan11@gmail.com', NULL, '$2y$10$oYFPd2YnE3oiy/m09lJ1rOAR7SkxS3n2oKK/VBx835j6FpbpsL07i', NULL, '2021-08-25 04:26:49', '2021-08-25 04:26:49', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `main_categorie_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `logo` varchar(200) NOT NULL,
  `company_name` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `mobile`, `address`, `email`, `active`, `main_categorie_id`, `created_at`, `updated_at`, `logo`, `company_name`, `password`) VALUES
(1, 'yassen', '7368955566', '78', 'yassen.770355274@gmail.com', 1, 1, '2021-07-28 10:06:25', '2021-08-22 21:50:47', '/assets/admin/images/vendors/SqwBU4JWZqZNcXVHLUUnhJM1Zz6N4nJHV8sKHdAo.png', 'سيتسي ماكس', '$2y$10$272rLkhLiGLedoJTsKW4lexrWEgtHJcochEo7WDzIx91JvtOcDz9S'),
(2, 'Adell', '0775041016', '78', 'adl.88@gmail.com', 1, 1, '2021-08-04 22:20:06', '2021-08-22 21:48:35', '/assets/admin/images/vendors/oAU1ohunwyFrYevGE05G8AHuhBXd5FYJmrg5mUpg.png', 'مركز الكميم', '$2y$10$RkoHP0JcZdrkNnqhteHiBuGqOsZGKgQALScAS2DeDAthCLtAOfq4K'),
(3, 'محمد', '779853459', '66', 'mohmad@gmail.com', 1, 1, '2021-08-15 18:05:06', '2021-09-21 13:04:49', '/assets/admin/images/vendors/YKRo90RCUpHBLyWypmwNjgy9AyrnrPoqDcLD5yTW.png', 'مركز يمن مول التجاري', '$2y$10$QuLQ3r74PsVc5yNRKNe7MOJTgAFXRYsM1pFT1b64POoCvi/WEN5CK');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
