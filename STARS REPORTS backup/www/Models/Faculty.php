<?php
require_once 'User.php';
class Faculty extends User
{
  public static function getAll() {
    $dbh = DoiMysql::getPDO();
    $q = QueryMap::$faculty_all;
    $s = $dbh->prepare( $q );
    $s->execute();
    $faculty = array();
    while($row = $s->fetch()){
      $f = new faculty($row['id']);
      $f->fetch();
      array_push($faculty, $f);
	 
    }
    return $faculty;
  }
}
