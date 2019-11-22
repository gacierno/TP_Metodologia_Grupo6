<?php
namespace dao;
/**
 * 
 */

use dao\BaseDao as BaseDao;
use dao\UserDao as UserDao;
use model\Purchase as Purchase;

class PurchaseDao extends BaseDao
{
	
	function __construct(argument){
		parent::setTableName( 'Purchases' );
		parent::setSingleType( 'purchase' );
	}

	/**
	 * parseToObject
	 * @param hashMap
	 * @return Object
	 */

	public function parseToObject( $arr ){

		$d_duser = new UserDao();
		$user = $d_duser->getById( $arr['user_id'] );
		$arr['purchase_user'] = $user;

		return new Purchase( $arr );
	}

	public function parseToHash( $obj ){
		return array(

			/*
			purchase_id <PK>
			user_id <FK>
			purchase_date
			purchase_amount
			purchase_discount
			purchase_total*/


			'user_id' => $obj->getUser()->getId(),
			'purchase_date' => $obj->getDate(),
			'purchase_amount' => $obj->getAmount(),
			'purchase_discount' => $obj->getDiscount(),
			'purchase_total' => $obj->getPayment()
			

		);
	}






}
 ?>