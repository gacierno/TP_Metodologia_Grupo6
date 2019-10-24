<?php
namespace dao;
/**
 *
 *	NAMESPACE DAO
 *
 */

use dao\BaseDao  as BaseDao;

class UserDao extends BaseDao
{

	function __construct(){
		parent::setItemType( 'user' );
	}

}


 ?>
