<?php

	namespace Core;

	require_once 'autoload.php';

	class Controller
	{
		
		public $_render;
		
		/*public function __construct()
		{
			$this->request = new Request();
		}*/
		
		public function __destruct()
		{
			echo $this->_render;
		}
		
		
		protected function render($view, $scope = []): void
		{
			extract ($scope);
			$f =implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View',
					str_replace('Controller', '', basename(get_class($this))), $view]) . '.php';
			if (file_exists($f))
			{
				ob_start();
				include($f);
				$view = ob_get_clean();
				ob_start();
				include(implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', 'index']) . '.php');
				$this->_render=ob_get_clean();
			}
		}

	}
