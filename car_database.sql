-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 18, 2023 at 06:54 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DAI Coursework`
--

-- --------------------------------------------------------

--
-- Table structure for table `Car`
--

CREATE TABLE `Car` (
  `car_model_id` varchar(30) NOT NULL,
  `car_type_id` varchar(30) NOT NULL,
  `car_name` varchar(100) NOT NULL,
  `car_colour` varchar(30) NOT NULL,
  `price_per_day` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Car`
--

INSERT INTO `Car` (`car_model_id`, `car_type_id`, `car_name`, `car_colour`, `price_per_day`) VALUES
('BCFS', 'LUX', 'Bentley Continental Flying Spur', 'White', 4800),
('FF430S', 'SPRTS', 'Ferrari F430 Scuderia', 'Red', 6000),
('JAGS', 'LUX', 'Jaguar S Type', 'Champagne', 1350),
('JMK2', 'CLCS', 'Jaguar MK 2', 'White', 2200),
('LMLP640', 'SPRTS', 'Lamborghini Murcielago LP640', 'Matte Black', 7000),
('LSC430', 'SPRTS', 'Lexus SC430', 'Black', 1600),
('MBCLS350', 'LUX', 'Mercedes Benz CLS 350', 'Silver', 1350),
('MGTD', 'CLCS', 'MG TD', 'Red', 2500),
('PB', 'SPRTS', 'Porsche Boxster', 'White', 2800),
('RRP', 'LUX', 'Rolls Royce Phantom', 'Blue', 9800),
('RRSSL', 'CLCS', 'Rolls Royce Silver Spirit Limousine', 'Georgian Silver', 3200);

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `customer_name` varchar(100) NOT NULL,
  `customer_id_number` bigint(30) NOT NULL,
  `customer_number` varchar(30) NOT NULL,
  `reservation_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`customer_name`, `customer_id_number`, `customer_number`, `reservation_id`) VALUES
('Shen Fung', 38234329408, '0129438201', 'SPRTS2331'),
('Jacob', 43289203948, '0128932482', 'SPRTS1727'),
('Kobe', 213912409024, '0123456799', 'SPRTS76272'),
('Bryant', 213912409032, '0123346799', 'SPRTS61660'),
('Farah', 348234823045, '0123498129', 'LUX4567'),
('Wesley', 743299213995, '0123443088', 'CLCS9984'),
('Ponita', 802345981324, '0123943289', 'LUX59608'),
('Ethan', 824192383571, '0123849353', 'LUX2644'),
('Mark', 902845902834, '0123813548', 'LUX8311'),
('Jeff', 983724987219, '0123988458', 'SPRTS2405');

-- --------------------------------------------------------

--
-- Table structure for table `Customer Enquiry`
--

CREATE TABLE `Customer Enquiry` (
  `customer_number` varchar(30) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(30) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Reservation`
--

CREATE TABLE `Reservation` (
  `reservation_id` varchar(100) NOT NULL,
  `staff_id` varchar(20) DEFAULT NULL,
  `car_model_id` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Reservation`
--

INSERT INTO `Reservation` (`reservation_id`, `staff_id`, `car_model_id`, `start_date`, `end_date`) VALUES
('CLCS9984', '662868361', 'JMK2', '2023-04-20', '2023-04-21'),
('LUX2644', '662868361', 'BCFS', '2023-04-22', '2023-04-23'),
('LUX4567', '662868361', 'BCFS', '2023-04-04', '2023-04-05'),
('LUX59608', '662868361', 'BCFS', '2023-04-20', '2023-04-21'),
('LUX8311', '662868361', 'BCFS', '2023-04-28', '2023-04-29'),
('SPRTS1727', '662868361', 'LSC430', '2023-04-30', '2023-05-01'),
('SPRTS2331', '662868361', 'FF430S', '2023-04-17', '2023-04-18'),
('SPRTS2405', '662868361', 'FF430S', '2023-04-13', '2023-04-17'),
('SPRTS61660', '662868361', 'FF430S', '2023-04-09', '2023-04-11'),
('SPRTS76272', '662868361', 'FF430S', '2023-04-06', '2023-04-08');

-- --------------------------------------------------------

--
-- Table structure for table `Staff`
--

CREATE TABLE `Staff` (
  `id` bigint(20) NOT NULL,
  `staff_id` varchar(20) NOT NULL,
  `staff_name` varchar(30) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Staff`
--

INSERT INTO `Staff` (`id`, `staff_id`, `staff_name`, `user_name`, `password`, `date_created`) VALUES
(4, '662868361', 'Jane', 'Jane123', '1234', '2023-03-16 13:30:04'),
(6, 'ST3963', 'sf', 'sf', 'shenfung', '2023-04-04 08:49:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Car`
--
ALTER TABLE `Car`
  ADD PRIMARY KEY (`car_model_id`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`customer_id_number`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- Indexes for table `Customer Enquiry`
--
ALTER TABLE `Customer Enquiry`
  ADD PRIMARY KEY (`customer_number`);

--
-- Indexes for table `Reservation`
--
ALTER TABLE `Reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `car_model_id` (`car_model_id`);

--
-- Indexes for table `Staff`
--
ALTER TABLE `Staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Staff`
--
ALTER TABLE `Staff`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Customer`
--
ALTER TABLE `Customer`
  ADD CONSTRAINT `reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `Reservation` (`reservation_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `Reservation`
--
ALTER TABLE `Reservation`
  ADD CONSTRAINT `car_model_id` FOREIGN KEY (`car_model_id`) REFERENCES `Car` (`car_model_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_id` FOREIGN KEY (`staff_id`) REFERENCES `Staff` (`staff_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
