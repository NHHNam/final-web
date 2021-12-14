-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 14, 2021 at 04:46 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlynhanvien`
--

-- --------------------------------------------------------

--
-- Table structure for table `giamdoc`
--

CREATE TABLE `giamdoc` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `giamdoc`
--

INSERT INTO `giamdoc` (`id`, `name`, `username`, `password`, `image`) VALUES
(1, 'Giam doc', 'admin', 'admin', 'images/admin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `maPB` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`id`, `name`, `username`, `password`, `maPB`, `image`) VALUES
(11, 'Nguyễn Hưng Hoài Nam', 'nvhoainam', '123', 'PT', 'images/5bc93c9e6d6865c911a009c4c6e80e9c.JPG'),
(12, 'Trần Thị Kiều', 'nvkieu', '123', 'KT', 'images/16fdb8df309a6fd37aa58f2cdf381750.JPG'),
(13, 'Trần Thái Bảo', 'nvbao', '1234', 'PT', 'images/23fccca97b345a30f87ffb4c9c978d2b.JPG'),
(14, 'Đăng Trường', 'nvtruong', '123', 'PT', 'images/352d89f4f9a4c98aeb6c51823f1ad7c1.JPG'),
(15, 'Lê Ngọc Trân', 'nvngoctran', '123', 'KT', 'images/45ee696fcf45598b661fca2d4dace4d9.JPG'),
(16, 'Nguyễn Hữu Huy', 'nvhuy', '123', 'PT', 'images/914aadad65fefae6bec5b9db46569430.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `phongban`
--

CREATE TABLE `phongban` (
  `id` int(11) NOT NULL,
  `maPB` varchar(50) NOT NULL,
  `namePB` varchar(50) NOT NULL,
  `truongphong` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phongban`
--

INSERT INTO `phongban` (`id`, `maPB`, `namePB`, `truongphong`) VALUES
(4, 'PT', 'Phòng phát triển', 'Trần Thái Bảo'),
(5, 'KT', 'Phòng kế toán', 'Trần Thị Kiều');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `tenTask` varchar(100) NOT NULL,
  `descTask` varchar(100) NOT NULL,
  `nhanvien` varchar(100) NOT NULL,
  `maPB` varchar(50) NOT NULL,
  `deadline` date NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `tenTask`, `descTask`, `nhanvien`, `maPB`, `deadline`, `status`) VALUES
(1, 'làm việc 1', 'làm những gì các bạn được giao', 'Nguyễn Hưng Hoài Nam', 'PT', '2021-12-14', 'đã hoàn thành'),
(2, 'Làm website bán hàng', 'Ở đây các bạn cần làm giao diện của trang web bán hàng', 'Nguyễn Hưng Hoài Nam', 'PT', '2021-12-16', 'đã nộp chờ xét duyệt'),
(3, 'Làm thống kê tháng 11', 'Cần thống kê tổng kết tháng 11', 'Lê Ngọc Trân', 'KT', '2021-12-14', 'đã nộp chờ xét duyệt'),
(4, 'Đi kiểm thử website', 'Kiểm tra chức năng website', 'Đăng Trường', 'PT', '2021-12-17', 'được giao');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `giamdoc`
--
ALTER TABLE `giamdoc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phongban`
--
ALTER TABLE `phongban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `giamdoc`
--
ALTER TABLE `giamdoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `phongban`
--
ALTER TABLE `phongban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
