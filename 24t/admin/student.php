<?php 
 require_once('db.php');

 if (isset($_GET['show']) && ctype_digit($_GET['show'])){
    $default = '
    <div class="panel-body">
        <div class="table-responsive">
        <div class="col-md-3">  
        <input type="text" name="value" id="value" class="form-control" placeholder="" />  
    </div>  
    <div class="col-md-5">  
        <input type="submit" name="filter" id="filter" value="Filter" class="btn btn-info" />  
    </div><br><br>';
   if ($_GET['show'] === "1"){
       $Q = "SELECT * FROM `student` WHERE `stud_id` = :value1 ";
       $Ehhco = '<center><label>Search by ID</label></center><form action="student.php?show=1" method="post">'.$default;
   }elseif ($_GET['show'] === "2"){
       $Q = "SELECT * FROM `student` WHERE `stud_fname` =:value1  AND `stud_lname` =:value2 ";
       $Ehhco = '<center><label>Search by Name</label></center><form action="student.php?show=2" method="post">
       <div class="panel-body">
           <div class="table-responsive">
           <div class="col-md-3">  
           <input type="text" name="value" id="value" class="form-control" placeholder="Firstname" />  
       </div>
           <div class="col-md-3">  
           <input type="text" name="value2" id="value2" class="form-control" placeholder="Lastname" />  
       </div>    
       <div class="col-md-5">  
           <input type="submit" name="filter" id="filter" value="Filter" class="btn btn-info" />  
       </div><br><br>';
   }elseif ($_GET['show'] === "3"){
       $Q = "SELECT * FROM `student` WHERE `stud_usrn` = :value1  ";
       $Ehhco = '<center><label>Search by Username</label></center><form action="student.php?show=3" method="post">'.$default;
   }elseif ($_GET['show'] === "4"){
       $Q = "SELECT * FROM `student` WHERE `stud_email` = :value1 ";
       $Ehhco = '<center><label>Search by Email</label></center><form action="student.php?show=4" method="post">'.$default;
   }
   else{
       $Q = "SELECT * FROM `student` ";
       $Ehhco = "";
   }
}else{
   $Q = "SELECT * FROM `student` ";
   $Ehhco = "";
}


$stmt1 = $conn->prepare("SELECT `stud_gender`, count(*) as number  FROM `student` GROUP BY stud_gender");
$stmt1->execute();
$result = $stmt1->fetchAll();

$stmt2 = $conn->prepare("$Q ");
if (isset($_GET['show'])){
    if (isset($_GET['show']) && $_GET['show'] === "1" || $_GET['show'] === "3" || $_GET['show'] === "4" ){
        $stmt2->bindParam(':value1', $_POST["value"], PDO::PARAM_STR);
    }elseif($_GET['show'] === "2" ){
        $stmt2->bindParam(':value1', $_POST["value"], PDO::PARAM_STR);
        $stmt2->bindParam(':value2', $_POST["value2"], PDO::PARAM_STR);
    }}
$stmt2->execute();
$count = $stmt2->rowCount();
$result2 = $stmt2->fetchAll();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="icon" href="../uploads/24t.jpeg" type="image/gif" sizes="16x16"> 
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>24HoursTutor</title>
    <!-- Bootstrap Styles-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
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
.btn-group .button {
    background-color: #123a5d; 
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    float: left;
}

