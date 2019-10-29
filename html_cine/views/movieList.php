<?php include_once('header.php');

$genero = isset($_GET['genero']) ? $_GET['genero'] : "";

?>

<div class="main-container container-fluid">

    <div class="movielist__filter--container">
        <form id="genre-filter-form" method="GET" action="/peliculas">
            <select id="moviefilter__select--genre" name="genre" class="form-control form-control-md movielist__filter-select">
                <option value="" disable selected>Selecciona un genero</option>
                <?php foreach ($genres as $genre) : ?>
                <option value="<?php echo($genre->getId()); ?>"><?php echo($genre->getName()); ?></option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>
    <div class="row movielist__row">
        <div id="movielist-slider-container" class="col-12">
        <?php include_once('partials/customMessage.php'); ?>
          <div id="movielist-slider" class="owl-carousel owl-theme owl-movielist">
          <?php include_once('movieItems.php'); ?>
          </div>
        </div>
        <div class="right-arrow"><img src="/public/assets/images/arrow-right.svg"></div>
        <div class="left-arrow"><img src="/public/assets/images/arrow-left.svg"></div>
    </div>
    <div id="movies__not-found-row" class="row">
        <div class="col-12"><h2>NO MOVIES FOUND</h2></div>
    </div>
</div>
<?php include_once('footer.php'); ?>
