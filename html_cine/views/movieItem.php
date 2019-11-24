<?php foreach($movies as $movie) : ?>
            <div movieId="<?php echo($movie->getId()); ?>" class="col-sm-12 col-md-6 col-lg-4 col-xl-3 movie-item__container">
                <a href="/pelicula/detalle?id=<?php echo($movie->getId()); ?>">
                    <img src="<?php echo(API_IMAGE_HOST . API_IMAGE_SIZE_LARGE . $movie->getImage()); ?>" alt="">
                </a>
            </div>
<?php endforeach; ?>