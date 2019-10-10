<?php
class Router {

  private $map = array();

  function __construct(){

  }

  function add($methodName,$regexp,$callback){
    if(!isset($this->map[$methodName])){
      $this->map[$methodName] = array();
    }
    array_push(
      $this->map[$methodName], array(
        'regexp'   => $regexp,
        'callback' => $callback
      )
    );
  }

  function get($regexp, $callback){
    $this->add('get',$regexp,$callback);
  }

  function post($regexp, $callback){
    $this->add('post',$regexp,$callback);
  }

  function delete($regexp, $callback){
    $this->add('delete',$regexp,$callback);
  }

  function put($regexp, $callback){
    $this->add('put',$regexp,$callback);
  }

  function all($regexp, $callback){
    $this->add('all',$regexp,$callback);
  }

  function find($httpMethod,$path){
    $httpMethod      = strtolower($httpMethod);
    $httpMethodArray = isset($this->map[$httpMethod]) ? $this->map[$httpMethod] : array();
    $allMethodArray  = isset($this->map['all']) ? $this->map['all'] : array();
    $method = array_merge(
      $httpMethodArray,
      $allMethodArray
    );
    foreach( $method as $route ){
      $pattern = '/' . $route['regexp'] . '/';
      if(preg_match($pattern,$path)){
        return call_user_func($route['callback']);
      }
    }
  }

}

?>
