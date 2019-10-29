<?php namespace Controller;

use Controller\BaseController as BaseController;

use dao\RoleDao               as RoleDao;
use dao\UserDao               as UserDao;

use model\User                as User;
use model\Profile             as Profile;

class UserController extends BaseController{

  function __construct(){
    parent::__construct();
  }

  function create(){
    $userDao = new UserDao();
    $newUserProfile = new Profile($_POST);
    $roleDao = new RoleDao();
    $roles = $roleDao->getList(array( 'role_name' => 'cliente' ));
    $newUserRole = (count($roles) > 0) ? $roles[0] : null;
    $newUserData = $_POST;
    $newUserData['user_profile'] = $newUserProfile;
    $newUserData['user_role'] = $newUserRole;
    $newUser = new User($newUserData);

    // echo "<pre>";
    // print_r($_POST);
    // print_r($newUser);
    // echo "</pre>";

    try{
      $created = $userDao->add($newUser);
    }catch( Exception $ex){
      // $this->passErrorMessage = "Hubo un error creando el usuario";
    }

    if($created){
      $this->passSuccessMessage = "Usuario creado correctamente";
    }else{
      $this->passErrorMessage = "Hubo un error creando el usuario";
    }
    $this->redirect("/login/create");
  }

}
