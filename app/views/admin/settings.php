<style>
table{
	
}
tr,td,th,table{
	box-shadow: none;
	border:0;
	padding:0;
}
input[type="text"],input[type="password"]{
	border:0;
}
input:disabled{
	background-color:transparent;
	opacity: .8;
}
table a{
	border:0;
	xfont-size: 61%;
}
.form_user input, .tbl_password sinput{
	
}
</style>
<style>

</style>

<table>
	<tr>
		<td>
			<h2>Usual</h2><br>
		</td>
	</tr>
	<tr>
		<td>Site Title</td>
		<td>
			<input type="text" name="" value="Lorem Ipsum" placeholder="site title" required>
		</td>
	</tr>
	<tr>
		<td>Comment Moderation</td>
		<td>
			<label class="switch">
				<input type="checkbox" checked>
				<div class="slider round"></div>
			</label>
		</td>
	</tr>


	<tr>
		<td>
			<br><h2>Posts</h2><br>
		</td>
	</tr>
	<tr>
		<td>Comments</td>
		<td>
			<label class="switch">
				<input type="checkbox" checked>
				<div class="slider round"></div>
			</label>
		</td>
	</tr>
	<tr>
		<td>Ipsum</td>
		<td>
			<label class="switch">
				<input type="checkbox">
				<div class="slider round"></div>
			</label>
		</td>
	</tr>

	<form class="form_user" action="" method="post">

		<tr>
			<td>
				<br><h2>User</h2><br>
			</td>
			<td>
				<a href="javascript:void(0)" class="btn_form_user_edit" onclick="form_user()">Edit</a>
				<a href="javascript:void(0)" class="btn_form_user_cancel"onclick="form_user_cancel()" style="display: none;">Cancel</a>
			</td>
		</tr>

		<tr>
			<td>Name</td>
			<td>
				<input class="name" type="text" name="name" id="" placeholder="name" value="<?=$data['name']?>" required>
			</td>
		</tr>
		<tr>
			<td>Username</td>
			<td>
				<input class="username" type="text" name="username" id="" placeholder="username" value="<?=$data['username']?>" required>
			</td>
		</tr>
		<tr>
			<td>E-mail</td>
			<td>
				<input class="email" type="text" name="email" id="" placeholder="e-mail" value="<?=$data['email']?>" required>
			</td>
		</tr>
		<tr class="form_user_hidden">
			<td><br>Password</td>
			<td><br><input class="form_user_pass" type="password" name="" id="" placeholder="password" value="" required></td>
		</tr>
		<tr class="form_user_hidden">
			<td></td>
			<td><br><input class="form_user_submit" type="submit" value="Save"></td>
		</tr>

		<input type="hidden" name="form_user">

	</form>

	<form class="tbl_pass" action="" method="post">
		<input type="hidden" name="form_pass">

		<tr>
			<td>
				<br><h2>Password</h2><br>
			</td>
			<td>
				<a href="javascript:void(0)" class="btn_form_pass_enable" onclick="form_pass_enable()">Edit</a>
				<a href="javascript:void(0)" class="btn_form_pass_disable" onclick="form_pass_disable()">Cancel</a>
			</td>
		</tr>
		
		<tr>
			<td>Password</td>
			<td>
				<input type="password" name="pass" class="pass_i pass" placeholder="password" value="" required>
			</td>
		</tr>
		<tr>
			<td>New Password</td>
			<td>
				<input type="password" name="new_pass" class="pass_i new_pass" placeholder="new password" required>
			</td>
		</tr>
		<tr>
			<td>Confirm New Password</td>
			<td>
				<input type="password" name="new_pass_repeat" class="pass_i new_pass_repeat" placeholder="confirm" required>
			</td>
		</tr>
		<tr class="tbl_pass_hidden">
			<td></td>
			<td><br><input class="btn_save_pass" type="submit" value="Save"></td>
		</tr>
	</form>

	<tr>
		<td colspan="2"><br><h2>Security</h2><br></td>
	</tr>
	<tr>
		<td colspan="2"><a href="javascript:void(0)">Disable site</a></td>
	</tr>
	<tr>
		<td colspan="2"><a href="javascript:void(0)">Permanently delete all post and data</a></td>
	</tr>

