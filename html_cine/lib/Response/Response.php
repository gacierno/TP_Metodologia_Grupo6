<?php namespace Response;

class Response{

  protected $code     = 200;
  protected $headers  = array();
  protected $body     = '';

  function __construct($obj){
    if(gettype($obj) == 'array'){
      $this->setCode($obj['code']);
      $this->body = $obj['body'];
      $this->headers = $obj['headers'];
    }
    if(gettype($obj) == 'string'){
      $this->body = $obj;
    }
  }

  function setCode($code){
    $this->code = $code;
    http_response_code($this->code);
  }

  function setHeader($name,$value){
    $headers[$name] = $value;
    header("$name: $value");
  }

  function send(){
    echo $this;
  }

  function __toString(){
    return $this->body;
  }

  function __get($attr){
    $readable_attributes = array('body','code','headers');
    if(in_array( $attr, $readable_attributes)){
      return $this->$attr;
    };
  }

  function __set($attr,$value){
    $writeable_attributes = array('body');
    if(in_array( $attr, $writeable_attributes)){
      $this->$attr = $value;
    };
  }

}
