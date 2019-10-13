<?php 

	// include_once dirname(__DIR__).'/model/Cinema.php';
	include_once dirname(__DIR__).'/model/Genre.php';
	include_once dirname(__DIR__).'/model/Movie.php';
	// include_once dirname(__DIR__).'/model/Show.php';


	include_once dirname(__DIR__).'/dao/IApiConnector.php';
	include_once dirname(__DIR__).'/dao/BaseDao.php';
	include_once dirname(__DIR__).'/dao/CinemaDao.php';
	include_once dirname(__DIR__).'/dao/MovieDao.php';
	include_once dirname(__DIR__).'/dao/GenreDao.php';




	// $cinemaDao = new dao\CinemaDao();

	// $cinema = new model\Cinema( 'cine del paseo', 'diagonale pueyredon 4545', 45 );

	// $cinemaDao->addCinema( $cinema );

	// $cinemaList = $cinemaDao->getCinemaList();
	



	$data = new dao\MovieDao();

	$data->fetch();

	// $genres = new dao\GenreDao();
	// $genres->getDataFromApi();

	$list = $data->getList();





 ?>