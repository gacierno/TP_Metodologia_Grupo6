<?php namespace Controller;

use Controller\BaseController as BaseController;

use DAO\ShowDao             	as ShowDao;
use Model\Show                as Show;

use DAO\PurchaseDao           as PurchaseDao;
use Model\Purchase            as Purchase;

use DAO\CinemaDAO             as CinemaDAO;
use Model\Cinema             as Cinema;

use DAO\TicketDao             as TicketDao;
use Model\Ticket              as Ticket;

use DAO\MovieDao             	as MovieDao;
use Model\Movie               as Movie;

class DataController extends BaseController{



  function __construct(){
    parent::__construct();
  }

  function index(){
    $d_movie  = new MovieDao();
    $d_cinema = new CinemaDAO();
    $this->render('charts',
      array(
        'cinemas' => $d_cinema->getList(),
        'movies'  => $d_movie->getList()
        // TO DO MOVIE LIST ONLY FOR MOVIES WITH SHOWS
      )
    );
  }


}
