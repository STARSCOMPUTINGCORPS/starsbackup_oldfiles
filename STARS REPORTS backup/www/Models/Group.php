<?php
require_once 'EntityModel.php';
class Group implements EntityModel
{

  private $group_id;
  private $name;
  private $total_members;
  private $total_students;
  private $total_faculty;
  private $total_alumni;
  // Map of method to get fields, numberic index, and long names for them for generating tables.
  private $fieldMap = array();

  public function __construct( $group_id ) {
    $this->group_id = $group_id;
    $this->fieldMap[0] = array( 'Group ID', 'getId' );
    $this->fieldMap[1] = array( 'Name', 'getName' );
    $this->fieldMap[2] = array( 'Total Members', 'getTotalMembers' );
    $this->fieldMap[3] = array( 'Total Students', 'getTotalStudents' );
    $this->fieldMap[4] = array( 'Total Faculty', 'getTotalFaculty' );
    $this->fieldMap[5] = array( 'Total Alumni', 'getTotalAlumni' );
  }

  public function getFieldMap() {
    return $this->fieldMap;
  }

  public function getId() {
    return $this->group_id;
  }

  public function getName() {
    return $this->name;
  }

  public function getTotalMembers() {
    return $this->total_members;
  }

  public function getTotalStudents() {
    return $this->total_students;
  }

  public function getTotalFaculty() {
    return $this->total_faculty;
  }

  public function getTotalAlumni() {
    return $this->total_alumni;
  }

  private static function hasValue( $field ) {
    if ( in_array( $field, array( '', null ) ) ) {
      return false;
    }
    return true;
  }

  public function fetch() {

    $dbh = DoiMysql::getPDO();

    $q = QueryMap::$group;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':group_id', $this->group_id );
    $s->execute();
    $r = $s->fetch();

    $name = $r['name'];
    $group_id = $r['id'];

    $this->group_id = Group::hasValue( $group_id ) ? $group_id : 'N.A.';
    $this->name = Group::hasValue( $name ) ? $name : 'N.A.';

    $q = QueryMap::$group_member_count;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':group_id', $this->group_id );
    $s->execute();
    $r = $s->fetch();

    $total_members  = $r['COUNT( * )'];
    $this->total_members = Group::hasValue( $total_members ) ? $total_members : 0;

    $q = QueryMap::$group_student_count;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':group_id', $this->group_id );
    $s->execute();
    $r = $s->fetch();

    $total_students  = $r['COUNT( * )'];
    $this->total_students = Group::hasValue( $total_students ) ? $total_students : 0;

    $q = QueryMap::$group_faculty_count;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':group_id', $this->group_id );
    $s->execute();
    $r = $s->fetch();

    $total_faculty = $r['COUNT( * )'];
    $this->total_faculty = Group::hasValue( $total_faculty ) ? $total_faculty : 0;

    $q = QueryMap::$group_alumnus_count;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':group_id', $this->group_id );
    $s->execute();
    $r = $s->fetch();

    $total_alumni  = $r['COUNT( * )'];
    $this->total_alumni = Group::hasValue( $total_alumni ) ? $total_alumni : 0;


  }

  public static function getAll() {
    $dbh = DoiMysql::getPDO();
    $q = QueryMap::$group_all;
    $s = $dbh->prepare( $q );
    $s->execute();
    $groups = array();
    while ( $row = $s->fetch() ) {
      $group = new Group( $row['id'] );
      $group->fetch();
      array_push( $groups, $group );
    }
    return $groups;
  }

}
