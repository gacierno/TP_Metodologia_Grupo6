<?php 
namespace dao;
/**
 *
 *	NAMESPACE DAO
 *
 */

class GenresOnMoviesDao 
{
	/*
	+------------------------------------------------+
	|											     |
	|	METHODS THAT CONNECT TO DATA BASE     		 |
	|										     	 |
	+------------------------------------------------+
	*/

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





	public static function add( $arr ){

        $options = self::getFields( $arr );

        $query = "insert into Genres_on_Movies". $options;

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








	public static function getGenresByMovieId( $id ){
		$query = "select * from Genres_on_Movies where movie_id = $id;";
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