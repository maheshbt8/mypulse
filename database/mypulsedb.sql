-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2018 at 09:12 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mypulse`
--
CREATE DATABASE IF NOT EXISTS `mypulse` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mypulse`;

drop user if exists 'mypulsedba'@'localhost';
drop user if exists 'mypulsedbuser'@'localhost';

create user 'mypulsedba'@'localhost' identified by 'Password@123';
grant all privileges on *.* to 'mypulsedba'@'localhost' with grant option;

create user 'mypulsedbuser'@'localhost' identified by 'Password@123';
grant select, insert, update, delete on mypulse.* to 'mypulsedbuser'@'localhost';
-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_number` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time_start` longtext,
  `appointment_time_end` longtext,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=pending,2=confirmed,3=cancelled,4=closed',
  `reason` text NOT NULL,
  `remarks` text NOT NULL,
  `next_appointment` date DEFAULT NULL,
  `created_type` text NOT NULL,
  `created_by` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `attended_status` tinyint(4) NOT NULL DEFAULT '0'  COMMENT '0=not-attended,1=attended',
  PRIMARY KEY (`appointment_id`),
  KEY `fk_ap_depid` (`department_id`),
  KEY `fk_ap_doctid` (`doctor_id`),
  KEY `fk_ap_hospid` (`hospital_id`),
  KEY `fk_ap_usrid` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `appointment_history`
--

