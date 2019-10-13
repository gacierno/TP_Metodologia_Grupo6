<?php namespace Response;

use Response\Response as Response;

class RedirectResponse extends Response{

  function __construct($obj){

    parent::__construct($obj);
    if(gettype($obj) == 'string'){
      $this->body = '';
      $this->setHeader('Location',$obj);
    }

    if($this->code < 300 || $this->code >= 400){
      $this->code = 301;
    }

  }

}
