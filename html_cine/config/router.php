<?php
use Router\Router as Router;
use Response\ErrorResponse as ErrorResponse;
use Controller\CinemaController as CinemaController;
use Controller\MovieController as MovieController;

$router = new Router();

// GET
$router->get('\/movies', array( new MovieController(),'index' ) );

$router->get('\/cines', array( new CinemaController(),'index' ) );
$router->get('\/cines\/nuevo', array( new CinemaController(),'createForm' ) );
$router->get('\/cines\/editar', array( new CinemaController(),'editForm' ) );
$router->get('\/cines\/eliminar', array( new CinemaController(),'deleteForm' ) );

// POST
$router->post('\/cines\/nuevo', array( new CinemaController(),'create' ) );

// DELETE
$router->post('\/cines\/eliminar', array( new CinemaController(),'delete' ) );

// PUT
$router->post('\/cines\/actualizar', array( new CinemaController(),'update' ) );


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
