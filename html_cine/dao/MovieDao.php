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
use dao\GenreDao as GenreDao;
use dao\GenresOnMoviesDao as GenresOnMoviesDao;

class MovieDao extends BaseDao implements IApiConnector
{

	function __construct(){
		parent::setTableName( 'Movies' );
		parent::setSingleType( 'movie' );
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

		$rawList = $this->getApi();

		foreach ($rawList['results'] as $value) {

			$rawMovie = $this->getSingleMovieApi( $value['id'] );

			if( !($this->getById( $rawMovie['id']) ) ){

				$dataToSave['movie_id'] = $rawMovie['id'];
				$dataToSave['movie_title'] = $rawMovie['title'];
				$dataToSave['movie_runtime'] = $rawMovie['runtime'];
				$dataToSave['movie_language'] = $rawMovie['spoken_languages'][0]['name'];
				$dataToSave['movie_image'] = $rawMovie['poster_path'];
				// $dataToSave['movie_genres'] = array();

				$movie = new Movie($dataToSave);

				$this->add( $movie ); //save movie to db

				// save genre list to db
				foreach ($rawMovie['genres'] as $genre ) {
					$genreToSave['genre_id'] = $genre['id'];
					$genreToSave['movie_id'] = $dataToSave['movie_id'];
					GenresOnMoviesDao::add( $genreToSave );
					
				}

			}

		}

	}




	/*
	+------------------------------------------------+
	|											     |
	|	METHODS THAT CONNECT THE JSON STORED DATA    |
	|										     	 |
	+------------------------------------------------+
	*/



	/**
	 * parseToObject
	 * @param hashMap
	 * @return Object
	 */

	public function parseToObject( $arr ){
		$new_genres = array();
		$raw_genres = GenresOnMoviesDao::getGenresByMovieId( $arr['movie_id'] );
		$g_dao = new GenreDao();
		foreach ( $raw_genres as $value) {
			array_push( $new_genres, $g_dao->getById($value['genre_id']) );
		}
		$arr['movie_genres'] = $new_genres;
		$movie = new Movie($arr);
		return $movie;
	}

	/**
	 * parseToHash
	 * @param object
	 */

	// this hash is set only to save data on database
	
	public function parseToHash( $obj ){
		return array(
			'movie_title' => $obj->getName(),
			'movie_runtime' => $obj->getDuration(),
			'movie_language' => $obj->getLanguage(),
			'movie_image' => $obj->getImage(),
			'movie_id' => $obj->getId()
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
		if( sizeof($this->itemList) == 0 ) $this->itemList = $this->retrieveData();

		foreach ($this->itemList as $movie){
			foreach ($movie['genres'] as $genre ) {
				if( $genre->getId() == $id ){
					$match = new Movie( $movie );
					array_push( $output, $match );
				}
			}
		}
		return $output;

	}

}
 ?>
