-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2023 at 08:54 PM
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
(20, 'Admin', 'admin@gmail.com', 'admin'),
(21, 'aaq', 'aaq@gmail.com ', 'aaq123'),
(22, 'flappy', 'flappy@gmail.com ', 'flappy'),
(23, 'admin', 'admin@gmail.com ', 'admim');

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
(4, 8, 2, '2023-01-31', 1, '01:00:00', 'Naats', 'Rejected'),
(5, 9, 1, '2023-09-20', 1, '17:12:00', 'PCR', 'Approved'),
(6, 8, 2, '2023-09-27', 1, '23:04:00', 'Naats', 'Approved'),
(7, 9, 1, '2023-09-26', 1, '05:17:00', 'PCR', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `covid_test`
--

CREATE TABLE `covid_test` (
  `test_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `hospital_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `hospital_id` int(11) NOT NULL,
  `hospital_name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `approval_status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`hospital_id`, `hospital_name`, `location`, `password`, `status`, `approval_status`) VALUES
(1, 'aghakhan', 'Karachi', 'aghakhan', 1, 'Approved'),
(2, 'mothercare', 'Karachi', 'mothercare', 0, 'Rejected'),
(3, 'liaquat', 'Karachi', 'liaquat', 1, 'Rejected');

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
(8, 'aisha', 'shamsi', 'aisha@gmail.com', 'aisha'),
(9, 'sunaina', 'lakhani', 'sunaina@gmail.com', 'sunaina');

-- --------------------------------------------------------

--
-- Table structure for table `patient_hospital`
--

CREATE TABLE `patient_hospital` (
  `patienthospital_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `hospital_id` int(11) DEFAULT NULL,
  `result` enum('Approved','Reject') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `test_result` varchar(50) DEFAULT NULL,
  `vac_suggest` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vaccination`
--

CREATE TABLE `vaccination` (
  `vac_id` int(11) NOT NULL,
  `vac_name` varchar(255) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `hospital_id` int(11) DEFAULT NULL,
  `vac_status` enum('Available','Unavailable') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccination`
--

INSERT INTO `vaccination` (`vac_id`, `vac_name`, `patient_id`, `hospital_id`, `vac_status`) VALUES
(4, 'pi fizar', NULL, 1, 'Unavailable');

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
-- Indexes for table `covid_test`
--
ALTER TABLE `covid_test`
  ADD PRIMARY KEY (`test_id`),
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
-- Indexes for table `patient_hospital`
--
ALTER TABLE `patient_hospital`
  ADD PRIMARY KEY (`patienthospital_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `vaccination`
--
ALTER TABLE `vaccination`
  ADD PRIMARY KEY (`vac_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `covid_test`
--
ALTER TABLE `covid_test`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `patient_hospital`
--
ALTER TABLE `patient_hospital`
  MODIFY `patienthospital_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vaccination`
--
ALTER TABLE `vaccination`
  MODIFY `vac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Constraints for table `covid_test`
--
ALTER TABLE `covid_test`
  ADD CONSTRAINT `covid_test_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `covid_test_ibfk_2` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`hospital_id`);

--
-- Constraints for table `patient_hospital`
--
ALTER TABLE `patient_hospital`
  ADD CONSTRAINT `patient_hospital_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `patient_hospital_ibfk_2` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`hospital_id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `covid_test` (`test_id`);

--
-- Constraints for table `vaccination`
--
ALTER TABLE `vaccination`
  ADD CONSTRAINT `vaccination_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `vaccination_ibfk_2` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`hospital_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
