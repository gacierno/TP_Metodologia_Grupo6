<?php namespace Controller;

use Controller\BaseController as BaseController;
use DAO\CinemaDao             as CinemaDao;
use Model\Cinema              as Cinema;
use Response\RedirectResponse as RedirectResponse;

class CinemaController extends BaseController{

  function index(){
    $d_cinema = new CinemaDao();
    $cinemas = $d_cinema->getList();
    include("views/cinemaList.php");
  }

  function createForm(){
    include("views/cinemaForm.php");
  }

  function editForm(){
    extract($_GET);
    $d_cinema   = new CinemaDao();
    $cinema     = $d_cinema->getById($id);
    include("views/cinemaForm.php");
  }

  function create(){
    extract($_POST);
    $d_cinema   = new CinemaDao();
    $new_cinema = new Cinema(
      $name,
      $address,
      $capacity,
      $ticketValue
    );
    $d_cinema->add($new_cinema);
    $redirect = new RedirectResponse('/cines');
    return $redirect->send();
  }


  function update(){
    extract($_POST);
    $d_cinema   = new CinemaDao();
    $new_cinema = new Cinema(
      $name,
      $address,
      $capacity,
      $ticketValue,
      $id
    );
    $d_cinema->update($id,$new_cinema);
    $redirect = new RedirectResponse('/cines');
    return $redirect->send();
  }

  function delete(){
    extract($_POST);
    $d_cinema   = new CinemaDao();
    $d_cinema->delete($id);
    $redirect = new RedirectResponse('/cines');
    return $redirect->send();
  }



}
