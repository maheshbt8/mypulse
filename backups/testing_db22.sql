-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2017 at 02:44 PM
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
(81, 'New nurse added', 'Nurse', 6, 162, 'Hospital1 Admin', '2017-11-21 14:21:00'),
(82, 'New user created', 'User', 172, 1, 'Super Admin', '2017-11-22 07:22:27'),
(83, 'New doctor added', 'Doctor', 3, 1, 'Super Admin', '2017-11-22 07:22:32'),
(84, 'New user created', 'User', 173, 1, 'Super Admin', '2017-11-22 07:37:23'),
(85, 'New doctor added', 'Doctor', 4, 1, 'Super Admin', '2017-11-22 07:37:28'),
(86, 'Doctor details soft deleted', 'Doctor', 3, 1, 'Super Admin', '2017-11-22 07:37:55'),
(87, 'Doctor details soft deleted', 'Doctor', 4, 1, 'Super Admin', '2017-11-22 07:37:55'),
(88, 'New user created', 'User', 174, 1, 'Super Admin', '2017-11-22 07:46:03'),
(89, 'New doctor added', 'Doctor', 5, 1, 'Super Admin', '2017-11-22 07:46:03'),
(90, 'User details updated', 'User', 174, 1, 'Super Admin', '2017-11-22 07:48:15'),
(91, 'Doctor details updated', 'Doctor', 5, 1, 'Super Admin', '2017-11-22 07:48:15'),
(92, 'New user created', 'User', 175, 1, 'Super Admin', '2017-11-22 07:50:13'),
(93, 'New doctor added', 'Doctor', 6, 1, 'Super Admin', '2017-11-22 07:50:13'),
(94, 'User details updated', 'User', 175, 1, 'Super Admin', '2017-11-22 07:50:35'),
(95, 'Doctor details updated', 'Doctor', 6, 1, 'Super Admin', '2017-11-22 07:50:35'),
(96, 'User details updated', 'User', 175, 1, 'Super Admin', '2017-11-22 07:51:56'),
(97, 'Doctor details updated', 'Doctor', 6, 1, 'Super Admin', '2017-11-22 07:51:56'),
(98, 'User details updated', 'User', 175, 1, 'Super Admin', '2017-11-22 07:52:11'),
(99, 'Doctor details updated', 'Doctor', 6, 1, 'Super Admin', '2017-11-22 07:52:11'),
(100, 'New user created', 'User', 176, 1, 'Super Admin', '2017-11-22 07:57:18'),
(101, 'New doctor added', 'Doctor', 7, 1, 'Super Admin', '2017-11-22 07:57:22'),
(102, 'Doctor details soft deleted', 'Doctor', 6, 1, 'Super Admin', '2017-11-22 07:59:15'),
(103, 'Doctor details soft deleted', 'Doctor', 7, 1, 'Super Admin', '2017-11-22 07:59:15'),
(104, 'Nurse details soft deleted', 'Nurse', 2, 1, 'Super Admin', '2017-11-22 08:02:25'),
(105, 'New user created', 'User', 177, 1, 'Super Admin', '2017-11-22 08:12:36'),
(106, 'New nurse added', 'Nurse', 7, 1, 'Super Admin', '2017-11-22 08:12:40'),
(107, 'New user created', 'User', 178, 1, 'Super Admin', '2017-11-22 08:14:25'),
(108, 'New nurse added', 'Nurse', 8, 1, 'Super Admin', '2017-11-22 08:14:29'),
(109, 'User details updated', 'User', 178, 1, 'Super Admin', '2017-11-22 08:15:57'),
(110, 'Nurse details updated', 'Nurse', 8, 1, 'Super Admin', '2017-11-22 08:15:57'),
(111, 'Doctor details soft deleted', 'Doctor', 5, 1, 'Super Admin', '2017-11-22 08:27:34'),
(112, 'New user created', 'User', 179, 1, 'Super Admin', '2017-11-22 08:34:57'),
(113, 'New nurse added', 'Nurse', 9, 1, 'Super Admin', '2017-11-22 08:35:01'),
(114, 'New user created', 'User', 180, 1, 'Super Admin', '2017-11-22 08:36:27'),
(115, 'New nurse added', 'Nurse', 10, 1, 'Super Admin', '2017-11-22 08:36:31'),
(116, 'New user created', 'User', 181, 1, 'Super Admin', '2017-11-22 08:36:59'),
(117, 'New nurse added', 'Nurse', 11, 1, 'Super Admin', '2017-11-22 08:37:03'),
(118, 'User details updated', 'User', 177, 1, 'Super Admin', '2017-11-22 09:23:31'),
(119, 'Nurse details updated', 'Nurse', 7, 1, 'Super Admin', '2017-11-22 09:23:31'),
(120, 'New user created', 'User', 182, 0, '', '2017-11-22 09:25:57'),
(121, 'User details updated', 'User', 165, 162, 'Hospital1 Admin', '2017-11-22 09:29:28'),
(122, 'Doctor details updated', 'Doctor', 2, 162, 'Hospital1 Admin', '2017-11-22 09:29:28'),
(123, 'User role updated', 'User', 182, 182, 'Receptionist ', '2017-11-22 09:31:22'),
(124, 'User details updated', 'User', 182, 1, 'Super Admin', '2017-11-22 09:32:55'),
(125, 'Receptionist details updated', 'Receptionist', 1, 1, 'Super Admin', '2017-11-22 09:32:55'),
(126, 'User details updated', 'User', 182, 1, 'Super Admin', '2017-11-22 09:34:03'),
(127, 'Receptionist details updated', 'Receptionist', 1, 1, 'Super Admin', '2017-11-22 09:34:03'),
(128, 'User details updated', 'User', 182, 1, 'Super Admin', '2017-11-22 09:34:25'),
(129, 'Receptionist details updated', 'Receptionist', 1, 1, 'Super Admin', '2017-11-22 09:34:25'),
(130, 'User details updated', 'User', 182, 1, 'Super Admin', '2017-11-22 09:34:40'),
(131, 'Receptionist details updated', 'Receptionist', 1, 1, 'Super Admin', '2017-11-22 09:34:40'),
(132, 'User details updated', 'User', 165, 1, 'Super Admin', '2017-11-22 09:38:48'),
(133, 'Doctor details updated', 'Doctor', 2, 1, 'Super Admin', '2017-11-22 09:38:48'),
(134, 'New user created', 'User', 183, 1, 'Super Admin', '2017-11-22 09:58:20'),
(135, 'New receptionist added', 'Receptionist', 2, 1, 'Super Admin', '2017-11-22 09:58:25'),
(136, 'New user created', 'User', 184, 1, 'Super Admin', '2017-11-22 10:07:59'),
(137, 'New receptionist added', 'Receptionist', 3, 1, 'Super Admin', '2017-11-22 10:07:59'),
(138, 'New user created', 'User', 185, 1, 'Super Admin', '2017-11-22 10:09:22'),
(139, 'New receptionist added', 'Receptionist', 4, 1, 'Super Admin', '2017-11-22 10:09:28'),
(140, 'User details updated', 'User', 185, 1, 'Super Admin', '2017-11-22 10:10:51'),
(141, 'Receptionist details updated', 'Receptionist', 4, 1, 'Super Admin', '2017-11-22 10:10:51'),
(142, 'New user created', 'User', 186, 1, 'Super Admin', '2017-11-22 10:14:26'),
(143, 'New receptionist added', 'Receptionist', 5, 1, 'Super Admin', '2017-11-22 10:14:30'),
(144, 'New user created', 'User', 187, 1, 'Super Admin', '2017-11-22 10:16:17'),
(145, 'New receptionist added', 'Receptionist', 6, 1, 'Super Admin', '2017-11-22 10:16:17'),
(146, 'User details updated', 'User', 187, 1, 'Super Admin', '2017-11-22 10:16:55'),
(147, 'Receptionist details updated', 'Receptionist', 6, 1, 'Super Admin', '2017-11-22 10:16:55'),
(148, 'New user created', 'User', 188, 0, '', '2017-11-22 10:57:34'),
(149, 'User details updated', 'User', 188, 188, 'Patient Patel', '2017-11-22 10:59:36'),
(150, 'User details updated', 'User', 188, 1, 'Super Admin', '2017-11-22 11:00:34'),
(151, 'New user created', 'User', 189, 1, 'Super Admin', '2017-11-22 11:01:15'),
(152, 'User details updated', 'User', 189, 1, 'Super Admin', '2017-11-22 11:08:02'),
(153, 'New user created', 'User', 190, 1, 'Super Admin', '2017-11-22 11:16:58'),
(154, 'New user created', 'User', 191, 0, '', '2017-11-22 11:18:47'),
(155, 'New user created', 'User', 192, 0, '', '2017-11-22 11:19:42'),
(156, 'User role updated', 'User', 192, 192, 'Medical Lab', '2017-11-22 11:21:18'),
(157, 'User role updated', 'User', 191, 191, 'Medical Store', '2017-11-22 11:21:50'),
(158, 'User details updated', 'User', 191, 191, 'Medical Store', '2017-11-22 11:28:33'),
(159, 'Medical store details updated', 'MedicalStore', 2, 191, 'Medical Store', '2017-11-22 11:28:33'),
(160, 'User details updated', 'User', 191, 191, 'Medical Store', '2017-11-22 11:43:51'),
(161, 'User details updated', 'User', 191, 1, 'Super Admin', '2017-11-22 11:45:32'),
(162, 'Medical store details updated', 'MedicalStore', 2, 1, 'Super Admin', '2017-11-22 11:45:32'),
(163, 'User details updated', 'User', 191, 1, 'Super Admin', '2017-11-22 11:46:01'),
(164, 'Medical store details updated', 'MedicalStore', 2, 1, 'Super Admin', '2017-11-22 11:46:01'),
(165, 'New user created', 'User', 193, 1, 'Super Admin', '2017-11-22 11:48:40'),
(166, 'New medical store added', 'MedicalStore', 3, 1, 'Super Admin', '2017-11-22 11:48:44'),
(167, 'Medical store deleted', 'MedicalStore', 1, 1, 'Super Admin', '2017-11-22 11:56:52'),
(168, 'New user created', 'User', 194, 1, 'Super Admin', '2017-11-22 12:04:33'),
(169, 'New medical store added', 'MedicalStore', 4, 1, 'Super Admin', '2017-11-22 12:04:33'),
(170, 'New user created', 'User', 195, 1, 'Super Admin', '2017-11-22 12:18:56'),
(171, 'Medical store deleted', 'MedicalStore', 4, 1, 'Super Admin', '2017-11-22 12:23:20'),
(172, 'New user created', 'User', 196, 1, 'Super Admin', '2017-11-22 12:29:20'),
(173, 'New medical store added', 'MedicalStore', 5, 1, 'Super Admin', '2017-11-22 12:29:25'),
(174, 'User details updated', 'User', 196, 1, 'Super Admin', '2017-11-22 12:30:13'),
(175, 'Medical store details updated', 'MedicalStore', 5, 1, 'Super Admin', '2017-11-22 12:30:13'),
(176, 'New user created', 'User', 197, 1, 'Super Admin', '2017-11-22 12:35:08'),
(177, 'New medical store added', 'MedicalStore', 6, 1, 'Super Admin', '2017-11-22 12:35:12'),
(178, 'User details updated', 'User', 197, 1, 'Super Admin', '2017-11-22 12:36:36'),
(179, 'Medical store details updated', 'MedicalStore', 6, 1, 'Super Admin', '2017-11-22 12:36:36'),
(180, 'New user created', 'User', 198, 0, '', '2017-11-22 12:55:30'),
(181, 'User role updated', 'User', 198, 198, 'Medical Lab', '2017-11-22 12:58:13'),
(182, 'New user created', 'User', 199, 0, '', '2017-11-22 13:02:00'),
(183, 'New user created', 'User', 200, 0, '', '2017-11-22 13:05:58'),
(184, 'User profile verfied', 'User', 200, 0, '', '2017-11-22 13:08:15'),
(185, 'User role updated', 'User', 200, 200, 'Star Patel', '2017-11-22 13:11:23'),
(186, 'User details updated', 'User', 200, 200, 'Star Patel', '2017-11-22 13:17:17'),
(187, 'Medical lab details updated', 'MedicalLab', 2, 200, 'Star Patel', '2017-11-22 13:17:17'),
(188, 'User details updated', 'User', 200, 1, 'Super Admin', '2017-11-22 13:40:51'),
(189, 'Medical lab details updated', 'MedicalLab', 2, 1, 'Super Admin', '2017-11-22 13:40:51'),
(190, 'Doctor Other settings updated regarding availability', 'Doctor', 2, 1, 'Super Admin', '2017-11-22 13:45:48'),
(191, 'Doctor availability inserted', 'Availability', 1, 1, 'Super Admin', '2017-11-22 13:47:39'),
(192, 'Doctor availability inserted', 'Availability', 2, 1, 'Super Admin', '2017-11-22 13:47:39'),
(193, 'Doctor availability inserted', 'Availability', 3, 1, 'Super Admin', '2017-11-22 13:47:39'),
(194, 'Doctor availability inserted', 'Availability', 4, 1, 'Super Admin', '2017-11-22 13:47:39'),
(195, 'Doctor availability inserted', 'Availability', 5, 1, 'Super Admin', '2017-11-22 13:47:39'),
(196, 'Doctor availability inserted', 'Availability', 6, 1, 'Super Admin', '2017-11-22 13:47:39'),
(197, 'New appointment APT1 created', 'Appointment', 1, 1, 'Super Admin', '2017-11-22 13:49:12'),
(198, 'Appointment APT1 updated', 'Appointment', 1, 1, 'Super Admin', '2017-11-22 13:53:25'),
(199, 'Appointment APT1 updated', 'Appointment', 1, 1, 'Super Admin', '2017-11-22 13:53:57'),
(200, 'Appointment APT1 approved', 'Appointment', 1, 1, 'Super Admin', '2017-11-22 13:54:54'),
(201, 'Appointment APT1 approved', 'Appointment', 1, 1, 'Super Admin', '2017-11-22 13:55:12'),
(202, 'New appointment APT2 created', 'Appointment', 2, 1, 'Super Admin', '2017-11-22 13:58:19'),
(203, 'New license added', 'License', 3, 1, 'Super Admin', '2017-11-22 13:59:47'),
(204, 'New license added', 'License', 4, 1, 'Super Admin', '2017-11-22 14:00:17'),
(205, 'HealthInsuranceProvider added', 'HealthInsuranceProvider', 2, 1, 'Super Admin', '2017-11-22 14:02:12'),
(206, 'HealthInsuranceProvider updated', 'HealthInsuranceProvider', 2, 1, 'Super Admin', '2017-11-22 14:09:04'),
(207, 'HealthInsuranceProvider added', 'HealthInsuranceProvider', 3, 1, 'Super Admin', '2017-11-22 14:12:10'),
(208, 'HealthInsuranceProvider soft deleted', 'HealthInsuranceProvider', 3, 1, 'Super Admin', '2017-11-22 14:12:21'),
(209, 'User details updated', 'User', 162, 162, 'Hospital1 Admin', '2017-11-22 14:22:39');

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

