<?php
require_once('db.php'); 
session_start();
require_once("csrf.php");
$old_sessionid = session_id();
session_regenerate_id();


if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && isset($_SESSION["actype"])  )
 {  

    if ( isset($_GET['pyid']) && !$_GET['pyid'] == "" && ctype_digit($_GET['pyid']))
    {

        if ($_SESSION["actype"] ==="student"){
            $Q = $conn->prepare('SELECT t.t_fname, t.t_lname, t.t_profilepic, c.sub_name, c.payment_id , c.payamount , c.tutor_id , c.bookingdate, c.appoint_hrs FROM payment_info c, tutor t WHERE `stud_id` = :id AND c.tutor_id = t.tutor_id  AND c.payment_id=:pyid' );
            $Q->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
            $Q->bindParam(':pyid', $_GET['pyid'], PDO::PARAM_INT);
            $Q->execute();
            $count = $Q->rowCount();
            $result = $Q->fetchAll();
           // print_r($result);
        }
    }
}

 $new_sessionid = session_regenerate_id(true);

 ?>

 <head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script><!--problem here-->
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"  media="screen">

<link rel="stylesheet" href="css/w3_2.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
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
<style>

#hello1 {
	border-radius: 25px;
    border: 1px white;
    margin-top: 20px;
    margin-bottom: 100px;
    margin-right: 80px;
    margin-left: 80px;
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
 *
{
	border: 0;
	box-sizing: content-box;
	color: inherit;
	font-family: inherit;
	font-size: inherit;
	font-style: inherit;
	font-weight: inherit;
	line-height: inherit;
	list-style: none;
	margin: 0;
	padding: 0;
	text-decoration: none;
	vertical-align: top;
}

h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

table { font-size: 75%; table-layout: fixed; width: 100%; font-size: 21px;}
table { border-collapse: separate; border-spacing: 2px; }
th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
th, td { border-radius: 0.25em; border-style: solid; }
th { background: #EEE; border-color: #BBB; text-align: center;height: 50px; width: 50px;}
td { border-color: #DDD;  text-align: center;height: 50px; width: 50px;}

table.meta th { width: 40%; }
table.meta td { width: 60%; }

table.container { clear: both; width: 100%; }
table.container th { font-weight: bold; text-align: center; }
table.container td:nth-child(1) { width: 26%; }
table.container td:nth-child(2) { width: 38%; }
table.container td:nth-child(3) { text-align: right; width: 12%; }
table.container td:nth-child(4) { text-align: right; width: 12%; }
table.container td:nth-child(5) { text-align: right; width: 12%; }

table.meta, table.balance { float: right; width: 20%; }
table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
html { background: #999; cursor: default; }

body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

header { margin: 0 0 3em; }
header:after { clear: both; content: ""; display: table; }

header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin-bottom: 5px ; margin-top: 5px; padding-top: 10px ; }
header span, header img { display: block; float: center; margin-bottom: 5px; margin-top: 5px;}
header span { margin-top: 5px ; margin-bottom: 5px; max-height: 10%; max-width: 20%; position: relative; }
header img { max-height: 80%; max-width: 80%; }
header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

[contenteditable]:focus, td:hover
 *[contenteditable], td:focus 
 *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

span[contenteditable] { display: inline-block; }

aside h1 { border: none; border-width: 0 0 1px; margin-top: 80px; }
aside h1 { border-color: #999; border-bottom-style: solid; }
</style>
<body>

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
          echo "<a href='login_success.php' class='w3-bar-item w3-button w3-padding-large w3-hide-small' data-ajax='false'>Main Menu</a>";
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
          echo "<a href='login_success.php' class='w3-bar-item w3-button w3-padding-large' data-ajax='false'>Main Menu</a>";
        }
       ?>
</div>
</div><br></br><br>

<header>
<h1>Receipt</h1>
<br>
<span><img alt = "" src="uploads/thank.jpg" >
</span>
</header>

  <div class="container">  
<div class="table-responsive">  
                     <table id="tb" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                               <?php if ($_SESSION["actype"]==="tutor"){ echo "<td>Student Name</td>";}{echo "<td>Tutor Name</td>";}?>
                               <th>IMG</th>
                               <th>Subject</th>
                               <th>Appointment time</th>
                               <th>Duration(Hrs)</th>
                               <th>Price</th>
                               </tr>
                            </thead>

                         <?php 

                               if ($_SESSION["actype"] ==="student"){
                                   
                               if($count > 0)
                               {
                               foreach ($result as $row) {
                               $resName = $row['t_fname'].' '.$row['t_lname'];
                               $resTutor = $row['tutor_id'];

                              $picture = "uploads/".$row['t_profilepic']; 
                                echo "<tr> 
                                    
                                    <td><a href='profile.php?profile=$resTutor' data-ajax='false'><b>$resName</b></a></td>  
                                    <td><a href='profile.php?profile=$resTutor' data-ajax='false'><img src='$picture' class='thumbnail' height='50' width='50' /></a></td>  
                                    <td><b>".$row['sub_name']."</b></td>  
                                    <td>".$row['bookingdate']."<br><a href='profile.php?profile=$resTutor'></a></td>
                                    <td><b>".$row['appoint_hrs']."</b></td>  
                                    <td>".$row['payamount']."</td>
                               </tr>";
                               }

                            }
                            }
                               ?>
                               </table>

             </div>
             </div> 
             
             <table class = "balance">
                    <tr>
                    <th><span contenteditable>Total</span></th>
                    <?php
                    echo "<td>".$row['payamount']."</td>";
                    ?>
                    </tr>

                    <tr>
                        <th><span contenteditable>Amount Paid</span></th>
                    <?php
                    echo " <td>".$row['payamount']."</td>";
                    ?>
                    </tr>
            
            </table>
            <br><br><br><br><br>
             <aside>
			<h1><span >Additional Notes</span></h1>
			<div>
                <p> . Users are able to refund in 14 days. </p>
                <p> . If users did not refund in 14 days then the users are not able allowed to refund their ordered item. </p>
                <p> . Once users received their refund, our staff will introduce to the user lecturer with better recommendation. </p>
                <p> . Any emergency or reports please kindly <a title="24hrstutor@gmail.com" href="mailto:24hrstutor@gmail.com">email</a> to us or contact our service hotline H/P: 012-41165685 or else come to our <a href="servicecentre.php" data-ajax="false"> service centre</a>. </p>
                

			</div>
		</aside>

</body>
</html>