<?php namespace Controller;

use Controller\BaseController as BaseController;

use DAO\ShowDao             	as ShowDao;
use Model\Show                as Show;

use DAO\CinemaDao             as CinemaDao;
use Model\Cinema              as Cinema;

use DAO\MovieDao             	as MovieDao;
use Model\Movie               as Movie;

use HTTPMethod\GET            as GET;
use HTTPMethod\POST           as POST;

class ShowController extends BaseController{

  function __construct(){
    parent::__construct();
  }

  function index(){
    $d_show   = new ShowDao();
    $this->render("showsAdmin", array('shows' => $d_show->getList()) );
  }

  function editShow(){
    extract(GET::getInstance()->map());
    if(isset($show_id)){
      $d_show   = new ShowDao();
      $shows    = $d_show->getList(array( 'show_id' => $show_id ));
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
    $post         = POST::getInstance();
    $d_show       = new ShowDao();
    $d_cinema     = new CinemaDao();
    $d_movie      = new MovieDao();
    $newShowData  = $post->map();
    $movie        = $d_movie->getById($post->show_movie);
    $cinema       = $d_cinema->getById($post->show_cinema);
    $newShowData['show_cinema'] = $cinema;
    $newShowData['show_movie']  = $movie;
    $newShow  = new Show($newShowData);
    $d_show->add($newShow);
    $this->redirect("/admin/funciones");
  }

  function update(){
    $post         = POST::getInstance();
    $d_show       = new ShowDao();
    $d_cinema     = new CinemaDao();
    $d_movie      = new MovieDao();
    $show         = $d_show->getById($post->show_id);
    $updatedShow  = new Show($post->map());
    $updatedShow->setMovie($show->getMovie());
    $updatedShow->setCinema($show->getCinema());
    $d_show->update($updatedShow);
    $this->redirect("/admin/funciones/editar?show_id=$post->show_id");
  }

  function disable(){
    $post         = POST::getInstance();
    $d_show       = new ShowDao();
    $show         = $d_show->getById($post->show_id);
    $show->setAbailability(0);
    $d_show->update($updatedShow);
    $this->redirect("/admin/funciones");
  }

}