</table>


<script>
//$(document).ready(function() {

	$(".name, .username, .email, .form_user_pass, .form_user_submit").prop('disabled', true);

	var name = $("input.name").val();
	var username = $("input.username").val();
	var email = $("input.email").val();

	function form_user() {
		$('.name, .username, .email').prop('disabled', false);
		$('.form_user_hidden').css("display","table-row");
		$('.btn_form_user_edit').css("display", "none");
		$('.btn_form_user_cancel').css("display", "inherit");
	}
	function form_user_cancel() {
		$(".name, .username, .email, .form_user_pass, .form_user_submit").prop('disabled', true);
		$('.form_user_hidden').css("display","none");
		$('.btn_form_user_edit').css("display", "inherit");
		$('.btn_form_user_cancel').css("display", "none");

		$("input.name").val(name);
		$("input.username").val(username);
		$("input.email").val(email);

		$("input.form_user_pass").val("");
	}
	$(".name, .username, .email").keypress(function () {
		if ($("input.name").val()==name && $("input.username").val()==username && $("input.email").val()==email){
			$(".form_user_pass, .form_user_submit").prop('disabled', true);
		}
		else {$(".form_user_pass, .form_user_submit").prop('disabled', false);}
	});
	

	$(".pass, .new_pass, .new_pass_repeat, .btn_form_pass_disable").prop('disabled', true);
	function form_pass_enable() {
		$(".pass, .new_pass, .new_pass_repeat, .btn_form_pass_disable").prop('disabled', false);
	}
	function form_pass_disable() {
		$(".pass, .new_pass, .new_pass_repeat, .btn_form_pass_enable").prop('disabled', true);
		$(".pass, .new_pass, .new_pass_repeat").val('');
	}

	$(".tbl_pass").submit(function(e) {

		var pass = md5($('.pass').val());
		var new_pass = md5($('.new_pass').val());
		var new_pass_repeat = md5($('.new_pass_repeat').val());

		var url = window.location.href; // the script where you handle the form input.

		$.ajax({
			type: "POST",
			url: url,
			data: { 
				'form_pass': true,
				'pass': pass, 
				'new_pass': new_pass, 
				'new_pass_repeat': new_pass_repeat,
			}, // serializes the form's elements.
			success: function(data)
			{
				if (data==1) {
					notification("Your password has been changed successfully!", "green");
					form_pass_disable();
					
				}
				if (data==2){
					notification("Password does not match the confirm password!", "red");
				}

				if (data==3)
					notification("Error!", "red");
			}
			});

			e.preventDefault(); // avoid to execute the actual submit of the form.
		});


	$('.pass_i').keypress(function() {
		// if ( $('.new_pass').val() || $('.new_pass_repeat').val() || $('.pass').val())
		// {
			if ($('.new_pass').val() == $('.new_pass_repeat').val())
			{
				$('.tbl_pass_hidden').css("display","table-row");
			}else{
				//$('.btn_save_pass').prop('disabled', true);
			}
		// }
		$('.btn_save_pass').click(function () {
			if ( $('.new_pass').val() == $('.new_pass_repeat').val())
			{
				var r = 0; 
				switch(r) {
					case 1:
						notification("Wrong password!", "red");
						$('.pass').val("");
						break;
					case 1:
						notification("Password changed!", "green");
						$('.pass_i').val("");
						break;
					case 2:
						notification("Passwords do not match!", "red");
						break;
					/*default:
						code block*/
				}
			}else{
				notification("Passwords do not match!", "red");
			}
		});
		
	});



//});
</script>