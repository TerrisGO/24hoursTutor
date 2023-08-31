
<?php

require_once('db.php'); 
 session_start();
 require_once("csrf.php");
 $old_sessionid = session_id();
 session_regenerate_id();

 if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && isset($_SESSION["actype"]))  
 { 
      /*$pageRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) &&($_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0' ||  $_SERVER['HTTP_CACHE_CONTROL'] == 'no-cache'); 
      if($pageRefreshed == 1){
        unset($_GET);
      }*/

     if ($_SESSION["actype"] ==="tutor"){
        $Q = $conn->prepare('SELECT t.stud_fname, t.stud_lname, t.stud_profilepic, c.payment_id , c.stud_id,c.sub_name,c.bookingdate,DATEDIFF(c.bookingdate, CURDATE()) AS Date,c.appoint_hrs,c.status FROM payment_info c, student t WHERE `bookingdate`>=  CURDATE() AND `tutor_id` = :id AND c.stud_id = t.stud_id AND `status` ="pending" ORDER BY `bookingdate`');
        $Q->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
        $Q->execute();
        $count = $Q->rowCount();
        $result = $Q->fetchAll();
     }
     if ($_SESSION["actype"] ==="student"){
        $Q = $conn->prepare('SELECT t.t_fname, t.t_lname, t.t_profilepic, c.payment_id , c.tutor_id,c.sub_name,c.bookingdate,DATEDIFF(c.bookingdate, CURDATE()) AS Date,c.appoint_hrs,c.status FROM payment_info c, tutor t WHERE `bookingdate`>= CURDATE() AND `stud_id` = :id AND c.tutor_id = t.tutor_id AND `status` ="pending" ORDER BY `bookingdate`');
        $Q->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
        $Q->execute();
        $count = $Q->rowCount();
        $result = $Q->fetchAll();
    }
        //print_r($result);
        //echo $count;
} else  
{  
     session_destroy();
     header("location:loging.php");  
}

$new_sessionid = session_regenerate_id(true);

