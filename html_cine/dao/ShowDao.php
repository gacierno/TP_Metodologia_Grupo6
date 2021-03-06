<?php

/*
FEATURE REQUEST FROM GASPAR:
Un metodo que reciba un rango de fechas (principio y fin) y un id de show.
Que devuelva un listado de shows que se transmitan en ese rango de fechas.
EXCLUYENDO cualquier show que tenga el id show que se pasa por parametro.

*/
namespace dao;
/**
 *
 *	NAMESPACE DAO
 *
 */

use model\Show as Show;
use dao\BaseDao  as BaseDao;
use dao\MovieDao as MovieDao;
use dao\CinemaRoomDao as CinemaRoomDao;

class ShowDao extends BaseDao
{

	function __construct(){
		parent::setTableName( 'Shows' );
		parent::setSingleType( 'show' );
	}

	/**
	 * parseToObject
	 * @param hashMap
	 * @return Object
	 */

	public function parseToObject( $arr ){

		$m_dao = new MovieDao();
		$new_movie = $m_dao->getById( $arr['movie_id'] );

		$c_dao = new CinemaRoomDao();
		$new_cinemaroom = $c_dao->getById( $arr['cinemaroom_id'] );

		$arr['show_movie'] = $new_movie;
		$arr['show_cinemaroom'] = $new_cinemaroom;

		$show = new Show($arr);
		return $show;
	}

	/**
	 * parseToHash
	 * @param object
	 */

	// this hash is set only to save data on database

	public function parseToHash( $obj ){
		return array(
      'show_id' => $obj->getId(),
			'show_time' => $obj->getTime(),
      'show_end_time' => $obj->getEndTime(),
			'show_date' => $obj->getDay(),
      'movie_id' => $obj->getMovie()->getId(),
      'cinemaroom_id' => $obj->getCinemaRoom()->getId(),
      'show_available' => $obj->getAvailability()
		);
	}




}
 ?>
