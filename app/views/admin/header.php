<!DOCTYPE html>
<html lang="tr-TR">
<head>
	<meta charset="UTF-8">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
	<title><?=isset($page_title) ? $page_title." | Lorem Ipsum" : "Blog"?></title>

	<link rel="shortcut icon" href="">
	<link href='https://fonts.googleapis.com/css?family=Noto+Serif:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?=ACTUAL_LINK?>css/normalize.css">
	<link rel="stylesheet" type="text/css" href="<?=ACTUAL_LINK?>css/style.css">
	

	<!-- <script src="http://code.jquery.com/jquery-latest.min.js"></script> -->
	<!-- <script src="<?=ACTUAL_LINK?>js/jquery.1.11.1.js"></script> -->
	<!-- <script src="http://code.jquery.com/jquery-latest.min.js"></script> -->
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="<?=ACTUAL_LINK?>js/md5.min.js"></script>
	<script src="<?=ACTUAL_LINK?>js/site.js"></script>
</head>
<body>
<div id="alert"></div>
	
<header>
	<a href="<?=ACTUAL_LINK?>admin">administration</a>
</header>

<nav>
	<a href="<?=ACTUAL_LINK?>admin/posts/publish">Posts</a>
	<a href="<?=ACTUAL_LINK?>admin/new-post">New Post</a>
	<a href="<?=ACTUAL_LINK?>admin/settings">Settings</a>
	<a href="" >Stats</a>
	<a href="<?=ACTUAL_LINK?>admin/logout" style="margin-right:0">Logout</a>
</nav>

<div class="wrapper">