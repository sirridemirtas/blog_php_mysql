<?php

/**
 * 
 */

class AdminController extends Controller
{

	public function __construct()
	{
		if(! (new AuthController())->isLogin() )
			$this->login();
	}

	public function login()
	{
		$this->loadView("header");
		$this->loadView("forms/login");
		$this->loadView("footer");
		exit;
	}

	public function home()
	{
		$this->loadView("admin/header");
		$this->loadView("admin/home");
		$this->loadView("footer");
	}

	public function posts($post_status, $page='1')
	{
		if($page!=1) $page = $page*10-10;
		else $page = 0;

		$dt = $this->loadModel("AdminModel")->posts($post_status, $page);
		$data['posts'] = $dt['posts'];
		$data['count'] = $dt['count'];
		$data['posts_status'] = $post_status;

		$this->loadView("admin/header");
		$this->loadView(('admin/posts'), $data);
		$this->loadView("footer");
	}

	public function new_post()
	{
		$this->loadView("admin/header");
		$this->loadView("admin/new_post");
		$this->loadView("footer");
	}

	public function editPost($id)
	{
		$model = $this->loadModel("AdminModel");
		$data = $model->edit($id);
		$this->loadView("admin/header");
		$this->loadView("admin/new_post", $data[0]);//admin/edit_post
		$this->loadView("footer");
	}

	public function savePost($id='')
	{
		$keys = array('form_type','title','content','tags','url','status','visibility','comment_status',);
		foreach ($keys as $key)
			if (!array_key_exists($key, $_POST) || functions::is_empty($_POST[$key]))
				exit('1');
		extract($_POST);
		if (!in_array($comment_status, array('open','closed','hide')) ||
			!in_array($visibility, array('public','password')) ||
			!in_array($form_type, array('edit','new')) ||
			!in_array($status, array('publish','draft')) ||
			($visibility == 'password' && functions::is_empty($password))
			) exit('1');
		if($visibility == 'public') $password = '';
		$ip = functions::get_client_ip();

		$model = $this->loadModel("AdminModel");
		$data = compact('title','content','tags','url','status','password', 'comment_status', 'ip');

		if ($form_type == 'new') {
			if($model->save_post($data)) echo "3";//"Successfully!"
			else echo "4";//"Error!"
		}
		if ($form_type == 'edit') {
			if($model->update_post($data,$id)) echo "5";//"Successfully!"
			else echo "4";//"Error!"
		}
	}

	/**
	 * Publish, unpublish, remove
	 */
	public function post_action($action, $id)
	{
		//if ($action=='publish') $action='publish';
		if ($action=='unpublish') $action='draft';
		if ($action=='remove') $action='trash';

		$model = $this->loadModel("AdminModel");
		if($model->post_action(array('status' => $action), $id)){
			echo "Successfully!";
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		else echo "Error!";
	}

	public function post_delete($id)
	{
		$model = $this->loadModel('AdminModel');
		if ($model->post_delete($id)){
			echo "Successfully!";
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		else echo "Error!";
	}

	/**
	 * Disable or enable comments
	 */
	public function post_comments_action($action, $id)
	{
		if ($action=='enable') $action='open';
		if ($action=='disable') $action='closed';

		$model = $this->loadModel("AdminModel");
		if($model->post_comments_action(array('comment_status' => $action), $id)){
			echo "Successfully!";
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		else echo "Error!";
	}

	public function settings()
	{
		$model = $this->loadModel("AdminModel");
		$data = $model->get_user_data($this->session()->get("login"));

		if ($data) {		
			$this->loadView("admin/header");
			$this->loadView("admin/settings",$data[0]);
			$this->loadView("footer");
		}
		else
			echo "Error!";
	}

	public function settings_change()
	{
		if (isset($_POST['form_user']))
		{
			echo "user form";
		}
		else if (isset($_POST['form_pass']))
		{
			$pass = isset($_POST['pass']) ? $_POST['pass'] : null;
			$npass = isset($_POST['new_pass']) ? $_POST['new_pass'] : null;
			$npassr = isset($_POST['new_pass_repeat']) ? $_POST['new_pass_repeat'] : null;
			if (!is_null($pass) && !is_null($npass) && !is_null($npassr))
			{
				if ($npass == $npassr)
				{
					$model = $this->loadModel("AdminModel");	
					$model->settings_save(array('password' => sha1($npass)), $this->session()->get("login"), sha1($pass));
					if ($model) echo "1";
				}
				else echo "2";
			}
		}
		else echo "3";
	}

	public function changeSiteSettings($setting, $new_setting)
	{
		$file_path = PATH_APP."/settings.json";
		$file_content = file_get_contents($file_path);

		$settings = json_decode($file_content, true);
		$settings[$setting] = $new_setting;

		$new_settings = json_encode($settings, JSON_PRETTY_PRINT);
		file_put_contents($file_path, $new_settings);
	}
}