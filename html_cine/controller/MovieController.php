<?php 
namespace controller;
/**
 * 
 */

include_once dirname(__DIR__).'/dao/MovieDao.php';
include_once dirname(__DIR__).'/model/Movie.php';

class MovieController
{

	//movieList is an array of movies from class Movie
	private $movieList = array();

	function __construct( )
	{
		$dao = new dao\MovieDao();
		foreach ( $dao->getMovielist() as $hashMovie ) {




			$movie = new model\Movie(
				// $name = 'Unnamed', 
				// $duration = 0, 
				// $language = 'Unavailable', 
				// $image = '/assets/default.jpg'
				// $genre array
			);



		}
		$this->movieList = $dao->getMovieList();
	}

	public function getMovieList(){

	}


}

 ?>