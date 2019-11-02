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

    $filter   = array();
    if(isset($genero)){
      $genres = explode(",",$genero);
      $filter['genres'] = $genres;
    }

    if(isset($fecha)){
      $filter['date'] = $fecha;
    }

    if(isset($cine)){
      $filter['cinema'] = $cine;
    }

    $movies = $d_movie->getMoviesBy($filter);
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
      usort($shows, function($a, $b) {return strcmp($a->getDay(), $b->getDay());});
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
