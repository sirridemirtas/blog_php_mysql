<?php

/**
 * 
 */

class BaseModel extends Model
{

	public function isimlistele()
	{
		$sql = "SELECT * FROM users";
		return $this->db->select($sql);
	}

	public function post($id)
	{
		$sql = "SELECT * FROM posts WHERE id = $id ";
		return $this->db->select($sql);
	}

	public function login($array = array())
	{
		$sql = "SELECT * FROM users WHERE username = :username AND password = :password";
		$count = $this->db->affectedRows($sql, $array);
		
		if($count > 0){
			$sql = "SELECT * FROM users WHERE username = :username AND password = :password";
			return $this->db->select($sql, $array);
		}else{
			return false;
		}
	}
}