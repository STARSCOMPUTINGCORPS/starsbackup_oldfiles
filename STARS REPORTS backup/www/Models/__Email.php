023.................................................................<?php
require_once 'ReportObjectModel.php';
class Email implements ReportObjectModel
{
  private $fullName;
  private $email;
  // Not implemented.
  private $firstName;
  private $lastName;
  // ---

  public function __construct()
  {

  }

  public function getColumnCount()
  {
    return 2;
  }

  public function setFirstName($firstName)
  {
    $this->firstName = $firstName;
  }

  public function getFirstName()
  {
    return $this->firstName;
  }

  public function setLastName($lastName)
  {
    $this->lastName = $lastName;
  }

  public function getLastName()
  {
    return $this->lastName;
  }

  public function setFullName($name)
  {
    $this->fullName = $name;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function getFullName()
  {
    return $this->fullName;
  }

  public function getEmail()
  {
    return $this->email;
  }
}

