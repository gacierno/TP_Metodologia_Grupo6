<?php include_once('header.php'); ?>
<!-- uso array de $shows -->

<?php include_once('partials/customMessage.php'); ?>

<div class="main-container container-fluid">
    <div class="row">
        <div class="showlist__button--container col-12">
            <a target="_self" href="/admin/funciones/nuevo">Agregar Funcion</a>
        </div>
    </div>
    <?php foreach ($shows as $show) :
    $movie = $show->getMovie();
    $cinemaRoom = $show->getCinemaRoom();
    $availability = $show->getAvailability();
    ?>

    <div class="row">
        <div class="showlist__show--container col-12">
            <div class="row">
                <div class="showlist__item--separator d-none d-lg-block col-lg-3">
                    <div class="showlist__show--date-time"><p><?php echo($show->getDay()); ?> / <?php echo($show->getTime()); ?></p></div>
                    <div class="showlist__show--cinema"><p><?php echo($cinemaRoom->getName()); ?></p></div>
                </div>
                <div class="showlist__item--separator showlist__movie--details col-sm-12 col-lg-7">
                    <h2><?php echo($movie->getName()); ?></h2>
                    <small><?php echo($movie->getLanguage()); ?> </small>
                    <?php if($availability) : ?>
                      <span class="badge badge-primary">
                        Activa
                      </span>
                    <?php else: ?>
                      <span class="badge badge-danger">
                        Inactivo
                      </span>
                    <?php endif; ?>
                    <div class="d-lg-none">
                        <div class="showlist__show--date-time"><p><?php echo($show->getDay()); ?> / <?php echo($show->getTime()); ?></p></div>
                        <div class="showlist__show--cinema"><p><?php echo($cinemaRoom->getName()); ?></p></div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-2">
                    <form method="GET" action="/admin/funciones/editar">
                        <input type="number" name="show_id" value="<?php echo($show->getId()); ?>" hidden>
                        <input type="text" name="show_day" value="<?php echo($show->getDay()); ?>" hidden>
                        <input type="text" name="show_time" value="<?php echo($show->getTime()); ?>" hidden>
                        <input type="number" name="movie_id" value="<?php echo($movie->getId()); ?>" hidden>
                        <input type="number" name="cinema_id" value="<?php echo($cinemaRoom->getId()); ?>" hidden>
                        <button id="funcion-update" type="submit" class="showlist__button--primary">Actualizar</button>
                    </form>

                    <form class="show-delete-form" method="POST" action="">
                        <input type="text" name="show_id" value="<?php echo($show->getId()); ?>" hidden>
                        <button type="submit" available="<?php echo($availability); ?>" class="funcion-delete showlist__button--secondary" onclick="return confirm('Estas Seguro?');"><?php if($availability) : echo ("Desactivar"); else : echo("Activar"); endif; ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php endforeach; ?>

</div>

<?php include_once('footer.php'); ?>
