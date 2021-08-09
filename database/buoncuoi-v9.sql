-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2016 at 04:26 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buoncuoi`
--

-- --------------------------------------------------------

--
-- Table structure for table `bai_viet`
--

CREATE TABLE `bai_viet` (
  `ma_bai_viet` int(11) NOT NULL,
  `ma_user` int(11) NOT NULL,
  `ma_danh_muc` int(11) NOT NULL,
  `tieu_de` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `loai_file` tinyint(1) NOT NULL,
  `trang_thai` tinyint(1) NOT NULL DEFAULT '0',
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bai_viet`
--

INSERT INTO `bai_viet` (`ma_bai_viet`, `ma_user`, `ma_danh_muc`, `tieu_de`, `loai_file`, `trang_thai`, `link`, `ngay_tao`) VALUES
(38, 16, 6, 'Äá»ƒ Ã½ sá»± khÃ¡c biá»‡t ', 0, 1, 'deykhac.jpg', '2016-09-09 21:13:03'),
(39, 17, 7, 'Báº¡n cÃ³ tháº¥y con gÃ¡i máº·c vest háº¥p dáº«n khÃ´ng?', 0, 0, 'girl.jpg', '2016-09-09 21:13:25'),
(40, 17, 8, 'Derby thÃ nh Manchester nhá»¯ng nÄƒm 70', 0, 0, 'derby.jpg', '2016-09-09 21:13:40'),
(42, 17, 8, 'Tráº­n Ä‘áº¥u cuá»‘i cÃ¹ng', 0, 0, 'Schweinsteiger.jpg', '2016-09-09 21:14:15'),
(43, 17, 5, 'Hack nÃ£o ', 0, 0, 'hack.jpg', '2016-09-09 21:21:43'),
(44, 16, 5, 'T.S. khÃ´ng pháº£i Taylor Swift !', 0, 0, 'loki.jpg', '2016-09-09 21:22:19'),
(50, 17, 5, 'test', 0, 1, 'Screen Shot 2016-09-13 at 3.44.15 AM.jpg', '2016-09-13 20:48:43');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `ma_comment` int(11) NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `ma_bai_viet` int(11) NOT NULL,
  `ma_user` int(11) NOT NULL,
  `trang_thai` tinyint(1) NOT NULL,
  `ngay_tao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`ma_comment`, `noi_dung`, `ma_bai_viet`, `ma_user`, `trang_thai`, `ngay_tao`) VALUES
(2, 'comment2', 1, 3, 0, '0000-00-00 00:00:00'),
(3, 'sadsadsadsadsadcadsmb v,jsDbv,aw v sa.vwwrnvmds vvn.,sa fanbreanbraenb,mfsa ,.afnbrwnvlewnvwe.', 37, 16, 1, '0000-00-00 00:00:00'),
(5, 'abc', 37, 16, 1, '0000-00-00 00:00:00'),
(6, 'test', 37, 16, 1, '2016-09-11 21:06:32'),
(7, 'hay', 46, 17, 1, '2016-09-12 01:26:30'),
(16, 'n', 45, 16, 1, '2016-09-13 15:51:00');

-- --------------------------------------------------------

--
-- Table structure for table `danh_muc`
--

CREATE TABLE `danh_muc` (
  `ma_danh_muc` int(11) NOT NULL,
  `thu_tu` int(11) NOT NULL,
  `trang_thai` tinyint(1) NOT NULL,
  `ten_danh_muc` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `danh_muc`
--

INSERT INTO `danh_muc` (`ma_danh_muc`, `thu_tu`, `trang_thai`, `ten_danh_muc`) VALUES
(5, 1, 1, 'Phim áº£nh'),
(6, 2, 1, 'Manga vÃ  anime'),
(7, 3, 1, 'Con gÃ¡i'),
(8, 4, 1, 'Thá»ƒ thao');

-- --------------------------------------------------------

--
-- Table structure for table `thich`
--

CREATE TABLE `thich` (
  `like_dislike` tinyint(4) NOT NULL,
  `ma_bai_viet` int(11) NOT NULL,
  `ma_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `thich`
--

