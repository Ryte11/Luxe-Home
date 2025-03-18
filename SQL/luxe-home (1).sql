-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-03-2025 a las 14:38:52
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `luxe-home`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` varchar(20) DEFAULT 'No leído'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contacts`
--

INSERT INTO `contacts` (`id`, `nombre`, `correo`, `telefono`, `mensaje`, `fecha_envio`, `estado`) VALUES
(1, 'Luisangel ', 'chagetepe2@gmail.com', '8299129914', 'pagina asquerosa compre una casa y no me llego', '2025-03-11 15:03:35', 'Leído'),
(2, 'Luisangel ', 'chagetepe2@gmail.com', '8299129914', 'pagina asquerosa compre una casa y no me llego', '2025-03-11 15:04:26', 'No leído'),
(3, 'Luisangel ', 'chagetepe2@gmail.com', '8299129914', 'pagina asquerosa compre una casa y no me llego', '2025-03-11 15:06:35', 'No leído'),
(4, 'Luisangel ', 'chagetepe2@gmail.com', '8299129914', 'pagina asquerosa compre una casa y no me llego', '2025-03-11 15:07:54', 'No leído'),
(6, 'Luisangel ', 'lusiangelgamer@GMAIL.COM', '8299129914', 'la grasa del bloque no sabe tu\r\n', '2025-03-11 21:51:24', 'No leído'),
(7, 'Luisangel ', 'chagetepe2@gmail.com', '8299129914', 'hola soy soyjkhuiugjkjkgjkgjkgkkghjg', '2025-03-13 19:11:43', 'Leído');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `categoria` enum('villa','apartamento','casa') NOT NULL,
  `habitaciones` int(11) NOT NULL,
  `banos` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `operacion` enum('venta','renta') NOT NULL,
  `ubicacion` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `imagen`, `categoria`, `habitaciones`, `banos`, `precio`, `operacion`, `ubicacion`) VALUES
(1, 'mi casa', 'hola como estas', 'img/Fondo1.jpg', 'villa', 4, 6, 265000.00, 'venta', 'mi casa'),
(2, 'Beautiful Punta Cana Villa', '', 'img/Fondo4.jpg', 'villa', 5, 4, 180000.00, 'renta', NULL),
(3, 'Villa de lujo frente al mar', '', 'img/fondo3.jpg', 'villa', 6, 7, 265000.00, 'venta', NULL),
(4, 'Luxury Puerto Bahia Villa/Samaná', '', 'img/Fondo1.jpg', 'villa', 4, 6, 500.00, 'renta', NULL),
(5, 'Beautiful Luxury House/Punta Cana Villa', '', 'img/Fondo2.jpg', 'villa', 5, 4, 420.00, 'renta', NULL),
(6, 'Las Terrenas Front Beach And Garden Villa', '', 'img/fondo5.jpg', 'villa', 5, 4, 300.00, 'renta', NULL),
(7, 'Villa Lujosa Moderna/Cabrerá', '', 'img/fondo3.jpg', 'villa', 4, 4, 450.00, 'renta', NULL),
(8, 'Casa lujosa de 3 pisos en Bella vista', '', 'img/House_contact.jpg', 'casa', 4, 4, 280000.00, 'venta', NULL),
(9, 'Gran casa en la Avenida San Isidro Std.Este', '', 'img/Casa_1.jpeg', 'casa', 4, 4, 160000.00, 'venta', NULL),
(10, 'Casa lujosa y moderna en santiago', '', 'img/fondo4.jpg', 'casa', 4, 4, 1000.00, 'renta', NULL),
(11, 'Lujoso Residencial en Bella vista #3', '', 'img/Apartamento_2.jpg', 'apartamento', 3, 3, 1000.00, 'renta', NULL),
(12, 'Torre Lujosa ubicada en Bella vista', '', 'img/Apartamento_3.jpeg', 'apartamento', 3, 2, 300000.00, 'venta', NULL),
(13, 'Gran Torre con Helipuerto y Area social', '', 'img/Apartamento_2.jpeg', 'apartamento', 4, 4, 185000.00, 'venta', NULL),
(14, 'Apartamento Lujoso en el corazon del país', '', 'img/Apartment_1.jpg', 'apartamento', 4, 4, 550000.00, 'venta', NULL),
(15, 'Casa de campo en jarabacoa cerca del salto de los Monjes', '', 'img/Casa_de_campo.jpg', 'casa', 3, 2, 80000.00, 'venta', NULL),
(16, 'Casa lujosa y moderna en santiago', '', 'img/fondo4.jpg', 'casa', 4, 4, 1000.00, 'renta', NULL),
(22, 'casa lujosa naco', 'la mejor casa en naco', 'img/property_1741886004.jpg', 'casa', 22, 22, 22222.00, 'venta', 'mi casa lejos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `codigo_postal` varchar(10) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `tipo_propiedad` varchar(50) NOT NULL,
  `num_huespedes` int(11) NOT NULL,
  `comentarios` text DEFAULT NULL,
  `fecha_reserva` datetime NOT NULL,
  `estado` varchar(20) DEFAULT 'Pendiente',
  `total` decimal(10,2) NOT NULL,
  `nombre_propiedad` varchar(255) NOT NULL,
  `status` enum('Pending','Confirmed','Denied','cancelado') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `nombre`, `email`, `cedula`, `direccion`, `telefono`, `codigo_postal`, `fecha_entrada`, `fecha_salida`, `metodo_pago`, `tipo_propiedad`, `num_huespedes`, `comentarios`, `fecha_reserva`, `estado`, `total`, `nombre_propiedad`, `status`) VALUES
