-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2020 at 04:25 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE `bobot` (
  `id_bobot` int(11) NOT NULL,
  `nama_sub` varchar(20) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot`
--

INSERT INTO `bobot` (`id_bobot`, `nama_sub`, `nilai`) VALUES
(1, 'Kurang Sekali', 1),
(2, 'Kurang', 2),
(3, 'Cukup', 3),
(4, 'Baik', 4),
(5, 'Baik Sekali', 5);

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_history` int(11) NOT NULL,
  `hasil` int(11) NOT NULL,
  `peringkat` int(11) NOT NULL,
  `keputusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_pegawai`, `id_history`, `hasil`, `peringkat`, `keputusan`) VALUES
(466, 25, 6, 14248, 4, 'berhentikan'),
(495, 26, 6, 17262, 2, 'peringatan'),
(496, 27, 6, 17026, 1, 'peringatan'),
(497, 28, 6, 18713, 3, 'lanjut'),
(506, 26, 7, 1950, 2, ''),
(507, 27, 7, 2774, 1, ''),
(508, 28, 7, 0, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id_history` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id_history`, `tanggal`, `file`, `status`) VALUES
(6, '2020-06-28', 'history/513-6891032_23062020.pdf', 'selesai'),
(7, '0000-00-00', '', 'belum');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `kode_kriteria2` varchar(11) NOT NULL,
  `nama2` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`kode_kriteria2`, `nama2`) VALUES
