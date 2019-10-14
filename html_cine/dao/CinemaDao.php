<?php
namespace dao;
/**
 *
 *	NAMESPACE DAO
 *
 */

use model\Cinema as Cinema;
use dao\BaseDao  as BaseDao;

class CinemaDao extends BaseDao
{

	function __construct(){
		parent::setItemType( 'cinemas' );
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
		if( sizeof($this->itemList) == 0 ) $this->retrieveData();

		foreach ($this->itemList as $value){
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
	 * add
	 * @param Cinema
	 */
	public function add( $obj ){
		if( !$this->getById( $obj->getId() ) ){ //getById executes retrieve data

			if( is_null($obj->getId()) ){
				$obj->setId( time() );  // SETTING A TIMESTAMP AS CINEMA ID
			}

			$cinemaHash = array(
				'id' 		=> $obj->getId(),
				'name' 		=> $obj->getName(),
				'address' 	=> $obj->getAddress(),
				'capacity'	=> $obj->getCapacity(),
				'ticketValue' => $obj->getTicketValue()
			);

			array_push( $this->itemList , $cinemaHash );
			$this->SaveAll();
			return true;
		}
		return false;
	}


	public function update( $id , $obj ){
		$this->retrieveData();
		foreach ( $this->itemList as $key=>$post) {
		    if($post['id'] == $id){

		    	$cinemaHash = array(
					'id' 		=> $obj->getId(),
					'name' 		=> $obj->getName(),
					'address' 	=> $obj->getAddress(),
					'capacity'	=> $obj->getCapacity(),
					'ticketValue' => $obj->getTicketValue()
				);

		        $this->itemList[$key] = $cinemaHash;
		        $this->SaveAll();
		        return true;
		    }
		}
		return false;
	}

}


 ?>
