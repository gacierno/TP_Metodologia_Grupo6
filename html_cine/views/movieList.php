<?php include_once('header.php');

$genero = isset($_GET['genero']) ? $_GET['genero'] : "";

?>

<div class="main-container-no-padding container-fluid">


    <div class="row">
    
        <div class="hide-on-mobile-flex col-md-5 col-lg-3 movielist__filter--column">

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
                        <option value=""  selected>Selecciona un cine</option>
                        <?php foreach ($cinemas as $cinema) : ?>
                        <option value="<?php echo($cinema->getId()); ?>"><?php echo($cinema->getName()); ?></option>
                        <?php endforeach; ?>
                    </select>
                 </label>
                </form>
            </div>

        </div>
    
        
        <div class="col-md-7 col-lg-9 movielist__movies--column"></div>
    
    </div>


</div>
<?php include_once('footer.php'); ?>
