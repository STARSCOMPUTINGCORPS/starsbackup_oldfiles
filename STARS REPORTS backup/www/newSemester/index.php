<?php

ini_set('display_errors', 'On');		//error display
error_reporting(E_ALL | E_STRICT);		//enforces strict php coding
include_once 'SetupMysql.php';
include_once 'InsertLibrary.php';
	
try
{
	include_once 'SetupMysql.php';
	include_once 'InsertLibrary.php';
	$currMonth;
	$currYear;
	$currDate;
	$semester;
	
	$currMonth = date("n");
	$currYear = date("Y");
	
	$spring = range(1, 6);
	$fall = range(7, 12);
	
	if(in_array($currMonth, $spring))
	{
		$semester = "Spring";
	}
	else if(in_array($currMonth, $fall))
	{
		$semester = "Fall";
	}
	$tableName = "memberData_".$currYear."_".$semester;	
	
	$check = "SHOW TABLES LIKE '".$tableName."'";
	
	$dbhLocal = SetupMysql::getLocalPDO();								//Setup Local PDO
	$dbhLocal->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	//sets error modes
	$query = $dbhLocal->prepare($check);								//Prepare sql query
	$query->execute();													//Perform prepared query
	$result = $query->fetchAll();										//Fetches results
	
	$dbhLocal = null;
	
	if(!$result)
	{
		
		//Create the table
		$dbhLocal = SetupMysql::getLocalPDO();
		$dbhLocal->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$q = InsertLibrary::$createTempTable;
		$dbhLocal->exec($q);
		$dbhLocal = null;
		
		$tableRename = "RENAME TABLE `memberDataTemp` TO `".$tableName."`" ;

		$tableComment = "ALTER TABLE `".$tableName."` COMMENT = 'All STARS Members as of:  ".$semester." ".$currYear."'";	
		
		//Rename the table
		$dbhLocal = SetupMysql::getLocalPDO();
		$dbhLocal->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbhLocal->exec($tableRename);
		$dbhLocal = null;
		
		//Add a comment to the table
		$dbhLocal = SetupMysql::getLocalPDO();
		$dbhLocal->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbhLocal->exec($tableComment);
		$dbhLocal = null;		
	}
	
/** this redirects the user back to the report homepage**/
	 header("Location: /");  //Root Site
	
}

catch(PDOException $e)
{
	echo $e->getMessage(). '<br/>';
}
?>