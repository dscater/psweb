-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 02-05-2024 a las 22:57:34
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `psweb_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint UNSIGNED NOT NULL,
  `num_cli` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_cli` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nit_ci` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `num_cli`, `nom_cli`, `nit_ci`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'S/N', '0', 1, 1, '2019-04-19 14:46:37', '2019-04-19 14:46:37'),
(2, '2', 'PERES', '12345678', 4, 1, '2019-04-22 01:58:35', '2019-04-22 01:58:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_usuarios`
--

CREATE TABLE `datos_usuarios` (
  `id` bigint UNSIGNED NOT NULL,
  `nom_u` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apep_u` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apem_u` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ci_u` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci_exp_u` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nac_u` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `genero_u` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir_dpto_u` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir_ciudad_u` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir_zv_u` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir_ac_u` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir_num_u` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fono_u` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cel_u` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_u` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_u` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_reg` date NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `datos_usuarios`
--

INSERT INTO `datos_usuarios` (`id`, `nom_u`, `apep_u`, `apem_u`, `ci_u`, `ci_exp_u`, `fecha_nac_u`, `genero_u`, `dir_dpto_u`, `dir_ciudad_u`, `dir_zv_u`, `dir_ac_u`, `dir_num_u`, `fono_u`, `cel_u`, `email_u`, `foto_u`, `fecha_reg`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'CARLOS', 'QUISPE', 'QUISPE', '12345678', 'LP', '1985-03-22', 'M', 'LA PAZ', 'LA PAZ', 'ZONA LOS OLIVOS', 'CALLE LOS HEROES', '15', '231567', '78945612', NULL, '155144470011001CARLOS.jpg', '2019-04-08', 2, '2019-04-12 17:30:26', '2019-04-12 17:30:26'),
(2, 'JHONNY', 'CARVAJAL', 'MAMANI', '12345678', 'LP', '1990-06-22', 'M', 'LA PAZ', 'LA PAZ', 'LAS LOMAS', 'CALLE BOLIVAR', '23', '232367', '78994612', NULL, '155144470121002JHONNY.jpg', '2019-04-08', 3, '2019-04-12 17:30:26', '2019-04-12 17:30:26'),
(3, 'PATRICIA', 'CONDORI', 'RAMOS', '12345678', 'LP', '1994-11-04', 'F', 'LA PAZ', 'LA PAZ', 'ZONA LOS PEDREGALES', 'CALLE 5', '155', '2315567', '78946912', NULL, '1551444702331003PATRICIA.jpg', '2019-04-08', 4, '2019-04-12 17:30:26', '2019-04-12 17:30:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` bigint UNSIGNED NOT NULL,
  `cod` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nit` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nro_aut` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nro_emp` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pais` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dpto` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ciudad` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zona` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `calle` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nro` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fono` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `casilla` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `actividad_eco` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `cod`, `nit`, `nro_aut`, `nro_emp`, `name`, `alias`, `pais`, `dpto`, `ciudad`, `zona`, `calle`, `nro`, `email`, `fono`, `cel`, `fax`, `casilla`, `web`, `logo`, `actividad_eco`, `created_at`, `updated_at`) VALUES
(1, 'EMP01', '1231564564', '2315674898', '6666544555', 'INSTITUCION PRUEBA', 'I.P.', 'BOLIVIA', 'LA PAZ', 'LA PAZ', 'LOS OLIVOS', 'LOS HEROES', '233', '', '2316489', '68465315', '', '', '', 'logo.jpg', 'VENTA DE PRODUCTOS POR MAYOR Y MENOR', '2019-04-12 17:30:28', '2019-04-12 17:30:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `id` bigint UNSIGNED NOT NULL,
  `tipo_nom` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `proveedor_id` bigint UNSIGNED NOT NULL,
  `producto_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `precio_uni` decimal(24,2) NOT NULL,
  `cantidad` int UNSIGNED NOT NULL,
  `precio_total` decimal(24,2) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nro_aut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nro_fac` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nro_rec` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`id`, `tipo_nom`, `proveedor_id`, `producto_id`, `user_id`, `precio_uni`, `cantidad`, `precio_total`, `descripcion`, `codigo`, `nro_aut`, `nro_fac`, `nro_rec`, `fecha_ingreso`, `created_at`, `updated_at`) VALUES
