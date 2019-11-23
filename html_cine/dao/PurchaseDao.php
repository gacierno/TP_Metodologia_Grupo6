<?php
namespace dao;
/**
 *
 */

use dao\BaseDao as BaseDao;
use dao\UserDao as UserDao;
use dao\PaymentDao as PaymentDao;
use dao\TicketDao as TicketDao;

use model\Purchase as Purchase;

class PurchaseDao extends BaseDao
{


	private $d_user;
	private $d_payment;
	private $d_tickets;





	function __construct(){

		parent::setTableName( 'Purchases' );
		parent::setSingleType( 'purchase' );

		$this->d_user = new UserDao();
		$this->d_payment = new PaymentDao();
		$this->d_tickets = new TicketDao();


	}





	/**
	 * parseToObject
	 * @param hashMap
	 * @return Object
	 */

	public function parseToObject( $arr ){

		//	set purchase user
		$user = $this->d_user->getById( $arr['user_id'] );
		$arr['purchase_user'] = $user;

		//	set purchase payment
		$payment = $this->d_payment->getList(
			array(
				'purchase_id' => $arr['purchase_id']
			)
		);
		$arr['purchase_payment'] = ($payment) ? $payment[0] : null;

		//	set purchased tickets
		$tickets = $this->d_tickets->getTicketsByPruchaseId($arr['purchase_id']);

		$arr['purchase_tickets'] = array_map( array( $d_tickets, 'parseToObject' ), $tickets );


		return new Purchase( $arr );

	}








	public function parseToHash( $obj ){

		//	guarda el payment
		$this->d_payment->add( $obj->getPayment() );

		// guarda los tickets (de a uno?)
		foreach( $obj->getTickets() as $singleTicket ){
			$this->d_tickets->add( $singleTicket );
		}

		return array(

			'user_id' 			=> $obj->getUser()->getId(),
			'purchase_date' 	=> $obj->getDate(),
			'purchase_amount' 	=> $obj->getAmount(),
			'purchase_discount' => $obj->getDiscount(),
			'purchase_totat' 	=> $obj->getAmount() - $obj->getDiscount()

		);
	}





}
 ?>
