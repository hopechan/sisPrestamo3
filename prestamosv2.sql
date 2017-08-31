-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2018 at 08:00 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prestamosv2`
--
CREATE DATABASE IF NOT EXISTS `prestamosv2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `prestamosv2`;

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `dui` char(10) NOT NULL,
  `nit` char(17) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `sexo` char(1) CHARACTER SET big5 NOT NULL,
  `direccion` text NOT NULL,
  `telefonos` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `observaciones` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cuota`
--

CREATE TABLE `cuota` (
  `id_prestamo` int(11) NOT NULL,
  `num_cuota` int(11) NOT NULL,
  `valor` double NOT NULL,
  `interes` double NOT NULL,
  `fecha` date NOT NULL,
  `capital` double NOT NULL,
  `saldo_anterior` double NOT NULL,
  `saldo_actualizado` double NOT NULL,
  `mora` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `documentos`
--

CREATE TABLE `documentos` (
  `dui` char(10) NOT NULL,
  `correlativo` int(11) NOT NULL,
  `nombre_archivo` text NOT NULL,
  `archivo` longblob NOT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `parametros`
--

CREATE TABLE `parametros` (
  `id` int(2) DEFAULT NULL,
  `parametro` varchar(50) DEFAULT NULL,
  `valor` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parametros`
--

INSERT INTO `parametros` (`id`, `parametro`, `valor`) VALUES
(1, 'Nombre de la empresa', 'PrestABC'),
(2, 'Correo electrónico', 'contacto@prestabc.com'),
(3, 'Teléfono', '7777-7777'),
(4, 'Interés', '3'),
(5, 'Mora', '5'),
(6, 'Capitalización', 'D'),
(7, 'Dirección', '                                                                                                      Av. LAs MAgnolias\r\n                                \r\n                                \r\n                                \r\n                               ');

-- --------------------------------------------------------

--
-- Table structure for table `prestamo`
--

CREATE TABLE `prestamo` (
  `id_prestamo` int(11) NOT NULL,
  `dui` char(10) NOT NULL,
  `monto` double NOT NULL,
  `valor_cuota` double NOT NULL,
  `tasa_interes` double NOT NULL,
  `tasa_mora` double DEFAULT NULL,
  `cantidad_cuotas` int(3) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `fecha_ultimo_pago` date DEFAULT NULL,
  `saldo` double NOT NULL,
  `estado` char(1) NOT NULL,
  `observaciones` text,
  `capitalizacion` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`dui`);

--
-- Indexes for table `cuota`
--
ALTER TABLE `cuota`
  ADD PRIMARY KEY (`id_prestamo`,`num_cuota`);

--
-- Indexes for table `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`dui`,`correlativo`);

--
-- Indexes for table `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`id_prestamo`),
  ADD KEY `fk_prestamo_cliente1_idx` (`dui`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
