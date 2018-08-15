-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 14, 2018 at 03:49 AM
-- Server version: 5.6.40
-- PHP Version: 7.0.30

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
  `user_id` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_activitylog`
--

INSERT INTO `hms_activitylog` (`id`, `description`, `item_type`, `item_id`, `user_id`, `user_name`, `created_at`) VALUES
(1, 'New hospital created', 'Hospital', 112, 1, 'Super Admin Ad...', '2017-10-22 10:44:55'),
(2, 'New hospital created', 'Hospital', 0, 1, 'Super Admin Ad...', '2017-10-22 10:51:19'),
(3, 'Appointment APT10 is updated', 'Appointment', 10, 1, 'Super Admin', '2017-10-23 11:28:42'),
(4, 'Appointment APT10 is rejected', 'Appointment', 10, 1, 'Super Admin', '2017-10-23 11:44:03'),
(5, 'Appointment APT10 remark updated', 'Appointment', 10, 12, 'Dr. Ravi Patel', '2017-10-23 11:45:58'),
(6, 'New bed:B62 added', 'Bed', 101, 1, 'Super Admin', '2017-10-23 12:03:15'),
(7, 'Bed:B62 updated', 'Bed', 101, 1, 'Super Admin', '2017-10-23 12:03:47'),
(8, 'Bed deleted', 'Bed', 101, 1, 'Super Admin', '2017-10-23 12:04:03'),
(9, 'New branch Twinkal added', 'Branch', 101, 1, 'Super Admin', '2017-10-23 12:14:06'),
(10, 'New branch: Twinkal added', 'Branch', 102, 1, 'Super Admin', '2017-10-23 12:16:27'),
(11, 'Branch: Twinkal updated', 'Branch', 102, 1, 'Super Admin', '2017-10-23 12:16:52'),
(12, 'Branch deleted', 'Branch', 102, 1, 'Super Admin', '2017-10-23 12:17:07'),
(13, 'Charge updated', 'Charge', 1, 1, 'Super Admin', '2017-10-23 13:28:40'),
(14, 'New charge created', 'Charge', 106, 1, 'Super Admin', '2017-10-23 13:30:47'),
(15, 'Charge soft deleted', 'Charge', 1, 1, 'Super Admin', '2017-10-23 13:32:18'),
(16, 'Charge soft deleted', 'Charge', 16, 1, 'Super Admin', '2017-10-23 13:39:44'),
(17, 'New department: twinkal created', 'Department', 105, 1, 'Super Admin', '2017-10-23 13:51:19'),
(18, 'Department: twinkallll updated', 'Department', 105, 1, 'Super Admin', '2017-10-23 13:51:36'),
(19, 'Department deleted', 'Department', 105, 1, 'Super Admin', '2017-10-23 13:52:03'),
(20, 'New doctor added', 'Doctor', 120, 1, 'Super Admin', '2017-10-24 14:27:38'),
(21, 'Doctor details updated', 'Doctor', 120, 1, 'Super Admin', '2017-10-24 14:29:53'),
(22, 'Doctor availability inserted', 'Availability', 54, 1, 'Super Admin', '2017-10-24 15:07:49'),
(23, 'Doctor availability inserted', 'Availability', 55, 1, 'Super Admin', '2017-10-24 15:07:49'),
(24, 'Doctor availability inserted', 'Availability', 56, 1, 'Super Admin', '2017-10-24 15:07:49'),
(25, 'Doctor availability inserted', 'Availability', 57, 1, 'Super Admin', '2017-10-24 15:07:49'),
(26, 'Doctor availability inserted', 'Availability', 58, 1, 'Super Admin', '2017-10-24 15:07:49'),
(27, 'Doctor availability inserted', 'Availability', 59, 1, 'Super Admin', '2017-10-24 15:07:49'),
(28, 'Doctor availability inserted', 'Availability', 60, 1, 'Super Admin', '2017-10-24 15:13:57'),
(29, 'Doctor availability inserted', 'Availability', 61, 1, 'Super Admin', '2017-10-24 15:14:49'),
(30, 'Doctor availability soft deleted', 'Availability', 57, 1, 'Super Admin', '2017-10-24 15:16:50'),
(31, 'Doctor Other settings updated regarding availability', 'Doctor', 120, 1, 'Super Admin', '2017-10-24 15:18:07'),
(32, 'prescription added', 'Prescription', 3, 12, 'Dr. Ravi Patel', '2017-10-24 15:20:35'),
(33, 'Hospital admin details updated', 'HospitalAdmin', 1, 1, 'Super Admin', '2017-10-25 13:11:41'),
(34, 'Patient Inpatient history updated', 'Inpatient', 1, 12, 'Dr. Ravi Patel', '2017-10-25 13:29:03'),
(35, 'New patient added in Inpatient', 'Inpatient', 2, 12, 'Dr. Ravi Patel', '2017-10-25 13:30:51'),
(36, 'Patient Inpatient history updated', 'Inpatient', 2, 12, 'Dr. Ravi Patel', '2017-10-25 13:36:08'),
(37, 'Patient Inpatient history updated', 'Inpatient', 2, 12, 'Dr. Ravi Patel', '2017-10-25 13:37:12'),
(38, 'New patient added in Inpatient', 'Inpatient', 3, 12, 'Dr. Ravi Patel', '2017-10-25 13:39:52'),
(39, 'License updated', 'License', 2, 1, 'Super Admin', '2017-10-25 14:16:10'),
(40, 'Patient Inpatient history updated', 'Inpatient', 3, 12, 'Dr. Ravi Patel', '2017-10-31 10:47:56'),
(41, 'Patient Inpatient history updated', 'Inpatient', 3, 12, 'Dr. Ravi Patel', '2017-10-31 10:48:49'),
(42, 'Patient Inpatient history updated', 'Inpatient', 3, 12, 'Dr. Ravi Patel', '2017-10-31 10:51:59'),
(43, 'Prescription order receipt added', 'MedicalStore', 1, 14, 'Ravi Prashad', '2017-10-31 11:35:14'),
(44, 'prescription added', 'Prescription', 4, 12, 'Dr. Ravi Patel', '2017-10-31 14:11:12'),
(45, 'Appointment status changed', 'Appointment', 4, 12, 'Dr. Ravi Patel', '2017-10-31 14:11:12'),
(46, 'Medical report added', 'Medicalreport', 1, 12, 'Dr. Ravi Patel', '2017-10-31 14:11:13'),
(47, 'prescription updated', 'Prescription', 4, 12, 'Dr. Ravi Patel', '2017-10-31 14:11:51'),
(48, 'Medical report added', 'Medicalreport', 2, 12, 'Dr. Ravi Patel', '2017-10-31 14:11:51'),
(49, 'prescription updated', 'Prescription', 3, 12, 'Dr. Ravi Patel', '2017-10-31 14:15:15'),
(50, 'Medical report added', 'Medicalreport', 3, 12, 'Dr. Ravi Patel', '2017-10-31 14:15:15'),
(51, 'New appointment APT11 created', 'Appointment', 11, 34, 'Jayes Raval', '2017-10-31 14:54:01'),
(52, 'prescription added', 'Prescription', 5, 12, 'Dr. Ravi Patel', '2017-10-31 14:55:11'),
(53, 'Appointment status changed', 'Appointment', 11, 12, 'Dr. Ravi Patel', '2017-10-31 14:55:11'),
(54, 'Medical report added', 'Medicalreport', 4, 12, 'Dr. Ravi Patel', '2017-10-31 14:55:11'),
(55, 'New medical report file added', 'Medicalreport', 1, 15, 'Medical Lab', '2017-10-31 14:58:46'),
(56, 'New medical report file added', 'Medicalreport', 2, 15, 'Medical Lab', '2017-10-31 15:01:17'),
(57, 'Recommned next appointment date added in appointment', 'RecommnedDate', 2, 12, 'Dr. Ravi Patel', '2017-11-01 09:33:20'),
(58, 'Recommned next appointment date added in appointment', 'RecommnedDate', 3, 12, 'Dr. Ravi Patel', '2017-11-01 09:43:57'),
(59, 'Recommned next appointment date added in appointment', 'RecommnedDate', 4, 12, 'Dr. Ravi Patel', '2017-11-01 09:54:34'),
(60, 'Recommned next appointment date added in appointment', 'RecommnedDate', 5, 12, 'Dr. Ravi Patel', '2017-11-01 10:02:51'),
(61, 'Recommned next appointment date added in appointment', 'RecommnedDate', 6, 12, 'Dr. Ravi Patel', '2017-11-01 10:05:19'),
(62, 'Recommned next appointment date added in appointment', 'RecommnedDate', 7, 12, 'Dr. Ravi Patel', '2017-11-01 10:08:03'),
(63, 'New user created', 'User', 156, 1, 'Super Admin', '2018-06-05 16:10:57'),
(64, 'New doctor added', 'Doctor', 121, 1, 'Super Admin', '2018-06-05 16:10:58'),
(65, 'User details updated', 'User', 156, 1, 'Super Admin', '2018-06-05 16:11:27'),
(66, 'Doctor details updated', 'Doctor', 121, 1, 'Super Admin', '2018-06-05 16:11:27'),
(67, 'New department created', 'Department', 106, 3, 'Hospital Admin LMS', '2018-06-07 18:34:55'),
(68, 'New user created', 'User', 157, 0, '', '2018-06-08 02:58:31'),
(69, 'New user created', 'User', 158, 0, '', '2018-06-12 03:02:38'),
(70, 'New user created', 'User', 159, 0, '', '2018-06-12 03:04:56'),
(71, 'New user created', 'User', 160, 0, '', '2018-06-12 03:06:40'),
(72, 'New user created', 'User', 161, 0, '', '2018-06-12 03:36:37'),
(73, 'User profile verfied', 'User', 161, 0, '', '2018-06-12 03:37:25'),
(74, 'New user created', 'User', 162, 0, '', '2018-06-12 03:56:39'),
(75, 'User profile verfied', 'User', 162, 0, '', '2018-06-12 03:57:33'),
(76, 'New user created', 'User', 163, 0, '', '2018-06-12 15:18:50'),
(77, 'User profile verfied', 'User', 163, 0, '', '2018-06-12 15:19:18'),
(78, 'New user created', 'User', 164, 3, 'Hospital Admin LMS', '2018-06-12 15:26:23'),
(79, 'New doctor added', 'Doctor', 122, 3, 'Hospital Admin LMS', '2018-06-12 15:26:24'),
(80, 'Doctor Other settings updated regarding availability', 'Doctor', 2, 12, 'Dr. Ravi Patel', '2018-06-13 03:11:59'),
(81, 'Doctor availability inserted', 'Availability', 63, 12, 'Dr. Ravi Patel', '2018-06-13 03:25:54'),
(82, 'Doctor availability inserted', 'Availability', 64, 12, 'Dr. Ravi Patel', '2018-06-13 03:25:54'),
(83, 'prescription added', 'Prescription', 6, 12, 'Dr. Ravi Patel', '2018-06-18 08:25:39'),
(84, 'Appointment status changed', 'Appointment', 5, 12, 'Dr. Ravi Patel', '2018-06-18 08:25:39'),
(85, 'Prescription items added', 'Prescription_items', 3, 12, 'Dr. Ravi Patel', '2018-06-18 08:25:39'),
(86, 'Medical report added', 'Medicalreport', 5, 12, 'Dr. Ravi Patel', '2018-06-18 08:25:39'),
(87, 'prescription updated', 'Prescription', 1, 12, 'Dr. Ravi Patel', '2018-06-20 05:24:05'),
(88, 'Prescription items updated', 'Prescription_items', 1, 12, 'Dr. Ravi Patel', '2018-06-20 05:24:05'),
(89, 'Medical report updated', 'Medicalreport', 1, 12, 'Dr. Ravi Patel', '2018-06-20 05:24:05'),
(90, 'New user created', 'User', 165, 0, '', '2018-06-20 05:34:58'),
(91, 'User profile verfied', 'User', 165, 0, '', '2018-06-20 05:36:41'),
(92, 'New user created', 'User', 166, 0, '', '2018-06-23 04:29:54'),
(93, 'User profile verfied', 'User', 166, 166, 'ravi ', '2018-06-23 04:33:59'),
(94, 'New user created', 'User', 167, 0, '', '2018-06-23 05:17:17'),
(95, 'New user created', 'User', 168, 0, '', '2018-06-23 05:39:24'),
(96, 'Password reset', 'User', 166, 0, '', '2018-06-23 06:27:34'),
(97, 'New user created', 'User', 169, 0, '', '2018-06-23 06:39:08'),
(98, 'Password reset', 'User', 168, 0, '', '2018-06-23 06:53:14'),
(99, 'User details updated', 'User', 1, 1, 'Super Admin', '2018-06-25 14:59:22'),
(100, 'User details updated', 'User', 1, 1, 'Super Admin', '2018-06-25 14:59:22'),
(101, 'New appointment created', 'Appointment', 12, 26, 'Patient ', '2018-06-27 02:18:51'),
(102, 'Appointment canceled', 'Appointment', 10, 26, 'Patient ', '2018-06-27 07:52:18'),
(103, 'Appointment canceled', 'Appointment', 10, 26, 'Patient ', '2018-06-27 07:52:51'),
(104, 'Appointment rejected', 'Appointment', 12, 39, 'Receptionist ', '2018-06-27 08:53:56'),
(105, 'Appointment approved', 'Appointment', 12, 39, 'Receptionist ', '2018-06-27 21:47:10'),
(106, 'User profile verfied', 'User', 168, 168, 'sajid ', '2018-06-28 14:10:42'),
(107, 'New appointment created', 'Appointment', 13, 168, 'sajid ', '2018-06-29 15:47:23'),
(108, 'Appointment approved', 'Appointment', 13, 39, 'Receptionist ', '2018-06-29 21:20:49'),
(109, 'Appointment approved', 'Appointment', 6, 39, 'Receptionist ', '2018-06-29 23:12:48'),
(110, 'Appointment rejected', 'Appointment', 13, 39, 'Receptionist ', '2018-06-30 00:18:55'),
(111, 'New appointment created', 'Appointment', 14, 26, 'Patient ', '2018-06-29 19:51:24'),
(112, 'Appointment approved', 'Appointment', 13, 39, 'Receptionist ', '2018-06-30 08:00:49'),
(113, 'New user created', 'User', 170, 0, '', '2018-07-01 10:07:28'),
(114, 'New user created', 'User', 171, 3, 'Hospital Admin LMS', '2018-07-01 14:43:44'),
(115, 'New doctor added', 'Doctor', 123, 3, 'Hospital Admin LMS', '2018-07-01 14:43:48'),
(116, 'User details updated', 'User', 171, 3, 'Hospital Admin LMS', '2018-07-01 14:46:21'),
(117, 'Doctor details updated', 'Doctor', 123, 3, 'Hospital Admin LMS', '2018-07-01 14:46:21'),
(118, 'User profile verified', 'User', 171, 1, 'Super Admin', '2018-07-01 14:51:53'),
(119, 'Password reset', 'User', 171, 1, 'Super Admin', '2018-07-01 14:52:19'),
(120, 'New user registered', 'User', 172, 39, 'Receptionist ', '2018-07-01 15:20:57'),
(121, 'New appointment created', 'Appointment', 15, 39, 'Receptionist ', '2018-07-01 15:25:35'),
(122, 'New appointment created', 'Appointment', 16, 26, 'Patient ', '2018-07-01 18:10:44'),
(123, 'Appointment approved', 'Appointment', 16, 39, 'Receptionist ', '2018-07-02 07:17:47'),
(124, 'New user created', 'User', 173, 0, '', '2018-07-02 01:55:29'),
(125, 'New user registered', 'User', 174, 1, 'Super Admin', '2018-07-02 10:26:03'),
(126, 'New appointment created', 'Appointment', 17, 1, 'Super Admin', '2018-07-02 10:28:31'),
(127, 'Appointment rejected', 'Appointment', 17, 39, 'Receptionist ', '2018-07-02 16:02:25'),
(128, 'Password reset', 'User', 174, 0, '', '2018-07-03 02:20:57'),
(129, 'Password reset', 'User', 174, 0, '', '2018-07-03 02:23:10'),
(130, 'Password reset', 'User', 174, 0, '', '2018-07-04 02:11:47'),
(131, 'Password reset', 'User', 174, 0, '', '2018-07-04 02:46:49'),
(132, 'New user created', 'User', 175, 0, '', '2018-07-04 03:54:43'),
(133, 'New appointment created', 'Appointment', 18, 26, 'Patient ', '2018-07-04 15:30:24'),
(134, 'Appointment approved', 'Appointment', 18, 39, 'Receptionist ', '2018-07-04 21:01:09'),
(135, 'New user created', 'User', 176, 0, '', '2018-07-05 15:18:58'),
(136, 'New appointment created', 'Appointment', 19, 26, 'Patient ', '2018-07-05 16:15:43'),
(137, 'Appointment canceled', 'Appointment', 6, 26, 'Patient ', '2018-07-05 21:46:08'),
(138, 'Appointment canceled', 'Appointment', 6, 26, 'Patient ', '2018-07-05 21:46:20'),
(139, 'Appointment canceled', 'Appointment', 8, 26, 'Patient ', '2018-07-05 21:46:20'),
(140, 'Appointment canceled', 'Appointment', 6, 26, 'Patient ', '2018-07-05 21:47:08'),
(141, 'Appointment canceled', 'Appointment', 8, 26, 'Patient ', '2018-07-05 21:47:08'),
(142, 'Appointment canceled', 'Appointment', 6, 26, 'Patient ', '2018-07-05 21:47:23'),
(143, 'Appointment canceled', 'Appointment', 8, 26, 'Patient ', '2018-07-05 21:47:40'),
(144, 'Appointment canceled', 'Appointment', 8, 26, 'Patient ', '2018-07-05 21:48:02'),
(145, 'New ward added', 'Ward', 103, 1, 'Super Admin', '2018-07-05 17:17:17'),
(146, 'Password reset', 'User', 174, 0, '', '2018-07-06 01:48:22'),
(147, 'New user created', 'User', 177, 0, '', '2018-07-06 16:28:52'),
(148, 'User profile verfied', 'User', 177, 177, 'sajid ', '2018-07-06 16:33:23'),
(149, 'Password reset', 'User', 177, 0, '', '2018-07-06 16:39:42'),
(150, 'User details updated', 'User', 177, 177, 'sajid ', '2018-07-06 16:45:48'),
(151, 'User details updated', 'User', 177, 177, 'sajid s.p.', '2018-07-06 16:45:48'),
(152, 'Password reset', 'User', 177, 0, '', '2018-07-06 16:53:52'),
(153, 'New appointment created', 'Appointment', 20, 26, 'Patient ', '2018-07-07 06:32:45'),
(154, 'Appointment updated', 'Appointment', 20, 26, 'Patient ', '2018-07-07 06:34:53'),
(155, 'Appointment updated', 'Appointment', 20, 39, 'Receptionist ', '2018-07-07 06:45:36'),
(156, 'Appointment rejected', 'Appointment', 20, 39, 'Receptionist ', '2018-07-07 12:16:41'),
(157, 'New appointment created', 'Appointment', 21, 26, 'Patient ', '2018-07-07 06:48:23'),
(158, 'Appointment approved', 'Appointment', 21, 12, 'Dr. Ravi Patel', '2018-07-07 13:52:22'),
(159, 'Appointment updated', 'Appointment', 21, 26, 'Patient ', '2018-07-07 08:23:05'),
(160, 'Recommned next appointment date added in appointment', 'RecommnedDate', 8, 12, 'Dr. Ravi Patel', '2018-07-07 08:45:22'),
(161, 'Doctor availability inserted', 'Availability', 65, 39, 'Receptionist ', '2018-07-07 11:51:15'),
(162, 'New appointment created', 'Appointment', 22, 26, 'Patient ', '2018-07-08 14:37:07'),
(163, 'Appointment canceled', 'Appointment', 22, 26, 'Patient ', '2018-07-08 20:07:49'),
(164, 'Appointment canceled', 'Appointment', 22, 26, 'Patient ', '2018-07-08 20:08:04'),
(165, 'Password reset', 'User', 177, 0, '', '2018-07-09 07:29:37'),
(166, 'Doctor availability inserted', 'Availability', 66, 12, 'Dr. Ravi Patel', '2018-07-10 09:44:18'),
(167, 'Doctor availability inserted', 'Availability', 68, 12, 'Dr. Ravi Patel', '2018-07-10 09:53:04'),
(168, 'New user created', 'User', 178, 3, 'Hospital Admin LMS', '2018-07-11 16:18:43'),
(169, 'New doctor added', 'Doctor', 124, 3, 'Hospital Admin LMS', '2018-07-11 16:18:46'),
(170, 'Doctor availability inserted', 'Availability', 69, 3, 'Hospital Admin LMS', '2018-07-11 16:22:47'),
(171, 'New appointment created', 'Appointment', 23, 177, 'sajid s.p.', '2018-07-11 16:34:01'),
(172, 'New user created', 'User', 179, 3, 'Hospital Admin LMS', '2018-07-11 16:58:16'),
(173, 'New receptionist added', 'Receptionist', 5, 3, 'Hospital Admin LMS', '2018-07-11 16:58:18'),
(174, 'User profile verified', 'User', 178, 0, '', '2018-07-11 17:06:05'),
(175, 'User profile verified', 'User', 178, 3, 'Hospital Admin LMS', '2018-07-11 17:07:29'),
(176, 'Password reset', 'User', 178, 3, 'Hospital Admin LMS', '2018-07-11 17:07:56'),
(177, 'New user created', 'User', 180, 3, 'Hospital Admin LMS', '2018-07-12 15:53:32'),
(178, 'New doctor added', 'Doctor', 125, 3, 'Hospital Admin LMS', '2018-07-12 15:53:35'),
(179, 'User profile verified', 'User', 180, 3, 'Hospital Admin LMS', '2018-07-12 15:54:05'),
(180, 'Password reset', 'User', 180, 3, 'Hospital Admin LMS', '2018-07-12 15:54:23'),
(181, 'New user created', 'User', 181, 3, 'Hospital Admin LMS', '2018-07-13 02:20:53'),
(182, 'New receptionist added', 'Receptionist', 6, 3, 'Hospital Admin LMS', '2018-07-13 02:20:56'),
(183, 'User profile verified', 'User', 181, 3, 'Hospital Admin LMS', '2018-07-13 02:22:52'),
(184, 'Password reset', 'User', 181, 3, 'Hospital Admin LMS', '2018-07-13 02:23:07'),
(185, 'User details updated', 'User', 180, 3, 'Hospital Admin LMS', '2018-07-13 03:50:17'),
(186, 'Doctor details updated', 'Doctor', 125, 3, 'Hospital Admin LMS', '2018-07-13 03:50:17'),
(187, 'Doctor availability inserted', 'Availability', 70, 180, 'doctor one', '2018-07-13 03:55:09'),
(188, 'New appointment created', 'Appointment', 24, 26, 'User ', '2018-07-13 03:58:23'),
(189, 'Appointment approved', 'Appointment', 24, 181, 'receptionist one', '2018-07-13 09:31:17'),
(190, 'New user registered', 'User', 182, 181, 'receptionist one', '2018-07-13 08:57:12'),
(191, 'New appointment created', 'Appointment', 25, 181, 'receptionist one', '2018-07-13 08:59:45'),
(192, 'New bed added', 'Bed', 102, 3, 'Hospital Admin LMS', '2018-07-13 09:03:08'),
(193, 'New ward added', 'Ward', 104, 3, 'Hospital Admin LMS', '2018-07-13 09:04:49'),
(194, 'New user created', 'User', 183, 1, 'Super Admin', '2018-07-14 04:46:02'),
(195, 'Hospital admin added', 'HospitalAdmin', 2, 1, 'Super Admin', '2018-07-14 04:46:04'),
(196, 'User details updated', 'User', 183, 1, 'Super Admin', '2018-07-14 04:48:08'),
(197, 'Hospital admin details updated', 'HospitalAdmin', 2, 1, 'Super Admin', '2018-07-14 04:48:08'),
(198, 'User profile verified', 'User', 183, 1, 'Super Admin', '2018-07-14 04:48:41'),
(199, 'User profile verified', 'User', 183, 1, 'Super Admin', '2018-07-14 04:48:42'),
(200, 'Password reset', 'User', 183, 1, 'Super Admin', '2018-07-14 04:49:13'),
(201, 'New user created', 'User', 184, 0, '', '2018-07-15 06:23:55'),
(202, 'New user created', 'User', 185, 3, 'Hospital Admin LMS', '2018-07-15 07:32:28'),
(203, 'New doctor added', 'Doctor', 126, 3, 'Hospital Admin LMS', '2018-07-15 07:32:30'),
(204, 'User profile verified', 'User', 185, 3, 'Hospital Admin LMS', '2018-07-15 07:33:12'),
(205, 'User profile verified', 'User', 185, 3, 'Hospital Admin LMS', '2018-07-15 07:39:29'),
(206, 'Password reset', 'User', 185, 3, 'Hospital Admin LMS', '2018-07-15 07:40:19'),
(207, 'New user created', 'User', 186, 3, 'Hospital Admin LMS', '2018-07-15 08:08:11'),
(208, 'New doctor added', 'Doctor', 127, 3, 'Hospital Admin LMS', '2018-07-15 08:08:13'),
(209, 'User profile verified', 'User', 186, 0, '', '2018-07-15 08:08:58'),
(210, 'Password reset', 'User', 186, 0, '', '2018-07-15 08:09:21'),
(211, 'New appointment created', 'Appointment', 26, 26, 'User ', '2018-07-17 13:09:58'),
(212, 'Password reset', 'User', 184, 0, '', '2018-07-18 16:01:36'),
(213, 'New user registered', 'User', 187, 12, 'Dr. Ravi Patel', '2018-07-21 08:03:33'),
(214, 'New user created', 'User', 1, 0, '', '2018-07-21 08:10:46'),
(215, 'New user registered', 'User', 188, 12, 'Dr. Ravi Patel', '2018-07-21 12:00:44'),
(216, 'New appointment created', 'Appointment', 27, 12, 'Dr. Ravi Patel', '2018-07-21 12:01:33'),
(217, 'New user created', 'User', 1, 0, '', '2018-07-22 07:32:36'),
(218, 'New user created', 'User', 189, 3, 'Hospital Admin LMS', '2018-07-22 08:26:44'),
(219, 'New nurse added', 'Nurse', 67, 3, 'Hospital Admin LMS', '2018-07-22 08:26:47'),
(220, 'New nurse added', 'Nurse', 68, 3, 'Hospital Admin LMS', '2018-07-22 08:26:47'),
(221, 'New nurse added', 'Nurse', 69, 3, 'Hospital Admin LMS', '2018-07-22 08:26:47'),
(222, 'Nurse Doctor Updated', 'Nurse', 70, 3, 'Hospital Admin LMS', '2018-07-22 08:29:02'),
(223, 'Nurse Doctor Updated', 'Nurse', 71, 3, 'Hospital Admin LMS', '2018-07-22 08:29:02'),
(224, 'Nurse Doctor Updated', 'Nurse', 72, 3, 'Hospital Admin LMS', '2018-07-22 08:29:02'),
(225, 'Nurse Doctor Updated', 'Nurse', 73, 3, 'Hospital Admin LMS', '2018-07-22 08:35:00'),
(226, 'Nurse Doctor Updated', 'Nurse', 74, 3, 'Hospital Admin LMS', '2018-07-22 09:18:41'),
(227, 'Nurse Doctor Updated', 'Nurse', 75, 3, 'Hospital Admin LMS', '2018-07-22 09:18:41'),
(228, 'Nurse Doctor Updated', 'Nurse', 76, 3, 'Hospital Admin LMS', '2018-07-22 09:18:41'),
(229, 'receptionist Doctor Updated', 'Receptionist', 7, 3, 'Hospital Admin LMS', '2018-07-22 09:19:26'),
(230, 'receptionist Doctor Updated', 'Receptionist', 8, 3, 'Hospital Admin LMS', '2018-07-22 09:19:26'),
(231, 'receptionist Doctor Updated', 'Receptionist', 9, 3, 'Hospital Admin LMS', '2018-07-22 09:19:26'),
(232, 'Nurse Doctor Updated', 'Nurse', 77, 3, 'Hospital Admin LMS', '2018-07-23 13:44:10'),
(233, 'Nurse Doctor Updated', 'Nurse', 78, 3, 'Hospital Admin LMS', '2018-07-23 13:44:10'),
(234, 'Nurse Doctor Updated', 'Nurse', 79, 3, 'Hospital Admin LMS', '2018-07-23 13:44:10'),
(235, 'New user created', 'User', 190, 3, 'Hospital Admin LMS', '2018-07-24 03:11:57'),
(236, 'New nurse added', 'Nurse', 80, 3, 'Hospital Admin LMS', '2018-07-24 03:12:01'),
(237, 'New nurse added', 'Nurse', 81, 3, 'Hospital Admin LMS', '2018-07-24 03:12:01'),
(238, 'New user created', 'User', 191, 3, 'Hospital Admin LMS', '2018-07-24 03:19:13'),
(239, 'New receptionist added', 'Receptionist', 10, 3, 'Hospital Admin LMS', '2018-07-24 03:19:15'),
(240, 'New receptionist added', 'Receptionist', 11, 3, 'Hospital Admin LMS', '2018-07-24 03:19:15'),
(241, 'receptionist Doctor Updated', 'Receptionist', 12, 3, 'Hospital Admin LMS', '2018-07-24 03:20:29'),
(242, 'New user registered', 'User', 192, 12, 'Dr. Ravi Patel', '2018-07-24 03:23:40'),
(243, 'New user created', 'User', 1, 0, '', '2018-07-24 03:36:08'),
(244, 'New appointment created', 'Appointment', 28, 184, 'sazeed ', '2018-07-24 14:12:38'),
(245, 'New appointment created', 'Appointment', 29, 26, 'User ', '2018-07-24 14:26:42'),
(246, 'Appointment updated', 'Appointment', 29, 26, 'User ', '2018-07-24 14:28:20'),
(247, 'Appointment updated', 'Appointment', 29, 26, 'User ', '2018-07-24 14:28:46'),
(248, 'User details updated', 'User', 3, 3, 'Hospital Admin LMS', '2018-07-24 15:59:19'),
(249, 'User details updated', 'User', 3, 3, 'Hospital Admin LMS', '2018-07-24 15:59:19'),
(250, 'Appointment approved', 'Appointment', 7, 12, 'Dr. Ravi Patel', '2018-07-24 22:14:59'),
(251, 'Appointment approved', 'Appointment', 8, 12, 'Dr. Ravi Patel', '2018-07-24 22:15:03'),
(252, 'Appointment approved', 'Appointment', 8, 12, 'Dr. Ravi Patel', '2018-07-24 22:15:14'),
(253, 'Appointment approved', 'Appointment', 7, 12, 'Dr. Ravi Patel', '2018-07-24 22:15:24'),
(254, 'Appointment rejected', 'Appointment', 8, 12, 'Dr. Ravi Patel', '2018-07-24 22:15:30'),
(255, 'New appointment created', 'Appointment', 30, 188, 'sajid 123', '2018-07-25 02:28:41'),
(256, 'Appointment canceled', 'Appointment', 27, 188, 'sajid 123', '2018-07-25 07:58:51'),
(257, 'Appointment canceled', 'Appointment', 27, 188, 'sajid 123', '2018-07-25 07:59:03'),
(258, 'Appointment canceled', 'Appointment', 27, 188, 'sajid 123', '2018-07-25 07:59:32'),
(259, 'Appointment rejected', 'Appointment', 28, 39, 'Receptionist ', '2018-07-25 08:01:10'),
(260, 'receptionist Doctor Updated', 'Receptionist', 13, 3, 'Hospital Admin LMS', '2018-07-25 07:11:51'),
(261, 'receptionist Doctor Updated', 'Receptionist', 14, 3, 'Hospital Admin LMS', '2018-07-25 07:11:51'),
(262, 'receptionist Doctor Updated', 'Receptionist', 15, 3, 'Hospital Admin LMS', '2018-07-25 07:11:51'),
(263, 'User details updated', 'User', 12, 3, 'Hospital Admin LMS', '2018-07-25 15:55:11'),
(264, 'New doctor Specialization added', 'Doctor', 1, 3, 'Hospital Admin LMS', '2018-07-25 15:55:11'),
(265, 'New doctor Specialization added', 'Doctor', 2, 3, 'Hospital Admin LMS', '2018-07-25 15:55:11'),
(266, 'Doctor details updated', 'Doctor', 2, 3, 'Hospital Admin LMS', '2018-07-25 15:55:11'),
(267, 'New user created', 'User', 193, 3, 'Hospital Admin LMS', '2018-07-25 15:58:47'),
(268, 'New doctor Specialization added', 'Doctor', 3, 3, 'Hospital Admin LMS', '2018-07-25 15:58:50'),
(269, 'New doctor Specialization added', 'Doctor', 4, 3, 'Hospital Admin LMS', '2018-07-25 15:58:50'),
(270, 'New doctor added', 'Doctor', 128, 3, 'Hospital Admin LMS', '2018-07-25 15:58:50'),
(271, 'User details updated', 'User', 193, 3, 'Hospital Admin LMS', '2018-07-25 15:59:35'),
(272, 'New doctor Specialization added', 'Doctor', 5, 3, 'Hospital Admin LMS', '2018-07-25 15:59:35'),
(273, 'New doctor Specialization added', 'Doctor', 6, 3, 'Hospital Admin LMS', '2018-07-25 15:59:35'),
(274, 'Doctor details updated', 'Doctor', 128, 3, 'Hospital Admin LMS', '2018-07-25 15:59:35'),
(275, 'receptionist Doctor Updated', 'Receptionist', 16, 3, 'Hospital Admin LMS', '2018-07-26 02:52:18'),
(276, 'User details updated', 'User', 12, 3, 'Hospital Admin LMS', '2018-07-26 17:15:46'),
(277, 'New doctor Specialization added', 'Doctor', 7, 3, 'Hospital Admin LMS', '2018-07-26 17:15:46'),
(278, 'New doctor Specialization added', 'Doctor', 8, 3, 'Hospital Admin LMS', '2018-07-26 17:15:46'),
(279, 'New doctor Specialization added', 'Doctor', 9, 3, 'Hospital Admin LMS', '2018-07-26 17:15:46'),
(280, 'Doctor details updated', 'Doctor', 2, 3, 'Hospital Admin LMS', '2018-07-26 17:15:46'),
(281, 'receptionist Doctor Updated', 'Receptionist', 17, 3, 'Hospital Admin LMS', '2018-07-27 02:19:40'),
(282, 'New user registered', 'User', 194, 12, 'Dr. Ravi Patel', '2018-07-30 00:32:45'),
(283, 'New appointment created', 'Appointment', 31, 12, 'Dr. Ravi Patel', '2018-07-30 00:33:37'),
(284, 'New user created', 'User', 1, 0, '', '2018-07-30 00:37:16'),
(285, 'Appointment approved', 'Appointment', 31, 12, 'Dr. Ravi Patel', '2018-07-30 06:09:14'),
(286, 'Recommned next appointment date added in appointment', 'RecommnedDate', 9, 12, 'Dr. Ravi Patel', '2018-07-30 00:54:48'),
(287, 'New appointment created', 'Appointment', 32, 26, 'User ', '2018-07-30 03:20:26'),
(288, 'User details updated', 'User', 12, 12, 'Dr. Ravi Patel', '2018-07-30 17:19:10'),
(289, ' \'Dr. Ravi Patel\' updated specialization', 'Doctor', 2, 12, 'Dr. Ravi Patel', '2018-07-30 17:19:10'),
(290, 'Doctor details updated', 'Doctor', 2, 12, 'Dr. Ravi Patel', '2018-07-30 17:19:10'),
(291, 'Hospital Admin profile updated', 'HospitalAdmin', 1, 3, 'Hospital Admin LMS', '2018-07-30 17:20:15'),
(292, 'New appointment created', 'Appointment', 33, 12, 'Dr. Ravi Patel', '2018-07-31 02:25:27'),
(293, 'New appointment created', 'Appointment', 34, 12, 'Dr. Ravi Patel', '2018-08-01 02:23:24'),
(294, 'receptionist Doctor Updated', 'Receptionist', 18, 3, 'Hospital Admin LMS', '2018-08-03 01:09:15'),
(295, 'Doctor Other settings updated regarding availability', 'Doctor', 2, 12, 'Dr. Ravi Patel', '2018-08-03 01:21:42'),
(296, 'Doctor availability inserted', 'Availability', 1, 12, 'Dr. Ravi Patel', '2018-08-03 01:23:07'),
(297, 'Doctor availability inserted', 'Availability', 2, 12, 'Dr. Ravi Patel', '2018-08-03 01:23:07'),
(298, 'Doctor availability inserted', 'Availability', 3, 12, 'Dr. Ravi Patel', '2018-08-03 01:23:07'),
(299, 'Doctor availability inserted', 'Availability', 4, 12, 'Dr. Ravi Patel', '2018-08-03 01:23:07'),
(300, 'Doctor availability inserted', 'Availability', 5, 12, 'Dr. Ravi Patel', '2018-08-03 01:23:07'),
(301, 'New appointment created', 'Appointment', 1, 39, 'Receptionist ', '2018-08-03 01:54:06'),
(302, 'User details updated', 'User', 12, 3, 'Hospital Admin LMS', '2018-08-03 02:26:50'),
(303, 'New doctor Specialization added', 'Doctor', 12, 3, 'Hospital Admin LMS', '2018-08-03 02:26:50'),
(304, 'New doctor Specialization added', 'Doctor', 13, 3, 'Hospital Admin LMS', '2018-08-03 02:26:50'),
(305, 'Doctor details updated', 'Doctor', 2, 3, 'Hospital Admin LMS', '2018-08-03 02:26:50'),
(306, 'Recommned next appointment date added in appointment', 'RecommnedDate', 1, 12, 'Dr. Ravi Patel', '2018-08-03 02:53:12'),
(307, 'Doctor availability inserted', 'Availability', 6, 12, 'Dr. Ravi Patel', '2018-08-03 03:30:23'),
(308, 'Doctor availability inserted', 'Availability', 7, 12, 'Dr. Ravi Patel', '2018-08-03 03:30:23'),
(309, 'Doctor availability inserted', 'Availability', 8, 12, 'Dr. Ravi Patel', '2018-08-03 03:53:18'),
(310, 'Doctor availability inserted', 'Availability', 9, 12, 'Dr. Ravi Patel', '2018-08-03 03:54:47'),
(311, 'Doctor Other settings updated regarding availability', 'Doctor', 2, 12, 'Dr. Ravi Patel', '2018-08-03 03:58:38'),
(312, 'Doctor availability soft deleted', 'Availability', 6, 12, 'Dr. Ravi Patel', '2018-08-03 04:02:35'),
(313, 'Doctor availability inserted', 'Availability', 1, 12, 'Dr. Ravi Patel', '2018-08-03 04:05:51'),
(314, 'Doctor availability inserted', 'Availability', 2, 12, 'Dr. Ravi Patel', '2018-08-03 04:05:51'),
(315, 'Doctor availability inserted', 'Availability', 3, 12, 'Dr. Ravi Patel', '2018-08-03 04:05:51'),
(316, 'Doctor availability inserted', 'Availability', 4, 12, 'Dr. Ravi Patel', '2018-08-03 04:05:51'),
(317, 'Doctor availability inserted', 'Availability', 5, 12, 'Dr. Ravi Patel', '2018-08-03 04:05:51'),
(318, 'Doctor availability inserted', 'Availability', 6, 12, 'Dr. Ravi Patel', '2018-08-03 04:07:21'),
(319, 'Doctor availability inserted', 'Availability', 7, 12, 'Dr. Ravi Patel', '2018-08-03 04:07:21'),
(320, 'Doctor availability inserted', 'Availability', 9, 12, 'Dr. Ravi Patel', '2018-08-03 04:13:40'),
(321, 'New appointment created', 'Appointment', 2, 12, 'Dr. Ravi Patel', '2018-08-03 10:31:30'),
(322, 'Appointment rejected', 'Appointment', 2, 12, 'Dr. Ravi Patel', '2018-08-03 16:02:45'),
(323, 'Appointment approved', 'Appointment', 2, 12, 'Dr. Ravi Patel', '2018-08-03 16:03:21'),
(324, 'Recommned next appointment date added in appointment', 'RecommnedDate', 2, 12, 'Dr. Ravi Patel', '2018-08-03 10:33:51'),
(325, 'Doctor availability inserted', 'Availability', 11, 12, 'Dr. Ravi Patel', '2018-08-04 13:50:56'),
(326, 'Doctor availability inserted', 'Availability', 12, 12, 'Dr. Ravi Patel', '2018-08-04 13:50:56'),
(327, 'New user created', 'User', 195, 3, 'Hospital Admin LMS', '2018-08-07 17:47:03'),
(328, 'New receptionist added', 'Receptionist', 19, 3, 'Hospital Admin LMS', '2018-08-07 17:47:06'),
(329, 'New receptionist added', 'Receptionist', 20, 3, 'Hospital Admin LMS', '2018-08-07 17:47:06'),
(330, 'New receptionist added', 'Receptionist', 21, 3, 'Hospital Admin LMS', '2018-08-07 17:47:06'),
(331, 'New receptionist added', 'Receptionist', 22, 3, 'Hospital Admin LMS', '2018-08-07 17:47:06'),
(332, 'New receptionist added', 'Receptionist', 23, 3, 'Hospital Admin LMS', '2018-08-07 17:47:06'),
(333, 'New receptionist added', 'Receptionist', 24, 3, 'Hospital Admin LMS', '2018-08-07 17:47:06'),
(334, 'New receptionist added', 'Receptionist', 25, 3, 'Hospital Admin LMS', '2018-08-07 17:47:06'),
(335, 'receptionist Doctor Updated', 'Receptionist', 26, 3, 'Hospital Admin LMS', '2018-08-07 17:48:38'),
(336, 'receptionist Doctor Updated', 'Receptionist', 27, 3, 'Hospital Admin LMS', '2018-08-07 17:48:38'),
(337, 'receptionist Doctor Updated', 'Receptionist', 28, 3, 'Hospital Admin LMS', '2018-08-07 17:48:38'),
(338, 'receptionist Doctor Updated', 'Receptionist', 29, 3, 'Hospital Admin LMS', '2018-08-07 17:48:38'),
(339, 'New appointment created', 'Appointment', 3, 39, 'Receptionist ', '2018-08-07 17:52:42'),
(340, 'New user registered', 'User', 196, 39, 'Receptionist ', '2018-08-07 18:05:11'),
(341, 'New appointment created', 'Appointment', 4, 26, 'User ', '2018-08-07 18:14:13'),
(342, 'Appointment updated', 'Appointment', 4, 26, 'User ', '2018-08-07 18:16:28'),
(343, 'New user created', 'User', 197, 3, 'Hospital Admin LMS', '2018-08-07 18:40:56'),
(344, 'New receptionist added', 'Receptionist', 30, 3, 'Hospital Admin LMS', '2018-08-07 18:41:00'),
(345, 'New receptionist added', 'Receptionist', 31, 3, 'Hospital Admin LMS', '2018-08-07 18:41:00'),
(346, 'New receptionist added', 'Receptionist', 32, 3, 'Hospital Admin LMS', '2018-08-07 18:41:00'),
(347, 'New user registered', 'User', 198, 12, 'Dr. Ravi Patel', '2018-08-08 02:48:55'),
(348, 'New appointment created', 'Appointment', 5, 12, 'Dr. Ravi Patel', '2018-08-08 02:49:14'),
(349, 'Doctor availability inserted', 'Availability', 1, 39, 'Receptionist ', '2018-08-08 03:16:05'),
(350, 'Doctor availability inserted', 'Availability', 2, 39, 'Receptionist ', '2018-08-08 03:16:05'),
(351, 'Doctor availability inserted', 'Availability', 3, 39, 'Receptionist ', '2018-08-08 03:16:05'),
(352, 'Doctor availability inserted', 'Availability', 4, 39, 'Receptionist ', '2018-08-08 03:16:05'),
(353, 'Doctor availability inserted', 'Availability', 5, 39, 'Receptionist ', '2018-08-08 03:16:05'),
(354, 'Doctor availability inserted', 'Availability', 6, 39, 'Receptionist ', '2018-08-08 03:16:05'),
(355, 'Doctor availability inserted', 'Availability', 7, 39, 'Receptionist ', '2018-08-08 03:18:08'),
(356, 'Doctor availability inserted', 'Availability', 8, 39, 'Receptionist ', '2018-08-08 03:24:10'),
(357, 'Doctor availability inserted', 'Availability', 1, 39, 'Receptionist ', '2018-08-08 03:27:14'),
(358, 'Doctor availability inserted', 'Availability', 1, 39, 'Receptionist ', '2018-08-08 03:33:18'),
(359, 'Doctor availability inserted', 'Availability', 2, 39, 'Receptionist ', '2018-08-08 03:33:18'),
(360, 'Doctor availability inserted', 'Availability', 3, 39, 'Receptionist ', '2018-08-08 03:33:18'),
(361, 'Doctor availability inserted', 'Availability', 4, 39, 'Receptionist ', '2018-08-08 03:33:18'),
(362, 'Doctor availability inserted', 'Availability', 5, 39, 'Receptionist ', '2018-08-08 03:33:18'),
(363, 'Doctor availability inserted', 'Availability', 6, 39, 'Receptionist ', '2018-08-08 03:33:51'),
(364, 'Doctor availability inserted', 'Availability', 7, 39, 'Receptionist ', '2018-08-08 03:33:51'),
(365, 'receptionist Doctor Updated', 'Receptionist', 33, 3, 'Hospital Admin LMS', '2018-08-08 05:09:51'),
(366, 'receptionist Doctor Updated', 'Receptionist', 34, 3, 'Hospital Admin LMS', '2018-08-08 05:09:51'),
(367, 'receptionist Doctor Updated', 'Receptionist', 35, 3, 'Hospital Admin LMS', '2018-08-08 05:09:51'),
(368, 'receptionist Doctor Updated', 'Receptionist', 36, 3, 'Hospital Admin LMS', '2018-08-08 05:09:51'),
(369, 'receptionist Doctor Updated', 'Receptionist', 37, 3, 'Hospital Admin LMS', '2018-08-08 05:12:58'),
(370, 'receptionist Doctor Updated', 'Receptionist', 38, 3, 'Hospital Admin LMS', '2018-08-08 05:13:34'),
(371, 'receptionist Doctor Updated', 'Receptionist', 39, 3, 'Hospital Admin LMS', '2018-08-08 05:14:03'),
(372, 'receptionist Doctor Updated', 'Receptionist', 40, 3, 'Hospital Admin LMS', '2018-08-08 05:14:03'),
(373, 'receptionist Doctor Updated', 'Receptionist', 41, 3, 'Hospital Admin LMS', '2018-08-08 05:14:03'),
(374, 'receptionist Doctor Updated', 'Receptionist', 42, 3, 'Hospital Admin LMS', '2018-08-08 05:14:03'),
(375, 'receptionist Doctor Updated', 'Receptionist', 43, 3, 'Hospital Admin LMS', '2018-08-08 05:24:47'),
(376, 'receptionist Doctor Updated', 'Receptionist', 44, 3, 'Hospital Admin LMS', '2018-08-08 05:24:47'),
(377, 'receptionist Doctor Updated', 'Receptionist', 45, 3, 'Hospital Admin LMS', '2018-08-08 05:24:47'),
(378, 'receptionist Doctor Updated', 'Receptionist', 46, 3, 'Hospital Admin LMS', '2018-08-08 05:24:47'),
(379, 'Doctor availability inserted', 'Availability', 8, 181, 'receptionist one', '2018-08-08 05:38:53'),
(380, 'receptionist Doctor Updated', 'Receptionist', 47, 3, 'Hospital Admin LMS', '2018-08-08 12:42:08'),
(381, 'receptionist Doctor Updated', 'Receptionist', 48, 3, 'Hospital Admin LMS', '2018-08-08 12:42:08'),
(382, 'receptionist Doctor Updated', 'Receptionist', 49, 3, 'Hospital Admin LMS', '2018-08-08 12:47:36'),
(383, 'receptionist Doctor Updated', 'Receptionist', 50, 3, 'Hospital Admin LMS', '2018-08-08 12:47:36'),
(384, 'receptionist Doctor Updated', 'Receptionist', 51, 3, 'Hospital Admin LMS', '2018-08-08 12:47:36'),
(385, 'receptionist Doctor Updated', 'Receptionist', 52, 3, 'Hospital Admin LMS', '2018-08-08 12:47:36'),
(386, 'receptionist Doctor Updated', 'Receptionist', 53, 3, 'Hospital Admin LMS', '2018-08-08 12:47:36'),
(387, 'receptionist Doctor Updated', 'Receptionist', 54, 3, 'Hospital Admin LMS', '2018-08-08 12:47:36'),
(388, 'receptionist Doctor Updated', 'Receptionist', 55, 3, 'Hospital Admin LMS', '2018-08-08 12:47:36'),
(389, 'New appointment created', 'Appointment', 6, 26, 'User ', '2018-08-08 17:27:47'),
(390, 'Recommned next appointment date added in appointment', 'RecommnedDate', 3, 12, 'Dr. Ravi Patel', '2018-08-08 17:30:10'),
(391, 'New hospital created', 'Hospital', 113, 1, 'Super Admin', '2018-08-08 18:40:38'),
(392, 'Hospital details updated', 'Hospital', 113, 1, 'Super Admin', '2018-08-09 02:20:46'),
(393, 'Hospital details updated', 'Hospital', 113, 1, 'Super Admin', '2018-08-09 02:21:22'),
(394, 'New user created', 'User', 199, 1, 'Super Admin', '2018-08-11 02:50:21'),
(395, 'Hospital admin added', 'HospitalAdmin', 3, 1, 'Super Admin', '2018-08-11 02:50:24'),
(396, 'receptionist Doctor Updated', 'Receptionist', 56, 3, 'Hospital Admin LMS', '2018-08-12 06:14:20'),
(397, 'receptionist Doctor Updated', 'Receptionist', 57, 3, 'Hospital Admin LMS', '2018-08-12 06:14:20'),
(398, 'receptionist Doctor Updated', 'Receptionist', 58, 3, 'Hospital Admin LMS', '2018-08-12 06:14:20'),
(399, 'New branch added', 'Branch', 103, 1, 'Super Admin', '2018-08-12 07:39:14'),
(400, 'New branch added', 'Branch', 104, 1, 'Super Admin', '2018-08-12 08:42:10'),
(401, 'Branch updated', 'Branch', 103, 1, 'Super Admin', '2018-08-12 08:45:51'),
(402, 'New branch added', 'Branch', 105, 1, 'Super Admin', '2018-08-12 12:53:56'),
(403, 'Nurse Doctor Updated', 'Nurse', 82, 3, 'Hospital Admin LMS', '2018-08-13 02:33:36'),
(404, 'Nurse Doctor Updated', 'Nurse', 83, 3, 'Hospital Admin LMS', '2018-08-13 02:33:36'),
(405, 'Nurse Doctor Updated', 'Nurse', 84, 3, 'Hospital Admin LMS', '2018-08-13 02:33:36'),
(406, 'Nurse Doctor Updated', 'Nurse', 85, 3, 'Hospital Admin LMS', '2018-08-13 02:36:12'),
(407, 'Nurse Doctor Updated', 'Nurse', 86, 3, 'Hospital Admin LMS', '2018-08-13 02:36:12'),
(408, 'Nurse Doctor Updated', 'Nurse', 87, 3, 'Hospital Admin LMS', '2018-08-13 02:36:12'),
(409, 'New appointment created', 'Appointment', 7, 1, 'Super Admin', '2018-08-13 02:37:31'),
(410, 'New appointment created', 'Appointment', 8, 3, 'Hospital Admin LMS', '2018-08-13 17:23:53'),
(411, 'receptionist Doctor Updated', 'Receptionist', 59, 3, 'Hospital Admin LMS', '2018-08-13 17:51:04'),
(412, 'receptionist Doctor Updated', 'Receptionist', 60, 3, 'Hospital Admin LMS', '2018-08-13 17:51:04'),
(413, 'receptionist Doctor Updated', 'Receptionist', 61, 3, 'Hospital Admin LMS', '2018-08-13 17:51:04'),
(414, 'receptionist Doctor Updated', 'Receptionist', 62, 3, 'Hospital Admin LMS', '2018-08-13 17:51:04'),
(415, 'receptionist Doctor Updated', 'Receptionist', 63, 3, 'Hospital Admin LMS', '2018-08-13 17:51:04'),
(416, 'receptionist Doctor Updated', 'Receptionist', 64, 3, 'Hospital Admin LMS', '2018-08-13 17:51:04'),
(417, 'New department created', 'Department', 107, 1, 'Super Admin', '2018-08-14 02:01:00'),
(418, 'New ward added', 'Ward', 105, 1, 'Super Admin', '2018-08-14 02:01:53'),
(419, 'New branch added', 'Branch', 106, 1, 'Super Admin', '2018-08-14 02:24:37'),
(420, 'User details updated', 'User', 186, 1, 'Super Admin', '2018-08-14 02:32:55'),
(421, 'New doctor Specialization added', 'Doctor', 14, 1, 'Super Admin', '2018-08-14 02:32:55'),
(422, 'Doctor details updated', 'Doctor', 127, 1, 'Super Admin', '2018-08-14 02:32:55'),
(423, 'New appointment created', 'Appointment', 9, 3, 'Hospital Admin LMS', '2018-08-14 02:51:27'),
(424, 'New appointment created', 'Appointment', 10, 3, 'Hospital Admin LMS', '2018-08-14 02:55:29'),
(425, 'Appointment rejected', 'Appointment', 10, 39, 'Receptionist ', '2018-08-14 08:26:54'),
(426, 'Doctor availability inserted', 'Availability', 1, 12, 'Dr. Ravi Patel', '2018-08-14 03:39:11'),
(427, 'Doctor availability inserted', 'Availability', 2, 12, 'Dr. Ravi Patel', '2018-08-14 03:39:11'),
(428, 'Doctor availability inserted', 'Availability', 3, 12, 'Dr. Ravi Patel', '2018-08-14 03:39:11'),
(429, 'Doctor availability inserted', 'Availability', 4, 12, 'Dr. Ravi Patel', '2018-08-14 03:39:11'),
(430, 'Doctor availability inserted', 'Availability', 5, 12, 'Dr. Ravi Patel', '2018-08-14 03:39:11');

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
  `status` int(11) NOT NULL DEFAULT '1',
  `reason` text NOT NULL,
  `remarks` text NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_appoitments`
--

INSERT INTO `hms_appoitments` (`id`, `appoitment_number`, `user_id`, `department_id`, `doctor_id`, `appoitment_date`, `appoitment_time_start`, `appoitment_time_end`, `status`, `reason`, `remarks`, `created_at`, `modified_at`, `isDeleted`) VALUES
(1, 'APT1', 187, 1, 2, '2018-08-03', '09:00:00', '09:30:00', 1, 'test', 'test', '0000-00-00 00:00:00', '2018-08-03 01:54:06', 0),
(2, 'APT2', 26, 0, 2, '2018-08-09', '09:00:00', '09:30:00', 1, 'test', 'test', '0000-00-00 00:00:00', '2018-08-03 10:33:21', 0),
(3, 'APT3', 187, 1, 2, '2018-08-08', '09:00:00', '09:30:00', 1, 'test', 'test', '0000-00-00 00:00:00', '2018-08-07 17:52:42', 0),
(4, 'APT4', 26, 1, 2, '2018-08-08', '09:00:00', '09:30:00', 1, 'mcxnvcx,v', '', '0000-00-00 00:00:00', '2018-08-07 18:16:28', 0),
(5, 'APT5', 198, 1, 2, '2018-08-10', '14:30:00', '15:00:00', 1, 'Test', 'Test', '0000-00-00 00:00:00', '2018-08-08 02:49:14', 0),
(6, 'APT6', 26, 1, 2, '2018-08-10', '09:03:00', '09:33:00', 1, 'cxvxb', '', '0000-00-00 00:00:00', '2018-08-08 17:27:47', 0),
(7, 'APT7', 187, 1, 2, '2018-08-13', '10:03:00', '10:33:00', 1, 'test', '', '0000-00-00 00:00:00', '2018-08-13 02:37:31', 0),
(8, 'APT8', 188, 1, 2, '2018-08-14', '09:03:00', '09:33:00', 1, 'fever\r\n', '', '0000-00-00 00:00:00', '2018-08-13 17:23:53', 0),
(9, 'APT9', 188, 1, 2, '2018-08-14', '09:03:00', '09:33:00', 1, 'fever', '', '0000-00-00 00:00:00', '2018-08-14 02:51:27', 0),
(10, 'APT10', 188, 1, 2, '2018-08-16', '09:03:00', '09:33:00', 2, 'fever\r\n', '', '0000-00-00 00:00:00', '2018-08-14 02:56:54', 0);

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

--
-- Dumping data for table `hms_availability`
--

INSERT INTO `hms_availability` (`id`, `user_id`, `repeat_interval`, `isReatAllDay`, `start_date`, `end_date`, `start_time`, `end_time`, `day`, `isDeleted`, `created_at`, `modified_at`) VALUES
(1, 2, 0, 1, '2018-08-14', '2018-08-31', '09:00:00', '16:00:00', 1, 0, '0000-00-00 00:00:00', '2018-08-14 03:39:11'),
(2, 2, 0, 1, '2018-08-14', '2018-08-31', '09:00:00', '16:00:00', 2, 0, '0000-00-00 00:00:00', '2018-08-14 03:39:11'),
(3, 2, 0, 1, '2018-08-14', '2018-08-31', '09:00:00', '16:00:00', 3, 0, '0000-00-00 00:00:00', '2018-08-14 03:39:11'),
(4, 2, 0, 1, '2018-08-14', '2018-08-31', '09:00:00', '16:00:00', 4, 0, '0000-00-00 00:00:00', '2018-08-14 03:39:11'),
(5, 2, 0, 1, '2018-08-14', '2018-08-31', '09:00:00', '16:00:00', 5, 0, '0000-00-00 00:00:00', '2018-08-14 03:39:11');

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
(1, 91, 'B9', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(2, 86, 'F4', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(3, 28, 'J4', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(4, 29, 'X4', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(5, 16, 'P0', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(6, 78, 'S2', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(7, 77, 'N5', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(8, 16, 'P2', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(9, 43, 'L3', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(10, 36, 'V1', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(11, 33, 'K2', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(12, 65, 'L1', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(13, 20, 'M6', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(14, 19, 'W7', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(15, 70, 'D9', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(16, 97, 'T6', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(17, 14, 'W4', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(18, 13, 'L2', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(19, 1, 'X2', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(20, 63, 'P7', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(21, 18, 'W4', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(22, 96, 'R2', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(23, 22, 'V0', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(24, 50, 'N7', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(25, 36, 'M2', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(26, 8, 'K0', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(27, 13, 'C2', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(28, 19, 'X6', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(29, 19, 'M2', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(30, 32, 'W6', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(31, 16, 'H1', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(32, 35, 'F0', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(33, 53, 'N3', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(34, 42, 'L3', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(35, 59, 'F7', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(36, 24, 'Q6', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(37, 84, 'H0', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(38, 36, 'V6', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(39, 36, 'K8', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(40, 97, 'R4', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(41, 63, 'S0', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(42, 35, 'P4', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(43, 65, 'Q0', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(44, 41, 'Q2', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(45, 63, 'P1', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(46, 16, 'T6', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(47, 11, 'F2', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(48, 48, 'P6', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(49, 22, 'G8', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(50, 35, 'R1', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(51, 75, 'T8', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(52, 13, 'V3', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(53, 53, 'X5', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(54, 54, 'F6', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(55, 74, 'B9', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(56, 17, 'N0', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(57, 52, 'J5', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(58, 17, 'V2', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(59, 74, 'R3', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(60, 59, 'P6', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(61, 35, 'K0', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(62, 30, 'F7', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(63, 37, 'L2', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(64, 57, 'G7', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(65, 45, 'F4', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(66, 58, 'F3', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(67, 34, 'F2', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(68, 48, 'F9', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(69, 57, 'J1', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(70, 21, 'Z7', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(71, 50, 'W8', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(72, 80, 'G0', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(73, 95, 'L7', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(74, 59, 'R4', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(75, 5, 'G5', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(76, 62, 'H4', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(77, 41, 'L2', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(78, 58, 'F5', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(79, 93, 'H2', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(80, 5, 'M4', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(81, 61, 'W0', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(82, 13, 'Z7', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(83, 23, 'Q3', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(84, 40, 'D3', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(85, 3, 'X2', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(86, 19, 'D7', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(87, 35, 'F6', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(88, 18, 'R4', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(89, 93, 'H3', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(90, 99, 'Y4', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(91, 21, 'J3', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(92, 61, 'Y9', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(93, 70, 'N5', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(94, 7, 'B0', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(95, 56, 'Y3', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(96, 3, 'Q1', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(97, 39, 'T6', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(98, 24, 'Z9', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(99, 80, 'G1', 1, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(100, 86, 'F9', 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:13:14'),
(101, 1, 'B62', 0, 1, 1, '2017-10-23 12:03:15', '2017-10-23 15:34:03'),
(102, 1, 'B10', 0, 1, 0, '2018-07-13 09:03:08', '2018-07-13 09:03:08');

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
(1, 21, 'WB', '(629) 152-8328', 'volutpat@massa.net', 'P.O. Box 437, 5335 Tortor Ave', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(2, 18, 'Delta', '(204) 186-8906', 'Nullam.ut@egestas.com', 'P.O. Box 300, 6695 Condimentum Av.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(3, 27, 'Ist', '(844) 967-5768', 'Suspendisse.eleifend@egetmassa.org', 'Ap #451-7609 Porttitor Rd.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(4, 21, 'Andhra Pradesh', '(312) 844-8530', 'mollis@Duisrisus.co.uk', 'Ap #997-7096 Phasellus Ave', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(5, 85, 'Berlin', '(156) 723-6059', 'placerat.eget@Morbinonsapien.net', '983 Cursus. Ave', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(6, 37, 'Guanacaste', '(X26) X18-7853', 'gravida.mauris@nonegestasa.co.uk', '537-5199 Duis Street', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(7, 77, 'SIC', '(216) 734-5641', 'nec@Aliquamnecenim.co.uk', 'P.O. Box 973, 2841 Nostra, St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(8, 27, 'Lancashire', '(415) 232-7232', 'Duis.a@gravidamolestiearcu.org', 'P.O. Box 589, 7124 Cum Road', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(9, 97, 'Wie', '(625) 419-1390', 'lobortis.quis.pede@aneque.ca', '605-8656 Nulla Av.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(10, 85, 'Ontario', '(177) 793-7865', 'lorem.semper.auctor@Cras.com', '856-1024 Libero Rd.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(11, 78, 'Alajuela', '(X24) X18-6398', 'elit.erat@molestiedapibus.ca', 'P.O. Box 696, 6350 Fermentum Rd.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(12, 68, 'Zl', '(134) 884-6186', 'taciti.sociosqu@magnaet.com', '236-3976 Libero Road', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(13, 53, 'X', '(400) 369-9813', 'dui@erateget.edu', 'Ap #704-912 At St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(14, 34, 'WA', '(276) 827-3526', 'Cum@Curabituregestasnunc.org', 'P.O. Box 971, 2968 Sit Ave', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(15, 51, 'VA', '(223) 366-1653', 'sem.magna@vitaeodio.edu', '920-7279 Diam. St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(16, 24, 'Leinster', '(315) 588-1920', 'orci.lobortis.augue@eget.co.uk', '889-7332 Sit Rd.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(17, 84, 'SA', '(833) 669-9704', 'nulla@mauris.co.uk', 'P.O. Box 634, 2784 Sed Street', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(18, 28, 'Berlin', '(212) 573-1320', 'tristique.neque@tincidunt.com', 'Ap #144-2930 Lacus. St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(19, 99, 'Texas', '(592) 283-9147', 'velit.Cras.lorem@pharetra.net', '4671 Risus St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(20, 99, 'C', '(741) 507-2196', 'lacinia.Sed.congue@auctor.co.uk', '4076 Gravida. Road', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(21, 69, 'New South Wales', '(577) 146-6450', 'Morbi.non.sapien@mattis.org', '152-9960 Elit. St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(22, 82, 'CM', '(545) 767-5483', 'magna@Phasellus.com', '531-4831 Consectetuer Road', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(23, 72, 'Emilia-Romagna', '(302) 594-9013', 'Etiam.laoreet@maurisaliquam.co.uk', 'Ap #315-7150 Arcu. Rd.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(24, 39, 'Odisha', '(831) 250-9245', 'a@nuncinterdum.net', 'Ap #237-2862 Ac Avenue', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(25, 73, 'A', '(X24) X65-5485', 'Nam@aclibero.ca', 'P.O. Box 980, 4421 Eget, Road', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(26, 42, 'MI', '(869) 400-7771', 'nec@vitae.edu', 'Ap #876-366 Amet Rd.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(27, 52, 'Connacht', '(370) 949-1227', 'nunc.ullamcorper.eu@dolorQuisque.edu', 'P.O. Box 519, 3514 Turpis Rd.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(28, 60, 'W', '(778) 941-2949', 'urna.justo.faucibus@ornarelibero.net', 'P.O. Box 748, 4818 Lacinia. Rd.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(29, 98, 'O', '(254) 378-2265', 'eleifend.nunc@Donecat.com', '142-6565 Ac Road', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(30, 76, 'Istanbul', '(448) 730-3326', 'nulla@commodoauctor.net', 'P.O. Box 511, 9281 Mauris Road', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(31, 32, 'Toscana', '(166) 340-7596', 'dictum@nibhDonecest.co.uk', '972-4563 Ut Ave', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(32, 43, 'Jigawa', '(862) 644-8255', 'lectus@vulputaterisusa.edu', 'P.O. Box 460, 1456 Et Ave', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(33, 73, 'Mer', '(109) 553-4228', 'porttitor.tellus@quis.com', '354-5377 Justo Street', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(34, 24, 'Zuid Holland', '(159) 391-8695', 'tincidunt.nibh@quam.net', '323-9570 Morbi Avenue', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(35, 40, 'WA', '(118) 806-6146', 'malesuada@Sed.ca', 'Ap #727-5211 Augue Rd.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(36, 11, 'Goias', '(808) 794-4942', 'enim.Nunc@Aeneaneget.org', 'Ap #113-3440 Feugiat St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:55:25'),
(37, 75, 'Castilla - La Mancha', '(599) 436-8751', 'Aenean.gravida.nunc@iaculisquispede.edu', 'P.O. Box 429, 3627 Aliquam St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(38, 57, 'HH', '(439) 116-6418', 'ultricies@luctus.ca', 'Ap #815-919 Luctus Av.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(39, 56, 'VII', '(927) 207-8208', 'Nunc@nullaCras.net', '807-5264 Egestas. Avenue', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(40, 99, 'Sao Paulo', '(403) 319-7722', 'molestie.sodales.Mauris@consectetuerrhoncusNullam.net', 'Ap #196-5888 Diam Avenue', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:55:19'),
(41, 47, 'Veneto', '(298) 942-9082', 'ut.nisi.a@Phasellus.com', '426-2906 Parturient Street', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(42, 74, 'Vastra Gotalands lan', '(524) 685-1217', 'amet.consectetuer@iaculis.ca', 'P.O. Box 785, 5177 Congue, Avenue', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:55:16'),
(43, 79, 'SI', '(689) 309-4143', 'convallis@tinciduntadipiscing.co.uk', 'Ap #564-4340 Ornare Av.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(44, 19, 'VEN', '(489) 450-7170', 'congue.elit@auctor.com', '465-9554 Libero. Street', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(45, 79, 'Diy', '(610) 264-8713', 'risus@velitPellentesqueultricies.net', '891-1748 Vel Street', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(46, 82, 'RJ', '(568) 513-9213', 'in.dolor.Fusce@cursusnon.edu', '9212 Donec St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(47, 69, 'NE', '(462) 334-2582', 'ipsum.Suspendisse@Maecenas.edu', 'P.O. Box 384, 3392 Porttitor St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(48, 46, 'odzkie', '(369) 258-2844', 'Nunc.quis@Maecenasiaculis.ca', 'P.O. Box 208, 9796 Ante. Rd.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:57:07'),
(49, 99, 'Ogun', '(895) 230-7200', 'elit@vitaeeratVivamus.co.uk', 'P.O. Box 211, 8397 Vulputate, Avenue', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(50, 64, 'AS', '(658) 972-8022', 'consectetuer.adipiscing.elit@dignissimpharetraNam.com', 'P.O. Box 653, 6170 Nullam Rd.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(51, 11, 'OY', '(235) 162-6859', 'a.tortor.Nunc@posuerecubilia.edu', 'Ap #492-8776 Tincidunt Street', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(52, 20, 'New South Wales', '(371) 478-3909', 'fames@Donectemporest.net', 'Ap #652-7249 Pede Rd.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(53, 88, 'PR', '(242) 945-3329', 'interdum.libero@Aeneaneget.com', '129-7516 Massa Street', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(54, 70, 'Vienna', '(983) 780-9953', 'et@Duis.com', 'Ap #183-4675 Fusce St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(55, 55, 'Castilla y Leon', '(453) 981-3979', 'sem@molestie.ca', '802-3118 Integer St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:58:13'),
(56, 85, 'Berlin', '(169) 952-9295', 'laoreet.libero@MaurismagnaDuis.edu', 'Ap #492-3972 Eu Rd.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(57, 12, 'Ma opolskie', '(207) 186-2300', 'pellentesque.massa@velitQuisque.ca', 'Ap #926-4529 Semper Ave', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:56:59'),
(58, 47, 'NI', '(243) 673-0721', 'nascetur.ridiculus.mus@anteiaculis.co.uk', 'P.O. Box 500, 2325 Fermentum Rd.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(59, 33, 'Vastra Gatalands lan', '(361) 843-4993', 'nec@ultricies.edu', '2643 Dignissim Avenue', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:56:55'),
(60, 40, 'SP', '(378) 473-9523', 'Quisque.porttitor.eros@arcuiaculis.ca', 'Ap #112-4356 Eget St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(61, 46, 'Berkshire', '(600) 469-7600', 'fringilla@Duis.org', 'P.O. Box 454, 3228 Ridiculus Av.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(62, 92, 'Imo', '(986) 447-7437', 'semper@tempor.ca', '1353 Tellus Street', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(63, 52, 'Rivers', '(438) 484-6926', 'arcu.et.pede@commodohendrerit.co.uk', 'Ap #978-6307 Dui Street', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(64, 74, 'Wie', '(498) 838-1468', 'Aenean@Vivamusnibh.edu', 'P.O. Box 933, 9805 Quis, Avenue', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(65, 26, 'Connecticut', '(825) 112-3856', 'nunc.sit@etrutrum.co.uk', 'P.O. Box 843, 7528 Vel, Avenue', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(66, 82, 'NA', '(578) 902-9130', 'ipsum.Curabitur@nequepellentesque.com', 'P.O. Box 638, 8378 Semper Av.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(67, 18, 'KP', '(420) 392-4284', 'massa@Nuncmauris.com', '624-3009 In Rd.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(68, 51, 'San Jose', '(X25) X32-0747', 'leo@Mauris.org', '251-6020 Ante St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(69, 69, 'Maranhao', '(902) 392-7816', 'diam@Integer.com', 'P.O. Box 445, 2565 Urna. St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:55:39'),
(70, 26, 'Kah', '(592) 425-9937', 'vulputate.nisi.sem@necmollisvitae.org', '1967 Nulla St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(71, 13, 'NSW', '(489) 569-9312', 'ipsum.ac@pellentesque.ca', 'P.O. Box 882, 928 Vel, St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(72, 67, 'NI', '(901) 117-6539', 'Ut@Etiamimperdietdictum.net', '768-2503 Sodales Av.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(73, 33, 'LA', '(171) 622-6796', 'cursus@Donectempuslorem.org', '9129 Lacinia. Av.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(74, 89, 'W', '(448) 546-4890', 'non@molestie.net', '527-8517 Eleifend, Road', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(75, 23, 'sdurfa', '(992) 617-2652', 'adipiscing.lacus@sapien.net', '9482 Vel Av.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:55:44'),
(76, 84, 'Vienna', '(151) 335-0235', 'ornare.facilisis.eget@Proinvel.edu', 'P.O. Box 969, 3676 In St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(77, 47, 'IV', '(714) 630-6096', 'Cras.dictum@venenatislacusEtiam.org', '7483 Proin Rd.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(78, 49, 'Wie', '(485) 610-7065', 'pede@nonfeugiat.co.uk', 'P.O. Box 436, 6267 Nec Street', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(79, 96, 'Vienna', '(676) 905-1585', 'blandit@semmolestiesodales.org', '3815 Eu Rd.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(80, 29, 'PR', '(272) 909-9409', 'varius.et.euismod@ut.co.uk', 'P.O. Box 699, 806 Sit St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(81, 16, 'UP', '(196) 631-6628', 'dictum@euismodurna.com', 'P.O. Box 187, 8540 Pede. St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(82, 52, 'Ontario', '(653) 758-1816', 'dui.lectus.rutrum@In.co.uk', '668-9187 A, St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(83, 44, 'BA', '(408) 632-8499', 'lorem@montesnascetur.edu', 'P.O. Box 326, 1726 Nunc Av.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(84, 28, 'RM', '(126) 965-3706', 'mattis.Cras@Vivamusnon.edu', '6264 Fringilla Road', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(85, 66, 'Gl', '(357) 115-3918', 'Donec.est@sit.com', '3859 Vitae St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(86, 35, 'Saskatchewan', '(411) 189-9139', 'at@orciDonecnibh.edu', 'Ap #470-4052 Rutrum Avenue', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(87, 65, 'South Island', '(689) 490-4156', 'ut@Quisquefringilla.edu', 'Ap #288-3537 Ultricies Rd.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(88, 22, 'Wie', '(471) 798-8930', 'magna.Praesent@Integer.co.uk', '7164 Pede. Av.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(89, 52, 'PR', '(738) 563-3913', 'lorem.Donec@cursusin.net', '7427 Sodales. Ave', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(90, 71, 'Pays de la Loire', '(786) 390-5700', 'natoque.penatibus@lobortis.net', '922-5423 Est Av.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(91, 35, 'North Island', '(229) 712-4473', 'euismod.enim.Etiam@at.edu', '1784 Consectetuer Road', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(92, 83, 'Vienna', '(629) 763-4941', 'nulla.vulputate.dui@enim.org', '930-327 Dictum Ave', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(93, 35, 'ON', '(142) 256-0442', 'nec.tempus.scelerisque@pede.net', 'Ap #659-1544 Velit Rd.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(94, 69, 'Maopolskie', '(282) 387-4838', 'nunc@semmollisdui.com', 'Ap #488-7594 Facilisis Street', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:56:44'),
(95, 16, 'BC', '(673) 775-1630', 'nec@Nunclaoreetlectus.com', 'Ap #590-4783 Tristique St.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(96, 60, 'C', '(422) 476-5245', 'tempus.risus@sem.org', 'Ap #570-491 Morbi Road', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(97, 97, 'Waals-Brabant', '(742) 124-9871', 'et.nunc.Quisque@atlacusQuisque.net', '6555 Ante Street', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(98, 78, 'Louisiana', '(511) 528-7839', 'ut@ultricesiaculis.org', '468-8860 Nec Avenue', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(99, 34, 'Wyoming', '(418) 780-8913', 'luctus.felis@utmolestiein.com', '400-9180 Nec Avenue', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(100, 88, 'KP', '(358) 981-8889', 'sit@Integertincidunt.ca', 'Ap #662-558 Urna, Av.', 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:54:57'),
(101, 21, 'Twinkal', '9912305689', 'branch@gmail.com', 'Viramgam', 3, 1, 1, 1, 1, 1, '2017-10-23 12:14:06', '2017-10-23 15:45:15'),
(102, 21, 'Twinkal', '9912305689', 'branchhhh@gmail.com', 'Viramgam', 3, 1, 1, 1, 1, 1, '2017-10-23 12:16:27', '2017-10-23 15:47:07'),
(103, 113, 'panjagutta', '9030509356', 'msallu2@gmail.com', 'nnxcjnjdcjjsdj', 1, 1, 1, 1, 1, 0, '2018-08-12 07:39:14', '2018-08-12 07:39:14'),
(104, 113, 'panjagutta', '9030509356', 'msallu2@gmail.com', 'nnxcjnjdcjjsdj', 1, 1, 1, 1, 1, 0, '2018-08-12 08:42:10', '2018-08-12 08:42:10'),
(105, 113, 'Koti', '9030569356', 'salavuddin.grepthor@gmail.com', 'Panjagutta', 1, 1, 1, 1, 1, 0, '2018-08-12 12:53:56', '2018-08-12 12:53:56'),
(106, 113, 'Test Branch', '1234567890', 'test@test.com', 'Test Address', 1, 1, 1, 1, 1, 0, '2018-08-14 02:24:37', '2018-08-14 02:24:37');

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
(1, 'Appointment', 'General Appointment', 'general', 450, 1, 1, '2017-06-02 02:17:34', '2017-10-23 17:02:18'),
(2, 'Test', 'Test Desck', 'Test', 100, 1, 1, '2017-06-11 10:31:30', '2017-06-13 16:32:17'),
(3, 'Helo', 'asd', 'No ida', 0, 3, 0, '2017-06-13 11:02:03', '2017-06-13 16:32:03'),
(4, 'LMS_BR2_Gen', 'Gen Charges', 'GEN CHG', 400, 2, 0, '2017-06-16 13:48:58', '2017-06-16 19:18:58'),
(6, 'R9Y7', 'tempus eu,', 'Personal Visit', 697, 85, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(7, 'W1W3', 'dolor, tempus non, lacinia at, iaculis quis, pede. Praesent eu', 'Appoitment', 364, 17, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(8, 'X8R5', 'Quisque fringilla euismod enim. Etiam gravida molestie arcu. Sed', 'Dental', 202, 52, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(9, 'Z3U5', 'Proin eget odio.', 'Appoitment', 75, 3, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(10, 'G8D4', 'nostra, per inceptos hymenaeos. Mauris ut quam', 'Personal Visit', 831, 27, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(11, 'L2H2', 'convallis in, cursus et, eros.', 'Appoitment', 381, 97, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(12, 'P0L2', 'sed dolor. Fusce mi lorem,', 'Dental', 619, 44, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(13, 'I5E3', 'fringilla est. Mauris eu turpis.', 'Appoitment', 848, 95, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(14, 'O7K2', 'amet risus. Donec egestas. Aliquam nec enim. Nunc', 'Appoitment', 198, 31, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(15, 'G7S0', 'lacus pede', 'Personal Visit', 456, 15, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(16, 'B4K6', 'ultrices sit amet, risus.', 'Appoitment', 666, 69, 1, '0000-00-00 00:00:00', '2017-10-23 17:09:44'),
(17, 'H1X9', 'nisi a', 'Dental', 624, 64, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(18, 'Q8W6', 'tortor. Integer aliquam adipiscing lacus.', 'Appoitment', 286, 89, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(19, 'P2R8', 'turpis egestas. Aliquam fringilla cursus purus.', 'Personal Visit', 523, 96, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(20, 'K3T1', 'purus mauris a nunc. In at', 'Appoitment', 210, 84, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(21, 'Q1S7', 'libero. Integer in magna. Phasellus dolor elit, pellentesque a, facilisis', 'Dental', 504, 86, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(22, 'Z1U2', 'dictum ultricies ligula. Nullam enim.', 'Dental', 439, 93, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(23, 'D1I4', 'sed dui. Fusce', 'Personal Visit', 368, 17, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(24, 'X5Q7', 'metus. Aliquam erat volutpat. Nulla facilisis.', 'Dental', 833, 59, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(25, 'I1K4', 'Sed auctor odio a purus. Duis elementum, dui', 'Personal Visit', 679, 95, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(26, 'E3F1', 'elit elit fermentum risus, at fringilla purus mauris a', 'Dental', 201, 26, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(27, 'K5S0', 'sit amet metus. Aliquam erat volutpat.', 'Appoitment', 513, 6, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(28, 'L5N4', 'Duis gravida. Praesent eu nulla at', 'Dental', 162, 61, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(29, 'H1T0', 'ornare sagittis felis. Donec tempor,', 'Appoitment', 116, 57, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(30, 'G4C4', 'mi. Aliquam', 'Appoitment', 994, 49, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(31, 'I8P1', 'Maecenas iaculis aliquet diam. Sed diam lorem,', 'Appoitment', 692, 37, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(32, 'N1F2', 'ullamcorper, velit in aliquet lobortis, nisi nibh lacinia orci, consectetuer', 'Dental', 392, 99, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(33, 'S6X9', 'orci. Phasellus dapibus quam', 'Personal Visit', 24, 76, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(34, 'J2V0', 'ante. Maecenas mi felis, adipiscing fringilla, porttitor vulputate, posuere', 'Dental', 274, 24, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(35, 'R6C6', 'Etiam bibendum fermentum metus.', 'Dental', 655, 8, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(36, 'Y7D8', 'luctus et ultrices', 'Appoitment', 358, 65, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(37, 'T6J8', 'neque pellentesque massa lobortis ultrices. Vivamus', 'Personal Visit', 955, 74, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(38, 'K6R6', 'In mi pede, nonummy ut, molestie in, tempus eu, ligula.', 'Dental', 467, 38, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(39, 'T7P9', 'nec tempus mauris erat eget ipsum. Suspendisse sagittis. Nullam vitae', 'Appoitment', 573, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(40, 'O6U8', 'lorem, eget', 'Dental', 87, 10, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(41, 'Z1W0', 'diam. Duis mi enim,', 'Dental', 170, 95, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(42, 'R9N4', 'sed dui.', 'Personal Visit', 878, 62, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(43, 'A8G1', 'et', 'Appoitment', 699, 94, 1, '0000-00-00 00:00:00', '2017-10-23 17:05:15'),
(44, 'J7Z0', 'sodales. Mauris blandit', 'Appoitment', 531, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(45, 'X3C7', 'Proin vel arcu eu odio tristique pharetra. Quisque ac', 'Personal Visit', 440, 47, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(46, 'T3P7', 'est, vitae sodales', 'Appoitment', 769, 69, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(47, 'V3F7', 'elementum purus, accumsan', 'Personal Visit', 35, 80, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(48, 'V4B3', 'gravida nunc sed pede. Cum sociis natoque penatibus', 'Personal Visit', 84, 41, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(49, 'Q6A8', 'eget, ipsum. Donec sollicitudin adipiscing ligula. Aenean gravida nunc', 'Appoitment', 531, 83, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(50, 'P4C7', 'convallis, ante lectus', 'Appoitment', 681, 48, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(51, 'D0N5', 'ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam auctor, velit', 'Dental', 872, 59, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(52, 'P6M5', 'et malesuada fames ac turpis', 'Appoitment', 207, 60, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(53, 'B9L0', 'dis parturient montes, nascetur ridiculus mus. Donec', 'Dental', 438, 87, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(54, 'B3X5', 'feugiat non, lobortis quis,', 'Appoitment', 506, 99, 1, '0000-00-00 00:00:00', '2017-10-23 17:05:50'),
(55, 'I1N3', 'lectus. Cum sociis natoque penatibus et magnis', 'Personal Visit', 333, 9, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(56, 'E5P6', 'Duis at lacus. Quisque', 'Appoitment', 175, 31, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(57, 'P9L4', 'Morbi metus.', 'Appoitment', 889, 45, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(58, 'S8V7', 'ipsum. Donec sollicitudin adipiscing ligula. Aenean gravida nunc sed pede.', 'Appoitment', 777, 8, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(59, 'E6X2', 'sodales nisi magna', 'Personal Visit', 569, 98, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(60, 'H9R8', 'lectus quis massa. Mauris', 'Personal Visit', 181, 59, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(61, 'N5X8', 'turpis. In condimentum. Donec at', 'Personal Visit', 972, 88, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(62, 'N0P5', 'rutrum', 'Appoitment', 14, 41, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(63, 'E3P1', 'vulputate', 'Personal Visit', 795, 2, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(64, 'W5N9', 'ultricies dignissim lacus. Aliquam rutrum', 'Dental', 27, 67, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(65, 'N6H2', 'quis diam.', 'Dental', 770, 47, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(66, 'L2M9', 'id, blandit at, nisi. Cum sociis natoque penatibus et', 'Personal Visit', 486, 74, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(67, 'H8J1', 'lobortis augue scelerisque mollis. Phasellus libero', 'Appoitment', 509, 15, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(68, 'W0W7', 'egestas hendrerit neque. In', 'Dental', 393, 14, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(69, 'X2T5', 'nulla. Integer urna.', 'Personal Visit', 863, 98, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(70, 'S1D7', 'Proin ultrices. Duis volutpat', 'Dental', 102, 31, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(71, 'H8P4', 'nibh.', 'Appoitment', 701, 69, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(72, 'J0M3', 'in felis. Nulla tempor augue ac', 'Dental', 172, 65, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(73, 'T3H6', 'feugiat non, lobortis quis, pede. Suspendisse dui. Fusce diam', 'Dental', 24, 58, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(74, 'B1O1', 'pharetra sed, hendrerit a, arcu. Sed', 'Personal Visit', 469, 2, 1, '0000-00-00 00:00:00', '2017-10-23 17:05:50'),
(75, 'C9E7', 'vulputate', 'Dental', 949, 48, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(76, 'S5L1', 'consectetuer adipiscing elit. Aliquam auctor, velit eget laoreet posuere, enim', 'Dental', 70, 98, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(77, 'P3N7', 'ornare tortor at risus. Nunc ac sem ut', 'Dental', 548, 40, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(78, 'T5C6', 'consectetuer, cursus et, magna. Praesent interdum ligula eu enim.', 'Personal Visit', 692, 64, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(79, 'D5T8', 'amet metus. Aliquam', 'Personal Visit', 269, 93, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(80, 'O6A0', 'consectetuer adipiscing', 'Dental', 870, 38, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(81, 'I6E9', 'magna tellus faucibus leo,', 'Appoitment', 355, 57, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(82, 'U9T0', 'nunc sit amet metus. Aliquam erat volutpat.', 'Dental', 430, 82, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(83, 'S7Q6', 'vestibulum. Mauris magna. Duis dignissim tempor arcu. Vestibulum', 'Appoitment', 804, 94, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(84, 'I8V4', 'ipsum non arcu. Vivamus sit amet risus. Donec egestas. Aliquam', 'Personal Visit', 329, 76, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(85, 'Z1W4', 'ac turpis egestas. Aliquam fringilla cursus purus. Nullam scelerisque', 'Dental', 904, 29, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(86, 'I6D0', 'Cras dolor', 'Dental', 70, 52, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(87, 'A0D4', 'cursus luctus, ipsum leo elementum', 'Dental', 671, 92, 1, '0000-00-00 00:00:00', '2017-10-23 17:07:13'),
(88, 'Q0Z0', 'eu tellus eu augue porttitor interdum. Sed auctor', 'Personal Visit', 166, 61, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(89, 'I3Y9', 'vitae aliquam eros turpis', 'Personal Visit', 303, 44, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(90, 'I8F5', 'consectetuer adipiscing elit.', 'Appoitment', 58, 22, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(91, 'W4E0', 'ullamcorper eu, euismod ac, fermentum vel, mauris. Integer sem', 'Appoitment', 867, 15, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(92, 'W5X6', 'eu elit. Nulla facilisi. Sed neque. Sed eget lacus.', 'Personal Visit', 720, 58, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(93, 'T3R4', 'tincidunt, nunc', 'Dental', 56, 50, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(94, 'L2Y5', 'dui, in sodales elit', 'Appoitment', 831, 99, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(95, 'Z3M2', 'lectus pede, ultrices a, auctor', 'Appoitment', 821, 11, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(96, 'R0R6', 'nec,', 'Appoitment', 508, 39, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(97, 'U8B3', 'tincidunt. Donec vitae erat vel pede blandit congue.', 'Dental', 385, 25, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(98, 'X2S6', 'fames ac turpis egestas. Aliquam fringilla', 'Appoitment', 851, 2, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(99, 'W2H9', 'sagittis. Nullam vitae diam.', 'Dental', 238, 49, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(100, 'E9O7', 'sagittis', 'Appoitment', 607, 39, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(101, 'E2B5', 'molestie orci tincidunt adipiscing. Mauris molestie', 'Personal Visit', 357, 26, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(102, 'V9T4', 'lorem semper auctor. Mauris', 'Personal Visit', 746, 27, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(103, 'O2F3', 'augue eu tellus. Phasellus', 'Dental', 825, 37, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(104, 'V4A4', 'enim. Etiam gravida molestie arcu. Sed eu', 'Personal Visit', 122, 66, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(105, 'D0E3', 'augue eu tellus. Phasellus elit pede, malesuada vel,', 'Personal Visit', 387, 65, 0, '0000-00-00 00:00:00', '2017-06-20 19:18:01'),
(106, 'Normal', 'Description', 'Normal', 100, 1, 1, '2017-10-23 13:30:47', '2017-10-23 17:01:31');

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
(1, 1, 'Dept-1', 1, 0, '2017-05-26 15:38:14', '2017-05-26 10:08:14'),
(2, 2, 'Dept-2 OF Br2', 1, 0, '2017-06-09 11:34:43', '2017-06-09 06:04:43'),
(3, 1, 'Dept-2', 1, 0, '2017-06-11 14:07:43', '2017-06-11 08:37:43'),
(4, 5, 'New Cancer Department.', 1, 0, '2017-06-13 16:28:11', '2017-06-13 10:58:11'),
(5, 59, 'Villa Cortese', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(6, 30, 'Fulda', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(7, 43, 'Moradabad', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(8, 69, 'Empedrado', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(9, 41, 'Vergemoli', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(10, 13, 'Taby', 1, 0, '2017-06-20 19:01:25', '0000-00-00 00:00:00'),
(11, 74, 'Dollard-des-Ormeaux', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(12, 18, 'Lauro de Freitas', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(13, 64, 'Saint-Nicolas', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(14, 27, 'Cap-de-la-Madeleine', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(15, 65, 'Fallais', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(16, 60, 'Panchia', 1, 0, '2017-06-20 19:01:30', '0000-00-00 00:00:00'),
(17, 57, 'Hanret', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(18, 55, 'Port Harcourt', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(19, 20, 'Ahmadpur East', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(20, 2, 'Lasnigo', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(21, 80, 'Rothes', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(22, 8, 'Gibsons', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(23, 48, 'Salles', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(24, 30, 'Albiano', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(25, 49, 'Aligarh', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(26, 47, 'Morkhoven', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(27, 31, 'Kester', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(28, 48, 'Kilmarnock', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(29, 54, 'Chepstow', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(30, 3, 'Nodebais', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(31, 30, 'Omaha', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(32, 53, 'Little Rock', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(33, 41, 'Mahbubnagar', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(34, 80, 'Fernie', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(35, 78, 'Gattatico', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(36, 62, 'Pontarlier', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(37, 2, 'Itterbeek', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(38, 42, 'Goksun', 1, 0, '2017-06-20 19:04:25', '0000-00-00 00:00:00'),
(39, 41, 'Laja', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(40, 94, 'Paulista', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(41, 60, 'Salamanca', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(42, 79, 'Sambreville', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(43, 98, 'Timkur', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(44, 89, 'Siracusa', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(45, 68, 'Pontboset', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(46, 4, 'Avila', 1, 0, '2017-06-20 19:03:46', '0000-00-00 00:00:00'),
(47, 65, 'Ilheus', 1, 0, '2017-06-20 19:01:41', '0000-00-00 00:00:00'),
(48, 75, 'Sankt Ingbert', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(49, 43, 'Colico', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(50, 53, 'Tumba', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(51, 85, 'Thon', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(52, 64, 'Columbia', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(53, 15, 'Biaa Podlaska', 1, 0, '2017-06-20 19:01:47', '0000-00-00 00:00:00'),
(54, 47, 'Secunderabad', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(55, 77, 'Borsbeek', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(56, 35, 'Sant\'Angelo in Pontano', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(57, 3, 'Montebelluna', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(58, 94, 'Caledon', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(59, 14, 'Corroy ', 1, 0, '2017-06-20 19:01:55', '0000-00-00 00:00:00'),
(60, 83, 'Jupille-sur-Meuse', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(61, 98, 'Lafayette', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(62, 74, 'Emblem', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(63, 85, 'Milazzo', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(64, 67, 'Provo', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(65, 44, 'Niteroi', 1, 0, '2017-06-20 19:02:00', '0000-00-00 00:00:00'),
(66, 24, 'Calbuco', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(67, 17, 'Iquique', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(68, 36, 'Campbellton', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(69, 73, 'Cour-sur-Heure', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(70, 82, 'Kobbegem', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(71, 21, 'Albacete', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(72, 22, 'Langholm', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(73, 73, 'Zaanstad', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(74, 60, 'Levis', 1, 0, '2017-06-20 19:02:14', '0000-00-00 00:00:00'),
(75, 95, 'Escaillre', 1, 0, '2017-06-20 19:02:11', '0000-00-00 00:00:00'),
(76, 13, 'Tione di Trento', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(77, 63, 'Luckenwalde', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(78, 79, 'Paisley', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(79, 53, 'Benalla', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(80, 48, 'Baiso', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(81, 10, 'Cawdor', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(82, 9, 'Mesoraca', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(83, 13, 'Springfield', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(84, 31, 'Curico', 1, 0, '2017-06-20 19:02:23', '0000-00-00 00:00:00'),
(85, 67, 'Cheyenne', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(86, 93, 'Gibsons', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(87, 36, 'Limal', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(88, 45, 'Serralunga Alba', 1, 0, '2017-06-20 19:02:29', '0000-00-00 00:00:00'),
(89, 23, 'Evansville', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(90, 18, 'Prestatyn', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(91, 98, 'Pilibhit', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(92, 11, 'Rollegem', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(93, 34, 'Whitby', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(94, 61, 'Aurora', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(95, 50, 'Banda', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(96, 81, 'Sale', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(97, 22, 'Renfrew', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(98, 76, 'Moffat', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(99, 92, 'Queilen', 1, 0, '2017-06-20 19:05:05', '0000-00-00 00:00:00'),
(100, 56, 'Neuruppin', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(101, 70, 'Floriffoux', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(102, 48, 'Rhemes-Notre-Dame', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(103, 34, 'Oudergem', 1, 0, '2017-06-20 19:01:08', '0000-00-00 00:00:00'),
(104, 85, 'Tirua', 1, 0, '2017-06-20 19:02:39', '0000-00-00 00:00:00'),
(105, 57, 'twinkallll', 1, 1, '2017-10-23 17:22:03', '2017-10-23 13:51:19'),
(106, 1, 'a', 1, 0, '2018-06-07 18:34:55', '2018-06-07 18:34:55'),
(107, 105, 'DP1', 1, 0, '2018-08-14 02:01:00', '2018-08-14 02:01:00');

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
(2, 12, 1, 12, 30, 'QUone', '5years', 'Sp1', 1, 0, '2017-05-28 05:22:21', '2018-08-03 03:58:38', 'Every day 9am to 4.30 PM.\r\nTeusday and thurs day 10 AM to 12 PM\r\nAug 24 6PM to 9PM\r\n'),
(3, 22, -1, 5, 30, '', '', '', 0, 0, '2017-06-07 06:11:53', '2017-06-07 11:41:53', NULL),
(4, 23, 1, 5, 30, '', '', '', 1, 0, '2017-06-09 06:08:37', '2017-07-03 09:46:45', NULL),
(5, 24, -1, 5, 30, '', '', '', 0, 0, '2017-06-09 06:09:03', '2017-06-09 11:39:03', NULL),
(6, 29, -1, 5, 30, '', '', '', 0, 0, '2017-06-13 10:44:13', '2017-06-13 16:14:13', NULL),
(7, 33, -1, 5, 30, '', '', '', 0, 0, '2017-06-15 05:43:57', '2017-06-15 11:13:57', NULL),
(8, 37, 1, 5, 30, '', '', '', 0, 0, '2017-06-15 08:51:13', '2017-06-15 14:21:13', NULL),
(9, 43, 82, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(10, 107, 77, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(11, 43, 51, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(12, 100, 38, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(13, 84, 83, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(14, 33, 72, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(15, 99, 53, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(16, 37, 33, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(17, 61, 81, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(18, 72, 80, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(19, 22, 43, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(20, 99, 89, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(21, 21, 64, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(22, 139, 88, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(23, 72, 31, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(24, 107, 27, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(25, 105, 73, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(26, 23, 28, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(27, 104, 60, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(28, 22, 17, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(29, 99, 53, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(30, 46, 87, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(31, 46, 74, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(32, 106, 33, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(33, 106, 22, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(34, 46, 28, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(35, 100, 84, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(36, 101, 9, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(37, 12, 12, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(38, 69, 52, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(39, 99, 60, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(40, 33, 76, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(41, 55, 8, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(42, 100, 35, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(43, 29, 14, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(44, 61, 23, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(45, 51, 55, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(46, 72, 80, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(47, 107, 27, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(48, 46, 82, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(49, 71, 90, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(50, 99, 31, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(51, 60, 77, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(52, 105, 64, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(53, 69, 59, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(54, 107, 42, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(55, 102, 28, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(56, 71, 25, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(57, 37, 69, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(58, 71, 2, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(59, 104, 26, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(60, 102, 69, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(61, 69, 62, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(62, 22, 23, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(63, 72, 47, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(64, 141, 43, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(65, 106, 25, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(66, 131, 36, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(67, 106, 2, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(68, 84, 51, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(69, 61, 67, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(70, 29, 52, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(71, 131, 83, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(72, 102, 63, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(73, 104, 42, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(74, 51, 31, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(75, 102, 32, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(76, 101, 64, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(77, 105, 82, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(78, 131, 28, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(79, 69, 41, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(80, 131, 23, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(81, 69, 84, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(82, 106, 62, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(83, 21, 56, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(84, 24, 81, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(85, 33, 90, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(86, 107, 56, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(87, 101, 70, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(88, 71, 56, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(89, 90, 17, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(90, 107, 71, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(91, 106, 27, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(92, 21, 29, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(93, 23, 88, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(94, 37, 25, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(95, 29, 83, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(96, 131, 66, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(97, 99, 28, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(98, 106, 66, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(99, 141, 75, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(100, 90, 85, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(101, 69, 36, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(102, 131, 66, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(103, 105, 71, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(104, 107, 81, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(105, 101, 37, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(106, 61, 17, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(107, 23, 87, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(108, 102, 18, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:34:38', NULL),
(109, 142, -1, 5, 30, '', '', '', 0, 0, '2017-06-28 08:38:21', '2017-06-28 14:08:21', NULL),
(116, 147, 1, 5, 30, '', '', '', 1, 0, '2017-09-12 06:51:52', '2017-09-12 12:22:01', NULL),
(117, 148, 1, 5, 30, '', '', '', 1, 0, '2017-09-12 07:05:44', '2017-09-12 12:37:27', NULL),
(118, 154, 1, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-10-07 15:56:05', NULL),
(119, 154, 1, 5, 30, '', '', '', 0, 0, '0000-00-00 00:00:00', '2017-10-07 16:04:57', NULL),
(120, 155, 3, 5, 30, 'M.D', '1 year', 'Normal', 0, 0, '2017-10-24 14:27:38', '2017-10-24 18:48:07', 'available from Monday to Friday'),
(121, 156, 1, 5, 30, '', '', '', 1, 0, '2018-06-05 16:10:58', '2018-06-05 16:10:58', NULL),
(122, 164, 1, 5, 30, '', '', '', 1, 0, '2018-06-12 15:26:24', '2018-06-12 15:26:24', NULL),
(123, 171, 1, 5, 30, '', '', '', 1, 0, '2018-07-01 14:43:48', '2018-07-01 14:43:48', NULL),
(124, 178, 1, 5, 30, 'mddm', '', 'neurophestion', 1, 0, '2018-07-11 16:18:46', '2018-07-11 16:18:46', NULL),
(125, 180, 1, 5, 30, 'mddm', '', 'neurophestion', 1, 0, '2018-07-12 15:53:35', '2018-07-13 03:50:17', NULL),
(126, 185, 1, 5, 30, 'dkmkdm', 'jsdnk', 'mjasdk', 1, 0, '2018-07-15 07:32:30', '2018-07-15 07:32:30', NULL),
(127, 186, 3, 5, 30, 'gajadathaba', 'anta seen ledu', 'DMO', 1, 0, '2018-07-15 08:08:13', '2018-07-15 08:08:13', NULL),
(128, 193, 1, 5, 30, 'BE', '4 years', '', 1, 0, '2018-07-25 15:58:50', '2018-07-25 15:58:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hms_doctors_specialization`
--

CREATE TABLE `hms_doctors_specialization` (
  `DoctorSpecializationID` int(11) NOT NULL,
  `SpecializationFKID` int(10) DEFAULT NULL,
  `doc_id` int(10) DEFAULT NULL,
  `CreatedBy` int(10) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(10) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `Status` tinyint(1) UNSIGNED ZEROFILL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hms_doctors_specialization`
--

INSERT INTO `hms_doctors_specialization` (`DoctorSpecializationID`, `SpecializationFKID`, `doc_id`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`, `Status`) VALUES
(5, 2, 128, 3, '2018-07-25 15:59:35', NULL, NULL, 1),
(6, 3, 128, 3, '2018-07-25 15:59:35', NULL, NULL, 1),
(12, 2, 2, 3, '2018-08-03 02:26:50', NULL, NULL, 1),
(13, 4, 2, 3, '2018-08-03 02:26:50', NULL, NULL, 1),
(14, 1, 127, 1, '2018-08-14 02:32:55', NULL, NULL, 1);

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
(1, 26, 'OPVE', 5, 5, 70, 90, 120, '90', 1, '', '', '', 0, '0000-00-00 00:00:00', '2017-07-09 00:43:12'),
(2, 0, '', 0, 0, 0, 0, 0, '', 0, '', '', '', 0, '0000-00-00 00:00:00', '2017-07-08 09:56:54'),
(3, 12, 'OPVE', 5, 4, 70, 90, 120, '', 0, '', '', '', 0, '0000-00-00 00:00:00', '2017-07-08 23:58:33'),
(4, 177, 'OPVE', 5, 7, 75, 0, 0, '', 1, '', '', '', 0, '0000-00-00 00:00:00', '2018-07-06 16:45:48');

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
(11, 'A Felis Associates', '6610 Amet Av.', '', NULL, '', '(597) 166-7804', 'et@lacusAliquam.com', 'LIC01', 1, 'asdf', 'Beawar', 'RJ', 'II', 'Nauru', 'Stephen Livingston', '(579) 917-6998', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(12, 'Massa Integer Ltd', 'P.O. Box 583, 3969 Sodales St.', '', NULL, '', '(X26) X79-4487', 'conubia.nostra@Donecnibhenim.org', 'LIC01', 0, '', 'Cañas', 'Guanacaste', 'SI', 'Sri Lanka', 'Xavier Y. Malone', '(X26) X61-4452', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(13, 'Ligula LLC', 'Ap #181-7041 Dictum. Street', '', NULL, '', '(212) 738-4611', 'augue.malesuada.malesuada@eueratsemper.ca', 'LIC01', 0, '', 'Boo', 'Stockholms län', 'NI', 'Malta', 'Quail Thomas', '(837) 512-0027', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(14, 'Cum Sociis Limited', '8902 Molestie St.', '', NULL, '', '(726) 534-5497', 'eu.tempor.erat@lacinia.edu', 'LIC01', 0, '', 'Vienna', 'Vienna', 'New South Wales', 'Iran', 'Nora M. Workman', '(262) 932-3790', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(15, 'Mollis Foundation', '9068 Scelerisque Road', '', NULL, '', '(765) 648-6105', 'orci@faucibusut.co.uk', 'LIC01', 0, '', 'Nantes', 'PA', 'New South Wales', 'Colombia', 'Fritz A. Alexander', '(355) 150-7256', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(16, 'Vitae Orci Phasellus Limited', '1565 Molestie Road', '', NULL, '', '(554) 269-4689', 'libero.est@scelerisque.edu', 'LIC01', 0, '', 'Palayankottai', 'Tamil Nadu', 'South Island', 'Malaysia', 'Bree Copeland', '(533) 385-9114', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(17, 'Nisl Foundation', '141-3896 Ullamcorper St.', '', NULL, '', '(868) 831-4586', 'aliquet.diam@pedeblandit.co.uk', 'LIC01', 0, '', 'Vänersborg', 'Västra Götalands län', 'Punjab', 'Senegal', 'Keegan Bauer', '(567) 215-2235', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(18, 'Et Industries', 'Ap #164-2799 Eleifend, St.', '', NULL, '', '(773) 106-4488', 'placerat@quamquisdiam.edu', 'LIC01', 0, '', 'Beypazar?', 'Ankara', 'BC', 'South Africa', 'Elliott M. Barron', '(475) 405-6454', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(19, 'Purus LLC', '9994 Non Av.', '', NULL, '', '(998) 502-9560', 'habitant.morbi@nonbibendum.com', 'LIC01', 0, '', 'Missoula', 'Montana', 'Noord Brabant', 'Egypt', 'Kirestin Prince', '(952) 786-7134', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(20, 'Mattis Corporation', '581-2463 Interdum. Ave', '', NULL, '', '(999) 382-7844', 'enim.consequat@luctusfelis.org', 'LIC01', 0, '', 'Bollnäs', 'Gävleborgs län', 'Metropolitana de Santiago', 'Burundi', 'Maxine Gross', '(732) 228-5459', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(21, 'Purus Corporation', '395-9281 Vivamus Av.', '', 'http://localhost/GridFramework/Projects/Hospital_Managment_System/public/images/hl/1506776825_21.png', '', '(377) 600-6286', 'vulputate.nisi.sem@mi.edu', 'LIC01', 1, 'purus', '1', '1', '1', '1', 'Oren D. Walters', '(702) 370-6948', 1, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(22, 'Mattis Cras LLP', 'Ap #836-9142 Etiam Av.', '', NULL, '', '(743) 386-9026', 'quis.diam@semper.edu', 'LIC01', 0, '', 'Panguipulli', 'XIV', 'Puglia', 'Puerto Rico', 'Abraham Stevenson', '(670) 111-8270', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(23, 'Euismod Incorporated', '2384 Pellentesque St.', '', NULL, '', '(603) 299-0257', 'tortor.at.risus@malesuadaid.edu', 'LIC01', 0, '', 'Sydney', 'NSW', 'SL', 'Curaçao', 'Stephanie A. Noble', '(680) 562-6692', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(24, 'Non Dui Nec Corporation', '811 Donec Rd.', '', NULL, '', '(737) 708-4277', 'eu.metus.In@Phasellusliberomauris.net', 'LIC01', 0, '', 'Kearny', 'Ontario', 'Comunitat Valenciana', 'Argentina', 'Yuli V. Coffey', '(647) 984-3807', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(25, 'A Facilisis Non LLC', 'Ap #299-2727 Arcu. Rd.', '', NULL, '', '(832) 775-5599', 'Lorem@semconsequatnec.org', 'LIC01', 0, '', 'Houdemont', 'LX', 'Wie', 'Thailand', 'Cora Dale', '(961) 402-1894', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(26, 'Metus Sit Corporation', '528 At, Ave', '', NULL, '', '(X24) X99-7825', 'nec.urna.suscipit@massaIntegervitae.ca', 'LIC01', 0, '', 'Quesada', 'Alajuela', 'H', 'Bahamas', 'Cherokee Kirk', '(X24) X63-1274', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(27, 'Fames Company', '438-2949 Curabitur St.', '', NULL, '', '(498) 679-1686', 'lorem@Integer.com', 'LIC01', 0, '', 'Bouwel', 'AN', 'Heredia', 'Iraq', 'Chester Mcconnell', '(733) 378-9828', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(28, 'Ligula Aenean Euismod Consulting', 'Ap #154-2990 Non Rd.', '', NULL, '', '(X25) X22-0951', 'enim@id.ca', 'LIC01', 0, '', 'Mercedes', 'Heredia', 'Ulster', 'Armenia', 'Rhiannon Pacheco', '(X25) X03-7282', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(29, 'Quisque Libero Ltd', 'Ap #198-2527 Aliquam Ave', '', NULL, '', '(604) 550-0542', 'et.lacinia.vitae@facilisisfacilisismagna.ca', 'LIC01', 0, '', 'Pirna', 'SN', 'NI', 'Guinea', 'Mira O. Yang', '(959) 833-1843', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(30, 'Quis Accumsan Associates', 'Ap #184-8788 A, Avenue', '', NULL, '', '(303) 148-6075', 'tincidunt.dui@Suspendisse.org', 'LIC01', 0, '', 'Cork', 'M', 'Koc', 'Jersey', 'Ralph M. Watts', '(440) 542-9176', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(31, 'Iaculis Quis Company', 'P.O. Box 416, 5695 Elit, St.', '', NULL, '', '(206) 206-7027', 'adipiscing.lobortis@sed.com', 'LIC01', 0, '', 'Valenciennes', 'Nord-Pas-de-Calais', 'Bremen', 'Mexico', 'Hanna P. Sharpe', '(266) 465-9330', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(32, 'Vulputate Consulting', '2516 In Rd.', '', NULL, '', '(154) 715-4530', 'In.mi@Maecenas.net', 'LIC01', 0, '', 'Mussy-la-Ville', 'LX', 'Vlaams-Brabant', 'Zimbabwe', 'Katell Marks', '(460) 340-7589', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(33, 'Vestibulum Ante Industries', 'Ap #116-1948 Sed, Avenue', '', NULL, '', '(885) 871-7591', 'volutpat@eleifendegestasSed.com', 'LIC01', 0, '', 'Katsina', 'KT', 'Puglia', 'South Georgia and The South Sandwich Islands', 'Lydia Gay', '(886) 338-2515', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(34, 'Facilisis Non Inc.', 'Ap #527-1180 Fermentum St.', '', NULL, '', '(790) 607-1596', 'Aliquam.vulputate@elitpretiumet.ca', 'LIC01', 0, '', 'Stonewall', 'Manitoba', 'Ist', 'Netherlands', 'Phillip Rogers', '(851) 548-4606', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(35, 'Lorem Ipsum Sodales LLP', 'P.O. Box 336, 2756 Auctor Rd.', '', NULL, '', '(286) 306-0994', 'sodales@dignissimMaecenasornare.co.uk', 'LIC01', 0, '', 'Huechuraba', 'RM', 'NSW', 'Spain', 'Igor Holland', '(573) 579-5530', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(36, 'Lectus Corporation', '5715 Magnis Road', '', NULL, '', '(979) 571-8097', 'Suspendisse.ac@infaucibusorci.com', 'LIC01', 0, '', 'Bijapur', 'KA', 'East Lothian', 'Sweden', 'Ashely N. Hawkins', '(273) 303-6840', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(37, 'Nunc LLC', 'P.O. Box 663, 3228 Velit. Ave', '', NULL, '', '(X25) X39-0747', 'ipsum.primis@Donecegestas.net', 'LIC01', 0, '', 'Cartago', 'Cartago', 'HH', 'Cook Islands', 'Ivana Bryant', '(X25) X90-6710', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(38, 'Ut LLP', '765-4614 Eget Ave', '', NULL, '', '(136) 986-0257', 'Cras@purusMaecenaslibero.ca', 'LIC01', 0, '', 'Casciana Terme', 'Toscana', 'Gävleborgs län', 'Kenya', 'Brenda V. Osborn', '(638) 236-6540', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(39, 'Nibh Phasellus Limited', 'Ap #715-8513 Aliquam Road', '', NULL, '', '(X25) X11-9943', 'quam.dignissim.pharetra@dis.net', 'LIC01', 0, '', 'Ulloa (Barrial)', 'Heredia', 'North Island', 'Congo, the Democratic Republic of the', 'Gregory Cook', '(X25) X12-5545', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(40, 'Magna Phasellus Industries', 'Ap #315-7633 Quis, Avenue', '', NULL, '', '(309) 575-2036', 'gravida@viverraDonectempus.ca', 'LIC01', 0, '', 'Vienna', 'Vienna', 'Lombardia', 'Argentina', 'Dylan Stokes', '(824) 724-3778', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(41, 'Laoreet Ipsum Curabitur Ltd', '3890 Et Ave', '', NULL, '', '(471) 735-9823', 'Nam.porttitor.scelerisque@dolordapibus.org', 'LIC01', 0, '', 'Belfast', 'U', 'Vienna', 'Honduras', 'Miriam Rich', '(121) 668-5854', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(42, 'Facilisis Lorem Tristique Institute', 'P.O. Box 113, 1728 Et Ave', '', NULL, '', '(426) 621-2553', 'justo.sit.amet@vulputateullamcorpermagna.com', 'LIC01', 0, '', 'Guildford', 'Surrey', 'São Paulo', 'Afghanistan', 'Hakeem X. Buckley', '(822) 290-2227', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(43, 'Erat Vitae Incorporated', '2001 Orci Ave', '', NULL, '', '(972) 851-4635', 'varius.Nam.porttitor@Cras.net', 'LIC01', 0, '', 'Pocatello', 'ID', 'Wie', 'Sri Lanka', 'Signe I. Mclean', '(207) 528-1320', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(44, 'Tincidunt Orci Ltd', 'P.O. Box 650, 7054 Vehicula Av.', '', NULL, '', '(605) 509-3639', 'mi.Duis@sitamet.co.uk', 'LIC01', 0, '', 'Albury', 'New South Wales', 'Caithness', 'South Africa', 'Josephine K. Berg', '(765) 126-1224', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(45, 'Et Magnis Incorporated', '428-8844 Quis Street', '', NULL, '', '(899) 395-1526', 'vulputate@montesnasceturridiculus.ca', 'LIC01', 0, '', 'Minitonas', 'MB', 'AK', 'Cambodia', 'Noel M. Cash', '(106) 660-6919', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(46, 'Non Nisi LLC', '585-6385 Neque Rd.', '', NULL, '', '(827) 606-3106', 'Fusce@elitfermentum.org', 'LIC01', 0, '', 'Vienna', 'Wie', 'San José', 'Ghana', 'Lyle V. Wheeler', '(664) 107-4754', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(47, 'Ornare Lectus Incorporated', 'P.O. Box 719, 9046 Quis Av.', '', NULL, '', '(493) 827-0827', 'ornare@nisl.ca', 'LIC01', 0, '', 'Fresno', 'California', 'Queensland', 'Norfolk Island', 'Jocelyn L. Sims', '(665) 506-7048', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(48, 'Nunc Foundation', '601-3673 Mi, Rd.', '', NULL, '', '(400) 312-7034', 'varius.orci.in@primis.com', 'LIC01', 0, '', 'Hulst', 'Zl', 'Mer', 'Fiji', 'Camden G. Underwood', '(179) 806-3823', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(49, 'Sagittis Corporation', '9458 Libero Av.', '', NULL, '', '(480) 221-2446', 'rhoncus.Donec@Donecelementum.co.uk', 'LIC01', 0, '', 'Cork', 'Munster', 'AB', 'Brunei', 'Kieran Y. Mosley', '(281) 542-7767', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(50, 'Risus Limited', '1877 Senectus St.', '', NULL, '', '(915) 417-7390', 'bibendum.fermentum.metus@laoreet.net', 'LIC01', 0, '', 'Estación Central', 'RM', 'LU', 'Belarus', 'Ingrid Daniel', '(498) 245-4614', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(51, 'Imperdiet Ullamcorper Duis PC', '559-3137 Morbi Avenue', '', NULL, '', '(456) 808-9188', 'in.consectetuer.ipsum@augueacipsum.co.uk', 'LIC01', 0, '', 'Logan City', 'QLD', 'IL', 'French Guiana', 'Deborah C. Dejesus', '(696) 955-8382', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(52, 'Cursus Ltd', '959-9596 Consequat St.', '', NULL, '', '(898) 663-9494', 'Curabitur.sed.tortor@justo.org', 'LIC01', 0, '', 'Southwell', 'NT', 'Indiana', 'Comoros', 'Ivan B. Baxter', '(426) 809-4587', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(53, 'Orci Ltd', 'P.O. Box 847, 817 At, St.', '', NULL, '', '(238) 896-8613', 'blandit.mattis@bibendumfermentum.net', 'LIC01', 0, '', 'Galway', 'C', 'Bahia', 'Costa Rica', 'Ulric Washington', '(446) 863-5472', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(54, 'Est Tempor Bibendum Inc.', 'P.O. Box 555, 6400 Convallis Rd.', '', NULL, '', '(671) 585-3812', 'nibh.sit@justoeu.net', 'LIC01', 0, '', 'Dublin', 'L', 'Provence-Alpes-Côte d\'Azur', 'Korea, South', 'Mason Lee', '(935) 876-8011', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(55, 'Ullamcorper Velit In Limited', 'Ap #209-600 Dui Rd.', '', NULL, '', '(890) 791-5213', 'sem.mollis@cursuspurusNullam.org', 'LIC01', 0, '', 'Anderlecht', 'BU', 'Queensland', 'Indonesia', 'Omar C. Sutton', '(974) 437-4944', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(56, 'Fermentum Incorporated', 'Ap #273-872 Donec Rd.', '', NULL, '', '(804) 953-1113', 'Donec.feugiat@metusInlorem.com', 'LIC01', 0, '', 'Dieppe', 'HA', 'LAZ', 'Jamaica', 'Anika O. Mcconnell', '(254) 104-6391', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(57, 'In Tempus Eu Limited', 'Ap #345-5410 Pede Rd.', '', NULL, '', '(122) 480-9147', 'Morbi.metus.Vivamus@liberomaurisaliquam.com', 'LIC01', 0, '', 'Berlin', 'BE', 'VB', 'Estonia', 'Rebekah Y. Bernard', '(910) 674-4572', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(58, 'Faucibus Orci Inc.', 'P.O. Box 737, 6604 Nulla Av.', '', NULL, '', '(935) 793-3103', 'aliquet.Proin.velit@at.com', 'LIC01', 0, '', 'Funtua', 'Katsina', 'UT', 'Papua New Guinea', 'Paul Chase', '(603) 687-5476', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(59, 'In Corporation', '7076 Mus. St.', '', NULL, '', '(353) 855-5818', 'sit@CuraeDonectincidunt.net', 'LIC01', 0, '', 'Radom', 'MA', 'Renfrewshire', 'Malta', 'Darrel C. Hahn', '(393) 661-2028', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(60, 'Tincidunt Nibh Phasellus Foundation', 'Ap #998-7540 Aliquet. Rd.', '', NULL, '', '(939) 736-9215', 'tellus.non@commodoat.edu', 'LIC01', 0, '', 'Dublin', 'L', 'LD', 'Papua New Guinea', 'Dante S. Dotson', '(111) 961-1737', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(61, 'Cursus Associates', 'Ap #431-9425 Pede, Street', '', NULL, '', '(100) 581-7840', 'Sed.nulla.ante@posuereenimnisl.co.uk', 'LIC01', 0, '', 'Arras', 'Nord-Pas-de-Calais', 'NSW', 'Nauru', 'Leigh Sharp', '(964) 236-0598', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(62, 'Proin Mi LLP', '4226 Laoreet Ave', '', NULL, '', '(960) 135-0772', 'mauris@rutrum.co.uk', 'LIC01', 0, '', 'Ijebu Ode', 'OG', 'NI', 'Greenland', 'Talon I. Dejesus', '(962) 323-6489', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(63, 'Ultrices Associates', '699-8536 A, Rd.', '', NULL, '', '(379) 804-5526', 'hendrerit.id.ante@risusvariusorci.com', 'LIC01', 0, '', 'Jerez de la Frontera', 'Andalucía', 'Extremadura', 'Timor-Leste', 'Jenette Vasquez', '(210) 612-2895', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(64, 'Est Nunc Ullamcorper Ltd', '388-1835 Arcu. Avenue', '', NULL, '', '(375) 629-5998', 'molestie.in.tempus@Curabiturconsequat.org', 'LIC01', 0, '', 'Karnal', 'Haryana', 'Sicilia', 'Congo, the Democratic Republic of the', 'Hiram H. Riley', '(684) 206-5250', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(65, 'Eget Company', 'P.O. Box 654, 8428 Duis Street', '', NULL, '', '(232) 825-1668', 'viverra.Donec.tempus@ligula.org', 'LIC01', 0, '', 'Monceau-sur-Sambre', 'HE', 'Ontario', 'Croatia', 'Callum Huber', '(532) 273-9343', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(66, 'Amet Ornare Company', 'P.O. Box 760, 9868 Purus Rd.', '', NULL, '', '(216) 209-6967', 'vestibulum.massa@pellentesqueafacilisis.net', 'LIC01', 0, '', 'Mandi Bahauddin', 'Punjab', 'North Island', 'Oman', 'Shad Phelps', '(717) 712-5505', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(67, 'Primis In Faucibus Ltd', '5711 Ultrices, Rd.', '', NULL, '', '(617) 200-5794', 'placerat.Cras.dictum@duilectus.org', 'LIC01', 0, '', 'Teruel', 'Aragón', 'SJ', 'South Africa', 'Emi E. Sweet', '(974) 477-5686', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(68, 'Ac Eleifend Vitae Foundation', 'P.O. Box 680, 9492 Mi Rd.', '', NULL, '', '(365) 452-1689', 'Praesent@Sed.org', 'LIC01', 0, '', 'Gaziantep', 'Gaziantep', 'F', 'Timor-Leste', 'Austin Davenport', '(438) 209-0679', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(69, 'Lorem Ac Consulting', 'P.O. Box 697, 8030 Ut Street', '', NULL, '', '(232) 346-2133', 'a.aliquet@velarcu.ca', 'LIC01', 0, '', 'Boise', 'Idaho', 'WB', 'Denmark', 'Graham Estrada', '(892) 583-3127', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(70, 'Non Institute', 'P.O. Box 810, 5225 Nunc Rd.', '', NULL, '', '(676) 240-7844', 'consectetuer.euismod.est@lacusAliquamrutrum.com', 'LIC01', 0, '', 'Jönköping', 'Jönköpings län', 'C', 'Macedonia', 'Jordan Mueller', '(559) 764-4568', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(71, 'Dictum Eu Ltd', 'P.O. Box 656, 6155 Vitae Rd.', '', NULL, '', '(385) 510-2044', 'mi.lacinia.mattis@quamCurabiturvel.net', 'LIC01', 0, '', 'Belfast', 'U', 'Kano', 'Aruba', 'Pascale J. Cardenas', '(475) 117-9943', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(72, 'Faucibus Lectus A Foundation', '5743 Praesent St.', '', NULL, '', '(451) 169-7174', 'erat.volutpat@tempor.edu', 'LIC01', 0, '', 'Alingsås', 'O', 'Oost-Vlaanderen', 'Uganda', 'Xantha C. Knapp', '(597) 955-1180', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(73, 'Adipiscing Ltd', 'P.O. Box 368, 3097 Eget Ave', '', NULL, '', '(474) 253-1852', 'consectetuer@Nuncsed.org', 'LIC01', 0, '', 'Wabamun', 'Alberta', 'O', 'Swaziland', 'Jamalia Humphrey', '(231) 841-4277', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(74, 'Nullam Lobortis Quam PC', '460-5503 A Av.', '', NULL, '', '(202) 578-4176', 'ac.nulla@morbitristiquesenectus.com', 'LIC01', 0, '', 'Broken Hill', 'New South Wales', 'XIV', 'Bouvet Island', 'Deanna Bond', '(676) 409-7017', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(75, 'Consectetuer Adipiscing Elit Incorporated', '9544 Turpis. St.', '', NULL, '', '(368) 518-2399', 'neque.Nullam@eusemPellentesque.ca', 'LIC01', 0, '', 'Istanbul', 'Ist', 'BE', 'Martinique', 'Jared G. Herrera', '(349) 999-3498', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(76, 'Pharetra Corporation', '597-5315 In Street', '', NULL, '', '(874) 985-6426', 'massa.Mauris.vestibulum@PhasellusnullaInteger.com', 'LIC01', 0, '', 'Padre Hurtado', 'Metropolitana de Santiago', 'Sicilia', 'Mauritania', 'Amity F. Pierce', '(971) 190-2759', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(77, 'Sed Associates', '278-8933 Ut St.', '', NULL, '', '(793) 681-1906', 'nulla.Integer@mitempor.net', 'LIC01', 0, '', 'Zierikzee', 'Zl', 'MA', 'Trinidad and Tobago', 'Mariam Ramos', '(975) 929-7564', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(78, 'Phasellus At Augue Limited', '928 Neque. Street', '', NULL, '', '(292) 546-4661', 'a@Curabitursed.org', 'LIC01', 0, '', 'Awka', 'AN', 'Bretagne', 'Mayotte', 'Avye T. Trujillo', '(867) 707-5480', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(79, 'Quam Pellentesque Incorporated', 'Ap #188-6345 Nec Road', '', NULL, '', '(947) 441-1971', 'Vestibulum.ut@Donecnon.co.uk', 'LIC01', 0, '', 'Ambala', 'Haryana', 'Diy', 'Iran', 'Willa Shannon', '(699) 572-9807', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(80, 'Eget Foundation', '364-830 Pellentesque Av.', '', NULL, '', '(886) 354-5754', 'urna@odioPhasellus.org', 'LIC01', 0, '', 'Gosnells', 'WA', 'Biobío', 'Bonaire, Sint Eustatius and Saba', 'Sybill U. Jacobson', '(924) 411-9291', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(81, 'Tempor Bibendum Limited', '357-6097 Vitae, Av.', '', NULL, '', '(374) 270-7507', 'Fusce@enimcondimentumeget.co.uk', 'LIC01', 0, '', 'Uikhoven', 'L.', 'NSW', 'Gabon', 'Cara Manning', '(930) 980-4134', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(82, 'Eu Sem Pellentesque Company', 'Ap #450-6889 Ac Ave', '', NULL, '', '(863) 574-7991', 'magna.Phasellus@pharetra.edu', 'LIC01', 0, '', 'Sint-Joost-ten-Node', 'Brussels Hoofdstedelijk Gewest', 'WA', 'Cuba', 'Shannon Nguyen', '(112) 120-0655', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(83, 'Mi Felis Adipiscing Institute', '2469 Mauris Road', '', NULL, '', '(162) 587-1927', 'at@Nuncpulvinararcu.net', 'LIC01', 0, '', 'Lidingo', 'Stockholms län', 'San José', 'Marshall Islands', 'Fleur V. Woodward', '(727) 771-8749', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(84, 'Ac Mi Eleifend Industries', '948-6262 Et Av.', '', NULL, '', '(916) 407-3357', 'auctor.odio@scelerisqueneque.net', 'LIC01', 0, '', 'Camaragibe', 'Pernambuco', 'XV', 'Mayotte', 'Britanney L. Mack', '(298) 269-1464', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(85, 'Neque Tellus Imperdiet Ltd', '441-4981 A, St.', '', NULL, '', '(678) 276-5859', 'Nunc.ullamcorper@tristiquesenectuset.edu', 'LIC01', 0, '', 'Paranaguá', 'Paraná', 'Comunitat Valenciana', 'Angola', 'Jared Mejia', '(212) 522-1839', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(86, 'Sem Ut Dolor Consulting', 'P.O. Box 283, 8193 Feugiat Avenue', '', NULL, '', '(542) 311-3736', 'lorem.eu@nonfeugiatnec.co.uk', 'LIC01', 0, '', 'Waiheke Island', 'North Island', 'Antwerpen', 'Jersey', 'Charde B. Delaney', '(810) 109-2215', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(87, 'Tristique Senectus Et Industries', '150-6124 Sapien. Rd.', '', NULL, '', '(245) 736-5545', 'augue.ac.ipsum@tellusPhasellus.edu', 'LIC01', 0, '', 'Berlin', 'BE', 'BA', 'Åland Islands', 'Morgan V. Clay', '(981) 695-3226', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(88, 'Gravida Sit Amet LLP', 'P.O. Box 915, 5493 Sit Road', '', NULL, '', '(988) 570-4818', 'elit.pretium@tinciduntpedeac.ca', 'LIC01', 0, '', 'Bloomington', 'Minnesota', 'Atacama', 'Congo, the Democratic Republic of the', 'Brenda Lester', '(440) 873-9891', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(89, 'Elit Pharetra Inc.', '975-5570 Lacus. Avenue', '', NULL, '', '(744) 677-1599', 'eu.ligula@neque.org', 'LIC01', 0, '', 'Cork', 'M', 'Zl', 'Dominican Republic', 'Blythe Miller', '(980) 168-6191', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(90, 'Cras LLP', '318 Donec Ave', '', NULL, '', '(830) 446-6774', 'Duis.risus@vulputate.co.uk', 'LIC01', 0, '', 'Ribeirão Preto', 'SP', 'Alajuela', 'Andorra', 'Moana Mccray', '(756) 564-8185', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(91, 'Vivamus Rhoncus Incorporated', '1004 Velit. Road', '', NULL, '', '(216) 945-9107', 'vel.arcu.eu@pede.edu', 'LIC01', 0, '', 'Çe?me', '?zm', 'Veneto', 'Liberia', 'Julie Burris', '(902) 582-0787', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(92, 'Accumsan Laoreet Ltd', 'P.O. Box 856, 7321 Pede St.', '', NULL, '', '(864) 226-6251', 'lacus@velitjustonec.com', 'LIC01', 0, '', 'Broken Hill', 'NSW', 'AB', 'Mauritius', 'Riley D. Robertson', '(148) 531-8990', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(93, 'Id Institute', 'P.O. Box 970, 9335 Ante. Av.', '', NULL, '', '(828) 897-8138', 'ut@accumsan.net', 'LIC01', 0, '', 'Tumba', 'Stockholms län', 'OG', 'Malta', 'Allen U. Ward', '(947) 843-5435', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(94, 'Lorem Eget Mollis Institute', 'Ap #361-7255 Pellentesque St.', '', NULL, '', '(161) 376-5203', 'Sed.malesuada.augue@mi.com', 'LIC01', 0, '', 'Grandrieu', 'Henegouwen', 'NI', 'Libya', 'Armand F. Mendez', '(985) 296-9134', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(95, 'Est Mauris Industries', '945 Cras Avenue', '', NULL, '', '(255) 555-5534', 'sociis.natoque@consequatpurusMaecenas.ca', 'LIC01', 0, '', 'Bergerac', 'AQ', 'SJ', 'United Kingdom (Great Britain)', 'Galena Gonzales', '(357) 702-5576', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(96, 'In Tincidunt Corporation', '638-2423 Neque. St.', '', NULL, '', '(532) 120-8689', 'nec@ipsum.org', 'LIC01', 0, '', 'Castel Maggiore', 'Emilia-Romagna', 'U', 'Antigua and Barbuda', 'Zachery Clay', '(819) 360-7623', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(97, 'Tincidunt Foundation', 'Ap #978-3153 A Avenue', '', NULL, '', '(611) 319-0041', 'Sed.eu.eros@Sednuncest.ca', 'LIC01', 0, '', 'Sobral', 'CE', 'Ankara', 'Cape Verde', 'Ruby K. Rojas', '(601) 505-3761', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(98, 'Proin Vel LLC', 'Ap #573-1007 Non, St.', '', NULL, '', '(937) 242-1062', 'Sed.eget@eleifend.net', 'LIC01', 0, '', 'Cambridge', 'North Island', 'Gl', 'Saint Pierre and Miquelon', 'Blossom N. Sharp', '(532) 955-6792', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(99, 'Enim Corp.', '395-3429 Ante Avenue', '', NULL, '', '(163) 315-9996', 'luctus@diam.com', 'LIC01', 0, '', 'Diadema', 'São Paulo', 'ON', 'Guinea-Bissau', 'Talon Morrow', '(789) 931-6167', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(100, 'Molestie Sodales Corp.', '331-6498 Venenatis Rd.', '', NULL, '', '(499) 174-7056', 'Sed.pharetra@fermentum.co.uk', 'LIC01', 0, '', 'Allentown', 'PA', 'Vermont', 'South Sudan', 'Ursa A. Stevens', '(739) 831-0626', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(101, 'Volutpat Nulla Dignissim Associates', '2821 Cras Ave', '', NULL, '', '(878) 521-5990', 'laoreet.lectus@temporarcuVestibulum.ca', 'LIC01', 0, '', 'Lions Bay', 'British Columbia', 'AK', 'Zambia', 'Grady K. Mccall', '(230) 956-8227', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(102, 'Blandit Incorporated', 'Ap #307-815 Ultricies Av.', '', NULL, '', '(255) 208-3390', 'Pellentesque@elit.edu', 'LIC01', 0, '', 'Kalisz', 'WP', 'AN', 'Solomon Islands', 'Perry Rutledge', '(294) 248-9077', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(103, 'Est Nunc LLC', '6970 Libero Rd.', '', NULL, '', '(183) 239-4257', 'Nunc.ac.sem@tempus.com', 'LIC01', 0, '', 'Thurso', 'Quebec', 'OY', 'Zimbabwe', 'Karly Z. Hubbard', '(473) 125-2377', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(104, 'In Associates', '9327 Nulla Rd.', '', NULL, '', '(658) 907-1170', 'quis@sitametante.edu', 'LIC01', 0, '', 'San Bernardo', 'RM', 'NI', 'Cayman Islands', 'Sierra Simpson', '(411) 866-7159', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(105, 'Eu Neque Pellentesque Inc.', 'P.O. Box 478, 2308 Vestibulum Road', '', NULL, '', '(309) 629-6367', 'ornare.In@eu.org', 'LIC01', 0, '', 'Mataró', 'CA', 'UT', 'Ukraine', 'Rose Hess', '(966) 836-4505', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(106, 'Ridiculus Mus Proin LLP', '588-6999 Cras Rd.', '', NULL, '', '(358) 302-1033', 'orci@urnaNullamlobortis.edu', 'LIC01', 0, '', 'Le Grand-Quevilly', 'HA', 'Borno', 'Niue', 'Anjolie Chambers', '(121) 599-2880', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(107, 'Sollicitudin Adipiscing Consulting', 'Ap #960-3090 Pede Av.', '', NULL, '', '(385) 269-5179', 'pede.malesuada.vel@eu.net', 'LIC01', 0, '', 'Peñalolén', 'Metropolitana de Santiago', 'Gelderland', 'Antigua and Barbuda', 'Caryn S. Grant', '(476) 642-1714', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(108, 'Nisl LLP', '6403 Nec, Street', '', NULL, '', '(466) 881-7595', 'Sed.nec.metus@nequevitaesemper.ca', 'LIC01', 0, '', 'Liverpool', 'NSW', 'Zeeland', 'Ghana', 'Lila Shelton', '(977) 234-3258', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(109, 'Nec Cursus A Foundation', 'P.O. Box 107, 2054 Donec Avenue', '', NULL, '', '(492) 201-2876', 'nibh.sit.amet@consequatpurus.org', 'LIC01', 0, '', 'Bareilly', 'UP', 'Rio de Janeiro', 'Iraq', 'Halla Fields', '(284) 884-7244', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(110, 'Ornare Facilisis Eget Company', 'Ap #113-3257 Ut, Avenue', '', NULL, '', '(276) 863-2614', 'odio.sagittis@tellusid.org', 'LIC01', 0, '', 'Grimsby', 'Lincolnshire', 'Leinster', 'Greenland', 'Kerry Weiss', '(935) 675-6404', 0, 0, '0000-00-00 00:00:00', '2017-06-20 18:53:13'),
(111, 'twinkal', '743-3040 Quis Rd.', 'SSS', NULL, '', '9902349022', 'mollis@Duisrisus.co.uk', 'LIC01', 1, '', '1', '1', '1', '1', 'AAA', '', 0, 0, '2017-10-22 10:44:13', '2017-10-22 14:14:13'),
(112, 'twinkal', '743-3040 Quis Rd.', 'SSS', NULL, '', '9902349022', 'mollis@Duisrisus.co.uk', 'LIC01', 1, '', '1', '1', '1', '1', 'AAA', '', 0, 0, '2017-10-22 10:44:55', '2017-10-22 14:14:55'),
(113, 'NIMS', 'Panjagutta,Hyderabad', '', NULL, '', '7036375558', 'msallu2@gmail.com', 'LIC01', 1, '', '1', '1', '1', '1', 'Salavuddin', '', 1, 0, '2018-08-08 18:40:38', '2018-08-08 18:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `hms_hospital_admin`
--

CREATE TABLE `hms_hospital_admin` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qualification` text,
  `experience` text,
  `specialization` text,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_hospital_admin`
--

INSERT INTO `hms_hospital_admin` (`id`, `hospital_id`, `user_id`, `qualification`, `experience`, `specialization`, `isActive`, `isDeleted`, `created_at`, `modified_at`) VALUES
(1, 21, 3, 'm pharmacy', '15 yearss', 'Hospital Admin', 1, 0, '0000-00-00 00:00:00', '2018-07-30 17:20:15'),
(2, 21, 183, NULL, NULL, NULL, 1, 0, '2018-07-14 04:46:04', '2018-07-14 04:46:04'),
(3, 21, 199, '', '', '', 1, 0, '2018-08-11 02:50:24', '2018-08-11 02:50:24');

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

--
-- Dumping data for table `hms_inpatient`
--

INSERT INTO `hms_inpatient` (`id`, `user_id`, `bed_id`, `doctor_id`, `appointment_id`, `join_date`, `left_date`, `reason`, `status`, `isDeleted`, `isActive`) VALUES
(1, 26, 1, 2, 1, '2017-10-14 20:56:00', '2017-10-15 15:26:27', 'asd', 2, 0, 1),
(2, 26, 19, 2, 8, '2017-10-26 00:00:00', NULL, 'fever', 0, 0, 1),
(3, 28, 1, 2, 4, '2017-10-25 00:00:00', NULL, 'normal', 0, 0, 1);

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

--
-- Dumping data for table `hms_inpatient_history`
--

INSERT INTO `hms_inpatient_history` (`id`, `in_patient_id`, `datetime`, `note`, `cost`, `isDeleted`) VALUES
(1, 1, '2017-09-05 15:02:49', 'today activi\r\n', 0, 0),
(2, 2, '2017-10-25 13:33:56', 'test report for fever', 0, 0);

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

--
-- Dumping data for table `hms_medical_lab`
--

INSERT INTO `hms_medical_lab` (`id`, `user_id`, `name`, `description`, `owner_name`, `owner_contact_number`, `branch_id`, `address`, `phone_number`, `country`, `state`, `city`, `district`, `isActive`, `isDeleted`, `created_at`, `modified_at`) VALUES
(1, 15, 'Medical  Lab', 'My Lab Desc.', 'Ayus', '9099910271', 1, '4234- b123', '9099910271', 1, 1, 1, 1, 1, 0, '2017-05-30 12:36:59', '2017-09-30 11:28:36'),
(2, 28, 'Nw Mewds Labs', '', 'Ravi', '09099910271', 1, '', '', 0, 0, 0, 0, 1, 0, '2017-06-09 06:18:30', '2017-06-09 11:48:30'),
(3, 0, 'GTER', '', 'sdf', 'sdfsdfds', -1, '', '', 0, 0, 0, 0, 1, 0, '2017-06-10 06:30:42', '2017-06-10 12:00:42'),
(4, 0, 'adf', '', 'asdf', 'adsf', -1, '', '', 0, 0, 0, 0, 1, 0, '2017-06-10 06:42:12', '2017-06-10 12:12:12'),
(5, 0, 'Lap', '', 'KSL', '7056215620', -1, '', '', 0, 0, 0, 0, 1, 0, '2017-06-10 06:52:37', '2017-06-10 12:22:37'),
(6, 0, 'sfasf', '', 'asdf', '3242342342', 4, '', '', 0, 0, 0, 0, 1, 0, '2017-06-13 10:54:16', '2017-06-13 16:24:16'),
(7, 41, 'Trwe', 'ASDASDSAD', 'rrertr65', '6541238967', -1, '', '', 0, 0, 0, 0, 1, 0, '2017-06-15 09:02:48', '2017-06-15 14:45:21');

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

--
-- Dumping data for table `hms_medical_report`
--

INSERT INTO `hms_medical_report` (`id`, `patient_id`, `doctor_id`, `medical_lab_id`, `prescription_id`, `title`, `description`, `status`, `isDeleted`, `created_at`, `modified_at`) VALUES
(1, 26, 2, 0, 1, 'Some Test', 'Some Test', 1, 0, '2018-06-20 05:24:05', '2018-06-20 05:24:05'),
(2, 28, 2, 0, 4, 'Blood', 'check it', 1, 0, '2017-10-31 14:11:51', '2017-10-31 19:31:17'),
(3, 26, 2, 1, 3, 'Blood group', 'Check blood group', 0, 0, '2017-10-31 14:15:15', '2017-10-31 18:47:00'),
(4, 34, 2, 1, 5, 'Blood report', 'check blood report', 0, 0, '2017-10-31 14:55:11', '2017-10-31 19:25:58'),
(5, 27, 2, 0, 6, 'Test - Medical test', 'Test - Medical test', 0, 0, '2018-06-18 08:25:39', '2018-06-18 08:25:39');

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

--
-- Dumping data for table `hms_medical_report_file`
--

INSERT INTO `hms_medical_report_file` (`id`, `medical_report_id`, `file_url`, `file_type`, `file_path`, `isDeleted`) VALUES
(1, 3, 'http://localhost/mypulse//public/reports/1509458326_3.png', 'image/jpeg', 'C:\\xampp\\htdocs\\mypulse/public/reports/1509458326_3.png', 0),
(2, 4, 'http://localhost/mypulse//public/reports/1509458477_4.png', 'image/png', 'C:\\xampp\\htdocs\\mypulse/public/reports/1509458477_4.png', 0);

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

--
-- Dumping data for table `hms_medical_store`
--

INSERT INTO `hms_medical_store` (`id`, `user_id`, `name`, `description`, `owner_name`, `owner_contact_number`, `branch_id`, `address`, `phone_number`, `country`, `state`, `district`, `city`, `isActive`, `isDeleted`, `created_at`, `modified_at`) VALUES
(1, 14, 'Ravi Medi. Store', 'My Store Desc', 'Ravi', '09099910271', 1, '2342- Jsdfa', '1231231243', 1, 1, 1, 1, 1, 0, '2017-05-30 12:34:11', '2017-09-30 11:21:20'),
(2, 27, 'New MED St', '', 'MESS', '91012931213', 1, '', '', 0, 0, 0, 0, 1, 0, '2017-06-09 06:17:52', '2017-06-09 11:47:52'),
(3, 0, 'Hwrew', '', 'SDFee', 'asde', -1, '', '', 0, 0, 0, 0, 1, 0, '2017-06-10 06:35:05', '2017-06-10 12:05:05'),
(4, 0, 'Asdf', '', 'asdf', '3423423423', 4, '', '', 0, 0, 0, 0, 1, 0, '2017-06-13 10:50:36', '2017-06-13 16:21:37'),
(5, 0, 'Test', '', 'tes', '5461278906', -1, '', '', 0, 0, 0, 0, 1, 0, '2017-06-15 09:01:58', '2017-06-15 14:31:58');

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

--
-- Dumping data for table `hms_messages`
--

INSERT INTO `hms_messages` (`id`, `created_by`, `user_id`, `title`, `body`, `created_date`, `isRead`, `isDeleted`) VALUES
(1, 1, 1, 'Test Mail message from Super admin to Super admin  :)', 'Test Body Message from Super Admin \r\n\r\nRegards,\r\nSuper Admin', '2017-09-07 00:00:00', 0, 0),
(2, 2, 1, 'Another message', 'Message body goes here..', '2017-09-06 00:00:00', 1, 0),
(3, 1, 143, 'Titel', '<p>kjasdfkjkajdfkasdfkjkjkkjkfjkasdj</p><p><br></p>', '0000-00-00 00:00:00', 0, 0),
(4, 3, 28, '', '', '2017-09-12 05:59:00', 0, 0),
(5, 3, 12, '', '', '2017-09-12 05:59:00', 1, 0),
(6, 3, 1, 'LMS Hospital ADMIn', 'Testing message from HMS Hospital Admin.', '2017-09-12 06:02:00', 1, 0),
(7, 1, 12, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 1, 0),
(8, 1, 21, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(9, 1, 22, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(10, 1, 23, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(11, 1, 24, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(12, 1, 33, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(13, 1, 37, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(14, 1, 42, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(15, 1, 43, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(16, 1, 46, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(17, 1, 51, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(18, 1, 55, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(19, 1, 60, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(20, 1, 61, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(21, 1, 69, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(22, 1, 71, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(23, 1, 72, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(24, 1, 84, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(25, 1, 90, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(26, 1, 99, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(27, 1, 100, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(28, 1, 101, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(29, 1, 102, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(30, 1, 104, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(31, 1, 105, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(32, 1, 106, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(33, 1, 107, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(34, 1, 117, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(35, 1, 131, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(36, 1, 139, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(37, 1, 141, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(38, 1, 142, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(39, 1, 147, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(40, 1, 148, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(41, 1, 154, 'All Doc Messages', 'Hi there all doctors associations.!', '2017-10-07 15:04:00', 0, 0),
(42, 12, 1, 'All Patient', 'AAAAAAAAAAAAAAAAA', '2017-10-07 15:35:00', 0, 0),
(43, 12, 3, 'All Patient', 'AAAAAAAAAAAAAAAAA', '2017-10-07 15:35:00', 1, 0),
(44, 12, 1, 'All Patient', 'AAAAAAAAAA', '2017-10-07 15:36:00', 0, 0),
(45, 12, 3, 'All Patient', 'AAAAAAAAAA', '2017-10-07 15:36:00', 1, 0),
(46, 12, 26, 'All Patient', 'AAAAAAAAAA', '2017-10-07 15:38:00', 1, 0),
(47, 3, 12, 'Test', 'Testing the site', '2018-07-24 16:03:00', 1, 0),
(48, 3, 23, 'Test', 'Testing the site', '2018-07-24 16:03:00', 0, 0),
(49, 3, 147, 'Test', 'Testing the site', '2018-07-24 16:03:00', 0, 0),
(50, 3, 148, 'Test', 'Testing the site', '2018-07-24 16:03:00', 0, 0),
(51, 3, 156, 'Test', 'Testing the site', '2018-07-24 16:03:00', 0, 0),
(52, 3, 164, 'Test', 'Testing the site', '2018-07-24 16:03:00', 0, 0),
(53, 3, 171, 'Test', 'Testing the site', '2018-07-24 16:03:00', 0, 0),
(54, 3, 178, 'Test', 'Testing the site', '2018-07-24 16:03:00', 0, 0),
(55, 3, 180, 'Test', 'Testing the site', '2018-07-24 16:03:00', 0, 0),
(56, 3, 185, 'Test', 'Testing the site', '2018-07-24 16:03:00', 0, 0),
(57, 3, 186, 'Test', 'Testing the site', '2018-07-24 16:03:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hms_mstr_specializations`
--

CREATE TABLE `hms_mstr_specializations` (
  `SpecializationID` int(11) NOT NULL,
  `SpecializationName` varchar(250) DEFAULT NULL,
  `CreatedBy` int(10) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(10) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `Status` tinyint(1) UNSIGNED ZEROFILL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hms_mstr_specializations`
--

INSERT INTO `hms_mstr_specializations` (`SpecializationID`, `SpecializationName`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`, `Status`) VALUES
(1, 'Addiction psychiatrist', 1, '2018-07-25 00:00:00', NULL, NULL, 1),
(2, 'Adolescent medicine specialist', 1, '2018-07-25 00:00:00', NULL, NULL, 1),
(3, 'Allergist', NULL, '2018-07-25 00:00:00', NULL, NULL, 1),
(4, 'Cardiologist', NULL, '2018-07-25 00:00:00', NULL, NULL, 1);

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
(1, 12, 1, 'Dr. Ravi Patel added new availability', 1, NULL, '2017-09-05 20:18:14', 0),
(2, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2017-09-05 20:18:14', 0),
(3, 12, 1, 'Dr. Ravi Patel added new availability', 1, NULL, '2017-09-05 20:18:14', 0),
(4, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2017-09-05 20:18:14', 0),
(5, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-05 20:18:14', 0),
(6, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2017-09-05 20:18:14', 0),
(7, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-05 20:18:14', 0),
(8, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2017-09-05 20:18:14', 0),
(9, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-05 20:18:14', 0),
(10, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2017-09-05 20:18:14', 0),
(11, 12, 26, 'Your appointment <b>APT2</b> has been Approved', 1, NULL, '2017-09-05 20:30:21', 0),
(12, 12, 26, 'Some prescriptions are added in your profile ', 1, NULL, '2017-09-05 20:35:02', 0),
(13, 12, 17, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-09-05 23:14:36', 0),
(14, 12, 39, 'Dr. Ravi Patel Availability is updated', 1, NULL, '2017-09-05 23:14:36', 0),
(15, 3, 153, 'Your Profile is updated', 1, NULL, '2017-09-06 00:40:48', 0),
(16, 3, 147, 'You are linked with <b>Purus Corporation</b> hospital as Doctor', 0, NULL, '2017-09-12 12:21:52', 0),
(17, 3, 16, 'New doctor <b>Parash Oza</b> is added in your department <b>Dept-1</b>', 0, NULL, '2017-09-12 12:21:52', 0),
(18, 3, 20, 'New doctor <b>Parash Oza</b> is added in your department <b>Dept-1</b>', 0, NULL, '2017-09-12 12:21:52', 0),
(19, 3, 25, 'New doctor <b>Parash Oza</b> is added in your department <b>Dept-1</b>', 1, NULL, '2017-09-12 12:21:52', 0),
(20, 3, 148, 'You are linked with <b>Purus Corporation</b> hospital as Doctor', 0, NULL, '2017-09-12 12:35:44', 0),
(21, 3, 16, 'New doctor <b>Amit patel</b> is added in your department <b>Dept-1</b>', 0, NULL, '2017-09-12 12:35:44', 0),
(22, 3, 20, 'New doctor <b>Amit patel</b> is added in your department <b>Dept-1</b>', 0, NULL, '2017-09-12 12:35:44', 0),
(23, 3, 25, 'New doctor <b>Amit patel</b> is added in your department <b>Dept-1</b>', 1, NULL, '2017-09-12 12:35:44', 0),
(24, 1, 12, 'Your Profile is updated', 1, NULL, '2017-09-12 17:24:03', 0),
(25, 1, 12, 'Your Profile is updated', 1, NULL, '2017-09-12 18:01:44', 0),
(26, 1, 16, 'Your Profile is updated', 0, NULL, '2017-09-12 18:14:55', 0),
(27, 1, 16, 'Your Profile is updated', 0, NULL, '2017-09-12 18:16:02', 0),
(28, 1, 17, 'Your Profile is updated', 0, NULL, '2017-09-12 18:17:21', 0),
(29, 12, 26, 'Your prescription information is updated', 1, NULL, '2017-09-21 10:26:04', 0),
(30, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-22 15:03:41', 0),
(31, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-22 15:03:41', 0),
(32, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2017-09-22 15:03:41', 0),
(33, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-22 15:03:41', 0),
(34, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-22 15:03:41', 0),
(35, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-22 15:03:41', 0),
(36, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2017-09-22 15:03:41', 0),
(37, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-22 15:03:41', 0),
(38, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-22 15:03:41', 0),
(39, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-22 15:03:41', 0),
(40, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2017-09-22 15:03:41', 0),
(41, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-22 15:03:41', 0),
(42, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-22 15:03:41', 0),
(43, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-22 15:03:41', 0),
(44, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2017-09-22 15:03:41', 0),
(45, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-22 15:03:41', 0),
(46, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-22 15:03:41', 0),
(47, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-22 15:03:41', 0),
(48, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2017-09-22 15:03:41', 0),
(49, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-22 15:03:41', 0),
(50, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-22 15:03:41', 0),
(51, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-22 15:03:41', 0),
(52, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2017-09-22 15:03:41', 0),
(53, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-22 15:03:41', 0),
(54, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-22 15:03:41', 0),
(55, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-22 15:03:41', 0),
(56, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2017-09-22 15:03:41', 0),
(57, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-09-22 15:03:41', 0),
(58, 12, 26, 'Your appointment is booked.<br> Appointment number:<b> APT3 </b>', 1, NULL, '2017-09-22 15:04:09', 0),
(59, 12, 17, 'New appointment is booked.<br> Appointment number:<b> APT3 </b>', 0, NULL, '2017-09-22 15:04:09', 0),
(60, 12, 31, 'New appointment is booked.<br> Appointment number:<b> APT3 </b>', 0, NULL, '2017-09-22 15:04:09', 0),
(61, 12, 39, 'New appointment is booked.<br> Appointment number:<b> APT3 </b>', 1, NULL, '2017-09-22 15:04:09', 0),
(62, 12, 146, 'New appointment is booked.<br> Appointment number:<b> APT3 </b>', 0, NULL, '2017-09-22 15:04:09', 0),
(63, 12, 26, 'Some prescriptions are added in your profile ', 1, NULL, '2017-09-22 16:37:29', 0),
(64, 12, 26, 'Your prescription information is updated', 1, NULL, '2017-09-22 16:46:13', 0),
(65, 12, 26, 'Your appointment is booked.<br> Appointment number:<b> APT4 </b>', 1, NULL, '2017-09-22 21:51:51', 0),
(66, 12, 17, 'New appointment is booked.<br> Appointment number:<b> APT4 </b>', 0, NULL, '2017-09-22 21:51:51', 0),
(67, 12, 31, 'New appointment is booked.<br> Appointment number:<b> APT4 </b>', 0, NULL, '2017-09-22 21:51:51', 0),
(68, 12, 39, 'New appointment is booked.<br> Appointment number:<b> APT4 </b>', 1, NULL, '2017-09-22 21:51:51', 0),
(69, 12, 146, 'New appointment is booked.<br> Appointment number:<b> APT4 </b>', 0, NULL, '2017-09-22 21:51:51', 0),
(70, 12, 26, 'Your appointment is booked.<br> Appointment number:<b> APT5 </b>', 1, NULL, '2017-09-22 22:11:08', 0),
(71, 12, 17, 'New appointment is booked.<br> Appointment number:<b> APT5 </b>', 0, NULL, '2017-09-22 22:11:08', 0),
(72, 12, 31, 'New appointment is booked.<br> Appointment number:<b> APT5 </b>', 0, NULL, '2017-09-22 22:11:08', 0),
(73, 12, 39, 'New appointment is booked.<br> Appointment number:<b> APT5 </b>', 1, NULL, '2017-09-22 22:11:08', 0),
(74, 12, 146, 'New appointment is booked.<br> Appointment number:<b> APT5 </b>', 0, NULL, '2017-09-22 22:11:08', 0),
(75, 12, 26, 'Your appointment is booked.<br> Appointment number:<b> APT6 </b>', 1, NULL, '2017-09-22 22:37:37', 0),
(76, 12, 17, 'New appointment is booked.<br> Appointment number:<b> APT6 </b>', 0, NULL, '2017-09-22 22:37:37', 0),
(77, 12, 31, 'New appointment is booked.<br> Appointment number:<b> APT6 </b>', 0, NULL, '2017-09-22 22:37:37', 0),
(78, 12, 39, 'New appointment is booked.<br> Appointment number:<b> APT6 </b>', 1, NULL, '2017-09-22 22:37:37', 0),
(79, 12, 146, 'New appointment is booked.<br> Appointment number:<b> APT6 </b>', 0, NULL, '2017-09-22 22:37:37', 0),
(80, 12, 26, 'Your appointment is booked.<br> Appointment number:<b> APT7 </b>', 1, NULL, '2017-09-23 11:12:45', 0),
(81, 12, 17, 'New appointment is booked.<br> Appointment number:<b> APT7 </b>', 0, NULL, '2017-09-23 11:12:45', 0),
(82, 12, 31, 'New appointment is booked.<br> Appointment number:<b> APT7 </b>', 0, NULL, '2017-09-23 11:12:45', 0),
(83, 12, 39, 'New appointment is booked.<br> Appointment number:<b> APT7 </b>', 1, NULL, '2017-09-23 11:12:45', 0),
(84, 12, 146, 'New appointment is booked.<br> Appointment number:<b> APT7 </b>', 0, NULL, '2017-09-23 11:12:45', 0),
(85, 26, 12, 'New appointment is booked.<br> Appointment number:<b> APT8 </b>', 1, NULL, '2017-09-23 12:22:51', 0),
(86, 26, 17, 'New appointment is booked.<br> Appointment number:<b> APT8 </b>', 0, NULL, '2017-09-23 12:22:51', 0),
(87, 26, 31, 'New appointment is booked.<br> Appointment number:<b> APT8 </b>', 0, NULL, '2017-09-23 12:22:51', 0),
(88, 26, 39, 'New appointment is booked.<br> Appointment number:<b> APT8 </b>', 1, NULL, '2017-09-23 12:22:51', 0),
(89, 26, 146, 'New appointment is booked.<br> Appointment number:<b> APT8 </b>', 0, NULL, '2017-09-23 12:22:51', 0),
(90, 1, 16, 'Your Profile is updated', 0, NULL, '2017-09-23 18:05:14', 0),
(91, 1, 16, 'Your Profile is updated', 0, NULL, '2017-09-23 18:18:32', 0),
(92, 1, 16, 'Your Profile is updated', 0, NULL, '2017-09-23 18:22:35', 0),
(93, 1, 16, 'Your Profile is updated', 0, NULL, '2017-09-23 18:23:03', 0),
(94, 1, 16, 'Your Profile is updated', 0, NULL, '2017-09-23 18:24:52', 0),
(95, 1, 15, 'Your Profile is updated', 0, NULL, '2017-09-30 11:28:36', 0),
(96, 1, 15, 'Your profile is updated', 0, NULL, '2017-09-30 11:28:36', 0),
(97, 154, 3, '<b>New </b> is successfully registered as <b>Doctor</b> in Department: <b>Dept-1</b>', 1, NULL, '2017-10-07 16:04:57', 0),
(98, 26, 12, 'New appointment is booked.<br> Appointment number:<b> APT10 </b>', 1, NULL, '2017-10-07 21:13:11', 0),
(99, 26, 17, 'New appointment is booked.<br> Appointment number:<b> APT10 </b>', 0, NULL, '2017-10-07 21:13:11', 0),
(100, 26, 31, 'New appointment is booked.<br> Appointment number:<b> APT10 </b>', 0, NULL, '2017-10-07 21:13:11', 0),
(101, 26, 39, 'New appointment is booked.<br> Appointment number:<b> APT10 </b>', 1, NULL, '2017-10-07 21:13:11', 0),
(102, 26, 146, 'New appointment is booked.<br> Appointment number:<b> APT10 </b>', 0, NULL, '2017-10-07 21:13:11', 0),
(103, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-10-13 17:02:31', 0),
(104, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-10-13 17:02:31', 0),
(105, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2017-10-13 17:02:31', 0),
(106, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-10-13 17:02:31', 0),
(107, 12, 17, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 17:02:59', 0),
(108, 12, 31, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 17:02:59', 0),
(109, 12, 39, 'Dr. Ravi Patel Availability is updated', 1, NULL, '2017-10-13 17:02:59', 0),
(110, 12, 146, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 17:02:59', 0),
(111, 12, 17, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 18:36:44', 0),
(112, 12, 31, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 18:36:44', 0),
(113, 12, 39, 'Dr. Ravi Patel Availability is updated', 1, NULL, '2017-10-13 18:36:44', 0),
(114, 12, 146, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 18:36:44', 0),
(115, 12, 17, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 18:38:30', 0),
(116, 12, 31, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 18:38:30', 0),
(117, 12, 39, 'Dr. Ravi Patel Availability is updated', 1, NULL, '2017-10-13 18:38:30', 0),
(118, 12, 146, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 18:38:30', 0),
(119, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-10-13 18:39:10', 0),
(120, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-10-13 18:39:10', 0),
(121, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2017-10-13 18:39:10', 0),
(122, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-10-13 18:39:10', 0),
(123, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-10-13 18:39:25', 0),
(124, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-10-13 18:39:25', 0),
(125, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2017-10-13 18:39:25', 0),
(126, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-10-13 18:39:25', 0),
(127, 12, 17, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 18:40:22', 0),
(128, 12, 31, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 18:40:22', 0),
(129, 12, 39, 'Dr. Ravi Patel Availability is updated', 1, NULL, '2017-10-13 18:40:22', 0),
(130, 12, 146, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 18:40:22', 0),
(131, 12, 17, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 19:06:35', 0),
(132, 12, 31, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 19:06:35', 0),
(133, 12, 39, 'Dr. Ravi Patel Availability is updated', 1, NULL, '2017-10-13 19:06:35', 0),
(134, 12, 146, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 19:06:35', 0),
(135, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-10-13 19:07:42', 0),
(136, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-10-13 19:07:42', 0),
(137, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2017-10-13 19:07:42', 0),
(138, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-10-13 19:07:42', 0),
(139, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-10-13 19:10:48', 0),
(140, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-10-13 19:10:48', 0),
(141, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2017-10-13 19:10:48', 0),
(142, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2017-10-13 19:10:48', 0),
(143, 12, 17, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 19:18:25', 0),
(144, 12, 31, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 19:18:25', 0),
(145, 12, 39, 'Dr. Ravi Patel Availability is updated', 1, NULL, '2017-10-13 19:18:25', 0),
(146, 12, 146, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 19:18:25', 0),
(147, 12, 17, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 19:18:34', 0),
(148, 12, 31, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 19:18:34', 0),
(149, 12, 39, 'Dr. Ravi Patel Availability is updated', 1, NULL, '2017-10-13 19:18:34', 0),
(150, 12, 146, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 19:18:34', 0),
(151, 12, 17, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 19:55:28', 0),
(152, 12, 31, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 19:55:28', 0),
(153, 12, 39, 'Dr. Ravi Patel Availability is updated', 1, NULL, '2017-10-13 19:55:28', 0),
(154, 12, 146, 'Dr. Ravi Patel Availability is updated', 0, NULL, '2017-10-13 19:55:28', 0),
(155, 12, 16, 'Inpatient history of patient <b>Patient </b> is updated', 0, NULL, '2017-10-15 20:49:55', 0),
(156, 12, 20, 'Inpatient history of patient <b>Patient </b> is updated', 0, NULL, '2017-10-15 20:49:55', 0),
(157, 12, 25, 'Inpatient history of patient <b>Patient </b> is updated', 1, NULL, '2017-10-15 20:49:55', 0),
(158, 12, 26, 'Your Inpatient history is updated', 1, NULL, '2017-10-15 20:49:55', 0),
(159, 12, 16, 'Inpatient history of patient <b>Patient </b> is updated', 0, NULL, '2017-10-15 20:56:27', 0),
(160, 12, 20, 'Inpatient history of patient <b>Patient </b> is updated', 0, NULL, '2017-10-15 20:56:27', 0),
(161, 12, 25, 'Inpatient history of patient <b>Patient </b> is updated', 1, NULL, '2017-10-15 20:56:27', 0),
(162, 12, 26, 'Your Inpatient history is updated', 1, NULL, '2017-10-15 20:56:27', 0),
(163, 1, 26, 'Your appointment <b>APT10</b> has been Approved', 1, NULL, '2017-10-23 14:42:52', 0),
(164, 1, 12, ' Appointment <b>APT10</b> has been Approved', 1, NULL, '2017-10-23 14:42:52', 0),
(165, 1, 17, ' Appointment <b>APT10</b> has been Approved', 0, NULL, '2017-10-23 14:42:52', 0),
(166, 1, 31, ' Appointment <b>APT10</b> has been Approved', 0, NULL, '2017-10-23 14:42:52', 0),
(167, 1, 39, ' Appointment <b>APT10</b> has been Approved', 1, NULL, '2017-10-23 14:42:52', 0),
(168, 1, 146, ' Appointment <b>APT10</b> has been Approved', 0, NULL, '2017-10-23 14:42:52', 0),
(169, 1, 26, 'Your appointment <b>APT10</b> has been Rejected', 1, NULL, '2017-10-23 14:57:46', 0),
(170, 1, 12, ' Appointment <b>APT10</b> has been Rejected', 1, NULL, '2017-10-23 14:57:46', 0),
(171, 1, 17, ' Appointment <b>APT10</b> has been Rejected', 0, NULL, '2017-10-23 14:57:46', 0),
(172, 1, 31, ' Appointment <b>APT10</b> has been Rejected', 0, NULL, '2017-10-23 14:57:46', 0),
(173, 1, 39, ' Appointment <b>APT10</b> has been Rejected', 1, NULL, '2017-10-23 14:57:46', 0),
(174, 1, 146, ' Appointment <b>APT10</b> has been Rejected', 0, NULL, '2017-10-23 14:57:46', 0),
(175, 1, 26, 'Remark added in your appointment: <b>APT10</b>', 1, NULL, '2017-10-23 14:58:42', 0),
(176, 1, 12, 'Remark added in appointment: <b>APT10</b>', 1, NULL, '2017-10-23 14:58:42', 0),
(177, 1, 17, 'Remark added in appointment: <b>APT10</b>', 0, NULL, '2017-10-23 14:58:42', 0),
(178, 1, 31, 'Remark added in appointment: <b>APT10</b>', 0, NULL, '2017-10-23 14:58:42', 0),
(179, 1, 39, 'Remark added in appointment: <b>APT10</b>', 1, NULL, '2017-10-23 14:58:42', 0),
(180, 1, 146, 'Remark added in appointment: <b>APT10</b>', 0, NULL, '2017-10-23 14:58:42', 0),
(181, 1, 26, 'Your appointment <b>APT10</b> has been Approved', 1, NULL, '2017-10-23 15:05:58', 0),
(182, 1, 12, ' Appointment <b>APT10</b> has been Approved', 1, NULL, '2017-10-23 15:05:58', 0),
(183, 1, 17, ' Appointment <b>APT10</b> has been Approved', 0, NULL, '2017-10-23 15:05:58', 0),
(184, 1, 31, ' Appointment <b>APT10</b> has been Approved', 0, NULL, '2017-10-23 15:05:58', 0),
(185, 1, 39, ' Appointment <b>APT10</b> has been Approved', 1, NULL, '2017-10-23 15:05:58', 0),
(186, 1, 146, ' Appointment <b>APT10</b> has been Approved', 0, NULL, '2017-10-23 15:05:58', 0),
(187, 1, 26, 'Your appointment <b>APT10</b> has been Rejected', 1, NULL, '2017-10-23 15:14:03', 0),
(188, 1, 12, ' Appointment <b>APT10</b> has been Rejected', 1, NULL, '2017-10-23 15:14:03', 0),
(189, 1, 17, ' Appointment <b>APT10</b> has been Rejected', 0, NULL, '2017-10-23 15:14:03', 0),
(190, 1, 31, ' Appointment <b>APT10</b> has been Rejected', 0, NULL, '2017-10-23 15:14:03', 0),
(191, 1, 39, ' Appointment <b>APT10</b> has been Rejected', 1, NULL, '2017-10-23 15:14:03', 0),
(192, 1, 146, ' Appointment <b>APT10</b> has been Rejected', 0, NULL, '2017-10-23 15:14:03', 0),
(193, 12, 26, 'Remark added in your appointment <b>APT10</b>', 1, NULL, '2017-10-23 15:15:58', 0),
(194, 12, 17, 'Remark added in appointment: <b>APT10</b>', 0, NULL, '2017-10-23 15:15:58', 0),
(195, 12, 31, 'Remark added in appointment: <b>APT10</b>', 0, NULL, '2017-10-23 15:15:58', 0),
(196, 12, 39, 'Remark added in appointment: <b>APT10</b>', 1, NULL, '2017-10-23 15:15:58', 0),
(197, 12, 146, 'Remark added in appointment: <b>APT10</b>', 0, NULL, '2017-10-23 15:15:58', 0),
(198, 1, 16, 'new bed <b>B62</b> is added in <b>Word1</b> ward', 0, NULL, '2017-10-23 15:33:15', 0),
(199, 1, 20, 'new bed <b>B62</b> is added in <b>Word1</b> ward', 0, NULL, '2017-10-23 15:33:15', 0),
(200, 1, 25, 'new bed <b>B62</b> is added in <b>Word1</b> ward', 1, NULL, '2017-10-23 15:33:15', 0),
(201, 1, 3, 'new bed <b>B62</b> is added in <b>Word1 </b> ward <br> Department: <b>Dept-1</b> <br> Branch: <b>WB</b>', 1, NULL, '2017-10-23 15:33:15', 0),
(202, 1, 16, 'Bed <b>B62</b> information is updated in <b>Word1</b> ward', 0, NULL, '2017-10-23 15:33:47', 0),
(203, 1, 20, 'Bed <b>B62</b> information is updated in <b>Word1</b> ward', 0, NULL, '2017-10-23 15:33:47', 0),
(204, 1, 25, 'Bed <b>B62</b> information is updated in <b>Word1</b> ward', 1, NULL, '2017-10-23 15:33:47', 0),
(205, 1, 3, 'Bed <b>B62</b> information is updated in <b>Word1</b> ward <br> Department: <b>Dept-1</b> <br> Branch: <b>WB</b>', 1, NULL, '2017-10-23 15:33:47', 0),
(206, 1, 3, 'New branch <b>Twinkal</b> is added', 1, NULL, '2017-10-23 15:44:06', 0),
(207, 1, 3, 'New branch <b>Twinkal</b> is added', 1, NULL, '2017-10-23 15:46:27', 0),
(208, 1, 3, 'Branch <b>Twinkal</b> information is updated', 1, NULL, '2017-10-23 15:46:52', 0),
(209, 1, 155, 'Your Profile is updated', 0, NULL, '2017-10-24 17:57:38', 0),
(210, 1, 155, 'You are linked with <b>Purus Corporation</b> hospital as Doctor', 0, NULL, '2017-10-24 17:57:38', 0),
(211, 1, 48, 'New doctor <b>Twinkal  Patel</b> is added in your department <b>Dept-2</b>', 0, NULL, '2017-10-24 17:57:38', 0),
(212, 1, 3, 'New doctor <b>Twinkal  Patel</b> is added in department: <b>Dept-2</b><br>Branch: <b>WB</b>', 1, NULL, '2017-10-24 17:57:38', 0),
(213, 1, 155, 'Your new availability is added ', 0, NULL, '2017-10-24 18:37:49', 0),
(214, 1, 155, 'Your new availability is added ', 0, NULL, '2017-10-24 18:37:49', 0),
(215, 1, 155, 'Your new availability is added ', 0, NULL, '2017-10-24 18:37:49', 0),
(216, 1, 155, 'Your new availability is added ', 0, NULL, '2017-10-24 18:37:49', 0),
(217, 1, 155, 'Your new availability is added ', 0, NULL, '2017-10-24 18:37:49', 0),
(218, 1, 155, 'Your new availability is added ', 0, NULL, '2017-10-24 18:37:49', 0),
(219, 1, 155, 'Your new availability is added ', 0, NULL, '2017-10-24 18:43:57', 0),
(220, 1, 155, 'Your new availability is added ', 0, NULL, '2017-10-24 18:44:49', 0),
(221, 1, 155, 'Your Other settings regarding availability is updated', 0, NULL, '2017-10-24 18:48:07', 0),
(222, 12, 26, 'Some prescriptions are added in your profile ', 1, NULL, '2017-10-24 18:50:35', 0),
(223, 1, 3, 'Your Profile is updated', 1, NULL, '2017-10-25 16:41:41', 0),
(224, 12, 16, 'Inpatient history of patient <b> </b> is updated', 0, NULL, '2017-10-25 16:59:03', 0),
(225, 12, 20, 'Inpatient history of patient <b> </b> is updated', 0, NULL, '2017-10-25 16:59:03', 0),
(226, 12, 25, 'Inpatient history of patient <b> </b> is updated', 1, NULL, '2017-10-25 16:59:03', 0),
(227, 12, 16, 'New patient <b>Patient </b> is added in Inpatient', 0, NULL, '2017-10-25 17:00:51', 0),
(228, 12, 20, 'New patient <b>Patient </b> is added in Inpatient', 0, NULL, '2017-10-25 17:00:51', 0),
(229, 12, 25, 'New patient <b>Patient </b> is added in Inpatient', 1, NULL, '2017-10-25 17:00:51', 0),
(230, 12, 26, 'You added in Inpatient', 1, NULL, '2017-10-25 17:00:51', 0),
(231, 12, 16, 'New note is added in Inpatient history of patient <b>Patient </b>', 0, NULL, '2017-10-25 17:03:56', 0),
(232, 12, 20, 'New note is added in Inpatient history of patient <b>Patient </b>', 0, NULL, '2017-10-25 17:03:56', 0),
(233, 12, 25, 'New note is added in Inpatient history of patient <b>Patient </b>', 1, NULL, '2017-10-25 17:03:56', 0),
(234, 12, 16, 'Inpatient history of patient <b> </b> is updated', 0, NULL, '2017-10-25 17:06:08', 0),
(235, 12, 20, 'Inpatient history of patient <b> </b> is updated', 0, NULL, '2017-10-25 17:06:08', 0),
(236, 12, 25, 'Inpatient history of patient <b> </b> is updated', 1, NULL, '2017-10-25 17:06:08', 0),
(237, 12, 16, 'Inpatient history of patient <b> </b> is updated', 0, NULL, '2017-10-25 17:07:12', 0),
(238, 12, 20, 'Inpatient history of patient <b> </b> is updated', 0, NULL, '2017-10-25 17:07:12', 0),
(239, 12, 25, 'Inpatient history of patient <b> </b> is updated', 1, NULL, '2017-10-25 17:07:12', 0),
(240, 12, 16, 'New patient <b>Amit patel</b> is added in Inpatient', 0, NULL, '2017-10-25 17:09:52', 0),
(241, 12, 20, 'New patient <b>Amit patel</b> is added in Inpatient', 0, NULL, '2017-10-25 17:09:52', 0),
(242, 12, 25, 'New patient <b>Amit patel</b> is added in Inpatient', 1, NULL, '2017-10-25 17:09:52', 0),
(243, 12, 28, 'You added in Inpatient', 0, NULL, '2017-10-25 17:09:52', 0),
(244, 12, 16, 'Inpatient history of patient <b> </b> is updated', 0, NULL, '2017-10-31 15:17:56', 0),
(245, 12, 20, 'Inpatient history of patient <b> </b> is updated', 0, NULL, '2017-10-31 15:17:56', 0),
(246, 12, 25, 'Inpatient history of patient <b> </b> is updated', 1, NULL, '2017-10-31 15:17:56', 0),
(247, 12, 16, 'Inpatient history of patient <b> </b> is updated', 0, NULL, '2017-10-31 15:18:49', 0),
(248, 12, 20, 'Inpatient history of patient <b> </b> is updated', 0, NULL, '2017-10-31 15:18:49', 0),
(249, 12, 25, 'Inpatient history of patient <b> </b> is updated', 1, NULL, '2017-10-31 15:18:49', 0),
(250, 12, 16, 'Inpatient history of patient <b> </b> is updated', 0, NULL, '2017-10-31 15:21:59', 0),
(251, 12, 20, 'Inpatient history of patient <b> </b> is updated', 0, NULL, '2017-10-31 15:21:59', 0),
(252, 12, 25, 'Inpatient history of patient <b> </b> is updated', 1, NULL, '2017-10-31 15:21:59', 0),
(253, 12, 28, 'Some prescriptions are added in your profile ', 0, NULL, '2017-10-31 18:41:12', 0),
(254, 12, 28, 'Your prescription information is updated', 0, NULL, '2017-10-31 18:41:51', 0),
(255, 12, 26, 'Your prescription information is updated', 1, NULL, '2017-10-31 18:45:15', 0),
(256, 26, 15, 'Patient request for test the medical report', 0, NULL, '2017-10-31 18:47:00', 0),
(257, 34, 12, 'New appointment is booked.<br> Appointment number:<b> APT11 </b>', 1, NULL, '2017-10-31 19:24:01', 0),
(258, 34, 17, 'New appointment is booked.<br> Appointment number:<b> APT11 </b>', 0, NULL, '2017-10-31 19:24:01', 0),
(259, 34, 31, 'New appointment is booked.<br> Appointment number:<b> APT11 </b>', 0, NULL, '2017-10-31 19:24:01', 0),
(260, 34, 39, 'New appointment is booked.<br> Appointment number:<b> APT11 </b>', 1, NULL, '2017-10-31 19:24:01', 0),
(261, 34, 146, 'New appointment is booked.<br> Appointment number:<b> APT11 </b>', 0, NULL, '2017-10-31 19:24:01', 0),
(262, 12, 34, 'Some prescriptions are added in your profile ', 0, NULL, '2017-10-31 19:25:11', 0),
(263, 34, 15, 'Patient request for test the medical report', 0, NULL, '2017-10-31 19:25:58', 0),
(264, 15, 28, 'Your medical report is uploded', 0, NULL, '2017-10-31 19:28:46', 0),
(265, 15, 12, 'Medical report is uploaded of Patient_Appointment_No: <b>APT3</b>', 1, NULL, '2017-10-31 19:28:46', 0),
(266, 15, 28, 'Your medical report is uploded', 0, NULL, '2017-10-31 19:31:17', 0),
(267, 15, 12, 'Medical report is uploaded of Patient_Appointment_No: <b>APT3</b>', 1, NULL, '2017-10-31 19:31:17', 0),
(268, 12, 27, 'Recommned next appointment date added in you appointment <br>Appointment Number: <b>APT5</b>', 1, NULL, '2017-11-01 14:13:57', 0),
(269, 12, 26, 'Recommned next appointment date added in you appointment <br>Appointment Number: <b>APT6</b>', 1, NULL, '2017-11-01 14:24:34', 0),
(270, 12, 26, 'Recommned next appointment date added in you appointment <br>Appointment Number: <b>APT6</b>', 1, NULL, '2017-11-01 14:32:51', 0),
(271, 12, 26, 'Recommned next appointment date added in you appointment <br>Appointment Number: <b>APT6</b>', 1, NULL, '2017-11-01 14:35:19', 0),
(272, 12, 26, 'Recommned next appointment date added in you appointment <br>Appointment Number: <b>APT6</b>', 1, NULL, '2017-11-01 14:38:03', 0),
(273, 1, 156, 'You are linked with <b>Purus Corporation</b> hospital as Doctor', 0, NULL, '2018-06-05 16:10:58', 0),
(274, 1, 16, 'New doctor <b>rajshekar mypulse gaddam</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-06-05 16:10:58', 0),
(275, 1, 20, 'New doctor <b>rajshekar mypulse gaddam</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-06-05 16:10:58', 0),
(276, 1, 25, 'New doctor <b>rajshekar mypulse gaddam</b> is added in your department <b>Dept-1</b>', 1, NULL, '2018-06-05 16:10:58', 0),
(277, 1, 3, 'New doctor <b>rajshekar mypulse gaddam</b> is added in department: <b>Dept-1</b><br>Branch: <b>WB</b>', 1, NULL, '2018-06-05 16:10:58', 0),
(278, 1, 156, 'Your Profile is updated', 0, NULL, '2018-06-05 16:11:27', 0),
(279, 1, 3, 'Doctor <b>rajshekar reddy gaddam</b> profile updated in department: <b>Dept-1</b><br>Branch: <b>WB</b>', 1, NULL, '2018-06-05 16:11:27', 0),
(280, 3, 164, 'You are linked with <b>Purus Corporation</b> hospital as Doctor', 0, NULL, '2018-06-12 15:26:24', 0),
(281, 3, 16, 'New doctor <b>First Last</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-06-12 15:26:24', 0),
(282, 3, 20, 'New doctor <b>First Last</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-06-12 15:26:24', 0),
(283, 3, 25, 'New doctor <b>First Last</b> is added in your department <b>Dept-1</b>', 1, NULL, '2018-06-12 15:26:24', 0),
(284, 12, 17, 'Dr. Ravi Patel Other settings regarding availability is updated', 0, NULL, '2018-06-13 03:11:59', 0),
(285, 12, 31, 'Dr. Ravi Patel Other settings regarding availability is updated', 0, NULL, '2018-06-13 03:11:59', 0),
(286, 12, 39, 'Dr. Ravi Patel Other settings regarding availability is updated', 1, NULL, '2018-06-13 03:11:59', 0),
(287, 12, 146, 'Dr. Ravi Patel Other settings regarding availability is updated', 0, NULL, '2018-06-13 03:11:59', 0),
(288, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-06-13 03:25:54', 0),
(289, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-06-13 03:25:54', 0),
(290, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-06-13 03:25:54', 0),
(291, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-06-13 03:25:54', 0),
(292, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-06-13 03:25:54', 0),
(293, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-06-13 03:25:54', 0),
(294, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-06-13 03:25:54', 0),
(295, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-06-13 03:25:54', 0),
(296, 12, 27, 'Some prescriptions are added in your profile ', 0, NULL, '2018-06-18 08:25:39', 0),
(297, 12, 26, 'Your prescription information is updated', 1, NULL, '2018-06-20 05:24:05', 0),
(298, 26, 12, 'New appointment is booked.<br> Appointment number:<b> APT12 </b>', 1, NULL, '2018-06-27 02:18:51', 0),
(299, 26, 17, 'New appointment is booked.<br> Appointment number:<b> APT12 </b>', 0, NULL, '2018-06-27 02:18:51', 0),
(300, 26, 31, 'New appointment is booked.<br> Appointment number:<b> APT12 </b>', 0, NULL, '2018-06-27 02:18:51', 0),
(301, 26, 39, 'New appointment is booked.<br> Appointment number:<b> APT12 </b>', 1, NULL, '2018-06-27 02:18:51', 0),
(302, 26, 146, 'New appointment is booked.<br> Appointment number:<b> APT12 </b>', 0, NULL, '2018-06-27 02:18:51', 0),
(303, 26, 26, 'Your appointment <b>APT10</b> has been Cancelled', 1, NULL, '2018-06-27 02:22:18', 0),
(304, 26, 26, 'Your appointment <b>APT10</b> has been Cancelled', 1, NULL, '2018-06-27 02:22:51', 0),
(305, 39, 26, 'Your appointment <b>APT12</b> has been Rejected', 1, NULL, '2018-06-27 03:23:56', 0),
(306, 39, 12, ' Appointment <b>APT12</b> has been Rejected', 1, NULL, '2018-06-27 03:23:56', 0),
(307, 39, 26, 'Your appointment <b>APT12</b> has been Approved', 1, NULL, '2018-06-27 16:17:10', 0),
(308, 39, 12, ' Appointment <b>APT12</b> has been Approved', 1, NULL, '2018-06-27 16:17:10', 0),
(309, 168, 12, 'New appointment is booked.<br> Appointment number:<b> APT13 </b>', 1, NULL, '2018-06-29 15:47:23', 0),
(310, 168, 17, 'New appointment is booked.<br> Appointment number:<b> APT13 </b>', 0, NULL, '2018-06-29 15:47:23', 0),
(311, 168, 31, 'New appointment is booked.<br> Appointment number:<b> APT13 </b>', 0, NULL, '2018-06-29 15:47:23', 0),
(312, 168, 39, 'New appointment is booked.<br> Appointment number:<b> APT13 </b>', 1, NULL, '2018-06-29 15:47:23', 0),
(313, 168, 146, 'New appointment is booked.<br> Appointment number:<b> APT13 </b>', 0, NULL, '2018-06-29 15:47:23', 0),
(314, 39, 168, 'Your appointment <b>APT13</b> has been Approved', 0, NULL, '2018-06-29 15:50:49', 0),
(315, 39, 12, ' Appointment <b>APT13</b> has been Approved', 1, NULL, '2018-06-29 15:50:49', 0),
(316, 39, 26, 'Your appointment <b>APT6</b> has been Approved', 1, NULL, '2018-06-29 17:42:48', 0),
(317, 39, 12, ' Appointment <b>APT6</b> has been Approved', 1, NULL, '2018-06-29 17:42:48', 0),
(318, 39, 168, 'Your appointment <b>APT13</b> has been Rejected', 0, NULL, '2018-06-29 18:48:55', 0),
(319, 39, 12, ' Appointment <b>APT13</b> has been Rejected', 1, NULL, '2018-06-29 18:48:55', 0),
(320, 26, 12, 'New appointment is booked.<br> Appointment number:<b> APT14 </b>', 1, NULL, '2018-06-29 19:51:24', 0),
(321, 26, 17, 'New appointment is booked.<br> Appointment number:<b> APT14 </b>', 0, NULL, '2018-06-29 19:51:24', 0),
(322, 26, 31, 'New appointment is booked.<br> Appointment number:<b> APT14 </b>', 0, NULL, '2018-06-29 19:51:24', 0),
(323, 26, 39, 'New appointment is booked.<br> Appointment number:<b> APT14 </b>', 1, NULL, '2018-06-29 19:51:24', 0),
(324, 26, 146, 'New appointment is booked.<br> Appointment number:<b> APT14 </b>', 0, NULL, '2018-06-29 19:51:24', 0),
(325, 39, 168, 'Your appointment <b>APT13</b> has been Approved', 0, NULL, '2018-06-30 02:30:49', 0),
(326, 39, 12, ' Appointment <b>APT13</b> has been Approved', 1, NULL, '2018-06-30 02:30:49', 0),
(327, 3, 171, 'You are linked with <b>Purus Corporation</b> hospital as Doctor', 0, NULL, '2018-07-01 14:43:48', 0),
(328, 3, 16, 'New doctor <b>maniyar salavuddin</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-01 14:43:48', 0),
(329, 3, 20, 'New doctor <b>maniyar salavuddin</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-01 14:43:48', 0),
(330, 3, 25, 'New doctor <b>maniyar salavuddin</b> is added in your department <b>Dept-1</b>', 1, NULL, '2018-07-01 14:43:48', 0),
(331, 3, 171, 'Your Profile is updated', 0, NULL, '2018-07-01 14:46:21', 0),
(332, 39, 172, 'Your appointment is booked.<br> Appointment number:<b> APT15 </b>', 0, NULL, '2018-07-01 15:25:35', 0),
(333, 39, 12, 'New appointment is booked.<br> Appointment number:<b> APT15 </b>', 1, NULL, '2018-07-01 15:25:35', 0),
(334, 26, 12, 'New appointment is booked.<br> Appointment number:<b> APT16 </b>', 1, NULL, '2018-07-01 18:10:44', 0),
(335, 26, 17, 'New appointment is booked.<br> Appointment number:<b> APT16 </b>', 0, NULL, '2018-07-01 18:10:44', 0),
(336, 26, 31, 'New appointment is booked.<br> Appointment number:<b> APT16 </b>', 0, NULL, '2018-07-01 18:10:44', 0),
(337, 26, 39, 'New appointment is booked.<br> Appointment number:<b> APT16 </b>', 1, NULL, '2018-07-01 18:10:44', 0),
(338, 26, 146, 'New appointment is booked.<br> Appointment number:<b> APT16 </b>', 0, NULL, '2018-07-01 18:10:44', 0),
(339, 39, 26, 'Your appointment <b>APT16</b> has been Approved', 1, NULL, '2018-07-02 01:47:47', 0),
(340, 39, 12, ' Appointment <b>APT16</b> has been Approved', 1, NULL, '2018-07-02 01:47:47', 0),
(341, 1, 174, 'Your appointment is booked.<br> Appointment number:<b> APT17 </b>', 0, NULL, '2018-07-02 10:28:31', 0),
(342, 1, 12, 'New appointment is booked.<br> Appointment number:<b> APT17 </b>', 1, NULL, '2018-07-02 10:28:31', 0),
(343, 1, 17, 'New appointment is booked.<br> Appointment number:<b> APT17 </b>', 0, NULL, '2018-07-02 10:28:31', 0),
(344, 1, 31, 'New appointment is booked.<br> Appointment number:<b> APT17 </b>', 0, NULL, '2018-07-02 10:28:31', 0),
(345, 1, 39, 'New appointment is booked.<br> Appointment number:<b> APT17 </b>', 1, NULL, '2018-07-02 10:28:31', 0),
(346, 1, 146, 'New appointment is booked.<br> Appointment number:<b> APT17 </b>', 0, NULL, '2018-07-02 10:28:31', 0),
(347, 39, 174, 'Your appointment <b>APT17</b> has been Rejected', 0, NULL, '2018-07-02 10:32:25', 0),
(348, 39, 12, ' Appointment <b>APT17</b> has been Rejected', 1, NULL, '2018-07-02 10:32:25', 0),
(349, 26, 12, 'New appointment is booked.<br> Appointment number:<b> APT18 </b>', 1, NULL, '2018-07-04 15:30:24', 0),
(350, 26, 17, 'New appointment is booked.<br> Appointment number:<b> APT18 </b>', 0, NULL, '2018-07-04 15:30:24', 0),
(351, 26, 31, 'New appointment is booked.<br> Appointment number:<b> APT18 </b>', 0, NULL, '2018-07-04 15:30:24', 0),
(352, 26, 39, 'New appointment is booked.<br> Appointment number:<b> APT18 </b>', 1, NULL, '2018-07-04 15:30:24', 0),
(353, 26, 146, 'New appointment is booked.<br> Appointment number:<b> APT18 </b>', 0, NULL, '2018-07-04 15:30:24', 0),
(354, 39, 26, 'Your appointment <b>APT18</b> has been Approved', 1, NULL, '2018-07-04 15:31:09', 0),
(355, 39, 12, ' Appointment <b>APT18</b> has been Approved', 1, NULL, '2018-07-04 15:31:09', 0),
(356, 26, 12, 'New appointment is booked.<br> Appointment number:<b> APT19 </b>', 1, NULL, '2018-07-05 16:15:43', 0),
(357, 26, 17, 'New appointment is booked.<br> Appointment number:<b> APT19 </b>', 0, NULL, '2018-07-05 16:15:43', 0),
(358, 26, 31, 'New appointment is booked.<br> Appointment number:<b> APT19 </b>', 0, NULL, '2018-07-05 16:15:43', 0),
(359, 26, 39, 'New appointment is booked.<br> Appointment number:<b> APT19 </b>', 1, NULL, '2018-07-05 16:15:43', 0),
(360, 26, 146, 'New appointment is booked.<br> Appointment number:<b> APT19 </b>', 0, NULL, '2018-07-05 16:15:43', 0),
(361, 26, 26, 'Your appointment <b>APT6</b> has been Cancelled', 1, NULL, '2018-07-05 16:16:08', 0),
(362, 26, 26, 'Your appointment <b>APT6</b> has been Cancelled', 1, NULL, '2018-07-05 16:16:20', 0),
(363, 26, 26, 'Your appointment <b>APT8</b> has been Cancelled', 1, NULL, '2018-07-05 16:16:20', 0),
(364, 26, 26, 'Your appointment <b>APT6</b> has been Cancelled', 1, NULL, '2018-07-05 16:17:08', 0),
(365, 26, 26, 'Your appointment <b>APT8</b> has been Cancelled', 1, NULL, '2018-07-05 16:17:08', 0),
(366, 26, 26, 'Your appointment <b>APT6</b> has been Cancelled', 1, NULL, '2018-07-05 16:17:23', 0),
(367, 26, 26, 'Your appointment <b>APT8</b> has been Cancelled', 1, NULL, '2018-07-05 16:17:40', 0),
(368, 26, 26, 'Your appointment <b>APT8</b> has been Cancelled', 1, NULL, '2018-07-05 16:18:02', 0),
(369, 1, 3, 'New ward <b>ward-1</b> is added in <b>Dept-1</b> department of <b>WB</b> branch', 1, NULL, '2018-07-05 17:17:17', 0),
(370, 26, 12, 'New appointment is booked.<br> Appointment number:<b> APT20 </b>', 1, NULL, '2018-07-07 06:32:45', 0),
(371, 26, 17, 'New appointment is booked.<br> Appointment number:<b> APT20 </b>', 0, NULL, '2018-07-07 06:32:45', 0),
(372, 26, 31, 'New appointment is booked.<br> Appointment number:<b> APT20 </b>', 0, NULL, '2018-07-07 06:32:45', 0),
(373, 26, 39, 'New appointment is booked.<br> Appointment number:<b> APT20 </b>', 1, NULL, '2018-07-07 06:32:45', 0),
(374, 26, 146, 'New appointment is booked.<br> Appointment number:<b> APT20 </b>', 0, NULL, '2018-07-07 06:32:45', 0),
(375, 39, 26, 'Remark added in your appointment: <b>APT20</b>', 1, NULL, '2018-07-07 06:45:36', 0),
(376, 39, 12, 'Remark added in appointment: <b>APT20</b>', 1, NULL, '2018-07-07 06:45:36', 0),
(377, 39, 26, 'Your appointment <b>APT20</b> has been Rejected', 1, NULL, '2018-07-07 06:46:41', 0),
(378, 39, 12, ' Appointment <b>APT20</b> has been Rejected', 1, NULL, '2018-07-07 06:46:41', 0),
(379, 26, 12, 'New appointment is booked.<br> Appointment number:<b> APT21 </b>', 1, NULL, '2018-07-07 06:48:23', 0),
(380, 26, 17, 'New appointment is booked.<br> Appointment number:<b> APT21 </b>', 0, NULL, '2018-07-07 06:48:23', 0),
(381, 26, 31, 'New appointment is booked.<br> Appointment number:<b> APT21 </b>', 0, NULL, '2018-07-07 06:48:23', 0),
(382, 26, 39, 'New appointment is booked.<br> Appointment number:<b> APT21 </b>', 1, NULL, '2018-07-07 06:48:23', 0),
(383, 26, 146, 'New appointment is booked.<br> Appointment number:<b> APT21 </b>', 0, NULL, '2018-07-07 06:48:23', 0),
(384, 12, 26, 'Your appointment <b>APT21</b> has been Approved', 0, NULL, '2018-07-07 08:22:22', 0),
(385, 12, 17, ' Appointment <b>APT21</b> has been Approved', 0, NULL, '2018-07-07 08:22:22', 0),
(386, 12, 31, ' Appointment <b>APT21</b> has been Approved', 0, NULL, '2018-07-07 08:22:22', 0),
(387, 12, 39, ' Appointment <b>APT21</b> has been Approved', 1, NULL, '2018-07-07 08:22:22', 0),
(388, 12, 146, ' Appointment <b>APT21</b> has been Approved', 0, NULL, '2018-07-07 08:22:22', 0),
(389, 12, 26, 'Recommned next appointment date added in you appointment <br>Appointment Number: <b>APT20</b>', 0, NULL, '2018-07-07 08:45:22', 0),
(390, 39, 12, 'Your new availability is added', 1, NULL, '2018-07-07 11:51:15', 0),
(391, 26, 12, 'New appointment is booked.<br> Appointment number:<b> APT22 </b>', 1, NULL, '2018-07-08 14:37:07', 0),
(392, 26, 17, 'New appointment is booked.<br> Appointment number:<b> APT22 </b>', 0, NULL, '2018-07-08 14:37:07', 0),
(393, 26, 31, 'New appointment is booked.<br> Appointment number:<b> APT22 </b>', 0, NULL, '2018-07-08 14:37:07', 0),
(394, 26, 39, 'New appointment is booked.<br> Appointment number:<b> APT22 </b>', 1, NULL, '2018-07-08 14:37:07', 0),
(395, 26, 146, 'New appointment is booked.<br> Appointment number:<b> APT22 </b>', 0, NULL, '2018-07-08 14:37:07', 0),
(396, 26, 26, 'Your appointment <b>APT22</b> has been Cancelled', 0, NULL, '2018-07-08 14:37:49', 0),
(397, 26, 26, 'Your appointment <b>APT22</b> has been Cancelled', 0, NULL, '2018-07-08 14:38:04', 0),
(398, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-07-10 09:44:18', 0),
(399, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-07-10 09:44:18', 0),
(400, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-07-10 09:44:18', 0),
(401, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-07-10 09:44:18', 0),
(402, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-07-10 09:53:04', 0),
(403, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-07-10 09:53:04', 0),
(404, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-07-10 09:53:04', 0),
(405, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-07-10 09:53:04', 0),
(406, 3, 178, 'You are linked with <b>Purus Corporation</b> hospital as Doctor', 0, NULL, '2018-07-11 16:18:46', 0),
(407, 3, 16, 'New doctor <b>sajid  s.p.</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-11 16:18:46', 0),
(408, 3, 20, 'New doctor <b>sajid  s.p.</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-11 16:18:46', 0),
(409, 3, 25, 'New doctor <b>sajid  s.p.</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-11 16:18:46', 0),
(410, 3, 178, 'Your new availability is added ', 0, NULL, '2018-07-11 16:22:47', 0),
(411, 177, 178, 'New appointment is booked.<br> Appointment number:<b> APT23 </b>', 0, NULL, '2018-07-11 16:34:01', 0),
(412, 3, 180, 'You are linked with <b>Purus Corporation</b> hospital as Doctor', 0, NULL, '2018-07-12 15:53:35', 0),
(413, 3, 16, 'New doctor <b>doctor one</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-12 15:53:35', 0),
(414, 3, 20, 'New doctor <b>doctor one</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-12 15:53:35', 0),
(415, 3, 25, 'New doctor <b>doctor one</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-12 15:53:35', 0),
(416, 3, 180, 'New receptionist <b>receptionist one</b> is linked with you', 0, NULL, '2018-07-13 02:20:56', 0),
(417, 3, 181, 'You are linked with <b>doctor one</b> doctor as Receptionist', 1, NULL, '2018-07-13 02:20:56', 0),
(418, 3, 180, 'Your Profile is updated', 0, NULL, '2018-07-13 03:50:17', 0),
(419, 180, 181, 'doctor one added new availability', 1, NULL, '2018-07-13 03:55:09', 0),
(420, 26, 180, 'New appointment is booked.<br> Appointment number:<b> APT24 </b>', 0, NULL, '2018-07-13 03:58:23', 0),
(421, 26, 181, 'New appointment is booked.<br> Appointment number:<b> APT24 </b>', 1, NULL, '2018-07-13 03:58:23', 0),
(422, 181, 26, 'Your appointment <b>APT24</b> has been Approved', 0, NULL, '2018-07-13 04:01:17', 0),
(423, 181, 180, ' Appointment <b>APT24</b> has been Approved', 0, NULL, '2018-07-13 04:01:17', 0),
(424, 181, 182, 'Your appointment is booked.<br> Appointment number:<b> APT25 </b>', 0, NULL, '2018-07-13 08:59:45', 0),
(425, 181, 180, 'New appointment is booked.<br> Appointment number:<b> APT25 </b>', 0, NULL, '2018-07-13 08:59:45', 0),
(426, 1, 183, 'You are linked with <b>Purus Corporation</b> hospital as Hospital admin', 0, NULL, '2018-07-14 04:46:04', 0),
(427, 1, 183, 'Your Profile is updated', 0, NULL, '2018-07-14 04:48:08', 0),
(428, 1, 183, 'Your profile is updated', 0, NULL, '2018-07-14 04:48:08', 0),
(429, 3, 185, 'You are linked with <b>Purus Corporation</b> hospital as Doctor', 0, NULL, '2018-07-15 07:32:30', 0),
(430, 3, 16, 'New doctor <b>sazeed sp</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-15 07:32:30', 0),
(431, 3, 20, 'New doctor <b>sazeed sp</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-15 07:32:30', 0),
(432, 3, 25, 'New doctor <b>sazeed sp</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-15 07:32:30', 0),
(433, 3, 186, 'You are linked with <b>Purus Corporation</b> hospital as Doctor', 0, NULL, '2018-07-15 08:08:13', 0),
(434, 3, 48, 'New doctor <b>sazeed P</b> is added in your department <b>Dept-2</b>', 0, NULL, '2018-07-15 08:08:13', 0),
(435, 26, 180, 'New appointment is booked.<br> Appointment number:<b> APT26 </b>', 0, NULL, '2018-07-17 13:09:58', 0),
(436, 26, 181, 'New appointment is booked.<br> Appointment number:<b> APT26 </b>', 1, NULL, '2018-07-17 13:09:58', 0),
(437, 12, 188, 'Your appointment is booked.<br> Appointment number:<b> APT27 </b>', 0, NULL, '2018-07-21 12:01:33', 0),
(438, 12, 17, 'New appointment is booked.<br> Appointment number:<b> APT27 </b>', 0, NULL, '2018-07-21 12:01:33', 0),
(439, 12, 31, 'New appointment is booked.<br> Appointment number:<b> APT27 </b>', 0, NULL, '2018-07-21 12:01:33', 0),
(440, 12, 39, 'New appointment is booked.<br> Appointment number:<b> APT27 </b>', 1, NULL, '2018-07-21 12:01:33', 0),
(441, 12, 146, 'New appointment is booked.<br> Appointment number:<b> APT27 </b>', 0, NULL, '2018-07-21 12:01:33', 0),
(442, 3, 189, 'You are linked with <b>Dr. Ravi Patel</b> doctor as Receptionist', 0, NULL, '2018-07-22 08:29:02', 0),
(443, 3, 189, 'You are linked with <b>Susma Mehta</b> doctor as Receptionist', 0, NULL, '2018-07-22 08:29:02', 0),
(444, 3, 189, 'You are linked with <b>doctor one</b> doctor as Receptionist', 0, NULL, '2018-07-22 08:29:02', 0),
(445, 3, 16, 'You are linked with <b>Dr. Ravi Patel</b> doctor as Receptionist', 0, NULL, '2018-07-22 08:35:00', 0),
(446, 3, 57, 'You are linked with <b>Dr. Ravi Patel</b> doctor as Receptionist', 0, NULL, '2018-07-22 09:18:41', 0),
(447, 3, 57, 'You are linked with <b>New </b> doctor as Receptionist', 0, NULL, '2018-07-22 09:18:41', 0),
(448, 3, 57, 'You are linked with <b>doctor one</b> doctor as Receptionist', 0, NULL, '2018-07-22 09:18:41', 0),
(449, 3, 17, 'You are linked with <b>Dr. Ravi Patel</b> doctor as Receptionist', 0, NULL, '2018-07-22 09:19:26', 0),
(450, 3, 17, 'You are linked with <b>Amit patel</b> doctor as Receptionist', 0, NULL, '2018-07-22 09:19:26', 0),
(451, 3, 17, 'You are linked with <b>First Last</b> doctor as Receptionist', 0, NULL, '2018-07-22 09:19:26', 0),
(452, 3, 25, 'You are linked with <b>Dr. Ravi Patel</b> doctor as Receptionist', 0, NULL, '2018-07-23 13:44:10', 0),
(453, 3, 25, 'You are linked with <b>First Last</b> doctor as Receptionist', 0, NULL, '2018-07-23 13:44:10', 0),
(454, 3, 25, 'You are linked with <b>doctor one</b> doctor as Receptionist', 0, NULL, '2018-07-23 13:44:10', 0),
(455, 3, 12, 'New receptionist <b>ravi  kolluru</b> is linked with you', 1, NULL, '2018-07-24 03:19:15', 0),
(456, 3, 191, 'You are linked with <b>Dr. Ravi Patel</b> doctor as Receptionist', 0, NULL, '2018-07-24 03:19:15', 0),
(457, 3, 148, 'New receptionist <b>ravi  kolluru</b> is linked with you', 0, NULL, '2018-07-24 03:19:15', 0),
(458, 3, 191, 'You are linked with <b>Amit patel</b> doctor as Receptionist', 0, NULL, '2018-07-24 03:19:15', 0),
(459, 3, 191, 'You are linked with <b>Amit patel</b> doctor as Receptionist', 0, NULL, '2018-07-24 03:20:29', 0),
(460, 184, 12, 'New appointment is booked.<br> Appointment number:<b> APT28 </b>', 1, NULL, '2018-07-24 14:12:38', 0),
(461, 184, 17, 'New appointment is booked.<br> Appointment number:<b> APT28 </b>', 0, NULL, '2018-07-24 14:12:38', 0),
(462, 184, 31, 'New appointment is booked.<br> Appointment number:<b> APT28 </b>', 0, NULL, '2018-07-24 14:12:38', 0),
(463, 184, 39, 'New appointment is booked.<br> Appointment number:<b> APT28 </b>', 1, NULL, '2018-07-24 14:12:38', 0),
(464, 184, 146, 'New appointment is booked.<br> Appointment number:<b> APT28 </b>', 0, NULL, '2018-07-24 14:12:38', 0),
(465, 26, 12, 'New appointment is booked.<br> Appointment number:<b> APT29 </b>', 1, NULL, '2018-07-24 14:26:42', 0),
(466, 26, 17, 'New appointment is booked.<br> Appointment number:<b> APT29 </b>', 0, NULL, '2018-07-24 14:26:42', 0),
(467, 26, 31, 'New appointment is booked.<br> Appointment number:<b> APT29 </b>', 0, NULL, '2018-07-24 14:26:42', 0),
(468, 26, 39, 'New appointment is booked.<br> Appointment number:<b> APT29 </b>', 1, NULL, '2018-07-24 14:26:42', 0),
(469, 26, 146, 'New appointment is booked.<br> Appointment number:<b> APT29 </b>', 0, NULL, '2018-07-24 14:26:42', 0),
(470, 12, 31, 'Your appointment <b>APT7</b> has been Approved', 0, NULL, '2018-07-24 16:44:59', 0),
(471, 12, 17, ' Appointment <b>APT7</b> has been Approved', 0, NULL, '2018-07-24 16:44:59', 0),
(472, 12, 31, ' Appointment <b>APT7</b> has been Approved', 0, NULL, '2018-07-24 16:44:59', 0),
(473, 12, 39, ' Appointment <b>APT7</b> has been Approved', 1, NULL, '2018-07-24 16:44:59', 0),
(474, 12, 146, ' Appointment <b>APT7</b> has been Approved', 0, NULL, '2018-07-24 16:44:59', 0),
(475, 12, 26, 'Your appointment <b>APT8</b> has been Approved', 0, NULL, '2018-07-24 16:45:03', 0),
(476, 12, 17, ' Appointment <b>APT8</b> has been Approved', 0, NULL, '2018-07-24 16:45:03', 0),
(477, 12, 31, ' Appointment <b>APT8</b> has been Approved', 0, NULL, '2018-07-24 16:45:03', 0),
(478, 12, 39, ' Appointment <b>APT8</b> has been Approved', 1, NULL, '2018-07-24 16:45:03', 0),
(479, 12, 146, ' Appointment <b>APT8</b> has been Approved', 0, NULL, '2018-07-24 16:45:03', 0),
(480, 12, 26, 'Your appointment <b>APT8</b> has been Approved', 0, NULL, '2018-07-24 16:45:14', 0),
(481, 12, 17, ' Appointment <b>APT8</b> has been Approved', 0, NULL, '2018-07-24 16:45:14', 0),
(482, 12, 31, ' Appointment <b>APT8</b> has been Approved', 0, NULL, '2018-07-24 16:45:14', 0),
(483, 12, 39, ' Appointment <b>APT8</b> has been Approved', 1, NULL, '2018-07-24 16:45:14', 0),
(484, 12, 146, ' Appointment <b>APT8</b> has been Approved', 0, NULL, '2018-07-24 16:45:14', 0),
(485, 12, 31, 'Your appointment <b>APT7</b> has been Approved', 0, NULL, '2018-07-24 16:45:24', 0),
(486, 12, 17, ' Appointment <b>APT7</b> has been Approved', 0, NULL, '2018-07-24 16:45:24', 0),
(487, 12, 31, ' Appointment <b>APT7</b> has been Approved', 0, NULL, '2018-07-24 16:45:24', 0);
INSERT INTO `hms_notification` (`id`, `created_by`, `user_id`, `text`, `isRead`, `action`, `created_date`, `isDeleted`) VALUES
(488, 12, 39, ' Appointment <b>APT7</b> has been Approved', 1, NULL, '2018-07-24 16:45:24', 0),
(489, 12, 146, ' Appointment <b>APT7</b> has been Approved', 0, NULL, '2018-07-24 16:45:24', 0),
(490, 12, 26, 'Your appointment <b>APT8</b> has been Rejected', 0, NULL, '2018-07-24 16:45:30', 0),
(491, 12, 17, ' Appointment <b>APT8</b> has been Rejected', 0, NULL, '2018-07-24 16:45:30', 0),
(492, 12, 31, ' Appointment <b>APT8</b> has been Rejected', 0, NULL, '2018-07-24 16:45:30', 0),
(493, 12, 39, ' Appointment <b>APT8</b> has been Rejected', 1, NULL, '2018-07-24 16:45:30', 0),
(494, 12, 146, ' Appointment <b>APT8</b> has been Rejected', 0, NULL, '2018-07-24 16:45:30', 0),
(495, 188, 12, 'New appointment is booked.<br> Appointment number:<b> APT30 </b>', 1, NULL, '2018-07-25 02:28:41', 0),
(496, 188, 17, 'New appointment is booked.<br> Appointment number:<b> APT30 </b>', 0, NULL, '2018-07-25 02:28:41', 0),
(497, 188, 31, 'New appointment is booked.<br> Appointment number:<b> APT30 </b>', 0, NULL, '2018-07-25 02:28:41', 0),
(498, 188, 39, 'New appointment is booked.<br> Appointment number:<b> APT30 </b>', 1, NULL, '2018-07-25 02:28:41', 0),
(499, 188, 146, 'New appointment is booked.<br> Appointment number:<b> APT30 </b>', 0, NULL, '2018-07-25 02:28:41', 0),
(500, 188, 188, 'Your appointment <b>APT27</b> has been Cancelled', 0, NULL, '2018-07-25 02:28:51', 0),
(501, 188, 188, 'Your appointment <b>APT27</b> has been Cancelled', 0, NULL, '2018-07-25 02:29:03', 0),
(502, 188, 188, 'Your appointment <b>APT27</b> has been Cancelled', 0, NULL, '2018-07-25 02:29:32', 0),
(503, 39, 184, 'Your appointment <b>APT28</b> has been Rejected', 0, NULL, '2018-07-25 02:31:10', 0),
(504, 39, 12, ' Appointment <b>APT28</b> has been Rejected', 1, NULL, '2018-07-25 02:31:10', 0),
(505, 3, 181, 'You are linked with <b>Dr. Ravi Patel</b> doctor as Receptionist', 1, NULL, '2018-07-25 07:11:51', 0),
(506, 3, 181, 'You are linked with <b>Susma Mehta</b> doctor as Receptionist', 1, NULL, '2018-07-25 07:11:51', 0),
(507, 3, 181, 'You are linked with <b>doctor one</b> doctor as Receptionist', 1, NULL, '2018-07-25 07:11:51', 0),
(508, 3, 12, 'Your Profile is updated', 1, NULL, '2018-07-25 15:55:11', 0),
(509, 3, 193, 'You are linked with <b>Purus Corporation</b> hospital as Doctor', 0, NULL, '2018-07-25 15:58:50', 0),
(510, 3, 16, 'New doctor <b>multi specialization</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-25 15:58:50', 0),
(511, 3, 20, 'New doctor <b>multi specialization</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-25 15:58:50', 0),
(512, 3, 57, 'New doctor <b>multi specialization</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-25 15:58:50', 0),
(513, 3, 25, 'New doctor <b>multi specialization</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-25 15:58:50', 0),
(514, 3, 189, 'New doctor <b>multi specialization</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-25 15:58:50', 0),
(515, 3, 189, 'New doctor <b>multi specialization</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-25 15:58:50', 0),
(516, 3, 189, 'New doctor <b>multi specialization</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-25 15:58:50', 0),
(517, 3, 57, 'New doctor <b>multi specialization</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-25 15:58:50', 0),
(518, 3, 57, 'New doctor <b>multi specialization</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-25 15:58:50', 0),
(519, 3, 25, 'New doctor <b>multi specialization</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-25 15:58:50', 0),
(520, 3, 25, 'New doctor <b>multi specialization</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-25 15:58:50', 0),
(521, 3, 190, 'New doctor <b>multi specialization</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-25 15:58:50', 0),
(522, 3, 190, 'New doctor <b>multi specialization</b> is added in your department <b>Dept-1</b>', 0, NULL, '2018-07-25 15:58:50', 0),
(523, 3, 193, 'Your Profile is updated', 0, NULL, '2018-07-25 15:59:35', 0),
(524, 3, 31, 'You are linked with <b>Dr. Ravi Patel</b> doctor as Receptionist', 0, NULL, '2018-07-26 02:52:18', 0),
(525, 3, 12, 'Your Profile is updated', 1, NULL, '2018-07-26 17:15:46', 0),
(526, 3, 39, 'You are linked with <b>multi specialization</b> doctor as Receptionist', 1, NULL, '2018-07-27 02:19:40', 0),
(527, 12, 194, 'Your appointment is booked.<br> Appointment number:<b> APT31 </b>', 0, NULL, '2018-07-30 00:33:37', 0),
(528, 12, 17, 'New appointment is booked.<br> Appointment number:<b> APT31 </b>', 0, NULL, '2018-07-30 00:33:37', 0),
(529, 12, 31, 'New appointment is booked.<br> Appointment number:<b> APT31 </b>', 0, NULL, '2018-07-30 00:33:37', 0),
(530, 12, 146, 'New appointment is booked.<br> Appointment number:<b> APT31 </b>', 0, NULL, '2018-07-30 00:33:37', 0),
(531, 12, 181, 'New appointment is booked.<br> Appointment number:<b> APT31 </b>', 1, NULL, '2018-07-30 00:33:37', 0),
(532, 12, 194, 'Your appointment <b>APT31</b> has been Approved', 0, NULL, '2018-07-30 00:39:14', 0),
(533, 12, 17, ' Appointment <b>APT31</b> has been Approved', 0, NULL, '2018-07-30 00:39:14', 0),
(534, 12, 31, ' Appointment <b>APT31</b> has been Approved', 0, NULL, '2018-07-30 00:39:14', 0),
(535, 12, 146, ' Appointment <b>APT31</b> has been Approved', 0, NULL, '2018-07-30 00:39:14', 0),
(536, 12, 181, ' Appointment <b>APT31</b> has been Approved', 1, NULL, '2018-07-30 00:39:14', 0),
(537, 12, 194, 'Recommned next appointment date added in you appointment <br>Appointment Number: <b>APT31</b>', 0, NULL, '2018-07-30 00:54:48', 0),
(538, 26, 12, 'New appointment is booked.<br> Appointment number:<b> APT32 </b>', 1, NULL, '2018-07-30 03:20:26', 0),
(539, 26, 17, 'New appointment is booked.<br> Appointment number:<b> APT32 </b>', 0, NULL, '2018-07-30 03:20:26', 0),
(540, 26, 31, 'New appointment is booked.<br> Appointment number:<b> APT32 </b>', 0, NULL, '2018-07-30 03:20:26', 0),
(541, 26, 146, 'New appointment is booked.<br> Appointment number:<b> APT32 </b>', 0, NULL, '2018-07-30 03:20:26', 0),
(542, 26, 181, 'New appointment is booked.<br> Appointment number:<b> APT32 </b>', 1, NULL, '2018-07-30 03:20:26', 0),
(543, 12, 188, 'Your appointment is booked.<br> Appointment number:<b> APT33 </b>', 0, NULL, '2018-07-31 02:25:27', 0),
(544, 12, 17, 'New appointment is booked.<br> Appointment number:<b> APT33 </b>', 0, NULL, '2018-07-31 02:25:27', 0),
(545, 12, 31, 'New appointment is booked.<br> Appointment number:<b> APT33 </b>', 0, NULL, '2018-07-31 02:25:27', 0),
(546, 12, 146, 'New appointment is booked.<br> Appointment number:<b> APT33 </b>', 0, NULL, '2018-07-31 02:25:27', 0),
(547, 12, 181, 'New appointment is booked.<br> Appointment number:<b> APT33 </b>', 1, NULL, '2018-07-31 02:25:27', 0),
(548, 12, 26, 'Your appointment is booked.<br> Appointment number:<b> APT34 </b>', 0, NULL, '2018-08-01 02:23:24', 0),
(549, 12, 17, 'New appointment is booked.<br> Appointment number:<b> APT34 </b>', 0, NULL, '2018-08-01 02:23:24', 0),
(550, 12, 31, 'New appointment is booked.<br> Appointment number:<b> APT34 </b>', 0, NULL, '2018-08-01 02:23:24', 0),
(551, 12, 146, 'New appointment is booked.<br> Appointment number:<b> APT34 </b>', 0, NULL, '2018-08-01 02:23:24', 0),
(552, 12, 181, 'New appointment is booked.<br> Appointment number:<b> APT34 </b>', 1, NULL, '2018-08-01 02:23:24', 0),
(553, 3, 39, 'You are linked with <b>Dr. Ravi Patel</b> doctor as Receptionist', 1, NULL, '2018-08-03 01:09:15', 0),
(554, 12, 17, 'Dr. Ravi Patel Other settings regarding availability is updated', 0, NULL, '2018-08-03 01:21:42', 0),
(555, 12, 31, 'Dr. Ravi Patel Other settings regarding availability is updated', 0, NULL, '2018-08-03 01:21:42', 0),
(556, 12, 39, 'Dr. Ravi Patel Other settings regarding availability is updated', 1, NULL, '2018-08-03 01:21:42', 0),
(557, 12, 146, 'Dr. Ravi Patel Other settings regarding availability is updated', 0, NULL, '2018-08-03 01:21:42', 0),
(558, 12, 181, 'Dr. Ravi Patel Other settings regarding availability is updated', 1, NULL, '2018-08-03 01:21:42', 0),
(559, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 01:23:07', 0),
(560, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 01:23:07', 0),
(561, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 01:23:07', 0),
(562, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 01:23:07', 0),
(563, 12, 181, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 01:23:07', 0),
(564, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 01:23:07', 0),
(565, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 01:23:07', 0),
(566, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 01:23:07', 0),
(567, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 01:23:07', 0),
(568, 12, 181, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 01:23:07', 0),
(569, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 01:23:07', 0),
(570, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 01:23:07', 0),
(571, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 01:23:07', 0),
(572, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 01:23:07', 0),
(573, 12, 181, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 01:23:07', 0),
(574, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 01:23:07', 0),
(575, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 01:23:07', 0),
(576, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 01:23:07', 0),
(577, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 01:23:07', 0),
(578, 12, 181, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 01:23:07', 0),
(579, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 01:23:07', 0),
(580, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 01:23:07', 0),
(581, 12, 39, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 01:23:07', 0),
(582, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 01:23:07', 0),
(583, 12, 181, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 01:23:07', 0),
(584, 39, 187, 'Your appointment is booked.<br> Appointment number:<b> APT1 </b>', 0, NULL, '2018-08-03 01:54:06', 0),
(585, 39, 12, 'New appointment is booked.<br> Appointment number:<b> APT1 </b>', 1, NULL, '2018-08-03 01:54:06', 0),
(586, 3, 12, 'Your Profile is updated', 1, NULL, '2018-08-03 02:26:50', 0),
(587, 12, 187, 'Recommned next appointment date added in you appointment <br>Appointment Number: <b>APT1</b>', 0, NULL, '2018-08-03 02:53:12', 0),
(588, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 03:30:23', 0),
(589, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 03:30:23', 0),
(590, 12, 39, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 03:30:23', 0),
(591, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 03:30:23', 0),
(592, 12, 181, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 03:30:23', 0),
(593, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 03:30:23', 0),
(594, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 03:30:23', 0),
(595, 12, 39, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 03:30:23', 0),
(596, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 03:30:23', 0),
(597, 12, 181, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 03:30:23', 0),
(598, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 03:53:18', 0),
(599, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 03:53:18', 0),
(600, 12, 39, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 03:53:18', 0),
(601, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 03:53:18', 0),
(602, 12, 181, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 03:53:18', 0),
(603, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 03:54:47', 0),
(604, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 03:54:47', 0),
(605, 12, 39, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 03:54:47', 0),
(606, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 03:54:47', 0),
(607, 12, 181, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 03:54:47', 0),
(608, 12, 17, 'Dr. Ravi Patel Other settings regarding availability is updated', 0, NULL, '2018-08-03 03:58:38', 0),
(609, 12, 31, 'Dr. Ravi Patel Other settings regarding availability is updated', 0, NULL, '2018-08-03 03:58:38', 0),
(610, 12, 39, 'Dr. Ravi Patel Other settings regarding availability is updated', 0, NULL, '2018-08-03 03:58:38', 0),
(611, 12, 146, 'Dr. Ravi Patel Other settings regarding availability is updated', 0, NULL, '2018-08-03 03:58:38', 0),
(612, 12, 181, 'Dr. Ravi Patel Other settings regarding availability is updated', 1, NULL, '2018-08-03 03:58:38', 0),
(613, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:05:51', 0),
(614, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:05:51', 0),
(615, 12, 39, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:05:51', 0),
(616, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:05:51', 0),
(617, 12, 181, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 04:05:51', 0),
(618, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:05:51', 0),
(619, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:05:51', 0),
(620, 12, 39, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:05:51', 0),
(621, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:05:51', 0),
(622, 12, 181, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 04:05:51', 0),
(623, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:05:51', 0),
(624, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:05:51', 0),
(625, 12, 39, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:05:51', 0),
(626, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:05:51', 0),
(627, 12, 181, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 04:05:51', 0),
(628, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:05:51', 0),
(629, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:05:51', 0),
(630, 12, 39, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:05:51', 0),
(631, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:05:51', 0),
(632, 12, 181, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 04:05:51', 0),
(633, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:05:51', 0),
(634, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:05:51', 0),
(635, 12, 39, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:05:51', 0),
(636, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:05:51', 0),
(637, 12, 181, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 04:05:51', 0),
(638, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:07:21', 0),
(639, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:07:21', 0),
(640, 12, 39, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:07:21', 0),
(641, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:07:21', 0),
(642, 12, 181, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 04:07:21', 0),
(643, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:07:21', 0),
(644, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:07:21', 0),
(645, 12, 39, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:07:21', 0),
(646, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:07:21', 0),
(647, 12, 181, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 04:07:21', 0),
(648, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:13:40', 0),
(649, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:13:40', 0),
(650, 12, 39, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:13:40', 0),
(651, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-03 04:13:40', 0),
(652, 12, 181, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-03 04:13:40', 0),
(653, 12, 26, 'Your appointment is booked.<br> Appointment number:<b> APT2 </b>', 0, NULL, '2018-08-03 10:31:30', 0),
(654, 12, 17, 'New appointment is booked.<br> Appointment number:<b> APT2 </b>', 0, NULL, '2018-08-03 10:31:30', 0),
(655, 12, 31, 'New appointment is booked.<br> Appointment number:<b> APT2 </b>', 0, NULL, '2018-08-03 10:31:30', 0),
(656, 12, 39, 'New appointment is booked.<br> Appointment number:<b> APT2 </b>', 0, NULL, '2018-08-03 10:31:30', 0),
(657, 12, 146, 'New appointment is booked.<br> Appointment number:<b> APT2 </b>', 0, NULL, '2018-08-03 10:31:30', 0),
(658, 12, 181, 'New appointment is booked.<br> Appointment number:<b> APT2 </b>', 1, NULL, '2018-08-03 10:31:30', 0),
(659, 12, 26, 'Your appointment <b>APT2</b> has been Rejected', 0, NULL, '2018-08-03 10:32:45', 0),
(660, 12, 17, ' Appointment <b>APT2</b> has been Rejected', 0, NULL, '2018-08-03 10:32:45', 0),
(661, 12, 31, ' Appointment <b>APT2</b> has been Rejected', 0, NULL, '2018-08-03 10:32:45', 0),
(662, 12, 39, ' Appointment <b>APT2</b> has been Rejected', 0, NULL, '2018-08-03 10:32:45', 0),
(663, 12, 146, ' Appointment <b>APT2</b> has been Rejected', 0, NULL, '2018-08-03 10:32:45', 0),
(664, 12, 181, ' Appointment <b>APT2</b> has been Rejected', 1, NULL, '2018-08-03 10:32:45', 0),
(665, 12, 26, 'Your appointment <b>APT2</b> has been Confirmed', 0, NULL, '2018-08-03 10:33:21', 0),
(666, 12, 17, ' Appointment <b>APT2</b> has been Confirmed', 0, NULL, '2018-08-03 10:33:21', 0),
(667, 12, 31, ' Appointment <b>APT2</b> has been Confirmed', 0, NULL, '2018-08-03 10:33:21', 0),
(668, 12, 39, ' Appointment <b>APT2</b> has been Confirmed', 0, NULL, '2018-08-03 10:33:21', 0),
(669, 12, 146, ' Appointment <b>APT2</b> has been Confirmed', 0, NULL, '2018-08-03 10:33:21', 0),
(670, 12, 181, ' Appointment <b>APT2</b> has been Confirmed', 1, NULL, '2018-08-03 10:33:21', 0),
(671, 12, 26, 'Recommned next appointment date added in you appointment <br>Appointment Number: <b>APT2</b>', 0, NULL, '2018-08-03 10:33:51', 0),
(672, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-04 13:50:56', 0),
(673, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-04 13:50:56', 0),
(674, 12, 39, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-04 13:50:56', 0),
(675, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-04 13:50:56', 0),
(676, 12, 181, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-04 13:50:56', 0),
(677, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-04 13:50:56', 0),
(678, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-04 13:50:56', 0),
(679, 12, 39, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-04 13:50:56', 0),
(680, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-04 13:50:56', 0),
(681, 12, 181, 'Dr. Ravi Patel added new availability', 1, NULL, '2018-08-04 13:50:56', 0),
(682, 3, 12, 'New receptionist <b>test front desk</b> is linked with you', 1, NULL, '2018-08-07 17:47:06', 0),
(683, 3, 195, 'You are linked with <b>Dr. Ravi Patel</b> doctor as Receptionist', 0, NULL, '2018-08-07 17:47:06', 0),
(684, 3, 23, 'New receptionist <b>test front desk</b> is linked with you', 0, NULL, '2018-08-07 17:47:06', 0),
(685, 3, 195, 'You are linked with <b>Susma Mehta</b> doctor as Receptionist', 0, NULL, '2018-08-07 17:47:06', 0),
(686, 3, 148, 'New receptionist <b>test front desk</b> is linked with you', 0, NULL, '2018-08-07 17:47:06', 0),
(687, 3, 195, 'You are linked with <b>Amit patel</b> doctor as Receptionist', 0, NULL, '2018-08-07 17:47:06', 0),
(688, 3, 164, 'New receptionist <b>test front desk</b> is linked with you', 0, NULL, '2018-08-07 17:47:06', 0),
(689, 3, 195, 'You are linked with <b>First Last</b> doctor as Receptionist', 0, NULL, '2018-08-07 17:47:06', 0),
(690, 3, 180, 'New receptionist <b>test front desk</b> is linked with you', 0, NULL, '2018-08-07 17:47:06', 0),
(691, 3, 195, 'You are linked with <b>doctor one</b> doctor as Receptionist', 0, NULL, '2018-08-07 17:47:06', 0),
(692, 3, 186, 'New receptionist <b>test front desk</b> is linked with you', 0, NULL, '2018-08-07 17:47:06', 0),
(693, 3, 195, 'You are linked with <b>sazeed P</b> doctor as Receptionist', 0, NULL, '2018-08-07 17:47:06', 0),
(694, 3, 193, 'New receptionist <b>test front desk</b> is linked with you', 0, NULL, '2018-08-07 17:47:06', 0),
(695, 3, 195, 'You are linked with <b>multi specialization</b> doctor as Receptionist', 0, NULL, '2018-08-07 17:47:06', 0),
(696, 3, 195, 'You are linked with <b>Dr. Ravi Patel</b> doctor as Receptionist', 0, NULL, '2018-08-07 17:48:38', 0),
(697, 3, 195, 'You are linked with <b>Susma Mehta</b> doctor as Receptionist', 0, NULL, '2018-08-07 17:48:38', 0),
(698, 3, 195, 'You are linked with <b>Amit patel</b> doctor as Receptionist', 0, NULL, '2018-08-07 17:48:38', 0),
(699, 3, 195, 'You are linked with <b>multi specialization</b> doctor as Receptionist', 0, NULL, '2018-08-07 17:48:38', 0),
(700, 39, 187, 'Your appointment is booked.<br> Appointment number:<b> APT3 </b>', 0, NULL, '2018-08-07 17:52:42', 0),
(701, 39, 12, 'New appointment is booked.<br> Appointment number:<b> APT3 </b>', 1, NULL, '2018-08-07 17:52:42', 0),
(702, 26, 12, 'New appointment is booked.<br> Appointment number:<b> APT4 </b>', 1, NULL, '2018-08-07 18:14:13', 0),
(703, 26, 17, 'New appointment is booked.<br> Appointment number:<b> APT4 </b>', 0, NULL, '2018-08-07 18:14:13', 0),
(704, 26, 31, 'New appointment is booked.<br> Appointment number:<b> APT4 </b>', 0, NULL, '2018-08-07 18:14:13', 0),
(705, 26, 39, 'New appointment is booked.<br> Appointment number:<b> APT4 </b>', 0, NULL, '2018-08-07 18:14:13', 0),
(706, 26, 146, 'New appointment is booked.<br> Appointment number:<b> APT4 </b>', 0, NULL, '2018-08-07 18:14:13', 0),
(707, 26, 181, 'New appointment is booked.<br> Appointment number:<b> APT4 </b>', 1, NULL, '2018-08-07 18:14:13', 0),
(708, 26, 195, 'New appointment is booked.<br> Appointment number:<b> APT4 </b>', 0, NULL, '2018-08-07 18:14:13', 0),
(709, 3, 12, 'New receptionist <b>ab ef</b> is linked with you', 1, NULL, '2018-08-07 18:41:00', 0),
(710, 3, 197, 'You are linked with <b>Dr. Ravi Patel</b> doctor as Receptionist', 0, NULL, '2018-08-07 18:41:00', 0),
(711, 3, 23, 'New receptionist <b>ab ef</b> is linked with you', 0, NULL, '2018-08-07 18:41:00', 0),
(712, 3, 197, 'You are linked with <b>Susma Mehta</b> doctor as Receptionist', 0, NULL, '2018-08-07 18:41:00', 0),
(713, 3, 148, 'New receptionist <b>ab ef</b> is linked with you', 0, NULL, '2018-08-07 18:41:00', 0),
(714, 3, 197, 'You are linked with <b>Amit patel</b> doctor as Receptionist', 0, NULL, '2018-08-07 18:41:00', 0),
(715, 12, 198, 'Your appointment is booked.<br> Appointment number:<b> APT5 </b>', 0, NULL, '2018-08-08 02:49:14', 0),
(716, 12, 17, 'New appointment is booked.<br> Appointment number:<b> APT5 </b>', 0, NULL, '2018-08-08 02:49:14', 0),
(717, 12, 31, 'New appointment is booked.<br> Appointment number:<b> APT5 </b>', 0, NULL, '2018-08-08 02:49:14', 0),
(718, 12, 39, 'New appointment is booked.<br> Appointment number:<b> APT5 </b>', 0, NULL, '2018-08-08 02:49:14', 0),
(719, 12, 146, 'New appointment is booked.<br> Appointment number:<b> APT5 </b>', 0, NULL, '2018-08-08 02:49:14', 0),
(720, 12, 181, 'New appointment is booked.<br> Appointment number:<b> APT5 </b>', 1, NULL, '2018-08-08 02:49:14', 0),
(721, 12, 197, 'New appointment is booked.<br> Appointment number:<b> APT5 </b>', 0, NULL, '2018-08-08 02:49:14', 0),
(722, 12, 195, 'New appointment is booked.<br> Appointment number:<b> APT5 </b>', 0, NULL, '2018-08-08 02:49:14', 0),
(723, 39, 12, 'Your new availability is added', 1, NULL, '2018-08-08 03:16:05', 0),
(724, 39, 12, 'Your new availability is added', 1, NULL, '2018-08-08 03:16:05', 0),
(725, 39, 12, 'Your new availability is added', 1, NULL, '2018-08-08 03:16:05', 0),
(726, 39, 12, 'Your new availability is added', 1, NULL, '2018-08-08 03:16:05', 0),
(727, 39, 12, 'Your new availability is added', 1, NULL, '2018-08-08 03:16:05', 0),
(728, 39, 12, 'Your new availability is added', 1, NULL, '2018-08-08 03:16:05', 0),
(729, 39, 12, 'Your new availability is added', 1, NULL, '2018-08-08 03:18:08', 0),
(730, 39, 12, 'Your new availability is added', 1, NULL, '2018-08-08 03:24:10', 0),
(731, 39, 12, 'Your new availability is added', 1, NULL, '2018-08-08 03:27:14', 0),
(732, 39, 12, 'Your new availability is added', 1, NULL, '2018-08-08 03:33:18', 0),
(733, 39, 12, 'Your new availability is added', 1, NULL, '2018-08-08 03:33:18', 0),
(734, 39, 12, 'Your new availability is added', 1, NULL, '2018-08-08 03:33:18', 0),
(735, 39, 12, 'Your new availability is added', 1, NULL, '2018-08-08 03:33:18', 0),
(736, 39, 12, 'Your new availability is added', 1, NULL, '2018-08-08 03:33:18', 0),
(737, 39, 12, 'Your new availability is added', 1, NULL, '2018-08-08 03:33:51', 0),
(738, 39, 12, 'Your new availability is added', 1, NULL, '2018-08-08 03:33:51', 0),
(739, 3, 181, 'You are linked with <b>Dr. Ravi Patel</b> doctor as Receptionist', 1, NULL, '2018-08-08 05:09:51', 0),
(740, 3, 181, 'You are linked with <b>First Last</b> doctor as Receptionist', 1, NULL, '2018-08-08 05:09:51', 0),
(741, 3, 181, 'You are linked with <b>doctor one</b> doctor as Receptionist', 1, NULL, '2018-08-08 05:09:51', 0),
(742, 3, 181, 'You are linked with <b>sazeed P</b> doctor as Receptionist', 1, NULL, '2018-08-08 05:09:51', 0),
(743, 3, 39, 'You are linked with <b>Susma Mehta</b> doctor as Receptionist', 0, NULL, '2018-08-08 05:12:58', 0),
(744, 3, 181, 'You are linked with <b>Susma Mehta</b> doctor as Receptionist', 1, NULL, '2018-08-08 05:13:34', 0),
(745, 3, 181, 'You are linked with <b>Dr. Ravi Patel</b> doctor as Receptionist', 1, NULL, '2018-08-08 05:14:03', 0),
(746, 3, 181, 'You are linked with <b>First Last</b> doctor as Receptionist', 1, NULL, '2018-08-08 05:14:03', 0),
(747, 3, 181, 'You are linked with <b>doctor one</b> doctor as Receptionist', 1, NULL, '2018-08-08 05:14:03', 0),
(748, 3, 181, 'You are linked with <b>sazeed P</b> doctor as Receptionist', 1, NULL, '2018-08-08 05:14:03', 0),
(749, 3, 181, 'You are linked with <b>Dr. Ravi Patel</b> doctor as Receptionist', 1, NULL, '2018-08-08 05:24:47', 0),
(750, 3, 181, 'You are linked with <b>First Last</b> doctor as Receptionist', 1, NULL, '2018-08-08 05:24:47', 0),
(751, 3, 181, 'You are linked with <b>doctor one</b> doctor as Receptionist', 1, NULL, '2018-08-08 05:24:47', 0),
(752, 3, 181, 'You are linked with <b>sazeed P</b> doctor as Receptionist', 1, NULL, '2018-08-08 05:24:47', 0),
(753, 181, 12, 'Your new availability is added', 1, NULL, '2018-08-08 05:38:53', 0),
(754, 3, 181, 'You are linked with <b>Dr. Ravi Patel</b> doctor as Receptionist', 1, NULL, '2018-08-08 12:42:08', 0),
(755, 3, 181, 'You are linked with <b>Susma Mehta</b> doctor as Receptionist', 1, NULL, '2018-08-08 12:42:08', 0),
(756, 3, 181, 'You are linked with <b>Dr. Ravi Patel</b> doctor as Receptionist', 1, NULL, '2018-08-08 12:47:36', 0),
(757, 3, 181, 'You are linked with <b>Susma Mehta</b> doctor as Receptionist', 1, NULL, '2018-08-08 12:47:36', 0),
(758, 3, 181, 'You are linked with <b>Amit patel</b> doctor as Receptionist', 1, NULL, '2018-08-08 12:47:36', 0),
(759, 3, 181, 'You are linked with <b>First Last</b> doctor as Receptionist', 1, NULL, '2018-08-08 12:47:36', 0),
(760, 3, 181, 'You are linked with <b>doctor one</b> doctor as Receptionist', 1, NULL, '2018-08-08 12:47:36', 0),
(761, 3, 181, 'You are linked with <b>sazeed P</b> doctor as Receptionist', 1, NULL, '2018-08-08 12:47:36', 0),
(762, 3, 181, 'You are linked with <b>multi specialization</b> doctor as Receptionist', 1, NULL, '2018-08-08 12:47:36', 0),
(763, 26, 12, 'New appointment is booked.<br> Appointment number:<b> APT6 </b>', 0, NULL, '2018-08-08 17:27:47', 0),
(764, 26, 17, 'New appointment is booked.<br> Appointment number:<b> APT6 </b>', 0, NULL, '2018-08-08 17:27:47', 0),
(765, 26, 31, 'New appointment is booked.<br> Appointment number:<b> APT6 </b>', 0, NULL, '2018-08-08 17:27:47', 0),
(766, 26, 146, 'New appointment is booked.<br> Appointment number:<b> APT6 </b>', 0, NULL, '2018-08-08 17:27:47', 0),
(767, 26, 197, 'New appointment is booked.<br> Appointment number:<b> APT6 </b>', 0, NULL, '2018-08-08 17:27:47', 0),
(768, 26, 195, 'New appointment is booked.<br> Appointment number:<b> APT6 </b>', 0, NULL, '2018-08-08 17:27:47', 0),
(769, 26, 181, 'New appointment is booked.<br> Appointment number:<b> APT6 </b>', 0, NULL, '2018-08-08 17:27:47', 0),
(770, 12, 26, 'Recommned next appointment date added in you appointment <br>Appointment Number: <b>APT6</b>', 0, NULL, '2018-08-08 17:30:10', 0),
(771, 1, 199, 'You are linked with <b>Purus Corporation</b> hospital as Hospital admin', 0, NULL, '2018-08-11 02:50:24', 0),
(772, 3, 181, 'You are linked with <b>Dr. Ravi Patel</b> doctor as Receptionist', 0, NULL, '2018-08-12 06:14:20', 0),
(773, 3, 181, 'You are linked with <b>Susma Mehta</b> doctor as Receptionist', 0, NULL, '2018-08-12 06:14:20', 0),
(774, 3, 181, 'You are linked with <b>Amit patel</b> doctor as Receptionist', 0, NULL, '2018-08-12 06:14:20', 0),
(775, 3, 25, 'You are linked with <b>Dr. Ravi Patel</b> doctor as Receptionist', 0, NULL, '2018-08-13 02:33:36', 0),
(776, 3, 25, 'You are linked with <b>Susma Mehta</b> doctor as Receptionist', 0, NULL, '2018-08-13 02:33:36', 0),
(777, 3, 25, 'You are linked with <b>sazeed P</b> doctor as Receptionist', 0, NULL, '2018-08-13 02:33:36', 0),
(778, 3, 25, 'You are linked with <b>Dr. Ravi Patel</b> doctor as Receptionist', 0, NULL, '2018-08-13 02:36:12', 0),
(779, 3, 25, 'You are linked with <b>Susma Mehta</b> doctor as Receptionist', 0, NULL, '2018-08-13 02:36:12', 0),
(780, 3, 25, 'You are linked with <b>sazeed P</b> doctor as Receptionist', 0, NULL, '2018-08-13 02:36:12', 0),
(781, 1, 187, 'Your appointment is booked.<br> Appointment number:<b> APT7 </b>', 0, NULL, '2018-08-13 02:37:31', 0),
(782, 1, 12, 'New appointment is booked.<br> Appointment number:<b> APT7 </b>', 0, NULL, '2018-08-13 02:37:31', 0),
(783, 1, 17, 'New appointment is booked.<br> Appointment number:<b> APT7 </b>', 0, NULL, '2018-08-13 02:37:31', 0),
(784, 1, 31, 'New appointment is booked.<br> Appointment number:<b> APT7 </b>', 0, NULL, '2018-08-13 02:37:31', 0),
(785, 1, 146, 'New appointment is booked.<br> Appointment number:<b> APT7 </b>', 0, NULL, '2018-08-13 02:37:31', 0),
(786, 1, 197, 'New appointment is booked.<br> Appointment number:<b> APT7 </b>', 0, NULL, '2018-08-13 02:37:31', 0),
(787, 1, 195, 'New appointment is booked.<br> Appointment number:<b> APT7 </b>', 0, NULL, '2018-08-13 02:37:31', 0),
(788, 1, 181, 'New appointment is booked.<br> Appointment number:<b> APT7 </b>', 0, NULL, '2018-08-13 02:37:31', 0),
(789, 3, 188, 'Your appointment is booked.<br> Appointment number:<b> APT8 </b>', 0, NULL, '2018-08-13 17:23:53', 0),
(790, 3, 12, 'New appointment is booked.<br> Appointment number:<b> APT8 </b>', 0, NULL, '2018-08-13 17:23:53', 0),
(791, 3, 17, 'New appointment is booked.<br> Appointment number:<b> APT8 </b>', 0, NULL, '2018-08-13 17:23:53', 0),
(792, 3, 31, 'New appointment is booked.<br> Appointment number:<b> APT8 </b>', 0, NULL, '2018-08-13 17:23:53', 0),
(793, 3, 146, 'New appointment is booked.<br> Appointment number:<b> APT8 </b>', 0, NULL, '2018-08-13 17:23:53', 0),
(794, 3, 197, 'New appointment is booked.<br> Appointment number:<b> APT8 </b>', 0, NULL, '2018-08-13 17:23:53', 0),
(795, 3, 195, 'New appointment is booked.<br> Appointment number:<b> APT8 </b>', 0, NULL, '2018-08-13 17:23:53', 0),
(796, 3, 181, 'New appointment is booked.<br> Appointment number:<b> APT8 </b>', 0, NULL, '2018-08-13 17:23:53', 0),
(797, 3, 39, 'You are linked with <b>Dr. Ravi Patel</b> doctor as Receptionist', 0, NULL, '2018-08-13 17:51:04', 0),
(798, 3, 39, 'You are linked with <b>Susma Mehta</b> doctor as Receptionist', 0, NULL, '2018-08-13 17:51:04', 0),
(799, 3, 39, 'You are linked with <b>Amit patel</b> doctor as Receptionist', 0, NULL, '2018-08-13 17:51:04', 0),
(800, 3, 39, 'You are linked with <b>First Last</b> doctor as Receptionist', 0, NULL, '2018-08-13 17:51:04', 0),
(801, 3, 39, 'You are linked with <b>doctor one</b> doctor as Receptionist', 0, NULL, '2018-08-13 17:51:04', 0),
(802, 3, 39, 'You are linked with <b>sazeed P</b> doctor as Receptionist', 0, NULL, '2018-08-13 17:51:04', 0),
(803, 1, 186, 'Your Profile is updated', 0, NULL, '2018-08-14 02:32:55', 0),
(804, 1, 3, 'Doctor <b>sazeed P</b> profile updated in department: <b>Dept-2</b><br>Branch: <b>WB</b>', 0, NULL, '2018-08-14 02:32:55', 0),
(805, 3, 188, 'Your appointment is booked.<br> Appointment number:<b> APT9 </b>', 0, NULL, '2018-08-14 02:51:27', 0),
(806, 3, 12, 'New appointment is booked.<br> Appointment number:<b> APT9 </b>', 0, NULL, '2018-08-14 02:51:27', 0),
(807, 3, 17, 'New appointment is booked.<br> Appointment number:<b> APT9 </b>', 0, NULL, '2018-08-14 02:51:27', 0),
(808, 3, 31, 'New appointment is booked.<br> Appointment number:<b> APT9 </b>', 0, NULL, '2018-08-14 02:51:27', 0),
(809, 3, 39, 'New appointment is booked.<br> Appointment number:<b> APT9 </b>', 0, NULL, '2018-08-14 02:51:27', 0),
(810, 3, 146, 'New appointment is booked.<br> Appointment number:<b> APT9 </b>', 0, NULL, '2018-08-14 02:51:27', 0),
(811, 3, 197, 'New appointment is booked.<br> Appointment number:<b> APT9 </b>', 0, NULL, '2018-08-14 02:51:27', 0),
(812, 3, 195, 'New appointment is booked.<br> Appointment number:<b> APT9 </b>', 0, NULL, '2018-08-14 02:51:27', 0),
(813, 3, 181, 'New appointment is booked.<br> Appointment number:<b> APT9 </b>', 0, NULL, '2018-08-14 02:51:27', 0),
(814, 3, 188, 'Your appointment is booked.<br> Appointment number:<b> APT10 </b>', 0, NULL, '2018-08-14 02:55:29', 0),
(815, 3, 12, 'New appointment is booked.<br> Appointment number:<b> APT10 </b>', 0, NULL, '2018-08-14 02:55:29', 0),
(816, 3, 17, 'New appointment is booked.<br> Appointment number:<b> APT10 </b>', 0, NULL, '2018-08-14 02:55:29', 0),
(817, 3, 31, 'New appointment is booked.<br> Appointment number:<b> APT10 </b>', 0, NULL, '2018-08-14 02:55:29', 0),
(818, 3, 39, 'New appointment is booked.<br> Appointment number:<b> APT10 </b>', 0, NULL, '2018-08-14 02:55:29', 0),
(819, 3, 146, 'New appointment is booked.<br> Appointment number:<b> APT10 </b>', 0, NULL, '2018-08-14 02:55:29', 0),
(820, 3, 197, 'New appointment is booked.<br> Appointment number:<b> APT10 </b>', 0, NULL, '2018-08-14 02:55:29', 0),
(821, 3, 195, 'New appointment is booked.<br> Appointment number:<b> APT10 </b>', 0, NULL, '2018-08-14 02:55:29', 0),
(822, 3, 181, 'New appointment is booked.<br> Appointment number:<b> APT10 </b>', 0, NULL, '2018-08-14 02:55:29', 0),
(823, 39, 188, 'Your appointment <b>APT10</b> has been Rejected', 0, NULL, '2018-08-14 02:56:54', 0),
(824, 39, 12, ' Appointment <b>APT10</b> has been Rejected', 0, NULL, '2018-08-14 02:56:54', 0),
(825, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(826, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(827, 12, 39, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(828, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(829, 12, 197, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(830, 12, 195, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(831, 12, 181, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(832, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(833, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(834, 12, 39, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(835, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(836, 12, 197, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(837, 12, 195, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(838, 12, 181, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(839, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(840, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(841, 12, 39, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(842, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(843, 12, 197, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(844, 12, 195, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(845, 12, 181, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(846, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(847, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(848, 12, 39, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(849, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(850, 12, 197, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(851, 12, 195, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(852, 12, 181, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(853, 12, 17, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(854, 12, 31, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(855, 12, 39, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(856, 12, 146, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(857, 12, 197, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(858, 12, 195, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0),
(859, 12, 181, 'Dr. Ravi Patel added new availability', 0, NULL, '2018-08-14 03:39:11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hms_nurse`
--

CREATE TABLE `hms_nurse` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `doc_id` int(10) DEFAULT NULL,
  `IsForAllDoctors` tinyint(4) DEFAULT '1',
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

INSERT INTO `hms_nurse` (`id`, `user_id`, `doc_id`, `IsForAllDoctors`, `department_id`, `isActive`, `isDeleted`, `created_at`, `modified_at`, `qualification`, `experience`) VALUES
(73, 16, 2, 1, 1, 1, 0, '2018-07-22 08:35:00', '2018-07-22 08:35:00', '', ''),
(2, 20, NULL, 1, 1, 1, 1, '2017-06-06 08:50:27', '2017-06-13 16:17:32', '', ''),
(4, 30, NULL, 1, -1, 1, 1, '2017-06-13 10:46:59', '2017-06-13 16:17:20', '', ''),
(5, 38, NULL, 1, -1, 1, 0, '2017-06-15 08:51:42', '2017-06-15 14:21:42', '', ''),
(6, 48, NULL, 1, 55, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(7, 18, NULL, 1, 79, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(8, 65, NULL, 1, 88, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(9, 18, NULL, 1, 69, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(10, 124, NULL, 1, 72, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(11, 115, NULL, 1, 93, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(12, 65, NULL, 1, 25, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(13, 19, NULL, 1, 60, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(14, 138, NULL, 1, 65, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(15, 137, NULL, 1, 91, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(16, 66, NULL, 1, 56, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(17, 124, NULL, 1, 17, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(18, 19, NULL, 1, 8, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(19, 138, NULL, 1, 76, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(20, 48, NULL, 1, 17, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(21, 18, NULL, 1, 86, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(22, 19, NULL, 1, 9, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(23, 124, NULL, 1, 12, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(24, 87, NULL, 1, 93, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(25, 124, NULL, 1, 35, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(26, 138, NULL, 1, 98, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(27, 30, NULL, 1, 25, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(28, 65, NULL, 1, 19, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(29, 91, NULL, 1, 26, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(31, 137, NULL, 1, 69, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(33, 91, NULL, 1, 71, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(34, 38, NULL, 1, 82, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(35, 66, NULL, 1, 48, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(36, 30, NULL, 1, 43, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(37, 65, NULL, 1, 26, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(38, 124, NULL, 1, 61, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(39, 124, NULL, 1, 89, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(66, 146, NULL, 1, 2, 1, 0, '0000-00-00 00:00:00', '2017-09-12 11:27:27', '', ''),
(41, 38, NULL, 1, 89, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(42, 115, NULL, 1, 23, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(43, 48, NULL, 1, 6, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(44, 124, NULL, 1, 77, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(45, 85, NULL, 1, 98, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(46, 129, NULL, 1, 18, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(47, 85, NULL, 1, 97, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(48, 138, NULL, 1, 10, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(49, 38, NULL, 1, 11, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(74, 57, 2, 1, 1, 1, 0, '2018-07-22 09:18:41', '2018-07-22 09:18:41', '', ''),
(51, 115, NULL, 1, 84, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(87, 25, 127, 1, 3, 1, 0, '2018-08-13 02:36:12', '2018-08-13 02:36:12', '', ''),
(53, 138, NULL, 1, 30, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(54, 30, NULL, 1, 89, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(55, 137, NULL, 1, 13, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(56, 124, NULL, 1, 37, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(57, 19, NULL, 1, 11, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(58, 115, NULL, 1, 16, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(59, 38, NULL, 1, 40, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(60, 48, NULL, 1, 3, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(61, 19, NULL, 1, 42, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(62, 77, NULL, 1, 16, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(63, 79, NULL, 1, 59, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(64, 30, NULL, 1, 99, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(65, 20, NULL, 1, 23, 1, 0, '0000-00-00 00:00:00', '2017-06-20 19:38:12', '', ''),
(72, 189, 125, 1, 1, 1, 0, '2018-07-22 08:29:02', '2018-07-22 08:29:02', '', ''),
(71, 189, 4, 1, 1, 1, 0, '2018-07-22 08:29:02', '2018-07-22 08:29:02', '', ''),
(70, 189, 2, 1, 1, 1, 0, '2018-07-22 08:29:02', '2018-07-22 08:29:02', '', ''),
(75, 57, 118, 1, 1, 1, 0, '2018-07-22 09:18:41', '2018-07-22 09:18:41', '', ''),
(76, 57, 125, 1, 1, 1, 0, '2018-07-22 09:18:41', '2018-07-22 09:18:41', '', ''),
(86, 25, 4, 1, 1, 1, 0, '2018-08-13 02:36:12', '2018-08-13 02:36:12', '', ''),
(85, 25, 2, 1, 1, 1, 0, '2018-08-13 02:36:12', '2018-08-13 02:36:12', '', ''),
(80, 190, 2, 1, 1, 1, 0, '2018-07-24 03:12:01', '2018-07-24 03:12:01', '', ''),
(81, 190, 4, 1, 1, 1, 0, '2018-07-24 03:12:01', '2018-07-24 03:12:01', '', '');

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

--
-- Dumping data for table `hms_prescription`
--

INSERT INTO `hms_prescription` (`id`, `patient_id`, `doctor_id`, `appoitment_id`, `note`, `store_id`, `order_status`, `isDeleted`, `created_at`, `modified_at`, `title`) VALUES
(1, 26, 2, 1, 'Eat so & so food. Can we use this field for synopsis instead? etc.etc.', 1, 1, 0, '2017-09-05 15:05:02', '2018-06-20 05:24:05', 'N1'),
(2, 26, 2, 3, '', 0, 0, 0, '2017-09-22 11:07:29', '2017-09-22 16:41:06', 'Testing for order'),
(3, 26, 2, 10, '', 0, 0, 0, '2017-10-24 15:20:35', '2017-10-24 18:50:35', 'normal'),
(4, 28, 2, 4, '', 0, 0, 0, '2017-10-31 14:11:12', '2017-10-31 18:41:51', 'Test Blood group'),
(5, 34, 2, 11, '', 0, 0, 0, '2017-10-31 14:55:11', '2017-10-31 19:25:11', 'Blood report'),
(6, 27, 2, 5, 'Test note.', 0, 0, 0, '2018-06-18 08:25:39', '2018-06-18 08:25:39', 'Test');

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

--
-- Dumping data for table `hms_prescription_item`
--

INSERT INTO `hms_prescription_item` (`id`, `prescription_id`, `drug`, `strength`, `dosage`, `duration`, `qty`, `order_qty`, `note`) VALUES
(1, 1, 'M1A5TzZ6NU5DaUQrTzYrYmNhbWFZdz09OjoTUWisG2LBov+duMbLzPQi', 'MFNBVC81SWhTUG1JYUY2L2VxV0lYdz09Ojp7hWIC034WHCgRuXFu6IiK', 'WTVxS001dmRnVUs3SEErVDNvY0xFdz09OjpLNdsiglQl6RQZS9QXHEBc', 'anVESmo3RnNzQkhGa2JqU1lJWlpUdz09OjpLthKWp08+PNepCsODVawI', 'RmlXeVRTT1ZnZVhUbktyQ0tvRkJQQT09OjrOBVeH34+jznh62EYiuPtz', 'a0l1TXhjaS93YVZkWHRsT1c5VTBJQT09OjrvYH6lH1RuX0XiDGUdJEMW', 'NXRYUHc4cWU0TG1yY3phZmhBLzdPZz09OjrGqEl98XbsorpSiSjtD1Wa'),
(2, 2, 'WXZ0NTJtZGFTWUdnMWFKUG8wM0E0UT09OjrUASJks20z5qChtDWS9VBi', 'ampsN3BrT2VHaUFzVkVtSlJJbktiZz09OjrKQ9Jr+t2hVI7OlBT3MPVY', 'M2djUVlnaUZ5bXU5ekxkdUFzVC9WZz09OjpzWNDEj0ALybRxVb5BCNaE', 'WHhvQXQ1MU9ocEpvTmtCclJDZEx4UT09Ojr4X25wNlmloBEYbrRcwVly', 'ZU9DZllPL3pPTllPSHZXeXZNbC90dz09OjpwP/TyA+WumLT8rMWYpE0+', '', 'L21rTEJ4YUtOWk9LWEw5WUNMQmxPQT09Ojpt2KqKD2F+TDw884ONjrK8'),
(3, 6, 'UU1tM1dXTEhEa1VZakg2VUFNblEvZz09Ojop1fISxNZguqUlWJUEVo+B', 'eTFSZ3BCL3ZHMlc3eWJ1R1VmVnU4UT09Ojr5GvTStIZiDnuDMVIK/Kf6', 'VXl2c1ZwWmRIOXorNmtHUGNQalE2UT09OjoiXTbhw35d6QYUQA8E/Txd', 'RG8vUVp2QUt6cjdjaU9URTc1ZkxYdz09Ojr1by5AAK2MjVvk4KoxFVgi', 'Znk1N3JjWkxPeFI1bFQ3Z0xOcUl6QT09OjqKkNLN+dSDo8ssw9xQIDNP', '', 'Wk9WYlk5M091SE02Qzc0SkY1c1djQT09Ojqgw9NYo9MZKUNqUUD7rs7y');

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

--
-- Dumping data for table `hms_prescription_order_receipt`
--

INSERT INTO `hms_prescription_order_receipt` (`id`, `prescription_id`, `file_url`, `file_type`, `file_path`, `isDeleted`) VALUES
(1, 1, 'http://localhost/mypulse//public/receipt/1509446114_1.png', 'image/jpeg', 'C:\\xampp\\htdocs\\mypulse/public/receipt/1509446114_1.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hms_receptionist`
--

CREATE TABLE `hms_receptionist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `IsForAllDoctors` tinyint(4) DEFAULT '1',
  `qualification` text NOT NULL,
  `experience` text NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_receptionist`
--

INSERT INTO `hms_receptionist` (`id`, `user_id`, `doc_id`, `IsForAllDoctors`, `qualification`, `experience`, `isActive`, `isDeleted`, `created_at`, `modified_at`) VALUES
(7, 17, 2, 1, '', '', 1, 0, '2018-07-22 09:19:26', '2018-07-22 09:19:26'),
(16, 31, 2, 1, '', '', 1, 0, '2018-07-26 02:52:18', '2018-07-26 02:52:18'),
(59, 39, 2, 1, '', '', 1, 0, '2018-08-13 17:51:04', '2018-08-13 17:51:04'),
(4, 146, 2, 1, 'QU3', 'E23123', 1, 0, '0000-00-00 00:00:00', '2017-09-12 18:17:21'),
(5, 179, 0, 1, '', '', 1, 0, '2018-07-11 16:58:18', '2018-07-11 16:58:18'),
(63, 39, 125, 1, '', '', 1, 0, '2018-08-13 17:51:04', '2018-08-13 17:51:04'),
(8, 17, 117, 1, '', '', 1, 0, '2018-07-22 09:19:26', '2018-07-22 09:19:26'),
(9, 17, 122, 1, '', '', 1, 0, '2018-07-22 09:19:26', '2018-07-22 09:19:26'),
(62, 39, 122, 1, '', '', 1, 0, '2018-08-13 17:51:04', '2018-08-13 17:51:04'),
(12, 191, 117, 1, '', '', 1, 0, '2018-07-24 03:20:29', '2018-07-24 03:20:29'),
(61, 39, 117, 1, '', '', 1, 0, '2018-08-13 17:51:04', '2018-08-13 17:51:04'),
(32, 197, 117, 1, '', '', 1, 0, '2018-08-07 18:41:00', '2018-08-07 18:41:00'),
(31, 197, 4, 1, '', '', 1, 0, '2018-08-07 18:41:00', '2018-08-07 18:41:00'),
(30, 197, 2, 1, '', '', 1, 0, '2018-08-07 18:41:00', '2018-08-07 18:41:00'),
(29, 195, 128, 1, '', '', 1, 0, '2018-08-07 17:48:38', '2018-08-07 17:48:38'),
(28, 195, 117, 1, '', '', 1, 0, '2018-08-07 17:48:38', '2018-08-07 17:48:38'),
(27, 195, 4, 1, '', '', 1, 0, '2018-08-07 17:48:38', '2018-08-07 17:48:38'),
(26, 195, 2, 1, '', '', 1, 0, '2018-08-07 17:48:38', '2018-08-07 17:48:38'),
(60, 39, 4, 1, '', '', 1, 0, '2018-08-13 17:51:04', '2018-08-13 17:51:04'),
(58, 181, 117, 0, '', '', 1, 0, '2018-08-12 06:14:20', '2018-08-12 06:14:20'),
(57, 181, 4, 0, '', '', 1, 0, '2018-08-12 06:14:20', '2018-08-12 06:14:20'),
(56, 181, 2, 0, '', '', 1, 0, '2018-08-12 06:14:20', '2018-08-12 06:14:20'),
(64, 39, 127, 1, '', '', 1, 0, '2018-08-13 17:51:04', '2018-08-13 17:51:04');

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

--
-- Dumping data for table `hms_recommend_appointments`
--

INSERT INTO `hms_recommend_appointments` (`id`, `appointment_id`, `recommend_appointment_date`, `user_id`, `department_id`, `doctor_id`, `isDeleted`, `status`) VALUES
(1, 1, '2018-08-10', 187, 1, 2, 0, 0),
(2, 2, '2018-08-10', 26, 1, 2, 0, 1),
(3, 6, '2018-08-13', 26, 1, 2, 0, 0);

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

--
-- Dumping data for table `hms_test`
--

INSERT INTO `hms_test` (`id`, `name`, `description`, `isDeleted`) VALUES
(1, 'Testing Name', 'Description', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hms_users`
--

CREATE TABLE `hms_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `MiddleName` varchar(250) DEFAULT NULL,
  `last_name` varchar(250) NOT NULL,
  `useremail` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `my_key` varchar(250) NOT NULL,
  `address` text,
  `CountryID` varchar(50) NOT NULL DEFAULT '+91',
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
  `hasSelectedRole` tinyint(4) NOT NULL DEFAULT '0',
  `EmailVerified` tinyint(4) NOT NULL DEFAULT '0',
  `MobileVerified` tinyint(4) NOT NULL DEFAULT '0',
  `LastLogintime` datetime DEFAULT NULL,
  `LastLogouttime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_users`
--

INSERT INTO `hms_users` (`id`, `first_name`, `MiddleName`, `last_name`, `useremail`, `password`, `my_key`, `address`, `CountryID`, `mobile`, `aadhaar_number`, `phone`, `profile_photo`, `hospital`, `gender`, `date_of_birth`, `city`, `district`, `state`, `country`, `alternate_mobile_number`, `description`, `role`, `isActive`, `isDeleted`, `created_at`, `updated_at`, `forgotPassCode`, `isRegister`, `hasSelectedRole`, `EmailVerified`, `MobileVerified`, `LastLogintime`, `LastLogouttime`) VALUES
(1, 'Super', '', 'Admin', 'superadmin@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'YzE4MGY3MTUyMGM5ZGMwNDliZWUxYTc3NGU2MzdlZDdkMzdlOGI5Mzg0YmNmYmJjMzJjMjQ5NmYzZjA2NDEzMw==', 'Ahmedabad1', '+91', '9090123409', '5421-3210-5467', '', 'http://ec2-54-186-236-127.us-west-2.compute.amazonaws.com/public/images/ux/1.png', 0, 'M', '1905-05-05', 1, 1, 1, 1, '', 'About my profile..', 1, 1, 0, '0000-00-00 00:00:00', '2017-05-04 00:16:34', '0', 1, 0, 1, 0, '2018-08-14 02:32:08', '2018-08-14 02:33:19'),
(2, 'Ramesh', NULL, '', 'ramesh@techcrista.in', '64a43b6ca15d128ac6a0679b39bc9c07', 'MjllZjZhZmM2ZWE5MmI2NjIxNTU5MzRkMGEzNjNmOTdhOWU1NjE4NzBlMjBjZTliZmI5YmYzYzk5NTU2NjNmYw==', '', '+91', '1234561230', '542132105460', '', '', 0, '', '0000-00-00', 0, 0, 0, 0, '', '', 2, 0, 0, '2017-05-03 18:56:20', '2017-05-04 00:26:20', '3', 1, 0, 1, 0, NULL, NULL),
(3, 'Hospital Admin', '', 'LMS', 'hospitaladmin@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'NzZhZTNlYmRkMjZkY2ZiNjNhM2QyNjYyMzAwMjAyM2NjODk0ZmVlZDhkNzUxOTg1NGRmYmVhMjliMmY3ODM1MQ==', '', '+91', '1234561236', '5421-3210-5462', '', 'http://ec2-54-186-236-127.us-west-2.compute.amazonaws.com/public/images/ux/3.png', 1, 'M', '2017-08-05', 1, 1, 1, 1, '', 'Some Descsss', 2, 1, 0, '0000-00-00 00:00:00', '2017-05-24 09:52:31', NULL, 1, 0, 1, 0, '2018-08-14 02:45:08', '2018-08-14 02:48:31'),
(15, 'Medical', NULL, 'Lab', 'medicallab@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'MzVhZGU0NjgyMGFiMmYxYWU0MWRmMzUwOGFlYmIzMDE2Mjg5MGFhZDRiYjhkM2YyYzdjZGE3YzQwNGI3M2VmNw==', '4234- b123', '+91', '09099910272', '542132105463', NULL, NULL, 0, '', '1970-01-01', 1, 1, 1, 1, '', 'My Lab Desc.', 8, 1, 0, '2017-05-30 12:36:59', '2017-05-30 18:06:59', NULL, 1, 0, 1, 0, '2018-08-05 15:47:36', '2018-08-03 03:08:27'),
(14, 'Ravi', NULL, 'Prashad', 'medicalstore@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'OTVmOWRkNWEyZTFmNjRjNjJlOTM0MTUwNzI4MzQ5OWFhMjhiYmUxMTcwZjlhYjRkMzBhZjQxNDJjMGU2OTAxZg==', '2342- Jsdfa', '+91', '9099910273', '542132105464', NULL, NULL, 0, '', '0000-00-00', 1, 1, 1, 1, '', 'My Store Desc', 7, 1, 0, '2017-05-30 12:34:11', '2017-05-30 18:04:11', NULL, 1, 0, 1, 0, '2018-08-05 15:47:09', '2018-08-03 02:12:58'),
(13, 'Prakash', NULL, 'Reak', 'prakash@lms.com', 'e10adc3949ba59abbe56e057f20f883e', 'MWRhMTk2YmEwOTY1Y2IwYmI0YjcyZjAxZDYxMzYwODQxNGJmYWJkYmJjYjc4YTYxYmQyYzYwMWM4MGQ2MDBmYQ==', NULL, '+91', '991820012321', '3214098754122', NULL, NULL, 0, '', '0000-00-00', 0, 0, 0, 0, '', '', 7, 0, 0, '2017-05-30 12:31:32', '2017-05-30 18:01:32', NULL, 1, 0, 1, 0, NULL, NULL),
(12, 'Dr. Ravi', '', 'Patel', 'doctor@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'NjNhMjkxYzgyNGJjMDQ3ZTBhNDQ1ZmQxZGFlMTE4MjE1ZWRjZWFkNjdmNjRmNGQwNDI2OTBjMGJiODZiMDlhZA==', '', '+91', '1234723154', '5421-3210-5465', NULL, 'http://[::1]/GridFramework/Projects/Hospital_Managment_System/public/images/ux/12.png', 0, 'M', '1988-12-26', 0, 0, 0, 0, '', 'ASDWQWE', 3, 1, 0, '2017-05-28 05:22:21', '2017-05-28 10:52:21', NULL, 1, 0, 1, 0, '2018-08-14 03:36:01', '2018-08-08 18:35:40'),
(16, 'Priya', NULL, 'Shah', 'priya@lms.com', 'd41d8cd98f00b204e9800998ecf8427e', 'NzY2MDQ4ZjBmYjRkODQwZmU3MTU4NTc0ZWYxODU3NzFkM2YwODMzMDM5ZDk2ZmM5YmUxZGQ2YTI2NjVhOTY5NQ==', '', '+91', '9099910271', '123456767822', NULL, NULL, 0, '', '1970-01-01', 0, 0, 0, 0, '', 'ASd', 0, 0, 0, '0000-00-00 00:00:00', '2017-06-02 15:03:43', NULL, 1, 0, 1, 0, NULL, NULL),
(17, 'Raju', NULL, 'patel', 'raju@lms.com', '123456', 'OTVmMGRmOTE1NmMzOTNiMzgzNmRlYjI1N2QwZjcyNDQ1ZTNiNTMyMTA2OGIyNjdlN2JjNzYyNDFiOTFhZmZkOA==', '', '+91', '9099910852', '5421321054300', NULL, NULL, 0, '', '1970-01-01', 0, 0, 0, 0, '', '', 0, 0, 0, '0000-00-00 00:00:00', '2017-06-02 15:06:06', NULL, 1, 0, 1, 0, NULL, NULL),
(18, '', NULL, '', '', 'd41d8cd98f00b204e9800998ecf8427e', 'MTAyYzQ2MGVmMjMxNzE2NTU5YmRjNTc4YTAwMmUyZGUyNDNjYjAxZDZkNmEyYWFkMzY5MTk5YTZjZDU4ODM1Yw==', '', '+91', '1234561243', '542132105466', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', '', 4, 0, 0, '2017-06-06 07:53:06', '2017-06-06 13:23:06', NULL, 1, 0, 1, 0, NULL, NULL),
(20, 'Test', NULL, 'Test', 'test@lms.com', '268e27056a3e52cf3755d193cbeb0594', 'OTJkODYyZDdkN2FlZjExOWJiMzc5ZjgwNjFlMWI4YmFlNzYwNzU0Mjk4YTY0YTkwOWU5NDVlZWEyOWJhOTU0MQ==', '', '+91', '12313123', '5421781215', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', '', 4, 0, 0, '2017-06-06 08:50:27', '2017-06-06 14:20:27', NULL, 1, 0, 1, 0, NULL, NULL),
(21, 'Amit', NULL, 'patel', 'drravi1@lms.com', 'e10adc3949ba59abbe56e057f20f883e', 'Y2Y3OGUzOWQzOGI3NTY1ZGQ1MWQ2NDg3MTZhN2ZiYTFjNzA1YjJkNGU4MmI0MWNmZWJhMDdjZWE4ODMxZWQ2Nw==', '', '+91', '09099910274', '3214098754124', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', 'MD', 3, 0, 0, '2017-06-07 06:07:20', '2017-06-07 11:37:20', NULL, 1, 0, 1, 0, NULL, NULL),
(22, 'Amit1', NULL, 'patel', 'drrav2i@lms.com', 'e10adc3949ba59abbe56e057f20f883e', 'MTBiMTBhNzRhMjE4Yjg0NjFjODNlZjNlZmFlYTA1MWNjNzMwYzFlNDg5OWEwNjczOWM1OTc1NTQ3YWMxMDk1MA==', '', '+91', '09099910275', '3214098754125', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', 'MD', 3, 0, 0, '2017-06-07 06:11:53', '2017-06-07 11:41:53', NULL, 1, 0, 1, 0, NULL, NULL),
(23, 'Susma', NULL, 'Mehta', 'susma@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'ZGUxYTcyNGM3N2FhZWQxMzYxM2E3MTRhODMxMWVhYWM0YmQ5YzJmNDdkZTU5YTU0OWZlMTZkMzNmZmM0ZjZlNA==', '', '+91', '91231231812', '129812912311', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', 'MD in ALL', 3, 1, 0, '2017-06-09 06:08:37', '2017-06-09 11:38:37', NULL, 1, 0, 1, 0, NULL, NULL),
(24, 'Partik', NULL, 'Sharma', 'pratik@lms.com', 'e10adc3949ba59abbe56e057f20f883e', 'MjgyNzJiOTNkOGQ2NTQwZmJmNzljMzFmZDQxYzdiMDM4ZWQ2YjFhOGJkZDIyOTk4YTBlYzQ2ZmVkYWY4NWI0NA==', '', '+91', '81237123981', '82347123128', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', 'DES', 3, 0, 0, '2017-06-09 06:09:03', '2017-06-09 11:39:03', NULL, 1, 0, 1, 0, NULL, NULL),
(25, 'Narshima', NULL, 'Ananya', 'nurse@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'ZmUwMDU1NTM1NGVjNjg0NzhlMTYyZmExNjczYzZjODQyN2YyMGY2NWI2NTc5OTYwODc1MjBjMGNmZDg4ZWI5OA==', '', '+91', '912031281123', '91231021931', NULL, NULL, 0, 'M', '1970-01-01', 1, 1, 1, 1, '', 'nURHWEMAES ', 4, 1, 0, '2017-06-09 06:11:18', '2017-06-09 11:41:18', NULL, 1, 0, 1, 0, '2018-08-13 16:16:37', '2018-08-11 04:59:00'),
(26, 'User', NULL, '', 'user@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'NWZhNmNiODZmNThiNGQxZDIxMmM3YzRmMGY0M2M4YjRhMTdiOWVkYjE3ZTM3ZGU4OWJhZWY5NzBmZTdiM2YyYQ==', 'A-312 Avenue, NY-121', '+91', '9812831123', '12931892318', NULL, 'http://[::1]/GridFramework/Projects/Hospital_Managment_System/public/images/ux/26.png', 0, 'M', '1905-05-05', 1, 1, 1, 1, '', 'Reg.', 6, 1, 0, '2017-06-09 06:13:06', '2017-06-09 11:43:06', NULL, 1, 0, 1, 0, '2018-08-14 02:33:42', '2018-08-14 02:44:58'),
(27, 'Manoj', NULL, 'Vyajpai', 'manoj@lms.com', '5e81f9859d223ea420aca993c647b839', 'YjA2YmZmZmUwZWE5NWU4Yzg2MGYxNWJlYjY3ZmZiN2MwODU4NzQ3OGQxNmU5ZDk5ZjNlNjVkNWZhYTViOTYzNA==', '', '+91', '09099910277', '3214098754126', NULL, NULL, 0, 'F', '1970-01-01', 0, 0, 0, 0, '', 'All MEDs Available ', 7, 1, 0, '2017-06-09 06:17:52', '2017-06-09 11:47:52', NULL, 1, 0, 1, 0, NULL, NULL),
(28, 'Amit', NULL, 'patel', 'dr1ravi@lms.com', 'e10adc3949ba59abbe56e057f20f883e', 'MGQ2ODA2MjY0M2Q3YWUyNDY0ZTg5OGUxNmZjZWQyOTcyZTMwNzJkNmU1YWJmNjdmZGRkNmY0MjM0ZWVlOWUwMw==', '', '+91', '09099910271', '3214098754127', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', '', 8, 0, 0, '2017-06-09 06:18:30', '2017-06-09 11:48:30', NULL, 1, 0, 1, 0, NULL, NULL),
(30, 'Ranchi', NULL, 'Patel', 'mmh@gmail.com', '6a204bd89f3c8348afd5c77c717a097a', 'OTkwMTEyMDFjOTkxODcwM2NiNjNkNGU4M2QwODRjYzZhZTU1OWU0NGM1NzBmNDk4YWFjMDI1MzNmYjg0ZTNiZQ==', '', '+91', '9889988822', '1234565748', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', 'asdfasdf', 4, 0, 0, '2017-06-13 10:46:59', '2017-06-13 16:16:59', NULL, 1, 0, 1, 0, NULL, NULL),
(31, 'Door', NULL, 'Ship', 'adsfasdf@gmail.com', '912ec803b2ce49e4a541068d495ab570', 'ZDM5ZmQ3ZDY0MjQzMGUzMmQ1OTUzODgzZjgyOTIyNzNmYmIwNGJmOTY0YWY2MzE3Yjk3ZDdkYzM2MWE5NmVjYg==', '', '+91', '7994558542', '777454848', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', 'ASdfas', 5, 0, 0, '2017-06-13 10:48:13', '2017-06-13 16:18:13', NULL, 1, 0, 1, 0, NULL, NULL),
(32, 'tghh', NULL, 'hdfgdf', 'gsdfgsdfg', '97dec69bf52685aad08bbbf93226a928', 'ZjEzNzJmMWJmNDIyM2RiNTQ0MjkxMTA4ODIxODhjMGYyNDc3NzllOTlhNjE5NDgzNmY2MGE2NjZlYjA0MjE5Nw==', '', '+91', 'sdfgsdfgsdfg', 'sdfgsdf', NULL, NULL, 0, 'F', '2017-06-13', 0, 0, 0, 0, '', 'sdfsadfasd', 0, 0, 0, '2017-06-13 10:52:34', '2017-06-13 16:22:34', NULL, 1, 0, 1, 0, NULL, NULL),
(33, 'Ramesh', NULL, 'Lalo', 'ramesh@ab.com', 'd41d8cd98f00b204e9800998ecf8427e', 'OTMxYmE2MzNhMWQwNTBlZGYwZTUxN2Y1ZjViZWY2OGJiYzdiZGZmMmJmNmIxNjkwMzg1YzM3MTIxMDk4ZDQ4Nw==', '', '+91', '9101283281', '12345676781', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', 'MD OF ALL', 3, 0, 0, '2017-06-15 05:43:57', '2017-06-15 11:13:57', NULL, 1, 0, 1, 0, NULL, NULL),
(34, 'Jayes', NULL, 'Raval', 'jayes@hotmail.com', '4d069b4e77b1d1804bead1d3bea762b8', 'MWYwZWU3YWQzYzljOTQ3NjEwMDkwYTExOTZhYTgxNzk0ZWY5ZDZjZjllNzI2ZDg1NmVjMTJlNWM3N2ZlYWViZg==', '', '+91', '8191782382', '819127176', NULL, NULL, 0, 'M', '0000-00-00', 0, 0, 0, 0, '', 'KSla', 6, 1, 0, '2017-06-15 08:32:35', '2017-06-15 14:02:35', NULL, 1, 0, 1, 0, NULL, NULL),
(35, 'Umang', NULL, 'Shah', 'umang@lak.com', 'e10adc3949ba59abbe56e057f20f883e', 'MTk4YjY5OWIwZmVkMTZmMTUwMjdkNTQ5NDMxM2VhOThiMDkzODMxMWZhNTFhOGVjZjYwMDY4MzM4YzZmN2EzMQ==', '', '+91', '9081232132', '9812038912831', NULL, NULL, 0, 'M', '0000-00-00', 0, 0, 0, 0, '', 'KLakal', 6, 0, 0, '2017-06-15 08:35:43', '2017-06-15 14:05:43', NULL, 1, 0, 1, 0, NULL, NULL),
(36, 'Kamelsh', NULL, 'Klak', 'kamlesh@kga.com', 'e10adc3949ba59abbe56e057f20f883e', 'MGU0ZGFmNTQxMjUwMzBhZDdlYjkzYTg4MGM4N2NkZjBmNTFkMWMzNWE0ZTExZTgxMTVlNDIwM2FlZWMzZGNmMg==', '', '+91', '8902178654', '918028928', NULL, NULL, 0, 'M', '0000-00-00', 0, 0, 0, 0, '', 'Iopq', 6, 0, 0, '2017-06-15 08:40:35', '2017-06-15 14:10:35', NULL, 1, 0, 1, 0, NULL, NULL),
(37, 'Mahesh', NULL, 'Lal', 'mahesh@la.com', 'e10adc3949ba59abbe56e057f20f883e', 'ZmZkZGYyMzk2ZDUyNDA5MDMwNGIzMjcyYTE0YzY2OTVkZjIyODY5MzE4MDYxYmVkNDRjYjc3YWIwNjVkNjI5MQ==', '', '+91', '9801232098', '98819281928', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', 'MD Skin', 3, 0, 0, '2017-06-15 08:51:13', '2017-06-15 14:21:13', NULL, 1, 0, 1, 0, NULL, NULL),
(38, 'Lka', NULL, 'Klak', 'lka@gamil.com', 'd41d8cd98f00b204e9800998ecf8427e', 'ODlmYjU1NzEzYzFlZGM2ODM0ZWNiZmY2ODQxZTk5YjNhMWExMTliNTE5ZWQ4N2RhNmUyNDMwNTAzODUwNzhlNQ==', '', '+91', '9875461230', '254678987', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', 'Desc', 4, 0, 0, '2017-06-15 08:51:42', '2017-06-15 14:21:42', NULL, 1, 0, 1, 0, NULL, NULL),
(39, 'Receptionist', NULL, '', 'receptionist@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'ZDY1ZWNhMjQ4M2IzZjJlYWNmNjhlYmFkZDAxNTE4MzU4YWY4ZDMwMTZmNTM3ZTc2ODg0MDNlYWU3MTZmYTUyOA==', '', '+91', '5647891230', '1231231234', NULL, NULL, 0, 'M', '1970-01-01', 2, 1, 1, 1, '', 'klk', 5, 1, 0, '2017-06-15 08:52:07', '2017-06-15 14:22:07', NULL, 1, 0, 1, 0, '2018-08-14 02:52:00', '2018-08-13 17:38:38'),
(40, 'Lal', NULL, 'Sign', 'lal@gma.com', 'e10adc3949ba59abbe56e057f20f883e', 'ZDMyNjhiNWUwYTNmY2FjMzViNmU4ZjVhMTdhNGU3NTY0OTY2MjNhNjMzOWFlZmYwNWIwZGYxZThmMDA1MjJhMw==', '', '+91', '3216549870', '586984120', NULL, NULL, 0, 'M', '0000-00-00', 0, 0, 0, 0, '', 'kk', 6, 0, 0, '2017-06-15 08:54:11', '2017-06-15 14:24:11', NULL, 1, 0, 1, 0, NULL, NULL),
(41, 'Rews', NULL, 'Adse', 'ares@dfa.fgt', 'd41d8cd98f00b204e9800998ecf8427e', 'ZTA0NTc3ZmMyOTIyY2Y2NDc4NTRlMGMwNzU1ODcwMWRkM2Q5NjUzZWVlM2E3MDkxNTI0YTZhMjIyMjE1NjYyMg==', '', '+91', '6751235476', '12312312312', NULL, NULL, 0, 'M', '2017-06-08', 1, 1, 1, 1, '', 'zxcvzxcv', 8, 0, 0, '2017-06-15 09:02:48', '2017-06-15 14:32:48', NULL, 1, 0, 1, 0, NULL, NULL),
(42, 'Nevada', NULL, 'Baker', 'molestie.Sed.id@nulla.net', 'e10adc3949ba59abbe56e057f20f883e', 'MjJiOTY0NmU1OGE1MGM3Yzg0MTc5OWMzMTlkMmFhNjBlNWYzZGFhNTg0ODI5YmMzZDUzMmZiYWI5MDI0MDkzZA==', '351-7518 Curabitur Road', '+91', '+91 0949965737', '1667101454499', '1-512-398-6522', NULL, 0, 'M', '2018-01-12', 1, 1, 1, 1, '+91 9383315835', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(43, 'Bell', NULL, 'Meadows', 'ornare@Inmipede.co.uk', 'e10adc3949ba59abbe56e057f20f883e', 'OGQyNzc5MjhiMzhhNmRmMmVmNGVjOGQwZWU5ZDExNWU4ZmRjMjA5YTIzMmM1MThmODM0Y2E5ODM1OTgyMTc2ZA==', '1501 Luctus St.', '+91', '+91 7151627385', '1675021912999', '880-5775', NULL, 0, 'M', '2018-05-31', 1, 1, 1, 1, '+91 2596754139', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(44, 'Breanna', NULL, 'Hewitt', 'in@consectetuer.org', 'e10adc3949ba59abbe56e057f20f883e', 'YTgwZjRiZWYwM2Y2ZTIwMzM2OTZkMTU2N2U4OThhYjAwODhjNGI5MGU5ZGZmNjYxZjIwNDE5NTdlYjIwMzJkMw==', 'Ap #645-5323 Faucibus Av.', '+91', '+91 0714016419', '1685090663999', '1-547-292-7587', NULL, 0, 'M', '2017-07-01', 1, 1, 1, 1, '+91 6660930721', '', 6, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(45, 'Drew', NULL, 'Mcguire', 'vestibulum.nec.euismod@magnanecquam.com', 'e10adc3949ba59abbe56e057f20f883e', 'MDlmODRlZTRkZTI2YTVlMmU0ZDRiZjhhZDc4ZmE3YTE1ZTJjZjU3MDE1NTVlMDkxNDllZWM3MGQ4NjQ2YmYwNg==', 'Ap #441-2999 Sed St.', '+91', '+91 0195042800', '1672092975999', '1-581-246-1866', NULL, 0, 'M', '2017-04-25', 1, 1, 1, 1, '+91 2209942120', '', 5, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(46, 'Tyler', NULL, 'Dickerson', 'arcu.ac.orci@eget.ca', 'e10adc3949ba59abbe56e057f20f883e', 'NzkzMmI4ZjRkMjkxZTgyMTdlNWQ3YTUwMTg2YTdiY2IwYmFjMmVkODUwYzlmMzE4MzA1ZTljMzFlYjU2YmMxNw==', 'P.O. Box 484, 5023 Vel, Ave', '+91', '+91 7317087579', '1665091675699', '1-638-736-4261', NULL, 0, 'M', '2016-09-02', 1, 1, 1, 1, '+91 4103255499', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(47, 'Joel', NULL, 'Henderson', 'facilisis@aliquam.org', 'e10adc3949ba59abbe56e057f20f883e', 'YTc2ODRlYjQ4YWI1NmE0N2YzNzQyZDE1YjBiMmVjMDMyMGJkZTNjYmMzZThkMDFjMmM4MzE3MWZhMmQ1NzNhZg==', 'Ap #476-5379 Nunc Rd.', '+91', '+91 1847824624', '1667021273899', '353-8571', NULL, 0, 'M', '2017-04-20', 1, 1, 1, 1, '+91 7503550193', '', 2, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(48, 'Bernard', NULL, 'Mcleod', 'amet.nulla@tristiquepharetra.co.uk', 'e10adc3949ba59abbe56e057f20f883e', 'ZDRhMzkxODE4YjUwMTg4MGYwMGViMTUzMzlhOTAyNDA4ZmE3ZDUzNDhmNDNjZDE3YzgwMTQ2MWVlYzIyNzQ0Ng==', 'Ap #997-7561 Maecenas Avenue', '+91', '+91 4560059125', '1656021328999', '1-523-999-9951', NULL, 0, 'M', '2018-04-12', 1, 1, 1, 1, '+91 3394658300', '', 4, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(49, 'Vanna', NULL, 'Figueroa', 'Vivamus.nisi.Mauris@seddolor.edu', 'e10adc3949ba59abbe56e057f20f883e', 'ZWRkOWNkOGZmZGY5OWZlZDNiMzQyYmMxNzYwMmJjZDMxOTllNmMwZTEwNjA1MWRmOTAzMWVjY2NlNmU4YmNhMA==', 'Ap #396-9247 Semper, Street', '+91', '+91 6015091897', '1695050717999', '1-727-950-7088', NULL, 0, 'M', '2016-10-20', 1, 1, 1, 1, '+91 8395241326', '', 5, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(50, 'Yetta', NULL, 'Franklin', 'sapien@Nullatemporaugue.org', 'e10adc3949ba59abbe56e057f20f883e', 'ZmJhM2M5ZjM1OTE5OWViMDkwNmFkMmNmZTMwYjc0NDBmODBlZTMzOWZjN2ZlYjI2NDU2N2EzZjBjZWQ0Zjc4Mg==', '6291 Elementum Avenue', '+91', '+91 5285567717', '1604020855899', '1-401-427-3019', NULL, 0, 'M', '2016-08-31', 1, 1, 1, 1, '+91 0324648299', '', 6, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(51, 'Ayanna', NULL, 'Howell', 'eu@aliquamerosturpis.ca', 'e10adc3949ba59abbe56e057f20f883e', 'NDQwZGM2YTZlMWMyOWJlODFkOGIxZjQwYjA1MDkwNzUzYWYzMjc1Y2Q4MzU5ZGViMzU2NDc2NmViMGJlNTQyOA==', '4636 Odio Street', '+91', '+91 5612590306', '1695021463499', '319-0248', NULL, 0, 'M', '2018-04-22', 1, 1, 1, 1, '+91 3343411907', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(52, 'Merrill', NULL, 'Hardin', 'a.magna.Lorem@purusin.org', 'e10adc3949ba59abbe56e057f20f883e', 'ZDY0YTNjNjc4YTYwN2M2OWRjNTk5OGUyYWJkNzlkODQ3ODc5ZGE3YTQzZDJjMzljYTFhODZmMDFlYjI2NjFlYw==', 'Ap #881-2784 Aliquet, St.', '+91', '+91 8927206617', '1652120434399', '976-4614', NULL, 0, 'F', '2016-10-17', 1, 1, 1, 1, '+91 3370445481', '', 1, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(53, 'Mary', NULL, 'Harrington', 'libero.dui@scelerisquenequesed.edu', 'e10adc3949ba59abbe56e057f20f883e', 'ODk5MTYwMGM0NmQxYmY5ZGFlNzliOWZjMjdlMTFmM2QyMzNjMDhkMmNkMDMyZmRiZTNmMWQzZmI5ZWEwNTU1Mw==', '5829 Vulputate Av.', '+91', '+91 5266036270', '1685122654599', '583-5634', NULL, 0, 'F', '2016-10-04', 1, 1, 1, 1, '+91 0520040473', '', 6, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(54, 'Mariko', NULL, 'Hubbard', 'Sed.nulla@risusDonecegestas.org', 'e10adc3949ba59abbe56e057f20f883e', 'N2M2N2Q4MGQ3YmIyZDRhMTJiNjYyZDNkYjUyN2MyOGNhM2QyYzU5MGFlODU0NzNhZGQ4MDg3MTRmNTUxYzZhYw==', 'Ap #519-3137 Lorem, St.', '+91', '+91 7456402184', '1605092133099', '706-0204', NULL, 0, 'M', '2018-02-20', 1, 1, 1, 1, '+91 8099017064', '', 5, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(55, 'Portia', NULL, 'Oconnor', 'ligula.Donec@aliquetvelvulputate.edu', 'e10adc3949ba59abbe56e057f20f883e', 'ODk4MzQ2OTU4ZDNhNDVlNGZkMmVkMzk4YjZmMDVlY2ViNTU3Yjg2ZjMzNTUwM2Q0ZTY0ODVjODkyN2E1NDE1Nw==', 'P.O. Box 960, 4389 Ac Ave', '+91', '+91 9239707916', '1608122613299', '769-1797', NULL, 0, 'F', '2016-11-21', 1, 1, 1, 1, '+91 8637039740', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(56, 'Driscoll', NULL, 'Hess', 'adipiscing.fringilla@loremeumetus.com', 'e10adc3949ba59abbe56e057f20f883e', 'NmQ1ZjgxYWY1ZTFmN2Y0Mzg3MTZhZDZjY2M1Y2I3OGFmNTNhM2U1OTRmNWFkZWVmYzhjZDNjMmMwNmUxNTQ2Mw==', '505 Auctor St.', '+91', '+91 8494663972', '1681100219599', '450-5074', NULL, 0, 'F', '2016-08-08', 1, 1, 1, 1, '+91 8350547605', '', 1, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(57, 'Jason', NULL, 'Oliver', 'sapien.cursus.in@eleifendnuncrisus.com', 'e10adc3949ba59abbe56e057f20f883e', 'M2NjNGU2NDEyYjNlYTNjZGIxNjE3NTY5NzZlMzcyNzEyNTA2NGUwNjRmNjZkOWYyMjlmYmI4ZDVhYTUzZWIxMA==', 'P.O. Box 322, 5352 Sed Rd.', '+91', '+91 9586375653', '1647020458699', '312-3171', NULL, 0, 'F', '2016-07-06', 1, 1, 1, 1, '+91 9315893528', '', 4, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(58, 'Kessie', NULL, 'Bruce', 'luctus.lobortis@lectus.edu', 'e10adc3949ba59abbe56e057f20f883e', 'OTgwMjUxMDMxZTUyNjMzNWZhNzVlYTZhMTI1MTMwZGI0ZTlkY2U4YjJhZTA2NmJiZTBhOWZhZWFkNjNjNDc5ZQ==', '245-7642 Sagittis St.', '+91', '+91 5752094431', '1641031382299', '1-574-930-8961', NULL, 0, 'F', '2017-12-21', 1, 1, 1, 1, '+91 9237226166', '', 2, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(59, 'Ingrid', NULL, 'Thornton', 'turpis@odiosemper.co.uk', 'e10adc3949ba59abbe56e057f20f883e', 'MmUyNTlhOGUzZTBmZjhkNjk1NGQxMGM5NDFhOWE0ZTg2ZTVkMDdhMzM4MWM5NTA3NDJjOTY0YjFkMjBkYTQ4Ng==', 'P.O. Box 773, 1673 Integer Road', '+91', '+91 0712098812', '1627071283999', '111-1884', NULL, 0, 'F', '2016-08-14', 1, 1, 1, 1, '+91 1174902707', '', 1, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(60, 'Edan', NULL, 'Jordan', 'Proin@dignissim.com', 'e10adc3949ba59abbe56e057f20f883e', 'YmUwZGUzMmEyNzc0NGM1Y2MzZmExNzQ3ODIyMzVkMDE0ZThlMmUwNGU3YmU5NDczZDRhYzg2NDhmNWY4ZjgxMQ==', '7462 Suspendisse Rd.', '+91', '+91 9605841149', '1675101628499', '1-335-868-4839', NULL, 0, 'F', '2017-11-13', 1, 1, 1, 1, '+91 6137930201', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(61, 'Carla', NULL, 'Irwin', 'massa.Mauris.vestibulum@Nulladignissim.net', 'e10adc3949ba59abbe56e057f20f883e', 'ZjJmN2QwZDE5NTQxZTk2YWQ1MGJhNTBlOWY2MTk2ZTRjZGI5NWY3ZjQ1ZTU0NDExNWIxOWU5NzU3MDgyMTNlOA==', 'P.O. Box 482, 2640 Malesuada St.', '+91', '+91 5134056217', '1624100428199', '350-6807', NULL, 0, 'F', '2017-08-16', 1, 1, 1, 1, '+91 1194861426', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(62, 'Jamalia', NULL, 'Gross', 'quis.tristique@elementumduiquis.com', 'e10adc3949ba59abbe56e057f20f883e', 'YmI0MWEwMzVkZmJkNDRhODNmZjBhMmI1ODYxODRmY2Q0N2VjZDcxNDgwOGNlNmNlOTI0M2FjOWM1ZjkxYTQ0Mw==', '447-9033 Gravida Av.', '+91', '+91 1580627287', '1673102239899', '1-716-342-6013', NULL, 0, 'F', '2016-07-28', 1, 1, 1, 1, '+91 5132043405', '', 2, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(63, 'Nina', NULL, 'Nielsen', 'felis.ullamcorper.viverra@Inlorem.com', 'e10adc3949ba59abbe56e057f20f883e', 'ZDhjOTZmMDEzZDBkMDAzMzdmZDE4OWRhNTBjYjM0ZmYxYWJlYjdlZmYxNzY2ZDU3YmU0NzZjZjg4MWJkZDc4OA==', '229-8077 Nibh Avenue', '+91', '+91 7256522839', '1670101796499', '388-7973', NULL, 0, 'F', '2017-07-21', 1, 1, 1, 1, '+91 8019410941', '', 5, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(64, 'Megan', NULL, 'Perez', 'cursus@Integer.com', 'e10adc3949ba59abbe56e057f20f883e', 'MTYyNDhhYjczYmIzMzI5ZmRkMjg5NzJkN2RkNWI0MjYyMjg5ZTY1N2VjMzExNWM1ZTM4YTZkNGMxY2QxZTI4Mg==', 'P.O. Box 333, 422 Et Street', '+91', '+91 9098138885', '1605030461799', '1-878-631-0125', NULL, 0, 'F', '2018-03-23', 1, 1, 1, 1, '+91 8463557793', '', 5, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(65, 'Harrison', NULL, 'Yates', 'elementum.at.egestas@Donec.com', 'e10adc3949ba59abbe56e057f20f883e', 'MzI3MzI3ZmRlZjE5MWM3MTQ5ODUwYjc5MTExYzQwN2FhMTNhYWVkZDE2NWZkODYxZTlmYmQ2Y2JkMGE2ZDUxMQ==', '9576 Phasellus Street', '+91', '+91 7235671445', '1692010395299', '1-417-516-3099', NULL, 0, 'M', '2017-07-31', 1, 1, 1, 1, '+91 6426692829', '', 4, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(66, 'Eden', NULL, 'Haynes', 'facilisis@nonluctus.org', 'e10adc3949ba59abbe56e057f20f883e', 'MWRmZTY0NzRlY2YzNjU2YTQwYWMzMjE5NTA0ZjNjNGI4MTUxOTkzNWI0MWFmYzFmNmZjNTFmOWE3NjYzYzJjNQ==', 'P.O. Box 357, 963 Quis Rd.', '+91', '+91 7137077439', '1673071925499', '1-755-336-4590', NULL, 0, 'M', '2017-02-01', 1, 1, 1, 1, '+91 9534636596', '', 4, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(67, 'Nehru', NULL, 'Sullivan', 'dictum.magna.Ut@placeratvelitQuisque.net', 'e10adc3949ba59abbe56e057f20f883e', 'ZmNjYmU4ODgzMDQ2M2M3NjIzYWU5MjE4ZTJmOTFkMjFhZDU0MjM4YzI2OTU2YjBjYjNhZWQxZTM3ZDJhYTMxOQ==', 'Ap #644-4613 Leo. Road', '+91', '+91 3254755613', '1622060999499', '1-766-482-2745', NULL, 0, 'F', '2016-08-30', 1, 1, 1, 1, '+91 6417442675', '', 1, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(68, 'Ariana', NULL, 'Key', 'ridiculus.mus.Proin@iaculisaliquetdiam.net', 'e10adc3949ba59abbe56e057f20f883e', 'NmZkMjllY2NmMDEyMDg1MTQ2ZWM5ZTk1YjdhNDA1ZjgzYzdkYzNjOGI2YWQzYmU5MWFmMTU4ZGRhOGE4YjQ1OQ==', '9440 Id, St.', '+91', '+91 2996225741', '1637100222599', '1-224-437-7325', NULL, 0, 'F', '2018-01-22', 1, 1, 1, 1, '+91 8017039235', '', 5, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(69, 'Miriam', NULL, 'Atkins', 'ante.dictum@consequatenimdiam.edu', 'e10adc3949ba59abbe56e057f20f883e', 'MmYxYTVjNTQ1YTRjYzRhMzFhZDRmNWI2MWJjZDNiN2U4OGVkYWQxMDJjMDQ2OTk4NjA2MzA0YzJmOGQ2Y2M5ZQ==', '198-3476 Erat Av.', '+91', '+91 3066036535', '1665081631099', '178-5282', NULL, 0, 'M', '2017-11-21', 1, 1, 1, 1, '+91 7046206244', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(70, 'Griffith', NULL, 'Wiggins', 'risus.In@hendrerit.edu', 'e10adc3949ba59abbe56e057f20f883e', 'MjhjZTMxMjU5MmExOTE3M2U4ZGFjNDdlY2QwZDg1YTU4NmQyNDA5YTg5NzBiZTdiNjdjNTFhYWYyNTRlYjk3Yg==', 'Ap #767-6990 Erat Road', '+91', '+91 8437983250', '1600021733099', '940-1891', NULL, 0, 'F', '2017-10-28', 1, 1, 1, 1, '+91 7360589585', '', 1, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(71, 'Barclay', NULL, 'Watkins', 'egestas.Aliquam.fringilla@augue.co.uk', 'e10adc3949ba59abbe56e057f20f883e', 'YmJkMTNiZjU4MDY1NDU3OTcyM2E0ODViOTk5MTE5NzI5NWNjMTAyYWRlNTdmNzE5N2QzNDVmZGZmMGQ3MGRjNw==', '867-5305 Magna Rd.', '+91', '+91 7387270931', '1689080539599', '1-185-557-2973', NULL, 0, 'F', '2017-12-22', 1, 1, 1, 1, '+91 5617971640', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(72, 'Libby', NULL, 'Durham', 'lacinia.mattis.Integer@id.edu', 'e10adc3949ba59abbe56e057f20f883e', 'YTg5OTFkNDJiYmM2YWRiYWJlMmQ2OWVmMWRkZjg2MjZhMGI5OTk2YWFiNzRiYTFlODQ0NGQyODI1ZDFlMTJmMQ==', '5778 Sed Avenue', '+91', '+91 2355430177', '1647110392599', '1-716-517-7434', NULL, 0, 'M', '2018-06-01', 1, 1, 1, 1, '+91 1191864507', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(73, 'Alea', NULL, 'Jacobson', 'natoque@lobortisaugue.net', 'e10adc3949ba59abbe56e057f20f883e', 'MWI1NTY4YWExODI2MTY3OGMxZDZlNzY5YzU3ZGZlZWFkMDYwNjFiZWU0OTUwYTAzMzQyN2Y0ZGE4NTRkOTNmNg==', 'Ap #807-7634 Quam Av.', '+91', '+91 8042183775', '1639032548399', '1-696-673-4766', NULL, 0, 'M', '2017-10-08', 1, 1, 1, 1, '+91 1683599121', '', 1, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(74, 'Geraldine', NULL, 'Dean', 'Nullam.lobortis@facilisismagnatellus.ca', 'e10adc3949ba59abbe56e057f20f883e', 'YTA3MTY2ZjBkN2ZhNTMzMzQ2ZmU0NjliYjk3NjI4ZTQ2YmQxMmI4MjY1ZjkyYmRjNTQyMmQ5YWI5ZTlkMTIyYg==', '7654 Mauris, Rd.', '+91', '+91 7728023618', '1657041384499', '946-7833', NULL, 0, 'F', '2016-08-14', 1, 1, 1, 1, '+91 3298473408', '', 5, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(75, 'Jordan', NULL, 'Copeland', 'eu.metus.In@ligulaDonec.com', 'e10adc3949ba59abbe56e057f20f883e', 'MGM3NzQxMDUwNTEzNTlkNGE2NzVjMzVmZGNlMWZjZTNkMDEwYTM4NmJmODNjMTk4MTJhNGEwYzIzMWQ4ZTU4Mw==', '5280 Donec Rd.', '+91', '+91 7852806103', '1648091315099', '371-2310', NULL, 0, 'F', '2016-10-03', 1, 1, 1, 1, '+91 4856298657', '', 6, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(76, 'Maris', NULL, 'Mcdaniel', 'mauris.elit@luctusCurabituregestas.net', 'e10adc3949ba59abbe56e057f20f883e', 'M2UwZGFhYTVjODE2MGRmM2JmNmI3NGIxMjVlNWJhMTgyMjAxMTQ0N2Q0ZmRjNDczMDY5YTUwMTlkYWYyYTI1NQ==', 'P.O. Box 570, 6799 Velit. Avenue', '+91', '+91 7058076691', '1654061817099', '1-155-421-2710', NULL, 0, 'M', '2017-08-11', 1, 1, 1, 1, '+91 2973178219', '', 6, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(77, 'Kasper', NULL, 'Dixon', 'convallis.dolor@sedpede.org', 'e10adc3949ba59abbe56e057f20f883e', 'MjBmMWYxODFmOWFjMGFlZDZiM2MxOWY0YjRhOWQ1NzA1YTcyNzZkNDdhZTY2N2M4NTFjYzBhNTMxNDFmMjhjNg==', 'P.O. Box 991, 2243 Nec, Street', '+91', '+91 9258619490', '1605070535599', '1-749-831-1899', NULL, 0, 'M', '2016-07-18', 1, 1, 1, 1, '+91 7746241610', '', 4, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(78, 'Jacqueline', NULL, 'Joyce', 'Mauris.vestibulum@auctorullamcorpernisl.ca', 'e10adc3949ba59abbe56e057f20f883e', 'YjljZWRhNmZiMmYyZGI0ZmVjMDc5N2EzNjI3YzYzZTA3ZTU3YTQ1NmQwOGYyYzQxNDVhODM3MzhiZDkyNTIxMQ==', 'Ap #900-5872 Nunc Road', '+91', '+91 2735127935', '1677041719899', '1-122-279-2807', NULL, 0, 'M', '2017-05-07', 1, 1, 1, 1, '+91 3298197505', '', 6, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(79, 'Unity', NULL, 'Mcbride', 'nec@tincidunt.co.uk', 'e10adc3949ba59abbe56e057f20f883e', 'ZGYyNTVlZWJmNzI4ODgwZjhhZjQyMmNmNDU4YTM0OWFmYTAwYmE1YzBlZTViNjVhZDgyMzcyMTc4YTljMTFmYw==', 'P.O. Box 467, 2440 Nullam Street', '+91', '+91 5336080491', '1600062516699', '1-101-192-6440', NULL, 0, 'F', '2017-04-03', 1, 1, 1, 1, '+91 7970078394', '', 4, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(80, 'Zenia', NULL, 'Santana', 'dolor@bibendumullamcorper.co.uk', 'e10adc3949ba59abbe56e057f20f883e', 'NzRhYjRhZDk0NGNlZTk0MDEzMzE3NGY2MjI5MDU0YzkwZDE4NGE0ZjRiZjQwMzUwZDJkNmQwNzhkNTQ2YjIxNA==', 'Ap #527-5269 Ac Road', '+91', '+91 2031238392', '1619120872799', '1-115-633-6964', NULL, 0, 'F', '2018-01-26', 1, 1, 1, 1, '+91 4019549533', '', 1, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(81, 'Brianna', NULL, 'Noble', 'tortor.at.risus@lobortisrisus.edu', 'e10adc3949ba59abbe56e057f20f883e', 'YTZhNDlmNTM3ZDU1OGY1YTA0NDljOTBkNzJhMTdkNTE0ZmY5MTJjZDA1Mzc4YjFlN2Y1NTdlMmY1M2M5ODQ4Ng==', '554 Pede Street', '+91', '+91 4115929885', '1694072008999', '609-8209', NULL, 0, 'M', '2017-03-14', 1, 1, 1, 1, '+91 4367525517', '', 1, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(82, 'Destiny', NULL, 'Carney', 'malesuada@vitae.co.uk', 'e10adc3949ba59abbe56e057f20f883e', 'ZmVkMjhiNTg4MzQwOTdmYjYyMTljNGY1ZTk0ODA3MzllMWZkYTk2ZTU3YTAxNzZjY2Q5ZjFlYzZjM2M4ZGNiMw==', 'Ap #849-172 Venenatis Rd.', '+91', '+91 3542113561', '1691081720199', '1-118-894-3427', NULL, 0, 'F', '2016-09-14', 1, 1, 1, 1, '+91 5380308460', '', 2, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(83, 'Sybill', NULL, 'Saunders', 'neque.tellus.imperdiet@vehicularisusNulla.org', 'e10adc3949ba59abbe56e057f20f883e', 'ZjM0OGFhZTg5NjQxZGVhZDJjNzk0NTk2NWEyM2U5MTU1MGNiYjU0MDY0ZTY3ZGI1ODI1YWQwYTAyYjZjMGEzMQ==', 'P.O. Box 450, 5379 Aliquam Road', '+91', '+91 1784808154', '1637011122999', '1-869-719-2484', NULL, 0, 'F', '2017-11-13', 1, 1, 1, 1, '+91 2653547975', '', 2, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(84, 'Leigh', NULL, 'Molina', 'amet@sedlibero.edu', 'e10adc3949ba59abbe56e057f20f883e', 'ZDFhMjNiMDE3ZDdjMjUyZTlhOGFlMzZlNzEwNzFkNmMwNDlmY2IwNmExNjFlZWJmZDM0ZTg2OGY3OTMzMWU5ZQ==', 'Ap #394-7713 Tincidunt Ave', '+91', '+91 2922491595', '1636042409299', '1-960-895-3363', NULL, 0, 'M', '2016-11-15', 1, 1, 1, 1, '+91 1405860075', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(85, 'Madison', NULL, 'Sellers', 'amet.consectetuer@quam.ca', 'e10adc3949ba59abbe56e057f20f883e', 'MDI0MjA3YjE0NTVhNTJkMzNhNWU2NDE4YTE1MmFhYThhMDFmNmVhMjRjM2ZiZTEyZjg4ZjkxZGY3YjA5NjJmYw==', 'P.O. Box 867, 9900 Curabitur Rd.', '+91', '+91 8912806407', '1634032559299', '1-807-868-4457', NULL, 0, 'F', '2018-02-03', 1, 1, 1, 1, '+91 3442812432', '', 4, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(86, 'Yael', NULL, 'Fernandez', 'semper@Donec.edu', 'e10adc3949ba59abbe56e057f20f883e', 'OTMxOTMyNjBlNTI3ODVkNWYxZTM0NDRjNzU3Y2FkNzU3MzM5MGFjYTkyNDAxNzVkOWEzOTk3MTMzZTU1NmIwZA==', 'Ap #509-2497 Integer Avenue', '+91', '+91 7701893416', '1661123095499', '726-5874', NULL, 0, 'F', '2017-04-07', 1, 1, 1, 1, '+91 7776407850', '', 2, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(87, 'Cheryl', NULL, 'Thomas', 'libero.Proin@habitant.org', 'e10adc3949ba59abbe56e057f20f883e', 'MDgxOGU1OTFhMTk3MzFjNDBhY2VhOGRlMGRjMGYyMGQzYTNkNjUxODgxYjUwNDRmMDY4YjQwODZlNTRmMTBlMg==', 'Ap #492-9916 Lacus. Street', '+91', '+91 8617217168', '1679022007999', '1-350-325-1171', NULL, 0, 'F', '2016-11-22', 1, 1, 1, 1, '+91 0449417279', '', 4, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(88, 'Desiree', NULL, 'Holt', 'facilisis.magna.tellus@odioNam.com', 'e10adc3949ba59abbe56e057f20f883e', 'NWQ2NWEwYzI2OTRhNmY5YzBmMmY2YWIwMzc2MzdkMmJjNDM1MmU0ODI4Njk3N2NiZDEzMmZiODkzMzFjMTRiNQ==', '212-2741 Arcu. Rd.', '+91', '+91 6860884087', '1659072548599', '1-970-171-3733', NULL, 0, 'M', '2017-06-14', 1, 1, 1, 1, '+91 6222862689', '', 2, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(89, 'Keefe', NULL, 'Wood', 'faucibus.leo.in@idantedictum.net', 'e10adc3949ba59abbe56e057f20f883e', 'M2Y0MmUwMDNlMjRhNmVjMjQ3OTZmMWM0OTY5NzQyMzUzZjIwMDkwYTM5N2I1Y2EzNDJhOTUwOGNhZTg1ZTE2Nw==', '7979 Maecenas St.', '+91', '+91 2953121357', '1644052169299', '1-195-425-7909', NULL, 0, 'M', '2016-11-23', 1, 1, 1, 1, '+91 0170906212', '', 5, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(90, 'Halla', NULL, 'Booker', 'sit@parturient.com', 'e10adc3949ba59abbe56e057f20f883e', 'YmRlNzM4MTdiOWIzNzk1ZjcxZjFkNWVlNTJlMGRhNGU0ZGIwOTBlYzZhMTdjNDVmN2FmNWFlMTYxMmJiYjYyYQ==', 'Ap #933-519 Phasellus Street', '+91', '+91 8486916255', '1684020485299', '440-0115', NULL, 0, 'M', '2018-01-30', 1, 1, 1, 1, '+91 4749642071', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(91, 'Blair', NULL, 'Bush', 'vitae.orci@dictum.co.uk', 'e10adc3949ba59abbe56e057f20f883e', 'YWQzYjk0MGYxN2M1MzlhMWQ5MWFmODFiZDZkM2MxMzE1YmIyYjdmYjI1ZGE0MGJmZWY0NGIwOTRiNjA1MDNmOA==', '687-5048 Nibh. St.', '+91', '+91 3551765924', '1647052858699', '151-6543', NULL, 0, 'F', '2016-11-12', 1, 1, 1, 1, '+91 4963407908', '', 4, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(92, 'Keefe', NULL, 'Tillman', 'eu.lacus@egestasurnajusto.net', 'e10adc3949ba59abbe56e057f20f883e', 'MjhlN2E4OTA5MzBjODA5MTk3YTYyOTIwMWRhNzY3YTViMmUxNzlkNWM4NDA5ZDkyOWMzM2M0MGFiMDQ5OTg3MQ==', 'P.O. Box 730, 2897 Feugiat Road', '+91', '+91 7911979833', '1606031773799', '811-0274', NULL, 0, 'M', '2016-08-27', 1, 1, 1, 1, '+91 0151710000', '', 6, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(93, 'Sophia', NULL, 'Wilkins', 'Praesent.eu.dui@lobortis.com', 'e10adc3949ba59abbe56e057f20f883e', 'OGUxYWQ5MjI3MjAwZTFlNzZjMzJkNzI5NjgyZmVlZmI2ODdkZDQxNzNhNWQ3ZmQyYWFkZDNlZmM5Mjk1MDQ4NA==', 'Ap #310-9553 Mi Ave', '+91', '+91 8499800574', '1645042300799', '773-1604', NULL, 0, 'M', '2017-07-26', 1, 1, 1, 1, '+91 7384028066', '', 2, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(94, 'Willow', NULL, 'Chambers', 'gravida.mauris.ut@Etiam.ca', 'e10adc3949ba59abbe56e057f20f883e', 'OGMxZWFhZjhjYmU2NTcxZTEyZWZmYzBjNjBjZjQxYWFmN2NkOWJlZWI4Yjg4MGUwMTY4MTNmOTlmNmIyNTcxNQ==', '6837 Facilisis Ave', '+91', '+91 8313999646', '1673020163099', '414-1150', NULL, 0, 'M', '2017-01-07', 1, 1, 1, 1, '+91 1441592004', '', 1, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(95, 'Hop', NULL, 'Duran', 'nibh.Aliquam@at.edu', 'e10adc3949ba59abbe56e057f20f883e', 'ZTE3Y2U3YzZjODM5Nzk5NDI2NmZiMjk4ZTBlNDVjZGYxZjNjODZmYTc2ZGVlOWVhMGE4MTUxNmFhOGJhMDdmMw==', 'Ap #267-2122 Vitae Av.', '+91', '+91 3374468289', '1681122473499', '501-2784', NULL, 0, 'M', '2018-02-08', 1, 1, 1, 1, '+91 1172175060', '', 6, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(96, 'Roary', NULL, 'Silva', 'Maecenas.iaculis.aliquet@In.net', 'e10adc3949ba59abbe56e057f20f883e', 'M2RkNTgxZTI0NTJiZmMyY2E0YTJjYzhhODIwNjNkNTk3NjczNWEzMzRjNDZlMTc2MmFkZDM0OTE1MzAwNzY5Ng==', '825-2754 Donec Avenue', '+91', '+91 5487503151', '1631051456899', '573-1436', NULL, 0, 'M', '2017-09-16', 1, 1, 1, 1, '+91 8293872339', '', 5, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(97, 'Christian', NULL, 'Malone', 'velit.egestas@loremsit.org', 'e10adc3949ba59abbe56e057f20f883e', 'NzQ1MTQ4ODA2M2JlYzQ1YThiNGVhNDRkMjdlMzAwOWM3ZmYzMGUwODcyOWM4NTdlN2EzNGViNTE4NjUxN2ExMQ==', '3969 Congue, Av.', '+91', '+91 5918987741', '1627122454499', '1-509-159-6936', NULL, 0, 'F', '2017-03-31', 1, 1, 1, 1, '+91 8092925828', '', 1, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(98, 'Christopher', NULL, 'Montgomery', 'urna@quam.edu', 'e10adc3949ba59abbe56e057f20f883e', 'MDFjNzg4YTVlMzU3YzRiNDNhMDMxOGFmMTAzMGJhYzdmNGVhNTA1NmJlYTM1ODU4MjAyNGFiMzI0MDFhMGU5OQ==', '793-6645 Turpis Road', '+91', '+91 2104956673', '1663060742999', '271-4000', NULL, 0, 'F', '2017-09-17', 1, 1, 1, 1, '+91 6891950812', '', 5, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(99, 'Cody', NULL, 'Mcclain', 'tellus.Nunc.lectus@arcu.com', 'e10adc3949ba59abbe56e057f20f883e', 'YjY5ZWY0ZjY1MDlkY2IxNzRiOGU0Y2I2NjZiNTNmYzNjZTBlMWZlMWEyMDMyNzdkNDM1ZTMyYzBlZTIwMGYyYw==', 'P.O. Box 645, 344 Gravida. Road', '+91', '+91 4640986946', '1678072379599', '384-9713', NULL, 0, 'M', '2017-08-04', 1, 1, 1, 1, '+91 2020553191', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(100, 'Maxwell', NULL, 'Morse', 'massa.Integer.vitae@massa.co.uk', 'e10adc3949ba59abbe56e057f20f883e', 'YmYzYmNiOWNiNDY5ZWQ0NzYwZjZkYzE2ZjVjOTFhMDJlMDRhNjMzZWNhOWJhNGNiOWJlMTcyNGFmZjBmMzQ2Mw==', 'P.O. Box 846, 1854 Cras St.', '+91', '+91 6727967022', '1600080888799', '340-0833', NULL, 0, 'F', '2017-06-15', 1, 1, 1, 1, '+91 9801405987', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(101, 'Abraham', NULL, 'Pena', 'molestie@diamDuis.co.uk', 'e10adc3949ba59abbe56e057f20f883e', 'ZjA5MjNiNTFmYmExZTg0YThjOWRhYmFjODRjM2RjNzdhYzdlMjg0NTVjNTMxMGY1ZTIwYjMxYjc5NDgwZWYyYQ==', 'P.O. Box 862, 8460 Nisl Road', '+91', '+91 9000251258', '1678022948399', '328-5551', NULL, 0, 'F', '2017-05-20', 1, 1, 1, 1, '+91 5738979830', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(102, 'Belle', NULL, 'Herring', 'libero.dui.nec@molestieorcitincidunt.edu', 'e10adc3949ba59abbe56e057f20f883e', 'ZTI5OWVmN2FkMDFkMGJkNDMzMTViM2Q2NjE5ZjNlMjQ2Nzc3MmZjOTcwOGRkZGFlNGE4MzhmMTczZjRmY2Y3OQ==', '278-9473 Vel St.', '+91', '+91 4687149040', '1622031803399', '869-8820', NULL, 0, 'M', '2017-05-26', 1, 1, 1, 1, '+91 9981246634', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(103, 'Quyn', NULL, 'Britt', 'at.velit@seddictum.com', 'e10adc3949ba59abbe56e057f20f883e', 'M2RkY2RmOWUzNjIwN2YzZjYyNDRiYWYxNzk0MmJhOWViMGUwZWYwZTU2NTcxZThiMTNjYzU5Yzk2OWJiYzQ4Zg==', 'P.O. Box 738, 1600 Proin St.', '+91', '+91 2008859161', '1614082343099', '714-7269', NULL, 0, 'F', '2017-02-04', 1, 1, 1, 1, '+91 6409315250', '', 2, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(104, 'Sebastian', NULL, 'Rose', 'Praesent.interdum@fringilla.org', 'e10adc3949ba59abbe56e057f20f883e', 'NmU2NGEwNjliZWNiNTgxYzUzODE2MTNhNjk1ZDBhZTE3NTBjZWZmOGUzZTA2NTIzMzhlZmIxNDk5MGM1N2Y1Nw==', 'Ap #908-6590 Et, Rd.', '+91', '+91 0914193417', '1671110911299', '850-8084', NULL, 0, 'F', '2018-02-27', 1, 1, 1, 1, '+91 1529122290', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(105, 'Quamar', NULL, 'Moody', 'a.sollicitudin@hendrerita.edu', 'e10adc3949ba59abbe56e057f20f883e', 'YTQzMzI4Yzc4ZTdiZTVlMjU1NTZiMWEyYWExOGNjY2YwMzU5NjFhN2VjYTkyMDg2OTcyNjI0MzMzMDAwMjhiZQ==', '109-420 Nisi Street', '+91', '+91 7019748668', '1629060858699', '1-125-561-5495', NULL, 0, 'M', '2018-01-29', 1, 1, 1, 1, '+91 2255763732', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(106, 'Courtney', NULL, 'Morton', 'vitae@tellusPhaselluselit.org', 'e10adc3949ba59abbe56e057f20f883e', 'MzU4YWJkZmZkYzVlYjdhZmU1OTdiODQ5ZWFjMTM3NmE0ZTdhYTU1ZjRhMTcyMjE4YjgxM2VjNTkzMGRkNGEyNA==', 'P.O. Box 707, 6933 Et Rd.', '+91', '+91 6993360243', '1692122012399', '765-6058', NULL, 0, 'M', '2017-08-16', 1, 1, 1, 1, '+91 6658637110', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(107, 'Laurel', NULL, 'Juarez', 'lacinia@velvulputateeu.edu', 'e10adc3949ba59abbe56e057f20f883e', 'NmNlYzgwNGM1OTIxOTZiMTRmYzRhMjBiYTE4ZGNmNWZmN2ZhYjM0NTg0Y2FiNmZmNTdjN2ZiMjVhYmI5Y2YwZA==', 'P.O. Box 772, 2611 Non St.', '+91', '+91 8576601968', '1637103099699', '573-5250', NULL, 0, 'F', '2017-07-15', 1, 1, 1, 1, '+91 0415739614', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(108, 'Shana', NULL, 'Gamble', 'mi@aliquet.com', 'e10adc3949ba59abbe56e057f20f883e', 'NjhlYjBiZDRjZTdjZDc3ZjFkYjBjYjYyZDE2NjAzM2RmMDg1Yzk5NmIwOTUxMzM5Y2QxODAxMDYyNjQ1NjlhNw==', '7448 Magna Ave', '+91', '+91 5261952407', '1624052858999', '212-5591', NULL, 0, 'F', '2017-11-17', 1, 1, 1, 1, '+91 8734678684', '', 5, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(109, 'Ingrid', NULL, 'Woods', 'volutpat.ornare.facilisis@hendreritDonec.ca', 'e10adc3949ba59abbe56e057f20f883e', 'YTY1Yjc5NDc0MGUxZTVlYjRhMzQ1ZWE5NTk1YzM4YzBhMDM0MmIxZWNmYWVhMmFiMDEyOGQ3MmM2MDJlMDZjYw==', 'P.O. Box 227, 3244 Non Street', '+91', '+91 2517147820', '1620060875399', '672-5118', NULL, 0, 'F', '2018-05-23', 1, 1, 1, 1, '+91 8864545827', '', 2, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(110, 'Derek', NULL, 'Terrell', 'vel.lectus.Cum@ipsumleo.ca', 'e10adc3949ba59abbe56e057f20f883e', 'MjAzOGE0ODM5MTQyMzlmZDQ0ZDE3MmJmOGEzNDI2Nzc1YzE4MzRhZDk4NDc4MGVkZjg3MjdhZjNkYzdjOTQ2Yw==', '287-4502 Magna. Street', '+91', '+91 1372400370', '1600082231999', '1-289-932-0788', NULL, 0, 'F', '2017-05-31', 1, 1, 1, 1, '+91 8081170381', '', 1, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(111, 'Imogene', NULL, 'Roth', 'mattis@natoquepenatibuset.co.uk', 'e10adc3949ba59abbe56e057f20f883e', 'OTQyZmIyYmIzNzMxMGRjMTViODAwOTdmMzY3OGJlYjlmMTg2YzRjOGVlNDI2OTY4NmQ1MTBjMTdiMGQ5NjhhMQ==', 'P.O. Box 561, 2374 Massa. Road', '+91', '+91 4837152043', '1679031046099', '666-7635', NULL, 0, 'F', '2018-05-30', 1, 1, 1, 1, '+91 2259704885', '', 5, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(112, 'Dacey', NULL, 'Wright', 'faucibus@lacusvariuset.com', 'e10adc3949ba59abbe56e057f20f883e', 'MThiZDdjYjhjODdjMzVjYjI1NjJjMmU1ODZhNDdjOGJkYzVlMTlmMDg2M2Y2ZTZlYTcyZTk5ZDI2NDJiODM3Mw==', '2449 Montes, Ave', '+91', '+91 4647020166', '1632081951599', '1-199-390-4598', NULL, 0, 'M', '2018-01-16', 1, 1, 1, 1, '+91 2474941949', '', 6, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(113, 'Sandra', NULL, 'Mercado', 'varius.et@nisl.com', 'e10adc3949ba59abbe56e057f20f883e', 'MWYzOWZkZDY1Y2M0ZDQ5YjE0NzllYjU1YTkwN2IwODNhMjA1MmY0ZjRjYjUyYjRjNWMzMjc3ODMwOWU5MjA1NA==', 'Ap #251-4075 Luctus. St.', '+91', '+91 8641158267', '1614122365699', '247-7952', NULL, 0, 'F', '2016-09-13', 1, 1, 1, 1, '+91 9198819741', '', 5, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(114, 'Faith', NULL, 'Craig', 'nisi.nibh.lacinia@feugiatplacerat.net', 'e10adc3949ba59abbe56e057f20f883e', 'MGI2NWQ3N2M3YWY1MTQ3YmIyMjVhYWY4YTA0NGE5M2ZiODVhZmMzMTY1YTg2NGJjOWJjOGE5YjhkMzljY2UyNg==', '405-2992 In Rd.', '+91', '+91 4381379345', '1679080115299', '783-8756', NULL, 0, 'F', '2017-01-12', 1, 1, 1, 1, '+91 4413129215', '', 1, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(115, 'Martin', NULL, 'Lowery', 'vestibulum.Mauris.magna@veliteu.com', 'e10adc3949ba59abbe56e057f20f883e', 'YzJkYTA4ZjFjMDYwYzgwODQ4YWZkOTE0NjEzNDA0YTM1MzZmNTMzMmNhNTdjNzQ4ZmQ4MDlmYmYxODI5NmNiYg==', 'P.O. Box 832, 3146 Et, Rd.', '+91', '+91 2488937447', '1630040586099', '279-8105', NULL, 0, 'M', '2018-04-28', 1, 1, 1, 1, '+91 9480014610', '', 4, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(116, 'Rhea', NULL, 'Vega', 'sapien.imperdiet.ornare@mattisornare.ca', 'e10adc3949ba59abbe56e057f20f883e', 'MjlhZWRiMTQyZjUxMWVkOWZkODg5M2ZmMzA3NjdkMmM0YzA1ZmNmOTc1MWY3MTkwMDQxZWQ4NjEyNzIxMzQyYQ==', '6398 Aliquet St.', '+91', '+91 6887632607', '1685081367299', '1-520-249-6704', NULL, 0, 'M', '2016-10-24', 1, 1, 1, 1, '+91 2877071345', '', 2, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(117, 'Asher', NULL, 'French', 'Curae@ante.org', 'e10adc3949ba59abbe56e057f20f883e', 'MWFjZmE2YTAyNmEzNDVjNzgzYmUxZWZjYjFkMGViNWM2MTcwYmU1YTM3MzkwNTA0NDM5MDdkNGM5NWUzY2IzOQ==', 'Ap #416-3341 Non St.', '+91', '+91 8471692153', '1670012583199', '856-6349', NULL, 0, 'M', '2017-09-21', 1, 1, 1, 1, '+91 4323116413', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(118, 'Anika', NULL, 'Hogan', 'pretium.neque@risusDuisa.edu', 'e10adc3949ba59abbe56e057f20f883e', 'OGE0ZDBiMzg4MTMyZDg1Yjk5Nzc4ZjdlNjg4Njk0YjhlODlmNTgzOGRlMjg0M2VjNmJkZmRmZDExYWNmY2NmNQ==', '743-3040 Quis Rd.', '+91', '+91 7712994420', '1603030562499', '678-5301', NULL, 0, 'F', '2016-07-13', 1, 1, 1, 1, '+91 4106075325', '', 6, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(119, 'Phillip', NULL, 'Preston', 'diam.vel@erat.co.uk', 'e10adc3949ba59abbe56e057f20f883e', 'MmRjZGI0YzM3N2VhZGI5MGY3NzI5MzdkMDY1OGUwZWE2NjIxNDkwOGUxMzE0OTIyNDJhNjUxYWNlY2NmYWE3MA==', '467-4233 Sed Street', '+91', '+91 1596598020', '1624010439399', '1-740-564-7635', NULL, 0, 'M', '2017-06-01', 1, 1, 1, 1, '+91 7264904305', '', 6, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(120, 'Simone', NULL, 'Chavez', 'nulla.vulputate@fermentumfermentum.com', 'e10adc3949ba59abbe56e057f20f883e', 'NWJiY2NmZTBjZDVhM2FhZjIyNDgzMjE3ZTMxYjdkNDVlZDUwYjM1NGQ0NDlkYjMzN2U5YThiZjc3NWY3ZTQxOA==', 'P.O. Box 840, 833 Magna. St.', '+91', '+91 6320346959', '1687122460899', '1-625-996-0645', NULL, 0, 'F', '2018-05-19', 1, 1, 1, 1, '+91 5275099634', '', 2, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(121, 'Sharon', NULL, 'Silva', 'molestie@velitCras.co.uk', 'e10adc3949ba59abbe56e057f20f883e', 'MDA1NTQ2N2FhODA5MTg5MzAwYzZjMTIzNTY2ODMyMGI3MWVmMzA3NzUzMTU0OTJjMDg1OWZmOTFkZDk2OGMwNA==', '237-5136 Consectetuer Av.', '+91', '+91 7320670343', '1624122293599', '1-448-736-3538', NULL, 0, 'M', '2017-09-28', 1, 1, 1, 1, '+91 6658787718', '', 1, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(122, 'Upton', NULL, 'Mathis', 'orci.lobortis.augue@elitpretium.net', 'e10adc3949ba59abbe56e057f20f883e', 'ODJhZTcxZjhlMDJhY2NjY2NmNGFmODQ3OGIzYzU4MGFjMGU5N2MwMmI4ZDQ1MjgzMDNiNTBmZDlkNmVmNTU0MA==', 'P.O. Box 939, 9599 Lorem Rd.', '+91', '+91 8875075839', '1607021104199', '1-397-613-5164', NULL, 0, 'M', '2016-11-12', 1, 1, 1, 1, '+91 7491364708', '', 1, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(123, 'Jasper', NULL, 'Hardy', 'Ut.nec.urna@velit.co.uk', 'e10adc3949ba59abbe56e057f20f883e', 'N2YxMmI0MzQ3YTJiYjA1YWQyZjFmMGI1YjNlNWViNjRjZmMyZWE5MDcwZjhiMDBlOWJiNjVhM2NkYzk3MmI5Nw==', '4464 Neque Av.', '+91', '+91 4921950462', '1676061993399', '210-8601', NULL, 0, 'M', '2018-03-18', 1, 1, 1, 1, '+91 9778616418', '', 2, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(124, 'Stacey', NULL, 'Livingston', 'dictum.augue.malesuada@elitAliquamauctor.com', 'e10adc3949ba59abbe56e057f20f883e', 'MDdmNDg2N2NhMDQ0NzMzYjA5ODc0OGE5ZGFiYzUxMjVjMGU1NDllOGEzM2UyZjA3OWRiOTUyMjc5NjA0NzU5ZQ==', 'Ap #975-9608 Auctor, St.', '+91', '+91 4990584372', '1608011417399', '1-537-670-1216', NULL, 0, 'F', '2017-09-10', 1, 1, 1, 1, '+91 3986985701', '', 4, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(125, 'Sydney', NULL, 'Warner', 'adipiscing.elit@arcu.co.uk', 'e10adc3949ba59abbe56e057f20f883e', 'MDBmY2YzZTBlNjhkMGY3NzIyZjUwNjNhNWYyNTcwNmJiODBkOGVmZmUyM2JiZWMxODRlNWY4ZGNjNjY1M2U3Ng==', 'Ap #152-1444 Sit Street', '+91', '+91 9211216248', '1654040194499', '1-829-958-0135', NULL, 0, 'F', '2016-08-09', 1, 1, 1, 1, '+91 4548531660', '', 1, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(126, 'Cassandra', NULL, 'Aguilar', 'diam@velitAliquam.com', 'e10adc3949ba59abbe56e057f20f883e', 'NDNkNTc1ZWIxY2UwMGE4Y2FiNTJjNWExYmNlM2NjMzAyODQxMGQwY2MyNWEzYmUyZTFkYWZjYjQwNzlhMmI2Yg==', 'Ap #231-9380 Mauris. Avenue', '+91', '+91 6979509862', '1654061886599', '386-4433', NULL, 0, 'M', '2017-12-05', 1, 1, 1, 1, '+91 7860457492', '', 6, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(127, 'Evelyn', NULL, 'Riddle', 'per.conubia.nostra@pellentesque.org', 'e10adc3949ba59abbe56e057f20f883e', 'OGQxMzVhZjMzMzcxOTJjMDAyMzg2M2I2OGVhMGRhOGQzZmNhYWNhMTc3NjEzMjQ5ZGY0NzE5NDUxZWQ2YzVlMw==', 'P.O. Box 441, 7323 Dignissim Avenue', '+91', '+91 0475634688', '1692010738499', '1-110-193-9299', NULL, 0, 'M', '2017-07-01', 1, 1, 1, 1, '+91 4838983344', '', 4, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(128, 'Amanda', NULL, 'Galloway', 'eget@Donecatarcu.org', 'e10adc3949ba59abbe56e057f20f883e', 'MDJjNzk4MzkzNzkxYWVjNzFlMzMzOTAxODRkODBiYzFmYTZjOTFhODVjZmRjZDBjOGY3MmY0OTRjNDUzNmFhYQ==', '807-2612 Nunc. Street', '+91', '+91 0320668637', '1635102160799', '1-302-350-0123', NULL, 0, 'M', '2017-07-12', 1, 1, 1, 1, '+91 8363399166', '', 2, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(129, 'Celeste', NULL, 'Barry', 'magna.Duis.dignissim@elementum.edu', 'e10adc3949ba59abbe56e057f20f883e', 'MWIzYTMwOWM1NzRmMDY3YzdjZjVmYTQyNDk2NDdjOTQ4MzFlMGYxZGZlOWM0MDk3MTllODhjNTk2OWJhN2JiMA==', 'P.O. Box 795, 1116 Nunc St.', '+91', '+91 9132274022', '1678122554699', '337-3714', NULL, 0, 'M', '2017-05-26', 1, 1, 1, 1, '+91 8325465260', '', 4, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(130, 'Aubrey', NULL, 'Montgomery', 'varius.et.euismod@Nuncmauris.ca', 'e10adc3949ba59abbe56e057f20f883e', 'MmI2NWNkZjM1ZjY5OWE2ZjA4YzRiMWM2NDFmNTc5MzExZTJhOGRkMjE5YzUzZDI2MmNiOTNjNTBmYjg2OTYwYw==', 'P.O. Box 962, 1380 Congue, Street', '+91', '+91 9943678932', '1614080657199', '789-1392', NULL, 0, 'M', '2017-08-22', 1, 1, 1, 1, '+91 6817679511', '', 5, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL);
INSERT INTO `hms_users` (`id`, `first_name`, `MiddleName`, `last_name`, `useremail`, `password`, `my_key`, `address`, `CountryID`, `mobile`, `aadhaar_number`, `phone`, `profile_photo`, `hospital`, `gender`, `date_of_birth`, `city`, `district`, `state`, `country`, `alternate_mobile_number`, `description`, `role`, `isActive`, `isDeleted`, `created_at`, `updated_at`, `forgotPassCode`, `isRegister`, `hasSelectedRole`, `EmailVerified`, `MobileVerified`, `LastLogintime`, `LastLogouttime`) VALUES
(131, 'Amela', NULL, 'Humphrey', 'a.aliquet@augue.ca', 'e10adc3949ba59abbe56e057f20f883e', 'NDFmMzAwNmQzN2MxODYzY2I0OWEwNzY0NGJiYWRjZWI2MzM0YWQ4NzU0ZDhjZTZkNjQ1YmIyZDQyYWM5NTJkNQ==', 'Ap #190-6984 Et, Rd.', '+91', '+91 6352104236', '1619021899599', '1-922-621-3256', NULL, 0, 'F', '2017-12-14', 1, 1, 1, 1, '+91 9738898569', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(132, 'Honorato', NULL, 'Rodgers', 'sapien@arcuNunc.net', 'e10adc3949ba59abbe56e057f20f883e', 'NjBlMzkzZDY4MjViYjJhOTliYmIwYmQ0NGE0MTYwNzZjOTYyNjAzYTJhMWU5ZTMzMDEwYzU5OTJhZjA4ZjJiNg==', '4263 Eros Avenue', '+91', '+91 1151390225', '1690112135299', '1-461-116-2804', NULL, 0, 'F', '2017-11-07', 1, 1, 1, 1, '+91 2960126608', '', 5, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(133, 'Xantha', NULL, 'Battle', 'dictum@placerat.co.uk', 'e10adc3949ba59abbe56e057f20f883e', 'YzQ2NWYwZGQ0ZDYzMjA0M2FkNjY4YzRiOTNkNzY4YWRhMGFhYjMzY2JlMDQ4OGM3NWIxN2E0ODY2NWZmMjMwZg==', '717-3883 Hendrerit Street', '+91', '+91 1765367457', '1602080505499', '102-7984', NULL, 0, 'M', '2017-03-20', 1, 1, 1, 1, '+91 0219926793', '', 5, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(134, 'Michael', NULL, 'Bird', 'a.ultricies@ultricesDuis.net', 'e10adc3949ba59abbe56e057f20f883e', 'NWIxYTY2YjVmNTg3MTAxYzY4YzRjYjQ4YzI3NjI2NjRjNGI3Zjk3OTRlY2Y4MmZlMTFlMzBhMzgzNmY1MGZmYw==', '7553 Semper Rd.', '+91', '+91 2346491987', '1634070157399', '1-981-387-4795', NULL, 0, 'F', '2017-06-13', 1, 1, 1, 1, '+91 0727522912', '', 1, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(135, 'Berk', NULL, 'Pacheco', 'ante.blandit@eratSed.co.uk', 'e10adc3949ba59abbe56e057f20f883e', 'ZDk4ZjUxZDJjOGIzODk4YmZhYmQ3ZGY1MjZmMGExODdkMjllNjA5OTFlMzg5NWM3ZDc3MzI3YWM0MTA5ZmEzMg==', 'P.O. Box 254, 5833 Viverra. Road', '+91', '+91 8853908664', '1663102533999', '1-367-944-4514', NULL, 0, 'M', '2017-11-06', 1, 1, 1, 1, '+91 0902389425', '', 6, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(136, 'Edan', NULL, 'Joyner', 'parturient@sitamet.edu', 'e10adc3949ba59abbe56e057f20f883e', 'MmNkMmU5ZmUyZWRlMTcxOTE1YzEwOWI0OTg4ZGJiYjY3NDNmYmJkMThlYjNiN2M5OGY3ZjM1ZWViZWM3ZDUwMQ==', '112-5959 Mi Ave', '+91', '+91 6004834420', '1663121388599', '1-274-175-2307', NULL, 0, 'M', '2016-09-12', 1, 1, 1, 1, '+91 7065926385', '', 1, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(137, 'Brennan', NULL, 'Rios', 'vulputate@Aliquamgravida.org', 'e10adc3949ba59abbe56e057f20f883e', 'NzE5ZDk5MmQ4MWFjM2FkOGZlMGU3OWRkMGFlMmE4MDI1YWM2MDZkZTJlYmRmMjBiNTBlYTQwM2IxZjFjYWFkZA==', '527-3465 Ipsum St.', '+91', '+91 4183582306', '1684010433099', '1-270-901-2496', NULL, 0, 'F', '2018-06-12', 1, 1, 1, 1, '+91 0070294270', '', 4, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(138, 'Whilemina', NULL, 'Reed', 'odio@a.ca', 'e10adc3949ba59abbe56e057f20f883e', 'ZjVlMzI2YjViNGQ0M2UzN2FiMGEwZmE5YWJlOTFiMWMyZjEzYmYyNzIyM2E5YmViMTNkYWNiNzc3N2JiZjk0MA==', '936-4138 Nam Rd.', '+91', '+91 6299362241', '1655081440799', '762-7869', NULL, 0, 'M', '2016-11-16', 1, 1, 1, 1, '+91 8170373334', '', 4, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(139, 'Selma', NULL, 'Britt', 'amet.consectetuer.adipiscing@Sedeu.com', 'e10adc3949ba59abbe56e057f20f883e', 'YWIwZmRlOGRhYTQ0YjBiMDJhZDc1NmQzMGVkZGE3MDUzZjU5ZmVkNjYxMTg5NGFjMGM4NWEwNWM4MmU4ODBkZA==', '5749 Cum Road', '+91', '+91 2841818084', '1601042984999', '859-2008', NULL, 0, 'F', '2018-05-28', 1, 1, 1, 1, '+91 8061980408', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(140, 'Leila', NULL, 'Levine', 'ac.facilisis.facilisis@adipiscingfringilla.net', 'e10adc3949ba59abbe56e057f20f883e', 'MTlmMzZmZjAyNjNkMTRjYmM2MGZkOWM0NzE4ZWJiYmZhYjkyODM2MjNlMmFmNWMzNzUwNTNjYTdlOWU0NzUxMA==', '7879 Posuere Ave', '+91', '+91 9881393396', '1611102608499', '1-837-576-2121', NULL, 0, 'M', '2018-04-02', 1, 1, 1, 1, '+91 3455294213', '', 1, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(141, 'Karleigh', NULL, 'Molina', 'commodo.auctor@turpisAliquamadipiscing.org', 'e10adc3949ba59abbe56e057f20f883e', 'N2RkMTgxMmRmODYyY2ZjNmM4MGFhNTM5ZWY5MGVlMjA5NzUwNTZiODc0ZmM4MWJhMmQzNDQ5ZjFkZjMzZGJmOQ==', 'P.O. Box 794, 4479 Nullam Av.', '+91', '+91 0762591308', '1645063079099', '405-5373', NULL, 0, 'M', '2017-06-06', 1, 1, 1, 1, '+91 1473566477', '', 3, 0, 0, '0000-00-00 00:00:00', '2017-06-20 19:29:32', NULL, 1, 0, 1, 0, NULL, NULL),
(142, 'Yogesh', NULL, 'Patel', 'drravi123@lms.com', 'e10adc3949ba59abbe56e057f20f883e', 'MTg5MDFhMjNmNGM3YThiODVkMDg2YzU0MmI5NTliOTA5ZjNhNzE1MGJiMTc3Y2FjY2NmMDZiZWE1MDlmY2M1OQ==', '', '+91', '4123643214', '321409875412', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', 'asdfasdf', 3, 0, 0, '2017-06-28 08:38:21', '2017-06-28 14:08:21', NULL, 1, 0, 1, 0, NULL, NULL),
(143, 'Yogesh', NULL, 'Patel', 'yogesh@tc.in', '', 'Nzc4ZWMyYjY4YTZjYTkwOGFiM2Y3ZGQzZDczYjRhODZjMGZlYWZkZDczYmFmMmZkMGQ0YjdlODY2YWI0NTFkZQ==', NULL, '+91', NULL, NULL, NULL, NULL, 0, '', '0000-00-00', 0, 0, 0, 0, '', '', 6, 0, 0, '2017-07-23 05:16:53', '2017-07-23 10:46:53', 'F4373EAAF7', 1, 0, 1, 0, NULL, NULL),
(144, 'Depp', NULL, 'patel', 'deep@tc.in', '', 'ZmFlNjk5NTk4ZWFhZWE0ODUwOTQwZmUxNjkzYzgzY2U5MTdiM2JmNGI5YjY5NDU1YWNkYTc1MGM4ZTNiM2FlNQ==', NULL, '+91', NULL, NULL, NULL, NULL, 0, '', '0000-00-00', 0, 0, 0, 0, '', '', 6, 0, 0, '2017-07-23 05:27:25', '2017-07-23 10:57:25', NULL, 1, 0, 1, 0, NULL, NULL),
(146, 'Yogesh', NULL, 'Patel', 'patelyogesh093@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'ZGM5N2JhYjMxNTU1M2ViN2Y3NDIzZGQzNjEyYmJiZGQ5NGNiYjYzNDM4ZjMzMjliODRmYWE2M2M5YjUxZTFhMg==', '', '+91', '9099910200', '1239012301231', NULL, NULL, 0, '', '1970-01-01', 0, 0, 0, 0, '', '', 4, 1, 0, '2017-09-03 12:04:38', '2017-09-03 17:34:38', NULL, 1, 0, 1, 0, NULL, NULL),
(147, 'Parash', NULL, 'Oza', 'parash@oza.com', 'e10adc3949ba59abbe56e057f20f883e', 'OTNjNDNmNDVlMzk4ZTM2Njk0ZjY4YjYyZmNhYzMxYmJmYTIxYWM4N2QwNWU3ZTQyYjkwMjNiMjBlM2UxMzMwNg==', 'AAS', '+91', '9909904325', '123456789123', NULL, NULL, 0, 'M', '1979-12-31', 1, 1, 1, 1, '', 'MD MDH', 3, 0, 0, '2017-09-12 06:51:52', '2017-09-12 12:21:52', NULL, 1, 0, 1, 0, NULL, NULL),
(148, 'Amit', NULL, 'patel', 'vire@d1yun.com', 'e10adc3949ba59abbe56e057f20f883e', 'Yzc4ZWUwNzIxYmVlNWE2NjZjMzlmZDMxOGYxNTI3NDI5NjdjYjlkMmZkNmM0MjhkMWRlM2U4NGY1MmZlODBhYg==', '', '+91', '1235089650', '123201478653219', NULL, NULL, 0, 'M', '2017-09-12', 1, 1, 1, 1, '', 'MDH MD Surgen', 3, 1, 0, '2017-09-12 07:05:39', '2017-09-12 12:35:39', NULL, 1, 0, 1, 0, NULL, NULL),
(149, 'New', NULL, 'User', 'newuser@gmail', 'e10adc3949ba59abbe56e057f20f883e', 'NTdkNWNiZGQ3NTIwNDg0MDM3ZDBjM2IxYzI5Y2NmOGIzZGZjNjBiY2FlODVlYzUyNTQxM2M5YzVjNWYxYzYxOQ==', NULL, '+91', '9010901012', NULL, NULL, NULL, 0, '', '0000-00-00', 0, 0, 0, 0, '', '', 6, 1, 0, '2017-09-15 05:42:32', '2017-09-15 11:12:32', '7063F2E2C8', 1, 0, 1, 0, NULL, NULL),
(150, 'Amit', NULL, '', 'test@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'M2E2YmRjYjhmM2FiOTA3ZTQ3M2JiMzAzNDBjYjU1YmIxZmUxZWE5NGUxMmMwODFkZjk2NWVmNTUzNzRjOWRjOA==', NULL, '+91', '9099910272', NULL, NULL, NULL, 0, '', '0000-00-00', 0, 0, 0, 0, '', '', -1, 0, 0, '2017-09-23 06:04:05', '2017-09-23 11:34:05', 'F7A0212789', 1, 0, 1, 0, NULL, NULL),
(154, 'New', NULL, '', 'ramesh@tc.com', 'e10adc3949ba59abbe56e057f20f883e', 'ZDMzYThlMjliZDQ1YWU1NWVmN2U4NTEyNGIyNmJkYTFlYzAwMDRmODc5NWE2ZDY0MmU2ZDAxZTI4ZjdjZGY4YQ==', NULL, '+91', '2132354123', NULL, NULL, NULL, 0, '', '0000-00-00', 0, 0, 0, 0, '', '', 3, 1, 0, '2017-10-07 09:05:24', '2017-10-07 14:35:24', NULL, 1, 0, 1, 0, NULL, NULL),
(153, 'Yogesh', NULL, '', 'patelyogeshawp@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', 'YzM2ZGVmNzkzOTk3M2I4ZWVkZTYxZGYwNjYwZDU0NzZiOTVjZDlmNDc0MzUwZDE3M2Y3ODU3YjNkYTBhMzAyYg==', NULL, '+91', '9099910278', NULL, NULL, NULL, 0, '', '0000-00-00', 0, 0, 0, 0, '', '', 6, 1, 0, '2017-09-25 05:34:51', '2017-09-25 11:04:51', NULL, 1, 0, 1, 0, NULL, NULL),
(155, 'Twinkal ', NULL, 'Patel', 'twin@gmail.com', '00bc971f92dd0b23e4a68dfe095d3173', 'N2I2NTIwN2NhYjY4ODM2NTM3YTE0NGYwYWZlOTQ2M2U2YjhlNTZkZjJkZDZiNGI3MTI0ZmUxZWMxNmNiOGY3NA==', 'Ahmedabad', '+91', '9737420101', '12301204578012', NULL, 'http://localhost/mypulse/public/images/ux/155.png', 0, 'F', '1996-02-16', 1, 1, 1, 1, '', 'Doctor', 3, 0, 0, '2017-10-24 14:27:30', '2017-10-24 17:57:30', '9665F52C11', 1, 0, 1, 0, NULL, NULL),
(156, 'rajshekar reddy', NULL, 'gaddam', 'raj@xyz.com', '827ccb0eea8a706c4c34a16891f84e7b', 'NWJkYzUzNmVmMzA4MDc5ODZhMzQxNjRkM2ZkYzcxOWY0ZGQxNTg1ZmY0YzJmZTJiNzMzM2ZhZTQ5OWNmYTQ5YQ==', '', '+91', '8868686868', '1234-5678-9012', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', 'raj', 3, 0, 0, '2018-06-05 16:10:57', '2018-06-05 16:10:57', 'C23CC4C3BF', 1, 0, 1, 0, NULL, NULL),
(186, 'sazeed', 'S', 'P', 'sazeed@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'NDljNDZkYjg2MTEyOGEzYmVmOTZlZjQ2NmY4M2QyMTQzNzk0YWQxODYzZWMwNGRkOTM5YjBjZTlkNzNiMzJkNg==', '', '+91', '9059786101', '', NULL, NULL, 0, 'M', '1910-02-01', 0, 0, 0, 1, '5446422', 'abradkidabrad', 3, 1, 0, '2018-07-15 08:08:11', '2018-07-15 08:08:11', NULL, 1, 0, 1, 0, '2018-07-18 15:48:38', '2018-07-18 15:49:41'),
(163, 'Sekhar', NULL, '', 'vrreddy@gmail.com', '473897dcf9d235f5498904a3adde607d', 'NzgxNmU0ZDI1NmYzZTQyZTZjZTYzZmM4YWVjOGU2NGIyNzRkYjVkNDg1M2RmMmNhNmZmMWZiNzY0Y2ZiZmY4MA==', NULL, '+91', '4386493494', NULL, NULL, NULL, 0, '', '0000-00-00', 0, 0, 0, 0, '', '', 6, 1, 0, '2018-06-12 15:18:50', '2018-06-12 15:18:50', 'CE79B97908', 1, 0, 1, 0, NULL, NULL),
(164, 'First', NULL, 'Last', 'first@xyz.com', '473897dcf9d235f5498904a3adde607d', 'YjY5Yjc4MDYyYTY3NzdlMTNiMzcxMGJiNDQzNWI1ZTg0Zjk4YzUyMGQ2YTZmZDM4MTIxNDRjZDBmMDIyZjhkZA==', '', '+91', '9346969210', '1234-5678-9123', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', 'General Doctor', 3, 1, 0, '2018-06-12 15:26:23', '2018-06-12 15:26:23', 'A3A0F34FFA', 1, 0, 1, 0, NULL, NULL),
(183, 'hospitaladmin', '', 'two', 'hospitaladmintwo@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'MTgxMDQzYWZlZTc1NjE2MDFlNjlmNDBlMzE1ZjY3ZDQ5OTBkZTc5ZWM1MmJhYWY1NzIyZDM0YzI3N2RkZTg2Mw==', '', '+91', '1234567890', '', NULL, NULL, 0, 'M', '1970-01-01', 1, 1, 1, 1, '8374982782', 'ha', 2, 1, 0, '2018-07-14 04:46:02', '2018-07-14 04:46:02', NULL, 1, 0, 1, 0, '2018-07-16 09:36:59', '2018-07-15 06:18:30'),
(184, 'sazeed', NULL, '', 'sajid@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'YjIxMGM5MmNmYzNmZDE1Zjg4N2EwODZkOGFjZjkwMGU5M2ZlNDRiMWJmY2MwMDFjYzdlZTU2NWFhOTFjZDlmNg==', NULL, '+91', '9059786100', NULL, NULL, NULL, 0, '', '0000-00-00', 0, 0, 0, 0, '', '', 6, 1, 0, '2018-07-15 06:23:55', '2018-07-18 16:01:04', NULL, 1, 0, 0, 1, '2018-07-25 02:22:47', '2018-07-25 02:25:11'),
(180, 'doctor', '', 'one', 'doctorone@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'ZmIwM2Y2OTU0NDYxMWMwZmIzZGM1NmNhZjgwNTg4NzFhZjk5YTE0OGY1MDFmODAxMzAzM2Y1N2JkOTMzMGY3Yg==', 'kdnck', '+91', '9059786108', '8749-3473-2483', NULL, NULL, 0, 'M', '1970-01-01', 1, 1, 1, 1, '12', 'np', 3, 1, 0, '2018-07-12 15:53:32', '2018-07-12 15:53:32', NULL, 1, 0, 1, 0, '2018-07-13 04:01:43', '2018-07-13 03:56:12'),
(181, 'receptionist', '', 'one', 'receptionistone@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'Y2QzNWRhOTQ1MTEwMzkxM2E3NzA2ZmI5YTllZjJkYzE5M2E1Y2NjZmU1NmRmODM1MWM0YTlmYjQ1MTBlMTY2Yg==', 'jnjkdjd', '+91', '8708989043', '7928-3749-8723', NULL, NULL, 0, 'M', '2018-07-17', 1, 1, 1, 1, '8', 'handling appointments', 5, 1, 0, '2018-07-13 02:20:53', '2018-07-13 02:20:53', NULL, 1, 0, 1, 0, '2018-08-12 05:40:25', '2018-07-28 10:05:25'),
(187, 'ravi', NULL, 'kumar', 'ravi@sigmaedge.com', '827ccb0eea8a706c4c34a16891f84e7b', 'ZTJkMDYzNzljMTRlYWZiNjYzYTQ2Y2M1MTc4NDc3NDRiZmExMDVkNmQwMjVkN2MxZGQ0MDRhNWRjNmE5MDFiMA==', NULL, '+91', '8686824761', NULL, NULL, NULL, 0, '', '0000-00-00', 0, 0, 0, 0, '', '', 6, 1, 0, '2018-07-21 08:03:33', '2018-07-21 08:10:46', 'CAA76C034F', 1, 0, 0, 1, '2018-08-03 02:58:01', '2018-08-03 03:30:38'),
(188, 'sajid', NULL, '123', 'spsajid541@gmail.com', '473897dcf9d235f5498904a3adde607d', 'N2ZhOTQyOGFhMjVjNDAxMjYxMWRhODIyOGE3MjcwYzYyYTg4ZjJkZjI3Yjg1YWJlMmU2NTI2Y2FjMzAxNzE4ZQ==', NULL, '+91', '9059786106', NULL, NULL, NULL, 0, '', '0000-00-00', 0, 0, 0, 0, '', '', 6, 1, 0, '2018-07-21 12:00:44', '2018-07-22 07:32:36', 'CFF3B3ED01', 1, 0, 0, 1, '2018-07-25 02:46:45', '2018-07-25 02:46:30'),
(189, 'ravi', 'kumar', 'kolluru', 'ravikumarkolluru@gmail.com', '', 'ODUxYmQ5N2RjMjc4ZWI2Y2Y5ZTUxN2JlY2JjM2Q0YWFkZTlkMDE3OTU1YzQ0MjhiNzg2ODIyNDQyNzgzNDk2Mw==', '', '+91', '9985531552', '', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', 'ravi kumar kolluru', 4, 1, 0, '2018-07-22 08:26:44', '2018-07-22 08:26:44', 'DB6F30CA7F', 1, 0, 0, 0, NULL, NULL),
(190, 'ravi ', 'kumar', 'kolluru', 'ravkumar@gmail.com', '', 'NTQzYTQ1NzEwMGM0MGIwYjFkNDM1YmQ4OWZlYjU4YWU2ODhlNzFmNDM4NDcyYTE2ZjRjZjBiY2MyZmUxMmUyOA==', '', '+91', '8525845645', '', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', 'ravi kumar', 4, 1, 0, '2018-07-24 03:11:57', '2018-07-24 03:11:57', '112A694601', 1, 0, 0, 0, NULL, NULL),
(191, 'ravi ', 'kumar', 'kolluru', 'ravik@gmail.com', '', 'ZjRlZjg1ZWE0NWYxNjY5OWQ1N2Q0ZDcxM2U1ZWJmNjg2MzZlNGRkMmIzOGYxZDZhYzc4OTc4NWE0MmYzNDg1MQ==', '', '+91', '5858787856', '', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', 'ravi kumar kolluru', 5, 1, 0, '2018-07-24 03:19:13', '2018-07-24 03:19:13', '7D978A0A1F', 1, 0, 0, 0, NULL, NULL),
(192, 'salavuddin', NULL, 'm', 'salavuddin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'NGFkZGM3YTE2MjAwNDk4ZTRlMDI2ZmYyNzI1MTU3ZjA3NDYzZTgzYmI5NDY1Y2NhMWZlMWUyMTViMWY1N2M3ZA==', NULL, '+91', '7897895656', NULL, NULL, NULL, 0, '', '0000-00-00', 0, 0, 0, 0, '', '', 6, 1, 0, '2018-07-24 03:23:40', '2018-07-24 03:36:08', '818FA8A9A4', 1, 0, 0, 1, '2018-07-24 03:37:56', '2018-07-24 03:39:54'),
(193, 'multi', 'doctor', 'specialization', 'multidoctorspecialization@mypulse.com', '', 'ZmVhM2QwNzRjNzhlNmU5NWQ0ZGYyNWRlNGI5NGMxZDAzNjU3MzU4MjBlNjczNjg5NzdiNjAwMTE5NjQ4ZGQ1Mw==', '', '+91', '9895685985', '', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', 'multidoctorspecialization@mypulse.com', 3, 1, 0, '2018-07-25 15:58:47', '2018-07-25 15:58:47', '56C6483033', 1, 0, 0, 0, NULL, NULL),
(194, 'samanth', NULL, 'mvs', 'samanth@myulse.com', '827ccb0eea8a706c4c34a16891f84e7b', 'MGZhZmMwZjBhZDg2MzZiOWJlMzM0MzYxODg4NTZiZjRiMDY5Yjc3ODcwOTMzYTgxNGM3ZTQ4NTI1MDJiMjEwMA==', NULL, '+91', '9550943170', NULL, NULL, NULL, 0, '', '0000-00-00', 0, 0, 0, 0, '', '', 6, 1, 0, '2018-07-30 00:32:45', '2018-07-30 00:37:16', 'FBC4C22916', 1, 0, 0, 1, '2018-07-30 00:37:35', NULL),
(195, 'test', 'for', 'front desk', 'testforfrontdesk@xyz.com', '', 'MzhmZDk2ZmE0OGI0ZDkxMjcxMGViNDI3ZjJiYzhjNjEyYjkxODMyNjYwNjM5NTM1Y2FjN2MwZGY4MDVlNDc4Mw==', '', '+91', '3232323232', '', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', 'test for front desk', 5, 1, 0, '2018-08-07 17:47:03', '2018-08-07 17:47:03', 'E5F6D195D5', 1, 0, 0, 0, NULL, NULL),
(196, 'maniyar', NULL, 'salavuddin', 'msallu2@gmail.com', '', 'ZDYzMDhhNDhkYjdiZjNkZWU0Njc2NzI1ZTg0ZDJhZTQ0ODIyZWE2M2ZkMGE2OGEzZTViNWZjY2I2NzE4ODI1Yw==', NULL, '+91', '9030509356', NULL, NULL, NULL, 0, '', '0000-00-00', 0, 0, 0, 0, '', '', 6, 0, 0, '2018-08-07 18:05:11', '2018-08-07 18:05:11', NULL, 0, 0, 0, 0, NULL, NULL),
(197, 'ab', 'cd', 'ef', 'r@mypulse.com', '', 'MzYyNTc4Y2I1OTI5MGM2NDZiMzM0NjIzYjdhYmQ1NzRjZjFjYzMwNDQ1NDRhYjVmOTc4YmQyY2E3NDQ5MDg2Yg==', '', '+91', '1023459870', '', NULL, NULL, 0, 'F', '1994-06-15', 1, 1, 1, 1, '', 'cbncbjcb', 5, 1, 0, '2018-08-07 18:40:56', '2018-08-07 18:40:56', 'D1992FFD97', 1, 0, 0, 0, NULL, NULL),
(198, 'R', NULL, 'R', 'vrreddy@gmail.com', '', 'MzY2ZWU0OGM3ODJmMjQ1ZjYxZjI0YjYzZDkxN2RiY2MxN2ZkODExZTMxOGZlZjlmOTBkNjY3ZmM5Zjc3YzViMg==', NULL, '+91', '9739195391', NULL, NULL, NULL, 0, '', '0000-00-00', 0, 0, 0, 0, '', '', 6, 0, 0, '2018-08-08 02:48:55', '2018-08-08 02:48:55', NULL, 0, 0, 0, 0, NULL, NULL),
(199, 'test', 'test', 'test', 'testdfs@xyz.com', '', 'YTQwMDcxNjg3N2VhZmIwNmM3MGYxZTQyYTY1ZjY0YmFhZmU0MWJmN2I0YWEwNTQzZjNjNmMyZThjZmRlMGI5Zg==', '', '+91', '8997787845', '', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', 'test', 2, 1, 0, '2018-08-11 02:50:21', '2018-08-11 02:50:21', '4CB68AE36D', 1, 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hms_users_otp`
--

CREATE TABLE `hms_users_otp` (
  `OTPID` int(11) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `Name` varchar(250) DEFAULT NULL,
  `EmailID` varchar(250) DEFAULT NULL,
  `MobileNumber` varchar(250) DEFAULT NULL,
  `OTPNumber` varchar(30) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `Status` tinyint(4) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(1, 1, 'Word1', 1, 0, '2017-06-13 01:41:42', '0000-00-00 00:00:00'),
(2, 4, 'C258', 1, 0, '2017-06-13 16:29:48', '0000-00-00 00:00:00'),
(3, 80, 'OV8', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(4, 90, 'ML2', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(5, 6, 'IR2', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(6, 98, 'KX6', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(7, 7, 'AU7', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(8, 24, 'JV1', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(9, 33, 'LS7', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(10, 54, 'VP8', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(11, 26, 'QS2', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(12, 42, 'EN8', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(13, 45, 'RD5', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(14, 28, 'TU5', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(15, 54, 'BJ9', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(16, 86, 'HG4', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(17, 96, 'KX0', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(18, 57, 'HE0', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(19, 42, 'AQ7', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(20, 72, 'CJ0', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(21, 43, 'SD3', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(22, 31, 'UD6', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(23, 67, 'SS9', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(24, 17, 'ES2', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(25, 83, 'OK3', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(26, 23, 'NH4', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(27, 95, 'OF2', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(28, 13, 'DC0', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(29, 94, 'KC4', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(30, 31, 'BJ0', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(31, 12, 'DD4', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(32, 6, 'LV7', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(33, 30, 'OE0', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(34, 98, 'GN5', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(35, 82, 'BZ4', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(36, 98, 'YQ2', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(37, 35, 'IX2', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(38, 72, 'HA5', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(39, 21, 'JO6', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(40, 37, 'UY1', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(41, 84, 'BD0', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(42, 42, 'FQ0', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(43, 46, 'BW6', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(44, 74, 'MG0', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(45, 31, 'AT2', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(46, 18, 'KE4', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(47, 98, 'VG6', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(48, 66, 'YP4', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(49, 44, 'RW0', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(50, 73, 'WB5', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(51, 7, 'BU9', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(52, 31, 'ZO4', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(53, 60, 'QO1', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(54, 4, 'CX8', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(55, 57, 'NJ1', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(56, 89, 'JV5', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(57, 79, 'MA0', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(58, 44, 'JT5', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(59, 75, 'JI9', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(60, 99, 'JU5', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(61, 38, 'HH3', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(62, 62, 'WK0', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(63, 52, 'RV6', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(64, 37, 'GB0', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(65, 67, 'DM0', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(66, 4, 'OC0', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(67, 30, 'LW3', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(68, 75, 'KT7', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(69, 5, 'ZY6', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(70, 34, 'KR7', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(71, 77, 'TL0', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(72, 53, 'HR3', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(73, 42, 'OD5', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(74, 36, 'RN7', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(75, 30, 'XK3', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(76, 89, 'MU0', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(77, 12, 'RW5', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(78, 34, 'IP8', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(79, 4, 'WE3', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(80, 81, 'AA5', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(81, 59, 'NC3', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(82, 61, 'SA1', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(83, 21, 'II3', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(84, 20, 'US1', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(85, 29, 'JO4', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(86, 60, 'SK5', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(87, 46, 'DO8', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(88, 50, 'TM7', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(89, 74, 'LV2', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(90, 17, 'CD3', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(91, 1, 'MT3', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(92, 45, 'EG4', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(93, 6, 'UD6', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(94, 86, 'PQ1', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(95, 6, 'EC8', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(96, 56, 'RC3', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(97, 66, 'WT3', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(98, 40, 'EH0', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(99, 78, 'GB0', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(100, 24, 'SQ6', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(101, 37, 'BV0', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(102, 68, 'CY3', 1, 0, '2017-06-20 19:08:26', '0000-00-00 00:00:00'),
(103, 1, 'ward-1', 1, 0, '2018-07-05 17:17:17', '0000-00-00 00:00:00'),
(104, 1, 'general', 1, 0, '2018-07-13 09:04:49', '0000-00-00 00:00:00'),
(105, 107, 'wd1', 1, 0, '2018-08-14 02:01:53', '0000-00-00 00:00:00');

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
-- Indexes for table `hms_doctors_specialization`
--
ALTER TABLE `hms_doctors_specialization`
  ADD PRIMARY KEY (`DoctorSpecializationID`);

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
-- Indexes for table `hms_mstr_specializations`
--
ALTER TABLE `hms_mstr_specializations`
  ADD PRIMARY KEY (`SpecializationID`);

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
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD KEY `usernemail` (`useremail`) USING BTREE;

--
-- Indexes for table `hms_users_otp`
--
ALTER TABLE `hms_users_otp`
  ADD PRIMARY KEY (`OTPID`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=431;

--
-- AUTO_INCREMENT for table `hms_appoitments`
--
ALTER TABLE `hms_appoitments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hms_availability`
--
ALTER TABLE `hms_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hms_beds`
--
ALTER TABLE `hms_beds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `hms_branches`
--
ALTER TABLE `hms_branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `hms_charges`
--
ALTER TABLE `hms_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `hms_district`
--
ALTER TABLE `hms_district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hms_doctors`
--
ALTER TABLE `hms_doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `hms_doctors_specialization`
--
ALTER TABLE `hms_doctors_specialization`
  MODIFY `DoctorSpecializationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `hms_hospital_admin`
--
ALTER TABLE `hms_hospital_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hms_inpatient`
--
ALTER TABLE `hms_inpatient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hms_inpatient_history`
--
ALTER TABLE `hms_inpatient_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hms_license`
--
ALTER TABLE `hms_license`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hms_medical_lab`
--
ALTER TABLE `hms_medical_lab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hms_medical_report`
--
ALTER TABLE `hms_medical_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hms_medical_report_file`
--
ALTER TABLE `hms_medical_report_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hms_medical_store`
--
ALTER TABLE `hms_medical_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hms_messages`
--
ALTER TABLE `hms_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `hms_mstr_specializations`
--
ALTER TABLE `hms_mstr_specializations`
  MODIFY `SpecializationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hms_notification`
--
ALTER TABLE `hms_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=860;

--
-- AUTO_INCREMENT for table `hms_nurse`
--
ALTER TABLE `hms_nurse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `hms_prescription`
--
ALTER TABLE `hms_prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hms_prescription_item`
--
ALTER TABLE `hms_prescription_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hms_prescription_order_receipt`
--
ALTER TABLE `hms_prescription_order_receipt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hms_receptionist`
--
ALTER TABLE `hms_receptionist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `hms_recommend_appointments`
--
ALTER TABLE `hms_recommend_appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hms_state`
--
ALTER TABLE `hms_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `hms_test`
--
ALTER TABLE `hms_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hms_users`
--
ALTER TABLE `hms_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `hms_users_otp`
--
ALTER TABLE `hms_users_otp`
  MODIFY `OTPID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `hms_wards`
--
ALTER TABLE `hms_wards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
