<?php
echo 'This is the recieving page';
$match='pass123';
echo $_GET['password'];
if (isset($_GET['password']))
	{
	$password = $_GET['password'];
	
	if ($password==$match)
		{
		echo ' that is correct';
		}
		else
		{
		echo ' that is not correct';
		}
	}


?>