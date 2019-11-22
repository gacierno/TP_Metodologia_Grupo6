<?php namespace Controller;

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
		extract($this->params->map());
    $d_movie  = new MovieDao();
    $d_genre  = new GenreDao();
    $d_cinema = new CinemaDao();
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
    extract($this->params->map());
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
        $cinemaID = $show->getCinemaRoom()->getCinema()->getId();
        if(!isset($showsByCinema[$cinemaID])){
          $showsByCinema[$cinemaID] = array(
            'cinema' => $show->getCinemaRoom()->getCinema(),
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
