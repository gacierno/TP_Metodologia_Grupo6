<!-- COMENTARIO PARA GASPU : Voy a utilizar un objeto purchase
que va a tener los datos necesarios para los datos de la compra y el objeto
$show que tiene los datos a mostrar de la funcion -->

<?php include_once('header.php'); ?>

<?php if(isset($purchase)) : $isPurchaseSet = true;  else : $isPurchaseSet = false; endif; ?>


<?php include_once('partials/customMessage.php'); ?>


<div class="main-container container-fluid cinemaRoomlist__main-container">
    <h1>Checkout</h1>
    <div class="row cinemaRoom__form--container">

        <form id="cinemaRoom-form" class="cinemaRoom__form" method="POST" action="<?php if($isPurchaseSet) : echo('/admin/cines/salas/actualizar'); else : echo('/admin/cines/salas/nuevo'); endif; ?>">

        <?php if($isPurchaseSet) : ?>
        <label style="display:none;">
            <input type="text"  name="purchase_id" value="<?php echo($purchase->getId()); ?>">
        </label>
        <?php endif; ?>

        <label>
            <input style="display:none"  class="inputText" type="text" name="movie_date" value="<?php if($isPurchaseSet) : echo($purchase->getDate()); endif; ?>" required>
            <span class="floating-label red-label">Fecha de la Funcion</span>
        </label>
        <p class="purchase__fixed--data">PEPE</p>
        <label>
            <input style="display:none" class="inputText" type="text" name="movie_name" value="<?php if($isPurchaseSet) : echo($show->getMovie()->getName()); endif; ?>" required>
            <span class="floating-label red-label">Nombre de la Pelicula</span>
        </label>
        <p class="purchase__fixed--data">PEPE</p>
        <label>
            <input style="display:none" class="inputText" type="number" name="ticket_quantity" value="<?php if($isPurchaseSet) : echo($purchase->getTicket_qty()); endif; ?>" required>
            <span class="floating-label red-label">Cantidad De Tickets</span>
        </label>
        <p class="purchase__fixed--data">PEPE</p>
        <label>
            <input style="display:none" class="inputText" type="number"  name="cinemaRoom_ticketValue" value="<?php if($isPurchaseSet) : echo($show->getCinemaRoom()->getTicketValue()); endif; ?>" required>
            <span class="floating-label red-label">Valor del ticket de la sala</span>
        </label>
        <p class="purchase__fixed--data">PEPE</p>
        <label>
            <input style="display:none" class="inputText" type="number"  name="purchase_discount" value="<?php if($isPurchaseSet) : echo($purchase->getDiscount()); endif; ?>" required>
            <span class="floating-label red-label">Descuento Aplicado</span>
        </label>
        <p class="purchase__fixed--data">PEPE</p>
        <label>
            <input style="display:none" class="inputText" type="number"  name="purchase_amount" value="<?php if($isPurchaseSet) : echo($purchase->getAmount()); endif; ?>" required>
            <span class="floating-label red-label">Monto Total</span>
        </label>
        <p class="purchase__fixed--data">PEPE</p>

        <label class="cc__select--label">
            <span class="red-label">Elige tu Tarjeta de Credito</span>
            <select class="form-control select__cc--type" name="cc_type" required>
                <option value="visa" selected>Visa</option>
                <option value="master">Master</option>
            </select>
        </label>

        <div class="cinemaRoomform__button--container">
            <button type="submit" class="cinemaRoomform__button--primary">Enviar</button>
            <?php if($isPurchaseSet) : ?>
            <button id="cinemaRoom-delete" type="submit" <?php if($availability) : echo("available"); else : echo("not-available"); endif; ?> class="cinemaRoomform__button--secondary" onclick="return confirm('Estas Seguro?');"><?php if($availability) : echo("Desactivar"); else : echo("Activar"); endif; ?></button>
            <?php endif; ?>
        </div>

        </form>

    </div>


</div>
<?php include_once('footer.php'); ?>
