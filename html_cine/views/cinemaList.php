<?php include_once('header.php'); ?>

<div class="main-container container-fluid">
    <div class="row cinemalist__row">
<?php foreach($cinemas as $cinema) : ?>

        <div id="cinema-<?php echo($cinema->getId()); ?>" class="cinemacard__container col-sm-12 col-md-6 col-lg-4 col-xl-4">
            <div class="cinemacard__inner-container">
                <div class="cinemacard__image">
                    <img src="/public/assets/images/cinema.jpg" alt="cinemacard">
                </div>
                <div class="cinemacard__info">
                    <div class="cinemacard__name"><?php echo($cinema->getName()); ?></div>
                    <hr>
                    <div class="cinemacard__address"><?php echo($cinema->getAddress()); ?></div>
                    <div class="cinemacard__capacity"><?php echo('Capacidad : '.$cinema->getCapacity() .' personas'); ?></div>
                    <div class="cinemacard__value"><?php echo('Valor de ticket : $'.$cinema->getTicketValue() ); ?></div>
                </div>
                <a href="/cines/editar?id=<?php echo($cinema->getId()); ?>" class="cinemacard__overlay"><img src="/public/assets/images/edit.svg" alt=""></a>
            </div>
        </div>

<?php endforeach; ?>
    </div>
</div>
<?php include_once('footer.php'); ?>
