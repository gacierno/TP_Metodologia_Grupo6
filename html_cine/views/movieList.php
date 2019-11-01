<?php include_once('header.php');

$genero = isset($_GET['genero']) ? $_GET['genero'] : "";

?>

<div class="main-container container-fluid">

    <div id="movielist__filter--outer-container" class="height-non-mod movielist__filter--container dropdown">
        <span class="selLabel">Filtrar peliculas</span>
        <input type="hidden" name="cd-dropdown">
        <ul class="dropdown-list">
            <li>
                <form id="date-filter-form" method="GET" action="/peliculas">
                <?php $today = date('Y-m-d',time()); ?>
                    <input id="moviefilter__select--date" min="<?php echo($today); ?>" value="" type="date" name="date" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="form-control form-control-md movielist__filter-select">
                </form>
            </li>

            <li>
            <form id="cinema-filter-form" method="GET" action="/peliculas">
            <select id="moviefilter__select--cinema" name="cinema" class="form-control form-control-md movielist__filter-select" value="">
                <option value=""  selected>Selecciona un cine</option>
                <?php foreach ($cinemas as $cinema) : ?>
                <option value="<?php echo($cinema->getId()); ?>"><?php echo($cinema->getName()); ?></option>
                <?php endforeach; ?>
                </select>
            </form>
            </li>
            <li>
            <form id="genre-filter-form" method="GET" action="/peliculas">
                <select id="moviefilter__multiple-select--genre" name="genre" multiple class="form-control form-control-md movielist__filter-select" value="">
                    <option id="filter-genre-reset"  value="all">Todos los Generos</option>
                    <?php foreach ($genres as $genre) : ?>
                    <option value="<?php echo($genre->getId()); ?>"><?php echo($genre->getName()); ?></option>
                    <?php endforeach; ?>
                </select>
            </form>
            </li>
        </ul>
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
