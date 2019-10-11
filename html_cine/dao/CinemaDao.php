<?php 
namespace dao;
/**
 *
 *	NAMESPACE DAO
 *
 */

use model\Cinema as Cinema;

class CinemaDao
{

	private $cinemaList = array();


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

		$jsonList = ( file_exists( dirname(__DIR__).'/data/cinemas.json' ) ) ? file_get_contents( dirname(__DIR__).'/data/cinemas.json' ) : '[]' ;
		$this->cinemaList = json_decode($jsonList, TRUE); 

	}

	/**
	 * saveDataToJson
	 * @param integer
	 */

	private function saveDataToJson(){

		$listToFile = json_encode( $this->cinemaList, JSON_PRETTY_PRINT );
		file_put_contents( dirname(__DIR__).'/data/cinemas.json', $listToFile );

	}

	/**
	 * saveDataToJson
	 * @return Array() 
	 */

	public function getCinemaList(){

		$output = array();

		$this->retrieveData();

		foreach ( $this->cinemaList as $value ) {
			$cine = new Cinema(
				$value['name'],
				$value['address'],
				$value['capacity'],
				$value['ticketValue'],
				$value['id']
			);

			array_push( $output, $cine );
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
		if( sizeof($this->cinemaList) == 0 ) $this->retrieveData(); 

		foreach ($this->cinemaList as $value){
			if( $value['id'] == $id ) {
				$output = new Cinema(
					$value['name'],
					$value['address'],
					$value['capacity'],
					$value['ticketValue'],
					$value['id']
				);
			};
		}

		return $output;

	}


	/**
	 * getById
	 * @param Cinema
	 */
	public function addCinema( Cinema $cine ){
		if( !$this->getById( $cine->getId() ) ){ //getById executes retrieve data
			if( $cine->getId() == 0 ){
				$cine->setId( sizeof( $this->cinemaList ) +1 );
			}
			$cinemaHash = array(
				'id' 		=> $cine->getId(),
				'name' 		=> $cine->getName(),
				'address' 	=> $cine->getAddress(),
				'capacity'	=> $cine->getCapacity(),
				'ticketValue' => $cine->getTicketValue()
			);
			array_push( $this->cinemaList , $cinemaHash );
			$this->saveDataToJson();
		}
	}

}


 ?>