INSERT INTO `thich` (`like_dislike`, `ma_bai_viet`, `ma_user`) VALUES
(0, 38, 16),
(1, 38, 17),
(0, 39, 16),
(1, 40, 16),
(0, 42, 16),
(1, 43, 16),
(0, 43, 17),
(1, 44, 16),
(0, 44, 17),
(1, 45, 17),
(1, 49, 16),
(1, 50, 16),
(0, 50, 17);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ma_user` int(11) NOT NULL,
  `ten_user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `loai_user` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: TK thường 1: Admin',
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_sinh` date NOT NULL,
  `avatar` text COLLATE utf8_unicode_ci NOT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0: Ẩn  1:Hiện',
  `biet_danh` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ma_user`, `ten_user`, `password`, `loai_user`, `email`, `ngay_sinh`, `avatar`, `trang_thai`, `biet_danh`) VALUES
(1, 'nguyenquangA', 'fcea920f7412b5da7be0cf42b8c93759', 1, 'quangA@gmail.com', '1995-02-25', 'nguyenquangA_andrew.png', 1, 'tenB'),
(3, 'nguyenquangB', 'fcea920f7412b5da7be0cf42b8c93759', 0, 'dred@gmail.com', '1980-05-02', 'nguyenquangB_download.jpg', 1, ''),
(4, 'nguyenquangC', 'dce275736d660c39f68d6c7724a9591e', 0, 'quangC@gmail.com', '1960-02-05', 'nguyenquangC_download.jpg', 1, ''),
(6, 'nguyenquangD', 'fcea920f7412b5da7be0cf42b8c93759', 0, 'quangD@gmail.com', '1960-02-05', 'nguyenquangD_andrew.png', 1, ''),
(16, 'adminadmin', 'e10adc3949ba59abbe56e057f20f883e', 1, 'sdrewr@g.com', '1995-02-25', 'adminadmin_andrew.png', 1, 'ASSMIN'),
(17, 'tombeo96', 'e10adc3949ba59abbe56e057f20f883e', 0, 'a@a.a', '1111-11-11', 'tombeo96_Screen Shot 2016-08-31 at 10.17.29 PM.jpg', 1, 'tom');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bai_viet`
--
ALTER TABLE `bai_viet`
  ADD PRIMARY KEY (`ma_bai_viet`),
  ADD KEY `ma_danh_muc` (`ma_danh_muc`),
  ADD KEY `ma_user` (`ma_user`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`ma_comment`),
  ADD KEY `ma_san_pham` (`ma_bai_viet`),
  ADD KEY `ma_user` (`ma_user`),
  ADD KEY `ma_bai_viet` (`ma_bai_viet`),
  ADD KEY `ma_user_2` (`ma_user`);

--
-- Indexes for table `danh_muc`
--
ALTER TABLE `danh_muc`
  ADD PRIMARY KEY (`ma_danh_muc`);

--
-- Indexes for table `thich`
--
ALTER TABLE `thich`
  ADD PRIMARY KEY (`ma_bai_viet`,`ma_user`),
  ADD KEY `ma_bai_viet` (`ma_bai_viet`),
  ADD KEY `ma_user` (`ma_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ma_user`),
  ADD UNIQUE KEY `ten_user` (`ten_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bai_viet`
--
ALTER TABLE `bai_viet`
  MODIFY `ma_bai_viet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `ma_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `danh_muc`
--
ALTER TABLE `danh_muc`
  MODIFY `ma_danh_muc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ma_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bai_viet`
--
ALTER TABLE `bai_viet`
  ADD CONSTRAINT `FK_sanPham_danhMuc` FOREIGN KEY (`ma_danh_muc`) REFERENCES `danh_muc` (`ma_danh_muc`),
  ADD CONSTRAINT `FK_sanPham_user` FOREIGN KEY (`ma_user`) REFERENCES `user` (`ma_user`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`ma_user`) REFERENCES `user` (`ma_user`);

--
-- Constraints for table `thich`
--
ALTER TABLE `thich`
  ADD CONSTRAINT `thich_ibfk_1` FOREIGN KEY (`ma_bai_viet`) REFERENCES `bai_viet` (`ma_bai_viet`),
  ADD CONSTRAINT `thich_ibfk_2` FOREIGN KEY (`ma_user`) REFERENCES `user` (`ma_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