('K1', 'Kemauan Belajar'),
('K2', 'Kepedulian'),
('K3', 'Kedisiplinan'),
('K4', 'Pengelolaan Diri'),
('K5', 'Komunikasi'),
('K6', 'Tanggung Jawab'),
('K7', 'Etika dan Perilaku'),
('K8', 'Bahasa Inggris');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_pegawai`
--

CREATE TABLE `nilai_pegawai` (
  `id_nilai` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_penilai` int(11) NOT NULL,
  `id_history` int(11) NOT NULL,
  `id_subk` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_pegawai`
--

INSERT INTO `nilai_pegawai` (`id_nilai`, `id_pegawai`, `id_penilai`, `id_history`, `id_subk`, `nilai`) VALUES
(13, 25, 1, 6, 1, 5),
(14, 25, 1, 6, 2, 4),
(15, 25, 1, 6, 3, 5),
(16, 25, 1, 6, 4, 4),
(17, 25, 1, 6, 5, 3),
(18, 25, 1, 6, 6, 4),
(19, 25, 1, 6, 7, 5),
(20, 25, 1, 6, 8, 4),
(21, 25, 1, 6, 9, 4),
(22, 25, 1, 6, 10, 4),
(23, 25, 1, 6, 11, 4),
(24, 25, 1, 6, 12, 4),
(25, 25, 1, 6, 13, 3),
(26, 25, 1, 6, 14, 4),
(27, 25, 1, 6, 15, 5),
(28, 25, 1, 6, 16, 4),
(29, 25, 1, 6, 17, 5),
(30, 25, 3, 6, 1, 5),
(31, 25, 3, 6, 2, 4),
(32, 25, 3, 6, 3, 5),
(33, 25, 3, 6, 4, 3),
(34, 25, 3, 6, 5, 4),
(35, 25, 3, 6, 6, 3),
(36, 25, 3, 6, 7, 5),
(37, 25, 3, 6, 8, 2),
(38, 25, 3, 6, 9, 3),
(39, 25, 3, 6, 10, 5),
(40, 25, 3, 6, 11, 4),
(41, 25, 3, 6, 12, 4),
(42, 25, 3, 6, 13, 4),
(43, 25, 3, 6, 14, 4),
(44, 25, 3, 6, 15, 3),
(45, 25, 3, 6, 16, 4),
(46, 25, 3, 6, 17, 3),
(64, 26, 1, 6, 1, 5),
(65, 26, 1, 6, 2, 3),
(66, 26, 1, 6, 3, 5),
(67, 26, 1, 6, 4, 4),
(68, 26, 1, 6, 5, 4),
(69, 26, 1, 6, 6, 4),
(70, 26, 1, 6, 7, 5),
(71, 26, 1, 6, 8, 4),
(72, 26, 1, 6, 9, 5),
(73, 26, 1, 6, 10, 3),
(74, 26, 1, 6, 11, 4),
(75, 26, 1, 6, 12, 4),
(76, 26, 1, 6, 13, 5),
(77, 26, 1, 6, 14, 4),
(78, 26, 1, 6, 15, 5),
(79, 26, 1, 6, 16, 4),
(80, 26, 1, 6, 17, 3),
(81, 27, 1, 6, 1, 2),
(82, 27, 1, 6, 2, 4),
(83, 27, 1, 6, 3, 4),
(84, 27, 1, 6, 4, 3),
(85, 27, 1, 6, 5, 5),
(86, 27, 1, 6, 6, 5),
(87, 27, 1, 6, 7, 5),
(88, 27, 1, 6, 8, 4),
(89, 27, 1, 6, 9, 3),
(90, 27, 1, 6, 10, 4),
(91, 27, 1, 6, 11, 4),
(92, 27, 1, 6, 12, 4),
(93, 27, 1, 6, 13, 3),
(94, 27, 1, 6, 14, 4),
(95, 27, 1, 6, 15, 3),
(96, 27, 1, 6, 16, 4),
(97, 27, 1, 6, 17, 4),
(98, 28, 1, 6, 1, 3),
(99, 28, 1, 6, 2, 5),
(100, 28, 1, 6, 3, 5),
(101, 28, 1, 6, 4, 4),
(102, 28, 1, 6, 5, 4),
(103, 28, 1, 6, 6, 3),
(104, 28, 1, 6, 7, 5),
(105, 28, 1, 6, 8, 4),
(106, 28, 1, 6, 9, 4),
(107, 28, 1, 6, 10, 3),
(108, 28, 1, 6, 11, 5),
(109, 28, 1, 6, 12, 4),
(110, 28, 1, 6, 13, 5),
(111, 28, 1, 6, 14, 4),
(112, 28, 1, 6, 15, 5),
(113, 28, 1, 6, 16, 4),
(114, 28, 1, 6, 17, 3),
(115, 25, 6, 6, 1, 5),
(116, 25, 6, 6, 2, 3),
(117, 25, 6, 6, 3, 4),
(118, 25, 6, 6, 4, 4),
(119, 25, 6, 6, 5, 5),
(120, 25, 6, 6, 6, 5),
(121, 25, 6, 6, 7, 4),
(122, 25, 6, 6, 8, 5),
(123, 25, 6, 6, 9, 4),
(124, 25, 6, 6, 10, 4),
(125, 25, 6, 6, 11, 5),
(126, 25, 6, 6, 12, 4),
(127, 25, 6, 6, 13, 3),
(128, 25, 6, 6, 14, 5),
(129, 25, 6, 6, 15, 5),
(130, 25, 6, 6, 16, 4),
(131, 25, 6, 6, 17, 5),
(132, 26, 6, 6, 1, 2),
(133, 26, 6, 6, 2, 4),
(134, 26, 6, 6, 3, 4),
(135, 26, 6, 6, 4, 4),
(136, 26, 6, 6, 5, 5),
(137, 26, 6, 6, 6, 5),
(138, 26, 6, 6, 7, 4),
(139, 26, 6, 6, 8, 5),
(140, 26, 6, 6, 9, 4),
(141, 26, 6, 6, 10, 5),
(142, 26, 6, 6, 11, 4),
(143, 26, 6, 6, 12, 3),
(144, 26, 6, 6, 13, 4),
(145, 26, 6, 6, 14, 5),
(146, 26, 6, 6, 15, 5),
(147, 26, 6, 6, 16, 4),
(148, 26, 6, 6, 17, 4),
(149, 27, 6, 6, 1, 5),
(150, 27, 6, 6, 2, 4),
(151, 27, 6, 6, 3, 4),
(152, 27, 6, 6, 4, 4),
(153, 27, 6, 6, 5, 5),
(154, 27, 6, 6, 6, 5),
(155, 27, 6, 6, 7, 4),
(156, 27, 6, 6, 8, 5),
(157, 27, 6, 6, 9, 4),
(158, 27, 6, 6, 10, 4),
(159, 27, 6, 6, 11, 3),
(160, 27, 6, 6, 12, 5),
(161, 27, 6, 6, 13, 4),
(162, 27, 6, 6, 14, 5),
(163, 27, 6, 6, 15, 5),
(164, 27, 6, 6, 16, 4),
(165, 27, 6, 6, 17, 5),
(166, 28, 6, 6, 1, 4),
(167, 28, 6, 6, 2, 5),
(168, 28, 6, 6, 3, 5),
(169, 28, 6, 6, 4, 4),
(170, 28, 6, 6, 5, 3),
(171, 28, 6, 6, 6, 4),
(172, 28, 6, 6, 7, 4),
(173, 28, 6, 6, 8, 4),
(174, 28, 6, 6, 9, 5),
(175, 28, 6, 6, 10, 4),
(176, 28, 6, 6, 11, 5),
(177, 28, 6, 6, 12, 4),
(178, 28, 6, 6, 13, 4),
(179, 28, 6, 6, 14, 4),
(180, 28, 6, 6, 15, 4),
(181, 28, 6, 6, 16, 5),
(182, 28, 6, 6, 17, 4),
(183, 25, 4, 6, 1, 4),
(184, 25, 4, 6, 2, 3),
(185, 25, 4, 6, 3, 3),
(186, 25, 4, 6, 4, 4),
(187, 25, 4, 6, 5, 5),
(188, 25, 4, 6, 6, 5),
(189, 25, 4, 6, 7, 4),
(190, 25, 4, 6, 8, 3),
(191, 25, 4, 6, 9, 4),
(192, 25, 4, 6, 10, 5),
(193, 25, 4, 6, 11, 4),
(194, 25, 4, 6, 12, 5),
(195, 25, 4, 6, 13, 4),
(196, 25, 4, 6, 14, 5),
(197, 25, 4, 6, 15, 4),
(198, 25, 4, 6, 16, 5),
(199, 25, 4, 6, 17, 4),
(200, 26, 4, 6, 1, 5),
(201, 26, 4, 6, 2, 4),
(202, 26, 4, 6, 3, 4),
(203, 26, 4, 6, 4, 5),
(204, 26, 4, 6, 5, 4),
(205, 26, 4, 6, 6, 5),
(206, 26, 4, 6, 7, 4),
(207, 26, 4, 6, 8, 5),
(208, 26, 4, 6, 9, 4),
(209, 26, 4, 6, 10, 5),
(210, 26, 4, 6, 11, 4),
(211, 26, 4, 6, 12, 4),
(212, 26, 4, 6, 13, 4),
(213, 26, 4, 6, 14, 4),
(214, 26, 4, 6, 15, 4),
(215, 26, 4, 6, 16, 5),
(216, 26, 4, 6, 17, 3),
(217, 27, 4, 6, 1, 5),
(218, 27, 4, 6, 2, 4),
(219, 27, 4, 6, 3, 4),
(220, 27, 4, 6, 4, 4),
(221, 27, 4, 6, 5, 3),
(222, 27, 4, 6, 6, 5),
(223, 27, 4, 6, 7, 4),
(224, 27, 4, 6, 8, 4),
(225, 27, 4, 6, 9, 5),
(226, 27, 4, 6, 10, 4),
(227, 27, 4, 6, 11, 4),
(228, 27, 4, 6, 12, 5),
(229, 27, 4, 6, 13, 4),
(230, 27, 4, 6, 14, 5),
(231, 27, 4, 6, 15, 4),
(232, 27, 4, 6, 16, 5),
(233, 27, 4, 6, 17, 4),
(234, 28, 4, 6, 1, 5),
(235, 28, 4, 6, 2, 4),
(236, 28, 4, 6, 3, 4),
(237, 28, 4, 6, 4, 5),
(238, 28, 4, 6, 5, 4),
(239, 28, 4, 6, 6, 5),
(240, 28, 4, 6, 7, 5),
(241, 28, 4, 6, 8, 4),
(242, 28, 4, 6, 9, 5),
(243, 28, 4, 6, 10, 4),
(244, 28, 4, 6, 11, 5),
(245, 28, 4, 6, 12, 4),
(246, 28, 4, 6, 13, 5),
(247, 28, 4, 6, 14, 5),
(248, 28, 4, 6, 15, 5),
(249, 28, 4, 6, 16, 4),
(250, 28, 4, 6, 17, 5),
(251, 25, 7, 6, 1, 3),
(252, 25, 7, 6, 2, 4),
(253, 25, 7, 6, 3, 3),
(254, 25, 7, 6, 4, 4),
(255, 25, 7, 6, 5, 3),
(256, 25, 7, 6, 6, 4),
(257, 25, 7, 6, 7, 4),
(258, 25, 7, 6, 8, 3),
(259, 25, 7, 6, 9, 4),
(260, 25, 7, 6, 10, 3),
(261, 25, 7, 6, 11, 4),
(262, 25, 7, 6, 12, 3),
(263, 25, 7, 6, 13, 4),
(264, 25, 7, 6, 14, 3),
(265, 25, 7, 6, 15, 4),
(266, 25, 7, 6, 16, 3),
(267, 25, 7, 6, 17, 4),
(268, 26, 7, 6, 1, 4),
(269, 26, 7, 6, 2, 5),
(270, 26, 7, 6, 3, 5),
(271, 26, 7, 6, 4, 5),
(272, 26, 7, 6, 5, 4),
(273, 26, 7, 6, 6, 4),
(274, 26, 7, 6, 7, 5),
(275, 26, 7, 6, 8, 4),
(276, 26, 7, 6, 9, 5),
(277, 26, 7, 6, 10, 5),
(278, 26, 7, 6, 11, 4),
(279, 26, 7, 6, 12, 5),
(280, 26, 7, 6, 13, 4),
(281, 26, 7, 6, 14, 5),
(282, 26, 7, 6, 15, 4),
(283, 26, 7, 6, 16, 5),
(284, 26, 7, 6, 17, 4),
(285, 27, 7, 6, 1, 5),
(286, 27, 7, 6, 2, 4),
(287, 27, 7, 6, 3, 4),
(288, 27, 7, 6, 4, 4),
(289, 27, 7, 6, 5, 3),
(290, 27, 7, 6, 6, 5),
(291, 27, 7, 6, 7, 5),
(292, 27, 7, 6, 8, 5),
(293, 27, 7, 6, 9, 4),
(294, 27, 7, 6, 10, 5),
(295, 27, 7, 6, 11, 4),
(296, 27, 7, 6, 12, 5),
(297, 27, 7, 6, 13, 4),
(298, 27, 7, 6, 14, 5),
(299, 27, 7, 6, 15, 4),
(300, 27, 7, 6, 16, 5),
(301, 27, 7, 6, 17, 4),
(302, 28, 7, 6, 1, 5),
(303, 28, 7, 6, 2, 4),
(304, 28, 7, 6, 3, 4),
(305, 28, 7, 6, 4, 5),
(306, 28, 7, 6, 5, 4),
(307, 28, 7, 6, 6, 5),
(308, 28, 7, 6, 7, 5),
(309, 28, 7, 6, 8, 4),
(310, 28, 7, 6, 9, 5),
(311, 28, 7, 6, 10, 4),
(312, 28, 7, 6, 11, 5),
(313, 28, 7, 6, 12, 4),
(314, 28, 7, 6, 13, 5),
(315, 28, 7, 6, 14, 4),
(316, 28, 7, 6, 15, 5),
(317, 28, 7, 6, 16, 4),
(318, 28, 7, 6, 17, 4),
(319, 25, 2, 6, 1, 5),
(320, 25, 2, 6, 2, 4),
(321, 25, 2, 6, 3, 4),
(322, 25, 2, 6, 4, 5),
(323, 25, 2, 6, 5, 4),
(324, 25, 2, 6, 6, 5),
(325, 25, 2, 6, 7, 5),
(326, 25, 2, 6, 8, 4),
(327, 25, 2, 6, 9, 5),
(328, 25, 2, 6, 10, 4),
(329, 25, 2, 6, 11, 5),
(330, 25, 2, 6, 12, 4),
(331, 25, 2, 6, 13, 5),
(332, 25, 2, 6, 14, 4),
(333, 25, 2, 6, 15, 5),
(334, 25, 2, 6, 16, 4),
(335, 25, 2, 6, 17, 5),
(336, 26, 2, 6, 1, 5),
(337, 26, 2, 6, 2, 4),
(338, 26, 2, 6, 3, 5),
(339, 26, 2, 6, 4, 4),
(340, 26, 2, 6, 5, 5),
(341, 26, 2, 6, 6, 4),
(342, 26, 2, 6, 7, 4),
(343, 26, 2, 6, 8, 4),
(344, 26, 2, 6, 9, 3),
(345, 26, 2, 6, 10, 4),
(346, 26, 2, 6, 11, 5),
(347, 26, 2, 6, 12, 4),
(348, 26, 2, 6, 13, 4),
(349, 26, 2, 6, 14, 5),
(350, 26, 2, 6, 15, 4),
(351, 26, 2, 6, 16, 5),
(352, 26, 2, 6, 17, 4),
(353, 27, 2, 6, 1, 5),
(354, 27, 2, 6, 2, 3),
(355, 27, 2, 6, 3, 5),
(356, 27, 2, 6, 4, 4),
(357, 27, 2, 6, 5, 5),
(358, 27, 2, 6, 6, 4),
(359, 27, 2, 6, 7, 4),
(360, 27, 2, 6, 8, 5),
(361, 27, 2, 6, 9, 4),
(362, 27, 2, 6, 10, 4),
(363, 27, 2, 6, 11, 3),
(364, 27, 2, 6, 12, 5),
(365, 27, 2, 6, 13, 4),
(366, 27, 2, 6, 14, 5),
(367, 27, 2, 6, 15, 4),
(368, 27, 2, 6, 16, 4),
(369, 27, 2, 6, 17, 4),
(370, 28, 2, 6, 1, 5),
(371, 28, 2, 6, 2, 4),
(372, 28, 2, 6, 3, 4),
(373, 28, 2, 6, 4, 4),
(374, 28, 2, 6, 5, 5),
(375, 28, 2, 6, 6, 5),
(376, 28, 2, 6, 7, 4),
(377, 28, 2, 6, 8, 4),
(378, 28, 2, 6, 9, 5),
(379, 28, 2, 6, 10, 5),
(380, 28, 2, 6, 11, 4),
(381, 28, 2, 6, 12, 5),
(382, 28, 2, 6, 13, 4),
(383, 28, 2, 6, 14, 5),
(384, 28, 2, 6, 15, 4),
(385, 28, 2, 6, 16, 5),
(386, 28, 2, 6, 17, 4),
(387, 25, 5, 6, 1, 5),
(388, 25, 5, 6, 2, 5),
(389, 25, 5, 6, 3, 5),
(390, 25, 5, 6, 4, 4),
(391, 25, 5, 6, 5, 5),
(392, 25, 5, 6, 6, 4),
(393, 25, 5, 6, 7, 4),
(394, 25, 5, 6, 8, 5),
(395, 25, 5, 6, 9, 4),
(396, 25, 5, 6, 10, 5),
(397, 25, 5, 6, 11, 4),
(398, 25, 5, 6, 12, 5),
(399, 25, 5, 6, 13, 4),
(400, 25, 5, 6, 14, 5),
(401, 25, 5, 6, 15, 4),
(402, 25, 5, 6, 16, 3),
(403, 25, 5, 6, 17, 5),
(404, 26, 5, 6, 1, 4),
(405, 26, 5, 6, 2, 5),
(406, 26, 5, 6, 3, 4),
(407, 26, 5, 6, 4, 5),
(408, 26, 5, 6, 5, 4),
(409, 26, 5, 6, 6, 4),
(410, 26, 5, 6, 7, 4),
(411, 26, 5, 6, 8, 5),
(412, 26, 5, 6, 9, 4),
(413, 26, 5, 6, 10, 4),
(414, 26, 5, 6, 11, 3),
(415, 26, 5, 6, 12, 5),
(416, 26, 5, 6, 13, 5),
(417, 26, 5, 6, 14, 4),
(418, 26, 5, 6, 15, 5),
(419, 26, 5, 6, 16, 4),
(420, 26, 5, 6, 17, 5),
(421, 27, 5, 6, 1, 4),
(422, 27, 5, 6, 2, 5),
(423, 27, 5, 6, 3, 4),
(424, 27, 5, 6, 4, 5),
(425, 27, 5, 6, 5, 4),
(426, 27, 5, 6, 6, 5),
(427, 27, 5, 6, 7, 4),
(428, 27, 5, 6, 8, 4),
(429, 27, 5, 6, 9, 4),
(430, 27, 5, 6, 10, 5),
(431, 27, 5, 6, 11, 4),
(432, 27, 5, 6, 12, 4),
(433, 27, 5, 6, 13, 4),
(434, 27, 5, 6, 14, 5),
(435, 27, 5, 6, 15, 4),
(436, 27, 5, 6, 16, 5),
(437, 27, 5, 6, 17, 4),
(438, 28, 5, 6, 1, 3),
(439, 28, 5, 6, 2, 5),
(440, 28, 5, 6, 3, 4),
(441, 28, 5, 6, 4, 5),
(442, 28, 5, 6, 5, 5),
(443, 28, 5, 6, 6, 5),
(444, 28, 5, 6, 7, 5),
(445, 28, 5, 6, 8, 4),
(446, 28, 5, 6, 9, 5),
(447, 28, 5, 6, 10, 4),
(448, 28, 5, 6, 11, 5),
(449, 28, 5, 6, 12, 5),
(450, 28, 5, 6, 13, 4),
(451, 28, 5, 6, 14, 5),
(452, 28, 5, 6, 15, 4),
(453, 28, 5, 6, 16, 5),
(454, 28, 5, 6, 17, 4),
(455, 26, 3, 6, 1, 5),
(456, 26, 3, 6, 2, 4),
(457, 26, 3, 6, 3, 4),
(458, 26, 3, 6, 4, 5),
(459, 26, 3, 6, 5, 4),
(460, 26, 3, 6, 6, 5),
(461, 26, 3, 6, 7, 5),
(462, 26, 3, 6, 8, 4),
(463, 26, 3, 6, 9, 5),
(464, 26, 3, 6, 10, 4),
(465, 26, 3, 6, 11, 5),
(466, 26, 3, 6, 12, 4),
(467, 26, 3, 6, 13, 5),
(468, 26, 3, 6, 14, 4),
(469, 26, 3, 6, 15, 5),
(470, 26, 3, 6, 16, 5),
(471, 26, 3, 6, 17, 4),
(472, 27, 3, 6, 1, 5),
(473, 27, 3, 6, 2, 4),
(474, 27, 3, 6, 3, 4),
(475, 27, 3, 6, 4, 5),
(476, 27, 3, 6, 5, 4),
(477, 27, 3, 6, 6, 4),
(478, 27, 3, 6, 7, 4),
(479, 27, 3, 6, 8, 4),
(480, 27, 3, 6, 9, 5),
(481, 27, 3, 6, 10, 4),
(482, 27, 3, 6, 11, 4),
(483, 27, 3, 6, 12, 5),
(484, 27, 3, 6, 13, 4),
(485, 27, 3, 6, 14, 5),
(486, 27, 3, 6, 15, 5),
(487, 27, 3, 6, 16, 4),
(488, 27, 3, 6, 17, 5),
(489, 28, 3, 6, 1, 5),
(490, 28, 3, 6, 2, 4),
(491, 28, 3, 6, 3, 4),
(492, 28, 3, 6, 4, 5),
(493, 28, 3, 6, 5, 5),
(494, 28, 3, 6, 6, 5),
(495, 28, 3, 6, 7, 4),
(496, 28, 3, 6, 8, 5),
(497, 28, 3, 6, 9, 5),
(498, 28, 3, 6, 10, 4),
(499, 28, 3, 6, 11, 5),
(500, 28, 3, 6, 12, 4),
(501, 28, 3, 6, 13, 5),
(502, 28, 3, 6, 14, 5),
(503, 28, 3, 6, 15, 4),
(504, 28, 3, 6, 16, 5),
(505, 28, 3, 6, 17, 4),
(506, 26, 4, 7, 1, 5),
(507, 26, 4, 7, 2, 4),
(508, 26, 4, 7, 3, 4),
(509, 26, 4, 7, 4, 4),
(510, 26, 4, 7, 5, 5),
(511, 26, 4, 7, 6, 3),
(512, 26, 4, 7, 7, 4),
(513, 26, 4, 7, 8, 5),
(514, 26, 4, 7, 9, 4),
(515, 26, 4, 7, 10, 5),
(516, 26, 4, 7, 11, 4),
(517, 26, 4, 7, 12, 5),
(518, 26, 4, 7, 13, 3),
(519, 26, 4, 7, 14, 4),
(520, 26, 4, 7, 15, 5),
(521, 26, 4, 7, 16, 4),
(522, 26, 4, 7, 17, 4),
(523, 27, 1, 7, 1, 5),
(524, 27, 1, 7, 2, 4),
(525, 27, 1, 7, 3, 4),
(526, 27, 1, 7, 4, 5),
(527, 27, 1, 7, 5, 4),
(528, 27, 1, 7, 6, 5),
(529, 27, 1, 7, 7, 5),
(530, 27, 1, 7, 8, 4),
(531, 27, 1, 7, 9, 5),
(532, 27, 1, 7, 10, 4),
(533, 27, 1, 7, 11, 5),
(534, 27, 1, 7, 12, 4),
(535, 27, 1, 7, 13, 5),
(536, 27, 1, 7, 14, 4),
(537, 27, 1, 7, 15, 5),
(538, 27, 1, 7, 16, 4),
(539, 27, 1, 7, 17, 4);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `bagian` varchar(20) NOT NULL,
  `status` varchar(15) NOT NULL,
  `pendidikan` varchar(30) NOT NULL,
  `jeniskelamin` varchar(15) NOT NULL,
  `tgl_skpertama` date NOT NULL,
  `foto` varchar(255) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `bagian`, `status`, `pendidikan`, `jeniskelamin`, `tgl_skpertama`, `foto`, `alamat`, `tanggal_lahir`) VALUES
(25, 'Mudrik, S.H.', 'Sopir', 'berhenti', 'S1 Hukum', 'Laki-laki', '2019-06-01', 'images/pegawai/Mudrik.jpg', 'Dusun I Muara Sungai, Kec. Cambai, Kota Prabumulih', '1996-12-23'),
(26, 'Ria Yunita, S.Kom.', 'Pramubakti', 'aktif', 'S1 Komputer', 'Perempuan', '2009-06-03', 'images/pegawai/Ria Yunita.jpg', 'Perum Kepodang Indah Blok D3/07 RT 002 RW 003, Kel/Desa Patih Galung, Kec. Prabumulih Barat, Kota Pr', '1988-06-21'),
(27, 'Rosuwan', 'Satpam', 'aktif', 'SMA', 'Laki-laki', '2017-01-03', 'images/pegawai/RosuwanLovepik_com-610858056-Cartoon hand drawn delicious fruit pineapple illustration.png', 'Desa Sindur', '1982-01-01'),
(28, 'Teti Handika', 'Pramubakti', 'aktif', 'SMA', 'Perempuan', '2015-01-02', 'images/pegawai/Teti Handika.jpg', 'Jalan KH Dahlan', '1996-07-16');

-- --------------------------------------------------------

--
-- Table structure for table `penilai`
--

CREATE TABLE `penilai` (
  `id_penilai` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilai`
