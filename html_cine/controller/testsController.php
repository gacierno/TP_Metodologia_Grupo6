<?php 

	include_once dirname(__DIR__).'/model/Cinema.php';
	include_once dirname(__DIR__).'/model/Genre.php';
	include_once dirname(__DIR__).'/model/Movie.php';
	// include_once dirname(__DIR__).'/model/Show.php';


	include_once dirname(__DIR__).'/dao/IApiConnector.php';
	include_once dirname(__DIR__).'/dao/BaseDao.php';
	include_once dirname(__DIR__).'/dao/CinemaDao.php';
	include_once dirname(__DIR__).'/dao/MovieDao.php';
	include_once dirname(__DIR__).'/dao/GenreDao.php';

	include_once dirname(__DIR__).'/config/settings.php';

	/*
	 * testGetList
	 * @Params $dao : instance from a DAO class ,
	 *				: instance from a model asociated to this DAO
	 * @return : boolean ( true if the function pass the test )
	 */
	function testGetList( $dao, $obj ){
		if( sizeof( $dao->getList() ) > 0 ){
			return true;
		}else{
			$dao->add( $obj );
			if( sizeof( $dao->getList() ) > 0 ){
				$dao->delete( $obj );
				return true;
			}else{
				return false;
			}
		}
	}

	/*
	 * testGetById
	 * @Params $dao : instance from a DAO class ,
	 *				: instance from a model asociated to this DAO
	 * @return : boolean ( true if the function pass the test )
	 */
	function testGetById( $dao, $obj ){ 
		$dao->add( $obj );
		if( $dao->getById( $obj->getId() ) ){
			$dao->delete( $obj->getId(), $obj );
			return true;
		}else{
			return false;
			$dao->delete( $obj->getId(), $obj );
		}
	}

	/*
	 * testAdd
	 * @Params $dao : instance from a DAO class ,
	 *				: instance from a model asociated to this DAO
	 * @return : boolean ( true if the function pass the test )
	 */
	function testAdd( $dao, $obj ){ 
		$dao->add( $obj );
		if( $dao->getById( $obj->getId() ) ){
			$dao->delete( $obj->getId(), $obj );
			return true;
		}else{
			return false;
		}
	}

	/*
	 * testUpdate
	 * @Params $dao : instance from a DAO class ,
	 *				: instance from a model asociated to this DAO
	 * @return : boolean ( true if the function pass the test )
	 */
	function testUpdate( $dao, $obj ){ 
		$dao->add( $obj );
		if( $dao->getById( $obj->getId() ) ){
			$obj->setName('passed');
			$dao->update( $obj->getId(), $obj );
			$test = $dao->getById( $obj->getId() );
			if( $test->getName() == 'passed' ){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	/*
	 * testDelete
	 * @Params $dao : instance from a DAO class ,
	 *				: instance from a model asociated to this DAO
	 * @return : boolean ( true if the function pass the test )
	 */
	function testDelete( $dao, $obj ){ 
		$dao->add( $obj );
		if( $dao->getById( $obj->getId() ) ){
			$dao->delete( $obj->getId(), $obj );
			if( !$dao->getById( $obj->getId() ) ){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}




	/*
	 *	hardcoded cinema to perform tests
	 */
	$cinemaForTest = new model\Cinema( "Test Cinema","Test Address",-1,-1,-1 );
	/*
	 * Instance CinemaDao for testing
	 */
	$cinemaDao = new dao\CinemaDao();





	$data = new dao\MovieDao();

	$data->fetch();

	$list = $data->getList();





 ?>