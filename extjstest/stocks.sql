--
-- 表的結構 `stocks`
--

CREATE TABLE IF NOT EXISTS `stocks` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `close` float NOT NULL,
  `volumn` int(11) NOT NULL,
  `meeting` date NOT NULL,
  `election` tinyint(1) NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表中的資料 `stocks`
--

INSERT INTO `stocks` (`name`, `id`, `close`, `volumn`, `meeting`, 
`election`, `category`) VALUES
('台積電', '2330', 123, 4425119, '2014-06-04', 0, '半導體'),
('中華電', '2412', 96.4, 5249, '2014-06-15', 0, '通信'),
('中碳', '1723', 192.5, 918, '2014-07-05', 0, '塑化'),
('創見', '2451', 108, 733, '2014-06-30', 0, '模組'),
('華擎', '3515', 118.5, 175, '2014-07-20', 1, '主機板'),
('訊連', '5203', 97, 235, '2014-05-31', 0, '軟體');