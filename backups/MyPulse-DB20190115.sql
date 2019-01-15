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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (1, 1, '01/09/2019', '18:30', '19:00', '', 'superadmin-superadmin-1', '', 1, '2019-01-09 11:00:02');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (2, 1, '', '', '', 'System', 'MyPulse', '', 7, '2019-01-10 22:15:39');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (3, 2, '01/14/2019', '10:00', '10:30', '', 'superadmin-superadmin-1', '', 1, '2019-01-12 22:49:17');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (4, 3, '01/15/2019', '10:30', '11:00', '', 'superadmin-superadmin-1', '', 1, '2019-01-14 16:28:47');
INSERT INTO `appointment_history` (`appointment_history_id`, `appointment_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `created_type`, `created_by`, `reason`, `action`, `created_time`) VALUES (5, 2, '', '', '', 'System', 'MyPulse', '', 7, '2019-01-15 11:39:13');


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
  `appointment_date` longtext NOT NULL,
  `appointment_time_start` longtext,
  `appointment_time_end` longtext,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=pending,2=confirmed,3=cancelled,4=closed',
  `reason` text NOT NULL,
  `remarks` text NOT NULL,
  `next_appointment` longtext NOT NULL,
  `created_type` text NOT NULL,
  `created_by` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `attended_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=not-attended,1=attended',
  PRIMARY KEY (`appointment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (1, 'MPA19_100001', 1, 1, 2, 1, '01/09/2019', '18:30', '19:00', 4, 'FEVER', '', '', '', 'superadmin-superadmin-1', '2019-01-10 22:15:39', '2019-01-10 22:15:39', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (2, 'MPA19_100002', 2, 1, 2, 1, '01/14/2019', '10:00', '10:30', 4, 'FEVER', '', '', '', 'superadmin-superadmin-1', '2019-01-15 11:39:13', '2019-01-15 11:39:13', 0);
INSERT INTO `appointments` (`appointment_id`, `appointment_number`, `user_id`, `hospital_id`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time_start`, `appointment_time_end`, `status`, `reason`, `remarks`, `next_appointment`, `created_type`, `created_by`, `created_at`, `modified_at`, `attended_status`) VALUES (3, 'MPA19_100003', 2, 1, 2, 1, '01/15/2019', '10:30', '11:00', 2, 'gggg', '', '', '', 'superadmin-superadmin-1', '2019-01-14 16:29:48', '2019-01-14 16:29:48', 0);


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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `availability` (`availability_id`, `doctor_id`, `no_appt_handle`, `message`, `start_time`, `end_time`, `status`) VALUES (1, 2, '2', 'Available only Monday - Friday  10:00 Am - 11:30 Am and  05:00 Pm - 08:00 Pm', '', '', 0);


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
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`bed_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `bed` (`bed_id`, `hospital_id`, `branch_id`, `department_id`, `ward_id`, `name`, `bed_status`) VALUES (1, 1, 2, 2, 1, 'B1', 2);
INSERT INTO `bed` (`bed_id`, `hospital_id`, `branch_id`, `department_id`, `ward_id`, `name`, `bed_status`) VALUES (2, 1, 2, 2, 1, 'B2', 1);


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
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL COMMENT '1=active,2=inactive',
  PRIMARY KEY (`branch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `branch` (`branch_id`, `hospital_id`, `name`, `phone`, `email`, `address`, `city`, `district`, `state`, `country`, `isActive`, `isDeleted`, `created_at`, `modified_at`, `status`) VALUES (1, 2, 'Branch1', '1231231233', 'b1@g.com', 'Branch1', 3, 2, 32, 1, 1, 0, '0000-00-00 00:00:00', '2019-01-08 18:01:59', 0);
INSERT INTO `branch` (`branch_id`, `hospital_id`, `name`, `phone`, `email`, `address`, `city`, `district`, `state`, `country`, `isActive`, `isDeleted`, `created_at`, `modified_at`, `status`) VALUES (2, 1, 'Branch2', '1231231233', 'b2@g.com', 'b2', 2, 1, 2, 1, 1, 0, '0000-00-00 00:00:00', '2019-01-08 19:07:08', 0);


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

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('0mgcsg9fu8v0bc9ppn3hrsqr28ubmtjk', '::1', 1547495351, '__ci_last_regenerate|i:1547495351;last_page|s:42:\"http://localhost:81/mypulse/main/dashboard\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('11uq920cnt1eojlejj7kbe8bpq3jnmd0', '::1', 1547502833, '__ci_last_regenerate|i:1547502833;last_page|s:48:\"http://localhost:81/mypulse/main/system_settings\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('1p4ehkq3hq6o55lf4shkhv2qr3g665l6', '::1', 1547498092, '__ci_last_regenerate|i:1547498092;last_page|s:42:\"http://localhost:81/mypulse/main/dashboard\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('1u1rbbsnl0on3jve8mh7297cohrs6h68', '::1', 1547496632, '__ci_last_regenerate|i:1547496632;last_page|s:42:\"http://localhost:81/mypulse/main/dashboard\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('4o3015qjjn7o40fj9ag040po4kopbbmh', '::1', 1547530526, '__ci_last_regenerate|i:1547530526;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";last_page|s:49:\"http://localhost:81/mypulse_backup/main/dashboard\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('95bg2aab4iq19g8hhnlqaqfdodhe9r6q', '::1', 1547500469, '__ci_last_regenerate|i:1547500469;last_page|s:48:\"http://localhost:81/mypulse/main/system_settings\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ctf0v1qnrr9h608f0gvi02311us826q1', '::1', 1547504870, '__ci_last_regenerate|i:1547504870;last_page|s:39:\"http://localhost:81/mypulse/main/doctor\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";last_page1|s:54:\"http://localhost:81/mypulse/main/doctor_availability/1\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('damf1heshq6h96rrnhakdedpgmbfc7ap', '::1', 1547531555, '__ci_last_regenerate|i:1547531555;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('e41no5k1ur1ebvpbmn1rm5dkhomvhkmh', '::1', 1547502453, '__ci_last_regenerate|i:1547502453;last_page|s:48:\"http://localhost:81/mypulse/main/system_settings\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('e5qot33bkgj8k34sb8gusl3an0gd8ff1', '::1', 1547500798, '__ci_last_regenerate|i:1547500798;last_page|s:48:\"http://localhost:81/mypulse/main/system_settings\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('hrn5s0rfncv34h0g2qorb3m5b3sn3gqn', '::1', 1547531907, '__ci_last_regenerate|i:1547531907;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";last_page|s:42:\"http://localhost:81/mypulse/main/dashboard\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('htet6g0p9idka3nv3bhup3i6dke1hvda', '::1', 1547505168, '__ci_last_regenerate|i:1547504870;last_page|s:39:\"http://localhost:81/mypulse/main/doctor\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";last_page1|s:54:\"http://localhost:81/mypulse/main/doctor_availability/1\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('i7kb8uafp3l116cvl20tp9bavgt381t6', '::1', 1547500080, '__ci_last_regenerate|i:1547500080;last_page|s:48:\"http://localhost:81/mypulse/main/system_settings\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('icgof8kcdigsr15qj0d1kt1f67ijpidn', '::1', 1547497368, '__ci_last_regenerate|i:1547497368;last_page|s:42:\"http://localhost:81/mypulse/main/dashboard\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('kfe6lkhal99mqvq3812v77kefi4j5g05', '::1', 1547499393, '__ci_last_regenerate|i:1547499393;last_page|s:48:\"http://localhost:81/mypulse/main/system_settings\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('kk1jdljrkv24eijahdn7f2r2rr4hhc9i', '::1', 1547501145, '__ci_last_regenerate|i:1547501145;last_page|s:48:\"http://localhost:81/mypulse/main/system_settings\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('kmd7uv874hgreih9llc6d5cpfkdj4ebe', '::1', 1547498452, '__ci_last_regenerate|i:1547498452;last_page|s:42:\"http://localhost:81/mypulse/main/dashboard\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('l0no2qg19f2dktjttmejnde1tm82493f', '::1', 1547497050, '__ci_last_regenerate|i:1547497050;last_page|s:42:\"http://localhost:81/mypulse/main/dashboard\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('lcetikd2894d7tekoui7hd5ir50idqck', '::1', 1547494801, '__ci_last_regenerate|i:1547494801;last_page|s:42:\"http://localhost:81/mypulse/main/dashboard\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('lhdnmb9mlg7j87l3rl1lfo99ahh0ohrl', '::1', 1547532335, '__ci_last_regenerate|i:1547532335;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";last_page|s:42:\"http://localhost:81/mypulse/main/dashboard\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('m9bknfnrspj3d8mpgl2aa8coin6qtp3o', '::1', 1547497685, '__ci_last_regenerate|i:1547497685;last_page|s:42:\"http://localhost:81/mypulse/main/dashboard\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('me3812q4v7v27evnbub1rcvdjj3npf3o', '::1', 1547498773, '__ci_last_regenerate|i:1547498773;last_page|s:42:\"http://localhost:81/mypulse/main/dashboard\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('nkol0e6mgdui9b9q7oa53q7kckbnje1b', '::1', 1547499725, '__ci_last_regenerate|i:1547499725;last_page|s:48:\"http://localhost:81/mypulse/main/system_settings\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('p2h4oc777kiiqtc5emo9n6u4i9l82us5', '::1', 1547501484, '__ci_last_regenerate|i:1547501484;last_page|s:48:\"http://localhost:81/mypulse/main/system_settings\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('r230tfupbe1ub644hcchbhvaf598bdmt', '::1', 1547532337, '__ci_last_regenerate|i:1547532335;site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";last_page|s:42:\"http://localhost:81/mypulse/main/dashboard\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('s9d3pc0c3k9tf3vc67eia7s3vga4pn0f', '::1', 1547501792, '__ci_last_regenerate|i:1547501792;last_page|s:48:\"http://localhost:81/mypulse/main/system_settings\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('sgjns2ra2o2nvadoc4d63dm58l397ai8', '::1', 1547495868, '__ci_last_regenerate|i:1547495868;last_page|s:42:\"http://localhost:81/mypulse/main/dashboard\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('so1j36na5bh97tgt2j9thd6avob7drv1', '::1', 1547503318, '__ci_last_regenerate|i:1547503318;last_page|s:39:\"http://localhost:81/mypulse/main/doctor\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";last_page1|s:54:\"http://localhost:81/mypulse/main/doctor_availability/1\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('t79nopdurvlrf3pn9ver2ignvjlnp1ih', '::1', 1547503957, '__ci_last_regenerate|i:1547503957;last_page|s:39:\"http://localhost:81/mypulse/main/doctor\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";last_page1|s:54:\"http://localhost:81/mypulse/main/doctor_availability/1\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('tcupvp70ausks2n01rb2gnrkenkq4tcn', '::1', 1547499079, '__ci_last_regenerate|i:1547499079;last_page|s:42:\"http://localhost:81/mypulse/main/dashboard\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('un1utarujlu2lveq781to1slugpluirv', '::1', 1547496218, '__ci_last_regenerate|i:1547496218;last_page|s:42:\"http://localhost:81/mypulse/main/dashboard\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('vbtgm874o1bfja9hgl8rd8l27bp4fadi', '::1', 1547502134, '__ci_last_regenerate|i:1547502134;last_page|s:48:\"http://localhost:81/mypulse/main/system_settings\";site_lang|s:7:\"english\";menu|a:48:{s:14:\"main_dashboard\";s:9:\"Dashboard\";s:14:\"main_hospitals\";s:9:\"Hospitals\";s:12:\"main_dectors\";s:7:\"Doctors\";s:16:\"main_departments\";s:11:\"Departments\";s:13:\"main_branches\";s:8:\"Branches\";s:10:\"main_wards\";s:5:\"Wards\";s:9:\"main_beds\";s:4:\"Beds\";s:11:\"main_nurses\";s:6:\"Nurses\";s:18:\"main_receptionists\";s:13:\"Receptionists\";s:13:\"main_patients\";s:8:\"Patients\";s:19:\"main_medical_stores\";s:14:\"Medical Stores\";s:17:\"main_medical_labs\";s:12:\"Medical Labs\";s:17:\"main_appointments\";s:12:\"Appointments\";s:13:\"main_payments\";s:8:\"Payments\";s:12:\"main_reports\";s:7:\"Reports\";s:13:\"main_services\";s:8:\"Services\";s:14:\"main_ambulance\";s:9:\"Ambulance\";s:14:\"main_bood_bank\";s:10:\"Blood Bank\";s:14:\"main_insurance\";s:9:\"Insurance\";s:11:\"noticeboard\";s:11:\"Noticeboard\";s:13:\"main_settings\";s:8:\"Settings\";s:21:\"main_general_settings\";s:16:\"General Settings\";s:17:\"language_settings\";s:17:\"Language Settings\";s:12:\"sms_settings\";s:12:\"SMS Settings\";s:15:\"system_settings\";s:15:\"System Settings\";s:21:\"main_license_category\";s:17:\"License Categorys\";s:12:\"main_charges\";s:7:\"Charges\";s:7:\"profile\";s:7:\"Profile\";s:6:\"logout\";s:7:\"Log out\";s:14:\"changePassword\";s:15:\"Change Password\";s:11:\"appoitments\";s:11:\"Appoitments\";s:28:\"main_healthinsuranceprovider\";s:26:\"Health Insurance Providers\";s:22:\"main_inpatient_history\";s:18:\"In-Patient History\";s:14:\"main_inpatient\";s:11:\"In-Patients\";s:19:\"main_hospital_admin\";s:15:\"Hospital Admins\";s:17:\"main_availability\";s:12:\"Availability\";s:10:\"main_other\";s:6:\"Others\";s:10:\"main_about\";s:5:\"About\";s:7:\"reports\";s:7:\"Reports\";s:6:\"orders\";s:6:\"Orders\";s:19:\"main_patient_report\";s:14:\"Patient Report\";s:22:\"main_appoitment_report\";s:17:\"Appoitment Report\";s:12:\"mypulseusers\";s:13:\"MyPulse Users\";s:12:\"main_account\";s:7:\"Account\";s:12:\"main_country\";s:8:\"Countrys\";s:10:\"main_state\";s:6:\"States\";s:13:\"main_district\";s:9:\"Districts\";s:9:\"main_city\";s:5:\"Citys\";}login|s:1:\"1\";login_user_id|s:1:\"1\";unique_id|s:13:\"MPSA18_100001\";name|s:5:\"Super\";login_type|s:10:\"superadmin\";type_id|s:10:\"superadmin\";');


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
  `status` tinyint(4) NOT NULL COMMENT '1=active,2=inactive',
  PRIMARY KEY (`department_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `department` (`department_id`, `hospital_id`, `branch_id`, `name`, `description`, `status`) VALUES (1, 2, 1, 'Department1', '', 0);
INSERT INTO `department` (`department_id`, `hospital_id`, `branch_id`, `name`, `description`, `status`) VALUES (2, 1, 2, 'D2', '', 0);


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
  PRIMARY KEY (`doctor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `doctors` (`doctor_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `address`, `phone`, `description`, `gender`, `dob`, `aadhar`, `qualification`, `specializations`, `experience`, `registration`, `hospital_id`, `branch_id`, `department_id`, `country`, `state`, `district`, `city`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`) VALUES (1, 'MPD19_100001', 'Doctor 1', 'Doctor 1', 'Doctor 1', 'd1@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '', '1231231235', 'Doctor 1 for hospital 1', '', '', '', '', '1,3', '', '', 1, 2, 2, 0, 0, 0, 0, 1, 2, 1, '2019-01-09 12:58:59', '2019-01-09 12:58:59');
INSERT INTO `doctors` (`doctor_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `address`, `phone`, `description`, `gender`, `dob`, `aadhar`, `qualification`, `specializations`, `experience`, `registration`, `hospital_id`, `branch_id`, `department_id`, `country`, `state`, `district`, `city`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`) VALUES (2, 'MPD19_100002', 'Doctor2', 'Doctor 2', 'Doctor2', 'd2@g.com', 'e5a1b2af03e9efe769bd8398475bb091f3356c3e', '', '1421421422', 'Doctor 2', '', '', '', '', '', '', '', 2, 1, 1, 0, 0, 0, 0, 2, 2, 1, '2019-01-14 11:46:29', '2019-01-14 11:46:29');


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
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `hospitaladmins` (`admin_id`, `unique_id`, `hospital_id`, `name`, `mname`, `lname`, `email`, `password`, `phone`, `address`, `country`, `state`, `district`, `city`, `aadhar`, `gender`, `dob`, `qualification`, `profession`, `experience`, `description`, `last_login`, `last_logout`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`) VALUES (1, 'MPHA19_100001', 1, 'Hospital Admin1', '', 'Admin', 'ha1@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '8121815502', '', 0, 0, 0, 0, '', '', '', '', '', '', 'Admin For Hospital 1', '', '', 1, 2, 1, '2019-01-14 08:17:31', '2019-01-14 08:17:31');
INSERT INTO `hospitaladmins` (`admin_id`, `unique_id`, `hospital_id`, `name`, `mname`, `lname`, `email`, `password`, `phone`, `address`, `country`, `state`, `district`, `city`, `aadhar`, `gender`, `dob`, `qualification`, `profession`, `experience`, `description`, `last_login`, `last_logout`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`) VALUES (2, 'MPHA19_100002', 2, 'Ha2', 'Ha2', 'Ha2', 'ha2@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '1421421423', '', 0, 0, 0, 0, '', '', '', '', '', '', 'Ha2', '', '', 1, 2, 1, '2019-01-14 14:46:01', '2019-01-14 14:46:01');


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
  `logo` varchar(250) DEFAULT NULL,
  `background_image` varchar(250) NOT NULL,
  `phone_number` text,
  `email` varchar(300) DEFAULT NULL,
  `license_category` varchar(250) DEFAULT NULL,
  `slug` varchar(250) NOT NULL,
  `city` varchar(250) DEFAULT NULL,
  `district` varchar(250) DEFAULT NULL,
  `state` varchar(250) DEFAULT NULL,
  `country` varchar(250) DEFAULT NULL,
  `md_name` varchar(250) NOT NULL,
  `md_contact_number` varchar(250) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '0',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL COMMENT '1=active,2=inactive',
  `license` varchar(100) NOT NULL,
  `license_status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=active,2=inactive',
  `from_date` varchar(100) NOT NULL,
  `till_date` varchar(100) NOT NULL,
  PRIMARY KEY (`hospital_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `hospitals` (`hospital_id`, `unique_id`, `name`, `address`, `description`, `logo`, `background_image`, `phone_number`, `email`, `license_category`, `slug`, `city`, `district`, `state`, `country`, `md_name`, `md_contact_number`, `isActive`, `isDeleted`, `created_at`, `modified_at`, `status`, `license`, `license_status`, `from_date`, `till_date`) VALUES (1, 'MPH19_100001', 'Hospital 1', 'Ha1', 'Hospital Number 1', NULL, '', '1231231231', 'ha1@g.com', NULL, '', '1', '1', '2', '1', 'HA', '1231231231', 0, 0, '2019-01-14 14:44:12', '2019-01-08 17:19:55', 1, '2', 1, '01/08/2019', '01/14/2020');
INSERT INTO `hospitals` (`hospital_id`, `unique_id`, `name`, `address`, `description`, `logo`, `background_image`, `phone_number`, `email`, `license_category`, `slug`, `city`, `district`, `state`, `country`, `md_name`, `md_contact_number`, `isActive`, `isDeleted`, `created_at`, `modified_at`, `status`, `license`, `license_status`, `from_date`, `till_date`) VALUES (2, 'MPH19_100002', 'Hospital2', 'Ha2', 'Hospital Number 2', NULL, '', '1231231232', 'ha2@g.com', NULL, '', '3', '2', '32', '1', 'HA2', '1231231232', 0, 0, '2019-01-14 13:12:43', '2019-01-08 17:23:26', 1, '1', 1, '01/09/2019', '01/14/2020');


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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `inpatient` (`id`, `user_id`, `bed_id`, `hospital_id`, `doctor_id`, `join_date`, `discharged_date`, `reason`, `status`, `created_by`, `created_date`, `modified_date`, `show_status`) VALUES (1, 2, 1, 1, 1, '2019-01-12 15:35:32', NULL, 'Normal', 1, 'superadmin-superadmin-1', '2019-01-12 15:35:32', '', 1);


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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `inpatient_history` (`id`, `in_patient_id`, `created_date`, `note`, `cost`, `isDeleted`) VALUES (1, 1, '2019-01-12 15:35:32', 'Joined As In-Patient and Status as Admitted.', '0', 0);


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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `license` (`license_id`, `license_category_id`, `license_code`, `name`, `description`) VALUES (1, 1, 'LAA', 'LAAA', 'Laa');
INSERT INTO `license` (`license_id`, `license_category_id`, `license_code`, `name`, `description`) VALUES (2, 2, 'HAA', 'HAA', 'HAA');


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
  PRIMARY KEY (`lab_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `medicallabs` (`lab_id`, `unique_id`, `name`, `description`, `address`, `phone`, `owner_name`, `owner_mobile`, `hospital`, `branch`, `fname`, `lname`, `email`, `password`, `aadhar`, `gender`, `dob`, `in_address`, `profession`, `qualification`, `experience`, `in_mobile`, `country`, `state`, `district`, `city`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`) VALUES (1, 'MPL19_100001', 'Medical Lab1', 'Medical Lab1', 'Medical Lab1', '1231231230', 'Medical Lab1', '1231231230', 1, 2, '', '', 'l1@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 1, 2, 1, '2019-01-09 12:59:54', '2019-01-09 12:59:54');
INSERT INTO `medicallabs` (`lab_id`, `unique_id`, `name`, `description`, `address`, `phone`, `owner_name`, `owner_mobile`, `hospital`, `branch`, `fname`, `lname`, `email`, `password`, `aadhar`, `gender`, `dob`, `in_address`, `profession`, `qualification`, `experience`, `in_mobile`, `country`, `state`, `district`, `city`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`) VALUES (2, 'MPL19_100002', 'Medical Lab2', 'Medical Lab2', 'Medical Lab2', '1231231222', 'Medical Lab2', '1231231222', 2, 1, '', '', 'l2@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 1, 2, 1, '2019-01-09 12:59:58', '2019-01-09 12:59:58');


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
  PRIMARY KEY (`store_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `medicalstores` (`store_id`, `unique_id`, `name`, `description`, `address`, `phone`, `owner_name`, `owner_mobile`, `hospital`, `branch`, `fname`, `lname`, `email`, `password`, `aadhar`, `gender`, `dob`, `in_address`, `profession`, `qualification`, `experience`, `country`, `state`, `district`, `city`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`) VALUES (1, 'MPS19_100001', 'Medical Store1', 'Medical Store1', 'Medical Store1', '1231231238', 'Medical Store1', '1231231238', 1, 2, '', '', 's1@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '', '', '', '', '', '', '', 0, 0, 0, 0, 1, 2, 1, '2019-01-09 13:00:17', '2019-01-09 13:00:17');
INSERT INTO `medicalstores` (`store_id`, `unique_id`, `name`, `description`, `address`, `phone`, `owner_name`, `owner_mobile`, `hospital`, `branch`, `fname`, `lname`, `email`, `password`, `aadhar`, `gender`, `dob`, `in_address`, `profession`, `qualification`, `experience`, `country`, `state`, `district`, `city`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`) VALUES (2, 'MPS19_100002', 'Medical Store2', 'Medical Store2', 'Medical Store2', '1231231239', 'Medical Store2', '1231231239', 2, 1, '', '', 's2@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '', '', '', '', '', '', '', 0, 0, 0, 0, 1, 2, 1, '2019-01-09 13:00:20', '2019-01-09 13:00:20');


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `messages` (`message_id`, `created_by`, `group_ids`, `user_ids`, `hospital_id`, `title`, `message`, `is_read`, `created_at`) VALUES (1, 'superadmin-superadmin-1', NULL, 'doctors-doctor-1', 0, 'D1', 'D1', 'doctors-doctor-1', '2019-01-13 22:53:04');


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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO `notification` (`id`, `created_by`, `user_id`, `title`, `text`, `isRead`, `action`, `created_at`, `isDeleted`) VALUES (13, '', 'doctors-doctor-1', 'Today Appointments : 1', 'You have 1 Appointments Today.', 2, NULL, '2019-01-15 11:39:13', 0);
INSERT INTO `notification` (`id`, `created_by`, `user_id`, `title`, `text`, `isRead`, `action`, `created_at`, `isDeleted`) VALUES (3, '', 'doctors-doctor-1', 'Today Appointments : 0', 'You have 0 Appointments Today.', 1, NULL, '2019-01-13 19:01:24', 0);
INSERT INTO `notification` (`id`, `created_by`, `user_id`, `title`, `text`, `isRead`, `action`, `created_at`, `isDeleted`) VALUES (4, '', 'doctors-doctor-1', 'Today Appointments : 0', 'You have 0 Appointments Today.', 2, NULL, '2019-01-13 19:03:44', 0);
INSERT INTO `notification` (`id`, `created_by`, `user_id`, `title`, `text`, `isRead`, `action`, `created_at`, `isDeleted`) VALUES (5, '', 'doctors-doctor-1', 'Today Appointments : 0', 'You have 0 Appointments Today.', 2, NULL, '2019-01-13 19:03:59', 0);
INSERT INTO `notification` (`id`, `created_by`, `user_id`, `title`, `text`, `isRead`, `action`, `created_at`, `isDeleted`) VALUES (6, '', 'doctors-doctor-1', 'Today Appointments : 0', 'You have 0 Appointments Today.', 2, NULL, '2019-01-13 19:06:21', 0);
INSERT INTO `notification` (`id`, `created_by`, `user_id`, `title`, `text`, `isRead`, `action`, `created_at`, `isDeleted`) VALUES (7, '', 'doctors-doctor-1', 'Today Appointments : 0', 'You have 0 Appointments Today.', 2, NULL, '2019-01-13 19:11:40', 0);
INSERT INTO `notification` (`id`, `created_by`, `user_id`, `title`, `text`, `isRead`, `action`, `created_at`, `isDeleted`) VALUES (10, '', 'doctors-doctor-1', 'Today Appointments : 1', 'You have 1 Appointments Today.', 1, NULL, '2019-01-14 13:08:40', 0);
INSERT INTO `notification` (`id`, `created_by`, `user_id`, `title`, `text`, `isRead`, `action`, `created_at`, `isDeleted`) VALUES (11, '', 'doctors-doctor-1', 'Today Appointments : 1', 'You have 1 Appointments Today.', 1, NULL, '2019-01-14 13:08:49', 0);


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
  PRIMARY KEY (`nurse_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `nurse` (`nurse_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `address`, `hospital_id`, `branch_id`, `department_id`, `doctor_id`, `country`, `state`, `district`, `city`, `description`, `gender`, `dob`, `aadhar`, `qualification`, `experience`, `phone`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`) VALUES (1, 'MPN19_100001', 'Nurse1', '', 'Nurse1', 'n1@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '', 1, 2, 0, '1', 0, 0, 0, 0, 'Nurse For All Departments', '', '', '', '', '', '1231231237', 1, 2, 1, '2019-01-14 11:47:33', '2019-01-14 11:47:33');


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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `patient` (`id`, `hospital_ids`, `doctor_ids`, `lab_ids`, `store_ids`, `user_id`) VALUES (1, '', '', '', '', 1);
INSERT INTO `patient` (`id`, `hospital_ids`, `doctor_ids`, `lab_ids`, `store_ids`, `user_id`) VALUES (2, '1', '1', '', '', 2);


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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`receptionist_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `receptionist` (`receptionist_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `address`, `hospital_id`, `branch_id`, `department_id`, `doctor_id`, `country`, `state`, `district`, `city`, `description`, `gender`, `dob`, `aadhar`, `qualification`, `experience`, `phone`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`) VALUES (1, 'MPR19_100001', 'Receptionist1', '', 'Receptionist1', 'r1@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '', 1, 2, 0, '1', 0, 0, 0, 0, 'Receptionist For all Departments', '', '', '', '', '', '1231231236', 1, 2, 1, '2019-01-09 13:00:57', '2019-01-09 13:00:57');


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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (1, 'system_name', 'MyPulse');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (2, 'system_title', 'MyPulse');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (3, 'address', 'India');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (4, 'phone', '77556555656');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (5, 'paypal_email', '');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (6, 'currency', '');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (7, 'system_email', 'mypulsecare@gmail.com');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (8, 'buyer', '[ your-codecanyon-username-here ]');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (9, 'purchase_code', '[ your-purchase-code-here ]');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (11, 'language', 'spanish');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (12, 'text_align', '');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (13, 'system_currency_id', '1');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (14, 'clickatell_user', 'jagrums');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (15, 'clickatell_password', 'icFxi9pn');
INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES (16, 'clickatell_api_id', '5112759398755747740');
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
  PRIMARY KEY (`superadmin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `superadmin` (`superadmin_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `phone`, `description`, `address`, `gender`, `dob`, `country`, `state`, `district`, `city`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`) VALUES (1, 'MPSA18_100001', 'Super', '', 'Admin', 'sa@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '8121815502', '', '', '', '', 0, 0, 0, 0, 1, 1, 1, '2019-01-08 13:52:19', '2019-01-08 13:52:19');


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
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`) VALUES (1, 'MPU19_100001', 'Mypulse User 1', 'Mypulse User 1', 'Mypulse User 1', 'maheshbt8@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Mypulse User 1', 1, 2, 1, 1, '', '7777777777', 'male', '01/31/2000', 18, '', 'A+', '', 0, '', '5.6', '59', '120', '100', 'mahi', 'no', 'not', 'not', 1, 1, 2, 1, '2019-01-12 13:28:42', '2019-01-12 13:28:42');
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`) VALUES (2, 'MPU19_100002', 'Mypulse User 2', 'Mypulse User 2', 'Mypulse User 2', 'u2@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'Mypulse User 2', 1, 2, 1, 2, 'Mypulse User 2', '7777777771', 'female', '12/30/1998', 20, '', 'A-', '', 0, '', '5.6', '59', '120', '100', 'mahi', 'no', 'Nothing', 'not', 1, 1, 2, 1, '2019-01-09 13:01:30', '2019-01-09 13:01:30');
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`) VALUES (3, 'MPU19_100003', 'Mypulse User 3', 'Mypulse User 3', 'Mypulse User 3', 'u3@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'Mypulse User 3', 1, 2, 1, 1, 'Mypulse User 3', '7777777772', '', '06/02/1999', 19, '', 'B+', '', 0, '', '5.5', '69', '120', '100', 'mahi', 'no', 'not', 'not', 1, 1, 2, 1, '2019-01-12 10:50:51', '2019-01-12 10:50:51');
INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`) VALUES (4, 'MPU19_100004', 'Mypulse User 4', 'Mypulse User 4', 'Mypulse User 4', 'u4@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'Mypulse User 4', 1, 32, 2, 4, 'Mypulse User 4', '7777777773', 'male', '12/26/1988', 30, '', 'B-', '', 0, '', '5.6', '69', '120', '100', 'mahi', '1222', 'not', 'not', 1, 1, 2, 1, '2019-01-09 13:01:36', '2019-01-09 13:01:36');


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
  `status` tinyint(4) NOT NULL COMMENT '1=active,2=inactive',
  PRIMARY KEY (`ward_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `ward` (`ward_id`, `hospital_id`, `branch_id`, `department_id`, `name`, `description`, `status`) VALUES (1, 1, 2, 2, 'Ward1', '', 0);


