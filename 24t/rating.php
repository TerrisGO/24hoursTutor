<?php 
require_once('db.php');
session_start();
require_once("csrf.php");
$old_sessionid = session_id();
session_regenerate_id();

if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && isset($_SESSION["actype"])  )
 {  
  
    if ( isset($_GET['rate']) && !$_GET['rate'] == "" && ctype_digit($_GET['rate']))
    {
      //var_dump($_GET);
        if ($_SESSION["actype"] ==="student"){
            $stmt = $conn->prepare ("SELECT c.t_profilepic, c.t_lname,c.t_fname,`rating_id` FROM rating r ,tutor c WHERE `stud_id` = :id AND `rating_id` = :rate and`r_message` = '' AND c.tutor_id = r.tutor_id");
            $stmt->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
            $stmt->bindParam(':rate', $_GET['rate'], PDO::PARAM_STR);
            $stmt->execute();
            $take = $stmt->fetch();
            
            $count = $stmt->rowCount();
            
          //var_dump($stmt);
          if ($count == 0){
            header("location:login_success.php");
          }

        }else{
          header("location:login_success.php");
        }

    }

 }else{
  header("location:login_success.php");
}

  $new_sessionid = session_regenerate_id(true);

 ?>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="uploads/24t.jpeg" type="image/gif" sizes="16x16"> 
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<!--<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>-->
<!--<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"  media="screen"-->

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="css/starstyle.css">
<link rel="stylesheet" href="css/w3_2.css">

<style>

#hello1 {
	border-radius: 25px;
    border: 1px white;
    margin-top: 20px;
    margin-bottom: 100px;
    margin-right: 80px;
    margin-left: 10px;
    box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.05) inset, 0px 0px 8px rgba(82, 168, 236, 0.6);
}

  #hello {
	border-radius: 25px;
    border: 1px white;
    margin-top: 100px;
    margin-bottom: 100px;
    margin-right: 150px;
    margin-left: 80px;
    box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.05) inset, 0px 0px 8px rgba(82, 168, 236, 0.6);
}
#example1 {
    box-sizing: content-box;    
    width: 600px;
    height: 50px;
    padding: 30px;    
    border: 10px white;
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
  </style>
  </head>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">

<style>

body{ background:url(../background2.png); font: 30px;   margin: 20px;}
.clear{clear: both;}
.container{width: 400px; background-color:#fff; border:#ccc 1px solid; height:px;margin-right: 100px; padding: 40px; border-radius:10px; }

.rate{
	width:225px; height: 40px;
	border:#e9e9e9 1px solid;
	background-color:  #f6f6f6;
	margin-left: 1px;
	margin-top: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.rate .rate-btn{
	width: 45px; height:40px;
	float: left;
	background: url(rate-btn.png) no-repeat;
	cursor: pointer;
}
.rate .rate-btn:hover, .rate  .rate-btn-hover, .rate  .rate-btn-active{
	background: url(rate-btn-hover.png) no-repeat;
}

.rate-stars{
	width: 82px; height: 18px;
	background: url(rate-stars.png) no-repeat;
	position: absolute;
}
.rate-bg{
	height: 18px;
	background-color: #ffbe10;
	position: absolute;
}
#sub{
  background-color: #123a5d;
    border: none;
    color: white;
    padding: 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 12px
}

</style>

  <!-- Navbar -->
  <div class="w3-top">
  <div class="w3-bar w3-blue w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="map4.php" class="w3-bar-item w3-button w3-padding-large"><img src="24hrs2.png" style="width:180px; height:40px" title="24hrs Tutor" alt="24hrs Tutor"></a>
    <div class="topnav">
    <div class="login-container w3-hide-small">
    <form action="">
       <?php
       if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"])  
        {
          echo "<a href='login_success.php' class='w3-bar-item w3-button w3-padding-large w3-hide-small'>Main Menu</a>";
        }
       ?>
    </form>
  </div></div>
    </div>
  </div>
</div>
</div><br></br><br>
<center><H1><?php echo $take['t_fname']." ".$take['t_lname']; ?></H1></center>
<body><center>
<img src="uploads/<?php echo $take['t_profilepic']; ?>" alt="Avatar" style="border-radius: 50%;width: 120px; height: 120px"><br><br><br><br><br><br>
  <div class = "rate">

  <form action="rating_save.php" method="post">
  
<fieldset class="rating">
    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Good - 5 stars"></label>
    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Above Average - 4 stars"></label>
    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Average - 3 stars"></label>
    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Below Average- 2 stars"></label>
    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Bad - 1 star"></label>
</fieldset><br>
<textarea id="comments" name="comments" rows="10" cols="150"></textarea>
<input type="hidden" id="rate" name="rate" value="<?php echo $take['rating_id']; ?>">
<input type="hidden" name="csrf" value="<?php echo $csrf ?>">
<br><input  type="submit" id="sub"   value="Submit" name="submit" onclick="return RadioValidator();"></br></form>
</fieldset>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  </div>

</center>
  
</body>
<script>
function RadioValidator()
{
var off_payment_method = document.getElementsByName('rating');
var ischecked_method = false;
for ( var i = 0; i < off_payment_method.length; i++) {
    if(off_payment_method[i].checked) {
        ischecked_method = true;
        break;
    }
}
if(!ischecked_method)   { //payment method button is not checked
    alert("Please apply at least 1 star to the tutor.");
    return false;
}

}
</script>
</html>