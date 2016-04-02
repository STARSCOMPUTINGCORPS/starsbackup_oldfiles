<?php

class Connection
{
	/**
	*		Note: An attempt to make variables easy to understand has been made.
	*		Example: $databaseLocal will name the Local database to be used
	*		Conversely, $databaseRemote will name the Remote database to be used
	*		And so on with the other variables.
	**/
	
	/**
	*		Local Server Information
	**/
	public static $databaseLocal = 'STARS';
	public static $userLocal = 'root';
	public static $pswdLocal = 'hcilab300';
	public static $hostLocal = 'localhost';
	
	/** 
	* 		Remote Server Connection information
	**/
	public static $databaseRemote = 'community';
	public static $userRemote = 'community_admin';
	public static $pswdRemote = 'GJD^G63MwKtG)';
	public static $hostRemote = '54.88.111.51';
	
	/**	
	*		Other
	**/
	
	public static $dateFormat = 'Y-m-d\TH-i-s'; // Standard XML time format.
}
?>	