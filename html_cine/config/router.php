<?php
use Router\Router                         as Router;
use Response\ErrorResponse                as ErrorResponse;
use Response\RedirectResponse             as RedirectResponse;
use Controller\AuthenticationController   as AuthenticationController;
use Controller\UserController             as UserController;
use Controller\ShowController             as ShowController;
use Controller\CinemaController           as CinemaController;
use Controller\CinemaRoomsController      as CinemaRoomsController;
use Controller\MovieController            as MovieController;

$cinemaController           = new CinemaController();
$cinemaRoomController       = new CinemaRoomController();
$showController             = new ShowController();
$movieController            = new MovieController();
$authenticationController   = new AuthenticationController();
$userController             = new UserController();

$router                     = new Router();

// MIDDLEWARES ======================================================================
// -- IF USER IN SESSION AUTHENTICATE
$router->use('/.*/',                              array( $authenticationController, 'authenticate' ));
// -- CHECK IF USER IN SESSION IS ACTIVE
$router->use('/.*/',                              array( $authenticationController, 'userInactive' ));
// -- IF USER IS NOT LOGGED IN, REJECT UNLESS IT IS TRYING TO LOGIN OR REGISTER
$router->use('/^(?!\/login).*$/',                 array( $authenticationController, 'notLoggedIn' ));
// -- VERIFY IF USER IS ADMIN
$router->use('/^\/admin/',                        array( $authenticationController, 'notAdmin' ));
// -- USER IS LOGGED IN AND TRYING TO ACCESS LOGIN PAGE
$router->use('/^\/login/',                        array( $authenticationController, 'preventDoubleLogin' ));


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


// CINEMA ROOMS ============================================================================
$router->get('\/admin\/cines\/salas\/nuevo',      array( $cinemaRoomController,'createForm' ) );
$router->get('\/admin\/cines\/salas\/editar',     array( $cinemaRoomController,'editForm' ) );
$router->get('\/admin\/cines\/salas',             array( $cinemaRoomController,'index' ) );

$router->post('\/admin\/cines\/salas\/nuevo',     array( $cinemaRoomController,'create' ) );
$router->post('\/admin\/cines\/salas\/actualizar',array( $cinemaRoomController,'update' ) );
$router->post('\/admin\/cines\/salas\/desactivar',array( $cinemaRoomController,'disable' ) );
$router->post('\/admin\/cines\/salas\/activar',   array( $cinemaRoomController,'enable' ) );


// SHOWS ============================================================================
$router->get('\/admin\/funciones\/nuevo',         array( $showController,'newShow' ) );
$router->get('\/admin\/funciones\/editar',        array( $showController,'editShow' ) );
$router->get('\/admin\/funciones',                array( $showController,'index' ) );

$router->post('\/admin\/funciones\/nuevo',        array( $showController,'create' ) );
$router->post('\/admin\/funciones\/actualizar',   array( $showController,'update' ) );
$router->post('\/admin\/funciones\/desactivar',   array( $showController,'disable' ) );
$router->post('\/admin\/funciones\/activar',      array( $showController,'enable' ) );


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
