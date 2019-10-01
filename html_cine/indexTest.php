<?php 
	
	include_once './model/Cinema.php';
	include_once './model/Genre.php';
	include_once './model/Movie.php';
	include_once './model/Show.php';


	$genreeeee = new model\Genre();

	$movie = new model\Movie();

	$show = new model\Show();

	$cinema = new model\Cinema();

 ?>

 <html>
 	<head>
 		<title></title>
 	</head>
 	<body>

		<p><?php echo "Genre ID: ".$genreeeee->getId() ."\n" ?></p>

		<p><?php echo "Movie Name: ".$movie->getName() ."\n" ?></p>

		<p><?php echo "Show Time: ".$show->getTime() ."\n" ?></p>

 		<p><?php echo "Cinema Name: ".$cinema->getName()."\n" ?></p>
 		
 	</body>
 </html>