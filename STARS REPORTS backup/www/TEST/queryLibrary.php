
<?php
class QueryLibrary{
  public static $user_community = "SELECT * FROM `jos_community_users` WHERE userid = :user_id";									
  // Specific fields									
  public static $user_field_name = "SELECT name FROM `jos_users` WHERE id = :user_id";									
  public static $user_field_email = "SELECT email FROM `jos_users` WHERE id = :user_id";									
  public static $user_field_school = "SELECT value FROM `jos_community_fields_values` WHERE user_id = :user_id AND field_id = 17";									
  public static $user_field_gender = "SELECT value FROM `jos_community_fields_values` WHERE user_id = :user_id AND field_id = 2";									
  public static $user_field_age = "SELECT value FROM `jos_community_fields_values` WHERE user_id = :user_id AND field_id = 21";									
  public static $user_field_ethnicity = "SELECT value FROM `jos_community_fields_values` WHERE user_id = :user_id AND field_id = 19";									
  public static $user_field_current = "SELECT value FROM `jos_community_fields_values` WHERE user_id = :user_id AND field_id = 24";									
  public static $user_field_graduation = "SELECT value FROM `jos_community_fields_values` WHERE user_id = :user_id AND field_id = 15";									
  public static $user_field_gpa = "SELECT value FROM `jos_community_fields_values` WHERE user_id = :user_id AND field_id = 22";									
  public static $user_field_citizenship = "SELECT value FROM `jos_community_fields_values` WHERE user_id = :user_id AND field_id = 31";									
  public static $user_field_returning = "SELECT value FROM `jos_community_fields_values` WHERE user_id = :user_id AND field_id = 25";									
  public static $user_field_semesters = "SELECT value FROM `jos_community_fields_values` WHERE user_id = :user_id AND field_id = 23";									
									
  // Select all Students, Faculty, Alumni									
  // Profile id 3, 1, 5, respectivly									
  public static $user_all = "SELECT userid AS user_id, name AS real_name, email, registerDate AS register_date, lastvisitDate AS last_visit_date, username FROM `jos_community_users` INNER JOIN jos_users ON userid = jos_users.id ORDER BY name ASC";									
  
  public static $student_all = "SELECT userid AS user_id, name AS real_name, email, registerDate AS register_date, lastvisitDate AS last_visit_date, username FROM `jos_community_users` INNER JOIN jos_users ON userid = jos_users.id WHERE profile_id =3 ORDER BY name ASC";									
  public static $faculty_all = "SELECT userid AS user_id, name AS real_name, email, registerDate AS register_date, lastvisitDate AS last_visit_date, username FROM `jos_community_users` INNER JOIN jos_users ON userid = jos_users.id WHERE profile_id =1 ORDER BY name ASC";									
  public static $alumnus_all = "SELECT userid AS user_id, name AS real_name, email, registerDate AS register_date, lastvisitDate AS last_visit_date, username FROM `jos_community_users` INNER JOIN jos_users ON userid = jos_users.id WHERE profile_id =5 ORDER BY name ASC";									
									
  // Groups, parameterized quries, bind the group_id.									
  // Count all Students, Faculty, Alumni									
  // Profile id 3, 1, 5, respectivly									
  public static $group_member_count = "SELECT groupid, COUNT( * ) FROM  `jos_community_groups_members` WHERE groupid = :group_id";									
  public static $group_student_count = "SELECT groupid, COUNT( * ) FROM  `jos_community_groups_members` INNER JOIN jos_community_users ON userid = memberid WHERE profile_id = 3 AND groupid = :group_id";									
  public static $group_faculty_count = "SELECT groupid, COUNT( * ) FROM  `jos_community_groups_members` INNER JOIN jos_community_users ON userid = memberid WHERE profile_id = 1 AND groupid = :group_id";									
  public static $group_alumnus_count = "SELECT groupid, COUNT( * ) FROM  `jos_community_groups_members` INNER JOIN jos_community_users ON userid = memberid WHERE profile_id = 5 AND groupid = :group_id";									
  // Select a Group, bind group_id									
  public static $group = "SELECT * FROM `jos_community_groups` WHERE id = :group_id";									
  // Select all Groups									
  public static $group_all = "SELECT * FROM `jos_community_groups` ORDER BY name ASC";									
}														

 ?>