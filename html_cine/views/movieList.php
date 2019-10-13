<?php include_once('header.php');
include_once dirname(__DIR__).'/model/Movie.php';
$movie = new model\Movie('Los 3 chiflados',120,'espanolo','https://pulpfictioncine.com/download/multimedia.normal.b174f62ceef51960.64656164706f6f6c5f6e6f726d616c2e6a7067.jpg',array('comedia'),1);
$movies = array($movie);

?>

<div class="main-container container-fluid">
    <div class="row movielist__row">
        <div id="movielist-slider" class="owl-carousel owl-theme owl-movielist">
<?php foreach($movies as $movie) : ?>
            <div class="item movielist__card--container" style="background-image:url('<?php echo($movie->getImage()); ?>');background-position:center;background-size:cover;">
                <div class="movielist__card--overlay">
                    <div class="moviecard__info--container">
                        <div class="moviecard__name--container"><h2><?php echo($movie->getName()); ?></h2></div>
                        <hr>
                        <div class="moviecard__duration--container"><h4><?php echo($movie->getDuration().' minutos'); ?></h4></div>
                        <div class="moviecard__language--container"><h4><?php echo($movie->getLanguage()); ?></h4></div>
                        <div class="moviecard__genre--container"><h4><?php foreach($movie->getGenres() as $genre) : echo($genre); endforeach; ?></h4></div>
                    </div>
                </div>
            </div>
<?php endforeach; ?>
        </div>
        <div class="right-arrow"><img src="/public/assets/images/arrow-right.svg"></div>
        <div class="left-arrow"><img src="/public/assets/images/arrow-left.svg"></div>
    </div>
</div>
<?php include_once('footer.php'); ?>