?>


 <head><link rel="icon" href="uploads/24t.jpeg" type="image/gif" sizes="16x16">   
 <meta name="viewport" content="width=device-width, initial-scale=1">
           <title>24HoursTutor</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
      table thead { 
         color: white;font-size: 20px;text-align: center; text-shadow: 1px 1px gold;  }
       td 
       {
       text-align: center;
       height: 50px; 
       width: 50px;
       }
       tr:nth-child(odd){background-color: grey;}
       tr:nth-child(even){background-color: #f2f2f2;}
       .table{
       -webkit-box-shadow: 10px 10px 20px -4px rgba(0,0,0,0.75);
       -moz-box-shadow: 10px 10px 20px -4px rgba(0,0,0,0.75);
        box-shadow: 10px 10px 20px -4px rgba(0,0,0,0.75); 
       }
       body {
       background-image: url("http://yesofcorsa.com/wp-content/uploads/2017/09/Breeze-Best-Wallpaper.jpg");
       background-repeat: no-repeat;
       background-position: center bottom;
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
   .alert {
     position:relative;
       padding: 20px;
       background-color: #f44336;
       color: white;
       z-index: 2000;
   }
   .alert2 {
     position:relative;
       padding: 20px;
       background-color: GREEN;
       color: white;
       z-index: 2000;
   }
   
   .closebtn {
       margin-left: 15px;
       color: white;
       font-weight: bold;
       float: right;
       font-size: 22px;
       line-height: 20px;
       cursor: pointer;
       transition: 0.3s;
   }
   
   .closebtn:hover {
       color: black;
   }
</style>
      </head>  
      <body>  
      <!DOCTYPE html>
<html>
<title>24HoursTutor</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3_2.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <a href="searching.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Search</a>
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
  <div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
<?php
       if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"])  
        {
          echo "<a href='login_success.php' class='w3-bar-item w3-button w3-padding-large'>Main Menu</a>";
        }
       ?>
</div>

</div><br><br><br><br>

        <?php
        
        if ( isset($_GET['successconfirm']) && $_GET['successconfirm'] == 1){
          echo '        <br />
      <div class="alert2">
        <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
        <strong>SUCCESS !</strong>   The Record has been save
      </div>';
        }

        if (isset($_GET['failconfirm']) && $_GET['failconfirm'] == 1){
          echo '        <br />
      <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
        <strong>Validation Fail !</strong>   Havent reach the time yet, you can only confirm after 30 min start
      </div>';
        }
        if ( isset($_GET['successcancel']) && $_GET['successcancel'] == 1){
          echo '        <br />
      <div class="alert2">
        <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
        <strong>SUCCESS !</strong>   You cancel was made
      </div>';
        }

        if (isset($_GET['failcancel']) && $_GET['failcancel'] == 1){
          echo '        <br />
      <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
        <strong>Canceling Fail !</strong>   For Student can only cancel before 3 hours start <br>
        For Tutor can cancel after 20 minutes start 
      </div>';
        }

        ?>
           <div class="container">  
<div class="table-responsive">  
                     <table id="tb" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                               <?php if ($_SESSION["actype"]==="tutor"){ echo "<td>Student Name</td>";}else{echo "<td>Tutor Name</td>";}?>  
                                    <td>IMG</td>  
                                    <td>Subject</td>  
                                    <td>Appointment Time</td>
                                    <td>Due</td> 
                                    <td>Duration (hours)</td> 
                                    <td>Cancel?</td>
                                    <?php if ($_SESSION["actype"]==="tutor"){ echo "<td>Success?</td>";}?>
                                    <td>Status</td>
                               </tr>  
                          </thead>  
 
                               <?php 
                               if ($_SESSION["actype"] ==="student"){
                               if($count > 0)
                               { 
                               foreach ($result as $row) {
                               $resName = $row['t_fname'].' '.$row['t_lname'];
                               $resTutor = $row['tutor_id'];

                               if ($row['Date']==0){
                                 $d = "Today";
                               }else if ($row['Date']==1){
                                 $d = "tomorrow";
                               }else{
                                 $d = $row['Date']." days from now";
                               }

                               $picture = "uploads/".$row['t_profilepic']; 
                                echo "<tr>      
                                    <td><a href='profile.php?profile=$resTutor'><b>$resName</b></a></td>  
                                    <td><a href='profile.php?profile=$resTutor'><img src='$picture' class='thumbnail' height='50' width='50' /></a></td>  
                                    <td><b>".$row['sub_name']."</b></td>  
                                    <td>".$row['bookingdate']."<br><a href='receipt.php?pyid=".$row['payment_id']."'><i class='fas fa-file-invoice'> View Receipt</i></a></td>
                                    <td>$d</td>
                                    <td><b>".$row['appoint_hrs']."</b></td>  
                                    <td><a href='cancelbook.php?cancel=".$row['payment_id']."&name=$resName'  style='height:100%;width:100%'><div><i class='fa fa-unlink'></i>Request</div></a></td>
                                    <td><b>".$row['status']."</b></td>
                               </tr>" ; 
                               }
                            }else{
                                echo '
                                <tr>
                                    <td colspan="8" align="center">No Current Book Yet</td>
                                </tr>
                                ';

                            }
                        }
                        if ($_SESSION["actype"] ==="tutor"){
                            if($count > 0)
                            { 
                            foreach ($result as $row) {
                            $resName = $row['stud_fname'].' '.$row['stud_lname'];
                            $resStud = $row['stud_id'];

                            if ($row['Date']==0){
                                 $d = "Today";
                               }else if ($row['Date']==1){
                                 $d = "tomorrow";
                               }else{
                                 $d = $row['Date']." days from now";
                               }

                            $picture = "uploads/".$row['stud_profilepic']; 
                             echo "<tr>      
                                 <td><a href='profile.php?profile=$resStud&stud=1'><b>$resName</b></a></td>  
                                 <td><a href='profile.php?profile=$resStud&stud=1'><img src='$picture' class='thumbnail' height='50' width='50' /></a></td>  
                                 <td><b>".$row['sub_name']."</b></td>  
                                 <td>".$row['bookingdate']."</td>
                                 <td>$d</td>
                                 <td><b>".$row['appoint_hrs']."</b></td>  
                                 <td><a href='cancelbook.php?cancel=".$row['payment_id']."&name=$resName'  style='height:100%;width:100%'><div><i class='fa fa-unlink'></i>Request</div></a></td>
                                 <td><a href='successbook.php?yes=".$row['payment_id']."'  style='height:100%;width:100%'><div><i class='fa fa-check-square-o'></i>Confirm</div></a></td>
                                 <td><b>".$row['status']."</b></td>
                            </tr>" ; 
                            }
                         }else{
                             echo '
                             <tr>
                                 <td colspan="9" align="center">No Current Book Yet</td>
                             </tr>
                             ';

                         }
                     }



                                 ?>
                     </table>  
                </div>  
           </div>  
           </body>
           </html>