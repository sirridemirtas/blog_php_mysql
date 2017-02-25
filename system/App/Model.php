<?php

/**
 * 
 */

class Model extends \System\Libraries\Database
{
	protected $db = array();

	public function __construct($config = array())
	{	
		$this->db = new \System\Libraries\Database(require PATH_APP.'/config/database.php');
	}
}