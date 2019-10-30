<?php
use Router\Router                         as Router;
use Response\ErrorResponse                as ErrorResponse;
use Response\RedirectResponse             as RedirectResponse;
use Controller\AuthenticationController   as AuthenticationController;
use Controller\UserController             as UserController;
use Controller\CinemaController           as CinemaController;
use Controller\MovieController            as MovieController;


$router = new Router();
// MIDDLEWARES ======================================================================
$router->use('.*',                    array( new AuthenticationController(),'authenticate' ));

// CINES ============================================================================
$router->get('\/cines\/nuevo',        array( new CinemaController(),'createForm' ) );
$router->get('\/cines\/editar',       array( new CinemaController(),'editForm' ) );
$router->get('\/cines',               array( new CinemaController(),'index' ) );

$router->post('\/cines\/nuevo',       array( new CinemaController(),'create' ) );
$router->post('\/cines\/eliminar',    array( new CinemaController(),'delete' ) );
$router->post('\/cines\/actualizar',  array( new CinemaController(),'update' ) );

// PELICULAS =======================================================================
$router->get('\/peliculas\/detalle',   array( new MovieController(),'detail' ) );
$router->get('\/peliculas',           array( new MovieController(),'index' ) );


// LOGIN ============================================================================
$router->get('\/login\/create',       array( new AuthenticationController(), 'registerForm' ) );
$router->get('\/login',               array( new AuthenticationController(), 'loginForm' ) );
$router->get('\/logout',              array( new AuthenticationController(), 'logout' ) );
$router->post('\/login',              array( new AuthenticationController(), 'login' ) );

// USER ============================================================================
$router->post('\/user\/create',        array( new UserController(), 'create' ) );

// DEFAULT ==========================================================================
$router->get('^\/$',                  array( new RedirectResponse("/peliculas"), 'send' ) );
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
