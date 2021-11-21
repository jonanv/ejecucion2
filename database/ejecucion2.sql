-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 01-11-2021 a las 05:25:32
-- Versión del servidor: 5.7.34
-- Versión de PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ejecucion2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blocked_type`
--

CREATE TABLE `blocked_type` (
  `id_blocked_type` int(11) NOT NULL,
  `blocked_type_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `blocked_type_description` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correspondence`
--

CREATE TABLE `correspondence` (
  `id_correspondence` int(11) NOT NULL,
  `correspondence_date` datetime NOT NULL,
  `pettioner_identification` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `petitioner` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `pettioner_phone` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pages_correspondence` int(11) NOT NULL,
  `id_document_type` int(11) NOT NULL,
  `id_request_type` int(11) NOT NULL,
  `id_dossier` bigint(20) NOT NULL,
  `id_employee` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `defendant`
--

CREATE TABLE `defendant` (
  `id_defendant` bigint(11) NOT NULL,
  `defendant_identification` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `defendant_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `document_type`
--

CREATE TABLE `document_type` (
  `id_document_type` int(11) NOT NULL,
  `document_type_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `document_type_description` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dossier`
--

CREATE TABLE `dossier` (
  `id_dossier` bigint(20) NOT NULL,
  `radicado` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `instance` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `date_last_action` datetime DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `date_in_dispach` datetime DEFAULT NULL,
  `date_out_dispach` datetime DEFAULT NULL,
  `fault_dossier` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fault_dossier_date` datetime DEFAULT NULL,
  `end_settlement_date` datetime DEFAULT NULL,
  `digital_dossier` tinyint(1) NOT NULL,
  `pages_dossier` int(11) NOT NULL,
  `notebooks_dossier` int(11) NOT NULL,
  `id_location_dossier` int(11) DEFAULT NULL,
  `id_defendant` bigint(20) NOT NULL,
  `id_plaintiff` bigint(20) NOT NULL,
  `id_dossier_registration` int(11) NOT NULL,
  `id_dossier_archived` int(11) DEFAULT NULL,
  `id_dossier_blocked` int(11) DEFAULT NULL,
  `id_dossier_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dossier_annotation`
--

CREATE TABLE `dossier_annotation` (
  `id_dossier_annotation` int(11) NOT NULL,
  `dossier_annotation_date` datetime NOT NULL,
  `dossier_annotation_observation` text COLLATE utf8_spanish_ci NOT NULL,
  `id_dossier` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dossier_archived`
--

CREATE TABLE `dossier_archived` (
  `id_dossier_archived` int(11) NOT NULL,
  `id_employee` bigint(20) NOT NULL,
  `dossier_archived_date` datetime NOT NULL,
  `dossier_archived` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dossier_blocked`
--

CREATE TABLE `dossier_blocked` (
  `id_dossier_bloqued` int(11) NOT NULL,
  `id_employee` bigint(20) NOT NULL,
  `dossier_blocked_date` datetime NOT NULL,
  `dossier_unblocked_date` datetime DEFAULT NULL,
  `dossier_bloqued` tinyint(1) NOT NULL,
  `id_blocked_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dossier_registration`
--

CREATE TABLE `dossier_registration` (
  `id_dossier_registration` int(11) NOT NULL,
  `id_employee` bigint(20) NOT NULL,
  `dossier_registration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dossier_term`
--

CREATE TABLE `dossier_term` (
  `id_dossier_term` int(11) NOT NULL,
  `dossier_term_date` datetime NOT NULL,
  `dossier_term_registration_date` datetime NOT NULL,
  `dossier_term_observation` text COLLATE utf8_spanish_ci NOT NULL,
  `dossier_term_revised` tinyint(1) NOT NULL,
  `id_dossier` bigint(20) NOT NULL,
  `id_term_type` int(11) NOT NULL,
  `id_employee` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dossier_title`
--

CREATE TABLE `dossier_title` (
  `id_dossier_title` int(11) NOT NULL,
  `title_dossier_date` datetime NOT NULL,
  `title_dossier_value` bigint(20) NOT NULL,
  `title_dossier_beneficiary` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `title_dossier_quantity` int(11) NOT NULL,
  `title_dossier_payment_date` datetime DEFAULT NULL,
  `title_dossier_modification_date` datetime DEFAULT NULL,
  `id_title_type` int(11) NOT NULL,
  `id_dossier` bigint(20) NOT NULL,
  `id_employee` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dossier_type`
--

CREATE TABLE `dossier_type` (
  `id_dossier_type` int(11) NOT NULL,
  `dossier_type_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `dossier_type_description` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employee`
--

CREATE TABLE `employee` (
  `id_employee` bigint(20) NOT NULL,
  `firstname` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `id_job_title` int(11) NOT NULL,
  `id_profile` int(11) NOT NULL,
  `enable_employee` tinyint(1) NOT NULL,
  `employee_image` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_title`
--

CREATE TABLE `job_title` (
  `id_job_title` int(11) NOT NULL,
  `job_title_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `job_title_description` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `location_dossier`
--

CREATE TABLE `location_dossier` (
  `id_location_dossier` int(11) NOT NULL,
  `floor_location_dossier` int(11) NOT NULL,
  `location_dossier_observation` text COLLATE utf8_spanish_ci NOT NULL,
  `position` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `location_dossier_date` datetime NOT NULL,
  `id_location_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `location_type`
--

CREATE TABLE `location_type` (
  `id_location_type` int(11) NOT NULL,
  `location_type_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `location_type_description` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `log_date` datetime NOT NULL,
  `log_action` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `log_detail` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `id_log_type` int(11) NOT NULL,
  `id_employee` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_type`
--

CREATE TABLE `log_type` (
  `id_log_type` int(11) NOT NULL,
  `log_type_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `log_type_description` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plaintiff`
--

CREATE TABLE `plaintiff` (
  `id_plaintiff` bigint(20) NOT NULL,
  `plaintiff_identification` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `plaintiff_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profile`
--

CREATE TABLE `profile` (
  `id_profile` int(11) NOT NULL,
  `profile_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `profile_description` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `request_type`
--

CREATE TABLE `request_type` (
  `id_request_type` int(11) NOT NULL,
  `request_type_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `request_type_description` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `term_type`
--

CREATE TABLE `term_type` (
  `id_term_type` int(11) NOT NULL,
  `term_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `term_type_days` int(11) NOT NULL,
  `term_type_description` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `title_type`
--

CREATE TABLE `title_type` (
  `id_title_type` int(11) NOT NULL,
  `title_type_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `title_type_description` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `blocked_type`
--
ALTER TABLE `blocked_type`
  ADD PRIMARY KEY (`id_blocked_type`);

--
-- Indices de la tabla `correspondence`
--
ALTER TABLE `correspondence`
  ADD PRIMARY KEY (`id_correspondence`),
  ADD KEY `id_document_type` (`id_document_type`),
  ADD KEY `id_request_type` (`id_request_type`),
  ADD KEY `id_dossier` (`id_dossier`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indices de la tabla `defendant`
--
ALTER TABLE `defendant`
  ADD PRIMARY KEY (`id_defendant`);

--
-- Indices de la tabla `document_type`
--
ALTER TABLE `document_type`
  ADD PRIMARY KEY (`id_document_type`);

--
-- Indices de la tabla `dossier`
--
ALTER TABLE `dossier`
  ADD PRIMARY KEY (`id_dossier`),
  ADD KEY `id_location_dossier` (`id_location_dossier`),
  ADD KEY `id_defendant` (`id_defendant`),
  ADD KEY `id_plaintiff` (`id_plaintiff`),
  ADD KEY `id_dossier_registration` (`id_dossier_registration`),
  ADD KEY `id_dossier_archived` (`id_dossier_archived`),
  ADD KEY `id_dossier_blocked` (`id_dossier_blocked`),
  ADD KEY `id_dossier_type` (`id_dossier_type`);

--
-- Indices de la tabla `dossier_annotation`
--
ALTER TABLE `dossier_annotation`
  ADD PRIMARY KEY (`id_dossier_annotation`) USING BTREE,
  ADD KEY `id_dossier` (`id_dossier`);

--
-- Indices de la tabla `dossier_archived`
--
ALTER TABLE `dossier_archived`
  ADD PRIMARY KEY (`id_dossier_archived`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indices de la tabla `dossier_blocked`
--
ALTER TABLE `dossier_blocked`
  ADD PRIMARY KEY (`id_dossier_bloqued`),
  ADD KEY `id_blocked_type` (`id_blocked_type`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indices de la tabla `dossier_registration`
--
ALTER TABLE `dossier_registration`
  ADD PRIMARY KEY (`id_dossier_registration`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indices de la tabla `dossier_term`
--
ALTER TABLE `dossier_term`
  ADD PRIMARY KEY (`id_dossier_term`),
  ADD KEY `id_term_type` (`id_term_type`),
  ADD KEY `id_dossier` (`id_dossier`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indices de la tabla `dossier_title`
--
ALTER TABLE `dossier_title`
  ADD PRIMARY KEY (`id_dossier_title`),
  ADD KEY `id_title_type` (`id_title_type`),
  ADD KEY `id_dossier` (`id_dossier`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indices de la tabla `dossier_type`
--
ALTER TABLE `dossier_type`
  ADD PRIMARY KEY (`id_dossier_type`);

--
-- Indices de la tabla `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id_employee`),
  ADD KEY `id_job_title` (`id_job_title`),
  ADD KEY `id_profile` (`id_profile`);

--
-- Indices de la tabla `job_title`
--
ALTER TABLE `job_title`
  ADD PRIMARY KEY (`id_job_title`);

--
-- Indices de la tabla `location_dossier`
--
ALTER TABLE `location_dossier`
  ADD PRIMARY KEY (`id_location_dossier`),
  ADD KEY `id_location_type` (`id_location_type`);

--
-- Indices de la tabla `location_type`
--
ALTER TABLE `location_type`
  ADD PRIMARY KEY (`id_location_type`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_log_type` (`id_log_type`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indices de la tabla `log_type`
--
ALTER TABLE `log_type`
  ADD PRIMARY KEY (`id_log_type`);

--
-- Indices de la tabla `plaintiff`
--
ALTER TABLE `plaintiff`
  ADD PRIMARY KEY (`id_plaintiff`);

--
-- Indices de la tabla `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id_profile`);

--
-- Indices de la tabla `request_type`
--
ALTER TABLE `request_type`
  ADD PRIMARY KEY (`id_request_type`);

--
-- Indices de la tabla `term_type`
--
ALTER TABLE `term_type`
  ADD PRIMARY KEY (`id_term_type`);

--
-- Indices de la tabla `title_type`
--
ALTER TABLE `title_type`
  ADD PRIMARY KEY (`id_title_type`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `blocked_type`
--
ALTER TABLE `blocked_type`
  MODIFY `id_blocked_type` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `correspondence`
--
ALTER TABLE `correspondence`
  MODIFY `id_correspondence` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `defendant`
--
ALTER TABLE `defendant`
  MODIFY `id_defendant` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `document_type`
--
ALTER TABLE `document_type`
  MODIFY `id_document_type` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dossier`
--
ALTER TABLE `dossier`
  MODIFY `id_dossier` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dossier_annotation`
--
ALTER TABLE `dossier_annotation`
  MODIFY `id_dossier_annotation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dossier_archived`
--
ALTER TABLE `dossier_archived`
  MODIFY `id_dossier_archived` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dossier_blocked`
--
ALTER TABLE `dossier_blocked`
  MODIFY `id_dossier_bloqued` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dossier_registration`
--
ALTER TABLE `dossier_registration`
  MODIFY `id_dossier_registration` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dossier_term`
--
ALTER TABLE `dossier_term`
  MODIFY `id_dossier_term` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dossier_title`
--
ALTER TABLE `dossier_title`
  MODIFY `id_dossier_title` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dossier_type`
--
ALTER TABLE `dossier_type`
  MODIFY `id_dossier_type` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `job_title`
--
ALTER TABLE `job_title`
  MODIFY `id_job_title` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `location_dossier`
--
ALTER TABLE `location_dossier`
  MODIFY `id_location_dossier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `location_type`
--
ALTER TABLE `location_type`
  MODIFY `id_location_type` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `log_type`
--
ALTER TABLE `log_type`
  MODIFY `id_log_type` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plaintiff`
--
ALTER TABLE `plaintiff`
  MODIFY `id_plaintiff` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `profile`
--
ALTER TABLE `profile`
  MODIFY `id_profile` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `request_type`
--
ALTER TABLE `request_type`
  MODIFY `id_request_type` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `term_type`
--
ALTER TABLE `term_type`
  MODIFY `id_term_type` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `title_type`
--
ALTER TABLE `title_type`
  MODIFY `id_title_type` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `correspondence`
--
ALTER TABLE `correspondence`
  ADD CONSTRAINT `correspondence_ibfk_1` FOREIGN KEY (`id_document_type`) REFERENCES `document_type` (`id_document_type`) ON UPDATE CASCADE,
  ADD CONSTRAINT `correspondence_ibfk_2` FOREIGN KEY (`id_request_type`) REFERENCES `request_type` (`id_request_type`) ON UPDATE CASCADE,
  ADD CONSTRAINT `correspondence_ibfk_3` FOREIGN KEY (`id_dossier`) REFERENCES `dossier` (`id_dossier`) ON UPDATE CASCADE,
  ADD CONSTRAINT `correspondence_ibfk_4` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `dossier`
--
ALTER TABLE `dossier`
  ADD CONSTRAINT `dossier_ibfk_1` FOREIGN KEY (`id_location_dossier`) REFERENCES `location_dossier` (`id_location_dossier`) ON UPDATE CASCADE,
  ADD CONSTRAINT `dossier_ibfk_2` FOREIGN KEY (`id_defendant`) REFERENCES `defendant` (`id_defendant`) ON UPDATE CASCADE,
  ADD CONSTRAINT `dossier_ibfk_3` FOREIGN KEY (`id_plaintiff`) REFERENCES `plaintiff` (`id_plaintiff`) ON UPDATE CASCADE,
  ADD CONSTRAINT `dossier_ibfk_4` FOREIGN KEY (`id_dossier_registration`) REFERENCES `dossier_registration` (`id_dossier_registration`) ON UPDATE CASCADE,
  ADD CONSTRAINT `dossier_ibfk_5` FOREIGN KEY (`id_dossier_archived`) REFERENCES `dossier_archived` (`id_dossier_archived`) ON UPDATE CASCADE,
  ADD CONSTRAINT `dossier_ibfk_6` FOREIGN KEY (`id_dossier_blocked`) REFERENCES `dossier_blocked` (`id_dossier_bloqued`) ON UPDATE CASCADE,
  ADD CONSTRAINT `dossier_ibfk_7` FOREIGN KEY (`id_dossier_type`) REFERENCES `dossier_type` (`id_dossier_type`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `dossier_annotation`
--
ALTER TABLE `dossier_annotation`
  ADD CONSTRAINT `dossier_annotation_ibfk_1` FOREIGN KEY (`id_dossier`) REFERENCES `dossier` (`id_dossier`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `dossier_archived`
--
ALTER TABLE `dossier_archived`
  ADD CONSTRAINT `dossier_archived_ibfk_1` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `dossier_blocked`
--
ALTER TABLE `dossier_blocked`
  ADD CONSTRAINT `dossier_blocked_ibfk_1` FOREIGN KEY (`id_blocked_type`) REFERENCES `blocked_type` (`id_blocked_type`) ON UPDATE CASCADE,
  ADD CONSTRAINT `dossier_blocked_ibfk_2` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `dossier_registration`
--
ALTER TABLE `dossier_registration`
  ADD CONSTRAINT `dossier_registration_ibfk_1` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `dossier_term`
--
ALTER TABLE `dossier_term`
  ADD CONSTRAINT `dossier_term_ibfk_1` FOREIGN KEY (`id_term_type`) REFERENCES `term_type` (`id_term_type`) ON UPDATE CASCADE,
  ADD CONSTRAINT `dossier_term_ibfk_2` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON UPDATE CASCADE,
  ADD CONSTRAINT `dossier_term_ibfk_3` FOREIGN KEY (`id_dossier`) REFERENCES `dossier` (`id_dossier`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `dossier_title`
--
ALTER TABLE `dossier_title`
  ADD CONSTRAINT `dossier_title_ibfk_1` FOREIGN KEY (`id_title_type`) REFERENCES `title_type` (`id_title_type`) ON UPDATE CASCADE,
  ADD CONSTRAINT `dossier_title_ibfk_2` FOREIGN KEY (`id_dossier`) REFERENCES `dossier` (`id_dossier`) ON UPDATE CASCADE,
  ADD CONSTRAINT `dossier_title_ibfk_3` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`id_job_title`) REFERENCES `job_title` (`id_job_title`) ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`id_profile`) REFERENCES `profile` (`id_profile`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `location_dossier`
--
ALTER TABLE `location_dossier`
  ADD CONSTRAINT `location_dossier_ibfk_1` FOREIGN KEY (`id_location_type`) REFERENCES `location_type` (`id_location_type`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`id_log_type`) REFERENCES `log_type` (`id_log_type`) ON UPDATE CASCADE,
  ADD CONSTRAINT `log_ibfk_2` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
