-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 20, 2021 at 09:02 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

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
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `giamdoc`
--

INSERT INTO `giamdoc` (`id`, `username`, `password`, `name`, `image`) VALUES
(1, 'admin', 'admin', 'Giam doc', 'img/admin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`id`, `username`) VALUES
(30, 'nv01'),
(43, 'nv03'),
(44, 'nv02');

-- --------------------------------------------------------

--
-- Table structure for table `quanly`
--

CREATE TABLE `quanly` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quanly`
--

INSERT INTO `quanly` (`id`, `username`) VALUES
(9, 'ql01'),
(10, 'ql02'),
(12, 'ql03');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ngaysinh` date NOT NULL,
  `noisinh` varchar(100) NOT NULL,
  `sdt` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `ngaysinh`, `noisinh`, `sdt`, `image`) VALUES
(35, 'ql01', '123', 'Quản lý số 1', '2021-11-19', 'Thành phố Hồ Chí Minh', 123, 'img/2.jpg'),
(36, 'nv01', '123456', 'Hoài Nam', '2021-11-19', 'Thành phố Hồ Chí Minh', 1232454, 'img/1.jpg'),
(48, 'ql02', '123', 'Quản lý số 2', '1995-01-20', 'Đồng Nai', 901234567, 'images/1b04da78a4c94d7d63201e2a92d1f841.JPG'),
(49, 'nv03', '123', 'Nhân viên số 3', '1997-12-30', 'Huế', 123, 'images/3b7e2e7c2a0405fa1c805b76c83aad34.JPG'),
(51, 'ql03', '123', 'Quản lý số 3', '1994-06-07', 'Nghệ An', 123, 'images/5c7311caa3e54dc773f2c9846251a301.JPG'),
(52, 'nv02', '123', 'Nhân viên số 2', '2021-11-02', 'HN', 123, 'images/1b04da78a4c94d7d63201e2a92d1f841.JPG');

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
-- Indexes for table `quanly`
--
ALTER TABLE `quanly`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `quanly`
--
ALTER TABLE `quanly`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
