<?php namespace Controller;

use Controller\BaseController as BaseController;
use DAO\CinemaDao             as CinemaDao;
use Model\Cinema              as Cinema;


class CinemaController extends BaseController{

  private $d_cinema;



  function __construct(){
    parent::__construct();
    $this->d_cinema = new CinemaDao();
  }



  function index(){
    $d_cinema = $this->d_cinema;
    $this->render("cinemaList", array('cinemas' => $d_cinema->getList()) );
  }



  function createForm(){
    $this->render("cinemaForm");
  }



  function validCinema($data){
    $valid = true;
    extract($data);
    if(
      !isset($cinema_name,$cinema_address)
    ){
      $valid = false;
    }
    return $valid;
  }

  // function validCinema($data){
  //   $valid = true;
  //   extract($data);
  //   if(
  //     !isset($cinema_name,$cinema_address,$cinema_capacity,$cinema_ticketValue) ||
  //     $cinema_capacity < 1 ||
  //     $cinema_ticketValue < 1
  //   ){
  //     $valid = false;
  //   }
  //   return $valid;
  // }



  function editForm(){
    extract($this->params->map());
    $d_cinema   = $this->d_cinema;
    $this->render("cinemaForm", array('cinema' => $d_cinema->getById($id)) );
  }



  function create(){
    $created = false;
    if(!$this->validCinema($this->params->map())){
      $this->passErrorMessage = "La informacion del cine no es valida";
    }else{
      $d_cinema   = $this->d_cinema;
      $new_cinema = new Cinema($this->params->map());
      $created = $d_cinema->add($new_cinema);
    }

    if($created){
      $this->passSuccessMessage = "Cine creado correctamente";
    }else{
      $this->passErrorMessage = "Hubo un error, el cine no pudo ser creado";
    }

    $this->redirect('/admin/cines/nuevo');
  }




  function update(){
    $updated = false;
    $d_cinema = $this->d_cinema;
    $cinema = $d_cinema->getById($this->params->cinema_id);
    if(!$this->validCinema($this->params->map()) || !$cinema){
      $this->passErrorMessage = "Informacion de cinema invalida";
    }else{
      $new_cinema = new Cinema($this->params->map());
      $new_cinema->setId($cinema->getId());
      try{
        $updated = $d_cinema->update($new_cinema);
      }catch(Exception $ex){
        // NOTHING
      }
      if($updated){
        $this->passSuccessMessage = "Cine actualizado correctamente";
      }else{
        $this->passErrorMessage = "Hubo un error, el cine no pudo ser actualizado";
      }
    }
    $this->redirect('/admin/cines/editar', array('id' => $this->params->cinema_id ));
  }



  function setCinemaAvailability($value){

    $updated      = false;
    $d_cinema     = $this->d_cinema;
    $cinema       = $d_cinema->getById($this->params->cinema_id);

    if($cinema){
      $cinema->setAvailability($value);
      try{
        $updated = $d_cinema->update($cinema);
      }catch(Exception $ex){
        // NOTHING
      }
    }

    if($updated){
      $this->passSuccessMessage = "Cine ". ($value ? "activado" : "desactivado") ." correctamente";
    }else{
      $this->passErrorMessage = "Hubo un error, el cine no pudo ser actualizado";
    }

  }



  function disable(){
    $this->setCinemaAvailability(0);
    $this->redirect('/admin/cines/editar', array('id' => $this->params->cinema_id ));
  }




  function enable(){
    $this->setCinemaAvailability(1);
    $this->redirect('/admin/cines/editar', array('id' => $this->params->cinema_id ));
  }



}
