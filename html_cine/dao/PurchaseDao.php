<?php
namespace dao;
/**
 * 
 */

use dao\BaseDao as BaseDao;
use dao\UserDao as UserDao;
use dao\PaymentDao as PaymentDao;

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

		//	set purchase user
		$d_duser = new UserDao();
		$user = $d_duser->getById( $arr['user_id'] );
		$arr['purchase_user'] = $user;

		//	set purchase payment
		$d_payment = new PaymentDao();
		$payment = $d_payment->getList(
			array(
				'purchase_id' => $arr['purchase_id']
			)
		)
		$arr['purchase_payment'] = ($payment) ? $payment[0] : null;

		//	set purchased tickets


		return new Purchase( $arr );
	}

	public function parseToHash( $obj ){
		return array(

			'user_id' => $obj->getUser()->getId(),
			'purchase_date' => $obj->getDate(),
			'purchase_amount' => $obj->getAmount(),
			'purchase_discount' => $obj->getDiscount(),
			'purchase_total' => $obj->getPayment()
			

		);
	}






}
 ?>