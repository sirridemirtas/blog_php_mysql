<?php

/**
 * 
 */

class AdminModel extends Model
{

	public function posts($post_status, $page)
	{
		$data = array();
		$data["count"] = $this->db->select("SELECT COUNT(*) AS count FROM posts WHERE status='".$post_status."'")[0]["count"];

		$data["posts"] = $this->db->select("SELECT id, title, datetime, views, url, comment_status FROM posts WHERE status='".$post_status."' ORDER BY datetime DESC LIMIT 10 OFFSET $page");
		
		return $data;
	}

	public function save_post($data)
	{
		return $this->db->insert("posts", $data);
	}

	public function edit($id)
	{
		return $this->db->select("SELECT id, title, datetime, edit_time, content, tags, url, status, comment_status, password FROM posts WHERE id = $id");
	}

	public function update_post($data, $id)
	{
		return $this->db->update("posts", $data, "id = $id");
	}

	/**
	 * Publish, unpublish, remove
	 */
	public function post_action($data, $id)
	{
		return $this->db->update("posts", $data, "id = $id");
	}

	/**
	 * Permanently delete post
	 */
	public function post_delete($id)
	{
		return $this->db->delete("posts", "id = $id AND status='trash'");
	}

	/**
	 * Disable or enable comments
	 */
	public function post_comments_action($data, $id)
	{
		return $this->db->update("posts", $data, "id = $id");
	}

	/**
	 * Settings page data
	 */
	public function get_user_data($token)
	{
		return $this->db->select("SELECT name, username, email FROM users WHERE token = '".$token."'");
	}

	public function settings_save($data, $token, $pass)
	{
		return $this->db->update('users', $data, "token = '".$token."' AND password='".$pass."'");
	}

}