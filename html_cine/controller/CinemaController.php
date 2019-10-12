<?php namespace Controller;

use Controller\BaseController as BaseController;
use DAO\CinemaDao             as CinemaDao;
use Model\Cinema              as Cinema;
use Response\RedirectResponse as RedirectResponse;

class CinemaController extends BaseController{

  function index(){
    $d_cinema = new CinemaDao();
    $cinemas = $d_cinema->getCinemaList();
    include("views/cinemaList.php");
  }

  function createForm(){
    include("views/cinemaAdd.php");
  }

  function editForm(){
    include("views/cinemaUpdate.php");
  }

  function deleteForm(){
    include("views/cinemaDelete.php");
  }

  function create(){
    extract($_POST);
    $d_cinema   = new CinemaDao();
    $new_cinema = new Cinema(
      $name,
      $address,
      $capacity,
      $ticketvalue
    );
    $d_cinema->addCinema($new_cinema);
    return new RedirectResponse('/cines');
  }


  function update(){
    extract($_POST);
    $d_cinema   = new CinemaDao();
    $d_cinema->getById($cinema_id);
    return new RedirectResponse('/cines');
  }



}
