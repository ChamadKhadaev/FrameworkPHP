<?php
	
	use Classes\Router\Router;
	
	require_once 'Core/autoload.php';
	
	$router = new Router($_GET['url']);
	$router->get('/app', function(){ echo "Bienvenue sur ma homepage !"; });
	$router->get('/app/:id', function($id){ echo "Voila l'article" . $id; });
	$router->run();

?>

<pre>
	<?= print_r($_POST); print_r($_GET); print_r($_SERVER); ?>
</pre>

