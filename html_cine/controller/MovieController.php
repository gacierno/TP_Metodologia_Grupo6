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

use HTTPMethod\GET            as GET;


class MovieController extends BaseController{

  function __construct(){
    parent::__construct();
  }

  function index(){
		extract(GET::getInstance()->map());
    $d_movie  = new MovieDao();
    $d_genre  = new GenreDao();
    $d_cinema = new CinemaDao();
    $req      = new Request();
    $movies   = array();
    // IF GENERO IS EMPTY UNSET IT
    if(isset($genero) && $genero == "") unset($genero);
    // FILTER BY GENERO AND DATE
    if(isset($genero,$fecha)){
      $movies = $d_movie->getMoviesByGenresAndDate(
        explode(",",$genero),
        $fecha
      );
    // FILTER BY GENERO
    }else if(isset($genero)){
      $movies = $d_movie->getMoviesByGenres(explode(",",$genero));
    // FILTER BY DATE
    }else if(isset($fecha)){
      $movies = $d_movie->getMoviesByDate($fecha);
    // RETURN THE ENTIRE LIST
    }else{
      $movies = $d_movie->getList();
    }
    // echo $fecha;
    $this->render("movieList",
      array(
        'movies'  => $movies,
        'genres'  => $d_genre->getList(),
        'cinemas' => $d_cinema->getList()
      )
    );
  }


  function detail(){
    extract(GET::getInstance()->map());
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
        if(!isset($showsByCinema[$cinemaID])){
          $showsByCinema[$cinemaID] = array(
            'cinema' => $show->getCinema(),
            'shows'  => array()
          );
        }
        array_push($showsByCinema[$cinemaID]['shows'],$show);
      }
      $this->render("movieDetail",
        array(
          'movie'           => $movie,
          'showsByCinema'   => $showsByCinema
        )
      );
    }
  }

}
