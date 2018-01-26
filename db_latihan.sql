-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2016 at 02:31 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_latihan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_aslab`
--

CREATE TABLE `tbl_aslab` (
  `idaslab` int(11) NOT NULL,
  `user` varchar(25) NOT NULL,
  `nama_aslab` varchar(50) NOT NULL,
  `fakultas` varchar(50) NOT NULL,
  `jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_aslab`
--

INSERT INTO `tbl_aslab` (`idaslab`, `user`, `nama_aslab`, `fakultas`, `jurusan`) VALUES
(7, '1361505251', 'John Doe', 'Teknik', 'Informatika'),
(8, '1361505252', 'William Smith', 'Teknik', 'Informatika'),
(9, '1361505253', 'Ashley Young', 'Teknik', 'Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dosen`
--

CREATE TABLE `tbl_dosen` (
  `iddosen` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `nama_dosen` varchar(50) NOT NULL,
  `fakultas` varchar(50) NOT NULL,
  `jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dosen`
--

INSERT INTO `tbl_dosen` (`iddosen`, `user`, `nama_dosen`, `fakultas`, `jurusan`) VALUES
(20, '101234561', 'Supangat', 'Teknik', 'Informatika'),
(21, '101234562', 'Agus Darwanto', 'Teknik', 'Informatika'),
(22, '101234563', 'Geri Kusnanto', 'Teknik', 'Informatika'),
(23, '101234564', 'Muaffaq Achmad Jani', 'Teknik', 'Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kalab`
--

CREATE TABLE `tbl_kalab` (
  `idkalab` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `fakultas` varchar(50) NOT NULL,
  `jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kalab`
--

INSERT INTO `tbl_kalab` (`idkalab`, `user`, `nama`, `fakultas`, `jurusan`) VALUES
(2, '1261505241', 'Ketua Lab', 'Teknik', 'Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mahasiswa`
--

CREATE TABLE `tbl_mahasiswa` (
  `idmahasiswa` int(11) NOT NULL,
  `iduser` varchar(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kodepraktikum` varchar(50) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pendaftaran`
--

CREATE TABLE `tbl_pendaftaran` (
  `idpendaftar` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `iddosen` int(11) NOT NULL,
  `idaslab` int(11) NOT NULL,
  `kodepraktikum` varchar(50) NOT NULL,
  `namapraktikum` varchar(50) NOT NULL,
  `nilaidosen` int(11) NOT NULL,
  `nilaiaslab` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pendaftaran`
--

INSERT INTO `tbl_pendaftaran` (`idpendaftar`, `iduser`, `iddosen`, `idaslab`, `kodepraktikum`, `namapraktikum`, `nilaidosen`, `nilaiaslab`, `total`) VALUES
(25, 46, 20, 7, 'RL1', 'Rangkaian Logika', 0, 0, 0),
(26, 46, 20, 7, 'W1', 'Pemrograman WEB', 0, 75, 75),
(27, 47, 23, 7, 'SO1', 'Sistem Operasi', 80, 80, 80),
(28, 47, 23, 8, 'K1', 'Dasar Komputer', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_praktikum`
--

CREATE TABLE `tbl_praktikum` (
  `idpraktikum` int(11) NOT NULL,
  `kodepraktikum` varchar(20) NOT NULL,
  `namapraktikum` varchar(50) NOT NULL,
  `hari` varchar(50) NOT NULL,
  `pukul` varchar(50) NOT NULL,
  `iddosen` varchar(50) NOT NULL,
  `idaslab` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_praktikum`
--

INSERT INTO `tbl_praktikum` (`idpraktikum`, `kodepraktikum`, `namapraktikum`, `hari`, `pukul`, `iddosen`, `idaslab`) VALUES
(28, 'W1', 'Pemrograman WEB', 'Senin', '15:00', '20', '7'),
(29, 'J1', 'Pemrograman Java', 'Minggu', '09:00', '21', '8'),
(30, 'D1', 'Pemrograman Dasar', 'Sabtu', '21:00', '22', '9'),
(31, 'SO1', 'Sistem Operasi', 'Kamis', '15:00', '23', '7'),
(32, 'K1', 'Dasar Komputer', 'Jumat', '15:00', '23', '8'),
(33, 'RL1', 'Rangkaian Logika', 'Kamis', '15:00', '20', '7');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `iduser` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `approval` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`iduser`, `user`, `password`, `nama`, `level`, `approval`) VALUES
(3, 'admin', 'admin', 'Admin Master', 1, 1),
(30, '1261505241', 'kalab1', 'Ketua Lab', 4, 1),
(39, '101234561', 'dosen1', 'Supangat', 3, 1),
(40, '101234562', 'dosen2', 'Agus Darwanto', 3, 1),
(41, '101234563', 'dosen3', 'Geri Kusnanto', 3, 1),
(42, '101234564', 'dosen4', 'Muaffaq Achmad Jani', 3, 1),
(43, '1361505251', 'aslab1', 'John Doe', 2, 1),
(44, '1361505252', 'aslab2', 'William Smith', 2, 1),
(45, '1361505253', 'aslab3', 'Ashley Young', 2, 1),
(46, '1461505284', 'mahasiswa1', 'Peter Jack', 5, 1),
(47, '1461505285', 'mahasiswa2', 'Mahasiswa 2', 5, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_aslab`
--
ALTER TABLE `tbl_aslab`
  ADD PRIMARY KEY (`idaslab`);

--
-- Indexes for table `tbl_dosen`
--
ALTER TABLE `tbl_dosen`
  ADD PRIMARY KEY (`iddosen`);

--
-- Indexes for table `tbl_kalab`
--
ALTER TABLE `tbl_kalab`
  ADD PRIMARY KEY (`idkalab`);

--
-- Indexes for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  ADD PRIMARY KEY (`idmahasiswa`);

--
-- Indexes for table `tbl_pendaftaran`
--
ALTER TABLE `tbl_pendaftaran`
  ADD PRIMARY KEY (`idpendaftar`);

--
-- Indexes for table `tbl_praktikum`
--
ALTER TABLE `tbl_praktikum`
  ADD PRIMARY KEY (`idpraktikum`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_aslab`
--
ALTER TABLE `tbl_aslab`
  MODIFY `idaslab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_dosen`
--
ALTER TABLE `tbl_dosen`
  MODIFY `iddosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `tbl_kalab`
--
ALTER TABLE `tbl_kalab`
  MODIFY `idkalab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  MODIFY `idmahasiswa` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_pendaftaran`
--
ALTER TABLE `tbl_pendaftaran`
  MODIFY `idpendaftar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `tbl_praktikum`
--
ALTER TABLE `tbl_praktikum`
  MODIFY `idpraktikum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
