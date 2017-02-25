<?php

/**
 * 
 */

class HomeModel extends Model
{
	public function home()
	{
		$sql = "SELECT title, url, content, datetime, tags, comment_status, id FROM posts WHERE status='publish' ORDER BY datetime DESC LIMIT 1";
		return $this->db->select($sql)[0];
	}

	public function blog($page)
	{
		$data = array();
		$data["count"] = $this->db->select("SELECT COUNT(*) AS count FROM posts WHERE status='publish'")[0]["count"];

		$data["posts"] = $this->db->select("SELECT title, url, comment_status, LEFT(content, 140) AS content, datetime FROM posts WHERE status='publish' AND password='' ORDER BY datetime DESC LIMIT 10 OFFSET $page");
		
		return $data;
	}

	public function post($array = array())
	{
		$this->updateViews($array);
		//print_r($array);

		$sql = "SELECT title, url, content, datetime, tags, comment_status, id, password FROM posts WHERE status='publish' AND url = :url ";
		return $this->db->select($sql, $array);
	}

	public function get_post_id($post_uri)
	{
		return ($this->db->select("SELECT id FROM posts WHERE url = '$post_uri'"))[0]['id'];
	}

	public function comments($id)
	{
		$sql = "SELECT name, comment, datetime FROM comments WHERE post_id = $id ";
		return $this->db->select($sql);
	}

	public function commentSave($data = array())
	{
		return $this->db->insert("comments", $data);
	}

	public function otherPosts($id)
	{
		$sql = "SELECT title, url, LEFT(content, 140) AS content, datetime FROM posts WHERE status='publish' AND password='' AND id NOT IN (SELECT id FROM posts WHERE id = $id) ORDER BY datetime DESC LIMIT 5";
		return $this->db->select($sql);
	}

	private function updateViews($url)
	{
		$sql = "UPDATE posts SET views = views+1 WHERE url = :url";
		$this->db->affectedRows($sql, $url);
	}

	public function blog_archive()
	{
		return $this->db->select("SELECT 
			YEAR(datetime) AS YEAR, 
			MONTH(datetime) AS MONTH,
			COUNT(*) AS TOTAL 
		FROM posts WHERE status='publish'
		GROUP BY YEAR, MONTH 
		ORDER BY datetime DESC"
		);
	}

	public function blog_archive_json($min, $max)
	{
		return $this->db->select("SELECT title, url FROM posts WHERE datetime BETWEEN '".$min."' AND '".$max."' AND status='publish' ORDER BY datetime DESC");
	}

	public function blog_archive_monthly($min, $max)
	{
		return $this->db->select("SELECT title, url, datetime FROM posts WHERE datetime BETWEEN '".$min."' AND '".$max."' AND status='publish' ORDER BY datetime DESC");
	}

}