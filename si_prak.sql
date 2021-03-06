-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2018 at 08:25 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_prak`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_atr_perm1`
--

CREATE TABLE `tb_atr_perm1` (
  `id_atr_perm1` int(10) NOT NULL,
  `class` varchar(255) DEFAULT NULL,
  `batas_bawah` float DEFAULT NULL,
  `batas_atas` float DEFAULT NULL,
  `sesi` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_atr_perm1`
--

INSERT INTO `tb_atr_perm1` (`id_atr_perm1`, `class`, `batas_bawah`, `batas_atas`, `sesi`) VALUES
(1, 'Tinggi', 77, 154, 14),
(2, 'Sedang', 51.3333, 76, 14),
(3, 'Rendah', 0, 50.3333, 14);

-- --------------------------------------------------------

--
-- Table structure for table `tb_atr_perm2`
--

CREATE TABLE `tb_atr_perm2` (
  `id_atr_perm2` int(10) NOT NULL,
  `class` varchar(255) DEFAULT NULL,
  `batas_bawah` float DEFAULT NULL,
  `batas_atas` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_atr_perm2`
--

INSERT INTO `tb_atr_perm2` (`id_atr_perm2`, `class`, `batas_bawah`, `batas_atas`) VALUES
(1, 'Tinggi', 70, 140),
(2, 'Sedang', 46.6667, 69),
(3, 'Rendah', 0, 45.6667);

-- --------------------------------------------------------

--
-- Table structure for table `tb_aturan`
--

CREATE TABLE `tb_aturan` (
  `id_aturan` int(11) NOT NULL,
  `permis1` varchar(255) DEFAULT NULL,
  `permis2` varchar(255) DEFAULT NULL,
  `permis3` varchar(255) DEFAULT NULL,
  `hasil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_aturan`
--

INSERT INTO `tb_aturan` (`id_aturan`, `permis1`, `permis2`, `permis3`, `hasil`) VALUES
(2, '-', 'Rendah', '-', 'Nilai Praktikum kosong'),
(3, '-', '-', '-', 'Permis kosong'),
(4, 'Rendah', 'Tinggi', '-', 'Nilai Sikap Kosong'),
(5, 'Rendah', 'Rendah', '-', 'Tidak lulus'),
(6, 'Rendah', 'Sedang', '-', 'Nilai Sikap Kosong'),
(7, 'Sedang', 'Rendah', '-', 'Nilai Sikap Kosong'),
(8, 'Sedang', 'Sedang', '-', 'Nilai Sikap Kosong'),
(9, 'Sedang', 'Tinggi', '-', 'Nilai Sikap Kosong'),
(10, 'Tinggi', 'Rendah', '-', 'Nilai Sikap Kosong'),
(11, 'Tinggi', 'Sedang', '-', 'Nilai Sikap Kosong'),
(12, 'Tinggi', 'Tinggi', '-', 'Nilai Sikap Kosong'),
(16, 'Rendah', '-', 'Baik', 'Responsi kosong'),
(17, 'Rendah', '-', 'Sedang', 'Responsi kosong'),
(18, 'Rendah', '-', '-', 'Responsi kosong'),
(19, '-', 'Rendah', 'Sedang', 'Nilai Praktikum kosong'),
(20, '-', 'Rendah', 'Kurang', 'Nilai Praktikum kosong'),
(21, '-', 'Rendah', 'Baik', 'Nilai Praktikum kosong'),
(22, 'Rendah', '-', 'Kurang', 'Responsi kosong'),
(23, 'Rendah', 'Tinggi', 'Baik', 'Tidak lulus'),
(24, 'Rendah', 'Tinggi', 'Sedang', 'Tidak lulus'),
(25, 'Rendah', 'Tinggi', 'Kurang', 'Tidak lulus'),
(26, 'Rendah', 'Rendah', 'Baik', 'Tidak lulus'),
(27, 'Rendah', 'Rendah', 'Sedang', 'Tidak lulus'),
(28, 'Rendah', 'Rendah', 'Kurang', 'Tidak lulus'),
(29, 'Rendah', 'Sedang', 'Baik', 'Tidak lulus'),
(30, 'Rendah', 'Sedang', 'Sedang', 'Tidak lulus'),
(31, 'Rendah', 'Sedang', 'Kurang', 'Tidak lulus'),
(32, 'Sedang', 'Rendah', 'Baik', 'Lulus'),
(33, 'Sedang', 'Rendah', 'Sedang', 'Lulus'),
(34, 'Sedang', 'Rendah', 'Kurang', 'Tidak lulus'),
(35, 'Sedang', 'Sedang', 'Baik', 'Lulus'),
(36, 'Sedang', 'Sedang', 'Sedang', 'Lulus'),
(37, 'Sedang', 'Sedang', 'Kurang', 'Tidak lulus'),
(38, 'Sedang', 'Tinggi', 'Baik', 'Lulus'),
(39, 'Sedang', 'Tinggi', 'Sedang', 'Lulus'),
(40, 'Sedang', 'Tinggi', 'Kurang', 'Tidak lulus'),
(41, 'Tinggi', 'Rendah', 'Baik', 'Lulus'),
(42, 'Tinggi', 'Rendah', 'Sedang', 'Lulus'),
(43, 'Tinggi', 'Rendah', 'Kurang', 'Tidak lulus'),
(44, 'Tinggi', 'Sedang', 'Baik', 'Lulus'),
(45, 'Tinggi', 'Sedang', 'Sedang', 'Lulus'),
(46, 'Tinggi', 'Sedang', 'Kurang', 'Tidak lulus'),
(47, 'Tinggi', 'Tinggi', 'Baik', 'Lulus'),
(48, 'Tinggi', 'Tinggi', 'Sedang', 'Lulus'),
(49, 'Tinggi', 'Tinggi', 'Kurang', 'Tidak lulus'),
(50, '-', '-', 'Baik', 'Permis kosong'),
(51, '-', '-', 'Sedang', 'Permis kosong'),
(52, '-', '-', 'Kurang', 'Permis kosong');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil_akhir`
--

CREATE TABLE `tb_hasil_akhir` (
  `id_hasil_akhir` int(10) NOT NULL,
  `nim` int(20) DEFAULT NULL,
  `id_pelajaran` int(10) DEFAULT NULL,
  `id_prak_akhir` int(10) DEFAULT NULL,
  `id_responsi` int(10) DEFAULT NULL,
  `id_aturan` int(10) DEFAULT NULL,
  `id_sikap` int(10) DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL,
  `id_nilai` int(10) DEFAULT NULL,
  `nilai_akhir` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_hasil_akhir`
--

INSERT INTO `tb_hasil_akhir` (`id_hasil_akhir`, `nim`, `id_pelajaran`, `id_prak_akhir`, `id_responsi`, `id_aturan`, `id_sikap`, `id_user`, `id_nilai`, `nilai_akhir`) VALUES
(2, 123453, 4, 1, 27, 26, 3, NULL, 12, 4.85714);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal`
--

CREATE TABLE `tb_jadwal` (
  `id_jadwal` int(5) NOT NULL,
  `tgl` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `id_kelompok` int(10) DEFAULT NULL,
  `id_pelajaran` int(10) DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jadwal`
--

INSERT INTO `tb_jadwal` (`id_jadwal`, `tgl`, `jam_mulai`, `id_kelompok`, `id_pelajaran`, `id_user`, `jam_selesai`) VALUES
(1, '2018-08-10', '09:30:00', 1, 2, 4, NULL),
(3, '2018-08-10', '09:30:00', 2, 1, 7, NULL),
(4, '2018-08-10', '09:30:00', 1, 1, 0, NULL),
(5, '0000-00-00', '00:00:00', 0, 2, 0, NULL),
(6, '2018-08-25', '10:08:00', 0, 4, 0, NULL),
(7, '2018-09-01', '10:08:00', 0, 4, 0, NULL),
(8, '2018-09-08', '10:08:00', 0, 4, 0, NULL),
(9, '2018-09-15', '10:08:00', 0, 4, 0, NULL),
(10, '2018-09-22', '10:08:00', 0, 4, 0, NULL),
(11, '2018-09-29', '10:08:00', 0, 4, 0, NULL),
(12, '2018-10-06', '10:08:00', 0, 4, 0, NULL),
(13, '2018-10-13', '10:08:00', 0, 4, 0, NULL),
(14, '2018-10-20', '10:08:00', 0, 4, 0, NULL),
(15, '2018-10-27', '10:08:00', 0, 4, 0, NULL),
(16, '2018-11-03', '10:08:00', 0, 4, 0, NULL),
(17, '2018-11-10', '10:08:00', 0, 4, 0, NULL),
(18, '2018-11-17', '10:08:00', 0, 4, 0, NULL),
(19, '2018-11-24', '10:08:00', 0, 4, 0, NULL),
(20, '2018-08-25', '10:08:00', 0, 1, 0, NULL),
(21, '2018-08-25', '10:08:00', 0, 1, 0, NULL),
(22, '2018-08-25', '08:08:00', 1, 1, 4, '10:09:00'),
(23, '2018-08-25', '08:08:00', 1, 1, 4, '10:10:00'),
(24, '2018-08-25', '08:08:00', 0, 4, 0, '10:08:00'),
(25, '2018-09-01', '08:08:00', 0, 4, 0, '10:08:00'),
(26, '2018-09-08', '08:08:00', 0, 4, 0, '10:08:00'),
(27, '2018-09-15', '08:08:00', 0, 4, 0, '10:08:00'),
(28, '2018-09-22', '08:08:00', 0, 4, 0, '10:08:00'),
(29, '2018-09-29', '08:08:00', 0, 4, 0, '10:08:00'),
(30, '2018-10-06', '08:08:00', 0, 4, 0, '10:08:00'),
(31, '2018-10-13', '08:08:00', 0, 4, 0, '10:08:00'),
(32, '2018-10-20', '08:08:00', 0, 4, 0, '10:08:00'),
(33, '2018-10-27', '08:08:00', 0, 4, 0, '10:08:00'),
(34, '2018-11-03', '08:08:00', 0, 4, 0, '10:08:00'),
(35, '2018-11-10', '08:08:00', 0, 4, 0, '10:08:00'),
(36, '2018-11-17', '08:08:00', 0, 4, 0, '10:08:00'),
(37, '2018-11-24', '08:08:00', 0, 4, 0, '10:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelompok`
--

CREATE TABLE `tb_kelompok` (
  `id_kelompok` int(10) NOT NULL,
  `nm_kelompok` varchar(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_pelajaran` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelompok`
--

INSERT INTO `tb_kelompok` (`id_kelompok`, `nm_kelompok`, `id_user`, `id_pelajaran`) VALUES
(1, 'I', 4, 4),
(2, 'II', 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kurikulum`
--

CREATE TABLE `tb_kurikulum` (
  `id_kurikulum` int(10) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `tahun` varchar(25) DEFAULT NULL,
  `flag` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kurikulum`
--

INSERT INTO `tb_kurikulum` (`id_kurikulum`, `semester`, `tahun`, `flag`) VALUES
(1, 'Ganjil', '2016/2017', '0'),
(2, 'Genjil', '2016/2017', '0'),
(3, 'Genap', '2017/2018', '0'),
(4, 'Ganjil', '2017/2018', '0'),
(6, 'Genap', '2018/2019', '0'),
(7, 'Ganjil', '2020/2030', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_level`
--

CREATE TABLE `tb_level` (
  `id_level` int(10) NOT NULL,
  `level` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_level`
--

INSERT INTO `tb_level` (`id_level`, `level`) VALUES
(1, 'admin'),
(2, 'dosen'),
(3, 'laboran'),
(4, 'asisten');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `nim` int(20) NOT NULL,
  `nama_mhs` varchar(60) NOT NULL,
  `id_kelompok` int(10) NOT NULL,
  `id_pelajaran` int(10) DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`nim`, `nama_mhs`, `id_kelompok`, `id_pelajaran`, `id_user`) VALUES
(14766, 'Nurmala Sari', 2, 2, NULL),
(15812, 'Afira Dinda Aningtyas', 1, 2, NULL),
(123453, 'Paijo', 2, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_prak`
--

CREATE TABLE `tb_nilai_prak` (
  `id_nilai_prak` int(5) NOT NULL,
  `id_sub` int(10) NOT NULL,
  `id_pelajaran` int(10) NOT NULL,
  `pretest` float NOT NULL,
  `laporan` float NOT NULL,
  `nim` int(20) NOT NULL,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_nilai_prak`
--

INSERT INTO `tb_nilai_prak` (`id_nilai_prak`, `id_sub`, `id_pelajaran`, `pretest`, `laporan`, `nim`, `id_user`) VALUES
(1, 1, 1, 7.8, 8.2, 14766, 4),
(2, 2, 2, 3.57, 4.65, 14766, 4),
(132, 1, 4, 1, 9, 123453, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelajaran`
--

CREATE TABLE `tb_pelajaran` (
  `id_pelajaran` int(10) NOT NULL,
  `id_kurikulum` int(10) DEFAULT NULL,
  `nama_pelajaran` varchar(255) DEFAULT NULL,
  `sesi` int(3) DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pelajaran`
--

INSERT INTO `tb_pelajaran` (`id_pelajaran`, `id_kurikulum`, `nama_pelajaran`, `sesi`, `id_user`) VALUES
(1, 7, 'Efek Foto Listriki', 1, NULL),
(2, 1, 'Sinar X', 0, NULL),
(4, 7, 'sdf', 14, 5),
(5, 7, 'test', 14, NULL),
(6, 7, 'coba', 14, NULL),
(8, 7, 'tt', 14, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_penilaian`
--

CREATE TABLE `tb_penilaian` (
  `id_nilai` int(10) NOT NULL,
  `nilai_huruf` varchar(3) DEFAULT NULL,
  `nilai_angka_bawah` float DEFAULT NULL,
  `nilai_angka_atas` float DEFAULT NULL,
  `ip` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_penilaian`
--

INSERT INTO `tb_penilaian` (`id_nilai`, `nilai_huruf`, `nilai_angka_bawah`, `nilai_angka_atas`, `ip`) VALUES
(1, 'A', 80, 0, 4),
(2, 'A-', 77.5, 79.99, 3.75),
(3, 'A/B', 75, 77.49, 3.5),
(4, 'B+', 72.5, 74.99, 3.25),
(5, 'B', 70, 72.49, 3),
(6, 'B-', 67.5, 69.99, 2.75),
(7, 'B/C', 65, 67.49, 2.5),
(8, 'C+', 62.5, 64.99, 2.25),
(9, 'C', 60, 62.49, 2),
(10, 'C-', 57, 59.99, 1.75),
(11, 'D', 55, 56.99, 1),
(12, 'E', 0, 54.99, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_prak_akhir`
--

CREATE TABLE `tb_prak_akhir` (
  `id_prak_akhir` int(10) NOT NULL,
  `nim` int(20) DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL,
  `id_pelajaran` int(10) DEFAULT NULL,
  `id_atr_perm1` int(10) DEFAULT NULL,
  `nilai` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_prak_akhir`
--

INSERT INTO `tb_prak_akhir` (`id_prak_akhir`, `nim`, `id_user`, `id_pelajaran`, `id_atr_perm1`, `nilai`) VALUES
(1, 123453, NULL, 4, 3, 0.714286);

-- --------------------------------------------------------

--
-- Table structure for table `tb_responsi`
--

CREATE TABLE `tb_responsi` (
  `id_responsi` int(10) NOT NULL,
  `nilai_responsi` float DEFAULT NULL,
  `nim` int(20) DEFAULT NULL,
  `id_atr_perm2` int(10) DEFAULT NULL,
  `id_kurikulum` int(10) DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL,
  `id_pelajaran` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_responsi`
--

INSERT INTO `tb_responsi` (`id_responsi`, `nilai_responsi`, `nim`, `id_atr_perm2`, `id_kurikulum`, `id_user`, `id_pelajaran`) VALUES
(1, 2.79, 14766, 1, 1, 5, NULL),
(8, 7, 15812, NULL, 7, 5, NULL),
(27, 9, 123453, 3, 7, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sikap`
--

CREATE TABLE `tb_sikap` (
  `id_sikap` int(10) NOT NULL,
  `nim` int(20) DEFAULT NULL,
  `id_pelajaran` int(10) DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL,
  `sikap` enum('Baik','Sedang','Kurang') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sikap`
--

INSERT INTO `tb_sikap` (`id_sikap`, `nim`, `id_pelajaran`, `id_user`, `sikap`) VALUES
(10, 14766, 2, 2, 'Baik'),
(11, NULL, NULL, 2, NULL),
(12, 15812, 2, 2, 'Baik');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub_pelajaran`
--

CREATE TABLE `tb_sub_pelajaran` (
  `id_sub` int(10) NOT NULL,
  `id_pelajaran` int(10) DEFAULT NULL,
  `nama_sub_pelajaran` varchar(255) DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sub_pelajaran`
--

INSERT INTO `tb_sub_pelajaran` (`id_sub`, `id_pelajaran`, `nama_sub_pelajaran`, `id_user`) VALUES
(1, 4, 'w', 4),
(2, 1, 'r', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(10) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `id_level` int(10) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `jenis_kelamin`, `username`, `password`, `id_level`, `pass`) VALUES
(2, 'aji', 'L', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 1, '12345'),
(3, 'laboran', 'P', 'laboran', '827ccb0eea8a706c4c34a16891f84e7b', 3, '12345'),
(4, 'asisten1', 'L', 'asisten1', '827ccb0eea8a706c4c34a16891f84e7b', 4, '12345'),
(5, 'dosen1', 'P', 'dosen1', '827ccb0eea8a706c4c34a16891f84e7b', 2, '12345'),
(7, 'asisten2', 'P', 'asisten2', '827ccb0eea8a706c4c34a16891f84e7b', 4, '12345'),
(8, 'dosen2', 'P', 'dosen2', '18bd9197cb1d833bc352f47535c00320', 2, 'hu'),
(9, 'Paijo', 'L', 'paijo', '827ccb0eea8a706c4c34a16891f84e7b', 1, '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_atr_perm1`
--
ALTER TABLE `tb_atr_perm1`
  ADD PRIMARY KEY (`id_atr_perm1`);

--
-- Indexes for table `tb_atr_perm2`
--
ALTER TABLE `tb_atr_perm2`
  ADD PRIMARY KEY (`id_atr_perm2`);

--
-- Indexes for table `tb_aturan`
--
ALTER TABLE `tb_aturan`
  ADD PRIMARY KEY (`id_aturan`),
  ADD KEY `id_perm1` (`permis1`),
  ADD KEY `id_perm2` (`hasil`);

--
-- Indexes for table `tb_hasil_akhir`
--
ALTER TABLE `tb_hasil_akhir`
  ADD PRIMARY KEY (`id_hasil_akhir`),
  ADD KEY `id_prak_akhir` (`id_prak_akhir`),
  ADD KEY `id_responsi` (`id_responsi`),
  ADD KEY `id_aturan` (`id_aturan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_kurikulum` (`nim`);

--
-- Indexes for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `tb_kelompok`
--
ALTER TABLE `tb_kelompok`
  ADD PRIMARY KEY (`id_kelompok`);

--
-- Indexes for table `tb_kurikulum`
--
ALTER TABLE `tb_kurikulum`
  ADD PRIMARY KEY (`id_kurikulum`),
  ADD KEY `id_kurikulum` (`id_kurikulum`);

--
-- Indexes for table `tb_level`
--
ALTER TABLE `tb_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `tb_nilai_prak`
--
ALTER TABLE `tb_nilai_prak`
  ADD PRIMARY KEY (`id_nilai_prak`);

--
-- Indexes for table `tb_pelajaran`
--
ALTER TABLE `tb_pelajaran`
  ADD PRIMARY KEY (`id_pelajaran`),
  ADD KEY `id_kurikulum` (`id_kurikulum`);

--
-- Indexes for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `tb_prak_akhir`
--
ALTER TABLE `tb_prak_akhir`
  ADD PRIMARY KEY (`id_prak_akhir`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_atr_perm1` (`id_atr_perm1`),
  ADD KEY `id_pelajaran` (`id_pelajaran`);

--
-- Indexes for table `tb_responsi`
--
ALTER TABLE `tb_responsi`
  ADD PRIMARY KEY (`id_responsi`),
  ADD KEY `id_atr_prem2` (`id_atr_perm2`),
  ADD KEY `id_kurikulum` (`id_kurikulum`),
  ADD KEY `creation_id` (`id_user`);

--
-- Indexes for table `tb_sikap`
--
ALTER TABLE `tb_sikap`
  ADD PRIMARY KEY (`id_sikap`),
  ADD KEY `nim` (`nim`),
  ADD KEY `id_pelajaran` (`id_pelajaran`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_sub_pelajaran`
--
ALTER TABLE `tb_sub_pelajaran`
  ADD PRIMARY KEY (`id_sub`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_level` (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_atr_perm1`
--
ALTER TABLE `tb_atr_perm1`
  MODIFY `id_atr_perm1` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_atr_perm2`
--
ALTER TABLE `tb_atr_perm2`
  MODIFY `id_atr_perm2` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_aturan`
--
ALTER TABLE `tb_aturan`
  MODIFY `id_aturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tb_hasil_akhir`
--
ALTER TABLE `tb_hasil_akhir`
  MODIFY `id_hasil_akhir` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  MODIFY `id_jadwal` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tb_kelompok`
--
ALTER TABLE `tb_kelompok`
  MODIFY `id_kelompok` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_kurikulum`
--
ALTER TABLE `tb_kurikulum`
  MODIFY `id_kurikulum` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_nilai_prak`
--
ALTER TABLE `tb_nilai_prak`
  MODIFY `id_nilai_prak` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `tb_pelajaran`
--
ALTER TABLE `tb_pelajaran`
  MODIFY `id_pelajaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  MODIFY `id_nilai` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_prak_akhir`
--
ALTER TABLE `tb_prak_akhir`
  MODIFY `id_prak_akhir` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_responsi`
--
ALTER TABLE `tb_responsi`
  MODIFY `id_responsi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_sikap`
--
ALTER TABLE `tb_sikap`
  MODIFY `id_sikap` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_sub_pelajaran`
--
ALTER TABLE `tb_sub_pelajaran`
  MODIFY `id_sub` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_hasil_akhir`
--
ALTER TABLE `tb_hasil_akhir`
  ADD CONSTRAINT `tb_hasil_akhir_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_hasil_akhir_ibfk_5` FOREIGN KEY (`nim`) REFERENCES `tb_mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_hasil_akhir_ibfk_6` FOREIGN KEY (`id_aturan`) REFERENCES `tb_aturan` (`id_aturan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pelajaran`
--
ALTER TABLE `tb_pelajaran`
  ADD CONSTRAINT `tb_pelajaran_ibfk_1` FOREIGN KEY (`id_kurikulum`) REFERENCES `tb_kurikulum` (`id_kurikulum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_prak_akhir`
--
ALTER TABLE `tb_prak_akhir`
  ADD CONSTRAINT `tb_prak_akhir_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_sikap`
--
ALTER TABLE `tb_sikap`
  ADD CONSTRAINT `tb_sikap_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `tb_mahasiswa` (`nim`),
  ADD CONSTRAINT `tb_sikap_ibfk_2` FOREIGN KEY (`id_pelajaran`) REFERENCES `tb_pelajaran` (`id_pelajaran`),
  ADD CONSTRAINT `tb_sikap_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `tb_level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
