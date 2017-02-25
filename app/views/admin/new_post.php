<style>
table,tr,td,th{box-shadow:none;border:0;padding:0;}
select{
	background-color: #efefef;
	border:0;
	border-radius: 3px;
	padding: 0;
	width:100%;
}
fieldset{
	padding:0;
	margin:0;
	border:0;
}
fieldset a{
	text-decoration: none;
	border:0;
	padding:0 .382em;
}
article:focus{
	outline: none;
	border: none;
}
[contentEditable=true]:empty:not(:focus):before{
	content:attr(data-ph);
	opacity: .5;
}
#editor{
	min-height: 3.23em;
	margin-top: -0.6em;
}
</style>

<form id="form_post" action="" method="POST">

<input type="hidden" name="form_type" value="<?php echo isset($data['title']) ? 'edit' : 'new';?>">

	<table>
		<tr>
			<td colspan="2">
				<input name="title" type="text" class="title" placeholder="Title" value="<?=$data['title']?>" srequired>
			</td>
		</tr>
		<!-- <tr>
			<td>
				<small>Today</small><br>
			</td>
		</tr> -->
		<tr>
			<td colspan="2">
				<br><textarea id="content" name="content" spellcheck="false" class="content" placeholder="Content..." style="display:none;" xrequired></textarea>

				<article id="editor" contenteditable="true" data-ph="Enter text here"><?=$data['content']?></article><br>
			</td>
		</tr>
		<tr>
			<td colspan="2" bgcolor="#f8f8f8" >
			<fieldset>
				<a href="javascript:void(0)" onclick="document.execCommand('italic',false,null);"><i>I</i></a>
				<a href="javascript:void(0)" onclick="document.execCommand('bold',false,null);"><B>B</B></a>
				<a href="javascript:void(0)" onclick="document.execCommand('underline',false,null);"><u>U</u></a>
				<a href="javascript:void(0)" onclick="document.execCommand('formatBlock',false,'<h2>');">H2</a>
				<a href="javascript:void(0)" onclick="document.execCommand('formatBlock',false,'<h3>');">H3</a>
				<a href="javascript:void(0)" onclick="document.execCommand('formatBlock',false,'<blockquote>');">Blockquote</a>
				<a href="javascript:void(0)" onclick="link();">Link</a>
				<a href="javascript:void(0)" onclick="insertHTML();">Img</a>
			</fieldset>
			<script>
				function link()
				{
					var url = prompt("Enter the URL");
					document.execCommand("createLink", false, url);
				}
				function insertHTML(img) {
					var url = prompt("Enter the URL");
					document.execCommand("insertImage", false, url);
				}
			</script>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<small class="counter"><span id="word_counter">Counter</span>
				<span class="right text_right">Save: 17 Feb, 2017 18:34</span>
				</small>
				
				<style>
					.counter{
						display: block;
						width:100%;
						background-color:#efefef;
						padding:0.2em 0.5em;
						border-radius: 4px;
						border-top-right-radius:0;
						border-top-left-radius:0;
					}
				</style><br>
			</td>
		</tr>
		<tr>
			<td>Post Url</td>
			<td><input name="url" type="text" class="tags" placeholder="post-link" value="<?=$data['url']?>" required></td>	
		</tr>
		<tr>
			<td>Tags</td>
			<td><input name="tags" type="text" class="tags" placeholder="tags, other, tag" value="<?=$data['tags']?>" required></td>
		</tr>
		<tr>
			<td colspan="2"><br><h2>Options</h2><br></td>
		</tr>
		<tr>
			<td>Status</td>
			<td>
				<select name="status" id="post_status">
					<option <?=$data['status']=='publish' ? 'selected' : '';?> value="publish">Publish</option>
					<option <?=$data['status']=='draft' ? 'selected' : '';?> value="draft">Draft</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Visibility</td>
			<td>
				<select id="visibility" name="visibility" id="">
					<option <?=$data['password']=='' ? 'selected' : '';?> value="public">Public</option>
					<option <?=$data['password']!='' ? 'selected' : '';?> value="password">Password Protected</option>
				</select>
			</td>
		</tr>
		<tr id="pass" style="<?=$data['password']=='' ? 'display:none;' :'';?>">
			<td>Password</td>
			<td><input id="password" name="password" type="text" class="tags" value="<?=$data['password']?>" placeholder="password"></td>
		</tr>
			<script>
				//$('#pass').hide(); 
				$('#visibility').change(function(){
					if($('#visibility').val() == 'password') {
						$('#pass').css('display','table-row');
						$('#pass').attr("required");
					} else {
						$('#pass').css('display','none');
					}
				});
			</script>
		<!-- <tr>
			<td>Comments</td>
			<td>
				<label class="switch">
					<input name="comment_status" type="checkbox" <?=$data['comment_status']=='open' ? 'checked' :'';?> >
					<div class="slider round"></div>
				</label>
			</td>
		</tr> -->
		<tr>
			<td>Comments</td>
			<td>
				<select name="comment_status">
					<option value="open">Open</option>
					<option value="close">Close</option>
					<option value="hide">Close and hide</option>
				</select>
			</td>
		</tr>
		<!-- <tr>
			<td>Hide recent posts</td>
			<td>
				<label class="switch">
					<input type="checkbox">
					<div class="slider round"></div>
				</label>
			</td>
		</tr> -->

		<tr>
			<td colspan="2"></br></br>
				<input type="submit" class="save button" value="Save Post">
			</td>
		</tr>
	</table>	
