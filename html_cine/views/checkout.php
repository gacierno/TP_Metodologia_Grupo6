<!-- COMENTARIO PARA GASPU : Voy a utilizar un objeto purchase
que va a tener los datos necesarios para los datos de la compra y el objeto
$show que tiene los datos a mostrar de la funcion -->

<?php include_once('header.php'); ?>


<div class="main-container-no-padding container-fluid purchase__list--container">
<?php if(isset($purchase)) : ?>
<?php $movie = $show->getMovie(); ?>
    <div class="row checkout__main-row">
        <div class="col-sm-12 col-md-4 movie-detail__banner--container">
            <img src="<?php  echo(API_IMAGE_HOST . API_IMAGE_SIZE_XLARGE . $movie->getImage()); ?>">
        </div>
        <div class="col-sm-12 col-md-8 movie-detail__desc--container">
            <h1 style="text-align:left"><?php echo($movie->getName()); ?></h1>
            <small><?php echo($movie->getLanguage()); ?> / <?php echo($movie->getDuration()." minutos"); ?></small>
            <div class="movie-detail__categories--container">
                <?php $genres = $movie->getGenres();
                foreach($genres as $genre) : ?>

                <div class="badge badge-secondary"><?php echo($genre->getName()); ?></div>

                <?php endforeach; ?>
            </div>
            <p><?= $movie->getDescription(); ?></p>
            <div class="movie-detail__shows--container">
                <div class="movie-detail__shows--container">
                    <div class="show-title__container">
                        <p>Checkout</p>
                    </div>

                    <div class="checkout-form">
                      <ul class="checkout-list">

                        <li>
                          <label for="">
                            Fecha de la funcion:
                          </label>
                          <span>
                            <?= $show->getDay(); ?>
                          </span>
                        </li>

                        <li>
                          <label for="">
                            Cantidad de Tickets:
                          </label>
                          <span>
                            <?= $purchase->getTicketQty(); ?>
                          </span>
                        </li>

                        <li>
                          <label for="">
                            Valor del Ticket:
                          </label>
                          <span>
                            <?= "$".$show->getCinemaRoom()->getTicketValue()." ARS"; ?>
                          </span>
                        </li>

                        <li>
                          <label for="">
                            Descuento Aplicado:
                          </label>
                          <span>
                            <?= "$".$purchase->getDiscount()." ARS"; ?>
                          </span>
                        </li>


                      </ul>

                      <h1 style="text-align:left">TOTAL: <?= "$".$purchase->getAmount()." ARS"; ?></h1>

                      <?= $payment_button; ?>
                    </div>

            </div>
        </div>
    </div>




<? endif; ?>
</div>
<?php include_once('footer.php'); ?>
