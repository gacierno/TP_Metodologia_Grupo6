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
                    <span class="selLabel"><?php echo($cinema["cinema"]->getName()); ?></span>
                    <input type="hidden" name="cd-dropdown">
                    <ul class="dropdown-list">
                        <?php foreach($cinema["shows"] as $show) : ?>
                        <li data-value="<?php echo($show->getId()); ?>">
                            <?php $originalDate = $show->getDay();
                            $newDate = str_replace('-','/',date('d-m-Y',strtotime($originalDate)));
                            ?>
                            <a href="/funciones?id=<?php echo($show->getId()); ?>"><p class="showitem__dat--format"><?php echo($newDate); ?> <?php echo($show->getTime()); ?></p><p class="showitem__cinemaroom-name--format">asdasds</p>
                            <div class="form-group">
                                <label>Quantity: </label>
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button id="down" class="btn btn-default" onclick=" down('0')"><span class="glyphicon glyphicon-minus"></span></button>
                                    </div>
                                    <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                    <div class="input-group-btn">
                                        <button id="up" class="btn btn-default" onclick="up('10')"><span class="glyphicon glyphicon-plus"></span></button>
                                    </div>
                                </div>
                            </div>
                        </a>
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
function up(max) {
    document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) + 1;
    if (document.getElementById("myNumber").value >= parseInt(max)) {
        document.getElementById("myNumber").value = max;
    }
}
function down(min) {
    document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) - 1;
    if (document.getElementById("myNumber").value <= parseInt(min)) {
        document.getElementById("myNumber").value = min;
    }
}
</script>

<?php include_once('footer.php'); ?>
