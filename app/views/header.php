<!DOCTYPE html>
<html lang="tr-TR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
	<meta name="robots" content="index, follow">
	<meta name="description" content="<?=$data['meta']['description']?>">
	<meta name="author" content="John Doe">
	
	<title><?=$data['meta']['title']//isset($page_title) ? $page_title." | Lorem Ipsum" : "Blog"?></title>

	<link rel="shortcut icon" href="">
	<link href='https://fonts.googleapis.com/css?family=Noto+Serif:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?=ACTUAL_LINK?>css/normalize.css">
	<link rel="stylesheet" type="text/css" href="<?=ACTUAL_LINK?>css/style.css">

	<script src="<?=ACTUAL_LINK?>js/site.js"></script>
</head>
<body>
<div id="alert"></div>
	
<header>
	<a href="<?=ACTUAL_LINK?>">lorem ipsum <small class="beta">BETA</small></a>
</header>
<style type="text/css">
.beta{
	color:#666;
	font-size: 0.382em;
	padding:0 0.382em;
	border:1px solid goldenrod;
	border-radius: 7px;
	vertical-align: middle;
}
</style>

<nav>
	<a href="<?=ACTUAL_LINK?>blog">blog</a>
	<a href="<?=ACTUAL_LINK?>contact">contact</a>
	<a href="<?=ACTUAL_LINK?>">lorem</a>
	<a href="">ipsum</a>
</nav>
<div class="wrapper">