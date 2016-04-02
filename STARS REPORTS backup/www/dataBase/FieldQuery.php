<?php
class FieldQuery
{
	public static function getFieldData($array_data)
	{		
		include_once 'SetupMysql.php';
		include_once 'InsertLibrary.php';
		include_once 'QueryLibrary.php';
		
		$remotePDO = null;
		$tempLocalPDO = null;
		$tempQuery = null;
		$userNum = $array_data[':user_id'];
		
		//these are the fields for each user
		$gender = '';					//field_id = 2
		$graduation = '';				//field_id = 15
		$school = '';					//field_id = 17
		$ethnicity = '';				//field_id = 19
		$age = '';						//field_id = 21
		$gpa = '';						//field_id = 22
		$semesters = '';				//field_id = 23
		$current = '';					//field_id = 24
		$returning = '';				//field_id = 25
		$citizenship = '';				//field_id = 31
		$participant_research_consent = '';				//field_id = 41
		
		$remotePDO = SetupMysql::getRemotePDO();
		$remotePDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$q = QueryLibrary::$full_query;
		$remQuery = $remotePDO->prepare($q);
		$remQuery->bindParam(':user_id', $userNum, PDO::PARAM_INT);
		$remQuery->execute();
		$result = $remQuery->fetch();

		$gender = trim($result['gender']);
		$graduation = (int)$result['graduation_year'];
		$school = trim($result['school']);
		$ethnicity = trim($result['ethnicity']);
		$age = '';
		$gpa = round($result['gpa'], 1);
		$semesters = $result['semesters_in_stars'];
		$current = trim($result['current_level']);
		$returning = '';
		$citizenship = trim($result['citizenship']);
		$participant_research_consent = '';
		
		if($graduation == 0 && $array_data[':profile_type'] == "Student")  //ensuring graduation is set properly or at least closely
		{
			switch ($current)
			{
				case "Freshman":
					$graduation = date('Y')+4;
					break;
				case "Sophomore":
					$graduation = date('Y')+3;
					break;
				case "Junior":
					$graduation = date('Y')+2;
					break;
				case "Senior":
					$graduation = date('Y')+1;
					break;
				case "Masters":
					$graduation = date('Y')+1;
					break;
				case "PhD":
					$graduation = date('Y');
					break;
				default:
					$graduation = "-1";
			}
		}
		
		$semestersArray = array();
		$semesters = rtrim($semesters, ",");
		$semestersArray = explode(",", $semesters);
		$semester_count = count($semestersArray);

		if(in_array("Not applicable (Just starting),", $semestersArray))
		{
			$semesterStart = "Not applicable (Just starting)";
			break;
		}
		else
		{
			$semesterStart = $semestersArray[0];
		}
		
		$array_data[':last_updated'] = date("Y-m-d H:i:s");		
		$array_data[':gender'] = $gender;
		$array_data[':graduation_year'] = $graduation;
		$array_data[':school'] = $school;
		$array_data[':ethnicity'] = $ethnicity;
		$array_data[':age'] = $age;
		$array_data[':gpa'] = $gpa;
		$array_data[':semesters_participated'] = $semesters;
		$array_data[':first_semester'] = $semesterStart;
		$array_data[':number_semesters'] = $semester_count;
		$array_data[':current_level'] = $current;
		$array_data[':returning_student'] = $returning;
		$array_data[':citizenship'] = $citizenship;
		$array_data[':participant_research_consent'] = $participant_research_consent;
		
		if($tempLocalPDO === null && $tempQuery === null)
		{
			$tempQuery = SetupMysql::getLocalPDO();
			$tempQuery->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$r = QueryLibrary::$getMemberData;		
			$statement = $tempQuery->prepare($r);
			$statement->execute(array(':user_id' => $array_data[':user_id'], ':real_name' => $array_data[':real_name'], ':school' => $array_data[':school']));
			$res = $statement->fetchAll();
			
			if($res)
			{	
				$tempLocalPDO = SetupMysql::getLocalPDO();
				$tempLocalPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$r = InsertLibrary::$memberDataUpdate;		
				$stmt = $tempLocalPDO->prepare($r);
				$stmt->execute($array_data);
			}
			else
			{
				$tempLocalPDO = SetupMysql::getLocalPDO();
				$tempLocalPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$r = InsertLibrary::$memberDataInsert;		
				$stmt = $tempLocalPDO->prepare($r);
				$stmt->execute($array_data);
			}
		}
		
	
		$tempQuery = null;
		
		$tempLocalPDO = null;
		
		$remotePDO = null;
	}

	
	
