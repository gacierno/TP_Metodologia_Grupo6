<?php namespace Controller;

use Controller\BaseController as BaseController;

class PaymentController extends BaseController{



  function __construct(){
    parent::__construct();
  }


  function test(){


    // Agrega credenciales
    \MercadoPago\SDK::setAccessToken(MP_ACCESS_TOKEN);

    // Crea un objeto de preferencia
    $preference = new \MercadoPago\Preference();

    // Crea un ítem en la preferencia
    $item = new \MercadoPago\Item();
    $item->title = 'Entrada sala';
    $item->quantity = 1;
    $item->unit_price = 100;
    $preference->items = array($item);
    $preference->save();


    echo <<<EOD
    <form action="/procesar-pago" method="POST">
      <script
       src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
       data-preference-id="$preference->id">
      </script>
    </form>
EOD;

  }

}
