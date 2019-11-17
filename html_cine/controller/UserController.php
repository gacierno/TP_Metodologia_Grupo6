<?php namespace Controller;

use Controller\BaseController as BaseController;

use dao\RoleDao               as RoleDao;
use dao\UserDao               as UserDao;
use dao\ProfileDao            as ProfileDao;

use model\User                as User;
use model\Profile             as Profile;

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
    if(!$this->params->user_id){
      $this->passErrorMessage = "Debe especificar un usuario";
    }else{
      $d_user = $this->d_user;
      $user = $d_user->getById($this->params->user_id);
      if($this->verifyOwnership($user)){
        return $user;
      }
    }
  }



  function setUserAvailability($value){
    $updated = false;
    $user = $this->prepareUserForUpdate();
    if(isset($user)){
      $user->setAvailability($value);
      try{
        $this->d_user->update($user);
        $updated = true;
      }catch(Exception $ex){
        // NOTHING
      }
    }

    if($updated){
      $this->passSuccessMessage = "El usuario se ha ". ($value ? "activado" : "desactivado") ." con exito";
    }else{
      $this->passErrorMessage = "Hubo un error al intentar actualizar los datos";
    }

  }



  function enable(){
    $this->setUserAvailability(1);
    $this->redirect("/usuario");
  }



  function disable(){
    $this->setUserAvailability(0);
    $this->redirect("/logout");
  }




  function update(){
    $updated = false;
    $user = $this->prepareUserForUpdate();
    $d_user = $this->d_user;
    $d_profile = new ProfileDao();
    if(isset($user)){
      // UPDATE PROFILE
      $updatedProfile = new Profile($this->params->map());
      $updatedProfile->setId($user->getProfile()->getId());
      // UPDATE USER
      $updatedUser = new User($this->params->map());
      $updatedUser->setId($user->getId());
      $updatedUser->setEmail($user->getEmail());
      $updatedUser->setRole($user->getRole());
      $updatedUser->setProfile($updatedProfile);
      // SAVE
      try{
        $profile_updated = $d_profile->update($updatedProfile);
        $user_updated = $d_user->update($updatedUser);
        $updated = true; // $profile_updated && $user_updated;
      }catch(Exception $ex){
        // NOTHING
      }
    }

    if($updated){
      $this->passSuccessMessage = "Los datos se han actualizado con exito";
    }else{
      $this->passErrorMessage = "Hubo un error al intentar actualizar los datos";
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
    $userDao = $this->d_user;
    $newUserProfile = new Profile($this->params->map());
    $roleDao = new RoleDao();
    $roles = $roleDao->getList(array( 'role_name' => 'cliente' ));
    $newUserRole = (count($roles) > 0) ? $roles[0] : null;
    $newUserData = $this->params->map();
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
