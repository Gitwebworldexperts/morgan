-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 23, 2024 at 12:48 PM
-- Server version: 10.3.39-MariaDB-0ubuntu0.20.04.2
-- PHP Version: 8.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `morgansrealty`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `page_id` bigint(20) UNSIGNED DEFAULT NULL,
  `property_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `image_url`, `link`, `page_id`, `property_id`, `created_at`, `updated_at`) VALUES
(57, 'featured_images/featured_image_1726733864.png', NULL, NULL, 7, '2024-09-19 02:47:44', '2024-09-19 02:47:44'),
(58, 'featured_images/featured_image_1726734045.png', NULL, NULL, 14, '2024-09-19 02:50:45', '2024-09-19 02:50:45'),
(59, 'featured_images/featured_image_1726734076.png', NULL, NULL, 11, '2024-09-19 02:51:16', '2024-09-19 02:51:16'),
(60, 'featured_images/featured_image_1726734105.png', NULL, NULL, 12, '2024-09-19 02:51:45', '2024-09-19 02:51:45'),
(61, 'featured_images/featured_image_1726734154.png', NULL, NULL, 12, '2024-09-19 02:52:34', '2024-09-19 02:52:34'),
(62, 'featured_images/featured_image_1726734778.png', NULL, NULL, 18, '2024-09-19 03:02:58', '2024-09-19 03:02:58'),
(63, 'featured_images/featured_image_1726734800.png', NULL, NULL, 16, '2024-09-19 03:03:20', '2024-09-19 03:03:20'),
(64, 'images/image_17267348250.png', NULL, NULL, 14, '2024-09-19 03:03:45', '2024-09-19 03:03:45'),
(65, 'featured_images/featured_image_1726734825.png', NULL, NULL, 14, '2024-09-19 03:03:45', '2024-09-19 03:03:45'),
(73, 'images/image_17268097160.png', NULL, NULL, 1, '2024-09-19 23:51:56', '2024-09-19 23:51:56'),
(74, 'featured_images/featured_image_1726809716.png', NULL, NULL, 1, '2024-09-19 23:51:56', '2024-09-19 23:51:56'),
(79, 'featured_images/featured_image_1727094687.png', NULL, NULL, 3, '2024-09-23 07:01:27', '2024-09-23 07:01:27'),
(80, 'featured_images/featured_image_1727094906.png', NULL, NULL, 4, '2024-09-23 07:05:06', '2024-09-23 07:05:06'),
(81, 'featured_images/featured_image_1727094976.png', NULL, NULL, 5, '2024-09-23 07:06:16', '2024-09-23 07:06:16'),
(82, 'featured_images/featured_image_1727095026.png', NULL, NULL, 6, '2024-09-23 07:07:06', '2024-09-23 07:07:06');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buy_properties`
--

CREATE TABLE `buy_properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `google_maps_link` varchar(255) DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `area` decimal(10,2) DEFAULT NULL,
  `jacuzzi` tinyint(1) NOT NULL DEFAULT 0,
  `bed` int(11) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `sale_price` decimal(15,2) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_private` tinyint(1) NOT NULL DEFAULT 0,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'residential',
  `tag` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','pending') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `description`, `image_url`, `created_at`, `updated_at`) VALUES
