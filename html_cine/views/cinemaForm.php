<?php include_once('header.php'); ?>

<?php if(isset($cinema)) : $isCinemaSet = true; $availability = $cinema->getAvailability(); else : $isCinemaSet = false; endif; ?>


<?php include_once('partials/customMessage.php'); ?>


<div class="main-container container-fluid cinemalist__main-container">
    <h1><?php if($isCinemaSet) : echo('Modificación del'); else : echo('Creación de'); endif; ?> Cine <?php if($isCinemaSet) : echo($cinema->getName()); endif; ?></h1>
    <?php if($isCinemaSet) : if($availability) : ?>
        <span class="badge badge-primary">
            Activa
        </span>
    <?php else: ?>
    <span class="badge badge-danger">
        Inactivo
    </span>
<?php endif; endif; ?>
    <div class="row cinema__form--container">

        <form id="cinema-form" class="cinema__form" method="POST" action="<?php if($isCinemaSet) : echo('/admin/cines/actualizar'); else : echo('/admin/cines/nuevo'); endif; ?>">
        
        <?php if($isCinemaSet) : ?>
        <label style="display:none;">
            <input type="text"  name="cinema_id" value="<?php echo($cinema->getId()); ?>">
        </label>
        <?php endif; ?>

        <label>
            <input class="inputText" type="text" name="cinema_name" value="<?php if($isCinemaSet) : echo($cinema->getName()); endif; ?>" required>
            <span class="floating-label">Nombre del Cine</span>
        </label>
        <label>
            <input class="inputText" type="text"  name="cinema_address" value="<?php if($isCinemaSet) : echo($cinema->getAddress()); endif; ?>" required>
            <span class="floating-label">Direccion del Cine</span>
        </label>
        <label>
            <input class="inputText" type="text" name="cinema_capacity" value="<?php if($isCinemaSet) : echo($cinema->getCapacity()); endif; ?>" required>
            <span class="floating-label">Capacidad del Cine</span>
        </label>
        <label>
            <input class="inputText" type="text"  name="cinema_ticketValue" value="<?php if($isCinemaSet) : echo($cinema->getTicketValue()); endif; ?>" required>
            <span class="floating-label">Valor del ticket del Cine</span>
        </label>

        <div class="cinemaform__button--container">
            <button type="submit" class="cinemaform__button--primary">Enviar</button>
            <?php if($isCinemaSet) : ?>
            <button id="cinema-delete" type="submit" <?php if($availability) : echo("available"); else : echo("not-available"); endif; ?> class="cinemaform__button--secondary" onclick="return confirm('Estas Seguro?');"><?php if($availability) : echo("Desactivar"); else : echo("Activar"); endif; ?></button>
            <?php endif; ?>
        </div>

        </form>

    </div>
</div>
<?php include_once('footer.php'); ?>
