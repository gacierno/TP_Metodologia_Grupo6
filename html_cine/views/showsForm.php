<?php include_once('header.php'); ?>
<!-- NECESITA ARRAY DE $MOVIES / $CINEMAS , SI ES /ACTUALIZAR NECESITO EL OBJETO $SHOW INSTANCIADO -->
<?php if(isset($show)) : $isShowSet = true; $movie = $show->getMovie(); $cinemaRoom = $show->getCinemaRoom(); else : $isShowSet = false; endif; ?>



<div class="main-container container-fluid showlist__main-container">
    <h1><?php if($isShowSet) : echo('Modificación'); else : echo('Creación'); endif; ?> de Función</h1>
    <div class="row cinema__form--container">

        <form id="show-form" class="cinema__form" method="POST" action="<?php if($isShowSet) : echo('/admin/funciones/actualizar'); else : echo('/admin/funciones/nuevo'); endif; ?>">
        <?php if($isShowSet) : ?>
        <label>
            <input id="show-date" type="text"  name="show_id" value="<?php echo($show->getId()); ?>" hidden>
        </label>
        <?php endif; ?>

        <label>
            <?php $today = date('Y-m-d',time()); ?>
            <input class="inputText" type="text" min="<?php echo($today); ?>" name="show_date" value="<?php if($isShowSet) : echo($show->getDay()); endif; ?>" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" onfocus="(this.type = 'date')" onblur="this.type = 'text'">
            <span class="floating-label">Fecha de la funcion</span>
        </label>

        <label>
            <input id="time" class="inputText" type="text" name="show_time" step="10" value="<?php if($isShowSet) : echo($show->getTime()); endif; ?>" required onfocus="(this.type = 'time')" onblur="this.type = 'text'">
            <span class="floating-label">Hora de la funcion</span>
        </label>
        <select name="show_movie" class="form-control form-control-md showlist__movie--select" required>
            <option value="<?php if($isShowSet) : echo($movie->getId()); endif; ?>" selected><?php if($isShowSet) : echo($movie->getName()); else : echo("Seleccione Pelicula"); endif; ?></option>

            <?php
            $selectedMovie = "";
            if(isset($movie)){
                $selectedMovie = $movie->getName();
            }
            foreach ($movies as $mov) :
                if($mov->getName() !== $selectedMovie) :
            ?>
            <option value="<?php echo($mov->getId()); ?>"><?php echo($mov->getName()); ?> / <?php echo($mov->getLanguage()); ?></option>
            <?php
                endif;
            endforeach; ?>
        </select>

        <select name="show_cinemaroom" class="form-control form-control-md showlist__cinema--select" required>
            <option value="<?php if($isShowSet) : echo($cinemaRoom->getId()); endif; ?>" selected><?php if($isShowSet) : echo( $cinemaRoom->getCinema()->getName() . ' - ' . $cinemaRoom->getName()); else : echo("Seleccione sala de cine"); endif; ?></option>

            <?php
            foreach ($cinemaRooms as $cr) :
            ?>
            <option value="<?= $cr->getId(); ?>"><?= $cr->getCinema()->getName() . ' - ' . $cr->getName(); ?></option>
            <?php endforeach; ?>
        </select>
        <div class="showlist__submit-button--container">
            <button type="submit" class="cinemaform__button--primary">Enviar</button>
        </div>

        </form>

    </div>
</div>
<?php include_once('footer.php'); ?>
