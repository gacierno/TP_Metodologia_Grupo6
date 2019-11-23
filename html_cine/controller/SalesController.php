<?php namespace Controller;

use Controller\BaseController as BaseController;

use DAO\ShowDao             	as ShowDao;
use Model\Show                as Show;

use DAO\PurchaseDao           as PurchaseDao;
use Model\Purchase            as Purchase;

use DAO\PaymentDao            as PaymentDao;
use Model\Payment             as Payment;

use DAO\TicketDao             as TicketDao;
use Model\Ticket              as Ticket;

class SalesController extends BaseController{



  function __construct(){
    parent::__construct();
  }


  function createPaymentButton($show,$purchase){
    // Agrega credenciales
    \MercadoPago\SDK::setAccessToken(MP_ACCESS_TOKEN);

    // Crea un objeto de preferencia
    $preference = new \MercadoPago\Preference();
    $quantity = $purchase->getTicketQty();

    // Crea un ítem en la preferencia
    $item = new \MercadoPago\Item();
    $item->title =
      $show->getMovie()->getName() .
      ' - ' . $show->getDay() . ', ' . $show->getTime() . ' ' .
      $show->getCinemaRoom()->getCinema()->getName() . ' ' . $show->getCinemaRoom()->getName();
    $item->quantity = $quantity;
    $item->unit_price = $show->getCinemaRoom()->getTicketValue();
    $preference->items = array($item);
    $preference->save();

    $show_id  = $show->getId();
    return <<<EOD
    <form action="/funciones/checkout/procesar" method="POST">
    <input style="display:none" type="text" name="show_id" value="$show_id">
    <input style="display:none" type="number" name="ticket_quantity" value="$quantity">
      <script
       src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
       data-preference-id="$preference->id">
      </script>
    </form>
EOD;
  }



  function checkout(){
    $d_show       = new ShowDao();
    $show         = $d_show->getById($this->params->show_id);
    $quantity     = $this->params->ticket_quantity;
    $purchase     = $this->createPurchase( $quantity, $show );
    $payment_button = $this->createPaymentButton($show,$purchase);


    $this->render('checkout',
      array(
        'purchase'        => $purchase,
        'show'            => $show,
        'payment_button'  => $payment_button
      )
    );
  }


  function createPurchase($quantity,$show){
    $purchaseDate = new \DateTime();
    $ticketValue  = $show->getCinemaRoom()->getTicketValue();
    $amount       = $ticketValue * $quantity;
    return new Purchase(
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
  }



  function validatePayment($value,$quantity){
    \MercadoPago\SDK::setAccessToken(MP_ACCESS_TOKEN);
    $payment  = \MercadoPago\Payment::find_by_id($this->params->payment_id);
    return $payment->status == "approved" &&
           $payment->transaction_amount == $quantity * $value;
  }



  function procesarPago(){
    $success      = false;
    $d_purchase   = new PurchaseDao();
    $d_show       = new ShowDao();
    $show         = $d_show->getById($this->params->show_id);
    $quantity     = $this->params->ticket_quantity;
    $purchase     = $this->createPurchase( $quantity, $show );

    // ============================================================================
    // =   VALIDATE PAYMENT WITH MERCADO PAGO
    // ============================================================================
    $validPayment = $this->validatePayment($show->getCinemaRoom()->getTicketValue(),$quantity);

    if($validPayment){
      // CREATE PAYMENT
      $payment          = new Payment();
      $created_payment  = $d_payment->add($payment);

      // CREATE TICKETS
      $tickets = array();
      for ($i = 0; $i < $quantity; $i++) {
        $ticket  = new Ticket();
        $created = $d_ticket->add($ticket);
        if($created){
          array_push($tickets,$ticket);
        }
      }

      $purchase->setPayment($payment);
      $purchase->setTickets($tickets);

      try{
        $success = $d_purchase->add($purchase);
      }catch(Exception $ex){
        // NOTHING
      }

    }

    if($success){
      $this->passSuccessMessage = "Compra realizada con exito!";
    }else{
      $this->passErrorMessage = "Hubo un error, el pago no pudo ser procesado correctamente.";
    }

  }


}
