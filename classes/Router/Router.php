<?php

namespace Classes\Router;

use Exception;

require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'Core/autoload.php';


class Router
{
	private string $url;
	private array $routes = [];
	private array $namedRoutes = [];
	
	
	public function __construct($url)
	{
		$this->url = $url;
	}
	
	public function get($path, $callable, $name = null)
	{
		return $this->add($path, $callable, $name, 'GET');
	}
	
	public function post($path, $callable, $name = null)
	{
		return $this->add($path, $callable, $name, 'POST');
	}
	
	private function add($path, $callable, $name, $method)
	{
		$route = new Route($path, $callable);
		$this->routes[$method][] = $route;
		if(is_string($callable) && $name === null)
		{
			$name = $callable;
		}
		if($name) {
			$this->namedRoutes[$name] = $route;
		}
		return $route;
		
	}
	
	
	/**
	 * @throws \Exception
	 */
	public function run()
	{
		if(!isset($this->routes[$_SERVER['REQUEST_METHOD']]))
		{
			throw new RouterException('Request method does not exist');
		}
		foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route)
		{
			if($route->match($this->url))
			{
				return $route->call();
			}
		}
		throw new RouterException('No routes matched');
	}
	
	/**
	 * @throws \Classes\Router\RouterException
	 */
	public function url($name, $params = [])
	{
		if(!isset($this->namedRoutes[$name]))
		{
			throw new RouterException('No route matches this name');
		}
		return $this->namedRoutes[$name]->getUrl($params);
	}
	
}