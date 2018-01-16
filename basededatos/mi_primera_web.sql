-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 16, 2018 at 08:24 AM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mi_primera_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_padre` int(10) UNSIGNED DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `id_padre`, `icon`) VALUES
(1, 'Ordenadores', NULL, 'fa-desktop'),
(2, 'Pc Escritorio', 1, 'fa-desktop'),
(3, 'Portátiles', 1, 'fa-laptop'),
(4, 'Tablets', NULL, 'fa-tablet'),
(5, 'Ordenador2', NULL, 'fa-desktop'),
(6, 'Impresora', NULL, 'fa-print'),
(7, 'inkjet', 6, 'fa-tint'),
(8, 'plotter', 6, 'fa-bomb');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `precio` double NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `destacado` tinyint(1) NOT NULL DEFAULT '0',
  `descuento` tinyint(4) NOT NULL DEFAULT '0',
  `stock` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `carrusel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `id_categoria`, `precio`, `foto`, `destacado`, `descuento`, `stock`, `fecha`, `carrusel`) VALUES
(1, 'Acer Aspire Swift 5', 'Mas delgado y ligero. Mas facil de llevar gracias a su perfil de 14,58 mm y sus 1,36 kg de peso', 3, 599, 'phpscf9BD.jpg', 1, 15, 5, '2017-11-28 09:03:45', 'phpjrNHP8.jpg'),
(2, 'hp cssadas', 'dfdasdsgdsfdsasdfssdffsdsdfa', 3, 650, 'phpgfjO1t.jpg', 0, 5, 10, '2017-11-30 07:45:14', 'phpq54cFP.jpg'),
(3, 'Lenovo 251xk', 'Un ordenador muy bonitoooooooo. El más rapido', 3, 645, 'phpmy7SRU.jpg', 1, 0, 15, '2017-11-30 08:54:55', 'php8VoOjH.jpg'),
(4, 'Apple 4217i', 'El nuevo Apple de útlima generación con los mejores avances', 2, 1200, 'phpbiLq3n.png', 0, 2, 3, '2017-11-30 09:13:17', ''),
(5, 'MacBook Air Core i5', 'La batería de la MacBook Air dura hasta 12 horas con una sola carga, para que puedas trabajar desde la mañana hasta que vuelvas de la oficina sin necesidad de cargarla', 3, 1150, 'php27N05W.jpg', 1, 0, 0, '2017-11-30 09:17:23', 'phpk9RRNL.jpg'),
(6, 'HP 15-bw000ns', 'Realiza todas las tareas diarias con éxito utilizando un portátil elegante creado para mantenerte conectado, así como para llevar a cabo tus actividades habituales', 3, 310, 'phphLFHIZ.png', 0, 5, 3, '2017-12-11 07:46:08', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`) USING BTREE,
  ADD KEY `categorias_ibfk_1` (`id_padre`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`id_padre`) REFERENCES `categorias` (`id`);

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
