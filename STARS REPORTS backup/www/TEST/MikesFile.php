<?php
/***
*
*Local Information
*
***/
require('queryLibrary.php');
$hostname = 'localhost';

$database = 'STARS';

$username = 'root';

$password = 'hcilab300';

/**** 
*
* Remote Connection information
*
****/
$dbName = 'starsall_jomsocial';
$dbUser = 'stars_joms';
$dbPass = 'PA:iRM8mh9%j';
$dbHost = 'sc-mysql-1.cuwqsdf6sh6w.us-east-1.rds.amazonaws.com';
$dateFormat = 'Y-m-d\TH-i-s'; // Standard XML time format.
//$password = 'hcilab300+';

/**** 
*
*  Remote Queries
*
***/

/*****  ATTEMPTING TO USE TXT FILE FOR QUERY LIBRARY
$fh = fopen("pullQuery.txt","r") or die($php_errormsg);
if($fh)
{
	 while (!feof($fh))
	 {
	 echo fgets($file). "<br>";
	 $alumnus_all = fgets($fh);
	 }
	 echo $alumnus_all;
	 fclose($fh);
}
******/

$users_all = "SELECT userid AS user_id, name AS real_name, email, registerDate AS register_date, lastvisitDate AS last_visit_date, username FROM `jos_community_users` INNER JOIN jos_users ON userid = jos_users.id ORDER BY name ASC";		

//$alumnus_all = queryLibrary::$alumnus_all;
//$alumnus_all = "SELECT userid AS user_id, name AS real_name, email, registerDate AS register_date, lastvisitDate AS last_visit_date, username FROM `jos_community_users` INNER JOIN jos_users ON userid = jos_users.id WHERE profile_id =5 ORDER BY name ASC";
//$test = "SELECT * FROM `jos_community_users` WHERE profile_id =:profile_id";


/***Actual code ****/

try {
		$dbhLocal = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
		echo 'Connected to local database <br />';
		
		$dbhRemote = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
		echo 'Connected to remote database <br />';
		
		/*** set the PDO error mode to exception ***/
		$dbhLocal->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbhRemote->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
			/****For Table INSERT and CREATE into LOCAL!!! Database from remote  ****/
			$table = "CREATE TABLE IF NOT EXISTS users_all (user_id INT(8) NOT NULL PRIMARY KEY,
			real_name VARCHAR(30) NOT NULL, username VARCHAR(30) NOT NULL, email VARCHAR(30) NOT NULL, register_date VARCHAR(25) NOT NULL, last_visit_date VARCHAR(25) NOT NULL)";
			
			/*** begin the transaction ***/
			$dbhLocal->beginTransaction();
			
			/***CREATION OF TABLE ***/
			$dbhLocal->exec($table);
		
		/***Set variable for bind ***/
		$profile_id;
		
		/*** Prepare sql statement ***/
		$statement = $dbhRemote->prepare($users_all);
		
		/****Bind parameters ****/
		$statement->bindParam(':profile_id', $profile_id, PDO::PARAM_INT);
		
		/****Performed prepared statement  ***/
		$statement->execute();
		/***Fetches results   ***/
		$result = $statement->fetchAll();
		
		/****iterates through to display results of prepared statement execution *****/
		foreach($result as $row)
			{
				/****displays information by row data  ****/
				echo $row['user_id'].$row['real_name'].$row['email'].$row['register_date'].$row['last_visit_date'].$row['username'].'<br>';
				/***Sets up for parametrized variables ***/ 
				$user_id = $row['user_id'];
				$real_name = $row['real_name'];
				$email = $row['email'];
				$register_date = $row['register_date'];
				$last_visit_date = $row['last_visit_date'];
				$username = $row['username'];
				
				/**** Performs insertion from results with parametrized ***/
				$stmt = $dbhLocal->prepare("INSERT INTO users_all (user_id, real_name, username, email, register_date, last_visit_date) VALUES(:user_id,:real_name,:username,:email,:register_date,:last_visit_date)");
				/****Performed prepared statement  ***/
				
				$stmt->execute(array(':user_id' => $user_id, ':real_name' => $real_name, ':username' => $username, ':email' => $email, ':register_date' => $register_date, ':last_visit_date' => $last_visit_date));
				
				$count++;
				
				//$dbhLocal->exec("INSERT INTO `Alumnus_all` (`user_id`, `real_name`, `username`, `email`, `register_date`, `last_visit_date`) VALUES ('$user_id', '$real_name', '$username', '$email', '$register_date', '$last_visit_date')"); 
				/**** This would ensure no duplications and what is only updated. This hasn't been implemented yet ***/
				//ON DUPLICATE KEY UPDATE real_name=VALUES('$real_name'), username=VALUES('$username'), email=VALUES('$email'), register_date=VALUES('$register_date'), last_visit_date=VALUES('$last_visit_date')");
			}
		
		/***
		*	This will perform a database commit after the entire transaction is complete. Think Atomic transactions.
		*	If this doesn't run, nothing should get written to the database.
		*	This protects against possible data issues. (Or should...)
		****/
		$dbhLocal->commit();
		
		$dbhLocal = null;
		echo 'Disconnected from local database <br />';
		echo 'There are '.$count.' line entries <br />';
		$dbhRemote = null;
		echo 'Disconnected from remote database <br />';
    }
catch(PDOException $e)
    {
		/*** roll back the transaction if we fail ***/
		$dbhLocal->rollback();
		
		//Will the remote need to be rolled back? Only performing queries on it, not inserting data.
		//$dbhRemote->rollback();
		
		echo $e->getMessage();
    }
?>
