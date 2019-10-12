<?php
use Router\Router as Router;
use Response\ErrorResponse as ErrorResponse;
use Controller\CinemaController as CinemaController;

$router = new Router();

$router->get('\/cines', array( new CinemaController(),'index' ) );
$router->post('\/cines/crear', array( new CinemaController(),'create' ) );


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
