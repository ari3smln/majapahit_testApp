-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jul 2020 pada 14.39
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `majapahit_app`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hadiah`
--

CREATE TABLE `hadiah` (
  `kode_hadiah` varchar(10) NOT NULL,
  `nama_hadiah` varchar(100) NOT NULL,
  `poin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hadiah`
--

INSERT INTO `hadiah` (`kode_hadiah`, `nama_hadiah`, `poin`) VALUES
('H001', 'Lemari 3 Pintu', 15),
('H003', 'Mobil ABC', 30000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `poin`
--

CREATE TABLE `poin` (
  `id_poin` int(11) NOT NULL,
  `kode_user` varchar(10) NOT NULL,
  `kode_transaksi` varchar(10) NOT NULL,
  `kode_hadiah` varchar(10) NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `kode_produk` varchar(10) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `stok_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`kode_produk`, `nama_produk`, `deskripsi_produk`, `harga_produk`, `stok_produk`) VALUES
('P001', 'Gelas Kaca', 'Gelas Kaca', 10000, 20),
('P003', 'Teko Listrik', 'test', 10000, 22);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `kode_transaksi` varchar(20) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `kode_user` varchar(10) NOT NULL,
  `waktu_transaksi` datetime NOT NULL,
  `inputby` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_transaksi_detail` int(11) NOT NULL,
  `kode_produk` varchar(10) NOT NULL,
  `kode_transaksi` varchar(20) NOT NULL,
  `harga_transaksi` int(11) NOT NULL,
  `qty_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `kode_user` varchar(10) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `noHp` varchar(16) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(1) NOT NULL COMMENT '1=SA , 2 =CST'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`kode_user`, `nama_lengkap`, `noHp`, `alamat`, `email`, `username`, `password`, `level`) VALUES
('MT001', 'Super Admin', '123', 'jakarta', 'admin@gmail.com', 'admin', '$2y$10$/ydKnLrNxBv09YQ7xSy05OjHXOGf1tGsGf4pl7dM0PRqJoudEQc/S', 1),
('MT002', 'aris maulana', '086666', 'jakarta', 'ari3smln@gmail.com', 'ari3smln', '$2y$10$pdnCJFwKNkmr2hZ7/XGPoeo8uhitf5IfeHZVzoMJgrlKMQ6tB0yRe', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hadiah`
--
ALTER TABLE `hadiah`
  ADD PRIMARY KEY (`kode_hadiah`);

--
-- Indeks untuk tabel `poin`
--
ALTER TABLE `poin`
  ADD PRIMARY KEY (`id_poin`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`kode_produk`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`kode_transaksi`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`kode_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `poin`
--
ALTER TABLE `poin`
  MODIFY `id_poin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`kode_transaksi`) REFERENCES `users` (`kode_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
