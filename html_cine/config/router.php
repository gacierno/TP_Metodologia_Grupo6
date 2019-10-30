<?php
use Router\Router                         as Router;
use Response\ErrorResponse                as ErrorResponse;
use Response\RedirectResponse             as RedirectResponse;
use Controller\AuthenticationController   as AuthenticationController;
use Controller\UserController             as UserController;
use Controller\ShowController             as ShowController;
use Controller\CinemaController           as CinemaController;
use Controller\MovieController            as MovieController;


$router = new Router();


// MIDDLEWARES ======================================================================
$router->use('.*',                           array( new AuthenticationController(),'authenticate' ));


// CINES ============================================================================
$router->get('\/admin\/cines\/nuevo',        array( new CinemaController(),'createForm' ) );
$router->get('\/admin\/cines\/editar',       array( new CinemaController(),'editForm' ) );
$router->get('\/admin\/cines',               array( new CinemaController(),'index' ) );
$router->get('\/cines',                      array( new CinemaController(),'index' ) );

$router->post('\/admin\/cines\/nuevo',       array( new CinemaController(),'create' ) );
$router->post('\/admin\/cines\/eliminar',    array( new CinemaController(),'delete' ) );
$router->post('\/admin\/cines\/actualizar',  array( new CinemaController(),'update' ) );


// SHOWS ============================================================================
$router->get('\/admin\/shows\/nuevo',        array( new ShowController(),'newShow' ) );
$router->get('\/admin\/shows',               array( new ShowController(),'index' ) );

$router->post('\/admin\/shows\/create',      array( new ShowController(),'create' ) );
$router->post('\/admin\/shows\/delete',      array( new ShowController(),'delete' ) );
$router->post('\/admin\/shows\/update',      array( new ShowController(),'update' ) );


// PELICULAS =======================================================================
$router->get('\/pelicula\/detalle',          array( new MovieController(),'detail' ) );
$router->get('\/peliculas',                  array( new MovieController(),'index' ) );


// LOGIN ============================================================================
$router->get('\/login\/create',              array( new AuthenticationController(), 'registerForm' ) );
$router->get('\/login',                      array( new AuthenticationController(), 'loginForm' ) );
$router->get('\/logout',                     array( new AuthenticationController(), 'logout' ) );
$router->post('\/login',                     array( new AuthenticationController(), 'login' ) );


// USER ============================================================================
$router->post('\/user\/create',              array( new UserController(), 'create' ) );


// DEFAULT ==========================================================================
$router->get('\/',                           array( new RedirectResponse("/peliculas"), 'send' ) );
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
