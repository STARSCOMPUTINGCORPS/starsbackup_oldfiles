<?php
class QueryMap
{

  public static $user_all = "SELECT * FROM `memberData` WHERE 1";
  public static $student_all = "SELECT * FROM `memberData` WHERE `profile_type`='Student'";
  public static $faculty_all = "SELECT * FROM `memberData` WHERE `profile_type`='Faculty/Staff'"; 
  public static $alumnus_all = "SELECT * FROM `memberData` WHERE `profile_type`='Alumni'";

  public static $last_updated = "SELECT MAX(`last_updated`) FROM `memberData`";

  /**
   * Mapping of all query statements.
   * See the Read Me for more details.
   *
   * */

  // All of the user fields for demographics. Faculty fields are a subset of the student fields
  // Parameterized queries, bind the id

  // Community User
  public static $user_community = "SELECT * FROM `memberData` WHERE userid = :id";


  // Specific fields  These queries are used to used to fill the specific fields in each table individually

  public static $user_field_name = "SELECT real_name FROM `memberData` WHERE id = :id";
  public static $user_field_type = "SELECT profile_type FROM `memberData` WHERE id = :id";
  public static $user_field_email = "SELECT email FROM `memberData` WHERE id = :id";
  public static $user_field_email2 = "SELECT email2 FROM `memberData` WHERE id= :id";
  public static $user_field_school = "SELECT school FROM `memberData` WHERE id = :id";
  public static $user_field_gender = "SELECT gender FROM `memberData` WHERE id = :id";
  public static $user_field_age = "SELECT age FROM `memberData` WHERE id = :id";
  public static $user_field_ethnicity = "SELECT ethnicity FROM `memberData` WHERE id = :id";
  public static $user_field_current = "SELECT current_level FROM `memberData` WHERE id = :id";
  public static $user_field_graduation = "SELECT graduation FROM `memberData` WHERE id = :id";
  public static $user_field_gpa = "SELECT gpa FROM `memberData` WHERE id = :id";
  public static $user_field_citizenship = "SELECT citizenship FROM `memberData` WHERE id = :id";
  public static $user_field_returning = "SELECT returning_student FROM `memberData` WHERE id = :id";
  public static $user_field_semesters = "SELECT semesters_participated FROM `memberData` WHERE id = :id";
  public static $user_field_profile_id= "SELECT profile_id FROM `memberData` WHERE id = :id";
  public static $user_field_register_date= "SELECT register_date FROM `memberData` WHERE id = :id AND register_date != '0000-00-00 00:00:00'";
  public static $dashBoard_avg_gpa="SELECT AVG(gpa) FROM `memberData` WHERE `profile_id`=3";
  public static $consent_for_research="SELECT participant_research_consent FROM `memberData` WHERE id = :id";
  public static $user_field_major="SELECT major FROM `memberData` WHERE id = :id";
  public static $user_field_gradYear="SELECT graduation_year FROM `memberData` WHERE id = :id";
  // Select all Students, Faculty, Alumni
  // Profile id 3, 1, 5, respectivly
  /*
  public static $user_all = "SELECT id,real_name, email, register_date, last_visit_date, username FROM `all_stars_members` ORDER BY name ASC";
  public static $student_all = "SELECT id, real_name, email, register_date, last_visit_date, username FROM `memberData` WHERE profile_id =3 ORDER BY name ASC";
  public static $faculty_all = "SELECT id, real_name, email, register_date, last_visit_date, username FROM `memberData` WHERE profile_id =1 ORDER BY name ASC";
  public static $alumnus_all = "SELECT id, real_name, email, register_date, last_visit_date, username FROM `memberData` WHERE profile_id =5 ORDER BY name ASC";
*/

