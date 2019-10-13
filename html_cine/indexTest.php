<?php 
	
include_once './controller/testsController.php';

 ?>

 <html>
 	<head>
 		<title></title>
 	</head>
 	<body>

 		<h3>test a new movie from class MOVIE</h3>
 		<p>ID: <?php echo $list[0]->getId() ?></p>
 		<p>NOMBRE: <?php echo $list[0]->getName() ?></p>
 		<img src="<?php echo API_IMAGE_HOST . API_IMAGE_SIZE_LARGE . $list[0]->getImage();?>" alt="">

 		<h3>test a cinema</h3>
 		<pre><?php print_r($cinemas) ?></pre>
 		<p>ID: <?php echo $cinemas[0]->getId() ?></p>
 		<p>NOMBRE: <?php echo $cinemas[0]->getName() ?></p>


 	</body>
 </html>