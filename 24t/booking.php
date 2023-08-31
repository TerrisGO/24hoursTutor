<?php  
 //login_success.php 
 require_once('db.php'); 
 session_start();
 require_once("csrf.php");
 $old_sessionid = session_id();
 session_regenerate_id();

$target_path   = 'uploads/';

if ( isset($_GET['true']) && ctype_digit($_GET['true']) )
{
    // check course again with ID
    try{
    
        if ($_SESSION["actype"] ==="student"){
           $stmt_stud = $conn->prepare("SELECT e.tutor_id, e.t_fname, e.t_lname, e.t_profilepic, c.subject_name, d.price_perhrs FROM subject c , subject_offer d , tutor e
           WHERE d.offer_id = :id
           AND c.subject_id = d.subject_id 
		   AND d.tutor_id = e.tutor_id
		   AND e.t_officialcheck = 1");
           $stmt_stud->bindParam(':id', $_GET['true'], PDO::PARAM_INT);
           $stmt_stud->execute();
           $results = $stmt_stud->FETCH(PDO::FETCH_ASSOC);
           // print_r($results);
           $tname = $results["t_fname"];
           $tname .= " ".$results["t_lname"];
           $subject = $results["subject_name"];
           $price = $results["price_perhrs"];
		   $find =$target_path.$results['t_profilepic'];
		   $tutorid = $results["tutor_id"];
		   $total = $stmt_stud->rowCount();
           if ($results['t_profilepic'] =="" || !file_exists( $find )){
            $find = $target_path."default.png";
           }
           }
           }
       
           catch(PDOException $e){
           {
           echo "Error: " . $e->getMessage();
           }
         }
}

 if(!isset($_SESSION["username1"]) && !isset($_SESSION["identity"]) && !isset($_SESSION["actype"])  )
 {  
    session_destroy();
    header("location:loging.php");  
 }
 if ($_SESSION["actype"] ==="tutor" || !$total >"0"){
    header("location:login_success.php"); 
 }
 
 $new_sessionid = session_regenerate_id(true);
 ?>  


 <html>
	<head><link rel="icon" href="uploads/24t.jpeg" type="image/gif" sizes="16x16"> 
    
    <style>
	
	#example2 {
	-webkit-box-shadow: -1px 6px 29px 1px rgba(183,201,20,0.66);
	-moz-box-shadow: -1px 6px 29px 1px rgba(183,201,20,0.66);
	box-shadow: -1px 6px 29px 1px rgba(183,201,20,0.66);
}
    #datetime {
    font-size: 80%;
 	 width: 300px;
 	 height: auto;
 	 margin: 5px auto 0;
	 font:20pt Arial, sans-serif;
	-webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);
 	-moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);
	 box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);
}
    body{
        background-image: url("http://excelrealestateexperts.com/wp-content/uploads/2018/09/pexels-photo-414160.jpeg");
    background-repeat: no-repeat;
    background-position: center bottom;
    }
    html, body, .container {
	color: #5B5D68;
}

.container {
	margin-top: 50px;
}

main {
	margin-top: 50px;
}

p {
	font-size: 17px;
	font-family: 'Raleway', sans-serif;
	font-weight: bold;
}

a, a:visited {
	color: #474850 !important;
	text-decoration: none !important;
}

.topControl, .inText {
	text-align: center;
}

.topControl {
	cursor: pointer;
}

#inner {
	height: 750px;
	padding: 60px 0px;
	background-color: white;
}

#inner div {
	margin-top: 0px;
}

#pic {
	height: 120px;
	width: 120px;	
	border: 6px solid #474850;
	border-radius: 50%;
	box-shadow: 0px 4px 3px #5B5D68;
	margin: 0 auto;
  background-image: url("<?php echo $find ;?>");
  background-size: cover;
  
}

.inText {
	margin: 10px 0px;
}

.inText > p {
	font-size: 20px;
}

.controls {
	height: 90px;
	vertical-align: middle;
}

.controls .fa {
	margin-top: 55%;
	cursor: pointer;
}

#nbResa {
	font-size: 60px;
}

.submit {
	height: 80px;
}

#submit {
	background-color: #123a5d;
	border: none;
	color: white;
	font-weight: bold;
	text-align: center;
	width: 100%;
	height: 100%;
	box-shadow: 0px 4px 3px #5B5D68;
  transition: all 0.2s ease;
}

#submit:hover {
  box-shadow: 0px 0px 0px #5B5D68;
}

