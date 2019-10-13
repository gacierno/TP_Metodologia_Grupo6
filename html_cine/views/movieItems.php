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