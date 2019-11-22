<?php
namespace dao;
/**
 * 
 */

use dao\BaseDao as BaseDao;
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
		return new Purchase( $arr );
	}

	public function parseToHash( $obj ){
		return array(

			'purchase_ticket_qty' => $obj->getTicketQty(),
			'purchase_discount' => $obj->getDiscount(),
			'purchase_date' => $obj->getDate(),
			'purchase_amount' => $obj->getAmount(),

			//tickets is an array
			'purchase_tickets' => $obj->getTickets(),  

			'purchase_user' => $obj->getUser(),
			'purchase_payment' => $obj->getPayment()
			

		);
	}






}
 ?>