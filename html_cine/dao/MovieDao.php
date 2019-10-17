<?php
namespace dao;
/**
 *
 *	NAMESPACE DAO
 *
 */

use model\Movie as Movie;
use dao\BaseDao  as BaseDao;
use dao\IApiConnector as IApiConnector; 

class MovieDao extends BaseDao implements IApiConnector
{

	function __construct(){
		parent::setItemType( 'movies' );
	}

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
	private function getApi(){

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
	public function fetch(){

		$this->itemList = $this->retrieveData();

		$rawList = $this->getApi();

		foreach ($rawList['results'] as $value) {

			$rawMovie = $this->getSingleMovieApi( $value['id'] );

			if( !($this->getById( $rawMovie['id']) ) ){

				$dataToSave['id'] = $rawMovie['id'];
				$dataToSave['name'] = $rawMovie['title'];
				$dataToSave['duration'] = $rawMovie['runtime'];
				$dataToSave['language'] = $rawMovie['spoken_languages'][0]['name'];
				$dataToSave['image'] = $rawMovie['poster_path'];
				$dataToSave['genres'] = array();

				foreach ($rawMovie['genres'] as $genre ) {
					array_push( $dataToSave['genres'], $genre['id'] );
				}

				array_push( $this->itemList, $dataToSave );
			}

		}

		$this->SaveAll();

	}




	/*
	+------------------------------------------------+
	|											     |
	|	METHODS THAT CONNECT THE JSON STORED DATA    |
	|										     	 |
	+------------------------------------------------+
	*/


	/**
	 * parseToObjects
	 * @param Array()
	 * @return Array(Cunema)
	 */

	public function parseToObjects( $arr ){

		$output = array();
		foreach ( $arr as $value ) {
			array_push( $output, $this->parseToObject( $value ) );
		}
		return $output;
	}

	/**
	 * parseToObject
	 * @param hashMap
	 * @return Object
	 */

	public function parseToObject( $arr ){
		$movie = new Movie(
			$arr['name'],
			$arr['duration'],
			$arr['language'],
			$arr['image'],
			$arr['genres'],
			$arr['id']
		);
		return $movie;
	}

	/**
	 * parseToHash
	 * @param object
	 */
	
	public function parseToHash( $obj ){
		return array(
			'name' => $obj->getName(),
			'duration' => $obj->getDuration(),
			'language' => $obj->getLanguage(),
			'image' => $obj->getImage(),
			'genres' => $obj->getGenres(),
			'id' => $obj->getId()
		);
	}


	/**
	 * getByGenre
	 * @param integer
	 * @return mixed
	 */
	public function getByGenre( $id ){

		$output = array();

		// THIS SENTENCE VOIDS DATA DELETIONS WHILE UPDATING LIST
		if( sizeof($this->itemList) == 0) $this->itemList = $this->retrieveData();

		foreach ($this->itemList as $movie){
			if( array_search( $id, $movie['genres'] ) ){
				$match = new Movie(
					$movie['name'],
					$movie['duration'],
					$movie['language'],
					$movie['image'],
					$movie['genres'],
					$movie['id']
				);
				array_push( $output, $match );
			}
		}
		return $output;

	}

}
 ?>
