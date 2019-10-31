<?php namespace Controller;

use Controller\BaseController as BaseController;

use dao\RoleDao               as RoleDao;
use dao\UserDao               as UserDao;

use model\User                as User;
use model\Profile             as Profile;

use HTTPMethod\POST           as POST;

class UserController extends BaseController{

  function __construct(){
    parent::__construct();
  }

  function create(){
    // Flag
    $created = false;
    // Default error message
    $errorMessage = "Hubo un error creando el usuario";
    // Parse POST data into objects
    $post    = POST::getInstance();
    $userDao = new UserDao();
    $newUserProfile = new Profile($post->map());
    $roleDao = new RoleDao();
    $roles = $roleDao->getList(array( 'role_name' => 'cliente' ));
    $newUserRole = (count($roles) > 0) ? $roles[0] : null;
    $newUserData = $post->map();
    // Assign role and profile
    $newUserData['user_profile'] = $newUserProfile;
    $newUserData['user_role'] = $newUserRole;
    $newUser = new User($newUserData);
    $matchingUsers = $userDao->getList( array( 'user_email' => $newUser->getEmail()  ) );
    $userExists = count($matchingUsers) > 0;

    if($userExists){
      $errorMessage = "No se puede crear este usuario. El email ya se encuentra registrado";
    }else{
      try{
        $created = $userDao->add($newUser);
      }catch( Exception $ex){
        // $this->passErrorMessage = "Hubo un error creando el usuario";
      }
    }

    if($created){
      $this->passSuccessMessage = "Usuario creado correctamente";
    }else{
      $this->passErrorMessage = $errorMessage;
    }

    $this->redirect("/login");
  }

}
