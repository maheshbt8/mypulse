ALTER TABLE `inpatient` DROP `isDeleted`;
Alter Table `inpatient` Add `show_status` TINYINT NOT NULL DEFAULT '1'  COMMENT '1=show,2=hide' AFTER `show_status`;