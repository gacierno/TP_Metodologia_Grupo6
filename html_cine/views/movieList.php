<?php include_once('header.php');
include_once dirname(__DIR__).'/model/Movie.php';
$movie = new model\Movie('Los 3 chiflados',120,'espanolo','https://pulpfictioncine.com/download/multimedia.normal.b174f62ceef51960.64656164706f6f6c5f6e6f726d616c2e6a7067.jpg',array('comedia'),1);
$movies = array($movie);

?>

<div class="main-container container-fluid">

    <div class="movielist__filter--container">
        <form id="genre-filter-form" method="GET" action="javascript:void(0)">
            <label id="inpt_search_label" class="search" for="inpt_search">
                <input name="genre" placeholder="Filtra por género/s" id="inpt_search" type="text" />
            </label>
        </form> 
    </div>
    <div class="row movielist__row">
        <div id="movielist-slider" class="owl-carousel owl-theme owl-movielist">
        <?php include_once('movieItems.php'); ?>
        </div>
        <div class="right-arrow"><img src="/public/assets/images/arrow-right.svg"></div>
        <div class="left-arrow"><img src="/public/assets/images/arrow-left.svg"></div>
    </div>
</div>
<?php include_once('footer.php'); ?>

