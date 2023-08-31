
<?php
	//start a session
	session_start();
	require_once("csrf.php");
	  if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"])  
        {
			header("location: login_success.php");
        }else{
			
        }
?>

<!DOCTYPE html>
<html>
<head><link rel="icon" href="uploads/24t.jpeg" type="image/gif" sizes="16x16"> 
<title>24HoursTutor</title><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3_2.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<head><link rel="icon" href="../uploads/24t.jpeg" type="image/gif" sizes="16x16"> 
<style>
body {font-family: "Lato", sans-serif}
.mySlides {display: none}
.topnav .login-container {
  float: right;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
  width:120px;
}

.topnav .login-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background-color: #555;
  color: white;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .login-container button:hover {
  background-color: green;
}

@media screen and (max-width: 600px) {
  .topnav .login-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .login-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;  
  }
  
</style>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-blue w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
	<a href="map4.php" class="w3-bar-item w3-button w3-padding-large"><img src="24hrs2.png" style="width:180px; height:40px" title="24hrs Tutor" alt="24hrs Tutor"></a>
    <div class="topnav">
    <div class="login-container w3-hide-small">
    <form action="/action_page.php">
       <a href="registering.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Register</a>
              <a href="loging.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Login</a>
        <a href="reset.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">?</a>
    </form>
  </div></div>
    </div>
  </div>
</div>

<div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
<?php
       if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"])  
        {
          echo "<a href='login_success.php' class='w3-bar-item w3-button w3-padding-large'>Main Menu</a>";
        }else{
          echo "<a href='registering.php' class='w3-bar-item w3-button w3-padding-large'>Register</a>";
          echo "<a href='loging.php' class='w3-bar-item w3-button w3-padding-large'>Login</a>";
       echo "<a href='reset.php' class='w3-bar-item w3-button w3-padding-large'>?</a>";
        }
       ?>
</div>
<br><br><br>
<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:46px">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Register Your Accounts</h3>
</div>
<div class="panel-body">
<form id="signupForm1" method="post" class="form-horizontal" action="register1.php">
<div class="form-group">
<label class="col-sm-4 control-label" for="firstname1">First name</label>
<div class="col-sm-5">
<input type="text" class="form-control" id="firstname1" name="firstname1" placeholder="First name" />
</div>
</div>
<div class="form-group">
<label class="col-sm-4 control-label" for="lastname1">Last name</label>
<div class="col-sm-5">
<input type="text" class="form-control" id="lastname1" name="lastname1" placeholder="Last name" />
</div>
</div>
<div class="form-group">
<label class="col-sm-4 control-label" for="username1">Username</label>
<div class="col-sm-5">
<input type="text" class="form-control" id="username1" name="username1" placeholder="Username" />
</div>
</div>
<div class="form-group">
<label class="col-sm-4 control-label" for="email1">Email</label>
<div class="col-sm-5">
<input type="text" class="form-control" id="email1" name="email1" placeholder="Email" />
</div>
</div>
<div class="form-group">
<label class="col-sm-4 control-label" for="password1">Password</label>
<div class="col-sm-5">
<input type="password" class="form-control" id="password1" name="password1" placeholder="Password" />
</div>
</div>
<div class="form-group">
<label class="col-sm-4 control-label" for="confirm_password1">Confirm password</label>
<div class="col-sm-5">
<input type="password" class="form-control" id="confirm_password1" name="confirm_password1" placeholder="Confirm password" />
</div>
</div>
<div class="form-group">
<label class="col-sm-4 control-label" for="accountype">Account Type</label>
<div class="col-sm-5">
	<input type="radio" class="radio-inline" id="tutors" name="radio" value="tutors" />
            <label class="radio-inline" for="tutors">Tutors</label>
&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" class="radio-inline" id="student" name="radio" value="student" />
            <label class="radio-inline" for="student">Student</label>
</div>
</div>

