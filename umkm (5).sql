-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2021 at 03:22 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umkm`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_transaksi` int(8) NOT NULL,
  `id_produk` int(8) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_transaksi`, `id_produk`, `harga`, `jumlah`) VALUES
(8, 1, 10000, 1),
(8, 4, 8000, 1),
(9, 4, 8000, 2),
(9, 3, 15000, 1),
(9, 1, 10000, 1),
(10, 1, 10000, 1),
(10, 5, 5000, 1),
(10, 9, 3500, 1),
(13, 3, 15000, 1),
(14, 1, 10000, 1),
(14, 4, 8000, 2),
(20, 1, 10000, 3),
(20, 4, 8000, 1),
(21, 6, 16000, 2),
(22, 9, 3500, 1),
(22, 10, 12500, 1),
(24, 10, 12500, 2),
(24, 11, 12500, 2),
(25, 9, 3500, 11),
(26, 7, 12500, 4),
(0, 7, 12500, 7),
(27, 4, 8000, 2),
(28, 4, 8000, 6),
(29, 4, 8000, 2),
(30, 3, 15000, 16),
(31, 3, 15000, 1),
(32, 1, 10000, 2),
(32, 3, 15000, 1),
(33, 4, 8000, 1),
(33, 6, 16000, 2),
(34, 6, 16000, 3),
(34, 4, 8000, 2);

--
-- Triggers `detail_transaksi`
--
DELIMITER $$
CREATE TRIGGER `hapus_transaksi` AFTER DELETE ON `detail_transaksi` FOR EACH ROW BEGIN
UPDATE produk SET stok=stok + OLD.jumlah WHERE id_produk = OLD.id_produk;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `t_keluar` AFTER INSERT ON `detail_transaksi` FOR EACH ROW BEGIN
UPDATE produk SET stok=stok-NEW.jumlah WHERE id_produk=NEW.id_produk;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Makanan'),
(2, 'Minuman');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian` int(8) NOT NULL,
  `id_produk` int(8) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian`, `id_produk`, `tanggal_pembelian`, `jumlah`) VALUES
(1, 1, '2021-06-20', 8),
(3, 7, '2021-06-22', 6),
(4, 6, '2021-06-17', 6),
(5, 5, '2021-06-22', 7),
(7, 1, '2021-06-23', 2),
(8, 5, '2021-06-24', 3),
(12, 9, '2021-06-24', 3),
(13, 1, '2021-06-24', 5),
(14, 9, '2021-06-29', 2),
(15, 1, '2021-07-03', 15),
(16, 9, '2021-07-03', 10),
(17, 10, '2021-07-03', 11),
(18, 2, '2021-07-03', 20),
(19, 6, '2021-07-03', 5),
(20, 10, '2021-07-03', 12),
(21, 3, '2021-07-06', 15),
(25, 1, '2021-07-07', 20),
(26, 11, '2021-07-07', 22),
(28, 4, '2021-07-13', 10),
(29, 5, '2021-06-30', 12),
(30, 4, '2021-07-21', 4),
(31, 1, '2021-07-21', 6),
(32, 7, '2021-07-21', 6),
(33, 1, '2021-07-21', 6),
(34, 6, '2021-07-29', 3),
(36, 9, '2021-08-01', 2),
(37, 3, '2021-08-01', 6),
(41, 6, '2021-08-08', 4),
(42, 9, '2021-08-10', 15),
(43, 9, '2021-08-10', 1);

--
-- Triggers `pembelian_produk`
--
DELIMITER $$
CREATE TRIGGER `t_hapus` AFTER DELETE ON `pembelian_produk` FOR EACH ROW BEGIN
UPDATE produk SET stok=stok - OLD.jumlah WHERE id_produk = OLD.id_produk;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `t_masuk` AFTER INSERT ON `pembelian_produk` FOR EACH ROW BEGIN
UPDATE produk SET stok = stok + NEW.jumlah WHERE id_produk = NEW.id_produk;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(5) NOT NULL,
  `nama` varchar(70) NOT NULL,
  `username` varchar(70) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `username`, `password`) VALUES
(1, 'Diana Ratna Sari', 'diana', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(8) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `id_kategori` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `stok`, `id_kategori`) VALUES
(1, 'Makaroni Pelangi', 10000, 22, 1),
(3, 'Jipang Kacang', 15000, 0, 1),
(4, 'Lanting', 8000, 1, 1),
(5, 'Sale Pisang', 5000, 25, 1),
(6, 'Gula Jahe', 16000, 10, 2),
(7, 'Keripik Tempe Handayani', 12500, 0, 1),
(9, 'Wedang Uwuh', 3500, 16, 2),
(10, 'Sagon', 12500, 20, 1),
(11, 'Sumpia Udang', 12500, 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(8) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `total_transaksi` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `id_pengguna` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tgl_transaksi`, `total_transaksi`, `bayar`, `kembalian`, `id_pengguna`) VALUES
(8, '2021-07-08', 18000, 20000, 2000, 1),
(9, '2021-07-09', 41000, 42000, 1000, 1),
(10, '2021-07-10', 18500, 20000, 1500, 1),
(13, '2021-07-15', 15000, 20000, 5000, 1),
(14, '2021-07-18', 26000, 30000, 4000, 1),
(20, '2021-08-07', 38000, 40000, 2000, 1),
(21, '2021-08-07', 32000, 35000, 3000, 1),
(22, '2021-08-07', 16000, 20000, 4000, 1),
(24, '2021-08-08', 50000, 50000, 0, 1),
(25, '2021-08-10', 38500, 40000, 1500, 1),
(26, '2021-08-10', 50000, 50000, 0, 1),
(27, '2021-08-11', 16000, 17000, 1000, 1),
(28, '2021-08-11', 48000, 50000, 2000, 1),
(29, '2021-08-11', 16000, 20000, 4000, 1),
(30, '2021-08-11', 240000, 300000, 60000, 1),
(32, '2021-08-14', 35000, 50000, 15000, 1),
(34, '2021-08-20', 64000, 65000, 1000, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
