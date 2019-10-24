<?php namespace Controller;

use Controller\BaseController as BaseController;
use Response\RedirectResponse as RedirectResponse;
use Request\Request as Request;

class AuthenticationController extends BaseController{

  function authenticate(){
    $req = new Request();
    session_start();
    extract($_SESSION);
    if(!isset($user) && $req->path() != '/login'){
      $response = new RedirectResponse("/login");
      return $response->send();
    }
  }

  function login(){
    echo "<html><head></head><body><h1>LOGIN</h1></body></html>";
  }

}
