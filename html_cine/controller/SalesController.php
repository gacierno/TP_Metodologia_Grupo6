<?php namespace Controller;

use Controller\BaseController as BaseController;

use DAO\ShowDao             	as ShowDao;
use Model\Show                as Show;

// use DAO\PurchaseDao        as PurchaseDao;
use Model\Purchase            as Purchase;

class SalesController extends BaseController{



  function __construct(){
    parent::__construct();
  }

  function checkout(){
    $d_show       = new ShowDao();
    $show         = $d_show->getById($this->params->show_id);
    $purchaseDate = new \DateTime();
    $quantity     = $this->params->ticket_quantity;
    $ticketValue  = $show->getCinemaRoom()->getTicketValue();
    $amount       = $ticketValue * $quantity;
    $purchase = new Purchase(
      array(
        'purchase_ticket_qty' => $quantity,
        'purchase_discount' => 0,
        'purchase_date' => $purchaseDate->format('Y-m-d'),
        'purchase_amount' => $amount,
        'purchase_tickets' => null,
        'purchase_user' => $this->session->user,
        'purchase_payment' => null
      )
    );


    // Agrega credenciales
    \MercadoPago\SDK::setAccessToken(MP_ACCESS_TOKEN);

    // Crea un objeto de preferencia
    $preference = new \MercadoPago\Preference();

    // Crea un ítem en la preferencia
    $item = new \MercadoPago\Item();
    $item->title =
      $show->getMovie()->getName() .
      ' - ' . $show->getDay() . ', ' . $show->getTime() . ' ' .
      $show->getCinemaRoom()->getCinema()->getName() . ' ' . $show->getCinemaRoom()->getName();
    $item->quantity = $purchase->getTicketQty();
    $item->unit_price = $ticketValue;
    $preference->items = array($item);
    $preference->save();

    $show_id  = $show->getId();
    $quantity = $purchase->getTicketQty();
    $payment_button = <<<EOD
    <form action="/funciones/checkout/procesar" method="POST">
    <input style="display:none" type="text" name="show_id" value="$show_id">
    <input style="display:none" type="number" name="ticket_qty" value="$quantity">
      <script
       src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
       data-preference-id="$preference->id">
      </script>
    </form>
EOD;


    $this->render('checkout',
      array(
        'purchase'        => $purchase,
        'show'            => $show,
        'payment_button'  => $payment_button
      )
    );
  }

  function procesarPago(){
    print_r($this->params->map());
  }

}
