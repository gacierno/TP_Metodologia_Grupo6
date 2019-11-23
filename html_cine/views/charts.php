<!-- COMENTARIO PARA GASPU : Voy a utilizar un array de $movies, un array de $cinemas
y un array de $shows para hacer los filtros -->

<?php include_once('header.php'); ?>

<div class="main-container container-fluid purchase__list--container">


<h1>ESTADISTICAS</h1>

<div class="charts__filter--container">
    <div class="charts__filters--inner-container">
        <div class="form-group charts__selects--container">
            <label>Peliculas
            <select class="form-control" id="chart-movies" placeholder="select movie">
                <?php foreach($movies as $movie) : ?>
                    <option value="<?php echo($movie->getId()); ?>"><?php echo($movie->getName()); ?></option>
                <?php endforeach; ?>
            </select>
            </label>

            <label>Funciones
            <select class="form-control" id="chart-shows" placeholder="select movie">
                <option>1</option>
            </select>
            </label>
            
            <label>Cines
            <select class="form-control" id="chart-cinemas" placeholder="select movie">
                <?php foreach($cinemas as $cinema) : ?>
                    <option value="<?php echo($cinema->getId()); ?>"><?php echo($cinema->getName()); ?></option>
                <?php endforeach; ?>
            </select>
            </label>
        </div>
    </div>

    <div class="charts__filters--inner-container dates__outer-container">
        <div class="form-group charts__dates--container">
            <?php $today = date('Y-m-d',time()); ?>
            <label>FROM
            <input id="chart-begin-date" min="<?php echo($today); ?>" value="" type="date" name="initial-date" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="form-control form-control-md">
            </label>
            <label>TO
            <input id="chart-final-date" min="<?php echo($today); ?>" value="" type="date" name="final-date" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="form-control form-control-md">
            </label>
        </div>

        <div class="form-group charts__options--container">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                <label class="form-check-label" for="inlineRadio1">Total Recaudado</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                <label class="form-check-label" for="inlineRadio2">Tickets Vendidos</label>
            </div>
        </div>
    </div>
</div>

<div class="chart-container" style="position: relative; height:100%; width:100%;">
    <canvas id="myChart"></canvas>
</div>


</div>

<?php include_once('footer.php'); ?>
