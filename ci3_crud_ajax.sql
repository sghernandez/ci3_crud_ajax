-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2021 at 12:44 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci3_crud_ajax`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `FIRSTNAME` varchar(60) DEFAULT NULL,
  `LASTNAME` varchar(60) DEFAULT NULL,
  `EMAIL` varchar(150) DEFAULT NULL,
  `GENDER` varchar(2) DEFAULT NULL,
  `TELEPHONE` varchar(20) DEFAULT NULL,
  `AGE` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `FIRSTNAME`, `LASTNAME`, `EMAIL`, `GENDER`, `TELEPHONE`, `AGE`) VALUES
(1, 'Pablo', 'Hernández', 'pablo@outlook.com', 'M', '3107488885', 42),
(2, 'Juan Carlos', 'Meneses', 'hernandezs@gmail.co', 'M', '3107488885', 25),
(3, 'Edilia', 'Mateus', 'john_doe@example.com', 'M', '300452687', 30),
(4, 'Juan Pablo', 'Montoya', 'juan@gmail.com', 'M', '34554821154', 45),
(5, 'Pedro', 'Perez', 'pedro@gmail.com', 'M', '3107488885', 41),
(6, 'Admin', 'Marinez', 'ibimenez@paez.com', 'M', '310745885', 20),
(7, 'karo', 'Cardenas', 'caro@gmail.com', 'F', '31544544', 25),
(8, 'Carolina', 'Arteaga', 'arteaga@technorium.co', 'F', '22458454', 22),
(9, 'Pablo', 'Perez', 'pablo@gmail.com', 'M', '3107888885', 32),
(10, 'Juan José', 'Suarez', 'juanjose@gmail.com', 'M', '444445488', 32);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
