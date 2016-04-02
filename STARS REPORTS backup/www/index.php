<?php
// Dependicies.

ini_set('display_errors',1);

class PATH
{
  public static $ROOT_DIR;
  public static $DS;
  public static $TEMPLATE_DIRECTORY;
  public static $MODEL_DIRECTORY;
  public static $CONTROLLER_DIRECTORY;
  public static $PAGE_DIRECTORY;
  public static $dataBase_index;
  
  public static function load()
  {
    self::$ROOT_DIR = getcwd();
    self::$DS = DIRECTORY_SEPARATOR;
    self::$TEMPLATE_DIRECTORY = (self::$ROOT_DIR . self::$DS . 'Views' . self::$DS . '_includes');
    self::$MODEL_DIRECTORY = self::$ROOT_DIR . self::$DS . 'Models';
    self::$CONTROLLER_DIRECTORY = self::$ROOT_DIR . self::$DS . 'Controllers';
    self::$PAGE_DIRECTORY = self::$ROOT_DIR . self::$DS . 'Views' . self::$DS . 'pages';
	self::$dataBase_index = self::$ROOT_DIR . self::$DS . 'dataBase' . self::$DS . 'index.php';
  }
}

PATH::load();
require_once 'Template.php';
require_once 'QueryMap.php';
require_once 'DoiMysql.php';
require_once 'CONFIG.php';


// Main.
function loadController($controller)
{
  if (is_file(PATH::$CONTROLLER_DIRECTORY . PATH::$DS . $controller . '.php')) {
    include_once(PATH::$CONTROLLER_DIRECTORY . PATH::$DS . $controller . '.php');
  } else {
    renderPage('404');
  }
}

function loadPage($page)
{
  if (is_file(PATH::$PAGE_DIRECTORY . PATH::$DS . $page . '.php')) {
    include_once(PATH::$PAGE_DIRECTORY . PATH::$DS . $page . '.php');
  } else {
    renderPage('404');
  }
}

function renderPage($request)
{
  ob_start();
  ob_clean();
  header('Content-type: text/html; charset=utf-8');
  loadController($request);
  loadPage($request);
  ob_flush();
}

session_start();

if (!isset($_SESSION['Approved']) || $_SESSION['Approved'] != true) {
  renderPage('login');
} else {
  $request = isset($_GET['q']) ? $_GET['q'] : 'homepage';
  renderPage($request);
}


