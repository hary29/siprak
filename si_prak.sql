-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2018 at 03:22 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `si_prak`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_atr_perm1`
--

CREATE TABLE IF NOT EXISTS `tb_atr_perm1` (
  `id_atr_perm1` int(10) NOT NULL,
  `nama_permis` varchar(255) DEFAULT NULL,
  `nilai` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_atr_perm2`
--

CREATE TABLE IF NOT EXISTS `tb_atr_perm2` (
  `id_atr_perm2` int(10) NOT NULL,
  `nama_permis` varchar(255) DEFAULT NULL,
  `nilai` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_atr_perm2`
--

INSERT INTO `tb_atr_perm2` (`id_atr_perm2`, `nama_permis`, `nilai`) VALUES
(1, 'Sedang', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_aturan`
--

CREATE TABLE IF NOT EXISTS `tb_aturan` (
  `id_aturan` int(11) NOT NULL,
  `atas` float DEFAULT NULL,
  `tengah` float DEFAULT NULL,
  `bawah` float DEFAULT NULL,
  `abjad` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil_akhir`
--

CREATE TABLE IF NOT EXISTS `tb_hasil_akhir` (
  `id_hasil_akhir` int(10) NOT NULL,
  `id_prak_akhir` int(10) DEFAULT NULL,
  `id_responsi` int(10) DEFAULT NULL,
  `id_aturan` int(10) DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL,
  `id_kurikulum` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal`
--

CREATE TABLE IF NOT EXISTS `tb_jadwal` (
`id_jadwal` int(5) NOT NULL,
  `tgl` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `id_kelompok` int(10) DEFAULT NULL,
  `id_pelajaran` int(10) DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_jadwal`
--

INSERT INTO `tb_jadwal` (`id_jadwal`, `tgl`, `jam`, `id_kelompok`, `id_pelajaran`, `id_user`) VALUES
(1, '2018-08-10', '09:30:00', 1, 2, 4),
(3, '2018-08-10', '09:30:00', 2, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelompok`
--

CREATE TABLE IF NOT EXISTS `tb_kelompok` (
`id_kelompok` int(10) NOT NULL,
  `nm_kelompok` varchar(10) NOT NULL,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_kelompok`
--

INSERT INTO `tb_kelompok` (`id_kelompok`, `nm_kelompok`, `id_user`) VALUES
(1, 'I', 4),
(2, 'II', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kurikulum`
--

CREATE TABLE IF NOT EXISTS `tb_kurikulum` (
`id_kurikulum` int(10) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `tahun` varchar(25) DEFAULT NULL,
  `flag` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tb_kurikulum`
--

INSERT INTO `tb_kurikulum` (`id_kurikulum`, `semester`, `tahun`, `flag`) VALUES
(1, 'Ganjil', '2016/2017', '0'),
(2, 'Genjil', '2016/2017', '1'),
(3, 'Genap', '2017/2018', '1'),
(4, 'Ganjil', '2017/2018', '1'),
(6, 'Genap', '2018/2019', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_level`
--

CREATE TABLE IF NOT EXISTS `tb_level` (
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

CREATE TABLE IF NOT EXISTS `tb_mahasiswa` (
  `nim` int(20) NOT NULL,
  `nama_mhs` varchar(60) NOT NULL,
  `id_kelompok` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`nim`, `nama_mhs`, `id_kelompok`) VALUES
(14766, 'Nurmala Sari', 1),
(15812, 'Afira Dinda Aningtyas', 1),
(123453, 'Paijo', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_prak`
--

CREATE TABLE IF NOT EXISTS `tb_nilai_prak` (
`id_nilai_prak` int(5) NOT NULL,
  `pertemuan` int(2) NOT NULL,
  `id_pelajaran` int(10) NOT NULL,
  `pretest` float NOT NULL,
  `laporan` float NOT NULL,
  `nim` int(20) NOT NULL,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_nilai_prak`
--

INSERT INTO `tb_nilai_prak` (`id_nilai_prak`, `pertemuan`, `id_pelajaran`, `pretest`, `laporan`, `nim`, `id_user`) VALUES
(1, 1, 1, 7.8, 8.2, 14766, 4),
(2, 2, 2, 3.57, 4.65, 14766, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelajaran`
--

CREATE TABLE IF NOT EXISTS `tb_pelajaran` (
`id_pelajaran` int(10) NOT NULL,
  `id_kurikulum` int(10) DEFAULT NULL,
  `nama_pelajaran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_pelajaran`
--

INSERT INTO `tb_pelajaran` (`id_pelajaran`, `id_kurikulum`, `nama_pelajaran`) VALUES
(1, 1, 'Efek Foto Listrik'),
(2, 1, 'Sinar X');

-- --------------------------------------------------------

--
-- Table structure for table `tb_prak_akhir`
--

CREATE TABLE IF NOT EXISTS `tb_prak_akhir` (
  `id_prak_akhir` int(10) NOT NULL,
  `id_user` int(10) DEFAULT NULL,
  `id_atr_perm1` int(10) DEFAULT NULL,
  `id_kurikulum` int(10) DEFAULT NULL,
  `id_pelajaran` int(10) DEFAULT NULL,
  `nilai` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_responsi`
--

CREATE TABLE IF NOT EXISTS `tb_responsi` (
`id_responsi` int(10) NOT NULL,
  `nilai_responsi` float DEFAULT NULL,
  `nim` int(20) DEFAULT NULL,
  `id_atr_perm2` int(10) DEFAULT NULL,
  `id_kurikulum` int(10) DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_responsi`
--

INSERT INTO `tb_responsi` (`id_responsi`, `nilai_responsi`, `nim`, `id_atr_perm2`, `id_kurikulum`, `id_user`) VALUES
(1, 2.79, 14766, 1, 1, 5),
(2, 6.74, 15812, 0, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub_pelajaran`
--

CREATE TABLE IF NOT EXISTS `tb_sub_pelajaran` (
  `id_sub` int(10) NOT NULL,
  `id_pelajaran` int(10) DEFAULT NULL,
  `id_nilai_akhir` int(10) DEFAULT NULL,
  `nama_sub` varchar(255) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  `id_ass_prak` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
`id_user` int(10) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `id_level` int(10) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `jenis_kelamin`, `username`, `password`, `id_level`, `pass`) VALUES
(2, 'aji', 'L', 'aji', '827ccb0eea8a706c4c34a16891f84e7b', 1, '12345'),
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
 ADD PRIMARY KEY (`id_aturan`), ADD KEY `id_perm1` (`atas`), ADD KEY `id_perm2` (`bawah`);

--
-- Indexes for table `tb_hasil_akhir`
--
ALTER TABLE `tb_hasil_akhir`
 ADD PRIMARY KEY (`id_hasil_akhir`), ADD KEY `id_prak_akhir` (`id_prak_akhir`), ADD KEY `id_responsi` (`id_responsi`), ADD KEY `id_aturan` (`id_aturan`), ADD KEY `id_user` (`id_user`), ADD KEY `id_kurikulum` (`id_kurikulum`);

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
 ADD PRIMARY KEY (`id_kurikulum`), ADD KEY `id_kurikulum` (`id_kurikulum`);

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
 ADD PRIMARY KEY (`id_pelajaran`), ADD KEY `id_kurikulum` (`id_kurikulum`);

--
-- Indexes for table `tb_prak_akhir`
--
ALTER TABLE `tb_prak_akhir`
 ADD PRIMARY KEY (`id_prak_akhir`), ADD KEY `id_user` (`id_user`), ADD KEY `id_atr_perm1` (`id_atr_perm1`), ADD KEY `id_kurikulum` (`id_kurikulum`), ADD KEY `id_pelajaran` (`id_pelajaran`);

--
-- Indexes for table `tb_responsi`
--
ALTER TABLE `tb_responsi`
 ADD PRIMARY KEY (`id_responsi`), ADD KEY `id_atr_prem2` (`id_atr_perm2`), ADD KEY `id_kurikulum` (`id_kurikulum`), ADD KEY `creation_id` (`id_user`);

--
-- Indexes for table `tb_sub_pelajaran`
--
ALTER TABLE `tb_sub_pelajaran`
 ADD PRIMARY KEY (`id_sub`), ADD KEY `id_pelajaran` (`id_pelajaran`), ADD KEY `creation_id` (`id_ass_prak`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
 ADD PRIMARY KEY (`id_user`), ADD KEY `id_level` (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
MODIFY `id_jadwal` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_kelompok`
--
ALTER TABLE `tb_kelompok`
MODIFY `id_kelompok` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_kurikulum`
--
ALTER TABLE `tb_kurikulum`
MODIFY `id_kurikulum` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_nilai_prak`
--
ALTER TABLE `tb_nilai_prak`
MODIFY `id_nilai_prak` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_pelajaran`
--
ALTER TABLE `tb_pelajaran`
MODIFY `id_pelajaran` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_responsi`
--
ALTER TABLE `tb_responsi`
MODIFY `id_responsi` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_hasil_akhir`
--
ALTER TABLE `tb_hasil_akhir`
ADD CONSTRAINT `tb_hasil_akhir_ibfk_1` FOREIGN KEY (`id_prak_akhir`) REFERENCES `tb_prak_akhir` (`id_prak_akhir`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_hasil_akhir_ibfk_3` FOREIGN KEY (`id_aturan`) REFERENCES `tb_aturan` (`id_aturan`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_hasil_akhir_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_hasil_akhir_ibfk_5` FOREIGN KEY (`id_kurikulum`) REFERENCES `tb_kurikulum` (`id_kurikulum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pelajaran`
--
ALTER TABLE `tb_pelajaran`
ADD CONSTRAINT `tb_pelajaran_ibfk_1` FOREIGN KEY (`id_kurikulum`) REFERENCES `tb_kurikulum` (`id_kurikulum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_prak_akhir`
--
ALTER TABLE `tb_prak_akhir`
ADD CONSTRAINT `tb_prak_akhir_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_prak_akhir_ibfk_2` FOREIGN KEY (`id_atr_perm1`) REFERENCES `tb_atr_perm1` (`id_atr_perm1`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_prak_akhir_ibfk_3` FOREIGN KEY (`id_kurikulum`) REFERENCES `tb_kurikulum` (`id_kurikulum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_sub_pelajaran`
--
ALTER TABLE `tb_sub_pelajaran`
ADD CONSTRAINT `tb_sub_pelajaran_ibfk_3` FOREIGN KEY (`id_ass_prak`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `tb_level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
