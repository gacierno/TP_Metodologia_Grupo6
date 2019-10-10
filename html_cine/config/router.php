<?php
use Router\Router as Router;
use Response\ErrorResponse as ErrorResponse;

$router = new Router();
$router->get('\/home',function(){
  echo "Home";
});

$router->get('\/about',function(){
  echo "Abouttt";
});

$router->get('\/api\/movies',function(){
  echo json_encode(array( "movie" => "something" ));
});

$router->all('.*',function(){
  echo new ErrorResponse(
    array(
      'code' => 404,
      'body' => "404 Page not Found!"
    )
  );
});
