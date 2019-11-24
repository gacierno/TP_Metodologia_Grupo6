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
		$tickets = $this->d_tickets->getTicketsByPurchaseId($arr['purchase_id']);

		$arr['purchase_tickets'] = array_map( array( $this->d_tickets, 'parseToObject' ), $tickets );


		return new Purchase( $arr );

	}








	public function parseToHash( $obj ){

		return array(

			'user_id' 			=> $obj->getUser()->getId(),
			'purchase_date' 	=> $obj->getDate(),
			'purchase_amount' 	=> $obj->getAmount(),
			'purchase_discount' => $obj->getDiscount(),
			'purchase_total' 	=> $obj->getAmount() - $obj->getDiscount()

		);
	}

	public function add( $obj ){

		$connection = Connection::GetInstance();
		$output = false;

		// guarda la compra sin los objetos pero me deja acceder al id de dicha compra en la base de datos

		if( parent::add( $obj ) ){
			$purchaseId = $connection->getLastId();
			$obj->setId( $purchaseId );

			//	guarda el payment
			$newPayment = $obj->getPayment();
			$newPayment->setPurchaseId( $purchaseId );

			if($this->d_payment->add( $newPayment ) ){
				// guarda los tickets (de a uno?)
				foreach( $obj->getTickets() as $singleTicket ){

					$toAdd = array(
						'show_id' => $singleTicket->getShow()->getId(),
						'purchase_id' => $obj->getId(),
						'ticket_code' => $singleTicket->getCode()
					);

					$this->d_tickets->add( $toAdd );
				}
				$output = true;
			}
		}

		return $output;

	}



}
 ?>