--

INSERT INTO `penilai` (`id_penilai`, `id_user`, `nama`, `jabatan`, `foto`, `email`) VALUES
(1, 2, 'AA Oka Parama Budita Gocara', 'Ketua Pengadilan', 'images/user/2Lovepik_com-610858056-Cartoon hand drawn delicious fruit pineapple illustration.png', 'reftasepdela@gmail.com'),
(2, 3, 'Dzia Ulhaq', 'Kasubbag Kepegawaian dan Ortala', 'images/user/3Penguins.jpg', 'stdhinny@gmail.com'),
(3, 4, 'Mirsya Wijaya Kusuma', 'Panitera Muda Perdata', 'images/user/4ccb4e23c8aa216f1e96d31ab209c036b_XL.jpg', 'arnifiranisa@gmail.com'),
(4, 5, 'Denndy Firdiansyah', 'Hakim', 'images/user/5Chrysanthemum.jpg', 'muthiahnapian@gmail.com'),
(5, 6, 'M. Kamil Setiadi', 'Kasubbag Umum dan Keuangan', 'images/user/6ccb4e23c8aa216f1e96d31ab209c036b_XL.jpg', 'dhiahrana@gmail.com'),
(6, 7, 'Yudi Dharma', 'Hakim', 'images/user/7ccb4e23c8aa216f1e96d31ab209c036b_XL.jpg', 'mrsmeitiana10@gmail.com'),
(7, 8, 'M Sobirin', 'Panitera Muda Pidana', 'images/user/8ccb4e23c8aa216f1e96d31ab209c036b_XL.jpg', 'napian40007@gmail.com'),
(8, 1, 'Admin SPK PTT', '', 'images/user/1Lovepik_com-610858056-Cartoon hand drawn delicious fruit pineapple illustration.png', 'st.dhiahraniahnapian@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(4) NOT NULL,
  `kode_induk` varchar(10) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`id_kriteria`, `kode_kriteria`, `kode_induk`, `Nama`, `bobot`) VALUES
