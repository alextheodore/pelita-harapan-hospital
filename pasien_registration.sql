-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2024 at 09:33 AM
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
-- Database: `hospital`
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
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `mr_number` varchar(10) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `appointment_type` enum('Laboratory','Radiology','MCU','Other') NOT NULL,
  `test_name` varchar(100) NOT NULL,
  `appointment_date` date NOT NULL,
  `status` enum('Confirmed','Pending','Completed','Cancelled') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `mr_number`, `patient_name`, `birth_date`, `gender`, `appointment_type`, `test_name`, `appointment_date`, `status`, `created_at`, `updated_at`, `type`) VALUES
(1, '25110', 'Neri Kwang', '1970-11-25', 'Female', 'Laboratory', 'Complete Blood Count', '2024-10-01', 'Confirmed', '2024-10-29 20:54:11', '2024-10-29 20:54:11', NULL),
(2, '25111', 'John Doe', '1985-05-15', 'Male', 'Radiology', 'Chest X-Ray', '2024-10-02', 'Pending', '2024-10-29 20:54:11', '2024-10-29 20:54:11', NULL),
(3, '25112', 'Jane Smith', '1990-03-20', 'Female', 'MCU', 'Full Medical Checkup', '2024-10-03', 'Confirmed', '2024-10-29 20:54:11', '2024-10-29 20:54:11', NULL);

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
