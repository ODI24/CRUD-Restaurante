-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-06-2024 a las 23:00:15
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurante`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_cargo` (IN `nombre` VARCHAR(25))   begin
INSERT INTO cargo (nombre_cargo) VALUES (nombre);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_cliente` (IN `nombre` VARCHAR(20), IN `apellido_p` VARCHAR(10), IN `apellido_m` VARCHAR(10), IN `telefono` BIGINT(20))   begin
INSERT INTO cliente(cliente.nombre, cliente.apellido_p, cliente.apellido_m, cliente.telefono) VALUES (nombre, apellido_p, apellido_m, telefono);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_ingrediente` (IN `nombre` VARCHAR(10), IN `cantidad` SMALLINT, IN `ult_ab` DATETIME)   begin
INSERT INTO ingredientes (nombre_ing, cantidad_ing, ultimo_abastecimiento) VALUES (nombre, cantidad, ult_ab);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_ing_preparacion` (IN `id_p` SMALLINT, IN `id_i` SMALLINT)   BEGIN
DECLARE existe_ing INT;
SELECT COUNT(*) INTO existe_ing FROM preparar_receta WHERE id_producto = id_p AND id_ing = id_i;
IF existe_ing = 0 THEN
INSERT INTO preparar_receta (id_producto, id_ing) VALUES (id_p, id_i);
ELSE
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El ingredeinte ya se a�adi� a la receta';
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_orden` (IN `nom` VARCHAR(20), IN `n_p` TINYINT UNSIGNED, IN `t` MEDIUMINT UNSIGNED, IN `cl` SMALLINT, IN `per` SMALLINT)   BEGIN
DECLARE fec_actual DATE;
DECLARE hr_actual TIME;
DECLARE nom_existe INT;
SET fec_actual = CURDATE();
SET hr_actual = CURTIME();
SELECT COUNT(*) INTO nom_existe FROM ordenar WHERE nombre = nom;
IF nom_existe = 0 THEN
IF cl IS NULL THEN
    INSERT INTO ordenar (nombre, personas, total, fecha, hora, cliente, personal) VALUES (nom, n_p, t, fec_actual, hr_actual, NULL, per);
ELSE
    INSERT INTO ordenar (nombre, personas, total, fecha, hora, cliente, personal) VALUES (nom, n_p, t, fec_actual, hr_actual, cl, per);
END IF;
ELSE
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Ya existe una orden con ese nombre';
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_personal` (IN `nombre` VARCHAR(50), IN `apellido` VARCHAR(50), IN `cargo` TINYINT, IN `username` VARCHAR(20), IN `password` VARCHAR(20))   BEGIN
INSERT INTO personal (nombre, apellido, cargo, username, password) VALUES (nombre, apellido, cargo, username, SHA2(password, 256));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_producto` (IN `nombre` VARCHAR(40), IN `descripcion` VARCHAR(100), IN `precio` SMALLINT UNSIGNED)   BEGIN
DECLARE existe_p INT;
SELECT COUNT(*) INTO existe_p FROM producto WHERE nombre_producto = nombre;
IF existe_p = 0 THEN
    INSERT INTO producto (nombre_producto, desc_producto, precio_producto) VALUES (nombre, descripcion, precio);
ELSE
	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Ya existe un producto con ese nombre';
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_producto_orden` (IN `o` MEDIUMINT UNSIGNED, IN `p` SMALLINT)   BEGIN
INSERT INTO pedir (orden, producto) VALUES (o, p);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_ip` (IN `producto` SMALLINT, IN `ing` SMALLINT)   BEGIN
DELETE FROM preparar_receta WHERE id_producto = producto AND id_ing = ing;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_po` (IN `orden` MEDIUMINT UNSIGNED, IN `producto` SMALLINT)   BEGIN
DECLARE id INT UNSIGNED;
SELECT p.id_pedir INTO id FROM pedir p WHERE p.orden = orden AND p.producto = producto LIMIT 1;
IF id THEN
DELETE FROM pedir WHERE id_pedir = id;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_producto` (IN `id` SMALLINT)   begin
DELETE FROM producto WHERE id_producto = id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `secret_psw` (IN `id` TINYINT)   BEGIN
DECLARE psw VARCHAR(20);
SELECT password INTO psw FROM personal WHERE personal_id = id;
UPDATE personal SET password = SHA2(password, 256) WHERE personal_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_precio_total` (IN `orden` MEDIUMINT UNSIGNED)   BEGIN
DECLARE precio_t MEDIUMINT UNSIGNED;
SELECT SUM(p.precio_producto) INTO precio_t FROM pedir pe JOIN producto p ON p.id_producto = pe.producto WHERE pe.orden = orden;
UPDATE ordenar SET total = total + precio_t WHERE id = orden;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `pk_cargo` tinyint(4) NOT NULL,
  `nombre_cargo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`pk_cargo`, `nombre_cargo`) VALUES
