<?php namespace Controller;

use Response\RedirectResponse as RedirectResponse;
use Response\ErrorResponse    as ErrorResponse;
use Request\Request           as Request;
use Session\Session           as Session;
use HTTPMethod\GET            as GET;

class BaseController{

  private $successMessage;
  private $errorMessage;
  private $passSuccessMessage;
  private $passErrorMessage;
  private $session;

  function __construct(){
    $get = GET::getInstance();
    if(isset($get->passSuccessMessage)) $this->successMessage = $get->passSuccessMessage;
    if(isset($get->passErrorMessage))   $this->errorMessage = $get->passErrorMessage;
    $this->session = Session::getInstance();
  }

  function throw($message){
    echo new ErrorResponse($message);
    return;
  }

  function render($name,$params = array()){
    extract($params);
    if(!isset($user) && $this->session->user) $user = $this->session->user;
    include("views/$name.php");
  }

  function redirect($path){
    $queryString = "?";
    foreach(array('passSuccessMessage','passErrorMessage') as $attr){
      if(isset($this->$attr)) $queryString .= $attr . "=" . $this->$attr . "&";
    }
    if($queryString == "?") $queryString = "";
    $response = new RedirectResponse($path . $queryString);
    return $response->send();
  }

  function __get($attr){
    $readable_attributes = array('session','successMessage','errorMessage','passSuccessMessage','passErrorMessage');
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
