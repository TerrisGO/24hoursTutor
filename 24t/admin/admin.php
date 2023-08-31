<?php 
 require_once('db.php');
 $stmt = $conn->prepare("SELECT * FROM `tutor` WHERE `t_active`=1  "); //total tutor with active
 $stmt->execute();
 $count = $stmt->rowCount();

$stmt1 = $conn->prepare("SELECT * FROM `tutor` WHERE `t_active`=1 AND `t_officialcheck` =1");  //tutor with grant and checked 
$stmt1->execute();
$count1 = $stmt1->rowCount();

$stmt2 = $conn->prepare("SELECT * FROM `student`  WHERE `stud_active`=1 ");    //total student with active
$stmt2->execute();
$count2 = $stmt2->rowCount();

$stmt3 = $conn->prepare("SELECT * FROM `payment_info` ");  //all bookings
$stmt3->execute();
$count3 = $stmt3->rowCount();

$stmt4 = $conn->prepare("SELECT * FROM `subject` ");  //all subjects
$stmt4->execute();
$count4 = $stmt4->rowCount();


$stmt5 = $conn->prepare("SELECT * FROM `payment_info` WHERE `status` ='pending' ");  //all subjects
$stmt5->execute();
$count5 = $stmt5->rowCount();
$result5 = $stmt5->fetchAll();

$stmt6 = $conn->prepare("SELECT SUM(`payamount`)as total FROM `payment_info` WHERE `status` = 'success' ");  //all subjects
$stmt6->execute();
$result6 = $stmt6->fetchAll();
foreach ($result6 as $row) {
    $babu = $row[0];
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="icon" href="../uploads/24t.jpeg" type="image/gif" sizes="16x16">  
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>24HoursTutor</title>
	<!-- Bootstrap Styles-->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <!-- Custom Styles-->
        <style>
        /*----------------------------------------------
Author : www.webthemez.com
License: Commons Attribution 3.0
http://creativecommons.org/licenses/by/3.0/
------------------------------------------------*/


/*----------------------------------------------
    COMMON  STYLES    
------------------------------------------------*/
body {
    font-family: 'Open Sans', sans-serif;
}

 #wrapper {
    width: 100%;
    background:#123a5d;
}

#page-wrapper {
    padding: 15px 15px;
    min-height: 600px;
    background:#E5EBF2;
   
}
#page-inner {
    width:100%;
    margin:10px 20px 10px 0px;
    background-color:transparent;
    padding:10px;
    min-height:1200px;
}

.text-center {
    text-align:center;
}
.no-boder {
    border:1px solid #f3f3f3;
}

h1, .h1, h2, .h2, h3, .h3 {
margin-top: 7px;
margin-bottom: -5px;
}
h2 {
    color: #000;
}
h4 {
    padding-top:10px;
}
.square-btn-adjust {
    border: 0px solid transparent; 
   -webkit-border-radius: 0px;
-moz-border-radius: 0px;
border-radius: 0px;

}
p {
    font-size:16px;
    line-height:25px;
    padding-top:20px;
}
/*----------------------------------------------
   DASHBOARD STYLES    
------------------------------------------------*/
.page-header {
padding-bottom: 9px;
margin: 10px 0 45px;
border-bottom: 1px solid #C7D1DD;
}
.panel-back {
    background-color:#fff;

}
.panel-default > .panel-heading {
color: #000;
background-color: #FFFFFF;
border-color: #ddd;
font-weight:bold;
}
.jumbotron, .well{
background:#fff;
}
   .noti-box {
min-height: 100px;
padding: 20px;
}

    .noti-box .icon-box {
display: block;
float: left;
margin: 0 15px 10px 0;
width: 70px;
height: 70px;
line-height: 75px;
vertical-align: middle;
text-align: center;
font-size: 40px;
}
.text-box p{
    margin: 0 0 3px;
}
.main-text {
    font-size: 25px;
    font-weight:600;
}
.set-icon {
-webkit-border-radius: 50px;
-moz-border-radius: 50px;
border-radius: 50px;

}
    .bg-color-green {
background-color: #fff;
color: #5cb85c;
}
 .bg-color-blue {
background-color: #fff;
color: #4CB1CF
}
  .bg-color-red {
background-color: #fff;
color:#F0433D;
}
  .bg-color-brown {
background-color: #fff;
color:#f0ad4e;
}
.back-footer-green {
background-color: #5cb85c;
color:#fff;
border-top: 0px solid #fff;
}
 .back-footer-red {
background-color: #F0433D;
color:#fff;
border-top: 0px solid #fff;
}
 .back-footer-blue {
background-color: #4CB1CF;
color:#fff;
border-top: 0px solid #fff;
}
 .back-footer-brown {
background-color: #f0ad4e;
color:#fff;
border-top: 0px solid #fff;
}
 .icon-box-right {
display: block;
float: right;
margin: 0 15px 10px 0;
width: 70px;
height: 70px;
line-height: 75px;
vertical-align: middle;
text-align: center;
font-size: 40px;
}

 .main-temp-back {
background: #8702A8;
color: #FFFFFF;
font-size: 16px;
font-weight: 300;
text-align: center;
}
 .main-temp-back .text-temp {
font-size: 40px;
}
.back-dash {
    padding:20px;
    font-size:20px;
    font-weight:500;
  -webkit-border-radius: 0px;
-moz-border-radius: 0px;
border-radius: 0px;
background-color:#2EA7EB;
color:#fff;
}
    .back-dash p {
        padding-top:16px;
        font-size:13px;
        color:#fff;
        line-height:25px;
        text-align:justify;
    }

     .color-bottom-txt {
   color: #000;
font-size: 16px;
line-height: 30px;
}
     /*CHAT PANEL*/
 .chat-panel .panel-body {
height: 450px;
overflow-y: scroll;
}
 .chat-box {
margin: 0;
padding: 0;
list-style: none;
}
 .chat-box li {
margin-bottom: 15px;
padding-bottom: 5px;
border-bottom: 1px dotted #808080;
}
 .chat-box li.left .chat-body {
margin-left: 90px;
}
 .chat-box li .chat-body p {
margin: 0;
color: #8d8888;
}
.chat-img>img {
    margin-left:20px;
}
footer p{
font-size: 14px;
}
/*----------------------------------------------
    MENU STYLES    
------------------------------------------------*/


