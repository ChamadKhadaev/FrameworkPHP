<?php

	namespace Core;

	use Exception;

	class Router
	{
		private static $routes;
		public static function connect($url, $route)
		{
			self::$routes[$url] = $route;
		}

		/**
		 * @throws Exception
		 */
		public static function get($url)
		{
			if (isset(self::$routes[$url])) {
				return self::$routes[$url];
			}
			else {
				throw new Exception("No route defined for $url");
			}
		}

	}