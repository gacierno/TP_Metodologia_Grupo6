<?php
require_once('lib/Router/Router.php');

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