(1, 'C1', 'K1', 'Berinisiatif mencari informasi yang relevan dengan tugas yang diberikan oleh atasan.', 4),
(2, 'C2', 'K1', 'Terbuka terhadap informasi, kritik dan masukan yang diterima serta berupaya meningkatkan kompetensinya.', 4),
(3, 'C3', 'K2', 'Menyesuaikan diri secara baik dengan lingkungan kerja.', 4),
(4, 'C4', 'K2', 'Mendengarkan pendapat orang lain.', 4),
(5, 'C5', 'K2', 'Tanggap terhadap kebutuhan organisasi.', 4),
(6, 'C6', 'K1', 'Kehadiran sesuai jam kerja.', 5),
(7, 'C7', 'K3', 'Mampu bersikap sesuai peraturan yang ada.', 5),
(8, 'C8', 'K4', 'Mempunyai pertimbangan yang matang sebelum bertindak.', 4),
(9, 'C9', 'K4', 'Menunjukkan keyakinan diri dalam mengelola tugas secara mandiri, tanpa banyak memerlukan arahan.', 4),
(10, 'C10', 'K4', 'Mampu menggunakan data dan fakta yang ada di lingkungan secara obyektif dalam melaksanakan tugas.', 4),
(11, 'C11', 'K5', 'Mampu mengkomunikasikan ide secara lisan maupun tertulis sehingga orang lain mudah memahami.', 4),
(12, 'C12', 'K6', 'Segera melaksanakan tugas yang diberikan tanpa menunda-nunda.', 5),
(13, 'C13', 'K6', 'Menunjukkan upaya optimal dalam melaksanakan tugas yang diberikan.', 5),
(14, 'C14', 'K6', 'Menyelesaikan tugas yang diberikan sampai tuntas.', 5),
(15, 'C15', 'K7', 'Bertindak konsisten sesuai dengan nilai-nilai dan kebijakan organisasi.', 5),
(16, 'C16', 'K7', 'Jujur dalam menggunakan dan mengelola sumber daya di lingkup pekerjaannya.', 5),
(17, 'C17', 'K8', 'Grammar', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role` varchar(15) NOT NULL,
  `role_2` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`, `role_2`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', ''),
(2, 'kapnpbm', 'b8d0056a7f328759d58213b8f33940d0', 'ketua', ''),
(3, 'kapegortala', '387cb87f9171cd9276f19a63670eaecd', 'penilai', ''),
(4, 'pmper', '8a1de3c7d9e6ba8734bfb70870cc3f09', 'penilai', ''),
(5, 'hakim2', 'ef9371a46f6c3a757402aa261cdbca30', 'penilai', ''),
(6, 'kaumkeu', 'c37e5520dd7884ea91b88f91b12a6fed', 'penilai', ''),
(7, 'hakim1', '5e8e3302732abbc67998f8ccd0362dad', 'penilai', 'ketuapenilai'),
(8, 'pmpid', '710e423eddb7356c6caf9ee2bb6d543b', 'penilai', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`id_bobot`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_history` (`id_history`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id_history`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`kode_kriteria2`);

--
-- Indexes for table `nilai_pegawai`
--
ALTER TABLE `nilai_pegawai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_penilai` (`id_penilai`),
  ADD KEY `id_history` (`id_history`),
  ADD KEY `C2` (`id_subk`),
  ADD KEY `nilai` (`nilai`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `penilai`
--
ALTER TABLE `penilai`
  ADD PRIMARY KEY (`id_penilai`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`id_kriteria`),
  ADD KEY `kode_induk` (`kode_induk`),
  ADD KEY `bobot` (`bobot`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=509;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nilai_pegawai`
--
ALTER TABLE `nilai_pegawai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=540;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `penilai`
--
ALTER TABLE `penilai`
  MODIFY `id_penilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `nilai_pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_ibfk_2` FOREIGN KEY (`id_history`) REFERENCES `history` (`id_history`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai_pegawai`
--
ALTER TABLE `nilai_pegawai`
  ADD CONSTRAINT `nilai_pegawai_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_pegawai_ibfk_2` FOREIGN KEY (`id_penilai`) REFERENCES `penilai` (`id_penilai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_pegawai_ibfk_3` FOREIGN KEY (`id_history`) REFERENCES `history` (`id_history`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_pegawai_ibfk_4` FOREIGN KEY (`nilai`) REFERENCES `bobot` (`id_bobot`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_pegawai_ibfk_5` FOREIGN KEY (`id_subk`) REFERENCES `subkriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilai`
--
ALTER TABLE `penilai`
  ADD CONSTRAINT `penilai_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD CONSTRAINT `subkriteria_ibfk_1` FOREIGN KEY (`kode_induk`) REFERENCES `kriteria` (`kode_kriteria2`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
