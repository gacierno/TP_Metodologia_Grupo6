<?php include_once('header.php'); ?>
<!-- NECESITA ARRAY DE $MOVIES / $CINEMAS , SI ES /ACTUALIZAR NECESITO EL OBJETO $SHOW INSTANCIADO -->
<?php if(isset($show)) : $isShowSet = true; else : $isShowSet = false; endif; ?>


<?php include_once('partials/customMessage.php'); ?>


<div class="main-container container-fluid">
    <div class="row cinema__form--container">

        <form id="show-form" class="cinema__form" method="POST" action="<?php if($isShowSet) : echo('/funciones/actualizar'); else : echo('/cines/nuevo'); endif; ?>">
        <?php if($isShowSet) : ?>
        <label>
            <input id="show-date" type="text"  name="show_id" value="<?php echo($show->getId()); ?>" hidden>
        </label>
        <?php endif; ?>

        <label>
            <input class="inputText" type="text" name="show_date" value="<?php if($isShowSet) : echo($show->getDate()); endif; ?>" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" onfocus="(this.type = 'date')" onblur="this.type = 'text'">
            <span class="floating-label">Fecha de la funcion</span>
        </label>

        <label>
            <input class="inputText" type="text" name="show_time" value="<?php if($isShowSet) : echo($show->getTime()); endif; ?>" required onfocus="(this.type = 'time')" onblur="this.type = 'text'">
            <span class="floating-label">Hora de la funcion</span>
        </label>

        <label>
            <input class="inputText" type="text" name="show_date" value="" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" onfocus="(this.type = 'date')" onblur="this.type = 'text'">
            <span class="floating-label">Fecha de la funcion</span>
        </label>


        </form>

    </div>
</div>
<?php include_once('footer.php'); ?>
