<?php
require_once('db.php');
session_start();
 $accounttype ="";
if( isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['hash']) && !empty($_GET['hash']) )
{
    $email = $_GET['email']; 
    $hash = $_GET['hash']; 
    try {

        $stmt_semail = $conn->prepare("SELECT * FROM student WHERE stud_email=:email AND stud_hash=:hash AND stud_active='1'");
        $stmt_temail = $conn->prepare("SELECT * FROM tutor WHERE t_email=:email AND t_hash=:hash AND t_active='1'");
      
         $stmt_semail->bindParam(':email', $email, PDO::PARAM_STR);
         $stmt_semail->bindParam(':hash', $hash, PDO::PARAM_STR);

         $stmt_temail->bindParam(':email', $email, PDO::PARAM_STR);
         $stmt_temail->bindParam(':hash', $hash, PDO::PARAM_STR);

         $stmt_semail->execute();
         $stmt_temail->execute();
         $results1 = $stmt_semail-> fetch();
         $results2 = $stmt_temail-> fetch();
         if ($results1==0 && $results2==0){
            header('location: error.php');
         }
    }
    catch(PDOException $e){
        {
        echo "Error: " . $e->getMessage();
        }
    }
   
    if ($results1 >0){
        $accounttype ="student";
    }
    if ($results2 >0){
        $accounttype ="tutor";
    }
    if ($hash =="" || $email ==""){
        header('location: error.php');
    }
}
else {
    $_SESSION['message'] = "Sorry, verification failed, try again!";
    header("location: error.php");  
}


?>

<!DOCTYPE html>
<html >
<head><link rel="icon" href="uploads/24t.jpeg" type="image/gif" sizes="16x16"> 
  <meta charset="UTF-8">
  <title>24HoursTutor</title>
  <?php include 'css/css.html'; ?>
</head>
<link rel="stylesheet" href="css/w3_2.css">
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
</style>
<body>
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
<br><br><br><br><br><br><br><br>
    <div class="form">

          <h1>Choose Your New Password</h1>
          
          <form action="reset_password.php" method="post">
              
          <div class="field-wrap">
            <label>
              New Password<span class="req">*</span>
            </label>
            <input type="password"required name="newpassword" autocomplete="off"/>
          </div>
              
          <div class="field-wrap">
            <label>
              Confirm New Password<span class="req">*</span>
            </label>
            <input type="password"required name="confirmpassword" autocomplete="off"/>
          </div>
          
          <!-- This input field is needed, to get the email of the user -->
          <input type="hidden" name="email" value="<?= $email ?>">    
          <input type="hidden" name="hash" value="<?= $hash ?>">    
          <input type="hidden" name="actype" value="<?= $accounttype ?>">    
          <button class="button button-block"/>Apply</button>
          
          </form>

    </div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>