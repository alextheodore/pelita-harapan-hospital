-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2024 at 04:42 AM
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
-- Table structure for table `msadmin`
--

CREATE TABLE `msadmin` (
  `admin_id` varchar(5) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `msadmin`
--

INSERT INTO `msadmin` (`admin_id`, `password`, `email`, `fullname`, `username`) VALUES
('AM001', 'password1', 'admin1@example.com', 'Admin One', 'adminone'),
('AM002', 'password2', 'admin2@example.com', 'Admin Two', 'admintwo'),
('AM003', 'password3', 'admin3@example.com', 'Admin Three', 'adminthree'),
('AM004', 'testing', 'testing@gmail.com', 'testing', 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `msappointment`
--

CREATE TABLE `msappointment` (
  `appointment_id` varchar(5) NOT NULL,
  `doctor_id` varchar(5) DEFAULT NULL,
  `patient_id` varchar(5) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `price` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mscheckup`
--

CREATE TABLE `mscheckup` (
  `checkup_id` varchar(5) NOT NULL,
  `patient_id` varchar(5) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `details` varchar(30) DEFAULT NULL,
  `price` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `msdoctor`
--

CREATE TABLE `msdoctor` (
  `doctor_id` varchar(5) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` enum('Specialist','General') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `msdoctor`
--

INSERT INTO `msdoctor` (`doctor_id`, `name`, `type`) VALUES
('DR001', 'Dr. Alice', 'Specialist'),
('DR002', 'Dr. Bob', 'General'),
('DR003', 'Dr. Carol', 'Specialist'),
('DR004', 'Dr. Dan', 'General'),
('DR005', 'Dr. Eve', 'Specialist'),
('DR006', 'Dr. Frank', 'General'),
('DR007', 'Dr. Grace', 'Specialist'),
('DR008', 'Dr. Heidi', 'General'),
('DR009', 'Dr. Ivan', 'Specialist'),
('DR010', 'Dr. Judy', 'General');

-- --------------------------------------------------------

--
-- Table structure for table `mspatient`
--

CREATE TABLE `mspatient` (
  `patient_id` varchar(5) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `bpjs_card` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `is_registered` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mspatient`
--

INSERT INTO `mspatient` (`patient_id`, `name`, `dob`, `gender`, `phone`, `email`, `nik`, `bpjs_card`, `address`, `is_registered`) VALUES
('PA001', 'John Doe', '1990-01-01 00:00:00', 'Male', '081234567890', 'john@example.com', '3651010000000001', 'BPS123', 'Address 1', 1),
('PA002', 'Jane Smith', '1985-05-15 00:00:00', 'Female', '081234567891', 'jane@example.com', '3651020000000002', 'BPS124', 'Address 2', 1),
('PA003', 'Bob Brown', '1992-08-20 00:00:00', 'Male', '081234567892', 'bob@example.com', '3651030000000003', 'BPS125', 'Address 3', 1),
('PA004', 'Alice Green', '1995-02-28 00:00:00', 'Female', '081234567893', 'alice@example.com', '3651040000000004', 'BPS126', 'Address 4', 0),
('PA005', 'Tom White', '1988-09-10 00:00:00', 'Male', '081234567894', 'tom@example.com', '3651050000000005', 'BPS127', 'Address 5', 1),
('PA006', 'Lucy Black', '1991-12-12 00:00:00', 'Female', '081234567895', 'lucy@example.com', '3651060000000006', 'BPS128', 'Address 6', 1),
('PA007', 'Mike Blue', '1987-07-07 00:00:00', 'Male', '081234567896', 'mike@example.com', '3651070000000007', 'BPS129', 'Address 7', 1),
('PA008', 'Sara Red', '1993-04-04 00:00:00', 'Female', '081234567897', 'sara@example.com', '3651080000000008', 'BPS130', 'Address 8', 0),
('PA009', 'Nick Gray', '1986-03-03 00:00:00', 'Male', '081234567898', 'nick@example.com', '3651090000000009', 'BPS131', 'Address 9', 1),
('PA010', 'Emma Orange', '1989-10-10 00:00:00', 'Female', '081234567899', 'emma@example.com', '3651100000000010', 'BPS132', 'Address 10', 1);

-- --------------------------------------------------------

-- Table structure for table `msroomdetails`
--

CREATE TABLE `msroomdetails` (
  `room_id` varchar(5) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `code` int(10) NOT NULL,
  `patient_id` varchar(5) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `msroomdetails`
--

INSERT INTO `msroomdetails` (`room_id`, `status`, `code`, `patient_id`, `date`) VALUES
('RM001', 'Available', 601, NULL, NULL),
('RM001', 'Available', 602, NULL, NULL),
('RM001', 'Available', 603, NULL, NULL),
('RM001', 'Available', 604, NULL, NULL),
('RM001', 'Available', 605, NULL, NULL),
('RM001', 'Available', 606, NULL, NULL),
('RM002', 'Available', 701, NULL, NULL),
('RM002', 'Available', 702, NULL, NULL),
('RM002', 'Available', 703, NULL, NULL),
('RM002', 'Available', 704, NULL, NULL),
('RM002', 'Available', 705, NULL, NULL),
('RM003', 'Available', 801, NULL, NULL),
('RM003', 'Available', 802, NULL, NULL),
('RM003', 'Available', 803, NULL, NULL),
('RM003', 'Available', 804, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `msroomheader`
--

CREATE TABLE `msroomheader` (
  `room_id` varchar(5) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `total` int(10) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `last_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `msroomheader`
--

INSERT INTO `msroomheader` (`room_id`, `name`, `total`, `price`, `date`, `last_update`) VALUES
('RM001', 'VIP Room', 6, 1500000, NULL, '2024-11-03 11:07:48'),
('RM002', '1st Class', 5, 850000, NULL, '2024-11-03 11:07:48'),
('RM003', '2nd Class', 4, 500000, NULL, '2024-11-03 11:10:28');

-- --------------------------------------------------------

--
-- Table structure for table `mstest`
--

CREATE TABLE `mstest` (
  `test_id` varchar(5) NOT NULL,
  `patient_id` varchar(5) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactiondetail`
--

CREATE TABLE `transactiondetail` (
  `transaction_id` varchar(5) NOT NULL,
  `details_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactionheader`
--

CREATE TABLE `transactionheader` (
  `transaction_id` varchar(5) NOT NULL,
  `patient_id` varchar(5) DEFAULT NULL,
  `admin_id` varchar(5) DEFAULT NULL,
  `transaction_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `msadmin`
--
ALTER TABLE `msadmin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `msappointment`
--
ALTER TABLE `msappointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `mscheckup`
--
ALTER TABLE `mscheckup`
  ADD PRIMARY KEY (`checkup_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `msdoctor`
--
ALTER TABLE `msdoctor`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `mspatient`
--
ALTER TABLE `mspatient`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `msroomdetails`
--
ALTER TABLE `msroomdetails`
  ADD PRIMARY KEY (`room_id`,`code`),
  ADD KEY `fk_patient_id` (`patient_id`);

--
-- Indexes for table `msroomheader`
--
ALTER TABLE `msroomheader`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `mstest`
--
ALTER TABLE `mstest`
  ADD PRIMARY KEY (`test_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `transactiondetail`
--
ALTER TABLE `transactiondetail`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `transactionheader`
--
ALTER TABLE `transactionheader`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `msappointment`
--
ALTER TABLE `msappointment`
  ADD CONSTRAINT `msappointment_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `msdoctor` (`doctor_id`),
  ADD CONSTRAINT `msappointment_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `mspatient` (`patient_id`);

--
-- Constraints for table `mscheckup`
--
ALTER TABLE `mscheckup`
  ADD CONSTRAINT `mscheckup_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `mspatient` (`patient_id`);

--
-- Constraints for table `msroomdetails`
--
ALTER TABLE `msroomdetails`
  ADD CONSTRAINT `fk_patient_id` FOREIGN KEY (`patient_id`) REFERENCES `mspatient` (`patient_id`),
  ADD CONSTRAINT `msroomdetails_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `msroomheader` (`room_id`);

--
-- Constraints for table `mstest`
--
ALTER TABLE `mstest`
  ADD CONSTRAINT `mstest_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `mspatient` (`patient_id`);

--
-- Constraints for table `transactiondetail`
--
ALTER TABLE `transactiondetail`
  ADD CONSTRAINT `transactiondetail_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactionheader` (`transaction_id`);

--
-- Constraints for table `transactionheader`
--
ALTER TABLE `transactionheader`
  ADD CONSTRAINT `transactionheader_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `mspatient` (`patient_id`),
  ADD CONSTRAINT `transactionheader_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `msadmin` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
