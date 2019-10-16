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
		$cine = new Cinema(
			$arr['name'],
			$arr['address'],
			$arr['capacity'],
			$arr['ticketValue'],
			$arr['id']
		);
		return $cine;
	}

	public function parseToHash( $obj ){
		return array(
			'id' 		=> $obj->getId(),
			'name' 		=> $obj->getName(),
			'address' 	=> $obj->getAddress(),
			'capacity'	=> $obj->getCapacity(),
			'ticketValue' => $obj->getTicketValue()
		);
	}

}


 ?>
