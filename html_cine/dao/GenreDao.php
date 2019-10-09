<?php 
namespace dao;
/**
 *
 *	NAMESPACE DAO
 *
 */

require_once dirname(__DIR__).'/config/settings.php';

class GenreDao
{

	private $genreList = array();

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

		$jsonGenreList = ( file_exists( dirname(__DIR__).'/data/genres.json' ) ) ? file_get_contents( dirname(__DIR__).'/data/genres.json' ) : '[]' ;
		$this->genreList = json_decode($jsonGenreList, TRUE); 

	}

	/**
	 * saveDataToJson
	 * @param integer
	 */

	private function saveDataToJson(){

		$listToFile = json_encode( $this->genreList, JSON_PRETTY_PRINT );
		file_put_contents( dirname(__DIR__).'/data/genres.json', $listToFile );

	}

	/**
	 * saveDataToJson
	 * @return Array() 
	 */

	public function getGenreList(){
		$this->retrieveData();
		return $this->genreList;
	}

	/**
	 * getById
	 * @param integer
	 * @return mixed
	 */

	public function getById( $id ){

		$output = false;

		// THIS SENTENCE VOIDS DATA DELETIONS WHILE UPDATING LIST
		if( sizeof($this->genreList) == 0 ) $this->retrieveData(); 

		foreach ($this->genreList as $value){
			if( $value['id'] == $id ) $output = $value;
		}
		return $output;

	}


	/**
	 * getById
	 * @param integer
	 */
	public function addGenre( $id, $name ){
		if( $this->getById($id) ){
			$genreHash = array(
				'id' => $id,
				'name' => $name
			);
			array_push( $this->genreList , $genreHash );
			$this->saveDataToJson();
		}
	}

}
 ?>