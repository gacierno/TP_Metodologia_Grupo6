<?php namespace Request;

class Request{

  function __construct(){

  }

  function httpMethod(){
    return $_SERVER['REQUEST_METHOD'];
  }

  function path(){
    return $_SERVER['REQUEST_URI'];
  }



}
