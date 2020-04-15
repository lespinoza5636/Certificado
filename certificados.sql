-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 15, 2020 at 07:24 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `certificados`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificado`
--

CREATE TABLE `certificado` (
  `codigo` varchar(200) NOT NULL,
  `evento_idevento` int(11) NOT NULL,
  `participante_cedula` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `certificado`
--

INSERT INTO `certificado` (`codigo`, `evento_idevento`, `participante_cedula`) VALUES
('2020-051189-TE-46230', 5, '0010511890053X'),
('2020-051189-TE-54980', 5, '0010511890052X'),
('2020-051189-TE-86962', 5, '0010511890053Z');

-- --------------------------------------------------------

--
-- Table structure for table `evento`
--

CREATE TABLE `evento` (
  `idevento` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `fi` varchar(45) NOT NULL,
  `ff` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evento`
--

INSERT INTO `evento` (`idevento`, `nombre`, `fi`, `ff`) VALUES
(5, 'Congreso de TecnologÃ­a Educativa', '2020-02-05', '2020-02-12');

-- --------------------------------------------------------

--
-- Table structure for table `modleo`
--

CREATE TABLE `modleo` (
  `imagen` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `idm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `modleo`
--

INSERT INTO `modleo` (`imagen`, `tipo_id`, `evento_id`, `idm`) VALUES
('cer.png', 1, 5, 1),
('2020-TE-885215', 2, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `participante`
--

CREATE TABLE `participante` (
  `cedula` varchar(14) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `tipo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `participante`
--

INSERT INTO `participante` (`cedula`, `nombre`, `apellido`, `correo`, `tipo_id`) VALUES
('0010511890052X', 'Luis', 'Espinoza', 'luis.manuel.espinoza.estrada@gmail.com', 1),
('0010511890053X', 'David', 'Espinoza', 'david@uoc.edu', 0),
('0010511890053Z', 'David', 'Urbina', 'lespinozae2@yahoo.es', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tipos`
--

CREATE TABLE `tipos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tipos`
--

INSERT INTO `tipos` (`id`, `nombre`) VALUES
(1, 'Ponente'),
(2, 'Participante');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `pass` varchar(45) DEFAULT NULL,
  `participante_cedula` varchar(14) NOT NULL,
  `login` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `pass`, `participante_cedula`, `login`) VALUES
(1, '81dc9bdb52d04dc20036dbd8313ed055', '0010511890052X', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificado`
--
ALTER TABLE `certificado`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_certificado_evento1_idx` (`evento_idevento`),
  ADD KEY `fk_certificado_participante1_idx` (`participante_cedula`);

--
-- Indexes for table `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`idevento`);

--
-- Indexes for table `modleo`
--
ALTER TABLE `modleo`
  ADD PRIMARY KEY (`idm`);

--
-- Indexes for table `participante`
--
ALTER TABLE `participante`
  ADD PRIMARY KEY (`cedula`);

--
-- Indexes for table `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_participante1_idx` (`participante_cedula`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `evento`
--
ALTER TABLE `evento`
  MODIFY `idevento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `modleo`
--
ALTER TABLE `modleo`
  MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certificado`
--
ALTER TABLE `certificado`
  ADD CONSTRAINT `fk_certificado_evento1` FOREIGN KEY (`evento_idevento`) REFERENCES `evento` (`idevento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_certificado_participante1` FOREIGN KEY (`participante_cedula`) REFERENCES `participante` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_participante1` FOREIGN KEY (`participante_cedula`) REFERENCES `participante` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
