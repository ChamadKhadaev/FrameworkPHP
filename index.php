<?php
	
	use Classes\Router\Router;
	use Core\Controller;
	
	require_once 'Core/autoload.php';
	
	
	$router = new Router($_GET['url']);
	
	/*
	 * Redirection routes, by AppController; + (methods)
	 */
	$router->get('/', 'App#indexAction');
	$router->get('/home',  'App#homepage');
	$router->get('/login', 'User#login');
	$router->get('/register', 'App#register');
	$router->get('/id', 'App#getId')->with('id', '[0-9]+');
	$router->get('/getid', 'User#getId')->with('id', '[0-9]+');
	$router->get('/id/:id', function ($id){
		echo "Your id is : $id";
	})->with('id', '[0-9]+');
	
	/*
	 *Action routes by UserController; + (methods)
	 */
	//Create user, register & redirect to his /profile
	$router->post('/create', 'User#create');
	//Login user, redirect to his /profile
	$router->post('/loginUser', 'User#loginUser');
	
	$router->get("/profile/:username", function ($username){
		echo "Welcome to your profile $username";
		
		
	})->with('username', '([a-z\-0-9]+)');
	
	
	//$router->get('/app/:slug-:id/:page', 'App#show')->with('id', '[0-9]+')->with('page', '([a-z\-0-9]+)');
	//$router->post('/article/:slug-:id', 'App#show')->with('id', '[0-9]+')->with('slug', '([a-z\-0-9]+)');
	
	
	//$router->get('/app/:id', "App#show");
	
	//$router->get('/app/:id','App#show')->with('id', '[0-9]+');
	
	$router->run();

?>

<pre>
	<?= print_r($_GET); print_r($_POST); print_r($_SERVER)?>
</pre>



