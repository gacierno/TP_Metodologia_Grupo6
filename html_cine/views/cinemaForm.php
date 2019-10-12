<?php include_once('header.php'); ?>

<?php if(isset($cinema)) : $isCinemaSet = true; else : $isCinemaSet = false; endif; ?>
<div class="main-container container-fluid">
    <div class="row cinema__form--container">

        <form id="cinema-form" class="form-group cinema__form" method="POST" action="<?php if($isCinemaSet) : echo('/cines/editar'); else : echo('/cines/nuevo'); endif; ?>">
        <?php if($isCinemaSet) : ?>
        <label style="display:none;">
            <input type="text" class="form-control" name="id" value="<?php echo($cinema->getId()); ?>">
        </label>
        <?php endif; ?>

        <label>
            <input placeholder="Nombre del Cine" type="text" class="form-control" name="name" value="<?php if($isCinemaSet) : echo($cinema->getName()); endif; ?>" required>
        </label>
        <label>
            <input placeholder="Direccion del Cine" type="text" class="form-control" name="address" value="<?php if($isCinemaSet) : echo($cinema->getAddress()); endif; ?>" required>
        </label>
        <label>
            <input placeholder="Capacidad del Cine" type="text" class="form-control" name="capacity" value="<?php if($isCinemaSet) : echo($cinema->getCapacity()); endif; ?>" required>
        </label>
        <label>
            <input placeholder="Valor del ticket del Cine" type="text" class="form-control" name="ticketValue" value="<?php if($isCinemaSet) : echo($cinema->getTicketValue()); endif; ?>" required>
        </label>

        <div class="cinemaform__button--container">
            <button type="submit" class="cinemaform__button--primary">Submit</button>
            <?php if($isCinemaSet) : ?>
            <button id="cinema-delete" type="submit" class="cinemaform__button--secondary">Delete</button>
            <?php endif; ?>
        </div>

        </form>

    </div>
</div>
<?php include_once('footer.php'); ?>
