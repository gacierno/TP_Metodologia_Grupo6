<?php 
namespace dao;
/**
 * 
 */

use dao\ShowDao as ShowDao;
use model\Ticket as Ticket;

class TicketDao
{
	
	/**
	 * parseToObject
	 * @param hashMap
	 * @return Object
	 */

	public function parseToObject( $arr ){

		$d_show = new ShowDao();
		$show = $d_show->getById( $arr['show_id'] );

		$arr['ticket_show'] = $show;

		return new Ticket( $arr );
	}


	public function parseToHash( $obj ){
		return array(

			'ticket_qrCode' => $obj->getQrCode(),
			'show_id' => $obj->getShow()->getId(),

		);
	}



	/*
	 * getTableFields
	 */
	public static function getFields( $arr ){

	    $output = array(
	        'keys'      => array(),
	        'values'    => array()

	    );


	    foreach ($arr as $key => $value ) {
	        array_push( $output['keys'], $key );
	        array_push( $output['values'], ":".$key );
	    }

	    return 
	        " (".
	        preg_replace( "/[ \[ \] \" ]/", "", json_encode( $output['keys'] ) )
	        .") values (".
	        preg_replace( "/[ \[ \] \" ]/", "", json_encode( $output['values'] ) )
	        .")";
	}


	// public static function add( $arr ){

 //        $options = self::getFields( $arr );

 //        $query = "insert into Genres_on_Movies". $options;

 //        try {
 //            $connection = Connection::GetInstance();
 //            $connection->ExecuteNonQuery( $query, $arr );
 //        } catch (PDOException $e) {
 //            throw $e;
 //            return false;
 //        } catch (Exception $e) {
 //            throw $e;
 //            return false;
 //        }

 //        return true;

	// }



	public static function getTicketsByPurchaseId( $id ){
		$query = "select * from Tickets where purchase_id = $id;";
		$output = array();

		try {
		    $connection = Connection::GetInstance();
		    $output = $connection->Execute( $query );
		} catch (PDOException $e) {
		    throw $e;
		    return false;
		} catch (Exception $e) {
		    throw $e;
		    return false;
		}
		return $output;
	}








	public static function getTicketsByShowId( $id ){
		$query = "select * from Tickets where show_id = $id;";
		$output = array();

		try {
		    $connection = Connection::GetInstance();
		    $output = $connection->Execute( $query );
		} catch (PDOException $e) {
		    throw $e;
		    return false;
		} catch (Exception $e) {
		    throw $e;
		    return false;
		}
		return $output;
	}








}
 ?>