#
# TABLE STRUCTURE FOR: appointment_history
#

DROP TABLE IF EXISTS `appointment_history`;

CREATE TABLE `appointment_history` (
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
  PRIMARY KEY (`appointment_history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (1, 1, '01/22/2019', '19:00', '19:30', '', 'superadmin-superadmin-1', '', 1, '2019-01-22 15:12:37');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (2, 1, '', '', '', 'System', 'MyPulse', '', 7, '2019-01-23 00:23:34');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (3, 2, '01/24/2019', '10:00', '10:30', '', 'users-user-1', '', 1, '2019-01-23 17:31:22');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (4, 2, '', '', '', '', 'superadmin-superadmin-1', 'sdsds', 6, '2019-01-23 20:42:46');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (5, 3, '01/24/2019', '18:00', '18:30', '', 'superadmin-superadmin-1', '', 1, '2019-01-23 22:22:06');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (6, 4, '01/28/2019', '18:00', '18:30', '', 'superadmin-superadmin-1', '', 1, '2019-01-23 22:43:38');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (7, 3, '', '', '', 'System', 'MyPulse', '', 7, '2019-01-28 12:01:33');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (8, 4, '', '', '', 'System', 'MyPulse', '', 7, '2019-01-28 12:01:34');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (9, 5, '01/28/2019', '18:30', '19:00', '', 'superadmin-superadmin-1', '', 1, '2019-01-28 18:23:40');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (10, 5, '01/28/2019', '19:00', '19:30', '', 'superadmin-superadmin-1', '', 5, '2019-01-28 18:27:07');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (11, 6, '1970-01-01', '10:00', '10:30', '', 'superadmin-superadmin-1', '', 1, '2019-01-28 22:28:52');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (12, 7, '2019-01-29', '17:30', '18:00', '', 'superadmin-superadmin-1', '', 1, '2019-01-28 22:37:26');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (13, 8, '2019-01-31', '18:00', '18:30', '', 'superadmin-superadmin-1', '', 1, '2019-01-31 12:39:02');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (14, 9, '2019-01-31', '18:30', '19:00', '', 'superadmin-superadmin-1', '', 1, '2019-01-31 12:40:27');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (15, 10, '2019-01-31', '18:30', '19:00', '', 'superadmin-superadmin-1', '', 1, '2019-01-31 12:40:57');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (16, 11, '2019-01-31', '18:00', '18:30', '', 'superadmin-superadmin-1', '', 1, '2019-01-31 12:41:28');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (17, 12, '2019-02-01', '18:30', '19:00', '', 'superadmin-superadmin-1', '', 1, '2019-02-01 17:44:21');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (18, 13, '2019-02-02', '17:30', '18:00', '', 'superadmin-superadmin-1', '', 1, '2019-02-01 18:21:40');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (19, 13, '', '', '', '', 'superadmin-superadmin-1', 'sdsdsd', 6, '2019-02-01 18:22:28');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (20, 13, '', '', '', '', 'superadmin-superadmin-1', 'sdsdsd', 6, '2019-02-01 18:22:34');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (21, 14, '2019-02-04', '11:00', '11:30', '', 'superadmin-superadmin-1', '', 1, '2019-02-02 11:16:32');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (22, 15, '2019-02-04', '18:00', '18:30', '', 'superadmin-superadmin-1', '', 1, '2019-02-02 11:30:39');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (23, 16, '2019-02-05', '11:00', '11:30', '', 'doctors-doctor-1', '', 1, '2019-02-02 11:38:49');


#
# TABLE STRUCTURE FOR: appointments
#

DROP TABLE IF EXISTS `appointments`;

CREATE TABLE `appointments` (
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
  `attended_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=not-attended,1=attended',
  PRIMARY KEY (`appointment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (1, 'MPA19_100001', 2, 1, 2, 1, '2019-01-22', '19:00', '19:30', 4, 'Normal', '', NULL, '', 'superadmin-superadmin-1', '2019-02-02 12:53:31', '2019-02-02 12:53:31', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (2, 'MPA19_100002', 1, 1, 2, 1, '2019-01-24', '10:00', '10:30', 3, 'Normal', 'Appointment was cancelled by: \"Super Admin - Super\" for the reason: \" sdsds\".', NULL, '', 'users-user-1', '2019-02-02 12:53:13', '2019-02-02 12:53:13', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (3, 'MPA19_100003', 1, 1, 2, 1, '2019-01-24', '18:00', '18:30', 4, 'FEVER', '', NULL, '', 'superadmin-superadmin-1', '2019-02-02 12:53:10', '2019-02-02 12:53:10', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (4, 'MPA19_100004', 2, 2, 1, 2, '2019-01-24', '18:00', '18:30', 4, 'FEVER', '', NULL, '', 'superadmin-superadmin-1', '2019-02-02 12:53:06', '2019-02-02 12:53:06', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (5, 'MPA19_100005', 1, 1, 2, 1, '2019-01-28', '19:00', '19:30', 2, 'Normal', '', NULL, '', 'superadmin-superadmin-1', '2019-02-02 12:53:02', '2019-02-02 12:53:02', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (6, 'MPA19_100006', 2, 1, 2, 1, '2019-01-28', '10:00', '10:30', 2, 'Normal', '', NULL, '', 'superadmin-superadmin-1', '2019-02-02 12:52:59', '2019-02-02 12:52:59', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (7, 'MPA19_100007', 3, 2, 1, 2, '2019-01-29', '17:30', '18:00', 2, 'Normal', '', NULL, '', 'superadmin-superadmin-1', '2019-02-02 12:52:55', '2019-02-02 12:52:55', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (8, 'MPA19_100008', 3, 1, 2, 1, '2019-01-31', '18:00', '18:30', 2, 'Normal', '', NULL, '', 'superadmin-superadmin-1', '2019-02-02 12:52:50', '2019-02-02 12:52:50', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (9, 'MPA19_100009', 2, 1, 2, 1, '2019-01-31', '18:30', '19:00', 2, 'Normal', '', NULL, '', 'superadmin-superadmin-1', '2019-02-02 12:52:46', '2019-02-02 12:52:46', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (10, 'MPA19_100010', 2, 1, 2, 1, '2019-01-31', '18:30', '19:00', 2, 'Normal', '', NULL, '', 'superadmin-superadmin-1', '2019-02-02 12:52:43', '2019-02-02 12:52:43', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (11, 'MPA19_100012', 4, 1, 2, 1, '2019-01-31', '18:00', '18:30', 2, 'Normal', '', NULL, '', 'superadmin-superadmin-1', '2019-02-02 12:52:39', '2019-02-02 12:52:39', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (12, 'MPA19_100013', 1, 2, 1, 2, '2019-02-01', '18:30', '19:00', 2, 'Normal', '', NULL, '', 'superadmin-superadmin-1', '2019-02-02 12:52:35', '2019-02-02 12:52:35', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (13, 'MPA19_100014', 2, 2, 1, 2, '2019-02-02', '17:30', '18:00', 3, 'FEVER', 'Appointment was cancelled by: \"Super Admin - Super\" for the reason: \" sdsdsd\".', NULL, '', 'superadmin-superadmin-1', '2019-02-02 12:52:31', '2019-02-02 12:52:31', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (14, 'MPA19_100015', 1, 1, 2, 1, '2019-02-04', '11:00', '11:30', 2, 'Normal', '', NULL, '', 'superadmin-superadmin-1', '2019-02-02 12:52:25', '2019-02-02 12:52:25', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (15, 'MPA19_100016', 2, 1, 2, 1, '2019-02-04', '18:00', '18:30', 2, 'FEVER', '', NULL, '', 'superadmin-superadmin-1', '2019-02-02 11:30:39', '2019-02-02 11:30:39', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (16, 'MPA19_100017', 7, 1, 2, 1, '2019-02-05', '11:00', '11:30', 2, 'FEVER', '', NULL, '', 'doctors-doctor-1', '2019-02-02 11:40:45', '2019-02-02 11:40:45', 0);


#
# TABLE STRUCTURE FOR: availability
#

DROP TABLE IF EXISTS `availability`;

CREATE TABLE `availability` (
  `availability_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `no_appt_handle` varchar(10) NOT NULL,
  `message` longtext NOT NULL,
  `start_time` longtext NOT NULL,
  `end_time` longtext NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1=available,2=not-available',
  PRIMARY KEY (`availability_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `availability` (`availability_id`, `doctor_id`, `no_appt_handle`, `message`, `start_time`, `end_time`, `status`) VALUES (1, 2, '20', 'Available only Monday - Friday  10:00 Am - 11:30 Am and  05:00 Pm - 08:00 Pm', '', '', 0);
INSERT INTO `availability` (`availability_id`, `doctor_id`, `no_appt_handle`, `message`, `start_time`, `end_time`, `status`) VALUES (2, 1, '10', '1', '', '', 0);


#
# TABLE STRUCTURE FOR: availability_slot
#

DROP TABLE IF EXISTS `availability_slot`;

CREATE TABLE `availability_slot` (
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=243 DEFAULT CHARSET=latin1;

INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (238, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/24/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (237, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/23/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (236, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/22/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (235, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/21/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (234, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/20/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (233, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/19/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (232, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/18/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (231, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/17/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (230, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/16/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (229, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/15/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (228, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/14/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (227, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/13/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (226, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/12/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (225, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/11/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (224, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/10/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (223, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/09/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (222, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/08/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (221, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/07/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (220, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/06/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (219, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/05/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (218, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/04/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (217, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/03/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (216, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/02/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (210, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/27/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (209, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/26/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (208, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/25/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (207, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/24/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (206, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/23/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (205, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/22/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (204, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/21/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (203, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/20/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (202, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/19/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (201, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/18/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (200, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/17/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (199, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/16/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (198, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/15/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (197, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/14/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (196, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/13/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (195, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/12/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (194, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/11/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (193, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/10/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (192, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/09/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (191, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/08/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (190, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/07/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (185, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/02/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (186, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/03/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (187, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/04/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (188, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/05/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (189, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/06/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (184, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/28/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (183, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/27/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (182, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/26/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (181, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/25/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (180, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/24/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (179, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/23/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (178, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/22/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (177, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/21/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (176, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/20/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (175, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/19/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (174, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/18/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (173, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/17/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (172, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/16/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (171, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/15/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (170, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/14/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (169, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/13/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (168, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/12/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (167, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/11/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (166, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/10/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (165, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/09/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (164, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/08/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (163, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/07/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (162, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/06/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (161, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/05/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (160, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/04/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (159, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/03/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (158, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/02/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (157, 2, '02/01/2019', '02/28/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '5232', '02/01/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (148, 1, '01/23/2019', '01/31/2019', '17:00', '20:00', 1, '0,1,2,3,4,5,6', '7678', '01/23/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (149, 1, '01/23/2019', '01/31/2019', '17:00', '20:00', 1, '0,1,2,3,4,5,6', '7678', '01/24/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (150, 1, '01/23/2019', '01/31/2019', '17:00', '20:00', 1, '0,1,2,3,4,5,6', '7678', '01/25/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (151, 1, '01/23/2019', '01/31/2019', '17:00', '20:00', 1, '0,1,2,3,4,5,6', '7678', '01/26/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (152, 1, '01/23/2019', '01/31/2019', '17:00', '20:00', 1, '0,1,2,3,4,5,6', '7678', '01/27/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (153, 1, '01/23/2019', '01/31/2019', '17:00', '20:00', 1, '0,1,2,3,4,5,6', '7678', '01/28/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (154, 1, '01/23/2019', '01/31/2019', '17:00', '20:00', 1, '0,1,2,3,4,5,6', '7678', '01/29/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (155, 1, '01/23/2019', '01/31/2019', '17:00', '20:00', 1, '0,1,2,3,4,5,6', '7678', '01/30/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (156, 1, '01/23/2019', '01/31/2019', '17:00', '20:00', 1, '0,1,2,3,4,5,6', '7678', '01/31/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (211, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '02/28/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (212, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '03/01/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (213, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '03/02/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (214, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '03/03/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (215, 1, '02/02/2019', '03/04/2019', '17:00', '20:00', 0, '1,2,3,4,5', '6211', '03/04/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (239, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/25/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (240, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/26/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (241, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/27/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (242, 1, '02/02/2019', '02/28/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4377', '02/28/2019', 1);


#
# TABLE STRUCTURE FOR: bed
#

DROP TABLE IF EXISTS `bed`;

CREATE TABLE `bed` (
  `bed_id` int(11) NOT NULL AUTO_INCREMENT,
  `hospital_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `bed_status` tinyint(4) NOT NULL COMMENT '1=available,2=not-available',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=not-deleted,2=deleted',
  PRIMARY KEY (`bed_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `bed` (`bed_id`, `hospital_id`, `branch_id`, `department_id`, `ward_id`, `name`, `bed_status`, `isDeleted`) VALUES (1, 1, 2, 2, 1, 'B1', 2, 1);
INSERT INTO `bed` (`bed_id`, `hospital_id`, `branch_id`, `department_id`, `ward_id`, `name`, `bed_status`, `isDeleted`) VALUES (2, 1, 2, 2, 1, 'B2', 1, 1);


#
# TABLE STRUCTURE FOR: branch
#

DROP TABLE IF EXISTS `branch`;

CREATE TABLE `branch` (
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
  PRIMARY KEY (`branch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `branch` (`branch_id`, `hospital_id`, `name`, `phone`, `email`, `address`, `city`, `district`, `state`, `country`, `created_at`, `modified_at`, `status`, `isDeleted`) VALUES (1, 2, 'Branch1', '1231231233', 'b1@g.com', 'Branch1', 3, 2, 32, 1, '0000-00-00 00:00:00', '2019-01-27 20:26:37', 1, 1);
INSERT INTO `branch` (`branch_id`, `hospital_id`, `name`, `phone`, `email`, `address`, `city`, `district`, `state`, `country`, `created_at`, `modified_at`, `status`, `isDeleted`) VALUES (2, 1, 'Branch2', '1231231233', 'b2@g.com', 'b2', 2, 1, 2, 1, '0000-00-00 00:00:00', '2019-01-27 20:26:43', 1, 1);


#
# TABLE STRUCTURE FOR: ci_sessions
#

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('0hj40aem9189icuurc9i3htma95uro3l', '::1', 1549088537, '__ci_last_regenerate|i:1549088537;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login_user_id|s:1:\"1\";name|s:8:\"Doctor 1\";hospital_id|s:1:\"1\";hospital_name|s:12:\"Hospital 111\";license|s:1:\"2\";unique_id|s:12:\"MPD19_100001\";branch_id|s:1:\"2\";department_id|s:1:\"2\";login_type|s:7:\"doctors\";type_id|s:6:\"doctor\";login|s:1:\"1\";current_language|s:7:\"english\";last_page|s:41:\"http://localhost/mypulse/main/appointment\";last_page1|s:49:\"http://localhost/mypulse/main/edit_appointment/16\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('1afnsr82q68kd5akd7uprhngi797g8oh', '::1', 1549092715, '__ci_last_regenerate|i:1549090296;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";current_language|s:7:\"english\";last_page|s:45:\"http://localhost/mypulse/main/hospital_admins\";last_page1|s:51:\"http://localhost/mypulse/main/doctor_availability/1\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('60am0sjhoffbgqo83f0rtdfa6pedr4a3', '::1', 1549088672, '__ci_last_regenerate|i:1549088672;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";current_language|s:7:\"english\";last_page|s:41:\"http://localhost/mypulse/main/appointment\";last_page1|s:51:\"http://localhost/mypulse/main/doctor_availability/1\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('673vbknne6snshkjh6jllmfumkm557g4', '::1', 1549089234, '__ci_last_regenerate|i:1549089234;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login_user_id|s:1:\"1\";name|s:15:\"Hospital Admin1\";hospital_id|s:1:\"1\";unique_id|s:13:\"MPHA19_100001\";hospital_name|s:12:\"Hospital 111\";license|s:1:\"2\";login_type|s:14:\"hospitaladmins\";type_id|s:5:\"admin\";login|s:1:\"1\";current_language|s:7:\"english\";last_page|s:52:\"http://localhost/mypulse/main/get_hospital_history/1\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('7kkrp8qg00rs6vvjqs58ks1v86hdeudm', '::1', 1549087463, '__ci_last_regenerate|i:1549087463;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login_user_id|s:1:\"1\";name|s:8:\"Doctor 1\";hospital_id|s:1:\"1\";hospital_name|s:12:\"Hospital 111\";license|s:1:\"2\";unique_id|s:12:\"MPD19_100001\";branch_id|s:1:\"2\";department_id|s:1:\"2\";login_type|s:7:\"doctors\";type_id|s:6:\"doctor\";login|s:1:\"1\";current_language|s:7:\"english\";last_page|s:39:\"http://localhost/mypulse/main/dashboard\";last_page1|s:49:\"http://localhost/mypulse/main/edit_appointment/15\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('7ve2eul6jhkfb3uejs1ooer79mnhf522', '::1', 1549089535, '__ci_last_regenerate|i:1549089535;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login_user_id|s:1:\"1\";name|s:15:\"Hospital Admin1\";hospital_id|s:1:\"1\";unique_id|s:13:\"MPHA19_100001\";hospital_name|s:12:\"Hospital 111\";license|s:1:\"2\";login_type|s:14:\"hospitaladmins\";type_id|s:5:\"admin\";login|s:1:\"1\";current_language|s:7:\"english\";last_page|s:52:\"http://localhost/mypulse/main/get_hospital_history/1\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('8bntehr61hdtbphc29mhitjgvo3fq3vj', '::1', 1549087022, '__ci_last_regenerate|i:1549087022;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";current_language|s:7:\"english\";last_page|s:41:\"http://localhost/mypulse/main/appointment\";last_page1|s:51:\"http://localhost/mypulse/main/doctor_availability/1\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('at1dttnfsja81lkkpt3k9du6u7u0hns9', '::1', 1549092717, '__ci_last_regenerate|i:1549092717;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login_user_id|s:1:\"1\";name|s:15:\"Hospital Admin1\";hospital_id|s:1:\"1\";unique_id|s:13:\"MPHA19_100001\";hospital_name|s:12:\"Hospital 111\";license|s:1:\"2\";login_type|s:14:\"hospitaladmins\";type_id|s:5:\"admin\";login|s:1:\"1\";current_language|s:7:\"english\";last_page|s:52:\"http://localhost/mypulse/main/get_hospital_history/1\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('dbsaob9k6pdshl92fro3khtcempv534i', '::1', 1549086275, 'site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('epqvmktqo19gfql45g3gnem8u3vi4jlb', '::1', 1549090174, '__ci_last_regenerate|i:1549090174;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login_user_id|s:1:\"1\";name|s:15:\"Hospital Admin1\";hospital_id|s:1:\"1\";unique_id|s:13:\"MPHA19_100001\";hospital_name|s:12:\"Hospital 111\";license|s:1:\"2\";login_type|s:14:\"hospitaladmins\";type_id|s:5:\"admin\";login|s:1:\"1\";current_language|s:7:\"english\";last_page|s:52:\"http://localhost/mypulse/main/get_hospital_history/1\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('eq3ql6l1nfb23r5ks5ta9evqqi6v634a', '::1', 1549086258, '__ci_last_regenerate|i:1549086258;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";current_language|s:7:\"english\";last_page|s:52:\"http://localhost/mypulse/main/get_hospital_history/1\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('f4c27atfbmt3ig66l4hu06qmgt67alq4', '::1', 1549086021, '__ci_last_regenerate|i:1549086021;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login_user_id|s:1:\"1\";name|s:15:\"Hospital Admin1\";hospital_id|s:1:\"1\";unique_id|s:13:\"MPHA19_100001\";hospital_name|s:12:\"Hospital 111\";license|s:1:\"2\";login_type|s:14:\"hospitaladmins\";type_id|s:5:\"admin\";login|s:1:\"1\";current_language|s:7:\"english\";last_page|s:42:\"http://localhost/mypulse/main/medical_labs\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('fsqjvbmb4sj6qn530ju29g7qjnbomlql', '::1', 1549086734, '__ci_last_regenerate|i:1549086733;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login_user_id|s:1:\"1\";name|s:8:\"Doctor 1\";hospital_id|s:1:\"1\";hospital_name|s:12:\"Hospital 111\";license|s:1:\"2\";unique_id|s:12:\"MPD19_100001\";branch_id|s:1:\"2\";department_id|s:1:\"2\";login_type|s:7:\"doctors\";type_id|s:6:\"doctor\";login|s:1:\"1\";current_language|s:7:\"english\";last_page|s:39:\"http://localhost/mypulse/main/dashboard\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('hj08c0p8ir2sv81s5c8odvgdpi3ujdr9', '::1', 1549089836, '__ci_last_regenerate|i:1549089836;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login_user_id|s:1:\"1\";name|s:15:\"Hospital Admin1\";hospital_id|s:1:\"1\";unique_id|s:13:\"MPHA19_100001\";hospital_name|s:12:\"Hospital 111\";license|s:1:\"2\";login_type|s:14:\"hospitaladmins\";type_id|s:5:\"admin\";login|s:1:\"1\";current_language|s:7:\"english\";last_page|s:52:\"http://localhost/mypulse/main/get_hospital_history/1\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('kf4e3l4jet9c309hdcd0f5jfopfvcvor', '::1', 1549087333, '__ci_last_regenerate|i:1549087332;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";current_language|s:7:\"english\";last_page|s:41:\"http://localhost/mypulse/main/appointment\";last_page1|s:51:\"http://localhost/mypulse/main/doctor_availability/1\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('obvfdu4uiagiesg43j8bqdm8l102i1s0', '::1', 1549087054, '__ci_last_regenerate|i:1549087054;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login_user_id|s:1:\"1\";name|s:8:\"Doctor 1\";hospital_id|s:1:\"1\";hospital_name|s:12:\"Hospital 111\";license|s:1:\"2\";unique_id|s:12:\"MPD19_100001\";branch_id|s:1:\"2\";department_id|s:1:\"2\";login_type|s:7:\"doctors\";type_id|s:6:\"doctor\";login|s:1:\"1\";current_language|s:7:\"english\";last_page|s:39:\"http://localhost/mypulse/main/dashboard\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('r9aoh1akflkk2glnpmojv72jg44neqb9', '::1', 1549089226, '__ci_last_regenerate|i:1549089226;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";current_language|s:7:\"english\";last_page|s:52:\"http://localhost/mypulse/main/get_hospital_history/1\";last_page1|s:51:\"http://localhost/mypulse/main/doctor_availability/1\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('truh0nur30mbk56u5lsj56cqnrq6aolk', '::1', 1549090296, '__ci_last_regenerate|i:1549090296;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";current_language|s:7:\"english\";last_page|s:52:\"http://localhost/mypulse/main/get_hospital_history/1\";last_page1|s:51:\"http://localhost/mypulse/main/doctor_availability/1\";');


#
# TABLE STRUCTURE FOR: city
#

DROP TABLE IF EXISTS `city`;

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `city` (`city_id`, `country_id`, `state_id`, `district_id`, `name`) VALUES (1, 1, 2, 1, 'Kurnool');
INSERT INTO `city` (`city_id`, `country_id`, `state_id`, `district_id`, `name`) VALUES (2, 1, 2, 1, 'Nandayala');
INSERT INTO `city` (`city_id`, `country_id`, `state_id`, `district_id`, `name`) VALUES (3, 1, 32, 2, 'Hyderabad');
INSERT INTO `city` (`city_id`, `country_id`, `state_id`, `district_id`, `name`) VALUES (4, 1, 32, 2, 'Karimnager');


#
# TABLE STRUCTURE FOR: country
#

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `country` (`country_id`, `name`) VALUES (1, 'India');


#
# TABLE STRUCTURE FOR: department
#

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `hospital_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active,2=inactive',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=not-deleted,2=deleted',
  PRIMARY KEY (`department_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `department` (`department_id`, `hospital_id`, `branch_id`, `name`, `description`, `status`, `isDeleted`) VALUES (1, 2, 1, 'Department1', '', 1, 1);
INSERT INTO `department` (`department_id`, `hospital_id`, `branch_id`, `name`, `description`, `status`, `isDeleted`) VALUES (2, 1, 2, 'D2', '', 1, 1);


#
# TABLE STRUCTURE FOR: district
#

DROP TABLE IF EXISTS `district`;

CREATE TABLE `district` (
  `district_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  PRIMARY KEY (`district_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `district` (`district_id`, `country_id`, `state_id`, `name`) VALUES (1, 1, 2, 'Kurnool');
INSERT INTO `district` (`district_id`, `country_id`, `state_id`, `name`) VALUES (2, 1, 32, 'Hyderabad');


#
# TABLE STRUCTURE FOR: doctors
#

DROP TABLE IF EXISTS `doctors`;

CREATE TABLE `doctors` (
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
  PRIMARY KEY (`doctor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `doctors` (`doctor_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `address`, `phone`, `description`, `gender`, `dob`, `aadhar`, `qualification`, `specializations`, `experience`, `registration`, `hospital_id`, `branch_id`, `department_id`, `country`, `state`, `district`, `city`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (1, 'MPD19_100001', 'Doctor 1', 'Doctor 1', 'Doctor 1', 'd1@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '', '1231231235', 'Doctor 1 for hospital 1', '', '', '', '', '1,3', '', '', 1, 2, 2, 0, 0, 0, 0, 1, 2, 1, '2019-01-30 16:40:41', '2019-01-30 16:40:41', 1);
INSERT INTO `doctors` (`doctor_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `address`, `phone`, `description`, `gender`, `dob`, `aadhar`, `qualification`, `specializations`, `experience`, `registration`, `hospital_id`, `branch_id`, `department_id`, `country`, `state`, `district`, `city`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (2, 'MPD19_100002', 'Doctor2', 'Doctor 2', 'Doctor2', 'd2@g.com', 'e5a1b2af03e9efe769bd8398475bb091f3356c3e', '', '1421421422', 'Doctor 2', '', '', '', '', '', '', '', 2, 1, 1, 0, 0, 0, 0, 2, 2, 1, '2019-01-29 13:13:24', '2019-01-29 13:13:24', 1);


#
# TABLE STRUCTURE FOR: feedback
#

DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(60) NOT NULL,
  `feedback` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `feedback` (`id`, `customer_id`, `feedback`) VALUES (1, 'hospitaladmins-admin-1', 'Easily Track and manage list of all your Patients(Both out-patient, in-patient, their appointments, Inpatient data etc.)aaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
INSERT INTO `feedback` (`id`, `customer_id`, `feedback`) VALUES (2, 'doctors-doctor-2', 'Easily Track and manage list of all your Patients(Both out-patient, in-patient, their appointments, Inpatient data etc.)');
INSERT INTO `feedback` (`id`, `customer_id`, `feedback`) VALUES (3, 'doctors-doctor-1', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
INSERT INTO `feedback` (`id`, `customer_id`, `feedback`) VALUES (4, 'doctors-doctor-1', 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb');


#
# TABLE STRUCTURE FOR: health_insurance_provider
#

DROP TABLE IF EXISTS `health_insurance_provider`;

CREATE TABLE `health_insurance_provider` (
  `health_insurance_provider_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext NOT NULL,
  PRIMARY KEY (`health_insurance_provider_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `health_insurance_provider` (`health_insurance_provider_id`, `name`) VALUES (1, 'mahesh');


#
# TABLE STRUCTURE FOR: hospitaladmins
#

DROP TABLE IF EXISTS `hospitaladmins`;

CREATE TABLE `hospitaladmins` (
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `hospitaladmins` (`admin_id`, `unique_id`, `hospital_id`, `name`, `mname`, `lname`, `email`, `password`, `phone`, `address`, `country`, `state`, `district`, `city`, `aadhar`, `gender`, `dob`, `qualification`, `profession`, `experience`, `description`, `last_login`, `last_logout`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (1, 'MPHA19_100001', 1, 'Hospital Admin1', '', 'Admin', 'ha1@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '8120015502', '', 0, 0, 0, 0, '', '', '', '', '', '', 'Admin For Hospital 1', '', '', 1, 2, 1, '2019-01-28 17:28:12', '2019-01-28 17:28:12', 1);
INSERT INTO `hospitaladmins` (`admin_id`, `unique_id`, `hospital_id`, `name`, `mname`, `lname`, `email`, `password`, `phone`, `address`, `country`, `state`, `district`, `city`, `aadhar`, `gender`, `dob`, `qualification`, `profession`, `experience`, `description`, `last_login`, `last_logout`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (2, 'MPHA19_100002', 1, 'Ha2', 'Ha2', 'Ha2', 'ha2@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '1421421423', '', 0, 0, 0, 0, '', '', '', '', '', '', 'Ha2', '', '', 1, 2, 1, '2019-01-28 17:28:32', '2019-01-28 17:28:32', 1);
INSERT INTO `hospitaladmins` (`admin_id`, `unique_id`, `hospital_id`, `name`, `mname`, `lname`, `email`, `password`, `phone`, `address`, `country`, `state`, `district`, `city`, `aadhar`, `gender`, `dob`, `qualification`, `profession`, `experience`, `description`, `last_login`, `last_logout`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (3, 'MPHA19_100003', 2, 'hadmin1', 'hadmin1', 'hadmin1', 'hadmin1@g.com', 'e5a1b2af03e9efe769bd8398475bb091f3356c3e', '7755775555', '1-76 main road devanakonda', 1, 2, 1, 1, '', 'male', '01/01/2019', 'MBBS', 'SUPER', '10', 'hadmin1', '', '', 2, 2, 1, '2019-01-30 16:54:59', '2019-01-30 16:54:59', 1);


#
# TABLE STRUCTURE FOR: hospitals
#

DROP TABLE IF EXISTS `hospitals`;

CREATE TABLE `hospitals` (
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `hospitals` (`hospital_id`, `unique_id`, `name`, `address`, `description`, `phone_number`, `email`, `license_category`, `city`, `district`, `state`, `country`, `md_name`, `md_contact_number`, `created_at`, `modified_at`, `status`, `license`, `license_status`, `from_date`, `till_date`, `isDeleted`) VALUES (1, 'MPH19_100001', 'Hospital 111', 'Ha1', 'Hospital Number 1', '1231231231', 'ha1@g.com', NULL, '1', '1', '2', '1', 'HA', '1231231231', '2019-02-01 20:45:31', '2019-01-08 17:19:55', 1, '2', 1, '01/28/2019', '01/29/2020', 1);
INSERT INTO `hospitals` (`hospital_id`, `unique_id`, `name`, `address`, `description`, `phone_number`, `email`, `license_category`, `city`, `district`, `state`, `country`, `md_name`, `md_contact_number`, `created_at`, `modified_at`, `status`, `license`, `license_status`, `from_date`, `till_date`, `isDeleted`) VALUES (2, 'MPH19_100002', 'Hospital2', 'Ha2', 'Hospital Number 2', '1231231232', 'ha2@g.com', NULL, '3', '2', '32', '1', 'HA2', '1231231232', '2019-01-28 17:27:44', '2019-01-08 17:23:26', 1, '2', 1, '01/09/2019', '01/14/2020', 1);


#
# TABLE STRUCTURE FOR: inpatient
#

DROP TABLE IF EXISTS `inpatient`;

CREATE TABLE `inpatient` (
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
  `show_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=show,2=hide',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: inpatient_history
#

DROP TABLE IF EXISTS `inpatient_history`;

CREATE TABLE `inpatient_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `in_patient_id` int(11) NOT NULL,
  `created_date` longtext NOT NULL,
  `note` text NOT NULL,
  `cost` float NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES (1, 0, '123456', 0, 0, 0, NULL, 0);
INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES (2, 0, 'MyPulse#@007', 0, 0, 0, NULL, 0);


#
# TABLE STRUCTURE FOR: language
#

DROP TABLE IF EXISTS `language`;

CREATE TABLE `language` (
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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `language` (`language_id`, `name`, `phrase_id`, `phrase`, `english`, `bengali`, `spanish`, `arabic`, `dutch`, `polish`, `german`, `french`, `italian`, `russian`, `portugese`) VALUES (1, 'English', 0, '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `language` (`language_id`, `name`, `phrase_id`, `phrase`, `english`, `bengali`, `spanish`, `arabic`, `dutch`, `polish`, `german`, `french`, `italian`, `russian`, `portugese`) VALUES (2, 'Telugu', 0, '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `language` (`language_id`, `name`, `phrase_id`, `phrase`, `english`, `bengali`, `spanish`, `arabic`, `dutch`, `polish`, `german`, `french`, `italian`, `russian`, `portugese`) VALUES (4, 'Hindi', 0, '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `language` (`language_id`, `name`, `phrase_id`, `phrase`, `english`, `bengali`, `spanish`, `arabic`, `dutch`, `polish`, `german`, `french`, `italian`, `russian`, `portugese`) VALUES (5, 'Kannada', 0, '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `language` (`language_id`, `name`, `phrase_id`, `phrase`, `english`, `bengali`, `spanish`, `arabic`, `dutch`, `polish`, `german`, `french`, `italian`, `russian`, `portugese`) VALUES (6, 'Urdu', 0, '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `language` (`language_id`, `name`, `phrase_id`, `phrase`, `english`, `bengali`, `spanish`, `arabic`, `dutch`, `polish`, `german`, `french`, `italian`, `russian`, `portugese`) VALUES (7, 'Marathi', 0, '', '', '', '', '', '', '', '', '', '', '', '');


#
# TABLE STRUCTURE FOR: license
#

DROP TABLE IF EXISTS `license`;

CREATE TABLE `license` (
  `license_id` int(11) NOT NULL AUTO_INCREMENT,
  `license_category_id` int(11) NOT NULL,
  `license_code` longtext NOT NULL,
  `name` longtext NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`license_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `license` (`license_id`, `license_category_id`, `license_code`, `name`, `description`) VALUES (1, 1, 'LAA', 'LAAA', 'Laa');
INSERT INTO `license` (`license_id`, `license_category_id`, `license_code`, `name`, `description`) VALUES (2, 2, 'HAA', 'HAA', 'HAA');
INSERT INTO `license` (`license_id`, `license_category_id`, `license_code`, `name`, `description`) VALUES (3, 2, 'LCM1', 'License Mahi 1', 'This Licence for only hospitals');


#
# TABLE STRUCTURE FOR: license_category
#

DROP TABLE IF EXISTS `license_category`;

CREATE TABLE `license_category` (
  `license_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `license_category_code` varchar(60) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`license_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `license_category` (`license_category_id`, `license_category_code`, `name`, `description`) VALUES (1, 'MPCL_19001', 'Clinic', 'Clinic');
INSERT INTO `license_category` (`license_category_id`, `license_category_code`, `name`, `description`) VALUES (2, 'MPHL_19002', 'Hospital', 'Hospital');
INSERT INTO `license_category` (`license_category_id`, `license_category_code`, `name`, `description`) VALUES (3, 'MPMS_19003', 'Medical Store', 'Medical Store');
INSERT INTO `license_category` (`license_category_id`, `license_category_code`, `name`, `description`) VALUES (4, 'MPML_19004', 'Medical Lab ', 'Medical Lab ');
INSERT INTO `license_category` (`license_category_id`, `license_category_code`, `name`, `description`) VALUES (5, 'MPBB_19005', 'Blood Bank', 'Blood Bank');


#
# TABLE STRUCTURE FOR: logs
#

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (1, 'api/example/users', 'get', 'a:9:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:9:\"X-API-KEY\";s:6:\"123456\";s:13:\"Postman-Token\";s:36:\"205c25b0-7254-43b5-7edb-2e053e550c6f\";s:6:\"Accept\";s:3:\"*/*\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";}', '123456', '::1', 1548945655, '1548950000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (2, 'api/example/users', 'get', 'a:9:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:9:\"X-API-KEY\";s:4:\"1234\";s:13:\"Postman-Token\";s:36:\"8140000a-0795-faf5-c477-7e55fb4a5cac\";s:6:\"Accept\";s:3:\"*/*\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";}', '', '::1', 1548945966, '1548950000', '0', 403);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (3, 'api/example/users', 'get', 'a:9:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:9:\"X-API-KEY\";s:6:\"123456\";s:13:\"Postman-Token\";s:36:\"b128f174-1f5f-0ed1-1f27-b3661add28a5\";s:6:\"Accept\";s:3:\"*/*\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";}', '123456', '::1', 1548945972, '1548950000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (4, 'api/example/users', 'get', 'a:8:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:6:\"Accept\";s:85:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:86:\"_ga=GA1.1.1675376399.1539338983; ciNav=no; ci_session=jccg3en7l6mq8mmfdku4op4inar01k67\";}', '', '::1', 1548945982, '1548950000', '0', 403);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (5, 'api/example/users', 'get', 'a:9:{s:9:\"X-API-KEY\";s:6:\"123456\";s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:6:\"Accept\";s:85:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:86:\"_ga=GA1.1.1675376399.1539338983; ciNav=no; ci_session=jccg3en7l6mq8mmfdku4op4inar01k67\";}', '123456', '::1', 1548946018, '1548950000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (6, 'api/example/users', 'get', 'a:9:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:9:\"X-API-KEY\";s:6:\"123456\";s:13:\"Postman-Token\";s:36:\"7367f6f9-b267-81de-2303-8dff047d354b\";s:6:\"Accept\";s:3:\"*/*\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";}', '123456', '::1', 1548950995, '1548950000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (7, 'api/example/users', 'get', 'a:10:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:9:\"X-API-KEY\";s:6:\"123453\";s:13:\"Postman-Token\";s:36:\"8c24f98d-30ba-9a13-7e42-dc5f4d6576bb\";s:6:\"Accept\";s:3:\"*/*\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:43:\"ci_session=i62oii6m1gpp23g8n4kjrdk4ogg4592g\";}', '', '::1', 1548951003, '1548950000', '0', 403);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (8, 'api/example/users', 'get', 'a:10:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:9:\"X-API-KEY\";s:12:\"MyPulse#@007\";s:13:\"Postman-Token\";s:36:\"9c7e9bbb-bb77-525b-23a0-bae7a63840ad\";s:6:\"Accept\";s:3:\"*/*\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:43:\"ci_session=i62oii6m1gpp23g8n4kjrdk4ogg4592g\";}', 'MyPulse#@007', '::1', 1548951208, '1548950000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (9, 'api/example/users', 'get', 'a:10:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNDU2\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:9:\"X-API-KEY\";s:6:\"123456\";s:13:\"Postman-Token\";s:36:\"0b90cb84-0e5d-d983-3ec5-b563c9146180\";s:6:\"Accept\";s:3:\"*/*\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";}', '123456', '::1', 1548958312, '1548960000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (10, 'api/example/users', 'get', 'a:9:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:9:\"X-API-KEY\";s:6:\"123456\";s:13:\"Postman-Token\";s:36:\"121fccfd-f37f-fa12-7c1e-422f43006e26\";s:6:\"Accept\";s:3:\"*/*\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";}', '123456', '::1', 1548958323, '1548960000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (11, 'api/example/users', 'get', 'a:10:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:9:\"X-API-KEY\";s:6:\"123456\";s:13:\"Postman-Token\";s:36:\"8422f950-055b-6cde-7028-d55d785e08b7\";s:6:\"Accept\";s:3:\"*/*\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";}', '123456', '::1', 1548958412, '1548960000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (12, 'api/example/users', 'get', 'a:10:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:9:\"X-API-KEY\";s:6:\"123456\";s:13:\"Postman-Token\";s:36:\"aa3e141d-e2cd-c1ed-b1da-63b6c2156f6f\";s:6:\"Accept\";s:3:\"*/*\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";}', '123456', '::1', 1548958484, '1548960000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (13, 'api/example/users', 'get', 'a:11:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:9:\"X-API-KEY\";s:6:\"123456\";s:13:\"Postman-Token\";s:36:\"a14e7f3c-2cb8-bb9c-af56-b98b643ce361\";s:6:\"Accept\";s:3:\"*/*\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:43:\"ci_session=5a6rf07ksj5olagkn7rndh2i7jtasfrf\";}', '123456', '::1', 1549003455, '1549000000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (14, 'api/example/users', 'get', 'a:9:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:6:\"Accept\";s:85:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:86:\"_ga=GA1.1.1675376399.1539338983; ciNav=no; ci_session=iei6d0hd3nedirqdvu5bk9qauf4llir7\";}', '', '::1', 1549014898, '1549010000', '0', 403);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (15, 'api/example/users', 'get', 'a:10:{s:9:\"X-API-KEY\";s:0:\"\";s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:6:\"Accept\";s:85:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:86:\"_ga=GA1.1.1675376399.1539338983; ciNav=no; ci_session=iei6d0hd3nedirqdvu5bk9qauf4llir7\";}', '', '::1', 1549014910, '1549010000', '0', 403);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (16, 'api/example/users', 'get', 'a:10:{s:9:\"X-API-KEY\";s:6:\"123456\";s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:6:\"Accept\";s:85:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:86:\"_ga=GA1.1.1675376399.1539338983; ciNav=no; ci_session=iei6d0hd3nedirqdvu5bk9qauf4llir7\";}', '123456', '::1', 1549014916, '1549010000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (17, 'api/example/users', 'get', 'a:10:{s:9:\"X-API-KEY\";s:6:\"123456\";s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:6:\"Accept\";s:85:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:86:\"_ga=GA1.1.1675376399.1539338983; ciNav=no; ci_session=iei6d0hd3nedirqdvu5bk9qauf4llir7\";}', '123456', '::1', 1549014923, '1549010000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (18, 'api/example/users', 'get', 'a:10:{s:9:\"X-API-KEY\";s:6:\"123456\";s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:6:\"Accept\";s:85:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:86:\"_ga=GA1.1.1675376399.1539338983; ciNav=no; ci_session=iei6d0hd3nedirqdvu5bk9qauf4llir7\";}', '123456', '::1', 1549014932, '1549010000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (19, 'api/example/users', 'get', 'a:11:{s:9:\"X-API-KEY\";s:6:\"123456\";s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Cache-Control\";s:9:\"max-age=0\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:6:\"Accept\";s:85:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:43:\"ci_session=q7aduhpe0ao7irhrumqd1l3aaa2cq078\";}', '123456', '::1', 1549014981, '1549020000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (20, 'api/index/users', 'get', 'a:10:{s:9:\"X-API-KEY\";s:6:\"123456\";s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:6:\"Accept\";s:85:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:43:\"ci_session=524r1jv6kuehauhblge0ucfhj7221c2j\";}', '123456', '::1', 1549015916, '1549020000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (21, 'api/index/hospitals/1', 'get', 'a:12:{i:0;N;s:9:\"X-API-KEY\";s:6:\"123456\";s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:6:\"Accept\";s:85:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:43:\"ci_session=524r1jv6kuehauhblge0ucfhj7221c2j\";i:1;N;}', '123456', '::1', 1549015943, '1549020000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (22, 'api/index/hospitals/1', 'get', 'a:13:{i:0;N;s:9:\"X-API-KEY\";s:5:\"12345\";s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Cache-Control\";s:9:\"max-age=0\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:6:\"Accept\";s:85:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:43:\"ci_session=524r1jv6kuehauhblge0ucfhj7221c2j\";i:1;N;}', '', '::1', 1549015954, '1549020000', '0', 403);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (23, 'api/index/hospitals/1', 'get', 'a:12:{i:0;N;s:9:\"X-API-KEY\";s:5:\"12345\";s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:6:\"Accept\";s:85:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:43:\"ci_session=524r1jv6kuehauhblge0ucfhj7221c2j\";i:1;N;}', '', '::1', 1549015960, '1549020000', '0', 403);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (24, 'api/index/hospitals/1', 'get', 'a:12:{i:0;N;s:9:\"X-API-KEY\";s:6:\"123456\";s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:6:\"Accept\";s:85:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:43:\"ci_session=524r1jv6kuehauhblge0ucfhj7221c2j\";i:1;N;}', '123456', '::1', 1549015965, '1549020000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (25, 'api/index/hospitals/1', 'get', 'a:12:{i:0;N;s:9:\"X-API-KEY\";s:6:\"123456\";s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:6:\"Accept\";s:85:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:43:\"ci_session=524r1jv6kuehauhblge0ucfhj7221c2j\";i:1;N;}', '123456', '::1', 1549015970, '1549020000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (26, 'api/index/hospitals/1', 'get', 'a:12:{i:0;N;s:9:\"X-API-KEY\";s:6:\"123456\";s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:6:\"Accept\";s:85:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:43:\"ci_session=524r1jv6kuehauhblge0ucfhj7221c2j\";i:1;N;}', '123456', '::1', 1549015973, '1549020000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (27, 'api/example/users', 'get', 'a:10:{s:9:\"X-API-KEY\";s:7:\"MyPulse\";s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:6:\"Accept\";s:85:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:86:\"_ga=GA1.1.1675376399.1539338983; ciNav=no; ci_session=2b2a33dplli98eksrs4o1e8ptn989eid\";}', '', '::1', 1549016018, '1549020000', '0', 403);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (28, 'api/example/users', 'get', 'a:11:{s:9:\"X-API-KEY\";s:7:\"MyPulse\";s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Cache-Control\";s:9:\"max-age=0\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:6:\"Accept\";s:85:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:86:\"_ga=GA1.1.1675376399.1539338983; ciNav=no; ci_session=2b2a33dplli98eksrs4o1e8ptn989eid\";}', '', '::1', 1549016040, '1549020000', '0', 403);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (29, 'api/example/users', 'get', 'a:11:{s:9:\"X-API-KEY\";s:7:\"MyPulse\";s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Cache-Control\";s:9:\"max-age=0\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:6:\"Accept\";s:85:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:86:\"_ga=GA1.1.1675376399.1539338983; ciNav=no; ci_session=2b2a33dplli98eksrs4o1e8ptn989eid\";}', '', '::1', 1549016044, '1549020000', '0', 403);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (30, 'api/index/users', 'get', 'a:11:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:9:\"X-API-KEY\";s:6:\"123456\";s:13:\"Postman-Token\";s:36:\"899422f2-5709-caf3-b9f6-270d8a9d590b\";s:6:\"Accept\";s:3:\"*/*\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:43:\"ci_session=9l17dliborqpm4glis5bghth239atfik\";}', '123456', '::1', 1549016122, '1549020000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (31, 'api/index/users', 'get', 'a:11:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:9:\"X-API-KEY\";s:5:\"12345\";s:13:\"Postman-Token\";s:36:\"11d361b5-d385-25a4-a46b-f9ab0bd29fb4\";s:6:\"Accept\";s:3:\"*/*\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:43:\"ci_session=9l17dliborqpm4glis5bghth239atfik\";}', '', '::1', 1549016129, '1549020000', '0', 403);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (32, 'api/index/users', 'get', 'a:11:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:9:\"X-API-KEY\";s:12:\"MyPulse#@007\";s:13:\"Postman-Token\";s:36:\"c6922f10-4c2e-d03c-7eb8-4889ccca440e\";s:6:\"Accept\";s:3:\"*/*\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:43:\"ci_session=9l17dliborqpm4glis5bghth239atfik\";}', 'MyPulse#@007', '::1', 1549016140, '1549020000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (33, 'api/index/hospitals', 'get', 'a:11:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:9:\"X-API-KEY\";s:12:\"MyPulse#@007\";s:13:\"Postman-Token\";s:36:\"7c0fecb4-7f0b-4023-f41c-5f187348ebe9\";s:6:\"Accept\";s:3:\"*/*\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:43:\"ci_session=9l17dliborqpm4glis5bghth239atfik\";}', 'MyPulse#@007', '::1', 1549016203, '1549020000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (34, 'api/index/hospitals/1', 'get', 'a:13:{i:0;N;s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:22:\"Basic YWRtaW46MTIzNA==\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:9:\"X-API-KEY\";s:12:\"MyPulse#@007\";s:13:\"Postman-Token\";s:36:\"3ca32921-0924-3505-9959-d43aeaf264b2\";s:6:\"Accept\";s:3:\"*/*\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:43:\"ci_session=9l17dliborqpm4glis5bghth239atfik\";i:1;N;}', 'MyPulse#@007', '::1', 1549016220, '1549020000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (35, 'api/index/hospitals/1', 'get', 'a:13:{i:0;N;s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Authorization\";s:26:\"Basic TXlQdWxzZTpNeUAxMjM0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:9:\"X-API-KEY\";s:12:\"MyPulse#@007\";s:13:\"Postman-Token\";s:36:\"c8e1572d-50d7-d16f-fbd7-55755bb9753a\";s:6:\"Accept\";s:3:\"*/*\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:43:\"ci_session=oivgucr3hef6h4p107poonbq0qla15kt\";i:1;N;}', 'MyPulse#@007', '::1', 1549018072, '1549020000', '1', 200);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES (36, 'api/index/hospitals/1', 'get', 'a:13:{i:0;N;s:9:\"X-API-KEY\";s:6:\"123456\";s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:13:\"Cache-Control\";s:9:\"max-age=0\";s:13:\"Authorization\";s:26:\"Basic TXlQdWxzZTpNeUAxMjM0\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36\";s:6:\"Accept\";s:85:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:14:\"en-US,en;q=0.9\";s:6:\"Cookie\";s:43:\"ci_session=dvffj3uo6osa4vjdqvi4iqhu5gf9k55c\";i:1;N;}', '123456', '::1', 1549018256, '1549020000', '1', 200);


#
# TABLE STRUCTURE FOR: medicallabs
#

DROP TABLE IF EXISTS `medicallabs`;

CREATE TABLE `medicallabs` (
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `medicallabs` (`lab_id`, `unique_id`, `name`, `description`, `address`, `phone`, `owner_name`, `owner_mobile`, `hospital`, `branch`, `fname`, `lname`, `email`, `password`, `aadhar`, `gender`, `dob`, `in_address`, `profession`, `qualification`, `experience`, `in_mobile`, `country`, `state`, `district`, `city`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (1, 'MPL19_100001', 'Medical Lab1', 'Medical Lab1', 'Medical Lab1', '1231231230', 'Medical Lab1', '1231231230', 1, 2, '', '', 'l1@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 1, 2, 1, '2019-01-09 12:59:54', '2019-01-09 12:59:54', 1);
INSERT INTO `medicallabs` (`lab_id`, `unique_id`, `name`, `description`, `address`, `phone`, `owner_name`, `owner_mobile`, `hospital`, `branch`, `fname`, `lname`, `email`, `password`, `aadhar`, `gender`, `dob`, `in_address`, `profession`, `qualification`, `experience`, `in_mobile`, `country`, `state`, `district`, `city`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (2, 'MPL19_100002', 'Medical Lab2', 'Medical Lab2', 'Medical Lab2', '1231231222', 'Medical Lab2', '1231231222', 2, 1, '', '', 'l2@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 1, 2, 1, '2019-01-09 12:59:58', '2019-01-09 12:59:58', 1);


#
# TABLE STRUCTURE FOR: medicalstores
#

DROP TABLE IF EXISTS `medicalstores`;

CREATE TABLE `medicalstores` (
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `medicalstores` (`store_id`, `unique_id`, `name`, `description`, `address`, `phone`, `owner_name`, `owner_mobile`, `hospital`, `branch`, `fname`, `lname`, `email`, `password`, `aadhar`, `gender`, `dob`, `in_address`, `profession`, `qualification`, `experience`, `country`, `state`, `district`, `city`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (1, 'MPS19_100001', 'Medical Store1', 'Medical Store1', 'Medical Store1', '1231231238', 'Medical Store1', '1231231238', 1, 2, '', '', 's1@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '', '', '', '', '', '', '', 0, 0, 0, 0, 1, 2, 1, '2019-01-09 13:00:17', '2019-01-09 13:00:17', 1);
INSERT INTO `medicalstores` (`store_id`, `unique_id`, `name`, `description`, `address`, `phone`, `owner_name`, `owner_mobile`, `hospital`, `branch`, `fname`, `lname`, `email`, `password`, `aadhar`, `gender`, `dob`, `in_address`, `profession`, `qualification`, `experience`, `country`, `state`, `district`, `city`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (2, 'MPS19_100002', 'Medical Store2', 'Medical Store2', 'Medical Store2', '1231231239', 'Medical Store2', '1231231239', 2, 1, '', '', 's2@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '', '', '', '', '', '', '', 0, 0, 0, 0, 1, 2, 1, '2019-01-09 13:00:20', '2019-01-09 13:00:20', 1);


#
# TABLE STRUCTURE FOR: messages
#

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO `messages` (`message_id`, `created_by`, `group_ids`, `user_ids`, `hospital_id`, `title`, `message`, `is_read`, `created_at`) VALUES (1, 'superadmin-superadmin-1', NULL, 'doctors-doctor-1', 0, 'hoiiiiiiiii', 'hi how are you', 'doctors-doctor-1', '2019-01-20 22:31:54');
INSERT INTO `messages` (`message_id`, `created_by`, `group_ids`, `user_ids`, `hospital_id`, `title`, `message`, `is_read`, `created_at`) VALUES (2, 'superadmin-superadmin-1', NULL, 'doctors-doctor-1', 0, 'how are you', ' are you free', '', '2019-01-20 23:40:51');
INSERT INTO `messages` (`message_id`, `created_by`, `group_ids`, `user_ids`, `hospital_id`, `title`, `message`, `is_read`, `created_at`) VALUES (3, 'superadmin-superadmin-1', NULL, 'users-user-1', 0, 'hii', 'this is for testing', '', '2019-01-23 11:16:23');
INSERT INTO `messages` (`message_id`, `created_by`, `group_ids`, `user_ids`, `hospital_id`, `title`, `message`, `is_read`, `created_at`) VALUES (4, 'superadmin-superadmin-1', NULL, 'users-user-1', 0, 'testing2', 'testing2', '', '2019-01-23 11:30:55');
INSERT INTO `messages` (`message_id`, `created_by`, `group_ids`, `user_ids`, `hospital_id`, `title`, `message`, `is_read`, `created_at`) VALUES (5, 'superadmin-superadmin-1', NULL, 'users-user-1', 0, 'testing3', 'testing3', '', '2019-01-23 13:38:30');
INSERT INTO `messages` (`message_id`, `created_by`, `group_ids`, `user_ids`, `hospital_id`, `title`, `message`, `is_read`, `created_at`) VALUES (6, 'superadmin-superadmin-1', NULL, 'users-user-1', 0, 'pooo raaaaa', 'pooo veeeee', '', '2019-01-23 15:38:50');
INSERT INTO `messages` (`message_id`, `created_by`, `group_ids`, `user_ids`, `hospital_id`, `title`, `message`, `is_read`, `created_at`) VALUES (7, 'superadmin-superadmin-1', NULL, 'users-user-1', 0, 'hhhhhhhhhhhhhhhhhhhhh', 'gggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg', '', '2019-01-23 15:42:08');
INSERT INTO `messages` (`message_id`, `created_by`, `group_ids`, `user_ids`, `hospital_id`, `title`, `message`, `is_read`, `created_at`) VALUES (8, 'superadmin-superadmin-1', NULL, 'users-user-1', 0, 'vgvjhvjvjh', 'hjvjhbbjh', '', '2019-01-23 15:42:40');
INSERT INTO `messages` (`message_id`, `created_by`, `group_ids`, `user_ids`, `hospital_id`, `title`, `message`, `is_read`, `created_at`) VALUES (9, 'superadmin-superadmin-1', NULL, 'users-user-1', 0, 'pooooo veeeee', 'pooooo raaaaa', 'users-user-1', '2019-01-28 15:41:02');
INSERT INTO `messages` (`message_id`, `created_by`, `group_ids`, `user_ids`, `hospital_id`, `title`, `message`, `is_read`, `created_at`) VALUES (10, 'superadmin-superadmin-1', NULL, 'users-user-1', 0, 'pooooo veeeee', 'pooooo raaaaa', 'users-user-1', '2019-01-23 16:03:25');
INSERT INTO `messages` (`message_id`, `created_by`, `group_ids`, `user_ids`, `hospital_id`, `title`, `message`, `is_read`, `created_at`) VALUES (11, 'superadmin-superadmin-1', NULL, 'users-user-1', 0, 'what happining', 'jbfkjdfkjdnfjdfksbdjfkdkjfnd', 'superadmin-superadmin-1,users-user-1', '2019-01-23 20:52:14');


#
# TABLE STRUCTURE FOR: notification
#

DROP TABLE IF EXISTS `notification`;

CREATE TABLE `notification` (
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `notification` (`id`, `created_by`, `user_id`, `title`, `text`, `isRead`, `action`, `created_at`, `isDeleted`) VALUES (3, '', 'users-user-2', 'MPA19_100014 Appointment Canceled', 'Hi User Your Appointment No MPA19_100014 was Canceled for the Reason \" sdsdsd \" .', 2, NULL, '2019-02-01 18:22:28', 0);
INSERT INTO `notification` (`id`, `created_by`, `user_id`, `title`, `text`, `isRead`, `action`, `created_at`, `isDeleted`) VALUES (4, '', 'doctors-doctor-2', 'MPA19_100014 Appointment Canceled', 'Hi User Your Appointment No MPA19_100014 was Canceled for the Reason \" sdsdsd \" .', 2, NULL, '2019-02-01 18:22:28', 0);
INSERT INTO `notification` (`id`, `created_by`, `user_id`, `title`, `text`, `isRead`, `action`, `created_at`, `isDeleted`) VALUES (5, '', 'users-user-2', 'MPA19_100014 Appointment Canceled', 'Hi User Your Appointment No MPA19_100014 was Canceled for the Reason \" sdsdsd \" .', 2, NULL, '2019-02-01 18:22:34', 0);
INSERT INTO `notification` (`id`, `created_by`, `user_id`, `title`, `text`, `isRead`, `action`, `created_at`, `isDeleted`) VALUES (6, '', 'doctors-doctor-2', 'MPA19_100014 Appointment Canceled', 'Hi User Your Appointment No MPA19_100014 was Canceled for the Reason \" sdsdsd \" .', 2, NULL, '2019-02-01 18:22:34', 0);


#
# TABLE STRUCTURE FOR: nurse
#

DROP TABLE IF EXISTS `nurse`;

CREATE TABLE `nurse` (
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
  PRIMARY KEY (`nurse_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `nurse` (`nurse_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `address`, `hospital_id`, `branch_id`, `department_id`, `doctor_id`, `country`, `state`, `district`, `city`, `description`, `gender`, `dob`, `aadhar`, `qualification`, `experience`, `phone`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (1, 'MPN19_100001', 'Nurse1', '', 'Nurse1', 'n1@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '', 1, 2, 0, '1', 0, 0, 0, 0, 'Nurse For All Departments', '', '', '', '', '', '1231231237', 1, 2, 1, '2019-01-14 11:47:33', '2019-01-14 11:47:33', 1);


#
# TABLE STRUCTURE FOR: patient
#

DROP TABLE IF EXISTS `patient`;

CREATE TABLE `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hospital_ids` text NOT NULL,
  `doctor_ids` text NOT NULL,
  `lab_ids` text NOT NULL,
  `store_ids` text NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `patient` (`id`, `hospital_ids`, `doctor_ids`, `lab_ids`, `store_ids`, `user_id`) VALUES (1, '2,1', '2,1', '1', '1', 1);
INSERT INTO `patient` (`id`, `hospital_ids`, `doctor_ids`, `lab_ids`, `store_ids`, `user_id`) VALUES (2, '2,1', '2,1', '', '', 2);
INSERT INTO `patient` (`id`, `hospital_ids`, `doctor_ids`, `lab_ids`, `store_ids`, `user_id`) VALUES (3, '2,1', '2,1', '', '', 3);
INSERT INTO `patient` (`id`, `hospital_ids`, `doctor_ids`, `lab_ids`, `store_ids`, `user_id`) VALUES (4, '1', '1', '', '', 4);
INSERT INTO `patient` (`id`, `hospital_ids`, `doctor_ids`, `lab_ids`, `store_ids`, `user_id`) VALUES (5, '1', '1', '', '', 7);


#
# TABLE STRUCTURE FOR: prescription
#

DROP TABLE IF EXISTS `prescription`;

CREATE TABLE `prescription` (
  `prescription_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prescription_data` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` longtext COLLATE utf8_unicode_ci NOT NULL,
  `modified_at` longtext COLLATE utf8_unicode_ci NOT NULL,
  `medicin_status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `test_status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=show,2=hide',
  PRIMARY KEY (`prescription_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `prescription` (`prescription_id`, `doctor_id`, `user_id`, `prescription_data`, `created_at`, `modified_at`, `medicin_status`, `test_status`, `status`) VALUES (1, 1, 1, 'c43174af964aa81bcd77731f02886510f850ed1ef2d9c20577817e70da3ccef8fd38d8a9f19aa94e983b30ae0088a1d1ce3e0f4193e74083c63f756a21f566b0O0uw5SJZw8NcrI/gi2+jgXIw2fyfx+2RvH63wcb/vI0GaKXyBxkMzwbz0ZOYewMUaC9xvLgxnGU9V6HluO4K4MzOJkjY5XyufA4d4NCvESjW6I+aRYQLwvxacntDmqBb1fI5yjyONwtIMfVH6azi4MwiifLVmmZBnQAxQkCqM1ZbptRrwbYMzrPePm6LKItvXYfax6SqYOFy5mQLlW5GSeHdLNYQ1M/O1gwavpi1TGc=', '2019-01-25 22:01:20', '', 2, 1, 1);


#
# TABLE STRUCTURE FOR: prescription_order
#

DROP TABLE IF EXISTS `prescription_order`;

CREATE TABLE `prescription_order` (
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
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO `prescription_order` (`order_id`, `prescription_id`, `user_id`, `order_type`, `type_of_order`, `order_data`, `quantity`, `tests`, `store_id`, `lab_id`, `cost`, `price`, `total`, `receipt_created_at`, `created_at`, `status`) VALUES (1, 0, 1, 1, 1, '22b180b30d71337bdb022d32065dd6b95c01bfdae7f7af0b13f2c712fba40270251e0de89af80354f4f490e62c0b76ceaf6a250c8989d8fdd97329aaed53d37cyKz21zw9F0eM5qkihqwYmXtsPw0bvhUft0Q85JeJH4/+d7eI2wBT/wO98TJ22BGC', '', '', 0, 1, '', '500', '500.00', '2019-01-26 00:15:50', '2019-01-25 20:59:35', 1);
INSERT INTO `prescription_order` (`order_id`, `prescription_id`, `user_id`, `order_type`, `type_of_order`, `order_data`, `quantity`, `tests`, `store_id`, `lab_id`, `cost`, `price`, `total`, `receipt_created_at`, `created_at`, `status`) VALUES (2, 1, 1, 1, 0, '', '', '1,1', 0, 1, '', '2000,1000', '3000.00', '2019-01-27 21:51:10', '2019-01-27 21:49:58', 1);
INSERT INTO `prescription_order` (`order_id`, `prescription_id`, `user_id`, `order_type`, `type_of_order`, `order_data`, `quantity`, `tests`, `store_id`, `lab_id`, `cost`, `price`, `total`, `receipt_created_at`, `created_at`, `status`) VALUES (3, 0, 1, 1, 1, '1fbcc4b5cf64d5dd2dc218bfe2f0ace4be00d0ed266313f8590bb651d5382375e303396f9d1c1fc9d97294324ccca85d4040087e49a1c0129789656787aa46a5CA5ddoaaqXmNefHV+Wht86KxEWCINWguaPlQ6DKKFSDSfgdslc7YJZXwCp34R0jgUoE0QYwJJsuM94ru1FkAFg==', '', '', 0, 1, '', '500,200', '700.00', '2019-01-28 11:22:34', '2019-01-28 11:18:03', 1);
INSERT INTO `prescription_order` (`order_id`, `prescription_id`, `user_id`, `order_type`, `type_of_order`, `order_data`, `quantity`, `tests`, `store_id`, `lab_id`, `cost`, `price`, `total`, `receipt_created_at`, `created_at`, `status`) VALUES (4, 0, 1, 1, 1, 'fd676b015cb619d116b3e734ab945c2989d9e13c1390388437ca3de6247e28630d8ec3a95fb132b6f5f940284879ddbe3abbd6a1b2bacd52644493f9b4726dacx+RNutDArylv3trZgnu8FO8xctYfHfjgh55ohwGV4PyW4RCojyoB2AGAFrEDxV42rJDwta/94Mb+uavFJcDmdw==', '', '', 0, 1, '', '1000,2000', '3000.00', '2019-01-28 11:36:39', '2019-01-28 11:34:05', 1);
INSERT INTO `prescription_order` (`order_id`, `prescription_id`, `user_id`, `order_type`, `type_of_order`, `order_data`, `quantity`, `tests`, `store_id`, `lab_id`, `cost`, `price`, `total`, `receipt_created_at`, `created_at`, `status`) VALUES (5, 0, 1, 1, 1, '988a902260cf371c655c3cd2f8976d311b97c589ee1ec5a027ec2a3bfc52175e551abdf4a3d3cc74bb128b5884fda8606d92c69424e8e0357fc906642e272ed7jRAjmVjqNLgLry+uUCjvl+DnjY83/UEjUZgDdXksUBVREXrrd+viv1IoX/E+0qlT', '', '', 0, 1, '', '500', '500.00', '2019-01-28 11:46:24', '2019-01-28 11:39:18', 1);
INSERT INTO `prescription_order` (`order_id`, `prescription_id`, `user_id`, `order_type`, `type_of_order`, `order_data`, `quantity`, `tests`, `store_id`, `lab_id`, `cost`, `price`, `total`, `receipt_created_at`, `created_at`, `status`) VALUES (6, 0, 1, 1, 1, '9c5826cdd7befe2d7630d68b5bd837fa3796f12f26b5f988f548b9df6f01ba4b9bc7eb83a385d578e24efecd9e6f3d3a22053cf7cf0a06e0ef2fb26bf3daaf58RQe2KeEt0W16QhUtOkdJuSioMnw53ehvsAHbX4QSIQPmmwOfiC/P3klU5sbNucZd', '', '', 0, 1, '', '100', '100.00', '2019-01-28 11:54:13', '2019-01-28 11:49:58', 1);
INSERT INTO `prescription_order` (`order_id`, `prescription_id`, `user_id`, `order_type`, `type_of_order`, `order_data`, `quantity`, `tests`, `store_id`, `lab_id`, `cost`, `price`, `total`, `receipt_created_at`, `created_at`, `status`) VALUES (7, 0, 1, 1, 1, '60a3d4f7a2e539d457f2cb65d81aa44206167f8cc39b2a22593d58659ef7e0c1afe7a3aa64ae034f8e17894759e7fc3e4156ad84ec39589420d439484ce739c2+ZPjUHTHCoACGk8NrDf3A5x9FExG5C6vsigtuHEiHyjHaWfPblfxxhTgvF/v37Rd0WlC5p1OPJ4P+so45IrA4g==', '', '', 0, 1, '', '100,200', '300.00', '2019-01-28 11:55:53', '2019-01-28 11:55:28', 1);
INSERT INTO `prescription_order` (`order_id`, `prescription_id`, `user_id`, `order_type`, `type_of_order`, `order_data`, `quantity`, `tests`, `store_id`, `lab_id`, `cost`, `price`, `total`, `receipt_created_at`, `created_at`, `status`) VALUES (8, 0, 1, 0, 1, 'c08c008d116481c4899a585214cbff70e43ad2089f6e639985b2f184d4d61b55b236b5502d5bb638f4faa6c06a67c7105efbf2cd2764e7b5e4dec2cac5d47a1doXOIXC7UcPBC5CrmVbA/MlOC5oIjffgEnCnH1f8ocy1FO0TusfCEc68VW7kr8uVgjA5OZO+Y9FMWNs7n03C7UCPMISy0nTVFNjGD38Sx6jI=', '', '', 1, 0, '', '', '', '', '2019-01-28 18:03:03', 2);


#
# TABLE STRUCTURE FOR: prognosis
#

DROP TABLE IF EXISTS `prognosis`;

CREATE TABLE `prognosis` (
  `prognosis_id` int(11) NOT NULL AUTO_INCREMENT,
  `prognosis_data` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `created_at` longtext NOT NULL,
  `modified_at` longtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=show,2=hide',
  PRIMARY KEY (`prognosis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: receptionist
#

DROP TABLE IF EXISTS `receptionist`;

CREATE TABLE `receptionist` (
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
  PRIMARY KEY (`receptionist_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `receptionist` (`receptionist_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `address`, `hospital_id`, `branch_id`, `department_id`, `doctor_id`, `country`, `state`, `district`, `city`, `description`, `gender`, `dob`, `aadhar`, `qualification`, `experience`, `phone`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (1, 'MPR19_100001', 'Receptionist1', '', 'Receptionist1', 'r1@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '', 1, 2, 0, '1', 0, 0, 0, 0, 'Receptionist For all Departments', '', '', '', '', '', '1231231236', 1, 2, 1, '2019-01-30 16:41:18', '2019-01-30 16:41:18', 1);


#
# TABLE STRUCTURE FOR: reports
#

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO `reports` (`report_id`, `order_id`, `order_type`, `title`, `created_by`, `user_id`, `extension`, `created_at`, `status`) VALUES (1, 1, 0, '', '', 0, 'pdf', '2019-01-26 00:15:50', 1);
INSERT INTO `reports` (`report_id`, `order_id`, `order_type`, `title`, `created_by`, `user_id`, `extension`, `created_at`, `status`) VALUES (2, 2, 0, '', '', 0, 'pdf', '2019-01-27 21:51:10', 1);
INSERT INTO `reports` (`report_id`, `order_id`, `order_type`, `title`, `created_by`, `user_id`, `extension`, `created_at`, `status`) VALUES (3, 2, 0, '', '', 0, 'jpeg', '2019-01-27 21:51:10', 1);
INSERT INTO `reports` (`report_id`, `order_id`, `order_type`, `title`, `created_by`, `user_id`, `extension`, `created_at`, `status`) VALUES (4, 3, 0, '', '', 0, 'pdf', '2019-01-28 11:22:34', 1);
INSERT INTO `reports` (`report_id`, `order_id`, `order_type`, `title`, `created_by`, `user_id`, `extension`, `created_at`, `status`) VALUES (5, 3, 0, '', '', 0, 'jpg', '2019-01-28 11:22:34', 1);
INSERT INTO `reports` (`report_id`, `order_id`, `order_type`, `title`, `created_by`, `user_id`, `extension`, `created_at`, `status`) VALUES (6, 4, 0, '', '', 0, 'pdf', '2019-01-28 11:36:39', 1);
INSERT INTO `reports` (`report_id`, `order_id`, `order_type`, `title`, `created_by`, `user_id`, `extension`, `created_at`, `status`) VALUES (7, 4, 0, '', '', 0, 'jpeg', '2019-01-28 11:36:39', 1);
INSERT INTO `reports` (`report_id`, `order_id`, `order_type`, `title`, `created_by`, `user_id`, `extension`, `created_at`, `status`) VALUES (8, 5, 0, '', '', 0, 'jpeg', '2019-01-28 11:46:24', 1);
INSERT INTO `reports` (`report_id`, `order_id`, `order_type`, `title`, `created_by`, `user_id`, `extension`, `created_at`, `status`) VALUES (9, 6, 0, '', '', 0, 'jpg', '2019-01-28 11:54:13', 1);
INSERT INTO `reports` (`report_id`, `order_id`, `order_type`, `title`, `created_by`, `user_id`, `extension`, `created_at`, `status`) VALUES (10, 7, 0, '', '', 0, 'pdf', '2019-01-28 11:55:53', 1);
INSERT INTO `reports` (`report_id`, `order_id`, `order_type`, `title`, `created_by`, `user_id`, `extension`, `created_at`, `status`) VALUES (11, 7, 0, '', '', 0, 'jpg', '2019-01-28 11:55:53', 1);


#
# TABLE STRUCTURE FOR: settings
#

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (1, 'system_name', 'MyPulses');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (2, 'system_title', 'MyPulse');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (3, 'address', 'India');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (4, 'phone', '77556555656');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (5, 'paypal_email', '');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (6, 'currency', '');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (7, 'system_email', 'mypulsecare@gmail.com');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (8, 'email_password', 'MyPulse@123');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (9, 'purchase_code', '[ your-purchase-code-here ]');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (11, 'language', '');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (12, 'text_align', '');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (13, 'system_currency_id', '1');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (14, 'sms_username', 'mypulsecare@gmail.com');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (15, 'sms_sender', 'TXTLCL');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (16, 'sms_hash', 'Hp1qPEPiNj0-Q9HXoTR77OZ12cqTlOcohqW928oJzA');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (17, 'GST', '');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (19, 'privacy', '<p style=\"text-align:center\"><span style=\"color:#008080\"><span style=\"font-size:16px\"><strong>Capgemini believes that the establishment of trust and privacy is instrumental to the continued growth of the Internet. &nbsp;We also believe that the efficient collection, use and transfer of information serve to enhance the development of the Internet and electronic commerce, provided that such information is handled in a fair and responsible manner.</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><span style=\"color:#008080\"><strong>Introduction</strong></span></h2>\r\n\r\n<p>Data protection is a key concern for Capgemini which has been placing this matter as a priority for long. Hence, transparency regarding the way we process the personal data we collect is a commitment for us. The information provided below intends to provide you all relevant information in relation to the collection and processing of information which may be collected through this website&nbsp;<a href=\"http://www.capgemini.com/\">www.capgemini.com</a>, (hereinafter, &ldquo;the website&rdquo;)</p>\r\n\r\n<p>Capgemini Services SAS (hereinafter, &ldquo;we&rdquo;, &ldquo;us&rdquo;, &ldquo;our&rdquo; or &ldquo;Capgemini&rdquo;) may collect and process personal data relating to you when you visit this website.</p>\r\n\r\n<h2><span style=\"color:#008080\"><span style=\"font-size:16px\"><strong>Processing of Your Personal Data</strong></span></span></h2>\r\n\r\n<p>Generally, you can visit our website without providing any personal data about yourself. However, in order to access some parts of our websites and/or for you to request specific information or services, we may need to collect personal data from you which we will process for the purposes described hereunder.</p>\r\n\r\n<p>As part of pre-contractual and/or contractual obligations, we may process your personal data for:</p>\r\n\r\n<ul>\r\n	<li>answering any requests, queries or inquires you may submit on our website; but also</li>\r\n	<li>enabling you log on certain restricted parts of our website;</li>\r\n	<li>managing your participation to online context</li>\r\n</ul>\r\n\r\n<p>We may also use the personal data you share with us, for:</p>\r\n\r\n<ul>\r\n	<li>maintaining and improving the website as well as to ensuring its security;</li>\r\n	<li>conducting customer satisfaction surveys;</li>\r\n	<li>manage the forums to which you may take part;</li>\r\n	<li>recruitment purposes related when you submit a resume or a job application online; and</li>\r\n	<li>compiling aggregate statistics regarding the use of the website.</li>\r\n</ul>\r\n');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (20, 'terms', '<p style=\"text-align: center;\"><span style=\"color:#008080\"><span style=\"font-size:22px\"><u><strong>Terms of Use​</strong></u></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>1) <span style=\"color:#008080\"><strong>Acceptance</strong></span></h3>\r\n\r\n<p>By accessing and browsing the Capgemini (the &ldquo;Company&rdquo;) website or by using and/or downloading any content from same, you agree and accept the Terms of Use as set forth below.</p>\r\n\r\n<h3>2) <span style=\"color:#008080\"><strong>Purpose of the website</strong></span></h3>\r\n\r\n<p>All the materials contained in the Company&rsquo;s website are provided for informational purposes only and shall not be construed as a commercial offer, a license, an advisory, fiduciary or professional relationship between you and the Company. No information provided on this site shall be considered a substitute for your independent investigation.</p>\r\n\r\n<p>The information provided on this website may be related to products or services that are not available in your country.</p>\r\n\r\n<h3>3) <span style=\"color:#008080\"><strong>Links to Third-Party Websites</strong></span></h3>\r\n\r\n<p>Links to third-party websites are provided for convenience only and do not imply any approval or endorsement by the Company of the linked sites, even if they may contain the Company&rsquo;s logo, as such sites are beyond the Company&rsquo;s control. Thus, the Company cannot be held responsible for the content of any linked site or any link contained therein.</p>\r\n\r\n<p>You acknowledge that framing the Company&rsquo;s website or any similar process is prohibited.</p>\r\n\r\n<h3>4) <span style=\"color:#008080\"><strong>Intellectual Property</strong></span></h3>\r\n\r\n<p>This website is protected by intellectual property rights and is the exclusive property of the Company. Any material that it contains, including, but not limited to, texts, data, graphics, pictures, sounds, videos, logos, icons or html code is protected under intellectual property law and remains the Company or third party&rsquo;s property.</p>\r\n\r\n<p>You may use this material for personal and non-commercial purposes in accordance with the principles governing intellectual property law. Any other use or modification of the content of the Company&rsquo;s website without the Company&rsquo;s prior written authorization is prohibited.</p>\r\n\r\n<p>Registered Trademarks:</p>\r\n\r\n<ul>\r\n	<li>Rightshore&reg; is a trademark belonging to Capgemini</li>\r\n	<li>Collaborative Business Experience&trade; is a trademark belonging to Capgemini</li>\r\n</ul>\r\n\r\n<h3>5) <span style=\"color:#008080\"><strong>Warranty and Liability</strong></span></h3>\r\n\r\n<p>All materials, including downloadable software, contained in the Company&rsquo;s website is provided &laquo;as is&raquo; and without warranty of any kind to the extent allowed by the applicable law; While the Company will use reasonable efforts to provide reliable information through its website, the Company does not warrant that this website is free of inaccuracies, errors and/or omissions, viruses, worms, Trojan horses and the like, or that its content is appropriate for your particular use or up to date, and the Company reserves the right to change the information at any time without notice. The Company does not warrant any results derived from the use of any software available on this site. You are solely responsible for any use of the materials contained in this site.</p>\r\n\r\n<p>The information contained in this site does not extend or modify the warranty that may apply to you as a result of a contractual relationship with the Company.</p>\r\n\r\n<p>The Company will not be liable for any indirect, consequential or incidental damages, including but not limited to lost profits or revenues, business interruption, loss of data arising out of or in connection with the use, inability to use or reliance on any material contained in this site or any linked site.</p>\r\n\r\n<p>In any event, the liability of the Company for direct damages arising out of or in connection with the use, inability to use or reliance on any material contained in this site or any linked site shall not exceed the amount of Euros 1,000</p>\r\n\r\n<h3>6) <span style=\"color:#008080\"><strong>Online Privacy Policy &ndash; Use of Cookies</strong></span></h3>\r\n\r\n<p>Please check our&nbsp;<a href=\"https://www.capgemini.com/privacy-policy\">Online Privacy Policy</a></p>\r\n\r\n<h3>7) <span style=\"color:#008080\"><strong>Users&rsquo; Comments</strong></span></h3>\r\n\r\n<p>The Company does not assume any obligation to monitor the information that you may post on its website.</p>\r\n\r\n<p>You warrant that any information, Materials (the term &ldquo;Material&rdquo; is intended to cover all projects, files or other attachments sent to us) or comments other than personal data, that you may transmit to the Company through the website does not infringe intellectual property rights or any other applicable law. Such information, Materials or comments, will be treated as non-confidential and non proprietary. By submitting any information or material, you give the Company an unlimited and irrevocable license to use, execute, show, modify and transmit such information, Material or comments, including any underlying idea, concept or know-how (the term &ldquo;Material&rdquo; is intended to cover all projects, files or other attachments sent to us). The Company reserves the right to use such information in any way it chooses.</p>\r\n\r\n<h3>8) <span style=\"color:#008080\"><strong>Applicable law &ndash; Severability</strong></span></h3>\r\n\r\n<p>Any controversy or claim arising out of or related to the Terms of Use shall be governed by French law. The Commercial Court of Paris will have exclusive jurisdiction.</p>\r\n\r\n<p>If any provision of these Terms of Use is held by a court to be illegal, invalid or unenforceable, the remaining provisions shall remain in full force and effect.</p>\r\n\r\n<h3>9) <span style=\"color:#008080\"><strong>Modifications of the Terms of Use</strong></span></h3>\r\n\r\n<p>The Company reserves the right to change the Terms of Use under which this website is offered at any time and without notice. You will be automatically bound by these modifications when you use this site, and should periodically read the Terms of Use.</p>\r\n');


#
# TABLE STRUCTURE FOR: specializations
#

DROP TABLE IF EXISTS `specializations`;

CREATE TABLE `specializations` (
  `specializations_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`specializations_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `specializations` (`specializations_id`, `name`) VALUES (1, 'Allergist');
INSERT INTO `specializations` (`specializations_id`, `name`) VALUES (2, 'Cardiologist');
INSERT INTO `specializations` (`specializations_id`, `name`) VALUES (3, 'Dermatologist');
INSERT INTO `specializations` (`specializations_id`, `name`) VALUES (4, 'Neurologist');
INSERT INTO `specializations` (`specializations_id`, `name`) VALUES (5, 'Neurosurgeon');
INSERT INTO `specializations` (`specializations_id`, `name`) VALUES (6, 'Gynecologist');


#
# TABLE STRUCTURE FOR: state
#

DROP TABLE IF EXISTS `state`;

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (1, 1, 'Andaman & Nicobar Islands');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (2, 1, 'Andhra Pradesh');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (3, 1, 'Arunachal Pradesh');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (4, 1, 'Assam');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (5, 1, 'Bihar');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (6, 1, 'Chandigarh');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (7, 1, 'Chhattisgarh');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (8, 1, 'Dadra & Nagar Haveli');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (9, 1, 'Daman & Diu');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (10, 1, 'Delhi');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (11, 1, 'Goa');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (12, 1, 'Gujarat');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (13, 1, 'Haryana');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (14, 1, 'Himachal Pradesh');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (15, 1, 'Jammu & Kashmir');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (16, 1, 'Jharkhand');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (17, 1, 'Karnataka');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (18, 1, 'Kerala');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (19, 1, 'Lakshadweep');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (20, 1, 'Madhya Pradesh');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (21, 1, 'Maharashtra');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (22, 1, 'Manipur');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (23, 1, 'Meghalaya');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (24, 1, 'Mizoram');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (25, 1, 'Nagaland');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (26, 1, 'Odisha');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (27, 1, 'Puducherry');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (28, 1, 'Punjab');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (29, 1, 'Rajasthan');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (30, 1, 'Sikkim');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (31, 1, 'Tamil Nadu');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (32, 1, 'Telangana');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (33, 1, 'Tripura');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (34, 1, 'Uttar Pradesh');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (35, 1, 'Uttarakhand');
INSERT INTO `state` (`state_id`, `country_id`, `name`) VALUES (36, 1, 'West Bengal');


#
# TABLE STRUCTURE FOR: superadmin
#

DROP TABLE IF EXISTS `superadmin`;

CREATE TABLE `superadmin` (
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `superadmin` (`superadmin_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `phone`, `description`, `address`, `gender`, `dob`, `country`, `state`, `district`, `city`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (1, 'MPSA18_100001', 'Super', '', 'Admin', 'sa@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '8121815444', '', '', '', '', 0, 0, 0, 0, 1, 1, 1, '2019-01-26 12:26:58', '2019-01-26 12:26:58', 1);


#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (1, 'MPU19_100001', 'Mypulse User 1', 'Mypulse User 1', 'Mypulse User 1', 'u1@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'Mypulse User 1', 1, 2, 1, 1, '', '8100815502', 'male', '01/31/2000', 18, '', 'A+', '', 0, '', '5.6', '59', '120', '100', 'mahi', 'no', 'not', 'not', 1, 2, 1, 1, '2019-01-27 21:49:07', '2019-01-27 21:49:07', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (2, 'MPU19_100002', 'Mypulse User 2', 'Mypulse User 2', 'Mypulse User 2', 'u2@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'Mypulse User 2', 1, 2, 1, 2, 'Mypulse User 2', '7777777771', 'female', '12/30/1998', 20, '', 'A-', '', 0, '', '5.6', '59', '120', '100', 'mahi', 'no', 'Nothing', 'not', 1, 1, 1, 1, '2019-01-27 21:48:18', '2019-01-27 21:48:18', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (3, 'MPU19_100003', 'Mypulse User 3', 'Mypulse User 3', 'Mypulse User 3', 'u3@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'Mypulse User 3', 1, 2, 1, 1, 'Mypulse User 3', '7777777772', '', '06/02/1999', 19, '', 'B+', '', 0, '', '5.5', '69', '120', '100', 'mahi', 'no', 'not', 'not', 1, 1, 1, 1, '2019-01-27 21:48:21', '2019-01-27 21:48:21', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (4, 'MPU19_100004', 'Mypulse User 4', 'Mypulse User 4', 'Mypulse User 4', 'u4@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'Mypulse User 4', 1, 32, 2, 4, 'Mypulse User 4', '7777777773', 'male', '12/26/1988', 30, '', 'B-', '', 0, '', '5.6', '69', '120', '100', 'mahi', '1222', 'not', 'not', 1, 1, 2, 1, '2019-01-09 13:01:36', '2019-01-09 13:01:36', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (5, 'MPU19_100005', 'mahi', '', '', 'maheshbt9@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', 0, 0, 0, 0, '', '8247344444', '', '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 1, 2, 1, 1, '2019-01-26 12:52:24', '2019-01-26 12:52:24', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (6, 'MPU19_100006', 'mahi', '', '', 'mahi@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', 0, 0, 0, 0, '', '8244361446', '', '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 1, 2, 1, 1, '2019-01-28 18:10:32', '2019-01-28 18:10:32', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (7, 'MPU19_100007', 'mahi', '', 'mahesh', 'maheshbt8@gmail.com', '601f1889667efaebb33b8c12572835da3f027f78', '', 0, 0, 0, 0, '', '8244361446', '', '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 1, 2, 1, 1, '2019-02-01 18:00:19', '2019-02-01 18:00:19', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (8, 'MPU19_100008', 'a', '', '', 'a@g.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', 0, 0, 0, 0, '', '7777777777', '', '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 1, 2, 1, 1, '2019-02-01 17:06:34', '2019-02-01 17:06:34', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (9, 'MPU19_100009', 'a', '', '', 'a2@g.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', 0, 0, 0, 0, '', '9999999999', '', '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 1, 2, 1, 1, '2019-02-01 17:09:54', '2019-02-01 17:09:54', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (10, 'MPU19_100010', 'b', '', '', 'b1@g.com', '601f1889667efaebb33b8c12572835da3f027f78', '', 0, 0, 0, 0, '', '8888888888', '', '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 1, 2, 1, 1, '2019-02-01 17:12:15', '2019-02-01 17:12:15', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (11, 'MPU19_100011', 'b', '', '', 'b2@g.com', '601f1889667efaebb33b8c12572835da3f027f78', '', 0, 0, 0, 0, '', '5555555555', '', '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 1, 2, 1, 1, '2019-02-01 17:14:42', '2019-02-01 17:14:42', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (12, 'MPU19_100012', 'c1', '', '', 'c1@g.com', '601f1889667efaebb33b8c12572835da3f027f78', '', 0, 0, 0, 0, '', '6666666666', '', '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 1, 2, 1, 1, '2019-02-01 17:25:30', '2019-02-01 17:25:30', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (13, 'MPU19_100013', 'ma', '', '', 'ma@g.com', '601f1889667efaebb33b8c12572835da3f027f78', '', 0, 0, 0, 0, '', '4444444444', '', '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 1, 2, 1, 1, '2019-02-01 17:25:35', '2019-02-01 17:25:35', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (14, 'MPU19_100014', 'aaaaaaa', '', '', 'aa@g.com', '601f1889667efaebb33b8c12572835da3f027f78', '', 0, 0, 0, 0, '', '2222222222', '', '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 1, 2, 1, 1, '2019-02-01 17:25:41', '2019-02-01 17:25:41', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (15, 'MPU19_100015', 'a', '', '', 'a1@g.com', '601f1889667efaebb33b8c12572835da3f027f78', '', 0, 0, 0, 0, '', '3333333333', '', '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 1, 2, 1, 1, '2019-02-01 17:25:46', '2019-02-01 17:25:46', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (16, 'MPU19_100016', 'b', '', '', 'b23@g.com', '601f1889667efaebb33b8c12572835da3f027f78', '', 0, 0, 0, 0, '', '1111111111', '', '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 1, 2, 1, 1, '2019-02-01 17:25:51', '2019-02-01 17:25:51', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (17, 'MPU19_100017', 'cccccccccc', '', '', 'ccccccccc@g.com', '601f1889667efaebb33b8c12572835da3f027f78', '', 0, 0, 0, 0, '', '2222221111', '', '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 1, 2, 1, 1, '2019-02-01 17:26:47', '2019-02-01 17:26:47', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (18, 'MPU19_100018', 'a', '', '', 'maheshbt22@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', 0, 0, 0, 0, '', '8247361446', '', '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 1, 2, 1, 1, '2019-02-01 20:15:47', '2019-02-01 20:15:47', 1);


#
# TABLE STRUCTURE FOR: ward
#

DROP TABLE IF EXISTS `ward`;

CREATE TABLE `ward` (
  `ward_id` int(11) NOT NULL AUTO_INCREMENT,
  `hospital_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active,2=inactive',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=not-deleted,2=deleted',
  PRIMARY KEY (`ward_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `ward` (`ward_id`, `hospital_id`, `branch_id`, `department_id`, `name`, `description`, `status`, `isDeleted`) VALUES (1, 1, 2, 2, 'Ward1', '', 1, 1);


