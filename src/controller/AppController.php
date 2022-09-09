<?php
	namespace App\Controller;
	
	require_once $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR . 'Core/autoload.php';
	
	use Core\Controller;
	use Classes\Router\Router;

	
class AppController extends Controller
{
	public function getid(){
		header('Location: /new.php');
	}
	public function homepage()
	{
		header('Location: /front.php');
	}
	
	public function register()
	{
		header('Location: src/View/User/register.php');
	}
	
	public static function show($slug, $id, $page)
	{
		echo "$slug from id:$id, show from src/controller/AppController.php\n
		page is $page";
	}
}