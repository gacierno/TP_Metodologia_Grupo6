<?php 
namespace dao;
/**
 * 
 */

use dao\BaseDao as BaseDao;
use model\Ticket as Ticket;

class ClassName extends BaseDao
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


	public function parseToHash( $obj ){
		return array(

			'ticket_qrCode' => $obj->getQrCode(),
			'ticket_show' => $obj->getShow()

		);
	}


}
 ?>