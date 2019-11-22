<?php include_once('header.php'); ?>

<!-- COMENTARIO PARA GASPU : Esta vista va a utilizar un array de 
$purchases del usuario para renderizar los datos y generar el codigo QR con ello -->


<div class="main-container container-fluid purchase__list--container">

<?php if (isset($purchases)) : ?>



<?php foreach ($purchases as $purchase) : ?>

<?php endforeach;  endif;?>


<h1>Mis Tickets</h1>


</div>


<?php include_once('footer.php'); ?>
