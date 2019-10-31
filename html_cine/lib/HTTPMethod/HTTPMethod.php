<?php namespace HTTPMethod;

class HTTPMethod {

  function map(){
    return $this->methodMap;
  }

  function __get($attr){
    if($attr == "methodMap") return $this->methodMap;
    if(isset($this->methodMap[$attr])){
      return $this->methodMap[$attr];
    }
  }

  function __set($attr,$value){
    $this->methodMap[$attr] = $value;
  }

  function unset($attr){
    if(isset($this->methodMap[$attr])){
      unset($this->methodMap[$attr]);
    }
  }

}
