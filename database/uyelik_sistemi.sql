-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2023 at 07:46 AM
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
-- Database: `uyelik_sistemi`
--

-- --------------------------------------------------------

--
-- Table structure for table `cekler`
--

CREATE TABLE `cekler` (
  `id` int(11) NOT NULL,
  `cek_numarasi` varchar(128) NOT NULL,
  `banka_bilgisi` varchar(128) NOT NULL,
  `cek_tarihi` date NOT NULL,
  `cek_durumu` varchar(128) NOT NULL,
  `alici_bilgisi` varchar(128) NOT NULL,
  `odeme_miktari` varchar(128) NOT NULL,
  `para_birimi` varchar(128) NOT NULL,
  `referans_numarasi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cekler`
--

INSERT INTO `cekler` (`id`, `cek_numarasi`, `banka_bilgisi`, `cek_tarihi`, `cek_durumu`, `alici_bilgisi`, `odeme_miktari`, `para_birimi`, `referans_numarasi`) VALUES
(1, '7364892775', 'Vakıfbank', '3454-02-21', 'Başarılı', 'Hüseyin Salim', '555', 'Dolar', '5665430039'),
(2, '5868399592', 'Garanti AŞ', '4533-03-21', 'Karşılıksız', 'Melisa Erkuş', '3540', 'Euro', '56259305883'),
(4, '45346346346', 'ING', '2021-04-23', 'Bekliyor', 'Halil Naci', '76859', 'Türk Lirası', '67959399405'),
(6, '7654323456', 'Ziraat Bankası', '2023-12-27', 'Bekliyor', 'Merve Günaydı', '76543', 'Türk Lirası', '23456776543'),
(7, '765432234567', 'TEB', '2022-03-04', 'Karşılıksız', 'Selami Necmi', '543', 'Euro', '56453233455'),
(8, '3456789', 'Halkbank', '2023-12-27', 'Başarılı', 'Hakkı Dolaylı', '87900', 'Türk Lirası', '5678987654');

-- --------------------------------------------------------

--
-- Table structure for table `masraflar`
--

CREATE TABLE `masraflar` (
  `masraf_id` int(11) NOT NULL,
  `masraf_baslik` varchar(255) NOT NULL,
  `masraf_aciklama` text NOT NULL,
  `masraf_tutar` float(20,2) NOT NULL,
  `masraf_zaman` date NOT NULL,
  `masraf_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `masraflar`
--

INSERT INTO `masraflar` (`masraf_id`, `masraf_baslik`, `masraf_aciklama`, `masraf_tutar`, `masraf_zaman`, `masraf_kategori`) VALUES
(4, 'EŞYA', 'ofise tablet alındı', 4000.00, '2021-05-30', 'test kategorisi'),
(13, 'Çay', 'lipton', 80.00, '2002-02-02', 'içecek'),
(14, 'hhhhhhhhhh', 'hhhhhhhhh', 0.00, '2023-12-27', 'hhhhhhhhh');

-- --------------------------------------------------------

--
-- Table structure for table `nakit`
--

CREATE TABLE `nakit` (
  `nakit_id` int(11) NOT NULL,
  `nakit_baslik` varchar(255) NOT NULL,
  `nakit_aciklama` varchar(255) NOT NULL,
  `nakit_gelen_tutar` float(20,2) NOT NULL,
  `nakit_cikan_tutar` float(20,2) NOT NULL,
  `nakit_zaman` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nakit`
--

INSERT INTO `nakit` (`nakit_id`, `nakit_baslik`, `nakit_aciklama`, `nakit_gelen_tutar`, `nakit_cikan_tutar`, `nakit_zaman`) VALUES
(5, 'Elden alınmıştı', 'Un parası', 0.00, 100.90, '2021-05-30'),
(14, 'asd', 'ds', 4.00, 0.00, '0000-00-00'),
(15, 'gG', 'g', 0.00, 0.00, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verified` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `verified`) VALUES
(6, 'Namık', 'namikkemal@kemal.com', '5e6de3594962b35b05479f2edb853177', 1),
(5, 'halil', 'halilcimbizbacakbacak@hotmail.com', 'f846a81cafb8343485b20baab77e39ff', 1),
(4, 'Osman1', 'osman@osman.com', '0fa568ac5056c019f0a8ae3e2ae69450', 1),
(7, 'root', 'ASD@ASD.COM', 'b2ef9c7b10eb0985365f913420ccb84a', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cekler`
--
ALTER TABLE `cekler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masraflar`
--
ALTER TABLE `masraflar`
  ADD PRIMARY KEY (`masraf_id`);

--
-- Indexes for table `nakit`
--
ALTER TABLE `nakit`
  ADD PRIMARY KEY (`nakit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cekler`
--
ALTER TABLE `cekler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `masraflar`
--
ALTER TABLE `masraflar`
  MODIFY `masraf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `nakit`
--
ALTER TABLE `nakit`
  MODIFY `nakit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
