<?php
namespace dao;

/**
 *
 */

use model\Profile as Profile;

use dao\BaseDao as BaseDao;



class ProfileDao extends BaseDao
{

	function __construct(){
		parent::setTableName( 'Profiles' );
		parent::setSingleType( 'profile' );
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
		return new Profile( $arr );
	}

	public function parseToHash( $obj ){
		return array(
			'profile_apellido' => $obj->getApellido(),
			'profile_dni' =>      $obj->getDni(),
			'profile_nombre' =>   $obj->getNombre()
		);
	}

}
 ?>
