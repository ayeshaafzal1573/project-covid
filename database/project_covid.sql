-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2023 at 10:53 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_covid`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `email`, `password`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$H5Fu2fu.wUa2.FN/iURDuuXKyD838SaDCDHQ6KDnuqLhU/N8Ff0Ga'),
(2, 'Sunaina', 'sunaina@gmail.com', '$2y$10$va4PP4mkmdrkXVBJRus9JuswLaGt9Oqq606XLbPCz/JlAfYfl4Tui'),
(4, 'Haya', 'haya@gmail.com', '$2y$10$fF6Zx5NtO0U4QZAw5JkkCOLPMR/Gqyt1216cU6M.rgf/TTjZTHxNK');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `app_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `hospital_id` int(11) DEFAULT NULL,
  `app_date` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `app_time` time DEFAULT NULL,
  `test_name` varchar(255) NOT NULL,
  `approval_status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`app_id`, `patient_id`, `hospital_id`, `app_date`, `status`, `app_time`, `test_name`, `approval_status`) VALUES
(1, 1, 1, '2023-09-30', 1, '19:25:00', 'PCR', 'Approved'),
(4, 2, 1, '2023-10-09', 1, '06:08:00', 'Naats', 'Approved'),
(5, 4, 3, '2023-11-02', 1, '12:00:00', 'PCR', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `hospital_id` int(11) NOT NULL,
  `hospital_name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `approval_status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`hospital_id`, `hospital_name`, `location`, `password`, `approval_status`) VALUES
(1, 'Agha Khan', 'Karachi', '$2y$10$MpkQ97qiwEi36mTzuhipcO8j6Gilcu5.Fu7bA6ND3djFGg0rM3NNm', 'Approved'),
(2, 'Shamsi', 'Karachi', '$2y$10$PDQrI7tRhBdXkytG9arHpuYfbcQuabAOb05ZJOpKZG2X7gdrNHu1G', 'Rejected'),
(3, 'Mothercare', 'Islamabad', '$2y$10$TPGeWG9o5MtdjSkIV1T8QOwQxJ.2pS5UWrgAkl2yfr73iyWYJ9pO2', 'Approved'),
(4, 'Civil', 'Lahore', '$2y$10$27DI2Bvs9eCbe1LBu6xt4uLPlq9Zd5ha.wTmpSSt.bn.mBmdY47Yi', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL,
  `patient_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `patient_name`, `address`, `email`, `password`) VALUES
(1, 'Ayesha', 'Shamsi Society ', 'ayeshaafzal1573@gmail.com ', '$2y$10$mjCOLKl/RhACptOmCsbmN.wXXXLhwbeBEIeFReM1yDftdkBCzdaUi'),
(2, 'flappy', 'lakhani', 'flappy@gmail.com', '$2y$10$E6DcMD/eoEc6xxknBMOHrOHLTgHaOHKnpKZRGF2jcKMnkzhaIIOiu'),
(4, 'Arham', 'Dubai', 'arham@gmail.com', '$2y$10$EhcmvfrVmkyIupuN0OUoZuahYE0INdxBAPfDRCOQBTWvD3J99kmwm');

-- --------------------------------------------------------

--
-- Table structure for table `patient_vaccination_table`
--

CREATE TABLE `patient_vaccination_table` (
  `patient_vac_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `vac_id` int(11) NOT NULL,
  `vac_suggest` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_vaccination_table`
--

INSERT INTO `patient_vaccination_table` (`patient_vac_id`, `patient_id`, `vac_id`, `vac_suggest`) VALUES
(1, 1, 3, 'Booster'),
(4, 2, 3, 'Sinovac'),
(6, 4, 2, 'Novavax ');

-- --------------------------------------------------------

--
-- Table structure for table `vaccination`
--

CREATE TABLE `vaccination` (
  `vac_id` int(11) NOT NULL,
  `vac_name` varchar(255) NOT NULL,
  `hospital_id` int(11) DEFAULT NULL,
  `vac_status` enum('Available','Unavailable') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccination`
--

INSERT INTO `vaccination` (`vac_id`, `vac_name`, `hospital_id`, `vac_status`) VALUES
(1, 'Booster', 1, 'Available'),
(2, 'Novavax ', 3, 'Available'),
(3, 'Sinovac', 1, 'Available');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`app_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`hospital_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `patient_vaccination_table`
--
ALTER TABLE `patient_vaccination_table`
  ADD PRIMARY KEY (`patient_vac_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `vac_id` (`vac_id`);

--
-- Indexes for table `vaccination`
--
ALTER TABLE `vaccination`
  ADD PRIMARY KEY (`vac_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient_vaccination_table`
--
ALTER TABLE `patient_vaccination_table`
  MODIFY `patient_vac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vaccination`
--
ALTER TABLE `vaccination`
  MODIFY `vac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`hospital_id`);

--
-- Constraints for table `patient_vaccination_table`
--
ALTER TABLE `patient_vaccination_table`
  ADD CONSTRAINT `patient_vaccination_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `patient_vaccination_ibfk_2` FOREIGN KEY (`vac_id`) REFERENCES `vaccination` (`vac_id`);

--
-- Constraints for table `vaccination`
--
ALTER TABLE `vaccination`
  ADD CONSTRAINT `vaccination_ibfk_2` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`hospital_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
