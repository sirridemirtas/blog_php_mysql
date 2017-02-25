<?php

return array(

	/**
	 * Hello World!
	 */
	'/hello_{string}' => function ($value=''){
		echo "Hello $value!";
	},

	/**
	 * Homepage
	 */
	'/' 	=> 'HomeController@blog'/*home*/,
	'/blog' => 'HomeController@blog',
	'/blog/page/{int}' => 'HomeController@blog',

	'/contact' => 'HomeController@contact',

	'/blog/archive' => 'HomeController@blog_archive',
	'/blog/archive/((\d{4})-(0[1-9]|1[0-2])).json' => 'HomeController@blog_archive_json',
	'/blog/archive/((\d{4})-(0[1-9]|1[0-2]))' => 'HomeController@blog_archive_monthly',

	/**
	 * Post
	 */
	'/blog/{any}.json'	=> array(
					'type' 	=> 'get', 
					'use' 	=> 'HomeController@getPostWithAjax',
					),
	'/blog/{any}'	=> array(
						'type'	=> 'get',
						'use'	=> 'HomeController@post',

						'type2'	=> 'post',
						'use2'	=> 'HomeController@commentSave',
					),

	/**
	 * Admin
	 */
	'/admin' => 'AdminController@home',

	'/admin/login'		=> 'AdminController@login',
	'/admin/login/check'=> array(
							'type' 	=> 'post', 
							'use' 	=> 'AuthController@check',
							),
	'/admin/logout'		=> array(
							'type' 	=> 'get', 
							'use' 	=> 'AuthController@logout',
							),

	'/admin/posts/(publish|draft|trash)'		=> 'AdminController@posts',
	'/admin/posts/(publish|draft|trash)/page/{int}'	=> 'AdminController@posts',

	'/admin/settings'	=> array(
							'type' 	=> 'get', 
							'use' 	=> 'AdminController@settings',

							'type2' => 'post', 
							'use2' 	=> 'AdminController@settings_change',
							),	

	'/admin/new-post'	=> array(
								'type' 	=> 'get', 
								'use' 	=> 'AdminController@new_post',

								'type2' => 'post', 
								'use2' 	=> 'AdminController@savePost',
							),

	/*'/admin/post-edit/{int}'		=> 'AdminController@editPost',
	'/admin/post-edit/{int}/save'	=> array(
										'type' 	=> 'post', 
										'use' 	=> 'AdminController@updatePost',
										),*/

	'/admin/post-edit/{int}'	=> array(
								'type' 	=> 'get', 
								'use' 	=> 'AdminController@editPost',

								'type2' => 'post', 
								'use2' 	=> 'AdminController@savePost',//updatePost
							),

	/**
	 * publish, unpublish, remove
	 */
	'/admin/post-(publish|unpublish|remove)/{int}'=> 'AdminController@post_action',

	/**
	 * permanently delete
	 */
	'/admin/post-delete/{int}'	=> 'AdminController@post_delete',

	/**
	 * disable or enable comments
	 */
	'/admin/post-(disable|enable)-comments/{int}'=> 'AdminController@post_comments_action',

	'/srr'	=> function (){
		(new Controller)->loadView("srr");
	}

);