(1, 'mesero'),
(2, 'cocinero'),
(3, 'garrotero'),
(4, 'lava platos'),
(5, 'personal de limpieza'),
(6, 'encargado de cocina'),
(7, 'encargado de meseros'),
(8, 'recursos humanos'),
(9, 'barista'),
(10, 'encargado de barra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `n_cliente` smallint(6) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido_p` varchar(20) NOT NULL,
  `apellido_m` varchar(20) NOT NULL,
  `telefono` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`n_cliente`, `nombre`, `apellido_p`, `apellido_m`, `telefono`) VALUES
(0, 'Cliente', 'Desconocido', 'No', 0),
(1, 'Juan', 'Chavez', 'Rodrigo', 3000000000),
(2, 'Maria', 'Rodriguez', 'Lopez', 3357879546),
(3, 'Pedro', 'Gonzalez', 'Martinez', 3357877410),
(4, 'Ana', 'D?az', 'Hernandez', 3451789642),
(5, 'Carlos', 'Sanchez', 'Ramirez', 3345879612),
(6, 'Laura', 'Gomez', 'Torres', 3345879652),
(7, 'Jorge', 'Castro', 'Reyes', 3654791210),
(8, 'Patricia', 'Flores', 'Nunez', 3664789526),
(9, 'Miguel', 'Ruiz', 'Jimenez', 3664789528),
(10, 'Alejandra', 'Mendez', 'Alvarez', 366478954);

--
-- Disparadores `cliente`
--
DELIMITER $$
CREATE TRIGGER `check_delete_cliente` BEFORE DELETE ON `cliente` FOR EACH ROW BEGIN
DECLARE cont INT;
SELECT COUNT(*) INTO cont FROM ordenar WHERE cliente = OLD.n_cliente;
IF cont > 0 THEN
DELETE FROM ordenar WHERE cliente = OLD.n_cliente;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes`
--

CREATE TABLE `ingredientes` (
  `id_ing` smallint(6) NOT NULL,
  `nombre_ing` varchar(20) NOT NULL,
  `cantidad_ing` smallint(6) NOT NULL,
  `ultimo_abastecimiento` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingredientes`
--

INSERT INTO `ingredientes` (`id_ing`, `nombre_ing`, `cantidad_ing`, `ultimo_abastecimiento`) VALUES
(1, 'Papas', 200, '2024-06-03 09:00:00'),
(2, 'cafe', 30, '0000-00-00 00:00:00'),
(3, 'agua', 20, '0000-00-00 00:00:00'),
(4, 'tocino', 30, '0000-00-00 00:00:00'),
(5, 'bistec', 30, '0000-00-00 00:00:00'),
(6, 'huevo', 50, '0000-00-00 00:00:00'),
(7, 'sal', 10, '0000-00-00 00:00:00'),
(8, 'aceite', 20, '0000-00-00 00:00:00'),
(9, 'lechuga', 5, '0000-00-00 00:00:00'),
(10, 'jitomate', 10, '0000-00-00 00:00:00'),
(11, 'cebolla', 10, '0000-00-00 00:00:00');

--
-- Disparadores `ingredientes`
--
DELIMITER $$
CREATE TRIGGER `check_delete_ing` BEFORE DELETE ON `ingredientes` FOR EACH ROW BEGIN
DECLARE cont INT;
SELECT COUNT(*) INTO cont FROM preparar_receta WHERE id_ing = OLD.id_ing;
IF cont > 0 THEN
DELETE FROM preparar_receta WHERE id_ing = OLD.id_ing;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenar`
--

CREATE TABLE `ordenar` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `personas` tinyint(3) UNSIGNED DEFAULT NULL,
  `total` mediumint(8) UNSIGNED DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `cliente` smallint(6) DEFAULT NULL,
  `personal` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ordenar`
--