  // Groups, parameterized quries, bind the group_id.
  // Count all Students, Faculty, Alumni
  // Profile id 3, 1, 5, respectivly
  public static $group_member_count = "SELECT COUNT( * ) FROM  `memberData` WHERE groupid = :group_id";
  public static $group_student_count = "SELECT COUNT( * ) FROM  `memberData` WHERE profile_id = 3";
  public static $group_faculty_count = "SELECT COUNT( * ) FROM  `memberData` WHERE profile_id = 1";
  public static $group_alumnus_count = "SELECT COUNT( * ) FROM  `memberData` WHERE profile_id = 5";
  // Select a Group, bind group_id
  public static $group = "SELECT * FROM `memberData` WHERE id = :group_id";
  // Select all Groups
  public static $group_all = "SELECT * FROM `memberData` ORDER BY name ASC";

  
  /****************																			********************
  *				
  *						START Queries for numbers (counting groups of students)
  *
  *
  **/


/**	
*		Queries for Student information
*

**/
	//This is a dynamic query that will pull totals based on Ethnicity, Gender, and role
		public static $countEthnicityGender = 'SELECT COUNT(*) FROM `memberData` WHERE `profile_type`= "%s" AND `ethnicity`="%s" AND `gender`= "%s"';
	//This pulls all members
		public static $totalMembers = 'SELECT COUNT(*) FROM `memberData`';
	//Dynamic Pull totals based on Student, Faculty, or Alumnus
		public static $totalRoleMembers = 'SELECT COUNT(*) FROM `memberData` WHERE `profile_type`="%s"';
	
	
	//The following array is for the dashboard and ONLY dashboard and gives totals
	public static $queryArray=array( 
			0 =>array("name"=>'Average GPA for STARS Students', "query"=>'SELECT AVG(`gpa`) FROM `memberData` WHERE `profile_id` = 3 AND `gpa` != 0.0'),
			1=>array("name"=>'Active Students' ,"query"=>'SELECT COUNT(*) FROM `memberData` WHERE `profile_type` = "Student"'),
		// STUDENT totals by gender
			2=>array("name"=>'Male Students' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `gender` = "Male"'),
			3=>array("name"=>'Female Students' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `gender` = "Female"'),
			//=>array("name"=>'Prefer not to specify gender - Students' ,"query"=>'SELECT COUNT 
		 // African American Students/gender 
			4 =>array("name"=>'African American Students', "query"=>'SELECT COUNT(*) FROM `memberData` WHERE `profile_type` = "Student" AND `ethnicity` = "African American/Black (not of Hispanic origin)"'),
			5=>array("name"=>'African American Male Students' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `ethnicity` = "African American/Black (not of Hispanic origin)" AND `gender` = "Male"'),
			6=>array("name"=>'African American Female Students' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `ethnicity` = "African American/Black (not of Hispanic origin)" AND `gender` = "Female"'),
		 // Hispanic-Latino Student/gender 
			7=>array("name"=>'Hispanic or Latino Students' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `ethnicity` = "Hispanic or Latino"'),
			8=>array("name"=>'Hispanic or Latino Male Students' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `ethnicity` = "Hispanic or Latino" AND `gender` = "Male"'),
			9=>array("name"=>'Hispanic or Latino Female Students' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `ethnicity` = "Hispanic or Latino" AND `gender` = "Female"'),
		 // Caucasian Student/gender 
			10=>array("name"=>'Caucasian Students' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `ethnicity` = "Caucasian/White (not of Hispanic origin)"'),
			11=>array("name"=>'Caucasian Male Students' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `ethnicity` = "Caucasian/White (not of Hispanic origin)" AND `gender` = "Male"'),
			12=>array("name"=>'Caucasian Female Students' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `ethnicity` = "Caucasian/White (not of Hispanic origin)" AND `gender` = "Female"'),
		 // Asian student/gender 
			13=>array("name"=>'Asian Students' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `ethnicity` = "Asian"'),
			14=>array("name"=>'Asian Male Students' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `ethnicity` = "Asian" AND `gender` = "Male"'),
			15=>array("name"=>'Asian Female Students' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `ethnicity` = "Asian" AND `gender` = "Female"'),
		 //Native American-Alaskan student/gender
			16=>array("name"=>'Native American or Native Alaskan Students' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `ethnicity` = "American Indian or Alaskan Native"'),
			17=>array("name"=>'Native American or Native Alaskan Males Students' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `ethnicity` = "American Indian or Alaskan Native" AND `gender` = "Male"'),
			18=>array("name"=>'Native American or Native Alaskan Females Students' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `ethnicity` = "American Indian or Alaskan Native" AND `gender` = "Female"'),
		// Multiracial student/gender 
			19=>array("name"=>'Multiracial Students' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `ethnicity` = "Multiracial or Other"'),
			20=>array("name"=>'Multiracial Male Students' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `ethnicity` = "Multiracial or Other" AND `gender` = "Male"'),
			21=>array("name"=>'Multiracial Female Students' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `ethnicity` = "Multiracial or Other" AND `gender` = "Female"'),
		 // Prefer Not Say Student/gender 
			22=>array("name"=>'Students who Prefer Not to Specify' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND (`ethnicity` = "Prefer not to specify" OR `ethnicity` = "")'),
			23=>array("name"=>'Students who Prefer Not to Specify-Male' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND (`ethnicity` = "Prefer not to specify" OR `ethnicity` = "") AND `gender` = "Male"'),
			24=>array("name"=>'Students who Prefer Not to Specify-Female' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND (`ethnicity` = "Prefer not to specify" OR `ethnicity` = "") AND `gender` = "Female"'),
		 // Academic level 
			25=>array("name"=>'Freshman' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `current_level` = "Freshman"'),
			26=>array("name"=>'Sophomore' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `current_level` = "Sophomore"'),
			27=>array("name"=>'Junior' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `current_level` = "Junior"'),
			28=>array("name"=>'Senior' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `current_level` = "Senior"'),
		// Undergrad 
			29=>array("name"=>'Undergrad' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND (`current_level` = "Freshman" OR `current_level` = "Sophomore" OR `current_level` = "Junior" OR `current_level` = "Senior")'),
		// Masters   
			30=>array("name"=>'Masters' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `current_level` = "Masters"'),
		// PHD       
			31=>array("name"=>'PHD' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Student" AND `current_level` = "Phd"'),
//ERROR-- Totals by School Need to figure out something for this
			//32=>array("name"=>'Totals by School' ,"query"=>'SELECT `school` , COUNT( * ) AS "students_per_school" FROM `memberData` WHERE `profile_type` = "Student" AND ( `current_level` = "Freshman" OR `current_level` = "Sophomore" OR `current_level` = "Junior" OR `current_level` = "Senior" ) GROUP BY `school`'),
		
		// ALUMNUS 
			32=>array("name"=>'Alumnus' ,"query"=>'SELECT COUNT(*) FROM `memberData` WHERE `profile_type` = "Alumni"'),
			33=>array("name"=>'Alumnus Male' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Alumni" AND `gender` = "Male"'),
			34=>array("name"=>'Alumnus Female' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Alumni" AND `gender` = "Female"'),
		// Alumnus Ethnic totals
			35=>array("name"=>'Alumnus African American' ,"query"=>'SELECT COUNT(*) FROM `memberData` WHERE `profile_type` = "Alumni" AND `ethnicity` = "African American/Black (not of Hispanic origin)"'), 
			36=>array("name"=>'Hispanic or Latino Alumn' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Alumni" AND `ethnicity` = "Hispanic or Latino"'),
			37=>array("name"=>'Asian Alumnus' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Alumni" AND `ethnicity` = "Asian"'),
			38=>array("name"=>'American Indian or Alaskan Native Alumnus' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Alumni" AND `ethnicity` = "American Indian or Alaskan Native"'),
			39=>array("name"=>'Multiracial or Other' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Alumni" AND `ethnicity` = "Multiracial or Other"'),
			40=>array("name"=>'Prefer not to specify Alumnus' ,"query"=>'SELECT COUNT( * )  FROM `memberData` WHERE `profile_type` = "Alumni" AND (`ethnicity` = "Prefer not to specify" OR `ethnicity` = "")'),
	//ERROR 
			//41=>array("name"=>'' ,"query"=>'SELECT `school` , COUNT( * ) AS "Number_Alumnus" FROM `memberData` WHERE `profile_type` = "Alumnus" GROUP BY `school`'),
		
		// FACULTY 
			41=>array("name"=>'Faculty', "query"=>'SELECT COUNT(*) FROM `memberData` WHERE `profile_id`=5'),
			42=>array("name"=>'Faculty Male' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_id`=5 AND `gender` = "Male"'),
			43=>array("name"=>'Faculty Female' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_id`=5 AND `gender` = "Female"'),
		// Faculty Ethnic totals 
			44=>array("name"=>'African American Faculty' ,"query"=>'SELECT COUNT(*) FROM `memberData` WHERE `profile_id`=5 AND `ethnicity` = "African American/Black (not of Hispanic origin)"'),
			45=>array("name"=>'Hispanic or Latino Faculty' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_id`=5 AND `ethnicity` = "Hispanic or Latino"'),
			46=>array("name"=>'Caucasian/White Faculty' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_id`=5 AND `ethnicity` = "Caucasian/White (not of Hispanic origin)"'),
			47=>array("name"=>'Asian' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_id`=5 AND `ethnicity` = "Asian"'),
			48=>array("name"=>'American Indian or Alaskan Native' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_id`=5 AND `ethnicity` = "American Indian or Alaskan Native"'),
			49=>array("name"=>'Multiracial or Other' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_id`=5 AND `ethnicity` = "Multiracial or Other"'),
			50=>array("name"=>'Prefer not to specify' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_id`=5 AND (`ethnicity` = "Prefer not to specify" OR `ethnicity` = "")'),
	//ERROR  This will give the totals for faculty by school but the current output method does not handle this query 
			//=>array("name"=>'Faculty' ,"query"=>'SELECT `school` , COUNT( * ) FROM `memberData` WHERE `profile_type` = "Faculty" GROUP BY `school`'),
		// Total combined (Student and Alumnus) - gender 
			51=>array("name"=>'Total of combined Alumnus and Students' ,"query"=>'SELECT COUNT( * ) FROM `memberData` WHERE `profile_type` = "Alumnus" OR `profile_type` = "Student"'),
			//52=>array("name"=>'The Coolest Guy around' ,"query"=>),
	//ERROR  This will give the totals for combined(alumnus and student) by school but the current output method does not handle this query 
			//=>array("name"=>'' ,"query"=>''SELECT `school` , COUNT( * ) FROM `memberData` WHERE `profile_type` = "Alumnus" OR `profile_type` = "Student" GROUP BY `school`'),
		
			//  =>array("name"=>'' ,"query"=>),
			);
			
    

}
