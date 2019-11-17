<?php namespace Request;

use HTTPMethod\GET  as GET;
use HTTPMethod\POST as POST;
use Interfaces\Singleton as Singleton;

class Request implements Singleton{

  private static $instance;
  private $params;



  private function __construct(){

    switch($this->httpMethod()){
      case "get":
        $this->params = GET::getInstance();
        break;
      case "post":
        $this->params = POST::getInstance();
        break;
    }

  }



  static function getInstance(){
    if (!self::$instance instanceof self) {
        self::$instance = new self();
    }
    return self::$instance;
  }



  function httpMethod(){
    return strtolower($_SERVER['REQUEST_METHOD']);
  }



  function path(){
    return preg_replace( "/\?.*$/", "", $_SERVER['REQUEST_URI'] );
  }



  function __get($attr){
    $readable_attributes = array('params');
    if(in_array( $attr, $readable_attributes)){
      return $this->$attr;
    }
  }

}
