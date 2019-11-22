<?php namespace Controller;

use Controller\BaseController as BaseController;
use DAO\CinemaRoomDao         as CinemaRoomDao;
use Model\CinemaRoom          as CinemaRoom;

use DAO\CinemaDao             as CinemaDao;
use Model\Cinema              as Cinema;


class CinemaRoomController extends BaseController{

  private $d_cinemaRoom;



  function __construct(){
    parent::__construct();
    $this->d_cinemaRoom = new CinemaRoomDao();
  }



  function index(){
    $d_cinemaRoom = $this->d_cinemaRoom;
    $this->render("cinemaRoomList", array('cinemaRooms' => $d_cinemaRoom->getList()) );
  }



  function createForm(){
    $d_cinema = new CinemaDao();
    $this->render("cinemaRoomForm",
      array(
        'cinema' => $d_cinema->getById($this->params->cinema_id)
      )
    );
  }



  function validCinemaRoom($data){
    $valid = true;
    extract($data);
    if(
      !isset($cinemaroom_name,$cinemaroom_capacity,$cinemaroom_ticketValue) ||
      $cinemaroom_capacity < 1 ||
      $cinemaroom_ticketValue < 1
    ){
      $valid = false;
    }
    return $valid;
  }



  function editForm(){
    extract($this->params->map());
    $d_cinemaRoom   = $this->d_cinemaRoom;
    $d_cinema       = new CinemaDao();
    $cinemaRoom = $d_cinemaRoom->getById($id);
    $this->render("cinemaRoomForm", array(
        'cinemaRoom' => $cinemaRoom,
        'cinema' => $d_cinema->getById($cinemaRoom->getCinema()->getId())
      )
    );
  }



  function create(){
    $created  = false;
    $d_cinema = new CinemaDao();
    $cinema   = $d_cinema->getById($this->params->cinema_id);
    if($this->validCinemaRoom($this->params->map()) && $cinema){
      $d_cinemaRoom   = $this->d_cinemaRoom;
      $new_cinemaRoom = new CinemaRoom($this->params->map());
      $new_cinemaRoom->setCinema($cinema);
      $created = $d_cinemaRoom->add($new_cinemaRoom);
    }else{
      $this->passErrorMessage = "La informacion de la sala no es valida";
    }

    if($created){
      $this->passSuccessMessage = "Sala creada correctamente";
    }else if(!$this->passErrorMessage){
      $this->passErrorMessage = "Hubo un error, la sala no pudo ser creada";
    }

    $this->redirect('/admin/cines/editar' , array('id' => $cinema->getId()));
  }




  function update(){
    $updated = false;
    $d_cinemaRoom = $this->d_cinemaRoom;
    $cinemaRoom = $d_cinemaRoom->getById($this->params->cinemaroom_id);
    if(!$this->validCinemaRoom($this->params->map()) || !$cinemaRoom){
      $this->passErrorMessage = "La informacion de la sala es invalida";
    }else{
      $updated_cinemaroom = new CinemaRoom($this->params->map());
      $updated_cinemaroom->setId($cinemaRoom->getId());
      $updated_cinemaroom->setCinema($cinemaRoom->getCinema());
      try{
        $updated = $d_cinemaRoom->update($updated_cinemaroom);
      }catch(Exception $ex){
        // NOTHING
      }
      if($updated){
        $this->passSuccessMessage = "Sala actualizada correctamente";
      }else if(!$this->passErrorMessage){
        $this->passErrorMessage = "Hubo un error, la sala no pudo ser actualizada";
      }
    }
    $this->redirect('/admin/cines/salas/editar', array('id' => $this->params->cinemaroom_id ));
  }



  function setCinemaRoomAvailability($value){

    $updated          = false;
    $d_cinemaRoom     = $this->d_cinemaRoom;
    $cinemaRoom       = $d_cinemaRoom->getById($this->params->cinemaroom_id);

    if($cinemaRoom){
      $cinemaRoom->setAvailability($value);
      try{
        $updated = $d_cinemaRoom->update($cinemaRoom);
      }catch(Exception $ex){
        // NOTHING
      }
    }

    if($updated){
      $this->passSuccessMessage = "Sala ". ($value ? "activado" : "desactivado") ." correctamente";
    }else{
      $this->passErrorMessage = "Hubo un error, la sala no pudo ser actualizada";
    }

  }



  function disable(){
    $this->setCinemaRoomAvailability(0);
    $this->redirect('/admin/cines/salas/editar', array('id' => $this->params->cinemaroom_id ));
  }




  function enable(){
    $this->setCinemaRoomAvailability(1);
    $this->redirect('/admin/cines/salas/editar', array('id' => $this->params->cinemaroom_id ));
  }



}
