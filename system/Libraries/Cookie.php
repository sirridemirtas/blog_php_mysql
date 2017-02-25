<?php

/**
 * 
 */

namespace System\Libraries;

class Cookie
{
	protected $settings = array();

	public function __construct($settings = array())
	{
		$defaults = array(
			'expires' 	=> 0, 
			'path' 		=> '/',
			'domain' 	=> null,
			'secure' 	=> false,
			'httpOnly' 	=> true,
			);
		$this->settings = array_merge($defaults, $settings);
	}

	public function set($name, $value = "", $expire = null, $path = null)
	{
		return
			setcookie(
				$name, 
				$value, 
				$expire != null ? $expire : $this->settings["expires"], 
				$path != null ? $path : $this->settings["path"], 
				$this->settings["domain"], 
				$this->settings["secure"], 
				$this->settings["httpOnly"]
			);
	}

	public function get($name)
	{
		return isset($_COOKIE[$name]) ? $_COOKIE[$name] : false;
	}

	public function remove($name='')
	{
		return setcookie($name, null, time()-3600) ? true : false;
	}

	public function isExpired($name='')
	{
		return isset($_COOKIE[$name]) ? true : false;
	}

	public function getAll()
	{
		return $_COOKIE;
	}

	public function __call($call, $args)
	{
		if($call == "update")
			call_user_func_array(array($this, "set"), $args);
	}

}