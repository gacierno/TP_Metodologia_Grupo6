<?php 
namespace dao;

/**
 * 
 */

use model\Role as Role;

use dao\BaseDao as BaseDao;



class RoleDao extends BaseDao
{
	
	function __construct(){
		parent::setTableName( 'Roles' );
		parent::setSingleType( 'role' );
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
		return new Role( $arr );
	}

	public function parseToHash( $obj ){
		return array(
			'role_description' 	=> $obj->getDescription(),
			'role_name'			=> $obj->getName()
		);
	}

}
 ?>