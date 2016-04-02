<?php
	echo '<p> Nick </p>';
	require_once 'Database.php';
	echo '<p>ln 4</p>';
	$db=new Database('localhost','root','hcilab300','test');   //website would be the table or the database as is named in myadmin
	
	//$insertSQL="INSERT INTO articlesTarget(title) VALUES ('$row['title']')";
	//$pullSQL="SELECT * FROM `articles`";
	
	//$db->query("SELECT * FROM `articles`");
	//$db->query("SELECT `articles`.`title` FROM `articles`"); 
    $db->query("SELECT `articles`.`title`,`articles`.`id` FROM `articles`"); 
	
	if ($db->numRows() == 0)  //If there are no rows then the database is empty and why continue
		{
		echo 'No return on query';
		}  
	else
		{
		foreach($db->rows() as $article)
			{
			// echo '<pre>',print_r($article,true),'</pre>';  //this line will output the contents of the arrary 
			echo $article['title'],' - ',$article[id], '<br />';
			//$dbTarget=new Database('localhost','root','hcilab300','testTarget');
			$title=$article['title'];
			//$count = $dbTarget->exec("INSERT INTO articlesTarget(`title`) VALUES ('$title')");
			
			//$count = $dbh->exec("INSERT INTO articles(title) VALUES ('UNCC stat')");
			}
		echo'<p>', $db->numRows(), ' articles</p>';
		}
		foreach(PDO::getAvailableDrivers() as $driver)
			{
			echo $driver.'<br />';
			}
		echo '<p> end </p>';
	$db->disconnect();
?>