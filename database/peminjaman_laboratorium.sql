-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 18, 2026 at 04:00 PM
-- Server version: 11.8.3-MariaDB-log
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjaman_laboratorium`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokumen`
--

CREATE TABLE `dokumen` (
  `id_dokumen` int(11) NOT NULL,
  `id_pinjam` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laboratorium`
--

CREATE TABLE `laboratorium` (
  `id_lab` int(11) NOT NULL,
  `nama_lab` varchar(100) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `laboratorium`
--

INSERT INTO `laboratorium` (`id_lab`, `nama_lab`, `kapasitas`, `lokasi`, `keterangan`, `created_at`, `foto`) VALUES
(1, 'Lab Hardware', 30, 'Gedung D', 'Praktikum Pemrograman', '2026-06-12 16:06:06', NULL),
(2, 'Lab Dasar', 30, 'Gedung D', 'Praktikum Jaringan', '2026-06-12 16:06:06', NULL),
(3, 'Lab Perangkat Lunak', 25, 'Gedung D', 'Desain dan Perangkat Lunak', '2026-06-12 16:06:06', NULL),
(6, 'Lab Hebat', 55, 'Gedung Z', NULL, '2026-06-13 18:23:22', '1781375002_gojo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_lab` int(11) NOT NULL,
  `nama_kegiatan` varchar(150) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `file_upload` text DEFAULT NULL,
  `ttd` longtext DEFAULT NULL,
  `status` enum('Menunggu','Disetujui','Ditolak') DEFAULT 'Menunggu',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `file_ttd` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `id_user`, `id_lab`, `nama_kegiatan`, `keterangan`, `tanggal`, `jam_mulai`, `jam_selesai`, `file_upload`, `ttd`, `status`, `created_at`, `file_ttd`) VALUES
(1, 1, 6, 'Hartik 2026', 'IZIN PINJAM LAB BOSKU', '2026-12-05', '08:00:00', '15:00:00', '1781377210_Laporan Progress - website peminjaman laboratorium - Afdhal Tsany Nurrizki - 2430511078.pdf', NULL, 'Ditolak', '2026-06-13 19:00:10', NULL),
(2, 1, 1, 'sainfest', 'ssss', '2026-06-17', '07:00:00', '17:00:00', '1781378893_Laporan UTS - Jaringan Komputer - Afdhal Tsany Nurrizki - 2430511078.pdf', NULL, 'Ditolak', '2026-06-13 19:28:13', NULL),
(3, 1, 6, 'dfafa', 'asdasfadegf', '2026-07-14', '06:00:00', '19:00:00', '1781379601_pertemuan-5pdf-1776813097.pdf', '1781379601_ttd.png', 'Disetujui', '2026-06-13 19:40:01', NULL),
(4, 1, 1, 'Mantap', 'aaaaaaaaaa', '2026-11-11', '07:00:00', '19:00:00', '1781623157_soal_uts_mp2526_genappdf-1777859760.pdf', '1781623157_ttd.png', 'Menunggu', '2026-06-16 15:19:17', NULL),
(5, 1, 1, 'Konser', 'Konser hebat Kairi Rayosdesol', '2026-06-30', '07:00:00', '16:15:00', '1781795379_Laporan Hasil Praktikum - Intent dan Dialog - Afdhal Tsany Nurrizki - 2430511078.pdf,1781795379_Laporan Praktikum - Styling UI Android dengan Kotlin - Afdhal Tsany Nurrizki - 2430511078.pdf', '1781795379_ttd.png', 'Disetujui', '2026-06-18 15:09:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Administrator', 'admin', 'admin123', 'admin', '2026-06-12 16:03:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id_dokumen`),
  ADD KEY `id_pinjam` (`id_pinjam`);

--
-- Indexes for table `laboratorium`
--
ALTER TABLE `laboratorium`
  ADD PRIMARY KEY (`id_lab`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_lab` (`id_lab`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id_dokumen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laboratorium`
--
ALTER TABLE `laboratorium`
  MODIFY `id_lab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `dokumen_ibfk_1` FOREIGN KEY (`id_pinjam`) REFERENCES `peminjaman` (`id_pinjam`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_lab`) REFERENCES `laboratorium` (`id_lab`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