(2, 'Afghanistan', NULL, NULL, NULL, NULL),
(6, 'Albania', NULL, NULL, NULL, NULL),
(7, 'Algeria', NULL, NULL, NULL, NULL),
(8, 'Andorra', NULL, NULL, NULL, NULL),
(9, 'Angola', NULL, NULL, NULL, NULL),
(10, 'Antigua and Barbuda', NULL, NULL, NULL, NULL),
(11, 'Argentina', NULL, NULL, NULL, NULL),
(12, 'Armenia', NULL, NULL, NULL, NULL),
(13, 'Australia', NULL, NULL, NULL, NULL),
(14, 'Austria', NULL, NULL, NULL, NULL),
(15, 'Azerbaijan', NULL, NULL, NULL, NULL),
(16, 'Bahamas', NULL, NULL, NULL, NULL),
(17, 'Bahrain', NULL, NULL, NULL, NULL),
(18, 'Bangladesh', NULL, NULL, NULL, NULL),
(19, 'Barbados', NULL, NULL, NULL, NULL),
(20, 'Belarus', NULL, NULL, NULL, NULL),
(21, 'Belgium', NULL, NULL, NULL, NULL),
(22, 'Belize', NULL, NULL, NULL, NULL),
(23, 'Benin', NULL, NULL, NULL, NULL),
(24, 'Bhutan', NULL, NULL, NULL, NULL),
(25, 'Bolivia', NULL, NULL, NULL, NULL),
(26, 'Bosnia and Herzegovina', NULL, NULL, NULL, NULL),
(27, 'Botswana', NULL, NULL, NULL, NULL),
(28, 'Brazil', NULL, NULL, NULL, NULL),
(29, 'Brunei', NULL, NULL, NULL, NULL),
(30, 'Bulgaria', NULL, NULL, NULL, NULL),
(31, 'Burkina Faso', NULL, NULL, NULL, NULL),
(32, 'Burundi', NULL, NULL, NULL, NULL),
(33, 'Cabo Verde', NULL, NULL, NULL, NULL),
(34, 'Cambodia', NULL, NULL, NULL, NULL),
(35, 'Cameroon', NULL, NULL, NULL, NULL),
(36, 'Canada', NULL, NULL, NULL, NULL),
(37, 'Central African Republic', NULL, NULL, NULL, NULL),
(38, 'Chad', NULL, NULL, NULL, NULL),
(39, 'Chile', NULL, NULL, NULL, NULL),
(40, 'China', NULL, NULL, NULL, NULL),
(41, 'Colombia', NULL, NULL, NULL, NULL),
(42, 'Comoros', NULL, NULL, NULL, NULL),
(43, 'Congo (Congo-Brazzaville)', NULL, NULL, NULL, NULL),
(44, 'Costa Rica', NULL, NULL, NULL, NULL),
(45, 'Croatia', NULL, NULL, NULL, NULL),
(46, 'Cuba', NULL, NULL, NULL, NULL),
(47, 'Cyprus', NULL, NULL, NULL, NULL),
(48, 'Czechia (Czech Republic)', NULL, NULL, NULL, NULL),
(49, 'Democratic Republic of the Congo', NULL, NULL, NULL, NULL),
(50, 'Denmark', NULL, NULL, NULL, NULL),
(51, 'Djibouti', NULL, NULL, NULL, NULL),
(52, 'Dominica', NULL, NULL, NULL, NULL),
(53, 'Dominican Republic', NULL, NULL, NULL, NULL),
(54, 'Ecuador', NULL, NULL, NULL, NULL),
(55, 'Egypt', NULL, NULL, NULL, NULL),
(56, 'El Salvador', NULL, NULL, NULL, NULL),
(57, 'Equatorial Guinea', NULL, NULL, NULL, NULL),
(58, 'Eritrea', NULL, NULL, NULL, NULL),
(59, 'Estonia', NULL, NULL, NULL, NULL),
(60, 'Eswatini (fmr. \"Swaziland\")', NULL, NULL, NULL, NULL),
(61, 'Ethiopia', NULL, NULL, NULL, NULL),
(62, 'Fiji', NULL, NULL, NULL, NULL),
(63, 'Finland', NULL, NULL, NULL, NULL),
(64, 'France', NULL, NULL, NULL, NULL),
(65, 'Gabon', NULL, NULL, NULL, NULL),
(66, 'Gambia', NULL, NULL, NULL, NULL),
(67, 'Georgia', NULL, NULL, NULL, NULL),
(68, 'Germany', NULL, NULL, NULL, NULL),
(69, 'Ghana', NULL, NULL, NULL, NULL),
(70, 'Greece', NULL, NULL, NULL, NULL),
(71, 'Grenada', NULL, NULL, NULL, NULL),
(72, 'Guatemala', NULL, NULL, NULL, NULL),
(73, 'Guinea', NULL, NULL, NULL, NULL),
(74, 'Guinea-Bissau', NULL, NULL, NULL, NULL),
(75, 'Guyana', NULL, NULL, NULL, NULL),
(76, 'Haiti', NULL, NULL, NULL, NULL),
(77, 'Honduras', NULL, NULL, NULL, NULL),
(78, 'Hungary', NULL, NULL, NULL, NULL),
(79, 'Iceland', NULL, NULL, NULL, NULL),
(80, 'India', NULL, NULL, NULL, NULL),
(81, 'Indonesia', NULL, NULL, NULL, NULL),
(82, 'Iran', NULL, NULL, NULL, NULL),
(83, 'Iraq', NULL, NULL, NULL, NULL),
(84, 'Ireland', NULL, NULL, NULL, NULL),
(85, 'Israel', NULL, NULL, NULL, NULL),
(86, 'Italy', NULL, NULL, NULL, NULL),
(87, 'Jamaica', NULL, NULL, NULL, NULL),
(88, 'Japan', NULL, NULL, NULL, NULL),
(89, 'Jordan', NULL, NULL, NULL, NULL),
(90, 'Kazakhstan', NULL, NULL, NULL, NULL),
(91, 'Kenya', NULL, NULL, NULL, NULL),
(92, 'Kiribati', NULL, NULL, NULL, NULL),
(93, 'Kuwait', NULL, NULL, NULL, NULL),
(94, 'Kyrgyzstan', NULL, NULL, NULL, NULL),
(95, 'Laos', NULL, NULL, NULL, NULL),
(96, 'Latvia', NULL, NULL, NULL, NULL),
(97, 'Lebanon', NULL, NULL, NULL, NULL),
(98, 'Lesotho', NULL, NULL, NULL, NULL),
(99, 'Liberia', NULL, NULL, NULL, NULL),
(100, 'Libya', NULL, NULL, NULL, NULL),
(101, 'Liechtenstein', NULL, NULL, NULL, NULL),
(102, 'Lithuania', NULL, NULL, NULL, NULL),
(103, 'Luxembourg', NULL, NULL, NULL, NULL),
(104, 'Madagascar', NULL, NULL, NULL, NULL),
(105, 'Malawi', NULL, NULL, NULL, NULL),
(106, 'Malaysia', NULL, NULL, NULL, NULL),
(107, 'Maldives', NULL, NULL, NULL, NULL),
(108, 'Mali', NULL, NULL, NULL, NULL),
(109, 'Malta', NULL, NULL, NULL, NULL),
(110, 'Marshall Islands', NULL, NULL, NULL, NULL),
(111, 'Mauritania', NULL, NULL, NULL, NULL),
(112, 'Mauritius', NULL, NULL, NULL, NULL),
(113, 'Mexico', NULL, NULL, NULL, NULL),
(114, 'Micronesia', NULL, NULL, NULL, NULL),
(115, 'Moldova', NULL, NULL, NULL, NULL),
(116, 'Monaco', NULL, NULL, NULL, NULL),
(117, 'Mongolia', NULL, NULL, NULL, NULL),
(118, 'Montenegro', NULL, NULL, NULL, NULL),
(119, 'Morocco', NULL, NULL, NULL, NULL),
(120, 'Mozambique', NULL, NULL, NULL, NULL),
(121, 'Myanmar (formerly Burma)', NULL, NULL, NULL, NULL),
(122, 'Namibia', NULL, NULL, NULL, NULL),
(123, 'Nauru', NULL, NULL, NULL, NULL),
(124, 'Nepal', NULL, NULL, NULL, NULL),
(125, 'Netherlands', NULL, NULL, NULL, NULL),
(126, 'New Zealand', NULL, NULL, NULL, NULL),
(127, 'Nicaragua', NULL, NULL, NULL, NULL),
(128, 'Niger', NULL, NULL, NULL, NULL),
(129, 'Nigeria', NULL, NULL, NULL, NULL),
(130, 'North Korea', NULL, NULL, NULL, NULL),
(131, 'North Macedonia', NULL, NULL, NULL, NULL),
(132, 'Norway', NULL, NULL, NULL, NULL),
(133, 'Oman', NULL, NULL, NULL, NULL),
(134, 'Pakistan', NULL, NULL, NULL, NULL),
(135, 'Palau', NULL, NULL, NULL, NULL),
(136, 'Palestine State', NULL, NULL, NULL, NULL),
(137, 'Panama', NULL, NULL, NULL, NULL),
(138, 'Papua New Guinea', NULL, NULL, NULL, NULL),
(139, 'Paraguay', NULL, NULL, NULL, NULL),
(140, 'Peru', NULL, NULL, NULL, NULL),
(141, 'Philippines', NULL, NULL, NULL, NULL),
(142, 'Poland', NULL, NULL, NULL, NULL),
(143, 'Portugal', NULL, NULL, NULL, NULL),
(144, 'Qatar', NULL, NULL, NULL, NULL),
(145, 'Romania', NULL, NULL, NULL, NULL),
(146, 'Russia', NULL, NULL, NULL, NULL),
(147, 'Rwanda', NULL, NULL, NULL, NULL),
(148, 'Saint Kitts and Nevis', NULL, NULL, NULL, NULL),
(149, 'Saint Lucia', NULL, NULL, NULL, NULL),
(150, 'Saint Vincent and the Grenadines', NULL, NULL, NULL, NULL),
(151, 'Samoa', NULL, NULL, NULL, NULL),
(152, 'San Marino', NULL, NULL, NULL, NULL),
(153, 'Sao Tome and Principe', NULL, NULL, NULL, NULL),
(154, 'Saudi Arabia', NULL, NULL, NULL, NULL),
(155, 'Senegal', NULL, NULL, NULL, NULL),
(156, 'Serbia', NULL, NULL, NULL, NULL),
(157, 'Seychelles', NULL, NULL, NULL, NULL),
(158, 'Sierra Leone', NULL, NULL, NULL, NULL),
(159, 'Singapore', NULL, NULL, NULL, NULL),
(160, 'Slovakia', NULL, NULL, NULL, NULL),
(161, 'Slovenia', NULL, NULL, NULL, NULL),
(162, 'Solomon Islands', NULL, NULL, NULL, NULL),
(163, 'Somalia', NULL, NULL, NULL, NULL),
(164, 'South Africa', NULL, NULL, NULL, NULL),
(165, 'South Korea', NULL, NULL, NULL, NULL),
(166, 'South Sudan', NULL, NULL, NULL, NULL),
(167, 'Spain', NULL, NULL, NULL, NULL),
(168, 'Sri Lanka', NULL, NULL, NULL, NULL),
(169, 'Sudan', NULL, NULL, NULL, NULL),
(170, 'Suriname', NULL, NULL, NULL, NULL),
(171, 'Sweden', NULL, NULL, NULL, NULL),
(172, 'Switzerland', NULL, NULL, NULL, NULL),
(173, 'Syria', NULL, NULL, NULL, NULL),
(174, 'Tajikistan', NULL, NULL, NULL, NULL),
(175, 'Tanzania', NULL, NULL, NULL, NULL),
(176, 'Thailand', NULL, NULL, NULL, NULL),
(177, 'Timor-Leste', NULL, NULL, NULL, NULL),
(178, 'Togo', NULL, NULL, NULL, NULL),
(179, 'Tonga', NULL, NULL, NULL, NULL),
(180, 'Trinidad and Tobago', NULL, NULL, NULL, NULL),
(181, 'Tunisia', NULL, NULL, NULL, NULL),
(182, 'Turkey', NULL, NULL, NULL, NULL),
(183, 'Turkmenistan', NULL, NULL, NULL, NULL),
(184, 'Tuvalu', NULL, NULL, NULL, NULL),
(185, 'Uganda', NULL, NULL, NULL, NULL),
(186, 'Ukraine', NULL, NULL, NULL, NULL),
(187, 'United Arab Emirates', NULL, NULL, NULL, NULL),
(188, 'United Kingdom', NULL, NULL, NULL, NULL),
(189, 'United States', NULL, NULL, NULL, NULL),
(190, 'Uruguay', NULL, NULL, NULL, NULL),
(191, 'Uzbekistan', NULL, NULL, NULL, NULL),
(192, 'Vanuatu', NULL, NULL, NULL, NULL),
(193, 'Vatican City', NULL, NULL, NULL, NULL),
(194, 'Venezuela', NULL, NULL, NULL, NULL),
(195, 'Vietnam', NULL, NULL, NULL, NULL),
(196, 'Yemen', NULL, NULL, NULL, NULL),
(197, 'Zambia', NULL, NULL, NULL, NULL),
(198, 'Zimbabwe', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `explore_reports`
--

CREATE TABLE `explore_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `page` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `page`, `created_at`, `updated_at`) VALUES
(4, 'How can I search for a luxury property for sale on your website?', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS.', 'home', '2024-09-18 05:23:04', '2024-09-18 05:23:04'),
(5, 'How can I search for a luxury property for sale on your website?', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS.', '', '2024-09-18 06:27:09', '2024-09-18 06:27:09'),
(6, 'How can I search for a luxury property for sale on your website?', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS.', '', '2024-09-18 06:27:24', '2024-09-18 06:27:24'),
(7, 'How can I search for a luxury property for sale on your website?', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS.', '', '2024-09-18 06:27:36', '2024-09-18 06:27:36');

-- --------------------------------------------------------

--
-- Table structure for table `footer_sections`
--

CREATE TABLE `footer_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `navigation_menus` text DEFAULT NULL,
  `newsletter_section` text DEFAULT NULL,
  `social_media_links` text DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_sections`
--

INSERT INTO `footer_sections` (`id`, `logo_url`, `address`, `email`, `phone`, `navigation_menus`, `newsletter_section`, `social_media_links`, `copyright`, `created_at`, `updated_at`) VALUES
(1, 'logos/logo_1726577203.png', '<b>Offices</b> 2408/2409, Concord Tower, Media City,<br> P.O. Box 450642, Dubai, UAE.', 'info@morgansrealty.com', '+54345 6454 343', '\"{\\n    \\\"urls\\\": {\\n        \\\"#About Us\\\": \\\"About Us\\\",\\n        \\\"#Contact Us\\\": \\\"Contact Us\\\",\\n        \\\"#Investments\\\": \\\"Investments\\\",\\n        \\\"#Careers\\\": \\\"Careers\\\",\\n        \\\"#Resources\\\": \\\"Resources\\\",\\n        \\\"#Area Guides\\\": \\\"Area Guides\\\",\\n        \\\"#Privacy Policy\\\": \\\"Privacy Policy\\\"\\n    },\\n    \\\"dropdown_urls\\\": {\\n        \\\"#Villa\\\": \\\"Villa\\\",\\n        \\\"#Floor\\\": \\\"Floor\\\",\\n        \\\"#Townhouse\\\": \\\"Townhouse\\\",\\n        \\\"#Penthouse\\\": \\\"Penthouse\\\",\\n        \\\"#Hotel Apartment\\\": \\\"Hotel Apartment\\\",\\n        \\\"#Land\\\": \\\"Land\\\",\\n        \\\"#Building\\\": \\\"Building\\\",\\n        \\\"#Shop\\\": \\\"Shop\\\",\\n        \\\"#Office\\\": \\\"Office\\\",\\n        \\\"#Warehouse\\\": \\\"Warehouse\\\"\\n    }\\n}\"', 'Always be the first to know sign up for our newsletter', '\"{\\n    \\\"#facebook\\\": \\\"<i class=\\\\\\\"fa-brands fa-facebook\\\\\\\"><\\\\\\/i>\\\",\\n    \\\"#youtube\\\": \\\"<i class=\\\\\\\"fa-brands fa-youtube\\\\\\\"><\\\\\\/i>\\\",\\n    \\\"#linkdin\\\": \\\"<i class=\\\\\\\"fa-brands fa-linkedin-in\\\\\\\"><\\\\\\/i>\\\",\\n    \\\"#instagram\\\": \\\"<i class=\\\\\\\"fa-brands fa-instagram\\\\\\\"><\\\\\\/i>\\\",\\n    \\\"#twitter\\\": \\\"<i class=\\\\\\\"fa-brands fa-x-twitter\\\\\\\"><\\\\\\/i>\\\",\\n    \\\"#pinterest\\\": \\\"<i class=\\\\\\\"fa-brands fa-pinterest-p\\\\\\\"><\\\\\\/i>\\\",\\n    \\\"#tiktok\\\": \\\"<i class=\\\\\\\"fa-brands fa-tiktok\\\\\\\"><\\\\\\/i>\\\"\\n}\"', '© Copyright 2024 Morgans International Realty. All Rights Reserved.', '2024-09-17 07:16:43', '2024-09-17 08:22:53');

-- --------------------------------------------------------

--
-- Table structure for table `header_sections`
--

CREATE TABLE `header_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `navigation_links` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `header_sections`
--

INSERT INTO `header_sections` (`id`, `logo_url`, `navigation_links`, `created_at`, `updated_at`) VALUES
(7, 'logos/logo_1726574143.svg', '\"{\\n    \\\"urls\\\": {\\n        \\\"#\\\": \\\"Buy\\\",\\n        \\\"#rent\\\": \\\"Rent\\\",\\n        \\\"#new\\\": \\\"New\\\"\\n    },\\n    \\\"buttons\\\": {\\n        \\\"first_button_name\\\": \\\"About\\\",\\n        \\\"first_button_url\\\": \\\"#about\\\",\\n        \\\"second_button_name\\\": null,\\n        \\\"second_button_url\\\": null\\n    },\\n    \\\"dropdown_urls\\\": {\\n        \\\"#menu\\\": \\\"first menu\\\",\\n        \\\"#second menu\\\": \\\"second menu\\\"\\n    }\\n}\"', '2024-09-17 06:24:09', '2024-09-20 01:18:42');

-- --------------------------------------------------------

--
-- Table structure for table `home_pages`
--

CREATE TABLE `home_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_1` enum('0','1') NOT NULL DEFAULT '1',
  `first_section_image` varchar(255) NOT NULL,
  `first_section_heading` varchar(255) NOT NULL,
  `list_property` text NOT NULL,
  `section_2` enum('0','1') NOT NULL DEFAULT '1',
  `second_heading` varchar(255) NOT NULL,
  `second_description` text NOT NULL,
  `second_section_button` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `section_3` enum('0','1') NOT NULL DEFAULT '1',
  `toggle_featured_property` enum('0','1') NOT NULL DEFAULT '1',
  `third_section_button` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `section_4` enum('0','1') NOT NULL DEFAULT '1',
  `fourth_heading` varchar(255) NOT NULL,
  `toggle_private_property` enum('0','1') NOT NULL DEFAULT '1',
  `fourth_description` text NOT NULL,
  `fourth_section_button` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `section_5` enum('0','1') NOT NULL DEFAULT '1',
  `fifth_heading` varchar(255) NOT NULL,
  `toggle_international_property` enum('0','1') NOT NULL DEFAULT '1',
  `fifth_section_image` varchar(255) NOT NULL,
  `fifth_section_button` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `section_6` enum('0','1') NOT NULL DEFAULT '1',
  `sixth_heading` varchar(255) NOT NULL,
  `toggle_development_property` enum('0','1') NOT NULL DEFAULT '1',
  `sixth_section_button` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `section_7` enum('0','1') NOT NULL DEFAULT '1',
  `seventh_heading` varchar(255) NOT NULL,
  `section_8` enum('0','1') NOT NULL DEFAULT '1',
  `eighth_heading` varchar(255) NOT NULL,
  `eighth_description` text NOT NULL,
  `eighth_section_button` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `section_9` enum('0','1') NOT NULL DEFAULT '1',
  `ninth_heading` varchar(255) NOT NULL,
  `toggle_blog_list` enum('0','1') NOT NULL DEFAULT '1',
  `section_10` enum('0','1') NOT NULL DEFAULT '1',
  `tenth_heading` varchar(255) NOT NULL,
  `tenth_description` text NOT NULL,
  `tenth_section_image` varchar(255) NOT NULL,
  `tenth_section_button` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_pages`
--

INSERT INTO `home_pages` (`id`, `section_1`, `first_section_image`, `first_section_heading`, `list_property`, `section_2`, `second_heading`, `second_description`, `second_section_button`, `section_3`, `toggle_featured_property`, `third_section_button`, `section_4`, `fourth_heading`, `toggle_private_property`, `fourth_description`, `fourth_section_button`, `section_5`, `fifth_heading`, `toggle_international_property`, `fifth_section_image`, `fifth_section_button`, `section_6`, `sixth_heading`, `toggle_development_property`, `sixth_section_button`, `section_7`, `seventh_heading`, `section_8`, `eighth_heading`, `eighth_description`, `eighth_section_button`, `section_9`, `ninth_heading`, `toggle_blog_list`, `section_10`, `tenth_heading`, `tenth_description`, `tenth_section_image`, `tenth_section_button`, `created_at`, `updated_at`) VALUES
(1, '1', '', 'heading', '[]', '1', 'h', 'kjh', '\"[]\"', '1', '1', '\"[]\"', '1', 'h', '0', 'hjk', '\"[]\"', '1', 'jh', '0', 'images/image_17270760840.png', '\"[]\"', '1', 'h', '0', '\"[]\"', '1', 'kj', '1', 'h', 'jkh', '\"[]\"', '1', 'hjk', '0', '1', 'jk', 'h', '', '\"[]\"', '2024-09-23 01:51:24', '2024-09-23 01:51:24'),
(2, '1', '', 'heading', '[]', '1', 'h', 'kjh', '\"[]\"', '1', '1', '\"[]\"', '1', 'h', '0', 'hjk', '\"[]\"', '1', 'jh', '0', 'images/image_17270761150.png', '\"[]\"', '1', 'h', '0', '\"[]\"', '1', 'kj', '1', 'h', 'jkh', '\"[]\"', '1', 'hjk', '0', '1', 'jk', 'h', '', '\"[]\"', '2024-09-23 01:51:55', '2024-09-23 01:51:55'),
(3, '1', '', 'heading', '[]', '1', 'h', 'kjh', '\"[]\"', '1', '1', '\"[]\"', '1', 'h', '0', 'hjk', '\"[]\"', '1', 'jh', '0', 'images/image_17270761520.png', '\"[]\"', '1', 'h', '0', '\"[]\"', '1', 'kj', '1', 'h', 'jkh', '\"[]\"', '1', 'hjk', '0', '1', 'jk', 'h', '', '\"[]\"', '2024-09-23 01:52:32', '2024-09-23 01:52:32'),
(4, '1', '', 'h', '[]', '1', 'klj', 'klj', '\"[]\"', '1', '1', '\"[]\"', '1', 'lk', '0', 'jlk', '\"[]\"', '1', 'jlk', '0', '', '\"[]\"', '1', 'kl', '0', '\"[]\"', '1', 'j', '1', 'kl', 'jkl', '\"[]\"', '1', 'j', '0', '1', 'jkl', 'j', '', '\"[]\"', '2024-09-23 01:53:25', '2024-09-23 01:53:25'),
(5, '1', 'images/image_17270771950.png', 'Find a home that suits your Lifestyle.', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[]\"', '1', '1', '\"[]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[]\"', '1', 'International properties', '0', 'images/image_17270771950.png', '\"[]\"', '1', 'New Developments', '0', '\"[]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270771950.png', '\"[]\"', '2024-09-23 02:09:55', '2024-09-23 02:09:55'),
(6, '1', 'images/image_17270771950.png', 'Find a home that suits your Lifestyle.', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[]\"', '1', '1', '\"[]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[]\"', '1', 'International properties', '0', 'images/image_17270773480.png', '\"[]\"', '1', 'New Developments', '0', '\"[]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270771950.png', '\"[]\"', '2024-09-23 02:12:28', '2024-09-23 02:12:28'),
(7, '1', 'images/image_17270771950.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[]\"', '1', '1', '\"[]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[]\"', '1', 'International properties', '0', 'images/image_17270771950.png', '\"[]\"', '1', 'New Developments', '0', '\"[]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270771950.png', '\"[]\"', '2024-09-23 02:13:09', '2024-09-23 02:13:09'),
(8, '1', 'images/image_17270785260.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[]\"', '1', '1', '\"[]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[]\"', '1', 'International properties', '0', 'images/image_17270771950.png', '\"[]\"', '1', 'New Developments', '0', '\"[]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270785260.png', '\"[]\"', '2024-09-23 02:32:06', '2024-09-23 02:32:06'),
(9, '1', 'images/image_17270786040.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[]\"', '1', '1', '\"[]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[]\"', '1', 'International properties', '0', 'images/image_17270786040.png', '\"[]\"', '1', 'New Developments', '0', '\"[]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270786040.png', '\"[]\"', '2024-09-23 02:33:24', '2024-09-23 02:33:24'),
(10, '1', 'images/image_17270787200.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[]\"', '1', '1', '\"[]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[]\"', '1', 'International properties', '0', 'images/image_17270787200.png', '\"[]\"', '1', 'New Developments', '0', '\"[]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270787200.png', '\"[]\"', '2024-09-23 02:35:20', '2024-09-23 02:35:20'),
(11, '1', 'images/image_17270789301.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[]\"', '1', '1', '\"[]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[]\"', '1', 'New Developments', '0', '\"[]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[]\"', '2024-09-23 02:38:50', '2024-09-23 02:38:50'),
(12, '1', 'images/image_17270789301.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[]\"', '1', '1', '\"[]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[]\"', '1', 'New Developments', '0', '\"[]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[]\"', '2024-09-23 02:39:05', '2024-09-23 02:39:05'),
(13, '0', 'images/image_17270789301.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[]\"', '1', '1', '\"[]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[]\"', '1', 'New Developments', '0', '\"[]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[]\"', '2024-09-23 02:49:27', '2024-09-23 02:49:27'),
(14, '1', 'images/image_17270789301.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[]\"', '1', '1', '\"[]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[]\"', '1', 'New Developments', '0', '\"[]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[]\"', '2024-09-23 02:53:21', '2024-09-23 02:53:21'),
(15, '0', 'images/image_17270789301.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[]\"', '1', '1', '\"[]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[]\"', '1', 'New Developments', '0', '\"[]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[]\"', '2024-09-23 02:53:25', '2024-09-23 02:53:25'),
(16, '1', 'images/image_17270789301.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[]\"', '1', '1', '\"[]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[]\"', '1', 'New Developments', '0', '\"[]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[]\"', '2024-09-23 02:53:47', '2024-09-23 02:53:47'),
(17, '0', 'images/image_17270789301.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[]\"', '1', '1', '\"[]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[]\"', '1', 'New Developments', '0', '\"[]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[]\"', '2024-09-23 02:53:51', '2024-09-23 02:53:51'),
(18, '0', 'images/image_17270789301.png', 'Find a home that suits your Lifestyle', '[]', '0', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[]\"', '0', '1', '\"[]\"', '0', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[]\"', '0', 'International properties', '0', 'images/image_17270789302.png', '\"[]\"', '0', 'New Developments', '0', '\"[]\"', '0', 'media Mentions', '0', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[]\"', '0', 'The Market', '0', '0', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[]\"', '2024-09-23 02:54:07', '2024-09-23 02:54:07'),
(19, '1', 'images/image_17270789301.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[]\"', '1', '1', '\"[]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[]\"', '1', 'New Developments', '0', '\"[]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[]\"', '2024-09-23 02:54:26', '2024-09-23 02:54:26'),
(20, '1', 'images/image_17270789301.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"first\\\",\\\"buttonUrl\\\":\\\"#first\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"\\\",\\\"buttonUrl\\\":\\\"\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"\\\",\\\"buttonUrl\\\":\\\"\\\"}]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[{\\\"buttonName\\\":\\\"\\\",\\\"buttonUrl\\\":\\\"\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"\\\",\\\"buttonUrl\\\":\\\"\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"\\\",\\\"buttonUrl\\\":\\\"\\\"},{\\\"buttonName\\\":\\\"\\\",\\\"buttonUrl\\\":\\\"\\\"}]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[{\\\"buttonName\\\":\\\"\\\",\\\"buttonUrl\\\":\\\"\\\"}]\"', '2024-09-23 03:12:51', '2024-09-23 03:12:51'),
(21, '1', 'images/image_17270789301.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"new button\\\",\\\"buttonUrl\\\":\\\"new button_url\\\"}]\"', '1', '1', '\"[\\\"\\\"]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[\\\"\\\"]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[\\\"\\\"]\"', '1', 'New Developments', '0', '\"[\\\"\\\"]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[\\\"\\\",\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[\\\"\\\"]\"', '2024-09-23 03:14:52', '2024-09-23 03:14:52'),
(22, '1', 'images/image_17270789301.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[\\\"\\\"]\"', '1', '1', '\"[\\\"\\\"]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[\\\"\\\"]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[\\\"\\\"]\"', '1', 'New Developments', '0', '\"[\\\"\\\"]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[\\\"\\\",\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"null\"', '2024-09-23 03:18:45', '2024-09-23 03:18:45'),
(23, '1', 'images/image_17270789301.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"null\"', '1', '1', '\"null\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"null\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"null\"', '1', 'New Developments', '0', '\"null\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"null\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"null\"', '2024-09-23 03:23:02', '2024-09-23 03:23:02'),
(24, '1', 'images/image_17270789301.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"null\"', '1', '1', '\"null\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"null\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"null\"', '1', 'New Developments', '0', '\"null\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"null\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[{\\\"buttonName\\\":\\\"button\\\",\\\"buttonUrl\\\":\\\"button url\\\"}]\"', '2024-09-23 03:23:26', '2024-09-23 03:23:26'),
(25, '1', 'images/image_17270789301.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"null\"', '1', '1', '\"null\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"null\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"null\"', '1', 'New Developments', '0', '\"null\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"null\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[{\\\"buttonName\\\":\\\"tenth\\\",\\\"buttonUrl\\\":\\\"then#\\\"}]\"', '2024-09-23 03:59:59', '2024-09-23 03:59:59'),
(26, '1', 'images/image_17270789301.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},{\\\"buttonName\\\":\\\"Learn more\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 05:01:54', '2024-09-23 05:01:54'),
(27, '1', 'images/image_17270881171.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 05:11:57', '2024-09-23 05:11:57'),
(28, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 05:12:08', '2024-09-23 05:12:08'),
(29, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realtys\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 05:48:19', '2024-09-23 05:48:19'),
(30, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 05:56:35', '2024-09-23 05:56:35'),
(31, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '0', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 06:01:50', '2024-09-23 06:01:50'),
(32, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 06:03:03', '2024-09-23 06:03:03'),
(33, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '0', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 06:03:11', '2024-09-23 06:03:11');
INSERT INTO `home_pages` (`id`, `section_1`, `first_section_image`, `first_section_heading`, `list_property`, `section_2`, `second_heading`, `second_description`, `second_section_button`, `section_3`, `toggle_featured_property`, `third_section_button`, `section_4`, `fourth_heading`, `toggle_private_property`, `fourth_description`, `fourth_section_button`, `section_5`, `fifth_heading`, `toggle_international_property`, `fifth_section_image`, `fifth_section_button`, `section_6`, `sixth_heading`, `toggle_development_property`, `sixth_section_button`, `section_7`, `seventh_heading`, `section_8`, `eighth_heading`, `eighth_description`, `eighth_section_button`, `section_9`, `ninth_heading`, `toggle_blog_list`, `section_10`, `tenth_heading`, `tenth_description`, `tenth_section_image`, `tenth_section_button`, `created_at`, `updated_at`) VALUES
(34, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 06:03:18', '2024-09-23 06:03:18'),
(35, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all propertie\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 06:13:52', '2024-09-23 06:13:52'),
(36, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 06:14:01', '2024-09-23 06:14:01'),
(37, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the publics', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 06:14:16', '2024-09-23 06:14:16'),
(38, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270789302.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270789303.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 06:14:25', '2024-09-23 06:14:25'),
(39, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270926912.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270926913.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 06:28:11', '2024-09-23 06:28:11'),
(40, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270927122.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270926913.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 06:28:32', '2024-09-23 06:28:32'),
(41, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270927462.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270926913.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 06:29:06', '2024-09-23 06:29:06'),
(42, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270927462.png', '\"[{\\\"buttonName\\\":\\\"view all propertie\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270926913.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 06:29:31', '2024-09-23 06:29:31'),
(43, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270927462.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270926913.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 06:29:41', '2024-09-23 06:29:41'),
(44, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270927462.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Development', '0', '\"[{\\\"buttonName\\\":\\\"view all propertie\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270926913.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 06:32:49', '2024-09-23 06:32:49'),
(45, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270927462.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270926913.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 06:33:03', '2024-09-23 06:33:03'),
(46, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270927462.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'medias Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270926913.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 06:38:45', '2024-09-23 06:38:45'),
(47, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270927462.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},\\\"\\\"]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270926913.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 06:39:05', '2024-09-23 06:39:05'),
(48, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270927462.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},{\\\"buttonName\\\":\\\"Learn More\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270926913.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 06:47:26', '2024-09-23 06:47:26'),
(49, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270927462.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},{\\\"buttonName\\\":\\\"learn mo\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270926913.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 06:47:57', '2024-09-23 06:47:57'),
(50, '1', 'images/image_17270881281.png', 'Find a home that suits your Lifestyle', '[]', '1', 'Welcome to Morgan’s International Realty', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort', '\"[{\\\"buttonName\\\":\\\"Read more about morgan\\\\u2019s realty\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', '1', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'Morgan’s private office', '0', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create an impact in a market which was just evolving empowered by a joint effort of the public', '\"[{\\\"buttonName\\\":\\\"View all properties\\\",\\\"buttonUrl\\\":\\\"#`\\\"}]\"', '1', 'International properties', '0', 'images/image_17270927462.png', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'New Developments', '0', '\"[{\\\"buttonName\\\":\\\"view all properties\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'media Mentions', '1', 'Make a move for your future', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', '\"[{\\\"buttonName\\\":\\\"Book an instant property valuation\\\",\\\"buttonUrl\\\":\\\"#\\\"},{\\\"buttonName\\\":\\\"Learn More\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '1', 'The Market', '0', '1', 'Sed ut perspiciatis unde omnis', 'Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create', 'images/image_17270926913.png', '\"[{\\\"buttonName\\\":\\\"Explore all reports\\\",\\\"buttonUrl\\\":\\\"#\\\"}]\"', '2024-09-23 06:48:12', '2024-09-23 06:48:12');

-- --------------------------------------------------------

--
-- Table structure for table `international_properties`
--

CREATE TABLE `international_properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `google_maps_link` varchar(255) DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `area` decimal(10,2) DEFAULT NULL,
  `jacuzzi` tinyint(1) NOT NULL DEFAULT 0,
  `bed` int(11) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `sale_price` decimal(15,2) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_private` tinyint(1) NOT NULL DEFAULT 0,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'residential',
  `tag` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','pending') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `international_properties`
--

INSERT INTO `international_properties` (`id`, `name`, `address`, `google_maps_link`, `featured_image`, `area`, `jacuzzi`, `bed`, `price`, `sale_price`, `is_featured`, `is_private`, `country_id`, `category_id`, `description`, `type`, `tag`, `status`, `created_at`, `updated_at`) VALUES
(1, 'International properties', 'adddress', 'http://localhost:8000/international_properties/create', 'featured_images/featured_image_1726809716.png', '159.00', 1, 6, '456.00', '453.00', 1, 1, 2, 8, NULL, 'residential', NULL, 'active', '2024-09-19 23:51:56', '2024-09-19 23:52:37'),
(2, 'xzc', 'sdf', 'http://localhost:8000/international_properties/create', 'featured_images/featured_image_1726809797.png', '5.00', 1, 1, '7.00', '8.00', 1, 1, 3, 8, NULL, 'residential', NULL, 'active', '2024-09-19 23:53:17', '2024-09-19 23:53:17');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(10, '2024_09_16_120615_create_countries_table', 2),
(11, '2024_09_16_120616_create_property_categories_table', 2),
(13, '2024_09_16_120651_create_blog__categories_table', 3),
(14, '2024_09_16_120655_create_blog_posts_table', 4),
(15, '2024_09_16_121253_create_explore_reports_table', 4),
(17, '2024_09_16_123305_create_header_sections_table', 4),
(18, '2024_09_16_123319_create_footer_sections_table', 4),
(19, '2024_09_16_123251_create_faqs_table', 5),
(21, '2024_09_16_120617_create_properties_table', 6),
(22, '2024_09_16_120603_create_banners_table', 7),
(24, '2024_09_19_085351_add_description_and_type_to_properties_table', 8),
(25, '2024_09_19_100119_create_property_types_table', 9),
(26, '2024_09_19_123456_create_international_properties_table', 10),
(27, '2024_09_19_123456_create_private_properties_table', 10),
(28, '2024_09_19_123456_create_project_properties_table', 10),
(29, '2024_09_19_123456_create_rent_properties_table', 10),
(30, '2024_09_19_123457_create_buy_properties_table', 10),
(31, '2024_09_20_075857_create_home_pages_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `private_properties`
--

CREATE TABLE `private_properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `google_maps_link` varchar(255) DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `area` decimal(10,2) DEFAULT NULL,
  `jacuzzi` tinyint(1) NOT NULL DEFAULT 0,
  `bed` int(11) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `sale_price` decimal(15,2) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_private` tinyint(1) NOT NULL DEFAULT 0,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'residential',
  `tag` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','pending') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `private_properties`
--

INSERT INTO `private_properties` (`id`, `name`, `address`, `google_maps_link`, `featured_image`, `area`, `jacuzzi`, `bed`, `price`, `sale_price`, `is_featured`, `is_private`, `country_id`, `category_id`, `description`, `type`, `tag`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Stunning 4-Bedroom I Full Sea View', '75 Prince St, NY, USA', 'http://localhost:8000/properties/create', 'featured_images/featured_image_1727094687.png', '12.00', 1, 2, '157.00', '120.00', 1, 0, 80, 4, NULL, 'residential', NULL, 'active', '2024-09-23 07:01:27', '2024-09-23 07:01:27'),
(4, 'Stunning 4-Bedroom I Full Sea View', '75 Prince St, NY, USA', 'http://localhost:8000/properties/create', 'featured_images/featured_image_1727094906.png', '45.00', 1, 3, '452.00', '411.00', 1, 0, 80, 4, NULL, 'residential', NULL, 'active', '2024-09-23 07:05:06', '2024-09-23 07:05:06'),
(5, 'Stunning 4-Bedroom I Full Sea View', '75 Prince St, NY, USA', 'http://localhost:8000/properties/create', 'featured_images/featured_image_1727094976.png', '159.00', 1, 3, '196.00', '150.00', 1, 0, 80, 4, NULL, 'residential', NULL, 'active', '2024-09-23 07:06:16', '2024-09-23 07:06:16'),
(6, 'Stunning 4-Bedroom I Full Sea View', '75 Prince St, NY, USA', 'http://localhost:8000/properties/create', 'featured_images/featured_image_1727095026.png', '156.00', 1, 4, '456.00', '451.00', 1, 0, 80, 4, NULL, 'residential', NULL, 'active', '2024-09-23 07:07:06', '2024-09-23 07:07:06');

-- --------------------------------------------------------

--
-- Table structure for table `project_properties`
--

CREATE TABLE `project_properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `google_maps_link` varchar(255) DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `area` decimal(10,2) DEFAULT NULL,
  `jacuzzi` tinyint(1) NOT NULL DEFAULT 0,
  `bed` int(11) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `sale_price` decimal(15,2) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_private` tinyint(1) NOT NULL DEFAULT 0,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'residential',
  `tag` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','pending') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `google_maps_link` varchar(255) DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `area` decimal(10,2) DEFAULT NULL,
  `jacuzzi` tinyint(1) NOT NULL DEFAULT 0,
  `bed` int(11) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `sale_price` decimal(15,2) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_private` tinyint(1) NOT NULL DEFAULT 0,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(255) DEFAULT 'residential',
  `tag` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','pending') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `name`, `address`, `google_maps_link`, `featured_image`, `area`, `jacuzzi`, `bed`, `price`, `sale_price`, `is_featured`, `is_private`, `country_id`, `category_id`, `created_at`, `updated_at`, `description`, `type`, `tag`, `status`) VALUES
(7, 'Stunning 4-Bedroom I Full Sea View', '75 Prince St, NY, USA', 'http://localhost:8000/properties/create', 'featured_images/featured_image_1726733864.png', '7228.00', 1, 1, '157.00', '1950000001.00', 1, 0, NULL, 2, '2024-09-19 00:12:12', '2024-09-19 02:48:07', NULL, 'residential', NULL, 'active'),
(11, 'Stunning 4-Bedroom I Full Sea View', '75 Prince St, NY, USA', 'http://localhost:8000/properties/create', 'featured_images/featured_image_1726734076.png', '7228.00', 1, 1, '157.00', '1950000001.00', 1, 0, NULL, 2, '2024-09-19 00:12:12', '2024-09-19 02:51:16', NULL, 'residential', NULL, 'active'),
(12, 'Stunning 4-Bedroom I Full Sea View', '75 Prince St, NY, USA', 'http://localhost:8000/properties/create', 'featured_images/featured_image_1726734154.png', '7228.00', 1, 1, '157.00', '1950000001.00', 1, 0, NULL, 2, '2024-09-19 00:12:12', '2024-09-19 02:52:34', NULL, 'residential', NULL, 'active'),
(13, 'Stunning 4-Bedroom I Full Sea View', '75 Prince St, NY, USA', 'http://localhost:8000/properties/create', 'featured_images/featured_image_1726733864.png', '7228.00', 1, 1, '157.00', '1950000001.00', 1, 0, NULL, 2, '2024-09-19 00:12:12', '2024-09-19 02:48:07', NULL, 'residential', NULL, 'active'),
(14, 'Stunning 4-Bedroom I Full Sea View', '75 Prince St, NY, USA', 'http://localhost:8000/properties/create', 'featured_images/featured_image_1726734825.png', '7228.00', 1, 1, '157.00', '1950000001.00', 1, 0, NULL, 2, '2024-09-19 00:12:12', '2024-09-19 03:03:45', NULL, 'residential', NULL, 'active'),
(15, 'Stunning 4-Bedroom I Full Sea View.', '75 Prince St, NY, USA', 'http://localhost:8000/properties/create', 'featured_images/featured_image_1726734076.png', '7228.00', 1, 1, '157.00', '1950000001.00', 0, 1, NULL, 2, '2024-09-19 00:12:12', '2024-09-19 03:01:47', NULL, 'residential', NULL, 'active'),
(16, 'Stunning 4-Bedroom I Full Sea View', '75 Prince St, NY, USA', 'http://localhost:8000/properties/create', 'featured_images/featured_image_1726734800.png', '7228.00', 1, 1, '157.00', '1950000001.00', 0, 1, NULL, 2, '2024-09-19 00:12:12', '2024-09-19 03:03:20', NULL, 'residential', NULL, 'active'),
(17, 'Stunning 4-Bedroom I Full Sea View', '75 Prince St, NY, USA', 'http://localhost:8000/properties/create', 'featured_images/featured_image_1726733864.png', '7228.00', 1, 1, '157.00', '1950000001.00', 0, 1, NULL, 2, '2024-09-19 00:12:12', '2024-09-19 03:02:07', NULL, 'residential', NULL, 'active'),
(18, 'Stunning 4-Bedroom I Full Sea View', '75 Prince St, NY, USA', 'http://localhost:8000/properties/create', 'featured_images/featured_image_1726734778.png', '7228.00', 1, 2, '157.00', '1950000001.00', 0, 1, NULL, 3, '2024-09-19 00:12:12', '2024-09-19 06:06:15', NULL, 'residential', NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `property_categories`
--

CREATE TABLE `property_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_categories`
--

INSERT INTO `property_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'property category', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `property` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `type_name`, `property`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Appartment', 'master', 1, '2024-09-19 05:30:09', '2024-09-19 05:30:09'),
(4, 'Private Appartment', 'private', 1, '2024-09-19 07:29:18', '2024-09-19 07:32:49'),
(5, 'project Property', 'project', 1, '2024-09-19 08:06:01', '2024-09-19 08:06:01'),
(6, 'Rent Property', 'rent', 1, '2024-09-19 08:23:34', '2024-09-19 08:23:34'),
(8, 'international type', 'international', 1, '2024-09-19 23:50:20', '2024-09-19 23:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `rent_properties`
--

CREATE TABLE `rent_properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `google_maps_link` varchar(255) DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `area` decimal(10,2) DEFAULT NULL,
  `jacuzzi` tinyint(1) NOT NULL DEFAULT 0,
  `bed` int(11) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `sale_price` decimal(15,2) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_private` tinyint(1) NOT NULL DEFAULT 0,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'residential',
  `tag` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','pending') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3MritpSwWf0flTiwvBEFzlmVSjSzn8yzjSawBWcq', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiOFU5OFNqdFVIajgxcnlVYlZMZ0QwVFNmaDU2eUtUdjM1ZGQ5aFh1SCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjUyOiJodHRwOi8vbG9jYWxob3N0OjgwMDEvYWRtaW4vaW50ZXJuYXRpb25hbF9wcm9wZXJ0aWVzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3MjcwOTAyMjE7fX0=', 1727095070),
('Jsrsu3a5ldBtfPL9PcPXfnrIabCNSU0BnSYs2RLh', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoid2pzWnQ0MDNoam5FUWNnVElmc3lDdGFNRGp0T3ZzVFFoSmpibkI3cSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vbG9jYWxob3N0OjgwMDEiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTcyNzA5NTY3MDt9fQ==', 1727095670);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'yesvant', 'yesvant@webworldexpertsindia.com', NULL, '$2y$12$fuY8sQ8bJAa0VJaiHqYLgeZFBiEjqFX5IdfDMAqeU5KeKpUn/OL0q', 'NjSz5HcawYi8EtO85ruVtr5sSMJhK204iHrimaBhcUHwaGzH8G2f5qIIfB3i', '2024-09-16 05:36:57', '2024-09-16 05:36:57'),
(2, 'Test User', 'test@example.com', '2024-09-20 00:10:59', '$2y$12$8BbSyXOzAlyDPg3jFGV/oewe5b3tgS3JOOkX5JEFlvoRB0BqnsdZO', 'wdOuNhzJhb', '2024-09-20 00:11:00', '2024-09-20 00:11:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_posts_category_id_foreign` (`category_id`);

--
-- Indexes for table `buy_properties`
--
ALTER TABLE `buy_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `explore_reports`
--
ALTER TABLE `explore_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_sections`
--
ALTER TABLE `footer_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `header_sections`
--
ALTER TABLE `header_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_pages`
--
ALTER TABLE `home_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `international_properties`
--
ALTER TABLE `international_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `private_properties`
--
ALTER TABLE `private_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_properties`
--
ALTER TABLE `project_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `properties_country_id_foreign` (`country_id`);

--
-- Indexes for table `property_categories`
--
ALTER TABLE `property_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rent_properties`
--
ALTER TABLE `rent_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buy_properties`
--
ALTER TABLE `buy_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `explore_reports`
--
ALTER TABLE `explore_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `footer_sections`
--
ALTER TABLE `footer_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `header_sections`
--
ALTER TABLE `header_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `home_pages`
--
ALTER TABLE `home_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `international_properties`
--
ALTER TABLE `international_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `private_properties`
--
ALTER TABLE `private_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project_properties`
--
ALTER TABLE `project_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `property_categories`
--
ALTER TABLE `property_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rent_properties`
--
ALTER TABLE `rent_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `blog_posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `blog_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `property_categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `properties_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
