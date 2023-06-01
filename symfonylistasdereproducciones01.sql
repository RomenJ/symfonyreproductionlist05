-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2023 a las 13:06:00
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `symfonylistasdereproducciones01`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230323105830', '2023-03-23 11:58:37', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listareproduccion`
--

CREATE TABLE `listareproduccion` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `titulolista` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `listareproduccion`
--

INSERT INTO `listareproduccion` (`id`, `user_id`, `titulolista`) VALUES
(6, 2, 'La Lista de Ana nº1'),
(7, 4, 'La Lista de John'),
(8, 4, 'Por todos mis hits I'),
(10, 4, 'Mis hits parte IV'),
(11, 1, 'Pepito\'s Hits'),
(12, 1, 'Pepe Powerrr Soft Primera Marcha'),
(15, 5, 'Lolita in tha house'),
(16, 1, 'Pepito se viene arriba'),
(17, 1, 'Pepito se viene abajo'),
(18, 2, 'Ana in da house nº 2'),
(19, 2, 'lista 3'),
(20, 1, 'Por todos mis hits IV'),
(21, 1, 'Virtual V'),
(22, 2, 'Ana in tha roof'),
(23, 2, 'Ana Tolia'),
(24, 1, 'Pepito goes to the beach'),
(25, 3, 'Pepito 2 roof');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listareproduccion_temazo`
--

CREATE TABLE `listareproduccion_temazo` (
  `listareproduccion_id` int(11) NOT NULL,
  `temazo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `listareproduccion_temazo`
--

INSERT INTO `listareproduccion_temazo` (`listareproduccion_id`, `temazo_id`) VALUES
(6, 20),
(7, 23),
(7, 24),
(8, 20),
(8, 21),
(8, 22),
(10, 22),
(10, 23),
(11, 20),
(11, 21),
(11, 22),
(12, 21),
(12, 24),
(15, 21),
(15, 25),
(16, 20),
(16, 25),
(17, 23),
(17, 24),
(18, 21),
(18, 25),
(19, 23),
(19, 25),
(20, 22),
(20, 23),
(20, 24),
(20, 25),
(21, 20),
(21, 22),
(22, 21),
(22, 25),
(23, 21),
(23, 24),
(23, 25),
(24, 22),
(24, 25),
(25, 20),
(25, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temazo`
--

CREATE TABLE `temazo` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL,
  `archivenamesong` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `temazo`
--

INSERT INTO `temazo` (`id`, `titulo`, `autor`, `duracion`, `archivenamesong`) VALUES
(20, 'Mr. Crowley', 'Ozzy', 123, 'onlymp3-to-OZZY-OSBOURNE-Mr-Crowley-1981-Live-Video-G3LvhdFEOqs-256k-1654749909919-6421db97d8af4.mp3'),
(21, 'Weapon of Choice', 'Fat Boy Slim', 456, 'onlymp3-to-Fatboy-Slim-ft-Bootsy-Collins-Weapon-Of-Choice-Official-4k-Video-wCDIYvFmgW8-256k-1654118061697-6421dc417586a.mp3'),
(22, 'Lonely Boy', 'The Black Keys', 467, 'onlymp3-to-The-Black-Keys-Lonely-Boy-Official-Music-Video-a-426RiwST8-256k-1654810733983-6421dc72964e3.mp3'),
(23, 'Lullaby', 'The cure', 324, '3-The-Cure-Lullaby-6421dc967b215.mp3'),
(24, 'Just like heaven', 'The cure', 678, 'onlymp3-to-The-Cure-Just-Like-Heaven-n3nPiBai66M-256k-1654125665636-6421dd093a693.mp3'),
(25, 'The beautiful people', 'Marilyn Manson', 232, 'onlymp3-to-Marilyn-Manson-The-Beautiful-People-Ypkv0HeUvTc-256k-1654141771337-64528b7033a5d.mp3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `email`, `telephone`) VALUES
(1, 'pepe', '[]', '$2y$13$Qw7LBsd9ft6XeekyXpYc4OskH0YFarDGEpPHWOApomwXhzUHL6QkS', 'pepe@pepe.es', '123124324'),
(2, 'ana', '[]', '$2y$13$ao4UmqLSNyiFQwReXlPjKeZRQQkOIMsu9Sm74FQgv0AsSpF7epqKS', 'ana@ana.es', '+34622902526'),
(3, 'pepe2', '[\"ROLE_ADMIN\"]', '$2y$13$.4ZS.be079IReef3ta2re.84.XA0HUFNPfkV33df6FmQSPYWIYQrW', 'pepe@pepe.es', '123124324'),
(4, 'John Smith', '[]', '$2y$13$M7eUOrnvmpCDkg7XdICujeSUeqSmllHAV7IsCuU/173ytVoUClSQe', 'jshd@lkwje.com', '23984732'),
(5, 'lola', '[]', '$2y$13$QyL.WDLtLOEhfOxU3Kg71OuR2RdXX.chZR.iY4tJbuUPOBpq7eavK', 'lola@mola.es', '12324'),
(6, 'richi', '[\"ROLE_USER\",\"ROLE_ADMIN\"]', '$2y$13$U8zVTKsD1lPa0we6yOvgouLmmtAtFstE7deIBSAiW4p7lx21gLPai', 'r2@r.es', '123123'),
(7, 'Domingo', '[]', '$2y$13$S78uC1C.hTrIMar20pugJ.7TY7rt5QhOycUrZn8dvCfhh09wtzJH6', 'dom@dom.es', '123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `listareproduccion`
--
ALTER TABLE `listareproduccion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E8F4514AA76ED395` (`user_id`);

--
-- Indices de la tabla `listareproduccion_temazo`
--
ALTER TABLE `listareproduccion_temazo`
  ADD PRIMARY KEY (`listareproduccion_id`,`temazo_id`),
  ADD KEY `IDX_88C2FC9923C97DE` (`listareproduccion_id`),
  ADD KEY `IDX_88C2FC99B3A3DA6B` (`temazo_id`);

--
-- Indices de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indices de la tabla `temazo`
--
ALTER TABLE `temazo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `listareproduccion`
--
ALTER TABLE `listareproduccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `temazo`
--
ALTER TABLE `temazo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `listareproduccion`
--
ALTER TABLE `listareproduccion`
  ADD CONSTRAINT `FK_E8F4514AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `listareproduccion_temazo`
--
ALTER TABLE `listareproduccion_temazo`
  ADD CONSTRAINT `FK_88C2FC9923C97DE` FOREIGN KEY (`listareproduccion_id`) REFERENCES `listareproduccion` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_88C2FC99B3A3DA6B` FOREIGN KEY (`temazo_id`) REFERENCES `temazo` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
