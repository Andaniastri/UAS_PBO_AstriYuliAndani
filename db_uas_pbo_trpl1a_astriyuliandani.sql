-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2026 at 02:17 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_trpl1a_astriyuliandani`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_mahasiswa`
--

CREATE TABLE `table_mahasiswa` (
  `id_mahasiswa` int NOT NULL,
  `nim` varchar(15) NOT NULL,
  `tarif_ukt_nominal` int NOT NULL,
  `jenis_pembayaran` enum('mandiri','bidikmisi','prestasi') NOT NULL,
  `golongan_ukt` varchar(10) DEFAULT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `nomor_kip_kuliah` varchar(30) DEFAULT NULL,
  `dana_saku_subsidi` int DEFAULT NULL,
  `nama_instansi_beasiswa` varchar(100) DEFAULT NULL,
  `minimal_ipk_syarat` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `table_mahasiswa`
--

INSERT INTO `table_mahasiswa` (`id_mahasiswa`, `nim`, `tarif_ukt_nominal`, `jenis_pembayaran`, `golongan_ukt`, `nama_wali`, `nomor_kip_kuliah`, `dana_saku_subsidi`, `nama_instansi_beasiswa`, `minimal_ipk_syarat`) VALUES
(1, '230101001', 5000000, 'mandiri', 'Golongan 3', 'Budi Santoso', NULL, NULL, NULL, NULL),
(2, '230101002', 7500000, 'mandiri', 'Golongan 5', 'Ahmad Subarjo', NULL, NULL, NULL, NULL),
(3, '230101003', 5000000, 'mandiri', 'Golongan 3', 'Siti Aminah', NULL, NULL, NULL, NULL),
(4, '230101004', 10000000, 'mandiri', 'Golongan 7', 'Hendra Wijaya', NULL, NULL, NULL, NULL),
(5, '230101005', 6000000, 'mandiri', 'Golongan 4', 'Dewi Lestari', NULL, NULL, NULL, NULL),
(6, '230101006', 7500000, 'mandiri', 'Golongan 5', 'Rudi Hermawan', NULL, NULL, NULL, NULL),
(7, '230101007', 5000000, 'mandiri', 'Golongan 3', 'Iwan Setiawan', NULL, NULL, NULL, NULL),
(8, '230101008', 0, 'bidikmisi', NULL, NULL, 'KIP-2026-0001', 700000, NULL, NULL),
(9, '230101009', 0, 'bidikmisi', NULL, NULL, 'KIP-2026-0002', 700000, NULL, NULL),
(10, '230101010', 0, 'bidikmisi', NULL, NULL, 'KIP-2026-0003', 750000, NULL, NULL),
(11, '230101011', 0, 'bidikmisi', NULL, NULL, 'KIP-2026-0004', 700000, NULL, NULL),
(12, '230101012', 0, 'bidikmisi', NULL, NULL, 'KIP-2026-0005', 700000, NULL, NULL),
(13, '230101013', 0, 'bidikmisi', NULL, NULL, 'KIP-2026-0006', 800000, NULL, NULL),
(14, '230101014', 0, 'bidikmisi', NULL, NULL, 'KIP-2026-0007', 700000, NULL, NULL),
(15, '230101015', 2000000, 'prestasi', NULL, NULL, NULL, NULL, 'Djarum Foundation', 3.50),
(16, '230101016', 1500000, 'prestasi', NULL, NULL, NULL, NULL, 'Yayasan Toyota', 3.30),
(17, '230101017', 0, 'prestasi', NULL, NULL, NULL, NULL, 'Kemenpora', 3.75),
(18, '230101018', 2500000, 'prestasi', NULL, NULL, NULL, NULL, 'Bank Mandiri', 3.40),
(19, '230101019', 2000000, 'prestasi', NULL, NULL, NULL, NULL, 'Djarum Foundation', 3.50),
(20, '230101020', 0, 'prestasi', NULL, NULL, NULL, NULL, 'Pemprov Jateng', 3.60),
(21, '230101021', 1500000, 'prestasi', NULL, NULL, NULL, NULL, 'Yayasan Astra', 3.25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_mahasiswa`
--
ALTER TABLE `table_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_mahasiswa`
--
ALTER TABLE `table_mahasiswa`
  MODIFY `id_mahasiswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
