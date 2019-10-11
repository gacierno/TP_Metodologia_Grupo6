<?php 
	
	include_once './model/Cinema.php';
	include_once './model/Genre.php';
	include_once './model/Movie.php';
	include_once './model/Show.php';

	include_once './dao/MovieDao.php';
	include_once './dao/GenreDao.php';

	$genreeeee = new model\Genre( 1, 'fafa');

	$show = new model\Show();

	$cinema = new model\Cinema();

	$data = new dao\MovieDao();

	// $data->getDataFromApi();

	// $genres = new dao\GenreDao();
	// $genres->getDataFromApi();

	$list = $data->getMovieList();

	// [0] => Array
			//     (
			//         [id] => 475557
			//         [name] => Joker
			//         [duration] => 122
			//         [language] => en
			//         [image] => /udDclJoHjfjb8Ekgsd4FDteOkCU.jpg
			//         [genre] => Array
			//             (
			//                 [0] => 80
			//                 [1] => 53
			//                 [2] => 18
			//             )

			//     )

	$movie = new model\Movie(
		$list[0]['name'],
		$list[0]['duration'],
		$list[0]['language'],
		$list[0]['image'],
		$list[0]['genres'],
		$list[0]['id']
	);



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
		<pre><?php print_r( $movie->getGenres() ) ?></pre>
 	</body>
 </html>