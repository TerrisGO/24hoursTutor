<?php
require_once('db.php');
session_start();

$firstname ="";

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
  try {
    $email = $_POST["email"];
    $stmt_semail = $conn->prepare("SELECT * FROM student WHERE stud_email=:email AND stud_active ='1'");
    $stmt_temail = $conn->prepare("SELECT * FROM tutor WHERE t_email=:email AND t_active ='1'");
  
     $stmt_semail->bindParam(':email', $email, PDO::PARAM_STR);
     $stmt_temail->bindParam(':email', $email, PDO::PARAM_STR);
     $stmt_semail->execute();
     $stmt_temail->execute();

     $results1 = $stmt_semail-> fetch(PDO::FETCH_ASSOC);
     $results2 = $stmt_temail-> fetch(PDO::FETCH_ASSOC);

}
catch(PDOException $e){
    {
    echo "Error: " . $e->getMessage();
    }
}

    

if ($results1 >0 || $results2>0){


    if ($results1 >0){
      try {  

          $firstname = $results1['stud_fname'];
          $email = $results1['stud_email'];
          $usrn = $results1['stud_usrn'];
          sendForgetusrnMail($email,$firstname,$usrn);
          header('location: forgetusrn.php?success=1');
        }
        catch(PDOException $e)
        {
          echo "Error: " . $e->getMessage();
        }
        $conn = null;
        }

    if ($results2 >0){
      try {  

        $firstname = $results2['t_fname'];
        $email = $results2['t_email'];
        $usrn = $results2['t_usrn'];
        sendForgetusrnMail($email,$firstname,$usrn);
        header('location: forgetusrn.php?success=1');
      }
      catch(PDOException $e)
      {
        echo "Error: " . $e->getMessage();
      }
      $conn = null;
      }
    }
   if (!$results2 >0 && !$results1 >0){
    header('location:forgetusrn.php?fail=1');
   }
    
}else {
  echo "‌‌ ";
}


function sendForgetusrnMail($email,$firstname,$usrn){
  // Session message to display on success.php
  $_SESSION['message'] = "<p>Please check your email <span>$email</span>"
  . " for recover back your username!</p>";
  //$headers .= "Content-type: text/html";
  // Send registration confirmation link (reset.php)
  require_once("mail.php");
  $mail->setFrom('spammerking12345@gmail.com');
  $mail->isHTML(true);
  $mail->addAddress($email);
  $mail->Subject = 'Requesting Forgot Username ( 24HoursTutor.com )';
  $Msg = "<html><head> </head><body>";
  $Msg .= '<img src="https://i.imgur.com/S5QwiAE.pngg" style="width:180px; height:40px" title="24hrs Tutor" alt="24hrs Tutor"> </body></html>
  Hello '.$firstname.',

  You have requested to check your username!<br>

  Your Username is :'.$usrn.'

  http://localhost:8080/24t/loging.php';  
  //http://student.kdupg.edu.my/24hourstutor/24t/loging.php'; 

  $mail->Body = $Msg;
  $mail->send();
  //print_r(error_get_last());
}
?>

<!DOCTYPE html>
<html>
<head><link rel="icon" href="uploads/24t.jpeg" type="image/gif" sizes="16x16"> 
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/topbar.css">
<link rel="stylesheet" href="css/w3_2.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>24HoursTutor</title>
  <?php include 'css/css.html'; ?>
  <style>
    body {
    background-image: url("https://cdn-images-1.medium.com/max/1600/0*AhQ1F4hEelt6Zz6s.jpg");
    background-repeat: no-repeat;
    background-position: center bottom;
}
    </style>
</head>

<body>
<div class="w3-top">
  <div class="w3-bar w3-blue w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="map4.php" class="w3-bar-item w3-button w3-padding-large"><img src="24hrs2.png" style="width:180px; height:40px" title="24hrs Tutor" alt="24hrs Tutor"></a>
    <div class="topnav">
    <div class="login-container w3-hide-small">
    <form action="">
       <a href="registering.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Register</a>
              <a href="loging.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Login</a>
        <a href="reset.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">?</a>
    </form>
  </div></div>
    </div>
  </div></div>
  <div class="form">

    <h1>Recover Your Username</h1>

    <form action="forgetusrn.php" method="post">
     <div class="field-wrap">
      <label>
        Email Address<span class="req">*</span>
      </label>
      <input type="email"required autocomplete="off" name="email"/>
    </div>
    <button class="button button-block"/>Send to my Mail</button>
    <a href="reset.php">Click Here if ForgetPassword</a>
    </form>
    <?php
        if ( isset($_GET['success']) && $_GET['success'] == 1 )
          {
	        $msg = '<font color="white">Account validate, please go check your Email</font>';
          echo " <h3>$msg.<h3>";
        }
        if ( isset($_GET['fail']) && $_GET['fail'] == 1 )
        {
        $msg = '<font color="white">Sorry this email address is not exist</font>';
        echo " <h3>$msg.<h3>";
      }
    ?>

  </div>
          
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
</body>

</html>
