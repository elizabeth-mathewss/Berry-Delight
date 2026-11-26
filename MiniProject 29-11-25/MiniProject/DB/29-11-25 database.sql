-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2025 at 05:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_miniproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(3, 'riya', 'riyaa@gmail.com', 'hgh'),
(8, 'miya', 'miya@gmail.com', 'miya'),
(17, 'eric', 'hi@gmail.com', '123'),
(18, 'Elizabeth Mathews', 'elizabethmathews230@gmail.com', 'em@12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `booking_id` int(11) NOT NULL,
  `booking_amount` int(11) NOT NULL,
  `booking_status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `booking_date` varchar(50) NOT NULL,
  `booking_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`booking_id`, `booking_amount`, `booking_status`, `user_id`, `booking_date`, `booking_address`) VALUES
(96, 1128, 2, 1, '2025-09-18', 'Raju Bhavan(H) Aluva'),
(97, 256, 2, 5, '2025-09-18', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(99, 296, 2, 5, '2025-09-18', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(100, 500, 2, 5, '2025-09-26', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(101, 200, 1, 5, '2025-09-26', 'abcd'),
(102, 148, 2, 5, '2025-09-26', 'abvcd'),
(105, 86, 2, 3, '2025-09-26', 'Canopy Apartments\r\nMathirapilly\r\nKothamangalam'),
(108, 220, 2, 5, '2025-09-26', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(109, 178, 2, 5, '2025-09-26', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(110, 86, 2, 5, '2025-09-26', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(111, 75, 2, 5, '2025-09-26', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(112, 125, 2, 5, '2025-09-26', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(113, 384, 2, 5, '2025-09-26', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(115, 64, 2, 5, '2025-09-26', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(116, 178, 2, 5, '2025-09-26', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(117, 470, 2, 2, '2025-10-02', 'Raj Bhavan(H) Aluva'),
(118, 690, 2, 2, '2025-10-02', 'Raj Bhavan(H) Aluva'),
(119, 190, 2, 2, '2025-10-02', 'Raj Bhavan(H) Aluva'),
(120, 85, 2, 4, '2025-10-02', 'White street muttom'),
(121, 105, 2, 5, '2025-10-02', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(122, 864, 2, 5, '2025-10-02', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(123, 500, 2, 5, '2025-10-02', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(124, 64, 2, 5, '2025-10-02', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(125, 172, 2, 5, '2025-10-02', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(126, 148, 2, 5, '2025-10-02', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(127, 280, 2, 5, '2025-10-02', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(128, 1240, 2, 28, '2025-10-03', 'Tulips Apartments\r\nMeenangadi P.O\r\nWayanad'),
(134, 510, 2, 5, '2025-10-03', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(135, 2480, 2, 2, '2025-10-03', 'Raj Bhavan(H) Aluva'),
(137, 920, 2, 2, '2025-10-03', 'Raj Bhavan(H) Aluva'),
(138, 192, 2, 2, '2025-10-03', 'Raj Bhavan(H) Aluva'),
(139, 693, 2, 28, '2025-10-03', 'Tulips Apartments\r\nMeenangadi P.O\r\nWayanad'),
(140, 4425, 2, 2, '2025-10-04', 'Raj Bhavan(H) Aluva'),
(141, 656, 2, 5, '2025-10-04', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(144, 3000, 2, 2, '2025-10-04', 'Raj Bhavan(H) Aluva'),
(145, 900, 2, 2, '2025-10-04', 'Raj Bhavan(H) Aluva'),
(147, 150, 1, 4, '2025-10-13', 'White street muttom'),
(148, 225, 2, 4, '2025-10-13', 'White street muttom'),
(149, 2350, 2, 1, '2025-10-13', 'Ripple Villa Kalamassery '),
(150, 880, 1, 3, '2025-10-13', 'Canopy Apartments\r\nMathirapilly\r\nKothamangalam'),
(151, 660, 1, 3, '2025-10-13', 'Canopy Apartments\r\nMathirapilly\r\nKothamangalam'),
(152, 660, 2, 3, '2025-10-13', 'Canopy Apartments\r\nMathirapilly\r\nKothamangalam'),
(153, 1330, 2, 28, '2025-10-13', 'Tulips Apartments\r\nMeenangadi P.O\r\nWayanad'),
(154, 425, 2, 28, '2025-10-13', 'Tulips Apartments\r\nMeenangadi P.O\r\nWayanad'),
(155, 1155, 2, 1, '2025-10-15', 'Ripple Villa Kalamassery '),
(156, 356, 2, 2, '2025-10-29', 'Raj Bhavan(H) Aluva'),
(157, 500, 2, 1, '2025-10-29', 'Ripple Villa Kalamassery '),
(158, 560, 2, 1, '2025-10-29', 'Ripple Villa Kalamassery '),
(159, 260, 2, 5, '2025-10-29', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(160, 225, 2, 5, '2025-10-29', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(162, 380, 2, 2, '2025-10-30', 'Raj Bhavan(H) Aluva'),
(164, 1320, 2, 5, '2025-10-30', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(165, 375, 2, 1, '2025-10-30', 'Ripple Villa Kalamassery '),
(166, 560, 2, 1, '2025-10-30', 'Ripple Villa Kalamassery '),
(167, 460, 2, 3, '2025-10-30', 'Canopy Apartments\r\nMathirapilly\r\nKothamangalam'),
(168, 500, 2, 3, '2025-10-30', 'Canopy Apartments\r\nMathirapilly\r\nKothamangalam'),
(169, 258, 2, 3, '2025-10-30', 'Canopy Apartments\r\nMathirapilly\r\nKothamangalam'),
(170, 924, 2, 1, '2025-10-30', 'Ripple Villa Kalamassery '),
(171, 444, 2, 1, '2025-10-30', 'Ripple Villa Kalamassery '),
(172, 633, 2, 28, '2025-10-30', 'Tulips Apartments\r\nMeenangadi P.O\r\nWayanad'),
(173, 705, 2, 28, '2025-10-30', 'Tulips Apartments\r\nMeenangadi P.O\r\nWayanad'),
(175, 422, 2, 28, '2025-10-30', 'Tulips Apartments\r\nMeenangadi P.O\r\nWayanad'),
(176, 1120, 2, 4, '2025-10-30', 'White street muttom'),
(177, 1386, 2, 4, '2025-10-30', 'White street muttom'),
(179, 172, 2, 2, '2025-10-30', 'Raj Bhavan(H) Aluva'),
(181, 492, 2, 5, '2025-10-31', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(182, 288, 2, 3, '2025-10-31', 'Canopy Apartments\r\nMathirapilly\r\nKothamangalam'),
(183, 880, 2, 1, '2025-10-31', 'Ripple Villa Kalamassery '),
(184, 600, 2, 28, '2025-10-31', 'Tulips Apartments\r\nMeenangadi P.O\r\nWayanad'),
(185, 705, 2, 4, '2025-10-31', 'White street muttom'),
(186, 1155, 2, 5, '2025-10-31', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(187, 633, 2, 5, '2025-10-31', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam'),
(188, 210, 2, 1, '2025-11-18', 'Ripple Villa Kalamassery '),
(189, 422, 2, 32, '2025-11-18', 'rrrrrrrdsese sm jn panampally'),
(190, 470, 2, 32, '2025-11-18', 'rrrrrrrdsese sm jn panampally'),
(191, 460, 2, 1, '2025-11-20', 'Ripple Villa Kalamassery '),
(192, 0, 0, 1, '2025-11-20', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `cart_qty` int(11) NOT NULL DEFAULT 1,
  `booking_id` int(11) NOT NULL,
  `cart_status` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `cart_qty`, `booking_id`, `cart_status`, `product_id`) VALUES
(107, 3, 61, 4, 92),
(108, 1, 62, 2, 95),
(109, 1, 63, 4, 76),
(110, 1, 64, 2, 83),
(112, 1, 66, 1, 78),
(114, 2, 68, 4, 78),
(115, 2, 68, 4, 77),
(116, 1, 67, 1, 82),
(117, 1, 67, 1, 90),
(121, 1, 70, 1, 81),
(123, 1, 71, 1, 76),
(124, 2, 72, 2, 97),
(127, 1, 73, 1, 89),
(129, 1, 75, 1, 76),
(130, 1, 75, 1, 77),
(131, 3, 76, 4, 87),
(133, 1, 78, 4, 92),
(135, 1, 78, 4, 94),
(136, 1, 79, 1, 82),
(137, 1, 79, 1, 90),
(138, 1, 80, 4, 94),
(140, 1, 81, 2, 87),
(141, 1, 81, 1, 81),
(142, 3, 82, 1, 92),
(144, 1, 82, 1, 87),
(145, 3, 83, 1, 92),
(147, 3, 84, 1, 92),
(149, 3, 85, 1, 92),
(153, 1, 86, 0, 95),
(155, 1, 86, 0, 77),
(156, 1, 87, 1, 87),
(157, 1, 87, 1, 85),
(158, 1, 87, 4, 94),
(160, 1, 89, 1, 84),
(165, 1, 89, 1, 81),
(167, 1, 90, 2, 92),
(176, 1, 91, 1, 92),
(177, 1, 91, 2, 96),
(178, 1, 91, 1, 80),
(179, 2, 92, 1, 78),
(181, 3, 94, 1, 79),
(187, 2, 96, 4, 80),
(188, 4, 96, 4, 83),
(191, 4, 97, 2, 90),
(193, 1, 98, 1, 85),
(194, 2, 99, 4, 82),
(196, 1, 100, 4, 81),
(198, 1, 100, 1, 84),
(199, 1, 101, 1, 83),
(200, 1, 102, 1, 82),
(201, 3, 103, 1, 80),
(202, 1, 103, 1, 89),
(203, 3, 104, 1, 82),
(204, 1, 105, 4, 87),
(205, 1, 106, 0, 86),
(207, 1, 108, 4, 81),
(208, 1, 109, 3, 85),
(209, 1, 110, 3, 87),
(210, 1, 111, 2, 86),
(211, 1, 112, 4, 96),
(212, 4, 113, 4, 94),
(214, 1, 115, 1, 90),
(215, 1, 116, 2, 85),
(216, 2, 117, 4, 97),
(217, 3, 118, 4, 77),
(219, 1, 119, 3, 79),
(220, 1, 120, 1, 89),
(221, 1, 121, 1, 88),
(222, 9, 122, 2, 94),
(223, 4, 123, 2, 96),
(224, 1, 124, 1, 90),
(225, 2, 125, 1, 87),
(226, 1, 126, 1, 82),
(228, 1, 127, 1, 84),
(229, 10, 128, 4, 76),
(234, 80, 133, 1, 77),
(238, 20, 135, 3, 76),
(239, 20, 136, 1, 76),
(240, 4, 137, 3, 77),
(241, 3, 138, 1, 90),
(242, 6, 134, 1, 89),
(243, 3, 139, 1, 93),
(256, 4, 141, 1, 80),
(279, 1, 142, 0, 77),
(282, 59, 140, 1, 86),
(283, 1, 143, 0, 85),
(284, 40, 144, 1, 86),
(285, 12, 145, 1, 86),
(306, 2, 147, 1, 86),
(307, 3, 148, 3, 86),
(308, 10, 149, 1, 97),
(309, 4, 150, 1, 91),
(310, 3, 151, 1, 91),
(311, 3, 152, 4, 91),
(312, 7, 153, 1, 79),
(314, 5, 154, 1, 89),
(315, 5, 155, 1, 93),
(318, 2, 156, 1, 85),
(319, 4, 157, 1, 96),
(320, 2, 158, 1, 84),
(321, 1, 159, 2, 78),
(322, 3, 160, 2, 86),
(323, 1, 161, 0, 81),
(324, 2, 162, 1, 79),
(325, 2, 163, 1, 88),
(326, 6, 164, 1, 91),
(327, 3, 165, 1, 96),
(328, 2, 166, 1, 84),
(329, 2, 167, 1, 77),
(330, 4, 168, 1, 96),
(331, 3, 169, 1, 87),
(332, 4, 170, 1, 93),
(333, 3, 171, 1, 82),
(334, 3, 172, 1, 92),
(335, 3, 173, 1, 97),
(336, 1, 174, 1, 76),
(337, 2, 175, 1, 92),
(339, 4, 176, 1, 84),
(347, 6, 177, 1, 93),
(350, 2, 178, 2, 87),
(351, 2, 179, 2, 87),
(352, 2, 180, 1, 89),
(353, 3, 181, 1, 80),
(354, 3, 182, 1, 94),
(355, 4, 183, 1, 81),
(356, 3, 184, 1, 83),
(358, 3, 185, 1, 97),
(359, 5, 186, 1, 93),
(364, 3, 187, 1, 92),
(365, 2, 188, 2, 88),
(366, 2, 189, 1, 92),
(367, 2, 190, 1, 97),
(369, 2, 191, 4, 77),
(370, 1, 192, 0, 78);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(11, 'Cashew Nuts'),
(13, 'Dates'),
(14, 'Almonds'),
(15, 'Raisins'),
(16, 'Pista'),
(17, 'Dried mango'),
(18, 'Dried apricot'),
(19, 'Dried kiwi'),
(20, 'Apricot turkel'),
(21, 'Dried figs'),
(22, 'Hazelnut'),
(23, 'Walnut'),
(27, 'Badam');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `complaint_id` int(11) NOT NULL,
  `complaint_title` varchar(50) NOT NULL,
  `complaint_content` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `complaint_status` int(11) NOT NULL DEFAULT 0,
  `complaint_reply` varchar(500) NOT NULL,
  `complaint_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_complaint`
--

INSERT INTO `tbl_complaint` (`complaint_id`, `complaint_title`, `complaint_content`, `user_id`, `complaint_status`, `complaint_reply`, `complaint_date`) VALUES
(2, 'complaint', 'the product is not upto the mark', 2, 1, 'will check ', '2025-05-28'),
(3, 'complaint', 'Packing was not proper.', 2, 1, 'will rectify.', '2025-05-28'),
(5, 'complaint', 'Damage in product.', 2, 1, 'will check and rectify.', '2025-07-04'),
(6, 'complaint', 'product quality\r\n', 3, 1, 'will check and rectify.', '2025-08-30'),
(9, 'Complaint', 'Damaged product. packing was not proper.', 3, 0, '', '2025-09-13'),
(10, 'complaint', 'Packing was not proper.\r\n', 1, 0, '', '2025-09-18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`) VALUES
(2, 'Kozhikode'),
(6, 'Kollam'),
(7, 'Ernakulam'),
(8, 'Kottayam'),
(10, 'Idukki'),
(11, 'Alappuzha'),
(12, 'Kannur'),
(13, 'Kasaragod'),
(14, 'Pathanamthitta'),
(15, 'Palakkad'),
(16, 'Malappuram'),
(17, 'Wayanad'),
(19, 'Thrissur'),
(20, 'Thiruvananthapuram');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback_content` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `feedback_datetime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`feedback_id`, `feedback_content`, `user_id`, `feedback_datetime`) VALUES
(14, 'Average', 2, '2025-09-13 14:38:28'),
(15, 'Very flexible', 4, '2025-09-14 00:09:53'),
(16, 'Not bad', 3, '2025-09-14 11:34:44'),
(18, 'User friendly', 5, '2025-09-14 13:11:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(50) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `place_name`, `district_id`) VALUES
(4, 'Kalamassery', 7),
(5, 'Muvattupuzha', 7),
(6, 'Vyttila', 7),
(9, 'Thirur', 2),
(13, 'Edacheri', 2),
(14, 'Punalur', 6),
(15, 'Karunagappally', 6),
(16, 'Vaikom', 8),
(17, 'Erattupetta', 8),
(18, 'Haripad', 11),
(19, 'Chengannur', 11),
(20, 'Adimali', 10),
(21, 'Munnar', 10),
(22, 'Aluva', 7),
(23, 'Perumbavoor', 7),
(24, 'Kothamangalam', 7),
(25, 'Pulinchode', 7),
(26, 'Angamaly', 7),
(27, 'Cheranallur', 7),
(28, 'Chottanikkara', 7),
(29, 'Kaloor', 7),
(31, 'Kolenchery', 7),
(32, 'Maradu', 7),
(33, 'Pampakuda', 7),
(34, 'Feroke', 2),
(35, 'Koduvally', 2),
(36, 'Mavoor', 2),
(37, 'Perambra', 2),
(38, 'Thiruvambady', 2),
(39, 'Ayoor', 6),
(40, 'Chathannoor', 6),
(41, 'Nilamel', 6),
(42, 'Kottarakkara', 6),
(43, 'Pala', 8),
(44, 'Ettumanoor', 8),
(45, 'Manarcaud', 8),
(46, 'Teekoy', 8),
(47, 'Pampady', 8),
(48, 'Kumily', 10),
(49, 'Kattappana', 10),
(50, 'Thekkady', 10),
(51, 'Thodupuzha', 10),
(52, 'Marayur', 10),
(53, 'Aroor', 11),
(54, 'Kayamkulam', 11),
(55, 'Cherthala', 11),
(56, 'Mannar', 11),
(57, 'Mavelikkara', 11),
(58, 'Kadachira', 12),
(59, 'Alakode', 12),
(60, 'Payyanur', 12),
(61, 'Maniyoor', 12),
(62, 'Azhikode', 12),
(63, 'Bekal', 13),
(64, 'Kumbla', 13),
(65, 'Nileshwar', 13),
(66, 'Trikaripur', 13),
(67, 'Uppala', 13),
(68, 'Aranmula', 14),
(69, 'Anicadu', 14),
(70, 'Chengara', 14),
(71, 'Peringara', 14),
(72, 'Plappally', 14),
(73, 'Parakode', 14),
(74, 'Chittur', 15),
(75, 'Malampuzha', 15),
(76, 'Kalpathy', 15),
(77, 'Pattambi', 15),
(78, 'Puthur', 15),
(79, 'Kondotty', 16),
(80, 'Kottakkal', 16),
(81, 'Manjeri', 16),
(82, 'Nilambur', 16),
(83, 'Ponnani', 16),
(84, 'Kalpetta', 17),
(85, 'Mananthavady', 17),
(86, 'Meenangadi', 17),
(87, 'Sultan Bathery', 17),
(88, 'Pulpally', 17),
(89, 'Kovalam', 18),
(90, 'Kudavoor', 18),
(91, 'Venjarammoodu', 18),
(92, 'Pothencode', 18),
(93, 'Poovar', 18),
(94, 'Pangode', 18),
(95, 'Maranalloor', 18),
(96, 'Guruvayur', 19),
(97, 'Irinjalakuda', 19),
(98, 'Koratty', 19),
(99, 'Vallachira', 19),
(100, 'Triprayar', 19),
(101, 'Kechery', 19),
(103, 'Kazhakoottam', 20),
(104, 'Puvar', 20);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_description` varchar(300) NOT NULL,
  `product_price` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `product_photo` varchar(50) NOT NULL,
  `product_date` date NOT NULL,
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_description`, `product_price`, `subcategory_id`, `product_photo`, `product_date`, `seller_id`) VALUES
(76, 'Jumbo Almond', 'Helps to increase immunity power', 124, 28, 'freshalmond.jpg', '2025-09-03', 3),
(77, 'Walnut kernels', 'Highly nutritious', 230, 48, 'walnutker.jfif', '2025-09-03', 3),
(78, 'Pista plain', 'Boost health\r\n', 260, 39, 'pista.jpg', '2025-09-03', 3),
(79, 'Soft dates', 'Improved digestion', 190, 21, 'dates.jpg', '2025-09-03', 4),
(80, 'Jumbo nuts', 'Nutritious', 164, 27, 'cashew.webp', '2025-09-03', 4),
(81, 'Salted and roasted nuts', 'Rich in protein and fiber', 220, 30, 'saltednuts.avif', '2025-09-03', 4),
(82, 'Dry dates', 'Rich in minerals', 148, 31, 'OIP.jpg', '2025-09-03', 5),
(83, 'Oman dates', 'Nutritious', 200, 32, 'omandates.webp', '2025-09-03', 5),
(84, 'Salted pista', 'Nutritious', 280, 40, 'salpista.webp', '2025-09-03', 5),
(85, 'Pista akbari', 'Rich in vitamins', 178, 41, 'pista akbari.webp', '2025-09-03', 8),
(86, 'Black raisins', 'Promote healthy skin', 75, 34, 'black raisins.webp', '2025-09-03', 8),
(87, 'Munakka raisins', 'Support bone strength', 86, 35, 'Munakka_Raisins.jpg', '2025-09-03', 8),
(88, 'Afghan raisins', 'Rich in iron, immune booster', 105, 36, 'afghan-raisin.webp', '2025-09-03', 8),
(89, 'Afghan long raisins', 'Nutritious', 85, 37, 'kashmari-long-raisins.jpg', '2025-09-08', 5),
(90, 'Round raisins', 'Rich in protein', 64, 38, 'yellow_round.webp', '2025-09-08', 5),
(91, 'Dried Figs', 'Protein', 220, 46, 'dried-figs-anjee_1024x1024.webp', '2025-09-08', 9),
(92, 'Turkish Dried Apricot', 'Highly nutritious', 211, 42, 'dried apricots.jpg', '2025-09-08', 9),
(93, 'Organic Dried kiwi', 'Rich in vitamins', 231, 44, 'Dried-Kiw.jpg', '2025-09-11', 9),
(94, 'Organic Dried mango', 'Rich in fiber\r\n\r\n\r\n', 96, 43, 'dried-mango.jpg', '2025-09-11', 9),
(95, 'Mamra almond', 'Rich in vitamin E, calcium', 380, 33, 'mamraaa almond.jpg', '2025-09-11', 11),
(96, 'Dried Apricot turkel', 'Rich in vitamin A', 125, 45, 'apricot turkel.jpg', '2025-09-11', 11),
(97, 'Turkish hazelnut', 'Rich in magnesium, vitamin E\r\n', 235, 47, 'hazhel.jfif', '2025-09-11', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productqty`
--

CREATE TABLE `tbl_productqty` (
  `productqty_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity_id` int(11) NOT NULL,
  `productqty_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_productqty`
--

INSERT INTO `tbl_productqty` (`productqty_id`, `product_id`, `quantity_id`, `productqty_price`) VALUES
(139, 76, 10, 124),
(140, 77, 10, 230),
(141, 78, 10, 260),
(142, 79, 10, 190),
(147, 80, 10, 164),
(148, 81, 10, 220),
(149, 82, 10, 148),
(150, 83, 10, 200),
(151, 84, 10, 280),
(152, 89, 10, 85),
(153, 90, 10, 64),
(154, 85, 10, 178),
(155, 86, 10, 75),
(156, 87, 10, 86),
(157, 88, 10, 105),
(158, 91, 10, 220),
(159, 92, 10, 211),
(160, 93, 10, 231),
(161, 94, 10, 96),
(162, 95, 10, 380),
(163, 96, 10, 125),
(164, 97, 10, 235);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quantity`
--

CREATE TABLE `tbl_quantity` (
  `quantity_id` int(11) NOT NULL,
  `quantity_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_quantity`
--

INSERT INTO `tbl_quantity` (`quantity_id`, `quantity_name`) VALUES
(10, '100'),
(19, '250'),
(20, '500'),
(21, '1000'),
(22, '2000'),
(25, '5000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `review_id` int(11) NOT NULL,
  `review_content` varchar(50) NOT NULL,
  `review_rating` int(11) NOT NULL,
  `review_datetime` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_review`
--

INSERT INTO `tbl_review` (`review_id`, `review_content`, `review_rating`, `review_datetime`, `user_id`, `product_id`) VALUES
(24, 'ok', 2, '2025-09-13 10:08:25', 2, 95),
(25, 'good', 5, '2025-09-13 10:09:32', 2, 78),
(26, 'Amazing', 4, '2025-09-13 10:12:37', 2, 82),
(27, 'good', 3, '2025-09-13 11:32:53', 3, 81),
(28, 'Average', 3, '2025-09-13 12:51:18', 4, 97),
(29, 'ok\n', 4, '2025-09-13 12:51:34', 4, 76),
(30, 'Good one. Packing was appropriate.\n', 3, '2025-09-14 00:08:24', 4, 76),
(31, 'Good quality', 5, '2025-09-14 11:28:29', 3, 87),
(32, 'Good', 4, '2025-09-14 11:52:31', 4, 92),
(33, 'It was good', 3, '2025-09-14 11:53:01', 4, 93),
(34, 'Good packing', 5, '2025-09-14 11:53:32', 4, 94),
(35, 'Worth of price. ', 4, '2025-09-14 12:31:29', 5, 82),
(36, 'Good quality raisins', 5, '2025-09-14 12:36:29', 5, 90),
(37, 'Good', 4, '2025-09-14 13:11:31', 5, 94),
(39, 'bad', 1, '2025-09-15 20:39:33', 5, 87),
(40, 'product was good and fair price\n', 5, '2025-09-15 20:40:09', 5, 85),
(41, 'Satisfactory\n', 3, '2025-09-17 08:48:49', 2, 78),
(42, 'quality wise good\n\n', 4, '2025-09-18 10:38:45', 1, 80),
(43, '100% quality', 5, '2025-09-18 11:42:26', 5, 90),
(44, 'awesome\n', 5, '2025-10-02 15:25:48', 2, 97);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seller`
--

CREATE TABLE `tbl_seller` (
  `seller_id` int(11) NOT NULL,
  `seller_name` varchar(50) NOT NULL,
  `seller_email` varchar(50) NOT NULL,
  `seller_contact` varchar(50) NOT NULL,
  `seller_address` varchar(50) NOT NULL,
  `seller_photo` varchar(50) NOT NULL,
  `seller_proof` varchar(50) NOT NULL,
  `seller_password` varchar(50) NOT NULL,
  `place_id` int(11) NOT NULL,
  `seller_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_seller`
--

INSERT INTO `tbl_seller` (`seller_id`, `seller_name`, `seller_email`, `seller_contact`, `seller_address`, `seller_photo`, `seller_proof`, `seller_password`, `place_id`, `seller_status`) VALUES
(2, 'Niya', 'niya12@gmail.com', '8985656500', 'Old Golden Lane Aluva', 'youngwoman.jpg', 'aadhaar women.png', 'niya', 9, 2),
(3, 'Roshini shyam', 'roshini@gmail.com', '9803475439', 'Whales street\nmuvattupuzha', 'youngwoman.jpg', 'aadhaar women.png', 'roshh', 4, 1),
(4, 'Nanda Madhavan', 'nanda@gmail.com', '6239865439', 'Rose Villa\r\nVyttila\r\n', 'youngwoman.jpg', 'aadhaar women.png', 'nandaM12', 6, 1),
(5, 'Vandhana Vinod', 'vandhanavinod2005@gmail.com', '6282000482', 'Malini nivas(H)\nperiyar gardens\nkadayiruppu', 'youngwoman.jpg', 'aadhaar women.png', '1234567', 5, 1),
(8, 'Arun Asok', 'arun@gmail.com', '9864563444', 'Ram Nivas(H)\r\nkuttamassery', 'businessman.png', 'aadhar men.webp', 'arun12', 22, 1),
(9, 'Anna Mathews', 'annamathews304@gmail.com', '6878735656', 'Kalarickal(H)\r\nIrinjalakuda P.O\r\nThrissur', 'youngwoman.jpg', 'aadhaar women.png', 'anna@m', 97, 1),
(11, 'Neethin K Saju', 'neethinksaju@gmail.com', '9864563340', 'Kakkuzhiyil(H)\nKazhakoottam P.O\nTrivandrum', 'businessman.png', 'aadhar men.webp', 'Neethin12', 103, 1),
(12, 'Midhun Das', 'midhun@gmail.com', '8734245811', 'Evergreen Villa\r\nChengara P.O\r\nPathanamthitta', 'businessman.png', 'aadhar men.webp', 'Midhun@d1', 70, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `stock_id` int(11) NOT NULL,
  `stock_qty` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `stock_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`stock_id`, `stock_qty`, `product_id`, `stock_date`) VALUES
(119, '50', 80, '2025-09-18'),
(120, '60', 81, '2025-09-18'),
(121, '60', 82, '2025-09-18'),
(122, '60', 83, '2025-09-18'),
(123, '60', 84, '2025-09-18'),
(124, '60', 89, '2025-09-18'),
(125, '60', 90, '2025-09-18'),
(126, '60', 85, '2025-09-18'),
(128, '60', 87, '2025-09-18'),
(129, '60', 88, '2025-09-18'),
(130, '40', 91, '2025-09-18'),
(131, '60', 92, '2025-09-18'),
(132, '60', 93, '2025-09-18'),
(133, '60', 94, '2025-09-18'),
(134, '60', 93, '2025-09-18'),
(135, '40', 94, '2025-09-18'),
(136, '60', 95, '2025-09-18'),
(137, '60', 96, '2025-09-18'),
(138, '60', 97, '2025-09-18'),
(142, '60', 79, '2025-10-02'),
(154, '50', 78, '2025-10-04'),
(167, '100', 76, '2025-10-04'),
(170, '100', 77, '2025-10-04'),
(173, '120', 86, '2025-10-04'),
(176, '140', 86, '2025-10-29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subcategory`
--

INSERT INTO `tbl_subcategory` (`subcategory_id`, `subcategory_name`, `category_id`) VALUES
(21, 'Soft dates', 13),
(27, 'Jumbo nuts', 11),
(28, 'Jumbo almond', 14),
(30, 'Salted and Roasted nuts', 11),
(31, 'Dry dates', 13),
(32, 'Oman dates', 13),
(33, 'Mamra almond', 14),
(34, 'Black raisins', 15),
(35, 'Munakka raisins', 15),
(36, 'Afghan raisins', 15),
(37, 'Afghan long raisins', 15),
(38, 'Round raisins', 15),
(39, 'Pista plain', 16),
(40, 'Salted pista', 16),
(41, 'Pista akbari', 16),
(42, 'Turkish dried apricot', 18),
(43, 'Organic dried mango', 17),
(44, 'Organic dried kiwi', 19),
(45, 'Dried apricot turkel', 20),
(46, 'Organic dried figs', 21),
(47, 'Turkish hazelnut', 22),
(48, 'Walnut kernels', 23);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_address` varchar(50) NOT NULL,
  `user_photo` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `place_id` int(11) NOT NULL,
  `user_contact` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_email`, `user_address`, `user_photo`, `user_password`, `place_id`, `user_contact`) VALUES
(1, 'Seetha Vijay', 'seetha@gmail.com', 'Ripple Villa Kalamassery ', 'youngwoman.jpg', 'seetha', 4, '8734243221'),
(2, 'Seena John', 'seena@gmail.com', 'Raj Bhavan(H) Aluva', 'youngwoman.jpg', '123', 4, '8985656544'),
(3, 'Maria George', 'mariageorge@gmail.com', 'Canopy Apartments\r\nMathirapilly\r\nKothamangalam', 'youngwoman.jpg', 'maria12GY', 5, '9864556321'),
(4, 'Mary Samuel', 'mary@gmail.com', 'White street muttom', 'youngwoman.jpg', 'Mary@341', 4, '8567329561'),
(5, 'Alen Paul Saji', 'alensaji323@gmail.com', 'Kanjirathumveettil(H)\r\nNilamel P.O\r\nKollam', 'businessman.png', 'Alennn05', 41, '9724278321'),
(28, 'Aleena Sara Eldo', 'aleenasaraeldho@gmail.com', 'Tulips Apartments\r\nMeenangadi P.O\r\nWayanad', 'youngwoman.jpg', 'Aleena@123', 86, '9864554123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_productqty`
--
ALTER TABLE `tbl_productqty`
  ADD PRIMARY KEY (`productqty_id`);

--
-- Indexes for table `tbl_quantity`
--
ALTER TABLE `tbl_quantity`
  ADD PRIMARY KEY (`quantity_id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `tbl_seller`
--
ALTER TABLE `tbl_seller`
  ADD PRIMARY KEY (`seller_id`);

--
-- Indexes for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `tbl_productqty`
--
ALTER TABLE `tbl_productqty`
  MODIFY `productqty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `tbl_quantity`
--
ALTER TABLE `tbl_quantity`
  MODIFY `quantity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_seller`
--
ALTER TABLE `tbl_seller`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
