<?php

/**
 * 
 */

class App
{
	public
		$uri = null,
		$routes = null,
		$path = null;

	public function __construct()
	{
			
	}

	public function path($path)
	{
		$this->path = $path;
		define('PATH_APP', realpath($this->path));
	}

	public function uri($uri)
	{
		$this->uri = $uri;
	}

	public function routes($routes = array())
	{
		$this->routes = require PATH_APP.'/config/routes.php';
		$this->routes = array_merge($this->routes, $routes);
	}

	public function autoload()
	{
		spl_autoload_register(function ($class)
		{
			include_once 'Controller.php';
			$filepath = str_replace("\\", "/", $class);
			$file = ltrim($filepath, "/").".php";

			if(file_exists('../'.$file))
				include_once '../'.$file;

			else
			{
				if(strpos($file, 'Controller.php'))
					if(file_exists(PATH_APP.'/controllers/'.$file))
						include_once PATH_APP.'/controllers/'.$file;
			}
			
		});
	}

	public function run()
	{
		$this->autoload();

		$router = new \System\Libraries\Router($this->uri);
		$router->actions($this->routes);
		$router->execute();

		// echo "<pre>";
		// print_r($router->routes);
		// echo "</pre>";
		
		exit;
	}

}