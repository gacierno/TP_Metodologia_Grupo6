<?php namespace Response;

class Response{

  protected $code     = 200;
  protected $headers  = array();
  protected $body     = '';

  function __construct($obj){
    if(gettype($obj) == 'array'){
      if(isset($obj['code'])){
        $this->code = $obj['code'];
      }
      if(isset( $obj['body'] )){
        $this->body = $obj['body'];
      }
      if(isset( $obj['headers'] )){
        $this->headers = $obj['headers'];
      }
    }
    if(gettype($obj) == 'string'){
      $this->body = $obj;
    }
  }

  function setCode($code){
    $this->code = $code;
  }

  function setHeader($name,$value){
    $headers[$name] = $value;
  }

  function writeCode(){
    http_response_code($this->code);
  }

  function writeHeaders(){
    if(is_array($this->headers)){
      foreach($this->headers as $name=>$value){
        header("$name: $value");
      }
    }
  }

  function send(){
    $this->writeHeaders();
    $this->writeCode();
    if($this->body) echo $this;
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
    $writeable_attributes = array('body','code');
    if(in_array( $attr, $writeable_attributes)){
      $this->$attr = $value;
    };
  }

}
