-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3325
-- Generation Time: Feb 12, 2022 at 06:37 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotel_data`
--

CREATE TABLE `hotel_data` (
  `Sno.` int(5) NOT NULL,
  `Visitor_name` varchar(20) NOT NULL,
  `Contact_number` text NOT NULL,
  `Email_id` varchar(50) NOT NULL,
  `Room_no` int(11) NOT NULL,
  `category` text NOT NULL,
  `no_of_beds` text NOT NULL,
  `Arrival_date` date NOT NULL,
  `Departure_date` date NOT NULL,
  `advance_payment` int(30) NOT NULL,
  `Rent` text NOT NULL,
  `Room_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotel_data`
--

INSERT INTO `hotel_data` (`Sno.`, `Visitor_name`, `Contact_number`, `Email_id`, `Room_no`, `category`, `no_of_beds`, `Arrival_date`, `Departure_date`, `advance_payment`, `Rent`, `Room_status`) VALUES
(55, 'konika', '4453354654', 'konika@gmail.com', 1, '', '', '2001-12-03', '2001-12-04', 0, '500', 'vacant'),
(56, 'puneeta', '4443365', 'puneeta@gmail.com', 2, '', '', '2001-12-09', '2001-12-03', 0, '5000', 'vacant'),
(57, 'anaya', '34435353', 'anaya@gmail.com', 3, '', '', '2001-12-10', '2001-12-09', 0, '500', 'vacant'),
(59, 'ram', '2323433434', 'ram@gmail.com', 5, '', '', '2001-12-12', '2001-12-11', 0, '780', 'vacant'),
(60, 'sham', '443243244', 'sham@gmail.com', 10, '', '', '2001-12-05', '2001-12-04', 0, '500', 'vacant'),
(62, 'raman', '213243534', 'raman@gmail.com', 10, '', '', '2001-12-12', '2001-12-12', 0, '230', 'vacant'),
(63, 'konika', '3343465464', 'konika@gmail.com', 2, 'Deluxe', '4', '2001-12-03', '2001-12-12', 0, '2500', 'vacant'),
(64, 'konika', '34534356', 'fdgfgfth@gmail.com', 16, 'Double', '2', '2001-12-13', '2001-12-12', 0, '2000', 'vacant'),
(66, 'pari', '78373247934', 'pari@gmail.com', 18, 'Queen', '2', '2022-02-12', '2022-03-12', 0, '2500', 'booked'),
(67, 'konika', '34546546', 'konika@gmail.com', 14, 'Queen', '3', '2022-02-12', '2022-02-15', 0, '2500', 'booked'),
(68, 'anaya', '22131893', 'anaya@gmail.com', 13, 'Deluxe', '4', '2022-02-12', '2022-02-13', 0, '4500', 'booked'),
(69, 'name', 'contact_number', 'email@gmail.com', 17, 'Single', '1', '2021-02-12', '0000-00-00', 0, '1000', 'booked'),
(70, 'name', 'contact_number', 'email@gmail.com', 16, 'Double', '2', '2022-02-12', '2022-02-13', 0, '2000', 'vacant'),
(72, 'efrgdrgd', '4354564', 'konikajindal1783@gmail.com', 0, '$category', '$no_of_beds', '2022-02-12', '2022-02-13', 545, '4500', 'booked');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `sno` int(10) NOT NULL,
  `room_no` int(11) NOT NULL,
  `category` text NOT NULL,
  `no_of_beds` int(30) NOT NULL,
  `price` int(30) NOT NULL,
  `Status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`sno`, `room_no`, `category`, `no_of_beds`, `price`, `Status`) VALUES
(24, 6, 'Double', 2, 2000, 'vacant'),
(25, 7, 'Deluxe', 4, 4500, 'vacant'),
(26, 8, 'Single', 1, 1000, 'vacant'),
(27, 9, 'Double', 2, 2000, 'vacant'),
(29, 11, 'King', 3, 2500, 'vacant'),
(30, 12, 'Queen', 3, 2500, 'vacant'),
(33, 15, 'Single', 1, 1000, 'vacant'),
(38, 20, 'Queen', 2, 2500, 'vacant'),
(40, 1, 'Queen', 2, 2500, 'vacant'),
(42, 21, 'Deluxe', 4, 4500, 'vacant'),
(43, 19, 'Deluxe', 4, 4500, 'vacant'),
(45, 22, 'Deluxe', 4, 4500, 'vacant'),
(46, 3, 'King', 3, 2000, 'vacant'),
(47, 5, 'Deluxe', 4, 4500, 'vacant'),
(48, 10, 'Single', 1, 1000, 'vacant'),
(49, 2, 'Deluxe', 4, 2500, 'vacant'),
(51, 4, 'Deluxe', 4, 4500, 'vacant'),
(53, 23, 'Double', 2, 2000, 'vacant'),
(54, 24, 'Deluxe', 4, 4500, 'vacant'),
(55, 13, 'Deluxe', 4, 4500, 'vacant'),
(56, 14, 'Queen', 3, 2500, 'vacant'),
(57, 16, 'Double', 2, 2000, 'vacant');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `sno` int(80) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`sno`, `username`, `password`, `dt`) VALUES
(1, 'konikajindal71@gmail.com', 'konika', '2022-01-23 19:44:59'),
(2, 'puneeta23@gmail.com', 'puneeta', '2022-01-28 11:53:59'),
(3, 'konikaj', '$2y$10$fI8nOXuUfvMlSvPNUVgp8e7PvI2jLRFEz1qd8l.dxKkEAgrzqOWzK', '2022-02-02 10:19:07'),
(4, 'ram', '$2y$10$QiHFL3QFtG55hFRCU6jf/u6IC1HCiP72uiKH1O4MVUhx/QmHkKeNK', '2022-02-08 16:48:53'),
(5, '', '$2y$10$4h7DJ342okI9t1WSduj8HuEQr.MNyqf7ulxEbMbjh04.NsG1GiE.W', '2022-02-09 09:29:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotel_data`
--
ALTER TABLE `hotel_data`
  ADD PRIMARY KEY (`Sno.`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotel_data`
--
ALTER TABLE `hotel_data`
  MODIFY `Sno.` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `sno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sno` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
