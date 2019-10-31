<?php namespace Session;

class Session{

  private static $instance;

  private function __construct(){
    session_start();
  }

  static function getInstance(){
    if (!self::$instance instanceof self) {
        self::$instance = new self();
    }

    return self::$instance;
  }

  function __get($attr){
    if(isset($_SESSION[$attr])){
      return $_SESSION[$attr];
    }
  }

  function __set($attr,$value){
    $_SESSION[$attr] = $value;
  }

  function unset($attr){
    if(isset($_SESSION[$attr])){
      unset($_SESSION[$attr]);
    }
  }

}
