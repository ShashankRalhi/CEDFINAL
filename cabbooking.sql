-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 05, 2020 at 03:23 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cabbooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `distance` varchar(50) NOT NULL,
  `is_available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`id`, `name`, `distance`, `is_available`) VALUES
(64, 'IndiraNagar', '10', 2),
(70, 'Gorakpur', '210', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ride`
--

CREATE TABLE `tbl_ride` (
  `ride_id` int(11) NOT NULL,
  `ride_date` varchar(50) NOT NULL,
  `pickup_point` varchar(50) NOT NULL,
  `drop_point` varchar(50) NOT NULL,
  `cab_type` varchar(50) NOT NULL,
  `total_distance` varchar(50) NOT NULL,
  `total_cost` varchar(50) NOT NULL,
  `luggage` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `customer_user_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_ride`
--

INSERT INTO `tbl_ride` (`ride_id`, `ride_date`, `pickup_point`, `drop_point`, `cab_type`, `total_distance`, `total_cost`, `luggage`, `status`, `customer_user_name`) VALUES
(331, '2020-12-05 12:19:30', 'Charbagh', 'IndiraNagar', 'CedMicro', '10', '185', '0', 1, 'vaibhav'),
(332, '2020-12-05 12:19:45', 'Charbagh', 'Barabanki', 'CedMini', '60', '1145', '90', 1, 'vaibhav'),
(333, '2020-12-05 12:20:36', 'Faizabad', 'Barabanki', 'CedMicro', '40', '545', '0', 1, 'vaibhav'),
(334, '2020-12-05 17:29:02', 'Charbagh', 'Indira Nagar', 'CedRoyal', '0', '400', '1010', 1, 'vaibhav'),
(335, '2020-12-05 17:29:40', 'IndiraNagar', 'Barabanki', 'CedMini', '50', '1015', '1010', 1, 'vaibhav'),
(336, '2020-12-05 17:42:53', 'Barabanki', 'Faizabad', 'CedMicro', '40', '545', '0', 0, 'vaibhav'),
(337, '2020-12-05 17:45:31', 'IndiraNagar', 'Charbagh', 'CedMicro', '10', '185', '0', 0, 'vaibhav');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `dateofsignup` varchar(255) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `isblock` int(1) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `dateofsignup`, `mobile`, `isblock`, `password`) VALUES
(1048, 'vaibhav', '2020-12-05 14:53:26', '7686578656', 1, '81dc9bdb52d04dc20036dbd8313ed055'),
(1050, 'shashank', '2020-12-05 19:29:37', '5555555555', 1, '698d51a19d8a121ce581499d7b701668');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  ADD PRIMARY KEY (`ride_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  MODIFY `ride_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=339;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1052;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
