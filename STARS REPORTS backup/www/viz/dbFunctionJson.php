<?php
    $dsn = 'mysql:host=localhost;dbname=STARS';
    $username = 'root';
    $password = 'hcilab300';
	
	//sets up the database connection as a PDO
    try 
	{
        $db = new PDO($dsn, $username, $password);
    } 
	catch (PDOException $e) 
	{
		$error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
	
	//The following lines prepare a sql query, execute it and pull the information into an array Row by Row
	$statement =$db->prepare("SELECT profile_type, school, state, gender, ethnicity, current_level FROM memberData WHERE profile_type = 'Student'");
	$statement->execute();
	
	$json_result = array();
	while($tmp = $statement->fetch(PDO::FETCH_ASSOC))
	{
		$json_result[] = $tmp;
	}
	
	//The next 2 lines encodes the array into JSON format
	header('Content-Type: application/json');
	$jsonthingy = json_encode($json_result);
	
	echo $jsonthingy; //WARNING!!: If you omit this line, the visualization will not work at all!
	
	//return $jsonthingy;	//this only applies if you want to put this entire process into a function.

//This code is if you are receiving JSON errors with formatting or other issues:
/*
	//Testing code begins here
	$a = array();
	foreach($results as $k=>$v)
	{
		$a[] = array($k, $v);
		
	}
	var_dump($a);
	$json[]=json_encode($a);
		
	foreach ($json as $temp) {
		echo 'Decoding: ' . $temp;
		json_decode($temp);

		switch (json_last_error()) {
			case JSON_ERROR_NONE:
				echo ' - No errors';
			break;
			case JSON_ERROR_DEPTH:
				echo ' - Maximum stack depth exceeded';
			break;
			case JSON_ERROR_STATE_MISMATCH:
				echo ' - Underflow or the modes mismatch';
			break;
			case JSON_ERROR_CTRL_CHAR:
				echo ' - Unexpected control character found';
			break;
			case JSON_ERROR_SYNTAX:
				echo ' - Syntax error, malformed JSON';
			break;
			case JSON_ERROR_UTF8:
				echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
			break;
			default:
				echo ' - Unknown error';
			break;
		}

		echo PHP_EOL;
	}
*/ //Testing code ends here
?>