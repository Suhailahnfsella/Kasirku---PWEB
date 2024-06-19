-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 02:13 PM
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
-- Database: `dbkasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `username_admin` varchar(255) NOT NULL,
  `password_admin` varchar(64) NOT NULL,
  `email_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `nama_admin`, `username_admin`, `password_admin`, `email_admin`) VALUES
(1, 'Suhailah Nuriyah Fahma', 'suhailahnfsella', 'cae689d8fed4bedbb41e258ad2ff1dbafe4554ab3a36f1249dac4fabf400272e', 'suhailahnfsella@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_penjualan`
--

CREATE TABLE `tbl_detail_penjualan` (
  `id_detail_penjualan` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_detail_penjualan`
--

INSERT INTO `tbl_detail_penjualan` (`id_detail_penjualan`, `jumlah`, `id_produk`, `id_penjualan`) VALUES
(10, 1, 2, 15),
(11, 1, 1, 16),
(12, 1, 4, 16),
(13, 1, 3, 17),
(14, 3, 5, 17),
(15, 1, 1, 18),
(16, 1, 2, 18),
(17, 2, 3, 18),
(18, 1, 4, 18),
(19, 4, 5, 18),
(20, 1, 4, 19),
(21, 5, 5, 19);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(7, 'Es'),
(1, 'Makanan Berat'),
(3, 'Makanan Ringan'),
(2, 'Minuman'),
(4, 'Snack');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `username_pegawai` varchar(255) NOT NULL,
  `password_pegawai` text NOT NULL,
  `status_pegawai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`id_pegawai`, `nama_pegawai`, `username_pegawai`, `password_pegawai`, `status_pegawai`) VALUES
(1, 'Siti Aminah', 'sitiaminah12', 'Siti123*', 1),
(6, 'Sella', 'suhailahnf', '158ea0e2eef61783d250a6f2f0ced50e134f24498b9a5298da23c6e3a6a5b1cc', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjualan`
--

CREATE TABLE `tbl_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `nama_pembeli` varchar(255) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `id_status` int(11) NOT NULL DEFAULT 1,
  `id_pegawai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_penjualan`
--

INSERT INTO `tbl_penjualan` (`id_penjualan`, `tanggal_penjualan`, `nama_pembeli`, `total`, `catatan`, `id_status`, `id_pegawai`) VALUES
(15, '2024-06-11', 'Milla', 8000, '', 2, 6),
(16, '2024-06-10', 'Sella', 8000, 'Tahu kocek level 1, es batu di es teh nya dikit aja', 2, 6),
(17, '2024-06-11', 'Auryn', 11000, '', 2, 6),
(18, '2024-06-09', 'Oca', 36000, 'Sambal geprek dipisah', 2, 6),
(19, '2024-06-11', 'Sella', 8000, '', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `foto_produk` text NOT NULL,
  `keterangan_produk` text DEFAULT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `nama_produk`, `harga_produk`, `stok_produk`, `foto_produk`, `keterangan_produk`, `id_kategori`) VALUES
(1, 'Tahu Kocek', 5000, 15, '666753c0017a4_4138_tahukocek.jpg', 'Tahu dengan isian aci yang dipotong kecil - kecil dan digoreng lalu dikocek dengan cabai hijau.', 3),
(2, 'Ayam Geprek', 8000, 100, '666753d4955d7_7876_ayamgeprek.jpg', 'Ayam krispi yang digeprek dengan sambal bawang kering dilengkapi dengan nasi dan lalapan. ', 1),
(3, 'Tahu Kress Saos Bangkok', 8000, 1000, '666753ec47275_4152_tahusaosbangkok.jpg', 'Tahu Crispy dengan varian Saos Bangkok.', 3),
(4, 'Es Teh', 3000, 50, '6667540af242e_4306_esteh.jpeg', 'Es teh manis cup yang segar dengan aroma melati.', 2),
(5, 'Gorengan', 1000, 200, '6667541ace5e9_4107_gorengan.jpeg', 'Gorengan serba seribu dengan aneka varian seperti Molen, Sempol, Tempe Mendoan, Tahu Walik, dll.', 3),
(7, 'Es Milo', 4000, 100, '66683e80bdda7_9505_milo.jpg', 'Es milo dengan kemasan cup yang menyegarkan.', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username_admin` (`username_admin`),
  ADD UNIQUE KEY `email_admin` (`email_admin`);

--
-- Indexes for table `tbl_detail_penjualan`
--
ALTER TABLE `tbl_detail_penjualan`
  ADD PRIMARY KEY (`id_detail_penjualan`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_penjualan` (`id_penjualan`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`);

--
-- Indexes for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD UNIQUE KEY `username_pegawai` (`username_pegawai`);

--
-- Indexes for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD UNIQUE KEY `nama_produk` (`nama_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_detail_penjualan`
--
ALTER TABLE `tbl_detail_penjualan`
  MODIFY `id_detail_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_detail_penjualan`
--
ALTER TABLE `tbl_detail_penjualan`
  ADD CONSTRAINT `tbl_detail_penjualan_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `tbl_produk` (`id_produk`),
  ADD CONSTRAINT `tbl_detail_penjualan_ibfk_2` FOREIGN KEY (`id_penjualan`) REFERENCES `tbl_penjualan` (`id_penjualan`);

--
-- Constraints for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD CONSTRAINT `tbl_penjualan_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `tbl_pegawai` (`id_pegawai`);

--
-- Constraints for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD CONSTRAINT `tbl_produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kategori` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
