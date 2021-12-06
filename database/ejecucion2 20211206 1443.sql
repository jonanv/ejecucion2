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
-- Create schema ejecucion2
--

CREATE DATABASE IF NOT EXISTS ejecucion2;
USE ejecucion2;

--
-- Definition of table `annotation_type`
--

DROP TABLE IF EXISTS `annotation_type`;
CREATE TABLE `annotation_type` (
  `id_annotation_type` int(11) NOT NULL AUTO_INCREMENT,
  `annotation_type_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `annotation_type_description` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id_annotation_type`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `annotation_type`
--

/*!40000 ALTER TABLE `annotation_type` DISABLE KEYS */;
INSERT INTO `annotation_type` (`id_annotation_type`,`annotation_type_name`,`annotation_type_description`) VALUES 
 (1,'Ubicar en juzgado de origen',NULL),
 (2,'Elaborar comisorios',NULL),
 (3,'Elaborar costas',NULL),
 (4,'Archivar',NULL),
 (5,'Elaborar oficio - memorial',NULL),
 (6,'Elaborar telegrama',NULL),
 (7,'Enviar a remates',NULL),
 (8,'Pasa al contador',NULL),
 (9,'Pasa para recurso',NULL),
 (10,'Proceso con orden de pago',NULL),
 (11,'Audiencia',NULL),
 (12,'Enviar al despacho una vez ejecutoriado el auto',NULL),
 (13,'Hacer Desglose',NULL),
 (14,'Hacer título',NULL),
 (15,'Hacer traslado',NULL),
 (16,'Proceso suspendido por términos',NULL),
 (17,'Realizar edicto emplazatorio',NULL),
 (18,'Remitir expediente digital',NULL),
 (19,'Revisar la liquidación del contador',NULL),
 (20,'Términos',NULL),
 (21,'Responder requerimiento',NULL);
/*!40000 ALTER TABLE `annotation_type` ENABLE KEYS */;


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
-- Definition of table `court`
--

DROP TABLE IF EXISTS `court`;
CREATE TABLE `court` (
  `id_court` int(11) NOT NULL AUTO_INCREMENT,
  `court_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `court_email` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_court_siglo_xxi` int(11) DEFAULT NULL,
  `court_identification_siglo_xxi` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_court`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `court`
--

/*!40000 ALTER TABLE `court` DISABLE KEYS */;
INSERT INTO `court` (`id_court`,`court_name`,`court_email`,`id_court_siglo_xxi`,`court_identification_siglo_xxi`) VALUES 
 (1,'Juzgado 1 Civil Municipal de Manizales',NULL,2001,'t101.A101CODIPONE IN(\'2001\',\'9011\')'),
 (2,'Juzgado 2 Civil Municipal de Manizales',NULL,2002,'t101.A101CODIPONE IN(\'2002\',\'9021\')'),
 (3,'Juzgado 3 Civil Municipal de Manizales',NULL,2003,'t101.A101CODIPONE IN(\'2003\',\'9031\')'),
 (4,'Juzgado 4 Civil Municipal de Manizales',NULL,2004,'t101.A101CODIPONE IN(\'2004\',\'9041\')'),
 (5,'Juzgado 5 Civil Municipal de Manizales',NULL,2005,'t101.A101CODIPONE IN(\'2005\',\'9051\')'),
 (6,'Juzgado 6 Civil Municipal de Manizales',NULL,2006,'t101.A101CODIPONE IN(\'2006\',\'9061\')'),
 (7,'Juzgado 7 Civil Municipal de Manizales',NULL,2007,'t101.A101CODIPONE IN(\'2007\',\'9071\')'),
 (8,'Juzgado 8 Civil Municipal de Manizales',NULL,2008,'t101.A101CODIPONE IN(\'2008\',\'9081\')'),
 (9,'Juzgado 9 Civil Municipal de Manizales',NULL,2009,'t101.A101CODIPONE IN(\'2009\',\'9091\')'),
 (10,'Juzgado 10 Civil Municipal de Manizales',NULL,2010,'t101.A101CODIPONE IN(\'2010\',\'9101\')'),
 (11,'Juzgado 11 Civil Municipal de Manizales',NULL,2011,'t101.A101CODIPONE IN(\'2011\',\'9111\')'),
 (12,'Juzgado 12 Civil Municipal de Manizales',NULL,2012,'t101.A101CODIPONE IN(\'2012\',\'9121\')'),
 (13,'Juzgado 1 de Ejecución Civil Municipal de Manizales','j01ejecmma@cendoj.ramajudicial.gov.co',9251,'t101.A101CODIPONE IN(\'9251\',\'9252\')'),
 (14,'Juzgado 2 de Ejecución Civil Municipal de Manizales','ofejcmma@notificacionesrj.gov.co',9261,'t101.A101CODIPONE IN(\'9261\',\'9262\')'),
 (15,'Oficina de Ejecución Civil Municipal de Manizales',NULL,NULL,NULL);
/*!40000 ALTER TABLE `court` ENABLE KEYS */;


--
-- Definition of table `defendant`
--

DROP TABLE IF EXISTS `defendant`;
CREATE TABLE `defendant` (
  `id_defendant` bigint(11) NOT NULL AUTO_INCREMENT,
  `defendant_identification` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `defendant_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_defendant`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `defendant`
--

/*!40000 ALTER TABLE `defendant` DISABLE KEYS */;
INSERT INTO `defendant` (`id_defendant`,`defendant_identification`,`defendant_name`) VALUES 
 (1,'17271','EVE DISTRIBUCIONES SA'),
 (2,'816007943','CORPORACION I.P.S EJE CAFETERO'),
 (3,'901097473','MEDIMAS EPS');
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
  `id_location_dossier` int(11) DEFAULT NULL,
  `id_court_origin` int(11) NOT NULL,
  `id_court_destination` int(11) DEFAULT NULL,
  `id_employee_registered` bigint(20) NOT NULL,
  `dossier_registered_date` datetime NOT NULL,
  `id_employee_archived` bigint(20) DEFAULT NULL,
  `dossier_archived_date` datetime DEFAULT NULL,
  `dossier_archived` tinyint(4) NOT NULL,
  `id_employee_blocked` bigint(20) DEFAULT NULL,
  `dossier_blocked_date` datetime DEFAULT NULL,
  `id_employee_unblocked` bigint(20) DEFAULT NULL,
  `dossier_unblocked_date` datetime DEFAULT NULL,
  `dossier_bloqued` tinyint(4) NOT NULL,
  `id_blocked_type` int(11) DEFAULT NULL,
  `id_dossier_type` int(11) NOT NULL,
  `digital_dossier` tinyint(1) NOT NULL,
  `electronic_dossier` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_dossier`),
  KEY `id_location_dossier` (`id_location_dossier`),
  KEY `id_dossier_type` (`id_dossier_type`),
  KEY `id_court_origin` (`id_court_origin`),
  KEY `id_court_destination` (`id_court_destination`),
  KEY `id_employee_registered` (`id_employee_registered`),
  KEY `id_employee_archived` (`id_employee_archived`),
  KEY `id_employee_blocked` (`id_employee_blocked`),
  KEY `id_blocked_type` (`id_blocked_type`),
  CONSTRAINT `dossier_ibfk_1` FOREIGN KEY (`id_location_dossier`) REFERENCES `location_dossier` (`id_location_dossier`) ON UPDATE CASCADE,
  CONSTRAINT `dossier_ibfk_2` FOREIGN KEY (`id_court_origin`) REFERENCES `court` (`id_court`) ON UPDATE CASCADE,
  CONSTRAINT `dossier_ibfk_3` FOREIGN KEY (`id_court_destination`) REFERENCES `court` (`id_court`) ON UPDATE CASCADE,
  CONSTRAINT `dossier_ibfk_4` FOREIGN KEY (`id_employee_registered`) REFERENCES `employee` (`id_employee`) ON UPDATE CASCADE,
  CONSTRAINT `dossier_ibfk_5` FOREIGN KEY (`id_employee_archived`) REFERENCES `employee` (`id_employee`) ON UPDATE CASCADE,
  CONSTRAINT `dossier_ibfk_6` FOREIGN KEY (`id_employee_blocked`) REFERENCES `employee` (`id_employee`) ON UPDATE CASCADE,
  CONSTRAINT `dossier_ibfk_7` FOREIGN KEY (`id_blocked_type`) REFERENCES `blocked_type` (`id_blocked_type`) ON UPDATE CASCADE,
  CONSTRAINT `dossier_ibfk_8` FOREIGN KEY (`id_dossier_type`) REFERENCES `dossier_type` (`id_dossier_type`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `dossier`
--

/*!40000 ALTER TABLE `dossier` DISABLE KEYS */;
INSERT INTO `dossier` (`id_dossier`,`radicado`,`instance`,`date_last_action`,`delivery_date`,`date_in_dispach`,`date_out_dispach`,`fault_dossier`,`fault_dossier_date`,`end_settlement_date`,`id_location_dossier`,`id_court_origin`,`id_court_destination`,`id_employee_registered`,`dossier_registered_date`,`id_employee_archived`,`dossier_archived_date`,`dossier_archived`,`id_employee_blocked`,`dossier_blocked_date`,`id_employee_unblocked`,`dossier_unblocked_date`,`dossier_bloqued`,`id_blocked_type`,`id_dossier_type`,`digital_dossier`,`electronic_dossier`) VALUES 
 (1,'17001430300220210016000','00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,NULL,1053816080,'2021-11-30 09:30:12',NULL,NULL,0,NULL,NULL,NULL,NULL,0,NULL,2,0,1);
/*!40000 ALTER TABLE `dossier` ENABLE KEYS */;


--
-- Definition of table `dossier_annotation`
--

DROP TABLE IF EXISTS `dossier_annotation`;
CREATE TABLE `dossier_annotation` (
  `id_dossier_annotation` int(11) NOT NULL AUTO_INCREMENT,
  `dossier_annotation_date` datetime NOT NULL,
  `id_annotation_type` int(11) NOT NULL,
  `id_dossier` bigint(20) NOT NULL,
  PRIMARY KEY (`id_dossier_annotation`) USING BTREE,
  KEY `id_dossier` (`id_dossier`),
  KEY `id_annotation_type` (`id_annotation_type`),
  CONSTRAINT `dossier_annotation_ibfk_2` FOREIGN KEY (`id_annotation_type`) REFERENCES `annotation_type` (`id_annotation_type`) ON UPDATE CASCADE,
  CONSTRAINT `dossier_annotation_ibfk_1` FOREIGN KEY (`id_dossier`) REFERENCES `dossier` (`id_dossier`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `dossier_annotation`
--

/*!40000 ALTER TABLE `dossier_annotation` DISABLE KEYS */;
/*!40000 ALTER TABLE `dossier_annotation` ENABLE KEYS */;


--
-- Definition of table `dossier_defendant`
--

DROP TABLE IF EXISTS `dossier_defendant`;
CREATE TABLE `dossier_defendant` (
  `id_dossier` bigint(20) NOT NULL,
  `id_defendant` bigint(20) NOT NULL,
  PRIMARY KEY (`id_dossier`,`id_defendant`),
  KEY `id_dossier` (`id_dossier`),
  KEY `id_defendant` (`id_defendant`),
  CONSTRAINT `dossier_defendant_ibfk_1` FOREIGN KEY (`id_dossier`) REFERENCES `dossier` (`id_dossier`) ON UPDATE CASCADE,
  CONSTRAINT `dossier_defendant_ibfk_2` FOREIGN KEY (`id_defendant`) REFERENCES `defendant` (`id_defendant`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `dossier_defendant`
--

/*!40000 ALTER TABLE `dossier_defendant` DISABLE KEYS */;
INSERT INTO `dossier_defendant` (`id_dossier`,`id_defendant`) VALUES 
 (1,1),
 (1,2),
 (1,3);
/*!40000 ALTER TABLE `dossier_defendant` ENABLE KEYS */;


--
-- Definition of table `dossier_plaintiff`
--

DROP TABLE IF EXISTS `dossier_plaintiff`;
CREATE TABLE `dossier_plaintiff` (
  `id_dossier` bigint(20) NOT NULL,
  `id_plaintiff` bigint(20) NOT NULL,
  PRIMARY KEY (`id_dossier`,`id_plaintiff`),
  KEY `id_dossier` (`id_dossier`),
  KEY `id_plaintiff` (`id_plaintiff`),
  CONSTRAINT `dossier_plaintiff_ibfk_1` FOREIGN KEY (`id_dossier`) REFERENCES `dossier` (`id_dossier`) ON UPDATE CASCADE,
  CONSTRAINT `dossier_plaintiff_ibfk_2` FOREIGN KEY (`id_plaintiff`) REFERENCES `plaintiff` (`id_plaintiff`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `dossier_plaintiff`
--

/*!40000 ALTER TABLE `dossier_plaintiff` DISABLE KEYS */;
INSERT INTO `dossier_plaintiff` (`id_dossier`,`id_plaintiff`) VALUES 
 (1,1);
/*!40000 ALTER TABLE `dossier_plaintiff` ENABLE KEYS */;


--
-- Definition of table `dossier_term`
--

DROP TABLE IF EXISTS `dossier_term`;
CREATE TABLE `dossier_term` (
  `id_dossier_term` int(11) NOT NULL AUTO_INCREMENT,
  `dossier_term_date` datetime NOT NULL,
  `dossier_term_registered_date` datetime NOT NULL,
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
  `title_dossier_registered_date` datetime NOT NULL,
  `title_dossier_value` bigint(20) NOT NULL,
  `title_dossier_beneficiary` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `title_dossier_quantity` int(11) NOT NULL,
  `title_dossier_payment_date` datetime DEFAULT NULL,
  `title_dossier_modified_date` datetime DEFAULT NULL,
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
  `dossier_type_description` text COLLATE utf8_spanish_ci,
  `id_dossier_type_siglo_xxi` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_dossier_type`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `dossier_type`
--

/*!40000 ALTER TABLE `dossier_type` DISABLE KEYS */;
INSERT INTO `dossier_type` (`id_dossier_type`,`dossier_type_name`,`dossier_type_description`,`id_dossier_type_siglo_xxi`) VALUES 
 (1,'No registra',NULL,0),
 (2,'Acciones de tutela (R)',NULL,7),
 (16,'Habeas corpus',NULL,417),
 (17,'Ordinario',NULL,3001),
 (18,'Abreviado',NULL,3002),
 (19,'Verbal sumario',NULL,3004),
 (20,'Verbal (Oralidad)',NULL,3015),
 (21,'Verbal (1)',NULL,3016),
 (22,'Ejecutivo mixto','Proceso ejecutivo',3051),
 (23,'Divisorios',NULL,3054),
 (24,'Ejecutivo singular','Proceso ejecutivo',3056),
 (25,'Ejecutivo con título hipotecario','Proceso ejecutivo',3057),
 (26,'Ejecutivo con título prendario','Proceso ejecutivo',3058),
 (27,'Especial',NULL,6005),
 (28,'Sucesión',NULL,9911);
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
  `id_profession` int(11) NOT NULL,
  `id_profile` int(11) NOT NULL,
  `enable_employee` tinyint(1) NOT NULL,
  `employee_image` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `employee_registered_date` datetime NOT NULL,
  `employee_modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_employee`),
  KEY `id_job_title` (`id_job_title`),
  KEY `id_profile` (`id_profile`),
  KEY `id_profession` (`id_profession`),
  CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`id_job_title`) REFERENCES `job_title` (`id_job_title`) ON UPDATE CASCADE,
  CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`id_profile`) REFERENCES `profile` (`id_profile`) ON UPDATE CASCADE,
  CONSTRAINT `employee_ibfk_3` FOREIGN KEY (`id_profession`) REFERENCES `profession` (`id_profession`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `employee`
--

/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` (`id_employee`,`firstname`,`lastname`,`password`,`email`,`id_job_title`,`id_profession`,`id_profile`,`enable_employee`,`employee_image`,`employee_registered_date`,`employee_modified_date`) VALUES 
 (1053816080,'Johanny','Vargas González','VDFoVmJUSEh6ZlRnMjM4M3RGZkNHZz09','jvargasgo@cendoj.ramajudicial.gov.co',3,2,1,1,'avatar0.png','0000-00-00 00:00:00',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `log`
--

/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` (`id_log`,`log_date`,`log_action`,`log_detail`,`id_log_type`,`id_employee`) VALUES 
 (1,'2021-11-30 09:30:12','Se realiza Migración de Tutela: 17001430300220210016000','Johanny Vargas González realiza Migración de Tutela: 17001430300220210016000 2021-11-30 a las: 09:30:12am',1,1053816080);
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `log_type`
--

/*!40000 ALTER TABLE `log_type` DISABLE KEYS */;
INSERT INTO `log_type` (`id_log_type`,`log_type_name`,`log_type_description`) VALUES 
 (1,'Archivo',NULL),
 (2,'Correspondencia',NULL),
 (3,'Arancel',NULL),
 (4,'SIREG',NULL),
 (5,'Administrar',NULL),
 (6,'MOLIC',NULL),
 (7,'Hoja de vida',NULL),
 (8,'Expediente digital',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `plaintiff`
--

/*!40000 ALTER TABLE `plaintiff` DISABLE KEYS */;
INSERT INTO `plaintiff` (`id_plaintiff`,`plaintiff_identification`,`plaintiff_name`) VALUES 
 (1,'24300647','MARIA NOELIA - LONDOÑO GIRALDO');
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
 (2,'Administrador',NULL),
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
