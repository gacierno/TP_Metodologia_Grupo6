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
    $this->render("cinemaRoomForm");
  }



  function validcinemaRoom($data){
    $valid = true;
    extract($data);
    if(
      !isset($cinemaRoom_name,$cinemaRoom_capacity,$cinemaRoom_ticketValue) ||
      $cinemaRoom_capacity < 1 ||
      $cinemaRoom_ticketValue < 1
    ){
      $valid = false;
    }
    return $valid;
  }



  function editForm(){
    extract($this->params->map());
    $d_cinemaRoom   = $this->d_cinemaRoom;
    $this->render("cinemaRoomForm", array('cinemaRoom' => $d_cinemaRoom->getById($id)) );
  }



  function create(){
    $created = false;
    if(!$this->validcinemaRoom($this->params->map())){
      $this->passErrorMessage = "La informacion del cine no es valida";
    }else{
      $d_cinemaRoom   = $this->d_cinemaRoom;
      $new_cinemaRoom = new CinemaRoom($this->params->map());
      $created = $d_cinemaRoom->add($new_cinemaRoom);
    }
    /*
      - Set Cinema to Room
      - Add $cinema object to create form for sala
    */

    if($created){
      $this->passSuccessMessage = "Cine creado correctamente";
    }else{
      $this->passErrorMessage = "Hubo un error, el cine no pudo ser creado";
    }

    $this->redirect('/admin/cines/nuevo');
  }




  function update(){
    $updated = false;
    $d_cinemaRoom = $this->d_cinemaRoom;
    $cinemaRoom = $d_cinemaRoom->getById($this->params->cinemaRoom_id);
    if(!$this->validcinemaRoom($this->params->map()) || !$cinemaRoom){
      $this->passErrorMessage = "Informacion de cinemaRoom invalida";
    }else{
      $new_cinemaRoom = new CinemaRoom($this->params->map());
      $new_cinemaRoom->setId($cinemaRoom->getId());
      try{
        $updated = $d_cinemaRoom->update($new_cinemaRoom);
      }catch(Exception $ex){
        // NOTHING
      }
      if($updated){
        $this->passSuccessMessage = "Cine actualizado correctamente";
      }else{
        $this->passErrorMessage = "Hubo un error, el cine no pudo ser actualizado";
      }
    }
    $this->redirect('/admin/cines/editar', array('id' => $this->params->cinemaRoom_id ));
  }



  function setCinemaRoomAvailability($value){

    $updated      = false;
    $d_cinemaRoom     = $this->d_cinemaRoom;
    $cinemaRoom       = $d_cinemaRoom->getById($this->params->cinemaRoom_id);

    if($cinemaRoom){
      $cinemaRoom->setAvailability($value);
      try{
        $updated = $d_cinemaRoom->update($cinemaRoom);
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
    $this->setCinemaRoomAvailability(0);
    $this->redirect('/admin/cines/editar', array('id' => $this->params->cinemaRoom_id ));
  }




  function enable(){
    $this->setCinemaRoomAvailability(1);
    $this->redirect('/admin/cines/editar', array('id' => $this->params->cinemaRoom_id ));
  }



}
