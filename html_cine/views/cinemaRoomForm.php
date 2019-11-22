<!-- COMENTARIO PARA GASPU :
Esta vista cuenta con un objeto $cinemaRoom para renderizar los datos necesarios en el formulario -->


<?php include_once('header.php'); ?>

<?php if(isset($cinemaRoom)) : $iscinemaRoomSet = true; $availability = $cinemaRoom->getAvailability(); else : $iscinemaRoomSet = false; endif; ?>


<?php include_once('partials/customMessage.php'); ?>


<div class="main-container container-fluid cinemaRoomlist__main-container">
    <h1><?php if($iscinemaRoomSet) : echo('Modificación de la'); else : echo('Creación de'); endif; ?> Sala <?php if($iscinemaRoomSet) : echo($cinemaRoom->getName()); endif; ?></h1>
    <?php if($iscinemaRoomSet) : if($availability) : ?>
        <span class="badge badge-primary">
            Activa
        </span>
    <?php else: ?>
    <span class="badge badge-danger">
        Inactivo
    </span>
<?php endif; endif; ?>
    <div class="row cinemaRoom__form--container">

        <form id="cinemaRoom-form" class="cinemaRoom__form" method="POST" action="<?php if($iscinemaRoomSet) : echo('/admin/cines/salas/actualizar'); else : echo('/admin/cines/salas/nuevo'); endif; ?>">

        <input type="hidden" name="cinema_id" value="<?= $cinema->getId(); ?>">
        <?php if($iscinemaRoomSet) : ?>
        <label style="display:none;">
            <input type="text"  name="cinemaRoom_id" value="<?php echo($cinemaRoom->getId()); ?>">
        </label>
        <?php endif; ?>

        <label>
            <input class="inputText" type="text" name="cinemaRoom_name" value="<?php if($iscinemaRoomSet) : echo($cinemaRoom->getName()); endif; ?>" required>
            <span class="floating-label">Nombre de la sala</span>
        </label>
        <label>
            <input class="inputText" type="text" name="cinemaRoom_capacity" value="<?php if($iscinemaRoomSet) : echo($cinemaRoom->getCapacity()); endif; ?>" required>
            <span class="floating-label">Capacidad de la sala</span>
        </label>
        <label>
            <input class="inputText" type="text"  name="cinemaRoom_ticketValue" value="<?php if($iscinemaRoomSet) : echo($cinemaRoom->getTicketValue()); endif; ?>" required>
            <span class="floating-label">Valor del ticket de la sala</span>
        </label>

        <div class="cinemaRoomform__button--container">
            <button type="submit" class="cinemaRoomform__button--primary">Enviar</button>
            <?php if($iscinemaRoomSet) : ?>
            <button id="cinemaRoom-delete" type="submit" <?php if($availability) : echo("available"); else : echo("not-available"); endif; ?> class="cinemaRoomform__button--secondary" onclick="return confirm('Estas Seguro?');"><?php if($availability) : echo("Desactivar"); else : echo("Activar"); endif; ?></button>
            <?php endif; ?>
        </div>

        </form>

    </div>


</div>
<?php include_once('footer.php'); ?>
