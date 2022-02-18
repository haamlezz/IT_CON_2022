-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 18, 2022 at 07:25 AM
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
-- Database: `IT_CON_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE `dept` (
  `dno` varchar(6) NOT NULL COMMENT 'ລະຫັດພະແນກ',
  `name` varchar(25) NOT NULL COMMENT 'ຊື່ພະແນກ',
  `loc` varchar(255) NOT NULL COMMENT 'ສະຖານທີ່',
  `incentive` decimal(7,0) NOT NULL COMMENT 'ເງິນອຸດໜູນ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`dno`, `name`, `loc`, `incentive`) VALUES
('HR', 'Human Resource', 'Phonpapao', '100000'),
('MAK', 'ການຕະຫຼາດ', 'ວຽງຈັນ', '11111');

-- --------------------------------------------------------

--
-- Table structure for table `emp`
--

CREATE TABLE `emp` (
  `empno` varchar(6) NOT NULL COMMENT 'ລະຫັດພະນັກງານ',
  `name` varchar(25) NOT NULL COMMENT 'ຊື່ພະນັກງານ',
  `gender` varchar(1) NOT NULL COMMENT 'ເພດ',
  `dateOfBirth` date NOT NULL COMMENT 'ວັນ ເດືອນ ປີເກີດ',
  `address` varchar(255) NOT NULL COMMENT 'ທີ່ຢູ່',
  `incentive` decimal(7,0) DEFAULT NULL COMMENT 'ເງິນອຸດໜູນ',
  `language` varchar(255) DEFAULT NULL COMMENT 'ພາສາ',
  `picture` varchar(255) NOT NULL COMMENT 'ຮູບພະນັກງານ',
  `grade` int(3) DEFAULT NULL COMMENT 'ຂັ້ນເງິນເດືອນ salary(grade)',
  `dno` varchar(6) NOT NULL COMMENT 'ລະຫັດພະແນກ dept(dno)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp`
--

INSERT INTO `emp` (`empno`, `name`, `gender`, `dateOfBirth`, `address`, `incentive`, `language`, `picture`, `grade`, `dno`) VALUES
('007', 'dfdf', 'F', '2022-02-18', 'dfdfd', '33333', 'ລາວ,ອັງກິດ,ຈີນ,ຫວຽດນາມ', 'image/20220217icons8-volvo-24.png', 2, 'HR'),
('3333', 'ສົມປະສົງ ວົງຖາວອນ', 'M', '2022-02-10', ' 3333', '333333', 'ອັງກິດ', 'image/20220217Untitled-1.jpg', 2, 'MAK'),
('555', 'fdd', 'F', '2022-02-16', 'dfdf', '334343', 'ລາວ,ອັງກິດ', 'image/2022027web.jpg', 2, 'MAK');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `grade` int(3) NOT NULL COMMENT 'ຂັ້ນເງິນເດືອນ',
  `sal` decimal(7,0) NOT NULL COMMENT 'ເງິນເດືອນ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`grade`, `sal`) VALUES
(2, '1000000');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `tel` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `tel`, `username`, `password`) VALUES
(1, 'song', '1111', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'sososo', '3333', 'admin1', 'spsvtv'),
(6, 'song', '4444', 'admin2', '3123df3ee8ffa1f13bed69b18090a777'),
(7, 'song', '5555', 'admin3', '3123df3ee8ffa1f13bed69b18090a777');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dept`
--
ALTER TABLE `dept`
  ADD PRIMARY KEY (`dno`);

--
-- Indexes for table `emp`
--
ALTER TABLE `emp`
  ADD PRIMARY KEY (`empno`),
  ADD KEY `dno` (`dno`),
  ADD KEY `grade` (`grade`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`grade`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `grade` int(3) NOT NULL AUTO_INCREMENT COMMENT 'ຂັ້ນເງິນເດືອນ', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `emp`
--
ALTER TABLE `emp`
  ADD CONSTRAINT `emp_ibfk_1` FOREIGN KEY (`dno`) REFERENCES `dept` (`dno`),
  ADD CONSTRAINT `emp_ibfk_2` FOREIGN KEY (`grade`) REFERENCES `salary` (`grade`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
