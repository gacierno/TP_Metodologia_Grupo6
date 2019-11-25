<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);


  require_once('config/settings.php');

  date_default_timezone_set(CURRENT_TIMEZONE);
  // SDK de Mercado Pago
  require_once('vendor/autoload.php');
  require_once('lib/autoload.php');
  require_once('config/autoload.php');
  config\Autoload::Start();
  LibAutoload::Start();
  require_once('config/router.php');
  return $router->execute();
?>
