<div class="top_menu">
	<center>
		<a href="<?=ACTUAL_LINK?>admin/posts/publish" class="sactive" href="">Published</a>
		<a href="<?=ACTUAL_LINK?>admin/posts/draft">Drafts</a>
		<a href="<?=ACTUAL_LINK?>admin/posts/trash">Trash</a>
	</center>
	<!-- <small class="order_by">
		Order by:
		<a class="active" href="">Datetime</a> |
		<a href="">Views</a> |
		<a href="">Title</a>
	</small>
	<small class="tm_order">
		<br>Order:
		<a href="">ascending</a> |
		<a class="active" href="">descending</a>
	</small> -->
</div>

<style>
.top_menu{margin-top: -1.618em;margin-bottom: 1.618em;}
.top_menu a{border:none;padding:0 .382em;color:goldenrod;}
.top_menu a:hover{text-decoration: underline;}
.top_menu a.active{color:goldenrod}
small div a{border:0;}
</style>

<!-- <div class="dropdown">
<a href="javascript:void(0)" onclick="myFunction()" class="dropbtn">Dropdown</a>
	<div id="myDropdown" class="dropdown-content">
		<a href="#">Link 1</a>
		<a href="#">Link 2</a>
		<a href="#">Link 3</a>
	</div>
</div> -->


<!-- Published -->
<?php if($data['posts_status']=='publish'): ?><h2>Published Posts</h2><br>

	<?php foreach ($data['posts'] as $posts => $post): ?>
	<p><h4><a href="<?=ACTUAL_LINK.'blog/'.$post['url']?>"><?=$post['title']?></a></h4>
	<small>
		<span title="<?=$post['views']?>"><?=functions::number_format_short($post['views'])?> Views - <?=date('d M, Y ', strtotime($post['datetime']))?></span> - 
		<div class="dropdown">
			<a href="javascript:void(0)" onclick="myFunction(<?=$post['id']?>)" class="dropbtn">Options</a>
			<div id="myDropdown<?=$post['id']?>" class="dropdown-content">
				<a href="<?=ACTUAL_LINK?>admin/post-edit/<?=$post['id']?>">Edit</a>
				
				<?php if($post['comment_status']=='open'): ?>
		 		<a href="<?=ACTUAL_LINK?>admin/post-disable-comments/<?=$post['id']?>" onclick="return confirm('Are you sure you want to disable comments this article?\n\n<?=$post['title']?>')">Disable comments</a>
		 		<?php endif;?>
		 		<?php if($post['comment_status']=='closed'): ?>
		 		<a href="<?=ACTUAL_LINK?>admin/post-enable-comments/<?=$post['id']?>" onclick="return confirm('Are you sure you want to enable comments this article?\n\n<?=$post['title']?>')">Enable comments</a>
		 		<?php endif;?>

		 		<a href="<?=ACTUAL_LINK?>admin/post-unpublish/<?=$post['id']?>" onclick="return confirm('Are you sure you want to unpublish this article?\n\n<?=$post['title']?>')">Unpublish</a>

				<a href="<?=ACTUAL_LINK?>admin/post-remove/<?=$post['id']?>" onclick="return confirm('Are you sure you want to remove this article?\n\n<?=$post['title']?>')">Remove</a>
			</div>
		</div>
	</small><br><br>
<?php endforeach; endif;?>


<!-- Drafts -->
<?php if($data['posts_status']=='draft'): foreach ($data['posts'] as $posts => $post): ?>
	<p><h4><a href="<?=ACTUAL_LINK.'blog/'.$post['url']?>"><?=$post['title']?></a></h4>
	<small>
		👁 <?=$post['views']?> - <?=date('d M, Y ', strtotime($post['datetime']))?> - 
		<div class="dropdown">
			<a href="javascript:void(0)" onclick="myFunction(<?=$post['id']?>)" class="dropbtn">Options</a>
			<div id="myDropdown<?=$post['id']?>" class="dropdown-content">
				<a href="<?=ACTUAL_LINK?>admin/post-edit/<?=$post['id']?>">Edit</a>
				<a href="<?=ACTUAL_LINK?>admin/post-publish/<?=$post['id']?>" onclick="return confirm('Are you sure?')">Publish</a>
				<a href="<?=ACTUAL_LINK?>admin/post-remove/<?=$post['id']?>" onclick="return confirm('Are you sure?')">Remove</a>
			</div>
		</div>
	</small><br><br>
<?php endforeach; endif;?>


<!-- Trash -->
<?php if($data['posts_status']=='trash'): foreach ($data['posts'] as $posts => $post): ?>
	<p><h4><a href="<?=ACTUAL_LINK.'blog/'.$post['url']?>"><?=$post['title']?></a></h4>
	<small>
		👁 <?=$post['views']?> - <?=date('d M, Y ', strtotime($post['datetime']))?> - 
		<div class="dropdown">
			<a href="javascript:void(0)" onclick="myFunction(<?=$post['id']?>)" class="dropbtn">Options</a>
			<div id="myDropdown<?=$post['id']?>" class="dropdown-content">
				<a href="<?=ACTUAL_LINK?>admin/post-edit/<?=$post['id']?>">Edit</a>
				<a href="<?=ACTUAL_LINK?>admin/post-publish/<?=$post['id']?>" onclick="return confirm('Are you sure?')">Restore</a>
				<a href="<?=ACTUAL_LINK?>admin/post-unpublish/<?=$post['id']?>" onclick="return confirm('Are you sure?')">Move to drafts</a>
				<a href="<?=ACTUAL_LINK?>admin/post-delete/<?=$post['id']?>" onclick="return confirm('Are you sure you want to permanently delete this article?\n\n<?=$post['title']?>')">Delete</a>
			</div>
		</div>
	</small><br><br>
<?php endforeach; endif;?>


<?php
if ($data['count']>10)
{
	echo '<div class="pagination">Page: ';
	$c = 0;
	for ($i=0; $i<$data['count']; $i+=1)
	{
		if($c*10<$data['count'])
			echo '<a href="'.ACTUAL_LINK.'admin/posts/'.$data['posts_status'].'/page/'.($c+1).'">'.($c+1).'</a> ';
		$c++;
	}
	echo '</div>';
}
?>
<style type="text/css">.pagination a{padding:0 0.3em;font-weight: bold;}</style>



<!-- <div class="modal">
	<div class="main">
	Are you sure you want to remove this post?<br>
	<i>"Lorem Ipsum Dolor Sit Amet"</i><br><br>
		<input type="button" value="Remove">
		<input type="button" onclick="$('modal').hide();" value="Close">
	</div>
</div> -->

<style type="text/css">
.modal{
	position: fixed;
	top:0;
	left:0;
	bottom:0;
	width:100%;
	z-index: 15;
	background-color: rgba(0,0,0,.05);
	padding:1.6180398875em;
	overflow: hidden;
}
.modal .main{
	background-color: #fff;
	position: relative;
	max-width:30em;
	margin:0 auto 0;
	width:100%;
	padding:1.61803398875em;
	box-shadow: 0 2px 4px rgba(0,0,0,.15);
	border:1px solid#dadada;
	border-radius: 3px;
}
</style>