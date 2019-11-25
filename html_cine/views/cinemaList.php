<?php include_once('header.php'); ?>

<div class="main-container container-fluid">
    <div class="row ">
        <div class="cinemalist__button--container col-12">
            <a target="_self" href="/admin/cines/nuevo"><button class="btn btn-info"> Agregar Cine</button></a>
        </div>
    </div>
    <div class="row cinemalist__row">
<?php foreach($cinemas as $cinema) :
    
$availability = $cinema->getAvailability();
    
?>

        <div id="cinema-<?php echo($cinema->getId()); ?>" class="cinemacard__container col-sm-12 col-md-6 col-lg-4 col-xl-4">
            <div class="cinemacard__inner-container">
                <div class="cinemacard__info">
                    <div class="cinemacard__name"><?php echo($cinema->getName()); ?></div>
                    <?php if($availability) : ?>
                      <span class="badge badge-info">
                        Activo
                      </span>
                    <?php else: ?>
                      <span class="badge badge-danger">
                        Inactivo
                      </span>
                    <?php endif; ?>
                    <hr>
                    <div class="cinemacard__address"><?php echo($cinema->getAddress()); ?></div>
                    <?php 
                      $idCinema = $cinema->getId();
                      $link = ($user->getRole()->getName() === "admin") ? "/admin/cines/editar?id=".$idCinema  : "/peliculas?cine=".$idCinema;
                    ?>
                    <a href="<?php echo($link); ?>"><button class="btn btn-info enter-cinema-btn">Ingresar</button></a>
                </div>
            </div>
        </div>

<?php endforeach; ?>
    </div>
</div>
<?php include_once('footer.php'); ?>
