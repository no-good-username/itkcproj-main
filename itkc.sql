-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2024 at 12:17 PM
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
-- Database: `itkc`
--

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(11) NOT NULL,
  `school_name` varchar(255) DEFAULT NULL,
  `principal_name` varchar(255) DEFAULT NULL,
  `contact_info` varchar(255) DEFAULT NULL,
  `cares_scheme` tinyint(1) DEFAULT NULL,
  `principal_phone` varchar(50) DEFAULT NULL,
  `total_students` int(11) DEFAULT NULL,
  `total_systems` int(11) DEFAULT NULL,
  `system_os` varchar(255) DEFAULT NULL,
  `system_manufacturer` varchar(255) DEFAULT NULL,
  `ethernet_connection` tinyint(1) DEFAULT NULL,
  `internet_connection` varchar(50) DEFAULT NULL,
  `online_assessments` tinyint(1) DEFAULT NULL,
  `internal_storage` varchar(50) DEFAULT NULL,
  `processor` varchar(50) DEFAULT NULL,
  `ram` varchar(50) DEFAULT NULL,
  `applications` varchar(255) DEFAULT NULL,
  `other_apps` text DEFAULT NULL,
  `lecture_timings` varchar(255) DEFAULT NULL,
  `lab_timings` varchar(255) DEFAULT NULL,
  `transportation_issues` text DEFAULT NULL,
  `surrounding_environment` text DEFAULT NULL,
  `environment_cleanliness` tinyint(1) DEFAULT NULL,
  `parking_space` varchar(50) DEFAULT NULL,
  `residential_areas` text DEFAULT NULL,
  `shortcomings` text DEFAULT NULL,
  `lab_picture` varchar(255) DEFAULT NULL,
  `environment_picture` varchar(255) DEFAULT NULL,
  `school_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
