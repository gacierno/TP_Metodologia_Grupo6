<?php namespace Controller;

use Controller\BaseController as BaseController;
use Response\RedirectResponse as RedirectResponse;
use Request\Request           as Request;

use dao\RoleDao               as RoleDao;
use dao\UserDao               as UserDao;

use model\User                as User;
use model\Profile             as Profile;

use HTTPMethod\POST           as POST;

class AuthenticationController extends BaseController{

  function __construct(){
    parent::__construct();
  }

  function authenticate(){
    $req = new Request();
    $includesLogin = preg_match("/^\/login/",$req->path());
    $includesUser  = preg_match("/^\/user/",$req->path());
    if(($includesLogin || $includesUser) && $this->session->user){
      return $this->redirect("/");
    }
    if(!$this->session->user && !($includesLogin || $includesUser)){
      return $this->redirect("/login");
    }
  }

  function loginForm(){
    $this->render("login");
  }

  function registerForm(){
    $this->render("userCreation");
  }

  function login(){
    extract(POST::getInstance()->map());
    if(!isset($username,$password)) return "Error: no user or pass";
    $userDao = new UserDao();
    $users = $userDao->getList(array(
      'user_email' => $username,
      'user_password' => $password
    ));

    if(count($users) > 0){
      $this->session->user = $users[0];
    }
    $this->redirect("/");
  }


  function logout(){
    $this->session->unset('user');
    return $this->redirect("/");
  }

}
