<?php
/*
Stephen Chandler
I created this to test a database connection with localhost using a Ubuntu server created on AWS
I used the creds for the phpmyadmin not the creds for the server
*/

$mysql_host='localhost';
$mysql_user='root';
$mysql_pass='hcilab300';
mysql_connect($mysql_host,$mysql_user,$mysql_pass) or die('Cound not connect to database');
	echo 'connected';
mysql_query(	
?>