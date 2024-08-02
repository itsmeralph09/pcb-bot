-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2024 at 10:48 AM
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
-- Database: `pcbbot_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `poll_tbl`
--

CREATE TABLE `poll_tbl` (
  `poll_id` int(11) NOT NULL,
  `poll_title` varchar(255) NOT NULL,
  `poll_description` varchar(255) NOT NULL,
  `poll_status` varchar(20) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poll_tbl`
--

INSERT INTO `poll_tbl` (`poll_id`, `poll_title`, `poll_description`, `poll_status`, `deleted`) VALUES
(1, 'Are you a robot?', 'Poll to verify if you\'re a human', 'CLOSED', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `suffix_name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `username`, `email`, `first_name`, `middle_name`, `last_name`, `suffix_name`, `designation`, `role`, `password`, `deleted`) VALUES
(1, 'admin', 'admin@pcb.edu.ph', 'ADMIN', 'IS', 'TRAITOR', 'N/A', 'ADMIN', 'ADMIN', 'admin', 0),
(2, 'ralph', 'ralphcustodio@pcb.edu.ph', 'RALPH', 'DOCUTIN', 'CUSTODIO', 'IV', 'INSTRUCTOR', 'USER', 'bbb', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `poll_tbl`
--
ALTER TABLE `poll_tbl`
  ADD PRIMARY KEY (`poll_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `poll_tbl`
--
ALTER TABLE `poll_tbl`
  MODIFY `poll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
