<?php namespace Controller;

use Response\RedirectResponse as RedirectResponse;
use Request\Request           as Request;

class BaseController{


  private $successMessage;
  private $errorMessage;
  private $passSuccessMessage;
  private $passErrorMessage;

  function __construct(){
    if(isset($_GET['passSuccessMessage'])) $this->successMessage = $_GET['passSuccessMessage'];
    if(isset($_GET['passErrorMessage']))   $this->errorMessage = $_GET['passErrorMessage'];
  }

  function redirect($path){
    $queryString = "?";
    foreach(array('passSuccessMessage','passErrorMessage') as $attr){
      if(isset($this->$attr)) $queryString .= $attr . "=" . $this->$attr . "&";
    }
    $response = new RedirectResponse($path . $queryString);
    return $response->send();
  }

  function __get($attr){
    $readable_attributes = array('successMessage','errorMessage','passSuccessMessage','passErrorMessage');
    if(in_array( $attr, $readable_attributes)){
      return $this->$attr;
    };
  }

  function __set($attr,$value){
    $writeable_attributes = array('successMessage','errorMessage','passSuccessMessage','passErrorMessage');
    if(in_array( $attr, $writeable_attributes)){
      $this->$attr = $value;
    };
  }

}
