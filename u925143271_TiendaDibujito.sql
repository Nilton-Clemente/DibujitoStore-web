-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 09-07-2026 a las 14:28:55
-- Versión del servidor: 11.8.8-MariaDB-log
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u925143271_TiendaDibujito`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 0,
  `nombre` varchar(20) NOT NULL DEFAULT 'Desconocido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `anuncios`
--

INSERT INTO `anuncios` (`id`, `imagen`, `activo`, `nombre`) VALUES
(5, 'Este es un anuncio predeterminado unicamente para probar o testear (1).png', 1, 'Prueba de anuncio'),
(6, 'Este es un anuncio predeterminado unicamente para probar o testear.png', 0, 'Anuncio prueba xd'),
(9, 'ChatGPT Image 3 abr 2026, 11_35_55.png', 0, 'Anuncio22222'),
(10, 'Captura de pantalla 2025-05-04 202347.png', 0, 'AnucioPrueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Banners`
--

CREATE TABLE `Banners` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `redireccion` varchar(255) DEFAULT NULL,
  `ubicacion` enum('contenedor_principal','contenedor_secundario','contenedor_extra') NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `activo` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Banners`
--

INSERT INTO `Banners` (`id`, `nombre`, `redireccion`, `ubicacion`, `imagen`, `activo`) VALUES
(4, 'Banner huevos', 'Producto.php?id=30', 'contenedor_principal', 'crop_69947b17-8ca4-460f-be00-cca10ad301da_20260217164347.png', 1),
(7, 'Banner2', 'ResultadoProductos.php?categoria_id=7', 'contenedor_principal', 'maxresdefault.jpg', 1),
(9, 'Banner pollo test', 'Producto.php?id=31', 'contenedor_principal', '02-bannercat-mobile-llamadogeneral.jpg', 1),
(10, 'ElectrodomesticosBannerTest', 'ResultadoProductos.php?categoria_id=15', 'contenedor_secundario', 'BANNER_ELECTRO.jpg', 1),
(11, 'BANNERJUGUETERIA', 'ResultadoProductos.php?categoria_id=16', 'contenedor_extra', 'HP-FRANJA-FRANJA-JUGUETERIA-DIC-2025-A-9.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `usuario_id`) VALUES
(1, 1),
(3, 4),
(2, 5),
(4, 6),
(5, 9),
(6, 10),
(7, 11),
(8, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `imagen` varchar(50) NOT NULL DEFAULT 'Desconocido',
  `tipo` enum('siempre','estacional') NOT NULL DEFAULT 'siempre',
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `imagen`, `tipo`, `fecha_inicio`, `fecha_fin`) VALUES
(7, 'Tecnologia', 'TEST', 'image-1.png', 'siempre', NULL, NULL),
(8, 'Frutas y verduras', 'TESTEO', 'clasificacion-frutas-verduras-hortalizas.jpg', 'siempre', NULL, NULL),
(9, 'Mascotas', 'mascotaszzzzzzzzzzzz', 'mascto.jpg', 'siempre', NULL, NULL),
(10, 'Abarrotes', 'FNEFEEGEJGIGJIEGJIJIJEGEJIGIEJGGEJJGJIGIEGJIEGIJEJGJIEGJIIJGJIEJIGEJIGEGGGGGGGGGGGGGGGGGGGGGGGGGGG', 'image_id_81414.jpeg', 'siempre', NULL, NULL),
(11, 'limpieza', 'cccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc', 'limpieza.jpg', 'siempre', NULL, NULL),
(12, 'Gaming', 'hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', 'categoriagaming.jpg', 'siempre', NULL, NULL),
(13, 'Huevos', 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', 'categoria huevos.jpg', 'siempre', NULL, NULL),
(14, 'Platos preparados', 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', 'plats-preparats.jpeg', 'siempre', NULL, NULL),
(15, 'Electrodomesticos', 'descripcion bruh', 'electrodomesticosicons.jpg', 'siempre', NULL, NULL),
(16, 'jugueteria', 'descripcionrrrr', 'HP-FRANJA-FRANJA-JUGUETERIA-DIC-2025-A-9.jpg', 'siempre', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_carrito`
--

