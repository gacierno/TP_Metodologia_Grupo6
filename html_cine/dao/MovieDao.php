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

		$this->retrieveData();

		$rawList = $this->getApi();

		foreach ($rawList['results'] as $value) {

			$rawMovie = $this->getSingleMovieApi( $value['id'] );

			if( !($this->getById( $rawMovie['id']) ) ){

				$dataToSave['id'] = $rawMovie['id'];
				$dataToSave['name'] = $rawMovie['title'];
				$dataToSave['duration'] = $rawMovie['runtime'];
				$dataToSave['language'] = $rawMovie['original_language'];
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
	 * getList
	 * @return Array()
	 */

	public function getList(){

		$output = array();
		$this->retrieveData();

		foreach ( $this->itemList as $value ) {
			$movie = new Movie(
				$value['name'],
				$value['duration'],
				$value['language'],
				$value['image'],
				$value['genres'],
				$value['id']
			);

			array_push( $output, $movie );
		}
		return $output;

	}

	/**
	 * getById
	 * @param integer
	 * @return mixed
	 */
	public function getById( $id ){

		$output = false;

		// THIS SENTENCE VOIDS DATA DELETIONS WHILE UPDATING LIST
		if( sizeof($this->itemList) == 0) $this->retrieveData();

		foreach ($this->itemList as $value){
			if( $value['id'] == $id ){
				$output = new Movie(
					$value['name'],
					$value['duration'],
					$value['language'],
					$value['image'],
					$value['genres'],
					$value['id']
				);
			}
		}
		return $output;

	}

	public function add( $obj ){

		if( !$this->getById( $obj->getId() ) ){

			$value['name'] = $obj->getName();
			$value['duration'] = $obj->getDuration();
			$value['language'] = $obj->getLanguage();
			$value['image'] = $obj->getImage();
			$value['genres'] = $obj->getGenres();
			$value['id'] = $obj->getId();

			array_push( $this->itemList, $value );
			$this->SaveAll();
			return true;
		}
		return false;

	}

	public function update( $id , $obj ){
		foreach ( $this->retrieveData() as $key=>$post) {
		    if($post->getID() == $id){

		    	$value['name'] = $obj->getName();
		    	$value['duration'] = $obj->getDuration();
		    	$value['language'] = $obj->getLanguage();
		    	$value['image'] = $obj->getImage();
		    	$value['genres'] = $obj->getGenres();
		    	$value['id'] = $obj->getId();

		        $this->postsList[$key] = $value;
		        $this->SaveAll();
		        return true;
		    }
		}
		return false;
	}

}
 ?>
