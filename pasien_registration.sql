-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2024 at 12:26 AM
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
-- Database: `pasien_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_number` int(35) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mobile_email` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_number`, `password`, `mobile_email`, `fullname`, `username`) VALUES
(1234567, 'haha123', '', '', ''),
(0, 'haha1234', 'haha@gmail.com', 'hahahihi', 'haha'),
(0, 'coba1', 'coba1@gmail.com', 'cobacobi1', 'coba1'),
(0, 'coba2', 'coba2@gmail.com', 'cobacobi2', 'coba2');

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(35) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Spesialis` varchar(50) NOT NULL,
  `Hari` varchar(10) NOT NULL,
  `Jam` varchar(30) NOT NULL,
  `Ruang` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `Nama` varchar(50) NOT NULL,
  `NIK` int(35) NOT NULL,
  `Jenis_Kelamin` varchar(10) NOT NULL,
  `TTL` varchar(35) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `No_Telepon` int(11) NOT NULL,
  `Alamat` text NOT NULL,
  `No_BPJS` int(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tindakan`
--

CREATE TABLE `tindakan` (
  `Nama_Pasien` varchar(50) NOT NULL,
  `NIK` int(35) NOT NULL,
  `Ambulan` enum('yes','no') NOT NULL,
  `Status` enum('inpatient','outpatient') NOT NULL,
  `Tindakan` enum('observed','call_spesialis') NOT NULL,
  `No_Antrian` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `Nama_Pasien` varchar(50) NOT NULL,
  `NIK` int(35) NOT NULL,
  `Nomor_Tagihan` int(20) NOT NULL,
  `Total_Tagihan` int(20) NOT NULL,
  `Jenis_Pembayaran` enum('bpjs','private','axsa','ocbc','manulife','prudential') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
