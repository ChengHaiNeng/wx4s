-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-02-04 09:03:16
-- 服务器版本： 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wx4s`
--

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_01_11_042915_add_miles_to_users', 2),
('2017_01_11_045431_change_column_miles', 3),
('2017_01_11_133358_modify_columns_to_users', 4),
('2017_01_12_143233_yueyue_table', 5),
('2017_01_14_125955_add_yytime_to_yuyues', 6),
('2017_01_14_133802_add_date_to_yuyues', 7),
('2017_01_14_134604_add_time_to_yuyues', 8);

-- --------------------------------------------------------

--
-- 表的结构 `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `uid` int(10) UNSIGNED NOT NULL,
  `openid` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sex` tinyint(4) NOT NULL DEFAULT '0',
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `subscribe_time` int(11) NOT NULL DEFAULT '0',
  `subscribe` tinyint(1) NOT NULL DEFAULT '0',
  `age` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `cardtype` tinyint(4) NOT NULL DEFAULT '0',
  `jifen` int(11) NOT NULL DEFAULT '0',
  `miles` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `carno` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `cardno` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`uid`, `openid`, `nickname`, `name`, `sex`, `city`, `subscribe_time`, `subscribe`, `age`, `cardtype`, `jifen`, `miles`, `carno`, `mobile`, `email`, `cardno`) VALUES
(1, 'ossVEwOLtsaPnDXRsoW-M7l8Ql9w', '程', '', 1, '宝山', 1484145671, 1, '', 0, 0, '', '', '', '', ''),
(2, 'ossVEwBeK880x9a0HML36oLHft2I', '王得振', '', 1, '泰安', 1484145912, 0, '', 0, 0, '', '', '', '', ''),
(3, 'ossVEwM4XXdzBjkH7t_p4gkm7OYE', 'silent~_y', '', 2, '虹口', 1484146213, 1, '', 0, 0, '', '', '', '', ''),
(4, 'ossVEwDzV0eEOTwaXs9HUOnRyGfs', '晨-毛俊凯', '', 1, '邵阳', 1484208524, 1, '', 0, 0, '', '', '', '', ''),
(5, 'ossVEwD4BfTAH1zQDiTbzejf5oHU', '海鰮', '程海鰮', 2, '', 1484210471, 1, '21', 1, 0, '344', '皖A33444', '13370073030', '1473044566@qq.com', '34456669');

-- --------------------------------------------------------

--
-- 表的结构 `yuyues`
--

CREATE TABLE `yuyues` (
  `yid` int(10) UNSIGNED NOT NULL,
  `carno` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `miles` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `openid` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `yytime` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `yuyues`
--

INSERT INTO `yuyues` (`yid`, `carno`, `name`, `mobile`, `miles`, `openid`, `yytime`, `date`, `time`) VALUES
(1, '京  ', '京  ', '18502128081', '4555  ', 'ossVEwOLtsaPnDXRsoW-M7l8Ql9w', 1484460169, '2017-01-16', '14:11'),
(2, '京   ', '京   ', '18502128081', '4555   ', 'ossVEwOLtsaPnDXRsoW-M7l8Ql9w', 1484460687, '2017-01-17', '14:30'),
(3, '京   ', '京   ', '18502128081', '4555   ', 'ossVEwOLtsaPnDXRsoW-M7l8Ql9w', 1484460702, '2017-01-18', '14:19'),
(4, '海', '海', '18702345432', '4555    ', 'ossVEwOLtsaPnDXRsoW-M7l8Ql9w', 1484461775, '2017-01-21', '14:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `users_openid_unique` (`openid`);

--
-- Indexes for table `yuyues`
--
ALTER TABLE `yuyues`
  ADD PRIMARY KEY (`yid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `yuyues`
--
ALTER TABLE `yuyues`
  MODIFY `yid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
