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
	 * parseToObject
	 * @param hashMap
	 * @return Object
	 */

	public function parseToObject( $arr ){
		return new Cinema( $arr );
	}

	public function parseToHash( $obj ){
		return array(

			'cinema_address' => $obj->getAddress(),
			'cinema_name' => $obj->getName(),
	        'cinema_id' => $obj->getId(),
	        'cinema_available' => $obj->getAvailability()

		);
	}

}


 ?>
