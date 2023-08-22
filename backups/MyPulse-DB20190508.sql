#
# TABLE STRUCTURE FOR: appointment_history
#

DROP TABLE IF EXISTS `appointment_history`;

CREATE TABLE `appointment_history` (
  `appointment_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) NOT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time_start` time DEFAULT NULL,
  `appointment_time_end` time DEFAULT NULL,
  `action` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=created,2=pending,3=confirmed,4=updated,5=rescheduled,6=cancelled,7=closed',
  `reason` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`appointment_history_id`),
  KEY `fk_aphapid` (`appointment_id`),
  CONSTRAINT `fk_aphapid` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`appointment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `action`, `reason`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 1, '2019-05-02', '21:00:00', '21:30:00', 1, '', 'MPU19_100001', '2019-05-01 13:09:44', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `action`, `reason`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 2, '2019-05-03', '10:00:00', '10:30:00', 1, '', 'MPSA18_100001', '2019-05-02 22:57:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `action`, `reason`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (3, 3, '2019-05-05', '20:30:00', '21:00:00', 1, '', 'MPSA18_100001', '2019-05-05 19:47:06', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `action`, `reason`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (4, 3, '2019-05-06', '06:30:00', '07:00:00', 5, '', 'MPSA18_100001', '2019-05-05 19:47:23', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `action`, `reason`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (5, 2, NULL, NULL, NULL, 7, '', 'MyPulse', '2019-05-08 07:54:48', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `action`, `reason`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (6, 3, NULL, NULL, NULL, 7, '', 'MyPulse', '2019-05-08 07:54:48', NULL, '0000-00-00 00:00:00', 1);


#
# TABLE STRUCTURE FOR: appointments
#

DROP TABLE IF EXISTS `appointments`;

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_number` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time_start` time DEFAULT NULL,
  `appointment_time_end` time DEFAULT NULL,
  `appointment_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=pending,2=confirmed,3=cancelled,4=closed',
  `reason` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remarks` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `next_appointment` date DEFAULT NULL,
  `attended_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=not-attended,1=attended',
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`appointment_id`),
  UNIQUE KEY `unique_id` (`appointment_number`),
  KEY `fk_appuserid` (`user_id`),
  KEY `fk_appdoctid` (`doctor_id`),
  KEY `fk_apphospid` (`hospital_id`),
  KEY `fk_appdeptid` (`department_id`),
  CONSTRAINT `fk_appdeptid` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`),
  CONSTRAINT `fk_appdoctid` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`),
  CONSTRAINT `fk_apphospid` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`),
  CONSTRAINT `fk_appuserid` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `appointment_status`, `reason`, `remarks`, `next_appointment`, `attended_status`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 'MPA19_100001', 3, 1, 1, 1, '2019-05-02', '21:00:00', '21:30:00', 4, 'New Appointment 1', '', NULL, 0, 'MPU19_100001', '2019-05-01 13:09:44', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `appointment_status`, `reason`, `remarks`, `next_appointment`, `attended_status`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 'MPA19_100002', 3, 1, 1, 1, '2019-05-03', '10:00:00', '10:30:00', 4, 'Normal', '', NULL, 0, 'MPSA18_100001', '2019-05-02 22:57:26', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `appointment_status`, `reason`, `remarks`, `next_appointment`, `attended_status`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (3, 'MPA19_100003', 3, 1, 1, 1, '2019-05-06', '06:30:00', '07:00:00', 4, 'Normal', '', NULL, 0, 'MPSA18_100001', '2019-05-05 19:47:05', 'MPSA18_100001', '2019-05-05 19:47:23', 1);


#
# TABLE STRUCTURE FOR: availability
#

DROP TABLE IF EXISTS `availability`;

CREATE TABLE `availability` (
  `availability_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `no_appt_handle` tinyint(3) NOT NULL,
  `message` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `availablity_status` tinyint(4) NOT NULL COMMENT '1=available,2=not-available',
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`availability_id`),
  KEY `fk_avdoctid` (`doctor_id`),
  CONSTRAINT `fk_avdoctid` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `availability` (`availability_id`, `doctor_id`, `no_appt_handle`, `message`, `availablity_status`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 1, 30, 'Available 24/7', 0, 'MPD19_100001', '2019-05-01 08:54:43', NULL, '0000-00-00 00:00:00', 1);


#
# TABLE STRUCTURE FOR: availability_slot
#

DROP TABLE IF EXISTS `availability_slot`;