--
-- Dumping data for table `hms_appoitments`
--

INSERT INTO `hms_appoitments` (`id`, `appoitment_number`, `user_id`, `department_id`, `doctor_id`, `appoitment_date`, `appoitment_time_start`, `appoitment_time_end`, `status`, `reason`, `remarks`, `created_at`, `modified_at`, `isDeleted`) VALUES
(1, 'APT1', 190, 2, 2, '2017-11-23', '10:00:00', '10:30:00', 1, 'Check up', 'k', '0000-00-00 00:00:00', '2017-11-22 12:54:54', 0),
(2, 'APT2', 188, 2, 2, '2017-11-23', '17:00:00', '17:30:00', 0, 'eye check up', '', '0000-00-00 00:00:00', '2017-11-22 12:58:19', 0);

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
(1, 2, 0, 1, '2017-11-22', '2018-11-22', '10:00:00', '19:00:00', 1, 0, '0000-00-00 00:00:00', '2017-11-22 12:47:39'),
(2, 2, 0, 1, '2017-11-22', '2018-11-22', '10:00:00', '19:00:00', 2, 0, '0000-00-00 00:00:00', '2017-11-22 12:47:39'),
(3, 2, 0, 1, '2017-11-22', '2018-11-22', '10:00:00', '19:00:00', 3, 0, '0000-00-00 00:00:00', '2017-11-22 12:47:39'),
(4, 2, 0, 1, '2017-11-22', '2018-11-22', '10:00:00', '19:00:00', 4, 0, '0000-00-00 00:00:00', '2017-11-22 12:47:39'),
(5, 2, 0, 1, '2017-11-22', '2018-11-22', '10:00:00', '19:00:00', 5, 0, '0000-00-00 00:00:00', '2017-11-22 12:47:39'),
(6, 2, 0, 1, '2017-11-22', '2018-11-22', '10:00:00', '19:00:00', 6, 0, '0000-00-00 00:00:00', '2017-11-22 12:47:39');

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
(2, 165, 2, 5, 30, '', '', '', 1, 0, '2017-11-21 14:04:53', '2017-11-22 12:45:48', 'every monday 10 am to 7 pm\r\n');

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
(1, 'LIC', 0),
(2, 'LIC Life Time', 0),
(3, 'fgfhg', 1);

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
(5, 188, 'OPVE', 0, 0, 0, 0, 0, '', 1, '', '', '', 0, '0000-00-00 00:00:00', '2017-11-22 09:59:36'),
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
(2, 'LIC02', 'Trial', 0),
(3, 'LIC03', 'Trial', 1),
(4, 'lic03', 'Trial', 1);

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
(1, 198, '', '', '', '', 1, '', '', 0, 0, 0, 0, 0, 1, '0000-00-00 00:00:00', '2017-11-22 12:41:15'),
(2, 200, 'Medicalab', '', 'Twinkal Patel', '9999882232', 1, 'Ahmedabad', '9945781240', 1, 1, 1, 1, 0, 0, '0000-00-00 00:00:00', '2017-11-22 12:40:51');

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

