<?php foreach ($data["posts"] as $posts => $post): ?>
	<h3><a href="<?=ACTUAL_LINK."blog/".$post['url']?>"><?=$post['title']?></a></h3>
	<p><span class="d"><?=date('d M, Y ', strtotime($post['datetime']))?> - </span><?=strip_tags($post['content'])?>...</p>
	</br>
<?php endforeach; ?>
<style>span.d{color:#707070;font-size:95%}</style>
<?php
if ($data['count']>10)
{
	echo '<div class="pagination">Page: ';
	$c = 0;
	for ($i=0; $i<$data['count']; $i+=1)
	{
		if($c*10<$data['count'])
			echo '<a href="'.ACTUAL_LINK.'blog/page/'.($c+1).'">'.($c+1).'</a> ';
		$c++;
	}
	echo '</div>';
}
?>
<style type="text/css">.pagination a{padding:0 0.3em;font-weight: bold;}</style>