INSERT INTO `ordenar` (`id`, `nombre`, `personas`, `total`, `fecha`, `hora`, `cliente`, `personal`) VALUES
(3, 'Mesa 1', 25, 230, '2024-05-26', '22:45:33', 1, 3),
(4, 'mesa 2', 3, 195, '2024-05-26', '22:45:50', 2, 3),
(5, 'mesa 3', 1, 0, '2024-05-26', '22:46:07', 3, 3),
(6, 'mesa 4', 5, 0, '2024-05-26', '22:47:05', 4, 4),
(7, 'mesa 5', 2, 0, '2024-05-26', '22:47:19', 5, 4),
(8, 'mesa 6', 2, 0, '2024-05-26', '22:47:27', 6, 4),
(9, 'mesa 7', 2, 0, '2024-05-26', '22:47:34', 7, 4),
(10, 'mesa 8', 3, 0, '2024-05-26', '22:47:42', 8, 4),
(11, 'mesa 9', 3, 0, '2024-05-26', '22:47:49', 9, 4),
(12, 'p/llevar 1', 3, 155, '2024-05-26', '22:48:04', 10, 4),
(18, 'Mesa 15', 1, 75, '2024-06-03', '12:36:32', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_cliente`
--

CREATE TABLE `orden_cliente` (
  `orden` mediumint(8) UNSIGNED NOT NULL,
  `cliente` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orden_cliente`
--

INSERT INTO `orden_cliente` (`orden`, `cliente`) VALUES
(5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedir`
--

CREATE TABLE `pedir` (
  `orden` mediumint(8) UNSIGNED NOT NULL,
  `producto` smallint(6) NOT NULL,
  `id_pedir` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedir`
--

INSERT INTO `pedir` (`orden`, `producto`, `id_pedir`) VALUES
(3, 1, 1),
(3, 3, 3),
(4, 1, 4),
(4, 2, 5),
(4, 4, 6),
(12, 6, 7),
(12, 8, 8),
(12, 9, 9),
(12, 10, 10),
(3, 1, 11),
(4, 10, 12),
(18, 1, 14);

--
-- Disparadores `pedir`
--
DELIMITER $$
CREATE TRIGGER `actualizar_total_orden_add` AFTER INSERT ON `pedir` FOR EACH ROW BEGIN
DECLARE precio_p SMALLINT UNSIGNED; 
SELECT precio_producto INTO precio_p FROM producto WHERE id_producto = NEW.producto;
UPDATE ordenar SET total = total + precio_p WHERE id = NEW.orden;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `actualizar_total_orden_sub` BEFORE DELETE ON `pedir` FOR EACH ROW BEGIN
DECLARE precio_p SMALLINT UNSIGNED;
SELECT precio_producto INTO precio_p FROM producto WHERE id_producto = OLD.producto;
UPDATE ordenar SET total = total - precio_p WHERE id = OLD.orden;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `personal_id` tinyint(4) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `cargo` tinyint(4) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`personal_id`, `nombre`, `apellido`, `cargo`, `username`, `password`) VALUES
(1, 'Rodrigo', 'Rivera', 7, 'RR10', '03ac674216f3e15c761e'),
(2, 'Alex', 'Torres', 2, 'AT2', '03ac674216f3e15c761e'),
(3, 'Diego', 'Perez', 1, 'DP3', '03ac674216f3e15c761e'),
(4, 'Shamuel', 'Liliel', 7, 'SL4', '03ac674216f3e15c761e'),
(5, 'Noah', 'Lee', 6, 'NL5', '03ac674216f3e15c761e'),
(6, 'Braulio', 'Vargas', 3, 'BV6', '03ac674216f3e15c761e'),
(7, 'Odilon', 'Andrew', 4, 'OA7', '03ac674216f3e15c761e'),
(8, 'Roberto', 'Batista', 5, 'RB8', '03ac674216f3e15c761e'),
(9, 'Ramiro', 'Escalante', 8, 'RE9', '03ac674216f3e15c761e'),
(10, 'Maria', 'Rivera', 9, 'MR10', '03ac674216f3e15c761e'),
(12, 'Asta', 'Clover', 1, 'AC200', '7daa1d1b763802511451');

--
-- Disparadores `personal`
--
DELIMITER $$
CREATE TRIGGER `check_delete_personal` BEFORE DELETE ON `personal` FOR EACH ROW BEGIN
DECLARE cont INT;
SELECT COUNT(*) INTO cont FROM ordenar WHERE personal = OLD.personal_id;
IF cont > 0 THEN
DELETE FROM ordenar WHERE personal = OLD.personal_id;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preparar_receta`
--

CREATE TABLE `preparar_receta` (
  `id_producto` smallint(6) NOT NULL,
  `id_ing` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preparar_receta`
--

INSERT INTO `preparar_receta` (`id_producto`, `id_ing`) VALUES
(1, 1),
(1, 6),
(2, 4),
(2, 6),
(2, 7),
(4, 2),
(4, 3),
(6, 9),
(6, 10),
(6, 11),
(7, 11),
(9, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` smallint(6) NOT NULL,
  `nombre_producto` varchar(40) NOT NULL,
  `desc_producto` varchar(100) DEFAULT NULL,
  `precio_producto` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre_producto`, `desc_producto`, `precio_producto`) VALUES
(1, 'Huevo con tortilla', 'Huevo con tortilla', 75),
(2, 'huevo con tocino', 'huevo con tocino y sal (revuelto o estrellado)', 80),
(3, 'huevo a la mexicana', 'huevo con jitomate y cebolla', 80),
(4, 'cafe americano', 'el clasico cafe americano', 20),
(5, 'cafe con leche', 'cafe americano con leche', 25),
(6, 'ensalada basica', 'lechuga, jitomate y cebolla', 50),
(7, 'huevo basico', 'simplemente 2 piezas de huevo al gusto', 50),
(8, 'agua fresca', 'vaso de agua de sabor', 15),
(9, 'huevo con papa', 'huevo al gusto con papas', 70),
(10, 'quesadilla', 'quesadilla sencilla', 20);

--
-- Disparadores `producto`
--
DELIMITER $$
CREATE TRIGGER `check_delete_producto` BEFORE DELETE ON `producto` FOR EACH ROW begin
DECLARE CONTADOR_RECETA INT;
DECLARE CONTADOR_PEDIR INT;
SELECT COUNT(*) INTO CONTADOR_RECETA FROM preparar_receta WHERE id_producto = OLD.id_producto;
SELECT COUNT(*) INTO CONTADOR_PEDIR FROM pedir WHERE producto = OLD.id_producto;
IF CONTADOR_RECETA > 0 THEN
DELETE FROM preparar_receta WHERE id_producto = OLD.id_producto;
END IF;
IF CONTADOR_PEDIR > 0 THEN
DELETE FROM pedir WHERE producto = OLD.id_producto;
END IF;
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`pk_cargo`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`n_cliente`);

