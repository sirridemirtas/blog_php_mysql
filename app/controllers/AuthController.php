<?php

/**
 * 
 */

class AuthController extends Controller
{
	public $session;
	public $model;
	public $username;

	public function __construct()
	{
		$this->model = $this->loadModel("AuthModel");
		$this->session = $this->session();
	}

	public function isLogin()
	{
		if ($this->session->check("login") && $this->session->check("username")){
			$hash_ses= $this->session->get("login");
			$hash_db = $this->model->getHash(array(
				'username'	=> $this->session->get("username"),
				'token'		=> $hash_ses,
				));

			return $hash_ses == $hash_db ? true : false;
		}
		else
			return false;
	}

	public function check($data = array())
	{
		if ($this->isLogin())
			exit("Giriş yapılmış!");

		if (!isset($_POST['username']) || !isset($_POST['password'])){
			$this->loginPage();
			exit;
		}

		$this->username = $_POST['username'];
		$password = $_POST['password'];

		$data = array(
			":username" => $this->username,
			":password" =>  sha1(($password)),
		);
	
		if ($this->model->checkUser($data))
			$this->login();
		else
			$this->loginPage();
	}

	public function login()
	{
		$hash= $this->hash();

		$this->session->set("login", $hash);
		$this->session->set("username", $this->username);

		$this->model->setHash($hash);

		header('Location: ' . $_SERVER['HTTP_REFERER']);
		//header("refresh:0;");
	}

	public function logout()
	{
		if ($this->isLogin()){
			$_SESSION = array();
			$this->session->remove('login');
			$this->session->remove('username');
			$this->session->destroy();
			$this->model->changeHash($this->hash());
			header('Location: ' . ACTUAL_LINK."admin");
		}
		else $this->error404();
	}

	public function hash()
	{
		return md5(sha1($_SERVER['REMOTE_ADDR']).uniqid());
	}

	public function loginPage()
	{
		//echo "0";
		//header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

}