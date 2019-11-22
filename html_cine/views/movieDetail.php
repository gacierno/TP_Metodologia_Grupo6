<?php include_once('header.php');

?>

<!-- voy a tener un array de funciones que tienen un objeto movie y un cine y fecha y hora , y la sala -->
<div class="main-container container-fluid">
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
                <div id="cinema-<?php echo $cinema["cinema"]->getId(); ?>" class="dropdown">
                    <span class="selLabel"><p class="showitems__cinema-name--format"><?php echo($cinema["cinema"]->getName()); ?></p></span>
                    <input type="hidden" name="cd-dropdown">
                    <ul class="dropdown-list">
                        <?php foreach($cinema["shows"] as $show) : ?>
                        <li data-value="<?php echo($show->getId()); ?>">
                            <?php $originalDate = $show->getDay();
                            $newDate = str_replace('-','/',date('d-m-Y',strtotime($originalDate)));
                            ?>


                            <div class="showitem__date--container form-group">
                                <div class="showitem__date--inner-container">
                                    <p class="showitem__date--format"><?php echo($newDate); ?> <?php echo($show->getTime()); ?></p><p class="showitem__cinemaroom-name--format"><?php echo($show->getCinemaRoom()->getName()); ?></p>
                                </div>
                                <div class="input-group">
                                    <div class="input-group__form--container">
                                        <div class="input-group-btn">
                                            <button id="down" class="btn btn-default" onclick=" down('0','ticketQuantity-<?php echo($show->getId()); ?>')">-</button>
                                        </div>
                                        <form id="pre-purchase-form" method="POST" action="/funciones/checkout">
                                            <input type="text" hidden style="display:none" name="show_id" value="<?php echo($show->getId()); ?>">
                                            <input type="text" id="ticketQuantity-<?php echo($show->getId()); ?>" name="ticket_quantity" class="form-control ticketQuantity" value="0" />
                                        </form>
                                        <div class="input-group-btn">
                                            <button id="up" class="btn btn-default" onclick="up('<?php echo($show->getCapacityLeft()); ?>','ticketQuantity-<?php echo($show->getId()); ?>')">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a id="pre-purchase-button-<?php echo($show->getId()); ?>" class="pre-button button-disabled showitem__buy--button" href="javascript:void(0)">Comprar</a>
                        </li>


                        
                        <?php endforeach; ?>
                    </ul>
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
