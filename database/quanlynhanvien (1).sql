-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 02, 2022 at 02:17 PM
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
  `password` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `giamdoc`
--

INSERT INTO `giamdoc` (`id`, `name`, `username`, `password`, `image`) VALUES
(1, 'Giam doc', 'admin', '$2y$10$qziuZ1g9j4utqEOm2Q3M.OaUO5lywnw1EoYmM7ZkdzMhKJ68gqRtm', 'images/admin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `nghiphep`
--

CREATE TABLE `nghiphep` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `maPB` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nghiphep`
--

INSERT INTO `nghiphep` (`id`, `name`, `reason`, `maPB`, `status`) VALUES
(5, 'Nguyễn Hưng Hoài Nam', 'hôm nay em hơi mệt ', 'software', 'approved'),
(6, 'Trần Thị Kiều', 'today i don\'t feel good , i want to stay home to feel wealth', 'software', 'approved'),
(7, 'Nguyễn Hưng Hoài Nam', 'I feel bad, today', 'software', 'rejected'),
(8, 'Nguyễn Hưng Hoài Nam', 'I feel so bad please i want to stay at home', 'software', 'approved'),
(9, 'Trần Thị Kiều', 'Chào xếp nay em muốn xin nghỉ phép em đau bụng kinh qúa :VV', 'software', 'approved'),
(10, 'Trần Thị Kiều', 'em chào xếp em xin được nghỉ', 'software', 'rejected'),
(11, 'Trần Thị Kiều', 'i feel so good :VV', 'software', 'rejected'),
(12, 'Trần Thị Kiều', 'nay em bị tiêu chảy nên em muốn xin nghỉ ạ', 'software', 'approved'),
(13, 'Nguyễn Hưng Hoài Nam', 'boss, today, i feel bad so i can stay home ?', 'software', 'approved'),
(14, 'Trần Thị Kiều', 'em xin được nghỉ ạ', 'software', 'approved'),
(15, 'Nguyễn Hưng Hoài Nam', 'nay cảm thấy mệt và sốt tới 38 độ nên xin nghỉ', 'software', 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `maPB` varchar(50) NOT NULL,
  `chucvu` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL,
  `tongngaynghi` int(11) NOT NULL,
  `duocnghi` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `cmnd` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sdt` int(11) NOT NULL,
  `diachi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`id`, `name`, `username`, `password`, `maPB`, `chucvu`, `image`, `tongngaynghi`, `duocnghi`, `status`, `cmnd`, `email`, `sdt`, `diachi`) VALUES
(17, 'Nguyễn Hưng Hoài Nam', 'nvhoainam', '$2y$10$Kdi9y1YivZAvYR2AzQwRLu685MxZohciiWK.hsiBecbzhpWrjRDlu', 'software', 'nhân viên', 'images/8c7e9fa06948d3b136dabfba06b33bac.JPG', 3, 12, 1, '12345678', 'nam@example.com', 1234567890, '12 đường Đồng Tiền'),
(18, 'Mai Nguyễn Thái Học', 'nvhoc', '$2y$10$KcOe5S0KPn5wDPvUJjLcV.l6FAMwtdvIAgtYF55qS1kHWzd0Hr8O2', 'software', 'nhân viên', 'images/352d89f4f9a4c98aeb6c51823f1ad7c1.JPG', 0, 12, 1, '1234567890', 'hoc@example.com', 1234567890, '12 đường Vĩnh Lộc'),
(19, 'Lê Ngọc Trân', 'nvngoctran', '$2y$10$eNXjZGTq7ghN387xfREAeufxOcylM7Ohn8QChiV4658yEAbVfn9xa', 'LeTan', 'trưởng phòng', 'images/830ee79eae81efe027418e3ee6b0112b.JPG', 0, 15, 1, '1234567890', 'tran@example.com', 1234567890, '12 đường Nguyễn Đình Cẩn'),
(20, 'Trần Thị Kiều', 'nvkieu', '$2y$10$DfyQyuei4p04iPw/3K3pR.Yb89z7XXrE52LvQ9sknBK0lAi/cNjEm', 'software', 'trưởng phòng', 'images/2.png', 4, 15, 1, '1234567890', 'kieu@example.com', 1234567890, '123 đường Vĩnh Tiến'),
(21, 'Trần Thái Bảo', 'nvbao', '$2y$10$nwvFU0vGZANS0rz30KZLDOuoHT7mZaVc93ywIGHhlwMQ9UwUNmYW.', 'software', 'nhân viên', 'images/bb091898092f7d5451e38a3f5f2104c3.JPG', 0, 12, 1, '1234567890', 'bao@example.com', 1234567890, '12 đường Bảo Lộc'),
(22, 'Lê Thị Tí', 'nvti', '$2y$10$M3LQzO99diqs/JuL2EbEQeAOTHjyRIF1BYuEOqppqV.DehFbSKSYC', 'KeToan', 'trưởng phòng', 'images/9ca1b65808cdffb8d9a04c83bea4125c.JPG', 0, 15, 0, '1234567890', 'ti@example.com', 1234567890, '12 đường Cà Mau'),
(24, 'Nguyễn Huỳnh Như', 'nvnhu', '$2y$10$O2L558iimsras1OgyTZezO1E5lmjId6cpf00n653EJTQ77Osawlni', 'LeTan', 'nhân viên', 'images/352d89f4f9a4c98aeb6c51823f1ad7c1.JPG', 0, 12, 1, '1234567890', 'nhu@example.com', 1234567890, '45 đường Tình Yêu'),
(25, 'Nguyễn Văn A', 'nvA', '$2y$10$oGPkAEtZnmAUzUpufbDwuu2p1Q2B2X2sCPiUmXlyDHC8ifRD948qK', 'KEHOACH', 'trưởng phòng', 'images/eifiel.jpeg', 0, 15, 1, '0012001919', 'A@example.com', 123456789, '123 đường Trần Hưng Đạo'),
(26, 'Nguyễn Văn B', 'nvB', '$2y$10$DPZGl1depJBLreZJPVxnz.4.OTUd9fAWNKIYl6o0du4/pA2xOSHEy', 'KEHOACH', 'nhân viên', 'images/4f8a244cb43a8ee3188a981bfedbeb68.JPG', 0, 12, 1, '0012001918', 'B@example.com', 123456789, '124 đường Hoà Bình');

-- --------------------------------------------------------

--
-- Table structure for table `phongban`
--

CREATE TABLE `phongban` (
  `id` int(11) NOT NULL,
  `maPB` varchar(50) NOT NULL,
  `namePB` varchar(50) NOT NULL,
  `mota` varchar(100) NOT NULL,
  `sophong` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phongban`
--

INSERT INTO `phongban` (`id`, `maPB`, `namePB`, `mota`, `sophong`) VALUES
(7, 'KeToan', 'Phòng kế toán', 'phòng tính toán thống kê thu chi', 'D101'),
(8, 'software', 'Phòng phát triển', 'phòng phát triển các hạng mục của công ty', 'A101'),
(9, 'LeTan', 'Phòng lễ tân', 'phòng của các lễ tân hướng dẫn khách', 'B201'),
(10, 'KEHOACH', 'Phòng kế hoạch', 'Phòng đưa ra các kế hoạch cho các phòng', 'C301');

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
  `fileTask` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `quality` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `tenTask`, `descTask`, `nhanvien`, `maPB`, `deadline`, `fileTask`, `status`, `quality`) VALUES
