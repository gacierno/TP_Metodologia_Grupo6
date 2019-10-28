<?php
namespace dao;
/**
 *
 *	NAMESPACE DAO
 *
 */

use dao\BaseDao  as BaseDao;
use model\User as User;

class UserDao extends BaseDao
{

	function __construct(){
		parent::setTableName( 'Users' );
		parent::setSingleType( 'user' );
	}

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
		return new User($arr);
	}

	public function parseToHash( $obj ){
		return array(
			'id' 		=> $obj->getId(),
			'email' 	=> $obj->getEmail(),
			'pass' 		=> $obj->getPass(),
			'role'		=> $obj->getRole(),
			'profile' 	=> $obj->getProfile()
		);
	}

}


 ?>

