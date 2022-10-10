-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 07, 2021 at 05:05 PM
-- Server version: 5.5.62-0+deb8u1
-- PHP Version: 7.2.25-1+0~20191128.32+debian8~1.gbp108445

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WebDiP2020x126`
--

-- --------------------------------------------------------

--
-- Table structure for table `dnevnik`
--

CREATE TABLE `dnevnik` (
  `dnevnik_id` int(11) NOT NULL,
  `radnja` text,
  `stranica` text,
  `datum_vrijeme` datetime NOT NULL,
  `tip_tip_id` int(11) NOT NULL,
  `korisnik_korisnicko_ime` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dnevnik`
--

INSERT INTO `dnevnik` (`dnevnik_id`, `radnja`, `stranica`, `datum_vrijeme`, `tip_tip_id`, `korisnik_korisnicko_ime`) VALUES
(1, '', '', '2021-06-02 21:43:57', 3, 'admin'),
(2, '', '', '2021-06-02 21:44:13', 2, 'admin'),
(4, 'novi pomak: 0', '', '2021-06-02 21:45:52', 10, 'admin'),
(11, '', '', '2021-06-02 21:48:54', 11, 'admin'),
(13, '', 'prijava.php', '2021-06-03 09:51:30', 2, 'admin'),
(14, '', 'index.php', '2021-06-03 09:51:30', 12, 'admin'),
(15, 'tematika: Vlakovi budućnosti', 'tematike.php', '2021-06-03 09:53:44', 15, 'admin'),
(16, 'tematika: Vlakovi velikih brzina', 'tematike.php', '2021-06-03 09:54:17', 16, 'admin'),
(17, '', 'tematike.php', '2021-06-03 09:55:30', 12, 'admin'),
(18, '', 'postavke.php', '2021-06-03 09:55:42', 12, 'admin'),
(19, '', 'postavke.php', '2021-06-03 09:55:46', 13, 'admin'),
(20, 'blokiran: iivic', 'postavke.php', '2021-06-03 09:56:08', 7, 'admin'),
(21, 'odblokiran: iivic', 'postavke.php', '2021-06-03 09:56:10', 8, 'admin'),
(22, '', 'dnevnik.php', '2021-06-03 09:57:27', 12, 'admin'),
(23, '', 'moje_tematike.php', '2021-06-03 09:57:33', 12, 'admin'),
(24, '', 'izlozbe.php', '2021-06-03 09:57:38', 12, 'admin'),
(25, 'izložba: Japanski vlakovi budućnosti', 'izlozbe.php', '2021-06-03 09:58:45', 17, 'admin'),
(26, 'izložba: Japanski vlakovi budućnosti', 'izlozbe.php', '2021-06-03 09:58:48', 18, 'admin'),
(27, '', 'index.php', '2021-06-03 09:58:51', 12, 'admin'),
(28, '', 'izlozba.php', '2021-06-03 09:58:54', 12, 'admin'),
(29, 'izlozba_id: 1', 'galerija.php', '2021-06-03 09:58:58', 12, 'admin'),
(30, '', 'dnevnik.php', '2021-06-03 09:59:04', 12, 'admin'),
(31, '', 'dnevnik.php', '2021-06-03 10:18:34', 12, 'admin'),
(32, '', 'dnevnik.php', '2021-06-03 10:19:36', 12, 'admin'),
(33, '', 'dnevnik.php', '2021-06-03 10:20:32', 12, 'admin'),
(90, '', 'dnevnik.php', '2021-06-03 12:00:10', 12, 'admin'),
(91, '', 'index.php', '2021-06-03 12:00:14', 12, 'admin'),
(92, '', 'prijava.php', '2021-06-03 13:29:51', 2, 'admin'),
(93, '', 'index.php', '2021-06-03 13:29:51', 12, 'admin'),
(94, '', 'index.php', '2021-06-03 13:32:55', 12, 'admin'),
(95, '', 'index.php', '2021-06-03 13:32:58', 12, 'admin'),
(96, '', 'index.php', '2021-06-03 13:36:37', 12, 'admin'),
(97, '', 'tematike.php', '2021-06-03 13:36:38', 12, 'admin'),
(98, '', 'postavke.php', '2021-06-03 13:36:40', 12, 'admin'),
(99, '', 'dnevnik.php', '2021-06-03 13:36:47', 12, 'admin'),
(100, '', 'index.php', '2021-06-03 13:36:53', 12, 'admin'),
(101, '', 'izlozba.php', '2021-06-03 13:36:54', 12, 'admin'),
(102, 'izlozba_id: 1', 'galerija.php', '2021-06-03 13:36:56', 12, 'admin'),
(103, '', 'postavke.php', '2021-06-03 13:38:33', 12, 'admin'),
(104, '', 'dnevnik.php', '2021-06-03 13:38:36', 12, 'admin'),
(105, '', 'index.php', '2021-06-03 13:39:55', 12, 'admin'),
(106, '', 'index.php', '2021-06-03 13:40:30', 12, 'admin'),
(107, '', 'dnevnik.php', '2021-06-03 13:40:36', 12, 'admin'),
(108, '', 'index.php', '2021-06-03 13:40:40', 12, 'admin'),
(109, '', 'izlozba.php', '2021-06-03 13:40:41', 12, 'admin'),
(110, 'izlozba_id: 1', 'galerija.php', '2021-06-03 13:40:42', 12, 'admin'),
(111, '', 'index.php', '2021-06-03 13:42:47', 12, 'admin'),
(112, '', 'tematike.php', '2021-06-03 13:43:00', 12, 'admin'),
(113, '', 'postavke.php', '2021-06-03 13:43:05', 12, 'admin'),
(114, '', 'index.php', '2021-06-03 13:43:11', 12, 'admin'),
(115, '', 'index.php', '2021-06-03 13:44:15', 12, 'admin'),
(116, '', 'izlozba.php', '2021-06-03 13:44:32', 12, 'admin'),
(117, 'izlozba_id: 1', 'galerija.php', '2021-06-03 13:44:46', 12, 'admin'),
(118, '', 'index.php', '2021-06-03 13:44:55', 12, 'admin'),
(119, '', 'index.php', '2021-06-03 13:46:01', 12, 'admin'),
(120, '', 'izlozba.php', '2021-06-03 13:46:20', 12, 'admin'),
(121, 'izlozba_id: 1', 'galerija.php', '2021-06-03 13:46:21', 12, 'admin'),
(122, '', 'index.php', '2021-06-03 13:48:11', 12, 'admin'),
(123, '', 'index.php', '2021-06-03 13:48:45', 12, 'admin'),
(124, '', 'index.php', '2021-06-03 13:49:40', 12, 'admin'),
(125, '', 'index.php', '2021-06-03 13:59:05', 12, 'admin'),
(126, '', 'index.php', '2021-06-03 13:59:07', 12, 'admin'),
(127, '', 'index.php', '2021-06-03 13:59:40', 12, 'admin'),
(128, '', 'index.php', '2021-06-03 14:00:37', 12, 'admin'),
(129, '', 'index.php', '2021-06-03 14:05:46', 12, 'admin'),
(130, '', 'index.php', '2021-06-03 14:07:50', 12, 'admin'),
(131, '', 'index.php', '2021-06-03 14:07:51', 12, 'admin'),
(132, '', 'index.php', '2021-06-03 14:07:52', 12, 'admin'),
(133, '', 'index.php', '2021-06-03 14:15:53', 12, 'admin'),
(134, '', 'index.php', '2021-06-03 14:17:53', 12, 'admin'),
(135, '', 'index.php', '2021-06-03 14:17:54', 12, 'admin'),
(136, '', 'index.php', '2021-06-03 14:17:54', 12, 'admin'),
(137, '', 'index.php', '2021-06-03 14:17:55', 12, 'admin'),
(138, '', 'index.php', '2021-06-03 14:17:55', 12, 'admin'),
(139, '', 'index.php', '2021-06-03 14:17:55', 12, 'admin'),
(140, '', 'index.php', '2021-06-03 14:17:55', 12, 'admin'),
(141, '', 'index.php', '2021-06-03 14:18:20', 12, 'admin'),
(142, '', 'index.php', '2021-06-03 14:19:30', 12, 'admin'),
(143, '', 'index.php', '2021-06-03 14:21:37', 12, 'admin'),
(144, '', 'index.php', '2021-06-03 14:22:56', 12, 'admin'),
(145, '', 'index.php', '2021-06-03 14:24:19', 12, 'admin'),
(146, '', 'index.php', '2021-06-03 14:25:17', 12, 'admin'),
(147, '', 'index.php', '2021-06-03 14:25:52', 12, 'admin'),
(148, '', 'index.php', '2021-06-03 14:29:53', 12, 'admin'),
(149, '', 'index.php', '2021-06-03 14:30:36', 12, 'admin'),
(150, '', 'index.php', '2021-06-03 14:31:23', 12, 'admin'),
(151, '', 'index.php', '2021-06-03 14:33:22', 12, 'admin'),
(152, '', 'index.php', '2021-06-03 14:33:54', 12, 'admin'),
(153, '', 'index.php', '2021-06-03 14:35:06', 12, 'admin'),
(154, '', 'index.php', '2021-06-03 14:36:39', 12, 'admin'),
(155, '', 'index.php', '2021-06-03 14:37:24', 12, 'admin'),
(156, '', 'index.php', '2021-06-03 14:38:19', 12, 'admin'),
(157, '', 'index.php', '2021-06-03 14:39:58', 12, 'admin'),
(158, '', 'index.php', '2021-06-03 14:40:23', 12, 'admin'),
(159, '', 'index.php', '2021-06-03 14:41:10', 12, 'admin'),
(160, '', 'index.php', '2021-06-03 14:41:49', 12, 'admin'),
(161, '', 'izlozba.php', '2021-06-03 14:41:55', 12, 'admin'),
(162, '', 'index.php', '2021-06-03 14:42:03', 12, 'admin'),
(163, '', 'index.php', '2021-06-03 14:42:05', 12, 'admin'),
(164, '', 'izlozba.php', '2021-06-03 14:42:08', 12, 'admin'),
(165, '', 'index.php', '2021-06-03 14:42:22', 12, 'admin'),
(166, '', 'index.php', '2021-06-03 14:42:26', 12, 'admin'),
(167, '', 'izlozba.php', '2021-06-03 14:42:28', 12, 'admin'),
(168, '', 'index.php', '2021-06-03 14:42:54', 12, 'admin'),
(169, '', 'izlozba.php', '2021-06-03 14:43:01', 12, 'admin'),
(170, '', 'index.php', '2021-06-03 14:43:21', 12, 'admin'),
(171, '', 'izlozba.php', '2021-06-03 14:49:02', 12, 'admin'),
(172, 'izlozba_id: 1', 'galerija.php', '2021-06-03 14:49:09', 12, 'admin'),
(173, '', 'postavke.php', '2021-06-03 14:49:20', 12, 'admin'),
(174, '', 'tematike.php', '2021-06-03 14:49:21', 12, 'admin'),
(175, '', 'dnevnik.php', '2021-06-03 14:49:23', 12, 'admin'),
(176, '', 'moje_tematike.php', '2021-06-03 14:49:26', 12, 'admin'),
(177, '', 'index.php', '2021-06-03 14:49:29', 12, 'admin'),
(178, '', 'index.php', '2021-06-03 14:50:41', 12, 'admin'),
(179, '', 'index.php', '2021-06-03 14:51:44', 12, 'admin'),
(180, '', 'index.php', '2021-06-03 14:53:06', 12, 'admin'),
(181, '', 'index.php', '2021-06-03 14:54:08', 12, 'admin'),
(182, '', 'index.php', '2021-06-03 14:54:52', 12, 'admin'),
(183, '', 'index.php', '2021-06-03 14:55:11', 12, 'admin'),
(184, '', 'izlozba.php', '2021-06-03 14:56:05', 12, 'admin'),
(185, '', 'postavke.php', '2021-06-03 14:56:18', 12, 'admin'),
(186, '', 'tematike.php', '2021-06-03 14:56:31', 12, 'admin'),
(187, '', 'index.php', '2021-06-03 14:56:37', 12, 'admin'),
(188, '', 'index.php', '2021-06-03 14:57:12', 12, 'admin'),
(189, '', 'izlozba.php', '2021-06-03 14:57:14', 12, 'admin'),
(190, '', 'tematike.php', '2021-06-03 14:57:24', 12, 'admin'),
(191, '', 'moje_tematike.php', '2021-06-03 14:58:26', 12, 'admin'),
(192, '', 'izlozbe.php', '2021-06-03 14:58:28', 12, 'admin'),
(193, '', 'index.php', '2021-06-03 14:58:37', 12, 'admin'),
(194, '', 'moje_tematike.php', '2021-06-03 15:00:05', 12, 'admin'),
(195, '', 'izlozbe.php', '2021-06-03 15:00:09', 12, 'admin'),
(196, '', 'index.php', '2021-06-03 15:00:28', 12, 'admin'),
(197, '', 'index.php', '2021-06-03 15:01:51', 12, 'admin'),
(198, '', 'dnevnik.php', '2021-06-03 15:03:48', 12, 'admin'),
(199, '', 'index.php', '2021-06-03 15:04:26', 12, 'admin'),
(200, '', '', '2021-06-03 15:04:34', 11, 'admin'),
(201, '', 'prijava.php', '2021-06-03 15:04:47', 2, 'admin'),
(202, '', 'index.php', '2021-06-03 15:04:47', 12, 'admin'),
(203, '', 'izlozba.php', '2021-06-03 15:07:03', 12, 'admin'),
(204, '', 'tematike.php', '2021-06-03 15:07:09', 12, 'admin'),
(205, '', 'postavke.php', '2021-06-03 15:07:12', 12, 'admin'),
(206, '', 'postavke.php', '2021-06-03 15:07:15', 12, 'admin'),
(207, '', 'moje_tematike.php', '2021-06-03 15:07:20', 12, 'admin'),
(208, '', 'dnevnik.php', '2021-06-03 15:07:23', 12, 'admin'),
(209, '', 'index.php', '2021-06-03 15:07:35', 12, 'admin'),
(210, '', 'index.php', '2021-06-03 15:08:05', 12, 'admin'),
(211, '', 'index.php', '2021-06-03 15:08:35', 12, 'admin'),
(212, '', 'index.php', '2021-06-03 15:09:56', 12, 'admin'),
(213, '', 'dnevnik.php', '2021-06-03 15:10:13', 12, 'admin'),
(214, '', 'index.php', '2021-06-03 15:10:15', 12, 'admin'),
(215, '', 'index.php', '2021-06-03 15:11:01', 12, 'admin'),
(216, '', 'index.php', '2021-06-03 15:11:38', 12, 'admin'),
(217, '', 'index.php', '2021-06-03 15:12:18', 12, 'admin'),
(218, '', 'index.php', '2021-06-03 15:12:54', 12, 'admin'),
(219, '', 'index.php', '2021-06-03 15:13:21', 12, 'admin'),
(220, '', 'index.php', '2021-06-03 15:14:07', 12, 'admin'),
(221, '', 'index.php', '2021-06-03 15:14:51', 12, 'admin'),
(222, '', 'tematike.php', '2021-06-03 15:15:02', 12, 'admin'),
(223, '', 'index.php', '2021-06-03 15:15:50', 12, 'admin'),
(224, '', 'tematike.php', '2021-06-03 15:15:56', 12, 'admin'),
(225, '', 'postavke.php', '2021-06-03 15:15:58', 12, 'admin'),
(226, '', 'dnevnik.php', '2021-06-03 15:16:02', 12, 'admin'),
(227, '', 'moje_tematike.php', '2021-06-03 15:16:05', 12, 'admin'),
(228, '', 'index.php', '2021-06-03 15:16:09', 12, 'admin'),
(229, '', 'postavke.php', '2021-06-03 15:16:52', 12, 'admin'),
(230, '', 'postavke.php', '2021-06-03 15:17:41', 12, 'admin'),
(231, '', 'postavke.php', '2021-06-03 15:18:26', 12, 'admin'),
(232, '', 'dnevnik.php', '2021-06-03 15:18:37', 12, 'admin'),
(233, '', 'moje_tematike.php', '2021-06-03 15:18:59', 12, 'admin'),
(234, '', '', '2021-06-03 15:19:08', 11, 'admin'),
(235, '', 'prijava.php', '2021-06-03 15:19:22', 2, 'admin'),
(236, '', 'index.php', '2021-06-03 15:19:22', 12, 'admin'),
(237, '', '', '2021-06-03 15:20:04', 11, 'admin'),
(238, '', 'prijava.php', '2021-06-03 15:20:10', 2, 'admin'),
(239, '', 'index.php', '2021-06-03 15:20:10', 12, 'admin'),
(240, '', 'postavke.php', '2021-06-03 15:28:29', 12, 'admin'),
(241, '', 'index.php', '2021-06-03 15:28:34', 12, 'admin'),
(242, '', 'index.php', '2021-06-03 15:31:27', 12, 'admin'),
(243, '', 'index.php', '2021-06-03 15:32:19', 12, 'admin'),
(244, '', 'tematike.php', '2021-06-03 15:32:30', 12, 'admin'),
(245, '', 'index.php', '2021-06-03 15:32:48', 12, 'admin'),
(246, '', 'izlozba.php', '2021-06-03 15:32:52', 12, 'admin'),
(247, 'izlozba_id: 1', 'galerija.php', '2021-06-03 15:33:13', 12, 'admin'),
(248, '', 'index.php', '2021-06-03 15:33:31', 12, 'admin'),
(249, '', 'index.php', '2021-06-03 15:39:47', 12, 'admin'),
(250, '', '', '2021-06-03 15:39:53', 11, 'admin'),
(253, '', 'prijava.php', '2021-06-03 15:50:48', 2, 'admin'),
(254, '', 'index.php', '2021-06-03 15:50:48', 12, 'admin'),
(255, '', 'izlozba.php', '2021-06-03 16:05:57', 12, 'admin'),
(256, '', 'index.php', '2021-06-03 16:05:59', 12, 'admin'),
(257, '', 'izlozba.php', '2021-06-03 16:06:03', 12, 'admin'),
(258, '', 'index.php', '2021-06-03 16:14:20', 12, 'admin'),
(259, '', 'index.php', '2021-06-03 16:14:50', 12, 'admin'),
(260, '', 'index.php', '2021-06-03 16:28:17', 12, 'admin'),
(261, '', 'index.php', '2021-06-03 16:29:09', 12, 'admin'),
(262, '', 'index.php', '2021-06-03 16:29:12', 12, 'admin'),
(263, '', 'index.php', '2021-06-03 16:29:16', 12, 'admin'),
(264, '', 'index.php', '2021-06-03 16:29:34', 12, 'admin'),
(265, '', 'index.php', '2021-06-03 16:29:57', 12, 'admin'),
(266, '', 'index.php', '2021-06-03 16:29:58', 12, 'admin'),
(267, '', 'index.php', '2021-06-03 16:30:01', 12, 'admin'),
(268, '', 'index.php', '2021-06-03 16:30:04', 12, 'admin'),
(269, '', 'index.php', '2021-06-03 16:30:05', 12, 'admin'),
(270, '', 'index.php', '2021-06-03 16:30:07', 12, 'admin'),
(271, '', 'index.php', '2021-06-03 16:30:08', 12, 'admin'),
(272, '', 'index.php', '2021-06-03 16:31:43', 12, 'admin'),
(273, '', 'index.php', '2021-06-03 16:31:46', 12, 'admin'),
(274, '', 'index.php', '2021-06-03 16:31:46', 12, 'admin'),
(275, '', 'index.php', '2021-06-03 16:31:53', 12, 'admin'),
(276, '', 'index.php', '2021-06-03 16:31:53', 12, 'admin'),
(277, '', 'index.php', '2021-06-03 16:35:43', 12, 'admin'),
(278, '', 'index.php', '2021-06-03 16:35:44', 12, 'admin'),
(279, '', 'index.php', '2021-06-03 16:35:51', 12, 'admin'),
(280, '', 'index.php', '2021-06-03 16:35:51', 12, 'admin'),
(281, '', 'index.php', '2021-06-03 16:35:52', 12, 'admin'),
(282, '', 'index.php', '2021-06-03 16:35:52', 12, 'admin'),
(283, '', 'index.php', '2021-06-03 16:35:53', 12, 'admin'),
(284, '', 'index.php', '2021-06-03 16:35:53', 12, 'admin'),
(285, '', 'index.php', '2021-06-03 16:35:53', 12, 'admin'),
(286, '', 'index.php', '2021-06-03 16:35:53', 12, 'admin'),
(287, '', 'index.php', '2021-06-03 16:35:54', 12, 'admin'),
(288, '', 'index.php', '2021-06-03 16:35:54', 12, 'admin'),
(289, '', 'index.php', '2021-06-03 16:35:55', 12, 'admin'),
(290, '', 'index.php', '2021-06-03 16:35:55', 12, 'admin'),
(291, '', 'index.php', '2021-06-03 16:35:56', 12, 'admin'),
(292, '', 'index.php', '2021-06-03 16:35:56', 12, 'admin'),
(293, '', 'postavke.php', '2021-06-03 16:35:58', 12, 'admin'),
(294, '', 'index.php', '2021-06-03 16:36:01', 12, 'admin'),
(295, '', 'index.php', '2021-06-03 16:44:16', 12, 'admin'),
(296, '', 'index.php', '2021-06-03 16:44:21', 12, 'admin'),
(297, '', 'index.php', '2021-06-03 16:44:21', 12, 'admin'),
(298, '', 'index.php', '2021-06-03 16:44:26', 12, 'admin'),
(299, '', 'index.php', '2021-06-03 16:44:26', 12, 'admin'),
(300, '', 'index.php', '2021-06-03 16:44:28', 12, 'admin'),
(301, '', 'index.php', '2021-06-03 16:44:28', 12, 'admin'),
(302, '', 'index.php', '2021-06-03 16:44:29', 12, 'admin'),
(303, '', 'index.php', '2021-06-03 16:44:29', 12, 'admin'),
(304, '', 'index.php', '2021-06-03 16:44:30', 12, 'admin'),
(305, '', 'index.php', '2021-06-03 16:44:30', 12, 'admin'),
(306, '', 'index.php', '2021-06-03 16:44:31', 12, 'admin'),
(307, '', 'index.php', '2021-06-03 16:44:31', 12, 'admin'),
(308, '', 'index.php', '2021-06-03 16:44:33', 12, 'admin'),
(309, '', 'index.php', '2021-06-03 16:44:33', 12, 'admin'),
(310, '', 'index.php', '2021-06-03 16:44:35', 12, 'admin'),
(311, '', 'index.php', '2021-06-03 16:44:35', 12, 'admin'),
(312, '', 'index.php', '2021-06-03 16:44:37', 12, 'admin'),
(313, '', 'index.php', '2021-06-03 16:44:37', 12, 'admin'),
(314, '', 'index.php', '2021-06-03 16:44:40', 12, 'admin'),
(315, '', 'index.php', '2021-06-03 16:44:40', 12, 'admin'),
(316, '', 'index.php', '2021-06-03 16:44:48', 12, 'admin'),
(317, '', 'index.php', '2021-06-03 16:44:48', 12, 'admin'),
(318, '', 'index.php', '2021-06-03 16:45:27', 12, 'admin'),
(319, '', 'index.php', '2021-06-03 16:45:29', 12, 'admin'),
(320, '', 'index.php', '2021-06-03 16:45:29', 12, 'admin'),
(321, '', 'index.php', '2021-06-03 16:45:36', 12, 'admin'),
(322, '', 'index.php', '2021-06-03 16:45:37', 12, 'admin'),
(323, '', 'index.php', '2021-06-03 16:46:11', 12, 'admin'),
(324, '', 'index.php', '2021-06-03 16:46:13', 12, 'admin'),
(325, '', 'index.php', '2021-06-03 16:46:42', 12, 'admin'),
(326, '', 'index.php', '2021-06-03 16:47:03', 12, 'admin'),
(327, '', 'index.php', '2021-06-03 16:47:14', 12, 'admin'),
(328, '', 'index.php', '2021-06-03 16:47:14', 12, 'admin'),
(329, '', 'index.php', '2021-06-03 16:47:16', 12, 'admin'),
(330, '', 'index.php', '2021-06-03 16:47:16', 12, 'admin'),
(331, '', 'index.php', '2021-06-03 16:53:04', 12, 'admin'),
(332, '', 'index.php', '2021-06-03 16:53:04', 12, 'admin'),
(333, '', 'postavke.php', '2021-06-03 16:53:05', 12, 'admin'),
(334, '', 'tematike.php', '2021-06-03 16:53:06', 12, 'admin'),
(335, '', 'dnevnik.php', '2021-06-03 16:53:09', 12, 'admin'),
(336, '', 'moje_tematike.php', '2021-06-03 16:53:10', 12, 'admin'),
(337, '', 'index.php', '2021-06-03 16:53:11', 12, 'admin'),
(338, '', 'izlozba.php', '2021-06-03 16:53:13', 12, 'admin'),
(339, 'izlozba_id: 1', 'galerija.php', '2021-06-03 16:53:15', 12, 'admin'),
(340, '', '', '2021-06-03 16:53:19', 11, 'admin'),
(341, '', 'prijava.php', '2021-06-03 16:53:27', 2, 'admin'),
(342, '', 'index.php', '2021-06-03 16:53:27', 12, 'admin'),
(343, '', 'index.php', '2021-06-03 16:53:31', 12, 'admin'),
(344, '', 'index.php', '2021-06-03 16:53:31', 12, 'admin'),
(345, '', 'index.php', '2021-06-03 17:02:39', 12, 'admin'),
(346, '', 'index.php', '2021-06-03 17:02:46', 12, 'admin'),
(347, '', 'index.php', '2021-06-03 17:02:55', 12, 'admin'),
(348, '', 'index.php', '2021-06-03 17:02:55', 12, 'admin'),
(349, '', 'index.php', '2021-06-03 17:03:06', 12, 'admin'),
(350, '', 'index.php', '2021-06-03 17:03:06', 12, 'admin'),
(351, '', 'index.php', '2021-06-03 17:03:08', 12, 'admin'),
(352, '', 'index.php', '2021-06-03 17:03:08', 12, 'admin'),
(353, '', 'izlozba.php', '2021-06-03 17:08:06', 12, 'admin'),
(354, 'izlozba_id: 1', 'galerija.php', '2021-06-03 17:08:10', 12, 'admin'),
(355, '', 'index.php', '2021-06-03 17:11:40', 12, 'admin'),
(356, '', 'index.php', '2021-06-03 17:13:35', 12, 'admin'),
(357, '', 'index.php', '2021-06-03 17:13:38', 12, 'admin'),
(358, '', 'index.php', '2021-06-03 17:14:05', 12, 'admin'),
(359, '', 'index.php', '2021-06-03 17:16:41', 12, 'admin'),
(360, '', 'index.php', '2021-06-03 17:18:47', 12, 'admin'),
(361, '', 'index.php', '2021-06-03 17:22:32', 12, 'admin'),
(362, '', 'prijava.php', '2021-06-03 19:27:10', 2, 'admin'),
(363, '', 'index.php', '2021-06-03 19:27:10', 12, 'admin'),
(364, '', 'postavke.php', '2021-06-03 19:27:13', 12, 'admin'),
(365, '', '', '2021-06-03 20:11:13', 1, 'jsusnjara'),
(366, '', 'prijava.php', '2021-06-03 20:11:23', 2, 'admin'),
(367, '', 'index.php', '2021-06-03 20:11:23', 12, 'admin'),
(368, '', 'index.php', '2021-06-03 20:11:27', 12, 'admin'),
(369, '', 'index.php', '2021-06-03 20:11:27', 12, 'admin'),
(370, '', 'index.php', '2021-06-03 20:11:28', 12, 'admin'),
(371, '', 'index.php', '2021-06-03 20:11:29', 12, 'admin'),
(372, '', 'index.php', '2021-06-03 20:11:30', 12, 'admin'),
(373, '', 'index.php', '2021-06-03 20:11:30', 12, 'admin'),
(374, '', 'index.php', '2021-06-03 20:11:33', 12, 'admin'),
(375, '', 'index.php', '2021-06-03 20:11:33', 12, 'admin'),
(376, '', 'index.php', '2021-06-03 20:11:34', 12, 'admin'),
(377, '', 'index.php', '2021-06-03 20:11:34', 12, 'admin'),
(378, '', 'index.php', '2021-06-03 20:16:21', 12, 'admin'),
(379, '', 'moje_tematike.php', '2021-06-03 20:20:01', 12, 'admin'),
(380, '', 'dnevnik.php', '2021-06-03 20:20:05', 12, 'admin'),
(381, '', 'postavke.php', '2021-06-03 20:20:07', 12, 'admin'),
(382, '', 'tematike.php', '2021-06-03 20:20:10', 12, 'admin'),
(383, '', 'tematike.php', '2021-06-03 20:20:13', 12, 'admin'),
(384, '', 'tematike.php', '2021-06-03 20:20:16', 12, 'admin'),
(385, '', 'tematike.php', '2021-06-03 20:22:32', 12, 'admin'),
(386, '', 'index.php', '2021-06-03 20:22:33', 12, 'admin'),
(387, '', 'index.php', '2021-06-03 20:22:35', 12, 'admin'),
(388, '', 'index.php', '2021-06-03 20:24:07', 12, 'admin'),
(389, '', 'index.php', '2021-06-03 20:24:41', 12, 'admin'),
(390, '', 'index.php', '2021-06-03 20:25:56', 12, 'admin'),
(391, '', 'izlozba.php', '2021-06-03 20:25:58', 12, 'admin'),
(392, '', 'moje_tematike.php', '2021-06-03 20:26:01', 12, 'admin'),
(393, '', 'tematike.php', '2021-06-03 20:26:03', 12, 'admin'),
(394, '', 'tematike.php', '2021-06-03 20:26:06', 12, 'admin'),
(395, '', 'postavke.php', '2021-06-03 20:26:08', 12, 'admin'),
(396, '', 'postavke.php', '2021-06-03 20:26:16', 12, 'admin'),
(397, '', 'index.php', '2021-06-03 20:26:17', 12, 'admin'),
(398, '', 'index.php', '2021-06-03 20:42:55', 12, 'admin'),
(399, '', 'index.php', '2021-06-03 20:46:56', 12, 'admin'),
(400, '', 'index.php', '2021-06-03 20:47:22', 12, 'admin'),
(401, '', '', '2021-06-03 20:47:29', 11, 'admin'),
(402, '', 'prijava.php', '2021-06-03 20:49:44', 3, 'admin'),
(403, '', 'prijava.php', '2021-06-03 20:49:51', 2, 'admin'),
(404, '', 'index.php', '2021-06-03 20:49:51', 12, 'admin'),
(405, '', 'izlozba.php', '2021-06-03 20:49:53', 12, 'admin'),
(406, 'izlozba_id: 1', 'galerija.php', '2021-06-03 20:49:54', 12, 'admin'),
(407, 'izlozba_id: 1', 'galerija.php', '2021-06-03 20:50:02', 12, 'admin'),
(408, 'izlozba_id: 1', 'galerija.php', '2021-06-03 20:50:05', 12, 'admin'),
(409, 'izlozba_id: 1', 'galerija.php', '2021-06-03 20:50:07', 12, 'admin'),
(410, '', 'tematike.php', '2021-06-03 20:50:09', 12, 'admin'),
(411, '', 'postavke.php', '2021-06-03 20:50:13', 12, 'admin'),
(412, '', 'tematike.php', '2021-06-03 20:50:15', 12, 'admin'),
(413, '', 'dnevnik.php', '2021-06-03 20:50:17', 12, 'admin'),
(414, '', 'moje_tematike.php', '2021-06-03 20:50:18', 12, 'admin'),
(415, '', 'dnevnik.php', '2021-06-03 20:50:20', 12, 'admin'),
(416, '', 'postavke.php', '2021-06-03 20:50:21', 12, 'admin'),
(417, '', 'tematike.php', '2021-06-03 20:50:22', 12, 'admin'),
(418, '', 'postavke.php', '2021-06-03 20:50:25', 12, 'admin'),
(419, '', 'index.php', '2021-06-03 20:50:47', 12, 'admin'),
(420, '', 'index.php', '2021-06-03 20:50:49', 12, 'admin'),
(421, '', 'index.php', '2021-06-03 20:50:52', 12, 'admin'),
(422, '', 'tematike.php', '2021-06-03 20:50:53', 12, 'admin'),
(423, '', 'postavke.php', '2021-06-03 20:50:54', 12, 'admin'),
(424, '', 'dnevnik.php', '2021-06-03 20:50:56', 12, 'admin'),
(425, '', 'moje_tematike.php', '2021-06-03 20:50:58', 12, 'admin'),
(426, '', 'izlozbe.php', '2021-06-03 20:51:01', 12, 'admin'),
(427, '', '', '2021-06-03 20:51:04', 11, 'admin'),
(428, '', 'prijava.php', '2021-06-04 07:14:33', 2, 'admin'),
(429, '', 'index.php', '2021-06-04 07:14:33', 12, 'admin'),
(430, '', 'index.php', '2021-06-04 07:15:22', 12, 'admin'),
(431, '', 'index.php', '2021-06-04 07:15:22', 12, 'admin'),
(432, '', '', '2021-06-04 07:17:10', 11, 'admin'),
(433, '', 'prijava.php', '2021-06-06 22:52:20', 2, 'admin'),
(434, '', 'index.php', '2021-06-06 22:52:20', 12, 'admin'),
(435, '', 'tematike.php', '2021-06-06 22:54:00', 12, 'admin'),
(436, 'tematika: Retro vlakovi', 'tematike.php', '2021-06-06 22:55:05', 15, 'admin'),
(437, 'tematika: Vlakovi - Europa', 'tematike.php', '2021-06-06 22:56:00', 15, 'admin'),
(438, 'tematika: Vlakovi - Azija', 'tematike.php', '2021-06-06 22:56:25', 15, 'admin'),
(439, 'tematika: Vlakovi - Amerike', 'tematike.php', '2021-06-06 22:57:12', 15, 'admin'),
(440, 'tematika: Vlakovi - Afrika', 'tematike.php', '2021-06-06 22:57:53', 15, 'admin'),
(441, 'tematika: Vlakovi - Australija', 'tematike.php', '2021-06-06 22:58:25', 15, 'admin'),
(442, '', 'moje_tematike.php', '2021-06-06 22:58:36', 12, 'admin'),
(443, '', 'izlozbe.php', '2021-06-06 23:00:53', 12, 'admin'),
(444, '', 'moje_tematike.php', '2021-06-06 23:00:57', 12, 'admin'),
(445, '', 'izlozbe.php', '2021-06-06 23:01:03', 12, 'admin'),
(446, 'izložba: Električni vlakovi', 'izlozbe.php', '2021-06-06 23:01:31', 17, 'admin'),
(447, 'izložba: Dizel vlakovi', 'izlozbe.php', '2021-06-06 23:02:04', 17, 'admin'),
(448, '', 'moje_tematike.php', '2021-06-06 23:02:21', 12, 'admin'),
(449, '', 'izlozbe.php', '2021-06-06 23:02:23', 12, 'admin'),
(450, 'izložba: Francuski vlakovi budućnosti', 'izlozbe.php', '2021-06-06 23:03:10', 17, 'admin'),
(451, '', 'index.php', '2021-06-06 23:03:14', 12, 'admin'),
(452, '', 'izlozba.php', '2021-06-06 23:03:26', 12, 'admin'),
(453, '', 'index.php', '2021-06-06 23:03:31', 12, 'admin'),
(454, '', 'izlozba.php', '2021-06-06 23:03:33', 12, 'admin'),
(455, '', 'index.php', '2021-06-06 23:03:36', 12, 'admin'),
(456, '', 'izlozba.php', '2021-06-06 23:03:49', 12, 'admin'),
(457, '', 'index.php', '2021-06-06 23:03:59', 12, 'admin'),
(458, '', 'index.php', '2021-06-06 23:04:03', 12, 'admin'),
(459, '', 'index.php', '2021-06-06 23:04:03', 12, 'admin'),
(460, '', 'index.php', '2021-06-06 23:04:10', 12, 'admin'),
(461, '', 'index.php', '2021-06-06 23:04:11', 12, 'admin'),
(462, '', 'index.php', '2021-06-06 23:04:18', 12, 'admin'),
(463, '', 'index.php', '2021-06-06 23:04:18', 12, 'admin'),
(464, '', 'index.php', '2021-06-06 23:04:23', 12, 'admin'),
(465, '', 'index.php', '2021-06-06 23:04:23', 12, 'admin'),
(466, '', 'index.php', '2021-06-06 23:04:24', 12, 'admin'),
(467, '', 'index.php', '2021-06-06 23:04:24', 12, 'admin'),
(468, '', 'index.php', '2021-06-06 23:04:27', 12, 'admin'),
(469, '', 'postavke.php', '2021-06-06 23:04:49', 12, 'admin'),
(470, '', 'prijava.php', '2021-06-07 09:30:15', 2, 'admin'),
(471, '', 'index.php', '2021-06-07 09:30:15', 12, 'admin'),
(472, '', 'izlozba.php', '2021-06-07 09:30:21', 12, 'admin'),
(473, '', '', '2021-06-07 09:35:37', 11, 'admin'),
(474, '', '', '2021-06-07 09:36:13', 1, 'admin2'),
(475, '', 'prijava.php', '2021-06-07 09:39:03', 2, 'admin'),
(476, '', 'index.php', '2021-06-07 09:39:03', 12, 'admin'),
(477, '', 'moje_tematike.php', '2021-06-07 09:39:45', 12, 'admin'),
(478, '', 'index.php', '2021-06-07 09:39:47', 12, 'admin'),
(479, '', 'izlozba.php', '2021-06-07 09:39:55', 12, 'admin'),
(480, '', 'index.php', '2021-06-07 09:43:12', 12, 'admin'),
(481, '', 'izlozba.php', '2021-06-07 09:43:16', 12, 'admin'),
(482, '', 'index.php', '2021-06-07 09:43:20', 12, 'admin'),
(483, '', 'index.php', '2021-06-07 09:44:23', 12, 'admin'),
(484, '', 'izlozba.php', '2021-06-07 09:44:27', 12, 'admin'),
(485, '', 'index.php', '2021-06-07 09:46:03', 12, 'admin'),
(486, '', '', '2021-06-07 09:52:10', 11, 'admin'),
(487, '', 'prijava.php', '2021-06-07 09:52:43', 2, 'aantic'),
(488, '', 'index.php', '2021-06-07 09:52:43', 12, 'aantic'),
(489, '', 'izlozba.php', '2021-06-07 09:52:49', 12, 'aantic'),
(490, '', 'index.php', '2021-06-07 09:52:52', 12, 'aantic'),
(491, '', 'izlozba.php', '2021-06-07 09:52:53', 12, 'aantic'),
(492, '', '', '2021-06-07 09:52:59', 11, 'aantic'),
(493, '', 'prijava.php', '2021-06-07 09:53:04', 2, 'admin'),
(494, '', 'index.php', '2021-06-07 09:53:04', 12, 'admin'),
(495, '', 'moje_tematike.php', '2021-06-07 09:53:09', 12, 'admin'),
(496, '', 'izlozbe.php', '2021-06-07 09:53:11', 12, 'admin'),
(497, 'izložba: Ruski vlakovi', 'izlozbe.php', '2021-06-07 09:53:31', 18, 'admin'),
(498, '', '', '2021-06-07 09:53:34', 11, 'admin'),
(499, '', 'prijava.php', '2021-06-07 09:53:44', 2, 'aantic'),
(500, '', 'index.php', '2021-06-07 09:53:44', 12, 'aantic'),
(501, '', 'izlozba.php', '2021-06-07 09:53:48', 12, 'aantic'),
(502, 'vlak: Sokolniki', 'izlozba.php', '2021-06-07 09:54:46', 20, 'aantic'),
(503, '', '', '2021-06-07 09:54:55', 11, 'aantic'),
(504, '', 'prijava.php', '2021-06-07 09:55:08', 2, 'iivic'),
(505, '', 'index.php', '2021-06-07 09:55:08', 12, 'iivic'),
(506, '', 'izlozba.php', '2021-06-07 09:55:12', 12, 'iivic'),
(507, 'vlak: Retro train, St. Petersburg', 'izlozba.php', '2021-06-07 09:56:22', 20, 'iivic'),
(508, '', '', '2021-06-07 09:56:24', 11, 'iivic'),
(509, '', 'prijava.php', '2021-06-07 09:56:53', 2, 'pperic'),
(510, '', 'index.php', '2021-06-07 09:56:53', 12, 'pperic'),
(511, '', 'izlozba.php', '2021-06-07 09:56:57', 12, 'pperic'),
(512, 'vlak: The Ruskeala Express', 'izlozba.php', '2021-06-07 09:57:55', 20, 'pperic'),
(513, '', '', '2021-06-07 09:58:05', 11, 'pperic'),
(514, '', 'prijava.php', '2021-06-07 09:58:39', 2, 'jsusnjara2'),
(515, '', 'index.php', '2021-06-07 09:58:39', 12, 'jsusnjara2'),
(516, '', 'izlozba.php', '2021-06-07 09:58:43', 12, 'jsusnjara2'),
(517, 'vlak: Bologoye-Ostashkov', 'izlozba.php', '2021-06-07 09:59:32', 20, 'jsusnjara2'),
(518, '', '', '2021-06-07 09:59:39', 11, 'jsusnjara2'),
(519, '', 'prijava.php', '2021-06-07 09:59:49', 2, 'moderator1'),
(520, '', 'index.php', '2021-06-07 09:59:49', 12, 'moderator1'),
(521, '', 'izlozba.php', '2021-06-07 09:59:54', 12, 'moderator1'),
(522, '', 'moje_tematike.php', '2021-06-07 09:59:59', 12, 'moderator1'),
(523, '', '', '2021-06-07 10:00:05', 11, 'moderator1'),
(524, '', 'prijava.php', '2021-06-07 10:00:33', 2, 'admin'),
(525, '', 'index.php', '2021-06-07 10:00:33', 12, 'admin'),
(526, '', 'moje_tematike.php', '2021-06-07 10:00:39', 12, 'admin'),
(527, '', 'tematike.php', '2021-06-07 10:00:46', 12, 'admin'),
(528, 'tematika: Lokomotive', 'tematike.php', '2021-06-07 10:00:53', 16, 'admin'),
(529, '', '', '2021-06-07 10:00:56', 11, 'admin'),
(530, '', 'prijava.php', '2021-06-07 10:01:04', 2, 'moderator1'),
(531, '', 'index.php', '2021-06-07 10:01:04', 12, 'moderator1'),
(532, '', 'izlozba.php', '2021-06-07 10:01:07', 12, 'moderator1'),
(533, 'prijava: 27', 'izlozba.php', '2021-06-07 10:01:09', 21, 'moderator1'),
(534, 'prijava: 28', 'izlozba.php', '2021-06-07 10:01:10', 21, 'moderator1'),
(535, 'prijava: 29', 'izlozba.php', '2021-06-07 10:01:11', 21, 'moderator1'),
(536, 'prijava: 30', 'izlozba.php', '2021-06-07 10:01:15', 21, 'moderator1'),
(537, '', 'index.php', '2021-06-07 10:01:23', 12, 'moderator1'),
(538, '', 'izlozba.php', '2021-06-07 10:01:25', 12, 'moderator1'),
(539, '', '', '2021-06-07 10:01:29', 11, 'moderator1'),
(540, '', 'prijava.php', '2021-06-07 10:01:38', 2, 'aantic'),
(541, '', 'index.php', '2021-06-07 10:01:38', 12, 'aantic'),
(542, '', 'izlozba.php', '2021-06-07 10:01:41', 12, 'aantic'),
(543, 'materijal: datoteke/aantic/b6e3d331b8a3fd27a2963bbf19e9acc2.jpg', 'izlozba.php', '2021-06-07 10:12:00', 23, 'aantic'),
(544, '', 'izlozba.php', '2021-06-07 10:12:23', 12, 'aantic'),
(545, 'izlozba_id: 2', 'galerija.php', '2021-06-07 10:12:27', 12, 'aantic'),
(546, '', 'izlozba.php', '2021-06-07 10:12:29', 12, 'aantic'),
(547, '', 'index.php', '2021-06-07 10:12:32', 12, 'aantic'),
(548, '', 'izlozba.php', '2021-06-07 10:12:33', 12, 'aantic'),
(549, 'materijal: datoteke/aantic/Sokolniki__retro_train_at(5089430034).jpg', 'izlozba.php', '2021-06-07 10:14:11', 23, 'aantic'),
(550, '', '', '2021-06-07 10:14:22', 11, 'aantic'),
(551, '', 'prijava.php', '2021-06-07 10:14:34', 2, 'iivic'),
(552, '', 'index.php', '2021-06-07 10:14:34', 12, 'iivic'),
(553, '', 'izlozba.php', '2021-06-07 10:14:38', 12, 'iivic'),
(554, 'materijal: datoteke/iivic/5dd3d1a485600a6c2e4bf669.jpg', 'izlozba.php', '2021-06-07 10:15:43', 23, 'iivic'),
(555, '', '', '2021-06-07 10:15:46', 11, 'iivic'),
(556, '', 'prijava.php', '2021-06-07 10:15:56', 2, 'pperic'),
(557, '', 'index.php', '2021-06-07 10:15:56', 12, 'pperic'),
(558, '', 'izlozba.php', '2021-06-07 10:16:00', 12, 'pperic'),
(559, 'materijal: datoteke/pperic/EgVbO9NWkAMuSfn.jpg', 'izlozba.php', '2021-06-07 10:17:17', 23, 'pperic'),
(560, 'materijal: datoteke/pperic/uzwwzqzd8ch41.jpg', 'izlozba.php', '2021-06-07 10:17:29', 23, 'pperic'),
(561, 'materijal: datoteke/pperic/74677088_2537742326314345_780558723490775040_n.jpg', 'izlozba.php', '2021-06-07 10:18:28', 23, 'pperic'),
(562, '', '', '2021-06-07 10:18:31', 11, 'pperic'),
(563, '', 'prijava.php', '2021-06-07 10:18:40', 2, 'jsusnjara2'),
(564, '', 'index.php', '2021-06-07 10:18:40', 12, 'jsusnjara2'),
(565, '', 'izlozba.php', '2021-06-07 10:18:44', 12, 'jsusnjara2'),
(566, 'materijal: datoteke/jsusnjara2/5dd3d18d15e9f97a842ec00a.jpg', 'izlozba.php', '2021-06-07 10:22:30', 23, 'jsusnjara2'),
(567, 'materijal: datoteke/jsusnjara2/49388713403_1178598990_b.jpg', 'izlozba.php', '2021-06-07 10:22:40', 23, 'jsusnjara2'),
(568, 'izlozba_id: 2', 'galerija.php', '2021-06-07 10:22:41', 12, 'jsusnjara2'),
(569, 'izlozba_id: 2', 'galerija.php', '2021-06-07 10:23:16', 12, 'jsusnjara2'),
(570, '', '', '2021-06-07 10:23:26', 11, 'jsusnjara2'),
(571, '', 'prijava.php', '2021-06-07 10:25:36', 2, 'jsusnjara'),
(572, '', 'index.php', '2021-06-07 10:25:36', 12, 'jsusnjara'),
(573, '', 'izlozba.php', '2021-06-07 10:25:41', 12, 'jsusnjara'),
(574, '', '', '2021-06-07 10:25:45', 11, 'jsusnjara'),
(575, '', 'prijava.php', '2021-06-07 10:25:50', 2, 'admin'),
(576, '', 'index.php', '2021-06-07 10:25:50', 12, 'admin'),
(577, '', 'tematike.php', '2021-06-07 10:25:54', 12, 'admin'),
(578, '', 'moje_tematike.php', '2021-06-07 10:26:01', 12, 'admin'),
(579, '', 'izlozbe.php', '2021-06-07 10:26:02', 12, 'admin'),
(580, 'izložba: Americki vlakovi', 'izlozbe.php', '2021-06-07 10:26:22', 18, 'admin'),
(581, '', 'index.php', '2021-06-07 10:26:25', 12, 'admin'),
(582, '', '', '2021-06-07 10:26:34', 11, 'admin'),
(583, '', 'prijava.php', '2021-06-07 10:26:43', 2, 'jsusnjara'),
(584, '', 'index.php', '2021-06-07 10:26:43', 12, 'jsusnjara'),
(585, '', 'izlozba.php', '2021-06-07 10:26:46', 12, 'jsusnjara'),
(586, 'vlak: NRE 2GS14B', 'izlozba.php', '2021-06-07 10:27:23', 20, 'jsusnjara'),
(587, '', '', '2021-06-07 10:27:26', 11, 'jsusnjara'),
(588, '', 'prijava.php', '2021-06-07 10:27:31', 2, 'admin'),
(589, '', 'index.php', '2021-06-07 10:27:31', 12, 'admin'),
(590, '', 'izlozba.php', '2021-06-07 10:27:35', 12, 'admin'),
(591, 'prijava: 31', 'izlozba.php', '2021-06-07 10:27:38', 21, 'admin'),
(592, '', '', '2021-06-07 10:27:39', 11, 'admin'),
(593, '', 'prijava.php', '2021-06-07 10:27:46', 2, 'jsusnjara'),
(594, '', 'index.php', '2021-06-07 10:27:46', 12, 'jsusnjara'),
(595, '', 'izlozba.php', '2021-06-07 10:27:48', 12, 'jsusnjara'),
(596, 'materijal: datoteke/jsusnjara/showimage.jpeg', 'izlozba.php', '2021-06-07 10:28:43', 23, 'jsusnjara'),
(597, 'materijal: datoteke/jsusnjara/showimage (1).jpeg', 'izlozba.php', '2021-06-07 10:28:52', 23, 'jsusnjara'),
(598, 'izlozba_id: 1', 'galerija.php', '2021-06-07 10:28:54', 12, 'jsusnjara'),
(599, 'izlozba_id: 1', 'galerija.php', '2021-06-07 10:29:00', 12, 'jsusnjara'),
(600, '', '', '2021-06-07 10:29:04', 11, 'jsusnjara'),
(601, '', 'prijava.php', '2021-06-07 10:29:12', 2, 'admin'),
(602, '', 'index.php', '2021-06-07 10:29:12', 12, 'admin'),
(603, '', 'moje_tematike.php', '2021-06-07 10:29:22', 12, 'admin'),
(604, '', 'izlozbe.php', '2021-06-07 10:29:25', 12, 'admin'),
(605, 'izložba: Americki vlakovi', 'izlozbe.php', '2021-06-07 10:29:35', 18, 'admin'),
(606, '', 'index.php', '2021-06-07 10:29:37', 12, 'admin'),
(607, '', '', '2021-06-07 10:29:42', 11, 'admin'),
(608, '', 'prijava.php', '2021-06-07 15:36:37', 2, 'admin'),
(609, '', 'index.php', '2021-06-07 15:36:37', 12, 'admin'),
(610, '', 'postavke.php', '2021-06-07 15:36:41', 12, 'admin'),
(611, '', 'tematike.php', '2021-06-07 15:44:17', 12, 'admin'),
(612, '', 'moje_tematike.php', '2021-06-07 15:45:09', 12, 'admin'),
(613, '', 'izlozbe.php', '2021-06-07 15:45:40', 12, 'admin'),
(614, '', 'prijava.php', '2021-06-07 15:47:03', 2, 'jsusnjara'),
(615, '', 'index.php', '2021-06-07 15:47:03', 12, 'jsusnjara'),
(616, '', 'izlozba.php', '2021-06-07 15:47:11', 12, 'jsusnjara'),
(617, '', 'izlozba.php', '2021-06-07 15:49:03', 12, 'admin'),
(618, '', 'index.php', '2021-06-07 16:19:39', 12, 'admin'),
(619, '', 'izlozba.php', '2021-06-07 16:19:43', 12, 'admin'),
(620, 'izlozba_id: 1', 'galerija.php', '2021-06-07 16:19:44', 12, 'admin'),
(621, 'izlozba_id: 1', 'galerija.php', '2021-06-07 16:19:52', 12, 'admin'),
(622, 'izlozba_id: 1', 'galerija.php', '2021-06-07 16:19:54', 12, 'admin'),
(623, 'izlozba_id: 1', 'galerija.php', '2021-06-07 16:20:34', 12, 'admin'),
(624, 'izlozba_id: 1', 'galerija.php', '2021-06-07 16:20:37', 12, 'admin'),
(625, 'izlozba_id: 1', 'galerija.php', '2021-06-07 16:20:39', 12, 'admin'),
(626, 'izlozba_id: 1', 'galerija.php', '2021-06-07 16:20:42', 12, 'admin'),
(627, 'izlozba_id: 1', 'galerija.php', '2021-06-07 16:21:08', 12, 'admin'),
(628, 'izlozba_id: 1', 'galerija.php', '2021-06-07 16:21:16', 12, 'admin'),
(629, 'izlozba_id: 1', 'galerija.php', '2021-06-07 16:21:18', 12, 'admin'),
(630, '', 'index.php', '2021-06-07 16:22:02', 12, 'admin'),
(631, '', 'moje_tematike.php', '2021-06-07 16:23:36', 12, 'admin'),
(632, '', 'izlozbe.php', '2021-06-07 16:23:38', 12, 'admin'),
(633, '', 'izlozba.php', '2021-06-07 16:24:12', 12, 'admin'),
(634, '', 'dnevnik.php', '2021-06-07 16:27:42', 12, 'admin'),
(635, '', 'dnevnik.php', '2021-06-07 16:27:51', 12, 'admin'),
(636, '', 'dnevnik.php', '2021-06-07 16:28:11', 12, 'admin'),
(637, '', 'dnevnik.php', '2021-06-07 16:28:35', 12, 'admin'),
(638, '', 'dnevnik.php', '2021-06-07 16:29:00', 12, 'admin'),
(639, '', 'dnevnik.php', '2021-06-07 16:29:45', 12, 'admin'),
(640, '', 'dnevnik.php', '2021-06-07 16:31:46', 12, 'admin'),
(641, '', 'postavke.php', '2021-06-07 16:32:05', 12, 'admin'),
(642, '', 'postavke.php', '2021-06-07 16:33:53', 13, 'admin'),
(643, '', 'postavke.php', '2021-06-07 16:37:00', 14, 'admin'),
(644, '', 'index.php', '2021-06-07 16:37:51', 12, 'admin'),
(645, '', '', '2021-06-07 16:38:44', 11, 'jsusnjara'),
(646, '', '', '2021-06-07 17:03:03', 11, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `DZ4_drzava`
--

CREATE TABLE `DZ4_drzava` (
  `drzava_id` int(11) NOT NULL,
  `naziv_drzave` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `DZ4_drzava`
--

INSERT INTO `DZ4_drzava` (`drzava_id`, `naziv_drzave`) VALUES
(1, 'Indija'),
(2, 'Japan'),
(3, 'Kina'),
(4, 'Austrija'),
(5, 'Hrvatska'),
(6, 'Italija'),
(7, 'Njemačka'),
(8, 'Kanada'),
(9, 'SAD');

-- --------------------------------------------------------

--
-- Table structure for table `DZ4_korisnik`
--

CREATE TABLE `DZ4_korisnik` (
  `korisnicko_ime` varchar(25) NOT NULL,
  `ime` varchar(45) DEFAULT NULL,
  `prezime` varchar(45) DEFAULT NULL,
  `lozinka` varchar(25) NOT NULL,
  `sol` char(8) NOT NULL,
  `lozinka_sha256` char(64) NOT NULL,
  `email` varchar(45) NOT NULL,
  `uloga_id` int(11) NOT NULL,
  `datum_registracije` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `DZ4_korisnik`
--

INSERT INTO `DZ4_korisnik` (`korisnicko_ime`, `ime`, `prezime`, `lozinka`, `sol`, `lozinka_sha256`, `email`, `uloga_id`, `datum_registracije`) VALUES
('admin', NULL, NULL, 'admin123', 'shj72a9s', '47776f01e5a99d5f2ae270e370c9f042e7306d0648460025333f777d6db98ccd', 'admin@mail.com', 1, '2021-05-12 00:00:00'),
('jsusnjara', 'Josip', 'Šušnjara', 'jsus1234', 'zff9xak5', '61dfb1b9a8b27a15b8a4e5327eb83d41e57b7ce8d614289ca3152bd65f28076b', 'jsusnjara@foi.hr', 1, '2021-05-12 00:00:00'),
('korisnik', NULL, NULL, 'koris123', 's8q9x8cr', '9285b19678ff254d770f068fc86da2a0e3b1c5505d00235daf8f2572bb351009', 'korisnik@mail.com', 3, '2021-05-12 00:00:00'),
('matnovak', 'matnovak', 'matnovak', 'matnovak', 'xsp7jebn', 'fcb0ccae0cd1d14be45627c6048e546946a584741f31aebf0eb6e5862bf9cc24', 'matnovak@f', 0, '0000-00-00 00:00:00'),
('moderator', NULL, NULL, 'moder123', '1415pi92', '8e798268b75e40d467da97b005129cf5526a0604b3ad8c675c2056671e26e945', 'moderator@mail.com', 2, '2021-05-12 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `DZ4_obrazac`
--

CREATE TABLE `DZ4_obrazac` (
  `obrazac_id` int(11) NOT NULL,
  `ime_i_prezime` varchar(50) NOT NULL,
  `znanstveno_podrucje` varchar(40) NOT NULL,
  `datum_rodjenja` varchar(20) NOT NULL,
  `nobelovac` tinyint(1) NOT NULL,
  `omiljena_boja` char(7) NOT NULL,
  `ocjena` int(11) NOT NULL,
  `vrijeme_unosa` varchar(25) NOT NULL,
  `DZ4_korisnik_korisnicko_ime` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `DZ4_obrazac`
--

INSERT INTO `DZ4_obrazac` (`obrazac_id`, `ime_i_prezime`, `znanstveno_podrucje`, `datum_rodjenja`, `nobelovac`, `omiljena_boja`, `ocjena`, `vrijeme_unosa`, `DZ4_korisnik_korisnicko_ime`) VALUES
(2, 'Nikola Tesla', 'Mehanika', '23.01.1999.', 1, '#26d719', 5, '10:10:10', 'jsusnjara'),
(4, 'test1', 'Kvantna fizika', '11.11.1111.', 0, '#000000', 2, '10:10:10', 'jsusnjara'),
(5, 'test3', 'Astronomija', '11.11.1111.', 1, '#000000', 4, '10:10:10', 'jsusnjara'),
(6, 'test4', 'Kemija', '11.11.1111.', 0, '#000000', 3, '10:10:10', 'moderator'),
(7, 'test5', 'Matematika', '11.11.1111.', 1, '#000000', 1, '10:10:10', 'moderator'),
(11, 'test6', 'Astronomija', '11.11.1111.', 0, '#000000', 2, '10:10:10', 'jsusnjara'),
(12, 'test7', 'Kvantna fizika', '11.11.1111.', 1, '#000000', 4, '10:10:10', 'jsusnjara'),
(13, 'Matija Novak3', 'Mehanika', '12.12.2021.', 1, '#000000', 3, '12:12:12', 'moderator');

-- --------------------------------------------------------

--
-- Table structure for table `DZ4_u_drzavi`
--

CREATE TABLE `DZ4_u_drzavi` (
  `DZ4_obrazac_obrazac_id` int(11) NOT NULL,
  `DZ4_drzava_drzava_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `DZ4_u_drzavi`
--

INSERT INTO `DZ4_u_drzavi` (`DZ4_obrazac_obrazac_id`, `DZ4_drzava_drzava_id`) VALUES
(4, 1),
(13, 1),
(4, 2),
(5, 2),
(11, 2),
(13, 2),
(4, 3),
(5, 3),
(6, 3),
(11, 3),
(12, 3),
(5, 4),
(6, 4),
(11, 4),
(12, 4),
(2, 5),
(11, 5),
(5, 6),
(7, 6),
(11, 6),
(7, 7),
(11, 7),
(5, 8),
(7, 8),
(11, 8),
(2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `glas`
--

CREATE TABLE `glas` (
  `korisnik_korisnicko_ime` varchar(25) NOT NULL,
  `izlozba_id` int(11) NOT NULL,
  `vlak_id` int(11) NOT NULL,
  `komentar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `glas`
--

INSERT INTO `glas` (`korisnik_korisnicko_ime`, `izlozba_id`, `vlak_id`, `komentar`) VALUES
('aantic', 1, 12, NULL),
('admin', 1, 12, NULL),
('iivic', 1, 11, NULL),
('pperic', 1, 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `izlozba`
--

CREATE TABLE `izlozba` (
  `izlozba_id` int(11) NOT NULL,
  `naziv_izlozbe` varchar(50) NOT NULL,
  `datum_pocetka` date NOT NULL,
  `max_prijava` int(11) NOT NULL,
  `status_izlozbe_id` int(11) NOT NULL,
  `tematika_id` int(11) NOT NULL,
  `vlak_pobjednik_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `izlozba`
--

INSERT INTO `izlozba` (`izlozba_id`, `naziv_izlozbe`, `datum_pocetka`, `max_prijava`, `status_izlozbe_id`, `tematika_id`, `vlak_pobjednik_id`) VALUES
(1, 'Americki vlakovi', '2021-07-09', 5, 4, 2, 12),
(2, 'Ruski vlakovi', '2021-07-22', 4, 1, 2, NULL),
(3, 'Juznoamericki vlakovi', '2021-08-17', 1, 3, 2, NULL),
(4, 'Japanski vlakovi', '2021-06-05', 30, 1, 2, NULL),
(6, 'Parni vlakovi', '2021-04-19', 20, 1, 4, NULL),
(8, 'Hrvatski vlakovi', '2021-06-01', 8, 1, 2, NULL),
(9, 'Japanski vlakovi budućnosti', '2021-07-30', 20, 1, 7, NULL),
(10, 'Električni vlakovi', '2021-06-24', 5, 1, 4, NULL),
(11, 'Dizel vlakovi', '2021-06-22', 8, 1, 4, NULL),
(12, 'Francuski vlakovi budućnosti', '2021-06-10', 20, 1, 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `korisnicko_ime` varchar(25) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `lozinka` varchar(25) NOT NULL,
  `sol` char(20) NOT NULL,
  `lozinka_sha256` char(64) NOT NULL,
  `email` varchar(45) NOT NULL,
  `uvjeti` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `uloga_id` int(11) NOT NULL,
  `broj_neuspjesnih_prijava` int(11) NOT NULL,
  `datum_registracije` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnicko_ime`, `ime`, `prezime`, `lozinka`, `sol`, `lozinka_sha256`, `email`, `uvjeti`, `status`, `uloga_id`, `broj_neuspjesnih_prijava`, `datum_registracije`) VALUES
('aantic', 'Ante', 'Antić', 'aantic12', '0Eg5vuTxVoZ9IGxmNedR', '28e68d931288521ebf6ca55d15b3f27dbaae6958584bd93a456959838d3cf5af', 'anteantic123@foi.hr', NULL, 1, 3, 0, '2021-05-31 16:11:19'),
('admin', 'admin', 'admin', 'admin123', 'K9ZTL75e89k5KqyEa7MQ', '3362caea8569212b9f5b08532f1c7385287c15bd1e4f0992d52c34162bdecb7c', 'admin@foi.hr', NULL, 1, 1, 0, '2021-05-24 14:55:44'),
('admin2', 'admin', 'admin', 'admin123', 'U990FtmIZtJIpJW1DX1I', 'f1ba89767d531d5448370f0b5f222e5af74ce4cbfcdbdad397672aeb38308676', 'admin2@foi.hr', NULL, 1, 3, 0, '2021-06-07 09:36:13'),
('iivic', 'Ivan', 'Ivić', 'iivic123', 'kdDb1Rs9XSF72FPOXkul', '182de17be80b0c2a4c37f08982e76b6d2864f092fefaa42d219dcc53df5bd55d', 'ivanivic123@foi.hr', NULL, 1, 3, 0, '2021-05-31 16:12:27'),
('jsusnjara', 'Josip', 'Šušnjara', 'jsus1234', '8nwgsexNVXt9EyOIwZYq', 'd7a320dbf7017eff5a604f5922b030834353e484b01e9553bd10e19c29883698', 'jsusnjara_lazni@foi.hr', NULL, 1, 3, 0, '2021-05-23 04:23:43'),
('jsusnjara2', 'Josip', 'Šušnjara', 'jsus1234', 'Hm8xMU9B8CsxfcPpEcnW', 'ee32a5c191970b48132506d5e1c887b482a1cd7b7b29f127ba20693b03df3e26', 'Josipsusnjara111@gmail.com', NULL, 1, 3, 0, '2021-05-28 13:39:54'),
('moderator1', 'moderator1', 'moderator1', 'moder123', 'qOXoMEigSQMFOyn12UvC', '0c373043f516793325583fdd001d5e99c1768181fad77d5ea0b59bda0ff9f3b5', 'moderator1@foi.hr', NULL, 1, 2, 0, '2021-05-25 21:16:34'),
('moderator2', 'moderator2', 'moderator2', 'moder123', 'N5fY20XM9ABkOQp1AaaB', '77b914f2ed5cd174ecc50dedc24185a38fd642de689615e1cf7c53587f71eea1', 'moderator2@foi.hr', NULL, 1, 2, 3, '2021-05-25 21:17:28'),
('moderator3', 'moderator3', 'moderator3', 'moder123', 'Hw8qfFy9rUytBILcWH9y', '46df0331496efad5a21a7598346b52284626d1234f2eea8a35f003b519595186', 'moderator3@foi.hr', NULL, 0, 2, 0, '2021-05-25 21:18:06'),
('pperic', 'Pero', 'Perić', 'pperic12', '0VOmb444DmFXT7VIlCUi', 'a8621a30f3ea37063fcc5d2427bbf4e0d7fd021d4c545666c386bc3c887e3b12', 'peroperic123@foi.hr', NULL, 1, 3, 0, '2021-05-31 16:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `materijali_za_vlak`
--

CREATE TABLE `materijali_za_vlak` (
  `url_materijala` varchar(200) NOT NULL,
  `naslov` varchar(30) NOT NULL,
  `vrsta_materijala` varchar(20) NOT NULL,
  `vlak_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `materijali_za_vlak`
--

INSERT INTO `materijali_za_vlak` (`url_materijala`, `naslov`, `vrsta_materijala`, `vlak_id`) VALUES
('datoteke/aantic/b6e3d331b8a3fd27a2963bbf19e9acc2.jpg', 'Sokolniki 1', 'slika', 27),
('datoteke/aantic/showimage (2).jpeg', 'Alco HH660 1', 'slika', 10),
('datoteke/aantic/showimage (3).jpeg', 'Alco HH660 2', 'slika', 10),
('datoteke/aantic/Sokolniki__retro_train_at(5089430034).jpg', 'Sokolniki 2', 'slika', 27),
('datoteke/iivic/5dd3d1a485600a6c2e4bf669.jpg', 'Retro train, St. Petersburg', 'slika', 28),
('datoteke/iivic/showimage (4).jpeg', 'EMD NW2 1', 'slika', 11),
('datoteke/iivic/showimage (5).jpeg', 'EMD NW2 2', 'slika', 11),
('datoteke/iivic/showimage (6).jpeg', 'EMD NW2 stari', 'slika', 11),
('datoteke/jsusnjara/rera-2-610x375.jpg', 'Sinjska rera 1', 'slika', 1),
('datoteke/jsusnjara/showimage (1).jpeg', 'NRE 2GS14B 2', 'slika', 31),
('datoteke/jsusnjara/showimage.jpeg', 'NRE 2GS14B 1', 'slika', 31),
('datoteke/jsusnjara/sinjska_rera-610x340.jpg', 'Sinjska rera 2', 'slika', 1),
('datoteke/jsusnjara/Split_JZ_class_83_on_turntable_and_class_32_ca_1952.jpg', 'Sinjska rera 3', 'slika', 1),
('datoteke/jsusnjara2/49388713403_1178598990_b.jpg', 'Bologoye-Ostashkov 2', 'slika', 30),
('datoteke/jsusnjara2/5dd3d18d15e9f97a842ec00a.jpg', 'Bologoye-Ostashkov 1', 'slika', 30),
('datoteke/moderator2/showimage (1).jpeg', 'Baldwin AS-416 2', 'slika', 13),
('datoteke/moderator2/showimage.jpeg', 'Baldwin AS-416 1', 'slika', 13),
('datoteke/pperic/74677088_2537742326314345_780558723490775040_n.jpg', 'The Ruskeala Express 3', 'slika', 29),
('datoteke/pperic/EgVbO9NWkAMuSfn.jpg', 'The Ruskeala Express 1', 'slika', 29),
('datoteke/pperic/showimage (7).jpeg', 'GE 44-ton 1', 'slika', 12),
('datoteke/pperic/showimage (8).jpeg', 'GE 44-ton 2', 'slika', 12),
('datoteke/pperic/uzwwzqzd8ch41.jpg', 'The Ruskeala Express 2', 'slika', 29);

-- --------------------------------------------------------

--
-- Table structure for table `pogon_motora`
--

CREATE TABLE `pogon_motora` (
  `pogon_motora_id` int(11) NOT NULL,
  `naziv_pogona` varchar(20) NOT NULL,
  `max_vrijeme_rada_sati` int(11) DEFAULT NULL,
  `max_udaljenost_km` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pogon_motora`
--

INSERT INTO `pogon_motora` (`pogon_motora_id`, `naziv_pogona`, `max_vrijeme_rada_sati`, `max_udaljenost_km`) VALUES
(1, 'parni', 20, 1000),
(2, 'dizel', 30, 5000),
(3, 'elektricni', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posluzitelj`
--

CREATE TABLE `posluzitelj` (
  `posluzitelj_id` int(11) NOT NULL,
  `pomak_vremena` int(11) NOT NULL,
  `trajanje_aktivacijskog_linka` int(11) NOT NULL,
  `broj_neuspjesnih_prijava` int(11) NOT NULL,
  `broj_redaka_za_stranicenje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prijava_vlaka`
--

CREATE TABLE `prijava_vlaka` (
  `izlozba_id` int(11) NOT NULL,
  `vlak_id` int(11) NOT NULL,
  `potvrdjena_prijava` tinyint(4) NOT NULL DEFAULT '0',
  `pregledana_prijava` tinyint(4) NOT NULL DEFAULT '0',
  `vrijeme_prijave` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prijava_vlaka`
--

INSERT INTO `prijava_vlaka` (`izlozba_id`, `vlak_id`, `potvrdjena_prijava`, `pregledana_prijava`, `vrijeme_prijave`) VALUES
(1, 10, 1, 1, '0000-00-00 00:00:00'),
(1, 11, 1, 1, '0000-00-00 00:00:00'),
(1, 12, 1, 1, '0000-00-00 00:00:00'),
(1, 13, 1, 1, '0000-00-00 00:00:00'),
(1, 31, 1, 1, '2021-06-07 10:27:23'),
(2, 27, 1, 1, '2021-06-07 09:54:46'),
(2, 28, 1, 1, '2021-06-07 09:56:22'),
(2, 29, 1, 1, '2021-06-07 09:57:55'),
(2, 30, 1, 1, '2021-06-07 09:59:32'),
(6, 1, 1, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `status_izlozbe`
--

CREATE TABLE `status_izlozbe` (
  `status_izlozbe_id` int(11) NOT NULL,
  `naziv_statusa` varchar(30) NOT NULL,
  `opis_statusa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status_izlozbe`
--

INSERT INTO `status_izlozbe` (`status_izlozbe_id`, `naziv_statusa`, `opis_statusa`) VALUES
(1, 'otvorene prijave', 'U ovom stadiju korisnici salju svoje prijave.'),
(2, 'izlozba u tijeku', 'Stadij u kojem je gotovo slanje prijava te se one sada mogu pregledati.'),
(3, 'otvoreno glasovanje', 'Korisnici sada mogu dati svoj glas jednoj prijavi.'),
(4, 'zatvoreno glasovanje', 'Nema vise glasovanja, proglasenje pobjednika.');

-- --------------------------------------------------------

--
-- Table structure for table `tematika_izlozbe`
--

CREATE TABLE `tematika_izlozbe` (
  `tematika_id` int(11) NOT NULL,
  `naziv_tematike` varchar(50) NOT NULL,
  `opis_tematike` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tematika_izlozbe`
--

INSERT INTO `tematika_izlozbe` (`tematika_id`, `naziv_tematike`, `opis_tematike`) VALUES
(2, 'Lokomotive', 'O lokomotivama...'),
(4, 'Motorni vlakovi', 'Opis tematike o motornim vlakovima slijedi ovdje...'),
(5, 'Vlakovi velikih brzina', 'Samo brzi vlakovi'),
(7, 'Vlakovi budućnosti', 'Ova tematika namijenjena je vlakovima budućnosti.'),
(8, 'Retro vlakovi', 'Tematika namijenjena starim vlakovima'),
(9, 'Vlakovi - Europa', 'Tematika za vlakove iz Europe'),
(10, 'Vlakovi - Azija', 'Tematika za vlakove iz Azije'),
(11, 'Vlakovi - Amerike', 'Tematika za vlakove iz Amerika'),
(12, 'Vlakovi - Afrika', 'Tematika za vlakove iz Afrike'),
(13, 'Vlakovi - Australija', 'Tematika za vlakove iz Australije');

-- --------------------------------------------------------

--
-- Table structure for table `tip`
--

CREATE TABLE `tip` (
  `tip_id` int(11) NOT NULL,
  `naziv_radnje` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tip`
--

INSERT INTO `tip` (`tip_id`, `naziv_radnje`) VALUES
(1, 'registracija'),
(2, 'prijava'),
(3, 'neuspješna prijava'),
(7, 'zaključavanje računa'),
(8, 'otključavanje računa'),
(9, 'promjena lozinke'),
(10, 'promjena pomaka vremena'),
(11, 'odjava'),
(12, 'pristup stranici'),
(13, 'create back-up'),
(14, 'restore back-up'),
(15, 'dodavanje tematike'),
(16, 'ažuriranje tematike'),
(17, 'dodavanje izložbe'),
(18, 'ažuriranje izložbe'),
(19, 'slanje glasa'),
(20, 'dodavanje vlaka'),
(21, 'prihvaćanje prijave'),
(22, 'odbijanje prijave'),
(23, 'dodavanje materijala');

-- --------------------------------------------------------

--
-- Table structure for table `upravlja_tematikom`
--

CREATE TABLE `upravlja_tematikom` (
  `tematika_id` int(11) NOT NULL,
  `moderator_korisnicko_ime` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `upravlja_tematikom`
--

INSERT INTO `upravlja_tematikom` (`tematika_id`, `moderator_korisnicko_ime`) VALUES
(2, 'admin'),
(2, 'moderator1'),
(2, 'moderator2'),
(4, 'admin'),
(4, 'moderator1'),
(5, 'moderator1'),
(5, 'moderator2'),
(5, 'moderator3'),
(7, 'admin'),
(7, 'moderator1'),
(8, 'moderator1'),
(9, 'moderator2'),
(10, 'moderator3'),
(11, 'moderator1'),
(11, 'moderator2'),
(12, 'moderator1'),
(13, 'moderator3');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(16) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vlak`
--

CREATE TABLE `vlak` (
  `vlak_id` int(11) NOT NULL,
  `naziv_vlaka` varchar(45) NOT NULL,
  `max_brzina` int(11) NOT NULL,
  `broj_sjedala` int(11) NOT NULL,
  `opis` text NOT NULL,
  `pogon_motora_id` int(11) NOT NULL,
  `korisnik_korisnicko_ime` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vlak`
--

INSERT INTO `vlak` (`vlak_id`, `naziv_vlaka`, `max_brzina`, `broj_sjedala`, `opis`, `pogon_motora_id`, `korisnik_korisnicko_ime`) VALUES
(1, 'Ferata', 65, 100, 'Vlak koji je vozio na relaciji Sinj - Split nekoć davno davno', 1, 'jsusnjara'),
(10, 'Alco HH660', 100, 100, 'Investing in History. The Genesee Valley Transportation Co., Inc. Delaware-Lackawanna recently received this Alco HH660 that was built in 1940 Schenectady, NY for the Delaware, Lackawanna, and Wes', 2, 'aantic'),
(11, 'EMD NW2', 110, 110, 'Delivered as Lake Terminal 1009 in January 1948, this NW2 appears to have been well-tended over its 25 years of service. I think Acipco had another EMD switcher in orange and green.', 3, 'iivic'),
(12, 'GE 44-ton', 90, 95, 'Handy Dandy Railroad at the start of their excursion back in 2019. Their steam engine was down for the day', 1, 'pperic'),
(13, 'Baldwin AS-416', 120, 150, 'Built for Norfolk Southern in 1955, then bought by Peabody Coal in 1975, NS 1616 sits quietly on display in the Bob Julian roundhouse at the NCTM.', 2, 'moderator2'),
(27, 'Sokolniki', 120, 200, 'The Sokolniki retro train runs on the red line of the Moscow Metro, along with regular trains.', 2, 'aantic'),
(28, 'Retro train, St. Petersburg', 110, 120, 'It consists of four restored 1960s train cars, which, in addition to the usual seats, also house an exhibition about the history of the subway.', 2, 'iivic'),
(29, 'The Ruskeala Express', 100, 250, 'This is the only daily steam-powered passenger train left in Russia. It consists of five train cars (four with passenger compartments and a restaurant car).', 1, 'pperic'),
(30, 'Bologoye-Ostashkov', 170, 240, 'There is a regular commuter train leaving the Bologoye station (175 km north of Tver) every Saturday at 9.25 that is pulled by an L series steam locomotive from the late 1940s.', 1, 'jsusnjara2'),
(31, 'NRE 2GS14B', 160, 80, 'United States Navy 2GS14B 65-00650 (shortened to just "650") is one of three diesel locomotives that switches cars at the Crane Naval Support Center in Crane, Indiana.', 2, 'jsusnjara');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD PRIMARY KEY (`dnevnik_id`),
  ADD KEY `fk_dnevnik_tip1_idx` (`tip_tip_id`),
  ADD KEY `fk_dnevnik_korisnik1_idx` (`korisnik_korisnicko_ime`);

--
-- Indexes for table `DZ4_drzava`
--
ALTER TABLE `DZ4_drzava`
  ADD PRIMARY KEY (`drzava_id`);

--
-- Indexes for table `DZ4_korisnik`
--
ALTER TABLE `DZ4_korisnik`
  ADD PRIMARY KEY (`korisnicko_ime`),
  ADD UNIQUE KEY `korisnicko_ime_UNIQUE` (`korisnicko_ime`);

--
-- Indexes for table `DZ4_obrazac`
--
ALTER TABLE `DZ4_obrazac`
  ADD PRIMARY KEY (`obrazac_id`);

--
-- Indexes for table `DZ4_u_drzavi`
--
ALTER TABLE `DZ4_u_drzavi`
  ADD PRIMARY KEY (`DZ4_obrazac_obrazac_id`,`DZ4_drzava_drzava_id`),
  ADD KEY `fk_DZ4_u_drzavi_DZ4_drzava1_idx` (`DZ4_drzava_drzava_id`);

--
-- Indexes for table `glas`
--
ALTER TABLE `glas`
  ADD PRIMARY KEY (`korisnik_korisnicko_ime`,`izlozba_id`),
  ADD KEY `fk_glas_izlozba1_idx` (`izlozba_id`),
  ADD KEY `fk_glas_vlak1_idx` (`vlak_id`),
  ADD KEY `fk_glas_korisnik1_idx` (`korisnik_korisnicko_ime`);

--
-- Indexes for table `izlozba`
--
ALTER TABLE `izlozba`
  ADD PRIMARY KEY (`izlozba_id`),
  ADD KEY `fk_izlozba_status_izlozbe1_idx` (`status_izlozbe_id`),
  ADD KEY `fk_izlozba_tematika_izlozbe1_idx` (`tematika_id`),
  ADD KEY `fk_izlozba_vlak1_idx` (`vlak_pobjednik_id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`korisnicko_ime`),
  ADD UNIQUE KEY `korisnicko_ime_UNIQUE` (`korisnicko_ime`);

--
-- Indexes for table `materijali_za_vlak`
--
ALTER TABLE `materijali_za_vlak`
  ADD PRIMARY KEY (`url_materijala`),
  ADD KEY `fk_materijali_za_vlak_vlak1_idx` (`vlak_id`);

--
-- Indexes for table `pogon_motora`
--
ALTER TABLE `pogon_motora`
  ADD PRIMARY KEY (`pogon_motora_id`);

--
-- Indexes for table `posluzitelj`
--
ALTER TABLE `posluzitelj`
  ADD PRIMARY KEY (`posluzitelj_id`);

--
-- Indexes for table `prijava_vlaka`
--
ALTER TABLE `prijava_vlaka`
  ADD PRIMARY KEY (`izlozba_id`,`vlak_id`),
  ADD KEY `fk_prijava_vlaka_vlak1_idx` (`vlak_id`);

--
-- Indexes for table `status_izlozbe`
--
ALTER TABLE `status_izlozbe`
  ADD PRIMARY KEY (`status_izlozbe_id`);

--
-- Indexes for table `tematika_izlozbe`
--
ALTER TABLE `tematika_izlozbe`
  ADD PRIMARY KEY (`tematika_id`);

--
-- Indexes for table `tip`
--
ALTER TABLE `tip`
  ADD PRIMARY KEY (`tip_id`);

--
-- Indexes for table `upravlja_tematikom`
--
ALTER TABLE `upravlja_tematikom`
  ADD PRIMARY KEY (`tematika_id`,`moderator_korisnicko_ime`),
  ADD KEY `fk_upravlja_tematikom_tematika_izlozbe1_idx` (`tematika_id`),
  ADD KEY `fk_upravlja_tematikom_korisnik1_idx` (`moderator_korisnicko_ime`);

--
-- Indexes for table `vlak`
--
ALTER TABLE `vlak`
  ADD PRIMARY KEY (`vlak_id`),
  ADD KEY `fk_vlak_pogon_motora1_idx` (`pogon_motora_id`),
  ADD KEY `index_naziv_vlaka` (`naziv_vlaka`),
  ADD KEY `index_max_brzina` (`max_brzina`),
  ADD KEY `fk_vlak_korisnik1_idx` (`korisnik_korisnicko_ime`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dnevnik`
--
ALTER TABLE `dnevnik`
  MODIFY `dnevnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=647;
--
-- AUTO_INCREMENT for table `DZ4_drzava`
--
ALTER TABLE `DZ4_drzava`
  MODIFY `drzava_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `DZ4_obrazac`
--
ALTER TABLE `DZ4_obrazac`
  MODIFY `obrazac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `izlozba`
--
ALTER TABLE `izlozba`
  MODIFY `izlozba_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `pogon_motora`
--
ALTER TABLE `pogon_motora`
  MODIFY `pogon_motora_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `posluzitelj`
--
ALTER TABLE `posluzitelj`
  MODIFY `posluzitelj_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `status_izlozbe`
--
ALTER TABLE `status_izlozbe`
  MODIFY `status_izlozbe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tematika_izlozbe`
--
ALTER TABLE `tematika_izlozbe`
  MODIFY `tematika_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tip`
--
ALTER TABLE `tip`
  MODIFY `tip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `vlak`
--
ALTER TABLE `vlak`
  MODIFY `vlak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD CONSTRAINT `fk_dnevnik_korisnik1` FOREIGN KEY (`korisnik_korisnicko_ime`) REFERENCES `korisnik` (`korisnicko_ime`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dnevnik_tip1` FOREIGN KEY (`tip_tip_id`) REFERENCES `tip` (`tip_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `DZ4_u_drzavi`
--
ALTER TABLE `DZ4_u_drzavi`
  ADD CONSTRAINT `fk_DZ4_u_drzavi_DZ4_obrazac1` FOREIGN KEY (`DZ4_obrazac_obrazac_id`) REFERENCES `DZ4_obrazac` (`obrazac_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DZ4_u_drzavi_DZ4_drzava1` FOREIGN KEY (`DZ4_drzava_drzava_id`) REFERENCES `DZ4_drzava` (`drzava_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `glas`
--
ALTER TABLE `glas`
  ADD CONSTRAINT `fk_glas_izlozba1` FOREIGN KEY (`izlozba_id`) REFERENCES `izlozba` (`izlozba_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_glas_vlak1` FOREIGN KEY (`vlak_id`) REFERENCES `vlak` (`vlak_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_glas_korisnik1` FOREIGN KEY (`korisnik_korisnicko_ime`) REFERENCES `korisnik` (`korisnicko_ime`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `izlozba`
--
ALTER TABLE `izlozba`
  ADD CONSTRAINT `fk_izlozba_vlak1` FOREIGN KEY (`vlak_pobjednik_id`) REFERENCES `vlak` (`vlak_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_izlozba_status_izlozbe1` FOREIGN KEY (`status_izlozbe_id`) REFERENCES `status_izlozbe` (`status_izlozbe_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_izlozba_tematika_izlozbe1` FOREIGN KEY (`tematika_id`) REFERENCES `tematika_izlozbe` (`tematika_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `materijali_za_vlak`
--
ALTER TABLE `materijali_za_vlak`
  ADD CONSTRAINT `fk_materijali_za_vlak_vlak1` FOREIGN KEY (`vlak_id`) REFERENCES `vlak` (`vlak_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `prijava_vlaka`
--
ALTER TABLE `prijava_vlaka`
  ADD CONSTRAINT `fk_prijava_vlaka_vlak1` FOREIGN KEY (`vlak_id`) REFERENCES `vlak` (`vlak_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_prijava_vlaka_izlozba1` FOREIGN KEY (`izlozba_id`) REFERENCES `izlozba` (`izlozba_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `upravlja_tematikom`
--
ALTER TABLE `upravlja_tematikom`
  ADD CONSTRAINT `fk_upravlja_tematikom_tematika_izlozbe1` FOREIGN KEY (`tematika_id`) REFERENCES `tematika_izlozbe` (`tematika_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_upravlja_tematikom_korisnik1` FOREIGN KEY (`moderator_korisnicko_ime`) REFERENCES `korisnik` (`korisnicko_ime`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vlak`
--
ALTER TABLE `vlak`
  ADD CONSTRAINT `fk_vlak_pogon_motora1` FOREIGN KEY (`pogon_motora_id`) REFERENCES `pogon_motora` (`pogon_motora_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vlak_korisnik1` FOREIGN KEY (`korisnik_korisnicko_ime`) REFERENCES `korisnik` (`korisnicko_ime`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
