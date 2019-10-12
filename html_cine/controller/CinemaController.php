<?php namespace Controller;

use Controller\BaseController as BaseController;
use DAO\CinemaDao             as CinemaDao;
use Model\Cinema              as Cinema;
use Response\RedirectResponse as RedirectResponse;

class CinemaController extends BaseController{

  function index(){
    $d_cinema = new CinemaDao();
    $cinemas = $d_cinema->getCinemaList();
    include("views/cinemaForm.php");
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
    $d_cinema   = new CinemaDao();
    extract($_POST);
    $new_cinema = new Cinema(
      $name,
      $address,
      $capacity,
      $ticketValue
    );
    $d_cinema->addCinema($new_cinema);
    return new RedirectResponse('/cines');
  }



}
