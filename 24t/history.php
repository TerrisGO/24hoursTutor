<?php

require_once('db.php'); 
 session_start();
 require_once("csrf.php");
 $old_sessionid = session_id();
 $new_sessionid = session_regenerate_id(true);

 if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && isset($_SESSION["actype"]))  
 { 
     if ($_SESSION["actype"] ==="tutor"){
        $Q = $conn->prepare('SELECT t.stud_fname, t.stud_lname,  c.payment_id ,c.paytime, c.stud_id,c.sub_name,c.bookingdate,c.appoint_hrs,c.status ,c.cancel_reason FROM payment_info c, student t WHERE  `tutor_id` = :id AND c.stud_id = t.stud_id AND `status` !="pending" ORDER BY paytime desc');
        $Q->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
        $Q->execute();
        $count = $Q->rowCount();
        $result = $Q->fetchAll();
     }
     if ($_SESSION["actype"] ==="student"){
        $Q = $conn->prepare('SELECT t.t_fname, t.t_lname,  c.payment_id ,c.paytime, c.tutor_id,c.sub_name,c.bookingdate,c.appoint_hrs,c.status ,c.cancel_reason FROM payment_info c, tutor t WHERE   `stud_id` = :id AND c.tutor_id = t.tutor_id AND `status` !="pending" ORDER BY paytime desc');
        $Q->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
        $Q->execute();
        $count = $Q->rowCount();
        $result = $Q->fetchAll();
    }
        //print_r($result);
       // echo $count;
} else  
{  
     session_destroy();
     header("location:loging.php");  
}


?>


<!DOCTYPE html>
<html lang="en" >

<head><link rel="icon" href="uploads/24t.jpeg" type="image/gif" sizes="16x16"> 
  <meta charset="UTF-8">
  <title>24HoursTutor</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3_2.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<head><link rel="icon" href="../uploads/24t.jpeg" type="image/gif" sizes="16x16"> 
      <style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      /* Variables */
