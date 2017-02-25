<?php

/**
 * 
 */

class HomeController extends Controller
{
	public function home()
	{
		$model = $this->loadModel("HomeModel");
		$data = $model->home();
		$this->loadView("header");
		$this->loadView("home", $data);
		$this->loadView("footer");
	}

	public function blog($page=1)
	{
		if($page!=1) $page = $page*10-10;
		else $page = 0;

		$model = $this->loadModel("HomeModel");
		$data = $model->blog($page);
		$header_data['meta'] = array(
				'title'			=> 'Blog',
				'description'	=> 'John Doe\'s personal blog.',
		);
		$this->loadView("header", $header_data);
		$this->loadView("blog", $data);
		$this->loadView("footer");
	}

	public function post($url)
	{
		$model = $this->loadModel("HomeModel");

		$data = array(
			"url" => $url,
		);

		$data = $model->post($data);
		if($data){
			$data['post'] = $data[0];
				$id = $data['post']['id'];
			$data['comments'] = $model->comments($id);
			$data['otherposts'] = $model->otherPosts($id);

			if($data['post']['status']=="publish"){
				$this->loadView("errors/404");
				exit();
			}
			
			$header_data['meta'] = array(
				'title'			=> $data['post']['title'],
				'description'	=> substr(strip_tags($data['post']['content']), 0,150),
				/* 
				''	=> ,
				''	=> ,
				''	=> ,
				''	=> ,
				''	=> ,
				''	=> ,*/
				);

			$this->loadView("header", $header_data);
			$this->loadView("post", $data);
			$this->loadView("footer");
		}
		else
			$this->loadView("errors/404");
	}

	public function getPostWithAjax($url)
	{
		header('Content-Type: application/json');

		$model = $this->loadModel("HomeModel");

		$data = array(
			"url" => $url,
		);

		$data = $model->post($data);
		if($data){
			$data['post'] = $data[0];
				$id = $data['post']['id'];
			$data['comments'] = $model->comments($id);
			$data['otherposts'] = $model->otherPosts($id);

			// if(count($data['comments']))
			// 	foreach ($data['comments'] as $key => $value)
			// 		$data['comments'][$key]['datetime'] = functions::dateFormat($value);
			
			echo '['.json_encode($arrayName = array(
				'title'		=> $data[0]['title'],
				'datetime'	=> functions::dateFormat($data[0]['datetime']),
				'content'	=> nl2br($data[0]['content']),
				'url'		=> $data[0]['url'],
				'comments'	=> json_encode($data['comments'])
				))."]";
		}
	}

	public function contact()
	{
		$data['meta'] = array('title' => 'Contact');
		$this->loadView("header",$data);
		$this->loadView("contact");
		$this->loadView("footer");
	}

	public function validate()
	{
		echo "<pre>";
		$this->validator()->run(array(
			'srr@mail.com'	=> 'mail:optional ',
			'46546546546'	=> 'number|float:optional',
			'zorunlu veri'	=> 'required',
			'183a8' 		=> 'length|4|10'
		 ));
		echo "</pre>";

		/*echo $this->validator->isMail("asd@asd.ad") ? "true" : "false";
		echo $this->validator->isMethod('get') ? 'dogri dogri' : 'yanlis yanlis';*/

	}

	public function commentSave($post_uri = NULL)
	{
		if(is_null($post_uri)) header("Refresh:0");

		$name 	= isset($_POST['name']) ? $_POST['name'] : NULL;
		$email 	= isset($_POST['email']) ? $_POST['email'] : NULL;
		$comment= isset($_POST['comment']) ? $_POST['comment'] : NULL;
		//$datetime = date('Y-M-D G:i:s');
		$ip = functions::get_client_ip();
		
		$validate = $this->validator()->run(array(
			$name	=> 'length|1|50:required',
			$email	=> 'email:required',
			$comment=> 'length|1|250:required',
		));

		if ($validate) {
			$model = $this->loadModel("HomeModel");
			$post_id = $model->get_post_id($post_uri);

			if(!$post_id) return false;

			if($model->commentSave(compact('post_id', 'name', 'email', 'comment', 'ip')))
			{
				//return true;
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
			else echo "Data is not save!";
		}
		else echo "Datas is not valid!";
	}

	public function blog_archive()
	{
		$model = $this->loadModel('HomeModel');
		$data = $model->blog_archive();

		$this->loadView('header');
		$this->loadView('blog_archive', $data);
		$this->loadView('footer');

	}

	public function blog_archive_json($date)
	{
		header('Content-Type: application/json');
		$max = $date.'-31 23:59:59';
		$min = $date.'-01 00:00:00';
		echo json_encode($this->loadModel('HomeModel')->blog_archive_json($min, $max));
	}

	public function blog_archive_monthly($date)
	{
		$model = $this->loadModel('HomeModel');
		$max = $date.'-31 23:59:59';
		$min = $date.'-01 00:00:00';
		$data = $model->blog_archive_monthly($min, $max);

		$data_n['posts'] = $data;
		$data_n['datetime'] = functions::n2M(substr($date, 5,2)).' '.substr($date, 0,4);
		$header_data['meta'] = array('title' => $data_n['datetime'], 'description' => 'Posts shared in: '.$data_n['datetime']);

		$days = array();
		foreach ($data_n['posts'] as $key => $value)
			$days[functions::dateFormat($value['datetime'], 'd')][$key] = $value;
		array_map('array_values', $days);
		$data_n['posts'] = $days;

		$this->loadView('header', $header_data);
		$this->loadView('blog_archive_monthly', $data_n);
		$this->loadView('footer');

	}

}