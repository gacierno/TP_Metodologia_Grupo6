<?php 
	
include_once './controller/testsController.php';
include_once './views/header.php';

 ?>
 	<div class="container">
		<section class="test_dao">

			<h3>Performing Test for: CinemaDao (Class)</h3>
			<ul>
				<li style="color:#FFF;">
					<span class="test-name">CinemaDao :: getList().........</span>
					<spant class="test-result"><?php //echo ( testGetList( $cinemaDao,$cinemaForTest ) )?'PASS':'FAIL'; ?></spant>
				</li>
				<li style="color:#FFF;">
					<span class="test-name">CinemaDao :: getById().........</span>
					<spant class="test-result"><?php //echo ( testGetById( $cinemaDao,$cinemaForTest ) )?'PASS':'FAIL'; ?></spant>
				</li>
			</ul>

	<pre style="color: white"><?php // print_r($options) ?></pre>
	<pre style="color: white"><?php // print_r( $testGenreDao->getById( 18 ) ) ?></pre>
	<pre style="color: white"><?php // echo $testGenreDao->getFields( $testGenre ) ?></pre>
	<pre style="color: white"><?php // print_r( $testMovie ) ?></pre>
	<pre style="color: white"><?php // print_r( $testMovieDao->parseToHash( $testMovie ) ) ?></pre>
	<pre style="color: white"><?php //  echo $testMovieDao->getFields( $testMovie ) ?></pre>
	<pre style="color: white"><?php // print_r( $testMovieDao->getList() ) ?></pre>
	<pre style="color: white"><?php // print_r( $testGenreDao->getList() ) ?></pre>
	<pre style="color: white"><?php // print_r( $testCinemaDao->getList() ) ?></pre>
	<pre style="color: white"><?php // print_r( dao\GenresOnMoviesDao::getGenresByMovieId( 338967 ) ) ?></pre>
	<pre style="color: white"><?php // print_r( $testShow ) ?></pre>
	<pre style="color: white"><?php  print_r( $testShowDao->getList() ) ?></pre>
	
	
		</section>
 	</div>
	


<?php include_once './views/footer.php'; ?>