</form>


<script src="<?=ACTUAL_LINK?>js/autosize.js"></script>
<script>
$(document).ready(function(){

$('textarea.content').textareaAutoSize();

//$("header a").html("new post");

/*function wordCount( val ){
	var wom = val.match(/\S+/g);
	return {
		charactersNoSpaces : val.replace(/\s+/g, '').length,
		characters         : val.length,
		words              : wom ? wom.length : 0,
		lines              : val.split(/\r*\n/).length
	};
}

var textarea = document.getElementById("content");
var result   = document.getElementById("word_counter");

textarea.addEventListener("input", function(){

	var v = wordCount(this.value);
	result.innerHTML = (
		//" Characters (no spaces):  "+ v.charactersNoSpaces +
		// " Characters (and spaces): "+ v.characters +
		" Characters: "+ v.characters +
		" Words: "+ v.words +
		" Lines: "+ v.lines
	);

}, false);*/

$('#editor').keypress(function(){
	$('.content').html($('#editor').html());
});

$('input').keypress(function (e) {
  if (e.which == 13) {
   // $('form#login').submit();
    return false;    //<---- Add this line
  }
});

$("#form_post").submit(function(e) {

$('.content').html($('#editor').html());
var title = $("[name='title']").val();
var content = $("#editor").html();
var url = $("[name='url']").val();
var tags = $("[name='tags']").val();
var status = $("[name='status']").val();
var visibility = $("[name='visibility']").val();
var comment_status = $("[name='comment_status']").val();
var password = $("[name='password']").val();
var form_type = $("[name='form_type']").val();
if(visibility=="public") password = '';


	$.ajax({
		type: "POST",
		url: window.location.href,
		data: { 
			'title': title,
			'content': content,
			'url': url,
			'tags': tags,
			'status': status,
			'visibility': visibility,
			'comment_status': comment_status,
			'password': password,
			'form_type': form_type	
		}, // serializes the form's elements.
		success: function(data)
		{
			if (data==1)
				notification("Validation error!", "red");
			if (data==2)
				notification("Password error!", "red");
			if (data==3){
				notification("Post save successfully!!", "green");
				$("#form_post")[0].reset();
				$('#editor').html('');
				$('#pass').css('display','none');
			}
			if (data==4)
				notification("Database error!", "red");
			if (data==5)
				notification("Post update successfully!", "green");
		}
	});
	e.preventDefault(); // avoid to execute the actual submit of the form.
});
//notification(window.location.href);
});
</script>

