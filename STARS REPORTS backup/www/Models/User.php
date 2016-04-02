<?php
require_once 'EntityModel.php';
class User implements EntityModel
{/* Class for user transactions, Students, and Faculty. */

  // User types are based on the user's `profile_id`.
  private static $userTypes = array( 3 => 'Student', 1 => 'Faculty', 5 => 'Alumnus' );
  // Attributes of users.
  private $age; // TODO Born on?
  private $citizenship;
  private $current;
  private $email;
  private $ethnicity;
  private $gender;
  private $gpa;
  private $graduation;
  private $last_visit_date;
  private $name;
  private $register_date;
  private $returning;
  private $school;
  private $semesters;
  private $user_id;
  private $user_type;
  private $id;
  private $consent;
  private $gradYear;
  // Map of method to get fields, numeric index, and long names for them for generating tables.
  private $fieldMap = array();

  public static function getAll() {

    function nameSort( $a, $b ) {
      $a = strtolower( $a->getName() );
      $b = strtolower( $b->getName() );
      return strcmp( $a, $b );
    }


    $dbh = DoiMysql::getPDO();
    $q = QueryMap::$user_all;
    $s = $dbh->prepare( $q );
    $s->execute();
    $users = array();
    while ( $row = $s->fetch() ) {
      $user = new User( $row['id'] );
      $user->fetch();
      array_push( $users, $user );
    }

    usort( $users, 'nameSort' );
    return $users;
  }
  
  /* Adding items to this field map will add items to checkbox options below the navigation bar*/
  public function __construct( $id ) {
    $this->id = $id;
    $this->fieldMap[0] = array( 'User type', 'gettype' );
    $this->fieldMap[1] = array( 'User ID', 'getId' );
    $this->fieldMap[2] = array( 'Name', 'getName' );
    $this->fieldMap[3] = array( 'Email', 'getEmail' );
	$this->fieldMap[4] = array( 'Secondary Email', 'getEmail2' );
    $this->fieldMap[5] = array( 'School', 'getSchool' );
    $this->fieldMap[6] = array( 'Age', 'getAge' );
    $this->fieldMap[7] = array( 'Citizenship', 'getCitizenship' );
    $this->fieldMap[8] = array( 'Current Year', 'getCurrent' );
    $this->fieldMap[9] = array( 'Ethnicity', 'getEthnicity' );
    $this->fieldMap[10] = array( 'Gender', 'getGender' );
    $this->fieldMap[11] = array( 'Returning', 'getReturning' );
    $this->fieldMap[12] = array( 'Semesters', 'getSemesters' );
	$this->fieldMap[13] = array( 'First Registered', 'getRegisterDate');
	$this->fieldMap[13] = array( 'Consent', 'getConsent');
	$this->fieldMap[14] = array( 'GPA', 'getGpa');
	$this->fieldMap[15] = array( 'Major', 'getMajor');
	$this->fieldMap[16] = array( 'Expected Grad', 'getGradYear');

  }

  public function getFieldMap() {
    return $this->fieldMap;
  }

  public function getId() {
    return $this->id;
  }

  public function gettype() {
    return $this->user_type;
  }

  public function settype( $type_int ) {
    $this->user_type = $type_int;
  }

  public function getTypeString() {
    if ( isset( User::$userTypes[$this->user_type] ) ) {
      return User::$userTypes[$this->user_type];
    }
	
    return '?';
  }

  public function getName() {
    return $this->name;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getSchool() {
    return $this->school;
  }

  public function getAge() {
    return $this->age; // TODO time from born on?
  }

  public function getCitizenship() {
    return $this->citizenship;
  }

  public function getCurrent() {
    return $this->current;
  }

  public function getEthnicity() {
    return $this->ethnicity;
  }

  public function getGender() {
    return $this->gender;
  }

  public function getReturning() {
    return $this->returning;
  }

  public function getSemesters() {
    return $this->semesters;
  }
  
  public function getRegisterDate() {
	return $this->register_date;
	}
  public function getEmail2() {
	return $this->email2;
	}
  public function getConsent() {
	return $this->consent;
	}
  public function getGpa() {
	return $this->gpa;
	}
  public function getMajor() {
	return $this->major;
	}
	public function getGradYear() {
	return $this->gradYear;
	}

  private static function hasValue( $field ) {
    if ( in_array( $field, array( '', null ) ) ) {
      return false;
    }
    return true;
  }

  public function fetch() {
    /* Fetch an user based on their `id`.
       Fields not used by a particular user type will be set to 'N.A.'.'
    */

    $dbh = DoiMysql::getPDO();

    $q = QueryMap::$user_field_type;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':id', $this->id );
    $s->execute();
    $r = $s->fetch();
    $type = $r['profile_type'];

    $this->user_type =User::hasValue( $type ) ? $type : '  -';

    $q = QueryMap::$user_field_name;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':id', $this->id );
    $s->execute();
    $r = $s->fetch();
    $name = $r['real_name'];

