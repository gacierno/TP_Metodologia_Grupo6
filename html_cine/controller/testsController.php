<?php 

	include_once dirname(__DIR__).'/model/Cinema.php';
	include_once dirname(__DIR__).'/model/Genre.php';
	include_once dirname(__DIR__).'/model/Movie.php';
	include_once dirname(__DIR__).'/model/Show.php';
	include_once dirname(__DIR__).'/model/Role.php';
	include_once dirname(__DIR__).'/model/Profile.php';
	include_once dirname(__DIR__).'/model/User.php';


	include_once dirname(__DIR__).'/dao/IApiConnector.php';
	include_once dirname(__DIR__).'/dao/BaseDao.php';
	include_once dirname(__DIR__).'/dao/CinemaDao.php';
	include_once dirname(__DIR__).'/dao/MovieDao.php';
	include_once dirname(__DIR__).'/dao/GenreDao.php';
	include_once dirname(__DIR__).'/dao/UserDao.php';
	include_once dirname(__DIR__).'/dao/GenresOnMoviesDao.php';
	include_once dirname(__DIR__).'/dao/ShowDao.php';
	include_once dirname(__DIR__).'/dao/RoleDao.php';
	include_once dirname(__DIR__).'/dao/ProfileDao.php';

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
	 *	hardcoded cinema to perform tests
	 */
	// $testCine = new model\Cinema(array (
	// 	'cinema_id' => 2,
	// 	'cinema_name' => 'El rulo',
	// 	'cinema_address' => 'address test',
	// 	'cinema_capacity' => 3,
	// 	'cinema_ticketValue' => 100,
	// ));

	/*
	 * Instance CinemaDao for testing
	 */
	// $testCinemaDao = new dao\CinemaDao();
	// // $testCinemaDao->add( $testCine );
	// $listCinema = $testCinemaDao->getList();

	/*
	 * Instance CinemaDao for testing
	//  */
	// $testGenreDao = new dao\GenreDao();
	// $listGenre = $testGenreDao->getList();


	// $testGenre = new model\Genre( array( 'genre_id' => 0, 'genre_name' => 'genrename') );

	// $_POST['result'] = $testGenreDao->getById( 12 );
	// $_POST['result'] = $testGenreDao->add( $testGenre );
	// $testGenreDao->fetch();
	// $options = $testGenreDao->getInsertQueryParams( $testGenre );

	/*
	 * Instance CinemaDao for testing
	 */
	// $testMovieDao = new dao\MovieDao();
	// $listMovie = $testMovieDao->getList();

	// $testMovie = new model\Movie(
	// 	array(
	// 		'movie_title' => 'movie_title',
	// 		'movie_runtime' => 60,
	// 		'movie_language' => 'movie_language',
	// 		'movie_image' => 'movie_image',
	// 		'movie_id' => 0
	// 	)
	// );
	// $testMovieDao->fetch();
	// $testMovieDao->add( $testMovie );




	// $testShowDao = new dao\ShowDao();
	// $testShow = new model\Show(
	// 	array(
	// 		'show_id' => 0,
	// 		'show_time' => '18:00:00',		// HH:MM:SS
	// 		'show_date' => '2019-10-20',	// YYYY-MM-DD
	// 		'show_movie' => $testMovie,
	// 		'show_cinema' => $testCine
	// 	)
	// );

	// $testShowDao->add( $testShow );

	// $testRoleDao = new dao\RoleDao();
	/*
	 *	hardcoded rol to perform tests
	 */
	// $testRole = new model\Role(
	// 	array(
	// 		'role_id' => 1,
	// 		'role_description' => 'test rol description',
	// 		'role_name' => 'test rol name'
	// 	)
	// );

	// $testRoleDao->add( $testRole );

	// $testProfileDao = new dao\ProfileDao();
	/*
	 *	hardcoded profile to perform tests
	 */
	// $testProfile = new model\Profile(
	// 	array(
	// 		'profile_apellido' => 'test profile apell',
	// 		'profile_dni' => '1234567890',
	// 		'profile_id' => 1,
	// 		'profile_nombre' => 'test profile n'
	// 	)
	// );
	// $testProfileDao->add( $testProfile );


	/*
	 *	hardcoded user to perform tests
	 */
	// $testUser = new model\User(
	// 	array(
	// 		'user_email' => 'test maill',
	// 		'user_password' => 'test user ape',
	// 		'user_role' => $testRole,
	// 		'user_profile' => $testProfile
	// 	)
	// );

	/*
	 * Instance UserDao for testing
	 */
	// $testUserDao = new dao\UserDao();
	// //testeo add
	// $testUserDao->add( $testUser );


	// $fafa = new model\Profile(
	// 	array(
	// 		'profile_apellido' => 'modificado ape',
	// 		'profile_dni' => '55',
	// 		'profile_id' => 1,
	// 		'profile_nombre' => 'modifica na'
	// 	)
	// );

	// $testProfileDao->update( 1, $fafa );

	// $testCinemaDao->delete( 2 );

	// $dada = $testCinemaDao->getById( 2 );

	// $dada->setAvailability( 1 );

	// $testCinemaDao->update( 2, $dada );



	// $sucutrule = $testMovieDao->getList( $args );



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

	


	// $genDao = new dao\GenreDao();

	// $fafa = $genDao->getById(15);

	$newTest = new dao\MovieDao();

	$movieArgs = array(
		'cinema' => 2,
		'date' => '2019-10-20',
		'genres' => array(18, 16, 12, 99, 767)
	)



 ?>