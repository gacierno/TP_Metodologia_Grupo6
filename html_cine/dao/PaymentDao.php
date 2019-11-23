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

			'purchase_id' => $obj->getPurchaseId(),  // as a payment can't exist without a purchase
			'payment_amount' => $obj->getAmount(),
			'payment_method' => $obj->getMethod(),
			'payment_date' => $obj->getDate(),
			'payment_auth_code' => $obj->getAuthentificationCode(),

			'mp_preference_id' => $obj->getMPPreferenceId(),
			'mp_payment_id' => $obj->getMPPaymentId(),
			'mp_payment_status' => $obj->getMPPaymentStatus(),
			'mp_payment_status_detail' => $obj->getMPPaymentStatusDetail(),
			'mp_merchant_order_id' => $obj->getMPMerchantOrderId(),
			'mp_processing_mode' => $obj->getMPProcessingMode(),
			'mp_merchant_account_id' => $obj->getMPMerchantAccountId()

		);
	}

}
 ?>
