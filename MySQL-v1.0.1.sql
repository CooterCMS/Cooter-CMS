-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 11, 2014 at 09:09 AM
-- Server version: 5.5.34-0ubuntu0.12.04.1
-- PHP Version: 5.5.7-1+sury.org~precise+1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cooter_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `Assets`
--

DROP TABLE IF EXISTS `Assets`;
CREATE TABLE IF NOT EXISTS `Assets` (
  `idAssets` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `file_dir` text NOT NULL,
  `file_name` text NOT NULL,
  `file_type` tinytext NOT NULL,
  `remote` tinyint(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idAssets`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `Assets`
--

INSERT INTO `Assets` (`idAssets`, `name`, `file_dir`, `file_name`, `file_type`, `remote`, `date`) VALUES
(1, 'Default', 'css', 'global', 'css', 0, '2014-01-01 17:13:32'),
(2, 'Default', 'css', 'mobile', 'css', 0, '2014-01-01 16:54:53'),
(3, 'Default', 'css', 'typogrophy', 'css', 0, '2014-01-01 16:54:55'),
(4, 'Default', 'js', 'global', 'js', 0, '2014-01-01 16:54:49'),
(5, 'Admin', 'admin/css', 'global', 'css', 0, '2014-01-02 17:48:56'),
(6, 'Admin', 'admin/css', 'mobile', 'css', 0, '2014-01-02 17:49:03'),
(7, 'Admin', 'admin/css', 'typogrophy', 'css', 0, '2014-01-02 17:49:10');

-- --------------------------------------------------------

--
-- Table structure for table `Forms`
--

DROP TABLE IF EXISTS `Forms`;
CREATE TABLE IF NOT EXISTS `Forms` (
  `idForms` int(11) NOT NULL AUTO_INCREMENT,
  `IP` varchar(45) NOT NULL,
  `When` datetime NOT NULL,
  `Session_Id` varchar(40) NOT NULL,
  `User_Agent` varchar(150) NOT NULL,
  `Form` text NOT NULL,
  PRIMARY KEY (`idForms`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `Forms`
--

INSERT INTO `Forms` (`idForms`, `IP`, `When`, `Session_Id`, `User_Agent`, `Form`) VALUES
(1, '192.168.0.4', '2014-01-02 10:23:05', 'a73904f7104d2d17afda8ea93d6e7da4', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(2, '192.168.0.4', '2014-01-02 10:23:13', 'a73904f7104d2d17afda8ea93d6e7da4', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(3, '192.168.0.4', '2014-01-02 10:27:38', '92340fc8a5377a15673cb5cbed568bb1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(4, '192.168.0.4', '2014-01-02 10:41:21', 'cf5d9795e6f508be6479336aa721ac38', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(5, '192.168.0.4', '2014-01-02 10:46:09', '3470102f5bc8424e158b89fe35850216', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(6, '192.168.0.4', '2014-01-02 11:06:42', 'd40decfa99a9c494edb39c2b3a6c283f', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(7, '192.168.0.4', '2014-01-02 11:07:15', 'd40decfa99a9c494edb39c2b3a6c283f', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(8, '192.168.0.4', '2014-01-02 11:07:39', '5c8bc6a2b67064de2d75d3e4006a7221', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(9, '192.168.0.4', '2014-01-02 11:16:32', 'fca14c98b04c94727746144d6c75bd70', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(10, '192.168.0.4', '2014-01-02 11:18:37', 'e56680affe67924f26530b19668e3026', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(11, '192.168.0.4', '2014-01-02 11:22:38', '565858437854dc6cde516a512114b961', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(12, '192.168.0.4', '2014-01-02 11:24:15', '7b07ba44de70d3b9a3d486bded651f68', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(13, '192.168.0.4', '2014-01-02 11:43:05', 'a65a9b16050b27a45bbc9eb3dce3f442', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(14, '192.168.0.4', '2014-01-02 11:43:21', 'a65a9b16050b27a45bbc9eb3dce3f442', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(15, '192.168.0.4', '2014-01-02 19:09:20', '64edffadbadc6ba0ce8f2ef264937b33', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(16, '192.168.0.4', '2014-01-02 19:17:34', 'b77e812108eb1ad9df6ce74d09017f59', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(17, '192.168.0.4', '2014-01-02 19:18:20', '939ebe505c8eaa9c7c0734b87ae4891e', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(18, '192.168.0.4', '2014-01-02 19:40:52', '94bf0c98e2045f4d2048dbcc96f3a7c8', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(19, '192.168.0.4', '2014-01-03 07:59:39', 'b30655e369195b9e2fa0901c45ebef6e', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(20, '192.168.0.4', '2014-01-03 08:00:16', 'de821e0cc2766adf84e45879de6a6515', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(21, '192.168.0.4', '2014-01-03 09:14:35', '38da477d0735032ad8366a93ce744394', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(22, '192.168.0.4', '2014-01-03 10:02:34', '377bf1198c2acf4ce2ffbcc1e6992a69', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(23, '192.168.0.4', '2014-01-03 21:53:22', 'c44bfe718c3590310c1329809360e46c', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(24, '192.168.0.4', '2014-01-04 03:40:27', 'b3f7dbecd89d40f59052f582dbe4286e', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(25, '192.168.0.4', '2014-01-06 07:52:56', '22f49503da59bdfa7aa445a3b0c52c32', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(26, '192.168.0.4', '2014-01-06 17:53:32', 'dc2e6e780cc2f82e66f6b2ebb32a10c7', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(27, '192.168.0.4', '2014-01-06 19:08:24', '68712227cb1a364b15d0cd992d7e93d6', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(28, '192.168.0.4', '2014-01-06 19:08:27', '68712227cb1a364b15d0cd992d7e93d6', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(29, '192.168.0.4', '2014-01-06 19:08:29', '68712227cb1a364b15d0cd992d7e93d6', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(30, '192.168.0.4', '2014-01-06 19:08:30', '68712227cb1a364b15d0cd992d7e93d6', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(31, '192.168.0.4', '2014-01-06 19:08:31', '68712227cb1a364b15d0cd992d7e93d6', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(32, '192.168.0.4', '2014-01-06 19:08:53', '68712227cb1a364b15d0cd992d7e93d6', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(33, '192.168.0.4', '2014-01-06 19:09:20', '68712227cb1a364b15d0cd992d7e93d6', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(34, '192.168.0.4', '2014-01-06 19:09:26', '68712227cb1a364b15d0cd992d7e93d6', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(35, '192.168.0.4', '2014-01-06 19:09:30', 'bbe1d79b17f2815dd1a54e315f1ce4d6', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(36, '192.168.0.4', '2014-01-06 19:09:43', 'bbe1d79b17f2815dd1a54e315f1ce4d6', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(37, '192.168.0.4', '2014-01-06 19:09:59', 'bbe1d79b17f2815dd1a54e315f1ce4d6', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(38, '192.168.0.4', '2014-01-06 19:10:14', 'bbe1d79b17f2815dd1a54e315f1ce4d6', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(39, '192.168.0.4', '2014-01-06 19:10:29', 'bbe1d79b17f2815dd1a54e315f1ce4d6', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(40, '192.168.0.4', '2014-01-06 19:10:49', 'bbe1d79b17f2815dd1a54e315f1ce4d6', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(41, '192.168.0.4', '2014-01-06 19:11:19', 'bbe1d79b17f2815dd1a54e315f1ce4d6', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(42, '192.168.0.4', '2014-01-06 19:11:25', 'bbe1d79b17f2815dd1a54e315f1ce4d6', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(43, '192.168.0.4', '2014-01-06 19:11:57', 'bbe1d79b17f2815dd1a54e315f1ce4d6', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(44, '192.168.0.4', '2014-01-06 19:12:11', 'bbe1d79b17f2815dd1a54e315f1ce4d6', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(45, '192.168.0.4', '2014-01-06 19:13:56', 'bbe1d79b17f2815dd1a54e315f1ce4d6', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(46, '192.168.0.4', '2014-01-06 19:14:12', 'bbe1d79b17f2815dd1a54e315f1ce4d6', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(47, '192.168.0.4', '2014-01-06 19:14:30', 'bbe1d79b17f2815dd1a54e315f1ce4d6', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(48, '192.168.0.4', '2014-01-06 19:14:41', 'd2e3e4d671bf01981f339f78c7362686', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(49, '192.168.0.4', '2014-01-07 20:28:29', '7f063022db71048e0d6ee8d4c1abbc94', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(50, '192.168.0.4', '2014-01-07 20:28:31', '7f063022db71048e0d6ee8d4c1abbc94', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(51, '192.168.0.4', '2014-01-07 20:28:32', '7f063022db71048e0d6ee8d4c1abbc94', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(52, '192.168.0.4', '2014-01-08 18:12:46', '3f084675d1904449ba53ae220b10c330', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(53, '192.168.0.4', '2014-01-08 18:13:28', '86c67663e3e4eb8609e3f0a9957ee86a', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(54, '192.168.0.4', '2014-01-08 18:15:25', 'd5c6b15504468185aa53c97b576edfd1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(55, '192.168.0.4', '2014-01-08 21:40:07', 'bab05056bb44fca6172a6fd6dfa198fb', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(56, '192.168.0.4', '2014-01-09 15:29:38', 'd3d812159139b103866ef37b145313b3', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(57, '192.168.0.4', '2014-01-09 16:33:04', '6887cfc9bc16f09fb4580bcc229b043b', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(58, '192.168.0.4', '2014-01-09 16:35:11', '6887cfc9bc16f09fb4580bcc229b043b', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(59, '192.168.0.4', '2014-01-09 16:36:22', '6887cfc9bc16f09fb4580bcc229b043b', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(60, '192.168.0.4', '2014-01-09 16:36:39', '6887cfc9bc16f09fb4580bcc229b043b', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(61, '192.168.0.4', '2014-01-09 17:09:41', '1219ab444ff36cc57328c9807907c0e2', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(62, '192.168.0.4', '2014-01-09 18:01:38', '1858d66a41a50a55bbfeb6f61d257fa2', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(63, '192.168.0.4', '2014-01-09 18:01:54', '1858d66a41a50a55bbfeb6f61d257fa2', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(64, '192.168.0.4', '2014-01-09 18:01:56', '1858d66a41a50a55bbfeb6f61d257fa2', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(65, '192.168.0.4', '2014-01-09 18:03:04', '1858d66a41a50a55bbfeb6f61d257fa2', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(66, '192.168.0.4', '2014-01-09 18:03:21', '1858d66a41a50a55bbfeb6f61d257fa2', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(67, '192.168.0.4', '2014-01-09 18:03:22', '1858d66a41a50a55bbfeb6f61d257fa2', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(68, '192.168.0.4', '2014-01-09 18:03:53', '1858d66a41a50a55bbfeb6f61d257fa2', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(69, '192.168.0.4', '2014-01-09 18:04:39', '1858d66a41a50a55bbfeb6f61d257fa2', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(70, '192.168.0.4', '2014-01-09 18:06:33', '1858d66a41a50a55bbfeb6f61d257fa2', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(71, '192.168.0.4', '2014-01-09 18:10:27', 'f21cb673a17f81dbcc4518df9ad4f06d', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(72, '192.168.0.4', '2014-01-09 19:06:59', 'e94b7f7ed2005f240204c87ce1a76d29', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(73, '192.168.0.4', '2014-01-09 19:07:11', 'e94b7f7ed2005f240204c87ce1a76d29', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(74, '192.168.0.4', '2014-01-09 19:07:43', 'e94b7f7ed2005f240204c87ce1a76d29', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(75, '192.168.0.4', '2014-01-09 19:08:59', 'e94b7f7ed2005f240204c87ce1a76d29', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(76, '192.168.0.4', '2014-01-09 19:10:28', 'e94b7f7ed2005f240204c87ce1a76d29', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(77, '192.168.0.4', '2014-01-09 19:10:39', 'e94b7f7ed2005f240204c87ce1a76d29', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(78, '192.168.0.4', '2014-01-09 19:11:37', 'e94b7f7ed2005f240204c87ce1a76d29', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(79, '192.168.0.4', '2014-01-09 19:11:48', 'e94b7f7ed2005f240204c87ce1a76d29', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login'),
(80, '192.168.0.4', '2014-01-09 19:12:09', '0a1dd113c955807b3b202007fe16504a', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 'Login');

-- --------------------------------------------------------

--
-- Table structure for table `Meta`
--

DROP TABLE IF EXISTS `Meta`;
CREATE TABLE IF NOT EXISTS `Meta` (
  `idMeta` int(11) NOT NULL AUTO_INCREMENT,
  `post_name` text CHARACTER SET utf16 NOT NULL,
  `name` varchar(255) CHARACTER SET utf16 NOT NULL,
  `content` varchar(255) CHARACTER SET utf16 NOT NULL,
  PRIMARY KEY (`idMeta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Meta`
--

INSERT INTO `Meta` (`idMeta`, `post_name`, `name`, `content`) VALUES
(1, 'default', 'description', 'Cooter CMS is an awesome CMS'),
(3, 'first-post', 'description', 'First Post meta data');

-- --------------------------------------------------------

--
-- Table structure for table `Options`
--

DROP TABLE IF EXISTS `Options`;
CREATE TABLE IF NOT EXISTS `Options` (
  `idOptions` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) NOT NULL,
  `option_type` varchar(255) NOT NULL,
  `option_value` varchar(255) NOT NULL,
  PRIMARY KEY (`idOptions`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `Options`
--

INSERT INTO `Options` (`idOptions`, `option_name`, `option_type`, `option_value`) VALUES
(1, 'site_title', 'System', 'Cooter CMS'),
(2, 'site_address', 'System', 'http://www.cootercms.net/'),
(3, 'site_tagline', 'System', 'Easy CMS'),
(6, 'default_post', 'System', '1'),
(7, 'default_page', 'System', '2'),
(8, 'allow_register', 'System', '1'),
(9, 'allow_login', 'System', '0');

-- --------------------------------------------------------

--
-- Table structure for table `Posts`
--

DROP TABLE IF EXISTS `Posts`;
CREATE TABLE IF NOT EXISTS `Posts` (
  `idPosts` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `title` text NOT NULL,
  `breadcrum` varchar(50) NOT NULL,
  `html` longtext NOT NULL,
  `post_type` varchar(5) NOT NULL,
  `author_name` varchar(50) NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idPosts`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `Posts`
--

INSERT INTO `Posts` (`idPosts`, `name`, `title`, `breadcrum`, `html`, `post_type`, `author_name`, `modified_date`, `created_date`) VALUES
(1, 'first-post', 'First Posts', 'Post', '<div style="padding: 10px; float: left; width: 70%;">\n<h1 style="color: #000; font-size: 26px;">This is the default Post</h1>\n<p class="indent" style="color: #000; padding: 0px 10px;">Thanks for checking us out</p>\n</div>\n', 'post', '', '0000-00-00 00:00:00', '2013-12-23 06:48:39'),
(2, 'welcome', 'Welcome', 'Welcome', '<div style="padding: 10px; float: left; width: 70%;">\r\n<h1 style="color: #000; font-size: 26px;">Welcome To Cooter CMS</h1>\r\n<p class="indent" style="color: #000; padding: 0px 10px;">Thanks for checking us out</p>\r\n</div>\r\n', 'page', '', '0000-00-00 00:00:00', '2013-12-23 06:48:32'),
(3, 'downloads-123', 'Downloads', 'Pages > Downloads', 'This is the Downloads Page', 'page', 'Kyle Coots', '0000-00-00 00:00:00', '2013-12-25 04:15:20'),
(4, 'another-post-123', 'Another Posts', 'Post', '<div style="padding: 10px; float: left; width: 70%;">\r\n<h1 style="color: #000; font-size: 26px;">This is another default Post</h1>\r\n<p class="indent" style="color: #000; padding: 0px 10px;">This is just another default post. You can delete this</p>\r\n</div>\r\n', 'post', '', '0000-00-00 00:00:00', '2013-12-23 06:48:39'),
(5, 'post_error', 'Error', 'Error', 'This is the default error page', 'error', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'admin', 'Admin Home', 'Admin', '<div style="padding: 10px; float: left; width: 70%;">\n<h1>Admin Home Page</h1>\n</div>\n', 'admin', '', '0000-00-00 00:00:00', '2013-12-23 06:48:39');

-- --------------------------------------------------------

--
-- Table structure for table `Routes`
--

DROP TABLE IF EXISTS `Routes`;
CREATE TABLE IF NOT EXISTS `Routes` (
  `idRoutes` int(11) NOT NULL AUTO_INCREMENT,
  `Order` int(11) NOT NULL,
  `Url` varchar(250) NOT NULL,
  `Url_Variable` varchar(20) NOT NULL,
  `Class` text NOT NULL,
  `Method` text NOT NULL,
  `Variable` text NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idRoutes`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `Routes`
--

INSERT INTO `Routes` (`idRoutes`, `Order`, `Url`, `Url_Variable`, `Class`, `Method`, `Variable`, `Date`) VALUES
(1, 0, 'default_controller', '', 'pages', 'index', 'welcome', '2013-12-26 02:58:02'),
(2, 0, '404_override', '', 'My_404', '', '', '2013-12-27 13:11:36'),
(3, 0, 'pages', '(:any)', 'pages', 'index', '$1', '2014-01-02 15:52:17'),
(4, 0, 'posts', '(:any)', 'posts', 'index', '$1', '2014-01-02 15:51:22'),
(5, 0, 'lost', '', 'my_404', 'index', '', '2013-12-27 13:15:34'),
(6, 0, 'lost', '(:any)', 'my_404', 'index', '', '2013-12-27 13:15:56'),
(7, 0, 'login', '', 'auth', 'login', '', '2014-01-09 22:35:08'),
(8, 0, 'login', '(:any)', 'auth', 'login', '(:any)', '2014-01-09 22:35:08');

-- --------------------------------------------------------

--
-- Table structure for table `Sessions`
--

DROP TABLE IF EXISTS `Sessions`;
CREATE TABLE IF NOT EXISTS `Sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Sessions`
--

INSERT INTO `Sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('18028cd64b9a4a5436d906bce7499182', '83.247.68.158', '0', 1387446402, ''),
('2d9a602b875f5b5663f63f6a63412c54', '202.46.50.15', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)', 1387444198, ''),
('33b475a305658bd97392440ed07cafa7', '182.93.219.38', '0', 1387446595, ''),
('440726a2130088802ac0bfbc41689e17', '202.46.60.14', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)', 1387452609, ''),
('7467f254d276ee9e32b42626d754a798', '119.63.193.196', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)', 1387438328, ''),
('9878cc839a74cedb47cb2500e59d97fa', '192.168.0.4', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 1387459062, 'a:3:{s:9:"user_data";s:0:"";s:8:"username";s:5:"admin";s:12:"is_logged_in";b:1;}'),
('98a610fdae11713519300563f2da04a5', '83.133.121.163', '0', 1387447016, ''),
('b911fdf73678de5c65a418ccff0155a7', '119.63.193.132', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)', 1387452725, ''),
('d43ef759f142f8b2beebe2cf21cf62ee', '202.137.10.100', '0', 1387446473, ''),
('dcde71039a362200cc65461fefc45b90', '192.99.9.228', 'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.2.23) Gecko/20110921 Ubuntu/10.04 (lucid) Firefox/3.6.23', 1387442020, ''),
('f5039c3bccf8a89b0fcb840109b71ae5', '119.63.193.132', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)', 1387444263, ''),
('f57dc0e468bb02c20de78d6c70724520', '202.46.53.179', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)', 1387438209, '');

-- --------------------------------------------------------

--
-- Table structure for table `Theme`
--

DROP TABLE IF EXISTS `Theme`;
CREATE TABLE IF NOT EXISTS `Theme` (
  `idTheme` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `enabled` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `template_dir` varchar(255) NOT NULL,
  `template_assets_dir` varchar(255) NOT NULL,
  `template_index` varchar(255) NOT NULL,
  `template_header` varchar(255) NOT NULL,
  `template_menu` varchar(255) NOT NULL,
  `template_footer` varchar(255) NOT NULL,
  PRIMARY KEY (`idTheme`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Theme`
--

INSERT INTO `Theme` (`idTheme`, `name`, `enabled`, `type`, `template_dir`, `template_assets_dir`, `template_index`, `template_header`, `template_menu`, `template_footer`) VALUES
(1, 'Default', 1, 'front_end', 'global', 'assets', 'index', 'header', 'menu', 'footer'),
(2, 'Sample', 0, 'front_end', 'sample', 'assets', 'index', 'header', 'menu', 'footer'),
(3, 'Admin', 1, 'back_end', 'admin', 'assets/admin', 'index', 'header', 'menu', 'footer');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
CREATE TABLE IF NOT EXISTS `Users` (
  `idUsers` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` char(60) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `role` text NOT NULL,
  PRIMARY KEY (`idUsers`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`idUsers`, `username`, `password`, `role`) VALUES
(6, 'slimjim', '$2a$15$05b5SaqeJVm6SfQOkxaiU.ufRBJpCmLNtz2Uh68Vr/hl98SaaHFaK', 'Admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
