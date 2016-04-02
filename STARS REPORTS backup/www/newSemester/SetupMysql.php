<?php

class SetupMysql
{	
	private static $localHost;
	private static $localDB;
	private static $localUsername;
	private static $localPswd;
	private static $localHostDBH = null;

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