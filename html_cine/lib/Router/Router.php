<?php namespace Router;

use Request\Request as Request;

class Router {


  private $map = array();


  function __construct(){

  }


  function add($methodName,$regexp,$callback){
    if(!isset($this->map[$methodName])){
      $this->map[$methodName] = array();
    }
    if(!isset($callback[1])) $callback[1] = false;
    if(!isset($callback[2])) $callback[2] = array();
    array_push(
      $this->map[$methodName], array(
        'regexp'   => $regexp,
        'callback' => $callback
      )
    );
  }


  function use($regexp, $callback){
    $this->add('use',$regexp,$callback);
  }


  function get($regexp, $callback){
    $this->add('get',$regexp,$callback);
  }


  function post($regexp, $callback){
    $this->add('post',$regexp,$callback);
  }


  function delete($regexp, $callback){
    $this->add('delete',$regexp,$callback);
  }


  function put($regexp, $callback){
    $this->add('put',$regexp,$callback);
  }


  function all($regexp, $callback){
    $this->add('all',$regexp,$callback);
  }

  private function evaluateRoute(Request $req,$route){
    $pattern = '/^' . $route['regexp'] . '$/';
    if(preg_match($pattern,$req->path())){
      $object = $route['callback'][0];
      $method = $route['callback'][1];
      $params = $route['callback'][2];
      return call_user_func_array(array($object,$method), $params);
    }
    return "NotMatchFound";
  }


  function findRoute(Request $req){
    $httpMethod      = strtolower($req->httpMethod());
    $httpMethodArray = isset($this->map[$httpMethod]) ? $this->map[$httpMethod] : array();
    $allMethodArray  = isset($this->map['all']) ? $this->map['all'] : array();
    $method = array_merge( $httpMethodArray, $allMethodArray );
    foreach( $method as $route ){
      $output = $this->evaluateRoute($req,$route);
      if($output != "NotMatchFound") return $output;
    }
  }


  function runMiddlewares(Request $req){
    $httpMethodArray = isset($this->map['use']) ? $this->map['use'] : array();
    foreach( $httpMethodArray as $route ){
      $output = $this->evaluateRoute($req,$route);
      if(isset($output)) return $output;
    }
  }


  function execute(){
    $req = Request::getInstance();
    $output = $this->runMiddlewares($req);
    if(isset($output)) return $output;
    return $this->findRoute($req);
  }


}

?>
