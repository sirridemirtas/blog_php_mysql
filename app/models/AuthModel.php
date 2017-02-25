<?php

/**
 * 
 */

class AuthModel extends Model
{

	public function checkUser($array = array())
	{
		$sql = "SELECT * FROM users WHERE (username = :username or email = :username) AND password = :password";
		$count = $this->db->affectedRows($sql, $array);
		
		if($count > 0)
			return $this->db->select($sql, $array);
		else
			return false;
	}

	public function setHash($token = null)
	{
		$this->db->update("users", array('token' => $token));
	}

	public function changeHash($token = null)
	{
		$this->db->update("users", array('token' => $token));
	}

	public function getHash($data = array())
	{
		$sql = "SELECT token FROM users WHERE (username = :username or email = :username) AND token = :token";
		return $this->db->select($sql, $data)['0']['token'];
	}

}