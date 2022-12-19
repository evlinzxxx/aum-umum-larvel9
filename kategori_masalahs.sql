-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2022 at 01:54 PM
-- Server version: 5.7.33
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aum-u`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori_masalahs`
--

CREATE TABLE `kategori_masalahs` (
  `kode_kategori` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_masalahs`
--

INSERT INTO `kategori_masalahs` (`kode_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
('ANM', 'Agama , Nilai, dan Moral', '2022-12-10 05:46:56', '2022-12-10 05:46:56'),
('DPI', 'Diri Pribadi', '2022-12-10 05:36:57', '2022-12-10 05:36:57'),
('EDK', 'Ekonomi dan keuangan', '2022-12-10 05:46:16', '2022-12-10 05:46:16'),
('HMP', 'Hubungan Muda Mudi dan Perkawinan', '2022-12-10 05:47:08', '2022-12-10 05:47:08'),
('HSO', 'Hubungan Sosial', '2022-12-10 05:46:05', '2022-12-10 05:46:05'),
('JDK', 'Jasmani dan Kesehatan', '2022-12-10 05:33:44', '2022-12-10 05:33:44'),
('KDP', 'Karir dan Pekerjaan', '2022-12-10 05:46:31', '2022-12-10 05:46:31'),
('KHK', 'Keadaan dan Hubungan dalam Keluarga', '2022-12-10 05:47:22', '2022-12-10 05:47:22'),
('PDP', 'Pendidikan dan Pembelajaran', '2022-12-10 05:46:42', '2022-12-10 05:46:47'),
('WSG', 'Waktu Senggang', '2022-12-10 05:47:29', '2022-12-10 05:47:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori_masalahs`
--
ALTER TABLE `kategori_masalahs`
  ADD PRIMARY KEY (`kode_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
