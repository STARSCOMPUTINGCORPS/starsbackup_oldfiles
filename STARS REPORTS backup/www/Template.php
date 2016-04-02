<?php

Class Template
{
  private static $objects = array();

  public static function set($name, $object)
  {
    self::$objects[$name] = $object;
  }

  public static function get($name)
  {
    return self::$objects[$name];
  }

  public static function includeTemplate($template)
  {
    if (is_file(PATH::$TEMPLATE_DIRECTORY . PATH::$DS . $template)) {
      include(PATH::$TEMPLATE_DIRECTORY . PATH::$DS . $template);
    } else {
      trigger_error('Template "' . $template . '" not found.', E_USER_ERROR);
    }
  }

  public static function includeModel($model)
  {
    if (is_file(PATH::$MODEL_DIRECTORY . PATH::$DS . $model . '.php')) {
      include_once(PATH::$MODEL_DIRECTORY . PATH::$DS . $model . '.php');
    } else {
      trigger_error('Model "' . $model . '" not found.', E_USER_ERROR);
    }
  }

  public static function ellipses($string, $max){
    if(strlen($string) > $max){
      $string = substr($string, 0, $max - 3) . '...';
    }
    return $string;
  }

}
