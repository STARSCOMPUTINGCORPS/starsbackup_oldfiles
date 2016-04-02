<?php
foreach(PDO::getAvailableDrivers() as $driver)
			{
			echo $driver.'<br />';
			}
try {
    $db = new PDO("pgsql:dbname=pdo;host=localhost", "username", "password" );
    echo "PDO connection object created";
    }
catch(PDOException $e)
    {
    echo $e->getMessage().' for pgsql <br />';
    }
try {
    /*** connect to SQLite database ***/
    $dbh = new PDO("sqlite:/path/to/database.sdb");
    }
catch(PDOException $e)
    {
    echo $e->getMessage().' for SQLite <br />';
    }

/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = 'hcilab300';

/*** mysql DBName ***/
$dbName = 'test';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);
    /*** echo a message saying we have connected ***/
    echo ' Connected to MySQL database <br /><br />';
	
	    /*** close the database connection ***/
    $dbh = null;
    }
catch(PDOException $e)
    {
    echo $e->getMessage().' for MYSQL <br />';
    }


?>
