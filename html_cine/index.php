<?php

  require_once('lib/autoload.php');
  autoload::Start();

  use Response\ErrorResponse as ErrorResponse;

  require_once('config/router.php');
  $router->find($_SERVER['REQUEST_METHOD'],$_SERVER['REQUEST_URI']);

  echo new ErrorResponse(array(
    'code' => 404,
    'body' => 'PAGE NOT FOUND'
  ));

	// require "Config/Autoload.php";
	// require "Config/Config.php";
	// use Config\Autoload as Autoload;
	// use Config\Router 	as Router;
	// use Config\Request 	as Request;
	// Autoload::start();
	// session_start();
	// require_once(VIEWS_PATH."header.php");
	// Router::Route(new Request());
	// require_once(VIEWS_PATH."footer.php");

?>
