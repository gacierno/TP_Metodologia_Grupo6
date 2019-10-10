<?php 
namespace dao;
/**
 *
 *	NAMESPACE DAO
 *
 */

require_once dirname(__DIR__).'/config/settings.php';
include_once 'GenreDao.php';

class MovieDao
{

	private $movieList = array();

	/*
	+-----------------------------------+
	|									|
	|	METHODS THAT CONNECT THE API    |
	|									|
	+-----------------------------------+
	*/

	/**
	 * getMoviesFromApi
	 * @return mixed
	 */
	private function getMoviesFromApi(){

		$listJson = file_get_contents( API_HOST.API_NOW."?api_key=". API_KEY );
		return json_decode($listJson, TRUE );

	}

	/**
	 * getSingleMovieApi
	 * @param integer
	 * @return json
	 */
	private function getSingleMovieApi( $id ){

		$jsonMovie = file_get_contents( API_HOST.API_MOVIE.$id."?api_key=". API_KEY );
		return json_decode($jsonMovie, TRUE );

	}

	/**
	 * getDataFromApi
	 */
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




	/*
	+------------------------------------------------+
	|											     |
	|	METHODS THAT CONNECT THE JSON STORED DATA    |
	|										     	 |
	+------------------------------------------------+
	*/

	/**
	 * retrieveData
	 */
	private function retrieveData(){

		$jsonMovieList = ( file_exists( dirname(__DIR__).'/data/movies.json' ) ) ? file_get_contents( dirname(__DIR__).'/data/movies.json' ) : '[]' ;
		$this->movieList = json_decode($jsonMovieList, TRUE); 

	}

	/**
	 * saveDataToJson
	 * @param integer
	 */

	private function saveDataToJson(){

		$listToFile = json_encode( $this->movieList, JSON_PRETTY_PRINT );
		file_put_contents( dirname(__DIR__).'/data/movies.json', $listToFile );

	}

	/**
	 * saveDataToJson
	 * @return Array() 
	 */

	public function getMovieList(){
		$this->retrieveData();
		return $this->movieList;
	}

	/**
	 * getById
	 * @param integer
	 * @return mixed
	 */
	public function getById( $id ){

		$output = false;

		// THIS SENTENCE VOIDS DATA DELETIONS WHILE UPDATING LIST
		if( sizeof($this->movieList) == 0) $this->retrieveData(); 

		foreach ($this->movieList as $value){
			if( $value['id'] == $id ) $output = $value;
		}
		return $output;

	}

}
 ?>