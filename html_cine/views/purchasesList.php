<?php include_once('header.php'); ?>

<!-- COMENTARIO PARA GASPU : Esta vista va a utilizar un array de 
$purchases del usuario para renderizar los datos y generar el codigo QR con ello -->


<div class="main-container container-fluid purchase__list--container">

<?php if (isset($purchases)) : ?>
<h1>Mis Tickets</h1>



<?php foreach ($purchases as $purchase) : ?>
    <?php foreach ($purchase->getTickets() as $ticket) : ?>
    <?php endforeach;?>
<?php endforeach;  endif;?>




<div class="purchase__ticket--outer-container">
    <div class="ticket__info--container">
        <p>asdasadsaadas</p>
    </div><div class="ticket__qr-button--container">
        <button type="submit" class="btn btn-info">Ver QR</button>
    </div>
</div>


<div id="qrcode"></div>

</div>


<?php include_once('footer.php'); ?>
