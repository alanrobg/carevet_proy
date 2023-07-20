-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-07-2023 a las 19:11:18
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_veterinaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atencion`
--

CREATE TABLE `atencion` (
  `idatencion` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `comentario` varchar(100) NOT NULL,
  `idusu` int(11) NOT NULL,
  `idmascota` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `atencion`
--

INSERT INTO `atencion` (`idatencion`, `idcliente`, `fecha`, `comentario`, `idusu`, `idmascota`, `idusuario`) VALUES
(1, 2, '2023-07-18 23:54:17', 'Com Prueba v2', 2, 3, 1),
(2, 2, '2023-07-19 16:21:51', 'Atencion TEST EDIT V5', 2, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atencion_servicio`
--

CREATE TABLE `atencion_servicio` (
  `idatencion_servicio` int(11) NOT NULL,
  `idatencion` int(11) NOT NULL,
  `idservicio` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `comentario` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `atencion_servicio`
--

INSERT INTO `atencion_servicio` (`idatencion_servicio`, `idatencion`, `idservicio`, `fecha`, `comentario`) VALUES
(1, 1, 1, '2023-07-10 03:11:15', 'Com v3'),
(2, 2, 3, '2023-07-20 11:44:28', 'BAÑO V5 B7'),
(3, 2, 2, '2023-07-20 11:45:36', 'BAÑO V3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atencion_tipo`
--

CREATE TABLE `atencion_tipo` (
  `idatencion_tipo` int(11) NOT NULL,
  `nom_atencion_tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `atencion_tipo`
--

INSERT INTO `atencion_tipo` (`idatencion_tipo`, `nom_atencion_tipo`) VALUES
(1, 'Consulta'),
(2, 'Servicio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `apellido_cli` varchar(100) NOT NULL,
  `nombre_cli` varchar(100) NOT NULL,
  `dni_cli` varchar(20) NOT NULL,
  `nacimiento_cli` date NOT NULL,
  `direccion_cli` varchar(200) NOT NULL,
  `telefono_cli` varchar(50) NOT NULL,
  `correo_cli` varchar(100) NOT NULL,
  `registro_cli` datetime NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `apellido_cli`, `nombre_cli`, `dni_cli`, `nacimiento_cli`, `direccion_cli`, `telefono_cli`, `correo_cli`, `registro_cli`, `idusuario`) VALUES
(1, 'Obono Arpal', 'Marlen', '12312322', '1992-04-08', 'San Gines No. 414', '7882221', 'cgmaialenb6@yopmail.com ', '2023-07-04 09:59:36', 1),
(2, 'Robles Grillo', 'Alan Raul', '123123123', '2000-01-01', 'Colonial', '123123123', 'alanrobles@gmail.com', '2023-07-04 10:27:43', 1),
(3, 'Jacobo V2', 'Brian V2', '123123', '2000-03-01', 'Lima Zona SJL', '123141', 'brian@gmail.com', '2023-07-04 22:53:13', 1),
(4, 'Reyna V2', 'JonathanV2', '12415115', '2010-09-19', 'Magdalena B2', '15124', 'prueba@gmail.com', '2023-07-04 23:28:19', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consulta`
--

CREATE TABLE `consulta` (
  `idconsulta` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `comentario` varchar(100) NOT NULL,
  `idusu` int(11) NOT NULL,
  `idmascota` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `consulta`
--

INSERT INTO `consulta` (`idconsulta`, `idcliente`, `fecha`, `comentario`, `idusu`, `idmascota`, `idusuario`) VALUES
(1, 1, '2023-07-12 11:53:40', 'Com prueba', 2, 4, 1),
(2, 1, '2023-07-19 15:36:23', 'Comv2', 2, 2, 1),
(3, 1, '2023-07-19 18:25:45', 'Comv4 EDEDE44', 2, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especie`
--

CREATE TABLE `especie` (
  `idespecie` int(11) NOT NULL,
  `nom_especie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especie`
--

INSERT INTO `especie` (`idespecie`, `nom_especie`) VALUES
(1, 'Perro V2'),
(2, 'Gato'),
(3, 'Conejo'),
(4, 'Hamster'),
(5, 'Pez'),
(6, 'Cuy'),
(7, 'Ballena');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `idestado` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`idestado`, `estado`) VALUES
(1, 'Disponible'),
(2, 'No Disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esterilizacion`
--

CREATE TABLE `esterilizacion` (
  `idesterilizacion` int(11) NOT NULL,
  `nom_esterilizacion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `esterilizacion`
--

INSERT INTO `esterilizacion` (`idesterilizacion`, `nom_esterilizacion`) VALUES
(1, 'Esterilizado'),
(2, 'No Esterilizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `idmascota` int(11) NOT NULL,
  `nom_mascota` varchar(50) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `nacimiento_mascota` date NOT NULL,
  `color_mascota` varchar(30) NOT NULL,
  `registro_mascota` datetime NOT NULL,
  `foto_mascota` text NOT NULL,
  `esterilizado` int(1) NOT NULL,
  `idraza` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`idmascota`, `nom_mascota`, `idcliente`, `nacimiento_mascota`, `color_mascota`, `registro_mascota`, `foto_mascota`, `esterilizado`, `idraza`) VALUES
(1, 'Alan', 1, '2000-08-31', 'Blancon1', '2023-07-06 09:43:48', '/xampp/htdocs/carevet_proy/Vista/Mascotas_Fotos/Alan-Marlen_Obono Arpal_12312322/10-48-12_06-07-2023.png', 1, 9),
(2, 'Jonathan', 2, '2023-07-04', 'Blanco', '2023-07-06 10:50:54', '/xampp/htdocs/carevet_proy/Vista/Mascotas_Fotos/Jonathan-Robles GrilloB5_Alan RaulB2_123123123/05-50-54_06-07-2023.mp4', 2, 13),
(3, 'Manchas', 4, '1999-01-01', 'Negro', '2023-07-06 15:36:25', '/xampp/htdocs/carevet_proy/Vista/Mascotas_Fotos/Prueba B4-JonathanV2_Reyna V2_12415115/11-16-22_06-07-2023.mp4', 2, 1),
(4, 'Negro', 2, '2023-07-03', 'Blanco', '2023-07-07 21:32:53', '/xampp/htdocs/carevet_proy/Vista/Mascotas_Fotos/Prueba v5-Robles GrilloB5_Alan RaulB2_123123123/04-32-53_08-07-2023.pdf', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raza`
--

CREATE TABLE `raza` (
  `idraza` int(11) NOT NULL,
  `nom_raza` varchar(50) NOT NULL,
  `idespecie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `raza`
--

INSERT INTO `raza` (`idraza`, `nom_raza`, `idespecie`) VALUES
(1, 'Pitbull', 1),
(2, 'Persa', 2),
(3, 'Pastor Aleman', 1),
(4, 'Labrador', 1),
(5, 'Poodle', 1),
(6, 'Siamés', 2),
(7, 'Bengala', 2),
(8, 'Ragdoll', 2),
(9, 'Chihuahua', 1),
(10, 'YorkShire', 1),
(11, 'Pug', 1),
(12, 'Schnauzer', 1),
(13, 'Raza Test', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `idservicio` int(11) NOT NULL,
  `nom_servicio` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`idservicio`, `nom_servicio`, `estado`) VALUES
(1, 'Corte de pelo', 0),
(2, 'Baño y aseo completo', 1),
(3, 'Tratamientos antipulgas y desparasitación', 1),
(4, 'Baños medicados para problemas de piel', 0),
(5, 'Higiene dental y limpieza de dientes', 1),
(6, 'Tratamientos de spa para mascotas, como masajes relajantes', 0),
(7, 'Tintes para el pelaje de mascotas no tóxicos y seguros', 1),
(8, 'Tratamientos específicos para el cuidado del pelaje, como acondicionadores y mascarillas', 1),
(9, 'nUEVO SERVICIO', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

CREATE TABLE `sesion` (
  `idsesion` int(11) NOT NULL,
  `key_ses` varchar(128) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fexpiracion_ses` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sesion`
--

INSERT INTO `sesion` (`idsesion`, `key_ses`, `idusuario`, `fexpiracion_ses`) VALUES
(28, '7029df142294110e7588e33bb403222eaf406c89497a0e327ea5e1023bda4a87', 1, '2023-07-06 11:17:29'),
(29, 'ac051fee29306c0e0459a27b5ceb6d419dad46544700afd494b2c6d285fa979a', 1, '2023-07-06 13:55:33'),
(32, '36300a4df03cd7ee6abf933dd51fc52e59e1c3836404e336ca7a06f536081be3', 1, '2023-07-06 20:37:25'),
(41, '1bcc36b5b958ba98b6b8bb01944a4aca43a4c54d0dbcc0c07b95719692a01af9', 1, '2023-07-07 10:02:55'),
(42, '5ad7f13674e39e3d7cafde18c5609e1505e20f7d5c875dbe0bf4d1946b0318dc', 1, '2023-07-07 14:04:08'),
(43, '1b63eceae8118f21c291c3a3c9ecf71e582a620a99a4ffc7fdd639c17652cdc6', 1, '2023-07-07 22:32:27'),
(44, '2f099751fbf148f3c51e8ab6a5c8bd3adb975e8c1ceba6808b1c4c6e77ad02ff', 1, '2023-07-09 12:09:41'),
(49, '39b03ec20c8dbe097b7d459609e916e5e3b01173dd9b91481edabe9fdc513683', 1, '2023-07-18 19:04:26'),
(52, 'b3a86ca136561c72a8be1e7316272393a8a477ea2a8dc9078cc5811929106087', 1, '2023-07-19 11:49:11'),
(53, 'd6026eb6a1fa924fc1c7a35de77a6aca8338a4ea8724bb563e7163bd550c337e', 1, '2023-07-19 12:12:44'),
(54, '31d59e1209d8108ab82cdad4daeb91f73d99973b042069b03c5fc073deb89a1b', 1, '2023-07-19 14:02:22'),
(57, '150f8b60213b87a62f38337308e59c6ae2901c283219148ca59bd6f670b770d0', 1, '2023-07-19 17:27:17'),
(59, '7852730f764aec123a0e7cb915c0f922fea67adf0548bde2fef287dff90c9228', 1, '2023-07-19 18:33:35'),
(60, '4dfbfafb23d0fbc206a3be0c683bccccf1b8bff59ea4712ccadb4cff8afbc176', 1, '2023-07-19 19:34:08'),
(61, 'bcfcecebb37e81f4322153b7de8d18f92611b1622cae42bbf5dacda9b1a03ec3', 1, '2023-07-20 00:06:48'),
(64, 'dfcaf1e2b37a26d792f375ede6db1e940cc2be6a543091e14857e1ca4ed5e518', 1, '2023-07-20 12:42:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamiento`
--

CREATE TABLE `tratamiento` (
  `idtratamiento` int(11) NOT NULL,
  `nom_tratamiento` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `ape_usuario` varchar(100) NOT NULL,
  `nom_usuario` varchar(100) NOT NULL,
  `dni_usuario` varchar(8) NOT NULL,
  `direccion_usuario` varchar(200) NOT NULL,
  `nacimiento_usuario` date NOT NULL,
  `telefono_usuario` varchar(20) NOT NULL,
  `correo_usuario` varchar(50) NOT NULL,
  `contrato_usuario` varchar(50) NOT NULL,
  `idarea` int(11) NOT NULL,
  `usu_usuario` varchar(100) NOT NULL,
  `pass_usuario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `ape_usuario`, `nom_usuario`, `dni_usuario`, `direccion_usuario`, `nacimiento_usuario`, `telefono_usuario`, `correo_usuario`, `contrato_usuario`, `idarea`, `usu_usuario`, `pass_usuario`) VALUES
(1, 'Admin', 'Admin', '88888888', 'Lima', '1990-01-01', '123123123', 'test@test.com', 'TP', 1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918'),
(2, 'Robles', 'Alan', '123124', 'Lima', '1990-01-01', '1512341', 'prueb@gmail.com', 'TP', 2, 'admin2', '1c142b2d01aa34e9a36bde480645a57fd69e14155dacfab5a3f9257b77fdc8d8');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_area`
--

CREATE TABLE `usuario_area` (
  `idusuario_area` int(11) NOT NULL,
  `nom_area` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_area`
--

INSERT INTO `usuario_area` (`idusuario_area`, `nom_area`) VALUES
(1, 'Administrador'),
(2, 'Veterinario'),
(3, 'Recepcionista'),
(4, 'Empleado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `atencion`
--
ALTER TABLE `atencion`
  ADD PRIMARY KEY (`idatencion`);

--
-- Indices de la tabla `atencion_servicio`
--
ALTER TABLE `atencion_servicio`
  ADD PRIMARY KEY (`idatencion_servicio`);

--
-- Indices de la tabla `atencion_tipo`
--
ALTER TABLE `atencion_tipo`
  ADD PRIMARY KEY (`idatencion_tipo`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`idconsulta`);

--
-- Indices de la tabla `especie`
--
ALTER TABLE `especie`
  ADD PRIMARY KEY (`idespecie`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`idestado`);

--
-- Indices de la tabla `esterilizacion`
--
ALTER TABLE `esterilizacion`
  ADD PRIMARY KEY (`idesterilizacion`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`idmascota`);

--
-- Indices de la tabla `raza`
--
ALTER TABLE `raza`
  ADD PRIMARY KEY (`idraza`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`idservicio`);

--
-- Indices de la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD PRIMARY KEY (`idsesion`);

--
-- Indices de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  ADD PRIMARY KEY (`idtratamiento`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- Indices de la tabla `usuario_area`
--
ALTER TABLE `usuario_area`
  ADD PRIMARY KEY (`idusuario_area`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `atencion`
--
ALTER TABLE `atencion`
  MODIFY `idatencion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `atencion_servicio`
--
ALTER TABLE `atencion_servicio`
  MODIFY `idatencion_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `atencion_tipo`
--
ALTER TABLE `atencion_tipo`
  MODIFY `idatencion_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `consulta`
--
ALTER TABLE `consulta`
  MODIFY `idconsulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `especie`
--
ALTER TABLE `especie`
  MODIFY `idespecie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `idestado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `esterilizacion`
--
ALTER TABLE `esterilizacion`
  MODIFY `idesterilizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `idmascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `raza`
--
ALTER TABLE `raza`
  MODIFY `idraza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `idservicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `sesion`
--
ALTER TABLE `sesion`
  MODIFY `idsesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  MODIFY `idtratamiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario_area`
--
ALTER TABLE `usuario_area`
  MODIFY `idusuario_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
