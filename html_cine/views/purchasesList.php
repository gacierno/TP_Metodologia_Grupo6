<?php include_once('header.php'); ?>

<!-- COMENTARIO PARA GASPU : Esta vista va a utilizar un array de 
$purchases del usuario para renderizar los datos y generar el codigo QR con ello -->

<div class="qr-code--container">
    <div class="qr-code__container--overlay"></div>
    <div id="qrcode"><div class="qr-code__close-btn">X</div></div>
</div>


<div class="main-container container-fluid purchase__list--container">

<?php if (isset($purchases)) : ?>
<h1>Mis Tickets</h1>



<?php foreach ($purchases as $purchase) : ?>
    <?php foreach ($purchase->getTickets() as $ticket) : ?>
        <div class="row ticket-row">
            <div class="ticket__image--container col-sm-12 col-md-6 col-lg-3">
                <img src="<?php  echo(API_IMAGE_HOST . API_IMAGE_SIZE_LARGE . $ticket->getShow()->getMovie()->getImage()); ?>">
            </div>
            <div class="purchase__ticket--outer-container col-sm-12 col-md-6 col-lg-9">
            <div class="ticket__info--container">
                <p class="ticket__movie-title"><?php echo($ticket->getShow()->getMovie()->getName()); ?></p>
                <span class="ticket__movie--date-time"><?php echo($ticket->getShow()->getTime()); ?> / <?php echo($ticket->getShow()->getDay()); ?></span>
                <p class="ticket__movie-cinemaroom"><?php echo($ticket->getShow()->getCinemaRoom()->getName()); ?></p>
            </div><div class="ticket__qr-button--container">
                <button type="submit" class="btn btn-info qr-button">Ver QR</button>
            </div>
        </div>
        </div>
        
    <?php endforeach;?>
<?php endforeach;  endif;?>





</div>


<?php include_once('footer.php'); ?>
