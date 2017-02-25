<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blog</title>

	<link href='https://fonts.googleapis.com/css?family=Noto+Serif:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="http://srr/mvc/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="http://srr/mvc/css/style.css">
</head>
<body>

<div class="nav"></div>

<div class="wrapper">
		<div class="per_20 box box_left">
			<div class="box_title">Home <!-- <small>Subtitle</small> --></div>
			<div class="box_cont">
				<a href="#">Posts</a>
				<a href="#">New Post</a>
				<a href="#">Stats</a>
				<a href="#">Settings</a>
			</div>
			
		</div>
		<div class="per_80 box box_right">
			<div class="box_title">Home</div>
			<div class="box_cont">
			<a href="">Refresh</a>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus, nulla nesciunt eos velit aperiam! Atque illo est sed quae quia cupiditate alias aliquam blanditiis ipsum vitae, aperiam asperiores assumenda accusantium explicabo obcaecati enim veniam iusto aut, minus! Doloribus maxime, hic placeat porro illum, impedit sit consequatur nam minus temporibus similique quidem neque minima, aperiam veniam error id ipsum iste. Iure officia distinctio omnis quasi veniam iusto hic, doloribus optio! Quasi laboriosam, nesciunt autem iste incidunt dicta. Eveniet quasi ducimus aliquam veritatis minima accusantium, quisquam odit. Quas asperiores illo quaerat nulla amet, sed maiores quibusdam rem voluptatum, facilis fugit. Impedit, velit!
			</div>
		</div>
</div>

<style>
	.wrapper, footer, .header, header{
		width:100%;
		max-width:100%;
	}
	body{
		background-color: #f5f8fa;
		font-family: helvetica;
		font-size:15px;
		line-height: 30px;
	}
	.col_16{margin-top:-2px;}
	.nav{
		position: fixed;
		top: 0;
		right: 0;
		left: 0;
		z-index: 1000;
		background-color: #ffffff;
		/*border-bottom: 1px solid rgba(0,0,0,0.05);
		border-bottom: 0 solid rgba(0,0,0,0.25);
		box-shadow: 0 1px 3px rgba(0,0,0,0.25);*/
		border-bottom: 1px solid #e1e8ed;
		font-family: arial;
		height: 45px;
		color: #292f33;
	}
	.wrapper{
		_padding-top:30px;
		margin-top:44px;
		padding:0;
	}
	.box{
		border:1px solid #ccc;
		xmin-height:25em;
		background-color: #ffffff;
		border: 1px solid #e1e8ed;
		_border-radius: 4px;
	}
	.box_title{
		height:45px;
		box-shadow: 0 1px 0px #e1e8ed;
		padding: 15px;
		padding-top: 12px;
		font-size:18px;
	}
	.box_title small{
		display: block;
		color:#8899a6;
	}
	.box_left{
		bottom:0;
		
	}
	.box_cont{
		
	}
	.box_cont a{
		padding:5px 15px;
		display: block;
		box-shadow: 0 1px 0px #e1e8ed;
	}
	.box_cont a:hover{zbackground-color: #f5f8fa}
	.box_cont a:active{color:#2C93FF;}
	.box_cont a:nth-last-child(1){box-shadow: none;}
	.box_right{ 
		border-left: 0;
		padding:15px;
		xpadding-bottom:15px;
	}

	/*body{
	background: repeating-linear-gradient(90deg, rgba(0,153,255,0.2),transparent  1px , rgba(0,0,0,0) 0, rgba(0,0,0,0) 1.618em);
	background-size: 1.61803398875em 100%;
	xbackground-position: center;
	background-attachment: fixed;
	}
	html{
		background-image:-webkit-linear-gradient(rgba(0, 153, 255, 0.1) .05em, transparent .05em);
		background-size: 100% 1.61803398875em;
	}*/
</style>


</body>
</html>