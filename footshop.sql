-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2021 a las 00:31:40
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `footshop`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id_consulta` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `asunto` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `consulta` longtext NOT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id_consulta`, `nombre`, `asunto`, `email`, `consulta`, `usuario_id`) VALUES
(4, 'asfas', 'sfasfas', 'asfasfa@alsfjla.com', 'lkasjfkgalsjfglasgfas', NULL),
(9, 'Usuario Default', 'asfasfasfasfa', 'usuario@usuario.com', 'safasfasfasfasfasfas', 1),
(10, 'Usuario Default', 'aaaaaaaa', 'usuario@usuario.com', 'asfasfasfa', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `influencers`
--

CREATE TABLE `influencers` (
  `id_influencer` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `oficio` varchar(100) NOT NULL,
  `img` varchar(255) NOT NULL,
  `img_alt` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `influencers`
--

INSERT INTO `influencers` (`id_influencer`, `nombre`, `oficio`, `img`, `img_alt`) VALUES
(1, 'Coscu', 'Streamer', 'coscu.png', 'coscu'),
(2, 'Duki', 'Cantante', 'duki.png', 'duki'),
(3, 'Ibai', 'Streamer', 'ibai.png', 'ibai'),
(4, 'Icardi', 'Deportista', 'icardi.png', 'icardi'),
(5, 'Kun Agüero', 'Deportista', 'kun.png', 'kun'),
(6, 'Messi', 'Deportista', 'messi.png', 'messi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `nombre`) VALUES
(1, 'nike'),
(2, 'adiddas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `imagen_alt` varchar(100) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `email`, `password`, `imagen`, `imagen_alt`, `remember_token`) VALUES
(1, 'Usuario', 'Default', 'usuario@usuario.com', '$2y$10$8toDwahqXOYefgromq4RuOhW7iahrl.TDZ1XWXTqS/1vFSPQKPyzS', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zapatillas`
--

CREATE TABLE `zapatillas` (
  `id_zapatilla` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `precio` bigint(20) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `imagen_alt` varchar(255) NOT NULL,
  `id_marca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `zapatillas`
--

INSERT INTO `zapatillas` (`id_zapatilla`, `nombre`, `descripcion`, `precio`, `imagen`, `imagen_alt`, `id_marca`) VALUES
(1, 'Nike Fluor Green', 'Zapatillas Nike Fluor Green, perfectas para caminatas al aire libre y para jugar en cancha de cemento. Con un sistema antideslizante para mayor agarre a la hora de correr y acolchonadas para evitar cualquier dolor, lastimadura o daños en la planta de los pies.', 42000, 'nike-fluor-green.png', 'Zapatillas Nike Fluor Verdes', 1),
(2, 'Nike Fluor Pink', 'Zapatillas Nike Fluor Pink, perfectas para caminatas al aire libre y para jugar en cancha de cemento. Con un sistema antideslizante para mayor agarre a la hora de correr y acolchonadas para evitar cualquier dolor, lastimadura o daños en la planta de los pies.', 37000, 'nike-fluor-pink.png', 'Zapatillas Nike Fluor Rosas', 1),
(3, 'Nike Fluor White', 'Zapatillas Nike Fluor White, perfectas para caminatas al aire libre y para jugar en cancha de cemento. Con un sistema antideslizante para mayor agarre a la hora de correr y acolchonadas para evitar cualquier dolor, lastimadura o daños en la planta de los pies.', 38000, 'nike-fluor-white.png', 'Zapatillas Nike Fluor Blancas', 1),
(4, 'Nike Fluor Blue', 'Zapatillas Nike Fluor Blue, perfectas para caminatas al aire libre y para jugar en cancha de cemento. Con un sistema antideslizante para mayor agarre a la hora de correr y acolchonadas para evitar cualquier dolor, lastimadura o daños en la planta de los pies.', 36000, 'nike-fluor-blue.png', 'Zapatillas Nike Fluor Azules', 1),
(5, 'Nike Fluor Yellow', 'Zapatillas Nike Fluor Yellow, perfectas para caminatas al aire libre y para jugar en cancha de cemento. Con un sistema antideslizante para mayor agarre a la hora de correr y acolchonadas para evitar cualquier dolor, lastimadura o daños en la planta de los pies.', 38000, 'nike-fluor-yelow.png', 'Zapatillas Nike Fluor Amarillas', 1),
(6, 'Nike Fluor Red', 'Zapatillas Nike Fluor Red, perfectas para caminatas al aire libre y para jugar en cancha de cemento. Con un sistema antideslizante para mayor agarre a la hora de correr y acolchonadas para evitar cualquier dolor, lastimadura o daños en la planta de los pies.', 40000, 'nike-fluor-red.png', 'Zapatillas Nike Fluor Rojas', 1),
(7, 'Adidas Fluor White', 'Botines Adidas Fluor White, perfectas para caminatas al aire libre y para dejar todo en la cancha. Con un sistema antideslizante para mayor agarre a la hora de correr y acolchonadas para evitar cualquier dolor, lastimadura o daños en la planta de los pies.', 2700, 'adidas-fluor-white.png', 'Adidas Fluor Blancas', 2),
(8, 'Adidas Fluor Blue', 'Botines Adidas Fluor Blue, perfectas para dejar todo en la cancha. Con un sistema antideslizante para mayor agarre a la hora de correr y acolchonadas para evitar cualquier dolor, lastimadura o daños en la planta de los pies.', 3200, 'adidas-fluor-blue.png', 'Adidas Fluor Azules', 2),
(9, 'Adidas Fluor Green', 'Botines Adidas Fluor Blue, perfectas para dejar todo en la cancha. Con un sistema antideslizante para mayor agarre a la hora de correr y acolchonadas para evitar cualquier dolor, lastimadura o daños en la planta de los pies.', 48000, 'adidas-fluor-green.png', 'Adidas Fluor Verdes', 2),
(10, 'Adidas Fluor Red', 'Botines Adidas Fluor Red, perfectas para dejar todo en la cancha. Con un sistema antideslizante para mayor agarre a la hora de correr y acolchonadas para evitar cualquier dolor, lastimadura o daños en la planta de los pies.', 58000, 'adidas-fluor-red.png', 'Adidas Fluor Rojas', 2),
(11, 'Adidas Fluor Yellow', 'Botines Adidas Fluor Yellow, perfectas para dejar todo en la cancha. Con un sistema antideslizante para mayor agarre a la hora de correr y acolchonadas para evitar cualquier dolor, lastimadura o daños en la planta de los pies.', 49000, 'adidas-fluor-yellow.png', 'Adidas Fluor Amarillas', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id_consulta`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `influencers`
--
ALTER TABLE `influencers`
  ADD PRIMARY KEY (`id_influencer`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `zapatillas`
--
ALTER TABLE `zapatillas`
  ADD PRIMARY KEY (`id_zapatilla`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `id_marca` (`id_marca`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id_consulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `influencers`
--
ALTER TABLE `influencers`
  MODIFY `id_influencer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `zapatillas`
--
ALTER TABLE `zapatillas`
  MODIFY `id_zapatilla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `consultas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `zapatillas`
--
ALTER TABLE `zapatillas`
  ADD CONSTRAINT `zapatillas_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
