<?php
namespace dao;

interface IArud{

	function add( $obj );
	function readAll();
	function update( $obj );
	function delete( $id );


}
 ?>
