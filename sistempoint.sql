-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2024 at 11:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistempoint`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_agama`
--

CREATE TABLE `tb_agama` (
  `id` int(11) NOT NULL,
  `agama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_agama`
--

INSERT INTO `tb_agama` (`id`, `agama`) VALUES
(1, 'ISLAM'),
(2, 'KATOLIK'),
(3, 'KRISTEN'),
(4, 'HINDU'),
(5, 'BUDHA'),
(6, 'KHONGHUCU'),
(7, 'ALIRAN KEPERCAYAAN'),
(8, 'BELUM DIISI');

-- --------------------------------------------------------

--
-- Table structure for table `tb_goldar`
--

CREATE TABLE `tb_goldar` (
  `id` int(11) NOT NULL,
  `goldar` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_goldar`
--

INSERT INTO `tb_goldar` (`id`, `goldar`) VALUES
(1, 'AB'),
(2, 'A'),
(3, 'B'),
(4, 'O'),
(5, '-');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mhs`
--

CREATE TABLE `tb_mhs` (
  `nim_mhs` char(9) NOT NULL,
  `point` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `pembiayaan` varchar(500) NOT NULL,
  `cuti` int(11) NOT NULL,
  `pa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_mhs`
--

INSERT INTO `tb_mhs` (`nim_mhs`, `point`, `user_id`, `prodi_id`, `pembiayaan`, `cuti`, `pa`) VALUES
('H1D022000', 70, 2, 1, 'Biaya Sendiri', 0, 'ABC'),
('H1D022002', 0, 1, 5, '', 0, ''),
('H1D022015', 0, 5, 4, '', 0, ''),
('H1D022048', 0, 0, 0, '', 0, ''),
('H1D022049', 0, 6, 4, 'biaya_sendiri', 0, 'BCD'),
('H1D022092', 0, 7, 3, 'biaya_sendiri', 0, 'EFG');

-- --------------------------------------------------------

--
-- Table structure for table `tb_permo`
--

CREATE TABLE `tb_permo` (
  `id_perm` int(11) NOT NULL,
  `nim_mhs` char(9) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `bidang_id` int(11) NOT NULL,
  `capaian_id` int(11) NOT NULL,
  `file` varchar(300) NOT NULL,
  `persetujuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_permo`
--

INSERT INTO `tb_permo` (`id_perm`, `nim_mhs`, `kategori_id`, `bidang_id`, `capaian_id`, `file`, `persetujuan`) VALUES
(1, 'H1D022000', 1, 1, 2, 'contoh.jpg', 2),
(2, 'H1D022000', 1, 1, 2, 'contoh.jpg', 0),
(3, 'H1D022000', 3, 2, 1, 'contoh.jpg', 1),
(4, 'H1D022000', 4, 3, 3, 'contoh.jpg', 0),
(5, 'H1D022015', 2, 1, 1, 'default.jpg', 0),
(6, 'H1D022000', 5, 1, 4, 'good.png', 0),
(7, 'H1D022000', 2, 1, 2, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_prodi`
--

CREATE TABLE `tb_prodi` (
  `id` int(11) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `fakultas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_prodi`
--

INSERT INTO `tb_prodi` (`id`, `prodi`, `fakultas`) VALUES
(1, 'Elektro', 'Teknik'),
(2, 'Sipil', 'Teknik'),
(3, 'Geologi', 'Teknik'),
(4, 'Informatika', 'Teknik'),
(5, 'Industri', 'Teknik');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sertif`
--

CREATE TABLE `tb_sertif` (
  `id` int(11) NOT NULL,
  `bidang_id` varchar(250) NOT NULL,
  `capaian_id` int(11) NOT NULL,
  `kategori_id` varchar(250) NOT NULL,
  `skor` int(11) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_sertif`
--

INSERT INTO `tb_sertif` (`id`, `bidang_id`, `capaian_id`, `kategori_id`, `skor`, `is_active`) VALUES
(1, '1', 1, '1', 100, 1),
(2, '1', 1, '2', 80, 1),
(3, '1', 1, '3', 60, 1),
(4, '1', 1, '4', 50, 1),
(5, '1', 1, '5', 30, 1),
(6, '1', 2, '1', 75, 1),
(7, '1', 2, '2', 60, 1),
(8, '1', 2, '3', 45, 1),
(9, '1', 2, '4', 35, 1),
(10, '1', 2, '5', 20, 1),
(11, '1', 3, '1', 50, 1),
(12, '1', 3, '2', 40, 1),
(13, '1', 3, '3', 30, 1),
(14, '1', 3, '4', 25, 1),
(15, '1', 3, '5', 15, 1),
(16, '1', 4, '1', 40, 1),
(17, '1', 4, '2', 30, 1),
(18, '1', 4, '3', 25, 1),
(19, '1', 4, '4', 20, 1),
(20, '1', 4, '5', 15, 1),
(21, '1', 5, '1', 50, 1),
(22, '2', 9, '1', 50, 1),
(23, '2', 9, '1', 30, 0),
(24, '3', 11, '3', 32, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sertif_bidang`
--

CREATE TABLE `tb_sertif_bidang` (
  `id` int(11) NOT NULL,
  `bidang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_sertif_bidang`
--

INSERT INTO `tb_sertif_bidang` (`id`, `bidang`) VALUES
(1, 'Kompetisi'),
(2, 'Pengakuan (termasuk kepanitiaan)'),
(3, 'Penghargaan'),
(4, 'Karir Organisasi (per periode kepengurusan)');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sertif_capaian`
--

CREATE TABLE `tb_sertif_capaian` (
  `id` int(11) NOT NULL,
  `capaian` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_sertif_capaian`
--

INSERT INTO `tb_sertif_capaian` (`id`, `capaian`) VALUES
(1, 'Juara 1 Perorangan'),
(2, 'Juara 2 Perorangan'),
(3, 'Juara 3 Perorangan'),
(4, 'Juara Kategori Perorangan lainnya'),
(5, 'Juara 1 Beregu');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sertif_kategori`
--

CREATE TABLE `tb_sertif_kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_sertif_kategori`
--

INSERT INTO `tb_sertif_kategori` (`id`, `kategori`, `is_active`) VALUES
(1, 'Kategori A (Internasional)', 0),
(2, 'Kategori B (Regional)', 0),
(3, 'Kategori C (Nasional)', 0),
(4, 'Kategori D (Provinsi)', 0),
(5, 'Kategori E (Kab/Kota/PT/Fakultas)', 0),
(8, 'Juara 3 Perorangan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `tgl_dibuat` int(11) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `agama_id` int(11) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `goldar_id` int(11) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `nip` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `email`, `image`, `pass`, `role_id`, `is_active`, `tgl_dibuat`, `gender`, `agama_id`, `tempat_lahir`, `tgl_lahir`, `goldar_id`, `telp`, `alamat`, `nip`) VALUES
(1, 'Aura', 'aura@gmail.com', 'default.jpg', '1234', 1, 0, 1716451375, 'P', 0, '', '0000-00-00', 0, '0987654321', 'Cilacap', ''),
(2, 'Mahasiswa Aura', 'mhs@gmail.com', 'mahasiswa.jpg', '$2y$10$8Yhl04CQGtHVZ1.0aO.JX.ojq2fg/tp/r9I5dqweWo9gxscrbZ.OS', 1, 1, 1716451375, 'L', 2, 'Purbalingga', '2014-06-03', 3, '02987654321', 'Cilacap', ''),
(3, 'Admin Aura', 'admin@gmail.com', 'bapendik.jpg', '$2y$10$Nx9FnYwhnE8oFCyHuNOsXO2lQwi.TkGLi2t/sgeJEPbBYRCsr6Q4S', 2, 1, 1716455594, 'P', 4, 'Purwokerto', '1994-06-02', 3, '0987654321', 'Purwokerto', '198011112009121'),
(4, 'Pimpinan Aura', 'pimpinan@gmail.com', 'pimpinan.jpg', '$2y$10$seKytyUYdL149iIPzJ3DMuasCTLGLAMbkhQHH5kkhGfKjT486mrVq', 3, 1, 1716518241, 'L', 0, '', '0000-00-00', 0, '0987654321', 'Purbalingga', '199074837186438'),
(5, 'Aura Devany Salsabila Bachtiar', 'aura.bachtiar@mhs.unsoed.ac.id', 'default.jpg', '$2y$10$P4Ip82ngGQbIS1ouh4HCG.t6sjt9m/EXQuc8p76z4fod3NT1U7i9m', 1, 1, 1717217366, 'P', 0, '', '0000-00-00', 0, '09876543212', 'Cilacap', ''),
(6, 'Calista Anindita', 'calista.anindita@mhs.unsoed.ac.id', 'kucing.png', '$2y$10$8OuDEl0iXxLAwcvybn8NxeW.9I/kRbpPiJ.gcap8Qla6i6OcrpvQm', 1, 1, 1718560464, 'P', 0, '', '0000-00-00', 0, '098765678947', '', ''),
(7, 'Apelku', 'a@gmail.com', 'cat-removebg-preview.png', '$2y$10$lEXpTkG8mjVvgbgdELCeF.ioy6QekTpoJuKRBU9iRs2t0sTOhltOe', 1, 1, 1718616498, 'P', 0, '', '0000-00-00', 0, '098765678947', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_akses_menu`
--

CREATE TABLE `tb_user_akses_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user_akses_menu`
--

INSERT INTO `tb_user_akses_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 4),
(3, 2, 2),
(4, 2, 4),
(5, 3, 3),
(6, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_menu`
--

CREATE TABLE `tb_user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user_menu`
--

INSERT INTO `tb_user_menu` (`id`, `menu`) VALUES
(1, 'Mahasiswa'),
(2, 'Bapendik'),
(3, 'Pimpinan'),
(4, 'Laporan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_role`
--

CREATE TABLE `tb_user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user_role`
--

INSERT INTO `tb_user_role` (`id`, `role`) VALUES
(1, 'Mahasiswa'),
(2, 'Bapendik'),
(3, 'Pimpinan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_sub_menu`
--

CREATE TABLE `tb_user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user_sub_menu`
--

INSERT INTO `tb_user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 4, 'Laporan', 'laporan', 'fas fa-fw fa-folder-open', 1),
(2, 1, 'Pengajuan', 'pengajuan', 'fas fa-fw fa-file-import', 1),
(3, 2, 'Mahasiswa', 'mahasiswa', 'fas fa-fw fa-users', 1),
(4, 2, 'Sertifikat', 'sertifikat', 'fas fa-fw fa-file', 1),
(5, 2, 'Verifikasi', 'verifikasi', 'fas fa-fw fa-file', 1),
(6, 3, 'Mahasiswa', 'mahasiswa', 'fas fa-fw fa-users', 1),
(7, 3, 'Bapendik', 'bapendik', 'fas fa-fw fa-user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_agama`
--
ALTER TABLE `tb_agama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_goldar`
--
ALTER TABLE `tb_goldar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_mhs`
--
ALTER TABLE `tb_mhs`
  ADD PRIMARY KEY (`nim_mhs`);

--
-- Indexes for table `tb_permo`
--
ALTER TABLE `tb_permo`
  ADD PRIMARY KEY (`id_perm`);

--
-- Indexes for table `tb_prodi`
--
ALTER TABLE `tb_prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sertif`
--
ALTER TABLE `tb_sertif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sertif_bidang`
--
ALTER TABLE `tb_sertif_bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sertif_capaian`
--
ALTER TABLE `tb_sertif_capaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sertif_kategori`
--
ALTER TABLE `tb_sertif_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user_akses_menu`
--
ALTER TABLE `tb_user_akses_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user_menu`
--
ALTER TABLE `tb_user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user_role`
--
ALTER TABLE `tb_user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user_sub_menu`
--
ALTER TABLE `tb_user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_agama`
--
ALTER TABLE `tb_agama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_goldar`
--
ALTER TABLE `tb_goldar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_permo`
--
ALTER TABLE `tb_permo`
  MODIFY `id_perm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_prodi`
--
ALTER TABLE `tb_prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_sertif`
--
ALTER TABLE `tb_sertif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_sertif_bidang`
--
ALTER TABLE `tb_sertif_bidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_sertif_capaian`
--
ALTER TABLE `tb_sertif_capaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_sertif_kategori`
--
ALTER TABLE `tb_sertif_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_user_akses_menu`
--
ALTER TABLE `tb_user_akses_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_user_menu`
--
ALTER TABLE `tb_user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_user_role`
--
ALTER TABLE `tb_user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_user_sub_menu`
--
ALTER TABLE `tb_user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
