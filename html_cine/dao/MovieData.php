<?php 
namespace dao;
/**
 *	NAMESPACE DAO
 *	STATIC METHODS
 */

require_once dirname(__DIR__).'/config/settings.php';
include_once dirname(__DIR__).'/model/Movie.php';

class MovieData
{

	private $movieList = array();

	/************
	*	METHODS THAT CONNECT THE API
	*************/
	private function getMoviesFromApi(){

		$listJson = file_get_contents( API_MOVIE_HOST.API_NOW."?api_key=". API_KEY );
		return json_decode($listJson, TRUE );

	}

	private function getSingleMovieApi( $id ){

		$jsonMovie = file_get_contents( API_MOVIE_HOST.$id."?api_key=". API_KEY );
		return json_decode($jsonMovie, TRUE );

	}

	public function getDataFromApi(){

		$this->retrieveData();

		$rawList = $this->getMoviesFromApi();

		foreach ($rawList['results'] as $value) {

			$rawMovie = $this->getSingleMovieApi( $value['id'] );

			if( !($this->getById( $rawMovie['id']) ) ){
				
				$dataToSave['id'] = $rawMovie['id'];
				$dataToSave['name'] = $rawMovie['title'];
				$dataToSave['duration'] = $rawMovie['runtime'];
				$dataToSave['language'] = $rawMovie['original_language'];
				$dataToSave['image'] = $rawMovie['poster_path'];
				$dataToSave['genre'] = $rawMovie['genres'];

				array_push( $this->movieList, $dataToSave );
			}

		}

		$this->saveDataToJson();

	}




	/************
	*	METHODS THAT CONNECT THE JSON STORED DATA
	*************/
	private function retrieveData(){

		$jsonMovieList = ( file_exists( dirname(__DIR__).'/data/movies.json' ) ) ? file_get_contents( dirname(__DIR__).'/data/movies.json' ) : '[]' ;
		$this->movieList = json_decode($jsonMovieList, TRUE); 
		// return $this->movieList;

	}

	/**
	 * @param integer
	 * @return mixed
	 */
	public function getById( $id ){

		$output = false;
		if( sizeof($this->movieList) == 0) $this->retrieveData();
		foreach ($this->movieList as $value){
			if( $value['id'] == $id ) $output = $value;
		}
		return $output;
	}


	public function saveDataToJson(){

		$listToFile = json_encode( $this->movieList, JSON_PRETTY_PRINT );
		file_put_contents( dirname(__DIR__).'/data/movies.json', $listToFile );

	}

}
 ?>