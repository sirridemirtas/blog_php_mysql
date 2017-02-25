<?php

/**
 * 
 */

class Controller
{

	public function validator()
	{
		return new \System\Libraries\Validator();
	}

	public function session()
	{
		return new \System\Libraries\Session();
	}

	public function cookie()
	{
		return new \System\Libraries\Cookie();
	}

	public function loadView($file, $data = false)
	{
		if ($data == true)
			extract($data);
		include_once PATH_APP.'/views/'.$file.'.php';
	}

	public function loadModel($file)
	{	
		include_once 'model.php';
		include_once PATH_APP.'/models/'.$file.'.php';
		return new $file();
	}

	public function error404()
	{
		header('HTTP/1.0 404 Not Found');
		$this->loadView("errors/404");
		exit;
	}

	public function __call($method, $args){}
	public static function __callStatic($method, $args){}
	public function __set($name, $value){}
	public function __get($name){}

}