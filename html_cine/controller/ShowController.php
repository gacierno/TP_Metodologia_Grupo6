<?php namespace Controller;

use \Datetime;
use \DateInterval;

use Controller\BaseController as BaseController;

use DAO\ShowDao             	as ShowDao;
use Model\Show                as Show;

use DAO\CinemaDao             as CinemaDao;
use Model\Cinema              as Cinema;

use DAO\CinemaRoomDao         as CinemaRoomDao;
use Model\CinemaRoom          as CinemaRoom;

use DAO\MovieDao             	as MovieDao;
use Model\Movie               as Movie;


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
    extract($this->params->map());
    $d_cinemaRoom    = new CinemaRoomDao();
    $d_movie     = new MovieDao();
    if(isset($show_id)){
      $d_show   = $this->d_show;
      $shows    = $d_show->getList(array( 'show_id' => $show_id ));
      if(count($shows) < 1){
        $this->errorMessage = "El show no existe";
      }else{
        $show = $shows[0];
      }
    }
    $this->render("showsForm", array(
        'show' => $show,
        'movies'  => $d_movie->getList(),
        'cinemaRooms' => $d_cinemaRoom->getList()
      )
    );
  }



  function newShow(){
    $d_cinemaRoom    = new CinemaRoomDao();
    $d_movie     = new MovieDao();
    $this->render("showsForm",
      array(
        'movies'  => $d_movie->getList(),
        'cinemaRooms' => $d_cinemaRoom->getList()
      )
    );
  }



  function validateShowTime($date,$time,$cine,$existing_show = false){
    $timeArray = explode(":",$this->sanitizeTime($time));
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
        'column' => "show_end_time",
        'operator' => ">=",
        'condition' => "and",
        'value' => $minRange
      ),
      array(
        'column' => "show_time",
        'operator' => "<=",
        'condition' => "and",
        'value' => $maxRange
      ),
      array(
        'column' => "show_available",
        'operator' => "=",
        'condition' => "and",
        'value' => 1
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
    /*

      |show_time|...|show_end_time|
                  |$minRange||show_time|...|show_end_time\|$maxRange|

    */

    $shows = $this->d_show->getListWhere($query);


    return !($shows && count($shows) > 0);
  }


  function validateMovieOwnership($date,$movie,$cinemaroom_ids){
    $shows  = $this->d_show->getListWhere(
      array(
        array(
          'column' => "cinemaroom_id",
          'operator' => "NOT IN",
          'condition' => "and",
          'value' => $cinemaroom_ids
        ),
        array(
          'column' => "show_date",
          'operator' => "=",
          'condition' => "and",
          'value' => $date
        ),
        array(
          'column' => "movie_id",
          'operator' => "=",
          'condition' => "and",
          'value' => $movie
        ),
        array(
          'column' => "show_available",
          'operator' => "=",
          'condition' => "and",
          'value' => 1
        )
      )
    );

    return !($shows && count($shows) > 0);
  }



  function validateShowCreationData($data){
    extract($data);
    return isset($show_date,$show_time,$show_cinemaroom,$show_movie);
  }


  function validate($existing_show = false){
    $show_id = false;
    extract($this->params->map());

    if(
      $existing_show &&
      $this->d_show->getById($existing_show->getId())
    ){
      $show_date          = $existing_show->getDay();
      $show_movie         = $existing_show->getMovie()->getId();
      $show_cinemaroom    = $existing_show->getCinemaRoom()->getId();
      $show_time          = $existing_show->getTime();
      $show_id            = $existing_show->getId();
    }

    return (
      (
        $existing_show ||
        $this->validateShowCreationData($this->params->map())
      ) &&
      // VALIDATE THAT PREVIOUS AND NEXT FUNCTION IS 15 MINUTES AWAY
      $this->validateShowTime(
        $show_date,
        $show_time,
        $show_cinemaroom,
        $show_id
      ) &&
      // VALIDATE THAT A MOVIE CAN ONLY BELONG TO A SINGLE CINEMA EACH DAY
      $this->validateMovieOwnership(
        $show_date,
        $show_movie,
        $show_cinemaroom
      )
    );
  }



  function updateShowEndTime(Show $show){
    $timeArray = explode(":",$show->getTime());
    $dt = new DateTime();
    $dt->setTime($timeArray[0],$timeArray[1],$timeArray[2]);
    $dt->add(DateInterval::createFromDateString($show->getMovie()->getDuration() . ' minutes'));
    $show->setEndTime($dt->format('H:i:s'));
    return $show;
  }

  function sanitizeTime($timeString){
    $timeArray = explode(":",$timeString);
    if(count($timeArray) == 1){
      array_push($timeArray,"00","00");
    }else if(count($timeArray) == 2){
      array_push($timeArray,"00");
    }else if(count($timeArray) == 0){
      $timeArray = ["00","00","00"];
    }
    return implode(":",$timeArray);
  }



  function create(){
    $created = false;
    if($this->validate()){

      $d_cinemaRoom   = new CinemaRoomDao();
      $d_movie        = new MovieDao();
      $movie          = $d_movie->getById($this->params->show_movie);
      $cinemaRoom     = $d_cinemaRoom->getById($this->params->show_cinemaroom);

      if($movie && $cinemaRoom){
        $newShowData  = $this->params->map();
        $newShow  = new Show($newShowData);
        $newShow->setCinemaRoom($cinemaRoom);
        $newShow->setMovie($movie);
        $newShow->setTime($this->sanitizeTime($newShow->getTime()));
        $newShow  = $this->updateShowEndTime($newShow);
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

    $d_cinemaRoom     = new CinemaRoomDao();
    $d_movie      = new MovieDao();
    $show         = $this->d_show->getById($this->params->show_id);
    $movie        = $d_movie->getById($this->params->show_movie);
    $cinemaRoom   = $d_cinemaRoom->getById($this->params->show_cinemaroom);

    if($movie && $cinemaRoom && $show){

      $updatedShow = new Show($this->params->map());
      $updatedShow->setMovie($movie);
      $updatedShow->setCinemaRoom($cinemaRoom);
      $updatedShow->setId($show->getId());
      $updatedShow->setAvailability($show->getAvailability());


      if($this->validate($updatedShow)){
        $updatedShow->setTime($this->sanitizeTime($updatedShow->getTime()));
        $updatedShow = $this->updateShowEndTime($updatedShow);
        try{
          $this->d_show->update($updatedShow);
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

    $this->redirect("/admin/funciones/editar", array('show_id' => $this->params->show_id));
  }



  function setShowAvailability($value){
    $updated      = false;
    $show         = $this->d_show->getById($this->params->show_id);

    if($show){

      $show->setAvailability($value);
      try{
        $this->d_show->update($show);
        $updated = true;
      }catch(Exception $ex){
        // NOTHING
      }
    }

    if($updated){
      $this->passSuccessMessage = "Show ". ($value ? "activado" : "desactivado") ." correctamente";
    }else{
      $this->passErrorMessage = "Hubo un error, el show no pudo ser actualizado";
    }
  }



  function disable(){
    $this->setShowAvailability(0);
    $this->redirect("/admin/funciones");
  }



  function enable(){
    $show    = $this->d_show->getById($this->params->show_id);
    if($this->validate($show)){
      $this->setShowAvailability(1);
    }else{
      $this->passErrorMessage = "Hubo un error, el show no pudo ser actualizado";
    }
    $this->redirect("/admin/funciones");
  }

}
