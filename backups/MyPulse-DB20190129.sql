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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

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
  `next_appointment` date NOT NULL,
  `created_type` text NOT NULL,
  `created_by` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `attended_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=not-attended,1=attended',
  PRIMARY KEY (`appointment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (1, 'MPA19_100001', 2, 1, 2, 1, '2019-01-22', '19:00', '19:30', 4, 'Normal', '', '0000-00-00', '', 'superadmin-superadmin-1', '2019-01-28 22:39:48', '2019-01-28 22:39:48', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (2, 'MPA19_100002', 1, 1, 2, 1, '2019-01-24', '10:00', '10:30', 3, 'Normal', 'Appointment was cancelled by: \"Super Admin - Super\" for the reason: \" sdsds\".', '0000-00-00', '', 'users-user-1', '2019-01-28 22:39:40', '2019-01-28 22:39:40', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (3, 'MPA19_100003', 1, 1, 2, 1, '2019-01-24', '18:00', '18:30', 4, 'FEVER', '', '0000-00-00', '', 'superadmin-superadmin-1', '2019-01-28 22:39:38', '2019-01-28 22:39:38', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (4, 'MPA19_100004', 2, 2, 1, 2, '2019-01-24', '18:00', '18:30', 4, 'FEVER', '', '0000-00-00', '', 'superadmin-superadmin-1', '2019-01-28 22:39:31', '2019-01-28 22:39:31', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (5, 'MPA19_100005', 1, 1, 2, 1, '2019-01-28', '19:00', '19:30', 2, 'Normal', '', '0000-00-00', '', 'superadmin-superadmin-1', '2019-01-28 22:39:12', '2019-01-28 22:39:12', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (6, 'MPA19_100006', 2, 1, 2, 1, '2019-01-28', '10:00', '10:30', 2, 'Normal', '', '0000-00-00', '', 'superadmin-superadmin-1', '2019-01-28 22:30:58', '2019-01-28 22:30:58', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (7, 'MPA19_100007', 3, 2, 1, 2, '2019-01-29', '17:30', '18:00', 2, 'Normal', '', '0000-00-00', '', 'superadmin-superadmin-1', '2019-01-28 22:37:26', '2019-01-28 22:37:26', 0);


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
) ENGINE=MyISAM AUTO_INCREMENT=157 DEFAULT CHARSET=latin1;

INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (1, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/09/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (2, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/10/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (3, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/11/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (4, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/12/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (5, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/13/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (6, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/14/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (7, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/15/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (8, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/16/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (9, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/17/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (10, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/18/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (11, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/19/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (12, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/20/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (13, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/21/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (14, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/22/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (15, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/23/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (16, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/24/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (17, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/25/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (18, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/26/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (19, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/27/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (20, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/28/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (21, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/29/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (22, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/30/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (23, 1, '01/09/2019', '01/31/2019', '10:00', '11:30', 0, '1,2,3,4,5', '4281', '01/31/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (115, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/31/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (114, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/30/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (113, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/29/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (112, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/28/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (111, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/27/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (110, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/26/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (109, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/25/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (108, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/24/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (107, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/23/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (106, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/22/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (105, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/21/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (104, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/20/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (103, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/19/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (102, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/18/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (101, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/17/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (100, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/16/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (99, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/15/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (98, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/14/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (97, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/13/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (96, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/12/2019', 2);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (95, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/11/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (94, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/10/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (93, 1, '01/09/2019', '01/31/2019', '17:00', '20:00', 0, '1,2,3,4,5', '1481', '01/09/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (116, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '01/20/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (117, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '01/21/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (118, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '01/22/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (119, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '01/23/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (120, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '01/24/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (121, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '01/25/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (122, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '01/26/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (123, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '01/27/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (124, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '01/28/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (125, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '01/29/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (126, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '01/30/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (127, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '01/31/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (128, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '02/01/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (129, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '02/02/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (130, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '02/03/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (131, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '02/04/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (132, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '02/05/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (133, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '02/06/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (134, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '02/07/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (135, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '02/08/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (136, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '02/09/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (137, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '02/10/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (138, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '02/11/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (139, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '02/12/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (140, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '02/13/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (141, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '02/14/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (142, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '02/15/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (143, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '02/16/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (144, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '02/17/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (145, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '02/18/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (146, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '02/19/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (147, 2, '01/20/2019', '02/20/2019', '17:00', '21:00', 1, '0,1,2,3,4,5,6', '2775', '02/20/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (148, 1, '01/23/2019', '01/31/2019', '17:00', '20:00', 1, '0,1,2,3,4,5,6', '7678', '01/23/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (149, 1, '01/23/2019', '01/31/2019', '17:00', '20:00', 1, '0,1,2,3,4,5,6', '7678', '01/24/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (150, 1, '01/23/2019', '01/31/2019', '17:00', '20:00', 1, '0,1,2,3,4,5,6', '7678', '01/25/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (151, 1, '01/23/2019', '01/31/2019', '17:00', '20:00', 1, '0,1,2,3,4,5,6', '7678', '01/26/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (152, 1, '01/23/2019', '01/31/2019', '17:00', '20:00', 1, '0,1,2,3,4,5,6', '7678', '01/27/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (153, 1, '01/23/2019', '01/31/2019', '17:00', '20:00', 1, '0,1,2,3,4,5,6', '7678', '01/28/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (154, 1, '01/23/2019', '01/31/2019', '17:00', '20:00', 1, '0,1,2,3,4,5,6', '7678', '01/29/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (155, 1, '01/23/2019', '01/31/2019', '17:00', '20:00', 1, '0,1,2,3,4,5,6', '7678', '01/30/2019', 1);
INSERT INTO `availability_slot` (`id`, `doctor_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat_interval`, `repeat_on`, `unik`, `date`, `status`) VALUES (156, 1, '01/23/2019', '01/31/2019', '17:00', '20:00', 1, '0,1,2,3,4,5,6', '7678', '01/31/2019', 1);


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

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('6f8porv6fdfq4hrr0he38qqrr6b7srpd', '::1', 1548741060, '__ci_last_regenerate|i:1548741060;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";current_language|s:7:\"english\";last_page|s:41:\"http://localhost/mypulse/main/appointment\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('9lqm78u38qbpb1g5fjmkl3r293n4v3g5', '::1', 1548738732, '__ci_last_regenerate|i:1548738732;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('fccn8tvej67q8152edv686ikkh7gpeuq', '::1', 1548739849, '__ci_last_regenerate|i:1548739849;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";current_language|s:7:\"english\";last_page|s:38:\"http://localhost/mypulse/main/report/2\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('fsr1ni54ndhjhdif8e8d7kjtpoi6g698', '::1', 1548739360, '__ci_last_regenerate|i:1548739360;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";current_language|s:7:\"english\";last_page|s:38:\"http://localhost/mypulse/main/report/2\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ho4udq2t2abunenn5l1guvmluhokf8ak', '::1', 1548739042, '__ci_last_regenerate|i:1548739042;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";current_language|s:7:\"english\";last_page|s:38:\"http://localhost/mypulse/main/report/2\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('k30uv5ns8tik9fhr6shmsbsnlpu1785e', '::1', 1548740705, '__ci_last_regenerate|i:1548740705;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";current_language|s:7:\"english\";last_page|s:41:\"http://localhost/mypulse/main/appointment\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('oh48nv4cuug1a3b0lknufpib2k8665vb', '::1', 1548740400, '__ci_last_regenerate|i:1548740400;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";current_language|s:7:\"english\";last_page|s:38:\"http://localhost/mypulse/main/report/2\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ugvhv0jsesblshq7flp1mflj7lcrd8fd', '::1', 1548741280, '__ci_last_regenerate|i:1548741060;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";current_language|s:7:\"english\";last_page|s:41:\"http://localhost/mypulse/main/appointment\";');


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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

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

INSERT INTO `doctors` (`doctor_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `address`, `phone`, `description`, `gender`, `dob`, `aadhar`, `qualification`, `specializations`, `experience`, `registration`, `hospital_id`, `branch_id`, `department_id`, `country`, `state`, `district`, `city`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (1, 'MPD19_100001', 'Doctor 1', 'Doctor 1', 'Doctor 1', 'd1@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '', '1231231235', 'Doctor 1 for hospital 1', '', '', '', '', '1,3', '', '', 1, 2, 2, 0, 0, 0, 0, 1, 2, 1, '2019-01-28 19:03:56', '2019-01-28 19:03:56', 1);
INSERT INTO `doctors` (`doctor_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `address`, `phone`, `description`, `gender`, `dob`, `aadhar`, `qualification`, `specializations`, `experience`, `registration`, `hospital_id`, `branch_id`, `department_id`, `country`, `state`, `district`, `city`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (2, 'MPD19_100002', 'Doctor2', 'Doctor 2', 'Doctor2', 'd2@g.com', 'e5a1b2af03e9efe769bd8398475bb091f3356c3e', '', '1421421422', 'Doctor 2', '', '', '', '', '', '', '', 2, 1, 1, 0, 0, 0, 0, 2, 2, 1, '2019-01-28 19:04:19', '2019-01-28 19:04:19', 1);


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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `hospitaladmins` (`admin_id`, `unique_id`, `hospital_id`, `name`, `mname`, `lname`, `email`, `password`, `phone`, `address`, `country`, `state`, `district`, `city`, `aadhar`, `gender`, `dob`, `qualification`, `profession`, `experience`, `description`, `last_login`, `last_logout`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (1, 'MPHA19_100001', 1, 'Hospital Admin1', '', 'Admin', 'ha1@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '8120015502', '', 0, 0, 0, 0, '', '', '', '', '', '', 'Admin For Hospital 1', '', '', 1, 2, 1, '2019-01-28 17:28:12', '2019-01-28 17:28:12', 1);
INSERT INTO `hospitaladmins` (`admin_id`, `unique_id`, `hospital_id`, `name`, `mname`, `lname`, `email`, `password`, `phone`, `address`, `country`, `state`, `district`, `city`, `aadhar`, `gender`, `dob`, `qualification`, `profession`, `experience`, `description`, `last_login`, `last_logout`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (2, 'MPHA19_100002', 1, 'Ha2', 'Ha2', 'Ha2', 'ha2@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '1421421423', '', 0, 0, 0, 0, '', '', '', '', '', '', 'Ha2', '', '', 1, 2, 1, '2019-01-28 17:28:32', '2019-01-28 17:28:32', 1);


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

INSERT INTO `hospitals` (`hospital_id`, `unique_id`, `name`, `address`, `description`, `phone_number`, `email`, `license_category`, `city`, `district`, `state`, `country`, `md_name`, `md_contact_number`, `created_at`, `modified_at`, `status`, `license`, `license_status`, `from_date`, `till_date`, `isDeleted`) VALUES (1, 'MPH19_100001', 'Hospital 111', 'Ha1', 'Hospital Number 1', '1231231231', 'ha1@g.com', NULL, '1', '1', '2', '1', 'HA', '1231231231', '2019-01-28 17:16:26', '2019-01-08 17:19:55', 1, '2', 1, '01/28/2019', '01/29/2020', 1);
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `notification` (`id`, `created_by`, `user_id`, `title`, `text`, `isRead`, `action`, `created_at`, `isDeleted`) VALUES (1, '', 'users-user-1', 'MPA19_100002 Appointment Canceled', 'Hi User Your Appointment No MPA19_100002 was Canceled for the Reason \" sdsds \" .', 2, NULL, '2019-01-23 20:42:48', 0);
INSERT INTO `notification` (`id`, `created_by`, `user_id`, `title`, `text`, `isRead`, `action`, `created_at`, `isDeleted`) VALUES (2, '', 'doctors-doctor-1', 'MPA19_100002 Appointment Canceled', 'Hi User Your Appointment No MPA19_100002 was Canceled for the Reason \" sdsds \" .', 2, NULL, '2019-01-23 20:42:48', 0);


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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `patient` (`id`, `hospital_ids`, `doctor_ids`, `lab_ids`, `store_ids`, `user_id`) VALUES (1, '2,1', '2,1', '1', '1', 1);
INSERT INTO `patient` (`id`, `hospital_ids`, `doctor_ids`, `lab_ids`, `store_ids`, `user_id`) VALUES (2, '2,1', '2,1', '', '', 2);
INSERT INTO `patient` (`id`, `hospital_ids`, `doctor_ids`, `lab_ids`, `store_ids`, `user_id`) VALUES (3, '2', '2', '', '', 3);


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

INSERT INTO `receptionist` (`receptionist_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `address`, `hospital_id`, `branch_id`, `department_id`, `doctor_id`, `country`, `state`, `district`, `city`, `description`, `gender`, `dob`, `aadhar`, `qualification`, `experience`, `phone`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (1, 'MPR19_100001', 'Receptionist1', '', 'Receptionist1', 'r1@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '', 1, 2, 0, '1', 0, 0, 0, 0, 'Receptionist For all Departments', '', '', '', '', '', '1231231236', 1, 2, 1, '2019-01-09 13:00:57', '2019-01-09 13:00:57', 1);


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
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (8, 'buyer', '[ your-codecanyon-username-here ]');
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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (1, 'MPU19_100001', 'Mypulse User 1', 'Mypulse User 1', 'Mypulse User 1', 'u1@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'Mypulse User 1', 1, 2, 1, 1, '', '8100815502', 'male', '01/31/2000', 18, '', 'A+', '', 0, '', '5.6', '59', '120', '100', 'mahi', 'no', 'not', 'not', 1, 2, 1, 1, '2019-01-27 21:49:07', '2019-01-27 21:49:07', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (2, 'MPU19_100002', 'Mypulse User 2', 'Mypulse User 2', 'Mypulse User 2', 'u2@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'Mypulse User 2', 1, 2, 1, 2, 'Mypulse User 2', '7777777771', 'female', '12/30/1998', 20, '', 'A-', '', 0, '', '5.6', '59', '120', '100', 'mahi', 'no', 'Nothing', 'not', 1, 1, 1, 1, '2019-01-27 21:48:18', '2019-01-27 21:48:18', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (3, 'MPU19_100003', 'Mypulse User 3', 'Mypulse User 3', 'Mypulse User 3', 'u3@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'Mypulse User 3', 1, 2, 1, 1, 'Mypulse User 3', '7777777772', '', '06/02/1999', 19, '', 'B+', '', 0, '', '5.5', '69', '120', '100', 'mahi', 'no', 'not', 'not', 1, 1, 1, 1, '2019-01-27 21:48:21', '2019-01-27 21:48:21', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (4, 'MPU19_100004', 'Mypulse User 4', 'Mypulse User 4', 'Mypulse User 4', 'u4@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'Mypulse User 4', 1, 32, 2, 4, 'Mypulse User 4', '7777777773', 'male', '12/26/1988', 30, '', 'B-', '', 0, '', '5.6', '69', '120', '100', 'mahi', '1222', 'not', 'not', 1, 1, 2, 1, '2019-01-09 13:01:36', '2019-01-09 13:01:36', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (5, 'MPU19_100005', 'mahi', '', '', 'maheshbt9@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', 0, 0, 0, 0, '', '8247344444', '', '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 1, 2, 1, 1, '2019-01-26 12:52:24', '2019-01-26 12:52:24', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (6, 'MPU19_100006', 'mahi', '', '', 'mahi@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', 0, 0, 0, 0, '', '8244361446', '', '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 1, 2, 1, 1, '2019-01-28 18:10:32', '2019-01-28 18:10:32', 1);
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`, `isDeleted`) VALUES (7, 'MPU19_100007', 'Mahesh', '', 'mahesh', 'maheshbt8@gmail.com', 'e5a1b2af03e9efe769bd8398475bb091f3356c3e', '', 0, 0, 0, 0, '', '8247361446', '', '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 2, 2, 2, 1, '2019-01-28 18:10:45', '2019-01-28 18:10:45', 1);


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


