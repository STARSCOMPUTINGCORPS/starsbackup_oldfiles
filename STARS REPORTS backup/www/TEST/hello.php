<?php
echo 'it starts';

$ch=curl_init("ec2-54-227-109-175.compute-1.amazonaws.com/helloNick.php");
//$ch = curl_init("http://ec2-23-23-32-35.compute-1.amazonaws.com/helloNick.php?function=nick");
$nameValuePair= "&message=You Passed me!!";
curl_setopt($ch,CURLOPT_POSTFIELDS,$nameValuePair);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
echo curl_exec($ch);



/*
function get_url($request_url) {
  $ch = curl_init($request_url);
  curl_setopt($ch, CURLOPT_URL, $request_url);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $response = curl_exec($ch);
  curl_close($ch);
  echo 'Hello '.$response;
  return $response;
}
$request_url = 'http://ec2-23-23-32-35.compute-1.amazonaws.com/helloNick.php?function=nick()';
$response = get_url($request_url);
echo "nick".$response;
/*
include 'xmlrpc.inc';
include 'xmlrpcs.inc';

function hello()
	{
	echo '<p> Hello Nick </p>';
	}
*/
?>