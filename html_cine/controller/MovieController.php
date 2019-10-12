<?php namespace Controller;

use Controller\BaseController as BaseController;
use DAO\MovieDao             	as MovieDao;
use Model\Movie               as Movie;
use Response\RedirectResponse as RedirectResponse;

class MovieController extends BaseController{

  function index(){
		extract($_GET);
    $d_movie = new MovieDao();
    $movies = $d_movie->getMovieList();
    include("views/movieList.php");
  }

}
