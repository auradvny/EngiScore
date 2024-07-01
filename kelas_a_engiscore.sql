-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2024 at 06:06 PM
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
-- Database: `kelas_a_engiscore`
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
('H1B024003', 75, 30, 2, 'biaya_sendiri', 0, 'Indra Wijaya'),
('H1D022000', 0, 2, 2, 'biaya_sendiri', 0, 'Arif Hidayat'),
('H1D022015', 0, 28, 4, 'biaya_sendiri', 0, 'Dadang Iskandar'),
('H1D022049', 0, 29, 4, 'biaya_sendiri', 0, 'Lasmedi Afuan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_permo`
--

CREATE TABLE `tb_permo` (
  `id` int(11) NOT NULL,
  `nim_mhs` char(9) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `bidang_id` int(11) NOT NULL,
  `capaian_id` int(11) NOT NULL,
  `file` varchar(300) NOT NULL,
  `persetujuan` int(11) NOT NULL,
  `tgl_permo` int(11) NOT NULL,
  `tgl_verif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_permo`
--

INSERT INTO `tb_permo` (`id`, `nim_mhs`, `kategori_id`, `bidang_id`, `capaian_id`, `file`, `persetujuan`, `tgl_permo`, `tgl_verif`) VALUES
(18, 'H1B024003', 1, 1, 2, '1719835464_sertif1.png', 1, 1719835464, 1719835555),
(19, 'H1B024003', 2, 6, 12, '1719835494_sertif3.png', 2, 1719835494, 1719835563),
(20, 'H1B024003', 1, 8, 10, '1719835529_sertif2.png', 0, 1719835529, 0);

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
(2, '1', 1, '2', 80, 1),
(3, '1', 1, '3', 60, 1),
(4, '1', 1, '4', 50, 1),
(5, '1', 1, '5', 30, 1),
(6, '1', 2, '1', 75, 1),
(7, '1', 2, '2', 60, 1),
(8, '1', 2, '1', 45, 1),
(9, '1', 2, '4', 35, 1),
(10, '1', 2, '5', 20, 1),
(11, '1', 3, '1', 50, 1),
(12, '1', 3, '2', 40, 1),
(13, '1', 3, '3', 30, 1),
(14, '1', 3, '4', 25, 1),
(15, '1', 3, '5', 15, 1),
(21, '1', 5, '1', 50, 1),
(22, '2', 9, '1', 50, 1),
(23, '2', 9, '1', 30, 0),
(26, '8', 10, '1', 100, 0),
(31, '6', 12, '2', 40, 0);

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
(6, 'Penghargaan'),
(7, 'Karir Organisasi (per periode kepengurusan)'),
(8, 'Hasil Karya');

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
(7, 'Tanda Jasa'),
(8, 'Ketua'),
(9, 'Wakil Ketua'),
(10, 'Patent'),
(12, 'Grand final (peraih medali emas berdasar nilai batas)');

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
(10, 'Kategori E (Kab/Kota/PT/Fakultas)', 0);

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
  `tgl_lahir` date NOT NULL,
  `goldar_id` int(11) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `nip` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `email`, `image`, `pass`, `role_id`, `is_active`, `tgl_dibuat`, `gender`, `agama_id`, `tgl_lahir`, `goldar_id`, `telp`, `alamat`, `nip`) VALUES
(2, 'Mahasiswa Account', 'mhs@gmail.com', 'mahasiswa.jpg', '$2y$10$8Yhl04CQGtHVZ1.0aO.JX.ojq2fg/tp/r9I5dqweWo9gxscrbZ.OS', 1, 1, 1716451375, 'L', 6, '2014-06-03', 1, '02987654321', 'Cilacap', ''),
(3, 'Bapendik Account', 'admin@gmail.com', 'bapendik.jpg', '$2y$10$7T48nAFFvao/ngGNUhQQbuNtLG/e6vS2FKyWGMCNTGmV9PlIh.NWi', 2, 1, 1716455594, 'P', 1, '1994-06-02', 2, '0987654321', 'Purwokerto', '198011112009121'),
(28, 'Aura Devany Salsabila Bachtiar', 'aura.bachtiar@mhs.unsoed.ac.id', 'user.jpg', '$2y$10$bw2UN6CwEQqO.LBzWsIt9eM81DUJwaXJeFR2eUSw4hWc8MZX4.m/e', 1, 1, 1719833890, 'P', 1, '2003-11-14', 3, '087653566321458', 'cilacap', ''),
(29, 'Calista Anindita', 'calista.anindita@mhs.unsoed.ac.id', 'user.jpg', '$2y$10$FDroLsKcWoGTAs/3ucEnTuS7qdOtJeeiTkLhNEMkdeEuqNw0eGPd2', 1, 1, 1719833934, 'P', 1, '2004-04-22', 4, '087898765437', 'purwokerto', ''),
(30, 'Ilham Rizky Saputra', 'ilham@mhs.unsoed.ac.id', 'ilham-min.jpg', '$2y$10$cpR43onIYIreWCtTolgzQ./GzWTZM/idqsCTVjxfuWy6fiQA7j8t2', 1, 1, 1719835377, 'L', 4, '2005-05-18', 2, '087561342678', 'SEMARANG, jawa tengah', ''),
(31, 'Indah Permata Sari', 'indah@unsoed.ac.id', 'profile_31.jpg', '$2y$10$j1Rs7.5rhkr2ZDfoBHe..uU5OVIHXYg.rKPSmoo2GWNNWDzvrBBbS', 2, 1, 1719835898, 'P', 3, '1992-07-08', 1, '089767546982', 'Jakarta Barat, dki jakarta', '199207082010031003'),
(33, 'Dika Ardiansyah Putra', 'dika@unsoed.ac.id', 'admin.jpg', '$2y$10$hR4ZxyLGcET5H9AE1gdr7.rTHHlEWJyGW430U0LGibZn7gq/GPMZ2', 2, 1, 1719847685, 'L', 8, '0000-00-00', 5, '', '', '199011152010021002');

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
(5, 2, 'Verifikasi', 'verifikasi', 'fas fa-fw fa-edit', 1),
(6, 3, 'Mahasiswa', 'mahasiswa', 'fas fa-fw fa-users', 1),
(7, 3, 'Bapendik', 'bapendik', 'fas fa-fw fa-user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_token`
--

CREATE TABLE `tb_user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tb_user_token`
--
ALTER TABLE `tb_user_token`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_prodi`
--
ALTER TABLE `tb_prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_sertif`
--
ALTER TABLE `tb_sertif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tb_sertif_bidang`
--
ALTER TABLE `tb_sertif_bidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_sertif_capaian`
--
ALTER TABLE `tb_sertif_capaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_sertif_kategori`
--
ALTER TABLE `tb_sertif_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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

--
-- AUTO_INCREMENT for table `tb_user_token`
--
ALTER TABLE `tb_user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
