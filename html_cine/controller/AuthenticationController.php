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
    // GET UPDATED USER FROM DB
    if($this->session->user){
      $d_user = new UserDao();
      $this->session->user = $d_user->getById($this->session->user->getId());
    }
    $includesLogin        = preg_match("/^\/login/",$req->path());
    $includesNewUserForm  = preg_match("/^\/usuario$/",$req->path());
    $includesUserRegister = preg_match("/^\/usuario\/nuevo$/",$req->path());
    $includesAdmin        = preg_match("/^\/admin/",$req->path());

    // IF USER IS NOT LOGGED IN, REJECT UNLESS IT IS TRYING TO LOGIN OR REGISTER
    if(
      !$this->session->user &&
      !(
        $includesLogin ||
        $includesNewUserForm ||
        $includesUserRegister
      )
    ){
      // echo "Auth code 0";
      return $this->redirect("/login");
    }

    // IF NON ADMIN USER TRIES TO ACCESS ADMIN ENDPOINTS
    if(
      $this->session->user &&
      $this->session->user->getAvailability() &&
      $includesAdmin &&
      $this->session->user->getRole()->getName() !== "admin"
    ){
      // echo "Auth code 1";
      return $this->redirect("/");
    }

    // IF LOGGED USER IS NOT ACTIVE
    if(  $this->session->user && !$this->session->user->getAvailability()){
      // echo "Auth code 2";
      return $this->redirect("/logout");
    }

    // USER IS LOGGED IN AND TRYING TO ACCESS LOGIN PAGE
    if(
      $this->session->user &&
      $this->session->user->getAvailability() &&
      (
        $includesLogin ||
        $includesNewUserForm ||
        $includesUserRegister
      )
    ){
      // echo "Auth code 3";
      return $this->redirect("/");
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
      'user_password' => $password,
      'user_available' => 1
    ));

    if(count($users) > 0){
      $this->session->user = $users[0];
      $this->redirect("/");
    }else{
      $this->passErrorMessage = "El usuario o contraseña son incorrectos";
      $this->redirect("/login");
    }
  }


  function logout(){
    $this->session->unset('user');
    $this->passSuccessMessage = "Te has deslogueado correctamente";
    $this->redirect("/login");
  }

}
