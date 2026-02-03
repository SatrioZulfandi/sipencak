-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2025 at 06:52 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lldikti`
--

-- --------------------------------------------------------

--
-- Table structure for table `informasis`
--

CREATE TABLE `informasis` (
  `id` int NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci NOT NULL,
  `file` text COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `informasis`
--

INSERT INTO `informasis` (`id`, `judul`, `deskripsi`, `file`, `tanggal`) VALUES
(2, 'Pengumuman', '<h1>Pengumuman</h1><p><strong style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '1749452366_8209aa9c2fcc7fdea160.pdf', '2025-06-09');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswas`
--

CREATE TABLE `mahasiswas` (
  `id` int NOT NULL,
  `id_pt` int NOT NULL,
  `id_prodi` int NOT NULL,
  `id_pencairan` int DEFAULT NULL,
  `nim` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jenjang` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `angkatan` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `pembaruan_status` enum('Tetap','Henti') COLLATE utf8mb4_general_ci NOT NULL,
  `kategori` enum('Skema Pembiayaan Penuh','Skema Biaya Pendidikan') COLLATE utf8mb4_general_ci NOT NULL,
  `status_pengajuan` enum('Belum Diajukan','Proses Pengajuan','Diajukan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswas`
--

INSERT INTO `mahasiswas` (`id`, `id_pt`, `id_prodi`, `id_pencairan`, `nim`, `nama`, `jenjang`, `angkatan`, `pembaruan_status`, `kategori`, `status_pengajuan`) VALUES
(3, 8, 4, 5, '12210399', 'ELSHA NABILA', 'S1', '2021', 'Tetap', 'Skema Biaya Pendidikan', 'Proses Pengajuan');

-- --------------------------------------------------------

--
-- Table structure for table `pencairans`
--

CREATE TABLE `pencairans` (
  `id` int NOT NULL,
  `id_pt` int NOT NULL,
  `periode` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `kategori_penerima` enum('Skema Pembiayaan Penuh','Skema Biaya Pendidikan') COLLATE utf8mb4_general_ci NOT NULL,
  `no_sk` VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `semester` enum('Ganjil','Genap') COLLATE utf8mb4_general_ci NOT NULL,
  `sptjm` text COLLATE utf8mb4_general_ci,
  `sk_penetapan` text COLLATE utf8mb4_general_ci,
  `sk_pembatalan` text COLLATE utf8mb4_general_ci,
  `berita_acara` text COLLATE utf8mb4_general_ci,
  `status` enum('Ajukan Mahasiswa', 'Finalisasi', 'Diproses', 'Selesai', 'Ditolak') COLLATE utf8mb4_general_ci NOT NULL,
  `alasan_tolak` text COLLATE utf8mb4_general_ci, -- Kolom baru
  `tanggal_entry` date DEFAULT NULL,
  `tanggal_pengajuan` date DEFAULT NULL,
  `jumlah_mahasiswa` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pencairans`
--

INSERT INTO `pencairans` (`id`, `id_pt`, `periode`, `kategori_penerima`, `no_sk`, `tanggal`, `semester`, `sptjm`, `sk_penetapan`, `sk_pembatalan`, `berita_acara`, `status`, `tanggal_entry`, `tanggal_pengajuan`, `jumlah_mahasiswa`) VALUES
(5, 8, 'Ganjil / 2025', 'Skema Biaya Pendidikan', 'abcd','2025-06-10', 'Ganjil', '1749522154_eb47aefbc3b248d72f0d.pdf', '1749522154_3caaa426591136068d99.pdf', '1749522154_53c8829f136ca829ba07.pdf', '1749522154_117e0548b20453e27194.pdf', 'Diproses', '2025-06-10', NULL, 2),
(6, 8, 'Ganjil / 2025', 'Skema Biaya Pendidikan', 'abcd','2025-06-10', 'Genap','1749524543_a56eaef6111950d07e4d.pdf', '1749524543_ffcbb4855bf300c2ea33.pdf', '1749524543_549e15c492b4855023aa.pdf', '1749524543_c705e90a2ac66a31da90.pdf', 'Ajukan Mahasiswa', '2025-06-10', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `periodes`
--

CREATE TABLE `periodes` (
  `id` int NOT NULL,
  `periode` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periodes`
--

INSERT INTO `periodes` (`id`, `periode`) VALUES
(1, 'Semester Ganjil'),
(2, 'Semester Genap');

-- --------------------------------------------------------

--
-- Table structure for table `prodis`
--

CREATE TABLE `prodis` (
  `id` int NOT NULL,
  `id_pt` int NOT NULL,
  `kode_prodi` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_prodi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodis`
--

INSERT INTO `prodis` (`id`, `id_pt`, `kode_prodi`, `nama_prodi`) VALUES
(3, 8, '57201', 'S1 Sistem Informasi'),
(4, 8, '55201', 'S1 Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `pts`
--

CREATE TABLE `pts` (
  `id` int NOT NULL,
  `kode_pt` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `perguruan_tinggi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `aipt` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pts`
--

INSERT INTO `pts` (`id`, `kode_pt`, `perguruan_tinggi`, `aipt`) VALUES
(8, '031003', 'Universitas Islam Jakarta', 'B (Baik Sekali)');

-- --------------------------------------------------------

--
-- Table structure for table `userpts`
--

CREATE TABLE `userpts` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `id_pt` int NOT NULL,
  `penanggung_jawab` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nip` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `kontak` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('nonaktif','aktif') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userpts`
--

INSERT INTO `userpts` (`id`, `username`, `password`, `id_pt`, `penanggung_jawab`, `nip`, `kontak`, `email`, `status`) VALUES
(1, 'user', '$2y$10$aMN4FzLgQWkv3S7TnqJ.5u7URcDc4RO4Yun/cx3iHUQ3u7nMV9cAS', 8, 'Admin UIJ', '', '', 'uij@edu.ac.id', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin LLDIKTI', 'admin', '$2y$10$QrTRStr1q8Csz88eZCzgdOyv1hmPkS/UJBnITEx3bcyO1qFoX0g5K', '2025-06-03 03:27:24', '2025-06-03 03:27:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `informasis`
--
ALTER TABLE `informasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pencairans`
--
ALTER TABLE `pencairans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `periodes`
--
ALTER TABLE `periodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prodis`
--
ALTER TABLE `prodis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pts`
--
ALTER TABLE `pts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userpts`
--
ALTER TABLE `userpts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `informasis`
--
ALTER TABLE `informasis`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pencairans`
--
ALTER TABLE `pencairans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `periodes`
--
ALTER TABLE `periodes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prodis`
--
ALTER TABLE `prodis`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pts`
--
ALTER TABLE `pts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `userpts`
--
ALTER TABLE `userpts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
