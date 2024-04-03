-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 03-04-2024 a las 05:19:36
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
-- Base de datos: `pawspalace`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `duration` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `modality` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `appointments`
--

INSERT INTO `appointments` (`id`, `duration`, `date`, `time`, `status`, `modality`, `price`, `image`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 30, '10/04/2024', '9:00 am', 'Pendiente', 'Virtual', 60000, 'game.png', NULL, '2024-04-03 08:09:52', '2024-04-03 08:09:52'),
(2, 30, '10/04/2024', '11:00 am', 'Pendiente', 'At home', 75000, 'game.png', NULL, '2024-04-03 08:10:09', '2024-04-03 08:10:09');

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
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `appointment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `quantity`, `price`, `order_id`, `product_id`, `appointment_id`, `created_at`, `updated_at`) VALUES
(1, 1, 60000, 1, NULL, 1, '2024-04-03 08:17:59', '2024-04-03 08:17:59'),
(2, 1, 105100, 2, 3, NULL, '2024-04-03 08:18:34', '2024-04-03 08:18:34');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_03_27_213418_alter_users_table', 1),
(7, '2024_03_27_222534_create_products_table', 1),
(8, '2024_03_28_185341_create_orders_table', 1),
(9, '2024_03_28_201908_create_reviews_table', 1),
(10, '2024_04_01_210915_create_appointments_table', 1),
(11, '2024_04_01_234848_create_items_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `total`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 60000, 1, '2024-04-03 08:17:59', '2024-04-03 08:17:59'),
(2, 105100, 1, '2024-04-03 08:18:34', '2024-04-03 08:18:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `favorite` tinyint(1) NOT NULL DEFAULT 0,
  `image` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category`, `price`, `stock`, `favorite`, `image`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Alimento Para Perro - K-Booster Pollo 15 Gr', '- Alto en proteína, Contiene kéfir como fuente de probióticos.\r\n- Aporta al sistema digestivo e inmunológico, 100% ingredientes naturales.', 'Alimentos', 9500, 10, 1, '1.webp', 1, '2024-04-03 08:00:37', '2024-04-03 08:15:04'),
(2, 'Alimento Para Perro - K-Booster Salmón 200 Gr', '- Alto en proteína, Contiene kéfir como fuente de probióticos.\r\n- Aporta al sistema digestivo e inmunológico, 100% ingredientes naturales.', 'Alimentos', 49900, 15, 0, '2.png', NULL, '2024-04-03 08:01:39', '2024-04-03 08:01:39'),
(3, 'Alimento Para Gato - Royal Canin Sterilised 7', '- Alto en proteína, Contiene kéfir como fuente de probióticos.\r\n- Aporta al sistema digestivo e inmunológico, 100% ingredientes naturales.', 'Alimentos', 105100, 20, 1, '3.webp', 1, '2024-04-03 08:02:39', '2024-04-03 08:18:30'),
(4, 'Artri Balance X 60 Tab Para Perro', 'ARTRI BALANCE es una fórmula integral para el apoyo de la estructura, función y flexibilidad de las articulaciones para perros y gatos de todas las edades, razas y tallas.', 'Medicamentos', 184900, 25, 0, '4.webp', NULL, '2024-04-03 08:03:36', '2024-04-03 08:03:36'),
(5, 'Revolution Plus 0.25 Ml 1.25 KG a 2.5 KG Para Gato', '- Desparasitante externo e interno.\r\n- Antipulgas para gatos cachorros.\r\n- Control de garrapata en gatos.', 'Medicamentos', 51600, 40, 0, '5.png', NULL, '2024-04-03 08:04:48', '2024-04-03 08:04:48'),
(6, 'Esencias Florales Stress Gotas 30 ML Para Todas', 'Para perros con propietarios o entrenadores muy exigentes que suponen un alto nivel de estrés.\r\nPara gatos con cambios de rutina que generan alteraciones en su conducta.\r\nInformación de producto', 'Medicamentos', 23900, 70, 1, '6.webp', 1, '2024-04-03 08:05:27', '2024-04-03 08:15:58'),
(7, 'Arnes Kanu Walker Verde Militar Para Perro', '- Cómodo y fresco para mascotas.\r\n- Múltiples ajustes disponibles para encontrar el tamaño perfecto para tu mascota.\r\n- Evita los tirones agresivos * Lavable a máquina.', 'Accesorios', 129900, 12, 0, '7.png', NULL, '2024-04-03 08:06:34', '2024-04-03 08:06:34'),
(8, 'Kanu Pet Cama Rectangular Ovejero Verde Militar Para Perro S', '- Se pueden lavar a máquina\r\n- Son acolchadas, cuidando la columna', 'Accesorios', 179900, 30, 0, '8.png', NULL, '2024-04-03 08:07:22', '2024-04-03 08:07:22'),
(9, 'Comedero Kanu Doble Ref KC7-015 Para Todos', '- En esta referencia se envía un color de forma aleatoria.\r\n- Material: fibra de bambú.\r\n- Amigable con el medio ambiente,apto para soportar bajos niveles de calor.', 'Accesorios', 10500, 24, 0, '9.webp', NULL, '2024-04-03 08:08:07', '2024-04-03 08:08:07'),
(11, 'Correa Kanu Resort Daga Spring Azul Para Perro', 'Correa cómoda para perro.', 'Accesorios', 56900, 10, 0, '11.png', NULL, '2024-04-03 08:11:55', '2024-04-03 08:11:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reviews`
--

INSERT INTO `reviews` (`id`, `comment`, `rating`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Excelente producto. Mi mascota quedo encantada.', 5, 1, 1, '2024-04-03 08:15:03', '2024-04-03 08:15:03'),
(2, 'Muy nutritivo.', 4, 2, 1, '2024-04-03 08:15:26', '2024-04-03 08:15:26'),
(3, 'Relaja a mis gatos cuando estan estresados.', 5, 6, 1, '2024-04-03 08:15:56', '2024-04-03 08:15:56');

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'client',
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `balance`) VALUES
(1, 'Administrador', 'admin@admin.com', NULL, '$2y$12$TCaHCjLiGEHumf1YLj5y1eUFFl22c.Y9hGD5R/kUqFSaxsj4GhO8O', NULL, '2024-04-03 07:56:37', '2024-04-03 08:18:34', 'admin', 230000),
(2, 'Usuario', 'user@user.com', NULL, '$2y$12$WfHQhVChOMxaQ3GMKHIDQua.6TdEo.6xuC4kX3paLqQEJd8ZDvNQG', NULL, '2024-04-03 07:57:00', '2024-04-03 07:57:00', 'client', 5000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_order_id_foreign` (`order_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_order_id_foreign` (`order_id`),
  ADD KEY `items_product_id_foreign` (`product_id`),
  ADD KEY `items_appointment_id_foreign` (`appointment_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Filtros para la tabla `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`),
  ADD CONSTRAINT `items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
