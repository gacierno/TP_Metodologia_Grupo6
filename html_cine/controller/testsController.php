<?php 

	include_once dirname(__DIR__).'/model/Cinema.php';
	include_once dirname(__DIR__).'/model/Genre.php';
	include_once dirname(__DIR__).'/model/Movie.php';
	// include_once dirname(__DIR__).'/model/Show.php';
	include_once dirname(__DIR__).'/model/Role.php';
	include_once dirname(__DIR__).'/model/Profile.php';
	include_once dirname(__DIR__).'/model/User.php';


	include_once dirname(__DIR__).'/dao/IApiConnector.php';
	include_once dirname(__DIR__).'/dao/BaseDao.php';
	include_once dirname(__DIR__).'/dao/CinemaDao.php';
	include_once dirname(__DIR__).'/dao/MovieDao.php';
	include_once dirname(__DIR__).'/dao/GenreDao.php';

	include_once dirname(__DIR__).'/dao/Connection.php';
	include_once dirname(__DIR__).'/dao/QueryType.php';

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
	 *	hardcoded rol to perform tests
	 */
	$testRole = new model\Role(
		array(
			'id' => -1,
			'name' => 'test rol name',
			'description' => 'test rol description'
		)
	);

	/*
	 *	hardcoded profile to perform tests
	 */
	$testProfile = new model\Profile(
		array(
			'id' => -1,
			'name' => 'test profile name',
			'apellido' => 'test profile apellido',
			'dni' => 'test profile dni'
		)
	);

	/*
	 *	hardcoded user to perform tests
	 */
	$testUser = new model\User(
		array(
			'id' => -1,
			'email' => 'test user name',
			'pass' => 'test user apellido',
			'role' => $testRole,
			'profile' => $testProfile
		)
	);


	/*
	 *	hardcoded cinema to perform tests
	 */
	$testCine = new model\Cinema(array (
		'id' => -1,
		'name' => 'some name',
		'address' => 'address test',
		'capacity' => 3,
		'ticketValue' => 100,
	));
	/*
	 * Instance CinemaDao for testing
	 */
	$cinemaDao = new dao\CinemaDao();





	// $data = new dao\MovieDao();

	// $data->fetch();

	// $list = $data->getList();

	// $query = "INSERT INTO ". "Genres" ." ( id_genre, genre_name ) VALUES (:id, :name )";

	// $parameters["id"] =  15;
	// $parameters["name"] = "peperino";

	// $connection->ExecuteNonQuery($query, $parameters);
          
	// $query = "create database moviepass;";
         
 //    $query = "select * from ". "Genres";

	// $connection = dao\Connection::GetInstance();

	// $fafa = $connection->Execute($query, $parameters);



	// $connection = new PDO("mysql:host=localhost;dbname=moviepass", 'root', 'examplepass');

	// $connection->ExecuteNonQuery($query, $parameters);

	// $servername = "mysql_db";
	// $username = "root";
	// $password = "examplepass";

	// // Create connection
	// $conn = mysqli_connect($servername, $username, $password);

	// Check connection

	


 ?>