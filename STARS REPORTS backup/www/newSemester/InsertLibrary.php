<?php
class InsertLibrary
{
	public static $createTempTable = "
	DROP TABLE IF EXISTS `memberDataTemp`;
	CREATE  TABLE `memberDataTemp` (  
	`id` int( 6  )  NOT  NULL  AUTO_INCREMENT  COMMENT  'Unique Identifier for all users',
	`school` varchar( 100  )  NOT  NULL ,
	`state` varchar(25) NOT NULL,
	`profile_id` int( 11  )  DEFAULT NULL  COMMENT  'User type from Community. Student, Faculty, etc.',
	`profile_type` varchar( 30  )  NOT  NULL DEFAULT  'Not Community Member',
	`real_name` varchar( 100  )  NOT  NULL DEFAULT  'Not Provided',
	`email` varchar( 50  )  NOT  NULL DEFAULT  'None Provided',
	`ethnicity` varchar( 60  )  NOT  NULL DEFAULT  'Not Specified',
	`gender` varchar( 15  )  NOT  NULL DEFAULT  'Not Specified',
	`current_level` varchar( 30  )  NOT  NULL DEFAULT  'Not Specified' COMMENT  'Freshman, Junior, Masters, Phd, etc',
	`graduation_year` int( 5  )  NOT  NULL DEFAULT  '0' COMMENT  'From Community',
	`user_id` int( 11  )  NOT  NULL DEFAULT  '0' COMMENT  'Unique User ID from Community',
	`last_visit_date` datetime NOT  NULL DEFAULT  '0000-00-00 00:00:00' COMMENT  'Last Date Member visited community',
	`register_date` datetime NOT  NULL DEFAULT  '0000-00-00 00:00:00' COMMENT  'Community Members registration date',
	`age` int( 3  )  NOT  NULL DEFAULT  '0',
	`gpa` decimal( 2, 1  )  NOT  NULL DEFAULT  '0.0',
	`semesters_participated` text COMMENT  'From Community.',
	`returning_student` varchar( 30  )  NOT  NULL DEFAULT  'Not Specified' COMMENT  'From Community to denote new SLC students versus returning SLC students.',
	`citizenship` varchar( 30  )  NOT  NULL DEFAULT  'Not Specified',
	`first_name` varchar( 30  )  NOT  NULL DEFAULT  'Not Provided' COMMENT  'Pulled from real_name',
	`middle_name` varchar( 30  )  DEFAULT NULL ,
	`last_name` varchar( 30  )  NOT  NULL DEFAULT  'Not Provided' COMMENT  'Pulled from real_name',
	`email2` varchar( 50  )  DEFAULT NULL ,
	`first_semester` varchar( 20  )  DEFAULT NULL  COMMENT  'When member started with STARS.',
	`number_semesters` int( 2  )  DEFAULT NULL ,
	`major` varchar( 50  )  DEFAULT NULL ,
	`last_updated` datetime NOT  NULL DEFAULT  '2013-07-24 18:00:00' COMMENT  'This is the last time the community information was updated.',
	`participant_research_consent` varchar(5) NOT NULL DEFAULT 'None',
	`fall_2012_consent` varchar( 5  )  NOT  NULL DEFAULT  'No',
	`spring_2013_consent` varchar( 5  )  NOT  NULL DEFAULT  'No',
	`notes` text,
	PRIMARY  KEY (  `id`  ) )
	ENGINE  = InnoDB  DEFAULT CHARSET  = latin1 COMMENT  =  'All STARS Members';

	SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';

	INSERT INTO `memberDataTemp` SELECT * FROM `memberData`";
	
	//this has been removed after PRIMARY ID: ,	UNIQUE  KEY  `Unique-Name-Email-School` (  `real_name` ,  `email` ,  `school`  )  )
}

?>