(1, 'INGRESO NUEVOS PRODUCTOS', 1, 1, 1, 70.50, 1, 70.50, 'INGRESO NUEVOS PRODUCTOS', '44-F4-41-11-3E', '1231564894', '1112223', '1123', '2019-04-16', '2019-04-16 04:24:38', '2019-04-16 04:24:38'),
(2, 'INGRESO NUEVOS PRODUCTOS', 1, 1, 1, 70.50, 1, 70.50, 'INGRESO NUEVOS PRODUCTOS', '44-F4-41-11-3E', '1231564894', '1112223', '11223', '2019-04-16', '2019-04-16 04:28:18', '2019-04-16 04:28:18'),
(3, 'INGRESO NUEVOS PRODUCTOS', 1, 1, 1, 70.50, 1, 70.50, 'INGRESO NUEVOS PRODUCTOS', '44-F4-41-11-3E', '1231564894', '1112223', '12399', '2019-04-16', '2019-04-16 19:05:24', '2019-04-16 19:05:24'),
(4, 'INGRESO NUEVOS PRODUCTOS', 2, 2, 1, 49.00, 1, 49.00, 'INGRESO NUEVOS PRODUCTOS', '1A-4D-51-11-3E', '1231561899', '12123556', '1400', '2019-04-16', '2019-04-17 00:05:36', '2019-04-17 00:05:36'),
(5, 'INGRESO NUEVOS PRODUCTOS', 2, 2, 1, 49.00, 1, 49.00, 'INGRESO NUEVOS PRODUCTOS', '1A-4D-51-11-3E', '1231561899', '12123556', '14555', '2019-04-16', '2019-04-17 00:06:33', '2019-04-17 00:06:33'),
(6, 'INGRESO NUEVOS PRODUCTOS', 2, 2, 1, 49.00, 1, 49.00, 'INGRESO NUEVOS PRODUCTOS', '1A-4D-51-11-3E', '1231561899', '12123556', '155', '2019-04-16', '2019-04-17 00:06:47', '2019-04-17 00:06:47'),
(7, 'INGRESO NUEVOS PRODUCTOS', 1, 1, 1, 70.50, 1, 70.50, 'INGRESO NUEVOS PRODUCTOS', '4A-4E-A1-F1-3E', '1231564894', '231231225', '1234', '2019-04-18', '2019-04-18 15:59:47', '2019-04-18 15:59:47'),
(8, 'INGRESO NUEVOS PRODUCTOS', 2, 2, 1, 49.00, 1, 49.00, 'INGRESO NUEVOS PRODUCTOS', '11-F1-A3-F1-22', '1231561899', '22233300001', '1232', '2019-04-18', '2019-04-18 16:00:00', '2019-04-18 16:00:00'),
(9, 'INGRESO NUEVOS PRODUCTOS', 1, 1, 1, 70.50, 1, 70.50, 'INGRESO NUEVOS PRODUCTOS', '11-4F-A3-F1-3F', '1231564894', '1231561899', '123132', '2019-04-20', '2019-04-20 16:02:47', '2019-04-20 16:02:47'),
(10, 'INGRESO NUEVOS PRODUCTOS', 1, 1, 1, 70.50, 1, 70.50, 'INGRESO NUEVOS PRODUCTOS', '44-D1-S1-11-33', '1231564894', '12345644444', '1500', '2019-04-21', '2019-04-21 14:08:26', '2019-04-21 14:08:26'),
(11, 'INGRESO NUEVOS PRODUCTOS', 2, 2, 1, 49.00, 1, 49.00, 'INGRESO NUEVOS PRODUCTOS', '44-B1-C2-33-2A', '1231561899', '123456489', '1566', '2019-04-21', '2019-04-21 14:26:46', '2019-04-21 14:26:46'),
(12, 'INGRESO NUEVOS PRODUCTOS', 2, 2, 1, 50.00, 1, 50.00, 'INGRESO NUEVOS PRODUCTOS', '45-AF-22-33', '1231561899', '7894561', '54645', '2019-05-14', '2019-05-14 14:26:15', '2019-05-14 14:26:15'),
(13, 'INGRESO NUEVOS PRODUCTOS', 1, 1, 1, 70.00, 1, 70.00, 'INGRESO NUEVOS PRODUCTOS', 'A7-7F-88-U8-65', '1231564894', '52322', '0', '2021-12-13', '2021-12-14 02:39:52', '2021-12-14 02:39:52'),
(14, 'INGRESO NUEVOS PRODUCTOS', 1, 1, 1, 50.00, 1, 50.00, 'INGRESO NUEVOS PRODUCTOS', 'A7-99-3D-8J-33', '1231564894', '0', '0', '2022-09-12', '2022-09-13 01:59:11', '2022-09-13 01:59:11'),
(15, 'INGRESO NUEVOS PRODUCTOS', 1, 3, 1, 20.00, 1, 20.00, 'INGRESO NUEVOS PRODUCTOS', 'A6-33-F4-5J-9L', '1231564894', '0', '0', '2022-11-21', '2022-11-21 15:13:55', '2022-11-21 15:13:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` bigint UNSIGNED NOT NULL,
  `nom` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nom`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'MARCA 1', '', '2019-04-12 17:30:26', '2019-05-14 14:25:17'),
(2, 'MARCA 2', '', '2019-04-12 17:30:26', '2019-05-14 13:30:59'),
(3, 'MARCA 3', '', '2019-04-12 17:30:27', '2019-04-12 17:30:27'),
(4, 'MARCA 4', 'MARCA 4', '2019-04-12 17:31:16', '2019-04-23 22:43:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medidas`
--

CREATE TABLE `medidas` (
  `id` bigint UNSIGNED NOT NULL,
  `nom` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `simbolo` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `medidas`
--

INSERT INTO `medidas` (`id`, `nom`, `simbolo`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'UNIDADES', 'U', '', '2019-04-12 17:30:27', '2019-05-14 14:25:31'),
(2, 'METROS', 'M', '', '2019-04-12 17:30:27', '2019-04-12 17:30:27'),
(3, 'CENTIMETROS', 'CM', '', '2019-04-12 17:30:27', '2019-04-12 17:30:27'),
(4, 'KILOGRAMOS', 'KG', '', '2019-04-12 17:30:27', '2019-04-12 17:30:27'),
(5, 'GRAMOS', 'G', '', '2019-04-12 17:30:27', '2019-04-12 17:30:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(206, '2014_10_12_000000_create_users_table', 1),
(207, '2014_10_12_100000_create_password_resets_table', 1),
(208, '2019_04_08_140849_create_datos_usuarios_table', 1),
(209, '2019_04_08_140958_create_proveedors_table', 1),
(210, '2019_04_08_141025_create_marcas_table', 1),
(211, '2019_04_08_141026_create_medidas_table', 1),
(212, '2019_04_08_141027_create_tipos_table', 1),
(213, '2019_04_08_141028_create_productos_table', 1),
(214, '2019_04_08_150906_create_empresas_table', 1),
(215, '2019_04_08_151806_create_stocks_table', 1),
(216, '2019_04_08_151819_create_descuentos_table', 1),
(217, '2019_04_08_151820_create_clientes_table', 1),
(218, '2019_04_08_151821_create_ventas_table', 1),
(219, '2019_04_08_154225_detalle_ventas', 1),
(220, '2019_04_08_154252_tipo_ingreso_salida', 1),
(221, '2019_04_08_154253_create_ingresos_table', 1),
(222, '2019_04_08_154302_create_salidas_table', 1),
(223, '2019_04_11_133125_create_producto_rfids_table', 1),
(224, '2024_05_02_181306_create_modulos_table', 2),
(225, '2024_05_02_181317_create_user_modulos_table', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` bigint UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `titulo`, `url`, `icon`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Usuarios', 'users', 'people', 'users.index', '2024-05-02 22:40:34', '2024-05-02 22:40:34'),
(2, 'Pynes', 'proveedores', 'local_shipping', 'proveedores.index', '2024-05-02 22:40:34', '2024-05-02 22:40:34'),
(3, 'Productos', 'productos', 'local_offer', 'productos.index', '2024-05-02 22:40:34', '2024-05-02 22:40:34'),
(4, 'Tipos', 'tipos', 'view_list', 'tipos.index', '2024-05-02 22:40:34', '2024-05-02 22:40:34'),
(5, 'Marcas', 'marcas', 'bookmark', 'marcas.index', '2024-05-02 22:40:34', '2024-05-02 22:40:34'),
(6, 'Medidas', 'medidas', 'list', 'medidas.index', '2024-05-02 22:40:34', '2024-05-02 22:40:34'),
(7, 'Reportes', 'reportes', 'assessment', 'reportes.index', '2024-05-02 22:40:34', '2024-05-02 22:40:34'),
(8, 'Usuarios y Roles', 'usuarios_roles', 'view_list', 'usuarios_roles.index', '2024-05-02 22:40:34', '2024-05-02 22:40:34'),
(9, 'Autentiación Segura', 'autenticacion_seguras', 'view_list', 'autenticacion_seguras.index', '2024-05-02 22:40:34', '2024-05-02 22:40:34'),
(10, 'Autorización Adecuada', 'autenticacion_adecuadas', 'view_list', 'autenticacion_adecuadas.index', '2024-05-02 22:40:34', '2024-05-02 22:40:34'),
(11, 'Prevención de ataques', 'prevencion_ataques', 'view_list', 'prevencion_ataques.index', '2024-05-02 22:40:34', '2024-05-02 22:40:34'),
(12, 'Auditoría y registros de eventos', 'auditoria_eventos', 'view_list', 'auditoria_eventos.index', '2024-05-02 22:40:34', '2024-05-02 22:40:34'),
(13, 'Alertas y Notificaciones', 'alertas_notificacions', 'view_list', 'alertas_notificacions.index', '2024-05-02 22:40:34', '2024-05-02 22:40:34'),
(14, 'Respaldo y Recuperación', 'respaldo_recuperacion', 'view_list', 'respaldo_recuperacion.index', '2024-05-02 22:40:34', '2024-05-02 22:40:34'),
(15, 'Escaneo de vulnerabilidades', 'escaneo_vulnerabilidads', 'view_list', 'escaneo_vulnerabilidads.index', '2024-05-02 22:40:34', '2024-05-02 22:40:34'),
(16, 'Capacitación en Seguridad', 'capacitacion_seguridads', 'view_list', 'capacitacion_seguridads.index', '2024-05-02 22:40:34', '2024-05-02 22:40:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint UNSIGNED NOT NULL,
  `cod` varchar(155) NOT NULL,
  `nom` varchar(155) NOT NULL,
  `precio` decimal(24,2) NOT NULL,
  `descripcion` varchar(155) NOT NULL,
  `imagen` varchar(155) NOT NULL,
  `tipo_id` bigint UNSIGNED NOT NULL,
  `medida_id` bigint UNSIGNED NOT NULL,
  `marca_id` bigint UNSIGNED NOT NULL,
  `proveedor_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `fecha_reg` date NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `cod`, `nom`, `precio`, `descripcion`, `imagen`, `tipo_id`, `medida_id`, `marca_id`, `proveedor_id`, `user_id`, `fecha_reg`, `status`, `created_at`, `updated_at`) VALUES
(1, 'P0001', 'PRODUCTO 1', 75.50, 'DESCRIPCION 1', 'P0001PRODUCTO_11555075968.jpg', 1, 1, 1, 1, 1, '2019-05-14', 1, '2019-05-14 14:00:00', '2019-05-14 14:00:00'),
(2, 'P0002', 'PRODUCTO 2', 54.00, 'DESCRIPCION 2', 'P0002PRODUCTO_21555078959.png', 2, 1, 2, 2, 1, '2019-05-14', 1, '2019-05-14 14:25:47', '2019-05-14 14:25:47'),
(3, 'P0003', 'PRODUCTO 3', 20.00, 'PRODUCTO 3', 'P0003PRODUCTO_31669043558.jpg', 1, 1, 1, 1, 1, '2022-11-21', 1, '2022-11-21 15:12:38', '2022-11-21 15:12:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_rfids`
--

CREATE TABLE `producto_rfids` (
  `id` bigint UNSIGNED NOT NULL,
  `rfid` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `producto_id` bigint UNSIGNED NOT NULL,
  `estado` enum('VENDIDO','ALMACEN','SALIDA') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `producto_rfids`
--

INSERT INTO `producto_rfids` (`id`, `rfid`, `producto_id`, `estado`, `created_at`, `updated_at`) VALUES
(1, '0439534742', 1, 'SALIDA', '2019-04-16 04:24:38', '2019-04-16 05:37:52'),
(2, '0450410646', 1, 'VENDIDO', '2019-04-16 04:28:18', '2019-04-19 14:46:39'),
(3, '0446309030', 1, 'ALMACEN', '2019-04-16 19:05:24', '2019-04-17 02:03:19'),
(4, '0445810070', 2, 'VENDIDO', '2019-04-17 00:05:36', '2019-04-19 14:46:40'),
(5, '0442275478', 2, 'ALMACEN', '2019-04-17 00:06:33', '2019-04-17 19:39:05'),
(6, '0440567446', 2, 'ALMACEN', '2019-04-17 00:06:47', '2019-04-18 15:48:41'),
(7, '1234567890', 1, 'ALMACEN', '2019-04-18 15:59:47', '2019-04-18 16:01:46'),
(8, '9875643120', 2, 'SALIDA', '2019-04-18 16:00:00', '2019-04-20 16:39:10'),
(9, '1234561232', 1, 'SALIDA', '2019-04-20 16:02:47', '2019-04-20 16:28:50'),
(11, '9998887776', 1, 'ALMACEN', '2019-04-21 14:08:26', '2019-04-21 14:08:26'),
(12, '1112223334', 2, 'VENDIDO', '2019-04-21 14:26:46', '2019-04-22 01:58:35'),
(13, '9632589631', 2, 'ALMACEN', '2019-05-14 14:26:15', '2019-05-14 14:26:15'),
(14, '123456', 1, 'ALMACEN', '2021-12-14 02:39:51', '2021-12-14 02:39:51'),
(15, '1020309', 1, 'ALMACEN', '2022-09-13 01:59:11', '2022-09-13 01:59:11'),
(16, '0162755187', 3, 'ALMACEN', '2022-11-21 15:13:54', '2022-11-21 15:13:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedors`
--

CREATE TABLE `proveedors` (
  `id` bigint UNSIGNED NOT NULL,
  `razon_social_p` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nit_pro_p` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `numa_pro_p` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir_dpto_p` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir_ciudad_p` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir_zv_p` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir_ac_p` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir_nro_p` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fono_p` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fono_alt_p` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax_p` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_p` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web_p` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_p` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_rep_p` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apep_rep_p` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apem_rep_p` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cel_rep_p` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_reg_p` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedors`
--

INSERT INTO `proveedors` (`id`, `razon_social_p`, `nit_pro_p`, `numa_pro_p`, `dir_dpto_p`, `dir_ciudad_p`, `dir_zv_p`, `dir_ac_p`, `dir_nro_p`, `fono_p`, `fono_alt_p`, `fax_p`, `email_p`, `web_p`, `logo_p`, `nom_rep_p`, `apep_rep_p`, `apem_rep_p`, `cel_rep_p`, `fecha_reg_p`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PROVEEDOR 1', '23156489100', '1231564894', 'LA PAZ', 'LA PAZ', 'ZONA FERROVIARIA', 'CALLE GALARZA', '23', '2315642', '', '', '', '', '1231560PROVEEDOR_1.png', 'ELVIS', 'CHAVEZ', '', '68465312', '2019-04-08', 1, 1, '2019-04-12 17:30:27', '2019-05-14 13:41:54'),
(2, 'PROVEEDOR 2', '2315648963', '1231561899', 'COCHABAMBA', 'COCHABAMBA', 'ZONA BALLIVIAN', 'CALLE SIMON BOLIVAR', '233', '2316892', NULL, NULL, NULL, NULL, '12345690PROVEEDOR_2.png', 'MARIO', 'ALCANTARA', NULL, '68479651', '2019-04-08', 1, 1, '2019-04-12 17:30:27', '2019-04-12 17:30:27'),
(3, 'PROVEEDOR 3', '3216548963', '1236685499', 'LA PAZ', 'LA PAZ', 'LAS LOMAS', 'CALLE CHACON', '563', '2316892', NULL, NULL, NULL, NULL, '1234697PROVEEDOR_3.jpg', 'XIMENA', 'RAMOS', NULL, '68459851', '2019-04-08', 1, 1, '2019-04-12 17:30:27', '2019-04-12 17:30:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas`
--

CREATE TABLE `salidas` (
  `id` bigint UNSIGNED NOT NULL,
  `tipo_nom` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `producto_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `precio_uni` decimal(24,2) NOT NULL,
  `cantidad` int UNSIGNED NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_salida` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `salidas`
--

INSERT INTO `salidas` (`id`, `tipo_nom`, `producto_id`, `user_id`, `precio_uni`, `cantidad`, `descripcion`, `fecha_salida`, `created_at`, `updated_at`) VALUES
(1, 'SALIDA POR DEFECTOS', 1, 1, 70.50, 1, 'SALIDA POR DEFECTOS', '2019-04-16', '2019-04-16 05:37:52', '2019-04-16 05:37:52'),
(2, 'SALIDA POR DEFECTOS', 1, 1, 70.50, 1, 'SALIDA POR DEFECTOS EN EL LUGAR ....', '2019-04-20', '2019-04-20 16:28:50', '2019-04-20 16:28:50'),
(3, 'SALIDA POR DEFECTOS', 2, 1, 49.00, 1, 'SALIDA POR DEFECTO DE PRODUCTO', '2019-04-20', '2019-04-20 16:39:10', '2019-04-20 16:39:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint UNSIGNED NOT NULL,
  `cant_ingresos` int UNSIGNED NOT NULL,
  `cant_actual` int UNSIGNED NOT NULL,
  `cant_salidas` int UNSIGNED NOT NULL,
  `cant_min` int UNSIGNED NOT NULL,
  `fecha_movimiento` date NOT NULL,
  `fecha_reg` date NOT NULL,
  `producto_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `stocks`
--

INSERT INTO `stocks` (`id`, `cant_ingresos`, `cant_actual`, `cant_salidas`, `cant_min`, `fecha_movimiento`, `fecha_reg`, `producto_id`, `created_at`, `updated_at`) VALUES
(1, 8, 4, 4, 1, '2022-09-12', '2019-04-12', 1, '2019-04-12 17:32:48', '2022-09-13 01:59:11'),
(2, 6, 2, 4, 1, '2019-05-14', '2019-04-12', 2, '2019-04-12 18:22:39', '2019-05-14 14:26:15'),
(3, 1, 1, 0, 50, '2022-11-21', '2022-11-21', 3, '2022-11-21 15:12:39', '2022-11-21 15:13:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id` bigint UNSIGNED NOT NULL,
  `nom` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id`, `nom`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'TIPO 1', '', '2019-04-12 17:30:28', '2019-04-12 17:30:28'),
(2, 'TIPO 2', '', '2019-04-12 17:30:28', '2019-04-12 17:30:28'),
(3, 'TIPO 3', '', '2019-04-12 17:30:28', '2019-04-12 17:30:28'),
(4, 'TIPO 4', 'TIPO 4', '2019-04-12 17:31:08', '2019-04-12 17:31:08'),
(6, 'TIPO 5', '', '2019-04-23 22:39:55', '2019-04-23 22:39:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_ingreso_salida`
--

CREATE TABLE `tipo_ingreso_salida` (
  `id` bigint UNSIGNED NOT NULL,
  `nom` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_ingreso_salida`
--

INSERT INTO `tipo_ingreso_salida` (`id`, `nom`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'SALIDA POR DEFECTOS', '', '2019-04-12 17:30:27', '2019-04-16 06:00:19'),
(2, 'INGRESO NUEVOS PRODUCTOS', '', '2019-04-12 17:30:28', '2019-04-12 17:30:28'),
(3, 'INGRESO POR OTROS CONCEPTOS', '', '2019-04-12 17:30:28', '2019-04-12 17:30:28'),
(6, 'SALIDA NORMAL', '', '2019-04-16 06:04:33', '2019-04-16 06:04:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `tipo`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$uJHwzvmxIwqijYB5nTlVuOO8npHnO9JIs7keueraJ1NcIw1wLXMkW', 'ADMINISTRADOR', 'user_default.png', 1, '2019-04-12 17:30:25', '2019-04-12 17:30:25'),
(2, '11001', '$2y$10$RvsZ1161cm235JsyvVedyeboTkUMPdTEidIOZQQKDvqiu/NIGB5ni', 'ADMINISTRADOR', '11001CARLOS1555519819.jpg', 1, '2019-04-12 17:30:25', '2019-04-17 16:50:19'),
(3, '21002', '$2y$10$Z08AlHN8kMwOG.sxwUoB3eivgnVBO8Rb671.quyK8zqBwHb7Dn4Dm', 'ALMACENERO', 'user_default.png', 1, '2019-04-12 17:30:26', '2019-04-17 16:56:20'),
(4, '31003', '$2y$10$3LGSuYp2C.61QafN1f8/I.3h8huK/21HNEWYTz8BYtpfhuCpPObmS', 'CAJA', '31003PATRICIA1555520091.png', 1, '2019-04-12 17:30:26', '2019-04-17 16:54:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_modulos`
--

CREATE TABLE `user_modulos` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `modulo_id` bigint UNSIGNED NOT NULL,
  `listar` int NOT NULL,
  `crear` int NOT NULL,
  `editar` int NOT NULL,
  `eliminar` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user_modulos`
--

INSERT INTO `user_modulos` (`id`, `user_id`, `modulo_id`, `listar`, `crear`, `editar`, `eliminar`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, '2024-05-02 22:45:54', '2024-05-02 22:45:54'),
(2, 1, 2, 1, 1, 1, 1, '2024-05-02 22:45:54', '2024-05-02 22:45:54'),
(3, 1, 3, 1, 1, 1, 1, '2024-05-02 22:45:54', '2024-05-02 22:45:54'),
(4, 1, 4, 1, 1, 1, 1, '2024-05-02 22:45:54', '2024-05-02 22:45:54'),
(5, 1, 5, 1, 1, 1, 1, '2024-05-02 22:45:54', '2024-05-02 22:45:54'),
(6, 1, 6, 1, 1, 1, 1, '2024-05-02 22:45:54', '2024-05-02 22:45:54'),
(7, 1, 7, 1, 1, 1, 1, '2024-05-02 22:45:54', '2024-05-02 22:45:54');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientes_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `datos_usuarios_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingresos_tipo_nom_foreign` (`tipo_nom`),
  ADD KEY `ingresos_proveedor_id_foreign` (`proveedor_id`),
  ADD KEY `ingresos_producto_id_foreign` (`producto_id`),
  ADD KEY `ingresos_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `marcas_nom_unique` (`nom`);

--
-- Indices de la tabla `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `medidas_nom_unique` (`nom`),
  ADD UNIQUE KEY `medidas_simbolo_unique` (`simbolo`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_id` (`tipo_id`),
  ADD KEY `medida_id` (`medida_id`),
  ADD KEY `marca_id` (`marca_id`),
  ADD KEY `proveedor_id` (`proveedor_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `producto_rfids`
--
ALTER TABLE `producto_rfids`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `producto_rfids_rfid_unique` (`rfid`),
  ADD KEY `producto_rfids_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `proveedors`
--
ALTER TABLE `proveedors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proveedors_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salidas_tipo_nom_foreign` (`tipo_nom`),
  ADD KEY `salidas_producto_id_foreign` (`producto_id`),
  ADD KEY `salidas_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tipos_nom_unique` (`nom`);

--
-- Indices de la tabla `tipo_ingreso_salida`
--
ALTER TABLE `tipo_ingreso_salida`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tipo_ingreso_salida_nom_unique` (`nom`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_modulos`
--
ALTER TABLE `user_modulos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `producto_rfids`
--
ALTER TABLE `producto_rfids`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `proveedors`
--
ALTER TABLE `proveedors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `salidas`
--
ALTER TABLE `salidas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo_ingreso_salida`
--
ALTER TABLE `tipo_ingreso_salida`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user_modulos`
--
ALTER TABLE `user_modulos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  ADD CONSTRAINT `datos_usuarios_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `ingresos_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ingresos_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedors` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ingresos_tipo_nom_foreign` FOREIGN KEY (`tipo_nom`) REFERENCES `tipo_ingreso_salida` (`nom`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ingresos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`tipo_id`) REFERENCES `tipos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`medida_id`) REFERENCES `medidas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_4` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedors` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_rfids`
--
ALTER TABLE `producto_rfids`
  ADD CONSTRAINT `producto_rfids_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `proveedors`
--
ALTER TABLE `proveedors`
  ADD CONSTRAINT `proveedors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD CONSTRAINT `salidas_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `salidas_tipo_nom_foreign` FOREIGN KEY (`tipo_nom`) REFERENCES `tipo_ingreso_salida` (`nom`) ON UPDATE CASCADE,
  ADD CONSTRAINT `salidas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
