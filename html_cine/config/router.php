<?php
use Router\Router as Router;
use Response\ErrorResponse as ErrorResponse;
use Controller\CineController as CineController;

$router = new Router();

$router->get('\/cines', array( new CineController(),'index' , array( "Mensaje!" ) ) );


$router->all('.*',array(
    new ErrorResponse(
      array(
        'code' => 404,
        'body' => "404 Page not Found!"
      )
    ),
    'send'
  )
);
