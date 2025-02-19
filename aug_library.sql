-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2025 at 10:44 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `august`
--

-- --------------------------------------------------------

--
-- Table structure for table `aug_library`
--

CREATE TABLE `aug_library` (
  `id` int(11) NOT NULL,
  `Title` text NOT NULL,
  `ISBN` text NOT NULL,
  `Author` text NOT NULL,
  `Publisher` text NOT NULL,
  `Year_Published` int(11) NOT NULL,
  `Category` text NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aug_library`
--

INSERT INTO `aug_library` (`id`, `Title`, `ISBN`, `Author`, `Publisher`, `Year_Published`, `Category`, `Timestamp`) VALUES
(2, 'Super', '142152', 'Master', 'Master Inc.', 1735660800, 'Heroes Test', '2025-02-19 09:05:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aug_library`
--
ALTER TABLE `aug_library`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aug_library`
--
ALTER TABLE `aug_library`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
