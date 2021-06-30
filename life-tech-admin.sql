-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 25 2021 г., 17:24
-- Версия сервера: 10.4.17-MariaDB
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lifetech2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chiqm`
--

CREATE TABLE `chiqm` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chiqm`
--

INSERT INTO `chiqm` (`id`, `name`, `created_date`) VALUES
(1, 'Reklama', '2021-06-22 17:50:17'),
(2, 'Oziq ovqat', '2021-06-22 17:50:21'),
(3, 'Har xil narsalar', '2021-06-22 17:50:38'),
(4, 'Oylik', '2021-06-22 18:55:12');

-- --------------------------------------------------------

--
-- Структура таблицы `expense`
--

CREATE TABLE `expense` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(100) NOT NULL,
  `chiqm_id` int(11) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `day` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `expense`
--

INSERT INTO `expense` (`id`, `name`, `price`, `chiqm_id`, `description`, `day`, `created_date`) VALUES
(1, 'Bannerga', '700000', 1, '', '', '2021-06-22 18:03:06'),
(2, 'Aftobusga', '250000', 1, '', '', '2021-06-22 18:03:09'),
(3, 'Suvga', '25000', 2, '', '', '2021-06-22 18:03:42'),
(4, 'Telegram1', '450001', 1, 'ddasdfsdf', '12.06.2021', '2021-06-23 10:25:27'),
(8, 'Ismoil', '500000', 4, '', '', '2021-06-16 00:54:39'),
(9, 'Olma', '100000', 2, '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'teacher', 'Teacher User'),
(3, 'student', 'Student User');

-- --------------------------------------------------------

--
-- Структура таблицы `ishreja_guruh`
--

CREATE TABLE `ishreja_guruh` (
  `id` int(11) UNSIGNED NOT NULL,
  `ishreja_guruh` varchar(30) NOT NULL,
  `kurs_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ishreja_guruh`
--

INSERT INTO `ishreja_guruh` (`id`, `ishreja_guruh`, `kurs_id`) VALUES
(1, 'savodxonlik01', 1),
(2, 'web01', 4),
(3, 'web02', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `ishreja_guruh_mavzu`
--

CREATE TABLE `ishreja_guruh_mavzu` (
  `id` int(11) UNSIGNED NOT NULL,
  `ishreja_guruh_id` int(11) UNSIGNED NOT NULL,
  `ishreja_kategoy` int(10) UNSIGNED NOT NULL,
  `ishreja_mavzu_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ishreja_guruh_mavzu`
--

INSERT INTO `ishreja_guruh_mavzu` (`id`, `ishreja_guruh_id`, `ishreja_kategoy`, `ishreja_mavzu_id`) VALUES
(1, 1, 0, 3),
(2, 1, 0, 4),
(3, 2, 0, 1),
(4, 2, 0, 2),
(5, 2, 0, 7),
(6, 2, 0, 8),
(7, 2, 0, 5),
(8, 2, 0, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `ishreja_kategory`
--

CREATE TABLE `ishreja_kategory` (
  `id` int(10) UNSIGNED NOT NULL,
  `kategorya` varchar(150) NOT NULL,
  `ishreja_kurs_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ishreja_kategory`
--

INSERT INTO `ishreja_kategory` (`id`, `kategorya`, `ishreja_kurs_id`) VALUES
(1, 'Frontend', 4),
(2, 'Backend', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `ishreja_mavzu`
--

CREATE TABLE `ishreja_mavzu` (
  `id` int(10) UNSIGNED NOT NULL,
  `mavzu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ishreja_mavzu`
--

INSERT INTO `ishreja_mavzu` (`id`, `mavzu`) VALUES
(1, 'html'),
(2, 'css'),
(3, 'word'),
(4, 'excel'),
(5, 'javascript'),
(6, 'jquery'),
(7, 'less'),
(8, 'sass'),
(9, 'jquery'),
(10, 'bootstrap');

-- --------------------------------------------------------

--
-- Структура таблицы `journal`
--

CREATE TABLE `journal` (
  `id` int(11) UNSIGNED NOT NULL,
  `oquv_group_id` int(11) UNSIGNED NOT NULL,
  `teacher_id` int(11) UNSIGNED NOT NULL,
  `kun` date NOT NULL COMMENT 'o''qituvchi davomat qilgan kun',
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `journal`
--

INSERT INTO `journal` (`id`, `oquv_group_id`, `teacher_id`, `kun`, `create_date`) VALUES
(5, 15, 113, '2020-08-11', '2020-09-17 23:27:05'),
(6, 15, 113, '2020-08-13', '2020-09-17 23:27:05'),
(7, 15, 113, '2020-08-15', '2020-09-17 23:27:07'),
(8, 15, 113, '2020-08-17', '2020-09-17 23:27:07'),
(9, 15, 113, '2020-08-19', '2020-09-17 23:28:01'),
(10, 15, 113, '2020-08-21', '2020-09-17 23:28:01'),
(11, 15, 113, '2020-08-23', '2020-09-17 23:28:06'),
(12, 15, 113, '2020-08-25', '2020-09-17 23:28:06'),
(13, 15, 113, '2020-08-27', '2020-09-17 23:28:12'),
(14, 15, 113, '2020-08-29', '2020-09-17 23:28:12'),
(15, 15, 113, '2020-08-01', '2020-09-17 23:28:17'),
(16, 15, 113, '2020-08-03', '2020-09-17 23:28:17'),
(17, 25, 113, '2020-09-17', '2020-09-17 23:32:05'),
(18, 25, 113, '2020-09-15', '2020-09-17 23:32:52'),
(19, 25, 113, '2020-09-12', '2020-09-17 23:33:50'),
(26, 8, 145, '2020-09-16', '2020-09-17 23:36:38'),
(27, 8, 145, '2020-09-14', '2020-09-17 23:36:43'),
(28, 8, 145, '2020-09-11', '2020-09-17 23:36:49'),
(29, 8, 145, '2020-09-09', '2020-09-17 23:36:55'),
(30, 8, 145, '2020-09-07', '2020-09-17 23:37:01'),
(53, 25, 113, '2021-06-10', '2021-06-10 19:55:31'),
(54, 8, 113, '2021-06-11', '2021-06-11 09:51:56'),
(55, 33, 113, '2021-06-11', '2021-06-11 09:52:00'),
(56, 25, 113, '2021-06-22', '2021-06-22 16:27:07'),
(57, 33, 113, '2021-06-22', '2021-06-22 16:27:15'),
(58, 35, 113, '2021-06-22', '2021-06-22 16:27:19');

-- --------------------------------------------------------

--
-- Структура таблицы `journal_details`
--

CREATE TABLE `journal_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `journal_id` int(11) UNSIGNED NOT NULL,
  `student_id` int(11) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL COMMENT 'o''quvchi bor yo''qligi: 0-yoq, 1-bor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `journal_details`
--

INSERT INTO `journal_details` (`id`, `journal_id`, `student_id`, `status`) VALUES
(95, 53, 247, 0),
(96, 53, 248, 0),
(97, 54, 225, 0),
(98, 54, 226, 0),
(99, 54, 227, 0),
(100, 55, 224, 0),
(101, 56, 247, 0),
(102, 56, 248, 0),
(103, 57, 224, 0),
(104, 58, 207, 0),
(105, 58, 230, 0),
(106, 58, 231, 0),
(107, 58, 232, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `kurslar`
--

CREATE TABLE `kurslar` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `kurslar`
--

INSERT INTO `kurslar` (`id`, `nomi`) VALUES
(18, 'Java (Android)'),
(2, 'Kompyuter grafikasi'),
(1, 'Kompyuter savodxonligi'),
(19, 'Robotexnika'),
(4, 'Web dasturlash');

-- --------------------------------------------------------

--
-- Структура таблицы `lessons`
--

CREATE TABLE `lessons` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL COMMENT 'studentlar id tushadi users jadvalidan',
  `oquv_group_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lessons`
--

INSERT INTO `lessons` (`id`, `student_id`, `oquv_group_id`) VALUES
(356, 141, 44),
(252, 207, 35),
(357, 207, 44),
(358, 208, 44),
(417, 210, 43),
(359, 210, 44),
(360, 211, 44),
(361, 212, 44),
(362, 213, 44),
(363, 215, 44),
(364, 216, 44),
(365, 217, 44),
(366, 218, 44),
(367, 220, 44),
(368, 221, 44),
(247, 224, 33),
(248, 225, 8),
(249, 226, 8),
(250, 227, 8),
(251, 228, 38),
(253, 230, 35),
(254, 231, 35),
(255, 232, 35),
(256, 233, 39),
(405, 233, 41),
(257, 234, 39),
(258, 235, 39),
(406, 235, 41),
(259, 236, 40),
(407, 237, 41),
(408, 238, 41),
(267, 244, 42),
(409, 247, 25),
(410, 248, 25);

-- --------------------------------------------------------

--
-- Структура таблицы `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `oquv_group`
--

CREATE TABLE `oquv_group` (
  `id` int(11) UNSIGNED NOT NULL,
  `guruh_nomi` varchar(255) NOT NULL,
  `kurs_id` int(11) UNSIGNED NOT NULL,
  `teacher_id` int(11) UNSIGNED NOT NULL COMMENT 'oqtuvchi id tushadi users jadvalidan',
  `status` int(2) NOT NULL COMMENT '1- yangi ochilgan 2-oqiyotgan 3-tugatilgan',
  `duy` int(11) NOT NULL DEFAULT 0 COMMENT '1-bor, 0-yoq',
  `sey` int(11) NOT NULL DEFAULT 0 COMMENT '1-bor, 0- yoq',
  `chor` int(11) NOT NULL DEFAULT 0 COMMENT '1-bor, 0-yoq',
  `pay` int(11) NOT NULL DEFAULT 0 COMMENT '1-bor, 0-yoq',
  `juma` int(11) NOT NULL DEFAULT 0 COMMENT '1-bor, 0-yoq',
  `shan` int(11) NOT NULL DEFAULT 0 COMMENT '1-bor, 0-yoq',
  `yak` int(11) NOT NULL DEFAULT 0 COMMENT '1-bor, 0-yoq',
  `soat` time NOT NULL,
  `turi` int(2) NOT NULL DEFAULT 0 COMMENT '0-oddiy gruh 1- indvidual',
  `term` int(11) NOT NULL COMMENT '1-oy, 2-oy, 3-oy, 4-oy, 5-oy',
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `oquv_group`
--

INSERT INTO `oquv_group` (`id`, `guruh_nomi`, `kurs_id`, `teacher_id`, `status`, `duy`, `sey`, `chor`, `pay`, `juma`, `shan`, `yak`, `soat`, `turi`, `term`, `create_date`) VALUES
(8, 'Web Frontend', 4, 113, 3, 1, 0, 1, 0, 1, 0, 0, '14:00:00', 0, 7, '2020-05-05 10:20:00'),
(15, 'savodhonlik1', 1, 146, 3, 1, 0, 1, 0, 1, 0, 0, '15:30:00', 1, 2, '2020-05-26 18:40:39'),
(23, 'web12', 4, 145, 3, 0, 1, 0, 1, 0, 1, 0, '10:30:00', 0, 5, '2020-07-08 13:52:16'),
(24, 'Grafika1', 2, 113, 3, 1, 0, 1, 0, 1, 0, 0, '09:00:00', 0, 5, '2020-07-08 13:53:55'),
(25, 'Savodxonlik', 1, 113, 2, 0, 1, 0, 1, 0, 1, 0, '09:00:00', 0, 3, '2020-07-08 13:57:59'),
(31, 'sav1', 1, 146, 3, 1, 0, 1, 0, 1, 0, 0, '14:00:00', 0, 2, '2020-07-10 16:03:21'),
(33, 'Savodxonlik', 1, 113, 2, 1, 1, 1, 1, 1, 1, 0, '12:00:00', 1, 1, '2020-07-18 08:04:25'),
(35, 'Web Frontend', 4, 113, 2, 0, 1, 0, 1, 0, 1, 0, '10:30:00', 0, 5, '2020-09-18 22:32:33'),
(38, 'Savodxonlik', 1, 113, 1, 0, 1, 0, 1, 0, 1, 0, '07:30:00', 1, 1, '2020-10-22 07:44:45'),
(39, 'Web Frontend', 4, 113, 1, 1, 0, 1, 0, 1, 0, 0, '15:30:00', 0, 5, '2020-10-22 08:04:03'),
(40, 'Savodxonlik', 1, 113, 1, 1, 0, 1, 0, 1, 0, 0, '09:00:00', 1, 1, '2020-10-22 08:08:58'),
(41, 'Web Frontend', 4, 113, 1, 1, 0, 1, 0, 1, 0, 0, '10:30:00', 0, 7, '2020-10-22 08:22:03'),
(42, 'Savodxonlik', 1, 113, 1, 1, 0, 1, 0, 1, 0, 0, '20:00:00', 1, 1, '2020-10-22 08:36:17'),
(43, 'java', 18, 145, 2, 1, 0, 1, 0, 1, 0, 0, '10:30:00', 0, 6, '2021-06-07 11:43:01'),
(44, 'corel', 2, 113, 1, 0, 1, 0, 1, 0, 1, 0, '12:00:00', 0, 2, '2021-06-07 14:55:54');

-- --------------------------------------------------------

--
-- Структура таблицы `tolov`
--

CREATE TABLE `tolov` (
  `id` int(11) NOT NULL,
  `sum` int(10) NOT NULL,
  `oyga` int(2) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tolov`
--

INSERT INTO `tolov` (`id`, `sum`, `oyga`, `date`, `user_id`) VALUES
(1, 213, 0, '0000-00-00 00:00:00', 0),
(2, 123, 0, '0000-00-00 00:00:00', 0),
(3, 54654, 7, '0000-00-00 00:00:00', 0),
(4, 213231231, 1, '0000-00-00 00:00:00', 0),
(5, 213231231, 1, '0000-00-00 00:00:00', 0),
(6, 213231231, 1, '2021-06-14 16:37:32', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `familiya` varchar(50) DEFAULT NULL,
  `ism` varchar(50) DEFAULT NULL,
  `tug_yil` date DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `manzil` varchar(255) NOT NULL,
  `photo_file` varchar(255) NOT NULL,
  `pasport_file` varchar(255) NOT NULL,
  `rasm` varchar(255) NOT NULL,
  `malumoti` int(2) NOT NULL COMMENT '1-o''rta  2-oliy',
  `millati` varchar(50) NOT NULL,
  `jins` int(2) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1- yangi kelgan o''quvchilar, 2-oqiyotgan o''quvchilar, 3-bitirgan o''quvchilar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `familiya`, `ism`, `tug_yil`, `company`, `telefon`, `manzil`, `photo_file`, `pasport_file`, `rasm`, `malumoti`, `millati`, `jins`, `status`) VALUES
(1, '127.0.0.1', 'admin', '$2y$12$gsYvXFoBvR9eao8zHtOiDO5H5VG0App7OBveN5M.fDNOwJY6OZZ4q', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1624620923, 1, 'Admin', 'istrator', '1992-04-22', 'ADMIN', '+998972087090', '', '', '', '', 0, '', 1, 0),
(113, '::1', 'oybek', '$2y$10$5T191ipabXBetVva6rDyNe3rzayL5xrAHtP0PSWC0BbQnZFlhd0Ae', 'oybek92@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1573298521, 1624361194, 1, 'Soataliyev', 'Oybekjon', '1992-01-02', 'Lifetech', '+998975485612', 'Dangara tumani', '1588836898.jpg', '1593850608.jpg', '', 2, 'ozbek', 1, 2),
(141, '127.0.0.1', 'oq0141', '$2y$10$YCIpWJdWjqWcIyuCiAhUOeeu7bCEOEM1CK6qtjC2T2tyzgBQTBKYe', 'alisher19995@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1582029164, 1594798061, 1, 'Abdunazirov', 'Alisher', '1995-11-23', '', '+998912005696', 'dangara tumani', '', '', '', 0, '', 1, 0),
(145, '127.0.0.1', 'ismoil', '$2y$10$P8z9Jgfq56wIiebrQEGIYOBDqE1Ecw75uoI9uFVSc6.vTpi2bhAJW', 'orinboy1996@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1583557866, 1602169735, 1, 'ALIYEV', 'O\'rinboy', '1996-04-22', '', '+998972087090', 'Bog\'dod tumani', '15888372571.jpg', '1588837257.jpg', '', 2, 'o\'zbek', 1, 2),
(146, '127.0.0.1', 'zokirjon', '$2y$10$e5O.hefkBA0v11HlnpDA0eTCPjNWz4Kx1EggaWKIIYNewbJeAxW2.', 'zokirjon96@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1588687947, 1595681354, 1, 'Isaqov', 'Zokirjon', '1996-05-11', '', '+998903065610', 'A.Navoiy', '1588837373.jpg', '1588687947.jpg', '', 2, 'o\'zbek', 1, 2),
(175, '127.0.0.1', 'oq0175', '$2y$10$bcY4QJKB2b.QQLspGWAoaOM/XPvzy8eEFwzPPnU1DWptsp..j257K', 'javo12@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1594379165, NULL, 1, 'Umarov', 'Asror', '1996-11-30', 'maktab', '+998972051707', 'A.Navoiy', '', '1594379164.jpg', '', 0, '', 1, 0),
(207, '213.230.68.119', 'oq0192', '$2y$10$.0cTxUEVokKdu/kdpKf.Eeq/eXw28Xi8AZptgQP/SAf43f6sTava2', 'oq0192@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603347561, NULL, 1, 'G\'ofurjonov', 'Sardorbek', '2006-08-16', '41-maktab', '+998905062715', 'Vogzalni 57', '', '', '', 0, '', 1, 1),
(208, '213.230.68.119', 'oq0208', '$2y$10$/dQvthRrYbB7IAgmaMZ2H.ehTIjAwc1J0c82kIDZIitWCrSdL5oRi', 'oq0208@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603347666, NULL, 1, 'Mamurov', 'Ayubxon', '2006-09-04', '41-maktab', '+998905866379', 'oq yo\'l 9', '', '', '', 0, '', 1, 1),
(210, '213.230.68.119', 'oq0209', '$2y$10$a4HNNMWwr/JMEqYJd707f.t/15PKwqOpQ4Z1UeUowI49GDSh6MOlq', 'oq0209@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603347771, NULL, 1, 'Po\'latova', 'Zuhraxon', '2005-02-27', '5-maktab', '+998996907457', 'Mullaboshmon 37', '', '', '', 0, '', 2, 1),
(211, '213.230.68.119', 'oq0211', '$2y$10$9bIcFJPK5pHC1cQvf9eEm.Hr5hwGyeOwBIWYplRQqzRDXjC8CiMsG', 'oq0211@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603347861, NULL, 1, 'Isaqova', 'Odinaxon', '2008-09-12', '4-maktab', '+998905701184', 'Yuzlar 27', '', '', '', 0, '', 2, 2),
(212, '213.230.68.119', 'oq0212', '$2y$10$xb1bj6c5aFBfmyrzwGLJGe/t/f8f4fL3LWUOd2ksF04dInFb5nGXO', 'oq0212@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603347907, NULL, 1, 'Isaqov', 'Zafar', '2009-09-23', '32-maktab', '+998905701184', 'Yuzlar 27', '', '', '', 0, '', 1, 2),
(213, '213.230.68.119', 'oq0213', '$2y$10$1lSzOj255vx2WMKY9QQ6TuO7FmbANY3JIU0RqObzV4v7J8DKVdV/u', 'oq0213@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603347909, NULL, 1, 'Isaqov', 'Zafar', '2009-09-23', '32-maktab', '+998905701184', 'Yuzlar 27', '', '', '', 0, '', 1, 2),
(214, '213.230.68.119', 'oq0214', '$2y$10$YKHilQGUvVIE/366KTW5Peg6pDZKQuvnobZbrbq7HAnOZYG2u69py', 'oq0214@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603347992, NULL, 1, 'Aliyev', 'Abdulbosit', '2010-01-09', '5-makta', '+998905703090', 'A.Navoiy 119', '', '', '', 0, '', 1, 2),
(215, '213.230.68.119', 'oq0215', '$2y$10$ohabRIInHWmGQBx6IpKPkezy6YIRwN3K.EqSzuT.5d0jha4GfutbS', 'oq0215@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603348497, NULL, 1, 'Saidxonov', 'Mirzohid', '2020-10-22', '32-maktab', '+998912005521', 'Farobiy 9/6', '', '', '', 1, '', 1, 2),
(216, '213.230.68.119', 'oq0216', '$2y$10$mrsUdIMhc.Ww02CjmtbaUuxpcYlfaKvD/zOacFNBiHsotoPYsarqq', 'oq0216@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603348621, NULL, 1, 'Valiyeva', 'Xosiyatxon', '2008-09-12', '4-maktab', '+998911424422', 'Mullaboshmon 37', '', '', '', 0, '', 2, 2),
(217, '213.230.68.119', 'oq0217', '$2y$10$nu12jS1xr5gkbRpIoY1B4OntxZ3GnrWBF99Vsxyt.EmK8LzajpIMe', 'oq0217@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603348705, NULL, 1, 'Rasulov', 'Abdulloh', '2003-08-12', '', '+998999957795', '', '', '', '', 0, '', 1, 1),
(218, '213.230.68.119', 'oq0218', '$2y$10$5..Bx.O.ppTssEb6ysFvsO5JwK10ejUJVX9U1MPJgUz8QHN3CVocK', 'oq0218@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603348779, NULL, 1, 'Abdullayev', 'Nurmuhammad', '2020-10-22', '', '+998999973552', '', '', '', '', 0, '', 1, 2),
(219, '213.230.68.119', 'oq0219', '$2y$10$ZmJh8v3aXjTJWJoEey2KJuFalT5TxWLQTlYjMWC9cWL851V8kZP/C', 'oq0219@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603349247, NULL, 1, 'Abdullayev', 'Ayubxon', '2009-10-08', '23-maktab', '+998901519572', 'Shig\'ovul 26', '', '', '', 0, '', 1, 2),
(220, '213.230.68.119', 'oq0220', '$2y$10$4Dx2HIkTjtb0c08s1qTCYetu7YsLD/gJtkRTCX2Giidb3RRJ3CJH.', 'oq0220@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603349341, NULL, 1, 'Tursunov', 'Husanboy', '2020-10-22', '', '+998911440272', 'Buvayda Tumani Alimergan', '', '', '', 0, '', 1, 2),
(221, '213.230.68.119', 'oq0221', '$2y$10$p5KyiH415IkCqHybsCoFfOLRl8joNLMkmpHYuiIdT39yxeF4vQLa.', 'oq0221@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603349573, NULL, 1, 'Usmonov', 'Muhammad Yusuf', '2020-10-22', 'dizayner', '+998905674859', 'Obod yurt 22', '', '', '', 0, '', 1, 2),
(222, '213.230.68.119', 'oq0222', '$2y$10$qteTfL3SQixsYmYnFB5jxuePn1znNX39GUifcfRceLXHKK4WXAjzu', 'oq0222@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603349819, NULL, 1, 'Mo\'ydinova', 'Xanifaxon', '1991-10-07', '', '+998933702770', 'Dang\'araTiman Barkamol', '', '', '', 0, '', 2, 2),
(223, '213.230.68.119', 'oq0223', '$2y$10$R4UrqqeJiAsv1URSdYlKv.3GejePtTZUI3CE7gElUTTJ.TNnaH3D6', 'oq0223@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603349901, NULL, 1, 'Umarov', 'Nurmuhammad', '2020-10-22', '', '+998912012725', '', '', '', '', 0, '', 1, 2),
(224, '213.230.68.119', 'oq0224', '$2y$10$Akm3wppu5UMBFXYZJJBSkewtXoDqNrpylZr2CcCLrN8H7/VNxSMNW', 'oq0224@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603350552, NULL, 1, 'Toshmatova', 'Ziroatxon', '1980-04-21', '', '+998911507563', '', '', '', '', 0, '', 2, 2),
(225, '213.230.68.119', 'oq0225', '$2y$10$4q7MnfPiOHiMCXfUdp.10uUI5/up4ODigVjVQcCVwk9DHWhS9QlgS', 'oq0225@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603350770, NULL, 1, 'Solijonov', 'Laziz', '2003-05-06', '', '+998901553925', 'Avg\'onbog\'', '', '', '', 0, '', 1, 1),
(226, '213.230.68.119', 'oq0226', '$2y$10$cDPH8frjW/8DDOKt/K8dCuzrKosRr5fb25jGEovA1gQvfWxiqnxD.', 'oq0226@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603350862, NULL, 1, 'Yusupov', 'Azizbek', '1994-07-05', 'Geofizika', '+998906283292', 'O\'zbekiston tumani', '', '', '', 0, '', 1, 3),
(227, '213.230.68.119', 'oq0227', '$2y$10$5xoIAIe.hWw2eQ.sG2eqPeJt3913Pr5.JGrbpHlmf6GOWWtSR5ZpO', 'oq0227@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603351039, NULL, 1, 'Sodiqov', 'Abdulbosit', '2001-12-06', '', '+9989763004543', 'AzizTepa', '', '', '', 0, '', 1, 3),
(228, '213.230.68.119', 'oq0228', '$2y$10$OyabdEw5w4H/vV9.DTpF0O3YJoB7kQ9h61.Rign3nVcw5kzxK8FTy', 'oq0228@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603352626, NULL, 1, 'Muhammaddiyorova', 'Muslimaxon', '1999-10-22', 'Jahon tillari', '+998911393770', 'Furqat tumani shodiyorbek shaxarchasi', '', '', '', 0, '', 2, 2),
(230, '213.230.68.119', 'oq0230', '$2y$10$pr85v4McHaW.JT6rGOrr9.mG1dT8mrwo7sXJU5IfLfPIlHJ6sSgrK', 'oq0230@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603352998, NULL, 1, 'Adashaliyev', 'Axadjon', '2005-04-25', '28-maktab', '+998990067134', 'Uchko\'prik tumani Qatag\'on qishlog\'i', '', '', '', 0, '', 1, 2),
(231, '213.230.68.119', 'oq0231', '$2y$10$TLiggGwr2j76o4hzg5QImOary4GSnruyxv0lTpoAoC0eo4h/6cu9a', 'oq0231@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603353129, NULL, 1, 'Tursunov', 'Abdulhaq', '1998-10-22', 'Farg\'ona Politex', '+998993933028', 'Garadok Kotej', '', '', '', 0, '', 1, 2),
(232, '213.230.68.119', 'oq0232', '$2y$10$PDd82z28mekIj.UDIRGy7.wohyvXjBC.cEPHt8z2I7LG2gsZ7urNu', 'oq0232@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603353210, NULL, 1, 'A\'zamov', 'Abdulloh', '2020-10-22', '4-maktab', '+998905569106', 'Zafar 9', '', '', '', 0, '', 1, 2),
(233, '213.230.68.119', 'oq0233', '$2y$10$GYqXKZp3bCV/Rkv5gCQm1O5iqxtleWlUPr67ipnEd7MEhCjGPTrHy', 'oq0233@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603353445, NULL, 1, 'Otajonov', 'Yaxyobek', '2004-09-30', 'Iqtidor Intlekt Ziyo', '+998912054076', 'Mehnatobod 1', '', '', '', 0, '', 1, 1),
(234, '213.230.68.119', 'oq0234', '$2y$10$AYa8iXMoLIf6/nq5EfMSROuMrefu6eVNH1cdCPak7p4MRklWskxY6', 'oq0234@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603353558, NULL, 1, 'Ahmadjonov', 'Akbarjon', '2002-07-15', '', '+998905098313', 'Mahmud Farobi 30', '', '', '', 0, '', 1, 1),
(235, '213.230.68.119', 'oq0235', '$2y$10$Ue9A7d9mc54RexqmCIoXiu2Nk/1koxLIBi6B.z/a7fUX2oOF.Umfi', 'oq0235@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603353633, NULL, 1, 'Nosimxo\'jayev', 'Yusufxon', '2022-09-20', '', '+998905062004', 'Do\'stlik 49', '', '', '', 0, '', 1, 1),
(236, '213.230.68.119', 'oq0236', '$2y$10$tFx6r0AtDJEDcS6v5Sa3tOfHGSeTMgF7W8UsqcbOetj6SgTcqXKby', 'oq0236@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603354002, NULL, 1, 'Sotimov', 'Sharofiddin', '1992-10-22', '', '+998903030990', 'Uchko\'prik', '', '', '', 0, '', 1, 2),
(237, '213.230.68.119', 'oq0237', '$2y$10$SlnSyMvBJi5Thgm/CAZj8.lNiBCwtwpql24hmz8D3KyTht1SYI9YG', 'oq0237@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603354633, NULL, 1, 'Yo\'ldashev', 'Anasxon', '2020-10-22', '5-maktab', '+998904007707', 'poyakilik 11', '', '', '', 0, '', 1, 1),
(238, '213.230.68.119', 'oq0238', '$2y$10$05G23zEN2UrXlw0yInjTGOrpPMY1TWdWqIXyb1H4NogxUa4/z5bwO', 'oq0238@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603354781, NULL, 1, 'Mamurov', 'Ahmadxon', '2020-10-22', '', '+998900554710', '', '', '', '', 0, '', 1, 1),
(239, '213.230.68.119', 'oq0239', '$2y$10$zldhTcE1okPpO9iHIsrcEe/7SZRWUhb0s1g2aMwLKkYpg1QcP.hnC', 'oq0239@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603355052, NULL, 1, 'Muhammadaliyev', 'Ibroxim', '1998-10-22', '', '+99890113861', 'Bog\'dod tumani', '', '', '', 0, '', 1, 2),
(240, '213.230.68.119', 'oq0240', '$2y$10$ov/GGkEfFUE31YYhK84pweJyRBk9/zPst893iXworAXXY8MZZTmBi', 'oq0240@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603355126, NULL, 1, 'Muqimov', 'Otabek', '1999-10-22', 'TAYU', '+998906274859', 'Rishton tumani', '', '', '', 0, '', 1, 2),
(241, '213.230.68.119', 'oq0241', '$2y$10$1h9GUduMc2aB3IR3StQ6HO3PsfzRN22JqyWQoYxv2FuvQFI3LQvk2', 'oq0241@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603355196, NULL, 1, 'Toyirjonov', 'Shokirjon', '1996-10-22', '', '+998903071034', 'Qoratepa', '', '', '', 0, '', 1, 2),
(242, '213.230.68.119', 'oq0242', '$2y$10$zC2sdvlaa6.4uufdoWOn0ustmO4MsnN1nOb6UtLg5YTrE3w7i9pLO', 'oq0242@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603355327, NULL, 1, 'Rasulov', 'Muhammad ali', '1970-01-01', '', '+998916865735', 'Furqat tumani Kalolish 34', '', '', '', 0, '', 1, 1),
(243, '213.230.68.119', 'oq0243', '$2y$10$6pcBacZMbqYU7R3R5T3KjejYnt7maMxDuo0tzOaLXpPI8x7N0fAdS', 'oq0243@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603355409, NULL, 1, 'Xamzayev', 'Rahmatullo', '2020-10-22', '4-maktab', '+998975550717', 'Sarboz 23', '', '', '', 0, '', 1, 1),
(244, '213.230.68.119', 'oq0244', '$2y$10$IXdySX08USkqAsYZt8JLmuQuV4Qrc6rsvIump/.wIJx/NdqHgGeka', 'oq0244@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603355733, NULL, 1, 'Yoqubov', 'Nurilloh', '1998-10-22', '', '+998903616060', 'Eski-shildir', '', '', '', 0, '', 1, 2),
(245, '213.230.68.119', 'oq0245', '$2y$10$cDTfOsTDlK//lFnkBx9TgOglBZkmN10jv6C5s2Z2FXYXbcZ1B1mHq', 'oq0245@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603358784, NULL, 1, 'Oripova', 'Madina', '1970-01-01', 'O\'z DJTU', '+998908583008', 'A.Navoiy 25/4', '', '', '', 0, '', 2, 1),
(246, '213.230.68.119', 'oq0246', '$2y$10$ETje6.YCdhz1T5zx4A0LZObyKe/WdsUkg2scyvFJqGmHo92VffgxK', 'oq0246@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603358871, NULL, 1, 'Maraimova', 'Mushtariy', '2020-10-22', 'TDIU', '+998911565977', 'AuTaibXo\'qandiy 65/39', '', '', '', 0, '', 2, 1),
(247, '213.230.68.119', 'oq0247', '$2y$10$xkkTk5Pyh1SYy0HYoh9aweluJqmOYltxFZnb2FrhA/cYX4OgFIYeK', 'oq0247@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603359033, NULL, 1, 'Muhammadjonov', 'Muhibbul', '2020-10-22', '13-maktab', '+998901511161', 'Turkiston 154/30', '', '', '', 0, '', 1, 1),
(248, '213.230.68.119', 'oq0248', '$2y$10$.R.pJ.e0c0gNnLKON2cHr.CmVKq7EfWQxMn9K0IoMDy/bCm8MhqJa', 'oq0248@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603359131, NULL, 1, 'Abdumutalipov', 'Ibrohimjon', '2020-10-22', '33-maktab', '+998905087072', 'Navoiy 111/12', '', '', '', 0, '', 1, 1),
(249, '213.230.68.119', 'oq0249', '$2y$10$Xznp4BDbX.emnTmgra4tZ.LZ8JM4xChwfu2jNoozXi4legr6D0dTS', 'oq0249@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603359217, NULL, 1, 'Raxmonova', 'Shaxzoda', '1995-10-22', '', '+998911509841', 'O\'zbekiston tumani', '', '', '', 0, '', 2, 1),
(251, '127.0.0.1', 'oq0251', '$2y$10$J3ZpNEyJ8b0/y8wNjkbEauiqBaoGsKNB0.5eMKGem7G1HF5vHvrXy', 'oq0251@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1623057258, NULL, 1, 'Xasanov', 'Sardorbek', '2021-06-01', 'nul', '+998888888888', 'furqat', '', '', '', 0, '', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(91, 113, 2),
(106, 141, 3),
(110, 145, 2),
(111, 146, 2),
(131, 175, 3),
(163, 207, 3),
(164, 208, 3),
(166, 210, 3),
(167, 211, 3),
(168, 212, 3),
(169, 213, 3),
(170, 214, 3),
(171, 215, 3),
(172, 216, 3),
(173, 217, 3),
(174, 218, 3),
(175, 219, 3),
(176, 220, 3),
(177, 221, 3),
(178, 222, 3),
(179, 223, 3),
(180, 224, 3),
(181, 225, 3),
(182, 226, 3),
(183, 227, 3),
(184, 228, 3),
(186, 230, 3),
(187, 231, 3),
(188, 232, 3),
(189, 233, 3),
(190, 234, 3),
(191, 235, 3),
(192, 236, 3),
(193, 237, 3),
(194, 238, 3),
(195, 239, 3),
(196, 240, 3),
(197, 241, 3),
(198, 242, 3),
(199, 243, 3),
(200, 244, 3),
(201, 245, 3),
(202, 246, 3),
(203, 247, 3),
(204, 248, 3),
(205, 249, 3),
(207, 251, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `user_kurs`
--

CREATE TABLE `user_kurs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `kurs_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_kurs`
--

INSERT INTO `user_kurs` (`id`, `user_id`, `kurs_id`) VALUES
(274, 113, 1),
(275, 113, 2),
(276, 113, 4),
(332, 146, 1),
(360, 214, 1),
(361, 215, 1),
(365, 220, 1),
(367, 221, 1),
(369, 222, 1),
(371, 223, 1),
(375, 224, 1),
(381, 226, 4),
(383, 227, 4),
(388, 230, 4),
(389, 228, 1),
(391, 231, 4),
(393, 232, 4),
(396, 233, 4),
(399, 234, 4),
(404, 235, 4),
(406, 236, 1),
(408, 237, 4),
(411, 238, 4),
(424, 244, 1),
(425, 245, 1),
(427, 246, 1),
(428, 247, 1),
(429, 248, 1),
(430, 249, 1),
(431, 145, 1),
(432, 145, 18),
(434, 251, 19),
(436, 217, 1),
(437, 207, 1),
(438, 207, 4),
(439, 208, 1),
(440, 210, 1),
(441, 210, 18),
(442, 219, 1),
(443, 211, 1),
(444, 211, 4),
(445, 212, 1),
(446, 212, 18),
(447, 213, 1),
(448, 213, 19),
(449, 218, 1),
(450, 218, 19),
(451, 225, 1),
(452, 225, 4),
(453, 216, 1),
(454, 216, 19);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chiqm`
--
ALTER TABLE `chiqm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ishreja_guruh`
--
ALTER TABLE `ishreja_guruh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `kurs_id` (`kurs_id`);

--
-- Индексы таблицы `ishreja_guruh_mavzu`
--
ALTER TABLE `ishreja_guruh_mavzu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ishreja_guruh_id` (`ishreja_guruh_id`),
  ADD KEY `ishreja_mavzu_id` (`ishreja_mavzu_id`),
  ADD KEY `id` (`id`),
  ADD KEY `ishreja_kategoy` (`ishreja_kategoy`);

--
-- Индексы таблицы `ishreja_kategory`
--
ALTER TABLE `ishreja_kategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `ishreja_kurs_id` (`ishreja_kurs_id`);

--
-- Индексы таблицы `ishreja_mavzu`
--
ALTER TABLE `ishreja_mavzu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`oquv_group_id`,`teacher_id`),
  ADD KEY `journal_ibfk_1` (`oquv_group_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Индексы таблицы `journal_details`
--
ALTER TABLE `journal_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guruh_id` (`journal_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Индексы таблицы `kurslar`
--
ALTER TABLE `kurslar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nomi` (`nomi`),
  ADD KEY `id` (`id`),
  ADD KEY `nomi_2` (`nomi`);

--
-- Индексы таблицы `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`,`oquv_group_id`),
  ADD KEY `oquv_group_id` (`oquv_group_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
