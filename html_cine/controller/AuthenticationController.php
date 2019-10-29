<?php namespace Controller;

use Controller\BaseController as BaseController;
use Response\RedirectResponse as RedirectResponse;
use Request\Request           as Request;

use dao\RoleDao               as RoleDao;
use dao\UserDao               as UserDao;

use model\User                as User;
use model\Profile             as Profile;

class AuthenticationController extends BaseController{

  function __construct(){
    parent::__construct();
  }

  function authenticate(){
    $req = new Request();
    session_start();
    extract($_SESSION);
    $includesLogin = preg_match("/^\/login/",$req->path());
    $includesUser  = preg_match("/^\/user/",$req->path());
    if(($includesLogin || $includesUser) && isset($user)){
      return $this->redirect("/");
    }
    if(!isset($user) && !($includesLogin || $includesUser)){
      return $this->redirect("/login");
    }
  }

  function loginForm(){
    include("views/login.php");
  }

  function registerForm(){
    include("views/userCreation.php");
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
    return $this->redirect("/");
  }

}
