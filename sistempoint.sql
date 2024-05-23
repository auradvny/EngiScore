-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Bulan Mei 2024 pada 17.11
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
-- Database: sistempoint
--

-- --------------------------------------------------------

--
-- Struktur dari tabel tb_mahasiswa
--

CREATE TABLE tb_mhs (
  nim_mhs char(9) NOT NULL,
  nama_mhs varchar(50) NOT NULL,
  email_mhs varchar(50) NOT NULL,
  pass_mhs varchar(50) NOT NULL,
  prodi_mhs varchar(50) NOT NULL,
  telp_mhs varchar(25) NOT NULL,
  alamat_mhs text NOT NULL,
  jekel_mhs enum('L','P') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel tb_mhs
--

INSERT INTO tb_mhs (nim_mhs, nama_mhs, email_mhs, pass_mhs, prodi_mhs, telp_mhs, alamat_mhs, jekel_mhs) VALUES
('H1D022000', 'Devany', 'dvny@mhs.unsoed.ac.id', '1234', 'Sipil', '0987654321', 'Purbalingga, Indonesia', 'L'),
('H1D022015', 'Aura Devany', 'aura.bachtiar@mhs.unsoed.ac.id', '1234', 'Informatika', '08123456789', 'Cilacap, Indonesia', 'P'),
('H1D022049', 'Calista Anindita', 'calista.anindita@mhs.unsoed.ac.id', '1234', 'Informatika', '08987654321', 'Purwokerto, Indonesia', 'P');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel tb_mhs
--
ALTER TABLE tb_mhs
  ADD PRIMARY KEY (nim_mhs);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
