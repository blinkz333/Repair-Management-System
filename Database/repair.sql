-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2020 at 05:48 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `repair`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `Mem_ID` int(11) NOT NULL,
  `Mem_User` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Mem_Pass` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Mem_Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Mem_Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Mem_Tel` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Mem_Address` text COLLATE utf8_unicode_ci NOT NULL,
  `Mem_Date` date NOT NULL,
  `Mem_Permission` int(11) NOT NULL COMMENT '0 = ยกเลิก 1 = ใช้งาน',
  `Mem_Status` int(11) NOT NULL COMMENT '1 = admin'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`Mem_ID`, `Mem_User`, `Mem_Pass`, `Mem_Name`, `Mem_Email`, `Mem_Tel`, `Mem_Address`, `Mem_Date`, `Mem_Permission`, `Mem_Status`) VALUES
(1, 'admin', '1234', 'administrator', 'admin@mail.com', '9999', 'admin', '2017-03-11', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Ord_ID` int(11) NOT NULL,
  `Ord_Number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Ord_CustomerName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Ord_CustomerTel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Ord_CustomerAddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Ord_CustomerProvince` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Ord_CustomerAddressCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Ord_RepairModel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Ord_RepairModelID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Ord_RepairDescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Ord_RepairDate` date NOT NULL,
  `Ord_RepairSuccess` date NOT NULL,
  `Ord_RepairPrice` int(255) NOT NULL,
  `Ord_RepairRemark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Ord_RepairPerson` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Ord_RepairStatus` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Ord_ID`, `Ord_Number`, `Ord_CustomerName`, `Ord_CustomerTel`, `Ord_CustomerAddress`, `Ord_CustomerProvince`, `Ord_CustomerAddressCode`, `Ord_RepairModel`, `Ord_RepairModelID`, `Ord_RepairDescription`, `Ord_RepairDate`, `Ord_RepairSuccess`, `Ord_RepairPrice`, `Ord_RepairRemark`, `Ord_RepairPerson`, `Ord_RepairStatus`) VALUES
(1, '110220213258', 'สมชาย หงายผึง', '1112', 'devAddress', 'กรุงเทพ', '10400', 'คอมพิวเตอร์', 'LENOVO L7', 'แรมหลวม', '2020-02-16', '2020-02-19', 50, 'แรมหลวม ขัดเอา', 'ช่างป้อม', 7),
(8, '170220194019', 'test', '1150', 'test', 'test', '10000', 'test', 'test', 'test', '2020-03-17', '2020-03-18', 20, 'dev', 'dev', 4),
(9, '170220234220', 'testGraph', '222', 'testGraph', 'testGraph', '1000', 'testGraph', 'testGraph', 'testGraph', '2020-02-17', '2020-02-19', 20, 'testGraph', 'testGraph', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`Mem_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Ord_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `Mem_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Ord_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
