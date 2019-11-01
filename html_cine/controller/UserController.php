<?php namespace Controller;

use Controller\BaseController as BaseController;

use dao\RoleDao               as RoleDao;
use dao\UserDao               as UserDao;
use dao\ProfileDao            as ProfileDao;

use model\User                as User;
use model\Profile             as Profile;

use HTTPMethod\POST           as POST;

class UserController extends BaseController{

  private $d_user;

  function __construct(){
    parent::__construct();
    $this->d_user = new UserDao();
  }

  function verifyOwnership(User $user){
    $sessionUser = $this->session->user;
    $verified = false;
    if(
      isset($user,$sessionUser) &&
      (
        $sessionUser->getRole()->getName() == "admin" ||
        $user->getId() == $sessionUser->getId()
      )
    ){
      $verified = true;
    }
    return $verified;
  }

  function prepareUserForUpdate(){
    $post = POST::getInstance();
    if(!$post->user_id){
      $this->passErrorMessage = "Debe especificar un usuario";
    }else{
      $d_user = $this->d_user;
      $user = $d_user->getById($post->user_id);
      if($this->verifyOwnership($user)){
        return $user;
      }
    }
  }

  function enable(){
    $user = $this->prepareUserForUpdate();
    if(isset($user)){
      $user->setAvailability(1);
      $d_user->update($user);
      $this->passSuccessMessage = "El usuario se ha activado con exito";
    }
    $this->redirect("/usuario");
  }

  function disable(){
    $user = $this->prepareUserForUpdate();
    if(isset($user)){
      $user->setAvailability(0);
      $d_user->update($user);
      $this->passSuccessMessage = "El usuario se ha desactivado con exito";
    }
    $this->redirect("/logout");
  }


  function update(){
    $user = $this->prepareUserForUpdate();
    $d_user = $this->d_user;
    $d_profile = new ProfileDao();
    if(isset($user)){
      $post = POST::getInstance();
      // UPDATE PROFILE
      $updatedProfile = new Profile($post->map());
      $updatedProfile->setId($user->getProfile()->getId());
      // UPDATE USER
      $updatedUser = new User($post->map());
      $updatedUser->setId($user->getId());
      $updatedUser->setEmail($user->getEmail());
      $updatedUser->setRole($user->getRole());
      $updatedUser->setProfile($updatedProfile);
      // SAVE
      $d_profile->update($updatedProfile);
      $d_user->update($updatedUser);
      $this->passSuccessMessage = "El ha sido actualizado con exito";
    }

    $this->redirect("/usuario");
  }


  function detail(){
    $this->render('userDetail');
  }


  function create(){
    // Flag
    $created = false;
    // Default error message
    $errorMessage = "Hubo un error creando el usuario";
    // Parse POST data into objects
    $post    = POST::getInstance();
    $userDao = $this->d_user;
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