.user-image {
    margin: 25px auto;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
max-height:170px;
max-width:170px;
}
.top-navbar{
margin:0px;
}
.top-navbar .navbar-brand {
color: #fff;
width: 260px;
text-align: left;
height: 60px;
font-size: 30px;
font-weight: 700;
text-transform: uppercase;
line-height: 30px;
}
.top-navbar .nav > li {
position: relative;
display: inline-block;
}
.top-navbar .nav > li > a {
position: relative;
display: block;
padding: 19px 15px;
color: #77C0FD;
}
.top-navbar .nav > li > a:hover, .top-navbar .nav > li > a:focus {
text-decoration: none;
background-color: #225081;
color: #fff;
}
.top-navbar .dropdown-menu{
min-width: 230px;
border-radius: 0 0 4px 4px;
}
.top-navbar .dropdown-menu > li > a:hover, .top-navbar .dropdown-menu > li > a:focus{
color: #225081;
background:none;
}
.dropdown-tasks{
width: 255px;
}
.dropdown-tasks .progress {
height: 8px;
margin-bottom: 8px;
overflow: hidden;
background-color: #f5f5f5;
border-radius: 0px;
}
.dropdown-tasks > li > a { 
padding: 0px 15px;
}
.dropdown-tasks p {
font-size: 13px;
line-height: 21px;
padding-top: 4px;
}
.active-menu {
    background-color:#225081!important;
}

.arrow {
    float: right;
}

.fa.arrow:before {
    content: "\f104";
}

.active > a > .fa.arrow:before {
    content: "\f107";
}


.nav-second-level li,
.nav-third-level li {
    border-bottom: none !important;
}

.nav-second-level li a {
    padding-left: 37px;
}

.nav-third-level li a {
    padding-left: 55px;
}
.sidebar-collapse , .sidebar-collapse .nav{
    background:none;
    background-color: #123a5d!important;
}
.sidebar-collapse .nav {
	padding:0;
}
.sidebar-collapse .nav > li > a {
	color:#fff;
	background:transparent;
	text-shadow:none;
	
}
.sidebar-collapse > .nav > li > a {
	padding:15px 10px;
}
.sidebar-collapse > .nav > li {
	border-bottom: 1px solid rgba(107, 108, 109, 0.19);
}
ul.nav.nav-second-level.collapse.in {
background: #172D44;
}
.sidebar-collapse .nav > li > a:hover,
.sidebar-collapse .nav > li > a:focus {
	 
	outline:0;
}
 
.navbar-side {
	border:none;
	background-color: transparent;
	
}
.top-navbar {
	background:#09192A;
	border-bottom:none;
	
}
.top-navbar .nav > li > a > i {
margin-right: 2px;
}
.top-navbar .navbar-brand:hover { 
color:#fff;

}
.dropdown-user li {
margin: 8px 0;
}
.navbar-default {
border:0px solid #123a5d;
     
}
.navbar-header {
    background: #09192A;
}
.navbar-default .navbar-toggle:hover, .navbar-default .navbar-toggle:focus {
background-color: #B40101;
}
.navbar-default .navbar-toggle {
border-color: #fff;
}

