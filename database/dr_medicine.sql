-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 03, 2025 at 10:58 AM
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
-- Database: `dr_medicine`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_mobile` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(512) NOT NULL,
  `admin_status` tinyint(4) NOT NULL DEFAULT 1,
  `admin_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_mobile`, `admin_email`, `admin_password`, `admin_status`, `admin_created`) VALUES
(1, 'Dr.Sanjeev', '8827263881', 'rj@gmail.com', '$2y$10$1LkY3/1OZ0sDhxrmEmYuP.8kjcJnFDXz9tU0kJIvc.xch1KSYnFym', 1, '2025-08-27 06:35:03');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_master`
--

CREATE TABLE `medicine_master` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine_master`
--

INSERT INTO `medicine_master` (`id`, `name`, `price`, `status`, `created_at`) VALUES
(1, 'Paracetamol', 70, 1, '2025-10-01 07:49:23'),
(2, 'Cough Syrup', 25, 1, '2025-10-01 07:49:23'),
(3, 'Vitamin D', 0, 1, '2025-10-01 07:49:23'),
(4, 'Insulin Injection', 50, 1, '2025-10-01 07:49:23'),
(5, 'Bandage', 12, 1, '2025-10-01 07:49:23'),
(6, 'Parcita mol', 40, 1, '2025-10-01 12:07:10'),
(7, 'Parcita mol', 0, 1, '2025-10-01 12:07:22'),
(8, 'Vetom', 0, 1, '2025-10-01 15:35:04');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_stock`
--

CREATE TABLE `medicine_stock` (
  `id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine_stock`
--

INSERT INTO `medicine_stock` (`id`, `medicine_id`, `quantity`, `created_at`) VALUES
(1, 1, 5, '2025-10-02 22:30:57'),
(2, 2, 4, '2025-10-02 22:30:57'),
(3, 4, 4, '2025-10-02 22:30:57'),
(4, 5, 41, '2025-10-02 22:30:57'),
(5, 2, -2, '2025-10-02 17:04:39'),
(6, 2, -2, '2025-10-02 17:05:03'),
(7, 2, 10, '2025-10-03 11:20:06'),
(8, 2, -3, '2025-10-03 05:50:20'),
(9, 5, -10, '2025-10-03 22:30:57'),
(10, 5, 5, '2025-10-03 22:30:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `medicine_master`
--
ALTER TABLE `medicine_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_stock`
--
ALTER TABLE `medicine_stock`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medicine_master`
--
ALTER TABLE `medicine_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `medicine_stock`
--
ALTER TABLE `medicine_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
