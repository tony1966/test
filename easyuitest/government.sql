
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生日期: 2014 年 12 月 02 日 22:50
-- 伺服器版本: 5.1.61
-- PHP 版本: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `u911852767_test`
--

-- --------------------------------------------------------

--
-- 表的結構 `government`
--

CREATE TABLE IF NOT EXISTS `government` (
  `id` int(11) NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parentId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 轉存資料表中的資料 `government`
--

INSERT INTO `government` (`id`, `text`, `parentId`) VALUES
(1, '總統府', 0),
(11, '行政院', 1),
(111, '內政部', 11),
(112, '外交部', 11),
(113, '國防部', 11),
(12, '立法院', 1),
(121, '內政委員會', 12),
(122, '外交委員會', 12),
(123, '國防委員會', 12),
(13, '司法院', 1),
(131, '最高法院', 13),
(132, '高等法院', 13),
(133, '地方法院', 13);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
