<?php

require_once('db.php'); 
session_start();
require_once("checkbook.php"); 
require_once("csrf.php");
$old_sessionid = session_id();
session_regenerate_id(); 


if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"])  
 { 

    try {
       
     if ($_SESSION["actype"] ==="tutor"){
      $stmt = $conn->prepare("SELECT  c.stud_id , c.stud_fname , c.stud_lname , c.stud_profilepic FROM favourite d , student c WHERE d.tutor_id = :id AND c.stud_id = d.stud_id Order BY `fav_id` DESC");
      $stmt->bindParam(':id',$_SESSION["identity"], PDO::PARAM_STR);
      $stmt->execute();
      }
     if ($_SESSION["actype"] ==="student"){
        $stmt = $conn->prepare("SELECT c.t_job , c.tutor_id , c.t_fname , c.t_lname , c.t_profilepic FROM favourite d , tutor c WHERE d.stud_id = :id AND c.tutor_id = d.tutor_id Order BY `fav_id` DESC");
        $stmt->bindParam(':id',$_SESSION["identity"], PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetchAll();
       // var_dump($stmt);
       // print_r($res);
      }
    }
    catch(PDOException $e){
        {
        echo "Error: " . $e->getMessage();
        }
    }

}else{
    //echo "second else";
    //var_dump($_POST);
    header("location:noresults.php"); 
  }


$new_sessionid = session_regenerate_id(true);
?>
  

<html>
<head><link rel="icon" href="uploads/24t.jpeg" type="image/gif" sizes="16x16"> </head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--below link is bootstrap For drop down select-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
<link rel="stylesheet" href="css/topbar.css">
<link rel="stylesheet" href="css/w3_2.css">
<style>


table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
img {
    border-radius: 20%;
}
.box {
  background-color: #444;
  color: #fff;
  border-radius: 10px;
  padding: 5px;
  font-size: 150%;
}

.box:nth-child(even) {
  background-color: #ccF;
  color: #000;
}
    .wrapper {
    display: grid;
    border:1px solid #FFF;
    grid-gap: 5px;
    grid-template-columns: repeat(auto-fill, minmax(100px,1fr) minmax(200px,2fr));
    }
/****Table****/
</style>
<link rel="stylesheet" href="css/userdash.css">
<link rel="stylesheet" href="css/slidebar.css">
<script>
function sliderChange(val) {
	// Use Ajax post to send the adjusted value to PHP or MySQL storage
	document.getElementById('sliderStatus').innerHTML = val;
}
</script>
<link rel="stylesheet" href="css/bootstrap-select.css">
<link rel="stylesheet" href="css/slidebar.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<!-- Navbar -->
<br><br>
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
          echo "<a href='logout.php' class='w3-bar-item w3-button w3-padding-large w3-hide-small'>SignOut</a>";
        }
       ?>
    </form>
  </div></div>
    </div>
  </div>
</div>

