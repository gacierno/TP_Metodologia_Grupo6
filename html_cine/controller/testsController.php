<?php 

	include_once dirname(__DIR__).'/model/Cinema.php';
	include_once dirname(__DIR__).'/model/Genre.php';
	include_once dirname(__DIR__).'/model/Movie.php';
	include_once dirname(__DIR__).'/model/Show.php';


	include_once dirname(__DIR__).'/dao/CinemaDao.php';
	include_once dirname(__DIR__).'/dao/MovieDao.php';
	include_once dirname(__DIR__).'/dao/GenreDao.php';

	$cinemaDao = new dao\CinemaDao();

	$cinema = new model\Cinema( 'cine del paseo', 'diagonale pueyredon 4545', 45 );

	$cinemaDao->addCinema( $cinema );

	$cinemaList = $cinemaDao->getCinemaList();


	$genreeeee = new model\Genre( 1, 'fafa');

	$show = new model\Show();

	

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