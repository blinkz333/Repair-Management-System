-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2020 at 05:47 PM
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
  `Mem_Permission` int(11) NOT NULL COMMENT '1 = ใช้งาน 2 = ยกเลิก',
  `Mem_Status` int(11) NOT NULL COMMENT '1 = admin 2 = user'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`Mem_ID`, `Mem_User`, `Mem_Pass`, `Mem_Name`, `Mem_Email`, `Mem_Tel`, `Mem_Address`, `Mem_Date`, `Mem_Permission`, `Mem_Status`) VALUES
(1, 'admin', '1234', 'administrator', 'admin@mail.com', '', '', '2017-03-11', 1, 1),
(5, 'member', '1234', 'member1', 'member@mail.com', '0111111111', 'Dev Address', '2017-03-19', 1, 2);

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
(1, '110220213258', 'สมชาย หงายผึง', '1150', 'devAddress', 'กรุงเทพ', '10400', 'คอมพิวเตอร์', 'LENOVO L7', 'แรมหลวม', '2020-02-16', '2020-02-19', 50, 'แรมหลวม ขัดเอา', 'ช่างป้อม', 7);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `Odd_ID` int(11) NOT NULL,
  `Ord_ID` int(11) NOT NULL,
  `Pro_ID` int(11) NOT NULL,
  `Odd_Amount` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`Odd_ID`, `Ord_ID`, `Pro_ID`, `Odd_Amount`) VALUES
(1, 1, 8, 1),
(2, 2, 8, 1),
(3, 2, 4, 1),
(4, 3, 6, 1),
(5, 3, 8, 1),
(6, 3, 4, 1),
(7, 4, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Pay_ID` int(11) NOT NULL,
  `Ord_ID` int(11) NOT NULL,
  `Pay_Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Pay_Tel` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Pay_File` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Pay_Price` double(9,2) NOT NULL,
  `Pay_Bank` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Pay_Detail` text COLLATE utf8_unicode_ci NOT NULL,
  `Pay_Date` date NOT NULL,
  `Pay_Time` time NOT NULL,
  `Pay_Status` int(11) NOT NULL COMMENT '0 = ตรวจสอบ1 = ชำระเรียบร้อย'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Pay_ID`, `Ord_ID`, `Pay_Name`, `Pay_Tel`, `Pay_File`, `Pay_Price`, `Pay_Bank`, `Pay_Detail`, `Pay_Date`, `Pay_Time`, `Pay_Status`) VALUES
(2, 1, 'aa bb ', '0814567899', '110220_215259.jpg', 100.00, 'กรุงเทพ', '', '2020-02-11', '23:59:00', 1),
(3, 2, 'aa bb ', '0814567899', '110220_234839.JPG', 340.00, 'ไทยพาณิชย์', 'dev', '2013-12-23', '23:59:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Pro_ID` int(6) UNSIGNED ZEROFILL NOT NULL,
  `Pro_Img` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Pro_Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Pro_Detail` text COLLATE utf8_unicode_ci NOT NULL,
  `Pro_Price` double(7,2) NOT NULL,
  `Pro_Amount` int(11) NOT NULL,
  `Pro_Buy` int(11) NOT NULL,
  `Pro_Promotion` int(2) NOT NULL COMMENT 'ถ้าเป็น 0 คือไม่อยู่ในโปรโมชั่น / 1 คือจัดโปรโมชั่น',
  `Pro_SaleType` int(2) NOT NULL COMMENT '0 = ขายปลีก , 1=ขายส่ง',
  `Pro_Date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Pro_ID`, `Pro_Img`, `Pro_Name`, `Pro_Detail`, `Pro_Price`, `Pro_Amount`, `Pro_Buy`, `Pro_Promotion`, `Pro_SaleType`, `Pro_Date`) VALUES
(000002, '140220_201330.jpg', 'เสื้อสีเทา', 'เสื้อสีเทา งานแฮนด์เใด', 850.00, 99, 1, 0, 0, '2018-09-09'),
(000003, '140220_201415.jpg', 'เสื้อสีชมพู', 'เสื้อสีชมพู', 230.00, 99, 0, 0, 0, '2018-09-09'),
(000004, '140220_201438.jpg', 'เสื้อลาย', 'เสื้อลาย', 210.00, 99, 1, 0, 0, '2018-09-09'),
(000005, '140220_201501.jpg', 'เสื้อสีเหลือง', 'เสื้อสีเหลือง', 190.00, 99, 0, 0, 0, '2018-09-09'),
(000008, '110220_213207.jpg', 'เป็ด', 'เป็ดน้อย', 50.00, 98, 2, 0, 1, '2020-02-11'),
(000009, '160220_185856.jpg', 'ประวิตร', 'ประวิตรน้อย', 20.00, 99, 0, 1, 1, '2020-02-16'),
(000010, '160220_190154.jpg', 'ลุงโทนี่', 'ลุงโทนี่', 999.00, 99, 0, 1, 0, '2020-02-16'),
(000011, '160220_190227.jpg', 'หนูรัตน์', 'หนูรัตน์', 10.00, 999, 0, 1, 1, '2020-02-16');

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
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`Odd_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Pay_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Pro_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `Mem_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Ord_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `Odd_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Pay_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Pro_ID` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
