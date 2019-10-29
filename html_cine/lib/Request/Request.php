<?php namespace Request;

class Request{

  function __construct(){

  }

  function httpMethod(){
    return $_SERVER['REQUEST_METHOD'];
  }

  function path(){
    return preg_replace( "/\?.*$/", "", $_SERVER['REQUEST_URI'] );
  }



}
