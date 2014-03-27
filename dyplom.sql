-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2014 at 12:14 PM
-- Server version: 5.5.35
-- PHP Version: 5.3.10-1ubuntu3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dyplom`
--

-- --------------------------------------------------------

--
-- Table structure for table `dp_language`
--

CREATE TABLE IF NOT EXISTS `dp_language` (
  `language_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `code` varchar(5) NOT NULL,
  `locale` varchar(255) NOT NULL,
  `image` varchar(64) NOT NULL,
  `directory` varchar(32) NOT NULL,
  `filename` varchar(64) NOT NULL,
  `sort_order` int(3) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (`language_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `dp_language`
--

INSERT INTO `dp_language` (`language_id`, `name`, `code`, `locale`, `image`, `directory`, `filename`, `sort_order`, `status`) VALUES
(2, 'Українська', 'ua', 'ua_UA.UTF-8,ua_UA,ua-gb,ukrainian', 'ua.png', 'ukrainian', 'ukrainian', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `dp_setting`
--

CREATE TABLE IF NOT EXISTS `dp_setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(32) NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` text NOT NULL,
  `serialized` tinyint(1) NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=137 ;

--
-- Dumping data for table `dp_setting`
--

INSERT INTO `dp_setting` (`setting_id`, `group`, `key`, `value`, `serialized`) VALUES
(17, 'config', 'config_error_filename', 'error.txt', 0),
(18, 'config', 'config_error_log', '1', 0),
(19, 'config', 'config_error_display', '1', 0),
(20, 'config', 'config_compression', '0', 0),
(133, 'config', 'config_encryption', '61c331f9460c32e8da479d3e633b8c53', 0),
(22, 'config', 'config_maintenance', '0', 0),
(26, 'config', 'config_seo_url', '0', 0),
(72, 'config', 'config_icon', 'data/cart.png', 0),
(73, 'config', 'config_logo', 'data/logo.png', 0),
(75, 'config', 'config_upload_allowed', 'jpg, JPG, jpeg, gif, png, txt', 0),
(135, 'config', 'connection', 'NONSSL', 0),
(110, 'config', 'config_name', 'YouWatch!', 0),
(131, 'config', 'config_email', 'oaskilbi@ukr.net', 0),
(116, 'config', 'config_title', 'YouWatch!', 0),
(117, 'config', 'config_meta_description', 'Youtube watcher.', 0),
(118, 'config', 'config_template', 'diplom', 0),
(122, 'config', 'config_language', 'ua', 0),
(132, 'config', 'config_url', 'http://diplom.hm/', 0),
(136, 'config', 'config_video_limit', '25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dp_user`
--

CREATE TABLE IF NOT EXISTS `dp_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(96) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dp_user`
--

INSERT INTO `dp_user` (`user_id`, `user_group_id`, `username`, `password`, `email`, `ip`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'kilbioas', 'bbde4bb6048cc58f42713b0634581197', 'oaskilbi@ukr.net', '127.0.0.1', 1, '2014-03-14 10:20:50', '2014-03-25 12:46:39'),
(3, 2, 'roma', '3f39e64ab222f29be0bb6da0dd5c552c', 'roma@gmail.ua', '127.0.0.1', 1, '2014-03-25 14:58:23', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `dp_user_friend`
--

CREATE TABLE IF NOT EXISTS `dp_user_friend` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dp_user_group`
--

CREATE TABLE IF NOT EXISTS `dp_user_group` (
  `user_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `permission` text NOT NULL,
  PRIMARY KEY (`user_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `dp_user_group`
--

INSERT INTO `dp_user_group` (`user_group_id`, `name`, `permission`) VALUES
(1, 'Administrator', 'a:1:{s:6:"modify";a:10:{i:0;s:15:"account/account";i:1;s:18:"common/column_left";i:2;s:13:"common/footer";i:3;s:13:"common/header";i:4;s:11:"common/home";i:5;s:12:"common/login";i:6;s:18:"common/maintenance";i:7;s:14:"common/seo_url";i:8;s:15:"error/not_found";i:9;s:11:"video/video";}}'),
(2, 'Guest', '');

-- --------------------------------------------------------

--
-- Table structure for table `dp_videolist`
--

CREATE TABLE IF NOT EXISTS `dp_videolist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `video_id` varchar(32) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `thumbnail` text NOT NULL,
  `published_at` datetime NOT NULL,
  `views` tinyint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `dp_videolist`
--

INSERT INTO `dp_videolist` (`id`, `video_id`, `name`, `description`, `thumbnail`, `published_at`, `views`, `created_at`, `updated_at`) VALUES
(1, 'W-TE_Ys4iwM', 'One Direction - Story of My Life', 'The new album Midnight Memories featuring Story of My Life is out now! Amazon: http://smarturl.it/MidnightMemoriesAmzd iTunes: http://t.co/LKM4OKwGwo ...', 'https://i.ytimg.com/vi/W-TE_Ys4iwM/mqdefault.jpg', '2013-11-03 04:11:02', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(2, 'rJYcmq__nDM', 'Rihanna - Rehab ft. Justin Timberlake', 'Music video by Rihanna performing Rehab. YouTube view counts pre-VEVO: 19591123. (C) 2007 The Island Def Jam Music Group.', 'https://i.ytimg.com/vi/rJYcmq__nDM/mqdefault.jpg', '2009-12-14 03:12:13', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(3, 'rp4UwPZfRis', 'Rihanna - Unfaithful', 'Music video by Rihanna performing Unfaithful. (C) 2006 The Island Def Jam Music Group #VEVOCertified on Feb. 15, 2012. http://vevo.com/certified http://youtu.', 'https://i.ytimg.com/vi/rp4UwPZfRis/mqdefault.jpg', '2009-11-23 08:11:45', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(4, 'mO1QBTG6EXs', 'THE LEGEND OF ZELDA RAP [MUSIC VIDEO]', 'WATCH BLOOPERS & MORE: http://bit.ly/ZELDAxtras DOWNLOAD THE SONG ON ITUNES: http://smo.sh/13NrBp8 DOWNLOAD UNCENSORED SONG: ...', 'https://i.ytimg.com/vi/mO1QBTG6EXs/mqdefault.jpg', '2011-11-18 09:11:54', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(5, 'ZQ2nCGawrSY', 'Rihanna - Russian Roulette', 'Music video by Rihanna performing Russian Roulette. (C) 2009 The Island Def Jam Music Group.', 'https://i.ytimg.com/vi/ZQ2nCGawrSY/mqdefault.jpg', '2009-12-05 06:12:55', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(6, '12PWq22E9CQ', 'ULTIMATE ASSASSIN''S CREED 3 SONG [Music Video]', 'AC4 MUSIC VIDEO: http://youtu.be/WpMt2vzrIxs WATCH BLOOPERS & MORE: http://bit.ly/AC3XTRAS GET THE REMIX! http://smo.sh./iTunesSweetSound ...', 'https://i.ytimg.com/vi/12PWq22E9CQ/mqdefault.jpg', '2012-10-26 07:10:59', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(7, 'tGpLHj-MVtk', 'FIRETRUCK! (Official Music Video)', 'BLOOPERS: http://bit.ly/FiretruckBloopers GET THE SONG: http://smo.sh/WMZv7l MILKSHAKE MUSIC VIDEO: http://bit.ly/MilkyMilkshake CHECK OUT THIS ...', 'https://i.ytimg.com/vi/tGpLHj-MVtk/mqdefault.jpg', '2010-08-27 06:08:03', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(8, '7zxXAtmmLLc', 'My Last Days: Zach Sobiech "Clouds" Celebrity Music Video', 'Zach Sobiech is 17 years old and diagnosed with osteosarcoma, a rare form of bone cancer that takes the lives of a large percent of its childhood victims. Gi...', 'https://i.ytimg.com/vi/7zxXAtmmLLc/mqdefault.jpg', '2013-05-06 10:05:09', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(9, 'pa14VNsdSYM', 'Rihanna - Only Girl (In The World)', 'Music video by Rihanna performing Only Girl (In The World). (C) 2010 The Island Def Jam Music Group #VEVOCertified on February 16, 2011.', 'https://i.ytimg.com/vi/pa14VNsdSYM/mqdefault.jpg', '2010-10-12 10:10:11', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(10, 'bkx9kCdaaMg', 'One Direction - Midnight Memories', 'Pre-order the Midnight Memories single bundle including 3 live tracks now! iTunes: http://smarturl.it/MidnightMemoriesEP Taken from the album Midnight Memori ...', 'https://i.ytimg.com/vi/bkx9kCdaaMg/mqdefault.jpg', '2014-01-31 04:01:07', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(11, 'v4Qv26IWyGU', 'Candy Crush The Movie (Official Fake Trailer)', 'Dedicated to all the Candy Crush and Other Phone Game addicts out there! CANDY CRUSH THE MOVIE ft. Candy Crush, Fruit Ninja, Angry Birds, Temple Run, ...', 'https://i.ytimg.com/vi/v4Qv26IWyGU/mqdefault.jpg', '2013-06-11 10:06:46', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(12, '2Tvy_Pbe5NA', 'Epic Rap Battle: Nerd vs. Geek', 'Comment: Who won? iTUNES: http://bit.ly/NerdvsGeekSong Get the hookup on electronic deals: http://www.TigerDirect.com/RL FREE karaoke/instrumental ...', 'https://i.ytimg.com/vi/2Tvy_Pbe5NA/mqdefault.jpg', '2013-10-03 04:10:02', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(13, 'y6Sxv-sUYtM', 'Pharrell Williams - Happy (Official Music Video)', 'Get Pharrell''s new album G I R L with 10 Brand New Tracks on iTunes: http://smarturl.it/GIRLitunes Get Pharrell''s new album G I R L with 10 Brand New Tracks ...', 'https://i.ytimg.com/vi/y6Sxv-sUYtM/mqdefault.jpg', '2013-11-22 05:11:00', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(14, 'KPmoDYayoLE', 'Draw My Life - Ryan Higa', 'So i was pretty hesitant to make this video... but after all of your request, here is my Draw My Life video! Check out my 2nd Channel for more vlogs: http://...', 'https://i.ytimg.com/vi/KPmoDYayoLE/mqdefault.jpg', '2013-04-11 03:04:45', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(15, '4Y1iErgBrDQ', 'Celebrities Read Mean Tweets #6', 'Some people are cruel and write very harsh things to celebrities on Twitter. What you don''t see when you send a nasty tweet is that it can cause pain. So to ...', 'https://i.ytimg.com/vi/4Y1iErgBrDQ/mqdefault.jpg', '2014-02-07 07:02:35', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(16, 'X86S5oZzzh4', 'Enrique Iglesias - Tired Of Being Sorry (MUSIC VIDEO)', 'Get Enrique''s new single "Tonight" on iTunes: http://bit.ly/b8gM8R See Enrique at Madison Square Garden. Get your tickets here: http://bit.ly/hzgV69.', 'https://i.ytimg.com/vi/X86S5oZzzh4/mqdefault.jpg', '2007-08-07 02:08:19', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(17, 'uzgp65UnPxA', 'We Can''t Stop - Miley Cyrus (Boyce Avenue feat. Bea Miller cover) on iTunes & Spotify', 'Tickets + VIP Meet & Greets: http://smarturl.it/BATour iTunes: http://smarturl.it/BoyceCCV2 Spotify: http://smarturl.it/BoyceCCV2Spotify - - - - - - - - - - ...', 'https://i.ytimg.com/vi/uzgp65UnPxA/mqdefault.jpg', '2013-09-29 04:09:03', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(18, 'JF8BRvqGCNs', 'Rihanna - Stay ft. Mikky Ekko', 'Download "Stay" from Unapologetic now: http://smarturl.it/UnapologeticDlx Music video by Rihanna performing Stay ft. Mikky Ekko. © 2013 The Island Def Jam ...', 'https://i.ytimg.com/vi/JF8BRvqGCNs/mqdefault.jpg', '2013-02-12 12:02:10', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(19, '1_hKLfTKU5Y', 'Mario Bros vs Wright Bros.  Epic Rap Battles of History Season 2', 'Download this song: http://bit.ly/MarioRap Click to tweet this vid-ee-oh! http://clicktotweet.com/c534e This. Is. Merchandise: http://bit.ly/ERBMerch http://...', 'https://i.ytimg.com/vi/1_hKLfTKU5Y/mqdefault.jpg', '2012-02-17 12:02:04', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(20, '0HwlhGOxsE0', 'Skate 3 - FUNNY MOMENTS - Part 1', 'Watch Part 2 - http://www.youtube.com/watch?v=kbR0UQrX05M Click Here To Subscribe! ▻ http://bit.ly/JoinBroArmy Once again internet isn''t working in the ...', 'https://i.ytimg.com/vi/0HwlhGOxsE0/mqdefault.jpg', '2014-01-08 12:01:26', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(21, 'VzEHmcABGUU', 'LES PRESENTO A MI NOVIA | Preguntas De Facebook | Hola Soy German', 'Suscribete → http://bit.ly/SuscribeteHSG Facebook → http://bit.ly/FacebookHSG Twitter → http://bit.ly/TwitterHSG Instagram → http://instagram.com/germanchelo.', 'https://i.ytimg.com/vi/VzEHmcABGUU/mqdefault.jpg', '2014-03-01 03:03:09', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(22, '36mCEZzzQ3o', 'One Direction - One Way Or Another (Teenage Kicks)', 'As well as releasing the Red Nose Day single, One Direction are fundraising by doing something funny for money...and they want you to join them! Get involved.', 'https://i.ytimg.com/vi/36mCEZzzQ3o/mqdefault.jpg', '2013-02-20 11:02:26', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(23, 'z-3xIw730pg', 'WORLDS MOST OFFENSIVE GAME?', 'Fridays With PewDiePie, Saturday edition! Click Here To Subscribe! ▻ http://bit.ly/JoinBroArmy Game ▻ Cards Against Humanity You can buy it online ...', 'https://i.ytimg.com/vi/z-3xIw730pg/mqdefault.jpg', '2013-11-24 01:11:35', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(24, '0m1hAfpOzbU', 'Peg Pants!', 'Don''t you just wish you could pull a chair out of your butt sometimes? Well wish no further.. wait.. wish no more? Stop wishing, it doesn''t work. Uhh. Peg Pa...', 'https://i.ytimg.com/vi/0m1hAfpOzbU/mqdefault.jpg', '2013-11-09 07:11:54', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00'),
(25, '-uwY3sjqYX0', 'Fast Food Folk Song - Rhett & Link', 'Yes! the guy''s reaction is totally authentic. He had no idea we were coming, and he really got the order right (almost right). We couldn''t believe it either, so we ...', 'https://i.ytimg.com/vi/-uwY3sjqYX0/mqdefault.jpg', '2009-04-08 07:04:03', 0, '2014-03-25 10:21:31', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