--
-- Dumping data for table `hms_medical_store`
--

INSERT INTO `hms_medical_store` (`id`, `user_id`, `name`, `description`, `owner_name`, `owner_contact_number`, `branch_id`, `address`, `phone_number`, `country`, `state`, `district`, `city`, `isActive`, `isDeleted`, `created_at`, `modified_at`) VALUES
(2, 191, 'MedicalStore', 'medical store', 'owner', '9587561849', 1, 'Ahmedabad', '9945812456', 1, 1, 1, 1, 1, 0, '0000-00-00 00:00:00', '2017-11-22 10:45:32'),
(6, 197, 'm', '', 'twi', '9999882150', 1, '', '', 1, 1, 1, 1, 1, 0, '2017-11-22 12:35:12', '2017-11-22 11:36:36'),
(5, 196, 'Patrel Medical lStore', 'Medical Store', 'Twinkal Patel', '9754814299', 1, 'Ahmedabad', '7878561230', 1, 1, 1, 1, 1, 0, '2017-11-22 12:29:25', '2017-11-22 11:30:13');

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
(30, 166, 162, '<b>Nurse </b> is successfully registered as <b>Nurse</b> in Department: <b>h1_b1_Dept1</b>', 1, NULL, '2017-11-21 05:08:53', 0),
(31, 162, 166, 'Your Profile is updated', 0, NULL, '2017-11-21 05:09:57', 0),
(32, 1, 174, 'Your Profile is updated', 0, NULL, '2017-11-21 22:48:15', 0),
(33, 1, 175, 'Your Profile is updated', 0, NULL, '2017-11-21 22:50:35', 0),
(34, 1, 175, 'Your Profile is updated', 0, NULL, '2017-11-21 22:51:56', 0),
(35, 1, 175, 'Your Profile is updated', 0, NULL, '2017-11-21 22:52:11', 0),
(36, 1, 176, 'You are linked with <b>Hospital1</b> hospital as Doctor', 0, NULL, '2017-11-21 22:57:22', 0),
(37, 1, 171, 'New doctor <b>gdfhfgnhf jhsukfhg</b> is added in your department <b>h1_b1_Dept1</b>', 0, NULL, '2017-11-21 22:57:22', 0),
(38, 1, 162, 'New doctor <b>gdfhfgnhf jhsukfhg</b> is added in department: <b>h1_b1_Dept1</b><br>Branch: <b>h1_Branch1</b>', 1, NULL, '2017-11-21 22:57:22', 0),
(39, 1, 177, 'You are linked with <b>Hospital1</b> hospital as Nurse', 0, NULL, '2017-11-21 23:12:40', 0),
(40, 1, 162, 'New nurse <b>Mnasi  Patel</b> is added in department: <b>h1_b1_Dept1</b><br>Branch: <b>h1_Branch1</b>', 1, NULL, '2017-11-21 23:12:40', 0),
(41, 1, 178, 'Your Profile is updated', 0, NULL, '2017-11-21 23:15:57', 0),
(42, 1, 177, 'Your Profile is updated', 0, NULL, '2017-11-22 00:23:31', 0),
(43, 162, 165, 'Your Profile is updated', 0, NULL, '2017-11-22 00:29:28', 0),
(44, 182, 162, '<b>Receptionist </b> is successfully registered as <b>Receptionist</b> <br> Linked with doctor: <b> </b>', 1, NULL, '2017-11-22 00:31:22', 0),
(45, 1, 182, 'Your Profile is updated', 0, NULL, '2017-11-22 00:32:55', 0),
(46, 1, 182, 'Your Profile is updated', 0, NULL, '2017-11-22 00:34:03', 0),
(47, 1, 182, 'Your Profile is updated', 0, NULL, '2017-11-22 00:34:25', 0),
(48, 1, 182, 'Your Profile is updated', 0, NULL, '2017-11-22 00:34:40', 0),
(49, 1, 165, 'Your Profile is updated', 0, NULL, '2017-11-22 00:38:48', 0),
(50, 1, 183, 'You are linked with <b> </b> doctor as Receptionist', 0, NULL, '2017-11-22 00:58:25', 0),
(51, 1, 185, 'Your Profile is updated', 0, NULL, '2017-11-22 01:10:51', 0),
(52, 1, 186, 'You are linked with <b>Dr. Yogesh  Patel</b> doctor as Receptionist', 0, NULL, '2017-11-22 01:14:30', 0),
(53, 1, 165, 'New receptionist <b>jsdkfhlk lhkmjlk</b> is linked with you', 0, NULL, '2017-11-22 01:14:30', 0),
(54, 1, 162, 'New receptionist <b>jsdkfhlk lhkmjlk</b> is linked with doctor: <b>Dr. Yogesh  Patel</b>', 1, NULL, '2017-11-22 01:14:30', 0),
(55, 1, 187, 'Your Profile is updated', 0, NULL, '2017-11-22 01:16:55', 0),
(56, 1, 188, 'Your Profile is updated', 0, NULL, '2017-11-22 02:00:34', 0),
(57, 1, 189, 'Your Profile is updated', 0, NULL, '2017-11-22 02:08:02', 0),
(58, 192, 162, '<b>Medical Lab</b> is successfully registered as <b>Medical Store Incharge</b> in Branch: <b>h1_Branch1</b>', 1, NULL, '2017-11-22 02:21:18', 0),
(59, 191, 162, '<b>Medical Store</b> is successfully registered as <b>Medical Store Incharge</b> in Branch: <b>h1_Branch1</b>', 1, NULL, '2017-11-22 02:21:50', 0),
(60, 1, 191, 'Your Profile is updated', 0, NULL, '2017-11-22 02:45:32', 0),
(61, 1, 191, 'Your profile is updated', 0, NULL, '2017-11-22 02:45:32', 0),
(62, 1, 191, 'Your Profile is updated', 0, NULL, '2017-11-22 02:46:01', 0),
(63, 1, 191, 'Your profile is updated', 0, NULL, '2017-11-22 02:46:01', 0),
(64, 1, 193, 'You are linked with <b>Hospital1</b> hospital', 0, NULL, '2017-11-22 02:48:44', 0),
(65, 1, 162, 'New medical store <b>hghgfjdng</b> is linked with branch: <b>h1_Branch2</b>', 1, NULL, '2017-11-22 02:48:44', 0),
(66, 1, 194, 'You are linked with <b></b> hospital', 0, NULL, '2017-11-22 03:04:33', 0),
(67, 1, 196, 'Your Profile is updated', 0, NULL, '2017-11-22 03:30:13', 0),
(68, 1, 196, 'Your profile is updated', 0, NULL, '2017-11-22 03:30:13', 0),
(69, 1, 197, 'Your Profile is updated', 0, NULL, '2017-11-22 03:36:36', 0),
(70, 1, 197, 'Your profile is updated', 0, NULL, '2017-11-22 03:36:36', 0),
(71, 198, 162, '<b>Medical Lab</b> is successfully registered as <b>Medical Lab Incharge</b> in Branch: <b>h1_Branch1</b>', 1, NULL, '2017-11-22 03:58:13', 0),
(72, 200, 162, '<b>Star Patel</b> is successfully registered as <b>Medical Lab Incharge</b> in Branch: <b>h1_Branch1</b>', 1, NULL, '2017-11-22 04:11:23', 0),
(73, 1, 200, 'Your Profile is updated', 0, NULL, '2017-11-22 04:40:51', 0),
(74, 1, 200, 'Your profile is updated', 0, NULL, '2017-11-22 04:40:51', 0),
(75, 1, 165, 'Your Other settings regarding availability is updated', 0, NULL, '2017-11-22 04:45:48', 0),
(76, 1, 182, 'Dr. Yogesh  Patel Other settings regarding availability is updated', 0, NULL, '2017-11-22 04:45:48', 0),
(77, 1, 183, 'Dr. Yogesh  Patel Other settings regarding availability is updated', 0, NULL, '2017-11-22 04:45:48', 0),
(78, 1, 184, 'Dr. Yogesh  Patel Other settings regarding availability is updated', 0, NULL, '2017-11-22 04:45:48', 0),
(79, 1, 185, 'Dr. Yogesh  Patel Other settings regarding availability is updated', 0, NULL, '2017-11-22 04:45:48', 0),
(80, 1, 186, 'Dr. Yogesh  Patel Other settings regarding availability is updated', 0, NULL, '2017-11-22 04:45:48', 0),
(81, 1, 187, 'Dr. Yogesh  Patel Other settings regarding availability is updated', 0, NULL, '2017-11-22 04:45:48', 0),
(82, 1, 165, 'Your new availability is added ', 0, NULL, '2017-11-22 04:47:39', 0),
(83, 1, 182, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(84, 1, 183, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(85, 1, 184, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(86, 1, 185, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(87, 1, 186, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(88, 1, 187, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(89, 1, 165, 'Your new availability is added ', 0, NULL, '2017-11-22 04:47:39', 0),
(90, 1, 182, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(91, 1, 183, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(92, 1, 184, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(93, 1, 185, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(94, 1, 186, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(95, 1, 187, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(96, 1, 165, 'Your new availability is added ', 0, NULL, '2017-11-22 04:47:39', 0),
(97, 1, 182, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(98, 1, 183, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(99, 1, 184, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(100, 1, 185, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(101, 1, 186, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(102, 1, 187, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(103, 1, 165, 'Your new availability is added ', 0, NULL, '2017-11-22 04:47:39', 0),
(104, 1, 182, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(105, 1, 183, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(106, 1, 184, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(107, 1, 185, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(108, 1, 186, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(109, 1, 187, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(110, 1, 165, 'Your new availability is added ', 0, NULL, '2017-11-22 04:47:39', 0),
(111, 1, 182, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(112, 1, 183, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(113, 1, 184, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(114, 1, 185, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(115, 1, 186, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(116, 1, 187, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(117, 1, 165, 'Your new availability is added ', 0, NULL, '2017-11-22 04:47:39', 0),
(118, 1, 182, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(119, 1, 183, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(120, 1, 184, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(121, 1, 185, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(122, 1, 186, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(123, 1, 187, 'Dr. Yogesh  Patel added new availability', 0, NULL, '2017-11-22 04:47:39', 0),
(124, 1, 190, 'Your appointment is booked.<br> Appointment number:<b> APT1 </b>', 0, NULL, '2017-11-22 04:49:12', 0),
(125, 1, 165, 'New appointment is booked.<br> Appointment number:<b> APT1 </b>', 0, NULL, '2017-11-22 04:49:12', 0),
(126, 1, 182, 'New appointment is booked.<br> Appointment number:<b> APT1 </b>', 0, NULL, '2017-11-22 04:49:12', 0),
(127, 1, 183, 'New appointment is booked.<br> Appointment number:<b> APT1 </b>', 0, NULL, '2017-11-22 04:49:12', 0),
(128, 1, 184, 'New appointment is booked.<br> Appointment number:<b> APT1 </b>', 0, NULL, '2017-11-22 04:49:12', 0),
(129, 1, 185, 'New appointment is booked.<br> Appointment number:<b> APT1 </b>', 0, NULL, '2017-11-22 04:49:12', 0),
(130, 1, 186, 'New appointment is booked.<br> Appointment number:<b> APT1 </b>', 0, NULL, '2017-11-22 04:49:12', 0),
(131, 1, 187, 'New appointment is booked.<br> Appointment number:<b> APT1 </b>', 0, NULL, '2017-11-22 04:49:12', 0),
(132, 1, 190, 'Remark added in your appointment: <b>APT1</b>', 0, NULL, '2017-11-22 04:53:25', 0),
(133, 1, 165, 'Remark added in appointment: <b>APT1</b>', 0, NULL, '2017-11-22 04:53:25', 0),
(134, 1, 182, 'Remark added in appointment: <b>APT1</b>', 0, NULL, '2017-11-22 04:53:25', 0),
(135, 1, 183, 'Remark added in appointment: <b>APT1</b>', 0, NULL, '2017-11-22 04:53:25', 0),
(136, 1, 184, 'Remark added in appointment: <b>APT1</b>', 0, NULL, '2017-11-22 04:53:25', 0),
(137, 1, 185, 'Remark added in appointment: <b>APT1</b>', 0, NULL, '2017-11-22 04:53:25', 0),
(138, 1, 186, 'Remark added in appointment: <b>APT1</b>', 0, NULL, '2017-11-22 04:53:25', 0),
(139, 1, 187, 'Remark added in appointment: <b>APT1</b>', 0, NULL, '2017-11-22 04:53:25', 0),
(140, 1, 190, 'Remark added in your appointment: <b>APT1</b>', 0, NULL, '2017-11-22 04:53:57', 0),
(141, 1, 165, 'Remark added in appointment: <b>APT1</b>', 0, NULL, '2017-11-22 04:53:57', 0),
(142, 1, 182, 'Remark added in appointment: <b>APT1</b>', 0, NULL, '2017-11-22 04:53:57', 0),
(143, 1, 183, 'Remark added in appointment: <b>APT1</b>', 0, NULL, '2017-11-22 04:53:57', 0),
(144, 1, 184, 'Remark added in appointment: <b>APT1</b>', 0, NULL, '2017-11-22 04:53:57', 0),
(145, 1, 185, 'Remark added in appointment: <b>APT1</b>', 0, NULL, '2017-11-22 04:53:57', 0),
(146, 1, 186, 'Remark added in appointment: <b>APT1</b>', 0, NULL, '2017-11-22 04:53:57', 0),
(147, 1, 187, 'Remark added in appointment: <b>APT1</b>', 0, NULL, '2017-11-22 04:53:57', 0),
(148, 1, 190, 'Your appointment <b>APT1</b> has been Approved', 0, NULL, '2017-11-22 04:54:54', 0),
(149, 1, 165, ' Appointment <b>APT1</b> has been Approved', 0, NULL, '2017-11-22 04:54:54', 0),
(150, 1, 182, ' Appointment <b>APT1</b> has been Approved', 0, NULL, '2017-11-22 04:54:54', 0),
(151, 1, 183, ' Appointment <b>APT1</b> has been Approved', 0, NULL, '2017-11-22 04:54:54', 0),
(152, 1, 184, ' Appointment <b>APT1</b> has been Approved', 0, NULL, '2017-11-22 04:54:54', 0),
(153, 1, 185, ' Appointment <b>APT1</b> has been Approved', 0, NULL, '2017-11-22 04:54:54', 0),
(154, 1, 186, ' Appointment <b>APT1</b> has been Approved', 0, NULL, '2017-11-22 04:54:54', 0),
(155, 1, 187, ' Appointment <b>APT1</b> has been Approved', 0, NULL, '2017-11-22 04:54:54', 0),
(156, 1, 190, 'Your appointment <b>APT1</b> has been Approved', 0, NULL, '2017-11-22 04:55:12', 0),
(157, 1, 165, ' Appointment <b>APT1</b> has been Approved', 0, NULL, '2017-11-22 04:55:12', 0),
(158, 1, 182, ' Appointment <b>APT1</b> has been Approved', 0, NULL, '2017-11-22 04:55:12', 0),
(159, 1, 183, ' Appointment <b>APT1</b> has been Approved', 0, NULL, '2017-11-22 04:55:12', 0),
(160, 1, 184, ' Appointment <b>APT1</b> has been Approved', 0, NULL, '2017-11-22 04:55:12', 0),
(161, 1, 185, ' Appointment <b>APT1</b> has been Approved', 0, NULL, '2017-11-22 04:55:12', 0),
(162, 1, 186, ' Appointment <b>APT1</b> has been Approved', 0, NULL, '2017-11-22 04:55:12', 0),
(163, 1, 187, ' Appointment <b>APT1</b> has been Approved', 0, NULL, '2017-11-22 04:55:12', 0),
(164, 1, 188, 'Your appointment is booked.<br> Appointment number:<b> APT2 </b>', 0, NULL, '2017-11-22 04:58:19', 0),
(165, 1, 165, 'New appointment is booked.<br> Appointment number:<b> APT2 </b>', 0, NULL, '2017-11-22 04:58:19', 0),
(166, 1, 182, 'New appointment is booked.<br> Appointment number:<b> APT2 </b>', 0, NULL, '2017-11-22 04:58:19', 0),
(167, 1, 183, 'New appointment is booked.<br> Appointment number:<b> APT2 </b>', 0, NULL, '2017-11-22 04:58:19', 0),
(168, 1, 184, 'New appointment is booked.<br> Appointment number:<b> APT2 </b>', 0, NULL, '2017-11-22 04:58:19', 0),
(169, 1, 185, 'New appointment is booked.<br> Appointment number:<b> APT2 </b>', 0, NULL, '2017-11-22 04:58:19', 0),
(170, 1, 186, 'New appointment is booked.<br> Appointment number:<b> APT2 </b>', 0, NULL, '2017-11-22 04:58:19', 0),
(171, 1, 187, 'New appointment is booked.<br> Appointment number:<b> APT2 </b>', 0, NULL, '2017-11-22 04:58:19', 0);

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
(2, 167, -1, 1, 1, '2017-11-21 14:11:07', '2017-11-22 07:02:25', '', ''),
(9, 179, -1, 1, 1, '2017-11-22 08:35:01', '2017-11-22 07:35:11', '', ''),
(8, 178, 1, 1, 1, '2017-11-22 08:14:29', '2017-11-22 07:33:27', '', ''),
(7, 177, 1, 1, 0, '2017-11-22 08:12:40', '2017-11-22 08:23:31', 'Bsc', '1 yr'),
(10, 180, -1, 1, 1, '2017-11-22 08:36:31', '2017-11-22 07:42:10', '', ''),
(11, 181, -1, 0, 1, '2017-11-22 08:37:03', '2017-11-22 07:37:19', '', '');

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

--
-- Dumping data for table `hms_receptionist`
--

INSERT INTO `hms_receptionist` (`id`, `user_id`, `doc_id`, `qualification`, `experience`, `isActive`, `isDeleted`, `created_at`, `modified_at`) VALUES
(1, 182, 2, '', '', 1, 0, '0000-00-00 00:00:00', '2017-11-22 09:16:55'),
(2, 183, 2, '', '', 1, 0, '2017-11-22 09:58:25', '2017-11-22 09:16:55'),
(3, 184, 2, '', '', 1, 1, '2017-11-22 10:07:59', '2017-11-22 09:16:55'),
(4, 185, 2, '', '', 1, 0, '2017-11-22 10:09:28', '2017-11-22 09:16:55'),
(5, 186, 2, '', '', 1, 0, '2017-11-22 10:14:30', '2017-11-22 09:14:30'),
(6, 187, 2, '', '', 1, 1, '2017-11-22 10:16:17', '2017-11-22 09:40:20');

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
(198, 'Medical', 'Lab', 'medicallab@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'ZWYwYzRmNWRjNjQxMzRjZGJlMmZmMzYzMmNhM2M2Y2MyZDIyODY5MjgyOWU1ZDVjMjdkMmIyNjE1OGIyNWM3OA==', NULL, '9956935600', NULL, NULL, NULL, 0, '', '0000-00-00', 0, 0, 0, 0, '', '', 8, 1, 0, '2017-11-22 12:55:30', '2017-11-22 11:55:30', '46DD59A63F', 1, 0),
(191, 'Medical', 'Store', 'medicalstore@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'NjdhZjA2MDBhNDA0ZmI4NmUyYzYxMGY5ZmFkMTVmYTE0ODM3ODllNzUyM2ViYzA4YjJkYjM0YjI4N2FmMzAxNw==', 'Ahmedabad', '9956241578', NULL, NULL, NULL, 0, 'M', '1969-12-30', 1, 1, 1, 1, '', 'medical store', 7, 1, 0, '2017-11-22 11:18:47', '2017-11-22 10:18:47', '0C852B4AFA', 1, 0),
(190, 'Yogi', 'Patel', 'yogi@gmail.com', '938e14c074c45c62eb15cc05a6f36d79', 'Y2MxN2M1MTg2ZjNjMGMxOGE4M2U3MjU3MWY2YjFiYjZhMWRiNWIwNjU0ODU0NmM0YjAzM2FkNWVmYmVkMWU3NQ==', 'Ahmedabad', '9956781230', '89456312457896', NULL, NULL, 0, 'M', '0000-00-00', 1, 1, 1, 1, '8956237845', 'Patient', 6, 1, 0, '2017-11-22 11:16:57', '2017-11-22 10:16:58', 'ACACC7FC9C', 1, 0),
(199, 'Star', 'Patel', 'tkpatel1996@gmail.com', 'd18505e73a311f5c3a0d6c3f2fa16405', 'NWJkYWI4ZWVmOTYyOTBkMDIxYzY2ZTBlOWU4YjljY2VjMGE5YTA4MGY1NTFkNTc1YzM0MDlmYTc0ZWE4ZmUwMg==', NULL, '9106632825', NULL, NULL, NULL, 0, '', '0000-00-00', 0, 0, 0, 0, '', '', 6, 1, 0, '2017-11-22 13:02:00', '2017-11-22 12:02:00', '10E43BFA95', 1, 0),
(182, 'Receptionist', 'Patel', 'receptionist@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'MTc1YzVhMDA0NjQwOWJmZmNlNjIwMTcwMjFmYzUzMGM0M2UwOWNlMzljOGU2YjAzMjc5NmRmODAyZGZjODY5NA==', 'Ahmedabadkhjgh', '9814252852', '89561245763', NULL, NULL, 0, 'F', '2017-11-22', 1, 1, 1, 1, '', 'Receptionist', 5, 1, 0, '2017-11-22 09:25:57', '2017-11-22 08:25:57', 'EBA6367F40', 1, 0),
(183, 'rece', 'Patel', 'twinkalpatel@gmail.com', '473897dcf9d235f5498904a3adde607d', 'YzU1MDBlNTUzOGRhN2I0ZTFkYjUyNDA4MzBmYTNiNjNlMTlhNjIwNDQ0YTI4MmQzMGY0MzM4YWU5OWU1ZmVkMA==', '', '8641164647', '454', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', 'hfgghdgh', 5, 0, 0, '2017-11-22 09:58:20', '2017-11-22 08:58:20', '6A23F08DCC', 1, 0),
(200, 'Star', 'Patel', 'twinkalpatel485@gmail.com', '64a43b6ca15d128ac6a0679b39bc9c07', 'ZWI2MmU5N2ZlZjU2OGI4MTdkMjM3NjZmZDgyMzZlNDFmN2VmYmZlMDk5YzYzYzE4MDljYWMyYWYyMjVjYzljYw==', 'Ahmedabad', '9157136316', NULL, NULL, NULL, 0, 'F', '2017-11-16', 1, 1, 1, 1, '', '', 8, 1, 0, '2017-11-22 13:05:58', '2017-11-22 12:05:58', NULL, 1, 0),
(174, 'Dr. Twinkal', 'Patel', 'twinkl@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'ZmI0NjhkMmVkMmQ1NTYwYTg0MGE0MmNiNzc2Yjg5ODkzYzZjMmU1ZWQxM2ExNzhmOTQ0MmUzMmFiZWE2MWQ1YQ==', '', '9632568974', '457885427570', NULL, NULL, 0, 'M', '1969-12-31', 0, 0, 0, 0, '', 'Doctor', 3, 0, 0, '2017-11-22 07:46:03', '2017-11-22 06:46:03', '24B0C7B570', 1, 0),
(188, 'Patient', 'Patel', 'patient@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'MjAxNTc0MzA1OTg1MDcyNzAwZDliNTZhZDE0NjljOGE3ZjM2N2ZjMGEzOTk4NWI5ODkwZmVkNzNjY2Y4ZWNiYQ==', 'Ahmedabad', '9569781023 ', '24645634254365', NULL, NULL, 0, 'M', '1969-12-31', 1, 1, 1, 1, '', 'jhkki', 6, 1, 0, '2017-11-22 10:57:34', '2017-11-22 09:57:34', '8450B0F808', 1, 0),
(177, 'Mnasi ', 'Patel', 'mansi@gmail.com', '8e183f28f7ac8aaebf5650f728f79a37', 'ZDVlODc0MmY3ZDZjYjU2YWY0Nzc5ZWU1OTEyMGM1Nzc5MjAxNzJmOTAyMGRlZjVlNDMyYWRkMjFhMTY4NmVlNg==', 'Ahmedabad', '8676453155', '8955316878643', NULL, NULL, 0, 'F', '2017-11-15', 1, 1, 1, 1, '', 'Nurse', 4, 0, 0, '2017-11-22 08:12:36', '2017-11-22 07:12:36', '373FC81C59', 1, 0),
(171, 'Nurse', 'Patel', 'nursepate@gmail.com', '45f27778998ee78b88d293968dff0b6e', 'MWViN2QxNGQwNDMyMTJmYzJmYjRlNTY5ZjMxMmJjMjgxNTQ0NWI5NWY0MmM2YzVkMDljYjZkODZmNjBhMzJiYQ==', '', '9654781212', '65856265568', NULL, NULL, 0, 'M', '1970-01-01', 0, 0, 0, 0, '', 'Nu', 4, 0, 0, '2017-11-21 14:20:56', '2017-11-21 13:20:56', '7B1384A021', 1, 0),
(165, 'Dr. Yogesh ', 'Patel', 'yogesh@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'NTUwNWFiNzcyMWMwMzMyODlmOWI4MDZhNzM0MTM3MjM1OWExMzQ4YTQyYWJhNGFkMGU2OGJmMDg4NjI4YWMwMg==', 'Ahmedabad', '9956935650', '898124784841', NULL, NULL, 0, 'M', '1992-03-18', 1, 1, 1, 1, '', 'Doctor', 3, 1, 0, '2017-11-21 14:04:48', '2017-11-21 13:04:48', '466815617F', 1, 0),
(162, 'Hospital1', 'Admin', 'hospitaladmin@mypulse.com', '473897dcf9d235f5498904a3adde607d', 'MzQ4MWZiMDY2Zjk5YTBmMzU1NjlmYWRkYTJmYThiZWQ5OTQ3YWVmMTM3NTNmMjJkYWFlZTI3MmIyY2ZiNTE0NA==', 'Ahmedabad', '9956935656', '957852461230', NULL, NULL, 0, 'M', '1969-12-31', 1, 1, 1, 1, '', 'I am Hospital Admin', 2, 1, 0, '2017-11-21 08:01:34', '2017-11-21 07:01:34', '040F407BA2', 1, 0),
(197, 'fn', 'ln', 'e@gmail.com', '6f8f57715090da2632453988d9a1501b', 'OWEzYzc3NGNhMTZkYjI2ZmFkYjY1ZDEwY2FhNjQ3NzkzYjM3YzdjNWU5MWJkMzMyM2NkODA4OGFmNWQ2MzNmMQ==', '', '9988665544', '95785246123055', NULL, NULL, 0, 'F', '2017-11-08', 1, 1, 1, 1, '', '', 7, 0, 0, '2017-11-22 12:35:08', '2017-11-22 11:35:08', '94A2D5A346', 1, 0),
(196, 'Twinkal ', 'Patel', 'twinkalpatellllll@gmail.com', '00bc971f92dd0b23e4a68dfe095d3173', 'NjVlY2YyZmE0MzJiMmNkZGVhNjU4ZTFjMzhkOTkxYjQ5YmRiZTg4ODNmNDliZjRjZDAzNjM4ZTAzMjlhZTI1Ng==', 'Ahmedabad', '9102245783', '', NULL, NULL, 0, 'F', '2017-11-15', 1, 1, 1, 1, '', '', 7, 0, 0, '2017-11-22 12:29:20', '2017-11-22 11:29:20', 'FEF858DD85', 1, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;
--
-- AUTO_INCREMENT for table `hms_appoitments`
--
ALTER TABLE `hms_appoitments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hms_availability`
--
ALTER TABLE `hms_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `hms_healthinsuranceprovider`
--
ALTER TABLE `hms_healthinsuranceprovider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `hms_healthrecords`
--
ALTER TABLE `hms_healthrecords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `hms_medical_lab`
--
ALTER TABLE `hms_medical_lab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `hms_messages`
--
ALTER TABLE `hms_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hms_notification`
--
ALTER TABLE `hms_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;
--
-- AUTO_INCREMENT for table `hms_nurse`
--
ALTER TABLE `hms_nurse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;
--
-- AUTO_INCREMENT for table `hms_wards`
--
ALTER TABLE `hms_wards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
