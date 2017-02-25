<?php
function sanitize_output($buffer) {

	$search = array(
		'/\>[^\S ]+/s',	// strip whitespaces after tags, except space
		'/[^\S ]+\</s',	// strip whitespaces before tags, except space
		'/(\s)+/s',		// shorten multiple whitespace sequences
		'<br />',
		'/<!--(.*)-->/Uis'
	);
	$replace = array('>','<','\\1','br','');
	$buffer = preg_replace($search, $replace, $buffer);
	return $buffer;
}
//ob_start("sanitize_output");


include_once 'functions.php';

define('ACTUAL_LINK', "http://".$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'], 0, -16));

/**
 * App Start
 */
$app = new App();

/**
 * 
 */
$app->path(__DIR__.'/../app');

/**
 * Set URI for routing
 * Default: $_SERVER['REQUEST_URI']
 */
$uri = "/".strtolower(ltrim(strstr($_SERVER['QUERY_STRING'], "&"), "&"));
//$uri = $_SERVER['PATH_INFO'];
$app->uri = $uri;

/**
 * Error file
 */
$app->errorFile = __DIR__.'/../app/views/errors/404.php';

/**
 * Other routes
 */
$routes = array(
	'/hello_{string}_end.py' => function ($value){
		echo "Hello $value";
	},
	/*'/blog/{string}/{int}' => function ($value=""){
		echo "Blog";
	},*/
);

$app->routes($routes);

/**
 * App runing
 */
$app->run();