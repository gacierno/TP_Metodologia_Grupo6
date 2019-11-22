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



	/**
	 * parseToObject
	 * @param hashMap
	 * @return Object
	 */

	public function parseToObject( $arr ){
		return new Payment( $arr );
	}

	public function parseToHash( $obj ){
		return array( 
			'payment_auth_code' => $obj->getAuthentificationCode(),
			'payment_date' => $obj->getDate(),
			'payment_amount' => $obj->getAmount(),
			'payment_method' => $obj->getMethod(),
			'purchase_id' => $obj->getPurchaseId()  // as a payment can't exist without a purchase
		);
	}

}
 ?>