.btn-group .button:hover {
    background-color: #40e0d0;
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
                        <h2 class="page-header">
                            Student
                        </h2>
                                            </div>
                  </div> 
                
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="btn-group">
                    <button class="button" onclick="window.location.href='student.php'">Show All</button>
                    <button class="button" onclick="window.location.href='student.php?show=1'">Search By ID</button>
                    <button class="button" onclick="window.location.href='student.php?show=2'">Search By FirstLastName</button>
                    <button class="button" onclick="window.location.href='student.php?show=3'">Search By Username</button>
                    <button class="button" onclick="window.location.href='student.php?show=4'">Search By Email</button>
                </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span class="fa fa-bell"> <strong>Basic Student Info</strong></span>
                            </div> 
                            <?php
                                echo $Ehhco; //for searching
                            ?>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>StudentID</th>
                                                <th>FirstName</th>
                                                <th>Lastname</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Active</th>
                                                <th>ProfilePic</th>
                                                <th>Gender</th>
                                                <th>RegisterDate</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <div class="alert alert-success">
        Click the id to see full details
        <?php
                                    if($count > 0)
                                    { 
                                    foreach ($result2 as $row) {
                                    $picture = "../uploads/".$row['stud_profilepic']; 
                                    echo "<tr>      
                                    <td><b><a href='viewprofile.php?student=".$row['stud_id']."' button type='button' class='btn btn-primary'>".$row['stud_id']."</a></b></td> 
                                        <td><b>".$row['stud_fname']."</b></td>  
                                        <td><b>".$row['stud_lname']."</b></td>
                                        <td><b>".$row['stud_email']."</b></td>
                                        <td><b>".$row['stud_usrn']."</b></td>
                                        <td><b>".$row['stud_active']."</b></td>
                                        <td><img src='$picture' class='thumbnail' height='50' width='50' /></td>    
                                        <td><b>".$row['stud_gender']."</b></td> 
                                        <td><b>".$row['stud_registerdate']."</b></td> 
                                   </tr>" ; 
                                   }
                                    }else{
                                    echo '
                                    <tr>
                                        <td colspan="9" align="center">No Records Yet</td>
                                    </tr>
                                    ';
    
                                    }
                        
                                    
                                    ?>

        
		</div>                                        </tbody>
                                    </table>
                                    <a href="http://localhost/busbooking/bookings_view.php?SortField=&SortDirection=&FilterAnd%5B1%5D=and&FilterField%5B1%5D=8&FilterOperator%5B1%5D=like&FilterValue%5B1%5D=11%/09%/2018" class="btn btn-info btn-block fa fa-list">See All Due Today</a>
                                </div>
                            </div>
                        </div>

                   
                    <div class="container">
                         <canvas id="myChart" style="width: 400px; height: 140px"></canvas>
                    </div>




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
    <script>
    let myChart = document.getElementById('myChart').getContext('2d');

    // Global Options
    Chart.defaults.global.defaultFontFamily = 'Lato';
    Chart.defaults.global.defaultFontSize = 18;
    Chart.defaults.global.defaultFontColor = '#777';
    
    let massPopChart = new Chart(myChart, {
      type:'pie', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data:{
        labels:[<?php  
        $lastElement = end($result);
                           foreach ($result as $row) { 
                            $num = ",";
                            if($row == $lastElement) {
                                $num = ""; 
                           }
                               echo "'".$row["stud_gender"]."'".$num."";
                          }  
                          ?>],
        datasets:[{
          label:'Population',
          data:[<?php  
                    $lastElement = end($result);
                    foreach ($result as $row) { 
                     $num = ",";
                     if($row == $lastElement) {
                         $num = ""; 
                    }
                        echo "'".$row["number"]."'".$num."";
                   }  
                   ?>],
          //backgroundColor:'green',
          backgroundColor:[ 
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 99, 132, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)',
            'rgba(255, 99, 132, 0.6)'
          ],
          borderWidth:1,
          borderColor:'#777',
          hoverBorderWidth:3,
          hoverBorderColor:'#000'
        }]
      },
      options:{
        title:{
          display:true,
          text:'Gender For all Student',
          fontSize:25
        },
        legend:{
          display:true,
          position:'right',
          labels:{
            fontColor:'#000'                                       
          }
        },
        layout:{
          padding:{
            left:50,
            right:0,
            bottom:0,
            top:0
          }
        },
        tooltips:{
          enabled:true
        },
       
 
      }
    });
  </script>
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
