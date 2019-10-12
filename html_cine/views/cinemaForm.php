<?php include_once('header.php'); ?>

<?php if(isset($cinema)) : $isCinemaSet = true; else : $isCinemaSet = false; endif; ?>
<div class="main-container container-fluid">
    <div class="row cinema__form--container">

        <form id="cinema-form" class="cinema__form" method="POST" action="<?php if($isCinemaSet) : echo('/cines/editar'); else : echo('/cines/nuevo'); endif; ?>">
        <?php if($isCinemaSet) : ?>
        <label style="display:none;">
            <input type="text"  name="id" value="<?php echo($cinema->getId()); ?>">
        </label>
        <?php endif; ?>

        <label>
            <input class="inputText" type="text" name="name" value="<?php if($isCinemaSet) : echo($cinema->getName()); endif; ?>" required>
            <span class="floating-label">Nombre del Cine</span>
        </label>
        <label>
            <input class="inputText" type="text"  name="address" value="<?php if($isCinemaSet) : echo($cinema->getAddress()); endif; ?>" required>
            <span class="floating-label">Direccion del Cine</span>
        </label>
        <label>
            <input class="inputText" type="text" name="capacity" value="<?php if($isCinemaSet) : echo($cinema->getCapacity()); endif; ?>" required>
            <span class="floating-label">Capacidad del Cine</span>
        </label>
        <label>
            <input class="inputText" type="text"  name="ticketValue" value="<?php if($isCinemaSet) : echo($cinema->getTicketValue()); endif; ?>" required>
            <span class="floating-label">Valor del ticket del Cine</span>
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