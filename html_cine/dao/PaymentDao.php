<?php 
namespace dao;

/**
 * 
 */

use model\Payment as Payment;

use dao\BaseDao as BaseDao;



class PaymentDao extends BaseDao
{
	
	function __construct(){
		parent::setTableName( 'Payments' );
		parent::setSingleType( 'payment' );
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
			'payment_id' => $obj->getId(),
			'payment_auth_code' => $obj->getAuthentificationCode(),
			'payment_date' => $obj->getDate(),
			'payment_amount' => $obj->getAmount(),
			'payment_method' => $obj->getMethod()
		);
	}

}
 ?>