<?php include_once('header.php');

// if(sizeof($shows) > 0) {
//     $movie = $shows[0]->getMovie();
// }

$cines = [];
$cinemaids = [];

foreach($shows as $show){
    $cinemaName = $show->getCinema()->getName();
    if(!isset($cines[$cinemaName])){
        $cines[$cinemaName] = [];
        $cinemaids[$cinemaName] = $show->getCinema()->getId();
    }
    $showData = [];
    $showData["day"] = $show->getDay();
    $showData["time"] = $show->getTime();
    $showData["ID"] = $show->getId();
    array_push($cines[$cinemaName],$showData);
}


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
                foreach($genres as $genre) :

                ?>

                <div class="badge badge-secondary"><?php echo($genre->getName()); ?></div>

                <?php endforeach; ?>
            </div>
            <p><?php echo($movie->getDescription()); ?></p>
            <div class="movie-detail__shows--container">
                <?php foreach($cines as $key => $value) : ?>
                <div id="cinema-<?php echo $cinesId[$key]; ?>" class="dropdown">
                    <span class="selLabel"><?php echo($key); ?></span>
                    <input type="hidden" name="cd-dropdown">
                    <ul class="dropdown-list">
                        <?php foreach($value as $show) : ?>
                        <li data-value="<?php echo($show["ID"]); ?>">
                            <a href="/funciones?id=<?php echo($show["ID"]); ?>"><?php echo($show["day"]); ?> <?php echo($show["time"]); ?></a>
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
