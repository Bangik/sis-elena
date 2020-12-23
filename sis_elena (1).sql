-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2020 at 02:12 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sis_elena`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username_admin` varchar(20) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `email` varchar(25) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `password_admin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username_admin`, `nama`, `email`, `alamat`, `password_admin`) VALUES
(1, 'admin', 'admin', 'admin@polije.ac.id', 'Polije', '123');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nip` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `password_guru` varchar(20) NOT NULL,
  `kode_mapel` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `nama`, `email`, `alamat`, `password_guru`, `kode_mapel`) VALUES
('11134', 'Achmad Dinofaldi Firmansyah', 'admin@gmail.com', 'asd', '123', 'PA03'),
('1233', 'Fatims', 'fatim@email.com', 'Jember', '123', 'PA01'),
('123334', 'Fatim 2', 'asd', 'Jember', '123', 'PA05'),
('2', 'tes mtk', 'asd', 'polije', '123', 'PA01');

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `id` int(11) NOT NULL,
  `judul_informasi` varchar(50) DEFAULT NULL,
  `deskripsi` longtext DEFAULT NULL,
  `tujuan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`id`, `judul_informasi`, `deskripsi`, `tujuan`) VALUES
(8, 'INFORMASI', 'SISWA LIBUR TERUS TIDAK ADA PELAJARAN', 'Seluruh Siswa'),
(9, 'INFORMASI', 'GURU MASUK AJA', 'Guru');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `kode_kelas` varchar(20) NOT NULL,
  `temp_file` varchar(255) DEFAULT NULL,
  `file` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `kode_kelas`, `temp_file`, `file`) VALUES
(8, 'A01', 'C:xamppnew	mpphpEC2D.tmp', 'jadwal/16082637521 (1).png');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_guru`
--

CREATE TABLE `jadwal_guru` (
  `id` int(11) NOT NULL,
  `temp_file` varchar(255) NOT NULL,
  `file` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_guru`
--