(1, 'Luisangel Ra', 'luisangelgamer20@gmail.com', '', 'caxcasdasds', '829 912 9914', '34343', '2025-03-04', '2025-03-12', 'Transferencia', 'Villa', 2, 'si que si soy el mejor', '2025-03-09 17:29:29', 'Pendiente', 0.00, '', 'Confirmed'),
(2, 'Luisangel Ramírez', 'luisangelgamer20@gmail.com', '', '', '3434343', '34343', '2025-03-12', '2025-03-06', 'Transferencia', 'Villa', 23, '3dfdfsdfsdfdsfds', '2025-03-09 17:43:44', 'Pendiente', 0.00, '', 'Denied'),
(3, 'Jose angel', '', '', '', '', '', '2025-03-13', '0000-00-00', '', 'Visit', 0, '', '2025-03-09 17:43:50', 'Pendiente', 0.00, 'Modern Luxury Apartment', 'Confirmed'),
(5, 'kiara alcabtar', 'luisangelgamer20@gmail.com', '12345678901', 'fasdsdsdsa', '24234323232323', '34343', '2025-03-19', '2025-02-27', 'Transferencia', 'Villa', 44, 'dsfdfsdfsdfsdf', '2025-03-09 19:59:40', 'Pendiente', 0.00, '', 'Denied'),
(7, 'Manuel almanzar', 'w@gmail.com', '12345678901', 'fasdsdsdsasadsad', '3232312233432', '34343', '2025-03-13', '2025-03-05', 'Transferencia', 'Casa', 22, 'sdsadasdsdsadsad', '0000-00-00 00:00:00', 'Pendiente', 516200.00, 'Casa lujosa de 3 pisos en Bella vista', 'Pending'),
(8, 'german', 'luisangelgamer20@gmail.com', '12345678901', 'caxcasdasds', '899089089089089', '34343', '2025-03-21', '2025-03-12', 'Efectivo', 'Villa', 7, 'nklkljlk', '0000-00-00 00:00:00', 'Pendiente', 516200.00, 'Villa Lujosa Moderna', 'Pending'),
(9, 'mosco rico', 'luisangelgamer20@gmail.com', '12345678901', 'casdsdsdas', '232332325534', '34343', '2025-03-07', '2025-03-06', 'Transferencia', 'Villa', 23, 'ckanckasancjinsjcnaskcnakcnaskcnsjkacnkjacnjksncjkda', '0000-00-00 00:00:00', 'Pendiente', 516200.00, 'Villa Lujosa Moderna', 'Confirmed'),
(10, 'Luisangel gantel', '', '', '', '8299129914', '', '2025-03-14', '2025-03-20', '', 'villa', 22, 'sdasdsadsadasdas', '0000-00-00 00:00:00', 'Pendiente', 10000.00, 'luxe house sicaria', 'Pending'),
(11, 'Luisangel gant', '', '', '', '8299129914', '', '2025-03-13', '2025-03-20', '', 'villa', 2, 'sadsadsa', '0000-00-00 00:00:00', 'Pendiente', 1000.00, 'luxe house sicaria', 'Confirmed'),
(12, 'Luisanny', '', '', '', '8299129914', '', '2025-03-14', '2025-03-19', '', 'villa', 3, 'dsdsadsadsad', '0000-00-00 00:00:00', 'Pendiente', 33333.00, 'luxe house sicaria', 'Confirmed');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `reservas_activas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `reservas_activas` (
`id` int(11)
,`nombre` varchar(100)
,`email` varchar(100)
,`cedula` varchar(15)
,`direccion` varchar(200)
,`telefono` varchar(20)
,`codigo_postal` varchar(10)
,`fecha_entrada` date
,`fecha_salida` date
,`metodo_pago` varchar(50)
,`tipo_propiedad` varchar(50)
,`num_huespedes` int(11)
,`comentarios` text
,`fecha_reserva` datetime
,`estado` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `reservas_pasadas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `reservas_pasadas` (
`id` int(11)
,`nombre` varchar(100)
,`email` varchar(100)
,`cedula` varchar(15)
,`direccion` varchar(200)
,`telefono` varchar(20)
,`codigo_postal` varchar(10)
,`fecha_entrada` date
,`fecha_salida` date
,`metodo_pago` varchar(50)
,`tipo_propiedad` varchar(50)
,`num_huespedes` int(11)
,`comentarios` text
,`fecha_reserva` datetime
,`estado` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `rol` varchar(50) NOT NULL DEFAULT 'usuario',
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `created_at`, `rol`, `telefono`) VALUES
(2, 'brocol', 'luisrc112716@gmail.com', '$2y$10$zcFKvor/hMjivWAn.7si.ezpSpRJJ/VHqgDhxEUOrJZd7M2GaE5PO', '2025-03-02 18:42:55', 'admin', ''),
(3, 'German garmendia', 'german@gmail.copm', '$2y$10$vpclzdRqe0OYtEP0S7EMmeCtFKFn5SW9oF05NxJrVovSL5stDZ.8y', '2025-03-02 21:01:15', 'usuario', NULL),
(4, 'kiara Aylin', 'kiara@gmail.com', '$2y$10$JeUTUDiaUpHQAAKq/oCJJ.liXhId9qaiw0Qcfqz/YCIKKngMB/xxi', '2025-03-02 21:25:56', 'usuario', NULL),
(5, 'german garmendia', 'luisangel20@gmail.com', '$2y$10$5wyVgquzkk/j74C4AXxY6uWtXDtokS6rcZaOX0XswTvQeZf8FL3gW', '2025-03-02 21:50:22', 'usuario', NULL),
(6, 'kiara ailyn beltre', 'kiarabeltre@gmail.com', '$2y$10$YpvcVDULB87hgJkQniT.I.T4rPZZx3yYtCtIyaisTizVDDfnDriEO', '2025-03-03 00:02:08', 'usuario', NULL),
(9, 'jefry morales', 'jefry@gmail.com', '$2y$10$oSGr5S6gw55DFRj45XnSGuyvI1c2FaNu5Mn1Qmw/C62VjQKoisnJe', '2025-03-09 18:33:03', 'usuario', NULL),
(12, 'ramirez', 'w@gmail.com', '$2y$10$Fa8VKBeiK3HmSfvEf8dvweKFvjfdgnbltA3ODLsDKrnSNIK2pL9pK', '2025-03-09 19:41:18', 'admin', ''),
(14, 'kiara', 'kiarag@gmail.com', '$2y$10$XYNtFK6o1Zd2DUA.QaYRveTW1geKFoj0Xcm.pp/Cmida6uGb/FOsm', '2025-03-09 20:47:52', 'usuario', ''),
(15, 'Luisangel Ramirez', 'luisangelgamer20@gmail.com', '$2y$10$RlHbIxkaXycdf.LYlCf4me17ab0wXq4xG3MQYM5KvS/Uta20a.RXq', '2025-03-09 20:51:56', 'admin', ''),
(16, 'moscorico', 'mosco@gmail.com', '$2y$10$/ihRhmMXgF8pVujvzDLWY.TF8TqSl7ZakzN3dyABzb/KaX7iR1yqW', '2025-03-10 15:45:00', 'usuario', NULL),
(24, 'luisangel gamer', 'luisrc@gmail.com', '$2y$10$RE/t0DQBPvhK0/0tie17zOq74FxH3XUJIetU9a99cv7N/RyhTRbga', '2025-03-12 02:54:58', 'usuario', '323232323'),
(27, 'kiaera gracias', 'lageras26@gmail.com', '$2y$10$rda//LKTTjIS.m69iJdm0uF23Lg9d6PrXVBTPNB7qI2LjyZld3lrC', '2025-03-12 02:57:07', 'usuario', '123456'),
(30, 'luisangel gamer', 'holaomoestas@gmail.com', '$2y$10$VbnJZMmA2e46PuF8S0L54eI0wpqCoIkOAoeF7wDBspPwVtqDMBnIS', '2025-03-12 03:00:20', 'usuario', '8299129914'),
(31, 'alonso increible', 'alonsoincreible@gmail.com', '$2y$10$Gk91lBBKEln5co2QSrEboOBTcRbYhqE9qjJhTbhXVcrcUo2gXeIqq', '2025-03-12 03:02:01', 'usuario', '8299129914'),
(32, 'la grasa 55', 'lagrasa55@gmail.com', '$2y$10$dyCl33h9RnXFtnsTZh287uE5smgf3lCrGZLRwcFTsZKKXrReAvg2S', '2025-03-12 03:03:53', 'admin', '8299129914'),
(33, 'fulvio', 'lemuro@gmail.com', '$2y$10$ahpDq3m4oERYJu3nEhIV6e.W4mleLLPLfUzAaMgdx4eUT1iDE4yZm', '2025-03-12 19:50:57', 'usuario', NULL),
(34, 'Manuel', 'manolo@gmail.com', '$2y$10$pQRxZx9nugcXhE1eqiGO5.8ETVhpXWukNcu5cI/uyFbpA8cBqEdh2', '2025-03-12 19:51:59', 'usuario', NULL),
(35, 'Manuel', 'manolo1@gmail.com', '$2y$10$XvIeXQl7M5lly133UprtOeWLMRekHRJm5mmY6IT8xF0im4bXF.e3C', '2025-03-12 19:52:21', 'usuario', NULL),
(36, 'Carlos', 'carlosadrian4708@gmail.com', '$2y$10$CWa6mmx/WgkWVW6vL1/3uOJoAk9NhlWUHk6mAEGpB7OoCL06pxpWS', '2025-03-12 19:54:18', 'admin', NULL),
(37, 'Freidora Industrial', 'Freidora@gmail.com', '$2y$10$seNmcAHkjlax5/5UWz5HyuNSwy3HXI/Ge4MxAnIzrclBDmg2NOIZC', '2025-03-12 19:58:03', 'admin', '8097188610'),
(38, 'Dhorian', 'Dhorian@gmail.com', '$2y$10$gaYuuRaDUo.BIlhQq5JJ4ODNg83sfZpt9nAPHtcIVMudb9WlsM7yW', '2025-03-13 19:04:09', 'usuario', NULL);

