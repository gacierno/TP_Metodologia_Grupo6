<?php 
namespace dao;
/**
 *
 *	NAMESPACE DAO
 *
 */

use model\Genre as Genre;
use dao\BaseDao as BaseDao;
use dao\IApiConnector as IApiConnector;

class GenreDao extends BaseDao implements IApiConnector
{

	function __construct(){
		parent::setItemType( 'genres' );
	}


	/*
	+-----------------------------------+
	|									|
	|	METHODS THAT CONNECT THE API    |
	|									|
	+-----------------------------------+
	*/

	/**
	 * getGenresFromApi
	 * @return mixed
	 */
	private function getGenresFromApi(){

		$listJson = file_get_contents( API_HOST.API_GENRE."?api_key=". API_KEY ."&language=en-US");
		return json_decode($listJson, TRUE );

	}

	/**
	 * getDataFromApi
	 */
	public function fetch(){

		$this->retrieveData();

		$rawList = $this->getGenresFromApi();

		foreach ($rawList['genres'] as $value) {

			if( !($this->getById( $value['id']) ) ){
				
				$dataToSave['id'] = $value['id'];
				$dataToSave['name'] = $value['name'];

				array_push( $this->genreList, $dataToSave );
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
		$genre = new Genre(
				$arr['id'],
				$arr['name']
			);
		return $genre;
	}

	/**
	 * parseToHash
	 * @param object
	 */

	public function parseToHash( $obj ){
		return array(
			'id' => $obj->getId(),
			'name' => $obj->getName()
		);
	}


}
 ?>