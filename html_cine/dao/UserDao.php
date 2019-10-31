<?php
namespace dao;
/**
 *
 *	NAMESPACE DAO
 *
 */

use dao\BaseDao  as BaseDao;
use dao\ProfileDao as ProfileDao;
use dao\RoleDao as RoleDao;
use dao\Connection as Conection;

use model\User as User;

class UserDao extends BaseDao
{

	function __construct(){
		parent::setTableName( 'Users' );
		parent::setSingleType( 'user' );
	}


	/**
	 * parseToObject
	 * @param hashMap
	 * @return Object
	 */

	public function parseToObject( $arr ){

		$p_dao = new ProfileDao();
		$new_profile = $p_dao->getById( $arr['profile_id'] );

		$r_dao = new RoleDao();
		$new_role = $r_dao->getById( $arr['role_id'] );

		$arr['user_role'] = $new_role;
		$arr['user_profile'] = $new_profile;

		return new User($arr);
	}



	public function parseToHash( $obj ){
		return array(
			'user_email' 	=> $obj->getEmail(),
			'user_password' => $obj->getPass(),
			'role_id'		=> ( $obj->getRole() )->getId(),
			'profile_id' 	=> ( $obj->getProfile() )->getId()
		);
	}



	public function add( $obj ){
		$connection = Connection::GetInstance();

		$profileDAO = new ProfileDao();
		$profileDAO->add($obj->getProfile());

		$id = $connection->getLastId();

		$obj->setProfile( $profileDAO->getById( $id ) );

		parent::add($obj);
	}
}


 ?>
