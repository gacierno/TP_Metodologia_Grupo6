<?php namespace Controller;

use Controller\BaseController as BaseController;
use Response\RedirectResponse as RedirectResponse;
use Request\Request as Request;
use dao\UserDao as UserDao;

class AuthenticationController extends BaseController{

  function authenticate(){
    $req = new Request();
    session_start();
    extract($_SESSION);
    if($req->path() == '/login' && isset($user)){
      $response = new RedirectResponse("/");
      return $response->send();
    }
    if(!isset($user) && $req->path() != '/login'){
      $response = new RedirectResponse("/login");
      return $response->send();
    }
  }

  function loginForm(){
    include("views/login.php");
  }


  function login(){
    extract($_POST);
    if(!isset($username,$password)) return "Error: no user or pass";
    $userDao = new UserDao();
    $users = $userDao->getList(array(
      'username' => $username,
      'password' => $password
    ));
    if(count($users) > 0){
      session_start();
      $_SESSION['user'] = $users[0];
    }
  }


  function logout(){
    session_start();
    if(isset($_SESSION['user'])){
      unset($_SESSION['user']);
    }
    $response = new RedirectResponse("/");
    return $response->send();
  }

}
