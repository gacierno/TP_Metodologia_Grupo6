<?php 
	
include_once './controller/testsController.php';

 ?>

 <html>
 	<head>
 		<title></title>
 	</head>
 	<body>

 		<pre><?php print_r( $data->getList() ) ?></pre>

 		<p>test a new movie from class MOVIE</p>
 		<p>ID: <?php $list[0]->getId() ?></p>
 		<p>NOMBRE: <?php $list[0]->getName() ?></p>
 		<img src="<?php echo API_IMAGE_HOST . API_IMAGE_SIZE_LARGE . $list[0]->getImage();?>" alt="">
 	</body>
 </html>