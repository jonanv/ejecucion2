-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.23


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema laborales2
--

CREATE DATABASE IF NOT EXISTS laborales2;
USE laborales2;

--
-- Definition of table `blocked_type`
--

DROP TABLE IF EXISTS `blocked_type`;
CREATE TABLE `blocked_type` (
  `id_blocked_type` int(11) NOT NULL AUTO_INCREMENT,
  `blocked_type_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `blocked_type_description` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id_blocked_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `blocked_type`
--

/*!40000 ALTER TABLE `blocked_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `blocked_type` ENABLE KEYS */;


--
-- Definition of table `correspondence`
--

DROP TABLE IF EXISTS `correspondence`;
CREATE TABLE `correspondence` (
  `id_correspondence` int(11) NOT NULL AUTO_INCREMENT,
  `correspondence_date` datetime NOT NULL,
  `pettioner_identification` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `petitioner` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `pettioner_phone` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pages_correspondence` int(11) NOT NULL,
  `id_document_type` int(11) NOT NULL,
  `id_request_type` int(11) NOT NULL,
  `id_dossier` bigint(20) NOT NULL,
  `id_employee` bigint(20) NOT NULL,
  PRIMARY KEY (`id_correspondence`),
  KEY `id_document_type` (`id_document_type`),
  KEY `id_request_type` (`id_request_type`),
  KEY `id_dossier` (`id_dossier`),
  KEY `id_employee` (`id_employee`),
  CONSTRAINT `correspondence_ibfk_1` FOREIGN KEY (`id_document_type`) REFERENCES `document_type` (`id_document_type`) ON UPDATE CASCADE,
  CONSTRAINT `correspondence_ibfk_2` FOREIGN KEY (`id_request_type`) REFERENCES `request_type` (`id_request_type`) ON UPDATE CASCADE,
  CONSTRAINT `correspondence_ibfk_3` FOREIGN KEY (`id_dossier`) REFERENCES `dossier` (`id_dossier`) ON UPDATE CASCADE,
  CONSTRAINT `correspondence_ibfk_4` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `correspondence`
--

/*!40000 ALTER TABLE `correspondence` DISABLE KEYS */;
/*!40000 ALTER TABLE `correspondence` ENABLE KEYS */;


--
-- Definition of table `defendant`
--

DROP TABLE IF EXISTS `defendant`;
CREATE TABLE `defendant` (
  `id_defendant` bigint(11) NOT NULL AUTO_INCREMENT,
  `defendant_identification` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `defendant_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_defendant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `defendant`
--

/*!40000 ALTER TABLE `defendant` DISABLE KEYS */;
/*!40000 ALTER TABLE `defendant` ENABLE KEYS */;


--
-- Definition of table `document_type`
--

DROP TABLE IF EXISTS `document_type`;
CREATE TABLE `document_type` (
  `id_document_type` int(11) NOT NULL AUTO_INCREMENT,
  `document_type_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `document_type_description` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id_document_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `document_type`
--

/*!40000 ALTER TABLE `document_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `document_type` ENABLE KEYS */;


--
-- Definition of table `dossier`
--

DROP TABLE IF EXISTS `dossier`;
CREATE TABLE `dossier` (
  `id_dossier` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `id_dossier_type` int(11) NOT NULL,
  PRIMARY KEY (`id_dossier`),
  KEY `id_location_dossier` (`id_location_dossier`),
  KEY `id_defendant` (`id_defendant`),
  KEY `id_plaintiff` (`id_plaintiff`),
  KEY `id_dossier_registration` (`id_dossier_registration`),
  KEY `id_dossier_archived` (`id_dossier_archived`),
  KEY `id_dossier_blocked` (`id_dossier_blocked`),
  KEY `id_dossier_type` (`id_dossier_type`),
  CONSTRAINT `dossier_ibfk_1` FOREIGN KEY (`id_location_dossier`) REFERENCES `location_dossier` (`id_location_dossier`) ON UPDATE CASCADE,
  CONSTRAINT `dossier_ibfk_2` FOREIGN KEY (`id_defendant`) REFERENCES `defendant` (`id_defendant`) ON UPDATE CASCADE,
  CONSTRAINT `dossier_ibfk_3` FOREIGN KEY (`id_plaintiff`) REFERENCES `plaintiff` (`id_plaintiff`) ON UPDATE CASCADE,
  CONSTRAINT `dossier_ibfk_4` FOREIGN KEY (`id_dossier_registration`) REFERENCES `dossier_registration` (`id_dossier_registration`) ON UPDATE CASCADE,
  CONSTRAINT `dossier_ibfk_5` FOREIGN KEY (`id_dossier_archived`) REFERENCES `dossier_archived` (`id_dossier_archived`) ON UPDATE CASCADE,
  CONSTRAINT `dossier_ibfk_6` FOREIGN KEY (`id_dossier_blocked`) REFERENCES `dossier_blocked` (`id_dossier_bloqued`) ON UPDATE CASCADE,
  CONSTRAINT `dossier_ibfk_7` FOREIGN KEY (`id_dossier_type`) REFERENCES `dossier_type` (`id_dossier_type`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `dossier`
--

/*!40000 ALTER TABLE `dossier` DISABLE KEYS */;
/*!40000 ALTER TABLE `dossier` ENABLE KEYS */;


--
-- Definition of table `dossier_annotation`
--

DROP TABLE IF EXISTS `dossier_annotation`;
CREATE TABLE `dossier_annotation` (
  `id_dossier_annotation` int(11) NOT NULL AUTO_INCREMENT,
  `dossier_annotation_date` datetime NOT NULL,
  `dossier_annotation_observation` text COLLATE utf8_spanish_ci NOT NULL,
  `id_dossier` bigint(20) NOT NULL,
  PRIMARY KEY (`id_dossier_annotation`) USING BTREE,
  KEY `id_dossier` (`id_dossier`),
  CONSTRAINT `dossier_annotation_ibfk_1` FOREIGN KEY (`id_dossier`) REFERENCES `dossier` (`id_dossier`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `dossier_annotation`
--

/*!40000 ALTER TABLE `dossier_annotation` DISABLE KEYS */;
/*!40000 ALTER TABLE `dossier_annotation` ENABLE KEYS */;


--
-- Definition of table `dossier_archived`
--

DROP TABLE IF EXISTS `dossier_archived`;
CREATE TABLE `dossier_archived` (
  `id_dossier_archived` int(11) NOT NULL AUTO_INCREMENT,
  `id_employee` bigint(20) NOT NULL,
  `dossier_archived_date` datetime NOT NULL,
  `dossier_archived` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_dossier_archived`),
  KEY `id_employee` (`id_employee`),
  CONSTRAINT `dossier_archived_ibfk_1` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `dossier_archived`
--

/*!40000 ALTER TABLE `dossier_archived` DISABLE KEYS */;
/*!40000 ALTER TABLE `dossier_archived` ENABLE KEYS */;


--
-- Definition of table `dossier_blocked`
--

DROP TABLE IF EXISTS `dossier_blocked`;
CREATE TABLE `dossier_blocked` (
  `id_dossier_bloqued` int(11) NOT NULL AUTO_INCREMENT,
  `id_employee` bigint(20) NOT NULL,
  `dossier_blocked_date` datetime NOT NULL,
  `dossier_unblocked_date` datetime DEFAULT NULL,
  `dossier_bloqued` tinyint(1) NOT NULL,
  `id_blocked_type` int(11) NOT NULL,
  PRIMARY KEY (`id_dossier_bloqued`),
  KEY `id_blocked_type` (`id_blocked_type`),
  KEY `id_employee` (`id_employee`),
  CONSTRAINT `dossier_blocked_ibfk_1` FOREIGN KEY (`id_blocked_type`) REFERENCES `blocked_type` (`id_blocked_type`) ON UPDATE CASCADE,
  CONSTRAINT `dossier_blocked_ibfk_2` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `dossier_blocked`
--

/*!40000 ALTER TABLE `dossier_blocked` DISABLE KEYS */;
/*!40000 ALTER TABLE `dossier_blocked` ENABLE KEYS */;


--
-- Definition of table `dossier_registration`
--

DROP TABLE IF EXISTS `dossier_registration`;
CREATE TABLE `dossier_registration` (
  `id_dossier_registration` int(11) NOT NULL AUTO_INCREMENT,
  `id_employee` bigint(20) NOT NULL,
  `dossier_registration_date` datetime NOT NULL,
  PRIMARY KEY (`id_dossier_registration`),
  KEY `id_employee` (`id_employee`),
  CONSTRAINT `dossier_registration_ibfk_1` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `dossier_registration`
--

/*!40000 ALTER TABLE `dossier_registration` DISABLE KEYS */;
/*!40000 ALTER TABLE `dossier_registration` ENABLE KEYS */;


--
-- Definition of table `dossier_term`
--

DROP TABLE IF EXISTS `dossier_term`;
CREATE TABLE `dossier_term` (
  `id_dossier_term` int(11) NOT NULL AUTO_INCREMENT,
  `dossier_term_date` datetime NOT NULL,
  `dossier_term_registration_date` datetime NOT NULL,
  `dossier_term_observation` text COLLATE utf8_spanish_ci NOT NULL,
  `dossier_term_revised` tinyint(1) NOT NULL,
  `id_dossier` bigint(20) NOT NULL,
  `id_term_type` int(11) NOT NULL,
  `id_employee` bigint(20) NOT NULL,
  PRIMARY KEY (`id_dossier_term`),
  KEY `id_term_type` (`id_term_type`),
  KEY `id_dossier` (`id_dossier`),
  KEY `id_employee` (`id_employee`),
  CONSTRAINT `dossier_term_ibfk_1` FOREIGN KEY (`id_term_type`) REFERENCES `term_type` (`id_term_type`) ON UPDATE CASCADE,
  CONSTRAINT `dossier_term_ibfk_2` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON UPDATE CASCADE,
  CONSTRAINT `dossier_term_ibfk_3` FOREIGN KEY (`id_dossier`) REFERENCES `dossier` (`id_dossier`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `dossier_term`
--

/*!40000 ALTER TABLE `dossier_term` DISABLE KEYS */;
/*!40000 ALTER TABLE `dossier_term` ENABLE KEYS */;


--
-- Definition of table `dossier_title`
--

DROP TABLE IF EXISTS `dossier_title`;
CREATE TABLE `dossier_title` (
  `id_dossier_title` int(11) NOT NULL AUTO_INCREMENT,
  `title_dossier_date` datetime NOT NULL,
  `title_dossier_value` bigint(20) NOT NULL,
  `title_dossier_beneficiary` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `title_dossier_quantity` int(11) NOT NULL,
  `title_dossier_payment_date` datetime DEFAULT NULL,
  `title_dossier_modification_date` datetime DEFAULT NULL,
  `id_title_type` int(11) NOT NULL,
  `id_dossier` bigint(20) NOT NULL,
  `id_employee` bigint(20) NOT NULL,
  PRIMARY KEY (`id_dossier_title`),
  KEY `id_title_type` (`id_title_type`),
  KEY `id_dossier` (`id_dossier`),
  KEY `id_employee` (`id_employee`),
  CONSTRAINT `dossier_title_ibfk_1` FOREIGN KEY (`id_title_type`) REFERENCES `title_type` (`id_title_type`) ON UPDATE CASCADE,
  CONSTRAINT `dossier_title_ibfk_2` FOREIGN KEY (`id_dossier`) REFERENCES `dossier` (`id_dossier`) ON UPDATE CASCADE,
  CONSTRAINT `dossier_title_ibfk_3` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `dossier_title`
--

/*!40000 ALTER TABLE `dossier_title` DISABLE KEYS */;
/*!40000 ALTER TABLE `dossier_title` ENABLE KEYS */;


--
-- Definition of table `dossier_type`
--

DROP TABLE IF EXISTS `dossier_type`;
CREATE TABLE `dossier_type` (
  `id_dossier_type` int(11) NOT NULL AUTO_INCREMENT,
  `dossier_type_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `dossier_type_description` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_dossier_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `dossier_type`
--

/*!40000 ALTER TABLE `dossier_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `dossier_type` ENABLE KEYS */;


--
-- Definition of table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `id_employee` bigint(20) NOT NULL,
  `firstname` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `id_job_title` int(11) NOT NULL,
  `id_profile` int(11) NOT NULL,
  `id_profession` int(11) NOT NULL,
  `enable_employee` tinyint(1) NOT NULL,
  `employee_image` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_employee`),
  KEY `id_job_title` (`id_job_title`),
  KEY `id_profile` (`id_profile`),
  KEY `id_profession` (`id_profession`),
  CONSTRAINT `employee_ibfk_3` FOREIGN KEY (`id_profession`) REFERENCES `profession` (`id_profession`) ON UPDATE CASCADE,
  CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`id_job_title`) REFERENCES `job_title` (`id_job_title`) ON UPDATE CASCADE,
  CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`id_profile`) REFERENCES `profile` (`id_profile`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `employee`
--

/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;


--
-- Definition of table `job_title`
--

DROP TABLE IF EXISTS `job_title`;
CREATE TABLE `job_title` (
  `id_job_title` int(11) NOT NULL AUTO_INCREMENT,
  `job_title_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `job_title_description` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id_job_title`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `job_title`
--

/*!40000 ALTER TABLE `job_title` DISABLE KEYS */;
INSERT INTO `job_title` (`id_job_title`,`job_title_name`,`job_title_description`) VALUES 
 (1,'Profesional Universitario Grado 20',NULL),
 (2,'Profesional Universitario Grado 17',NULL),
 (3,'Profesional Universitario Grado 11',NULL),
 (4,'Técnico en Sistemas Grado 10',NULL),
 (5,'Asistente Administrativo Grado 5',NULL);
/*!40000 ALTER TABLE `job_title` ENABLE KEYS */;


--
-- Definition of table `location_dossier`
--

DROP TABLE IF EXISTS `location_dossier`;
CREATE TABLE `location_dossier` (
  `id_location_dossier` int(11) NOT NULL AUTO_INCREMENT,
  `floor_location_dossier` int(11) NOT NULL,
  `location_dossier_observation` text COLLATE utf8_spanish_ci NOT NULL,
  `position` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `location_dossier_date` datetime NOT NULL,
  `id_location_type` int(11) NOT NULL,
  PRIMARY KEY (`id_location_dossier`),
  KEY `id_location_type` (`id_location_type`),
  CONSTRAINT `location_dossier_ibfk_1` FOREIGN KEY (`id_location_type`) REFERENCES `location_type` (`id_location_type`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `location_dossier`
--

/*!40000 ALTER TABLE `location_dossier` DISABLE KEYS */;
/*!40000 ALTER TABLE `location_dossier` ENABLE KEYS */;


--
-- Definition of table `location_type`
--

DROP TABLE IF EXISTS `location_type`;
CREATE TABLE `location_type` (
  `id_location_type` int(11) NOT NULL AUTO_INCREMENT,
  `location_type_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `location_type_description` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id_location_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `location_type`
--

/*!40000 ALTER TABLE `location_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `location_type` ENABLE KEYS */;


--
-- Definition of table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `log_date` datetime NOT NULL,
  `log_action` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `log_detail` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `id_log_type` int(11) NOT NULL,
  `id_employee` bigint(20) NOT NULL,
  PRIMARY KEY (`id_log`),
  KEY `id_log_type` (`id_log_type`),
  KEY `id_employee` (`id_employee`),
  CONSTRAINT `log_ibfk_1` FOREIGN KEY (`id_log_type`) REFERENCES `log_type` (`id_log_type`) ON UPDATE CASCADE,
  CONSTRAINT `log_ibfk_2` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `log`
--

/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;


--
-- Definition of table `log_type`
--

DROP TABLE IF EXISTS `log_type`;
CREATE TABLE `log_type` (
  `id_log_type` int(11) NOT NULL AUTO_INCREMENT,
  `log_type_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `log_type_description` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id_log_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `log_type`
--

/*!40000 ALTER TABLE `log_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_type` ENABLE KEYS */;


--
-- Definition of table `plaintiff`
--

DROP TABLE IF EXISTS `plaintiff`;
CREATE TABLE `plaintiff` (
  `id_plaintiff` bigint(20) NOT NULL AUTO_INCREMENT,
  `plaintiff_identification` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `plaintiff_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_plaintiff`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `plaintiff`
--

/*!40000 ALTER TABLE `plaintiff` DISABLE KEYS */;
/*!40000 ALTER TABLE `plaintiff` ENABLE KEYS */;


--
-- Definition of table `profession`
--

DROP TABLE IF EXISTS `profession`;
CREATE TABLE `profession` (
  `id_profession` int(11) NOT NULL AUTO_INCREMENT,
  `profession_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `profession_description` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_profession`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `profession`
--

/*!40000 ALTER TABLE `profession` DISABLE KEYS */;
INSERT INTO `profession` (`id_profession`,`profession_name`,`profession_description`) VALUES 
 (1,'Abogado',NULL),
 (2,'Ingeniero en Sistemas',NULL),
 (3,'Ingeniero Industrial',NULL),
 (4,'Contador Público',NULL);
/*!40000 ALTER TABLE `profession` ENABLE KEYS */;


--
-- Definition of table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `id_profile` int(11) NOT NULL AUTO_INCREMENT,
  `profile_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `profile_description` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id_profile`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `profile`
--

/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` (`id_profile`,`profile_name`,`profile_description`) VALUES 
 (1,'Superadministrador',NULL),
 (2,'Adinistrador',NULL),
 (3,'Archivador',NULL),
 (4,'Correspondencia',NULL);
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;


--
-- Definition of table `request_type`
--

DROP TABLE IF EXISTS `request_type`;
CREATE TABLE `request_type` (
  `id_request_type` int(11) NOT NULL AUTO_INCREMENT,
  `request_type_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `request_type_description` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id_request_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `request_type`
--

/*!40000 ALTER TABLE `request_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `request_type` ENABLE KEYS */;


--
-- Definition of table `term_type`
--

DROP TABLE IF EXISTS `term_type`;
CREATE TABLE `term_type` (
  `id_term_type` int(11) NOT NULL AUTO_INCREMENT,
  `term_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `term_type_days` int(11) NOT NULL,
  `term_type_description` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id_term_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `term_type`
--

/*!40000 ALTER TABLE `term_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `term_type` ENABLE KEYS */;


--
-- Definition of table `title_type`
--

DROP TABLE IF EXISTS `title_type`;
CREATE TABLE `title_type` (
  `id_title_type` int(11) NOT NULL AUTO_INCREMENT,
  `title_type_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `title_type_description` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id_title_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `title_type`
--

/*!40000 ALTER TABLE `title_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `title_type` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
