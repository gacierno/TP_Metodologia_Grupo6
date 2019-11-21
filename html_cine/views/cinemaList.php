<?php include_once('header.php'); ?>

<div class="main-container container-fluid">
    <div class="row ">
        <div class="cinemalist__button--container col-12">
            <a target="_self" href="/admin/cines/nuevo">Agregar Cine</a>
        </div>
    </div>
    <div class="row cinemalist__row">
<?php foreach($cinemas as $cinema) :
    
$availability = $cinema->getAvailability();
    
?>

        <div id="cinema-<?php echo($cinema->getId()); ?>" class="cinemacard__container col-sm-12 col-md-6 col-lg-4 col-xl-4">
            <div class="cinemacard__inner-container">
                <div class="cinemacard__image">
                    <img src="/public/assets/images/cinema.jpg" alt="cinemacard">
                </div>
                <div class="cinemacard__info">
                    <div class="cinemacard__name"><?php echo($cinema->getName()); ?></div>
                    <?php if($availability) : ?>
                      <span class="badge badge-primary">
                        Activa
                      </span>
                    <?php else: ?>
                      <span class="badge badge-danger">
                        Inactivo
                      </span>
                    <?php endif; ?>
                    <hr>
                    <div class="cinemacard__address"><?php echo($cinema->getAddress()); ?></div>
                </div>
                <?php 
                $idCinema = $cinema->getId();
                $link = ($user->getRole()->getName() === "admin") ? "/admin/cines/editar?id=".$idCinema  : "/peliculas?cine=".$idCinema;
                $image = ($user->getRole()->getName() === "admin") ? "/public/assets/images/edit.svg" : "";
                ?>
                <a href="<?php echo($link); ?>" class="cinemacard__overlay"><img src="<?php echo($image); ?>" alt=""></a>
            </div>
        </div>

<?php endforeach; ?>
    </div>
</div>
<?php include_once('footer.php'); ?>
