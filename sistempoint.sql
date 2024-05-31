-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2024 at 03:33 PM
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
-- Table structure for table `tb_mhs`
--

CREATE TABLE `tb_mhs` (
  `nim_mhs` char(9) NOT NULL,
  `nama_mhs` varchar(50) NOT NULL,
  `email_mhs` varchar(50) NOT NULL,
  `pass_mhs` varchar(50) NOT NULL,
  `prodi_mhs` varchar(50) NOT NULL,
  `telp_mhs` varchar(25) NOT NULL,
  `alamat_mhs` text NOT NULL,
  `jekel_mhs` enum('L','P') NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_mhs`
--

INSERT INTO `tb_mhs` (`nim_mhs`, `nama_mhs`, `email_mhs`, `pass_mhs`, `prodi_mhs`, `telp_mhs`, `alamat_mhs`, `jekel_mhs`, `role_id`) VALUES
('H1D022000', 'Devany', 'dvny@mhs.unsoed.ac.id', '1234', 'Sipil', '0987654321', 'Purbalingga, Indonesia', 'L', 0),
('H1D022002', 'aaa', 'mhs@gmail.com', '1234', 'Industri', '0987654321', 'Pbg', 'L', 0),
('H1D022015', 'Aura Devany', 'aura.bachtiar@mhs.unsoed.ac.id', '1234', 'Informatika', '08123456789', 'Cilacap, Indonesia', 'P', 0),
('H1D022049', 'Calista Anindita', 'calista.anindita@mhs.unsoed.ac.id', '1234', 'Informatika', '08987654321', 'Purwokerto, Indonesia', 'P', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sertif`
--

CREATE TABLE `tb_sertif` (
  `id` int(11) NOT NULL,
  `bidang` varchar(250) NOT NULL,
  `capaian` varchar(250) NOT NULL,
  `kategori` varchar(250) NOT NULL,
  `skor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_sertif`
--

INSERT INTO `tb_sertif` (`id`, `bidang`, `capaian`, `kategori`, `skor`) VALUES
(1, 'Kompetisi', 'Juara 1 Perorangan', 'Kategori A/Internasional', 100),
(2, 'Kompetisi', 'Juara 2 Perorangan', 'Kategori A/Internasional', 75),
(3, 'Kompetisi', '', '', 0);

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
  `tgl_dibuat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `email`, `image`, `pass`, `role_id`, `is_active`, `tgl_dibuat`) VALUES
(1, 'Aura', 'aura@gmail.com', 'default.jpg', '1234', 3, 1, 1716451375),
(2, 'aura1', 'mhs@gmail.com', 'default.jpg', '$2y$10$8Yhl04CQGtHVZ1.0aO.JX.ojq2fg/tp/r9I5dqweWo9gxscrbZ.OS', 1, 1, 1716451375),
(3, 'aura2', 'admin@gmail.com', 'default.jpg', '$2y$10$Nx9FnYwhnE8oFCyHuNOsXO2lQwi.TkGLi2t/sgeJEPbBYRCsr6Q4S', 2, 1, 1716455594),
(4, 'aura3', 'pimpinan@gmail.com', 'default.jpg', '$2y$10$seKytyUYdL149iIPzJ3DMuasCTLGLAMbkhQHH5kkhGfKjT486mrVq', 3, 1, 1716518241);

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
-- Indexes for table `tb_mhs`
--
ALTER TABLE `tb_mhs`
  ADD PRIMARY KEY (`nim_mhs`);

--
-- Indexes for table `tb_sertif`
--
ALTER TABLE `tb_sertif`
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
-- AUTO_INCREMENT for table `tb_sertif`
--
ALTER TABLE `tb_sertif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
