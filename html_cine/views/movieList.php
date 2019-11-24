<?php include_once('header.php');

$genero = isset($_GET['genero']) ? $_GET['genero'] : "";

?>

<div class="main-container-no-padding container-fluid">


    <div class="row">
    
        <div class="col-sm-12 col-md-5 col-lg-3 movielist__filter--column">
            <div class="hide-on-desktop filter-back-btn--container">
                <img src="/public/assets/images/back-arrow.png" alt="">
            </div>
            <div class="movies__filter--inner-container">
                <form id="date-filter-form" method="GET" action="/peliculas">
                <?php $today = date('Y-m-d',time()); ?>
                    <label class="moviefilter__select--date-label">Elige una fecha
                        <input id="moviefilter__select--date" min="<?php echo($today); ?>" value="" type="date" name="date" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="form-control form-control-md movielist__filter-select">
                    </label>
                </form>


                <form id="cinema-filter-form" method="GET" action="/peliculas">
                <label>Elige un cine
                    <select id="moviefilter__select--cinema" name="cinema" class="form-control form-control-md movielist__filter-select" value="">
                        <option value=""  selected></option>
                        <?php foreach ($cinemas as $cinema) : ?>
                        <option value="<?php echo($cinema->getId()); ?>"><?php echo($cinema->getName()); ?></option>
                        <?php endforeach; ?>
                    </select>
                 </label>
                </form>


                <form id="genre-filter-form" method="GET" action="/peliculas">
                <p>Elige géneros</p>
                <?php foreach ($genres as $genre) : ?>
                    <label class="container"><?php echo($genre->getName()); ?>
                        <input type="checkbox" value="<?php echo($genre->getId()); ?>">
                        <span class="checkmark"></span>
                    </label>
                <?php endforeach; ?>
                </form>
            </div>

        </div>
    
        <div class="mobile-filter-btn-container hide-on-desktop">
                <button id="mobile-filter-trigger" class="btn btn-danger">Filtrar</button>
            </div>
        <div id="movielist__movies--column" class="col-md-7 col-lg-9 movielist__movies--column">
            
            <div id="movies--inner-container" class="row movies--inner-container">
                <?php foreach($movies as $movie) : 
                    include_once('movieItem.php'); 
                endforeach; ?>
                <div class="movies__info-bar">
                <?php foreach($movies as $movie) : ?>
                    <p id="<?php echo($movie->getId()); ?>"><?php echo($movie->getLanguage()); ?> / <?php echo($movie->getDuration()); ?> / <?php foreach($movie->getGenres() as $genre) {
                            
                            echo($genre->getName() . " - ");

                        }?></p>
                <?php endforeach; ?>
                </div>
            </div>
            
        </div>
    </div>


</div>
<?php include_once('footer.php'); ?>
