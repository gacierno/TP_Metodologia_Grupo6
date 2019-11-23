<!-- COMENTARIO PARA GASPU : Voy a utilizar un objeto purchase
que va a tener los datos necesarios para los datos de la compra y el objeto
$show que tiene los datos a mostrar de la funcion -->

<?php include_once('header.php'); ?>


<div class="main-container container-fluid purchase__list--container">
<?php if(isset($purchase)) : ?>
    <h1>Checkout</h1>

    <div class="purchase__outer--container">
        <div class="purchase__item--container">
            <p class="">Fecha de la funcion</p>
            <span><?php echo($show->getDay()); ?></span>
        </div>



        <div class="purchase__item--container">
            <p class="">Cantidad de Tickets</p>
            <span><?php echo($purchase->getTicketQty()); ?></span>
        </div>

        <div class="purchase__item--container">
            <p class="">Valor del Ticket</p>
            <span><?php echo($show->getCinemaRoom()->getTicketValue()); ?></span>
        </div>

        <div class="purchase__item--container">
            <p class="">Descuento Aplicado</p>
            <span><?php echo($purchase->getDiscount()); ?></span>
        </div>

        <div class="purchase__item--container">
            <p class="">Monto Total</p>
            <span><?php echo($purchase->getAmount()); ?></span>
        </div>

        <?= $payment_button; ?>

    </div>


<? endif; ?>
</div>
<?php include_once('footer.php'); ?>
