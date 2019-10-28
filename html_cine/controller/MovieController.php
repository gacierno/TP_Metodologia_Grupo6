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
    $d_genre = new GenreDao();
    if(!isset($genero)) $genero = "";
    $movies = $genero == "" ? $d_movie->getList() : $d_movie->getByGenre($genero);
    $genres = $d_genre->getList();
    include("views/movieList.php");
  }

}
