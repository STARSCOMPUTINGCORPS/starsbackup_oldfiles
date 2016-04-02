<?php

// Data Object Interface - establishes a connection with a MySQL Database
// Creates a new PDO (PHP Data Object interface) or returns one if already created

class DoiMysql {
  private static $host;
  private static $name;
  private static $username;
  private static $dsn;
  private static $password;
  private static $options;
  private static $dbh = null;

  private static function load() {
    if ( file_exists( "/home/dotcloud/environment.json" ) ) {
      /* configuration on dotCloud */
      require 'env.php';
      self::$dsn = "mysql:dbname=$dbname;host=$host;port=$port";
      self::$username = $user;
      self::$password = $password;
    }
    else {
      self::$host = CONFIG::$dbHost;
      self::$name = CONFIG::$dbName;
      self::$username = CONFIG::$dbUser;
      self::$password = CONFIG::$dbPass;
      self::$dsn = sprintf( "mysql:host=%s;dbname=%s", self::$host, self::$name );
    }
    self::$options = array(
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );
  }

  public static function getPDO() {
    if ( self::$dbh === null ) {
      self::load();
      self::$dbh = new PDO( self::$dsn, self::$username, self::$password, self::$options );
    }
    return self::$dbh;
  }
}
