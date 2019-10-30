<?php namespace Controller;

use Controller\BaseController as BaseController;
use DAO\MovieDao             	as MovieDao;
use Model\Movie               as Movie;
use DAO\GenreDao             	as GenreDao;
use Model\Genre               as Genre;
use Response\RedirectResponse as RedirectResponse;

class MovieController extends BaseController{

  function __construct(){
    parent::__construct();
  }

  function index(){
		extract($_GET);
    $d_movie = new MovieDao();
    $d_genre = new GenreDao();
    if(!isset($genero)) $genero = "";
    $movies = $genero == "" ? $d_movie->getList() : $d_movie->getByGenre($genero);
    $genres = $d_genre->getList();
    include("views/movieList.php");
  }

  function detail(){
    extract($_GET);
    if(isset($id)){
      $shows = array();
      $d_movie = new MovieDao();
      $movies = $d_movie->getList(array( 'movie_id' => $id ));
      $movie = count($movies) > 0 ? $movies[0] : null;
      include("views/movieDetail.php");
    }

  }

}
