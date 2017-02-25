<?php

/**
 * 
 */

namespace System\Libraries;

class Session
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
			'name' 		=> 'srr_session',
			);
		$this->settings = array_merge($defaults, $settings);

		ini_set('session.name', $this->settings['name']);
		//ini_set('session.save_path',realpath(PATH_APP.'/storage/sessions'));

		session_start();
		session_regenerate_id();
	}

	public function set($name, $value)
	{
		$_SESSION[$name] = $value;
	}

	public function get($name)
	{
		return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
	}

	public function remove($name)
	{
		unset($_SESSION[$name]);
	}

	public function check($name)
	{
		return isset($_SESSION[$name]) ? true : false;
	}

	public function destroy()
	{
		session_unset();
		session_destroy();
	}

	public function getAll()
	{
		return $_SESSION;
	}

	public function __set($name, $value)
	{
		$_SESSION[$name] = $value;
	}

	public function __get($name)
	{
		return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
	}

	public function __unset($name)
	{
		unset($_SESSION[$name]);
	}

}