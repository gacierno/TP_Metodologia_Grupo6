<?php namespace Controller;

use Controller\BaseController as BaseController;
use Controller\UserController as UserController;
use Response\RedirectResponse as RedirectResponse;

use dao\RoleDao               as RoleDao;
use dao\UserDao               as UserDao;

use model\User                as User;
use model\Profile             as Profile;

class AuthenticationController extends BaseController{



  function __construct(){
    parent::__construct();
  }



  function notLoggedIn(){
    if( !$this->session->user ){
      return $this->redirect("/login");
    }
  }



  function authenticate(){
    // GET UPDATED USER FROM DB
    if($this->session->user){
      $d_user = new UserDao();
      $loggedUser = $this->session->user;
      $dbUser = $d_user->getById($loggedUser->getId());
      if(
        $dbUser &&
        $dbUser->getEmail() == $loggedUser->getEmail() &&
        $dbUser->getPass()  == $loggedUser->getPass()
      ){
        // USER IS VALID, UPDATE OBJECT IN SESSION
        $this->session->user = $dbUser;
      }else{
        // USER IN SESSION IS OUTDATED
        $this->session->unset('user');
      }
    }
  }



  function userInactive(){
    // IF LOGGED USER IS NOT ACTIVE
    if(  $this->session->user && !$this->session->user->getAvailability()){
      return $this->redirect("/logout");
    }
  }


  function notAdmin(){

    // IF NON ADMIN USER TRIES TO ACCESS ADMIN ENDPOINTS
    if(
      $this->session->user &&
      $this->session->user->getRole()->getName() !== "admin"
    ){
      return $this->redirect("/");
    }

  }



  function preventDoubleLogin(){
    if( $this->session->user ){
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
    extract($this->params->map());
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
      if(!$this->passErrorMessage) $this->passErrorMessage = "El usuario o contraseña son incorrectos";
      $this->redirect("/login");
    }
  }


  function loginFB(){
    extract($this->params->map());
    if(!isset($fb_id) || empty($fb_id)) return "No se pudo identificar";
    $userDao = new UserDao();
    $matchingFBUsers = $userDao->getList( array( 'fb_id' =>  $fb_id ) );
    $userController = new UserController();
    if(count($matchingFBUsers) < 1) $userController->register(array( 'fb_id' => $fb_id , 'user_email' => $fb_id ));
    $users = $userDao->getList( array( 'fb_id' =>  $fb_id ) );

    if(count($matchingFBUsers) < 1){
      $this->passErrorMessage = "El usuario no pudo ser creado";
    }

    if(count($users) > 0){
      $this->session->user = $users[0];
      $this->redirect("/");
    }else{
      if(!$this->passErrorMessage) $this->passErrorMessage = "El usuario o contraseña son incorrectos";
      $this->redirect("/login");
    }
  }




  function logout(){
    $this->session->unset('user');
    $this->passSuccessMessage = "Te has deslogueado correctamente";
    $this->redirect("/login");
  }

}
