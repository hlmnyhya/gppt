-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2023 at 11:06 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gppt`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `id_antrian` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_instansi` int NOT NULL,
  `id_layanan` int DEFAULT NULL,
  `nomor_antrian` int DEFAULT NULL,
  `status_antrian` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id_antrian`, `id_user`, `id_instansi`, `id_layanan`, `nomor_antrian`, `status_antrian`) VALUES
(1, 6, 1, 1, 1, 'Menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` int NOT NULL,
  `judul_berita` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isi_berita` text COLLATE utf8mb4_unicode_ci,
  `waktu_publikasi` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_berita` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `judul_berita`, `isi_berita`, `waktu_publikasi`, `penulis`, `gambar_berita`) VALUES
(1, 'Sosialisasi Pengawasan Perizinan Berusaha Berbasis Risiko', 'Sosialisasi Pengawasan Perizinan Berusaha Berbasis Risiko hari ke-2, kamis (10/8) di Grandia Meeting Room Hotel Roditha Banjarbaru yang dilaksanakan oleh DPM&amp;PTSP melalui Bidang Pengendalian Pelaksanaan Penanaman Modal dibuka langsung oleh Plt. Kepala Dinas; Sartiyuni, S.Sos yang dilanjutkan dengan Pemaparan oleh Narasumber tentang Pengawasan Perizinan Berusaha berbasis risiko, gambaran umum tentang LKPM serta tata cara pelaporan kegiatan berusaha melalui LKPM.\r\n\r\nKegiatan dihadiri oleh 50 peserta yang terdiri dari Pelaku Usaha Skala Menengah dan Besar di Kota Banjarbaru ini bertujuan untuk memberikan informasi dan pemahaman kepada pelaku usaha tentang pengawasan perizinan dan kewajiban pelaku usaha dalam melaporkan nilai realisasi investasinya dab mendapatkan saran/masukan tentang masalah/kendala yang dihadapi terkait pelaporan LKPM.\r\n\r\nKepada Semua pelaku usaha di Kota Banjarbaru yang masih memiliki kendala/permasalahan bisa menghubugi Call Center OSS atau Langsung mengunjungi Mal Pelayanan Publik Kota Banjarbaru.\r\n\r\n(d.a)', '2023-11-22 16:00:00', 'Admin', 0x426572697461312e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `berkas`
--

CREATE TABLE `berkas` (
  `id_berkas` int NOT NULL,
  `id_permohonan` int DEFAULT NULL,
  `token` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berkas`
--

INSERT INTO `berkas` (`id_berkas`, `id_permohonan`, `token`, `file`) VALUES
(1, 1, '0.441201537060939', 'Hilmanadi_Yahya_CV1.pdf'),
(2, 1, '0.9792992391467283', 'Hilmanadi_Yahya_Sertifikat_Kompetensi1.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id_gallery` int NOT NULL,
  `judul_gallery` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi_gallery` text COLLATE utf8mb4_unicode_ci,
  `waktu_upload` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `gambar_gallery` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id_gallery`, `judul_gallery`, `deskripsi_gallery`, `waktu_upload`, `gambar_gallery`) VALUES
(1, 'MPP KETIGA DI PULAU BORNEO SIAP DIRESMIKAN', 'MPP KETIGA DI PULAU BORNEO SIAP DIRESMIKAN', '2023-11-22 16:00:00', 0x6c61756e6368696e672e6a706567);

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE `instansi` (
  `id_instansi` int NOT NULL,
  `nama_instansi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar_instansi` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`id_instansi`, `nama_instansi`, `gambar_instansi`) VALUES
(1, 'DPMPTSP', 0x6d70705f69636f6e332e706e67),
(2, 'BPJS KESEHATAN', 0x62706a73342e6a7067),
(3, 'POLRES BANJARBARU', 0x706f6c726573312e706e67),
(4, 'BANK KALSEL', 0x62616e6b6b616c73656c312e706e67),
(5, 'SAMSAT BANJARBARU', 0x73616d736174312e706e67),
(6, 'BPJS KESEHATAN', 0x475050542e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_layanan` int DEFAULT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci,
  `rating` int DEFAULT NULL,
  `waktu_komentar` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int NOT NULL,
  `id_instansi` int DEFAULT NULL,
  `nama_layanan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi_layanan` text COLLATE utf8mb4_unicode_ci,
  `gambar_layanan` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `id_instansi`, `nama_layanan`, `deskripsi_layanan`, `gambar_layanan`) VALUES
(1, 1, 'IZIN USAHA PUSAT PERBELANJAAN (IUPP)', 'Izin Usaha Pusat Perbelanjaan', 0x756d6b6d626172752e706e67),
(3, 1, 'IZIN USAHA PUSAT PERBELANJAAN (IUPP)', 'Izin Usaha Pusat Perbelanjaan', 0x554d4b4d322e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `layanan_detail`
--

CREATE TABLE `layanan_detail` (
  `id_layanan_detail` int NOT NULL,
  `id_layanan` int DEFAULT NULL,
  `nama_layanan_detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi_layanan_detail` text COLLATE utf8mb4_unicode_ci,
  `gambar_layanan_detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layanan_detail`
--

INSERT INTO `layanan_detail` (`id_layanan_detail`, `id_layanan`, `nama_layanan_detail`, `deskripsi_layanan_detail`, `gambar_layanan_detail`) VALUES
(4, 1, 'IUPP PERPANJANG', 'Izin Perpanjang', 'icon5.png'),
(5, 1, 'IUPP BARU', 'Izin Baru', 'icon5.png');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `level`) VALUES
(1, 'SuperAdmin'),
(2, 'Petugas'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `permohonan`
--

CREATE TABLE `permohonan` (
  `id_permohonan` int NOT NULL,
  `id_user` int NOT NULL,
  `nama` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_instansi` int NOT NULL,
  `id_layanan` int DEFAULT NULL,
  `id_layanan_detail` int NOT NULL,
  `status_permohonan` enum('Diverifikasi','Diproses','Ditolak','Selesai','Diajukan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alasan` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permohonan`
--

INSERT INTO `permohonan` (`id_permohonan`, `id_user`, `nama`, `id_instansi`, `id_layanan`, `id_layanan_detail`, `status_permohonan`, `alasan`) VALUES
(1, 6, 'Dilla', 1, 1, 4, 'Selesai', 'Berkas Lengkap, Permohonan Segera Diproses');

-- --------------------------------------------------------

--
-- Table structure for table `syarat`
--

CREATE TABLE `syarat` (
  `id_syarat` int NOT NULL,
  `id_layanan_detail` int NOT NULL,
  `syarat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `penjelasan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `dasar_hukum` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `prosedur` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `jangka_waktu` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `biaya` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `syarat`
--

INSERT INTO `syarat` (`id_syarat`, `id_layanan_detail`, `syarat`, `penjelasan`, `dasar_hukum`, `prosedur`, `jangka_waktu`, `biaya`) VALUES
(2, 4, 'Fotocopy KTP Pemohon <br>\r\nNPWP Pemohon <br>\r\nAkte Pendirian Perusahaan <br>\r\nFC NIB (Nomor Induk Berusaha) <br>\r\nNomor Induk Berusaha (NIB)', 'Penjelasan', 'Dasar Hukum', 'Prosedur', 'Jangka Waktu', 'Rp. 0,-');

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `id` int NOT NULL,
  `file` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `nik` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_telepon` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_level` int DEFAULT NULL,
  `id_instansi` int DEFAULT NULL,
  `gambar_user` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nik`, `nama`, `username`, `password`, `email`, `nomor_telepon`, `id_level`, `id_instansi`, `gambar_user`) VALUES
(5, '', 'SuperAdmin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', '082154231513', 1, 6, 0x7573657273362e706e67),
(6, '6301030709020001', 'Dilla', 'dilla', '506c2c97f626ffb3306dacb174030d10', 'dilla@gmail.com', '082154231513', 3, NULL, 0x7573657273382e706e67),
(8, '', 'Menik', 'menik', '3b3e2ade66021ab7c97c6c9295d6d4c0', 'menik@gmail.com', '082154231513', 2, 1, 0x7573657273392e706e67);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id_antrian`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_layanan` (`id_layanan`),
  ADD KEY `id_instansi` (`id_instansi`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`id_berkas`),
  ADD KEY `id_permohonan` (`id_permohonan`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id_gallery`);

--
-- Indexes for table `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`id_instansi`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_layanan` (`id_layanan`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`),
  ADD KEY `id_instansi` (`id_instansi`);

--
-- Indexes for table `layanan_detail`
--
ALTER TABLE `layanan_detail`
  ADD PRIMARY KEY (`id_layanan_detail`),
  ADD KEY `id_layanan` (`id_layanan`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `permohonan`
--
ALTER TABLE `permohonan`
  ADD PRIMARY KEY (`id_permohonan`),
  ADD KEY `id_layanan` (`id_layanan`),
  ADD KEY `id_layanan_detail` (`id_layanan_detail`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_instansi` (`id_instansi`);

--
-- Indexes for table `syarat`
--
ALTER TABLE `syarat`
  ADD PRIMARY KEY (`id_syarat`),
  ADD KEY `id_layanan_detail` (`id_layanan_detail`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_level` (`id_level`),
  ADD KEY `id_instansi` (`id_instansi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id_antrian` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `berkas`
--
ALTER TABLE `berkas`
  MODIFY `id_berkas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id_gallery` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `instansi`
--
ALTER TABLE `instansi`
  MODIFY `id_instansi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `layanan_detail`
--
ALTER TABLE `layanan_detail`
  MODIFY `id_layanan_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permohonan`
--
ALTER TABLE `permohonan`
  MODIFY `id_permohonan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `syarat`
--
ALTER TABLE `syarat`
  MODIFY `id_syarat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `antrian`
--
ALTER TABLE `antrian`
  ADD CONSTRAINT `antrian_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `antrian_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`);

--
-- Constraints for table `berkas`
--
ALTER TABLE `berkas`
  ADD CONSTRAINT `berkas_ibfk_1` FOREIGN KEY (`id_permohonan`) REFERENCES `permohonan` (`id_permohonan`);

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`);

--
-- Constraints for table `layanan`
--
ALTER TABLE `layanan`
  ADD CONSTRAINT `layanan_ibfk_1` FOREIGN KEY (`id_instansi`) REFERENCES `instansi` (`id_instansi`);

--
-- Constraints for table `layanan_detail`
--
ALTER TABLE `layanan_detail`
  ADD CONSTRAINT `layanan_detail_ibfk_1` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`);

--
-- Constraints for table `permohonan`
--
ALTER TABLE `permohonan`
  ADD CONSTRAINT `permohonan_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`),
  ADD CONSTRAINT `permohonan_ibfk_3` FOREIGN KEY (`id_layanan_detail`) REFERENCES `layanan_detail` (`id_layanan_detail`),
  ADD CONSTRAINT `permohonan_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `syarat`
--
ALTER TABLE `syarat`
  ADD CONSTRAINT `syarat_ibfk_2` FOREIGN KEY (`id_layanan_detail`) REFERENCES `layanan_detail` (`id_layanan_detail`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_instansi`) REFERENCES `instansi` (`id_instansi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
