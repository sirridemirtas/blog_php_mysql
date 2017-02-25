<?php

/**
 * 
 */

namespace System\Libraries;

use PDO;

class Database extends PDO
{

	public function __construct($config)
	{
		$dsn	= 'mysql:dbname='.$config['name'].';host='.$config['host'];
		$user	= $config['user'];
		$pass	= $config['pass'];
		//try{
			$dbh = parent::__construct($dsn, $user, $pass);
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		/*}
		catch(PDOException $e) {
			exit('Connection failed: '.$e->getMessage());
		}*/
	}
	
	public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
	{
		$sth = $this->prepare($sql);
		foreach ($array as $key => $value)
			$sth->bindValue($key, $value);
		$sth->execute();
		return $sth->fetchAll($fetchMode);
	}
	
	public function affectedRows($sql, $array = array())
	{
		$sth = $this->prepare($sql);
		foreach ($array as $key => $value)
			$sth->bindValue($key, $value);
		$sth->execute();
		return $sth->rowCount();
	}
	
	public function insert($tableName, $data)
	{
		$fieldKeys = implode(",", array_keys($data));
		$fieldValues = ":".implode(", :", array_keys($data));

		$sql = "INSERT INTO $tableName($fieldKeys) VALUES($fieldValues)";
		$sth = $this->prepare($sql);
		foreach ($data as $key => $value)
			$sth->bindValue(":$key", $value);
		return $sth->execute();
	}
	
	public function update($tableName, $data, $where = null)
	{
		$where = is_null($where) ? "" : " WHERE ".$where; 
		$updateKeys = null;
		foreach ($data as $key => $value)
			$updateKeys .= "$key=:$key,";
		$updateKeys = rtrim($updateKeys, ",");
		$sql = "UPDATE $tableName SET $updateKeys $where";
		$sth = $this->prepare($sql);
		foreach ($data as $key => $value)
			$sth->bindValue(":$key", $value);
		return $sth->execute();
	}
	
	public function delete($tableName, $where, $limit = 1)
	{
		return $this->exec("DELETE FROM $tableName WHERE $where LIMIT $limit");
	}
	
}