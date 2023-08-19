-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jul 2023 pada 10.04
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
  `nama_ayam` varchar(100) NOT NULL,
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

INSERT INTO `ayam` (`id_ayam`, `id_kategori`, `id_satuan`, `nama_ayam`, `harga`, `stok`, `foto`, `keterangan`, `created_user`, `created_date`, `updated_user`, `updated_date`) VALUES
('A000001', 1, 1, 'Sad', 22222, 25, 'pepaya.jpg.jpg', 'asdawawwawa', 7, '2023-07-17 17:42:45', 5, '2023-07-17 19:50:28'),
('A00001', 2, 1, 'asaaaaw', 7676767, 20, 'cengkih.jpg.jpg', 'asaa', 8, '2023-07-18 05:07:25', 8, '2023-07-18 05:07:25');

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
('', '2023-07-12', 'A000001', 2, 1233321, 'Proses', 8, '2023-07-18 05:02:46'),
('TP-2023-0000001', '2023-07-17', 'A000001', 2, 100000, 'Proses', 8, '2023-07-18 04:25:29'),
('TP-2023-0000002', '2023-07-18', 'A000001', 2, 10000, 'Proses', 8, '2023-07-18 04:31:20');

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
('TM-2023-0000001', '2023-07-17', 'A000001', 23, 8, '2023-07-17 18:22:17'),
('TM-2023-0000002', '2023-07-19', 'A000001', 2, 8, '2023-07-17 19:50:28');

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
(1, 'ayam', 5, '2022-03-07 17:09:38', 5, '2022-03-07 17:18:45'),
(2, 'Pohon', 5, '2022-03-07 17:11:15', 5, '2022-03-07 17:11:15'),
(4, 'Buah', 5, '2022-03-08 14:16:00', 5, '2022-04-20 12:46:30'),
(5, 'Sayuran', 5, '2022-04-20 12:48:37', 5, '2022-04-20 12:48:37'),
(6, 'asd', 5, '2023-07-17 17:41:31', 5, '2023-07-17 17:41:31');

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
(1, 'manado', 'L', 'Asda', '586586467', '3142', '1469574126_users-10.png', '2022-03-07 17:49:36', '2022-03-08 14:14:10'),
(2, 'asdw', 'P', 'qwertz', 'zxca', '2314', NULL, '2022-03-07 17:58:54', '2022-03-07 17:58:54');

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
(1, 'Kg', 5, '2022-04-22 11:41:41', 5, '2022-04-22 11:41:41');

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
(5, 'admin', '202cb962ac59075b964b07152d234b70', 1, 'Admin', 'aktif', '2022-03-02 20:02:51', '2022-04-15 17:05:41'),
(6, 'user', '202cb962ac59075b964b07152d234b70', 2, 'Pembeli', 'aktif', '2022-03-07 17:59:40', '2023-07-18 04:32:32'),
(7, 'yan', '202cb962ac59075b964b07152d234b70', NULL, '', 'aktif', '2023-07-17 16:21:45', '2023-07-17 16:21:45'),
(8, 'yotam', '202cb962ac59075b964b07152d234b70', NULL, 'Penjual', 'aktif', '2023-07-17 17:58:22', '2023-07-17 17:58:22');

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
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `profil`
--
ALTER TABLE `profil`
  MODIFY `id_profil` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
