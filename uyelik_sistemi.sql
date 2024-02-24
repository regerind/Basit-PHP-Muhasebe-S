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
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cek_numarasi` VARCHAR(128) NOT NULL,
  `banka_bilgisi` VARCHAR(128) NOT NULL,
  `cek_tarihi` DATE NOT NULL,
  `cek_durumu` VARCHAR(128) NOT NULL,
  `alici_bilgisi` VARCHAR(128) NOT NULL,
  `odeme_miktari` DECIMAL(20,2) NOT NULL,
  `para_birimi` VARCHAR(128) NOT NULL,
  `referans_numarasi` VARCHAR(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cekler`
--

INSERT INTO `cekler` (`id`, `cek_numarasi`, `banka_bilgisi`, `cek_tarihi`, `cek_durumu`, `alici_bilgisi`, `odeme_miktari`, `para_birimi`, `referans_numarasi`) VALUES
(1, '7364892775', 'Vakifbank', '3454-02-21', 'Basarili', 'Huseyin Salim', 555.00, 'Dolar', '5665430039'),
(2, '5868399592', 'Garanti AS', '4533-03-21', 'Karsiliksiz', 'Melisa Erkus', 3540.00, 'Euro', '56259305883'),
(3, '456456456', 'Akbank', '2023-12-27', 'Bekliyor', 'Ayse Fatma', 12345.00, 'Turk Lirasi', '8765435678'),
(4, '45346346346', 'ING', '2021-04-23', 'Bekliyor', 'Halil Naci', 76859.00, 'Turk Lirasi', '67959399405'),
(5, '123456789', 'Denizbank', '2023-12-27', 'Karsiliksiz', 'Cemal', 98765.00, 'Dolar', '1230987654'),
(6, '7654323456', 'Ziraat Bankasi', '2023-12-27', 'Bekliyor', 'Merve Gunaydi', 76543.00, 'Turk Lirasi', '23456776543'),
(7, '765432234567', 'TEB', '2022-03-04', 'Karsiliksiz', 'Selami Necmi', 543.00, 'Euro', '56453233455'),
(8, '3456789', 'Halkbank', '2023-12-27', 'Basarili', 'Hakki Dolayli', 87900.00, 'Turk Lirasi', '5678987654'),
(9, '0987654321', 'Yapi Kredi', '2021-08-15', 'Basarili', 'Esra Kaya', 65432.00, 'Dolar', '2345678901');

-- --------------------------------------------------------

--
-- Table structure for table `masraflar`
--

CREATE TABLE `masraflar` (
  `masraf_id` INT(11) NOT NULL AUTO_INCREMENT,
  `masraf_baslik` VARCHAR(255) NOT NULL,
  `masraf_aciklama` TEXT NOT NULL,
  `masraf_tutar` DECIMAL(20,2) NOT NULL,
  `masraf_zaman` DATE NOT NULL,
  `masraf_kategori` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`masraf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `masraflar`
--

INSERT INTO `masraflar` (`masraf_id`, `masraf_baslik`, `masraf_aciklama`, `masraf_tutar`, `masraf_zaman`, `masraf_kategori`) VALUES
(1, 'ESYA', 'ofise tablet alindi', 4000.00, '2021-05-30', 'test kategorisi'),
(2, 'Cay', 'lipton', 80.00, '2002-02-02', 'icecek'),
(3, 'hhhhhhhhhh', 'hhhhhhhhh', 0.00, '2023-12-27', 'hhhhhhhhh'),
(4, 'Mobilya', 'yeni sandalye alindi', 2000.00, '2023-12-27', 'ofis malzemeleri'),
(5, 'Elektronik', 'bilgisayar tamiri', 300.00, '2023-12-27', 'teknoloji giderleri'),
(6, 'Yemek', 'lokanta', 150.00, '2023-12-27', 'gida'),
(7, 'Ulasim', 'taksi', 50.00, '2023-12-27', 'ulasim'),
(8, 'Egitim', 'online kurs', 120.00, '2023-12-27', 'egitim');

-- --------------------------------------------------------

--
-- Table structure for table `nakit`
--

CREATE TABLE `nakit` (
  `nakit_id` INT(11) NOT NULL AUTO_INCREMENT,
  `nakit_baslik` VARCHAR(255) NOT NULL,
  `nakit_aciklama` VARCHAR(255) NOT NULL,
  `nakit_gelen_tutar` DECIMAL(20,2) NOT NULL,
  `nakit_cikan_tutar` DECIMAL(20,2) NOT NULL,
  `nakit_zaman` DATE NOT NULL,
  PRIMARY KEY (`nakit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nakit`
--

INSERT INTO `nakit` (`nakit_id`, `nakit_baslik`, `nakit_aciklama`, `nakit_gelen_tutar`, `nakit_cikan_tutar`, `nakit_zaman`) VALUES
(1, 'Elden alinmisti', 'Un parasi', 0.00, 100.90, '2021-05-30'),
(2, 'asd', 'ds', 4.00, 0.00, '0000-00-00'),
(3, 'gG', 'g', 0.00, 0.00, '0000-00-00'),
(4, 'Market alisverisi', 'gida', 200.00, 0.00, '2023-12-27'),
(5, 'Sponsorluk', 'etkinlik sponsorlugu', 1000.00, 0.00, '2023-12-27'),
(6, 'Elektrik faturasi', 'ofis elektrigi', 150.00, 0.00, '2023-12-27'),
(7, 'Gelir', 'satis geliri', 5000.00, 0.00, '2023-12-27'),
(8, 'Kira', 'ofis kira odemesi', 1200.00, 0.00, '2023-12-27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `verified` INT(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `verified`) VALUES
(1, 'JohnDoe', 'johndoe@example.com', '5e6de3594962b35b05479f2edb853177', 1),
(2, 'JaneDoe', 'janedoe@example.com', 'f846a81cafb8343485b20baab77e39ff', 1),
(3, 'Alice', 'alice@example.com', '0fa568ac5056c019f0a8ae3e2ae69450', 1),
(4, 'Bob', 'bob@example.com', 'b2ef9c7b10eb0985365f913420ccb84a', 1),
(5, 'Charlie', 'charlie@example.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(6, 'David', 'david@example.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(7, 'Eva', 'eva@example.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(8, 'Frank', 'frank@example.com', 'd41d8cd98f00b204e9800998ecf8427e', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cekler`
--
ALTER TABLE `cekler`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Indexes for table `masraflar`
--
ALTER TABLE `masraflar`
  MODIFY `masraf_id` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Indexes for table `nakit`
--
ALTER TABLE `nakit`
  MODIFY `nakit_id` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
