<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="robots" content="noindex,nofollow">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
	<title>Page Not Found!</title>
	<style>
		body {
			margin: 0;
			padding: 0;
			width: 100%;
			height: 100%;
			color: #B0BEC5;
			display: table;
			font-weight: 100;
			font-family: Helvetica Neue, Helvetica, Lucida Grande;

			background-color: #fff;
			color:#333;
			font-size: 17px;
			font-family:  consolas, courier, monospace, Lucida Sans, arial;
		}
		.container {
			text-align: center;
			display: table-cell;
			vertical-align: middle;
		}
		.content {
			text-align: center;
			display: inline-block;
		}
		.title {
			_font-size: 72px;
			margin-bottom: 30px;

			font-size:19px;
		}
		a{
			text-decoration: none;
			color:inherit;
		}
		.blink {
			/*-webkit-animation-name: blinker;  
			-webkit-animation-iteration-count: infinite;  
			-webkit-animation-timing-function: cubic-bezier(.3, 0, 1, 1);
			-webkit-animation-duration: 1.618s; */
			-webkit-animation-name: blinker;
			-webkit-animation-duration: 1s;
			-webkit-animation-timing-function: linear;
			-webkit-animation-iteration-count: infinite;

			-moz-animation-name: blinker;
			-moz-animation-duration: 1s;
			-moz-animation-timing-function: linear;
			-moz-animation-iteration-count: infinite;

			animation-name: blinker;
			animation-duration: 1s;
			animation-timing-function: linear;
			animation-iteration-count: infinite;
		}
		@-moz-keyframes blinker {  
			0% { opacity: 1.0; }
			50% { opacity: 0.0; }
			100% { opacity: 1.0; }
		}
		@-webkit-keyframes blinker {  
			0% { opacity: 1.0; }
			50% { opacity: 0.0; }
			100% { opacity: 1.0; }
		}
		@keyframes blinker {  
			0% { opacity: 1.0; }
			50% { opacity: 0.0; }
			100% { opacity: 1.0; }
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="content">
			<div class="title"><font size="25px">404</font><br>Page Not Found!</div>
			<a href="<?=ACTUAL_LINK?>">Homepage<b class="blink">❤<!-- | --></b></a>
		</div>
	</div>
</body>
</html>