<div class="form-group">
<div class="col-sm-5 col-sm-offset-4">
<div class="checkbox">
<label>
<input type="checkbox" id="agree1" name="agree1" value="agree" />Please agree to our <a href="policy.php">Terms & Conditions</a>
</label>
</div>
<input type="hidden" name="csrf" value="<?php echo $csrf ?>">
</div>
</div>
<div class="form-group">
<div class="col-sm-9 col-sm-offset-4">
<button type="submit" class="btn btn-primary" name="signup1" value="Sign up">Sign up</button>
<?php
if ( isset($_GET['success']) && $_GET['success'] == 1 )
{
	$msg = 'Your account was created successfully, please go active by Email before login';
     echo "<br>Success<br>  <h3>$msg.<h3>";
}
if ( isset($_GET['fail']) && $_GET['fail'] == 1 )
{
	$msg = 'Your account not created, please user other email address';
     echo "<br>Sorry  <br>  <h3>$msg.<h3>";
}
if ( isset($_GET['fail']) && $_GET['fail'] == 2 )
{
	$msg = 'Your account not created, please user other username';
     echo "<br>Sorry  <br>  <h3>$msg.<h3>";
}
if ( isset($_GET['fail']) && $_GET['fail'] == 3 )
{
	$msg = 'Your account not created, please user other username and email address';
     echo "<br>Sorry  <br>  <h3>$msg.<h3>";
}

?>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
<br><br><br><br>
<script type="text/javascript">
		$.validator.setDefaults( {
			submitHandler: function () {
				$('#signupForm1').submit();
			}
		} );

		$( document ).ready( function () {
			$( "#signupForm" ).validate( {
				rules: {
					firstname: "required",
					lastname: "required",
					username: {
						required: true,
						minlength: 5
					},
					password: {
						required: true,
						minlength: 5
					},
					confirm_password: {
						required: true,
						minlength: 5,
						equalTo: "#password"
					},
					email: {
						required: true,
						email: true
					},
					agree1: {required: true},
                    radio:{ required:true }
				},
				messages: {
					firstname: "Please enter your firstname",
					lastname: "Please enter your lastname",
					username: {
						required: "Please enter a username",
						minlength: "Your username must consist of at least 2 characters"
					},
					password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 5 characters long"
					},
					confirm_password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 5 characters long",
						equalTo: "Please enter the same password as above"
					},
					email: "Please enter a valid email address",
					agree1: "Please accept our policy"
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
				}
			} );

			$( "#signupForm1" ).validate( {
				rules: {
					firstname1: "required",
					lastname1: "required",
					username1: {
						required: true,
						minlength: 2
					},
					password1: {
						required: true,
						minlength: 5
					},
					confirm_password1: {
						required: true,
						minlength: 5,
						equalTo: "#password1"
					},
					email1: {
						required: true,
						email: true
					},
					agree1: "required",
                    radio:"required"
				},
				messages: {
					firstname1: "Please enter your firstname",
					lastname1: "Please enter your lastname",
					username1: {
						required: "Please enter a username",
						minlength: "Your username must consist of at least 2 characters"
					},
					password1: {
						required: "Please provide a password",
						minlength: "Your password must be at least 5 characters long"
					},
					confirm_password1: {
						required: "Please provide a password",
						minlength: "Your password must be at least 5 characters long",
						equalTo: "Please enter the same password as above"
					},
					email1: "Please enter a valid email address",
                    radio:"Choose one account type"
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".col-sm-5" ).addClass( "has-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}

					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !element.next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
				success: function ( label, element ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !$( element ).next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
					$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
					$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );
		} );
	</script>
  
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
  <a href="mailto:24hrstutors@gmail.com"><i class="fa fa-envelope w3-hover-opacity" ></i></a>
  <a href="https://www.instagram.com/24hrstutor"><i class="fa fa-instagram w3-hover-opacity"></i></a>
  <a href="https://twitter.com/24hrsTutor"><i class="fa fa-twitter w3-hover-opacity"></i></a>
  <p class="w3-medium">Designed by 5am.kdupg</p>
</footer>

</body>
</html>
