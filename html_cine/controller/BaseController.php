<?php namespace Controller;

use Response\RedirectResponse as RedirectResponse;
use Response\ErrorResponse    as ErrorResponse;
use Request\Request           as Request;
use Session\Session           as Session;

class BaseController{

  private $successMessage;
  private $errorMessage;
  private $passSuccessMessage;
  private $passErrorMessage;
  private $session;
  private $params;
  private $request;



  function __construct(){
    $this->request = Request::getInstance();
    $this->params  = $this->request->params;
    $this->session = Session::getInstance();
    if($this->params->passSuccessMessage) $this->successMessage = $this->params->passSuccessMessage;
    if($this->params->passErrorMessage)   $this->errorMessage = $this->params->passErrorMessage;
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



  function redirect($path,$params = array()){
    $queryString = "?";
    foreach(array('passSuccessMessage','passErrorMessage') as $attr){
      if(isset($this->$attr)) $params[$attr] = $this->$attr;
    }
    foreach($params as $key => $value){
      $queryString .= "$key=$value&";
    }
    $response = new RedirectResponse($path . substr_replace($queryString ,"",-1) );
    return $response->send();
  }



  function __get($attr){
    $readable_attributes = array(
      'session',
      'successMessage',
      'errorMessage',
      'passSuccessMessage',
      'passErrorMessage',
      'params',
      'request'
    );
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