DROP TABLE IF EXISTS `appointment_history`;
CREATE TABLE IF NOT EXISTS `appointment_history` (
  `appointment_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) NOT NULL,
  `appointment_date` longtext NOT NULL,
  `appointment_time_start` longtext NOT NULL,
  `appointment_time_end` longtext NOT NULL,
  `created_type` text NOT NULL,
  `created_by` text NOT NULL,
  `reason` text NOT NULL,
  `action` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=created,2=pending,3=confirmed,4=updated,5=rescheduled,6=cancelled,7=closed',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`appointment_history_id`),
  KEY `fk_aph_apid` (`appointment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

DROP TABLE IF EXISTS `availability`;
CREATE TABLE IF NOT EXISTS `availability` (
  `availability_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `no_appt_handle` varchar(10) NOT NULL,
  `message` longtext NOT NULL,
  `start_time` longtext NOT NULL,
  `end_time` longtext NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1=available,2=not-available',
  PRIMARY KEY (`availability_id`),
  KEY `fk_av_doctid` (`doctor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `availability_slot`
--

DROP TABLE IF EXISTS `availability_slot`;
CREATE TABLE IF NOT EXISTS `availability_slot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `start_date` longtext NOT NULL,
  `end_date` longtext NOT NULL,
  `start_time` longtext NOT NULL,
  `end_time` longtext NOT NULL,
  `repeat_interval` tinyint(4) NOT NULL COMMENT '0=weekly,1=custom',
  `repeat_on` longtext NOT NULL COMMENT '0=S,1=M,2=T,3=W,4=T,5=F,6=S',
  `unik` longtext NOT NULL,
  `date` longtext NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1=active,2=inactive',
  PRIMARY KEY (`id`),
  KEY `fk_avs_doctid` (`doctor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

DROP TABLE IF EXISTS `bed`;
CREATE TABLE IF NOT EXISTS `bed` (
  `bed_id` int(11) NOT NULL AUTO_INCREMENT,
  `hospital_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `bed_status` tinyint(4) NOT NULL COMMENT '1=available,2=not-available',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=not-deleted,2=deleted',
  PRIMARY KEY (`bed_id`),
  KEY `fk_bed_brid` (`branch_id`),
  KEY `fk_bed_depid` (`department_id`),
  KEY `fk_bed_hospd` (`hospital_id`),
  KEY `fk_bed_wardid` (`ward_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
CREATE TABLE IF NOT EXISTS `branch` (
  `branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `hospital_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `city` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `country` int(11) NOT NULL,
   `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active,2=inactive',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=not-deleted,2=deleted',
  PRIMARY KEY (`branch_id`),
  KEY `fk_branchhospid` (`hospital_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `checkups`
--

DROP TABLE IF EXISTS `checkups`;
CREATE TABLE IF NOT EXISTS `checkups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tests` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  PRIMARY KEY (`city_id`),
  KEY `fk_cityctryid` (`country_id`),
  KEY `fk_citydistid` (`district_id`),
  KEY `fk_citystid` (`state_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;












DROP TABLE IF EXISTS `cron`;
CREATE TABLE `cron` (
  `id` int(5) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `command` varchar(255) NOT NULL,
  `interval_sec` int(10) NOT NULL,
  `last_run_at` datetime DEFAULT NULL,
  `next_run_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--
DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `hospital_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active,2=inactive',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=not-deleted,2=deleted',
  PRIMARY KEY (`department_id`),
  KEY `fk_deptbrid` (`branch_id`),
  KEY `fk_depthospid` (`hospital_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis_report`
--

DROP TABLE IF EXISTS `diagnosis_report`;
CREATE TABLE IF NOT EXISTS `diagnosis_report` (
  `diagnosis_report_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_type` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'xray,blood test',
  `document_type` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'text,photo',
  `file_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(11) NOT NULL,
  `laboratorist_id` int(11) NOT NULL,
  PRIMARY KEY (`diagnosis_report_id`),
  KEY `fk_digrpresid` (`prescription_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
CREATE TABLE IF NOT EXISTS `district` (
  `district_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  PRIMARY KEY (`district_id`),
  KEY `fk_distctrid` (`country_id`),
  KEY `fk_diststid` (`state_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
CREATE TABLE IF NOT EXISTS `doctors` (
  `doctor_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(100) NOT NULL,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mname` longtext NOT NULL,
  `lname` longtext NOT NULL,
  `email` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext NOT NULL,
  `gender` varchar(30) NOT NULL,
  `dob` text NOT NULL,
  `aadhar` varchar(50) NOT NULL,
  `qualification` longtext NOT NULL,
  `specializations` longtext NOT NULL,
  `experience` varchar(10) NOT NULL,
  `registration` varchar(50) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `is_email` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `is_mobile` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `status` tinyint(4) NOT NULL COMMENT '1=active,2=inactive',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=not-deleted,2=deleted',
  PRIMARY KEY (`doctor_id`),
  KEY `fk_dctrsbrid` (`branch_id`),
  KEY `fk_dctrdepid` (`department_id`),
  KEY `fk_dctrhosid` (`hospital_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `health_insurance_provider`
--

DROP TABLE IF EXISTS `health_insurance_provider`;
CREATE TABLE IF NOT EXISTS `health_insurance_provider` (
  `health_insurance_provider_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext NOT NULL,
  PRIMARY KEY (`health_insurance_provider_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hospitaladmins`
--

DROP TABLE IF EXISTS `hospitaladmins`;
CREATE TABLE IF NOT EXISTS `hospitaladmins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mname` longtext COLLATE utf8_unicode_ci NOT NULL,
  `lname` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `country` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `aadhar` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `gender` longtext COLLATE utf8_unicode_ci NOT NULL,
  `dob` longtext COLLATE utf8_unicode_ci NOT NULL,
  `qualification` longtext COLLATE utf8_unicode_ci NOT NULL,
  `profession` longtext COLLATE utf8_unicode_ci NOT NULL,
  `experience` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `last_login` longtext COLLATE utf8_unicode_ci NOT NULL,
  `last_logout` longtext COLLATE utf8_unicode_ci NOT NULL,
  `is_email` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `is_mobile` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `status` tinyint(4) NOT NULL COMMENT '1=active,2=inactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=not-deleted,2=deleted',
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

DROP TABLE IF EXISTS `hospitals`;
CREATE TABLE IF NOT EXISTS `hospitals` (
  `hospital_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(100) NOT NULL,
  `name` varchar(250) NOT NULL,
  `address` text,
  `description` text NOT NULL,
  `phone_number` text,
  `email` varchar(300) DEFAULT NULL,
  `license_category` varchar(250) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `district` varchar(250) DEFAULT NULL,
  `state` varchar(250) DEFAULT NULL,
  `country` varchar(250) DEFAULT NULL,
  `md_name` varchar(250) NOT NULL,
  `md_contact_number` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL COMMENT '1=active,2=inactive',
  `license` varchar(100) NOT NULL,
  `license_status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=active,2=inactive',
  `from_date` varchar(100) NOT NULL,
  `till_date` varchar(100) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=not-deleted,2=deleted',
  PRIMARY KEY (`hospital_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inpatient`
--

DROP TABLE IF EXISTS `inpatient`;
CREATE TABLE IF NOT EXISTS `inpatient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `bed_id` int(11) NOT NULL DEFAULT '0',
  `hospital_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `join_date` datetime NOT NULL,
  `discharged_date` datetime DEFAULT NULL,
  `reason` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0- recommended, 1- admitted, 2-discharged',
  `created_by` text NOT NULL,
  `created_date` longtext NOT NULL,
  `modified_date` longtext NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=not-deleted,2=deleted',
  PRIMARY KEY (`id`),
  KEY `fk_inpbedid` (`bed_id`),
  KEY `fk_inpdoctid` (`doctor_id`),
  KEY `fk_inphosid` (`hospital_id`),
  KEY `fk_inpusrid` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inpatient_history`
--

DROP TABLE IF EXISTS `inpatient_history`;
CREATE TABLE IF NOT EXISTS `inpatient_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `in_patient_id` int(11) NOT NULL,
  `created_date` longtext NOT NULL,
  `note` text NOT NULL,
  `cost` float NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_inphinpid` (`in_patient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` longtext COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `invoice_entries` longtext COLLATE utf8_unicode_ci NOT NULL,
  `creation_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `due_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'paid or unpaid',
  `vat_percentage` longtext COLLATE utf8_unicode_ci NOT NULL,
  `discount_amount` longtext COLLATE utf8_unicode_ci NOT NULL,
  `grand_total` int(11) NOT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `fk_invpatid` (`patient_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `language_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phrase_id` int(11) NOT NULL,
  `phrase` longtext COLLATE utf8_unicode_ci NOT NULL,
  `english` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bengali` longtext COLLATE utf8_unicode_ci NOT NULL,
  `spanish` longtext COLLATE utf8_unicode_ci NOT NULL,
  `arabic` longtext COLLATE utf8_unicode_ci NOT NULL,
  `dutch` longtext COLLATE utf8_unicode_ci NOT NULL,
  `polish` longtext COLLATE utf8_unicode_ci NOT NULL,
  `german` longtext COLLATE utf8_unicode_ci NOT NULL,
  `french` longtext COLLATE utf8_unicode_ci NOT NULL,
  `italian` longtext COLLATE utf8_unicode_ci NOT NULL,
  `russian` longtext COLLATE utf8_unicode_ci NOT NULL,
  `portugese` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `license`
--

DROP TABLE IF EXISTS `license`;
CREATE TABLE IF NOT EXISTS `license` (
  `license_id` int(11) NOT NULL AUTO_INCREMENT,
  `license_category_id` int(11) NOT NULL,
  `license_code` longtext NOT NULL,
  `name` longtext NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`license_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `medicallabs`
--

DROP TABLE IF EXISTS `medicallabs`;
CREATE TABLE IF NOT EXISTS `medicallabs` (
  `lab_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `owner_name` varchar(200) NOT NULL,
  `owner_mobile` varchar(200) NOT NULL,
  `hospital` int(11) NOT NULL,
  `branch` int(11) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` longtext NOT NULL,
  `aadhar` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `dob` varchar(200) NOT NULL,
  `in_address` varchar(200) NOT NULL,
  `profession` varchar(200) NOT NULL,
  `qualification` varchar(200) NOT NULL,
  `experience` varchar(200) NOT NULL,
  `in_mobile` varchar(100) NOT NULL,
  `country` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `is_email` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `is_mobile` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `status` tinyint(4) NOT NULL COMMENT '1=active,2=inactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=not-deleted,2=deleted',
  PRIMARY KEY (`lab_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `medicalstores`
--

DROP TABLE IF EXISTS `medicalstores`;
CREATE TABLE IF NOT EXISTS `medicalstores` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `owner_name` varchar(200) NOT NULL,
  `owner_mobile` varchar(200) NOT NULL,
  `hospital` int(11) NOT NULL,
  `branch` int(11) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` longtext NOT NULL,
  `aadhar` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `dob` varchar(200) NOT NULL,
  `in_address` varchar(200) NOT NULL,
  `profession` varchar(200) NOT NULL,
  `qualification` varchar(200) NOT NULL,
  `experience` varchar(200) NOT NULL,
  `country` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `is_email` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `is_mobile` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `status` tinyint(4) NOT NULL COMMENT '1=active,2=inactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=not-deleted,2=deleted',
  PRIMARY KEY (`store_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

DROP TABLE IF EXISTS `medicine`;
CREATE TABLE IF NOT EXISTS `medicine` (
  `medicine_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `medicine_category_id` int(11) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `price` longtext COLLATE utf8_unicode_ci NOT NULL,
  `manufacturing_company` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`medicine_id`),
  KEY `fk_medctgryid` (`medicine_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicine_category`
--

DROP TABLE IF EXISTS `medicine_category`;
CREATE TABLE IF NOT EXISTS `medicine_category` (
  `medicine_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`medicine_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--
DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` varchar(100) NOT NULL,
  `group_ids` text,
  `user_ids` text,
  `hospital_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `message` text NOT NULL,
  `is_read` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` text NOT NULL,
  `user_id` text NOT NULL,
  `title` text NOT NULL,
  `text` text NOT NULL,
  `isRead` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `action` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

DROP TABLE IF EXISTS `nurse`;
CREATE TABLE IF NOT EXISTS `nurse` (
  `nurse_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(100) NOT NULL,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mname` longtext NOT NULL,
  `lname` longtext NOT NULL,
  `email` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `doctor_id` text NOT NULL,
  `country` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `gender` varchar(30) NOT NULL,
  `dob` text NOT NULL,
  `aadhar` varchar(60) NOT NULL,
  `qualification` longtext NOT NULL,
  `experience` varchar(20) NOT NULL,
  `phone` longtext NOT NULL,
  `is_email` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `is_mobile` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `status` tinyint(4) NOT NULL COMMENT '1=active,2=inactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=not-deleted,2=deleted',
  PRIMARY KEY (`nurse_id`),
  KEY `fk_nurbrid` (`branch_id`),
  KEY `fk_nurdepid` (`department_id`),
  KEY `fk_nurhospid` (`hospital_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hospital_ids` text NOT NULL,
  `doctor_ids` text NOT NULL,
  `lab_ids` text NOT NULL,
  `store_ids` text NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

DROP TABLE IF EXISTS `prescription`;
CREATE TABLE IF NOT EXISTS `prescription` (
  `prescription_id` int(11) NOT NULL AUTO_INCREMENT,
 
  `doctor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prescription_data` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` longtext COLLATE utf8_unicode_ci NOT NULL,
  `modified_at` longtext COLLATE utf8_unicode_ci NOT NULL,
  `medicin_status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `test_status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=show,2=hide',
  PRIMARY KEY (`prescription_id`),
   KEY `fk_presusrid` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------









--
-- Table structure for table `prescription_order`
--

DROP TABLE IF EXISTS `prescription_order`;
CREATE TABLE IF NOT EXISTS `prescription_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,

  `prescription_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_type` tinyint(4) NOT NULL COMMENT '0=medicine,1=test',
  `type_of_order` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=by_prescription,1=by_own',
  `order_data` text NOT NULL,
  `quantity` text NOT NULL,
  `tests` longtext NOT NULL,
  `store_id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `cost` text NOT NULL,
  `price` text NOT NULL,
  `total` text NOT NULL,
  `receipt_created_at` longtext NOT NULL,
  `created_at` longtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=accepted,2=not-accepted',
  PRIMARY KEY (`order_id`),
  KEY `fk_presordlabid` (`lab_id`),
  KEY `fk_presordpresid` (`prescription_id`),
  KEY `fk_presordstrid` (`store_id`),
  KEY `fk_presordusrid` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prognosis`
--

DROP TABLE IF EXISTS `prognosis`;
CREATE TABLE IF NOT EXISTS `prognosis` (
  `prognosis_id` int(11) NOT NULL AUTO_INCREMENT ,
   `prognosis_data` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `created_at` longtext NOT NULL,
  `modified_at` longtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=show,2=hide',
  PRIMARY KEY (`prognosis_id`),
  KEY `fk_progadctid` (`doctor_id`),
  KEY `fk_progusrd` (`user_id`)
) ENGINE=MyISAM  AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `receptionist`
--

DROP TABLE IF EXISTS `receptionist`;
CREATE TABLE IF NOT EXISTS `receptionist` (
  `receptionist_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(100) NOT NULL,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mname` longtext NOT NULL,
  `lname` longtext NOT NULL,
  `email` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `doctor_id` text NOT NULL,
  `country` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `gender` varchar(30) NOT NULL,
  `dob` text NOT NULL,
  `aadhar` varchar(60) NOT NULL,
  `qualification` longtext NOT NULL,
  `experience` varchar(20) NOT NULL,
  `phone` longtext NOT NULL,
  `is_email` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `is_mobile` int(11) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `status` tinyint(4) NOT NULL COMMENT '1=active,2=inactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 `isDeleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=not-deleted,2=deleted',
  PRIMARY KEY (`receptionist_id`),
  KEY `fk_recbrid` (`branch_id`),
  KEY `fk_recdepid` (`department_id`),
  KEY `fk_rechospid` (`hospital_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Table structure for table `reports`
--
DROP TABLE IF EXISTS `reports`;
CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=by_order,1=by_own,2=no_order',
  `title` text NOT NULL,
  `created_by` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `extension` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=show,2=hide',
  PRIMARY KEY (`report_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

DROP TABLE IF EXISTS `specializations`;
CREATE TABLE IF NOT EXISTS `specializations` (
  `specializations_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`specializations_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY (`state_id`),
  KEY `fk_statectrid` (`country_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--


DROP TABLE IF EXISTS `superadmin`;
CREATE TABLE IF NOT EXISTS `superadmin` (
  `superadmin_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` text COLLATE utf8_unicode_ci NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mname` text COLLATE utf8_unicode_ci NOT NULL,
  `lname` text COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dob` text COLLATE utf8_unicode_ci NOT NULL,
  `country` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `is_email` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `is_mobile` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `status` tinyint(4) NOT NULL COMMENT '1=active,2=inactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=not-deleted,2=deleted',
  PRIMARY KEY (`superadmin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mname` longtext COLLATE utf8_unicode_ci NOT NULL,
  `lname` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `country` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `gender` longtext COLLATE utf8_unicode_ci NOT NULL,
  `dob` text COLLATE utf8_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `patient_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` longtext COLLATE utf8_unicode_ci NOT NULL,
  `in_time` longtext COLLATE utf8_unicode_ci NOT NULL,
  `account_opening_timestamp` int(11) NOT NULL,
  `aadhar` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `height` text COLLATE utf8_unicode_ci NOT NULL,
  `weight` text COLLATE utf8_unicode_ci NOT NULL,
  `blood_pressure` text COLLATE utf8_unicode_ci NOT NULL,
  `sugar_level` text COLLATE utf8_unicode_ci NOT NULL,
  `health_insurance_provider` longtext COLLATE utf8_unicode_ci NOT NULL,
  `health_insurance_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `family_history` longtext COLLATE utf8_unicode_ci NOT NULL,
  `past_medical_history` longtext COLLATE utf8_unicode_ci NOT NULL,
  `reg_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=registered,2=unregistered',
  `is_email` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `is_mobile` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active,2=inactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=not-deleted,2=deleted',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ward`
--

DROP TABLE IF EXISTS `ward`;
CREATE TABLE IF NOT EXISTS `ward` (
  `ward_id` int(11) NOT NULL AUTO_INCREMENT,
  `hospital_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active,2=inactive',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=not-deleted,2=deleted',
  PRIMARY KEY (`ward_id`),
  KEY `fk_wardbrid` (`branch_id`),
  KEY `fk_warddepid` (`department_id`),
  KEY `fk_wardhosid` (`hospital_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


DROP TABLE IF EXISTS `license_category`;

CREATE TABLE `license_category` (
  `license_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `license_category_code` varchar(60) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`license_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;


#
# TABLE STRUCTURE FOR: keys
#

DROP TABLE IF EXISTS `keys`;

CREATE TABLE `keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(60) NOT NULL,
  `feedback` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

alter table appointments add column isDeleted tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=not-deleted,2=deleted';

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
