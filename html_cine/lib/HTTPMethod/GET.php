<?php namespace HTTPMethod;

class GET{

  private static $instance;
  private $method = array();

  private function __construct(){
    $method = $_GET;
  }

  static function getInstance(){
    if (!self::$instance instanceof self) {
        self::$instance = new self();
    }

    return self::$instance;
  }

  function map(){
    return $method;
  }

  function __get($attr){
    if(isset($method[$attr])){
      return $method[$attr];
    }
  }

  function __set($attr,$value){
    $method[$attr] = $value;
  }

  function unset($attr){
    if(isset($method[$attr])){
      unset($method[$attr]);
    }
  }

}
