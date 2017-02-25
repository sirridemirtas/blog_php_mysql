<?php

/**
 * 	Verilerin doğrulandığı sınıf
 * 	
 * 	Varsıyılan olarak girilen tüm veriler zorunlu olarak doğru ve dolu olmalıdır
 * 	Boş geçilebilmesi istenirse sonuna :optional eklenir
 * 	Methodlara parametreler methodAdi|param1|param2|param3 şeklinde yollanır
 * 	
 * 	example => 
 * 		$validate = new Validator();
 * 		
 * 		# Çoklu kullanım
 * 		$validate->run(array(
 * 			'example@domain.com' => 'mail',
 * 			'5146516' => 'number',
 * 			'example2@domain.com' => 'mail:optional',
 * 			'75' => 'length|0|140'
 * 		));
 * 	
 * 	example2 =>
 * 		$validate = new Validator();
 * 		
 * 		$validate->isMail("example@domain.com");
 * 		$validate->isMethod("post");
 * 		
 */

namespace System\Libraries;

class Validator
{
	/**
	 * Methodların anahtar kelimeleri
	 * @var array
	 */
	public $keywords = array(
		'isMethod'	=> 'method',
		'isMail'	=> 'email',
		'isNumber'	=> 'number',
		'isEmpty'	=> 'required',
		'length'	=> 'length',
		'isIp'		=> 'ip',
		'inArray'	=> 'inArray',
		);

	/**
	 * Methodların hatalarının kalıpları
	 * @var array
	 */
	public $errors = array(
		'isMethod'	=> 'Yanlis method: %s',
		'isMail'	=> 'Yanlis mail adresi: %s',
		'isNumber'	=> 'Yanlis sayi bicimi: %s',
		'isEmpty'	=> 'Zorunlu alan',
		'length'	=> '%s - %s karakter arasi deger girin: %s',
		'isIp'		=> 'Yanlis IP adresi: %s',
		'inArray'	=> 'Yok boyle birsey: %s',
		);

	/**
	 * Methodların hatalarının parametreleri
	 * @var string
	 */
	public $error;

	public function run($values = array())
	{
		$values = array_flip($values);
		$errors = array();
		$this->keywords = array_flip($this->keywords);

		foreach ($values as $key => $value) {
			$value = trim($value);
			$key = trim($key);

			$optional = false;
			$foo = explode(":" ,$key);
			if(count($foo)>1){
				$key = $foo[0];
				if($foo[1] == "optional")
					$optional = true;
			}

			$segment = explode("|", $key);
			$method = $this->keywords[$segment[0]];
			$segment[0] = $value;
			$args = $segment;

			if (!call_user_func_array(array($this, $method), $args)){
				if($optional){
					if(!$value == "")
						$errors[] .= $this->error;
				}
				else
					$errors[] .= $this->error;
			}
		}

		if (count($errors)){
			//echo json_encode($errors);
			return false;
		}
		else
			return true;
	}

	public function isMethod($method)
	{
		$method = strtoupper($method);

		if ($method == "GET" && count($_GET))
			return true;

		elseif ($method == "POST" && count($_POST))
			return true;
		
		else
			return false;
	}

	public function isMail($email)
	{
		$this->error = sprintf($this->errors["isMail"], $email);
		return 
			filter_var($email, FILTER_VALIDATE_EMAIL)
				? true
				: false;
	}

	public function isNumber($number, $type = "")
	{
		$this->error = sprintf($this->errors["isNumber"], $number);
		switch ($type) {
			case 'int':
				$type = FILTER_VALIDATE_INT;
				break;
			case 'float':
				$type = FILTER_VALIDATE_FLOAT;
				break;
			default:
				$type = FILTER_VALIDATE_INT;
				break;
		}
		return 
			filter_var($number, $type)
				? true
				: false;
	}

	/**
	 * @param  boolean
	 * @return TRUE for "1", "true", "on" and "yes", FALSE for "0", "false", "off", "no", and "", NULL otherwise
	 */
	public function isBoolean($boolean)
	{
		return 
			filter_var($number, FILTER_VALIDATE_BOOLEAN)
				? true
				: false;
	}

	public function isEmpty($value)
	{
		$this->error = $this->errors["isEmpty"];
		if(strlen(trim($value)))
			return true;
		else
			return false;
	}

	public function length($value, $min = 0, $max)
	{
		$this->error = sprintf($this->errors["length"], $min, $max, strlen($value));
		if(strlen($value) < $min OR strlen($value) > $max)
			return false;
		else
			return true;
	}

	public function isIp($ip)
	{
		$this->error = sprintf($this->errors["isIp"], $ip);
		return 
			filter_var($ip, FILTER_VALIDATE_IP)
				? true
				: false;
	}

	public function inArray($value, $values)
	{
		$this->error = sprintf($this->errors["inArray"], $value);
		return
			in_array(trim($value), $values)
				? true
				: false;
	}

}