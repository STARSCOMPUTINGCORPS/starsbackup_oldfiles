<?php

// Already signed in.
if (isset($_SESSION['Approved']) && $_SESSION['Approved'] == true) {
  header("Location: /");
  exit;
}

// Just posted a login attempt
if (
  isset($_POST['token']) &&
  $_POST['token'] == $_SESSION['token'] &&
  isset($_POST['password']) &&
  trim($_POST['password']) == CONFIG::$password
) {
  $_SESSION['Approved'] = true;
  header("Location: /");
  exit;
}

// Prepare for a login attempt.
$token = rand(1, 100000);
$_SESSION['token'] = $token;
Template::set('token', $token);
