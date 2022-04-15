-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 11 2022 г., 17:32
-- Версия сервера: 5.7.24
-- Версия PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii2advanced`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '2', 1648215089),
('user', '3', 1648215188);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1648214393, 1648214393),
('user', 1, NULL, NULL, NULL, 1648214393, 1648214393);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'куртки'),
(2, 'Футболки'),
(3, 'Колготки&Чулки'),
(4, 'Юбки'),
(5, 'Носки'),
(6, 'Кроссовки');

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tree` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `depth` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(50) NOT NULL,
  `text` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `tree`, `lft`, `rgt`, `depth`, `name`, `url`, `text`) VALUES
(1, 1, 2, 9, 0, 'suka', 'suka', 'sukasukasukasuka'),
(3, 1, 5, 6, 1, 'сосать', 'cocat', 'сосатьсосатьсосать'),
(4, 1, 3, 4, 1, 'сосать + глотать', 'сосать+glotat', 'пидары все нахуйwer');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1647362265),
('m130524_201442_init', 1647362267),
('m190124_110200_add_verification_token_column_to_user_table', 1647362267),
('m140506_102106_rbac_init', 1648202348),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1648202349),
('m180523_151638_rbac_updates_indexes_without_prefix', 1648202349),
('m200409_110543_rbac_update_mssql_trigger', 1648202349),
('m220405_114234_menu', 1649162291);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `price` int(4) NOT NULL,
  `foto` varchar(150) DEFAULT NULL,
  `category_id` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `text` varchar(5000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `foto`, `category_id`, `status`, `text`) VALUES
(1, 'Nxt 2 Skin Women\'s Opaque Pantyhose Stockings with High Denier Super Comfortable Full Length Big Size ( Black and Skin,N2S90006S)', 60, '1sweetpoppy_275897354_354824123223411_7187797570807154422_n.jpg', 3, 1, 'Currently unavailable. \r\nWe don\'t know when or if this item will be back in stock.\r\nSizes - l (Fits S to L size), xl (fits XL to 3XL size)\r\nFit - stretch waistband for a custom fit. Durability - strong knit and reinforced toe for durability. Comfort - soft and silky fabric makes it a very comfy product to wear\r\nAppearance - sleek knit clings to your every curve to camouflage imperfections and give you a flawless look. Modesty - knit in crotch for comfort and also no visibility issues of the personal areas\r\nUsage - wear with your favourite dresses, skirts, shorts or skorts'),
(2, 'KYODO Women\'s Thigh-Highs Long Exotic Stockings Tights black Multi color', 50, 'tatianapaulava_274804734_149071180904601_2395306964402176027_n.jpg', 3, 0, 'Care Instructions: Hand Wash Only\r\nClassy, Thinnest Stockings,Lightweight, Comfortable,Soft Fabric\r\nKindly Do Not Wash In Hot Water, Do Not Iron, Do Not Dry In Direct Sunlight\r\nPlease Note That Sheerness & Color Will Vary Depending Upon The Natural Skin Tone Of The User\r\nLightweight, Comfortable, Soft Fabric & Daily Wear'),
(3, 'Neska Moda Women\'s 1 Pair Panty Hose Long Exotic Stockings Tights', 53, 'photo_2022-04-01_18-19-12.jpg', 3, 0, 'Size name: Free Size\r\nColor Name: Black\r\nCare Instructions: Hand Wash Only\r\nCotton\r\nHand wash\r\nFree size'),
(4, 'DICY Shoes for Girls Women Casual Stylish New Model Trendy High Heel Light Weight Sneakers', 500, 'tumblr_p5wdl85kec1tcifjdo1_1280.jpg', 6, 1, 'Sole: Rubber\r\nClosure: Lace-Up\r\nHeel Height: 1.5 inches\r\nShoe Width: Medium\r\nLight Weight And Comfortable Shoes with Non Slip Sole\r\nMutipurpose shoes As Can Be Used As Sports Casual Or Party Wear Sneaker Shoes\r\nNew Design With stylish And Latest trends\r\nPhoto color May Slightly Vary Due to you screen color and Brightness\r\nCare Instruction Do not Machine Wash Only Use wet cloth to remove dust and stain'),
(5, 'Adrint Women\'s & Girls Sneakers Casual Shoes', 330, 'tumblr_p5ozq5OKLD1tcifjdo1_640.jpg', 6, 0, 'Closure: Lace-Up\r\nShoe Width: Medium\r\nBrand:-Adrint.; Product Detail: Pair Of Round-Toe, Sneakers, Has Mid-Top Styling, Lace-Up Detail Synthetic Upper.\r\nMaterial & Care: Wipe With A Clean, Dry Cloth To Remove Dust,\r\nPackaging : We Know How Important It Is To Store Prized Possessions Well. Hence, Every Pair Of Shoes Is Impeccably Packed In A Beautiful And Classy Storage Box.'),
(6, 'ZAPATOZ Women\'s Stylish Lightweight | Casual Shoes | Sneakers', 650, 'tumblr_p6kkcd9jmp1tcifjdo1_640.jpg', 6, 1, 'Sole: Polyvinyl Chloride\r\nClosure: Lace-Up\r\nShoe Width: Medium\r\nThis Is Very Light Weight And Comfortable To Wear. It Has Durable And Long Lasting Material.\r\nZapatoz Brings You The Latest Collection Of Sports Casual Shoes With Different Colors.\r\nEasiness:- You Can Wear Them All Day Long Without Any Kind Of Discomfort Or Uneasiness.\r\nLightweight:- These Walking Shoes Have Been Designed To Keep You Active By Giving You All Of The Lightweight Comfort .; Care Instructions: Wipe With A Clean Cloth Do Not Wash Detergent.\r\nAge Range Description: Adult');

-- --------------------------------------------------------

--
-- Структура таблицы `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `parent_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `test`
--

INSERT INTO `test` (`id`, `title`, `parent_id`) VALUES
(1, 'FORD', 0),
(2, 'MAZDA', 0),
(3, 'SEDAN', 1),
(4, 'hetchback', 1),
(5, 'test', 2),
(6, 'test2', 3),
(7, 'test3', 4),
(8, 'test', 5),
(9, 'test', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', 'OC6T5DMQAPdcpl0h3Xrz5wF5dpfNBFG8', '$2y$13$24NhBcxlGTKhzpNEYQC6f.CPNB6m94RnJz6/MMF01ZRbwq0o.MhBa', NULL, 'presence@gmail.com', 10, 1647362368, 1647362368, 'x2MO1HDEHtPFojdyI12SUUYlMlunaHQ4_1647362368'),
(2, 'Петр', 'ybqsXlEXZFMaqlEYEo8Ob2krQ3swXgnn', '$2y$13$aJzVf8wtvaINivgYIsXGjOgsHRepBTNNlbDVDBRITQrNlMRWe76TS', NULL, 'presence9998@gmail.com', 10, 1648215089, 1648215089, 'zPb44Hevpf-RCZ6B9AgKhEiQImuBgAEp_1648215089'),
(3, 'user', 'ragb7H16NcghxhyA0n7EongN-NzVEWyf', '$2y$13$uuBjBxGlDlPNfrgXlqIG7exdP6iH8aJ2jWeaad9TEic/gwL5/izgC', NULL, 'alina1000@gmail.com', 10, 1648215188, 1648215188, 'NoF6EQ3JNgori5l1ZFK_Zs0F5LDiqd33_1648215188');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
