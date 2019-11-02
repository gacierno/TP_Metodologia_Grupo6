<?php namespace Controller;

use \Datetime;
use \DateInterval;

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

  private $d_show;


  function __construct(){
    parent::__construct();
    $this->d_show = new ShowDao();
  }


  function index(){
    $d_show   = $this->d_show;
    $this->render("showsAdmin", array('shows' => $d_show->getList()) );
  }


  function editShow(){
    extract(GET::getInstance()->map());
    if(isset($show_id)){
      $d_show   = $this->d_show;
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


  function validateShowTime($date,$time,$cine,$existing_show = false){
    $timeArray = explode(":",$time);
    if(count($timeArray) == 1){
      array_push($timeArray,"00","00");
    }else if(count($timeArray) == 2){
      array_push($timeArray,"00");
    }
    if(count($timeArray) != 3) return false;
    $dt = new DateTime();
    $dt->setTime($timeArray[0],$timeArray[1],$timeArray[2]);
    $dt->add(DateInterval::createFromDateString('15 minutes'));
    $maxRange = $dt->format('H:i:s');
    $dt->sub(DateInterval::createFromDateString('30 minutes'));
    $minRange = $dt->format('H:i:s');

    $query = array(
      array(
        'column' => "show_date",
        'operator' => "=",
        'condition' => "and",
        'value' => $date
      ),
      array(
        'column' => "cinema_id",
        'operator' => "=",
        'condition' => "and",
        'value' => $cine
      ),
      array(
        'column' => "show_time",
        'operator' => ">=",
        'condition' => "and",
        'value' => $minRange
      ),
      array(
        'column' => "show_time",
        'operator' => "<=",
        'condition' => "and",
        'value' => $maxRange
      )
    );

    if($existing_show){
      array_push($query,
        array(
          'column' => "show_id",
          'operator' => "!=",
          'condition' => "and",
          'value' => $existing_show
        )
      );
    }

    $shows = $this->d_show->getListWhere($query);

    return !($shows && count($shows) > 0);
  }

  function validateMovieOwnership($date,$movie,$cine){
    $shows  = $this->d_show->getListWhere(
      array(
        array(
          'column' => "show_date",
          'operator' => "=",
          'condition' => "and",
          'value' => $date
        ),
        array(
          'column' => "cinema_id",
          'operator' => "!=",
          'condition' => "and",
          'value' => $cine
        ),
        array(
          'column' => "movie_id",
          'operator' => "=",
          'condition' => "and",
          'value' => $movie
        )
      )
    );

    return !($shows && count($shows) > 0);
  }


  function validateShowCreationData($data){
    extract($data);
    return isset($show_date,$show_time,$show_cinema,$show_movie);
  }

  function validate($existing_show = false){
    $post    = POST::getInstance();
    return (
      $this->validateShowCreationData($post->map()) &&
      // VALIDATE THAT PREVIOUS AND NEXT FUNCTION IS 15 MINUTES AWAY
      $this->validateShowTime(
        $post->show_date,
        $post->show_time,
        $post->show_cinema,
        $existing_show
      ) &&
      // VALIDATE THAT A MOVIE CAN ONLY BELONG TO A SINGLE CINEMA EACH DAY
      $this->validateMovieOwnership(
        $post->show_date,
        $post->show_movie,
        $post->show_cinema
      )
    );
  }


  function create(){
    $created = false;
    $post    = POST::getInstance();
    if($this->validate()){

      $d_cinema     = new CinemaDao();
      $d_movie      = new MovieDao();
      $movie        = $d_movie->getById($post->show_movie);
      $cinema       = $d_cinema->getById($post->show_cinema);

      if($movie && $cinema){
        $newShowData  = $post->map();
        $newShowData['show_cinema'] = $cinema;
        $newShowData['show_movie']  = $movie;
        $newShow  = new Show($newShowData);
        try{
          $created = $this->d_show->add($newShow);
        }catch(Exception $ex){
          // NOTHING
        }
      }
    }

    if($created){
      $this->passSuccessMessage = "La funcion fue creada correctamente";
      $this->redirect("/admin/funciones");
    }else{
      $this->passErrorMessage = "Hubo un error, la funcion no pudo ser creada";
      $this->redirect("/admin/funciones/nuevo");
    }

  }

  function update(){
    $updated = false;
    $post    = POST::getInstance();
    if($this->validate($post->show_id)){

      $d_show       = $this->d_show;
      $show         = $d_show->getById($post->show_id);
      if($show){
        $updatedShow  = new Show($post->map());
        $updatedShow->setMovie($show->getMovie());
        $updatedShow->setCinema($show->getCinema());
        $updatedShow->setId($show->getId());
        try{
          $d_show->update($updatedShow);
          $updated = true;
        }catch(Exception $ex){
          // NOTHING
        }
      }
    }

    if($updated){
      $this->passSuccessMessage = "La funcion fue actualizada correctamente";
    }else{
      $this->passErrorMessage = "Hubo un error, la funcion no pudo ser actualizada";
    }

    $this->redirect("/admin/funciones/editar", array('show_id' => $post->show_id));
  }

  function disable(){
    $post         = POST::getInstance();
    $d_show       = $this->d_show;
    $show         = $d_show->getById($post->show_id);
    $show->setAvailability(0);
    $d_show->update($show);
    $this->redirect("/admin/funciones");
  }

}