	public static function setProfileType($prof)  		//Used to change from number to name based on their profile_id
	{
		$identity = 'Unknown';							//this means the profile_id for the user is set to some other number than those listed below
		
		
		switch($prof)									//setting this up as an 'if-else' statement doesn't work. Must use a switch statement.
		{												//cases are "3" = Student, "1" = Faculty, "5" = Alumnus, "0" = Other, "4" = Non-STARS Member or Guest
			case "0":
				$identity = 'Other';
				break;
			case "1":
				$identity = 'Faculty/Staff';
				break;
			case "3":
				$identity = 'Student';
				break;
			case "4":
				$identity = 'Non-STARS Member or Guest';
				break;
			case "5":
				$identity = 'Alumni';
				break;
		}
		
		return $identity;								//this will return the actual string profile type of this user
	}
	
	public static function fixName($real_name)  		//This function is designed to ensure names are clean.
	{
		$fName = "";		//for name manipulation
		$lName = "";		//for name manipulation
		$mName = "";		//for name manipulation
		$frontTitle = "";	//for name manipulation
		$endTitle = "";		//for name manipulation
		
		//This set of if statements is designed to trim up and correct people who can't type or do dumb stuff : )
		
		$real_name = trim($real_name, " ");
		$names = array();
		$names = explode(" ", $real_name);
		$num =  count($names);
		
		if($num == 1)
		{
			$fName = $names[0];
			$lName = "";
		}				
		else if($num == 2)
		{
			$fName = $names[0];
			$lName = $names[1];
		}
		else if ($num == 3)
		{
			$fName = $names[0];
			$mName = $names[1];
			$lName = $names[2];
			
			if($fName == "Dr." || $fName == "Dr")
			{
				$frontTitle = $fName;
				$fName = $names[1];
				$mName = "";
			}
				
			if($lName == "Jr." || $lName == "PhD" || $lName == "II" || $lName == "Jr" || $lName == "III")
			{
				$endTitle = $lName;
				$lName = $names[1];
				$mName = "";
			}
		}
		else if ($num == 4)
		{
			$fName = $names[0];
			$mName = $names[1].' '.$names[2];
			$lName = $names[3];
		
			if($lName == "Jr." || $lName == "PhD" || $lName == "II" || $lName == "Jr")
			{
				$endTitle = $lName;
				$lName = $names[2];
				$mName = $names[1];
			}
		}
		else if ($num > 4 )
		{
			echo "Why does anyone have 5 name parts?";
		}
		
		//trim white space at beginning and end, set the whole word to lower case first, then set upper case on 1st character 
		
		$frontTitle = trim($frontTitle, " ");
		$frontTitle = strtolower($frontTitle);
		$frontTitle = ucfirst($frontTitle);
		
		$endTitle = trim($endTitle, " ");
		$endTitle = strtolower($endTitle);
		$endTitle = ucfirst($endTitle);
		
		$fName = trim($fName, " ");
		$fName = strtolower($fName);
		$fName = ucfirst($fName);
		
		$mName = trim($mName, " ");
		$mName = strtolower($mName);
		$mName = ucfirst($mName);
		
		$lName = trim($lName, " ");
		$lName = strtolower($lName);
		$lName = ucfirst($lName);
		
		//if-else set is designed to put the name back together properly
		
		if($frontTitle == "" && $endTitle == "" && $mName == "")
		{
			$real_name = $fName." ".$lName;
		}
		else if($frontTitle == "" && $endTitle == "")
		{
			$real_name = $fName." ".$mName." ".$lName;
		}
		else if($mName == "" && $endTitle == "")
		{
			$real_name = $frontTitle." ".$fName." ".$lName;
		}
		else if($frontTitle == "" && $mName == "")
		{
			$real_name = $fName." ".$lName." ".$endTitle;
		}
		else if($mName == "")
		{
			$real_name = $frontTitle." ".$fName." ".$lName." ".$endTitle;
		}
		else if($frontTitle == "")
		{
			$real_name = $fName." ".$mName." ".$lName." ".$endTitle;
		}
		else if($endTitle == "")
		{
			$real_name = $frontTitle." ".$fName." ".$mName." ".$lName;
		}
		$name_array = array();
		$name_array[':first_name'] = $fName;
		$name_array[':middle_name'] = $mName;
		$name_array[':last_name'] = $lName;
		$real_name = trim($real_name, " ");
		$name_array[':real_name'] = $real_name;
		
		return $name_array;	
		
	}
}
?>