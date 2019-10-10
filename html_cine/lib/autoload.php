<?php

class LibAutoload {

    public static function Start() {
      spl_autoload_register(function($className) {
        $file = dirname(__FILE__) . "/" . str_replace("\\" , "/" , $className) . '.php';
        if (file_exists($file)) {
          require_once($file);
        }
      });
    }
}

?>
