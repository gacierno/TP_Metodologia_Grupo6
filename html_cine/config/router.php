<?php
use Router\Router                         as Router;
use Response\ErrorResponse                as ErrorResponse;
use Response\RedirectResponse             as RedirectResponse;
use Controller\AuthenticationController   as AuthenticationController;
use Controller\UserController             as UserController;
use Controller\ShowController             as ShowController;
use Controller\CinemaController           as CinemaController;
use Controller\MovieController            as MovieController;

$cinemaController = new CinemaController();
$showController   = new ShowController();
$movieController  = new MovieController();
$authenticationController = new AuthenticationController();
$userController = new UserController();

$router = new Router();


// MIDDLEWARES ======================================================================
$router->use('.*',                                array( $authenticationController,'authenticate' ));


// CINES ============================================================================
$router->get('\/admin\/cines\/nuevo',             array( $cinemaController,'createForm' ) );
$router->get('\/admin\/cines\/editar',            array( $cinemaController,'editForm' ) );
$router->get('\/admin\/cines',                    array( $cinemaController,'index' ) );
$router->get('\/admin',                           array( new RedirectResponse('/admin/cines'), 'send' ));
$router->get('\/cines',                           array( $cinemaController,'index' ) );

$router->post('\/admin\/cines\/nuevo',            array( $cinemaController,'create' ) );
$router->post('\/admin\/cines\/actualizar',       array( $cinemaController,'update' ) );
$router->post('\/admin\/cines\/desactivar',       array( $cinemaController,'disable' ) );
$router->post('\/admin\/cines\/activar',          array( $cinemaController,'enable' ) );


// SHOWS ============================================================================
$router->get('\/admin\/funciones\/nuevo',         array( $showController,'newShow' ) );
$router->get('\/admin\/funciones\/editar',        array( $showController,'editShow' ) );
$router->get('\/admin\/funciones',                array( $showController,'index' ) );

$router->post('\/admin\/funciones\/nuevo',        array( $showController,'create' ) );
$router->post('\/admin\/funciones\/eliminar',     array( $showController,'disable' ) );
$router->post('\/admin\/funciones\/actualizar',   array( $showController,'update' ) );


// PELICULAS =======================================================================
$router->get('\/pelicula\/detalle',               array( $movieController,'detail' ) );
$router->get('\/peliculas',                       array( $movieController,'index' ) );


// LOGIN ============================================================================
$router->get('\/login\/create',                   array( $authenticationController, 'registerForm' ) );
$router->get('\/login',                           array( $authenticationController, 'loginForm' ) );
$router->get('\/logout',                          array( $authenticationController, 'logout' ) );
$router->post('\/login',                          array( $authenticationController, 'login' ) );


// USER ============================================================================
$router->get('\/usuario',                         array( $userController, 'detail' ) );

$router->post('\/usuario\/nuevo',                 array( $userController, 'create' ) );
$router->post('\/usuario\/actualizar',            array( $userController, 'update' ) );
$router->post('\/usuario\/activar',               array( $userController, 'enable' ) );
$router->post('\/usuario\/desactivar',            array( $userController, 'disable' ) );


// DEFAULT ==========================================================================
$router->get('\/',                                array( new RedirectResponse("/peliculas"), 'send' ) );
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
