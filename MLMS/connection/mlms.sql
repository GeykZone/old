-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2022 at 07:53 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mlms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Name` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Name`, `Password`) VALUES
('Admin', '$2y$10$hQBQzl6g84qbZ70lotoPw.PbpR6ggvtXE3TBuSu1ySSxM/WGKjM6O');

-- --------------------------------------------------------

--
-- Table structure for table `approved`
--

CREATE TABLE `approved` (
  `phone` decimal(65,0) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `salary` varchar(100) DEFAULT NULL,
  `loanAmount` decimal(65,0) DEFAULT NULL,
  `bank` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `dueDate` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `payable` decimal(65,0) DEFAULT NULL,
  `paidamount` decimal(65,0) DEFAULT NULL,
  `applicationdate` varchar(100) DEFAULT NULL,
  `currentdate` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `loanhistory`
--

CREATE TABLE `loanhistory` (
  `phone` decimal(65,0) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `salary` varchar(100) DEFAULT NULL,
  `loanAmount` decimal(65,0) DEFAULT NULL,
  `bank` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `dueDate` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `payable` decimal(65,0) DEFAULT NULL,
  `paidamount` decimal(65,0) DEFAULT NULL,
  `applicationdate` varchar(100) DEFAULT NULL,
  `currentdate` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loanhistory`
--

INSERT INTO `loanhistory` (`phone`, `name`, `job`, `salary`, `loanAmount`, `bank`, `description`, `date`, `dueDate`, `status`, `payable`, `paidamount`, `applicationdate`, `currentdate`) VALUES
('9276003238', 'Geykson', 'Panday ug Balay', '100K+ Monthly', '9000', 'PNB', 'Testing 20', 'Pending', 'Pending', 'Pending', '0', '0', '3/19/2022, 2:32:15 PM', '  3/19/2022, 2:32:15 PM ');

-- --------------------------------------------------------

--
-- Table structure for table `paid`
--

CREATE TABLE `paid` (
  `phone` decimal(65,0) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `salary` varchar(100) DEFAULT NULL,
  `loanAmount` decimal(65,0) DEFAULT NULL,
  `bank` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `dueDate` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `payable` decimal(65,0) DEFAULT NULL,
  `paidamount` decimal(65,0) DEFAULT NULL,
  `applicationdate` varchar(100) DEFAULT NULL,
  `currentdate` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pending`
--

CREATE TABLE `pending` (
  `phone` decimal(65,0) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `salary` varchar(100) DEFAULT NULL,
  `loanAmount` decimal(65,0) DEFAULT NULL,
  `bank` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `dueDate` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `payable` decimal(65,0) DEFAULT NULL,
  `paidamount` decimal(65,0) DEFAULT NULL,
  `applicationdate` varchar(100) DEFAULT NULL,
  `currentdate` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pending`
--

INSERT INTO `pending` (`phone`, `name`, `job`, `salary`, `loanAmount`, `bank`, `description`, `date`, `dueDate`, `status`, `payable`, `paidamount`, `applicationdate`, `currentdate`) VALUES
('9276003238', 'Geykson', 'Panday ug Balay', '100K+ Monthly', '9000', 'PNB', 'Testing 20', 'Pending', 'Pending', 'Pending', '0', '0', '3/19/2022, 2:32:15 PM', '  3/19/2022, 2:32:15 PM ');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `phonenumber` decimal(65,0) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `age` int(100) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `salary` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`phonenumber`, `fullname`, `age`, `job`, `salary`, `password`) VALUES
('9276003238', 'Geykson', 21, 'Panday ug Balay', '100K+ Monthly', '$2y$10$VZGTvkR2HQS7jVzAq9i0L.PMqbOYHh/7Z1u6gdcbmVvWXO9Mft9ki');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approved`
--
ALTER TABLE `approved`
  ADD PRIMARY KEY (`phone`);

--
-- Indexes for table `pending`
--
ALTER TABLE `pending`
  ADD PRIMARY KEY (`phone`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`phonenumber`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
