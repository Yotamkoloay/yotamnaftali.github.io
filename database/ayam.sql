-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Agu 2023 pada 11.57
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ayam`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ayam`
--

CREATE TABLE `ayam` (
  `id_ayam` varchar(7) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `keterangan` varchar(100) NOT NULL,
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_user` smallint(6) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ayam`
--

INSERT INTO `ayam` (`id_ayam`, `id_kategori`, `id_satuan`, `harga`, `stok`, `foto`, `keterangan`, `created_user`, `created_date`, `updated_user`, `updated_date`) VALUES
('A000001', 10, 2, 20000, 77, 'Dada.png', '', 17, '2023-08-12 13:57:40', 17, '2023-08-17 14:39:49'),
('A000002', 11, 2, 12000, 0, 'Paha-Atas.png', '', 17, '2023-08-17 14:41:07', 17, '2023-08-17 14:41:07'),
('A000003', 12, 2, 25000, 0, 'Drumstick.png', '', 17, '2023-08-17 14:41:32', 17, '2023-08-17 14:41:32'),
('A000004', 14, 2, 21000, 0, 'Sayap.png', '', 17, '2023-08-17 14:41:50', 17, '2023-08-17 14:41:50'),
('A000005', 15, 2, 50000, 0, 'Utuh.png', '', 17, '2023-08-17 14:42:04', 17, '2023-08-17 14:42:04'),
('A000006', 10, 4, 23333, 0, 'Dada.png', '', 17, '2023-08-17 15:15:29', 17, '2023-08-17 15:16:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ayam_keluar`
--

CREATE TABLE `ayam_keluar` (
  `id_ayam_keluar` varchar(15) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `id_ayam` varchar(7) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `harga` int(20) NOT NULL,
  `status` enum('Proses','Approve','Reject') NOT NULL,
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ayam_keluar`
--

INSERT INTO `ayam_keluar` (`id_ayam_keluar`, `tanggal_keluar`, `id_ayam`, `jumlah_keluar`, `harga`, `status`, `created_user`, `created_date`) VALUES
('TP-2023-0000001', '2023-08-12', 'A000001', 23, 30000, 'Approve', 18, '2023-08-12 15:43:31'),
('TP-2023-0000002', '2023-08-17', 'A000004', 2, 22, 'Proses', 18, '2023-08-17 15:04:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ayam_masuk`
--

CREATE TABLE `ayam_masuk` (
  `id_ayam_masuk` varchar(15) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `id_ayam` varchar(7) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ayam_masuk`
--

INSERT INTO `ayam_masuk` (`id_ayam_masuk`, `tanggal_masuk`, `id_ayam`, `jumlah_masuk`, `created_user`, `created_date`) VALUES
('TM-2023-0000001', '2023-08-04', 'A000001', 100, 17, '2023-08-12 14:10:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_user` smallint(6) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_user`, `created_date`, `updated_user`, `updated_date`) VALUES
(10, 'Dada', 17, '2023-08-12 13:52:37', 17, '2023-08-12 13:52:37'),
(11, 'Paha Atas', 17, '2023-08-17 14:40:00', 17, '2023-08-17 14:40:00'),
(12, 'Paha Bawah', 17, '2023-08-17 14:40:08', 17, '2023-08-17 14:40:08'),
(13, 'Ceker', 17, '2023-08-17 14:40:16', 17, '2023-08-17 14:40:16'),
(14, 'Sayap', 17, '2023-08-17 14:40:29', 17, '2023-08-17 14:40:29'),
(15, 'Ayam Utuh', 17, '2023-08-17 14:40:34', 17, '2023-08-17 14:40:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil`
--

CREATE TABLE `profil` (
  `id_profil` smallint(6) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  `luas` varchar(25) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `profil`
--

INSERT INTO `profil` (`id_profil`, `nama`, `jenis_kelamin`, `tempat`, `telepon`, `luas`, `foto`, `created_at`, `updated_at`) VALUES
(8, 'Prihati Lahuwang', 'L', '', '08123456789', '', NULL, '2023-08-12 13:43:30', '2023-08-12 13:43:30'),
(9, 'Gebideril', 'L', '', '08123456789', '', NULL, '2023-08-12 13:50:27', '2023-08-12 13:50:27'),
(10, 'Admin', 'L', 'Manado', '08123456789', '', '1586038.jpg', '2023-08-12 15:38:00', '2023-08-22 06:56:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(50) NOT NULL,
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_user` smallint(6) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`, `created_user`, `created_date`, `updated_user`, `updated_date`) VALUES
(2, 'Kilogram', 17, '2023-08-12 13:52:27', 17, '2023-08-12 13:52:27'),
(4, 'Ember', 17, '2023-08-17 15:14:55', 17, '2023-08-17 15:14:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` smallint(6) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_profil` smallint(6) DEFAULT NULL,
  `hak_akses` enum('Admin','Penjual','Pembeli') NOT NULL,
  `status` enum('aktif','blokir') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `id_profil`, `hak_akses`, `status`, `created_at`, `updated_at`) VALUES
(17, 'Prihati', '202cb962ac59075b964b07152d234b70', 8, 'Penjual', 'aktif', '2023-08-12 13:50:53', '2023-08-12 13:50:53'),
(18, 'Gebi', '202cb962ac59075b964b07152d234b70', 9, 'Pembeli', 'aktif', '2023-08-12 13:51:05', '2023-08-12 13:51:05'),
(19, 'Admin', '202cb962ac59075b964b07152d234b70', 10, 'Admin', 'aktif', '2023-08-12 15:38:14', '2023-08-12 15:38:14');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ayam`
--
ALTER TABLE `ayam`
  ADD PRIMARY KEY (`id_ayam`),
  ADD KEY `id_kategori` (`id_kategori`,`created_user`,`updated_user`),
  ADD KEY `updated_user` (`updated_user`),
  ADD KEY `created_user` (`created_user`),
  ADD KEY `id_satuan` (`id_satuan`,`created_user`,`updated_user`);

--
-- Indeks untuk tabel `ayam_keluar`
--
ALTER TABLE `ayam_keluar`
  ADD PRIMARY KEY (`id_ayam_keluar`),
  ADD KEY `created_user` (`created_user`),
  ADD KEY `id_ayam` (`id_ayam`,`created_user`) USING BTREE;

--
-- Indeks untuk tabel `ayam_masuk`
--
ALTER TABLE `ayam_masuk`
  ADD PRIMARY KEY (`id_ayam_masuk`),
  ADD KEY `id_ayam` (`id_ayam`,`created_user`),
  ADD KEY `created_user` (`created_user`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `creted_user` (`created_user`,`updated_user`),
  ADD KEY `updated_user` (`updated_user`);

--
-- Indeks untuk tabel `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`),
  ADD KEY `created_user` (`created_user`,`updated_user`),
  ADD KEY `updated_user` (`updated_user`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_profil` (`id_profil`),
  ADD KEY `level` (`hak_akses`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `profil`
--
ALTER TABLE `profil`
  MODIFY `id_profil` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ayam`
--
ALTER TABLE `ayam`
  ADD CONSTRAINT `ayam_ibfk_1` FOREIGN KEY (`updated_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ayam_ibfk_2` FOREIGN KEY (`created_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ayam_ibfk_4` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ayam_ibfk_5` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ayam_keluar`
--
ALTER TABLE `ayam_keluar`
  ADD CONSTRAINT `ayam_keluar_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ayam_keluar_ibfk_2` FOREIGN KEY (`id_ayam`) REFERENCES `ayam` (`id_ayam`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ayam_masuk`
--
ALTER TABLE `ayam_masuk`
  ADD CONSTRAINT `ayam_masuk_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ayam_masuk_ibfk_2` FOREIGN KEY (`id_ayam`) REFERENCES `ayam` (`id_ayam`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD CONSTRAINT `kategori_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kategori_ibfk_2` FOREIGN KEY (`updated_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD CONSTRAINT `satuan_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `satuan_ibfk_2` FOREIGN KEY (`updated_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_profil`) REFERENCES `profil` (`id_profil`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
