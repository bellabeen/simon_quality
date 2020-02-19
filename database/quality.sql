-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 19, 2020 at 09:53 AM
-- Server version: 10.1.43-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quality`
--

-- --------------------------------------------------------

--
-- Table structure for table `dt`
--

CREATE TABLE `dt` (
  `id` int(11) NOT NULL,
  `col` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ground`
--

CREATE TABLE `ground` (
  `id` bigint(20) NOT NULL,
  `suhu` float DEFAULT NULL,
  `kelembapan_tanah` float DEFAULT NULL,
  `ph` float DEFAULT NULL,
  `waktu` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ground`
--

INSERT INTO `ground` (`id`, `suhu`, `kelembapan_tanah`, `ph`, `waktu`) VALUES
(1, 7, 1, 2, '2020-02-16 13:18:44'),
(2, 2, 10, 11, '2020-02-16 13:26:05');

-- --------------------------------------------------------

--
-- Table structure for table `tanah`
--

CREATE TABLE `tanah` (
  `id` bigint(20) NOT NULL,
  `suhu` float DEFAULT NULL,
  `kelembapan_tanah` float DEFAULT NULL,
  `ph` float DEFAULT NULL,
  `waktu` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tanah`
--

INSERT INTO `tanah` (`id`, `suhu`, `kelembapan_tanah`, `ph`, `waktu`) VALUES
(18, 10, 11, 6, '2020-02-18 08:23:36'),
(19, 11, 13, 4, '2020-02-18 08:30:27'),
(20, 12, 14, 4, '2020-02-18 09:34:03'),
(21, 13, 14, 4, '2020-02-18 09:39:25'),
(22, 13, 14, 4, '2020-02-18 09:45:24'),
(23, 13, 14, 4, '2020-02-18 09:46:14'),
(24, 15, 16, 4, '2020-02-18 09:46:20'),
(25, 17, 18, 4, '2020-02-18 09:52:11'),
(26, 18, 18, 4, '2020-02-18 10:09:13'),
(27, 18, 19, 4, '2020-02-18 10:12:05'),
(28, 100, 19, 4, '2020-02-18 11:42:14');

-- --------------------------------------------------------

--
-- Table structure for table `udara`
--

CREATE TABLE `udara` (
  `id` bigint(20) NOT NULL,
  `humidity` float DEFAULT NULL,
  `temperature` float DEFAULT NULL,
  `resistansi_hidrogen_sulfida` float DEFAULT NULL,
  `nilai_hidrogen_sulfida` float DEFAULT NULL,
  `nilai_amonia_sulfida_benzena` float DEFAULT NULL,
  `resistansi_amonia_sulfida_benzena` float DEFAULT NULL,
  `nilai_gas_lpg` float DEFAULT NULL,
  `nilai_asap` float DEFAULT NULL,
  `nilai_karbonmonoksida` float DEFAULT NULL,
  `nilai_gas_metana` float DEFAULT NULL,
  `konsentrasi_debu` float DEFAULT NULL,
  `waktu` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `udara`
--

INSERT INTO `udara` (`id`, `humidity`, `temperature`, `resistansi_hidrogen_sulfida`, `nilai_hidrogen_sulfida`, `nilai_amonia_sulfida_benzena`, `resistansi_amonia_sulfida_benzena`, `nilai_gas_lpg`, `nilai_asap`, `nilai_karbonmonoksida`, `nilai_gas_metana`, `konsentrasi_debu`, `waktu`) VALUES
(93, 101, 111, 121, 111, 151, 161, 81, 911, 411, 1000, 7111, '2020-02-16 12:30:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dt`
--
ALTER TABLE `dt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ground`
--
ALTER TABLE `ground`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tanah`
--
ALTER TABLE `tanah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `udara`
--
ALTER TABLE `udara`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dt`
--
ALTER TABLE `dt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ground`
--
ALTER TABLE `ground`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tanah`
--
ALTER TABLE `tanah`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `udara`
--
ALTER TABLE `udara`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
