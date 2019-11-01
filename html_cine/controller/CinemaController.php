<?php namespace Controller;

use Controller\BaseController as BaseController;
use DAO\CinemaDao             as CinemaDao;
use Model\Cinema              as Cinema;
use HTTPMethod\GET            as GET;
use HTTPMethod\POST           as POST;


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
      !isset($cinema_name,$cinema_address,$cinema_capacity,$cinema_ticketValue) ||
      $cinema_capacity < 1 ||
      $cinema_ticketValue < 1
    ){
      $valid = false;
    }
    return $valid;
  }

  function editForm(){
    extract(GET::getInstance()->map());
    $d_cinema   = $this->d_cinema;
    $this->render("cinemaForm", array('cinema' => $d_cinema->getById($id)) );
  }

  function create(){
    $created = false;
    if(!$this->validCinema(POST::getInstance()->map())){
      $this->passErrorMessage = "La informacion del cine no es valida";
    }else{
      $d_cinema   = $this->d_cinema;
      $new_cinema = new Cinema(POST::getInstance()->map());
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
    $post = POST::getInstance();
    $updated = false;
    $d_cinema = $this->d_cinema;
    $cinema = $d_cinema->getById($post->cinema_id);
    if(!$this->validCinema($post->map()) || !$cinema){
      $this->passErrorMessage = "Informacion de cinema invalida";
    }else{
      $new_cinema = new Cinema($post->map());
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
    $this->redirect('/admin/cines/editar', array('id' => $post->cinema_id ));
  }


  function disable(){
    $updated      = false;
    $post         = POST::getInstance();
    $d_cinema     = $this->d_cinema;
    $cinema       = $d_cinema->getById($post->cinema_id);

    if($cinema){
      $cinema->setAvailability(0);
      try{
        $updated = $d_cinema->update($cinema);
      }catch(Exception $ex){
        // NOTHING
      }
    }

    if($updated){
      $this->passSuccessMessage = "Cine desactivado correctamente";
    }else{
      $this->passErrorMessage = "Hubo un error, el cine no pudo ser desactivado";
    }

    $this->redirect('/admin/cines/editar', array('id' => $post->cinema_id ));
  }


  function enable(){
    $updated      = false;
    $post         = POST::getInstance();
    $d_cinema     = $this->d_cinema;
    $cinema       = $d_cinema->getById($post->cinema_id);

    if($cinema){
      $cinema->setAvailability(1);
      try{
        $updated = $d_cinema->update($cinema);
      }catch(Exception $ex){
        // NOTHING
      }
    }

    if($updated){
      $this->passSuccessMessage = "Cine activado correctamente";
    }else{
      $this->passErrorMessage = "Hubo un error, el cine no pudo ser activado";
    }

    $this->redirect('/admin/cines/editar', array('id' => $post->cinema_id ));
  }



}
