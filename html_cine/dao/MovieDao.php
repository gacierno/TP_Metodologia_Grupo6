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
use dao\Conection as Conection;

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
				$dataToSave['movie_description'] = $rawMovie['overview'];

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
			'movie_id' => $obj->getId(),
			'movie_description' => $obj->getDescription(),
			'movie_available' => $obj->getAvailability()
		);
	}


	public function getMoviesBy( $args = array() ){
		$outout = array();

		//	set the elements needed for a movie instance
		$query = "select M.movie_id as movie_id, M.movie_image as movie_image, M.movie_language as movie_language, M.movie_title as movie_title, M.movie_runtime as movie_runtime, M.movie_description as movie_description from Cinemarooms CR inner join Shows S on CR.cinemaroom_id = S.cinemaroom_id inner join Movies M on M.movie_id = S.movie_id inner join Genres_on_Movies GM on GM.movie_id = M.movie_id where S.show_available = 1 and S.show_date >= '";

		if( isset( $args['date'] ) ){
			$query .= $args['date']. "' ";
		}else{
			$query .= date("Y-m-d"). "' ";
		}

		if( isset( $args['cinema'] ) || isset( $args['genres'] ) ){
			$query .= "and ";
		}


		//	if genres is set add the filter to the query
		if( isset( $args['genres'] ) ){
			$query .= "GM.genre_id in (";
			$query .= preg_replace( "/[ \[ \] \" ]/", "", json_encode( $args['genres'] ) ). ") ";
			// adds the connector and in case more params where set
			if( isset( $args['cinema'] ) ){
				$query .= "and ";
			}
		}

		//	if cinema is set add the filter to the query
		if( isset( $args['cinema'] ) ){
			$query .= "S.cinema_id = ".$args['cinema']. " ";
		}

		$query .= "group by M.movie_id;";

		// echo $query;

		try {
			$connection = Connection::GetInstance();
			$outout = parent::parseToObjects( $connection->Execute( $query ) );
		} catch (Exception $e) {
			throw $e;
		}catch (Exception $e) {
			throw $e;
		}

		return $outout;
	}

}


 ?>
