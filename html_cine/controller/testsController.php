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

	$movie = $list[0];




 ?>