input {
  text-align: center;
  font-size: 30px;
}
#datetime {
    font-size: 80%;
  width: 300px;
  height: auto;
  margin: 5px auto 0;
  font:20pt Arial, sans-serif;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);
  -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);
  box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);
}
#myDIV {
    width: 100%;
    padding: 20px 0;
    text-align: center;
    background-color: #123a5d;
    margin-top: 20px;
}
    </style>
		<title>24HoursTutor</title>
		<meta name="viewport" content="width=device-width user-scalable=no inital-scale=1">
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css" />
		<link rel="stylesheet" href="css/w3_2.css">
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css"> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script> 
	</head>
    <script>

    $(function () {
		
	function afficherResa () {
	$('#nbResa').html(resa);
	}
	var resa = 1;
	afficherResa();

		
	$('#plus').on('click',function ()
	{
		resa++;
		afficherResa();
        if (resa > 5) {		
		resa= 1
		afficherResa();
		}
        let lbl = document.getElementById('lb');
        let empName = document.getElementById('emp').value;

        // Assign HTML codes along with text values using innerHTML.
        lbl.innerHTML = resa * empName;
		document.getElementById("hour_s").value = resa;
	});
	
	$('#minus').on('click',function ()
	{	
		resa--;
		afficherResa();
		if (resa < 1) {		
		resa= 5
		afficherResa();
		}
		let lbl = document.getElementById('lb');
        let empName = document.getElementById('emp').value;

        // Assign HTML codes along with text values using innerHTML.
        lbl.innerHTML = resa * empName;
		document.getElementById("hour_s").value = resa;
	});
	
});
    </script>
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
		<div class="container">
		<div id="myDIV">
			<br>
			<iframe src="shownonavailable.php?tutor=<?php echo $tutorid;?>" style="height:900px;width:1000px"></iframe>                              <p class="text-right"><a href="shownonavailable.php?tutor=<?php echo $tutorid;?>" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> view full page</a></p></div>
			<BR>
			<button type="button"  class="btn btn-success btn-xs" data-ajax='false' onclick="myFunction()">OK</button>
			</div>
			<main class="row" id="hideme" style="display:none;">
				<div class="col m6 offset-m3"id="inner">
					<div class="row">
						<div class="col m2 offset-m1 topControl">
							<a href="#"><i class="fa fa-chevron-left fa-2x" aria-hidden="true"></i></a>

						</div>
						<div class="col m2 offset-m6 topControl">
							<a href="#"><i class="fa fa-search fa-2x" aria-hidden="true"></i></a>

						</div>
						<div class="col m12">	
							<div class="card"id="pic">
								<div class="card-image">
									
								</div>
							</div>
						</div>
						<div class="col m6 offset-m3 inText">
							<p><?php echo $tname;?></p>
						</div><br><div class="col m6 offset-m3 inText"><?php echo $subject;?></div>
						<div class="col m4 offset-m4 inText">
							<p>Booking Hours</p>
						</div>
					</div>
					<div class="row inText">
						<div class="row">
							<div class="col m2 offset-m3 controls" id="minus">
								<i class="fa fa-minus fa-1x" aria-hidden="false">&lt</i>
	
							</div><form action ='payment.php' method='POST'>
							<div class="col m2"id="nbResa">
								
							</div>
							<div class="col m2 controls" id="plus">
								<i class="fa fa-plus fa-1x" aria-hidden="false">&gt</i>
							</div>
						</div>
                        <div class="col m6 offset-m3" id="example2">
							<h5>RM </h5><label id ="lb" style="font-size:20px"><?php echo $price;?></label> 
						</div><?php echo "<input type='text' id='emp' value='$price' hidden='true' name='subject_p'/>";
									echo "<input type='text'  value='$subject' hidden='true' name='subject_name'/>";
									echo "<input type='text'  value='$tname' hidden='true' name='tutor_n'/>";
									echo "<input type='text'  value='1' hidden='true' id ='hour_s' name='hour'/>";
									echo "<input type='text'  value='$tutorid' hidden='true' name='tutor_id'/>";?>
									<input type="hidden" name="csrf" value="<?php echo $csrf ?>">
						<div class="col m6 offset-m3">
							<p>Choose Date & Time</p>
						</div>
						<div class="col s12 ">
							<input id="datetime" value="" name="appoint_date" placeholder="date time" > 
        					</div>
							<button type="button" name="add" id="add" class="btn btn-success btn-xs" data-ajax='false' onclick="myFunction()">Show nonAvailable</button>
						<div class="col m8 offset-m2 submit">
							<button type="submit" id="submit" disable="true" name="submit" class="btn" >Confirm</button>
						</div><form>
						

				</div>
                
<script> 
     $ ("#datetime").datetimepicker({
          step: 60 ,
          minTime:'9:00',
          maxTime:'21:00',
          minDate: 0,
          inline:true,
     });

</script> 
<script>
function myFunction() {
	var y = document.getElementById("hideme");
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
        x.style.display = "block";
		y.style.display = "none";
    } else {
        x.style.display = "none";
		y.style.display = "block";
    }
}

</script>
		
	</body>
</html>