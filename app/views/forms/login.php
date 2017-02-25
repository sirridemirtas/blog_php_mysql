<script src="<?=ACTUAL_LINK?>js/jquery.1.11.1.js"></script>
<script src="<?=ACTUAL_LINK?>js/md5.min.js"></script>

<form action="<?=ACTUAL_LINK?>admin/login/check" method="post" style="width:14em;margin:auto">
	<input type="text" class="textbox username" name="username" placeholder="username" required><br>
	<input type="password" class="textbox pass" name="password" placeholder="password" required><br>
	<input type="submit" value="Log in" style="width:14em">
</form>
<?php //echo sha1(md5(md5("123"))); ?>
<script>
$(document).ready(function()
{

$('.username').focus();

$("form").submit(function(e)
{
	var username = $("[name='username']").val();
	var password = md5($("[name='password']").val());
	var url = '<?=ACTUAL_LINK?>admin/login/check';

	$('.username').focus();
	$('form')[0].reset();

	$.ajax({
			type: "POST",
			url: url,
			data:
			{ 
				'username': username,
				'password': md5(password)			
			},
			success: function(data)
			{
				if (!data) notification("You know nothing!", "red");
				else location.reload();
			}
		});
	e.preventDefault(); //avoid to execute the actual submit of the form.
});

});
</script>