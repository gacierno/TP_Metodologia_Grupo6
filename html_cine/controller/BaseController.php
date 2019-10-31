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

  function __construct(){
    if(isset($_GET['passSuccessMessage'])) $this->successMessage = $_GET['passSuccessMessage'];
    if(isset($_GET['passErrorMessage']))   $this->errorMessage = $_GET['passErrorMessage'];
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
