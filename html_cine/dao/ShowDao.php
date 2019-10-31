<?php
namespace dao;
/**
 *
 *	NAMESPACE DAO
 *
 */

use model\Show as Show;
use dao\BaseDao  as BaseDao;
use dao\MovieDao as MovieDao;

class ShowDao extends BaseDao
{

	function __construct(){
		parent::setTableName( 'Shows' );
		parent::setSingleType( 'show' );
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

		$m_dao = new MovieDao();
		$new_movie = $m_dao->getById( $arr['movie_id'] );

		$c_dao = new CinemaDao();
		$new_cinema = $c_dao->getById( $arr['cinema_id'] );

		$arr['show_movie'] = $new_movie;
		$arr['show_cinema'] = $new_cinema;

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
			'show_time' => $obj->getTime(),
			'show_date' => $obj->getDay(),
			'movie_id' => $obj->getMovie()->getId(),
			'cinema_id' => $obj->getCinema()->getId(),
			'show_available' => $obj->getAbailability()
		);
	}




}
 ?>
