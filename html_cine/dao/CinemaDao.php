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
		parent::setTableName( 'Cinemas' );
		parent::setSingleType( 'cinema' );
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
		return new Cinema( $arr );
	}

	public function parseToHash( $obj ){
		return array(
			'cinema_name' 		=> $obj->getName(),
			'cinema_address' 	=> $obj->getAddress(),
			'cinema_capacity'	=> $obj->getCapacity(),
			'cinema_ticketValue' => $obj->getTicketValue()
		);
	}

}


 ?>
