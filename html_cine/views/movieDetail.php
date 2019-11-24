<?php include_once('header.php');

?>

<!-- voy a tener un array de funciones que tienen un objeto movie y un cine y fecha y hora , y la sala -->
<div class="main-container-no-padding container-fluid">
<div class="row movie-detail__container">
        <div class="col-sm-12 col-md-4 movie-detail__banner--container">
            <img src="<?php  echo(API_IMAGE_HOST . API_IMAGE_SIZE_LARGE . $movie->getImage()); ?>">
        </div>
        <div class="col-sm-12 col-md-8 movie-detail__desc--container">
            <h1><?php echo($movie->getName()); ?></h1>
            <small><?php echo($movie->getLanguage()); ?> / <?php echo($movie->getDuration()." minutos"); ?></small>
            <div class="movie-detail__categories--container">
                <?php $genres = $movie->getGenres();
                foreach($genres as $genre) : ?>

                <div class="badge badge-secondary"><?php echo($genre->getName()); ?></div>

                <?php endforeach; ?>
            </div>
            <p><?php echo($movie->getDescription()); ?></p>
            <div class="movie-detail__shows--container">
                <?php foreach($showsByCinema as $cinema) : ?>
                <div class="movie-detail__shows--container">
                    <div class="show-title__container">
                        <p><?php echo($cinema["cinema"]->getName()); ?></p>
                    </div>
                    <?php foreach($cinema["shows"] as $show) : ?>

                    <div class="row show-tickets--container">
                        <div class="col-sm-12 col-md-8 show-ticket__name">
                        <?php $originalDate = $show->getDay();
                        $newDate = str_replace('-','/',date('d-m-Y',strtotime($originalDate))); ?>
                            <p><?php echo($newDate); ?> <?php echo($show->getTime()); ?></p>

                            <form id="pre-purchase-form" method="POST" action="/funciones/checkout">
                                <input type="text" hidden style="display:none" name="show_id" value="<?php echo($show->getId()); ?>">
                                <input type="number" min="0" max="<?php echo($show->getCapacityLeft()); ?>" step="1" value="0" class="ticket_qty">
                            </form>
                        </div>
                        <div class="col-sm-12 col-md-4 show-ticket__button">
                            <a class="pre-button" href="javascript:void(0)"><button class="btn btn-danger">Comprar</button></a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>


<script>
function up(max,id) {
    document.getElementById(id).value = parseInt(document.getElementById(id).value) + 1;

    if (document.getElementById(id).value >= parseInt(max)) {
        document.getElementById(id).value = max;
    }
    var evt = document.createEvent("HTMLEvents");
    evt.initEvent("change", false, true);
    document.getElementById(id).dispatchEvent(evt);
}
function down(min,id) {
    document.getElementById(id).value = parseInt(document.getElementById(id).value) - 1;
    if (document.getElementById(id).value <= parseInt(min)) {
        document.getElementById(id).value = min;
    }
    var evt = document.createEvent("HTMLEvents");
    evt.initEvent("change", false, true);
    document.getElementById(id).dispatchEvent(evt);
}
</script>

<?php include_once('footer.php'); ?>
