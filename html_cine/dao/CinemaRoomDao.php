<?php
namespace dao;
/**
 *
 *	NAMESPACE DAO
 *
 */

use model\Cinema as Cinema;
use dao\BaseDao  as BaseDao;

class CinemaRoomDao extends BaseDao
{

	function __construct(){
		parent::setTableName( 'CinemaRooms' );
		parent::setSingleType( 'cinemaroom' );
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

    		'cinemaroom_capacity' => $obj->getCapacity(),
    		'cinemaroom_name' => $obj->getName(),
    		'cinemaroom_ticketValue' => $obj->getTicketValue(),
            'cinemaroom_id' => $obj->getId(),
            'cinemaroom_available' => $obj->getAvailability()

		);
	}

}


 ?>