.navbar-default .navbar-toggle .icon-bar {
background-color: #FFF;
}
.nav > li > a > i {
    margin-right:10px;
}
/*----------------------------------------------
    UI ELEMENTS STYLES     
------------------------------------------------*/
.btn-circle {
width: 50px;
height: 50px;
padding: 6px 0;
 -webkit-border-radius: 25px;
-moz-border-radius: 25px;
border-radius: 25px;
text-align: center;
font-size: 12px;
line-height: 1.428571429;
}

/*----------------------------------------------
    MEDIA QUERIES     
------------------------------------------------*/
 
 @media(min-width:768px) {
     #page-wrapper{
               margin: 0 0 0 260px;
        padding: 15px 30px;
        min-height: 1200px;
		
    }
	
	
    .navbar-side {
        z-index: 1;
        position: absolute;
        width: 260px;
    }

   .navbar {
 border-radius: 0px; 
}
   
}
 @media(max-width:480px) {
.page-header small {
display: block;
padding-top: 14px;
font-size: 19px;
}
}



    </style >
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="admin.php">24hrs Tutor</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                 <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="../loging.php" aria-expanded="false">
                        <i class="fas fa-sign-out-alt"></i> 
                    </a>
                    <ul class="dropdown-menu">
              <!--login/logout area starts-->
              <li>
                              <a href="admin/pageHome.php" class="btn btn-danger navbar-btn btn-sm hidden-xs"><i class="fa fa-cog"></i> <strong>Admin Area</strong></a>
               <a href="admin/pageHome.php" class="btn btn-danger navbar-btn btn-sm visible-xs btn-sm"><i class="fa fa-cog"></i> <strong>Admin Area</strong></a>
                                                           <ul class="nav navbar-nav navbar-right hidden-xs" style="min-width: 330px;">
              </ul>
              <ul class="nav navbar-nav visible-xs">
              </ul>
                                        </li>
            <!--login/logout area ends-->
            <li class="divider"></li>
            <li><a class="btn navbar-btn btn-primary" href="index.php?signOut=1"><i class="fa fa-power-off"></i> <strong style="color:white">Sign Out</strong> </a></li>
          </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a href="admin.php"><i class="fa fa-microchip"></i> Dashboard</a>
                    </li>
                     <li>
                        <a href="tutor.php"><i class="fa fa-users"></i>Tutors</a>
                    </li>
                    <li>
                        <a href="approve_tutor.php"><i class="fa fa-check-circle"></i> Approve Tutor</a>
                    </li>
                    <li>
                        <a href="student.php"><i class="fas fa-user-graduate"></i>Student</a>
                    </li>
                    <li>
                        <a href="bkrecord.php"><i class="fa fa-money"></i>Booking Records</a>
                    </li>
                    <li>
                        <a href="subjects.php"><i class="fa fa-sitemap"></i>SUBJECTs</a>
                    </li>
                    <!--li>
                        <a href="backup.php"><i class="far fa-hdd "></i> Back UP</a>
                    </li-->
                       </ul>
                    </li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Welcome  <small> admin</small>
                        </h1>
                                            </div>
                  </div> 
                 <!--user widgets-->
 <div class="row">
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-body">
                                <i class="fa fa-users fa-5x"></i>
                                <h3><?= $count;  ?></h3>
                            </div>
                            <div class="panel-footer back-footer-red">
                                <a href="tutor.php" style="text-decoration: none;color: white"><strong>Active Tutors</strong></a>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-brown">
                            <div class="panel-body">
                                <i class="fa fa-money fa-5x"></i>
                                <h3><?=  $count3;?></h3>
                            </div>
                            <div class="panel-footer back-footer-brown">
                                <a href="bkrecord.php" style="text-decoration: none;color: white"><strong>Total Bookings</strong></a>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body">
                                <i class="fa fa fa-calendar fa-5x"></i>
                                <h3><?=  date("Y/m/d");?><?=  date("l");?></h3>
                            </div>
                            <div class="panel-footer back-footer-green">
                                <strong>Date</strong>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-blue">
                            <div class="panel-body">
                                <i class="fa fa-user fa-5x"></i>
                                <h3>admin</h3>
                            </div>
                            <div class="panel-footer back-footer-blue">
                                <a href="admin.php" style="text-decoration:none;color: white"><strong>Account</strong></a>

                            </div>
                        </div>
                    </div>
                </div>
