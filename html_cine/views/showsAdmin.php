<?php include_once('header.php'); ?>
<!-- uso array de $shows -->



<div class="main-container container-fluid">
    <div class="row">
        <div class="showlist__button--container col-12">
            <button class="btn btn-danger" onclick="updateMovies(this)" type="button" name="button">ACTUALIZAR PELICULAS</button>
        </div>
        <div class="showlist__button--container col-12">
            <a target="_self" href="/admin/funciones/nuevo"><button class="btn btn-info">Agregar Funcion</button></a>
        </div>
    </div>
    <?php foreach ($shows as $show) :
    $movie = $show->getMovie();
    $cinemaRoom = $show->getCinemaRoom();
    $availability = $show->getAvailability();
    ?>

    <div class="row showlist__main--outer-row">
        <div class="showlist__show--container col-sm-12 col-md-6 col-lg-10">
            <div class="row showlist__outer--row">
                <div class="col-sm-12 col-lg-3 show__image--row-container">
                    <div class="ticket__image--container">
                        <img src="<?php  echo(API_IMAGE_HOST . API_IMAGE_SIZE_LARGE .$movie->getImage()); ?>">
                    </div>
                </div>
                <div class="showlist__movie--details col-sm-12 col-lg-7">
                    <div class="row container-fluid showlist__details-inner-row">
                        <div class="col-sm-12 col-lg-6 showlist__name-lang-av--align">
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
                        </div>


                        <div class="col-sm-12 col-lg-6 showlist__date-name-room--align">
                            <div class="row container-fluid dnr--inner__container">
                                <div class="showlist__show--date-time col-12"><p><?php echo($show->getDay()); ?> / <?php echo($show->getTime()); ?></p></div>
                                <div class="showlist__show--cinema col-12"><p><?= $cinemaRoom->getCinema()->getName() . ' | ' . $cinemaRoom->getName(); ?></p></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-2 showlist__movie--actions">
                    <div class="row container-fluid">
                        <div class="col-12">
                            <form method="GET" class="showlist--form" action="/admin/funciones/editar">
                                <input type="number" name="show_id" value="<?php echo($show->getId()); ?>" hidden>
                                <input type="text" name="show_day" value="<?php echo($show->getDay()); ?>" hidden>
                                <input type="text" name="show_time" value="<?php echo($show->getTime()); ?>" hidden>
                                <input type="number" name="movie_id" value="<?php echo($movie->getId()); ?>" hidden>
                                <input type="number" name="cinema_id" value="<?php echo($cinemaRoom->getId()); ?>" hidden>
                                <button id="funcion-update" type="submit" class="btn btn-info">Actualizar</button>
                            </form>
                        </div>

                        <div class="col-12">
                        <form class="show-delete-form showlist--form" method="POST" action="">
                            <input type="text" name="show_id" value="<?php echo($show->getId()); ?>" hidden>
                            <button type="submit" id="funcion-delete" available="<?php echo($availability); ?>" class="funcion-delete btn btn-danger" onclick="return confirm('Estas Seguro?');"><?php if($availability) : echo ("Desactivar"); else : echo("Activar"); endif; ?></button>
                        </div>

                    </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php endforeach; ?>

</div>

<?php include_once('footer.php'); ?>
