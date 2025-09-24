-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 24 Sep 2025 pada 21.47
-- Versi Server: 5.7.42-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mante392_pkkm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bukti`
--

CREATE TABLE `bukti` (
  `id` int(11) NOT NULL,
  `kode` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_bukti` text COLLATE utf8_unicode_ci,
  `keterangan` text COLLATE utf8_unicode_ci,
  `status` varchar(11) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'draft',
  `tipe` enum('file','tautan') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `captcha`
--

CREATE TABLE `captcha` (
  `captcha_id` bigint(13) UNSIGNED NOT NULL,
  `captcha_time` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(16) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `word` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `instrumen`
--

CREATE TABLE `instrumen` (
  `kode` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `urut` int(3) NOT NULL,
  `kriteria` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_referensi`
--

CREATE TABLE `m_referensi` (
  `id_referensi` int(11) NOT NULL,
  `opsi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `nilai` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `tahun` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kode` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dicapai` enum('1','2','3','4') COLLATE utf8_unicode_ci DEFAULT NULL,
  `supervisor` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilai`
--

CREATE TABLE `penilai` (
  `id` int(11) NOT NULL,
  `nip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `panggol` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jabatan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit_kerja` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `utama` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_unsur`
--

CREATE TABLE `sub_unsur` (
  `id` int(11) NOT NULL,
  `tahun` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kode` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `indikator` text COLLATE utf8_unicode_ci,
  `data` text COLLATE utf8_unicode_ci,
  `bukti` text COLLATE utf8_unicode_ci,
  `dicapai` enum('1','2','3','4') COLLATE utf8_unicode_ci NOT NULL DEFAULT '3',
  `cacah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun`
--

CREATE TABLE `tahun` (
  `tahun` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbllogin`
--

CREATE TABLE `tbllogin` (
  `username` varchar(100) NOT NULL,
  `psw` text NOT NULL,
  `nama` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `aktif` varchar(1) NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukti`
--
ALTER TABLE `bukti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `captcha`
--
ALTER TABLE `captcha`
  ADD PRIMARY KEY (`captcha_id`),
  ADD KEY `word` (`word`);

--
-- Indexes for table `instrumen`
--
ALTER TABLE `instrumen`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `m_referensi`
--
ALTER TABLE `m_referensi`
  ADD PRIMARY KEY (`id_referensi`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penilai`
--
ALTER TABLE `penilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_unsur`
--
ALTER TABLE `sub_unsur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbllogin`
--
ALTER TABLE `tbllogin`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bukti`
--
ALTER TABLE `bukti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
--
-- AUTO_INCREMENT for table `captcha`
--
ALTER TABLE `captcha`
  MODIFY `captcha_id` bigint(13) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=691;
--
-- AUTO_INCREMENT for table `m_referensi`
--
ALTER TABLE `m_referensi`
  MODIFY `id_referensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;
--
-- AUTO_INCREMENT for table `penilai`
--
ALTER TABLE `penilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sub_unsur`
--
ALTER TABLE `sub_unsur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