<!--admin widgets row-->
 <div class="row">
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body">
                                <i class="fas fa-user-graduate fa-5x"></i>
                                <h3><?= $count2;?></h3>
                            </div>
                            <div class="panel-footer back-footer-green">
                                <a href="student.php" style="text-decoration: none;color: white"><strong>Active Student</strong></a>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-blue">
                            <div class="panel-body">
                                <i class="fa fa-sitemap fa-5x"></i>
                                <h3><?= $count4;?></h3>
                            </div>
                            <div class="panel-footer back-footer-blue">
                                <a href="subjects.php" style="text-decoration: none;color: white"><strong>Subjects +/-</strong></a>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-body">
                                <i class="fa fa fa-check-circle fa-5x"></i>
                                <h3><?= $count1;?></h3>
                            </div>
                            <div class="panel-footer back-footer-red">
                               <a href="approve_tutor.php" style="text-decoration: none;color: white"><strong>Approved Tutor</strong></a>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-brown">
                            <div class="panel-body">
                            <i class="fas fa-dollar-sign fa-5x"></i>
                                <h3><?=$babu?> </h3>
                            </div>
                            <div class="panel-footer back-footer-brown">
                               <a href="#" style="text-decoration: none;color: white"> <strong>All Success Book (RM)</strong></a>

                            </div>
                        </div>
                    </div>
                </div>
                <!--row ends here-->
                <div class="col-md-12 col-sm-12 col-xs-12">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span class="fa fa-bell"> <strong>All Pending Bookings</strong></span>
                            </div> 
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                                <th>Payment_ID</th>
                                                <th>Paytime</th>
                                                <th>Amount</th>
                                                <th>Stud_ID</th>
                                                <th>Tutor_id</th>
                                                <th>Subjects</th>
                                                <th>Booking Date</th>
                                                <th>Duration(hrs)</th>
                                                <th>status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <div class="alert alert-success">
                                            <strong>Total Results:  <?= $count5?></strong>
                                    <?php
                                    if($count5 > 0)
                                    { 
                                    foreach ($result5 as $row) {
                                     
                                    echo "<tr>      
                                        <td><b>".$row['payment_id']."</b></td>
                                        <td><b>".$row['paytime']."</b></td>  
                                        <td><b>RM ".$row['payamount']."</b></td>
                                        <td><b>".$row['stud_id']."</b></td>   
                                        <td><b>".$row['tutor_id']."</b></td>  
                                        <td><b>".$row['sub_name']."</b></td>
                                        <td><b>".$row['bookingdate']."</b></td>  
                                        <td><b>".$row['appoint_hrs']."</b></td>  
                                        <td><b>".$row['status']."</b></td>    
                                   </tr>" ; 
                                   }
                                    }else{
                                    echo '
                                    <tr>
                                        <td colspan="8" align="center">No Records Yet</td>
                                    </tr>
                                    ';
    
                                    }
                        
                                    
                                    ?>
		</div>                                        </tbody>
                                    </table>
                                    <a href="bkrecord.php" class="btn btn-info btn-block fa fa-list">View All Records</a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="container" style="width:900px;">  
                <h3 align="center">Export Table Data as CSV</h3>                 
                <br />  
                <form method="post" action="export.php" align="center">  
                     <input type="submit" name="export" value="chat" class="btn btn-success" />  
 
                     <input type="submit" name="export2" value="chatmessage" class="btn btn-success" />  
 
                     <input type="submit" name="export3" value="favourite" class="btn btn-success" />  
 
                     <input type="submit" name="export4" value="nonavailable" class="btn btn-success" />  

                     <input type="submit" name="export5" value="payment_info" class="btn btn-success" />  

                     <input type="submit" name="export6" value="rating" class="btn btn-success" />  

                     <input type="submit" name="export7" value="student" class="btn btn-success" />  

                     <input type="submit" name="export8" value="subject" class="btn btn-success" />  

                     <input type="submit" name="export9" value="subject_offer" class="btn btn-success" />  

                     <input type="submit" name="export10" value="tutor" class="btn btn-success" />  
                </form> 
                </div>
                </div>                                 <!-- /. ROW  -->
				 <footer><strong><p><center>5am Booking System. Developed By: Terris Go. Brought To You by: <a href="http://code-projects.org/">code-projects</a></p></center></strong></footer>
				</div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    </body>
</html>
<?php require_once('export.php');?>



<!-- for stupid server>
                <a href="a.php"><button  > chat </button><a>
                
                <a href="b.php"><button  > chatmessage </button></a>

                <a href="c.php"><button > favourite </button></a> 

                <a href="d.php"><button  > nonavailable </button></a>

                <a href="e.php"><button   > payment_info </button></a>

                <a href="f.php"><button   > rating </button></a>

                <a href="g.php"><button > student </button></a>

                <a href="h.php"><button  > subject </button></a>

                <a href="i.php"><button   > subject_offer </button></a>

                <a href="j.php"><button   >tutor </button></a>
<--> 