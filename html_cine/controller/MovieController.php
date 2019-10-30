<?php namespace Controller;

use Request\Request           as Request;
use Controller\BaseController as BaseController;

use DAO\MovieDao             	as MovieDao;
use Model\Movie               as Movie;

use DAO\GenreDao             	as GenreDao;
use Model\Genre               as Genre;

use DAO\ShowDao             	as ShowDao;
use Model\Show                as Show;

use DAO\CinemaDao             as CinemaDao;
use Model\Cinema              as Cinema;


class MovieController extends BaseController{

  function __construct(){
    parent::__construct();
  }

  function index(){
		extract($_GET);
    $d_movie  = new MovieDao();
    $d_genre  = new GenreDao();
    $d_cinema = new CinemaDao();
    $req      = new Request();
    if(!isset($genero)) $genero = "";
    $movies   = $genero == "" ? $d_movie->getList() : $d_movie->getByGenre($genero);
    $genres   = $d_genre->getList();
    $cinemas  = $d_cinema->getList();
    $user     = $this->session->user;
    $this->render("movieList");
  }

  function detail(){
    extract($_GET);
    if(isset($id)){
      $shows    = array();
      $d_movie  = new MovieDao();
      $d_show   = new ShowDao();
      $movies   = $d_movie->getList(array( 'movie_id' => $id ));
      $movie    = count($movies) > 0 ? $movies[0] : null;
      $shows    = $d_show->getList(array( 'movie_id' => $id ));
      $showsByCinema = array();
      foreach($shows as $show){
        $cinemaID = $show->getCinema()->getId();
        if(!isset($showsByCinema[$cinemaID])) $showsByCinema[$cinemaID] = array();
        array_push($showsByCinema[$cinemaID],$show);
      }
      $this->render("movieDetail");
    }
  }

}
