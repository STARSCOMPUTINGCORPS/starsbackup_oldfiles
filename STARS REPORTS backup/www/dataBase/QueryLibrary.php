<?php

class QueryLibrary
{
	/** 
	*  			Remote Queries Section (Currently Being Used)
	*
	*			Select statement to pull all users on STARS Community Website
	*			Note: Other queries will have to be run from the Specific Remote Queries Section below to get user information
	*			profile_id 3 = Student, 1 = Faculty, 5 = Alumnus, 0 = Other, 4 = Special  ??
	**/
	
	public static $user_all = 'SELECT
users.uid AS user_id,
realname AS real_name,
mail AS email,
users.created AS register_date,
access AS last_visit_date,
users.uid AS profile_id,
field_current_major___value AS major,
field_stars_member_type___value AS member_type,
field_u_s_citizen_value AS citizenship,
field_year_value AS current_level
FROM `users`
INNER JOIN realname ON realname.uid = users.uid
INNER JOIN `field_data_field_stars_member_type__` ON users.uid=field_data_field_stars_member_type__.entity_id
INNER JOIN `field_data_field_current_major__` ON users.uid=field_data_field_current_major__.entity_id
INNER JOIN `field_revision_field_u_s_citizen` ON users.uid=field_revision_field_u_s_citizen.entity_id
INNER JOIN `field_revision_field_year` ON users.uid=field_revision_field_year.entity_id
ORDER BY user_id ASC';
	
	//This is to get all other user fields not available in above query
	
	public static $full_query = "SELECT
users.uid AS user_id, field_gender___value AS gender,
field_graduation_year___value AS graduation_year,
field_school___value AS school,
field_current_major___value AS major,
field_ethnicity___value AS ethnicity,
field_overall_gpa___value AS gpa,
field_semesters_in_stars___value AS semesters_in_stars,
field_stars_member_type___value AS member_type,
field_u_s_citizen_value AS citizenship,
field_year_value AS current_level
FROM `users` 
INNER JOIN `field_revision_field_gender__` ON users.uid=field_revision_field_gender__.entity_id
INNER JOIN `field_revision_field_graduation_year__` ON users.uid=field_revision_field_graduation_year__.entity_id
INNER JOIN `field_revision_field_school__` ON users.uid=field_revision_field_school__.entity_id
INNER JOIN `field_data_field_current_major__` ON users.uid=field_data_field_current_major__.entity_id
INNER JOIN `field_data_field_ethnicity__` ON users.uid=field_data_field_ethnicity__.entity_id
INNER JOIN `field_data_field_overall_gpa__` ON users.uid=field_data_field_overall_gpa__.entity_id
INNER JOIN `field_data_field_semesters_in_stars__` ON users.uid=field_data_field_semesters_in_stars__.entity_id
INNER JOIN `field_data_field_stars_member_type__` ON users.uid=field_data_field_stars_member_type__.entity_id
INNER JOIN `field_revision_field_u_s_citizen` ON users.uid=field_revision_field_u_s_citizen.entity_id
INNER JOIN `field_revision_field_year` ON users.uid=field_revision_field_year.entity_id
WHERE field_revision_field_gender__.entity_type='user' AND users.uid=:user_id";
	
	public static $getMemberData = "SELECT `id`, `real_name`, `school`, `email` FROM `memberData` WHERE `user_id` = :user_id AND `real_name` = :real_name AND `school` = :school";

}
?>