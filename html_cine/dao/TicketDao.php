<?php 
namespace dao;
/**
 * 
 */

use dao\BaseDao as BaseDao;
use model\Ticket as Ticket;

class TicketDao extends BaseDao
{
	
	function __construct(argument)
	{
		parent::setTableName( 'Tickets' );
		parent::setSingleType( 'ticket' );
	}


	/**
	 * parseToObject
	 * @param hashMap
	 * @return Object
	 */

	public function parseToObject( $arr ){
		return new Ticket( $arr );
	}


	public function parseToHash( $obj, $relational = array() ){
		return array(

			'purchase_id' => $relational['purchase_id'],
			'ticket_qrCode' => $obj->getQrCode(),
			'show_id' => $obj->getShow()->getId(),

		);
	}


}
 ?>