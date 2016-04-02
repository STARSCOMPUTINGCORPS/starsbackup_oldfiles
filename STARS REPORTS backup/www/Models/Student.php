<?php
require_once 'User.php';
class Student extends User
{
  public static function getAll() {
    $dbh = DoiMysql::getPDO();
    $q = QueryMap::$student_all;
    $s = $dbh->prepare( $q );
    $s->execute();
    $students = array();
    while($row = $s->fetch()){
      $student = new Student($row['id']);
      $student->fetch();
      array_push($students, $student);
    }
    return $students;
  }
}

