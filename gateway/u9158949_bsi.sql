-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/ --
-- Host: localhost:3306
-- Generation Time: Jul 06, 2021 at 12:19 PM
-- Server version: 5.7.34
-- PHP Version: 7.3.28
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO"; SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */; 
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bsi` --
-- --------------------------------------------------------
--
-- Table structure for table `tagihan_pembayaran` --

CREATE TABLE `tagihan_pembayaran` (
`id_invoice` varchar(100) NOT NULL, 
`tanggal_invoice` date NOT NULL,
`nomor_siswa` varchar(12) NOT NULL,
`nama` varchar(30) NOT NULL,
`nominal_tagihan` int(11) NOT NULL,
`informasi` varchar(60) NOT NULL, 
`nomor_jurnal_pembukuan` varchar(100) DEFAULT NULL, 
`waktu_transaksi` datetime DEFAULT NULL, 
`channel_pembayaran` varchar(20) DEFAULT NULL, 
`status_pembayaran` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tagihan_pembayaran` 
--

INSERT INTO `tagihan_pembayaran` (`id_invoice`, `tanggal_invoice`, `nomor_siswa`, `nama`, 
`nominal_tagihan`, `informasi`, `nomor_jurnal_pembukuan`, `waktu_transaksi`, 
`channel_pembayaran`, `status_pembayaran`) VALUES
('JUL/001', '2021-07-06', '123456', 'Ismah Nur Fithriyah', 6500000, 'Fakultas Ilmu Komputer', NULL, NULL, NULL, NULL),
('JUL/002', '2021-07-06', '876876', 'Ronny Afriansyah', 1250000, 'Fakultas Ilmu Komputer', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables 
--

--
-- Indexes for table `tagihan_pembayaran` 
--

ALTER TABLE `tagihan_pembayaran`
	ADD PRIMARY KEY (`id_invoice`) USING BTREE; 
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