--
-- Indices de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`id_ing`);

--
-- Indices de la tabla `ordenar`
--
ALTER TABLE `ordenar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `personal` (`personal`),
  ADD KEY `ordenar_ibfk_1` (`cliente`);

--
-- Indices de la tabla `orden_cliente`
--
ALTER TABLE `orden_cliente`
  ADD PRIMARY KEY (`orden`,`cliente`),
  ADD KEY `cliente` (`cliente`);

--
-- Indices de la tabla `pedir`
--
ALTER TABLE `pedir`
  ADD PRIMARY KEY (`id_pedir`),
  ADD KEY `producto` (`producto`),
  ADD KEY `orden` (`orden`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`personal_id`),
  ADD KEY `cargo` (`cargo`);

--
-- Indices de la tabla `preparar_receta`
--
ALTER TABLE `preparar_receta`
  ADD PRIMARY KEY (`id_producto`,`id_ing`),
  ADD KEY `id_ing` (`id_ing`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `nombre_producto` (`nombre_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `pk_cargo` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `n_cliente` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `id_ing` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `ordenar`
--
ALTER TABLE `ordenar`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `pedir`
--
ALTER TABLE `pedir`
  MODIFY `id_pedir` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `personal_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ordenar`
--
ALTER TABLE `ordenar`
  ADD CONSTRAINT `ordenar_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`n_cliente`) ON DELETE SET NULL,
  ADD CONSTRAINT `ordenar_ibfk_2` FOREIGN KEY (`personal`) REFERENCES `personal` (`personal_id`);

--
-- Filtros para la tabla `orden_cliente`
--
ALTER TABLE `orden_cliente`
  ADD CONSTRAINT `orden_cliente_ibfk_1` FOREIGN KEY (`orden`) REFERENCES `ordenar` (`id`),
  ADD CONSTRAINT `orden_cliente_ibfk_2` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`n_cliente`);

--
-- Filtros para la tabla `pedir`
--
ALTER TABLE `pedir`
  ADD CONSTRAINT `pedir_ibfk_1` FOREIGN KEY (`orden`) REFERENCES `ordenar` (`id`),
  ADD CONSTRAINT `pedir_ibfk_2` FOREIGN KEY (`producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`cargo`) REFERENCES `cargo` (`pk_cargo`);

--
-- Filtros para la tabla `preparar_receta`
--
ALTER TABLE `preparar_receta`
  ADD CONSTRAINT `preparar_receta_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `preparar_receta_ibfk_2` FOREIGN KEY (`id_ing`) REFERENCES `ingredientes` (`id_ing`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
