-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 28, 2019 at 06:40 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `direktur_utama`
--

CREATE TABLE `direktur_utama` (
  `id_direktur` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pengguna` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_direktur` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `direktur_utama`
--

INSERT INTO `direktur_utama` (`id_direktur`, `id_pengguna`, `nama_direktur`) VALUES
('dr0001', 'pg0003', 'wahid herlambang suroso'),
('dr0002', 'pg0004', 'rizal arif nugraha'),
('dr0003', NULL, 'brigita julia png');

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pengguna` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_dokter` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spesialisasi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jadwal` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `id_pengguna`, `nama_dokter`, `spesialisasi`, `jadwal`) VALUES
('dk0001', 'pg0005', 'dr. alif hermawan', 'dokter gigi', 'rabu'),
('dk0002', NULL, 'dr. mahmudin anwar', 'dokter anak', 'sabtu'),
('dk0003', NULL, 'dr.anwar sapu sapu', 'dokter anak', 'kagaklibur');

-- --------------------------------------------------------

--
-- Table structure for table `info_pemeriksaan`
--

CREATE TABLE `info_pemeriksaan` (
  `id_pemeriksaan` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_dokter` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_pasien` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_periksa` date NOT NULL,
  `hasil_periksa` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `access_director` enum('Y','N') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_admin` enum('Y','N') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_doctor` enum('Y','N') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`module_id`, `module_name`, `link`, `icon`, `active`, `access_director`, `access_admin`, `access_doctor`) VALUES
(1, 'beranda', '?m=beranda', 'home', 'Y', 'Y', 'Y', 'Y'),
(2, 'module', '?m=module', 'clone', 'Y', 'Y', 'N', 'N'),
(3, 'pasien', '?m=pasien', 'users', 'Y', 'N', 'Y', 'N'),
(4, 'pengguna', '?m=pengguna', 'user circle outline', 'Y', 'Y', 'N', 'N'),
(5, 'direktur', '?m=direktur', 'user circle', 'Y', 'Y', 'N', 'N'),
(6, 'petugas', '?m=petugas', 'user outline', 'Y', 'Y', 'N', 'N'),
(7, 'dokter', '?m=dokter', 'heartbeat', 'Y', 'Y', 'N', 'N'),
(8, 'resep', '?m=resep', 'first aid', 'Y', 'N', 'N', 'Y'),
(9, 'pemeriksaan', '?m=pemeriksaan', 'check square outline', 'Y', 'N', 'N', 'Y'),
(10, 'pembayaran', '?m=pembayaran', 'dollar sign', 'Y', 'N', 'Y', 'N'),
(11, 'laporan', '?m=laporan', 'book', 'Y', 'Y', 'N', 'N'),
(12, 'pertanyaan', '?m=pertanyaan', 'question circle orange', 'N', 'Y', 'N', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pasien` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontak` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `alamat`, `kontak`) VALUES
('ps0002', 'siti jenar pengalaman', 'semarang', '1999-09-30', 'L', 'jl.rumongso ingsun waye wayae adus no.13', '089988877765');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `no_transaksi` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pasien` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_petugas` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl` date NOT NULL,
  `biaya` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_photo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_session` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `password`, `status`, `url_photo`, `id_session`) VALUES
('pg0003', 'wahid', '63ea7bc88beb18b07b11bb65f91290a86e238f15', 'dirut', '', 'i9s2vkpunq414b9e9d2nle24vg'),
('pg0004', 'rizal', '584ffd958df0120b7b1e2a122302c8099b6bdbe8', 'dirut', '', 'hdm57oi81oq706vbiruvfighnf'),
('pg0005', 'alif', '707fb7d2aac6a040c4e13ca3caff4a2ba9c0308d', 'dokter', '', 'ljo8d44mooi8eauk9if48964c4'),
('pg0006', 'jajang', '366f12d3111672faf9cdf7f8c09c7a3c8e252dde', 'petugas', '', 'rs3b26a1k5ta269qoc0p2vbi81');

-- --------------------------------------------------------

--
-- Table structure for table `petugas_administrasi`
--

CREATE TABLE `petugas_administrasi` (
  `id_petugas` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pengguna` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pegawai` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontak` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas_administrasi`
--

INSERT INTO `petugas_administrasi` (`id_petugas`, `id_pengguna`, `nama_pegawai`, `alamat`, `kontak`) VALUES
('pa0001', NULL, 'nuri gendise', 'jl.kebangsaan timur tengah no.13', '089978675645'),
('pa0002', NULL, 'akmarina', 'jl.sariwates indah no.17', '089566677789'),
('pa0003', 'pg0006', 'sukmara jajang', 'jl.layang no.1', '08111178900');

-- --------------------------------------------------------

--
-- Table structure for table `resep_dokter`
--

CREATE TABLE `resep_dokter` (
  `id_obat` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_dokter` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_pasien` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_obat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `direktur_utama`
--
ALTER TABLE `direktur_utama`
  ADD PRIMARY KEY (`id_direktur`),
  ADD KEY `fk_dirut_pengguna` (`id_pengguna`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`),
  ADD KEY `fk_dok_pengguna` (`id_pengguna`);

--
-- Indexes for table `info_pemeriksaan`
--
ALTER TABLE `info_pemeriksaan`
  ADD PRIMARY KEY (`id_pemeriksaan`),
  ADD KEY `fk_ip_pasien` (`id_pasien`),
  ADD KEY `fk_ip_dokter` (`id_dokter`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `fk_pbayar_petugas` (`id_petugas`),
  ADD KEY `fk_pbayar_pasien` (`id_pasien`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `petugas_administrasi`
--
ALTER TABLE `petugas_administrasi`
  ADD PRIMARY KEY (`id_petugas`),
  ADD KEY `fk_pa_pengguna` (`id_pengguna`);

--
-- Indexes for table `resep_dokter`
--
ALTER TABLE `resep_dokter`
  ADD PRIMARY KEY (`id_obat`),
  ADD KEY `fk_rd_dokter` (`id_dokter`),
  ADD KEY `fk_rd_pasien` (`id_pasien`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `direktur_utama`
--
ALTER TABLE `direktur_utama`
  ADD CONSTRAINT `fk_dirut_pengguna` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);

--
-- Constraints for table `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `fk_dok_pengguna` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);

--
-- Constraints for table `info_pemeriksaan`
--
ALTER TABLE `info_pemeriksaan`
  ADD CONSTRAINT `fk_ip_dokter` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`),
  ADD CONSTRAINT `fk_ip_pasien` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pbayar_pasien` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`),
  ADD CONSTRAINT `fk_pbayar_petugas` FOREIGN KEY (`id_petugas`) REFERENCES `petugas_administrasi` (`id_petugas`);

--
-- Constraints for table `petugas_administrasi`
--
ALTER TABLE `petugas_administrasi`
  ADD CONSTRAINT `fk_pa_pengguna` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);

--
-- Constraints for table `resep_dokter`
--
ALTER TABLE `resep_dokter`
  ADD CONSTRAINT `fk_rd_dokter` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`),
  ADD CONSTRAINT `fk_rd_pasien` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
