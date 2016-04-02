<?php

require_once 'User.php';

class Dashboard
{
  // old version
  public static function getAll() {
    $dbh = DoiMysql::getPDO();
	$queryArray=QueryMap::$queryArray;
	$count=count($queryArray);
	for ($i = 0; $i < $count; $i++)
		{
		$q = $queryArray[$i]['query'];
		$s = $dbh->prepare($q);
		$s->execute();
		$total=$s->fetch();
		$result=$total[0];
		$dashBoardTotalArray[$i]['name']=$queryArray[$i]['name'];
		$dashBoardTotalArray[$i]['total']=$result;
		}
    return $dashBoardTotalArray;
	}
/**	
	//New Version
  public static function getAll() {
    $dbh = DoiMysql::getPDO();
	$queryArray=QueryMap::$queryArray;
	//$count=count($queryArray);
	$query = $dbh->
	$rowResult = $queryArray->fetchAll();
	foreach ($rowResult as $row)
		{
		$q = $row['query'];
		$s = $dbh->prepare($q);
		$s->execute();
		$total=$s->fetch();
		$result=$total[0];
		$dashBoardTotalArray['name']=$row['name'];
		$dashBoardTotalArray['total']=$result;
		}
    return $dashBoardTotalArray;
	}
**/	
 }
 
 ?>