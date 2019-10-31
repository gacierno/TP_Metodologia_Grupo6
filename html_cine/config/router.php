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
$router->get('\/admin',                      array( new RedirectResponse('/admin/cines'), 'send' ));
$router->get('\/cines',                      array( new CinemaController(),'index' ) );

$router->post('\/admin\/cines\/nuevo',       array( new CinemaController(),'create' ) );
$router->post('\/admin\/cines\/eliminar',    array( new CinemaController(),'disable' ) );
$router->post('\/admin\/cines\/actualizar',  array( new CinemaController(),'update' ) );


// SHOWS ============================================================================
$router->get('\/admin\/funciones\/nuevo',         array( new ShowController(),'newShow' ) );
$router->get('\/admin\/funciones\/editar',        array( new ShowController(),'editShow' ) );
$router->get('\/admin\/funciones',                array( new ShowController(),'index' ) );

$router->post('\/admin\/funciones\/nuevo',        array( new ShowController(),'create' ) );
$router->post('\/admin\/funciones\/eliminar',     array( new ShowController(),'disable' ) );
$router->post('\/admin\/funciones\/actualizar',   array( new ShowController(),'update' ) );


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
