<?php namespace config;

class Autoload {

    public static function Start() {
      spl_autoload_register(function($className) {
        $file = dirname(__DIR__) . "/" . str_replace("\\" , "/" , $className) . '.php';
        if (file_exists($file)) {
          require_once($file);
        }
      });
    }
}

?>
