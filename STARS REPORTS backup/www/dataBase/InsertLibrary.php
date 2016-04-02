<?php

class InsertLibrary
{

	/**** 
	*
	*  Local Data Manipulation Section
	*
	***/
	
	public static $memberDataInsert = "INSERT INTO `memberData` (school, major, profile_id, profile_type, real_name, email, ethnicity, gender, current_level, graduation_year, user_id, last_visit_date, register_date, age, gpa, semesters_participated, returning_student, citizenship, first_name, middle_name, last_name, first_semester, number_semesters, last_updated, participant_research_consent) VALUES(:school, :major, :profile_id, :profile_type, :real_name, :email, :ethnicity, :gender, :current_level, :graduation_year, :user_id, :last_visit_date, :register_date, :age, :gpa, :semesters_participated, :returning_student, :citizenship, :first_name, :middle_name, :last_name, :first_semester, :number_semesters, :last_updated, :participant_research_consent) ON DUPLICATE KEY UPDATE school=VALUES(school), profile_id=VALUES(profile_id), profile_type=VALUES(profile_type), real_name=VALUES(real_name), email=VALUES(email), ethnicity=VALUES(ethnicity), gender=VALUES(gender), current_level=VALUES(current_level), graduation_year=VALUES(graduation_year), user_id=VALUES(user_id), last_visit_date=VALUES(last_visit_date), register_date=VALUES(register_date), age=VALUES(age), gpa=VALUES(gpa), semesters_participated=VALUES(semesters_participated), returning_student=VALUES(returning_student), citizenship=VALUES(citizenship), first_name=VALUES(first_name), middle_name=VALUES(middle_name), last_name=VALUES(last_name), first_semester=VALUES(first_semester), number_semesters=VALUES(number_semesters), last_updated=VALUES(last_updated), participant_research_consent=VALUES(participant_research_consent)";
	
	public static $memberDataUpdate = "UPDATE `memberData` SET `school` = :school, `major` = :major, `profile_id` = :profile_id, `profile_type` = :profile_type, `real_name` = :real_name, `email` = :email, `ethnicity` = :ethnicity, `gender` = :gender, `current_level` = :current_level, `graduation_year` = :graduation_year, `user_id` = :user_id, `last_visit_date` = :last_visit_date, `register_date` = :register_date, `age` = :age, `gpa` = :gpa, `semesters_participated` = :semesters_participated, `returning_student` = :returning_student, `citizenship` = :citizenship, `first_name` = :first_name, `middle_name` = :middle_name, `last_name` = :last_name, `first_semester` = :first_semester, `number_semesters` = :number_semesters, `current_level` = :current_level, `citizenship` = :citizenship, `participant_research_consent`= :participant_research_consent,`last_updated` = :last_updated WHERE `user_id` = :user_id AND `real_name` = :real_name AND `school` = :school";
}	
?>
