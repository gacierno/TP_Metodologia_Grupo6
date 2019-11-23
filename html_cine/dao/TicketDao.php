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




	/*
	 * getTableFields
	 */
	public function getFields( $arr ){

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


	public function add( $arr ){

        $options = self::getFields( $arr );

        $query = "insert into Tickets". $options;

        try {
            $connection = Connection::GetInstance();
            $connection->ExecuteNonQuery( $query, $arr );
        } catch (PDOException $e) {
            throw $e;
            return false;
        } catch (Exception $e) {
            throw $e;
            return false;
        }

        return true;

	}



	public function getTicketsByPurchaseId( $id ){
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








	public function getTicketsByShowId( $id ){
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