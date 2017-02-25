<?php

/**
 * 
 */

namespace System\Libraries;

class Router
{
	public $uri;
	
	public $routes = array();

	public $patterns = array(
			'{string}'	=> '([^\/]+)',
			'{int}'		=> '([0-9]+)',
			'{any}'		=> '(.+)',
		);

	public $seperator = '@';

	protected $file_404 = '../app/views/errors/404.php';

	public function __construct($uri = null)
	{
		$this->uri = (is_null($uri) ? rtrim($_SERVER['QUERY_STRING'], '/') : $uri);
	}

	public function actions($routes = array())
	{
		foreach ($routes as $key => $value)
				$this->route($key, $value);
	}
	
	public function route($pattern, $call)
	{
		$this->routes[$pattern] = $call;
	}
	
	public function execute()
	{
		foreach ($this->routes as $pattern => $call){
			$pattern = '!^'.str_replace(array_keys($this->patterns), array_values($this->patterns), $pattern).'\/?$!';
			if (preg_match($pattern, $this->uri, $params)){
				array_shift($params);
				if (is_array($call)) {
					$type = $call['type'];
					$call1 = $call['use'];

					$type2 = array_key_exists('type2', $call) ? $call['type2'] : NULL;
					$call2 = array_key_exists('use2', $call) ? $call['use2'] : NULL;
					if ($_SERVER['REQUEST_METHOD'] == strtoupper($type2)){
						$call1 = $call2;
						$type = $type2;
					}

					$type3 = array_key_exists('type3', $call) ? $call['type3'] : NULL;
					$call3 = array_key_exists('use3', $call) ? $call['use3'] : NULL;
					if ($_SERVER['REQUEST_METHOD'] == strtoupper($type3)){
						$call1 = $call3;
						$type = $type3;
					}
				}
				else $call1 = $call;

				if ($_SERVER['REQUEST_METHOD'] == strtoupper(isset($type) ? $type : 'get')){
					if (is_callable($call1))
						return call_user_func_array($call1, array_values($params));
					else{
						$seg = explode($this->seperator, $call1);
						$class = new $seg[0]();
						return call_user_func_array(array($class, $seg[1]), array_values($params));
					}
				}
			}
		}
		$this->E404();
	}

	public function E404()
	{
		header('HTTP/1.0 404 Not Found');
		if (is_null($this->file_404))
			exit("<h1>404 Not Found</h1>");
		else
			include_once($this->file_404);
		exit;
	}

	public function __call($call, $args)
	{
		if ($_SERVER['REQUEST_METHOD'] == strtoupper($call))
			$this->actions(array($args[0] => $args[1]));
	}

}