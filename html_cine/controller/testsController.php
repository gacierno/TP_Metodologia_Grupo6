<?php 

	include_once dirname(__DIR__).'/model/Cinema.php';
	include_once dirname(__DIR__).'/model/Genre.php';
	include_once dirname(__DIR__).'/model/Movie.php';
	// include_once dirname(__DIR__).'/model/Show.php';


	include_once dirname(__DIR__).'/dao/IApiConnector.php';
	include_once dirname(__DIR__).'/dao/BaseDao.php';
	include_once dirname(__DIR__).'/dao/CinemaDao.php';
	include_once dirname(__DIR__).'/dao/MovieDao.php';
	include_once dirname(__DIR__).'/dao/GenreDao.php';




	$cinemaDao = new dao\CinemaDao();

	$cinemas = $cinemaDao->getList();
	



	$data = new dao\MovieDao();

	$data->fetch();

	$list = $data->getList();





 ?>