-- --------------------------------------------------------

--
-- Estructura para la vista `reservas_activas`
--
DROP TABLE IF EXISTS `reservas_activas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reservas_activas`  AS SELECT `reservas`.`id` AS `id`, `reservas`.`nombre` AS `nombre`, `reservas`.`email` AS `email`, `reservas`.`cedula` AS `cedula`, `reservas`.`direccion` AS `direccion`, `reservas`.`telefono` AS `telefono`, `reservas`.`codigo_postal` AS `codigo_postal`, `reservas`.`fecha_entrada` AS `fecha_entrada`, `reservas`.`fecha_salida` AS `fecha_salida`, `reservas`.`metodo_pago` AS `metodo_pago`, `reservas`.`tipo_propiedad` AS `tipo_propiedad`, `reservas`.`num_huespedes` AS `num_huespedes`, `reservas`.`comentarios` AS `comentarios`, `reservas`.`fecha_reserva` AS `fecha_reserva`, `reservas`.`estado` AS `estado` FROM `reservas` WHERE `reservas`.`fecha_salida` >= curdate() AND `reservas`.`estado` <> 'Cancelada' ORDER BY `reservas`.`fecha_entrada` ASC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `reservas_pasadas`
--
DROP TABLE IF EXISTS `reservas_pasadas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reservas_pasadas`  AS SELECT `reservas`.`id` AS `id`, `reservas`.`nombre` AS `nombre`, `reservas`.`email` AS `email`, `reservas`.`cedula` AS `cedula`, `reservas`.`direccion` AS `direccion`, `reservas`.`telefono` AS `telefono`, `reservas`.`codigo_postal` AS `codigo_postal`, `reservas`.`fecha_entrada` AS `fecha_entrada`, `reservas`.`fecha_salida` AS `fecha_salida`, `reservas`.`metodo_pago` AS `metodo_pago`, `reservas`.`tipo_propiedad` AS `tipo_propiedad`, `reservas`.`num_huespedes` AS `num_huespedes`, `reservas`.`comentarios` AS `comentarios`, `reservas`.`fecha_reserva` AS `fecha_reserva`, `reservas`.`estado` AS `estado` FROM `reservas` WHERE `reservas`.`fecha_salida` < curdate() ORDER BY `reservas`.`fecha_entrada` DESC ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_fecha_entrada` (`fecha_entrada`),
  ADD KEY `idx_fecha_salida` (`fecha_salida`),
  ADD KEY `idx_tipo_propiedad` (`tipo_propiedad`),
  ADD KEY `idx_estado` (`estado`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