INSERT INTO `jadwal_guru` (`id`, `temp_file`, `file`) VALUES
(1, 'C:xamppnew	mpphpA1D5.tmp', 'jadwal/1 (1).png');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kd_kelas` varchar(10) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `tingkatan` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kd_kelas`, `nama`, `tingkatan`) VALUES
('A01', 'X IPA 1', 1),
('A02', 'X IPA 2', 1),
('A03', 'X IPA 3', 1),
('A04', 'X IPA 4', 1),
('A05', 'X IPA 5', 1),
('A11', 'XI IPA 1', 2),
('S01', 'X IPS 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `kode_mapel` varchar(10) NOT NULL,
  `nama_mapel` varchar(20) NOT NULL,
  `kode_kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`kode_mapel`, `nama_mapel`, `kode_kelas`) VALUES
('PA01', 'Matematika', 'A01'),
('PA02', 'Fisika', 'A01'),
('PA03', 'Kimia', 'A01'),
('PA04', 'Biologi', 'A01'),
('PA05', 'Agama', 'A01'),
('PA06', 'PKn', 'A01'),
('PA07', 'Bahasa Indonesia', 'A01'),
('PA08', 'Seni Budaya', 'A01'),
('PA09', 'Fisika', 'A02'),
('PA10', 'Matematika', 'A02'),
('PA11', 'Kimia', 'A02'),
('PA12', 'Biologi', 'A02'),
('PA13', 'Agama', 'A02'),
('PA14', 'PKn', 'A02'),
('PA15', 'Bahasa Indonesia', 'A02'),
('PA16', 'Seni Budaya', 'A02'),
('PA17', 'Fisika', 'S01'),
('PA18', 'Matematika', 'A03');

-- --------------------------------------------------------

--
-- Table structure for table `materi_mapel`
--

CREATE TABLE `materi_mapel` (
  `id` int(11) NOT NULL,
  `kode_mapel` varchar(50) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `kode_aktivitas` int(11) DEFAULT NULL,
  `kode_aktivitas2` int(11) DEFAULT NULL,
  `kode_aktivitas3` int(11) DEFAULT NULL,
  `kode_kelas` varchar(20) NOT NULL,
  `checkbox` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materi_mapel`
--

INSERT INTO `materi_mapel` (`id`, `kode_mapel`, `judul`, `kode_aktivitas`, `kode_aktivitas2`, `kode_aktivitas3`, `kode_kelas`, `checkbox`) VALUES
(82, 'PA01', 'asd', NULL, 39, NULL, 'A01', NULL),
(83, 'PA02', 'BAB 3 KALKULUS', 77, NULL, NULL, 'A01', NULL),
(84, 'PA02', 'BAB 3 KALKULUS', NULL, 40, NULL, 'A01', NULL),
(85, 'PA02', 'BAB 3 KALKULUS', 78, 41, NULL, 'A01', NULL),
(86, 'PA03', 'BAB 3 HIDROGEN', 79, NULL, NULL, 'A01', NULL),
(87, 'PA10', 'asd', 80, NULL, NULL, 'A02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `kd_presensi` int(11) NOT NULL,
  `kode_aktivitas` int(11) NOT NULL,
  `kode_mapel` varchar(20) DEFAULT NULL,
  `nis` varchar(20) DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `catatan` tinyint(1) NOT NULL,
  `checkbox` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`kd_presensi`, `kode_aktivitas`, `kode_mapel`, `nis`, `jam`, `tanggal`, `status`, `catatan`, `checkbox`) VALUES
(1124, 77, 'PA02', '1112', NULL, NULL, NULL, 0, 'completion-manual-n'),
(1125, 77, 'PA02', '1222', NULL, NULL, NULL, 0, 'completion-manual-y'),
(1126, 77, 'PA02', '1234', NULL, NULL, NULL, 0, 'completion-manual-y'),
(1127, 78, 'PA02', '1112', NULL, NULL, NULL, 0, 'completion-manual-n'),
(1128, 78, 'PA02', '1222', NULL, NULL, NULL, 0, 'completion-manual-n'),
(1129, 78, 'PA02', '1234', NULL, NULL, NULL, 0, 'completion-manual-n'),
(1130, 79, 'PA03', '1112', NULL, NULL, NULL, 0, 'completion-manual-n'),
(1131, 79, 'PA03', '1222', NULL, NULL, NULL, 0, 'completion-manual-n'),
(1132, 79, 'PA03', '1234', NULL, NULL, NULL, 0, 'completion-manual-y'),
(1133, 80, 'PA10', '1235', '17:34:57', '2020-12-23', 'hadir', 1, 'completion-manual-y');

-- --------------------------------------------------------

--
-- Table structure for table `presensi2`
--

CREATE TABLE `presensi2` (
  `kode_aktivitas` int(11) NOT NULL,
  `nama_presensi` varchar(50) NOT NULL,
  `kode_mapel` varchar(10) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `jam_akhir` time NOT NULL,
  `deskripsi` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `presensi2`
--

INSERT INTO `presensi2` (`kode_aktivitas`, `nama_presensi`, `kode_mapel`, `tanggal_mulai`, `jam_mulai`, `tanggal_akhir`, `jam_akhir`, `deskripsi`) VALUES
(77, 'asd', 'PA02', '2020-02-02', '14:21:00', '2020-02-02', '02:12:00', 'ads'),
(78, 'asd', 'PA02', '2020-12-12', '14:02:00', '2020-02-02', '02:12:00', '2121asd'),
(79, 'ABSEN BAB 1', 'PA03', '2020-12-21', '02:13:00', '2020-02-12', '02:12:00', 'ADS'),
(80, 'asd', 'PA10', '2000-12-01', '12:01:00', '2020-02-12', '14:01:00', '2121');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `kode_kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `email`, `alamat`, `password`, `kode_kelas`) VALUES
('1111', 'riki', 'asd', 'Jember', '123', 'A03'),
('1112', 'Fhatimatus', 'asd', 'polije', '123', 'A01'),
('11123123123', 'Achmad Dinofaldi Firmansyah', 'admin@gmail.com', 'asd', '123', 'A11'),
('1112312313', 'Achmad Dinofaldi Firmansyah', 'admin@gmail.com', 'asddddd', '123', 'A11'),
('1222', 'Bangik', 'asd', 'asd', '123', 'A01'),
('1234', 'Ricky Adityas Wardanas', 'Meliodaskirisami@gmail.co', 'Desa Jajag Kecamatan Gambiran Banyuwangi', '123', 'A01'),
('1235', 'Muhammad Audino Fakhri Arnandya', 'dino12@gmail.com', 'Desa Jajag Kecamatan Gambiran Banyuwangi', 'akabiluru1', 'A02');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mengajar`
--

CREATE TABLE `tb_mengajar` (
  `kode_mengajar` int(11) NOT NULL,
  `kode_guru` varchar(20) NOT NULL,
  `kode_mapel` varchar(20) NOT NULL,
  `kode_kelas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_mengajar`
--

INSERT INTO `tb_mengajar` (`kode_mengajar`, `kode_guru`, `kode_mapel`, `kode_kelas`) VALUES
(1, '1233', 'PA01', 'A01'),
(2, '1233', 'PA10', 'A02'),
(3, '1233', 'PA18', 'A03'),
(4, '123334', 'PA02', 'A01'),
(5, '11134', 'PA03', 'A01');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(11) NOT NULL,
  `kode_aktivitas_tugas` int(11) NOT NULL,
  `kode_mapel` varchar(10) NOT NULL,
  `nis` varchar(10) NOT NULL,
  `jam` time DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `nama_file` varchar(200) DEFAULT NULL,
  `file` longtext DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `checkbox` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `kode_aktivitas_tugas`, `kode_mapel`, `nis`, `jam`, `tanggal`, `nama_file`, `file`, `status`, `nilai`, `checkbox`) VALUES
(108, 39, 'PA01', '1112', NULL, NULL, NULL, NULL, NULL, NULL, 'completion-manual-n'),
(109, 39, 'PA01', '1222', NULL, NULL, NULL, NULL, NULL, NULL, 'completion-manual-y'),
(110, 39, 'PA01', '1234', NULL, NULL, NULL, NULL, NULL, NULL, 'completion-manual-y'),
(111, 40, 'PA02', '1112', NULL, NULL, NULL, NULL, NULL, NULL, 'completion-manual-n'),
(112, 40, 'PA02', '1222', NULL, NULL, NULL, NULL, NULL, NULL, 'completion-manual-n'),
(113, 40, 'PA02', '1234', NULL, NULL, NULL, NULL, NULL, NULL, 'completion-manual-n'),
(114, 41, 'PA02', '1112', NULL, NULL, NULL, NULL, NULL, NULL, 'completion-manual-n'),
(115, 41, 'PA02', '1222', NULL, NULL, NULL, NULL, NULL, NULL, 'completion-manual-y'),
(116, 41, 'PA02', '1234', NULL, NULL, NULL, NULL, NULL, NULL, 'completion-manual-n');

-- --------------------------------------------------------

--
-- Table structure for table `tugas2`
--

CREATE TABLE `tugas2` (
  `kode_aktivitas2` int(11) NOT NULL,
  `nama_tugas` varchar(50) DEFAULT NULL,
  `kode_mapel` varchar(10) NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `jam_akhir` time DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `nama_file` longtext DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugas2`
--

INSERT INTO `tugas2` (`kode_aktivitas2`, `nama_tugas`, `kode_mapel`, `tanggal_mulai`, `jam_mulai`, `tanggal_akhir`, `jam_akhir`, `deskripsi`, `nama_file`, `file`) VALUES
(39, '21221', 'PA01', '2020-02-12', '14:00:00', '2020-02-02', '14:02:00', 'asd', 'WhatsApp Image 2020-12-21 at 9.07.23 AM.jpeg', 'C:xamppnew	mpphpEE6C.tmp'),
(40, '2121', 'PA02', '2020-02-12', '02:12:00', '2020-02-02', '02:12:00', '1ads', '', ''),
(41, 'asdds', 'PA02', '2020-02-02', '02:12:00', '2020-12-10', '02:12:00', 'asd', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `kode_mapel` (`kode_mapel`);

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `kode_kelas` (`kode_kelas`);

--
-- Indexes for table `jadwal_guru`
--
ALTER TABLE `jadwal_guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kd_kelas`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`kode_mapel`),
  ADD KEY `kode_kelas` (`kode_kelas`);

--
-- Indexes for table `materi_mapel`
--
ALTER TABLE `materi_mapel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_aktivitas` (`kode_aktivitas`,`kode_kelas`),
  ADD KEY `kode_mapel` (`kode_mapel`),
  ADD KEY `kode_aktivitas2` (`kode_aktivitas2`,`kode_aktivitas3`),
  ADD KEY `kode_kelas` (`kode_kelas`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`kd_presensi`),
  ADD KEY `kode_mapel` (`kode_mapel`,`nis`),
  ADD KEY `kode_aktivitas` (`kode_aktivitas`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `presensi2`
--
ALTER TABLE `presensi2`
  ADD PRIMARY KEY (`kode_aktivitas`),
  ADD KEY `kode_mapel` (`kode_mapel`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `kode_kelas` (`kode_kelas`);

--
-- Indexes for table `tb_mengajar`
--
ALTER TABLE `tb_mengajar`
  ADD PRIMARY KEY (`kode_mengajar`),
  ADD KEY `kode_guru` (`kode_guru`,`kode_mapel`),
  ADD KEY `kode_kelas` (`kode_kelas`),
  ADD KEY `kode_mapel` (`kode_mapel`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`),
  ADD KEY `nis` (`nis`),
  ADD KEY `kode_aktivitas_tugas` (`kode_aktivitas_tugas`,`kode_mapel`),
  ADD KEY `kode_mapel` (`kode_mapel`);

--
-- Indexes for table `tugas2`
--
ALTER TABLE `tugas2`
  ADD PRIMARY KEY (`kode_aktivitas2`),
  ADD KEY `kode_mapel` (`kode_mapel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jadwal_guru`
--
ALTER TABLE `jadwal_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `materi_mapel`
--
ALTER TABLE `materi_mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `kd_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1134;

--
-- AUTO_INCREMENT for table `presensi2`
--
ALTER TABLE `presensi2`
  MODIFY `kode_aktivitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `tb_mengajar`
--
ALTER TABLE `tb_mengajar`
  MODIFY `kode_mengajar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `tugas2`
--
ALTER TABLE `tugas2`
  MODIFY `kode_aktivitas2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`kode_mapel`) REFERENCES `mapel` (`kode_mapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kd_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mapel`
--
ALTER TABLE `mapel`
  ADD CONSTRAINT `mapel_ibfk_1` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kd_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `materi_mapel`
--
ALTER TABLE `materi_mapel`
  ADD CONSTRAINT `materi_mapel_ibfk_1` FOREIGN KEY (`kode_aktivitas`) REFERENCES `presensi2` (`kode_aktivitas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materi_mapel_ibfk_2` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kd_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materi_mapel_ibfk_3` FOREIGN KEY (`kode_aktivitas2`) REFERENCES `tugas2` (`kode_aktivitas2`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materi_mapel_ibfk_4` FOREIGN KEY (`kode_mapel`) REFERENCES `mapel` (`kode_mapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `presensi_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `presensi_ibfk_2` FOREIGN KEY (`kode_mapel`) REFERENCES `mapel` (`kode_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `presensi_ibfk_3` FOREIGN KEY (`kode_aktivitas`) REFERENCES `presensi2` (`kode_aktivitas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `presensi2`
--
ALTER TABLE `presensi2`
  ADD CONSTRAINT `presensi2_ibfk_1` FOREIGN KEY (`kode_mapel`) REFERENCES `mapel` (`kode_mapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kd_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_mengajar`
--
ALTER TABLE `tb_mengajar`
  ADD CONSTRAINT `tb_mengajar_ibfk_1` FOREIGN KEY (`kode_guru`) REFERENCES `guru` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_mengajar_ibfk_2` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kd_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_mengajar_ibfk_3` FOREIGN KEY (`kode_mapel`) REFERENCES `mapel` (`kode_mapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`kode_aktivitas_tugas`) REFERENCES `tugas2` (`kode_aktivitas2`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tugas_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tugas_ibfk_3` FOREIGN KEY (`kode_mapel`) REFERENCES `mapel` (`kode_mapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tugas2`
--
ALTER TABLE `tugas2`
  ADD CONSTRAINT `tugas2_ibfk_1` FOREIGN KEY (`kode_mapel`) REFERENCES `mapel` (`kode_mapel`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
