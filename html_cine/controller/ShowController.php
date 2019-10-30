<?php namespace Controller;

use Controller\BaseController as BaseController;

use DAO\ShowDao             	as ShowDao;
use Model\Show                as Show;

use DAO\CinemaDao             as CinemaDao;
use Model\Cinema              as Cinema;

use DAO\MovieDao             	as MovieDao;
use Model\Movie               as Movie;

class ShowController extends BaseController{

  function __construct(){
    parent::__construct();
  }

  function index(){
    $d_show   = new ShowDao();
    $shows    = $d_show->getList();
    include("views/showsAdmin.php");
  }

  function editShow(){
    extract($_GET);
    if(isset($id)){
      $d_show   = new ShowDao();
      $shows    = $d_show->getList(array( 'show_id' => $id ));
      if(count($shows) < 1){
        $this->errorMessage = "El show no existe";
      }else{
        $show = $shows[0];
      }
    }
    include("views/showsForm.php");
  }

  function newShow(){
    $d_cinema    = new CinemaDao();
    $cinemas     = $d_cinema->getList();
    $d_movie     = new MovieDao();
    $movies      = $d_movie->getList();
    include("views/showsForm.php");
  }

}
