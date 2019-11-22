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
        'cinema_id' => $obj->getCinema()->getId(),
        'cinemaroom_available' => $obj->getAvailability()

		);
	}

}


 ?>
