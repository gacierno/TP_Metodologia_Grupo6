<?php
namespace dao;
/**
 *
 *	NAMESPACE DAO
 *
 */

use model\CinemaRoom as CinemaRoom;
use model\Cinema as Cinema;
use dao\BaseDao  as BaseDao;
use dao\CinemaDao as CinameDao;

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

		$d_cinema = new CinemaDao();
		$cinema = $d_cinema->getById( $arr['cinema_id'] );

		$arr['cinemaroom_cinema'] = $cinema;
		return new CinemaRoom( $arr );
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