/* Fonts */
@import url(https://fonts.googleapis.com/css?family=Open+Sans:300,700);
.button4 {
    background-color: white;
    color: black;
    border: 2px solid #e7e7e7;
}

.button4:hover {background-color: #e7e7e7;}
body {
  font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
  font-size: 1em;
  font-weight: 300;
  line-height: 1.5;
  letter-spacing: 0.05em;
}

/* Layout */
* {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

/* Styling */
.timeline {
  margin: 4em auto;
  position: relative;
  max-width: 46em;
}
.timeline:before {
  background-color: black;
  content: '';
  margin-left: -1px;
  position: absolute;
  top: 0;
  left: 2em;
  width: 2px;
  height: 100%;
}

.timeline-event {
  position: relative;
}
.timeline-event:hover .timeline-event-icon {
  -moz-transform: rotate(-45deg);
  -ms-transform: rotate(-45deg);
  -webkit-transform: rotate(-45deg);
  transform: rotate(-45deg);
  background-color: #a83279;
}
.timeline-event:hover .timeline-event-thumbnail {
  -moz-box-shadow: inset 40em 0 0 0 #a83279;
  -webkit-box-shadow: inset 40em 0 0 0 #a83279;
  box-shadow: inset 40em 0 0 0 #a83279;
}

.timeline-event-copy {
  padding: 2em;
  position: relative;
  top: -1.875em;
  left: 4em;
  width: 80%;
}
.timeline-event-copy h3 {
  font-size: 1.75em;
}
.timeline-event-copy h4 {
  font-size: 1.2em;
  margin-bottom: 1.2em;
}
.timeline-event-copy strong {
  font-weight: 700;
}
.timeline-event-copy p:not(.timeline-event-thumbnail) {
  padding-bottom: 1.2em;
}

.timeline-event-icon {
  -moz-transition: -moz-transform 0.2s ease-in;
  -o-transition: -o-transform 0.2s ease-in;
  -webkit-transition: -webkit-transform 0.2s ease-in;
  transition: transform 0.2s ease-in;
  -moz-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -webkit-transform: rotate(45deg);
  transform: rotate(45deg);
  background-color: black;
  outline: 10px solid white;
  display: block;
  margin: 0.5em 0.5em 0.5em -0.5em;
  position: absolute;
  top: 0;
  left: 2em;
  width: 1em;
  height: 1em;
}

.timeline-event-thumbnail {
  -moz-transition: box-shadow 0.5s ease-in 0.1s;
  -o-transition: box-shadow 0.5s ease-in 0.1s;
  -webkit-transition: box-shadow 0.5s ease-in;
  -webkit-transition-delay: 0.1s;
  transition: box-shadow 0.5s ease-in 0.1s;
  color: white;
  font-size: 1.29em;
  background-color: black;
  -moz-box-shadow: inset 0 0 0 0em #ef795a;
  -webkit-box-shadow: inset 0 0 0 0em #ef795a;
  box-shadow: inset 0 0 0 0em #ef795a;
  display: inline-block;
  margin-bottom: 1.2em;
  padding: 0.25em 1em 0.2em 1em;
}
table thead { font-size: 20px;text-align: center; text-shadow: 3px 2px gold; }
    td 
    {
    text-align: center;
    height: 50px; 
    width: 50px;
    }
    .table{
        -webkit-box-shadow: 10px 10px 20px -4px rgba(0,0,0,0.75);
-moz-box-shadow: 10px 10px 20px -4px rgba(0,0,0,0.75);
box-shadow: 10px 10px 20px -4px rgba(0,0,0,0.75);
    }
    body {
    background-image: url("http://yesofcorsa.com/wp-content/uploads/2017/09/Breeze-Best-Wallpaper.jpg");
    background-repeat: repeat;
    width:100%; height:100%;
}
#tb {
    left: 50%;
    top: 50%;
    position: absolute;
    -webkit-transform: translate3d(-50%, -50%, 0);
    -moz-transform: translate3d(-50%, -50%, 0);
    transform: translate3d(-50%, -50%, 0);
}
.thumbnail{
    margin-left: auto;
    margin-right: auto;
    width: 100%;
}
.thumbnail:hover {
    position:relative;
    top:-5px;
    left:-5px;
    width:200px;
    height:auto;
    display:block;
    z-index:999;
}
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>
<script>
				// Used to toggle the menu on small screens when clicking on the menu button
        function myFunction() {
					var x = document.getElementById("navDemo");
					if (x.className.indexOf("w3-show") == -1) {
							x.className += " w3-show";
					} else { 
							x.className = x.className.replace(" w3-show", "");
					}
			}

			// When the user clicks anywhere outside of the modal, close it
			var modal = document.getElementById('ticketModal');
			window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
				}
			}
</script>
<body>
  <!-- Navbar -->
<br><br><br>
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
</div>

<div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
<?php
       if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"])  
        {
          echo "<a href='login_success.php' class='w3-bar-item w3-button w3-padding-large'>Main Menu</a>";
        }
       ?>
</div>



<br><br>

  <ul class="timeline">
    <?php 

    if($count > 0){
      
         foreach ($result as $row) {  
           if ($_SESSION['actype']==="tutor"){
            $resName = $row['stud_fname'].' '.$row['stud_lname']; 
            $miao = "";
           }else{
             $resName = $row['t_fname'].' '.$row['t_lname']; 
             $miao = "<a href='receipt.php?pyid=".$row['payment_id']."'><button type='button' class='button button4'>Info</button></a>";
           }
                              
  echo "<li class='timeline-event'>
    <label class='timeline-event-icon'></label>
    <div class='timeline-event-copy'>
      <p class='timeline-event-thumbnail'>".$row['bookingdate']."- ".$row['status']."</p>
      <h3>$resName</h3>
      <h4>Subject: ".$row['sub_name']."</h4>
      <p><strong>Paid Time: ".$row['paytime']."</strong><br>".$row['cancel_reason']."</p>
      ".$miao."
    </div>
  </li>";
         }
    }else {
      echo '
          <H1  align="center">No Booking Record Yet</H1><br> 
          <center><Button class="button"   onclick="history.back(-1)" />Go Back</center>
      ';
     } ?>
</ul>
  
  

</body>

</html>
