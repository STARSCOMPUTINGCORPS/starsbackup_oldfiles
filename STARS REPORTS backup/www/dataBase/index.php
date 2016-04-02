<?php
//	Files to include
include_once 'QueryLibrary.php';		
include_once 'SetupMysql.php';
include_once 'InsertLibrary.php';
include_once 'FieldQuery.php';

ini_set('display_errors', 'On');												//error display
error_reporting(E_ALL | E_STRICT);												//enforces strict php coding

	try 
	{	
		$profile_id;															//Set variable for binding
		
		$dbhRemote = SetupMysql::getRemotePDO();								//Setup Remote PDO
		$dbhRemote->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	//sets error modes
		
		$q = QueryLibrary::$user_all;
		$query = $dbhRemote->prepare($q);										//Prepare sql query
		$query->bindParam(':profile_id', $profile_id);							//Bind parameters 
		$query->execute();														//Perform prepared query
		$result = $query->fetchAll();											//Fetches results
		
		foreach($result as $row)												//iterates through to display results of prepared query execution 
		{
			$user_Array = array();
			$user_id = (int)$row['user_id'];
			$real_name = $row['real_name'];
			$nameArray = FieldQuery::fixName($real_name);
			$first_name = $nameArray[':first_name'];
			$middle_name = $nameArray[':middle_name'];
			$last_name = $nameArray[':last_name'];
			$real_name = $nameArray[':real_name'];
			
			$major = $row['major'];
			$email = $row['email'];
			$email = strtolower($email);
			$register_date = $row['register_date'];
			$last_visit_date = $row['last_visit_date'];
			$profile_id = (int)$row['profile_id'];
			$current_level = $row['current_level'];
			$citizenship = $row['citizenship'];
			
			if (strpos($row['member_type'], "Student") !== FALSE)
				$profile_type = 'Student';
			else if (strpos($row['member_type'], "Faculty") !== FALSE)
				$profile_type = 'Faculty/Staff';
			else if (strpos($row['member_type'], "Alumni") !== FALSE)
				$profile_type = 'Alumni';
			else
				$profile_type = 'Other';
			
			
			$user_Array = array(':user_id' => $user_id, ':first_name' => $first_name, ':middle_name' => $middle_name, ':last_name' => $last_name, ':real_name' => $real_name, ':major' => $major, ':email' => $email, ':register_date' => $register_date, ':last_visit_date' => $last_visit_date, ':profile_id' => $profile_id, ':profile_type' => $profile_type, ':current_level' => $current_level, ':citizenship' => $citizenship);
			
			FieldQuery::getFieldData($user_Array);								//this will push user specific info into the DB
		}
		$dbhRemote = null;
	   
		// this redirects the user back to the report homepage
		header("Location: /");  //Root of site
	 
	}
catch(PDOException $e)
    {
		echo $e->getMessage(). '<br/>';
    }
?>