<div class="container">
<div class="row">
    <div class="col-sm-3">
    
        <ul class="nav nav-pills nav-stacked nav-email shadow mb-20">
            <li class="active">
                <a href="login_success.php">
                    <i class="fa fa-inbox"></i> <?php echo $_SESSION["firstname"]." ".$_SESSION["lastname"];?> <!--span class="label pull-right">7</span-->
                </a>
            </li> 
            <li>
                <a href="searching.php"><i class="fa fa-search"></i> Searching</a>
            </li>
            <?php
                $value ="<span class='badge pull-right'>$countotal</span>";
                if ($_SESSION['actype'] ==='tutor'){
                    echo "<li><a href='setcourse.php'><i class='fa fa-sliders'></i>Set course</a></li>";
                    echo "<li><a href='match.php'><i class='fas fa-chalkboard-teacher'></i>Match$value</a></li>";
                }else{
                    echo "<li><a href='match.php'><i class='fas fa-chalkboard-teacher'></i>Match$value</a></li>";
                }
                ?>
            <li>
                <a href="calendar.php"> <i class="fa fa-calendar-o"></i> Schedule</a></li>
             <li>
             <li>
                <a href="history.php">
                    <i class="fas fa-history"></i> History <!--span class="label label-info pull-right inbox-notification">35</span-->
                </a>
            </li>
           
        </ul><!-- /.nav -->
    </div>
    <div class="col-sm-9">

        <!--  statitics -->
        <div class="row">
            <div class="col-lg-3">
            	<div class="panel panel-info">
        			<div class="panel-heading">
        				<div class="row">
        					<div class="col-xs-6">
        						<i class="fa fa-envelope-o fa-5x"></i>
        					</div>
        					<div class="col-xs-6 text-right">
        						<p class="announcement-heading label label-success"><?=$countotal2?></p>
        					<!--	<p class="announcement-text">Users</p> -->
        					</div>
        				</div>
        			</div>
        			<a href="chat.php">
        				<div class="panel-footer announcement-bottom">
        					<div class="row">
        						<div class="col-xs-6">
        							Messages
        						</div>
        						<div class="col-xs-6 text-right">
        							<i class="fa fa-arrow-circle-right"></i>
        						</div>
        					</div>
        				</div>
        			</a>
        		</div>
        	</div>
        	<div class="col-lg-3">
        		<div class="panel panel-warning">
        			<div class="panel-heading">
        				<div class="row">
        					<div class="col-xs-6">
        						<i class="fa fa-thumbs-up fa-5x"></i>
        					</div>
        					<div class="col-xs-6 text-right">
        						<p class="announcement-heading  label label-success"><?=$countotal3?></p>
        						<!-- <p class="announcement-text"> Items</p> -->
        					</div>
        				</div>
        			</div>
        			<a href="#">
        				<div class="panel-footer announcement-bottom">
        					<div class="row">
        						<div class="col-xs-6">
        							Interests
        						</div>
        						<div class="col-xs-6 text-right">
        							<i class="fa fa-arrow-circle-right"></i>
        						</div>
        					</div>
        				</div>
        			</a>
        		</div>
        	</div>
        	
        </div><!-- /.row -->  
        
        <!-- tabs -->
        <div class="card">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php if($_SESSION['actype']==="tutor"){echo "Student who add me as favourite";}else{echo "My Favourites";}?></a></li>
            </ul>
    
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="wrapper">

                      <?php
                     if ($_SESSION["actype"] ==="student"){
                    foreach ($res as $row) {
                      //echo $resTutor;
                      //echo $name;
                      echo "<div class='box box1'><a href='profile.php?profile=".$row['tutor_id']."'><img src='uploads/".$row['t_profilepic']."'  height='80' width='80'></a></div>";
                      echo "<div class='box box2'><a href='profile.php?profile=".$row['tutor_id']."'><b>".$row['t_fname']." ".$row['t_lname']."</b></a><br>".$row['t_job']."</div>";
                      }   
                    }
                    if ($_SESSION["actype"] ==="tutor"){
                      foreach ($stmt as $row) {
                      echo "<div class='box box1'><a href='profile.php?profile=".$row['stud_id']."&stud=1'><img src='uploads/".$row['stud_profilepic']."'  height='80' width='80'></a></div>";
                      echo "<div class='box box2'><a href='profile.php?profile=".$row['stud_id']."&stud=1'><b>".$row['stud_fname']." ".$row['stud_lname']."</b></a><br></div>";
                      }   
                    }
                    ?>



  <!--div class="box box1"><a href="#"><img src="http://c1.thejournal.ie/media/2014/07/shutterstock_115992457-390x285.jpg" alt="Smiley face" height="80" width="80"></a></div>
  <div class="box box2"><a href="#"><b>Loreal Ipsum</b></a><br>Programmer</div>
  <div class="box">3</div-->

  
</div>
        <!-- tabs -->
    </div>
</div>

</body>
</html>