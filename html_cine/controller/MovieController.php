<?php namespace Controller;

use Controller\BaseController as BaseController;
use DAO\MovieDao             	as MovieDao;
use Model\Movie               as Movie;
use DAO\GenreDao             	as GenreDao;
use Model\Genre               as Genre;
use Response\RedirectResponse as RedirectResponse;

class MovieController extends BaseController{

  function index(){
		extract($_GET);
    $d_movie = new MovieDao();
    $movies = $d_movie->getList();
    include("views/movieList.php");
  }

}
