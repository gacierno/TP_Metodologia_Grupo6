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

			'purchase_id' => $obj->getPurchaseId(),
			'payment_auth_code' => $obj->getAuthentificationCode(),
			'payment_date' => $obj->getDate(),
			'payment_amount' => $obj->getAmount(),
			'payment_method' => $obj->getMethod(),

			'mp_preference_id' => (string)$obj->getMPPreferenceId(),
			'mp_payment_id' => (string)$obj->getMPPaymentId(),
			'mp_payment_status' => (string)$obj->getMPPaymentStatus(),
			'mp_payment_status_detail' => (string)$obj->getMPPaymentStatusDetail(),
			'mp_merchant_order_id' => (string)$obj->getMPMerchantOrderId(),
			'mp_processing_mode' => (string)$obj->getMPProcessingMode(),
			'mp_merchant_account_id' => (string)$obj->getMPMerchantAccountId()

		);
	}

}
 ?>