CREATE TABLE `detalle_carrito` (
  `id` int(11) NOT NULL,
  `carrito_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_carrito`
--

INSERT INTO `detalle_carrito` (`id`, `carrito_id`, `producto_id`, `cantidad`) VALUES
(3, 2, 12, 1),
(5, 2, 13, 3),
(7, 2, 14, 1),
(8, 3, 11, 1),
(9, 3, 10, 1),
(10, 3, 13, 2),
(11, 3, 12, 1),
(12, 3, 14, 1),
(13, 3, 15, 1),
(30, 4, 12, 1),
(31, 4, 11, 1),
(32, 5, 10, 1),
(36, 6, 20, 1),
(37, 6, 19, 1),
(38, 6, 10, 1),
(51, 7, 14, 1),
(53, 8, 27, 1),
(63, 1, 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedidos`
--

CREATE TABLE `detalle_pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pedido_id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `imagen_producto` varchar(255) DEFAULT NULL,
  `precio_unitario` decimal(12,2) NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_pedidos`
--

INSERT INTO `detalle_pedidos` (`id`, `pedido_id`, `producto_id`, `nombre_producto`, `imagen_producto`, `precio_unitario`, `cantidad`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 28, 'Silla gamer XTTR4000', 'sillagamer1.jpg', 350.00, 10, 3500.00, '2026-06-21 14:37:14', '2026-06-21 14:37:14'),
(2, 1, 29, 'Silla gamer XRRE200', 'silla2.jpg', 350.00, 9, 3150.00, '2026-06-21 14:37:14', '2026-06-21 14:37:14'),
(3, 1, 30, 'Huevos xdkfeokgogjjeg', 'crop_69947b17-8ca4-460f-be00-cca10ad301da_20260217164347.png', 200.00, 20, 4000.00, '2026-06-21 14:37:14', '2026-06-21 14:37:14'),
(4, 2, 10, 'Laptop xddddddddddddd', 'X_image-a41fa25f62144e899f0362c0590b3b896393.jpg', 1200.00, 6, 7200.00, '2026-06-21 15:25:42', '2026-06-21 15:25:42'),
(5, 2, 30, 'Huevos xdkfeokgogjjeg', 'crop_69947b17-8ca4-460f-be00-cca10ad301da_20260217164347.png', 200.00, 1, 200.00, '2026-06-21 15:25:42', '2026-06-21 15:25:42'),
(6, 3, 13, 'Telefono2', 'xiaomi.jpg', 2000.00, 1, 2000.00, '2026-06-21 15:36:14', '2026-06-21 15:36:14'),
(7, 4, 20, 'Aceita primor', '63238d82-1599-4a65-9e72-aeb4537129df-20281564_1.jpeg', 6.30, 1, 6.30, '2026-06-23 15:29:58', '2026-06-23 15:29:58'),
(8, 4, 25, 'naranja', 'naranja.jpg', 3.00, 1, 3.00, '2026-06-23 15:29:58', '2026-06-23 15:29:58'),
(9, 4, 27, 'Silla gamer xtrt200', 'silla-gamer-hb-negro-azul.jpg', 250.00, 1, 250.00, '2026-06-23 15:29:58', '2026-06-23 15:29:58'),
(10, 5, 20, 'Aceita primor', '63238d82-1599-4a65-9e72-aeb4537129df-20281564_1.jpeg', 6.30, 1, 6.30, '2026-06-23 16:09:00', '2026-06-23 16:09:00'),
(11, 5, 28, 'Silla gamer XTTR4000', 'sillagamer1.jpg', 350.00, 1, 350.00, '2026-06-23 16:09:00', '2026-06-23 16:09:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT 'marca_desconocida',
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Samsung', 'Electrónica y tecnología'),
(2, 'Apple', 'Dispositivos electrónicos y software'),
(3, 'Sony', 'Tecnología y entretenimiento'),
(4, 'LG', 'Electrodomésticos y electrónica'),
(5, 'Huawei', 'Tecnología y telecomunicaciones'),
(6, 'Primor', 'Aceites comestibles'),
(7, 'La Calera', 'Producción de huevos'),
(8, 'San Fernando', 'Productos avícolas y alimentos'),
(9, 'Gloria', 'Productos lácteos'),
(10, 'Dole', 'Frutas y alimentos frescos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_21_000000_create_pedidos_tables', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `porcentaje` decimal(5,2) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 0,
  `nombre` varchar(20) NOT NULL DEFAULT 'Desconocido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`id`, `producto_id`, `porcentaje`, `fecha_inicio`, `fecha_fin`, `activo`, `nombre`) VALUES
(1, 10, 20.00, '2025-10-10', '2026-11-11', 1, 'TestOferta'),
(6, 14, 20.00, '2025-04-04', '2028-05-08', 1, 'oferetaszzz'),
(7, 20, 10.00, '2026-03-08', '2026-09-09', 1, 'ofertaAceite'),
(8, 33, 10.00, '2026-07-07', '2025-07-08', 1, 'Javier');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `envio` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total` decimal(12,2) NOT NULL,
  `estado` varchar(30) NOT NULL DEFAULT 'confirmado',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `codigo`, `subtotal`, `envio`, `total`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 'ORD-1B6F2DB4', 10650.00, 0.00, 10650.00, 'confirmado', '2026-06-21 14:37:14', '2026-06-21 14:37:14'),
(2, 1, 'ORD-8B031AB1', 7400.00, 0.00, 7400.00, 'confirmado', '2026-06-21 15:25:42', '2026-06-21 15:25:42'),
(3, 1, 'ORD-9891FAA9', 2000.00, 0.00, 2000.00, 'confirmado', '2026-06-21 15:36:14', '2026-06-21 15:36:14'),
(4, 1, 'ORD-12B49771', 259.30, 0.00, 259.30, 'confirmado', '2026-06-23 15:29:58', '2026-06-23 15:29:58'),
(5, 1, 'ORD-0F789D28', 356.30, 0.00, 356.30, 'confirmado', '2026-06-23 16:09:00', '2026-06-23 16:09:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `marca_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `stock`, `categoria_id`, `imagen`, `marca_id`) VALUES
(10, 'Laptop xddddddddddddd', 'nchchccccccccccccccccccccccccccccccccc', 1500.00, 1200, 7, 'X_image-a41fa25f62144e899f0362c0590b3b896393.jpg', 1),
(11, 'Naranjas', 'ldddlfdlfdlfldlfdlfdfdlfd', 5.00, 10000, 8, 'jugosa-naranja-circulo-citricos-maduros.jpg', 5),
(12, 'TelefonoTest', 'djdjdjddjdjdjdjdjjdjdddd', 2000.00, 10000, 7, 'Sansung Galaxy .jpg', 1),
(13, 'Telefono2', 'xddddddddddddddddddddddddddddddddddd', 2000.00, 1000, 7, 'xiaomi.jpg', 1),
(14, 'TV smartTv', 'DIFJEJEVJVIEVNMVDNVDJVDNVJDVNDJVNJVDNVNSJ', 1500.00, 10000, 7, 'TV SmartTV.jpg', 3),
(19, 'Audifonos', 'ewijfieijijigjigegeeggegeg', 30.00, 300, 7, 'images.jpg', 3),
(20, 'Aceita primor', 'eifeigjieijgijegjigjijeijggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg', 7.00, 100, 10, '63238d82-1599-4a65-9e72-aeb4537129df-20281564_1.jpeg', 4),
(25, 'naranja', 'ffffffffffffffffffffffffsssssssssssssssssssssssssssssssssssssssss', 3.00, 200, 8, 'naranja.jpg', 5),
(27, 'Silla gamer xtrt200', 'xddddddddxddddddddxddddddddxddddddddxddddddddxddddddddxddddddddxddddddddxddddddddxddddddddxddddddddxddddddddxdddddddd', 250.00, 300, 12, 'silla-gamer-hb-negro-azul.jpg', NULL),
(28, 'Silla gamer XTTR4000', 'xddddddddxddddddddxddddddddxddddddddxddddddddxddddddddxddddddddxddddddddxddddddddxddddddddxddddddddxddddddddxdddddddd', 350.00, 500, 12, 'sillagamer1.jpg', NULL),
(29, 'Silla gamer XRRE200', 'xddddddddxddddddddxddddddddxddddddddxddddddddxddddddddxddddddddxddddddddxddddddddxddddddddxddddddddxddddddddxdddddddd', 350.00, 500, 12, 'silla2.jpg', NULL),
(30, 'Huevos xdkfeokgogjjeg', 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', 200.00, 5000, 13, 'crop_69947b17-8ca4-460f-be00-cca10ad301da_20260217164347.png', NULL),
(31, 'Pollo Rostizado m Porción De Papas m Ají ', 'Jugosos sabrosos y perfectamente rostizados\n\n', 20.00, 20, 14, 'pollo.jpg', NULL),
(33, 'Manzana2', 'FEFEFEFFEFEF', 2.00, 1000, 8, 'manzana.jpg', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `descuento` decimal(5,2) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `activo` tinyint(1) DEFAULT 0,
  `imagen` varchar(50) NOT NULL DEFAULT 'desconocido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`id`, `nombre`, `descripcion`, `descuento`, `fecha_inicio`, `fecha_fin`, `activo`, `imagen`) VALUES
(5, 'promcoececececec', 'ccccccccccccccccccccccccccccccc', 5.00, '2026-02-02', '2026-05-05', 1, 'promoccccc.jpg'),
(6, 'promocion2', 'clffffffffffffffffffffffffffffffffffeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 10.00, '2025-03-04', '2027-08-08', 1, '668fd93421f7266f8148914b.jpg'),
(7, 'BannerFC', 'Bannercdd', 20.00, '2027-07-07', '2027-07-07', 0, 'banner fc.jpg'),
(8, 'Promocion2026', 'Descripcion basica', 10.00, '2026-07-07', '2027-10-10', 0, 'Captura de pantalla 2025-12-07 113253.png'),
(9, 'Promocion2026', 'Descripcion basica', 10.00, '2026-07-07', '2027-10-10', 0, 'Captura de pantalla 2025-12-07 113253.png'),
(10, 'Promocion2026', 'Descripcion basica', 10.00, '2026-07-07', '2027-10-10', 0, 'Captura de pantalla 2025-12-07 113253.png'),
(11, 'Promocion2026', 'Descripcion basica', 10.00, '2026-07-07', '2027-10-10', 0, 'Captura de pantalla 2025-12-07 113253.png'),
(12, 'Promocion2026', 'Descripcion basica', 10.00, '2026-07-07', '2027-10-10', 0, 'Captura de pantalla 2025-12-07 113253.png'),
(13, 'Promo2027', 'Cle,emte', 10.00, '2026-07-07', '2927-08-08', 0, '16410.png'),
(14, 'Promo2027', 'Cle,emte', 10.00, '2026-07-07', '2927-08-08', 0, '16410.png'),
(15, 'Promo2027', 'Cle,emte', 10.00, '2026-07-07', '2927-08-08', 0, '16410.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `contrasena` varchar(16) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(120) DEFAULT NULL,
  `dni` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `contrasena`, `telefono`, `correo`, `dni`) VALUES
(1, 'javier', 'clemente', '123456789', 'javier131@gmail.com', '457637332'),
(4, 'Nilton', 'Clemente', '3985374373', 'nilton1344@gmail.com', '24823732'),
(5, 'huaraka', '1234', '223242444525', 'huaraka@gmail.com', '232425326'),
(6, 'luis', '1234', '14414414', 'hiltnotn@gmail.com', '882528585'),
(7, 'javier', '1234', '2828525255', 'niltonmastwerefe@gmlai.com', '339535395'),
(8, 'niltomaster123', '12349876', '9138448', 'gkgkfrk@gmail.com', '2828838388'),
(9, 'Clementex', '12349876', '82383838', 'niltonmaster159@gmail.com', '283333838'),
(10, 'Gonzalo', 'GonchoDivino', '961967135', 'gonzalo.davila@tecsup.edu.pe', '98348935'),
(11, 'Gonzalo Davila', '292929', '961967135', 'davilagonzalo2304@gmail.com', '88997788'),
(12, 'Gonzalo', 'AmericaEA', '951758984', 'davila67@gmail.com', '96696776'),
(13, 'Luis', '123456789', '123456789', 'luis@gmail.com', '12345678');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `fecha_venta` datetime NOT NULL DEFAULT current_timestamp(),
  `monto_total` decimal(10,2) NOT NULL,
  `metodo_pago` varchar(50) DEFAULT NULL,
  `estado` enum('Pagado','Pendiente','Anulado') DEFAULT 'Pagado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Banners`
--
ALTER TABLE `Banners`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_carrito`
--
ALTER TABLE `detalle_carrito`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `carrito_id` (`carrito_id`,`producto_id`);

--
-- Indices de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_pedidos_pedido_id_foreign` (`pedido_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pedidos_codigo_unique` (`codigo`),
  ADD KEY `pedidos_usuario_id_index` (`usuario_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_producto_categoria` (`categoria_id`),
  ADD KEY `fk_marca_id` (`marca_id`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `Banners`
--
ALTER TABLE `Banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `detalle_carrito`
--
ALTER TABLE `detalle_carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_carrito`
--
ALTER TABLE `detalle_carrito`
  ADD CONSTRAINT `detalle_carrito_ibfk_1` FOREIGN KEY (`carrito_id`) REFERENCES `carrito` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD CONSTRAINT `detalle_pedidos_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD CONSTRAINT `ofertas_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_marca_id` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`),
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
