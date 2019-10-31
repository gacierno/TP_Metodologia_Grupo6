<?php namespace Controller;

use Controller\BaseController as BaseController;
use DAO\CinemaDao             as CinemaDao;
use Model\Cinema              as Cinema;


class CinemaController extends BaseController{

  function __construct(){
    parent::__construct();
  }

  function index(){
    $d_cinema = new CinemaDao();
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
    extract($_GET);
    $d_cinema   = new CinemaDao();
    $this->render("cinemaForm", array('cinema' => $d_cinema->getById($id)) );
  }

  function create(){
    $created = false;
    if(!$this->validCinema($_POST)){
      return $this->throw("Informacion de cinema invalida");
    }
    $d_cinema   = new CinemaDao();
    $new_cinema = new Cinema($_POST);
    $created = $d_cinema->add($new_cinema);
    // print_r($new_cinema);
    if($created){
      $this->passSuccessMessage = "Cine creado correctamente";
    }else{
      $this->passErrorMessage = "Hubo un error, el cine no pudo ser creado";
    }
    $this->redirect('/admin/cines/nuevo');
  }


  function update(){
    if(!$this->validCinema($_POST) || !isset($id)){
      return $this->throw("Informacion de cinema invalida");
    }
    $d_cinema   = new CinemaDao();
    $new_cinema = new Cinema($_POST);
    $d_cinema->update($id,$new_cinema);
    $this->redirect('/cines');
  }

  function delete(){
    extract($_POST);
    $d_cinema   = new CinemaDao();
    $d_cinema->delete($id);
    $this->redirect('/cines');
  }



}
