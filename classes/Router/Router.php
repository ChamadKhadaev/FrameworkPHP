<?php

namespace Classes\Router;

use Exception;

require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'Core/autoload.php';


class Router
{
	private $url;
	private $routes = [];
	
	public function __construct($url)
	{
		$this->url = $url;
	}
	
	public function get($path, $callable)
	{
		$route = new Route($path, $callable);
		$this->routes['GET'][] = $route;
		return $route;
	}
	
	public function post($path, $callable)
	{
		$route = new Route($path, $callable);
		$this->routes['POST'][] = $route;
	}
	
	/**
	 * @throws \Exception
	 */
	public function run()
	{
		if(!isset($this->routes[$_SERVER['REQUEST_METHOD']]))
		{
			echo "No method does exist";
			throw new Exception('Request method does not exist');
		}
		foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route)
		{
			if($route->match($this->url))
			{
				return $route->call();
			}
		}
		throw new Exception('No routes matched');
	}
	
	
	

}