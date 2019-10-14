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
	 * saveDataToJson
	 * @return Array() 
	 */

	public function getList(){

		$output = array();
		$this->retrieveData();

		foreach ( $this->itemList as $value ) {
			$genre = new Genre(
				$value['id'],
				$value['name']
			);

			array_push( $output, $genre );
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
		if( sizeof($this->itemList) == 0 ) $this->retrieveData(); 

		foreach ($this->itemList as $value){
			if( $value['id'] == $id ){
				$output = new Genre(
					$value['id'],
					$value['name']
				);
			} 

		}
		return $output;
	}

	/**
	 * getById
	 * @param integer
	 */
	public function add( $obj ){
		if( !$this->getById( $obj->getId() ) ){
			$genreHash = array(
				'id' => $obj->getId(),
				'name' => $obj->getName()
			);
			array_push( $this->itemList , $genreHash );
			$this->SaveAll();
		}
	}


	public function update( $id , $obj ){
		$this->retrieveData();
		foreach ( $this->itemList as $key=>$post) {
		    if($post['id'] == $id){

		    	$value['id'] = $obj->getName();
		    	$value['name'] = $obj->getDuration();

		        $this->itemList[$key] = $value;
		        $this->SaveAll();
		        return true;
		    }
		}
		return false;
	}

}
 ?>