(8, 'thiết kế giao diện web bán hàng', 'nhớ làm', 'Nguyễn Hưng Hoài Nam', 'software', '2021-12-23', 'uploadTask/Copyright protection scheme for color images using extended visual cryptography.pdf', 'Completed', 'Good'),
(10, 'làm web', 'design background', 'Mai Nguyễn Thái Học', 'software', '2021-12-23', 'uploadTask/Clustering - Kmean.ipynb', 'Completed', 'Bad'),
(11, 'làm web 1', 'dsasad', 'Nguyễn Hưng Hoài Nam', 'software', '2021-12-21', 'uploadTask/manager.png', 'Completed', 'Bad'),
(12, 'lab2', 'lab2', 'Nguyễn Hưng Hoài Nam', 'software', '2021-12-23', 'uploadTask/51900763_lab4_3.docx', 'Completed', 'Bad'),
(14, 'Kiểm tra các cuộc gọi KH', 'yêu cầu kiểm tra các cuộc gọi và báo cáo lại', 'Nguyễn Huỳnh Như', 'LeTan', '2021-12-27', 'uploadTask/Copyright protection scheme for color images using extended visual cryptography.pdf', 'Completed', 'OK'),
(16, 'làm web 1', 'ádasdas', 'Trần Thái Bảo', 'software', '2022-01-14', 'uploadTask/manager.png', 'Completed', 'Bad');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `giamdoc`
--
ALTER TABLE `giamdoc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nghiphep`
--
ALTER TABLE `nghiphep`
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
-- AUTO_INCREMENT for table `nghiphep`
--
ALTER TABLE `nghiphep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `phongban`
--
ALTER TABLE `phongban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
