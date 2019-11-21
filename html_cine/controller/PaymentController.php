<?php namespace Controller;

use Controller\BaseController as BaseController;

class PaymentController extends BaseController{



  function __construct(){
    parent::__construct();
  }


  function test(){


    // Agrega credenciales
    \MercadoPago\SDK::setAccessToken('TEST-4060766969160602-062319-71b3345049fc8d45b3963b64fbbd47a9-50813606');

    // Crea un objeto de preferencia
    $preference = new \MercadoPago\Preference();

    // Crea un ítem en la preferencia
    $item = new \MercadoPago\Item();
    $item->title = 'Mi producto';
    $item->quantity = 1;
    $item->unit_price = 75.56;
    $preference->items = array($item);
    $preference->save();


    echo <<<EOD
    <form action="/procesar-pago" method="POST">
      <script
       src="http://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
       data-preference-id="<?php echo $preference->id; ?>">
      </script>
    </form>
EOD;

  }

}
