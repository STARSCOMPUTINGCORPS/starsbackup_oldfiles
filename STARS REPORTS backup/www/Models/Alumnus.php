<?php
require_once 'User.php';
class Alumnus extends User
{
  public static function getAll() {
    $dbh = DoiMysql::getPDO();
    $q = QueryMap::$alumnus_all;
    $s = $dbh->prepare( $q );
    $s->execute();
    $alumni = array();
    while($row = $s->fetch()){
      $a = new Alumnus($row['id']);
      $a->fetch();
      array_push($alumni, $a);
    }
    return $alumni;
  }
}
