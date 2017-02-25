<?php 
if(!count($data['posts'])/*!isset($data['posts'][0])*/)
	echo "<h2>There were no results!</h2> : ".$data['datetime'];
else
	echo "<h2>".$data['datetime']."</h2><br>";
?>

<div id="posts">
<?php
foreach ($data['posts'] as $key => $value) {
	echo '<h3><time>'.$key.'</time></h3><br>';
	foreach ($value as $k => $val)
		echo '<h3><a href="'.ACTUAL_LINK."blog/".$val['url'].'">'.$val['title'].'</a></h3><br>';
}
?>
</div>

<style>
#posts{
	border-left:1px solid #888;
	padding-left:1.618em;
}
time:before{
	content: '— ';
	color:#888;
	margin-left:-1.382em;
}
</style>
<br>
<a href="<?=ACTUAL_LINK?>blog/archive">Archive</a>
