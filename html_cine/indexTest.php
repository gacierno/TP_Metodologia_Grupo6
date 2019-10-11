<?php 
	
include_once './controller/testsController.php';

 ?>

 <html>
 	<head>
 		<title></title>
 	</head>
 	<body>

		<p><?php echo "Genre ID: ".$genreeeee->getId() ."\n" ?></p>
		<p><?php echo "Genre NAME: ".$genreeeee->getName() ."\n" ?></p>

		<p><?php echo "Movie Name: ".$movie->getName() ."\n" ?></p>

		<p><?php echo "Show Time: ".$show->getTime() ."\n" ?></p>

 		<p><?php echo "Cinema Name: ".$cinema->getName()."\n" ?></p>

 		<pre><?php print_r( $data->getMovieList() ) ?></pre>

 		<p>test a new movie from class MOVIE</p>
 		<p>ID: <?php $movie->getId() ?></p>
 		<p>NOMBRE: <?php $movie->getName() ?></p>
 		<img src="<?php echo API_IMAGE_HOST . API_IMAGE_SIZE_LARGE . $movie->getImage();?>" alt="">
		<pre><?php print_r( $cinemaList ) ?></pre>
 	</body>
 </html>