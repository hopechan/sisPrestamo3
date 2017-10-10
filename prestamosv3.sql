-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2017 at 01:58 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prestamosv3`

CREATE DATABASE prestamosv3;
USE prestamosv3;

--

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `ID_cuenta` int(3) NOT NULL,
  `Nombre_cuenta` varchar(45) NOT NULL,
  `Monto` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bitacora`
--

CREATE TABLE `bitacora` (
  `ID_bitacora` int(3) NOT NULL,
  `ID_usuario` int(3) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Accion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `DUI` char(10) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellidos` varchar(45) NOT NULL,
  `Sexo` char(1) NOT NULL,
  `NIT` char(17) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `observaciones` text,
  `direccion` text NOT NULL,
  `telefonos` varchar(50) DEFAULT NULL,
  `profesion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cuota`
--

CREATE TABLE `cuota` (
  `ID_prestamo` int(11) NOT NULL,
  `num_cuota` int(11) NOT NULL,
  `valor` double NOT NULL,
  `interes` double NOT NULL,
  `fecha` date NOT NULL,
  `capital` double NOT NULL,
  `saldo_anterior` double NOT NULL,
  `saldo_actualizado` double NOT NULL,
  `mora` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `documento`
--

CREATE TABLE `documento` (
  `DUI` char(11) NOT NULL,
  `correlativo` int(11) NOT NULL,
  `nombre_archivo` text NOT NULL,
  `archivo` longblob NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `estado_resultados`
--

CREATE TABLE `estado_resultados` (
  `ID_cuenta` int(3) NOT NULL,
  `Nombre_cuenta` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `movimientos_er`
--

CREATE TABLE `movimientos_er` (
  `ID_cuenta` int(3) NOT NULL,
  `fecha` datetime NOT NULL,
  `monto` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `parametro`
--

CREATE TABLE `parametro` (
  `ID_parametro` int(3) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `valor` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parametro`
--

INSERT INTO `parametro` (`ID_parametro`, `nombre`, `valor`) VALUES
(1, 'nombre Empresa', 'SoftwArch'),
(2, 'email', 'airmind97@softwarch.com'),
(3, 'Telefono', '7897-0166'),
(4, 'Interes', '3'),
(5, 'Mora', '2'),
(6, 'Capitalizacion', 'M'),
(7, 'Direccion', '                                  CantÃ³n El Rosario, CaserÃ­o Las Piedras                               ');

-- --------------------------------------------------------

--
-- Table structure for table `prestamo`
--

CREATE TABLE `prestamo` (
  `ID_prestamo` int(11) NOT NULL,
  `DUI` char(11) NOT NULL,
  `Monto` double NOT NULL,
  `valor_cuota` double NOT NULL,
  `tasa_interes` int(3) NOT NULL,
  `tasa_mora` int(3) NOT NULL,
  `cantidad_cuotas` int(3) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `fecha_ultimo_pago` date NOT NULL,
  `saldo` double NOT NULL,
  `estado` char(1) NOT NULL,
  `observaciones` text NOT NULL,
  `capitalizacion` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `ID_usuario` int(3) NOT NULL,
  `login` varchar(45) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellidos` varchar(45) NOT NULL,
  `clave` char(32) NOT NULL,
  `rol` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`ID_usuario`, `login`, `Nombre`, `Apellidos`, `clave`, `rol`) VALUES
(1, 'am14001', 'Alex', 'Ãgreda', '3c9c71fccc856238f72a51652f3b4250', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`ID_cuenta`);

--
-- Indexes for table `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`ID_bitacora`,`ID_usuario`),
  ADD KEY `ID_usuario` (`ID_usuario`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`DUI`);

--
-- Indexes for table `cuota`
--
ALTER TABLE `cuota`
  ADD PRIMARY KEY (`num_cuota`, `ID_prestamo`),
  ADD KEY `ID_prestamo` (`ID_prestamo`);

--
-- Indexes for table `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`correlativo`, `DUI`),
  ADD KEY `DUI` (`DUI`);

--
-- Indexes for table `estado_resultados`
--
ALTER TABLE `estado_resultados`
  ADD PRIMARY KEY (`ID_cuenta`);

--
-- Indexes for table `movimientos_er`
--
ALTER TABLE `movimientos_er`
  ADD PRIMARY KEY (`fecha`),
  ADD KEY `ID_cuenta` (`ID_cuenta`);

--
-- Indexes for table `parametro`
--
ALTER TABLE `parametro`
  ADD PRIMARY KEY (`ID_parametro`);

--
-- Indexes for table `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`ID_prestamo`),
  ADD KEY `DUI` (`DUI`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_usuario`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `Bitacora_ibfk_1` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cuota`
--
ALTER TABLE `cuota`
  ADD CONSTRAINT `Cuota_ibfk_1` FOREIGN KEY (`ID_prestamo`) REFERENCES `prestamo` (`ID_prestamo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `Documento_ibfk_1` FOREIGN KEY (`DUI`) REFERENCES `cliente` (`DUI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `movimientos_er`
--
ALTER TABLE `movimientos_er`
  ADD CONSTRAINT `Movimientos_ER_ibfk_1` FOREIGN KEY (`ID_cuenta`) REFERENCES `estado_resultados` (`ID_cuenta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `Prestamo_ibfk_1` FOREIGN KEY (`DUI`) REFERENCES `cliente` (`DUI`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
