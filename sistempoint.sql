-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jun 2024 pada 03.43
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `tb_mhs`
--

CREATE TABLE `tb_mhs` (
  `nim_mhs` char(9) NOT NULL,
  `point` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prodi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_mhs`
--

INSERT INTO `tb_mhs` (`nim_mhs`, `point`, `user_id`, `prodi_id`) VALUES
('H1D022000', 0, 0, 0),
('H1D022002', 0, 0, 0),
('H1D022015', 0, 0, 0),
('H1D022049', 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_permo`
--

CREATE TABLE `tb_permo` (
  `id_perm` int(11) NOT NULL,
  `nim_mhs` char(9) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `bidang` varchar(100) NOT NULL,
  `capaian` varchar(100) NOT NULL,
  `file` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_prodi`
--

CREATE TABLE `tb_prodi` (
  `id` int(11) NOT NULL,
  `prodi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sertif`
--

CREATE TABLE `tb_sertif` (
  `id` int(11) NOT NULL,
  `bidang` varchar(250) NOT NULL,
  `capaian` varchar(250) NOT NULL,
  `kategori` varchar(250) NOT NULL,
  `skor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_sertif`
--

INSERT INTO `tb_sertif` (`id`, `bidang`, `capaian`, `kategori`, `skor`) VALUES
(1, 'Kompetisi', 'Juara 1 Perorangan', '', 100),
(2, 'Kompetisi', 'Juara 1 Perorangan', '', 80),
(3, 'Kompetisi', 'Juara 1 Perorangan', '', 0),
(4, 'Pengakuan', '', '', 0),
(5, '', 'Juri', '', 0),
(6, '', '', '', 0),
(7, 'Pengakuan', '', '', 0),
(8, '', 'Juri', '', 0),
(9, '', '', '', 0),
(10, 'Pengakuan', '', '', 0),
(11, '', 'Juri', '', 0),
(12, '', '', '', 0),
(13, 'Pengakuan', '', '', 0),
(14, '', 'Lainnya (maksimal 5 kegiatan/pengakuan)', '', 0),
(15, '', '', '', 0),
(16, 'Penghargaan', '(grand final, peraih medali perak berdasar nilai batas)', '', 0),
(17, 'Kompetisi', 'Juara Kategori Perorangan Lainnya', 'B', 0),
(18, 'Kompetisi', 'Juara Kategori Perorangan Lainnya', 'C', 0),
(19, 'Kompetisi', 'Juara Kategori Perorangan Lainnya', 'D', 0),
(20, 'Kompetisi', 'Juara Kategori Perorangan Lainnya', 'E', 15),
(21, 'Kompetisi', 'Juara Kategori Perorangan Lainnya', 'D', 40);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sertif_kategori`
--

CREATE TABLE `tb_sertif_kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_sertif_kategori`
--

INSERT INTO `tb_sertif_kategori` (`id`, `kategori`) VALUES
(1, 'Kategori A (Internasional)'),
(2, 'Kategori B (Regional)'),
(3, 'Kategori C (Nasional)'),
(4, 'Kategori D (Provinsi)'),
(5, 'Kategori E (Kab/Kota/PT/Fakultas)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
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
  `telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `email`, `image`, `pass`, `role_id`, `is_active`, `tgl_dibuat`, `gender`, `telp`, `alamat`) VALUES
(1, 'Aura', 'aura@gmail.com', 'default.jpg', '1234', 3, 1, 1716451375, 'P', '0987654321', 'Cilacap'),
(2, 'Mahasiswa Aura', 'mhs@gmail.com', 'default.jpg', '$2y$10$8Yhl04CQGtHVZ1.0aO.JX.ojq2fg/tp/r9I5dqweWo9gxscrbZ.OS', 1, 1, 1716451375, 'P', '0987654321', 'Cilacap'),
(3, 'Admin Aura', 'admin@gmail.com', 'default.jpg', '$2y$10$Nx9FnYwhnE8oFCyHuNOsXO2lQwi.TkGLi2t/sgeJEPbBYRCsr6Q4S', 2, 1, 1716455594, 'L', '0987654321', 'Purwokerto'),
(4, 'Pimpinan Aura', 'pimpinan@gmail.com', 'default.jpg', '$2y$10$seKytyUYdL149iIPzJ3DMuasCTLGLAMbkhQHH5kkhGfKjT486mrVq', 3, 1, 1716518241, 'P', '0987654321', 'Purbalingga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user_akses_menu`
--

CREATE TABLE `tb_user_akses_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user_akses_menu`
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
-- Struktur dari tabel `tb_user_menu`
--

CREATE TABLE `tb_user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user_menu`
--

INSERT INTO `tb_user_menu` (`id`, `menu`) VALUES
(1, 'Mahasiswa'),
(2, 'Bapendik'),
(3, 'Pimpinan'),
(4, 'Laporan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user_role`
--

CREATE TABLE `tb_user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user_role`
--

INSERT INTO `tb_user_role` (`id`, `role`) VALUES
(1, 'Mahasiswa'),
(2, 'Bapendik'),
(3, 'Pimpinan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user_sub_menu`
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
-- Dumping data untuk tabel `tb_user_sub_menu`
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
-- Indeks untuk tabel `tb_mhs`
--
ALTER TABLE `tb_mhs`
  ADD PRIMARY KEY (`nim_mhs`);

--
-- Indeks untuk tabel `tb_permo`
--
ALTER TABLE `tb_permo`
  ADD PRIMARY KEY (`id_perm`);

--
-- Indeks untuk tabel `tb_prodi`
--
ALTER TABLE `tb_prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_sertif`
--
ALTER TABLE `tb_sertif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_sertif_kategori`
--
ALTER TABLE `tb_sertif_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user_akses_menu`
--
ALTER TABLE `tb_user_akses_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user_menu`
--
ALTER TABLE `tb_user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user_role`
--
ALTER TABLE `tb_user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user_sub_menu`
--
ALTER TABLE `tb_user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_permo`
--
ALTER TABLE `tb_permo`
  MODIFY `id_perm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_prodi`
--
ALTER TABLE `tb_prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_sertif`
--
ALTER TABLE `tb_sertif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tb_sertif_kategori`
--
ALTER TABLE `tb_sertif_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_user_akses_menu`
--
ALTER TABLE `tb_user_akses_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_user_menu`
--
ALTER TABLE `tb_user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_user_role`
--
ALTER TABLE `tb_user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_user_sub_menu`
--
ALTER TABLE `tb_user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
