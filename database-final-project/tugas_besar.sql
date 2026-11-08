-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2023 at 03:55 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas_besar`
--

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `id_responden` int(11) NOT NULL,
  `id_survei` int(11) NOT NULL,
  `q1` varchar(100) NOT NULL,
  `q2` varchar(100) NOT NULL,
  `q3` varchar(100) NOT NULL,
  `q4` varchar(100) NOT NULL,
  `q5` varchar(100) NOT NULL,
  `q6` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `id_responden`, `id_survei`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`) VALUES
(1, 2, 1, 'Bagus', 'Bagus', 'Bagus', 'Bagus', 'Tidak Ada', 'Tidak Ada');

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id_pertanyaan` int(11) NOT NULL,
  `id_survei` int(11) NOT NULL,
  `q1` varchar(100) NOT NULL,
  `q2` varchar(100) NOT NULL,
  `q3` varchar(100) NOT NULL,
  `q4` varchar(100) NOT NULL,
  `q5` varchar(100) NOT NULL,
  `q6` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`id_pertanyaan`, `id_survei`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`) VALUES
(1, 1, 'Pendapat mengenai lingkungan kerja perusahaan', 'Pendapat mengenai budaya kerja perusahaan', 'Pendapat mengenai kinerja perusahaan', 'Pendapat mengenai kinerja atasan', 'Kritik', 'Saran');

-- --------------------------------------------------------

--
-- Table structure for table `responden`
--

CREATE TABLE `responden` (
  `id_responden` int(11) NOT NULL,
  `nama_responden` varchar(100) NOT NULL,
  `email_responden` varchar(100) NOT NULL,
  `password_responden` varchar(100) NOT NULL,
  `telepon_responden` varchar(15) NOT NULL,
  `id_survei` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `responden`
--

INSERT INTO `responden` (`id_responden`, `nama_responden`, `email_responden`, `password_responden`, `telepon_responden`, `id_survei`) VALUES
(1, 'admin', 'admin@admin.admin', 'admin', '-', 1),
(2, 'Don', 'don@don.don', 'don', '98981239', 1);

-- --------------------------------------------------------

--
-- Table structure for table `survei`
--

CREATE TABLE `survei` (
  `id_survei` int(11) NOT NULL,
  `judul_survei` varchar(50) NOT NULL,
  `tanggal_pembuatan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survei`
--

INSERT INTO `survei` (`id_survei`, `judul_survei`, `tanggal_pembuatan`) VALUES
(1, 'Survei Tahunan Perusahaan ABC', '2023-06-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_responden` (`id_responden`),
  ADD KEY `id_survei` (`id_survei`);

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`),
  ADD KEY `id_survei` (`id_survei`);

--
-- Indexes for table `responden`
--
ALTER TABLE `responden`
  ADD PRIMARY KEY (`id_responden`),
  ADD KEY `id_survei` (`id_survei`);

--
-- Indexes for table `survei`
--
ALTER TABLE `survei`
  ADD PRIMARY KEY (`id_survei`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `responden`
--
ALTER TABLE `responden`
  MODIFY `id_responden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `survei`
--
ALTER TABLE `survei`
  MODIFY `id_survei` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`id_responden`) REFERENCES `responden` (`id_responden`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `jawaban_ibfk_2` FOREIGN KEY (`id_survei`) REFERENCES `survei` (`id_survei`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD CONSTRAINT `pertanyaan_ibfk_1` FOREIGN KEY (`id_survei`) REFERENCES `survei` (`id_survei`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `responden`
--
ALTER TABLE `responden`
  ADD CONSTRAINT `responden_ibfk_1` FOREIGN KEY (`id_survei`) REFERENCES `survei` (`id_survei`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
