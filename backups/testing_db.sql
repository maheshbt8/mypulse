-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2017 at 02:48 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

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

-- --------------------------------------------------------

--
-- Table structure for table `hms_activitylog`
--

CREATE TABLE `hms_activitylog` (
  `id` int(11) NOT NULL,
  `description` varchar(250) NOT NULL,
  `item_type` varchar(250) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_activitylog`
--

INSERT INTO `hms_activitylog` (`id`, `description`, `item_type`, `item_id`, `user_id`, `user_name`, `created_at`) VALUES
(1, 'New hospital created', 'Hospital', 1, 1, 'Super Admin', '2017-11-21 07:24:52'),
(2, 'New user created', 'User', 162, 0, '', '2017-11-21 08:01:34'),
(3, 'User role updated', 'User', 162, 162, 'Hospital Admin', '2017-11-21 08:10:24'),
(4, 'User details updated', 'User', 162, 1, 'Super Admin', '2017-11-21 08:12:50'),
(5, 'Hospital admin details updated', 'HospitalAdmin', 1, 1, 'Super Admin', '2017-11-21 08:12:50'),
(6, 'New hospital created', 'Hospital', 2, 1, 'Super Admin', '2017-11-21 08:16:30'),
(7, 'New branch: h2_Branch1 added', 'Branch', 1, 1, 'Super Admin', '2017-11-21 08:20:58'),
(8, 'Hospital details updated', 'Hospital', 1, 1, 'Super Admin', '2017-11-21 08:40:43'),
(9, 'Hospital details updated', 'Hospital', 2, 1, 'Super Admin', '2017-11-21 08:43:20'),
(10, 'Hospital details updated', 'Hospital', 2, 1, 'Super Admin', '2017-11-21 08:43:31'),
(11, 'Hospital details updated', 'Hospital', 2, 1, 'Super Admin', '2017-11-21 08:44:08'),
(12, 'Hospital details updated', 'Hospital', 1, 1, 'Super Admin', '2017-11-21 08:44:16'),
(13, 'Hospital details updated', 'Hospital', 1, 1, 'Super Admin', '2017-11-21 08:45:49'),
(14, 'User details updated', 'User', 162, 1, 'Super Admin', '2017-11-21 08:54:25'),
(15, 'Hospital admin details updated', 'HospitalAdmin', 1, 1, 'Super Admin', '2017-11-21 08:54:25'),
(16, 'Branch: h1_Branch1 updated', 'Branch', 1, 1, 'Super Admin', '2017-11-21 10:01:32'),
(17, 'New branch: h1_Branch2 added', 'Branch', 2, 1, 'Super Admin', '2017-11-21 10:02:28'),
(18, 'New branch: h1_Branch3 added', 'Branch', 3, 1, 'Super Admin', '2017-11-21 10:04:14'),
(19, 'Branch soft deleted', 'Branch', 3, 1, 'Super Admin', '2017-11-21 10:04:20'),
(20, 'New department: h1_b1_Dept1 created', 'Department', 1, 1, 'Super Admin', '2017-11-21 10:05:08'),
(21, 'New department: h1_b1_Dept2 created', 'Department', 2, 1, 'Super Admin', '2017-11-21 10:05:36'),
(22, 'New department: h1_b2_Dept1 created', 'Department', 3, 1, 'Super Admin', '2017-11-21 10:06:02'),
(23, 'Department soft deleted', 'Department', 3, 1, 'Super Admin', '2017-11-21 10:06:11'),
(24, 'Department: h1_b1_Dept2 updated', 'Department', 2, 1, 'Super Admin', '2017-11-21 10:06:23'),
(25, 'Department: h1_b1_Dept2 updated', 'Department', 2, 1, 'Super Admin', '2017-11-21 10:06:36'),
(26, 'New ward added', 'Ward', 1, 1, 'Super Admin', '2017-11-21 10:07:56'),
(27, 'New ward added', 'Ward', 2, 1, 'Super Admin', '2017-11-21 10:08:18'),
(28, 'New ward added', 'Ward', 3, 1, 'Super Admin', '2017-11-21 10:09:04'),
(29, 'Ward details soft deleted', 'Ward', 3, 1, 'Super Admin', '2017-11-21 10:10:43'),
(30, 'New bed:B1 added', 'Bed', 1, 1, 'Super Admin', '2017-11-21 10:13:58'),
(31, 'Bed:B1 updated', 'Bed', 0, 1, 'Super Admin', '2017-11-21 10:14:27'),
(32, 'Bed:B1 updated', 'Bed', 0, 1, 'Super Admin', '2017-11-21 10:51:50'),
(33, 'New bed:B4 added', 'Bed', 5, 1, 'Super Admin', '2017-11-21 11:07:57'),
(34, 'Bed soft deleted', 'Bed', 1, 1, 'Super Admin', '2017-11-21 11:09:16'),
(35, 'Bed soft deleted', 'Bed', 2, 1, 'Super Admin', '2017-11-21 11:09:16'),
(36, 'Bed soft deleted', 'Bed', 3, 1, 'Super Admin', '2017-11-21 11:09:16'),
(37, 'Bed soft deleted', 'Bed', 4, 1, 'Super Admin', '2017-11-21 11:09:16'),
(38, 'Bed soft deleted', 'Bed', 5, 1, 'Super Admin', '2017-11-21 11:09:16'),
(39, 'New bed:B1 added', 'Bed', 6, 1, 'Super Admin', '2017-11-21 11:09:52'),
(40, 'New bed:B2 added', 'Bed', 7, 1, 'Super Admin', '2017-11-21 11:10:36'),
(41, 'New bed:B3 added', 'Bed', 8, 1, 'Super Admin', '2017-11-21 11:11:02'),
(42, 'Bed soft deleted', 'Bed', 8, 1, 'Super Admin', '2017-11-21 11:11:20'),
(43, 'New bed:b3 added', 'Bed', 9, 1, 'Super Admin', '2017-11-21 11:18:08'),
(44, 'Bed:B3 updated', 'Bed', 9, 1, 'Super Admin', '2017-11-21 11:23:08'),
(45, 'New bed:B5 added', 'Bed', 10, 1, 'Super Admin', '2017-11-21 11:25:11'),
(46, 'Bed soft deleted', 'Bed', 10, 1, 'Super Admin', '2017-11-21 11:25:19'),
(47, 'New ward added', 'Ward', 4, 1, 'Super Admin', '2017-11-21 11:26:09'),
(48, 'Bed soft deleted', 'Bed', 9, 1, 'Super Admin', '2017-11-21 11:26:31'),
(49, 'New bed:B5 added', 'Bed', 11, 1, 'Super Admin', '2017-11-21 11:27:10'),
(50, 'New charge created', 'Charge', 1, 1, 'Super Admin', '2017-11-21 11:41:13'),
(51, 'New charge created', 'Charge', 2, 1, 'Super Admin', '2017-11-21 11:42:50'),
(52, 'New charge created', 'Charge', 3, 1, 'Super Admin', '2017-11-21 11:44:37'),
(53, 'Charge updated', 'Charge', 2, 1, 'Super Admin', '2017-11-21 11:45:00'),
(54, 'New charge created', 'Charge', 4, 1, 'Super Admin', '2017-11-21 11:45:40'),
(55, 'Charge soft deleted', 'Charge', 4, 1, 'Super Admin', '2017-11-21 11:45:48'),
(56, 'Charge soft deleted', 'Charge', 3, 1, 'Super Admin', '2017-11-21 11:45:57'),
(57, 'New user created', 'User', 163, 0, '', '2017-11-21 11:49:07'),
(58, 'User role updated', 'User', 163, 163, 'Dr. Ravi', '2017-11-21 11:50:17'),
(59, 'New user created', 'User', 164, 162, 'Hospital1 Admin', '2017-11-21 12:16:56'),
(60, 'User details updated', 'User', 163, 162, 'Hospital1 Admin', '2017-11-21 12:55:30'),
(61, 'Doctor details updated', 'Doctor', 1, 162, 'Hospital1 Admin', '2017-11-21 12:55:30'),
(62, 'New bed:B6 added', 'Bed', 12, 162, 'Hospital1 Admin', '2017-11-21 13:49:25'),
(63, 'New bed:B7 added', 'Bed', 13, 162, 'Hospital1 Admin', '2017-11-21 13:49:53'),
(64, 'Bed:B1 updated', 'Bed', 6, 162, 'Hospital1 Admin', '2017-11-21 13:50:30'),
(65, 'New user created', 'User', 165, 162, 'Hospital1 Admin', '2017-11-21 14:04:48'),
(66, 'New doctor added', 'Doctor', 2, 162, 'Hospital1 Admin', '2017-11-21 14:04:53'),
(67, 'Doctor details soft deleted', 'Doctor', 1, 162, 'Hospital1 Admin', '2017-11-21 14:05:01'),
(68, 'New user created', 'User', 166, 0, '', '2017-11-21 14:05:55'),
(69, 'User role updated', 'User', 166, 166, 'Nurse ', '2017-11-21 14:08:53'),
(70, 'User details updated', 'User', 166, 162, 'Hospital1 Admin', '2017-11-21 14:09:57'),
(71, 'Nurse details updated', 'Nurse', 1, 162, 'Hospital1 Admin', '2017-11-21 14:09:57'),
(72, 'New user created', 'User', 167, 162, 'Hospital1 Admin', '2017-11-21 14:11:04'),
(73, 'New nurse added', 'Nurse', 2, 162, 'Hospital1 Admin', '2017-11-21 14:11:07'),
(74, 'New user created', 'User', 168, 162, 'Hospital1 Admin', '2017-11-21 14:11:47'),
(75, 'New nurse added', 'Nurse', 3, 162, 'Hospital1 Admin', '2017-11-21 14:11:47'),
(76, 'New user created', 'User', 169, 162, 'Hospital1 Admin', '2017-11-21 14:13:32'),
(77, 'New nurse added', 'Nurse', 4, 162, 'Hospital1 Admin', '2017-11-21 14:13:36'),
(78, 'New user created', 'User', 170, 162, 'Hospital1 Admin', '2017-11-21 14:19:42'),
(79, 'New nurse added', 'Nurse', 5, 162, 'Hospital1 Admin', '2017-11-21 14:19:46'),
(80, 'New user created', 'User', 171, 162, 'Hospital1 Admin', '2017-11-21 14:20:56'),
(81, 'New nurse added', 'Nurse', 6, 162, 'Hospital1 Admin', '2017-11-21 14:21:00');

-- --------------------------------------------------------

--
-- Table structure for table `hms_appoitments`
--

CREATE TABLE `hms_appoitments` (
  `id` int(11) NOT NULL,
  `appoitment_number` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appoitment_date` date NOT NULL,
  `appoitment_time_start` time DEFAULT NULL,
  `appoitment_time_end` time DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `reason` text NOT NULL,
  `remarks` text NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_availability`
--

CREATE TABLE `hms_availability` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `repeat_interval` int(11) NOT NULL DEFAULT '0' COMMENT '0-weekly,1-monthly,2-yealy,3-custom,4-Holiday',
  `isReatAllDay` int(11) NOT NULL DEFAULT '1',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `day` int(11) NOT NULL DEFAULT '0' COMMENT 'Day of Week,Month or Year',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_beds`
--

CREATE TABLE `hms_beds` (
  `id` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `bed` varchar(250) NOT NULL,
  `isAvailable` tinyint(4) NOT NULL DEFAULT '0',
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_beds`
--

INSERT INTO `hms_beds` (`id`, `ward_id`, `bed`, `isAvailable`, `isActive`, `isDeleted`, `created_at`, `modified_at`) VALUES
(1, 1, 'B1', 1, 1, 1, '2017-11-21 10:13:58', '2017-11-21 10:09:16'),
(2, 1, 'B2', 1, 1, 1, '2017-11-21 10:48:08', '2017-11-21 10:09:16'),
(3, 1, 'B3', 1, 1, 1, '2017-11-21 10:53:35', '2017-11-21 10:09:16'),
(4, 1, 'B4', 0, 1, 1, '2017-11-21 11:07:34', '2017-11-21 10:09:16'),
(5, 1, 'B4', 0, 1, 1, '2017-11-21 11:07:57', '2017-11-21 10:09:16'),
(6, 1, 'B1', 1, 1, 0, '2017-11-21 11:09:52', '2017-11-21 12:50:30'),
(7, 3, 'B2', 0, 1, 0, '2017-11-21 11:10:36', '2017-11-21 10:10:36'),
(8, 2, 'B3', 0, 1, 1, '2017-11-21 11:11:02', '2017-11-21 10:11:20'),
(9, 2, 'B3', 0, 1, 1, '2017-11-21 11:18:08', '2017-11-21 10:26:31'),
(10, 3, 'B5', 0, 1, 1, '2017-11-21 11:25:11', '2017-11-21 10:25:19'),
(11, 4, 'B5', 0, 1, 0, '2017-11-21 11:27:10', '2017-11-21 10:27:10'),
(12, 1, 'B6', 0, 1, 0, '2017-11-21 13:49:25', '2017-11-21 12:49:25'),
(13, 1, 'B7', 0, 1, 0, '2017-11-21 13:49:53', '2017-11-21 12:49:53');

-- --------------------------------------------------------

--
-- Table structure for table `hms_branches`
--

CREATE TABLE `hms_branches` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `branch_name` varchar(250) NOT NULL,
  `phone_number` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `city` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_branches`
--

INSERT INTO `hms_branches` (`id`, `hospital_id`, `branch_name`, `phone_number`, `email`, `address`, `city`, `district`, `state`, `country`, `isActive`, `isDeleted`, `created_at`, `modified_at`) VALUES
(1, 1, 'h1_Branch1', '9945781240', 'h1branch1@gmail.com', 'Ahmedabad', 1, 1, 1, 1, 1, 0, '2017-11-21 08:20:58', '2017-11-21 09:01:32'),
(2, 1, 'h1_Branch2', '9945781221', 'h1branch2@gmail.com', 'Ahmedabad', 1, 1, 1, 1, 1, 0, '2017-11-21 10:02:28', '2017-11-21 09:02:28'),
(3, 1, 'h1_Branch3', '9945781965', 'h1branch3@gmail.com', 'Ahmedabad', 1, 1, 1, 1, 1, 1, '2017-11-21 10:04:14', '2017-11-21 09:04:20');

-- --------------------------------------------------------

--
-- Table structure for table `hms_charges`
--

CREATE TABLE `hms_charges` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `charge_type` varchar(250) NOT NULL,
  `charge` float NOT NULL,
  `branch_id` int(11) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_charges`
--

INSERT INTO `hms_charges` (`id`, `title`, `description`, `charge_type`, `charge`, `branch_id`, `isDeleted`, `created_at`, `modified_at`) VALUES
(1, 'Case fees', 'Case Fees', 'Appointment Charges', 100, 1, 0, '2017-11-21 11:41:13', '2017-11-21 10:41:13'),
(2, 'Old case', 'Charges for old cases', 'Appointment Charges', 50, 1, 0, '2017-11-21 11:42:50', '2017-11-21 10:45:00'),
(3, 'General Check up', 'Charges for General Check Up', 'General CheckUp fees', 1000, 1, 1, '2017-11-21 11:44:37', '2017-11-21 10:45:57'),
(4, 'Gsn', 'fggf', 'dgnlbn', 20, 1, 1, '2017-11-21 11:45:40', '2017-11-21 10:45:48');

-- --------------------------------------------------------

--
-- Table structure for table `hms_city`
--

CREATE TABLE `hms_city` (
  `id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_city`
--

INSERT INTO `hms_city` (`id`, `district_id`, `name`) VALUES
(1, 1, 'Ahmedabad'),
(2, 1, 'Sanand'),
(3, 1, 'Viramgam'),
(4, 1, 'Mandal'),
(5, 1, 'Dhandhuka');

-- --------------------------------------------------------

--
-- Table structure for table `hms_country`
--

CREATE TABLE `hms_country` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_country`
--

INSERT INTO `hms_country` (`id`, `name`) VALUES
(1, 'India\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `hms_departments`
--

CREATE TABLE `hms_departments` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_name` varchar(250) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_departments`
--

INSERT INTO `hms_departments` (`id`, `branch_id`, `department_name`, `isActive`, `isDeleted`, `modified_at`, `created_at`) VALUES
(1, 1, 'h1_b1_Dept1', 1, 0, '2017-11-21 09:05:08', '2017-11-21 10:05:08'),
(2, 1, 'h1_b1_Dept2', 1, 0, '2017-11-21 09:06:36', '2017-11-21 10:05:36'),
(3, 2, 'h1_b2_Dept1', 1, 1, '2017-11-21 09:06:11', '2017-11-21 10:06:02');

-- --------------------------------------------------------

--
-- Table structure for table `hms_district`
--

CREATE TABLE `hms_district` (
  `id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_district`
--

INSERT INTO `hms_district` (`id`, `state_id`, `name`) VALUES
(1, 1, 'Ahmedabad'),
(2, 1, 'Kutch'),
(3, 1, 'Anand'),
(4, 1, 'Dahod'),
(5, 1, 'Kheda'),
(6, 1, 'Vadodara'),
(7, 1, 'Patan'),
(8, 1, 'Gandhinagar'),
(9, 1, 'Mehsana');

-- --------------------------------------------------------

--
-- Table structure for table `hms_doctors`
--

CREATE TABLE `hms_doctors` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `no_appt_handle` int(11) NOT NULL DEFAULT '5',
  `appt_interval` int(11) NOT NULL DEFAULT '30' COMMENT 'Appoitment_interval',
  `qualification` text NOT NULL,
  `experience` text NOT NULL,
  `specialization` text NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '0',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `availability_text` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_doctors`
--

INSERT INTO `hms_doctors` (`id`, `user_id`, `department_id`, `no_appt_handle`, `appt_interval`, `qualification`, `experience`, `specialization`, `isActive`, `isDeleted`, `created_at`, `updated_at`, `availability_text`) VALUES
(1, 163, 1, 5, 30, '', '', '', 1, 1, '0000-00-00 00:00:00', '2017-11-21 13:05:01', NULL),
(2, 165, 2, 5, 30, '', '', '', 1, 0, '2017-11-21 14:04:53', '2017-11-21 13:04:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hms_healthinsuranceprovider`
--

CREATE TABLE `hms_healthinsuranceprovider` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_healthinsuranceprovider`
--

INSERT INTO `hms_healthinsuranceprovider` (`id`, `name`, `isDeleted`) VALUES
(1, 'LIC', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hms_healthrecords`
--

CREATE TABLE `hms_healthrecords` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blood_group` varchar(250) NOT NULL,
  `height_feet` int(11) NOT NULL,
  `height_inch` int(11) NOT NULL,
  `weight` float NOT NULL,
  `high_blood_pressure` int(11) NOT NULL DEFAULT '0',
  `low_blood_pressure` int(11) NOT NULL DEFAULT '0',
  `sugar_level` varchar(250) NOT NULL,
  `health_insurance_provider` int(11) NOT NULL DEFAULT '0',
  `health_insurance_id` varchar(500) NOT NULL,
  `family_history` text NOT NULL,
  `past_medical_history` text NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_healthrecords`
--

INSERT INTO `hms_healthrecords` (`id`, `user_id`, `blood_group`, `height_feet`, `height_inch`, `weight`, `high_blood_pressure`, `low_blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `isDeleted`, `created_at`, `updated_at`) VALUES
(-1, 0, '', 0, 0, 0, 0, 0, '', 0, '', '', '', 0, '0000-00-00 00:00:00', '2017-11-21 06:12:30');

-- --------------------------------------------------------

--
-- Table structure for table `hms_hospitals`
--

CREATE TABLE `hms_hospitals` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `address` text,
  `description` text NOT NULL,
  `logo` varchar(250) DEFAULT NULL,
  `background_image` varchar(250) NOT NULL,
  `phone_numbers` text,
  `email` varchar(300) DEFAULT NULL,
  `license_category` varchar(250) DEFAULT NULL,
  `license_status` int(11) NOT NULL DEFAULT '0',
  `slug` varchar(250) NOT NULL,
  `city` varchar(250) DEFAULT NULL,
  `district` varchar(250) DEFAULT NULL,
  `state` varchar(250) DEFAULT NULL,
  `country` varchar(250) DEFAULT NULL,
  `md_name` varchar(250) NOT NULL,
  `md_contact_number` varchar(250) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '0',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_hospitals`
--

INSERT INTO `hms_hospitals` (`id`, `name`, `address`, `description`, `logo`, `background_image`, `phone_numbers`, `email`, `license_category`, `license_status`, `slug`, `city`, `district`, `state`, `country`, `md_name`, `md_contact_number`, `isActive`, `isDeleted`, `created_at`, `modified_at`) VALUES
(1, 'Hospital1', 'Ahmedabad', '', NULL, '', '9457812632', 'hospital1@gmail.com', 'LIC01', 1, '', '1', '1', '1', '1', '', '', 1, 0, '2017-11-21 07:24:52', '2017-11-21 06:24:52'),
(2, 'Hospital2', 'Ahmedabad', '', NULL, '', '9457812630', 'hospital2@gmail.com', 'LIC01', 1, '', '2', '1', '1', '1', '', '', 0, 0, '2017-11-21 08:16:30', '2017-11-21 07:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `hms_hospital_admin`
--

CREATE TABLE `hms_hospital_admin` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_hospital_admin`
--

INSERT INTO `hms_hospital_admin` (`id`, `hospital_id`, `user_id`, `isActive`, `isDeleted`, `created_at`, `modified_at`) VALUES
(1, 1, 162, 1, 0, '0000-00-00 00:00:00', '2017-11-21 07:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `hms_inpatient`
--

CREATE TABLE `hms_inpatient` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bed_id` int(11) NOT NULL DEFAULT '0',
  `doctor_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `join_date` datetime NOT NULL,
  `left_date` datetime DEFAULT NULL,
  `reason` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0- not admitted, 1- admitted, 2-discharged',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `isActive` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_inpatient_history`
--

CREATE TABLE `hms_inpatient_history` (
  `id` int(11) NOT NULL,
  `in_patient_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` text NOT NULL,
  `cost` float NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_license`
--

CREATE TABLE `hms_license` (
  `id` int(11) NOT NULL,
  `license_code` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_license`
--

INSERT INTO `hms_license` (`id`, `license_code`, `name`, `isDeleted`) VALUES
(1, 'LIC01', 'Trial', 0),
(2, 'LIC02', 'Trial', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hms_medical_lab`
--

CREATE TABLE `hms_medical_lab` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `owner_name` varchar(250) NOT NULL,
  `owner_contact_number` varchar(250) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `address` varchar(250) NOT NULL,
  `phone_number` varchar(250) NOT NULL,
  `country` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_medical_report`
--

CREATE TABLE `hms_medical_report` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `medical_lab_id` int(11) NOT NULL DEFAULT '0',
  `prescription_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_medical_report_file`
--

CREATE TABLE `hms_medical_report_file` (
  `id` int(11) NOT NULL,
  `medical_report_id` int(11) NOT NULL,
  `file_url` text NOT NULL,
  `file_type` text NOT NULL,
  `file_path` text NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_medical_store`
--

CREATE TABLE `hms_medical_store` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `owner_name` varchar(250) NOT NULL,
  `owner_contact_number` varchar(250) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `address` varchar(250) NOT NULL,
  `phone_number` varchar(250) NOT NULL,
  `country` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_messages`
--

CREATE TABLE `hms_messages` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `body` text NOT NULL,
  `created_date` datetime NOT NULL,
  `isRead` tinyint(4) NOT NULL DEFAULT '0',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_notification`
--

CREATE TABLE `hms_notification` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `isRead` tinyint(4) NOT NULL DEFAULT '0',
  `action` text,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_notification`
--

INSERT INTO `hms_notification` (`id`, `created_by`, `user_id`, `text`, `isRead`, `action`, `created_date`, `isDeleted`) VALUES
(1, 162, 1, '<b>Hospital Admin</b> is successfully registered as <b>Hospital Admin</b> in Hospital: <b>Hospital1</b>', 0, NULL, '2017-11-20 23:10:24', 0),
(2, 1, 162, 'Your Profile is updated', 1, NULL, '2017-11-20 23:12:50', 0),
(3, 1, 162, 'Your Profile is updated', 1, NULL, '2017-11-20 23:54:25', 0),
(4, 1, 162, 'Branch <b>h1_Branch1</b> information is updated', 1, NULL, '2017-11-21 01:01:32', 0),
(5, 1, 162, 'New branch <b>h1_Branch2</b> is added', 1, NULL, '2017-11-21 01:02:28', 0),
(6, 1, 162, 'New branch <b>h1_Branch3</b> is added', 1, NULL, '2017-11-21 01:04:14', 0),
(7, 1, 162, 'New department <b>h1_b1_Dept1</b> is added in <b>h1_Branch1</b> branch', 1, NULL, '2017-11-21 01:05:08', 0),
(8, 1, 162, 'New department <b>h1_b1_Dept2</b> is added in <b>h1_Branch1</b> branch', 1, NULL, '2017-11-21 01:05:36', 0),
(9, 1, 162, 'New department <b>h1_b2_Dept1</b> is added in <b>h1_Branch2</b> branch', 1, NULL, '2017-11-21 01:06:02', 0),
(10, 1, 162, 'Department <b>h1_b1_Dept2</b> information is updated in <b>h1_Branch2</b> branch', 1, NULL, '2017-11-21 01:06:23', 0),
(11, 1, 162, 'Department <b>h1_b1_Dept2</b> information is updated in <b>h1_Branch1</b> branch', 1, NULL, '2017-11-21 01:06:36', 0),
(12, 1, 162, 'New ward <b>h1_b1_d1_Ward1</b> is added in <b>h1_b1_Dept1</b> department of <b>h1_Branch1</b> branch', 1, NULL, '2017-11-21 01:07:56', 0),
(13, 1, 162, 'New ward <b>h1_b1_d1_Ward2</b> is added in <b>h1_b1_Dept1</b> department of <b>h1_Branch1</b> branch', 1, NULL, '2017-11-21 01:08:18', 0),
(14, 1, 162, 'New ward <b>h1_b1_d2_Ward1</b> is added in <b>h1_b1_Dept2</b> department of <b>h1_Branch1</b> branch', 1, NULL, '2017-11-21 01:09:04', 0),
(15, 1, 162, 'new bed <b>B1</b> is added in <b>h1_b1_d1_Ward1 </b> ward <br> Department: <b>h1_b1_Dept1</b> <br> Branch: <b>h1_Branch1</b>', 1, NULL, '2017-11-21 01:13:58', 0),
(16, 1, 162, 'Bed <b>B1</b> information is updated in <b>h1_b1_d1_Ward1</b> ward <br> Department: <b>h1_b1_Dept1</b> <br> Branch: <b>h1_Branch1</b>', 1, NULL, '2017-11-21 01:14:27', 0),
(17, 1, 162, 'Bed <b>B1</b> information is updated in <b>h1_b1_d1_Ward1</b> ward <br> Department: <b>h1_b1_Dept1</b> <br> Branch: <b>h1_Branch1</b>', 1, NULL, '2017-11-21 01:51:50', 0),
(18, 1, 162, 'new bed <b>B4</b> is added in <b>h1_b1_d1_Ward1 </b> ward <br> Department: <b>h1_b1_Dept1</b> <br> Branch: <b>h1_Branch1</b>', 1, NULL, '2017-11-21 02:07:57', 0),
(19, 1, 162, 'new bed <b>B1</b> is added in <b>h1_b1_d1_Ward1 </b> ward <br> Department: <b>h1_b1_Dept1</b> <br> Branch: <b>h1_Branch1</b>', 1, NULL, '2017-11-21 02:09:52', 0),
(20, 1, 162, 'new bed <b>B2</b> is added in <b>h1_b1_d2_Ward1 </b> ward <br> Department: <b>h1_b1_Dept2</b> <br> Branch: <b>h1_Branch1</b>', 1, NULL, '2017-11-21 02:10:36', 0),
(21, 1, 162, 'new bed <b>B3</b> is added in <b>h1_b1_d1_Ward2 </b> ward <br> Department: <b>h1_b1_Dept1</b> <br> Branch: <b>h1_Branch1</b>', 1, NULL, '2017-11-21 02:11:02', 0),
(22, 1, 162, 'new bed <b>b3</b> is added in <b>h1_b1_d1_Ward2 </b> ward <br> Department: <b>h1_b1_Dept1</b> <br> Branch: <b>h1_Branch1</b>', 1, NULL, '2017-11-21 02:18:08', 0),
(23, 1, 162, 'Bed <b>B3</b> information is updated in <b>h1_b1_d1_Ward2</b> ward <br> Department: <b>h1_b1_Dept1</b> <br> Branch: <b>h1_Branch1</b>', 1, NULL, '2017-11-21 02:23:08', 0),
(24, 1, 162, 'new bed <b>B5</b> is added in <b>h1_b1_d2_Ward1 </b> ward <br> Department: <b>h1_b1_Dept2</b> <br> Branch: <b>h1_Branch1</b>', 1, NULL, '2017-11-21 02:25:11', 0),
(25, 1, 162, 'New ward <b>h1_b1_d2_Ward3</b> is added in <b>h1_b1_Dept2</b> department of <b>h1_Branch1</b> branch', 1, NULL, '2017-11-21 02:26:09', 0),
(26, 1, 162, 'new bed <b>B5</b> is added in <b>h1_b1_d2_Ward3 </b> ward <br> Department: <b>h1_b1_Dept2</b> <br> Branch: <b>h1_Branch1</b>', 1, NULL, '2017-11-21 02:27:10', 0),
(27, 163, 162, '<b>Dr. Ravi</b> is successfully registered as <b>Doctor</b> in Department: <b>h1_b1_Dept1</b>', 1, NULL, '2017-11-21 02:50:17', 0),
(28, 162, 163, 'Your Profile is updated', 0, NULL, '2017-11-21 03:55:30', 0),
(29, 162, 165, 'You are linked with <b>Hospital1</b> hospital as Doctor', 0, NULL, '2017-11-21 05:04:53', 0),
(30, 166, 162, '<b>Nurse </b> is successfully registered as <b>Nurse</b> in Department: <b>h1_b1_Dept1</b>', 0, NULL, '2017-11-21 05:08:53', 0),
(31, 162, 166, 'Your Profile is updated', 0, NULL, '2017-11-21 05:09:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hms_nurse`
--

CREATE TABLE `hms_nurse` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `qualification` text NOT NULL,
  `experience` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_nurse`
--

INSERT INTO `hms_nurse` (`id`, `user_id`, `department_id`, `isActive`, `isDeleted`, `created_at`, `modified_at`, `qualification`, `experience`) VALUES
(1, 171, 1, 1, 0, '0000-00-00 00:00:00', '2017-11-21 13:22:14', '', ''),
(2, 167, -1, 1, 0, '2017-11-21 14:11:07', '2017-11-21 13:11:07', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `hms_prescription`
--

CREATE TABLE `hms_prescription` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appoitment_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `store_id` int(11) DEFAULT '0',
  `order_status` int(11) NOT NULL DEFAULT '0',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_prescription_item`
--

CREATE TABLE `hms_prescription_item` (
  `id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `drug` text NOT NULL,
  `strength` text NOT NULL,
  `dosage` text NOT NULL,
  `duration` text NOT NULL,
  `qty` varchar(250) NOT NULL,
  `order_qty` varchar(250) NOT NULL,
  `note` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_prescription_order_receipt`
--

CREATE TABLE `hms_prescription_order_receipt` (
  `id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `file_url` text NOT NULL,
  `file_type` text NOT NULL,
  `file_path` text NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_receptionist`
--

CREATE TABLE `hms_receptionist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `qualification` text NOT NULL,
  `experience` text NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_recommend_appointments`
--

CREATE TABLE `hms_recommend_appointments` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `recommend_appointment_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_state`
--

CREATE TABLE `hms_state` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_state`
--

INSERT INTO `hms_state` (`id`, `country_id`, `name`) VALUES
(1, 1, 'Gujarat\r\n'),
(3, 1, 'Bihar'),
(5, 1, 'Haryana'),
(6, 1, 'Haryana'),
(7, 1, 'Jharkhand'),
(9, 1, 'Assam'),
(10, 1, 'Odisha'),
(11, 1, 'Maharastra'),
(12, 1, 'Andhra Pradesh'),
(13, 1, 'West Bengal'),
(15, 1, 'Tamil Nadu'),
(16, 1, 'Bihar'),
(17, 1, 'Punjab'),
(19, 1, 'Bihar'),
(21, 1, 'Maharastra'),
(22, 1, 'Odisha');

-- --------------------------------------------------------

--
-- Table structure for table `hms_test`
--

CREATE TABLE `hms_test` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_users`
--

CREATE TABLE `hms_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `useremail` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `my_key` varchar(250) NOT NULL,
  `address` text,
  `mobile` varchar(250) DEFAULT NULL,
  `aadhaar_number` varchar(250) DEFAULT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `profile_photo` varchar(250) DEFAULT NULL,
  `hospital` int(11) NOT NULL DEFAULT '0',
  `gender` varchar(5) NOT NULL,
  `date_of_birth` date NOT NULL,
  `city` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `alternate_mobile_number` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0' COMMENT '1-Admin, 2-Hospital Admin, 3- Doctor, 4-Nurse, 5- Receptienst,6-Patient',
  `isActive` tinyint(4) NOT NULL DEFAULT '0',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `forgotPassCode` varchar(20) DEFAULT NULL,
  `isRegister` tinyint(4) NOT NULL DEFAULT '1',
  `hasSelectedRole` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_users`
--

INSERT INTO `hms_users` (`id`, `first_name`, `last_name`, `useremail`, `password`, `my_key`, `address`, `mobile`, `aadhaar_number`, `phone`, `profile_photo`, `hospital`, `gender`, `date_of_birth`, `city`, `district`, `state`, `country`, `alternate_mobile_number`, `description`, `role`, `isActive`, `isDeleted`, `created_at`, `updated_at`, `forgotPassCode`, `isRegister`, `hasSelectedRole`) VALUES
(1, 'Super', 'Admin', 'superadmin@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'YzE4MGY3MTUyMGM5ZGMwNDliZWUxYTc3NGU2MzdlZDdkMzdlOGI5Mzg0YmNmYmJjMzJjMjQ5NmYzZjA2NDEzMw==', 'Ahmedabad1', '9090123409', '5421321054671', '', 'http://localhost/mypulse/public/images/ux/1.png', 0, 'M', '1905-05-05', 1, 1, 1, 1, '', 'About my profile..', 1, 1, 0, '0000-00-00 00:00:00', '2017-05-03 18:46:34', '0', 1, 0),
(171, 'Nurse', 'Patel', 'nursepate@gmail.com', '45f27778998ee78b88d293968dff0b6e', 'MWViN2QxNGQwNDMyMTJmYzJmYjRlNTY5ZjMxMmJjMjgxNTQ0NWI5NWY0MmM2YzVkMDljYjZkODZmNjBhMzJiYQ==', '', '9654781212', '65856265568', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', 'Nu', 4, 0, 0, '2017-11-21 14:20:56', '2017-11-21 13:20:56', '7B1384A021', 1, 0),
(165, 'Dr. Yogesh ', 'Patel', 'yogesh@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'NTUwNWFiNzcyMWMwMzMyODlmOWI4MDZhNzM0MTM3MjM1OWExMzQ4YTQyYWJhNGFkMGU2OGJmMDg4NjI4YWMwMg==', 'Ahmedabad', '9956935650', '898124784841', NULL, NULL, 0, 'M', '1992-03-20', 1, 1, 1, 1, '', 'Doctor', 3, 1, 0, '2017-11-21 14:04:48', '2017-11-21 13:04:48', '466815617F', 1, 0),
(162, 'Hospital1', 'Admin', 'hospitaladmin@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'MzQ4MWZiMDY2Zjk5YTBmMzU1NjlmYWRkYTJmYThiZWQ5OTQ3YWVmMTM3NTNmMjJkYWFlZTI3MmIyY2ZiNTE0NA==', '', '9956935656', '95785246123056', NULL, NULL, 0, '', '1969-12-31', 0, 0, 0, 0, '', '', 2, 1, 0, '2017-11-21 08:01:34', '2017-11-21 07:01:34', '040F407BA2', 1, 0),
(163, 'Dr.', 'Ravi', 'doctor@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'YTI2M2U5ZDAwYWE4ZTQ3ZmE0YmM5N2Q5NzNjZWM2OGYwY2ZkZTE4MGRhNGM1MmQxMjQxYjJlZmQ5MWRlMmJkNw==', '', '9654781290', '95785246123055', NULL, NULL, 0, '', '1970-01-01', 0, 0, 0, 0, '', 'Doctor', 3, 1, 0, '2017-11-21 11:49:07', '2017-11-21 10:49:07', 'CFF6F2DDDD', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hms_wards`
--

CREATE TABLE `hms_wards` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `ward_name` varchar(250) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_wards`
--

INSERT INTO `hms_wards` (`id`, `department_id`, `ward_name`, `isActive`, `isDeleted`, `modified_at`, `created_at`) VALUES
(1, 1, 'h1_b1_d1_Ward1', 1, 0, '2017-11-21 09:07:56', '0000-00-00 00:00:00'),
(2, 1, 'h1_b1_d1_Ward2', 1, 0, '2017-11-21 09:08:18', '0000-00-00 00:00:00'),
(3, 2, 'h1_b1_d2_Ward1', 1, 1, '2017-11-21 09:10:43', '0000-00-00 00:00:00'),
(4, 2, 'h1_b1_d2_Ward3', 1, 0, '2017-11-21 10:26:09', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hms_activitylog`
--
ALTER TABLE `hms_activitylog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_appoitments`
--
ALTER TABLE `hms_appoitments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_availability`
--
ALTER TABLE `hms_availability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_beds`
--
ALTER TABLE `hms_beds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_branches`
--
ALTER TABLE `hms_branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_charges`
--
ALTER TABLE `hms_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_city`
--
ALTER TABLE `hms_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_country`
--
ALTER TABLE `hms_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_departments`
--
ALTER TABLE `hms_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_district`
--
ALTER TABLE `hms_district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_doctors`
--
ALTER TABLE `hms_doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_healthinsuranceprovider`
--
ALTER TABLE `hms_healthinsuranceprovider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_healthrecords`
--
ALTER TABLE `hms_healthrecords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_hospitals`
--
ALTER TABLE `hms_hospitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_hospital_admin`
--
ALTER TABLE `hms_hospital_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_inpatient`
--
ALTER TABLE `hms_inpatient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_inpatient_history`
--
ALTER TABLE `hms_inpatient_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_license`
--
ALTER TABLE `hms_license`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_medical_lab`
--
ALTER TABLE `hms_medical_lab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_medical_report`
--
ALTER TABLE `hms_medical_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_medical_report_file`
--
ALTER TABLE `hms_medical_report_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_medical_store`
--
ALTER TABLE `hms_medical_store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_messages`
--
ALTER TABLE `hms_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_notification`
--
ALTER TABLE `hms_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_nurse`
--
ALTER TABLE `hms_nurse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_prescription`
--
ALTER TABLE `hms_prescription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_prescription_item`
--
ALTER TABLE `hms_prescription_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_prescription_order_receipt`
--
ALTER TABLE `hms_prescription_order_receipt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_receptionist`
--
ALTER TABLE `hms_receptionist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_recommend_appointments`
--
ALTER TABLE `hms_recommend_appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_state`
--
ALTER TABLE `hms_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_test`
--
ALTER TABLE `hms_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_users`
--
ALTER TABLE `hms_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usernemail` (`useremail`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `aadhaar_number` (`aadhaar_number`);

--
-- Indexes for table `hms_wards`
--
ALTER TABLE `hms_wards`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hms_activitylog`
--
ALTER TABLE `hms_activitylog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `hms_appoitments`
--
ALTER TABLE `hms_appoitments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hms_availability`
--
ALTER TABLE `hms_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hms_beds`
--
ALTER TABLE `hms_beds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `hms_branches`
--
ALTER TABLE `hms_branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `hms_charges`
--
ALTER TABLE `hms_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `hms_city`
--
ALTER TABLE `hms_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `hms_country`
--
ALTER TABLE `hms_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hms_departments`
--
ALTER TABLE `hms_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `hms_district`
--
ALTER TABLE `hms_district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `hms_doctors`
--
ALTER TABLE `hms_doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hms_healthinsuranceprovider`
--
ALTER TABLE `hms_healthinsuranceprovider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hms_healthrecords`
--
ALTER TABLE `hms_healthrecords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `hms_hospitals`
--
ALTER TABLE `hms_hospitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hms_hospital_admin`
--
ALTER TABLE `hms_hospital_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hms_inpatient`
--
ALTER TABLE `hms_inpatient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hms_inpatient_history`
--
ALTER TABLE `hms_inpatient_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hms_license`
--
ALTER TABLE `hms_license`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hms_medical_lab`
--
ALTER TABLE `hms_medical_lab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hms_medical_report`
--
ALTER TABLE `hms_medical_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hms_medical_report_file`
--
ALTER TABLE `hms_medical_report_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hms_medical_store`
--
ALTER TABLE `hms_medical_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hms_messages`
--
ALTER TABLE `hms_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hms_notification`
--
ALTER TABLE `hms_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `hms_nurse`
--
ALTER TABLE `hms_nurse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `hms_prescription`
--
ALTER TABLE `hms_prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hms_prescription_item`
--
ALTER TABLE `hms_prescription_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hms_prescription_order_receipt`
--
ALTER TABLE `hms_prescription_order_receipt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hms_receptionist`
--
ALTER TABLE `hms_receptionist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hms_recommend_appointments`
--
ALTER TABLE `hms_recommend_appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hms_state`
--
ALTER TABLE `hms_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `hms_test`
--
ALTER TABLE `hms_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hms_users`
--
ALTER TABLE `hms_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;
--
-- AUTO_INCREMENT for table `hms_wards`
--
ALTER TABLE `hms_wards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
