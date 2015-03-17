<!DOCTYPE html>
<html>
	<head>
		<link href = "login.css" type = "text/css" rel = "stylesheet" />
	</head>
		<label class = "login" for="Username">Username</label>
		<br/>
		<input id = "username" type = "text" name = "Username" maxlength="30" value = ""/>
		<br/>
		<label class = "login" for="password">Password</label>
		<br/>
		<input  id = "password" type = "password" name = "Password" maxlength="30" value = ""/>
		<br/>
		<button type="submit" value="login" id="login-submit">
			Log In
		</button>
		<div id="errors" data-alert class="alert-box info radius" > Username or password is incorrect.
			<a href="#" class="close">&times;</a>
		</div>
</html>