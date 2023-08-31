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
body {
    background-image: url("https://i.imgur.com/EGrlzlM.jpg");
    background-repeat: no-repeat;
    background-position: center bottom;/*https://i.imgur.com/I3CMFwk.jpg*/
}
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
  .w3-blue, .w3-hover-blue:hover {
    color: #fff!important;
    background-color: #123a5d!important;
}
a {
    color: white;
    text-decoration: none;
}
</style>
<body>
<br><br><br><br><br><br><br><br><br>
<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-blue w3-card ">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="map4.php" class="w3-bar-item w3-button w3-padding-large"><img src="24hrs2.png" style="width:180px; height:40px" title="24hrs Tutor" alt="24hrs Tutor"></a>
    <div class="topnav">
    <div class="login-container w3-hide-small">
    <form action="">
       
        <?php
        if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"])  
        {
          echo "<a href='login_success.php' class='w3-bar-item w3-button w3-padding-large w3-hide-small'>Main Menu</a>";
        }else{
          echo "<a href='registering.php' class='w3-bar-item w3-button w3-padding-large w3-hide-small'>Register</a>";
          echo "<a href='loging.php' class='w3-bar-item w3-button w3-padding-large w3-hide-small'>Login</a>";
          echo "<a href='reset.php' class='w3-bar-item w3-button w3-padding-large w3-hide-small'>?</a>";
        }
        ?>
    </form>
  </div></div>
    </div>
  </div>
</div>

<!-- Navbar on small screens (remove the onclick attribute if you want the navbar to always show on top of the content when clicking on the links) -->
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

<!-- Page content -->
<div class="w3-content w3-opacity-min" style="max-width:1100px;margin-top:46px">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Login</h3>
</div>
<div class="panel-body">
<form id="signupForm1" method="post" class="form-horizontal" action="logintest.php">
<div class="form-group">
<label class="col-sm-4 control-label" for="username1">Username</label>
<div class="col-sm-5">
<input type="text" class="form-control" id="username1" name="username1" placeholder="Username" />
</div>
</div>
<div class="form-group">
<label class="col-sm-4 control-label" for="password1">Password</label>
<div class="col-sm-5">
<input type="password" class="form-control" id="password1" name="password1" placeholder="Password" />
</div>
<input type="hidden" name="csrf" value="<?php echo $csrf ?>">
</div>
<div class="form-group">
<div class="col-sm-9 col-sm-offset-4">
<button type="submit" class="btn btn-primary" name="login" value="Sign up">Sign In</button>
  <a href="reset.php" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">Forget</a>
  <a href="admin/admin.php" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">Admin</a>
</div>
</div>
</form>
<?php
if ( isset($_GET['fail']) && $_GET['fail'] == 1 )
{
	$msg = 'Username or Password does not exist';
     echo "<br>Sorry  <br>  <h3>$msg.<h3>";
}
?>
</div>
</div>
</div>
</div>
</div>
<br><br><br><br>
<script type="text/javascript">
		$.validator.setDefaults( {
			submitHandler: function () {
				alert( "submitted!" );
			}
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
