-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 29, 2019 at 04:09 AM
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
('dr0001', 'pg0003', 'Wahid Herlambang Suroso'),
('dr0002', 'pg0004', 'Rizal Arif Nugraha'),
('dr0003', NULL, 'Sulaksono'),
('dr0004', NULL, 'Sukamto');

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
('dk0001', NULL, 'dr.Alif Gunawan', 'dokter umum', 'rabu'),
('dk0002', 'pg0005', 'dr.Rashil Alif', 'dokter gigi', 'sabtu'),
('dk0003', NULL, 'dr. Happy Asmara', 'dokter gizi', 'senin'),
('dk0004', 'pg0006', 'dr. Brigita Julia PNG', 'dokter anak', 'selasa'),
('dk0005', NULL, 'dr.Nanang Herman', 'dokter THT', 'minggu'),
('dk0006', NULL, 'dr.Subhan Mahendra', 'dokter umum', 'jumat'),
('dk0007', NULL, 'dr.Alex Nurdin', 'dokter gizi', 'kamis');

-- --------------------------------------------------------

--
-- Table structure for table `info_pemeriksaan`
--

CREATE TABLE `info_pemeriksaan` (
  `id_pemeriksaan` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_dokter` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_pasien` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_periksa` date NOT NULL,
  `hasil_periksa` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pemeriksaan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `info_pemeriksaan`
--

INSERT INTO `info_pemeriksaan` (`id_pemeriksaan`, `id_dokter`, `id_pasien`, `tgl_periksa`, `hasil_periksa`, `nama_pemeriksaan`) VALUES
('ip0001', 'dk0004', 'ps0003', '2019-07-28', 'pasien mengalami diare', 'cek kesehatan biasa'),
('ip0002', 'dk0004', 'ps0004', '2019-07-28', 'pasien mangelami flu-flu dan demam', 'cek kesehatan biasa'),
('ip0003', 'dk0002', 'ps0002', '2019-07-28', '-terdapat 3 lubang, 2 atas + 1 bawah -pasien mengalami gigi sensitif', 'cek lubang di gigi dan kesehatan mulut'),
('ip0004', 'dk0002', 'ps0004', '2019-07-28', '2 gigi telah dicopot agar tidak terhidar dari infeksi', 'ada 2 gigi yang harus dicopot'),
('ip0005', 'dk0004', 'ps0016', '2019-07-28', 'pasien mengalami kelelahan dan harus istirahat supaya kondisi tubuhnya bisa pulih kembali', 'cek kesehatan biasa'),
('ip0006', 'dk0004', 'ps0011', '2019-07-29', 'Cek kesehatan normal, namun kurang istirahat', 'cek kesehatan biasa'),
('ip0007', 'dk0004', 'ps0014', '2019-07-29', 'kesehatan mulut baik tapi terdapat 2 gigi yag harus dicabut namun pasien belum mau untuk copot giginya', 'cek lubang di gigi dan kesehatan mulut'),
('ip0008', 'dk0004', 'ps0004', '2019-07-29', 'pasien terkena penyakit flu dan diare', 'cek kesehatan biasa');

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
('ps0002', 'Siti Jenar Pengalaman', 'Semarang', '1999-09-30', 'L', 'Jl.Babakan Sari No.1 no.13', '089988877765'),
('ps0003', 'Wahyu Kolosebo', 'Yogyakarta', '1981-09-25', 'L', 'Jl.Bumi Mars No.13', '0222897867'),
('ps0004', 'Agus Kotak', 'Cilacap', '1984-02-12', 'L', 'Jl.Kebaktian No.190', '089123321123'),
('ps0005', 'Yuni', 'Bandung', '1998-09-11', 'P', 'Jl.Stasiun Selatan No.120', '0887766554433'),
('ps0006', 'Sukadana', 'Bali', '2005-01-25', 'L', 'Jl.Lamongan No.2009', '0897765655'),
('ps0007', 'Alamsyah Nur Rohman', 'Sidoarjo', '2008-09-26', 'L', 'Jl.Pegangsaan Timur No.23', '081232121'),
('ps0008', 'Inul Maryati', 'Garut', '1997-07-10', 'P', 'Jl.Serayu Utama belakang Indomaret', '08997867565'),
('ps0009', 'Hernian Dwitama', 'Sukabumi', '2006-06-18', 'P', 'Jl.Sukasari Belok Kiri No.2', '0855566676767'),
('ps0010', 'Sukantama', 'Jogyakarta', '1996-06-18', 'L', 'Jl.Gajah Mada No.23', '081234567'),
('ps0011', 'Markonah', 'Sumedang', '2002-04-23', 'P', 'Gg.Buntu Selatan No.12', '0855998878'),
('ps0012', 'Berlian Asep', 'Bandung', '1998-04-08', 'L', 'Jl.Sumangsih Tengah No.13', '089978564578'),
('ps0013', 'Setiawan Syah', 'Bandung', '1999-02-03', 'L', 'Jl.Bunga Mawar Merah No.77', '087687767677'),
('ps0014', 'Udayana', 'Indramayu', '1999-02-23', 'L', 'Jl.Sekarsari Utara', '088878788123'),
('ps0015', 'Agung Pribadi Firmawan', 'Surakarta', '1999-03-02', 'L', 'Jl.Jakarta No.123', '0877889909'),
('ps0016', 'Faisal Rahman', 'Jakarta', '2007-01-29', 'L', 'Jl.Pegangsaan Timur dekat pasar baru No.34', '08996971876'),
('ps0017', 'Sumiati Ineke', 'Merauke', '2000-10-29', 'P', 'Jl.Jayapuran Raya No.1', '08789567345'),
('ps0018', 'Kurniawan Tri Nugroho', 'Madiun', '1992-03-02', 'L', 'Komp.Permata Berlian Emas', '089999999999'),
('ps0019', 'Anugrah Istimewa', 'Palangkaraya', '1998-04-09', 'L', 'Jl.Syukur Dalam Raya No.787', '08776656765'),
('ps0020', 'Fatimah Zukkarnaen', 'Padang', '1994-04-30', 'P', 'Jl,Sesama Np1234', '0877667889'),
('ps0021', 'Suliyana Amier', 'Belitung', '1996-03-04', 'P', 'Komp.Perumahan Nusa Dua ASri No.102', '08786657789');

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

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`no_transaksi`, `id_pasien`, `id_petugas`, `tgl`, `biaya`) VALUES
('pb0001', 'ps0004', 'pa0003', '2019-07-28', 45000);

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
('pg0003', 'wahid', '63ea7bc88beb18b07b11bb65f91290a86e238f15', 'dirut', '', 'l74sq0u1bses1g7s4f5j36gh56'),
('pg0004', 'rizal', '584ffd958df0120b7b1e2a122302c8099b6bdbe8', 'dirut', '', NULL),
('pg0005', 'rashil', '67e5e3591b20d2d7195998f78c01d0895fb383ea', 'dokter', '', '7k0efnjh70l820atffv17492pg'),
('pg0006', 'brigita', '2848fc496796712ca45f74cf0aa12cd8b110ad40', 'dokter', '', 'eoqm5eeoa4op3d1o3kasail517'),
('pg0007', 'angga', '26c352d286df9c08cafd83fa2f36143412aa5e0d', 'petugas', '', 'i8un0r6ha8aj9gsoefd2sacgcu'),
('pg0008', 'teguh', 'f4fe1d827308e4e52d4d49e62f33d7d08ffb4a75', 'petugas', '', '0jc1unf6jf5g6tsqic2anmae8l');

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
('pa0001', 'pg0008', 'Teguh Siswanto', 'Jl.Sariwates Indah No.01', '08996976185'),
('pa0002', NULL, 'Akmarina', 'Jl.Sariwates Indah No.17', '089566677789'),
('pa0003', 'pg0007', 'Angga Heru', 'Jl.Layang no.1', '08111178900'),
('pa0004', NULL, 'Anwar Saputra', 'Jl.Saturnus no.13', '09989878766'),
('pa0005', NULL, 'Puspita Sari', 'Jl.Semenanjung Selatan 5', '02223344556');

-- --------------------------------------------------------

--
-- Table structure for table `resep_dokter`
--

CREATE TABLE `resep_dokter` (
  `id_resep` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_dokter` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_pasien` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_resep` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_obat` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resep_dokter`
--

INSERT INTO `resep_dokter` (`id_resep`, `id_dokter`, `id_pasien`, `nama_resep`, `jenis_obat`) VALUES
('rd0001', 'dk0004', 'ps0004', 'nama resep', 'jenis obat'),
('rd0002', 'dk0004', 'ps0014', 'penghilang rasa sakit', 'obat peredam nyeri'),
('rd0003', 'dk0004', 'ps0011', 'pemulih kondisi tubuh', 'sanmol, antibiotik');

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
  ADD PRIMARY KEY (`id_resep`),
  ADD KEY `fk_rd_dokter` (`id_dokter`),
  ADD KEY `fk_rd_pasien` (`id_pasien`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