    $this->name = User::hasValue( $name ) ? $name : '  -';

    $q = QueryMap::$user_field_email;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':id', $this->id );
    $s->execute();
    $r = $s->fetch();
    $email = $r['email'];

    $this->email = User::hasValue( $email ) ? $email : '  -';

    $q = QueryMap::$user_field_email2;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':id', $this->id );
    $s->execute();
    $r = $s->fetch();
    $email2 = $r['email2'];

    $this->email2 = User::hasValue( $email2 ) ? $email2 : '  -';
	
	$q = QueryMap::$user_field_school;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':id', $this->id );
    $s->execute();
    $r = $s->fetch();
    $school = $r['school'];

    $this->school = User::hasValue( $school ) ? $school : '  -';

    $q = QueryMap::$user_field_age;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':id', $this->id );
    $s->execute();
    $r = $s->fetch();
    $age = $r['age'];

    $this->age = User::hasValue( $age ) ? $age : '  -';

    $q = QueryMap::$user_field_citizenship;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':id', $this->id );
    $s->execute();
    $r = $s->fetch();
    $citizenship = $r['citizenship'];

    $this->citizenship = User::hasValue( $citizenship ) ? $citizenship : '  -';

    $q = QueryMap::$user_field_current;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':id', $this->id );
    $s->execute();
    $r = $s->fetch();
    $current = $r['current_level'];

    $this->current = User::hasValue( $current ) ? $current : '  -';

    $q = QueryMap::$user_field_ethnicity;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':id', $this->id );
    $s->execute();
    $r = $s->fetch();
    $ethnicity = $r['ethnicity'];

    $this->ethnicity = User::hasValue( $ethnicity ) ? $ethnicity : '  -';

    $q = QueryMap::$user_field_gender;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':id', $this->id );
    $s->execute();
    $r = $s->fetch();
    $gender = $r['gender'];

    $this->gender = User::hasValue( $gender ) ? $gender : '  -';

    $q = QueryMap::$user_field_gpa;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':id', $this->id );
    $s->execute();
    $r = $s->fetch();
    $gpa = $r['gpa'];

    $this->gpa = User::hasValue( $gpa ) ? $gpa : '  -';

    $q = QueryMap::$user_field_graduation;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':id', $this->id );
    $s->execute();
    $r = $s->fetch();
    $graduation = $r['graduation'];

    $this->graduation = User::hasValue( $graduation ) ? $graduation : '  -';

    $q = QueryMap::$user_field_returning;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':id', $this->id );
    $s->execute();
    $r = $s->fetch();
    $returning = $r['returning_student'];

    // Either set to 'Yes' or not set ?
    $this->returning = User::hasValue( $returning ) ? $returning : ' -';

    $q = QueryMap::$user_field_semesters;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':id', $this->id );
    $s->execute();
    $r = $s->fetch();
    $semesters = $r['semesters_participated'];

    $this->semesters = User::hasValue( $semesters ) ? $semesters : '  -';
	
	$q = QueryMap::$user_field_register_date;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':id', $this->id );
    $s->execute();
    $r = $s->fetch();
    $register_date = $r['register_date'];
	
    $this->register_date = User::hasValue( $register_date ) ? $register_date : '  -';
	
	$q = QueryMap::$consent_for_research;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':id', $this->id );
    $s->execute();
    $r = $s->fetch();
    $consent = $r['participant_research_consent'];
	
    $this->consent = User::hasValue( $consent ) ? $consent : '  -';
	
	$q = QueryMap::$user_field_major;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':id', $this->id );
    $s->execute();
    $r = $s->fetch();
    $major = $r['major'];
	
    $this->major = User::hasValue( $major ) ? $major : '  -';
	
	$q = QueryMap::$user_field_gradYear;
    $s = $dbh->prepare( $q );
    $s->bindParam( ':id', $this->id );
    $s->execute();
    $r = $s->fetch();
    $gradYear = $r['graduation_year'];
	
    $this->gradYear = User::hasValue( $gradYear ) ? $gradYear : '  -';
		
//END fetch()
  }
  
  public static function lastUpdated(){
  
    $dbh = DoiMysql::getPDO();

    $q = QueryMap::$last_updated;
    $s = $dbh->prepare( $q );
    $s->execute();
	$r=$s->fetch();
    $updated=$r[0];

    return $updated;
  }
}
