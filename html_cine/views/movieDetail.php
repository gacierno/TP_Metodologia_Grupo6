<?php include_once('header.php');

?>

<!-- voiy a tener un array de funciones que tienen un objeto movie y un cine y fecha y hora -->
<div class="main-container container-fluid">
<div class="row movie-detail__container">
        <div class="col-sm-12 col-md-4 movie-detail__banner--container">
            <img src="<?php  echo(API_IMAGE_HOST . API_IMAGE_SIZE_LARGE . $movie->getImage()); ?>">
        </div>
        <div class="col-sm-12 col-md-8 movie-detail__desc--container">
            <h1><?php echo($movie->getName()); ?></h1>
            <small><?php echo($movie->getLanguage()); ?> / <?php echo($movie->getDuration()); ?></small>
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
                            <a href="/funciones?id=<?php echo($show->getId()); ?>"><?php echo($show->getDay()); ?> <?php echo($show->getTime()); ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>

<?php include_once('footer.php'); ?>
