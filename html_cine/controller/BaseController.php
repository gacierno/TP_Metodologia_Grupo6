<?php namespace Controller;

class BaseController{


  function __get($attr){
    $readable_attributes = array();
    if(in_array( $attr, $readable_attributes)){
      return $this->$attr;
    };
  }

  function __set($attr,$value){
    $writeable_attributes = array();
    if(in_array( $attr, $writeable_attributes)){
      $this->$attr = $value;
    };
  }
  
}
