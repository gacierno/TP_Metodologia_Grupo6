<?php 
namespace dao;

interface ICrud{

	function add( $obj );
	function readAll();
	function update( $obj );
	function delete( $id );


}
 ?>
