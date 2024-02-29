-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-12-2021 a las 08:41:10
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.9
create database card;
use card;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `card`
--



-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL auto_increment,
  `usuario` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- Crear la tabla `adm` con la clave foránea de `usuarios` y `vendedor`
CREATE TABLE `adm` (
  `id` int(11) NOT NULL auto_increment,
  `usuario` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
 
  PRIMARY KEY (`id`),
  CONSTRAINT `adm_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `adm` (`id`, `usuario`, `nombre`, `clave`) VALUES
(2, 'adm', 'Angel Sifuentes', '21232f297a57a5a743894a0e4a801fc3');



-- Estructura de tabla para la tabla `busqueda`
CREATE TABLE `busqueda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `termino` varchar(255) NOT NULL,
  `tipo` varchar(50) NOT NULL, -- Tipo de búsqueda, por ejemplo, "producto" o "categoria"
  `resultado_id` int(11) DEFAULT NULL, -- ID del producto o categoría relacionado
  `resultado_nombre` varchar(255) DEFAULT NULL, -- Nombre del producto o categoría relacionado
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Estructura de tabla para la tabla `categorias`
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) NOT NULL,
  `busqueda_id` int(11) DEFAULT NULL, -- ESTO PARECE QUE LLAMA A OTRA CLASE BUQUEDA   
  PRIMARY KEY (`id`),
  CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`busqueda_id`) REFERENCES `busqueda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
---- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `comentario_id` int(11) NOT NULL,
  `parent_comentario_id` int(11) DEFAULT NULL,
  `comment` varchar(200) CHARACTER SET latin1 NOT NULL,
  `comment_sender_name` varchar(40) CHARACTER SET latin1 NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla Comentarios';

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`comentario_id`, `parent_comentario_id`, `comment`, `comment_sender_name`, `date`) VALUES
(4, 0, 'Me encanta el diseño de los dormitorios de verano', 'Luisa Maron', '2023-03-23 04:50:37'),
(5, 0, 'sus sillas premiun correa son exelentes para un dia de churrasco', 'Claudia Guillen', '2023-03-23 05:09:48'),
(6, 0, '  Excelente gustos, muchas gracias ', 'Pedro infante', '2022-04-26 05:36:39'),
(7, 6, '  Por nada a la orden', 'Juan carlos', '2022-04-26 05:37:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `megusta_nomegusta`
--

CREATE TABLE `megusta_nomegusta` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `comentario_id` int(11) NOT NULL,
  `like_unlike` int(2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `megusta_nomegusta`
--

INSERT INTO `megusta_nomegusta` (`id`, `member_id`, `comentario_id`, `like_unlike`, `date`) VALUES
(2, 1, 3, 1, '2018-03-22 23:09:56'),
(3, 1, 5, 1, '2018-03-22 23:09:52'),
(4, 1, 4, 1, '2018-03-22 23:09:53'),
(5, 1, 6, 1, '2022-04-25 22:37:04'),
(6, 1, 7, 1, '2022-04-25 22:37:26');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`comentario_id`);

--
-- Indices de la tabla `megusta_nomegusta`
--
ALTER TABLE `megusta_nomegusta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `comentario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `megusta_nomegusta`
--
ALTER TABLE `megusta_nomegusta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;
-- FIN COMENTARIO


INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'Tecnologia'),
(2, 'Bebidas'),
(3, 'Muebles'),
(4, 'dormitorios');

-- --------------------------------------------------------


-- Estructura de tabla para la tabla `resenas`
CREATE TABLE `reseñas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `calificacion` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `fecha_reseña` date NOT NULL,
  `categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `reseñas_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio_normal` decimal(10,2) NOT NULL,
  `precio_rebajado` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





-- Estructura de tabla para la tabla `ofertas`
CREATE TABLE `ofertas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_inicio` date NOT NULL,
  `fecha_finalizacion` date NOT NULL,
  `porcentaje_descuento` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `ofertas_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- tabla carrito--
CREATE TABLE `carrito` (
  `id` int(11) NOT NULL auto_increment,
  `usuario_id` int(11) NOT NULL,
  `producto` varchar(50) NOT NULL,
  `precio` decimal(10, 2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `sub_total` decimal(10, 2) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- Crear la tabla 'detalle_producto' con las claves foráneas de 'carrito' y 'productos'
CREATE TABLE `detalle_producto` (
  `carrito_id` int(11) NOT NULL auto_increment,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`carrito_id`, `producto_id`),
  CONSTRAINT `detalle_producto_ibfk_1` FOREIGN KEY (`carrito_id`) REFERENCES `carrito` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_producto_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

