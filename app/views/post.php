<!-- Post -->
<?php if ($data['post']['password']==''): ?>
<article>
	<h1 class=""><?=$data['post']['title']?></h1>
	<!-- <small class="art_datetime"><?=functions::dateFormat($data['post']['datetime'])?></small>
	</br> --> <hr class="nonstyle">
	<p class="art_content">
		<?=nl2br($data['post']['content'])?><!--  <a href="">Refresh</a> -->
	</p>
</article>
<hr>

<br>

<!-- Comments -->	
<?php if ($data['post']['comment_status']=="open"): ?>
	<a href="javascript:void(0)" onclick="document.getElementsByClassName('commentForm').style.display='inherit';">+ add a comment</a></br></br>
	<!-- Comment Form -->	
	<form id="cform" class="commentForm" name="" method="post" action="" style="display:none">
		<input type="textbox" class="textbox" name="name" maxlength="50" placeholder="name" required><br>
		<input type="email" class="textbox" name="email" maxlength="50" placeholder="e-mail" required><br>
		<textarea name="comment" spellcheck="false" class="textbox" maxlength="250" placeholder="comment..." required></textarea><br><br>
		<input type="submit" name="" value="Send"><br>
	</form>
	<!-- Comment Form End-->

	<section id="comments">
		<?php if (!empty($data['comments'])): ?>
			<h2 style="sdisplay: inline;"><b>Comments</b></h2><br>
			<?php foreach ($data['comments'] as $comments => $comment): ?>
				<label><b><?=$comment['name']?></b> <small><?=functions::dateFormat($comment['datetime'])?></small></label></br>
				<?=$comment['comment']?></br></br>
			<?php endforeach; ?>
		<?php /*else: echo "No comments yet";*/ endif;?>
	</section>
	<!-- <hr> -->
<?php endif;?>
<!-- Comments End -->

<!-- Other Post -->
<?php if (!empty($data['otherposts'])): ?>
<section class="otherposts"><!-- </br> -->
	<h2 class=""><b>Recent Posts</b></h2>
	<?php foreach ($data['otherposts'] as $posts => $post): ?>
		</br><p><h3><a href="<?=$post['url']?>"><?=$post['title']?></a></h3>
		<!-- <p><?=strip_tags($post['content'])?>...</p> -->
		<small><?=functions::dateFormat($post['datetime'])?></small></br>
	<?php endforeach; ?><br>
	<!-- <a href="<?=ACTUAL_LINK?>blog">Show more posts</a> -->
	<a href="<?=ACTUAL_LINK?>blog/archive">Archive</a>
</section>
<?php endif; ?>
<!-- Other Post End -->

<?php endif; //password if end?>

<?php if ($data['post']['password']!=''): ?>
<center>
<h2><?=$data['post']['title'];?></h2><br>
This post is password protected.
To view it please enter your password below:<br><br>
<form action="" style="width:14em;">
	<input type="password" name="" class="textbox" placeholder="password" required><br>
	<input type="submit" style="width:100%" value="Enter"><br>
</form>
</center>
<?php endif;?>