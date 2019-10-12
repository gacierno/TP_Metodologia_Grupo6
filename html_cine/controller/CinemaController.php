<?php namespace Controller;

use Controller\BaseController as BaseController;
use DAO\CinemaDao             as CinemaDao;
use Model\Cinema              as Cinema;
use Response\RedirectResponse as RedirectResponse;

class CinemaController extends BaseController{

  function index(){
    $d_cinema = new CinemaDao();
    echo json_encode($d_cinema->getCinemaList());
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
