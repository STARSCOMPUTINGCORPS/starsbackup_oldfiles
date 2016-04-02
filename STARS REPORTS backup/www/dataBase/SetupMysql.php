<?php

class SetupMysql
{
	private static $remoteHost;
	private static $remoteDB;
	private static $remoteUsername;
	private static $remotePswd;
	private static $remoteHostDBH = null;
	
	private static $localHost;
	private static $localDB;
	private static $localUsername;
	private static $localPswd;
	private static $localHostDBH = null;

	public static function getRemotePDO() 	//Creates Remote PDO connection
	{
		include_once 'Connection.php';
		if(self::$remoteHostDBH === null) 
		{
			self::$remoteHost = Connection::$hostRemote;
			$remHost = self::$remoteHost;
			self::$remoteDB = Connection::$databaseRemote;
			$remDB = self::$remoteDB;
			self::$remoteUsername = Connection::$userRemote;
			self::$remotePswd = Connection::$pswdRemote;
			self::$remoteHostDBH = new PDO("mysql:host=$remHost;dbname=$remDB", self::$remoteUsername, self::$remotePswd);
		}
		return self::$remoteHostDBH;
	}  

	public static function getLocalPDO()	//Creates Local PDO connection
	{
		include_once 'Connection.php';
		if(self::$localHostDBH === null)
		{
			self::$localHost = Connection::$hostLocal;
			$locHost = self::$localHost;
			self::$localDB = Connection::$databaseLocal;
			$locDB = self::$localDB;
			self::$localUsername = Connection::$userLocal;
			self::$localPswd = Connection::$pswdLocal;
			self::$localHostDBH = new PDO("mysql:host=$locHost;dbname=$locDB", self::$localUsername, self::$localPswd);
		}
		return self::$localHostDBH;
	}

}

?>