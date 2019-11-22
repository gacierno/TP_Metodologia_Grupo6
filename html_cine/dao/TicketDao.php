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


	public function parseToHash( $obj ){
		return array(

			/*
				FALT DEFINIR SI LE PASAMOS UN ID DE REFERENCIA AL OBJETO TICKET
				O SI LE PONEMOS UN PARAMETRO A LA FUNCION PARA SABER QUE ID DE PURCHASE LE CORRESPONDE AL TICKET
			*/

			'ticket_qrCode' => $obj->getQrCode(),
			'show_id' => $obj->getShow()->getId(),

		);
	}


}
 ?>