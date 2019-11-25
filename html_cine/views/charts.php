<!-- COMENTARIO PARA GASPU : Voy a utilizar un array de $movies, un array de $cinemas
y un array de $shows para hacer los filtros


EN CUANTO AL RETORNO :
Para JS necesito un objeto que tenga el atributo "output" que diga si es tickets o monto, y otro que sea "shows",
y dentro del show tiene el attributo name (nombre de la sala, nombre de la pelicula , hora/fecha) y value (valor para esa funcion)
-->

<?php include_once('header.php'); ?>

<div class="main-container container-fluid purchase__list--container">


<h1>ESTADISTICAS</h1>

<div class="charts__filter--container row">
    <div class="charts__filters--inner-container row">
        <div class="form-group charts__selects--container col-sm-12 col-lg-6">
            <label>Peliculas
            <select class="form-control" id="chart-movies">
                <option value="">Todas las peliculas</option>

                <?php foreach($movies as $movie) : ?>
                    <option value="<?php echo($movie->getId()); ?>"><?php echo($movie->getName()); ?></option>
                <?php endforeach; ?>
            </select>
            </label>

        </div>
        <div class="form-group charts__selects--container col-sm-12 col-lg-6">

            <label>Cines
            <select class="form-control" id="chart-cinemas">
                <option value="">Todos los cines</option>
                <?php foreach($cinemas as $cinema) : ?>
                    <option value="<?php echo($cinema->getId()); ?>"><?php echo($cinema->getName()); ?></option>
                <?php endforeach; ?>
            </select>
            </label>
        </div>
    </div>

    <div class="charts__filters--inner-container dates__outer-container row">

        <div class="form-group charts__options--container col-sm-12 col-lg-4">
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input class="form-check-input" checked type="radio" name="chartOutput" id="amount-btn" value="amount">
                Total Recaudado</label>
            </div>
        </div>

        <div class="form-group charts__options--container col-sm-12 col-lg-4">
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="chartOutput" id="tickets-btn" value="tickets_sold">
                Tickets Vendidos</label>
            </div>
        </div>
        <div class="form-group charts__options--container col-sm-12 col-lg-4">
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="chartOutput" id="tickets-btn" value="tickets_not_sold">
                Tickets Remanente</label>
            </div>
        </div>

    </div>
</div>

<div id="chart-container" class="chart-container" style="position: relative; height:100%; width:100%;">
    <canvas id="myChart"></canvas>
</div>


</div>

<?php include_once('footer.php'); ?>
