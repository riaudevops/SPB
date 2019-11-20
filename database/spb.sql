-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2019 at 04:28 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spb`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `kota_terbit` varchar(255) NOT NULL,
  `sub_judul` varchar(255) NOT NULL,
  `jumlah_halaman` varchar(255) NOT NULL,
  `letak_buku` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul`, `penulis`, `tahun`, `penerbit`, `kota_terbit`, `sub_judul`, `jumlah_halaman`, `letak_buku`, `jumlah`) VALUES
(1, 'Java', 'Mark O\'Brienz', '2019', 'IT Books', 'Mississippi', 'All about Java', '820', 'Lantai 2 > Rak 3 > CDG', '6'),
(2, 'Python', 'John', '2018', 'IT Books', 'Michigan', 'All about Python', '790', 'Lantai 2 > Rak 3-2 > CDG', '8'),
(9, 'CSS', 'Dave', '2018', 'IT Books', 'Birmingham', 'All about CSS', '431', 'Lantai 2 > Rak 3 > PMR', '9'),
(157, '13', '13', '13', '13', '13', '13', '13', '13', '13'),
(158, '14', '14', '14', '14', '14', '14', '14', '14', '14'),
(159, 'ASD', 'dummyASD', '5', 'dummy', 'dummy', 'dummy', '1', 'dummy', '1'),
(162, 'Novel', 'dummy', '2012', 'dummy', 'dummy', 'dummy', '122', 'dummy', '12'),
(163, 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy'),
(164, 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy'),
(165, 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy'),
(168, 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy'),
(169, 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy');

-- --------------------------------------------------------

--
-- Table structure for table `buku_yang_dipinjam`
--

CREATE TABLE `buku_yang_dipinjam` (
  `id` int(11) NOT NULL,
  `id_user` varchar(10) NOT NULL,
  `id_buku` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buku_yang_dipinjam`
--

INSERT INTO `buku_yang_dipinjam` (`id`, `id_user`, `id_buku`) VALUES
(1, '2', '2'),
(2, '2', '1'),
(3, '7', '1'),
(4, '7', '2'),
(5, '8', '2');

-- --------------------------------------------------------

--
-- Table structure for table `data_peminjaman_pengembalian`
--

CREATE TABLE `data_peminjaman_pengembalian` (
  `id` int(11) NOT NULL,
  `id_user` varchar(255) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `denda` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_peminjaman_pengembalian`
--

INSERT INTO `data_peminjaman_pengembalian` (`id`, `id_user`, `tanggal_peminjaman`, `tanggal_pengembalian`, `denda`, `status`) VALUES
(2, '2', '2019-11-17', '0000-00-00', '0', 0),
(4, '7', '2019-11-06', '0000-00-00', '0', 0),
(5, '8', '2019-11-08', '0000-00-00', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hak_akses` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `hak_akses`) VALUES
(1, 'rez', 'admin', '$2y$10$iPQP1wbV2PaHmmhr6t1E8uqUR3sUSFfyMtcDF.S.0xG8B.DpQtVVq', 1),
(2, 'rez2', 'user', '$2y$10$dvMXKVoLV8ye4cAtN1UTeeYWG7wx3JtUaI75coczy9mxBjsQv4aOG', 0),
(7, 'Asep', 'asep', '$2y$10$ymfd3cbGjxFqP1R9im5nd.Koj0eXf8IoZBI.bSpL6cPO68.vKHgZ.', 0),
(8, 'fauzan', 'fauzan', '$2y$10$pIzv4mZ4HUPYwEBA22dJ6un2xquVczKpK1qXnIxedqshwGTOe/QlC', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buku_yang_dipinjam`
--
ALTER TABLE `buku_yang_dipinjam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_peminjaman_pengembalian`
--
ALTER TABLE `data_peminjaman_pengembalian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `buku_yang_dipinjam`
--
ALTER TABLE `buku_yang_dipinjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_peminjaman_pengembalian`
--
ALTER TABLE `data_peminjaman_pengembalian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
