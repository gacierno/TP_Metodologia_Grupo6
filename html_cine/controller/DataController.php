<?php namespace Controller;

use Controller\BaseController as BaseController;

// use DAO\ShowDao             	as ShowDao;
// use Model\Show                as Show;
//
// use DAO\PurchaseDao           as PurchaseDao;
// use Model\Purchase            as Purchase;
//
// use DAO\PaymentDao            as PaymentDao;
// use Model\Payment             as Payment;
//
// use DAO\TicketDao             as TicketDao;
// use Model\Ticket              as Ticket;

class DataController extends BaseController{



  function __construct(){
    parent::__construct();
  }

  function index(){
    $this->render('charts');
  }


}
