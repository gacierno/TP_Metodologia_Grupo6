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
    $this->render("showsAdmin", array('shows' => $d_show->getList()) );
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
    $this->render("showsForm", array('show' => $show) );
  }

  function newShow(){
    $d_cinema    = new CinemaDao();
    $d_movie     = new MovieDao();
    $this->render("showsForm",
      array(
        'movies'  => $d_movie->getList(),
        'cinemas' => $d_cinema->getList()
      )
    );
  }

  function create(){
    $d_show       = new ShowDao();
    $d_cinema     = new CinemaDao();
    $d_movie      = new MovieDao();
    $newShowData  = $_POST;
    $movie        = $d_movie->getById($_POST['show_movie']);
    $cinema       = $d_cinema->getById($_POST['show_cinema']);
    $newShowData['show_cinema'] = $cinema;
    $newShowData['show_movie']  = $movie;
    $newShow  = new Show($newShowData);
    $d_show->add($newShow);
  }

  function update(){

  }

  function delete(){

  }

}
