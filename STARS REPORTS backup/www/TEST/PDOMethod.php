<?php
/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = 'hcilab300';

/*** mysql DataBase Name ***/
$dbname='test';
$dbTarget = 'testTarget';

try {
	    /*** make a connection to origin DB***/
	$db=new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);
		/*** make a connection to Target/destination DB***/
    $dbTarget = new PDO("mysql:host=$hostname;dbname=$dbTarget", $username, $password);

    
		/*** Pull from origin DB***/
	$pullFromDB="SELECT * FROM articles";
	
		/*** Print and INSERT data ***/
	foreach ($db->query($pullFromDB)as $row)
		{
		
		print $row['id'].'-'.$row['title'].'<br />';
		$title=$row['title'];
		$id=$row['id'];
		/*** Insert into target/destination DB***/
		$insertIntoTarget="INSERT INTO articlesTarget(id,title) VALUES ('$id','$title')";
		$dbTarget->exec($insertIntoTarget);
		 
		}
    
    //$count = $dbTarget->exec("INSERT INTO articlesTarget(title) VALUES ('UNCC stat')");

    /*** echo the number of affected rows ***/
    echo $count;

    /*** close the database connection ***/
    $dbh = null;
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
?>
