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

  function fetch(){
    extract($this->params->map());

    $tickets_sold = $tickets_sold == "true";
    $amount = $amount == "true";
    $tickets_not_sold = $tickets_not_sold == "true";

    $d_purchase  = new PurchaseDao();
    $purchases   = $d_purchase->getList();

    // GROUP PURCHASES BY SHOW
    $purchaseByShow = array();
    foreach($purchases as $purchase){
      $tickets  = $purchase->getTickets();
      $showID   = $tickets[0]->getShow()->getId();
      if(
        ((!isset($movie) || empty($movie)) || $movie == $tickets[0]->getShow()->getMovie()->getId()) &&
        ((!isset($cinema) || empty($cinema)) || $cinema == $tickets[0]->getShow()->getCinemaRoom()->getCinema()->getId())
      ){
        if(!isset($purchaseByShow[$showID])) $purchaseByShow[$showID] = array();
        array_push($purchaseByShow[$showID],$purchase);
      }
    }

    $values = array();
    foreach( $purchaseByShow as $showPurchases ){
      $tickets  = $showPurchases[0]->getTickets();
      $show     = $tickets[0]->getShow();
      $name     = $show->getMovie()->getName();
      $name     .= ' - ' . $show->getCinemaRoom()->getCinema()->getName();
      $name     .= ', ' . $show->getCinemaRoom()->getName();
      $name     .= ' | ' . $show->getDay() . ' ' . $show->getTime();

      $total    = 0;

      if($amount){
        //CALCULATE AMOUNT
        foreach($showPurchases as $purchase){
          $total += $purchase->getAmount();
        }
      }else{
        //CALCULATE QUANTITY SOLD
        foreach($showPurchases as $purchase){
          $tickets = $purchase->getTickets();
          $total += count($tickets);
        }
      }

      if($tickets_not_sold){
        $total = $show->getCinemaRoom()->getCapacity() - $total;
      }

      array_push($values,
        array(
          'name'  => $name,
          'value' => $total
        )
      );
    }

    $output_name = "monto";
    if($tickets_sold)     $output_name = "tickets";
    if($tickets_not_sold) $output_name = "tickets no vendidos";

    $output     = array(
      'output' => $output_name,
      'shows'  => $values
    );
    echo json_encode($output);
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
