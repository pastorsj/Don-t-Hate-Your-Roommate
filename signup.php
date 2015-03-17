<!DOCTYPE html>
<html>
	<!-- <form action = "" method = "post" onsubmit="return validateRegister()"> -->
	<label class="email" for="email">Enter Your Email</label>
	<br/>
	<input id = "registerEmail" type = "text" maxlength="30" name = "email" value = ""/>
	<br/>

	<label class="username" for="username">Enter Your Username</label>
	<br/>
	<input id = "registerUsername" type = "text" maxlength="30" name = "username" value = ""/>
	<br/>

	<label class="password" for="password">Enter a Password</label>
	<br/>
	<input id="registerPassword" type = "password" maxlength="30" name = "password" value = ""/>
	<br/>

	<label class="confirmpassword" for="confirmpassword">Confirm your Password</label>
	<br />
	<input id = "confirmPassword" type="password" maxlength="30" name = "confirmpassword" value = "">
	<br />

	<button type="submit" value="register" id="register-submit">
		Register
	</button>

	<div id="registerError" data-alert class="alert-box info radius" >
		Username or password is incorrect. <a href="#" class="close">&times;</a>
	</div>

	<div id="registerSuccess" data-alert class="alert-box success radius">
		<a href="#" class="close">&times;</a>
	</div>
	
	<button type="submit" value="register" id="register-close" style="display: none;">
		Close
	</button>

</html>