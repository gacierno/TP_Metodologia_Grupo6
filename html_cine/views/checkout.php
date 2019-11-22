<!-- COMENTARIO PARA GASPU : Voy a utilizar un objeto purchase
que va a tener los datos necesarios para los datos de la compra y el objeto
$show que tiene los datos a mostrar de la funcion -->

<?php include_once('header.php'); ?>

<?php include_once('partials/customMessage.php'); ?>


<div class="main-container container-fluid purchase__list--container">
<?php if(isset($purchase)) : ?>
    <h1>Checkout</h1>

    <div class="purchase__outer--container">
        <div class="purchase__item--container">
            <p class="">Fecha de la funcion</p>
            <span><?php echo($show->getDate()); ?></span>
        </div>

        <div class="purchase__item--container">
            <p class="">Nombre de la funcion</p>
            <span><?php echo($show->getName()); ?></span>
        </div>

        <div class="purchase__item--container">
            <p class="">Cantidad de Tickets</p>
            <span><?php echo($purchase->getTicket_qty()); ?></span>
        </div>

        <div class="purchase__item--container">
            <p class="">Valor del Ticket</p>
            <?php $tickets = $purchase->getTickets();
            if(sizeof($tickets) > 0 ) : ?>
            <span><?php echo( $tickets[0]->getTicketValue() ); ?></span>
            <?php endif; ?>
        </div>

        <div class="purchase__item--container">
            <p class="">Descuento Aplicado</p>
            <span><?php echo($purchase->getDiscount()); ?></span>
        </div>  

        <div class="purchase__item--container">
            <p class="">Monto Total</p>
            <span><?php echo($purchase->getAmount()); ?></span>
        </div>  

        <form method="POST" action="/test-payment">
        <input style="display:none" type="text" name="show_id" value="<?php echo($show->getId()); ?>">
        <input style="display:none" type="number" name="ticket_qty" value="<?php echo($purchase->getTicket_qty()); ?>">
        <button type="submit" class="btn btn-info">Comprar</button>
        </form>

    </div>


<? endif; ?>
</div>
<?php include_once('footer.php'); ?>