CREATE TABLE `availability_slot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `repeat_interval` tinyint(4) NOT NULL COMMENT '0=weekly,1=custom',
  `repeat_on` tinyint(4) NOT NULL COMMENT '0=S,1=M,2=T,3=W,4=T,5=F,6=S',
  `unik` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`id`),
  KEY `fk_avsdoctid` (`doctor_id`),
  CONSTRAINT `fk_avsdoctid` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=307 DEFAULT CHARSET=utf8;

INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-01', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-02', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (3, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-03', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (4, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-04', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (5, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-05', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (6, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-06', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (7, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-07', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (8, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-08', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (9, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-09', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (10, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-10', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (11, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-11', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (12, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-12', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (13, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-13', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (14, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-14', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (15, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-15', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (16, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-16', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (17, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-17', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (18, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-18', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (19, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-19', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (20, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-20', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (21, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-21', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (22, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-22', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (23, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-23', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (24, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-24', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (25, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-25', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (26, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-26', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (27, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-27', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (28, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-28', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (29, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-29', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (30, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-30', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (31, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-05-31', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (32, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-01', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (33, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-02', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (34, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-03', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (35, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-04', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (36, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-05', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (37, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-06', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (38, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-07', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (39, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-08', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (40, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-09', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (41, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-10', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (42, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-11', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (43, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-12', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (44, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-13', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (45, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-14', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (46, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-15', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (47, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-16', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (48, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-17', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (49, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-18', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (50, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-19', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (51, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-20', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (52, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-21', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (53, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-22', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (54, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-23', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (55, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-24', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (56, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-25', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (57, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-26', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (58, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-27', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (59, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-28', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (60, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-29', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (61, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-06-30', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (62, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-01', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (63, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-02', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (64, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-03', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (65, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-04', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (66, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-05', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (67, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-06', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (68, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-07', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (69, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-08', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (70, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-09', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (71, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-10', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (72, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-11', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (73, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-12', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (74, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-13', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (75, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-14', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (76, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-15', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (77, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-16', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (78, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-17', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (79, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-18', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (80, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-19', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (81, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-20', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (82, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-21', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (83, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-22', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (84, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-23', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (85, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-24', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (86, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-25', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (87, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-26', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (88, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-27', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (89, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-28', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (90, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-29', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (91, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-30', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (92, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-07-31', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (93, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-01', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (94, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-02', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (95, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-03', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (96, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-04', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (97, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-05', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (98, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-06', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (99, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-07', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (100, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-08', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (101, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-09', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (102, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-10', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (103, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-11', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (104, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-12', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (105, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-13', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (106, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-14', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (107, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-15', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (108, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-16', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (109, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-17', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (110, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-18', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (111, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-19', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (112, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-20', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (113, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-21', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (114, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-22', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (115, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-23', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (116, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-24', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (117, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-25', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (118, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-26', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (119, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-27', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (120, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-28', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (121, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-29', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (122, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-30', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (123, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-08-31', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (124, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-01', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (125, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-02', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (126, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-03', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (127, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-04', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (128, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-05', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (129, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-06', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (130, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-07', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (131, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-08', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (132, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-09', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (133, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-10', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (134, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-11', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (135, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-12', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (136, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-13', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (137, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-14', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (138, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-15', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (139, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-16', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (140, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-17', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (141, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-18', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (142, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-19', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (143, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-20', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (144, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-21', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (145, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-22', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (146, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-23', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (147, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-24', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (148, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-25', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (149, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-26', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (150, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-27', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (151, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-28', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (152, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-29', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (153, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-09-30', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (154, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-01', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (155, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-02', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (156, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-03', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (157, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-04', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (158, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-05', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (159, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-06', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (160, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-07', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (161, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-08', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (162, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-09', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (163, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-10', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (164, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-11', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (165, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-12', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (166, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-13', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (167, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-14', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (168, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-15', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (169, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-16', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (170, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-17', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (171, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-18', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (172, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-19', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (173, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-20', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (174, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-21', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (175, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-22', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (176, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-23', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (177, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-24', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (178, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-25', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (179, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-26', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (180, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-27', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (181, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-28', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (182, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-29', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (183, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-30', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (184, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-10-31', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (185, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-01', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (186, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-02', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (187, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-03', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (188, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-04', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (189, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-05', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (190, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-06', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (191, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-07', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (192, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-08', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (193, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-09', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (194, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-10', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (195, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-11', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (196, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-12', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (197, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-13', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (198, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-14', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (199, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-15', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (200, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-16', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (201, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-17', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (202, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-18', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (203, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-19', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (204, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-20', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (205, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-21', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (206, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-22', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (207, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-23', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (208, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-24', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (209, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-25', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (210, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-26', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (211, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-27', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (212, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-28', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (213, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-29', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (214, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-11-30', 'MPD19_100001', '2019-05-01 08:55:27', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (215, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-01', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (216, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-02', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (217, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-03', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (218, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-04', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (219, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-05', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (220, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-06', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (221, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-07', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (222, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-08', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (223, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-09', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (224, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-10', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (225, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-11', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (226, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-12', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (227, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-13', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (228, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-14', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (229, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-15', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (230, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-16', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (231, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-17', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (232, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-18', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (233, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-19', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (234, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-20', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (235, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-21', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (236, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-22', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (237, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-23', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (238, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-24', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (239, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-25', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (240, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-26', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (241, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-27', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (242, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-28', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (243, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-29', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (244, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-30', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (245, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2019-12-31', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (246, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-01', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (247, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-02', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (248, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-03', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (249, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-04', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (250, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-05', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (251, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-06', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (252, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-07', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (253, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-08', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (254, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-09', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (255, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-10', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (256, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-11', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (257, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-12', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (258, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-13', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (259, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-14', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (260, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-15', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (261, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-16', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (262, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-17', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (263, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-18', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (264, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-19', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (265, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-20', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (266, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-21', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (267, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-22', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (268, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-23', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (269, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-24', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (270, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-25', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (271, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-26', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (272, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-27', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (273, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-28', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (274, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-29', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (275, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-30', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (276, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-01-31', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (277, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-01', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (278, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-02', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (279, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-03', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (280, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-04', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (281, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-05', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (282, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-06', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (283, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-07', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (284, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-08', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (285, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-09', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (286, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-10', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (287, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-11', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (288, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-12', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (289, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-13', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (290, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-14', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (291, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-15', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (292, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-16', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (293, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-17', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (294, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-18', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (295, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-19', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (296, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-20', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (297, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-21', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (298, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-22', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (299, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-23', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (300, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-24', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (301, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-25', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (302, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-26', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (303, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-27', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (304, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-28', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (305, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-02-29', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (306, 1, '2019-05-01', '2020-03-01', '06:00:00', '23:00:00', 0, 0, '119', '2020-03-01', 'MPD19_100001', '2019-05-01 08:55:28', NULL, '0000-00-00 00:00:00', 1);


#
# TABLE STRUCTURE FOR: bed
#

DROP TABLE IF EXISTS `bed`;

CREATE TABLE `bed` (
  `bed_id` int(11) NOT NULL AUTO_INCREMENT,
  `bed_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `bed_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=available,2=not-available',
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`bed_id`),
  KEY `fk_bedwardid` (`ward_id`),
  KEY `fk_bedbranchid` (`branch_id`),
  KEY `fk_bedhosspid` (`hospital_id`),
  KEY `fk_beddeptid` (`department_id`),
  CONSTRAINT `fk_bedbranchid` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`),
  CONSTRAINT `fk_beddeptid` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`),
  CONSTRAINT `fk_bedhosspid` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`),
  CONSTRAINT `fk_bedwardid` FOREIGN KEY (`ward_id`) REFERENCES `ward` (`ward_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `bed` (`bed_id`, `bed_name`, `hospital_id`, `branch_id`, `department_id`, `ward_id`, `bed_status`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 'Bed1', 1, 1, 1, 1, 2, 'MPSA18_100001', '2019-04-30 21:32:30', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `bed` (`bed_id`, `bed_name`, `hospital_id`, `branch_id`, `department_id`, `ward_id`, `bed_status`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 'Bed1', 2, 2, 2, 2, 1, 'MPSA18_100001', '2019-05-01 09:39:44', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `bed` (`bed_id`, `bed_name`, `hospital_id`, `branch_id`, `department_id`, `ward_id`, `bed_status`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (3, 'Bed1', 3, 3, 3, 3, 2, 'MPSA18_100001', '2019-05-01 09:41:07', NULL, '0000-00-00 00:00:00', 1);


#
# TABLE STRUCTURE FOR: branch
#

DROP TABLE IF EXISTS `branch`;

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `hospital_id` int(11) NOT NULL,
  `branch_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`branch_id`),
  KEY `fk_branchhospid` (`hospital_id`),
  KEY `fk_br_city` (`city_id`),
  KEY `fk_br_dist` (`district_id`),
  KEY `fk_br_state` (`state_id`),
  KEY `fk_br_ctry` (`country_id`),
  CONSTRAINT `fk_br_city` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`),
  CONSTRAINT `fk_br_ctry` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`),
  CONSTRAINT `fk_br_dist` FOREIGN KEY (`district_id`) REFERENCES `district` (`district_id`),
  CONSTRAINT `fk_br_state` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`),
  CONSTRAINT `fk_branchhospid` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `branch` (`branch_id`, `hospital_id`, `branch_name`, `phone`, `email`, `address`, `city_id`, `district_id`, `state_id`, `country_id`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 1, 'Branch1', '1230056489', 'B1@G.COM', '12/456', 1, 1, 1, 1, 'MPSA18_100001', '2019-04-30 21:31:51', NULL, '2019-04-30 21:31:51', 1);
INSERT INTO `branch` (`branch_id`, `hospital_id`, `branch_name`, `phone`, `email`, `address`, `city_id`, `district_id`, `state_id`, `country_id`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 2, 'Branch1', '10203336665', 'b1@g.com', '021', 1, 1, 1, 1, 'MPSA18_100001', '2019-05-01 09:39:08', NULL, '2019-05-01 09:39:08', 1);
INSERT INTO `branch` (`branch_id`, `hospital_id`, `branch_name`, `phone`, `email`, `address`, `city_id`, `district_id`, `state_id`, `country_id`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (3, 3, 'Branch1', '1023333333', 'b1@g.com', 'as', 1, 1, 1, 1, 'MPSA18_100001', '2019-05-01 09:40:31', NULL, '2019-05-01 09:40:31', 1);
INSERT INTO `branch` (`branch_id`, `hospital_id`, `branch_name`, `phone`, `email`, `address`, `city_id`, `district_id`, `state_id`, `country_id`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (6, 1, 'vivekananda schools', '121212121212', 'maheshbt8@gmail.com', '1-76 main road devanakonda', 1, 1, 1, 1, 'MPSA18_100001', '2019-05-02 23:57:08', NULL, '2019-05-02 23:57:08', 1);


#
# TABLE STRUCTURE FOR: ci_sessions
#

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  `created_by` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES ('9e25n8sjmt5phinipjkutf2qol3i7f7i', '::1', 1557282492, '__ci_last_regenerate|i:1557282492;last_page|s:83:\"http://localhost/mypulse/Appointments?sd=0NaN-NaN-NaN&ed=0NaN-NaN-NaN&status_id=all\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:10:\"Rajasekhar\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";login|s:1:\"1\";', '', '2019-05-08 07:52:43', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES ('ieqmm1b9p80rsm02ja25bspn1pd2llt7', '::1', 1557282709, '__ci_last_regenerate|i:1557282492;last_page|s:83:\"http://localhost/mypulse/Appointments?sd=0NaN-NaN-NaN&ed=0NaN-NaN-NaN&status_id=all\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:10:\"Rajasekhar\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";login|s:1:\"1\";', '', '2019-05-08 07:58:13', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES ('mn8espl32bvkpv06525vhm6d9rn0qoq3', '::1', 1557209509, 'site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}', '', '2019-05-07 10:22:40', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES ('v2k4fiajirb8jhm9sd6nvosl0ipgprco', '::1', 1557282163, '__ci_last_regenerate|i:1557282163;last_page|s:38:\"http://localhost/mypulse/MyPulse_Users\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}', '', '2019-05-08 07:40:11', NULL, '0000-00-00 00:00:00', 1);


#
# TABLE STRUCTURE FOR: city
#

DROP TABLE IF EXISTS `city`;

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`city_id`),
  KEY `fk_cityctrid` (`country_id`),
  KEY `fk_citydistid` (`district_id`),
  KEY `fk_citystid` (`state_id`),
  CONSTRAINT `fk_cityctrid` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`),
  CONSTRAINT `fk_citydistid` FOREIGN KEY (`district_id`) REFERENCES `district` (`district_id`),
  CONSTRAINT `fk_citystid` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `city` (`city_id`, `city_name`, `country_id`, `state_id`, `district_id`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 'Kadapa', 1, 1, 1, 'MPSA18_100001', '2019-04-30 21:17:56', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `city` (`city_id`, `city_name`, `country_id`, `state_id`, `district_id`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 'USA - C', 2, 2, 2, 'MPSA18_100001', '2019-05-05 19:42:24', NULL, '0000-00-00 00:00:00', 1);


#
# TABLE STRUCTURE FOR: country
#

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `country` (`country_id`, `country_name`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 'India', 'MPSA18_100001', '2019-04-30 21:16:39', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `country` (`country_id`, `country_name`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 'USA', 'MPSA18_100001', '2019-05-05 19:41:01', NULL, '0000-00-00 00:00:00', 1);


#
# TABLE STRUCTURE FOR: dbupdate_log
#

DROP TABLE IF EXISTS `dbupdate_log`;

CREATE TABLE `dbupdate_log` (
  `message` text COLLATE utf8_unicode_ci,
  `update_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `dbupdate_log` (`message`, `update_ts`) VALUES ('Database created on', '2019-04-30 21:11:07');


#
# TABLE STRUCTURE FOR: department
#

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `description` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`department_id`),
  KEY `fk_deptbranchid` (`branch_id`),
  KEY `fk_depthospid` (`hospital_id`),
  CONSTRAINT `fk_deptbranchid` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`),
  CONSTRAINT `fk_depthospid` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `department` (`department_id`, `dept_name`, `hospital_id`, `branch_id`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 'D1', 1, 1, 'ADD', 'MPSA18_100001', '2019-04-30 21:32:08', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `department` (`department_id`, `dept_name`, `hospital_id`, `branch_id`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 'D1', 2, 2, 'ADD', 'MPSA18_100001', '2019-05-01 09:39:20', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `department` (`department_id`, `dept_name`, `hospital_id`, `branch_id`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (3, 'D1', 3, 3, 'ADD', 'MPSA18_100001', '2019-05-01 09:40:45', NULL, '0000-00-00 00:00:00', 1);


#
# TABLE STRUCTURE FOR: district
#

DROP TABLE IF EXISTS `district`;

CREATE TABLE `district` (
  `district_id` int(11) NOT NULL AUTO_INCREMENT,
  `dist_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`district_id`),
  KEY `fk_distctrid` (`country_id`),
  KEY `fk_diststid` (`state_id`),
  CONSTRAINT `fk_distctrid` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`),
  CONSTRAINT `fk_diststid` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `district` (`district_id`, `dist_name`, `country_id`, `state_id`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 'Kadapa', 1, 1, 'MPSA18_100001', '2019-04-30 21:17:37', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `district` (`district_id`, `dist_name`, `country_id`, `state_id`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 'USA - D', 2, 2, 'MPSA18_100001', '2019-05-05 19:41:44', NULL, '0000-00-00 00:00:00', 1);


#
# TABLE STRUCTURE FOR: doctors
#

DROP TABLE IF EXISTS `doctors`;

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'M-Male F-Female T-Transgender',
  `dob` date DEFAULT NULL,
  `aadhar` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `qualification` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `specializations` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `experience` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `registration` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `email_verify` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `mobile_verify` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`doctor_id`),
  UNIQUE KEY `uk_email` (`email`),
  UNIQUE KEY `uk_phone` (`phone`),
  UNIQUE KEY `uk_unique_id` (`unique_id`) USING BTREE,
  KEY `fk_docbranchid` (`branch_id`),
  KEY `fk_dochospid` (`hospital_id`),
  KEY `fk_docdeptid` (`department_id`),
  KEY `fk_doc_city` (`city_id`),
  KEY `fk_doc_dist` (`district_id`),
  KEY `fk_doc_state` (`state_id`),
  KEY `fk_doc_ctry` (`country_id`),
  CONSTRAINT `fk_doc_city` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`),
  CONSTRAINT `fk_doc_ctry` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`),
  CONSTRAINT `fk_doc_dist` FOREIGN KEY (`district_id`) REFERENCES `district` (`district_id`),
  CONSTRAINT `fk_doc_state` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`),
  CONSTRAINT `fk_docbranchid` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`),
  CONSTRAINT `fk_docdeptid` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`),
  CONSTRAINT `fk_dochospid` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO `doctors` (`doctor_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `address`, `phone`, `description`, `gender`, `dob`, `aadhar`, `qualification`, `specializations`, `experience`, `registration`, `hospital_id`, `branch_id`, `department_id`, `country_id`, `state_id`, `district_id`, `city_id`, `email_verify`, `mobile_verify`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 'MPD19_100001', 'Doctor1', '', '', 'd1@g.com', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', '12/789', '1230056987', '', 'M', '1991-05-01', '', 'ABCDEF', '', '5 Years', '1200036', 1, 1, 1, 1, 1, 1, 1, 1, 1, 'MPSA18_100001', '2019-05-01 08:53:19', NULL, '2019-05-01 08:53:19', 1);
INSERT INTO `doctors` (`doctor_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `address`, `phone`, `description`, `gender`, `dob`, `aadhar`, `qualification`, `specializations`, `experience`, `registration`, `hospital_id`, `branch_id`, `department_id`, `country_id`, `state_id`, `district_id`, `city_id`, `email_verify`, `mobile_verify`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (5, 'MPD19_100002', 'Doctor 1', 'Doctor 1', 'Doctor 1', 'hd1@g.com', NULL, '', '7766666222', 'Doctor 1', '', NULL, '', '', '', '', '', 1, 1, 1, NULL, NULL, NULL, NULL, 2, 2, 'MPSA18_100001', '2019-05-02 07:23:16', NULL, '2019-05-02 07:23:16', 1);
INSERT INTO `doctors` (`doctor_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `address`, `phone`, `description`, `gender`, `dob`, `aadhar`, `qualification`, `specializations`, `experience`, `registration`, `hospital_id`, `branch_id`, `department_id`, `country_id`, `state_id`, `district_id`, `city_id`, `email_verify`, `mobile_verify`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (7, 'MPD19_100003', 'Doctor 2', 'Doctor 2', 'Doctor 2', 'hd2@g.com', NULL, '', '8855888888', 'Doctor 2', '', NULL, '', '', '', '', '', 1, 1, 1, NULL, NULL, NULL, NULL, 2, 2, 'MPSA18_100001', '2019-05-02 22:37:10', 'MPSA18_100001', '2019-05-02 22:37:10', 1);


#
# TABLE STRUCTURE FOR: feedback
#

DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `feedback` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `feedback` (`id`, `customer_id`, `feedback`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 'MPHA19_100001', 'hiiii', 'MPSA18_100001', '2019-05-05 19:39:48', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `feedback` (`id`, `customer_id`, `feedback`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 'MPHA19_100002', 'hiiihiiihiii', 'MPSA18_100001', '2019-05-05 19:45:19', NULL, '0000-00-00 00:00:00', 1);


#
# TABLE STRUCTURE FOR: health_insurance_provider
#

DROP TABLE IF EXISTS `health_insurance_provider`;

CREATE TABLE `health_insurance_provider` (
  `health_insurance_provider_id` int(11) NOT NULL AUTO_INCREMENT,
  `health_ins_prov_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`health_insurance_provider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: hospitaladmins
#

DROP TABLE IF EXISTS `hospitaladmins`;

CREATE TABLE `hospitaladmins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `mname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `aadhar` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(1) COLLATE utf8_unicode_ci NOT NULL COMMENT 'M-Male F-Female T-Transgender',
  `dob` date DEFAULT NULL,
  `qualification` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `profession` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `experience` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email_verify` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `mobile_verify` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `created_by` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `uk_unique_id` (`unique_id`) USING BTREE,
  UNIQUE KEY `uk_email` (`email`),
  UNIQUE KEY `uk_phone` (`phone`),
  KEY `fk_hosa_city` (`city_id`),
  KEY `fk_hosa_dist` (`district_id`),
  KEY `fk_hosa_state` (`state_id`),
  KEY `fk_hosa_ctry` (`country_id`),
  CONSTRAINT `fk_hosa_city` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`),
  CONSTRAINT `fk_hosa_ctry` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`),
  CONSTRAINT `fk_hosa_dist` FOREIGN KEY (`district_id`) REFERENCES `district` (`district_id`),
  CONSTRAINT `fk_hosa_state` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `hospitaladmins` (`admin_id`, `unique_id`, `hospital_id`, `name`, `mname`, `lname`, `email`, `password`, `phone`, `address`, `country_id`, `state_id`, `district_id`, `city_id`, `aadhar`, `gender`, `dob`, `qualification`, `profession`, `experience`, `description`, `email_verify`, `mobile_verify`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 'MPHA19_100001', 1, 'HA1', '', '', 'ha1@g.com', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', '1234567888', '12/456', 1, 1, 1, 1, '', 'M', '1992-04-02', 'ABCDEF', 'LGD', '5 Years', '', 1, 1, 'MPSA18_100001', '2019-04-30 21:29:34', NULL, '2019-04-30 21:29:34', 1);
INSERT INTO `hospitaladmins` (`admin_id`, `unique_id`, `hospital_id`, `name`, `mname`, `lname`, `email`, `password`, `phone`, `address`, `country_id`, `state_id`, `district_id`, `city_id`, `aadhar`, `gender`, `dob`, `qualification`, `profession`, `experience`, `description`, `email_verify`, `mobile_verify`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 'MPHA19_100002', 2, 'HA2', '', '', 'ha2@g.com', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', '1020365478', '12/4569', 1, 1, 1, 1, '', 'F', '1991-04-10', 'KASS', 'LASD', '5 Years', '', 1, 1, 'MPSA18_100001', '2019-04-30 21:30:58', 'MPSA18_100001', '2019-05-01 09:41:21', 1);
INSERT INTO `hospitaladmins` (`admin_id`, `unique_id`, `hospital_id`, `name`, `mname`, `lname`, `email`, `password`, `phone`, `address`, `country_id`, `state_id`, `district_id`, `city_id`, `aadhar`, `gender`, `dob`, `qualification`, `profession`, `experience`, `description`, `email_verify`, `mobile_verify`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (12, 'MPHA19_100003', 6, 'Hospital Admin1', 'Hospital Admin1', 'Hospital Admin1', 'hadmin1@g.com', NULL, '7755666666', '', NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', 'Hospital Admin1', 2, 2, 'MPSA18_100001', '2019-05-02 07:18:52', 'MPSA18_100001', '2019-05-02 22:35:34', 1);


#
# TABLE STRUCTURE FOR: hospitals
#

DROP TABLE IF EXISTS `hospitals`;

CREATE TABLE `hospitals` (
  `hospital_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `license_category` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `md_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `md_contact_number` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `license` int(11) NOT NULL,
  `license_status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=active,2=inactive',
  `from_date` date DEFAULT NULL,
  `till_date` date DEFAULT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`hospital_id`),
  UNIQUE KEY `unique_id` (`unique_id`),
  KEY `fk_hosp_city` (`city_id`),
  KEY `fk_hosp_dist` (`district_id`),
  KEY `fk_hosp_state` (`state_id`),
  KEY `fk_hosp_ctry` (`country_id`),
  CONSTRAINT `fk_hosp_city` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`),
  CONSTRAINT `fk_hosp_ctry` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`),
  CONSTRAINT `fk_hosp_dist` FOREIGN KEY (`district_id`) REFERENCES `district` (`district_id`),
  CONSTRAINT `fk_hosp_state` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `hospitals` (`hospital_id`, `unique_id`, `name`, `address`, `description`, `phone_number`, `email`, `license_category`, `city_id`, `district_id`, `state_id`, `country_id`, `md_name`, `md_contact_number`, `license`, `license_status`, `from_date`, `till_date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 'MPH19_100001', 'H1', '12/456', 'asd', '1234567891', 'h1@g.com', NULL, 1, 1, 1, 1, 'lasd', '1234567891', 1, 2, '2019-04-30', '2020-05-25', 'MPSA18_100001', '2019-04-30 21:23:56', 'MPSA18_100001', '2019-04-30 21:24:47', 1);
INSERT INTO `hospitals` (`hospital_id`, `unique_id`, `name`, `address`, `description`, `phone_number`, `email`, `license_category`, `city_id`, `district_id`, `state_id`, `country_id`, `md_name`, `md_contact_number`, `license`, `license_status`, `from_date`, `till_date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 'MPH19_100002', 'H2', '12/789', 'LASD', '0101205999', 'h2@g.com', NULL, 1, 1, 1, 1, 'LASS', '0120666666', 1, 2, '2019-05-02', '2020-06-18', 'MPSA18_100001', '2019-05-01 09:36:04', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `hospitals` (`hospital_id`, `unique_id`, `name`, `address`, `description`, `phone_number`, `email`, `license_category`, `city_id`, `district_id`, `state_id`, `country_id`, `md_name`, `md_contact_number`, `license`, `license_status`, `from_date`, `till_date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (3, 'MPH19_100003', 'H3', '12/888', 'AKS', '1010255555', 'h3@g.com', NULL, 1, 1, 1, 1, 'LADq', '0202555565', 1, 2, '2019-05-05', '2020-07-31', 'MPSA18_100001', '2019-05-01 09:36:56', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `hospitals` (`hospital_id`, `unique_id`, `name`, `address`, `description`, `phone_number`, `email`, `license_category`, `city_id`, `district_id`, `state_id`, `country_id`, `md_name`, `md_contact_number`, `license`, `license_status`, `from_date`, `till_date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (4, 'MPH19_100004', 'H4', '12', 'LDD', '1023333369', 'h4@g.com', NULL, 1, 1, 1, 1, 'KALS', '0101222569', 1, 2, '2019-05-10', '2020-08-26', 'MPSA18_100001', '2019-05-01 09:37:48', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `hospitals` (`hospital_id`, `unique_id`, `name`, `address`, `description`, `phone_number`, `email`, `license_category`, `city_id`, `district_id`, `state_id`, `country_id`, `md_name`, `md_contact_number`, `license`, `license_status`, `from_date`, `till_date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (5, 'MPH19_100005', 'H5', '212/789', 'LASqAKS', '2020366669', 'h5@g.com', NULL, 1, 1, 1, 1, 'MASS', '0101222225', 1, 2, '2019-05-02', '2020-06-11', 'MPSA18_100001', '2019-05-01 09:38:35', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `hospitals` (`hospital_id`, `unique_id`, `name`, `address`, `description`, `phone_number`, `email`, `license_category`, `city_id`, `district_id`, `state_id`, `country_id`, `md_name`, `md_contact_number`, `license`, `license_status`, `from_date`, `till_date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (6, 'MPH19_100006', 'Hospital1', 'HYDERABAD', 'HYDERABAD', '7788445555', 'hospital1@g.com', NULL, 1, 1, 1, 1, 'Hospital ', '7788445555', 1, 2, '2019-05-03', '2020-05-03', 'MPSA18_100001', '2019-05-02 07:02:17', 'MPSA18_100001', '2019-05-02 23:41:40', 1);


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
  `join_date` datetime DEFAULT NULL,
  `discharged_date` datetime DEFAULT NULL,
  `reason` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `inpatient_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0- recommended, 1- admitted, 2-discharged',
  `show_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=show,2=hide',
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`id`),
  KEY `fk_inpuserid` (`user_id`),
  KEY `fk_inpdoctid` (`doctor_id`),
  KEY `fk_inphospid` (`hospital_id`),
  KEY `fk_inpbedid` (`bed_id`),
  CONSTRAINT `fk_inpbedid` FOREIGN KEY (`bed_id`) REFERENCES `bed` (`bed_id`),
  CONSTRAINT `fk_inpdoctid` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`),
  CONSTRAINT `fk_inphospid` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`),
  CONSTRAINT `fk_inpuserid` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `inpatient` (`id`, `user_id`, `bed_id`, `hospital_id`, `doctor_id`, `join_date`, `discharged_date`, `reason`, `inpatient_status`, `show_status`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 3, 1, 1, 1, '2019-05-01 13:34:31', NULL, 'New Reason 1', 1, 1, 'MPSA18_100001', '2019-05-01 13:34:31', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `inpatient` (`id`, `user_id`, `bed_id`, `hospital_id`, `doctor_id`, `join_date`, `discharged_date`, `reason`, `inpatient_status`, `show_status`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 8, 3, 3, 1, '2019-05-02 22:59:43', NULL, 'Normal', 1, 1, 'MPSA18_100001', '2019-05-02 22:59:43', NULL, '0000-00-00 00:00:00', 1);


#
# TABLE STRUCTURE FOR: inpatient_history
#

DROP TABLE IF EXISTS `inpatient_history`;

CREATE TABLE `inpatient_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `in_patient_id` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`id`),
  KEY `fk_inpinpid` (`in_patient_id`),
  CONSTRAINT `fk_inpinpid` FOREIGN KEY (`in_patient_id`) REFERENCES `inpatient` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `inpatient_history` (`id`, `in_patient_id`, `created_date`, `note`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 1, NULL, 'Joined As In-Patient and Status as Admitted.', 'MPSA18_100001', '2019-05-01 13:34:31', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `inpatient_history` (`id`, `in_patient_id`, `created_date`, `note`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 2, NULL, 'Joined As In-Patient and Status as Admitted.', 'MPSA18_100001', '2019-05-02 22:59:43', NULL, '0000-00-00 00:00:00', 1);


#
# TABLE STRUCTURE FOR: keys
#

DROP TABLE IF EXISTS `keys`;

CREATE TABLE `keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES (1, 0, 'MyPulse@007', 0, 0, 0, NULL, 0);


#
# TABLE STRUCTURE FOR: language
#

DROP TABLE IF EXISTS `language`;

CREATE TABLE `language` (
  `language_id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: leave_message
#

DROP TABLE IF EXISTS `leave_message`;

CREATE TABLE `leave_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: license
#

DROP TABLE IF EXISTS `license`;

CREATE TABLE `license` (
  `license_id` int(11) NOT NULL AUTO_INCREMENT,
  `license_category_id` int(11) NOT NULL,
  `license_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `license_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`license_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `license` (`license_id`, `license_category_id`, `license_code`, `license_name`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 2, 'HA', 'HA', 'Adding License', 'MPSA18_100001', '2019-04-30 21:18:37', NULL, '0000-00-00 00:00:00', 1);


#
# TABLE STRUCTURE FOR: license_category
#

DROP TABLE IF EXISTS `license_category`;

CREATE TABLE `license_category` (
  `license_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `license_category_code` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lic_category_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`license_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `license_category` (`license_category_id`, `license_category_code`, `lic_category_name`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 'MPCL_19001', 'Clinic', 'Clinic', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `license_category` (`license_category_id`, `license_category_code`, `lic_category_name`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 'MPHL_19002', 'Hospital', 'Hospital', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `license_category` (`license_category_id`, `license_category_code`, `lic_category_name`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (3, 'MPMS_19003', 'Medical Stores', 'Medical Store', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `license_category` (`license_category_id`, `license_category_code`, `lic_category_name`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (4, 'MPML_19004', 'Medical Lab ', 'Medical Lab ', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `license_category` (`license_category_id`, `license_category_code`, `lic_category_name`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (5, 'MPBB_19005', 'Blood Bank', 'Blood Bank', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);


#
# TABLE STRUCTURE FOR: login_details
#

DROP TABLE IF EXISTS `login_details`;

CREATE TABLE `login_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `login_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_unique_id` (`unique_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO `login_details` (`id`, `unique_id`, `login_at`, `logout_at`) VALUES (1, 'MPSA18_100001', '2019-05-08 07:52:43', '2019-05-07 07:31:16');
INSERT INTO `login_details` (`id`, `unique_id`, `login_at`, `logout_at`) VALUES (2, 'MPD19_100001', '2019-05-07 07:31:22', '2019-05-07 07:35:06');
INSERT INTO `login_details` (`id`, `unique_id`, `login_at`, `logout_at`) VALUES (3, 'MPR19_100001', '2019-05-07 07:36:04', '2019-05-07 07:36:10');
INSERT INTO `login_details` (`id`, `unique_id`, `login_at`, `logout_at`) VALUES (4, 'MPN19_100001', '2019-05-07 07:35:15', '2019-05-07 07:35:57');
INSERT INTO `login_details` (`id`, `unique_id`, `login_at`, `logout_at`) VALUES (5, 'MPS19_100001', '2019-05-07 07:42:37', '2019-05-07 07:43:47');
INSERT INTO `login_details` (`id`, `unique_id`, `login_at`, `logout_at`) VALUES (6, 'MPL19_100001', '2019-05-07 07:43:55', '2019-05-01 08:59:55');
INSERT INTO `login_details` (`id`, `unique_id`, `login_at`, `logout_at`) VALUES (7, 'MPHA19_100001', '2019-05-01 09:00:13', '2019-05-01 09:00:22');
INSERT INTO `login_details` (`id`, `unique_id`, `login_at`, `logout_at`) VALUES (8, 'MPHA19_100002', '2019-05-01 09:00:28', '2019-05-01 09:00:37');
INSERT INTO `login_details` (`id`, `unique_id`, `login_at`, `logout_at`) VALUES (9, 'MPU19_100001', '2019-05-07 07:36:20', '2019-05-02 23:41:22');


#
# TABLE STRUCTURE FOR: medicallabs
#

DROP TABLE IF EXISTS `medicallabs`;

CREATE TABLE `medicallabs` (
  `lab_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `owner_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `owner_mobile` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `fname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `aadhar` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `in_address` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `profession` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `qualification` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `experience` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `in_mobile` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `email_verify` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `mobile_verify` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`lab_id`),
  UNIQUE KEY `uk_email` (`email`),
  UNIQUE KEY `uk_phone` (`phone`),
  UNIQUE KEY `uk_unique_id` (`unique_id`) USING BTREE,
  KEY `fk_ml_branch` (`branch_id`),
  KEY `fk_ml_hospi` (`hospital_id`),
  KEY `fk_ml_city` (`city_id`),
  KEY `fk_ml_dist` (`district_id`),
  KEY `fk_ml_state` (`state_id`),
  KEY `fk_ml_ctry` (`country_id`),
  CONSTRAINT `fk_ml_branch` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`),
  CONSTRAINT `fk_ml_city` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`),
  CONSTRAINT `fk_ml_ctry` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`),
  CONSTRAINT `fk_ml_dist` FOREIGN KEY (`district_id`) REFERENCES `district` (`district_id`),
  CONSTRAINT `fk_ml_hospi` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`),
  CONSTRAINT `fk_ml_state` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `medicallabs` (`lab_id`, `unique_id`, `name`, `description`, `address`, `phone`, `owner_name`, `owner_mobile`, `hospital_id`, `branch_id`, `fname`, `lname`, `email`, `password`, `aadhar`, `gender`, `dob`, `in_address`, `profession`, `qualification`, `experience`, `in_mobile`, `country_id`, `state_id`, `district_id`, `city_id`, `email_verify`, `mobile_verify`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 'MPL19_100001', 'ML1', 'add', '12/5555', '0000001478', 'MAN', '1020366558', 1, 1, 'MASS', 'LASS', 'ml1@g.com', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', '', 'F', '1959-05-01', '12', '', 'ABCDEF', '8 Years', '1020555555', 1, 1, 1, 1, 1, 1, '', '2019-05-01 08:50:00', 'MPSA18_100001', '2019-05-01 08:50:16', 1);
INSERT INTO `medicallabs` (`lab_id`, `unique_id`, `name`, `description`, `address`, `phone`, `owner_name`, `owner_mobile`, `hospital_id`, `branch_id`, `fname`, `lname`, `email`, `password`, `aadhar`, `gender`, `dob`, `in_address`, `profession`, `qualification`, `experience`, `in_mobile`, `country_id`, `state_id`, `district_id`, `city_id`, `email_verify`, `mobile_verify`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 'MPL19_100002', 'Medical Lab2', 'Medical Lab2', '', '8877774555', 'Medical Lab2', '8877774555', 1, 1, '', '', 'ml2@g.com', NULL, '', '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, 2, 2, '', '2019-05-02 22:52:31', NULL, '2019-05-02 22:52:31', 1);


#
# TABLE STRUCTURE FOR: medicalstores
#

DROP TABLE IF EXISTS `medicalstores`;

CREATE TABLE `medicalstores` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `owner_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `owner_mobile` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `fname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `aadhar` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `in_address` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `profession` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `qualification` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `experience` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `email_verify` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `mobile_verify` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`store_id`),
  UNIQUE KEY `uk_unique_id` (`unique_id`) USING BTREE,
  UNIQUE KEY `uk_email` (`email`),
  UNIQUE KEY `uk_phone` (`phone`),
  KEY `fk_ms_branch` (`branch_id`),
  KEY `fk_ms_hospi` (`hospital_id`),
  KEY `fk_ms_city` (`city_id`),
  KEY `fk_ms_dist` (`district_id`),
  KEY `fk_ms_state` (`state_id`),
  KEY `fk_ms_ctry` (`country_id`),
  CONSTRAINT `fk_ms_branch` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`),
  CONSTRAINT `fk_ms_city` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`),
  CONSTRAINT `fk_ms_ctry` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`),
  CONSTRAINT `fk_ms_dist` FOREIGN KEY (`district_id`) REFERENCES `district` (`district_id`),
  CONSTRAINT `fk_ms_hospi` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`),
  CONSTRAINT `fk_ms_state` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `medicalstores` (`store_id`, `unique_id`, `name`, `description`, `address`, `phone`, `owner_name`, `owner_mobile`, `hospital_id`, `branch_id`, `fname`, `lname`, `email`, `password`, `aadhar`, `gender`, `dob`, `in_address`, `profession`, `qualification`, `experience`, `country_id`, `state_id`, `district_id`, `city_id`, `email_verify`, `mobile_verify`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 'MPS19_100001', 'MS1', 'ADD', 'mm,m,', '1023366666', 'MASS', '0000000001', 1, 1, 'NASS', 'MASS', 'ms1@g.com', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', '', 'F', '2019-05-01', '202000', '', 'ABCDEF', '5 Years', 1, 1, 1, 1, 1, 1, 'MPSA18_100001', '2019-05-01 08:48:38', NULL, '2019-05-01 08:48:38', 1);
INSERT INTO `medicalstores` (`store_id`, `unique_id`, `name`, `description`, `address`, `phone`, `owner_name`, `owner_mobile`, `hospital_id`, `branch_id`, `fname`, `lname`, `email`, `password`, `aadhar`, `gender`, `dob`, `in_address`, `profession`, `qualification`, `experience`, `country_id`, `state_id`, `district_id`, `city_id`, `email_verify`, `mobile_verify`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 'MPS19_100002', 'Medical Store2', 'Medical Store2', 'Medical Store2', '8877777777', 'Medical Store2', '8877777777', 1, 1, '', '', 'ms2@g.com', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', '', '', NULL, '', '', '', '', NULL, NULL, NULL, NULL, 1, 2, 'MPSA18_100001', '2019-05-02 22:51:41', NULL, '2019-05-02 22:51:41', 1);


#
# TABLE STRUCTURE FOR: messages
#

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_ids` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_ids` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `hospital_id` int(11) NOT NULL,
  `title` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_read` longtext NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: notification
#

DROP TABLE IF EXISTS `notification`;

CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `notification_text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `isRead` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `action` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO `notification` (`id`, `user_id`, `title`, `notification_text`, `isRead`, `action`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 'MPD19_100001', 'Welcome To MyPulse', 'MyPulse Heartly Welcoming You <b>Mr/Mrs Doctor1</b>', 2, NULL, '', '2019-05-01 08:54:27', NULL, '2019-05-01 08:54:27', 1);
INSERT INTO `notification` (`id`, `user_id`, `title`, `notification_text`, `isRead`, `action`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (3, 'MPR19_100001', 'Welcome To MyPulse', 'MyPulse Heartly Welcoming You <b>Mr/Mrs Receptionist1</b>', 2, NULL, '', '2019-05-01 08:58:43', NULL, '2019-05-01 08:58:43', 1);
INSERT INTO `notification` (`id`, `user_id`, `title`, `notification_text`, `isRead`, `action`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (4, 'MPN19_100001', 'Welcome To MyPulse', 'MyPulse Heartly Welcoming You <b>Mr/Mrs Nurse1</b>', 2, NULL, '', '2019-05-01 08:59:00', NULL, '2019-05-01 08:59:00', 1);
INSERT INTO `notification` (`id`, `user_id`, `title`, `notification_text`, `isRead`, `action`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (5, 'MPS19_100001', 'Welcome To MyPulse', 'MyPulse Heartly Welcoming You <b>Mr/Mrs MS1</b>', 2, NULL, '', '2019-05-01 08:59:24', NULL, '2019-05-01 08:59:24', 1);
INSERT INTO `notification` (`id`, `user_id`, `title`, `notification_text`, `isRead`, `action`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (6, 'MPL19_100001', 'Welcome To MyPulse', 'MyPulse Heartly Welcoming You <b>Mr/Mrs ML1</b>', 2, NULL, '', '2019-05-01 08:59:46', NULL, '2019-05-01 08:59:46', 1);
INSERT INTO `notification` (`id`, `user_id`, `title`, `notification_text`, `isRead`, `action`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (7, 'MPHA19_100001', 'Welcome To MyPulse', 'MyPulse Heartly Welcoming You <b>Mr/Mrs HA1</b>', 2, NULL, '', '2019-05-01 09:00:13', NULL, '2019-05-01 09:00:13', 1);
INSERT INTO `notification` (`id`, `user_id`, `title`, `notification_text`, `isRead`, `action`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (8, 'MPHA19_100002', 'Welcome To MyPulse', 'MyPulse Heartly Welcoming You <b>Mr/Mrs HA2</b>', 2, NULL, '', '2019-05-01 09:00:28', NULL, '2019-05-01 09:00:28', 1);
INSERT INTO `notification` (`id`, `user_id`, `title`, `notification_text`, `isRead`, `action`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (9, 'MPU19_100001', 'Welcome To MyPulse', 'MyPulse Heartly Welcoming You <b>Mr/Mrs User1</b>', 2, NULL, '', '2019-05-01 13:09:00', NULL, '2019-05-01 13:09:00', 1);


#
# TABLE STRUCTURE FOR: nurse
#

DROP TABLE IF EXISTS `nurse`;

CREATE TABLE `nurse` (
  `nurse_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `doctor_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `description` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `aadhar` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `qualification` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `experience` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email_verify` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `mobile_verify` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`nurse_id`),
  UNIQUE KEY `uk_unique_id` (`unique_id`) USING BTREE,
  UNIQUE KEY `uk_email` (`email`),
  UNIQUE KEY `uk_phone` (`phone`),
  KEY `fk_nur_branch` (`branch_id`),
  KEY `fk_nur_hospi` (`hospital_id`),
  KEY `fk_nur_dept` (`department_id`),
  KEY `fk_nur_city` (`city_id`),
  KEY `fk_nur_dist` (`district_id`),
  KEY `fk_nur_state` (`state_id`),
  KEY `fk_nur_ctry` (`country_id`),
  CONSTRAINT `fk_nur_branch` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`),
  CONSTRAINT `fk_nur_city` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`),
  CONSTRAINT `fk_nur_ctry` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`),
  CONSTRAINT `fk_nur_dept` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`),
  CONSTRAINT `fk_nur_dist` FOREIGN KEY (`district_id`) REFERENCES `district` (`district_id`),
  CONSTRAINT `fk_nur_hospi` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`),
  CONSTRAINT `fk_nur_state` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `nurse` (`nurse_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `address`, `hospital_id`, `branch_id`, `department_id`, `doctor_id`, `country_id`, `state_id`, `district_id`, `city_id`, `description`, `gender`, `dob`, `aadhar`, `qualification`, `experience`, `phone`, `email_verify`, `mobile_verify`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 'MPN19_100001', 'Nurse1', '', '', 'n1@g.com', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', '123', 1, 1, 1, '1', 1, 1, 1, 1, '', 'F', '1959-05-01', '', 'ABCDEF', '8 Years', '0003215555', 1, 1, 'MPSA18_100001', '2019-05-01 08:54:06', NULL, '2019-05-01 08:47:26', 1);
INSERT INTO `nurse` (`nurse_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `address`, `hospital_id`, `branch_id`, `department_id`, `doctor_id`, `country_id`, `state_id`, `district_id`, `city_id`, `description`, `gender`, `dob`, `aadhar`, `qualification`, `experience`, `phone`, `email_verify`, `mobile_verify`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 'MPN19_100002', 'Nurse1', 'Nurse1', 'Nurse1', 'nn1@g.com', NULL, '', 1, 1, 1, '5', NULL, NULL, NULL, NULL, 'Nurse1', '', NULL, '', '', '', '6655555555', 2, 2, 'MPSA18_100001', '2019-05-02 22:49:40', NULL, '2019-05-02 22:49:40', 1);


#
# TABLE STRUCTURE FOR: patient
#

DROP TABLE IF EXISTS `patient`;

CREATE TABLE `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hospital_ids` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `doctor_ids` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lab_ids` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `store_ids` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `patient` (`id`, `hospital_ids`, `doctor_ids`, `lab_ids`, `store_ids`, `user_id`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, '1', '1', '1', '1', 3, '', '2019-05-01 13:09:44', NULL, '0000-00-00 00:00:00', 1);


#
# TABLE STRUCTURE FOR: prescription
#

DROP TABLE IF EXISTS `prescription`;

CREATE TABLE `prescription` (
  `prescription_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prescription_data` text COLLATE utf8_unicode_ci NOT NULL,
  `medicin_status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `test_status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `created_by` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_by` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`prescription_id`),
  KEY `fk_presuserid` (`user_id`),
  CONSTRAINT `fk_presuserid` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `prescription` (`prescription_id`, `doctor_id`, `user_id`, `prescription_data`, `medicin_status`, `test_status`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 1, 3, 'c23286b3dd1739f3994f9df8c16c9db6042afc6dec23456036b01c35854b614fbd5c34d0a1f6ada9c192626072dafa2e6a86b41c06e62db478ba30e36a9f652f7slPL4ZUsfY4cVsOweMpF2efSJ4o3K2FO+PVVXB4n8Y1E342jSVGSmOx4E4RK4hEsiSeS3M5R+JEGJWaGNCIJ0B3CBdDlneQVaG3XaCqgas=', 2, 2, 'MPD19_100001', '2019-05-01 13:11:33', NULL, NULL, 1);
INSERT INTO `prescription` (`prescription_id`, `doctor_id`, `user_id`, `prescription_data`, `medicin_status`, `test_status`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 1, 3, '868e49f6c00965e4fab7e7f7f127bbd251483b95d76679313456931a86707ed657a9b39ed8f47f27df9ed6448331cd4a1de4e5aaf449c4ae29f1dad46114c45faRGAhVOw3kEEOCwOvisu5StIV0m3lCQjPQHLsDm1BD3XvwqSxPskfWViuMD02H/tnH3XUnUZoGLI/tXi2OFnBJz50eDJJfYGVta52HCgfLnT+1UcygVOt/Lse1FIBE061olmV6MZlj7rzKEg93P3Ww==', 1, 1, 'MPD19_100001', '2019-05-07 07:33:03', 'MPU19_100001', '2019-05-07 07:36:57', 1);


#
# TABLE STRUCTURE FOR: prescription_order
#

DROP TABLE IF EXISTS `prescription_order`;

CREATE TABLE `prescription_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `receipt_id` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `prescription_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `order_type` tinyint(4) NOT NULL COMMENT '0=medicine,1=test',
  `type_of_order` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=by_prescription,1=by_own',
  `order_data` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `quantity` longtext NOT NULL,
  `tests` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `lab_id` int(11) DEFAULT NULL,
  `cost` float NOT NULL,
  `price` float NOT NULL,
  `total` float NOT NULL,
  `receipt_created_at` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=pending,2=received,3=waiting for samples,4=being processed,5=out for delivery,6=reports submitted,7=delivered or completed,8=waiting for receipt',
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `uk_unique_id` (`unique_id`) USING BTREE,
  UNIQUE KEY `uk_receipt_id` (`receipt_id`) USING BTREE,
  KEY `fk_presordlabid` (`lab_id`),
  KEY `fk_presordpresid` (`prescription_id`),
  KEY `fk_presordstrid` (`store_id`),
  KEY `fk_presorduserid` (`user_id`),
  CONSTRAINT `fk_presordlabid` FOREIGN KEY (`lab_id`) REFERENCES `medicallabs` (`lab_id`),
  CONSTRAINT `fk_presordpresid` FOREIGN KEY (`prescription_id`) REFERENCES `prescription` (`prescription_id`),
  CONSTRAINT `fk_presordstrid` FOREIGN KEY (`store_id`) REFERENCES `medicalstores` (`store_id`),
  CONSTRAINT `fk_presorduserid` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `prescription_order` (`order_id`, `unique_id`, `receipt_id`, `prescription_id`, `user_id`, `order_type`, `type_of_order`, `order_data`, `quantity`, `tests`, `store_id`, `lab_id`, `cost`, `price`, `total`, `receipt_created_at`, `status`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (3, 'MPOR19_100001', NULL, NULL, 3, 1, 1, '81a4c9af68d850db5fda9377aa182602cb079b97ef4b3117bc4650fce9c622ec63aa664338fefd300ff5a1701f8725db395a13f7b4be5eb1ccde053358d2bcbd7YnVKhq2PAYaXzU/KpS3/Mo1GFqJxciHngbrHSCZqqQ=', '', '', NULL, 1, '0', '0', '0', NULL, 2, 'MPU19_100001', '2019-05-02 23:38:12', NULL, '2019-05-02 23:38:12', 1);
INSERT INTO `prescription_order` (`order_id`, `unique_id`, `receipt_id`, `prescription_id`, `user_id`, `order_type`, `type_of_order`, `order_data`, `quantity`, `tests`, `store_id`, `lab_id`, `cost`, `price`, `total`, `receipt_created_at`, `status`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (4, 'MPOR19_100002', 'MPRC19_100001', 2, 3, 0, 0, '', '5', '', 1, NULL, '120', '600', '600', '2019-05-07 07:43:10', 7, 'MPU19_100001', '2019-05-07 07:36:43', 'MPS19_100001', '2019-05-07 07:43:30', 1);
INSERT INTO `prescription_order` (`order_id`, `unique_id`, `receipt_id`, `prescription_id`, `user_id`, `order_type`, `type_of_order`, `order_data`, `quantity`, `tests`, `store_id`, `lab_id`, `cost`, `price`, `total`, `receipt_created_at`, `status`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (5, 'MPOR19_100003', 'MPRC19_100002', 2, 3, 1, 0, '', '', '1', NULL, 1, '0', '2000', '2000', '2019-05-07 07:44:46', 7, 'MPU19_100001', '2019-05-07 07:36:57', 'MPL19_100001', '2019-05-07 07:45:31', 1);


#
# TABLE STRUCTURE FOR: prognosis
#

DROP TABLE IF EXISTS `prognosis`;

CREATE TABLE `prognosis` (
  `prognosis_id` int(11) NOT NULL AUTO_INCREMENT,
  `prognosis_data` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`prognosis_id`),
  KEY `fk_progadctid` (`doctor_id`),
  KEY `fk_prorguserid` (`user_id`),
  CONSTRAINT `fk_progadctid` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`),
  CONSTRAINT `fk_prorguserid` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `prognosis` (`prognosis_id`, `prognosis_data`, `user_id`, `doctor_id`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, '8b9691d674a51fc3c50f2d4ba103c02535263334733a057625b00d35f2972d598f560045798434f321cb9fd28071bd48e050e931c67362bdbfa4e17972863af8R39SKMca+WDdYihLowH2XoDI0YKTqkgf+kF88wpAkSxcrmJxY+jcMhfmNq6iVg09ygT4QVOEPWQvCVVIKp8j/A==', 3, 1, 'MPD19_100001', '2019-05-01 13:11:57', NULL, NULL, 1);
INSERT INTO `prognosis` (`prognosis_id`, `prognosis_data`, `user_id`, `doctor_id`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, '8fe9de651fbeb6b92071576582a5b05bbf3dedc691dd0d0a6dc8fd385b322d72d8e890f781f7418d6b6701b8059fdc4ec929329d6d8c52da5db790fbcaa1ba9d9LnIxsjhowWksB/cznS5jj+lhXVLqa/cYoZuOxS9usvWw/IQ0OxUqjqN+1H2NBF0LpHD1UjwYHFjLJpfemmg9w==', 3, 1, 'MPD19_100001', '2019-05-07 07:33:43', NULL, NULL, 1);


#
# TABLE STRUCTURE FOR: receptionist
#

DROP TABLE IF EXISTS `receptionist`;

CREATE TABLE `receptionist` (
  `receptionist_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `doctor_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `description` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `aadhar` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `qualification` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `experience` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email_verify` tinyint(1) NOT NULL DEFAULT '2',
  `mobile_verify` tinyint(1) NOT NULL DEFAULT '2',
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`receptionist_id`),
  UNIQUE KEY `uk_phone` (`phone`),
  UNIQUE KEY `uk_email` (`email`) USING BTREE,
  UNIQUE KEY `uk_unique_id` (`unique_id`) USING BTREE,
  KEY `fk_rec_hospi` (`hospital_id`),
  KEY `fk_rec_dept` (`department_id`),
  KEY `fk_rec_branch` (`branch_id`),
  KEY `fk_rec_city` (`city_id`),
  KEY `fk_rec_dist` (`district_id`),
  KEY `fk_rec_state` (`state_id`),
  KEY `fk_rec_ctry` (`country_id`),
  CONSTRAINT `fk_rec_branch` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`),
  CONSTRAINT `fk_rec_city` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`),
  CONSTRAINT `fk_rec_ctry` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`),
  CONSTRAINT `fk_rec_dept` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`),
  CONSTRAINT `fk_rec_dist` FOREIGN KEY (`district_id`) REFERENCES `district` (`district_id`),
  CONSTRAINT `fk_rec_hospi` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`),
  CONSTRAINT `fk_rec_state` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `receptionist` (`receptionist_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `address`, `hospital_id`, `branch_id`, `department_id`, `doctor_id`, `country_id`, `state_id`, `district_id`, `city_id`, `description`, `gender`, `dob`, `aadhar`, `qualification`, `experience`, `phone`, `email_verify`, `mobile_verify`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 'MPR19_100001', 'Receptionist1', '', '', 'r1@g.com', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', '12/456', 1, 1, 1, '1', 1, 1, 1, 1, '', '', '1989-05-01', '', 'ABCDEF', '5 Years', '0000022222', 1, 1, 'MPSA18_100001', '2019-05-01 08:54:12', NULL, '2019-05-01 08:54:12', 1);


#
# TABLE STRUCTURE FOR: reports
#

DROP TABLE IF EXISTS `reports`;

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=by_order,1=by_own,2=no_order',
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `extension` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `reports` (`report_id`, `order_id`, `order_type`, `title`, `user_id`, `extension`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 0, 1, 'Report1', 3, 'pdf', 'MPD19_100001', '2019-05-01 13:12:17', NULL, '2019-05-01 13:12:17', 1);
INSERT INTO `reports` (`report_id`, `order_id`, `order_type`, `title`, `user_id`, `extension`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 0, 1, 'resport for mahi testing', 3, 'pdf', 'MPD19_100001', '2019-05-07 07:34:15', NULL, '2019-05-07 07:34:15', 1);
INSERT INTO `reports` (`report_id`, `order_id`, `order_type`, `title`, `user_id`, `extension`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (3, 5, 0, '', 0, 'jpg', '', '2019-05-07 07:45:16', NULL, '2019-05-07 07:45:16', 1);


#
# TABLE STRUCTURE FOR: roles
#

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type_id` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image_path` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `uk_role` (`role`) USING BTREE,
  UNIQUE KEY `uk_type` (`type`) USING BTREE,
  UNIQUE KEY `uk_code` (`code`) USING BTREE,
  UNIQUE KEY `uk_image_path` (`image_path`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `roles` (`role_id`, `role`, `type`, `type_id`, `image_path`, `code`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 'Super Admin', 'superadmin', 'superadmin', 'superadmin_image', 'MPSA', 'System', '2019-04-30 21:11:07', '', '2019-04-30 21:11:07', 1);
INSERT INTO `roles` (`role_id`, `role`, `type`, `type_id`, `image_path`, `code`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 'Hospital Admin', 'hospitaladmins', 'admin', 'hospitaladmin_image', 'MPHA', 'System', '2019-04-30 21:11:07', '', '2019-04-30 21:11:07', 1);
INSERT INTO `roles` (`role_id`, `role`, `type`, `type_id`, `image_path`, `code`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (3, 'Doctor', 'doctors', 'doctor', 'doctor_image', 'MPD', 'System', '2019-04-30 21:11:07', '', '2019-04-30 21:11:07', 1);
INSERT INTO `roles` (`role_id`, `role`, `type`, `type_id`, `image_path`, `code`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (4, 'Nurse', 'nurse', 'nurse', 'nurse_image', 'MPN', 'System', '2019-04-30 21:11:07', '', '2019-04-30 21:11:07', 1);
INSERT INTO `roles` (`role_id`, `role`, `type`, `type_id`, `image_path`, `code`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (5, 'Receptionist', 'receptionist', 'receptionist', 'receptionist_image', 'MPR', 'System', '2019-04-30 21:11:07', '', '2019-04-30 21:11:07', 1);
INSERT INTO `roles` (`role_id`, `role`, `type`, `type_id`, `image_path`, `code`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (6, 'Medical Store', 'medicalstores', 'store', 'medical_stores', 'MPS', 'System', '2019-04-30 21:11:07', '', '2019-04-30 21:11:07', 1);
INSERT INTO `roles` (`role_id`, `role`, `type`, `type_id`, `image_path`, `code`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (7, 'Medical Lab', 'medicallabs', 'lab', 'medical_labs', 'MPL', 'System', '2019-04-30 21:11:07', '', '2019-04-30 21:11:07', 1);
INSERT INTO `roles` (`role_id`, `role`, `type`, `type_id`, `image_path`, `code`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (8, 'MyPulse User', 'users', 'user', 'user_image', 'MPU', 'System', '2019-04-30 21:11:07', '', '2019-04-30 21:11:07', 1);


#
# TABLE STRUCTURE FOR: settings
#

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`settings_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

INSERT INTO `settings` (`settings_id`, `setting_type`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 'system_name', 'MyPulse', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `settings` (`settings_id`, `setting_type`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 'system_title', 'MyPulse', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `settings` (`settings_id`, `setting_type`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (3, 'address', 'Hyderabad', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `settings` (`settings_id`, `setting_type`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (4, 'phone', '9739195391', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `settings` (`settings_id`, `setting_type`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (5, 'paypal_email', '', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `settings` (`settings_id`, `setting_type`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (6, 'currency', '', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `settings` (`settings_id`, `setting_type`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (7, 'system_email', 'mypulsecare@gmail.com', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `settings` (`settings_id`, `setting_type`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (8, 'email_password', 'MyPulse@123', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `settings` (`settings_id`, `setting_type`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (9, 'purchase_code', '[ your-purchase-code-here ]', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `settings` (`settings_id`, `setting_type`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (11, 'language', '', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `settings` (`settings_id`, `setting_type`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (12, 'text_align', '', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `settings` (`settings_id`, `setting_type`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (13, 'system_currency_id', '1', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `settings` (`settings_id`, `setting_type`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (14, 'sms_username', 'mypulsecare@gmail.com', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `settings` (`settings_id`, `setting_type`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (15, 'sms_sender', 'TXTLCL', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `settings` (`settings_id`, `setting_type`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (16, 'sms_hash', 'Hp1qPEPiNj0-Q9HXoTR77OZ12cqTlOcohqW928oJzA', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `settings` (`settings_id`, `setting_type`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (17, 'GST', '', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `settings` (`settings_id`, `setting_type`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (19, 'privacy', '', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `settings` (`settings_id`, `setting_type`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (20, 'terms', '', 'System', '2019-04-30 21:11:07', NULL, '0000-00-00 00:00:00', 1);


#
# TABLE STRUCTURE FOR: specializations
#

DROP TABLE IF EXISTS `specializations`;

CREATE TABLE `specializations` (
  `specializations_id` int(11) NOT NULL AUTO_INCREMENT,
  `specializations_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`specializations_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `specializations` (`specializations_id`, `specializations_name`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 'Cardiology', 'MPSA18_100001', '2019-05-01 08:44:17', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `specializations` (`specializations_id`, `specializations_name`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 'Dentist', 'MPSA18_100001', '2019-05-01 08:44:24', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `specializations` (`specializations_id`, `specializations_name`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (3, 'phsiotherapy', 'MPSA18_100001', '2019-05-01 08:44:34', 'MPSA18_100001', '2019-05-01 08:44:40', 0);
INSERT INTO `specializations` (`specializations_id`, `specializations_name`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (4, 'HIV', 'MPSA18_100001', '2019-05-05 19:40:42', NULL, '0000-00-00 00:00:00', 1);


#
# TABLE STRUCTURE FOR: state
#

DROP TABLE IF EXISTS `state`;

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`state_id`),
  KEY `fk_statectrid` (`country_id`),
  CONSTRAINT `fk_statectrid` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `state` (`state_id`, `state_name`, `country_id`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 'Andhra Pradesh', 1, 'MPSA18_100001', '2019-04-30 21:17:16', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `state` (`state_id`, `state_name`, `country_id`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 'USA - S', 2, 'MPSA18_100001', '2019-05-05 19:41:24', NULL, '0000-00-00 00:00:00', 1);


#
# TABLE STRUCTURE FOR: superadmin
#

DROP TABLE IF EXISTS `superadmin`;

CREATE TABLE `superadmin` (
  `superadmin_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `mname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `email_verify` tinyint(1) NOT NULL DEFAULT '2',
  `mobile_verify` tinyint(1) NOT NULL DEFAULT '2',
  `created_by` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`superadmin_id`),
  UNIQUE KEY `uk_unique_id` (`unique_id`),
  UNIQUE KEY `uk_email` (`email`),
  UNIQUE KEY `uk_phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `superadmin` (`superadmin_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `phone`, `description`, `address`, `gender`, `dob`, `country_id`, `state_id`, `district_id`, `city_id`, `email_verify`, `mobile_verify`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 'MPSA18_100001', 'Rajasekhar', '', 'Admin', 'sa@g.com', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', '9739195391', 'Super admin', 'HYD', '', NULL, 0, 0, 0, 0, 1, 1, '', '2019-04-15 05:45:47', '', '2019-04-15 05:45:47', 1);


#
# TABLE STRUCTURE FOR: tables
#

DROP TABLE IF EXISTS `tables`;

CREATE TABLE `tables` (
  `table_id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `unique_id` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`table_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO `tables` (`table_id`, `table_name`, `unique_id`, `code`, `created_by`, `created_at`, `row_status_cd`) VALUES (1, 'superadmin', '', 'MPSA', 'System', '2019-04-30 21:11:07', 1);
INSERT INTO `tables` (`table_id`, `table_name`, `unique_id`, `code`, `created_by`, `created_at`, `row_status_cd`) VALUES (2, 'hospitals', 'MPH19_100006', 'MPH', 'System', '2019-04-30 21:11:07', 1);
INSERT INTO `tables` (`table_id`, `table_name`, `unique_id`, `code`, `created_by`, `created_at`, `row_status_cd`) VALUES (3, 'hospitaladmins', 'MPHA19_100003', 'MPHA', 'System', '2019-04-30 21:11:07', 1);
INSERT INTO `tables` (`table_id`, `table_name`, `unique_id`, `code`, `created_by`, `created_at`, `row_status_cd`) VALUES (4, 'doctors', 'MPD19_100003', 'MPD', 'System', '2019-04-30 21:11:07', 1);
INSERT INTO `tables` (`table_id`, `table_name`, `unique_id`, `code`, `created_by`, `created_at`, `row_status_cd`) VALUES (5, 'receptionist', 'MPR19_100001', 'MPR', 'System', '2019-04-30 21:11:07', 1);
INSERT INTO `tables` (`table_id`, `table_name`, `unique_id`, `code`, `created_by`, `created_at`, `row_status_cd`) VALUES (6, 'nurse', 'MPN19_100002', 'MPN', 'System', '2019-04-30 21:11:07', 1);
INSERT INTO `tables` (`table_id`, `table_name`, `unique_id`, `code`, `created_by`, `created_at`, `row_status_cd`) VALUES (7, 'medicalstores', 'MPS19_100002', 'MPS', 'System', '2019-04-30 21:11:07', 1);
INSERT INTO `tables` (`table_id`, `table_name`, `unique_id`, `code`, `created_by`, `created_at`, `row_status_cd`) VALUES (8, 'medicallabs', 'MPL19_100002', 'MPL', 'System', '2019-04-30 21:11:07', 1);
INSERT INTO `tables` (`table_id`, `table_name`, `unique_id`, `code`, `created_by`, `created_at`, `row_status_cd`) VALUES (9, 'users', 'MPU19_100004', 'MPU', 'System', '2019-04-30 21:11:07', 1);
INSERT INTO `tables` (`table_id`, `table_name`, `unique_id`, `code`, `created_by`, `created_at`, `row_status_cd`) VALUES (10, 'appointments', 'MPA19_100003', 'MPA', 'System', '2019-04-30 21:11:07', 1);
INSERT INTO `tables` (`table_id`, `table_name`, `unique_id`, `code`, `created_by`, `created_at`, `row_status_cd`) VALUES (11, 'prescription_order', 'MPOR19_100003', 'MPOR', 'System', '2019-04-30 21:11:07', 1);
INSERT INTO `tables` (`table_id`, `table_name`, `unique_id`, `code`, `created_by`, `created_at`, `row_status_cd`) VALUES (12, 'order_receipt', 'MPRC19_100002', 'MPRC', 'System', '2019-04-30 21:11:07', 1);
INSERT INTO `tables` (`table_id`, `table_name`, `unique_id`, `code`, `created_by`, `created_at`, `row_status_cd`) VALUES (13, 'availability_slot', '119', NULL, 'System', '2019-04-30 21:11:07', 1);


#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `mname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `address` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `age` int(11) NOT NULL,
  `patient_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `in_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `account_opening_timestamp` int(11) NOT NULL,
  `aadhar` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `height` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `weight` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `blood_pressure` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `sugar_level` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `health_insurance_provider` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `health_insurance_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `family_history` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `past_medical_history` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `reg_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=registered,2=unregistered',
  `email_verify` tinyint(1) NOT NULL DEFAULT '2',
  `mobile_verify` tinyint(1) NOT NULL DEFAULT '2',
  `created_by` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `uk_unique_id` (`unique_id`),
  UNIQUE KEY `uk_email` (`email`),
  UNIQUE KEY `uk_phone` (`phone`),
  KEY `fk_userctrid` (`country_id`),
  KEY `fk_userdistid` (`district_id`),
  KEY `fk_userstid` (`state_id`),
  KEY `fk_usercityid` (`city_id`),
  CONSTRAINT `fk_usercityid` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`),
  CONSTRAINT `fk_userctrid` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`),
  CONSTRAINT `fk_userdistid` FOREIGN KEY (`district_id`) REFERENCES `district` (`district_id`),
  CONSTRAINT `fk_userstid` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country_id`, `state_id`, `district_id`, `city_id`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `email_verify`, `mobile_verify`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (3, 'MPU19_100001', 'User1', '', '', 'u1@g.com', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', 'Adding User', 1, 1, 1, 1, '12/555', '1020569999', 'M', '1992-05-01', 26, '', 'B-', '2019-05-07 07:32:06', 0, '12/555', '6.2', '65', '255', '12/22', 'llll', 'mmmmm', 'mllllll', '1233654', 1, 1, 1, 'MPSA18_100001', '2019-05-01 10:15:13', 'MPD19_100001', '2019-05-07 07:32:06', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country_id`, `state_id`, `district_id`, `city_id`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `email_verify`, `mobile_verify`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (5, 'MPU19_100002', 'User2', '', '', 'u2@g.com', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', '', 1, 1, 1, 1, '12/5588', '1020333369', 'M', '1992-05-01', 26, '', 'AB+', '2019-05-01 13:08:49', 0, '', '6.2', '65', '255', '12/22', 'llll', 'mmmmm', 'mllllll', '1233654', 1, 1, 1, 'MPSA18_100001', '2019-05-01 12:43:06', NULL, '2019-05-01 12:43:06', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country_id`, `state_id`, `district_id`, `city_id`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `email_verify`, `mobile_verify`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (8, 'MPU19_100004', 'user user1', 'user user1', 'user user1', 'user1@g.com', NULL, 'user user1', NULL, NULL, NULL, NULL, '', '6654545454', '', NULL, 0, '', '', '2019-05-02 22:54:48', 0, '', '', '', '', '', '', '', '', '', 1, 2, 2, 'MPSA18_100001', '2019-05-02 22:54:48', NULL, '2019-05-02 22:54:48', 1);


#
# TABLE STRUCTURE FOR: ward
#

DROP TABLE IF EXISTS `ward`;

CREATE TABLE `ward` (
  `ward_id` int(11) NOT NULL AUTO_INCREMENT,
  `hospital_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `ward_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `row_status_cd` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Deleted 1-Active 2-Inactive',
  PRIMARY KEY (`ward_id`),
  KEY `fk_wardbranchid` (`branch_id`),
  KEY `fk_wardhospid` (`hospital_id`),
  KEY `fk_warddeptid` (`department_id`),
  CONSTRAINT `fk_wardbranchid` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`),
  CONSTRAINT `fk_warddeptid` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`),
  CONSTRAINT `fk_wardhospid` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `ward` (`ward_id`, `hospital_id`, `branch_id`, `department_id`, `ward_name`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (1, 1, 1, 1, 'W1', '', 'MPSA18_100001', '2019-04-30 21:32:19', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `ward` (`ward_id`, `hospital_id`, `branch_id`, `department_id`, `ward_name`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (2, 2, 2, 2, 'W1', 'ADD', 'MPSA18_100001', '2019-05-01 09:39:32', NULL, '0000-00-00 00:00:00', 1);
INSERT INTO `ward` (`ward_id`, `hospital_id`, `branch_id`, `department_id`, `ward_name`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `row_status_cd`) VALUES (3, 3, 3, 3, 'W1', 'ADD', 'MPSA18_100001', '2019-05-01 09:40:55', NULL, '0000-00-00 00:00:00', 1);


