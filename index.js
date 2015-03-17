'use strict';

window.onload = function() {

	$("#errors").hide();
	$("#registerError").hide();
	$("#registerSuccess").hide();
	$("#register-close").hide();

	// 	On click for login.
	$('#login-submit').click(validateLogin);
	$('#register-submit').click(validateRegister);
	
	$('#register-close').click(function() {
		$('#loginTable').foundation('reveal', 'close');
	});
	
	$('#register').click(function() {
		$("#register-submit").show();
	});

	var login = document.getElementById("loginTable");
	if (login != null) {
		login.onclose = function() {
			$("#errors").hide();
			$("#registerError").hide();
			$("#registerSuccess").hide();
			$("#register-close").hide();
		};
	}

	var register = document.getElementById("registerTable");
	if (register != null) {
		register.onclose = function() {
			$("#errors").hide();
			$("#registerError").hide();
			$("#registerSuccess").hide();
			$("#register-close").hide();
		};
	}

	// 	Jumbotron properties
	var jumbotron = $('.jumbotron');
	if (jumbotron != null) {
		$(document).ready(function() {
			jumbotron.slick({
				dots : true,
				infinite : true,
				arrows : true,
				accessibility : true,
				speed : 500,
				autoplay : true,
				slidesToShow : 1,
				slidesToScroll : 1
			});
		});
	}

	// 	Foundation properties
	$(document).foundation({
		tab : {
			toggleable : false
		}
	});

	var board = document.getElementById("content");

	var loginButton = document.getElementById("login");
	if (loginButton != null) {
		document.getElementById("login").onclick = function() {
			document.getElementById("registerTable").style.display = "none";
			document.getElementById("loginTable").style.display = "initial";
		};
	}
	var registerButton = document.getElementById("register");
	if (registerButton != null) {
		document.getElementById("register").onclick = function() {
			document.getElementById("loginTable").style.display = "none";
			document.getElementById("registerTable").style.display = "initial";
		};
	}
};

var validateLogin = function() {
	var uname = $('#username').val();
	var password = $('#password').val();

	if (uname.length == 0) {
		$("#errors").html("Username is required.");
		$("#errors").css("display", "block");
		return;
	}

	if (password.length == 0) {
		$("#errors").html("Password is required.");
		$("#errors").css("display", "block");
		return;
	}

	$.ajax({
		url : '/loginValidation.php',
		type : 'POST',
		data : "Username=" + uname + "&Password=" + password,
		dataType : 'text',
		success : function(data) {
			var res = JSON.parse(data);
			if (res.code == 1) {
				$("#errors").html("Username or password is incorrect");
				$("#errors").css("display", "block");
			} else if (res.code == 0) {
				window.location = "http://sassyladies.csse.rose-hulman.edu/home.php";
			}
		}
	});
};

var validateRegister = function() {
	
	$("#register-submit").show();

	var email = $('#registerEmail').val();
	var uname = $('#registerUsername').val();
	var password = $('#registerPassword').val();
	var confirmPass = $('#confirmPassword').val();
	var regex = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;

	if (email.length == 0) {
		$("#registerError").html("An Emaill address is required.");
		$("#registerError").css("display", "block");
		return;
	}

	if (uname.length == 0) {
		$("#registerError").html("Username is required.");
		$("#registerError").css("display", "block");
		return;
	}

	if (password.length == 0) {
		$("#registerError").html("Password is required.");
		$("#registerError").css("display", "block");
		return;
	}

	if (password !== confirmPass) {
		$("#registerError").html("Passwords do not match!");
		$("#registerError").css("display", "block");
		return;
	}

	if (String(email).match(regex) == null) {
		$("#registerError").html("The email you have entered is invalid, please try again.");
		$("#registerError").css("display", "block");
		return;
	}
	
	$.ajax({
		url : 'signupValidation.php',
		type : 'POST',
		data : "email=" + email + "&username=" + uname + "&password=" + password + "&confirmpassword=" + confirmPass,
		dataType : 'text',
		success : function(data) {
			var res = JSON.parse(String(data));

			if (res.code == 1) {
				$("#registerError").html("The email is already taken, please try a new email.");
				$("#registerError").css("display", "block");
			} else if(res.code == 2) {
				$("#registerError").html("The username is already taken, please try again.");
				$("#registerError").css("display", "block");
			} else {
				$("#register-submit").css("display", "none");
				$("#registerSuccess").html("Registration successful. Please check your email to activate your account.");
				$("#registerSuccess").css("display", "block");
				$("#register-close").css("display", "block");
			}
		},
		error : function(data) {
			console.log("failed");
		}
	});
};
