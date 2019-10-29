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
		parent::setTableName( 'Genres' );
		parent::setSingleType( 'genre' );
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
	 * Update Database
	 */
	public function fetch(){

		$rawList = $this->getGenresFromApi();
		foreach ($rawList['genres'] as $value) {
			if( !($this->getById( $value['id']) ) ){
				$value['genre_id'] = $value['id'];
				$value['genre_name'] = $value['name'];
				$this->add( $this->parseToObject( $value ) );
			}

		}
	}





	/*
	+------------------------------------------------+
	|											     |
	|	METHODS THAT CONNECT TO DATA BASE     		 |
	|										     	 |
	+------------------------------------------------+
	*/


	/**
	 * parseToObject
	 * @param hashMap
	 * @return Object
	 */

	public function parseToObject( $arr ){
		return new Genre($arr);
	}

	/**
	 * parseToHash
	 * @param object
	 */

	public function parseToHash( $obj ){
		return array(
			'genre_id' => $obj->getId(),
			'genre_name' => $obj->getName()
		);
	}


}
 ?>