<div class="col_16a sec1">
	<form id="edit" action="<?=ACTUAL_LINK?>admin/post-edit/<?=$data['id']?>/save" method="post">

		<input name="title" type="text" class="title" placeholder="Title"  value="<?=$data['title']?>" required>
		<br><small><?=date('M d, Y', strtotime($data['datetime']))?>
			
		<?php if ($data['edit_time']!="0000-00-00 00:00:00") echo " ~ ".date('M d, Y H:i', strtotime($data['edit_time']));?>
		</small><br><br>

		<textarea name="content" spellcheck="false" class="content" placeholder="Content..." required><?=$data['content']?></textarea><br><br>
		<input name="tags" type="text" class="tags" placeholder="tags, other, tag" value="<?=$data['tags']?>" required><br>
		<input name="url" type="text" class="tags" placeholder="link" value="<?=$data['url']?>" required><br>
		
		<label class="cb" for="cb"><input name="check" type="checkbox" value="1" id="cb" />Draft</label><br>
		
		<input type="submit" class="save button" value="Save Post" name="">
	</form>
	</br>
</div>

<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="http://localhost/mvc/js/autosize.js"></script>
<script>$(document).ready(function(){});$('textarea.content').textareaAutoSize();</script>
<script type="text/javascript">
function save_post() {
	var url = $("#edit").attr("action");//"<?=ACTUAL_LINK?>admin/post-edit/<?=$data['id']?>/save"; // the script where you handle the form input.
	$.ajax({
			type: "POST",
			url: url,
			data: $("#edit").serialize(), // serializes the form's elements.
			success: function(data){
				var color;
				if(data == "Update Error!") color = 'red'; else color = 'yellow';
				if(data == "Update Successfully!") color = 'green';

				notification(data, color); // show response from the php script.
			}
		});
}

$("#edit").submit(function(e) {
	save_post();
	e.preventDefault(); // avoid to execute the actual submit of the form.
});

$(window).bind('keydown', function(event) {
	if (event.ctrlKey || event.metaKey) {
		switch (String.fromCharCode(event.which).toLowerCase()) {
		case 's':
			event.preventDefault();
			save_post();
			break;
		case 'f':
			event.preventDefault();
			alert('ctrl-f');
			break;
		case 'g':
			event.preventDefault();
			alert('ctrl-g');
			break;
		}
	}
});
</script>

<script type="text/javascript">//$('#fakeTextarea').html( $('#realTextarea').val() );</script>